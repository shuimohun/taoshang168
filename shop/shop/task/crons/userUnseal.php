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
//禁言/封号用户到期自动解禁/解封 Zhenzh 20180802

$UserInfoModel = new User_InfoModel();
$cond['user_punish_type:>'] = 0;
$cond['user_punish_times:<'] = 4; //4永久封号 不解封
$cond['user_punish_end_time:<'] = time();
$cond['user_punish_end_time:>'] = 0;
$user_id = $UserInfoModel->getKeyByWhere($cond);

$update_data['user_punish_type'] = 0;
$UserInfoModel->editInfo($user_id, $update_data);

return true;
?>