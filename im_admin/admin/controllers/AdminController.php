<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class AdminController extends YLB_AppController
{
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);
	}

	/**
	 * 不要建议使用
	 *
	 * @param string $method 方法名称
	 * @param string $args 参数
	 * @return void
	 */
	public function __call($method, $args)
	{
		$view = $this->view->getView();;
		$ctl = $_REQUEST['ctl'];
		$met = $_REQUEST['met'];

		$data = $this->getUrl($ctl, $met);

		if (is_file($view))
		{
			include $view;
		}
	}


	/**
	 * 不要建议使用
	 *
	 * @param string $method 方法名称
	 * @param string $args 参数
	 * @return void
	 */
	public function getUrl($ctl, $met, $typ = 'json')
	{
		//本地读取远程信息
		$key = YLB_Registry::get('im_api_key');;
		$url         = YLB_Registry::get('im_api_url');
		$im_app_id = YLB_Registry::get('im_app_id');
		
		$formvars                  = $_POST;
		$formvars['app_id']        = $im_app_id;
		$formvars['admin_account'] = Perm::$row['user_account'];

		foreach ($_GET as $k => $item)
		{
			if ('ctl' != $k && 'met' != $k && 'typ' != $k && 'debug' != $k)
			{
				$formvars[$k] = $item;
			}
		}
		
		$init_rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_%s&met=%s&typ=json', $url, $ctl, $met), $formvars);
		$data = array();

		if (200 == $init_rs['status'])
		{
			//读取服务列表
			$data   = $init_rs['data'];
			$status = 200;
			$msg    = isset($init_rs['msg']) ? $init_rs['msg'] : _('sucess');
		}
		else
		{
			$status = 250;
			$msg    = isset($init_rs['msg']) ? $init_rs['msg'] : _('请求错误!');
		}

		{
			$this->data->addBody(-140, $data, $msg, $status);
		}

		return $data;
	}
}

?>