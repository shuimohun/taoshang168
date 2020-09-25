<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author
 */
class Api_Seller_ServiceCtl extends YLB_AppController{

	public $Order_ReturnModel = null;
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);

		$this->orderReturnModel    = new Order_ReturnModel();
	}
    //售后
	public function info()
	{
	    $stat_time = strtotime(date('Y-m-d',time()));
	        for($i=0; $i<24; $i++){
            //统计图数据
            $curr_arr[$i] = 0;//今天
            $up_arr[$i] = 0;//昨天
            //横轴
            $stat_arr['xAxis']['categories'][] = "$i";
        }
        $stime = $stat_time - 86400;//昨天0点
//        $etime = $stat_time + 86400 - 1;//今天24点
        $yesterday_day = @date('d', $stime);//昨天日期
        $field = ' SUM(return_cash) as orderamount,DAY(return_finish_time) as dayval,HOUR(return_finish_time) as hourval  ';
        $cond_row['return_finish_time'] =  date('Y-m-d H:i:s', $stime);
//	    $cond_row['return_finish_time:<'] = date('Y-m-d H:i:s', $etime);
        $group = 'dayval,hourval';
//        var_dump($field);die;
		$memberlist = $this->orderReturnModel->getStatistics($field,$cond_row,$group);

         if($memberlist){
	        foreach($memberlist as $k => $v){
	            if($yesterday_day == $v['dayval']){
	                $up_arr[$v['hourval']] = intval($v['orderamount']);
	            }
	        }
	    }
        $stat_arr['series'][0]['name'] = '金额统计';
        $stat_arr['series'][0]['data'] = array_values($up_arr);
        //得到统计图数据
        $stat_arr['title'] = '退款金额统计';
        $stat_arr['yAxis'] = '金额';
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

	public function demo(){
		$page     = request_int('page', 1);
		$rows     = request_int('rows', 10);
		$start_time          = request_string("start_time");
		$end_time            = request_string("end_time");
		$cond_row = array();
		$sort     = array();
		$data     = array();
		if ($start_time)
		{
			$cond_row['return_add_time:>='] = $start_time;
		}
		if ($end_time)
		{
			$cond_row['return_add_time:<='] = $end_time;
		}
		$data     = $this->orderReturnModel->getReturnList($cond_row, $sort, $page, $rows);
        if ($data)
        {
            $msg    = _('success');
            $status = 200;
        }
        else
        {
            $msg    = _('failure');
            $status = 250;
        }

        $this->data->addBody(-140, $data, $msg, $status);
	}
    //导出excel
	public function getReturnAllExcel()
	{
		$operating         = request_string("operating");
		$return_code = request_string("return_code");
		$order_number  = request_string("order_number");
		$store_name    = request_string("store_name");
		$buyer_user_account          = request_string("buyer_user_account");
		$start_time          = request_string("start_time");
		$end_time            = request_string("end_time");
		$return_cash            = request_float("return_cash");
		$return_finish_time            = request_float("return_finish_time");

		$cond_row = array();
		$sort     = array();

		if ($operating){
			$cond_row['operating'] = $operating;
		}
		if ($return_code){
			$cond_row['return_code'] = $return_code;
		}
		if ($order_number){
			$cond_row['order_number'] = $order_number;
		}
		if ($store_name){
			$cond_row['store_name'] = $store_name;
		}
		if ($buyer_user_account){
			$cond_row['buyer_user_account'] = $buyer_user_account;
		}
		if ($start_time){
			$cond_row['return_add_time:>='] = $start_time;
		}
		if ($end_time){
			$cond_row['return_add_time:<='] = $end_time;
		}
		if ($return_cash){
			$cond_row['return_cash'] = $return_cash;
		}
		if ($return_finish_time) {
            $cond_row['return_finish_time'] = $return_finish_time;
        }
		$con                     = array();
		$con                     = $this->orderReturnModel->getReturnExcel($cond_row, $sort);
		// var_dump($con);die;
		$this->data->addBody(-140, $con);
		$tit = array(
			"序号",
			"操作",
			"订单编号",
			"退款编号",
			"店铺名称",
			"买家会员名",
			"申请时间",
			"退款金额",
			"退款完成时间"
		);
		$key = array(
			"operating",
			"order_number",
			"return_code",
			"store_name",
			"buyer_user_account",
			"return_add_time",
			"return_cash",
			"return_finish_time"
		);
		$this->excel("退款单", $tit, $con, $key);
	}

	public function dynamic1(){

        $Shop_BaseModel       = new Shop_BaseModel();
        $User_BaseModel       = new User_BaseModel();
       $Shop_EvaluationModel = new Shop_EvaluationModel();
        $cond_row = array();
        $page          	= request_int('page', 1);
        $rows          	= request_int('rows', 100);
		$evaluation_desccredit    = request_string('evaluation_desccredit');
		$evaluation_servicecredit = request_string('evaluation_servicecredit');
		$evaluation_deliverycredit = request_string('evaluation_deliverycredit');

		if($evaluation_desccredit){
			$cond_row['evaluation_desccredit'] = $evaluation_desccredit;
		}

		if($evaluation_servicecredit){
			$cond_row['evaluation_servicecredit'] = $evaluation_servicecredit;
		}

		if($evaluation_deliverycredit){
			$cond_row['evaluation_deliverycredit'] = $evaluation_deliverycredit;
		}

		$field = ' shop_id';
        $field .= ' ,(round(SUM(evaluation_desccredit)/COUNT(evaluation_desccredit),2)) as evaluation_desccredit';
        $field .= ' ,(round(SUM(evaluation_servicecredit)/COUNT(evaluation_servicecredit),2)) as evaluation_servicecredit';
        $field .= ' ,(round(SUM(evaluation_deliverycredit)/COUNT(evaluation_deliverycredit),2)) as evaluation_deliverycredit';
        $field .= ' ,(round((round(SUM(evaluation_desccredit)/COUNT(*),2)+round(SUM(evaluation_servicecredit)/COUNT(*),2)+round(SUM(evaluation_deliverycredit)/COUNT(*),2))/3,2))as evaluation_count';
        $order = 'evaluation_desccredit';
     	$group = 'shop_id';
        $data = $Shop_EvaluationModel->selectEvalution($field,$cond_row,$group,$order, $page, $rows);

        $items = $data['items'];
        unset($data);
        if(!empty($items))
        {
            foreach($items as $key=>$value)
            {
                $shop_id = $value['shop_id'];
                $user_id = $value['user_id'];
                if($shop_id)
                {
                    $data_shop = $Shop_BaseModel->getOne($shop_id);
                    if($data_shop)
                        $items[$key]['shop_name'] = $data_shop['shop_name'];
                    else
                        $items[$key]['shop_name'] = '';
                }
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
        $data = $items;
        if ($data)
        {
            $msg    = _('success');
            $status = 200;
        }else{
            $msg    = _('failure');
            $status = 250;
        }
        $this->data->addBody(-140, $data, $msg, $status);

	}
    //导出excel
    public function getReturnAllExcels()
	{
		$Shop_BaseModel       = new Shop_BaseModel();
		$Shop_EvaluationModel = new Shop_EvaluationModel();
		$shop_name         = request_string("shop_name");
		$evaluation_desccredit = request_string("evaluation_desccredit");
		$evaluation_servicecredit = request_string('evaluation_servicecredit');
		$evaluation_deliverycredit = request_string('evaluation_deliverycredit');

		$cond_row = array();

		if ($shop_name)
		{
			$cond_row['shop_name'] = $shop_name;
		}
		if ($evaluation_desccredit)
		{
			$cond_row['evaluation_desccredit'] = $evaluation_desccredit;
		}
		if ($evaluation_servicecredit)
		{
			$cond_row['evaluation_servicecredit'] = $evaluation_servicecredit;
		}
		if ($evaluation_deliverycredit)
		{
			$cond_row['evaluation_deliverycredit'] = $evaluation_deliverycredit;
		}

		$field = ' shop_id';
        $field .= ' ,(round(SUM(evaluation_desccredit)/COUNT(*),2)) as evaluation_desccredit';
        $field .= ' ,(round(SUM(evaluation_servicecredit)/COUNT(*),2)) as evaluation_servicecredit';
        $field .= ' ,(round(SUM(evaluation_deliverycredit)/COUNT(*),2)) as evaluation_deliverycredit';
        $field .= ' ,(round((round(SUM(evaluation_desccredit)/COUNT(*),2)+round(SUM(evaluation_servicecredit)/COUNT(*),2)+round(SUM(evaluation_deliverycredit)/COUNT(*),2))/3,2))as evaluation_count';
        $group = 'shop_id';
     	$order = 'evaluation_desccredit';
        $data = $Shop_EvaluationModel->selectEvalution($field,$cond_row,$group,$order);
        $items = $data;
        unset($data);
        if(!empty($items))
        {
            foreach($items as $key=>$value)
            {
                $shop_id = $value['shop_id'];
                $user_id = $value['user_id'];
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
			"店铺名称",
			"描述相符度",
			"服务态度",
			"物流速度",
            "综合评分"
		);
		$key = array(
			"shop_name",
			"evaluation_desccredit",
			"evaluation_servicecredit",
			"evaluation_deliverycredit",
            "evaluation_count"
		);

		$this->excel("店铺动态评分", $tit, $data, $key);
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


