<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Base_SearchCtl extends AdminController
{
	function search()
	{
		include $view = $this->view->getView();;
	}

	function manage()
	{
		include $view = $this->view->getView();;
	}
}

?>