<?php if (!defined('ROOT_PATH')){exit('No Permission');}

/**
 * @author     Xinze <xinze@live.cn>
 */
class Payment_AlipayModel implements Payment_Interface
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
		$this->payment = $payment_row;
		$this->order   = $order_row;

		//↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
		//合作身份者id，以2088开头的16位纯数字
		$this->payment['partner'] = $payment_row['alipay_partner'];

		//收款支付宝账号，以2088开头由16位纯数字组成的字符串，一般情况下收款账号就是签约账号
		$this->payment['seller_id']	= $this->payment['partner'];

		//安全检验码，以数字和字母组成的32位字符
		//如果签名方式设置为“MD5”时，请设置该参数
		$this->payment['key'] = $payment_row['alipay_key'];

		//商户的私钥,此处填写原始私钥，RSA公私钥生成：https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.nBDxfy&treeId=58&articleId=103242&docType=1
		$this->payment['private_key_path'] = APP_PATH . '/data/api/alipay/key/rsa_private_key.pem';

		//支付宝公钥（后缀是.pen）文件相对路径
		//支付宝的公钥，查看地址：https://b.alipay.com/order/pidAndKey.htm
		$this->payment['ali_public_key_path'] = APP_PATH . '/data/api/alipay/key/alipay_public_key.pem';


		//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑

		//签名方式 不需修改
		$this->payment['sign_type'] = strtoupper('RSA');

		//字符编码格式 目前支持 gbk 或 utf-8
		$this->payment['input_charset'] = strtolower('utf-8');

		//ca证书路径地址，用于curl中ssl校验
		//请保证cacert.pem文件在当前文件夹目录中
		$this->payment['cacert'] = LIB_PATH . '/Api/alipay/cacert.pem';

		//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
		$this->payment['transport'] = 'http';

		// 支付类型 ，无需修改
		$this->payment['payment_type'] = "1";

		// 产品类型，无需修改
		$this->payment['service'] = "create_direct_pay_by_user";

		//服务器异步通知页面路径
		$this->payment['notify_url'] = YLB_Registry::get('base_url') . "/paycenter/api/payment/alipay/notify_url.php";
		//需http://格式的完整路径，不允许加?id=123这类自定义参数

		//页面跳转同步通知页面路径
		$this->payment['return_url'] = YLB_Registry::get('base_url') . "/paycenter/api/payment/alipay/return_url.php";
		//需http://格式的完整路径，不允许加?id=123这类自定义参数

		//操作中断返回地址
		$this->payment['merchant_url'] = YLB_Registry::get('base_url') . "/paycenter/api/payment/alipay/merchant_url.php";

		//用户付款中途退出返回商户的地址。需http://格式的完整路径，不允许加?id=123这类自定义参数

		//↓↓↓↓↓↓↓↓↓↓ 请在这里配置防钓鱼信息，如果没开通防钓鱼功能，为空即可 ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓

		// 防钓鱼时间戳  若要使用请调用类文件submit中的query_timestamp函数
		$this->payment['anti_phishing_key'] = "";

		// 客户端的IP地址 非局域网的外网IP地址，如：221.0.0.1
		$this->payment['exter_invoke_ip'] = "";

		//↑↑↑↑↑↑↑↑↑↑请在这里配置防钓鱼信息，如果没开通防钓鱼功能，为空即可 ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
	}

	/**
	 * 支付
	 *
	 * @access public
	 */
	public function pay($order_row)
	{
		if ($order_row)
		{
			$this->order = $order_row;
		}

		//1 == order_state_id  待付款状态
		if (1 != $this->order['order_state_id'])
		{
			throw new Exception('订单状态不为待付款状态');
		}


		include_once LIB_PATH . '/Api/alipay/lib/alipay_submit.class.php';

		//商户订单号
		$out_trade_no = $this->order['union_order_id'];
		//商户网站订单系统中唯一订单号，必填

        if(mb_strlen($this->order['trade_title'],'UTF8') > 42)
        {
            $this->order['trade_title'] = mb_substr($this->order['trade_title'], 0, 42, 'utf-8');
        }

		//订单名称
		$subject = $this->order['trade_title'];
		$body   = $this->order['trade_title'];
		//必填

		//付款金额
		$total_fee = $this->order['union_online_pay_amount'];

		$quantity = isset($this->order['quantity']) ? $this->order['quantity'] : 1;

		if(request_string('typ') == 'json')
		{
			//APP支付
            $partner = $this->payment['partner'];  //你的pid
            $seller_id = $this->payment['alipay_account'];  //seller_id
            $rsa_path = $this->payment['private_key_path'];  //rsa私钥路径
            $notify_url = $this->payment['notify_url'];    //接收支付结果通知url

            $data['service'] = 'mobile.securitypay.pay';
            $data['partner'] =$partner;
            $data['_input_charset'] = 'utf-8';
            $data['notify_url'] = $notify_url;
            $data['out_trade_no'] = $out_trade_no;
            $data['subject'] = $subject;
            $data['payment_type'] = '1';
            $data['seller_id'] = $seller_id;
            $data['total_fee'] = $total_fee;
            $data['body'] = $body;

			//签名
            $unsign_str = createLinkString(argSort($data));
            $sign = rsaSign($unsign_str, $rsa_path);
            $sign = urlencode(mb_convert_encoding($sign, "UTF-8"));  //需要进行utf8格式转换
            $order_str = $unsign_str . "&sign=" . $sign . "&sign_type=RSA";
            $data_str['order_str'] = $order_str;

            echo encode_json($data_str);die;

		}
		else
		{
			//PC支付
			//必填
            //构造要请求的参数数组，无需改动
            $parameter = array(
                "service"       => $this->payment['service'],
                "partner"       => $this->payment['partner'],
                "seller_id"     => $this->payment['seller_id'],
                "payment_type"	=> $this->payment['payment_type'],
                "notify_url"	=> $this->payment['notify_url'],
                "return_url"	=> $this->payment['return_url'],

                //"anti_phishing_key"=>$this->payment['anti_phishing_key'],
                //"exter_invoke_ip"=>$this->payment['exter_invoke_ip'],
                "out_trade_no"	=> $out_trade_no,
                "subject"	=> $subject,
                "total_fee"	=> $total_fee,
                "body"	=> $body,
                "_input_charset"	=> trim(strtolower($this->payment['input_charset'])),
                //其他业务参数根据在线开发文档，添加参数.文档地址:https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.kiX33I&treeId=62&articleId=103740&docType=1
                //如"参数名"=>"参数值"
                "extra_common_param"	=> ''
            );


            //建立请求
            $alipaySubmit = new AlipaySubmit($this->payment);

            $html_text    = $alipaySubmit->buildRequestForm($parameter, 'get', '确认');
            echo $html_text;
		}

	}


	/**
	 *
	 * 取得订单支付状态，成功或失败
	 * @param array $param
	 * @return array
	 */
	public function getPayResult($param)
	{
		return $param['trade_status'] == 'TRADE_SUCCESS';
	}

	/**
	 * 通知验证
	 *
	 * @access public
	 */
	public function verifyNotify()
	{
		include_once(LIB_PATH . "/Api/alipay/lib/alipay_notify.class.php");

		$alipayNotify  = new AlipayNotify($this->payment);
		$verify_result = $alipayNotify->verifyNotify();

		return $verify_result;
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
		$sign_str = '';

		$sign_str = $this->getSignature($parameter, $parameter['key']);

		return $sign_str;
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
		$notify_row = $this->getReturnData();

		$notify_row['deposit_async']         = 1;

		return $notify_row;
	}

	/**
	 * 得到同步返回数据
	 *
	 * @access public
	 */
	public function getReturnData($Consume_TradeModel = null)
	{
        /**
         * http://notify.java.jpxx.org/index.jsp?discount=0.00
		 * &payment_type=1
		 * &subject=测试
		 * &trade_no=2013082244524842
		 * &buyer_email=dlw***@gmail.com
		 * &gmt_create=2013-08-22 14:45:23
		 * &notify_type=trade_status_sync
		 * &quantity=1
		 * &out_trade_no=082215222612710
		 * &seller_id=2088501624816263
		 * &notify_time=2013-08-22 14:45:24
		 * &body=测试测试
		 * &trade_status=TRADE_SUCCESS
		 * &is_total_fee_adjust=N
		 * &total_fee=1.00
		 * &gmt_payment=2013-08-22 14:45:24
		 * &seller_email=xxx@alipay.com
		 * &price=1.00
		 * &buyer_id=2088602315385429
		 * &notify_id=64ce1b6ab92d00ede0ee56ade98fdf2f4c
		 * &use_coupon=N
		 * &sign_type=RSA
		 * &sign=1glihU9DPWee+UJ82u3+mw3Bdnr9u01at0M/xJnPsGuHh+JA5bk3zbWaoWhU6GmLab3dIM4JNdktTcEUI9/FBGhgfLO39BKX/eBCFQ3bXAmIZn4l26fiwoO613BptT44GTEtnPiQ6+tnLsGlVSrFZaLB9FVhrGfipH2SWJcnwYs=
         */


		$notify_param = $_REQUEST;
		if ($Consume_TradeModel)
		{
			$Union_OrderModel = new Union_OrderModel();

			$order_id = $notify_param['out_trade_no'];
			$notify_row = $Union_OrderModel->getOne($order_id);
			$notify_row['order_id'] = $notify_param['out_trade_no'];
		}
		else
		{
			//插入充值记录, 如果同步数据没有,从订单数据中读取过来
			$notify_row = array();

			$notify_row['order_id'] = $notify_param['out_trade_no'];
			$notify_row['deposit_trade_no'] = $notify_param['trade_no'];
			$notify_row['deposit_subject']      = $notify_param['subject'];
			$notify_row['deposit_body']          = isset($notify_param['body']) ? $notify_param['body'] : '';
			//$notify_row['deposit_buyer_email']  = $notify_param['buyer_email'];
			$notify_row['deposit_gmt_create']  = isset($notify_param['gmt_create']) ? $notify_param['gmt_create'] : '0000-00-00 00:00:00';
			$notify_row['deposit_notify_type']  = $notify_param['notify_type'];
			$notify_row['deposit_quantity']  = isset($notify_param['quantity']) ? $notify_param['quantity'] : '0';
			$notify_row['deposit_notify_time']  = $notify_param['notify_time'];
			$notify_row['deposit_seller_id']  = $notify_param['seller_id'];
			$notify_row['deposit_trade_status']  = $notify_param['trade_status'];
			$notify_row['deposit_is_total_fee_adjust']  = isset($notify_param['is_total_fee_adjust']) ? $notify_param['is_total_fee_adjust'] : 0;
			$notify_row['deposit_total_fee']  = $notify_param['total_fee'];
			$notify_row['deposit_gmt_payment']  = isset($notify_param['gmt_payment']) ? $notify_param['gmt_payment'] : '0000-00-00 00:00:00';
			//$notify_row['deposit_seller_email']  = $notify_param['seller_email'];
			$notify_row['deposit_gmt_close']  = isset($notify_param['gmt_close']) ? $notify_param['gmt_close'] : '0000-00-00 00:00:00';
			$notify_row['deposit_price']  =     isset($notify_param['price']) ? $notify_param['price'] : '0';
			$notify_row['deposit_buyer_id']  = $notify_param['buyer_id'];
			$notify_row['deposit_notify_id']  = $notify_param['notify_id'];
			$notify_row['deposit_use_coupon']  = isset($notify_param['use_coupon']) ? $notify_param['use_coupon'] : '';
			$notify_row['deposit_payment_type'] = $notify_param['payment_type'];

			$notify_row['deposit_extra_param']     = isset($notify_param['extra_param']) ? $notify_param['extra_param'] : '';
			$notify_row['deposit_service']     = isset($notify_param['exterface']) ? $notify_param['exterface'] : '';
			$notify_row['deposit_sign_type']    = $_REQUEST['sign_type'];
			$notify_row['deposit_sign']         = $_REQUEST['sign'];
		}

		//根据$notify_param['payment_type']  || $_REQUEST['service']可以判断其它类型
		$notify_row['payment_channel_id']   = Payment_ChannelModel::ALIPAY;
		return $notify_row;
	}

	/*public function refund($union_order,$amount)
	{
        if ($union_order['order_state_id'] < 2)
        {
            throw new Exception('订单未支付,不能申请退款');
        }

        include_once LIB_PATH . '/Api/alipay/lib/alipay_submit.class.php';
        $data['service'] 		= 'refund_fastpay_by_platform_pwd';
        $data['partner'] 		= $this->payment['partner'];
		$data['notify_url']     = $this->payment['notify_url'];
        $data['_input_charset'] = 'utf-8';
        $data['seller_user_id'] = $this->payment['seller_id'];
        $data['refund_date'] 	= date('Y-m-d H:i:s',time());
        $data['batch_no'] 		= date('YmdHis',time());
        $data['batch_num'] 		= 1;
        $data['detail_data'] 	= $union_order['trade_no'].'^'.$amount.'^退款';

        //建立请求
        $alipaySubmit = new AlipaySubmit($this->payment);
        $html_text    = $alipaySubmit->buildRequestForm($data, 'get', '确认');

        return $html_text;
    }*/
}

?>

