<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Buyer_Service_ReturnCtl extends Buyer_Controller
{
	public $orderReturnModel       = null;
	public $orderBaseModel         = null;
	public $orderGoodsModel        = null;
	public $orderReturnReasonModel = null;

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
		$this->orderReturnModel       = new Order_ReturnModel();
		$this->orderBaseModel         = new Order_BaseModel();
		$this->orderGoodsModel        = new Order_GoodsModel();
		$this->orderReturnReasonModel = new Order_ReturnReasonModel();
	}

	/**
	 * 退款/退货 新增页面 详细页面 列表页面
	 */
	public function index()
	{
        $act = request_string('act');

        if ($act == "add")
        {
            $data = $this->add();

            if($this->typ == 'json')
            {
                $this->data->addBody(-140,$data,$data['msg'],$data['status']);
            }
            else
            {
                if($data['status'] == 200)
                {
                    $this->view->setMet('add');
                    include $this->view->getView();
                }
                else
                {
                    location_go_back($data['msg']);
                }
            }
        }
        else if ($act == "detail")
        {
            $data = $this->detail();
            if ($this->typ == "json")
            {
                $this->data->addBody(-140, $data);
            }
            else
            {
                if($data)
                {
                    $this->view->setMet('detail');
                    include $this->view->getView();
                }
                else
                {
                    location_to(YLB_Registry::get('url').'?ctl=Buyer_Service_Return&met=index');
                }
            }
        }
        else
        {
            $YLB_Page = new YLB_Page();
            $page     = request_int('page',1);
            $rows     = request_int('rows',$YLB_Page->listRows);

            $start_time = request_string("start_time");
            $end_time   = request_string("end_time");
            $order_id   = request_string("order_id");
            $state      = request_int("state", 1);

            $cond_row['buyer_user_id'] = Perm::$userId;
            if ($start_time)
            {
                $cond_row['return_add_time:>='] = $start_time;
            }
            if ($end_time)
            {
                $cond_row['return_add_time:<='] = $end_time;
            }
            if ($order_id)
            {
                $cond_row['order_number'] = $order_id;
            }
            if ($state)
            {
                $cond_row['return_type'] = $state;
            }

            $data = $this->orderReturnModel->getReturnList($cond_row, array('return_add_time' => 'DESC'), $page, $rows);

            if ($this->typ == "json")
            {
                if($data['items'])
                {
                    $new_items = array();
                    foreach ($data['items'] as $key => $value)
                    {
                        $row['order_return_id']     = $value['order_return_id'];
                        $row['return_cash']         = $value['return_cash'];
                        $row['order_number']        = $value['order_number'];
                        $row['order_amount']        = $value['order_amount'];
                        $row['return_type']         = $value['return_type'];
                        $row['return_code']         = $value['return_code'];
                        $row['seller_user_id']      = $value['seller_user_id'];
                        $row['seller_user_account'] = $value['seller_user_account'];
                        $row['return_add_time']     = $value['return_add_time'];
                        $row['order_goods_id']      = $value['order_goods_id'];
                        $row['order_goods_name']    = $value['order_goods_name'];
                        $row['order_goods_price']   = $value['order_goods_price'];
                        $row['order_goods_pic']     = $value['order_goods_pic'];
                        $row['order_goods_num']     = $value['order_goods_num'];
                        $row['return_state_con']    = $value['return_state_con'];

                        $new_items[] = $row;
                    }
                    $data['items'] = $new_items;
                }
                $this->data->addBody(-140, $data);
            }
            else
            {
                $YLB_Page->nowPage    = $page;
                $YLB_Page->listRows   = $rows;
                $YLB_Page->totalPages = $data['total'];
                $data['page']         = $YLB_Page->promptII();
                include $this->view->getView();
            }
        }
	}

    /**
     * 新增退款/退货 页面
     *
     * @return mixed
     */
    public function add()
    {
        $order_id       = request_string("oid");
        $order_goods_id = request_int("gid",0);
        $status         = 200;
        $msg            = 'success';

        //如果有$order_goods_id 视为申请退货
        if($order_goods_id)
        {
            //退货

            //获取要退货的商品
            $order_goods   = $this->orderGoodsModel->getOne($order_goods_id);
            //获取订单
            $data['order'] = $this->orderBaseModel->getOne($order_goods['order_id']);

            if($data['order']['buyer_user_id'] == Perm::$userId && $data['order']['order_type'] != Order_BaseModel::ORDER_SP)
            {
                if ($data['order']['order_status'] < Order_StateModel::ORDER_WAIT_CONFIRM_GOODS)
                {
                    $status = 250;
                    $msg  = '商家发货后才能申请退款';
                }
                else
                {
                    $data['goods'][]      = $order_goods;
                    $data['return_cash']  = $order_goods['order_goods_amount'] * 1;
                    $data['nums']         = $order_goods['order_goods_num'];
                    $data['return_goods'] = 1;
                    $data['text']         = '退货';

                    //检测当前商品是否在退货中
                    $return = $this->orderReturnModel->getKeyByWhere(array('order_goods_id' => $order_goods_id));

                    //如果存在 跳转到退货详情
                    if($return)
                    {
                        $status = 250;
                        $msg  = '正在退货中';

                        unset($data);
                    }
                }
            }
            else
            {
                //该订单买家不是登录人
                $status = 250;
                $msg  = '订单异常';
            }
        }
        else if($order_id)
        {
            //退款

            //获取订单
            $data['order'] = $this->orderBaseModel->getOne($order_id);
            if($data['order']['buyer_user_id'] == Perm::$userId && $data['order']['order_type'] != Order_BaseModel::ORDER_SP)
            {
                if ($data['order']['order_status'] < Order_StateModel::ORDER_PAYED)
                {
                    $status = 250;
                    $msg    = '付款后才能申请退款';
                }
                else
                {
                    if($data['order']['order_payment_amount'] > 0 )
                    {
                        //获取订单商品
                        $data['goods']        = $this->orderGoodsModel->getByWhere(array('order_id'=>$order_id));
                        //$data['return_cash']  = $data['order']['order_goods_amount'];
                        $data['return_goods'] = 0;
                        $data['text']         = '退款';

                        //如果没有发货，可以退运费
                        if ($data['order']['order_status'] == Order_StateModel::ORDER_PAYED)
                        {
                            $data['return_cash'] = $data['order']['order_payment_amount'] * 1;
                        }
                        else
                        {
                            $data['return_cash'] = $data['order']['order_payment_amount'] - $data['order']['order_shipping_fee'];
                        }

                        //检测当前订单是否在退款中
                        $return = $this->orderReturnModel->getKeyByWhere(array('order_number' => $order_id,'order_goods_id' => 0));
                        if($return)
                        {
                            $status = 250;
                            $msg  = '正在退款中';

                            unset($data);
                        }
                        else
                        {
                            //检测当前订单是否有退货中的
                            $return = $this->orderReturnModel->getByWhere(array('order_number' => $order_id,'order_goods_id:>' => 0));
                            if($return)
                            {
                                $data['refunding_price'] = array_sum(array_column($return, 'return_cash'));
                                $data['return_cash'] -= $data['refunding_price'];
                            }

                            if($data['return_cash'] <= 0)
                            {
                                $status = 250;
                                $msg    = '该订单已退货完成';
                            }
                        }
                    }
                    else
                    {
                        $status = 250;
                        $msg = '退款金额异常';
                    }
                }
            }
            else
            {
                //该订单买家不是登录人
                $status = 250;
                $msg  = '订单异常';
            }
        }
        else
        {
            $status = 250;
            $msg    = 'fail';
        }

        if($status == 200)
        {
            $data['order_id'] = $order_id;
            $data['goods_id'] = $order_goods_id;

            //获取退款原因
            $data['reason'] = $this->orderReturnReasonModel->getByWhere(array(), array('order_return_reason_sort' => 'ASC'));
        }

        $data['msg']    = $msg;
        $data['status'] = $status;

        return $data;
    }

    /**
     * 退款退货详情 页面
     *
     * @return array
     */
    public function detail()
    {
        $cond_row['buyer_user_id'] = Perm::$userId;

        $order_id = request_string('oid');
        if($order_id)
        {
            $cond_row['order_number'] = $order_id;
            $cond_row['order_goods_id'] = request_int('ogid',0);
        }
        else
        {
            $cond_row['order_return_id'] = request_int("id");
        }
        $data = $this->orderReturnModel->getReturn($cond_row);

        if($data)
        {
            $return_express = 0; //买家可发货标识
            $return_plat    = 0; //买家可申诉标识

            if ($data['order_goods_id'])
            {
                $data['goods'] = $this->orderGoodsModel->getOne($data['order_goods_id']);
                $data['text']  = _("退货");

                //如果商家已同意退货
                //或商家不同意退货但买家申诉通过
                //--买家发货给商家 调取物流公司信息
                if($data['return_shop_state'] == Order_ReturnModel::RETURN_SELLER_PASS || $data['return_platform_state'] == Order_ReturnModel::PLAT_PASS)
                {
                    $return_express = 1;

                    $ExpressModel = new ExpressModel();
                    $express = $ExpressModel->getExpressList(array('express_status' => 1), array('express_commonorder' => 'desc'));
                    if($express['items'])
                    {
                        $data['express'] = $express['items'];
                    }
                }
            }
            else
            {
                $data['text'] = _("退款");
            }

            if($data['return_shop_state'] == Order_ReturnModel::RETURN_SELLER_UNPASS && $data['return_platform_state'] == Order_ReturnModel::PLAT_NO)
            {
                $return_plat = 1;
            }

            if($data['return_platform_state'] == Order_ReturnModel::RETURN_SELLER_UNPASS && $data['return_recheck_state'] == Order_ReturnModel::PLAT_NO)
            {
                $return_plat = 1;
            }

            if($data['return_collect_state'] == Order_ReturnModel::PLAT_UNPASS && $data['return_recheck_state'] == Order_ReturnModel::PLAT_NO)
            {
                $return_plat = 1;
            }

            //供应商的退款单 商家在买家中心查看的时候 只能查看 不能申诉
            if($data['seller_status'] == Order_ReturnModel::SELLER_STATUS_2)
            {
                $return_plat = 0;
            }

            $data['return_express'] = $return_express;
            $data['return_plat'] = $return_plat;

            if($this->typ != 'json')
            {
                $data['order'] = $this->orderBaseModel->getOne($data['order_number']);
            }
        }

        return $data;
    }

    /**
     * 新增退款/退货
     */
    public function addReturn()
    {
        $order_id       = request_string("order_id");   //退款订单号
        $order_goods_id = request_int("goods_id");      //退货订单商品id 不是商品的goods_id
        $return_cash    = request_float("return_cash"); //申请退货/退款金额
        $nums           = request_int("nums",0);

        $status         = 200;
        $msg            = 'success';

        //如果有$order_goods_id 视为申请退货
        $goods_parent_id = 0;
        if($order_goods_id)
        {
            //退货
            //获取要退货的商品
            $order_goods     = $this->orderGoodsModel->getOne($order_goods_id);
            $order_id        = $order_goods['order_id'];
            $goods_parent_id = $order_goods['goods_parent_id'];

            //获取订单
            $order_base = $this->orderBaseModel->getOne($order_id);
            if($order_base['buyer_user_id'] == Perm::$userId && $order_base['order_type'] != Order_BaseModel::ORDER_SP)
            {
                if ($order_base['order_status'] < Order_StateModel::ORDER_WAIT_CONFIRM_GOODS)
                {
                    $status = 250;
                    $msg  = '商家发货后才能申请退款';
                }
                else
                {
                    //检测当前商品是否在退货中
                    $return = $this->orderReturnModel->getKeyByWhere(array('order_goods_id' => $order_goods_id));

                    //如果存在 跳转到退货详情
                    if($return)
                    {
                        $status = 250;
                        $msg  = '正在退货中';
                    }
                    else
                    {
                        //比对传过来的退货数量/退货金额与订单是否符合
                        if($nums == $order_goods['order_goods_num'])
                        {
                            if($return_cash != $order_goods['order_goods_amount'])
                            {
                                $status = 250;
                                $msg    = '退货金额与订单商品金额不符';
                            }
                        }
                        else if($nums < $order_goods['order_goods_num'])
                        {
                            $price = $order_goods['order_goods_payment_amount'] * $nums;

                            if($return_cash != $price)
                            {
                                $status = 250;
                                $msg    = '退货金额与订单商品金额不符';
                            }
                        }
                        else
                        {
                            $status = 250;
                            $msg    = '退货数量与订单商品数量不符';
                        }

                        if($status == 200)
                        {
                            $field['order_goods_id']      = $order_goods_id;                    //订单商品id
                            $field['order_goods_name']    = $order_goods['goods_name'];         //退货商品名称
                            $field['order_goods_price']   = $order_goods['goods_price'];        //商品单价
                            $field['order_goods_pic']     = $order_goods['goods_image'];        //商品图片
                            $field['return_goods_return'] = 1;    //需要退货
                            $field['return_type']         = Order_ReturnModel::RETURN_TYPE_GOODS;   //类型 - 退货

                            //退还交易佣金
                            if ($order_base['order_commission_fee'] && $order_goods['order_goods_commission'])
                            {
                                $field['return_commision_fee'] = number_format(($order_goods['order_goods_commission'] * $nums)/$order_goods['order_goods_num'],2,'.','');
                            }
                        }
                    }
                }
            }
            else
            {
                $status = 250;
                $msg  = '订单异常';
            }
        }
        else if($order_id)
        {
            //退款
            //获取订单
            $order_base = $this->orderBaseModel->getOne($order_id);
            if($order_base['buyer_user_id'] == Perm::$userId && $order_base['order_type'] != Order_BaseModel::ORDER_SP)
            {
                if ($order_base['order_status'] < Order_StateModel::ORDER_PAYED)
                {
                    $status = 250;
                    $msg    = '付款后才能申请退款';
                }
                else
                {
                    //检测当前订单是否在退款中
                    $return = $this->orderReturnModel->getKeyByWhere(array('order_number' => $order_id,'order_goods_id' => 0));
                    if($return)
                    {
                        $status = 250;
                        $msg  = '正在退款中';
                    }
                    else
                    {
                        //如果没有发货，可以退运费
                        if ($order_base['order_status'] == Order_StateModel::ORDER_PAYED)
                        {
                            $return_limit = $order_base['order_payment_amount'];
                        }
                        else
                        {
                            $return_limit = $order_base['order_payment_amount'] - $order_base['order_shipping_fee'];
                        }

                        //检测当前订单是否有退货中的
                        $return = $this->orderReturnModel->getByWhere(array('order_number' => $order_id,'order_goods_id:>' => 0));
                        if($return)
                        {
                            $refunding_price = array_sum(array_column($return, 'return_cash'));
                            $return_limit -= $refunding_price;
                        }

                        if($return_cash > $return_limit)
                        {
                            $status = 250;
                            $msg  = '退款金额异常';
                        }
                        else
                        {
                            $field['return_type'] = Order_ReturnModel::RETURN_TYPE_ORDER;   //类型-退款

                            //退还交易佣金
                            if ($order_base['order_commission_fee'])
                            {
                                $field['return_commision_fee'] = number_format(($return_cash/$return_limit) * $order_base['order_commission_fee'],2,'.','');
                            }
                        }
                    }
                }
            }
            else
            {
                $status = 250;
                $msg  = '订单异常';
            }
        }

        if($status == 200)
        {
            $field['return_shop_state']   = Order_ReturnModel::RETURN_WAIT_PASS;
            $field['order_number']        = $order_id;                           //订单号
            $field['order_amount']        = $order_base['order_payment_amount']; //订单实际支付金额
            $field['seller_user_id']      = $order_base['shop_id'];              //店铺id
            $field['seller_user_account'] = $order_base['shop_name'];            //店铺名称
            $field['buyer_user_id']       = $order_base['buyer_user_id'];        //买家id
            $field['buyer_user_account']  = $order_base['buyer_user_name'];      //买家名称
            $field['return_add_time']     = get_date_time();                     //退款、退货申请提交时间
            $field['order_is_virtual']    = $order_base['order_is_virtual'];     //该笔订单是否为虚拟订单
            $field['shop_id']             = $order_base['shop_id'];
            $field['shop_class_id']       = $order_base['shop_class_id'];
            $field['payment_time']        = $order_base['payment_time'];
            if($order_base['order_type'] == Order_BaseModel::ORDER_DIS || $order_base['order_type'] == Order_BaseModel::ORDER_CHILD_DIS )
            {
                //标记一下 此退款单 商家不能直接操作 只能供应商操作后--->再系统自动操作
                $field['seller_status'] = Order_ReturnModel::SELLER_STATUS_0;
            }

            $Number_SeqModel      = new Number_SeqModel();
            $prefix               = sprintf('%s-%s-', YLB_Registry::get('shop_app_id'), date('Ymd'));
            $return_number        = $Number_SeqModel->createSeq($prefix);
            $field['return_code'] = sprintf('%s-%s-%s-%s', 'TD', Perm::$userId, 0, $return_number);

            $field['return_cash']      = $return_cash;                     //退款/货金额
            $field['order_goods_num']  = $nums;                            //退款/货数量
            $field['return_reason_id'] = request_int("return_reason_id");  //退款/货原因id
            $field['return_reason']    = request_string('return_reason');//退货原因
            $field['return_message']   = request_string("return_message"); //退款/货说明
            //有违禁词
            if (Text_Filter::checkBanned($field['return_message']))
            {
                $this->data->addBody(-140, array(), '含有违禁词', 250);
                return false;
            }

            //如果使用了平台红包
            if($order_base['order_rpt_price'])
            {
                $field['return_rpt_cash'] = number_format($return_cash/$order_base['order_payment_amount'] * $order_base['order_rpt_price'],2,'.','');
            }

            $rs_row = array();
            $this->orderReturnModel->sql->startTransactionDb();
            $add_id = $this->orderReturnModel->addReturn($field,true);

            if($add_id)
            {
                $add_flag = true;
            }
            else
            {
                $add_flag = false;
            }
            check_rs($add_flag, $rs_row);

            if($add_flag)
            {
                if ($order_goods_id)
                {
                    //修改订单商品状态 为退货中
                    $goods_field['goods_refund_status'] = Order_GoodsModel::REFUND_IN;
                    $edit_flag                          = $this->orderGoodsModel->editGoods($order_goods_id, $goods_field);
                    check_rs($edit_flag, $rs_row);

                    //修改订单状态 为退货中
                    $order_field['order_return_status'] = Order_GoodsModel::REFUND_IN;
                }
                else
                {
                    //修改订单状态 为退款中
                    $order_field['order_refund_status'] = Order_BaseModel::REFUND_IN;
                }
                $edit_flag                          = $this->orderBaseModel->editBase($order_id, $order_field);
                check_rs($edit_flag, $rs_row);

                //若果存在分销商采购单，添加退款订单，改变购物订单状态
                if($order_base['order_type'] == Order_BaseModel::ORDER_DIS || $order_base['order_type'] == Order_BaseModel::ORDER_CHILD_DIS)
                {
                    $dist_flag = $this->addDistReturn($order_id,$return_cash,$field['return_reason_id'],$field['return_reason'],$field['return_message'],$goods_parent_id,$add_id);
                    check_rs($dist_flag, $rs_row);
                }
            }
            else
            {
                $msg = '提交失败';
            }

            $flag = is_ok($rs_row);
            if ($flag && $this->orderReturnModel->sql->commitDb())
            {
                //退款/退货提醒
                /*$message = new MessageModel();
                if ($order_goods_id)
                {
                    $message->sendMessage('Refund reminder',$field['seller_user_id'], $field['seller_user_account'], $order_id, $shop_name = NULL, 1, 1);
                }
                else
                {
                    $message->sendMessage('Return reminder',$field['seller_user_id'], $field['seller_user_account'], $order_id, $shop_name = NULL, 1, 1);
                }*/
            }
            else
            {
                $this->orderReturnModel->sql->rollBackDb();
                $msg    = 'failure';
                $status = 250;
            }
        }

        $this->data->addBody(-140, array(), $msg, $status);

    }

    /**
     * 供应商的订单退款/退货
     *
     * @param $order_id          订单id
     * @param $return_cash       退款/退货金额
     * @param $return_reason_id  退款/退货原因id
     * @param $return_reason     退款/退货原因
     * @param $return_message    备注
     * @param $goods_parent_id   供应商商品id
     * @param $return_source_id  原退款单id
     * @return bool              返回true/false
     */
    public function addDistReturn($order_id,$return_cash,$return_reason_id,$return_reason,$return_message,$goods_parent_id,$return_source_id)
    {
        $dist_order = $this->orderBaseModel->getOneByWhere(array('order_type'=>Order_BaseModel::ORDER_SP,'order_source_id'=>$order_id));

        //如果存在订单商品id 即为退货
        if($goods_parent_id)
        {
            $order_goods = $this->orderGoodsModel->getOneByWhere(array('order_id'=>$dist_order['order_id'],'goods_id'=>$goods_parent_id));
            $cond_row['order_goods_id']      = $order_goods['order_goods_id'];     //订单商品id
            $cond_row['order_goods_name']    = $order_goods['goods_name'];         //退货商品名称
            $cond_row['order_goods_price']   = $order_goods['goods_price'];        //商品单价
            $cond_row['order_goods_pic']     = $order_goods['goods_image'];        //商品图片
            $cond_row['return_goods_return'] = 1;    //需要退货
            $cond_row['return_type']         = Order_ReturnModel::RETURN_TYPE_GOODS;   //类型 - 退货

            $order_field['order_return_status'] = Order_GoodsModel::REFUND_IN;
        }
        else
        {
            $cond_row['return_type'] = 1;
            $cond_row['return_goods_return']  = 0;

            //修改订单退款状态 1
            $order_field['order_refund_status'] = Order_BaseModel::REFUND_IN;
        }
        $edit_flag = $this->orderBaseModel->editBase($dist_order['order_id'], $order_field);

        $Number_SeqModel  = new Number_SeqModel();
        $prefix           = sprintf('%s-%s-', YLB_Registry::get('shop_app_id'), date('Ymd'));
        $return_number    = $Number_SeqModel->createSeq($prefix);
        $return_id        = sprintf('%s-%s-%s-%s', 'SPTD', Perm::$userId, 0, $return_number);

        $cond_row['order_number']         = $dist_order['order_id'];
        $cond_row['order_amount']         = $dist_order['order_payment_amount'];
        $cond_row['return_code']          = $return_id;
        $cond_row['seller_user_id']       = $dist_order['shop_id'];
        $cond_row['seller_user_account']  = $dist_order['shop_name'];
        $cond_row['buyer_user_id']        = $dist_order['buyer_user_id'];
        $cond_row['buyer_user_account']   = $dist_order['buyer_user_name'];
        $cond_row['order_goods_pic']      = isset($goods_parent_base)?$goods_parent_base['goods_image']:'';
        $cond_row['return_commision_fee'] = $dist_order['order_commission_fee'];
        $cond_row['return_add_time']      = get_date_time();
        $cond_row['return_reason_id']     = $return_reason_id;
        $cond_row['return_reason']        = $return_reason;
        $cond_row['return_message']       = $return_message;
        $cond_row['return_cash']          = $return_cash;
        $cond_row['seller_status']        = Order_ReturnModel::SELLER_STATUS_2;
        $cond_row['return_source_id']     = $return_source_id;
        $cond_row['shop_id']              = $dist_order['shop_id'];
        $cond_row['shop_class_id']        = $dist_order['shop_class_id'];
        $cond_row['payment_time']         = $dist_order['payment_time'];

        $add_flag = $this->orderReturnModel->addReturn($cond_row, true);

        if($edit_flag && $add_flag)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * 错误页面
     */
    public function error()
    {
        include $this->view->getView();
    }

    /**
     * 平台申诉
     */
    public function addPlat()
    {
        $id = request_int('id');
        $order_return = $this->orderReturnModel->getOne($id);

        if($order_return && $order_return['buyer_user_id'] == Perm::$userId && $order_return['seller_status'] != Order_ReturnModel::SELLER_STATUS_2)
        {
            if(!$order_return['return_platform_state'] && $order_return['return_collect_state'] == 0)
            {
                //首次申诉
                $edit['return_platform_state']    = Order_ReturnModel::PLAT_WAIT_PASS;
                $edit['return_platform_add_time'] = get_date_time();
            }
            else if(!$order_return['return_recheck_state'])
            {
                //二次申诉
                $edit['return_recheck_state']    = Order_ReturnModel::PLAT_WAIT_PASS;
                $edit['return_recheck_add_time'] = get_date_time();
            }
            else
            {
                $this->data->addBody(-140,array(),'',250);return false;
            }

            //开启事物
            $this->orderReturnModel->sql->startTransactionDb();
            $flag = $this->orderReturnModel->editReturn($order_return['order_return_id'],$edit);

            if($order_return['seller_status'] == 0)
            {
                $dis_order_return_id = $this->orderReturnModel->getKeyByWhere(array('return_source_id'=>$order_return['order_return_id']));
                $flag = $this->orderReturnModel->editReturn($dis_order_return_id,$edit);
            }

            if($flag && $this->orderReturnModel->sql->commitDb())
            {
                $status = 200;
                $msg    = _('success');
            }
            else
            {
                $this->orderReturnModel->sql->rollBackDb();
                $status = 250;
                $msg    = _('failure');
            }
        }
        else
        {
            $msg    = 'failure';
            $status = 250;
        }

        $this->data->addBody(-140,array(),$msg,$status);
    }

    /**
     * 取消申诉
     */
    public function closePlat()
    {

    }

    /**
     * 获取物流公司列表
     */
    public function getExpress()
    {
        $ExpressModel = new ExpressModel();
        $data         = $ExpressModel->getExpressList(array('express_status' => 1), array('express_commonorder' => 'desc'));

        $this->data->addBody(-140,$data);
    }

    /**
     * 买家退货 填写发货单号
     */
    public function addReturnShippingCode()
    {
        $id = request_int('id');
        $return_shipping_express_id = request_int('express_id');
        $return_shipping_code = request_int('return_shipping_code');

        $order_return = $this->orderReturnModel->getOne($id);
        //当前退款人id==登录id
        if($order_return['buyer_user_id'] == Perm::$userId)
        {
            if($order_return['return_shop_state'] == Order_ReturnModel::RETURN_SELLER_PASS || $order_return['return_platform_state'] == Order_ReturnModel::PLAT_PASS)
            {
                $edit_row['return_shipping_express_id'] = $return_shipping_express_id;
                $edit_row['return_shipping_code'] = $return_shipping_code;
                $flag = $this->orderReturnModel->editReturn($id,$edit_row);
            }
        }
        else
        {
            $flag = false;
        }

        if($flag)
        {
            $status = 200;
            $msg = 'success';
        }
        else
        {
            $status = 250;
            $msg = '提交失败';
        }
        $this->data->addBody(-140,array(),$msg,$status);
    }









}

?>