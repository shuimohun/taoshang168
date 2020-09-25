<?php
/* *
 * 功能：支付宝服务器异步通知页面
 * 版本：3.3
 * 日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。


 *************************页面功能说明*************************
 * 创建该页面文件时，请留心该页面文件中无任何HTML代码及空格。
 * 该页面不能在本机电脑测试，请到服务器上做测试。请确保外部可以访问该页面。
 * 该页面调试工具请使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyNotify
 * 如果没有收到该页面返回的 success 信息，支付宝会在24小时内按一定的时间策略重发通知
 */
require_once '../../../configs/config.ini.php';

YLB_Log::log("r=" . json_encode($_REQUEST), YLB_Log::INFO, 'pay_alipay_notify');
YLB_Log::log("p=" . json_encode($_POST), YLB_Log::INFO, 'pay_alipay_notify');

$Payment_AlipayModel = PaymentModel::create('alipay');
$verify_result          = $Payment_AlipayModel->verifyNotify();

//计算得出通知验证结果
if ($verify_result)
{
    if (isset($_REQUEST['trade_status']))
    {
        if ($_REQUEST['trade_status'] == 'TRADE_FINISHED' || $_REQUEST['trade_status'] == 'TRADE_SUCCESS')
        {
            //验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代

            $notify_row = $Payment_AlipayModel->getNotifyData();
            if ($notify_row)
            {
                $Consume_TradeModel = new Consume_TradeModel();
                $notify_row = $Payment_AlipayModel->getReturnData($Consume_TradeModel);

                //查找此支付单的交易类型
                $Union_OrderModel = new Union_OrderModel();
                $data = $Union_OrderModel->getOne($notify_row['order_id']);

                if($data['order_state_id'] == $Union_OrderModel::WAIT_PAY)
                {
                    $trade_type = Trade_TypeModel::$trade_type_row[$data['trade_type_id']];

                    if($trade_type == 'shopping')
                    {
                        YLB_Log::log("shopping=" . json_encode($notify_row), YLB_Log::INFO, 'pay_alipay_notify');
                        //修改订单表中的各种状态
                        $Consume_DepositModel = new Consume_DepositModel();
                        $rs                   = $Consume_DepositModel->notifyShop($notify_row['order_id'],$notify_row['buyer_id'],$notify_row['payment_channel_id']);

                    }

                    if($trade_type == 'deposit')
                    {
                        //修改充值表的状态
                        $Consume_DepositModel = new Consume_DepositModel();
                        $rs = $Consume_DepositModel->notifyDeposit($notify_row['order_id'],$notify_row['buyer_id'],$notify_row['payment_channel_id']);
                    }

                    if ($rs)
                    {
                        //重定向浏览器
                        if($trade_type == 'shopping')
                        {
                            $app_id = $data['app_id'];

                            //查找回调地址
                            $User_AppModel = new User_AppModel();
                            $user_app = $User_AppModel->getOne($app_id);
                            $return_app_url = $user_app['app_url'];
                        }

                        if($trade_type == 'deposit')
                        {
                            $return_app_url = YLB_Registry::get('paycenter_api_url')."?ctl=Info&met=index";
                        }

                        //确保重定向后，后续代码不会被执行
                        echo "success";
                    }
                    else
                    {
                        echo "fail";
                    }
                }
            }
            else
            {
                echo "fail";
            }
        }
    }

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else
{
	//验证失败
	echo "fail";
	YLB_Log::log($error_msg, YLB_Log::ERROR, 'pay_alipay_notify_error');
	YLB_Log::log($error_msg, YLB_Log::ERROR, 'pay_alipay_notify');
	exit($error_msg);

	//调试用，写文本函数记录程序运行情况是否正常
	//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
}
?>