<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Seller_Analysis_GoodsCtl extends Seller_Controller
{
	public $Analysis_ShopGoodsModel = null;

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
		$this->Analysis_ShopGoodsModel = new Analysis_ShopGoodsModel();
	}


	public function get_weekinfo($month, $k = NULL)
	{
		$weekinfo = array();
		$end_date = date('d', strtotime($month . ' +1 month -1 day'));
		for ($i = 1; $i < $end_date; $i = $i + 7)
		{
			$w = date('N', strtotime($month . '-' . $i));

			$weekinfo[] = array(
				date('Y-m-d', strtotime($month . '-' . $i . ' -' . ($w - 1) . ' days')),
				date('Y-m-d', strtotime($month . '-' . $i . ' +' . (7 - $w) . ' days'))
			);
		}
		if ($k)
		{
			return $weekinfo[$k];
		}
		else
		{
			return $weekinfo;
		}

	}

	public function getYear()
	{
		$start_year = date("Y", strtotime("-5 years"));
		$end_year   = date("Y", strtotime("+5 years"));
		$year       = "";
		for ($i = $start_year; $i <= $end_year; $i++)
		{
			$selected = "";
			if ($i == date("Y"))
			{
				$selected = "selected='selected'";
			}
			$year .= "<option value='{$i}' {$selected}>{$i}" . _('年') . "</option>";
		}
		$month = "";
		for ($i = 1; $i <= 12; $i++)
		{
			$selected = "";
			if ($i == date("m"))
			{
				$selected = "selected='selected'";
			}
			$month .= "<option value='{$i}' {$selected}>{$i}" . _('月') . "</option>";
		}
		$arr['year']  = $year;
		$arr['month'] = $month;
		return $arr;
	}

	/**
	 * 2017.3.17 hp 用户选中的时间加选中状态
	 * @param $syear 用户选中的年份
	 * @param $emonth 用户选中的月份
	 * @return mixed
	 */
	public function getYearNew($syear, $emonth)
	{
		$start_year = date("Y", strtotime("-5 years"));
		$end_year   = date("Y", strtotime("+5 years"));
		$year       = "";
		for ($i = $start_year; $i <= $end_year; $i++)
		{
			$selected = "";
			if ($i == $syear)
			{
				$selected = "selected='selected'";
			}
			$year .= "<option value='{$i}' {$selected}>{$i}" . _('年') . "</option>";
		}
		$month = "";
		for ($i = 1; $i <= 12; $i++)
		{
			$selected = "";
			if ($i == $emonth)
			{
				$selected = "selected='selected'";
			}
			$month .= "<option value='{$i}' {$selected}>{$i}" . _('月') . "</option>";
		}
		$arr['year']  = $year;
		$arr['month'] = $month;
		return $arr;
	}

	public function getMonthRange($month)
	{
		$timestamp     = strtotime($month . "-1");
		$monthFirstDay = date('Y-m-1 00:00:00', $timestamp);
		$arr[]         = $monthFirstDay;
		$mdays         = date('t', $timestamp);
		$monthLastDay  = date('Y-m-' . $mdays . ' 23:59:59', $timestamp);
		$arr[]         = $monthLastDay;
		return $arr;
	}

	public function getWeek()
	{
		$month = request_int("month");
		$year  = request_int("year");
		$time  = $year . "-" . $month;
		$data  = $this->get_weekinfo($time);
		$week  = "";
		foreach ($data as $k => $v)
		{
			$week .= "<option value='{$v['0']}~{$v['1']}'>{$v['0']}~{$v['1']}</option>";
		}
		echo $week;
	}

	/**
	 * 首页
	 *
	 * @access public
	 */
	public function index()
	{
		$start_date                = date("Y-m-d", strtotime("-30 days"));
		$end_date                  = date("Y-m-d");
		$cond_row['goods_date:>='] = $start_date;
		$cond_row['goods_date:<='] = $end_date;

		$cond_row['shop_id']       = Perm::$shopId;
        $analytics = new Analytics();
        $result = $analytics->getGoodsAnalytics($cond_row);
        if($result['status'] == 200){
            $data = $result['data'];
        }else{
            $data = array();
        }
//		$field = array(
//			"SUM(order_num) as nums",
//			"SUM(order_cash) as cashes",
//			"goods_name",
//			"goods_price"
//		);
//		$group = "goods_id";
//		$order = array("nums" => "DESC");
//
//		$data = $this->Analysis_ShopGoodsModel->getBySql($field, $cond_row, $group, $order);
//        echo '<pre>';
//print_r($data);exit;
		include $this->view->getView();
	}

	public function hotbak()
	{
		$option = $this->getYear();

		$tyear  = date("Y");
		$tmonth = date("m");
		$stype  = request_string("stype", "month");
		$year   = request_int("year", $tyear);
		$month  = request_int("month", $tmonth);

		if ($stype == "month")
		{
			$time = $this->getMonthRange($year . "-" . $month);
		}
		elseif ($stype == "week")
		{
			$week = request_int("week");
			$time = $this->get_weekinfo($year . "-" . $month, $week);
		}
		$cond_row['goods_date:>='] = $time[0];
		$cond_row['goods_date:<='] = $time[1];

		$cond_row['shop_id'] = Perm::$shopId;

		$field = array(
			"SUM(order_num) as nums",
			"goods_name"
		);
		$group = "goods_id";
		$order = array("nums" => "DESC");
		$limit = array(30);
        
		$num_list = $this->Analysis_ShopGoodsModel->getBySql($field, $cond_row, $group, $order, $limit);
		$data_num['line'] = array();
		$data_num['num']  = array();
		foreach ($num_list as $k => $v)
		{
			$data_num['line'][] = ($k + 1);
			$data_num['num'][]  = $v['nums'];
		}
		$data_num['line'] = json_encode($data_num['line']);
		$data_num['num']  = json_encode($data_num['num']);

		$field     = array(
			"SUM(order_cash) as cashes",
			"goods_name"
		);
		$order     = array("cashes" => "DESC");
		$cash_list = $this->Analysis_ShopGoodsModel->getBySql($field, $cond_row, $group, $order, $limit);

		$data_cash['line'] = array();
		$data_cash['num']  = array();
		foreach ($cash_list as $k => $v)
		{
			$data_cash['line'][] = ($k + 1);
			$data_cash['num'][]  = $v['cashes'];
		}
		$data_cash['line'] = json_encode($data_cash['line']);
		$data_cash['num']  = json_encode($data_cash['num']);
		include $this->view->getView();
	}

    public function hots()
	{
		$week = request_string("week", 1);
//		echo '<pre>';print_r($week);exit;
		$tyear  = date("Y");
		$tmonth = date("m");
		$stype  = request_string("stype", "month");
		$year   = request_int("year", $tyear);
		$month  = request_int("month", $tmonth);
		$option = $this->getYearNew($year, $month);
		if ($stype == "month")
		{
			$time = $this->getMonthRange($year . "-" . $month);
			$stype_html = '<option value="month" selected="selected">按月统计</option><option value="week">按周统计</option>';
		}
		elseif ($stype == "week")
		{
//			$week = request_int("week");
//			$time = $this->get_weekinfo($year . "-" . $month, $week);
			$time = explode('~', $week);
			$week_data = $time;
			$stype_html = '<option value="month">按月统计</option><option value="week" selected="selected">按周统计</option>';
		}
		$cond_row['start_time'] = $time[0];
		$cond_row['end_time'] = $time[1];

		$cond_row['shop_id'] = Perm::$shopId;
          
        $analytics = new Analytics();
        $result = $analytics->getGoodsHot($cond_row);
//      echo '<pre>';print_r($result);exit;
        if($result['status'] == 200){
            if(isset($result['data']['cashes']) && isset($result['data']['nums'])){
                $num_list = $result['data']['nums'];
                $data_num['line'] = array();
                $data_num['num']  = array();
                foreach ($num_list as $k => $v)
                {
                    $data_num['line'][] = ($k + 1);
                    $data_num['num'][]  = $v['nums'];
                    $data_num['goods_name'][]  = $v['goods_name'];
                }
                $data_num['line'] = json_encode($data_num['line']);
                $data_num['num']  = json_encode($data_num['num']);
                $data_num['goods_name']  = json_encode($data_num['goods_name']);

                $cash_list = $result['data']['cashes'];
//				$goods_name = array_map(function($val){return $val['goods_name'];}, $cash_list);
                $data_cash['line'] = array();
                $data_cash['num']  = array();
                foreach ($cash_list as $k => $v)
                {
                    $data_cash['line'][] = ($k + 1);
                    $data_cash['num'][]  = $v['cashes'];
					$data_cash['goods_name'][] = $v['goods_name'];
                }
                $data_cash['line'] = json_encode($data_cash['line']);
                $data_cash['num']  = json_encode($data_cash['num']);        
                $data_cash['goods_name']  = json_encode($data_cash['goods_name']);        
            }else{
                $data_cash['line'] = json_encode(array());
                $data_cash['num']  = json_encode(array());
                $data_cash['goods_name']  = json_encode(array());
                $data_num['line'] = json_encode(array());
                $data_num['num']  = json_encode(array());
                $data_num['goods_name']  = json_encode(array());
            }
        }else{
            $data_cash['line'] = json_encode(array());
            $data_cash['num']  = json_encode(array());
            $data_cash['goods_name']  = json_encode(array());
            $data_num['line'] = json_encode(array());
            $data_num['num']  = json_encode(array());
            $data_num['goods_name']  = json_encode(array());
        }
//		echo '<pre>';print_r($goods_name);exit;
		include $this->view->getView();
	}

	public function  hot(){
        if(!request_string('start_time')){
            $cond_row['order_goods_time>'] = '1970-01-01';
        }else{
            $cond_row['order_goods_time>'] = request_string('start_time');
            $start_time = request_string('start_time');
        }
        if(!request_string('end_time')){
            $cond_row['order_goods_time<'] = date("Y-m-d H:i:s",time());
        }else{
            $cond_row['order_goods_time<'] = request_string('end_time');
            $end_time = request_string('end_time');
        }
        $data_search['start_time'] = request_string('start_time');
        $data_search['end_time'] = request_string('end_time');
        $cond_row['order_goods_status:>='] = 2;
        $cond_row['order_goods_status:<='] = 6;
        $cond_row['shop_id'] =  Perm::$shopId;
        $analytics = new Analytics();
        $result = $analytics->getGoodsHot($cond_row);
//        $k = 0;
//        foreach ($result as  $v)
//        {
//            $data_num['line'][] = ($k + 1);
//            $data_num['num'][]  = $v['order_goods_num'];
//            $data_num['goods_name'][]  = $v['goods_name'];
//            $data_cash['line'][] = ($k + 1);
//            $data_cash['num'][]  = $v['order_goods_amount'];
//            $data_cash['goods_name'][] = $v['goods_name'];
//
//            $cash_list[$k] = [
//                'goods_name'	=> $v['goods_name'],
//                'cashes'	=> $v['order_goods_amount'],
//            ];
//            $num_list[$k] = [
//                'goods_name'	=> $v['goods_name'],
//                'nums'	=> $v['order_goods_num'],
//            ];
//            $k++;
//        }



        $num_list  = $analytics->getgoodsHot_num($cond_row);
        $k = 0;
        foreach ($num_list as  $v)
        {
            $data_num['line'][] = ($k + 1);
            $data_num['num'][]  = $v['order_goods_num'];
            $data_num['goods_name'][]  = $v['goods_name'];

            $num_list[$k] = [
                'goods_name'	=> $v['goods_name'],
                'nums'	=> $v['order_goods_num'],
            ];
            $k++;
        }
        $cash_list = $analytics->getgoodsHot_price($cond_row);
        $k = 0;
        foreach ($cash_list as  $v)
        {
            $data_cash['line'][] = ($k + 1);
            $data_cash['num'][]  = $v['order_goods_amount'];
            $data_cash['goods_name'][] = $v['goods_name'];

            $cash_list[$k] = [
                'goods_name'	=> $v['goods_name'],
                'cashes'	=> $v['order_goods_amount'],
            ];
            $k++;
        }
        $data_cash['line'] = json_encode($data_cash['line']);
        $data_cash['num']  = json_encode($data_cash['num']);
        $data_cash['goods_name']  = json_encode($data_cash['goods_name']);

        $data_num['line'] = json_encode($data_num['line']);
        $data_num['num']  = json_encode($data_num['num']);
        $data_num['goods_name']  = json_encode($data_num['goods_name']);
        include $this->view->getView();
    }

	//监控商品的详情
	public function detail()
	{
		if(isset($_GET['keywords']) and !empty($_GET['keywords'])) {
			$keywords = $_GET['keywords'];
		}else{
			$keywords = '';
		}
		$keysword = '%'.$keywords.'%';
		$page 	  = isset($_GET["page"]) ? $_GET['page'] : 1;
		$pageSize = 10;
		$plat_id = YLB_Registry::get('analytics_app_id');

		$cond_row['shop_id'] = $shop_id = Perm::$shopId;
		$cond_row['keyword']       = $keysword;
		$cond_row['page']       = $page;
		$cond_row['pageSize']       = $pageSize;
		$analytics = new Analytics();
		$result = $analytics->getGoodsDetail($cond_row);
//        d($result);
		if($result){
			$data_productbase = $result;
//            		echo '<pre>';print_r($data_productbase);exit;
			$product_total 	  = $result['totalsize'];
			$maxPages 		  = $result['total'];
		}else{
			$data = array();
		}
		include $this->view->getView();
	}

	//监控商品单品分析
	public function analysis()
	{
		if(!empty($_POST['sdate']) && !empty($_POST['edate'])) {
			$stime = $_POST['sdate'];
			$etime = $_POST['edate'];
		}else {
			$stime = date('Y-m-d', (time()-3600*24*7));
			$etime = date('Y-m-d', (time()-3600*24));
		}
		/* 图表 */
		$starttime 		   = strtotime($stime);
		$endtime   		   = strtotime($etime);
		$second            = $endtime-$starttime;
		$day               = floor($second/(3600*24)); //共有多少天
		if(isset($_GET['common_id']) and !empty($_GET['common_id'])) {
			$common_id = $_GET['common_id'];
		}else{
			$common_id = '';
		}
		$plat_id = YLB_Registry::get('analytics_app_id');
		$cond_row['shop_id'] = $shop_id = Perm::$shopId;
		$cond_row['common_id'] = $common_id;
		if($day > 31)
		{
			$stime = date('Y-m-d', (time()-3600*24*7));
			$etime = date('Y-m-d', (time()-3600*24));
			$starttime 		   = strtotime($stime);
			$endtime   		   = strtotime($etime);
			$second            = $endtime-$starttime;
			$day               = floor($second/(3600*24)); //共有多少天
		}
		$data_t = explode('-',$stime);
        $j=0;
        for($i = strtotime($stime); $i < strtotime($etime); $i += 86400) {
            $y=mktime(0,0,0,$data_t[1],$data_t[2],$data_t[0]);
            $t_time[]=date("Y-m-d",$y+$j*24*3600);
            $j++;
        }
		$cond_row['stime'] = $stime;
		$cond_row['etime'] = $etime;
        $analytics = new Analytics();
        $result = $analytics->goodsAnalysis($cond_row);;
        $time = $result['data']['time'];
        $categories = '0';
        $data_order = '0';
        $data_sales = '0';
        $data_followr = '0';
        $data_conversion = '0';
        $data_pv_num = '0';
        $data_score = '0';
        $starttime = '0';
        $final_arr = array();
        foreach ($t_time as $key => $value) {
           $value = "'$value'";
            $final_arr[] = substr($value,0,strlen($value));
        }
        $final_str = implode(",",$final_arr);

        //日期对比
        $date_t = array();
        /*foreach ($result['amount'] as $k =>$v){
            if(in_array($v['order_goods_time'],$t_time))
            {
                $date_t[$v['order_goods_time']] = $v['order_goods_amount'];
            }
        }
        foreach ($t_time as $ks){
            if(!in_array($ks,array_keys($date_t)))
            {
                $date_t[$ks] = 0;
            }
        }
        ksort（$date_t）
        */


        //销售金额数据表
        /*---------------------------------------*/
        $amount = array();
        foreach ($result['amount'] as $key=>$value) {
            $amount[$value['order_goods_time']] = $value['order_goods_amount'];
        }
        $amount_data =$this->date_time($t_time,$amount);
//        /*---------------------------------------*/

        //销售量数据表
        /*---------------------------------------*/
        $num = array();
        foreach ($result['num'] as $key=>$value) {
            $num[$value['order_goods_time']] = $value['order_goods_num'];
        }
        $num_data =$this->date_time($t_time,$num);
        /*---------------------------------------*/

        //关注数据表
        /*---------------------------------------*/
        $gz = array();
        foreach ($result['gz_count'] as $key=>$value) {
            $gz[$value['favorites_goods_time']] = $value['gz_count'];
        }
        $gz_data =$this->date_time($t_time,$gz);
        /*---------------------------------------*/

        //浏览数据表
        /*---------------------------------------*/
        $ll = array();
        foreach ($result['footprint'] as $key=>$value) {
            $ll[$value['footprint_time']] = $value['common_count'];
        }
        $ll_data =$this->date_time($t_time,$ll);
        /*---------------------------------------*/

        //评分数据表
        /*---------------------------------------*/
        $pf = array();
        foreach ($result['scores'] as $key=>$value) {
            $pf[$value['create_time']] = $value['sum_scores'];
        }
        $pf_data =$this->date_time($t_time,$pf);
        /*---------------------------------------*/

        //转化率数据表
        /*---------------------------------------*/
        $zhl = array();
//        $zhl_u = $result['zhl_ucount'][0]['ouser_count'];
        foreach ($result['zhl_ucount'] as $key =>$value) {
            foreach ($result['zhl_fcount'] as $k => $v) {
                if ($value['order_goods_time'] == $v['footprint_time']) {
                    $data[$value['order_goods_time']] = ($value['ouser_count'] / $v['fuser_count']) * 100;
                }
            }
        }
        foreach ($data as $key=>$value) {
            $zhl[$key] = $value;
        }
        $zhl_data =$this->date_time($t_time,$zhl);
        /*---------------------------------------*/
        //查询时间
        $final_str = "[".$final_str."]";

        $y_data_order = $num_data['date'];
        $y_data_sales = $amount_data['date'];
        $y_data_followr = $gz_data['date'];
        $y_data_conversion = $zhl_data['date'];
        $y_data_pv_num = $ll_data['date'];
        $y_data_score = $pf_data['date'];
		include $this->view->getView();
	}

	public function  date_time($t_time,$dt){
        $amount_date = array_fill_keys($t_time,0);

        $amount_date2 = array_merge($amount_date,$dt);
        foreach ($amount_date2 as $key => $value) {
            if(!empty($amount_date2)){
                if(max($amount_date2)==$value){
                    //最高时间最高值
                    $max_date = array('time'=>$key,'date'=>$value);
                }
            }
            $value = "'$value'";
            $amount_date3[] = substr($value,0,strlen($value));
        }
        //拼接数据
        $amount_date4 = implode(",",$amount_date3);
        $amount_date_z['date'] = "[".$amount_date4."]";
        $amount_date_z['max_date'] = $max_date;
        return $amount_date_z;
    }
}

?>