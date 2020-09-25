<?php
if (!defined('ROOT_PATH'))
{
    if (is_file('../../../shop/configs/config.ini.php'))
    {
        require_once '../../../shop/configs/config.ini.php';
    }
    else
    {
        die('请先运行index.php,生成应用程序框架结构！');
    }

    //不会重复包含, 否则会死循环: web调用不到此处, 通过crontab调用
    $Base_CronModel = new Base_CronModel();
    $rows = $Base_CronModel->checkTask(); //并非指执行自己, 将所有需要执行的都执行掉, 如果自己达到执行条件,也不执行.

    //终止执行下面内容, 否则会执行两次
    return ;
}


YLB_Log::log(__FILE__, YLB_Log::INFO, 'crontab');

$file_name_row = pathinfo(__FILE__);
$crontab_file = $file_name_row['basename'];

//执行任务
//自动确认收货(实物订单) 已整理Zhenzh 20180410

$Order_BaseModel = new Order_BaseModel();
$Order_GoodsModel = new Order_GoodsModel();

//开启事物
$Order_BaseModel->sql->startTransactionDb();

//查找出所有待收货状态的商品
$cond_row = array();
$cond_row['order_status'] = Order_StateModel::ORDER_WAIT_CONFIRM_GOODS;
$cond_row['order_is_virtual'] = Order_BaseModel::ORDER_IS_REAL;
$cond_row['order_receiver_date:<='] = get_date_time();

$order_list = $Order_BaseModel->select('order_id,buyer_user_id,order_payment_amount',$cond_row,'','');

if($order_list)
{
    $order_id = array_column($order_list,'order_id');

    if($order_id)
    {
        //取出所有订单商品id
        $order_goods_id = $Order_GoodsModel->getKeyByWhere(array('order_id:IN' => $order_id));

        //分享数据
        $sharePriceModel = new Share_PriceModel();
        $share_price_row = $sharePriceModel ->getByWhere(array('share_order_id:IN'=>$order_id));

        //修改订单状态
        $condition['order_status'] = Order_StateModel::ORDER_FINISH;
        $condition['order_finished_time'] = get_date_time();
        $flag = $Order_BaseModel->editBase($order_id, $condition);

        //修改订单商品表中的状态
        $edit_goods_row['order_goods_status'] = Order_StateModel::ORDER_FINISH;
        $Order_GoodsModel->editGoods($order_goods_id, $edit_goods_row);

        //修改财付宝 冻结分享金
        if($share_price_row)
        {
            $key         = YLB_Registry::get('shop_api_key');
            $url         = YLB_Registry::get('paycenter_api_url');
            $shop_app_id = YLB_Registry::get('shop_app_id');

            foreach ($share_price_row as $k=>$value)
            {
                $edit_share_price['dz_date'] = strtotime('+1 week',strtotime($condition['order_finished_time']));
                $edit_share_price['status']  = Share_PriceModel::FORZEN;
                $share_price_flag = $sharePriceModel->editSharePrice($value['id'],$edit_share_price);

                if($share_price_flag)
                {
                    if($value['promotion_unit_price'] > 0 && $value['promotion_click_count'])
                    {
                        $promotion_price = $value['promotion_unit_price'] * $value['promotion_click_count'];
                        if($promotion_price > $value['promotion_total_price'])
                        {
                            $promotion_price = $value['promotion_total_price'];
                        }

                        $formvars_share                          = array();
                        $formvars_share['app_id']                = $shop_app_id;
                        $formvars_share['share_price_id']        = $value['id'];
                        $formvars_share['share_uid']             = $value['share_uid'];
                        $formvars_share['promotion_price']       = $promotion_price;

                        $rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_Pay_Pay&met=editForzenSharePrice&typ=json', $url), $formvars_share);
                    }
                }
            }
        }

        //经验与成长值
        $user_points        = Web_ConfigModel::value("points_recharge");//订单每多少获取多少金蛋
        $user_points_amount = Web_ConfigModel::value("points_order");//最多多少金蛋
        $user_grade         = Web_ConfigModel::value("grade_recharge");//订单每多少获取多少成长值
        $user_grade_amount  = Web_ConfigModel::value("grade_order");//最多多少成长值

        $User_ResourceModel = new User_ResourceModel();
        $user_ids = array_column($order_list,'buyer_user_id');
        $user_resource_row = $User_ResourceModel->getResource($user_ids);

        $User_GradeModel = new User_GradeModel;
        $Points_LogModel = new Points_LogModel();
        $Grade_LogModel  = new Grade_LogModel;

        foreach ($order_list as $key=>$value)
        {
            //修改金蛋和成长值去掉运费 Zhenzh20180508
            $order_payment_amount = $order_base['order_payment_amount'] - $order_base['order_shipping_fee'];
            if ($order_payment_amount / $user_points < $user_points_amount)
            {
                $user_points = floor($order_payment_amount / $user_points);
            }
            else
            {
                $user_points = $user_points_amount;
            }

            if ($order_payment_amount / $user_grade < $user_grade_amount)
            {
                $user_grade = floor($order_payment_amount / $user_grade);
            }
            else
            {
                $user_grade = $user_grade_amount;
            }

            if($user_resource_row && array_key_exists($value['buyer_user_id'],$user_resource_row))
            {
                $ce = $user_resource_row[$value['buyer_user_id']];

                $resource_row = array();
                $resource_row['user_points'] = $ce['user_points'] * 1 + $user_points * 1;
                $resource_row['user_growth'] = $ce['user_growth'] * 1 + $user_grade * 1;
                $User_ResourceModel->editResource($value['buyer_user_id'], $resource_row);

                //升级判断
                $User_GradeModel->upGrade($value['buyer_user_id'], $resource_row['user_growth']);

                //添加金蛋记录
                $points_row = array();
                $points_row['user_id']           = $value['buyer_user_id'];
                $points_row['user_name']         = $value['buyer_user_name'];
                $points_row['class_id']          = Points_LogModel::ONBUY;
                $points_row['points_log_points'] = $user_points;
                $points_row['points_log_time']   = get_date_time();
                $points_row['points_log_desc']   = '确认收货';
                $points_row['points_log_flag']   = 'confirmorder';
                $Points_LogModel->addLog($points_row);

                //添加成长值记录
                $grade_row = array();
                $grade_row['user_id']         = $value['buyer_user_id'];
                $grade_row['user_name']       = $value['buyer_user_name'];
                $grade_row['class_id']        = Grade_LogModel::ONBUY;
                $grade_row['grade_log_grade'] = $user_grade;
                $grade_row['grade_log_time']  = get_date_time();
                $grade_row['grade_log_desc']  = '确认收货';
                $grade_row['grade_log_flag']  = 'confirmorder';
                $Grade_LogModel->addLog($grade_row);
            }
        }

        //将需要确认的订单号远程发送给Paycenter修改订单状态
        //远程修改paycenter中的订单状态
        $key         = YLB_Registry::get('shop_api_key');
        $url         = YLB_Registry::get('paycenter_api_url');
        $shop_app_id = YLB_Registry::get('shop_app_id');
        $formvars = array();
        $formvars['order_id'] = $order_id;
        $formvars['app_id']   = $shop_app_id;
        $formvars['type']	  = 'row';

        $rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_Pay_Pay&met=confirmOrder&typ=json', $url), $formvars);

    }
}
else
{
    $flag = true;
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


return $flag;
?>
















