 <?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author
 */
class Api_Seller_MarketingCtl extends YLB_AppController{

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

    public function  marketing(){
        $goodstype_arr = array(2=>'手机专享',3=>'限时折扣',4=>'优惠套装');
        $User_BaseModel       = new User_BaseModel();
        $where['goods_type'] = array('in',array(2,3,4));
        $field = ' goods_type';
        switch ($_REQUEST['type']){
            case 'orderamount':
                $field .= " ,SUM(order_goods_amount) as orderamount";
                $caption = '下单金额';
                break;
            case 'goodsnum':
                $field .= " ,SUM(order_goods_num) as goodsnum";
                $caption = '下单商品数';
                break;
            default:
                $field .= " ,count(DISTINCT order_goods_id) as ordernum";
                $caption = '下单量';
                break;
        }
        $stat_time = strtotime(date('Y-m-d',time()));
            //构造横轴数据
            for($i=0; $i<24; $i++){
                //横轴
                $stat_arr['xAxis']['categories'][] = "$i";
                foreach ($goodstype_arr as $k => $v){
                    $statlist[$k][$i] = 0;
                }
            }
            $field .= ' ,HOUR(FROM_UNIXTIME(order_add_time)) as timeval ';
        // $year_arr = getSystemYearArr();
        $stime = $stat_time - 86400;//昨天0点
        $etime = $stat_time + 86400 - 1;//今天24点
        $yesterday_day = @date('d', $stime);//昨天日期
        $today_day = @date('d', $etime);//今天日期
        //查询统计数据
        $cond_row['user_active_time:>='] =  date('Y-m-d H:i:s', $stime);
        $cond_row['user_active_time:<'] = date('Y-m-d H:i:s', $etime);
        $page     = request_int('page', 1);
        $rows     = request_int('rows', 10);
        $field = ' buyer_user_id,min(buyer_user_name) as user_name ';
        switch ($_REQUEST['type']){
            case 'goodsnum':
                $field .= ' ,SUM(order_goods_num) as goodsnum ';
                $orderby = 'goodsnum desc';
                $sql = "select buyer_user_id, SUM(order_goods_num) as goodsnum from ". $this->orderGoodsModel->tabase()." group by buyer_user_id order by ".$orderby." limit 15";
                $statlist = $this->orderBaseModel->sql($sql);
                break;
            case 'goodscount':
                $field .= ' ,count(order_goods_num) as goodsnum ';
                $orderby = 'goodscount desc';
                $sql = "select buyer_user_id,count(order_goods_num) as goodscount from ". $this->orderGoodsModel->tabase()." group by buyer_user_id order by ".$orderby." limit 15";
                $statlist = $this->orderBaseModel->sql($sql);
                break;
            default:
                $_REQUEST['type'] = 'orderamount';
                $field .= ' ,SUM(order_goods_amount) as orderamount ';
                $orderby = 'orderamount desc';
                $sql = "select buyer_user_id,SUM(order_goods_amount) as orderamount from ". $this->orderGoodsModel->tabase()." group by buyer_user_id order by ".$orderby." limit 15";
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



}
