<?php

//用户登录认证
class Plugin_Perm implements YLB_Plugin_Interface
{
    //解析函数的参数是pluginManager的引用
    function __construct()
    {
        //注册这个插件
        //第一个参数是钩子的名称
        //第二个参数是pluginManager的引用
        //第三个是插件所执行的方法
        YLB_Plugin_Manager::getInstance()->register('perm', $this, 'checkPerm');
        YLB_Plugin_Manager::getInstance()->register('server_state', $this, 'checkServerState');
    }

    public static function desc()
    {
        echo 'Hello World';
    }

    public function checkPerm()
    {
        $data = new YLB_Data();

		//无需权限判断的文件
		$not_perm = array('Login','Api','Upload');

		//不需要登录
		if (!isset($_REQUEST['ctl']) || (isset($_REQUEST['ctl']) && in_array($_REQUEST['ctl'], $not_perm)))
		{
			//
		}
        elseif (Perm::checkUserPerm())
        {
//			if (!Perm::checkUserRights())
//			{
//				//无权限
//				fb($_REQUEST, '-2:无访问权限', FirePHP::ERROR);
//				$data->setError(_('无访问权限'));
//				return $this->outputError($data);
//			}
        }
        else
        {

            location_to(YLB_Registry::get('url') . '?ctl=Login');
			//$data->setError(_('需要登录'), 30);
            //return $this->outputError($data);
        }
    }

    public function outputError($data)
    {
        $d = $data->getDataRows();

        $protocol_data = YLB_Data::encodeProtocolData($d);
        echo $protocol_data;

        exit();
    }
}