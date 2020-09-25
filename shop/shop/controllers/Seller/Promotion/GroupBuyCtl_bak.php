<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}


class Seller_Promotion_GroupBuyCtl extends Seller_Controller
{
	public $groupBuyBaseModel  = null;
	public $groupBuyQuotaModel = null;
	public $groupBuyCatModel   = null;
	public $groupBuyAreaModel  = null;
	public $goodsBaseModel     = null;
	public $shopCostModel      = null;
	public $shopBaseModel      = null;

	public $comboFlag       = false; //套餐是否可用
	public $shopInfo        = array();  //店铺信息
	public $selfSupportFlag = false;    //是否为自营店铺

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

		if (!Web_ConfigModel::value('groupbuy_allow')) //团购功能设置，关闭，跳转到卖家首页
		{
			if ("e" == $this->typ)
			{
				$this->view->setMet('error');
				include $this->view->getView();
				die;
			}
			else
			{
				$data = new YLB_Data();
				$data->setError(_('团购功能已关闭'), 30);
				$d = $data->getDataRows();

				$protocol_data = YLB_Data::encodeProtocolData($d);
				echo $protocol_data;
				exit();
			}
		}

		$this->groupBuyBaseModel  = new GroupBuy_BaseModel();
		$this->groupBuyQuotaModel = new GroupBuy_QuotaModel();
		$this->groupBuyCatModel   = new GroupBuy_CatModel();
		$this->groupBuyAreaModel  = new GroupBuy_AreaModel();
		$this->goodsBaseModel     = new Goods_BaseModel();
		$this->shopCostModel      = new Shop_CostModel();
		$this->shopBaseModel      = new Shop_BaseModel();

		$this->shopInfo        = $this->shopBaseModel->getOne(Perm::$shopId);//店铺信息
		$this->selfSupportFlag = ($this->shopInfo['shop_self_support'] == "true" || Web_ConfigModel::value('groupbuy_price') == 0) ? true : false; //是否为自营店铺标志

		if ($this->selfSupportFlag) //平台店铺，没有套餐限制
		{
			$this->comboFlag = true;
		}
		else
		{
			$this->comboFlag = $this->groupBuyQuotaModel->checkQuotaStateByShopId(Perm::$shopId); //普通店铺需要查询套餐状态
		}
	}

	/**
	 * 首页
	 * 团购活动列表
	 * @access public
	 */
	public function index()
	{
		$combo_row = array();

		//分页
		$YLB_Page           = new YLB_Page();
		$YLB_Page->listRows = request_int('listRows')?request_int('listRows'):10;
		$rows              = $YLB_Page->listRows;
		$offset            = request_int('firstRow', 0);
		$page              = ceil_r($offset / $rows);

		$cond_row['shop_id'] = Perm::$shopId;

		if (request_int('type'))
		{
			$cond_row['groupbuy_type'] = request_int('type');
		}
		if (request_int('state'))
		{
			$cond_row['groupbuy_state'] = request_int('state');
		}
		if (request_string('keyword'))
		{
			$cond_row['groupbuy_name:LIKE'] = '%'.request_string('keyword') . '%';
		}

		$data               = $this->groupBuyBaseModel->getGroupBuyGoodsList($cond_row, array('groupbuy_id' => 'DESC'), $page, $rows);
		$YLB_Page->totalRows = $data['totalsize'];
		$page_nav           = $YLB_Page->prompt();

		$shop_type = $this->selfSupportFlag;
		if (!$this->selfSupportFlag)  //普通店铺
		{
			$com_flag = $this->comboFlag;
			if ($this->comboFlag)//套餐可用
			{
				$combo_row = $this->groupBuyQuotaModel->getGroupBuyQuotaByShopID(Perm::$shopId);
			}
		}

		if('json' == $this->typ)
		{
			$json_data['data']		= $data;
			$json_data['shop_type'] = $shop_type;
			$json_data['combo_flag']= $this->comboFlag;
			$json_data['combo'] 	= $combo_row;
			$this->data->addBody(-140, $json_data);
		}
		else
		{
			include $this->view->getView();
		}

	}

	/* 添加实物团购页面 */
	public function add()
	{
		$data                 = array();
		$data['combo']        = array();
		$data['groupbuy_cat'] = $this->groupBuyCatModel->getGroupBuyCatJson(GroupBuy_CatModel::PHYSICALCAT);//获取团购分类，实物团购
		$shop_type            = $this->selfSupportFlag;

        if (!$this->selfSupportFlag)  //普通店铺
		{
			if (!$this->comboFlag)
			{
				location_to(YLB_Registry::get('url') . '?ctl=Seller_Promotion_GroupBuy&met=index&typ=e');
			}
			else
			{
				$data['combo'] = $this->groupBuyQuotaModel->getGroupBuyQuotaByShopID(Perm::$shopId);
			}
		}
		else
		{
			$data['combo']['combo_endtime'] = date("Y-m-d H:i:s", strtotime("11 june 2030"));
		}
		if (Web_ConfigModel::value('groupbuy_review_day'))
		{
			$review_days                      = Web_ConfigModel::value('groupbuy_review_day');
			$data['combo']['combo_starttime'] = date('Y-m-d H:i:s', strtotime("+$review_days days"));
		}
		else
		{
			$data['combo']['combo_starttime'] = date('Y-m-d H:i:s');
		}

		if('json' == $this->typ)
		{
			$this->data->addBody(-140, $data);
		}
		else
		{
            $data['groupbuy_cat'] = encode_json($data['groupbuy_cat']);
			include $this->view->getView();
		}

	}

	/* 添加实物团购 */
	public function addGroupBuy()
	{
		if (!$this->comboFlag)
		{
			$msg_label    = _('套餐不可用！');
			$flag = false;
		}
		else
		{
			$rs_row = array();
			$check_post_data_flag = true;

			$Goods_CommonModel = new Goods_CommonModel();

			$field_row['groupbuy_name']             = request_string('groupbuy_name');
			if (empty($field_row['groupbuy_name']))
			{
				$check_post_data_flag = false;
				$msg_label = _('团购名称不能为空！');
			}

			$field_row['groupbuy_remark']           = request_string('groupbuy_remark');
			$field_row['groupbuy_starttime']        = request_string('groupbuy_starttime');
			$field_row['groupbuy_endtime']          = request_string('groupbuy_endtime');
			$field_row['groupbuy_price']            = request_float('groupbuy_price');
			$field_row['goods_id']                  = request_int('goods_id');
			$field_row['common_id']                 = request_int('common_id');

			if ($field_row['common_id'])
			{
				$cond_row_goods_common['common_id'] = $field_row['common_id'];
				$cond_row_goods_common['shop_id'] = Perm::$shopId;
				$goods_common_row = $Goods_CommonModel->getOneByWhere($cond_row_goods_common);

				if($goods_common_row)
				{
					if ($field_row['groupbuy_price'] > 0)
					{
						if ($field_row['groupbuy_price'] >= $goods_common_row['common_price'])
						{
							$check_post_data_flag = false;
							$msg_label = _('团购价格必须低于商品价格！');
						}
					}
					else
					{
						$check_post_data_flag = false;
						$msg_label = _('请输入正确的团购价格！');
					}
				}
				else
				{
					$check_post_data_flag = false;
					$msg_label = _('请选择参加团购的商品！');
				}
			}
			else
			{
				$check_post_data_flag = false;
				$msg_label = _('请选择参加团购的商品！');
			}

			$field_row['groupbuy_image']            = request_string('groupbuy_image');

			if (!$field_row['groupbuy_image'])
			{
				$check_post_data_flag = false;
				$msg_label = _('请上传团购活动图片！');
			}
			$field_row['groupbuy_upper_limit']      = request_int('groupbuy_upper_limit');

			if($field_row['groupbuy_upper_limit'] < 0)
			{
				$check_post_data_flag = false;
				$msg_label = _('限购数量有误！');
			}

			$field_row['groupbuy_image_rec']        = request_string('groupbuy_image_rec');
			$field_row['groupbuy_virtual_quantity'] = request_int('groupbuy_virtual_quantity');
			$field_row['groupbuy_cat_id']           = request_int('groupbuy_cat_id');
			$field_row['groupbuy_scat_id']          = request_int('groupbuy_scat_id');
			$field_row['groupbuy_intro']            = request_string('groupbuy_intro');
			$field_row['shop_id']                   = Perm::$shopId;
			$field_row['shop_name']                 = $this->shopInfo['shop_name'];
			$field_row['groupbuy_type']             = GroupBuy_BaseModel::ONLINEGBY;

			if ($check_post_data_flag)
			{
				$this->groupBuyBaseModel->sql->startTransactionDb();
				$insert_flag = $this->groupBuyBaseModel->addGroupBuy($field_row, true);
				check_rs($insert_flag, $rs_row);

				$update_flag       = $Goods_CommonModel->editCommon(request_int('common_id'), array('common_is_tuan' => 1));
				check_rs($update_flag, $rs_row);

				if (is_ok($rs_row) && $this->groupBuyBaseModel->sql->commitDb())
				{
					$flag = true;
				}
				else
				{
					$this->groupBuyBaseModel->sql->rollBackDb();
					$flag = false;
				}
			}
			else
			{
				$flag = false;
			}
		}

		if ($flag)
		{
			$msg    = _('添加成功！');
			$status = 200;
		}
		else
		{
			$msg    = $msg_label?$msg_label:_('添加失败！');
			$status = 250;
		}
		$data = array();

		$this->data->addBody(-140, $data, $msg, $status);
	}

	/* 增加虚拟团购页面 */
	public function addVr()
	{
		$data                 = array();
		$data['combo']        = array();
		$data['groupbuy_cat'] = $this->groupBuyCatModel->getGroupBuyCatJson(GroupBuy_CatModel::VIRTUAL);//获取团购分类，实物团购
		$data['area']         = $this->groupBuyAreaModel->getGroupBuyAreaByWhere(array('groupbuy_area_parent_id' => 0));

		$shop_type = $this->selfSupportFlag;
		if (!$this->selfSupportFlag)  //普通店铺
		{
			if (!$this->comboFlag)
			{
				location_to(YLB_Registry::get('url') . '?ctl=Seller_Promotion_GroupBuy&met=index&typ=e');
			}
			else
			{
				$data['combo'] = $this->groupBuyQuotaModel->getGroupBuyQuotaByShopID(Perm::$shopId);
			}
		}
		else
		{
			$data['combo']['combo_endtime'] = date("Y-m-d H:i:s", strtotime("11 june 2030"));
		}
		if (Web_ConfigModel::value('groupbuy_review_day')) //预审核时间限制
		{
			$review_days                      = Web_ConfigModel::value('groupbuy_review_day');
			$data['combo']['combo_starttime'] = date('Y-m-d H:i:s', strtotime("+$review_days days"));
		}
		else
		{
			$data['combo']['combo_starttime'] = date('Y-m-d H:i:s');
		}

		if('json' == $this->typ)
		{
			$this->data->addBody(-140, $data);
		}
		else
		{
            $data['groupbuy_cat'] = encode_json($data['groupbuy_cat']);
			include $this->view->getView();
		}

	}

	/* 添加虚拟团购*/
	public function addVrGroupBuy()
	{
		if (!$this->comboFlag)
		{
            $msg_label    = _('套餐不可用！');
			$flag = false;
		}
		else
		{
            $rs_row = array();
            $check_post_data_flag = true;
            $Goods_CommonModel = new Goods_CommonModel();

            $field_row['shop_id']                   = Perm::$shopId;
            $field_row['shop_name']                 = $this->shopInfo['shop_name'];
            $field_row['groupbuy_type']             = GroupBuy_BaseModel::VIRGBY;

            $field_row['groupbuy_name']             = request_string('groupbuy_name');
            if (empty($field_row['groupbuy_name']))
            {
                $check_post_data_flag = false;
                $msg_label = _('团购名称不能为空！');
            }
            $field_row['groupbuy_remark']           = request_string('groupbuy_remark');
            $field_row['groupbuy_starttime']        = request_string('groupbuy_starttime');
            $field_row['groupbuy_endtime']          = request_string('groupbuy_endtime');
            $field_row['groupbuy_price']            = request_float('groupbuy_price');
            $field_row['goods_id']                  = request_int('goods_id');
            $field_row['common_id']                 = request_int('common_id');

            if ($field_row['common_id'])
            {
                $cond_row_goods_common['common_id'] = $field_row['common_id'];
                $cond_row_goods_common['shop_id']   =  Perm::$shopId;
                $goods_common_row = $Goods_CommonModel->getOneByWhere($cond_row_goods_common);

                if($goods_common_row)
                {
                    if ($field_row['groupbuy_price'] > 0)
                    {
                        if ($field_row['groupbuy_price'] >= $goods_common_row['common_price'])
                        {
                            $check_post_data_flag = false;
                            $msg_label = _('团购价格必须低于商品价格！');
                        }
                    }
                    else
                    {
                        $check_post_data_flag = false;
                        $msg_label = _('请输入正确的团购价格！');
                    }
                }
                else
                {
                    $check_post_data_flag = false;
                    $msg_label = _('请选择参加团购的商品！');
                }
            }
            else
            {
                $check_post_data_flag = false;
                $msg_label = _('请选择参加团购的商品！');
            }

            $field_row['groupbuy_image']            = request_string('groupbuy_image');

            if (!$field_row['groupbuy_image'])
            {
                $check_post_data_flag = false;
                $msg_label = _('请上传团购活动图片！');
            }

            $field_row['groupbuy_image_rec']        = request_string('groupbuy_image_rec');
            $field_row['groupbuy_virtual_quantity'] = request_int('groupbuy_virtual_quantity');
            $field_row['groupbuy_upper_limit']      = request_int('groupbuy_upper_limit');

            if($field_row['groupbuy_upper_limit'] < 0)
            {
                $check_post_data_flag = false;
                $msg_label = _('限购数量有误！');
            }

            $field_row['groupbuy_cat_id']           = request_int('groupbuy_cat_id');
            $field_row['groupbuy_scat_id']          = request_int('groupbuy_scat_id');
            $field_row['groupbuy_city_id']          = request_int('city');
            $field_row['groupbuy_area_id']          = request_int('area');
            $field_row['groupbuy_intro']            = request_string('groupbuy_intro');

            if ($check_post_data_flag)
            {
                $this->groupBuyBaseModel->sql->startTransactionDb();
                $insert_flag                              = $this->groupBuyBaseModel->addGroupBuy($field_row, true);
                check_rs($insert_flag, $rs_row);

                $Goods_CommonModel = new Goods_CommonModel();
                $update_flag       = $Goods_CommonModel->editCommon(request_int('common_id'), array('common_is_tuan' => 1));
                check_rs($update_flag, $rs_row);

                if (is_ok($rs_row) && $this->groupBuyBaseModel->sql->commitDb())
                {
                    $flag = true;
                }
                else
                {
                    $this->groupBuyBaseModel->sql->rollBackDb();
                    $flag = false;
                }
            }
            else
            {
                $flag = false;
            }

		}

        if ($flag)
        {
            $msg    = _('添加成功！');
            $status = 200;
        }
        else
        {
            $msg    = $msg_label?$msg_label:_('添加失败！');
            $status = 250;
        }

		$data = array();

		$this->data->addBody(-140, $data, $msg, $status);
	}

	/* 验证商品是否已经参加过同时段的活动 */
	public function checkGroupBuyGoods()
	{
		$data = array();

		$cond_row_s['common_id']             = request_int('common_id');
		$cond_row_s['groupbuy_state:<=']     = GroupBuy_BaseModel::NORMAL;
		$cond_row_s['groupbuy_starttime:<='] = date('Y-m-d H:i:s', strtotime(request_string('start_time')));
		$cond_row_s['groupbuy_endtime:>=']   = date('Y-m-d H:i:s', strtotime(request_string('start_time')));
		$row_s                               = $this->groupBuyBaseModel->getGroupBuyDetailByWhere($cond_row_s);

		$cond_row_e['common_id']             = request_int('common_id');
		$cond_row_e['groupbuy_state:<=']     = GroupBuy_BaseModel::NORMAL;
		$cond_row_e['groupbuy_starttime:<='] = date('Y-m-d H:i:s', strtotime(request_string('end_time')));
		$cond_row_e['groupbuy_endtime:>=']   = date('Y-m-d H:i:s', strtotime(request_string('end_time')));
		$row_e                               = $this->groupBuyBaseModel->getGroupBuyDetailByWhere($cond_row_e);

		if ($row_s || $row_e)
		{
			if ($row_s['groupbuy_state'] <= GroupBuy_BaseModel::NORMAL || $row_e['groupbuy_state'] <= GroupBuy_BaseModel::NORMAL) //该商品已经参加了同一时段的活动，且状态正常
			{
				$msg    = _('该商品已经参加过同时段的活动！');
				$status = 250;
			}
			else
			{
				$msg    = _('该商品尚未参加过同时段的活动！');
				$status = 200;
			}
		}
		else
		{
			$msg    = _('该商品尚未参加过同时段的活动！');
			$status = 200;
		}

		$this->data->addBody(-140, $data, $msg, $status);
		
	}

	/*
	*购买套餐、套餐续费
	 *平台店铺可以免费发布活动
	 *后台可设置免费发布活动
	 * */
	public function combo()
	{
		if ($this->selfSupportFlag)
		{
            location_go_back(_('自营店铺或者套餐续费， 不需要设置。'));
			//location_to(YLB_Registry::get('url') . '?ctl=Seller_Promotion_GroupBuy&met=add&typ=e');
		}

		if('json' == $this->typ)
		{
			$data['groupbuy_price'] = Web_ConfigModel::value('groupbuy_price');
			$this->data->addBody(-140, $data);
		}
		else
		{
			include $this->view->getView();
		}

	}

	/*
	 * 在店铺的账期结算中扣除相关费用
	 * */
	public function addCombo()
	{
		$data      = array();
		$combo_row = array();
		$field     = array();
		$rs_row    = array();

		$month_price = Web_ConfigModel::value('groupbuy_price');
		$month       = request_int('month');
		$days        = 30 * $month;

        if($month > 0)
        {
            $this->groupBuyQuotaModel->sql->startTransactionDb();
            //记录到店铺费用表
            $field_row['user_id']     = Perm::$userId;
            $field_row['shop_id']     = Perm::$shopId;
            $field_row['cost_price']  = $month_price * $month;
            $field_row['cost_desc']   = _('店铺购买团购活动消费');
            $field_row['cost_status'] = 0;
            $field_row['cost_time']   = get_date_time();
            $flag                     = $this->shopCostModel->addCost($field_row, true);
            check_rs($flag, $rs_row);

            if ($flag)
            {
                //购买或续费套餐
                $combo_row = $this->groupBuyQuotaModel->getGroupBuyQuotaByShopID(Perm::$shopId);
                //记录已经存在，套餐续费
                if ($combo_row)
                {
                    //1、原套餐已经过期,更新套餐开始时间和结束时间
                    if (strtotime($combo_row['combo_endtime']) < time())
                    {
                        $field['combo_starttime'] = get_date_time();
                        $field['combo_endtime']   = date('Y-m-d H:i:s', strtotime("+$days days"));
                    }
                    elseif ((time() >= strtotime($combo_row['combo_starttime'])) && (time() <= strtotime($combo_row['combo_endtime'])))
                    {
                        //2、原套餐尚未过期，只需更新结束时间
                        $field['combo_endtime'] = date('Y-m-d H:i:s', strtotime("+$days days", strtotime($combo_row['combo_endtime'])));
                    }

                    $op_flag = $this->groupBuyQuotaModel->renewGroupBuyCombo($combo_row['combo_id'], $field);
                }
                else            //记录不存在，添加套餐
                {
                    $field['combo_starttime'] = get_date_time();
                    $field['combo_endtime']   = date('Y-m-d H:i:s', strtotime("+$days days"));
                    $field['shop_id']         = Perm::$shopId;
                    $field['shop_name']       = $this->shopInfo['shop_name'];
                    $field['user_id']         = Perm::$userId;
                    $field['user_nickname']   = Perm::$row['user_account'];

                    $op_flag = $this->groupBuyQuotaModel->addGroupBuyCombo($field, true);
                }
                check_rs($op_flag, $rs_row);
            }

			if(is_ok($rs_row))
			{
				//在paycenter中添加交易记录
				$key      = YLB_Registry::get('shop_api_key');
				$url         = YLB_Registry::get('paycenter_api_url');
				$shop_app_id = YLB_Registry::get('shop_app_id');

				$formvars             = array();
				$formvars['app_id']        = $shop_app_id;
				$formvars['buyer_user_id'] = Perm::$userId;
				$formvars['buyer_user_name'] = Perm::$row['user_account'];
				$formvars['amount'] = $month_price * $month;

				$rs                   = get_url_with_encrypt($key, sprintf('%s?ctl=Api_Pay_Pay&met=addCombo&typ=json', $url), $formvars);
			}

            if (is_ok($rs_row) && isset($rs) && $rs['status'] == 200 && $this->groupBuyQuotaModel->sql->commitDb())
            {
                $msg    = _('操作成功！');
                $status = 200;
            }
            else
            {
                $this->groupBuyQuotaModel->sql->rollBackDb();
                $msg    = _('操作失败！');
                $status = 250;
            }
        }
        else
        {
            $msg    = _('购买月份必须为正整数！');
            $status = 250;
        }



		$this->data->addBody(-140, $data, $msg, $status);
	}
	
	/**
	 * 调用接口
	 *获取店铺的实物商品列表
	 * 区别虚拟商品与实物商品
	 */
	public function getShopGoods()
	{
		$cond_row = array();

		//分页
		$YLB_Page           = new YLB_Page();
		$YLB_Page->listRows = request_int('listRows')?request_int('listRows'):12;
		$rows              = $YLB_Page->listRows;
		$offset            = request_int('firstRow', 0);
		$page              = ceil_r($offset / $rows);

		//需要加入商品状态限定
		$cond_row['common_state']  = Goods_CommonModel::GOODS_STATE_NORMAL;
		$cond_row['common_verify'] = Goods_CommonModel::GOODS_VERIFY_ALLOW;
		$cond_row['shop_status']   = Shop_BaseModel::SHOP_STATUS_OPEN;

		$cond_row['shop_id'] = Perm::$shopId;

		if (request_string('goods_typ') == 'virtual')
		{
			$cond_row['common_is_virtual'] = 1;//是否是虚拟商品
		}
		else
		{
			$cond_row['common_is_virtual'] = 0;
		}

		$goods_name = request_string('goods_name');
		if ($goods_name)
		{
			$cond_row['common_name:LIKE'] = "%".$goods_name . "%";
		}

		$Goods_CommonModel = new Goods_CommonModel();
		$goods_rows        = $Goods_CommonModel->getCommonNormal($cond_row, array('common_id' => 'DESC'), $page, $rows);
		$data              = $Goods_CommonModel->getRecommonRow($goods_rows);

		$YLB_Page->totalRows = $goods_rows['totalsize'];
		$page_nav           = $YLB_Page->prompt();

		if('json' == $this->typ)
		{
			$this->data->addBody(-140, $data);
		}
		else
		{
			include $this->view->getView();
		}

	}

    //根据团购城市ID查询下级地区
	public function getGroupBuyArea()
	{
        $cond_row['groupbuy_area_parent_id'] = request_int('area_id');
        $data                                = $this->groupBuyAreaModel->getGroupBuyAreaByWhere($cond_row);

		$this->data->addBody(-140, $data);
	}
}

?>