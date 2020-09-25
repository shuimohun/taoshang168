<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * Api接口, 让App等调用
 *
 *
 * @category   Game
 * @package    User
 * @author     charles
 * @copyright  Copyright (c) 2017, 温庆腾
 * @version    1.0
 * @todo
 */
class Seller_Controller extends YLB_AppController
{
	public static $menu 		= array();
	public static $current_menu = array();
	public static $left_menu	= array();
	
	public $sellerBaseModel 	= null;
	public $sellerGroupModel 	= null;

	public $user_info = null;
	public $shop_base = null;

	/**
	 * Constructor
	 *
	 * @param  string $ctl 控制器目录
	 * @param  string $met 控制器方法
	 * @param  string $typ 返回数据类型
	 * @access public
	 */
	public function __construct(&$ctl, $met, $typ)
	{
	    //共用数据
		parent::__construct($ctl, $met, $typ);

		//头部公用的平台基本配置
		$this->web = $this->webConfig();

		$this->title       = '';
		$this->description = '';
		$this->keyword     = '';

        //当前用户信息
        $this->user_info = $this->userInfo();

		//判断店铺是否开启，和是否需要续费。
        if ($this->ctl != 'Seller_Shop_SettledCtl' && $this->ctl != 'Seller_Supplier_SettledCtl')
        {
            $this->shop_base = $this->getShopInfo();

            if($this->shop_base)
            {
                $sellerBaseModel 	= new Seller_BaseModel();
                $sellerGroupModel 	= new Seller_GroupModel();

                $cond_row = array();
                $cond_row['shop_id'] = Perm::$shopId;
                $cond_row['user_id'] = Perm::$userId;
                $seller_info = $sellerBaseModel->getOneByWhere($cond_row);

                if($seller_info)
                {
                    $limits = '';
                    if($seller_info['seller_is_admin'] == 0)
                    {
                        $seller_group_info = $sellerGroupModel->getSellerGroupInfoByID($seller_info['seller_group_id']);
                        $limits = @$seller_group_info['limits'];
                    }

                    $seller_menu = $this->getSellerMenuList($seller_info['seller_is_admin'], explode(',', $limits));

                    self::$menu  = $seller_menu['seller_menu'];
                    self::$current_menu = $this->getCurrentMenu($seller_menu['seller_function_list']);

                    if(request_string('ctl') != 'Seller_Index')
                    {
                        @self::$left_menu = $seller_menu['seller_menu'][self::$current_menu['model']]['sub'];
                    }

                    if ($seller_info['seller_is_admin'] != 1 && request_string('ctl') !== 'Seller_Index')
                    {
                        if (!in_array(request_string('ctl'), explode(',', $limits)))
                        {
                            location_to(YLB_Registry::get('url') . "?ctl=Seller_Index&met=index&typ=e");
                        }
                    }
                }
                else
                {
                    header("Location:" . YLB_Registry::get('url') . "?ctl=Seller_Shop_Settled&met=index&op=step1");
                }
            }
            else
            {
                header("Location:" . YLB_Registry::get('url') . "?ctl=Seller_Shop_Settled&met=index&op=step1");
            }
        }
    }

	//默认设置
	public function webConfig()
	{
		$web['web_logo']       = Web_ConfigModel::value("setting_logo");//首页logo
		$web['web_name']       = Web_ConfigModel::value("site_name");//首页名称
		$web['buyer_logo']     = Web_ConfigModel::value("setting_buyer_logo");//会员中心logo
		$web['seller_logo']    = Web_ConfigModel::value("setting_seller_logo");//卖家中心logo
		$web['goods_image']    = Web_ConfigModel::value("photo_goods_logo");//商品图片
		$web['shop_head_logo'] = Web_ConfigModel::value("photo_shop_head_logo");//店铺头像
		$web['shop_logo']      = Web_ConfigModel::value("photo_shop_logo");//店铺标志
		$web['user_logo']      = Web_ConfigModel::value("photo_user_logo");//默认头像
		
		//金蛋获取的默认设置
		$web['points_reg']      = Web_ConfigModel::value("points_reg");//注册获取金蛋
		$web['points_login']    = Web_ConfigModel::value("points_login");//登陆获取金蛋
		$web['points_evaluate'] = Web_ConfigModel::value("points_evaluate");//评论获取金蛋
		$web['points_recharge'] = Web_ConfigModel::value("points_recharge");//订单每多少获取多少金蛋
		$web['points_order']    = Web_ConfigModel::value("points_order");//订单每多少获取多少金蛋
		
		return $web;
	}

	public function userInfo()
	{
		if (Perm::checkUserPerm())
		{
			$user_id       = Perm::$userId;
			$userInfoModel = new User_InfoModel();
			$data          = $userInfoModel->getOne($user_id);

			//系统消息
			$this->messageModel           = new MessageModel();
			$order_row                    = array();
			$order_row['message_user_id'] = $user_id;
			$order_row['message_islook']  = 0;
			$order_row['message_mold']    = 1;
			
			$this->Message   = $this->messageModel->getCount($order_row);
			$data['message'] = $this->Message;
		}
		else
		{
			$data = array();
		}
		return $data;
	}

	public function getShopInfo()
	{
		if (Perm::checkUserPerm())
		{
            if(Perm::$shopId)
            {
                $ShopBaseModel = new Shop_BaseModel();
                $shop_base     = $ShopBaseModel->getOne(Perm::$shopId);

                //是否到期关闭
                if($shop_base['shop_end_time'] < get_date_time())
                {
                    $shop_base['shop_expire'] = 1;
                    $shop_base['shop_close_reason'] = '店铺到期 ' . $shop_base['shop_close_reason'];
                }

                //是否快到期提醒
                if(!$this->shop_base['shop_self_support'])
                {
                    $day = (strtotime(date("Y-m-d", strtotime($shop_base['shop_end_time']))) - strtotime(date("Y-m-d", time()))) / 86400;

                    if($day >= 0 && $day <= 30)
                    {
                        $shop_base['expire_warn_day'] = $day;
                    }
                }

                if ($shop_base['shop_status'] == 0 || $shop_base['shop_status'] == 3)
                {
                    return $shop_base;
                }
                else if($shop_base['shop_status'] == 1 || $shop_base['shop_status'] == 2)
                {
                    header("Location:" . YLB_Registry::get('url') . "?ctl=Seller_Shop_Settled&met=index&op=step1");
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
     * 获取卖家菜单列表
     * 管理员账户和卖家子账号权限不同，显示的功能菜单也不同
     *
     * @param $is_admin 是否为管理员账号 1-是 2-不是
     * @param $limits   卖家账号权限限制
     * @return array
     */
	protected function getSellerMenuList($is_admin, $limits)
	{
		$seller_menu = array();
		if (intval($is_admin) !== 1)
		{
			$menu_list = $this->getMenuList();
			foreach ($menu_list as $key => $value)
			{
				foreach ($value['sub'] as $child_key => $child_value)
				{
					if (!in_array($child_value['ctl'], $limits))
					{
						unset($menu_list[$key]['sub'][$child_key]);
					}
				}

				if(count($menu_list[$key]['sub']) > 0)
				{
					$seller_menu[$key] = $menu_list[$key];
				}
			}
		}
		else
		{
			$seller_menu = $this->getMenuList();
		}
		$seller_function_list = $this->getSellerFunctionList($seller_menu);
		return array('seller_menu' => $seller_menu, 'seller_function_list' => $seller_function_list);
	}

	private function getCurrentMenu($seller_function_list)
	{
		$current_menu = isset($seller_function_list[request_string('ctl')])?$seller_function_list[request_string('ctl')]:array();
		if(empty($current_menu))
		{
			$current_menu = array(
				'model' => 'index',
				'model_name' => '首页'
			);
		}
		return $current_menu;
	}

	//获取商家中心菜单栏
	//卖家中心菜单在该处设置
	private function getMenuList()
	{
		$menu_list = array(
			'goods' => array('name' => '商品', 'sub' => array(
				array('name' => '出售中的商品', 'ctl'=>'Seller_Goods', 'met'=>'online'),
				array('name' => '商品发布', 'ctl'=>'Seller_Goods', 'met'=>'add'),
				array('name' => '仓库中的商品', 'ctl'=>'Seller_Goods', 'met'=>'offline'),
				array('name' => '淘金商品', 'ctl'=>'Seller_Supplier_Goods', 'met'=>'online'),
				array('name' => '关联版式', 'ctl'=>'Seller_Goods', 'met'=>'format'),
				array('name' => '商品规格', 'ctl' => 'Seller_Goods_Spec', 'met' => 'spec'),
				array('name' => '图片空间', 'ctl'=>'Seller_Album', 'met'=>'index'),
				array('name' => '淘宝导入', 'ctl'=>'Seller_Goods_TBImport', 'met'=>'importFile'),
			)),
			'order' => array('name' => '订单物流', 'sub' => array(
				array('name' => '已售订单管理', 'ctl'=>'Seller_Trade_Order', 'met'=>'physical'),
				array('name' => '虚拟兑码订单', 'ctl'=>'Seller_Trade_Order', 'met'=>'virtual'),
				array('name' => '门店自提订单', 'ctl'=>'Seller_Trade_Order', 'met'=>'chain'),
				array('name' => '发货', 'ctl'=>'Seller_Trade_Deliver', 'met'=>'deliver'),
				array('name' => '发货设置', 'ctl'=>'Seller_Trade_Deliver', 'met'=>'deliverSetting'),
				array('name' => '运单模板', 'ctl'=>'Seller_Trade_Waybill', 'met'=>'waybillManage'),
				array('name' => '评价管理', 'ctl'=>'Seller_Goods_Evaluation', 'met'=>'evaluation'),
				array('name' => '物流工具', 'ctl'=>'Seller_Transport', 'met'=>'transport'),
                array('name' => '分享推广', 'ctl'=>'Seller_Goods_Share', 'met'=>'share'),
                array('name' => '送福免单', 'ctl'=>'Seller_Goods_Fu', 'met'=>'index'),
			)),
			'promotion' => array('name' => '促销', 'sub' => array(
                array('name' => '惠抢购管理', 'ctl'=>'Seller_Promotion_ScareBuy', 'met'=>'index'),
				array('name' => '加价购', 'ctl'=>'Seller_Promotion_Increase', 'met'=>'index'),
				array('name' => '限时折扣', 'ctl'=>'Seller_Promotion_Discount', 'met'=>'index'),
                array('name' => '手机专享', 'ctl'=>'Seller_Promotion_Price', 'met'=>'index'),
				array('name' => '满即送', 'ctl'=>'Seller_Promotion_MeetConditionGift', 'met'=>'index'),
				array('name' => '代金券管理', 'ctl'=>'Seller_Promotion_Voucher', 'met'=>'index'),
                array('name' => '优惠套装', 'ctl'=>'Seller_Promotion_Bundling', 'met'=>'index'),
                array('name' => '新人优惠', 'ctl'=>'Seller_Promotion_NewBuyer', 'met'=>'index'),
                array('name' => '送福免单', 'ctl'=>'Seller_Promotion_Fu', 'met'=>'index'),
                array('name' => '早/晚市', 'ctl'=>'Seller_Promotion_MonLater', 'met'=>'index'),
			)),
			'distribution' => array('name' => '淘金', 'sub' => array(
				array('name' => '淘金设置', 'ctl'=>'Distribution_Seller_Setting', 'met'=>'index'),
			)),
			'shop' => array('name' => '店铺', 'sub' => array(
				array('name' => '店铺设置', 'ctl'=>'Seller_Shop_Setshop', 'met'=>'index'),
				array('name' => '店铺导航', 'ctl'=>'Seller_Shop_Nav', 'met'=>'nav'),
				array('name' => '供货商', 'ctl'=>'Seller_Shop_Supplier', 'met'=>'supplier'),
				array('name' => '店铺分类', 'ctl'=>'Seller_Shop_Cat', 'met'=>'cat'),
				array('name' => '实体店铺', 'ctl'=>'Seller_Shop_Entityshop', 'met'=>'entityShop'),
				array('name' => '品牌申请', 'ctl'=>'Seller_Shop_Brand', 'met'=>'brand'),
				array('name' => '店铺信息', 'ctl'=>'Seller_Shop_Info', 'met'=>'info'),
				array('name' => '消费者保障服务', 'ctl'=>'Seller_Shop_Contract', 'met'=>'index'),
				array('name' => '门店帐号', 'ctl'=>'Seller_Shop_Chain', 'met'=>'chain'),
				array('name' => '我的供应商', 'ctl'=>'Seller_Supplier_Supplier', 'met'=>'index'),
				array('name' => '淘金明细', 'ctl'=>'Seller_Supplier_DistLog', 'met'=>'chain'),
				array('name' => '我的分销商', 'ctl'=>'Seller_Supplier_Distributor', 'met'=>'chain'),
			)),
			'consult' => array('name' => '售后服务', 'sub' => array(
				array('name' => '咨询管理', 'ctl'=>'Seller_Service_Consult', 'met'=>'index'),
				array('name' => '投诉管理', 'ctl'=>'Seller_Service_Complain', 'met'=>'index'),
				array('name' => '退款记录', 'ctl'=>'Seller_Service_Return', 'met'=>'orderReturn'),
				array('name' => '退货记录', 'ctl'=>'Seller_Service_Return', 'met'=>'goodsReturn'),
			)),
			'statistics' => array('name' => '统计结算', 'sub' => array(
				array('name' => '店铺概况', 'ctl'=>'Seller_Analysis_General', 'met'=>'index'),
				array('name' => '商品分析', 'ctl'=>'Seller_Analysis_Goods', 'met'=>'index'),
				array('name' => '运营报告', 'ctl'=>'Seller_Analysis_Operation', 'met'=>'index'),
				array('name' => '实物结算', 'ctl'=>'Seller_Order_Settlement', 'met'=>'normal'),
				array('name' => '虚拟结算', 'ctl'=>'Seller_Order_Settlement', 'met'=>'virtual'),
			)),
			'message' => array('name' => '客服消息', 'sub' => array(
				array('name' => '客服设置', 'ctl'=>'Seller_Message', 'met'=>'index'),
				array('name' => '系统消息', 'ctl'=>'Seller_Message', 'met'=>'message'),
			)),
			'account' => array('name' => '账号', 'sub' => array(
				array('name' => '账号列表', 'ctl'=>'Seller_Seller_Account', 'met'=>'accountList'),
				array('name' => '账号组', 'ctl'=>'Seller_Seller_Group', 'met'=>'groupList'),
				array('name' => '账号日志', 'ctl'=>'Seller_Seller_Log', 'met'=>'logList')
			))
		);
		
		if(!Web_ConfigModel::value('Plugin_Directseller')||@$this->shop_base['shop_type'] == 2)
		{
			unset($menu_list['distribution']);
		}
		
		return $menu_list;
	}

	private function getSellerFunctionList($menu_list) {
		$format_menu = array();
		foreach ($menu_list as $key => $menu_value) {
			foreach ($menu_value['sub'] as $submenu_value) {
				$format_menu[$submenu_value['ctl']] = array(
					'model' => $key,
					'model_name' => $menu_value['name'],
					'name' => $submenu_value['name'],
					'ctl' => $submenu_value['ctl'],
					'met' => $submenu_value['met'],
				);
			}
		}
		return $format_menu;
	} 

}

?>