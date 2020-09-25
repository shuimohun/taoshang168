<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

class Waybill_KdBirdModel extends Waybill_Express
{
    private $EBusinessID;
    private $AppKey;
    private $ReqURL;
    private $ApiUrl;
    private $IpServiceUrl;

    /*
     * 整合了快递鸟电子面单和打印接口
     */
    public function __construct($db_id = 'shop', $user = null)
    {
        parent::__construct($db_id, $user);

        $this->EBusinessID = Web_ConfigModel::value('kuaidiniao_e_business_id');
        $this->AppKey = Web_ConfigModel::value('kuaidiniao_app_key');
        $this->ReqURL = 'http://api.kdniao.cc/api/EOrderService';

        $this->ApiUrl = 'http://www.kdniao.com/External/PrintOrder.aspx';
        $this->IpServiceUrl = 'http://www.kdniao.com/External/GetIp.aspx';
    }

    /**
     * Json方式 调用电子面单接口
     */
    function submitEOrder($requestData)
    {

        $datas = array(
            'EBusinessID' => $this->EBusinessID,
            'RequestType' => '1007',
            'RequestData' => urlencode($requestData) ,
            'DataType' => '2',
        );
        $datas['DataSign'] = $this->encrypt($requestData, $this->AppKey);

        $result = json_decode($this->sendPost($this->ReqURL, $datas),true);
        $order_list = [];
        //根据公司业务处理返回的信息......

        if ($result['ResultCode'] == 100)
        {
            $order_list['state'] = true;
            $order_list['Reason'] = $result['Reason'];
            $order_list['OrderCode'] = $result['Order']['OrderCode'];
            $order_list['LogisticCode'] = $result['Order']['LogisticCode'];
            $order_list['ShipperCode'] = $result['Order']['ShipperCode'];
        } else {
            $order_list['state'] = false;
            $order_list['Reason'] = $result['Reason'];
        }

        return $order_list;
    }

    /**
     *  post提交数据
     * @param  string $url 请求Url
     * @param  array $datas 提交的数据
     * @return url响应返回的html
     */
    function sendPost($url, $datas)
    {
        $temps = array();
        foreach ($datas as $key => $value) {
            $temps[] = sprintf('%s=%s', $key, $value);
        }
        $post_data = implode('&', $temps);
        $url_info = parse_url($url);
        if(empty($url_info['port']))
        {
            $url_info['port']=80;
        }
        $httpheader = "POST " . $url_info['path'] . " HTTP/1.0\r\n";
        $httpheader.= "Host:" . $url_info['host'] . "\r\n";
        $httpheader.= "Content-Type:application/x-www-form-urlencoded\r\n";
        $httpheader.= "Content-Length:" . strlen($post_data) . "\r\n";
        $httpheader.= "Connection:close\r\n\r\n";
        $httpheader.= $post_data;
        $fd = fsockopen($url_info['host'], $url_info['port']);
        fwrite($fd, $httpheader);
        $gets = "";
        $headerFlag = true;
        while (!feof($fd)) {
            if (($header = @fgets($fd)) && ($header == "\r\n" || $header == "\n")) {
                break;
            }
        }
        while (!feof($fd)) {
            $gets.= fread($fd, 128);
        }
        fclose($fd);

        return $gets;
    }

    /**
     * 电商Sign签名生成
     * @param data 内容
     * @param appkey Appkey
     * @return DataSign签名
     */
    function encrypt($data, $appkey)
    {
        return urlencode(base64_encode(md5($data.$appkey)));
    }

    /**************************************************************
     *
     *  使用特定function对数组中所有元素做处理
     *  @param  string  &$array     要处理的字符串
     *  @param  string  $function   要执行的函数
     *  @return boolean $apply_to_keys_also     是否也应用到key上
     *  @access public
     *
     *************************************************************/
    function arrayRecursive(&$array, $function, $apply_to_keys_also = false)
    {
        static $recursive_counter = 0;
        if (++$recursive_counter > 1000) {
            die('possible deep recursion attack');
        }
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $this->arrayRecursive($array[$key], $function, $apply_to_keys_also);
            } else {
                $array[$key] = $function($value);
            }

            if ($apply_to_keys_also && is_string($key)) {
                $new_key = $function($key);
                if ($new_key != $key) {
                    $array[$new_key] = $array[$key];
                    unset($array[$key]);
                }
            }
        }
        $recursive_counter--;
    }


    /**************************************************************
     *
     *  将数组转换为JSON字符串（兼容中文）
     *  @param  array   $array      要转换的数组
     *  @return string      转换得到的json字符串
     *  @access public
     *
     *************************************************************/
    function JSON($array)
    {
        $this->arrayRecursive($array, 'urlencode', true);
        $json = json_encode($array);
        return urldecode($json);
    }





}