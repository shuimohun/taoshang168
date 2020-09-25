<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author WenQingTeng
 */
class Buyer_CartCtl extends Controller
{
    public $cartModel = null;
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

		$this->title       = '';
		$this->description = '';
		$this->keyword     = '';
		$this->web         = $this->webConfig();
		$this->bnav		 = 		$this->bnavIndex();

		$this->cartModel = new CartModel();
	}

	public function index()
	{
		include $this->view->getView();
	}

	/**
	 * 首页
	 *
	 * @author WenQingTeng
	 */
	public function cart()
	{
	    $data = array();
        $data['cart_list'] = $this->getCart();
        $data['count'] = $data['cart_list']['count'];

        unset($data['cart_list']['count']);

		if ($this->typ == 'json')
		{
            $sum = 0;
            foreach ($data['cart_list'] as $key => $val)
            {
                $sum += $val['sprice'];
            }
            $data['sum'] = number_format($sum,'2','.','');

            $data['cart_list'] = array_values($data['cart_list']);
            $this->data->addBody(-140, $data);
		}
		else
		{
			include $this->view->getView();
		}
	}

	/**
	 * 获取用户的收货地址
	 *
	 * @author WenQingTeng
	 */
	public function resetAddress()
	{
		$user_id         = Perm::$row['user_id'];
		$user_address_id = request_int('id');

		//获取一级地址
		$district_parent_id = request_int('pid', 0);
		$baseDistrictModel  = new Base_DistrictModel();
		$district           = $baseDistrictModel->getDistrictTree($district_parent_id);

		if ($user_address_id)
		{
			$cond_row          = array(
				'user_id' => $user_id,
				'user_address_id' => $user_address_id
			);
			$User_AddressModel = new User_AddressModel();
			$data              = $User_AddressModel->getOneByWhere($cond_row);
		}

		include $this->view->getView();
	}

	/**
	 * 获取用户的发票信息
	 *
	 * @author WenQingTeng
	 */
	public function piao()
	{
		//获取一级地址
		$district_parent_id = request_int('pid', 0);
		$baseDistrictModel  = new Base_DistrictModel();
		$district           = $baseDistrictModel->getDistrictTree($district_parent_id);

		//获取用户的发票信息
		$user_id      = Perm::$row['user_id'];
		$InvoiceModel = new InvoiceModel();
		$data         = $InvoiceModel->getInvoiceByUser($user_id);

		if($this->typ == 'json')
		{
			if($data['normal'])
			{
				$da['normal'] = $data['normal'];
			}
			else
			{
				$da['normal'] = array();
			}

			if($data['electron'])
			{
				$da['electron'] = $data['electron'];
			}
			else
			{
				$da['electron'] = array();
			}

			if($data['addtax'])
			{
				$da['addtax'] = $data['addtax'];
			}
			else
			{
				$da['addtax'] = array();
			}
			$this->data->addBody(-140, $da);
		}
		else
		{
			include $this->view->getView();
		}


	}

	/**
	 * 确认订单信息后生成订单
	 *
	 * @author WenQingTeng
	 */
	public function confirm()
	{

		$user_id    = Perm::$row['user_id'];
		$address_id = request_int('address_id');
        $ver        = request_string('ver');

		//获取用户的折扣信息
		$User_InfoMode = new User_InfoModel();
		$user_info     = $User_InfoMode->getOne($user_id);

		$User_GradeMode = new User_GradeModel();
		$user_grade     = $User_GradeMode->getOne($user_info['user_grade']);

		if (!$user_grade)
		{
			$user_rate = 100;  //不享受折扣时，折扣率为100%
		}
		else
		{
			$user_rate = $user_grade['user_grade_rate'];
		}

		//分销商购买不计算会员折扣
		if(Perm::$shopId)
		{
			$user_rate = 100;
		}

		//获取收货地址 计算运费
		$User_AddressModel = new User_AddressModel();
		$cond_address      = array('user_id' => $user_id);
		$address           = $User_AddressModel->getAddressList($cond_address, array('user_address_default' => 'DESC'));

		$city_id = 0;
        $receiver_phone = '';
        if ($address_id && isset($address[$address_id]))
        {
            //如果传递了address_id,根据address_id获取运费信息
            $city_id        = $address[$address_id]['user_address_city_id'];
            $receiver_phone = $address[$address_id]['user_address_phone'];
        }
        else
        {
            //根据默认收货地址计算运费
            foreach ($address as $key => $value)
            {
                if ($value['user_address_default'] == User_AddressModel::DEFAULT_ADDRESS)
                {
                    $city_id        = $value['user_address_city_id'];
                    $receiver_phone = $value['user_address_phone'];
                }
            }
        }

        $cart_id = request_row('product_id');
        if(!is_array($cart_id))
        {
            $product_id = request_string('product_id');
            $cart_id = explode(',',$product_id);
        }

        $order_row = array();
        $cond_row['cart_id:IN'] = $cart_id;
        $cond_row['user_id']    = $user_id;
        //购物车中的商品信息
        $row = $this->cartModel->getCardList($cond_row, $order_row,$receiver_phone);

        if ($city_id)
        {
            $Transport_TypeModel = new Transport_TypesModel();
            $data = $Transport_TypeModel->cost($city_id,$row);
        }
        else
        {
            $data['glist'] = $row;
        }

        $data['address']   = array_values($address);

        //平台优惠券
        $RedPacket_BaseModel = new RedPacket_BaseModel();
        $red_packet_base = $RedPacket_BaseModel->getUserOrderRedPacketByWhere(Perm::$userId);
        if($red_packet_base)
        {
            $red_packet_desc = array_sort($red_packet_base, 'redpacket_price', 'desc');
            $data['rpt_list'] 	= array_values($red_packet_desc);
        }
        else
        {
            $data['rpt_list']	= array();
        }

        $data['total_price'] = 0;
        foreach($data['glist'] as $key=>$val)
        {
            if($data['glist'][$key]['mansong_info'] && $data['glist'][$key]['mansong_info']['rule_discount'])
            {
                $data['glist'][$key]['total_price'] = number_format($val['sprice'] - $data['glist'][$key]['mansong_info']['rule_discount'],2,'.','');
            }
            else
            {
                $data['glist'][$key]['total_price'] = $val['sprice'];
            }

            if(!Web_ConfigModel::value('rate_service_status') ||(Web_ConfigModel::value('rate_service_status') && $val['shop_self_support'] == 'true'))
            {
                $data['glist'][$key]['user_rate'] = $user_rate;
            }
            else
            {
                $data['glist'][$key]['user_rate'] = 100;
            }

            if($data['glist'][$key]['user_rate'] < 100)
            {
                $data['glist'][$key]['rate_price'] = number_format($data['glist'][$key]['total_price']*(100-$data['glist'][$key]['user_rate'])/100,2);
                $data['glist'][$key]['total_price'] -= $data['glist'][$key]['rate_price'];
            }

            //本店合计加上物流费用
            if($val['cost'])
            {
                $data['glist'][$key]['total_price'] += $val['cost'];
            }

            $data['total_price'] += $data['glist'][$key]['total_price'];
        }

        $data['count'] = count($data['glist']);

		if(!$data['count'])
		{
			$this->view->setMet('error');
		}

		if ($this->typ == 'json')
		{
            $this->data->addBody(-140, $data);
        }
		else if($ver == 'verify')
		{
            /*unset($data['glist']['count']);
            foreach($data['glist'] as $key => $value)
            {
                $data['glist'][$key]['cost'] = $data['cost'][$key];
            }
            unset($data['cost']);
            $data['glist'] = array_values($data['glist']);
            $arr['cmd_id'] = '-140';
            $arr['status'] = 200;
            $arr['msg']  = 'success';
            $arr['data'] = $data;
            echo json_encode($arr);die;*/
        }
		else
		{
			include $this->view->getView();
		}
	}

    //根据收货地址与商品id计算出物流运费
	public function getTransportCost()
	{
		$transportTypeModel = new Transport_TypeModel();

		$city = request_string('city');

		$cart_id = request_string('cart_id');

		$data = $transportTypeModel->countTransportCost($city, $cart_id);

		$this->data->addBody(-140, $data);
	}

	/**
	 * 确认订单信息后生成订单(虚拟商品)
	 *
	 * @author WenQingTeng
	 */
	public function confirmVirtual()
	{
		$nums     = request_int("nums");
		$goods_id = request_int('goods_id');

		$user_id = Perm::$userId;
		//获取用户的折扣信息
		$User_InfoMidel = new User_InfoModel();
		$user_info      = $User_InfoMidel->getOne($user_id);

		$User_GradeModel = new User_GradeModel();
		$user_grade      = $User_GradeModel->getOne($user_info['user_grade']);
		$user_rate       = $user_grade['user_grade_rate'];

		//获取虚拟商品的信息
		$data = $this->cartModel->getVirtualCart($goods_id, $nums);
		$RedPacket_BaseModel        = new RedPacket_BaseModel();
		$red_packet_base            = $RedPacket_BaseModel->getUserOrderRedPacketByWhere(Perm::$userId);
		if($red_packet_base)
		{
			$red_packet_desc 	= array_sort($red_packet_base, 'redpacket_price', 'desc');
			$data['rpt_list'] 	= array_values($red_packet_desc);
			$data['rpt_info']   = current($red_packet_desc);
		}
		else
		{
			$data['rpt_list']	= array();
			$data['rpt_info']   = array();
		}

		fb($data);
		fb('虚拟确认订单');

		if($user_rate > 0 && (!Web_ConfigModel::value('rate_service_status') ||(Web_ConfigModel::value('rate_service_status') && $data['shop_base']['shop_self_support'] == 'true')))
		{

		}
		else
		{
			$user_rate = 100;
		}

		if ( $this->typ == 'json' )
		{
			$data['user_rate'] = $user_rate;

			$this->data->addBody(-140, $data);
		}
		else
		{
			include $this->view->getView();
		}
	}

	/**
	 * 获取购物车列表
	 *
	 * @author WenQingTeng
	 */
	public function getCart()
	{
		$user_id = Perm::$row['user_id'];
		$data    = $this->cartModel->getCardList(array('user_id' => $user_id), array());

		if ($data)
		{
		    //获取代金券 包括 1.$data里面满足订单可用的 2.已领未满足订单的 3.未领的
            //然后按价格排序
            $VoucherBaseModel     = new Voucher_BaseModel();
            $VoucherTemplateModel = new Voucher_TempModel();
		    foreach ($data as $key=>$value)
            {
                //获取 已领/兑 代金券
                $cond_row['voucher_owner_id']    = $user_id;
                $cond_row['voucher_shop_id']     = $value['shop_id'];
                $cond_row['voucher_state']       = Voucher_BaseModel::UNUSED;
                $cond_row['voucher_end_date:>']  = get_date_time();
                if($value['voucher_base'])
                {
                    $voucher_t_ids = array_column($value['voucher_base'],'voucher_t_id');
                    $cond_row['voucher_t_id:NOT IN'] = $voucher_t_ids;
                }
                $order_row['voucher_id']         = 'DESC';
                $rows                            = $VoucherBaseModel->getByWhere($cond_row, $order_row);
                //已领/兑代金券 购物车满足的代金券 合并
                if($rows)
                {
                    if($value['voucher_base'])
                    {
                        $rows = array_merge($rows,$value['voucher_base']);
                    }
                }
                else
                {
                    $rows = $value['voucher_base'];
                }

                foreach ($rows as $k=>$v)
                {
                    if($v['voucher_type'] == Voucher_TempModel::GETBYPOINTS)
                    {
                        $rows[$k]['voucher_type_con'] = '已兑';
                    }
                    else
                    {
                        $rows[$k]['voucher_type_con'] = '已领';
                    }
                    $rows[$k]['taken'] = 1;
                    $voucher_t_ids[] = $v['voucher_t_id'];
                }

                //取还没领的代金券
                $cond_vt_row['shop_id'] = $value['shop_id'];
                $cond_vt_row['voucher_t_state'] = Voucher_TempModel::VALID;
                $cond_vt_row['voucher_t_start_date:<'] = date('y-m-d H:i:s',time());
                $cond_vt_row['voucher_t_end_date:>'] = date('y-m-d H:i:s',time());
                if($voucher_t_ids)
                {
                    $cond_vt_row['voucher_t_id:NOT IN'] = $voucher_t_ids;
                }
                $shop_voucher = $VoucherTemplateModel->getByWhere($cond_vt_row);
                //将还没领的代金券放入代金券列表中
                if($shop_voucher)
                {
                    foreach ($shop_voucher as $k=>$v)
                    {
                        $shop_voucher_data['voucher_t_id']       = $v['voucher_t_id'];
                        $shop_voucher_data['voucher_title']      = $v['voucher_t_title'];
                        $shop_voucher_data['voucher_desc']       = $v['voucher_t_desc'];
                        $shop_voucher_data['voucher_start_date'] = $v['voucher_t_start_date'];
                        $shop_voucher_data['voucher_end_date']   = $v['voucher_t_end_date'];
                        $shop_voucher_data['voucher_price']      = $v['voucher_t_price'];
                        $shop_voucher_data['voucher_limit']      = $v['voucher_t_limit'];
                        $shop_voucher_data['voucher_shop_id']    = $v['shop_id'];
                        $shop_voucher_data['voucher_type']       = $v['voucher_t_access_method'];
                        if($shop_voucher_data['voucher_type'] == Voucher_TempModel::GETBYPOINTS)
                        {
                            $shop_voucher_data['voucher_type_con'] = '兑换';
                        }
                        else
                        {
                            $shop_voucher_data['voucher_type_con'] = '领取';
                        }
                        $shop_voucher_data['voucher_points']     = $v['voucher_t_points'];

                        $rows[] = $shop_voucher_data;
                    }
                }

                //按价格排序
                $key_arrays = array_column($rows,'voucher_price');
                array_multisort($key_arrays,SORT_ASC,SORT_NUMERIC,$rows);

                $data[$key]['voucher_base'] = $rows;

                $data['count'] += count($value['goods']);
            }

			$status = 200;
			$msg    = _('success');
		}
		/*else
		{
			$status = 250;
			$msg    = _('failure');
		}

		$this->data->addBody(-140, $data, $msg, $status);*/
		return $data;
	}

	/**
	 * 修改购物车数量
	 *
	 * @author WenQingTeng
	 */
	public function editCartNum()
	{
        $orderGoodsModel  = new Order_GoodsModel();

        $cart_id = request_int('cart_id');
		$num     = request_int('num');

        $flag    = false;
        $bl      = false;
        $distributor_flag = false;
		if($cart_id && $num > 0)
        {
            //获取商品信息
            $cart_base = $this->cartModel->getOne($cart_id);

            if($cart_base['bl_id'])
            {
                $bl=true;
                $bundlingBaseModel = new Bundling_BaseModel();
                $bundling_base = $bundlingBaseModel->getOne($cart_base['bl_id']);

                if($bundling_base)
                {
                    if($bundling_base['bunlding_limit'])
                    {
                        //查询该用户是否已购买过该商品
                        $order_goods_count = $orderGoodsModel->getUserBuyCountByBId($cart_base['bl_id']);
                        $limit_num = $bundling_base['bunlding_limit'] - $order_goods_count;
                        $limit_num = $limit_num < 0 ? 0:$limit_num;

                        if($limit_num < $num)
                        {
                            $num = $limit_num;
                        }
                    }

                    //判断加入购物车的数量和库存
                    //if($num <= $bundling_base['goods_stock'])
                    if(true)
                    {
                        $flag = $this->cartModel->editCartNum($cart_id, array('goods_num' => $num));
                    }
                    else
                    {
                        $flag = false;
                        $msg = '库存不足';
                    }
                }
                else
                {
                    //套装状态不正常
                }
            }
            else
            {
                $goodsBaseModel   = new Goods_BaseModel();
                $goodsCommonModel = new Goods_CommonModel();

                $goods_id = $cart_base['goods_id'];
                $goods_base = $goodsBaseModel->getOne($goods_id);

                $FuRecordModel = new Fu_RecordModel();
                $fu_record_row['goods_id'] = $goods_base['goods_id'];
                $fu_record_row['user_id'] = Perm::$userId;
                $fu_record_row['status:<='] = Fu_RecordModel::DONE;
                $fu_record_row['fu_end_time:>'] = get_date_time();
                $fu_record_id = $FuRecordModel ->getKeyByWhere($fu_record_row);

                if($fu_record_id)
                {
                    if ($cart_base['goods_num'] > 1)
                    {
                        $num = 1;
                        $flag = $this->cartModel->editCartNum($cart_id, array('goods_num' => $num));
                    }
                }
                else
                {
                    $goods_common = $goodsCommonModel->getFiled('common_limit,product_distributor_flag,common_promotion_type',array('common_id'=>$goods_base['common_id']));
                    if($goods_common['product_distributor_flag'])
                    {
                        $distributor_flag = true;
                    }

                    //如果有限购数量就计算还剩多少可购买的商品数量
                    if($goods_common['common_limit'])
                    {
                        //查询该用户是否已购买过该商品
                        $order_goods_count = $orderGoodsModel->getUserBuyCountByCId($goods_base['common_id']);
                        $top_limit = $goods_common['common_limit'] - $order_goods_count;
                        $top_limit = $top_limit < 0 ? 0 : $top_limit;

                        if($num > $top_limit)
                        {
                            $num = $top_limit;
                        }
                    }

                    $lower_limit = 1;
                    if($goods_common['common_promotion_type'])
                    {
                        $Promotion = new Promotion();
                        $promotion = $Promotion->getGoodsPromotion($goods_id,$goods_base['common_id'],$goods_common['common_promotion_type']);
                        if ($promotion)
                        {
                            $promotion = current($promotion);
                            if ($promotion['lower_limit'])
                            {
                                $lower_limit = $promotion['lower_limit'];
                            }
                        }
                    }

                    //判断加入购物车的数量和库存
                    if ($goods_base['goods_stock'] >= $lower_limit && $goods_base['goods_stock'] >= $num)
                    {
                        if($num >= $lower_limit)
                        {
                            $flag = $this->cartModel->editCartNum($cart_id, array('goods_num' => $num));
                        }
                        else
                        {
                            $flag = false;
                            $msg = '不能小于最低购买数';
                        }
                    }
                    else
                    {
                        $flag = false;
                        $msg = '库存不足';
                    }
                }
            }
        }

		$data = array();
		if ($flag)
		{
			//获取此商品的总价
			$data = $this->cartModel->getCartGoodPrice($cart_id,$distributor_flag);
            if($bl)
            {
                $data['bl'] = '1';
            }
			$status = 200;
			$msg    = _('success');
		}
		else
		{
			$status = 250;
			$msg    = $msg?$msg:'failure';
		}

		$this->data->addBody(-140, $data, $msg, $status);
	}

	/**
	 * 删除购物车中的商品
	 *
	 * @author WenQingTeng
	 */
	public function delCartByCid()
	{
		$cart_id = request_string('id');

		$flag = $this->cartModel->removeCart($cart_id);
		//$flag = true;
		if ($flag)
		{

			$status = 200;
			$msg    = _('success');
		}
		else
		{
			$status = 250;
			$msg    = _('failure');
		}
		$data = array($cart_id);
		$this->data->addBody(-140, $data, $msg, $status);

	}

	/**
	 * 立即购买虚拟产品
	 *
	 * @author WenQingTeng
	 */
	public function buyVirtual()
	{
		$user_id   = Perm::$row['user_id'];
		$goods_id  = request_int('goods_id');
		$goods_num = request_int('goods_num');

		//获取虚拟商品的信息
		$Goods_BaseModel = new Goods_BaseModel();
		$data            = $Goods_BaseModel->getGoodsInfo($goods_id);

		fb($data);
		//计算商品价格
		if (isset($data['goods_base']['promotion_price']) && !empty($data['goods_base']['promotion_price']) && $data['goods_base']['promotion_price'] < $data['goods_base']['goods_price'])
		{
			$data['goods_base']['old_price']  = $data['goods_base']['goods_price'];
			$data['goods_base']['now_price']  = $data['goods_base']['promotion_price'];
			$data['goods_base']['down_price'] = $data['goods_base']['down_price'];
		}
		else
		{
			$data['goods_base']['old_price']  = 0;
			$data['goods_base']['now_price']  = $data['goods_base']['goods_price'];
			$data['goods_base']['down_price'] = 0;
		}

		$data['goods_base']['cart_num'] = $goods_num;
		$data['goods_base']['sumprice'] = $goods_num * $data['goods_base']['now_price'];

		$Order_GoodsModel = new Order_GoodsModel();
		if ($user_id)
		{
			//团购商品是否已经开始
			//查询该用户是否已购买过该商品
			$order_goods_cond['common_id']             = $data['goods_base']['common_id'];
			$order_goods_cond['buyer_user_id']         = $user_id;
			$order_goods_cond['order_goods_status:!='] = Order_StateModel::ORDER_REFUND_FINISH;
			$order_list                                = $Order_GoodsModel->getByWhere($order_goods_cond);

			$order_goods_count         = count($order_list);
			$data['order_goods_count'] = $order_goods_count;

		}

		//计算商品购买数量
		//计算限购数量
		if (isset($data['goods_base']['upper_limit']))
		{
			if ($data['goods_base']['upper_limit'] && $data['common_base']['common_limit'])
			{
				if ($data['goods_base']['upper_limit'] >= $data['common_base']['common_limit'])
				{
					$data['buy_limit'] = $data['common_base']['common_limit'];
				}
				else
				{
					$data['buy_limit'] = $data['goods_base']['upper_limit'];
				}
			}
			elseif ($data['goods_base']['upper_limit'] && !$data['common_base']['common_limit'])
			{
				$data['buy_limit'] = $data['goods_base']['upper_limit'];
			}
			elseif (!$data['goods_base']['upper_limit'] && $data['common_base']['common_limit'])
			{
				$data['buy_limit'] = $data['common_base']['common_limit'];
			}
			else
			{
				$data['buy_limit'] = 0;
			}
		}
		else
		{
			$data['buy_limit'] = $data['common_base']['common_limit'];
		}

		//有限购数量且仍可以购买，计算还可购买的数量
		if ($data['buy_limit'])
		{
			$data['buy_residue'] = $data['buy_limit'] - $order_goods_count;
		}

		fb($data);
		fb("虚拟购物车");

		if ('json' == $this->typ)
		{
			$this->data->addBody(-140, $data);
		}else
		{
			include $this->view->getView();
		}

	}

	/**
	 * 加入购物车
	 *
	 * @author WenQingTeng
	 */
	public function add()
	{
		include $this->view->getView();
	}

	public function addCartRow()
	{
		$cart_list = request_string('cartlist');
		$user_id = request_int('u');

		$cart_list = explode('|',$cart_list);


		foreach($cart_list as $key => $val)
		{
			$val = explode(',',$val);
			if(count($val) > 1)
			{
				//将商品id与数量添加到购物车表中
				$this->cartModel->updateCart($user_id,$val[0],$val[1]);
			}
		}

		$this->data->addBody(-140, array());
	}

	public function addCart()
	{

		$user_id   = Perm::$row['user_id'];

		$goods_id  = request_int('goods_id');
		$goods_num = request_int('goods_num');
        $bl_id  = request_int('bl_id');//如果存在 套装加入购物车

        if($goods_num <= 0)
        {
            $this->data->addBody(-140, array());return false;
        }

		$Goods_BaseModel = new Goods_BaseModel();
		$Goods_CommonModel = new Goods_CommonModel();
		
		$goods_base      = $Goods_BaseModel->getone($goods_id);

		$common_base = $Goods_CommonModel->getOne($goods_base['common_id']);
		
		//如果是供货商的商品
		$ShopBaseModel = new Shop_BaseModel();
		$goods_shop_base  = $ShopBaseModel ->getOne($common_base['shop_id']);
		$dist_flag = true;
		if(Perm::$shopId && $goods_shop_base['shop_type'] == 2){
			//分销商申请是否通过
			$shopDistributorModel = new Distribution_ShopDistributorModel();
			$shopDistributorBase = $shopDistributorModel -> getOneByWhere(array('distributor_id' => Perm::$shopId,'shop_id' => $common_base['shop_id']));
	 
			$allow_shop_cat = explode(',',$shopDistributorBase['distributor_cat_ids']);//分销商申请的店铺分类
			
			$common_shopcat_id = trim($common_base['shop_cat_id'],',');
			$common_shopcat_id = explode(',',$common_shopcat_id);
			
			if($shopDistributorBase['distributor_enable'] == 1 && (array_intersect($common_shopcat_id, $allow_shop_cat) || empty($shop_cat_id))){

			}else{
				
				if(!$shopDistributorBase['distributor_enable'])
				{
					$dist_flag = false;
					$msg = '淘金申请未通过！';
				}
				
				if(!array_intersect($common_shopcat_id, $allow_shop_cat) )
				{
					$dist_flag = false;
					$msg = "该分类未授权";
				}
			}	
		}
		

		if ($goods_id && $dist_flag)
		{
			if($common_base['common_is_virtual'] != $Goods_CommonModel::GOODS_VIRTUAL)
			{
				$shop_id = $goods_base['shop_id'];

				//判断购物车中是否存在该商品
				$cart_cond             = array();
				$cart_cond['user_id']  = $user_id;
				$cart_cond['shop_id']  = $shop_id;
				$cart_cond['goods_id'] = $goods_id;
				$cart_row              = current($this->cartModel->getByWhere($cart_cond));
				$msg                   = '';


				//查询该用户是否已购买过该商品
				$Order_GoodsModel = new Order_GoodsModel();
				$order_goods_cond['common_id']             = $goods_base['common_id'];
				$order_goods_cond['buyer_user_id']         = $user_id;
				$order_goods_cond['order_goods_status:!='] = Order_StateModel::ORDER_REFUND_FINISH;
				$order_list                                = $Order_GoodsModel->getByWhere($order_goods_cond);

				$order_goods_count         = count($order_list);

				//如果有限购数量就计算还剩多少可购买的商品数量

				$limit_num = $common_base['common_limit'];
				if($common_base['common_limit'])
				{
					$limit_num = $common_base['common_limit'] - $order_goods_count;
					$limit_num = $limit_num < 0 ? 0:$limit_num;
				}

				if ($cart_row)
				{
					//判断商品的个人购买数
					if (($cart_row['goods_num'] >= $limit_num || $cart_row['goods_num'] + $goods_num > $limit_num) && $common_base['common_limit'] != 0)
					{
						$flag = false;
						$msg  = sprintf(_('每人最多可购买%s件该商品'), $common_base['common_limit']);
					}
					else
					{
					    if($goods_num==1&&$cart_row['goods_num']==1){
                            $flag     = 1;
                        }else{
                            $edit_row = array('goods_num' => $goods_num);
                            $flag     = $this->cartModel->editCart($cart_row['cart_id'], $edit_row, true);
                        }
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

                    $flag    = $this->cartModel->addCart($add_row, true);
					$cart_id = $flag;
				}
			}
			else
			{
				$flag = false;
				$cart_id = $flag;
			}


		}
        else if ($bl_id)
        {
            $bundling_BaseModel = new Bundling_BaseModel();
            $bundling = $bundling_BaseModel -> getOne($bl_id);

            //判断购物车中是否存在该商品
            $cart_cond             = array();
            $cart_cond['user_id']  = $user_id;
            $cart_cond['shop_id']  = $bundling['shop_id'];;
            $cart_cond['bl_id']    = $bl_id;
            $cart_row              = $this->cartModel->getOneByWhere($cart_cond);

            if($cart_row)
            {
                $cart_id = $flag = $cart_row['cart_id'];
            }
            else
            {
                //套装 加入购物车
                $add_row['goods_id']   = '0';
                $add_row['shop_id'] = $bundling['shop_id'];
                $add_row['user_id']   = $user_id;
                $add_row['bl_id']   = $bl_id;
                $add_row['goods_num']   = '1';

                $cart_id = $flag  = $this->cartModel->addCart($add_row, true);
            }
        }
		else
		{
			$flag = false;
		}


		if ($flag)
		{
			$status = 200;
			$msg    = $msg ? $msg : _('加入成功');
		}
		else
		{
			$status = 250;
			$msg    = $msg ? $msg : _('加入失败');
		}
		$data = array(
			'flag' => $flag,
			'msg' => $msg,
			'cart_id' => $cart_id
		);

		$this->data->addBody(-140, $data, $msg, $status);
		return $data;
	}

	//获取购物车中的数量
	public function getCartGoodsNum()
	{
		$user_id = Perm::$row['user_id'];
		$cond_row = array('user_id' => $user_id);

		$CartModel = new CartModel();
		$count  = $CartModel->getCartGoodsNum($cond_row);
		$data[] = $count;
		$data['cart_count'] = $count;

		$this->data->addBody(-140, $data);
	}

    /**
     * 确认订单信息后生成订单(门店自提)
     *
     * @author WenQingTeng
     */
    public function confirmChain()
    {
        $nums     = 1;
        $goods_id = request_int('goods_id');
        $chain_id = request_int('chain_id');

        //获取门店商品的信息
        $data = $this->cartModel->getVirtualCart($goods_id, $nums);

        $user_id = Perm::$userId;
        //获取用户的折扣信息
        $User_InfoModel = new User_InfoModel();
        $user_info      = $User_InfoModel->getOne($user_id);

        $User_GradeModel = new User_GradeModel();
        $user_grade      = $User_GradeModel->getOne($user_info['user_grade']);
        $user_rate       = $user_grade['user_grade_rate'];

        if($data['mansong_info'] && $data['mansong_info']['rule_discount'])
        {
            $data['total_price'] = number_format($data['sumprice'] - $data['mansong_info']['rule_discount'],2,'.','');
        }
        else
        {
            $data['total_price'] = $data['sumprice'];
        }

        if(!Web_ConfigModel::value('rate_service_status') ||(Web_ConfigModel::value('rate_service_status') && $data['goods_common']['shop_self_support']))
        {
            $data['user_rate'] = $user_rate;
        }
        else
        {
            $data['user_rate'] = 100;
        }



        if($data['user_rate'] < 100)
        {
            $data['rate_price'] = number_format($data['total_price']*(100 - $data['user_rate'])/100,2);
            $data['total_price'] -= $data['rate_price'];
        }


        //获取门店信息
        $Chain_BaseModel = new Chain_BaseModel();
        $chain_base = current($Chain_BaseModel->getByWhere(array('chain_id'=>$chain_id)));

        if ( $this->typ == 'json' )
        {
            $this->data->addBody(-140, $data);
        }
        else
        {
            include $this->view->getView();
        }
    }

}

?>