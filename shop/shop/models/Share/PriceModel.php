<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author      Zhenzh
 */
class Share_PriceModel extends Share_Price
{
    const NOT_ACTIVE = 0;//分享 未激活
    const ACTIVE = 1;//激活分享 可享立减
    const FORZEN = 2;//确认收货 冻结分享金
    const FINISH = 3;//收货后7天 已返分享金 此此分享完结

    const GOODS = 0;//普通商品
    const BUNDLING = 1;//套餐

    public static $share_map = array(
        'sqq'=>'QQ好友',
        'qzone'=>'QQ空间',
        'weixin'=>'微信好友',
        'weixin_timeline'=>'微信朋友圈',
        'tsina'=>'新浪微博',
    );

	public function __construct()
	{
		parent::__construct();
	}

    /**
     * 增加
     * @param $field_row
     * @param bool $return_insert_id
     * @return bool
     */
    public function addSharePrice($field_row, $return_insert_id=false)
    {
        $add_flag = $this->add($field_row, $return_insert_id);
        return $add_flag;
    }

    /**
     * 删除
     * @param $config_key
     * @return bool
     */
    public function removeSharePrice($config_key)
    {
        $del_flag = $this->remove($config_key);
        return $del_flag;
    }

    /**
     * 修改
     * @param null $config_key
     * @param $field_row
     * @return bool
     */
    public function editSharePrice($config_key = null, $field_row, $flag = false)
    {
        $update_flag = $this->edit($config_key, $field_row, $flag);

        return $update_flag;
    }

    /**
     * 读取分页列表
     * @param array $cond_row
     * @param array $order_row
     * @param int $page
     * @param int $rows
     * @return array|int
     */
	public function getSharePriceList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
		$rows = $this->listByWhere($cond_row, $order_row, $page, $rows);

        if($rows['items'])
        {
            $common_ids = array_column($rows['items'],'common_id');
            $share_cond_row['common_id:IN'] = $common_ids;
            $shareModel = new Share_BaseModel();
            $share_base_rows = $shareModel ->getByWhere($share_cond_row);

            foreach ($rows['items'] as $key=>$value)
            {
                foreach ($share_base_rows as $k => $v)
                {
                    if($value['common_id'] == $v['common_id'])
                    {
                        if($value['share_base'])
                        {
                            $flag = false;
                            foreach ($value['share_base'] as $sk=>$sv)
                            {
                                if($v[$sk] && $v[$sk] != $sv)
                                {
                                    $rows['items'][$key]['share_base'][$sk] = $v[$sk];
                                    $flag = true;
                                }
                            }
                            if($flag)
                            {
                                $rows['items'][$key]['price'] = array_sum( $rows['items'][$key]['share_base']);

                                $share_base_cond['share_base'] =  $rows['items'][$key]['share_base'];
                                $share_base_cond['price']      = $rows['items'][$key]['price'];

                                $this->editSharePrice($value['id'],$share_base_cond);
                            }
                        }
                    }
                }
            }
        }
		return $rows;
	}

    /**
     * 多条件获取所有分享
     * @param array $cond_row
     * @param array $order_row
     * @return array
     */
    public function getAllSharePriceByWhere($cond_row=array(), $order_row = array())
    {
        return $this->getByWhere($cond_row,$order_row);
    }

    /**
     * 多条件获取单个分享信息
     * @param $cond_row
     * @return array
     */
	public function getOneSharePriceByWhere($cond_row)
	{
		$data = $this->getOneByWhere($cond_row);
        $shareModel = new Share_BaseModel();
        $share_base_rows = $shareModel ->getOneByWhere(array('common_id'=>$data['common_id']));
        if($share_base_rows)
        {
            $flag = false;
            foreach ($data['share_base'] as $k=>$v)
            {
                if($share_base_rows[$k] && $share_base_rows[$k] != $v)
                {
                    $data['share_base'][$k] = $share_base_rows[$k];
                    $flag = true;
                }
            }

            if($flag)
            {
                $data['price'] = array_sum( $data['share_base']);

                $share_base_cond['share_base'] =  $data['share_base'];
                $share_base_cond['price'] = $data['price'];

                $flag2 = $this->editSharePrice($data['id'],$share_base_cond);
            }
        }
        return $data;
	}

    public function getCount($cond_row)
    {
        return $this->getNum($cond_row);
    }


    /** 是否分享
     * @param $common_id 商品common_id
     * @param $user_id 用户id
     * @return bool true/false
     */
    public function isShare($common_id,$user_id)
    {
        $flag = false;
        $cond_row['common_id'] = $common_id;
        $cond_row['share_uid'] = $user_id;
        $order_row['share_date'] = 'DESC';

        $share_price = $this->getOneByWhere($cond_row,$order_row);
        if($share_price)
        {
            $share_order_id = $share_price['share_order_id'];//最近的一单订单号
            if($share_order_id == '0')
            {
                $flag = true;
            }
            else
            {
                $order_model = new Order_BaseModel();
                $order = $order_model -> getOneByWhere(array('order_id'=>$share_order_id));
                if($order['order_status'] > 1 && $order['order_status'] < 7 )
                {
                    if($order['payment_id'] == 1)
                    {
                        $payment_time = strtotime($order['payment_time']);
                    }
                    else if($order['payment_id'] == 2)
                    {
                        $payment_time = strtotime($order['order_date']);
                    }

                    if($payment_time > 0)//支付了
                    {
                        //如果超过24小时冷却时间
                        if(time() < strtotime('+1 day',$payment_time))
                        {
                            $flag = true;
                        }
                    }
                }
            }
        }

        return $flag;
    }

    /*public function getSharePirce($id)
    {
        $sharePriceModel = new Share_PriceModel();
        $shareBaseModel = new Share_BaseModel();

        if($id)
        {
            $data = $sharePriceModel->getOne($id);
        }

        $shareBase = $shareBaseModel->getOneByWhere(array('common_id'=>$data['common_id']));
        if($shareBase)
        {
            $data['promotion_total_price'] = $shareBase['promotion_total_price'];
        }

        $orderBaseModel = new Order_BaseModel();
        $orderBase = $orderBaseModel->getOneByWhere(array('order_id'=>$data['share_order_id'],'buyer_user_id'=>$data['share_uid']));
        if($orderBase)
        {
            $data['buyer_user_id'] = $orderBase['buyer_user_id'];
            $data['buyer_user_name'] = $orderBase['buyer_user_name'];
            $data['seller_user_id'] = $orderBase['seller_user_id'];
            $data['seller_user_name'] = $orderBase['seller_user_name'];
        }

        return $data;
    }*/

}

?>