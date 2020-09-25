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
class NewBuyer_BaseModel extends NewBuyer_Base
{

    const NORMAL = 1;
    // 开启
    const END = 2;
    // 关闭
    const CANCEL = 3;
    // 管理员关闭
    public static $state_array_map = array(
        self::NORMAL => '开启',
        self::END => '关闭',
        self::CANCEL => '管理员关闭'
    );

    const YIFEN = 1;
    const YIMAO = 2;
    const YIYUAN = 3;
    const GUANGAO = 4;

    public $Goods_CommonModel = null;
    public $goodsBaseModel = null;

    public function __construct()
    {
        parent::__construct();
        $this->Goods_CommonModel = new Goods_CommonModel();
        $this->goodsBaseModel = new Goods_BaseModel();
    }

    /**
     * 获取正常状态的新人优惠 Zhenzh
     *
     * @param $cond_row
     * @return array
     */
    public function getNormalNewBuyerByWhere($cond_row)
    {
        $cond_row['newbuyer_state'] = self::NORMAL;
        $cond_row['newbuyer_starttime:<'] = get_date_time();
        $cond_row['newbuyer_endtime:>'] = get_date_time();
        $row = $this->getOneByWhere($cond_row);

        return $row;
    }

    /**
     * 获取新人优惠 并判断活动是否正常 过期状态没修改的更新状态 Zhenzh
     *
     * @param $cond_row
     * @return array
     */
    public function getNewBuyerByWhere($cond_row)
    {
        $cond_row['newbuyer_state'] = self::NORMAL;
        $cond_row['newbuyer_starttime:<'] = get_date_time();
        $row = $this->getOneByWhere($cond_row);

        if ($row)
        {
            if (strtotime($row['newbuyer_endtime']) < time())
            {
                $this->cancleNewBuyer($row['newbuyer_id']);
                unset($row);
            }
        }
        return $row;
    }

    /**
     * 获取新人优惠 分页
     */
    public function getNewBuyerList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        $rows = $this->listByWhere($cond_row, $order_row, $page, $rows);

        if ($rows['items'])
        {
            $goods_ids = array_column($rows['items'],'goods_id');
            $goods_base_rows = $this->goodsBaseModel->getGoodsListByGoodId($goods_ids);

            foreach ($rows['items'] as $key => $value)
            {
                if (in_array($value['goods_id'], array_keys($goods_base_rows)))
                {
                    $rows['items'][$key]['newbuyer_price'] = $rows['items'][$key]['newbuyer_price']*1;
                    $rows['items'][$key]['goods_name'] = $goods_base_rows[$value['goods_id']]['goods_name'];
                    $rows['items'][$key]['goods_image'] = $goods_base_rows[$value['goods_id']]['goods_image'];
                    $rows['items'][$key]['goods_price'] = $goods_base_rows[$value['goods_id']]['goods_price'];
                    $rows['items'][$key]['goods_share_price'] = $goods_base_rows[$value['goods_id']]['goods_share_price'];
                    $rows['items'][$key]['goods_is_promotion'] = $goods_base_rows[$value['goods_id']]['goods_is_promotion'];
                    $rows['items'][$key]['goods_promotion_price'] = $goods_base_rows[$value['goods_id']]['goods_promotion_price'];
                    $rows['items'][$key]['goods_salenum'] = $goods_base_rows[$value['goods_id']]['goods_salenum'];
                    $rows['items'][$key]['share_sum_price'] = $goods_base_rows[$value['goods_id']]['goods_share_price'];
                    if($goods_base_rows[$value['goods_id']]['goods_is_promotion'])
                    {
                        $rows['items'][$key]['share_sum_price'] += $goods_base_rows[$value['goods_id']]['goods_promotion_price'];
                    }
                    $rows['items'][$key]['shared_price'] = number_format($value['newbuyer_price'] - $rows['items'][$key]['share_sum_price'],2,'.','');
                    $rows['items'][$key]['newbuyer_state_label'] = _(self::$state_array_map[$value['newbuyer_state']]);

                    if (strtotime($value['newbuyer_endtime']) < time() && $value['newbuyer_state'] == self::NORMAL)
                    {
                        $rows['items'][$key]['newbuyer_state'] = self::CANCEL;
                        $rows['items'][$key]['newbuyer_state_label'] = _(self::$state_array_map[self::CANCEL]);
                        $expire_newBuyer[] = $value['newbuyer_id'];
                    }

                    //活动价大于商品价
                    if($rows['items'][$key]['newbuyer_price'] > $rows['items'][$key]['goods_price'])
                    {
                        $rows['items'][$key]['newbuyer_state'] = self::CANCEL;
                        $expire_newBuyer[] = $value['newbuyer_id'];
                    }
                }
                else
                {
                    //参加活动的商品已被删除
                    unset($rows['items'][$key]);
                    $delete_newBuyer[] = $value['newbuyer_id'];
                }
            }

            // 活动到期，更改活动状态
            if ($expire_newBuyer)
            {
                $this->cancleNewBuyer($expire_newBuyer);
            }

            //参加活动的商品已被删除 删除活动
            if($delete_newBuyer)
            {
                $this->removeNewBuyer($delete_newBuyer);
            }
        }
        return $rows;
    }

    /**
     * 获取新人优惠 分页 Zhenzh
     */
    public function getNewBuyerDataList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        $rows = $this->listByWhere($cond_row, $order_row, $page, $rows);
        if ($rows['items'])
        {
            $goods_ids = array_column($rows['items'],'goods_id');
            $goods_base_rows = $this->goodsBaseModel->getGoodsListByGoodId($goods_ids);
            foreach ($rows['items'] as $key => $value)
            {
                if (in_array($value['goods_id'], array_keys($goods_base_rows)))
                {
                    $rows['items'][$key]['goods_name'] = $goods_base_rows[$value['goods_id']]['goods_name'];
                    $rows['items'][$key]['goods_image'] = $goods_base_rows[$value['goods_id']]['goods_image'];
                    $rows['items'][$key]['goods_price'] = $goods_base_rows[$value['goods_id']]['goods_price'];
                    $rows['items'][$key]['goods_share_price'] = $goods_base_rows[$value['goods_id']]['goods_share_price'];
                    $rows['items'][$key]['goods_is_promotion'] = $goods_base_rows[$value['goods_id']]['goods_is_promotion'];
                    $rows['items'][$key]['goods_promotion_price'] = $goods_base_rows[$value['goods_id']]['goods_promotion_price'];
                    $rows['items'][$key]['share_sum_price'] = $goods_base_rows[$value['goods_id']]['goods_share_price'];
                    if ($goods_base_rows[$value['goods_id']]['goods_is_promotion'])
                    {
                        $rows['items'][$key]['share_sum_price'] += $goods_base_rows[$value['goods_id']]['goods_promotion_price'];
                    }
                    $rows['items'][$key]['shared_price'] = number_format($value['newbuyer_price'] - $rows['items'][$key]['share_sum_price'], 2, '.', '');
                    $rows['items'][$key]['newbuyer_state_label'] = _(self::$state_array_map[$value['newbuyer_state']]);
                    if (strtotime($value['newbuyer_endtime']) < time() && $value['newbuyer_state'] == self::NORMAL)
                    {
                        $rows['items'][$key]['newbuyer_state'] = self::CANCEL;
                        $rows['items'][$key]['newbuyer_state_label'] = _(self::$state_array_map[self::CANCEL]);
                        $expire_newBuyer[] = $value['newbuyer_id'];
                    }

                    //活动价大于商品价
                    if($rows['items'][$key]['newbuyer_price'] > $rows['items'][$key]['goods_price'])
                    {
                        $expire_newBuyer[] = $value['newbuyer_id'];
                    }
                }
                else
                {
                    //参加活动的商品已被删除
                    unset($rows['items'][$key]);
                    $delete_newBuyer[] = $value['newbuyer_id'];
                }
            }

            // 活动到期，更改活动状态
            if ($expire_newBuyer)
            {
                $this->cancleNewBuyer($expire_newBuyer);
            }

            //参加活动的商品已被删除 删除活动
            if($delete_newBuyer)
            {
                $this->removeNewBuyer($delete_newBuyer);
            }
        }
        return $rows;
    }

    /**
     * 多条件 获取新人优惠详情
     *
     * @see YLB_Model::getOneByWhere()
     */
    public function getNewBuyerDetailByWhere($cond_row)
    {
        $row = $this->getOneByWhere($cond_row);
        if ($row)
        {
            $row['newbuyer_state_label'] = _(self::$state_array_map[$row['newbuyer_state']]);
            
            $goods_base_row = $this->goodsBaseModel->getOneByWhere(array('goods_id' => $row['goods_id']));
            
            if ($goods_base_row)
            {
                $row['goods_name'] = $goods_base_row['goods_name'];
                $row['goods_image'] = $goods_base_row['goods_image'];
                $row['goods_price'] = $goods_base_row['goods_price'];
                $row['reduce'] = $goods_base_row['goods_price'] - $row['newbuyer_price'];
                $row['rate'] = sprintf("%.2f", $row['newbuyer_price'] / $goods_base_row['goods_price'] * 10);
                $row['goods_share_price'] = $goods_base_row['goods_share_price'];
                $row['goods_is_promotion'] = $goods_base_row['goods_is_promotion'];
                $row['goods_promotion_price'] = $goods_base_row['goods_promotion_price'];
                $row['share_sum_price'] = $goods_base_row['goods_share_price'];
                if($goods_base_row['goods_is_promotion'])
                {
                    $row['share_sum_price'] += $goods_base_row['goods_promotion_price'];
                }
                $row['shared_price'] = number_format($row['newbuyer_price'] - $row['share_sum_price'],2,'.','');

                if (strtotime($row['newbuyer_endtime']) < time() && $row['newbuyer_state'] == self::NORMAL)
                {
                    $row['newbuyer_state'] = self::CANCEL;
                    $row['newbuyer_state_label'] = _(self::$state_array_map[self::CANCEL]);
                    
                    $field_row['newbuyer_state'] = self::CANCEL;
                    $this->editNewBuyer($row['newbuyer_id'], $field_row);
                }
            }
            else
            {
                // 商品已不存在 修改状态为 关闭
                $field_row['newbuyer_state'] = self::CANCEL;
                $this->editNewBuyer($row['newbuyer_id'], $field_row);
                unset($row);
            }
        }
        
        return $row;
    }

    /**
     * 根据主键搜索新人优惠详情
     */
    public function getNewBuyerById($newBuyer_id)
    {
        $row = $this->getOne($newBuyer_id);
        if ($row) {
            $row['newbuyer_state_label'] = _(self::$state_array_map[$row['newbuyer_state']]);
            
            $goods_common_row = $this->Goods_CommonModel->getOneByWhere(array(
                'common_id' => $row['goods_id']
            ));
            
            if ($goods_common_row) {
                $row['goods_name'] = $goods_common_row['common_name'];
                $row['goods_price'] = $goods_common_row['common_price'];
                $row['reduce'] = $goods_common_row['common_price'] - $row['newbuyer_price'];
                $row['rate'] = sprintf("%.2f", $row['newbuyer_price'] / $goods_common_row['common_price'] * 10);
                
                if (strtotime($row['newbuyer_endtime']) < time() && $row['newbuyer_state'] == self::NORMAL) {
                    $row['newbuyer_state'] = self::CANCEL;
                    $row['newbuyer_state_label'] = _(self::$state_array_map[self::CANCEL]);
                    
                    $field_row['newBuyer_state'] = self::FINISHED;
                    $this->editNewBuyer($row['newBuyer_id'], $field_row);
                }
            } else {
                // $this->removeNewBuyerGoods($row['newbuyer_id']);
                unset($row);
            }
        }
        
        return $row;
    }

    /**
     * 发布活动
     * @param unknown $field_row
     * @param unknown $return_insert_flag            
     * @return boolean
     */
    public function addNewBuyer($field_row, $return_insert_flag)
    {
        return $this->add($field_row, $return_insert_flag);
    }

    /**
     * 删除新人优惠
     * @param $newBuyer_id
     * @return bool
     */
    public function removeNewBuyer($newBuyer_id)
    {
        $rs_row = array();
        
        $del_flag = $this->remove($newBuyer_id);
        check_rs($del_flag, $rs_row);
        
        return is_ok($rs_row);
    }

    /**
     * 修改新人优惠信息
     */
    public function editNewBuyer($newBuyer_id, $field_row, $flag = null)
    {
        $update_flag = $this->edit($newBuyer_id, $field_row, $flag);
        return $update_flag;
    }

    /**
     * 系统更改过期的活动状态
     * @param $newbuyer_id 单个id或id数组
     */
    public function cancleNewBuyer($newbuyer_id)
    {
        $field_row['newbuyer_state'] = self::CANCEL;
        $this->editNewBuyer($newbuyer_id, $field_row);
    }

    public function getField($field = '*',$cond_row,$group)
    {
        return $this->select($field,$cond_row,$group);
    }
}

