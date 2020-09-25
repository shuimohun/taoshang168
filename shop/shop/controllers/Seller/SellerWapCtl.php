<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Seller_SellerWapCtl extends Controller
{
    public function __construct(&$ctl, $met, $typ)
    {
        parent::__construct($ctl, $met, $typ);
        $this->informationReplyModel = new Information_ReplyModel();
    }
    public function index(){
        $shop_id = Perm::$shopId;
        $data_time_left = date('Y-m-d 00:00:00', time());
        $data_time_right = date('Y-m-d 23:59:59', time());
        $data_yesterday_start = date("Y-m-d 00:00:00",strtotime("-1 day"));
        $data_yesterday_end = date("Y-m-d 23:59:59",strtotime("-1 day"));
        $data_foot_yesterday = date("Y-m-d",strtotime("-1 day"));
        $data_foot_today = date("Y-m-d",time());
        $web_config = new Web_ConfigModel();
        $shop_baseModel = new Shop_BaseModel();
        $order_baseModel = new Order_BaseModel();
        $goods_baseModel = new Goods_BaseModel();
        $order_stateModel = new Order_StateModel();
        $user_footModel = new User_FootprintModel();
        //评分
        $cond['shop_id'] = $shop_id;
        $score = $shop_baseModel->getShopDetailData($cond);
        if ($score['com_desc_scores'] > 0){
            $data['score']['shop_desc_text'] = '高于';
        }else if ($score['com_desc_scores'] < 0){
            $data['score']['shop_desc_text'] = '低于';
        }else{
            $data['score']['shop_desc_text'] = '等于';
        }
        $data['score']['shop_desc_scores'] = $score['shop_desc_scores'];
        if ($score['com_service_scores'] > 0){
            $data['score']['shop_service_text'] = '高于';
        }else if ($score['com_service_scores'] < 0){
            $data['score']['shop_service_text'] = '低于';
        }else{
            $data['score']['shop_service_text'] = '等于';
        }
        $data['score']['shop_service_scores'] = $score['shop_service_scores'];
        if ($score['com_send_scores'] > 0){
            $data['score']['shop_send_text'] = '高于';
        }else if ($score['com_send_scores'] < 0){
            $data['score']['shop_send_text'] = '低于';
        }else{
            $data['score']['shop_send_text'] = '等于';
        }
        $data['score']['shop_send_scores'] = $score['shop_send_scores'];
        $data['score']['average_score'] = round(($score['shop_desc_scores'] + $score['shop_service_scores'] + $score['shop_send_scores'])/3,2);
        //订单
        $shop = $shop_baseModel->getOneByWhere($cond);
        if (empty($shop['shop_logo'])){
            $cond_img['config_key'] = 'photo_shop_logo';
            $shop_img = $web_config->getOne($cond_img);
            $shop['shop_logo'] = $shop_img['config_value'];
        }
        $data['head'] = $shop;
        $cond_order_weifukuan['shop_id'] = $shop_id;
        $cond_order_weifukuan['order_status'] = $order_stateModel::ORDER_WAIT_PAY;
        $weifukuan = $order_baseModel->getRowCount($cond_order_weifukuan);
        $data['order']['weifukuan'] = $weifukuan;
        $cond_order_weifahuo['shop_id'] = $shop_id;
        $cond_order_weifahuo['order_status'] = $order_stateModel::ORDER_WAIT_PREPARE_GOODS;
        $weifahuo = $order_baseModel->getRowCount($cond_order_weifahuo);
        $data['order']['weifahuo'] = $weifahuo;
        $cond_order_yifahuo['shop_id'] = $shop_id;
        $cond_order_yifahuo['order_status'] = $order_stateModel::ORDER_WAIT_CONFIRM_GOODS;
        $yifahuo = $order_baseModel->getRowCount($cond_order_yifahuo);
        $data['order']['yifahuo'] = $yifahuo;
        $cond_order_yiqianshou['shop_id'] = $shop_id;
        $cond_order_yiqianshou['order_status'] = $order_stateModel::ORDER_RECEIVED;
        $yiqianshou = $order_baseModel->getRowCount($cond_order_yiqianshou);
        $data['order']['yiqianshou'] = $yiqianshou;
        $cond_order_tuikuan['shop_id'] = $shop_id;
        $cond_order_tuikuan['order_status'] = $order_stateModel::ORDER_REFUND_FINISH;
        $tuikuan = $order_baseModel->getRowCount($cond_order_tuikuan);
        $data['order']['tuikuan'] = $tuikuan;

//        总数据 新订单
        $cond_goods_today['order_create_time:>='] = $data_time_left;
        $cond_goods_today['order_create_time:<='] = $data_time_right;
        $cond_goods_today['shop_id'] = $shop_id;
        $data['items']['total']['new_order'] = $order_baseModel->getRowCount($cond_goods_today);
        //总数据  正常商品
        $cond_goods['goods_is_shelves'] = 1;
        $cond_goods['shop_id'] = $shop_id;
        $data['items']['total']['goods_count'] = $goods_baseModel->getRowCount($cond_goods);
        //总数据  推荐橱窗
        $cond_goods_recomm['shop_id'] = Perm::$shopId;
        $cond_goods_recomm['goods_is_recommend'] = 1;
        $cond_goods_recomm['goods_is_shelves']   = 1;
        $data['items']['total']['recommend_goods'] = $goods_baseModel->getRowCount($cond_goods_recomm);
        //今日订单
        $cond_order_today['payment_time:>='] = $data_time_left;
        $cond_order_today['payment_time:<='] = $data_time_right;
        $cond_order_today['shop_id'] = $shop_id;
        $data['items']['today']['list_row'] = $order_baseModel->getRowCount($cond_order_today);
        //今日总流量
        $user_foot_today['shop_id'] = $shop_id;
        $user_foot_today['footprint_time'] = $data_foot_today;

        $data['items']['today']['flow'] = $user_footModel->getRowCount($user_foot_today);
        //今日访客数
        $user_flow_today = "select COUNT(DISTINCT user_id) from ylb_user_footprint where shop_id= ".$shop_id." and footprint_time = '".$data_foot_today."'";
        $user_flow_tocount = $shop_baseModel->selectSql($user_flow_today);
        $data['items']['today']['foot'] = $user_flow_tocount[0]['COUNT(DISTINCT user_id)'];
        //昨日订单
        $cond_order_yesterday['payment_time:>='] = $data_yesterday_start;
        $cond_order_yesterday['payment_time:<='] = $data_yesterday_end;
        $cond_order_yesterday['shop_id'] = $shop_id;
        $data['items']['yesterday']['list_row'] = $order_baseModel->getRowCount($cond_order_yesterday);
        //昨日总流量
        $user_foot_yesterday['shop_id'] = $shop_id;
        $user_foot_yesterday['footprint_time'] = $data_foot_yesterday;
        $data['items']['yesterday']['flow'] = $user_footModel->getRowCount($user_foot_yesterday);
        //昨日访客数
        $user_flow_sql = "select COUNT(DISTINCT user_id) from ylb_user_footprint where shop_id= ".$shop_id." and footprint_time = '".$data_foot_yesterday."'";
        $user_flow_count = $shop_baseModel->selectSql($user_flow_sql);
        $data['items']['yesterday']['foot'] = $user_flow_count[0]['COUNT(DISTINCT user_id)'];
        //访客比例
        $scale = $data['items']['today']['foot']/$data['items']['yesterday']['foot']*100;
        $data['items']['scale'] = number_format($scale,0);
        $this->data->addBody(-140, $data);
    }
}

?>