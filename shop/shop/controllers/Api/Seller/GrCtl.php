<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author
 */
class Api_Seller_GrCtl extends Api_Controller {

	public $user_BaseModel=null;
	public $goods_BaseModel=null;
	public $shop_BaseModel=null;
	public $order_BaseModel=null;
	public $user_InfoModel = null;
	public $goods_CommonModel = null;
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);
		
		$this->userBaseModel     = new User_BaseModel();
		$this->goodsBaseModel     = new Goods_BaseModel();
		$this->shopBaseModel     = new Shop_BaseModel();
		$this->orderBaseModel    = new Order_BaseModel();
		$this->orderGoodsModel    = new Order_GoodsModel();
		$this->userInfoModel     =  new User_InfoModel();
		$this->goodsCommonModel  =  new Goods_CommonModel();
        date_default_timezone_set('PRC');
    }
    //统计概况
	public function count(){
		$num = array();
		$num['user_num'] = $this->userBaseModel->getoneByMember();
		$num['goods_num'] = $this->goodsBaseModel->goods_num();
		$num['shop_num'] = $this->shopBaseModel->shop_num();
		$num['order_num'] = $this->orderBaseModel->order_num();
		$num['order_user'] = $this->orderBaseModel->order_user();
		$num['order_place'] = $this->orderBaseModel->order_place();
		$num['order_shop'] = $this->orderBaseModel->order_shop();
		$num['order_goods'] = $this->orderGoodsModel->order_goods();
		$num['order_mean'] = $this->orderBaseModel->order_mean();
		$num['new_user'] = $this->userInfoModel->new_user();
		$num['create_shop'] = $this->shopBaseModel->create_shop();
		$num['new_goods'] = $this->goodsCommonModel->new_goods();


        $start_time = date('Y-m-d H:i:s',strtotime('-7 day'));
        //7日内店铺销售TOP30
        $OrderBaseModel    = new Order_BaseModel();
        $field = 'shop_id,shop_name,SUM(order_payment_amount) AS amount';
        $cond['order_status:>'] = Order_StateModel::ORDER_WAIT_PAY;
        $cond['order_status:<'] = Order_StateModel::ORDER_CANCEL;
        $cond['order_type:<>']  = Order_BaseModel::ORDER_SPLIT;
        $cond['payment_time:>='] = $start_time;
        $cond['order_refund_status'] = 0;
        $order_amount = $OrderBaseModel->selects($field,$cond,'shop_id','amount',1,30,'desc');
        $num['orderamount'] = $order_amount['items'];

        //7日内商品销售TOP30
        $OrderGoodsModel = new Order_GoodsModel();
        $sql  = 'SELECT a.goods_id,a.goods_name,SUM(a.order_goods_num) num FROM '.TABEL_PREFIX.'order_goods a LEFT JOIN '.TABEL_PREFIX.'order_base b ';
        $sql .= ' ON a.order_id = b.order_id ';
        $sql .= ' WHERE b.order_status>1 AND b.order_status<7 AND b.order_type<>1 AND b.payment_time>="'.$start_time.'" AND b.order_refund_status = 0 AND a.goods_refund_status = 0 ';
        $sql .= ' GROUP BY goods_id ORDER BY num DESC LIMIT 0,30';
        $order_goods = $OrderGoodsModel->selectSql($sql);
        $num['ordergoodsnum'] = $order_goods;

		$this->data->addBody(-140, $num);
	}
    //销售走势
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
        $etime = $stat_time + 86400 - 1;//今天24点
        $yesterday_day = @date('d', $stime);//昨天日期
        $today_day = @date('d', $etime);//今天日期
        $field = ' SUM(order_payment_amount) as orderamount,DAY(order_create_time) as dayval,HOUR(order_create_time) as hourval  ';
        $cond_row['order_create_time:>='] =  date('Y-m-d H:i:s', $stime);
	    $cond_row['order_create_time:<'] = date('Y-m-d H:i:s', $etime);
        $group = 'dayval,hourval';
		$memberlist = $this->orderBaseModel->getStatistics($field,$cond_row,$group);

         if($memberlist){
	        foreach($memberlist as $k => $v){
	            if($today_day == $v['dayval']){
	                $curr_arr[$v['hourval']] = intval($v['orderamount']);
	                $currlist_arr[$v['hourval']]['val'] = intval($v['orderamount']);
	            }
	            if($yesterday_day == $v['dayval']){
	                $up_arr[$v['hourval']] = intval($v['orderamount']);
	                $uplist_arr[$v['hourval']]['val'] = intval($v['orderamount']);
	            }
	        }
	    }
        $stat_arr['series'][0]['name'] = '昨天';
        $stat_arr['series'][0]['data'] = array_values($up_arr);
        $stat_arr['series'][1]['name'] = '今天';
        $stat_arr['series'][1]['data'] = array_values($curr_arr);
        //得到统计图数据
        $stat_arr['title'] = date('Y-m-d', $stime).'销售走势';
        $stat_arr['yAxis'] = '销售额';

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

}


