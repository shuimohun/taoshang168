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
class Fu_BaseModel extends Fu_Base
{
    const NORMAL = 1; // 开启
    const END    = 2; // 关闭
    const CANCEL = 3; // 管理员关闭
    const DELETE = 4; // 删除

    public static $state_array_map = array(
        self::NORMAL => '开启',
        self::END => '关闭',
        self::CANCEL => '管理员关闭'
    );

    public $Goods_CommonModel = null;
    public $GoodsBaseModel = null;

    public $jsonKey = ['fu_base'];

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
        $this->Goods_CommonModel = new Goods_CommonModel();
        $this->GoodsBaseModel = new Goods_BaseModel();
    }

    /**
     * 获取送福免单 分页
     *
     * @param array $cond_row
     * @param array $order_row
     * @param int $page
     * @param int $rows
     * @return array|int
     */
    public function getFuList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        $cond_row['fu_state:<>'] = self::DELETE;
        $rows = $this->listByWhere($cond_row, $order_row, $page, $rows);

        if ($rows['items'])
        {
            $goods_ids = array_column($rows['items'],'goods_id');
            $goods_base_rows = $this->GoodsBaseModel->getGoodsListByGoodId($goods_ids);

            foreach ($rows['items'] as $key => $value)
            {
                if (in_array($value['goods_id'], array_keys($goods_base_rows)))
                {
                    $rows['items'][$key]['fu_price'] = $rows['items'][$key]['fu_price']*1;
                    $rows['items'][$key]['fu_t_price'] = $rows['items'][$key]['fu_t_price']*1;
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
                    $rows['items'][$key]['shared_price'] = number_format($value['fu_price'] - $rows['items'][$key]['share_sum_price'],2,'.','');
                    $rows['items'][$key]['fu_state_label'] = _(self::$state_array_map[$value['fu_state']]);

                    if ($value['fu_state'] == self::NORMAL && $value['fu_stock'] <= 0)
                    {
                        $rows['items'][$key]['fu_state'] = self::END;
                        $rows['items'][$key]['fu_state_label'] = _(self::$state_array_map[self::END]);
                        $expire_fu[] = $value['fu_id'];
                    }

                    //活动价大于商品价
                    if($rows['items'][$key]['fu_price'] > $rows['items'][$key]['goods_price'])
                    {
                        $rows['items'][$key]['fu_state'] = self::CANCEL;
                        $rows['items'][$key]['fu_state_label'] = _(self::$state_array_map[self::CANCEL]);
                        $cancel_fu[] = $value['fu_id'];
                    }
                }
                else
                {
                    //参加活动的商品已被删除
                    unset($rows['items'][$key]);
                    $delete_fu[] = $value['fu_id'];
                }
            }

            //活动结束
            if ($expire_fu)
            {
                $this->cancelFu($expire_fu,self::END);
            }

            //取消活动
            if ($cancel_fu)
            {
                $this->cancelFu($cancel_fu,self::CANCEL);
            }

            //删除活动
            if($delete_fu)
            {
                $this->removeFu($delete_fu);
            }
        }
        return $rows;
    }

    /**
     * 获取送福免单 并判断活动是否正常 过期状态没修改的更新状态
     *
     * @param $cond_row
     * @return array
     */
    public function getOneFuByWhere($cond_row)
    {
        $cond_row['fu_state:<>'] = self::DELETE;
        $row = $this->getOneByWhere($cond_row);

        if ($row['fu_state'] == self::NORMAL && $row['fu_stock'] <= 0)
        {
            $row['fu_state'] = self::END;
            $this->cancelFu($row['fu_id']);
        }

        return $row;
    }

    /**
     * 根据主键搜索送福免单详情
     */
    public function getFuById($fu_id)
    {
        $cond_row['fu_state:<>'] = self::DELETE;
        $row = $this->getOne($fu_id);
        if ($row)
        {
            $row['fu_state_label'] = _(self::$state_array_map[$row['fu_state']]);
            
            $goods_base_row = $this->GoodsBaseModel->getOne($row['goods_id']);
            if ($goods_base_row)
            {
                $row['goods_name']  = $goods_base_row['goods_name'];
                $row['goods_price'] = $goods_base_row['goods_price'];
            }
            else
            {
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
    public function addFu($field_row, $return_insert_flag)
    {
        return $this->add($field_row, $return_insert_flag);
    }

    /**
     * 删除送福免单
     * @param $fu_id
     * @return bool
     */
    public function removeFu($fu_id)
    {
        $flag = $this->cancelFu($fu_id,self::DELETE);
        return $flag;

        /*$rs_row = array();

        $del_flag = $this->remove($fu_id);
        check_rs($del_flag, $rs_row);

        return is_ok($rs_row);*/
    }

    /**
     * 修改送福免单信息
     *
     * @param $fu_id
     * @param $field_row
     * @param null $flag
     * @return bool
     */
    public function editFu($fu_id, $field_row, $flag = null)
    {
        $update_flag = $this->edit($fu_id, $field_row, $flag);
        return $update_flag;
    }

    /**
     * 更改活动状态
     *
     * @param $fu_id
     * @param int $state
     * @return bool
     */
    public function cancelFu($fu_id,$state = self::END)
    {
        $field_row['fu_state'] = $state;
        $update_flag = $this->editFu($fu_id, $field_row);
        return $update_flag;
    }

    /**
     * 检测送福免单是否可用
     *
     * @param $goods_id
     * @param int $user_id
     * @return array
     */
    public function checkFu($goods_id,$user_id = 0)
    {
        $data = array();
        if (Web_ConfigModel::value('promotion_allow'))
        {
            $cond_row['goods_id'] = $goods_id;
            $cond_row['fu_state'] = Fu_BaseModel::NORMAL;
            $cond_row['fu_stock:>'] = 0;
            $data = $this->getOneByWhere($cond_row);

            if ($data)
            {
                $data['status'] = 0;//表示状态正常

                if ($data['is_register'] == 0)//不是注册福 添加以下判断
                {
                    $FuQuotaModel = new Fu_QuotaModel();
                    $fu_quota = $FuQuotaModel->getOneByWhere([
                        'shop_id'=>$data['shop_id']
                    ]);

                    if ($fu_quota)
                    {
                        if ($user_id)
                        {
                            $seller_count = $fu_quota['goods_count'] ? $fu_quota['goods_count'] : 0;//限制会员免单商品数量
                            $seller_unit_count = $fu_quota['goods_unit_count'] ? $fu_quota['goods_unit_count'] : 0;//设定单品送福免单次数 0表示没限制
                            $seller_order_amount = $fu_quota['goods_order_amount'] ? $fu_quota['goods_order_amount'] : 0;//购物满xx元可继续送福免单
                            $seller_add_count = $fu_quota['goods_add_count'] ? $fu_quota['goods_add_count'] : 0;//购物满xx元继续送福免单商品数量

                            if ($seller_count && $seller_order_amount && $seller_add_count)
                            {
                                //查询当前商品免过多少次
                                $FuRecordModel = new Fu_RecordModel();
                                $times = $FuRecordModel->getRowCount([
                                    'user_id'  => $user_id,
                                    'status'   => $FuRecordModel::SUCCESS,
                                    'goods_id' => $goods_id,
                                    'shop_id'  => $data['shop_id']
                                ]);

                                if ($seller_unit_count == 0 || $times < $seller_unit_count)
                                {
                                    //查询免过多少种商品
                                    $sql = "SELECT COUNT(*) c FROM(SELECT COUNT(*) FROM ".TABEL_PREFIX."fu_record WHERE status = ".$FuRecordModel::SUCCESS." AND user_id = $user_id AND shop_id = ".$data['shop_id']." GROUP BY goods_id ) a";
                                    $count = $FuRecordModel->selectCountSql($sql);

                                    //查询今天消费多少钱
                                    $sql = 'SELECT SUM(order_payment_amount) s FROM '.TABEL_PREFIX.'order_base WHERE buyer_user_id = '.$user_id.' AND shop_id = '.$data['shop_id'].' AND order_status > 1 AND `order_refund_status` = 0 AND `order_return_status` = 0 AND payment_time >= "' . date('Y-m-d 00:00:00', time()) . '"';
                                    $sum_amount = $FuQuotaModel->selectCountSql($sql);

                                    //消费满了
                                    if ($sum_amount && $sum_amount >= $seller_order_amount)
                                    {
                                        $seller_count += $seller_add_count;
                                        if ($count >= $seller_count)
                                        {
                                            $data = ['status'=>5,'msg'=>'送福免单商品数已达上限'];
                                        }
                                    }
                                    else
                                    {
                                        if ($count >= $seller_count)
                                        {
                                            $data = ['status'=>4,'msg'=>'送福免单商品数已达上限需在本店购物满' . $seller_order_amount .'元元可继续送福免单'.$seller_add_count.'商品数量' ];
                                        }
                                    }
                                }
                                else
                                {
                                    $data = ['status'=>3,'msg'=>'该商品送福免单次数已达上限(' . $seller_unit_count . '次)' ];
                                }
                            }
                            else
                            {
                                $data = ['status'=>2,'msg'=>'活动设置不完整'];
                            }
                        }
                    }
                    else
                    {
                        $data = ['status'=>1,'msg'=>'商家没有开启活动设置'];
                    }
                }
            }
        }

        return $data;
    }

}

