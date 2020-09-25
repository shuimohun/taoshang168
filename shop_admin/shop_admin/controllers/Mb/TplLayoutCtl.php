<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Mb_TplLayoutCtl extends AdminController
{
    public function __construct(&$ctl, $met, $typ)
    {
        parent::__construct($ctl, $met, $typ);
    }

    public function getEditPage()
    {
        $item_type = request_string('item_type');

        switch ($item_type)
        {
            case 'adv_list':
            case 'adv_list2':
                $this->view->setMet('advEdit');
                break;
            case 'home1':
                $this->view->setMet('home1Edit');
                break;
            case 'home2':
                $this->view->setMet('home2Edit');
                break;
            case 'home3':
            case 'home5':
                $this->view->setMet('home3Edit');
                break;
            case 'home4':
                $this->view->setMet('home4Edit');
                break;
            case 'goods':
                $this->view->setMet('goodsEdit');
                break;
            case 'shop':
                $this->view->setMet('shopEdit');
                break;
        }
        include $this->view->getView();
    }

    public function editImage()
    {
        include $this->view->getView();
    }

    public function wx ()
    {
        include $this->view->getView();
    }

    public function app ()
    {
        include $this->view->getView();
    }
}

?>