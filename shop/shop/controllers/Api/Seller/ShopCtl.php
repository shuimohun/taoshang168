<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author
 */
class Api_Seller_ShopCtl extends YLB_AppController{
    public static $shop_status            = array(
        "0" => "关闭",
        "1" => "待审核信息",
        "2" => "待审核付款",
        "3" => "开店成功",
        "4" => "审核未通过"
    );
    public static $shop_grade_name        = '自营店铺';
    public static $shop_payment           = array(
        "0" => "未付款",
        "1" => "已付款"
    );
	public $Order_ReturnModel = null;
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);
        $this->districtModel    = new District_BaseModel();
        $this->shopBaseModel    = new Shop_BaseModel();
		$this->userInfoModel    = new User_InfoModel();
        $this->userBaseModel    = new User_BaseModel();
		$this->orderBaseModel   = new Order_BaseModel();
		$this->orderGoodsModel  = new Order_GoodsModel();
		$this->shopGradeModel   = new Shop_GradeModel();
	}
	//店铺详细
    public  function  shop_detail(){
        $searchtime_arr_tmp = explode('|',$_REQUEST['seartime']);

        foreach ((array)$searchtime_arr_tmp as $k => $v){
            $searchtime_arr[] = intval($v);
        }
        $etime =  date('Y-m-d H:i:s', $searchtime_arr[0]);
        $dtime = date('Y-m-d H:i:s', $searchtime_arr[1]);
        $sql = "select shop_name,user_name,shop_account,shop_grade_id,shop_class_id,shop_end_time,shop_status,shop_create_time from YLB_shop_base where shop_create_time >='".$etime."' and shop_create_time < '".$dtime."'";
        $data['items'] =  $this->shopBaseModel->sql($sql);
        foreach ($data['items'] as $k =>$v ){
            if ($v['shop_grade_id'])
            {
                //获取等级名
                $shopGradeModel     = new Shop_GradeModel();
                $shop_grade_id      = $v['shop_grade_id'];
                $data['items'][$k]["shop_grade"] = $shopGradeModel->getGradeName("$shop_grade_id");
            }
            else
            {
                $data['items'][$k]["shop_grade"] = _(self::$shop_grade_name);
            }
            if ($v['shop_class_id'])
            {
                //获取分类名
                $shopClassModel     = new Shop_ClassModel();
                $shop_class_id      = $v['shop_class_id'];
                $data['items'][$k]["shop_class"] = $shopClassModel->getClassName("$shop_class_id");
            }
            if($v["shop_status"]){
                $data['items'][$k]["shop_status_cha"]    = _(self::$shop_status[$v["shop_status"]]);
            }
        }
        $data['records'] = 4;
        $data['total'] = 4;
        $this->data->addBody(-140, $data);
    }
    //店铺新增统计表
	public function shop_cartogram()
	{
        $sort_text = '新增店铺数';

        if(request_string('start_time')=='undefined' || request_string('start_time')==''){
            $etime = date('Y-m-d',time());
        }else{
            $etime = request_string('start_time');
        }
        $stat_time = strtotime($etime);
        $stime = $stat_time - 86400;//昨天0点
//        $stime = '1488729600';
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
        $cond_row['shop_create_time:>='] =  date('Y-m-d H:i:s', $stime);
        $cond_row['shop_create_time:<'] = date('Y-m-d H:i:s', $etime);
        if(request_int('shop_class_id')){
            $cond_row['shop_class_id'] = request_int('shop_class_id');
        }
        $field = 'count(shop_id) as shop_count , DAY(shop_create_time) as dayval,HOUR(shop_create_time) as hourval ';
        $group = 'dayval,hourval';
        $memberlist = $this->shopBaseModel->getShopinsert($field,$cond_row,$group);

        if($memberlist){
            foreach($memberlist as $k => $v){
                if($today_day == $v['dayval']){
                    $curr_arr[$v['hourval']] = intval($v['shop_count']);

                    $currlist_arr[$v['hourval']]['val'] = intval($v['shop_count']);
                }
                if($yesterday_day == $v['dayval']){
                    $up_arr[$v['hourval']] = intval($v['shop_count']);
                    $uplist_arr[$v['hourval']]['val'] = intval($v['shop_count']);
                }
            }
        }
        $stat_arr['series'][0]['name'] = '昨天';
        $stat_arr['series'][0]['data'] = array_values($up_arr);
        $stat_arr['series'][1]['name'] = '今天';
        $stat_arr['series'][1]['data'] = array_values($curr_arr);

        //得到统计图数据
        $stat_arr['title'] = '新增店铺统计';
        $stat_arr['yAxis'] = $sort_text;
        $stat_json = $this->getStatData_LineLabels($stat_arr);
        $this->data->addBody(-140, $stat_json);

	}
    //店铺新增列表
	public function demo(){
        $count_arr = array('up'=>0,'curr'=>0);
        if(request_string('start_time')=='undefined' || request_string('start_time')==''){
            $etime = date('Y-m-d',time());
        }else{
            $etime = request_string('start_time');
        }
        $stat_time = strtotime($etime);
        $stime = $stat_time - 86400;//昨天0点
//        $stime = '1488729600';
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
        $cond_row['shop_create_time:>='] =  date('Y-m-d H:i:s', $stime);
        $cond_row['shop_create_time:<'] = date('Y-m-d H:i:s', $etime);
        if(request_int('shop_class_id')){
            $cond_row['shop_class_id'] = request_int('shop_class_id');
        }
        $field = 'shop_id,user_id,count(shop_id) as shop_count, DAY(shop_create_time) as dayval,HOUR(shop_create_time) as hourval ';
        $group = 'dayval,hourval';
        $memberlist = $this->shopBaseModel->getShopinsert($field,$cond_row,$group);
        if($memberlist){
            foreach($memberlist as $k => $v){
                if($today_day == $v['dayval']){
                    $curr_arr[$v['hourval']] = intval($v['shop_count']);
                    $currlist_arr[$v['hourval']]['val'] = intval($v['shop_count']);
                    $currlist_arr[$v['hourval']]['user_id'] = intval($v['user_id']);
                    $currlist_arr[$v['hourval']]['shop_id'] = intval($v['shop_id']);
                    $count_arr['curr'] += intval($v['shop_count']);
                }
                if($yesterday_day == $v['dayval']){
                    $up_arr[$v['hourval']] = intval($v['shop_count']);
                    $uplist_arr[$v['hourval']]['val'] = intval($v['shop_count']);
                    $uplist_arr[$v['hourval']]['user_id'] = intval($v['user_id']);
                    $uplist_arr[$v['hourval']]['shop_id'] = intval($v['shop_id']);
                    $count_arr['up'] += intval($v['shop_count']);
                }
            }
        }
        //计算同比
        foreach ($currlist_arr as $k => $v){
            $tmp = array();
            $tmp['timetext'] = $v['timetext'];
            $tmp['seartime'] = $v['stime'].'|'.$v['etime'];
            $tmp['user_id']  = $v['user_id'];
            $tmp['shop_id']  = $v['shop_id'];
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
    //热卖排行
    function  shop_analysis_demo (){
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
        if(request_int('shop_class')){
            $shop_class_id = ' and shop_class_id ='.request_int('shop_class');
        }else{
            $shop_class_id = '';
        }
        //分页
        $YLB_Page           = new YLB_Page();
        $YLB_Page->listRows = request_int('listRows')?request_int('listRows'):50;
        $rows              = $YLB_Page->listRows;
        $offset            = request_int('firstRow', 0);
        $page              = ceil_r($offset / $rows);
        switch ($_REQUEST['type']){
            case 'goodsnum':
                $orderby = 'goodsnum desc';
                $sql = " select B.shop_id,B.shop_name,SUM(G.order_goods_num) as goodsnum,c.shop_class_id from YLB_order_base as B left JOIN YLB_order_goods as G on B.order_id = G.order_id left join YLB_shop_base as c on B.shop_id=c.shop_id where order_goods_time >= '".$etime."' and order_goods_time < '".$dtime."'".$shop_class_id." group by B.shop_id order by ".$orderby." limit 15";
                break;
            default:
                $_REQUEST['type'] = 'orderamount';
                $orderby = 'orderamount desc';
                $sql = " select B.shop_id,B.shop_name,SUM(G.order_goods_amount) as orderamount,c.shop_class_id from YLB_order_base as B left JOIN YLB_order_goods as G on B.order_id = G.order_id left join YLB_shop_base as c on B.shop_id=c.shop_id where order_goods_time >= '".$etime."' and order_goods_time < '".$dtime."'".$shop_class_id." group by B.shop_id order by ".$orderby." limit 15";
                break;
        }
        $data = $this->orderBaseModel->sql($sql);

        if($data)
        {
            $msg = _('success');
            $status = 200;
        }
        else
        {
            $msg = _('failure');
            $status = 250;
        }
        $this->data->addBody(-140,$data,$msg,$status);
    }
    //热卖排行  图表
    public function  shop_analysis1(){
        $User_BaseModel       = new User_BaseModel();
        if($_REQUEST['type']=='orderamount'){
            $sort_text = '下单金额';
        }else if($_REQUEST['type']=='goodsnum'){
            $sort_text = '下单量';
        }
        if(request_string('start_time')=='undefined' || request_string('start_time')==''){
            $etime = date('Y-m-d',time());
        }else{
            $etime = request_string('start_time');
        }
        $stat_time = strtotime($etime);
        for($i=1; $i<=15; $i++){
            //数据
            $stat_arr['series'][0]['data'][] = array('name'=>'','y'=>0);
            //横轴
            $stat_arr['xAxis']['categories'][] = "$i";
        }
        $stime = $stat_time - 86400;//昨天0点
        $etime = $stat_time + 86400 - 1;//今天24点
        //查询统计数据
        $oldtime =  date('Y-m-d H:i:s', $stime);
        $smalltime  = date('Y-m-d H:i:s', $etime);
        if(request_int('shop_class_id')){
            $shop_class_id = ' and shop_class_id ='.request_int('shop_class_id');
        }else{
            $shop_class_id = '';
        }
        switch ($_REQUEST['type']){
            case 'goodsnum':
                $orderby = 'goodsnum desc';
                $sql = " select B.shop_id,B.shop_name,SUM(G.order_goods_num) as goodsnum from YLB_order_base as B left JOIN YLB_order_goods as G on B.order_id = G.order_id where order_finished_time >= '".$oldtime."' and order_finished_time < '".$smalltime."'".$shop_class_id." group by B.shop_id order by ".$orderby." limit 15";
                break;
            default:
                $_REQUEST['type'] = 'orderamount';
                $orderby = 'orderamount desc';
                $sql = " select B.shop_id,B.shop_name,SUM(G.order_goods_amount) as orderamount from YLB_order_base as B left JOIN YLB_order_goods as G on B.order_id = G.order_id where order_finished_time >= '".$oldtime."' and order_finished_time < '".$smalltime."'".$shop_class_id." group by B.shop_id order by ".$orderby." limit 15";
                break;
        }

        $statlist = $this->orderBaseModel->sql($sql);
        foreach ((array)$statlist as $k => $v){
            $stat_arr['series'][0]['data'][$k] = array('name'=>strval($v['shop_name']),'y'=>intval($v[$_REQUEST['type']]));
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
    //导出excel
    public function getReturnAllExcels()
    {
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
        if(request_int('shop_class')){
            $shop_class_id = ' and c.shop_class_id ='.request_int('shop_class');
        }else{
            $shop_class_id = '';
        }
        $sql = " select B.shop_id,B.shop_name,SUM(G.order_goods_amount) as orderamount ,c.shop_class_id, COUNT(G.order_goods_id) as ordernum ,COUNT(DISTINCT G.buyer_user_id) as membernum from YLB_order_base as B left JOIN YLB_order_goods as G on B.order_id = G.order_id left join YLB_shop_base as c on G.shop_id=c.shop_id where order_goods_time >= '".$etime."' and order_goods_time < '".$dtime."'".$shop_class_id." group by B.shop_id order by shop_id";
        $statlist = $this->orderBaseModel->sql($sql);
        $this->data->addBody(-140, $statlist);
        $tit = array(
            "序号",
            "操作",
            "店铺名称",
            "下单会员数",
            "下单量",
            "下单金额"
        );
        $key = array(
            "operating",
            "shop_name",
            "membernum",
            "ordernum",
            "orderamount"
        );

        $this->excel("销售统计", $tit, $statlist, $key);
    }
    //销售统计
    public function sales_statistics(){
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
        if(request_int('shop_class')){
            $shop_class_id = ' and c.shop_class_id ='.request_int('shop_class');
        }else{
            $shop_class_id = '';
        }
        //分页
        $YLB_Page           = new YLB_Page();
        $YLB_Page->listRows = request_int('listRows')?request_int('listRows'):50;
        $rows              = $YLB_Page->listRows;
        $offset            = request_int('firstRow', 0);
        $page              = ceil_r($offset / $rows);
        $sql = " select B.shop_id,B.shop_name,SUM(G.order_goods_amount) as orderamount ,c.shop_class_id, COUNT(G.order_goods_id) as ordernum ,COUNT(DISTINCT G.buyer_user_id) as membernum from YLB_order_base as B left JOIN YLB_order_goods as G on B.order_id = G.order_id left join YLB_shop_base as c on G.shop_id=c.shop_id where order_goods_time >= '".$etime."' and order_goods_time < '".$dtime."'".$shop_class_id." group by B.shop_id order by shop_id";
        $data = $this->orderBaseModel->_select_sql($sql,$page,$rows);
//        var_dump($sql);die;
        if($data)
        {
            $msg = _('success');
            $status = 200;
        }
        else
        {
            $msg = _('failure');
            $status = 250;
        }
        $this->data->addBody(-140,$data,$msg,$status);
    }
    //区域分析 地图分析
    public function area_map(){
        $District_BaseModel = new District_BaseModel();
        if(!request_string('start_time')){
            $etime = '1970-01-01';
        }else{
            if(request_string('start_time')=='undefined'){
                $etime = '1970-01-01';
            }else{
                $etime = request_string('start_time');
            }
        }
        if(!request_string('end_time')){
            $dtime = date('Y-m-d H:i:s',time());
        }else{
            if(request_string('start_time')=='undefined'){
                $dtime = date('Y-m-d H:i:s',time());
            }else{
                $dtime =  request_string('end_time');
            }
        }
        if(request_int('shop_class')){
            if(request_int('shop_class')=='undefined'){
                $shop_class_id = '';
            }else{
                $shop_class_id = ' and a.shop_class_id ='.request_int('shop_class');
            }
        }else{
            $shop_class_id = '';
        }
        $finalArr = array();//结果组
        $parentArr = array();//父类组
        //查询统计数据
       $sql = " select count(a.shop_id)as value,a.district_id,b.district_name as name from YLB_shop_base as a left join YLB_base_district as b on a.district_id=b.district_id where a.shop_create_time>='".$etime."' and a.shop_create_time < '".$dtime."' ".$shop_class_id." group by a.district_id";
       $res = $this->shopBaseModel->sql($sql);

       foreach ($res as $k =>$v){
           if($v['district_id'] > 0 ){
               $data =    $District_BaseModel->getTopParentCat($v['district_id']);
               if(in_array($data['district_name'],$parentArr)) {
                   $finalArr[$data['district_name']] += $v['value'];
               }else{
                   $parentArr[] = $data['district_name'];
                   $finalArr[$data['district_name']] = $v['value'];
               }
           }
       }
        $arr = array();
        foreach ($finalArr as $key => $value) {
            $arr[] = array("name"=>$key,"value"=>$value);
        }
        $this->data->addBody(-140, $arr);
    }
    //店铺等级
    public function  store_level(){
        $field = ' count(*) as allnum,shop_grade_id ';
        $storelist = $this->shopBaseModel->getNewStoreStatList( $field,  'shop_grade_id');
//        var_dump($storelist);die;
        $sd_list = $this->shopGradeModel->getStoreDegree();
        $statlist['headertitle'] = array();
        $statlist['data'] = array();
        //处理数组数据
        if(!empty($storelist)){
            foreach ($storelist as $k => $v){
                $storelist[$k]['p_name'] = $v['shop_grade_id'] > 0?$sd_list[$v['shop_grade_id']]:'等级无';
                $storelist[$k]['allnum'] = intval($v['allnum']);
                $statlist['headertitle'][] = $v['shop_grade_id'] > 0?$sd_list[$v['shop_grade_id']]:'等级无';
                $statlist['data'][] = $v['allnum'];
            }
            $data = array(
                'title'=>'店铺等级统计',
                'name'=>'店铺个数',
                'label_show'=>true,
                'series'=>$storelist
            );
            $stat_json = $this->getStatData_Pie($data);
        }
        $this->data->addBody(-140, $stat_json);
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
        $sql = "select shop_name,user_name,shop_account,shop_grade_id,shop_end_time,shop_create_time from YLB_shop_base where shop_create_time >='".$etime."' and shop_create_time < '".$dtime."'";
        $data =  $this->shopBaseModel->sql($sql);
        $tit = array(
            "序号",
            "店铺名称",
            "店铺账号",
            "店铺商家账号",
            "所属等级",
            "有效期至",
            "开店时间"
        );
        $key = array(
            "shop_name",
            "user_name",
            "shop_account",
            "shop_grade_id",
            "shop_end_time",
            "shop_create_time"
        );

        $this->excel("店铺详细", $tit, $data, $key);
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
    //获得饼形图数据
    function getStatData_Pie($data){
        $stat_arr['chart']['type'] = 'pie';
        $stat_arr['credits']['enabled'] = false;
        $stat_arr['title']['text'] = $data['title'];
        $stat_arr['tooltip']['pointFormat'] = '{series.name}: <b>{point.y}</b>';
        $stat_arr['plotOptions']['pie'] = array(
            'allowPointSelect'=>true,
            'cursor'=>'pointer',
            'dataLabels'=>array(
                'enabled'=>$data['label_show'],
                'color'=>'#000000',
                'connectorColor'=>'#000000',
                'format'=>'<b>{point.name}</b>: {point.percentage:.1f} %'
            )
        );
        $stat_arr['series'][0]['name'] = $data['name'];
        $stat_arr['series'][0]['data'] = array();
        foreach ($data['series'] as $k=>$v){
            $stat_arr['series'][0]['data'][] = array($v['p_name'],$v['allnum']);
        }
        return $stat_arr;
    }
}
