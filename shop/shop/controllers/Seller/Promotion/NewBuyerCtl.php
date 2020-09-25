<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}


class Seller_Promotion_NewBuyerCtl extends Seller_Controller
{
	public $newBuyerBaseModel  = null;
	public $newBuyerQuotaModel = null;
	public $goodsCommonModel   = null;
    public $goodsBaseModel     = null;
    public $shopBaseModel      = null;
    public $shopCostModel      = null;

	public $quota_flag        = false;   //套餐是否可用
	public $shop_info         = array();  //店铺信息
	public $self_support_flag = false;    //是否为自营店铺

	/**
	 * @param  string $ctl 控制器目录
	 * @param  string $met 控制器方法
	 * @param  string $typ 返回数据类型
	 * @access public
	 */
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);

		if (!Web_ConfigModel::value('promotion_allow')) //新人优惠功能设置，关闭，跳转到卖家首页
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
				$data->setError(_('促销功能已关闭'), 30);
				$d = $data->getDataRows();

				$protocol_data = YLB_Data::encodeProtocolData($d);
				echo $protocol_data;
				exit();
			}
		}

		$this->newBuyerBaseModel  = new NewBuyer_BaseModel();
		$this->newBuyerQuotaModel = new NewBuyer_QuotaModel();
		$this->goodsBaseModel     = new Goods_BaseModel();
        $this->goodsCommonModel   = new Goods_CommonModel();
        $this->shopBaseModel      = new Shop_BaseModel();
        $this->shopCostModel      = new Shop_CostModel();

		$this->shop_info         = $this->shopBaseModel->getOne(Perm::$shopId);//店铺信息
		$this->self_support_flag = ($this->shop_info['shop_self_support'] == "true" || Web_ConfigModel::value('promotion_newbuyer_price') == 0) ? true : false; //是否为自营店铺标志

		if ($this->self_support_flag) //平台店铺，没有套餐限制
		{
			$this->quota_flag = true;
		}
		else
		{
			$this->quota_flag = $this->newBuyerQuotaModel->checkQuotaStateByShopId(Perm::$shopId); //普通店铺需要查询套餐状态
		}
	}

    /**
     * 新人优惠活动列表页面
     */
	public function index()
	{
		$quota_row = array();

		//分页
		$YLB_Page           = new YLB_Page();
		$YLB_Page->listRows = request_int('listRows')?request_int('listRows'):10;
		$rows              = $YLB_Page->listRows;
		$offset            = request_int('firstRow', 0);
		$page              = ceil_r($offset / $rows);

		$cond_row['shop_id'] = Perm::$shopId;
		if (request_int('state'))
		{
			$cond_row['newbuyer_state'] = request_int('state');
		}
		if (request_string('keyword'))
		{
			$cond_row['goods_name:LIKE'] = '%'.request_string('keyword') . '%';
		}
		
		$data = $this->newBuyerBaseModel->getNewBuyerDataList($cond_row, array('newbuyer_id' => 'DESC'), $page, $rows);
		$YLB_Page->totalRows = $data['totalsize'];
		$page_nav = $YLB_Page->prompt();

		if (!$this->self_support_flag)  //普通店铺
		{
			if ($this->quota_flag)//套餐可用
			{
				$quota_row = $this->newBuyerQuotaModel->getNewBuyerQuotaByShopID(Perm::$shopId);
			}
		}

		if('json' == $this->typ)
		{
			$json_data['data']		= $data;
			$json_data['self_support_flag'] = $this->self_support_flag;
			$json_data['quota_flag']= $this->quota_flag;
			$json_data['quota'] 	= $quota_row;
			$this->data->addBody(-140, $json_data);
		}
		else
		{
			include $this->view->getView();
		}

	}

    /**
     * 添加新人优惠页面
     */
	public function add()
	{
		$data['quota']        = array();

        if (!$this->self_support_flag)  //普通店铺
		{
			if (!$this->quota_flag)
			{
				location_to(YLB_Registry::get('url') . '?ctl=Seller_Promotion_NewBuyer&met=index&typ=e');
			}
			else
			{
				$data['quota'] = $this->newBuyerQuotaModel->getNewBuyerQuotaByShopID(Perm::$shopId);
			}
		}
		else
		{
			$data['quota']['quota_endtime'] = date("Y-m-d H:i:s", strtotime("11 june 2030"));
		}

		$data['quota']['quota_starttime'] = date('Y-m-d H:i:s');

        //修改改成 在index只修改价格
		/*if (request_string('op') == 'edit')
		{
		    $cond_row['newbuyer_id'] = request_int('id');
		    $cond_row['shop_id']     = Perm::$shopId;
		    $data['goods']                    = $this->newBuyerBaseModel->getNewBuyerDetailByWhere($cond_row);
		    
		    $this->view->setMet('edit');
		}*/

		if('json' == $this->typ)
		{
			$this->data->addBody(-140, $data);
		}
		else
		{
			include $this->view->getView();
		}
	}

    /**
     * 添加
     */
	public function addNewBuyer()
	{
		if (!$this->quota_flag)
		{
			$msg_label    = _('套餐不可用！');
			$flag = false;
		}
		else
		{
			$rs_row = array();
			$check_post_data_flag = true;

			$field_row['newbuyer_starttime'] = request_string('newbuyer_starttime');
			$field_row['newbuyer_endtime']   = request_string('newbuyer_endtime');
            $field_row['newbuyer_name']      = request_string('newbuyer_name');
			$field_row['newbuyer_price']     = request_float('newbuyer_price');
            $field_row['goods_id']           = request_int('goods_id');
            $field_row['is_mian']            = request_int('is_mian');
            $field_row['is_man']             = request_int('is_man');
            $field_row['is_voucher']         = request_int('is_voucher');
            $field_row['is_jia']             = request_int('is_jia');
            $field_row['free_freight']       = request_int('free_freight');

			if ($field_row['goods_id'])
			{
			    //判断是否参加了同时段的活动
                $cond_row_s['goods_id']             = request_int('goods_id');
                $cond_row_s['newbuyer_state:<=']     = newbuyer_BaseModel::NORMAL;
                $cond_row_s['newbuyer_starttime:<='] = date('Y-m-d H:i:s', strtotime(request_string('start_time')));
                $cond_row_s['newbuyer_endtime:>=']   = date('Y-m-d H:i:s', strtotime(request_string('start_time')));
                $row_s                               = $this->newBuyerBaseModel->getOneByWhere($cond_row_s);
                $cond_row_e['goods_id']             = request_int('goods_id');
                $cond_row_e['newbuyer_state:<=']     = newbuyer_BaseModel::NORMAL;
                $cond_row_e['newbuyer_starttime:<='] = date('Y-m-d H:i:s', strtotime(request_string('end_time')));
                $cond_row_e['newbuyer_endtime:>=']   = date('Y-m-d H:i:s', strtotime(request_string('end_time')));
                $row_e                               = $this->newBuyerBaseModel->getOneByWhere($cond_row_e);

                if ($row_s || $row_e)
                {
                    $check_post_data_flag = false;
                    $msg_label    = _('该商品已经参加过同时段的活动！');
                }
                else
                {
                    //没有参加同时段的活动 获取goods_base
                    $goods_base = $this->goodsBaseModel->getOneByWhere(array('goods_id'=>$field_row['goods_id'],'goods_is_shelves'=>Goods_BaseModel::GOODS_UP));
                    if($goods_base)
                    {
                        $field_row['common_id'] = $goods_base['common_id'];
                        $field_row['goods_name'] = $goods_base['goods_name'];
                        $field_row['goods_price'] = $goods_base['goods_price'];
                        $field_row['goods_image'] = $goods_base['goods_image'];

                        if ($field_row['newbuyer_price'] <= 0)
                        {
                            $check_post_data_flag = false;
                            $msg_label = _('请输入商品优惠价格！');
                        }
                        else
                        {
                            if ($field_row['newbuyer_price'] >= $goods_base['goods_price'])
                            {
                                $check_post_data_flag = false;
                                $msg_label = _('新人优惠价格必须低于商品价格！');
                            }

                            $goods_base['share_sum_price'] = $goods_base['goods_share_price'];
                            if($goods_base['goods_is_promotion'])
                            {
                                $goods_base['share_sum_price'] += $goods_base['goods_promotion_price'];
                            }

                            if($field_row['newbuyer_price'] <= $goods_base['share_sum_price'])
                            {
                                $check_post_data_flag = false;
                                $msg_label = _('新人优惠价格必须大于分享优惠价格！');
                            }
                        }

                        $goods_common_row = $this->goodsCommonModel->getOne($field_row['common_id']);
                        if($goods_common_row)
                        {
                            if($goods_common_row['common_promotion_type'] > 0 && $goods_common_row['common_promotion_type'] != Goods_CommonModel::XINREN)
                            {
                                $check_post_data_flag = false;
                                $msg_label = _('已经参加了其他活动！');
                            }
                        }
                        else
                        {
                            $check_post_data_flag = false;
                            $msg_label = _('请选择参加新人优惠的商品！');
                        }
                    }
                    else
                    {
                        $check_post_data_flag = false;
                        $msg_label = _('请选择参加新人优惠的商品！');
                    }
                }
			}
			else
			{
				$check_post_data_flag = false;
				$msg_label = _('请选择参加新人优惠的商品！');
			}

			$field_row['newbuyer_upper_limit'] = '1';
			if($field_row['newbuyer_upper_limit'] < 0)
			{
				$check_post_data_flag = false;
				$msg_label = _('限购数量有误！');
			}

	        $field_row['newbuyer_state']            = NewBuyer_BaseModel::NORMAL;

			if ($check_post_data_flag && $goods_base)
			{
                $field_row['shop_id']                   = $goods_base['shop_id'];
                $field_row['shop_name']                 = $goods_base['shop_name'];

				$this->newBuyerBaseModel->sql->startTransactionDb();
				$insert_flag = $this->newBuyerBaseModel->addNewBuyer($field_row);

                $update_flag       = $this->goodsCommonModel->editCommon($goods_base['common_id'], array('common_promotion_type'=>Goods_CommonModel::XINREN));
                check_rs($update_flag, $rs_row);

				if (is_ok($rs_row) && $this->newBuyerBaseModel->sql->commitDb())
				{
					$flag = true;
				}
				else
				{
					$this->newBuyerBaseModel->sql->rollBackDb();
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

    /**
     * 删除
     */
	public function removeNewBuyerAct()
    {
	    $newBuyer_id = request_int('id');
	    $check_right = $this->newBuyerBaseModel->getOne($newBuyer_id);

	    if ($check_right['shop_id'] == Perm::$shopId)
	    {
	        $this->newBuyerBaseModel->sql->startTransactionDb(); //开启事务
	        $flag = $this->newBuyerBaseModel->removeNewBuyer($newBuyer_id);
            if($flag)
            {
                $promotion = new Promotion();
                $update_flag = $promotion->cancelCommonPromotion($check_right['common_id'],Goods_CommonModel::XINREN);

                if ($update_flag && $this->newBuyerBaseModel->sql->commitDb())
                {
                    $msg    = _('删除成功！');
                    $status = 200;
                }
                else
                {
                    $this->newBuyerBaseModel->sql->rollBackDb();
                    $msg    = _('删除失败！');
                    $status = 250;
                }
            }
            else
            {
                $msg    = _('删除失败！');
                $status = 250;
            }
	    }
	    else
	    {
	        $msg    = _('删除失败！');
	        $status = 250;
	    }
	     
	    $data['newBuyer_id'] = $newBuyer_id;
	     
	    $this->data->addBody(-140, $data, $msg, $status);
	}

    /**
     * 修改活动商品价格
     */
    public function editNewBuyerGoodsPrice()
    {
        if (!$this->quota_flag)
        {
            $msg_label    = _('套餐不可用！');
            $flag = false;
        }
        else
        {
            $newBuyer_id = request_int('newbuyer_id');
            $field_row['newbuyer_name']        = request_string('newbuyer_name');
            $field_row['newbuyer_price']            = request_float('newbuyer_price');

            $newBuyer = $this->newBuyerBaseModel->getOne($newBuyer_id);
            if($newBuyer)
            {
                $check_post_data = true;

                if ($field_row['newbuyer_price'] <= 0)
                {
                    $check_post_data = false;
                    $msg_label = _('请输入商品优惠价格！');
                }
                else
                {
                    $goods_base = $this->goodsBaseModel->getOne($newBuyer['goods_id']);
                    if($goods_base)
                    {
                        if ($field_row['newbuyer_price'] >= $goods_base['goods_price'])
                        {
                            $check_post_data = false;
                            $msg_label = _('新人优惠价格必须低于商品价格！');
                        }
                        else
                        {
                            $goods_base['share_sum_price'] = $goods_base['goods_share_price'];
                            if($goods_base['goods_is_promotion'])
                            {
                                $goods_base['share_sum_price'] += $goods_base['goods_promotion_price'];
                            }

                            if($field_row['newbuyer_price'] <= $goods_base['share_sum_price'])
                            {
                                $check_post_data = false;
                                $msg_label = _('新人优惠价格必须大于分享优惠价格！');
                            }
                        }
                    }
                    else
                    {
                        $check_post_data = false;
                        $msg_label = _('商品不存在！');
                    }
                }

                if ($check_post_data)
                {
                    $this->newBuyerBaseModel->editNewBuyer($newBuyer_id, $field_row);
                    $flag  = true;
                    $data  = $field_row;
                    $data['newBuyer_id'] = $newBuyer_id;
                }
                else
                {
                    $flag = false;
                }
            }
        }

        if ($flag)
        {
            $msg    = _('修改成功！');
            $status = 200;
        }
        else
        {
            $msg    = $msg_label?$msg_label:_('修改失败！');
            $status = 250;
        }
        $this->data->addBody(-140, $data, $msg, $status);
    }

    /**
     * 验证商品是否已经参加过同时段的活动
     */
    public function checkNewBuyerGoods()
    {
        $data = array();
        $cond_row_s['goods_id']             = request_int('goods_id');
        $cond_row_s['newbuyer_state:<=']     = newbuyer_BaseModel::NORMAL;
        $cond_row_s['newbuyer_starttime:<='] = date('Y-m-d H:i:s', strtotime(request_string('start_time')));
        $cond_row_s['newbuyer_endtime:>=']   = date('Y-m-d H:i:s', strtotime(request_string('start_time')));
        $row_s                               = $this->newBuyerBaseModel->getOneByWhere($cond_row_s);

        $cond_row_e['goods_id']             = request_int('goods_id');
        $cond_row_e['newbuyer_state:<=']     = newbuyer_BaseModel::NORMAL;
        $cond_row_e['newbuyer_starttime:<='] = date('Y-m-d H:i:s', strtotime(request_string('end_time')));
        $cond_row_e['newbuyer_endtime:>=']   = date('Y-m-d H:i:s', strtotime(request_string('end_time')));
        $row_e                               = $this->newBuyerBaseModel->getOneByWhere($cond_row_e);

        if ($row_s || $row_e)
        {
            $msg    = _('该商品已经参加过同时段的活动！');
            $status = 250;
        }
        else
        {
            $msg    = _('该商品尚未参加过同时段的活动！');
            $status = 200;
        }

        $this->data->addBody(-140, $data, $msg, $status);

    }

	/**
     * 获取店铺的商品列表
	 */
	public function getShopGoods()
	{
		$cond_row = array();

		//分页
		$YLB_Page           = new YLB_Page();
		$YLB_Page->listRows = request_int('listRows')?request_int('listRows'):8;
		$rows              = $YLB_Page->listRows;
		$offset            = request_int('firstRow', 0);
		$page              = ceil_r($offset / $rows);

		//需要加入商品状态限定
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

        $cond_row['common_promotion_type:IN'] = array(Goods_CommonModel::NOPROMOTION,Goods_CommonModel::XINREN);//只取没参加活动或只参加了本活动的
        $data = $this->goodsCommonModel->getNormalSateGoodsBase($cond_row, array('goods_id' => 'DESC'), $page, $rows);

        //判断goods_base 是否参加了活动 参加了就标记已参加 Zhenzh
        $newbuyer_cond_row['goods_id:IN'] = array_column($data['items'],'goods_id');
        //$newbuyer_cond_row['newbuyer_state'] = NewBuyer_BaseModel::NORMAL;
        $newbuyer_goods = $this->newBuyerBaseModel->getField('goods_id',$newbuyer_cond_row);
        $goods_ids = array_column($newbuyer_goods,'goods_id');
        if($goods_ids)
        {
            foreach ($data['items'] as $key=>$value)
            {
                if (in_array($value['goods_id'],$goods_ids))
                {
                    $data['items'][$key]['is_joined'] = 1;
                }
            }
        }

		$YLB_Page->totalRows = $data['totalsize'];
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

	/**
	 *购买套餐、套餐续费
	 *平台店铺可以免费发布活动
	 *后台可设置免费发布活动
	 */
	public function quota()
	{
	    if ($this->self_support_flag)
	    {
	        location_to(YLB_Registry::get('url') . '?ctl=Seller_Promotion_NewBuyer&met=add&typ=e');
	    }
	
	    if('json' == $this->typ)
	    {
	        $data['promotion_newbuyer_price'] = Web_ConfigModel::value('promotion_newbuyer_price');
	        $this->data->addBody(-140, $data);
	    }
	    else
	    {
	        include $this->view->getView();
	    }
	}

	/**
	 * 在店铺的账期结算中扣除相关费用
	 */
	public function addQuota()
	{
	    $data        = array();
	    $quota_row   = array();
	    $rs_row      = array();
	    $month_price = Web_ConfigModel::value('promotion_newbuyer_price');
	    $month       = request_int('month');
	    $days        = 30 * $month;
	
	     
	    if($month > 0)
	    {
	        $this->newBuyerQuotaModel->sql->startTransactionDb();
	
	        $field_row['user_id']     = Perm::$row['user_id'];
	        $field_row['shop_id']     = Perm::$shopId;
	        $field_row['cost_price']  = $month_price * $month;
	        $field_row['cost_desc']   = _('店铺购买新人优惠套餐活动消费');
	        $field_row['cost_status'] = 0;
	        $field_row['cost_time']   = get_date_time();
	        $flag                     = $this->shopCostModel->addCost($field_row, true);
	        check_rs($flag, $rs_row);
	        if ($flag)
	        {
	           
	            $quota_row = $this->newBuyerQuotaModel->getNewBuyerQuotaByShopID(Perm::$shopId); 
	            //记录已经存在，套餐续费
	            if ($quota_row)
	            {
	                //1、原套餐已经过期,更新套餐开始时间和结束时间
	                if (strtotime($quota_row['quota_endtime']) < time())
	                {
	                    $field['quota_starttime'] = get_date_time();
	                    $field['quota_endtime']   = date('Y-m-d H:i:s', strtotime("+$days days"));
	                }
	                elseif ((time() >= strtotime($quota_row['quota_starttime'])) && (time() <= strtotime($quota_row['quota_endtime'])))
	                {
	                    //2、原套餐尚未过期，只需更新结束时间
	                    $field['quota_endtime'] = date('Y-m-d H:i:s', strtotime("+$days days", strtotime($quota_row['quota_endtime'])));
	                }
	                $op_flag = $this->newBuyerQuotaModel->renewNewBuyerQuota($quota_row['quota_id'], $field);
	                 
	            }
	            else            //记录不存在，添加套餐
	            {
	                $shop_row = $this->shopBaseModel->getBaseOneList(array('shop_id' => Perm::$shopId));
	
	                $field['quota_starttime'] = get_date_time();
	                $field['quota_endtime']   = date('Y-m-d H:i:s', strtotime("+$days days"));
	                $field['shop_id']          = Perm::$shopId;
	                $field['shop_name']        = $shop_row['shop_name'];
	                $field['user_id']          = Perm::$userId;
	                $field['user_name']    = Perm::$row['user_account'];
	                $op_flag                   = $this->newBuyerQuotaModel->addNewBuyerQuota($field, true);
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
	        if (is_ok($rs_row) && isset($rs) && $rs['status'] == 200 && $this->newBuyerQuotaModel->sql->commitDb())
	        {
	            $msg    = _('操作成功！');
	            $status = 200;
	        }
	        else
	        {
	            $this->newBuyerQuotaModel->sql->rollBackDb();
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
}

?>