<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     Banchangle
 */
class Seller_Shop_SettledCtl extends Seller_Controller
{
	public $messageModel       = null;
	public $shopBaseModel      = null;
	public $chainBaseModel     = null;
	public $shopClassModel     = null;
	public $shopGradeModel     = null;
	public $shopTemplateModel  = null;
	public $shopCompanyModel   = null;
	public $goodsCatModel      = null;
	public $shopClassBindModel = null;
	public $sellerBaseModel    = null;

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
		$this->chainBaseModel     = new Chain_BaseModel();
		$this->shopClassModel     = new Shop_ClassModel();
		$this->shopGradeModel     = new Shop_GradeModel();
		$this->shopTemplateModel  = new Shop_TemplateModel();
		$this->shopCompanyModel   = new Shop_CompanyModel();
		$this->messageModel       = new MessageModel();
		$this->goodsCatModel      = new Goods_CatModel();
		$this->shopClassBindModel = new Shop_ClassBindModel();
		$this->sellerBaseModel	  = new Seller_BaseModel();
	}

	public function index()
	{
		if (Perm::checkUserPerm())
		{
            if($this->shop_base)
            {
                $shop_info = $this->shop_base;
            }
            else
            {
                $shop_info = $this->shopBaseModel->getOneByWhere(['user_id'=>Perm::$userId]);
            }

            if($shop_info && $shop_info['shop_status'] == Shop_BaseModel::SHOP_STATUS_OPEN)
            {
                location_to(YLB_Registry::get('url') . '?ctl=Seller_Index&met=index');
                die;
            }

            //获取一级地址
            $baseDistrictModel  = new Base_DistrictModel();
            $district           = $baseDistrictModel->getDistrictTree(0);

            if(isset($shop_info['shop_business']) && $shop_info['shop_business'] == 1)
            {
               $apply = 2;
            }
            else if(isset($shop_info['shop_business']) && $shop_info['shop_business'] == 0)
            {
               $apply = 1;
            }
            else if(!isset($shop_info['shop_business']) && Web_ConfigModel::value('join_type') == 1)
            {
                $apply = 2;
            }
            else if(!isset($shop_info['shop_business']) && Web_ConfigModel::value('join_type') == 2)
            {
                $apply = 1;
            }
            else
            {
                $apply = request_int('apply');
            }

            if($apply == 1)
            {
                $apply_tips = array(
                    '0'=>'个人入驻申请',
                    '1'=>'个人信息提交',
                    '2'=>'个人缴纳费用',
                    '3'=>'个人实名信息',
                    '4'=>'下一步，填写个人资质信息'
                );
                $shop_business = 0;
            }
            else
            {
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

            $shop_step_info = array(
                'contacts_phone'=> isset($shop_company['contacts_phone']) ?  $shop_company['contacts_phone'] : '',
                'bank_name'=>isset($shop_company['bank_name']) ?  $shop_company['bank_name'] : '',
                'shop_name'=>isset($shop_info['shop_name']) ?  $shop_info['shop_name'] : '',
                'shop_business'=> isset($shop_info['shop_business']) ?  $shop_info['shop_business'] : $shop_business,
                'shop_status'=>isset($shop_info['shop_status']) ?  $shop_info['shop_status'] : '-1',
                'step'=> $op
            );

            $ShopHelpModel = new Shop_HelpModel();

            if($op)
			{
                //实名认证
				$rs = $this->getCertification();

				if($rs['status'] != 200 || $rs['data']['user_identity_statu'] != 2)
				{
				    //如果没有实名认证 跳转
					location_to(YLB_Registry::get('paycenter_api_url').'?ctl=Info&met=certification&typ=e');
					die;
				}
				else if(!$rs['data']['user_mobile'])
                {
                    //如果没有绑定手机 跳转
                }

                if($shop_step_info['shop_status'] == '-1' && in_array($op, array('step0','step1')))
                {
                    //没有入驻过
                    $page = $op;
                }
                else
                {
                    $rp = request_string('rp');
                    if($rp)
                    {
                        //回退
                        $shop_step_info['rp'] = $rp;
                        $pageInfo = $this->_getRpStep($shop_step_info);
                        if(!$pageInfo['status'])
                        {
                            $pageInfo = $this->_getStep($shop_step_info);
                        }
                    }
                    else
                    {
                        $pageInfo = $this->_getStep($shop_step_info);
                    }
                    $page = $pageInfo['step'];
                    if($page == '')
                    {
                        $page = $op;
                    }
                }

                //数据获取
                if($page === 'step0')
                {
                    $shop_help  = $ShopHelpModel->getByWhere(array('page_show'=>1), array('help_sort' => "asc"));
                }
                else if($page === 'step1')
                {
                    $shop_help  = $ShopHelpModel->getByWhere(array('page_show'=>2), array('help_sort' => "asc"));
                }
                else if($page === 'step2' || $page === 'pstep2')
                {
                    /*if($rs['data']['user_realname'])
                    {
                        $shop_company['contacts_name'] = $rs['data']['user_realname'];
                    }
                    if($rs['data']['user_mobile'])
                    {
                        $shop_company['contacts_phone'] = $rs['data']['user_mobile'];
                    }
                    if($rs['data']['user_identity_face_logo'])
                    {
                        $shop_company['legal_person_electronic'] = $rs['data']['user_identity_face_logo'];
                    }
                    if($rs['data']['user_identity_font_logo'])
                    {
                        $shop_company['legal_person_electronic2'] = $rs['data']['user_identity_font_logo'];
                    }*/

                    if($shop_company)
                    {
                        $district_info = $this->_getShopDistrict($shop_company['shop_company_address']);
                    }

                    if($page === 'step2')
                    {
                        if($shop_company)
                        {
                            $yingye_district_info = $this->_getShopDistrict($shop_company['business_license_location']);
                        }
                    }
                }
                else if($page === 'step3' || $page === 'pstep3')
                {
                    if($shop_company['bank_address'])
                    {
                        $bank_district_info = $this->_getShopDistrict($shop_company['bank_address']);
                    }
                }
                else if($page === 'step4')
                {
                    $shop_class_bind = $this->shopClassBindModel->listByWhere(array('shop_id'=>$shop_info['shop_id']));

                    if($shop_class_bind)
                    {
                        $all_cat_ids = array();
                        foreach ($shop_class_bind['items'] as $key=>$value)
                        {
                            $cat_data[$key]['items'] = $this->goodsCatModel->getCatParent($value['product_class_id']);
                            $cat_data[$key]['current_cat'] = $this->goodsCatModel->getOne($value['product_class_id']);

                            $all_cat_ids[] = $value['product_class_id'];
                            $all_cat_ids = array_merge($all_cat_ids,array_column($cat_data[$key]['items'],'cat_id'));
                        }
                    }

                    if($shop_company['agency_bank_address'])
                    {
                        $agency_district_info = $this->_getShopDistrict($shop_company['agency_bank_address']);
                    }

                    //开店所需证件
                    if($all_cat_ids)
                    {
                        //分类id去重
                        $all_cat_ids = array_unique($all_cat_ids);
                        $ShopCatCertificateModel = new Shop_CatCertificateModel();
                        $shop_cer_rows = $ShopCatCertificateModel->getShopCatCertificateII($all_cat_ids);

                        if($shop_company['certificate'])
                        {
                            foreach ($shop_cer_rows as $key=>$val)
                            {
                                if(array_key_exists($val['id'],$shop_company['certificate']))
                                {
                                    $shop_cer_rows[$key]['image'] = $shop_company['certificate'][$val['id']];
                                }
                            }
                        }
                    }
                }
            }
            else
            {
                $page = 'index';
                $shop_help  = $ShopHelpModel->getByWhere(array('page_show'=>1), array('help_sort' => "asc"));
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
     * 获取用户的入驻步骤
     *
     * @param string $step
     * @param $shop_info
     * @param $apply
     * @return string
     */
    public function getStepPage($step = 'index', $shop_info,$apply)
    {
        if($shop_info['contacts_phone'])
        {
            if($shop_info['bank_name'])
            {
                if($shop_info['shop_status'])
                {
                    $step = 'step5';
                }
                else
                {
                    $step = 'step4';
                }
            }
            else
            {
                $step = $apply == 1 ? 'pstep3' : 'step3';
            }
        }
        else
        {
            if($step === 'step2' && $apply === 1)
            {
                $step = 'pstep2';
            }
            if(in_array($step, array('step0','step1','step2','pstep2')) )
            {
                return $step;
            }
        }
        return $step;
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
        if($shop_company_data['status'] == 250)
        {
            return $this->data->addBody(-140, array(), $shop_company_data['msg'], 250);
        }
        $shop_company = $shop_company_data['data'];
        $shop_company['shop_company_address'] = trim($shop_company['shop_company_address']);
        if(request_int('street_id'))
        {
            $district_id = request_int('street_id');
        }
        else
        {
            if(request_int('area_id'))
            {
                $district_id = request_int('area_id');
            }
            else
            {
                $district_id = request_int('city_id');
            }
        }

        //检查$district_id是否到最底层
        $Base_DistrictModel = new Base_DistrictModel();
        $check_district = $Base_DistrictModel->getDistrictList(array('district_parent_id'=>$district_id));
        if(!$check_district['records'])
        {
            //开启事物
            $this->messageModel->sql->startTransactionDb();
            if (!$shop_info)
            {
                $flag = $this->shopCompanyModel->addCompany($shop_company, TRUE);
                $shop_base['district_id'] = $district_id;
                $shop_base['shop_id']   = $flag;
                $shop_base['shop_status']   = 8; //提交个人（企业）信息
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
            }
            else
            {
                //编辑
                foreach ($shop_company as $key=>$value)
                {
                    if($value === '')
                    {
                        unset($shop_company[$key]);
                    }
                }
                $flag = $this->shopCompanyModel->editCompany($shop_info['shop_id'], $shop_company);
                $flag1 = $this->shopBaseModel->editBase($shop_info['shop_id'], array('shop_status'=>8));
                $rs_rows = array();
                check_rs($flag, $rs_rows);
                check_rs($flag1, $rs_rows);
                if (is_ok($rs_rows) && $this->messageModel->sql->commitDb())
                {
                    $status = 200;
                    $msg    = _('success');
                }
                else
                {
                    $this->messageModel->sql->rollBackDb();
                    $status = 250;
                    $msg    = _('failure2');
                }
            }
        }
        else
        {
            $status = 250;
            $msg    = _('地址选择有误');
        }
		$data = array();

		return $this->data->addBody(-140, $data, $msg, $status);

	}

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
        //$user_code_email = $Cache_Lite->get($contacts_email);
        $user_code_phone = $Cache_Lite->get($contacts_phone);
        /*if($email_verify != $user_code_email){
            $data['msg'] = '邮箱验证码有误';
            $data['status'] = 250;
            return $data;
        }*/
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
            $shop_company['shop_license_type']      = request_int('shop_license_type');
            $shop_company['shop_company_name']      = request_string('shop_company_name');
            if(!$shop_company['shop_company_name']){
                $data['msg'] = '公司名称有误';
                $data['status'] = 250;
                return $data;
            }
			$shop_company['company_phone']          = request_string('company_phone');
			$shop_company['company_employee_count'] = request_string('company_employee_count');
            $shop_company['business_id']            = request_string('business_id');
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
        $shop_company['contacts_phone']         = $contacts_phone;
        $shop_company['contacts_email']         = $contacts_email;
        $shop_company['shop_company_address']   = request_string('shop_company_address');
        $shop_company['company_address_detail'] = request_string('company_address_detail');
        $shop_company['contacts_name']          = request_string('contacts_name');

        $shop_company['business_licence_start'] = request_string('business_licence_start');
        $shop_company['business_licence_end']   = request_string('business_licence_end');

        $data['msg'] = '数据获取成功';
        $data['status'] = 200;
        $data['data'] = $shop_company;
        return $data;

    }

    //修改公司信息
	public function editShopCompany()
	{
		$shop_id                                                 = request_string('shop_id');
		$shop_company['bank_account_name']                       = request_string('bank_account_name');
		$shop_company['bank_account_number']                     = request_string('bank_account_number');
		$shop_company['bank_name']                               = request_string('bank_name');
		$shop_company['bank_code']                               = request_string('bank_code');
		$shop_company['bank_address']                            = request_string('bank_address');
		$shop_company['bank_licence_electronic']                 = request_string('bank_licence_electronic');
		$shop_company['taxpayer_id']                             = request_string('taxpayer_id');
		$shop_company['tax_registration_certificate']            = request_string('tax_registration_certificate');
		$shop_company['tax_registration_certificate_electronic'] = request_string('tax_registration_certificate_electronic');

		//新加字段
        $shop_company['taxpayer_type']                           = request_string('taxpayer_type'); //纳税人类型 1一般纳税人 2小规模纳税人 3非增值税纳税人
        $shop_company['tax_code']                                = request_string('tax_code');      //纳税类型税码

        //开启事物
        $this->shopCompanyModel->sql->startTransactionDb();
		$flag = $this->shopCompanyModel->editCompany($shop_id, $shop_company);
        $flag1 = $this->shopBaseModel->editBase($shop_id, array('shop_status'=>9));
        $rs_row = array();
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

	//修改店铺信息
	public function editShopBase()
	{
		$shop_id                       = request_int('shop_id');
        $product_class_id              = request_row('product_class_id');
        $commission_rate               = request_row('commission_rate');

        $shop_list['shop_name']        = request_string("shop_name");
		$shop_list['shop_grade_id']    = request_int('shop_grade_id');
		$shop_list['joinin_year']      = request_int('joinin_year');
		$shop_list['shop_class_id']    = request_int('shop_class_id');
		$shop_list['shop_status']      = 1;
		$shop_list['shop_create_time'] = get_date_time();
		$shop_list['shop_settlement_last_time'] = get_date_time();
		$shop_list['shop_end_time']    = date("Y-m-d H:i:s", strtotime(" $shop_list[shop_create_time] + $shop_list[joinin_year] year"));

		$flag = $this->shopBaseModel->editBase($shop_id, $shop_list);

		$company_row = request_row('company');
        $shop_row    = request_row('shop');
        $operate_row = request_row('operate');
        $service_row = request_row('service');
		$shop_manage['company'] = $company_row;
        $shop_manage['shop']    = $shop_row;
        $shop_manage['operate'] = $operate_row;
        $shop_manage['service'] = $service_row;
        $shop_company['shop_manage'] = $shop_manage;

        $shop_company['band_type'] = request_int("band_type");
        if($shop_company['band_type'] == '1')
        {
            $shop_company['self_owned'] = request_string("self_owned");
            $shop_company['self_owned_band'] = request_string("self_owned_band");
            $shop_company['self_owned_authorization'] = request_string("self_owned_authorization");
        }
        else if($shop_company['band_type'] == '2')
        {
            $shop_company['agency_brand_licensing'] = request_string("agency_brand_licensing");
            $shop_company['agency_bank_address'] = request_string("agency_bank_address");
            $shop_company['agency_band_address_detail'] = request_string("agency_band_address_detail");
            $shop_company['band_company_tel'] = request_string("band_company_tel");
            $shop_company['band_start_time'] = request_string("band_start_time");
            $shop_company['band_end_time'] = request_string("band_end_time");
        }

        $shop_company['band_pro_type'] = request_int('band_pro_type');
        if($shop_company['band_pro_type'])
        {
            $shop_company['band_pro_agreement'] = request_string("band_pro_agreement");
        }

        $shop_company['certificate_type'] = request_int('certificate_type',0);

        $cer = request_row('cer');
        if($cer)
        {
            $shop_company['certificate'] = $cer;
        }

        $this->shopCompanyModel->editCompany($shop_id,$shop_company);

        $product_class_id = array_unique($product_class_id);
        $shopClassBind = $this->shopClassBindModel->listByWhere(array('shop_id'=>$shop_id));
        if($shopClassBind['items'])
        {
            $calss_id = array();
            foreach ($shopClassBind['items'] as $val)
            {
                $calss_id[] = $val['shop_class_bind_id'];
            }
            $this->shopClassBindModel->removeClassBind($calss_id);
        }

        foreach ($product_class_id as $key => $value)
		{
			$shop_class['product_class_id']       = $value;
			$shop_class['commission_rate']        = $commission_rate[$key];
			$shop_class['shop_class_bind_enable'] = 2;
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

	public function shopCatBindII()
    {
        $cat_ids   = request_row("cat_id");

        $ShopCatCertificateModel = new Shop_CatCertificateModel();
        $data = $ShopCatCertificateModel->getShopCatCertificate($cat_ids);

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
		$shop_base['shop_payment']            = 1;
        $shop_base['shop_status']  = 2;
		//开启事物
		$SellerBaseModel = new Seller_BaseModel();
		$this->messageModel->sql->startTransactionDb();
		$flag  = $this->shopBaseModel->editBase($shop_id, $shop_base);
		$flag1 = $this->shopCompanyModel->editCompany($shop_id, $shop_list);
        $rs_rows = array();
        check_rs($flag, $rs_rows);
        check_rs($flag1, $rs_rows);
        //添加二级域名
        //平台设置二级域名
		$Web_ConfigModel = new Web_ConfigModel();
		$shop_domain     = $Web_ConfigModel->getByWhere(array('config_type' => 'domain'));
        $domain = array();
        $domain['shop_edit_domain'] = $shop_domain['domain_modify_frequency']['config_value'];
        $domain['shop_self_domain'] = $shop_domain['retain_domain']['config_value'];

        //初始化用户的二级域名
        $Shop_DomainModel = new Shop_DomainModel();
        $check_domain = $Shop_DomainModel->getDomain($shop_id);
        if($check_domain){
            $flag2 = $Shop_DomainModel->editDomain($shop_id,$domain);
        }else{
            $domain['shop_id'] = $shop_id;
            $flag2 = $Shop_DomainModel->addDomain($domain);
        }
        check_rs($flag2, $rs_rows);

		//添加卖家

        $check_seller = $SellerBaseModel->getByWhere(array('shop_id'=>$shop_id));
        if(!$check_seller){
            $seller_base['shop_id']         = $shop_id;
            $seller_base['user_id']         = Perm::$userId;
            $seller_base['seller_name']     = Perm::$row['user_account'];
            $seller_base['seller_is_admin'] = 1;
            $seller_add  = $SellerBaseModel->addBase($seller_base);
        }else{
            $seller_add = true;
        }

		if (is_ok($rs_rows) && $seller_add  && $this->messageModel->sql->commitDb())
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

	public function certification()
	{
		$url = YLB_Registry::get('paycenter_api_url').'?ctl=Info&met=certification&typ=e';
		header('location:'.$url);
	}


    /**
     *  获取当前用户的入驻进度
     */
    public function getStepUrl()
    {
        $user_id = Perm::$userId;
        if(!$user_id)
        {
            $url = YLB_Registry::get('url');
            $step_info = array('status'=>250,'url'=>$url,'msg'=>'请重新登录');
        }
        else
        {
            $shopBaseModel = new Shop_BaseModel();
            $shop_base_info = $shopBaseModel->getBaseOneList(array("user_id" => $user_id));
            if($shop_base_info)
            {
                $shopCompanyModel = new Shop_CompanyModel();
                $shop_company_info_list = $shopCompanyModel->getCompany($shop_base_info['shop_id']);
                if(is_array($shop_company_info_list) && $shop_company_info_list)
                {
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
            }
            else
            {
                //还没有入驻过
                if(Web_ConfigModel::value('join_type') == 3)
                {
                    $op = 'step0';
                }
                else
                {
                    $op = 'step1';
                }
                $step_info = array(
                    'status'=>'-1',
                    'url' => YLB_Registry::get('url').'?ctl=Seller_Shop_Settled&met=index&op='.$op,
                    'msg' => "请填写入驻信息",
                    'step' => $op
                );
            }
        }

        if($step_info['status'] != 250)
        {
            $this->data->addBody(-140, $step_info, 'success', 200);
        }
        else
        {
            $this->data->addBody(-140, $step_info, 'failure', 250);
        }

    }

    /**
     *  返回当前用的的入驻进度
     *  notice: $shop_step_info['contacts_phone'] 有值，说明应填写完个人信息或企业信息（当前pstep2,step2），
     *  如果$shop_step_info['bank_name']有值，说明已填写银行资质（当前pstep2,step2）
     */
    private function _getStep($shop_step_info){
        if(!$shop_step_info){
            $url = YLB_Registry::get('url');
            return array('status'=>250,'url'=>$url,'msg'=>_('请重新登录'));
        }

        //店铺状态： 0:关闭, 1:待审核资料 ，2:待审核付款 ，3：开店成功 ，4：审核资料未通过，5：银行资质审核未通过，6，店铺资料审核未通过，7，付款审核未通过，8，提交个人资料,9，提交银行信息
        switch ($shop_step_info['shop_status']){
            case 0:
                if($shop_step_info['shop_name']){
                    $apply = '';
                    $op = '';
                    $msg = _('店铺已关闭');
                }else{
                    //重新填写入驻信息
                    if($shop_step_info['shop_business'] == 1){
                        $apply = 2; //企业
                        $op = 'step2';
                    }else{
                        $apply = 1; //个人
                        $op = 'pstep2';
                    }
                    $msg = _('请填写入驻信息');
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
                $msg = _('待审核资料');
                break;
            case 2:
                $apply = '';
                $op = 'step5';
                $msg = _('待审核付款');
                break;
            case 3:
                $op = '';
                $apply = '';
                $msg = _('开店成功');
                break;
            case 4:
                if($shop_step_info['shop_business'] == 1 ){
                    $apply = 2; //企业
                    $op = 'step2';
                }else{
                    $apply = 1; //个人
                    $op = 'pstep2';
                }
                $msg = _('个人（公司）资料未通过审核');
                break;
            case 5:
                if($shop_step_info['shop_business'] == 1 ){
                    $apply = 2; //企业
                    $op = 'step3';
                }else{
                    $apply = 1; //个人
                    $op = 'pstep3';
                }
                $msg = _('开户银行信息未通过审核');
                break;
            case 6:
                $apply = '';
                $op = 'step4';
                $msg = _('店铺资料审核未通过');
                break;
            case 7:
                $apply = '';
                $op = 'step5';
                $msg = _('店铺付款信息未通过审核');
                break;
            case 8:
                if($shop_step_info['shop_business'] == 1 ){
                    $apply = 2; //企业
                    $op = 'step3';
                }else{
                    $apply = 1; //个人
                    $op = 'pstep3';
                }
                $msg = _('提交个人信息');
                break;
            case 9:
                $apply = '';
                $op = 'step4';
                $msg = _('提交个人信息');
                break;
            default :
                if($shop_step_info['shop_business'] == 1 ){
                    $apply = 2; //企业
                    $op = 'step2';
                }else{
                    $apply = 1; //个人
                    $op = 'pstep2';
                }
                $msg = _('请填写入驻信息');
                break;
        }
        $url = YLB_Registry::get('url').'/index.php?ctl=Seller_Shop_Settled&met=index&op='.$op.'&apply='.$apply;
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
     * 获取店铺地区
     *
     * @param string $shop_company_address
     * @return array
     */
    public function _getShopDistrict($shop_company_address = ''){
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
    
    /**
     *  获取实名认证
     */
    public function getCertification()
    {
        //从paycenter中获取用户的实名认证信息
        $key = YLB_Registry::get('paycenter_api_key');
        $url = YLB_Registry::get('paycenter_api_url');
        $app_id = YLB_Registry::get('paycenter_app_id');

        $formvars = array();
        $formvars['app_id'] = $app_id;
        $formvars['user_id'] = Perm::$userId;
        $rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_User_Info&met=getUserCertification&typ=json', $url), $formvars);
        return $rs;
    }
}