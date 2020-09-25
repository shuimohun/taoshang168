<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     Banchangle
 */
class Seller_Shop_SettleddCtl extends Seller_Controller
{
	public $messageModel       = null;
	public $shopBaseModel      = null;
	public $chainBaseModel      = null;
	public $shopClassModel     = null;
	public $shopGradeModel     = null;
	public $shopTemplateModel  = null;
	public $shopCompanyModel   = null;
	public $goodsCatModel      = null;
	public $shopClassBindModel = null;
	public $sellerBaseModel = null;
	public $shopNpassModel     = null;
    public $shopCompanyClassModel  = null;

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
		$this->shopBaseModel      = new Shop_BaseModel();
		$this->chainBaseModel      = new Chain_BaseModel();
		$this->shopClassModel     = new Shop_ClassModel();
		$this->shopGradeModel     = new Shop_GradeModel();
		$this->shopTemplateModel  = new Shop_TemplateModel();
		$this->shopCompanyModel   = new Shop_CompanyModel();
		$this->messageModel       = new MessageModel();
		$this->goodsCatModel      = new Goods_CatModel();
		$this->shopClassBindModel = new Shop_ClassBindModel();
		$this->sellerBaseModel	  = new Seller_BaseModel();
		$this->shopNpassModel     = new Shop_NpassModel();
        $this->shopCompanyClassModel     = new Shop_CompanyClassModel();
	}

	public function index()
	{
		if (Perm::checkUserPerm())
		{
			//重新设置登录信息

                $web['web_logo']       = Web_ConfigModel::value("setting_logo");//首页logo
				$User_BaseModel = new User_BaseModel();
                $ShopHelpModel = new Shop_HelpModel();
                $User_InfoModel = new User_InfoModel();
                $type = request_string("type");


                $shop_xieyi = $ShopHelpModel->getByWhere(array('page_show'=>1), array('help_sort' => "asc"));
				//本地数据校验登录
				$user_row = $User_BaseModel->getOne(Perm::$userId);

				$data            = array();
				$data['user_id'] = $user_row['user_id'];

				//获取一级地址
				$district_parent_id = request_int('pid', 0);
				$baseDistrictModel  = new Base_DistrictModel();
				$district           = $baseDistrictModel->getDistrictTree($district_parent_id);

				//
				$Seller_BaseModel = new Seller_BaseModel();
				$seller_rows      = $Seller_BaseModel->getByWhere(array('user_id' => $data['user_id']));

				$Chain_UserModel  = new Chain_UserModel();
				$chain_rows 	  = $Chain_UserModel->getByWhere(array('user_id' => $data['user_id']));

				if($chain_rows)
				{
					$data['chain_id_row']	 = array_column($chain_rows,'chain_id');
					$data['chain_id']	   = current($data['chain_id_row']);

					Perm::encryptUserInfo($data);
				}
				else
				{
					$data['chain_id'] = 0;
				}

				if ($seller_rows)
				{
					$data['shop_id_row'] = array_column($seller_rows, 'shop_id');
					$data['shop_id']     = current($data['shop_id_row']);

					Perm::encryptUserInfo($data);
				}
				else
				{
					$data['shop_id'] = 0;
				}


			$user_id  = Perm::$userId;
			$cond_row = array("user_id" => $user_id);
			// $shop_id =  Perm::$shopId;
			$shop_info = $this->shopBaseModel->getBaseOneList($cond_row);

			if ($shop_info)
			{
                if($type=='npass'){
                    //不通过重新填写修改状态
                    $shop_edit_base = $this->shopBaseModel->editBase($shop_info['shop_id'],array('shop_status'=>9));
                }
				$shop_company = $this->shopBaseModel->getbaseCompanyList($shop_info['shop_id']);

				//判断用户是否有开店过了
				if ($shop_info['shop_status'] == 3)
				{
					header("Location:index.php?ctl=Seller_Index&met=index&typ=e");
					die;
				}elseif($shop_info['shop_type'] == 2)
				{
					//用户已经申请供应商入驻，跳转至供应商入驻界面
					header("Location:index.php?ctl=Seller_Supplier_Settledd&met=index");
					die;
				}
			}else if($chain_rows){
                header("Location:index.php?ctl=Chain_Goods&met=goods&typ=e");
                die;
            }
            

			//如果已经是卖家账号
			$seller_info = $this->sellerBaseModel->getSellerInfoByWhere(array('user_id'=>Perm::$userId));

			if($seller_info && $shop_info['shop_status'] == 3)
			{
				header("Location:index.php?ctl=Seller_Index&met=index&typ=e");
				die;
			}
            //join_type
            if(isset($shop_info['shop_business']) && $shop_info['shop_business'] == 1){
                $apply = 2;
            }else if(isset($shop_info['shop_business']) && $shop_info['shop_business'] == 0){
                $apply = 1;
            }else if(!isset($shop_info['shop_business']) && Web_ConfigModel::value('join_type') == 1){
                $apply = 2;
            }else if(!isset($shop_info['shop_business']) && Web_ConfigModel::value('join_type') == 2){
                $apply = 1;
            }else{
                $apply = request_int('apply');
            }


            if($apply == 1){
                $apply_tips = array(
                    '0'=>'个人入驻申请',
                    '1'=>'个人信息提交',
                    '2'=>'个人缴纳费用',
                    '3'=>'个人实名信息',
                    '4'=>'下一步，填写个人资质信息'
                );
                $shop_business = 0;
                $user_mobileinfo = $User_InfoModel->getOneByWhere(array('user_id'=>Perm::$userId));
                $user_mobile = $user_mobileinfo['user_mobile'];
            }else{
                $apply_tips = array(
                    '0'=>'商家入驻申请',
                    '1'=>'商家信息提交',
                    '2'=>'商家缴纳费用',
                    '3'=>'公司资质信息',
                    '4'=>'下一步，填写企业资质信息'
                );
                $shop_business = 1;
            }

			$shop_class = $this->shopClassModel->getByWhere();
			$shop_grade = $this->shopGradeModel->getByWhere();
			$op         = request_string("op");
            $shop_company = $this->shopBaseModel->getbaseCompanyList($shop_info['shop_id']);

//			switch ($op)
//			{
//				case "step1":
//				{
//					$page = "step1";
//                    $shop_xieyi = $ShopHelpModel->getByWhere(array('page_show'=>2), array('help_sort' => "asc"));
//					break;
//				}
//				case "step2":
//				{
//					if (empty($shop_company['company_registered_capital']))
//					{
//						$page = "step2";
//					}
//					else
//					{
//						$page = "step3";
//					}
//					break;
//				}
//				case "step3":
//				{
//					if (empty($shop_company['shop_company_name']))
//					{
//						$page = "step2";
//					}
//					else
//					{
//						$page = "step3";
//					}
//					break;
//				}
//				case "step4":
//				{
//
//					if (!empty($shop_company['shop_company_name']))
//					{
//						if (!empty($shop_company['bank_name']))
//						{
//							$page = "step4";
//						}
//						else
//						{
//							$page = "step3";
//						}
//					}
//					else
//					{
//						$page = "step2";
//					}
//
//					break;
//				}
//				case "step5":
//				{
//					if (!empty($shop_company) && ($shop_company['shop_status'] == 1 || $shop_company['shop_status'] == 2))
//					{
//						$page = "step5";
//					}
//					else
//					{
//						$page = "step1";
//					}
//					break;
//				}
//                case "step2_last":
//                {
//                    $page = "step2";
//                    break;
//                }
//                case "step3_last":
//                {
//                    $page = "step3";
//                    break;
//                }
//				//                default:
//				//                {
//				//                        $page = $shop['status'] == 1 ? "step5" : "step1";
//				//                        break;
//				//                }
//
//			}

//            if($op!='step3_last' && $op!='step2_last') {
//                if (!empty($page) && !empty($shop_company)) {
//                    $page = $shop_company && $shop_company['bank_name'] && $shop_company['shop_status'] == 0 ? "step4" : $page;
//                    $page = $shop_company && ($shop_company['shop_status'] == 1 || $shop_company['shop_status'] == 2) ? "step5" : $page;
//                }
//            }

            $shop_step_info = array(
                'contacts_phone'=> isset($shop_company['contacts_phone']) ?  $shop_company['contacts_phone'] : '',
                'bank_name'=>isset($shop_company['bank_name']) ?  $shop_company['bank_name'] : '',
                'shop_name'=>isset($shop_info['shop_name']) ?  $shop_info['shop_name'] : '',
                'shop_business'=> isset($shop_info['shop_business']) ?  $shop_info['shop_business'] : $shop_business,
                'shop_status'=>isset($shop_info['shop_status']) ?  $shop_info['shop_status'] : '-1',
                'step'=> $op
            );

            if($shop_company['shop_status'] == Shop_BaseModel::SHOP_STATUS_NPASS){
			    $data_napss = $this->shopNpassModel->getOneByWhere(array('shop_id'=>$shop_company['shop_id'],'shop_npass_status'=>1));
			    $page = "step6";
            }
            $shop_help     = $ShopHelpModel->getByWhere(array('page_show'=>1), array('help_sort' => "asc"));
//			if (!empty($page))
//			{
//				$this->view->setMet($page);
//			}
//			else
//			{
//				$shop_help     = $ShopHelpModel->getByWhere(array('page_show'=>1), array('help_sort' => "asc"));
//			}

            if($op){
                //实名认证
                $rs = $this->getCertification();

                if($rs['status'] != 200 || $rs['data']['user_identity_statu'] != 2)
                {
                    $url = YLB_Registry::get('paycenter_api_url').'?ctl=Info&met=certification&typ=e';
                    header('location:'.$url);
                    die;
                }

                if($shop_step_info['shop_status'] == '-1' && in_array($op, array('step0','step1'))){
                    //没有入驻过
                    $page = $op;

                }else{
                    $rp = request_string('rp');

                    if($rp){
                        //回退
                        $shop_step_info['rp'] = $rp;
                        $pageInfo = $this->_getRpStep($shop_step_info);
                        if(!$pageInfo['status']){
                            $pageInfo = $this->_getStep($shop_step_info,request_string('res'));
                        }
                    }else{

                        $pageInfo = $this->_getStep($shop_step_info,request_string('res'));

                    }

                    $page = $pageInfo['step'];
                    if($page == ''){
                        $page = $op;
                    }

                }

                //数据获取
                if($page === 'step1'){
                    $shop_xieyi = $ShopHelpModel->getByWhere(array('page_show'=>1), array('help_sort' => "asc"));
                }
                if($page === 'step2' || $page === 'pstep2'){
                    $district_info = $this->_getShopDistrict($shop_company['shop_company_address']);
                    if($page === 'step2'){
                        $yingye_district_info = $this->_getShopDistrict($shop_company['business_license_location']);
                    }
                }
                if($page === 'step3' || $page === 'pstep3'){
                    $bank_district_info = $this->_getShopDistrict($shop_company['bank_address']);
                }

            }else{
                $page = 'index';
            }

            if($shop_company && $apply==1 && !$shop_company['bank_name'] && !request_string('type')){
                    $page = 'pstep3';
            }elseif ($shop_company && $apply==2 && empty($shop_company['shop_company_name'])){
                    $page = 'step2';
            }elseif($shop_company && $apply==2){
                    $page = $page;
            }

            if($shop_company['shop_status'] == Shop_BaseModel::SHOP_STATUS_NPASS ){
                $data_napss = $this->shopNpassModel->getOneByWhere(array('shop_id'=>$shop_company['shop_id'],'shop_npass_status'=>1));
                $page = "step6";
            }

			//传递数据
			if ('json' == $this->typ)
			{
				$data['shop_help']    = empty($shop_help) ? array() : $shop_help;
				$data['shop_class']   = empty($shop_class) ? array() : $shop_class;
				$data['shop_grade']   = empty($shop_grade) ? array() : $shop_grade;
				$data['shop_info']    = empty($shop_info) ? array() : $shop_info;
				$data['shop_company'] = empty($shop_company) ? array() : $shop_company;
				$this->data->addBody(-140, $data);

			}
			else
			{
                $this->view->setMet($page);
				include $this->view->getView();
			}
		}
		else
		{
			header("Location:" . YLB_Registry::get('url'), "请先登录！");
		}
	}

    /**
     *  添加店铺基本信息
     */
    public function addShopCompany()
    {

        $user_id   = Perm::$userId;
        $cond_row  = array("user_id" => $user_id);
        $shop_info = $this->shopBaseModel->getBaseOneList($cond_row);

        $apply  = request_string('apply');
        $shop_company_data = $this->getShopRequest($apply);

        if($shop_company_data['status'] == 250){
            return $this->data->addBody(-140, array(), $shop_company_data['msg'], 250);
        }

        $shop_company = $shop_company_data['data'];

        $shop_company['shop_company_address'] = trim($shop_company['shop_company_address']);
        if(request_int('street_id')){
            $district_id = request_int('street_id');
        }else{
            if(request_int('area_id')){
                $district_id = request_int('area_id');
            }else{
                $district_id = request_int('city_id');
            }
        }

        //检查$district_id是否到最底层
        $Base_DistrictModel = new Base_DistrictModel();
        $check_district = $Base_DistrictModel->getDistrictList(array('district_parent_id'=>$district_id));

        if(!$check_district['records']){
            //开启事物
            $this->messageModel->sql->startTransactionDb();

            if (!$shop_info){

                $flag = $this->shopCompanyModel->addCompany($shop_company, TRUE);

                $shop_base['district_id'] = $district_id;
                $shop_base['shop_id']   = $flag;
                $shop_base['shop_status']   = 9; //提交个人（企业）信息
                $shop_base['user_id']   = Perm::$userId;
                $shop_base['user_name'] = Perm::$row['user_account'];
                $shop_base['shop_business'] = $apply == 1 ? 0 : 1;
                $shop_base['shop_type'] = 1;
                $flag1                  = $this->shopBaseModel->addBase($shop_base);
                if ($flag1 && $flag && $this->messageModel->sql->commitDb())
                {
                    $status = 200;
                    $msg    = _('success');
                }
                else
                {
                    $this->messageModel->sql->rollBackDb();
                    $status = 250;
                    $msg    = _('failure1');
                }
            }else{
                //编辑
                foreach ($shop_company as $key=>$value){
                    if($value === ''){
                        unset($shop_company[$key]);
                    }
                }
                $flag = $this->shopCompanyModel->editCompany($shop_info['shop_id'], $shop_company);
                $flag1 = $this->shopBaseModel->editBase($shop_info['shop_id'], array('shop_status'=>9));

                $rs_rows = array();
                check_rs($flag, $rs_rows);
//                check_rs($flag1, $rs_rows);

                if (is_ok($rs_rows) && $this->messageModel->sql->commitDb()){
                    $status = 200;
                    $msg    = 'success';
                }else{
                    $this->messageModel->sql->rollBackDb();
                    $status = 250;
                    $msg    = 'failure2';
                }

            }
        }else{
            $status = 250;
            $msg    = __('地址选择有误');
        }
        $data = array();

        return $this->data->addBody(-140, $data, $msg, $status);

    }
//	public function addShopCompany()
//	{
//
//
//		$user_id   = Perm::$userId;
//		$cond_row  = array("user_id" => $user_id);
//		$shop_info = $this->shopBaseModel->getBaseOneList($cond_row);
//
//		if (empty($shop_info))
//		{
//            $shop_company['shop_license_type']      = request_int('shop_license_type');
//			$shop_company['shop_company_name']      = request_string('shop_company_name');
//			$shop_company['shop_company_address']   = request_string('shop_company_address');
//			$shop_company['company_address_detail'] = request_string('company_address_detail');
//			$shop_company['company_phone']          = request_string('company_phone');
//			$shop_company['company_employee_count'] = request_string('company_employee_count');
//
//			$shop_company['company_registered_capital']   = request_string('company_registered_capital');
//			$shop_company['contacts_name']                = request_string('contacts_name');
//			$shop_company['contacts_phone']               = request_string('contacts_phone');
//			$shop_company['contacts_email']               = request_string('contacts_email');
//			$shop_company['business_id']                  = request_string('business_id');
//			$shop_company['business_license_location']    = request_string('business_license_location');
//			$shop_company['business_license_electronic']  = request_string('business_license_electronic');
//			$shop_company['business_licence_start']       = request_string('business_licence_start');
//			$shop_company['business_licence_end']         = request_string('business_licence_end');
//			$shop_company['organization_code']            = request_string('organization_code');
//			$shop_company['organization_code_electronic'] = request_string('organization_code_electronic');
//			$shop_company['general_taxpayer']             = request_string('general_taxpayer');
//
//            if(request_int('street_id')){
//                $district_id = request_int('street_id');
//            }else{
//                if(request_int('area_id')){
//                    $district_id = request_int('area_id');
//                }else{
//                    $district_id = request_int('city_id');
//                }
//            }
//            //检查$district_id是否到最底层
//            $Base_DistrictModel = new Base_DistrictModel();
//            $check_district = $Base_DistrictModel->getDistrictList(array('district_parent_id'=>$district_id));
//            //开启事物
//			$this->messageModel->sql->startTransactionDb();
//            if($check_district['records'] > 0){
//                $flag1 = false;
//                $flag = false;
//            }else{
//
//                $flag = $this->shopCompanyModel->addCompany($shop_company, TRUE);
//
//                $shop_base['district_id'] = $district_id;
//                $shop_base['shop_id']   = $flag;
//                $shop_base['user_id']   = Perm::$userId;
//                $shop_base['user_name'] = Perm::$row['user_account'];
//                $flag1                  = $this->shopBaseModel->addBase($shop_base);
//
//                /*$shop_base['district_id'] = $district_id;
//                $shop_base['user_id']   = Perm::$userId;
//                $shop_base['user_name'] = Perm::$row['user_account'];
//                $flag1                  = $this->shopBaseModel->addBase($shop_base,true);
//
//                if($flag1)
//                {
//                    $shop_company['shop_id']   = $flag1;
//                    $flag = $this->shopCompanyModel->addBase($shop_company);
//                }*/
//
//            }
//			if ($flag1 && $flag && $this->messageModel->sql->commitDb())
//			{
//				$status = 200;
//				$msg    = _('success');
//			}
//			else
//			{
//				$this->messageModel->sql->rollBackDb();
//				$status = 260;
//				$msg    = _($flag1);
//			}
//		}
//		else
//		{
//			$status = 250;
//			$msg    = _('请勿重复提交！');
//		}
//		$data = array();
//
//		$this->data->addBody(-140, $shop_base, $msg, $status);
//
//	}
    /**
     * 获取添加店铺时所需要的request数据
     * @param type $apply
     * @return array
     */
    public function getShopRequest($apply){
        //验证格式
        $shop_company = array();
        $data = array();
        $contacts_email = request_string('contacts_email');
        $contacts_phone = request_string('contacts_phone');
        $phone_verify  = request_string('phone_verify');
        $email_verify = request_string('email_verify');


        if(!preg_match('/^[1][0-9]{10}$/', $contacts_phone)){
            $data['msg'] = '手机号码有误';
            $data['status'] = 250;
            return $data;
        }
        if(!preg_match("/^[0-9a-zA-Z]+@(([0-9a-zA-Z]+)[.])+[a-z]{2,4}$/",$contacts_email )){
            $data['msg'] = '邮箱有误';
            $data['status'] = 250;
            return $data;
        }

        $config_cache = YLB_Registry::get('config_cache');
        $Cache_Lite   = new Cache_Lite_Output($config_cache['default']);
        $user_code_email = $Cache_Lite->get($contacts_email);
        $user_code_phone = $Cache_Lite->get($contacts_phone);
        if($email_verify != $user_code_email){
            $data['msg'] = '邮箱验证码有误';
            $data['status'] = 250;
            return $data;
        }
        if($phone_verify != $user_code_phone){
            $data['msg'] = '手机验证码有误';
            $data['status'] = 250;
            return $data;
        }

        //非公共数据
        if($apply == 1){
            $shop_company['shop_company_name']      = '';
            $shop_company['company_phone']          = '';
            $shop_company['company_employee_count'] = 0;
            $shop_company['company_registered_capital']   = 0;
            $shop_company['legal_identity_type'] = request_string('legal_identity_type'); //证件类型
            $shop_company['business_license_location']    = '';
            $shop_company['legal_person']                = request_string('contacts_name');
            $shop_company['legal_person_number'] = request_string('business_id');
            if(!$shop_company['legal_person_number']){
                $data['msg'] = '证件号码有误';
                $data['status'] = 250;
                return $data;
            }
            $shop_company['legal_person_electronic']  = request_string('user_identity_face_logo'); //
            $shop_company['legal_person_electronic2']  = request_string('user_identity_font_logo');
            if(!$shop_company['legal_person_electronic2'] || !$shop_company['legal_person_electronic']){
                $data['msg'] = '证件照上传失败';
                $data['status'] = 250;
                return $data;
            }
        }else if($apply == 2){
            $shop_company['shop_company_name']      = request_string('shop_company_name');
            if(!$shop_company['shop_company_name']){
                $data['msg'] = '公司名称有误';
                $data['status'] = 250;
                return $data;
            }
            $shop_company['company_phone']          = request_string('company_phone');
            $shop_company['company_employee_count'] = request_string('company_employee_count');
            $shop_company['business_id']                  = request_string('business_id');
            if(!$shop_company['business_id']){
                $data['msg'] = '证件号码有误';
                $data['status'] = 250;
                return $data;
            }
            $shop_company['business_license_electronic']  = request_string('business_license_electronic');
            $shop_company['company_registered_capital']   = request_string('company_registered_capital');
            $shop_company['business_license_location']    = request_string('business_license_location');
            $shop_company['organization_code']            = request_string('organization_code');
            $shop_company['organization_code_electronic'] = request_string('organization_code_electronic');
            $shop_company['general_taxpayer']             = request_string('general_taxpayer');
        }else{
            $data['msg'] = '数据有误';
            $data['status'] = 250;
            return $data;
        }

        //公共数据
        $shop_company['contacts_phone']               = $contacts_phone;
        $shop_company['contacts_email']               = $contacts_email;
        $shop_company['shop_company_address']   = request_string('shop_company_address');
        $shop_company['company_address_detail'] = request_string('company_address_detail');
        $shop_company['contacts_name']                = request_string('contacts_name');

        $shop_company['business_licence_start']       = request_string('business_licence_start');
        $shop_company['business_licence_end']         = request_string('business_licence_end');

        $data['msg'] = '数据获取成功';
        $data['status'] = 200;
        $data['data'] = $shop_company;

        return $data;

    }
	//修改公司信息
	public function editShopCompany()
    {
        $shop_id = request_string('shop_id');

        if (request_string('type') == 'edit') {
            $shop_company['shop_license_type'] = request_int('shop_license_type');
            $shop_company['shop_company_name'] = request_string('shop_company_name');
            $shop_company['shop_company_address'] = request_string('shop_company_address');
            $shop_company['company_address_detail'] = request_string('company_address_detail');
            $shop_company['company_phone'] = request_string('company_phone');
            $shop_company['company_employee_count'] = request_string('company_employee_count');
            $shop_company['company_registered_capital'] = request_string('company_registered_capital');
            $shop_company['contacts_name'] = request_string('contacts_name');
            $shop_company['contacts_phone'] = request_string('contacts_phone');
            $shop_company['contacts_email'] = request_string('contacts_email');
            $shop_company['business_id'] = request_string('business_id');
            $shop_company['business_license_location'] = request_string('business_license_location');
            $shop_company['business_license_electronic'] = request_string('business_license_electronic');
            $shop_company['business_licence_start'] = request_string('business_licence_start');
            $shop_company['business_licence_end'] = request_string('business_licence_end');
            $shop_company['organization_code'] = request_string('organization_code');
            $shop_company['organization_code_electronic'] = request_string('organization_code_electronic');
            $shop_company['general_taxpayer'] = request_string('general_taxpayer');
        }else{
            $shop_company['bank_account_name']                       = request_string('bank_account_name');
            $shop_company['bank_account_number']                     = request_string('bank_account_number');
            $shop_company['bank_name']                               = request_string('bank_name');
            $shop_company['bank_code']                               = request_string('bank_code');
            $shop_company['bank_address']                            = request_string('bank_address');
            $shop_company['bank_licence_electronic']                 = request_string('bank_licence_electronic');
            $shop_company['taxpayer_id']                             = request_string('taxpayer_id');
            $shop_company['tax_registration_certificate']            = request_string('tax_registration_certificate');
            $shop_company['tax_registration_certificate_electronic'] = request_string('tax_registration_certificate_electronic');
            $shop_company['tax_code']                                = request_string('tax_code');
            $shop_company['taxpayer_type']                           = request_string('taxpayer_type');
        }

        //开启事物
        $this->shopCompanyModel->sql->startTransactionDb();
        $flag = $this->shopCompanyModel->editCompany($shop_id, $shop_company);
        $flag1 = $this->shopBaseModel->editBase($shop_id, array('shop_status'=>5));

        $rs_rows = array();
        check_rs($flag, $rs_row);
        check_rs($flag1, $rs_row);

        if (is_ok($rs_row) && $this->shopCompanyModel->sql->commitDb())
        {
            $status = 200;
            $msg    = _('success');
        }
        else
        {
            $this->shopCompanyModel->sql->rollBackDb();
            $status = 250;
            $msg    = _('failure');
        }

		$data = array();

		$this->data->addBody(-140, $data, $msg, $status);

	}
    //修改店铺经营信息
    public function  editShoping(){
        $shopGradeModel = new Shop_GradeModel();
        $shop_id = request_int('shop_id');
        $shop_list['shop_grade_id'] = request_int('shop_grade_id');
        $shop_list['shop_name'] = request_string("shop_name");
        $shop_company['company_uname'] = request_string("company_uname");
        $shop_company['company_uphone'] = request_int("company_uphone");
        $shop_company['company_uemail'] = request_string("company_uemail");
        $shop_company['company_uqq'] = request_int("company_uqq");
        $shop_company['company_ucall'] = request_string("company_ucall");

        $shop_company['shop_uname'] = request_string("shop_uname");
        $shop_company['shop_uphone'] = request_int("shop_uphone");
        $shop_company['shop_uemail'] = request_string("shop_uemail");
        $shop_company['shop_uqq'] = request_int("shop_uqq");
        $shop_company['shop_ucall'] = request_string("shop_ucall");

        $shop_company['run_uname'] = request_string("run_uname");
        $shop_company['run_uphone'] = request_int("run_uphone");
        $shop_company['run_uemail'] = request_string("run_uemail");
        $shop_company['run_uqq'] = request_int("run_uqq");
        $shop_company['run_ucall'] = request_string("run_ucall");

        $shop_company['after_uname'] = request_string("after_uname");
        $shop_company['after_uphone'] = request_int("after_uphone");
        $shop_company['after_uemail'] = request_string("after_uemail");
        $shop_company['after_uqq'] = request_int("after_uqq");
        $shop_company['after_ucall'] = request_string("after_ucall");

        $res = $this->shopCompanyModel->editCompany(array('shop_id' => $shop_id),$shop_company);

        if ($shop_list['shop_grade_id']) {

            $shop_grade = $shopGradeModel->getOne($shop_list['shop_grade_id']);
            if ($shop_grade) {
                $shop_type = $shop_grade['shop_grade_name'];
            }

            $shop_grade_data = $shopGradeModel->listByWhere();
            if ($shop_grade_data) {
                foreach ($shop_grade_data['items'] as $key => $value) {
                    if (strpos($shop_list['shop_name'], $value['shop_grade_name'])) {
                        $shop_list['shop_name'] = str_replace($value['shop_grade_name'], '', $shop_list['shop_name']);
                    }
                }
            }

            $shop_list['shop_name'] .= $shop_type;
        }
        $shop_list['joinin_year']      = request_int('joinin_year');
        $shop_list['shop_end_time']    = date("Y-m-d H:i:s", strtotime(" $shop_list[shop_create_time] + $shop_list[joinin_year] year"));

        $flag = $this->shopBaseModel->editBase($shop_id, $shop_list);

        if($flag){
            $status = 200;
            $msg    = _('success');
        }else{
            $status = 250;
            $msg    = _('failure');
        }
        $data = array();

        $this->data->addBody(-140, $data, $msg, $status);
    }
	//修改店铺信息
	public function editShopBase()
    {

        $shopGradeModel = new Shop_GradeModel();
        $shop_id = request_int('shop_id');
//        $shop_list['shop_grade_id'] = request_int('shop_grade_id');
        $shop_list['shop_name'] = request_string("shop_name");
//        $shop_company['company_uname'] = request_string("company_uname");
//        $shop_company['company_uphone'] = request_int("company_uphone");
//        $shop_company['company_uemail'] = request_string("company_uemail");
//        $shop_company['company_uqq'] = request_int("company_uqq");
//        $shop_company['company_ucall'] = request_string("company_ucall");
//
//        $shop_company['shop_uname'] = request_string("shop_uname");
//        $shop_company['shop_uphone'] = request_int("shop_uphone");
//        $shop_company['shop_uemail'] = request_string("shop_uemail");
//        $shop_company['shop_uqq'] = request_int("shop_uqq");
//        $shop_company['shop_ucall'] = request_string("shop_ucall");
//
//        $shop_company['run_uname'] = request_string("run_uname");
//        $shop_company['run_uphone'] = request_int("run_uphone");
//        $shop_company['run_uemail'] = request_string("run_uemail");
//        $shop_company['run_uqq'] = request_int("run_uqq");
//        $shop_company['run_ucall'] = request_string("run_ucall");
//
//        $shop_company['after_uname'] = request_string("after_uname");
//        $shop_company['after_uphone'] = request_int("after_uphone");
//        $shop_company['after_uemail'] = request_string("after_uemail");
//        $shop_company['after_uqq'] = request_int("after_uqq");
//        $shop_company['after_ucall'] = request_string("after_ucall");

        $shop_company['band_type'] = request_int("band_type");
        $shop_company['self_owned'] = request_string("self_owned");
        $shop_company['self_owned_band'] = request_string("self_owned_band");
        $shop_company['self_owned_authorization'] = request_string("self_owned_authorization");

        $shop_company['agency_brand_licensing'] = request_string("agency_brand_licensing");
        $shop_company['agency_bank_address'] = request_string("agency_bank_address");
        $shop_company['agency_band_address_detail'] = request_string("agency_band_address_detail");
        $shop_company['band_company_call'] = request_string("band_company_call");
        $shop_company['band_start_time'] = request_string("band_start_time");
        $shop_company['band_end_time'] = request_string("band_end_time");
        $shop_company_class['shop_company_class'] = request_int('shop_company_class');
        $shop_company_class['shop_id'] = request_int('shop_id');
        $shop_company_class['shop_name'] = request_string("shop_name");

        switch (request_int('shop_company_class')){
            case '1':
                $shop_company_class['manufacture_food_id'] = request_int('manufacture_food_id');
                $shop_company_class['food_licence_img'] = request_string('food_licence_img');
                $shop_company_class['nationwide_food_licence_img'] = request_string('nationwide_food_licence_img');
                $shop_company_class['manufacture_licence_img'] = request_string('manufacture_licence_img');
                $shop_company_class['food_run_id'] = request_int('food_run_id');
                $shop_company_class['food_run_licence_img'] = request_string('food_run_licence_img');
                break;
            case '2':
                $shop_company_class['nationwide_appliances_licence_id'] = request_int('nationwide_appliances_licence_id');
                $shop_company_class['nationwide_appliances_img'] = request_string('nationwide_appliances_img');
                $shop_company_class['c3_business_license_id'] = request_int('c3_business_license_id');
                $shop_company_class['c3_business_license_img'] = request_string('c3_business_license_img');
                break;
            case '3':
                $shop_company_class['cosmetics_licence_id'] = request_int('cosmetics_licence_id');
                $shop_company_class['cosmetics_licence_img'] = request_string('cosmetics_licence_img');
                $shop_company_class['not_cosmetics_record'] = request_string('not_cosmetics_record');
                $shop_company_class['not_cosmetics_record_img'] = request_string('not_cosmetics_record_img');
                break;
            case '4':
                $shop_company_class['mon_child_food_id'] = request_int('mon_child_food_id');
                $shop_company_class['mon_child_food_img'] = request_string('mon_child_food_img');
                break;
            case '5':
                $shop_company_class['import_food_id'] = request_int('import_food_id');
                $shop_company_class['import_food_img'] = request_string('import_food_img');
                $shop_company_class['disease_inspection_img'] = request_string('disease_inspection_img');
                break;
            case '6':
                $shop_company_class['drinks_registration_id'] = request_int('drinks_registration_id');
                $shop_company_class['drinks_registration_img'] = request_string('drinks_registration_img');
                break;
            case '7':
                $shop_company_class['disinfect_licence_id'] = request_int('disinfect_licence_id');
                $shop_company_class['disinfect_licence_img'] = request_string('disinfect_licence_img');
                break;

        }
        if($shop_company_class){
            $shop_company_class_row = $this->shopCompanyClassModel->addCompany_Class($shop_company_class);
        }

//        if ($shop_list['shop_grade_id']) {
//
//            $shop_grade = $shopGradeModel->getOne($shop_list['shop_grade_id']);
//            if ($shop_grade) {
//                $shop_type = $shop_grade['shop_grade_name'];
//            }
//
//            $shop_grade_data = $shopGradeModel->listByWhere();
//            if ($shop_grade_data) {
//                foreach ($shop_grade_data['items'] as $key => $value) {
//                    if (strpos($shop_list['shop_name'], $value['shop_grade_name'])) {
//                        $shop_list['shop_name'] = str_replace($value['shop_grade_name'], '', $shop_list['shop_name']);
//                    }
//                }
//            }
//
//            $shop_list['shop_name'] .= $shop_type;
//        }
        $shopCompany = $this->shopCompanyModel->getOneByWhere(array('shop_id' => $shop_id));

        $shop_base = $this->shopBaseModel->getShopDetail(array('shop_id' => $shop_id));

        if (request_string("type") == 'bc') {

            if ($shopCompany['bc_shop_status'] != 1) {
                $shop_company['bc_shop_status'] = 1;
            }
            if ($shop_base['shop_status'] != 0) {
                $shop_list['shop_status'] = 0;
            }
            if ($shop_base['shop_payment'] != 0) {
                $shop_list['shop_payment'] = 0;
            }
            $shop_class['shop_class_bind_enable'] = 1;

        }elseif(request_string("type") == 'xg'){
            $shop_company['bc_shop_status'] = 2;
            if ($shop_base['shop_payment'] != 0) {
                $shop_list['shop_payment'] = 0;
            }
            $shop_list['shop_status']       = 6;
            $shop_list['shop_create_time']  = get_date_time();
            $shop_list['shop_settlement_last_time'] = get_date_time();
            $shop_class['shop_class_bind_enable'] = 2;
        }else{
            $shop_company['bc_shop_status'] = 2;
            $shop_list['shop_status']      = 1;
            $shop_list['shop_create_time'] = get_date_time();
            $shop_list['shop_settlement_last_time'] = get_date_time();
            $shop_class['shop_class_bind_enable'] = 2;
        }

        $shop_list['joinin_year']      = request_int('joinin_year');
		$shop_list['shop_class_id']    = request_int('shop_class_id');
		$product_class_id              = request_row('product_class_id');
		$commission_rate               = request_row('commission_rate');
        $res = $this->shopCompanyModel->editCompany(array('shop_id' => $shop_id),$shop_company);

		$shop_list['shop_end_time']    = date("Y-m-d H:i:s", strtotime(" $shop_list[shop_create_time] + $shop_list[joinin_year] year"));
		$flag = $this->shopBaseModel->editBase($shop_id, $shop_list);

		foreach ($product_class_id as $key => $value)
		{
			$shop_class['product_class_id']       = $value;
			$shop_class['commission_rate']        = $commission_rate[$key];
			$shop_class['shop_id']                = $shop_id;
			$flag1                                = $this->shopClassBindModel->addClassBind($shop_class);
		}


		if ($flag !== FALSE)
		{
            /**
            *  统计中心
            *  添加统计代码
            */
            $shop_info = $this->shopCompanyModel->getCompany($shop_id);
            $analytics_data = array(
                'shop_id'=>$shop_id,
                'area'=>$shop_info[$shop_id]['shop_company_address'],
                'shop_name'=>$shop_list['shop_name'],
                'date'=>$shop_list['shop_create_time']
            );
	    
            YLB_Plugin_Manager::getInstance()->trigger('analyticsShopAdd',$analytics_data);
            /****************************************************/
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

	public function shopCatBind()
	{
		$cat_id   = request_int("cat_id");
		$data     = $this->goodsCatModel->getCatParent($cat_id);
		$cat_list = $this->goodsCatModel->getOne($cat_id);
		$data[]   = $cat_list;
		if ($data)
		{
			$status = 200;
			$msg    = _('success');
		}
		else
		{
			$status = 250;
			$msg    = _('failure');
		}
		$this->data->addBody(-140, $data, $msg, $status);

	}

	public function shopPaystatus()
	{

		$shop_id                              = request_int('shop_id');
		$shop_list['payment_voucher']         = request_string("payment_voucher");
		$shop_list['payment_voucher_explain'] = request_string('payment_voucher_explain');
        $shop_list['bc_shop_status']          = 4;
		$shop_base['shop_payment']            = 1;
		//开启事物
		$SellerBaseModel = new Seller_BaseModel();
		$this->messageModel->sql->startTransactionDb();

        $flag = $this->shopBaseModel->editBase($shop_id, $shop_base);

        $flag1 = $this->shopCompanyModel->editCompany($shop_id, $shop_list);

                //添加二级域名
                //平台设置二级域名
		$Web_ConfigModel = new Web_ConfigModel();
		$shop_domain     = $Web_ConfigModel->getByWhere(array('config_type' => 'domain'));
                $domain['shop_id'] = $shop_id;
                $domain['shop_edit_domain'] = $shop_domain['domain_modify_frequency']['config_value'];
                $domain['shop_self_domain'] = $shop_domain['retain_domain']['config_value'];

//                //初始化用户的二级域名
                $Shop_DomainModel = new Shop_DomainModel();
                //查找是否添加过用户二级域名
                $shop_domain_row = $Shop_DomainModel->getOne(array('shop_id'=>$shop_id));
                //如果没有添加过就添加 如果添加过删除再添加
                if(!$shop_domain_row){

                    $flag2 = $Shop_DomainModel->addDomain($domain);

                }else{

                    $flag2_1 = $Shop_DomainModel->removeDomain(array('shop_id'=>$shop_id));

                    if($flag2_1){

                        $flag2 = $Shop_DomainModel->addDomain($domain);

                    }
                }

		//添加卖家
		$seller_base['shop_id']         = $shop_id;
		$seller_base['user_id']         = Perm::$userId;
		$seller_base['seller_name']     = Perm::$row['user_account'];
		$seller_base['seller_is_admin'] = 1;
         $seller_add = $SellerBaseModel->addBase($seller_base);

            if ($flag && $flag1 && $seller_add && $flag2 && $this->messageModel->sql->commitDb())
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
     *  获取实名认证
     */
    public function getCertification(){

        //从paycenter中获取用户的实名认证信息
        $key = YLB_Registry::get('paycenter_api_key');
        $url = YLB_Registry::get('paycenter_api_url');
        $app_id = YLB_Registry::get('paycenter_app_id');

        $formvars = array();
        $formvars['app_id'] = $app_id;
        $formvars['user_id'] = Perm::$userId;
        $rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_User_Info&met=getUserInfos&typ=json', $url), $formvars);
        return $rs;
    }

    /**
     *  返回当前用的的入驻进度
     *  notice: $shop_step_info['contacts_phone'] 有值，说明应填写完个人信息或企业信息（当前pstep2,step2），
     *  如果$shop_step_info['bank_name']有值，说明已填写银行资质（当前pstep2,step2）
     */
    private function _getStep($shop_step_info,$res){

        if(!$shop_step_info){

            $url = YLB_Registry::get('url');
            return array('status'=>250,'url'=>$url,'msg'=>'请重新登录');
        }

        //店铺状态： 0:关闭, 1:待审核资料 ，2:待审核付款 ，3：开店成功 ，4：审核资料未通过，5：银行资质审核未通过，6，店铺资料审核未通过，7，付款审核未通过，8，提交个人资料,9，提交银行信息
        switch ($shop_step_info['shop_status']){
            case 0:
                if($shop_step_info['shop_name']){
                    $apply = '';
                    $op = '';
                    $msg = '店铺已关闭';
                }else{
                    //重新填写入驻信息
                    if($shop_step_info['shop_business'] == 1){
                        $apply = 2; //企业
                        $op = 'step2';
                    }else{
                        $apply = 1; //个人
                        $op = 'pstep2';
                    }
                    $msg = '请填写入驻信息';
                }
                break;
            case 1:
                if($shop_step_info['shop_business'] == 1 ){
                    $apply = 2; //企业
                    $op = 'step5';
                }else{
                    $apply = 1; //个人
                    $op = 'step5';
                }
                $msg = '待审核资料';
                break;
            case 2:
                $apply = '';
                $op = 'step5';
                $msg = '待审核付款';
                break;
            case 3:
                $op = '';
                $apply = '';
                $msg = '开店成功';
                break;
            case 4:
                if($shop_step_info['shop_business'] == 1 ){
                    $apply = 2; //企业
                    $op = 'step2';
                }else{
                    $apply = 1; //个人
                    $op = 'pstep2';
                }
                $msg = '个人（公司）资料未通过审核';
                break;
            case 5:
                if($shop_step_info['shop_business'] == 1 && $res == 'new'){
                    $apply = 2; //企业
                    $op = 'step7';
                }else if($shop_step_info['shop_business'] == 1) {
                    $apply = 2; //企业
                    $op = 'step4';
                }else{
                    $apply = 1; //个人
                    $op = 'step4';
                }
                $msg = '开户银行信息未通过审核';
                break;
            case 9:
                if($shop_step_info['shop_business'] == 1 ){
                    $apply = 2; //企业
                    $op = 'step3';
                }else{
                    $apply = 1; //个人
                    $op = 'pstep3';
                }
                $msg = '提交个人信息';
                break;
            default :
                if($shop_step_info['shop_business'] == 1 ){
                    $apply = 2; //企业
                    $op = 'step2';
                }else{
                    $apply = 1; //个人
                    $op = 'pstep2';
                }
                $msg = '请填写入驻信息';
                break;
        }

        $url = YLB_Registry::get('url').'/index.php?ctl=Seller_Shop_Settledd&met=index&op='.$op.'&apply='.$apply;

        return array('status'=>$shop_step_info['shop_status'],'url'=>$url,'msg'=>$msg,'step'=>$op);

    }

    /**
     * 获取返回的步骤
     * 判断是否可以返回上一步
     */
    private function _getRpStep($shop_step_info){
        if(!$shop_step_info){
            $url = YLB_Registry::get('base_url');
            return array('status'=>false);
        }

        //店铺状态： 0:关闭, 1:待审核资料 ，2:待审核付款 ，3：开店成功 ，4：审核资料未通过，5：银行资质审核未通过，6，店铺资料审核未通过，7，付款审核未通过，8，提交个人资料,9，提交银行信息
        $status = true;
        switch ($shop_step_info['rp']){
            case 'step0':
                //1.没有入驻信息，2.支持所有的入驻
            case 'step1':
                //没有入驻信息，仅支持单方面入驻，如果支持所有入驻，就退到step0
                if($shop_step_info['shop_status'] == '-1'){
                    if(Web_ConfigModel::value('join_type') == 3){
                        $op = 'step0';
                    }else{
                        $op = 'step1';
                    }
                }else{
                    $status = false;
                }
                break;
            case 'step2':
                //1. 企业入驻 2. shop_status in 4,5,6,7,8,9
            case 'pstep2':
                //1. 个人入驻 2. shop_status in 4,5,6,7,8,9
                if(in_array($shop_step_info['shop_status'],array(4,5,6,7,8,9))){
                    if($shop_step_info['shop_business'] == 1){
                        $op = 'step2';
                    }else{
                        $op = 'pstep2';
                    }
                }else{
                    $status = false;
                }

                break;
            case 'step3':
                //1. 企业入驻 2. shop_status in 4,5,6,7,8,9

            case 'pstep3':
                //1. 个人入驻 2. shop_status in 4,5,6,7,8,9
                if(in_array($shop_step_info['shop_status'],array(4,5,6,7,8,9))){
                    if($shop_step_info['shop_business'] == 1){
                        $op = 'step3';
                    }else{
                        $op = 'pstep3';
                    }
                }else{
                    $status = false;
                }
                break;
            case 'step4':
                //1. shop_status in 4,5,6,7,8,9
                if(in_array($shop_step_info['shop_status'],array(4,5,6,7,9))){
                    $op = 'step4';
                }else{
                    $status = false;
                }
                break;
            case 'step5':
                //1. shop_status == 7
                if($shop_step_info['shop_status'] == 7){
                    $op = 'step5';
                }else{
                    $status = false;
                }
                break;

            default :
                $status = false;
                break;
        }
        return array('status'=>$status,'step'=>$op);
    }

    /**
     *  获取当前用户的入驻进度
     */
    public function getstepurl(){
        $user_id = Perm::$userId;
        if(!$user_id){
            $url = YLB_Registry::get('url');
            $step_info = array('status'=>250,'url'=>$url,'msg'=>__('请重新登录'));
        }else{
            $shopBaseModel = new Shop_BaseModel();
            $shop_base_info = $shopBaseModel->getBaseOneList(array("user_id" => $user_id));
            if($shop_base_info){
                $shopCompanyModel = new Shop_CompanyModel();
                $shop_company_info_list = $shopCompanyModel->getCompany($shop_base_info['shop_id']);
                if(is_array($shop_company_info_list) && $shop_company_info_list){
                    $shop_company_info = array_shift($shop_company_info_list);
                }
                $shop_step_info = array(
                    'contacts_phone'=> isset($shop_company_info['contacts_phone']) ?  $shop_company_info['contacts_phone'] : '',
                    'bank_name'=>isset($shop_company_info['bank_name']) ?  $shop_company_info['bank_name'] : '',
                    'shop_business'=> isset($shop_base_info['shop_business']) ?  $shop_base_info['shop_business'] : '-1',
                    'shop_name'=>isset($shop_base_info['shop_name']) ?  $shop_base_info['shop_name'] : '',
                    'shop_status'=>isset($shop_base_info['shop_status']) ?  $shop_base_info['shop_status'] : '-1',
                    'user_id'=>$user_id
                );
                $step_info = $this->_getStep($shop_step_info);
            }else{
                //还没有入驻过
                if(Web_ConfigModel::value('join_type') == 3){
                    $op = 'step0';
                }else{
                    $op = 'step1';
                }
                $step_info = array(
                    'status'=>'-1',
                    'url' => YLB_Registry::get('url').'/index.php?ctl=Seller_Shop_Settledd&met=index&op='.$op,
                    'msg' => "请填写入驻信息",
                    'step' => $op
                );
            }


        }

        if($step_info['status'] != 250){
            $this->data->addBody(-140, $step_info, 'success', 200);
        }else{
            $this->data->addBody(-140, $step_info, 'failure', 250);
        }

    }

    /**
     *  获取店铺地区
     */
    public function _getShopDistrict($shop_company_address = ''){

//        $shop_company_address = '陕西 西安市 临潼区 相桥镇';
        $shop_company_address = trim($shop_company_address);
        $district_model = new Base_DistrictModel();

        $district_info = $district_model->getDistrictDetailByName($shop_company_address);

        if(!$district_info){
            return $district_info;
        }
        $district_list = array();
        foreach ($district_info as $value){
            $district_list[$value['district_is_level']] = $district_model->getByWhere(array('district_parent_id'=>$value['district_parent_id']));
        }
        $data = array();
        $data['district_list'] = $district_list;
        $data['district_info'] = $district_info;

        return $data;

    }


}