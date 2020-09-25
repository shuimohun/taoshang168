<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Seller_Promotion_IncreaseCtl extends Seller_Controller
{
	public $increaseBaseModel        = null;
	public $increaseGoodsModel       = null;
	public $increaseRuleModel        = null;
	public $increaseRedempGoodsModel = null;
	public $increaseComboModel       = null;
	public $goodsBaseModel           = null;
    public $goodsCommonModel         = null;
	public $shopCostModel            = null;
	public $shopBaseModel            = null;

	public $combo_flag        = false; //套餐是否可用
	public $shop_info         = array();  //店铺信息
	public $self_support_flag = false;    //是否为自营店铺

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
				$data->setError(_('加价购功能已关闭'), 30);
				$d = $data->getDataRows();

				$protocol_data = YLB_Data::encodeProtocolData($d);
				echo $protocol_data;
				exit();
			}
		}

		$this->increaseBaseModel        = new Increase_BaseModel();
		$this->increaseGoodsModel       = new Increase_GoodsModel();
		$this->increaseRuleModel        = new Increase_RuleModel();
		$this->increaseRedempGoodsModel = new Increase_RedempGoodsModel();
		$this->increaseComboModel       = new Increase_ComboModel();
		$this->goodsBaseModel           = new Goods_BaseModel();
		$this->goodsCommonModel         = new Goods_CommonModel();
		$this->shopCostModel            = new Shop_CostModel();
		$this->shopBaseModel            = new Shop_BaseModel();

		$this->shop_info         = $this->shopBaseModel->getOne(Perm::$shopId);//店铺信息
		$this->self_support_flag = ($this->shop_info['shop_self_support'] == "true" || Web_ConfigModel::value('promotion_increase_price') == 0) ? true : false; //是否为自营店铺标志

		if ($this->self_support_flag) //平台店铺，没有套餐限制
		{
			$this->combo_flag = true;
		}
		else
		{
			$this->combo_flag = $this->increaseComboModel->checkQuotaStateByShopId(Perm::$shopId);

		}

	}

	/**
	 * 活动列表页
	 */
	public function index()
	{
		$data = array();
		$combo_row = array();

		$cond_row['shop_id'] = Perm::$shopId;

		$YLB_Page           = new YLB_Page();
		$YLB_Page->listRows = request_int('listRows')?request_int('listRows'):10;
		$rows              = $YLB_Page->listRows;
		$offset            = request_int('firstRow', 0);
		$page              = ceil_r($offset / $rows);

		if (request_string('op') == 'edit' && request_int('id'))
		{
			$increase_id = request_int('id');
			$check_row   = $this->increaseBaseModel->getIncreaseActItem($increase_id);

			if ($check_row['shop_id'] == Perm::$shopId)
			{
				$data = $this->increaseBaseModel->getIncreaseDetail($increase_id);
			}
			else
			{
				location_to('index.php?ctl=Seller_Promotion_Increase&met=index&typ=e');
			}

			$this->view->setMet('edit');
		}
		else
		{
            //店铺下的加价购活动
			if (request_string('keyword'))
			{
				$cond_row['increase_name:LIKE'] = '%'.request_string('keyword') . '%';
			}

			if (request_int('state'))
			{
				$cond_row['increase_state'] = request_int('state');
			}

			$data               = $this->increaseBaseModel->getIncreaseActList($cond_row, array('increase_id' => 'ASC'), $page, $rows);
			$YLB_Page->totalRows = $data['totalsize'];
			$page_nav           = $YLB_Page->prompt();

			if (!$this->self_support_flag)  //普通店铺
			{
				if ($this->combo_flag)//套餐可用
				{
					$combo_row = $this->increaseComboModel->getComboInfo(Perm::$shopId);
				}
			}
		}

		if('json' == $this->typ)
		{
			$json_data['data']		= $data;
			$json_data['shop_type'] = $this->self_support_flag;
			$json_data['common_flag'] = $this->combo_flag;
			$json_data['common_row'] = $combo_row;
			$this->data->addBody(-140, $json_data);
		}
		else
		{
			include $this->view->getView();
		}

	}

    /**
     * 添加活动页
     */
    public function add()
    {
        $combo = array();
        if (!$this->self_support_flag)  //普通店铺
        {
            if (!$this->combo_flag)
            {
                location_to('index.php?ctl=Seller_Promotion_Increase&met=combo&typ=e');
            }
            else
            {
                $combo = $this->increaseComboModel->getComboInfo(Perm::$shopId); //套餐信息
            }
        }
        else
        {
            $combo['combo_end_time'] = date("Y-m-d H:i:s", strtotime("11 june 2030"));
        }

        if('json' == $this->typ)
        {
            $data['self_support_flag'] = $this->self_support_flag;
            $data['combo_flag'] 	   = $this->combo_flag;
            $data['combo'] 		       = $combo;
            $this->data->addBody(-140, $data);
        }
        else
        {
            include $this->view->getView();
        }

    }

    /**
     * 添加活动
     * 判断是否有套餐使用权
     */
    public function addIncrease()
    {
        $data = array();

        if (!$this->combo_flag)
        {
            $flag = false;
        }
        else
        {
            $field_row['increase_name']       = request_string('increase_name');
            $field_row['increase_start_time'] = request_string('increase_start_time');
            $field_row['increase_end_time']   = request_string('increase_end_time');
            $field_row['shop_id']             =  Perm::$shopId;
            $field_row['shop_name']           =  $this->shop_info['shop_name'];
            $field_row['user_id']             =  Perm::$userId;
            $field_row['user_nickname']       =  Perm::$row['user_account'];
            $insert_id = $this->increaseBaseModel->addIncreaseActItem($field_row);

            if ($insert_id)
            {
                $flag                = true;
                $data['increase_id'] = $insert_id;
            }
        }

        if ($flag)
        {
            $msg    = _('添加成功！');
            $status = 200;
        }
        else
        {
            $msg    = _('添加失败！');
            $status = 250;
        }
        $this->data->addBody(-140, $data, $msg, $status);
    }

    /**
     * 删除活动
     */
    public function removeIncreaseAct()
    {
        $increase_id = request_int('id');
        $check_row   = $this->increaseBaseModel->getOne($increase_id);

        if ($check_row['shop_id'] == Perm::$shopId)
        {
            $this->increaseBaseModel->sql->startTransactionDb();

            //删除活动
            $flag = $this->increaseBaseModel->removeIncreaseActItem($increase_id);

            if ($flag && $this->increaseBaseModel->sql->commitDb())
            {
                $msg    = _('删除成功！');
                $status = 200;
            }
            else
            {
                $this->increaseBaseModel->sql->rollBackDb();

                $msg    = _('删除失败！');
                $status = 250;
            }
        }
        else
        {
            $msg    = _('删除失败！');
            $status = 250;
        }

        $data = array();
        $this->data->addBody(-140, $data, $msg, $status);
    }

    /*编辑活动*/
    public function editIncrease()
    {
        $data = array();

        if (!$this->combo_flag)
        {
            $msg    = _('套餐不可用');
            $status = 250;
        }
        else
        {
            //判断规则购满金额是否有重复
            $increase_id = request_int('increase_id');
            $check_row   = $this->increaseBaseModel->getIncreaseActItem($increase_id);

            if ($check_row['shop_id'] == Perm::$shopId)
            {
                $rs_row = array();

                $Goods_CommonModel = new Goods_CommonModel();

                $this->increaseBaseModel->sql->startTransactionDb();

                //修改活动名称
                $field_row_act['increase_name'] = request_string('increase_name');
                if(request_string('increase_name'))
                {
                    $this->increaseBaseModel->editIncrease($increase_id, $field_row_act);
                }

                //已加入该活动的商品goods_id
                $cond_row_joined['increase_id'] = $increase_id;
                $cond_row_joined['shop_id']     = Perm::$shopId;
                $joined_goods_id_row = $this->increaseGoodsModel->getIncreaseGoodsIdByWhere($cond_row_joined, array('increase_goods_id' => 'ASC'));
                //编辑加入活动的商品
                $join_goods_id_row     = request_row('join_act_goods_id');//商品SKU
                $join_goods_common_row = request_row('join_act_common_id');//商品Common

                /*$cond_row_goods_base['shop_id'] = Perm::$shopId;
                $cond_row_goods_base['goods_id:IN'] = $join_goods_id_row;
                $join_goods_base_rows   =  $this->goodsBaseModel->getByWhere($cond_row_goods_base);*/

                $common_id_row = array();
                foreach ($join_goods_id_row as $key => $goods_id)
                {
                    $goods_row = array();
                    if (!in_array($goods_id, $joined_goods_id_row)) //如果商品以前没有参加该活动，加入活动
                    {
                        $goods_row['increase_id']      = $increase_id;
                        $goods_row['goods_id']         = $goods_id;
                        $goods_row['common_id']        = $join_goods_common_row[$key];
                        $goods_row['shop_id']          = Perm::$shopId;
                        $goods_row['goods_start_time'] = $check_row['increase_start_time'];
                        $goods_row['goods_end_time']   = $check_row['increase_end_time'];
                        $add_flag                      = $this->increaseGoodsModel->addIncreaseGoods($goods_row, true);
                        check_rs($add_flag, $rs_row);

                        $common_id_row[] = $join_goods_common_row[$key];
                    }
                }

                if ($common_id_row)
                {
                    //修改goods_common表 加价购活动状态
                    $update_common_a_flag = $Goods_CommonModel->editCommon($common_id_row, array('common_is_jia' => 1));
                    check_rs($update_common_a_flag, $rs_row);
                }

                // 删除以前加入活动的商品
                $remove_increase_goods_id = array();
                foreach ($joined_goods_id_row as $increase_goods_id => $goods_id)
                {
                    if (!in_array($goods_id, $join_goods_id_row))
                    {
                        array_push($remove_increase_goods_id, $increase_goods_id);
                    }
                }

                if ($remove_increase_goods_id)
                {
                    $remove_flag = $this->increaseGoodsModel->removeIncreaseGoods($remove_increase_goods_id, true);
                    check_rs($remove_flag, $rs_row);
                }

                //活动规则
                $edit_rule_row   = request_row('rule_levle');
                $edit_rule_price = array();
                foreach ($edit_rule_row as $key => $rule)
                {
                    if (is_numeric($rule['mincost']) && $rule['mincost'] * 1 > 0)
                    {
                        $edit_rule_price[] = $rule['mincost']; //购满金额
                    }
                    else
                    {
                        unset($edit_rule_row[$key]);
                    }
                }

                //已存在的活动规则-价格
                $rule_price_row = $this->increaseRuleModel->getRulePriceByWhere(array('increase_id' => $increase_id), array('rule_id' => 'ASC'));

                foreach ($edit_rule_row as $key => $rule)
                {
                    /*
                     * 活动规则不存在
                     * 1、添加新规则
                     * 2、添加规则下的对应换购商品
                     * */
                    if (!in_array($rule['mincost'], $rule_price_row))
                    {
                        $field_rule_row                     = array();
                        $field_rule_row['increase_id']      = $increase_id;
                        $field_rule_row['rule_price']       = $rule['mincost'];
                        $field_rule_row['rule_goods_limit'] = $rule['maxrebuy'];
                        $rule_id                            = $this->increaseRuleModel->addIncreaseRule($field_rule_row, true);
                        check_rs($rule_id, $rs_row);

                        if ($rule_id)
                        {
                            $field_rede_row                = array();
                            $field_rede_row['rule_id']     = $rule_id;
                            $field_rede_row['increase_id'] = $increase_id;
                            $field_rede_row['shop_id']     = Perm::$shopId;
                            foreach ($rule['skus'] as $sku_id => $redemp_price)
                            {
                                $field_rede_row['goods_id']     = $sku_id;
                                $field_rede_row['redemp_price'] = $redemp_price;
                                $redemp_id                      = $this->increaseRedempGoodsModel->addIncreaseRedempGoods($field_rede_row, true);
                                check_rs($redemp_id, $rs_row);
                            }
                        }
                    }
                    else
                    {
                        /*活动规则已存在
                         * 1、编辑规格下允许换购商品的数量
                         * 2、判断规格下的换购商品是否已经添加过
                         * （1）编辑的换购商品添加过，编辑对应的换购价
                         * （2）编辑的换购商品未添加，添加换购商品
                         * （3）已添加的换购在新编辑的规则中不存在，移除已添加的换购商品
                        */

                        //编辑规格下允许换购商品的数量
                        $rule_price_row_rev            = array_flip($rule_price_row);
                        $rule_id                       = $rule_price_row_rev[$rule['mincost']];
                        $field_row                     = array();
                        $field_row['rule_goods_limit'] = $rule['maxrebuy'];
                        $this->increaseRuleModel->editIncreaseRule($rule_id, $field_row);

                        //活动规则下已存在的换购商品goods_id，非主键,索引为主键
                        $cond_row                = array();
                        $cond_row['rule_id']     = $rule_id;
                        $cond_row['increase_id'] = $increase_id;
                        $redemp_goods_sku_id_row = $this->increaseRedempGoodsModel->getIncreaseRedempGoodsIdByWhere($cond_row, array());

                        $edit_rule_sku_id = array();
                        foreach ($rule['skus'] as $goods_sku_id => $redemp_price)
                        {
                            //编辑的换购商品未添加，添加换购商品
                            if (!in_array($goods_sku_id, $redemp_goods_sku_id_row))
                            {
                                $field_rede_row                 = array();
                                $field_rede_row['goods_id']     = $goods_sku_id;
                                $field_rede_row['redemp_price'] = $redemp_price;
                                $field_rede_row['rule_id']      = $rule_id;
                                $field_rede_row['increase_id']  = $increase_id;
                                $field_rede_row['shop_id']      = Perm::$shopId;
                                $redemp_id                      = $this->increaseRedempGoodsModel->addIncreaseRedempGoods($field_rede_row, true);
                                check_rs($redemp_id, $rs_row);
                            }
                            else   //编辑的换购商品已添加，编辑换购价格
                            {
                                $redemp_goods_id_row            = array_flip($redemp_goods_sku_id_row);
                                $field_rede_row                 = array();
                                $field_rede_row['redemp_price'] = $redemp_price;
                                $redemp_goods_id                = $redemp_goods_id_row[$goods_sku_id];
                                $this->increaseRedempGoodsModel->editRedemptionGoods($redemp_goods_id, $field_rede_row);
                            }
                            $edit_rule_sku_id[] = $goods_sku_id;
                        }
                        $edit_rule_sku_id = array_unique($edit_rule_sku_id);

                        //已添加的换购在新编辑的规则中不存在，移除已添加的换购商品
                        $remove_redemption_goods_id = array();
                        foreach ($redemp_goods_sku_id_row as $redemp_goods_id => $goods_sku_id)
                        {
                            if (!in_array($goods_sku_id, $edit_rule_sku_id))
                            {
                                array_push($remove_redemption_goods_id, $redemp_goods_id);
                            }
                        }
                        if ($remove_redemption_goods_id)
                        {
                            $delete_flag = $this->increaseRedempGoodsModel->removeIncreaseRedempGoods($remove_redemption_goods_id);
                            check_rs($delete_flag, $rs_row);
                        }
                    }
                }

                $remove_rule_id   = array();      //删除的规则id
                $remove_redemp_id = array();    //规则下的所有换购商品id
                foreach ($rule_price_row as $rule_id => $rule_price)
                {
                    if (!in_array($rule_price, $edit_rule_price))
                    {
                        $cond_row = array();
                        array_push($remove_rule_id, $rule_id);
                        $cond_row['rule_id']     = $rule_id;
                        $cond_row['increase_id'] = $increase_id;
                        $remove_redemp_id        = array_merge($remove_redemp_id, $this->increaseRedempGoodsModel->getRedempGoodsKeyByWhere($cond_row, array()));
                    }
                }

                if ($remove_rule_id)
                {
                    $delete_r_flag = $this->increaseRuleModel->removeIncreaseRuleItem($remove_rule_id);
                    check_rs($delete_r_flag, $rs_row);
                }
                if ($remove_redemp_id)
                {
                    $delete_redemp_flag = $this->increaseRedempGoodsModel->removeIncreaseRedempGoods($remove_redemp_id);
                    check_rs($delete_redemp_flag, $rs_row);
                }

                if (is_ok($rs_row) && $this->increaseBaseModel->sql->commitDb())
                {
                    $msg    = _('success');
                    $status = 200;
                }
                else
                {
                    $this->increaseBaseModel->sql->rollBackDb();
                    $msg    = _('failure');
                    $status = 250;
                }
            }
            else
            {
                $msg    = _('failure');
                $status = 250;
            }
        }

        $this->data->addBody(-140, $data, $msg, $status);
    }

    /**
     * 店铺商品信息和已参加活动的商品
     */
    public function getShopGoodsII()
    {
        $increase_id = request_int('increase_id');
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

        //$cond_row['common_promotion_type'] = Goods_CommonModel::NOPROMOTION;//只取没参加活动或只参加了本活动的
        $data = $this->goodsCommonModel->getNormalSateGoodsBase($cond_row, array('goods_id' => 'DESC'), $page, $rows);

        $json_rows = array();
        //判断goods_base 是否参加了活动 参加了就标记已参加
        foreach ($data['items'] as $key=>$value)
        {
            $cond_row_discount['goods_id'] = $value['goods_id'];
            $increase_id = $this->increaseGoodsModel->getKeyByWhere($cond_row_discount);
            if($increase_id)
            {
                $data['items'][$key]['is_joined'] = 1;
            }

            $json_rows[$value['goods_id']]['id']     = $value['goods_id'];
            $json_rows[$value['goods_id']]['common'] = $value['common_id'];
            $json_rows[$value['goods_id']]['price']  = format_money($value['goods_price']);
            $json_rows[$value['goods_id']]['image']  = $value['goods_image'];
            $json_rows[$value['goods_id']]['name']   = $value['goods_name'];
            $json_rows[$value['goods_id']]['sharesumprice']   = format_money($value['share_sum_price']);
            $json_rows[$value['goods_id']]['goods_spec']   = $value['goods_spec'];
        }

        $json_rows = json_encode($json_rows);

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

    public function getShopGoods()
    {
        $json_rows = [];
        $page      = request_int('page',1);
        $rows      = request_int('rows',12);
        $offset    = $rows * ($page - 1);

        $shop_id    = Perm::$shopId;
        $goods_name = request_string('goods_name');

        $cond_sql = '';
        if($goods_name)
        {
            $cond_sql = ' a.goods_name LIKE "%' . $goods_name . '%" ';
        }

        $count_sql = "SELECT COUNT(*) total FROM ";
        $count_sql .= TABEL_PREFIX . 'goods_base a LEFT JOIN ' . TABEL_PREFIX . 'goods_common b ON a.`common_id` = b.`common_id` ';
        $count_sql .= 'WHERE a.`shop_id` = ' . $shop_id . ' AND a.goods_is_shelves = 1 AND a.goods_stock > 0 AND b.common_state = 1 AND b.shop_status = 3 ' . $cond_sql;
        $total = $this->goodsCommonModel->selectSql($count_sql);

        if($total)
        {
            $total = pos($total);
            $total = $total['total'];

            if($total)
            {
                $select_sql = "SELECT a.goods_id,a.shop_id,a.shop_name,a.goods_name,a.goods_price,a.goods_stock,a.goods_spec,a.goods_image,CASE WHEN a.goods_is_promotion = 1 THEN a.goods_share_price + a.goods_promotion_price ELSE a.goods_share_price END share_sum_price,b.common_spec_name,common_spec_value,c.increase_goods_id FROM ";
                $select_sql .= TABEL_PREFIX . 'goods_base a LEFT JOIN ' . TABEL_PREFIX . 'goods_common b ON a.`common_id` = b.`common_id` ';
                $select_sql .= ' LEFT JOIN `ylb_increase_goods` c ON a.goods_id = c.goods_id ';
                $select_sql .= 'WHERE a.`shop_id` = ' . $shop_id . ' AND a.goods_is_shelves = 1 AND a.goods_stock > 0 AND b.common_state = 1 AND b.shop_status = 3 ' . $cond_sql;
                $select_sql .= "ORDER BY a.goods_id DESC LIMIT $offset,$rows";
                $data = $this->goodsCommonModel->selectSql($select_sql);

                foreach($data as $key=>$value)
                {
                    $data[$key]['goods_spec'] = $this->goodsCommonModel->getGoodsSpecII($value['goods_spec'],$value['common_spec_name'],$value['common_spec_value']);
                    $json_rows[$value['goods_id']]['id']     = $value['goods_id'];
                    $json_rows[$value['goods_id']]['common'] = $value['common_id'];
                    $json_rows[$value['goods_id']]['price']  = format_money($value['goods_price']);
                    $json_rows[$value['goods_id']]['image']  = $value['goods_image'];
                    $json_rows[$value['goods_id']]['name']   = $value['goods_name'];
                    $json_rows[$value['goods_id']]['sharesumprice']   = format_money($value['share_sum_price']);
                    $json_rows[$value['goods_id']]['goodsspec'] =  $data[$key]['goods_spec'];
                }

                $json_rows = json_encode($json_rows);
            }
        }

        if('json' == $this->typ)
        {
            $this->data->addBody(-140, $data);
        }
        else
        {
            $YLB_Page = new YLB_Page();
            $YLB_Page->nowPage    = $page;
            $YLB_Page->listRows   = $rows;
            $YLB_Page->totalPages = $data['total'];
            $page_nav             = $YLB_Page->promptII();

            include $this->view->getView();
        }
    }













    /**
     * 获取店铺可参加换购的商品
     * 换购的商品有没有限制 ??? 标记Zhenzh 例:参加了惠抢购的商品可不可以为换购商品
     */
    public function getShopGoodsSku()
    {
        $cond_row = array();
        //分页
        $YLB_Page           = new YLB_Page();
        $YLB_Page->listRows = request_int('listRows')?request_int('listRows'):12;
        $rows              = $YLB_Page->listRows;
        $offset            = request_int('firstRow', 0);
        $page              = ceil_r($offset / $rows);

        $cond_row['shop_id'] = Perm::$shopId;
        $goods_name          = request_string('goods_name');

        if ($goods_name)
        {
            $cond_row['common_name:LIKE'] = "%".$goods_name . "%";
        }
        //换购商品ID
        $increase_id         = request_int('id');
        $redemption_goods_id = $this->increaseRedempGoodsModel->getIncreaseRedempGoodsIdByWhere(array('increase_id' => $increase_id), array());

        $Goods_CommonModel = new Goods_CommonModel();
        $data              = $Goods_CommonModel->getNormalSateGoodsBase($cond_row, array('goods_id' => 'DESC'), $page, $rows);

        $YLB_Page->totalRows = $data['totalsize'];
        $page_nav           = $YLB_Page->prompt();

        $rows = array();
        foreach ($data['items'] as $key => $value)
        {
            $rows[$value['goods_id']]          = $data['items'][$key];
            $rows[$value['goods_id']]['id']    = $value['goods_id'];
            $rows[$value['goods_id']]['stock']    = $value['goods_stock'];
            $rows[$value['goods_id']]['price'] = format_money($value['goods_price']);
            $rows[$value['goods_id']]['goodsprice'] = $value['goods_price'];
            $rows[$value['goods_id']]['image'] = $value['goods_image'];
            $rows[$value['goods_id']]['name']  = $value['goods_name'];
            $rows[$value['goods_id']]['sprice']  = format_money($value['share_sum_price']);
            $rows[$value['goods_id']]['sharesumprice']  = $value['share_sum_price'];

            if (in_array($value['goods_id'], $redemption_goods_id))
            {
                $data['items'][$key]['is_joined'] = 'true';
            }
            else
            {
                $data['items'][$key]['is_joined'] = 'false';
            }
        }

        $rows       = encode_json($rows);
        $date_level = request_int('level');

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
     * 套餐管理页
     */
	public function combo()
	{
		if ($this->self_support_flag)   //免费发布活动
		{
            
            location_go_back(_('自营店铺或者套餐续费， 不需要设置。'));
			//location_to('index.php?ctl=Seller_Promotion_Increase&met=add&typ=e');
		}

		if('json' == $this->typ)
		{
			$data['promotion_increase_price'] = floatval(Web_ConfigModel::value('promotion_increase_price'));
			$this->data->addBody(-140, $data);
		}
		else
		{
			include $this->view->getView();
		}

	}

    /**
     * 购买套餐或套餐续费
     */
	public function addCombo()
	{
		$rs_row      = array();
		$data        = array();
		$combo_row   = array();
		$month_price = floatval(Web_ConfigModel::value('promotion_increase_price'));
		$month       = request_int('month');
		$days        = 30 * $month;

        if($month > 0)
        {
            $this->increaseComboModel->sql->startTransactionDb();

            $field_row['user_id']     = Perm::$userId;
            $field_row['shop_id']     = Perm::$shopId;
            $field_row['cost_price']  = $month_price * $month;
            $field_row['cost_desc']   = _('店铺购买加价购活动消费');
            $field_row['cost_status'] = 0;
            $field_row['cost_time']   = get_date_time();
            $flag                     = $this->shopCostModel->addCost($field_row, true);
            check_rs($flag, $rs_row);

            //购买或续费套餐
            if ($flag)
            {
                $combo_row = $this->increaseComboModel->getIncreaseComboByShopID(Perm::$shopId);

                if ($combo_row)              //套餐续费
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
                    $op_flag = $this->increaseComboModel->renewIncreaseCombo($combo_row['combo_id'], $field);
                }
                else                    //套餐购买
                {
                    $shop_row = $this->shopBaseModel->getBaseOneList(array('shop_id' => Perm::$shopId));

                    $field['combo_start_time'] = get_date_time();
                    $field['combo_end_time']   = date('Y-m-d H:i:s', strtotime("+$days days"));
                    $field['shop_id']          = Perm::$shopId;
                    $field['shop_name']        = $shop_row['shop_name'];
                    $field['user_id']          = Perm::$userId;
                    $field['user_nickname']    = Perm::$row['user_account'];

                    $op_flag = $this->increaseComboModel->addIncreaseCombo($field, true);
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

            if (is_ok($rs_row) && isset($rs) && $rs['status'] ==200 && $this->increaseComboModel->sql->commitDb())
            {
                $msg    = _('操作成功！');
                $status = 200;
            }
            else
            {
                $this->increaseComboModel->sql->rollBackDb();
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