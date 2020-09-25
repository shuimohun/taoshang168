<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Buyer_UserCtl extends Buyer_Controller
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

		$this->userInfoModel                    = new User_InfoModel();
		$this->userGradeModel                   = new User_GradeModel();
		$this->userResourceModel                = new User_ResourceModel();
		$this->userAddressModel                 = new User_AddressModel();
		$this->userPrivacyModel                 = new User_PrivacyModel();
		$this->userBaseModel                    = new User_BaseModel();
		$this->userTagModel                     = new User_TagModel();
		$this->userTagRecModel                  = new User_TagRecModel();
		$this->userFriendModel                  = new User_FriendModel();
		$this->messageTemplateModel             = new Message_TemplateModel();
        $this->goodsEvaluationModel             = new Goods_EvaluationModel();
        $this->InformationFootprintModel        = new User_InformationFootprintModel();
	}
	/**
	 * 会员信息--paycenter
	 *
	 * @access public
	 */
	public function linkUserInfo()
	{

		$url = YLB_Registry::get('ucenter_api_url') . '?ctl=User&met=getUserInfo';
		location_to($url);
		die();
	}
	/**
	 *获取会员信息
	 *
	 * @access public
	 */
	public function getUserInfo()
	{
		$user_id = Perm::$userId;

		//获取一级地址
		$district_parent_id = request_int('pid', 0);
		$baseDistrictModel  = new Base_DistrictModel();
		$orderBaseModel     = new Order_BaseModel();
		$orderReturnModel   = new Order_ReturnModel();

		$district           = $baseDistrictModel->getDistrictTree($district_parent_id);
		
		$data = $this->userInfoModel->getInfo($user_id);
		$data = $data[$user_id];
		
		$privacy = $this->userPrivacyModel->getPrivacy($user_id);
		$privacy = $privacy[$user_id];
		
		if ('json' == $this->typ)
		{
			$data['district'] = $district;
			$data['privacy']  = $privacy;

			//$grade_row = $this->userGradeModel->getOne($data['user_grade']);
			//$data['user_grade_name'] = $grade_row['user_grade_name'];

			//wap端添加淘金明细
			if(Perm::$shopId)
			{
				$Shop_BaseModel  = new Shop_BaseModel();
				$shop_base = $Shop_BaseModel->getOne(Perm::$shopId);
				$data['shop_type'] = $shop_base['shop_type'];
                $data['shop_id'] = Perm::$shopId;
                $data['is_seller'] = 1;
			}
			
			$User_FavoritesGoodsModel = new User_FavoritesGoodsModel();
			$User_FavoritesShopModel = new User_FavoritesShopModel();
            //获取状态计数
            if(perm::checkUserPerm())
            {

                $order_row['buyer_user_id']        = $user_id;
                $order_row['order_buyer_hidden:<'] = Order_BaseModel::IS_BUYER_REMOVE;
                $order_row['order_is_virtual']     = Order_BaseModel::ORDER_IS_REAL; //实物订单
                $order_row['chain_id:=']           = 0; //不是门店自提订单
                $order_row['order_type:<>']        = Order_BaseModel::ORDER_SPLIT;
                $order_row['order_status:IN']      = array(Order_StateModel::ORDER_WAIT_PAY,Order_StateModel::ORDER_PAYED,Order_StateModel::ORDER_WAIT_CONFIRM_GOODS,Order_StateModel::ORDER_FINISH);
                $order_row['order_refund_status']  = Order_BaseModel::REFUND_NO;
                $order_count_row = $orderBaseModel->select('order_status,order_buyer_evaluation_status,COUNT(*) row_count',$order_row,'order_status,order_buyer_evaluation_status');

                $data['order_wait_pay'] = 0;
                $data['order_payed'] = 0;
                $data['order_wait_confirm_goods'] = 0;
                $data['order_finish'] = 0;
                foreach ($order_count_row as $key => $value)
                {
                    if($value['order_status'] == Order_StateModel::ORDER_WAIT_PAY)
                    {
                        $data['order_wait_pay'] = $value['row_count'];
                    }
                    if($value['order_status'] == Order_StateModel::ORDER_PAYED)
                    {
                        $data['order_payed'] = $value['row_count'];
                    }
                    if($value['order_status'] == Order_StateModel::ORDER_WAIT_CONFIRM_GOODS)
                    {
                        $data['order_wait_confirm_goods'] = $value['row_count'];
                    }
                    if($value['order_status'] == Order_StateModel::ORDER_FINISH && $value['order_buyer_evaluation_status'] == 0)
                    {
                        $data['order_finish'] = $value['row_count'];
                    }
                }

                /*//待付款
                $order_row['order_status'] = Order_StateModel::ORDER_WAIT_PAY;
                $data['order_wait_pay']    = $orderBaseModel->getRowCount($order_row);
                //待发货
                $order_row['order_status'] = Order_StateModel::ORDER_PAYED;
                $data['order_payed']       = $orderBaseModel->getRowCount($order_row);
                //待收货
                $order_row['order_status']        = Order_StateModel::ORDER_WAIT_CONFIRM_GOODS;
                $data['order_wait_confirm_goods'] = $orderBaseModel->getRowCount($order_row);
                //待评价
                $order_row['order_status']                  = Order_StateModel::ORDER_FINISH;
                $order_row['order_buyer_evaluation_status'] = 0;
                $data['order_finish']                       = $orderBaseModel->getRowCount($order_row);*/

                $return_row['buyer_user_id'] = $user_id;
                $return_row['return_state']  = Order_ReturnModel::RETURN_FINISH_NO;
                $data['return_num']          = $orderReturnModel->getRowCount($return_row);
            }


			$data['favorites_goods_num'] = $User_FavoritesGoodsModel->getFavoritesGoodsNum($user_id);
			$data['favorites_shop_num'] = $User_FavoritesShopModel->getFavoritesShopNum($user_id);
			$data['directseller_is_open'] = Web_ConfigModel::value('Plugin_Directseller');

			$this->data->addBody(-140, $data);
		}
		else
		{
			include $this->view->getView();
		}
	}

	/**
	 * 修改会员信息
	 *
	 * @access public
	 */
	public function editUserInfo()
	{
		$user_id = Perm::$userId;
		
		$year    = request_int('year');
		$month   = request_int('month');
		$day     = request_int('day');
		$user_qq = request_string('user_qq');
		$user_ww = request_string('user_ww');
		$rows    = request_row('privacy');
		

		$edit_user_row['user_birthday']   = $year . "-" . $month . "-" . $day;
		$edit_user_row['user_sex']        = request_int('user_sex');
		$edit_user_row['user_realname']   = request_string('user_realname');
		$edit_user_row['user_provinceid'] = request_int('province_id');
		$edit_user_row['user_cityid']     = request_int('city_id');
		$edit_user_row['user_areaid']     = request_int('area_id');
		$edit_user_row['user_area']       = request_string('address_area');
		$edit_user_row['user_qq']         = $user_qq;
		$edit_user_row['user_ww']         = $user_ww;
		
		//开启事物
		$rs_row = array();
		$this->userInfoModel->sql->startTransactionDb();
		
		$flagPrivacy = $this->userPrivacyModel->editPrivacy($user_id, $rows);
		check_rs($flagPrivacy, $rs_row);
		$flag = $this->userInfoModel->editInfo($user_id, $edit_user_row);
		check_rs($flag, $rs_row);
		
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

		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);
	}

	/**
	 *获取会员头像
	 *
	 * @access public
	 */
	public function getUserImg()
	{
		
		include $this->view->getView();
	}

	/**
	 * 修改会员头像
	 *
	 * @access public
	 */
	public function editUserImg()
	{
		$user_id = Perm::$userId;
		
		$edit_user_row['user_logo'] = request_string('user_logo');

		$flag = $this->userInfoModel->editInfo($user_id, $edit_user_row);

		if ($flag === false)
		{
			$status = 250;
			$msg    = _('failure');
		}
		else
		{
			$status = 200;
			$msg    = _('success');
		}
		
		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);
	}

	/**
	 *获取会员等级
	 *
	 * @access public
	 */
	public function getUserGrade()
	{
		$user_id = Perm::$userId;
		
		$re       = $this->userInfoModel->getOne($user_id);
		$resource = $this->userResourceModel->getOne($user_id);
		
		$re['user_growth'] = $resource['user_growth'];

		$user_grade_id = $re['user_grade'];

		$data = $this->userGradeModel->getOne($user_grade_id);
		
		$data = $this->userGradeModel->getUserExpire($data);

		$gradeList = $this->userGradeModel->getGradeList();

		$data = $this->userGradeModel->getGradeGrowth($data, $gradeList, $re);

		if ('json' == $this->typ)
		{
			$data['gradeList'] = $gradeList;
			$data['re']        = $re;
			$data['resource']  = $resource;
			$this->data->addBody(-140, $data);
		}
		else
		{
			include $this->view->getView();
		}
	}

	/**
	 *获取会员标签
	 *
	 * @access public
	 */
	public function tag()
	{
		$user_id              = Perm::$userId;
		$order_row['user_id'] = $user_id;
		
		$data = $this->userTagRecModel->getTagRecList($order_row);
		$re   = array();

		if ($data['items'])
		{
			$user_tag_ids = array_column($data['items'], 'user_tag_id');
			
			$tag = array();
			
			if ($data['items'])
			{
				$tag['user_tag_id:not in'] = $user_tag_ids;
			}

			$tag_row['user_tag_id:in'] = $user_tag_ids;
			
			$ce = $this->userTagModel->getTagList($tag_row);
			
			$user_tag = array_column($ce['items'], 'user_tag_id');
			
			$nameAll = array();
			foreach ($ce['items'] as $key => $val)
			{
				$nameAll[$val['user_tag_id']] = $val;
			}
			foreach ($data['items'] as $key => $val)
			{

				if (in_array($val['user_tag_id'], $user_tag))
				{
					$data['items'][$key]['user_tag_name'] = $nameAll[$val['user_tag_id']]['user_tag_name'];
				}
			}

			$re = $this->userTagModel->getTagList($tag);
		}
		else
		{
			$re = $this->userTagModel->getTagList();
		}
		if ('json' == $this->typ)
		{
			$data['re'] = $re;
			$this->data->addBody(-140, $data);
		}
		else
		{
			include $this->view->getView();
		}
	}

	/**
	 *编辑会员兴趣标签
	 *
	 * @access public
	 */
	public function editTagRec()
	{
		$user_id = Perm::$userId;

		$id_row = array();
		$id_row = request_row('mid');

		$edit_rec_row['user_id']      = $user_id;
		$edit_rec_row['tag_rec_time'] = get_date_time();


		//开启事物
		$rs_row = array();
		$this->userTagRecModel->sql->startTransactionDb();

		$order_row['user_id'] = $user_id;

		$de = $this->userTagRecModel->getTagRecList($order_row);
		if ($de['items'])
		{
			$user_tag = array_column($de['items'], 'tag_rec_id');


			$updata_flag = $this->userTagRecModel->removeRec($user_tag);
			check_rs($updata_flag, $rs_row);
		}
		foreach ($id_row as $v)
		{
			$edit_rec_row['user_tag_id'] = $v;
			$flag                        = $this->userTagRecModel->addRec($edit_rec_row);
			check_rs($flag, $rs_row);
		}


		$flag = is_ok($rs_row);
		if ($flag !== false && $this->userTagRecModel->sql->commitDb())
		{
			$status = 200;
			$msg    = _('success');
		}
		else
		{
			$this->userTagRecModel->sql->rollBackDb();
			$msg    = _('failure');
			$status = 250;
		}


		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);

	}

	/**
	 *获取会员地址信息
	 *
	 * @access public
	 */
	public function address()
	{
		$user_id = Perm::$userId;
		$act     = request_string('act');

		//获取一级地址
		$district_parent_id = request_int('pid', 0);
		$Base_DistrictModel  = new Base_DistrictModel();
		$district           = $Base_DistrictModel->getDistrictTree($district_parent_id);

		if ($act == 'edit')
		{
			$userId          = Perm::$userId;
			$user_address_id = request_int('id');


			$data = $this->userAddressModel->getAddressInfo($user_address_id);
		}
		elseif ($act == 'add')
		{
			$userId = Perm::$userId;

			$data = array();
		}
		elseif ($act == 'edit_delivery')
		{
			$userId = Perm::$userId;
			$data   = array();
		}
		else
		{
			$order_row['user_id'] = $user_id;

			$data = $this->userAddressModel->getAddressList($order_row);
		}

		if ("json" == $this->typ)
		{
			//
			$district_id_row = array_merge(
				array_column($data, 'user_address_province_id'),
				array_column($data, 'user_address_city_id'),
				array_column($data, 'user_address_area_id')
			);

			$district_id_row = array_filter($district_id_row);

			if ($district_id_row)
			{
				$district_rows = $Base_DistrictModel = $Base_DistrictModel->getDistrict($district_id_row);

				foreach ($data as $k=>$address_row)
				{
					$address_row['address_info'] = sprintf('%s %s %s', @$district_rows[$address_row['user_address_province_id']]['district_name'], @$district_rows[$address_row['user_address_city_id']]['district_name'], @$district_rows[$address_row['user_address_area_id']]['district_name']);
					$data[$k] = $address_row;
				}
			}


			$data_rows['address_list'] = array_merge($data);

			$this->data->addBody(-140, $data_rows);
		}
		else
		{
			include $this->view->getView();
		}

	}

	/**
	 *编辑会员地址信息
	 *
	 * @access public
	 */
	public function editAddressInfo()
	{
		$user_id              = Perm::$userId;
		$user_address_id      = request_int('user_address_id');
		$user_address_contact = request_string('user_address_contact');
		$user_address_area    = request_string('address_area');
		$user_address_address = request_string('user_address_address');
		$user_address_phone   = request_string('user_address_phone');
		$user_address_default = request_string('user_address_default');

        //验证收件人 不能包含特殊字符
        if (!preg_match ( "/^[\x{4e00}-\x{9fa5}a-zA-Z]/u", $user_address_contact))
        {
            $this->data->addBody(-140, array(), '收件人格式只支持中英文', 250);
            return;
        }

		$edit_address_row['user_id']                  = $user_id;
		$edit_address_row['user_address_contact']     = $user_address_contact;
		$edit_address_row['user_address_province_id'] = request_int('province_id');
		$edit_address_row['user_address_city_id']     = request_int('city_id');
		$edit_address_row['user_address_area_id']     = request_int('area_id');
		//$edit_address_row['user_address_area']        = str_replace(' ','',$user_address_area);
        $edit_address_row['user_address_area']        = $user_address_area;
		$edit_address_row['user_address_address']     = $user_address_address;
		$edit_address_row['user_address_phone']       = $user_address_phone;
		$edit_address_row['user_address_default']     = $user_address_default;
		$edit_address_row['user_address_time']        = get_date_time();

		//验证用户
		$cond_row = array(
			'user_id' => $user_id,
			'user_address_id' => $user_address_id,
		);

		$re = $this->userAddressModel->getByWhere($cond_row);

		if (!$re)
		{
			$msg    = _('failure');
			$status = 250;
		}
		else
		{
			//开启事物
			$rs_row = array();
			$this->userAddressModel->sql->startTransactionDb();

			if ($user_address_default == '1')
			{

				$order_row['user_id']              = $user_id;
				$order_row['user_address_default'] = '1';
				$de                                = $this->userAddressModel->getAddressList($order_row);

				if (!empty($de))
				{
					$updata_flag = $this->userAddressModel->editAddressInfo($de);
					check_rs($updata_flag, $rs_row);
				}
			}


			$flag = $this->userAddressModel->editAddress($user_address_id, $edit_address_row);
			
			check_rs($flag, $rs_row);
			
			$flag = is_ok($rs_row);
			if ($flag !== false && $this->userAddressModel->sql->commitDb())
			{
				$status = 200;
				$msg    = _('success');
			}
			else
			{
				$this->userAddressModel->sql->rollBackDb();
				$msg    = _('failure');
				$status = 250;
			}

			$edit_address_row['user_address_id'] = $user_address_id;
			$data                                = $edit_address_row;
			$this->data->addBody(-140, $data, $msg, $status);
		}

	}
	
	/**
	 *增加会员地址信息
	 *
	 * @access public
	 */
	public function addAddressInfo()
	{
		$user_id = Perm::$userId;

		$user_address_contact = request_string('user_address_contact');
		$user_address_area    = request_string('address_area');
		$user_address_address = request_string('user_address_address');
		$user_address_phone   = request_string('user_address_phone');
		$user_address_default = request_string('user_address_default');

		//验证收件人 不能包含特殊字符
        if (!preg_match ( "/^[\x{4e00}-\x{9fa5}a-zA-Z]/u", $user_address_contact))
        {
            $this->data->addBody(-140, array(), '收件人格式只支持中英文', 250);
            return;
        }

		$edit_address_row['user_id']                  = $user_id;
		$edit_address_row['user_address_contact']     = $user_address_contact;
		$edit_address_row['user_address_province_id'] = request_int('province_id');
		$edit_address_row['user_address_city_id']     = request_int('city_id');
		$edit_address_row['user_address_area_id']     = request_int('area_id');
		//$edit_address_row['user_address_area']        = str_replace(' ','',$user_address_area);
        $edit_address_row['user_address_area']        = $user_address_area;
        $edit_address_row['user_address_address']     = $user_address_address;
		$edit_address_row['user_address_phone']       = $user_address_phone;
		$edit_address_row['user_address_default']     = $user_address_default;
		$edit_address_row['user_address_time']        = get_date_time();

		$cond_row['user_id'] = $user_id;
		
		$re = $this->userAddressModel->getCount($cond_row);

		if ($re > 19)
		{
			$status = 250;
			$msg    = _('failure');
		}
		else
		{
			//开启事物
			$rs_row = array();
			$this->userAddressModel->sql->startTransactionDb();
			
			//判断是否设默认，默认改变前面的状态
			if ($user_address_default == '1')
			{

				$order_row['user_id']              = $user_id;
				$order_row['user_address_default'] = '1';
				$de                                = $this->userAddressModel->getAddressList($order_row);

				if (!empty($de))
				{
					$updata_flag = $this->userAddressModel->editAddressInfo($de);
				}
			}
			check_rs($updata_flag, $rs_row);
			$flag = $this->userAddressModel->addAddress($edit_address_row, true);
			$addess_id = $flag;
			check_rs($flag, $rs_row);
			$flag = is_ok($rs_row);
			if ($flag !== false && $this->userAddressModel->sql->commitDb())
			{
				$edit_address_row['user_address_id'] = $addess_id;
				$status                              = 200;
				$msg                                 = _('success');
			}
			else
			{
				$this->userAddressModel->sql->rollBackDb();
				
				$status = 250;
				$msg    = _('failure');
			}
		}

		$data = $edit_address_row;
		$this->data->addBody(-140, $data, $msg, $status);

	}

	/**
	 *删除会员地址信息
	 *
	 * @access public
	 */
	public function delAddress()
	{
		$user_id         = Perm::$row['user_id'];
		$user_address_id = request_string('id');

		//验证用户
		$cond_row = array(
			'user_id' => $user_id,
			'user_address_id' => $user_address_id
		);

		$re       = $this->userAddressModel->getByWhere($cond_row);

		if ($re)
		{
			$flag = $this->userAddressModel->removeAddress($user_address_id);

		}
		else
		{
			$flag = false;
		}

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
	 *查找好友
	 *
	 * @access public
	 */
	public function friend()
	{
		$user_id = Perm::$userId;
		$act     = request_string('op');

		$user_name = request_string("searchname");

		if ($act == 'follow')
		{
			$cond_row['user_id'] = $user_id;
			$order_row           = array('friend_addtime' => 'DESC');

			$YLB_Page           = new YLB_Page();
			$YLB_Page->listRows = request_int('listRows')?request_int('listRows'):30;
			$rows              = $YLB_Page->listRows;
			$offset            = request_int('firstRow', 0);
			$page              = ceil_r($offset / $rows);

			$friend_list = $this->userFriendModel->getFriendAllDetail($cond_row, $order_row, $page, $rows);

			$YLB_Page->totalRows = $friend_list['totalsize'];
			$page_nav           = $YLB_Page->prompt();

			
			$data                = array();
			$data['friend_list'] = $friend_list;
			$this->data->addBody(-140, $data);
		
			$this->view->setMet('follow');


		}
		elseif ($act == 'fan')
		{
			$cond_row['friend_id'] = $user_id;
			$order_row             = array('friend_addtime' => 'DESC');

			$YLB_Page           = new YLB_Page();
			$YLB_Page->listRows = request_int('listRows')?request_int('listRows'):30;
			$rows              = $YLB_Page->listRows;
			$offset            = request_int('firstRow', 0);
			$page              = ceil_r($offset / $rows);

			$friend_list = $this->userFriendModel->getBeFriendAllDetail($cond_row, $order_row, $page, $rows);

			$YLB_Page->totalRows = $friend_list['totalsize'];
			$page_nav           = $YLB_Page->prompt();

			
			$data                = array();
			$data['friend_list'] = $friend_list;
			$this->view->setMet('fan');
		}
		else
		{

			if ($user_name)
			{
				$type            = 'user_name:LIKE';
				$cond_row[$type] = '%' . $user_name . '%';
				$order_row       = array();

				$YLB_Page           = new YLB_Page();
				$YLB_Page->listRows = request_int('listRows')?request_int('listRows'):30;
				$rows              = $YLB_Page->listRows;
				$offset            = request_int('firstRow', 0);
				$page              = ceil_r($offset / $rows);

				$cond_row['user_id:!='] = $user_id;

				$user_list = $this->userInfoModel->getInfoList($cond_row, $order_row, $page, $rows);

				$friend_row                 = array();
				$friend_row['friend_id:IN'] = array_column($user_list['items'], 'user_id');

				$friend_row['user_id'] = $user_id;

				$friend_list = $this->userFriendModel->getFriendAll($friend_row);

				$friend_id = array();
				$friend_id = array_column($friend_list, 'friend_id');

				//获取已经加好友的
				foreach ($user_list['items'] as $key => $val)
				{

					if (in_array($val['user_id'], $friend_id))
					{
						$user_list['items'][$key]['status'] = 1;
					}
					else
					{
						$user_list['items'][$key]['status'] = 0;
					}
				}

				$YLB_Page->totalRows = $user_list['totalsize'];
				$page_nav           = $YLB_Page->prompt();
				
				$data['user_list'] = $user_list;
			}
			else
			{
				//推荐标签列表
				$cond_row['user_tag_recommend'] = 1;
				$sort                           = array('user_tag_sort' => 'DESC');

				$data = $this->userTagModel->getTagList($cond_row, $sort, 1, 10);

				if (!empty($data['items']))
				{
					foreach ($data['items'] as $key => $val)
					{
						$YLB_Page           = new YLB_Page();
						$YLB_Page->listRows = request_int('listRows')?request_int('listRows'):10;
						$rows              = $YLB_Page->listRows;
						$offset            = request_int('firstRow', 0);
						$page              = ceil_r($offset / $rows);

						//查询已经是好友的，排除掉
						$friend_row['user_id'] = $user_id;

						$friend_list = $this->userFriendModel->getFriendAll($friend_row);

						$user = array();

						$user = array_column($friend_list, 'friend_id');

						array_push($user, $user_id);
						$tag_row['user_id:not in'] = $user;
						$tag_row['user_tag_id']    = $val['user_tag_id'];
						$order_row                 = array();

						$tag = $this->userTagRecModel->getTagRecList($tag_row, $order_row, $page, $rows);
						$users_id = array();
						if($tag['items']){
						
							$users_id = array_column($tag['items'], 'user_id');
							$detail   = $this->userInfoModel->getInfo($users_id);
						}
						//标签下除好友的总会员个数
						$count                        = count($tag['items']);
						$data['items'][$key]['count'] = $count;
						
						foreach ($tag['items'] as $k => $v)
						{
							if(in_array($v['user_id'],$users_id)){
								$tag['items'][$k]['detail'] = $detail[$v['user_id']];
							}
						}
						$data['items'][$key]['user'] = $tag;
					}
				}

			}

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
	
	/**
	 *关注标签下面没有关注的会员
	 *
	 * @access public
	 */
	public function addFriends()
	{
		$user_id = Perm::$userId;

		$cond_row['user_id']        = $user_id;
		$cond_row['friend_addtime'] = get_date_time();
		//查询已经是好友的，排除掉
		$friend_row['user_id'] = $user_id;

		$friend_list = $this->userFriendModel->getFriendAll($friend_row);
		
		$user = array();
		$user = array_column($friend_list, 'friend_id');

		array_push($user, $user_id);
		$tag_row['user_id:not in'] = $user;
		$tag_row['user_tag_id']    = request_int('id');
		$order_row                 = array();

		$tag = $this->userTagRecModel->getTagRecList($tag_row, $order_row);

		//开启事物
		$rs_row = array();
		$this->userFriendModel->sql->startTransactionDb();

		foreach ($tag['items'] as $key => $val)
		{
			$user_id = $val['user_id'];
			$detail  = $this->userInfoModel->getInfo($user_id);
			$detail  = $detail[$user_id];
			
			$cond_row['friend_id']    = $val['user_id'];
			$cond_row['friend_name']  = $detail['user_name'];
			$cond_row['friend_image'] = $detail['user_logo'];
			
			$flag = $this->userFriendModel->addFriend($cond_row);
			check_rs($flag, $rs_row);
		}
		
		$flag = is_ok($rs_row);
		if ($flag !== false && $this->userFriendModel->sql->commitDb())
		{
			$status = 200;
			$msg    = _('success');
		}
		else
		{
			$this->userFriendModel->sql->rollBackDb();
			$msg    = _('failure');
			$status = 250;
		}


		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);

	}

	/**
	 *关注一个会员
	 *
	 * @access public
	 */
	public function addFriendDetail()
	{
		$user_id = Perm::$userId;

		$cond_row['user_id']        = $user_id;
		$cond_row['friend_addtime'] = get_date_time();
		
		$userId = request_int('id');
		$from   = request_string('from');
        $data   = array();
		$detail     = $this->userInfoModel->getOne($userId);
        $u_cond_row['user_id']      = $user_id;
        $u_cond_row['friend_id']    = $userId;
        $is_friend  = $this->userFriendModel->getByWhere( $u_cond_row );
		if ( !$detail || $is_friend )
		{
			$status = 250;
			$msg    = _('已关注该用户或者用户不存在');
		}
		else
		{
        	$cond_row['friend_id']    = $userId;
			$cond_row['friend_name']  = $detail['user_name'];
			$cond_row['friend_image'] = $detail['user_logo'];

			$flag = $this->userFriendModel->addFriend($cond_row);
            $data = array();
			if ($flag !== false)
			{
			    /*---关注增加金蛋 2018.08.2 @JiaXL----*/
			    if( $from == 'article' )
                {
                    $user_info = Perm::$row;
                    //关注者添加金蛋
                    $PointsLogModel = new Points_LogModel();
                    $user_point = $PointsLogModel->addPointsLog($user_info['user_id'],$user_info['user_account'],Points_LogModel::FOLLOW);
                    //被关注者添加金蛋
                    $be_follow_name = $this->userInfoModel->getOneByWhere( array('user_id'=>$userId ) );
                    $PointsLogModel = new Points_LogModel();
                    $data_point = $PointsLogModel->addPointsLog($userId,$be_follow_name['user_name'],Points_LogModel::BE_FOLLOWED);
                    $data['user_point_flag'] = $user_point;
                    $data['writer_point_flag'] = $data_point;

                }
                /*-----end------*/
			    $friend_cond_row['user_id'] = $user_id;
			    $friend_cond_row['friend_id'] = $userId;

			    $arr = $this->userFriendModel->getByWhere($friend_cond_row);
			    foreach ($arr as $k=>$v)
                {
                    $user_friend_id = $v['user_friend_id'];
                }
                $data['user_friend_id'] = $user_friend_id;
               $msg = _('success');
                $status = 200;
			}
			else
			{
				$msg    = _('关注失败');
				$status = 250;
			}
		}


		$this->data->addBody(-140, $data, $msg, $status);

	}

	/**
	 *取消一个会员
	 *
	 * @access public
	 */
	public function cancelFriendDetail()
	{
		$user_id = Perm::$userId;
		
		$user_friend_id = request_int('id');

		$cond_row['user_id']        = $user_id;
		$cond_row['user_friend_id'] = $user_friend_id;
		
		$de = $this->userFriendModel->getFriendInfo($cond_row);

		if (!$de)
		{
			
			$status = 250;
			$msg    = _('failure');
		}
		else
		{
			$flag = $this->userFriendModel->removeFriend($user_friend_id);

			if ($flag !== false)
			{
				$status = 200;
				$msg    = _('success');
			}
			else
			{
				
				$msg    = _('failure');
				$status = 250;
			}
		}

		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);

	}
	
	/**
	 * 密码修改
	 *
	 * @access public
	 */
	public function passwd()
	{

		$url = YLB_Registry::get('ucenter_api_url') . '?ctl=User&met=passwd';
		location_to($url);
		die();
	}
	/**
	 *获取会员安全信息
	 *
	 * @access public
	 */
	public function security()
	{

		$url = YLB_Registry::get('ucenter_api_url') . '?ctl=User&met=security';
		location_to($url);
		die();


		$user_id = Perm::$userId;
		$op      = request_string('op');

		$user_id = Perm::$userId;

		$data = $this->userInfoModel->getInfo($user_id);
		$data = $data[$user_id];

		if ($op == 'email')
		{
			$this->view->setMet('email');
		}
		elseif ($op == 'mobile')
		{
			$this->view->setMet('mobile');
		}
		elseif ($op == 'mobiles')
		{
			$name = _('手机');
			$this->view->setMet('security_identity');
		}
		elseif ($op == 'emails')
		{
			$name = _('邮箱');
			$this->view->setMet('security_identity');
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

	//手机绑定验证
	public function getMobile()
	{
		$user_id                 = Perm::$userId;
		$cond_row['user_mobile'] = request_string('verify_field');
		$cond_row['user_id:!=']  = $user_id;
		
		$de = $this->userInfoModel->getUserInfo($cond_row);

		if($de)
		{
			
			$msg    = _('failure');
			$status = 250;
		}
		else
		{

			$status = 200;
			$msg    = _('success');
			
		}

		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);

	}
	
	//生成验证码,并且发送验证码
	public function getMobileYzm()
	{

		$mobile                  = request_string('mobile');

		$user_id                 = Perm::$userId;
		$cond_row['user_mobile'] = $mobile;
		$cond_row['user_id:!=']  = $user_id;

		//检测该手机号是否已被其他用户绑定
		$ce = $this->userInfoModel->getUserInfo($cond_row);

		if($ce)
		{
			$msg    = _('该手机号已被其他会员绑定，请更换其他手机号');
			$status = 250;

		}
		else
		{

			$code_cond_row['code'] = 'verification';

			$de = $this->messageTemplateModel->getTemplateDetail($code_cond_row);

//			$me = $de['content_phone'];
			$code_key = $mobile;

			$code     = VerifyCode::getCode($code_key);

//			$me       = str_replace("[weburl_name]", $this->web['web_name'], $me);
//			$me       = str_replace("[yzm]", $code, $me);
            $me       = '【淘尚168商城】您的验证码是'.$code;
			$str = Sms::send($mobile, $me);
			if($str)
			{
                $status = 200;
                $msg = "success";
            }
            else
            {
                $status = 250;
                $msg = "error";
            }

		}

		$data   = array('sms_time'=>60);
		$this->data->addBody(-140, $data, $msg, $status);

	}
	
	//检测验证码
	public function checkMobileYzm()
	{

		$yzm    = request_string('yzm');
		$mobile = request_string('mobile');
		
		if (VerifyCode::checkCode($mobile, $yzm))
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
	
	//绑定手机
	public function editMobileInfo()
	{

		$user_id                             = Perm::$userId;
		$user_mobile        				 = request_string('user_mobile');
		$yzm             					 = request_string('yzm');

		fb(VerifyCode::checkCode($user_mobile, $yzm));
		fb($user_id);
		fb($yzm);
		if(!VerifyCode::checkCode($user_mobile, $yzm)){
			$msg    = _('failure');
			$status = 240;
		}else{
			$edit_user_row['user_mobile']        = $user_mobile;
			$edit_user_row['user_mobile_verify'] = 1;
			
			$de = $this->userInfoModel->getOne($user_id);
			if(!$de){
				$msg    = _('failure');
				$status = 250;
			}else{
				$user_level_id = 1;
				
				if ($de['user_email_verify'])
				{
					
					$user_level_id = $user_level_id + 1;
				}
				
				$edit_user_row['user_level_id'] = $user_level_id + 1;
				
				$flag = $this->userInfoModel->editInfo($user_id, $edit_user_row);
				
				if ($flag == false)
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
		}
		$data = array();
		
		$this->data->addBody(-140, $data, $msg, $status);

	}

	//邮箱绑定验证
	public function getEmail()
	{
		$user_id                = Perm::$userId;
		$cond_row['user_email'] = request_string('verify_field');
		$cond_row['user_id:!='] = $user_id;
		
		$de = $this->userInfoModel->getUserInfo($cond_row);

		if ($de)
		{
			
			$msg    = _('failure');
			$status = 250;
		}
		else
		{

			$status = 200;
			$msg    = _('success');
			
		}

		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);

	}
	
	//邮箱生成验证码,并且发送验证码
	public function getEmailYzm()
	{

		$email = request_string('email');
		$user_id                 = Perm::$userId;
		$cond_row['user_email'] = $email;
		$cond_row['user_id:!=']  = $user_id;
		
		$ce = $this->userInfoModel->getUserInfo($cond_row);

		if($ce)
		{
			$msg    = _('failure');
			$status = 250;
		}else
		{
			$cond_row['code'] = 'verification';
			
			$de = $this->messageTemplateModel->getTemplateDetail($cond_row);

			$me    = $de['content_email'];
			$title = $de['title'];

			$code_key = $email;
			$code     = VerifyCode::getCode($code_key);
			$me       = str_replace("[weburl_name]", Web_ConfigModel::value("site_name"), $me);
			$me       = str_replace("[yzm]", $code, $me);
			$title    = str_replace("[weburl_name]", Web_ConfigModel::value("site_name"), $title);

			$str = Email::sendMail($email, Perm::$row['user_account'], $title, $me);
			
			$status = 200;
			$msg    = 'success';
		}
		$data   = array();
		$this->data->addBody(-140, $data, $msg, $status);

	}
	
	//邮箱检测验证码
	public function checkEmailYzm()
	{

		$yzm   = request_string('yzm');
		$email = request_string('email');
		
		if (VerifyCode::checkCode($email, $yzm))
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
	
	//绑定邮箱
	public function editEmailInfo()
	{
		$user_id                            = Perm::$userId;
		$user_email        				    = request_string('user_email');
		$yzm             					= request_string('yzm');
		if(!VerifyCode::checkCode($user_email, $yzm)){
			$msg    = _('failure');
			$status = 240;
		}else{
			$edit_user_row['user_email']        = request_string('user_email');
			$edit_user_row['user_email_verify'] = 1;
			
			$de = $this->userInfoModel->getOne($user_id);
			
			$user_level_id = 1;
			
			if ($de['user_mobile_verify'] == 1)
			{
				
				$user_level_id = $user_level_id + 1;
			}

			$edit_user_row['user_level_id'] = $user_level_id + 1;
			
			$flag = $this->userInfoModel->editInfo($user_id, $edit_user_row);
			
			if ($flag == false)
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
		$data = array();
		
		$this->data->addBody(-140, $data, $msg, $status);

	}
	
	//解除绑定,生成验证码,并且发送验证码
	public function getYzm()
	{

		$type = request_string('type');
		$val = request_string('val');

		$cond_row['code'] = 'Lift verification';
		
		$de = $this->messageTemplateModel->getTemplateDetail($cond_row);
		if($type == 'mobile'){
			$me = $de['content_phone'];

			$code_key = $val;
			$code     = VerifyCode::getCode($code_key);
			$me       = str_replace("[weburl_name]", $this->web['web_name'], $me);
			$me       = str_replace("[yzm]", $code, $me);

			$str = Sms::send($val, $me);
		}else{
			$me    = $de['content_email'];
			$title = $de['title'];

			$code_key = $val;
			$code     = VerifyCode::getCode($code_key);
			$me       = str_replace("[weburl_name]", Web_ConfigModel::value("site_name"), $me);
			$me       = str_replace("[yzm]", $code, $me);
			$title    = str_replace("[weburl_name]", Web_ConfigModel::value("site_name"), $title);

			$str = Email::sendMail($val, Perm::$row['user_account'], $title, $me);
		}
		$status = 200;
		$data   = array();
		$msg = "success";
		$this->data->addBody(-140, $data, $msg, $status);

	}
	
	//检测解除验证码
	public function checkYzm()
	{

		$yzm    = request_string('yzm');
		$type   = request_string('type');
		$val    = request_string('val');
		
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
		
		if(!VerifyCode::checkCode($val, $yzm))
		{
			$msg    = _('failure');
			$status = 240;
		}else
		{
			if($type == 'mobile'){
				$edit_user_row['user_mobile']    = '';
				$edit_user_row['user_mobile_verify'] = 0;
			}else{
				$edit_user_row['user_email']    = '';
				$edit_user_row['user_email_verify'] = 0;
			}
			
			
			$de = $this->userInfoModel->getOne($user_id);
			
			$user_level_id = $de['user_level_id']*1;
			
			$edit_user_row['user_level_id'] = $user_level_id-1;

			$flag = $this->userInfoModel->editInfo($user_id, $edit_user_row);
			
			if ($flag == false)
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
		$data = array();
		
		$this->data->addBody(-140, $data, $msg, $status);

	}


	public function share()
    {
        $shareBaseModel = new Share_BaseModel();
        $sharePriceModel = new Share_PriceModel();
        $shareClickModel = new Share_ClickModel();

        $YLB_Page           = new YLB_Page();
        $YLB_Page->listRows = 10;
        $rows              = $YLB_Page->listRows;
        $offset            = request_int('firstRow', 0);
        $page              = ceil_r($offset / $rows);

        if (request_string('start_date'))
        {
            $order_row['share_date:>'] = strtotime(request_string('start_date'));
        }
        if (request_string('end_date'))
        {
            $order_row['share_date:<'] = strtotime(request_string('end_date'));
        }
        if (request_string('orderkey'))
        {
            $order_row['share_num:LIKE'] = '%' . request_string('orderkey') . '%';
        }


        $order_row['share_uid']        = Perm::$userId;
        $order_row['status:>'] = '0';
        $data = $sharePriceModel->getSharePriceList($order_row, array('share_date' => 'DESC'), $page, $rows);


        foreach ($data['items'] as $key=>$val)
        {

            $common_id = $val['common_id'];
            //$commonModel = new Goods_CommonModel();
            //$goods_common = $commonModel -> getOneByWhere(array('common_id'=>$common_id));
            $goodsModel = new Goods_BaseModel();
            $goods = $goodsModel->getOneByWhere(array('common_id'=>$common_id));
            $data['items'][$key]['goods_image'] = $goods['goods_image'];
            $data['items'][$key]['goods_name'] = $goods['goods_name'];//商品名称
            $data['items'][$key]['goods_price'] = $goods['goods_price'];
            $data['items'][$key]['shop_name'] = $goods['shop_name'];
            $data['items'][$key]['goods_id'] = $goods['goods_id'];
            $data['items'][$key]['promotion_price'] = $goods['goods_price'] - $val['price'];


            $share_base = $shareBaseModel->getOneByWhere(array('common_id'=>$common_id));
            $data['items'][$key]['promotion_unit_price'] = $share_base['promotion_unit_price'];
            $data['items'][$key]['share_click_price'] =  $share_base['promotion_unit_price'] * $val['promotion_click_count'];

            //$share_click_list = $shareClickModel->getAllShareClickByWhere(array('share_price_id'=>$val['id']));

            $click_cond['share_price_id'] = $val['id'];
            $click_data = null;
            foreach ($val['share_base'] as $k=>$v)
            {
                $click_cond['type'] = $k;
                $click_data[$k] = $shareClickModel->getCount($click_cond);
            }
            $data['items'][$key]['click_data'] = $click_data;

            if($val['share_order_id'] == '0')
            {
                $data['items'][$key]['order_status'] = '订单未提交';
            }
            else
            {
                $order_id = $val['share_order_id'];
                $order_base_model = new Order_BaseModel();
                $order = $order_base_model->getOrderStatus($order_id);
                $data['items'][$key]['order_status'] = $order['order_status_con'];
            }

            $data['items'][$key]['share_date_str'] = date('Y-m-d H:i:s',$val['share_date']);

        }

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

        /*
         * wap兴趣标签页
         * Jiaxl
         * */
    public function wapinterest()
    {

	        $user_id = Perm::$userId;
            //用户已贴标签
            $cond_row_tag['user_id']=$user_id;
            $userTag = $this->userTagRecModel->getByWhere($cond_row_tag);
            $karr = array_column($userTag,"user_tag_id");
            $userTag = array_combine($karr,$userTag);

            //推荐标签列表
            $cond_row['user_tag_recommend'] = 1;
            $sort                           = array('user_tag_sort' => 'DESC');

            $data = $this->userTagModel->getTagList($cond_row, $sort, 1, 30);

            foreach ($data['items'] as $k=>$v){
                if(array_key_exists($v['user_tag_id'],$userTag)){
                    $data['items'][$k]['is_focus']=1;
                }
            }

            if (!empty($data['items']))
            {
                foreach ($data['items'] as $key => $val)
                {
                    $YLB_Page           = new YLB_Page();
                    $YLB_Page->listRows = request_int('listRows')?request_int('listRows'):10;
                    $rows              = $YLB_Page->listRows;
                    $offset            = request_int('firstRow', 0);
                    $page              = ceil_r($offset / $rows);

                    //查询已经是好友的，排除掉
                    $friend_row['user_id'] = $user_id;

                    $friend_list = $this->userFriendModel->getFriendAll($friend_row);

                    $user = array();

                    $user = array_column($friend_list, 'friend_id');

                    array_push($user, $user_id);
                    $tag_row['user_id:not in'] = $user;
                    $tag_row['user_tag_id']    = $val['user_tag_id'];
                    $order_row                 = array();

                    $tag = $this->userTagRecModel->getTagRecList($tag_row, $order_row, $page, $rows);
                    $users_id = array();
                    if($tag['items']){

                        $users_id = array_column($tag['items'], 'user_id');
                        $detail   = $this->userInfoModel->getInfo($users_id);
                    }
                    //标签下除好友的总会员个数
                    $count                        = count($tag['items']);
                    $data['items'][$key]['count'] = $count;

                    foreach ($tag['items'] as $k => $v)
                    {
                        if(in_array($v['user_id'],$users_id)){
                            $tag['items'][$k]['detail'] = $detail[$v['user_id']];
                        }
                    }
                    $data['items'][$key]['user'] = $tag;
                }
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

    /*
     * wap添加好友页
     * Jiaxl
     * */
    public function addFriend()
    {

        $user_id                                = Perm::$userId;
        $User_Base                              = new User_BaseModel();
        $User_InfoModel                         = new User_InfoModel();
        $Information_BaseModel                  = new Information_BaseModel();
        //查找一个月之内登录用户 按登录次数降序
        $print_cond_row['user_login_time:<']    = date("Y-m-d H:i:s",strtotime("-1 month") );
        $print_cond_row['user_delete']          = 0;
        $print_order_row['user_login_times']    = "DESC";
        $print_data                             = $User_Base->listByWhere( $print_cond_row, $print_order_row, 1, 6 );
        foreach( $print_data['items'] as $k=>$v )
        {
            $sql        = "SELECT user_logo from ylb_user_info WHERE  user_id=".$v['user_id'];
            $user_logo  = $User_InfoModel->sql( $sql );
            if( $user_logo )
            {
                $print_data['items'][$k]['user_logo'] = $user_logo[0]['user_logo'];
            }
        }
        //推荐标签列表
        $tagRec_cond_row['user_id']         = $user_id;
        $userTag                            =$this->userTagRecModel->getRecList( $tagRec_cond_row );
        $user_tag_id                        = array_column( $userTag,"user_tag_id" );
        $cond_row['user_tag_recommend']     = 1;
        $cond_row['user_tag_id:IN']         = $user_tag_id;
        $order_row                          = array('user_tag_sort' => 'DESC');
        $data                               = $this->userTagModel->getTagList($cond_row, $order_row);
        $data['print']                      = $print_data['items'];
        foreach ( $data['items'] as $key=>$val )
        {
            $tag_row['user_tag_id']         = $val['user_tag_id'];
            $tag                            = $this->userTagRecModel->getRecList($tag_row);
            $users_id                       = array_column($tag,"user_id");
            foreach ( $users_id as $k=>$v )
            {
                if( $v==$user_id )
                {
                    unset($users_id[$k]);
                }
            }
             //查询好友
            $friend_row['user_id']  = $user_id;
            $friend_list            = $this->userFriendModel->getFriendAll( $friend_row );
            $friends_id             = array_column(  $friend_list,"friend_id" );
            $friends                = array_combine( $friends_id,$friend_list );
            if( $tag )
            {
                $detail = $this->userInfoModel->getInfo( $users_id );
                foreach ( $tag as $k=>$v )
                {
                    if( $v['user_id'] == $user_id )
                    {
                        unset( $tag[$k] );
                    }
                }
                foreach ( $tag as $k=>$v )
                {
                    //查询发布文章总数
                    $info_cond_row ['user_id']              = $v['user_id'];
                    $info_cond_row ['information_status']   = Information_BaseModel::ARTICLE_STATUS_TRUE;
                    $info_cond_row ['information_type']     = Information_BaseModel::ARTICLE_TYPE_ARTICLE;
                    $info_cond_row ['information_state']    = Information_BaseModel::AUDITED;
                    $info_count                             = $Information_BaseModel->getRowCount( $info_cond_row );
                    $tag[$k]['information_count']           = $info_count;
                    /*查询用户有多少关注*/
                    $tag_user_friend_row['user_id']         = $v['user_id'];
                    $tag_user_friend                        = $this->userFriendModel->getFriendAll($tag_user_friend_row);
                    $tag_friend_arr                         = count($tag_user_friend);
                    $tag[$k]['friend_num']                  = $tag_friend_arr;
                    /*计算用户晒图*/
                    $sql                    = 'select image from ylb_goods_evaluation where user_id='.$v['user_id'].' and image !=" "';
                    $image                  = $this->goodsEvaluationModel->selectSql($sql);
                    $tag[$k]['image_num']   = count( $image );
                    if( in_array( $v['user_id'],$friends_id ) )
                    {
                        $tag[$k]['friend']  ="on";

                    }

                    if( array_key_exists( $v['user_id'],$friends ) )
                    {
                        $tag[$k]['user_friend_id']          = $friends[$v['user_id']]['user_friend_id'];

                    }

                    if( in_array( $v['user_id'],$users_id ) )
                    {
                        $tag[$k]['user_name']   = $detail[$v['user_id']]['user_name'];
                        $tag[$k]['user_logo']   = $detail[$v['user_id']]['user_logo'];
                    }
                }

            }
            $data['items'][$key]['user']        = array_values($tag);
            //全部
            foreach ( $tag as $k=>$v )
            {
               $data['all_user'][]              =$v;
            }
        }
        /*all_user去重*/
        $res=array();
        foreach ( $data['all_user'] as $value )
        {
            if( isset( $res[$value['user_id']] ) )
            {           //有：销毁
                unset($value['user_id']);
            }
            else
            {
                $res[$value['user_id']]                  = $value;
            }
            $count_cond_row ['user_id']                  = $value['user_id'];
            $count_cond_row ['information_status']       = Information_BaseModel::ARTICLE_STATUS_TRUE;
            $count_cond_row ['information_type']         = Information_BaseModel::ARTICLE_TYPE_ARTICLE;
            $count_cond_row ['information_state']        = Information_BaseModel::AUDITED;
            $res[$value['user_id']]['information_count'] = $Information_BaseModel->getRowCount( $count_cond_row );
        }
        $data['all_user']   = array_values( $res );
        if( $this->typ =="json" )
        {
            $this->data->addBody( -140, $data );
        }

    }


    /*
     * 搜索好友列表页
     *
     * Jiaxl
     * */
    public function searchUser()
    {
        $user_id    = Perm::$userId;
        $page       = request_string("page");
        $rows       = request_string("rows",10);
        $user_name  = request_string("searchname");

        if ($user_name)
        {

            $cond_row['user_name:LIKE'] = '%' . $user_name . '%';
            $cond_row['user_id:!=']     = $user_id;
            $order_row                  = array();

            $user_list = $this->userInfoModel->getInfoList($cond_row, $order_row, $page, $rows);

            $friend_row = array();
            $friend_row['friend_id:IN'] = array_column($user_list['items'], 'user_id');

            $friend_row['user_id'] = $user_id;

            $friend_list = $this->userFriendModel->getFriendAll($friend_row);

            $friend_id = array_column($friend_list,"friend_id");
            $friends   =array_combine($friend_id,$friend_list);


            $friend_id = array();
            $friend_id = array_column($friend_list, 'friend_id');

            //获取已经加好友的
            foreach ($user_list['items'] as $key => $val)
            {

                if(array_key_exists($val['user_id'],$friends))
                {
                    $user_list['items'][$key]['user_friend_id'] = $friends[$val['user_id']]['user_friend_id'];
                }

                if (in_array($val['user_id'], $friend_id))
                {
                    $user_list['items'][$key]['status'] = 1;
                } else {
                    $user_list['items'][$key]['status'] = 0;
                }
            }

            $data['user_list'] = $user_list;
        }
        if($this->typ=="json"){
            $this->data->addBody(-140,$data);
        }

    }



    /*名称分组方法*/
    public function groupByInitials(array $data, $targetKey = 'friend_name')
    {
        $data = array_map(function ($item) use ($targetKey) {
            return array_merge($item, [
                'initials' => $this->getInitials($item[$targetKey]),
            ]);
        }, $data);
        $data = $this->sortInitials($data);
        return $data;
    }
    /*按字母排序*/
    public function sortInitials(array $data)
    {
        $sortData = [];
        foreach ($data as $key => $value) {

            if($value['initials'] == null)
            {
                $value['initials'] ="#";
                $sortData[$value['initials']][] = $value;
            }else
            {
                $sortData[$value['initials']][] = $value;
            }
        }
        ksort($sortData);
        return $sortData;
    }
    /**
     * 获取首字母
     * @param  string $str 汉字字符串
     * @return string 首字母
     */
    public function getInitials($str)
    {
        if (empty($str)) {return '';}
        $fchar = ord($str{0});
        if ($fchar >= ord('A') && $fchar <= ord('z')) {
            return strtoupper($str{0});
        }

        $s1  = iconv('UTF-8', 'gb2312', $str);
        $s2  = iconv('gb2312', 'UTF-8', $s1);
        $s   = $s2 == $str ? $s1 : $str;
        $asc = ord($s{0}) * 256 + ord($s{1}) - 65536;
        if ($asc >= -20319 && $asc <= -20284) {
            return 'A';
        }

        if ($asc >= -20283 && $asc <= -19776) {
            return 'B';
        }

        if ($asc >= -19775 && $asc <= -19219) {
            return 'C';
        }

        if ($asc >= -19218 && $asc <= -18711) {
            return 'D';
        }

        if ($asc >= -18710 && $asc <= -18527) {
            return 'E';
        }

        if ($asc >= -18526 && $asc <= -18240) {
            return 'F';
        }

        if ($asc >= -18239 && $asc <= -17923) {
            return 'G';
        }

        if ($asc >= -17922 && $asc <= -17418) {
            return 'H';
        }

        if ($asc >= -17417 && $asc <= -16475) {
            return 'J';
        }

        if ($asc >= -16474 && $asc <= -16213) {
            return 'K';
        }

        if ($asc >= -16212 && $asc <= -15641) {
            return 'L';
        }

        if ($asc >= -15640 && $asc <= -15166) {
            return 'M';
        }

        if ($asc >= -15165 && $asc <= -14923) {
            return 'N';
        }

        if ($asc >= -14922 && $asc <= -14915) {
            return 'O';
        }

        if ($asc >= -14914 && $asc <= -14631) {
            return 'P';
        }

        if ($asc >= -14630 && $asc <= -14150) {
            return 'Q';
        }

        if ($asc >= -14149 && $asc <= -14091) {
            return 'R';
        }

        if ($asc >= -14090 && $asc <= -13319) {
            return 'S';
        }

        if ($asc >= -13318 && $asc <= -12839) {
            return 'T';
        }

        if ($asc >= -12838 && $asc <= -12557) {
            return 'W';
        }

        if ($asc >= -12556 && $asc <= -11848) {
            return 'X';
        }

        if ($asc >= -11847 && $asc <= -11056) {
            return 'Y';
        }

        if ($asc >= -11055 && $asc <= -10247) {
            return 'Z';
        }

        return null;
    }


    /**
     * wap 通讯录
     * Jiaxl
     */
    public  function addressBook(){

        $userId              = Perm::$userId;
        $cond_row['user_id'] = $userId;
        $FriendArr           = $this->userFriendModel->getFriendAll($cond_row);

        foreach ($FriendArr as $key=>$value)    /*查找互相关注的好友*/
        {
            $friend_cond_row['user_id']   = $value['friend_id'];
            $friend_user                  = $this->userFriendModel->getFriendAll($friend_cond_row);
            $userIdArr                    = array_column($friend_user,'friend_id');
            if(in_array($userId,$userIdArr))
            {
                $FriendArr[$key]['mutual'] = 1;
            }
        }

        $data = array_values($FriendArr);
        $data = $this->groupByInitials($data,'friend_name');

        foreach($data as $key=>$val)
        {
            if($key =="#")
            {
                $other      = array_shift($data);
                $data['#']  = $other;
            }
        }
        $data = array_values($data);
        if($this->typ=="json")
        {
            $this->data->addBody(-140,$data);
        }
    }

    /**
     * wap用户中心页
     * JiaXl
     * 2018.07.24
     * @param  String $uid 用户id
     * @return array $data 返回查询数据
     */

    function systemInfo(){

        $Fu_RecordModel                     = new Fu_RecordModel();
        $this->userResourceModel            = new User_ResourceModel();
        $this->userResourceModel            = new User_ResourceModel();
        $Information_BaseModel              = new Information_BaseModel();
        $uid                                = Perm::$userId;

        if( $uid )
        {
            //用户粉丝数
            $Fs_cond_row['friend_id']           = $uid;
            $Fs_count                           = $this->userFriendModel->getRowCount( $Fs_cond_row );
            //用户关注数量
            $G_cond_row['user_id']              = $uid;
            $G_count                            = $this->userFriendModel->getRowCount( $G_cond_row );
            $data['Fs_count']                   = $Fs_count  ? $Fs_count : '';
            $data['G_count']                    = $G_count   ? $G_count  : '';
            //用户base
            $base_cond_row['user_id']           = $uid;
            $base_cond_row['user_delete']       = 0;
            $userBase                           = $this->userBaseModel->getUserInfo( $base_cond_row );
            $data['user_Base']                  = $userBase ? $userBase : '';
            $info_cond_row['user_id']           = $uid;
            $userInfo                           = $this->userInfoModel->getUserInfo( $info_cond_row );
            $data['user_Info']                  = $userInfo  ? $userInfo : '';
            //送福信息
            $Fu_cond_row['user_id']             = $uid;
            $Fu_cond_row['information_type']    = Information_BaseModel::ARTICLE_TYPE_ARTICLE;
            $Fu_cond_row['information_status']  = Information_BaseModel::ARTICLE_STATUS_TRUE;
            $info_data                          = $Information_BaseModel->getRowCount( $Fu_cond_row );
            $data['InformationCount']           = $info_data;
            if( !$data['user_Base'] || !$data['user_Info'] )
            {
                $msg                            = _('error');
                $status                         = 250;
            }
            else
            {
                $msg                            = _('success');
                $status                         = 200;
            }
        }
        else
        {
                $msg                            = _('fail');
                $status                         = 250;
        }

        if( $this->typ == 'json' )
        {

            $this->data->addBody( -140, $data, $msg, $status );
        }
    }


    /**
     * wap关注 粉丝 访客页
     * JiaXl
     * 2018.07.27
     * @param $page  分页页数
     * @param $rows  每页条数
     * @return array $data 返回查询数据
     * */

    function gz_fans_visited()
    {

        $user_id = request_string("user_id");
        if ( $user_id )
        {
            //获取关注数据s
            $data                       = array();
            $uid                        = $user_id;
            if( Perm::$userId )
            {
                $login_id = Perm::$userId;
            }



            $page                       = request_string('page', 1);
            $rows                       = request_string('rows', 15);
            $G_cond_row['user_id']      = $uid;
            $G_datas                    = $this->userFriendModel->getFriendList($G_cond_row, array(), $page, $rows);   //关注数据
            $G_data                     = $G_datas['items'];
            foreach ( $G_data as $key => $val )
            {
                $G_fans_cond_row['friend_id']   = $val['friend_id'];
                $G_fans_count                   = $this->userFriendModel->getRowCount($G_fans_cond_row);
                $G_data[$key]['fans_count']     = $G_fans_count;
                $G_u_cond_row['user_id']        = $val['friend_id'];
                $G_userInfo                     = $this->userInfoModel->getUserInfo($G_u_cond_row);
                $G_data[$key]['user_info']      = $G_userInfo;
            }

            //可能会有重复关注的情况,根据 friend_id 去重
            $new_G_data = array();

            foreach ( $G_data as $k=>$v )
            {
                if( isset( $new_G_data[$v['friend_id']] ) )
                {
                    unset($G_data[$k]);  //有：销毁
                }
                else
                {
                    $new_G_data[$v['friend_id']] = $v;
                }
            }

            $G_datas['items']                   = $G_data ? $G_data : array();
            $data['G_data']                     = $G_datas;
            //end

            //获取粉丝数据s
            $fans_cond_row['friend_id']         = $uid;
            $F_datas                            = $this->userFriendModel->getFriendList($fans_cond_row, array(), $page, $rows);
            $F_data                             = $F_datas['items'];


            $user_cond_row['user_id']           = $login_id;
            $user_friend                        = $this->userFriendModel->getFriendAll( $user_cond_row );
            $friend_idArr                       = array_column( $user_friend,"friend_id" );
            $user_friend_data                   = array_combine( $friend_idArr,$user_friend );



            //粉丝去重
            $new_F_data = array();
            foreach ( $F_data as $k=>$v )
            {
                if( isset( $new_F_data[$v['user_id']] ) )
                {
                    unset($F_data[$k]);  //有：销毁
                }
                else
                {
                    $new_F_data[$v['user_id']] = $v;
                }
            }

            $F_data = array_values( $new_F_data );
            foreach ( $F_data as $key => $val )
            {
                $F_u_cond_row['user_id']        = $val['user_id'];
                $F_userInfo                     = $this->userInfoModel->getUserInfo($F_u_cond_row);
                $F_data[$key]['user_info']      = $F_userInfo;
                if ( array_key_exists( $val['user_id'],$user_friend_data ) )
                {
                    $F_data[$key]['friend_on']  = 1;
                    $F_data[$key]['qg_id']      = $user_friend_data[$val['user_id']]['user_friend_id'];
                }
                else
                {
                    $F_data[$key]['friend_on']  = 0;
                }
            }
            $F_datas['items']   = $F_data ? $F_data : array();
            $data['F_data']     = $F_datas;
            //end

            //获取文章访客
            $print_cond_row['writer_id']    = $uid;
            $info_footprint                 = $this->InformationFootprintModel->getInformationFootprintAll( $print_cond_row );
            /*是否关注访问得人*/
            $res = array();
            foreach ( $info_footprint as $key=>$val )
            {
                //获取访客信息
                $footer_cond_row['user_id']             = $val['user_id'];
                $footer_info                            =$this->userInfoModel->getUserInfo( $footer_cond_row );
                $info_footprint[$key]['user_info']      = $footer_info;
                if( array_key_exists( $val['user_id'],$user_friend_data ) )
                {
                    $info_footprint[$key]['friend_on']  = 1;
                    $info_footprint[$key]['qg_id']      = $user_friend_data[$val['user_id']]['user_friend_id'];
                }
                else
                {
                    $info_footprint[$key]['friend_on']  = 0;
                }
            }
            //总访问量
            $print_count =                  count( $info_footprint );
            //最近七天访问量
            $date = date('Y-m-d H:i:s', strtotime('-7 days'));
            $print_cond_row['infor_footprint_time:>']   =$date;
            $seven_footprint                            = $this->InformationFootprintModel->getRowCount( $print_cond_row );
            $data['foot_print']['countFoot']            = $print_count ? $print_count : 0;
            $data['foot_print']['sevenFoot']            = $seven_footprint ? $seven_footprint :0;

            //访客去重
            $res = array();
            foreach ( $info_footprint as $key => $val )
            {
                if( isset( $res[$val['user_id']] ) )
                {
                    unset( $info_footprint[$key] );
                }
                else
                {
                    $res[$val['user_id']] = $val;
                }
            }
            $data['foot_print']['items']                = $res ? array_values( $res ) : array();
            $msg                                        = _('success');
            $status                                     = 200;
        }
        else
        {
            $msg                = _("没有登录账号");
            $status             = 250;
        }

        if ('json' == $this->typ)
        {
            $this->data->addBody(-140, $data, $msg, $status);
        }
    }



}
?>