<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author
 */
class Seller_BusinessCtl extends AdminController
{
	/**
	 * 初始化方法，构造函数
	 *
	 * @access public
	 */
	public function init()
	{
		//include $this->view->getView();
		$this->baseRightsGroupModel = new Rights_GroupModel();
	}

	
	public function business()
	{
	   include $this->view->getView();
	}
	public function Industry(){
        include $this->view->getView();
    }
    public function  price(){
        include $this->view->getView();
    }
    public function  survey(){
        include $this->view->getView();
    }
}


?>