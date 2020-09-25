<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     WenQingTeng
 */
class Base_AppVersionCtl extends AdminController
{
	public function index()
	{
		include $this->view->getView();
	}
	
	public function main()
	{
		include $this->view->getView();
	}
}
?>