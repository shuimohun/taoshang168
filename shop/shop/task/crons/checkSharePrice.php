<?php
if (!defined('ROOT_PATH'))
{
	if (is_file('../../../shop/configs/config.ini.php'))
	{
		require_once '../../../shop/configs/config.ini.php';
	}
	else
	{
		die('请先运行index.php,生成应用程序框架结构！');
	}

	//不会重复包含, 否则会死循环: web调用不到此处, 通过crontab调用
	$Base_CronModel = new Base_CronModel();
	$rows = $Base_CronModel->checkTask(); //并非指执行自己, 将所有需要执行的都执行掉, 如果自己达到执行条件,也不执行.

	//终止执行下面内容, 否则会执行两次
	return ;
}


YLB_Log::log(__FILE__, YLB_Log::INFO, 'crontab');

$file_name_row = pathinfo(__FILE__);
$crontab_file = $file_name_row['basename'];

//执行任务
//自动确认分享金到账

$sharePriceModel = new Share_PriceModel();

//开启事物
$sharePriceModel->sql->startTransactionDb();

//获取所有冻结状态下 时间到 的分享
$cond_row['status'] = Share_PriceModel::FORZEN;
$cond_row['dz_date:<='] = time();
$share_price_rows = $sharePriceModel->listByWhere($cond_row,array('dz_date'=>'asc'));

$shop_api_key      = YLB_Registry::get('shop_api_key');
$paycenter_api_url = YLB_Registry::get('paycenter_api_url');
$shop_app_id       = YLB_Registry::get('shop_app_id');

if($share_price_rows['items'])
{
    $order_ids = [];
    $order_rows = [];
    $share_price_ids = [];

    foreach ($share_price_rows['items'] as $key => $val)
    {
        //点击量是否大于0 大于0的 存订单id 下面再取订单 小于0的存分享单id 下面修改状态
        if($val['promotion_click_count'] > 0)
        {
            $order_ids = $val['share_order_id'];
        }
        else
        {
            $share_price_ids[] = $val['id'];
        }
    }
    if($order_ids)
    {
        $orderBaseModel = new Order_BaseModel();
        $order_rows = $orderBaseModel->getByWhere(array('order_id:IN'=>$order_ids));
    }

    foreach ($share_price_rows['items'] as $key => $val)
    {
        if($order_rows && isset($order_rows[$val['share_order_id']]))
        {
            $order_base = $order_rows[$val['share_order_id']];
            if($order_base['order_status'] == Order_StateModel::ORDER_FINISH && $order_base['order_refund_status'] == Order_BaseModel::REFUND_NO && $order_base['order_return_status'] == Order_BaseModel::REFUND_NO)
            {
                //远程发送到paycenter 添加交易
                $formvars                          = array();
                $formvars['app_id']                = $shop_app_id;
                $formvars['buyer_user_id']         = $order_base['buyer_user_id'];
                $formvars['buyer_user_name']       = $order_base['buyer_user_name'];
                $formvars['seller_user_id']        = $order_base['seller_user_id'];
                $formvars['seller_user_name']      = $order_base['seller_user_name'];
                $formvars['promotion_unit_price']  = $val['promotion_unit_price'];
                $formvars['promotion_click_count'] = $val['promotion_click_count'];
                $formvars['promotion_total_price'] = $val['promotion_total_price'];
                $formvars['share_order_id']        = $val['share_order_id'];
                $formvars['dz_date']               = $val['dz_date'];

                $rs = get_url_with_encrypt($shop_api_key, sprintf('%s?ctl=Api_Pay_Pay&met=editSharePrice&typ=json', $paycenter_api_url), $formvars);
                if($rs['status'] == 200)
                {
                    $share_price_ids[] = $val['id'];
                }
            }
            else
            {
                $share_price_ids[] = $val['id'];
            }
        }
    }

    $flag = $sharePriceModel ->editSharePrice($share_price_ids,array('status'=>Share_PriceModel::FINISH));

}

if ($flag && $sharePriceModel->sql->commitDb())
{
	$status = 200;
	$msg    = _('success');
}
else
{
    $sharePriceModel->sql->rollBackDb();
	$m      = $sharePriceModel->msg->getMessages();
	$msg    = $m ? $m[0] : _('failure');
	$status = 250;
}


return $flag;
?>