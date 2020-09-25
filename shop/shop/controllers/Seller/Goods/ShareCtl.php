<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}
 
/**
 * @author     windfnn
 */
class Seller_Goods_ShareCtl extends Seller_Controller
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
 
	/**
	 * 分享立减数据
	 *
	 * @access public
	 */
	public function share()
	{
        $sharePriceModel = new Share_PriceModel();
        $shareClickModel = new Share_ClickModel();
        $orderBaseModel  = new Order_BaseModel();
        $orderStateModel = new Order_StateModel();

        $YLB_Page           = new YLB_Page();
        $YLB_Page->listRows = 10;
        $rows               = $YLB_Page->listRows;
        $offset             = request_int('firstRow', 0);
        $page               = ceil_r($offset / $rows);

        if (request_string('query_start_date'))
        {
            $share_cond['share_date:>'] = strtotime(request_string('query_start_date'));
        }
        if (request_string('query_end_date'))
        {
            $share_cond['share_date:<'] = strtotime(request_string('query_end_date'));
        }
        if (request_string('order_sn'))
        {
            $share_cond['share_num:LIKE'] = '%' . request_string('order_sn') . '%';
        }

        $share_cond['shop_id'] = Perm::$shopId;
        $share_cond['status:>'] = '0';
        $data = $sharePriceModel->getSharePriceList($share_cond, array('share_date' => 'DESC'), $page, $rows);

        foreach ($data['items'] as $key=>$value)
        {
            if($value['share_order_id'] == '0')
            {
                $data['items'][$key]['order_status_str'] = '订单未提交';
            }
            else
            {
                $share_order_ids[] = $value['share_order_id'];
            }

            $click_data = null;
            $click_cond['share_price_id'] = $value['id'];
            foreach ($value['share_base'] as $k=>$v)
            {
                $click_cond['type'] = $k;
                $click_data[$k] = $shareClickModel->getCount($click_cond);
            }
            $data['items'][$key]['click_data'] = $click_data;

            $share_uids[] = $value['share_uid'];
        }

        if($share_order_ids)
        {
            $order_cond['order_id:IN'] = $share_order_ids;
            $order_rows = $orderBaseModel->getByWhere($order_cond);
        }

        if($share_uids)
        {
            $UserBaseModel = new User_BaseModel();
            $user_rows = $UserBaseModel->getByWhere(array('user_id:IN'=>$share_uids));
        }

        foreach ($data['items'] as $key=>$value)
        {
            if($order_rows && array_key_exists($value['share_order_id'],$order_rows))
            {
                $data['items'][$key]['order_status'] = $order_rows[$value['share_order_id']]['order_status'];
                $data['items'][$key]['order_status_str'] = $orderStateModel->orderState[$order_rows[$value['share_order_id']]['order_status']];
            }

            if($user_rows && array_key_exists($value['share_uid'],$user_rows))
            {
                $data['items'][$key]['user_name'] = $user_rows[$value['share_uid']]['user_account'];
            }
        }

        $YLB_Page->totalRows = $data['totalsize'];
        $page_nav            = $YLB_Page->prompt();

        if ('json' == $this->typ)
        {
            $this->data->addBody(-140, $data);
        }
        else
        {
            include $this->view->getView();
        }
	}
}

?>