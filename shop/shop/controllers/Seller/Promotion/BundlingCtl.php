<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     
 */
class Seller_Promotion_BundlingCtl extends Seller_Controller
{
	public $bundlingBaseModel  = null;
	public $bundlingGoodsModel = null;
	public $bundlingQuotaModel = null;
    public $shareBaseModel     = null;
	public $goodsBaseModel     = null;
	public $goodsCommonModel   = null;
	public $shopCostModel      = null;
	public $shopBaseModel      = null;
	public $quota_flag         = false;
	public $shop_info          = array();  //店铺信息
	public $self_support_flag  = false;    //是否为自营店铺

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

		if (!Web_ConfigModel::value('promotion_allow')) //团购功能设置，关闭，跳转到卖家首页
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
				$data->setError(_('优惠套装功能已关闭'), 30);
				$d = $data->getDataRows();

				$protocol_data = YLB_Data::encodeProtocolData($d);
				echo $protocol_data;
				exit();
			}
		}
		
		$this->bundlingBaseModel  = new Bundling_BaseModel();
		$this->bundlingGoodsModel = new Bundling_GoodsModel();
		$this->bundlingQuotaModel = new Bundling_QuotaModel();
		$this->goodsBaseModel     = new Goods_BaseModel();
		$this->goodsCommonModel   = new Goods_CommonModel();
		$this->shopCostModel      = new Shop_CostModel();
		$this->shopBaseModel      = new Shop_BaseModel();
        $this->shareBaseModel     = new Share_BaseModel();

		$this->shop_info         = $this->shopBaseModel->getOne(Perm::$shopId);//店铺信息
		$this->self_support_flag = ($this->shop_info['shop_self_support'] == "true" || Web_ConfigModel::value('promotion_bundling_price') == 0) ? true : false; //是否为自营店铺标志
		if ($this->self_support_flag) //平台店铺，没有套餐限制0
		{
			$this->quota_flag = true;
		}
		else
		{
			$this->quota_flag = $this->bundlingQuotaModel->checkQuotaStateByShopId(Perm::$shopId);//普通店铺需要查询套餐状态
		}

	}

	/**
	 * 首页
	 */
	public function index()
	{
		$quota_row = array();

        $YLB_Page           = new YLB_Page();
        $YLB_Page->listRows = request_int('listRows')?request_int('listRows'):10;
        $rows              = $YLB_Page->listRows;
        $offset            = request_int('firstRow', 0);
        $page              = ceil_r($offset / $rows);

        $cond_row['shop_id'] = Perm::$shopId;         //店铺ID

        if (request_string('keyword'))
        {
            $cond_row['bundling_name:LIKE'] = '%'.request_string('keyword') . "%";
        }
        if (request_int('state'))
        {
            $cond_row['bundling_state'] = request_int('state');
        }

        $data                = $this->bundlingBaseModel->getBundlingActList($cond_row, array('bundling_id' => 'DESC'), $page, $rows);
        $YLB_Page->totalRows = $data['totalsize'];
        $page_nav            = $YLB_Page->prompt();
        
        if (!$this->self_support_flag)  //普通店铺
        {
            if ($this->quota_flag)//套餐可用
            {
                $quota_row = $this->bundlingQuotaModel->getBundlingQuotaByShopID(Perm::$shopId);
            }
        }
        
		if('json' == $this->typ)
		{
			$json_data['data']       = $data;
			$json_data['self_support_flag']  = $this->self_support_flag;
			$json_data['quota_flag'] = $this->quota_flag;
			$json_data['quota_row']  = $quota_row;

			$this->data->addBody(-140, $json_data);
		}
		else
		{
			include $this->view->getView();
		}

	}

	/**
	 * 添加套餐活动页面
	 * 自营店铺无需判断套餐是否可用
	 */
	public function add()
	{
		$data      = array();
		$quota     = array();

		if (!$this->self_support_flag)
		{
            //普通店铺
			if (!$this->quota_flag)
			{
				location_to(YLB_Registry::get('url') . '?ctl=Seller_Promotion_Bundling&met=index&typ=e');
			}
			else
			{
				$quota = $this->bundlingQuotaModel->getBundlingQuotaByShopID(Perm::$shopId);
			}
		}
		else
		{
            // 自营店铺
			$quota['bundling_quota_endtime'] = date("Y-m-d H:i:s", strtotime("11 june 2030"));
		}

		if (request_string('op') == 'edit')
		{
			$cond_row['bundling_id'] = request_int('id');
			$cond_row['shop_id']     = Perm::$shopId;
			$data                    = $this->bundlingBaseModel -> getBundlingActInfo($cond_row);
			$data['goods_list']      = $this -> bundlingGoodsModel -> getBundlingGoodsByWhere(array('bundling_id'=>$data['bundling_id']));

            if($data['goods_list'])
            {
                foreach ($data['goods_list'] as $key=>$value)
                {
                    if(!$value['status'])
                    {
                        $data['bundling_state'] = Bundling_BaseModel::END;
                        $this->bundlingBaseModel->editBundlingActInfo($value['bundling_id'],array('bundling_state'=>Bundling_BaseModel::END));
                        break;
                    }
                }
            }
            else if($data['bundling_state'] == Bundling_BaseModel::NORMAL)
            {
                $this->bundlingBaseModel->editBundlingActInfo($data['bundling_id'],array('bundling_state'=>Bundling_BaseModel::END));
            }

			$data['old_total_price'] = array_sum(array_column($data['goods_list'],'goods_price'));
            $data['old_total_price'] = number_format($data['old_total_price'],2,'.','');
            $this->view->setMet('edit');
		}

		if('json' == $this->typ)
		{
			$json_data['data']		        = $data;
			$json_data['self_support_flag']	= $this->self_support_flag;	//店铺类型
			$json_data['quota']		        = $quota; 		//套餐信息

			$this->data->addBody(-140, $json_data);
		}
		else
		{
			include $this->view->getView();
		}

	}
	
	/**
	 * 添加套餐活动
	 */
	public function addBundling()
    {
	    if (!$this->quota_flag)
	    {
	        $msg_label    = _('套餐不可用！');
	        $flag = false;
	    }
	    else
        {
	        $check_post_data_flag = true;
	        
	        $field_row['bundling_name'] = request_string('bundling_name');//活动名称
	        if (empty($field_row['bundling_name']))
	        {
	            $check_post_data_flag = false;
	            $msg_label = _('活动称不能为空！');
	        }
            $is_limit = request_int('is_limit');
            if ( $is_limit )
            {
                $field_row['bunlding_limit'] = request_int('limit'); //限购
            }
            else
            {
                $field_row['bunlding_limit'] = 0;   //不限购
            }
			$field_row['bundling_discount_price'] = request_float('bundling_price');//优惠套餐价格
			$field_row['bundling_freight_choose'] = request_int('bundling_freight_choose');//运费承担
			$field_row['bundling_freight'] = request_int('bundling_freight_choose') ?  0 : request_string('bundling_freight');//运费
			$field_row['bundling_state'] = request_int('bundling_state');//状态
			$field_row['shop_id'] = Perm::$shopId;
			
			$Shop_BaseModel = new Shop_BaseModel();
			$shop = $Shop_BaseModel -> getOne(Perm::$shopId);
			if ($shop)
			{
			    $field_row['shop_name'] = $shop['shop_name'];
			}
			
			if($check_post_data_flag)
			{
                $this-> bundlingBaseModel -> sql->startTransactionDb();
			    $flag = $bundling_id = $this-> bundlingBaseModel -> addBundlingActivity($field_row, true);
			    
			    if (!empty($_POST['goods']) && is_array($_POST['goods']) && count($_POST['goods']) > 1) {
			        
			        $appoint_goodsid = false;
			        foreach ($_POST['goods'] as $key => $val)
			        {
                        //验证商品
                        $goods =  $this -> goodsBaseModel -> checkGoods($val['gid']);

                        if($goods)
                        {
                            if($val['price'] >= $goods['goods_base']['goods_price'])
                            {
                                $flag = false;
                                $msg_label = '活动价必须小于商品原价';
                                unset($common_ids);
                                break;
                            }
                            else
                            {
                                $goods['goods_base']['share_sum_price'] = $goods['goods_base']['goods_share_price'];
                                if($goods['goods_base']['goods_is_promotion'])
                                {
                                    $goods['goods_base']['share_sum_price'] += $goods['goods_base']['goods_promotion_price'];
                                }

                                if($val['price'] <= $goods['goods_base']['share_sum_price'])
                                {
                                    $flag = false;
                                    $msg_label = '活动价必须大于分享优惠价';
                                    unset($common_ids);
                                    break;
                                }
                            }

                            $data = array();
                            $data['bundling_id'] =  $bundling_id;
                            $data['common_id'] = $goods['goods_base']['common_id'];
                            $data['goods_id'] = $goods['goods_base']['goods_id'];
                            $data['goods_name'] = $goods['goods_base']['goods_name'];
                            $data['goods_image'] = $goods['goods_base']['goods_image'];
                            $data['goods_spec'] = $goods['goods_base']['spec_str'];
                            $data['bundling_goods_price'] = $val['price'];
                            $data['bundling_appoint'] = intval($val['appoint']);
                            if (!$appoint_goodsid && intval($val['appoint']) == 1)
                            {
                                $appoint_goodsid = intval($val['gid']);
                            }
                            $flag = $this -> bundlingGoodsModel -> addBundlingGoods($data);

                            if($flag)
                            {
                                $common_ids[] = $goods['goods_base']['common_id'];
                                $goods_row[] = $goods['goods_base'];
                            }
                        }
			        }

                    if($common_ids)
                    {
                        $common_share_row = array();
                        $common_share_base = $this->shareBaseModel->getByWhere(array('common_id:IN'=>$common_ids));
                        foreach ($common_share_base as $key => $value)
                        {
                            $common_share_row[$value['common_id']] = $value;
                        }

                        $bl_cond_row['sqq'] = 0;
                        $bl_cond_row['qzone'] = 0;
                        $bl_cond_row['weixin'] = 0;
                        $bl_cond_row['weixin_timeline'] = 0;
                        $bl_cond_row['tsina'] = 0;
                        $bl_cond_row['share_total_price'] = 0;
                        $bl_cond_row['is_promotion'] = 0;
                        $bl_cond_row['promotion_total_price'] = 0;
                        $bl_cond_row['promotion_unit_price'] = 0;

                        foreach ($goods_row as $key => $val)
                        {
                            if(isset($common_share_row[$val['common_id']]))
                            {
                                $common_share = $common_share_row[$val['common_id']];
                                $bl_cond_row['sqq'] += $common_share['sqq'];
                                $bl_cond_row['qzone'] += $common_share['qzone'];
                                $bl_cond_row['weixin'] += $common_share['weixin'];
                                $bl_cond_row['weixin_timeline'] += $common_share['weixin_timeline'];
                                $bl_cond_row['tsina'] += $common_share['tsina'];
                                $bl_cond_row['share_total_price'] += $common_share['share_total_price'];
                                $bl_cond_row['promotion_total_price'] += $common_share['promotion_total_price'];
                                $bl_cond_row['promotion_unit_price'] += $common_share['promotion_unit_price'];

                                if($common_share['is_promotion'])
                                {
                                    $bl_cond_row['is_promotion'] = 1;
                                }
                            }
                        }

                        $share_id = $this->shareBaseModel->getKeyByWhere(array('b_id'=>$bundling_id));
                        if($share_id)
                        {
                            $this->shareBaseModel->editShare($share_id,$bl_cond_row);
                        }
                        else
                        {
                            $bl_cond_row['b_id'] = $bundling_id;
                            $flag = $this->shareBaseModel->addShare($bl_cond_row,true);
                        }
                    }
			        
			    }
			    else
                {
                    $flag = false;
                    $msg_label = '至少选择2件商品';
                }
			    
			}
			else
			{
			    $flag = false;
			}
			
    	    if ($flag && $this->bundlingBaseModel->sql->commitDb())
    		{
    			$msg    = _('添加成功!');
    			$status = 200;
    		}
    		else
    		{
                $this->bundlingBaseModel->sql->rollBackDb();
    			$msg    = $msg_label?$msg_label:_('添加失败！');
    			$status = 250;
    		}
    		
    		$data['$bundling_id'] = $bundling_id;
    		
    		$this->data->addBody(-140, $data, $msg, $status);
	    }
	        
	}
	
	/**
	 * 删除
	 */
	public function removeBundling()
    {
	    $bundling_id = request_int('id');
	    
	    $check_right = $this->bundlingBaseModel->getOne($bundling_id);
	    
	    if ($check_right['shop_id'] == Perm::$shopId)
	    {
	        $this->bundlingBaseModel->sql->startTransactionDb(); //开启事务
	    
	        $flag = $this->bundlingBaseModel->removeBundlingActItem($bundling_id);
	    
	        if ($flag && $this->bundlingBaseModel->sql->commitDb())
	        {
	            $msg    = _('删除成功！');
	            $status = 200;
	        }
	        else
	        {
	            $this->bundlingBaseModel->sql->rollBackDb();
	            $msg    = _('删除失败！');
	            $status = 250;
	        }
	    }
	    else
	    {
	        $msg    = _('删除失败！');
	        $status = 250;
	    }
	    
	    $data['$bundling_id'] = $bundling_id;
	    
	    $this->data->addBody(-140, $data, $msg, $status);
	}

	/**
	 * 修改套餐活动
	 */
	public function editBundling()
    {
        $data = array();
	    if (!$this->quota_flag)
	    {
	        $msg_label    = _('套餐不可用！');
	        $flag = false;
	    }
	    else
        {
	         
	        $check_post_data_flag = true;
	        
	        $bundling_id =  request_int('bundling_id');//获取所要修改的活动id
	        if (empty($bundling_id))
	        {
	            $check_post_data_flag = false;
	            $msg_label = _('此活动不存在！');
	        }
	        else
            {
	            $field_row['bundling_name'] = request_string('bundling_name');//活动名称
	            if (empty($field_row['bundling_name']))
	            {
	                $check_post_data_flag = false;
	                $msg_label = _('活动称不能为空！');
	            }
                $is_limit = request_int('is_limit');
                if ( $is_limit )
                {
                    $field_row['bunlding_limit']        = request_int('limit');                       //限购
                }
                else
                {
                    $field_row['bunlding_limit']        = 0;   //不限购
                }
                if (!empty($_POST['goods']) && is_array($_POST['goods']) && count($_POST['goods']) > 1)
                {
                    $price_rows = array_column($_POST['goods'],'price');
                    $price = array_sum($price_rows);
                }

                if($price)
                {
                    $field_row['bundling_discount_price'] = $price;
                }
	            //$field_row['bundling_discount_price'] = request_float('bundling_price');//优惠套餐价格
	            $field_row['bundling_freight_choose'] = request_int('bundling_freight_choose');//运费承担
	            $field_row['bundling_freight'] = request_int('bundling_freight_choose') ?  0 : request_string('bundling_freight');//运费
	            $field_row['bundling_state'] = request_int('bundling_state');//状态
	            $field_row['shop_id'] = Perm::$shopId;
	            
	            $this ->bundlingBaseModel -> editBundlingActInfo($bundling_id, $field_row);
	        }
	        
	        
	        if($check_post_data_flag)
	        {
	            //删除套餐下的商品
	            $bundling_goods_id_row = $this -> bundlingGoodsModel -> getKeyByWhere(array('bundling_id' => $bundling_id));
	            $return = $this -> bundlingGoodsModel ->removeBundlingGoods($bundling_goods_id_row);
	            
	            if (!empty($_POST['goods']) && is_array($_POST['goods']) && count($_POST['goods']) > 1)
	            {
	                $appoint_goodsid = false;
	                foreach ($_POST['goods'] as $key => $val)
	                {
	                    //验证商品
                        $goods =  $this -> goodsBaseModel -> checkGoods($val['gid']);

                        if($goods)
                        {
                            if($val['price'] >= $goods['goods_base']['goods_price'])
                            {
                                $flag = false;
                                $msg_label = '活动价必须小于商品原价';
                                unset($common_ids);
                                break;
                            }
                            else
                            {
                                $goods['goods_base']['share_sum_price'] = $goods['goods_base']['goods_share_price'];
                                if($goods['goods_base']['goods_is_promotion'])
                                {
                                    $goods['goods_base']['share_sum_price'] += $goods['goods_base']['goods_promotion_price'];
                                }

                                if($val['price'] <= $goods['goods_base']['share_sum_price'])
                                {
                                    $flag = false;
                                    $msg_label = '活动价必须大于分享优惠价';
                                    unset($common_ids);
                                    break;
                                }
                            }

                            $data = array();
                            $data['bundling_id'] = $bundling_id;
                            $data['common_id'] = $goods['goods_base']['common_id'];
                            $data['goods_id'] = $goods['goods_base']['goods_id'];
                            $data['goods_name'] = $goods['goods_base']['goods_name'];
                            $data['goods_image'] = $goods['goods_base']['goods_image'];
                            $data['goods_spec'] = $goods['goods_base']['spec_str'];
                            $data['bundling_goods_price'] = $val['price'];
                            $data['bundling_appoint'] = intval($val['appoint']);
                            if (!$appoint_goodsid && intval($val['appoint']) == 1)
                            {
                                $appoint_goodsid = intval($val['gid']);
                            }
                            $flag = $this -> bundlingGoodsModel -> addBundlingGoods($data);

                            if($flag)
                            {
                                $common_ids[] = $goods['goods_base']['common_id'];
                                $goods_row[] = $goods['goods_base'];
                            }
                        }
	                }

                    if($common_ids)
                    {
                        $common_share_row = array();
                        $common_share_base = $this->shareBaseModel->getByWhere(array('common_id:IN'=>$common_ids));
                        foreach ($common_share_base as $key => $value)
                        {
                            $common_share_row[$value['common_id']] = $value;
                        }

                        $bl_cond_row['sqq'] = 0;
                        $bl_cond_row['qzone'] = 0;
                        $bl_cond_row['weixin'] = 0;
                        $bl_cond_row['weixin_timeline'] = 0;
                        $bl_cond_row['tsina'] = 0;
                        $bl_cond_row['share_total_price'] = 0;
                        $bl_cond_row['is_promotion'] = 0;
                        $bl_cond_row['promotion_total_price'] = 0;
                        $bl_cond_row['promotion_unit_price'] = 0;

                        foreach ($goods_row as $key => $val)
                        {
                            if(isset($common_share_row[$val['common_id']]))
                            {
                                $common_share = $common_share_row[$val['common_id']];
                                $bl_cond_row['sqq'] += $common_share['sqq'];
                                $bl_cond_row['qzone'] += $common_share['qzone'];
                                $bl_cond_row['weixin'] += $common_share['weixin'];
                                $bl_cond_row['weixin_timeline'] += $common_share['weixin_timeline'];
                                $bl_cond_row['tsina'] += $common_share['tsina'];
                                $bl_cond_row['share_total_price'] += $common_share['share_total_price'];
                                $bl_cond_row['promotion_total_price'] += $common_share['promotion_total_price'];
                                $bl_cond_row['promotion_unit_price'] += $common_share['promotion_unit_price'];

                                if($common_share['is_promotion'])
                                {
                                    $bl_cond_row['is_promotion'] = 1;
                                }
                            }
                        }

                        $share_id = $this->shareBaseModel->getKeyByWhere(array('b_id'=>$bundling_id));
                        if($share_id)
                        {
                            $this->shareBaseModel->editShare($share_id,$bl_cond_row);
                        }
                        else
                        {
                            $bl_cond_row['b_id'] = $bundling_id;
                            $flag = $this->shareBaseModel->addShare($bl_cond_row,true);
                        }
                    }

	            }
	            else
                {
                    $flag = false;
                    $msg_label = '至少选择2件商品';
                }
	        }
	        else
	        {
	            $flag = false;
	        }
	    }

        if ($flag)
        {
            $msg    = _('修改成功!');
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

        //只取没参加活动
        //$cond_row['common_promotion_type'] = Goods_CommonModel::NOPROMOTION;
        $cond_row['common_promotion_type:IN'] = array(Goods_CommonModel::NOPROMOTION,Goods_CommonModel::XINREN);
        $data = $this->goodsCommonModel->getNormalSateGoodsBase($cond_row, array('goods_id' => 'DESC'), $page, $rows);

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
	 * 套餐管理
	 * */
	public function quota()
	{
        //免费发布活动
	    if ($this->self_support_flag)
	    {
	        location_to('index.php?ctl=Seller_Promotion_Bungdling&met=add&typ=e');
	    }
	
	    if('json' == $this->typ)
	    {
	        //购买活动套餐每个月需支付的金额
	        $data['promotion_bundling_price'] = Web_ConfigModel::value('promotion_bundling_price');
	        $this->data->addBody(-140, $data);
	    }
	    else
	    {
	        include $this->view->getView();
	    }
	}

    /**
     * 套餐购买和续费
     */
	public function addQuota()
	{
	    $data        = array();
	    $rs_row      = array();
	    $month_price = Web_ConfigModel::value('promotion_bundling_price');
	    $month       = request_int('month');
	    $days        = 30 * $month;

	    if($month > 0)
	    {
	        $this->bundlingQuotaModel->sql->startTransactionDb();
	
	        $field_row['user_id']     = Perm::$row['user_id'];
	        $field_row['shop_id']     = Perm::$shopId;
	        $field_row['cost_price']  = $month_price * $month;
	        $field_row['cost_desc']   = _('店铺购买优惠套餐活动消费');
	        $field_row['cost_status'] = 0;
	        $field_row['cost_time']   = get_date_time();
	        $flag                     = $this->shopCostModel->addCost($field_row, true);
	        check_rs($flag, $rs_row);
	        if ($flag)
	        {
	            $combo_row = $this->bundlingQuotaModel->getBundlingQuotaByShopID(Perm::$shopId);
	            //记录已经存在，套餐续费
	            if ($combo_row)
	            {
	                //1、原套餐已经过期,更新套餐开始时间和结束时间
	                if (strtotime($combo_row['bundling_quota_endtime']) < time())
	                {
	                    $field['bundling_quota_starttime'] = get_date_time();
	                    $field['bundling_quota_endtime']   = date('Y-m-d H:i:s', strtotime("+$days days"));
	                }
	                elseif ((time() >= strtotime($combo_row['bundling_quota_starttime'])) && (time() <= strtotime($combo_row['bundling_quota_endtime'])))
	                {
	                    //2、原套餐尚未过期，只需更新结束时间
	                    $field['bundling_quota_endtime'] = date('Y-m-d H:i:s', strtotime("+$days days", strtotime($combo_row['bundling_quota_endtime'])));
	                }
	                $op_flag = $this->bundlingQuotaModel->renewBundlingQuota($combo_row['bundling_quota_id'], $field);
	                
	            }
	            else
	            {
                    //记录不存在，添加套餐
	                $shop_row = $this->shopBaseModel->getBaseOneList(array('shop_id' => Perm::$shopId));
	                $field['bundling_quota_starttime'] = get_date_time();
	                $field['bundling_quota_endtime']   = date('Y-m-d H:i:s', strtotime("+$days days"));
	                $field['shop_id']          = Perm::$shopId;
	                $field['shop_name']        = $shop_row['shop_name'];
	                $field['user_id']          = Perm::$userId;
	                $field['user_name']    = Perm::$row['user_account'];
	                $field['bundling_state']    = '1';
	                $op_flag                   = $this->bundlingQuotaModel->addBundlingQuota($field, true);
	            }
	            check_rs($op_flag, $rs_row);
	        }
	
	        if(is_ok($rs_row))
	        {
	            //在paycenter中添加交易记录
	            $key         = YLB_Registry::get('shop_api_key');
	            $url         = YLB_Registry::get('paycenter_api_url');
	            $shop_app_id = YLB_Registry::get('shop_app_id');

	            $formvars                    = array();
	            $formvars['app_id']          = $shop_app_id;
	            $formvars['buyer_user_id']   = Perm::$userId;
	            $formvars['buyer_user_name'] = Perm::$row['user_account'];
	            $formvars['amount']          = $month_price * $month;

	            $rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_Pay_Pay&met=addCombo&typ=json', $url), $formvars);
	        }
	        if (is_ok($rs_row) && isset($rs) && $rs['status'] == 200 && $this->bundlingQuotaModel->sql->commitDb())
	        {
	            $msg    = _('操作成功！');
	            $status = 200;
	        }
	        else
	        {
	            $this->bundlingQuotaModel->sql->rollBackDb();
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