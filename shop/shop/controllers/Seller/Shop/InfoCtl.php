<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     Banchangle
 */
class Seller_Shop_InfoCtl extends Seller_Controller
{

	public $shopBaseModel      = null;
	public $shopClassModel     = null;
	public $shopGradeModel     = null;
	public $shopClassBindModel = null;
	public $shopRenewalModel   = null;
	public $goodsCatModel      = null;


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
		$this->shopClassModel     = new Shop_ClassModel();
		$this->shopGradeModel     = new Shop_GradeModel();
		$this->shopClassBindModel = new Shop_ClassBindModel();
		$this->shopRenewalModel   = new Shop_RenewalModel();
		$this->goodsCatModel      = new Goods_CatModel();

	}

	/**
	 * 首页
	 *
	 * @access public
	 */
	public function info()
	{
		$act = request_string('act');
		//首先判断一下是不是自营店铺如果是自营店铺就没有店铺公司信息以及续费申请
		$shop_id = Perm::$shopId;
		$shop    = $this->shopBaseModel->getOne($shop_id);
        $shop_company1 = $this->shopBaseModel->getbaseCompanyList($shop_id);

        if($act == 'record')
        {
            $data = $this->shopRenewalModel->getRenewalList(array("shop_id" => $shop_id));
            $this->view->setMet('record');
        }
        elseif ($act == 'renew')
		{
            $shop_renewal = $this->shopRenewalModel->getKeyByWhere(array("shop_id" => $shop_id,'status'=> 0));
            if($shop_renewal)
            {
                location_to(YLB_Registry::get('url').'?ctl=Seller_Shop_Info&met=info&typ=e&act=record');
            }
            else
            {
                //推算出他的续签时间（前一个月即可申请）
                if($shop['shop_end_time'] == '0000-00-00 00:00:00')
                {
                    $frontmonth = '0000-00-00 00:00:00';
                }
                else
                {
                    $frontmonth = date("Y-m-d H:i:s", strtotime("$shop[shop_end_time] - 1 month"));
                }
                $grade      = $this->shopGradeModel->getGradeWhere();

                $this->view->setMet('renew');
            }
        }
		elseif ($act == 'info')
		{
			//店铺信息
			$shopCompanyModel = new Shop_CompanyModel();
			$company          = $shopCompanyModel->getCompanyrow($shop_id);
			if ($company)
			{
				$data = $this->shopBaseModel->getbaseAllList($shop_id);
			}
			else
			{
				$data = array();
			};
		}
        elseif($act == 'edinfo')
        {
            //获取一级地址
            $district_parent_id = request_int('pid', 0);
            $baseDistrictModel  = new Base_DistrictModel();
            $district           = $baseDistrictModel->getDistrictTree($district_parent_id);
            $shop_class = $this->shopClassModel->getByWhere();

            $shop_grade = $this->shopGradeModel->getByWhere();
            $shop_base = $this->shopBaseModel->getShopDetail($shop_id);

            $op = request_string("op");

                switch ($op)
                {
                    case "edinfo":
                    {
                        if (empty($shop_company1['company_registered_capital']))
                        {
                            $page = "edinfo";
                        }
                        else
                        {
                            $page = "edinfo2";
                        }

                        break;
                    }
                    case "edinfo2":
                    {

                        if (empty($shop_company1['bank_account_name']))
                        {
                            $page = "edinfo2";
                        }
                        else
                        {
                            $page = "edinfo3";
                        }
                        break;
                    }
                    case "edinfo3":
                    {

                        if (!empty($shop_company1['shop_class_id']))
                        {
                            if (!empty($shop_company1['shop_class_id'])&&$shop_company1['bc_shop_status']==2)
                            {
                                $page = "edinfo4";
                            }
                            elseif (!empty($shop_company1['shop_class_id'])&&$shop_company1['bc_shop_status']==1)
                            {
                                $page = "edinfo3";
                            }
                            else
                            {
                                $page = "edinfo3";
                            }

                        }
                        else
                        {
                            $page = "edinfo2";
                        }
                        break;
                    }
                    case "edinfo4":
                    {
                        if (!empty($shop_company1['shop_class_id'])&&$shop_company1['bc_shop_status']==2)
                        {
                            $page = "edinfo4";
                        }else{
                            $page = "edinfo3";
                        }
                        break;
                    }
                    case "edinfo_back":
                    {
                        $page = "edinfo";
                        break;
                    }
                    case "edinfo2_back":
                    {
                        $page = "edinfo2";
                        break;
                    }
                }
                if($op!='edinfo2_back'&& $op!='edinfo_back'){
                    if (!empty($page) && !empty($shop_company1))
                    {
                        $page = $shop_company1 && $shop_company1['bank_account_name']&& $shop_company1['shop_status'] == 0  ? "edinfo3" : $page;
                        $page = $shop_company1 && ($shop_company1['shop_status'] == 6 ||$shop_company1['shop_status'] == 7)  ? "edinfo4" : $page;
                    }
                }

                if($shop_company1['shop_status']==3 && $shop_company1['bc_shop_status']==5){
                    header("Location:index.php?ctl=Seller_Index&met=index&typ=e");
                }

                if (!empty($page))
                {
                    $this->view->setMet($page);
                }

        }
        else
		{
			//判断是否绑定所有类目
			if ($shop['shop_all_class'])
			{
				$data = array();
			}
			else
			{
				$YLB_Page            = new YLB_Page();
				$YLB_Page->listRows  = 10;
				$rows               = $YLB_Page->listRows;
				$offset             = request_int('firstRow', 0);
				$page               = ceil_r($offset / $rows);
				$data               = $this->shopClassBindModel->getClassBindlist(array("shop_id" => $shop_id), array(), $page, $rows);
				$YLB_Page->totalRows = $data['totalsize'];
				$page_nav           = $YLB_Page->prompt();
			}
			$this->view->setMet('category');
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

	public function delInfo()
	{

		$shop_class_bind_id = request_string('id');
		$shop_id            = Perm::$shopId;
		if ($shop_class_bind_id)
		{
			//判断是不是当前用户操作的
			$class_Bind_info = $this->shopClassBindModel->getOne($shop_class_bind_id);
			if ($shop_id == $class_Bind_info['shop_id'] && $class_Bind_info['shop_class_bind_enable'] != 2)
			{
				$flag = $this->shopClassBindModel->removeClassBind($shop_class_bind_id);
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
			else
			{
				$status = 250;
				$msg    = _('failure');
			}

		}
		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);
	}

	public function addRenew()
	{
        $shop_id = Perm::$shopId;

        $shop_renewal = $this->shopRenewalModel->getKeyByWhere(array("shop_id" => $shop_id,'status'=> 0));
        if($shop_renewal)
        {
            $this->data->addBody(-140, array(), '您有续签申请正在审核中,请勿重复申请!', 250);
            return;
        }

		//接收数据
		$shop_grade_id           = request_int('shop_grade');
		$renew_row['renew_time'] = request_int('renew_time');
        $renew_row['payment_voucher']         = request_string('payment_voucher');
        $renew_row['payment_voucher_explain']  = request_string('payment_voucher_explain');
		//根据等级id获取等级的名称以及单价
		$renew                        = $this->shopGradeModel->getOne($shop_grade_id);
		$renew_row['shop_grade_id']   = $renew['shop_grade_id'];
		$renew_row['shop_grade_name'] = $renew['shop_grade_name'];
		$renew_row['shop_grade_fee']  = $renew['shop_grade_fee'];
		$renew_row['renew_cost']      = $renew_row['renew_time'] * $renew['shop_grade_fee'];
		$renew_row['create_time']     = date("Y-m-d H:i:s", time());

		//根据店铺id查询出店铺信息
		$shop_row = $this->shopBaseModel->getOne($shop_id);

		$renew_row['start_time'] = $shop_row['shop_end_time'];
		$renew_row['shop_name']  = $shop_row['shop_name'];
		$renew_row['shop_id']    = $shop_row['shop_id'];
		//续费结束时间等于店铺结束时间 + 续费的年数
		$renew_row['end_time'] = date("Y-m-d H:i:s", strtotime("$shop_row[shop_end_time] + $renew_row[renew_time] year"));
		$renew_row['status']   = 0;
        //获取店铺位置
        $renew_row['district_id']  = $shop_row['district_id'];
		$flag                  = $this->shopRenewalModel->addRenewal($renew_row);
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

	public function delRenew()
	{
		$renew_id = request_string('id');
		$shop_id  = Perm::$shopId;
		if ($renew_id)
		{
			//判断是不是当前用户操作的
			$renew_info = $this->shopRenewalModel->getOne($renew_id);
			if ($shop_id == $renew_info['shop_id'])
			{
				$flag = $this->shopRenewalModel->removeRenewal($renew_id);
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
			else
			{
				$status = 250;
				$msg    = _('failure');
			}

		}
		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);
	}

	//加载添加类目页面
	public function addCategory()
	{
	    if('json' == $this->typ)
        {
            $data['product_class_id'] = request_string('cat_id');
            if ($data['product_class_id'] != "")
            {
                $is_key_exists = $this->shopClassBindModel->getKeyByWhere(['shop_id'=>Perm::$shopId,'product_class_id'=>$data['product_class_id']]);

                if(!$is_key_exists)
                {
                    $good_cat = $this->goodsCatModel->getOne($data['product_class_id']);
                    if($good_cat)
                    {
                        $data['commission_rate']        = $good_cat['cat_commission'];
                        $data['shop_class_bind_enable'] = "1";
                        $data['shop_id']                = Perm::$shopId;
                        $flag                           = $this->shopClassBindModel->addClassBind($data);
                    }
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
            }
            else
            {
                $status = 250;
                $msg    = _('failure');
            }

            $date = array();
            $this->data->addBody(-140, $date, $msg, $status);
        }
        else
        {
            include $this->view->getView();
        }
	}

    /**
     *
     */
	public function checkCategory()
    {
        if('json' == $this->typ)
        {
            $product_class_id = request_string('cat_id');
            if($product_class_id)
            {
                $is_key_exists = $this->shopClassBindModel->getKeyByWhere(['shop_id'=>Perm::$shopId,'product_class_id'=>$product_class_id]);
                if($is_key_exists)
                {
                    $status = 250;
                    $msg    = _('failure');
                }
                else
                {
                    $status = 200;
                    $msg    = _('success');
                }
            }
            else
            {
                $status = 270;
                $msg    = _('failure');
            }

            $this->data->addBody(-140, [], $msg, $status);
        }
    }

}

?>