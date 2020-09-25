<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}
/**
 * 支付入口
 * @author     Cbin
 */
class PayCtl extends Controller
{

	/**
	 *
	 * @param  string $ctl 控制器目录
	 * @param  string $met 控制器方法
	 * @param  string $typ 返回数据类型
	 * @access public
	 */
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);
        if(Perm::checkUserPerm())
        {

        }
	}

	/**
	 * 微信二维码支付
	 * 构造 url
	 * @param product_id产品ID
	 */
	public function structWXurl()
	{
		// 第一步 参数过滤
		$product_id  = trim($_REQUEST['product_id']);
		if (!$product_id || is_int($product_id))
		{
			$this->data->setError('参数错误');
			$this->data->printJSON();
			die;
		}

		// 第二步  调用url生成类
		$pw = new Payment_WxQrcodeModel();
		$url = $pw->url($product_id);
		include $this->view->getView();
	}

	/**
	 * 微信二维码支付
	 * 生成二维码
	 */
	public function structWXcode()
	{
		require_once MOD_PATH.'/Payment/phpqrcode/phpqrcode.php';
		$url = urldecode($_REQUEST["data"]);
		QRcode::png($url);
	}

	/**
	 * 微信二维码支付
	 * 微信回调
	 */
	public function WXnotify()
	{
		// 确定支付
		$pw = new Payment_WxQrcodeModel();
		$pw->notify();

		// 支付金额写入数据库
		// code
	}

	/**
	 * 使用余额支付
	 *
	 */
	public function money()
	{
		$trade_id = request_string('trade_id');

		//如果订单号为合并订单号，则获取合并订单号的信息
		$Union_OrderModel = new Union_OrderModel();

		//开启事物
		$Consume_DepositModel = new Consume_DepositModel();

		$uorder = $Union_OrderModel->getOne($trade_id);

		//判断当前用户是否是下单者
        if(Perm::$userId != $uorder['buyer_id'])
        {
            $this->data->addBody(-140, array(), '订单异常', 250);
            return false;
        }

        if($uorder['trade_payment_amount'] < 0)
        {
            $this->data->addBody(-140, array(), '订单异常', 250);
            return false;
        }

		$data = array();
        $payment_channel_id = Payment_ChannelModel::MONEY;
		if($uorder['union_cards_pay_amount'] > 0)
        {
            $payment_channel_id = Payment_ChannelModel::CARDS;
        }

		//修改订单表中的各种状态
		$flag = $Consume_DepositModel->notifyShop($trade_id,$uorder['buyer_id'],$payment_channel_id);

		if ($flag['status'] == 200)
		{
			//查找回调地址
			$User_AppModel = new User_AppModel();
			$user_app = $User_AppModel->getOne($uorder['app_id']);
			$return_app_url = $user_app['app_url'];

			$data['return_app_url'] = $return_app_url;

			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = _('failure');
			$status = 250;
		}

		$this->data->addBody(-140, $data, $msg, $status);
	}

	/**
	 * 使用充值卡支付
	 *
	 */
	public function cards()
	{
		$trade_id = request_string('trade_id');
		$card_code = request_string('card_code');

		//如果订单号为合并订单号，则获取合并订单号的信息
		$Union_OrderModel = new Union_OrderModel();

		//开启事物
		$Union_OrderModel->sql->startTransactionDb();
		$trade_row        = $Union_OrderModel->getOne($trade_id);

        $user_id = Perm::$userId;

        //判断当前用户是否是下单者
        if($user_id != $trade_row['buyer_id'])
        {
            $this->data->addBody(-140, array(), '订单异常', 250);
            return false;
        }

        if($trade_row['trade_payment_amount'] < 0)
        {
            $this->data->addBody(-140, array(), '订单异常', 250);
            return false;
        }


		if($trade_row)
		{
			//1.用户资源中订单金额冻结
			$User_ResourceModel = new User_ResourceModel();
			$flag = $User_ResourceModel->frozenUserCards($user_id,$card_code,$trade_row['trade_payment_amount']);

			if($flag)
			{
				//修改订单表中的支付方式
				$Consume_TradeModel = new Consume_TradeModel();
				$Consume_TradeModel->editConsumeTrade($trade_id,Payment_ChannelModel::CARDS);

				//修改订单表中的各种状态
				$Consume_DepositModel = new Consume_DepositModel();
				$data                 = $Consume_DepositModel->notifyShop($trade_id);
			}
		}
		else
		{
			$flag = false;
		}

		if ($flag && $Union_OrderModel->sql->commitDb())
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$Union_OrderModel->sql->rollBackDb();
			$m      = $Union_OrderModel->msg->getMessages();
			$msg    = $m ? $m[0] : _('failure');
			$status = 250;

		}
		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);
	}

	/**
	 * 使用支付宝支付
	 *
	 */
	public function alipay()
	{
		$trade_id = request_string('trade_id');
		$op = request_string('op');

		//如果订单号为合并订单号，则获取合并订单号的信息
		$Union_OrderModel = new Union_OrderModel();
		$trade_row        = $Union_OrderModel->getOne($trade_id);

		if ($trade_row)
		{
            //判断当前用户是否是下单者
            if(Perm::$userId != $trade_row['buyer_id'])
            {
                $error_msg = '订单异常';
                echo $error_msg;die;
            }

            if($trade_row['trade_payment_amount'] < 0)
            {
                $error_msg = '订单异常';
                echo $error_msg;die;
            }

            if ($trade_row['trade_payment_amount'] != $trade_row['union_online_pay_amount'] + $trade_row['union_money_pay_amount'] + $trade_row['union_cards_pay_amount'])
            {
                $error_msg = '订单异常';
                echo $error_msg;die;
            }

			$Payment = PaymentModel::create('alipay');
			$Payment->pay($trade_row);
		}
		else
		{
            $error_msg = '订单号不正确';
            echo $error_msg;die;
		}
	}
	
	/**
	 * 使用银联在线支付
	 *
	 */
	public function unionpay()
	{
		$trade_id = request_string('trade_id');
		$op = request_string('op');

		//如果订单号为合并订单号，则获取合并订单号的信息
		$Union_OrderModel = new Union_OrderModel();
		$trade_row        = $Union_OrderModel->getOne($trade_id);

		if ($trade_row)
		{
            //判断当前用户是否是下单者
            if(Perm::$userId != $trade_row['buyer_id'])
            {
                $this->data->addBody(-140, array(), '订单异常', 250);
                return false;
            }

            if($trade_row['trade_payment_amount'] < 0)
            {
                $this->data->addBody(-140, array(), '订单异常', 250);
                return false;
            }

			$Payment = PaymentModel::create('unionpay');
			$Payment->pay($trade_row);
		}
	}

	/**
	 * 使用微信支付
	 *
	 */
	public function wx_native()
	{
		$trade_id = request_string('trade_id');

		//如果订单号为合并订单号，则获取合并订单号的信息
		$Union_OrderModel = new Union_OrderModel();
		$trade_row        = $Union_OrderModel->getOne($trade_id);

		if ($trade_row)
		{
            //判断当前用户是否是下单者
            if(Perm::$userId != $trade_row['buyer_id'])
            {
                $error_msg = '订单异常';
                echo $error_msg;die;
            }

            if($trade_row['trade_payment_amount'] < 0)
            {
                $error_msg = '订单异常';
                echo $error_msg;die;
            }

            if ($trade_row['order_state_id'] == Union_OrderModel::WAIT_PAY)
            {
                if ($trade_row['trade_payment_amount'] == $trade_row['union_online_pay_amount'] + $trade_row['union_money_pay_amount'] + $trade_row['union_cards_pay_amount'])
                {
                    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false)
                    {
                        if(YLB_Utils_Device::isMobile())
                        {
                            //微信内置H5支付
                            $Payment = PaymentModel::create('wx_js');
                        }
                        else
                        {
                            $error_msg = '支付失败,不支持电脑端微信内置浏览器支付';
                            echo $error_msg;die;
                        }
                    }
                    else
                    {
                        //PC APP 非微信H5支付
                        $Payment = PaymentModel::create('wx_native');
                    }
                    $data = $Payment->pay($trade_row);

                    $this->view->setMet('index');
                    include $this->view->getView();
                }
                else
                {
                    $error_msg = '订单异常!';
                    echo $error_msg;die;
                }
            }
            else
            {
                $error_msg = '订单状态不为待付款状态';
                echo $error_msg;die;
            }
		}
		else
		{
            $error_msg = '订单号错误';
            echo $error_msg;die;
		}

	}

}