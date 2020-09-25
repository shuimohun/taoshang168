<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Shop_BaseModel extends Shop_Base
{
    const SHOP_TYPE_1 = 1;  //普通店铺
    const SHOP_TYPE_2 = 2;  //供应商店铺

	const SHOP_STATUS_OPEN = 3;  //开启

    const SHOP_STATUS_SH = 6;  //补全审核资料
    const SHOP_STATUS_FK = 7;  //补全审核付款

    const SHOP_STATUS_NPASS = 8; // 审核店铺不通过

    const SHOP_STATUS_PERSON = 9; // 个人店铺

	const SELF_SUPPORT_TRUE  = 'true';
	const SELF_SUPPORT_FALSE = 'false';

	const SHOP_ALL_CLASS_TRUE = 1;

	const ADMIN_SHOP_ID = 0; //admin上传图片
	const ADMIN_USER_ID = 0; //admin上传图片

    const SHENGXIAN = 24;//生鲜特产的id

	public static $shop_status            = array(
		"0" => "关闭",
		"1" => "待审核信息",
		"2" => "待审核付款",
		"3" => "开店成功",
		"5" => "开户银行信息",
		"4" => "审核未通过",
        "6" => "待补全审核资料",
        "7" => "待补全审核付款",
        "8" => "开店审核不通过",
        "9" => "个人店铺",
	);
	public static $shop_all_class         = array(
		"0" => "否",
		"1" => "是"
	);
	public static $shop_class_bind_enable = array(
		"1" => "不启用",
		"2" => "启用"
	);
	public static $shop_grade_name        = '自营店铺';
	public static $shop_payment           = array(
		"0" => "未付款",
		"1" => "已付款"
	);


	/**
	 * 读取店铺列表
	 *
	 * @param  int $config_key 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getBaseList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
		$data           = $this->listByWhere($cond_row, $order_row, $page, $rows);

		$shopClassModel = new Shop_ClassModel();
		$shopGradeModel = new Shop_GradeModel();
        $shopCompanyModel   = new Shop_CompanyModel();

		//把数据库的状态以及分类id 和等级id全部变成中文。
		foreach ($data["items"] as $key => $value)
		{
			$data["items"][$key]["shop_status_cha"]    = _(self::$shop_status[$value["shop_status"]]);
			$data["items"][$key]["shop_all_class_cha"] = _(self::$shop_all_class[$value["shop_all_class"]]);
			$data["items"][$key]["shop_payment_cha"]   = _(self::$shop_payment[$value["shop_payment"]]);
			if ($value['shop_class_id'])
			{
				//获取分类名
				$shop_class_id                     = $value['shop_class_id'];
				$data["items"][$key]["shop_class"] = $shopClassModel->getClassName("$shop_class_id");
			}
			if ($value['shop_grade_id'])
			{
				//获取等级名
				$shop_grade_id                     = $value['shop_grade_id'];
				$data["items"][$key]["shop_grade"] = $shopGradeModel->getGradeName("$shop_grade_id");

			}

            $company            = $shopCompanyModel->getOne($value['shop_id']);

            $data['items'][$key] = array_merge($data['items'][$key], $company);

		}
		return $data;
	}
    /**
     * 根据分类淘金商品读取列表
     */
    public function getIdBaseList($cond_row = array(), $order_row = array(), $ids = array(),$page = 1, $rows = 100)
    {
        $data           = $this->listById($cond_row,$order_row,$ids,$page, $rows);

        $shopClassModel = new Shop_ClassModel();
        $shopGradeModel = new Shop_GradeModel();
        $shopCompanyModel   = new Shop_CompanyModel();
        //把数据库的状态以及分类id 和等级id全部变成中文。
        foreach ($data["items"] as $key => $value)
        {

            $data["items"][$key]["shop_status_cha"]    = _(self::$shop_status[$value["shop_status"]]);
            $data["items"][$key]["shop_all_class_cha"] = _(self::$shop_all_class[$value["shop_all_class"]]);
            $data["items"][$key]["shop_payment_cha"]   = _(self::$shop_payment[$value["shop_payment"]]);
            if ($value['shop_class_id'])
            {
                //获取分类名
                $shop_class_id                     = $value['shop_class_id'];
                $data["items"][$key]["shop_class"] = $shopClassModel->getClassName("$shop_class_id");
            }
            if ($value['shop_grade_id'])
            {
                //获取等级名
                $shop_grade_id                     = $value['shop_grade_id'];
                $data["items"][$key]["shop_grade"] = $shopGradeModel->getGradeName("$shop_grade_id");
            }

            $company            = $shopCompanyModel->getOne($value['shop_id']);
            $data['items'][$key] = array_merge($data['items'][$key], $company);

        }
        return $data;
    }

	/**
	 * 根据店铺id 获取该店铺的详细信息
	 *
	 * @author WenQingTeng
	 */
	public function getShopDetail($shop_id)
	{
		$data = $this->getOne($shop_id);
		if ($data)
		{
            $data = $this->getShopDetailData($data);
		}
		return $data;
	}

	public function getShopDetailData($data)
    {
        $data["shop_status_cha"]    = _(self::$shop_status[$data["shop_status"]]);
        $data["shop_all_class_cha"] = _(self::$shop_all_class[$data["shop_all_class"]]);

        if (!$data['shop_self_support'])
        {
            if ($data['shop_class_id'])
            {
                //获取分类名
                $shopClassModel     = new Shop_ClassModel();
                $shop_class_id      = $data['shop_class_id'];
                $data["shop_class"] = $shopClassModel->getClassName("$shop_class_id");
            }
        }

        if ($data['shop_grade_id'])
        {
            //获取等级名
            $shopGradeModel     = new Shop_GradeModel();
            $shop_grade_id      = $data['shop_grade_id'];
            $data["shop_grade"] = $shopGradeModel->getGradeName("$shop_grade_id");
        }
        else
        {
            $data["shop_grade"] = _(self::$shop_grade_name);
        }

        //计算店铺动态评分
        $Shop_EvaluationModel = new Shop_EvaluationModel();
        $shop_evaluation      = $Shop_EvaluationModel->getByWhere(array('shop_id' => $data['shop_id']));
        $evaluation_num       = count($shop_evaluation);

        $desc_scores    = 0;    //描述相符评分
        $service_scores = 0;    //服务态度评分
        $send_scores    = 0;   //发货速度评分
        foreach ($shop_evaluation as $key => $val)
        {
            $desc_scores += $val['evaluation_desccredit'];
            $service_scores += $val['evaluation_servicecredit'];
            $send_scores += $val['evaluation_deliverycredit'];
        }
        if ($evaluation_num)
        {
            $shop_desc_scores    = round($desc_scores / $evaluation_num, 2);
            $shop_service_scores = round($service_scores / $evaluation_num, 2);
            $shop_send_scores    = round($send_scores / $evaluation_num, 2);
        }
        else
        {
            $shop_desc_scores    = 5;
            $shop_service_scores = 5;
            $shop_send_scores    = 5;
        }

        $all_shop_eval      = $Shop_EvaluationModel->getByWhere();
        $all_eval_num       = count($all_shop_eval);
        $all_desc_scores    = 0;    //描述相符评分
        $all_service_scores = 0;    //服务态度评分
        $all_send_scores    = 0;   //发货速度评分
        foreach ($all_shop_eval as $key => $val)
        {
            $all_desc_scores += $val['evaluation_desccredit'];
            $all_service_scores += $val['evaluation_servicecredit'];
            $all_send_scores += $val['evaluation_deliverycredit'];
        }

        $data['shop_desc_scores']    = $shop_desc_scores > 0 ? $shop_desc_scores : 5;
        $data['shop_service_scores'] = $shop_service_scores > 0 ? $shop_service_scores : 5;
        $data['shop_send_scores']    = $shop_send_scores > 0 ? $shop_send_scores : 5;

        if ($all_eval_num == 0)
        {
            $data['com_desc_scores']    = 100;
            $data['com_service_scores'] = 100;
            $data['com_send_scores']    = 100;
        }
        else
        {
            $avg_desc_scores    = round($all_desc_scores / $all_eval_num, 2);
            $avg_service_scores = round($all_service_scores / $all_eval_num, 2);
            $avg_send_scores    = round($all_send_scores / $all_eval_num, 2);

            $data['com_desc_scores']    = round(($data['shop_desc_scores'] - $avg_desc_scores) / $avg_desc_scores * 100, 2);
            $data['com_service_scores'] = round(($data['shop_service_scores'] - $avg_service_scores) / $avg_service_scores * 100, 2);
            $data['com_send_scores']    = round(($data['shop_send_scores'] - $avg_send_scores) / $avg_send_scores * 100, 2);
        }

        //获取店铺支持的消费者保障服务
        $Shop_ContractModel = new Shop_ContractModel();
        $Shop_ContractTypeModel = new Shop_ContractTypeModel();
        $cond_con['shop_id']	        = $data['shop_id'];
        $cond_con['contract_state']	    = Shop_ContractModel::CONTRACT_JOIN;
        $cond_con['contract_use_state'] = Shop_ContractModel::CONTRACT_INUSE;
        $contract = $Shop_ContractModel->getByWhere($cond_con);
        foreach($contract as $ckey => $cval)
        {
            $contract_type =  $Shop_ContractTypeModel->getOne($cval['contract_type_id']);
            if($contract_type && $contract_type['contract_type_state'] == Shop_ContractTypeModel::CONTRACT_OPEN)
            {
                $contract[$ckey]['contract_type_logo'] = $contract_type['contract_type_logo'];
                $contract[$ckey]['contract_type_url'] = $contract_type['contract_type_url'];
                $contract[$ckey]['contract_type_desc'] = $contract_type['contract_type_desc'];
            }
            else
            {
                unset($contract[$ckey]);
            }
        }
        $data['contract'] = $contract;

        $goodsCommonModel = new Goods_CommonModel();
        $goods_state_normal_num   = $goodsCommonModel->getCommonStateNum($data['shop_id'], Goods_CommonModel::GOODS_STATE_NORMAL,Goods_CommonModel::GOODS_VERIFY_ALLOW);
        $data['goods_state_normal_num'] = $goods_state_normal_num;

        return $data;
    }

	/**
	 * 读取单个店铺
	 *
	 * @param  int $config_key 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getBaseOneList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
		$data = $this->getOneByWhere($cond_row, $order_row, $page, $rows);

		//把数据库的状态以及分类id 和等级id全部变成中文。

		if ($data)
		{
			$data["shop_status_cha"]    = _(self::$shop_status[$data["shop_status"]]);
			$data["shop_all_class_cha"] = _(self::$shop_all_class[$data["shop_all_class"]]);

			if (!$data['shop_self_support'])
			{
				if ($data['shop_class_id'])
				{
					//获取分类名
					$shopClassModel     = new Shop_ClassModel();
					$shop_class_id      = $data['shop_class_id'];
					$data["shop_class"] = $shopClassModel->getClassName("$shop_class_id");
				}
			}

			if ($data['shop_grade_id'])
			{
				//获取等级名
				$shopGradeModel         = new Shop_GradeModel();
				$shop_grade_id          = $data['shop_grade_id'];
				$data["shop_grade"]     = $shopGradeModel->getGradeName("$shop_grade_id");
				$data["shop_grade_row"] = $shopGradeModel->getOne($shop_grade_id);
			}
			else if($data['shop_self_support'] == 'true')
            {
                $data["shop_grade"] = _(self::$shop_grade_name);
            }

		}

		return $data;
	}

    public function getShopBaseOneList($data)
    {
        if ($data)
        {
            $data["shop_status_cha"]    = _(self::$shop_status[$data["shop_status"]]);
            $data["shop_all_class_cha"] = _(self::$shop_all_class[$data["shop_all_class"]]);

            if (!$data['shop_self_support'])
            {
                if ($data['shop_class_id'])
                {
                    //获取分类名
                    $shopClassModel     = new Shop_ClassModel();
                    $shop_class_id      = $data['shop_class_id'];
                    $data["shop_class"] = $shopClassModel->getClassName("$shop_class_id");
                }
            }

            if ($data['shop_grade_id'])
            {
                //获取等级名
                $shopGradeModel         = new Shop_GradeModel();
                $shop_grade_id          = $data['shop_grade_id'];
                $data["shop_grade"]     = $shopGradeModel->getGradeName("$shop_grade_id");
                $data["shop_grade_row"] = $shopGradeModel->getOne($shop_grade_id);
            }
            else if($data['shop_self_support'] == 'true')
            {
                $data["shop_grade"] = _(self::$shop_grade_name);
            }

        }

        return $data;
    }


	//多条件获取主键
	public function getShopId($cond_row = array(), $order_row = array())
	{

		return $this->getKeyByMultiCond($cond_row, $order_row);

	}

	/**
	 * 读取添加成功的数据
	 *
	 * @param  int $config_key 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getBaseWhere($cond_row = array(), $order_row = array())
	{

		$datas = $this->getByWhere($cond_row, $order_row);
		foreach ($datas as $key => $value)
		{
			$data["shop_status_cha"]    = _(self::$shop_status[$value["shop_status"]]);
			$data["shop_all_class_cha"] = _(self::$shop_all_class[$value["shop_all_class"]]);
			$data['shop_id']            = $value['shop_id'];
			$data['shop_name']          = $value['shop_name'];
		}
		return $data;

	}

	/**
	 * 获取店铺所有的开店信息
	 *
	 * @param  int $config_key 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */

	public function getbaseAllList($shop_id = null)
	{

		$shopCompanyModel   = new Shop_CompanyModel();
		$shopClassBindModel = new Shop_ClassBindModel();
		$shopClassModel     = new Shop_ClassModel();
		$shopGradeModel     = new Shop_GradeModel();
        $ShopCatCertificateModel = new Shop_CatCertificateModel();

        $company            = $shopCompanyModel->getCompanyrow($shop_id);

		/*if($company[$shop_id]['certificate'])
        {
            $certificate_ids = array_keys($company[$shop_id]['certificate']);
            $shop_cer_rows = $ShopCertificateModel->getCertificate($certificate_ids,array('display_order'=>'asc'));

            foreach ($shop_cer_rows as $key=>$val)
            {
                if(array_key_exists($val['id'],$company[$shop_id]['certificate']))
                {
                    $shop_cer_rows[$key]['image'] = $company[$shop_id]['certificate'][$val['id']];
                }
            }

            $company[$shop_id]['cer_data'] = $shop_cer_rows;
        }*/

		$data['base'] = $this->getBase($shop_id);
		//把两个数组拼成一个数组
		foreach ($data['base'] as $key => $value)
		{
			if ($company)
			{
				$data['base'][$key] = array_merge($data['base'][$key], $company[$key]);

				if ($value['shop_class_id'])
				{
					//获取分类名
					$shop_class_id                    = $value['shop_class_id'];
					$data['base'][$key]["shop_class"] = $shopClassModel->getClass("$shop_class_id");
				}
				if ($value['shop_grade_id'])
				{
					//获取等级名
					$shop_grade_id                    = $value['shop_grade_id'];
					$data['base'][$key]["shop_grade"] = $shopGradeModel->getGrade("$shop_grade_id");
				}

				$data['base'][$key]['classbind'] = $shopClassBindModel->getClassBind(array("shop_id" => $shop_id));
			}
		}

        if($data['base'][$shop_id]['classbind'] && $data['base'][$shop_id]['classbind']['product_parent_name'])
        {
            //集合 存放所有分类id
            $all_cat_ids = array();
            foreach ($data['base'][$shop_id]['classbind']['product_parent_name'] as $k=>$v)
            {
                $all_cat_ids = array_merge($all_cat_ids,array_column($v,'cat_id'));
            }

            if($all_cat_ids)
            {
                //分类id去重
                $all_cat_ids = array_unique($all_cat_ids);
                $shop_cer_rows = $ShopCatCertificateModel->getShopCatCertificateII($all_cat_ids);
            }

            if($company[$shop_id]['certificate'])
            {
                foreach ($shop_cer_rows as $key=>$val)
                {
                    if(array_key_exists($val['id'],$company[$shop_id]['certificate']))
                    {
                        $shop_cer_rows[$key]['image'] = $company[$shop_id]['certificate'][$val['id']];
                    }
                    else
                    {
                        $shop_cer_rows[$key]['is_defect'] = 1;
                    }
                }
            }

            $data['base'][$shop_id]['cer_data'] = $shop_cer_rows;
        }

		return $data;

	}


	/**
	 * 获取店铺所有的开店信息
	 *
	 * @param  int $config_key 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */

	public function getbaseCompanyList($shop_id = null)
	{

		$shopCompanyModel   = new Shop_CompanyModel();
		$shopClassBindModel = new Shop_ClassBindModel();
		$company            = $shopCompanyModel->getCompanyrow($shop_id);

		$shop_base = $this->getBase($shop_id);
		$data = array();
		//把两个数组拼成一个数组
		foreach ($shop_base as $key => $value)
		{
			if ($company)
			{
				$data = array_merge($shop_base[$key], $company[$key]);

				if ($value['shop_class_id'])
				{
					//获取分类名
					$shopClassModel     = new Shop_ClassModel();
					$shop_class_id      = $value['shop_class_id'];
					$data["shop_class"] = $shopClassModel->getClass("$shop_class_id");
				}
				if ($value['shop_grade_id'])
				{
					//获取等级名
					$shopGradeModel     = new Shop_GradeModel();
					$shop_grade_id      = $value['shop_grade_id'];
					$data["shop_grade"] = $shopGradeModel->getGrade("$shop_grade_id");
				}

				$data['classbind'] = $shopClassBindModel->getClassBindlist(array("shop_id" => $shop_id));
			}
		}
		return $data;

	}

	/**
	 * 获取店铺经营类目
	 *
	 * @param  int $config_key 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getCategorylist($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
		//$data  = array();
		$cat_num            = array();
		$shopClassBindModel = new Shop_ClassBindModel();
		$data               = $shopClassBindModel->listClassBindWhere($cond_row, $order_row, $page, $rows);
		//循环查询出店铺名字，以及类目名
		foreach ($data['items'] as $key => $value)
		{
			$data['items'][$key]['shop_class_bind_enablecha'] = _(self::$shop_class_bind_enable[$value['shop_class_bind_enable']]);
			$data['items'][$key]['shop_name']                 = $this->getshopName($value['shop_id']);
			$data['items'][$key]['user_name']                 = $this->getuserName($value['shop_id']);
			$product_class_id                                 = $value['product_class_id'];

			$cat_num                            = $this->catNameNum($product_class_id);
			$data['items'][$key]['cat_namenum'] = implode(" --> ", $cat_num);

		}

		return $data;
	}

	/**
	 * 根据分类id 获取所有的经营类目名称
	 *
	 * @param  array $cond_row
	 * @return array $rows 信息
	 * @access public
	 */
	public function catNameNum($product_class_id = null, $level = 100)
	{
		$product_name = array();
		// $product_cat= array();
		$CatModel    = new Goods_CatModel();
		$product_cat = $CatModel->getOne($product_class_id);
		//循环父类经营类目把子类插进去
		if ($product_cat)
		{
			$product_name[$level] = $product_cat['cat_name'];
			$cat_id               = $product_cat['cat_parent_id'];
			if ($cat_id)
			{
				$level--;
				$rs           = call_user_func_array(array(
														 $this,
														 'catNameNum'
													 ), array(
														 $cat_id,
														 $level
													 ));
				$product_name = $product_name + $rs;
			}
		}
		//数组颠倒
		ksort($product_name);
		return $product_name;
	}


	/**
	 * 获取店铺结算周期
	 *
	 * @param  int $config_key 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */

	public function getSettlementCycle($shop_id = null)
	{
		$cond_row = array();
		if ($shop_id)
		{
			$cond_row['shop_id'] = $shop_id;
		}

		$cond_row['shop_status'] = Shop_BaseModel::SHOP_STATUS_OPEN;
		$shop_info = $this->getByWhere($cond_row);

		$data = array();

		foreach ($shop_info as $key => $val)
		{
			$data[$key]['shop_id']               = $val['shop_id'];
			$data[$key]['shop_name']             = $val['shop_name'];
			$data[$key]['shop_settlement_cycle'] = $val['shop_settlement_cycle'];
			$data[$key]['shop_settlement_last_time'] = $val['shop_settlement_last_time'];
			$data[$key]['shop_create_time']      = $val['shop_create_time'];
			$data[$key]['user_id']				   = $val['user_id'];
			$data[$key]['user_name']			   = $val['user_name'];
            $data[$key]['district_id']			   = $val['district_id'];
		}

		return $data;
	}

	/**
	 * 更改店铺免运费额度
	 *
	 * @param  int $config_key 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function editFreightAmount($shop_id)
	{
		$update_flag = $this->edit($shop_id, array('shop_free_shipping' => request_int('free_shipping')));
		return $update_flag;
	}

	/**
	 * 获取店铺免运费额度
	 *
	 * @param  int $config_key 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getShopBaseInfo($shop_id)
	{
		$data = $this->getOne($shop_id);
		return $data;
	}

	/*
	 * 发货单打印设置
	 */
	public function setPrint($shop_id, $field_row)
	{
		$update_flag = $this->edit($shop_id, $field_row);
		return $update_flag;
	}
	
	/*
	 * 查店铺详情
	 */
	public function getShopListByGoodId($shop_id)
	{
		if (is_array($shop_id))
		{
			$cond_row = array('shop_id:in' => $shop_id);

		}
		else
		{
			$cond_row = array('shop_id' => $shop_id);

		}

		return $this->getByWhere($cond_row);
	}
	
	
	//获取店铺的销量
	function getShopSales($shop_id,$date)
	{
		$orderModel = new Order_BaseModel();
		$cond_row['shop_id'] = $shop_id;
		$cond_row['order_create_time:>='] = $date;
		$cond_row['order_status:>='] = Order_StateModel::ORDER_PAYED;
		$cond_row['order_is_virtual'] = 0;
		
		$orders = $orderModel->getByWhere($cond_row);
		$data = array();
		$data['sales_num'] = count($orders);
		$data['order_sales'] =  $orders?array_sum(array_column($orders,'order_payment_amount')):0;
		
		return $data;
	}
    
    
    
    /**
     * 取的附近的店铺  单位米
     *
     * @param  float $lat
     * @param  float $lng
     * @param  int $distance 小于范围
     * @return array $rows 返回的查询内容
     * @access public
     */
    public function getNearShop($lat, $lng, $distance=20000, $page = 1, $rows=10)
    {
        $offset = max(0, $rows * ($page-1));
    
        $shop_entity = TABEL_PREFIX . 'shop_entity';
        
        $sql = "
SELECT * FROM
	(SELECT  s.*, e.entity_xxaddr, (round(6378.138*2*asin(sqrt(pow(sin( (e.lat*pi()/180-$lat*pi()/180)/2),2)+cos(e.lat*pi()/180)*cos($lat*pi()/180)* pow(sin( (e.lng*pi()/180-$lng*pi()/180)/2),2)))*1000)) as distance FROM " . $this->_tableName . " s LEFT JOIN  " . $shop_entity . " e ON s.shop_id = e.shop_id WHERE 1 and s.shop_status=" . Shop_BaseModel::SHOP_STATUS_OPEN .  " ORDER BY distance ASC limit 200) as temp
WHERE
	distance < $distance
ORDER BY distance ASC
limit $offset, $rows
";
        
        $shop_rows = $this->sql->getAll($sql);
        $total = $this->getFoundRows();
    
        $data = array();
        $data['page'] = $page;
        $data['total'] = ceil_r($total / $rows);  //total page
        $data['totalsize'] = $total;
        $data['records'] = $total;
    
        $data['items'] = array_values($shop_rows);
    
    
        $shopClassModel = new Shop_ClassModel();
        $shopGradeModel = new Shop_GradeModel();
        $shopCompanyModel   = new Shop_CompanyModel();
        //把数据库的状态以及分类id 和等级id全部变成中文。
        foreach ($data["items"] as $key => $value)
        {
        
            $data["items"][$key]["shop_status_cha"]    = _(self::$shop_status[$value["shop_status"]]);
            $data["items"][$key]["shop_all_class_cha"] = _(self::$shop_all_class[$value["shop_all_class"]]);
            $data["items"][$key]["shop_payment_cha"]   = _(self::$shop_payment[$value["shop_payment"]]);
            if ($value['shop_class_id'])
            {
                //获取分类名
                $shop_class_id                     = $value['shop_class_id'];
                $data["items"][$key]["shop_class"] = $shopClassModel->getClassName("$shop_class_id");
            }
            if ($value['shop_grade_id'])
            {
                //获取等级名
                $shop_grade_id                     = $value['shop_grade_id'];
                $data["items"][$key]["shop_grade"] = $shopGradeModel->getGradeName("$shop_grade_id");
            }
        
            $company            = $shopCompanyModel->getOne($value['shop_id']);
            $data['items'][$key] = array_merge($data['items'][$key], $company);
        
        }
    
        //$data['items'] = array_values($shop_rows);
        
        return $data;
    }

	public function getSubQuantity($cond_row)
	{
		return $this->getNum($cond_row);
	}

    //店铺总数获取
    function shop_num(){
        return $this->_num();
    }

    //查询某字段
    public function getShopinsert($field = '*',$cond_row,$group)
    {
        return $this->select($field,$cond_row,$group);
    }

    //执行sql
    public function sql($sql){
        return $this->sql->getAll($sql);
    }

    public function getNewStoreStatList($field = '*', $group = '') {
        $sql = "select ".$field." from YLB_shop_base group by ".$group." order by shop_id desc";
        return $this->sql->getAll($sql);
    }

    //新增店铺
    public function create_shop(){
        $cond['shop_create_time:>='] = date('Y-m-d', strtotime('this week'));
        return $this->getRowCount($cond);
    }

    //子账号--自营账户
    public function isShopExist($cond_row)
    {
        $row = $this->getOneByWhere($cond_row);
        return empty($row)?false:true;
    }
}

?>