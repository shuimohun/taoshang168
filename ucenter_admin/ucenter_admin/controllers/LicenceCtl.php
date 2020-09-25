<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     WenQingTeng
 */
class LicenceCtl extends AdminController
{
    public function index()
    {
        include $this->view->getView();
    }

}
?>