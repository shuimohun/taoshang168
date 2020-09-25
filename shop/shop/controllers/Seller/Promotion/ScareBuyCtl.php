<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}


class Seller_Promotion_ScareBuyCtl extends Seller_Controller
{
	public $scareBuyBaseModel  = null;
	public $scareBuyQuotaModel = null;
	public $scareBuyCatModel   = null;
	public $goodsBaseModel     = null;
	public $goodsCommonModel   = null;
	public $shopBaseModel      = null;
    public $shopCostModel      = null;

	public $combo_flag         = false;   //套餐是否可用
	public $shop_info          = array(); //店铺信息
	public $self_support_flag  = false;   //是否为自营店铺

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

		if (!Web_ConfigModel::value('scarebuy_allow')) //惠抢购功能设置，关闭，跳转到卖家首页
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
				$data->setError(_('惠抢购功能已关闭'), 30);
				$d = $data->getDataRows();
				$protocol_data = YLB_Data::encodeProtocolData($d);
				echo $protocol_data;
				exit();
			}
		}

		$this->scareBuyBaseModel  = new ScareBuy_BaseModel();
		$this->scareBuyQuotaModel = new ScareBuy_QuotaModel();
		$this->scareBuyCatModel   = new ScareBuy_CatModel();
		$this->goodsBaseModel     = new Goods_BaseModel();
        $this->goodsCommonModel   = new Goods_CommonModel();
        $this->shopBaseModel      = new Shop_BaseModel();
        $this->shopCostModel      = new Shop_CostModel();

        $this->shop_info         = $this->shopBaseModel->getOne(Perm::$shopId);//店铺信息
        $this->self_support_flag = ($this->shop_info['shop_self_support'] == "true" || Web_ConfigModel::value('scarebuy_price') == 0) ? true : false; //是否为自营店铺标志

        if ($this->self_support_flag) //平台店铺，没有套餐限制
        {
            $this->combo_flag = true;
        }
        else
        {
            $this->combo_flag = $this->scareBuyQuotaModel->checkQuotaStateByShopId(Perm::$shopId); //普通店铺需要查询套餐状态
        }
	}

	/**
	 * 活动列表 页面
	 */
	public function index()
	{
        $cond_row['shop_id'] = Perm::$shopId;

        if (request_string('op') == 'detail')
        {
            $cond_row['scarebuy_id'] = request_int('id');
            $data = $this->scareBuyBaseModel->getScareBuyDetailByWhere($cond_row);

            if($data['scarebuy_cat_id'])
            {
                $scarebuy_cat = $this->scareBuyCatModel->getOne($data['scarebuy_cat_id']);
                $data['scarebuy_cat_con'] = $scarebuy_cat['scarebuy_cat_name'];
                if($data['scarebuy_scat_id'])
                {
                    $scarebuy_cat = $this->scareBuyCatModel->getOne($data['scarebuy_scat_id']);
                    $data['scarebuy_cat_con'] = $data['scarebuy_cat_con'] . '--' . $scarebuy_cat['scarebuy_cat_name'];
                }
            }

            $this->view->setMet('detail');
        }
        else
        {
            $YLB_Page           = new YLB_Page();
            $YLB_Page->listRows = request_int('listRows')?request_int('listRows'):10;
            $rows              = $YLB_Page->listRows;
            $offset            = request_int('firstRow', 0);
            $page              = ceil_r($offset / $rows);

            if (request_int('type'))
            {
                $cond_row['scarebuy_type'] = request_int('type');
            }
            if (request_int('state'))
            {
                $cond_row['scarebuy_state'] = request_int('state');
            }
            if (request_string('keyword'))
            {
                $cond_row['scarebuy_name:LIKE'] = '%'.request_string('keyword') . '%';
            }

            $data = $this->scareBuyBaseModel->getScareBuyGoodsList($cond_row, array('scarebuy_id' => 'DESC'), $page, $rows);

            $YLB_Page->totalRows = $data['totalsize'];
            $page_nav           = $YLB_Page->prompt();

            $combo_row = array();
            if (!$this->self_support_flag)  //普通店铺
            {
                if ($this->combo_flag)//套餐可用
                {
                    $combo_row = $this->scareBuyQuotaModel->getScareBuyQuotaByShopID(Perm::$shopId);
                }
            }
        }

		if('json' == $this->typ)
		{
			$json_data['data']		= $data;
			$json_data['self_support_flag'] = $this->self_support_flag;
			$json_data['combo_flag']= $this->combo_flag;
			$json_data['combo'] 	= $combo_row;
			$this->data->addBody(-140, $json_data);
		}
		else
		{
			include $this->view->getView();
		}

	}

    /**
     * 添加惠抢购页面
     */
	public function add()
	{
		$data                 = array();
		$data['combo']        = array();
		$data['scarebuy_cat'] = $this->scareBuyCatModel->getScareBuyCatJson(ScareBuy_CatModel::PHYSICALCAT);//获取惠抢购分类，实物惠抢购

        if (!$this->self_support_flag)
		{
            //普通店铺
			if (!$this->combo_flag)
			{
				location_to(YLB_Registry::get('url') . '?ctl=Seller_Promotion_ScareBuy&met=index&typ=e');
			}
			else
			{
				$data['combo'] = $this->scareBuyQuotaModel->getScareBuyQuotaByShopID(Perm::$shopId);
			}
		}
		else
		{
		    //自营店铺
			$data['combo']['combo_endtime'] = date("Y-m-d H:i:s", strtotime("11 june 2030"));
		}

		//惠抢购是否有审核日期
		if (Web_ConfigModel::value('scarebuy_review_day'))
		{
			$review_days                      = Web_ConfigModel::value('scarebuy_review_day');
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
            $data['scarebuy_cat'] = encode_json($data['scarebuy_cat']);
			include $this->view->getView();
		}

	}

    /**
     * 添加惠抢购
     */
	public function addScareBuy()
	{
		if (!$this->combo_flag)
		{
			$msg_label    = _('套餐不可用！');
			$flag = false;
		}
		else
		{
            $rs_row = array();
            $check_post_data_flag = true;

            $field_row['scarebuy_name']             = request_string('scarebuy_name');
            $field_row['scarebuy_remark']           = request_string('scarebuy_remark');
            $field_row['goods_id']                  = request_int('goods_id');
            $field_row['scarebuy_price']            = request_float('scarebuy_price');
            $field_row['scarebuy_starttime']        = request_string('scarebuy_starttime');
            $field_row['scarebuy_endtime']          = request_string('scarebuy_endtime');
            $field_row['scarebuy_virtual_quantity'] = request_int('scarebuy_virtual_quantity',0);
            $field_row['scarebuy_upper_limit']      = request_int('scarebuy_upper_limit',0);
            $field_row['scarebuy_count']            = request_int('scarebuy_count',0);
            $field_row['scarebuy_cat_id']           = request_int('scarebuy_cat_id');
            $field_row['scarebuy_scat_id']          = request_int('scarebuy_scat_id');
            $field_row['shop_id']                   = Perm::$shopId;
            $field_row['shop_name']                 = $this->shopInfo['shop_name'];
            $field_row['is_mian']                   = request_int('is_mian');
            $field_row['is_man']                    = request_int('is_man');
            $field_row['is_voucher']                = request_int('is_voucher');
            $field_row['is_jia']                    = request_int('is_jia');

            if ($field_row['scarebuy_name'])
            {
                if($field_row['scarebuy_upper_limit'] >= 0)
                {
                    if($field_row['goods_id'])
                    {
                        $goods_base = $this->goodsBaseModel->getOneByWhere(array('goods_id'=>$field_row['goods_id'],'goods_is_shelves'=>Goods_BaseModel::GOODS_UP));
                        if($goods_base)
                        {
                            $field_row['common_id'] = $goods_base['common_id'];
                            $field_row['shop_name'] = $goods_base['shop_name'];
                            $field_row['goods_name'] = $goods_base['goods_name'];
                            $field_row['goods_image'] = $goods_base['goods_image'];

                            if($field_row['scarebuy_count'] <= 0 )
                            {
                                $check_post_data_flag = false;
                                $msg_label = _('参加惠抢购数量不正确！');
                            }
                            else if($field_row['scarebuy_count'] > $goods_base['goods_stock'])
                            {
                                $check_post_data_flag = false;
                                $msg_label = _('参加惠抢购数量必须小于库存！');
                            }

                            if ($field_row['scarebuy_price'] > 0)
                            {
                                if ($field_row['scarebuy_price'] < $goods_base['goods_price'])
                                {
                                    $goods_base['share_sum_price'] = $goods_base['goods_share_price'];
                                    if($goods_base['goods_is_promotion'])
                                    {
                                        $goods_base['share_sum_price'] += $goods_base['goods_promotion_price'];
                                    }
                                    if($field_row['scarebuy_price'] > $goods_base['share_sum_price'])
                                    {
                                        $goods_common_row = $this->goodsCommonModel->getNormalStateGoodsCommon($field_row['common_id']);
                                        if($goods_common_row)
                                        {
                                            $goods_common_row = current($goods_common_row);
                                            if($goods_common_row['common_promotion_type'] > 0 && $goods_common_row['common_promotion_type'] != Goods_CommonModel::HUIQIANGGOU)
                                            {
                                                $check_post_data_flag = false;
                                                $msg_label = _('已经参加了其他活动！');
                                            }
                                        }
                                        else
                                        {
                                            $check_post_data_flag = false;
                                            $msg_label = _('请选择参加惠抢购的商品！');
                                        }
                                    }
                                    else
                                    {
                                        $check_post_data_flag = false;
                                        $msg_label = _('惠抢购价格必须大于分享优惠价格！');
                                    }
                                }
                                else
                                {
                                    $check_post_data_flag = false;
                                    $msg_label = _('惠抢购价格必须低于商品价格！');
                                }
                            }
                            else
                            {
                                $check_post_data_flag = false;
                                $msg_label = _('请输入惠抢购价格！');
                            }
                        }
                        else
                        {
                            $check_post_data_flag = false;
                            $msg_label = _('请选择参加惠抢购的商品！');
                        }
                    }
                    else
                    {
                        $check_post_data_flag = false;
                        $msg_label = _('请选择参加惠抢购的商品！');
                    }
                }
                else
                {
                    $check_post_data_flag = false;
                    $msg_label = _('限购数量有误！');
                }
            }
            else
            {
                $check_post_data_flag = false;
                $msg_label = _('标题不能为空！');
            }

            //检测商品是否参加了同时段的活动
            $cond_row_s['goods_id']              = $field_row['goods_id'];
            $cond_row_s['scarebuy_state:<=']     = ScareBuy_BaseModel::NORMAL;
            $cond_row_s['scarebuy_starttime:<='] = $field_row['scarebuy_starttime'];
            $cond_row_s['scarebuy_endtime:>=']   = $field_row['scarebuy_starttime'];
            $row_s                               = $this->scareBuyBaseModel->getOneByWhere($cond_row_s);
            $cond_row_e['goods_id']              = request_int('goods_id');
            $cond_row_e['scarebuy_state:<=']     = ScareBuy_BaseModel::NORMAL;
            $cond_row_e['scarebuy_starttime:<='] = $field_row['scarebuy_endtime'];
            $cond_row_e['scarebuy_endtime:>=']   = $field_row['scarebuy_endtime'];
            $row_e                               = $this->scareBuyBaseModel->getOneByWhere($cond_row_e);
            if ($row_s || $row_e)
            {
                if ($row_s['scarebuy_state'] <= ScareBuy_BaseModel::NORMAL || $row_e['scarebuy_state'] <= ScareBuy_BaseModel::NORMAL) //该商品已经参加了同一时段的活动，且状态正常
                {
                    $check_post_data_flag = false;
                    $msg_label = _('该商品已经参加过同时段的活动！');
                }
            }

            //是否自营
            if($this->self_support_flag)
            {
                $field_row['shop_self_support'] = 1;
            }
            else
            {
                $field_row['shop_self_support'] = 0;
            }
            //状态默认开启
            $field_row['scarebuy_state'] = ScareBuy_BaseModel::NORMAL;
            //是否有虚拟购买量
            if($field_row['scarebuy_virtual_quantity'] > 0)
            {
                $field_row['scarebuy_buy_quantity'] = request_int('scarebuy_virtual_quantity');
                $field_row['scarebuy_percent'] = number_format($field_row['scarebuy_buy_quantity'] / ($field_row['scarebuy_buy_quantity'] + $field_row['scarebuy_count']) * 100,'2','.','');
            }

            //所有检测通过 添加
            if ($check_post_data_flag)
            {
                $this->scareBuyBaseModel->sql->startTransactionDb();
                $insert_flag = $this->scareBuyBaseModel->addScareBuy($field_row, true);
                check_rs($insert_flag, $rs_row);

                $update_flag = $this->goodsCommonModel->editCommon($goods_base['common_id'], array('common_promotion_type'=>Goods_CommonModel::HUIQIANGGOU));
                check_rs($update_flag, $rs_row);

                if (is_ok($rs_row) && $this->scareBuyBaseModel->sql->commitDb())
                {
                    $flag = true;
                }
                else
                {
                    $this->scareBuyBaseModel->sql->rollBackDb();
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
    public function removeScareBuy()
    {
        $scarebuy_id = request_int('id');
        $check_right = $this->scareBuyBaseModel->getOne($scarebuy_id);
        //if ($check_right['shop_id'] == Perm::$shopId && ($check_right['scarebuy_state'] > ScareBuy_BaseModel::NORMAL || Perm::$shopId == 240))
        if ($check_right['shop_id'] == Perm::$shopId)
        {
            $this->scareBuyBaseModel->sql->startTransactionDb(); //开启事务
            $flag = $this->scareBuyBaseModel->removeScareBuy($scarebuy_id);
            if($flag)
            {
                $promotion = new Promotion();
                $update_flag = $promotion->cancelCommonPromotion($check_right['common_id'],Goods_CommonModel::HUIQIANGGOU);

                if ($update_flag && $this->scareBuyBaseModel->sql->commitDb())
                {
                    $msg    = _('删除成功！');
                    $status = 200;
                }
                else
                {
                    $this->scareBuyBaseModel->sql->rollBackDb();
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

        $data['scarebuy_id'] = $scarebuy_id;

        $this->data->addBody(-140, $data, $msg, $status);
    }

    /**
     * 验证商品是否已经参加过同时段的活动
     */
	public function checkScareBuyGoods()
	{
		$data = array();

		$cond_row_s['goods_id']              = request_int('goods_id');
		$cond_row_s['scarebuy_state:<=']     = ScareBuy_BaseModel::NORMAL;
		$cond_row_s['scarebuy_starttime:<='] = date('Y-m-d H:i:s', strtotime(request_string('start_time')));
		$cond_row_s['scarebuy_endtime:>=']   = date('Y-m-d H:i:s', strtotime(request_string('start_time')));
		$row_s                               = $this->scareBuyBaseModel->getOneByWhere($cond_row_s);

		$cond_row_e['goods_id']              = request_int('goods_id');
		$cond_row_e['scarebuy_state:<=']     = ScareBuy_BaseModel::NORMAL;
		$cond_row_e['scarebuy_starttime:<='] = date('Y-m-d H:i:s', strtotime(request_string('end_time')));
		$cond_row_e['scarebuy_endtime:>=']   = date('Y-m-d H:i:s', strtotime(request_string('end_time')));
		$row_e                               = $this->scareBuyBaseModel->getOneByWhere($cond_row_e);

		if ($row_s || $row_e)
		{
			if ($row_s['scarebuy_state'] <= ScareBuy_BaseModel::NORMAL || $row_e['scarebuy_state'] <= ScareBuy_BaseModel::NORMAL) //该商品已经参加了同一时段的活动，且状态正常
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

	/**
	 * 获取店铺的实物商品列表
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

        //只取没参加活动或只参加了本活动的
        $cond_row['common_promotion_type:IN'] = array(Goods_CommonModel::NOPROMOTION,Goods_CommonModel::HUIQIANGGOU);
        $data = $this->goodsCommonModel->getNormalSateGoodsBase($cond_row, array('goods_id' => 'DESC'), $page, $rows);

        //判断goods_base 是否参加了活动 参加了就标记已参加 Zhenzh
        //$cond_row_scarebuy['scarebuy_state'] = ScareBuy_BaseModel::NORMAL;
        foreach ($data['items'] as $key=>$value)
        {
            $cond_row_scarebuy['goods_id'] = $value['goods_id'];
            $scarebuy_goods = $this->scareBuyBaseModel->getKeyByWhere($cond_row_scarebuy);
            if($scarebuy_goods)
            {
                $data['items'][$key]['is_joined'] = 1;
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
     * 根据惠抢购城市ID查询下级地区
     */
	public function getScareBuyArea()
	{
        $cond_row['scarebuy_area_parent_id'] = request_int('area_id');
        $data                                = $this->scareBuyAreaModel->getScareBuyAreaByWhere($cond_row);

		$this->data->addBody(-140, $data);
	}

    /**
     * 购买套餐、套餐续费
     * 平台店铺可以免费发布活动
     * 后台可设置免费发布活动
     */
    public function combo()
    {
        if ($this->self_support_flag)
        {
            location_go_back(_('自营店铺或者套餐续费， 不需要设置。'));
            //location_to(YLB_Registry::get('url') . '?ctl=Seller_Promotion_ScareBuy&met=add&typ=e');
        }

        if('json' == $this->typ)
        {
            $data['scarebuy_price'] = Web_ConfigModel::value('scarebuy_price');
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
    public function addCombo()
    {
        $data      = array();
        $combo_row = array();
        $field     = array();
        $rs_row    = array();

        $month_price = Web_ConfigModel::value('scarebuy_price');
        $month       = request_int('month');
        $days        = 30 * $month;

        if($month > 0)
        {
            $this->scareBuyQuotaModel->sql->startTransactionDb();
            //记录到店铺费用表
            $field_row['user_id']     = Perm::$userId;
            $field_row['shop_id']     = Perm::$shopId;
            $field_row['cost_price']  = $month_price * $month;
            $field_row['cost_desc']   = _('店铺购买惠抢购活动消费');
            $field_row['cost_status'] = 0;
            $field_row['cost_time']   = get_date_time();
            $flag                     = $this->shopCostModel->addCost($field_row, true);
            check_rs($flag, $rs_row);

            if ($flag)
            {
                //购买或续费套餐
                $combo_row = $this->scareBuyQuotaModel->getScareBuyQuotaByShopID(Perm::$shopId);
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

                    $op_flag = $this->scareBuyQuotaModel->renewScareBuyCombo($combo_row['combo_id'], $field);
                }
                else            //记录不存在，添加套餐
                {
                    $field['combo_starttime'] = get_date_time();
                    $field['combo_endtime']   = date('Y-m-d H:i:s', strtotime("+$days days"));
                    $field['shop_id']         = Perm::$shopId;
                    $field['shop_name']       = $this->shopInfo['shop_name'];
                    $field['user_id']         = Perm::$userId;
                    $field['user_nickname']   = Perm::$row['user_account'];

                    $op_flag = $this->scareBuyQuotaModel->addScareBuyCombo($field, true);
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

            if (is_ok($rs_row) && isset($rs) && $rs['status'] == 200 && $this->scareBuyQuotaModel->sql->commitDb())
            {
                $msg    = _('操作成功！');
                $status = 200;
            }
            else
            {
                $this->scareBuyQuotaModel->sql->rollBackDb();
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