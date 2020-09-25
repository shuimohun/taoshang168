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
//自动取消订单  订单生成24小时未付款的 已整理Zhenzh 20180410

$Order_BaseModel  = new Order_BaseModel();
$Order_GoodsModel = new Order_GoodsModel();
$Chain_GoodsModel = new Chain_GoodsModel();
$Goods_CommonModel = new Goods_CommonModel();
$Goods_BaseModel   = new Goods_BaseModel();

//开启事物
$Order_BaseModel->sql->startTransactionDb();

$cond_row['order_status']      = Order_StateModel::ORDER_WAIT_PAY;//状态为待支付
$cond_row['order_create_time:<'] = date('Y-m-d H:i:s',time() - YLB_Registry::get('wait_pay_time'));

$order_list = $Order_BaseModel->select('order_id,chain_id,shop_id',$cond_row,'','');

if($order_list)
{
    $order_row = array();
    foreach ($order_list as $key=>$value)
    {
        $order_row[$value['order_id']] = $value;
        $order_id[] = $value['order_id'];
    }

    if($order_id)
    {
        //获取订单商品
        $order_goods_row = $Order_GoodsModel->select('order_goods_id,order_id,goods_id,common_id,order_goods_num',array('order_id:IN' => $order_id));

        //取消订单
        $condition['order_status']          = Order_StateModel::ORDER_CANCEL;
        $condition['order_cancel_reason']   = '支付超时自动取消';
        $condition['order_cancel_identity'] = Order_BaseModel::IS_ADMIN_CANCEL;
        $condition['order_cancel_date']     = get_date_time();
        $flag = $Order_BaseModel->editBase($order_id, $condition);

        //修改订单商品表中的订单状态
        $order_goods_id = array_column('order_goods_id',$order_goods_row);
        $edit_row['order_goods_status'] = Order_StateModel::ORDER_CANCEL;
        $Order_GoodsModel->editGoods($order_goods_id, $edit_row);

        foreach ($order_goods_row as $key=>$value)
        {
            if(array_key_exists($value['order_id'],$order_row))
            {
                $order_base = $order_row[$value['order_id']];

                //是否是实体店库存
                if($order_base['chain_id'] != 0)
                {
                    $chain_cond_row['chain_id'] = $order_base['chain_id'];
                    $chain_cond_row['goods_id'] = $value['goods_id'];
                    $chain_cond_row['shop_id']  = $order_base['shop_id'];
                    $chain_goods_id = $Chain_GoodsModel->getKeyByWhere($chain_cond_row);
                    if($chain_goods_id)
                    {
                        $Chain_GoodsModel->editGoods(current($chain_goods_id), array('goods_stock'=>1),true);
                    }
                }
                else
                {
                    $edit_base_row = array('goods_stock' => $value['order_goods_num']);
                    $Goods_BaseModel->editBase($value['goods_id'], $edit_base_row,true);

                    $edit_common_row = array('common_stock' => $value['order_goods_num']);
                    $Goods_CommonModel->editCommon($value['common_id'], $edit_common_row,true);
                }
            }
        }

        //将需要取消的订单号远程发送给Paycenter修改订单状态
        //远程修改paycenter中的订单状态
        $key              = YLB_Registry::get('paycenter_api_key');
        $url              = YLB_Registry::get('paycenter_api_url');
        $paycenter_app_id = YLB_Registry::get('paycenter_app_id');
        $formvars         = array();

        $formvars['order_id'] = $order_id;
        $formvars['app_id']   = $paycenter_app_id;
        $formvars['type']	  = 'row';

        $rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_Pay_Pay&met=cancelOrder&typ=json', $url), $formvars);
    }
}
else
{
    $flag = true;
}

if ($flag && $Order_BaseModel->sql->commitDb())
{
	$msg    = _('success');
	$status = 200;
	$flag = true;
}
else
{
	$Order_BaseModel->sql->rollBackDb();
	$m      = $Order_BaseModel->msg->getMessages();
	$msg    = $m ? $m[0] : _('failure');
	$status = 250;
	$flag = false;
}

return $flag;
?>