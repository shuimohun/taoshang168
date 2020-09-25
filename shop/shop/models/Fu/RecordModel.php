<?php
if (! defined('ROOT_PATH')) {
    exit('No Permission');
}

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/20
 * Time: 15:44
 */
class Fu_RecordModel extends Fu_Record
{
    const NORMAL  = 1;   // 集福中--未完成
    const DONE    = 2;   // 集福--完成--未提交订单
    const USED    = 3;   // 集福未成功--直接购买
    const SUCCESS = 4;   // 集福成功--免单
    const OVER    = 5;   // 集福失败

    public static $status_array_map = array(
        self::NORMAL  => '进行中',
        self::DONE    => '成功未提交',
        self::USED    => '送福购买',
        self::SUCCESS => '免单成功',
        self::OVER    => '失败'
    );

    public function __construct()
    {
        parent::__construct();
    }

    public function getFuRecordList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        $rows = $this->listByWhere($cond_row, $order_row, $page, $rows);

        if ($rows['items'])
        {
            foreach ($rows['items'] as $key => $value)
            {
                if($value['status'] < self::USED && $value['fu_end_time'] < get_date_time())
                {
                    $rows['items'][$key]['status'] = self::OVER;
                    $expire_fu[] = $value['fu_record_id'];
                }

                $rows['items'][$key]['status_con'] = self::$status_array_map[$rows['items'][$key]['status']];
            }

            if($expire_fu)
            {
                $this->editFuRecord($expire_fu,['status'=>self::OVER]);
            }
        }
        return $rows;
    }

    public function getFuRecordByWhere($cond_row)
    {
        $row = $this->getOneByWhere($cond_row);

        if($row && $row['status'] == self::NORMAL && $row['fu_end_time'] < get_date_time())
        {
            $this->editFuRecord($row['fu_record_id'],['status'=>self::OVER]);
            $row = array();
        }

        return $row;
    }

    public function addFuRecord($field_row, $return_insert_flag)
    {
        return $this->add($field_row, $return_insert_flag);
    }

    /**
     * 删除
     * @param $id
     * @return bool
     */
    public function removeFuRecord($id)
    {
        $rs_row = array();

        $del_flag = $this->remove($id);
        check_rs($del_flag, $rs_row);

        return is_ok($rs_row);
    }

    /**
     * 修改
     *
     * @param $id
     * @param $field_row
     * @param null $flag
     * @return bool
     */
    public function editFuRecord($id, $field_row, $flag = null)
    {
        $update_flag = $this->edit($id, $field_row, $flag);
        return $update_flag;
    }

    public function editFuRecordCount($fu_record,$stype,$fu_record_count,$fu_total_times,$fu_stock,$bind_id = null)
    {
        $flag = false;
        $FuClickModel = new Fu_ClickModel();
        $cond_click_row['fu_record_id'] = $fu_record['fu_record_id'];
        $cond_click_row['user_id'] = $fu_record['user_id'];
        $cond_click_row['ip'] = get_ip();
        $cond_click_row['type'] = $stype;
        if ($bind_id)
        {
            $cond_click_row['bind_id'] = $bind_id;
        }
        $fu_click_id = $FuClickModel->getKeyByWhere($cond_click_row);

        if (!$fu_click_id)
        {
            $cond_click_row['time'] = time();
            $flag = $FuClickModel->addFuClick($cond_click_row,false);
            if($flag)
            {
                $fu_record['fu_base'][$stype] = $fu_record_count + 1;
                $cond_fu_record_row['fu_base'] = $fu_record['fu_base'];
                $cond_fu_record_row['click_count'] = $fu_record['click_count'] + 1;

                //集福成功
                if($cond_fu_record_row['click_count'] == $fu_total_times)
                {
                    $cond_fu_record_row['status'] = Fu_RecordModel::DONE;

                    //自动下单
                    $OrderBaseModel = new Order_BaseModel();
                    $order_id = $OrderBaseModel->autoAddOrder($fu_record['user_id'],$fu_record['user_name'],$fu_record['goods_id']);

                    if($order_id)
                    {
                        $cond_fu_record_row['status'] = Fu_RecordModel::SUCCESS;
                        $cond_fu_record_row['order_id'] = $order_id;

                        //修改fu_base库存数 如果是最后一个 改变fu_base 状态
                        $FuBaseModel = new Fu_BaseModel();
                        $edit_fu['fu_stock'] = $fu_stock * 1 - 1;
                        if($edit_fu['fu_stock'] <= 0)
                        {
                            $edit_fu['fu_state'] = Fu_BaseModel::END;
                        }
                        $FuBaseModel->editFu($fu_record['fu_id'],$edit_fu);
                    }
                }

                $flag = $this->editFuRecord($fu_record['fu_record_id'],$cond_fu_record_row);
            }
        }

        return $flag;
    }

    /**
     * 注册用户 成功后 调用
     *
     * @param $fu_record_id 送福免单记录id
     * @param $stype        分享渠道
     * @param $bind_id      bind_id
     * @return bool
     */
    public function regFuRecord($fu_record_id, $stype, $bind_id)
    {
        $flag = false;
        $cond_row['fu_record_id'] = $fu_record_id;
        $cond_row['status'] = self::NORMAL;
        $fu_record = $this->getOneByWhere($cond_row);
        if ($fu_record)
        {
            $fu_record_count = 0;
            if(isset($fu_record['fu_base']) && isset($fu_record['fu_base'][$stype]))
            {
                $fu_record_count = $fu_record['fu_base'][$stype];
            }

            //获取正常状态的fu_base
            $FuBaseModel = new Fu_BaseModel();
            $fu_base = $FuBaseModel->getOneByWhere([
                'fu_id'      => $fu_record['fu_id'],
                'fu_state'   => Fu_BaseModel::NORMAL,
                'fu_stock:>' => 0
            ]);

            if($fu_base && $fu_base['fu_base'] && $fu_record_count < $fu_base['fu_base'][$stype])
            {
                $flag = $this->editFuRecordCount($fu_record,$stype,$fu_record_count,$fu_base['fu_total_times'],$fu_base['fu_stock'],$bind_id);
            }
        }

        return $flag;
    }


}

