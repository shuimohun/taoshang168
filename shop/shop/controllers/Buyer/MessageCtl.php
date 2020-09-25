<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Buyer_MessageCtl extends Buyer_Controller
{
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
		$this->userFriendModel      = new User_FriendModel();
		$this->userInfoModel        = new User_InfoModel();
		$this->User_BaseModel        = new User_BaseModel();
		$this->messageTemplateModel = new Message_TemplateModel();
		$this->messageSettingModel  = new Message_SettingModel();
		$this->informationBaseModel = new Information_BaseModel();
	}

	/**
	 * 系统消息页面
	 *
	 * @access public
	 */
	public function message()
	{
		$remind_cat = array(
			"1" => _('订单信息'),
			"3" => _('账户信息'),
			"4" => _('其他')
		);
		$type = request_int('type');
		$op   = request_string('op');

		if ($op == 'receive')//收到消息
		{
			
			$YLB_Page           = new YLB_Page();
			$YLB_Page->listRows = request_int('listRows')?request_int('listRows'):10;
			$rows              = $YLB_Page->listRows;
			$offset            = request_int('firstRow', 0);
			$page              = ceil_r($offset / $rows);

			$order_row                            = array();
			$order_row['user_message_receive_id'] = Perm::$userId;

			$data = $this->userMessageModel->getMessageList($order_row, array(
				'message_islook' => 'ASC',
				'user_message_time' => 'DESC'
			), $page, $rows);

			foreach ($data['items'] as $k => $v)
			{
				$order_row                            = array();
				$order_row['user_message_pid']        = $v['user_message_id'];
				$order_row['user_message_receive_id'] = Perm::$userId;
				$order_row['message_islook']          = 0;

				$this->Message                = $this->userMessageModel->getCount($order_row);
				$data['items'][$k]['receive'] = $this->Message;
			}

			$YLB_Page->totalRows = $data['totalsize'];
			$page_nav           = $YLB_Page->prompt();

			$this->view->setMet('userMessage');
		}
		elseif ($op == 'send')//发送的消息
		{
			$YLB_Page           = new YLB_Page();
			$YLB_Page->listRows = request_int('listRows')?request_int('listRows'):10;
			$rows              = $YLB_Page->listRows;
			$offset            = request_int('firstRow', 0);
			$page              = ceil_r($offset / $rows);
			
			$order_row                         = array();
			$order_row['user_message_send_id'] = Perm::$userId;
			
			$data = $this->userMessageModel->getMessageList($order_row, array('user_message_time' => 'DESC'), $page, $rows);
			
			$YLB_Page->totalRows = $data['totalsize'];
			$page_nav           = $YLB_Page->prompt();
			
			$this->view->setMet('userMessage');
			
		}
		elseif ($op == 'detail')//查看消息
		{
			$order_row = array();
			
			$order_row['user_message_id'] = request_int("id");
			
			$de = $this->userMessageModel->getMessageDetail($order_row);
			if ($de['user_message_pid'] != 0)
			{
				$order_row                    = array();
				$user_message_id              = $de['user_message_pid'];
				$order_row['user_message_id'] = $user_message_id;
			}
			
			$data = $this->detail($order_row);

			$this->view->setMet('detail');
			
		}
		elseif ($op == 'messageAnnouncement')//系统公告
		{
			$YLB_Page           = new YLB_Page();
			$YLB_Page->listRows = request_int('listRows')?request_int('listRows'):10;
			$rows              = $YLB_Page->listRows;
			$offset            = request_int('firstRow', 0);
			$page              = ceil_r($offset / $rows);
			
			$user_id           = Perm::$userId;
			
			$user = $this->userInfoModel->getOne($user_id);
			$user_am = $user['user_am'];

			$am_row = array();
			if($user_am){
				$am_row	= explode(",",$user_am);
			}

			$order_row                   = array();
			$order_row['information_type']   = 1;
			$order_row['information_status'] = 1;

			$data = $this->informationBaseModel->getBaseAllList($order_row, array('information_add_time' => 'DESC'), $page, $rows);

			if($data['items'])
			{
				foreach($data['items'] as $k=>$v)
				{
					if(in_array($v['information_id'],$am_row))
					{
						$data['items'][$k]['information_islook'] = 1;
					}
				}
			}
			$YLB_Page->totalRows = $data['totalsize'];
			$page_nav           = $YLB_Page->prompt();

			$this->view->setMet('messageAnnouncement');
		}
		elseif ($op == 'messageManage')//接收设置
		{
			$user_id             = Perm::$userId;
			$cond_row            = array();
			$cond_row['user_id'] = $user_id;

			$re  = $this->messageSettingModel->getSettingDetail($cond_row);
			$all = array();
			if ($re)
			{
				$all = explode(',', $re['message_template_all']);
			}
			$order_row         = array();
			$order_row['type'] = 1;
			
			$data = $this->messageTemplateModel->getTemplateList($order_row);
			
			$this->view->setMet('messageManage');
		}
		elseif ($op == 'sendMessage')//发送站内信
		{
			$userid = request_int('id');
			$user   = array();
			if ($userid)
			{
				$user_row['user_id'] = $userid;
				$user                = $this->userInfoModel->getUserInfo($user_row);
			}

			$user_id           = Perm::$userId;
			$YLB_Page           = new YLB_Page();
			$YLB_Page->listRows = request_int('listRows')?request_int('listRows'):30;
			$rows              = $YLB_Page->listRows;
			$offset            = request_int('firstRow', 0);
			$page              = ceil_r($offset / $rows);
			
			$cond_row            = array();
			$cond_row['user_id'] = $user_id;
			
			$data = $this->userFriendModel->getFriendList($cond_row, array('friend_addtime' => 'DESC'), $page, $rows);

			$YLB_Page->totalRows = $data['totalsize'];
			$page_nav           = $YLB_Page->prompt();

			$this->view->setMet('sendMessage');
		}
		elseif ($op == 'get_user_list')//
		{
			//临时测试, 获取用户列表
			$order_row                            = array();
			$order_row['user_message_receive_id'] = Perm::$userId;

			$data = $this->userMessageModel->getMessageList($order_row, array(
				'message_islook' => 'ASC',
				'user_message_time' => 'DESC'
			));

			$user_message_send_id_row = array_column($data['items'], 'user_message_send_id');

			$User_InfoModel = new User_InfoModel();
			$user_info_rows = $User_InfoModel->getInfo($user_message_send_id_row);

			foreach ($data['items'] as $item)
			{
				if (!isset($user_info_rows[$item['user_message_send_id']]['msg']))
				{
					$user_info_rows[$item['user_message_send_id']]['msg'] = array(
						'message_islook'=> $item['message_islook'],
						'message_title'=>$item['user_message_content'],
						'message_create_time'=>$item['user_message_time']
					);
				}
			}

			$data['user'] = $user_info_rows;

		}
		elseif ($op == 'get_chat_msg')//
		{
			$chat_user_id   = request_string('user_id');

			$order_row                            = array();
			$order_row['user_message_receive_id'] = Perm::$userId;
			$order_row['user_message_send_id'] = $chat_user_id;

			$data = $this->userMessageModel->getMessageList($order_row, array(
				'message_islook' => 'ASC',
				'user_message_time' => 'DESC'
			));

			$User_InfoModel = new User_InfoModel();
			$user_info_rows = $User_InfoModel->getInfo($chat_user_id);

			$data['user'] = $user_info_rows;

		}
		else//系统消息
		{
			$YLB_Page           = new YLB_Page();
			$YLB_Page->listRows = request_int('listRows')?request_int('listRows'):8;
			$rows              = $YLB_Page->listRows;
			$offset            = request_int('firstRow', 0);
			$page              = ceil_r($offset / $rows);
			
			$cond_row                    = array();
			$cond_row['message_user_id'] = Perm::$userId;
			$cond_row['message_mold']    = 0;
			
			if ($type)
			{
				$cond_row['message_type'] = $type;
			}

			$data = $this->messageModel->getMessageList($cond_row, array(
				'message_islook' => 'ASC',
				'message_create_time' => 'DESC'
			), $page, $rows);
			$YLB_Page->totalRows = $data['totalsize'];
			$page_nav           = $YLB_Page->prompt();
			
			
		}

		if ('json' == $this->typ)
		{
			//发送小心用户信息
			if ('wap' == $op)
			{

			}

			$this->data->addBody(-140, $data);
		}
		else
		{
			include $this->view->getView();
			//D:/phpStudy/WWW/taoshang/shop/shop/views/default/Buyer/MessageCtl/messageAnnouncement.php
		}
	}
    public function messages(){
        $type = request_int('type');
        if ($type)
        {
            $cond_row['message_type'] = $type;
        }
        $cond_row['message_user_id'] = Perm::$userId;
        $data = $this->messageModel->getMessageList($cond_row, array(
            'message_islook' => 'ASC',
            'message_create_time' => 'DESC'
        ));
        if ('json' == $this->typ)
        {

            $this->data->addBody(-140, $data);
        }
    }
	/**
     *   wap消息设置
     *  @author  weidp
     */
	public function wapSettingMessage()
    {
        $user_id             = Perm::$userId;
        $cond_row            = array();
        $cond_row['user_id'] = $user_id;

        $re  = $this->messageSettingModel->getSettingDetail($cond_row);
        $all = array();
        if ($re)
        {
            $all = explode(',', $re['message_template_all']);
        }
        $order_row         = array();
        $order_row['type'] = 1;

        $data = $this->messageTemplateModel->getTemplateList($order_row);

        foreach($data['items'] as $key=>$value)
        {
            if(in_array($value['id'],$all))
            {
                $data['items'][$key]['is_state'] = '1';
            }
        }
        if($this->typ == 'json')
        {
            $this->data->addBody(-140,$data);
        }
    }

	/**
	 * 临时测试
	 *
	 * @access public
	 */
	public function getNodeInfo()
	{
		$from_user_id = request_int('u_id');

		$User_InfoModel = new User_InfoModel();
		$user_info_row = $User_InfoModel->getOne($from_user_id);
		$member_info_row = $User_InfoModel->getOne(Perm::$userId);

		$Shop_BaseModel = new Shop_BaseModel();
		$shop_base = $Shop_BaseModel->getByWhere(array('user_id' => $member_info_row['user_id']));
		if (!empty($shop_base)) {
			$shop_base = pos($shop_base);
			$user_info_row['store_name'] = $shop_base['shop_name'];
		}

		$data['node_chat'] = true;
		$data['node_site_url'] = "http://www.taos168.com:8091";
		$data['resource_site_url'] = "http://www.taos168.com/shop_wap";
		$data['userInfo'] = $user_info_row;
		$data['member_info'] = $member_info_row;

		$tr =  '
		{
			"code": 200,
			"data": {
				"node_chat": true,
				"node_site_url":
				"resource_site_url":
				"member_info": {
					"member_id": "1",
					"member_name": "bbc-builder",
					"member_avatar": "http://www.taoshang168.com/tesa/data/upload/shop/common/default_user_portrait.gif",
					"store_id": "1",
					"store_name": "平台自营",
					"store_avatar": "http://www.taoshang168.com/tesa/data/upload/shop/common/default_store_avatar.png",
					"grade_id": "0",
					"seller_name": "bbc-builder_seller"
				},
				"userInfo": {
					"member_id": "1",
					"member_name": "bbc-builder",
					"member_avatar": "http://www.taoshang168.com/tesa/data/upload/shop/common/default_user_portrait.gif",
					"store_id": "1",
					"store_name": "平台自营",
					"store_avatar": "http://www.taoshang168.com/tesa/data/upload/shop/common/default_store_avatar.png",
					"grade_id": "0",
					"seller_name": "bbc-builder_seller"
				}
			}
		}';

		$this->data->addBody(-140, $data);
	}


	/**
	 * 删除选择系统消息
	 *
	 * @access public
	 */
	public function delAllMessage()
	{
	    if($this->typ=='json'){
            $message_list = request_row("id");
            $d_type = request_int('type');
            $message_id_list = explode(',',$message_list);
        }else{
            $message_id_list = request_row("id");
        }

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
        $data['type'] = $d_type;
		$this->data->addBody(-140, $data, $msg, $status);

	}

	/**
	 * 消息详情页面
	 *
	 * @access public
	 */
	public function detail($order_row = array())
	{

		$data = $this->userMessageModel->getMessageDetail($order_row);
		
		$row['user_message_pid'] = $data['user_message_id'];
		
		$list         = $this->userMessageModel->getMessageList($row, array('user_message_time' => 'desc'));
		$data['list'] = $list['items'];
		
		return $data;
	}

	/**
	 * 回复消息
	 *
	 * @access public
	 */
	public function addDetail()
	{

		$user_message_id              = request_row("user_message_id");
		$user_message_content         = request_row("user_message_content");
		$order_row['user_message_id'] = $user_message_id;
		$user_message_time            = get_date_time();
		$matche_row                   = array();
		//有违禁词
		if (Text_Filter::checkBanned($user_message_content, $matche_row))
		{
			$data   = array();
			$msg    = _('failure');
			$status = 230;
			$this->data->addBody(-140, array(), $msg, $status);
			return false;
		}
		
		$de = $this->userMessageModel->getMessageDetail($order_row);

		if (!$de)
		{
			$status = 240;
			$msg    = _('failure');
		}
		else
		{
			if ($de['user_message_pid'] != 0)
			{
				$user_message_id = $de['user_message_pid'];
			}
			
			$add_row['user_message_send_id']    = $de['user_message_receive_id'];
			$add_row['user_message_send']       = $de['user_message_receive'];
			$add_row['user_message_receive']    = $de['user_message_send'];
			$add_row['user_message_receive_id'] = $de['user_message_send_id'];
			$add_row['user_message_content']    = $user_message_content;
			$add_row['user_message_pid']        = $user_message_id;
			$add_row['user_message_time']       = $user_message_time;
			
			$flag = $this->userMessageModel->addMessage($add_row);
			
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
		}
		$data = array();

		$this->data->addBody(-140, $data, $msg, $status);
	}

	/**
	 * 发送消息
	 *
	 * @access public
	 */
	public function addMessageDetail()
	{
		$user_id              = Perm::$userId;
		$user_message_receive = request_string("user_message_receive");
		$user_message_content = request_string("user_message_content");
		$user_message_time    = get_date_time();

		$matche_row = array();
		//有违禁词
		if (Text_Filter::checkBanned($user_message_content, $matche_row))
		{
			$data   = array();
			$msg    = _('failure');
			$status = 230;
			$this->data->addBody(-140, array(), $msg, $status);
			return false;
		}
		
		$de = $this->userInfoModel->getOne($user_id);
		
		if (!$de)
		{
			$status = 240;
			$msg    = _('failure');
		}
		else
		{
			$add_row['user_message_send_id'] = $user_id;
			$add_row['user_message_send']    = $de['user_name'];
			$add_row['user_message_content'] = $user_message_content;
			$add_row['user_message_pid']     = 0;
			$add_row['user_message_time']    = $user_message_time;
			
			$user_message_receive = trim($user_message_receive, ',');
			$send_id_row          = explode(',', $user_message_receive);
			foreach($send_id_row as $k=>$v){
				if($de['user_name']== $v){
					unset($send_id_row[$k]);
				}
			}
			if($send_id_row){
				//开启事物
				$rs_row = array();
				$this->userInfoModel->sql->startTransactionDb();
				
				foreach ($send_id_row as $key => $val)
				{
					
					$user_name = $val;
					
					$cond_row = array();
					$cond_row['user_name'] = $val;
					
					$message_receive = $this->userInfoModel->getUserInfo($cond_row);
					
					if ($user_name != $de['user_name'] && $message_receive )
					{
						$cond_row['user_name'] = $user_name;
						$re                    = $this->userInfoModel->getUserInfo($cond_row);

						$add_row['user_message_receive_id'] = $re['user_id'];
						$add_row['user_message_receive']    = $user_name;

						$flag = $this->userMessageModel->addMessage($add_row);
						check_rs($flag, $rs_row);
						
					}
					
					
				}
				$flag = is_ok($rs_row);
				if ($flag !== false && $this->userInfoModel->sql->commitDb())
				{
					$status = 200;
					$msg    = _('success');
				}
				else
				{
					$this->userInfoModel->sql->rollBackDb();
					$status = 250;
					$msg    = _('failure');
				}
				
			}else{
				$status = 260;
				$msg    = _('failure');
			}
		}
		$data = array();

		$this->data->addBody(-140, $data, $msg, $status);
	}

	/**
	 * 删除用户消息
	 *
	 * @access public
	 */
	public function delUserMessage()
	{
		$user_message_id = request_int("id");
		$flag = $this->userMessageModel->removeMessage($user_message_id);
		
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
	 * 编辑用户接收设置
	 *
	 * @access public
	 */
	public function editManage()
	{
		$user_id          = Perm::$userId;
		$user_message_id  = request_row("id");
		$user_message_all = '';
		foreach ($user_message_id as $k => $v)
		{
			$user_message_all .= ',' . $v;
		}
		$user_message_all = trim($user_message_all, ',');
		
		$cond_row            = array();
		$cond_row['user_id'] = $user_id;

		$re = $this->messageSettingModel->getSettingDetail($cond_row);
		
		$cond_row['message_template_all'] = $user_message_all;
		$cond_row['setting_time']         = get_date_time();
		
		//开启事物
		$rs_row = array();
		$this->messageSettingModel->sql->startTransactionDb();
		
		if ($re)
		{
			$setting_id = $re['setting_id'];
			$flag       = $this->messageSettingModel->editSetting($setting_id, $cond_row);
			check_rs($flag, $rs_row);
		}
		else
		{
			
			$flag = $this->messageSettingModel->addSetting($cond_row);
			check_rs($flag, $rs_row);
		}
		$flag = is_ok($rs_row);
		if ($flag !== false && $this->messageSettingModel->sql->commitDb())
		{
			$status = 200;
			$msg    = _('success');
		}
		else
		{
			$this->messageSettingModel->sql->rollBackDb();
			$status = 250;
			$msg    = _('failure');
		}

		$data = array();

		$this->data->addBody(-140, $data, $msg, $status);
	}

	/**
	 * 移动端编辑用户接受数据
     *
     * @author weidp
     */
	public function editWapSettingMessage()

    {
        $user_id          = Perm::$userId;
        $user_message_id  = request_int("id");
        $type             = request_string('type');

        $cond_row            = array();
        $cond_row['user_id'] = $user_id;

        $re = $this->messageSettingModel->getSettingDetail($cond_row);

        if($re)
        {
           $arr = explode(',',$re['message_template_all']);

           if($user_message_id)
           {
               if($type == 'add')
               {
                   array_push($arr,$user_message_id);
               }
               else if($type == 'del')
               {
                   if(in_array($user_message_id,$arr))
                   {
                        foreach($arr as $k=>$v)
                        {
                            if($v == $user_message_id)
                            {
                                unset($arr[$k]);
                            }
                        }
                   }
               }

           }

           $user_message_all = '';

           foreach($arr as $key=>$value)
           {
               $user_message_all .= ',' . $value;
           }

           $user_message_all = trim($user_message_all, ',');

           $cond_row['message_template_all'] = $user_message_all;
        }
        else
        {
            $cond_row['message_template_all'] = $user_message_id;
        }

        $cond_row['setting_time']         = get_date_time();

        //开启事物
        $rs_row = array();
        $this->messageSettingModel->sql->startTransactionDb();

        if ($re)
        {
            $setting_id = $re['setting_id'];
            $flag       = $this->messageSettingModel->editSetting($setting_id, $cond_row);
            check_rs($flag, $rs_row);
        }
        else
        {

            $flag = $this->messageSettingModel->addSetting($cond_row);
            check_rs($flag, $rs_row);
        }

        $flag = is_ok($rs_row);

        if ($flag !== false && $this->messageSettingModel->sql->commitDb())
        {
            $status = 200;
            $msg    = _('success');
        }
        else
        {
            $this->messageSettingModel->sql->rollBackDb();
            $status = 250;
            $msg    = _('failure');
        }

        $data = array();

        $this->data->addBody(-140, $data, $msg, $status);
    }


	/**
	 * 查看用户公告
	 *
	 * @access public
	 */
	public function changeAnnouncement()
	{
		
		$information_id    	= request_int("id");

		$user_id        = Perm::$userId;

		$user = $this->userInfoModel->getOne($user_id);

		$user_am = $user['user_am'];
		
		$am_row = '';
		
		if($user_am){
			$row = explode(",",$user_am);
			if(in_array($information_id,$row))
			{
				$user_am = $user_am;
			}else{
				$user_am = $user_am.",".$information_id;
			}
			
			$am_row	= $user_am;
		}else{
			$am_row	= $information_id ;
		}
		$cond_row['user_am'] = $am_row;

		$flag = $this->userInfoModel->editInfo($user_id, $cond_row);

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
	 * 查看用户信息
	 *
	 * @access public
	 */
	public function changeUserMessage()
	{

		$user_message_id            = request_int("id");
		$cond_row['message_islook'] = 1;

		$flag = $this->userMessageModel->editMessage($user_message_id, $cond_row);

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
	 * 查看用户系统信息
	 *
	 * @access public
	 */
	public function changeMessage()
	{
		
		$message_id                 = request_int("id");
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
	 * 查看用户新消息数量
	 *
	 * @access public
	 */
	public function getNewMessageNum()
	{
		//会员未读消息
		$order_row                            = array();
		$order_row['user_message_receive_id'] = Perm::$userId;;
		$order_row['message_islook']          = 0;
		$data['count'] = $this->userMessageModel->getCount($order_row);

        $this->data->addBody(-140, $data);
	}
	//查看消息数量
    public function  getnewmessage(){
        //会员未读消息
        $order_row                            = array();
        $order_row['message_user_id'] = Perm::$userId;;
        $order_row['message_islook']          = 0;
        $data['count'] = $this->messageModel->getCount($order_row);
        $Information_BaseModel = new Information_BaseModel();
        //资讯
        $cond_row                             =array();
        $cond_row['information_status']       =1;
        $data['infor_count'] = $Information_BaseModel->getCount($cond_row);
        $Consult_BaseModel = new Consult_BaseModel();
        $cond_rows                           = array();
        $cond_rows['user_id']                = Perm::$userId;
        //咨询
        $data['consult_count'] = $Consult_BaseModel->getCount($cond_rows);
        $this->data->addBody(-140, $data);
    }

    /**
     * wap 友信 好友消息列表
     * @JiaXL 2018.08.07
     * @return array  $data  返回查询数据
     * @access public
     * */
    public function  wapMessage() {

        $userRow =Perm::$row;

        if( !empty( $userRow ) )
        {
            $sql                                    = 'SELECT count(*) as countMsg,user_message_send_id FROM ylb_user_message WHERE user_message_receive_id = '.$userRow['user_id'].' GROUP BY user_message_send_id;';
            $data                                   = $this->userMessageModel->selectSql( $sql );
            $send_id                                = array_column( $data,"user_message_send_id" );
            $cond_row['user_message_send_id:IN']    = $send_id;
            $cond_row['user_message_receive_id']    = $userRow['user_id'];
            $order_row['user_message_time']         = "DESC";
            $msg_data                               = $this->userMessageModel->getByWhere( $cond_row,$order_row );
            if( !empty( $msg_data ) )
            {
                foreach ( $msg_data as $key=>$val )
                {
                    $res[$val['user_message_send_id']][] = $val;
                }
            }
            if( !empty( $data  ) )
            {
                foreach (  $data as $k=>$v )
                {


                    //发送消息用户粉丝数量查询
                    $fans_cond_row['friend_id']         = $v['user_message_send_id'];
                    $fansCount                          = $this->userFriendModel->getRowCount( $fans_cond_row );
                    $data[$k]['countFans']              = $fansCount;
                    //用户个人信息
                    $user_cond_row['user_id']           = $v['user_message_send_id'];
                    $user_cond_row['user_statu']        = 0;
                    $user_info                          = $this->userInfoModel->getUserInfo( $user_cond_row );
                    $data[$k]['user_info']              = $user_info;
                    $base_cond_row['user_id']           = $v['user_message_send_id'];
                    $base_info                          = $this->User_BaseModel->getByWhere( $base_cond_row );
                    $data[$k]['user_info']['user_name'] = $base_info[$v['user_message_send_id']]['user_account'];
                    if( array_key_exists( $v['user_message_send_id'],$res ) )
                    {
                        $data[$k]['message_time']   = $res[$v['user_message_send_id']][0]['user_message_time'];
                        //消息发送时间
                        $time                       = date( "Y-m-d H:i:s",strtotime($res[$v['user_message_send_id']][0]['user_message_time']) );
                        //当前日期 format (月-日)
                        $standard                   = date( "Y-m-d", strtotime( get_date_time() ) );
                        //昨天日期
                        $yestDay                    = date( "Y-m-d", strtotime("-1 days", strtotime( get_date_time() ) ) );
                        //今天发的消息
                        if( $standard < $time )
                        {
                            $data[$k]['message_time_con']   = date( "H:i",strtotime( $res[$v['user_message_send_id']][0]['user_message_time'] ) ); //"今天";
                        }
                        else if( $standard > $time && $time > $yestDay )
                        {
                            $data[$k]['message_time_con']   = "昨天";
                        }
                        else
                        {
                            $data[$k]['message_time_con']   = date( "m月d日",strtotime( $res[$v['user_message_send_id']][0]['user_message_time'] ) );
                        }
                        $data[$k]['message_time']           = $res[$v['user_message_send_id']][0]['user_message_time'];
                        $data[$k]['user_message_content']    = $res[$v['user_message_send_id']][0]['user_message_content'];
                    }
                }
                $msg    = _('success');
                $status = 200;
            }
            else
            {
                $msg    = _("fail");
                $status = 250;
            }
        }
        else
        {
            $msg    = _("需要登录");
            $status = 250;
        }
        if( $this->typ == 'json' )
        {
            $this->data->addBody(-140,$data,$msg,$status);
        }

    }
}

?>