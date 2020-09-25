<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * 生意参谋
 * @author  Zhenzh
 */
class Seller_SycmCtl extends Seller_Controller
{
	/**
	 * @param  string $ctl 控制器目录
	 * @param  string $met 控制器方法
	 * @param  string $typ 返回数据类型
	 * @access public
	 */
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);
        parent::$current_menu = 'sycm';
    }

	/**
	 * 首页
	 */
	public function index()
	{
		//判断是否登录，没登录登录页去
		if (Perm::checkUserPerm())
		{
			$shop['shop_id'] = Perm::$shopId;
			if ($shop['shop_id'])
			{
			    $data = array();
				if ($this->typ == 'json')
				{
					$this->data->addBody(-140, $data);
				}
				else
				{
					include $this->view->getView();
				}
			}
			else
			{
				header("Location:" . YLB_Registry::get('url') . "?ctl=Seller_Shop_Settled&met=index");
			}
		}
		else
		{
			header("Location:" . YLB_Registry::get('url'), "请先登录！");
		}
	}

    /**
     * 实时
     */
    public function realTime()
    {
        //判断是否登录，没登录登录页去
        if (Perm::checkUserPerm())
        {
            $shop['shop_id'] = Perm::$shopId;
            if ($shop['shop_id'])
            {
                $data = array();
                if ($this->typ == 'json')
                {
                    $this->data->addBody(-140, $data);
                }
                else
                {
                    include $this->view->getView();
                }
            }
            else
            {
                header("Location:" . YLB_Registry::get('url') . "?ctl=Seller_Shop_Settled&met=index");
            }
        }
        else
        {
            header("Location:" . YLB_Registry::get('url'), "请先登录！");
        }
    }

    /**
     * 作战室
     */
    public function warRoom()
    {
        //判断是否登录，没登录登录页去
        if (Perm::checkUserPerm())
        {
            $shop['shop_id'] = Perm::$shopId;
            if ($shop['shop_id'])
            {
                $data = array();
                if ($this->typ == 'json')
                {
                    $this->data->addBody(-140, $data);
                }
                else
                {
                    include $this->view->getView();
                }
            }
            else
            {
                header("Location:" . YLB_Registry::get('url') . "?ctl=Seller_Shop_Settled&met=index");
            }
        }
        else
        {
            header("Location:" . YLB_Registry::get('url'), "请先登录！");
        }
    }

    /**
     * 作战室
     */
    public function flow()
    {
        //判断是否登录，没登录登录页去
        if (Perm::checkUserPerm())
        {
            $shop['shop_id'] = Perm::$shopId;
            if ($shop['shop_id'])
            {
                $data = array();
                if ($this->typ == 'json')
                {
                    $this->data->addBody(-140, $data);
                }
                else
                {
                    include $this->view->getView();
                }
            }
            else
            {
                header("Location:" . YLB_Registry::get('url') . "?ctl=Seller_Shop_Settled&met=index");
            }
        }
        else
        {
            header("Location:" . YLB_Registry::get('url'), "请先登录！");
        }
    }
}

?>