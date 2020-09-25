<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author
 */
class Seller_GrCtl extends AdminController
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

	/*
	 * 2016-5-17
	 */

	public function index()
	{
	   include $this->view->getView();
	}
	public function manage()
	{
	   include $this->view->getView();
	}
	public function goods_money()
	{
	   include $this->view->getView();
	}
	
}

?>