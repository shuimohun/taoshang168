<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Distribution_Buyer_DirectsellerCtl extends Buyer_Controller
{
	public $directseller_model = null;
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
	}

	/**
	 * 首页
	 *
	 * @access public
	 */
	public function index()
	{
		$cid = request_string('cid');

		$YLB_Page = new YLB_Page();
		$page     = request_int('page',1);
        $rows     = request_int('rows',$YLB_Page->listRows);

		$cond = array();
		if($cid)
        {
            $cond['shop_class_id'] = $cid;
        }

        if(request_string('keywords'))
        {
            $cond['shop_name:LIKE'] = '%'.request_string('keywords').'%';
        }

        $data = $this->directseller_model->getSpList($cond,array(),$page, $rows);

		if($page == 1 || $this->typ != "json")
        {
            //获取店铺分类列表
            $ShopClassModel = new Shop_ClassModel();
            $class_row = $ShopClassModel->getByWhere();
            $data['class'] = array_values($class_row);
        }

		if ($this->typ == "json")
		{
			$this->data->addBody(-140, $data);
		}
		else
		{
            $YLB_Page->nowPage    = $page;
            $YLB_Page->listRows   = $rows;
            $YLB_Page->totalPages = $data['total'];
            $page_nav             = $YLB_Page->promptII();

			include $this->view->getView();
		}
	}
	
	/*
	* 淘金中心-WAP端
	*/
	public function wapIndex()
	{
		$userId = Perm::$userId;
		$User_InfoModel = new User_InfoModel();
		$data = $User_InfoModel->getOne($userId);
 
		//获取用户邀请的直属会员---全部
		$row['user_parent_id'] = Perm::$userId;
		$data['invitors']  = $User_InfoModel->getSubQuantity($row);
		
		//获取用户邀请的直属会员---本月
		$row['user_regtime:<='] = get_date_time();
		$beginDate = date('Y-m-d H:i:s',mktime(0,0,0,date('m'),1,date('Y')));
		$row['user_regtime:>='] = $beginDate;
		$data['month_invitors'] = $User_InfoModel->getSubQuantity($row);
		
		//用户推广订单
		$Order_BaseModel = new Order_BaseModel();
		$order_con['directseller_id'] = $userId;
		$data['promotion_order_nums'] = $Order_BaseModel->getPromotionOrderNum($order_con);

		//完成订单数量
		$order_con['order_status'] = Order_StateModel::ORDER_FINISH;
		$data['finish_nums'] = $Order_BaseModel->getPromotionOrderNum($order_con);

		//用户推广商品的数量
		$data['goods_num'] = $this->directseller_model->getDistributionGoodsNum($userId);
		
		//用户淘金店铺
		$data['directseller'] = $this->directseller_model->getOneByWhere(array('directseller_id'=>$userId));

		if ($this->typ == "json")
		{
			$this->data->addBody(-140, $data);
		}
		else
		{
			include $this->view->getView();
		}
	}

    /**
     * 申请淘金店铺
     * 添加申请验证 Zhenzh 20180418
     * 1.如果店铺设置了消费金额限制 需满足条件才能申请
     * 2.如果无限制 则放开 都能申请(可以提交申请 前台还没放开)
     */
	public function addDirectseller()
	{
	    $user_id = Perm::$userId;
	    if($user_id)
        {
            $data['directseller_id']          = $user_id;  //淘金用户ID
            $data['directseller_shop_name']   = request_string("directseller_shop_name");  //淘金小店名称
            $data['directseller_create_time'] = get_date_time();   //创建时间
            $data['directseller_enable']      = 0;
            $data['shop_id']                  = request_int('shop_id');

            //是否已经申请
            $flag = $this->directseller_model->getKeyByWhere(array('directseller_id'=>$data['directseller_id'],'shop_id'=>$data['shop_id']));

            if(!$flag)
            {
                //验证是否可以申请
                //获取店铺设置的淘金消费金额限制
                $Distribution_ShopDirectsellerConfigModel = new Distribution_ShopDirectsellerConfigModel();
                $directseller_config = $Distribution_ShopDirectsellerConfigModel->getOne($data['shop_id']);
                if($directseller_config)
                {
                    $expenditure = $directseller_config['expenditure'];

                    //统计当前用户的消费总金额
                    $expends = $this->directseller_model->getExpends($user_id,Order_StateModel::ORDER_FINISH,$data['shop_id']);
                    if($expends < $expenditure)
                    {
                        $this->data->addBody(-140, $data, 'fail', 250);
                        return false;
                    }
                }

                $add_flag = $this->directseller_model->addDirectseller($data);
            }
        }


		if($add_flag)
		{
			$msg    = _('success');
			$status = 200;
		}
		else
		{
			$msg    = _('failure');
			$status = 250;
		}
		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);
	}

    /**
     * 我的推广
     */
	public function directsellerList()
	{
        $YLB_Page = new YLB_Page();
        $page     = request_int('page',1);
        $rows     = request_int('rows',$YLB_Page->listRows);

		$cond_row['user_parent_id'] = Perm::$userId;
		if(request_string('userName'))
		{
			$cond_row['user_name:LIKE'] = '%'.request_string('userName').'%';
		}
		if(request_string('act')=='month')
		{
			$cond_row['user_regtime:<='] = get_date_time();
			$beginDate = date('Y-m-d H:i:s',mktime(0,0,0,date('m'),1,date('Y')));
			$cond_row['user_regtime:>='] = $beginDate;
		}

		$order = request_string('order');
		if($order)
        {
            if($order == 'reg')
            {
                $order_row['user_regtime'] = 'DESC';
            }
            else if($order == 'login')
            {
                $order_row['user_logintime'] = 'DESC';
            }
        }

		$data = $this->directseller_model->getInvitors($cond_row,$order_row,$page,$rows);

		if ($this->typ == "json")
		{
			$this->data->addBody(-140, $data);
		}
		else
		{
            $YLB_Page->nowPage    = $page;
            $YLB_Page->listRows   = $rows;
            $YLB_Page->totalPages = $data['total'];
            $page_nav             = $YLB_Page->promptII();

			include $this->view->getView();
		}
	}

    /**
     * 我的业绩
     */
    public  function directsellerOrder()
    {

        if (request_string('orderkey'))
        {
            $cond_row['order_id:LIKE'] = '%' . request_string('orderkey') . '%';
        }
        if (request_string('start_date'))
        {
            $cond_row['order_create_time:>'] = request_string('start_date');
        }
        if (request_string('end_date'))
        {
            $cond_row['order_create_time:<'] = request_string('end_date');
        }

        $status = request_string('status');
        if ($status == 'wait_pay')
        {
            //待付款
            $cond_row['order_status'] = Order_StateModel::ORDER_WAIT_PAY;
        }
        else if ($status == 'wait_perpare_goods')
        {
            //待发货 -> 只可退款
            $cond_row['order_status'] = Order_StateModel::ORDER_WAIT_PREPARE_GOODS;
        }
        else if ($status == 'order_payed')
        {
            //已付款
            $cond_row['order_status'] = Order_StateModel::ORDER_PAYED;
        }
        else if ($status == 'wait_confirm_goods')
        {
            //待收货、已发货 -> 退款退货
            $cond_row['order_status'] = Order_StateModel::ORDER_WAIT_CONFIRM_GOODS;
        }
        else if ($status == 'finish')
        {
            //已完成 -> 订单评价
            $cond_row['order_status'] = Order_StateModel::ORDER_FINISH;
        }
        else if ($status == 'cancel')
        {
            //已取消
            $cond_row['order_status'] = Order_StateModel::ORDER_CANCEL;
        }

        $direct = request_string('direct');
        switch($direct)
        {
            case "second" : $cond_row['directseller_p_id'] = Perm::$userId;break;
            case "third" : $cond_row['directseller_gp_id'] = Perm::$userId;break;
            default: $cond_row['directseller_id'] = Perm::$userId;break;
        }

        $YLB_Page = new YLB_Page();
        $page     = request_int('page',1);
        $rows     = request_int('rows',$YLB_Page->listRows);

        $cond_row['order_type:<>'] = Order_BaseModel::ORDER_SPLIT;
        $Order_BaseModel = new Order_BaseModel();
        $data = $Order_BaseModel->getBaseList($cond_row, array('order_create_time' => 'DESC'), $page, $rows);

        if ($this->typ == "json")
        {
            $this->data->addBody(-140, $data);
        }
        else
        {
            $YLB_Page->nowPage    = $page;
            $YLB_Page->listRows   = $rows;
            $YLB_Page->totalPages = $data['total'];
            $page_nav             = $YLB_Page->promptII();

            include $this->view->getView();
        }
    }

    /**
     * 佣金记录
     */
	public function directsellerCommission()
	{
		if (request_string('orderkey'))
		{
			$cond_row['order_id:LIKE'] = '%' . request_string('orderkey') . '%';
		}
		if (request_string('start_date'))
		{
			$cond_row['order_finished_time:>'] = request_string('start_date');
		}
		if (request_string('end_date'))
		{
			$cond_row['order_finished_time:<'] = request_string('end_date');
		}
        $status = request_string('status');
        switch($status)
		{
			case "second" :$cond_row['directseller_p_id'] = Perm::$userId;break;
			case "third" :$cond_row['directseller_gp_id'] = Perm::$userId;break;
			default:$cond_row['directseller_id'] = Perm::$userId;break;
		}

        $YLB_Page = new YLB_Page();
        $page     = request_int('page',1);
        $rows     = request_int('rows',$YLB_Page->listRows);
			
		$cond_row['order_status'] = Order_StateModel::ORDER_FINISH;
		$Order_BaseModel = new Order_BaseModel();
		$data = $Order_BaseModel->getBaseList($cond_row, array('order_create_time' => 'DESC'), $page, $rows);

		if ($this->typ == "json")
		{
			$this->data->addBody(-140, $data);
		}
		else
		{
            $YLB_Page->nowPage    = $page;
            $YLB_Page->listRows   = $rows;
            $YLB_Page->totalPages = $data['total'];
            $page_nav             = $YLB_Page->promptII();

			include $this->view->getView();
		}
	}


	//设置淘金店铺名称
	public function setShopName()
	{
		$userId = Perm::$userId;
		$shop_name = request_string('user_directseller_shop','我的小店');
		
		$User_InfoModel = new User_InfoModel();
		$flag = $User_InfoModel->editInfo($userId,array('user_directseller_shop'=>$shop_name));
		
		if($flag !== false)
		{
			$msg    = _('success');
			$status = 200;
		}
		else
		{
			$msg    = _('failure');
			$status = 250;
		}
		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);
	}
	//淘金市场
    public function directsellerMarket(){
	    $user_id = Perm::$userId;
	    $take_class = request_string('class');
	    $cat_pid = request_string('cat_pid');
	    $list_order = request_string('order');
        $cat_cond['cat_parent_id'] = 0;
        $cat_cond['cat_is_display'] = 1;
        $cat_order['cat_displayorder']= 'ASC';
        $goodsCatModel = new Goods_CatModel();
        $goodsCommonModel = new Goods_CommonModel();
        $class = $goodsCatModel->getByWhere($cat_cond,$cat_order);

        $goods_cat_ids = array_keys($class);
        $goodsCatNavModel = new Goods_CatNavModel();
        $cat_nav_cond['goods_cat_id:IN'] = $goods_cat_ids;
        $goods_cat_nav = $goodsCatNavModel->getByWhere($cat_nav_cond);
        foreach ($goods_cat_nav as $key=>$value)
        {
            if($class[$value['goods_cat_id']])
            {
                $class[$value['goods_cat_id']]['nav_name'] = $value['goods_cat_nav_name'];
            }
        }
        $data['class'] = array_values($class);
        $cond_shop['directseller_id'] = $user_id;
        $cond_shop['directseller_enable'] = 1;
        $Distribution_ShopModel = new Distribution_ShopDirectsellerModel();
        $shopList = $Distribution_ShopModel->getBaseList($cond_shop);
        $shop = array();
        foreach ($shopList as $v){
             array_push($shop,$v['shop_id']);
        }
        $sort = request_string('sort');
        $cond['common_is_directseller'] = 1;
        if ($cat_pid){
            $cond['cat_pid'] = $cat_pid;
        }
        if ($list_order == 'heat'){
            $order['common_collect'] = $sort;
        }
        if ($list_order == 'price'){
            $order['common_price'] = $sort;
        }
        if ($list_order == 'sale'){
            $order['common_salenum'] = $sort;
        }
        if ($list_order == 'radio'){
            $order['common_cps_rate'] = $sort;
        }
        $order['common_id'] = "desc";
        $page = request_int('page',1);
        $rows = request_int('rows',20);
        $detail = $goodsCommonModel->getCommonList($cond,$order,$page,$rows);
            for ($i = 0;$i<=count($detail['items']);$i++){
                if ($detail['items'][$i]['goods_id']['goods_id']){
                    $detail['items'][$i]['goods_mark_id'] = $detail['items'][$i]['goods_id']['goods_id'];
                }
                if ($detail['items'][$i]['goods_id'][0]['goods_id']){
                    $detail['items'][$i]['goods_mark_id'] = intval($detail['items'][$i]['goods_id'][0]['goods_id']);
                }
            if (array_search($detail['items'][$i]['shop_id'],$shop) !== false){
                $detail['items'][$i]['exist'] = 1;
            }
        }
        $data['detail'] = $detail;
        if ($this->typ == "json")
        {
            $this->data->addBody(-140, $data);
        }
        else
        {
            include $this->view->getView();
        }

    }
    //个人中心 淘金管理
    public function centerDirectseller(){
        $User_InfoModel = new User_InfoModel();
        $Goods_CommonModel = new Goods_CommonModel();
        $user_id = Perm::$userId;
        $today = date("Y-m-d");
        //所获收益
        $shouru0 = "select SUM(directseller_commission_0) as commission from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_id = ".$user_id." AND a.directseller_is_settlement = 1";
        $shouru1 = "select SUM(directseller_commission_1) as commission from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_p_id = ".$user_id." AND a.directseller_is_settlement = 1";
        $shouru2 = "select SUM(directseller_commission_2) as commission from ylb_order_base a LEFT JOIN ylb_order_goods b ON a.order_id = b.order_id WHERE a.directseller_gp_id = ".$user_id." AND a.directseller_is_settlement = 1";
        $income0 = $Goods_CommonModel->selectSql($shouru0);
        $income1 = $Goods_CommonModel->selectSql($shouru1);
        $income2 = $Goods_CommonModel->selectSql($shouru2);
        $data['income_total'] = $income0[0]['commission']+$income1[0]['commission']+$income2[0]['commission'];
        //获取推广店铺的ID
        //推广商品的数目
        $cond_row['directseller_id'] = $user_id;
        $cond_row['directseller_enable'] = 1;
        $shops = $this->directseller_model->getByWhere($cond_row);
        $shop_ids = array_column($shops,'shop_id');
        $cond_good_row['shop_id:in'] = $shop_ids;
        $cond_good_row['common_is_directseller'] = 1;
        $data['directseller_goods'] = $Goods_CommonModel->getRowCount($cond_good_row);
        //今日订单
        $wanchengSql = "select count(*) from ylb_order_base WHERE order_date = ".$today."directseller_p_id = ".$user_id." OR directseller_gp_id = ".$user_id." OR directseller_id = ".$user_id;
        $jinri = $Goods_CommonModel->selectSql($wanchengSql);
        $data['jinri'] = $jinri['0']['count(*)'];
        //推广用户
        $cond['user_parent_id'] = $user_id;
        $user = $User_InfoModel->getByWhere($cond);
        $data['user_count'] = count($user);

        $this->data->addBody(-140, $data);
    }
}
?>

