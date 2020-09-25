<?php

/**
 * @author
 */
class Promotion extends YLB_Model
{
    public $ScareBuy_BaseModel        = null;//惠抢购
	public $Increase_BaseModel        = null;//加价购
	public $Increase_GoodsModel       = null;//加价购 商品
	public $Increase_RuleModel        = null;//加价购 规则
	public $Increase_RedempGoodsModel = null;//加价购 赠品
	public $Discount_BaseModel        = null;//限时折扣
	public $Discount_GoodsModel       = null;//限时折扣 商品
    public $ManSong_BaseModel         = null;//满减、满送
	public $ManSong_RuleModel         = null;//满减、满送规则
	public $Price_BaseModel           = null;//手机专享
    public $NewBuyer_BaseModel        = null;//新人优惠
    public $FuBaseModel              = null;//送福免单
    //public $FuQuotaModel              = null;
    public $bundlingBaseModel         = null;//套餐
    public $bundlingGoodsModel        = null;//套餐商品

    const NOTSTART = 1;
    const START = 2;
    const OVER = 3;
    public static $state_map = array(
        self::NOTSTART => '未开始',
        self::START => '进行中',
        self::OVER => '已结束'
    );

	public function __construct()
	{
        $this->ScareBuy_BaseModel        = new ScareBuy_BaseModel();
		$this->Increase_BaseModel        = new Increase_BaseModel();
		$this->Increase_GoodsModel       = new Increase_GoodsModel();
		$this->Increase_RuleModel        = new Increase_RuleModel();
		$this->Increase_RedempGoodsModel = new Increase_RedempGoodsModel();
		$this->Discount_BaseModel        = new Discount_BaseModel();
		$this->Discount_GoodsModel       = new Discount_GoodsModel();
        $this->ManSong_RuleModel         = new ManSong_RuleModel();
		$this->ManSong_BaseModel         = new ManSong_BaseModel();
		$this->Price_BaseModel           = new Price_BaseModel();
        $this->NewBuyer_BaseModel        = new NewBuyer_BaseModel();
        $this->FuBaseModel               = new Fu_BaseModel();
        //$this->FuQuotaModel              = new Fu_QuotaModel();
        $this->bundlingBaseModel         = new Bundling_BaseModel();
        $this->bundlingGoodsModel        = new Bundling_GoodsModel();
	}

    /**
     * 商城所有促销活动说明：
     * 促销互动分为以下几种：1 2 3 4不可重复添加
     * 1.惠抢购
     *   平台活动,优先级最高，抢购中的商品价格以抢购价格为准；
     *   a.开始日期 不能小于后台设定的审核期 结束时间为开始时间后24小时
     *   b.可设置参加数量 范围1-库存 设置后活动开始前库存锁定
     *   c.限购数量 抢购商品有购买优惠上限限制，超过优惠上限的按原价
     *   d.是否叠加免邮 是否叠加满减 是否叠加代金券 是否叠加加价购
     *
     * 2.限时折扣，限时折扣活动商品存在购买下限限制（默认为1），即参加活动的单个商品数量必须满足该数量限制，同一订单中，
     *   参加同一活动的不同商品数量不做累加判断，购物车中的商品价格需根据购买数量调整，不满足下限数量的，商品仍以原价格计算
     *
     * 3.手机专享
     *   移动端优惠价格参数typ=json
     *
     * 4.新人优惠
     *   店铺新人(从未在店铺内购买过商品)享受优惠
     *
     * 5.
     *
     * 6.送福免单
     *
     * a.加价购
     *   参加加价购活动的商品对其本身价格并不会产生影响，即使该商品也在活动规则下的换购商品中
     *   买家在购物车页面可以自主选择对应的换购商品，每件商品仅可以换购一件，换购商品价格以换购价为准，等级高的规则会覆盖等级低的规格，规则中的
     *   换购商品数量限制仅用于限定不同的换购商品
     *   同一订单中，参与同一活动的SKU共同累加的金额用于判断是否满足换购资格；
     *   同一订单中可以使用多组加价购活动
     *
     * b.满减送
     *   针对店铺所有商品，所以当一笔订单的总金额（包含换购商品的金额），满足规格设定的金额后，即满足活动要求，
     *   对应的优惠包括减现金和送礼品两种方式中的一种或全部，同一个满即送活动最多可以设置三个规则级别，订单满足的活动规则以满足
     *   最高规则金额的为准，减除的现金和赠送的礼品亦以该规则为准。
     *
     * c.优惠套装
     *   a.参加套装商品至少2件 最多5件
     */

	//店铺满即送信息
	public function getShopGiftInfo($shop_id)
	{
		$renew_row = array();
		if (Web_ConfigModel::value('promotion_allow')) //商品促销开启，包括限时折扣，满送，加价购
		{
			$cond_row['shop_id']       = $shop_id;
			$cond_row['mansong_state'] = ManSong_BaseModel::NORMAL;
			$row                       = $this->ManSong_BaseModel->getManSongActItem($cond_row);
			if ($row)
			{
				if ($row['mansong_state'] == ManSong_BaseModel::NORMAL && time() >= strtotime($row['mansong_start_time']))
				{
					$renew_row = $row;
				}
			}
		}

		return $renew_row;
	}

	//满即送活动信息
	public function getShopOrderGift($shop_id, $order_price)
	{
		$renew_row = array();
		if (Web_ConfigModel::value('promotion_allow')) //促销开启
		{
			$cond_row['shop_id']       = $shop_id;
			$cond_row['mansong_state'] = ManSong_BaseModel::NORMAL;
			$mansong_rows              = $this->ManSong_BaseModel->getManSongActItem($cond_row);

            if ($mansong_rows && time() >= strtotime($mansong_rows['mansong_start_time']))
            {
                foreach ($mansong_rows['rule'] as $key => $rule)
                {
                    if ($order_price >= $rule['rule_price'])
                    {
                        $renew_row = $rule;
                    }
                }
            }
		}
		return $renew_row;
	}

	//根据订单中已有的商品信息获取对应可以选择的加价购换购商品信息
	public function getOrderIncreaseInfo($order_info = array())
	{
		$ret_row = array();
		if (Web_ConfigModel::value('promotion_allow')) //促销开启
		{
			if ($order_info)
			{
				$shop_id                 = $order_info['shop_id'];
                $goods_row               = array_column($order_info['goods'], 'goods_id');
                //$goods_price_row         = array_column($order_info['goods'], 'sumprice', 'goods_id');
                $goods_price_row         = array_column($order_info['goods'], 'jia_sprice', 'goods_id');
				$cond_row['goods_id:IN'] = $goods_row;
				$cond_row['shop_id']     = $shop_id;
				$cond_row['goods_start_time:<='] = get_date_time();
				$cond_row['goods_end_time:>='] = get_date_time();

                //查询出该订单中所有参加活动的商品
				$increase_goods_rows = $this->Increase_GoodsModel->getIncreaseGoodsByWhere($cond_row);

				if ($increase_goods_rows)
				{
					//每个加价购活动下参加活动的商品
					foreach ($increase_goods_rows as $k => $v)
					{
						$increase_row[$v['increase_id']]['goods'][$v['goods_id']] = $v;
					}

                    $increase_id_row                       = array_column($increase_goods_rows, 'increase_id');
					//一笔订单中参加的所有加价购活动
					$cond_increase_row['increase_id:IN'] = $increase_id_row;
					$cond_increase_row['shop_id']         = $shop_id;
					$cond_increase_row['increase_state'] = Increase_BaseModel::NORMAL;
					$increase_rows                         = $this->Increase_BaseModel->getIncreaseByWhere($cond_increase_row);
					if ($increase_rows)
					{
						foreach ($increase_rows as $kk => $vv)
						{
							$increase_row[$vv['increase_id']]['increase_info'] = $vv;//每个加价购活动信息
						}
					}

					//所有活动的规则信息
					$cond_rule_row['increase_id:IN'] = $increase_id_row;
					$order_rule_row['rule_price']    = 'ASC';
					$increase_rule_rows              = $this->Increase_RuleModel->getIncreaseRuleByWhere($cond_rule_row, $order_rule_row);
					if ($increase_rule_rows)
					{
						foreach ($increase_rule_rows as $rk => $rvalue)
						{
							$increase_row[$rvalue['increase_id']]['rules'][$rvalue['rule_price']] = $rvalue;
						}
					}

					//活动下的所有规则下的换购商品信息
					$cond_row_exc['increase_id:IN'] = $increase_id_row;
					$cond_row_exc['shop_id']        = $shop_id;
					$redemp_goods_rows              = $this->Increase_RedempGoodsModel->getIncreaseRedempGoodsByWhere($cond_row_exc);
					if ($redemp_goods_rows)
					{
						foreach ($redemp_goods_rows as $exk => $exvalue)
						{
							$increase_row[$exvalue['increase_id']]['exc_goods'][$exvalue['rule_id']][$exvalue['redemp_goods_id']] = $exvalue;
						}
					}

					if ($increase_row)
					{
						foreach ($increase_row as $key => $value)
						{
							$increase_goods_price = 0;//同一活动下的商品总金额
							foreach ($value['goods'] as $kk => $vv)
							{
								$increase_goods_price += $goods_price_row[$kk];
							}
							//每个活动下的规则
							$rule_price = 0;

							//需要根据规则金额排序
							$exc_goods = array();
							foreach ($value['rules'] as $kk => $vv)
							{
								if ($increase_goods_price >= $vv['rule_price'] && $vv['rule_price'] >= $rule_price)
								{
									if ($value['exc_goods'][$vv['rule_id']])
									{
										//$exc_goods                  = array_merge($exc_goods, $value['exc_goods'][$vv['rule_id']]);
										//$ret_row[$key]['exc_goods'] = $exc_goods;
										$ret_row[$key]['exc_goods']       = $value['exc_goods'][$vv['rule_id']];
										//$ret_row[$key]['exc_goods_limit'] = $vv['rule_goods_limit'];
										$ret_row[$key]['rule_info']       = $vv;
										$rule_price                       = $vv['rule_price'];
										$ret_row[$key]['shop_id']         = $shop_id;
									}
								}
							}
						}
					}
				}
			}
		}

		return $ret_row;
	}

    /**
     * 获取包含某商品的优惠套装 Zhenzh 20171116
     *
     * @param $goods_id
     * @return array
     */
    public function getBundlingInfoByGoodsId($goods_id)
    {
        $data = array();
        if (Web_ConfigModel::value('promotion_allow'))
        {
            if($goods_id)
            {
                $bundling_goods_data = $this->bundlingGoodsModel->select('bundling_id',array('goods_id'=>$goods_id),'','');
                if($bundling_goods_data)
                {
                    $bundling_ids = array_column($bundling_goods_data,'bundling_id');
                    //查询套餐是否正常
                    $data = $this->bundlingBaseModel->getByWhere(array('bundling_id:IN'=>$bundling_ids,'bundling_state'=>Bundling_BaseModel::NORMAL));
                }
            }

            if($data)
            {
                $bundling_ids = array_column($data,'bundling_id');
                $bundling_goods_data = $this->bundlingGoodsModel->getBundlingGoodsByWhere(array('bundling_id:IN'=>$bundling_ids));

                foreach ($bundling_goods_data as $key=>$value)
                {
                    if(!$value['status'])
                    {
                        $this->bundlingBaseModel->editBundlingActInfo($value['bundling_id'],array('bundling_state'=>Bundling_BaseModel::END));
                        unset($data[$value['bundling_id']]);
                        break;
                    }

                    if($value['goods_id'] == $goods_id)
                    {
                        $data[$value['bundling_id']]['goods_list'][0] = $value;
                    }
                    else
                    {
                        $data[$value['bundling_id']]['goods_list'][$value['goods_id']] = $value;
                    }

                    $data[$value['bundling_id']]['old_total_price'] += floatval($value['goods_price']);
                }
            }

            if($data)
            {
                $shareBaseModel = new Share_BaseModel();
                foreach ($data as $key=>$value)
                {
                    $data[$key]['old_total_price'] = number_format($data[$key]['old_total_price']*1,2,'.','');
                    $data[$key]['total_save_price'] = number_format($data[$key]['old_total_price'] - $data[$key]['bundling_discount_price'],2,'.','');
                    $share_info = $shareBaseModel ->getShareByBId($key);
                    $data[$key]['share_info'] = $share_info;
                }
            }
        }
        return $data;
    }

    /**
     * 惠抢购 Zhenzh
     *
     * @param $goods_id
     * @return array
     */
    public function getScareBuyInfoByGoodsId($goods_id)
    {
        $renew_row = array();
        if (Web_ConfigModel::value('scarebuy_allow'))
        {
            $cond_row['goods_id']      = $goods_id;
            $renew_row  = $this->ScareBuy_BaseModel->getScareBuyByWhere($cond_row);
        }
        return $renew_row;
    }

    /**
     * 限时折扣 Zhenzh
     *
     * @param $goods_id
     * @return array
     */
    public function getDiscountGoodsInfoByGoodsID($goods_id)
    {
        $renew_row = array();
        if (Web_ConfigModel::value('promotion_allow')) //商品促销开启，包括限时折扣，满送，加价购
        {
            $cond_row['goods_id'] = $goods_id;
            $renew_row  = $this->Discount_GoodsModel->getDiscountGoodsByWhere($cond_row);
        }
        return $renew_row;
    }

    /**
     * 手机专享 Zhenzh
     *
     * @param $goods_id
     * @return array
     */
    public function getPriceBaseInfoByGoodsID($goods_id)
    {
        $renew_row = array();

        if (Web_ConfigModel::value('promotion_allow')) //商品促销开启，包括限时折扣，满送，加价购
        {
            $cond_row['goods_id'] = $goods_id;
            $renew_row = $this->Price_BaseModel->getNormalPriceByWhere($cond_row);
        }
        return $renew_row;
    }

    /**
     * 新人优惠 Zhenzh
     *
     * @param $goods_id
     * @return array|null
     */
    public function getNewBuyerInfoByGoodsId($goods_id)
    {
        $data = array();
        if (Web_ConfigModel::value('promotion_allow'))
        {
            if (Perm::$userId)
            {
                if(request_string('uuid'))
                {
                    $Equipment = new Equipment();
                    $row_count = $Equipment->getRowCount(array('id'=>trim(request_string('uuid'))));
                    if($row_count)
                    {
                        return 250;
                    }
                }

                $goodsModel = new Goods_BaseModel();
                $data_row = $goodsModel->getGoodsBaseFieldById('shop_id',array('goods_id'=>$goods_id));

                if($data_row)
                {
                    $Order_BaseModel = new Order_BaseModel();
                    $order_cond['buyer_user_id'] = Perm::$userId;
                    $order_cond['shop_id'] = $data_row['shop_id'];
                    $order_cond['is_newbuyer'] = 1;
                    $order_cond['order_status:<'] = Order_StateModel::ORDER_CANCEL;
                    $order_id = $Order_BaseModel->getKeyByWhere($order_cond);
                    if($order_id)
                    {
                        return 250;
                    }
                }
            }

            $cond_row['goods_id'] = $goods_id;
            $data = $this->NewBuyer_BaseModel->getNewBuyerByWhere($cond_row);
        }

        return $data;
    }

    public function getFuByGoodsId($goods_id)
    {
        return $this->FuBaseModel->checkFu($goods_id,Perm::$userId);

        /*$data = array();
        if (Web_ConfigModel::value('promotion_allow'))
        {
            $cond_row['goods_id'] = $goods_id;
            $cond_row['fu_state'] = Fu_BaseModel::NORMAL;
            $cond_row['fu_stock:>'] = 0;
            $data = $this->FuBaseModel->getOneByWhere($cond_row);

            if ($data && Perm::$userId)
            {
                $data['status'] = 0;//表示状态正常

                if ($data['is_register'] == 0)
                {
                    $fu_quota = $this->FuQuotaModel->getOneByWhere([
                        'shop_id'=>$data['shop_id']
                    ]);

                    if ($fu_quota)
                    {
                        $seller_count = $fu_quota['goods_count'] ? $fu_quota['goods_count'] : 0;//限制会员免单商品数量
                        $seller_unit_count = $fu_quota['goods_unit_count'] ? $fu_quota['goods_unit_count'] : 0;//设定单品送福免单次数 0表示没限制
                        $seller_order_amount = $fu_quota['goods_order_amount'] ? $fu_quota['goods_order_amount'] : 0;//购物满xx元可继续送福免单
                        $seller_add_count = $fu_quota['goods_add_count'] ? $fu_quota['goods_add_count'] : 0;//购物满xx元继续送福免单商品数量

                        if ($seller_count && $seller_order_amount && $seller_add_count)
                        {
                            //查询当前商品免过多少次
                            $sql = 'SELECT COUNT(*) FROM '.TABEL_PREFIX.'order_goods WHERE goods_id = ' . $goods_id . ' AND buyer_user_id = '.Perm::$userId.' AND shop_id = '.$data['shop_id'].' AND goods_price = 0 AND order_goods_payment_amount = 0';
                            $times = $this->FuQuotaModel->selectSql($sql);
                            $times = $times ? current(current($times)) : 0;

                            if ($seller_unit_count == 0 || $times < $seller_unit_count)
                            {
                                //查询免过多少种商品
                                $sql = 'SELECT COUNT(*) FROM '.TABEL_PREFIX.'order_goods WHERE buyer_user_id = '.Perm::$userId.' AND shop_id = '.$data['shop_id'].' AND goods_price = 0 AND order_goods_payment_amount = 0 GROUP BY goods_id';
                                $count = $this->FuQuotaModel->selectSql($sql);
                                $count = $count ? current(current($count)) : 0;

                                //查询今天消费多少钱
                                $sql = 'SELECT SUM(order_payment_amount) FROM '.TABEL_PREFIX.'order_base WHERE buyer_user_id = '.Perm::$userId.' AND shop_id = '.$data['shop_id'].' AND order_status > 1 AND `order_refund_status` = 0 AND `order_return_status` = 0 AND payment_time >= "' . date('Y-m-d 00:00:00', time()) . '"';
                                $sum_amount = $this->FuQuotaModel->selectSql($sql);
                                $sum_amount = $sum_amount ? current(current($sum_amount)) : 0;

                                if ($sum_amount >= $seller_order_amount)
                                {
                                    $seller_count += $seller_add_count;
                                }

                                if ($count >= $seller_count)
                                {
                                    $data = ['status'=>4,'msg'=>'送福免单商品数已达上限(' . $seller_count . '个)' ];
                                }
                            }
                            else
                            {
                                $data = ['status'=>3,'msg'=>'该商品送福免单次数已达上限(' . $seller_unit_count . '次)' ];
                            }
                        }
                        else
                        {
                            $data = ['status'=>2,'msg'=>'活动设置不完整'];
                        }
                    }
                    else
                    {
                        $data = ['status'=>1,'msg'=>'商家没有开启活动设置'];
                    }
                }
            }
        }

        return $data;*/
    }

    /**
     * 加价购信息 需修改Zhenzh
     *
     * @param $goods_id
     * @return array
     */
    public function getIncreaseDetailByGoodsId($goods_id)
    {
        $renew_row    = array();
        if (Web_ConfigModel::value('promotion_allow')) //商品促销开启，包括限时折扣，满送，加价购
        {
            $cond_row['goods_id'] = $goods_id;
            $cond_row['goods_start_time:<='] = get_date_time();
            $cond_row['goods_end_time:>='] = get_date_time();
            $increase_goods_row   = $this->Increase_GoodsModel->getOneIncreaseGoodsByWhere($cond_row);
            if ($increase_goods_row)
            {
                $renew_row = $this->Increase_BaseModel->getIncreaseActDetail($increase_goods_row['increase_id']);
            }
        }

        return $renew_row;
    }

    /**
     * 根据common_id取消商品参加活动的状态 0没参加 1惠抢购 2限时折扣 3手机专享 4新人优惠
     * 取消前判断spu内是否有其他sku的活动状态是正常的
     *
     * @param $common_id
     * @param $type
     * @return bool
     */
    public function cancelCommonPromotion($common_id,$type)
    {
        $cond_row['common_id'] = $common_id;

        if($type == Goods_CommonModel::HUIQIANGGOU)
        {
            //惠抢购
            $promotionModel = new ScareBuy_BaseModel();
            $cond_row['scarebuy_state']   = ScareBuy_BaseModel::NORMAL;
            $cond_row['scarebuy_percent:<'] = ScareBuy_BaseModel::LOOTALL;
            $cond_row['scarebuy_endtime:>'] = get_date_time();
        }
        else if($type == Goods_CommonModel::XIANSHI)
        {
            //限时折扣
            $promotionModel = new Discount_GoodsModel();
            $cond_row['discount_goods_state'] = Discount_GoodsModel::NORMAL;
            $cond_row['goods_end_time:>']     = get_date_time();
        }
        else if($type == Goods_CommonModel::SHOUJI)
        {
            //手机专享
            $promotionModel = new Price_BaseModel();
            $cond_row['price_state'] = Price_BaseModel::NORMAL;
        }
        else if($type == Goods_CommonModel::XINREN)
        {
            //新人优惠
            $promotionModel = new NewBuyer_BaseModel();
            $cond_row['newbuyer_state']   = NewBuyer_BaseModel::NORMAL;
            $cond_row['newbuyer_endtime:>'] = get_date_time();
        }
        else if($type == Goods_CommonModel::FU)
        {
            //送福免单
            $promotionModel = new Fu_BaseModel();
            $cond_row['fu_state']   = Fu_BaseModel::NORMAL;
        }

        $count = $promotionModel->getRowCount($cond_row);

        $edit_flag = true;
        if($count < 1)
        {
            $goodsCommonModel = new Goods_CommonModel();
            $common_id = $goodsCommonModel->getKeyByWhere(array('common_id'=>$common_id,'common_promotion_type'=>$type));
            if($common_id)
            {
                $edit_flag = $goodsCommonModel->editCommon($common_id,array('common_promotion_type'=>Goods_CommonModel::NOPROMOTION));
            }
        }
        return $edit_flag;
    }

    /**
     * 获取商品的活动信息 Zhenzh 20171024
     *
     * @param $goods_id  商品goods_id
     * @param $common_id 商品common_id
     * @param int $type  商品参加活动的类型0没参加 1惠抢购 2限时折扣 3手机专享 4新人优惠
     * @return array
     */
    public function getGoodsPromotion($goods_id,$common_id,$type = 0)
    {
        if(!$goods_id)
        {
            return null;
        }

        $data = array();
        if($type > 0)
        {
            $edit_flag = false;

            if($type == Goods_CommonModel::HUIQIANGGOU)
            {
                //惠抢购
                $promotion_data = $this->getScareBuyInfoByGoodsId($goods_id);
                if($promotion_data)
                {
                    $data['promotion']['promotion_type']      = $type;
                    $data['promotion']['promotion_type_con']  = '惠抢购';
                    $data['promotion']['promotion_tips']      = Web_ConfigModel::value('scarebuy_tips');
                    $data['promotion']['promotion_id']        = $promotion_data['scarebuy_id'];
                    $data['promotion']['title']               = $promotion_data['scarebuy_name'];
                    $data['promotion']['remark']              = $promotion_data['scarebuy_remark'];
                    $data['promotion']['promotion_price']     = $promotion_data['scarebuy_price'];
                    $data['promotion']['upper_limit']         = $promotion_data['scarebuy_upper_limit'];
                    $data['promotion']['scarebuy_starttime']  = $promotion_data['scarebuy_starttime'];
                    $data['promotion']['scarebuy_endtime']    = $promotion_data['scarebuy_endtime'];
                    $data['promotion']['scarebuy_count']      = $promotion_data['scarebuy_count'];
                    $data['promotion']['is_mian']             = $promotion_data['is_mian'];
                    $data['promotion']['is_man']              = $promotion_data['is_man'];
                    $data['promotion']['is_voucher']          = $promotion_data['is_voucher'];
                    $data['promotion']['is_jia']              = $promotion_data['is_jia'];
                }
                else
                {
                    $edit_flag = true;
                }
            }
            else if($type == Goods_CommonModel::XIANSHI)
            {
                //限时折扣
                $promotion_data = $this->getDiscountGoodsInfoByGoodsID($goods_id);
                if($promotion_data)
                {
                    $data['promotion']['promotion_type']     = $type;
                    $data['promotion']['promotion_type_con'] = '限时折扣';
                    $data['promotion']['promotion_tips']     = Web_ConfigModel::value('discount_tips');
                    $data['promotion']['promotion_id']       = $promotion_data['discount_goods_id'];
                    $data['promotion']['title']              = $promotion_data['discount_name'];
                    $data['promotion']['remark']             = $promotion_data['discount_title'];
                    $data['promotion']['promotion_price']    = $promotion_data['discount_price'];
                    $data['promotion']['lower_limit']        = $promotion_data['goods_lower_limit'];
                    $data['promotion']['explain']            = $promotion_data['discount_explain'];
                    $data['promotion']['discount_rate']      = $promotion_data['discount_rate'];
                }
                else
                {
                    $edit_flag = true;
                }
            }
            else if($type == Goods_CommonModel::SHOUJI)
            {
                //手机专享
                $promotion_data = $this->getPriceBaseInfoByGoodsID($goods_id);
                if($promotion_data)
                {
                    $data['promotion']['promotion_type']     = $type;
                    $data['promotion']['promotion_type_con'] = '手机专享';
                    $data['promotion']['promotion_id']       = $promotion_data['price_id'];
                    $data['promotion']['promotion_price']    = $promotion_data['zx_price'];
                }
                else
                {
                    $edit_flag = true;
                }
            }
            else if($type == Goods_CommonModel::XINREN)
            {
                //新人优惠
                $promotion_data = $this->getNewBuyerInfoByGoodsId($goods_id);
                if($promotion_data != 250)
                {
                    if($promotion_data)
                    {
                        $data['promotion']['promotion_type']     = $type;
                        $data['promotion']['promotion_type_con'] = '新人优惠';
                        $data['promotion']['promotion_tips']     = Web_ConfigModel::value('newbuyer_tips');
                        $data['promotion']['promotion_id']       = $promotion_data['newbuyer_id'];
                        $data['promotion']['title']              = $promotion_data['newbuyer_name'];
                        $data['promotion']['promotion_price']    = $promotion_data['newbuyer_price'];
                        $data['promotion']['upper_limit']        = $promotion_data['newbuyer_upper_limit'];
                        $data['promotion']['is_mian']            = $promotion_data['is_mian'];
                        $data['promotion']['is_man']             = $promotion_data['is_man'];
                        $data['promotion']['is_voucher']         = $promotion_data['is_voucher'];
                        $data['promotion']['is_jia']             = $promotion_data['is_jia'];
                        $data['promotion']['free_freight']       = $promotion_data['free_freight'];
                    }
                    else
                    {
                        $edit_flag = true;
                    }
                }
            }
            else if($type == Goods_CommonModel::FU)
            {
                //送福免单
                $promotion_data = $this->getFuByGoodsId($goods_id);

                if($promotion_data)
                {
                    if ($promotion_data['status'] == 0)
                    {
                        $data['promotion']['promotion_type']     = $type;
                        $data['promotion']['promotion_type_con'] = '送福免单';
                        $data['promotion']['promotion_id']       = $promotion_data['fu_id'];
                        $data['promotion']['title']              = $promotion_data['fu_name'];
                        $data['promotion']['promotion_price']    = 0;
                        $data['promotion']['is_mian']            = $promotion_data['is_mian'];
                        $data['promotion']['is_man']             = $promotion_data['is_man'];
                        $data['promotion']['is_voucher']         = $promotion_data['is_voucher'];
                        $data['promotion']['is_jia']             = $promotion_data['is_jia'];
                        $data['promotion']['fu_base']            = $promotion_data['fu_base'];
                        $data['promotion']['fu_total_times']     = $promotion_data['fu_total_times'];
                        $data['promotion']['fu_price']           = $promotion_data['fu_price'];
                        $data['promotion']['fu_t_price']         = $promotion_data['fu_t_price'];
                        $data['promotion']['is_register']        = $promotion_data['is_register'];
                        $data['promotion']['fu_order_flag']      = 0;
                    }
                }
                else
                {
                    $edit_flag = true;
                }
            }

            if($edit_flag && $common_id)
            {
                //common_promotion_type > 0 但活动为空 此处要清理 common_promotion_type
                //可在取活动的时候分别处理
                $this->cancelCommonPromotion($common_id,$type);
            }
        }

        return $data;
    }

    /**
     * 根据common_id和type(common_promotion_type 活动类型) 获取所有参加活动的goods_base
     *
     * @param $common_id common_id
     * @param int $type  活动类型 common_promotion_type
     * @return array
     */
    public function getGoodsPromotionByBid($common_id,$type = 0)
    {
        $data = array();

        if($type > 0)
        {
            if($type == Goods_CommonModel::HUIQIANGGOU)
            {
                //惠抢购
                $scarebuy_rows = $this->ScareBuy_BaseModel->getByWhere(array('common_id'=>$common_id));
                if($scarebuy_rows)
                {
                    foreach ($scarebuy_rows as $key=>$value)
                    {
                        $data[$value['goods_id']]['promotion_type']      = $type;
                        $data[$value['goods_id']]['promotion_type_con']  = '惠抢购';
                        $data[$value['goods_id']]['promotion_price']     = $value['scarebuy_price'];

                        if($value['scarebuy_state'] != ScareBuy_BaseModel::NORMAL || $value['scarebuy_endtime'] < get_date_time())
                        {
                            $data[$value['goods_id']]['promotion_state'] = self::OVER;
                        }
                        else if($value['scarebuy_starttime'] > get_date_time())
                        {
                            $data[$value['goods_id']]['promotion_state'] = self::NOTSTART;
                        }
                        else
                        {
                            $data[$value['goods_id']]['promotion_state'] = self::START;
                        }
                    }
                }
            }
            else if($type == Goods_CommonModel::XIANSHI)
            {
                //限时折扣
                $discount_goods_rows = $this->Discount_GoodsModel->getByWhere(array('common_id'=>$common_id));
                if($discount_goods_rows)
                {
                    foreach ($discount_goods_rows as $key => $value)
                    {
                        $data[$value['goods_id']]['promotion_type']  = $type;
                        $data[$value['goods_id']]['promotion_type_con']  = '限时折扣';
                        $data[$value['goods_id']]['promotion_price'] = $value['discount_price'];
                        if($value['discount_goods_state'] != Discount_GoodsModel::NORMAL || $value['goods_end_time'] < get_date_time())
                        {
                            $data[$value['goods_id']]['promotion_state'] = self::OVER;
                        }
                        else if($value['goods_start_time'] > get_date_time())
                        {
                            $data[$value['goods_id']]['promotion_state'] = self::NOTSTART;
                        }
                        else
                        {
                            $data[$value['goods_id']]['promotion_state'] = self::START;
                        }
                    }
                }
            }
            else if($type == Goods_CommonModel::SHOUJI)
            {
                //手机专享
                $price_rows = $this->Price_BaseModel->getByWhere(array('common_id'=>$common_id));
                if($price_rows)
                {
                    foreach ($price_rows as $key=>$value)
                    {
                        $data[$value['goods_id']]['promotion_type']  = $type;
                        $data[$value['goods_id']]['promotion_type_con']  = '手机专享';
                        $data[$value['goods_id']]['promotion_price'] = $value['zx_price'];
                        $data[$value['goods_id']]['promotion_state'] = self::START;
                    }
                }
            }
            else if($type == Goods_CommonModel::XINREN)
            {
                //新人优惠
                $newbuyer_rows = $this->NewBuyer_BaseModel->getByWhere(array('common_id'=>$common_id));
                if($newbuyer_rows)
                {
                    foreach ($newbuyer_rows as $key=>$value)
                    {
                        $data[$value['goods_id']]['promotion_type']     = $type;
                        $data[$value['goods_id']]['promotion_type_con'] = '新人优惠';
                        $data[$value['goods_id']]['promotion_price']    = $value['newbuyer_price'];

                        if($value['newbuyer_state'] != NewBuyer_BaseModel::NORMAL || $value['newbuyer_endtime'] < get_date_time())
                        {
                            $data[$value['goods_id']]['promotion_state'] = self::OVER;
                        }
                        else if($value['newbuyer_starttime'] > get_date_time())
                        {
                            $data[$value['goods_id']]['promotion_state'] = self::NOTSTART;
                        }
                        else
                        {
                            $data[$value['goods_id']]['promotion_state'] = self::START;
                        }
                    }
                }
            }
            else if($type == Goods_CommonModel::FU)
            {
                //送福免单
                $fu_rows = $this->FuBaseModel->getByWhere(['common_id'=>$common_id]);
                foreach ($fu_rows as $key=>$value)
                {
                    $data[$value['goods_id']]['promotion_type']     = $type;
                    $data[$value['goods_id']]['promotion_type_con'] = '送福免单';
                    $data[$value['goods_id']]['promotion_price']    = 0;

                    if($value['fu_state'] == Fu_BaseModel::NORMAL && $value['fu_stock'] > 0)
                    {
                        $data[$value['goods_id']]['promotion_state'] = self::START;
                    }
                    else
                    {
                        $data[$value['goods_id']]['promotion_state'] = self::OVER;
                    }
                }
            }
        }

        return $data;
    }

    public function editPromotionStateEnd($promotion_id,$goods_id,$type = 0)
    {
        if($promotion_id && $goods_id && $type)
        {
            $edit_cond['goods_id'] = $goods_id;
            if($type == Goods_CommonModel::HUIQIANGGOU)
            {
                $edit_cond['scarebuy_state'] = ScareBuy_BaseModel::FINISHED;
                $this->ScareBuy_BaseModel->editScareBuy($promotion_id,$edit_cond);
            }
            else if($type == Goods_CommonModel::XIANSHI)
            {
                $edit_cond['discount_goods_state'] = Discount_GoodsModel::CANCEL;
                $this->Discount_GoodsModel->editDiscountGoods($promotion_id,$edit_cond);
            }
            else if($type == Goods_CommonModel::SHOUJI)
            {
                $edit_cond['price_state'] = Price_BaseModel::CANCEL;
                $this->Price_BaseModel->editPriceActInfo($promotion_id,$edit_cond);
            }
            else if($type == Goods_CommonModel::XINREN)
            {
                $edit_cond['newbuyer_state'] = NewBuyer_BaseModel::CANCEL;
                $this->NewBuyer_BaseModel->editNewBuyer($promotion_id,$edit_cond);
            }
        }
    }

}

?>