<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}


class Seller_Promotion_FuCtl extends Seller_Controller
{
	public $FuBaseModel  = null;
	public $FuQuotaModel = null;
	public $goodsCommonModel   = null;
    public $goodsBaseModel     = null;
    public $shopBaseModel      = null;
    public $shopCostModel      = null;

	public $quota_flag        = false;   //套餐是否可用
	public $shop_info         = array();  //店铺信息
	public $self_support_flag = false;    //是否为自营店铺

    public $fu_quota = null;

	/**
	 * @param  string $ctl 控制器目录
	 * @param  string $met 控制器方法
	 * @param  string $typ 返回数据类型
	 * @access public
	 */
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);

		if (!Web_ConfigModel::value('promotion_allow')) //送福免单功能设置，关闭，跳转到卖家首页
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

		$this->FuBaseModel      = new Fu_BaseModel();
		$this->FuQuotaModel     = new Fu_QuotaModel();
		$this->goodsBaseModel   = new Goods_BaseModel();
        $this->goodsCommonModel = new Goods_CommonModel();
        $this->shopBaseModel    = new Shop_BaseModel();
        $this->shopCostModel    = new Shop_CostModel();

		$this->shop_info         = $this->shopBaseModel->getOne(Perm::$shopId);//店铺信息
		$this->self_support_flag = ($this->shop_info['shop_self_support'] == "true" || Web_ConfigModel::value('promotion_fu_price') == 0) ? true : false; //是否为自营店铺标志

		if ($this->self_support_flag) //平台店铺，没有套餐限制
		{
			$this->quota_flag = true;
		}
		else
		{
			$this->quota_flag = $this->FuQuotaModel->checkQuotaStateByShopId(Perm::$shopId); //普通店铺需要查询套餐状态
		}
	}

    /**
     * 送福免单活动列表页面
     */
	public function index()
	{
        if (request_string('op') == 'detail')
        {
            $fu_id = request_int('id');
            $data = $this->FuBaseModel->getOne($fu_id);

            if('json' == $this->typ)
            {
                $this->data->addBody(-140, $data);
            }
            else
            {
                $this->view->setMet('detail');
                include $this->view->getView();
            }
        }
        else
        {
            $quota_row = array();

            //分页
            $YLB_Page = new YLB_Page();
            $page     = request_int('page',1);
            $rows     = request_int('rows',$YLB_Page->listRows);

            $cond_row['shop_id'] = Perm::$shopId;
            if (request_int('state'))
            {
                $cond_row['fu_state'] = request_int('state');
            }
            if (request_string('keyword'))
            {
                $cond_row['goods_name:LIKE'] = '%'.request_string('keyword') . '%';
            }

            $data = $this->FuBaseModel->getFuList($cond_row, array('fu_id' => 'DESC'), $page, $rows);

            if (!$this->self_support_flag)  //普通店铺
            {
                if ($this->quota_flag)//套餐可用
                {
                    $quota_row = $this->FuQuotaModel->getFuQuotaByShopID(Perm::$shopId);
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
                $YLB_Page->nowPage    = $page;
                $YLB_Page->listRows   = $rows;
                $YLB_Page->totalPages = $data['total'];
                $page_nav             = $YLB_Page->promptII();

                include $this->view->getView();
            }
        }
	}

    /**
     * 添加送福免单页面
     */
	public function add()
	{
		$data['quota'] = array();

        $data['quota'] = $this->FuQuotaModel->getFuQuotaByShopID(Perm::$shopId);

        if (!$data['quota'])
        {
            location_to(YLB_Registry::get('url') . '?ctl=Seller_Promotion_Fu&met=setting&typ=e');
        }
        else
        {
            if ($this->self_support_flag)  //自营店铺
            {
                $data['quota']['quota_endtime'] = date("Y-m-d H:i:s", strtotime("11 june 2030"));
            }
            else
            {
                if (!$this->quota_flag)
                {
                    location_to(YLB_Registry::get('url') . '?ctl=Seller_Promotion_Fu&met=index&typ=e&callback=add');
                }
            }
        }

		$data['quota']['quota_starttime'] = date('Y-m-d H:i:s');

        //修改
		/*if (request_string('op') == 'edit')
		{
		    $cond_row['fu_id'] = request_int('id');
		    $cond_row['shop_id']     = Perm::$shopId;
		    $data['goods']                    = $this->FuBaseModel->getFuDetailByWhere($cond_row);
		    
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
	public function addFu()
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

            $field_row['fu_name']      = request_string('fu_name');
			$field_row['fu_price']     = request_float('fu_price');
            $field_row['fu_t_price']   = request_float('fu_t_price');
            $field_row['fu_count']     = request_int('fu_count');
            $field_row['fu_stock']     = $field_row['fu_count'];
            $field_row['goods_id']     = request_int('goods_id');
            $field_row['is_mian']      = request_int('is_mian');
            $field_row['is_man']       = request_int('is_man');
            $field_row['is_voucher']   = request_int('is_voucher');
            $field_row['is_jia']       = request_int('is_jia');
            $field_row['is_register']  = request_int('is_register');

            $weixin          = request_int('weixin');
            $weixin_timeline = request_int('weixin_timeline');
            $sqq             = request_int('sqq');
            $qzone           = request_int('qzone');
            $tsina           = request_int('tsina');

			if ($field_row['goods_id'])
			{
			    //判断是否参加了同时段的活动
                $cond_row_s['goods_id']        = request_int('goods_id');
                $cond_row_s['fu_state:<=']     = fu_BaseModel::NORMAL;
                $row_s                         = $this->FuBaseModel->getKeyByWhere($cond_row_s);

                if ($row_s)
                {
                    $check_post_data_flag = false;
                    $msg_label    = _('该商品已经参加该活动！');
                }
                else
                {
                    //获取goods_base
                    $goods_base = $this->goodsBaseModel->getOneByWhere(array('goods_id'=>$field_row['goods_id'],'goods_is_shelves'=>Goods_BaseModel::GOODS_UP));
                    if($goods_base)
                    {
                        $field_row['common_id']   = $goods_base['common_id'];
                        $field_row['goods_name']  = $goods_base['goods_name'];
                        $field_row['goods_price'] = $goods_base['goods_price'];
                        $field_row['goods_image'] = $goods_base['goods_image'];

                        if(!$weixin || !$weixin_timeline || !$sqq || !$qzone || !$tsina)
                        {
                            $check_post_data_flag = false;
                            $msg_label = _('所有渠道都必须大于0！');
                        }
                        else
                        {
                            $field_row['fu_total_times'] = $weixin + $weixin_timeline + $sqq + $qzone + $tsina;
                            $field_row['fu_base'] = ['weixin'=>$weixin,'weixin_timeline'=>$weixin_timeline,'sqq'=>$sqq,'qzone'=>$qzone,'tsina'=>$tsina];
                            $field_row['fu_price'] = number_format($field_row['goods_price'] / $field_row['fu_total_times'],2,'.','');

                            if ($field_row['fu_price'] <= 0)
                            {
                                $check_post_data_flag = false;
                                $msg_label = _('送福邀请好友注册减价格！');
                            }
                            elseif ($field_row['fu_price'] >= $goods_base['goods_price'])
                            {
                                $check_post_data_flag = false;
                                $msg_label = _('送福免单价格必须低于商品价格！');
                            }

                            $goods_common_row = $this->goodsCommonModel->getOne($field_row['common_id']);
                            if($goods_common_row)
                            {
                                $goods_base = $this->goodsCommonModel->getGoodsSpec($goods_base,$goods_common_row);
                                $field_row['goods_spec'] = $goods_base['spec_str'];

                                if($goods_common_row['common_promotion_type'] > 0 && $goods_common_row['common_promotion_type'] != Goods_CommonModel::FU)
                                {
                                    $check_post_data_flag = false;
                                    $msg_label = _('已经参加了其他活动！');
                                }
                            }
                            else
                            {
                                $check_post_data_flag = false;
                                $msg_label = _('请选择参加送福免单的商品！');
                            }
                        }
                    }
                    else
                    {
                        $check_post_data_flag = false;
                        $msg_label = _('请选择参加送福免单的商品！');
                    }
                }
			}
			else
			{
				$check_post_data_flag = false;
				$msg_label = _('请选择参加送福免单的商品！');
			}

	        $field_row['fu_state'] = Fu_BaseModel::NORMAL;

			if ($check_post_data_flag && $goods_base)
			{
                $field_row['shop_id']                   = $goods_base['shop_id'];
                $field_row['shop_name']                 = $goods_base['shop_name'];

				$this->FuBaseModel->sql->startTransactionDb();
				$insert_flag = $this->FuBaseModel->addFu($field_row);
                check_rs($insert_flag, $rs_row);

				if($insert_flag)
                {
                    $common_id = $this->goodsCommonModel->getKeyByWhere($goods_base['common_id'], array('common_promotion_type'=>Goods_CommonModel::FU));
                    if(!$common_id)
                    {
                        $update_flag = $this->goodsCommonModel->editCommon($goods_base['common_id'], array('common_promotion_type'=>Goods_CommonModel::FU));
                        check_rs($update_flag, $rs_row);
                    }
                }

				if (is_ok($rs_row) && $this->FuBaseModel->sql->commitDb())
				{
					$flag = true;
				}
				else
				{
					$this->FuBaseModel->sql->rollBackDb();
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
	public function removeFuAct()
    {
	    $fu_id = request_int('id');
	    $check_right = $this->FuBaseModel->getOne($fu_id);
	    if ($check_right['shop_id'] == Perm::$shopId)
	    {
	        $this->FuBaseModel->sql->startTransactionDb(); //开启事务
	        $flag = $this->FuBaseModel->removeFu($fu_id);
            if($flag)
            {
                $promotion = new Promotion();
                $update_flag = $promotion->cancelCommonPromotion($check_right['common_id'],Goods_CommonModel::FU);

                if ($update_flag && $this->FuBaseModel->sql->commitDb())
                {
                    $msg    = _('删除成功！');
                    $status = 200;
                }
                else
                {
                    $this->FuBaseModel->sql->rollBackDb();
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
	     
	    $data['fu_id'] = $fu_id;
	     
	    $this->data->addBody(-140, $data, $msg, $status);
	}

    /**
     * 修改活动商品价格
     */
    public function editFuGoodsPrice()
    {
        if (!$this->quota_flag)
        {
            $msg_label    = _('套餐不可用！');
            $flag = false;
        }
        else
        {
            $fu_id = request_int('fu_id');
            $field_row['fu_name']        = request_string('fu_name');
            $field_row['fu_price']            = request_float('fu_price');

            $fu = $this->FuBaseModel->getOne($fu_id);
            if($fu)
            {
                $check_post_data = true;

                if ($field_row['fu_price'] <= 0)
                {
                    $check_post_data = false;
                    $msg_label = _('请输入商品优惠价格！');
                }
                else
                {
                    $goods_base = $this->goodsBaseModel->getOne($fu['goods_id']);
                    if($goods_base)
                    {
                        if ($field_row['fu_price'] >= $goods_base['goods_price'])
                        {
                            $check_post_data = false;
                            $msg_label = _('送福免单价格必须低于商品价格！');
                        }
                        else
                        {
                            $goods_base['share_sum_price'] = $goods_base['goods_share_price'];
                            if($goods_base['goods_is_promotion'])
                            {
                                $goods_base['share_sum_price'] += $goods_base['goods_promotion_price'];
                            }

                            if($field_row['fu_price'] <= $goods_base['share_sum_price'])
                            {
                                $check_post_data = false;
                                $msg_label = _('送福免单价格必须大于分享优惠价格！');
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
                    $this->FuBaseModel->editFu($fu_id, $field_row);
                    $flag  = true;
                    $data  = $field_row;
                    $data['fu_id'] = $fu_id;
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
    public function checkFuGoods()
    {
        $data = array();
        $cond_row_s['goods_id']        = request_int('goods_id');
        $cond_row_s['fu_state:<=']     = fu_BaseModel::NORMAL;

        $row_s = $this->FuBaseModel->getKeyByWhere($cond_row_s);

        if ($row_s)
        {
            $msg    = _('该商品已经参加过该活动！');
            $status = 250;
        }
        else
        {
            $msg    = _('该商品尚未参加该活动！');
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

        $cond_row['common_promotion_type:IN'] = array(Goods_CommonModel::NOPROMOTION,Goods_CommonModel::FU);//只取没参加活动或只参加了本活动的
        $data = $this->goodsCommonModel->getNormalSateGoodsBase($cond_row, array('goods_id' => 'DESC'), $page, $rows);

        //判断goods_base 是否参加了活动 参加了就标记已参加 Zhenzh
        $fu_cond_row['goods_id:IN'] = array_column($data['items'],'goods_id');
        $fu_cond_row['fu_state']    = Fu_BaseModel::NORMAL;
        $fu_goods = $this->FuBaseModel->select('goods_id',$fu_cond_row);
        $goods_ids = array_column($fu_goods,'goods_id');
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
	        location_to(YLB_Registry::get('url') . '?ctl=Seller_Promotion_Fu&met=add&typ=e');
	    }
	
	    if('json' == $this->typ)
	    {
	        $data['promotion_fu_price'] = Web_ConfigModel::value('promotion_fu_price');
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
	    $rs_row      = array();
	    $month_price = Web_ConfigModel::value('promotion_fu_price');
	    $month       = request_int('month');
	    $days        = 30 * $month;
	
	     
	    if($month > 0)
	    {
	        $this->FuQuotaModel->sql->startTransactionDb();
	
	        $field_row['user_id']     = Perm::$row['user_id'];
	        $field_row['shop_id']     = Perm::$shopId;
	        $field_row['cost_price']  = $month_price * $month;
	        $field_row['cost_desc']   = _('店铺购买送福免单套餐活动消费');
	        $field_row['cost_status'] = 0;
	        $field_row['cost_time']   = get_date_time();
	        $flag                     = $this->shopCostModel->addCost($field_row, true);
	        check_rs($flag, $rs_row);
	        if ($flag)
	        {
	           
	            $quota_row = $this->FuQuotaModel->getFuQuotaByShopID(Perm::$shopId);
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
	                $op_flag = $this->FuQuotaModel->renewFuQuota($quota_row['quota_id'], $field);
	                 
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
	                $op_flag                   = $this->FuQuotaModel->addFuQuota($field, true);
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
	        if (is_ok($rs_row) && isset($rs) && $rs['status'] == 200 && $this->FuQuotaModel->sql->commitDb())
	        {
	            $msg    = _('操作成功！');
	            $status = 200;
	        }
	        else
	        {
	            $this->FuQuotaModel->sql->rollBackDb();
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

    public function setting()
    {
        if (request_string('act') == 'save')
        {
            $goods_count = request_int('goods_count');
            $goods_unit_count = request_int('goods_unit_count');
            $goods_order_amount = request_float('goods_order_amount');
            $goods_add_count = request_int('goods_add_count');

            if ($goods_count && $goods_order_amount && $goods_add_count)
            {
                $this->FuQuotaModel->sql->startTransactionDb();

                $data['goods_count'] = $goods_count;
                $data['goods_unit_count'] = $goods_unit_count;
                $data['goods_order_amount'] = $goods_order_amount;
                $data['goods_add_count'] = $goods_add_count;

                $quota_id = $this->FuQuotaModel->getKeyByWhere(['shop_id'=>Perm::$shopId]);
                if ($quota_id)
                {
                    $flag = $this->FuQuotaModel->editFuQuota($quota_id, $data);
                }
                else
                {
                    $data['shop_id'] = Perm::$shopId;
                    $data['shop_name'] = $this->shop_info['shop_name'];
                    $data['user_id'] = $this->shop_info['user_id'];
                    $data['user_name'] = $this->shop_info['user_name'];
                    $flag = $this->FuQuotaModel->addFuQuota($data,false);
                }

                if ($flag && $this->FuQuotaModel->sql->commitDb())
                {
                    $msg    = _('操作成功！');
                    $status = 200;
                }
                else
                {
                    $this->FuQuotaModel->sql->rollBackDb();
                    $msg    = _('操作失败！');
                    $status = 250;
                }
            }
            else
            {
                $status = 250;
                $msg = '提交失败';
            }

            $data = [];
        }
        else
        {
            $data = $this->FuQuotaModel->getFuQuotaByShopID(Perm::$shopId);

            if ($data)
            {
                $status = 200;
                $msg    = _('success');
            }
            else
            {
                $status = 250;
                $msg = 'fail';
            }
        }

        if('json' == $this->typ)
        {
            $this->data->addBody(-140, $data, $msg, $status);
        }
        else
        {
            include $this->view->getView();
        }
    }
}

?>