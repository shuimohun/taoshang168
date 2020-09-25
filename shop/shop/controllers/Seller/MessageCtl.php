<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Seller_MessageCtl extends Seller_Controller
{
	public $messageModel         = null;
	public $userMessageModel     = null;
	public $userInfoModel        = null;
	public $messageTemplateModel = null;
	public $messageSettingModel  = null;
	public $informationBaseModel     = null;
	
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
		$this->messageModel         = new MessageModel();
		$this->userMessageModel     = new User_MessageModel();
		$this->userInfoModel        = new User_InfoModel();
		$this->messageTemplateModel = new Message_TemplateModel();
		$this->messageSettingModel  = new Message_SettingModel();
		$this->informationBaseModel     = new Information_BaseModel();
		$this->shopCustomServiceModel     = new Shop_CustomServiceModel();
		$this->shopBaseModel     = new Shop_BaseModel();
	}

	/**
	 * 客服消息页面
	 *
	 * @access public
	 */
	public function index()
	{
		$shop_id = Perm::$shopId;
		$User_Base = new User_BaseModel();
        $sellerBaseModel  = new Seller_BaseModel();
		$cond_row['shop_id'] = $shop_id;

        $user_data = $sellerBaseModel->getByWhere($cond_row);
        $user_data = array_values($user_data);

        $service_data = $this->shopCustomServiceModel->getServiceList($cond_row);
        if($service_data)
        {
            $service_number = array_column($service_data['items'],'number');
            $service_number_row = $User_Base->getBase($service_number);

            foreach($service_data['items'] as $key => $val)
            {
                if(isset($service_number_row[$val['number']]))
                {
                    $val['number'] = $service_number_row[$val['number']]['user_account'];
                    if($val['type']==1)
                    {
                        $data['after'][] = $val;
                    }
                    else
                    {
                        $data['pre'][] = $val;
                    }
                }
            }
        }

		$re= $this->shopBaseModel->getOne($shop_id);
		$data['shop_workingtime'] = $re['shop_workingtime'];
		if ("json" == $this->typ)
		{
			$this->data->addBody(-140, $data);
		}
		else
		{
			include $this->view->getView();
		}
	}

	/**
	 * 客服消息保存
	 *
	 * @access public
	 */
	public function editService()
	{
		$shop_id = Perm::$shopId;
		//售前
		$prename = request_row("prename");
		$pretool = request_row("pretool");
		$prenum  = request_row("prenum");
		//售后
		$aftername        = request_row("aftername");
		$aftertool        = request_row("aftertool");
		$afternum         = request_row("afternum");
        //工作时间
		$shop_workingtime = request_string("workingtime");

		$UserBaseModel = new User_BaseModel();
        $user_row = $UserBaseModel->getByWhere(array('user_account:IN'=>array_merge($prenum,$afternum)));
        $new_user_row = array();
        foreach ($user_row as $key => $value)
        {
            $new_user_row[$value['user_account']] = $key;
        }

		$customer_service_array = array();
		if($prename && $prenum)
		{
			foreach($prename as $key => $val)
			{
				if($val && $pretool[$key] && $prenum[$key] && isset($new_user_row[$prenum[$key]]))
				{
					$customer_service = array();
					$customer_service['shop_id'] = $shop_id;
					$customer_service['name'] = $val;
					$customer_service['tool'] = intval($pretool[$key]);
					$customer_service['number'] = $new_user_row[$prenum[$key]];
					$customer_service['type'] = '0';
					$customer_service_array[] = $customer_service;
				}
			}
		}
		if($aftername && $afternum)
		{
			foreach($aftername as $key => $val)
			{
				if($val && $aftertool[$key] && $afternum[$key] && isset($new_user_row[$afternum[$key]]))
				{
					$customer_service = array();
					$customer_service['shop_id'] = $shop_id;
					$customer_service['name'] = $val;
					$customer_service['tool'] = $aftertool[$key];
					$customer_service['number'] = $new_user_row[$afternum[$key]];
					$customer_service['type'] = '1';
					$customer_service_array[] = $customer_service;
				}
			}
		}
		
		$cond_row                         = array();
		$cond_row['shop_id']              = $shop_id;

		$data = $this->shopCustomServiceModel->getServiceList($cond_row);
		
		$serviceId  = array();
		if($data['items']){
			$serviceId = array_column($data['items'], 'id');
		}
		//开启事物
		$rs_row = array();
		$this->shopCustomServiceModel->sql->startTransactionDb();
		
		if ($serviceId)
		{
			$flag = $this->shopCustomServiceModel->removeService($serviceId);
			check_rs($flag, $rs_row);
		}
		foreach($customer_service_array as $k=>$v){
			$aflag = $this->shopCustomServiceModel->addService($v);
			check_rs($aflag, $rs_row);
		}
		$shop['shop_workingtime'] = $shop_workingtime;
		
		$up_flag = $this->shopBaseModel->editBase($shop_id,$shop);
		check_rs($up_flag, $rs_row);
		
		$flag = is_ok($rs_row);
		if ($flag !== false && $this->shopCustomServiceModel->sql->commitDb())
		{
			$status = 200;
			$msg    = _('success');
		}
		else
		{
			$this->shopCustomServiceModel->sql->rollBackDb();
			$status = 250;
			$msg    = _('failure');
		}

		$data = array();

		$this->data->addBody(-140, $data, $msg, $status);
	}
	/**
	 * 系统消息页面
	 *
	 * @access public
	 */
	public function message()
	{
		$YLB_Page           = new YLB_Page();
		$YLB_Page->listRows = request_int('listRows')?request_int('listRows'):10;
		$rows              = $YLB_Page->listRows;
		$offset            = request_int('firstRow', 0);
		$page              = ceil_r($offset / $rows);

		$cond_row                    = array();
		$cond_row['message_user_id'] = Perm::$userId;
		$cond_row['message_mold']    = 1;


		/* if ($type)
		{
			$cond_row['message_type'] = $type;
		} */

		$data = $this->messageModel->getMessageList($cond_row, array('message_create_time' => 'DESC'), $page, $rows);

		$YLB_Page->totalRows = $data['totalsize'];
		$page_nav           = $YLB_Page->prompt();
		
		if ("json" == $this->typ)
		{
			$this->data->addBody(-140, $data);
		}
		else
		{
			include $this->view->getView();
		}
		
	}

	/**
	 * 删除选择系统消息
	 *
	 * @access public
	 */
	public function delAllMessage()
	{
		$message_id_list = request_row("id");

		//开启事物
		$rs_row = array();
		$this->messageModel->sql->startTransactionDb();

		//删除选中的
		$flag = $this->messageModel->removeMessageSelected($message_id_list);
		check_rs($flag, $rs_row);
		
		$flag = is_ok($rs_row);
		if ($flag !== false && $this->messageModel->sql->commitDb())
		{
			$status = 200;
			$msg    = _('success');
		}
		else
		{
			$this->messageModel->sql->rollBackDb();
			$status = 250;
			$msg    = _('failure');
		}

		$data = array();

		$this->data->addBody(-140, $data, $msg, $status);

	}

	/**
	 * 商家查看选中的消息
	 *
	 * @access public
	 */
	public function look()
	{
		$message_id = request_row("id");
		
		$cond_row['message_islook'] = 1;
		
		$flag = $this->messageModel->editMessage($message_id, $cond_row);

		if ($flag !== false)
		{
			$status = 200;
			$msg    = _('success');
		}
		else
		{
			$status = 250;
			$msg    = _('failure');
		}

		$data = array();

		$this->data->addBody(-140, $data, $msg, $status);
	}

	/**
	 * 公告页面
	 *
	 * @access public
	 */
	public function messageAnnouncement()
	{
		$YLB_Page           = new YLB_Page();
		$YLB_Page->listRows = request_int('listRows')?request_int('listRows'):10;
		$rows              = $YLB_Page->listRows;
		$offset            = request_int('firstRow', 0);
		$page              = ceil_r($offset / $rows);

		$order_row                 = array();
		$order_row['information_type'] = 1;

		$data = $this->informationBaseModel->getBaseAllList($order_row, array('information_add_time' => 'DESC'), $page, $rows);

		$YLB_Page->totalRows = $data['totalsize'];
		$page_nav           = $YLB_Page->prompt();

		if ("json" == $this->typ)
		{
			$this->data->addBody(-140, $data);
		}
		else
		{
			include $this->view->getView();
		}
	}

	/**
	 * 消息设置页面
	 *
	 * @access public
	 */
	public function messageManage()
	{

		$YLB_Page           = new YLB_Page();
		$YLB_Page->listRows = request_int('listRows')?request_int('listRows'):10;
		$rows              = $YLB_Page->listRows;
		$offset            = request_int('firstRow', 0);
		$page              = ceil_r($offset / $rows);

		$cond_row         = array();
		$cond_row['type'] = 2;
		
		$order_row = array();

		$data = $this->messageTemplateModel->getTemplateList($cond_row, $order_row, $page, $rows);
		
		$YLB_Page->totalRows = $data['totalsize'];
		$page_nav           = $YLB_Page->prompt();


		if ("json" == $this->typ)
		{
			$this->data->addBody(-140, $data);
		}
		else
		{
			include $this->view->getView();
		}
	}
	
	/**
	 * 商家设置消息接收
	 *
	 * @access public
	 */
	public function set()
	{
//		
//		$data = $this->messageTemplateModel->getOne($id);
//		if ("json" == $this->typ)
//		{
//			$this->data->addBody(-140, $data);
//		}
//		else
//		{
//			include $this->view->getView();
//		}
        $t_id = request_int("id");
        $user_id = Perm::$userId;
        $cond_row = array('user_id'=>$user_id);
        $data  = $this->messageSettingModel->getSettingDetail($cond_row);
        if(!$data){
            $data['message_template_all'] = '';
            $data['is_receive'] = 0;
            $data['t_id'] = $t_id;
        }else{
            $data['t_id'] = $t_id;
            $data['message_template_all'] = explode(',', $data['message_template_all']);
            if(in_array($t_id, $data['message_template_all'])){
                $data['is_receive'] = 1;
            }else{
                $data['is_receive'] = 0;
            }
        }
        if ("json" == $this->typ){
			$this->data->addBody(-140, $data);
		}else{
			include $this->view->getView();
		}
        
	}

	/**
	 * 设置站内信
	 *
	 * @access public
	 */
	public function setMessage()
	{
		$shop_id = Perm::$shopId;
        $user_id = Perm::$userId;
		$t_id      = request_int("id");
        $is_receive = request_int("is_receive");
		$cond_row                         = array();
        $cond_row['user_id']              = $user_id;
        $re = $this->messageSettingModel->getSettingDetail($cond_row);
        $cond_row['shop_id']              = $shop_id;
        $cond_row['setting_time'] = get_date_time();
        $template_id  = array();
        $flag = true;
        if ($re){
            //编辑
            $setting_id = $re['setting_id'];
            if($re['message_template_all']){
                $template_id = explode(',', $re['message_template_all']);
            }
            if(in_array($t_id, $template_id)){
                if($is_receive == 0){
                    //删除id
                    $new_template_id = array_diff($template_id, array($t_id));
                    $cond_row['message_template_all'] = implode(',', $new_template_id);
                    $flag = $this->messageSettingModel->editSetting($setting_id, $cond_row);
                }
            }else{
                if($is_receive == 1){
                    //添加id
                    $template_id[] = $t_id;
                    $cond_row['message_template_all'] = implode(',', $template_id);
                    $flag = $this->messageSettingModel->editSetting($setting_id, $cond_row);
                }
            }
        }else{
            //添加
            $cond_row['message_template_all'] = $t_id;
            $flag = $this->messageSettingModel->addSetting($cond_row);
        }
       
        if ($flag){
            $status = 200;
            $msg    = _('success');
        }else{
            $status = 250;
            $msg    = _('failure');
        }
        $data = array();
        $this->data->addBody(-140, $data, $msg, $status);

    }

}

?>                