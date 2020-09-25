<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * Api接口, 让App等调用
 *
 *
 * @category   Game
 * @package    User
 * @author     WenQingTeng
 * @copyright  Copyright (c) 2017, 温庆腾
 * @version    1.0
 * @todo
 */
class Api_Pay_PayCtl extends Api_Controller
{
    /**
     * 验证API是否正确
     *
     * @access public
     */

    //测试接口
    public function addTest()
    {
        $test = request_string('test');

        $data['form'] = $test;
        $this->data->addBody(-140, $data);
    }

    //根据order_id查找paycenter中的订单信息与支付表信息
    public function getOrderInfo()
    {
        $order_id = request_string('order_id');

        $Union_OrderModel = new Union_OrderModel();
        $data = $Union_OrderModel->getByWhere(array('inorder' => $order_id));

        $this->data->addBody(-140, $data);

    }

    //添加交易订单信息
    public function addConsumeTrade()
    {
        $consume_trade_id     = request_string('consume_trade_id');
        $order_id             = request_string('order_id');
        $buy_id               = request_int('buy_id');
        $buyer_name			  = request_string('buyer_name');
        $seller_id            = request_int('seller_id');
        $seller_name		  = request_string('seller_name');
        $order_state_id       = request_int('order_state_id');
        $order_payment_amount = request_float('order_payment_amount');
        $trade_remark         = request_string('trade_remark');
        $trade_create_time    = request_string('trade_create_time');
        $trade_title		  = request_string('trade_title');
        $app_id               = request_int('from_app_id');
        $order_commission_fee = request_float('order_commission_fee');

        if($order_id && $buy_id && $seller_id)
        {
            //开启事物
            $Consume_TradeModel = new Consume_TradeModel();
            $Consume_TradeModel->sql->startTransactionDb();

            $add_row                         = array();
            $add_row['consume_trade_id']     = $consume_trade_id;
            $add_row['order_id']             = $order_id;
            $add_row['buyer_id']             = $buy_id;
            $add_row['seller_id']            = $seller_id;
            $add_row['order_state_id']       = $order_state_id;
            $add_row['order_payment_amount'] = $order_payment_amount;
            $add_row['trade_type_id']        = Trade_TypeModel::SHOPPING;
            $add_row['trade_remark']         = $trade_remark;
            $add_row['trade_create_time']    = $trade_create_time;
            $add_row['trade_amount']         = $order_payment_amount;
            $add_row['trade_payment_amount'] = $order_payment_amount;
            $add_row['trade_commis_amount']  = $order_commission_fee;
            $add_row['app_id']               = $app_id;

            //1.生成交易订单
            $flag               = $Consume_TradeModel->addTrade($add_row);

            //2.生成合并支付订单
            $uorder      = "U" . date("Ymdhis", time()) . rand(100, 999);  //18位
            $union_add_row = array(
                'union_order_id' => $uorder,
                'inorder' => $order_id,
                'trade_title' => $trade_title,
                'trade_payment_amount' => $order_payment_amount,
                'create_time' => date("Y-m-d H:i:s"),
                'buyer_id' => $buy_id,
                'order_state_id' => Union_OrderModel::WAIT_PAY,
                'app_id' => $app_id,
                'trade_type_id' => Trade_TypeModel::SHOPPING,
            );

            $Union_OrderModel = new Union_OrderModel();
            $Union_OrderModel->addUnionOrder($union_add_row);

            //3.生成交易明细（付款方，收款方）
            $Consume_RecordModel = new Consume_RecordModel();
            $Trade_TypeModel = new Trade_TypeModel();
            $record_add_buy_row                  = array();
            $record_add_buy_row['order_id']      = $order_id;
            $record_add_buy_row['user_id']       = $buy_id;
            $record_add_buy_row['user_nickname'] = $buyer_name;
            $record_add_buy_row['record_money']  = $order_payment_amount;
            $record_add_buy_row['record_date']   = date('Y-m-d');
            $record_add_buy_row['record_year']	 = date('Y');
            $record_add_buy_row['record_month']	 = date('m');
            $record_add_buy_row['record_day']	 = date('d');
            $record_add_buy_row['record_title']  = $Trade_TypeModel->trade_type[Trade_TypeModel::SHOPPING];
            $record_add_buy_row['record_time']   = date('Y-m-d H:i:s');
            $record_add_buy_row['trade_type_id'] = Trade_TypeModel::SHOPPING;
            $record_add_buy_row['user_type']     = 2;	//付款方
            $record_add_buy_row['record_status'] = RecordStatusModel::IN_HAND;

            $Consume_RecordModel->addRecord($record_add_buy_row);

            $record_add_seller_row                  = array();
            $record_add_seller_row['order_id']      = $order_id;
            $record_add_seller_row['user_id']       = $seller_id;
            $record_add_seller_row['user_nickname'] = $seller_name;
            $record_add_seller_row['record_money']  = $order_payment_amount;
            $record_add_seller_row['record_date']   = date('Y-m-d');
            $record_add_seller_row['record_year']   = date('Y');
            $record_add_seller_row['record_month']	= date('m');
            $record_add_seller_row['record_day']    = date('d');
            $record_add_seller_row['record_title']  = $Trade_TypeModel->trade_type[Trade_TypeModel::SHOPPING];
            $record_add_seller_row['record_time']   = date('Y-m-d H:i:s');
            $record_add_seller_row['trade_type_id'] = Trade_TypeModel::SHOPPING;
            $record_add_seller_row['user_type']     = 1;	//收款方
            $record_add_seller_row['record_status'] = RecordStatusModel::IN_HAND;

            $Consume_RecordModel->addRecord($record_add_seller_row);

            if ($flag && $Consume_TradeModel->sql->commitDb())
            {
                $msg    = 'success';
                $status = 200;
                $data = array('union_order' => $uorder);
            }
            else
            {
                $Consume_TradeModel->sql->rollBackDb();
                $m      = $Consume_TradeModel->msg->getMessages();
                $msg    = $m ? $m[0] : _('failure');
                $status = 250;
                $data = array();
            }
        }
        else
        {
            $msg    = _('failure');
            $status = 250;
            $data = array();
        }
        $this->data->addBody(-140, $data, $msg, $status);

    }

    public function autoPay()
    {
        $uorder = request_string('uorder');
        $user_id = request_int('user_id');
        $Union_OrderModel = new Union_OrderModel();
        $uorder_base = $Union_OrderModel->getOne($uorder);
        YLB_Log::log("r1=" . json_encode($uorder_base), YLB_Log::INFO, 'autoPay');
        if($uorder_base && $uorder_base['buyer_id'] == $user_id && $uorder_base['trade_payment_amount'] == 0)
        {
            $Consume_DepositModel = new Consume_DepositModel();
            $rs = $Consume_DepositModel->notifyShop($uorder,$user_id,Payment_ChannelModel::MONEY);
            YLB_Log::log("r2=" . json_encode($rs), YLB_Log::INFO, 'autoPay');
            $status = $rs['status'];
        }
        else
        {
            $status = 250;
        }

        $this->data->addBody(-140, [],'',$status);
    }

    //添加合并支付订单信息pay_union_order
    public function addUnionOrder()
    {
        //生成合并支付订单号
        $uorder      = "U" . date("Ymdhis", time()) . rand(100, 999);  //18位
        $inorder     = request_string('inorder');

        $inorder     = substr($inorder, 0, -1);
        $trade_title = request_string('trade_title');
        $uprice      = request_float('uprice');
        $buyer       = request_int('buyer');
        $app_id      = request_int('from_app_id');

        $add_row = array(
            'union_order_id' => $uorder,
            'inorder' => $inorder,
            'trade_title' => $trade_title,
            'trade_payment_amount' => $uprice,
            'create_time' => date("Y-m-d H:i:s"),
            'buyer_id' => $buyer,
            'order_state_id' => Union_OrderModel::WAIT_PAY,
            'app_id'=>$app_id,
            'trade_type_id' => Trade_TypeModel::SHOPPING,
        );

        $Union_OrderModel = new Union_OrderModel();
        $flag            = $Union_OrderModel->addUnionOrder($add_row);

        if ($flag)
        {
            $msg    = 'success';
            $status = 200;
        }
        else
        {
            $msg    = 'failure';
            $status = 250;
        }

        $data = array('uorder' => $uorder);
        $this->data->addBody(-140, $data, $msg, $status);
    }

    //删除无用的支付订单
    public function delUnionOrder()
    {
        $uorderid = request_string('uorder');

        //开启事物
        $Union_OrderModel = new Union_OrderModel();
        $Union_OrderModel->sql->startTransactionDb();

        //删除交易交易订单
        $Consume_TradeModel = new Consume_TradeModel();
        $uorder = $Union_OrderModel->getOne($uorderid);

        $inorder_row = explode(',',$uorder['inorder']);
        $Consume_TradeModel->remove($inorder_row);

        //删除交易明细
        $Consume_RecordModel = new Consume_RecordModel();
        /*$recorder_row = $Consume_RecordModel->getByWhere(array('order_id:IN' => $inorder_row));
        $recorder_id_row = array_column($recorder_row,'consume_record_id');*/
        $recorder_id_row = $Consume_RecordModel->getKeyByWhere(array('order_id:IN' => $inorder_row));
        $Consume_RecordModel->remove($recorder_id_row);
        //删除单个订单的合并支付订单
        /*$uorder_row = $Union_OrderModel->getByWhere(array('inorder:IN'=>$inorder_row));
        $uorder_id_row = array_column($uorder_row,'union_order_id');*/
        $uorder_id_row = $Union_OrderModel->getKeyByWhere(array('inorder:IN'=>$inorder_row));

        //防止单个订单情况下，多合并支付单与单合并支付单重复
        if(in_array($uorderid,$uorder_id_row))
        {
            unset($uorder_id_row[$uorderid]);
        }

        $Union_OrderModel->remove($uorder_id_row);
        //删除多个订单的合并支付订单
        $flag = $Union_OrderModel->remove($uorderid);

        if ($flag && $Union_OrderModel->sql->commitDb())
        {
            $msg    = 'success';
            $status = 200;
        }
        else
        {
            $Union_OrderModel->sql->rollBackDb();
            $m      = $Union_OrderModel->msg->getMessages();
            $msg    = $m ? $m[0] : _('failure');
            $status = 250;
        }
        $data = array();
        $this->data->addBody(-140, $data, $msg, $status);
    }

    //取消订单
    public function cancelOrder()
    {
        if(request_string('type') == 'row')
        {
            $order_id = request_row('order_id');
        }
        else
        {
            $order_id[] = request_string('order_id');
        }

        $Consume_TradeModel = new Consume_TradeModel();
        //开启事物
        $Consume_TradeModel->sql->startTransactionDb();

        //1.修改订单表（consume_trade）
        $Consume_TradeModel->editTrade($order_id,array('order_state_id' => Union_OrderModel::CANCEL));

        //2.修改交易明细(consume_record)
        $Consume_RecordModel = new Consume_RecordModel();
        /*$record_row = $Consume_RecordModel->getByWhere(array('order_id:IN' => $order_id));
        $record_id_row = array_column($record_row,'consume_record_id');*/
        $record_id_row = $Consume_RecordModel->getKeyByWhere(array('order_id:IN' => $order_id));
        $Consume_RecordModel->editRecord($record_id_row,array('record_status' => RecordStatusModel::RECORD_CANCEL));

        //2.合并支付表
        $Union_OrderModel = new Union_OrderModel();
        /*$union_row = $Union_OrderModel->getByWhere(array('inorder:IN' => $order_id));
        $uorder_id = array_column($union_row,'union_order_id');*/
        $uorder_id = $Union_OrderModel->getKeyByWhere(array('inorder:IN' => $order_id));
        $flag = $Union_OrderModel->editUnionOrder($uorder_id,array('order_state_id' => Union_OrderModel::CANCEL));

        if ($flag && $Consume_TradeModel->sql->commitDb())
        {
            $msg    = 'success';
            $status = 200;
        }
        else
        {
            $Consume_TradeModel->sql->rollBackDb();
            $m      = $Consume_TradeModel->msg->getMessages();
            $msg    = $m ? $m[0] : _('failure');
            $status = 250;
        }
        $data = array();
        $this->data->addBody(-140, $data, $msg, $status);
    }

    //确认收货
    public function confirmOrder()
    {
        if(request_string('type') == 'row')
        {
            $order_id = request_row('order_id');
        }
        else
        {
            $order_id[] = request_string('order_id');
        }

        //1.修改订单表（consume_trade）
        $Consume_TradeModel = new Consume_TradeModel();

        //开启事物
        $Consume_TradeModel->sql->startTransactionDb();

        $Consume_TradeModel->editTrade($order_id,array('order_state_id' => Union_OrderModel::FINISH));

        $consume_trade_row = $Consume_TradeModel->getOne($order_id);

        //2.合并支付表
        $Union_OrderModel = new Union_OrderModel();
        /*$union_row = $Union_OrderModel->getByWhere(array('inorder:IN' => $order_id));
        $uorder_id = array_column($union_row,'union_order_id');*/
        $uorder_id = $Union_OrderModel->getKeyByWhere(array('inorder:IN' => $order_id));
        $Union_OrderModel->editUnionOrder($uorder_id,array('order_state_id' => Union_OrderModel::FINISH));

        //3.交易明细
        $Consume_RecordModel = new Consume_RecordModel();
        /*$record_row = $Consume_RecordModel->getByWhere(array('order_id:IN' => $order_id));
        $record_id_row = array_column($record_row,'consume_record_id');*/
        $record_id_row = $Consume_RecordModel->getKeyByWhere(array('order_id:IN' => $order_id));
        $Consume_RecordModel->editRecord($record_id_row,array('record_status' => RecordStatusModel::RECORD_FINISH));

        $User_ResourceModel = new User_ResourceModel();

        //4.减少买家冻结中的资金
        /*$union_row_buy = current($union_row);
        $card_money = $union_row_buy['union_cards_pay_amount'];
        $money = $union_row_buy['union_money_pay_amount'];
        $user_resource_edit_row = array();
        $user_resource_edit_row['user_money_frozen'] = $money*(-1);
        $user_resource_edit_row['user_recharge_card_frozen'] = $card_money*(-1);
        $User_ResourceModel->editResource($union_row_buy['buyer_id'],$user_resource_edit_row,true);*/

        //5.增加卖家冻结中的资金（冻结金额 = 订单金额 - 佣金 - 退款金额）
        $seller_resource_edit_row = array();
        $seller_resource_edit_row['user_money_frozen'] = $consume_trade_row['order_payment_amount'] - $consume_trade_row['trade_commis_amount'] - $consume_trade_row['trade_refund_amount'];
        //如果不存在卖家信息，就添加一个
        $seller_recource_check = $User_ResourceModel->getOne($consume_trade_row['seller_id']);
        if(!$seller_recource_check)
        {
            $seller_resource_edit_row['user_id'] = $consume_trade_row['seller_id'];
            $flag = $User_ResourceModel->addResource($seller_resource_edit_row);
        }
        else
        {
            if($seller_resource_edit_row['user_money_frozen'] == 0)
            {
                $flag = true;
            }
            else
            {
                $flag = $User_ResourceModel->editResource($consume_trade_row['seller_id'],$seller_resource_edit_row,true);
            }
        }

        if ($flag && $Consume_TradeModel->sql->commitDb())
        {
            $msg    = 'success';
            $status = 200;
        }
        else
        {
            $Consume_TradeModel->sql->rollBackDb();
            $m      = $Consume_TradeModel->msg->getMessages();
            $msg    = $m ? $m[0] : _('failure');
            $status = 250;
        }
        $data = array();
        $this->data->addBody(-140, $data, $msg, $status);
    }

    //退款(虚拟商品过期,同时添加买家卖家流水)
    public function refundTransfer()
    {
        $date = array();

        $user_id  = request_int('user_id');  //收款人
        $user_name = request_string('user_account');
        $seller_id = request_int('seller_id');		//付款人
        $seller_name = request_string('seller_account');
        $amount   = request_float('amount');        //付款金额
        $reason   = request_string('reason', '退款');  //付款说明
        $order_id = request_string('order_id');
        $goods_id = request_int('goods_id');
        $uorder_id = request_string('uorder_id');

        $str = '';
        if($goods_id)
        {
            $str = "，商品id:" . $goods_id;
        }

        //交易明细表
        $Consume_RecordModel = new Consume_RecordModel();
        //开启事务
        $Consume_RecordModel->sql->startTransactionDb();

        //用户资源表
        $User_ResourceModel = new User_ResourceModel();

        //合并支付表
        $Union_OrderModel = new Union_OrderModel();

        if ($amount < 0)
        {
            $flag   = false;
            $date[] = '退款金额错误';
        }
        else
        {
            $time    = time();
            $flow_id = time();

            //插入收款方的交易记录
            $record_add_buy_row                  = array();
            $record_add_buy_row['order_id']      = $flow_id;
            $record_add_buy_row['user_id']       = $user_id;
            $record_add_buy_row['user_nickname'] = $user_name;
            $record_add_buy_row['record_money']  = $amount;
            $record_add_buy_row['record_date']   = date('Y-m-d');
            $record_add_buy_row['record_year']	   = date('Y');
            $record_add_buy_row['record_month']	= date('m');
            $record_add_buy_row['record_day']		=date('d');
            $record_add_buy_row['record_title']  = $reason;
            $record_add_buy_row['record_desc']  = "订单号:" . $order_id . $str;
            $record_add_buy_row['record_time']   = date('Y-m-d H:i:s');
            $record_add_buy_row['trade_type_id'] = Trade_TypeModel::REFUND;
            $record_add_buy_row['user_type']     = 1;	//收款方
            $record_add_buy_row['record_status'] = RecordStatusModel::RECORD_FINISH;

            $Consume_RecordModel->addRecord($record_add_buy_row);


            $record_add_seller_row                  = array();
            $record_add_seller_row['order_id']      = $flow_id;
            $record_add_seller_row['user_id']       = $seller_id;
            $record_add_seller_row['user_nickname'] = $seller_name;
            $record_add_seller_row['record_money']  = $amount;
            $record_add_seller_row['record_date']   = date('Y-m-d');
            $record_add_seller_row['record_year']	   = date('Y');
            $record_add_seller_row['record_month']	= date('m');
            $record_add_seller_row['record_day']		=date('d');
            $record_add_seller_row['record_title']  = $reason;
            $record_add_seller_row['record_desc']  = "订单号:" . $order_id . "，商品id:" . $goods_id;
            $record_add_seller_row['record_time']   = date('Y-m-d H:i:s');
            $record_add_seller_row['trade_type_id'] = Trade_TypeModel::REFUND;
            $record_add_seller_row['user_type']     = 2;	//付款方
            $record_add_seller_row['record_status'] = RecordStatusModel::RECORD_FINISH;

            $Consume_RecordModel->addRecord($record_add_seller_row);

            //在订单表中增加退款金额
            $Consume_TradeModel = new Consume_TradeModel();
            $edit_trade_row['trade_refund_amount'] = $amount;
            $Consume_TradeModel->editTrade($order_id,$edit_trade_row,true);

            //查找合并单中的付款情况，购物卡优先退款
            $uorder_base = $Union_OrderModel->getOne($uorder_id);

            $card_return_amount = 0;

            //使用购物卡支付并且购物卡的退款金额小于支付金额时
            if(($uorder_base['union_cards_pay_amount'] > 0) && ($uorder_base['union_cards_return_amount'] < $uorder_base['union_cards_pay_amount']))
            {
                $card_can_return_amount = $uorder_base['union_cards_pay_amount'] - $uorder_base['union_cards_return_amount'];
                //购物卡中可退款金额小于退款金额
                if($card_can_return_amount <= $amount)
                {
                    $card_return_amount = $card_can_return_amount;
                }else
                {
                    $card_return_amount = $amount;
                }

                $amount = $amount - $card_return_amount;
            }

            //扣除购物卡的退款之后全部退还到账户余额中
            $edit_union_row = array();
            $edit_union_row['union_cards_return_amount'] = $card_return_amount;
            $edit_union_row['union_money_return_amount'] = $amount;
            $flag1 = $Union_OrderModel->editUnionOrder($uorder_id,$edit_union_row,true);

            $user_resource = current($User_ResourceModel->getResource($user_id));

            if ($flag1)
            {
                //修改收款方的金额
                $user_resource_row['user_recharge_card'] = $user_resource['user_recharge_card'] + $card_return_amount;
                $user_resource_row['user_money'] = $user_resource['user_money'] + $amount;
                $flag                            = $User_ResourceModel->editResource($user_id, $user_resource_row);
            }
            else
            {
                $flag = false;
            }

        }

        if ($flag && $Consume_RecordModel->sql->commitDb())
        {
            $msg    = 'success';
            $status = 200;
        }
        else
        {
            $Consume_RecordModel->sql->rollBackDb();
            $m      = $Consume_RecordModel->msg->getMessages();
            $msg    = $m ? $m[0] : 'failure';
            $status = 250;
        }
        $this->data->addBody(-140, $date, $msg, $status);
    }

    //同意退款（只增加买家的流水）
    public function refundBuyerTransfer()
    {
        $data = array();

        $user_id     = request_int('user_id');              //收款人
        $user_name   = request_string('user_account');
        $seller_id   = request_int('seller_id');		     //付款人
        $seller_name = request_string('seller_account');
        $amount      = request_float('amount');             //付款金额
        $reason      = request_string('reason', '退款');    //付款说明
        $order_id    = request_string('order_id');
        $goods_id    = request_int('goods_id');
        $uorder_id   = request_string('uorder_id');
        $payment_id  = request_string('payment_id');
        $return_code = request_string('return_code');

        $str = '';
        if($goods_id)
        {
            $str = "，商品id:" . $goods_id;
        }

        //交易明细表
        $Consume_RecordModel = new Consume_RecordModel();
        //开启事务
        $Consume_RecordModel->sql->startTransactionDb();

        if ($amount < 0)
        {
            $flag   = false;
            $data[] = '退款金额错误';
        }
        else
        {
            //插入收款方的交易记录
            $record_add_buy_row                  = array();
            $record_add_buy_row['order_id']      = $return_code;
            $record_add_buy_row['user_id']       = $user_id;
            $record_add_buy_row['user_nickname'] = $user_name;
            $record_add_buy_row['record_money']  = $amount;
            $record_add_buy_row['record_date']   = date('Y-m-d');
            $record_add_buy_row['record_year']	 = date('Y');
            $record_add_buy_row['record_month']	 = date('m');
            $record_add_buy_row['record_day']	 = date('d');
            $record_add_buy_row['record_title']  = $reason;
            $record_add_buy_row['record_desc']   = "订单号:" . $order_id . $str;
            $record_add_buy_row['record_time']   = date('Y-m-d H:i:s');
            $record_add_buy_row['trade_type_id'] = Trade_TypeModel::REFUND;
            $record_add_buy_row['user_type']     = 1;	//收款方
            $record_add_buy_row['record_status'] = RecordStatusModel::RECORD_FINISH;

            $Consume_RecordModel->addRecord($record_add_buy_row);

            //在订单表中增加退款金额
            $Consume_TradeModel = new Consume_TradeModel();
            $edit_trade_row['trade_refund_amount'] = $amount;
            $Consume_TradeModel->editTrade($order_id,$edit_trade_row,true);

            if($payment_id == 1)//在线支付
            {
                //合并支付表
                $Union_OrderModel = new Union_OrderModel();

                //查找合并单中的付款情况，购物卡优先退款
                $uorder_base = $Union_OrderModel->getOne($uorder_id);

                if($uorder_base && $uorder_base['order_state_id'] > Union_OrderModel::WAIT_PAY)
                {
                    //财付宝/财付宝卡支付 的退款到账户财付宝里
                    if($uorder_base['payment_channel_id'] == Payment_ChannelModel::MONEY || $uorder_base['payment_channel_id'] == Payment_ChannelModel::CARDS)
                    {
                        $card_return_amount = 0;
                        //使用购物卡支付并且购物卡的退款金额小于支付金额时
                        if(($uorder_base['union_cards_pay_amount'] > 0) && ($uorder_base['union_cards_return_amount'] < $uorder_base['union_cards_pay_amount']))
                        {
                            $card_can_return_amount = $uorder_base['union_cards_pay_amount'] - $uorder_base['union_cards_return_amount'];
                            //购物卡中可退款金额小于退款金额
                            if($card_can_return_amount <= $amount)
                            {
                                $card_return_amount = $card_can_return_amount;
                            }
                            else
                            {
                                $card_return_amount = $amount;
                            }

                            $amount = $amount - $card_return_amount;
                        }

                        //扣除购物卡的退款之后全部退还到账户余额中
                        $edit_union_row = array();
                        $edit_union_row['union_cards_return_amount'] = $card_return_amount;
                        $edit_union_row['union_money_return_amount'] = $amount;
                        $flag1 = $Union_OrderModel->editUnionOrder($uorder_id,$edit_union_row,true);

                        if ($flag1)
                        {
                            //用户资源表
                            $User_ResourceModel = new User_ResourceModel();
                            $user_resource = current($User_ResourceModel->getResource($user_id));

                            //修改收款方的金额
                            $user_resource_row['user_recharge_card'] = $user_resource['user_recharge_card'] + $card_return_amount;
                            $user_resource_row['user_money'] = $user_resource['user_money'] + $amount;
                            $flag                            = $User_ResourceModel->editResource($user_id, $user_resource_row);
                        }
                        else
                        {
                            $flag = false;
                        }
                    }
                    else
                    {
                        //支付宝/微信退款 原路返回
                        $flag = $this->refund($uorder_base,$return_code,$amount);
                    }
                }
            }
        }

        if ($flag && $Consume_RecordModel->sql->commitDb())
        {
            $msg    = 'success';
            $status = 200;
        }
        else
        {
            $Consume_RecordModel->sql->rollBackDb();
            $m      = $Consume_RecordModel->msg->getMessages();
            $msg    = $m ? $m[0] : 'failure';
            $status = 250;
        }
        $this->data->addBody(-140, $data, $msg, $status);
    }

    //商家发货
    public function sendOrderGoods()
    {
        $order_id = request_string('order_id');

        //1.修改订单表（consume_trade）
        $Consume_TradeModel = new Consume_TradeModel();

        //开启事物
        $Consume_TradeModel->sql->startTransactionDb();

        $Consume_TradeModel->editTrade($order_id,array('order_state_id' => Union_OrderModel::WAIT_CONFIRM_GOODS));

        //2.合并支付表
        $Union_OrderModel = new Union_OrderModel();
        /*$union_row = $Union_OrderModel->getByWhere(array('inorder' => $order_id));
        $uorder_id = array_column($union_row,'union_order_id');*/
        $uorder_id = $Union_OrderModel->getKeyByWhere(array('inorder' => $order_id));
        $flag = $Union_OrderModel->editUnionOrder($uorder_id,array('order_state_id' => Union_OrderModel::WAIT_CONFIRM_GOODS));

        //3.交易明细(将订单的交易明细记录改为状态6--待收货)
        $Consume_RecordModel = new Consume_RecordModel();
        /*$record_row = $Consume_RecordModel->getByWhere(array('order_id' => $order_id));
        $record_id = array_column($record_row,'consume_record_id');*/
        $record_id = $Consume_RecordModel->getKeyByWhere(array('order_id' => $order_id));
        $record_edit_row = array('record_status' => RecordStatusModel::RECORD_WAIT_CONFIRM_GOODS );
        $Consume_RecordModel->editRecord($record_id,$record_edit_row);

        if ($flag && $Consume_TradeModel->sql->commitDb())
        {
            $msg    = 'success';
            $status = 200;
        }
        else
        {
            $Consume_TradeModel->sql->rollBackDb();
            $m      = $Consume_TradeModel->msg->getMessages();
            $msg    = $m ? $m[0] : _('failure');
            $status = 250;
        }
        $data = array();
        $this->data->addBody(-140, $data, $msg, $status);
    }

    //买家申请退货或者退款时生成退款交易明细
    public function returnMoney()
    {
        $buyer_id = request_int('buyer_user_id');
        $buyer_name = request_string('buyer_user_name');
        $seller_id = request_int('seller_user_id');
        $seller_name = request_string('seller_user_name');
        $amount = request_float('amount');

        //生成交易明细（付款方，收款方）
        $Consume_RecordModel = new Consume_RecordModel();
        $Trade_TypeModel = new Trade_TypeModel();
        $record_add_buy_row                  = array();
        $record_add_buy_row['user_id']       = $buyer_id;
        $record_add_buy_row['user_nickname'] = $buyer_name;
        $record_add_buy_row['record_money']  = $amount;
        $record_add_buy_row['record_date']   = date('Y-m-d');
        $record_add_buy_row['record_year']	   = date('Y');
        $record_add_buy_row['record_month']	= date('m');
        $record_add_buy_row['record_day']		=date('d');
        $record_add_buy_row['record_title']  = $Trade_TypeModel->trade_type[Trade_TypeModel::REFUND];
        $record_add_buy_row['record_time']   = date('Y-m-d H:i:s');
        $record_add_buy_row['trade_type_id'] = Trade_TypeModel::REFUND;
        $record_add_buy_row['user_type']     = 1;	//1-收款方 2-付款方
        $record_add_buy_row['record_status'] = RecordStatusModel::IN_HAND;

        $Consume_RecordModel->addRecord($record_add_buy_row);


        $record_add_seller_row                  = array();
        $record_add_seller_row['user_id']       = $seller_id;
        $record_add_seller_row['user_nickname'] = $seller_name;
        $record_add_seller_row['record_money']  = $amount;
        $record_add_seller_row['record_date']   = date('Y-m-d');
        $record_add_seller_row['record_year']	   = date('Y');
        $record_add_seller_row['record_month']	= date('m');
        $record_add_seller_row['record_day']		=date('d');
        $record_add_seller_row['record_title']  = $Trade_TypeModel->trade_type[Trade_TypeModel::REFUND];
        $record_add_seller_row['record_time']   = date('Y-m-d H:i:s');
        $record_add_seller_row['trade_type_id'] = Trade_TypeModel::REFUND;
        $record_add_seller_row['user_type']     = 2;	//收款方
        $record_add_seller_row['record_status'] = RecordStatusModel::IN_HAND;

        $Consume_RecordModel->addRecord($record_add_seller_row);

    }

    /*购买套餐或套餐续费*/
    public function addCombo()
    {
        $buyer_id = request_int('buyer_user_id');
        $buyer_name = request_string('buyer_user_name');
        $amount = request_float('amount');

        //生成交易明细（付款方）
        $Consume_RecordModel = new Consume_RecordModel();
        //开启事物
        $Consume_RecordModel->sql->startTransactionDb();

        $Trade_TypeModel = new Trade_TypeModel();
        $record_add_buy_row                  = array();
        $record_add_buy_row['user_id']       = $buyer_id;
        $record_add_buy_row['user_nickname'] = $buyer_name;
        $record_add_buy_row['record_money']  = $amount;
        $record_add_buy_row['record_date']   = date('Y-m-d');
        $record_add_buy_row['record_year']	   = date('Y');
        $record_add_buy_row['record_month']	= date('m');
        $record_add_buy_row['record_day']		=date('d');
        $record_add_buy_row['record_title']  = $Trade_TypeModel->trade_type[Trade_TypeModel::PAY];
        $record_add_buy_row['record_time']   = date('Y-m-d H:i:s');
        $record_add_buy_row['trade_type_id'] = Trade_TypeModel::PAY;
        $record_add_buy_row['user_type']     = 2;	//1-收款方 2-付款方
        $record_add_buy_row['record_status'] = RecordStatusModel::IN_HAND;

        $flag = $Consume_RecordModel->addRecord($record_add_buy_row);

        if ($flag && $Consume_RecordModel->sql->commitDb())
        {
            $msg    = 'success';
            $status = 200;
        }
        else
        {
            $Consume_RecordModel->sql->rollBackDb();
            $m      = $Consume_RecordModel->msg->getMessages();
            $msg    = $m ? $m[0] : _('failure');
            $status = 250;
        }
        $data = array();
        $this->data->addBody(-140, $data, $msg, $status);

    }

    //店铺结算
    public function shopSettlement()
    {
        $user_id = request_int('user_id');
        $amount = request_float('amount');

        $User_ResourceModel = new User_ResourceModel();
        //获取用户的资金明细
        $user_resource = $User_ResourceModel->getOne($user_id);

        $edit_row = array();
        //商家的账户余额 + 应结金额。
        $edit_row['user_money'] = $user_resource['user_money'] + $amount;

        //判断结算金额是否是正数
        if($amount > 0)
        {
            //如果结算金额大于0，商家冻结资金  - 应结金额。
            $edit_row['user_money_frozen'] = $user_resource['user_money_frozen'] - $amount;
        }

        $flag = $User_ResourceModel->editResource($user_id,$edit_row);

        if($flag)
        {
            $msg    = 'success';
            $status = 200;
        }
        else
        {
            $msg    = 'failure';
            $status = 250;
        }

        $data = array();
        $this->data->addBody(-140, $data, $msg, $status);
    }

	//淘金佣金
    public function directsellerOrder()
    {
		$date     = array();
        $user_id  = request_row('user_id');  //收款人
        $amount   = request_row('user_money');        //付款金额
        $reason   = request_row('reason');  //付款说明
        $order_id = request_row('order_id');
 
        $Consume_RecordModel = new Consume_RecordModel();
        $User_ResourceModel  = new User_ResourceModel();

        if ($amount < 0)
        {
            $flag   = false;
            $date[] = '佣金金额错误';
        }
        else
        {
            //插入收款方的交易记录
            $record_row2 = array(
                'order_id'       => $order_id,
                'user_id'        => $user_id,
                'record_money'   => $amount,
                'record_date'    => date("Y-m-d"),
                'record_year'    => date("Y"),
                'record_month'   => date("m"),
                'record_day'     => date("d"),
                'record_title'   => $reason,
                'record_desc'    => "",
                'record_time'    => date('Y-m-d H:i:s'),
                'trade_type_id'  => '10',
                'user_type'      => '1',
                'record_status'  => RecordStatusModel::RECORD_FINISH,
                'record_paytime' => date('Y-m-d H:i:s'),
            );

            $flag = $Consume_RecordModel->addRecord($record_row2, true);

            if ($flag)
            {
                //修改收款方的金额
                $flag = $User_ResourceModel->editResource($user_id, array('user_money'=>$amount),true);
            }
            else
            {
                $flag = false;
            }

        }

        if ($flag)
        {
            $msg    = 'success';
            $status = 200;
        }
        else
        {
            $msg    = 'failure';
            $status = 250;
        }
        $this->data->addBody(-140, $date, $msg, $status);
    }

    //修改订单金额
    public function editOrderCost()
    {
        $order_id = request_string('order_id');
        $uorder_id = request_string('uorder_id');
        $edit_row = request_row('edit_row');

        //1.修改订单表（consume_trade）
        $Consume_TradeModel = new Consume_TradeModel();

        //开启事物
        $Consume_TradeModel->sql->startTransactionDb();

        $trade_edit_row = array();
        $trade_edit_row['order_payment_amount'] = $edit_row['order_payment_amount'];
        $trade_edit_row['trade_payment_amount'] = $edit_row['order_payment_amount'];
        $trade_edit_row['trade_amount'] = $edit_row['order_payment_amount'];
        $trade_edit_row['trade_commis_amount'] = $edit_row['order_commission_fee'];
        $Consume_TradeModel->editTrade($order_id,$trade_edit_row);

        //2.合并支付表
        $Union_OrderModel = new Union_OrderModel();
        /*$union_row = $Union_OrderModel->getByWhere(array('inorder' => $order_id));
        $uorder_id = array_column($union_row,'union_order_id');*/
        $uorder_id = $Union_OrderModel->getKeyByWhere(array('inorder' => $order_id));
        $Union_OrderModel->editUnionOrder($uorder_id,array('trade_payment_amount' => $edit_row['order_payment_amount']));

        //3.交易明细
        $Consume_RecordModel = new Consume_RecordModel();
        /*$record_row = $Consume_RecordModel->getByWhere(array('order_id' => $order_id));
        $record_id = array_column($record_row,'consume_record_id');*/
        $record_id = $Consume_RecordModel->getKeyByWhere(array('order_id' => $order_id));
        $flag = $Consume_RecordModel->editRecord($record_id,array('record_money' => $edit_row['order_payment_amount']));

        if ($flag && $Consume_TradeModel->sql->commitDb())
        {
            $msg    = 'success';
            $status = 200;
        }
        else
        {
            $Consume_TradeModel->sql->rollBackDb();
            $m      = $Consume_TradeModel->msg->getMessages();
            $msg    = $m ? $m[0] : _('failure');
            $status = 250;
        }
        $data = array();
        $this->data->addBody(-140, $data, $msg, $status);

    }
    
    public function reduceDistMoney(){
    	$Union_OrderModel = new Union_OrderModel();
    	$User_ResourceModel = new User_ResourceModel();
    	
    	$order_id = request_string('uorder');
    	$user_id  = request_int('buyer_id');
    	
    	$Union_OrderModel->sql->startTransactionDb();

		$edit_row = array();
		$edit_row['order_state_id'] = Order_StateModel::ORDER_PAYED;
		$edit_row['pay_time'] = date('Y-m-d H:i:s');

		$Union_OrderModel->editUnionOrder($order_id,$edit_row);

		//修改合并订单中的订单支付状态
		$union_order = $Union_OrderModel->getOne($order_id);
		$inorder = $union_order['inorder'];
		$uorder_id = $order_id;
		$order_id = explode(",",$inorder);
        $order_id = array_filter($order_id);

		//修改单个合并订单状态
		/*$uorder_row = $Union_OrderModel->getByWhere(array('inorder:IN' => $order_id));
		$uorder_id_row = array_column($uorder_row,'union_order_id');*/
        $uorder_id_row = $Union_OrderModel->getKeyByWhere(array('inorder:IN' => $order_id));
		$edit_uorder_row = array();
		$edit_uorder_row['order_state_id'] = Order_StateModel::ORDER_PAYED;
		$edit_uorder_row['pay_time'] = date('Y-m-d H:i:s');

		$Union_OrderModel->editUnionOrder($uorder_id_row,$edit_uorder_row);

		//修改订单表中的交易状态
		$order_edit_row = array();
		$order_edit_row['trade_pay_time'] = date('Y-m-d H:i:s');
		$order_edit_row['order_state_id'] = Order_StateModel::ORDER_PAYED;

		$Consume_TradeModel = new Consume_TradeModel();
		$flag = $Consume_TradeModel->editTrade($order_id,$order_edit_row);


		//修改交易明细中的订单状态
		$Consume_RecordModel = new Consume_RecordModel();
		/*$record_row = $Consume_RecordModel->getByWhere(array('order_id:IN'=> $order_id));
		$record_id_row = array_column($record_row,'consume_record_id');*/
        $record_id_row = $Consume_RecordModel->getKeyByWhere(array('order_id:IN'=> $order_id));
		$edit_consume_record['record_status'] = RecordStatusModel::RECORD_WAIT_SEND_GOODS;
		$edit_consume_record['record_paytime'] = date('Y-m-d H:i:s');
		$Consume_RecordModel->editRecord($record_id_row,$edit_consume_record);

		//修改用户的资源状态

		//用户资源中订单金额冻结(现金)
		$User_ResourceModel->frozenUserMoney($user_id,$union_order['trade_payment_amount']);



		if ($flag && $Union_OrderModel->sql->commitDb())
		{
			$msg = 'success';
			$status  = 200;
		}
		else
		{
			$msg = 'failure';
			$status = 250;
			$Union_OrderModel->sql->rollBackDb();
		}
		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);
    }

    //订单完成7天后 分享立赚转给买家 剩余转给卖家 Zhenzh
    public function editSharePrice()
    {
        $buyer_user_id         = request_string('buyer_user_id');
        $buyer_user_name       = request_string('buyer_user_name');
        $seller_user_id        = request_string('seller_user_id');
        $seller_user_name      = request_string('seller_user_name');
        $share_order_id        = request_string('share_order_id');
        $dz_date               = request_string('dz_date');
        $promotion_unit_price  = request_float('promotion_unit_price');
        $promotion_click_count = request_int('promotion_click_count');
        $promotion_total_price = request_float('promotion_total_price');

        $Consume_RecordModel = new Consume_RecordModel();
        $User_ResourceModel  = new User_ResourceModel();

        $Consume_RecordModel->sql->startTransactionDb();

        //买家增加交易记录
        $user_id = $buyer_user_id;
        $record_money = $promotion_unit_price * $promotion_click_count * 1;
        $cond_row['user_id'] = $user_id;
        $cond_row['user_nickname'] = $buyer_user_name;
        $cond_row['record_money'] = $record_money;
        $cond_row['order_id'] = $share_order_id;
        $cond_row['record_date'] = date('Y-m-d H:i:s',$dz_date);
        $cond_row['record_time'] = date('Y-m-d H:i:s',$dz_date);
        $cond_row['record_year'] = date('Y',$dz_date);
        $cond_row['record_month'] = date('m',$dz_date);
        $cond_row['record_day'] = date('d',$dz_date);
        $cond_row['trade_type_id'] = 8;
        $cond_row['user_type'] = 3;
        $cond_row['record_status'] = 2;
        $cond_row['record_title'] = _("分享立赚");

        $flag = $Consume_RecordModel->addRecord($cond_row);
        if($flag)
        {
            $user_resource = $User_ResourceModel -> getOne($user_id);
            if($user_resource['user_share_money_frozen'] >= $record_money)
            {
                $edit_row['user_share_money_frozen'] = $user_resource['user_share_money_frozen'] - $record_money;
                $edit_row['user_money'] = $edit_row['user_money'] + $record_money ;
                $flag = $User_ResourceModel->editResource($user_id, $edit_row,false);
            }

            //如果分享金有剩余 退还卖家
            if($promotion_total_price > $record_money)
            {
                //买家增加交易记录
                $user_id = $seller_user_id;
                $record_money = $promotion_total_price - $record_money;
                $cond_seller_row['user_id'] = $user_id;
                $cond_seller_row['user_nickname'] = $seller_user_name;
                $cond_seller_row['record_money'] = $record_money;
                $cond_seller_row['order_id'] = $share_order_id;
                $cond_seller_row['record_date'] = date('Y-m-d H:i:s',$dz_date);
                $cond_seller_row['record_time'] = date('Y-m-d H:i:s',$dz_date);
                $cond_seller_row['record_year'] = date('Y',$dz_date);
                $cond_seller_row['record_month'] = date('m',$dz_date);
                $cond_seller_row['record_day'] = date('d',$dz_date);
                $cond_seller_row['trade_type_id'] = 8;
                $cond_seller_row['user_type'] = 3;
                $cond_seller_row['record_status'] = 2;
                $cond_seller_row['record_title'] = _("分享立赚-返还");
                $flag2 = $Consume_RecordModel->addRecord($cond_seller_row);

                if($flag2)
                {
                    $edit_seller_row['user_money'] = $record_money;
                    $flag2 = $User_ResourceModel->editResource($user_id, $edit_seller_row,true);
                }
            }
        }

        if ($flag && $Consume_RecordModel->sql->commitDb())
        {
            $msg    = 'success';
            $status = 200;
        }
        else
        {
            $Consume_RecordModel->sql->rollBackDb();
            $m      = $Consume_RecordModel->msg->getMessages();
            $msg    = $m ? $m[0] : _('failure');
            $status = 250;
        }

        $this->data->addBody(-140, [], $msg, $status);

    }

    //确认收货后的操作--修改分享金冻结资金 后台调用 不能对外使用
    public function editForzenSharePrice()
    {
        $user_id                             = request_int('share_uid');
        $edit_row['user_share_money_frozen'] = request_float('promotion_price');

        $User_ResourceModel = new User_ResourceModel();
        $User_ResourceModel->editResource($user_id, $edit_row,true);
    }

    //统一退款 Zhenzh 20180131
    public function refund($union_order,$return_code,$amount)
    {
        $flag = false;
        if($union_order['payment_channel_id'] == Payment_ChannelModel::WECHAT || $union_order['payment_channel_id'] == Payment_ChannelModel::WECHAT_WAP)
        {
            if($union_order['payment_channel_id'] == Payment_ChannelModel::WECHAT)
            {
                //微信
                $Payment = PaymentModel::create('wx_native');
            }
            else if($union_order['payment_channel_id'] == Payment_ChannelModel::WECHAT_WAP)
            {
                //微信内置浏览器
                $Payment = PaymentModel::create('wx_js');
            }

            $result = $Payment->refund($union_order,$return_code,$amount);

            if($result['return_code'] == 'SUCCESS')
            {
                //退款成功
                $flag = true;
            }
        }
        else if($union_order['payment_channel_id'] == Payment_ChannelModel::ALIPAY || $union_order['payment_channel_id'] == Payment_ChannelModel::ALIPAY_WAP)
        {
            //支付宝
            $Payment = PaymentModel::create('ali');
            $result = $Payment->refund($union_order,$return_code,$amount);

            if($result)
            {
                $result = $this->object_to_array($result);
                if($result['code'] == 10000)
                {
                    YLB_Log::log("r=" . json_encode($result), YLB_Log::INFO, 'zhifubao111');
                    //退款成功
                    $flag = true;
                }
            }
        }

        return $flag;
    }

    function object_to_array($obj) {
        $obj = (array)$obj;
        foreach ($obj as $k => $v) {
            if (gettype($v) == 'resource') {
                return;
            }
            if (gettype($v) == 'object' || gettype($v) == 'array') {
                $obj[$k] = (array)object_to_array($v);
            }
        }

        return $obj;
    }

}

?>