<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class FeedCtl extends AdminController
{
    function index()
    {
        include $view = $this->view->getView();
    }
}

?>