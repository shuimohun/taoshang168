<?php

/**
 * Description of AnalyticsModel
 *
 * @author
 */
class Analytics {
    public  $key = null;
    public  $url = null;
    public  $app_id = null;
    public $user_BaseModel=null;
    public $goods_BaseModel=null;
    public $shop_BaseModel=null;
    public $order_BaseModel=null;
    public $user_InfoModel = null;
    public $goods_CommonModel = null;

    public function __construct(){
        $this->key = YLB_Registry::get('analytics_api_key');
        $this->url = YLB_Registry::get('analytics_api_url');
        $this->app_id = YLB_Registry::get('analytics_app_id');
        $this->userBaseModel     = new User_BaseModel();
        $this->goodsBaseModel     = new Goods_BaseModel();
        $this->shopBaseModel     = new Shop_BaseModel();
        $this->orderBaseModel    = new Order_BaseModel();
        $this->orderGoodsModel    = new Order_GoodsModel();
        $this->userInfoModel     =  new User_InfoModel();
        $this->goodsCommonModel  =  new Goods_CommonModel();
        date_default_timezone_set('PRC');
    }

    /**
     * 商家中心 --- 店铺概况
     * @param array $formvars
     * @return boolean
     */
    public function getGeneralInfo($cond_row = array(),$start_date,$end_date){
        $page          	= request_int('page', 1);
        $rows          	= request_int('rows', 100);
        $field = "sum(order_goods_amount) as order_goods_amount,count(DISTINCT buyer_user_id) as order_user_num,count(order_goods_id) as order_goods_count,sum(order_goods_num) as order_goods_num";
        $group = 'shop_id desc';
        $data = $this->orderGoodsModel->selectReturn($field,$cond_row, $group, $page, $rows);
        $sql_goods_like = "select count(b.goods_id)as goods_count_like from ylb_goods_base as a left join ylb_user_favorites_goods as b on a.goods_id=b.goods_id where a.shop_id=".$cond_row['shop_id'];
        $sql_shop_like = "select count(b.shop_id)as shop_count_like from ylb_shop_base as a left join ylb_user_favorites_shop as b on a.shop_id=b.shop_id where a.shop_id=".$cond_row['shop_id'];
        $data['sql_goods_like'] = $this->orderGoodsModel->sql($sql_goods_like);
        $data['sql_shop_like'] = $this->orderGoodsModel->sql($sql_shop_like);
        $sql_row = "select goods_name,goods_id,sum(order_goods_num) as order_goods_num from ".$this->orderGoodsModel->tabase()." where shop_id = ".$cond_row['shop_id']." and order_goods_status=6 group by goods_id order by order_goods_num desc limit 0,10";
        $data['res'] = $this->orderGoodsModel->sql($sql_row);
        if(!empty($data)){
            $data['status'] = 200;
            return $data;
        }
    }

     /**
     * 商家中心 --- 商品详情
     * @param array $formvars
     * @return boolean
     */
    public function getGoodsAnalytics($formvars = array()){
        if(!$formvars){
            return false;
        }
        $formvars['app_id']    = $this->app_id;
        $init_rs = get_url_with_encrypt($this->key, sprintf('%s?ctl=Api_Shop_Getdata&met=getGoodsAnalytics&typ=json', $this->url), $formvars);
        return $init_rs;
    }

     /**
     * 商家中心 --- 热卖商品
     * @param array $formvars
     * @return boolean
     */
    public function getGoodsHot($formvars = array()){
        if(!$formvars){
            return false;
        }
//        $formvars['app_id']    = $this->app_id;
        $field = 'goods_name,count(order_goods_num) as order_goods_num, sum(order_goods_amount)as order_goods_amount';
        $group = ' goods_id ';
        $order = ' order_goods_num';
        $flag = ' desc';
        $data= $this->orderGoodsModel->selectGoods($field,$formvars,$group,$order,$flag);
        return $data;
    }
    public function  getgoodsHot_price($formvars = array()){
        if(!$formvars){
            return false;
        }
        if(empty($formvars['shop_id'])){
            return false;
        }else{
            $field = "goods_name,sum(order_goods_amount) as order_goods_amount";
            $group = "goods_id";
            $order = ' order_goods_amount';
            $flag = ' desc';
            $data= $this->orderGoodsModel->selectGoods($field,$formvars,$group,$order,$flag);
        }
        if(empty($data)){
            return false;
        }else{
            return $data;
        }
    }
    public function  getgoodsHot_num($formvars = array()){
        if(!$formvars){
            return false;
        }
        if(empty($formvars['shop_id'])){
            return false;
        }else{
            $field = "goods_name,count(order_goods_num) as order_goods_num";
            $group = "goods_id";
            $order = ' order_goods_num ';
            $flag = ' desc';
            $data= $this->orderGoodsModel->selectGoods($field,$formvars,$group,$order,$flag);
        }
        if(empty($data)){
            return false;
        }else{
            return $data;
        }
    }
     /**
     * 商家中心 --- 运营报告
     * @param array $formvars
     * @return boolean
     */
    public function getOperationArea($formvars = array()){
        if(!$formvars){
            return false;
        }
        $formvars['app_id']    = $this->app_id;
        $init_rs = get_url_with_encrypt($this->key, sprintf('%s?ctl=Api_Shop_Getdata&met=getOperationArea&typ=json', $this->url), $formvars);

        return $init_rs;
    }

    //获取商品详情 2017.3.14 hp
    public function getGoodsDetail($cond_row = array())
    {
        if(!$cond_row){
            return false;
        }
        $cond_row['app_id']    = $this->app_id;
        //下单后
        $shop_id = $cond_row['shop_id'];
        $sql = "select a.common_id,a.common_image,a.common_add_time,a.common_name,sum(b.order_goods_num) as order_goods_num, sum(b.order_goods_amount)as order_goods_amount from ylb_goods_common as a left join ylb_order_goods as b on a.common_id=b.common_id where a.shop_id = ".$shop_id."  group by a.common_id order by order_goods_amount desc;";
        $res = $this->goodsCommonModel->sql($sql);

        return $res;
    }

    //获取商品详情 2017.3.15 hp
    public function goodsAnalysis($formvars = array())
    {
        if(!$formvars){
            return false;
        }else{
            $shop_id = $formvars['shop_id'];
            $common_id = $formvars['common_id'];
            //销售额
            $sql_amount = "select sum(order_goods_amount)as order_goods_amount ,date(order_goods_time)as order_goods_time from ylb_order_goods where shop_id=".$shop_id." and common_id=".$common_id." and  order_goods_status > 1 and order_goods_status <= 6 and order_goods_time>='".$formvars['stime']."' and order_goods_time < '".$formvars['etime']."'  group by date(order_goods_time) ";

            //销售zong额
            $sql_sum_amount = "select sum(order_goods_amount)as order_goods_amount from ylb_order_goods where shop_id=".$shop_id." and common_id=".$common_id." and  order_goods_status > 1 and order_goods_status <= 6 and order_goods_time>='".$formvars['stime']."' and order_goods_time < '".$formvars['etime']."'";
            //销售量
            $sql_num = "select sum(order_goods_num)as order_goods_num ,date(order_goods_time)as order_goods_time from ylb_order_goods  where shop_id=".$shop_id." and common_id=".$common_id." and  order_goods_status > 1 and order_goods_status <= 6 and order_goods_time>='".$formvars['stime']."' and order_goods_time < '".$formvars['etime']."'  group by date(order_goods_time) ";

            //销售总量
            $sql_sum_num  = "select sum(order_goods_num )as order_goods_num  from ylb_order_goods where shop_id=".$shop_id." and common_id=".$common_id." and  order_goods_status > 1 and order_goods_status <= 6 and order_goods_time>='".$formvars['stime']."' and order_goods_time < '".$formvars['etime']."'";
            //关注
            $sql_gz = "select count(b.goods_id)as gz_count,date(b.favorites_goods_time) from ylb_goods_base as a left join ylb_user_favorites_goods as b on a.goods_id=b.goods_id where a.common_id=".$common_id." and a.shop_id=".$shop_id." and b.favorites_goods_time>= '".$formvars['stime']."' and b.favorites_goods_time < '".$formvars['etime']."' group by date(b.favorites_goods_time)";
            //关注总数
            $sql_num_gz = "select count(b.goods_id)as gz_sum_count from ylb_goods_base as a left join ylb_user_favorites_goods as b on a.goods_id=b.goods_id where a.common_id=".$common_id." and a.shop_id=".$shop_id." and b.favorites_goods_time>= '".$formvars['stime']."' and b.favorites_goods_time < '".$formvars['etime']."'";
            //足迹
            $sql_footprint = "select date(footprint_time)as footprint_time,count(common_id)as common_count from ylb_user_footprint where common_id=".$common_id." and footprint_time>='".$formvars['stime']."'  and footprint_time < '".$formvars['etime']."' group by date(footprint_time)";
            //足迹总
            $sql_num_footprint = "select count(common_id)as common_count from ylb_user_footprint where common_id=".$common_id." and footprint_time>='".$formvars['stime']."'  and footprint_time < '".$formvars['etime']."'";
           //转化率
            $sql_ucount = "select date(order_goods_time)as order_goods_time,count(buyer_user_id)as ouser_count from ylb_order_goods where common_id = ".$common_id." and order_goods_status = 6 and order_goods_time >='".$formvars['stime']."' and order_goods_time < '".$formvars['etime']."' group by date(order_goods_time)";
            $sql_fcount = "select date(footprint_time)as footprint_time,count(user_id)as fuser_count from ylb_user_footprint where common_id = ".$common_id." and footprint_time >='".$formvars['stime']."' and footprint_time <'".$formvars['etime']."' group by date(footprint_time)";

            //转化率总
            $sql_sum_ucount = "select count(buyer_user_id)as user_count from ylb_order_goods where common_id = ".$common_id." and order_goods_status=6 and order_goods_time >='".$formvars['stime']."' and order_goods_time < '".$formvars['etime']."'";
            $sql_sum_fcount = "select count(user_id)as user_count from ylb_user_footprint where common_id = ".$common_id." and footprint_time >='".$formvars['stime']."' and footprint_time < '".$formvars['etime']."'";
            $ucount = $this->orderGoodsModel->sql($sql_sum_ucount);
            $fcount = $this->orderGoodsModel->sql($sql_sum_fcount);

            //转化率总
            $data['sum_cvr'] = ($ucount[0]['user_count']/$fcount[0]['user_count'])*100;
//                d($data['sum_cvr']);
            $data['sum_footprint'] =  $this->orderGoodsModel->sql($sql_num_footprint);

            $data['sum_amount'] =  $this->orderGoodsModel->sql($sql_sum_amount);
            if (!isset($data['sum_amount'][0]['order_goods_amount'])){
                $data['sum_amount'][0]['order_goods_amount']='0';
            }
            $data['sum_num'] =  $this->orderGoodsModel->sql($sql_sum_num);
            if (!isset($data['sum_num'][0]['order_goods_num'])){
                $data['sum_num'][0]['order_goods_num']='0';
            }
            $data['zhl_ucount'] = $this->orderGoodsModel->sql($sql_ucount);
            $data['zhl_fcount'] = $this->orderGoodsModel->sql($sql_fcount);
            $data['sum_gz'] = $this->orderGoodsModel->sql($sql_num_gz);
            $data['amount'] = $this->orderGoodsModel->sql($sql_amount);
            $data['num'] = $this->orderGoodsModel->sql($sql_num);

            $data['gz_count'] = $this->orderGoodsModel->sql($sql_gz);
            $data['footprint'] = $this->orderGoodsModel->sql($sql_footprint);
            //评分
            $sql_scores = "select date(create_time) as create_time,count(scores)as sum_scores,max(scores) from ylb_goods_evaluation where common_id=".$common_id." and shop_id=".$shop_id." and create_time>='".$formvars['stime']."' and create_time<'".$formvars['etime']."'  group by date(create_time) desc";
            //总评分
            $sql_num_scores = "select count(scores) as sum_scores  from ylb_goods_evaluation where common_id=".$common_id." and shop_id=".$shop_id." and create_time>='".$formvars['stime']."' and create_time<'".$formvars['etime']."'";
            $data['sum_scores'] = $this->orderGoodsModel->sql($sql_num_scores);
            $data['scores'] = $this->orderGoodsModel->sql($sql_scores);
        }
        return $data;
    }

    //获取订单地域详情 2017.3.16 hp
    public function getAreaData($formvars = array())
    {
        if(!$formvars){
            return false;
        }else{
            if(empty($formvars['shop_id'])){
                return false;
            }else{
                if($formvars['flag']==1){
                   $sql_sheng = "select c.district_name as name , count(DISTINCT (a.buyer_user_id))as value from ylb_order_base as a left join ylb_user_info as b on a.buyer_user_id=b.user_id left join ylb_base_district as c on b.user_provinceid=c.district_id where a.shop_id=".$formvars['shop_id']." and a.order_finished_time >='".$formvars['start_time']."' and a.order_finished_time < '".$formvars['end_time']."' and a.buyer_user_id=b.user_id and b.user_provinceid=c.district_id group by b.user_provinceid";
                   $sql_shi   = "select c.district_name as name , count(DISTINCT (a.buyer_user_id))as value from ylb_order_base as a left join ylb_user_info as b on a.buyer_user_id=b.user_id left join ylb_base_district as c on b.user_cityid=c.district_id where a.shop_id=".$formvars['shop_id']."  and a.order_finished_time >='".$formvars['start_time']."' and a.order_finished_time < '".$formvars['end_time']."' and a.buyer_user_id=b.user_id and b.user_cityid=c.district_id group by b.user_provinceid";
                }else if($formvars['flag']==2){
                    $sql_sheng = "select c.district_name as name , sum(a.order_goods_amount)as value from ylb_order_base as a left join ylb_user_info as b on a.buyer_user_id=b.user_id left join ylb_base_district as c on b.user_provinceid=c.district_id where a.shop_id=".$formvars['shop_id']."  and a.order_finished_time >='".$formvars['start_time']."' and a.order_finished_time < '".$formvars['end_time']."'  and a.buyer_user_id=b.user_id and b.user_provinceid=c.district_id group by b.user_provinceid";
                    $sql_shi = "select c.district_name as name , sum(a.order_goods_amount)as value from ylb_order_base as a left join ylb_user_info as b on a.buyer_user_id=b.user_id left join ylb_base_district as c on b.user_cityid=c.district_id where a.shop_id=".$formvars['shop_id']."  and a.order_finished_time >='".$formvars['start_time']."' and a.order_finished_time < '".$formvars['end_time']."' and a.buyer_user_id=b.user_id and b.user_cityid=c.district_id group by b.user_provinceid";
                }else{
                    $sql_sheng = "select c.district_name as name , count(a.order_id)as value from ylb_order_base as a left join ylb_user_info as b on a.buyer_user_id=b.user_id left join ylb_base_district as c on b.user_provinceid=c.district_id where a.shop_id=".$formvars['shop_id']."  and a.order_finished_time >='".$formvars['start_time']."' and a.order_finished_time < '".$formvars['end_time']."' and a.buyer_user_id=b.user_id and b.user_provinceid=c.district_id group by b.user_provinceid";
                    $sql_shi = "select c.district_name as name , count(a.order_id)as value from ylb_order_base as a left join ylb_user_info as b on a.buyer_user_id=b.user_id left join ylb_base_district as c on b.user_cityid=c.district_id where a.shop_id=".$formvars['shop_id']."  and a.order_finished_time >='".$formvars['start_time']."' and a.order_finished_time < '".$formvars['end_time']."' and a.buyer_user_id=b.user_id and b.user_cityid=c.district_id group by b.user_provinceid";
                }
            }
        }
//        d($sql_sheng);
        $data = $this->orderBaseModel->sql($sql_sheng);
        $arr[] = $this->orderBaseModel->sql($sql_shi);
        foreach ($arr as $k=>$v){
            foreach($v as $k){
                $data[] = array("name"=>$k['name'],"value"=>$k['value']);
            }
        }

        if(empty($data)){
            $result[] = array('name'=>'','value'=>'');
            $result = json_encode($result);
            return $result;
        }else{

            $result = json_encode($data);

            return $result;
        }
    }
}
