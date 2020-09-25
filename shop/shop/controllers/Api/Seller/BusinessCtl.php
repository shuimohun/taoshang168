<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author
 */
class Api_Seller_BusinessCtl extends Api_Controller{

	public $Order_ReturnModel = null;
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);
		$this->orderReturnModel    = new Order_ReturnModel();
        $this->orderGoodsModel    = new Order_GoodsModel();
        $this->orderBaseModel    = new Order_BaseModel();
        $this->shopBaseModel       = new Shop_BaseModel();
        $this->goodsCatModel     = new Goods_CatModel();
	}
    //行业规模
	public function  scale(){
        if(request_string('start_time')=='undefined' || request_string('start_time')==''){
            $etime = '';
        }else{
            $etime = request_string('start_time');
        }
        if(!request_string('end_time')){
            $dtime = date('Y-m-d H:i:s',time());
        }else{
            $dtime =  request_string('end_time');
        }
        if(!empty($_REQUEST['cat_id'])){
            if($_REQUEST['cat_id']=='-1'){
                $cid['cat_parent_id'] = 0;
            }else{
                $cid['cat_parent_id'] = $_REQUEST['cat_id'];
            }
        }else{
            $cid['cat_parent_id'] = 0;
        }
        if (-1 != request_int('cat_id', -1))
        {
            $cond_row['goods_class_id'] = request_int('cat_id');
        }

        switch ($_REQUEST['type']){
            case 'ordernum':
                $caption = '下单量';
                $field = 'goods_class_id , COUNT(DISTINCT order_goods_id) as ordernum';
                $orderby = 'ordernum desc';
                $sql = "select ". $field ." from ". $this->orderGoodsModel->tabase()." where goods_class_id > 2349 and order_goods_time >= '".$etime."' and order_goods_time < '".$dtime."'  group by goods_class_id  order by ".$orderby;
                break;
            case 'goodsnum':
                $caption = '下单商品数';
                $field = 'goods_class_id , SUM(order_goods_num) as goodsnum';
                $orderby = 'goodsnum desc';
                $sql = "select ". $field ." from ". $this->orderGoodsModel->tabase()." where goods_class_id > 2349 and order_goods_time >= '".$etime."' and order_goods_time < '".$dtime."' group by goods_class_id order by ".$orderby;
                break;
            default:
                $_REQUEST['type'] = 'orderamount';
                $caption = '下单金额';
                $field = 'goods_class_id , SUM(order_goods_amount) as orderamount';
                $orderby = 'orderamount desc';
                $sql = "select ". $field ." from ". $this->orderGoodsModel->tabase()." where goods_class_id > 2349 and order_goods_time >= '".$etime."' and order_goods_time < '".$dtime."' group by goods_class_id order by ".$orderby;
                break;
        }
        $goodslist = $this->orderGoodsModel->sql($sql);

        $goodsCatModel = new Goods_CatModel();

        //根据一级分类查询到下面分类的信息
        $data_cat_rows = $goodsCatModel->getByWhere($cid);

        foreach($goodslist as $k =>$v){
            if($v['goods_class_id'] > 0) {
                $goods_top_cat = $goodsCatModel->getTopParentCat($v['goods_class_id']);
                if($goods_top_cat['cat_id'] > 0) {
                    if(in_array($goods_top_cat['cat_id'],array_keys($data_cat_rows))) {
                        $data_cat_rows[$goods_top_cat['cat_id']][$_REQUEST['type']] += $v[$_REQUEST['type']];
                    } else {
                        $data_cat_rows[$goods_top_cat['cat_id']][$_REQUEST['type']] = $v[$_REQUEST['type']];
                    }
                }
            }
        }

        $gc_childarr = array();
        foreach ($data_cat_rows as $k => $v){
            if($v['cat_id']>0){
                $gc_childarr[$v['cat_id']] = $v;
            }
        }

        if($_REQUEST['cat_id'] !== -1){
            //查询该分类的销量（子分类）
            foreach($gc_childarr as $key=>$val){
                $sql = "select SUM(order_goods_amount) as orderamount from YLB_order_goods where goods_class_id=".$val['cat_id'] ." and order_goods_time >= '".$etime."' and order_goods_time < '".$dtime."' group by goods_class_id";
                $res = $this->orderGoodsModel->sql($sql);
//                $data_cat_rows[$key]['y'] = $res['0'][$_REQUEST['type']];
                $gc_childarr[$key]['y'] = $res[0]['orderamount'];
            }
        }

        //查询统计数据
        $stat_list = array();

        if($_REQUEST['cat_id'] > 0){
            //如果是子分类  子分类与一级分开拼装数据
            foreach ($gc_childarr as $k => $v) {
                $statgc_id = $v['cat_id'];
                $stat_list[$statgc_id]['cat_name'] = $stat_list[$k]['cat_name'];
                $stat_list[$statgc_id]['cat_id'] = $v['cat_id'];
                $stat_list[$statgc_id]['y'] = floatval($v['y']);
            }
        }else{
            //如果是一级分类
            foreach ((array)$data_cat_rows as $k => $v) {
                $statgc_id = intval($v['cat_id']);
                if($statgc_id > 0 ){
                    $stat_list[$statgc_id]['cat_name'] = $stat_list[$k]['cat_name'];
                    $stat_list[$statgc_id]['cat_id'] = $v['cat_id'];
                    switch ($_REQUEST['type']) {
                        case 'orderamount':
                            $stat_list[$statgc_id]['y'] = floatval($v[$_REQUEST['type']]);
                            break;
                        default:
                            $stat_list[$statgc_id]['y'] = intval($v[$_REQUEST['type']]);
                            break;
                    }
                }
            }
        }

        foreach($stat_list as $k => $v){
            //数据
            $stat_arr['series'][0]['data'][] = array('name'=>strval($v['cat_name']),'y'=>$v['y']);
            //横轴
            $stat_arr['xAxis']['categories'][] = strval($v['cat_name']);
        }

        //得到统计图数据
        $stat_arr['series'][0]['name'] = $caption;
        $stat_arr['title'] = "行业{$caption}统计";
        $stat_arr['legend']['enabled'] = false;
        $stat_arr['yAxis']['title']['text'] = $caption;
        $stat_arr['yAxis']['title']['align'] = 'high';
        $stat_json = $this->getStatData_Basicbar($stat_arr);;
         $this->data->addBody(-140, $stat_json);
    }

    function getStatData_Basicbar($stat_arr){
        //图表区、图形区和通用图表配置选项
        $stat_arr['chart']['type'] = 'bar';
        //去除版权信息
        $stat_arr['credits']['enabled'] = false;
        //导出功能选项
        $stat_arr['exporting']['enabled'] = false;
        //显示datalabel
        $stat_arr['plotOptions']['bar']['dataLabels']['enabled'] = true;
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
        //柱形的颜色数组
        $color = array('#7a96a4','#cba952','#667b16','#a26642','#349898','#c04f51','#5c315e','#445a2b','#adae50','#14638a','#b56367','#a399bb','#070dfa','#47ff07','#f809b7');

        foreach ($stat_arr['series'] as $series_k=>$series_v){
            foreach ($series_v['data'] as $data_k=>$data_v){
                if (!$data_v['color']){
                    $data_v['color'] = $color[$data_k%15];
                }
                $series_v['data'][$data_k] = $data_v;
            }
            $stat_arr['series'][$series_k]['data'] = $series_v['data'];
        }
        return $stat_arr;
    }
    //商品50强
    public function info(){
        if(request_string('start_time')== '' || request_string('start_time')=='undefined'){
            $etime = '';
        }else{
            $etime = request_string('start_time');
        }
        if(request_string('end_time')== '' || request_string('end_time')=='undefined'){
            $dtime = date('Y-m-d H:i:s',time());
        }else{
            $dtime =  request_string('end_time');
        }
        if(!empty($_REQUEST['cat_id'])){
            if($_REQUEST['cat_id']=='-1'){
                $cid['cat_parent_id'] = 0;
            }else{
                $cid['cat_parent_id'] = $_REQUEST['cat_id'];
            }
        }else{
            $cid['cat_parent_id'] = 0;
        }
        if (-1 != request_int('cat_id', -1))
        {
            $cond_row['goods_class_id'] = request_int('cat_id');
        }

       $sort_text = '下单商品数';

        //构造横轴数据
        for($i=1; $i<=50; $i++){
            //数据
            $stat_arr['series'][0]['data'][] = array('name'=>'','y'=>0);
            //横轴
            $stat_arr['xAxis']['categories'][] = "$i";
        }
        //查询统计数据
         $orderby = 'goodsnum desc';
         $sql = "select goods_id,goods_class_id,min(goods_name) as goods_name,SUM(order_goods_num) as goodsnum from ". $this->orderGoodsModel->tabase()." where order_goods_time >= '".$etime."' and order_goods_time < '".$dtime."'  group by goods_class_id order by ".$orderby." limit 50";
         $statlist = $this->orderGoodsModel->sql($sql);
//        $goodsCatModel = new Goods_CatModel();
//
//        $data_cat_rows = $goodsCatModel->getByWhere($cid);
//
//        foreach($statlist as $k =>$v){
//            if($v['goods_class_id'] > 2588) {
//                $goods_top_cat = $goodsCatModel->getTopParentCat($v['goods_class_id']);
//
//                if($goods_top_cat['cat_id'] > 0) {
//                    if (in_array($goods_top_cat['cat_id'], array_keys($data_cat_rows))) {
//                        $data_cat_rows[$goods_top_cat['cat_id']] += $v['goodsnum'];
//                    }
//                }
//            }
//        }

        foreach ((array)$statlist as $k => $v){
                    $stat_arr['series'][0]['data'][$k] = array('name'=>strval($v['goods_name']),'y'=>intval($v[$_REQUEST['type']]));
            $statlist[$k]['sort'] = $k+1;
        }
        $stat_arr['series'][0]['name'] = $sort_text;
        $stat_arr['legend']['enabled'] = false;
        //得到统计图数据
        $stat_arr['title'] = '行业商品50强';
        $stat_arr['yAxis'] = $sort_text;
        $stat_json = $this->getStatData_LineLabels($stat_arr);
//        // var_dump($stat_json);die;
        $this->data->addBody(-140, $stat_json);
    }
    //店铺30强
    public function infos(){
        $sort_text = '下单量';
        //构造横轴数据
        for($i=1; $i<=30; $i++){
            //数据
            $stat_arr['series'][0]['data'][] = array('name'=>'','y'=>0);
            //横轴
            $stat_arr['xAxis']['categories'][] = "$i";
        }
        if(request_string('start_time')=='' || request_string('start_time')=='undefined'){
            $etime = '';
        }else{
            $etime = request_string('start_time');
        }
        if(request_string('end_time')=='' || request_string('end_time')=='undefined'){
            $dtime = date('Y-m-d H:i:s',time());
        }else{
            $dtime =  request_string('end_time');
        }
        //查询统计数据
        $orderby = 'goodsnum desc';
        $sql = "select shop_id,goods_id,min(goods_name) as goods_name,COUNT(DISTINCT order_goods_id) as goodsnum from ". $this->orderGoodsModel->tabase()."  where order_goods_time >= '".$etime."' and order_goods_time < '".$dtime."' group by shop_id order by ".$orderby." limit 30";
        $statlist = $this->orderGoodsModel->sql($sql);
        $items = $statlist;
        if(!empty($statlist)) {
            foreach($statlist as $key=>$value) {
                $shop_id = $value['shop_id'];
                if($shop_id) {
                    $data_shop =  $this->shopBaseModel->getOne($shop_id);
                    if($data_shop){
                        $items[$key]['shop_name'] = $data_shop['shop_name'];
                    }else{
                        $items[$key]['shop_name'] = '';
                    }
                }
            }
        }
        $statlist = $items;
        foreach ((array)$statlist as $k => $v){
            $stat_arr['series'][0]['data'][$k] = array('name'=>strval($v['shop_name']),'y'=>intval($v[$_REQUEST['type']]));
            $statlist[$k]['sort'] = $k+1;
        }
        $stat_arr['series'][0]['name'] = $sort_text;
        $stat_arr['legend']['enabled'] = false;
        //得到统计图数据
        $stat_arr['title'] = '行业店铺30强';
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

    //商品50强
    public function  demo(){
        $page     = request_int('page', 1);
        $rows     = request_int('rows', 10);
        $cat_id   = request_string('cat_id');
        if($cat_id&&$cat_id!=-1){
            $cond_row['cat_jd'] = $cat_id;
        }
        if(request_string('start_time')=='' || request_string('start_time')=='undefined'){
            $etime = '';
        }else{
            $etime = request_string('start_time');
        }
        if(request_string('end_time')=='' || request_string('end_time')=='undefined'){
            $dtime = date('Y-m-d H:i:s',time());
        }else{
            $dtime =  request_string('end_time');
        }
        $orderby = 'goodsnum desc';
        $sql = "select goods_class_id, shop_id,order_id,goods_id,min(goods_name) as goods_name,SUM(order_goods_num) as goodsnum from ". $this->orderGoodsModel->tabase()." where order_goods_time >= '".$etime."' and order_goods_time < '".$dtime."' group by goods_class_id order by ".$orderby." limit 50";

        $statlist = $this->orderGoodsModel->sql($sql);
          foreach ($statlist as $k => $v){
                $class_id = $v['goods_class_id'];
                if($class_id){
                   $Goods_Cat = new Goods_CatModel();
                    $data_class = $Goods_Cat->getHotByCatId($class_id);
                }
          }
        $this->data->addBody(-140, $statlist);
    }
    //店铺30强
    public function  demo1(){
        $cat_id   = request_string('cat_id');
        if($cat_id&&$cat_id!=-1){
            $cond_row['cat_jd'] = $cat_id;
        }
        if($cat_id&&$cat_id!=-1){
            $cond_row['cat_jd'] = $cat_id;
        }
        if(request_string('start_time')=='' || request_string('start_time')=='undefined'){
            $etime = '';
        }else{
            $etime = request_string('start_time');
        }
        if(request_string('end_time')=='' || request_string('end_time')=='undefined'){
            $dtime = date('Y-m-d H:i:s',time());
        }else{
            $dtime =  request_string('end_time');
        }
        $orderby = 'goodsnum desc';
        $sql = "select shop_id,order_id,goods_id,min(goods_name) as goods_name,COUNT(DISTINCT order_goods_id) as goodsnum from ". $this->orderGoodsModel->tabase()." where order_goods_time >= '".$etime."' and order_goods_time < '".$dtime."' group by shop_id order by ".$orderby." limit 30";
        $statlist = $this->orderGoodsModel->sql($sql);
        $items = $statlist;
        if(!empty($statlist))
        {
            foreach($statlist as $key=>$value)
            {
                $shop_id = $value['shop_id'];
                if($shop_id)
                {
                    $data_shop =  $this->shopBaseModel->getOne($shop_id);
                    if($data_shop)
                        $items[$key]['shop_name'] = $data_shop['shop_name'];
                    else
                        $items[$key]['shop_name'] = '';
                }
            }
        }
        $statlist = $items;
        $this->data->addBody(-140, $statlist);
    }
    //概况总述
    public function  survey1(){
        $goodsCatModel = new Goods_CatModel();
        if(!empty($_REQUEST['cat_id'])){
            if($_REQUEST['cat_id']=='-1'){
                $cid['cat_parent_id'] = 0;
           }else{
                $cid['cat_parent_id'] = $_REQUEST['cat_id'];
            }
        }else{
            $cid['cat_parent_id'] = 0;
        }
        if (-1 != request_int('cat_id', -1))
        {
            $cond_row['goods_class_id'] = request_int('cat_id');
        }
//        $sql = " select  (round(sum(order_goods_amount)/count(order_goods_num),2)) as average_price,count(order_goods_num) as sales_volume,sum(order_goods_amount) as saleroom,sum(order_goods_num) as goods_count,goods_class_id from YLB_order_goods WHERE  goods_class_id=2360  group by goods_class_id" ;
//        $statlist =  $this->orderGoodsModel ->sql($sql);
        $field = " (round(sum(order_goods_amount)/count(order_goods_num),2)) as average_price,count(order_goods_num) as sales_volume,sum(order_goods_amount) as saleroom,sum(order_goods_num) as goods_count,goods_class_id";
        $group = " goods_class_id ";
        $statlist = $this->orderGoodsModel->select($field,$cond_row,$group);
//        $res = $this->orderGoodsModel->getByWhere($cond_row);
        $data_cat_rows = $goodsCatModel->getByWhere($cid);

        foreach($statlist as $k =>$v){
            if($v['goods_class_id'] > 2349) {
                $goods_top_cat = $goodsCatModel->getTopParentCat($v['goods_class_id']);
//                $goods_top_cat = $goodsCatModel->getByWhere(array('cat_id'=>$v['goods_class_id']));
                if($goods_top_cat['cat_id'] > 0) {
                    if(in_array($goods_top_cat['cat_id'],array_keys($data_cat_rows))) {
                        $data_cat_rows[$goods_top_cat['cat_id']]['average_price'] += $v['average_price'];

                        $data_cat_rows[$goods_top_cat['cat_id']]['sales_volume'] += $v['sales_volume'];

                        $data_cat_rows[$goods_top_cat['cat_id']]['saleroom'] += $v['saleroom'];

                        $data_cat_rows[$goods_top_cat['cat_id']]['goods_count'] += $v['goods_count'];

                    } else {
                        $data_cat_rows[$goods_top_cat['cat_id']]['average_price'] = $v['average_price'];
                        $data_cat_rows[$goods_top_cat['cat_id']]['sales_volume'] = $v['sales_volume'];
                        $data_cat_rows[$goods_top_cat['cat_id']]['saleroom'] = $v['saleroom'];
                        $data_cat_rows[$goods_top_cat['cat_id']]['goods_count'] = $v['goods_count'];
                    }
                }

            }
        }
        $data_cat_rows = array_values($data_cat_rows);
//        echo '<pre>';
//        var_dump($data_cat_rows);die;
        if($data_cat_rows){
            $msg = _('success');
            $status = 200;
        } else {
            $msg = _('failure');
            $status = 250;
        }
        $this->data->addBody(-140, $data_cat_rows,$msg,$status);
    }
    //导出excel
    public function getReturnAllExcels(){
        if(!empty($_REQUEST['cat_id'])){
            if($_REQUEST['cat_id']=='-1'){
                $cid = 0;
            }else{
                $cid = $_REQUEST['cat_id'];
            }
        }else{
            $cid = 0;
        }
        $sql1 = "select cat_id,cat_name,cat_parent_id from YLB_goods_cat where cat_parent_id = ".$cid;
        $statlist1=  $this->goodsCatModel ->sql($sql1);
//        $sql = "select cat_id,cat_name,cat_parent_id,(round(sum(order_goods_amount)/count(order_goods_num),2)) as average_price,count(order_goods_num) as sales_volume,sum(order_goods_amount) as saleroom,sum(order_goods_num) as goods_count,goods_class_id from YLB_goods_cat as c LEFT JOIN YLB_order_goods as o ON c.cat_parent_id = ".$cid." group by goods_class_id";
        $sql = " select  (round(sum(order_goods_amount)/count(order_goods_num),2)) as average_price,count(order_goods_num) as sales_volume,sum(order_goods_amount) as saleroom,sum(order_goods_num) as goods_count,goods_class_id from YLB_order_goods  group by goods_class_id" ;
//        $statlist =  $this->orderGoodsModel ->sql($sql);
        foreach($statlist1 as $k=>$v){
//            $sql = " select  count(order_goods_num) as sales_volume,sum(order_goods_amount) as saleroom,sum(order_goods_num) as goods_count,goods_class_id from YLB_order_goods where goods_class_id = ".$v['cat_id'] ;
            $statlist['cat_id'] = $v['cat_id'];
        }
        $statlist =  $this->orderGoodsModel ->sql($sql);
        $items = $statlist;
        unset($statlist);
        if(!empty($items)) {
            foreach($items as $key => $value) {
                $cat_id = $value['goods_class_id'];
                if($cat_id) {
                    $data_shop = $this->goodsCatModel->getNameByCatid($cat_id);

                    if($data_shop){
                        $items[$key]['cat_name'] = $data_shop;
                    } else {
                        $items[$key]['cat_name'] = '';
                    }
                }
            }
        }
        $statlist = $items;

        $this->data->addBody(-140, $statlist);
        $tit = array(
            "序号",
            "类目名称",
            "平均价格（元）",
            "有销量商品数",
            "销量",
            "销售额（元）",
            "商品总数",
            "无销量商品数"
        );
        $key = array(
            "cat_name",
            "average_price",
            "There_are_sales",
            "sales_volume",
            "saleroom",
            "goods_count",
            "But_no_sales"
        );

        $this->excel("行业分析概况总述", $tit, $statlist, $key);
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


