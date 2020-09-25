<?php if (!defined('ROOT_PATH')){exit('No Permission');}

/**
 * @author     Xinze <xinze@live.cn>
 */
class Payment_AliModel implements Payment_Interface
{
	/**
	 *支付宝网关地址（新）
	 */
	public $gateway_url = 'https://mapi.alipay.com/gateway.do?';

	/**
	 * 消息验证地址
	 *
	 * @var string
	 */
	private $verify_url = 'https://mapi.alipay.com/gateway.do?service=notify_verify&';

	/**
	 * 支付接口标识
	 *
	 * @var string
	 */
	private $code = 'alipay';

	/**
	 * 支付接口配置信息
	 *
	 * @var array
	 */
	private $payment;

	/**
	 * 订单信息
	 *
	 * @var array
	 */
	private $order;

	/**
	 * 发送至支付宝的参数
	 *
	 * @var array
	 */
	private $parameter;

	/**
	 * 订单类型 buy商品购买,   deposit预存款充值
	 * @var unknown
	 */
	private $order_type;


	/**
	 * Constructor
	 *
	 * @param  array $payment_row 支付平台信息
	 * @param  array $order_row 订单信息
	 * @access public
	 */
	public function __construct($payment_row = array(), $order_row = array())
	{
		//$this->payment = $payment_row;

        $this->payment = array (
            //应用ID,您的APPID。
            'app_id' => "2016112903565292",

            //商户私钥
            'merchant_private_key' => "MIIEpAIBAAKCAQEAwCmv+ojc5wRDx3g4CUKt/9GzzyD9h8WKC6XWbY1C5l+Z8Tn7Ffcq7Rs0V3I0hrOq6dP1J9aphmRM6ksMECFksTvglTb3JEfhaAB2OzdIWVrNiHcMvIUY7C9CgRjS0uIBNL9RKYkEHo4pcaVGwCGEVVdr9vOnQQa2RlwwkmoaDZMTwpIy+KOzTWf7us1Wa14A5BgoznIqRdS68S8AzREE13JVl6xO2S2pDHjIbmQ1S9ZOBOwEOg7NClzLgJ8F7mZ6KK9ZusUP6vBKu5XGAhTuCMfBWICOay474dlGiVJwU3CqKIqvPBMjDnhj/6yKbEgJPjjMBnx4kXN9sFdO+JgIxwIDAQABAoIBADMx6ARjOhcB99zIloVBEoI5KCJis6jcY+6+e+Yr4Ern5Wdy/wXXF8SbntI9RuksLLinE4VNl1SKnEM/QzN48g6V2TtnrWgpDlBa7yTPkaLcoi1dKjN/cihaXult55zvQUsAPWtHaaWKUlhIpBTD2TGzXLwqJcEZPK56GSaoxdAfjJoRGtkqaiiNd7nJksZsrqmY6LrNDE1TnE+VjdYBIcLgr9DIu1yBbVCZyTxTS7HwWYyaYlMBCn6MlIURNI0zm4nOAYl0nsINfcw/pb1P/YQmtK1aSkPaWcUe4+va7VvA0ZxpmG9ME4s7EmKkH0vENSuPRO2ktiWy+USwhRpbLMECgYEA66nd02OCa+HtkBmw0VKp5Xorwcy2esTvhndMvYcdrJp18TkRBqVNBHDiRXEBTS+ojGIRBx+C3DsCvrfG2BXtdeASV2LAkxg+5eXX2q5Y5FPe/kgaJEMN+rFYRcvop+1wc9DxAs1kOK30U7iStXjhs99/VzDth9Nya5UQGPTU1kkCgYEA0L7UjtHfBCpTTENuU3rjiaOjwvi73+mGdsKynphd2n788GZ1GY8fbb3pD8YDuForW/wPfqM04nJ3Y0RGHvjnJcBKvDVTIcL4tmOmUD8up2j01NVqO3/44Lh/7pPKLtFaoMVXzI79sn7MeHiBM1FNkfUIn95j5UU7Fs2pApi5po8CgYEApJguq27L76eLceLPoVN4ACO1HhVpuhOEK8l1GsadDimPiJxP7PFU+m4RS2ji/NL1iJ8Rv4TdtA2vHB9lTRT7liGbDdeWIuaDP7Spbz3oLgj6LWWUhJEk2Vw2CAGkDG2E5g8f1dI4VnIAvNyj8wVrtmK6IN62d/BR8Rvac2PEp6kCgYEAwq4GzP/8jwTuVMTaou6MQPSlqROTHDvN1Pq13WVauokOWyIi+ehaNl4Ue0qAc7FcmNgWl1Oc4chBggnNn9sgsDuLN8Y/ttAAZxG+rT6Pw0AGfmxfPAiY0vQfFCEvQcSsUh5aSQPepVbOWViBnpunzYUKOxcMcWnEtvqtMie/lQ8CgYAzdPDJ8LtI0ywc20Uw9GkI6dB6hVsDRhYQ48z9lHd8CtA3Ol3VYUw4FP2jicjmhkw0dS12LGFPZyOeUOUWW2JAw36LNErNHkTWcnL36v5iTZ/raP1Fso3u3GzBGNggCIDgizNoTVETDoQWpF0NRj/5jDlexkpuD+G/JQlu7Fdz5g==",

            //异步通知地址
            'notify_url' => YLB_Registry::get('base_url') . "/paycenter/api/payment/ali/notify_url.php",

            //同步跳转
            'return_url' => YLB_Registry::get('base_url') . "/paycenter/api/payment/ali/return_url.php",

            //编码格式
            'charset' => "UTF-8",

            //签名方式
            'sign_type'=>"RSA2",

            //支付宝网关
            'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

            //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
            'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAnN1ijU8jNnHQHBR/GaZ7gZv1b1Jd87/+Fpl2vCSc+sQGn/OcDd37VWKfNzHSb8FtcXKS9CxwkWfxJfF1WFihLVgvmuIdGsXXcCF1cujuHKsTeKSeT5JJO1Js+xmuX8ebT0IXhxQKrVXdU76BGcnGKTVumvKuZGw1R1lTr0jfjfG0U8/994IrYiV3vLbfVQzxhyOhBaJg7XaY00wJtQ8ZWnDctyJ/wWSVS3nzaQAJL+kedLHoiHnl+fkWXhZ66dE2QwIhtgJ0e78I1gykNwJ4135Oxjw10RQhJIZOrwvjX0vH2q8DZN6ifGquxGyFhIjBGUZFbn3U2HxfmQKL9zQ0gQIDAQAB",
        );

	}

	/**
	 * 支付
	 *
	 * @access public
	 */
	public function pay($order_row)
	{


	}


	/**
	 *
	 * 取得订单支付状态，成功或失败
	 * @param array $param
	 * @return array
	 */
	public function getPayResult($param)
	{
	}

	/**
	 * 通知验证
	 *
	 * @access public
	 */
	public function verifyNotify()
	{

	}

	/**
	 * 通知验证
	 *
	 * @access public
	 */
	public function verifyReturn()
	{
		include_once(LIB_PATH . "/Api/alipay/lib/alipay_notify.class.php");

		$alipayNotify  = new AlipayNotify($this->payment);
		$verify_result = $alipayNotify->verifyReturn();

		return $verify_result;
	}

	public function sign($parameter)
	{

	}

	public function getSignature($parameter, $cp_key = null)
	{
	}

	/**
	 * 制作支付接口的请求地址 发送请求
	 *
	 * @access public
	 */
	public function request()
	{
	}

	/**
	 * 得到异步返回数据
	 *
	 * @access public
	 */
	public function getNotifyData()
	{

	}

	/**
	 * 得到同步返回数据
	 *
	 * @access public
	 */
	public function getReturnData($Consume_TradeModel = null)
	{

	}

	public function refund($union_order,$return_code,$amount)
	{
        require_once LIB_PATH.'/Api/ali/pagepay/service/AlipayTradeService.php';
        require_once LIB_PATH.'/Api/ali/pagepay/buildermodel/AlipayTradeRefundContentBuilder.php';


        //商户订单号，商户网站订单系统中唯一订单号
        $out_trade_no = trim($union_order['union_order_id']);

        //支付宝交易号
        //$trade_no = trim($_POST['WIDTRtrade_no']);
        //请二选一设置

        //需要退款的金额，该金额不能大于订单金额，必填
        $refund_amount = trim($amount);

        //退款的原因说明
        $refund_reason = trim($union_order['trade_desc']);

        //标识一次退款请求，同一笔交易多次退款需要保证唯一，如需部分退款，则此参数必传
        $out_request_no = trim($return_code);

        //构造参数
        $RequestBuilder=new AlipayTradeRefundContentBuilder();
        $RequestBuilder->setOutTradeNo($out_trade_no);
        //$RequestBuilder->setTradeNo($trade_no);
        $RequestBuilder->setRefundAmount($refund_amount);
        $RequestBuilder->setOutRequestNo($out_request_no);
        $RequestBuilder->setRefundReason($refund_reason);

        $aop = new AlipayTradeService($this->payment);

        /**
         * alipay.trade.refund (统一收单交易退款接口)
         * @param $builder 业务参数，使用buildmodel中的对象生成。
         * @return $response 支付宝返回的信息
         */
        $response = $aop->Refund($RequestBuilder);

        return $response;

        /*stdClass Object
        (
            [code] => 10000
            [msg] => Success
            [buyer_logon_id] => zhe***@163.com
            [buyer_user_id] => 2088802164934083
            [fund_change] => Y
            [gmt_refund_pay] => 2018-03-10 13:38:58
            [out_trade_no] => U20180310104113581
            [refund_fee] => 0.01
            [send_back_fee] => 0.00
            [trade_no] => 2018031021001004080506719566
        )*/
    }
}

?>

