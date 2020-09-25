<?php if (!defined('ROOT_PATH')) {
    exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Order_BaseModel extends Order_Base
{

    const ORDER_IS_VIRTUAL = 1;            //虚拟订单
    const VIRTUAL_USED = 1;                //虚拟订单已使用
    const VIRTUAL_UNUSE = 0;                    //虚拟订单未使用
    const ORDER_IS_REAL = 0;                    //实物订单
    const IS_BUYER_CANCEL = 1;                //买家取消订单
    const IS_SELLER_CANCEL = 2;                //卖家取消订单
    const IS_ADMIN_CANCEL = 3;                //平台取消
	const IS_NOT_SETTLEMENT = 0;                //未结算
	const IS_SETTLEMENT = 1;                    //已结算

    const NO_BUYER_HIDDEN = 0;                //买家不隐藏订单
    const NO_SELLER_HIDDEN = 0;                //卖家不隐藏订单
    const IS_BUYER_HIDDEN = 1;                //买家隐藏订单
    const IS_SELLER_HIDDEN = 1;                //卖家隐藏订单
    const IS_BUYER_REMOVE = 2;                //买家删除订单
    const IS_SELLER_REMOVE = 2;                //卖家删除订单

    const RETURN_ALL = 2;
    const RETURN_SOME = 1;

    const REFUND_NO      = 0;//订单无退款
    const REFUND_IN      = 1;//退款中
    const REFUND_COM     = 2;//退款完成

    //订单取消身份
    const CANCEL_USER_BUYER = 1;
    const CANCEL_USER_SELLER = 2;
    const CANCEL_USER_SYSTEM = 3;

    //买家是否评价
    const BUYER_EVALUATE_NO = 0;
    const BUYER_EVALUATE_YES = 1;


    //买家是否评价
    const SELLER_EVALUATE_NO = 0;
    const SELLER_EVALUATE_YES = 1;

    //订单来源
    const FROM_PC 		= 1;  	//来源于pc端
    const FROM_WAP 		= 2; 	//来源于WAP手机端
    const FROM_APP 	    = 3;    //来源于APP
    const FROM_ANDROID  = 4;    //来源于APP android
    const FROM_IOS      = 5;

    //付款方式 1支付宝 2支付宝WAP 3微信 4微信内部 5 6 7 8
    const ALIPAY     = 1; //支付宝
    const ALIPAY_WAP = 2; //支付宝WAP
    const WECHAT_PAY = 3; //微信
    const WECHAT_WAP = 4; //微信内部
    const TENPAY     = 5; //
    const MONEY      = 6; //
    const CARDS      = 7; //
    const UNIONPAY   = 8; //

    const ORDER_NO_SPLIT  = 0; //主单没拆单
    const ORDER_SPLIT     = 1; //主单有拆单
    const ORDER_DIS       = 2; //主单没拆单但供应商订单
    const ORDER_SP        = 3; //供应商订单
    const ORDER_CHILD     = 4; //子单
    const ORDER_CHILD_DIS = 5; //子单且供应商订单

    //状态
    public static $state = array(
        '1' => 'wait_operate',
        //已出账
        '2' => 'seller_comfirmed',
        //商家已确认
        '3' => 'platform_comfirmed',
        //平台已审核
        '4' => 'finish',
        //结算完成
    );

    public static $orderType = array(
        //虚拟订单
        '0' => 'is_physical',
        //实物订单
        '1' => 'is_virtaul',
    );

    public static $orderEvaluatBuyer = array(
        //买家已评价
        '1' => 'is_evaluated',
        //买家未评价
        '0' => 'is_uevaluate',
    );

    public static $orderEvaluatSeller = array(
        //买家已评价
        '1' => 'is_evaluated',
        //买家未评价
        '0' => 'is_uevaluate',
    );

    public static $paymentChannel = array(
        '1' =>'支付宝',
        '2' =>'支付宝WAP',
        '3' =>'微信',
        '4' =>'微信内部',
        '6' =>'财付宝',
        '7' =>'财付宝卡'
    );

    public function __construct()
    {
        parent::__construct();


        $this->cancelIdentity = array(
            '1' => _('买家'),
            '2' => _('商家'),
            '3' => _('系统'),
        );

        $this->goodsRefundState = array(
            '0' => _("无退货"),
            //无退货
            '1' => _("退货中"),
            //退货中
            '2' => _("退货完成"),
            //退货完成
        );


    }

    /**
     * 读取分页列表
     *
     * @param array $cond_row
     * @param array $order_row
     * @param int $page
     * @param int $rows
     * @param bool $flag
     * @return array
     */
    public function getBaseList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100,$flag = true)
    {
        $data = $this->listByWhere($cond_row, $order_row, $page, $rows,$flag);

        $ShopBaseModel        = new Shop_BaseModel();
        $OrderStateModel      = new Order_StateModel();
        $OrderGoodsModel      = new Order_GoodsModel();
        $ShareBaseModel       = new Share_BaseModel();
        $SharePriceModel      = new Share_PriceModel();
        $ExpressModel         = new ExpressModel();
        $GoodsEvaluationModel = new Goods_EvaluationModel();
        $OrderReturnModel     = new Order_ReturnModel();

        if ($data['items'])
        {
            //交易投诉的有效时间
            $day = Web_ConfigModel::value('config_value');

            $shop_id_row = array();
            $express_id_row = array();
            foreach ($data['items'] as $key => $val)
            {
                //若是待付款订单，计算系统取消订单时间
                if ($val['order_status'] == $OrderStateModel::ORDER_WAIT_PAY)
                {
                    $data['items'][$key]['cancel_time'] = date('Y-m-d H:i:s', strtotime($val['order_create_time']) + YLB_Registry::get('wait_pay_time'));

                    if ($data['items'][$key]['cancel_time'] <= get_date_time())
                    {
                        $data['items'][$key]['order_status'] = $OrderStateModel::ORDER_CANCEL;
                        //修改订单状态 - 将订单状态改为取消
                        $this->cancelOrder($val['order_id']);
                    }
                }

                //若是已发货订单，计算系统自动确认收货时间
                if ($val['order_status'] == $OrderStateModel::ORDER_WAIT_CONFIRM_GOODS)
                {
                    if ($val['order_receiver_date'] <= get_date_time())
                    {
                        //修改订单状态 - 将订单状态改为已收货
                        if($val['order_is_virtual'] == $OrderStateModel::ORDER_IS_VIRTUAL)
                        {
                            $this->virtualReturn($val['order_id']);
                        }
                        else
                        {
                            $data['items'][$key]['order_status'] = $OrderStateModel::ORDER_FINISH;
                            $this->confirmOrder($val['order_id']);
                        }
                    }
                }

                $data['items'][$key]['order_state_con'] = $OrderStateModel->orderState[$val['order_status']]; //订单状态
                $data['items'][$key]['order_refund_status_con'] = $OrderStateModel->orderRefundState[$val['order_refund_status']]; //退款状态

                //若是该订单已完成，判断其交易投诉的有效时间
                $data['items'][$key]['complain_day'] = $day;
                $data['items'][$key]['complain_status'] = 0;
                if ($val['order_status'] == $OrderStateModel::ORDER_FINISH)
                {
                    $com_time = $day * 86400;
                    $complain_time = strtotime($val['order_finished_time']) + $com_time;

                    //当前时间在投诉有效期内
                    if ($complain_time > time())
                    {
                        $data['items'][$key]['complain_status'] = 1;
                    }
                }

                //S 匹配app旧版本 升级后要删除
                if ($val['order_refund_status'] != $OrderStateModel::ORDER_REFUND_NO)
                {
                    $order_return_id = $OrderReturnModel->getKeyByWhere(array('order_number' => $val['order_id'], 'order_goods_id' => '0'));
                    $data['items'][$key]['order_return_id'] = current($order_return_id);
                }
                //E 匹配app旧版本 升级后要删除

                if(!isset($shop_id_row[$val['shop_id']]))
                {
                    $shop_id_row[$val['shop_id']] = $val['shop_id'];
                }

                //取出物流公司名称
                $data['items'][$key]['express_name'] = '';
                if (!empty($val['order_shipping_express_id']))
                {
                    if(!isset($express_id_row[$val['order_shipping_express_id']]))
                    {
                        $express_id_row[$val['order_shipping_express_id']] = $val['order_shipping_express_id'];
                    }
                }
            }

            if ($shop_id_row)
            {
                $shop_base_row = $ShopBaseModel->getByWhere(array('shop_id:IN'=>$shop_id_row));

                if($express_id_row)
                {
                    $express_base_row = $ExpressModel->get($express_id_row);
                }

                foreach ($data['items'] as $key => $val)
                {
                    //放入店铺信息
                    $data['items'][$key]['shop_self_support'] = $shop_base_row[$val['shop_id']]['shop_self_support'];

                    //赋值物流公司名称
                    if(isset($express_base_row[$val['order_shipping_express_id']]))
                    {
                        $data['items'][$key]['express_name'] = $express_base_row[$val['order_shipping_express_id']]['express_name'];
                    }

                    //查找订单商品
                    $order_goods = $OrderGoodsModel->getByWhere(array('order_id' => $val['order_id']));

                    foreach ($order_goods as $okey => $oval)
                    {
                        $data['items'][$key]['count'] += count($okey);

                        //判断该订单商品被评论的次数
                        /*$goods_evaluation_row = array();
                        $goods_evaluation_row['order_id'] = $val['order_id'];
                        $goods_evaluation_row['goods_id'] = $oval['goods_id'];
                        $goods_evaluation = $GoodsEvaluationModel->getCount($goods_evaluation_row);
                        $order_goods[$okey]['evaluation_count'] = $goods_evaluation;*/

                        //判断订单商品的退货状态
                        $order_goods[$okey]['goods_refund_status_con'] = $this->goodsRefundState[$oval['goods_refund_status']];

                        //重构规格
                        $order_goods[$okey]['order_spec_info'] = implode(',',$oval['order_spec_info']);

                        //获取商品分享立赚立减
                        $goods_cont = $ShareBaseModel->getOneByWhere(array('common_id'=>$oval['common_id']));
                        $order_goods[$okey]['common_share_price'] = $goods_cont['share_total_price'];
                        $order_goods[$okey]['common_promotion_price'] = $goods_cont['promotion_total_price'];

                        //Zhenzh 获取商品分享立减
                        $share_cond_row['common_id'] = $oval['common_id'];
                        $share_cond_row['share_order_id'] = $val['order_id'];
                        $share_price = $SharePriceModel ->getOneSharePriceByWhere($share_cond_row);
                        if($share_price)
                        {
                            $order_goods[$okey]['share_price'] = $share_price['price'];
                            $order_goods[$okey]['promotion_click_count'] = $share_price['promotion_click_count'];
                            $order_goods[$okey]['promotion_total_price'] = $share_price['promotion_click_count'] * $share_price['promotion_unit_price'];
                        }

                        //S 匹配app旧版本 升级后要删除
                        if ($oval['goods_refund_status'] != $OrderStateModel::ORDER_GOODS_RETURN_NO)
                        {
                            $order_goods_return_id = $OrderReturnModel->getKeyByWhere(array('order_number' => $val['order_id'], 'order_goods_id' => $oval['order_goods_id']));
                            $order_goods[$okey]['order_return_id'] = current($order_goods_return_id);
                        }
                        //E 匹配app旧版本 升级后要删除
                    }

                    $data['items'][$key]['goods_list'] = array_values($order_goods);
                }
            }
        }

        return $data;
    }

    /**
     * @param array $cond_row
     * @param array $order_row
     * @param int $page
     * @param int $rows
     * @return array
     */
    public function getOrderBaseList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        $Order_StateModel = new Order_StateModel();
        $data = $this->listByWhere($cond_row, $order_row, $page, $rows,false);

        if ($data['items'])
        {
            $order_id_row = array();
            foreach ($data['items'] as $key=>$value)
            {
                $data['items'][$key]['order_state_con'] = $Order_StateModel->orderState[$value['order_status']];
                $order_id_row[] = $key;
            }

            if($order_id_row)
            {
                $Order_GoodsModel = new Order_GoodsModel();
                $order_goods_row = $Order_GoodsModel->getByWhere(array('order_id:IN'=>$order_id_row));

                foreach ($order_goods_row as $key=>$value)
                {
                    if(isset($data['items'][$value['order_id']]))
                    {
                        $data['items'][$value['order_id']]['goods_list'][] = $value;
                    }
                }

                $data['items'] = array_values($data['items']);
            }
        }


        return $data;
    }


    /**
     * 订单详情
     *
     * @param null $order_id
     * @return array
     */
    public function getOrderDetail($order_id = null)
    {

        $data = $this->getOneByWhere(array('order_id' => $order_id));

        $Order_StateModel = new Order_StateModel();

        $data['order_state_con'] = $Order_StateModel->orderState[$data['order_status']];

        //订单退款状态
        $data['order_refund_status_con'] = $Order_StateModel->orderRefundState[$data['order_refund_status']];

        if($order_id){
            $Order_ReturnModel = new Order_ReturnModel();
            $info = $Order_ReturnModel->getOneByWhere(array('order_number' => $order_id));
            if($info){
                $data['return_add_time'] = $info['return_add_time'];
                $data['return_finish_time'] = $info['return_finish_time'];
            }
        }
        //若为虚拟订单并且虚拟兑换码已发放,计算还有多少未使用的兑换码，虚拟商品是否支付过期退款，虚拟商品的过期时间
        if ($data['order_status'] != Order_StateModel::ORDER_WAIT_PAY && $data['order_is_virtual'] == Order_BaseModel::ORDER_IS_VIRTUAL) {
            $Order_GoodsVirtualCodeModel = new Order_GoodsVirtualCodeModel();
            $cond_row = array();
            $cond_row['order_id'] = $data['order_id'];

            $data['code_list'] = $Order_GoodsVirtualCodeModel->getVirtualCode($cond_row);

            $cond_row['virtual_code_status'] = Order_GoodsVirtualCodeModel::VIRTUAL_CODE_NEW;
            $new_code = $Order_GoodsVirtualCodeModel->getVirtualCode($cond_row);
            $data['new_code'] = count($new_code);


            //获取所有的订单商品id
            $code_order_goods_id = array_column($data['code_list'], 'order_goods_id');
            $Order_GoodsModel = new Order_GoodsModel();
            $Goods_CommonModel = new Goods_CommonModel();

            //查找订单商品
            $code_order_goods = $Order_GoodsModel->getByWhere(array('order_goods_id:IN' => $code_order_goods_id));

            //查找订单商品的common信息
            $code_order_goods_common = array_column($code_order_goods, 'common_id');

            foreach ($code_order_goods_common as $commonkey => $commonval) {
                $code_order_goods_common[$commonkey] = $Goods_CommonModel->getOne($commonval);
            }

            fb($code_order_goods_common);

            foreach ($data['code_list'] as $codekey => $codeval) {
                //查找订单商品
                $data['code_list'][$codekey]['common_virtual_refund'] = $code_order_goods_common[$data['code_list'][$codekey]['order_goods_id']]['common_virtual_refund'];
                $data['code_list'][$codekey]['common_virtual_date'] = $code_order_goods_common[$data['code_list'][$codekey]['order_goods_id']]['common_virtual_date'];
                $data['common_virtual_date'] = $code_order_goods_common[$data['code_list'][$codekey]['order_goods_id']]['common_virtual_date'];
            }
        }


        //若是待付款订单，计算系统取消订单时间
        if ($data['order_status'] == Order_StateModel::ORDER_WAIT_PAY) {
            $data['cancel_time'] = date('Y-m-d H:i:s', strtotime($data['order_create_time']) + YLB_Registry::get('wait_pay_time'));
        }

        //若是已发货订单，计算系统自动确认收货时间
        /*if ($data['order_status'] == Order_StateModel::ORDER_WAIT_CONFIRM_GOODS)
        {
            $data['confirm_time'] = date('Y-m-d H:i:s', strtotime($data['order_shipping_time']) + YLB_Registry::get('confirm_order_time'));
        }*/

        //若为退款中订单，则查找退款单id

        if ($data['order_refund_status'] != Order_StateModel::ORDER_REFUND_NO) {
            $Order_ReturnModel = new Order_ReturnModel();
            $order_return_id = $Order_ReturnModel->getKeyByWhere(array('order_number' => $data['order_id'], 'order_goods_id' => '0'));
            $data['order_return_id'] = $order_return_id[0];
        }

        //若是已完成订单，计算交易投诉的有效时间
        $Web_ConfigModel = new Web_ConfigModel();
        $day = $Web_ConfigModel->getOne('complain_datetime');
        $day = $day['config_value'];
        $data['complain_day'] = $day;
        if ($data['order_status'] == Order_StateModel::ORDER_FINISH) {
            $comtime = $day * 86400;

            $complain_time = strtotime($data['order_finished_time']) + $comtime;

            //当前时间在投诉有效期内
            if ($complain_time > time()) {
                $data['complain_status'] = 1;
            } else {
                $data['complain_status'] = 0;
            }
        } else {
            $data['complain_status'] = 0;
        }

        //获取订单评价状态
        $data['order_buyer_evaluation_status_con'] = Order_BaseModel::$orderEvaluatBuyer[$data['order_buyer_evaluation_status']];


        //获取订单取消者身份
        if ($data['order_cancel_identity']) {
            $data['cancel_identity'] = $this->cancelIdentity[$data['order_cancel_identity']];
        }


        //查找店铺信息
        $Shop_BaseModel = new Shop_BaseModel();
        $shop_base = $Shop_BaseModel->getOne($data['shop_id']);

        $data['shop_address'] = $shop_base['shop_region'] . $shop_base['shop_address'];
        $data['shop_phone'] = $shop_base['shop_tel'];
        $data['shop_self_support'] = $shop_base['shop_self_support'];
        $data['shop_logo'] = $shop_base['shop_logo'];

        //查找订单商品
        $Goods_CommonModel = new Goods_CommonModel();
        $Order_GoodsModel = new Order_GoodsModel();
        $Goods_EvaluationModel = new Goods_EvaluationModel();
        $order_goods = $Order_GoodsModel->getByWhere(array('order_id' => $data['order_id']));
        foreach ($order_goods as $okey => $oval) {
            //判断该订单商品被评论的次数
            $goods_evaluation_row = array();
            $goods_evaluation_row['order_id'] = $data['order_id'];
            $goods_evaluation_row['goods_id'] = $oval['goods_id'];
            $goods_evaluation = $Goods_EvaluationModel->getByWhere($goods_evaluation_row);

            $order_goods[$okey]['evaluation_count'] = count($goods_evaluation);

            //获取订单商品退货状态
            $order_goods[$okey]['goods_refund_status_con'] = $this->goodsRefundState[$oval['goods_refund_status']];

            //若为退款中订单，则查找退款单id
            if ($oval['goods_refund_status'] != Order_StateModel::ORDER_REFUND_NO) {
                $Order_ReturnModel = new Order_ReturnModel();
                $order_return_id = $Order_ReturnModel->getKeyByWhere(array('order_number' => $data['order_id'], 'order_goods_id' => $oval['order_goods_id']));
                $order_goods[$okey]['order_return_id'] = $order_return_id[0];
            }
        }

        $data['goods_list'] = array_values($order_goods);


        return $data;
    }


    public function getBaseExcel($cond_row = array(), $order_row = array())
    {
        $data = $this->getByWhere($cond_row, $order_row);

        foreach ($data as $k => $v) {
            $data[$k]['order_id'] = " " . $v['order_id'] . " ";
        }

        return array_values($data);
    }

    /**
     * 读取分页列表
     *
     * @param  int $config_key 主键值
     * @return array $rows 返回的查询内容
     * @access public
     */
    public function getDetailList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        return $this->listByWhere($cond_row, $order_row, $page, $rows);
    }

    /*
     * 获取结算表下面的相关订单数据
     */

    public function getOrderDetailList($cond_row = array(), $order_row = array(), $page = 1, $rows = 10)
    {
        return $this->listByWhere($cond_row, $order_row, $page, $rows);
    }

    /*
     * @author WenQingTeng
     *
     * 结算订单表
     * 10/22  修改订单中不再计算退款金额，退款金额通过退货单进行计算
     */
    public function settleOrder($cond_row = array(), $order_row = array())
    {
        $data = $this->getByWhere($cond_row, $order_row);

        //订单金额
        $order_amount = 0;
        //运费
        $shipping_amount = 0;
        //佣金金额
        $commission_amount = 0;
        //退款金额
        $return_amount = 0;
        //退款佣金
        $commission_return_amount = 0;

        //结算订单部分的费用
        $res = array(
            'order_amount' => array_sum(array_column($data,'order_payment_amount')),
            'shipping_amount' => array_sum(array_column($data,'order_shipping_fee')),
            'commission_amount' => array_sum(array_column($data,'order_commission_fee')),
            'redpacket_amount' => array_sum(array_column($data,'order_rpt_price')),
        );

        //修改订单表中的结算时间与结算状态
        $id_row = array_keys($data);
        $this->editBase($id_row, array('order_settlement_time' => get_date_time() ,'order_is_settlement' =>Order_SettlementModel::SETTLEMENT_WAIT_OPERATE));

        return $res;

    }

    /*
     *  windfnn
     *
     * 获取卖家订单列表
     */
    public function getOrderList($cond_row = array(), $order_row = array(), $page = 0, $rows = 15)
    {
        //分页
        $YLB_Page = new YLB_Page();
        $rows = $YLB_Page->listRows;
        $offset = request_int('firstRow', 0);
        $page = ceil_r($offset / $rows);

        $data = $this->listByWhere($cond_row, $order_row, $page, $rows);
        $Order_GoodsModel = new Order_GoodsModel();
        $Order_StateModel = new Order_StateModel();
        $shopBaseModel = new Shop_BaseModel();

        //分页
        $YLB_Page->totalRows = $data['totalsize'];
        $page_nav = $YLB_Page->prompt();
        $data['page_nav'] = $page_nav;

        $order_id_row = array_column($data['items'], 'order_id');

        $goods_list = array();
        $order_goods_list = $Order_GoodsModel->getByWhere(array('order_id:IN' => $order_id_row));
        foreach ($order_goods_list as $key=>$item)
        {
            $goods_list[$item['order_id']][] = $item;
        }

        $url = YLB_Registry::get('url');
        foreach ($data['items'] as $key => $val)
        {
            $data['items'][$key]['order_status_text'] = $Order_StateModel->orderState[$val['order_status']];
            $data['items'][$key]['order_status_const'] = $Order_StateModel->orderState[$val['order_status']];

            //订单详情URL
            $data['items'][$key]['info_url'] = $url . '?ctl=Seller_Trade_Order&met=physicalInfo&typ=e&order_id=' . $val['order_id'];
            //发货单URL
            $data['items'][$key]['delivery_url'] = $url . '?ctl=Seller_Trade_Order&met=getOrderPrint&typ=e&order_id=' . $val['order_id'];
            //设置发货URL
            $data['items'][$key]['send_url'] = $url . '?ctl=Seller_Trade_Order&met=send&typ=e&order_id=' . $val['order_id'];
            //收货人信息 名字 + 联系方式 + 地址 &nbsp
            $data['items'][$key]['receiver_info'] = $val['order_receiver_name'] . "&nbsp" . $val['order_receiver_contact'] . "&nbsp" . $val['order_receiver_address'];


            //发货人信息
            if (empty($val['order_seller_name'])) {
                $data['items'][$key]['shipper'] = 0;
                $data['items'][$key]['shipper_info'] = '还未设置发货地址，请进入发货设置 &gt 地址库中添加';
            } else {
                $data['items'][$key]['shipper'] = 1;
                $data['items'][$key]['shipper_info'] = $val['order_seller_name'] . "&nbsp" . $val['order_seller_address'] . "&nbsp" . $val['order_seller_contact'];
            }

            //运费信息
            if ($val['order_shipping_fee'] == 0) {
                $data['items'][$key]['shipping_info'] = "(免运费)";
            } else {
                $shipping_fee = @format_money($val['order_shipping_fee']);
                $data['items'][$key]['shipping_info'] = "(含运费$shipping_fee)";
            }
			
			if(Perm::$shopId)
			{
				$shop_base  = $shopBaseModel->getOne(Perm::$shopId);
			}
			
            if ($val['order_status'] == Order_StateModel::ORDER_WAIT_PAY && $shop_base['shop_type'] == 1)
            {
                $order_id = $val['order_id'];
                $set_html = "<a href=\"javascript:void(0)\" data-order_id=$order_id dialog_id=\"seller_order_cancel_order\" class=\"ncbtn ncbtn-grapefruit mt5\"><i class=\"icon-remove-circle\"></i>取消订单</a>";

                $data['items'][$key]['set_html'] = $set_html;
            }
            else
            {
                if ($val['order_refund_status'] >= Order_StateModel::ORDER_REFUND_IN)
                {
                    //查找退款单
                    $Order_ReturnModel = new Order_ReturnModel();
                    $order_retuen_cond['order_number'] = $val['order_id'];
                    $order_retuen_cond['return_goods_return'] = Order_ReturnModel::RETURN_GOODS_ISRETURN;
                    $return_id = $Order_ReturnModel->getKeyByWhere($order_retuen_cond);
                    $return_id = $return_id['0'];
                    $data['items'][$key]['retund_url'] = $url . '?ctl=Seller_Service_Return&met=orderReturn&act=detail&id=' . $return_id;

                    $retund_url = $url . '?ctl=Seller_Service_Return&met=orderReturn&act=detail&id=' . $return_id;

                    if($val['order_refund_status'] == Order_StateModel::ORDER_REFUND_IN)
                    {
                        $set_html = "<a class=\"ncbtn ncbtn-mint mt10 bbc_seller_btns\" href=\"$retund_url\"><i class=\"icon-truck\"></i>处理退款</a>";
                    }
                    else
                    {
                        $set_html = "<a class=\"ncbtn ncbtn-mint mt10 bbc_seller_btns\" href=\"$retund_url\"><i class=\"icon-truck\"></i>查看退款</a>";
                    }
                }
                else if($val['order_status'] == $Order_StateModel::ORDER_PAYED || $val['order_status'] == $Order_StateModel::ORDER_WAIT_PREPARE_GOODS)
                {
                    $send_url = $data['items'][$key]['send_url'];
                    $set_html = "<a class=\"ncbtn ncbtn-mint mt10 bbc_seller_btns\" href=\"$send_url\"><i class=\"icon-truck\"></i>设置发货</a>";
                }
                else
                {
                    $set_html = '';
                }

                $data['items'][$key]['set_html'] = $set_html;
            }

            //获取订单产品列表
			if(isset($goods_list[$val['order_id']]))
			{
				$data['items'][$key]['goods_list'] = $goods_list[$val['order_id']];

				$goods_cat_num = 0;
				$return_goods_flag = false;
				foreach ($data['items'][$key]['goods_list'] as $k => $v)
				{
					$data['items'][$key]['goods_list'][$k]['goods_link'] = $url . '?ctl=Goods_Goods&met=snapshot&goods_id=' . $v['goods_id'] . '&order_id=' . $val['order_id'];//商品快照链接
					$goods_cat_num += 1;
					if(is_array($data['items'][$key]['goods_list'][$k]['order_spec_info']) && $data['items'][$key]['goods_list'][$k]['order_spec_info'])
					{
						$data['items'][$key]['goods_list'][$k]['order_spec_info'] = implode('，',$data['items'][$key]['goods_list'][$k]['order_spec_info']);
					}
					if($v['goods_refund_status'] > 0)
                    {
                        $send_url = $url . '?ctl=Seller_Service_Return&met=goodsReturn&order_id=' . $val['order_id'];
                        if($v['goods_refund_status'] == 1)
                        {
                            $data['items'][$key]['set_html'] = "<a class=\"ncbtn ncbtn-mint mt10 bbc_seller_btns\" href=\"$send_url\"><i class=\"icon-truck\"></i>处理退货</a>";
                        }
                        else
                        {
                            $data['items'][$key]['set_html'] = "<a class=\"ncbtn ncbtn-mint mt10 bbc_seller_btns\" href=\"$send_url\"><i class=\"icon-truck\"></i>查看退货</a>";
                        }
                    }
				}
			}

            //商品种类数
            $data['items'][$key]['goods_cat_num'] = $goods_cat_num;
        }

        return $data;
    }

    public function getExportOrderList($cond_row = array(), $order_row = array(), $page = 0, $rows = 15)
    {
        $data = $this->listByWhere($cond_row, $order_row, $page, $rows);

        $Order_GoodsModel = new Order_GoodsModel();
        $Order_StateModel = new Order_StateModel();

        $order_id_row = array_column($data['items'], 'order_id');
        $order_goods_list = $Order_GoodsModel->getByWhere(array('order_id:IN' => $order_id_row));

        $goods_list = array();
        foreach ($order_goods_list as $key=>$item)
        {
            $goods_list[$item['order_id']][] = $item;
        }

        $url = YLB_Registry::get('url');

        foreach ($data['items'] as $key => $val)
        {
            $data['items'][$key]['order_status_text'] = $Order_StateModel->orderState[$val['order_status']];
            $data['items'][$key]['order_status_const'] = $Order_StateModel->orderState[$val['order_status']];

            //订单详情URL
            $data['items'][$key]['info_url'] = $url . '?ctl=Seller_Trade_Order&met=physicalInfo&o&typ=e&order_id=' . $val['order_id'];
            //发货单URL
            $data['items'][$key]['delivery_url'] = $url . '?ctl=Seller_Trade_Order&met=getOrderPrint&typ=e&order_id=' . $val['order_id'];
            //设置发货URL
            $data['items'][$key]['send_url'] = $url . '?ctl=Seller_Trade_Order&met=send&typ=e&order_id=' . $val['order_id'];
            //收货人信息 名字 + 联系方式 + 地址 &nbsp
            $data['items'][$key]['receiver_info'] = $val['order_receiver_name'] . "&nbsp" . $val['order_receiver_contact'] . "&nbsp" . $val['order_receiver_address'];


            //发货人信息
            if (empty($val['order_seller_name'])) {
                $data['items'][$key]['shipper_info'] = '还未设置发货地址，请进入发货设置 &gt 地址库中添加';
            } else {
                $data['items'][$key]['shipper_info'] = $val['order_seller_name'] . "&nbsp" . $val['order_seller_address'] . "&nbsp" . $val['order_seller_contact'];
            }

            //运费信息
            if ($val['order_shipping_fee'] == 0) {
                $data['items'][$key]['shipping_info'] = "(免运费)";
            } else {
                $shipping_fee = @format_money($val['order_shipping_fee']);
                $data['items'][$key]['shipping_info'] = "(含运费$shipping_fee)";
            }

            /*
             * 订单操作
             * 待付款状态 ==> 取消订单
             * 待发货状态 ==> 设置发货
             * */

            if(Perm::$shopId)
            {
                $shopBaseModel = new Shop_BaseModel();
                $shop_base  = $shopBaseModel->getOne(Perm::$shopId);
            }

            if ($val['order_status'] == Order_StateModel::ORDER_WAIT_PAY && $shop_base['shop_type'] == 1)
            {
                $order_id = $val['order_id'];
                $set_html = "<a href=\"javascript:void(0)\" data-order_id=$order_id dialog_id=\"seller_order_cancel_order\" class=\"ncbtn ncbtn-grapefruit mt5\"><i class=\"icon-remove-circle\"></i>取消订单</a>";

                $data['items'][$key]['set_html'] = $set_html;
            }
            else if ($val['order_status'] == Order_StateModel::ORDER_WAIT_PREPARE_GOODS || $val['order_status'] == Order_StateModel::ORDER_PAYED)
            {
                if ($val['order_refund_status'] == Order_StateModel::ORDER_REFUND_IN)
                {
                    //查找退款单
                    $Order_ReturnModel = new Order_ReturnModel();
                    $order_retuen_cond['order_number'] = $val['order_id'];
                    $order_retuen_cond['return_goods_return'] = Order_ReturnModel::RETURN_GOODS_ISRETURN;
                    $return_id = $Order_ReturnModel->getKeyByWhere($order_retuen_cond);
                    $return_id = $return_id['0'];
                    $data['items'][$key]['retund_url'] = $url . '?ctl=Seller_Service_Return&met=orderReturn&act=detail&id=' . $return_id;

                    $retund_url = $url . '?ctl=Seller_Service_Return&met=orderReturn&act=detail&id=' . $return_id;
                    $set_html = "<a class=\"ncbtn ncbtn-mint mt10 bbc_seller_btns\" href=\"$retund_url\"><i class=\"icon-truck\"></i>处理退款</a>";
                }
                else
                {
                    $send_url = $data['items'][$key]['send_url'];
                    $set_html = "<a class=\"ncbtn ncbtn-mint mt10 bbc_seller_btns\" href=\"$send_url\"><i class=\"icon-truck\"></i>设置发货</a>";
                }


                $data['items'][$key]['set_html'] = $set_html;
            }
            else
            {
                $data['items'][$key]['set_html'] = null;
            }

            //获取订单产品列表
            if(isset($goods_list[$val['order_id']]))
            {
                $data['items'][$key]['goods_list'] = $goods_list[$val['order_id']];

                $goods_cat_num = 0;
                foreach ($data['items'][$key]['goods_list'] as $k => $v)
                {
                    $data['items'][$key]['goods_list'][$k]['goods_link'] = $url . '?ctl=Goods_Goods&met=snapshot&goods_id=' . $v['goods_id'] . '&order_id=' . $val['order_id'];//商品链接
                    $goods_cat_num += 1;
                    if(is_array($data['items'][$key]['goods_list'][$k]['order_spec_info']) && $data['items'][$key]['goods_list'][$k]['order_spec_info'])
                    {
                        $data['items'][$key]['goods_list'][$k]['order_spec_info'] = implode('，',$data['items'][$key]['goods_list'][$k]['order_spec_info']);
                    }
                }
            }
            //商品种类数
            $data['items'][$key]['goods_cat_num'] = $goods_cat_num;
        }

        return $data;
    }

    /*
     *  windfnn
     *
     * 获取平台商品订单列表
     * @return array $data 订单列表
     * */
    public function getPlatOrderList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        $data = $this->getBaseList($cond_row, $order_row, $page, $rows);
        $Order_StateModel = new Order_StateModel();

        foreach ($data['items'] as $key => $val)
        {
            $data['items'][$key]['order_goods_amount'] = $data['items'][$key]['order_goods_amount']*1;
            $data['items'][$key]['order_status_text'] = $Order_StateModel->orderState[$val['order_status']];

            if($val['order_refund_status'])
            {
                $data['items'][$key]['order_refund_state_text'] = $Order_StateModel->orderRefundState[$val['order_refund_status']];
            }

            if($val['order_return_status'])
            {
                $data['items'][$key]['order_return_state_text'] = $Order_StateModel->orderReturnState[$val['order_return_status']];
            }

            $data['items'][$key]['order_from_text'] = $Order_StateModel->orderFrom[$val['order_from']];
            $data['items'][$key]['evaluation_status_text'] = $Order_StateModel->evaluationStatus[$val['order_buyer_evaluation_status']];
            $data['items'][$key]['payment_channel_text'] = self::$paymentChannel[$val['payment_channel_id']];
        }

        return $data;
    }

    /*
     *  ly
     *
     * 拼接筛选条件,多个方法公用
     * @param $condition 筛选条件
     * @return array $condition 筛选条件
     * */
    public function createSearchCondi(&$condition)
    {
        $query_start_date = request_string('query_start_date');
        $query_end_date = request_string('query_end_date');
        $buyer_name = request_string('buyer_name');
        $order_sn = request_string('order_sn');
        $skip_off = request_int('skip_off');            //是否显示已取消订单

        if (!empty($query_start_date)) {
            $query_start_date = $query_start_date;
            $condition['order_create_time:>='] = $query_start_date;
        }

        if (!empty($query_end_date)) {
            $query_end_date = $query_end_date;
            $condition['order_create_time:<='] = $query_end_date;
        }

        if (!empty($buyer_name)) {
            $condition['buyer_user_name:LIKE'] = "%$buyer_name%";
        }

        if (!empty($order_sn)) {
            $condition['order_id'] = $order_sn;
        }

        if ($skip_off) {
            $condition['order_status:<>'] = Order_StateModel::ORDER_CANCEL;
        }
    }

    /*
     *  ly
     *
     * 获取实物交易订单信息
     * @param $condition 筛选条件
     * @return array $data 订单信息
     * */
    public function getPhysicalInfoData($condi = array())
    {

        $data = $this->getOrderList($condi);

        $data = pos($data['items']);
        if($data['order_id']){
            $Order_ReturnModel = new Order_ReturnModel();
            $info = $Order_ReturnModel->getOneByWhere(array('order_number' => $data['order_id']));
            if($info){
                $data['return_add_time'] = $info['return_add_time'];
                $data['return_finish_time'] = $info['return_finish_time'];
            }
        }

        switch ($data['order_status']) {
            case Order_StateModel::ORDER_WAIT_PAY :
                $order_create_time = time($data['order_create_time']);
                $order_close_data = date('Y-m-d', strtotime('+7days', $order_create_time));
                $data['order_status_text'] = '订单已经提交，等待买家付款';
                $data['order_status_html'] = "<li>1. 买家尚未对该订单进行支付。</li><li>2. 如果买家未对该笔订单进行支付操作，系统将于<time>$order_close_data</time>自动关闭该订单。</li>";

                //页面的订单状态
                $data['order_payed'] = "";
                $data['order_wait_confirm_goods'] = "";
                $data['order_received'] = "";
                $data['order_evaluate'] = "";
                break;

            case Order_StateModel::ORDER_PAYED:
                $payment_name = $data['payment_name'];
                if (empty($payment_name)) {
                    $payment_name = 'XXX';
                }
                $data['order_status_text'] = '已经付款';
                $data['order_status_html'] = "<li>1. 买家已使用“" . $payment_name . "”方式成功对订单进行支付，支付单号 “" .$data['payment_other_number']. "”。</li><li>2. 订单已提交商家进行备货发货准备。</li>";

                //页面的订单状态
                $data['order_payed'] = "current";
                $data['order_wait_confirm_goods'] = "";
                $data['order_received'] = "";
                $data['order_evaluate'] = "";
                break;

            case Order_StateModel::ORDER_WAIT_PREPARE_GOODS :
                $payment_name = $data['payment_name'];
                if (empty($payment_name)) {
                    $payment_name = 'XXX';
                }
                $data['order_status_text'] = '等待发货';
                $data['order_status_html'] = "<li>1. 买家已使用“" . $payment_name . "”方式成功对订单进行支付。</li><li>2. 订单已提交商家进行备货发货准备。</li>";

                //页面的订单状态
                $data['order_payed'] = "current";
                $data['order_wait_confirm_goods'] = "";
                $data['order_received'] = "";
                $data['order_evaluate'] = "";
                break;


            case Order_StateModel::ORDER_REFUND_IN :
                $return_add_time = time($data['return_add_time']);
                $order_close_data = date('Y-m-d', strtotime('+7days', $return_add_time));
                $data['order_status_text'] = '退款中';
                $data['order_status_html'] = "<li>等待商家处理中！</li>";

                //页面的订单状态
                $data['order_payed'] = "";
                $data['order_wait_confirm_goods'] = "";
                $data['order_received'] = "";
                $data['order_evaluate'] = "";
                break;


            case Order_StateModel::ORDER_WAIT_CONFIRM_GOODS :
                $data['order_status_text'] = '已经发货';
                if (empty($data['order_receiver_date'])) {
                    $order_shipping_time = strtotime($data['order_shipping_time']);
                    $order_shipping_time = strtotime('+1 month', $order_shipping_time);
                    $order_shipping_time = date('Y-m-d', $order_shipping_time);
                    $data['order_receiver_date'] = $order_shipping_time;
                } else {
                    $order_shipping_time = $data['order_receiver_date'];
                }

                if(!empty($data['order_shipping_express_id']) && !empty($data['order_shipping_code']))
                {
                    //查找物流公司
                    $expressModel = new ExpressModel();
                    $express_base = $expressModel->getExpress($data['order_shipping_express_id']);
                    $express_base = pos($express_base);
                    $express_name = $express_base['express_name'];
                    $order_shipping_code = $data['order_shipping_code'];

                    $data['order_status_html'] = "<li>1. 商品已发出；$express_name : $order_shipping_code 。</li><li>2. 如果买家没有及时进行收货，系统将于<time>$order_shipping_time</time>自动完成“确认收货”，完成交易。</li>";

                }
                else
                {
                    $data['order_status_html'] = "<li>1. 商品已发出；无需物流。</li><li>2. 如果买家没有及时进行收货，系统将于<time>$order_shipping_time</time>自动完成“确认收货”，完成交易。</li>";
                }




                //页面的订单状态
                $data['order_payed'] = "current";
                $data['order_wait_confirm_goods'] = "current";
                $data['order_received'] = "";
                $data['order_evaluate'] = "";
                break;

            case Order_StateModel::ORDER_RECEIVED:
                $data['order_status_text'] = '已经收货';
                $data['order_status_html'] = '<li>1. 交易已完成，买家可以对购买的商品及服务进行评价。</li><li>2. 评价后的情况会在商品详细页面中显示，以供其它会员在购买时参考。</li>';

                //页面的订单状态
                $data['order_payed'] = "current";
                $data['order_wait_confirm_goods'] = "current";
                $data['order_received'] = "current";
                if ($data['order_buyer_evaluation_status'] != Order_BaseModel::BUYER_EVALUATE_NO) {
                    $data['order_evaluate'] = "current";
                } else {
                    $data['order_evaluate'] = "";
                }

                break;
            case Order_StateModel::ORDER_FINISH:
                $data['order_status_text'] = '已经收货';
                $data['order_status_html'] = '<li>1. 交易已完成，买家可以对购买的商品及服务进行评价。</li><li>2. 评价后的情况会在商品详细页面中显示，以供其它会员在购买时参考。</li>';

                //页面的订单状态
                $data['order_payed'] = "current";
                $data['order_wait_confirm_goods'] = "current";
                $data['order_received'] = "current";
                if ($data['order_buyer_evaluation_status'] != Order_BaseModel::BUYER_EVALUATE_NO) {
                    $data['order_evaluate'] = "current";
                } else {
                    $data['order_evaluate'] = "";
                }

                break;
            case Order_StateModel::ORDER_CANCEL:
                $data['order_status_text'] = '交易关闭';
                $order_cancel_date = $data['order_cancel_date'];
                $order_cancel_reason = $data['order_cancel_reason'];

                //判断关闭者身份 1=>买家 2=>卖家 3=>系统
                if ($data['order_cancel_identity'] == Order_BaseModel::CANCEL_USER_BUYER) {
                    $identity = '买家';
                } else if ($data['order_cancel_identity'] == Order_BaseModel::CANCEL_USER_SELLER) {
                    $identity = '商家';
                } else if ($data['order_cancel_identity'] == Order_BaseModel::CANCEL_USER_SYSTEM) {
                    $identity = '系统';
                }

                $data['order_status_html'] = "<li> $identity 于 $order_cancel_date 取消了订单 ( $order_cancel_reason ) </li>";
                break;
            default:
                $data['order_status_text'] = 'xxxx';
        }

        //取出物流公司名称
        if (!empty($data['order_shipping_express_id'])) {
            $expressModel = new ExpressModel();
            $express_base = $expressModel->getExpress($data['order_shipping_express_id']);
            $express_base = pos($express_base);
            $data['express_name'] = $express_base['express_name'];
        } else {
            $data['express_name'] = '';
        }

        //店主名称
        $shopBaseModel = new Shop_BaseModel();
        $shop_base = $shopBaseModel->getBase($data['shop_id']);
        $shop_base = pos($shop_base);
        $data['shop_user_name'] = $shop_base['user_name'];
        $data['shop_tel'] = $shop_base['shop_tel'];

        if($data['order_invoice_id']){
            $InvoiceModel = new InvoiceModel();
            $invoice_row  = $InvoiceModel->getOne($data['order_invoice_id']);
            if($invoice_row)
            {
                $data['invoice'] = $invoice_row;
            }
        }

        return $data;
    }

    /**
     * 获取门店自提订单信息
     *
     * @param array $condi
     * @return array|void
     */
    public function getChainInfoData($condi = array())
    {

        $data = $this->getOrderList($condi);
        $data = pos($data['items']);

        switch ($data['order_status'])
        {
            case Order_StateModel::ORDER_WAIT_PAY :
                $order_create_time         = time($data['order_create_time']);
                $order_close_data          = date('Y-m-d', strtotime('+7days', $order_create_time));
                $data['order_status_text'] = '订单已经提交，等待买家付款';
                $data['order_status_html'] = "<li>1. 买家尚未对该订单进行支付。</li><li>2. 如果买家未对该笔订单进行支付操作，系统将于<time>$order_close_data</time>自动关闭该订单。</li>";

                //页面的订单状态
                $data['order_payed']              = "";
                $data['order_wait_confirm_goods'] = "";
                $data['order_received']           = "";
                $data['order_evaluate']           = "";
                break;

            case Order_StateModel::ORDER_SELF_PICKUP :
                $payment_name = $data['payment_name'];
                if (empty($payment_name))
                {
                    $payment_name = 'XXX';
                }
                $data['order_status_text'] = '代自提';
                $data['order_status_html'] = "<li>买家还没有到门店自提。</li>";

                //页面的订单状态
                $data['order_payed']              = "current";
                $data['order_wait_confirm_goods'] = "";
                $data['order_received']           = "";
                $data['order_evaluate']           = "";
                break;

            case Order_StateModel::ORDER_RECEIVED || Order_StateModel::ORDER_FINISH :
                $data['order_status_text'] = '已经自提';
                $data['order_status_html'] = '<li>1. 交易已完成，买家可以对购买的商品及服务进行评价。</li><li>2. 评价后的情况会在商品详细页面中显示，以供其它会员在购买时参考。</li>';

                //页面的订单状态
                $data['order_payed']              = "current";
                $data['order_wait_confirm_goods'] = "current";
                $data['order_received']           = "current";
                if ($data['order_buyer_evaluation_status'] != Order_BaseModel::BUYER_EVALUATE_NO)
                {
                    $data['order_evaluate'] = "current";
                }
                else
                {
                    $data['order_evaluate'] = "";
                }

                break;

            case Order_StateModel::ORDER_CANCEL:
                $data['order_status_text'] = '交易关闭';
                $order_cancel_date         = $data['order_cancel_date'];
                $order_cancel_reason       = $data['order_cancel_reason'];

                //判断关闭者身份 1=>买家 2=>卖家 3=>系统
                if ($data['order_cancel_identity'] == Order_BaseModel::CANCEL_USER_BUYER)
                {
                    $identity = '买家';
                }
                else if ($data['order_cancel_identity'] == Order_BaseModel::CANCEL_USER_SELLER)
                {
                    $identity = '商家';
                }
                else if ($data['order_cancel_identity'] == Order_BaseModel::CANCEL_USER_SYSTEM)
                {
                    $identity = '系统';
                }

                $data['order_status_html'] = "<li> $identity 于 $order_cancel_date 取消了订单 ( $order_cancel_reason ) </li>";
                break;
        }

        //店主名称
        $shopBaseModel          = new Shop_BaseModel();
        $shop_base              = $shopBaseModel->getBase($data['shop_id']);
        $shop_base              = pos($shop_base);
        $data['shop_user_name'] = $shop_base['user_name'];
        $data['shop_tel']       = $shop_base['shop_tel'];

        return $data;
    }

    /**
     * 拼接筛选条件,多个方法公用
     *
     * @param $condi
     * @return array
     */
    public function getPhysicalList(&$condi)
    {
        $condi['shop_id'] = Perm::$shopId;
        if(!isset($condi['order_is_virtual']) || !$condi['order_is_virtual'])
        {
            $condi['order_is_virtual'] = 0;
        }
        if(!isset($condi['order_shop_hidden']) || !$condi['order_shop_hidden'])
        {
            $condi['order_shop_hidden'] = 0;
        }
        $this->createSearchCondi($condi); //生成查询条件
        $order_cond['order_create_time'] = 'DESC';
        $data = $this->getOrderList($condi,$order_cond);

        if($data['items'])
        {
            foreach ($data['items'] as $key => $value)
            {
                if($value['order_type'] == Order_BaseModel::ORDER_SPLIT)
                {
                    $order_id_row[] = $value['order_id'];
                }
            }
            $split_order_row = $this->getOrderList(array('order_source_id:IN'=>$order_id_row,'order_type:>='=>Order_BaseModel::ORDER_CHILD),'',1,100);

            $split_order_list = array();
            foreach ($split_order_row['items'] as $key => $value)
            {
                $split_order_list[$value['order_source_id']][] = $value;
            }

            foreach ($data['items'] as $key => $value)
            {
                if(isset($split_order_list[$value['order_id']]))
                {
                    $data['items'][$key]['split_order'] = $split_order_list[$value['order_id']];
                }
            }
        }

        $data['condi'] = $condi;

        return $data;
    }

    /**
     * 读数量
     *
     * @param array $cond_row
     * @return int
     */
    public function getCount($cond_row = array())
    {
        return $this->getNum($cond_row);
    }

    //订单支付成功后修改订单状态
    public function editOrderStatusAferPay($order_id = null, $uorder_id = null,$payment_channel_id = 0)
    {
        $flag = false;
        //查找订单信息
        $order_base = $this->getOne($order_id);

        if($order_base['order_status'] == Order_StateModel::ORDER_WAIT_PAY)
        {
            $edit_row = array('order_status' => Order_StateModel::ORDER_PAYED);
            $edit_row['payment_time'] = get_date_time();
            $edit_row['payment_other_number'] = $uorder_id;
            $edit_row['payment_channel_id'] = $payment_channel_id;
            //修改订单状态
            $this->editBase($order_id, $edit_row);

            //修改订单商品状态
            $Order_GoodsModel = new Order_GoodsModel();
            $edit_goods_row = array('order_goods_status' => Order_StateModel::ORDER_PAYED);
            $order_goods_id = $Order_GoodsModel->getKeyByWhere(array('order_id' => $order_id));
            $flag = $Order_GoodsModel->editGoods($order_goods_id, $edit_goods_row);

            //修改商品的销量
            $Goods_BaseModel = new Goods_BaseModel();
            $Goods_BaseModel->editGoodsSale($order_goods_id);

            //判断是否是虚拟订单，若是虚拟订单则生成发送信息并修改订单状态为已发货
            if ($order_base['order_is_virtual'] == Order_BaseModel::ORDER_IS_VIRTUAL) {
                //循环订单商品
                $Text_Password = new Text_Password();
                $Order_GoodsVirtualCodeModel = new Order_GoodsVirtualCodeModel();

                $msg_str = '尊敬的用户您已在' . $order_base['shop_name'] . '成功购买';
                $goods_name_str = '';
                $virtual_code_str = '';
                foreach ($order_goods_id as $k => $v) {
                    $order_goods_base = $Order_GoodsModel->getOne($v);
                    $num = $order_goods_base['order_goods_num'];
                    //获取购买的数量，循环生成虚拟兑换码，将信息插入虚拟兑换码表中

                    for ($i = 0; $i < $num; $i++) {
                        $virtual_code = $Text_Password->create(8, 'unpronounceable', 'numeric');
                        $virtual_code_str .= $virtual_code . ',';
                        $add_row = array();
                        $add_row['virtual_code_id'] = $virtual_code;
                        $add_row['order_id'] = $order_id;
                        $add_row['order_goods_id'] = $v;
                        $add_row['virtual_code_status'] = Order_GoodsVirtualCodeModel::VIRTUAL_CODE_NEW;

                        $Order_GoodsVirtualCodeModel->addCode($add_row);
                    }
                    $goods_name_str .= $order_goods_base['goods_name'] . '，';


                    //修改订单商品为已发货待收货4
                    $edit_order_goods_row['order_goods_status'] = Order_StateModel::ORDER_WAIT_CONFIRM_GOODS;
                    $Order_GoodsModel->editGoods($v, $edit_order_goods_row);

                }

                $msg_str = $msg_str . $goods_name_str . '您可凭兑换码' . $virtual_code_str . '在本店进行消费。';
                Sms::send($order_base['order_receiver_contact'], $msg_str);
                //$str = Sms::send(13918675918,"尊敬的用户您已在【变量】成功购买【变量】，您可凭兑换码【变量】在本店进行消费。");

                $goods_common_id = array_column($Order_GoodsModel->get($order_goods_id),'common_id');
                $Goods_Common = new Goods_CommonModel();
                $goods_common = current($Goods_Common->get($goods_common_id));
                //修改订单状态为已发货等待收货4
                $edit_order_row['order_status'] = Order_StateModel::ORDER_WAIT_CONFIRM_GOODS;
                $edit_order_row['order_shipping_time'] = get_date_time();
                $edit_order_row['order_receiver_date'] = $goods_common['common_virtual_date'];
                $this->editBase($order_id, $edit_order_row);
            }

            //判断是否是门店自提订单，若是门店自提订单则生成发送信息并修改订单状态为待自提
            if ($order_base['chain_id'] != 0)
            {
                $code = VerifyCode::getCode($order_base['order_receiver_contact']);

                $Chain_BaseModel = new Chain_BaseModel();
                $chain_base = $Chain_BaseModel->getOne($order_base['chain-id']);

                $order_goods_base = $Order_GoodsModel->getOne($order_goods_id[0]);

                $Order_GoodsChainCodeModel = new Order_GoodsChainCodeModel();
                $code_data['order_id']       = $order_id;
                $code_data['chain_id']       = $order_base['chain_id'];
                $code_data['order_goods_id'] = $order_goods_id[0];
                $code_data['chain_code_id']  = $code;
                $Order_GoodsChainCodeModel->addGoodsChainCode($code_data);

                //修改订单状态为待自提11
                $edit_order_goods_row['order_goods_status'] = Order_StateModel::ORDER_SELF_PICKUP;
                $Order_GoodsModel->editGoods($order_goods_id, $edit_order_goods_row);

                $edit_order_row['order_status'] = Order_StateModel::ORDER_SELF_PICKUP;
                $this->editBase($order_id, $edit_order_row);

                $message = new MessageModel();
                $message->sendMessage('Self pick up code', Perm::$userId, Perm::$row['user_account'], $order_id = NULL, $shop_name = $order_base['shop_name'], 1, 1,  Null,NULL,NULL,NULL, Null,$goods_name=$order_goods_base['goods_name'], NULL,NULL,$ztm=$code,$chain_name=$chain_base['chain_name'],$order_phone=$order_base['order_receiver_contact']);
                //$str = Sms::send(13918675918,"尊敬的用户您已在[shop_name]成功购买[goods_name]，您可凭自提码[ztm]在[chain_name]自提。");
            }

            //判断此订单是否使用了代金券，如果使用，则改变代金券的使用状态
            /*if ($order_base['voucher_id'])
            {
                $Voucher_BaseModel = new Voucher_BaseModel();
                $Voucher_BaseModel->changeVoucherState($order_base['voucher_id'], $order_base['order_id']);

                //代金券使用提醒
                $message = new MessageModel();
                $message->sendMessage('The use of vouchers to remind', Perm::$userId, Perm::$row['user_account'], $order_id = NULL, $shop_name = NULL, 0, 4);
            }*/
        }
        return $flag;
    }

    //取消订单
    public function cancelOrder($order_id)
    {
        $condition['order_status'] = Order_StateModel::ORDER_CANCEL;
        $condition['order_cancel_reason'] = '支付超时自动取消';
        $condition['order_cancel_identity'] = Order_BaseModel::IS_ADMIN_CANCEL;
        $condition['order_cancel_date'] = get_date_time();

        $this->editBase($order_id, $condition);
        $order_base=current($this->getByWhere(array('order_id'=>$order_id)));

        //修改订单商品表中的订单状态
        $Order_GoodsModel = new Order_GoodsModel();
        $edit_row['order_goods_status'] = Order_StateModel::ORDER_CANCEL;
        $order_goods_id = $Order_GoodsModel->getKeyByWhere(array('order_id' => $order_id));

        $Order_GoodsModel->editGoods($order_goods_id, $edit_row);

        //退还订单商品的库存
        if($order_base['chain_id']!=0){
            $Chain_GoodsModel = new Chain_GoodsModel();
            $chain_row['chain_id:='] = $order_base['chain_id'];
            $chain_row['goods_id:='] = is_array($order_goods_id)?$order_goods_id[0]:$order_goods_id;
            $chain_row['shop_id:='] = $order_base['shop_id'];
            $chain_goods = current($Chain_GoodsModel->getByWhere($chain_row));
            $chain_goods_id = $chain_goods['chain_goods_id'];
            $goods_stock['goods_stock'] = $chain_goods['goods_stock'] + 1;
            $Chain_GoodsModel->editGoods($chain_goods_id, $goods_stock);
        }else{
            $Goods_BaseModel = new Goods_BaseModel();
            $Goods_BaseModel->returnGoodsStock($order_goods_id);
        }

        //远程关闭paycenter中的订单状态
        $key = YLB_Registry::get('paycenter_api_key');
        $url = YLB_Registry::get('paycenter_api_url');
        $paycenter_app_id = YLB_Registry::get('paycenter_app_id');
        $formvars = array();

        $formvars['order_id'] = $order_id;
        $formvars['app_id'] = $paycenter_app_id;

        fb($formvars);

        $rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_Pay_Pay&met=cancelOrder&typ=json', $url), $formvars);
        fb($rs);
    }

    //确认收货
    public function confirmOrder($order_id)
    {
        $order_base = $this->getOne($order_id);

        $condition['order_status'] = Order_StateModel::ORDER_FINISH;

        $condition['order_finished_time'] = get_date_time();

        $flag = $this->editBase($order_id, $condition);

        //修改订单商品表中的订单状态
        $edit_row['order_goods_status'] = Order_StateModel::ORDER_FINISH;

        $Order_GoodsModel = new Order_GoodsModel();

        $order_goods_id = $Order_GoodsModel->getKeyByWhere(array('order_id' => $order_id));

        $Order_GoodsModel->editGoods($order_goods_id, $edit_row);


        //远程修改paycenter中的订单状态
        $key      = YLB_Registry::get('shop_api_key');
        $url         = YLB_Registry::get('paycenter_api_url');
        $shop_app_id = YLB_Registry::get('shop_app_id');
        $formvars = array();

        $formvars['order_id']    = $order_id;
        $formvars['app_id']        = $shop_app_id;

        fb($formvars);

        $rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_Pay_Pay&met=confirmOrder&typ=json', $url), $formvars);

        $order_payment_amount = $order_base['order_payment_amount'] - $order_base['order_shipping_fee'];

        /*
        *  经验与成长值
        */
        $user_points = Web_ConfigModel::value("points_recharge");//订单每多少获取多少金蛋
        $user_points_amount = Web_ConfigModel::value("points_order");//订单每多少获取多少金蛋

        if ($order_payment_amount / $user_points < $user_points_amount) {
            $user_points = floor($order_payment_amount / $user_points);
        } else {
            $user_points = $user_points_amount;
        }

        $user_grade = Web_ConfigModel::value("grade_recharge");//订单每多少获取多少金蛋
        $user_grade_amount = Web_ConfigModel::value("grade_order");//订单每多少获取多少成长值

        if ($order_payment_amount / $user_grade < $user_grade_amount)
        {
            $user_grade = floor($order_payment_amount / $user_grade);
        }
        else
        {
            $user_grade = $user_grade_amount;
        }

        $User_ResourceModel = new User_ResourceModel();
        //获取金蛋经验值
        $ce = $User_ResourceModel->getResource($order_base['buyer_user_id']);

        $resource_row['user_points'] = $ce[$order_base['buyer_user_id']]['user_points'] * 1 + $user_points * 1;
        $resource_row['user_growth'] = $ce[$order_base['buyer_user_id']]['user_growth'] * 1 + $user_grade * 1;

        $res_flag = $User_ResourceModel->editResource($order_base['buyer_user_id'], $resource_row);

        $User_GradeModel = new User_GradeModel;
        //升级判断
        $res_flag = $User_GradeModel->upGrade($order_base['buyer_user_id'], $resource_row['user_growth']);
        //金蛋
        $points_row['user_id'] = $order_base['buyer_user_id'];
        $points_row['user_name'] = $order_base['buyer_user_name'];
        $points_row['class_id'] = Points_LogModel::ONBUY;
        $points_row['points_log_points'] = $user_points;
        $points_row['points_log_time'] = get_date_time();
        $points_row['points_log_desc'] = '确认收货';
        $points_row['points_log_flag'] = 'confirmorder';

        $Points_LogModel = new Points_LogModel();

        $Points_LogModel->addLog($points_row);

        //成长值
        $grade_row['user_id'] = $order_base['buyer_user_id'];
        $grade_row['user_name'] = $order_base['buyer_user_name'];
        $grade_row['class_id'] = Grade_LogModel::ONBUY;
        $grade_row['grade_log_grade'] = $user_grade;
        $grade_row['grade_log_time'] = get_date_time();
        $grade_row['grade_log_desc'] = '确认收货';
        $grade_row['grade_log_flag'] = 'confirmorder';

        $Grade_LogModel = new Grade_LogModel;
        $Grade_LogModel->addLog($grade_row);
    }
	
	//获取推广订单数目
	function getPromotionOrderNum($cond_row)
	{
		return $this->getNum($cond_row);
	}

    //虚拟订单过期退货
    public function virtualReturn($order_id)
    {
        $Order_GoodsModel = new Order_GoodsModel();
        $Order_GoodsModel->sql->setWhere('order_id', $order_id);
        $goods_common_id = array_column($Order_GoodsModel->get('*'),'common_id');
        $Goods_Common = new Goods_CommonModel();
        $goods_common = current($Goods_Common->get($goods_common_id));
        if($goods_common['common_virtual_refund']){
            $Order_StateModel = new Order_StateModel();
            $flag2            = true;
            $Number_SeqModel  = new Number_SeqModel();
            $prefix           = sprintf('%s-%s-', YLB_Registry::get('shop_app_id'), date('Ymd'));
            $return_number    = $Number_SeqModel->createSeq($prefix);
            $return_id        = sprintf('%s-%s-%s-%s', 'TD', Perm::$userId, 0, $return_number);

            $field['return_message']       = _('虚拟商品过期自动退款');
            $field['return_code']          = $return_id;
            $field['return_reason_id']     = 0;
            $field['return_reason']        = "";
            $field['order_number']         = $order_id;
            $order                         = $this->orderBaseModel->getOne($order_id);
            $field['return_type']          = Order_ReturnModel::RETURN_TYPE_VIRTUAL;
            $field['return_goods_return']  = 0;
            $field['return_cash']          = $order['order_payment_amount'];
            $field['order_amount']         = $order['order_payment_amount'];
            $field['seller_user_id']       = $order['shop_id'];
            $field['seller_user_account']  = $order['shop_name'];
            $field['buyer_user_id']        = $order['buyer_user_id'];
            $field['buyer_user_account']   = $order['buyer_user_name'];
            $field['return_add_time']      = get_date_time();
            $field['return_commision_fee'] = $order['order_commission_fee'];
            //$field['return_state']         = Order_ReturnModel::RETURN_PLAT_PASS;
            $field['return_finish_time']   = get_date_time();

            $rs_row = array();
            $this->orderReturnModel->sql->startTransactionDb();

            $add_flag = $this->orderReturnModel->addReturn($field, true);
            check_rs($add_flag, $rs_row);

            $order_field['order_refund_status'] = Order_BaseModel::REFUND_IN;
            $order_field['order_refund_status'] = Order_BaseModel::REFUND_COM;
            $edit_flag                          = $this->orderBaseModel->editBase($order_id, $order_field);
            check_rs($edit_flag, $rs_row);

            $sum_data['order_refund_amount']         = $order['order_payment_amount'];
            $sum_data['order_commission_return_fee'] = $order['order_commission_fee'];
            $edit_flag                               = $this->orderBaseModel->editBase($order_id, $sum_data, true);
            check_rs($edit_flag, $rs_row);

            $key      = YLB_Registry::get('shop_api_key');
            $url         = YLB_Registry::get('paycenter_api_url');
            $shop_app_id = YLB_Registry::get('shop_app_id');

            $formvars             = array();
            $formvars['app_id']        = $shop_app_id;
            $formvars['user_id']  = $order['buyer_user_id'];
            $formvars['user_account'] = $order['buyer_user_name'];
            $formvars['seller_id'] = $order['seller_user_id'];
            $formvars['seller_account'] = $order['seller_user_name'];
            $formvars['amount']   = $order['order_payment_amount'];
            $formvars['order_id'] = $order_id;
            //$formvars['goods_id'] = $return['order_goods_id'];
            $formvars['uorder_id'] = $order['payment_number'];


            $rs                   = get_url_with_encrypt($key, sprintf('%s?ctl=Api_Pay_Pay&met=refundTransfer&typ=json', $url), $formvars);

            if ($rs['status'] == 200)
            {
                check_rs(true, $rs_row);
            }
            else
            {
                check_rs(false, $rs_row);
            }

            $flag = is_ok($rs_row);
            if ($flag && $this->orderReturnModel->sql->commitDb())
            {
                return true;
            }
            else
            {
                $this->orderReturnModel->sql->rollBackDb();
                return false;
            }
        }

    }

    public function getSubQuantity($cond_row)
    {
        return $this->getNum($cond_row);
    }
    //下单金额
    public function order_num(){
        $date = date('Y-m-d');
        // $date = '2017-02-17';
        // $cond_row  = array();
        // $cond_row['order_status:IN'] = array('2','3','4','5','6');
        // $field = 'sum(order_payment_amount)';
        $sql = "select sum(order_payment_amount) from ".$this->_tableName."  where ((payment_id='2' AND order_status='6' ) OR (payment_id='1' AND order_status IN ('2'))) AND  date_format(payment_time,'%Y-%m-%d')<'".$date."'";
        // echo $sql;die;
        $res = $this->sql->getAll($sql);

        if($res[0]['sum(order_payment_amount)']==null){
            return '0';
        }else{
            return $res[0]['sum(order_payment_amount)'];
        }

    }
    //下单会员数
    public function order_user()
    {
        $date = date('Y-m-d');
        // $date = '2017-02-17';
        $sql = "select count(*) as num from (select count(*) from ".$this->_tableName."  where ((payment_id='2' AND order_status='6') OR (payment_id='1' AND order_status IN ('2'))) AND  date_format(payment_time,'%Y-%m-%d')<'".$date."' group by buyer_user_id) as tb ";
        $res = $this->sql->getAll($sql);
        if($res[0]['num']==null){
            return '0';
        }else{
            return $res[0]['num'];
        }
    }
    //下单量
    public function order_place(){
        // $date = '2017-02-17';
        $date = date('Y-m-d');
        $sql = "select count(order_id) from ".$this->_tableName."  where ((payment_id='2' AND order_status='6') OR (payment_id='1' AND order_status IN ('2','3','4','5','6'))) AND date_format(payment_time,'%Y-%m-%d')<'".$date."'";
        $res = $this->sql->getAll($sql);
        return  $res[0]['count(order_id)'];
    }
    //平均客单价
    public function order_shop(){
        $roder_num = $this->order_num();
        $order_place = $this->order_place();
        return round($roder_num/$order_place,2);
    }
    //平均单价
    public function order_mean(){
        $orderGoodsModel = new Order_GoodsModel;
        $order_goods = $orderGoodsModel->order_goods();
        $roder_num = $this->order_num();
        return  round($roder_num/$order_goods,2);
    }
    //查询某字段
    public function getStatistics($field = '*',$cond_row,$group,$order)
    {
        return $this->select($field,$cond_row,$group,$order);
    }
    //获取表名
    public function tabase(){
        return $this->_tableName;
    }
    //运行sql
    public function sql($sql){
        return $this->sql->getAll($sql);
    }
    //运行sql
    public function _select_sql($sql,$page,$rows){
        return $this->select_sql($sql,$page,$rows);
    }

    public function getOrderStatus($order_id)
    {
        $data = $this->getOneByWhere(array('order_id' => $order_id));
        $Order_StateModel = new Order_StateModel();
        $data['order_status_con'] = $Order_StateModel->orderState[$data['order_status']];
        return $data;
    }

    //获取用户在指定商铺内的 订单数 zzh
    public function getOrderCountByUserByShop($userId,$shopId)
    {
        $cond_row['shop_id'] = $shopId;
        $cond_row['buyer_user_id'] = $userId;

        return $this -> getCount($cond_row);
    }

    /**
     * 送福免单 自动下单 I
     *
     * @param $user_id
     * @param $user_name
     * @param $goods_id
     * @return null
     */
    public function autoAddOrder($user_id,$user_name,$goods_id)
    {
        //是否有默认的收货地址
        $UserAddressModel = new User_AddressModel();
        $user_address = $UserAddressModel->getOneByWhere([
            'user_id'              => $user_id,
            'user_address_default' => 1
        ]);

        if(!$user_address)
        {
            return null;
        }

        //检测商品状态
        $Goods_BaseModel = new Goods_BaseModel();
        $goods = $Goods_BaseModel->checkGoodsII($goods_id);

        $goods_parent = [];
        if($goods)
        {
            //是否是分销商品
            if($goods['goods_common']['product_is_behalf_delivery'] && $goods['goods_common']['supply_shop_id'] && $goods['goods_base']['goods_parent_id'])
            {
                $goods['dis_flag'] = 1;
                $goods_parent_id = $goods['goods_base']['goods_parent_id'];
                $goods_parent = $Goods_BaseModel->checkGoodsII($goods_parent_id);

                if($goods_parent)
                {
                    //计算运费
                    if($goods_parent['shop_base'] && $goods_parent['shop_base']['shop_free_shipping'] > 0 && $goods_parent['goods_base']['goods_price'] > $goods_parent['shop_base']['shop_free_shipping'])
                    {
                        $cost = 0;
                    }
                    else
                    {
                        $TransportTypesModel = new Transport_TypesModel();
                        $cost = $TransportTypesModel->costII($user_address['user_address_city_id'],$goods_parent['goods_common']);
                    }
                }
                else
                {
                    return null;
                }
            }
        }
        else
        {
            return null;
        }

        $dist_flag = [];

        $this->sql->startTransactionDb();
        $data = $this->autoAddOrderCommand($user_id,$user_name,$user_address,$goods);
        check_rs($data['flag'],$dist_flag);

        if($data['flag'])
        {
            $order_id = $data['order_id'];
            $uorder   = $data['union_order'];

            if(!empty($goods_parent))
            {
                $distributor_data['order_id'] = $order_id;
                $distributor_data['shop_id']  = $goods['goods_base']['shop_id'];
                $distributor_data['cost']     = $cost;

                $dis_user_id   = $goods['shop_base']['user_id'];
                $dis_user_name = $goods['shop_base']['user_name'];
                $flag = $this->autoAddOrderCommand($dis_user_id,$dis_user_name,$user_address,$goods_parent,$distributor_data);
                check_rs($flag,$dist_flag);
            }
        }
        else
        {
            $order_id = null;
        }

        if (is_ok($dist_flag) && $this->sql->commitDb())
        {
            YLB_Log::log("order_id=$order_id,uorder=$uorder",YLB_Log::INFO,'autoAddOrder');
            if($uorder)
            {
                $shop_api_key      = YLB_Registry::get('shop_api_key');
                $paycenter_api_url = YLB_Registry::get('paycenter_api_url');
                $shop_app_id       = YLB_Registry::get('shop_app_id');

                $formvars                   = array();
                $formvars['app_id']		    = $shop_app_id;
                $formvars['from_app_id']    = $shop_app_id;
                $formvars['uorder']         = $uorder;
                $formvars['user_id']        = $user_id;
                $formvars['auto_add_order'] = 1;
                $rs = get_url_with_encrypt($shop_api_key, sprintf('%s?ctl=Api_Pay_Pay&met=autoPay&typ=json',$paycenter_api_url), $formvars);
            }
        }

        return $order_id;
    }

    /**
     * 送福免单 自动下单 II
     *
     * @param $user_id               买家id
     * @param $user_name             买家用户名
     * @param $user_address          收货地址
     * @param $goods                 商品信息
     * @param null $distributor_data 分销信息
     * @return mixed
     */
    public function autoAddOrderCommand($user_id,$user_name,$user_address,$goods,$distributor_data = null)
    {
        $data['flag'] = true;

        if($goods['shop_base'])
        {
            $shop_id          = $goods['shop_base']['shop_id'];
            $seller_user_id   = $goods['shop_base']['user_id'];
            $seller_user_name = $goods['shop_base']['user_name'];
            $shop_name        = $goods['shop_base']['shop_name'];
            $district_id      = $goods['shop_base']['district_id'];

            if($user_address)
            {
                $receiver_name     = $user_address['user_address_contact'];
                $receiver_address  = $user_address['user_address_area'] . ' ' . $user_address['user_address_address'];
                $receiver_phone    = $user_address['user_address_phone'];

                //获取用户保障信息
                $Shop_ContractModel = new Shop_ContractModel();
                $cond_con['shop_id']	 = $shop_id;
                $cond_con['contract_state']	 = Shop_ContractModel::CONTRACT_JOIN;
                $cond_con['contract_use_state'] = Shop_ContractModel::CONTRACT_INUSE;
                $contract = $Shop_ContractModel->getByWhere($cond_con);
                $shop_contract = array_column($contract,'contract_type_id');

                $shop_api_key      = YLB_Registry::get('shop_api_key');
                $paycenter_api_url = YLB_Registry::get('paycenter_api_url');
                $shop_app_id       = YLB_Registry::get('shop_app_id');

                $Number_SeqModel     = new Number_SeqModel();
                $Order_GoodsModel    = new Order_GoodsModel();
                $Order_GoodsSnapshot = new Order_GoodsSnapshot();
                $Goods_BaseModel     = new Goods_BaseModel();

                $goods_price = 0;
                $cost = 0;


                //新增订单
                $order_row    = array();
                $prefix       = sprintf('%s-%s-', $shop_app_id, date('Ymd'));
                $order_number = $Number_SeqModel->createSeq($prefix);
                if($distributor_data)
                {
                    $order_id = sprintf('%s-%s-%s-%s', 'SP', $seller_user_id,$shop_id, $order_number);
                    $order_row['order_source_id'] = $distributor_data['order_id'];

                    $goods_price = $goods['goods_base']['goods_price'];
                    $cost = $distributor_data['cost'];
                    if($distributor_data['shop_id'])
                    {
                        $ShopDistributorModel      = new Distribution_ShopDistributorModel();
                        $ShopDistributorLevelModel = new Distribution_ShopDistributorLevelModel();

                        //获取供货商给该分销商设置的折扣
                        $shop_distributor_info     = $ShopDistributorModel->getOneByWhere(array('shop_id' =>$shop_id,'distributor_id'=>$distributor_data['shop_id'],'distributor_enable'=>1));
                        $distributor_rate_info     = $ShopDistributorLevelModel->getOne($shop_distributor_info['distributor_level_id']);

                        //商品价格：供应商的进货价-分销商等级优惠+供应商设置的物流费用
                        $discount_rate = 100;
                        if($distributor_rate_info && $distributor_rate_info['distributor_leve_discount_rate'] > 0 && $distributor_rate_info['distributor_leve_discount_rate'] < 100)
                        {
                            $discount_rate = $distributor_rate_info['distributor_leve_discount_rate'];
                        }
                        $goods_price = number_format(($goods_price * $discount_rate / 100), 2, '.', '');
                    }
                }
                else
                {
                    $order_id = sprintf('%s-%s-%s-%s', 'DD', $seller_user_id, $shop_id, $order_number);
                }
                $order_row['order_id']               = $order_id;
                $order_row['shop_id']                = $shop_id;
                $order_row['shop_name']              = $shop_name;
                $order_row['buyer_user_id']          = $user_id;
                $order_row['buyer_user_name']        = $user_name;
                $order_row['seller_user_id']         = $seller_user_id;
                $order_row['seller_user_name']       = $seller_user_name;
                $order_row['order_date']             = date('Y-m-d');
                $order_row['order_create_time']      = get_date_time();
                $order_row['order_receiver_name']    = $receiver_name;
                $order_row['order_receiver_address'] = $receiver_address;
                $order_row['order_receiver_contact'] = $receiver_phone;
                $order_row['order_goods_amount']     = $goods_price; //订单商品总价（不包含运费）
                $order_row['order_shipping_fee']     = $cost;
                $order_row['order_payment_amount']   = $goods_price + $cost;// 订单实际支付金额 = 商品实际支付金额 + 运费
                $order_row['order_discount_fee']     = 0;   //优惠价格 = 商品总价 - 商品实际支付金额
                $order_row['order_point_fee']        = 0;    //买家使用金蛋
                $order_row['order_message']          = '';
                $order_row['order_status']           = Order_StateModel::ORDER_WAIT_PAY;
                $order_row['order_points_add']       = 0;    //订单赠送的金蛋
                $order_row['order_from']             = Order_StateModel::FROM_FU;    //订单来源
                $order_row['order_commission_fee']   = 0;
                $order_row['order_is_virtual']       = 0;    //1-虚拟订单 0-实物订单
                $order_row['order_shop_benefit']     = 0;  //店铺优惠
                $order_row['payment_id']			 = 1;
                $order_row['payment_name']			 = '在线支付';
                $order_row['directseller_discount']  = 0;//分销商折扣
                $order_row['district_id']            = $district_id;
                $order_row['shop_contract']          = $shop_contract ? $shop_contract : '';

                $order_row['order_type'] = Order_BaseModel::ORDER_NO_SPLIT;
                if($goods['dis_flag'])
                {
                    $order_row['order_type'] = Order_BaseModel::ORDER_DIS;
                }
                else if($distributor_data)
                {
                    $order_row['order_type'] = Order_BaseModel::ORDER_SP;
                }
                $flag1 = $this -> addBase($order_row);
                $data['flag'] = $data['flag'] && $flag1;

                //添加订单商品
                $order_goods_row                                  = array();
                $order_goods_row['order_id']                      = $order_id;
                $order_goods_row['buyer_user_id']                 = $user_id;
                $order_goods_row['order_goods_num']               = 1;
                $order_goods_row['goods_price']                   = $goods_price;       //商品原来的单价
                $order_goods_row['order_goods_payment_amount']    = $goods_price; //商品实际支付单价
                $order_goods_row['order_goods_amount']            = $goods_price; //商品实际支付金额
                $order_goods_row['order_goods_discount_fee']      = 0;//优惠价格
                $order_goods_row['order_goods_adjust_fee']        = 0;    //手工调整金额
                $order_goods_row['order_goods_point_fee']         = 0;    //金蛋费用
                $order_goods_row['shop_id']                       = $shop_id;
                $order_goods_row['order_goods_status']            = Order_StateModel::ORDER_WAIT_PAY;
                $order_goods_row['order_goods_evaluation_status'] = 0;  //0未评价 1已评价
                $order_goods_row['order_goods_time']              = get_date_time();
                $order_goods_row['goods_id']                      = $goods['goods_base']['goods_id'];
                $order_goods_row['common_id']                     = $goods['goods_base']['common_id'];
                $order_goods_row['goods_name']                    = $goods['goods_base']['goods_name'];
                $order_goods_row['goods_image']                   = $goods['goods_base']['goods_image'];
                $order_goods_row['goods_class_id']                = $goods['goods_base']['cat_id'];
                $order_goods_row['order_spec_info']               = $goods['goods_base']['spec'];
                $order_goods_row['order_goods_commission']        = 0;    //商品佣金(总)
                $order_goods_row['directseller_goods_discount']   = 0;//分销商折扣
                if($goods['goods_base']['goods_parent_id'])
                {
                    $order_goods_row['goods_parent_id'] = $goods['goods_base']['goods_parent_id'];
                }

                $order_goods_row['order_goods_benefit'] = '送福免单';
                $flag2 = $Order_GoodsModel->addGoods($order_goods_row);
                $data['flag'] = $data['flag'] && $flag2;

                //加入交易快照表
                $order_goods_snapshot_add_row = array();
                $order_goods_snapshot_add_row['order_id'] 		 = $order_id;
                $order_goods_snapshot_add_row['user_id'] 		 = $user_id;
                $order_goods_snapshot_add_row['shop_id'] 		 = $shop_id;
                $order_goods_snapshot_add_row['common_id'] 	     = $order_goods_row['common_id'];
                $order_goods_snapshot_add_row['goods_id'] 		 = $order_goods_row['goods_id'];
                $order_goods_snapshot_add_row['goods_name'] 	 = $order_goods_row['goods_name'];
                $order_goods_snapshot_add_row['goods_image'] 	 = $order_goods_row['goods_image'];
                $order_goods_snapshot_add_row['goods_price'] 	 = $order_goods_row['order_goods_payment_amount'];
                $order_goods_snapshot_add_row['goods_spec']      = $order_goods_row['order_spec_info'];
                $order_goods_snapshot_add_row['freight'] 		 = 0;   //运费
                $order_goods_snapshot_add_row['snapshot_detail'] = $order_goods_row['order_goods_benefit'];
                $order_goods_snapshot_add_row['snapshot_uptime'] = get_date_time();
                $order_goods_snapshot_add_row['snapshot_create_time'] =	get_date_time();
                $Order_GoodsSnapshot->addSnapshot($order_goods_snapshot_add_row);

                //删除商品库存
                $flag3 = $Goods_BaseModel->delStock($order_goods_row['goods_id'], 1);
                $data['flag'] = $data['flag'] && $flag3;

                //支付中心生成订单
                $formvars                         = array();
                $formvars['app_id']				  = $shop_app_id;
                $formvars['from_app_id']          = $shop_app_id;
                $formvars['consume_trade_id']     = $order_id;
                $formvars['order_id']             = $order_id;
                $formvars['buy_id']               = $user_id;
                $formvars['buyer_name'] 		  = $user_name;
                $formvars['seller_id']            = $order_row['seller_user_id'];
                $formvars['seller_name']		  = $order_row['seller_user_name'];
                $formvars['order_state_id']       = $order_row['order_status'];
                $formvars['order_payment_amount'] = $order_row['order_payment_amount'];
                $formvars['order_commission_fee'] = $order_row['order_commission_fee'];
                $formvars['trade_remark']         = $order_row['order_message'];
                $formvars['trade_create_time']    = $order_row['order_create_time'];
                $formvars['trade_title']		  = $goods['goods_base']['goods_name']; //商品名称 - 标题
                $formvars['auto_add_order']       = 1;
                $rs = get_url_with_encrypt($shop_api_key, sprintf('%s?ctl=Api_Pay_Pay&met=addConsumeTrade&typ=json',$paycenter_api_url), $formvars);

                //将合并支付单号插入数据库
                if($rs['status'] == 200)
                {
                    $this->editBase($order_id,array('payment_number' => $rs['data']['union_order']));
                    $data['flag'] = $data['flag'] && true;
                    $data['union_order'] = $rs['data']['union_order'];
                    $data['order_id'] = $order_id;
                }
                else
                {
                    $data['flag'] = $data['flag'] && false;
                }
            }
            else
            {
                $data['flag'] = false;
            }

        }
        else
        {
            $data['flag'] = false;
        }

        return $data;
    }
}

?>