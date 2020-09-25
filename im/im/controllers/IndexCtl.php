<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     WenQingTeng
 */
class IndexCtl extends YLB_AppController
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