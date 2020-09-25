<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author
 */
class Api_App_ShareCtl extends YLB_AppController
{
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

}

?>