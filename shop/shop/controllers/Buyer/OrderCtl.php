<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Buyer_OrderCtl extends Buyer_Controller
{
    public $tradeOrderModel = null;

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

        $this->tradeOrderModel = new Order_BaseModel();
        date_default_timezone_set("PRC");
    }


    public function index()
    {
        include $this->view->getView();
    }

    /**
     * 实物交易订单
     *
     * @access public
     */
    public function physical()
    {
        $act      = request_string('act');
        $order_id = request_string('order_id');

        //订单详情页
        if ($act == 'details')
        {
            $data = $this->tradeOrderModel->getOrderDetail($order_id);
            $arr = array();
            foreach($data['goods_list'] as $key => $v) {
                $arr = $v;
            }
            $this->view->setMet('details');
        }
        else
        {
            $YLB_Page           = new YLB_Page();
            $YLB_Page->listRows = 10;
            $rows              = $YLB_Page->listRows;
            $offset            = request_int('firstRow', 0);
            $page              = ceil_r($offset / $rows);

            $status  = request_string('status');
            $recycle = request_int('recycle');
            if ($status == 'wait_pay')
            {
                //待付款
                $order_row['order_status'] = Order_StateModel::ORDER_WAIT_PAY;
            }
            else if ($status == 'wait_perpare_goods')
            {
                //待发货 -> 只可退款
                $order_row['order_status'] = Order_StateModel::ORDER_WAIT_PREPARE_GOODS;
            }
            else if ($status == 'order_payed')
            {
                //已付款
                $order_row['order_status:IN'] = array(Order_StateModel::ORDER_PAYED,Order_StateModel::ORDER_WAIT_PREPARE_GOODS);
                $order_row['order_refund_status'] = Order_BaseModel::REFUND_NO;
            }
            else if ($status == 'wait_confirm_goods')
            {
                //待收货
                $order_row['order_status'] = Order_StateModel::ORDER_WAIT_CONFIRM_GOODS;
            }
            else if ($status == 'finish')
            {
                //待评价
                $order_row['order_status'] = Order_StateModel::ORDER_FINISH;
                $order_row['order_buyer_evaluation_status'] = Order_BaseModel::BUYER_EVALUATE_NO;
            }
            else if ($status == 'cancel')
            {
                //已取消
                $order_row['order_status'] = Order_StateModel::ORDER_CANCEL;
            }

            //订单回收站
            if ($recycle)
            {
                $order_row['order_buyer_hidden'] = Order_BaseModel::IS_BUYER_HIDDEN;
            }
            else
            {
                $order_row['order_buyer_hidden:!='] = Order_BaseModel::IS_BUYER_HIDDEN;
            }

            if (request_string('start_date'))
            {
                $order_row['order_create_time:>'] = request_string('start_date');
            }
            if (request_string('end_date'))
            {
                $order_row['order_create_time:<'] = request_string('end_date');
            }
            if (request_string('orderkey'))
            {
                $order_row['order_id:LIKE'] = '%' . request_string('orderkey') . '%';
            }

            $user_id                           = Perm::$row['user_id'];
            $order_row['buyer_user_id']        = $user_id;
            $order_row['order_buyer_hidden:<'] = Order_BaseModel::IS_BUYER_REMOVE;
            $order_row['order_is_virtual']     = Order_BaseModel::ORDER_IS_REAL; //实物订单
            $order_row['chain_id']             = 0; //不是门店自提订单

            if($this->typ == 'json')
            {
                $order_row['order_type:<>'] = Order_BaseModel::ORDER_SPLIT;
            }
            else
            {
                if(!isset($order_row['order_status']) && !isset($order_row['order_status:IN']))
                {
                    $order_row['order_type:<'] = Order_BaseModel::ORDER_CHILD;
                }
            }

            $data = $this->tradeOrderModel->getBaseList($order_row, array('order_create_time' => 'DESC'), $page, $rows);

            if($data['items'])
            {
                //客服信息
                $shop_id_row = array_unique(array_column($data['items'],'shop_id'));
                $ShopCustomServiceModel = new Shop_CustomServiceModel;
                $service_row = $ShopCustomServiceModel->getByWhere(array('shop_id:IN'=>$shop_id_row));
                $new_service_row = array();
                foreach ($service_row as $key => $val)
                {
                    $new_service_row[$val['shop_id']][] = $val;
                }

                //拆单信息
                foreach ($data['items'] as $key => $value)
                {
                    if($value['order_type'] == Order_BaseModel::ORDER_SPLIT)
                    {
                        $order_id_row[] = $value['order_id'];
                    }
                }
                if($order_id_row)
                {
                    $split_order_row = $this->tradeOrderModel->getBaseList(array('order_source_id:IN'=>$order_id_row,'order_type:>='=>Order_BaseModel::ORDER_CHILD),'','','',false);
                    $new_split_order_row = array();
                    foreach ($split_order_row['items'] as $key => $val)
                    {
                        $new_split_order_row[$val['order_source_id']][] = $val;
                    }
                }

                //重新组合 客服信息和拆单信息
                foreach ($data['items'] as $key =>$val)
                {
                    if(isset($new_service_row[$val['shop_id']]))
                    {
                        $service = $new_service_row[$val['shop_id']];
                        foreach ($service as $k => $v)
                        {
                            if ($v['tool'] == 3)
                            {
                                $v["tool"] = '<a href="javascript:;"  data-order="'.$val['order_id'].'" class="chat-enter" rel="'.$v['number'].'" ><img src="'.$this->view->img.'/icon-im.gif" alt=""></a>';
                            }

                            if ($v['type'] == 1)
                            {
                                $data['items'][$key]['service']['after'][] = $v;
                            }
                            else
                            {
                                $data['items'][$key]['service']['pre'][] = $v;
                            }
                        }
                    }

                    if(isset($new_split_order_row[$val['order_id']]))
                    {
                        $data['items'][$key]['split_order'] = $new_split_order_row[$val['order_id']];
                    }
                }
            }


            $YLB_Page->totalRows = $data['totalsize'];
            $page_nav            = $YLB_Page->prompt();
        }


        if ('json' == $this->typ)
        {
            $this->data->addBody(-140, $data);
        }
        else
        {
            include $this->view->getView();
        }
    }

    //取消退款
    public function cancel(){
        $Order_ReturnModel = new Order_ReturnModel();
        $Order_BaseModel = new Order_BaseModel();
        $Order_StateModel = new Order_StateModel();
        $order_id = request_string('order_id');
        $sql = "delete from ".$Order_ReturnModel->tabase()." where order_number = '".$order_id."'";
//
        $flag = $Order_ReturnModel->sql($sql);
        if(empty($flag)){
            $sql="update ".$Order_BaseModel->tabase()." set order_refund_status=".Order_StateModel::ORDER_GOODS_RETURN_NO." where order_id = '".$order_id."'";
            $res = $Order_BaseModel->sql($sql);
        }
        if (empty($flag))
        {
            $status = 200;
            $msg    = _('success');
        }
        else
        {
            $msg    = _('failure');
            $status = 250;
        }

        $this->data->addBody(-140, array(), $msg, $status);
    }

    /**
     * 确认收货
     *
     * @author WenQingTeng
     */
    public function confirmOrder()
    {
        $typ = request_string('typ');

        if ($typ == 'e')
        {
            include $this->view->getView();
        }
        else
        {
            $Order_BaseModel = new Order_BaseModel();
            $Shop_BaseModel = new Shop_BaseModel();
            //开启事物
            $Order_BaseModel->sql->startTransactionDb();

            $order_id = request_string('order_id');

            $order_base = $Order_BaseModel->getOne($order_id);

            //判断下单者是否是当前用户
            if($order_base['buyer_user_id'] == Perm::$userId && $order_base['order_status'] == Order_StateModel::ORDER_WAIT_CONFIRM_GOODS)
            {
                //供应商的订单不允许 直接确认收货  只能由买家确认收货后-->系统自动确认收货
                if($order_base['order_type'] != Order_BaseModel::ORDER_SP)
                {
                    //修改金蛋和成长值去掉运费 Zhenzh20180508
                    $order_payment_amount = $order_base['order_payment_amount'] - $order_base['order_shipping_fee'];

                    //金蛋与成长值
                    $user_points        = Web_ConfigModel::value("points_recharge");//订单每多少获取多少金蛋
                    $user_points_amount = Web_ConfigModel::value("points_order");//订单每多少获取多少金蛋

                    if ($order_payment_amount / $user_points < $user_points_amount)
                    {
                        $user_points = floor($order_payment_amount / $user_points);
                    }
                    else
                    {
                        $user_points = $user_points_amount;
                    }

                    $user_grade        = Web_ConfigModel::value("grade_recharge");//订单每多少获取多少金蛋
                    $user_grade_amount = Web_ConfigModel::value("grade_order");//订单每多少获取多少成长值

                    if ($order_payment_amount / $user_grade > $user_grade_amount)
                    {
                        $user_grade = floor($order_payment_amount / $user_grade);
                    }
                    else
                    {
                        $user_grade = $user_grade_amount;
                    }

                    $User_ResourceModel = new User_ResourceModel();
                    //获取金蛋经验值
                    $ce = $User_ResourceModel->getResource(Perm::$userId);

                    $resource_row['user_points'] = $ce[Perm::$userId]['user_points'] * 1 + $user_points * 1;
                    $resource_row['user_growth'] = $ce[Perm::$userId]['user_growth'] * 1 + $user_grade * 1;

                    $res_flag = $User_ResourceModel->editResource(Perm::$userId, $resource_row);

                    $User_GradeModel = new User_GradeModel;
                    //升级判断
                    $res_flag = $User_GradeModel->upGrade(Perm::$userId, $resource_row['user_growth']);

                    //金蛋
                    $points_row['user_id']           = Perm::$userId;
                    $points_row['user_name']         = Perm::$row['user_account'];
                    $points_row['class_id']          = Points_LogModel::ONBUY;
                    $points_row['points_log_points'] = $user_points;
                    $points_row['points_log_time']   = get_date_time();
                    $points_row['points_log_desc']   = '确认收货';
                    $points_row['points_log_flag']   = 'confirmorder';
                    $Points_LogModel = new Points_LogModel();
                    $Points_LogModel->addLog($points_row);

                    //成长值
                    $grade_row['user_id']         = Perm::$userId;
                    $grade_row['user_name']       = Perm::$row['user_account'];
                    $grade_row['class_id']        = Grade_LogModel::ONBUY;
                    $grade_row['grade_log_grade'] = $user_grade;
                    $grade_row['grade_log_time']  = get_date_time();
                    $grade_row['grade_log_desc']  = '确认收货';
                    $grade_row['grade_log_flag']  = 'confirmorder';
                    $Grade_LogModel = new Grade_LogModel;
                    $Grade_LogModel->addLog($grade_row);

                    $condition['order_status']        = Order_StateModel::ORDER_FINISH;
                    $condition['order_points_add']    = $user_points;
                    $condition['order_grade_add']     = $user_grade;
                    $condition['order_finished_time'] = get_date_time();
                    $flag = $Order_BaseModel->editBase($order_id, $condition);

                    //修改订单商品表中的订单状态
                    $edit_row['order_goods_status'] = Order_StateModel::ORDER_FINISH;
                    $Order_GoodsModel               = new Order_GoodsModel();
                    $order_goods_id                 = $Order_GoodsModel->getKeyByWhere(array('order_id' => $order_id));
                    $Order_GoodsModel->editGoods($order_goods_id, $edit_row);

                    //货到付款时修改商品销量
                    if($order_base['payment_id'] == PaymentChannlModel::PAY_CONFIRM){
                        $Goods_BaseModel = new Goods_BaseModel();
                        $Goods_BaseModel->editGoodsSale($order_goods_id);
                    }
                    //将需要确认的订单号远程发送给Paycenter修改订单状态
                    //远程修改paycenter中的订单状态
                    $key         = YLB_Registry::get('shop_api_key');
                    $url         = YLB_Registry::get('paycenter_api_url');
                    $shop_app_id = YLB_Registry::get('shop_app_id');
                    $formvars = array();

                    $formvars['order_id']    = $order_id;
                    $formvars['app_id']        = $shop_app_id;
                    $formvars['from_app_id'] = YLB_Registry::get('shop_app_id');

                    $rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_Pay_Pay&met=confirmOrder&typ=json', $url), $formvars);

                    if($rs['status'] == 250)
                    {
                        $Order_BaseModel->msg->setMessages('确认失败');
                        $flag = false;
                    }

                    //查看是否是用户购买的分销商从供货商处淘金的支持代发货的商品，如果是改变订单状态
                    if($order_base['order_type'] == Order_BaseModel::ORDER_DIS || $order_base['order_type'] == Order_BaseModel::ORDER_CHILD_DIS)
                    {
                        $sp_order = $Order_BaseModel->getOneByWhere(array('order_source_id'=>$order_base['order_id']));
                        if($sp_order)
                        {
                            $condition['payment_other_number'] = $sp_order['payment_number'];
                            $Order_BaseModel->editBase($sp_order['order_id'], $condition);

                            $dist_goods_id = $Order_GoodsModel->getKeyByWhere(array('order_id' => $sp_order['order_id']));
                            $Order_GoodsModel->editGoods($dist_goods_id, $edit_row);

                            $formvars['order_id'] = $sp_order['order_id'];
                            $rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_Pay_Pay&met=confirmOrder&typ=json', $url), $formvars);
                            if($rs['status'] == 250)
                            {
                                get_url_with_encrypt($key, sprintf('%s?ctl=Api_Pay_Pay&met=confirmOrder&typ=json', $url), $formvars);
                            }
                        }
                    }

                    //分销商进货
                    $shop_detail = $Shop_BaseModel->getOne($order_base['shop_id']);
                    if(Perm::$shopId && $shop_detail['shop_type'] == 2)
                    {
                        $this->add_product($order_id);
                    }
                }
                else
                {
                    $Order_BaseModel->msg->setMessages('请等待买家确认收货');
                    $flag = false;
                }
            }
            else
            {
                $Order_BaseModel->msg->setMessages('下单者不是当前用户');
                $flag = false;
            }

            if ($flag && $Order_BaseModel->sql->commitDb())
            {
                //确认收货 修改分享的状态 和到账时间Zhenzh
                $sharePriceModel = new Share_PriceModel();
                $share_price_id = $sharePriceModel ->getKeyByWhere(array('share_order_id'=>$order_id,'promotion_click_count:>'=>0));
                if($share_price_id)
                {
                    $cond_share_price['dz_date'] = strtotime('+1 week',strtotime($condition['order_finished_time']));
                    $cond_share_price['status'] = Share_PriceModel::FORZEN;
                    $share_price_flag = $sharePriceModel->editSharePrice($share_price_id,$cond_share_price);
                    if($share_price_flag)
                    {
                        $shop_api_key      = YLB_Registry::get('shop_api_key');
                        $paycenter_api_url = YLB_Registry::get('paycenter_api_url');
                        $shop_app_id       = YLB_Registry::get('shop_app_id');

                        $formvars_share                   = array();
                        $formvars_share['share_price_id'] = $share_price_id;
                        $formvars_share['app_id']         = $shop_app_id;
                        $formvars_share['share_uid']      = Perm::$userId;

                        get_url_with_encrypt($shop_api_key, sprintf('%s?ctl=Api_Pay_Pay&met=editForzenSharePrice&typ=json', $paycenter_api_url), $formvars_share);
                    }
                }

                $status = 200;
                $msg    = _('success');
            }
            else
            {
                $Order_BaseModel->sql->rollBackDb();
                $m      = $Order_BaseModel->msg->getMessages();
                $msg    = $m ? $m[0] : _('failure');
                $status = 250;
            }

            $this->data->addBody(-140, array(), $msg, $status);
        }

    }

    /**
     * 删除订单
     *
     * @author WenQingTeng
     */
    public function hideOrder()
    {
        $order_id = request_string('order_id');
        $user     = request_string('user');
        $op       = request_string('op');

        $edit_row = array();

        $Order_BaseModel = new Order_BaseModel();
        //买家删除订单
        if ($user == 'buyer')
        {
            if ($op == 'del')
            {
                $edit_row['order_buyer_hidden'] = Order_BaseModel::IS_BUYER_REMOVE;
            }
            else
            {
                $edit_row['order_buyer_hidden'] = Order_BaseModel::IS_BUYER_HIDDEN;
            }

        }
        if ($user == 'seller')
        {
            if ($op == 'del')
            {
                $edit_row['order_shop_hidden'] = Order_BaseModel::IS_SELLER_REMOVE;
            }
            else
            {
                $edit_row['order_shop_hidden'] = Order_BaseModel::IS_SELLER_HIDDEN;
            }

        }

        $flag = $Order_BaseModel->editBase($order_id, $edit_row);

        if ($flag)
        {
            $status = 200;
            $msg    = _('success');
        }
        else
        {
            $msg    = _('failure');
            $status = 250;
        }

        $this->data->addBody(-140, array(), $msg, $status);
    }

    /**
     * 还原回收站中的订单
     *
     * @author WenQingTeng
     */
    public function restoreOrder()
    {
        $order_id = request_string('order_id');
        $user     = request_string('user');

        $edit_row = array();

        $Order_BaseModel = new Order_BaseModel();
        //还原买家隐藏订单
        if ($user == 'buyer')
        {
            $edit_row['order_buyer_hidden'] = Order_BaseModel::NO_BUYER_HIDDEN;
        }
        if ($user == 'seller')
        {
            $edit_row['order_shop_hidden'] = Order_BaseModel::NO_SELLER_HIDDEN;
        }

        $flag = $Order_BaseModel->editBase($order_id, $edit_row);

        if ($flag)
        {
            $status = 200;
            $msg    = _('success');
        }
        else
        {
            $msg    = _('failure');
            $status = 250;
        }

        $this->data->addBody(-140, array(), $msg, $status);

    }

    /**
     * 虚拟兑换订单
     *
     * @author WenQingTeng
     */
    public function virtual()
    {
        $act      = request_string('act');
        $order_id = request_string('order_id');

        //订单详情页
        if ($act == 'detail')
        {
            $data = $this->tradeOrderModel->getOrderDetail($order_id);
            $this->view->setMet('detail');
        }
        else
        {
            $YLB_Page           = new YLB_Page();
            $YLB_Page->listRows = 10;
            $rows              = $YLB_Page->listRows;
            $offset            = request_int('firstRow', 0);
            $page              = ceil_r($offset / $rows);


            $status  = request_string('status');
            $recycle = request_int('recycle');
            //待付款
            if ($status == 'wait_pay')
            {
                $order_row['order_status'] = Order_StateModel::ORDER_WAIT_PAY;
            }
            //待发货 -> 只可退款
            if ($status == 'wait_perpare_goods')
            {
                $order_row['order_status'] = Order_StateModel::ORDER_WAIT_PREPARE_GOODS;
            }
            //待收货、已发货 -> 退款退货
            if ($status == 'wait_confirm_goods')
            {
                $order_row['order_status'] = Order_StateModel::ORDER_WAIT_CONFIRM_GOODS;
            }
            //已完成 -> 订单评价
            if ($status == 'finish')
            {
                $order_row['order_status'] = Order_StateModel::ORDER_FINISH;
            }
            //已取消
            if ($status == 'cancel')
            {
                $order_row['order_status'] = Order_StateModel::ORDER_CANCEL;
            }
            //订单回收站
            if ($recycle)
            {
                $order_row['order_buyer_hidden'] = Order_BaseModel::IS_BUYER_CANCEL;
            }
            else
            {
                $order_row['order_buyer_hidden:!='] = Order_BaseModel::IS_BUYER_HIDDEN;
            }

            if (request_string('start_date'))
            {
                $order_row['order_create_time:>'] = request_string('start_date');
            }
            if (request_string('end_date'))
            {
                $order_row['order_create_time:<'] = request_string('end_date');
            }
            if (request_string('orderkey'))
            {
                $order_row['order_id:LIKE'] = '%' . request_string('key') . '%';
            }


            $user_id                            = Perm::$row['user_id'];
            $order_row['buyer_user_id']         = $user_id;
            $order_row['order_buyer_hidden:<'] = Order_BaseModel::IS_BUYER_REMOVE;
            $order_row['order_is_virtual']      = Order_BaseModel::ORDER_IS_VIRTUAL; //虚拟订单
            $data                               = $this->tradeOrderModel->getBaseList($order_row, array('order_create_time' => 'DESC'), $page, $rows);

            fb($data);
            fb("订单列表");
            $YLB_Page->totalRows = $data['totalsize'];
            $page_nav           = $YLB_Page->prompt();
        }
        /*var_dump($data);die;*/
        if ('json' == $this->typ)
        {
            $this->data->addBody(-140, $data);
        }
        else
        {
            include $this->view->getView();
        }
    }

    /**
     * 评价订单/晒单
     *
     * @author WenQingTeng
     */
    public function evaluation()
    {
        $order_id = request_string('order_id');

        $act = request_string('act');
        if ($act == 'again')
        {
            $evaluation_goods_id = request_int("oge_id");

            //获取已评价信息
            $Goods_EvaluationModel = new Goods_EvaluationModel();
            $data = $Goods_EvaluationModel->getOne($evaluation_goods_id);
            if($data['image'])
            {
                $data['image_row'] = explode(',',$data['image']);
                $data['image_row'] = array_filter($data['image_row']);
            }

            //商品信息
            $Order_GoodsModel = new Order_GoodsModel();
            $data['goods_base'] = current($Order_GoodsModel->getByWhere(array('goods_id'=>$data['goods_id'],'order_id'=>$data['order_id'])));

            //订单信息
            $Order_BaseModel    = new Order_BaseModel();
            $data['order_base'] = $Order_BaseModel->getOne($data['order_id']);

            //评价用户的信息
            $User_InfoModel = new User_InfoModel();
            $data['user_info'] = $User_InfoModel->getOne($data['order_base']['buyer_user_id']);

            fb($data);

            $this->view->setMet('evalagain');
        }
        elseif ($act == 'add')
        {
            //订单信息
            $Order_BaseModel    = new Order_BaseModel();
            $data['order_base'] = $Order_BaseModel->getOne($order_id);

            //评价用户的信息
            $User_InfoModel = new User_InfoModel();
            $data['user_info'] = $User_InfoModel->getOne($data['order_base']['buyer_user_id']);

            //店铺信息
            $Shop_BaseModel    = new Shop_BaseModel();
            $data['shop_base'] = $Shop_BaseModel->getOne($data['order_base']['shop_id']);

            //查找出订单中的商品
            $Order_GoodsModel   = new Order_GoodsModel();
            $order_goods_id_row = $Order_GoodsModel->getKeyByWhere(array('order_id' => $order_id));

            //商品信息
            foreach ($order_goods_id_row as $ogkey => $order_good_id)
            {
                $data['order_goods'][] = $Order_GoodsModel->getOne($order_good_id);
            }
            fb($data);

            if ('json' == $this->typ)
            {
                $this->data->addBody(-140, $data);
            }
            else
            {
                $this->view->setMet('evaladd');
            }
        }
        else
        {
            $YLB_Page           = new YLB_Page();
            $YLB_Page->listRows = 10;
            $rows              = $YLB_Page->listRows;
            $offset            = request_int('firstRow', 0);
            $page              = ceil_r($offset / $rows);


            //获取买家的所有评论
            $user_id = Perm::$userId;

            $Goods_EvaluationModel = new Goods_EvaluationModel();

            $goods_evaluation_row            = array();
            $goods_evaluation_row['user_id'] = $user_id;

            $data = $Goods_EvaluationModel->getEvaluationByUser($goods_evaluation_row, array(), $page, $rows);
            fb($data);
            $YLB_Page->totalRows = $data['totalsize'];
            $page_nav           = $YLB_Page->prompt();

        }

        include $this->view->getView();
    }

    /**
     * 生成实物订单
     *
     * @author WenQingTeng
     */
    public function addOrder()
    {
        if(!Perm::checkUserPerm())
        {
            $this->data->addBody(-140, array(), '订单提交失败!!', 250);
            return false;
        }
        $flag              = true;
        $user_id           = Perm::$row['user_id'];
        $user_account      = Perm::$row['user_account'];
        /*$receiver_name     = request_string('receiver_name');
        $receiver_address  = request_string('receiver_address');
        $receiver_phone    = request_string('receiver_phone');
        $city_id           = request_int('city_id');*/
        $address_id        = request_int('address_id');
        $invoice           = request_string('invoice');
        $cart_id           = request_row("cart_id");
        $shop_id           = request_row("shop_id");
        $remark            = request_row("remark");
        $increase_goods_id = request_row("increase_goods_id");
        $voucher_id        = request_row('voucher_id');
        $pay_way_id        = 1;//request_int('pay_way_id');//统一在线支付
        $invoice_id		   = request_int('invoice_id');
        $from              = request_string('from');
        $rpacket_id		   = request_int('rpt',0);

        if($from == 'pc')
        {
            $order_from = Order_StateModel::FROM_PC;
        }
        elseif($from == 'wap')
        {
            $order_from = Order_StateModel::FROM_WAP;
        }
        elseif($from == 'app')
        {
            $order_from = Order_StateModel::FROM_APP;
        }
        elseif($from == 'android')
        {
            $order_from = Order_StateModel::FROM_ANDROID;
        }
        elseif($from == 'ios')
        {
            $order_from = Order_StateModel::FROM_IOS;
        }

        $uuid = request_string('uuid');

        //判断支付方式为在线支付还是货到付款,如果是货到付款则订单状态直接为待发货状态，如果是在线支付则订单状态为待付款
        if($pay_way_id == PaymentChannlModel::PAY_ONLINE)
        {
            $order_status = Order_StateModel::ORDER_WAIT_PAY;
        }

        if($pay_way_id == PaymentChannlModel::PAY_CONFIRM)
        {
            $order_status = Order_StateModel::ORDER_WAIT_PREPARE_GOODS;
        }

        $shop_remark = array_combine($shop_id, $remark);

        //开启事物
        $this->tradeOrderModel->sql->startTransactionDb();

        //获取店铺支持的消费者保障服务
        $Shop_ContractModel = new Shop_ContractModel();
        $cond_con['shop_id:IN']	 = $shop_id;
        $cond_con['contract_state']	 = Shop_ContractModel::CONTRACT_JOIN;
        $cond_con['contract_use_state'] = Shop_ContractModel::CONTRACT_INUSE;
        $contract = $Shop_ContractModel->getByWhere($cond_con);
        $shop_contract = array();
        if($contract)
        {
            foreach ($contract as $con_key=>$con_vlaue)
            {
                $shop_contract[$con_vlaue['shop_id']][] = $con_vlaue['contract_type_id'];
            }
        }

        /*获取用户的折扣信息 start*/
        $User_InfoModel = new User_InfoModel();
        $user_info      = $User_InfoModel->getOne($user_id);
        $User_GradeMode = new User_GradeModel();
        $user_grade     = $User_GradeMode->getOne($user_info['user_grade']);
        $user_rate      = $user_grade['user_grade_rate'];

        //分销商购买不计算会员折扣
        if(Perm::$shopId)
        {
            $user_rate = 100;
        }
        if ($user_rate <= 0)
        {
            $user_rate = 100;
        }
        /*获取用户的折扣信息 end*/

        //淘金员开启，查找用户的上级
        if(Web_ConfigModel::value('Plugin_Directseller'))
        {
            $user_parent_id = $user_info['user_parent_id'];  //用户上级ID
            $user_parent = $User_InfoModel->getOne($user_parent_id);
            @$directseller_p_id = $user_parent['user_parent_id'];  //二级

            $user_g_parent = $User_InfoModel->getOne($directseller_p_id);
            @$directseller_gp_id = $user_g_parent['user_parent_id']; //三级
        }

        //查找收货地址
        if($address_id)
        {
            $User_AddressModel = new User_AddressModel();
            $user_address = $User_AddressModel->getOne($address_id);
            $receiver_name     = $user_address['user_address_contact'];
            $receiver_address  = $user_address['user_address_area'] . ' ' . $user_address['user_address_address'];
            $receiver_phone    = $user_address['user_address_phone'];
            $city_id           = $user_address['user_address_city_id'];
        }
        else
        {
            $this->data->addBody(-140, array(), '请选择收货地址!', 250);
            return false;
        }

        $cond_row  = array('cart_id:IN' => $cart_id);
        //购物车中的商品信息
        //添加--根据收货人电话比对是否已经享受过新人 Zhenzh
        $CartModel = new CartModel();
        $data      = $CartModel->getCardList($cond_row, array(),$receiver_phone);

        if(!count($data))
        {
            $this->data->addBody(-140, array(), '订单提交失败!', 250);
            return false;
        }

        //重组加价购商品 Zhenzh 20171128 修改
        //活动下的所有规则下的换购商品信息
        if ($increase_goods_id)
        {
            $increase_goods_row = array();
            $Shop_ClassBindModel = new Shop_ClassBindModel();
            $Goods_CatModel = new Goods_CatModel();
            foreach($data as $ckey => $cval)
            {
                if(isset($cval['increase_info']))
                {
                    foreach ($cval['increase_info'] as $in_key=>$in_value)
                    {
                        if($in_value['rule_info'] && $in_value['rule_info']['rule_goods_limit'])
                        {
                            $increase_limit = $in_value['rule_info']['rule_goods_limit'];
                        }

                        $has_increase_goods_id = 0;
                        foreach ($in_value['exc_goods'] as $ex_k=>$ex_v)
                        {
                            if($increase_limit && in_array($ex_v['redemp_goods_id'],$increase_goods_id))
                            {
                                $has_increase_goods_id++;
                                if($has_increase_goods_id > $increase_limit)
                                {
                                    $this->data->addBody(-1,array(),'订单异常',250);return false;
                                }
                            }

                            $ex_v['now_price']   = $ex_v['redemp_price'];
                            $ex_v['goods_num']   = 1;
                            $ex_v['goods_sumprice'] = $ex_v['redemp_price'];

                            if($ex_v['directseller_flag'])
                            {
                                //判断店铺中是否存在自定义的经营类目
                                $cat_base = $Shop_ClassBindModel->getByWhere(array('shop_id'=>$ex_v['shop_id'],'product_class_id'=>$ex_v['cat_id']));
                                if($cat_base)
                                {
                                    $cat_base = current($cat_base);
                                    $cat_commission = $cat_base['commission_rate'];
                                }
                                else
                                {
                                    //获取分类佣金
                                    $cat_base = $Goods_CatModel->getOne($ex_v['cat_id']);
                                    if ($cat_base)
                                    {
                                        $cat_commission = $cat_base['cat_commission'];
                                    }
                                    else
                                    {
                                        $cat_commission = 0;
                                    }
                                }

                                $ex_v['cat_commission'] = $cat_commission;
                                $ex_v['commission'] = number_format(($ex_v['redemp_price'] * $cat_commission / 100), 2, '.', '');

                                if(Web_ConfigModel::value('Plugin_Directseller'))
                                {
                                    if($ex_v['directseller_flag'])
                                    {
                                        //产品佣金
                                        $ex_v['directseller_commission_0'] = $ex_v['redemp_price']*$ex_v['common_cps_rate']/100;
                                        $ex_v['directseller_commission_1'] = $ex_v['redemp_price']*$ex_v['common_second_cps_rate']/100;
                                        $ex_v['directseller_commission_2'] = $ex_v['redemp_price']*$ex_v['common_third_cps_rate']/100;
                                    }
                                }
                            }

                            $increase_goods_row[$ex_v['redemp_goods_id']] = $ex_v;
                        }
                    }
                }
            }

            if($increase_goods_row)
            {
                $increase_shop_row = array();
                foreach ($increase_goods_id as $iv)
                {
                    if(array_key_exists($iv,$increase_goods_row))
                    {
                        if (array_key_exists($increase_goods_row[$iv]['shop_id'], $increase_shop_row))
                        {
                            $increase_shop_row[$increase_goods_row[$iv]['shop_id']]['goods'][]  = $increase_goods_row[$iv];
                            $increase_shop_row[$increase_goods_row[$iv]['shop_id']]['price']   += $increase_goods_row[$iv]['redemp_price']*1;
                            $increase_shop_row[$increase_goods_row[$iv]['shop_id']]['commission'] += $increase_goods_row[$iv]['commission'];
                            if(Web_ConfigModel::value('Plugin_Directseller'))
                            {
                                $increase_shop_row[$increase_goods_row[$iv]['shop_id']]['directseller_commission'] += $increase_goods_row[$iv]['directseller_commission_0']+$increase_goods_row[$iv]['directseller_commission_1']+$increase_goods_row[$iv]['directseller_commission_2'];
                                $increase_shop_row[$increase_goods_row[$iv]['shop_id']]['directseller_flag'] = $increase_goods_row[$iv]['common_is_directseller'];
                            }
                        }
                        else
                        {
                            $increase_shop_row[$increase_goods_row[$iv]['shop_id']]['goods'][]    = $increase_goods_row[$iv];
                            $increase_shop_row[$increase_goods_row[$iv]['shop_id']]['price']      = $increase_goods_row[$iv]['redemp_price']*1;
                            $increase_shop_row[$increase_goods_row[$iv]['shop_id']]['commission'] = $increase_goods_row[$iv]['commission'];
                            if(Web_ConfigModel::value('Plugin_Directseller'))
                            {
                                $increase_shop_row[$increase_goods_row[$iv]['shop_id']]['directseller_commission'] = $increase_goods_row[$iv]['directseller_commission_0']+$increase_goods_row[$iv]['directseller_commission_1']+$increase_goods_row[$iv]['directseller_commission_2'];
                                $increase_shop_row[$increase_goods_row[$iv]['shop_id']]['directseller_flag'] = $increase_goods_row[$iv]['common_is_directseller'];
                            }
                        }
                    }
                }
            }
        }

        //定义一个新数组，存放店铺与订单商品详情订单商品
        $shop_order_goods_row = array();
        //计算购物车中每件商品的最后优惠的实际价格
        //店铺商品总价 = 加价购商品总价 + 购物车商品总价

        //定义一个新数组，存放新人商品 保证每个店铺只能有一件新人商品
        $newbuyer_shop_row = array();
        //循环购物车内的商品 根据店铺分组
        foreach($data as $ckey => $cval)
        {
            $shop_order_goods_row[$ckey]['shop_id']               = $cval['shop_id'];
            $shop_order_goods_row[$ckey]['shop_name']             = $cval['shop_name'];
            $shop_order_goods_row[$ckey]['shop_user_id']          = $cval['shop_user_id'];
            $shop_order_goods_row[$ckey]['shop_user_name']        = $cval['shop_user_name'];
            $shop_order_goods_row[$ckey]['shop_self_support']     = $cval['shop_self_support'];  //是否是自营店铺 false非自营  true自营
            $shop_order_goods_row[$ckey]['directseller_discount'] = $cval['distributor_rate']?$cval['distributor_rate']:0;//分销商折扣
            $shop_order_goods_row[$ckey]['shop_sumprice']         = 0;
            $shop_order_goods_row[$ckey]['district_id']           = $cval['district_id'];
            //套餐的运费
            if($cval['bundling_total_cost'])
            {
                $shop_order_goods_row[$ckey]['bundling_total_cost'] = $cval['bundling_total_cost'];
            }
            //店铺总价
            $shop_order_goods_row[$ckey]['shop_sumprice'] = $cval['sprice'];

            foreach($cval['goods'] as $cgkey => $cgval)
            {
                if ($cgval['bl_id'] && $cgval['bundling_info'])
                {
                    foreach ($cgval['bundling_info']['goods_list'] as $k => $v)
                    {
                        $tmp_goods = array();
                        $tmp_goods['bundling_name']  = '[优惠套装]'.$cgval['bundling_info']['bundling_name'];
                        $tmp_goods['bl_id']          = $v['bundling_id'];
                        $tmp_goods['cart_id']        = $cgval['cart_id'];
                        $tmp_goods['goods_id']       = $v['goods_id'];
                        $tmp_goods['common_id']      = $v['common_id'];
                        $tmp_goods['share_price_id'] = @$v['share_price_id'];
                        $tmp_goods['goods_name']     = $v['goods_name'];
                        $tmp_goods['goods_image']    = $v['goods_image'];
                        $tmp_goods['now_price']      = $v['bundling_goods_price'];
                        $tmp_goods['goods_num']      = $cgval['goods_num'];
                        $tmp_goods['goods_sumprice'] = $v['bundling_goods_price'] * $cgval['goods_num'] *1;  //单种商品总价

                        $shop_order_goods_row[$ckey]['goods'][] = $tmp_goods;
                    }
                }
                else
                {
                    $tmp_goods = array();
                    $tmp_goods['bl_id']             = 0;
                    $tmp_goods['cart_id']           = $cgval['cart_id'];
                    $tmp_goods['goods_id']          = $cgval['goods_id'];
                    $tmp_goods['common_id']         = $cgval['goods_base']['common_id'];
                    $tmp_goods['share_price_id']    = @$cgval['share_price_id'];
                    $tmp_goods['goods_name']        = $cgval['goods_base']['goods_name'];
                    $tmp_goods['cat_commission']    = $cgval['cat_commission'];
                    $tmp_goods['now_price']         = $cgval['now_price'];
                    $tmp_goods['goods_num']         = $cgval['goods_num'];
                    $tmp_goods['goods_sumprice']    = $cgval['now_price'] * $cgval['goods_num'] *1;  //单种商品总价
                    $tmp_goods['cubage']            = $cgval['cubage'];
                    $tmp_goods['transport_type_id'] = $cgval['transport_type_id'];
                    $tmp_goods['free_freight']      = @$cgval['free_freight'];
                    $tmp_goods['fu_done_flag']      = @$cgval['fu_done_flag'];
                    $tmp_goods['goods_base']        = $cgval['goods_base'];

                    $tmp_goods['directseller_goods_discount'] = $cgval['rate_price']?$cgval['rate_price']:0;//分销商折扣
                    $tmp_goods['product_is_behalf_delivery']  = $cgval['product_is_behalf_delivery'];
                    $tmp_goods['supply_shop_id']              = $cgval['supply_shop_id'];

                    if(Web_ConfigModel::value('Plugin_Directseller'))
                    {
                        $tmp_goods['directseller_commission_0'] = $cgval['directseller_commission_0'];
                        $tmp_goods['directseller_commission_1'] = $cgval['directseller_commission_1'];
                        $tmp_goods['directseller_commission_2'] = $cgval['directseller_commission_2'];
                        $tmp_goods['directseller_flag']         = $cgval['directseller_flag'];
                    }

                    $shop_order_goods_row[$ckey]['goods'][] = $tmp_goods;

                    if ($cgval['goods_base']['promotion'])
                    {
                        if($cgval['goods_base']['promotion']['promotion_type'] == Goods_CommonModel::XINREN)
                        {
                            $newbuyer_shop_row[$cval['shop_id']] = $cval['shop_id'];

                            if(isset($shop_order_goods_row[$ckey]['newbuyer_count']))
                            {
                                $this->data->addBody(-140, array(), '新人优惠每人限购一件', 250);
                                return false;
                                break;
                            }
                            else
                            {
                                $shop_order_goods_row[$ckey]['newbuyer_count'] = 1;
                            }
                        }
                        else if ($cgval['goods_base']['promotion']['promotion_type'] == Goods_CommonModel::FU)
                        {
                            $shop_order_goods_row[$ckey]['fu_flag'] = 1;
                        }
                    }
                }
            }

            //计算加价购商品的价格
            if (isset($increase_shop_row[$ckey]))
            {
                $increase_price      = $increase_shop_row[$ckey]['price'];
                foreach($increase_shop_row[$ckey]['goods'] as $insgkey => $insgval)
                {
                    array_push($shop_order_goods_row[$ckey]['goods'], $insgval);
                }

                if($increase_shop_row[$ckey]['directseller_flag'] && isset($increase_shop_row[$ckey]))
                {
                    $increase_directseller_commission = $increase_shop_row[$ckey]['directseller_commission'];
                }
                else
                {
                    $increase_directseller_commission = 0;
                }

                $order_directseller_commission = $cgval['directseller_commission'] + $increase_directseller_commission;
            }
            else
            {
                $increase_price      = 0;
                $order_directseller_commission = 0;
            }

            $shop_order_goods_row[$ckey]['shop_sumprice'] += $increase_price;

            //计算该店铺订单中一共有几种商品
            $shop_order_goods_row[$ckey]['goods_common_num'] = count($shop_order_goods_row[$ckey]['goods']);

            //计算店铺的满减送
            $shop_order_goods_row[$ckey]['mansong_info'] = $cval['mansong_info'];
            if ($cval['mansong_info'])
            {
                if ($cval['mansong_info']['rule_discount'] && $cval['mansong_info']['rule_discount'])
                {
                    $shop_order_goods_row[$ckey]['shop_mansong_discount'] = $cval['mansong_info']['rule_discount'];
                }
                else
                {
                    $shop_order_goods_row[$ckey]['shop_mansong_discount'] = 0;
                }
            }
            else
            {
                $shop_order_goods_row[$ckey]['shop_mansong_discount'] = 0;
            }

            //计算店铺代金券 Zhenzh 20171128修改
            $shop_order_goods_row[$ckey]['voucher_price'] = 0;
            $shop_order_goods_row[$ckey]['voucher_id']    = 0;
            $shop_order_goods_row[$ckey]['voucher_code']  = 0;
            if ($voucher_id && isset($cval['voucher_base']))
            {
                foreach ($voucher_id as $vv)
                {
                    if(array_key_exists($vv,$cval['voucher_base']))
                    {
                        $shop_order_goods_row[$ckey]['voucher_price'] = $cval['voucher_base'][$vv]['voucher_price'];
                        $shop_order_goods_row[$ckey]['voucher_id']    = $cval['voucher_base'][$vv]['voucher_id'];
                        $shop_order_goods_row[$ckey]['voucher_code']  = $cval['voucher_base'][$vv]['voucher_code'];
                        break;
                    }
                }
            }

            //计算店铺折扣（此店铺订单实际需要支付的价格）
            if($user_rate > 100 || $user_rate < 0)
            {
                //如果折扣配置有误，按没有折扣计算
                $user_rate = 100;
            }
            //判断平台是否开启会员折扣只限自营店铺使用
            //如果是平台自营店铺需要计算会员折扣，非平台自营不需要计算折扣
            if(Web_ConfigModel::value('rate_service_status') && $cval['shop_self_support'] == 'false')
            {
                $shop_order_goods_row[$ckey]['user_rate'] = 100;
            }
            else
            {
                $shop_order_goods_row[$ckey]['user_rate'] = $user_rate;
            }

            //每家店铺实际支付金额
            $shop_order_goods_row[$ckey]['shop_pay_amount'] = round(((($shop_order_goods_row[$ckey]['shop_sumprice'] - $shop_order_goods_row[$ckey]['shop_mansong_discount'] - $shop_order_goods_row[$ckey]['voucher_price']) * $shop_order_goods_row[$ckey]['user_rate']) / 100),2);
            //每家店铺最后优惠金额
            $shop_order_goods_row[$ckey]['shop_user_rate']  = round(((($shop_order_goods_row[$ckey]['shop_sumprice'] - $shop_order_goods_row[$ckey]['shop_mansong_discount'] - $shop_order_goods_row[$ckey]['voucher_price']) * (100 - $shop_order_goods_row[$ckey]['user_rate'])) / 100),2);
            $shop_order_goods_row[$ckey]['mian_sprice']     = $cval['mian_sprice'];
            $shop_order_goods_row[$ckey]['man_sprice']      = $cval['man_sprice'];
            $shop_order_goods_row[$ckey]['voucher_sprice']  = $cval['voucher_sprice'];
            $shop_order_goods_row[$ckey]['jia_sprice']      = $cval['jia_sprice'];
            $shop_order_goods_row[$ckey]['shop_free_shipping'] = $cval['shop_free_shipping'];
            $shop_order_goods_row[$ckey]['shop_class_id']      = $cval['shop_class_id'];
        }

        //检测订单金额 是否合法 <0 或者 ==0且不是送福免单 返回失败
        //计算每个商品订单实际支付的金额，以及每件商品的实际支付单价为多少
        foreach($shop_order_goods_row as $sogkey => $sogval)
        {
            //订单金额小于0 或者 ==0但是不是送福免单
            if($sogval['shop_pay_amount'] < 0 || ($sogval['shop_pay_amount'] == 0 && $sogval['fu_flag'] != 1))
            {
                $this->data->addBody(-140, [], '订单提交失败!!', 250);
                return false;
            }

            $add_pay_amount = 0;
            $add_commission_amount = 0;
            foreach($sogval['goods'] as $soggkey => $soggval)
            {
                //此种方式计算商品价格，只能保证每样商品实际支付金额相加等于最后支付的金额。但其中每件商品实际支付单价会有偏差。在计算退款金额的时候需要注意
                if($soggkey < ($sogval['goods_common_num'] - 1 ))
                {
                    //计算每样商品的单价
                    $goods_common_price = round(((($soggval['goods_sumprice'] / $sogval['shop_sumprice']) * $sogval['shop_pay_amount'])/$soggval['goods_num']),2);
                    $shop_order_goods_row[$sogkey]['goods'][$soggkey]['goods_pay_price'] = $goods_common_price;

                    //计算每样商品实际支付的金额
                    $goods_common_pay_amount = $goods_common_price * $soggval['goods_num'];
                    $shop_order_goods_row[$sogkey]['goods'][$soggkey]['goods_pay_amount'] = $goods_common_pay_amount;

                    //计算每样商品的佣金
                    $shop_order_goods_row[$sogkey]['goods'][$soggkey]['goods_commission_amount'] = round((($goods_common_pay_amount * $soggval['cat_commission'])/100 ),2);

                    //计算店铺订单的总佣金
                    $add_commission_amount  += round((($goods_common_pay_amount * $soggval['cat_commission'])/100 ),2);

                    //累计每样商品的实际支付金额
                    $add_pay_amount += $goods_common_pay_amount;
                }
                else
                {
                    //计算每样商品实际支付的金额
                    $goods_common_pay_amount = $sogval['shop_pay_amount'] - $add_pay_amount;
                    $shop_order_goods_row[$sogkey]['goods'][$soggkey]['goods_pay_amount'] = $goods_common_pay_amount;

                    //计算每样商品的单价
                    $goods_common_price = round(($goods_common_pay_amount/$soggval['goods_num']),2);
                    $shop_order_goods_row[$sogkey]['goods'][$soggkey]['goods_pay_price'] = $goods_common_price;

                    //计算每样商品的佣金
                    $shop_order_goods_row[$sogkey]['goods'][$soggkey]['goods_commission_amount'] = round((($goods_common_pay_amount * $soggval['cat_commission'])/100 ),2);

                    //计算店铺订单的总佣金
                    $add_commission_amount  += round((($goods_common_pay_amount * $soggval['cat_commission'])/100 ),2);
                }

                //将加价购商品从普通购物车商品数组中剔除，重新放入加价购商品数组中
                if(isset($soggval['redemp_goods_id']))
                {
                    $shop_order_goods_row[$sogkey]['increase_goods'][] = $shop_order_goods_row[$sogkey]['goods'][$soggkey];
                    unset($shop_order_goods_row[$sogkey]['goods'][$soggkey]);
                }
            }

            $shop_order_goods_row[$sogkey]['commission'] = $add_commission_amount;
        }

        //平台优惠券抵扣金额
        if($rpacket_id)
        {
            $total_order_amount	 = array_sum(array_column($shop_order_goods_row,'shop_pay_amount'));  //订单商品总金额
            $cond_row_rpt = array();
            $cond_row_rpt['redpacket_id']               = $rpacket_id;
            $cond_row_rpt['redpacket_owner_id']         = Perm::$userId;
            $cond_row_rpt['redpacket_state']            = RedPacket_BaseModel::UNUSED;
            $cond_row_rpt['redpacket_t_orderlimit:<=']  = $total_order_amount;
            $cond_row_rpt['redpacket_start_date:<=']    = get_date_time();
            $cond_row_rpt['redpacket_end_date:>=']      = get_date_time();
            $redPacket_BaseModel = new RedPacket_BaseModel();
            $redpacket_base = $redPacket_BaseModel->getOneByWhere($cond_row_rpt);

            if($redpacket_base)
            {
                $rpacket_price = $redpacket_base['redpacket_price'];	//红包面额
                $i = 1;
                $order_num 		= count($shop_order_goods_row);
                $order_rpt_acc 	= 0;

                //修正订单总价格，订单商品总价格
                foreach ($shop_order_goods_row as $rptkey => $val)
                {
                    //每笔订单的优惠券优惠额
                    if($i < $order_num)
                    {
                        $order_rpt_price 											= number_format(($rpacket_price*($val['shop_pay_amount']/$total_order_amount)), 2, '.', '');
                        $shop_order_goods_row[$rptkey]['shop_pay_amount'] 			= $val['shop_pay_amount'] - $order_rpt_price;			//修改订单商品总价
                        $shop_order_goods_row[$rptkey]['redpacket_code'] 			= $redpacket_base['redpacket_code']; //红包编码
                        $shop_order_goods_row[$rptkey]['redpacket_price'] 			= $redpacket_base['redpacket_price']; //红包面额
                        $shop_order_goods_row[$rptkey]['rpt_id']		  			= $rpacket_id;
                        $shop_order_goods_row[$rptkey]['order_rpt_price']			= $order_rpt_price;					//红包抵扣订单金额

                        $order_rpt_acc += $order_rpt_price;
                    }
                    elseif($i == $order_num)
                    {
                        $order_rpt_price 				= $rpacket_price - $order_rpt_acc;
                        $shop_order_goods_row[$rptkey]['shop_pay_amount'] 			= $val['shop_pay_amount'] - $order_rpt_price;			//修改订单商品总价
                        $shop_order_goods_row[$rptkey]['redpacket_code'] 			= $redpacket_base['redpacket_code']; 	//红包编码
                        $shop_order_goods_row[$rptkey]['redpacket_price'] 			= $redpacket_base['redpacket_price']; 	//红包面额
                        $shop_order_goods_row[$rptkey]['rpt_id']		  			= $rpacket_id;
                        $shop_order_goods_row[$rptkey]['order_rpt_price']			= $order_rpt_price;					 	//红包抵扣订单金额
                    }

                    //每件商品的优惠券优惠额
                    $j = 1;
                    $goods_num = count($val['goods']);
                    $goods_rpt_acc = 0 ;
                    foreach($val['goods'] as $gk=>$gv)
                    {
                        //每件商品的优惠券优惠额
                        if($j < $goods_num)
                        {
                            $goods_reduce_price 	=  number_format(($order_rpt_price*$gv['goods_pay_amount']/$val['shop_pay_amount']), 2, '.', '');
                            $goods_pay_price 		=  $gv['goods_pay_amount'] - $goods_reduce_price;
                            $shop_order_goods_row[$rptkey]['goods'][$gk]['goods_pay_amount'] = $goods_pay_price;  		 			//每件商品的实际支付金额
                            $shop_order_goods_row[$rptkey]['goods'][$gk]['goods_pay_price'] = round(($goods_pay_price/$gv['goods_num']),2);  	//每件商品的实际支付金额

                            $goods_rpt_acc += $goods_reduce_price;
                        }
                        elseif($j == $goods_num)
                        {
                            $goods_reduce_price 	=  	$order_rpt_price - $goods_rpt_acc;
                            $goods_pay_price 		= 	$gv['goods_pay_amount'] - $goods_reduce_price;
                            $shop_order_goods_row[$rptkey]['goods'][$gk]['goods_pay_amount'] = $goods_pay_price;  		 //每件商品的实际支付金额
                            $shop_order_goods_row[$rptkey]['goods'][$gk]['goods_pay_price'] = round(($goods_pay_price/$gv['goods_num']),2);;  		 //每件商品的实际支付金额
                        }
                        $j++;
                    }

                    $i++;
                }
            }
            else
            {
                $rpacket_id = 0;
            }
        }

        $Transport_TypeModel = new Transport_TypesModel();
        $data_list = $Transport_TypeModel->cost($city_id, $shop_order_goods_row,1);

        if($data_list['buy_able'])
        {
            $shop_order_goods_row = $data_list['glist'];
        }
        else
        {
            $this->data->addBody(-140, array(), '有部分商品配送范围无法覆盖您选择的地址，请更换其它商品!!', 250);
            return false;
        }

        $Number_SeqModel     = new Number_SeqModel();
        $Order_BaseModel     = new Order_BaseModel();
        $Order_GoodsModel    = new Order_GoodsModel();
        $Goods_BaseModel     = new Goods_BaseModel();
        $PaymentChannlModel  = new PaymentChannlModel();
        $Order_GoodsSnapshot = new Order_GoodsSnapshot();
        $ScareBuyModel       = new ScareBuy_BaseModel();
        $Goods_CommonModel   = new Goods_CommonModel();

        //合并支付订单的价格
        $uprice       = 0;
        $inorder      = '';
        $utrade_title = '';	//商品名称 - 标题
        $dist_flag[]  = true;
        $scarebuy_row = [];
        $share_price_row = [];
        $fu_base_row = [];
        $fu_record_row = [];

        $shop_api_key      = YLB_Registry::get('shop_api_key');
        $paycenter_api_url = YLB_Registry::get('paycenter_api_url');
        $shop_app_id       = YLB_Registry::get('shop_app_id');

        foreach ($shop_order_goods_row as $key => $val)
        {
            $trade_title = '';
            //生成店铺订单

            //总结店铺的优惠活动
            $order_shop_benefit = '';
            if ($val['mansong_info'] && $val['mansong_info']['rule_discount'])
            {
                $order_shop_benefit = ' 满减：' . format_money($val['mansong_info']['rule_discount']) . ' ';
            }
            if ($val['user_rate'] < 100)
            {
                $order_shop_benefit = $order_shop_benefit . ' 会员折扣：' . $user_rate . '% ';
            }

            $prefix       = sprintf('%s-%s-', $shop_app_id, date('Ymd'));
            $order_number = $Number_SeqModel->createSeq($prefix);
            $order_id     = sprintf('%s-%s-%s-%s', 'DD', $val['shop_user_id'], $key, $order_number);

            //计算店铺的代金券
            if($val['voucher_id'])
            {
                $order_shop_benefit = $order_shop_benefit . ' 代金券：' . format_money($val['voucher_price']) . ' ';
                $voucher_row[$val['voucher_id']] = $order_id;
            }

            $order_create_time = get_date_time();

            $order_row                           = array();
            $order_row['order_id']               = $order_id;
            $order_row['shop_id']                = $key;
            $order_row['shop_name']              = $val['shop_name'];
            $order_row['buyer_user_id']          = $user_id;
            $order_row['buyer_user_name']        = $user_account;
            $order_row['seller_user_id']         = $val['shop_user_id'];
            $order_row['seller_user_name']       = $val['shop_user_name'];
            $order_row['order_date']             = date('Y-m-d');
            $order_row['order_create_time']      = $order_create_time;
            $order_row['order_receiver_name']    = $receiver_name;
            $order_row['order_receiver_address'] = $receiver_address;
            $order_row['order_receiver_contact'] = $receiver_phone;
            $order_row['order_invoice']          = $invoice;
            $order_row['order_invoice_id']	   	 = $invoice_id;
            $order_row['order_goods_amount']     = $val['shop_sumprice']; //订单商品总价（不包含运费）
            $order_row['redpacket_code']         = isset($val['redpacket_code']) ? $val['redpacket_code'] : 0;    	//红包编码
            $order_row['redpacket_price']        = isset($val['redpacket_price']) ? $val['redpacket_price'] : 0;    //红包面额
            $order_row['order_rpt_price']        = isset($val['order_rpt_price']) ? $val['order_rpt_price'] : 0;    //平台红包抵扣订单金额
            if($order_row['order_rpt_price'])
            {
                $order_shop_benefit = $order_shop_benefit . '平台红包：' . format_money($order_row['order_rpt_price']);
            }
            $order_row['order_payment_amount']   = $val['shop_pay_amount'] + $val['cost'];// 订单实际支付金额 = 商品实际支付金额 + 运费
            $order_row['order_discount_fee']     = $val['shop_sumprice'] - $val['shop_pay_amount'];   //优惠价格 = 商品总价 - 商品实际支付金额
            $order_row['order_point_fee']        = 0;    //买家使用金蛋
            $order_row['order_shipping_fee']     = $val['cost'];
            $order_row['order_message']          = $shop_remark[$key];
            $order_row['order_status']           = $order_status;
            $order_row['order_points_add']       = 0;    //订单赠送的金蛋
            $order_row['voucher_id']             = $val['voucher_id'];    //代金券id
            $order_row['voucher_price']          = $val['voucher_price'];    //代金券面额
            $order_row['voucher_code']           = $val['voucher_code'];    //代金券编码
            $order_row['order_from']             = $order_from;    //订单来源
            $order_row['order_commission_fee']   = $val['commission'];
            $order_row['order_is_virtual']       = 0;    //1-虚拟订单 0-实物订单
            $order_row['order_shop_benefit']     = $order_shop_benefit;  //店铺优惠
            $order_row['payment_id']			 = $pay_way_id;
            $order_row['payment_name']			 = $PaymentChannlModel->payWay[$pay_way_id];
            $order_row['directseller_discount']  = $val['directseller_discount'];//分销商折扣
            if(Web_ConfigModel::value('Plugin_Directseller'))
            {
                //用户的上三级
                $order_row['directseller_id']    = $user_parent_id;
                $order_row['directseller_p_id']  = $directseller_p_id;
                $order_row['directseller_gp_id'] = $directseller_gp_id;
            }
            $order_row['district_id'] = $val['district_id'];
            if($shop_contract && $shop_contract[$key])
            {
                $order_row['shop_contract'] = $shop_contract[$key];
            }
            if($val['newbuyer_count'])
            {
                $order_row['is_newbuyer'] = 1;
            }

            //是否需要拆单标识
            $order_split_flag = false;
            if(count($val['split_order']) > 1)
            {
                $order_split_flag = true;
                $order_source_id  = $order_id;
                $order_row['order_type']   = $Order_BaseModel::ORDER_SPLIT;
                $order_row['order_status'] = Order_StateModel::ORDER_SPLIT;
            }
            else if(count($val['split_order']) == 1)
            {
                $split_key = current(array_keys($val['split_order']));
                if($split_key != $key)
                {
                    $order_row['order_type'] = $Order_BaseModel::ORDER_DIS;
                }
            }
            $order_row['shop_class_id'] = $val['shop_class_id'];

            $flag1 = $this -> tradeOrderModel -> addBase($order_row);
            $flag = $flag && $flag1;

            //-----开始拆单---Zhenzh20180523-----
            //循环订单中的商品 S
            foreach ($val['split_order'] as $kk => $vv)
            {
                if($order_split_flag)//生成新的订单
                {
                    $order_row                           = array();
                    $order_row['order_source_id']        = $order_source_id;

                    $prefix       = sprintf('%s-%s-', $shop_app_id, date('Ymd'));
                    $order_number = $Number_SeqModel->createSeq($prefix);
                    $order_id     = sprintf('%s-%s-%s-%s', 'DD', $val['shop_user_id'], $key, $order_number);

                    $order_row['order_id']               = $order_id;
                    $order_row['shop_id']                = $key;
                    $order_row['shop_name']              = $val['shop_name'];
                    $order_row['buyer_user_id']          = $user_id;
                    $order_row['buyer_user_name']        = $user_account;
                    $order_row['seller_user_id']         = $val['shop_user_id'];
                    $order_row['seller_user_name']       = $val['shop_user_name'];
                    $order_row['order_date']             = date('Y-m-d');
                    $order_row['order_create_time']      = $order_create_time;
                    $order_row['order_receiver_name']    = $receiver_name;
                    $order_row['order_receiver_address'] = $receiver_address;
                    $order_row['order_receiver_contact'] = $receiver_phone;
                    $order_row['order_invoice']          = $invoice;
                    $order_row['order_invoice_id']	   	 = $invoice_id;
                    $order_row['order_goods_amount']     = $vv['shop_sumprice']; //订单商品总价（不包含运费）
                    $order_row['redpacket_code']         = isset($val['redpacket_code'])?$val['redpacket_code']:0;    	//红包编码
                    $order_row['redpacket_price']        = isset($val['redpacket_price'])?$val['redpacket_price']:0;    //红包面额
                    $order_row['order_rpt_price']        = isset($val['order_rpt_price'])?$val['order_rpt_price']:0;    //平台红包抵扣订单金额
                    if($order_row['order_rpt_price'])
                    {
                        $order_shop_benefit = $order_shop_benefit . '平台红包：' . format_money($order_row['order_rpt_price']);
                    }
                    $order_row['order_payment_amount']   = $vv['shop_pay_amount'] + $vv['cost'];// 订单实际支付金额 = 商品实际支付金额 + 运费
                    $order_row['order_discount_fee']     = $vv['shop_sumprice'] - $vv['shop_pay_amount'];   //优惠价格 = 商品总价 - 商品实际支付金额
                    $order_row['order_point_fee']        = 0;    //买家使用金蛋
                    $order_row['order_shipping_fee']     = $vv['cost'];
                    $order_row['order_message']          = $shop_remark[$key];
                    $order_row['order_status']           = $order_status;
                    $order_row['order_points_add']       = 0;    //订单赠送的金蛋
                    $order_row['voucher_id']             = $val['voucher_id'];    //代金券id
                    $order_row['voucher_price']          = $val['voucher_price'];    //代金券面额
                    $order_row['voucher_code']           = $val['voucher_code'];    //代金券编码
                    $order_row['order_from']             = $order_from;    //订单来源
                    $order_row['order_commission_fee']   = $vv['commission'];
                    $order_row['order_is_virtual']       = 0;    //1-虚拟订单 0-实物订单
                    $order_row['order_shop_benefit']     = $order_shop_benefit;  //店铺优惠
                    $order_row['payment_id']			 = $pay_way_id;
                    $order_row['payment_name']			 = $PaymentChannlModel->payWay[$pay_way_id];
                    $order_row['directseller_discount']  = $val['directseller_discount'];//分销商折扣
                    if(Web_ConfigModel::value('Plugin_Directseller'))
                    {
                        //用户的上三级
                        $order_row['directseller_id'] = $user_parent_id;
                        $order_row['directseller_p_id'] = $directseller_p_id;
                        $order_row['directseller_gp_id'] = $directseller_gp_id;
                    }
                    $order_row['district_id'] = $val['district_id'];
                    if($shop_contract && $shop_contract[$key])
                    {
                        $order_row['shop_contract'] = $shop_contract[$key];
                    }

                    if($val['newbuyer_count'])
                    {
                        $order_row['is_newbuyer'] = 1;
                    }

                    //$key本店店铺id $kk分割订单号的店铺id
                    if($kk == $key)
                    {
                        $order_row['order_type'] = $Order_BaseModel::ORDER_CHILD;//子单
                    }
                    else
                    {
                        $order_row['order_type'] = $Order_BaseModel::ORDER_CHILD_DIS;//子单且分销
                    }

                    $order_row['shop_class_id'] = $val['shop_class_id'];
                    $flag1 = $this->tradeOrderModel->addBase($order_row);
                }

                foreach ($vv['goods'] as $k => $v)
                {
                    $cart_ids[$v['cart_id']] = $v['cart_id'];

                    $order_goods_row                                  = array();
                    $order_goods_row['order_id']                      = $order_id;
                    $order_goods_row['buyer_user_id']                 = $user_id;
                    $order_goods_row['order_goods_num']               = $v['goods_num'];
                    $order_goods_row['goods_price']                   = $v['now_price'];       //商品原来的单价
                    $order_goods_row['order_goods_payment_amount']    = $v['goods_pay_price']; //商品实际支付单价
                    $order_goods_row['order_goods_amount']            = $v['goods_pay_amount']; //商品实际支付金额
                    $order_goods_row['order_goods_discount_fee']      = $v['goods_sumprice'] - $v['goods_pay_amount'];//优惠价格
                    $order_goods_row['order_goods_adjust_fee']        = 0;    //手工调整金额
                    $order_goods_row['order_goods_point_fee']         = 0;    //金蛋费用
                    $order_goods_row['shop_id']                       = $key;
                    $order_goods_row['order_goods_status']            = Order_StateModel::ORDER_WAIT_PAY;
                    $order_goods_row['order_goods_evaluation_status'] = 0;  //0未评价 1已评价
                    $order_goods_row['order_goods_time']              = get_date_time();
                    if($v['bl_id'])
                    {
                        $order_goods_row['bundling_id']         = $v['bl_id'];
                        $order_goods_row['goods_id']            = $v['goods_id'];
                        $order_goods_row['common_id']           = $v['common_id'];
                        $order_goods_row['goods_name']          = $v['goods_name'];
                        $order_goods_row['goods_image']         = $v['goods_image'];
                        $order_goods_row['order_spec_info']     = $v['spec'];
                        $order_goods_row['order_goods_benefit'] = '优惠套装';

                        $trade_title = $v['bundling_name'];
                    }
                    else
                    {
                        //计算商品的优惠
                        if (isset($v['goods_base']['promotion']))
                        {
                            if($v['goods_base']['promotion']['promotion_price'] < $v['goods_base']['goods_price'] && $v['goods_base']['promotion']['down_price'])
                            {
                                $order_goods_row['promotion_type'] = $v['goods_base']['promotion']['promotion_type'];
                                $order_goods_row['order_goods_benefit'] = $v['goods_base']['promotion']['promotion_type_con'];
                                if($v['goods_base']['promotion']['promotion_type'] == $Goods_CommonModel::FU)
                                {
                                    $fu_base_row[$v['goods_base']['promotion']['promotion_id']]['goods_num'] = $v['goods_num'];
                                    if($v['goods_base']['promotion']['promotion_r_id'])
                                    {
                                        $fu_record_row[$v['goods_base']['promotion']['promotion_r_id']]['order_id'] = $order_id;
                                        $fu_record_row[$v['goods_base']['promotion']['promotion_r_id']]['success'] = 0;
                                        if($order_goods_row['order_goods_amount'] == 0)
                                        {
                                            $fu_record_row[$v['goods_base']['promotion']['promotion_r_id']]['success'] = 1;
                                        }
                                    }
                                }
                                else
                                {
                                    if ($v['goods_base']['promotion']['promotion_type'] == $Goods_CommonModel::HUIQIANGGOU)
                                    {
                                        $scarebuy_row[$v['goods_id']] = $v['goods_num'];
                                    }
                                    $order_goods_row['order_goods_benefit'] .= ':直降' .format_money($v['goods_base']['promotion']['down_price']) . ' ';
                                }
                            }
                        }

                        $order_goods_row['goods_id']                      = $v['goods_base']['goods_id'];
                        $order_goods_row['common_id']                     = $v['goods_base']['common_id'];
                        $order_goods_row['goods_name']                    = $v['goods_base']['goods_name'];
                        $order_goods_row['goods_image']                   = $v['goods_base']['goods_image'];
                        $order_goods_row['goods_class_id']                = $v['goods_base']['cat_id'];
                        $order_goods_row['order_spec_info']               = $v['goods_base']['spec'];
                        $order_goods_row['order_goods_commission']        = $v['goods_commission_amount'];    //商品佣金(总)
                        $order_goods_row['directseller_goods_discount']   = $v['directseller_goods_discount'];//分销商折扣

                        if(Web_ConfigModel::value('Plugin_Directseller'))
                        {
                            $order_goods_row['directseller_flag'] = $v['directseller_flag'];
                            if($order_goods_row['directseller_flag'])
                            {
                                //产品佣金
                                $order_goods_row['directseller_commission_0'] = $v['directseller_commission_0'];
                                $order_goods_row['directseller_commission_1'] = $v['directseller_commission_1'];
                                $order_goods_row['directseller_commission_2'] = $v['directseller_commission_2'];
                            }
                            $order_goods_row['directseller_id'] = $user_parent_id;
                        }

                        $trade_title = $v['goods_name'];
                    }

                    if($kk != $key && $v['goods_base']['goods_parent_id'])
                    {
                        $order_goods_row['goods_parent_id'] = $v['goods_base']['goods_parent_id'];
                    }
                    $flag2 = $Order_GoodsModel->addGoods($order_goods_row);

                    //加入交易快照表
                    $order_goods_snapshot_add_row = array();
                    $order_goods_snapshot_add_row['order_id'] 		 = $order_id;
                    $order_goods_snapshot_add_row['user_id'] 		 = $user_id;
                    $order_goods_snapshot_add_row['shop_id'] 		 = $key;
                    $order_goods_snapshot_add_row['common_id'] 	     = $order_goods_row['common_id'];
                    $order_goods_snapshot_add_row['goods_id'] 		 = $order_goods_row['goods_id'];
                    $order_goods_snapshot_add_row['goods_name'] 	 = $order_goods_row['goods_name'];
                    $order_goods_snapshot_add_row['goods_image'] 	 = $order_goods_row['goods_image'];
                    $order_goods_snapshot_add_row['goods_price'] 	 = $order_goods_row['order_goods_payment_amount'];
                    $order_goods_snapshot_add_row['goods_spec']      = $order_goods_row['order_spec_info'];
                    $order_goods_snapshot_add_row['freight'] 		 = $val['cost'];   //运费
                    $order_goods_snapshot_add_row['snapshot_detail'] = $order_goods_row['order_goods_benefit'];
                    $order_goods_snapshot_add_row['snapshot_uptime'] = get_date_time();
                    $order_goods_snapshot_add_row['snapshot_create_time'] =	get_date_time();
                    $Order_GoodsSnapshot->addSnapshot($order_goods_snapshot_add_row);

                    $flag = $flag && $flag2;

                    //删除商品库存
                    $flag3 = $Goods_BaseModel->delStock($v['goods_id'], $v['goods_num']);

                    $flag = $flag && $flag3;

                    //如果商品分享了 记录商品分享订单号 后面统一将订单号插入分享表里
                    if($v['share_price_id'] && !in_array($v['share_price_id'],$share_price_row[$order_id]))
                    {
                        $share_price_row[$order_id][] = $v['share_price_id'];
                    }
                }

                //支付中心生成订单
                $formvars                         = array();
                $formvars['app_id']				  = $shop_app_id;
                $formvars['from_app_id']          = $shop_app_id;
                $formvars['consume_trade_id']     = $order_id;
                $formvars['order_id']             = $order_id;
                $formvars['buy_id']               = Perm::$userId;
                $formvars['buyer_name'] 		  = Perm::$row['user_account'];
                $formvars['seller_id']            = $order_row['seller_user_id'];
                $formvars['seller_name']		  = $order_row['seller_user_name'];
                $formvars['order_state_id']       = $order_row['order_status'];
                $formvars['order_payment_amount'] = $order_row['order_payment_amount'];
                $formvars['order_commission_fee'] = $order_row['order_commission_fee'];
                $formvars['trade_remark']         = $order_row['order_message'];
                $formvars['trade_create_time']    = $order_row['order_create_time'];
                $formvars['trade_title']		  = $trade_title; //商品名称 - 标题

                $rs = get_url_with_encrypt($shop_api_key, sprintf('%s?ctl=Api_Pay_Pay&met=addConsumeTrade&typ=json',$paycenter_api_url), $formvars);

                //将合并支付单号插入数据库
                if($rs['status'] == 200)
                {
                    $Order_BaseModel->editBase($order_id,array('payment_number' => $rs['data']['union_order']));

                    $flag = $flag && true;
                }
                else
                {
                    $flag = $flag && false;
                }

                $uprice       += $order_row['order_payment_amount'];
                $inorder      .= $order_id . ',';
                $utrade_title .= $trade_title;


                //$key本店店铺id $kk分割订单号的店铺id
                if($kk == $key)
                {
                    //本店的订单

                    //加价购商品
                    if (isset($val['increase_goods']))
                    {
                        foreach ($val['increase_goods'] as $k => $v)
                        {
                            //判断加价购的商品库存
                            $order_goods_row                                  = array();
                            $order_goods_row['order_id']                      = $order_id;
                            $order_goods_row['goods_id']                      = $v['goods_id'];
                            $order_goods_row['common_id']                     = $v['common_id'];
                            $order_goods_row['buyer_user_id']                 = $user_id;
                            $order_goods_row['goods_name']                    = $v['goods_name'];
                            $order_goods_row['goods_class_id']                = $v['cat_id'];
                            $order_goods_row['order_spec_info']               = $v['spec'];
                            $order_goods_row['goods_price']                   = $v['redemp_price']; //商品原来的单价
                            $order_goods_row['order_goods_payment_amount']    = $v['goods_pay_price'];  //商品实际支付单价
                            $order_goods_row['order_goods_num']               = 1;
                            $order_goods_row['goods_image']                   = $v['goods_image'];
                            $order_goods_row['order_goods_amount']            = $v['goods_pay_amount'];  //商品实际支付金额
                            $order_goods_row['order_goods_discount_fee']      = $v['goods_sumprice'] - $v['goods_pay_amount'];        //优惠价格
                            $order_goods_row['order_goods_adjust_fee']        = 0;    //手工调整金额
                            $order_goods_row['order_goods_point_fee']         = 0;    //金蛋费用
                            $order_goods_row['order_goods_commission']        = $v['goods_commission_amount'];    //商品佣金(总)
                            $order_goods_row['shop_id']                       = $key;
                            $order_goods_row['order_goods_status']            = Order_StateModel::ORDER_WAIT_PAY;
                            $order_goods_row['order_goods_evaluation_status'] = 0;  //0未评价 1已评价
                            $order_goods_row['order_goods_benefit']           = '加价购商品';
                            $order_goods_row['order_goods_time']              = get_date_time();

                            if(Web_ConfigModel::value('Plugin_Directseller'))
                            {
                                $order_goods_row['directseller_commission_0'] = $v['directseller_commission_0'];
                                $order_goods_row['directseller_commission_1'] = $v['directseller_commission_1'];
                                $order_goods_row['directseller_commission_2'] = $v['directseller_commission_2'];
                                $order_goods_row['directseller_flag'] = $v['directseller_flag'];
                                $order_goods_row['directseller_id'] = $user_parent_id;
                            }

                            $flag2 = $Order_GoodsModel->addGoods($order_goods_row);

                            //加入交易快照表(加价购商品)
                            $order_goods_snapshot_add_row = array();
                            $order_goods_snapshot_add_row['order_id'] 		= $order_id;
                            $order_goods_snapshot_add_row['user_id'] 		= $user_id;
                            $order_goods_snapshot_add_row['shop_id'] 		= $v['shop_id'];
                            $order_goods_snapshot_add_row['common_id'] 	    = $v['common_id'];
                            $order_goods_snapshot_add_row['goods_id'] 		= $v['goods_id'];
                            $order_goods_snapshot_add_row['goods_name'] 	= $v['goods_name'];
                            $order_goods_snapshot_add_row['goods_image'] 	= $v['goods_image'];
                            $order_goods_snapshot_add_row['goods_price'] 	= $v['redemp_price'];
                            $order_goods_snapshot_add_row['goods_spec']     = $v['spec'];
                            $order_goods_snapshot_add_row['freight'] 		= $val['cost'];   //运费
                            $order_goods_snapshot_add_row['snapshot_create_time'] =	get_date_time();
                            $order_goods_snapshot_add_row['snapshot_uptime'] =		get_date_time();
                            $order_goods_snapshot_add_row['snapshot_detail'] = '加价购商品';

                            $Order_GoodsSnapshot->addSnapshot($order_goods_snapshot_add_row);

                            $flag = $flag && $flag2;

                            //删除商品库存
                            $flag3 = $Goods_BaseModel->delStock($v['goods_id'], 1);
                            $flag = $flag && $flag3;

                        }
                    }

                    //店铺满赠商品
                    if ($val['mansong_info'] && $val['mansong_info']['goods_id'])
                    {
                        $order_goods_row                                  = array();
                        $order_goods_row['order_id']                      = $order_id;
                        $order_goods_row['goods_id']                      = $val['mansong_info']['goods_id'];
                        $order_goods_row['common_id']                     = $val['mansong_info']['common_id'];
                        $order_goods_row['buyer_user_id']                 = $user_id;
                        $order_goods_row['goods_name']                    = $val['mansong_info']['goods_name'];
                        $order_goods_row['goods_class_id']                = 0;
                        $order_goods_row['goods_price']                   = 0;
                        $order_goods_row['order_goods_num']               = 1;
                        $order_goods_row['goods_image']                   = $val['mansong_info']['goods_image'];
                        $order_goods_row['order_spec_info']               = $val['mansong_info']['spec'];
                        $order_goods_row['order_goods_amount']            = 0;
                        $order_goods_row['order_goods_discount_fee']      = 0;        //优惠价格
                        $order_goods_row['order_goods_adjust_fee']        = 0;    //手工调整金额
                        $order_goods_row['order_goods_point_fee']         = 0;    //金蛋费用
                        $order_goods_row['order_goods_commission']        = 0;    //商品佣金
                        $order_goods_row['shop_id']                       = $key;
                        $order_goods_row['order_goods_status']            = Order_StateModel::ORDER_WAIT_PAY;
                        $order_goods_row['order_goods_evaluation_status'] = 0;  //0未评价 1已评价
                        $order_goods_row['order_goods_benefit']           = '店铺满赠商品';
                        $order_goods_row['order_goods_time']              = get_date_time();

                        $flag2 = $Order_GoodsModel->addGoods($order_goods_row);

                        //加入交易快照表(满赠商品)
                        $order_goods_snapshot_add_row = array();
                        $order_goods_snapshot_add_row['order_id'] 		= $order_id;
                        $order_goods_snapshot_add_row['user_id'] 		= $user_id;
                        $order_goods_snapshot_add_row['shop_id'] 		= $key;
                        $order_goods_snapshot_add_row['common_id']    	= $val['mansong_info']['common_id'];
                        $order_goods_snapshot_add_row['goods_id'] 		= $val['mansong_info']['goods_id'];
                        $order_goods_snapshot_add_row['goods_name'] 	= $val['mansong_info']['goods_name'];
                        $order_goods_snapshot_add_row['goods_image'] 	= $val['mansong_info']['goods_image'];
                        $order_goods_snapshot_add_row['goods_price'] 	= 0;
                        $order_goods_snapshot_add_row['goods_spec']     = $val['mansong_info']['spec'];
                        $order_goods_snapshot_add_row['freight'] 		= $val['cost'];   //运费
                        $order_goods_snapshot_add_row['snapshot_create_time'] =	get_date_time();
                        $order_goods_snapshot_add_row['snapshot_uptime'] =		get_date_time();
                        $order_goods_snapshot_add_row['snapshot_detail'] = '满赠商品';

                        $Order_GoodsSnapshot->addSnapshot($order_goods_snapshot_add_row);

                        $flag = $flag && $flag2;

                        //删除商品库存
                        $flag3 = $Goods_BaseModel->delStock($val['mansong_info']['goods_id'], 1);
                        $flag = $flag && $flag3;

                    }
                }
                else
                {
                    //供应商的订单

                    // 生成SP订单 成功返回订单号 否则返回false
                    $dist_flag[] = $this->distributor_add_order($order_id,$kk,$vv,$receiver_name,$receiver_address,$receiver_phone,$val['shop_id'],$val['shop_user_id'],$val['shop_user_name'],$pay_way_id);
                }
            }
            //循环订单中的商品 E
        }

        //修改平台红包状态为已使用
        if($rpacket_id > 0)
        {
            $redPacket_BaseModel = new RedPacket_BaseModel();
            $field_row = array();
            $field_row['redpacket_state'] 		= RedPacket_BaseModel::USED;
            $field_row['redpacket_order_id'] 	= $inorder;
            $flag5 = $redPacket_BaseModel->editRedPacket($rpacket_id, $field_row);

            $flag = $flag && $flag5;
        }

        //生成合并支付订单
        $formvars 		         = array();
        $formvars['inorder']     = $inorder;
        $formvars['uprice']      = $uprice;
        $formvars['buyer']       = Perm::$userId;
        $formvars['trade_title'] = $utrade_title;
        $formvars['buyer_name']  = Perm::$row['user_account'];
        $formvars['app_id']      = $shop_app_id;
        $formvars['from_app_id'] = YLB_Registry::get('shop_app_id');

        $rs = get_url_with_encrypt($shop_api_key, sprintf('%s?ctl=Api_Pay_Pay&met=addUnionOrder&typ=json', $paycenter_api_url), $formvars);

        if ($rs['status'] == 200)
        {
            $uorder = $rs['data']['uorder'];

            $flag = $flag && true;
        }
        else
        {
            $uorder = '';

            $flag = $flag && false;
        }

        if (is_ok($dist_flag) && $flag && $this->tradeOrderModel->sql->commitDb())
        {
            $status = 200;
            $msg    = _('success');

            $data = array('uorder' => $uorder);


            //从购物车中删除商品
            if($cart_ids)
            {
                $CartModel->removeCart($cart_ids);
            }

            //修改代金券状态
            if($voucher_row)
            {
                $Voucher_BaseModel = new Voucher_BaseModel();
                foreach ($voucher_row as $voucher_key=>$voucher_value)
                {
                    $Voucher_BaseModel->changeVoucherState($voucher_key, $voucher_value);

                    //代金券使用提醒
                    $message = new MessageModel();
                    $message->sendMessage('The use of vouchers to remind', Perm::$userId, Perm::$row['user_account'], $order_id = NULL, $shop_name = NULL, 0, 4);
                }
            }

            //如果是新人 记录设备号
            if($newbuyer_shop_row && $uuid)
            {
                $Equipment = new Equipment();
                $Equipment->addBase(array('id'=>$uuid));
            }

            //如果商品是惠抢购 修改惠抢购数量
            if ($scarebuy_row)
            {
                foreach ($scarebuy_row as $key => $value)
                {
                    $ScareBuyModel->editScareBuyCount($key, $value);
                }
            }

            //如果有分享 修改分享里的订单号
            if($share_price_row)
            {
                $sharePriceModel = new Share_PriceModel();
                foreach ($share_price_row as $key => $value)
                {
                    $sharePriceModel ->editSharePrice($value,array('share_order_id'=>$key));
                }
            }

            //如果有送福免单商品 修改记录状态
            if($fu_base_row)
            {
                $FuBaseModel = new Fu_BaseModel();

                $fu_base_list = $FuBaseModel->getByWhere([
                    'fu_id:IN'   => array_keys($fu_base_row),
                    'fu_state'   => Fu_BaseModel::NORMAL,
                    'fu_stock:>' => 0
                ]);

                foreach ($fu_base_row as $key => $value)
                {
                    if (isset($fu_base_list[$key]))
                    {
                        $fu_base = $fu_base_list[$key];

                        $edit_fu['fu_stock'] = $fu_base['fu_stock'] * 1 - 1;
                        if($edit_fu['fu_stock'] == 0)
                        {
                            $edit_fu['fu_state'] = Fu_BaseModel::END;
                        }

                        $FuBaseModel->editFu($key,$edit_fu);
                    }
                }
            }

            if($fu_record_row)
            {
                $FuRecordModel = new Fu_RecordModel();
                foreach ($fu_record_row as $key => $value)
                {
                    $edit_fu_row['order_id'] = $value['order_id'];
                    $edit_fu_row['status'] = Fu_RecordModel::USED;
                    if($value['success'])
                    {
                        $edit_fu_row['status'] = Fu_RecordModel::SUCCESS;
                    }
                    $FuRecordModel->editFuRecord($key,$edit_fu_row);
                }

                if($uorder && $uprice == 0)
                {
                    $formvars                   = array();
                    $formvars['app_id']		    = $shop_app_id;
                    $formvars['from_app_id']    = $shop_app_id;
                    $formvars['uorder']         = $uorder;
                    $formvars['user_id']        = $user_id;
                    $formvars['auto_add_order'] = 1;
                    $rs = get_url_with_encrypt($shop_api_key, sprintf('%s?ctl=Api_Pay_Pay&met=autoPay&typ=json',$paycenter_api_url), $formvars);

                    if($rs['status'] == 200)
                    {
                        $status = 210;
                    }
                }
            }
        }
        else
        {
            $this->tradeOrderModel->sql->rollBackDb();
            $m      = $this->tradeOrderModel->msg->getMessages();
            $msg    = $m ? $m[0] : _('failure');
            $status = 250;

            //订单提交失败，将paycenter中生成的订单删除
            if($uorder)
            {
                $formvars           = array();
                $formvars['uorder'] = $uorder;
                $formvars['app_id'] = $shop_app_id;

                $rs = get_url_with_encrypt($shop_api_key, sprintf('%s?ctl=Api_Pay_Pay&met=delUnionOrder&typ=json', $paycenter_api_url), $formvars);
            }

            $data = array();
        }

        $this->data->addBody(-140, $data, $msg, $status);
    }

    public function addUorder()
    {
        $order_id = request_string('order_id');

        $key      = YLB_Registry::get('shop_api_key');
        $url         = YLB_Registry::get('paycenter_api_url');
        $shop_app_id = YLB_Registry::get('shop_app_id');

        //查找paycenter中是否已经生成改订单
        $formvars = array();
        $formvars['app_id'] = $shop_app_id;
        $formvars['order_id'] = $order_id;
        $rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_Pay_Pay&met=getOrderInfo&typ=json', $url), $formvars);
        fb($rs);

        $Order_BaseModel = new Order_BaseModel();
        //开启事物
        $Order_BaseModel->sql->startTransactionDb();

        if($rs['status'] == 200 )
        {
            //此订单在paycenter中存在支付单号
            if($rs['data'])
            {
                $uorder = current($rs['data']);

                //将支付单号写入订单信息
                $edit_row['payment_number'] = $uorder['union_order_id'];
                $flag = $Order_BaseModel->editBase($order_id,$edit_row);

                $uorder_id = $uorder['union_order_id'];
            }
            else
            {
                $order_row = $Order_BaseModel->getOne($order_id);
                $Order_GoodsModel = new Order_GoodsModel();
                $goods_row = $Order_GoodsModel->getByWhere(array('order_id' => $order_id));
                $goods = current($goods_row);
                fb($goods);
                //此订单在paycenter中不存在支付单号，现在生成支付单号
                $key      = YLB_Registry::get('shop_api_key');
                $url         = YLB_Registry::get('paycenter_api_url');
                $shop_app_id = YLB_Registry::get('shop_app_id');
                $formvars = array();

                $formvars['app_id']					= $shop_app_id;
                $formvars['from_app_id'] = YLB_Registry::get('shop_app_id');
                $formvars['consume_trade_id']     = $order_row['order_id'];
                $formvars['order_id']             = $order_row['order_id'];
                $formvars['buy_id']               = Perm::$userId;
                $formvars['buyer_name'] 		   = Perm::$row['user_account'];
                $formvars['seller_id']            = $order_row['seller_user_id'];
                $formvars['seller_name']		   = $order_row['seller_user_name'];
                $formvars['order_state_id']       = $order_row['order_status'];
                $formvars['order_payment_amount'] = $order_row['order_payment_amount'];
                $formvars['trade_remark']         = $order_row['order_message'];
                $formvars['trade_create_time']    = $order_row['order_create_time'];
                $formvars['trade_title']			= $goods['goods_name'];		//商品名称 - 标题

                $rss = get_url_with_encrypt($key, sprintf('%s?ctl=Api_Pay_Pay&met=addConsumeTrade&typ=json',$url), $formvars);

                if($rss['status'] == 200)
                {
                    $edit_order_row['payment_number'] = $rss['data']['union_order'];
                    $flag = $Order_BaseModel->editBase($order_id,$edit_order_row);

                    $uorder_id = $rss['data']['union_order'];
                }
                else
                {
                    $flag = false;
                }
            }

        }
        else
        {
            $flag = false;
        }

        if ($flag && $Order_BaseModel->sql->commitDb())
        {
            $status = 200;
            $msg    = _('success');
        }
        else
        {
            $Order_BaseModel->sql->rollBackDb();
            $m      = $Order_BaseModel->msg->getMessages();
            $msg    = $m ? $m[0] : _('failure');
            $status = 250;
        }
        $data = array('uorder' => $uorder_id);
        $this->data->addBody(-140, $data, $msg, $status);

    }

    //测试接口
    public function addtest()
    {
        $test = request_string('test');
        //生成合并支付订单
        $key      = YLB_Registry::get('shop_api_key');
        $url         = YLB_Registry::get('paycenter_api_url');
        $shop_app_id = YLB_Registry::get('shop_app_id');
        $formvars = array();

        $formvars['test'] = $test;
        $formvars['app_id']        = $shop_app_id;

        fb($formvars);

        $rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_Pay_Pay&met=addTest&typ=json', $url), $formvars);
        fb($rs);

        if($rs['status'] == 200)
        {
            $status = 200;
            $msg    = _('success');
        }
        else
        {
            $msg    = _('failure');
            $status = 250;
        }
        $this->data->addBody(-140, $rs, $msg, $status);
    }


    //自动收货 - 定时计划任务
    public function confirmOrderAuto()
    {
        $Order_BaseModel  = new Order_BaseModel();
        $Order_GoodsModel = new Order_GoodsModel();

        //开启事物
        $Order_BaseModel->sql->startTransactionDb();

        //查找出所有待收货状态的商品
        $cond_row                           = array();
        $cond_row['order_status']           = Order_StateModel::ORDER_WAIT_CONFIRM_GOODS;
        $cond_row['order_receiver_date:<='] = get_date_time();
        $order_list                         = $Order_BaseModel->getKeyByWhere($cond_row);
        fb($order_list);

        if($order_list)
        {
            foreach ($order_list as $key => $val)
            {

                $order_id = $val;

                $order_base           = $Order_BaseModel->getOne($order_id);
                $order_payment_amount = $order_base['order_payment_amount'];

                $condition['order_status'] = Order_StateModel::ORDER_FINISH;

                $condition['order_finished_time'] = get_date_time();

                $flag = $Order_BaseModel->editBase($order_id, $condition);

                //修改订单商品表中的订单状态
                $edit_row['order_goods_status'] = Order_StateModel::ORDER_FINISH;

                $order_goods_id = $Order_GoodsModel->getKeyByWhere(array('order_id' => $order_id));

                $Order_GoodsModel->editGoods($order_goods_id, $edit_row);


                /*
				*  经验与成长值
				*/
                $user_points        = Web_ConfigModel::value("points_recharge");//订单每多少获取多少金蛋
                $user_points_amount = Web_ConfigModel::value("points_order");//订单每多少获取多少金蛋

                if ($order_payment_amount / $user_points < $user_points_amount)
                {
                    $user_points = floor($order_payment_amount / $user_points);
                }
                else
                {
                    $user_points = $user_points_amount;
                }

                $user_grade        = Web_ConfigModel::value("grade_recharge");//订单每多少获取多少金蛋
                $user_grade_amount = Web_ConfigModel::value("grade_order");//订单每多少获取多少成长值

                if ($order_payment_amount / $user_grade > $user_grade_amount)
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
                $points_row['user_id']           = $order_base['buyer_user_id'];
                $points_row['user_name']         = $order_base['buyer_user_name'];
                $points_row['class_id']          = Points_LogModel::ONBUY;
                $points_row['points_log_points'] = $user_points;
                $points_row['points_log_time']   = get_date_time();
                $points_row['points_log_desc']   = '确认收货';
                $points_row['points_log_flag']   = 'confirmorder';

                $Points_LogModel = new Points_LogModel();

                $Points_LogModel->addLog($points_row);

                //成长值
                $grade_row['user_id']         = $order_base['buyer_user_id'];
                $grade_row['user_name']       = $order_base['buyer_user_name'];
                $grade_row['class_id']        = Grade_LogModel::ONBUY;
                $grade_row['grade_log_grade'] = $user_grade;
                $grade_row['grade_log_time']  = get_date_time();
                $grade_row['grade_log_desc']  = '确认收货';
                $grade_row['grade_log_flag']  = 'confirmorder';

                $Grade_LogModel = new Grade_LogModel;
                $Grade_LogModel->addLog($grade_row);
            }
        }
        else
        {
            $flag = true;
        }


        if ($flag && $Order_BaseModel->sql->commitDb())
        {
            /**
             *  加入统计中心
             */
            $analytics_data = array();
            if(is_array($order_id)){
                $analytics_data['order_id'] = $order_id;
                $analytics_data['status'] =  Order_StateModel::ORDER_FINISH;
                YLB_Plugin_Manager::getInstance()->trigger('analyticsUpdateOrderStatus',$analytics_data);
            }
            /******************************************************************/
            $status = 200;
            $msg    = _('success');
        }
        else
        {
            $Order_BaseModel->sql->rollBackDb();
            $m      = $Order_BaseModel->msg->getMessages();
            $msg    = $m ? $m[0] : _('failure');
            $status = 250;
        }
        $data = array();
        $this->data->addBody(-140, $data, $msg, $status);
    }

    //如果为虚拟订单读取实体店铺的地址
    public function getEntityList()
    {
        $shop_id 			   = request_int('shop_id');

        $data 				   = array();
        $addr_list 			   = array();
        $Shop_EntityModel      = new Shop_EntityModel();

        $shop_entity_list = $Shop_EntityModel->getByWhere( array('shop_id' => $shop_id) );

        if ( !empty($shop_entity_list) )
        {

            foreach ( $shop_entity_list as $entity_id => $entity_val )
            {
                $addr_list[$entity_id]['name_info'] 	= $entity_val['entity_name'];
                $addr_list[$entity_id]['address_info'] 	= $entity_val['entity_xxaddr'];
                $addr_list[$entity_id]['phone_info'] 	= $entity_val['entity_tel'];
            }

            $data['addr_list'] = $addr_list;
        }
        else
        {
            $data['addr_list'] = $addr_list;
        }

        $this->data->addBody(-140, $data);
    }

    /**
     * 取消订单
     *
     * @access public
     */
    public function orderCancel()
    {
        $typ  = request_string('typ');
        $user = request_string('user');

        if ($typ == 'e')
        {
            if ($user == 'buyer')
            {
                $cancel_row['cancel_identity'] = Order_CancelReasonModel::CANCEL_BUYER;
            }
            else
            {
                $cancel_row['cancel_identity'] = Order_CancelReasonModel::CANCEL_SELLER;
            }

            //获取取消原因
            $Order_CancelReasonModel = new Order_CancelReasonModel;
            $reason                  = array_values($Order_CancelReasonModel->getByWhere($cancel_row));

            include $this->view->getView();
        }
        else
        {
            $Order_BaseModel = new Order_BaseModel();

            //开启事物
            $Order_BaseModel->sql->startTransactionDb();

            $order_id   = request_string('order_id');
            $state_info = request_string('state_info');

            if (empty($state_info))
            {
                $state_info = request_string('state_info1');
            }
            //加入取消时间
            $condition['order_status']        = Order_StateModel::ORDER_CANCEL;
            $condition['order_cancel_reason'] = addslashes($state_info);

            if ($user == 'buyer')
            {
                $condition['order_cancel_identity'] = Order_BaseModel::IS_BUYER_CANCEL;
            }
            else
            {
                $condition['order_cancel_identity'] = Order_BaseModel::IS_SELLER_CANCEL;
            }
            $condition['order_cancel_date'] = get_date_time();

            $flag = $Order_BaseModel->editBase($order_id, $condition);
            $order_base=current($Order_BaseModel->getByWhere(array('order_id'=>$order_id)));

            //修改订单商品表中的订单状态
            $edit_row['order_goods_status'] = Order_StateModel::ORDER_CANCEL;
            $Order_GoodsModel               = new Order_GoodsModel();
            $order_goods_id                 = $Order_GoodsModel->getKeyByWhere(array('order_id' => $order_id));

            $Order_GoodsModel->editGoods($order_goods_id, $edit_row);

            //退还订单商品的库存
            $Goods_BaseModel = new Goods_BaseModel();
            $Chain_GoodsModel = new Chain_GoodsModel();
            if($order_base['chain_id']!=0){
                $chain_row['chain_id:='] = $order_base['chain_id'];
                $chain_row['goods_id:='] = is_array($order_goods_id)?$order_goods_id[0]:$order_goods_id;
                $chain_row['shop_id:='] = $order_base['shop_id'];
                $chain_goods = current($Chain_GoodsModel->getByWhere($chain_row));
                $chain_goods_id = $chain_goods['chain_goods_id'];
                $goods_stock['goods_stock'] = $chain_goods['goods_stock'] + 1;
                $Chain_GoodsModel->editGoods($chain_goods_id, $goods_stock);
            }else{
                $Goods_BaseModel->returnGoodsStock($order_goods_id);
            }

            //将需要取消的订单号远程发送给Paycenter修改订单状态
            //远程修改paycenter中的订单状态
            $key      = YLB_Registry::get('shop_api_key');
            $url         = YLB_Registry::get('paycenter_api_url');
            $shop_app_id = YLB_Registry::get('shop_app_id');
            $formvars = array();

            $formvars['order_id']    = $order_id;
            $formvars['app_id']        = $shop_app_id;

            fb($formvars);

            $rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_Pay_Pay&met=cancelOrder&typ=json', $url), $formvars);

            //如果有分销商进货单，同时取消进货单
            $dist_orders = $Order_BaseModel ->getByWhere(array('order_source_id' => $order_id));
            if(!empty($dist_orders)){
                foreach ($dist_orders as $key => $value) {
                    //改变订单状态
                    $Order_BaseModel->editBase($value['order_id'], $condition);
                    $dist_order_base=current($Order_BaseModel->getByWhere(array('order_id'=>$value['order_id'])));

                    //修改订单商品表中的订单状态
                    $order_goods_id                 = $Order_GoodsModel->getKeyByWhere(array('order_id' => $value['order_id']));
                    $Order_GoodsModel->editGoods($order_goods_id, $edit_row);

                    if($dist_order_base['chain_id']!=0){
                        $chain_row['chain_id:='] = $dist_order_base['chain_id'];
                        $chain_row['goods_id:='] = is_array($order_goods_id)?$order_goods_id[0]:$order_goods_id;
                        $chain_row['shop_id:='] = $dist_order_base['shop_id'];
                        $chain_goods = current($Chain_GoodsModel->getByWhere($chain_row));
                        $chain_goods_id = $chain_goods['chain_goods_id'];
                        $goods_stock['goods_stock'] = $chain_goods['goods_stock'] + 1;
                        $Chain_GoodsModel->editGoods($chain_goods_id, $goods_stock);
                    }else{
                        $Goods_BaseModel->returnGoodsStock($order_goods_id);
                    }

                    $formvars['order_id']    = $value['order_id'];
                    $rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_Pay_Pay&met=cancelOrder&typ=json', $url), $formvars);
                }
            }


            if ($flag && $Order_BaseModel->sql->commitDb())
            {

                /**
                 *  加入统计中心
                 */
                $analytics_data = array();
                if($order_id){
                    $analytics_data['order_id'] = array(order_id);
                    $analytics_data['status'] =  Order_StateModel::ORDER_CANCEL;
                    YLB_Plugin_Manager::getInstance()->trigger('analyticsUpdateOrderStatus',$analytics_data);
                }
                /******************************************************************/

                $status = 200;
                $msg    = _('success');
            }
            else
            {
                $Order_BaseModel->sql->rollBackDb();
                $m      = $Order_BaseModel->msg->getMessages();
                $msg    = $m ? $m[0] : _('failure');
                $status = 250;
            }

            $this->data->addBody(-140, array(), $msg, $status);
        }

    }

    /**
     * 门店自提订单--页面
     *
     * @access public
     */
    public function chain()
    {
        $act      = request_string('act');
        $order_id = request_string('order_id');

        //订单详情页
        if ($act == 'details')
        {
            $data = $this->tradeOrderModel->getOrderDetail($order_id);
            $Order_GoodsChainCodeModel = new Order_GoodsChainCodeModel();
            $Order_GoodsChainCode      = $Order_GoodsChainCodeModel->getOne($order_id);

            //获取门店信息
            $Chain_BaseModel = new Chain_BaseModel();
            $chain_base      = current($Chain_BaseModel->getByWhere(array('chain_id'=>$Order_GoodsChainCode['chain_id'])));

            $this->view->setMet('chainDetail');
        }
        else
        {
            $YLB_Page           = new YLB_Page();
            $YLB_Page->listRows = 10;
            $rows              = $YLB_Page->listRows;
            $offset            = request_int('firstRow', 0);
            $page              = ceil_r($offset / $rows);

            $status  = request_string('status');
            $recycle = request_int('recycle');
            //待付款
            if ($status == 'wait_pay')
            {
                $order_row['order_status'] = Order_StateModel::ORDER_WAIT_PAY;
            }

            //待自提
            if ($status == 'order_chain')
            {
                $order_row['order_status'] = Order_StateModel::ORDER_SELF_PICKUP;
            }

            //已完成 -> 订单评价
            if ($status == 'finish')
            {
                $order_row['order_status'] = Order_StateModel::ORDER_FINISH;
            }
            //已取消
            if ($status == 'cancel')
            {
                $order_row['order_status'] = Order_StateModel::ORDER_CANCEL;
            }
            //订单回收站
            if ($recycle)
            {
                $order_row['order_buyer_hidden'] = Order_BaseModel::IS_BUYER_HIDDEN;
            }
            else
            {
                $order_row['order_buyer_hidden:!='] = Order_BaseModel::IS_BUYER_HIDDEN;
            }

            if (request_string('start_date'))
            {
                $order_row['order_create_time:>'] = request_string('start_date');
            }
            if (request_string('end_date'))
            {
                $order_row['order_create_time:<'] = request_string('end_date');
            }
            if (request_string('orderkey'))
            {
                $order_row['order_id:LIKE'] = '%' . request_string('orderkey') . '%';
            }


            $user_id                           = Perm::$row['user_id'];
            $order_row['buyer_user_id']        = $user_id;
            $order_row['order_buyer_hidden:<'] = Order_BaseModel::IS_BUYER_REMOVE;
            $order_row['chain_id:!=']     = 0; //门店自提订单

            $data = $this->tradeOrderModel->getBaseList($order_row, array('order_create_time' => 'DESC'), $page, $rows);;
            $YLB_Page->totalRows = $data['totalsize'];
            $page_nav           = $YLB_Page->prompt();
        }


        if ('json' == $this->typ)
        {
            $this->data->addBody(-140, $data);
        }
        else
        {
            include $this->view->getView();
        }
    }

    /**
     * 生成门店自提订单
     *
     * @author     zcg
     */
    public function addChainOrder()
    {
        $user_id      = Perm::$row['user_id'];
        $user_account = Perm::$row['user_account'];
        $flag         = true;

        $chain_id          = request_int('chain_id');
        $goods_id          = request_int('goods_id');
        $goods_num         = 1;
        $mob_phone         = request_string('mob_phone');
        $true_name         = request_string('true_name');
        $remarks           = request_string('remarks');
        $increase_goods_id = request_row("increase_goods_id");
        $voucher_id        = request_row('voucher_id');
        //$pay_way_id	       = request_int('pay_way_id');
        $pay_way_id = 1;

        //判断支付方式为在线支付还是货到付款,如果是货到付款则订单状态直接为待发货状态，如果是在线支付则订单状态为待付款
        if($pay_way_id == PaymentChannlModel::PAY_ONLINE)
        {
            $order_status = Order_StateModel::ORDER_WAIT_PAY;
        }

        if($pay_way_id == PaymentChannlModel::PAY_CHAINPYA)
        {
            $order_status = Order_StateModel::ORDER_SELF_PICKUP;
        }

        $CartModel = new CartModel();
        $data      = $CartModel->getVirtualCart($goods_id, $goods_num);

        //开启事物
        $this->tradeOrderModel->sql->startTransactionDb();

        //获取用户的折扣信息
        $User_InfoModel = new User_InfoModel();
        $user_info      = $User_InfoModel->getOne($user_id);
        $User_GradeMode = new User_GradeModel();
        $user_grade     = $User_GradeMode->getOne($user_info['user_grade']);
        $user_rate      = $user_grade['user_grade_rate'];
        if ($user_rate <= 0)
        {
            $user_rate = 100;
        }

        //活动下的所有规则下的换购商品信息
        if ($increase_goods_id)
        {
            $Shop_ClassBindModel = new Shop_ClassBindModel();
            $Goods_CatModel = new Goods_CatModel();

            if(isset($data['increase_info']))
            {
                $increase_info = current($data['increase_info']);
                if(count($increase_goods_id) > $increase_info['rule_info']['rule_goods_limit'])
                {
                    $this->data->addBody(-140, array(), '订单异常', 250);
                    return false;
                }

                foreach ($increase_info['exc_goods'] as $ex_k=>$ex_v)
                {
                    $ex_v['now_price']   = $ex_v['redemp_price'];
                    $ex_v['goods_num']   = 1;
                    $ex_v['goods_sumprice'] = $ex_v['redemp_price'];

                    if($ex_v['directseller_flag'])
                    {
                        //判断店铺中是否存在自定义的经营类目
                        $cat_base = $Shop_ClassBindModel->getByWhere(array('shop_id'=>$ex_v['shop_id'],'product_class_id'=>$ex_v['cat_id']));
                        if($cat_base)
                        {
                            $cat_base = current($cat_base);
                            $cat_commission = $cat_base['commission_rate'];
                        }
                        else
                        {
                            //获取分类佣金
                            $cat_base = $Goods_CatModel->getOne($ex_v['cat_id']);
                            if ($cat_base)
                            {
                                $cat_commission = $cat_base['cat_commission'];
                            }
                            else
                            {
                                $cat_commission = 0;
                            }
                        }

                        $ex_v['cat_commission'] = $cat_commission;
                        $ex_v['commission'] = number_format(($ex_v['redemp_price'] * $cat_commission / 100), 2, '.', '');

                        if(Web_ConfigModel::value('Plugin_Directseller'))
                        {
                            if($ex_v['directseller_flag'])
                            {
                                //产品佣金
                                $ex_v['directseller_commission_0'] = $ex_v['redemp_price']*$ex_v['common_cps_rate']/100;
                                $ex_v['directseller_commission_1'] = $ex_v['redemp_price']*$ex_v['common_second_cps_rate']/100;
                                $ex_v['directseller_commission_2'] = $ex_v['redemp_price']*$ex_v['common_third_cps_rate']/100;
                            }
                        }
                    }

                    $increase_goods_row[$ex_v['redemp_goods_id']] = $ex_v;
                }
            }

            if($increase_goods_row)
            {
                $increase_data_row = array();
                foreach ($increase_goods_id as $iv)
                {
                    if(array_key_exists($iv,$increase_goods_row))
                    {
                        if (array_key_exists($increase_goods_row[$iv]['shop_id'], $increase_data_row))
                        {
                            $increase_data_row['goods'][]  = $increase_goods_row[$iv];
                            $increase_data_row['price']   += $increase_goods_row[$iv]['redemp_price']*1;
                            $increase_data_row['commission'] += $increase_goods_row[$iv]['commission'];
                            if(Web_ConfigModel::value('Plugin_Directseller'))
                            {
                                $increase_data_row['directseller_commission'] += $increase_goods_row[$iv]['directseller_commission_0']+$increase_goods_row[$iv]['directseller_commission_1']+$increase_goods_row[$iv]['directseller_commission_2'];
                                $increase_data_row['directseller_flag'] = $increase_goods_row[$iv]['common_is_directseller'];
                            }
                        }
                        else
                        {
                            $increase_data_row['goods'][]    = $increase_goods_row[$iv];
                            $increase_data_row['price']      = $increase_goods_row[$iv]['redemp_price']*1;
                            $increase_data_row['commission'] = $increase_goods_row[$iv]['commission'];
                            if(Web_ConfigModel::value('Plugin_Directseller'))
                            {
                                $increase_data_row['directseller_commission'] = $increase_goods_row[$iv]['directseller_commission_0']+$increase_goods_row[$iv]['directseller_commission_1']+$increase_goods_row[$iv]['directseller_commission_2'];
                                $increase_data_row['directseller_flag'] = $increase_goods_row[$iv]['common_is_directseller'];
                            }
                        }
                    }
                }
            }
        }

        //查找代金券的信息
        if ($voucher_id)
        {
            $voucher_id = current($voucher_id);

            if($data['voucher_base'] && array_key_exists($voucher_id,$data['voucher_base']))
            {
                $voucher_id    = $data['voucher_base'][$voucher_id]['voucher_id'];
                $voucher_price = $data['voucher_base'][$voucher_id]['voucher_price'];
                $voucher_code  = $data['voucher_base'][$voucher_id]['voucher_code'];
            }
        }
        else
        {
            $voucher_id    = 0;
            $voucher_price = 0;
            $voucher_code  = 0;
        }

        $Number_SeqModel = new Number_SeqModel();
        $Order_BaseModel = new Order_BaseModel();
        $Order_GoodsModel = new Order_GoodsModel();
        $PaymentChannlModel = new PaymentChannlModel();
        $Order_GoodsSnapshot = new Order_GoodsSnapshot();

        //生成店铺订单

        //满送
        $mansong_price = 0;
        $order_shop_benefit = '';
        if ($data['mansong_info'] && $data['man_sprice'] >= $data['mansong_info']['rule_price'])
        {
            $order_shop_benefit = $order_shop_benefit . '店铺满减:';
            if ($data['mansong_info']['rule_discount'])
            {
                $order_shop_benefit = $order_shop_benefit . ' 优惠' . format_money($data['mansong_info']['rule_discount']) . ' ';
                $mansong_price = $data['mansong_info']['rule_discount'];
            }
        }

        if ($user_rate < 100)
        {
            $order_shop_benefit = $order_shop_benefit . ' 会员折扣:' . $user_rate . '% ';
        }

        if($voucher_price)
        {
            $order_shop_benefit = $order_shop_benefit . ' 代金券:' . format_money($voucher_price) . ' ';
        }

        $order_price = $data['sumprice'] - $mansong_price;
        $commission  = $data['commission'];

        if($increase_data_row)
        {
            $order_price += $increase_data_row['price'];
            $commission += $increase_data_row['commission'];
        }

        $prefix       = sprintf('%s-%s-', YLB_Registry::get('shop_app_id'), date('Ymd'));
        $order_number = $Number_SeqModel->createSeq($prefix);

        $order_id = sprintf('%s-%s-%s-%s', 'DD', $data['shop_base']['user_id'], $data['shop_base']['shop_id'], $order_number);

        $order_row                           = array();
        $order_row['order_id']               = $order_id;
        $order_row['shop_id']                = $data['shop_base']['shop_id'];
        $order_row['shop_name']              = $data['shop_base']['shop_name'];
        $order_row['buyer_user_id']          = $user_id;
        $order_row['buyer_user_name']        = $user_account;
        $order_row['seller_user_id']         = $data['shop_base']['user_id'];
        $order_row['seller_user_name']       = $data['shop_base']['user_name'];
        $order_row['order_date']             = date('Y-m-d');
        $order_row['order_create_time']      = get_date_time();
        $order_row['order_receiver_name']    = $true_name;
        $order_row['order_receiver_contact'] = $mob_phone;
        $order_row['order_goods_amount']     = $order_price;
        $order_row['order_payment_amount']   = (($order_price - $voucher_price) * $user_rate) / 100;
        $order_row['order_discount_fee']     = (($order_price + $voucher_price) * (100 - $user_rate)) / 100 ;   //折扣金额
        $order_row['order_point_fee']        = 0;    //买家使用金蛋
        $order_row['order_message']          = $remarks;
        $order_row['order_status']           = $order_status;
        $order_row['order_points_add']       = 0;    //订单赠送的金蛋
        $order_row['voucher_id']             = $voucher_id;    //代金券id
        $order_row['voucher_price']          = $voucher_price;    //代金券面额
        $order_row['voucher_code']           = $voucher_code;    //代金券编码
        $order_row['order_commission_fee']   = $commission;  //交易佣金
        $order_row['order_is_virtual']       = 0;    //1-虚拟订单 0-实物订单
        $order_row['order_shop_benefit']     = $order_shop_benefit;  //店铺优惠
        $order_row['payment_id']			 = $pay_way_id;
        $order_row['payment_name']			 = $PaymentChannlModel->payWay[$pay_way_id];
        $order_row['chain_id']			     = $chain_id;
        $order_row['district_id']			 = $data['shop_base']['district_id'];

        $flag1 = $this->tradeOrderModel->addBase($order_row);

        $flag = $flag && $flag1;

        //计算商品的优惠
        $order_goods_benefit = '';
        if (isset($data['goods_base']['promotion']))
        {
            if($data['goods_base']['promotion']['promotion_price'] < $data['goods_base']['goods_price'] && $data['goods_base']['promotion']['down_price'])
            {
                $order_goods_benefit = $data['goods_base']['promotion']['promotion_type_con'] . ':直降' .format_money($data['goods_base']['promotion']['down_price']) . ' ';
            }
        }

        $trade_title = '';

        //插入订单商品表
        $order_goods_row                                  = array();
        $order_goods_row['order_id']                      = $order_id;
        $order_goods_row['goods_id']                      = $data['goods_base']['goods_id'];
        $order_goods_row['common_id']                     = $data['goods_base']['common_id'];
        $order_goods_row['buyer_user_id']                 = $user_id;
        $order_goods_row['goods_name']                    = $data['goods_base']['goods_name'];
        $order_goods_row['goods_class_id']                = $data['goods_base']['cat_id'];
        $order_goods_row['order_spec_info']               = $data['goods_base']['spec'];
        $order_goods_row['goods_price']                   = $data['goods_base']['goods_price'];
        $order_goods_row['order_goods_num']               = $goods_num;
        $order_goods_row['goods_image']                   = $data['goods_base']['goods_image'];
        $order_goods_row['order_goods_amount']            = $data['goods_base']['goods_price'];
        $order_goods_row['order_goods_discount_fee']      = ($data['goods_base']['goods_price'] * (100 - $user_rate)) / 100;        //优惠价格
        $order_goods_row['order_goods_adjust_fee']        = 0;    //手工调整金额
        $order_goods_row['order_goods_point_fee']         = 0;    //金蛋费用
        $order_goods_row['order_goods_commission']        = $data['goods_base']['commission'];   //商品佣金
        $order_goods_row['shop_id']                       = $data['goods_base']['shop_id'];
        $order_goods_row['order_goods_status']            = $order_status;
        $order_goods_row['order_goods_evaluation_status'] = 0;  //0未评价 1已评价
        $order_goods_row['order_goods_benefit']           = $order_goods_benefit;
        $order_goods_row['order_goods_time']              = get_date_time();

        $flag2 = $Order_GoodsModel->addGoods($order_goods_row);

        $trade_title .= $data['goods_base']['goods_name'].',';

        //加入交易快照表
        $order_goods_snapshot_add_row = array();
        $order_goods_snapshot_add_row['order_id'] 		=	$order_id;
        $order_goods_snapshot_add_row['user_id'] 		=	$user_id;
        $order_goods_snapshot_add_row['shop_id'] 		=	$data['goods_base']['shop_id'];
        $order_goods_snapshot_add_row['common_id'] 	    =	$data['goods_base']['common_id'];
        $order_goods_snapshot_add_row['goods_id'] 		=	$data['goods_base']['goods_id'];
        $order_goods_snapshot_add_row['goods_name'] 	=	$data['goods_base']['goods_name'];
        $order_goods_snapshot_add_row['goods_image'] 	=	$data['goods_base']['goods_image'];
        $order_goods_snapshot_add_row['goods_price'] 	=	$data['goods_base']['goods_price'];
        $order_goods_snapshot_add_row['freight'] 		=	0;   //运费
        $order_goods_snapshot_add_row['snapshot_create_time'] =	get_date_time();
        $order_goods_snapshot_add_row['snapshot_uptime']      =	get_date_time();
        $order_goods_snapshot_add_row['snapshot_detail'] = $order_goods_benefit;

        $Order_GoodsSnapshot->addSnapshot($order_goods_snapshot_add_row);

        $flag  = $flag && $flag2;

        if (isset($increase_data_row))
        {
            foreach ($increase_data_row['goods'] as $k => $v)
            {
                $order_goods_row                                  = array();
                $order_goods_row['order_id']                      = $order_id;
                $order_goods_row['goods_id']                      = $v['goods_id'];
                $order_goods_row['common_id']                     = $v['common_id'];
                $order_goods_row['buyer_user_id']                 = $user_id;
                $order_goods_row['goods_name']                    = $v['goods_name'];
                $order_goods_row['goods_class_id']                = $v['cat_id'];
                $order_goods_row['goods_price']                   = $v['redemp_price'];
                $order_goods_row['order_goods_num']               = 1;
                $order_goods_row['goods_image']                   = $v['goods_image'];
                $order_goods_row['order_goods_amount']            = $v['redemp_price'];
                $order_goods_row['order_goods_discount_fee']      = ($v['redemp_price'] * (100 - $user_rate)) / 100;        //优惠价格
                $order_goods_row['order_goods_adjust_fee']        = 0;    //手工调整金额
                $order_goods_row['order_goods_point_fee']         = 0;    //金蛋费用
                $order_goods_row['order_goods_commission']        = $v['commission'];  //商品佣金
                $order_goods_row['shop_id']                       = $data['goods_base']['shop_id'];
                $order_goods_row['order_goods_status']            = $order_status;
                $order_goods_row['order_goods_evaluation_status'] = 0;  //0未评价 1已评价
                $order_goods_row['order_goods_benefit']           = '加价购商品';
                $order_goods_row['order_goods_time']              = get_date_time();

                $trade_title .= $v['goods_name'].',';

                $flag2 = $Order_GoodsModel->addGoods($order_goods_row);

                //加入交易快照表(加价购商品)
                $order_goods_snapshot_add_row = array();
                $order_goods_snapshot_add_row['order_id'] 		=	$order_id;
                $order_goods_snapshot_add_row['user_id'] 		=	$user_id;
                $order_goods_snapshot_add_row['shop_id'] 		=	$v['shop_id'];
                $order_goods_snapshot_add_row['common_id'] 	    =	$v['common_id'];
                $order_goods_snapshot_add_row['goods_id'] 		=	$v['goods_id'];
                $order_goods_snapshot_add_row['goods_name'] 	=	$v['goods_name'];
                $order_goods_snapshot_add_row['goods_image'] 	=	$v['goods_image'];
                $order_goods_snapshot_add_row['goods_price'] 	=	$v['redemp_price'];
                $order_goods_snapshot_add_row['freight'] 		=	0;   //运费
                $order_goods_snapshot_add_row['snapshot_create_time'] =	get_date_time();
                $order_goods_snapshot_add_row['snapshot_uptime'] =		get_date_time();
                $order_goods_snapshot_add_row['snapshot_detail'] = '加价购商品';

                $Order_GoodsSnapshot->addSnapshot($order_goods_snapshot_add_row);

                $flag = $flag && $flag2;
            }
        }

        //店铺满赠商品
        if ($data['mansong_info'] && $data['mansong_info']['gift_goods_id'])
        {
            $order_goods_row                                  = array();
            $order_goods_row['order_id']                      = $order_id;
            $order_goods_row['goods_id']                      = $data['mansong_info']['gift_goods_id'];
            $order_goods_row['common_id']                     = $data['mansong_info']['common_id'];
            $order_goods_row['buyer_user_id']                 = $user_id;
            $order_goods_row['goods_name']                    = $data['mansong_info']['goods_name'];
            $order_goods_row['goods_class_id']                = 0;
            $order_goods_row['goods_price']                   = 0;
            $order_goods_row['order_goods_num']               = 1;
            $order_goods_row['goods_image']                   = $data['mansong_info']['goods_image'];
            $order_goods_row['order_goods_amount']            = 0;
            $order_goods_row['order_goods_discount_fee']      = 0;        //优惠价格
            $order_goods_row['order_goods_adjust_fee']        = 0;    //手工调整金额
            $order_goods_row['order_goods_point_fee']         = 0;    //金蛋费用
            $order_goods_row['order_goods_commission']        = 0;    //商品佣金
            $order_goods_row['shop_id']                       = $data['goods_base']['shop_id'];
            $order_goods_row['order_goods_status']            = $order_status;
            $order_goods_row['order_goods_evaluation_status'] = 0;  //0未评价 1已评价
            $order_goods_row['order_goods_benefit']           = '店铺满赠商品';
            $order_goods_row['order_goods_time']              = get_date_time();

            $trade_title .= $data['mansong_info']['goods_name'].',';

            $flag2 = $Order_GoodsModel->addGoods($order_goods_row);

            //加入交易快照表(满赠商品)
            $order_goods_snapshot_add_row = array();
            $order_goods_snapshot_add_row['order_id'] 		=	$order_id;
            $order_goods_snapshot_add_row['user_id'] 		=	$user_id;
            $order_goods_snapshot_add_row['shop_id'] 		=	$data['shop_base']['shop_id'];
            $order_goods_snapshot_add_row['common_id'] 	=	$data['mansong_info']['common_id'];
            $order_goods_snapshot_add_row['goods_id'] 		=	$data['mansong_info']['gift_goods_id'];
            $order_goods_snapshot_add_row['goods_name'] 	=	$data['mansong_info']['goods_name'];
            $order_goods_snapshot_add_row['goods_image'] 	=	$data['mansong_info']['goods_image'];
            $order_goods_snapshot_add_row['goods_price'] 	=	0;
            $order_goods_snapshot_add_row['freight'] 		=	0;   //运费
            $order_goods_snapshot_add_row['snapshot_create_time'] =	get_date_time();
            $order_goods_snapshot_add_row['snapshot_uptime'] =		get_date_time();
            $order_goods_snapshot_add_row['snapshot_detail'] = '店铺满赠商品';

            $Order_GoodsSnapshot->addSnapshot($order_goods_snapshot_add_row);

            $flag = $flag && $flag2;
        }

        //删除商品库存
        $Chain_GoodsModel      = new Chain_GoodsModel();
        $chain_row['chain_id'] = $chain_id;
        $chain_row['goods_id'] = $goods_id;
        $chain_row['shop_id']  = $data['shop_base']['shop_id'];
        $chain_goods = current($Chain_GoodsModel->getByWhere($chain_row));
        $chain_goods_id = $chain_goods['chain_goods_id'];
        $goods_stock['goods_stock'] = $chain_goods['goods_stock'] - 1;
        $flag3 = $Chain_GoodsModel->editGoods($chain_goods_id, $goods_stock);
        $flag  = $flag && $flag3;

        if ($flag && $this->tradeOrderModel->sql->commitDb())
        {
            //支付中心生成订单
            $key         = YLB_Registry::get('shop_api_key');
            $url         = YLB_Registry::get('paycenter_api_url');
            $shop_app_id = YLB_Registry::get('shop_app_id');
            $formvars    = array();

            $formvars['app_id']			      = $shop_app_id;
            $formvars['from_app_id']          = YLB_Registry::get('shop_app_id');
            $formvars['consume_trade_id']     = $order_row['order_id'];
            $formvars['order_id']             = $order_row['order_id'];
            $formvars['buy_id']               = Perm::$userId;
            $formvars['buyer_name'] 		  = Perm::$row['user_account'];
            $formvars['seller_id']            = $order_row['seller_user_id'];
            $formvars['seller_name']		  = $order_row['seller_user_name'];
            $formvars['order_state_id']       = $order_row['order_status'];
            $formvars['order_payment_amount'] = $order_row['order_payment_amount'];
            $formvars['trade_remark']         = $order_row['order_message'];
            $formvars['trade_create_time']    = $order_row['order_create_time'];
            $formvars['trade_title']		  = $trade_title;		//商品名称 - 标题

            $rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_Pay_Pay&met=addConsumeTrade&typ=json',$url), $formvars);

            if ($rs['status'] == 200)
            {
                $Order_BaseModel->editBase($order_row['order_id'],array('payment_number' => $rs['data']['union_order']));

                //生成合并支付订单
                $key      = YLB_Registry::get('shop_api_key');
                $url         = YLB_Registry::get('paycenter_api_url');
                $shop_app_id = YLB_Registry::get('shop_app_id');
                $formvars = array();

                $formvars['inorder']    = $order_id . ',';
                $formvars['uprice']     = $order_row['order_payment_amount'];
                $formvars['buyer']      = Perm::$userId;
                $formvars['trade_title'] = $trade_title;
                $formvars['buyer_name'] = Perm::$row['user_account'];
                $formvars['app_id']     = $shop_app_id;
                $formvars['from_app_id'] = YLB_Registry::get('shop_app_id');

                $rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_Pay_Pay&met=addUnionOrder&typ=json', $url), $formvars);

                if ($rs['status'] == 200)
                {
                    if ($order_status == Order_StateModel::ORDER_SELF_PICKUP)
                    {
                        $code = VerifyCode::getCode($mob_phone);

                        $Chain_BaseModel = new Chain_BaseModel();
                        $chain_base      = current($Chain_BaseModel->getByWhere(array('chain_id'=>$chain_id)));

                        $Order_GoodsChainCodeModel = new Order_GoodsChainCodeModel();
                        $code_data['order_id']       = $order_id;
                        $code_data['chain_id']       = $chain_id;
                        $code_data['order_goods_id'] = $goods_id;
                        $code_data['chain_code_id']  = $code;
                        $Order_GoodsChainCodeModel->addGoodsChainCode($code_data);

                        $message = new MessageModel();
                        $message->sendMessage('Self pick up code', Perm::$userId, Perm::$row['user_account'], $order_id = NULL, $shop_name = $data['shop_base']['shop_name'], 1, 1,  Null,NULL,NULL,NULL, Null,$goods_name=$data['goods_base']['goods_name'],NULL,NULL,$ztm=$code,$chain_name=$chain_base['chain_name'],$order_phone=$mob_phone);
                    }
                    $uorder = $rs['data']['uorder'];
                }
                else
                {
                    $uorder = '';
                }

            }

            /*$analytics_data = array(
                'order_id' => $order_id,
                'union_order_id'=>$uorder,
                'user_id'=>Perm::$userId,
                'ip'=> get_ip(),
                'addr'=>'',
                'chain_id'=>$chain_id,
                'type'=>3
            );
            YLB_Plugin_Manager::getInstance()->trigger('analyticsOrderAdd',$analytics_data);*/

            $status = 200;
            $msg    = _('success');
            $data   = $rs['data'];
        }
        else
        {
            $this->tradeOrderModel->sql->rollBackDb();
            $m      = $this->tradeOrderModel->msg->getMessages();
            $msg    = $m ? $m[0] : _('failure');
            $status = 250;
            $data   = array();
        }
        $this->data->addBody(-140, $data, $msg, $status);

    }

    function add_product($order_id)
    {
        $shop_id = Perm::$shopId;
        $Goods_CommonModel = new Goods_CommonModel();
        $Shop_BaseModel = new Shop_BaseModel();
        $Goods_BaseModel   = new Goods_BaseModel();
        $Order_GoodsModel               = new Order_GoodsModel();

        $order_goods_list = $Order_GoodsModel ->getByWhere(array('order_id'=>$order_id));
        foreach ($order_goods_list as $key => $value)
        {
            $edit_common_data  = array();
            $shop_info  = $Shop_BaseModel ->getOne($shop_id);
            $common_info = $Goods_CommonModel ->getOne($value['common_id']);

            //查看店铺商品中是否已经有该商品
            $shop_common = $Goods_CommonModel->getOneByWhere(array('shop_id'=>$shop_id,'common_parent_id'=>$common_info['common_id'],'product_is_behalf_delivery' => 0));

            $old_common_id = $common_info['common_id'];

            if(empty($shop_common))
            {
                //同步新商品
                $edit_common_data['common_stock']  = $value['order_goods_num'];
                $common_id = $Goods_CommonModel->SynchronousCommon($old_common_id,$shop_info);
            }
            else
            {
                $edit_common_data['common_spec_value']  = $shop_common['common_spec_value'];
                $common_id = $shop_common['common_id'];
                $stock = $shop_common['common_stock'] + $value['order_goods_num'];
                //获取同步商品的信息
                $common_row = $Goods_CommonModel->SynchronousCommon($old_common_id,$shop_info,'edit');
                $common_row['common_stock'] = $stock;
                $Goods_CommonModel->editCommon($shop_common['common_id'], $common_row);

                //商品详情信息
                $goodsCommonDetailModel  = new Goods_CommonDetailModel();
                $common_detail = $goodsCommonDetailModel->getOne($old_common_id);

                $common_detail_data['common_body'] = $common_detail['common_body'];
                $goodsCommonDetailModel->editCommonDetail($common_id,$common_detail_data);
            }


            //查看店铺的商品goods_parent_id是否存在
            $shop_base = $Goods_BaseModel->getOneByWhere(array('shop_id'=>$shop_id,'goods_parent_id'=>$value['goods_id']));
            //根据商品订单表数据，同步goodbase数据
            $base = $Goods_BaseModel->getOneByWhere(array('goods_id'=>$value['goods_id']));

            if(!empty($base))
            {
                $base_row = array();
                $base_row['common_id']  = $common_id;
                $base_row['shop_id']    = $shop_info['shop_id'];
                $base_row['shop_name']  = $shop_info['shop_name'];
                $base_row['goods_name']  = $base['goods_name'];
                $base_row['cat_id']        = $base['cat_id'];
                $base_row['brand_id']    = $base['brand_id'];
                $base_row['goods_spec']   = $base['goods_spec'];
                $base_row['goods_price']   = $base['goods_recommended_min_price'];
                $base_row['goods_market_price']  = $base['goods_recommended_max_price'];
                $base_row['goods_stock']         = $value['order_goods_num'];
                $base_row['goods_image']     = $base['goods_image'];
                $base_row['goods_parent_id'] = $base['goods_id'];
                $base_row['goods_is_shelves']  = 2;
                $base_row['goods_recommended_min_price'] = $base['goods_recommended_min_price'];
                $base_row['goods_recommended_max_price']  = $base['goods_recommended_max_price'];

                if(empty($shop_base))
                {
                    $goods_id=$Goods_BaseModel ->addBase($base_row, true);
                }else
                {
                    $stock = $shop_base['goods_stock'] + $value['order_goods_num'];

                    $base_row['goods_stock'] = $stock;
                    $goods_id = $shop_base['goods_id'];
                    $Goods_BaseModel ->editBase($shop_base['goods_id'],$base_row,false);
                }
                $goods_ids[] = array(
                    'goods_id' => $goods_id,
                    'color' => $base['color_id']
                );

                //重新构造common表common_spec_value,common_spec_name
                $GoodsSpecValueModel = new Goods_SpecValueModel();
                foreach ($base['goods_spec'] as $skey => $svalue)
                {
                    foreach ($svalue as $k => $v)
                    {
                        $spec_valuebase = $GoodsSpecValueModel -> getOne($k);
                        if(!isset($edit_common_data['common_spec_value'][$spec_valuebase['spec_id']][$spec_valuebase['spec_value_id']]))
                        {
                            $edit_common_data['common_spec_value'][$spec_valuebase['spec_id']][$spec_valuebase['spec_value_id']] = $spec_valuebase['spec_value_name'];
                        }
                    }
                }
            }

            $edit_common_data['goods_id'] = $goods_ids;
            $edit_common_data['common_state']  = 0;
            $Goods_CommonModel->editCommon($common_id, $edit_common_data);
        }
    }


    /**
     * 生成分销商进货订单
     * 该方法生成的是分销商在供货商出进货的订单，分销商为买家，供货商为卖家
     * Zhenzh 20180525 修改
     *
     * @param $order_source_id    分销商的订单号
     * @param $supplier_shop_id   供应商店铺id
     * @param $vv                 分销商品信息
     * @param $receiver_name      收货人姓名
     * @param $receiver_address   收货人地址
     * @param $receiver_phone     收货人电话
     * @param $dis_shop_id        分销商店铺id
     * @param $dis_user_id        分销商用户id
     * @param $dis_user_name      分销商用户name
     * @param $pay_way_id         支付方式
     * @return bool|string
     */
    public function distributor_add_order($order_source_id,$supplier_shop_id,$vv,$receiver_name,$receiver_address,$receiver_phone,$dis_shop_id,$dis_user_id,$dis_user_name,$pay_way_id)
    {
        $ShopBaseModel      = new Shop_BaseModel();
        $GoodsBaseModel     = new Goods_BaseModel();
        $ShopClassBindModel = new Shop_ClassBindModel();
        $GoodsCatModel      = new Goods_CatModel();

        $Number_SeqModel    = new Number_SeqModel();
        $OrderBaseModel     = new Order_BaseModel();
        $OrderGoodsModel    = new Order_GoodsModel();
        $PaymentChannlModel = new PaymentChannlModel();
        $OrderGoodsSnapshot = new Order_GoodsSnapshot();
        $ShopDistributorModel      = new Distribution_ShopDistributorModel();
        $ShopDistributorLevelModel = new Distribution_ShopDistributorLevelModel();


        //判断支付方式为在线支付还是货到付款,如果是货到付款则订单状态直接为待发货状态，如果是在线支付则订单状态为待付款
        if($pay_way_id == PaymentChannlModel::PAY_ONLINE)
        {
            $order_status = Order_StateModel::ORDER_WAIT_PAY;
        }
        else if($pay_way_id == PaymentChannlModel::PAY_CONFIRM)
        {
            $order_status = Order_StateModel::ORDER_WAIT_PREPARE_GOODS;
        }

        //供应商店铺信息
        $supplier_shop_info = $ShopBaseModel->getOne($supplier_shop_id);
        //获取供货商给该分销商设置的折扣
        $shop_distributor_info     = $ShopDistributorModel->getOneByWhere(array('shop_id' =>$supplier_shop_info['shop_id'],'distributor_id'=>$dis_shop_id,'distributor_enable'=>1));
        $distributor_rate_info     = $ShopDistributorLevelModel->getOne($shop_distributor_info['distributor_level_id']);

        //商品价格：供应商的进货价-分销商等级优惠+供应商设置的物流费用
        $discount_rate = 100;
        if($distributor_rate_info && $distributor_rate_info['distributor_leve_discount_rate'] > 0 && $distributor_rate_info['distributor_leve_discount_rate'] < 100)
        {
            $discount_rate = $distributor_rate_info['distributor_leve_discount_rate'];
        }

        $sup_goods_id = array_column($vv['goods'],'goods_parent_id');

        if($sup_goods_id)
        {
            $goods_row = $GoodsBaseModel->getBase($sup_goods_id);

            foreach ($vv['goods'] as $key => $value)
            {
                if(isset($goods_row[$value['goods_parent_id']]))
                {
                    $goods_row[$value['goods_parent_id']]['goods_num'] = $value['goods_num'];
                }
            }

            $order_goods_amount = 0;
            $order_cat_commission = 0;
            $goods_cat_row      = array();
            foreach ($goods_row as $key => $value)
            {
                //该商品的交易佣金计算
                $cat_commission = 0;
                if($goods_cat_row[$value['cat_id']])
                {
                    $cat_commission = $goods_cat_row[$value['cat_id']];
                }
                else
                {
                    $goods_cat = $ShopClassBindModel->getOneByWhere(array('shop_id'=>$supplier_shop_id,'product_class_id'=>$value['cat_id']));
                    if($goods_cat)
                    {
                        $cat_commission = $goods_cat['commission_rate'];
                    }
                    else
                    {
                        $goods_cat = $GoodsCatModel->getOne($value['cat_id']);
                        if ($goods_cat)
                        {
                            $cat_commission = $goods_cat['cat_commission'];
                        }
                    }

                    $goods_cat_row[$value['cat_id']] = $cat_commission;
                }


                $goods_row[$key]['order_goods_amount'] = number_format(($value['goods_price'] * $discount_rate * $value['goods_num'] / 100), 2, '.', '');
                $goods_row[$key]['cat_commission'] = $cat_commission;
                $goods_row[$key]['commission'] = number_format(($goods_row[$key]['order_goods_amount'] * $cat_commission * $value['goods_num'] / 100), 2, '.', '');
                $goods_row[$key]['order_goods_payment_amount'] = number_format($goods_row[$key]['order_goods_amount'] / $value['goods_num'],2,'.','');

                $order_goods_amount += $goods_row[$key]['order_goods_amount'];
                $order_cat_commission += $goods_row[$key]['commission'];
            }

            //生成店铺订单
            $prefix       = sprintf('%s-%s-', YLB_Registry::get('shop_app_id'), date('Ymd'));
            $order_number = $Number_SeqModel->createSeq($prefix);
            $order_id     = sprintf('%s-%s-%s-%s', 'SP', $supplier_shop_info['user_id'],$supplier_shop_info['shop_id'], $order_number);
            $order_row                           = array();
            $order_row['order_id']               = $order_id;
            $order_row['shop_id']                = $supplier_shop_info['shop_id'];
            $order_row['shop_name']              = $supplier_shop_info['shop_name'];
            $order_row['buyer_user_id']          = $dis_user_id;
            $order_row['buyer_user_name']        = $dis_user_name;
            $order_row['seller_user_id']         = $supplier_shop_info['user_id'];
            $order_row['seller_user_name']       = $supplier_shop_info['user_name'];
            $order_row['order_date']             = date('Y-m-d');
            $order_row['order_create_time']      = get_date_time();
            $order_row['order_receiver_name']    = $receiver_name;
            $order_row['order_receiver_address'] = $receiver_address;
            $order_row['order_receiver_contact'] = $receiver_phone;
            $order_row['order_goods_amount']     = $order_goods_amount; //订单商品总价（不包含运费）
            $order_row['order_payment_amount']   = $order_goods_amount + $vv['sp_cost']; //订单实际支付金额 = 商品实际支付金额 + 运费
            $order_row['order_discount_fee']     = 0;   //优惠价格 = 商品总价 - 商品实际支付金额
            $order_row['order_point_fee']        = 0;    //买家使用金蛋
            $order_row['order_shipping_fee']     = $vv['sp_cost']; //运费
            $order_row['order_status']           = $order_status;
            $order_row['order_points_add']       = 0;    //订单赠送的金蛋
            $order_row['order_commission_fee']   = $order_cat_commission;  //分类佣金
            $order_row['order_source_id']        = $order_source_id;    // 进货订单对应的买家订单
            $order_row['order_is_virtual']       = 0;    //1-虚拟订单 0-实物订单
            $order_row['payment_id']			 = $pay_way_id;
            $order_row['payment_name']			 = $PaymentChannlModel->payWay[$pay_way_id];
            $order_row['directseller_discount']  = $discount_rate;
            $order_row['order_type']             = Order_BaseModel::ORDER_SP;
            $order_row['shop_class_id']          = $supplier_shop_info['shop_class_id'];
            $flag = $this->tradeOrderModel->addBase($order_row);

            foreach ($goods_row as $key => $value)
            {
                $order_goods_row                                  = array();
                $order_goods_row['order_id']                      = $order_id;
                $order_goods_row['goods_id']                      = $value['goods_id'];
                $order_goods_row['common_id']                     = $value['common_id'];
                $order_goods_row['buyer_user_id']                 = $dis_user_id;
                $order_goods_row['goods_name']                    = $value['goods_name'];
                $order_goods_row['goods_class_id']                = $value['cat_id'];
                $order_goods_row['order_spec_info']               = $value['spec'];
                $order_goods_row['goods_price']                   = $value['goods_price']; //商品原来的单价
                $order_goods_row['order_goods_payment_amount']    = $value['order_goods_payment_amount'];  //商品实际支付单价
                $order_goods_row['order_goods_amount']            = $value['order_goods_amount'];  //商品实际支付金额
                $order_goods_row['order_goods_num']               = $value['goods_num'];
                $order_goods_row['goods_image']                   = $value['goods_image'];
                $order_goods_row['order_goods_discount_fee']      = 0;    //优惠价格
                $order_goods_row['order_goods_adjust_fee']        = 0;    //手工调整金额
                $order_goods_row['order_goods_point_fee']         = 0;    //金蛋费用
                $order_goods_row['order_goods_commission']        = $value['commission'];    //商品佣金(总)
                $order_goods_row['shop_id']                       = $value['shop_id'];
                $order_goods_row['order_goods_status']            = Order_StateModel::ORDER_WAIT_PAY;
                $order_goods_row['order_goods_evaluation_status'] = 0;  //0未评价 1已评价
                $order_goods_row['order_goods_benefit']           = 0;
                $order_goods_row['order_goods_time']              = get_date_time();
                $order_goods_row['directseller_goods_discount']   = $discount_rate;

                $flag1 = $OrderGoodsModel->addGoods($order_goods_row);

                //加入交易快照表
                $order_goods_snapshot_add_row = array();
                $order_goods_snapshot_add_row['order_id'] 		=	$order_id;
                $order_goods_snapshot_add_row['user_id'] 		=	$dis_user_id;
                $order_goods_snapshot_add_row['shop_id'] 		=	$value['shop_id'];
                $order_goods_snapshot_add_row['common_id'] 	    =	$value['common_id'];
                $order_goods_snapshot_add_row['goods_id'] 		=	$value['goods_id'];
                $order_goods_snapshot_add_row['goods_name'] 	=	$value['goods_name'];
                $order_goods_snapshot_add_row['goods_image'] 	=	$value['goods_image'];
                $order_goods_snapshot_add_row['goods_price'] 	=	$value['goods_price'];
                $order_goods_snapshot_add_row['freight'] 		=	$vv['sp_cost'];   //运费
                $order_goods_snapshot_add_row['snapshot_create_time'] =	get_date_time();
                $order_goods_snapshot_add_row['snapshot_uptime'] =		get_date_time();
                $order_goods_snapshot_add_row['snapshot_detail'] = 0;

                $OrderGoodsSnapshot->addSnapshot($order_goods_snapshot_add_row);

                $flag = $flag && $flag1;

                //删除商品库存
                $flag2 = $GoodsBaseModel->delStock($value['goods_id'], $value['goods_num']);

                $trade_title = $value['goods_name'];
            }

            //支付中心生成订单
            $shop_api_key      = YLB_Registry::get('shop_api_key');
            $paycenter_api_url = YLB_Registry::get('paycenter_api_url');
            $shop_app_id 	   = YLB_Registry::get('shop_app_id');

            $formvars                         = array();
            $formvars['app_id']				  = $shop_app_id;
            $formvars['from_app_id']          = $shop_app_id;
            $formvars['consume_trade_id']     = $order_row['order_id'];
            $formvars['order_id']             = $order_row['order_id'];
            $formvars['buy_id']               = $dis_user_id;
            $formvars['buyer_name'] 		  = $dis_user_name;
            $formvars['seller_id']            = $order_row['seller_user_id'];
            $formvars['seller_name']		  = $order_row['seller_user_name'];
            $formvars['order_state_id']       = $order_row['order_status'];
            $formvars['order_payment_amount'] = $order_row['order_payment_amount'];
            $formvars['order_commission_fee'] = $order_cat_commission;
            $formvars['trade_remark']         ='采购单';
            $formvars['trade_create_time']    = $order_row['order_create_time'];
            $formvars['trade_title']		  = $trade_title;		//商品名称 - 标题

            $rs = get_url_with_encrypt($shop_api_key, sprintf('%s?ctl=Api_Pay_Pay&met=addConsumeTrade&typ=json',$paycenter_api_url), $formvars);

            //将合并支付单号插入数据库
            if($rs['status'] == 200)
            {
                $OrderBaseModel->editBase($order_id,array('payment_number' => $rs['data']['union_order']));
                $flag = $flag && true;
            }
            else
            {
                $flag = $flag && false;
            }

            //生成合并支付订单
            $uprice       = $order_row['order_payment_amount'];
            $inorder      = $order_id . ',';
            $utrade_title = $trade_title;

            $formvars 		         = array();
            $formvars['inorder']     = $inorder;
            $formvars['uprice']      = $uprice;
            $formvars['buyer']       = $dis_user_id;
            $formvars['buyer_name']  = $dis_user_name;
            $formvars['trade_title'] = $utrade_title;
            $formvars['app_id']      = $shop_app_id;
            $formvars['from_app_id'] = YLB_Registry::get('shop_app_id');

            $rs = get_url_with_encrypt($shop_api_key, sprintf('%s?ctl=Api_Pay_Pay&met=addUnionOrder&typ=json', $paycenter_api_url), $formvars);

            if ($rs['status'] == 200)
            {
                $flag = $flag && true;
            }
            else
            {
                $flag = $flag && false;
            }

        }
        else
        {
            $flag = false;
        }

        return $flag;

    }

    /**
     * 买家 送福免单列表
     */
    public function fu()
    {
        $data = [];

        if(Perm::$userId)
        {
            $page   = request_int('page',1);
            $rows   = request_int('rows',10);
            $offset = $rows * ($page - 1);

            $query_start_date = request_string('query_start_date');
            $query_end_date   = request_string('query_end_date');
            $fu_status        = request_int('fu_status');

            $cond_sql = ' WHERE a.user_id = ' . Perm::$userId . ' ';
            if($query_start_date)
            {
                $cond_sql .= "AND fu_record_time >= '$query_start_date' ";
            }
            if($query_end_date)
            {
                $cond_sql .= "AND fu_record_time <= '$query_end_date' ";
            }
            if($fu_status && isset(Fu_RecordModel::$status_array_map[$fu_status]))
            {
                $cond_sql .= "AND status = $fu_status ";
            }

            $FuRecordModel = new Fu_RecordModel();
            $count_sql = "SELECT COUNT(*) count FROM " . TABEL_PREFIX . "fu_record a " . $cond_sql;
            $total = $FuRecordModel->selectSql($count_sql);

            if($total)
            {
                $total = pos($total);
                $total = $total['count'];

                if($total)
                {
                    $sql = 'SELECT a.*,b.fu_state,b.shop_name,b.fu_base base,b.goods_name,b.goods_price,b.goods_spec,b.goods_image,c.order_goods_amount FROM `'.TABEL_PREFIX.'fu_record` a ';
                    $sql .= 'LEFT JOIN `'.TABEL_PREFIX.'fu_base` b ON a.fu_id = b.fu_id ';
                    $sql .= 'LEFT JOIN `'.TABEL_PREFIX.'order_goods` c ON a.order_id = c.order_id AND a.goods_id = b.goods_id ';
                    $sql .= $cond_sql;
                    $sql .= "ORDER BY fu_record_time DESC LIMIT $offset,$rows";

                    $data['page'] = $page;
                    $data['total'] = ceil_r($total / $rows);  //total page
                    $data['totalsize'] = $total;
                    $data['records'] = $total;
                    $data['items'] = $FuRecordModel->selectSql($sql);

                    foreach ($data['items'] as $key => $value)
                    {
                        $fu_base = decode_json($value['fu_base']);
                        $base = decode_json($value['base']);

                        if ($value['fu_state'] != Fu_BaseModel::NORMAL)
                        {
                            $data['items'][$key]['delete'] = 1;
                            $data['items'][$key]['status'] = $value['status'] = Fu_RecordModel::OVER;

                            $expire_row[] = $value['fu_record_id'];
                        }

                        $data['items'][$key]['fu_base'] = $fu_base;
                        $data['items'][$key]['base'] = $base;
                        $data['items'][$key]['status_con'] = Fu_RecordModel::$status_array_map[$value['status']];
                    }

                    if($expire_row)
                    {
                        $FuRecordModel->editFuRecord($expire_row,['status'=>Fu_RecordModel::OVER]);
                    }
                }
            }

        }

        if ('json' == $this->typ)
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

}

?>