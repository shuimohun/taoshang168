<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class CartModel extends Cart
{
    /**
     * 读取分页列表
     *
     * @param array $cond_row
     * @param array $order_row
     * @param int $page
     * @param int $rows
     * @return array
     */
	public function getCatGoodsList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
		return $this->listByWhere($cond_row, $order_row, $page, $rows);
	}

    /**
     * 购物车数据
     *
     * @param array $cond_row
     * @param array $order_row
     * @param null $receiver_phone 收货人电话 判断收货人是否已经享受过新人
     * @return array
     */
	public function getCardList($cond_row = array(), $order_row = array(),$receiver_phone = null)
	{
        $goodsBaseModel     = new Goods_BaseModel();
        $promotion          = new Promotion();
        $Order_GoodsModel   = new Order_GoodsModel();
        $Goods_CatModel     = new Goods_CatModel();
        $shareBaseModel     = new Share_BaseModel();
        $FuRecordModel      = new Fu_RecordModel();
        $bundlingBaseModel  = new Bundling_BaseModel();
        $shopBaseModel      = new Shop_BaseModel();
        $Voucher_BaseModel  = new Voucher_BaseModel();
        $Shop_ClassBindModel = new Shop_ClassBindModel();

		$cart_row = $this->getByWhere($cond_row, $order_row);

		//定义一个新数组 盛放店铺新人订单数
        $newbuyer_order_row = array();
        if($cart_row)
        {
            //取出所有店铺id
            $shop_id_row = array_column($cart_row,'shop_id');
            $shop_id_row = array_unique($shop_id_row);

            //获取店铺信息
            $shop_base_row = $shopBaseModel->get($shop_id_row);

            //判断店铺状态
            foreach ($shop_base_row as $key=>$value)
            {
                if($value['shop_status'] != Shop_BaseModel::SHOP_STATUS_OPEN)
                {
                    $off_shop_row[] = $value['shop_id'];
                }
            }

            //判断收货人是否已经享受过新人
            if($receiver_phone)
            {
                $OrderBaseModel = new Order_BaseModel();
                $count_cond['order_receiver_contact:LIKE'] = '%'.trim($receiver_phone).'%';
                $count_cond['is_newbuyer'] = 1;
                $count_cond['order_status:<'] = Order_StateModel::ORDER_CANCEL;
                $count_cond['shop_id:IN'] = $shop_id_row;
                $newbuyer_row_count = $OrderBaseModel->select('shop_id,COUNT(*) count',$count_cond,'shop_id');
                if($newbuyer_row_count)
                {
                    foreach ($newbuyer_row_count as $key => $value)
                    {
                        $newbuyer_order_row[$value['shop_id']] = $value['count'];
                    }
                }
            }
        }
        else
        {
            //购物车为空
            return null;
        }

        $data = array();
        /*循环购物车 start*/
        $newbuyer_row = array();
        $remove_cart_id_row = array();
		foreach ($cart_row as $key => $val)
		{
		    if($off_shop_row && in_array($val['shop_id'],$off_shop_row))
            {
                //店铺已关闭 删除购物车内的商品 Zhenzh 20180411
                $remove_cart_id_row[] = $key;
                continue;
            }

            if($val['goods_num'] <= 0)
            {
                $remove_cart_id_row[] = $key;
                continue;
            }

            if ($val['bl_id'])
            {
                //套餐 Start
                $bundling_info = $bundlingBaseModel ->getBundlingDetailInfo(array('bundling_id'=>$val['bl_id'],'bundling_state'=>Bundling_GoodsModel::NORMAL));
                if($bundling_info)
                {
                    $val['buy_limit'] = $bundling_info['bunlding_limit'];
                    $val['buy_residue'] = $val['goods_stock'] = $bundling_info['goods_stock'];

                    /*判断是否达到购买上限 start*/
                    $IsHaveBuy = 0;//是否已达购买上限
                    if($val['buy_limit'])
                    {
                        $val['order_goods_count'] = $Order_GoodsModel->getUserBuyCountByBId($val['bl_id']);
                        if($val['order_goods_count'] >= $val['buy_limit'])
                        {
                            $IsHaveBuy = 1;
                            //已达购买上限 不应该出现在购物车里 故删除购物车里的该商品
                            $remove_cart_id_row[] = $key;
                            continue;
                        }
                        else
                        {
                            //还可以购买数量
                            $val['buy_residue'] = $val['buy_limit'] - $val['order_goods_count'];
                        }
                        $val['IsHaveBuy'] = $IsHaveBuy;//是否达到购买上限
                    }

                    //如果购物车里的数量>还可以购买量 更改购物车里的数量为还可以购买数量
                    if($val['goods_num'] > $val['buy_residue'])
                    {
                        $val['goods_num'] = $val['buy_residue'];
                        //$this->editCart($val['cart_id'],array('goods_num'=>$val['goods_num']),false);
                    }
                    /*判断是否达到购买上限 end*/

                    /*分享立减 start*/
                    $share_num = 0;
                    if($bundling_info['share_info'])
                    {
                        //分享立减优惠上限
                        $val['share_limit'] = $bundling_info['share_info']['share_limit'];
                        if($bundling_info['share_info']['price']['share_order_id'] == '0' && $bundling_info['share_info']['price']['price'] > 0)
                        {
                            $val['share_price_id'] = $bundling_info['share_info']['price']['id'];//分享id赋值 提交订单的时候要用
                            $val['share_price'] = $bundling_info['share_info']['price']['price'];
                            $share_num = $val['goods_num'];
                            if($val['share_limit'] < $val['goods_num'])
                            {
                                $share_num = $val['share_limit'];
                            }
                        }
                    }
                    /*分享立减 end*/
                    $sumprice = $val['goods_num'] * $bundling_info['bundling_discount_price'];
                    if($share_num)
                    {
                        $sumprice -= $share_num*$bundling_info['share_info']['price']['price'];
                    }
                    $price = number_format($sumprice/$val['goods_num'],'2','.','');

                    $val['old_price']  = $bundling_info['old_total_price'];
                    $val['now_price']  = $bundling_info['bundling_discount_price'];
                    $val['down_price'] = $bundling_info['old_total_price'] - $bundling_info['bundling_discount_price'];
                    if($price < $bundling_info['bundling_discount_price'])
                    {
                        $val['now_price']  = $price;
                        $val['down_price'] = bcsub($val['old_price'], $val['now_price'],2);
                    }

                    //套餐总价格
                    $val['sumprice'] = number_format($val['now_price'] * $val['goods_num'], 2, '.', '');

                    if(!$bundling_info['bundling_freight_choose'])
                    {
                        $val['bundling_cost'] += $bundling_info['bundling_freight'];
                    }
                    $val['bundling_info'] = $bundling_info;
                }
                else
                {
                    //套装已过期或不存在
                    $remove_cart_id_row[] = $key;
                    continue;
                }
                //套餐 End
            }
            else
            {
                //获取商品信息
                $goods = $goodsBaseModel->getGoodsInfo($val['goods_id']);

                if($goods)
                {
                    $goods_base = $goods['goods_base'];
                    $goods_common = $goods['goods_common'];

                    $val['transport_type_id'] = $goods_common['transport_type_id']; //商品的售卖区域
                    $val['buy_able']          = 1;
                    $val['cubage']            = $goods_common['common_cubage'];     //商品重量
                    $val['buy_limit']         = $goods_common['common_limit'];
                    $val['buy_residue']       = $goods_base['goods_stock'];         //最大购买量

                    /*判断是否达到购买上限 start*/
                    $IsHaveBuy = 0;//是否已达购买上限
                    if ($val['buy_limit'] )//是否限购
                    {
                        //查询该用户是否已购买过该商品
                        $val['order_goods_count'] = $Order_GoodsModel->getUserBuyCountByCId($goods_base['common_id']);
                        if($val['order_goods_count'] >= $val['buy_limit'])
                        {
                            $IsHaveBuy = 1;
                            //已达购买上限 不应该出现在购物车里 故删除购物车里的该商品
                            $remove_cart_id_row[] = $key;
                            continue;
                        }
                        else
                        {
                            //还可以购买数量
                            $val['buy_residue'] = $val['buy_limit'] - $val['order_goods_count'];
                        }
                        $val['IsHaveBuy'] = $IsHaveBuy;
                    }

                    //如果购物车里的数量>还可以购买量 更改购物车里的数量为还可以购买数量
                    if($val['goods_num'] > $val['buy_residue'])
                    {
                        $val['goods_num'] = $val['buy_residue'];
                    }

                    if ($goods_base['promotion'] && $goods_base['promotion']['lower_limit'])
                    {
                        $val['lower_limit'] = $goods_base['promotion']['lower_limit'];

                        //库存 < 最低购买数
                        if ($val['buy_residue'] < $val['lower_limit'])
                        {
                            $val['IsHaveBuy'] = 1;
                            $remove_cart_id_row[] = $key;
                            continue;
                        }
                        else
                        {
                            if($val['goods_num'] < $val['lower_limit'])
                            {
                                $val['goods_num'] = $val['lower_limit'];
                            }
                        }
                    }

                    /*判断是否达到购买上限 end*/

                    if(isset($goods_base['promotion']) && $goods_base['promotion']['promotion_type'] == Goods_CommonModel::XINREN)
                    {
                        if($newbuyer_order_row[$val['shop_id']])
                        {
                            unset($goods_base['promotion']);
                        }
                        else
                        {
                            if(isset($newbuyer_row[$val['shop_id']]))
                            {
                                $newbuyer_row[$val['shop_id']]++;
                                unset($goods_base['promotion']);
                            }
                            else
                            {
                                $newbuyer_row[$val['shop_id']] = 1;
                            }
                        }
                    }

                    /*计算活动优惠上限 start*/
                    $promotion_num = $val['goods_num'];
                    if(!$IsHaveBuy && isset($goods_base['promotion']))
                    {
                        if ($goods_base['promotion']['upper_limit'])
                        {
                            if($val['order_goods_count'] < $goods_base['promotion']['upper_limit'])
                            {
                                $num = $goods_base['promotion']['upper_limit'] -  $val['order_goods_count'];
                                if($num < $promotion_num)
                                {
                                    $promotion_num = $num;
                                }
                            }
                            else
                            {
                                //已达优惠上限
                                unset($goods_base['promotion']);
                            }
                        }
                    }
                    /*计算活动优惠上限 end*/

                    /*计算优惠下限 start*/
                    if(isset($goods_base['promotion']) && isset($goods_base['promotion']['lower_limit']))
                    {
                        if($val['goods_num'] < $goods_base['promotion']['lower_limit'])
                        {
                            //unset($goods_base['promotion']);
                            $goods_base['promotion']['promotion_price'] = $goods_base['goods_price'];
                        }
                    }
                    /*计算优惠下限 end*/

                    $sumprice = $goods_base['goods_price'] * $val['goods_num'];
                    /*分享立减 送福免单 计算总额 start*/
                    $share_num = 0;
                    //是否是送福免单
                    if(isset($goods_base['promotion']) && $goods_base['promotion']['promotion_type'] == Goods_CommonModel::FU)
                    {
                        $val['buy_residue'] = 1;//设定最多购买一件
                        $val['goods_num'] = 1;

                        $fu_record_row['goods_id'] = $goods_base['goods_id'];
                        $fu_record_row['user_id'] = Perm::$userId;
                        $fu_record_row['status:<='] = Fu_RecordModel::DONE;
                        $fu_record_row['fu_end_time:>'] = get_date_time();

                        $fu_record = $FuRecordModel->getOneByWhere($fu_record_row,['fu_record_time'=>'desc']);

                        if($fu_record)
                        {
                            $goods_base['promotion']['promotion_r_id'] = $fu_record['fu_record_id'];
                            if($fu_record['status'] == Fu_RecordModel::DONE)
                            {
                                $sumprice = 0;
                                $val['fu_done_flag'] = 1;//完成标识 后面计算运费要用
                            }
                            else
                            {
                                $sumprice = ($goods_base['goods_price'] - $fu_record['click_count'] * $fu_record['unit_price']) * $val['goods_num'];
                            }
                        }
                    }
                    else
                    {
                        $share_info = $shareBaseModel->getShareByCommonId($goods_base['common_id']);
                        if($share_info)
                        {
                            //分享立减优惠上限
                            $val['share_limit'] = $share_info['share_limit'];
                            if($share_info['price']['share_order_id'] == '0' && $share_info['price']['price'] > 0)
                            {
                                $val['share_price_id'] = $share_info['price']['id'];//分享id赋值 提交订单的时候要用
                                $val['share_price'] = $share_info['price']['price'];
                                $share_num = $val['goods_num'];
                                if($val['share_limit'] < $val['goods_num'])
                                {
                                    $share_num = $val['share_limit'];
                                }
                            }
                        }

                        if(isset($goods_base['promotion']) && $promotion_num)
                        {
                            $sumprice -= ($goods_base['goods_price'] - $goods_base['promotion']['promotion_price']) * $promotion_num;
                        }
                        if($share_num)
                        {
                            $sumprice -= $share_num * $share_info['price']['price'];
                        }
                    }
                    /*分享立减 送福免单 计算总额 end*/

                    /*计算价格 start*/
                    $price = number_format($sumprice/$val['goods_num'],'2','.','');

                    $val['old_price']  = 0;
                    $val['now_price']  = $goods_base['goods_price'];
                    $val['down_price'] = 0.00;
                    if($price < $goods_base['goods_price'])
                    {
                        $val['old_price']  = $goods_base['goods_price'];
                        $val['now_price']  = $price;
                        $val['down_price'] = bcsub($goods_base['goods_price'] , $price,2);
                    }

                    //商品总价格
                    $val['sumprice'] = number_format($val['now_price'] * $val['goods_num'], 2, '.', '');
                    //商品参加活动商品 但不叠加免邮 计算得出其他合计 后面判断免邮时用nsprice
                    $val['mian_sprice'] = $val['man_sprice'] = $val['voucher_sprice'] = $val['jia_sprice'] = $val['sumprice'];
                    if(isset($goods_base['promotion']))
                    {
                        //包邮
                        if(isset($goods_base['promotion']['free_freight']) && $goods_base['promotion']['free_freight'])
                        {
                            $val['free_freight'] = 1;
                        }
                        //免邮额度
                        if(isset($goods_base['promotion']['is_mian']) && !$goods_base['promotion']['is_mian'])
                        {
                            $val['mian_sprice'] = 0;
                        }
                        //满送
                        if(isset($goods_base['promotion']['is_man']) && !$goods_base['promotion']['is_man'])
                        {
                            $val['man_sprice'] = 0;
                        }
                        //代金券
                        if(isset($goods_base['promotion']['is_voucher']) && !$goods_base['promotion']['is_voucher'])
                        {
                            $val['voucher_sprice'] = 0;
                        }
                        //加价购
                        if(isset($goods_base['promotion']['is_jia']) && !$goods_base['promotion']['is_jia'])
                        {
                            $val['jia_sprice'] = 0;
                        }
                    }
                    /*计算价格 end*/

                    //如果是分销商购买的供货商的商品，计算折扣
                    if(Web_ConfigModel::value('Plugin_Distribution') && Perm::$shopId)
                    {
                        $shopDistributorModel = new Distribution_ShopDistributorModel();
                        $shopDistributorLevelModel = new Distribution_ShopDistributorLevelModel();

                        //所有供货商，用于对商品操作的判断
                        $suppliers = $shopDistributorModel->getByWhere(array('distributor_id' =>Perm::$shopId));
                        $suppliers  = array_column($suppliers,'shop_id');

                        //查看折扣，改变对应供销商商品显示的价格
                        $shopDistributorInfo     =  $shopDistributorModel->getOneByWhere(array('shop_id' =>$val['shop_id'],'distributor_id'=>Perm::$shopId));
                        if(!empty($shopDistributorInfo) && $shopDistributorInfo['distributor_enable'] == 1)
                        {
                            $distritutor_rate_info     = $shopDistributorLevelModel->getOne($shopDistributorInfo['distributor_level_id']);
                            if(!empty($distritutor_rate_info) && $distritutor_rate_info['distributor_leve_discount_rate'])
                            {
                                $val['now_price'] = $val['now_price'] * $distritutor_rate_info['distributor_leve_discount_rate'] / 100;
                                $distritutor_rate = $val['sumprice'] - number_format($val['now_price'] * $val['goods_num'], 2, '.', '');
                                $val['sumprice'] -= $distritutor_rate;
                                $val['rate_price']  = $distritutor_rate;
                            }
                        }
                    }

                    //该商品的交易佣金计算
                    $goods_cat = $Shop_ClassBindModel->getByWhere(array('shop_id'=>$val['shop_id'],'product_class_id'=>$goods_base['cat_id']));
                    if($goods_cat)
                    {
                        $goods_cat = current($goods_cat);
                        $cat_commission = $goods_cat['commission_rate'];
                    }
                    else
                    {
                        $goods_cat = $Goods_CatModel->getOne($goods_base['cat_id']);
                        if ($goods_cat)
                        {
                            $cat_commission = $goods_cat['cat_commission'];
                        }
                        else
                        {
                            $cat_commission = 0;
                        }
                    }

                    $val['cat_commission'] = $cat_commission;
                    $val['commission'] = number_format(($val['sumprice'] * $cat_commission / 100), 2, '.', '');

                    //淘金开启，并且参与淘金
                    if(Web_ConfigModel::value('Plugin_Directseller')&&$goods_common['common_is_directseller'])
                    {
                        $directseller_commission = 0;

                        $val['directseller_flag']         = $goods_common['common_is_directseller'];
                        $val['directseller_commission_0'] = number_format(($val['sumprice']*$goods_common['common_cps_rate']/100), 2, '.', '');  //一级分佣
                        $val['directseller_commission_1'] = number_format(($val['sumprice']*$goods_common['common_second_cps_rate']/100), 2, '.', ''); //二级分佣
                        $val['directseller_commission_2'] = number_format(($val['sumprice']*$goods_common['common_third_cps_rate']/100), 2, '.', ''); //三级分佣

                        $directseller_commission += $val['directseller_commission_0'] + $val['directseller_commission_1'] + $val['directseller_commission_2'];
                    }
                    $val['product_is_behalf_delivery'] = $goods_common['product_is_behalf_delivery'];
                    $val['supply_shop_id'] = $goods_common['supply_shop_id'];
                    $val['goods_base'] = $goods_base;
                }
                else
                {
                    //商品已失效 已删除或下架
                    $remove_cart_id_row[] = $key;
                    continue;
                }
            }

			if (!array_key_exists($val['shop_id'], $data))
			{
			    if(array_key_exists($val['shop_id'],$shop_base_row))
                {
                    //获取店铺信息
                    //$shop_base = $shopBaseModel->getOne($val['shop_id']);
                    $shop_base = $shop_base_row[$val['shop_id']];

                    $data[$val['shop_id']]['shop_id']            = $shop_base['shop_id'];
                    $data[$val['shop_id']]['shop_name']          = $shop_base['shop_name'];
                    $data[$val['shop_id']]['shop_user_id']       = $shop_base['user_id'];
                    $data[$val['shop_id']]['shop_user_name']     = $shop_base['user_name'];
                    $data[$val['shop_id']]['district_id']        = $shop_base['district_id'];
                    $data[$val['shop_id']]['shop_self_support']  = $shop_base['shop_self_support'];
                    $data[$val['shop_id']]['shop_free_shipping'] = $shop_base['shop_free_shipping'];
                    $data[$val['shop_id']]['shop_class_id']      = $shop_base['shop_class_id'];

                    $data[$val['shop_id']]['goods'][]            = $val;
                }
                else
                {
                    //店铺不存在
                }
            }
			else
			{
				$data[$val['shop_id']]['goods'][] = $val;
			}

			if (isset($data[$val['shop_id']]['sprice']))
			{
				//店铺总价
				$data[$val['shop_id']]['sprice'] = str_replace(',', '', $data[$val['shop_id']]['sprice']) * 1;
				$val['sumprice']                 = str_replace(',', '', $val['sumprice']) * 1;

				$data[$val['shop_id']]['sprice']         += $val['sumprice'];
                $data[$val['shop_id']]['mian_sprice']    += $val['mian_sprice'];
                $data[$val['shop_id']]['man_sprice']     += $val['man_sprice'];
                $data[$val['shop_id']]['voucher_sprice'] += $val['voucher_sprice'];
                $data[$val['shop_id']]['jia_sprice']     += $val['jia_sprice'];

                //如果有套装运费
                if($val['bundling_cost'])
                {
                    $data[$val['shop_id']]['bundling_total_cost']  += $val['bundling_cost'];
                }

				//店铺佣金
				$data[$val['shop_id']]['commission'] = str_replace(',', '', $data[$val['shop_id']]['commission']) * 1;
				$val['commission']                   = str_replace(',', '', $val['commission']) * 1;
				$data[$val['shop_id']]['commission'] += $val['commission'];
			}
			else
			{
				$data[$val['shop_id']]['sprice']         = $val['sumprice'];
                $data[$val['shop_id']]['mian_sprice']    = $val['mian_sprice'];
                $data[$val['shop_id']]['man_sprice']     = $val['man_sprice'];
                $data[$val['shop_id']]['voucher_sprice'] = $val['voucher_sprice'];
                $data[$val['shop_id']]['jia_sprice']     = $val['jia_sprice'];

                //如果有套装运费
                if($val['bundling_cost'])
                {
                    $data[$val['shop_id']]['bundling_total_cost']  = $val['bundling_cost'];
                }

                //店铺佣金
				$data[$val['shop_id']]['commission']  = $val['commission'];
			}
			
			//分销商折扣
			if(isset($distritutor_rate))
			{
				if(isset($data[$val['shop_id']]['distributor_rate']))
				{
					$data[$val['shop_id']]['distributor_rate']  += $distritutor_rate;
				}
				else
                {
					$data[$val['shop_id']]['distributor_rate'] = 0;
					$data[$val['shop_id']]['distributor_rate']  += $distritutor_rate;
				}	
			}
			
			$data[$val['shop_id']]['sprice']     = number_format($data[$val['shop_id']]['sprice'] * 1, 2, '.', '');
			$data[$val['shop_id']]['commission'] = number_format($data[$val['shop_id']]['commission'] * 1, 2, '.', '');
		}
        /*循环购物车 end*/

        //是否有待删除的购物车商品
        if($remove_cart_id_row)
        {
            $this->removeCart($remove_cart_id_row);
        }

		foreach ($data as $key => $val)
		{
			//店铺满送活动
            if($val['man_sprice'])
            {
                //$mansong_info = $Promotion->getShopOrderGift($val['shop_id'], $val['sprice']);
                $mansong_info = $promotion->getShopOrderGift($val['shop_id'], $val['man_sprice']);

                if ($mansong_info)
                {
                    if ($mansong_info['goods_id'])
                    {
                        $goods = $goodsBaseModel->checkGoods($mansong_info['goods_id']);
                        if (!$goods)
                        {
                            unset($mansong_info['goods_id']);
                        }
                        else
                        {
                            $mansong_info['common_id']   = $goods['goods_base']['common_id'];
                            $mansong_info['goods_name']  = $goods['goods_base']['goods_name'];
                            $mansong_info['goods_price'] = $goods['goods_base']['goods_price'];
                            $mansong_info['goods_image'] = $goods['goods_base']['goods_image'];
                            $mansong_info['spec']    = $goods['goods_base']['spec'];
                            $mansong_info['spec_str']    = $goods['goods_base']['spec_str'];
                        }
                    }

                    $data[$val['shop_id']]['mansong_info'] = $mansong_info;
                }
            }

			//加价购
            if($val['jia_sprice'])
            {
                $increase_info = $promotion->getOrderIncreaseInfo($val);
                if($increase_info)
                {
                    //去除加价购商品中没有库存和不存在的商品，若是改活动下没有有效商品则去除该活动
                    foreach ($increase_info as $inckey => $incval)
                    {
                        if (!empty($incval['exc_goods']))
                        {
                            foreach ($incval['exc_goods'] as $excgkey => $excgval)
                            {
                                $goods = $goodsBaseModel->checkGoods($excgval['goods_id']);
                                if (!$goods)
                                {
                                    unset($incval['exc_goods'][$excgkey]);
                                    unset($increase_info[$inckey]['exc_goods'][$excgkey]);
                                }
                                else
                                {
                                    $increase_info[$inckey]['exc_goods'][$excgkey]['common_id']   = $goods['goods_base']['common_id'];
                                    $increase_info[$inckey]['exc_goods'][$excgkey]['goods_name']  = $goods['goods_base']['goods_name'];
                                    $increase_info[$inckey]['exc_goods'][$excgkey]['goods_image'] = $goods['goods_base']['goods_image'];
                                    $increase_info[$inckey]['exc_goods'][$excgkey]['cat_id']      = $goods['goods_base']['cat_id'];
                                    $increase_info[$inckey]['exc_goods'][$excgkey]['spec']        = $goods['goods_base']['spec'];
                                    $increase_info[$inckey]['exc_goods'][$excgkey]['spec_str']    = $goods['goods_base']['spec_str'];
                                    $increase_info[$inckey]['exc_goods'][$excgkey]['directseller_flag'] = $goods['goods_common']['common_is_directseller'];
                                    if($goods['goods_common']['common_is_directseller'])
                                    {
                                        $increase_info[$inckey]['exc_goods'][$excgkey]['common_cps_rate'] = $goods['goods_common']['common_cps_rate'];
                                        $increase_info[$inckey]['exc_goods'][$excgkey]['common_second_cps_rate'] = $goods['goods_common']['common_second_cps_rate'];
                                        $increase_info[$inckey]['exc_goods'][$excgkey]['common_third_cps_rate'] = $goods['goods_common']['common_third_cps_rate'];
                                    }
                                }
                            }

                            if (empty($incval['exc_goods']))
                            {
                                unset($increase_info[$inckey]);
                            }
                            else
                            {
                                $increase_info[$inckey]['exc_goods'] = array_values($increase_info[$inckey]['exc_goods']);
                            }
                        }
                        else
                        {
                            unset($increase_info[$inckey]);
                        }
                    }
                    $data[$key]['increase_info'] = array_values($increase_info);
                    //$data[$key]['increase_info'] = current($increase_info);
                }
            }

			//店铺代金券 这里只取了满足条件的代金券
            if($val['voucher_sprice'])
            {
                $voucher_base = $Voucher_BaseModel->getUserOrderVoucherByWhere(Perm::$userId, $val['shop_id'], $val['voucher_sprice']);
                //$data[$key]['voucher_base'] = array_values($voucher_base);
                $data[$key]['voucher_base'] = $voucher_base;
            }

            if(isset($newbuyer_row[$val['shop_id']]) && $newbuyer_row[$val['shop_id']] > 1)
            {
                $data[$val['shop_id']]['newbuyer_tips'] = 1;
            }
		}

		return $data;
	}

    /**
     * 虚拟商品确认订单
     *
     * @param  int $config_key 主键值
     * @return array $rows 返回的查询内容
     * @access public
     */
    public function getVirtualCart($goods_id = null, $num = null)
    {
        $Goods_BaseModel = new Goods_BaseModel();

        $promotion          = new Promotion();
        $Order_GoodsModel   = new Order_GoodsModel();
        $Goods_CatModel     = new Goods_CatModel();
        $shareBaseModel     = new Share_BaseModel();
        $shopBaseModel      = new Shop_BaseModel();
        $Voucher_BaseModel  = new Voucher_BaseModel();

        $goods = $Goods_BaseModel->getGoodsInfo($goods_id);

        if($goods)
        {
            $shop_base = $shopBaseModel->getOne($goods['goods_base']['shop_id']);
            if($shop_base && $shop_base['shop_status'] == Shop_BaseModel::SHOP_STATUS_OPEN)
            {
                $goods['shop_base'] = $shop_base;

                $goods['transport_type_id'] = $goods['goods_common']['transport_type_id']; //商品的售卖区域
                $goods['buy_able']          = 1;
                $goods['cubage']            = $goods['goods_common']['common_cubage'];     //商品重量
                $goods['buy_limit']         = $goods['goods_common']['common_limit'];
                $goods['goods_num']         = $num;         //最大购买量
                $goods['buy_residue']       = $goods['goods_base']['goods_stock'];         //最大购买量

                /*判断是否达到购买上限 start*/
                $IsHaveBuy = 0;//是否已达购买上限
                if ($goods['buy_limit'])//是否限购
                {
                    //查询该用户是否已购买过该商品
                    $goods['order_goods_count'] = $Order_GoodsModel->getUserBuyCountByCId($goods['goods_base']['common_id']);
                    if($goods['order_goods_count'] >= $goods['buy_limit'])
                    {
                        $IsHaveBuy = 1;
                    }
                    else
                    {
                        //还可以购买数量
                        $goods['buy_residue'] = $goods['buy_limit'] - $goods['order_goods_count'];
                    }
                    $goods['IsHaveBuy'] = $IsHaveBuy;
                }

                //如果购物车里的数量>还可以购买量 更改购物车里的数量为还可以购买数量
                if($goods['goods_num'] > $goods['buy_residue'])
                {
                    $goods['goods_num'] = $goods['buy_residue'];
                }
                /*判断是否达到购买上限 end*/

                /*计算活动优惠上限 start*/
                $promotion_num = $goods['goods_num'];
                if(!$IsHaveBuy && isset($goods['goods_base']['promotion']) && isset($goods['goods_base']['promotion']['upper_limit']))
                {
                    if ($goods['goods_base']['promotion']['upper_limit'])
                    {
                        if($goods['order_goods_count'] < $goods['goods_base']['promotion']['upper_limit'])
                        {
                            $num1 = $goods['goods_base']['promotion']['upper_limit'] -  $goods['order_goods_count'];
                            if($num1 < $promotion_num)
                            {
                                $promotion_num = $num1;
                            }
                        }
                        else
                        {
                            //已达优惠上限
                            unset($goods['goods_base']['promotion']);
                        }
                    }
                }
                /*计算活动优惠上限 end*/

                /*计算优惠下限 start*/
                if(isset($goods['goods_base']['promotion']) && isset($goods['goods_base']['promotion']['lower_limit']))
                {
                    if($num < $goods['goods_base']['promotion']['lower_limit'])
                    {
                        $goods['goods_base']['promotion']['promotion_price'] = $goods['goods_base']['goods_price'];
                    }
                }
                /*计算优惠下限 end*/
                $share_num = 0;
                if(isset($goods['goods_base']['promotion']) && $goods['goods_base']['promotion']['promotion_type'] == Goods_CommonModel::FU)
                {
                    $promotion_price = $goods['goods_base']['goods_price'];
                    $goods['goods_base']['promotion']['down_price'] = 0;
                    if(Perm::$userId)
                    {
                        //获取状态值正常的记录数据
                        $FuRecordModel = new Fu_RecordModel();
                        $cond_row['user_id'] = Perm::$userId;
                        $cond_row['fu_id'] = $goods['goods_base']['promotion']['promotion_id'];
                        $cond_row['status:<'] = Fu_RecordModel::USED;
                        $cond_row['goods_id'] = $goods['goods_base']['goods_id'];
                        $fu_info = $FuRecordModel->getFuRecordByWhere($cond_row,['fu_record_id'=>'desc']);
                        if($fu_info)
                        {
                            if($fu_info['status'] == Fu_RecordModel::NORMAL)
                            {
                                $promotion_price = $goods['goods_base']['goods_price'] - $fu_info['click_count'] * $fu_info['unit_price'];
                            }
                            else if($fu_info['status'] == Fu_RecordModel::DONE)
                            {
                                $promotion_price = 0;
                            }
                        }
                    }

                    $goods['goods_base']['promotion']['promotion_price'] = $promotion_price;
                }
                else
                {
                    $share_info = $shareBaseModel->getShareByCommonId($goods['goods_base']['common_id']);
                    if($share_info)
                    {
                        //分享立减优惠上限
                        $goods['share_limit'] = $share_info['share_limit'];
                        if($share_info['price']['share_order_id'] == '0' && $share_info['price']['price'] > 0)
                        {
                            $goods['share_price_id'] = $share_info['price']['id'];//分享id赋值 提交订单的时候要用
                            $goods['share_price'] = $share_info['price']['price'];
                            $share_num = $goods['goods_num'];
                            if($goods['share_limit'] < $goods['goods_num'])
                            {
                                $share_num = $goods['share_limit'];
                            }
                        }
                    }
                }

                /*计算价格 start*/
                $sumprice = $goods['goods_base']['goods_price'] * $goods['goods_num'];
                if(isset($goods['goods_base']['promotion']) && $promotion_num)
                {
                    $sumprice -= ($goods['goods_base']['goods_price'] - $goods['goods_base']['promotion']['promotion_price']) * $promotion_num;
                }
                if($share_num && isset($share_info) && $share_info['price']['price'])
                {
                    $sumprice -= $share_num * $share_info['price']['price'];
                }
                $price = number_format($sumprice/$goods['goods_num'],'2','.','');

                $goods['old_price']  = 0;
                $goods['now_price']  = $goods['goods_base']['goods_price'];
                $goods['down_price'] = 0.00;
                if($price < $goods['goods_base']['goods_price'])
                {
                    $goods['old_price']  = $goods['goods_base']['goods_price'];
                    $goods['now_price']  = $price;
                    $goods['down_price'] = bcsub($goods['goods_base']['goods_price'] , $price,2);
                }

                //商品总价格
                $goods['sumprice'] = number_format($goods['now_price'] * $goods['goods_num'], 2, '.', '');
                //商品参加活动商品 但不叠加免邮 计算得出其他合计 后面判断免邮时用nsprice
                $goods['mian_sprice'] = $goods['man_sprice'] = $goods['voucher_sprice'] = $goods['jia_sprice'] = $goods['sumprice'];
                if(isset($goods['goods_base']['promotion']))
                {
                    //包邮
                    if(isset($goods['goods_base']['promotion']['free_freight']) && $goods['goods_base']['promotion']['free_freight'])
                    {
                        $goods['free_freight'] = 1;
                    }
                    //免邮额度
                    if(isset($goods['goods_base']['promotion']['is_mian']) && !$goods['goods_base']['promotion']['is_mian'])
                    {
                        $goods['mian_sprice'] = 0;
                    }
                    //满送
                    if(isset($goods['goods_base']['promotion']['is_man']) && !$goods['goods_base']['promotion']['is_man'])
                    {
                        $goods['man_sprice'] = 0;
                    }
                    //代金券
                    if(isset($goods['goods_base']['promotion']['is_voucher']) && !$goods['goods_base']['promotion']['is_voucher'])
                    {
                        $goods['voucher_sprice'] = 0;
                    }
                    //加价购
                    if(isset($goods['goods_base']['promotion']['is_jia']) && !$goods['goods_base']['promotion']['is_jia'])
                    {
                        $goods['jia_sprice'] = 0;
                    }
                }
                /*计算价格 end*/

                //如果是分销商购买的供货商的商品，计算折扣
                if(Web_ConfigModel::value('Plugin_Distribution') && Perm::$shopId)
                {
                    $shopDistributorModel = new Distribution_ShopDistributorModel();
                    $shopDistributorLevelModel = new Distribution_ShopDistributorLevelModel();

                    //所有供货商，用于对商品操作的判断
                    $suppliers = $shopDistributorModel->getByWhere(array('distributor_id' =>Perm::$shopId));
                    $suppliers  = array_column($suppliers,'shop_id');

                    //查看折扣，改变对应供销商商品显示的价格
                    $shopDistributorInfo     =  $shopDistributorModel->getOneByWhere(array('shop_id' =>$goods['goods_base']['shop_id'],'distributor_id'=>Perm::$shopId));
                    if(!empty($shopDistributorInfo) && $shopDistributorInfo['distributor_enable'] == 1)
                    {
                        $distritutor_rate_info     = $shopDistributorLevelModel->getOne($shopDistributorInfo['distributor_level_id']);
                        if(!empty($distritutor_rate_info) && $distritutor_rate_info['distributor_leve_discount_rate'])
                        {
                            $goods['now_price'] = $goods['now_price']*$distritutor_rate_info['distributor_leve_discount_rate']/100;
                            $distritutor_rate = $goods['sumprice'] - number_format($goods['now_price'] * $goods['goods_num'], 2, '.', '');
                            $goods['sumprice'] -= $distritutor_rate;
                            $goods['rate_price']  = $distritutor_rate;
                        }
                    }
                }

                //该商品的交易佣金计算
                $Shop_ClassBindModel = new Shop_ClassBindModel();
                $goods_cat = $Shop_ClassBindModel->getByWhere(array('shop_id'=>$goods['goods_base']['shop_id'],'product_class_id'=>$goods['goods_base']['cat_id']));
                if($goods_cat)
                {
                    $goods_cat = current($goods_cat);
                    $cat_commission = $goods_cat['commission_rate'];
                }
                else
                {
                    $goods_cat = $Goods_CatModel->getOne($goods['goods_base']['cat_id']);
                    if ($goods_cat)
                    {
                        $cat_commission = $goods_cat['cat_commission'];
                    }
                    else
                    {
                        $cat_commission = 0;
                    }
                }

                $goods['cat_commission'] = $cat_commission;
                $goods['commission'] = number_format(($goods['sumprice'] * $cat_commission / 100), 2, '.', '');

                //分佣开启，并且参与分佣
                if(Web_ConfigModel::value('Plugin_Directseller') && $goods['goods_common']['common_is_directseller'])
                {
                    $directseller_commission = 0;

                    $goods['directseller_flag'] = $goods['goods_common']['common_is_directseller'];
                    $goods['directseller_commission_0'] =  number_format(($goods['sumprice']*$goods['goods_common']['common_cps_rate']/100), 2, '.', '');  //一级分佣
                    $goods['directseller_commission_1'] = number_format(($goods['sumprice']*$goods['goods_common']['common_second_cps_rate']/100), 2, '.', ''); //二级分佣
                    $goods['directseller_commission_2'] = number_format(($goods['sumprice']*$goods['goods_common']['common_third_cps_rate']/100), 2, '.', ''); //三级分佣

                    $directseller_commission += $goods['directseller_commission_0'] + $goods['directseller_commission_1'] + $goods['directseller_commission_2'];
                }
                $goods['product_is_behalf_delivery'] = $goods['goods_common']['product_is_behalf_delivery'];

                //店铺满送活动
                if($goods['man_sprice'])
                {
                    $mansong_info = $promotion->getShopOrderGift($goods['goods_base']['shop_id'], $goods['man_sprice']);
                    if ($mansong_info)
                    {
                        if ($mansong_info['goods_id'])
                        {
                            $goods = $Goods_BaseModel->checkGoods($mansong_info['goods_id']);
                            if (!$goods)
                            {
                                unset($mansong_info['goods_id']);
                            }
                            else
                            {
                                $mansong_info['common_id']   = $goods['goods_base']['common_id'];
                                $mansong_info['goods_name']  = $goods['goods_base']['goods_name'];
                                $mansong_info['goods_price'] = $goods['goods_base']['goods_price'];
                                $mansong_info['goods_image'] = $goods['goods_base']['goods_image'];
                                $mansong_info['spec']    = $goods['goods_base']['spec'];
                                $mansong_info['spec_str']    = $goods['goods_base']['spec_str'];
                            }
                        }

                        $goods['mansong_info'] = $mansong_info;
                    }
                }

                //加价购
                $increase                          = array();
                $increase['shop_id']               = $goods['goods_base']['shop_id'];
                $goods['goods_base']['jia_sprice'] = $goods['jia_sprice'];
                $increase['goods'][]               = $goods['goods_base'];
                $increase_info                     = $promotion->getOrderIncreaseInfo($increase);

                //去除加价购商品中没有库存和不存在的商品，若是改活动下没有有效商品则去除该活动
                foreach ($increase_info as $inckey => $incval)
                {
                    if (!empty($incval['exc_goods']))
                    {
                        foreach ($incval['exc_goods'] as $excgkey => $excgval)
                        {
                            $goods_basel = $Goods_BaseModel->checkGoods($excgval['goods_id']);
                            if (!$goods_basel)
                            {
                                unset($incval['exc_goods'][$excgkey]);
                                unset($increase_info[$inckey]['exc_goods'][$excgkey]);
                            }
                            else
                            {
                                $increase_info[$inckey]['exc_goods'][$excgkey]['common_id']   = $goods['goods_base']['common_id'];
                                $increase_info[$inckey]['exc_goods'][$excgkey]['goods_name']  = $goods['goods_base']['goods_name'];
                                $increase_info[$inckey]['exc_goods'][$excgkey]['goods_image'] = $goods['goods_base']['goods_image'];
                                $increase_info[$inckey]['exc_goods'][$excgkey]['cat_id']      = $goods['goods_base']['cat_id'];
                                $increase_info[$inckey]['exc_goods'][$excgkey]['spec']        = $goods['goods_base']['spec'];
                                $increase_info[$inckey]['exc_goods'][$excgkey]['spec_str']    = $goods['goods_base']['spec_str'];
                                $increase_info[$inckey]['exc_goods'][$excgkey]['directseller_flag'] = $goods['goods_common']['common_is_directseller'];
                                if($goods['goods_common']['common_is_directseller'])
                                {
                                    $increase_info[$inckey]['exc_goods'][$excgkey]['common_cps_rate'] = $goods['goods_common']['common_cps_rate'];
                                    $increase_info[$inckey]['exc_goods'][$excgkey]['common_second_cps_rate'] = $goods['goods_common']['common_second_cps_rate'];
                                    $increase_info[$inckey]['exc_goods'][$excgkey]['common_third_cps_rate'] = $goods['goods_common']['common_third_cps_rate'];
                                }

                            }
                        }

                        if (empty($incval['exc_goods']))
                        {
                            unset($increase_info[$inckey]);
                        }
                    }
                    else
                    {
                        unset($increase_info[$inckey]);
                    }
                }
                $goods['increase_info'] = $increase_info;

                //店铺代金券 这里只取了满足条件的代金券
                if($goods['voucher_sprice'])
                {
                    $voucher_base = $Voucher_BaseModel->getUserOrderVoucherByWhere(Perm::$userId, $goods['goods_base']['shop_id'], $goods['voucher_sprice']);
                    $goods['voucher_base'] = $voucher_base;
                }
            }
            else
            {
                return null;
            }
        }

        if($goods['sumprice'] < 0)
        {
            return null;
        }

        return $goods;
    }

    public function toolbarCart()
    {
        //用户登录情况下获取购物车信息
        if (Perm::checkUserPerm())
        {
            $goodsBaseModel     = new Goods_BaseModel();
            $promotion          = new Promotion();
            $Order_GoodsModel   = new Order_GoodsModel();
            $Goods_CatModel     = new Goods_CatModel();
            $shareBaseModel     = new Share_BaseModel();
            $bundlingBaseModel  = new Bundling_BaseModel();
            $shopBaseModel      = new Shop_BaseModel();
            $Voucher_BaseModel  = new Voucher_BaseModel();

            $cart_row = $this->getByWhere(array('user_id' => Perm::$userId));

            $data = array();
            foreach ($cart_row as $key => $val)
            {
                if ($val['bl_id'])
                {
                    //套餐 Start
                    $bundling_info = $bundlingBaseModel ->getBundlingDetailInfo(array('bundling_id'=>$val['bl_id'],'bundling_state'=>Bundling_GoodsModel::NORMAL));
                    if($bundling_info)
                    {
                        $val['buy_limit'] = $bundling_info['bunlding_limit'];
                        $val['buy_residue'] = $val['goods_stock'] = $bundling_info['goods_stock'];

                        /*判断是否达到购买上限 start*/
                        $IsHaveBuy = 0;//是否已达购买上限
                        if($val['buy_limit'])
                        {
                            $val['order_goods_count'] = $Order_GoodsModel->getUserBuyCountByBId($val['bl_id']);
                            if($val['order_goods_count'] >= $val['buy_limit'])
                            {
                                $IsHaveBuy = 1;
                                //已达购买上限 不应该出现在购物车里 故删除购物车里的该商品
                                $this->removeCart($cart_row[$key]);
                                unset($cart_row[$key]);
                                continue;
                            }
                            else
                            {
                                //还可以购买数量
                                $val['buy_residue'] = $val['buy_limit'] - $val['order_goods_count'];
                            }
                            $val['IsHaveBuy'] = $IsHaveBuy;//是否达到购买上限
                        }

                        //如果购物车里的数量>还可以购买量 更改购物车里的数量为还可以购买数量
                        if($val['goods_num'] > $val['buy_residue'])
                        {
                            $val['goods_num'] = $val['buy_residue'];
                            //$this->editCart($val['cart_id'],array('goods_num'=>$val['goods_num']),false);
                        }
                        /*判断是否达到购买上限 end*/

                        /*分享立减 start*/
                        $share_num = 0;
                        if($bundling_info['share_info'])
                        {
                            //分享立减优惠上限
                            $val['share_limit'] = $bundling_info['share_info']['share_limit'];
                            if($bundling_info['share_info']['price']['share_order_id'] == '0' && $bundling_info['share_info']['price']['price'] > 0)
                            {
                                $val['share_price_id'] = $bundling_info['share_info']['price']['id'];//分享id赋值 提交订单的时候要用
                                $val['share_price'] = $bundling_info['share_info']['price']['price'];
                                $share_num = $val['goods_num'];
                                if($val['share_limit'] < $val['goods_num'])
                                {
                                    $share_num = $val['share_limit'];
                                }
                            }
                        }
                        /*分享立减 end*/
                        $sumprice = $val['goods_num'] * $bundling_info['bundling_discount_price'];
                        if($share_num)
                        {
                            $sumprice -= $share_num*$bundling_info['share_info']['price']['price'];
                        }
                        $price = number_format($sumprice/$val['goods_num'],'2','.','');

                        $val['old_price']  = $bundling_info['old_total_price'];
                        $val['now_price']  = $bundling_info['bundling_discount_price'];
                        $val['down_price'] = $bundling_info['old_total_price'] - $bundling_info['bundling_discount_price'];
                        if($price < $bundling_info['bundling_discount_price'])
                        {
                            $val['now_price']  = $price;
                            $val['down_price'] = bcsub($val['old_price'], $val['now_price'],2);
                        }

                        //套餐总价格
                        $val['sumprice'] = number_format($val['now_price'] * $val['goods_num'], 2, '.', '');

                        if(!$bundling_info['bundling_freight_choose'])
                        {
                            $val['bundling_cost'] += $bundling_info['bundling_freight'];
                        }
                        $val['bundling_info'] = $bundling_info;
                    }
                    else
                    {
                        //套装已过期或不存在
                        $this->removeCart($cart_row[$key]);
                        unset($cart_row[$key]);
                    }
                    //套餐 End
                }
                else
                {
                    //获取商品信息
                    $goods = $goodsBaseModel->getGoodsInfo($val['goods_id']);
                    if($goods)
                    {
                        $goods_base = $goods['goods_base'];
                        $goods_common = $goods['goods_common'];

                        $val['transport_type_id'] = $goods_common['transport_type_id']; //商品的售卖区域
                        $val['buy_able']          = 1;
                        $val['cubage']            = $goods_common['common_cubage'];     //商品重量
                        $val['buy_limit']         = $goods_common['common_limit'];
                        $val['buy_residue']       = $goods_base['goods_stock'];         //最大购买量

                        /*判断是否达到购买上限 start*/
                        $IsHaveBuy = 0;//是否已达购买上限
                        if ($val['buy_limit'] )//是否限购
                        {
                            //查询该用户是否已购买过该商品
                            $val['order_goods_count'] = $Order_GoodsModel->getUserBuyCountByCId($goods_base['common_id']);
                            if($val['order_goods_count'] >= $val['buy_limit'])
                            {
                                $IsHaveBuy = 1;
                                //已达购买上限 不应该出现在购物车里 故删除购物车里的该商品
                                $this->removeCart($cart_row[$key]);
                                unset($cart_row[$key]);
                                continue;
                            }
                            else
                            {
                                //还可以购买数量
                                $val['buy_residue'] = $val['buy_limit'] - $val['order_goods_count'];
                            }
                            $val['IsHaveBuy'] = $IsHaveBuy;
                        }

                        //如果购物车里的数量>还可以购买量 更改购物车里的数量为还可以购买数量
                        if($val['goods_num'] > $val['buy_residue'])
                        {
                            $val['goods_num'] = $val['buy_residue'];
                            //$this->editCart($val['cart_id'],array('goods_num'=>$val['goods_num']),false);
                        }

                        /*判断是否达到购买上限 end*/

                        /*计算活动优惠上限 start*/
                        $promotion_num = $val['goods_num'];
                        if(!$IsHaveBuy && isset($goods_base['promotion']) && isset($goods_base['promotion']['upper_limit']))
                        {
                            if ($goods_base['promotion']['upper_limit'])
                            {
                                if($val['order_goods_count'] < $goods_base['promotion']['upper_limit'])
                                {
                                    $num = $goods_base['promotion']['upper_limit'] -  $val['order_goods_count'];
                                    if($num < $promotion_num)
                                    {
                                        $promotion_num = $num;
                                    }
                                }
                                else
                                {
                                    //已达优惠上限
                                    unset($goods_base['promotion']);
                                }
                            }
                        }
                        /*计算活动优惠上限 end*/

                        /*计算优惠下限 start*/
                        if(isset($goods_base['promotion']) && isset($goods_base['promotion']['lower_limit']))
                        {
                            if($val['goods_num'] < $goods_base['promotion']['lower_limit'])
                            {
                                //unset($goods_base['promotion']);
                                $goods_base['promotion']['promotion_price'] = $goods_base['goods_price'];
                            }
                        }
                        /*计算优惠下限 end*/

                        /*分享立减 start*/
                        $share_num = 0;
                        $share_info = $shareBaseModel->getShareByCommonId($goods_base['common_id']);
                        if($share_info)
                        {
                            //分享立减优惠上限
                            $val['share_limit'] = $share_info['share_limit'];
                            if($share_info['price']['share_order_id'] == '0' && $share_info['price']['price'] > 0)
                            {
                                $val['share_price_id'] = $share_info['price']['id'];//分享id赋值 提交订单的时候要用
                                $val['share_price'] = $share_info['price']['price'];
                                $share_num = $val['goods_num'];
                                if($val['share_limit'] < $val['goods_num'])
                                {
                                    $share_num = $val['share_limit'];
                                }
                            }
                        }
                        /*分享立减 end*/

                        /*计算价格 start*/
                        $sumprice = $goods_base['goods_price'] * $val['goods_num'];
                        if(isset($goods_base['promotion']) && $promotion_num)
                        {
                            $sumprice -= ($goods_base['goods_price'] - $goods_base['promotion']['promotion_price'])*$promotion_num;
                        }
                        if($share_num)
                        {
                            $sumprice -= $share_num*$share_info['price']['price'];
                        }
                        $price = number_format($sumprice/$val['goods_num'],'2','.','');

                        $val['old_price']  = 0;
                        $val['now_price']  = $goods_base['goods_price'];
                        $val['down_price'] = 0.00;
                        if($price < $goods_base['goods_price'])
                        {
                            $val['old_price']  = $goods_base['goods_price'];
                            $val['now_price']  = $price;
                            $val['down_price'] = bcsub($goods_base['goods_price'] , $price,2);
                        }

                        //商品总价格
                        $val['sumprice'] = number_format($val['now_price'] * $val['goods_num'], 2, '.', '');

                        $val['common_id'] = $goods_base['common_id'];
                        $val['goods_name'] = $goods_base['goods_name'];
                        $val['goods_image'] = $goods_base['goods_image'];
                        $val['goods_price'] = $goods_base['goods_price'];
                        $val['goods_stock'] = $goods_base['goods_stock'];
                        $val['goods_salenum'] = $goods_base['goods_salenum'];
                        $val['goods_share_price'] = $goods_base['goods_share_price'];
                        $val['goods_is_promotion'] = $goods_base['goods_is_promotion'];
                        $val['goods_promotion_price'] = $goods_base['goods_promotion_price'];
                        $val['spec_str'] = $goods_base['spec_str'];
                    }
                    else
                    {
                        //商品已失效 已删除或下架 Zhenzh 20171104
                        $this->removeCart($cart_row[$key]);
                        unset($cart_row[$key]);
                    }
                }

                if (!array_key_exists($val['shop_id'], $data))
                {
                    //获取店铺信息
                    $shop_base = $shopBaseModel->getOne($val['shop_id']);
                    if($shop_base && $shop_base['shop_status'] == Shop_BaseModel::SHOP_STATUS_OPEN)
                    {
                        $data[$val['shop_id']]['shop_id']            = $shop_base['shop_id'];
                        $data[$val['shop_id']]['shop_name']          = $shop_base['shop_name'];
                        $data[$val['shop_id']]['shop_user_id']       = $shop_base['user_id'];
                        $data[$val['shop_id']]['shop_user_name']     = $shop_base['user_name'];
                        $data[$val['shop_id']]['district_id']        = $shop_base['district_id'];
                        $data[$val['shop_id']]['shop_self_support']  = $shop_base['shop_self_support'];   //店铺是否自营  true 自营 false 非自营
                        $data[$val['shop_id']]['shop_free_shipping'] = $shop_base['shop_free_shipping'];

                        $data[$val['shop_id']]['goods'][]            = $val;
                    }
                }
                else
                {
                    $data[$val['shop_id']]['goods'][] = $val;
                }

                if (isset($data[$val['shop_id']]['sprice']))
                {
                    //店铺总价
                    $data[$val['shop_id']]['sprice'] = str_replace(',', '', $data[$val['shop_id']]['sprice']) * 1;
                    $val['sumprice']                 = str_replace(',', '', $val['sumprice']) * 1;

                    $data[$val['shop_id']]['sprice']         += $val['sumprice'];

                    //如果有套装运费
                    if($val['bundling_cost'])
                    {
                        $data[$val['shop_id']]['bundling_total_cost']  += $val['bundling_cost'];
                    }
                }
                else
                {
                    $data[$val['shop_id']]['sprice'] = $val['sumprice'];

                    //如果有套装运费
                    if($val['bundling_cost'])
                    {
                        $data[$val['shop_id']]['bundling_total_cost']  = $val['bundling_cost'];
                    }
                }

                $data[$val['shop_id']]['sprice']     = number_format($data[$val['shop_id']]['sprice'] * 1, 2, '.', '');
            }

            return $data;
        }
    }


    /**
     * 获取购物车内商品的单价/合计价
     * 修改购物车数量时用
     *
     * @param null $cart_id
     * @param $distributor_flag
     * @return mixed
     */
	public function getCartGoodPrice($cart_id = null,$distributor_flag)
	{
        $goodsBaseModel  = new Goods_BaseModel();
        $orderGoodsModel = new Order_GoodsModel();
        $shareBaseModel  = new Share_BaseModel();

        $cart_base = $this->getOne($cart_id);

        if($cart_base['bl_id'])
        {
            $Bundling_BaseModel = new Bundling_BaseModel();
            $bungling = $Bundling_BaseModel -> getOne($cart_base['bl_id']);
            $sumprice = $cart_base['goods_num'] * $bungling['bundling_discount_price'];
        }
        else
        {
            $goods_base = $goodsBaseModel->getGoodsInfoAndPromotionById($cart_base['goods_id'],$distributor_flag);

            //已购买数量
            $order_goods_count = $orderGoodsModel->getUserBuyCountByCId($goods_base['common_id']);

            /*计算活动优惠上限 start*/
            $promotion_num = $cart_base['goods_num'];
            if(isset($goods_base['promotion']) && isset($goods_base['promotion']['upper_limit']))
            {
                if ($goods_base['promotion']['upper_limit'])
                {
                    if($order_goods_count < $goods_base['promotion']['upper_limit'])
                    {
                        $num = $goods_base['promotion']['upper_limit'] -  $order_goods_count;
                        if($num < $promotion_num)
                        {
                            $promotion_num = $num;
                        }
                    }
                    else
                    {
                        //已达优惠上限
                        unset($goods_base['promotion']);
                    }
                }
            }
            /*计算活动优惠上限 end*/

            /*计算优惠下限 start*/
            if(isset($goods_base['promotion']) && isset($goods_base['promotion']['lower_limit']))
            {
                if($cart_base['goods_num'] < $goods_base['promotion']['lower_limit'])
                {
                    //unset($goods_base['promotion']);
                    $goods_base['promotion']['promotion_price'] = $goods_base['goods_price'];
                }
            }
            /*计算优惠下限 end*/

            /*计算价格 start*/
            $sumprice = $goods_base['goods_price'] * $cart_base['goods_num'];
            if(isset($goods_base['promotion']) && $promotion_num)
            {
                $sumprice -= ($goods_base['goods_price'] - $goods_base['promotion']['promotion_price'])*$promotion_num;
            }
            /*计算价格 end*/
        }

        /*分享立减 start*/
        $share_num = 0;
        if($cart_base['bl_id'])
        {
            $share_info = $shareBaseModel->getShareByBId($cart_base['bl_id']);
        }
        else
        {
            $share_info = $shareBaseModel->getShareByCommonId($goods_base['common_id']);
        }

        if($share_info && $share_info['price']['share_order_id'] == '0' && $share_info['price']['price'] > 0)
        {
            $share_num = $cart_base['goods_num'];
            if($share_info['share_limit'] < $cart_base['goods_num'])
            {
                $share_num = $share_info['share_limit'];
            }
        }
        /*分享立减 end*/

        /*计算价格 start*/
        if($share_num)
        {
            $sumprice -= $share_num * $share_info['price']['price'];
        }
        $data['unit_price'] = number_format($sumprice/$cart_base['goods_num'],'2','.','');
        $data['price'] = number_format($data['unit_price'] * $cart_base['goods_num'], 2, '.', '');
        /*计算价格 end*/

		return $data;
	}

    /**
     * 计算购物车中的商品数量
     *
     * @param array $cond_row
     * @param array $order_row
     * @return int
     */
	public function getCartGoodsNum($cond_row = array(), $order_row = array())
	{
		$user_id = $cond_row['user_id'];
		$sql = 'SELECT COUNT( ' .$this->_tablePrimaryKey. ') num FROM ' . $this->_tableName . ' WHERE 1 AND user_id = ' . $user_id . '';
		$data = $this->sql->getRow($sql);
		return isset($data['num']) ? $data['num'] : 0;
	}

    /**
     * 将cookie中的购物车信息插入用户中
     *
     * @param null $user_id
     */
	public function updateCookieCart($user_id = null)
	{
		$cart_list = $_COOKIE['goods_cart'];

		$cart_list = explode('|',$cart_list);

		foreach($cart_list as $key => $val)
		{
			$val = explode(',',$val);
			if(count($val) > 1)
			{
				//将商品id与数量添加到购物车表中
				$this->updateCart($user_id,$val[0],$val[1]);
			}
		}
	}

	public function updateCart($user_id=null, $goods_id=null, $goods_num=null)
	{
		if ($goods_id)
		{
			//查找商品的shop_id
			$Goods_BaseModel = new Goods_BaseModel();
			$goods_base      = $Goods_BaseModel->getOne($goods_id);

			//查找店铺主人
			$Shop_BaseModel = new Shop_BaseModel();
			$shop = $Shop_BaseModel->getOne($goods_base['shop_id']);
			if($shop['user_id'] == $user_id)
			{
				return false;
			}

			//判断该件商品是否为虚拟商品，若为虚拟商品则加入购物车失败
			$Goods_CommonModel = new Goods_CommonModel();
			$common_base = $Goods_CommonModel->getOne($goods_base['common_id']);
			if($common_base['common_is_virtual'] != $Goods_CommonModel::GOODS_VIRTUAL)
			{
				$shop_id = $goods_base['shop_id'];

				//判断购物车中是否存在该商品
				$cart_cond             = array();
				$cart_cond['user_id']  = $user_id;
				$cart_cond['shop_id']  = $shop_id;
				$cart_cond['goods_id'] = $goods_id;
				$cart_row              = current($this->getByWhere($cart_cond));
				$msg                   = '';


				//查询该用户是否已购买过该商品
				$Order_GoodsModel = new Order_GoodsModel();
				$order_goods_cond['common_id']             = $goods_base['common_id'];
				$order_goods_cond['buyer_user_id']         = $user_id;
				$order_goods_cond['order_goods_status:!='] = Order_StateModel::ORDER_REFUND_FINISH;
				$order_list                                = $Order_GoodsModel->getByWhere($order_goods_cond);

				$order_goods_count         = count($order_list);

				//如果有限购数量就计算还剩多少可购买的商品数量

				$limit_num = $goods_base['goods_max_sale'];
				if($goods_base['goods_max_sale'])
				{
					$limit_num = $goods_base['goods_max_sale'] - $order_goods_count;
					$limit_num = $limit_num < 0 ? 0:$limit_num;
				}

				if ($cart_row)
				{
					//判断商品的个人购买数
					//if (($cart_row['goods_num'] >= $goods_base['goods_max_sale'] || $cart_row['goods_num'] + $goods_num > $goods_base['goods_max_sale']) && $goods_base['goods_max_sale'] != 0)
					if (($cart_row['goods_num'] >= $limit_num || $cart_row['goods_num'] + $goods_num > $limit_num) && $goods_base['goods_max_sale'] != 0)
					{
						return false;
					}
					else
					{
						$edit_row = array('goods_num' => $goods_num);
						$flag     = $this->editCart($cart_row['cart_id'], $edit_row, true);
					}
					$cart_id = $cart_row['cart_id'];
				}
				else
				{
					$add_row              = array();
					$add_row['user_id']   = $user_id;
					$add_row['shop_id']   = $shop_id;
					$add_row['goods_id']  = $goods_id;
					$add_row['goods_num'] = $goods_num;

					$flag    = $this->addCart($add_row, true);
					$cart_id = $flag;
				}
			}
			else
			{
				return false;
			}


		}
		else
		{
			return false;
		}


		return true;
	}

}

?>