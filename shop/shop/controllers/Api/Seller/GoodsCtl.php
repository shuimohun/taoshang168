<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author
 */
class Api_Seller_GoodsCtl extends YLB_AppController{

	public $Order_ReturnModel = null;
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);

		$this->orderReturnModel    = new Order_ReturnModel();
        $this->orderGoodsModel    = new Order_GoodsModel();
	}

	//每日订单
    public function order_detil()
    {
        switch ($_REQUEST['type']){
            case 'goodsnum':
                $sort_text = '每日订单数据';
                break;
            default:
                $_REQUEST['type'] = 'orderamount';
                $sort_text = '每日订单金额';
                break;
        }
        //构造横轴数据
        for($i=1; $i<=24; $i++){
            //数据
            $stat_arr['series'][0]['data'][] = array('name'=>'','y'=>0);
            //横轴
            $stat_arr['xAxis']['categories'][] = "$i";
        }
        $year = date("Y");
        $month = date("m");
        $day = date("d");
        $cond_row = array();
        $stime = mktime(0,0,0,$month,$day,$year);
        $time = time();
//         测试数据
//         $cond_row['order_goods_time:>='] = '2017-05-13 10:06:11';
//         $cond_row['order_goods_time:<='] = '2017-05-13 17:53:51';
//         $cond_row['shop_id']         = '6';
        $cond_row['order_goods_time:>='] =date('Y-m-d H:i:s', $stime) ;//当天开始时间戳
        $cond_row['order_goods_time:<='] =date('Y-m-d H:i:s', $time) ;
        $cond_row['shop_id']         = Perm::$shopId;
        $field = 'goods_id,goods_name,';
        $group = 'goods_id';
        //查询统计数据
        switch ($_REQUEST['type']){
            case 'goodsnum':
                $orderby = 'goodsnum ';
                $field .= 'sum(order_goods_num) as goodsnum';
                $statlist = $this->orderGoodsModel->selectReturn($field,$cond_row,$group,$orderby);
                break;
            default:
                $_REQUEST['type'] = 'orderamount';
                $orderby = 'orderamount ';
                $field .= 'sum(order_goods_amount) as orderamount';
                $statlist = $this->orderGoodsModel->selectReturn($field,$cond_row,$group,$orderby);
                break;
        }

        foreach ($statlist['items'] as $k => $v){
            switch ($_REQUEST['type']){
                case 'goodsnum':
                    $stat_arr['series'][0]['data'][$k] = array('name'=>strval($v['goods_name']),'y'=>intval($v[$_REQUEST['type']]));
                    break;
                case 'orderamount':
                    $stat_arr['series'][0]['data'][$k] = array('name'=>strval($v['goods_name']),'y'=>floatval($v[$_REQUEST['type']]));
                    break;
            }
            $statlist[$k]['sort'] = $k+1;
        }
        $stat_arr['series'][0]['name'] = $sort_text;
        $stat_arr['legend']['enabled'] = false;
        //得到统计图数据
        $stat_arr['title'] = '每日订单';
        $stat_arr['yAxis'] = $sort_text;
        $stat_json = $this->getStatData_LineLabels($stat_arr);
        $this->data->addBody(-140, $stat_json);
    }
    //热卖商品TOP50
    public function info()
	{
        switch ($_REQUEST['type']){
            case 'goodsnum':
                $sort_text = '下单量';
                break;
            default:
                $_REQUEST['type'] = 'orderamount';
                $sort_text = '下单金额';
                break;
        }

        if(request_string('start_time')=='undefined' || request_string('start_time')==''){
            $etime = '1970-01-01';
        }else{
            $etime = request_string('start_time');
        }
        if(request_string('end_time')=='undefined' || request_string('end_time')==''){
            $dtime = date('Y-m-d H:i:s',time());
        }else{
            $dtime =  request_string('end_time');
        }
        //构造横轴数据
        for($i=1; $i<=50; $i++){
            //数据
            $stat_arr['series'][0]['data'][] = array('name'=>'','y'=>0);
            //横轴
            $stat_arr['xAxis']['categories'][] = "$i";
        }

        //查询统计数据
        switch ($_REQUEST['type']){
            case 'goodsnum':
                $orderby = 'goodsnum desc';
                $sql = "select goods_id,min(goods_name) as goods_name,SUM(order_goods_num) as goodsnum from ". $this->orderGoodsModel->tabase()." where order_goods_time  >='".$etime."' and order_goods_time < '".$dtime."' group by goods_id order by ".$orderby." limit 50";
                $statlist = $this->orderGoodsModel->sql($sql);
                break;
            default:
                $_REQUEST['type'] = 'orderamount';;
                $orderby = 'orderamount desc';
                $sql = "select goods_id,min(goods_name) as goods_name,SUM(order_goods_amount) as orderamount from ". $this->orderGoodsModel->tabase()." where order_goods_time  >='".$etime."' and order_goods_time < '".$dtime."' group by goods_id order by ".$orderby." limit 50";
                $statlist = $this->orderGoodsModel->sql($sql);
                break;
        }
        foreach ((array)$statlist as $k => $v){
            switch ($_REQUEST['type']){
                case 'goodsnum':
                    $stat_arr['series'][0]['data'][$k] = array('name'=>strval($v['goods_name']),'y'=>intval($v[$_REQUEST['type']]));
                    break;
                case 'orderamount':
                    $stat_arr['series'][0]['data'][$k] = array('name'=>strval($v['goods_name']),'y'=>floatval($v[$_REQUEST['type']]));
                    break;
            }
            $statlist[$k]['sort'] = $k+1;
        }
        $stat_arr['series'][0]['name'] = $sort_text;
        $stat_arr['legend']['enabled'] = false;
        //得到统计图数据
        $stat_arr['title'] = '热卖商品TOP50';
        $stat_arr['yAxis'] = $sort_text;
        $stat_json = $this->getStatData_LineLabels($stat_arr);
	    $this->data->addBody(-140, $stat_json);
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
    //热卖商品
    public function  demo(){
         $cat_id   = request_string('cat_id');

        if(request_string('start_time')=='undefined' || request_string('start_time')==''){
            $etime = '1970-01-01';
        }else{
            $etime = request_string('start_time');
        }
        if(request_string('end_time')=='undefined' || request_string('end_time')==''){
            $dtime = date('Y-m-d H:i:s',time());
        }else{
            $dtime =  request_string('end_time');
        }
//            var_dump($etime);die;
        //分页
        $YLB_Page           = new YLB_Page();
        $YLB_Page->listRows = request_int('listRows')?request_int('listRows'):50;
        $rows              = $YLB_Page->listRows;
        $offset            = request_int('firstRow', 0);
        $page              = ceil_r($offset / $rows);
        switch ($_REQUEST['type']){
            case 'goodsnum':
                $order= 'goodsnum desc';
                $sql = "select order_id,goods_id,min(goods_name) as goods_name,SUM(order_goods_num) as goodsnum,order_goods_time from ". $this->orderGoodsModel->tabase()." where order_goods_time  >='".$etime."' and order_goods_time < '".$dtime."' group by goods_id order by ".$order;
                break;
            default:
                $_REQUEST['type'] = 'orderamount';
                $order = 'orderamount desc';
                $sql = "select order_id,goods_id,min(goods_name) as goods_name,SUM(order_goods_amount) as orderamount,order_goods_time from ". $this->orderGoodsModel->tabase()."  where order_goods_time  >='".$etime."' and order_goods_time < '".$dtime."' group by goods_id order by ".$order;
                break;
        }
        $data = $this->orderGoodsModel->_select_sql($sql,$page,$rows);

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
    //商品销售明细
    public function goods_sale1(){
        $Shop_BaseModel       = new Shop_BaseModel();
        $User_BaseModel       = new User_BaseModel();
        $Order_GoodsModel     = new Order_GoodsModel;
        $cond_row = array();
        $page          	= request_int('page', 1);
        $rows          	= request_int('rows', 100);
        $goods_name    = request_string('goods_name');
        if($goods_name)
        {
            $cond_row['goods_name:Like'] = '%'.$goods_name.'%';
        }
        if(!request_string('start_time')){
            $cond_row['order_goods_time:>='] = '1970-01-01';
        }else{
            $cond_row['order_goods_time:>='] = request_string('start_time');
        }
        if(!request_string('end_time')){
            $cond_row['order_goods_time:<='] = date('Y-m-d H:i:s',time());
        }else{
            $cond_row['order_goods_time:<='] =  request_string('end_time');
        }
        $cond_row['order_goods_status'] =  6;
        $field = ' shop_id,sum(order_goods_amount) as order_goods_amount,order_id,order_goods_time';
        $field .= ',goods_name';
        $field .= ',count(order_goods_num) as order_goods_count';
        $field .= ',sum(order_goods_num) as order_goods_num';
        $order = 'order_goods_num';
        $group = 'goods_id';
        $data = $Order_GoodsModel->selectReturn($field,$cond_row,$group,$order, $page, $rows);
        $items = $data;
        unset($data);
        if(!empty($items))
        {
            foreach($items['items'] as $key=>$value)
            {
                $shop_id = $value['shop_id'];
                if($shop_id)
                {
                    $data_shop = $Shop_BaseModel->getOne($shop_id);
                    if($data_shop)
                        $items['items'][$key]['shop_name'] = $data_shop['shop_name'];
                    else
                        $items['items'][$key]['shop_name'] = '';
                }
            }
        }
        $data = $items;

        if($items)
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
    //导出excel
    public function getReturnAllExcels()
    {
        $Shop_BaseModel       = new Shop_BaseModel();
        $Order_GoodsModel    = new Order_GoodsModel();
        $cond_row = array();
        $page          	= request_int('page', 1);
        $rows          	= request_int('rows', 100);
        $goods_name    = request_string('goods_name');
        if($goods_name)
        {
            $cond_row['goods_name:Like'] = '%'.$goods_name.'%';
        }
        if(!request_string('start_time')){
            $cond_row['order_goods_time:>='] = '1970-01-01';
        }else{
            $cond_row['order_goods_time:>='] = request_string('start_time');
        }
        if(!request_string('end_time')){
            $cond_row['order_goods_time:<='] = date('Y-m-d H:i:s',time());
        }else{
            $cond_row['order_goods_time:<='] =  request_string('end_time');
        }
        $field = ' shop_id,sum(order_goods_amount) as order_goods_amount,order_id,order_goods_time';
        $field .= ',goods_name';
        $field .= ',count(order_goods_num) as order_goods_count';
        $field .= ',sum(order_goods_num) as order_goods_num';
        $order = 'order_goods_num';
        $group = 'goods_id';
        $data = $Order_GoodsModel->selectReturn($field,$cond_row,$group,$order, $page, $rows);
        $items = $data;
        unset($data);
        if(!empty($items))
        {
            foreach($items as $key=>$value)
            {
                $shop_id = $value['shop_id'];
                if($shop_id)
                {
                    $data_shop = $Shop_BaseModel->getOne($shop_id);
                    if($data_shop)
                        $items[$key]['shop_name'] = $data_shop['shop_name'];
                    else
                        $items[$key]['shop_name'] = '';
                }
            }
        }
        $data = $items;

        $this->data->addBody(-140, $data);
        $tit = array(
            "序号",
            "商品名称",
            "店铺名称",
            "SPU",
            "下单商品件数",
            "下单单量",
            "下单金额",
            "时间"
        );
        $key = array(
            "goods_name",
            "shop_name",
            "order_id",
            "order_goods_num",
            "order_goods_count",
            "order_goods_amount",
            "order_goods_time"
        );

        $this->excel("商品分析", $tit, $data['items'], $key);
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


