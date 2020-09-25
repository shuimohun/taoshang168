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
//自动清理图片空间回收站

$uploadBaseModel  = new Upload_BaseModel();
$uploadAlbumModel = new Upload_AlbumModel();

//开启事物
$uploadBaseModel->sql->startTransactionDb();

$cond_row['is_recycle'] = Upload_BaseModel::RECYCLE;
$cond_row['recycle_time:<'] = strtotime("-1 week");
$upload_data = $uploadBaseModel->getByWhere($cond_row);
if($upload_data)
{
    foreach ($upload_data as $key=>$value)
    {
        $flag = $this->remove($value['upload_id']);
        //删除图片默认在相册减少一条记录

        if ($flag && $value['upload_type'] == 'image')
        {
            if($value['album_id'] != Upload_BaseModel::UPLOAD_IMAGE_UNGROUP)
            {
                $update_album['album_recycle_num'] = -1;
                $uploadAlbumModel->editAlbum($value['album_id'], $update_album, true);
            }

            $img_data = explode('image.php',$value['upload_path']);
            if(is_array($img_data))
            {
                $img_url = '.'. $img_data[1];
                if(file_exists($img_url))
                {
                    unlink($img_url);
                }
            }
        }
    }
}

if ($flag && $uploadBaseModel->sql->commitDb())
{
	$status = 200;
	$msg    = _('success');
}
else
{
    $uploadBaseModel->sql->rollBackDb();
	$m      = $uploadBaseModel->msg->getMessages();
	$msg    = $m ? $m[0] : _('failure');
	$status = 250;
}

return $flag;
?>