<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class InfoCtl extends Controller
{
    public $User_InfoModel = null;
    public $User_BaseModel = null;
    public $User_ResourceModel = null;
    public $Consume_WithdrawModel = null;
    public $Consume_DepositModel = null;
    public $messageTemplateModel = null;
    public $Consume_RecordModel = null;
    public $Service_FeeModel = null;

	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);
		$this->User_InfoModel  = new User_InfoModel();
		$this->User_BaseModel  = new User_BaseModel();
		$this->User_ResourceModel = new User_ResourceModel();
		$this->Consume_WithdrawModel = new Consume_WithdrawModel();
		$this->Consume_DepositModel = new Consume_DepositModel(); 
		$this->messageTemplateModel = new Message_TemplateModel();
		$this->Consume_RecordModel = new Consume_RecordModel();
		$this->Service_FeeModel = new Service_FeeModel();

	}
	
	//默认设置
	public function webConfig()
	{
		$web['site_logo']      = Web_ConfigModel::value("site_logo");//首页logo
		$web['web_name']       = Web_ConfigModel::value("site_name");//首页名称
		$web['buyer_logo']     = Web_ConfigModel::value("setting_buyer_logo");//会员中心logo
		$web['seller_logo']    = Web_ConfigModel::value("setting_seller_logo");//卖家中心logo
		$web['goods_image']    = Web_ConfigModel::value("photo_goods_logo");//商品图片
		$web['shop_head_logo'] = Web_ConfigModel::value("photo_shop_head_logo");//店铺头像
		$web['shop_logo']      = Web_ConfigModel::value("photo_shop_logo");//店铺标志
		$web['user_avatar']    = Web_ConfigModel::value("photo_user_avatar");//默认头像

		return $web;
	}

	//首页
	public function index()
	{
       //获取用户信息
		$user_id = Perm::$userId;
		$user_info      = $this->User_InfoModel->getUserInfo($user_id);
        $user_base      = $this->User_BaseModel->getOne($user_id);

        //获取用户资产
        $user_resource = $this->User_ResourceModel->getResource($user_id);
        $user_resource = current($user_resource);

        //获取总立减的优惠 Zhenzh
        $key              = YLB_Registry::get('paycenter_api_key');
        $url              = YLB_Registry::get('shop_api_url');
        $paycenter_app_id = YLB_Registry::get('paycenter_app_id');
        $formvars = array();
        $formvars['app_id']		 = $paycenter_app_id;
        $formvars['from_app_id'] = YLB_Registry::get('shop_app_id');
        $formvars['uid']		 = $user_id;
        $rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_Share_Share&met=getShareSheng&typ=json',$url), $formvars);
        if($rs['status'] == 200)
        {
            $price = $rs['data']['sheng_price'];//统计共立减了多少钱
        }

        $user_money_total = $user_resource['user_money'] + $user_resource['user_money_frozen'] + $user_resource['user_recharge_card'] + $user_resource['user_rechange_card_frozen'] + $user_resource['user_share_money_frozen'];
        $user_resource_data = json_encode(array(array('name'=>'账户余额','value'=>$user_resource['user_money']),array('name'=>'卡余额','value'=>$user_resource['user_recharge_card']),array('name'=>'冻结资金','value'=>$user_resource['user_money_frozen']),array('name'=>'冻结分享金','value'=>$user_resource['user_share_money_frozen'])));

		//查找交易记录（10条）
		$consume_record_list = $this->Consume_RecordModel->getRecordList($user_id, null, null, 1, 10);

		$this->view->setMet('main');

		include $this->view->getView();
	}
  
	//首页
	public function main()
	{
		//获取用户信息
		$user_id = Perm::$userId;
		$user_info      = $this->User_InfoModel->getUserInfo($user_id);
		$user_base      = $this->User_BaseModel->getOne($user_id);
		
		//获取用户资产
		$user_resource = $this->User_ResourceModel->getResource($user_id);
		$user_resource = current($user_resource);

		//查找交易记录（3条）
		$consume_record_list = $this->Consume_RecordModel->getRecordList($user_id, null, null, 1, 10);

		include $this->view->getView();
	}

	//移动端首页数据
    public function App_index()
    {
        //获取用户信息

        $user_id = Perm::$userId;

        $user_info      = $this->User_InfoModel->getUserInfo($user_id);
        $user_base      = $this->User_BaseModel->getOne($user_id);

        //获取用户资产
        $user_resource = $this->User_ResourceModel->getResource($user_id);
        $user_resource = current($user_resource);

        //获取今日立赚
        $consume_recordModel = new Consume_RecordModel();
        $consume_cond['user_id'] = $user_id;
        $consume_cond['trade_type_id'] = Trade_TypeModel::SHARE;
        $consume_cond['record_time:>'] = date('Y-m-d H:i:s',time());
        $consume_cond['record_time:<'] = date('Y-m-d H:i:s',strtotime('+1 day',time()));
        $consume_record = $consume_recordModel -> getByWhere($consume_cond);
        $today_total = array_sum(array_column($consume_record,'record_money'));

        //获取总立减的优惠
        $key              = YLB_Registry::get('paycenter_api_key');
        $url              = YLB_Registry::get('shop_api_url');
        $paycenter_app_id = YLB_Registry::get('paycenter_app_id');
        $formvars = array();
        $formvars['app_id']		 = $paycenter_app_id;
        $formvars['from_app_id'] = YLB_Registry::get('shop_app_id');
        $formvars['uid']		 = $user_id;
        $rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_Share_Share&met=getShareSheng&typ=json',$url), $formvars);
        if($rs['status'] == 200)
        {
            $price = $rs['data']['sheng_price'];//统计共立减了多少钱
        }

        $user_money_total = $user_resource['user_money'] + $user_resource['user_money_frozen'] + $user_resource['user_recharge_card'] + $user_resource['user_rechange_card_frozen'] + $user_resource['user_share_money_frozen'];
        $user_resource_data = json_encode(array(array('name'=>'账户余额','value'=>$user_resource['user_money']),array('name'=>'卡余额','value'=>$user_resource['user_recharge_card']),array('name'=>'冻结资金','value'=>$user_resource['user_money_frozen']),array('name'=>'冻结分享金','value'=>$user_resource['user_share_money_frozen'])));

        if($this->typ == 'json')
        {
            $arr['user_info']=$user_info;
            $arr['user_base'] =  $user_base;
            $arr['user_resource'] = $user_resource;
            $arr['user_money_total'] = $user_money_total;
            $arr['user_today_total'] = $today_total;
            $arr['user_share_price'] = $price;
            $this->data->addBody(-140,$arr);
        }
    }

	//交易记录页面 
	public function recordlist()
	{
		$user_id = Perm::$userId;
		//获取用户资产
		$user_resource = $this->User_ResourceModel->getResource($user_id);
		$user_resource = current($user_resource);
		
		$start_date         = request_string("start_date");
		$end_date           = request_string("end_date");
		$time               = request_string("time");
		$status             = request_string("status");
		$type               = request_int("type");
		$record_delete      = request_int("record_delete");
		if ($record_delete)
		{
			$cond_row['record_delete'] = 1;
		}else{
			$cond_row['record_delete'] = 0;
		}
		
		if ($time)
		{
			$cond_row['record_time:>='] = $time;
		}
		
		if ($start_date)
		{
			$cond_row['record_time:>='] = $start_date;
		}
		if ($end_date)
		{
			$cond_row['record_time:<='] = $end_date;
		}
		if ($status)
		{
			//进行中 1.购物为待付款到未确认收货之间的状态 2.其他为为处理中
			if($status == 'doing')
			{
				$cond_row['record_status:!='] = RecordStatusModel::RECORD_FINISH;
				$cond_row['record_status:!='] = RecordStatusModel::RECORD_CANCEL;
				$cond_row['record_status:!='] = RecordStatusModel::RECORD_FAIL;
			}

			//未付款
			if($status == 'waitpay')
			{
				$cond_row['record_status'] = RecordStatusModel::IN_HAND;
			}

			//等待发货
			if($status == 'waitsend')
			{
				$cond_row['record_status'] = RecordStatusModel::RECORD_WAIT_SEND_GOODS;
			}

			//未确认收货
			if($status == 'waitconfirm')
			{
				$cond_row['record_status'] = RecordStatusModel::RECORD_WAIT_CONFIRM_GOODS;
			}

			//退款
			if($status == 'retund')
			{
				$cond_row['trade_type_id'] = Trade_TypeModel::REFUND;
			}

			//成功
			if($status == 'success')
			{
				$cond_row['record_status'] = RecordStatusModel::RECORD_FINISH;
			}

			//取消
			if($status == 'cancel')
			{
				$cond_row['record_status'] = RecordStatusModel::RECORD_CANCEL;
			}

		}
		if ($type && ($status != 'retund'))
		{
			fb($type);
			fb("+++++++");
			$cond_row['trade_type_id'] = $type;
		}
		
		$YLB_Page           = new YLB_Page();
		$YLB_Page->listRows = request_int('listRows')?request_int('listRows'):10;
		$rows              = $YLB_Page->listRows;
		$offset            = request_int('firstRow', 0);
		$page              = ceil_r($offset / $rows);
	
		$cond_row['user_id'] = $user_id;
		$consume_record_list = $this->Consume_RecordModel->getRecordList1($cond_row,array("consume_record_id"=>"DESC"), $page, $rows);

		$YLB_Page->totalRows = $consume_record_list['totalsize'];
		$page_nav           = $YLB_Page->prompt();

		
		include $this->view->getView();
	}
	//交易记录移动端数据
    public function App_recordlist()
    {
        $user_id = Perm::$userId;

        //获取用户资产
        $User_ResourceModel = new User_ResourceModel();

        $user_resource = $User_ResourceModel->getResource($user_id);
        $user_resource = current($user_resource);

        $start_date         = request_string("start_date");//开始时间
        $end_date           = request_string("end_date");//结束时间
        $time               = request_string("time");//最近时间
        $status             = request_string("status");//状态
        $type               = request_int("type");//类型
        $record_delete      = request_int("record_delete");//回收站数据
        if ($record_delete)
        {
            $cond_row['record_delete'] = 1;
        }else{
            $cond_row['record_delete'] = 0;
        }

        if ($time)
        {
            $cond_row['record_time:>='] = $time;
        }

        if ($start_date)
        {
            $cond_row['record_time:>='] = $start_date;
        }
        if ($end_date)
        {
            $cond_row['record_time:<='] = $end_date;
        }
        if ($status)
        {
            //进行中 1.购物为待付款到未确认收货之间的状态 2.其他为为处理中
            if($status == 'doing')
            {
                $cond_row['record_status:!='] = RecordStatusModel::RECORD_FINISH;
                $cond_row['record_status:!='] = RecordStatusModel::RECORD_CANCEL;
                $cond_row['record_status:!='] = RecordStatusModel::RECORD_FAIL;
            }

            //未付款
            if($status == 'waitpay')
            {
                $cond_row['record_status'] = RecordStatusModel::IN_HAND;
            }

            //等待发货
            if($status == 'waitsend')
            {
                $cond_row['record_status'] = RecordStatusModel::RECORD_WAIT_SEND_GOODS;
            }

            //未确认收货
            if($status == 'waitconfirm')
            {
                $cond_row['record_status'] = RecordStatusModel::RECORD_WAIT_CONFIRM_GOODS;
            }

            //退款
            if($status == 'retund')
            {
                $cond_row['trade_type_id'] = Trade_TypeModel::REFUND;
            }

            //成功
            if($status == 'success')
            {
                $cond_row['record_status'] = RecordStatusModel::RECORD_FINISH;
            }

            //取消
            if($status == 'cancel')
            {
                $cond_row['record_status'] = RecordStatusModel::RECORD_CANCEL;
            }

        }
        if ($type && ($status != 'retund'))
        {
            fb($type);
            fb("+++++++");
            $cond_row['trade_type_id'] = $type;
        }

        $YLB_Page           = new YLB_Page();
        $YLB_Page->listRows = request_int('listRows')?request_int('listRows'):10;
        $rows              = $YLB_Page->listRows;
        $offset            = request_int('firstRow', 0);
        $page              = ceil_r($offset / $rows);

        $cond_row['user_id'] = $user_id;
        $consume_record_list = $this->Consume_RecordModel->getRecordList1($cond_row,array("consume_record_id"=>"DESC"), $page, $rows);

        $YLB_Page->totalRows = $consume_record_list['totalsize'];
        $page_nav           = $YLB_Page->prompt();

        //补加用户信息
        $user =  new User_InfoModel();
        $user_info = $user->getUserInfo($user_id);
        if($this->typ == 'json')
        {
            $arr['user_info'] = $user_info;
            $arr['consume_record_list'] = $consume_record_list;
            $this->data->addBody(-140,$arr);
        }


    }
	//删除记录
	public function delRecordlist()
	{
		//获取用户信息
		$user_id = Perm::$userId;
		//$user_id = '1';
		$consume_record_id = request_string('id');
		$record_delete = request_string('record_delete');
		$edit['user_id'] = $user_id;
		
		$re =$this->Consume_RecordModel->getRecord($consume_record_id,$edit);
		
		if($re){
			if($record_delete){
				$edit['record_delete'] = 0;
			}else{
				$edit['record_delete'] = 1;
			}
			
			$flag     =$this->Consume_RecordModel->editRecord($consume_record_id,$edit);
			if ($flag)
			{
				$msg    = 'success';
				$status = 200;
			}
			else
			{
				$msg    = 'failure';
				$status = 250;
			}
		}	
		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);

	}
	//交易详情记录页面 
	public function recorddetail()
	{
		$consume_record_id = request_string('id');
		$re =$this->Consume_RecordModel->getOne($consume_record_id);

        if($re['trade_type_id'] == Trade_TypeModel::SHOPPING)
        {
            $key      = YLB_Registry::get('paycenter_api_key');
            $url         = YLB_Registry::get('shop_api_url');
            $paycenter_app_id = YLB_Registry::get('paycenter_app_id');
            $formvars = array();
            $formvars['app_id']					= $paycenter_app_id;
            $formvars['from_app_id'] = YLB_Registry::get('shop_app_id');
            $formvars['order_id']					= $re['order_id'];
            $rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_Trade_Order&met=getSnapshotByOrder&typ=json',$url), $formvars);

            if($rs['status'] == 200)
            {
                $snapshot = $rs['data'];
            }
        }

		if($re['trade_type_id'] == Trade_TypeModel::WITHDRAW)
		{
		   $data = $this->Consume_WithdrawModel->getWithdrawByOid($re['order_id']);
		   foreach($data as $k=>$v)
		   {
			   $id = $v['supportTime'];
			   $de=$this->Service_FeeModel->getOne($id);
			   $data[$k]['time_con'] = $de['name'];
		   }
		}
		include $this->view->getView();
	}
	//充值页面 DEPOSIT
	public function deposit()
	{
		$user_id = Perm::$userId;
		//查找账户的余额和充值卡信息
		$User_ResourceModel = new User_ResourceModel();
		$user_resource = $User_ResourceModel->getOne($user_id);
		fb($user_resource);

		//获取用户所有的充值卡信息
		$Card_InfoModel = new Card_InfoModel();
		$card_list = $Card_InfoModel->getUserCard($user_id);

		fb($card_list);

		include $this->view->getView();
	}
	//充值记录页面 DEPOSIT
	public function depositlist()
	{
		$user_id = Perm::$userId;
		//$user_id = 1;
		//获取用户资产
		$User_ResourceModel = new User_ResourceModel();

		$user_resource = $User_ResourceModel->getResource($user_id);
		$user_resource = current($user_resource);
		
		$YLB_Page           = new YLB_Page();
		$YLB_Page->listRows = request_int('listRows')?request_int('listRows'):10;
		$rows              = $YLB_Page->listRows;
		$offset            = request_int('firstRow', 0);
		$page              = ceil_r($offset / $rows);
		
		
		$cond_row['server_id'] = $user_id;
		$consume_Deposit_list = $this->Consume_DepositModel->getDepositList1($cond_row,array("deposit_gmt_create"=>"DESC"), $page, $rows);
		
		$YLB_Page->totalRows = $consume_Deposit_list['totalsize'];
		$page_nav           = $YLB_Page->prompt();

		include $this->view->getView();
	}

	//提现页面 Withdraw  //判断更改看是否审核   17/10/20    senyzy
	public function withdraw()
	{
		//获取服务费用
		$Service_FeeModel = new Service_FeeModel();
		$service_fee_list = array_values($Service_FeeModel->getFee("*"));
		fb($service_fee_list);
		//获取用户的实名
		$User_InfoModel = new User_InfoModel();
		$user_info = $User_InfoModel->getUserInfo(Perm::$userId);

		fb($user_info);
		$realname = $user_info['user_realname'];
		$statu    = $user_info['user_identity_statu'];

        if($realname && $statu)
        {
            $real = 1;
        }
        else
        {
            $real = 0;
            $realname = 0;

            header("Location:" . YLB_Registry::get('url') . "?ctl=Info&met=certification&type=withdraw");
        }


        $key      = YLB_Registry::get('paycenter_api_key');
        $url         = YLB_Registry::get('shop_api_url');
        $paycenter_app_id = YLB_Registry::get('paycenter_app_id');
        $formvars = array();
        $formvars['app_id']					= $paycenter_app_id;
        $formvars['from_app_id'] = YLB_Registry::get('shop_app_id');
        $formvars['user_id']					= Perm::$userId;

        $rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_User_Base&met=getUserShop&typ=json',$url), $formvars);
        //200 是卖家
        if($rs['status'] == 200)
        {
            $shop_company = $rs['data']['shop_company'];
            $data['shop_company'] = $shop_company;
        }
        else
        {
            $user_cardModel = new User_CardModel();
            $cond_card_row['user_id'] =$user_info['user_id'];
            $user_card = $user_cardModel->getUserCardByWhere($cond_card_row);
            if($user_card)
            {
                $data['user_card'] = $user_card;
            }
            else
            {
                //header("Location:" . YLB_Registry::get('url') . "?ctl=Info&met=bundingusercard&typ=e");
            }

        }

            include $this->view->getView();
    }
    //移动端提现主页数据
    public function App_withdraw()
    {
        //获取服务费用
        $Service_FeeModel = new Service_FeeModel();
        $service_fee_list = array_values($Service_FeeModel->getFee("*"));
        $data = array();
        $data['service_fee_list'] = $service_fee_list;
        fb($service_fee_list);
        //获取用户的实名
        $User_InfoModel = new User_InfoModel();
        $user_info = $User_InfoModel->getUserInfo(Perm::$userId);
        $data['user_info'] = $user_info;
        fb($user_info);
        //根据用户姓名判断是否实名（bug） senyzy
        $realname = $user_info['user_realname'];
        $card  = $user_info['user_identity_card'];

        if(!$realname || !$card)
        {
           $msg = '请先实名认证';
           //220代表用户未实名认证
           $status = '220';
           $arr = array();
           $this->data->addBody(-140,$arr,$msg,$status);
        }
        //获取用户资源
        $user_resource = new User_ResourceModel();
        $resource = $user_resource->getResource(perm::$userId);
        $data['user_info']['user_money'] = $resource[perm::$userId]['user_money'];


        $key      = YLB_Registry::get('paycenter_api_key');
        $url         = YLB_Registry::get('shop_api_url');
        $paycenter_app_id = YLB_Registry::get('paycenter_app_id');
        $formvars = array();
        $formvars['app_id']					= $paycenter_app_id;
        $formvars['from_app_id'] = YLB_Registry::get('shop_app_id');
        $formvars['user_id']					= Perm::$userId;

        $rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_User_Base&met=getUserShop&typ=json',$url), $formvars);
        //200 是卖家
        if($rs['status'] == 200)
        {
            $shop_company = $rs['data']['shop_company'];
            $data['shop_company'] = $shop_company;
        }
        else
        {
            $user_cardModel = new User_CardModel();
            $cond_card_row['user_id'] =$user_info['user_id'];
            $user_card = $user_cardModel->getUserCardByWhere($cond_card_row);
            if($user_card)
            {
                $data['user_card'] = $user_card;
            }
            else
            {
                //header("Location:" . YLB_Registry::get('url') . "?ctl=Info&met=bundingusercard&typ=e");
            }

        }

        if($this->typ == 'json')
        {
//            echo '<pre>';
//            print_r($data);die;
            $this->data->addBody(-140,$data);
        }

    }

	//页面选择
    public function withdrawSelect()
    {
        //获取服务费用
        $Service_FeeModel = new Service_FeeModel();

        $service_fee_list = array_values($Service_FeeModel->getFee("*"));

        $this->data->addBody(-140,$service_fee_list);
    }
	
	//提现记录页面 Withdrawlist
	public function withdrawlist()
	{
		$YLB_Page           = new YLB_Page();
		$YLB_Page->listRows = request_int('listRows')?request_int('listRows'):10;
		$rows              = $YLB_Page->listRows;
		$offset            = request_int('firstRow', 0);
		$page              = ceil_r($offset / $rows);
		
		//$user_id = 1;
		$user_id = Perm::$userId;
		$cond_row['pay_uid'] = $user_id;
		$consume_withdraw_list = $this->Consume_WithdrawModel->getWithdrawList($cond_row,array("add_time"=>"DESC"), $page, $rows);
		
		$YLB_Page->totalRows = $consume_withdraw_list['totalsize'];
		$page_nav           = $YLB_Page->prompt();

		include $this->view->getView();
	}

	//转账页面 Transfer
	public function transfer()
	{
		include $this->view->getView();
	}
	//转账记录接口
    public function App_transfer()
    {
        $user_id = perm::$userId;
        $User_InfoModel = new User_InfoModel();
        $data = $User_InfoModel->getUserInfo($user_id);
        //获取用户资源
        $user_resource = new User_ResourceModel();
        $resource = $user_resource->getResource(perm::$userId);
        $data['user_money'] = $resource[perm::$userId]['user_money'];
        if($this->typ == 'json')
        {
            $this->data->addBody(-140,$data);
        }

    }
	//转账记录页面 
	public function transferlist()
	{
		//$user_id = 1;
		//获取用户资产
		$user_id = Perm::$userId;
		$user_resource = $this->User_ResourceModel->getResource($user_id);
		$user_resource = current($user_resource);
		
		$YLB_Page           = new YLB_Page();
		$YLB_Page->listRows = request_int('listRows')?request_int('listRows'):10;
		$rows              = $YLB_Page->listRows;
		$offset            = request_int('firstRow', 0);
		$page              = ceil_r($offset / $rows);

		$cond_row['user_id'] = $user_id;
		$cond_row['trade_type_id'] = 2;
		$consume_record_list = $this->Consume_RecordModel->getRecordList1($cond_row,array("record_time"=>"DESC"), $page, $rows);
		
		$YLB_Page->totalRows = $consume_record_list['totalsize'];
		$page_nav           = $YLB_Page->prompt();

		include $this->view->getView();
	}

	public function pay()
	{
		$user_id = Perm::$userId;
		$uorder = request_string('uorder');
		$act = request_string('act');
		//获取需要支付的订单信息
		$Union_OrderModel = new Union_OrderModel();
		$uorder_base = $Union_OrderModel->getOne($uorder);

		if($uorder_base['order_state_id'] == Union_OrderModel::WAIT_PAY)
        {
            if ($uorder_base['trade_payment_amount'] > 0)
            {
                //查询可使用的支付方式
                $Payment_ChannelModel = new Payment_ChannelModel();
                $payment_channel = $Payment_ChannelModel->getByWhere(array('payment_channel_enable' => Payment_ChannelModel::ENABLE_YES ));
                //获取当前用户的资金
                $User_ResourceModel = new User_ResourceModel();
                $user_resource = $User_ResourceModel->getOne($user_id);
                foreach($payment_channel as $key => $val)
                {
                    if($val['payment_channel_code'] == 'cards' || $val['payment_channel_code'] == 'money')
                    {
                        unset($payment_channel[$key]);
                    }

                    //如果是微信内置浏览器 屏蔽支付宝支付
                    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false &&  $val['payment_channel_code'] == 'alipay')
                    {
                        unset($payment_channel[$key]);
                    }
                }

                $payment_channel = array_values($payment_channel);

                include $this->view->getView();
            }
            else if ($uorder_base['trade_payment_amount'] == 0)
            {
                $Consume_DepositModel = new Consume_DepositModel();
                $Consume_DepositModel->notifyShop($uorder,$uorder_base['buyer_id'],Payment_ChannelModel::MONEY);
                location_to(YLB_Registry::get('shop_api_url').'?ctl=Buyer_Order&met=physical');
            }
            else
            {
                echo '订单金额异常';die;
            }
        }
        else
        {
            echo '订单状态不为待付款状态';die;
        }
	}

    public function checkPayWay()
    {
        $card_payway = request_string('card_payway');
        $money_payway = request_string('money_payway');
        $online_payway = request_string('online_payway');

        $uorder_id = request_string('uorder_id');

        //查找订单的支付信息
        $Union_OrderModel = new Union_OrderModel();

        $uorder_base = $Union_OrderModel->getOne($uorder_id);

        if($uorder_base)
        {
            //订单支付的总金额
            $payment_amount  = $uorder_base['trade_payment_amount'];
            $user_card_pay   = 0;
            $user_money_pay  = 0;
            $user_online_pay = 0;

            if($payment_amount > 0)
            {
                //开启事物
                $Union_OrderModel->sql->startTransactionDb();

                /*$urow = $Union_OrderModel->getByWhere(array('inorder'=>$uorder_base['inorder']));
                $uorder_id_row = array_column($urow,'union_order_id');*/
                $uorder_id_row = $Union_OrderModel->getKeyByWhere(array('inorder'=>$uorder_base['inorder']));

                //使用充值卡或账户余额支付时，查找账户的资源资源信息
                if($card_payway == 'true' || $money_payway == 'true')
                {
                    $User_ResourceModel = new User_ResourceModel();
                    $user_resource = $User_ResourceModel->getOne(Perm::$userId);

                    $user_money = $user_resource['user_money'];
                    $user_card = $user_resource['user_recharge_card'];

                    //使用充值卡支付
                    if($card_payway == 'true')
                    {
                        if($user_card <= $payment_amount)
                        {
                            $user_card_pay = $user_card;
                            $payment_amount = $payment_amount - $user_card;
                        }
                        else
                        {
                            $user_card_pay = $payment_amount;
                        }
                    }

                    //使用账户余额支付
                    if($money_payway == 'true')
                    {
                        if($user_money <= $payment_amount)
                        {
                            $user_money_pay = $user_money;
                            $payment_amount = $payment_amount - $user_money_pay;
                        }
                        else
                        {
                            $user_money_pay = $payment_amount;
                        }
                    }


                }

                if($online_payway)
                {
                    $user_online_pay = $payment_amount;
                }

                //将用户的付款信息插入表中
                $edit_union_order_row['union_cards_pay_amount'] = $user_card_pay;
                $edit_union_order_row['union_money_pay_amount'] = $user_money_pay;
                $edit_union_order_row['union_online_pay_amount'] = $user_online_pay;

                $Union_OrderModel = new Union_OrderModel();
                $flag = $Union_OrderModel->editUnionOrder($uorder_id_row,$edit_union_order_row);

                if($flag !== false && $Union_OrderModel->sql->commitDb() )
                {
                    $msg    = 'success';
                    $status = 200;
                }
                else
                {
                    $Union_OrderModel->sql->rollBackDb();
                    $m      = $Union_OrderModel->msg->getMessages();
                    $msg    = $m ? $m[0] : _('failure');
                    $status = 250;
                }
            }
            else if($payment_amount == 0)
            {
                //如果送福免单 订单金额为0 自动支付
                $Consume_DepositModel = new Consume_DepositModel();
                $flag = $Consume_DepositModel->notifyShop($uorder_id,$uorder_base['buyer_id'],Payment_ChannelModel::MONEY);
                if ($flag['status'] == 200)
                {
                    $status = 210;
                }
            }
        }
        else
        {
            $msg = '';
            $status = 250;
        }

        $this->data->addBody(-140, [], $msg, $status);
    }

	//添加充值记录
	public function addDeposit()
	{
		$deposit_amount = request_float('deposit_amount');

		$Union_OrderModel = new Union_OrderModel();
		//开启事务
		$Union_OrderModel->sql->startTransactionDb();

		//生成合并支付订单
		$uorder      = "U" . date("Ymdhis", time()) . rand(100, 999);  //18位

		$trade_title = $uorder;
		$uprice      = $deposit_amount;
		$buyer       = Perm::$userId;
		$buyer_name = Perm::$row['user_account'];

		$add_row = array(
			'union_order_id' => $uorder,
            'inorder' => $trade_title,
			'trade_title' => $trade_title,
			'trade_payment_amount' => $uprice,
			'create_time' => date("Y-m-d H:i:s"),
			'buyer_id' => $buyer,
			'order_state_id' => Union_OrderModel::WAIT_PAY,
			'union_online_pay_amount' => $uprice,
			'trade_type_id' => Trade_TypeModel::DEPOSIT,
			'app_id' => YLB_Registry::get('paycenter_app_id'),
		);

		$flag            = $Union_OrderModel->addUnionOrder($add_row);

		//添加充值表
		$Consume_DepositModel = new Consume_DepositModel();
		$add_deposit_row = array();
		$add_deposit_row['deposit_trade_no'] = $uorder;
		$add_deposit_row['deposit_buyer_id'] = $buyer;
		$add_deposit_row['deposit_total_fee'] = $deposit_amount;
		$add_deposit_row['deposit_gmt_create'] = date('Y-m-d H:i:s');
		$add_deposit_row['deposit_trade_status'] = RecordStatusModel::IN_HAND;
		$Consume_DepositModel->addDeposit($add_deposit_row);

		//添加交易明细
		$Consume_RecordModel = new Consume_RecordModel();
		$Trade_TypeModel = new Trade_TypeModel();
		$record_add_buy_row                  = array();
		$record_add_buy_row['order_id']      = $uorder;
		$record_add_buy_row['user_id']       = $buyer;
		$record_add_buy_row['user_nickname'] = $buyer_name;
		$record_add_buy_row['record_money']  = $deposit_amount;
		$record_add_buy_row['record_date']   = date('Y-m-d');
		$record_add_buy_row['record_year']	   = date('Y');
		$record_add_buy_row['record_month']	= date('m');
		$record_add_buy_row['record_day']		=date('d');
		$record_add_buy_row['record_title']  = $Trade_TypeModel->trade_type[Trade_TypeModel::DEPOSIT];
		$record_add_buy_row['record_time']   = date('Y-m-d H:i:s');
		$record_add_buy_row['trade_type_id'] = Trade_TypeModel::DEPOSIT;
		$record_add_buy_row['user_type']     = 1;	//收款方
		$record_add_buy_row['record_status'] = RecordStatusModel::IN_HAND;

		$Consume_RecordModel->addRecord($record_add_buy_row);

		if ($flag && $Union_OrderModel->sql->commitDb())
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$Union_OrderModel->sql->rollBackDb();
			$m      = $Union_OrderModel->msg->getMessages();
			$msg    = $m ? $m[0] : _('failure');
			$status = 250;
		}

		$data = array('uorder' => $uorder);
		$this->data->addBody(-140, $data, $msg, $status);
	}

	public function checkCardPasswor()
	{
		$card_code = request_string('card_code');
		$card_password = request_string('card_password');

        $Card_InfoModel = new Card_InfoModel();
        $card_info = $Card_InfoModel->getOne($card_code);

        if($card_info)
        {
            if($card_info['card_password'] == $card_password)
            {
                $flag = true;
            }
            else
            {
                $m = '支付卡密码错误';
                $flag = false;
            }
        }
        else
        {
            $m = '支付卡不存在';
            $flag = false;
        }

        if($flag)
        {
            $msg    = 'success';
            $status = 200;
        }
        else
        {
            $msg    =  $m ? $m : 'failure';
            $status = 250;
        }

        $data = array();
        $this->data->addBody(-140, $data, $msg, $status);

	}

	public function depositCard()
    {
        $card_code = request_string('card_code');
        $user_id = Perm::$userId;

        //1.改变支付卡的使用情况
        $Card_InfoModel = new Card_InfoModel();

        //开启事务
        $Card_InfoModel->sql->startTransactionDb();
        $card_info = $Card_InfoModel->getOne($card_code);

        $Card_BaseModel = new Card_BaseModel();
        $card_base = $Card_BaseModel->getOne($card_info['card_id']);

        $card_prize = json_decode($card_base['card_prize'], true);
        $money = isset($card_prize['m'])?$card_prize['m']:0;

        $edit_card_row = array();
        $edit_card_row['card_fetch_time'] = date('Y-m-d H:i:s');
        $edit_card_row['user_id'] = $user_id;
        $edit_card_row['user_account'] = Perm::$row['user_account'];
        $edit_card_row['server_id'] = get_ip();

        $Card_InfoModel->editInfo($card_code,$edit_card_row);


        //2.添加充值表
        $Consume_DepositModel = new Consume_DepositModel();
        $add_deposit_row = array();
        $add_deposit_row['deposit_trade_no'] = $card_code;
        $add_deposit_row['deposit_buyer_id'] = $user_id;
        $add_deposit_row['deposit_total_fee'] = $money;
        $add_deposit_row['deposit_gmt_create'] = date('Y-m-d H:i:s');
        $add_deposit_row['deposit_trade_status'] = RecordStatusModel::RECORD_FINISH;
        $Consume_DepositModel->addDeposit($add_deposit_row);

        //3.添加交易明细
        $Consume_RecordModel = new Consume_RecordModel();
        $Trade_TypeModel = new Trade_TypeModel();
        $record_add_buy_row                  = array();
        $record_add_buy_row['order_id']      = $card_code;
        $record_add_buy_row['user_id']       = $user_id;
        $record_add_buy_row['user_nickname'] = Perm::$row['user_account'];
        $record_add_buy_row['record_money']  = $money;
        $record_add_buy_row['record_date']   = date('Y-m-d');
        $record_add_buy_row['record_year']	   = date('Y');
        $record_add_buy_row['record_month']	= date('m');
        $record_add_buy_row['record_day']		=date('d');
        $record_add_buy_row['record_title']  = $Trade_TypeModel->trade_type[Trade_TypeModel::DEPOSIT];
        $record_add_buy_row['record_time']   = date('Y-m-d H:i:s');
        $record_add_buy_row['trade_type_id'] = Trade_TypeModel::DEPOSIT;
        $record_add_buy_row['user_type']     = 1;	//收款方
        $record_add_buy_row['record_status'] = RecordStatusModel::RECORD_FINISH;

        $Consume_RecordModel->addRecord($record_add_buy_row);


        //4.修改用户的充值卡金额
        $User_ResourceModel = new User_ResourceModel();
        $flag = $User_ResourceModel->editResource($user_id,array('user_recharge_card'=>$money),true);


       if ($flag && $Card_InfoModel->sql->commitDb())
       {
           $msg    = 'success';
           $status = 200;
       }
       else
       {
           $Card_InfoModel->sql->rollBackDb();
           $m      = $Card_InfoModel->msg->getMessages();
           $msg    = $m ? $m[0] : _('failure');
           $status = 250;
       }

		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);

    }

	public function security()
	{
		include $this->view->getView();
	}

	public function account()
	{
		$key    = YLB_Registry::get('ucenter_api_key');;
		$url    = YLB_Registry::get('ucenter_api_url');
		fb($url);
		$app_id = YLB_Registry::get('ucenter_app_id');
		$data              = array();
		$data['app_id']    = $app_id;
		$data['ctl'] = 'Api';
		$data['met'] = 'getUserInfo';
		$data['typ'] = 'json';
		$data['user_id'] = Perm::$userId;
		//$data['user_id'] = 1;
		$init_rs         = get_url_with_encrypt($key, $url, $data);
		$listarr = $init_rs['data'];
		
		//$user_id = 1;
		$user_id = Perm::$userId;
		$User_InfoModel = new User_InfoModel();
		$user_info      = $User_InfoModel->getInfo($user_id);
		include $this->view->getView();
	}
	//修改支付密码
	public function passwd()
	{
		//获取用户信息
		$user_id = Perm::$userId;
		//$user_id = '1';
		$data      = $this->User_InfoModel->getUserInfo($user_id);
		//print_r($data);
		include $this->view->getView();
	}
	//实名认证
	public function certification()
	{
		//获取用户信息
		$user_id = Perm::$userId;
		//$user_id = '1';

		$User_InfoModel = new User_InfoModel();
		$data      = $User_InfoModel->getUserInfo($user_id);
		include $this->view->getView();
	}
	//实名认证插入资料
	public function editCertification()
	{
		//获取用户信息
		$user_id = Perm::$userId;
		//$user_id = '1';
        $User_InfoModel = new User_InfoModel();

		$edit['user_realname'] = request_string('user_realname');
		$edit['user_identity_card'] = request_string('user_identity_card');
		$edit['user_identity_type'] = request_string('user_identity_type');
		$edit['user_identity_font_logo'] = request_string('user_identity_font_logo');
		$edit['user_identity_face_logo'] = request_string('user_identity_face_logo');
        $edit['user_identity_hand_logo'] = request_string('user_identity_hand_logo');
        $edit['user_identity_statu'] = '1';
		$flag     = $User_InfoModel->editInfo($user_id,$edit);
		if ($flag !== false)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}

		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);

	}
	//支付宝支付
	public function alipay()
	{
		$trade_id = request_string('trade_id');

		//如果订单号为合并订单号，则获取合并订单号的信息
		$Union_OrderModel = new Union_OrderModel();
		$trade_row        = $Union_OrderModel->getOne($trade_id);

		if ($trade_row)
		{
			$Payment = PaymentModel::create('alipay');
			$Payment->pay($trade_row);
		}
		else
		{

		}
	}

	public function wx()
	{
		$Consume_TradeModel = new Consume_TradeModel();
		$trade_row          = $Consume_TradeModel->getOne('11321322');

		if ($trade_row)
		{
			$Payment = PaymentModel::create('wx_native');
			$Payment->pay($trade_row);
		}
		else
		{

		}
	}


	public function tenpay()
	{
		$trade_id = request_string('trade_id');

		//如果订单号为合并订单号，则获取合并订单号的信息
		$Union_OrderModel = new Union_OrderModel();
		$trade_row        = $Union_OrderModel->getOne($trade_id);

		$trade_row['trade_mode'] = '1';  //交易模式 1即时到账（默认） 2中介担保 3后台选择（买家进支付中心列表选择�?

		if ($trade_row)
		{
			$Payment = PaymentModel::create('tenpay');
			$Payment->pay($trade_row);
		}
		else
		{

		}
	}


	public function tenpayWap()
	{
		$trade_id           = request_string('trade_id');
		$Consume_TradeModel = new Consume_TradeModel();
		$trade_row          = $Consume_TradeModel->getOne('11321322');

		if ($trade_row)
		{
			$Payment = PaymentModel::create('tenpay_wap');
			$Payment->pay($trade_row);
		}
		else
		{

		}
	}
	//添加合并支付订单信息pay_union_order
	public function addUnionOrder()
	{
		//生成合并支付订单号
		$uorder      = "U" . date("Ymdhis", time()) . rand(100, 999);  //18位
		$inorder     = request_string('inorder');

		fb($inorder);
		exit;



		$inorder     = substr($inorder, 0, -1);
		$trade_title = request_string('trade_title');
		$uprice      = request_float('uprice');
		$buyer       = request_int('buyer');
		$buyer_name  = request_string('buyer_name');

		$add_row = array(
			'union_order_id' => $uorder,
			'inorder' => $inorder,
			'trade_payment_amount' => $uprice,
			'create_time' => time(),
			'buyer_id' => $buyer,
			'order_state_id' => Union_OrderModel::WAIT_PAY,
		);

		$Union_OrderModel = new Union_OrderModel();
		$flag1            = $Union_OrderModel->addUnionOrder($add_row);

		if ($flag1)
		{
			//插入交易明细表
			$record_add_row                  = array();
			$record_add_row['order_id']      = $uorder;
			$record_add_row['user_id']       = $buyer;
			$record_add_row['user_nickname'] = $buyer_name;
			$record_add_row['record_money']  = $uprice;
			$record_add_row['record_date']   = date('Y-m-d');
			$record_add_row['record_title']  = '购物';
			$record_add_row['record_time']   = date('Y-m-d H:i:s');
			$record_add_row['trade_type_id'] = Trade_TypeModel::SHOPPING;
			$record_add_row['user_type']     = 2;
			$record_add_row['record_status'] = RecordStatusModel::IN_HAND;

			$Consume_RecordModel = new Consume_RecordModel();
			$flag                = $Consume_RecordModel->addRecord($record_add_row);
		}
		else
		{
			$flag = false;
		}

		if ($flag)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}

		$data = array('uorder' => $uorder);
		$this->data->addBody(-140, $data, $msg, $status);
	}

	//添加交易订单信息
	public function addConsumeTrade()
	{
		$consume_trade_id     = request_string('consume_trade_id');
		$order_id             = request_string('order_id');
		$buy_id               = request_int('buy_id');
		$buyer_name			  = request_string('buyer_name');
		$seller_id            = request_int('seller_id');
		$seller_name		  = request_string('seller_name');
		$order_state_id       = request_int('order_state_id');
		$order_payment_amount = request_float('order_payment_amount');
		$trade_remark         = request_string('trade_remark');
		$trade_create_time    = request_string('trade_create_time');
		$trade_title		  = request_string('trade_title');

		$add_row                         = array();
		$add_row['consume_trade_id']     = $consume_trade_id;
		$add_row['order_id']             = $order_id;
		$add_row['buyer_id']             = $buy_id;
		$add_row['seller_id']            = $seller_id;
		$add_row['order_state_id']       = $order_state_id;
		$add_row['order_payment_amount'] = $order_payment_amount;
		$add_row['trade_type_id']        = Trade_TypeModel::SHOPPING;
		$add_row['trade_remark']         = $trade_remark;
		$add_row['trade_create_time']    = $trade_create_time;
		$add_row['trade_amount']         = $order_payment_amount;
		$add_row['trade_payment_amount'] = $order_payment_amount;

		//1.生成交易订单
		$Consume_TradeModel = new Consume_TradeModel();
		$flag               = $Consume_TradeModel->addTrade($add_row);

		//2.生成合并支付订单
		$uorder      = "U" . date("Ymdhis", time()) . rand(100, 999);  //18位
		$union_add_row = array(
			'union_order_id' => $uorder,
			'inorder' => $order_id,
			'trade_payment_amount' => $order_payment_amount,
			'create_time' => time(),
			'buyer_id' => $buy_id,
			'order_state_id' => Union_OrderModel::WAIT_PAY,
		);

		$Union_OrderModel = new Union_OrderModel();
		$Union_OrderModel->addUnionOrder($union_add_row);

		//3.生成交易明细（付款方，收款方）
		$Consume_RecordModel = new Consume_RecordModel();

		$record_add_buy_row                  = array();
		$record_add_buy_row['order_id']      = $order_id;
		$record_add_buy_row['user_id']       = $buy_id;
		$record_add_buy_row['user_nickname'] = $buyer_name;
		$record_add_buy_row['record_money']  = $order_payment_amount;
		$record_add_buy_row['record_date']   = date('Y-m-d');
		$record_add_buy_row['record_year']	   = date('Y');
		$record_add_buy_row['record_month']	= date('m');
		$record_add_buy_row['record_day']		=date('d');
		$record_add_buy_row['record_title']  = '购物';
		$record_add_buy_row['record_time']   = date('Y-m-d H:i:s');
		$record_add_buy_row['trade_type_id'] = Trade_TypeModel::SHOPPING;
		$record_add_buy_row['user_type']     = 2;	//付款方
		$record_add_buy_row['record_status'] = RecordStatusModel::IN_HAND;

		$Consume_RecordModel->addRecord($record_add_buy_row);


		$record_add_seller_row                  = array();
		$record_add_seller_row['order_id']      = $order_id;
		$record_add_seller_row['user_id']       = $seller_id;
		$record_add_seller_row['user_nickname'] = $seller_name;
		$record_add_seller_row['record_money']  = $order_payment_amount;
		$record_add_seller_row['record_date']   = date('Y-m-d');
		$record_add_seller_row['record_year']	   = date('Y');
		$record_add_seller_row['record_month']	= date('m');
		$record_add_seller_row['record_day']		=date('d');
		$record_add_seller_row['record_title']  = '购物';
		$record_add_seller_row['record_time']   = date('Y-m-d H:i:s');
		$record_add_seller_row['trade_type_id'] = Trade_TypeModel::SHOPPING;
		$record_add_seller_row['user_type']     = 1;	//收款方
		$record_add_seller_row['record_status'] = 1;

		$Consume_RecordModel->addRecord($record_add_seller_row);



		if ($flag)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}

		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);

	}

	//交易明细(待修改)
	public function getConsumeRecord()
	{
		$page   = request_int('page', 1);
		$rows   = request_int('rows', 20);
		$type   = request_string('type');   //交易分类  1收款方  2付款方
		$status = request_string('status'); //交易状态 1未付款 2等待发货 3未确认发货 4成功 5失败

		$user_id = Perm::$userId;
		$user_id = $user_id ? $user_id : request_int('user_id');
		//$user_id = 10001;
		$Consume_RecordModel = new Consume_RecordModel();
		$row                 = $Consume_RecordModel->getRecordList($user_id, $type, $status, $page, $rows);

		$this->data->addBody(-140, $row);
	}

	//提现记录   转账记录(1)
	public function getConsumeRecordByType()
	{
		$page = request_int('page', 1);
		$rows = request_int('rows', 20);
		$user_id = Perm::$userId;
		//$user_id = 1;
		//const SHOPPING = 1;  //购物
		//const TRANSFER = 2;  //转账
		//const DEPOSIT  = 3; //充值
		//const WITHDRAW = 4;  //提现
		//const RECEIPT  = 5;  //收款
		//const PAY		= 6;   //付款
		$type = request_string('type');

		$Consume_RecordModel = new Consume_RecordModel();
		$row                 = $Consume_RecordModel->getRecordListByType($user_id, $type, $page, $rows);
		fb($row);
		$this->data->addBody(-140, $row);
	}

	//获取用户资源信息
	public function getUserResourceInfo()
	{
		$user_id = Perm::$userId;
		//$user_id = $user_id ? $user_id : request_int('user_id');

		$User_ResourceModel = new User_ResourceModel();

		$data = $User_ResourceModel->getOne($user_id);

		if ($data)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}


		$this->data->addBody(-140, $data, $msg, $status);

	}
	//获取用户基础信息
	public function getUserBase()
	{
		//$user_id = Perm::$userId;
		$cond_row['user_nickname'] = request_string("user_name");
		$data = $this->User_InfoModel->getOneByWhere($cond_row);

		if ($data)
		{
			$data['user_realname_mask'] = mb_substr($data['user_realname'],0,1,'utf-8').'***'.mb_substr($data['user_realname'],-1,1,'utf-8');
			$data['user_mobile_mask'] = substr($data['user_mobile'],0,3).'***'.substr($data['user_mobile'],-3,3);
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}


		$this->data->addBody(-140, $data, $msg, $status);

	}
	//获取用户信息（1）
	public function getUserInfo()
	{
		$user_id = Perm::$userId;
		//$user_id = 1;

		$User_InfoModel = new User_InfoModel();
        $User_BaseModel = new User_BaseModel();
        $base = current($User_BaseModel->getBase($user_id));
		$data['user_info'] = $User_InfoModel->getUserInfo($user_id);
		$data['user_info']['user_pay_passwd'] = $base['user_pay_passwd'];
        $data['user_info']['user_account'] = $base['user_account'];
		if ($data)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}


		$this->data->addBody(-140, $data, $msg, $status);

	}

	//修改用户信息(1)
	public function editUserInfo()
	{
		$user_id = Perm::$userId;
		//$user_id = 1;

		$user_info_row = array();
		//真实姓名
		$user_realname = request_string('user_realname');
		if ($user_realname)
		{
			$user_info_row['user_realname'] = $user_realname;
		}

		//用户昵称
		$user_nickname = request_string('user_nickname');
		if ($user_nickname)
		{
			$user_info_row['user_nickname'] = $user_nickname;
		}

		//手机号码
		$user_mobile = request_int('uer_mobile');
		if ($user_mobile)
		{
			$user_info_row['user_mobile'] = $user_mobile;
		}

		//用户邮箱
		$user_email = request_string('user_email');
		if ($user_email)
		{
			$user_info_row['user_email'] = $user_email;
		}


		$User_InfoModel = new User_InfoModel();

		$data = $User_InfoModel->editInfo($user_id, $user_info_row);

		if ($data)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}

		$this->data->addBody(-140, $user_info_row, $msg, $status);

	}

	//修改添加用户支付密码(1)
	public function  editUserPayPassword()
	{
		$user_id        = Perm::$userId;
        $User_BaseModel = new User_BaseModel();
        $User_InfoModel = new User_InfoModel();
        $user_info      = $User_InfoModel->getUserInfo($user_id);
		$user_base_row  = array();
        $set_password   = request_string('set_password');
        $old_password   = request_string('old_password');
        $type           = request_string('type');
        $yzm            = request_string('yzm');

        if($type == 'add')
        {
            if(!VerifyCode::checkCode($user_info['user_mobile'], $yzm))
            {
                $msg    = _('验证码错误');
                $status = 240;
            }
            else
            {
                $user_base_row['user_pay_passwd'] = md5($set_password);
                $flag                             = $User_BaseModel->editBase($user_id, $user_base_row);
            }
        }
        else if($type == 'edit')
        {
            $user_base    = current($User_BaseModel->getBase($user_id));

            if(!VerifyCode::checkCode($user_info['user_mobile'], $yzm))
            {
                $msg    = _('验证码错误');
                $status = 240;
            }
            else
            {
                if (md5($old_password) == $user_base['user_pay_passwd'])
                {
                    $user_base_row['user_pay_passwd'] = md5($set_password);
                    $flag                             = $User_BaseModel->editBase($user_id, $user_base_row);
                }
                else
                {
                    $flag = false;
                }
            }
        }
        else
        {
            $user_base      = current($User_BaseModel->getBase($user_id));
            if (md5($old_password) == $user_base['user_pay_passwd'])
            {
                $user_base_row['user_pay_passwd'] = md5($set_password);
                $flag                             = $User_BaseModel->editBase($user_id, $user_base_row);
            }
            else
            {
                $flag = false;
            }
        }

        if ($flag)
        {
            $msg    = 'success';
            $status = 200;
        }
        else
        {
            $msg    = 'failure';
            $status = 250;
        }

		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);
	}

	//提交提现申请(1)
	public function addWithdraw()
	{
		$user_id = Perm::$userId;
		//$user_name = Perm::$userName;
		//获取用户信息

		$edit['pay_uid'] = $user_id;

		/*$edit['bank_user'] = request_string('bank_name');//开户人姓名
		$edit['cardno'] = request_string('cardno');//银行卡号
		$edit['bank'] = request_string('bank');//银行*/

		$card_id = request_string('card_id');
        if($card_id)
        {
            $user_cardModel = new User_CardModel();
            $user_card = $user_cardModel->getOneUserCardByWhere(array('card_id'=>$card_id));

            $edit['bank_user'] = $user_card['bank_account_name'];
            $edit['cardno'] = $user_card['bank_account_number'];
            $edit['bank'] = $user_card['bank']['bank_name'];
        }
        else
        {
            $key      = YLB_Registry::get('paycenter_api_key');
            $url         = YLB_Registry::get('shop_api_url');
            $paycenter_app_id = YLB_Registry::get('paycenter_app_id');
            $formvars = array();
            $formvars['app_id']					= $paycenter_app_id;
            $formvars['from_app_id'] = YLB_Registry::get('shop_app_id');
            $formvars['user_id']					= Perm::$userId;
            $rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_User_Base&met=getUserShop&typ=json',$url), $formvars);
            //200 是卖家
            if($rs['status'] == 200)
            {
                $shop_company = $rs['data']['shop_company'];

                $edit['bank_user'] = $shop_company['bank_account_name'];
                $edit['cardno'] = $shop_company['bank_account_number'];
                $edit['bank'] = $shop_company['bank']['bank_name'];


                $edit['bank_user']=$shop_company['bank_account_name'];
                $edit['legal_person']=$shop_company['legal_person'];
                $edit['cardno']= $shop_company['bank_account_number'];
                $edit['bank']=$shop_company['bank_name'];
                $edit['bank_code']=$shop_company['bank_code'];


            }
            else
            {
                $msg    = _('failure');
                $status = 270;   //不是商家
            }
        }

		$edit['amount'] = request_string('withdraw_money');//提现金额
		$edit['con'] = request_string('con');//提款说明
		$edit['service_fee_id'] = request_int('id');  //到账时间 1-2小时内到账  2-次日24点 3-次日48点

		$paypasswd = request_string('paypasswd');  //支付密码

		//获取用户信息
		$user_base      = current($this->User_BaseModel->getBase($user_id));

		$user_resource      = current($this->User_ResourceModel->getResource($user_id));
		//$mobile = request_string('mobile');  //手机
		$yzm = request_string('yzm');  //验证码

        $user_info = $this->User_InfoModel->getOne($user_id);
        $mobile = $user_info['user_mobile'];
        if (!$mobile || !YLB_Utils_String::isMobile($mobile))
        {
            $this->data->setError('手机号错误');
            return false;
        }

		if (!VerifyCode::checkCode($mobile,$yzm))
		{
			$msg    = _('failure');
			$status = 260;   //验证码错误
			$data = array();
		}
		else
		{
			if ($user_base['user_pay_passwd'] != MD5($paypasswd))
			{
				$flag = false;
				$res  = '支付密码错误';
				$status = 230;
			}
			else
			{
				$Service_FeeModel = new Service_FeeModel();
				$fee              = current($Service_FeeModel->getFeeById($edit['service_fee_id']));
				
				$amount = $edit['amount'];//提现金额

				$num   = 0; 
				$price = $amount * ($fee['fee_rates']*1);//手续费

				if ($price > 0)
				{
					if ($price <= $fee['fee_min']*1)
					{
						$num = $fee['fee_min']*1;
					}
					elseif ($price >= $fee['fee_max']*1)
					{
						$num = $fee['fee_max']*1;
					}
					else
					{
						$num = $price;
					}
				}
				
				
				
				if ($amount + $num <= $user_resource['user_money'])
				{
					$m = $amount + $num ;

					//减少费用
					$resource_edit_row['user_money']        = $user_resource['user_money'] - $m;
					$resource_edit_row['user_money_frozen'] = $user_resource['user_money_frozen'] + $m;
					$this->User_ResourceModel->editResource($user_id, $resource_edit_row);


					//插入交易明细表
					$flow_id    = date("Ymdhis") . rand(0, 9);
					$add_time   = date('Y-m-d h:i:s',time());
					$record_row = array(
						'order_id' => $flow_id,
						'user_id' => $user_id,
						//'user_nickname'=>$user_name,
						'record_money' => -$m,
						'record_date' => date("Y-m-d"),
						'record_year' => date("Y"),
						'record_month' => date("m"),
						'record_day' => date("d"),
						'record_title' => _('提现'),
						'record_time' => date('Y-m-d h:i:s'),
						'trade_type_id' => '4',
						'user_type' => '2',
					);
					$record_id  = $this->Consume_RecordModel->addRecord($record_row, true);

					//插入提现申请表
					$widthdraw_row = array(
						'pay_uid' => $user_id,
						'orderid' => $flow_id,
						'amount' => $amount,
						'add_time' => $add_time,
						'con' => $edit['con'],
						'bank' => $edit['bank'],
						'cardno' => $edit['cardno'],
						'cardname' => $edit['bank_user'],
						'supportTime' => $edit['service_fee_id'],
						'fee' => $num,
                        'legal_person'=>$edit['legal_person'],
                        'bank_code'=>$edit['bank_code'],
					);
					$flag          = $this->Consume_WithdrawModel->addWithdraw($widthdraw_row);

				}
				else
				{
					$flag = false;
					$res  = '余款不足';
					$status = 240;
				}
			}

			if ($flag)
			{
			    //是验证码过期
                VerifyCode::removeCode($mobile);
				$msg    = 'success';
				$status = 200;
				$data   = $widthdraw_row;
			}
			else
			{
				$msg    = 'failure';
				$status = 250;
				$data[] = $res;
			}
		}
		$this->data->addBody(-140, $data, $msg, $status);

	}

	//支付宝微信提现申请
    public function addMoveWithdraw()
    {
        $user_id = Perm::$userId;


        $edit['pay_uid'] = $user_id;



        $user_alipay = request_string('user_alipay');
        $user_wechat = request_string('user_wechat');
        if($user_alipay)
        {
            $info = new User_InfoModel();
            $user_info = $info->getUserInfo($user_id);
            $edit['user_alipay'] = $user_info['user_alipay'];
            $edit['bank_user'] = $user_info['user_alipay'];
            $edit['cardno'] = $user_info['user_alipay'];
            $edit['bank'] = '支付宝';
        }
        else
        {
            $info = new User_InfoModel();
            $user_info = $info->getUserInfo($user_id);
            $edit['user_wechat'] = $user_info['user_wechat'];
            $edit['bank_user'] = $user_info['user_wechat'];
            $edit['cardno'] = $user_info['user_wechat'];
            $edit['bank'] = '微信';
        }



        $edit['amount'] = request_string('withdraw_money');//提现金额
        $edit['con'] = request_string('con');//提款说明

        $edit['service_fee_id'] = request_int('id');  //到账时间 1-2小时内到账  2-次日24点 3-次日48点

        $paypasswd = request_string('paypasswd');  //支付密码

        //获取用户信息
        $user_base      = current($this->User_BaseModel->getBase($user_id));
        fb($user_base);

        $user_resource      = current($this->User_ResourceModel->getResource($user_id));
        fb($user_resource);
        $mobile = request_string('mobile');  //手机
        $yzm = request_string('yzm');  //验证码
        $val  = request_string('val');

        if (!$val)
        {
            $msg    = _('failure');
            $status = 260;   //验证码错误
            $data = array();
        }
        else
        {
            if ($user_base['user_pay_passwd'] != MD5($paypasswd))
            {
                $flag = false;
                $res  = '支付密码错误';
                $status = 230;
            }
            else
            {
                $Service_FeeModel = new Service_FeeModel();
                $fee              = current($Service_FeeModel->getFeeById($edit['service_fee_id']));

                $amount = $edit['amount'];//提现金额

                $num   = 0;
                $price = $amount * ($fee['fee_rates']*1);//手续费

                if ($price > 0)
                {
                    if ($price <= $fee['fee_min']*1)
                    {
                        $num = $fee['fee_min']*1;
                    }
                    elseif ($price >= $fee['fee_max']*1)
                    {
                        $num = $fee['fee_max']*1;
                    }
                    else
                    {
                        $num = $price;
                    }
                }



                if ($amount + $num <= $user_resource['user_money'])
                {
                    $m = $amount + $num ;

                    //减少费用
                    $resource_edit_row['user_money']        = $user_resource['user_money'] - $m;
                    $resource_edit_row['user_money_frozen'] = $user_resource['user_money_frozen'] + $m;
                    $this->User_ResourceModel->editResource($user_id, $resource_edit_row);


                    //插入交易明细表
                    $flow_id    = date("Ymdhis") . rand(0, 9);
                    $add_time   = date('Y-m-d h:i:s',time());
                    $record_row = array(
                        'order_id' => $flow_id,
                        'user_id' => $user_id,
                        //'user_nickname'=>$user_name,
                        'record_money' => -$m,
                        'record_date' => date("Y-m-d"),
                        'record_year' => date("Y"),
                        'record_month' => date("m"),
                        'record_day' => date("d"),
                        'record_title' => _('提现'),
                        'record_time' => date('Y-m-d h:i:s'),
                        'trade_type_id' => '4',
                        'user_type' => '2',
                    );
                    $record_id  = $this->Consume_RecordModel->addRecord($record_row, true);

                    //插入提现申请表
                    $widthdraw_row = array(
                        'pay_uid' => $user_id,
                        'orderid' => $flow_id,
                        'amount' => $amount,
                        'add_time' => $add_time,
                        'con' => $edit['con'],
                        'bank' => $edit['bank'],
                        'cardno' => $edit['cardno'],
                        'cardname' => $edit['bank_user'],
                        'supportTime' => $edit['service_fee_id'],
                        'fee' => $num,
                        'legal_person'=>$edit['legal_person'],
                        'bank_code'=>$edit['bank_code'],
                    );
                    $flag          = $this->Consume_WithdrawModel->addWithdraw($widthdraw_row);

                }
                else
                {
                    $flag = false;
                    $res  = '余款不足';
                    $status = 240;
                }
            }

            if ($flag)
            {
                $msg    = 'success';
                $status = 200;
                $data   = $widthdraw_row;
            }
            else
            {
                $msg    = 'failure';
                $status = 250;
                $data[] = $res;
            }
        }
        $this->data->addBody(-140, $data, $msg, $status);

    }

	//转账(1)
	public function addTransfer()
	{
		$user_id = Perm::$userId;

		//$user_name = Perm::$userName;
		$date = array();

		$requirer  = request_string('user_nickname');  //收款人
		$amount    = request_int('record_money');        //付款金额
		$reason    = request_string('record_desc', '转账');  //付款说明
		$paypasswd = request_string('password');  //支付密码
		$mobile = request_string('mobile');  //支付密码
		$yzm = request_string('yzm');  //支付密码
		
		if (!VerifyCode::checkCode($mobile, $yzm))
		{
			$msg    = _('failure');
			$status = 260;   //验证码错误
		}
		else
		{
			//确认支付密码
			$user_base      = current($this->User_BaseModel->getBase($user_id));

			$user_resource      = current($this->User_ResourceModel->getResource($user_id));

			if ($user_base['user_pay_passwd'] != MD5($paypasswd))
			{
				$flag   = false;
				$date[] = '支付密码错误';
				$status = 230;
				
			}
			else
			{
				if ($requirer && is_numeric($amount))
				{
					if ($amount <= $user_resource['user_money'])
					{
						//获取收款人的支付id
						$requirer_id = current($this->User_BaseModel->getBaseIdByAccount($requirer));
						if ($requirer_id)
						{
							$requirer_resource = current($this->User_ResourceModel->getResource($requirer_id));

							$time    = time();
							$flow_id = time();

							//插入付款方的交易记录
							$record_row1 = array(
								'order_id' => $flow_id,
								'user_id' => $user_id,
								'record_money' => -$amount,
								'record_date' => date("Y-m-d"),
								'record_year' => date("Y"),
								'record_month' => date("m"),
								'record_day' => date("d"),
								'record_title' => $reason,
								'record_time' => date('Y-m-d h:i:s'),
								'trade_type_id' => '2',
								'user_type' => '2',
								'record_status' => '2',
							);
							$this->Consume_RecordModel->addRecord($record_row1, true);

							//插入收款方的交易记录
							$record_row2 = array(
								'order_id' => $flow_id,
								'user_id' => $requirer_id,
								'record_money' => $amount,
								'record_date' => date("Y-m-d"),
								'record_year' => date("Y"),
								'record_month' => date("m"),
								'record_day' => date("d"),
								'record_title' => $reason,
								'record_time' => date('Y-m-d h:i:s'),
								'trade_type_id' => '2',
								'user_type' => '1',
								'record_status' => '2',
							);
							$this->Consume_RecordModel->addRecord($record_row2, true);

							//修改付款方的金额
							$user_resource_row['user_money'] = $user_resource['user_money'] - $amount;
							$flag1  = $this->User_ResourceModel->editResource($user_id, $user_resource_row);

							if ($flag1)
							{
								//修改收款方的金额
								$requirer_resource_row['user_money'] = $requirer_resource['user_money'] + $amount;
								$flag2  = $this->User_ResourceModel->editResource($requirer_id, $requirer_resource_row);

								if ($flag2)
								{
									$msg    = 'success';
									$status = 200;
								}
								else
								{
									//返回付款方的钱
									$user_resource_row['user_money'] = $user_resource['user_money'] + $amount;
									$this->User_ResourceModel->editResource($user_id, $user_resource_row);

									$msg    = 'failure';
									$status = 250;
								}
							}
							else
							{
								$msg    = 'failure';
								$status = 250;
							}
						}
						else
						{
							$msg    = 'failure';
							$status = 240;
						}
					}
					else
					{
						$msg    = 'failure';
						$status = 210;//余额不足
					}
				}
				else
				{
					$msg    = 'failure';
					$status = 250;
				}
			}
		}
		
		$this->data->addBody(-140, $date, $msg, $status);
	}


	//退款
	public function refundTransfer()
	{
		$date = array();

		$user_id  = request_int('user_id');  //收款人
		$user_name = request_string('user_account');
		$seller_id = request_int('seller_id');		//付款人
		$seller_name = request_string('seller_account');
		$amount   = request_float('amount');        //付款金额
		$reason   = request_string('reason', '退款');  //付款说明
		$order_id = request_string('order_id');
		$goods_id = request_int('goods_id');
		$uorder_id = request_string('uorder_id');
		$payment_id = request_string('payment_id');

		//交易明细表
		$Consume_RecordModel = new Consume_RecordModel();
		//开启事务
		$Consume_RecordModel->sql->startTransactionDb();

		//用户资源表
		$User_ResourceModel = new User_ResourceModel();

		//合并支付表
		$Union_OrderModel = new Union_OrderModel();

		if ($amount < 0)
		{
			$flag   = false;
			$date[] = '退款金额错误';
		}
		else
		{
			$time    = time();
			$flow_id = time();

			//插入收款方的交易记录
			$record_add_buy_row                  = array();
			$record_add_buy_row['order_id']      = $flow_id;
			$record_add_buy_row['user_id']       = $user_id;
			$record_add_buy_row['user_nickname'] = $user_name;
			$record_add_buy_row['record_money']  = $amount;
			$record_add_buy_row['record_date']   = date('Y-m-d');
			$record_add_buy_row['record_year']	   = date('Y');
			$record_add_buy_row['record_month']	= date('m');
			$record_add_buy_row['record_day']		=date('d');
			$record_add_buy_row['record_title']  = $reason;
			$record_add_buy_row['record_desc']  = "订单号:" . $order_id . "，商品id:" . $goods_id;
			$record_add_buy_row['record_time']   = date('Y-m-d H:i:s');
			$record_add_buy_row['trade_type_id'] = Trade_TypeModel::REFUND;
			$record_add_buy_row['user_type']     = 1;	//收款方
			$record_add_buy_row['record_status'] = RecordStatusModel::RECORD_FINISH;

			$Consume_RecordModel->addRecord($record_add_buy_row);


			$record_add_seller_row                  = array();
			$record_add_seller_row['order_id']      = $flow_id;
			$record_add_seller_row['user_id']       = $seller_id;
			$record_add_seller_row['user_nickname'] = $seller_name;
			$record_add_seller_row['record_money']  = $amount;
			$record_add_seller_row['record_date']   = date('Y-m-d');
			$record_add_seller_row['record_year']	   = date('Y');
			$record_add_seller_row['record_month']	= date('m');
			$record_add_seller_row['record_day']		=date('d');
			$record_add_seller_row['record_title']  = $reason;
			$record_add_seller_row['record_desc']  = "订单号:" . $order_id . "，商品id:" . $goods_id;
			$record_add_seller_row['record_time']   = date('Y-m-d H:i:s');
			$record_add_seller_row['trade_type_id'] = Trade_TypeModel::REFUND;
			$record_add_seller_row['user_type']     = 2;	//付款方
			$record_add_seller_row['record_status'] = RecordStatusModel::RECORD_FINISH;

			$Consume_RecordModel->addRecord($record_add_seller_row);

            if($payment_id == 1){
                //查找合并单中的付款情况，购物卡优先退款
                $uorder_base = $Union_OrderModel->getOne($uorder_id);

                $card_return_amount = 0;

                //使用购物卡支付并且购物卡的退款金额小于支付金额时
                if(($uorder_base['union_cards_pay_amount'] > 0) && ($uorder_base['union_cards_return_amount'] < $uorder_base['union_cards_pay_amount']))
                {
                    $card_can_return_amount = $uorder_base['union_cards_pay_amount'] - $uorder_base['union_cards_return_amount'];
                    //购物卡中可退款金额小于退款金额
                    if($card_can_return_amount <= $amount)
                    {
                        $card_return_amount = $card_can_return_amount;
                    }else
                    {
                        $card_return_amount = $amount;
                    }

                    $amount = $amount - $card_return_amount;
                }

                //扣除购物卡的退款之后全部退还到账户余额中
                $edit_union_row = array();
                $edit_union_row['union_cards_return_amount'] = $card_return_amount;
                $edit_union_row['union_money_return_amount'] = $amount;
                $flag1 = $Union_OrderModel->editUnionOrder($uorder_id,$edit_union_row,true);
            }else{
                $flag1 = true;
            }


			$user_resource = current($User_ResourceModel->getResource($user_id));

			if ($flag1)
			{
				//修改收款方的金额
				$user_resource_row['user_recharge_card'] = $user_resource['user_recharge_card'] + $card_return_amount;
				$user_resource_row['user_money'] = $user_resource['user_money'] + $amount;
				$flag                            = $User_ResourceModel->editResource($user_id, $user_resource_row);
			}
			else
			{
				$flag = false;
			}

		}

		if ($flag && $Consume_RecordModel->sql->commitDb())
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$Consume_RecordModel->sql->rollBackDb();
			$m      = $Consume_RecordModel->msg->getMessages();
			$msg    = $m ? $m[0] : 'failure';
			$status = 250;
		}
		$this->data->addBody(-140, $date, $msg, $status);
	}

	//获取订单信息（1）
	public function getOrderInfo()
	{
		$order_id = request_string('order_id');

		$Consume_TradeModel = new Consume_TradeModel();
		$date               = $Consume_TradeModel->getConsumeTradeByOid($order_id);

		if ($date)
		{
			$msg    = 'success';
			$status = 250;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}
		$this->data->addBody(-140, $date, $msg, $status);

	}

	//提现详情(1)
	public function getWithdrawInfo()
	{
		$order_id = request_string('order_id');

		$Consume_RecordModel   = new Consume_RecordModel();
		$Consume_WithdrawModel = new Consume_WithdrawModel();

		$record_row = current($Consume_RecordModel->getRecordByOid($order_id));

		$widthraw_row = current($Consume_WithdrawModel->getWithdrawByOid($order_id));

		$data['record']   = $record_row;
		$data['widthraw'] = $widthraw_row;

		if ($data)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}
		$this->data->addBody(-140, $data, $msg, $status);

	}

	/*==========================================================================================================*/
	//获取提现记录
	public function getWidthrawList()
	{
		$skey           = $_REQUEST['skey'];
		$user_account   = request_string('user_account');
		$page           = request_string('page', 1);
		$rows           = request_string('rows', 20);
		$User_BaseModel = new User_BaseModel();
		$User_InfoModel = new User_InfoModel();
		$user_id        = '';

		if ($user_account)
		{
			$user_id = $User_BaseModel->getBaseIdByAccount($user_account);
		}

		$Consume_WithdrawModel = new Consume_WithdrawModel();
		if ($skey)
		{
			$Consume_WithdrawModel->sql->setWhere('pay_uid', '%' . $skey . '%', 'LIKE');
		}
		$data = $Consume_WithdrawModel->getWithdrawListByPid($user_id, $page, $rows);
		
		foreach ($data['items'] as $key => $val)
		{
			$user_info                        = $User_InfoModel->getUserInfo($val['pay_uid']);
			$data['items'][$key]['user_info'] = current($user_info);
		}
		
		if ($data)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}
		fb($data);
		$this->data->addBody(-140, $data, $msg, $status);

	}

	public function editWith()
	{
		$id                    = $_REQUEST['id'];
		$Consume_WithdrawModel = new Consume_WithdrawModel();
		$data                  = $Consume_WithdrawModel->getWithdraw($id);
		//fb($data);

		$this->data->addBody(-140, $data);
	}

	public function getWith()
	{

		$Consume_WithdrawModel = new Consume_WithdrawModel();
		$datas                 = $Consume_WithdrawModel->get("*");
		foreach ($datas as $k => $v)
		{
			$data[$k]['is_succeed'] = $v['is_succeed'];
		}
		fb($data);
		$this->data->addBody(-140, $data);
	}

	public function edit()
	{
		$id                 = $_REQUEST['id'];
		$data['is_succeed'] = $_REQUEST['is_succeed'];
		$data['con']        = $_REQUEST['con'];

		$Consume_WithdrawModel = new Consume_WithdrawModel();

		$flag = $Consume_WithdrawModel->editWithdraw($id, $data);
		fb($flag);
		if ($flag)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}
		$this->data->addBody(-140, $data, $msg, $status);
	}


	//获取支付卡列表
	public function getCardBaseList()
	{
		$cardname  = request_string('cardName');   //卡片名称
		$beginDate = request_string('beginDate');
		$endDate   = request_string('endDate');
		$appid     = request_int('appid');

		$page = request_string('page', 1);
		$rows = request_string('rows', 20);

		$Card_BaseModel = new Card_BaseModel();
		$data           = $Card_BaseModel->getBaseList($cardname, $appid, $beginDate, $endDate, $page, $rows);


		$Card_InfoModel = new Card_InfoModel();
		foreach ($data['items'] as $key => $val)
		{
			$card_used_num                        = $Card_InfoModel->getCardusednumBy($val['card_id']);
			$data['items'][$key]['card_used_num'] = $card_used_num;

			$card_new_num                        = $Card_InfoModel->getCardnewnumBy($val['card_id']);
			$data['items'][$key]['card_new_num'] = $card_new_num;
		}

		if ($data)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}
		fb($data);
		$this->data->addBody(-140, $data, $msg, $status);
	}

	//获取支付卡基本信息
	public function getCardBase()
	{
		$id = request_int('id');

		$Card_BaseModel = new Card_BaseModel();
		$data           = $Card_BaseModel->getBaseById($id);

		$Card_InfoModel        = new Card_InfoModel();
		$card_used_num         = $Card_InfoModel->getCardusednumBy($id);
		$data['card_used_num'] = $card_used_num;

		$card_new_num         = $Card_InfoModel->getCardnewnumBy($id);
		$data['card_new_num'] = $card_new_num;

		if ($data)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}
		fb($data);
		$this->data->addBody(-140, $data, $msg, $status);
	}

	//修改支付卡信息
	public function editCardBase()
	{
		$id         = request_int('id');  //卡号
		$card_name  = request_string('card_name'); //卡名称
		$card_num   = request_int('card_num');  //数量
		$source     = request_int('source');   //适用平台
		$start_time = request_string('start_time');   //开始时间
		$end_time   = request_string('end_time');    //结束时间
		$card_desc  = request_string('card_desc');
		$card_image = request_string('card_image');
		$money      = request_int('money');    //金额
		$point      = request_int('point');    //金蛋

		//获取充值卡信息
		$Card_BaseModel = new Card_BaseModel();
		$card_base_row  = current($Card_BaseModel->getBase($id));

		$flag = true;


		//判断充值卡数量是否改变
		$diff_num = $card_num - $card_base_row['card_num'];

		$Card_InfoModel = new Card_InfoModel();
		if ($diff_num > 0)
		{
			//查找最后一张充值卡
			$last_card_code = $Card_InfoModel->getListCardcodeByCid($id);

			for ($i = 1; $i <= $diff_num; $i++)
			{
				$filed = array(
					'card_code' => $last_card_code + $i,
					'card_password' => rand(100000, 999999),
					'card_id' => $id,
					'card_fetch_time' => date('Y-m-d H:i:s'),
				);
				$Card_InfoModel->addInfo($filed);
			}
		}
		elseif ($diff_num < 0)
		{
			$num = abs($diff_num);
			//删除充值卡
			$Card_InfoModel->delCardByCid($id, $num);
		}

		$prize = array();
		if ($money)
		{
			$prize['m'] = $money;
		}
		if ($point)
		{
			$prize['p'] = $point;
		}

		$card_prize = json_encode($prize);
		fb($card_prize);
		$filed_array = array(
			'card_name' => $card_name,
			'card_num' => $card_num,
			'app_id' => $source,
			'card_prize' => $card_prize,
			'card_start_time' => $start_time,
			'card_end_time' => $end_time,
			'card_desc' => $card_desc,
			'card_image' => $card_image,
		);

		$flag = $Card_BaseModel->editBase($id, $filed_array);

		if ($flag === false)
		{
			$msg    = 'failure';
			$status = 250;
		}
		else
		{
			$msg    = 'success';
			$status = 200;
		}
		fb($filed_array);
		$this->data->addBody(-140, $filed_array, $msg, $status);


	}

	//添加支付卡信息
	public function addCardBase()
	{
		$card_id    = request_int('id');
		$source     = request_int('source');
		$card_name  = request_string('card_name');
		$money      = request_string('money');
		$point      = request_string('point');
		$card_desc  = request_string('card_desc');
		$card_image = request_string('card_image');
		$card_num   = request_int('card_num');
		$start_time = request_string('start_time');
		$end_time   = request_string('end_time');

		$Card_BaseModel = new Card_BaseModel();
		$Card_InfoModel = new Card_InfoModel();

		$card_data = $Card_BaseModel->getBase($card_id);
		if ($card_data)
		{
			$flag = false;
			$msg  = '此卡号已存在，请重新填写';
		}
		else
		{
			for ($i = 1; $i <= $card_num; $i++)
			{
				$add_row = array();
				$add_row = array(
					'card_code' => $card_id . str_pad($i, 4, "0", STR_PAD_LEFT),
					'card_password' => rand(100000, 999999),
					'card_id' => $card_id,
					'card_time' => date("Y-m-d H:i:s"),
				);
				$Card_InfoModel->addInfo($add_row);
			}

			$prize = array();
			if ($money)
			{
				$prize['m'] = $money;
			}
			if ($point)
			{
				$prize['p'] = $point;
			}

			$card_prize = json_encode($prize);

			$card_add_array = array(
				'card_id' => $card_id,
				'card_name' => $card_name,
				'card_num' => $card_num,
				'app_id' => $source,
				'card_prize' => $card_prize,
				'card_start_time' => $start_time,
				'card_end_time' => $end_time,
				'card_desc' => $card_desc,
				'card_image' => $card_image,
			);

			$flag = $Card_BaseModel->addBase($card_add_array);
			
			if ($flag)
			{
				$msg    = 'success';
				$status = 200;
			}
			else
			{
				$msg    = 'failure';
				$status = 250;
			}
		}
		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);

	}

	//删除支付卡（只可删除还未使用的支付卡）
	public function delCardBase()
	{
		$card_id = request_int('id');

		$Card_InfoModel = new Card_InfoModel();
		$Card_BaseModel = new Card_BaseModel();
		$used_num       = $Card_InfoModel->getCardusednumBy($card_id);
		if ($used_num)
		{
			$flag = false;
		}
		else
		{
			//删除充值卡card_info
			$Card_InfoModel->delCardByCid($card_id);

			$flag = $Card_BaseModel->removeBase($card_id);
		}

		if ($flag)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}
		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);
	}

	//根据card_id获取支付卡(card_info)列表
	public function getCardInfoList()
	{
		$card_id = request_int('card_id');
		$page    = request_int('page', 1);
		$rows    = request_int('rows', 20);

		$Card_InfoModel = new Card_InfoModel();
		$card_info      = $Card_InfoModel->getInfoList($card_id, $page, $rows);
		fb($card_info);
		$this->data->addBody(-140, $card_info);
	}

	//根据card_code获取支付卡信息
	public function getCardInfo()
	{
		$card_code = request_int('card_code');

		$Card_InfoModel = new Card_InfoModel();
		$data           = $Card_InfoModel->getInfo($card_code);
		fb($data);
		$this->data->addBody(-140, $data);
	}

	public function  payfinish()
	{
		$order_id = request_string('order_id');

		$Consume_DepositModel = new Consume_DepositModel();
		$data                 = $Consume_DepositModel->notifyShop($order_id);

		$this->data->addBody(-140, $data);
	}

	//解除绑定,生成验证码,并且发送验证码
	public function getYzm()
	{
		$type = request_string('type');
		$val  = request_string('val');
		$code = request_string('code','getcode');

		if ($type == 'mobile')
		{
            $user_info = $this->User_InfoModel->getOne(Perm::$userId);
            if ($user_info && $user_info['user_mobile'])
            {
                $code = VerifyCode::getCode($user_info['user_mobile']);
                $me   = '【淘尚168商城】您的验证码是'.$code;
                $str  = Sms::send($user_info['user_mobile'], $me);
            }
		}
		else
		{
            $cond_row['code'] = $code;
            $de    = $this->messageTemplateModel->getTemplateDetail($cond_row);
            $me    = $de['content_email'];
			$title = $de['title'];

			$code_key = $val;
			$VerifyCode = new VerifyCode();
			$code     = $VerifyCode->getCode($code_key);
			$me       = str_replace("[weburl_name]", Web_ConfigModel::value("site_name"), $me);
			$me       = str_replace("[yzm]", $code, $me);
			$title    = str_replace("[weburl_name]", Web_ConfigModel::value("site_name"), $title);
			$Email = new Email();
			$str = $Email->send_mail($val, Perm::$row['user_account'], $title, $me);
		}
		$status = 200;
		$data   = array();
		$msg    = "success";
		$this->data->addBody(-140, $data, $msg, $status);

	}

	//检测解除验证码
	public function checkYzm()
	{

		$yzm  = request_string('yzm');
		$type = request_string('type');
		$val  = request_string('val');

		if (VerifyCode::checkCode($val, $yzm))
		{
			$status = 200;
			$msg    = _('success');
		}
		else
		{
			$msg    = _('failure');
			$status = 250;

		}
		$data = array();

		$this->data->addBody(-140, $data, $msg, $status);

	}

	//解除绑定
	public function editAllInfo()
	{
		$type      = request_string('type');
		$yzm       = request_string('yzm');
		$val       = request_string('val');
		$user_id   = Perm::$userId;

		$flag = false;

		if (!VerifyCode::checkCode($val, $yzm))
		{
			$msg    = _('验证码错误');
			$status = 240;
		}
		else
		{
			if ($type == 'passwd')
			{
				$password = request_string('password');

				if ($password)
				{
                    $user_info = $this->User_InfoModel->getOne($user_id);

                    if($user_info['user_identity_statu'] == 2)
                    {
                        $edit_user_row['user_pay_passwd'] = md5($password);
                        $flag = $this->User_BaseModel->editBase($user_id, $edit_user_row);
                    }
                    else
                    {
                        $msg    = _('必须先实名');
                    }
				}
				else
				{
					$msg    = _('密码不能为空');
				}
			}
			else
			{
			    //无用方法
				/*if ($type == 'mobile')
				{
					$edit_user_row['user_mobile']        = '';
					$edit_user_row['user_mobile_verify'] = 0;
				}
				else if ($type == 'email')
				{
					$edit_user_row['user_email']        = '';
					$edit_user_row['user_email_verify'] = 0;
				}
				else
				{
					$edit_user_row['user_email']        = '';
					$edit_user_row['user_email_verify'] = 0;
				}

				$de = $this->userInfoModel->getOne($user_name);
				$flag = $this->userInfoModel->editInfoDetail($user_name, $edit_user_row);*/
			}


			if ($flag === false)
			{
				$msg    = $msg?$msg:_('failure');
				$status = 250;

			}
			else
			{
				$status = 200;
				$msg    = _('success');
			}
		}
		$data = array();

		$this->data->addBody(-140, $data, $msg, $status);
	}

	//验证用户的支付密码
	public function checkPassword()
	{
		$password = request_string('password');

		$user_id = Perm::$userId;

		$User_BaseModel = new User_BaseModel();
		$user_base = $User_BaseModel->getOne($user_id);

		fb($user_base);

		if($user_base['user_pay_passwd'])
		{
			if(md5($password) != $user_base['user_pay_passwd'])
			{
				$msg    = _('支付密码错误');
				$status = 250;
			}
			else
			{
				$status = 200;
				$msg    = _('success');
			}
		}
		else
		{
			$status = 230;
			$msg    = _('请先设置支付密码');
		}

		$data = array();

		$this->data->addBody(-140, $data, $msg, $status);
	}

	public function test()
	{
		include_once LIB_PATH . '/Api/wx/WxPay.JsApiPay.php';
	}

	//分享立赚 Zhenzh
    public function share()
    {
        $user_id   = Perm::$userId;

        //获取用户资产
        $user_resource = $this->User_ResourceModel->getResource($user_id);
        $user_resource = current($user_resource);

        //今日到账分享金
        $consume_cond['user_id'] = $user_id;
        $consume_cond['trade_type_id'] = Trade_TypeModel::SHARE;
        if($this->typ != 'json')
        {
            $consume_cond['record_time:>'] = date('Y-m-d H:i:s',time());
            $consume_cond['record_time:<'] = date('Y-m-d H:i:s',strtotime('+1 day',time()));
        }

        $consume_record = $this->Consume_RecordModel -> getByWhere($consume_cond);
        $today_total = array_sum(array_column($consume_record,'record_money'));

        $user_share_price_total = ($today_total + $user_resource['user_share_money_frozen']);

        $key              = YLB_Registry::get('paycenter_api_key');
        $url              = YLB_Registry::get('shop_api_url');
        $paycenter_app_id = YLB_Registry::get('paycenter_app_id');
        $formvars                = array();
        $formvars['app_id']		 = $paycenter_app_id;
        $formvars['from_app_id'] = YLB_Registry::get('shop_app_id');
        $formvars['uid']		 = Perm::$userId;

        $YLB_Page           = new YLB_Page();
        $YLB_Page->listRows = 10;
        $rows               = $YLB_Page->listRows;
        $offset             = request_int('firstRow', 0);
        $page               = ceil_r($offset / $rows);
        $formvars['page']   = $page;
        $formvars['rows']   = $rows;

        $time = request_string('time');
        if($time)
        {
            $formvars['time'] = request_string('time');
        }
        else
        {
            $start_date = request_string('start_date');
            $end_date = request_string('end_date');
            if ($start_date)
            {
                $formvars['start_date'] = $start_date;
            }
            if ($end_date)
            {
                $formvars['end_date'] = $end_date;
            }
        }
        if(request_string('type') == 'goods')
        {
            $formvars['type'] = 'goods';
        }

        if(request_string('p'))
        {
            $formvars['p'] = request_string('p');
        }

        $rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_Share_Share&met=getShare&typ=json',$url), $formvars);

        if($rs['status'] == 200)
        {
            $data = $rs['data'];
            if(!$data['save_total_money'])
            {
                $data['save_total_money'] = 0;
            }
            $data['user_resource'] = $user_resource;
            $data['user_share_price_total'] = $user_share_price_total;
            $data['today_total'] = $today_total;
            $YLB_Page->totalRows = $data['totalsize'];
            $page_nav           = $YLB_Page->prompt();

            if ('json' == $this->typ)
            {
                $this->data->addBody(-140, $data);
            }
            else
            {
                include $this->view->getView();
            }
        }

    }
    public function share_bak()
    {
        //获取用户信息
        $user_id   = Perm::$userId;

        //获取用户资产
        $user_resource = $this->User_ResourceModel->getResource($user_id);
        $user_resource = current($user_resource);

        $consume_cond['user_id'] = $user_id;
        $consume_cond['trade_type_id'] = Trade_TypeModel::SHARE;
        if($this->typ != 'json')
        {
            $consume_cond['record_time:>'] = date('Y-m-d H:i:s',time());
            $consume_cond['record_time:<'] = date('Y-m-d H:i:s',strtotime('+1 day',time()));
        }

        $consume_record = $this->Consume_RecordModel -> getByWhere($consume_cond);
        $today_total = array_sum(array_column($consume_record,'record_money'));
        $user_share_price_total = ($today_total + $user_resource['user_share_money_frozen']);

        $key              = YLB_Registry::get('paycenter_api_key');
        $url              = YLB_Registry::get('shop_api_url');
        $paycenter_app_id = YLB_Registry::get('paycenter_app_id');
        $formvars = array();

        $formvars['app_id']		 = $paycenter_app_id;
        $formvars['from_app_id'] = YLB_Registry::get('shop_app_id');
        $formvars['uid']		 = Perm::$userId;

        $YLB_Page           = new YLB_Page();
        $YLB_Page->listRows = 10;
        $rows               = $YLB_Page->listRows;
        $offset             = request_int('firstRow', 0);
        $page               = ceil_r($offset / $rows);
        $formvars['page']   = $page;
        $formvars['rows']   = $rows;

        if(request_string('time'))
        {
            $formvars['time'] = request_string('time');
        }

        $rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_Share_Share&met=getshare&typ=json',$url), $formvars);

        if($rs['status'] == 200)
        {
            $data = $rs['data'];
            $data['user_resource'] = $user_resource;
            $data['user_share_price_total'] = $user_share_price_total;
            $data['today_total'] = $today_total;
            $YLB_Page->totalRows = $data['totalsize'];
            $page_nav           = $YLB_Page->prompt();

            if ('json' == $this->typ)
            {
                $this->data->addBody(-140, $data);
            }
            else
            {
                include $this->view->getView();
            }
        }

    }

    //绑定提现账户列表 Zhenzh
    public function bundingUserCard()
    {
        $data = array();
        //获取用户信息
        $user_id   = Perm::$userId;
        $user_info = $this->User_InfoModel->getUserInfo($user_id);
        $realname  = $user_info['user_realname'];
        if($realname)
        {
            $real = 1;
        }
        else
        {
            $real = 0;
            $realname = 0;
            header("Location:" . YLB_Registry::get('url') . "?ctl=Info&met=certification");
        }
        if(!$user_info['user_mobile'])
        {
            header("Location:" . YLB_Registry::get('ucenter_api_url') . "?ctl=User&met=security&op=mobile");
        }

        $key      = YLB_Registry::get('paycenter_api_key');
        $url         = YLB_Registry::get('shop_api_url');
        $paycenter_app_id = YLB_Registry::get('paycenter_app_id');
        $formvars = array();

        $formvars['app_id']		 = $paycenter_app_id;
        $formvars['from_app_id'] = YLB_Registry::get('shop_app_id');
        $formvars['user_id']	 = Perm::$userId;

        $rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_User_Base&met=getUserShop&typ=json',$url), $formvars);

        //200 是卖家
        if($rs['status'] == 200)
        {
            $shop_company = $rs['data']['shop_company'];
            $data['shop_company'] = $shop_company;
        }
        else
        {
            $bank_baseModel = new Bank_BaseModel();
            $bank_list = $bank_baseModel->getByWhere();
            $data['bank_list'] = $bank_list;

            if($user_info['user_mobile'])
            {
                $user_info['user_mobile_hide'] = substr_replace($user_info['user_mobile'],'****',3,4);
            }

            $userCardModel = new User_CardModel();
            $card_cond_row['user_id'] = $user_id;
            $user_card = $userCardModel->getUserCardByWhere($card_cond_row);
            $data['user_card'] = $user_card;
        }

        if ('json' == $this->typ)
        {
            $this->data->addBody(-140, $data);
        }
        else
        {
            include $this->view->getView();
        }

    }

    //绑定体现提现账户（移动端）
    public function bindUserCardForApp()
    {
        $data = array();
        //获取用户信息
        $user_id = Perm::$userId;
        $User_InfoModel = new User_InfoModel();
        $user_info      = $User_InfoModel->getUserInfo($user_id);
        //传递用户数据各移动端自行判断是否实名，条件user_realname和user_mobile
        $data['user_info'] = $user_info;

        $key      = YLB_Registry::get('paycenter_api_key');
        $url         = YLB_Registry::get('shop_api_url');
        $paycenter_app_id = YLB_Registry::get('paycenter_app_id');
        $formvars = array();

        $formvars['app_id']					= $paycenter_app_id;
        $formvars['from_app_id'] = YLB_Registry::get('shop_app_id');
        $formvars['user_id']					= Perm::$userId;

        $rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_User_Base&met=getUserShop&typ=json',$url), $formvars);


        //200 是卖家
        if($rs['status'] == 200)
        {
            $shop_company = $rs['data']['shop_company'];
            $data['shop_company'] = $shop_company;
        }
        else
        {
            $bank_baseModel = new Bank_BaseModel();
            $bank_list = $bank_baseModel->getByWhere();
            $data['bank_list'] = $bank_list;

            if($user_info['user_mobile'])
            {
                $user_info['user_mobile_hide'] = substr_replace($user_info['user_mobile'],'****',3,4);
            }

            $userCardModel = new User_CardModel();
            $card_cond_row['user_id'] = $user_id;
            $user_card = $userCardModel->getUserCardByWhere($card_cond_row);
            $data['user_card'] = $user_card;
        }

        if ('json' == $this->typ)
        {
            //判断个人或公司，公司跳转
            $this->data->addBody(-140, $data);
        }
    }

    //添加账户 Zhenzh  更改时间17/6/20  更改人senyzy
    public function addUserCard()
    {
        $flag = false;
        $user_id = Perm::$userId;
        $User_InfoModel = new User_InfoModel();
        $user_info      = $User_InfoModel->getUserInfo($user_id);

        $yzm       = request_string('yzm');
        $bank_bind_phone = request_string('bank_bind_phone');

        if (!VerifyCode::checkCode($bank_bind_phone?$bank_bind_phone:$user_info['user_mobile'], $yzm))
        {
            $msg    = _('验证码错误');
            $status = 240;
        }
        else
        {
            $type = request_string('type');
            if($type == 'alipay_add' || $type == 'alipay_edit')
            {
                $user_account = request_string('user_account');
                $cond_row['user_alipay'] = $user_account;
                $flag = $User_InfoModel->editInfo($user_info['user_id'],$cond_row);
            }
            else if($type == 'wechat_add' || $type == 'wechat_edit')
            {
                $user_account = request_string('user_account');
                $cond_row['user_wechat'] = $user_account;
                $flag =$User_InfoModel->editInfo($user_info['user_id'],$cond_row);
            }
            else if($type == 'card_add')
            {
                $bank_id = request_string('bank_id');
                $bank_account_number = request_string('bank_account_number');

                $card_img = request_string('card_img');
                $userCardModel = new User_CardModel();

                $cond_row['user_id'] = $user_info['user_id'];
                $cond_row['bank_account_name'] = $user_info['user_realname'];
                $cond_row['bank_id'] = $bank_id;
                $cond_row['bank_account_number'] = $bank_account_number;
                $cond_row['bank_bind_phone'] = $bank_bind_phone;
                $cond_row['card_img'] = $card_img;
                $flag =$userCardModel->addUserCard($cond_row,true);
                $data['card_id'] = $flag;
            }
            else if($type == 'card_edit')
            {
                $bank_id = request_string('bank_id');
                $bank_account_number = request_string('bank_account_number');
                $card_id = request_string('card_id');
                $userCardModel = new User_CardModel();
                $cond_row['bank_id'] = $bank_id;
                $cond_row['bank_account_number'] = $bank_account_number;
                $flag =$userCardModel->editUserCard($card_id,$cond_row);
            }

            if ($flag === false)
            {
                $msg    = _('failure');
                $status = 250;

            }
            else
            {
                $status = 200;
                $msg    = _('success');
            }

        }

        if(!$data)
        {
            $data = array();
        }

        $this->data->addBody(-140, $data, $msg, $status);


    }

    //删除银行卡，只针对wap  addcard3页面
    public function delUserCard()
    {
        $flag = false;
        $card_id = request_string("card_id");
        $userCardModel = new User_CardModel();
        $flag = $userCardModel->delUserCard($card_id);
        if ($flag === false)
        {
            $msg    = _('failure');
            $status = 250;
        }
        else
        {
            $status = 200;
            $msg    = _('success');
        }
        $data=array();
        $this->data->addBody(-140, $data, $msg, $status);
    }

    //发送绑定账户验证码
    public function sendCardYzm()
    {
        $user_id = Perm::$userId;
        $User_InfoModel = new User_InfoModel();
        $user_info      = $User_InfoModel->getUserInfo($user_id);
        $mobile = $user_info['user_mobile'];
        $code_key = $user_info['user_mobile'];
        if($mobile && YLB_Utils_String::isMobile($mobile))
        {

            //发送短消息
            $code     = VerifyCode::getCode($code_key);
            $contents = '【淘尚168商城】您的验证码是' . $code ;
            $result = Sms::send($mobile, $contents);

            if ($result){
                $msg    = '发送成功';
                $status = 200;
            }else{

                $msg    = '短信发送失败';
                $status = 250;
            }
        }

        $status = $code;
        $data   = array($code);
        $msg    = "success";
        $this->data->addBody(-140, $data, $msg, $status);
    }

    //检测绑定账户验证码
    public function checkCardYzm()
    {
        $user_id = Perm::$userId;
        $User_InfoModel = new User_InfoModel();
        $user_info      = $User_InfoModel->getUserInfo($user_id);
        $mobile = $user_info['user_mobile'];

        $yzm  = request_string('yzm');
        $val  = $mobile;

        fb($val);
        fb($yzm);
        fb(VerifyCode::checkCode($val, $yzm));
        if (VerifyCode::checkCode($val, $yzm))
        {

            $status = 200;
            $msg    = _('success');
        }
        else
        {
            $msg    = _('failure');
            $status = 250;

        }
        $data = array();

        $this->data->addBody(-140, $data, $msg, $status);

    }

    public function getOrderState()
    {
        $data = array();
        $union_order_id = request_string('u_order_id');
        $pay_type = request_string('type');
        if($union_order_id)
        {
            $unionOrderModel = new Union_OrderModel();
            $union_order = $unionOrderModel->getOneByWhere(array('union_order_id'=>$union_order_id));
            if($union_order)
            {
                /*$union_order['state_str'] = Union_OrderModel::$order_state_array[$union_order['order_state_id']];
                $data = $union_order;*/

                if($union_order['order_state_id'] == Union_OrderModel::PAYED)
                {
                    $data[union_order_id] = $union_order['union_order_id'];
                    $data['state'] = 1;
                    $data['state_str'] = '已付款';
                    if($pay_type == 'money')
                    {
                        $data['pay_amount'] = $union_order['union_money_pay_amount'];
                    }
                    elseif($pay_type == 'online')
                    {
                        $data['pay_amount'] = $union_order['union_online_pay_amount'];
                    }
                    $status = 200;
                    $msg = 'success';
                }
                else
                {
                    $status = 250;
                    $msg = '';
                }
            }
            else
            {
                $msg = '查无此单号';
                $status = 250;
            }
        }
        else
        {
            $msg = '参数错误';
            $status = 250;
        }

        $this->data->addBody(-140,$data,$msg,$status);

    }

    //获取用户总资产
    public function getTotalMoney(){
        $user_id = Perm::$userId;
        $UserResourceModel = new User_ResourceModel();
        $user_resource = $UserResourceModel->getResource($user_id);
        $user_resource = current($user_resource);
        $data['money'] = $user_resource['user_money'] + $user_resource['user_money_frozen'] + $user_resource['user_recharge_card'] + $user_resource['user_rechange_card_frozen'] + $user_resource['user_share_money_frozen'];
        $data['tixian'] = $user_resource['user_money'];
        $this->data->addBody(-140, $data);

    }
}

?>