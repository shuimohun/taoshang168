<?php
/**
 * Created by PhpStorm.
 * User: WenQingTeng
 * Date: 16/4/8
 * Time: ����2:01
 */

require_once '../../../configs/config.ini.php';

$trade_id = request_string('code');

$Union_OrderModel = new Union_OrderModel();
$uorder_base = $Union_OrderModel->getOne($trade_id);

if($uorder_base['order_state_id'] == Union_OrderModel::WAIT_PAY)
{
    /*$Consume_DepositModel = new Consume_DepositModel();
    $rs =  $Consume_DepositModel->notifyShop($trade_id,$uorder_base['buyer_id']);

    echo encode_json($rs);
    return encode_json($rs);*/
}
