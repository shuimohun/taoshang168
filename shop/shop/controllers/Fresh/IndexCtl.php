<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     Zhenzh
 */
class Fresh_IndexCtl extends Controller
{
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);
	}

	public function index()
    {
        if ('json' == $this->typ) {
            $data = array();
            $this->data->addBody(-140, $data);
        } else {
            $Cache = YLB_Cache::create('fresh_index');

            $site_index_key = sprintf('%s|%s|', YLB_Registry::get('server_id'), 'fresh_index');
            $Cache->remove($site_index_key);

            if (!$Cache->start($site_index_key)) {
                $this->site_id = -3;
                $this->initData();
                //根据条件获取Api_App_Fresh的数据
                $key = YLB_Registry::get('shop_api_key');
                $url = YLB_Registry::get('shop_api_url');
                $shop_app_id = YLB_Registry::get('shop_app_id');
                $formvars = array();
                $formvars['app_id'] = $shop_app_id;
                $formvars['from_app_id'] = YLB_Registry::get('shop_app_id');
                $slider = get_url_with_encrypt($key, sprintf('%s?ctl=Api_App_Fresh&met=getSliderGoods&typ=json&type=web', $url), $formvars);
                //获取分类
                $cat = $slider['data']['cat'];
                //获取礼盒
                $gift = $slider['data']['gift'];
                //获取当天时间
                $now = date('Y-m-d', time());
                //根据当天时间计算
                $mor = strtotime($now) + 10 * 3600;

                $nig = strtotime($now) + 17 * 3600;
                $now_i = strtotime($now);
                $now_t = strtotime($now) + 24 * 3600;
                $mor_t = $now_t + 10 * 3600;
                $nig_date = date('Y-m-d H:i:s', $nig);
                $mor_date = date('Y-m-d H:i:s', $mor);
                $mor_t_date = date('Y-m-d H:i:s', $mor_t);

                //获取早市晚市的Model
                $man = array();
                $MonLaterGoodsModel = new MonLater_GoodsModel();
                $MonLaterBaseModel = new MonLater_BaseModel();
                $is_MonLater = $MonLaterBaseModel->getByWhere(array('monlater_state' => $MonLaterBaseModel::MONLATER_BASE_OPEN));

                $mor_goods = $MonLaterGoodsModel->listByWhere(array('monlater_goods_state' => 1, 'monlater_type' => 1), array('common_salenum' => 'DESC'), 1, 20);
                $nig_goods = $MonLaterGoodsModel->listByWhere(array('monlater_goods_state' => 1, 'monlater_type' => 2), array('common_salenum' => 'DESC'), 1, 20);

                //楼层设置
                $Adv_PageSettingsModel = new Adv_PageSettingsModel();
                $cond_adv_row = array("page_status" => 1, 'sub_site_id' => Adv_PageSettingsModel::FRSH);
                $order_adv_row = array("page_order" => "asc");
                $adv_list = $Adv_PageSettingsModel->listByWhere($cond_adv_row, $order_adv_row);
                //首页标题关键字
                $subsite_is_open = Web_ConfigModel::value("subsite_is_open");
                if (!empty($_COOKIE['sub_site_id']) && $subsite_is_open == Sub_SiteModel::SUB_SITE_IS_OPEN) {
                    //首页标题关键字
                    $Sub_Site = new Sub_Site();
                    $sub_site_info = $Sub_Site->getSubSite($_COOKIE['sub_site_id']);
                    $title = $sub_site_info[$_COOKIE['sub_site_id']]['sub_site_web_title'];//首页名;
                    $this->keyword = $sub_site_info[$_COOKIE['sub_site_id']]['sub_site_web_keyword'];//关键字;
                    $this->description = $sub_site_info[$_COOKIE['sub_site_id']]['sub_site_web_des'];//描述;
                    $this->title = str_replace("{sitename}", $this->web['web_name'], $title);
                    $this->keyword = str_replace("{sitename}", $this->web['web_name'], $this->keyword);
                    $this->description = str_replace("{sitename}", $this->web['web_name'], $this->description);
                } else {
                    $title = Web_ConfigModel::value("sx_title");//首页名;
                    $this->keyword = Web_ConfigModel::value("sx_keyword");//关键字;
                    $this->description = Web_ConfigModel::value("sx_description");//描述;
                    $this->title = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $title);
                    $this->keyword = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->keyword);
                    $this->description = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->description);
                }

                include $this->view->getView();

                $Cache->_id = $site_index_key;
                $Cache->end($site_index_key);

            }
        }
    }

	public function getUserLoginInfo()
	{
		$data = array();
		if (Perm::checkUserPerm())
		{
			$user_id       = Perm::$userId;
			$userInfoModel = new User_InfoModel();
			$this->userInfo          = $userInfoModel->getOne($user_id);
            fb($this->userInfo);
		}

		include $this->view->getView();

		if (Perm::checkUserPerm())
		{
			$data[3] = true;
		}
		else
		{
			$data[3] = false;
		}
		$this->data->addBody(-140, $data);

	}

	public function getSearchWords()
	{
		$search_words              = explode(',', Web_ConfigModel::value('search_words'));
		$data['hot_info']["name"]  = $search_words[0];
		$data['hot_info']["value"] = $search_words[0];

		$this->data->addBody(-140, $data);
	}

	public function getSearchKeyList()
	{
		$search_words     = explode(',', Web_ConfigModel::value('search_words'));
		$data['list']     = $search_words;
		$data['his_list'] = array($search_words[1]);

		$this->data->addBody(-140, $data);
	}


	public function test()
	{
		include $this->view->getView();
	}

	//获取侧边栏的信息
	public function toolbar()
	{
		$this->initData();
		//$this->user_info = $this->userInfo();

		//公告

		$this->articleBaseModel = new Article_BaseModel();

		$Announcement_row['article_type']   = 1;
		$Announcement_row['article_status'] = 1;

		$Announcement = $this->articleBaseModel->getBaseAllList($Announcement_row, array('article_add_time' => 'DESC'), 1, 20);

		//用户登录情况下获取信息
		if (Perm::checkUserPerm())
		{
			$user_id = Perm::$userId;

			$cord_row = array();
			$cond_row = array('user_id' => $user_id);

			$userResourceModel = new User_ResourceModel();

			$user_list = $userResourceModel->getUserResource($cond_row);

		}

		//用户登录情况下获取购物车信息
		if (Perm::checkUserPerm())
		{
			$user_id = Perm::$userId;

			$cord_row  = array();
			$order_row = array();

			$cond_row  = array('user_id' => $user_id);
			$CartModel = new CartModel();
			$cart_list = $CartModel->getCardList($cond_row, $order_row);
		}
		//用户登录情况下获取关注店铺信息
		if (Perm::checkUserPerm())
		{
			$user_id = Perm::$userId;

			$userFavoritesShopModel = new User_FavoritesShopModel();
			$goodsCommonModel       = new Goods_CommonModel();

			$shop_list = $userFavoritesShopModel->getFavoritesShopDetail($user_id, 1, 4);

			if ($shop_list['items'])
			{
				foreach ($shop_list['items'] as $key => $val)
				{

					$cond_row            = array();
					$cond_row['shop_id'] = $val['shop_id'];
					$goods               = $goodsCommonModel->getGoodsList($cond_row, array(), 1, 2);

					if ($goods)
					{
						$shop_list['items'][$key]['detail'] = $goods;
					}

				}
			}

		}

		//用户登录情况下获取收藏商品信息
		if (Perm::checkUserPerm())
		{
			$user_id = Perm::$userId;

			$userFavoritesGoodsModel = new User_FavoritesGoodsModel();

			$favorites_row['user_id'] = $user_id;

			$goods_list = $userFavoritesGoodsModel->getFavoritesGoodsDetail($favorites_row, array('favorites_goods_time' => 'DESC'), 1, 20);


		}
		//用户登录情况下获取足迹信息
		if (Perm::checkUserPerm())
		{
			$user_id = Perm::$userId;

			$cord_row  = array();
			$order_row = array();

			$cond_row = array('user_id' => $user_id);

			$userFootprintModel = new User_FootprintModel();

			$footprint_list = $userFootprintModel->getFootprintList($cond_row, array('footprint_time' => 'DESC'), 1, 30);
			if ($footprint_list['items'])
			{
				$goods_id_row                 = array();
				$goods_id_row['common_id:in'] = array_column($footprint_list['items'], 'common_id');
				$goods_id_row                 = array_unique($goods_id_row);

				$goodsCommonModel = new Goods_CommonModel();
				$goods            = $goodsCommonModel->getGoodsList($goods_id_row);

				$goods_id = array_column($goods['items'], 'common_id');
				//以common_id为下表
				$commonAll = array();
				foreach ($goods['items'] as $k => $v)
				{
					$commonAll[$v['common_id']] = $v;
				}
				foreach ($footprint_list['items'] as $key => $val)
				{
					if (in_array($val['common_id'], $goods_id))
					{
						$footprint_list['items'][$key]['detail'] = $commonAll[$val['common_id']];
					}

				}
			}
		}

		include $this->view->getView();
	}

	public function chat()
	{
		$this->initData();
		if (Perm::checkUserPerm())
		{
			$user_name = Perm::$row['user_account'];
			include $this->view->getView();
		}
	}

	/**
	 *
	 * 取出地区（一级） 店铺保障
	 */
	public function getSearchAdv()
	{
		$data = array();
		$area_list = array();
		$contract_list = array();
		$baseDistrictModel = new Base_DistrictModel();
		$shopContractTypeModel = new Shop_ContractTypeModel();

		$district_list = $baseDistrictModel->getDistrictTree(0, false);
		$contract_type_list = $shopContractTypeModel->getByWhere( array( 'contract_type_state'=> Shop_ContractTypeModel::CONTRACT_OPEN, 'contract_type_name:<>' => '') );

		$district_list = pos($district_list);
		foreach ( $district_list as $key => $district_data)
		{
			$area_list[$key]['area_id'] = $district_data['district_id'];
			$area_list[$key]['area_name'] = $district_data['district_name'];
		}

		$contract_type_list = array_values($contract_type_list);
		foreach ($contract_type_list as $key => $type_data)
		{
			$contract_list[$key]['id'] = $type_data['contract_type_id'];
			$contract_list[$key]['name'] = $type_data['contract_type_name'];
		}

		$data['area_list'] = $area_list;
		$data['contract_list'] = $contract_list;

		$this->data->addBody(-140, $data);
	}

}

?>