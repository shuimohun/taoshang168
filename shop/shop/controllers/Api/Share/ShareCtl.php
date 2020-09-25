<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     Zhenzh
 * Api_Controller
 */
class Api_Share_ShareCtl extends Api_Controller
{
    public $sharePriceModel = null;
	/**
	 * Constructor
	 *
	 * @param  string $ctl 控制器目录
	 * @param  string $met 控制器方法
	 * @param  string $typ 返回数据类型
	 * @access public
	 */
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);

        $this->sharePriceModel = new Share_PriceModel();
	}

    public function getShare()
    {
        if(request_string('p') == '1')
        {
            $sql = 'SELECT SUM(price) sheng_price FROM `'.$this->sharePriceModel->_tableName.'` WHERE share_uid = '.request_string('uid').' AND STATUS > 0 and share_order_id <> "0"';
            $share_data = $this->sharePriceModel->selectSql($sql);
            if($share_data)
            {
                $share_data = pos($share_data);
                $data['save_total_money'] = $share_data['sheng_price'];
            }
        }
        else
        {
            $page                   = request_int('page', 1);
            $rows                   = request_int('rows', 10);
            $cond_row['share_uid'] = request_string('uid');         //分享人id
            $cond_row['status:>']  = Share_PriceModel::NOT_ACTIVE;  //状态要激活以上的
            if(request_string('time'))
            {
                $cond_row['share_date:>='] = strtotime(request_string('time'));
            }
            else
            {
                if(request_string('start_date'))
                {
                    $cond_row['share_date:>='] = strtotime(request_string('start_date'));
                }

                if(request_string('end_date'))
                {
                    $cond_row['share_date:<='] = strtotime(request_string('end_date'));
                }
            }

            $type = request_string('type');

            $data = $this->sharePriceModel->getSharePriceList($cond_row, array('share_date' => 'DESC'), $page, $rows);
            $GoodsBaseModel = new Goods_BaseModel();
            $ShareClickModel = new Share_ClickModel();
            foreach ($data['items'] as $key=>$val)
            {
                $data['items'][$key]['share_date_str'] = date('Y-m-d H:i:s',$val['share_date']);
                if($val['share_order_id'] == '0' && $val['status'] == Share_PriceModel::ACTIVE)
                {
                    //已激活分享 但订单未提交
                    $data['items'][$key]['order_status'] = '订单未提交';
                    $data['items'][$key]['order_finished_time'] = '--';
                    $data['items'][$key]['dz_date'] = '--';
                }
                else
                {
                    $order_ids[] = $val['share_order_id'];
                }

                $data['items'][$key]['click_count_total'] = $val['promotion_total_price']/$val['promotion_unit_price'];
                $data['items'][$key]['share_click_price'] = $val['promotion_unit_price'] * $val['promotion_click_count'];

                $click_cond['share_price_id'] = $val['id'];
                $click_data = null;
                foreach ($val['share_base'] as $k=>$v)
                {
                    $click_cond['type'] = $k;
                    $click_data[$k] = $ShareClickModel->getCount($click_cond);
                }
                $data['items'][$key]['click_data'] = $click_data;

                if($type == 'goods')
                {
                    $goods = $GoodsBaseModel->getOneByWhere(array('common_id'=>$val['common_id']));
                    $data['items'][$key]['goods_image'] = $goods['goods_image'];
                    $data['items'][$key]['goods_name'] = $goods['goods_name'];//商品名称
                    $data['items'][$key]['goods_price'] = $goods['goods_price'];
                    $data['items'][$key]['shop_name'] = $goods['shop_name'];
                    $data['items'][$key]['goods_id'] = $goods['goods_id'];
                    $data['items'][$key]['goods_evaluation_good_star'] = $goods['goods_evaluation_good_star'];
                    $data['items'][$key]['promotion_price'] = $goods['goods_price'] - $val['price'];
                }
            }

            //获取订单
            if($order_ids)
            {
                $OrderBaseModel   = new Order_BaseModel();
                $Order_StateModel = new Order_StateModel();
                $order_rows = $OrderBaseModel -> getBase($order_ids);
            }

            foreach ($data['items'] as $key=>$val)
            {
                if(array_key_exists($val['share_order_id'],$order_rows))
                {
                    $order_base = $order_rows[$val['share_order_id']];
                    $data['items'][$key]['order_status'] = $Order_StateModel->orderState[$order_base['order_status']];

                    if($order_base['order_status'] > 1 && $order_base['order_status'] < 7 )
                    {
                        if($order_base['payment_id'] == 1)
                        {
                            $now = strtotime('+1 day',$order_base['payment_time']);
                        }
                        else if($order_base['payment_id'] == 2)
                        {
                            $now = strtotime('+1 day',$order_base['order_date']);
                        }

                        if(time() < $now)
                        {
                            $data['items'][$key]['share_end_date'] = date('Y-m-d H:i:s',$now);
                        }
                    }

                    //如果订单已完成
                    if($order_base['order_status'] == $Order_StateModel::ORDER_FINISH)
                    {
                        $order_finished_time = $order_base['order_finished_time'];//订单完成时间
                        $data['items'][$key]['order_finished_time'] = $order_finished_time;
                        $data['items'][$key]['dz_date'] = date('Y-m-d H:i:s',strtotime('+1 week',strtotime($order_finished_time)));
                    }
                    else
                    {
                        $data['items'][$key]['order_finished_time'] = '--';
                        $data['items'][$key]['dz_date'] = '--';
                    }
                }
                else
                {
                    $data['items'][$key]['order_finished_time'] = '--';
                    $data['items'][$key]['dz_date'] = '--';
                }
            }

            if(request_string('p'))
            {
                $sql = 'SELECT SUM(price) sheng_price FROM `'.$this->sharePriceModel->_tableName.'` WHERE share_uid = '.request_string('uid').' AND STATUS > 0 and share_order_id <> "0"';
                $share_data = $this->sharePriceModel->selectSql($sql);
                if($share_data)
                {
                    $share_data = pos($share_data);
                    $data['save_total_money'] = $share_data['sheng_price'];
                }
            }
        }

        if ($this->typ == 'json')
        {
            $this->data->addBody(-140, $data);
        }
        else
        {
            include $this->view->getView();
        }
    }

    public function getShare_bak()
    {
        $shareBaseModel  = new Share_BaseModel();
        $sharePriceModel = new Share_PriceModel();
        $shareClickModel = new Share_ClickModel();

        $page              = request_int('page', 1);
        $rows              = request_int('rows', 10);

        $order_row['share_uid']        = request_string('uid');
        $order_row['status:>'] = '0';
        if(request_string('time'))
        {
            $order_row['share_date:>='] = strtotime(request_string('time'));
        }
        $data = $sharePriceModel->getSharePriceList($order_row, array('share_date' => 'DESC'), $page, $rows);

        $cond['share_uid'] = request_string('uid');
        $cond['status:>'] = '0';

        $one_time = $sharePriceModel->getSharePriceList($cond, array('share_date' => 'ASC'));
        $one_date = date('Y-m-d',$one_time['items'][0]['share_date']);
        $save_total_money = 0;
        foreach ($data['items'] as $key=>$val)
        {
            $common_id = $val['common_id'];

            $goodsModel = new Goods_BaseModel();
            $goods = $goodsModel->getOneByWhere(array('common_id'=>$common_id));
            $data['items'][$key]['goods_image'] = $goods['goods_image'];
            $data['items'][$key]['goods_name'] = $goods['goods_name'];//商品名称
            $data['items'][$key]['goods_price'] = $goods['goods_price'];
            $data['items'][$key]['shop_name'] = $goods['shop_name'];
            $data['items'][$key]['goods_id'] = $goods['goods_id'];
            $data['items'][$key]['goods_evaluation_good_star'] = $goods['goods_evaluation_good_star'];
            $data['items'][$key]['promotion_price'] = $goods['goods_price'] - $val['price'];

            $share_base = $shareBaseModel->getOneByWhere(array('common_id'=>$common_id));

            $data['items'][$key]['promotion_total_price'] = $share_base['promotion_total_price'];
            $data['items'][$key]['click_count_total']     = $share_base['promotion_total_price']/$share_base['promotion_unit_price'];
            $data['items'][$key]['promotion_unit_price'] = $share_base['promotion_unit_price'];
            $data['items'][$key]['share_click_price'] =  $share_base['promotion_unit_price'] * $val['promotion_click_count'];

            $click_cond['share_price_id'] = $val['id'];
            $click_data = null;
            foreach ($val['share_base'] as $k=>$v)
            {
                $click_cond['type'] = $k;
                $click_data[$k] = $shareClickModel->getCount($click_cond);
            }
            $data['items'][$key]['click_data'] = $click_data;

            if($val['share_order_id'] == '0')
            {
                $data['items'][$key]['order_status'] = '订单未提交';
                $data['items'][$key]['order_finished_time'] = '--';
                $data['items'][$key]['dz_date'] = '--';
            }
            else
            {
                $order_base_model = new Order_BaseModel();
                $order = $order_base_model -> getOneByWhere(array('order_id'=>$val['share_order_id']));

                $Order_StateModel = new Order_StateModel();
                $data['items'][$key]['order_status'] = $Order_StateModel->orderState[$order['order_status']];

                if($order['order_status'] > 1 && $order['order_status'] < 7 )
                {
                    if($order['payment_id'] == 1)
                    {
                        $now = strtotime('+1 day',$order['payment_time']);
                    }
                    else if($order['payment_id'] == 2)
                    {
                        $now = strtotime('+1 day',$order['order_date']);
                    }

                    if(time() < $now)
                    {
                        $data['items'][$key]['share_end_date'] = date('Y-m-d H:i:s',$now);
                    }
                }


                if($order['order_status'] == '6')
                {
                    $order_finished_time = $order['order_finished_time'];//订单完成时间
                    $data['items'][$key]['order_finished_time'] = $order_finished_time;
                    $dz_date = date('Y-m-d H:i:s',strtotime('+1 week',strtotime($order_finished_time)));

                    $data['items'][$key]['dz_date'] = $dz_date;

                    if(strtotime(time()) > strtotime($dz_date))
                    {
                        //得分享金满7天 转入账户 修改数据表 需记录转入状态 转入时间
                        //Q:分享金 什么时候算完结
                    }
                }
                else
                {
                    $data['items'][$key]['order_finished_time'] = '--';
                    $data['items'][$key]['dz_date'] = '--';
                }
            }
            $save_total_money += $val['price'];
            $data['items'][$key]['share_date_str'] = date('Y-m-d H:i:s',$val['share_date']);

        }

        $data['one_date'] = $one_date;
        $data['save_total_money'] = $save_total_money;

        if ('json' == $this->typ)
        {
            $this->data->addBody(-140, $data);
        }
        else
        {
            include $this->view->getView();
        }
    }

    public function getShareBySn()
    {
        $shareBaseModel   = new Share_BaseModel();
        $sharePriceModel  = new Share_PriceModel();
        $shareClickModel  = new Share_ClickModel();
        $GoodsCommonModel = new Goods_CommonModel();
        $GoodsBaseModel   = new Goods_BaseModel();
        $orderBaseModel   = new Order_BaseModel();
        $orderStateModel  = new Order_StateModel();

        $share_num      = request_string('share_num');

        $order_row['share_num'] = $share_num;

        $order_row['status:>'] = '0';

        $shareBase = $sharePriceModel->getSharePriceList($order_row, array('share_date' => 'DESC'));

        $num = 0;

        foreach ($shareBase['items'] as $key=>$value)
        {
            $data = $value;

            $data['share_date_str'] = date('Y-m-d H:i:s',$value['share_date']);

            $data['share'] = $shareBaseModel->getOneShareByWhere(array('common_id'=>$value['common_id']));

            if($value['share_order_id'])
            {
                $order = $orderBaseModel->getOneByWhere(array('order_id'=>$value['share_order_id']));

                if($order['order_status'] > 1 && $order['order_status'] < 7 )
                {
                    if($order['payment_id'] == 1)
                    {
                        $now = strtotime('+1 day',$order['payment_time']);
                    }
                    else if($order['payment_id'] == 2)
                    {
                        $now = strtotime('+1 day',$order['order_date']);
                    }

                    if(time() < $now)
                    {
                        $data['share_end_date'] = date('Y-m-d H:i:s',$now);
                    }
                }

                $data['order_status'] = $order['order_status'];
                $data['order_status_str'] = $orderStateModel->orderState[$order['order_status']];
            }

            $arr = $sharePriceModel->getSharePriceList(array('common_id'=>$value['common_id']));

            foreach($arr['items'] as $k=>$v)
            {
                if($v['share_order_id'])
                {
                    $num++;
                }
            }
            $data['is_share_limit'] = $data['share']['share_limit'] - $num;
            $data['goods_base'] =  $GoodsBaseModel->getOne($GoodsCommonModel->getNormalStateGoodsId($value['common_id']));
            $data['weixin_count'] = $shareClickModel->getShareClickList(array('share_price_id'=>$value['id'],'type'=>'weixin'));
            $data['weixin_timeline_count'] = $shareClickModel->getShareClickList(array('share_price_id'=>$value['id'],'type'=>'weixin_timeline'));
            $data['sqq_count'] = $shareClickModel->getShareClickList(array('share_price_id'=>$value['id'],'type'=>'sqq'));
            $data['qzone_count'] = $shareClickModel->getShareClickList(array('share_price_id'=>$value['id'],'type'=>'qzone'));
            $data['tsina_count'] = $shareClickModel->getShareClickList(array('share_price_id'=>$value['id'],'type'=>'tsina'));
            $data['total_price'] = floatval(($data['promotion_click_count'] * $data['promotion_unit_price']));
            $data['true_money']  = $data['goods_base']['goods_price'] - $data['price'];

        }
       if($this->typ == 'json')
       {
           $this->data->addBody(-140,$data);
       }
    }

    public function setSharePriceStatus()
    {
        $share_price_k = request_row('k');
        $status = request_row('status');
        $sharePriceModel = new Share_PriceModel();
        $sharePriceModel ->editSharePrice($share_price_k,array('status'=>$status));
    }

    //获取分享share_price信息
    public function getSharePirce()
    {
        $data = array();
        $sharePriceModel = new Share_PriceModel();

        $id  = request_string('share_price_id');
        if($id)
        {
            $row = $sharePriceModel->getOne($id);
            $data['share_uid'] = $row['share_uid'];
            $data['promotion_unit_price'] = $row['promotion_unit_price'];
            $data['promotion_click_count'] = $row['promotion_click_count'];
        }

        if ('json' == $this->typ)
        {
            $this->data->addBody(-140, $data);
        }
        else
        {
            include $this->view->getView();
        }
    }

    //获取合计立减多少钱 和 冻结立赚可到账的 改成计划任务了 20180123
    /*public function getFinishShare()
    {
        $sharePriceModel       = new Share_PriceModel();
        $cond_row['share_uid']        = request_string('uid');
        $cond_row['status:>']  = Share_PriceModel::ACTIVE;
        $share_price_row = $sharePriceModel->getByWhere($cond_row);

        $sheng_price = 0;
        foreach ($share_price_row as $key=>$value)
        {
            $sheng_price += $value['price'];//统计共立减了多少钱

            if($value['status'] == Share_PriceModel::FORZEN && $value['dz_date'] <= time())
            {
                $data['share_price_frozen'][] = $value;
            }
        }

        $data['sheng_price'] = $sheng_price;

        if ('json' == $this->typ)
        {
            $this->data->addBody(-140, $data);
        }
        else
        {
            include $this->view->getView();
        }
    }*/

    public function getShareSheng()
    {
        $sharePriceModel = new Share_PriceModel();
        $share_uid = request_string('uid');
        $sql = 'SELECT SUM(price) sheng_price FROM `'.$sharePriceModel->_tableName.'` WHERE share_uid = '.$share_uid.' AND STATUS > 0 and share_order_id <> "0"';
        $data = $sharePriceModel->selectSql($sql);
        $data = pos($data);

        if ('json' == $this->typ)
        {
            $this->data->addBody(-140, $data);
        }
    }

}

?>