<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * Api接口  管理用户开通新    shop设置新开通   用户运行环境:db....
 *
 *
 * @category   Game
 * @package    User
 * @author     WenQingTeng
 * @copyright  Copyright (c) 2017, 温庆腾
 * @version    1.0
 * @todo
 */
class Api_MainCtl extends Api_Controller
{
	/**
	 * Constructor
	 *
	 * @param  string $ctl 控制器目录
	 * @param  string $met 控制器方法
	 * @param  string $typ 返回数据类型
	 * @access public
	 */
	private $fp=null;

	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);
	}

	public function getMainInfo()
	{
		$msg    = _('success');
		$status = 200;
		$data = array();
		$start_date   = date("Y-m-d 00:00:00", strtotime("this week"));
		$date = get_date_time();
		$end_date = date("Y-m-d 23:59:59", strtotime("this week +6 day"));
		$end7_date =date("Y-m-d", strtotime("+7 days"));
        $data_time_left = date('Y-m-d 00:00:00', time());
		$start_month = date('Y-m-01', strtotime(date("Y-m-d")));
		$end_month = date('Y-m-d', strtotime("$start_month +1 month -1 day"));

		//会员总数量
		$userModel = new User_InfoModel();
		$user = $userModel->getSubQuantity(array());
		$data['member_count'] = $user;

        //获取本周新增会员数量
        $cond_row['user_regtime:>='] = date('Y-m-d 00:00:00',time());
        $cond_row['user_regtime:<='] = date('Y-m-d 23:59:59',time());;
        $data['day_member'] = $userModel->getSubQuantity($cond_row);

		//获取本周新增会员数量

		$cond_row['user_regtime:>='] = $start_date;
		$cond_row['user_regtime:<='] = $end_date;
		$week_member = $userModel->getSubQuantity($cond_row);
		$data['week_member'] = $week_member;

		//获取本月新增会员数量
		$condm_row['user_regtime:>='] = $start_month;
		$condm_row['user_regtime:<='] = $end_month;
		$month_member = $userModel->getSubQuantity($condm_row);
		$data['month_member'] = $month_member;

		//商品总数量
		$goodsModel = new Goods_CommonModel();
		$goods = $goodsModel->getSubQuantity(array());
		$data['goods_num'] = $goods;

        //商品上架总数量
        $goodsModel = new Goods_CommonModel();
        $cond_goods_row1['common_state'] = 1;
        $goods = $goodsModel->getSubQuantity($cond_goods_row1);
        $data['goods_num_sta'] = $goods;

		//本周新增上架商品数量
		$cond_goods_row['common_state'] = 1;
		$cond_goods_row['common_add_time:>='] = $start_date;
		$cond_goods_row['common_add_time:<='] = $end_date;
		$week_goods = $goodsModel->getSubQuantity($cond_goods_row);
		$data['week_goods_num'] = $week_goods;

        //本周新增未上架商品数量
        $cond_goods_rows['common_state'] = 0;
//        $cond_goods_rows['common_add_time:>='] = $start_date;
//        $cond_goods_rows['common_add_time:<='] = $end_date;
        $week_goodss = $goodsModel->getSubQuantity($cond_goods_rows);
        $data['week_goods_nums'] = $week_goodss;

		//待审核商品数量
		$cond_goods['common_verify'] = Goods_CommonModel::GOODS_VERIFY_WAITING;
		$verify = $goodsModel->getSubQuantity($cond_goods);
		$data['verify_goods_num'] = $verify;

		//举报数目
		$reportModel = new Report_BaseModel();
		$report_cond_row['report_state'] = Report_BaseModel::REPORT_DO;
		$report = $reportModel->getSubQuantity($report_cond_row);
		$data['report_num'] = $report;

		//品牌数目
		$goodsBrand = new Goods_BrandModel();
		$brands = $goodsBrand->getSubQuantity(array());
		$data['goods_brands_num'] = $brands;

		//店铺总数量
		$shopModel = new Shop_BaseModel();
		$shop_cond_rows = array();
		$shop_cond_rows["shop_self_support"]=  "false";
		$shop_cond_rows["shop_status:in"]=  array("0","3");
		$shops = $shopModel->getSubQuantity($shop_cond_rows);
		$data['shop_nums'] = $shops;

        //获取本周新增店铺数量
        $cond_row_shop['shop_create_time:>='] = $start_date;
        $cond_row_shop['shop_create_time:<='] = $end_date;
        $cond_row_shop['shop_status'] = 3;
        $cond_row_shop['shop_self_support'] = "false";
        $cond_row_shop['shop_type'] = 1; //非供应商店铺
        $week_member_shop = $shopModel->getSubQuantity($cond_row_shop);
        $data['week_member_shop'] = $week_member_shop;
		//待审核店铺数量
		$shop_cond_row['shop_status'] = 1;
		$verify_shops = $shopModel->getSubQuantity($shop_cond_row);
		$data['verify_shop_nums'] = $verify_shops;

		//经营类目申请数量
		$shopClassModel = new Shop_ClassBindModel();
		$shopClass = $shopClassModel->getSubQuantity(array('shop_class_bind_enable'=>1));
		$data['shop_class_nums'] = $shopClass;

		//店铺续签申请数量
		$renewalModel = new Shop_RenewalModel();
		$renewal = $renewalModel->getSubQuantity(array());
		$data['renewal_nums'] = $renewal;

		//店铺到期的数量
		$shop_cond_rows['shop_end_time:<='] = $date;
		$expired = $shopModel->getSubQuantity($shop_cond_rows);
		$data['shop_expired_nums'] = $expired;

		//即将到期店铺数量
		$shop_cond_rows['shop_end_time:<='] = $end7_date;
		$shop_cond_rows['shop_end_time:>='] = $date;
		$expire = $shopModel->getSubQuantity($shop_cond_rows);
		$data['shop_expire_nums'] = $expire;

		//交易订单总数
		$orderModel = new Order_BaseModel();
		$orders = $orderModel->getSubQuantity(array());
		$data['order_nums'] = $orders;

		//退款
        $returnModel = new Order_ReturnModel();
        $order_cond_row['order_is_virtual'] = 0;
		$order_cond_row['return_type'] = 1;
        $order_cond_row['return_platform_state'] = Order_ReturnModel::PLAT_WAIT_PASS;
        $order_cond_row['seller_status:>'] = Order_ReturnModel::SELLER_STATUS_0;
		$returns = $returnModel->getSubQuantity($order_cond_row);
		$data['physical_return_nums'] = $returns;

		//退货
		$order_cond_row['return_type']  = 2;
		$return_goods = $returnModel->getSubQuantity($order_cond_row);
		$data['physical_return_goods_nums'] = $return_goods;

        //退款 复审
		unset($order_cond_row['return_platform_state']);
        $order_cond_row['return_type'] = 1;
        $order_cond_row['return_recheck_state'] = Order_ReturnModel::PLAT_WAIT_PASS;
        $data['physical_return_recheck_nums'] = $returnModel->getSubQuantity($order_cond_row);

        //退货 复审
        $order_cond_row['return_type']  = 2;
        $order_cond_row['return_recheck_state'] = Order_ReturnModel::PLAT_WAIT_PASS;
        $data['physical_return_goods_recheck_nums'] = $returnModel->getSubQuantity($order_cond_row);

		//虚拟订单退款
		$order_cond_row['return_goods_return'] = 0;
		$order_cond_row['return_type'] = 3;
		$virtual_returns = $returnModel->getSubQuantity($order_cond_row);
		$data['virtual_return_goods_nums'] = $virtual_returns;

		//支付订单
        $data['order_status_count'] = $orderModel->getCount(array('payment_time:>='=>$data_time_left,'payment_time:<='=>$date));

		//投诉
		$complainModel = new Complain_BaseModel();
		$complains = $complainModel->getSubQuantity(array('complain_state'=>1));
		$data['complain_nums'] = $complains;

		//待仲裁
		$handle = $complainModel->getSubQuantity(array('complain_state'=>4));
		$data['handle_nums'] = $handle;

		//结算管理
		$settlementModel = new Order_SettlementModel();
        $settlement_count = $settlementModel->getSubQuantity(array());
		$data['settlement_count'] = $settlement_count;

		//平台客服
        $Platform_CustomServiceModel = new  Platform_CustomServiceModel();
        $Platform_CustomServiceModel_count = $Platform_CustomServiceModel->getSubQuantity(array('custom_service_status'=>1));
        $data['custom_count'] = $Platform_CustomServiceModel_count;

        //服务站
		$ContractLogModel = new Shop_ContractLogModel();
        $cond_rowss['contract_log_type'] = Shop_ContractLogModel::LOG_TYPE_JOIN;
        $cond_rowss['contract_log_state:in'] = array("1","2");
        $ContractLogModel_count = $ContractLogModel->getSubQuantity($cond_rowss);
        $data['contractLog_count'] = $ContractLogModel_count;

		$data['week_time'] = $start_date;
		$data['date'] = $date;

		$this->data->addBody(-140, $data, $msg, $status);
	}
}
?>
