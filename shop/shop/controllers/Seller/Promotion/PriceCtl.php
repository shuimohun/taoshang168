<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Seller_Promotion_PriceCtl extends Seller_Controller
{
    public $priceBaseModel    = null;
    public $priceQuotaModel   = null;
    public $goodsBaseModel    = null;
    public $goodsCommonModel  = null;
	public $shopBaseModel     = null;
	public $shopCostModel     = null;

	public $combo_flag        = false;   //套餐是否可用
	public $shop_info         = array(); //店铺信息
	public $self_support_flag = false;   //是否为自营店铺

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

		if (!Web_ConfigModel::value('promotion_allow'))
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

        $this->priceBaseModel    = new Price_BaseModel();
        $this->priceQuotaModel   = new Price_QuotaModel();
		$this->goodsBaseModel    = new Goods_BaseModel();
		$this->goodsCommonModel  = new Goods_CommonModel();
        $this->shopBaseModel     = new Shop_BaseModel();
	    $this->shopCostModel     = new Shop_CostModel();

		$this->shop_info         = $this->shopBaseModel->getOne(Perm::$shopId);//店铺信息
		$this->self_support_flag = ($this->shop_info['shop_self_support'] == "true" || Web_ConfigModel::value('promotion_voucher_price') == 0) ? true : false;  //是否为自营店铺标志

		if ($this->self_support_flag) //平台店铺，没有套餐限制
		{
			$this->combo_flag = true;
		}
		else
		{
			$this->combo_flag = $this->priceQuotaModel->checkQuotaStateByShopId(Perm::$shopId);
		}
	}

    /**
     * 手机专享列表页
     */
	public function index()
    {
        $YLB_Page           = new YLB_Page();
        $YLB_Page->listRows = request_int('listRows')?request_int('listRows'):8;
        $rows              = $YLB_Page->listRows;
        $offset            = request_int('firstRow', 0);
        $page              = ceil_r($offset / $rows);

        $cond_row['shop_id'] = Perm::$shopId;         //店铺ID
        if (request_int('state'))
        {
            $cond_row['price_state'] = request_int('state');
        }
        $data               = $this->priceBaseModel->getPriceList($cond_row, array('price_id' => 'DESC'), $page, $rows);

        $YLB_Page->totalRows = $data['totalsize'];
        $page_nav           = $YLB_Page->prompt();

        $combo_row = array();
        if (!$this->self_support_flag)  //普通店铺
        {
            if ($this->combo_flag)//套餐可用
            {
                $combo_row = $this->priceQuotaModel->getPriceQuotaByShopID(Perm::$shopId);
            }
        }

        if('json' == $this->typ)
		{
			$json_data['data']       = $data;
			$json_data['self_support_flag']  = $this->self_support_flag;
			$json_data['combo_flag'] = $this->combo_flag;
			$json_data['combo_row']  = $combo_row;
			$this->data->addBody(-140, $json_data);
		}
		else
		{
			include $this->view->getView();
		}
	}

    /**
     * 获取店铺的商品
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
        $cond_row['common_promotion_type:IN'] = array(Goods_CommonModel::NOPROMOTION,Goods_CommonModel::SHOUJI);
        $data = $this->goodsCommonModel->getNormalSateGoodsBase($cond_row, array('goods_id' => 'DESC'), $page, $rows);

        //判断goods_base 是否参加了活动 参加了就标记已参加 Zhenzh
        //$cond_row_price['price_state'] = Price_BaseModel::NORMAL;
        foreach ($data['items'] as $key=>$value)
        {
            $cond_row_price['goods_id'] = $value['goods_id'];
            $price_goods = $this->priceBaseModel->getKeyByWhere($cond_row_price);
            if($price_goods)
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
     * 新增活动页
     */
    public function add()
    {
        $data                 = array();
        $data['quota']        = array();

        if (!$this->self_support_flag)  //普通店铺
        {
            if (!$this->combo_flag)
            {
                location_to(YLB_Registry::get('url') . '?ctl=Seller_Promotion_Price&met=index&typ=e');
            }
            else
            {
                $data['quota'] = $this->priceQuotaModel->getPriceQuotaByShopID(Perm::$shopId);
            }
        }
        else
        {
            $data['quota']['quota_endtime'] = date("Y-m-d H:i:s", strtotime("11 june 2030"));
        }

        $data['quota']['quota_starttime'] = date('Y-m-d H:i:s');

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
     * 添加手机专享
     */
    public function addPrice()
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

            $field_row['goods_id']          = request_int('goods_id');
            $field_row['zx_price']     = request_float('zx_price');
            $field_row['price_state']     = Price_BaseModel::NORMAL;

            if ($field_row['goods_id'])
            {
                $goods_base = $this->goodsBaseModel->getOneByWhere(array('goods_id'=>$field_row['goods_id'],'goods_is_shelves'=>Goods_BaseModel::GOODS_UP));

                if($goods_base)
                {
                    $field_row['common_id'] = $goods_base['common_id'];
                    $field_row['cat_id']    = $goods_base['cat_id'];
                    if ($field_row['zx_price'] <= 0)
                    {
                        $check_post_data_flag = false;
                        $msg_label = _('请输入商品优惠价格！');
                    }
                    else
                    {
                        if ($field_row['zx_price'] >= $goods_base['goods_price'])
                        {
                            $check_post_data_flag = false;
                            $msg_label = _('优惠价格必须低于商品价格！');
                        }

                        $goods_base['share_sum_price'] = $goods_base['goods_share_price'];
                        if($goods_base['goods_is_promotion'])
                        {
                            $goods_base['share_sum_price'] += $goods_base['goods_promotion_price'];
                        }

                        if($field_row['zx_price'] <= $goods_base['share_sum_price'])
                        {
                            $check_post_data_flag = false;
                            $msg_label = _('优惠价格必须大于分享优惠价格！');
                        }
                    }

                    $goods_common_row = $this->goodsCommonModel->getOne($field_row['common_id']);
                    if($goods_common_row)
                    {
                        if($goods_common_row['common_promotion_type'] > 0 && $goods_common_row['common_promotion_type'] != Goods_CommonModel::SHOUJI)
                        {
                            $check_post_data_flag = false;
                            $msg_label = _('已经参加了其他活动！');
                        }
                    }
                    else
                    {
                        $check_post_data_flag = false;
                        $msg_label = _('请选择参加活动的商品！');
                    }
                }
                else
                {
                    $check_post_data_flag = false;
                    $msg_label = _('请选择参加活动的商品！');
                }
            }
            else
            {
                $check_post_data_flag = false;
                $msg_label = _('请选择参加活动的商品！');
            }

            if ($check_post_data_flag)
            {
                $field_row['shop_id']                   = $goods_base['shop_id'];
                //$field_row['shop_name']                 = $goods_base['shop_name'];

                $this->priceBaseModel->sql->startTransactionDb();
                $insert_flag = $this->priceBaseModel->addPriceActivity($field_row);

                $update_flag       = $this->goodsCommonModel->editCommon($goods_base['common_id'], array('common_promotion_type'=>Goods_CommonModel::SHOUJI));
                check_rs($update_flag, $rs_row);

                if (is_ok($rs_row) && $this->priceBaseModel->sql->commitDb())
                {
                    $flag = true;
                }
                else
                {
                    $this->priceBaseModel->sql->rollBackDb();
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

        $this->data->addBody(-140, array(), $msg, $status);
    }

    /**
     * 修改价格
     */
    public function editPricePrice()
    {
        $data = array();

        if (!$this->combo_flag)
        {
            $msg_label    = _('套餐不可用！');
            $flag = false;
        }
        else
        {
            $price_id              = request_int('price_id');
            $field_row['zx_price'] = request_float('zx_price');
            $check_post_data = true;

            if($price_id)
            {
                if($field_row['zx_price'] > 0)
                {
                    $price_base = $this->priceBaseModel->getOne($price_id);
                    if($price_base)
                    {
                        $goods_base = $this->goodsBaseModel->getOne($price_base['goods_id']);
                        if($goods_base)
                        {
                            if ($field_row['zx_price'] >= $goods_base['goods_price'])
                            {
                                $check_post_data = false;
                                $msg_label = _('优惠价格必须低于商品价格！');
                            }
                            else
                            {
                                $goods_base['share_sum_price'] = $goods_base['goods_share_price'];
                                if($goods_base['goods_is_promotion'])
                                {
                                    $goods_base['share_sum_price'] += $goods_base['goods_promotion_price'];
                                }

                                if($field_row['zx_price'] <= $goods_base['share_sum_price'])
                                {
                                    $check_post_data = false;
                                    $msg_label = _('优惠价格必须大于分享优惠价格！');
                                }
                            }
                        }
                        else
                        {
                            $check_post_data = false;
                            $msg_label = _('商品不存在！');
                        }
                    }
                    else
                    {
                        $check_post_data = false;
                        $msg_label = '活动不存在';
                    }
                }
                else
                {
                    $check_post_data = false;
                    $msg_label = '请输入商品优惠价格';
                }
            }
            else
            {
                $check_post_data = false;
                $msg_label = '活动不存在';
            }

            if ($check_post_data)
            {
                $this->priceBaseModel->editPriceActInfo($price_id, $field_row);
                $flag  = true;
                $data  = $field_row;
                $data['price_id'] = $price_id;
            }
            else
            {
                $flag = false;
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
     * 删除
     */
    public function removePriceAct()
    {
        $price_id = request_int('id');
        $check_right = $this->priceBaseModel->getOne($price_id);

        if ($check_right['shop_id'] == Perm::$shopId)
        {
            $this->priceBaseModel->sql->startTransactionDb(); //开启事务
            $flag = $this->priceBaseModel->removePriceActItem($price_id);
            if($flag)
            {
                $promotion = new Promotion();
                $update_flag = $promotion->cancelCommonPromotion($check_right['common_id'],Goods_CommonModel::SHOUJI);

                if ($update_flag && $this->priceBaseModel->sql->commitDb())
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

        $data['price_id'] = $price_id;

        $this->data->addBody(-140, $data, $msg, $status);
    }

    /**
     * 检测商品是否参加了活动
     */
    public function checkPrice()
    {
        $cond_row1                         = array();
        $cond_row1['goods_id']             = request_int('goods_id');
        //$cond_row1['price_state'] = Price_baseModel::NORMAL;
        $price_rows1              = $this->priceBaseModel->getPriceByWhere($cond_row1);

        if ($price_rows1)
        {
            $msg    = _('该商品已经参加过活动！');
            $status = 250;
        }
        else
        {
            $msg    = _('该商品尚未参加过活动！');
            $status = 200;
        }

        $this->data->addBody(-140, array(), $msg, $status);
    }

    /**
     *购买套餐、套餐续费
     *平台店铺可以免费发布活动
     *后台可设置免费发布活动
     */
    public function combo()
    {
        if ($this->self_support_flag)   //免费发布活动
        {
            location_to('index.php?ctl=Seller_Promotion_Price&met=add&typ=e');
        }

        if('json' == $this->typ)
        {
            //购买活动套餐每个月需支付的金额
            $data['promotion_price_price'] = Web_ConfigModel::value('promotion_price_price');
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
        $data        = array();
        $combo_row   = array();
        $rs_row      = array();
        $month_price = Web_ConfigModel::value('promotion_price_price');
        $month       = request_int('month');
        $days        = 30 * $month;
        if($month > 0)
        {
            $this->priceQuotaModel->sql->startTransactionDb();

            $field_row['user_id']     = Perm::$row['user_id'];
            $field_row['shop_id']     = Perm::$shopId;
            $field_row['cost_price']  = $month_price * $month;
            $field_row['cost_desc']   = _('店铺购买手机专享活动消费');
            $field_row['cost_status'] = 0;
            $field_row['cost_time']   = get_date_time();
            $flag                     = $this->shopCostModel->addCost($field_row, true);
            check_rs($flag, $rs_row);

            if ($flag)
            {
                $combo_row = $this->priceQuotaModel->getPriceQuotaByShopID(Perm::$shopId);
                //记录已经存在，套餐续费
                if ($combo_row)
                {
                    //1、原套餐已经过期,更新套餐开始时间和结束时间
                    if (strtotime($combo_row['combo_end_time']) < time())
                    {
                        $field['combo_start_time'] = get_date_time();
                        $field['combo_end_time']   = date('Y-m-d H:i:s', strtotime("+$days days"));
                    }
                    elseif ((time() >= strtotime($combo_row['combo_start_time'])) && (time() <= strtotime($combo_row['combo_end_time'])))
                    {
                        //2、原套餐尚未过期，只需更新结束时间
                        $field['combo_end_time'] = date('Y-m-d H:i:s', strtotime("+$days days", strtotime($combo_row['combo_end_time'])));
                    }
                    $op_flag = $this->priceQuotaModel->renewPriceCombo($combo_row['combo_id'], $field);
                }
                else
                {
                    //记录不存在，添加套餐
                    $shop_row = $this->shopBaseModel->getBaseOneList(array('shop_id' => Perm::$shopId));
                    $field['combo_start_time'] = get_date_time();
                    $field['combo_end_time']   = date('Y-m-d H:i:s', strtotime("+$days days"));
                    $field['shop_id']          = Perm::$shopId;
                    $field['shop_name']        = $shop_row['shop_name'];
                    $field['user_id']          = Perm::$userId;
                    $field['user_nickname']    = Perm::$row['user_account'];
                    $op_flag                   = $this->priceQuotaModel->addPriceCombo($field, true);
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
            if (is_ok($rs_row) && isset($rs) && $rs['status'] == 200 && $this->priceQuotaModel->sql->commitDb())
            {
                $msg    = _('操作成功！');
                $status = 200;
            }
            else
            {
                $this->priceQuotaModel->sql->rollBackDb();
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

    //下面两个弃用
    /*public function goodsAdd(){

        $met               = request_string('met');
        $action            = request_string('action');
        $key               = request_string('goods_key');
        $Goods_CommonModel = new Goods_CommonModel();
		$shop_type = $this->self_support_flag;

		if (!$this->self_support_flag)  //普通店铺
		{
			if (!$this->combo_flag)
			{
				location_to(YLB_Registry::get('url') . '?ctl=Seller_Promotion_Price&met=index&typ=e');
			}
			else
			{
				$combo = $this->priceQuotaModel->getPriceQuotaByShopID(Perm::$shopId);
			}
		}
		else // 自营店铺
		{
			$combo['combo_end_time'] = date("Y-m-d H:i:s", strtotime("11 june 2030"));
		}

        $cront_row = array('shop_id' => Perm::$shopId, 'common_state' => Goods_CommonModel::GOODS_STATE_NORMAL, 'common_verify' => Goods_CommonModel::GOODS_VERIFY_ALLOW);

        if (!empty($key) && isset($key))
        {
            $cront_row['common_name:like'] = '%' . $key . '%';
        }

        $YLB_Page = new YLB_Page();
        $row     = $YLB_Page->listRows;
        $offset  = request_int('firstRow', 0);
        $page    = ceil_r($offset / $row);

        $goods_rows = $Goods_CommonModel->getCommonNormal($cront_row, array('common_id' => 'DESC'), $page, $row);

        $common_id_rows = array_column($goods_rows['items'], 'common_id');
        if(!empty($common_id_rows))
        {
            $goods_detail_rows = $Goods_CommonModel->getGoodsDetailRows($common_id_rows);
        }
        $goods      = $Goods_CommonModel->getRecommonRow($goods_rows);
        if ('e' == $this->typ){
            if ($action == 'edit_goods'){
                return $this->editGoods();
            }else if ($action == 'edit_image'){
                $common_id = request_int('common_id');
                $data      = $this->goodsImageManage($common_id);

                if (!empty($data['color']))
                {
                    $color = $data['color'];
                }

                $common_data  = $data['common_data'];
                $common_image = $common_data['common_image'];

                $this->view->setMet('goodsImageManage');
                return include $this->view->getView();
            }else{
                $YLB_Page->totalRows = $goods_rows['totalsize'];
                $page_nav           = $YLB_Page->prompt();
                include $this->view->getView();
            }
        }else if('json' == $this->typ){
            $json_data['data']		= $data;
            $json_data['shop_type']	= $shop_type;	//店铺类型
            $json_data['combo']		= $combo; 		//套餐信息

            $this->data->addBody(-140, $json_data);
        }else{
            $this->data->addBody('', $goods_rows);
        }
			
	}

	public function price_add(){
		if (!$this->combo_flag)
		{
			$msg_label    = _('您尚未购买套餐或套餐已到期！');
			$flag   = false;
		}
		else
		{
            $data = array();
            $check_post_data_flag = true;
            $field_row['zx_price'] = request_float('zx_price');  //商品折扣价
            $field_row['goods_id']       =  request_int('goods_id');
            $cond_row_price_base['goods_id'] =  request_int('goods_id');
            $cond_row_price_base['shop_id']  = Perm::$shopId;
            $goodsBaseModel = new Goods_BaseModel();
            $priceBaseModel = new Price_BaseModel();
            $price_base_row = $goodsBaseModel->getOneByWhere($cond_row_price_base);
            if($price_base_row){
                $field_row['shop_id']                   = Perm::$shopId;
                $field_row['goods_id']            = $price_base_row['goods_id'];
                $field_row['common_id'] = $price_base_row['common_id'];
                $field_row['cat_id']         = $price_base_row['cat_id'];
                $field_row['price_state']     = Price_BaseModel::NORMAL;

                $Goods_CommonModel = new Goods_CommonModel();
                $cond_row_goods_common['common_id'] = $price_base_row['common_id'];
                $cond_row_goods_common['shop_id'] = Perm::$shopId;
                $goods_common_row = $Goods_CommonModel->getSharedGoodsCommon($cond_row_goods_common);

                if($goods_common_row)
                {
                    if ($field_row['zx_price'] > 0)
                    {
                        if ($field_row['zx_price'] >= $goods_common_row['common_price'])
                        {
                            $check_post_data_flag = false;
                            $msg_label = _('优惠价格必须小于商品价格！');
                        }
                        else if($field_row['zx_price'] <= $goods_common_row['share_sum_price'])
                        {
                            $check_post_data_flag = false;
                            $msg_label = _('优惠价格必须大于分享优惠价格！');
                        }
                    }
                    else
                    {
                        $check_post_data_flag = false;
                        $msg_label = _('请输入正确的优惠价格！');
                    }
                }
                else
                {
                    $check_post_data_flag = false;
                    $msg_label = '商品不存在';
                }

                if ($check_post_data_flag)
                {
                    $this->priceBaseModel->sql->startTransactionDb(); //开启事务
                    $flag = $price_id = $this->priceBaseModel->addPriceActivity($field_row, true);

                    if($flag)
                    {
                        $goods_common = $this->goodsCommonModel->getOne($goods_common_row['common_id']);
                        if($goods_common)
                        {
                            if($goods_common['common_promotion_type'] != $Goods_CommonModel::SHOUJI)
                            {
                                $flag1 = $this->goodsCommonModel->editCommon($goods_common_row['common_id'],array('common_promotion_type'=>Goods_CommonModel::SHOUJI));
                            }
                            else
                            {
                                $flag1 = true;
                            }
                        }

                        if($flag1 && $this->priceBaseModel->sql->commitDb())
                        {
                            $flag = true;
                        }
                        else
                        {
                            $this->priceBaseModel->sql->rollBackDb();
                            $flag = false;
                        }
                    }
                    else
                    {
                        $flag = false;
                    }
                }
                else
                {
                    $flag = false;
                }

                if ($flag)
                {
                    $msg    = _('操作成功！');
                    $status = 200;
                }
                else
                {
                    $msg    = $msg_label?$msg_label:_('添加失败！');
                    $status = 250;
                }
            }
        }
        $this->data->addBody(-140, $data, $msg, $status);
	}
	public function PriceEdit(){
			$price_id           = $_POST['price_id'];
            $field_row['zx_price'] = $_POST['zx_price'];
            $shared_price   = $_POST['shared_price'];
            $field_row['price_id'] = $price_id;
            $field_row['shop_id'] = Perm::$shopId;

            $price_goods = $this->priceBaseModel->getOne($price_id);

            if ($price_goods){
                $check_post_data = true;
                if ($field_row['zx_price'] <= 0)
                {
                    $check_post_data = false;
                    $msg_label = _('请输入商品折扣价格，折扣价不能为 0！');
                }else
                {
                    $goods_base = $this->goodsBaseModel->getOne($price_goods['goods_id']);
                    if($goods_base)
                    {
                        $Goods_CommonModel = new Goods_CommonModel();
                        $cond_row_goods_common['common_id'] = $goods_base['common_id'];
                        $cond_row_goods_common['shop_id'] = Perm::$shopId;
                        $goods_common_row = $Goods_CommonModel->getSharedGoodsCommon($cond_row_goods_common);

                        if ($field_row['zx_price'] >= $goods_common_row['shared_price'])
                        {
                            $check_post_data = false;
                            $msg_label = _('折扣价格必须低于商品价格！');
                        }
                        else if($goods_common_row['is_promotion'] && $field_row['zx_price'] <= $goods_common_row['promotion_total_price'])
                        {
                            $check_post_data = false;
                            $msg_label = _('折扣价格必须大于分享立赚价格！');
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
                    $this->priceBaseModel->editPriceActInfo($price_id, $field_row);
                    $flag                      = true;
                    $data                      = $field_row;
                    $data['price_id'] = $price_id;
                }
                else
                {
                    $flag = false;
                }
            }else{
               $flag = false;
            }
            $arr = array();
            if ($flag){
                 $arr['msg']    = _('操作成功！');
                 $arr['status'] = 200;
            }else{
                 $arr['msg']    = $msg_label?$msg_label:_('操作失败！');
                 $arr['status'] = 250;
            }

	        echo json_encode($arr);
	}
	public function removePriceAct(){

		$price_id = request_int('id');
		$check_right = $this->priceBaseModel->getOne($price_id);
		if ($check_right['shop_id'] == Perm::$shopId)
		{
			$flag = $this->priceBaseModel->removePriceActItem($price_id);
			if($flag)
            {
                $goods_base = $this->goodsBaseModel->getOne($check_right['goods_id']);
                if($goods_base)
                {
                    //需要先判断此common_id 还有没有其他goods_id 参加了活动 然后才能解锁
                    $count = $this->priceBaseModel->getCount(array('common_id'=>$goods_base['common_id']));
                    if($count == 0)
                    {
                        $this->goodsCommonModel->editCommon($goods_base['common_id'],array('common_promotion_type'=>Goods_CommonModel::NOPROMOTION));
                    }
                }

                $msg    = _('删除成功！');
                $status = 200;
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

		$data['price_id'] = $price_id;

		$this->data->addBody(-140, $data, $msg, $status);
	}
	public function  checkPrice(){
        $data = array();
        $cond_row1                         = array();
        $cond_row1['goods_id']             = request_int('goods_id');
        $cond_row1['price_state'] = Price_baseModel::NORMAL;
        $price_rows1              = $this->priceBaseModel->getPriceByWhere($cond_row1);
        // var_dump($price_rows1);
        $cond_row2                         = array();
        $cond_row2['goods_id']             = request_int('goods_id');
        $cond_row2['price_state'] = Price_baseModel::NORMAL;
        $price_rows2              = $this->priceBaseModel->getPriceByWhere($cond_row2);
        if ($price_rows1 || $price_rows2)
        {
            $msg    = _('该商品已经参加过活动！');
            $status = 250;
        }
        else
        {
            $msg    = _('该商品尚未参加过活动！');
            $status = 200;
        }

        $this->data->addBody(-140, $data, $msg, $status);
    }
	public function  add(){
        include $this->view->getView();
    }
	public function PriceEdit(){
			$price_id           = $_POST['price_id'];
            $field_row['zx_price'] = $_POST['zx_price'];
            $shared_price   = $_POST['shared_price'];
            $field_row['price_id'] = $price_id;
            $field_row['shop_id'] = Perm::$shopId;

            $price_goods = $this->priceBaseModel->getOne($price_id);

            if ($price_goods){
                $check_post_data = true;
                if ($field_row['zx_price'] <= 0)
                {
                    $check_post_data = false;
                    $msg_label = _('请输入商品折扣价格，折扣价不能为 0！');
                }else
                {
                    $goods_base = $this->goodsBaseModel->getOne($price_goods['goods_id']);
                    if($goods_base)
                    {
                        $Goods_CommonModel = new Goods_CommonModel();
                        $cond_row_goods_common['common_id'] = $goods_base['common_id'];
                        $cond_row_goods_common['shop_id'] = Perm::$shopId;
                        $goods_common_row = $Goods_CommonModel->getSharedGoodsCommon($cond_row_goods_common);

                        if ($field_row['zx_price'] >= $goods_common_row['shared_price'])
                        {
                            $check_post_data = false;
                            $msg_label = _('折扣价格必须低于商品价格！');
                        }
                        else if($goods_common_row['is_promotion'] && $field_row['zx_price'] <= $goods_common_row['promotion_total_price'])
                        {
                            $check_post_data = false;
                            $msg_label = _('折扣价格必须大于分享立赚价格！');
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
                    $this->priceBaseModel->editPriceActInfo($price_id, $field_row);
                    $flag                      = true;
                    $data                      = $field_row;
                    $data['price_id'] = $price_id;
                }
                else
                {
                    $flag = false;
                }
            }else{
               $flag = false;
            }
            $arr = array();
            if ($flag){
                 $arr['msg']    = _('操作成功！');
                 $arr['status'] = 200;
            }else{
                 $arr['msg']    = $msg_label?$msg_label:_('操作失败！');
                 $arr['status'] = 250;
            }

	        echo json_encode($arr);
	}
	public function removePriceAct(){

		$price_id = request_int('id');
		$check_right = $this->priceBaseModel->getOne($price_id);
		if ($check_right['shop_id'] == Perm::$shopId)
		{
			$flag = $this->priceBaseModel->removePriceActItem($price_id);
			if($flag)
            {
                $goods_base = $this->goodsBaseModel->getOne($check_right['goods_id']);
                if($goods_base)
                {
                    //需要先判断此common_id 还有没有其他goods_id 参加了活动 然后才能解锁
                    $count = $this->priceBaseModel->getCount(array('common_id'=>$goods_base['common_id']));
                    if($count == 0)
                    {
                        $this->goodsCommonModel->editCommon($goods_base['common_id'],array('common_promotion_type'=>Goods_CommonModel::NOPROMOTION));
                    }
                }

                $msg    = _('删除成功！');
                $status = 200;
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

		$data['price_id'] = $price_id;

		$this->data->addBody(-140, $data, $msg, $status);
	}
	public function  checkPrice(){
        $data = array();
        $cond_row1                         = array();
        $cond_row1['goods_id']             = request_int('goods_id');
        $cond_row1['price_state'] = Price_baseModel::NORMAL;
        $price_rows1              = $this->priceBaseModel->getPriceByWhere($cond_row1);
        $cond_row2                         = array();
        $cond_row2['goods_id']             = request_int('goods_id');
        $cond_row2['price_state'] = Price_baseModel::NORMAL;
        $price_rows2              = $this->priceBaseModel->getPriceByWhere($cond_row2);
        if ($price_rows1 || $price_rows2)
        {
            $msg    = _('该商品已经参加过活动！');
            $status = 250;
        }
        else
        {
            $msg    = _('该商品尚未参加过活动！');
            $status = 200;
        }

        $this->data->addBody(-140, $data, $msg, $status);
    }
	public function  add(){
        include $this->view->getView();
    }*/
}
?>