<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author      Zhenzh
 */
class Share_BaseModel extends Share_Base
{

    const SQQ = 0.1;
    const QZONE = 0.1;
    const WEIXIN = 0.1;
    const WEIXIN_TIMELINE = 0.1;
    const TSINA = 0.1;
    const TOTAL_PRICE = 0.5;
    const LIMIT = 1;
    const IS_PROMOTION = 1;
    const PROMOTION_TOTAL_PEICE = 0.1;
    const PROMOTION_UNIT_PEICE = 0.1;

	public function __construct()
	{
		parent::__construct();
	}

    /**
     * 增加
     * @param $field_row
     * @param bool $return_insert_id
     * @return bool
     */
    public function addShare($field_row, $return_insert_id=false)
    {
        $add_flag = $this->add($field_row, $return_insert_id);
        return $add_flag;
    }

    /**
     * 删除
     * @param $config_key
     * @return bool
     */
    public function removeShare($config_key)
    {
        $del_flag = $this->remove($config_key);
        return $del_flag;
    }

    /**
     * 修改
     * @param null $config_key
     * @param $field_row
     * @return bool
     */
    public function editShare($config_key = null, $field_row,$flag=null)
    {
        $update_flag = $this->edit($config_key, $field_row,$flag);

        return $update_flag;
    }

    /**
     * 读取分页列表
     * @param array $cond_row
     * @param array $order_row
     * @param int $page
     * @param int $rows
     * @return array|int
     */
	public function getShareList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
		$rows = $this->listByWhere($cond_row, $order_row, $page, $rows);

		return $rows;
	}

    /**
     * 多条件获取所有分享
     * @param array $cond_row
     * @param array $order_row
     * @return array
     */
    public function getAllShareByWhere($cond_row=array(), $order_row = array())
    {
        return $this->getByWhere($cond_row,$order_row);
    }


    /**
     * 多条件获取单个分享信息
     * @param $cond_row
     * @return array 
     */
	public function getOneShareByWhere($cond_row)
	{
		return $this->getOneByWhere($cond_row);
	}

    /**
     * 根据common_id获取分享的信息 包括是否分享
     * @param $common_id
     * @return array
     */
    public function getShareByCommonId($common_id)
    {
        $cond_row['common_id'] = $common_id;
        return $this->getShare($cond_row);
    }

    /**
     * 根据b_id获取分享的信息 包括是否分享
     * @param $b_id
     * @return array
     */
    public function getShareByBId($b_id)
    {
        $cond_row['b_id'] = $b_id;
        return $this->getShare($cond_row);
    }

    /**
     * 获取分享的信息 包括是否分享
     * @param $cond_row
     * @return array
     */
	public function getShare($cond_row)
    {
        $data = $this -> getOneByWhere($cond_row);
        $share_info['price']['price'] = 0;
        if($data)
        {
            //是否登录 登录的获取分享信息
            if(Perm::checkUserPerm() && Perm::$userId)
            {
                $sharePriceModel    = new Share_PriceModel();
                $cond_row['share_uid'] = Perm::$userId;
                //$cond_row['status'] =  Share_PriceModel::ACTIVE;
                $price_order['id'] = 'DESC';
                $share_price = $sharePriceModel -> getOneByWhere($cond_row,$price_order);
                //是否分享过
                if($share_price)
                {
                    //已经分享过
                    $share_order_id = $share_price['share_order_id'];//最近的一单订单号
                    if($share_order_id == '0')
                    {
                        $data['price'] = $share_price;
                    }
                    else
                    {
                        $order_model = new Order_BaseModel();
                        $order = $order_model -> getOneByWhere(array('order_id'=>$share_order_id));

                        if($order['order_status'] == Order_StateModel::ORDER_WAIT_PAY)
                        {
                            $data['order_wait_pay'] = 1;
                        }
                        else if($order['order_status'] > Order_StateModel::ORDER_WAIT_PAY && $order['order_status'] < Order_StateModel::ORDER_CANCEL )
                        {
                            if($order['payment_id'] == 1)
                            {
                                $payment_time = strtotime($order['payment_time']);
                            }
                            else if($order['payment_id'] == 2)
                            {
                                $payment_time = strtotime($order['order_date']);
                            }

                            if($payment_time > 0)//支付了
                            {
                                //如果超过24小时冷却时间
                                if(time() < strtotime('+1 day',$payment_time))
                                {
                                    $data['time_down'] = date('Y-m-d H:i:s',strtotime('+1 day',$payment_time)) ;
                                }
                            }
                        }
                    }
                }
            }
        }

        return $data;
    }

}

?>