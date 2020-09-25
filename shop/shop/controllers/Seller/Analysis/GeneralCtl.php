<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Seller_Analysis_GeneralCtl extends Seller_Controller
{
	public $Analysis_ShopGeneralModel   = null;
	public $Analysis_ShopGoodsModel     = null;
	public $Analysis_PlatformTotalModel = null;

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
		$this->Analysis_ShopGeneralModel   = new Analysis_ShopGeneralModel();
		$this->Analysis_ShopGoodsModel     = new Analysis_ShopGoodsModel();
		$this->Analysis_PlatformTotalModel = new Analysis_PlatformTotalModel();
	}

    /**
     *  店铺概况
     */
    public function index(){
        $start_date = request_string('sdate') ? request_string('sdate') : date("Y-m-d", strtotime("-30 days"));
        $end_date = request_string('edate') ?  request_string('edate') : date('Y-m-d');
        $time_diff = ceil((strtotime($end_date)-strtotime($start_date))/86400);
        if($time_diff > 31){
            //最多查询31天数据
            $end_date = date("Y-m-d", strtotime($start_date)+86400*30);
        }
        $cond_row['order_goods_time:>='] = $start_date;
        $cond_row['order_goods_time:<='] = $end_date;
        $cond_row['shop_id']         = Perm::$shopId;
        $analytics = new Analytics();
        $result = $analytics->getGeneralInfo($cond_row,$start_date,$end_date);
//        var_dump($cond_row);
//        var_dump($result);
//        var_dump($result);
//        die;
        if($result['status'] == 200){
            $total['order_goods_amount'] = $result['items'][0]['order_goods_amount'];
            $total['order_user_num'] = $result['items'][0]['order_user_num'];
            //当前商品数量统计
            $Goods_CommonModel = new Goods_CommonModel();       //ylb_goods_common       YLB_goods_property_index
            $total['goods_count']  = $Goods_CommonModel->getCommonStateNum( $cond_row['shop_id'] , Goods_CommonModel::GOODS_STATE_NORMAL,Goods_CommonModel::GOODS_VERIFY_ALLOW);
            $total['goods_count_n']  = $Goods_CommonModel->getCommonStateNum( $cond_row['shop_id'] , Goods_CommonModel::GOODS_STATE_OFFLINE);
            $total['order_goods_num'] = $result['items'][0]['order_goods_num'];
            $total['order_goods_count'] = $result['items'][0]['order_goods_count'];
            $total['sql_goods_like'] = $result['sql_goods_like'][0]['goods_count_like'];
            $total['sql_shop_like'] = $result['sql_shop_like'][0]['shop_count_like'];
            $total['count_goods'] = $result['data'][0]['count_goods'];
            $total['order_goods_num'] ? $total['general_cash']      = round($total['order_goods_amount'] / $total['order_goods_num'], 2) : "";
            $total['order_user_num'] ? $total['general_user_cash'] = round($total['order_goods_amount'] / $total['order_user_num'], 2) : '';
            if(isset($result['items']['chart_num'])){
                $data['x_data'] = json_encode(array_keys($result['items']['chart_num']));
                $data['y_data_num'] = json_encode(array_values($result['items']['chart_num']));
            }else{
                $data['x_data'] = json_encode(array());
                $data['y_data_num'] = json_encode(array());
            }
            if(isset($result['items']['chart_cost'])){
                $data['y_data_cost'] = json_encode(array_values($result['items']['chart_cost']));
            }else{
                $data['y_data_cost'] = json_encode(array());
            }
            $goods_list = $result['res'];
        }else{
            $total['order_goods_amount'] = '';
            $total['order_user_num'] = '';
            $total['goods_count'] = '';
            $total['goods_count_n'] = '';
            $total['order_goods_num'] = '';
            $total['count_goods'] = '';
            $total['sql_goods_like'] = '';
            $total['sql_shop_like'] = '';
            $total['order_goods_count']      = '';
            $total['order_user_num'] ='';
            $data['x_data'] = json_encode(array());
            $data['y_data_cost'] = json_encode(array());
            $data['y_data_num'] = json_encode(array());
            $goods_list = array();
        }

        include $this->view->getView();
    }
//    public function index(){
////		$start_date                  = date("Y-m-d", strtotime("-30 days"));
////		$end_date                    = date("Y-m-d");
//        $start_date = !request_string('sdate') ? date("Y-m-d", strtotime("-30 days")) : request_string('sdate');
//        $end_date = !request_string('edate') ?  date('Y-m-d') : request_string('edate');
//        $time_diff = ceil((strtotime($end_date)-strtotime($start_date))/86400);
//        if($time_diff > 31){
//            //最多查询31天数据
//            $end_date = date("Y-m-d", strtotime($start_date)+86400*30);
//        }
//        $cond_row['start_time'] = $start_date;
//        $cond_row['end_time'] = $end_date;
//        $cond_row['shop_id']         = Perm::$shopId;
//        $analytics = new Analytics();
//        $result = $analytics->getGeneralInfo($cond_row);
////        echo '<pre>';print_r($cond_row);exit;
//        if($result['status'] == 200){
//            $total['goods_num'] = $result['data']['goods_num'];
//            $total['order_cash'] = $result['data']['order_cash'];
//            $total['order_goods_num'] = $result['data']['order_goods_num'];
//            $total['order_num'] = $result['data']['order_num'];
//            $total['order_user_num'] = $result['data']['order_user_num'];
//            $total['goods_favor_num'] = $result['data']['goods_favor_num'];
//            $total['shop_favor_num'] = $result['data']['shop_favor_num'];
//            $total['order_num'] ? $total['general_cash']      = round($total['order_cash'] / $total['order_num'], 2) : "";
//            $total['order_user_num'] ? $total['general_user_cash'] = round($total['order_cash'] / $total['order_user_num'], 2) : '';
//            if(isset($result['data']['chart_num'])){
//                $data['x_data'] = json_encode(array_keys($result['data']['chart_num']));
//                $data['y_data_num'] = json_encode(array_values($result['data']['chart_num']));
//            }else{
//                $data['x_data'] = json_encode(array());
//                $data['y_data_num'] = json_encode(array());
//            }
//            if(isset($result['data']['chart_cost'])){
//                $data['x_data'] = json_encode(array_values($result['data']['chart_cost']));
//                $data['y_data_cost'] = json_encode(array_values($result['data']['chart_cost']));
//            }else{
//                $data['y_data'] = json_encode(array());
//                $data['y_data_cost'] = json_encode(array());
//            }
//            $goods_list = $result['data']['recommend'];
//        }else{
//            $total['goods_num'] = '';
//            $total['order_cash'] = '';
//            $total['order_goods_num'] = '';
//            $total['order_num'] = '';
//            $total['order_user_num'] = '';
//            $total['goods_favor_num'] = '';
//            $total['shop_favor_num'] = '';
//            $total['general_cash']      = '';
//            $total['general_user_cash'] ='';
//            $data['x_data'] = json_encode(array());
//            $data['y_data_cost'] = json_encode(array());
//            $data['y_data_num'] = json_encode(array());
//            $goods_list = array();
//        }
//        if('json' == request_string('typ'))
//        {
//            echo '<pre>';print_r($result);exit;
//        }
//        include $this->view->getView();
//    }
}

?>