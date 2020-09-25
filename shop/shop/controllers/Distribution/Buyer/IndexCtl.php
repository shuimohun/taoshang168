<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * @author     windfnn
 */
class Distribution_Buyer_IndexCtl extends Buyer_Controller
{
    public $directseller_model = null;
    public $directseller_goodsModel = null;
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
        $this->directseller_model = new Distribution_ShopDirectsellerModel();
        $this->directseller_goodsModel = new Distribution_ShopDirectsellerGoodsCommonModel();
    }


    //个人信息
    function directselleruser(){

        $UserinfoModel = new User_InfoModel();
        $OrderbaseModel = new Order_BaseModel();
        $money_t = null;
        $money = null;
        $money_l = null;
            $user_id = Perm::$userId;
        $cond['user_id'] = $user_id;
        $user_info = $UserinfoModel->getOneByWhere($cond);
        $data['login_time'] = $user_info['lastlogintime'];
        $data['user_name'] = $user_info['user_name'];
        $data['user_pic'] = $user_info['user_logo'];
        $data['user_mobile'] = $user_info['user_mobile'];
        $cond2['order_date'] = date('Y-m-d');
        $cond2['directseller_id'] = $user_id;
        $order = $OrderbaseModel->getBaseList($cond2);
        foreach ($order['items'] as $key => $v){
           $money += $v['order_commission_fee'];
        }
        if ($money == ""){
            $money = 0;
        }
        $data['today_money'] = $money;
        $data['totalsize'] = $order['totalsize'];
        $cond3['order_date'] = date('Y-m-d');
        $cond3['directseller_id'] = $user_id;
        $cond3['order_is_settlement'] = 1;
        $order_finish = $OrderbaseModel->getRowCount($cond3);
        $data['total_finish'] = $order_finish;

        //收入
        $day_l = date("Y-m-d 00:00:00",time());
        $yesterday_l = date('Y-m-d 00:00:00',strtotime("-1 day"));
        $yesterday_r = date('Y-m-d 23:59:59',strtotime("-1 day"));
        $money_sum0 = "select SUM(directseller_commission_0) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_id = '$user_id'AND a.directseller_is_settlement=1";
        $moneysum0 = $OrderbaseModel ->selectSql($money_sum0);
        $money_sum1 = "select SUM(directseller_commission_1) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_p_id = '$user_id'AND a.directseller_is_settlement=1";
        $moneysum1 = $OrderbaseModel ->selectSql($money_sum1);
        $money_sum2 = "select SUM(directseller_commission_2) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_gp_id = '$user_id'AND a.directseller_is_settlement=1";
        $moneysum2 = $OrderbaseModel ->selectSql($money_sum2);
//        var_dump($money_sum0);die;
        $moneysum = $moneysum0[0]['SUM(directseller_commission_0)']+$moneysum1[0]['SUM(directseller_commission_1)']+$moneysum2[0]['SUM(directseller_commission_2)'];

        $data['moneysum'] = $moneysum?$moneysum:0;
        $today0 = "select SUM(directseller_commission_0) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_id = '$user_id'AND a.order_settlement_time>'$day_l'";
        $money_today0 = $OrderbaseModel ->selectSql($today0);
        $today1 = "select SUM(directseller_commission_1) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_p_id = '$user_id'AND a.order_settlement_time>'$day_l'";
        $money_today1 = $OrderbaseModel ->selectSql($today1);
        $today2 = "select SUM(directseller_commission_2) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_gp_id = '$user_id'AND a.order_settlement_time>'$day_l'";
        $money_today2 = $OrderbaseModel ->selectSql($today2);
        $money_t = $money_today0[0]['SUM(directseller_commission_0)']+$money_today1[0]['SUM(directseller_commission_1)']+$money_today2[0]['SUM(directseller_commission_2)'];
        $data['money_today'] = $money_t?$money_t:0;
        $yesterday0 = "select SUM(directseller_commission_0) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_id = '$user_id' AND a.order_settlement_time>'$yesterday_l' AND a.order_settlement_time<'$yesterday_r'";
        $money_yesterday0 = $OrderbaseModel ->selectSql($yesterday0);
        $yesterday1 = "select SUM(directseller_commission_1) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_p_id = '$user_id' AND a.order_settlement_time>'$yesterday_l' AND a.order_settlement_time<'$yesterday_r' ";
        $money_yesterday1 = $OrderbaseModel ->selectSql($yesterday1);
        $yesterday2 = "select SUM(directseller_commission_2) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_gp_id = '$user_id' AND a.order_settlement_time>'$yesterday_l' AND a.order_settlement_time<'$yesterday_r'";
        $money_yesterday2 = $OrderbaseModel ->selectSql($yesterday2);
//        var_dump($yesterday0);die;
        $money_l = $money_yesterday0[0]['SUM(directseller_commission_0)']+$money_yesterday1[0]['SUM(directseller_commission_1)']+$money_yesterday2[0]['SUM(directseller_commission_2)'];
        $data['money_yesterday'] = $money_l?$money_l:0;
        //收入结束
        $cond7['directseller_id'] = $user_id;
        $data['directseller_sum'] = $OrderbaseModel->getRowCount($cond7);
        $cond8['directseller_id'] = $user_id;
        $cond8['order_is_settlement'] = 1;
        $data['directseller_settlement'] = $OrderbaseModel->getRowCount($cond8);
        $cond_man['user_parent_id'] = $user_id;
        $data['man_sum'] = $UserinfoModel->getRowCount($cond_man);

        $cond9['directseller_id'] = $user_id;
        $cond9['order_date'] = date('Y-m-d');
        $data['man_today'] = $OrderbaseModel->getRowCount($cond9);
        $cond10['directseller_id'] = $user_id;
        $cond10['order_date'] = date('Y-m-d',strtotime("-1 day"));
        $data['man_yesterday'] = $OrderbaseModel->getRowCount($cond10);
        $cond11['directseller_id'] = $user_id;
        $cond11['order_date'] = date('Y-m-1');
        $data['man_month'] = $OrderbaseModel->getRowCount($cond11);
        $cond_row['directseller_id'] = $user_id;
        $cond_row['directseller_enable'] = 1;
        $data['shop_name'] = $user_info['user_directseller_shop'];
        $shop_ids = array_column($data['shops'],'shop_id');
        $cond_good_row['shop_id:in'] = $shop_ids;
        $cond_good_row['common_is_directseller'] = 1;
        $Goods_CommonModel = new Goods_CommonModel();
        $data['goods'] = $Goods_CommonModel->getRowCount($cond_good_row);
        $this->data->addBody(-140, $data);
    }
    //已完成淘金行动
    function orderfinish(){
        $user_id = Perm::$userId;
        $act = request_string('act');
        $page = request_int('page',1);
        $rows = request_int('rows',8);
        $OrderBaseModel = new Order_BaseModel();
        $cond['directseller_id'] = $user_id;
        $cond['directseller_is_settlement'] =1;
        if ($act == 'f'){
            $order['order_commission_fee'] = 'desc';
        }else if($act == 'a'){
            $order['order_payment_amount'] = 'desc';
        }else{
            $order['order_settlement_time'] = 'desc';
        }
        $data = $OrderBaseModel->getBaseList($cond,$order,$page,$rows);
        $this->data->addBody(-140, $data);

    }
    //分销管理
    function distribution(){
        $Order_BaseModel = new Order_BaseModel();
        $status = request_string('status');
        $user_id = Perm::$userId;
        $money = null;
        $user = null;
        if ($status == 'third'){
            $sql = "SELECT b.`directseller_commission_0` FROM ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_id = ".$user_id;
            $moneyS = $Order_BaseModel->selectSql($sql);
            foreach ($moneyS as $v ){
                $money += $v['directseller_commission_0'];
                $user[] += $v['buyer_user_id'];
            }
            $user = array_unique($user);
            $data['user'] = count($user);
            $data['money'] = $money;
            $cond_row['directseller_id'] = $user_id;
            $cond_row['directseller_is_settlement'] = 1;
            $count = $Order_BaseModel->getRowCount($cond_row);
            $data['count'] = $count;
        }else{
            $sql = "SELECT b.`directseller_commission_1`,b.`buyer_user_id` FROM ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_p_id =".$user_id;
            $moneyS = $Order_BaseModel->selectSql($sql);
            foreach ($moneyS as $v ){
                $money += $v['directseller_commission_1'];
                $user[] += $v['buyer_user_id'];
            }
            $user = array_unique($user);
            $data['user'] = count($user);
            $data['money'] = $money;
            $cond_row['directseller_p_id'] = $user_id;
            $cond_row['directseller_is_settlement'] = 1;
            $count = $Order_BaseModel->getRowCount($cond_row);
            $data['count'] = $count;
        }            $this->data->addBody(-140, $data);

    }
    //分享商管理
    function  distributor (){
        $status = request_string('status');

        if ($status == 'third'){
            $cond_row['directseller_gp_id'] = Perm::$userId;
        }else{
            $cond_row['directseller_p_id'] = Perm::$userId;
        }
        $YLB_Page = new YLB_Page();

        $cond_row['order_status'] = Order_StateModel::ORDER_FINISH;
        $Order_BaseModel = new Order_BaseModel();
        $list = $Order_BaseModel->getBaseList($cond_row, array('order_create_time' => 'DESC'));
        $user['user'] = Array();
        foreach ($list['items'] as $v){
            if ($status == 'third'){
            array_push($user['user'],$v['directseller_p_id']);
            }else{
            array_push($user['user'],$v['directseller_id']);
            }
        }
        $user_id = array_unique($user['user']);
        $user_id = array_merge($user_id);
        $User_InfoModel = new User_InfoModel();
        for ($x=0;$x<count($user_id);$x++){
            $cond_row['user_id'] = $user_id[$x];
            $user_detail= $User_InfoModel->getOne($cond_row);
            $data['items'][$x]['user_name'] = $user_detail['user_directseller_shop'];
            $data['items'][$x]['user_mobile'] = $user_detail['user_mobile'];
            $data['items'][$x]['user_logo'] = $user_detail['user_logo'];
        }
        $cond2['user_id'] = Perm::$userId;
        $self = $User_InfoModel->getUserInfo($cond2);
        $data['self']['name'] = $self['user_directseller_shop'];
        $shop_time = new Distribution_ShopDirectseller();
        $cond3['directseller_id'] = Perm::$userId;
            $self_t= $shop_time->getOneByWhere($cond3);
        $data['self']['time'] = $self_t['directseller_create_time'];
        $this->data->addBody(-140, $data);


    }
    //我的收入
    function income(){
        $Order_BaseModel = new Order_BaseModel();
        $status = request_string('status');
        $user_id = Perm::$userId;
        $money_today = null;
        $money_week = null;
        $money_month = null;
        $money_sum = null;
        $day = date("Y-m-d",time());
        $week = date('Y-m-d',(time()-((date('w')==0?7:date('w'))-1)*24*3600));
        $month = date('Y-m-d',strtotime(date('Y-m', time()).'-01 00:00:00'));
        switch($status)
        {
            case "first" :              //本店
                $today = "select SUM(directseller_commission_2) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_gp_id = '$user_id'AND a.directseller_is_settlement = 1 and order_settlement_time>'$day'";
                $money_today = $Order_BaseModel ->selectSql($today);
                $data['day'] = $money_today[0]['SUM(directseller_commission_2)'];
                $toweek = "select SUM(directseller_commission_2) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_gp_id = '$user_id'AND a.directseller_is_settlement = 1 and order_settlement_time>'$week'";
                $money_week = $Order_BaseModel->selectSql($toweek);
                $data['week'] = $money_week[0]['SUM(directseller_commission_2)'];
                $tomonth = "select SUM(directseller_commission_2) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_gp_id = '$user_id'AND a.directseller_is_settlement = 1 and order_settlement_time>'$month'";
                $money_month = $Order_BaseModel->selectSql($tomonth);
                $data['month'] = $money_month[0]['SUM(directseller_commission_2)'];
                $sum = "select SUM(directseller_commission_2) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_gp_id = '$user_id'AND a.directseller_is_settlement = 1";
                $money_sum = $Order_BaseModel->selectSql($sum);
                $data['total'] = $money_sum[0]['SUM(directseller_commission_2)'];
                $this->data->addBody(-140, $data);
            break;
            case "second" :           //店长
                $today = "select SUM(directseller_commission_1) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_p_id = '$user_id'AND a.directseller_is_settlement = 1 and order_settlement_time>'$day'";
                $money_today = $Order_BaseModel ->selectSql($today);
                $data['day'] = $money_today[0]['SUM(directseller_commission_1)'];
                $toweek = "select SUM(directseller_commission_1) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_p_id = '$user_id'AND a.directseller_is_settlement = 1 and order_settlement_time>'$week'";
                $money_week = $Order_BaseModel->selectSql($toweek);
                $data['week'] = $money_week[0]['SUM(directseller_commission_1)'];
                $tomonth = "select SUM(directseller_commission_1) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_p_id = '$user_id'AND a.directseller_is_settlement = 1 and order_settlement_time>'$month'";
                $money_month = $Order_BaseModel->selectSql($tomonth);
                $data['month'] = $money_month[0]['SUM(directseller_commission_1)'];
                $sum = "select SUM(directseller_commission_1) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_p_id = '$user_id'AND a.directseller_is_settlement = 1";
                $money_sum = $Order_BaseModel->selectSql($sum);
                $data['total'] = $money_sum[0]['SUM(directseller_commission_1)'];
                $this->data->addBody(-140, $data);
                break;
            case "third" :         //推销员
                $today = "select SUM(directseller_commission_0) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_id = '$user_id'AND order_settlement_time>'$day'";
                $money_today = $Order_BaseModel ->selectSql($today);
                $data['day'] = $money_today[0]['SUM(directseller_commission_0)'];
                $toweek = "select SUM(directseller_commission_0) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_id = '$user_id'AND order_settlement_time>'$week'";
                $money_week = $Order_BaseModel->selectSql($toweek);
                $data['week'] = $money_week[0]['SUM(directseller_commission_0)'];
                $tomonth = "select SUM(directseller_commission_0) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_id = '$user_id'AND order_settlement_time>'$month'";
                $money_month = $Order_BaseModel->selectSql($tomonth);
                $data['month'] = $money_month[0]['SUM(directseller_commission_0)'];
                $sum = "select SUM(directseller_commission_0) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_id = '$user_id'AND a.directseller_is_settlement = 1";
                $money_sum = $Order_BaseModel->selectSql($sum);
                $data['total'] = $money_sum[0]['SUM(directseller_commission_0)'];
                $this->data->addBody(-140, $data);
                break;
            default:         //总计
                $today0 = "select SUM(directseller_commission_0) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_id = '$user_id'AND order_settlement_time>'$day'";
                $money_today0 = $Order_BaseModel ->selectSql($today0);
                $today1 = "select SUM(directseller_commission_1) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_p_id = '$user_id'AND order_settlement_time>'$day'";
                $money_today1 = $Order_BaseModel ->selectSql($today1);
                $today2 = "select SUM(directseller_commission_2) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_gp_id = '$user_id'AND order_settlement_time>'$day'";
                $money_today2 = $Order_BaseModel ->selectSql($today2);
                $data['day'] = $money_today0[0]['SUM(directseller_commission_0)']+$money_today1[0]['SUM(directseller_commission_1)']+$money_today2[0]['SUM(directseller_commission_2)'];

                $week0 = "select SUM(directseller_commission_0) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_id = '$user_id'AND order_settlement_time>'$week'";
                $money_week0 = $Order_BaseModel ->selectSql($week0);
                $week1 = "select SUM(directseller_commission_1) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_p_id = '$user_id'AND order_settlement_time>'$week'";
                $money_week1 = $Order_BaseModel ->selectSql($week1);
                $week2 = "select SUM(directseller_commission_2) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_gp_id = '$user_id'AND order_settlement_time>'$week'";
                $money_week2 = $Order_BaseModel ->selectSql($week2);
                $data['week'] = $money_week0[0]['SUM(directseller_commission_0)']+$money_week1[0]['SUM(directseller_commission_1)']+$money_week2[0]['SUM(directseller_commission_2)'];


                $month0 = "select SUM(directseller_commission_0) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_id = '$user_id'AND order_settlement_time>'$month'";
                $money_month0 = $Order_BaseModel ->selectSql($month0);
                $month1 = "select SUM(directseller_commission_1) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_p_id = '$user_id'AND order_settlement_time>'$month'";
                $money_month1 = $Order_BaseModel ->selectSql($month1);
                $month2 = "select SUM(directseller_commission_2) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_gp_id = '$user_id'AND order_settlement_time>'$month'";
                $money_month2 = $Order_BaseModel ->selectSql($month2);
                $data['month'] = $money_month0[0]['SUM(directseller_commission_0)']+$money_month1[0]['SUM(directseller_commission_1)']+$money_month2[0]['SUM(directseller_commission_2)'];

                $sum0 = "select SUM(directseller_commission_0) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_id = '$user_id'AND a.directseller_is_settlement = 1";
                $money_sum0 = $Order_BaseModel->selectSql($sum0);
                $sum1 = "select SUM(directseller_commission_1) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_p_id = '$user_id'AND a.directseller_is_settlement = 1";
                $money_sum1 = $Order_BaseModel->selectSql($sum1);
                $sum2 = "select SUM(directseller_commission_2) from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_gp_id = '$user_id'AND a.directseller_is_settlement = 1";
                $money_sum2 = $Order_BaseModel->selectSql($sum2);
                $data['total'] = $money_sum0[0]['SUM(directseller_commission_0)']+$money_sum1[0]['SUM(directseller_commission_1)']+$money_sum2[0]['SUM(directseller_commission_2)'];
                $this->data->addBody(-140, $data);
        }

    }
    //分销订单
    function directOrder(){
        $Order_base=new Order_BaseModel();
        $Order_StateModel = new Order_StateModel();
        $status = request_string('status');
        $rows = request_int('rows',8);
        $page = request_int('page',1);
        $user_id = Perm::$userId;
        $page_s = ($page-1)*$rows;
        $page_e = $page*$rows;
        switch($status)
        {
            case "first" :
                $data['top'] = $this->countDirectseller(0);
                $cond['directseller_id'] = $user_id;
                $data['count'] = $Order_base->getRowCount($cond);
                $detailSql = "SELECT a.order_id,a.order_create_time,a.order_status,b.user_name,c.goods_name,c.directseller_commission_0 AS directseller_commission FROM ylb_order_base a LEFT JOIN ylb_user_info b ON a.directseller_id = b.user_id LEFT JOIN ylb_order_goods c ON a.order_id = c.order_id WHERE a.directseller_id = ".$user_id." GROUP BY a.order_id LIMIT $page_s,$page_e";
                $data['items'] = $Order_base->selectSql($detailSql);
                foreach ($data['items'] as $key => $value){
                    $data['items'][$key]['order_state_con'] = $Order_StateModel->orderState[$value['order_status']];
                    $data['items'][$key]['level'] = '老板';
                    unset($data['items'][$key]['order_status']);
                }

                $this->data->addBody(-140, $data);
                break;
            case "second" :
                $data['top'] = $this->countDirectseller(1);
                $cond['directseller_p_id'] = $user_id;
                $data['count'] = $Order_base->getRowCount($cond);
                 $detailSql = "SELECT a.order_id,a.order_create_time,a.order_status,b.user_name,c.goods_name,c.directseller_commission_1 AS directseller_commission FROM ylb_order_base a LEFT JOIN ylb_user_info b ON a.directseller_id = b.user_id LEFT JOIN ylb_order_goods c ON a.order_id = c.order_id WHERE a.directseller_p_id = ".$user_id." GROUP BY a.order_id LIMIT $page_s,$page_e";
                $data['items'] = $Order_base->selectSql($detailSql);
                foreach ($data['items'] as $key => $value){
                    $data['items'][$key]['order_state_con'] = $Order_StateModel->orderState[$value['order_status']];
                    $data['items'][$key]['level'] = '店长';
                    unset($data['items'][$key]['order_status']);
                }
                $this->data->addBody(-140, $data);
                break;
            case "third" :
                $data['top'] = $this->countDirectseller(2);
                $cond['directseller_gp_id'] = $user_id;
                $data['count'] = $Order_base->getRowCount($cond);
                 $detailSql = "SELECT a.order_id,a.order_create_time,a.order_status,b.user_name,c.goods_name,c.directseller_commission_2 AS directseller_commission FROM ylb_order_base a LEFT JOIN ylb_user_info b ON a.directseller_id = b.user_id LEFT JOIN ylb_order_goods c ON a.order_id = c.order_id WHERE a.directseller_gp_id = ".$user_id." GROUP BY a.order_id LIMIT $page_s,$page_e";
                $data['items'] = $Order_base->selectSql($detailSql);
                foreach ($data['items'] as $key => $value){
                    $data['items'][$key]['order_state_con'] = $Order_StateModel->orderState[$value['order_status']];
                    $data['items'][$key]['level'] = '促销员';
                    unset($data['items'][$key]['order_status']);
                }
                $this->data->addBody(-140, $data);
                break;
            default:
                $data[] = $this->countDirectseller(0);
                $data[] = $this->countDirectseller(1);
                $data[] = $this->countDirectseller(2);

                $new_data['top']['all'] = array_sum(array_column($data,'all'));
                $new_data['top']['fukuan'] = array_sum(array_column($data,'fukuan'));
                $new_data['top']['daifukuan'] = array_sum(array_column($data,'daifukuan'));
                $new_data['top']['daishouhuo'] = array_sum(array_column($data,'daishouhuo'));
                $new_data['top']['wancheng'] = array_sum(array_column($data,'wancheng'));
                $new_data['top']['tuikuan'] = array_sum(array_column($data,'tuikuan'));
                $new_data['top']['total'] =  sprintf("%.2f",array_sum(array_column($data,'total')));
                $new_data['top']['shouru'] =  sprintf("%.2f",array_sum(array_column($data,'shouru')));
                $sum0 = "SELECT * FROM ylb_order_base  WHERE directseller_id = '$user_id' OR directseller_p_id= '$user_id' OR directseller_gp_id= '$user_id'";
                $count = $Order_base->selectSql($sum0);
                $new_data['count'] = count($count);
                $detailSql = "SELECT a.order_id,a.order_create_time,a.order_status,a.directseller_id,a.directseller_p_id,a.directseller_gp_id,b.user_name,c.goods_name,c.directseller_commission_0,c.directseller_commission_1,c.directseller_commission_2 FROM ylb_order_base a LEFT JOIN ylb_user_info b ON a.directseller_id = b.user_id LEFT JOIN ylb_order_goods c ON a.order_id = c.order_id WHERE a.directseller_id = ".$user_id." OR a.directseller_p_id = ".$user_id." OR a.directseller_gp_id = ".$user_id."  GROUP BY a.order_id LIMIT $page_s,$page_e";
                $new_data['items'] = $Order_base->selectSql($detailSql);
                foreach ($new_data['items'] as $key=>$value){
                    $new_data['items'][$key]['order_state_con'] = $Order_StateModel->orderState[$value['order_status']];
                    if ($user_id == $value['directseller_id']){
                        $new_data['items'][$key]['level'] = '老板';
                        $new_data['items'][$key]['directseller_commission'] = $new_data['items'][$key]['directseller_commission_0'];
                    }
                    if ($user_id == $value['directseller_p_id']){
                        $new_data['items'][$key]['level'] = '店长';
                        $new_data['items'][$key]['directseller_commission'] = $new_data['items'][$key]['directseller_commission_1'];
                    }
                    if ($user_id == $value['directseller_gp_id']){
                        $new_data['items'][$key]['level'] = '老板 ';
                        $new_data['items'][$key]['directseller_commission'] = $new_data['items'][$key]['directseller_commission_2'];
                    }
                    unset($new_data['items'][$key]['directseller_p_id'],$new_data['items'][$key]['directseller_id'],$new_data['items'][$key]['directseller_gp_id'],$new_data['items'][$key]['order_status'],$new_data['items'][$key]['directseller_commission_1'],$new_data['items'][$key]['directseller_commission_2'],$new_data['items'][$key]['directseller_commission_0']);
                }
                $this->data->addBody(-140, $new_data);


        }
    }
    //分享订单方法
    function countDirectseller($type = 0)
    {
        $Order_baseModel = new Order_BaseModel();
        $user_id = Perm::$userId;

        if($type == 0)
        {
            $directseller_con = 'directseller_id';
        }
        else if($type == 1)
        {
            $directseller_con = 'directseller_p_id';
        }
        else if($type == 2)
        {
            $directseller_con = 'directseller_gp_id';
        }
        $cond_all[$directseller_con] = $user_id;
        $data['all'] = $Order_baseModel->getRowCount($cond_all);
        $fukuan = Order_StateModel::ORDER_PAYED;
        $cond_fukuan['order_status'] = $fukuan;
        $cond_fukuan[$directseller_con] = $user_id;
        $data['fukuan'] = $Order_baseModel->getRowCount($cond_fukuan);
        $daifukuan = Order_StateModel::ORDER_WAIT_PAY;
        $cond_daifukuan[$directseller_con] = $user_id;
        $cond_daifukuan['order_status'] = $daifukuan;
        $data['daifukuan'] = $Order_baseModel->getRowCount($cond_daifukuan);
        $daishouhuo = Order_StateModel::ORDER_WAIT_CONFIRM_GOODS;
        $cond_daishouhuo['order_status'] = $daishouhuo;
        $cond_daishouhuo[$directseller_con] =$user_id;
        $data['daishouhuo'] = $Order_baseModel->getRowCount($cond_daishouhuo);
        $wancheng = Order_StateModel::ORDER_FINISH;
        $cond_wancheng['order_status'] = $wancheng;
        $cond_wancheng[$directseller_con] = $user_id;
        $data['wancheng'] = $Order_baseModel->getRowCount($cond_wancheng);
        $tuikuan = Order_StateModel::ORDER_REFUND_END;
        $cond_tuikuan['order_refund_status'] = $tuikuan;
        $cond_tuikuan[$directseller_con] = $user_id;
        $data['tuikuan'] = $Order_baseModel->getRowCount($cond_tuikuan);
        $zongeSql = "select SUM(order_goods_amount) from ylb_order_base WHERE ".$directseller_con." = ".$user_id." AND directseller_is_settlement = 1";
        $zonge= $Order_baseModel->selectSql($zongeSql);
        $data['total'] = $zonge[0]['SUM(order_goods_amount)'];
        $shouruSql = "select SUM(directseller_commission_".$type.") as commission from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.".$directseller_con." = ".$user_id." AND a.directseller_is_settlement = 1";
        $shouru = $Order_baseModel->selectSql($shouruSql);
        $data['shouru'] = $shouru[0]['commission'];

        return $data;
    }
    //分销订单全部订单
    function directList(){
        $user_id = Perm::$userId;
        $rows = request_int('rows',5);
        $page = request_int('page',1);
        $page_s = ($page-1)*$rows;
        $page_e = $page*$rows;
        $detailSql = "SELECT a.order_id,a.order_create_time,a.order_status,a.directseller_id,a.directseller_p_id,a.directseller_gp_id,b.user_name,c.goods_name,c.directseller_commission_0,c.directseller_commission_1,c.directseller_commission_2 FROM ylb_order_base a LEFT JOIN ylb_user_info b ON a.directseller_id = b.user_id LEFT JOIN ylb_order_goods c ON a.order_id = c.order_id WHERE a.directseller_id = ".$user_id." OR a.directseller_p_id = ".$user_id." OR a.directseller_gp_id = ".$user_id."  GROUP BY a.order_id LIMIT $page_s,$page_e";
        $Order_base=new Order_BaseModel();
        $Order_StateModel = new Order_StateModel();
        $detail['items'] = $Order_base->selectSql($detailSql);
        foreach ($detail['items'] as $key=>$value){
            $detail['items'][$key]['order_state_con'] = $Order_StateModel->orderState[$value['order_status']];
           if ($user_id == $value['directseller_id']){
               $detail['items'][$key]['level'] = '促销员';
               $detail['items'][$key]['commission'] = $detail['items'][$key]['directseller_commission_0'];
           }
            if ($user_id == $value['directseller_p_id']){
                $detail['items'][$key]['level'] = '店长';
                $detail['items'][$key]['commission'] = $detail['items'][$key]['directseller_commission_1'];
            }
            if ($user_id == $value['directseller_gp_id']){
                $detail['items'][$key]['level'] = '老板';
                $detail['items'][$key]['commission'] = $detail['items'][$key]['directseller_commission_2'];
            }
            unset($detail['items'][$key]['directseller_p_id'],$detail['items'][$key]['directseller_id'],$detail['items'][$key]['directseller_gp_id'],$detail['items'][$key]['order_status'],$detail['items'][$key]['directseller_commission_1'],$detail['items'][$key]['directseller_commission_2'],$detail['items'][$key]['directseller_commission_0']);
        }
        $sum0 = "SELECT * FROM ylb_order_base  WHERE directseller_id = '$user_id' OR directseller_p_id= '$user_id' OR directseller_gp_id= '$user_id'";
        $count = $Order_base->selectSql($sum0);
        $detail['count'] = count($count);
        $this->data->addBody(-140, $detail);
    }
    //引荐的会员
    function recommend(){
        $user_id = Perm::$userId;
//        $page = request_string('page',1);
//        $rows = request_string('rows',5);
        $page_s = ($page-1)*$rows;
        $page_e = ($page)*$rows;
        $condition = request_string('condition',2);
        if ($condition == 1){
            $order = "user_regtime";
        }elseif ($condition == 2){
            $order = "lastlogintime";
        }else{
            $order = "user_directseller_commission";
        }
        $User_infoModel = new User_InfoModel();
        $sql = 'SELECT user_logo,user_name,lastlogintime,user_regtime FROM ylb_user_info WHERE user_parent_id='.$user_id.' GROUP BY '.$order.' Desc';
//        $sql = 'SELECT user_logo,user_name,lastlogintime,user_regtime FROM ylb_user_info WHERE user_parent_id='.$user_id.' GROUP BY '.$order.' Desc LIMIT '.$page_s.','.$page_e;
        $data = $User_infoModel->selectSql($sql);
        $this->data->addBody(-140, $data);

    }
    //店铺管理
    function storeManagement(){
        $User_InfoModel = new User_InfoModel();
        $user_id = Perm::$userId;
        $data = $User_InfoModel->getOne($user_id);
        $data['shop_qrcode'] = YLB_Registry::get('base_url')."/shop/api/qrcode.php?data=".urlencode(YLB_Registry::get('shop_wap_url')."/tmpl/member/directseller_store.html?uid=".Perm::$userId);
        $this->data->addBody(-140, $data);

    }
}
