<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class User_AppCtl extends AdminController
{
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);
	}

	function index()
	{
		include $view = $this->view->getView();
	}
}

?>