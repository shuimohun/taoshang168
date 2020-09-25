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

fb($crontab_file);
//执行任务
$shopBaseModel    = new Shop_BaseModel();
$shop_base = $shopBaseModel->getByWhere();
foreach ($shop_base as $key => $value) {
      $shop_end_time = date("Y-m-d H:i:s", strtotime("$value[shop_end_time] - 1 month"));
      $time       = date("Y-m-d h:i:s", time());
       if($shop_end_time <= $time){
            $message = new MessageModel();
            $message->sendMessage('Settlement bill has been paid to remind',$value['user_id'], $value['user_name'], $order_id = NULL, $shop_name = NULL, 1, 1);
         }
      
}

return true;
?>