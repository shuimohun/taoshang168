<?php
/**
 * 功能：微信服务器异步通知页面
 */
require_once '../../../configs/config.ini.php';

$Payment_WxJsModel = PaymentModel::create('wx_js');
$verify_result     = $Payment_WxJsModel->verifyNotify();

YLB_Log::log('$verify_result=' . $verify_result, YLB_Log::INFO, 'pay_wxjs_notify');

//计算得出通知验证结果
if ($verify_result)
{
	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
	$notify_row = $Payment_WxJsModel->getNotifyData();

    if ($notify_row)
	{
        YLB_Log::log("p=" . json_encode($notify_row), YLB_Log::INFO, 'pay_wx');

        if($notify_row['order_state_id'] == Union_OrderModel::WAIT_PAY)
        {
            //插入充值记录
            $Consume_DepositModel = new Consume_DepositModel();
            //查找此支付单的交易类型
            $trade_type = Trade_TypeModel::$trade_type_row[$notify_row['trade_type_id']];

            //购物
            if($trade_type == 'shopping')
            {
                //处理一步回调-通知商城更新订单状态
                //修改订单表中的各种状态
                $Consume_DepositModel = new Consume_DepositModel();
                $rs                   = $Consume_DepositModel->notifyShop($notify_row['order_id'],$notify_row['buyer_id'],$notify_row['payment_channel_id'],$notify_row['deposit_trade_no']);
            }
            else if($trade_type == 'deposit')
            {
                //修改充值表的状态
                $Consume_DepositModel = new Consume_DepositModel();
                $rs = $Consume_DepositModel->notifyDeposit($notify_row['order_id'],$notify_row['buyer_id'],$notify_row['payment_channel_id']);
            }
        }

        echo "SUCCESS";        //请不要修改或删除
	}
	else
	{
		echo "FAIL";
		YLB_Log::log('Process-FAIL', YLB_Log::ERROR, 'pay_wxjs_notify_error');
		YLB_Log::log('Process-FAIL', YLB_Log::ERROR, 'pay_wxjs_notify');
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else
{
	//验证失败
	echo "FAIL";
	YLB_Log::log($error_msg, YLB_Log::ERROR, 'pay_wxjs_notify_error');
	YLB_Log::log($error_msg, YLB_Log::ERROR, 'pay_wxjs_notify');

}
?>