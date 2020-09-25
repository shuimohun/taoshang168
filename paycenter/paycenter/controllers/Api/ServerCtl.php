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
class Api_ServerCtl extends Api_Controller
{
	public function create()
	{
		$Db = YLB_Db::get('root_rights');

		$app_id    = request_int('app_id');
		$server_id = request_int('server_id');

		$db_name = 'paycenter_' . $server_id;
		$db_user = 'uc_' . $server_id;

		$user_name     = request_string('user_name');
		$user_mobile   = request_string('company_phone');
		$plantform_url = request_string('paycenter_url');

		$shop_url = request_string('plantform_url');
		$paycenter_url = request_string('paycenter_url');
		$ucenter_url   = request_string('ucenter_url');


		//ucenter
		$ucenter_url_row = parse_url($ucenter_url);
		$ucenter_config_contents = <<<EOF
<?php
\$ucenter_api_key = "aaaaaabbb";
\$ucenter_api_url = "{$ucenter_url}";
\$ucenter_app_id = 104;
\$ucenter_wap_url = "http://m.{$ucenter_url_row['host']}/";
?>
EOF;

		$paycenter_url_row = parse_url($paycenter_url);
		$paycenter_config_contents = <<<EOF
<?php
\$paycenter_api_key = "HANZaFR0Aw08PV1U20RzCW411UWXa26AUiIO";
\$paycenter_api_url = "{$paycenter_url}";
\$paycenter_app_id = 105;
\$paycenter_wap_url = "http://m.{$paycenter_url_row['host']}/";
?>
EOF;

		$shop_url_row = parse_url($shop_url);
		$shop_config_contents = <<<EOF
<?php
\$shop_api_key = "aaaaaabbb";
\$shop_api_url = "{$shop_url}";
\$shop_app_id = 103;
\$shop_wap_url = "http://m.{$shop_url_row['host']}/";
?>
EOF;


		if (!$plantform_url)
		{
			$this->data->setError('站点域名配置错误');
		}
		else
		{

			//根据域名,设置云版server_id  = md5(domain)
			$url_row = parse_url($plantform_url);

			//写入配置文件
			$db_config_file = INI_PATH . '/db_' . md5($url_row['host']) . '.ini.php';

			if (is_file($db_config_file))
			{
				$this->data->setError('站点域名已经开通1!');
				return;
			}

			$config = YLB_Registry::get('db_cfg');

			$db_host   = $config['db_cfg_rows']['master']['root_rights'][0]['host']; // 数据库IP
			$db_passwd = request_string('db_passwd');

			if (!$db_host || !$db_passwd || !$app_id || !$server_id)
			{
				$this->data->setError('参数错误');
			}
			else
			{
				$rs_row = array();

				$flag = $Db->exec('USE `mysql`');
				array_push($rs_row, false !== $flag);

				//判断数据库是否存在
				$check_db_sql  = "SELECT * FROM information_schema.SCHEMATA where SCHEMA_NAME='{$db_name}'";
				$check_db_rows = $Db->getAll($check_db_sql);
				fb($check_db_rows);

				if (!$check_db_rows)
				{
					$Db->startTransaction();

					//创建数据库
					$create_db_sql = 'CREATE DATABASE `' . $db_name . '` CHARACTER SET utf8 COLLATE utf8_general_ci';
					$flag          = $Db->exec($create_db_sql);
					array_push($rs_row, false !== $flag);


					//用户是否存在
					$check_user_sql  = "SELECT user,host  FROM user WHERE user='{$db_user}'";
					$check_user_rows = $Db->getAll($check_user_sql);
					fb($check_user_rows);

					if (!$check_user_rows)
					{
						$create_user_sql = "GRANT USAGE ON *.* TO '{$db_user}'@'%' IDENTIFIED BY '{$db_passwd}' WITH MAX_QUERIES_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0";
						$flag            = $Db->exec($create_user_sql);
						array_push($rs_row, false !== $flag);
					}

					//赋权限
					$create_pri_sql = "GRANT Create Routine, Insert, Lock Tables, References, Select, Drop, Delete, Index, Alter Routine, Create View, Create Temporary Tables, Show View, Trigger, Event, Create, Update, Execute, Grant Option, Alter ON `{$db_name}`.* TO `{$db_user}`@`%`";
					$flag           = $Db->exec($create_pri_sql);
					array_push($rs_row, false !== $flag);
					
					//$user_name  为管理员权限

					//初始化数据
					$flag = $Db->exec("USE `{$db_name}`;");
					array_push($rs_row, false !== $flag);

					//
					$db = new YLB_Utils_DbManage ($Db);

					$sql_path =  './install/data/sql/';

					$dir = scandir($sql_path);
					
					foreach ($dir as $item)
					{
						$file = $sql_path . DIRECTORY_SEPARATOR . $item;

						if (is_file($file))
						{
							$flag = $db->import($file, TABEL_PREFIX, 'pay_', false);
							check_rs($flag, $rs_row);
						}
					}

					YLB_Log::log($rs_row, YLB_Log::INFO, 'create_db');

					//
					$sql_path =  ROOT_PATH . '/../paycenter_admin/install/data/sql/';

					$dir = scandir($sql_path);

					foreach ($dir as $item)
					{
						$file = $sql_path . DIRECTORY_SEPARATOR . $item;

						if (is_file($file))
						{
							$flag = $db->import($file, 'pay_admin_', 'pay_admin_', false);
							check_rs($flag, $rs_row);
						}
					}

					YLB_Log::log($rs_row, YLB_Log::INFO, 'create_db_admin');

					//开通后台,执行sql, 放入同一个db中, 然后调用,生成配置文件

					if (is_ok($rs_row) && $Db->commit())
					{
						//根据域名,设置云版server_id  = md5(domain)
						$url_row   = parse_url($plantform_url);
						$server_id = md5($url_row['host']);

						//写入配置文件
						$db_config_file            = INI_PATH . '/db_' . $server_id . '.ini.php';
						$db_config_row             = array();
						$db_config_row['host']     = $db_host;
						$db_config_row['port']     = 3306;
						$db_config_row['user']     = $db_user;
						$db_config_row['password'] = $db_passwd;
						$db_config_row['database'] = $db_name;
						$db_config_row['charset']  = 'UTF8';

						$db_config_contents = "<?php\n	define(\"TABEL_PREFIX\", \"pay_\"); //表前缀;\n return ";
						$db_config_contents .= var_export($db_config_row, true);
						$db_config_contents .= ";\n?>";

						file_put_contents($db_config_file, $db_config_contents);


						$server_config_file       = INI_PATH . '/server_' . $server_id . '.ini.php';
						$server_config_row        = array();
						$server_config_row['url'] = $plantform_url;


						$db_config_contents = "<?php\n	return ";
						$db_config_contents .= var_export($server_config_row, true);
						$db_config_contents .= ";\n?>";

						file_put_contents($server_config_file, $db_config_contents);

						//ucenter
						$ucenter_config_file = INI_PATH . '/ucenter_api_' . $server_id . '.ini.php';
						file_put_contents($ucenter_config_file, $ucenter_config_contents);

						//paycenter
						$paycenter_config_file = INI_PATH . '/paycenter_api_' . $server_id . '.ini.php';
						file_put_contents($paycenter_config_file, $paycenter_config_contents);

						//shop
						$shop_config_file = INI_PATH . '/shop_api_' . $server_id . '.ini.php';
						file_put_contents($shop_config_file, $shop_config_contents);


						//指到admin

						//根据域名,设置云版server_id  = md5(domain)
						$url_row   = parse_url($plantform_url);
						$server_id = md5('admin.' . $url_row['host']);

						//写入配置文件
						$db_config_file            = ROOT_PATH . '/../paycenter_admin/admin/configs/db_' . $server_id . '.ini.php';
						$db_config_row             = array();
						$db_config_row['host']     = $db_host;
						$db_config_row['port']     = 3306;
						$db_config_row['user']     = $db_user;
						$db_config_row['password'] = $db_passwd;
						$db_config_row['database'] = $db_name;
						$db_config_row['charset']  = 'UTF8';

						$db_config_contents = "<?php\n	define(\"TABEL_PREFIX\", \"pay_admin_\"); //表前缀;\n return ";
						$db_config_contents .= var_export($db_config_row, true);
						$db_config_contents .= ";\n?>";

						file_put_contents($db_config_file, $db_config_contents);


						//ucenter
						$ucenter_config_file = ROOT_PATH . '/../paycenter_admin/admin/configs/ucenter_api_' . $server_id . '.ini.php';
						file_put_contents($ucenter_config_file, $ucenter_config_contents);

						//paycenter
						$paycenter_config_file = ROOT_PATH . '/../paycenter_admin/admin/configs/paycenter_api_' . $server_id . '.ini.php';
						file_put_contents($paycenter_config_file, $paycenter_config_contents);

						//shop
						$shop_config_file = ROOT_PATH . '/../paycenter_admin/admin/configs/shop_api_' . $server_id . '.ini.php';
						file_put_contents($shop_config_file, $shop_config_contents);



						$this->data->addBody(100, $db_config_row);
					}
					else
					{
						$Db->rollBack();

						$msg    = '初始化失败';
						$status = 250;
						$this->data->addBody(100, array(), $msg, $status);
					}
				}
				else
				{
					$msg = '对应的数据库信息已经存在';

					$status = 250;
					$this->data->addBody(100, array(), $msg, $status);
				}
			}

		}

	}

}

?>