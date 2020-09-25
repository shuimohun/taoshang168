<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * Api接口, 让App等调用
 *
 *
 * @category   Game
 * @package    User
 * @author     WenQingTeng
 * @copyright  Copyright (c) 2017, 温庆腾
 * @version    1.0
 * @todo
 */
class Api_Trade_ShareCtl extends Api_Controller
{
	
	public $orderBaseModel = null;
    public $orderStateModel = null;
	public $sharePriceModel = null;
    public $shareBaseModel = null;
    public $shareClickModel = null;

	/**
	 * Constructor
	 *
	 * @param  string $ctl 控制器目录
	 * @param  string $met 控制器方法
	 * @param  string $typ 返回数据类型
	 * @access public
	 */
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);
		$this->orderBaseModel = new Order_BaseModel();
		$this->orderStateModel = new Order_StateModel();
		$this->sharePriceModel = new Share_PriceModel();
        $this->shareBaseModel = new Share_BaseModel();
        $this->shareClickModel = new Share_ClickModel();
		
	}

    public function getShareList()
    {

        //$sql = 'SELECT a.*,b.`order_status`,b.buyer_user_name,b.`payment_number`,b.payment_time,b.order_payment_amount,b.order_finished_time,b.shop_id,b.shop_name FROM `ylb_share_price` a LEFT JOIN `ylb_order_base` b ON a.`share_order_id` = b.`order_id` WHERE 1 = 1 ';
        $sql = 'SELECT a.*,b.`order_status`,c.user_account,b.`payment_number`,b.payment_time,b.order_payment_amount,b.order_finished_time,b.shop_id,b.shop_name FROM `ylb_share_price` a LEFT JOIN ylb_user_base c ON a.`share_uid` = c.`user_id` LEFT JOIN `ylb_order_base` b ON a.`share_order_id` = b.`order_id` WHERE 1 = 1 ';
        $count = 'SELECT COUNT(*) total FROM `ylb_share_price` a LEFT JOIN ylb_user_base c ON a.`share_uid` = c.`user_id` LEFT JOIN `ylb_order_base` b ON a.`share_order_id` = b.`order_id` WHERE 1 = 1 ';
        $where = '';
        //订单状态 默认已付款的
        if(request_int('order_status'))
        {
            if(request_int('order_status') > 0)
            {
                $where .= ' AND b.order_status = ' . request_int('order_status');
            }
        }
        else
        {
            $where .= ' AND b.order_status = 2 ';
        }

        //分享编号
        if (request_string('share_num'))
        {
            $where .= ' AND a.`share_num` LIKE "%' . request_string('share_num') . '%"';
        }

        //订单编号
        if (request_string('order_id'))
        {
            $where .= ' AND a.`share_order_id` LIKE "%' . request_string('order_id') . '%"';
        }

        //买家帐号
        if (request_string('buyer_name'))
        {
            $where .= ' AND c.`user_account` LIKE "%' . request_string('buyer_name') . '%"';
        }

        //店铺名称
        if (request_string('shop_name'))
        {
            $where .= ' AND b.`shop_name` LIKE "%' . request_string('shop_name') . '%"';
        }

        //支付单号
        if (request_string('payment_number'))
        {
            $where .= ' AND b.`payment_number` LIKE "%' . request_string('payment_number') . '%"';
        }

        //付款日期
        if (request_string('payment_date_f'))
        {
            $where .= ' AND b.`payment_time` >="' . request_string('payment_date_f') . '"';
        }
        if (request_string('payment_date_t'))
        {
            $where .= ' AND b.`payment_time` <="' . request_string('payment_date_t') . '"';
        }

        $order = '';
        if (request_string('sidx'))
        {
            $order = ' order by a.' . request_string('sidx') . ' ' . request_string('sord', 'asc');
        }

        $total = $this->sharePriceModel->selectSql($count.$where);
        if($total)
        {
            $total = current($total);
            $total = $total['total'];
        }

        $page = request_int('page', 1);
        $rows = request_int('rows', 25);

        $limit = '';
        if($page)
        {
            $limit = ' limit ' . ($page - 1) * $rows . ',' . $rows;
        }

        $res = $this->sharePriceModel->selectSql($sql.$where.$order.$limit);

        $data = array();
        $data['page'] = $page;
        $data['total'] = ceil_r($total / $rows);  //total page
        $data['totalsize'] = $total;
        $data['records'] = $total;
        $data['items'] = $res;

        foreach ($data['items'] as $key=>$value)
        {
            $data['items'][$key]['share_date_str'] = date('Y-m-d H:i:s',$value['share_date']);
            $data['items'][$key]['order_status_str'] = $this->orderStateModel->orderState[$value['order_status']];
            $data['items'][$key]['promotion_unit_price'] = $value['promotion_unit_price'] * 1;
            $data['items'][$key]['share_click_price'] =  $value['promotion_unit_price'] * $value['promotion_click_count']* 1;
            $data['items'][$key]['promotion_total_price'] = $value['promotion_total_price']* 1;
            $data['items'][$key]['order_payment_amount'] = $value['order_payment_amount']* 1;

            if($value['share_base'])
            {
                foreach (json_decode($value['share_base']) as $k=>$v)
                {
                    $data['items'][$key][$k] = $v * 1;
                }
            }
        }

        if ($data['records'] > 0)
        {
            $status = 200;
            $msg    = _('success');
        }
        else
        {
            $status = 250;
            $msg    = _('没有满足条件的结果哦');
        }
        $this->data->addBody(-140, $data, $msg, $status);

    }

    /**
     * 获取商品订单列表 备份
     */
	public function getShareListII()
	{
		$page = request_int('page', 1);
		$rows = request_int('rows', 100);

		$order_row = array();
		$sidx      = request_string('sidx');
		$sord      = request_string('sord', 'asc');

		if ($sidx)
		{
			$order_row[$sidx] = $sord;
		}


        if (request_string('share_num'))
        {
            $cond_row['share_num:LIKE'] = '%'.request_string('share_num') . '%';
        }
		
		if (request_string('order_id'))
		{
			$cond_row['order_id:LIKE'] = '%'.request_string('order_id') . '%';
		}
		if (request_string('buyer_name'))
		{
			$cond_row['buyer_user_name:LIKE'] = '%'.request_string('buyer_name') . '%';
		}
		if (request_string('shop_name'))
		{
			$cond_row['shop_name:LIKE'] = '%'.request_string('shop_name') . '%';
		}
		if (request_string('payment_number'))
		{
			$cond_row['payment_number:LIKE'] = '%'.request_string('payment_number') . '%';
		}

		if (request_string('payment_date_f'))
		{
			$cond_row['payment_time:>='] = request_string('payment_date_f');
		}
		if (request_string('payment_date_t'))
		{
			$cond_row['payment_time:<='] = request_string('payment_date_t');
		}

        //分站筛选
        $sub_site_id = request_int('sub_site_id');
        $sub_flag = true;
        if($sub_site_id > 0){
            //获取站点信息
            $Sub_SiteModel = new Sub_SiteModel();
            $sub_site_district_ids = $Sub_SiteModel->getDistrictChildId($sub_site_id);
            if(!$sub_site_district_ids){
                $sub_flag = false;
            }else{
                $cond_row['district_id:IN'] = $sub_site_district_ids;
            }
        }
        if($sub_flag == false){
            $status = 250;
			$msg    = _('分站信息获取失败');
            $this->data->addBody(-140, array(), $msg, $status);
        }else{

            $data = $this->sharePriceModel->getSharePriceList($cond_row, array('id'=>'DESC'), $page, $rows);

            foreach ($data['items'] as $key=>$val)
            {

                $common_id = $val['common_id'];
                //$commonModel = new Goods_CommonModel();
                //$goods_common = $commonModel -> getOneByWhere(array('common_id'=>$common_id));

                //商品信息--此处是用common_id取 Goods_Base表 后面可修改--sharePrice内添加goods_id再用goods_id取值
                $goodsModel = new Goods_BaseModel();
                $goods = $goodsModel->getOneByWhere(array('common_id'=>$common_id));
                $data['items'][$key]['goods_image'] = $goods['goods_image'];//商品图片
                $data['items'][$key]['goods_name'] = $goods['goods_name'];//商品名称
                $data['items'][$key]['goods_price'] = $goods['goods_price'];
                $data['items'][$key]['shop_name'] = $goods['shop_name'];
                $data['items'][$key]['goods_id'] = $goods['goods_id'];


                //分享设置的立减信息
                $share_base = $this->shareBaseModel->getOneByWhere(array('common_id'=>$common_id));
                $data['items'][$key]['promotion_unit_price'] = $share_base['promotion_unit_price']* 1;
                $data['items'][$key]['share_click_price'] =  $share_base['promotion_unit_price'] * $val['promotion_click_count']* 1;
                $data['items'][$key]['promotion_total_price'] = $share_base['promotion_total_price']* 1;
                $data['items'][$key]['weixin'] = isset($val['share_base']['weixin'])?$val['share_base']['weixin'] * 1:'';
                $data['items'][$key]['weixin_timeline'] = isset($val['share_base']['weixin_timeline'])?$val['share_base']['weixin_timeline'] * 1:'';
                $data['items'][$key]['sqq'] = isset($val['share_base']['sqq'])?$val['share_base']['sqq'] * 1:'';
                $data['items'][$key]['qzone'] = isset($val['share_base']['qzone'])?$val['share_base']['qzone'] * 1:'';
                $data['items'][$key]['tsina'] = isset($val['share_base']['tsina'])?$val['share_base']['tsina'] * 1:'';

                //订单信息
                if($val['share_order_id'] == '0')
                {
                    $data['items'][$key]['order_status'] = '订单未提交';
                }
                else
                {
                    $order = $this->orderBaseModel -> getOneByWhere(array('order_id'=>$val['share_order_id']));
                    $data['items'][$key]['payment_time'] = $order['payment_time'];
                    $data['items'][$key]['order_payment_amount'] = $order['order_payment_amount'];
                    $data['items'][$key]['order_finished_time'] = $order['order_finished_time'];

                    $Order_StateModel = new Order_StateModel();
                    $data['items'][$key]['order_status'] = $Order_StateModel->orderState[$order['order_status']];
                }

                //分享人的个人信息
                $userBaseModel = new User_BaseModel();
                $user_cond['user_id'] = $val['share_uid'];
                $user = $userBaseModel->getUserInfo($user_cond);
                $data['items'][$key]['user_account'] = $user['user_account'];

                $data['items'][$key]['share_date_str'] = date('Y-m-d H:i:s',$val['share_date']);

            }

            if ($data['records'] > 0)
            {
                $status = 200;
                $msg    = _('success');
            }
            else
            {
                $status = 250;
                $msg    = _('没有满足条件的结果哦');
            }
            $this->data->addBody(-140, $data, $msg, $status);

        }
		
	}

}

?>