<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

require_once LIB_PATH . '/Api/wx/lib/WxPay.Api.php';
require_once LIB_PATH . '/Api/wx/lib/WxPay.Notify.php';

/**
 * @author     WenQingTeng
 */
class Payment_WxJsModel extends WxPayNotify implements Payment_Interface {
    /**
     * 支付接口标识
     *
     * @var string
     */
    private $code = 'wx_js';

    /**
     * 支付接口配置信息
     *
     * @var array
     */
    public $payment;

    /**
     * 订单信息
     *
     * @var array
     */
    public $order;

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
     * 通知结果
     * @var unknown
     */
    private $verifyResult = false;
    private $verifyData   = array();

    private $returnResult = false;
    private $returnData   = array();

    /**
     * Constructor
     *
     * @param  array $payment_row 支付平台信息
     * @param  array $order_row   订单信息
     *
     * @access public
     */
    public function __construct($payment_row = array(), $order_row = array())
    {
        $this->payment = $payment_row;
        $this->order   = $order_row;


        /**
         * TODO: 修改这里配置为您自己申请的商户信息
         * 微信公众号信息配置
         *
         * APPID：绑定支付的APPID（必须配置，开户邮件中可查看）
         *
         * MCHID：商户号（必须配置，开户邮件中可查看）
         *
         * KEY：商户支付密钥，参考开户邮件设置（必须配置，登录商户平台自行设置）
         * 设置地址：https://pay.weixin.qq.com/index.php/account/api_cert
         *
         * APPSECRET：公众帐号secert（仅JSAPI支付的时候需要配置， 登录公众平台，进入开发者中心可设置），
         * 获取地址：https://mp.weixin.qq.com/advanced/advanced?action=dev&t=advanced/dev&token=2005451881&lang=zh_CN
         * @var string
         */
        $this->payment['appid']     = $payment_row['appid'];
        $this->payment['mchid']     = $payment_row['mchid'];
        $this->payment['key']       = $payment_row['key'];
        $this->payment['appsecret'] = $payment_row['appsecret'];

        //=======【证书路径设置】=====================================
        /**
         * TODO：设置商户证书路径
         * 证书路径,注意应该填写绝对路径（仅退款、撤销订单时需要，可登录商户平台下载，
         * API证书下载地址：https://pay.weixin.qq.com/index.php/account/api_cert，下载之前需要安装商户操作证书）
         * @var path
         */
        $this->payment['sslcert_path'] = LIB_PATH . '/Api/wx/cert_js/apiclient_cert.pem';
        $this->payment['sslkey_path']  = LIB_PATH . '/Api/wx/cert_js/apiclient_key.pem';


        //=======【curl代理设置】===================================
        /**
         * TODO：这里设置代理机器，只有需要代理的时候才设置，不需要代理，请设置为0.0.0.0和0
         * 本例程通过curl使用HTTP POST方法，此处可修改代理服务器，
         * 默认CURL_PROXY_HOST=0.0.0.0和CURL_PROXY_PORT=0，此时不开启代理（如有需要才设置）
         * @var unknown_type
         */

        $this->payment['curl_proxy_host'] = "0.0.0.0";//"10.152.18.220";
        $this->payment['curl_proxy_port'] = 0;//8080;

        //=======【上报信息配置】===================================
        /**
         * TODO：接口调用上报等级，默认紧错误上报（注意：上报超时间为【1s】，上报无论成败【永不抛出异常】，
         * 不会影响接口调用流程），开启上报之后，方便微信监控请求调用的质量，建议至少
         * 开启错误上报。
         * 上报等级，0.关闭上报; 1.仅错误出错上报; 2.全量上报
         * @var int
         */
        $this->payment['report_levenl'] = 1;


        //↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
        // 支付类型 ，无需修改
        $this->payment['payment_type'] = "NATIVE";

        //服务器异步通知页面路径
        $this->payment['notify_url'] = YLB_Registry::get('base_url') . "/paycenter/api/payment/wx/notify.php";
        //需http://格式的完整路径，不允许加?id=123这类自定义参数

        //页面跳转同步通知页面路径
        $this->payment['return_url'] = YLB_Registry::get('base_url') . "/paycenter/api/payment/wx/return_url.php";
        //需http://格式的完整路径，不允许加?id=123这类自定义参数


        //检测订单状态url
        $this->payment['check_url'] = YLB_Registry::get('base_url') . "/paycenter/api/payment/wx/check_url.php";

        //操作中断返回地址
        $this->payment['merchant_url'] = YLB_Registry::get('base_url') . "/paycenter/api/payment/wx/merchant_url.php";
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

        //商户订单号
        $out_trade_no = $this->order['union_order_id'];
        //商户网站订单系统中唯一订单号，必填

        //订单名称
        $subject      = $this->order['trade_title'];
        if(mb_strlen($subject,'UTF8') > 42)
        {
            $subject = mb_substr($subject, 0, 42, 'utf-8');
        }
        $detail       = isset($this->order['trade_desc']) ? $this->order['trade_desc'] : '';
        $trade_remark = isset($this->order['trade_remark']) ? $this->order['trade_remark'] : '';
        //必填

        //付款金额
        $total_fee = $this->order['union_online_pay_amount'];

        $quantity = isset($this->order['quantity']) ? $this->order['quantity'] : 1;

        $extra_common_param = '';

        $time = time();

        include_once LIB_PATH . '/Api/wx/WxPay.JsApiPay.php';

        //①、获取用户openid
        $tools  = new JsApiPay();
        $openId = $tools->GetOpenid();

        //②、统一下单
        $input = new WxPayUnifiedOrder();
        $input->SetBody($subject);
        $input->SetAttach($extra_common_param);
        $input->SetOut_trade_no($out_trade_no);
        $input->SetTotal_fee($total_fee * 100);
        $input->SetTime_start(date("YmdHis"), $time);
        $input->SetTime_expire(date("YmdHis", $time + 60 * 10));
        $input->SetGoods_tag($trade_remark);
        $input->SetNotify_url($this->payment['notify_url']);
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);

        $result = WxPayApi::unifiedOrder($input);

        if ($result && 'SUCCESS' == $result['result_code'])
        {

        }
        else
        {
            YLB_Log::log('GetPayUrl RES:=' . encode_json($result), YLB_Log::INFO, 'pay_wxjs_info');
            throw new Exception(encode_json($result));
        }


        $jsApiParameters = $tools->GetJsApiParameters($result);

        //获取共享收货地址js函数参数
        $editAddress = $tools->GetEditAddressParameters();


        //③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
        /**
         * 注意：
         * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
         * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
         * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
         */


        if ($jsApiParameters)
        {

        }
        else
        {
            YLB_Log::log('GetPayUrl RES:=' . encode_json($jsApiParameters), YLB_Log::INFO, 'pay_wxjs_info');
            throw new Exception(encode_json($jsApiParameters));
        }

        $app_id = $this->order['app_id'];

        //查找回调地址
        $User_AppModel = new User_AppModel();
        $user_app      = $User_AppModel->getOne($app_id);
        $return_url    = $user_app['app_url'].'?ctl=Buyer_Order&met=physical';

        print <<<EOT
        <html>
        <head>
            <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
            <meta name="viewport" content="width=device-width, initial-scale=1"/> 
            <title>微信支付</title>
            <script type="text/javascript">
            //调用微信JS api 支付
            function jsApiCall()
            {
                WeixinJSBridge.invoke(
                    'getBrandWCPayRequest',
                    {$jsApiParameters},
                    function(res){
                        WeixinJSBridge.log(res.err_msg);
                        
                        
                        if (res.err_msg == "get_brand_wcpay_request:ok")
                        {
                            //alert('支付成功');
                            window.location.href = "{$return_url}";
                        }
                        else
                        {
                            if (res.err_msg == "get_brand_wcpay_request:cancel")
                            {
                                    //alert('取消支付');
                                history.back(-1);
                            }
                            else
                            {
                                alert(res.err_code+res.err_desc+res.err_msg);
                                history.back(-1);
                            }
                        }
                    }
                );
            }
        
            function callpay()
            {
                if (typeof WeixinJSBridge == "undefined"){
                    if( document.addEventListener ){
                        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
                    }else if (document.attachEvent){
                        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
                        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
                    }
                }else{
                    jsApiCall();
                }
            }
            window.onload = function(){
                if (typeof WeixinJSBridge == "undefined"){
                    if( document.addEventListener ){
                        document.addEventListener('WeixinJSBridgeReady', callpay, false);
                    }else if (document.attachEvent){
                        document.attachEvent('WeixinJSBridgeReady', callpay); 
                        document.attachEvent('onWeixinJSBridgeReady', callpay);
                    }
                }else{
                    callpay();
                }
            };
            
            </script>
        </head>
        <body>
        </body>
        </html>
EOT;
        die();
    }

    /**
     *
     * 取得订单支付状态，成功或失败
     *
     * @param array $param
     *
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
        $this->Handle(false);

        return $this->verifyResult;
    }

    /**
     * 通知验证
     *
     * @access public
     */
    public function verifyReturn()
    {
        $this->Handle(false);

        return $this->returnResult;
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

        $notify_row['deposit_async'] = 1;

        return $notify_row;
    }

    /**
     * 得到同步返回数据
     *
     * @access public
     */
    public function getReturnData($Consume_TradeModel = null)
    {
        $notify_param = $this->verifyData;

        if (!$Consume_TradeModel)
        {
            $Union_OrderModel = new Union_OrderModel();

            $order_id               = $notify_param['out_trade_no'];
            $notify_row             = $Union_OrderModel->getOne($order_id);
            $notify_row['order_id'] = $notify_param['out_trade_no'];
            $notify_row['deposit_trade_no'] = $notify_param['transaction_id'];
        }
        else
        {
            //插入充值记录, 如果同步数据没有,从订单数据中读取过来
            $notify_row = array();

            $notify_row['order_id']         = $notify_param['out_trade_no'];
            $notify_row['deposit_trade_no'] = $notify_param['transaction_id'];

            $notify_row['deposit_quantity']    = isset($notify_param['quantity']) ? $notify_param['quantity'] : '0';
            $notify_row['deposit_notify_time'] = date('Y-m-d H:i:s');
            $notify_row['deposit_seller_id']   = $notify_param['mch_id'];

            $notify_row['deposit_is_total_fee_adjust'] = isset($notify_param['is_total_fee_adjust']) ? $notify_param['is_total_fee_adjust'] : 0;
            $notify_row['deposit_total_fee']           = $notify_param['total_fee'] / 100;

            $notify_row['deposit_price']        = isset($notify_param['cash_fee']) ? $notify_param['cash_fee'] / 100 : '0';
            $notify_row['deposit_buyer_id']     = $notify_param['openid'];
            $notify_row['deposit_payment_type'] = $notify_param['bank_type'] . '|' . $notify_param['fee_type'];

            $notify_row['deposit_service'] = isset($notify_param['trade_type']) ? $notify_param['trade_type'] : '';
            $notify_row['deposit_sign']    = isset($notify_param['sign']) ? $notify_param['sign'] : '';

            $notify_row['deposit_extra_param'] = encode_json($notify_param);
        }

        //根据$notify_param['payment_type']  || $_REQUEST['service']可以判断其它类型
        $notify_row['payment_channel_id'] = Payment_ChannelModel::WECHAT_WAP;
        return $notify_row;
    }

    //查询订单
    public function Queryorder($transaction_id)
    {
        $input = new WxPayOrderQuery();
        $input->SetTransaction_id($transaction_id);
        $result = WxPayApi::orderQuery($input);

        YLB_Log::log("query:" . json_encode($result), YLB_Log::INFO, 'pay_wxnative_notify');

        if (array_key_exists("return_code", $result) && array_key_exists("result_code",
                $result) && $result["return_code"] == "SUCCESS" && $result["result_code"] == "SUCCESS"
        )
        {
            return true;
        }

        return false;
    }

    //重写回调处理函数
    public function NotifyProcess($data, &$msg)
    {
        YLB_Log::log("call back:" . json_encode($data), YLB_Log::INFO, 'pay_wxnative_notify');
        $notfiyOutput = array();

        if (!array_key_exists("transaction_id", $data))
        {
            $msg = "输入参数不正确";

            return false;
        }
        //查询订单，判断订单真实性
        if (!$this->Queryorder($data["transaction_id"]))
        {
            $msg = "订单查询失败";

            return false;
        }

        $this->verifyResult = true;
        $this->verifyData   = $data;

        YLB_Log::log('$data:' . encode_json($data), YLB_Log::INFO, 'pay_wxnative_notify');

        return true;
    }

    /**
     * 退款 Zhenzh 20180130
     *
     * @param $union_order 支付订单
     * @param $return_code 退款单号
     * @param $refund_fee  退款金额
     * @return 成功时返回
     */
    public function refund($union_order,$return_code,$refund_fee)
    {
        $out_trade_no = $union_order["union_order_id"];
        $total_fee    = $union_order["trade_payment_amount"];

        $input = new WxPayRefund();
        $input->SetOut_trade_no($out_trade_no);
        $input->SetTotal_fee($total_fee * 100);
        $input->SetRefund_fee($refund_fee * 100);
        $input->SetOut_refund_no($return_code);
        $input->SetOp_user_id(WxPayConfig::MCHID);

        $result = WxPayApi::refund($input);
        return $result;

        /*Array
        (
            [appid] => wx7c9bd0e5a3b798c3
            [cash_fee] => 1
            [cash_refund_fee] => 1
            [coupon_refund_count] => 0
            [coupon_refund_fee] => 0
            [mch_id] => 1418794102
            [nonce_str] => T5cBXB8ckwctoE4x
            [out_refund_no] => U20180203023201946
            [out_trade_no] => U20180203023201946
            [refund_channel] => Array
            (
            )

            [refund_fee] => 1
            [refund_id] => 50000705442018020303419238584
            [result_code] => SUCCESS
            [return_code] => SUCCESS
            [return_msg] => OK
            [sign] => 310637C0DA5DAADEF2914358C5A22812
            [total_fee] => 1
            [transaction_id] => 4200000053201802036294760327
        )*/
    }
}

?>


