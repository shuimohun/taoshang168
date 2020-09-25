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
//定时自动发布商品 已整理Zhenzh 20180410

$goodsCommonModel = new Goods_CommonModel();
$cond['common_state']       = Goods_CommonModel::GOODS_STATE_TIMING;
$cond['common_sell_time:<'] = get_date_time();
$common_id = $goodsCommonModel->getKeyByWhere($cond);

$update_data['common_state'] = Goods_CommonModel::GOODS_STATE_NORMAL;
$goodsCommonModel->editCommon($common_id, $update_data);

return true;
?>