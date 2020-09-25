<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author
 */
class Seller_ShopCtl extends AdminController
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
    //新店铺
	public function shop()
	{
	   include $this->view->getView();
	}
    //热卖排行
    public function best_seller()
    {
        include $this->view->getView();
    }
    //销售统计
    public function sales_statistics()
    {
        include $this->view->getView();
    }
    //店铺等级
    public function Store_level()
    {
        include $this->view->getView();
    }
    //地区分布
    public function regional_distribution()
    {
        include $this->view->getView();
    }
}

?>