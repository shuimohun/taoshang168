<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author
 */
class Api_Seller_VipCtl extends YLB_AppController{

	public $Order_ReturnModel = null;
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);
        $this->districtModel    = new District_BaseModel();
		$this->userInfoModel    = new User_InfoModel();
        $this->userBaseModel    = new User_BaseModel();
		$this->orderBaseModel   = new Order_BaseModel();
		$this->orderGoodsModel  = new Order_GoodsModel();
	}
	//会员详细
    public  function  vip_showmember(){
        $searchtime_arr_tmp = explode('|',$_REQUEST['seartime']);

        foreach ((array)$searchtime_arr_tmp as $k => $v){
            $searchtime_arr[] = intval($v);
        }
        $etime =   $searchtime_arr[0];
        $dtime =   $searchtime_arr[1];
        $sql = "select user_id from ucenter_user_info where action_time >=".$etime." and action_time < ".$dtime."";
        $res =  $this->userInfoModel->sql($sql);
        foreach($res as $k=>$v){
            $sqls = "select I.user_id,B.user_name,B.user_truename,B.user_email,B.user_mobile,B.user_lastlogin_time,B.user_reg_time,B.user_lastlogin_ip,B.user_count_login,B.user_msn,B.user_qq,B.user_money,B.user_credit from ucenter_user_info as I left join ucenter_user_info_detail as B on I.user_name=B.user_name where I.user_id=".$v['user_id'];
            $arr[] =  $this->userInfoModel->sql($sqls);
        }
        foreach ($arr as $k => $v){
            foreach ($v as $key => $value){
                $data['items'][] = $value;
            }
        }
        $data['records'] = 4;
        $data['total'] = 4;
        $this->data->addBody(-140, $data);
    }
    //新增会员统计表
	public function vip_detil()
	{
        $sort_text = '新增会员数';
        if(request_string('start_time')=='undefined' || request_string('start_time')==''){
            $stat_time = '';
        }else{
            $stat_time = request_string('start_time');
        }

//        $stime = '1488729600';
        $stime = $stat_time ;//昨天0点
        for($i=0; $i<24; $i++){
            //统计图数据
            $curr_arr[$i] = 0;//今天
            $up_arr[$i] = 0;//昨天
            //横轴
            $stat_arr['xAxis']['categories'][] = "$i";
        }
//        $etime = '1488902399';
        $etime = $stat_time + 86400 - 1;//今天24点
        $yesterday_day = @date('d', $stime);//昨天日期
        $today_day = @date('d', $etime);//今天日期
        //查询统计数据
        $cond_row['action_time:>='] =   $stime;
        $cond_row['action_time:<'] = $etime;
        $cond_row['field'] = 'user_id,action_time,count(user_id) as user_count ';
        $cond_row['group'] = 'user_id';

        $key                 = YLB_Registry::get('shop_api_key');
        //查找ucenter註冊用戶
        $memberlist = get_url_with_encrypt($key, sprintf('%s?ctl=Api_User_Info&met=getUserinsert&typ=json', YLB_Registry::get('ucenter_api_url')), $cond_row);
        if($memberlist){
            foreach($memberlist['data']['items'] as $k => $v){
                $ste_time = date('Y-m-d H:i:s',$v['action_time']);
                //查詢天和小時
                $dayval = "select day('$ste_time') as dayval";
                $hourval = "select hour('$ste_time') as hourval ";
                $dayval_time =  $this->orderBaseModel->sql($dayval);
                $hourval_time =  $this->orderBaseModel->sql($hourval);
                if($today_day == $dayval_time[0]['dayval']){
                    $curr_arr[$hourval_time[0]['hourval']] = intval($v['user_count']);
                    $currlist_arr[$hourval_time[0]['hourval']]['val'] = intval($v['user_count']);
                }
                if($yesterday_day == $dayval_time[0]['dayval']){
                    $up_arr[$hourval_time[0]['hourval']] = intval($v['user_count']);
                    $uplist_arr[$hourval_time[0]['hourval']]['val'] = intval($v['user_count']);
                }
            }
        }
        $stat_arr['series'][0]['name'] = '昨天';
        $stat_arr['series'][0]['data'] = array_values($up_arr);
        $stat_arr['series'][1]['name'] = '今天';
        $stat_arr['series'][1]['data'] = array_values($curr_arr);
        //得到统计图数据
        $stat_arr['title'] = '新增会员统计';
        $stat_arr['yAxis'] = $sort_text;
        $stat_json = $this->getStatData_LineLabels($stat_arr);
        $this->data->addBody(-140, $stat_json);

	}
    //新增会员列表
	public function demo(){

        $page          	= request_int('page', 1);
        $rows          	= request_int('rows', 100);
        if(request_string('start_time')=='undefined' || request_string('start_time')==''){
            $etime = date('Y-m-d',time());
        }else{
            $etime = request_string('start_time');
        }
        $count_arr = array('up'=>0,'curr'=>0);
        $stat_time = strtotime($etime);
        $stime = $stat_time ;//昨天0点

//        $stime = '1488729600';
//        var_dump($stat_time);die;
        for($i=0; $i<24; $i++){
            $curr_arr[$i] = 0;//今天
            $up_arr[$i] = 0;//昨天
            //横轴
            $currlist_arr[$i]['timetext'] = $i;
            $currlist_arr[$i]['stime'] = $stime+$i*3600;
            $currlist_arr[$i]['etime'] = $currlist_arr[$i]['stime']+3600;
            $uplist_arr[$i]['val'] = 0;
            $currlist_arr[$i]['val'] = 0;
        }
//        $etime = '1488902399';
        $etime = $stat_time + 86400 - 1;//今天24点

        $count_arr['seartime'] = ($stime+86400).'|'.$etime;
        $yesterday_day = @date('d', $stime);//昨天日期
        $today_day = @date('d', $etime);//今天日期
        //查询统计数据
        $cond_row['action_time:>='] =   $stime;
        $cond_row['action_time:<'] =    $etime;
        $cond_row['field'] = 'user_id,action_time,count(user_id) as user_count ';
        $cond_row['group'] = 'user_id';

        $key                 = YLB_Registry::get('shop_api_key');
        //查找ucenter註冊用戶
        $memberlist = get_url_with_encrypt($key, sprintf('%s?ctl=Api_User_Info&met=getUserinsert&typ=json', YLB_Registry::get('ucenter_api_url')), $cond_row);

        if($memberlist){
            foreach($memberlist['data']['items'] as $k => $v){
                $ste_time = date('Y-m-d H:i:s',$v['action_time']);

                //查詢天和小時
                $dayval = "select day('$ste_time') as dayval";
                $hourval = "select hour('$ste_time') as hourval ";
                $dayval_time =  $this->orderBaseModel->sql($dayval);
                $hourval_time =  $this->orderBaseModel->sql($hourval);

                if($today_day == $dayval_time[0]['dayval']){
                    $curr_arr[$hourval_time[0]['hourval']] = intval($v['user_count']);
                    $currlist_arr[$hourval_time[0]['hourval']]['val'] = intval($v['user_count']);
                    $currlist_arr[$hourval_time[0]['hourval']]['user_id'] = intval($v['user_id']);
                    $count_arr['curr'] += intval($v['user_count']);
                }

                if($yesterday_day == $dayval_time[0]['dayval']){
                    $up_arr[$hourval_time[0]['hourval']] = intval($v['user_count']);
                    $uplist_arr[$hourval_time[0]['hourval']]['val'] = intval($v['user_count']);
                    $uplist_arr[$hourval_time[0]['hourval']]['user_id'] = intval($v['user_id']);
                    $count_arr['up'] += intval($v['user_count']);
                }
            }
        }

        //计算同比
        foreach ($currlist_arr as $k => $v){
            $tmp = array();
            $tmp['timetext'] = $v['timetext'];
            $tmp['seartime'] = $v['stime'].'|'.$v['etime'];
            $tmp['user_id']  = $v['user_id'];

            $tmp['currentdata'] = $v['val'];
            $tmp['updata'] = $uplist_arr[$k]['val'];
            $tmp['tbrate'] = $this->getTb($tmp['updata'], $tmp['currentdata']);
            //计算总结同比
            $statlist['data'][]  = $tmp;
        }
        $statlist['data'][]['tbrateSum'] = $this->getTb($count_arr['up'], $count_arr['curr']);

		$this->data->addBody(-140, $statlist);
	}
    //计算同比
    function getTb($updata, $currentdata){
        if($updata != 0){
            $ytoyrate = round(($currentdata - $updata)/$updata*100, 2).'%';
        } else {
            $ytoyrate = '-';
        }
        return $ytoyrate;
    }

    public function  vip_analysis1(){
        $User_BaseModel       = new User_BaseModel();
        if($_REQUEST['type']=='orderamount'){
            $sort_text = '下单金额';
        }else if($_REQUEST['type']=='goodsnum'){
            $sort_text = '下单量';
        }else{
            $sort_text = '下单商品数';
        }
        $etime = $_REQUEST['start_time'];

        if($etime!='undefined'){
            $etime  = strtotime($etime);
            $start_time = mktime(0,0,0,date("m",$etime),date("d",$etime),date("Y",$etime));  //当天开始时间
            $end_time = mktime(23,59,59,date("m",$etime),date("d",$etime),date("Y",$etime)); //当天结束时间
            $start_time = date('Y-m-d H:i:s',$start_time);
            $end_time = date('Y-m-d H:i:s',$end_time);
        }else{
            $start_time = '';
            $end_time = date('Y-m-d H:i:s',time());
        }

        for($i=1; $i<=15; $i++){
            //数据
            $stat_arr['series'][0]['data'][] = array('name'=>'','y'=>0);
            //横轴
            $stat_arr['xAxis']['categories'][] = "$i";
        }
        $page     = request_int('page', 1);
        $rows     = request_int('rows', 10);
        switch ($_REQUEST['type']){
            case 'goodsnum':
                $orderby = 'goodsnum desc';
                $sql = "select buyer_user_id, SUM(order_goods_num) as goodsnum from ". $this->orderGoodsModel->tabase()." where order_goods_time >= '".$start_time."' and order_goods_time < '".$end_time."' group by buyer_user_id order by ".$orderby." limit 15";
                $statlist = $this->orderBaseModel->sql($sql);
                break;
            case 'goodscount':
                $orderby = 'goodscount desc';
                $sql = "select buyer_user_id,count(order_goods_num) as goodscount from ". $this->orderGoodsModel->tabase()." where order_goods_time >= '".$start_time."' and order_goods_time < '".$end_time."' group by buyer_user_id order by ".$orderby." limit 15";
                $statlist = $this->orderBaseModel->sql($sql);
                break;
            default:
                $_REQUEST['type'] = 'orderamount';
                $orderby = 'orderamount desc';
                $sql = "select buyer_user_id,SUM(order_goods_amount) as orderamount from ". $this->orderGoodsModel->tabase()." where order_goods_time >= '".$start_time."' and order_goods_time < '".$end_time."' group by buyer_user_id order by ".$orderby." limit 15";
                $statlist = $this->orderBaseModel->sql($sql);
                break;
        }
        $items = $statlist;
        unset($statlist);
        if(!empty($items))
        {
            foreach($items as $key=>$value)
            {
                $user_id = $value['buyer_user_id'];
                if($user_id)
                {
                    $data_user = $User_BaseModel->getOne($user_id);
                    if($data_user)
                        $items[$key]['user_name'] = $data_user['user_account'];
                    else
                        $items[$key]['user_name'] = '';
                }
            }
        }
        $statlist = $items;
        foreach ((array)$statlist as $k => $v){
            $stat_arr['series'][0]['data'][$k] = array('name'=>strval($v['user_name']),'y'=>intval($v[$_REQUEST['type']]));
            $statlist[$k]['sort'] = $k+1;
        }
        $stat_arr['series'][0]['name'] = $sort_text;
        $stat_arr['legend']['enabled'] = false;
        //得到统计图数据
        $stat_arr['title'] = '买家排行Top15';
        $stat_arr['yAxis'] = $sort_text;
        $stat_json = $this->getStatData_LineLabels($stat_arr);
        $this->data->addBody(-140, $stat_json);
    }

    //会员规模
    public function  vip_scale_demo(){
        if(!request_string('start_time')){
            $etime = '1970-01-01';
        }else{
            $etime = request_string('start_time');
        }
        if(!request_string('end_time')){
            $dtime = date('Y-m-d H:i:s',time());
        }else{
            $dtime =  request_string('end_time');
        }

        $PointsLogModel = new Points_LogModel();
        $sql_select['order_goods_amount'] = "select buyer_user_id,sum(order_goods_amount)as order_goods_amount,buyer_user_name from YLB_order_base where order_create_time >= '".$etime."' and order_create_time < '".$dtime."'  group by buyer_user_id order by order_goods_amount ";
        $arr['data']['order_goods_amount'] = $this->orderBaseModel->sql($sql_select['order_goods_amount']);
        $key = YLB_Registry::get('shop_api_key');

        $sql_select['deposit_amount'] = "select user_id,user_nickname,sum(record_money)as deposit_amount  from pay_consume_record where trade_type_id=3  and  record_date >= '".$etime."' and record_date < '".$dtime."' group by user_id";
        $arr['data']['deposit_amount'] = $this->orderBaseModel->sql($sql_select['deposit_amount']);

        $sql_select['consumption'] = "select user_id,user_nickname,sum(record_money)as consumption  from pay_consume_record where  record_date >= '".$etime."' and record_date < '".$dtime."' and  (trade_type_id=1|| trade_type_id=2)  group by user_id";
        $arr['data']['consumption'] = $this->orderBaseModel->sql($sql_select['consumption']);
//        var_dump($sql_select['consumption']);die;
        $sql_select['delete_price'] = "select user_id,user_name,sum(points_log_points) as delete_points from YLB_points_log where points_log_type=2 and points_log_time >='".$etime."' and points_log_time < '".$dtime."' GROUP  by user_id";
        $arr['data']['delete_price'] = $PointsLogModel->sql($sql_select['delete_price']);

        $sql_select['add_price'] = "select user_id,user_name,sum(points_log_points) as add_points from YLB_points_log where points_log_type=1 and points_log_time >= '".$etime."' and points_log_time < '".$dtime."' GROUP  by user_id";
        $arr['data']['add_price'] = $PointsLogModel->sql($sql_select['add_price']);
        foreach ($arr['data']['order_goods_amount'] as $k => $v){
           foreach ($arr['data']['deposit_amount'] as $ke => $va){
               if ($v['buyer_user_id'] == $va['user_id']){
                    $data[$v['buyer_user_id']]['deposit_amount'] = $va['deposit_amount'];
                    $data[$v['buyer_user_id']]['order_goods_amount'] = $v['order_goods_amount'];
                   $data[$v['buyer_user_id']]['buyer_user_name'] = $v['buyer_user_name'];
               }else{
                   $data[$va['user_id']]['deposit_amount'] =  $va['deposit_amount'];
                   $data[$va['user_id']]['buyer_user_name'] = $va['user_nickname'];
                   $data[$v['buyer_user_id']]['order_goods_amount'] = $v['order_goods_amount'];
//                   $data[$v['buyer_user_id']]['buyer_user_name'] = $v['buyer_user_name'];
               }
           }
           foreach ($arr['data']['consumption'] as $ky => $vals){
               if ($v['buyer_user_id'] == $vals['user_id']){
                   $data[$v['buyer_user_id']]['consumption'] = $vals['consumption'];
                   $data[$v['buyer_user_id']]['order_goods_amount'] = $v['order_goods_amount'];
                   $data[$v['buyer_user_id']]['buyer_user_name'] = $v['buyer_user_name'];
               }else{
                   $data[$vals['user_id']]['consumption'] =  $vals['consumption'];
                   $data[$vals['user_id']]['buyer_user_name'] = $vals['user_nickname'];
                   $data[$v['buyer_user_id']]['order_goods_amount'] = $v['order_goods_amount'];
               }
           }
           foreach ($arr['data']['add_price'] as $key => $val){
               if ($v['buyer_user_id'] == $val['user_id']){
                   $data[$v['buyer_user_id']]['add_points'] = $val['add_points'];
               }else{
                   $data[$val['user_id']]['add_points'] =  $val['add_points'];
                   $data[$val['user_id']]['buyer_user_name'] = $val['user_name'];
               }
           }
           foreach ($arr['data']['delete_price'] as $keys => $value){
                if($v['buyer_user_id'] == $value['user_id']){
                    $data[$v['buyer_user_id']]['delete_points'] = $value['delete_points'];
                }else{
                    $data[$value['user_id']]['delete_points'] = $value['delete_points'];
                    $data[$value['user_id']]['buyer_user_name'] = $value['user_name'];
                }
           }
        }
        $data_cat_rows = array_values($data);
        $this->data->addBody(-140,$data_cat_rows );
    }
    //会员分析
    public function  vip_analysis_demo(){

        $etime = $_REQUEST['start_time'];

        if($etime!='undefined'){
            $etime  = strtotime($etime);
            $start_time = mktime(0,0,0,date("m",$etime),date("d",$etime),date("Y",$etime));  //当天开始时间
            $end_time = mktime(23,59,59,date("m",$etime),date("d",$etime),date("Y",$etime)); //当天结束时间
            $start_time = date('Y-m-d H:i:s',$start_time);
            $end_time = date('Y-m-d H:i:s',$end_time);
        }else{
            $start_time = '';
            $end_time = date('Y-m-d H:i:s',time());
        }

        $User_BaseModel       = new User_BaseModel();
        switch ($_REQUEST['type']){
            case 'goodsnum':
                $orderby = 'goodsnum desc';
                $sql = "select buyer_user_id, order_goods_time,SUM(order_goods_num) as goodsnum from ". $this->orderGoodsModel->tabase()." where order_goods_time >= '".$start_time."' and order_goods_time < '".$end_time."' group by buyer_user_id order by ".$orderby." limit 15";
                break;
            case 'goodscount':
                $orderby = 'goodscount desc';
                $sql = "select buyer_user_id,order_goods_time,count(order_goods_num) as goodscount from ". $this->orderGoodsModel->tabase()." where order_goods_time >= '".$start_time."' and order_goods_time < '".$end_time."' group by buyer_user_id order by ".$orderby." limit 15";
                break;
            default:
                $_REQUEST['type'] = 'orderamount';
                $orderby = 'orderamount desc';
                $sql = "select buyer_user_id,order_goods_time,SUM(order_goods_amount) as orderamount from ". $this->orderGoodsModel->tabase()." where order_goods_time >= '".$start_time."' and order_goods_time < '".$end_time."' group by buyer_user_id order by ".$orderby." limit 15";
                break;
        }
        $statlist = $this->orderBaseModel->sql($sql);
        $items = $statlist;
        unset($statlist);
        if(!empty($items))
        {
            foreach($items as $key=>$value)
            {
                $user_id = $value['buyer_user_id'];
                if($user_id)
                {
                    $data_user = $User_BaseModel->getOne($user_id);
                    if($data_user)
                        $items[$key]['user_name'] = $data_user['user_account'];
                    else
                        $items[$key]['user_name'] = '';
                }
            }
        }
        $statlist = $items;

        $this->data->addBody(-140, $statlist);
    }
    //导出excel
    public function getReturnAllExcels()
    {
        $etime = request_string('start_time');
        if(!empty($etime)){
            $etime  = strtotime($etime);
            $start_time = mktime(0,0,0,date("m",$etime),date("d",$etime),date("Y",$etime));  //当天开始时间
            $end_time = mktime(23,59,59,date("m",$etime),date("d",$etime),date("Y",$etime)); //当天结束时间
            $start_time = date('Y-m-d H:i:s',$start_time);
            $end_time = date('Y-m-d H:i:s',$end_time);
        }else{
            $start_time = '';
            $end_time = date('Y-m-d H:i:s',time());
        }
        $User_BaseModel       = new User_BaseModel();
        switch ($_REQUEST['type']){
            case 'goodsnum':
                $orderby = 'goodsnum desc';
                $sql = "select buyer_user_id, SUM(order_goods_num) as goodsnum from ". $this->orderGoodsModel->tabase()." where order_goods_time >= '".$start_time."' and order_goods_time < '".$end_time."' group by buyer_user_id order by ".$orderby." limit 15";
                break;
            case 'goodscount':
                $orderby = 'goodscount desc';
                $sql = "select buyer_user_id,count(order_goods_num) as goodscount from ". $this->orderGoodsModel->tabase()." where order_goods_time >= '".$start_time."' and order_goods_time < '".$end_time."' group by buyer_user_id order by ".$orderby." limit 15";
                break;
            default:
                $_REQUEST['type'] = 'orderamount';
                $orderby = 'orderamount desc';
                $sql = "select buyer_user_id,SUM(order_goods_amount) as orderamount from ". $this->orderGoodsModel->tabase()." where order_goods_time >= '".$start_time."' and order_goods_time < '".$end_time."' group by buyer_user_id order by ".$orderby." limit 15";
                break;
        }

        $statlist = $this->orderBaseModel->sql($sql);
        $items = $statlist;
        unset($statlist);
        if(!empty($items))
        {
            foreach($items as $key=>$value)
            {
                $user_id = $value['buyer_user_id'];
                if($user_id)
                {
                    $data_user = $User_BaseModel->getOne($user_id);
                    if($data_user)
                        $items[$key]['user_name'] = $data_user['user_account'];
                    else
                        $items[$key]['user_name'] = '';
                }
            }
        }
        if($_REQUEST['type']=='orderamount'){
            $name = '下单金额';
            $str = 'orderamount';
        }else if($_REQUEST['type']=='goodsnum'){
            $name = '下单量';
            $str = 'goodsnum';
        }else{
            $name = '下单商品数';
            $str = 'goodscount';
        }

        $statlist = $items;
        $this->data->addBody(-140, $statlist);
        $tit = array(
            "序号",
            "操作",
            "用户名称",
            $name
        );
        $key = array(
            "operating",
            "user_name",
            $str
        );

        $this->excel("买家排行Top15", $tit, $statlist, $key);
    }
    //区域分析 地图分析
    public function area_map(){
        //查询统计数据
        if(!request_string('start_time')){
            $etime = '';
        }else{
            $etime = strtotime(request_string('start_time'));
        }
        if(!request_string('end_time')){
            $dtime = time();
        }else{
            $dtime = strtotime(request_string('end_time'));
        }

        $User_BaseModel       = new User_BaseModel();
        switch ($_REQUEST['type']){
            case 'goodsnum':
                $sql = "select sum(c.order_goods_num)as value,d.district_name as name from YLB_order_goods as c left join ucenter_user_info as a on c.buyer_user_id=a.user_id left join ucenter_user_info_detail as b on a.user_name=b.user_name left join YLB_base_district as d on b.user_provinceid=d.district_id where c.buyer_user_id=a.user_id and a.user_name=b.user_name and b.user_provinceid=d.district_id and b.user_reg_time >='".$etime."' and b.user_reg_time < '".$dtime."'  group by user_provinceid desc";
                break;
            case 'goodscount':
                $sql = "select count(c.order_goods_num) as value,d.district_name as name from YLB_order_goods as c left join ucenter_user_info as a on c.buyer_user_id=a.user_id left join ucenter_user_info_detail as b on a.user_name=b.user_name left join YLB_base_district as d on b.user_provinceid=d.district_id where c.buyer_user_id=a.user_id and a.user_name=b.user_name  and b.user_provinceid=d.district_id and b.user_reg_time >='".$etime."' and b.user_reg_time < '".$dtime."'  group by user_provinceid desc";
                break;
            default:
                $_REQUEST['type'] = 'orderamount';
                $sql = "select SUM(c.order_goods_amount) as value,d.district_name as name from YLB_order_goods as c left join ucenter_user_info as a on c.buyer_user_id=a.user_id left join ucenter_user_info_detail as b on a.user_name=b.user_name left join YLB_base_district as d on b.user_provinceid=d.district_id where c.buyer_user_id=a.user_id and a.user_name=b.user_name  and b.user_provinceid=d.district_id and b.user_reg_time >='".$etime."' and b.user_reg_time < '".$dtime."'  group by user_provinceid desc";
                break;
        }
       $res = $User_BaseModel->sql($sql);
        $this->data->addBody(-140, $res);
    }
    //购买时段分布/
    public function Buy_time_distribution(){
        if(!request_string('start_time') || request_string('start_time')=='undefined'){
            $start_time = date('Y-m-d',time());
        }else{
            $start_time = request_string('start_time');
        }
        $stat_time = strtotime($start_time);
        for($i=0; $i<24; $i++){
            //统计图数据
            $curr_arr[$i] = 0;//今天
            $up_arr[$i] = 0;//昨天
            //横轴
            $stat_arr['xAxis']['categories'][] = "$i";
        }
        $stime = $stat_time - 86400;//昨天0点
        $etime = $stat_time - 1 ;//今天24点
        $field = ' HOUR(order_create_time) as hourval,COUNT(*) as ordernum ';
        $cond_row['order_create_time:>='] =  date('Y-m-d H:i:s', $stime);
        $cond_row['order_create_time:<'] = date('Y-m-d H:i:s', $etime);
        $sql = "select ".$field." from YLB_order_base where (order_create_time >= '".date('Y-m-d H:i:s', $stime)."' AND order_create_time < '".date('Y-m-d H:i:s', $etime)."' ) group by hourval order by hourval asc";
        $orderlist = $this->orderBaseModel->sql($sql);
        $stat_arr = array();
        $stat_arr['series'][0]['name'] = '下单量';
        //构造横轴坐标
        for ($i=0; $i<24; $i++){
            //横轴
            $stat_arr['xAxis']['categories'][] = $i;
            $stat_arr['series'][0]['data'][$i] = 0;
        }
        foreach ((array)$orderlist as $k => $v){
            //统计图数据
            $stat_arr['series'][0]['data'][$v['hourval']] = intval($v['ordernum']);
        }
        //得到统计图数据
        $stat_arr['title'] = '购买时段分布';
        $stat_arr['legend']['enabled'] = false;
        $stat_arr['yAxis'] = '下单量';
        $hour_statjson = $this->getStatData_LineLabels($stat_arr);
        $this->data->addBody(-140, $hour_statjson);
    }

    //地图统计图
    function getStatData_Map($stat_arr,$type){
        //$color_arr = array('#f63a3a','#ff5858','#ff9191','#ffc3c3','#ffd5d5');
        $color_arr = array('#fd0b07','#ff9191','#f7ba17','#fef406','#25aae2');
        $stat_arrnew = array();
        foreach ($stat_arr as $k=>$v){
            $stat_arrnew[] = array('cha'=>$v['cha'],'name'=>$v['name'],'des'=>$v['des'],'color'=>$color_arr[$v['level']]);
        }
        return $stat_arrnew;
    }

    public function getReturnAllExcel(){
        $searchtime_arr_tmp = explode('|',$_REQUEST['seartime']);

        foreach ((array)$searchtime_arr_tmp as $k => $v){
            $searchtime_arr[] = intval($v);
        }
        $etime =  date('Y-m-d H:i:s', $searchtime_arr[0]);
        $dtime = date('Y-m-d H:i:s', $searchtime_arr[1]);
        $sql = "select user_id from YLB_user_info where user_active_time >='".$etime."' and user_active_time < '".$dtime."'";
        $res =  $this->userInfoModel->sql($sql);
        foreach($res as $k=>$v){
            $sql_s = "select I.user_id,I.user_name,I.user_realname,I.user_email,I.user_active_time,B.user_login_times,B.user_login_time,B.user_login_ip,I.user_ww,I.user_qq,I.user_points,I.user_cash,I.user_freeze_cash from YLB_user_info as I left join YLB_user_base as B on I.user_id=B.user_id where I.user_id=".$v['user_id']." and B.user_id=".$v['user_id'];
            $data[] =  $this->userInfoModel->sql($sql_s);
        }
        $tit = array(
            "序号",
            "会员名称",
            "真实姓名",
            "邮箱",
            "注册时间",
            "登陆次数",
            "最后登录时间",
            "最后登录IP",
            "旺旺",
            "Q Q",
            "金蛋",
            "可用预存款（元）",
            "冻结预存款（元）"
        );
        $key = array(
            "operating",
            "user_name",
            "user_realname",
            "user_email",
            "user_active_time",
            "user_login_times",
            "user_login_time",
            "user_login_ip",
            "user_ww",
            "user_qq",
            "user_points",
            "user_cash",
            "user_freeze_cash",
        );

        $this->excel("会员详细", $tit, $data, $key);
    }

    function getStatData_LineLabels($stat_arr){

        //图表区、图形区和通用图表配置选项
        $stat_arr['chart']['type'] = 'line';
        //图表序列颜色数组
        $stat_arr['colors']?'':$stat_arr['colors'] = array('#058DC7', '#ED561B', '#8bbc21', '#0d233a');
        //去除版权信息
        $stat_arr['credits']['enabled'] = false;
        //导出功能选项
        $stat_arr['exporting']['enabled'] = false;
        //标题如果为字符串则使用默认样式
        is_string($stat_arr['title'])?$stat_arr['title'] = array('text'=>"<b>{$stat_arr['title']}</b>",'x'=>-20):'';
        //子标题如果为字符串则使用默认样式
        is_string($stat_arr['subtitle'])?$stat_arr['subtitle'] = array('text'=>"<b>{$stat_arr['subtitle']}</b>",'x'=>-20):'';
        //Y轴如果为字符串则使用默认样式
        if(is_string($stat_arr['yAxis'])){
            $text = $stat_arr['yAxis'];
            unset($stat_arr['yAxis']);
            $stat_arr['yAxis']['title']['text'] = $text;
        }
        return $stat_arr;
    }

    function excel($title, $tit, $con, $key)
    {
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("mall_new");
        $objPHPExcel->getProperties()->setLastModifiedBy("mall_new");
        $objPHPExcel->getProperties()->setTitle($title);
        $objPHPExcel->getProperties()->setSubject($title);
        $objPHPExcel->getProperties()->setDescription($title);
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle($title);
        $letter = array(
            'A',
            'B',
            'C',
            'D',
            'E',
            'F',
            'G',
            'H',
            'I',
            'J',
            'K',
            'L',
            'M',
            'N',
            'O',
            'P',
            'Q',
            'R',
            'S',
            'T'
        );
        foreach ($tit as $k => $v)
        {
            $objPHPExcel->getActiveSheet()->setCellValue($letter[$k] . "1", $v);
        }

        foreach ($con as $k => $v)
        {
            $objPHPExcel->getActiveSheet()->setCellValue($letter[0] . ($k + 2), $k + 1);
            foreach ($key as $k2 => $v2)
            {
                $objPHPExcel->getActiveSheet()->setCellValue($letter[$k2 + 1] . ($k + 2), $v[$v2]);
            }
        }
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$title.xls\"");
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        die();
    }
}
