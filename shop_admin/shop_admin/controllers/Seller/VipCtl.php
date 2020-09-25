<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author
 */
class Seller_VipCtl extends AdminController
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

    //新增会员
	public function vip()
	{
	   include $this->view->getView();
	}
	//会员分析
    public function vip_analysis()
    {
        include $this->view->getView();
    }
    //会员规模分析
    public function vip_scale()
    {
        include $this->view->getView();
    }
    //区域分析
    public function vip_area()
    {
        include $this->view->getView();
    }
    //购买分析
    public function vip_buy()
    {
        include $this->view->getView();
    }
	//会员详细
    public function vip_showmember()
    {
        include $this->view->getView();
    }
}

?>