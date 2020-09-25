<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     WenQingTeng
 */
class Payment_ChannelModel extends Payment_Channel
{
    //付款方式 1支付宝 2支付宝WAP 3微信 4微信内部 5 6财付宝 7 8
	const ALIPAY     = 1; //支付宝
    const ALIPAY_WAP = 2; //支付宝WAP
    const WECHAT     = 3; //微信
    const WECHAT_WAP = 4; //微信内部
	const TENPAY     = 5; //
	const MONEY      = 6; //财付宝
	const CARDS      = 7; //
	const UNIONPAY   = 8; //

	const ENABLE_NO = 0;
	const ENABLE_YES = 1;

	public static $configRows = array();

	/**
	 * 读取分页列表
	 *
	 * @param  int $payment_channel_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getChannelList($payment_channel_id = null, $page=1, $rows=100, $sort='asc')
	{
		//需要分页如何高效，易扩展
		$offset = $rows * ($page - 1);

		$this->sql->setLimit($offset, $rows);

		$payment_channel_id_row = array();
		$payment_channel_id_row = $this->selectKeyLimit();

		//读取主键信息
		$total = $this->getFoundRows();

		$data_rows = array();

		if ($payment_channel_id_row)
		{
			$data_rows = $this->getChannel($payment_channel_id_row);

			foreach ($data_rows as $k=>$data_row)
			{
				$data_row['id'] = $data_row['payment_channel_id'];
				$data_rows[$k] = $data_row;
			}
		}

		$data = array();
		$data['page'] = $page;
		$data['total'] = ceil_r($total / $rows);  //total page
		$data['totalsize'] = $data['total'];
		$data['records'] = count($data_rows);
		$data['items'] = array_values($data_rows);

		return $data;
	}

	/*
	 * 获取config
	 */
	public function getPaymentChannelValue($key)
	{
		if (YLB_Registry::isRegistered($key))
		{
			return YLB_Registry::get($key);
		}
		else
		{
			$config_row = array();

			$config_rows = $this->getConfig($key);

			if ($config_rows)
			{
				$config_row = array_pop($config_rows);

				if ('json' == $config_row['config_datatype'])
				{
					$config_row['config_value'] = decode_json($config_row['config_value']);
				}

				YLB_Registry::set($key, $config_row['config_value']);

			}

			return $config_row['config_value'];
		}
	}



	/**
	 * 此处可以先这样, 可以考虑生成PHP配置文件或者Cache
	 *
	 * @param  int $payment_channel_code 支付渠道code
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getChannelConfig($payment_channel_code)
	{
        $config_row = array();
        $data = $this->getMultiCond(array('payment_channel_code' => $payment_channel_code));

        if ($data)
        {
            $data_row   = array_pop($data);
            $config_row = $data_row['payment_channel_config'];
        }

		return $config_row;
	}

	public function getWayByKey($payment_channel_id=null)
	{
		$this->sql->setWhere('payment_channel_id',$payment_channel_id);
		$config_id_row = $this->selectKeyLimit();
		return $config_id_row;
	}
	public function getPayWaysByCode($payment_channel_code=null)
	{
		if($payment_channel_code)
		{
			$this->sql->setWhere('payment_channel_code',$payment_channel_code);
		}
		
		$code_ways_row = $this->getPaymentChannel('*');
		return $code_ways_row;
	}
}
?>