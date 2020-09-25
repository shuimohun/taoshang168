<?php
/**
 * 
 * 通过这个类，统一管理支付类。
 * 
 * @category   Framework
 * @package    Db
 * @author     WenQingTeng
 * @copyright  Copyright (c) 2017, 温庆腾
 * @version    1.0
 * @todo       
 */
class PaymentModel
{

    /**
     * 构造函数
     *
     * @access    private
     */
    public function __construct()
    {
    }

    /**
     * 得到支付句柄
     *
     * @param array  $channel   使用的支付驱动
     *
     * @return Object   Payment Object
     *
     * @access public
     */
    public static function create($channel)
    {
        $PaymentModel = null;

        $Payment_ChannelModel = new Payment_ChannelModel();

        $Cache = YLB_Cache::create('base');
        $cache_key = $Payment_ChannelModel->_cacheKeyPrefix . 'payment_channel_id|' . $channel;
        if ($config_row = $Cache->get($cache_key))
        {

        }
        else
        {
            $config_row = $Payment_ChannelModel->getChannelConfig($channel);
            $Cache->save($config_row, $cache_key);
        }

		if (!$config_row)
		{
			throw new Exception(_('支付配置数据错误!'));
		}


        if ('alipay' == $channel)
        {
            //如果是微信内置浏览器
            if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false )
            {
                return null;
            }

            if(YLB_Utils_Device::isMobile())
            {
                //H5支付
                $PaymentModel = new Payment_AlipayWapModel($config_row);
            }
            else
            {
                //PC App
                $PaymentModel = new Payment_AlipayModel($config_row);
            }
        }
        elseif ('ali' == $channel)
        {
            $PaymentModel = new Payment_AliModel($config_row);
        }
        elseif ('tenpay' == $channel)
        {
            $PaymentModel = new Payment_TenpayModel($config_row);
        }
        elseif ('tenpay_wap' == $channel)
        {
            $PaymentModel = new Payment_TenpayWapModel($config_row);
        }
		elseif ('unionpay' == $channel)
		{
			$PaymentModel = new Payment_UnionPayModel($config_row);
		}
        elseif ('wx_native' == $channel || 'wx_js' == $channel)
        {

            //微信变量, 不变动程序,修正数据
            !defined('APPID_DEF') && define('APPID_DEF', $config_row['appid']);
            !defined('MCHID_DEF') && define('MCHID_DEF', $config_row['mchid']);
            !defined('KEY_DEF') && define('KEY_DEF', $config_row['key']);
            !defined('APPSECRET_DEF') && define('APPSECRET_DEF', $config_row['appsecret']);

            if ($channel == 'wx_js' || strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false )
            {
                !defined('SSLCERT_PATH_DEF') && define('SSLCERT_PATH_DEF', LIB_PATH . '/Api/wx/cert_js/apiclient_cert.pem');
                !defined('SSLKEY_PATH_DEF') && define('SSLKEY_PATH_DEF', LIB_PATH . '/Api/wx/cert_js/apiclient_key.pem');
                $PaymentModel = new Payment_WxJsModel($config_row);
            }
            else
            {
                !defined('SSLCERT_PATH_DEF') && define('SSLCERT_PATH_DEF', LIB_PATH . '/Api/wx/cert/apiclient_cert.pem');
                !defined('SSLKEY_PATH_DEF') && define('SSLKEY_PATH_DEF', LIB_PATH . '/Api/wx/cert/apiclient_key.pem');
                $PaymentModel = new Payment_WxNativeModel($config_row);
            }
        }
        else
        {
        }

        return $PaymentModel;
    }

    /**
     * 得到支付句柄
     *
     * @param array  $channel   使用的支付驱动
     *
     * @return Object   Payment Object
     *
     * @access public
     */
    public static function get($channel)
    {
        return self::create($channel);
    }

    //Zhenzh 20180130
    public static function refund($union_order)
    {
        //根据支付方式 退款

        if($union_order['payment_channel_id'] == Payment_ChannelModel::WECHAT)
        {
            //微信
            $channel = 'wx_native';
        }
        else if($union_order['payment_channel_id'] == Payment_ChannelModel::WECHAT_WAP)
        {
            //微信内部浏览器
            $channel = 'wx_js';
        }
        else if($union_order['payment_channel_id'] == Payment_ChannelModel::ALIPAY || $union_order['payment_channel_id'] == Payment_ChannelModel::ALIPAY_WAP)
        {
            //支付宝
            $channel = 'alipay';
        }

        $Payment_ChannelModel = new Payment_ChannelModel();
        $Cache = YLB_Cache::create('base');
        $cache_key = $Payment_ChannelModel->_cacheKeyPrefix . 'payment_channel_id|' . $channel;
        if ($config_row = $Cache->get($cache_key))
        {

        }
        else
        {
            $config_row = $Payment_ChannelModel->getChannelConfig($channel);
            $Cache->save($config_row, $cache_key);
        }

        if (!$config_row)
        {
            throw new Exception(_('支付配置数据错误!'));
        }

        $PaymentModel = null;

        //$data = $Payment->refund($union_order);
    }
}
?>