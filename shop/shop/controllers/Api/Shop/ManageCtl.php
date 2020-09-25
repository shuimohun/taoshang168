<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author
 */

class Api_Shop_ManageCtl extends Api_Controller
{
	public $messageModel     = null;
	public $shopBaseModel    = null;
	public $shopClassModel   = null;
	public $shopGradeModel   = null;
	public $shopRenewalModel = null;
    public $goodsCommonModel = null;
    public $shopCompanyModel = null;
    public $shopNpassModel   = null;

        /**
	 * 初始化方法，构造函数
	 *
	 * @access public
	 */
	public function init()
	{
		$this->messageModel     = new MessageModel();
		$this->shopBaseModel    = new Shop_BaseModel();
		$this->shopClassModel   = new Shop_ClassModel();
		$this->shopGradeModel   = new Shop_GradeModel();
		$this->shopRenewalModel = new Shop_RenewalModel();
        $this->goodsCommonModel = new Goods_CommonModel();
        $this->shop_companyModel   = new Shop_CompanyModel();
        $this->shopNpassModel   = new Shop_NpassModel();
	}

	/**
	 * 首页
	 *
	 * @access public
	 */

	public function shopIndex()
	{

        $page = request_int('page');
        $rows = request_int('rows');

		$shop_type    = request_string('user_type');
		$shop_account = request_string('search_name');
		$shop_class   = request_string('shop_class');
        $type         = request_string('type');

		$cond_row = array(
			"shop_self_support" => "false"
		);
        if($type=='zhou'){
            $start_date = date("Y-m-d", strtotime("this week"));
            $end_date = date("Y-m-d", strtotime("this week +6 day"));
            $cond_row['shop_status'] = 3;
            $cond_row['shop_create_time:>='] = $start_date;
            $cond_row['shop_create_time:<='] = $end_date;
        }else{
            $cond_row["shop_status:in"]=  array("0","3");
        }

		//按照店主账号与店主名称查询
		if ($shop_account)
		{
			if ($shop_type)
			{
				$type = 'shop_name:LIKE';
			}
			else
			{
				$type = 'user_name:LIKE';
			}
			$cond_row[$type] = '%' . $shop_account . '%';
		}
		if($type=='dq'){
            $date = get_date_time();
            $cond_row['shop_end_time:<='] = $date;
        }
        if($type=='jdq'){
            $end7_date =date("Y-m-d", strtotime("+7 days"));
            $date = get_date_time();
            $cond_row['shop_end_time:<='] = $end7_date;
            $cond_row['shop_end_time:>='] = $date;
        }

		if($shop_class)
		{
			$cond_row['shop_class_id'] = $shop_class;
		}

		$cond_row['shop_type'] = 1; //非供应商店铺

        //分站筛选
        $sub_site_id = request_int('sub_site_id');
        $sub_flag = true;
        if($sub_site_id > 0){
            //获取站点信息
            $Sub_SiteModel = new Sub_SiteModel();
            $sub_site_district_ids = $Sub_SiteModel->getDistrictChildId($sub_site_id);
            if(!$sub_site_district_ids){
                $sub_flag = false;
            }else{
                $cond_row['district_id:IN'] = $sub_site_district_ids;
            }
        }
        if($sub_flag == false)
        {
            $status = 250;
			$msg    = _('分站信息获取失败');
            $this->data->addBody(-140, array(), $msg, $status);
        }
        else
        {
            $order_row['shop_create_time'] = 'desc';
            $data = $this->shopBaseModel->getBaseList($cond_row,$order_row,$page,$rows);

            if($data){
                $status = 200;
                $msg    = _('success');
            }else{
                $status = 250;
                $msg    = _('没有数据');
            }
            $this->data->addBody(-140, $data, $msg, $status);
        }
	}

	/**
	 * 获取店铺详情
	 *
	 * @access public
	 */
	public function getShoplist()
	{
		/*$shop_id = request_int('shop_id');
        $data    = $this->shopBaseModel->getbaseAllList($shop_id);
        $data['base'][$shop_id]['bank_account_number'] = ' '.$data['base'][$shop_id]['bank_account_number'].' ';
		$this->data->addBody(-140, $data);*/

        $shop_id = request_int('shop_id');
        $data    = $this->shopBaseModel->getbaseAllList($shop_id);

        $data['base'][$shop_id]['bank_code'] = "'".$data['base'][$shop_id]['bank_code']."'";
        $data['base'][$shop_id]['bank_account_number'] = "'".$data['base'][$shop_id]['bank_account_number']."'";
        $data['base'][$shop_id]['organization_code'] = "'".$data['base'][$shop_id]['organization_code']."'";

        $this->data->addBody(-140, $data);
	}

    /**
     * 获取店铺续签详情
     *
     * @access public
     */
    public function getreopen()
    {
        $id = request_int('id');
        $data    = $this->shopRenewalModel->getOnebyWhere(array('id'=>$id));
        $this->data->addBody(-140, $data);
    }

	/**
	 * 店铺信息主页
	 *
	 * @access public
	 */
	public function getinformationrow()
	{
        $id            = request_int('shop_id');
        $data          = $this->shopBaseModel->getOne($id);
        $data['class'] = $this->shopClassModel->getClassWhere();
        $data['grade'] = $this->shopGradeModel->getGradeWhere();

        $data['default_shop_class_id'] = -1;
        $data['default_shop_grade_id'] = -1;

        if($data['class'])
        {
            $data['class'] = array_values($data['class']);

            foreach ($data['class'] as $key => $value)
            {
                if($value['shop_class_id'] == $data['shop_class_id'])
                {
                    $data['default_shop_class_id'] = $key;
                }
            }
        }
        if($data['grade'])
        {
            $data['grade'] = array_values($data['grade']);

            foreach ($data['grade'] as $key => $value)
            {
                if($value['shop_grade_id'] == $data['shop_grade_id'])
                {
                    $data['default_shop_grade_id'] = $key;
                }
            }
        }
        $this->data->addBody(-140, $data);
	}

	/**
	 * 修改店铺信息主页
	 *
	 * @access public
	 */
	public function editShopinformation()
	{
		$edit_shop_row['shop_name'] = request_string("shop_name");
        $edit_shop_row['shop_class_id'] = request_int("shop_class_id");
        $edit_shop_row['shop_grade_id'] = request_int("shop_grade_id");
        $edit_shop_row['shop_status'] = request_int("shop_status");
		$shop_id       = request_int('shop_id');
		$flag          = $this->shopBaseModel->editBase($shop_id, $edit_shop_row);
		if ($flag === FALSE)
		{
			$status = 250;
			$msg    = _('failure');
		}
		else
		{       
            if($edit_shop_row['shop_status'] != Shop_BaseModel::SHOP_STATUS_OPEN){
                //如果店铺关闭，商品则全部下架
                //下架goods_base商品 //goods_is_shelves=2
                $goodsBaseModel          = new Goods_BaseModel();
                $goodsBaseModel->editBaseByShopId($shop_id,array('goods_is_shelves'=>$goodsBaseModel::GOODS_DOWN));
                //下架goods_common的商品 common_state=0
                $goodsCommonModel        = new Goods_CommonModel();
                $goodsCommonModel->editCommonByShopId($shop_id,array('common_state'=>$goodsCommonModel::GOODS_STATE_OFFLINE, 'shop_status'=>$edit_shop_row['shop_status']));
            }
            
            $status = 200;
			$msg    = _('success');
		}
		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);
	}

	/**
	 * 开店申请首页
	 *
	 * @access public
	 */
	public function shopJoin()
	{
		$shop_type    = request_string('user_type');
		$shop_account = request_string('search_name');
		$shop_class   = request_string('shop_class');

		$cond_row = array(
			"shop_status" => 1,
			"shop_self_support" => "false"
		);

		//按照店主账号与店主名称查询
		if ($shop_account)
		{
			if ($shop_type)
			{
				$type = 'shop_name:LIKE';
			}
			else
			{
				$type = 'user_name:LIKE';
			}
			$cond_row[$type] = '%' . $shop_account . '%';
		}

		if($shop_class)
		{
			$cond_row['shop_class_id'] = $shop_class;
		}
		$cond_row['shop_type'] = 1; //非供应商店铺
        
        $Sub_SiteModel = new Sub_SiteModel();
        $sub_site_id = request_int('sub_site_id');
        //判断分站信息
        $sub_flag = true;
        if($sub_site_id > 0){
            $sub_site_district_ids = $Sub_SiteModel->getDistrictChildId($sub_site_id);
            if(!$sub_site_district_ids){
                $sub_flag = false;
            }else{
                $cond_row['district_id:IN'] = $sub_site_district_ids;
            }
        }
        if($sub_flag == false){
            $status = 250;
			$msg    = _('分站信息获取失败');
            $this->data->addBody(-140, array(), $msg, $status);
        }else{

            $data = $this->shopBaseModel->getBaseList($cond_row);
//            d($data);
            $this->data->addBody(-140, $data);
        }
	}

	/**审核不通过*/
	public function editjoin(){
	    $cond_row['shop_id'] = request_int('shop_id');

	    $data = $this->shopBaseModel->getOnebyWhere($cond_row);

        $this->data->addBody(-140, $data);
    }

	/* 补全开店审核资料
	 * */
    public function shopData()
    {
        $shop_type    = request_string('user_type');
        $shop_account = request_string('search_name');
        $shop_class   = request_string('shop_class');

        $cond_row = array(
            "shop_status" => 6,
            "shop_self_support" => "false"
        );

        //按照店主账号与店主名称查询
        if ($shop_account)
        {
            if ($shop_type)
            {
                $type = 'shop_name:LIKE';
            }
            else
            {
                $type = 'user_name:LIKE';
            }
            $cond_row[$type] = '%' . $shop_account . '%';
        }

        if($shop_class)
        {
            $cond_row['shop_class_id'] = $shop_class;
        }
        $cond_row['shop_type'] = 1; //非供应商店铺

        $Sub_SiteModel = new Sub_SiteModel();
        $sub_site_id = request_int('sub_site_id');
        //判断分站信息
        $sub_flag = true;
        if($sub_site_id > 0){
            $sub_site_district_ids = $Sub_SiteModel->getDistrictChildId($sub_site_id);
            if(!$sub_site_district_ids){
                $sub_flag = false;
            }else{
                $cond_row['district_id:IN'] = $sub_site_district_ids;
            }
        }
        if($sub_flag == false){
            $status = 250;
            $msg    = _('分站信息获取失败');
            $this->data->addBody(-140, array(), $msg, $status);
        }else{

            $data = $this->shopBaseModel->getBaseList($cond_row);
//            d($data);
            $this->data->addBody(-140, $data);
        }
    }
	/**
	 * 经营类目申请
	 *
	 * @access public
	 */

	public function getCategory()
	{
		// $data = array();
		$shop_type    = request_string('user_type');
		$shop_account = request_string('search_name');
                $shop_class_bind_enable = request_string('status');
		$cond_row = array();
                
        if($shop_class_bind_enable){
            $type            = 'shop_class_bind_enable';
            $cond_row[$type] = $shop_class_bind_enable;
        }
		//按照店主账号与店主名称查询
		if ($shop_account)
		{
			if ($shop_type=="1")
			{
				$type            = 'commission_rate:LIKE';
				$cond_row[$type] = $shop_account . '%';
			}
			elseif($shop_type=="2")
			{
                                
                $shop_base = $this->shopBaseModel->getByWhere(array('shop_name:LIKE'=>$shop_account.'%'));
                $shop_id = array_column($shop_base, 'shop_id'); 
                $cond_row['shop_id:IN'] = $shop_id;
            }else{
                $shop_base = $this->shopBaseModel->getByWhere(array('user_name:LIKE'=>$shop_account.'%'));
                $user_id = array_column($shop_base, 'shop_id'); 
                $cond_row['shop_id:IN'] = $user_id;
            }
			
		}
		
		//去除供应商店铺ID
        $Sub_SiteModel = new Sub_SiteModel();
        $sub_site_id = request_int('sub_site_id');
        //判断分站信息
        $sub_flag = true;
        $where = array('shop_type'=>1);
        if($sub_site_id > 0){
            $sub_site_district_ids = $Sub_SiteModel->getDistrictChildId($sub_site_id);
            if(!$sub_site_district_ids){
                $sub_flag = false;
            }else{
                $where['district_id:IN'] = $sub_site_district_ids;
            }
        }
        if($sub_flag == false){
            $status = 250;
			$msg    = _('分站信息获取失败');
            $this->data->addBody(-140, array(), $msg, $status);
        }else{
            $shop_base = $this->shopBaseModel->getByWhere($where);
            $shop_id = array_column($shop_base, 'shop_id'); 
            $cond_row['shop_id:IN'] = $shop_id;

            $order = array('shop_id' => 'desc');
            $data  = $this->shopBaseModel->getCategorylist($cond_row, $order);
            $this->data->addBody(-140, $data);
        }
	}


	/**
	 * 修改店铺经营类目
	 *
	 * @access public
	 */
	public function editShopCategory()
	{
		$shop_class_bind_id  = request_int('shop_class_bind_id');
		$shopClassBindModel  = new Shop_ClassBindModel();
		$shop_class_bind_row = $shopClassBindModel->getOne($shop_class_bind_id);
		$this->data->addBody(-140, $shop_class_bind_row);
	}

	/**
	 * 添加店铺经营类目
	 */

	public function editShopCategoryRow()
	{
		$shop_class_bind_id            = request_int('shop_class_bind_id');
		$class_list["commission_rate"] = request_string("commission_rate");
		$shopClassBindModel            = new Shop_ClassBindModel();
		$flag                          = $shopClassBindModel->editClassBind($shop_class_bind_id, $class_list);
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
	 * 添加店铺经营类目
	 */

	public function addShopCategory()
	{
		$data["shop_id"] = request_int('shop_id');
		$this->data->addBody(-140, $data);
	}

	/**
	 * 添加店铺经营类目
	 */

	public function addShopCategoryRow()
	{
		$class_list["product_class_id"]       = request_int('product_class_id');
		$class_list["shop_id"]                = request_int('shop_id');
		$class_list["commission_rate"]        = request_string("commission_rate");
		$class_list["shop_class_bind_enable"] = 2;
		$shopClassBindModel                   = new Shop_ClassBindModel();

        $is_key_exists = $shopClassBindModel->getKeyByWhere([
            'shop_id'          => $class_list["shop_id"],
            'product_class_id' => $class_list["product_class_id"]
        ]);

        if($is_key_exists)
        {
            $status = 250;
            $msg = '已经有此类目';
        }
        else
        {
            $flag = $shopClassBindModel->addClassBind($class_list, true);

            if ($flag)
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

		$this->data->addBody(-140, [], $msg, $status);
	}


	/**
	 * 删除经营类目
	 *
	 * @access public
	 */

	public function delCategory()
	{

		$shop_class_bind_id = request_int('shop_class_bind_id');

		if ($shop_class_bind_id)
		{

			$shopClassBindModel = new Shop_ClassBindModel();
			$flag               = $shopClassBindModel->removeClassBind($shop_class_bind_id);
			if ($flag)
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

	public function categoryStatus()
	{

		$shop_class_bind_id = request_int('shop_class_bind_id');

		if ($shop_class_bind_id)
		{

			$shopClassBindModel                     = new Shop_ClassBindModel();
			$class_status['shop_class_bind_enable'] = 2;
			$flag                                   = $shopClassBindModel->editClassBind($shop_class_bind_id, $class_status);
			if ($flag)
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
	 * 结算周期首页
	 *
	 * @access public
	 */

	public function getSettlement()
	{
		$shop_type    = request_string('user_type');
		$shop_account = request_string('search_name');

		$cond_row = array();

		//按照店主账号与店主名称查询
		if ($shop_account)
		{
			if ($shop_type)
			{
				$type = 'shop_name:LIKE';
			}
			else
			{
				$type = 'user_name:LIKE';
			}
			$cond_row[$type] = '%' . $shop_account . '%';
		}
        $sub_flag = true;
		$cond_row['shop_type'] = 1; //非供应商店铺
		$Sub_SiteModel = new Sub_SiteModel();
        $sub_site_id = request_int('sub_site_id');
        $sub_flag = true;
        if($sub_site_id > 0){
            $sub_site_district_ids = $Sub_SiteModel->getDistrictChildId($sub_site_id);
            if(!$sub_site_district_ids){
                $sub_flag = false;
            }else{
                $cond_row['district_id:IN'] = $sub_site_district_ids;
            }
        }
        if($sub_flag == false){
            $status = 250;
			$msg    = _('分站信息获取失败');
            $this->data->addBody(-140, array(), $msg, $status);
        }else{
            $order = array('shop_id' => 'asc');
            $data  = $this->shopBaseModel->getBaseList($cond_row, $order);
            $this->data->addBody(-140, $data);
        }
		
	}


	/**
	 * 结算周期修改页面
	 *   查询一条记录
	 * @access public
	 */

	public function getSettlementRow()
	{
		$shop_id = request_int('shop_id');
		$data    = $this->shopBaseModel->getOne($shop_id);
		$this->data->addBody(-140, $data);
	}

	/**
	 * 修改周期
	 *
	 * @access public
	 */
	public function editSettlementRow()
	{
		$shop_id                                        = request_int('shop_id');
		$shop_settlement_cycle['shop_settlement_cycle'] = request_string('shop_settlement_cycle');
		$flag                                           = $this->shopBaseModel->editBase($shop_id, $shop_settlement_cycle);
                
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
		$this->data->addBody(-140, array(), $msg, $status);
	}

	public function reopenlist()
	{
		$shop_type    = request_string('user_type');
		$shop_account = request_string('search_name');

		$cond_row = array();

		//按照店主账号与店主名称查询
		if ($shop_account)
		{
			if ($shop_type)
			{
				$type = 'shop_name:LIKE';
			}
			else
			{
				$type = 'shop_id:LIKE';
			}
			$cond_row[$type] = '%' . $shop_account . '%';
		}

		$shop_class   = request_string('shop_class');
		if($shop_class)
		{
			$cond_row['shop_class_id'] = $shop_class;
		}
//		$cond_row['shop_type'] = 1; //非供应商店铺
        $Sub_SiteModel = new Sub_SiteModel();
        $sub_site_id = request_int('sub_site_id');
        //判断分站信息
        $sub_flag = true;
        if($sub_site_id > 0){
            $sub_site_district_ids = $Sub_SiteModel->getDistrictChildId($sub_site_id);
            if(!$sub_site_district_ids){
                $sub_flag = false;
            }else{
                $cond_row['district_id:IN'] = $sub_site_district_ids;
            }
        }
        if($sub_flag == false){
            $status = 250;
			$msg    = _('分站信息获取失败');
            $this->data->addBody(-140, array(), $msg, $status);
        }else{
            $data = $this->shopRenewalModel->getRenewalList($cond_row);
            $this->data->addBody(-140, $data);
        }
	}

	public function delReopen()
	{

		$shop_reopen_id = request_int('id');

		if ($shop_reopen_id)
		{
			$flag = $this->shopRenewalModel->removeRenewal($shop_reopen_id);
			if ($flag)
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

	//审核续签
	public function examineReopen()
	{

		$shop_reopen_id = request_int('id');
		//开启事物
		$this->messageModel->sql->startTransactionDb();
		if ($shop_reopen_id)
		{
			$status['status'] = 1;
			//更改续签的状态
			$flag = $this->shopRenewalModel->editRenewal($shop_reopen_id, $status);
			//更改店铺的结束时间
			$flag1 = $this->shopRenewalModel->editEndTime($shop_reopen_id);
			//判断事物有没有成功
			if ($flag && $flag1 && $this->messageModel->sql->commitDb())
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

		}
		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);
	}

	public function editCategory()
	{

		$cond_row['shop_id'] = request_int('shop_id');
		$data                = $this->shopBaseModel->getCategorylist($cond_row,['shop_class_bind_id'=>'desc']);
		$this->data->addBody(-140, $data);

	}

	//审核店铺 状态为1，审核信息。状态为2，状态6 补全审核信息 ，状态7 补全审核缴费,审核有没有付款。
	public function editShopStatus()
	{

		$shop_id  = request_int('shop_id');
		$shop_row = $this->shopBaseModel->getOne($shop_id);
        $shop_company_row = $this->shop_companyModel->getOne($shop_id);
		if ($shop_row['shop_status'] == 1)
		{
			$edit_status['shop_status'] = 2;
			$flag                       = $this->shopBaseModel->editBase($shop_id, $edit_status);

			$shop_npass_row = $this->shopNpassModel->getOneByWhere(array('shop_id'=>$shop_id));
			if($shop_npass_row){
                $edit_napss['shop_npass_status'] = 2;
                $npass_flag                 = $this->shopNpassModel->editNpass($shop_npass_row['npass_id'],$edit_napss);

            }

		}
		elseif ($shop_row['shop_status'] == 2)
		{
			$edit_status['shop_status'] = 3;
			$flag                       = $this->shopBaseModel->editBase($shop_id, $edit_status);

            $shop_npass_row = $this->shopNpassModel->getOneByWhere(array('shop_id'=>$shop_id));
            if($shop_npass_row){
                $edit_napss['shop_npass_status'] = 2;
                $npass_flag                 = $this->shopNpassModel->editNpass($shop_npass_row['npass_id'],$edit_napss);

            }
		}
        elseif ($shop_row['shop_status'] == 6 && $shop_company_row['bc_shop_status']==2)
        {
            $edit_company_status['bc_shop_status'] = 3;
            $edit_status['shop_status'] = 7;
            $flag1                       = $this->shop_companyModel->editCompany($shop_id, $edit_company_status);
            $flag2                       = $this->shopBaseModel->editBase($shop_id, $edit_status);
            if($flag1 && $flag2){
                $flag = 1;
            }
        }
        elseif ($shop_row['shop_status'] == 7 && $shop_company_row['bc_shop_status']==4)
        {
            $edit_company_status['bc_shop_status'] = 5;
            $edit_status['shop_status'] = 3;
            $flag1                       = $this->shop_companyModel->editCompany($shop_id, $edit_company_status);
            $flag2                       = $this->shopBaseModel->editBase($shop_id, $edit_status);
            //下架goods_common的商品 common_state=0
            $goodsCommonModel        = new Goods_CommonModel();
            $goodsCommonModel->editCommonByShopId($shop_id,array('shop_status'=>3));

            if($flag1 && $flag2){
                $flag = 1;
            }
        }
		if (!$flag === FALSE)
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

    //审核店铺信息。
    public function verifyShop()
    {
        $shop_id  = request_int('shop_id');
        $shop_verify1 = request_int('shop_verify1');
        $shop_verify2 = request_int('shop_verify2');
        $shop_verify3 = request_int('shop_verify3');
        $shop_verify4 = request_int('shop_verify4');
        if(!$shop_verify1 && !$shop_verify2 && !$shop_verify3 && !$shop_verify4)
        {
            $flag = false;
        }
        else
        {
            if($shop_verify4)
            {
                $edit_status['shop_status'] = $shop_verify4;
            }
            else
            {
                if($shop_verify1 == 4)
                {
                    $edit_status['shop_status'] = 4;
                }
                else
                {
                    if($shop_verify2 == 5)
                    {
                        $edit_status['shop_status'] = 5;
                    }
                    else
                    {
                        if($shop_verify3 == 6)
                        {
                            $edit_status['shop_status'] = 6;
                        }
                        else
                        {
                            $edit_status['shop_status'] = 2;
                        }
                    }
                }
            }
            $edit_status['shop_verify_reason'] = request_string('shop_verify_reason');
            $flag = $this->shopBaseModel->editBase($shop_id, $edit_status);
        }

        if ($flag)
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

	//审核付款
	public function shopPay()
	{
		$shop_type    = request_string('user_type');
		$shop_account = request_string('search_name');

		$cond_row = array(
			"shop_status" => 2,
			"shop_self_support" => "false"
		);

		//按照店主账号与店主名称查询
		if ($shop_account)
		{
			if ($shop_type)
			{
				$type = 'shop_name:LIKE';
			}
			else
			{
				$type = 'user_name:LIKE';
			}
			$cond_row[$type] = '%' . $shop_account . '%';
		}

		$shop_class   = request_string('shop_class');
		if($shop_class)
		{
			$cond_row['shop_class_id'] = $shop_class;
		}
		$cond_row['shop_type'] = 1; //非供应商店铺
        $Sub_SiteModel = new Sub_SiteModel();
        $sub_site_id = request_int('sub_site_id');
        //判断分站信息
        $sub_flag = true;
        if($sub_site_id > 0){
            $sub_site_district_ids = $Sub_SiteModel->getDistrictChildId($sub_site_id);
            if(!$sub_site_district_ids){
                $sub_flag = false;
            }else{
                $cond_row['district_id:IN'] = $sub_site_district_ids;
            }
        }
        if($sub_flag == false){
            $status = 250;
			$msg    = _('分站信息获取失败');
            $this->data->addBody(-140, array(), $msg, $status);
        }else{
            $data = $this->shopBaseModel->getBaseList($cond_row);
            $this->data->addBody(-140, $data);
        }
	}


    //审核补全店铺付款 yly
    public function shopOrder()
    {
        $shop_type    = request_string('user_type');
        $shop_account = request_string('search_name');

        $cond_row = array(
            "shop_status" => 7,
            "shop_self_support" => "false"
        );

        //按照店主账号与店主名称查询
        if ($shop_account)
        {
            if ($shop_type)
            {
                $type = 'shop_name:LIKE';
            }
            else
            {
                $type = 'user_name:LIKE';
            }
            $cond_row[$type] = '%' . $shop_account . '%';
        }

        $shop_class   = request_string('shop_class');
        if($shop_class)
        {
            $cond_row['shop_class_id'] = $shop_class;
        }
        $cond_row['shop_type'] = 1; //非供应商店铺
        $Sub_SiteModel = new Sub_SiteModel();
        $sub_site_id = request_int('sub_site_id');
        //判断分站信息
        $sub_flag = true;
        if($sub_site_id > 0){
            $sub_site_district_ids = $Sub_SiteModel->getDistrictChildId($sub_site_id);
            if(!$sub_site_district_ids){
                $sub_flag = false;
            }else{
                $cond_row['district_id:IN'] = $sub_site_district_ids;
            }
        }
        if($sub_flag == false){
            $status = 250;
            $msg    = _('分站信息获取失败');
            $this->data->addBody(-140, array(), $msg, $status);
        }else{
            $data = $this->shopBaseModel->getBaseList($cond_row);
            $this->data->addBody(-140, $data);
        }
    }

    //手机端模版设置 店铺
    public function getShopByMb()
    {
        $page = request_int('page', 1);
        $rows = request_int('rows', 20);

        $shop_name = request_string('shop_name');

        $cond_row["shop_status"]=  Shop_BaseModel::SHOP_STATUS_OPEN;
        if($shop_name)
        {
            $cond_row['shop_name:LIKE'] = '%' . $shop_name . '%';
        }
        $cond_row['shop_type'] = 1; //非供应商店铺

        $order_row['shop_id'] = 'asc';

        $data = $this->shopBaseModel->getBaseList($cond_row,$order_row,$page,$rows);

        if($data){
            $status = 200;
            $msg    = _('success');
        }else{
            $status = 250;
            $msg    = _('没有数据');;
        }
        $this->data->addBody(-140, $data, $msg, $status);


    }
}

?>