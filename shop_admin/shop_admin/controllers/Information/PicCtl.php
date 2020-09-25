<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Information_PicCtl extends AdminController
{
    public function __construct(&$ctl, $met, $typ)
    {
        parent::__construct($ctl, $met, $typ);
    }

    public function index()
    {
        /*$photo_left_logo = Web_ConfigModel::value('photo_left_logo');
        var_dump($photo_left_logo);die;*/
        include $view = $this->view->getView();;
    }

}

?>