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
//所有活动状态更新

//1、惠抢购
$scareBuyBaseModel = new ScareBuy_BaseModel();
$cond_row_scarebuy['scarebuy_state'] = ScareBuy_BaseModel::NORMAL;
$cond_row_scarebuy['scarebuy_endtime:<'] = get_date_time();
$scarebuy_id_row = $scareBuyBaseModel->getKeyByWhere($cond_row_scarebuy);
if($scarebuy_id_row)
{
    $field_row_scarebuy['scarebuy_state'] = ScareBuy_BaseModel::FINISHED;
    $scareBuyBaseModel->editScareBuy($scarebuy_id_row, $field_row_scarebuy);
}

//2、加价购
$increaseBaseModel = new Increase_BaseModel();
$cond_row_increase['increase_state'] = Increase_BaseModel::NORMAL;
$cond_row_increase['increase_end_time:<'] = get_date_time();
$increase_id_row = $increaseBaseModel->getKeyByWhere($cond_row_increase);
if($increase_id_row)
{
    $increaseBaseModel->sql->startTransactionDb();//开启事务
    $field_row_increase['increase_state'] = Increase_BaseModel::FINISHED;

    //更新加价购活动状态，到期结束，同时修改goods_common表中对应字段common_is_jia = 0 ;
    //$flag_update_increase = $increaseBaseModel->editIncreaseUnnormal($increase_id_row, $field_row_increase);

    //此处更改为只修改活动状态 不修改goods_common表的状态 Zhenzh 20171103
    $flag_update_increase = $increaseBaseModel->editIncrease($increase_id_row,$field_row_increase);
    if ($flag_update_increase && $increaseBaseModel->sql->commitDb())
    {

    }
    else
    {
        $increaseBaseModel->sql->rollBackDb();
    }
}

//3、限时折扣
$discountBaseModel = new Discount_BaseModel();
$cond_row_discount['discount_state'] = Discount_BaseModel::NORMAL;
$cond_row_discount['discount_end_time:<'] = get_date_time();//活动到期
$discount_id_row = $discountBaseModel->getKeyByWhere($cond_row_discount);
if($discount_id_row)
{
    $discountBaseModel->sql->startTransactionDb();//开启事务
    $field_row_discount['discount_state'] = Discount_BaseModel::END;
    //更新限时折扣活动状态，活动到期结束,同时修改goods_common表中对应字段common_promotion_type = 0 ;
    //$flag_update_discount = $discountBaseModel->changeDiscountStateUnnormal($discount_id_row, $field_row_discount);
    //此处更改为只修改活动状态 不修改goods_common表的状态 Zhenzh 20171103
    $flag_update_discount = $discountBaseModel->editDiscountActInfo($discount_id_row, $field_row_discount);
    if ($flag_update_discount && $discountBaseModel->sql->commitDb())
    {

    }
    else
    {
        $discountBaseModel->sql->rollBackDb();
    }
}

//4、满送
$manSongBaseModel  = new ManSong_BaseModel(); //满送
$cond_row_mansong['mansong_state'] = ManSong_BaseModel::NORMAL;
$cond_row_mansong['mansong_end_time:<'] = get_date_time();//活动到期
$mansong_id_row = $manSongBaseModel->getKeyByWhere($cond_row_mansong);
if($mansong_id_row)
{
    $field_row_mansong['mansong_state'] = ManSong_BaseModel::END;
    $manSongBaseModel->editManSong($mansong_id_row, $field_row_mansong);//更新满送活动状态，结束
}

//5、更新代金券模板状态
$voucherTempModel  = new Voucher_TempModel(); //代金券模板
$cond_row_voucher_temp['voucher_t_state'] = Voucher_TempModel::VALID;
$cond_row_voucher_temp['voucher_t_end_date:<'] =get_date_time();//代金券模板到期
$voucher_t_id_row = $voucherTempModel->getKeyByWhere($cond_row_voucher_temp);//查找出过期的代金券模板
if($voucher_t_id_row)
{
    $field_row_voucher_temp['voucher_t_state'] = Voucher_TempModel::INVALID;
    $voucherTempModel->editVoucherTemplate($voucher_t_id_row, $field_row_voucher_temp, false);//更新代金券模板状态，过期
}

//6、更新代金券状态
$voucherBaseModel  = new Voucher_BaseModel(); //代金券
$cond_row_voucher['voucher_state'] = Voucher_BaseModel::UNUSED;//代金券尚未使用
$cond_row_voucher['voucher_end_date:<'] = get_date_time();//代金券已经到期
$voucher_id_row = $voucherBaseModel->getKeyByWhere($cond_row_voucher);//查找出尚未使用，已经过期的代金券
if($voucher_id_row)
{
    $field_row_voucher['voucher_state'] = Voucher_BaseModel::EXPIRED;//更新代金券状态，过期
    $voucherBaseModel->editVoucher($voucher_id_row, $field_row_voucher);
}

return  true;
?>