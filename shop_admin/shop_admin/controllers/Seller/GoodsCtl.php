<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author
 */
class Seller_GoodsCtl extends AdminController
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

	public function goods()
	{
	   include $this->view->getView();
	}
    public function hotgoods(){
        include $this->view->getView();
    }
    public function goods_sale(){
        include $this->view->getView();
    }
}

?>