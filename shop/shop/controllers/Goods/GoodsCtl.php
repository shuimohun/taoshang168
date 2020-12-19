<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author WenQingTeng
 */
class Goods_GoodsCtl extends Controller
{

	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);

		$this->initData();
		$this->web = $this->webConfig();
		$this->nav = $this->navIndex();
		$this->cat = $this->catIndex();
	}

	/**
	 * 商品列表页
	 *
	 * @access public
	 */
	public function goodslist()
	{
		$cond_row = array();
        $search_property = array();
		$Goods_CommonModel = new Goods_CommonModel();

		//查询分类品牌和分类关联属性
		$brand_property = $this->getBrandAndProperty();

		//头部分类和规格超过9个的话 隐藏以下部分
		if($brand_property)
		{
            $s_more_display = false;
		    $count = isset($brand_property['search_property']) || isset($brand_property['search_brand'])? 1:0 + isset($brand_property['brand_list'])?1:0 + isset($brand_property['child_cat'])?1:0 + isset($brand_property['property'])?count($brand_property['property']):0;
            if($count > 9)
            {
                $s_more_display = true;
            }

            if($brand_property['search_property'])
            {
                $search_property = array_column($brand_property['search_property'],'property_value_id');
            }
		}
		if (!empty($brand_property['common_ids']))
		{
			if (count($brand_property['common_ids']) == 1 && $brand_property['common_ids'][0] === false )
			{
				$cond_row['common_id'] = -1;
			}
			else
            {
				$cond_row['common_id:IN'] = $brand_property['common_ids'];
			}
		}

		$YLB_Page = new YLB_Page();
		$YLB_Page->listRows = request_int('rows',40);
		$rows = $YLB_Page->listRows;
		$offset = request_int('firstRow', 0);
		$page = ceil_r($offset / $rows);

		$wap_pagesize = request_int('pagesize');
		$wap_curpage = request_int('curpage');

		if (!empty($wap_pagesize) )
		{
			$rows = $wap_pagesize;
		}
		if (!empty($wap_curpage) )
		{
			$page = $wap_curpage;
		}

		//分类id
		$cat_id = request_int('cat_id');

		$Goods_CatModel = new Goods_CatModel();
		if ($cat_id)
		{
			//查找该分类下所有的子分类
			$cat_list = $Goods_CatModel->getCatChildId($cat_id);
			$cat_list[] = $cat_id;

			//查找该分类的父级分类
			$parent_cat_id = $Goods_CatModel->getCatParentTree($cat_id);

			$cond_row['cat_id:IN'] = $cat_list;

		}

		//不显示供货商商品
		//$cond_row['product_distributor_flag'] = 0;

		//商品品牌
		$brand_id = request_int('brand_id');
		if ($brand_id)
		{
			$cond_row['brand_id:in'] = $brand_id;
		}

		//商品common_id
		$com_id = request_int('common_id');
		if ($com_id)
		{
			$cond_row['common_id:IN'] = $com_id;
		}

		//商品的配送区域
		//获取默认区域
		$Base_DistrictModel = new Base_DistrictModel();
		if(!isset($_COOKIE['goodslist_area_id']))
		{
			if(!isset($_COOKIE['area']))
			{
				setcookie("goodslist_area_id", 1);
				$cookid_area = $Base_DistrictModel->getCookieDistrict(1);
			}
			else
            {
				$dist = current($Base_DistrictModel->getByWhere(array('district_name'=>$_COOKIE['area'])));
				setcookie("goodslist_area_id", $dist['district_id']);
				$cookid_area = $Base_DistrictModel->getCookieDistrictName($dist['district_name']);
			}
		}
		else
        {
			$cookid_area = $Base_DistrictModel->getCookieDistrict($_COOKIE["goodslist_area_id"]);
		}

		/*$transport_id = request_string('transport_id', isset($cookid_area['city']['id']) ? $cookid_area['city']['id'] : '');
		$transport_area = request_string('transport_area', isset($cookid_area['area']) ? $cookid_area['area'] : '请选择地区');*/
        $transport_id = request_string('transport_id');
        $transport_area = request_string('transport_area', '请选择地区');
		if($transport_id)
		{
			if($transport_id != 'undefined')
			{
				//获取该配送区域的所有模板
				$Transport_ItemModel = new Transport_ItemModel();
				$transport_type_id = $Transport_ItemModel->getItemByTransportId($transport_id);
				$transport_type_id[] = 0;
				$cond_row['transport_type_id:IN'] = $transport_type_id;
			}
			else
            {
				$cond_row['transport_type_id:IN'] = array('0');
			}
		}
		//pc分站
		if(isset($_COOKIE['sub_site_id']) && $_COOKIE['sub_site_id'] > 0)
		{
			$sub_site_id = $_COOKIE['sub_site_id'];
		}

		//wap分站
		if(request_string('ua') === 'wap')
		{
			$sub_site_id = request_int('sub_site_id');
		}
		$op4 = request_string('op4');

		if ($op4 === 'localgoods' || request_string('ua') === 'wap')
		{
			//获取分站信息
			if(Web_ConfigModel::value('subsite_is_open') && isset($sub_site_id) && $sub_site_id > 0)
			{
				//获取站点信息
				$Sub_SiteModel = new Sub_SiteModel();
				$sub_site_district_ids = $Sub_SiteModel->getDistrictChildId($sub_site_id);
				if($sub_site_district_ids)
				{
					$cond_row['district_id:IN'] = $sub_site_district_ids;
				}
			}
		}

		//商品搜索（总）
		$search = request_string('keywords');
		$searchkey = request_string('searkeywords');
		$sear_row = array();
		if($searchkey)
		{
			$sear_row[] = '%'.$searchkey.'%';
            //$cond_row['common_name:LIKE'] = '%' . $searchkey . '%';
		}

		if ($search) {
			/**
			 * 统计中心
			 */
			/*$analytics_ip = get_ip();
			$analytics_data = array(
					'keywords'=>$search,
					'ip'=>$analytics_ip,
					'date'=>date('Y-m-d')
			);
			YLB_Plugin_Manager::getInstance()->trigger('analyticsKeywords',$analytics_data);*/
			/**********************************************************************/

			$sear_row[] = '%' . $search . '%';
            /*$sear_row = $this->split_search_words($search);
            $cond_row['common_name:LIKEOR'] = $sear_row;*/

			//记录搜索关键词
			$Search_WordModel                  = new Search_WordModel();
			$search_cond_row['search_keyword'] = $search;
			$search_row = $Search_WordModel->getSearchWordInfo($search_cond_row);

			if($search_row){
				$search_data                = array();
				$search_data['search_nums'] = $search_row['search_nums'] + 1;
				$flag = $Search_WordModel->editSearchWord($search_row['search_id'], $search_data);
			} else {
				$search_data                      = array();
				$search_data['search_keyword']    = $search;
				$search_data['search_char_index'] = Text_Pinyin::pinyin($search, '');
				$search_data['search_nums']       = 1;
				$flag                             = $Search_WordModel->addSearchWord($search_data);
			}
		}

		if($sear_row)
		{
			$cond_row['common_name:LIKE'] = $sear_row;
		}


		$cond_row['shop_status'] = Shop_BaseModel::SHOP_STATUS_OPEN;

		//上架时间，销量，价格，评论数
		$order_row = array();
		$act = request_string('act');
		$actorder = strtolower(request_string('actorder','desc'));
		if($actorder === 'desc'){
			$next_order = 'asc';
		}else{
			$next_order = 'desc';
		}

		//上架时间,这里用商品入库时间
		if ($act === 'all') {
			$order_row['common_id'] = $actorder;
		}
		//销量
		if ($act === '') {
			$order_row['common_salenum'] = $actorder;
		}

		//销量
		if ($act === 'sale') {
			$order_row['common_salenum'] = $actorder;
		}

		//价格
		if ($act === 'price') {
			$order_row['common_shared_price'] = $actorder;
		}

		//评论数
		if ($act === 'evaluate') {
			$order_row['common_evaluate'] = $actorder;
		}

		//立省
        if($act === 'share'){
            $order_row['common_share_price'] = $actorder;
        }

		$op1 = request_string('op1');
		$op2 = request_string('op2');
		$op3 = request_string('op3');

		if ($op1) {
			//仅显示有货
			if ($op1 === 'havestock') {
				$cond_row['common_stock:>'] = 0;
			}
		}

		if ($op2) {
			//仅显示促销商品
			if ($op2 === 'active') {
				$cond_row['common_promotion_type:>'] = 0;
				//$cond_row['common_is_jia:!=']  = 0;
			}
		}

		if ($op3) {
			//显示自营
			if ($op3 === 'ziying') {
				$cond_row['shop_self_support'] = 1;
			}
		}

		$price_from = request_float('price_from');
		if($price_from) {
			$cond_row['common_price:>='] = $price_from;
		}

		$price_to = request_float('price_to');
		if($price_to) {
			$cond_row['common_price:<='] = $price_to;
		}

		$virtual = request_float('isvirtual');
		if($virtual) {
			$cond_row['common_is_virtual'] = Goods_CommonModel::GOODS_VIRTUAL;
		}

		//判断是否有属性
		$cond_row['common_state'] = Goods_CommonModel::GOODS_STATE_NORMAL;
		$cond_row['common_verify'] = Goods_CommonModel::GOODS_VERIFY_ALLOW;

		//获取列表数据
		$data = $Goods_CommonModel->getGoodsListII($cond_row, $order_row, $page, $rows,$search_property);

		$data['transport_area'] = $transport_area;

		if ('json' == $this->typ)
		{
            $data['items'] = array_values($data['items']);
			$this->data->addBody(-140, $data);
		}
		else
        {
            $YLB_Page->totalRows = $data['totalsize'];
            $page_nav = $YLB_Page->prompt();

            //热卖推荐，查找商城中销量最多的商品
            $hot_order_row['common_salenum'] = 'DESC';
            $hot_sale = $Goods_CommonModel->getGoodsListII($cond_row, $hot_order_row, 1, 4);

            $hot_sale = $hot_sale['items'];
            if (!$hot_sale) {
                $hot_cond_row['common_state'] = Goods_CommonModel::GOODS_STATE_NORMAL;
                $hot_cond_row['common_verify'] = Goods_CommonModel::GOODS_VERIFY_ALLOW;

                $hot_order_row['common_salenum'] = 'DESC';
                $hot_sale = $Goods_CommonModel->getGoodsListII($hot_cond_row, $hot_order_row, 1, 4);
                $hot_sale = $hot_sale['items'];
            }

            //推广产品
            $Goods_RecommendModel = new Goods_RecommendModel();
            $rec_cond_row   = array();
            $rec_order_row['goods_recommend_id'] = 'DESC';
            //如果有查找的分类就显示该分类下的推广商品，如果没有传递分类就显示最新设置的分类推广
            if ($cat_id)
            {
                $rec_cond_row['goods_cat_id'] = $cat_id;
            }
            $recommend_row = $Goods_RecommendModel->getRecommendGoods($rec_cond_row, $rec_order_row);
            //如果商城没有设定推广商品，则将最新发布的四件商品作为推广商品显示
            if (!$recommend_row)
            {
                if($cat_list)
                {
                    $com_cond_row['cat_id:IN'] = $cat_list;
                }
                $com_cond_row['common_state'] = Goods_CommonModel::GOODS_STATE_NORMAL;
                $com_cond_row['common_verify'] = Goods_CommonModel::GOODS_VERIFY_ALLOW;
                $com_order_row['common_id'] = 'DESC';

                $recommend_row = $Goods_CommonModel->getGoodsListII($com_cond_row, $com_order_row, 1, 16);
                $recommend_row = $recommend_row['items'];
            }

            //获取品牌信息
            $Goods_TypeModel = new Goods_TypeModel();
            //如果有查找的分类就显示该分类的相关品牌，如果没有传递分类就不显示品牌
            if ($cat_id)
            {
                $type_cond_row['cat_id'] = $cat_id;
                $brand_row = $Goods_TypeModel->getTypeBrand($type_cond_row);
            }

            //获取分类信息
            $Goods_TypeBrandModel = new Goods_TypeBrandModel();
            //如果有品牌就显示该品牌下的分类，如果没有就不显示分类
            if ($brand_id) {
                $tbrand_cond_row['brand_id'] = $brand_id;
                $cat_row = $Goods_TypeBrandModel->getBrandType($tbrand_cond_row);
            }

            $title = Web_ConfigModel::value("category_title");//首页名;
            $this->keyword = Web_ConfigModel::value("category_keyword");//关键字;
            $this->description = Web_ConfigModel::value("category_description");//描述;
            $this->title = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $title);
            $this->keyword = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->keyword);
            $this->description = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->description);

			include $this->view->getView();
		}
	}

	/**
	 * 商品详情页  goodsdetailinfo
	 *
	 * @access public
	 */
	public function goodDetail()
	{
		$goods_id = request_int('goods_id');

		$Goods_BaseModel = new Goods_BaseModel();
		$goods_base = $Goods_BaseModel->getGoodsInfo($goods_id);

		//计算商品价格
		if (isset($goods_base['goods_base']['promotion']) && !empty($goods_base['goods_base']['promotion']) && $goods_base['goods_base']['promotion']['promotion_price'] < $goods_base['goods_base']['goods_price'])
		{
			$goods_base['goods_base']['old_price']  = $goods_base['goods_base']['goods_price'];
			$goods_base['goods_base']['now_price']  = $goods_base['goods_base']['promotion']['promotion_price'];
			$goods_base['goods_base']['down_price'] = $goods_base['goods_base']['promotion']['down_price'];
		} else {
			$goods_base['goods_base']['old_price']  = 0;
			$goods_base['goods_base']['now_price']  = $goods_base['goods_base']['goods_price'];
			$goods_base['goods_base']['down_price'] = 0;
		}

		$this->data->addBody(-140, $goods_base);

	}

    /**
     * 根据cid获取gid
     */
	public function getGoodsidByCid()
	{
		$cid = request_int('cid');
		$Goods_CommonModel = new Goods_CommonModel();
        $goods_id = $Goods_CommonModel->getNormalStateGoodsId($cid);
		$this->data->addBody(-140, array('goods_id' => $goods_id));
	}

	/**
	 * 商品详情页  goodsdetailinfo
	 *
	 * @access public
	 */
	public function goods()
	{
        $Goods_CommonModel = new Goods_CommonModel();
        $Goods_BaseModel   = new Goods_BaseModel();
        $Shop_BaseModel    = new Shop_BaseModel();

        /* ---------------- 增加 默认配送区域 @lgl 20170804 start ----------------------*/
		$Base_DistrictModel = new Base_DistrictModel();
		if(!isset($_COOKIE['goodslist_area_id']))
		{
			if(!isset($_COOKIE['area']))
			{
				setcookie("goodslist_area_id", 1);
				$cookid_area = $Base_DistrictModel->getCookieDistrict(1);
			}
			else
            {
				$dist = current($Base_DistrictModel->getByWhere(array('district_name'=>$_COOKIE['area'])));
				setcookie("goodslist_area_id", $dist['district_id']);
				$cookid_area = $Base_DistrictModel->getCookieDistrictName($dist['district_name']);
			}
		}
		else
        {
			$cookid_area = $Base_DistrictModel->getCookieDistrict($_COOKIE["goodslist_area_id"]);
		}
		$transport_id = request_string('transport_id', isset($cookid_area['city']['id']) ? $cookid_area['city']['id'] : '');
		$transport_area = request_string('transport_area', isset($cookid_area['area']) ? $cookid_area['area'] : '请选择地区');
		/* ---------------- 增加 默认配送区域 @lgl 20170804 end ----------------------*/

		$cid = request_int('cid');
		$goods_id = request_int('gid', request_int('goods_id'));

		//如果传递过来的是common_id，则从此common_id中的goods_id中选择一个有效的goods_id
        //此方法待优化 优先取参加活动的商品
		if($cid && !$goods_id)
		{
            $goods_id = $Goods_CommonModel->getNormalStateGoodsId($cid);
		}

		//添加商品点击数
		$good_click_row  = array('goods_click' => '1');
		$res = $Goods_BaseModel->editBase($goods_id, $good_click_row, true);

		//1.商品信息（商品活动信息，评论数，销售数，咨询数）
        $goods_detail = $Goods_BaseModel->getGoodsDetailInfoByGoodId($goods_id);

        if (!$goods_detail)
		{
			if($this->typ == 'json')
            {
                $this->data->addBody(-1,array(),'抱歉，该商品已下架或者该店铺已关闭',250);return;
            }
            else
            {
                $this->view->setMet('404');
            }
		}
		else
		{
            $isFavoritesGoods = false;//是否被收藏
            /*添加用户足迹 是否被收藏 start*/
			if (Perm::checkUserPerm())
			{
				$user_id = Perm::$userId;

				//判断该用户是否浏览过该商品
                $User_FootprintModel = new User_FootprintModel();
				$foot_cond_row['user_id']   = $user_id;
				$foot_cond_row['common_id'] = $goods_detail['goods_base']['common_id'];
				$foot_id                    = $User_FootprintModel->getKeyByWhere($foot_cond_row);
				if ($foot_id)
				{
                    //如果用户曾经浏览过该商品则修改浏览时间
					$edit_foot_row                   = array();
                    $edit_foot_row['common_name']    = $goods_detail['goods_common']['common_name'];//商品spu名称
                    $edit_foot_row['common_image']   = $goods_detail['goods_common']['common_image'];//商品主图
					$edit_foot_row['footprint_time'] = get_date_time();
					$User_FootprintModel->editFootprint($foot_id, $edit_foot_row);
				}
				else
				{
                    //分类id
                    $Goods_CatModel = new Goods_CatModel();
                    $cat_base = $Goods_CatModel->getOne($goods_detail['goods_base']['cat_id']);

					//如果没有浏览过改商品则插入数据
					$read_add_row                   = array();
					$read_add_row['user_id']        = $user_id;
                    $read_add_row['shop_id']        = $goods_detail['goods_base']['shop_id'];
					$read_add_row['common_id']      = $goods_detail['goods_base']['common_id'];
					$read_add_row['common_name']    = $goods_detail['goods_common']['common_name'];//商品spu名称
                    $read_add_row['common_image']   = $goods_detail['goods_common']['common_image'];//商品主图
					$read_add_row['footprint_time'] = get_date_time();
                    $read_add_row['cat_id']         = $cat_base['cat_parent_id'];

					$User_FootprintModel->addFootprint($read_add_row);
				}

                //判断此商品是否被收藏
                $User_FavoritesGoodsModel = new User_FavoritesGoodsModel();
                $user_favorites_goods_row['user_id'] = $user_id;
                $user_favorites_goods_row['goods_id'] = $goods_detail['goods_base']['goods_id'];
                $user_favorites_goods = $User_FavoritesGoodsModel->getKeyByWhere($user_favorites_goods_row);
                if($user_favorites_goods)
                {
                    $isFavoritesGoods = true;
                }

                //是否有默认收货地址
                $UserAddressModel = new User_AddressModel();
                $default_address = $UserAddressModel->getKeyByWhere(['user_id'=> Perm::$userId,'user_address_default' => 1]);
			}
            /*添加用户足迹 是否被收藏 end*/

			if(Web_ConfigModel::value('Plugin_Directseller'))
			{
				//推荐者上传的图片
				$PluginManager = YLB_Plugin_Manager::getInstance();
				$data = $PluginManager->trigger('rec_goods');
				$goods_detail['recImages'] = isset($data['Plugin_Directseller_recGoods']) ? $data['Plugin_Directseller_recGoods'] : '';
			}

			//2.店铺信息
            $this->shop_id = $goods_detail['goods_base']['shop_id'];
            $shop_detail = $Shop_BaseModel->getShopDetailData($goods_detail['shop_base']);

			if(!$shop_detail)
			{
				$this->view->setMet('404');
			}
			if($shop_detail['shop_status']!=3)
			{
                $this->view->setMet('404');
            }

			//查找该店铺下的实体店铺
			/*$Shop_EntityModel = new Shop_EntityModel();
			$entity_shop = $Shop_EntityModel->getByWhere(array("shop_id" => $goods_detail['goods_base']['shop_id']));*/

			//检查是否为店主本人
			$shop_owner = 0;
			if ($shop_detail['shop_id'] == Perm::$shopId  || $shop_detail['user_id'] == Perm::$userId)
			{
				if ($goods_detail['goods_common']['common_promotion_type'] != Goods_CommonModel::HUIQIANGGOU && $goods_detail['goods_common']['common_promotion_type'] != Goods_CommonModel::FU)
                {
                    $shop_owner = 1;
                }
			}


			//判断是否可以门店自提
			$Chain_GoodsModel           = new Chain_GoodsModel();
            $chain_row['shop_id']       = $goods_detail['goods_base']['shop_id'];
            $chain_row['goods_id']      = $goods_id;
            $chain_row['goods_stock:>'] = 0;
            $chain_goods                = $Chain_GoodsModel->getKeyByWhere($chain_row);
            if($chain_goods)
            {
                $goods_detail['chain_stock'] = 1;
            }

			/*计算限购数量 start*/
            $goods_detail['buy_limit'] = $goods_detail['goods_common']['common_limit'];
            /*计算限购数量 end*/

            /*判断是否达到购买上限 start*/
            $IsHaveBuy = 0;
            //先判断限购 $goods_detail['buy_limit'] = 0为不限购
            if ($goods_detail['buy_limit'])
            {
                //查询该用户是否已购买过该商品
                $Order_GoodsModel = new Order_GoodsModel();
                $order_goods_num = $Order_GoodsModel->getUserBuyCountByCId($goods_detail['goods_base']['common_id']);

                if($goods_detail['buy_limit'])
                {
                    if($order_goods_num >= $goods_detail['buy_limit'])
                    {
                        $IsHaveBuy = 1;
                    }
                    else
                    {
                        //还可以购买数量
                        //$goods_detail['buy_limit'] = $goods_detail['buy_limit'] - $order_goods_num;
                        $goods_detail['buy_residue'] = $goods_detail['buy_limit'] - $order_goods_num;
                    }
                }
            }

            if(!$goods_detail['buy_residue'] || $goods_detail['buy_residue'] > $goods_detail['goods_base']['goods_stock'])
            {
                $goods_detail['buy_residue'] = $goods_detail['goods_base']['goods_stock'];
            }
            /*判断是否达到购买上限 end*/

            /*计算活动优惠上限 start*/
            $goods_detail['lower_limit'] = 1;
            if(isset($goods_detail['goods_base']['promotion']))
            {
                if ($goods_detail['goods_base']['promotion']['upper_limit'])
                {
                    if($order_goods_num >= $goods_detail['goods_base']['promotion']['upper_limit'])
                    {
                        //已达优惠上限
                        unset($goods_detail['goods_base']['promotion']['promotion_price']);
                    }
                }

                if ($goods_detail['goods_base']['promotion']['lower_limit'])
                {
                    $goods_detail['lower_limit'] = $goods_detail['goods_base']['promotion']['lower_limit'];

                    if($goods_detail['lower_limit'] > $goods_detail['buy_residue'])
                    {
                        $goods_detail['goods_base']['goods_stock'] = 0;
                    }
                }
            }
            /*计算活动优惠上限 end*/

            /*如果分享立减金额为0 start*/
            $share_total_price = 0;
            $shared_price = 0;

            if(isset($goods_detail['goods_base']['promotion']) && $goods_detail['goods_base']['promotion']['promotion_type'] == $Goods_CommonModel::FU)
            {
                $fu_base = new Fu_BaseModel();
                $base_cond_row['goods_id'] = $goods_id;
                $base_cond_row['fu_state'] = Fu_BaseModel::NORMAL;
                $base = $fu_base-> getOneFuByWhere( $base_cond_row );

                $fu_record = new Fu_RecordModel();
                $record_cond_row['goods_id'] = $goods_id;
                $record_cond_row['fu_id'] = $base['fu_id'];
                $record_base = $fu_record->getRowCount( $record_cond_row );

                $goods_detail['goods_base']['fu_flag'] = 1;
                $goods_detail['goods_base']['fu_complete'] = '0/' . $goods_detail['goods_base']['promotion']['fu_total_times'];
                $share_total_price = $goods_detail['goods_base']['promotion']['promotion_price'];

                $goods_detail['buy_residue'] = 1;
            }

            if(isset($goods_detail['goods_base']['share_info']))
            {
                $share_total_price = $goods_detail['goods_base']['share_info']['share_total_price'];

                if(isset($goods_detail['goods_base']['share_info']['price']) && $goods_detail['goods_base']['share_info']['price']['price'])
                {
                    $shared_price = $goods_detail['goods_base']['share_info']['price']['price'];
                }
            }
            else if(isset($goods_detail['goods_base']['fu_info']))
            {
                $goods_detail['goods_base']['fu_complete'] = array_sum($goods_detail['goods_base']['fu_info']['fu_base']) . '/' . $goods_detail['goods_base']['promotion']['fu_total_times'];

                if($goods_detail['goods_base']['fu_info']['status'] == Fu_RecordModel::NORMAL)
                {
                    $shared_price = $goods_detail['goods_base']['fu_info']['click_count'] * $goods_detail['goods_base']['fu_info']['unit_price'];
                }
                else if($goods_detail['goods_base']['fu_info']['status'] == Fu_RecordModel::DONE)
                {
                    $shared_price = $goods_detail['goods_base']['promotion']['promotion_price'];
                }
                else
                {
                    unset($goods_detail['goods_base']['fu_info']);
                }
            }

            /*如果分享立减金额为0 end*/

            /*计算立即购买价/全分享价 start*/
            if(isset($goods_detail['goods_base']['promotion']) && isset($goods_detail['goods_base']['promotion']['promotion_price']))
            {
                $goods_detail['goods_base']['now_buy_price'] = $goods_detail['goods_base']['promotion']['promotion_price'] - $shared_price;//立即购买价格
                $goods_detail['goods_base']['shared_total_price'] = $goods_detail['goods_base']['promotion']['promotion_price'] - $share_total_price;//全分享价
            }
            else
            {
                if($goods_detail['goods_base']['mobile_price'])
                {
                    $goods_detail['goods_base']['mobile_price'] -= $goods_detail['goods_base']['share_info']['share_total_price'];
                }

                $goods_detail['goods_base']['now_buy_price'] = $goods_detail['goods_base']['goods_price'] - $shared_price;//立即购买价格
                $goods_detail['goods_base']['shared_total_price'] = $goods_detail['goods_base']['goods_price'] - $share_total_price;//全分享价
            }
            $goods_detail['goods_base']['now_buy_price'] = number_format($goods_detail['goods_base']['now_buy_price'],2,'.','');
            $goods_detail['goods_base']['shared_total_price'] = number_format($goods_detail['goods_base']['shared_total_price'],2,'.','');
            /*计算立即购买价/全分享价 end*/

            //热销
            $data_hot_salle = $Goods_CommonModel->getHotSalle($shop_detail['shop_id']);
            $data_salle     = $Goods_CommonModel->getGoodsCommonMain($data_hot_salle);
		}

		/*客服信息 start*/
		if($shop_detail['shop_id'])
		{
			$shopCustomServiceModel = new Shop_CustomServiceModel;
			$cond_row['shop_id'] = $shop_detail['shop_id'];
			$service = $shopCustomServiceModel->getServiceList($cond_row);
		}
        /*客服信息 end*/

        $user_points        = Web_ConfigModel::value("points_recharge");//订单每多少获取多少金蛋
        $user_points_amount = Web_ConfigModel::value("points_order");//订单每多少获取多少金蛋

        if ($goods_detail['goods_base']['shared_total_price'] / $user_points < $user_points_amount)
        {
            $user_points = floor($goods_detail['goods_base']['shared_total_price'] / $user_points);
        }
        else
        {
            $user_points = $user_points_amount;
        }

		if ('json' == $this->typ)
		{
            /* wap app json返回数据 */
            $data = array();

            //商品详情goods_base goods_common
            $goods_info['goods_id'] = $goods_detail['goods_base']['goods_id'];
            $goods_info['common_id'] = $goods_detail['goods_base']['common_id'];
            $goods_info['goods_name'] = $goods_detail['goods_base']['goods_name'];
            $goods_info['goods_price'] = $goods_detail['goods_base']['goods_price'];//价格
            $goods_info['goods_stock'] = $goods_detail['goods_base']['goods_stock'];//库存
            $goods_info['chain_stock'] = @$goods_detail['chain_stock'];
            $goods_info['goods_image'] = $goods_detail['goods_base']['goods_image'];//图片
            $goods_info['goods_spec'] = $goods_detail['goods_base']['goods_spec'];  //规格
            $goods_info['cart'] = $goods_detail['goods_base']['cart'];
            $goods_info['common_promotion_tips'] = $goods_detail['goods_common']['common_promotion_tips'];//副标题
            $goods_info['shop_self_support'] = $goods_detail['goods_common']['shop_self_support'];        //是否自营
            $goods_info['common_collect'] = $goods_detail['goods_common']['common_collect'];              //收藏
            $goods_info['common_evaluate'] = $goods_detail['goods_common']['common_evaluate'];            //评论
            $goods_info['common_salenum'] = $goods_detail['goods_common']['common_salenum'];              //销量
            $goods_info['common_promotion_type'] = $goods_detail['goods_common']['common_promotion_type'];//活动类型
            $goods_info['common_property_row'] = $goods_detail['goods_common']['common_property_row'];    //属性
            $goods_info['common_spec_name'] = $goods_detail['goods_common']['common_spec_name'];
            $goods_info['common_spec_value_c'] = $goods_detail['goods_common']['common_spec_value_c'];//规格
            $goods_info['common_share_price'] = $goods_detail['goods_common']['common_share_price'];  //分享立减
            $goods_info['common_is_promotion'] = $goods_detail['goods_common']['common_is_promotion'];//是否立赚
            $goods_info['common_promotion_price'] = $goods_detail['goods_common']['common_promotion_price'];//分享立赚
            $goods_info['common_is_jia'] = $goods_detail['goods_common']['common_is_jia'];         //加价购
            $goods_info['common_is_virtual'] = $goods_detail['goods_common']['common_is_virtual']; //是否虚拟
            $goods_info['promotion'] = $goods_detail['goods_base']['promotion'];                   //活动 1惠抢购 2限时折扣 3手机专享 4新人优惠
            $goods_info['increase_info'] = $goods_detail['goods_base']['increase_info'];           //加价购
            $goods_info['now_buy_price'] = $goods_detail['goods_base']['now_buy_price'];           //现在购买价
            $goods_info['shared_total_price'] = $goods_detail['goods_base']['shared_total_price']; //全分享价
            $goods_info['user_points'] = $user_points;
            $goods_info['fu_flag'] = $goods_detail['goods_base']['fu_flag'] ? $goods_detail['goods_base']['fu_flag'] : 0;
            $goods_info['fu_complete'] = $goods_detail['goods_base']['fu_complete'] ? $goods_detail['goods_base']['fu_complete'] : '';
            $goods_info['is_register'] = $base['is_register'] ? $base['is_register'] : '';
            $goods_info['total_person'] = $record_base ? $record_base : 0;

            if(isset($goods_detail['goods_base']['share_info']))
            {
                $goods_info['share_info'] = $goods_detail['goods_base']['share_info'];          //分享立减信息
            }
            else if(isset($goods_detail['goods_base']['fu_info']))
            {
                $goods_info['fu_info'] = $goods_detail['goods_base']['fu_info'];                 //送福免单信息
            }

            //好评率
            $Goods_EvaluationModel =  new Goods_EvaluationModel();
            $good_pre = $Goods_EvaluationModel -> countGoodEvaluation($goods_detail['goods_common']['common_id']);

			//配送信息
			$goods_hair_info['content'] = $goods_detail['shop_base']['shipping'];
			$goods_hair_info['if_store_cn'] = empty($goods_detail['goods_base']['goods_stock']) ? '无货' : '有货';
			$goods_hair_info['if_store'] = empty($goods_detail['goods_base']['goods_stock']) ? false : true;
			$goods_hair_info['area_name'] = '全国';

			//图片信息
			if ( isset($goods_detail['goods_base']['image_row']) && !empty($goods_detail['goods_base']['image_row']) )
			{
				$images_list = array_column($goods_detail['goods_base']['image_row'], 'images_image');
				$images_list = array_map(function ($img){return image_thumb($img, 360, 360);}, $images_list);
				$goods_image = implode(',', $images_list);
			}
			else
			{
				$goods_image = $goods_detail['goods_base']['goods_image'];
			}

			//满送
			$mansong_info = $goods_detail['mansong_info'];

			//规格 规格颜色
			if ( !empty($goods_detail['goods_common']['common_spec_name']) )
			{
				//商品规格
				$spec_list = $Goods_BaseModel->createSGIdByWap($goods_detail['goods_common']['common_id']);

				//商品规格颜色图
				if ( !empty($goods_detail['goods_common']['common_spec_value_color']) )
				{
					$spec_image = $goods_detail['goods_common']['common_spec_value_color'];
				}
			}

			//店铺信息
			$store_info['is_own_shop'] 	                    = $shop_detail['shop_self_support'];
			$store_info['member_id'] 	                    = $shop_detail['user_id'];
			$store_info['member_name'] 	                    = $shop_detail['user_name'];
			$store_info['store_id'] 	                    = $shop_detail['shop_id'];
			$store_info['store_name'] 	                    = $shop_detail['shop_name'];
			$store_info['store_logo'] 	                    = $shop_detail['shop_logo'];
            $store_info['store_collect']                    = $shop_detail['shop_collect'];
            $store_info['goods_state_normal_num'] 	        = $shop_detail['goods_state_normal_num'];
			$store_credit['store_deliverycredit'] 	        = array();
			$store_credit['store_deliverycredit']['credit']	= $shop_detail['shop_send_scores'];
			$store_credit['store_deliverycredit']['text']	= "发货速度";
			$store_credit['store_desccredit'] 		        = array();
			$store_credit['store_desccredit']['credit']		= $shop_detail['shop_desc_scores'];
			$store_credit['store_desccredit']['text']		= "描述相符";
			$store_credit['store_servicecredit'] 	        = array();
			$store_credit['store_servicecredit']['credit']	= $shop_detail['shop_service_scores'];
			$store_credit['store_servicecredit']['text']	= "服务态度";
			$store_info['store_credit'] = $store_credit;
			if($shop_detail['contract'])
            {
                $store_info['contract'] = $shop_detail['contract'];
            }
			$data['goods_id']		 = $goods_id;
			$data['goods_info'] 	 = $goods_info; 			  //商品详情
            $data['good_pre']        = $good_pre;   			  //好评率
            $data['goods_hair_info'] = $goods_hair_info; 		  //售卖区域
            $data['goods_image'] 	 = $goods_image; 			  //图片信息
            $data['mansong_info'] 	 = $mansong_info; 			  //商品满送
            $data['spec_list'] 		 = $spec_list; 				  //商品规格
            $data['spec_image'] 	 = $spec_image; 			  //商品规格颜色
            $data['store_info'] 	 = $store_info; 			  //店铺信息
            $data['service']         = $service;                  //客服
            $data['buyer_limit']     = $goods_detail['buy_limit'];//限购数量
            $data['is_favorate']	 = $isFavoritesGoods;		  //是否收藏过商品
            $data['shop_owner']		 = $shop_owner;				  //是否为店主
            $data['isBuyHave']		 = $IsHaveBuy;				  //是否已达限购数量

			if(Web_ConfigModel::value('Plugin_Directseller'))
			{
				$data['rec_images']  = $goods_detail['recImages'];//推荐者上传图片
			}

            //代金券
            if($user_id)
            {
                //已领代金券
                $VoucherBaseModel     = new Voucher_BaseModel();
                $cond_v_row['voucher_owner_id']    = $user_id;
                $cond_v_row['voucher_shop_id']     = $shop_detail['shop_id'];
                $cond_v_row['voucher_state']       = Voucher_BaseModel::UNUSED;
                $cond_v_row['voucher_end_date:>']  = get_date_time();
                $order_v_row['voucher_id']         = 'DESC';
                $rows                            = $VoucherBaseModel->getByWhere($cond_v_row, $order_v_row);
                if($rows)
                {
                    foreach ($rows as $k=>$v)
                    {
                        $rows[$k]['taken'] = 1;
                        if($v['voucher_type'] == Voucher_TempModel::GETBYPOINTS)
                        {
                            $rows[$k]['voucher_type_con'] = '已兑';
                        }
                        else
                        {
                            $rows[$k]['voucher_type_con'] = '已领';
                        }
                        $voucher_t_ids[] = $v['voucher_t_id'];
                    }
                }
            }

            $VoucherTemplateModel = new Voucher_TempModel();
            $cond_vt_row['shop_id'] = $shop_detail['shop_id'];
            $cond_vt_row['voucher_t_state'] = Voucher_TempModel::VALID;
            $cond_vt_row['voucher_t_start_date:<'] = date('y-m-d H:i:s',time());
            $cond_vt_row['voucher_t_end_date:>'] = date('y-m-d H:i:s',time());
            if($voucher_t_ids)
            {
                $cond_vt_row['voucher_t_id:NOT IN'] = $voucher_t_ids;
            }
            $voucher_vt_list = $VoucherTemplateModel->getByWhere($cond_vt_row);

            if($voucher_vt_list)
            {
                foreach ($voucher_vt_list as $k=>$v)
                {
                    $shop_voucher_data['voucher_t_id']       = $v['voucher_t_id'];
                    $shop_voucher_data['voucher_title']      = $v['voucher_t_title'];
                    $shop_voucher_data['voucher_desc']       = $v['voucher_t_desc'];
                    $shop_voucher_data['voucher_start_date'] = $v['voucher_t_start_date'];
                    $shop_voucher_data['voucher_end_date']   = $v['voucher_t_end_date'];
                    $shop_voucher_data['voucher_price']      = $v['voucher_t_price'];
                    $shop_voucher_data['voucher_limit']      = $v['voucher_t_limit'];
                    $shop_voucher_data['voucher_shop_id']    = $v['shop_id'];
                    $shop_voucher_data['voucher_type']       = $v['voucher_t_access_method'];
                    if($shop_voucher_data['voucher_type'] == Voucher_TempModel::GETBYPOINTS)
                    {
                        $shop_voucher_data['voucher_type_con'] = '兑换';
                    }
                    else
                    {
                        $shop_voucher_data['voucher_type_con'] = '领取';
                    }
                    $shop_voucher_data['voucher_points']     = $v['voucher_t_points'];

                    $rows[] = $shop_voucher_data;
                }
            }

            $key_arrays = array_column($rows,'voucher_price');
            array_multisort($key_arrays,SORT_ASC,SORT_NUMERIC,$rows);
            $data['voucher'] = $rows;


            //推荐商品json
            $data_foot_recommon         = $Goods_CommonModel->listByWhere(array('shop_id' => $shop_detail['shop_id'],'common_state'=>$Goods_CommonModel::GOODS_STATE_NORMAL), array('common_is_recommend' => 'DESC'), 0, 8);
            $data_foot_recommon_goods   = $Goods_CommonModel->getGoodsCommonMain($data_foot_recommon,8);
            $data['goods_commend_list'] = $data_foot_recommon_goods;//推荐商品
            $data['goods_sale_list'] 	= $data_salle; 				//热销商品

            //$data['goods_eval_list'] 		= $goods_eval_list; 		//商品评论
            //$data['goods_evaluate_info'] 	= $goods_evaluate_info; 	//商品评论

            if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false )
            {
                //微信内分享实例化
                $url = YLB_Registry::get('shop_wap_url') .'/tmpl/product_detail.html?goods_id='.$goods_id;
                $jssdk = new Api_JSSDK("wx7c9bd0e5a3b798c3", "420fe679653100b366150f70a5afdb3c",$url);
                $signPackage = $jssdk->GetSignPackage();
                $data['wxConfig'] = array('appId'=>$signPackage['appId'],'timestamp'=>$signPackage['timestamp'],'nonceStr'=>$signPackage['nonceStr'],'signature'=>$signPackage['signature']);
            }

            $data['default_address'] = isset($default_address) && $default_address ? 1 : 0;
            $this->data->addBody(-140,$data);
		}
		else
		{
		    //pc端的放在这里 不给json添加冗余
            $title             = Web_ConfigModel::value("product_title");//首页名;
            $this->keyword     = Web_ConfigModel::value("product_keyword");//关键字;
            $this->description = Web_ConfigModel::value("product_description");//描述;
            $this->title       = str_replace("{sitename}",$goods_detail['goods_base']['goods_name'] , $title);
            $this->title       = str_replace("{name}", Web_ConfigModel::value("site_name"), $this->title);
            $this->keyword     = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->keyword);
            $this->keyword     = str_replace("{name}", $goods_detail['goods_base']['goods_name'], $this->keyword);
            $this->description = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->description);
            $this->description = str_replace("{name}", $goods_detail['goods_base']['goods_name'], $this->description );

            //检测商品是否已经下架
            $goods_status = 1;
            if ($goods_detail['goods_base']['goods_is_shelves'] != Goods_BaseModel::GOODS_UP || $goods_detail['goods_common']['common_state'] != Goods_CommonModel::GOODS_STATE_NORMAL)
            {
                $goods_status = 0;
            }

            /* 查找该分类的父级分类 start */
            $Goods_CatModel = new Goods_CatModel();
            $parent_cat = $Goods_CatModel->getCatParent($goods_detail['goods_base']['cat_id']);
            $cat_info = $Goods_CatModel->getOne($goods_detail['goods_base']['cat_id']);
            if($cat_info)
            {
                $cat_info['ext'] = 1;
                $parent_cat[] = $cat_info;
            }
            /* 查找该分类的父级分类 end */

            /*商品详情start*/
            /*$Goods_CommonDetailModel = new Goods_CommonDetailModel();
            $common_detail            = $Goods_CommonDetailModel->getOne($goods_detail['goods_common']['common_id']);
            if ($common_detail)
            {
                $goods_detail['goods_common']['common_detail'] = $common_detail['common_body'];
                $goods_detail['goods_common']['common_detail'] = str_replace('src=',' data-original=',$goods_detail['goods_common']['common_detail']);
            }
            else
            {
                $goods_detail['goods_common']['common_detail'] = '';
            }*/
            /*商品详情end*/

            //客服
            if($service['items'])
            {
                foreach($service['items'] as $key => $val)
                {
                    //IM
                    if($val['tool'] ==3)
                    {
                        //$service[$key]["tool"] = '<a href="javascript:;" class="chat-enter" onclick="return chat(\''.$val['number'].'\');"><img src="'.$this->view->img.'/icon-im.gif" alt=""></a>';
                        $service[$key]["tool"] = '<a href="javascript:;" class="chat-enter" rel="'.$val['number'].'" ><img src="'.$this->view->img.'/icon-im.gif" alt=""></a>';
                    }
                    $service[$key]["number"] = $val['number'];
                    $service[$key]["name"] = $val['name'];
                    $service[$key]["id"] = $val['id'];
                    if($val['type']==1)
                    {
                        $de['after'][] = $service[$key];
                    }
                    else
                    {
                        $de['pre'][] = $service[$key];
                    }
                }
                $service = $de;
            }

            //商品咨询数量
            $Consult_BaseModel = new Consult_BaseModel();
            $consult_num      = $Consult_BaseModel->getCount(array('goods_id' => $goods_id,'shop_id' => $shop_detail['shop_id']));


            /*关联样式 start*/
            if($goods_detail['goods_common'])
            {
                $Goods_FormatModel = new Goods_FormatModel();
                //头部样式
                $common_formatid_top = $goods_detail['goods_common']['common_formatid_top'];
                if ($common_formatid_top)
                {
                    $goods_format_top = $Goods_FormatModel->getOne($common_formatid_top);
                }

                //尾部样式
                $common_formatid_bottom = $goods_detail['goods_common']['common_formatid_bottom'];
                if ($common_formatid_bottom)
                {
                    $goods_format_bottom = $Goods_FormatModel->getOne($common_formatid_bottom);
                }
            }
            /*关联样式 end*/

            //看了又看
            if($shop_detail['shop_self_support'] == 'true')
            {
                $data_recommon       = $Goods_CommonModel->listByWhere(array('shop_id' => $shop_detail['shop_id']), array('common_is_recommend' => 'desc','common_sell_time' => 'desc'), 0, 4);
                $data_recommon_goods = $Goods_CommonModel->getGoodsCommonMain($data_recommon);
            }

            //热门收藏
            $data_hot_collect = $Goods_CommonModel->getHotCollect($shop_detail['shop_id']);
            $data_collect     = $Goods_CommonModel->getGoodsCommonMain($data_hot_collect);

			include $this->view->getView();
		}
	}

    /**
     * 获取商品详情页
     */
    public function getGoodsDetail()
    {
        $data = array();
        $common_id = request_string('common_id',request_string('cid'));
        if(!$common_id)
        {
            return null;
        }

        $Goods_CommonDetailModel = new Goods_CommonDetailModel();
        $goods_detail            = $Goods_CommonDetailModel->getOne($common_id);
        if ($goods_detail)
        {
            $data['goods_detail'] = $goods_detail['common_body'];
            //$data['goods_detail'] = str_replace('src=',' data-original=',$goods_detail['common_body']);
        }

        if($this->typ == 'json')
        {
            $this->data->addBody(-140,$data,'success',200);
        }
        else
        {
            include $this->view->getView();
        }
    }

	/**
	 * 取得商品信息
	 *
	 * @access public
	 */
	public function getGoodsDetailInfo(){
		$goods_id = request_int("gid");
		//商品detail信息
		$Goods_BaseModel = new Goods_BaseModel();
		$data['goods']   = $Goods_BaseModel->getGoodsDetailInfoByGoodId($goods_id);
		$this->data->addBody(-140, $data);
		return $data;
	}

	/**
	 * 获取店铺分类
	 *
	 * @access public
	 */
	public function getShopCat() {
		$shop_id = request_int("shop_id");
		$shopGoodCatModel = new Shop_GoodCatModel();
		$cat_row['shop_id'] = $shop_id;
		$shop_cat = $shopGoodCatModel->getGoodCatList($cat_row);

		if ('json' == $this->typ) {
			$shopBaseModel = new Shop_BaseModel();
			$shop_base = $shopBaseModel->getBase($shop_id);
			$shop_base = pos($shop_base);
			$shop_cat = array_values($shop_cat);
			$data['store_goods_class'] = $shop_cat;
			$data['shop_id'] 		   = $shop_id;
			$data['shop_name'] 		   = $shop_base['shop_name'];
			$this->data->addBody(-140, $data);
		} else {
			include $this->view->getView();
		}
	}

	/**
	 * 取得商品销售信息
	 *
	 * @access public
	 */
	public function getGoodsSaleList()
	{
		$goods_id          = request_int('goods_id');
		$YLB_Page           = new YLB_Page();
		$YLB_Page->listRows = 10;
		$rows              = $YLB_Page->listRows;
		$offset            = request_int('firstRow', 0);
		$page              = ceil_r($offset / $rows);

		$Order_GoodsModel     = new Order_GoodsModel();
		$cond_row             = array();
		$cond_row['goods_id'] = $goods_id;
		$data                 = $Order_GoodsModel->getGoodSaleList($cond_row, array('order_goods_id' => 'DESC'), $page, $rows);

		$YLB_Page->totalRows = $data['totalsize'];
		$page_nav           = $YLB_Page->ajaxprompt();

		include $this->view->getView();
	}

    /**
     * 获取商品咨询
     */
	public function getConsultListRows()
	{
		$goods_id = request_int('goods_id');

		$YLB_Page = new YLB_Page();
		$rows   = $YLB_Page->listRows;
		$offset = request_int('firstRow', 0);
		$page   = ceil_r($offset / $rows);

		$ConsultBaseModel     = new Consult_BaseModel();
		$cond_row             = array();
		$cond_row['goods_id'] = $goods_id;
		$consult_base_data    = $ConsultBaseModel->getBaseList($cond_row, array(), $page, $rows);
		$YLB_Page->totalRows = $consult_base_data['totalsize'];
		$page_nav           = $YLB_Page->ajaxprompt();

		//头部
		$Web_ConfigModel = new Web_ConfigModel();
		$head            = $Web_ConfigModel->getConfigValue('consult_header_text');

		include $this->view->getView();
	}

	/**
	 * 取得商品评价信息
	 *
	 * @access public
	 */
	public function getGoodsEvaluationList()
	{
		$common_id = request_int('common_id');
		$type     = request_string('type', 'all');
		$source   = request_string('sou', 'pc');

		if ( $this->typ == 'json' )
		{
			//wap  根据goods_id 找 common_d
			$goods_id = request_int('goods_id');
			$goodsBaseModel = new Goods_BaseModel();
			$goods_base = $goodsBaseModel->getBase($goods_id);
			$goods_base = pos($goods_base);
			$common_id = $goods_base['common_id'];
		}

		$Goods_EvaluationModel = new Goods_EvaluationModel();
		//获取商品的评价信息
		$all_count    = $Goods_EvaluationModel->countEvaluation($common_id, 'all');
		$img_count    = $Goods_EvaluationModel->countEvaluation($common_id, 'image');
		$good_count   = $Goods_EvaluationModel->countEvaluation($common_id, 'good');
		$middle_count = $Goods_EvaluationModel->countEvaluation($common_id, 'middle');
		$bad_count    = $Goods_EvaluationModel->countEvaluation($common_id, 'bad');

		if ($all_count != 0) {
			$good_pre   = round($good_count / $all_count * 100);
			$middle_pre = round($middle_count / $all_count * 100);
			$bad_pre    = round($bad_count / $all_count * 100);
		} else {
			$good_pre   = 100;
			$middle_pre = 100;
			$bad_pre    = 100;
		}


		//获取商品的评价列表
		$YLB_Page = new YLB_Page();
		$YLB_Page->listRows = 10;
		$rows   = $YLB_Page->listRows;
		$offset = request_int('firstRow', 0);
		$page   = ceil_r($offset / $rows);

		$order_row             = array();
		$cond_row['common_id']  = $common_id;
		$cond_row['status:!='] = Goods_EvaluationModel::DISPLAY;
		//$order_row['evaluation_goods_id'] = 'DESC';
		$order_row['status'] = 'DESC';

		if ( $this->typ == 'json' ) {
			$page = request_int('curpage');
//			$rows	 = request_int('page');

			switch($type) {
				case 1:
					$type = 'good';
					break;
				case 2:
					$type = 'middle';
					break;
				case 3:
					$type = 'bad';
					break;
				case 4:
					$type = 'image';
					break;
				default:
					$type = 'all';
					break;
			}
		}

		$data = $Goods_EvaluationModel->getEvaluationList($cond_row, $order_row, $page, $rows, $type);

		$YLB_Page->totalRows = $data['totalsize'];
		$page_nav  = $YLB_Page->ajaxprompt();

		if ( $source == 'wap' )
		{
			$this->data->addBody(-140, $data);
		} else {
			include $this->view->getView();
		}
	}

	/**
	 * 收藏商品
	 *
	 * @author WenQingTeng
	 */
	public function collectGoods()
	{
		$goods_id = request_int('goods_id');

		if (Perm::checkUserPerm())
		{
			$user_id = Perm::$userId;

			//用户登录情况下,插入用户收藏商品表
			$add_row = array();
			$add_row['user_id']  = $user_id;
			$add_row['goods_id'] = $goods_id;

			$User_FavoritesGoodsModel = new User_FavoritesGoodsModel();
			$User_FavoritesGoodsModel->sql->startTransactionDb();   //开启事物
			$res = $User_FavoritesGoodsModel->getFavoritesGoods($add_row);

			if ($res)
			{
				$flag = false;
				$data['msg'] = _("您已收藏过该商品！");
			} else {

				$Goods_BaseModel = new Goods_BaseModel();
				$goods_base = $Goods_BaseModel->getOne($goods_id);

                //收藏表中添加信息
                $add_row['favorites_goods_time'] = get_date_time();
                $add_row['goods_name']  = $goods_base['goods_name'];
                $add_row['goods_image'] = $goods_base['goods_image'];
                $User_FavoritesGoodsModel->addGoods($add_row);

                //商品详情中收藏数量增加
				$edit_row['goods_collect'] = '1';
				$flag = $Goods_BaseModel->editBase($goods_id, $edit_row, true);

				//商品common中
				$Goods_CommonModel = new Goods_CommonModel();
				$edit_common_row = array();
				$edit_common_row['common_collect'] = '1';
				$Goods_CommonModel = $Goods_CommonModel->editCommonTrue($goods_base['common_id'],$edit_common_row);
			}
		} else {
			$flag = false;
		}

		if ($flag && $User_FavoritesGoodsModel->sql->commitDb())
		{
			$status = 200;
			$msg = _('success');
			$data['msg'] = $data['msg'] ? $data['msg'] : _("收藏成功！");

			//删除收藏商品成功添加数据到统计中心
			$analytics_data = array(
					'product_id'=>$goods_id,
			);
			YLB_Plugin_Manager::getInstance()->trigger('analyticsProductCollect',$analytics_data);
			/******************************************************/
		} else {
			$User_FavoritesGoodsModel->sql->rollBackDb();
			$m = $User_FavoritesGoodsModel->msg->getMessages();
			$msg = $m ? $m[0] : _('failure');
			$status = 250;
			$data['msg'] = $data['msg'] ? $data['msg'] : _("收藏失败！");
		}

		$this->data->addBody(-140, $data, $msg, $status);
	}

	/**
	 * 取消收藏商品
	 *
	 * @author WenQingTeng
	 */
	public function canleCollectGoods()
	{
		$goods_id = request_int('goods_id');

		if (Perm::checkUserPerm())
		{
			$user_id = Perm::$userId;
			//用户登录情况下,删除用户收藏商品
			$fav_row = array();
			$fav_row['user_id']  = $user_id;
			$fav_row['goods_id'] = $goods_id;

			$User_FavoritesGoodsModel = new User_FavoritesGoodsModel();
			//开启事物
			$User_FavoritesGoodsModel->sql->startTransactionDb();
			$res = $User_FavoritesGoodsModel->getFavoritesGoods($fav_row);

			if ($res)
			{
				$User_FavoritesGoodsModel->removeGoods($res['favorites_goods_id']);
			}

			//商品详情中收藏数量减少
			$Goods_BaseModel = new Goods_BaseModel();
			$goods_base	= $Goods_BaseModel->getOne($goods_id);
			$edit_row = array();
			$edit_row['goods_collect'] = '-1';
			$flag = $Goods_BaseModel->editBase($goods_id, $edit_row, true);

			//商品common中收藏数量减少
			$Goods_CommonModel = new Goods_CommonModel();
			$edit_common_row = array();
			$edit_common_row['common_collect'] = '-1';
			$Goods_CommonModel = $Goods_CommonModel->editCommonTrue($goods_base['common_id'],$edit_common_row);
		} else {
			$flag = false;
		}

		if ($flag && $User_FavoritesGoodsModel->sql->commitDb())
		{
			$status = 200;
			$msg    = _('success');
		} else {
			$User_FavoritesGoodsModel->sql->rollBackDb();
			$m      = $User_FavoritesGoodsModel->msg->getMessages();
			$msg    = $m ? $m[0] : _('failure');
			$status = 250;
		}
		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);
	}

    /**
     * 根据cid spec获取商品gid
     */
	public function getGoodsIdBySpec()
	{
		$common_id = request_int('common_id');
		$spec      = request_row('spec');

		$Goods_BaseModel = new Goods_BaseModel();
		$res             = $Goods_BaseModel->getBaseSpecByCommonId($common_id);

		natsort($spec);
		$data = array();
		foreach ($res as $ke => $val)
		{
			$key = array_keys($val);
			natsort($key);
			if ($key == $spec)
			{
				$data['goods_id'] = $ke;
			}
		}

		$this->data->addBody(-140, $data);
	}

	//虚拟兑换码过期之前提醒
	public function VirtualCodeAuto()
	{
		$Goods_CommonModel = new Goods_CommonModel();
		//1.查找出过期退款的虚拟商品
		$goods_cond_row['common_is_virtual'] = Goods_CommonModel::GOODS_VIRTUAL;
		$goods_cond_row['common_virtual_refund'] =	Goods_CommonModel::GOODS_VIRTUAL_REFUND;
		$goods_cond_row['common_virtual_date:<'] = date("Y-m-d H:i:s",strtotime("+2 day"));
		$common_base = $Goods_CommonModel->getByWhere($goods_cond_row);
		$common_id = array_column($common_base,'common_id');

		//2.查找出虚拟订单中未使用的订单商品
		$order_goods_cond_row['order_goods_status'] = Order_StateModel::ORDER_WAIT_CONFIRM_GOODS;

		//3.查找出不为退款订单商品
		$order_goods_cond_row['goods_refund_status'] = Order_GoodsModel::REFUND_NO;

		$order_goods_cond_row['common_id:IN'] = $common_id;

		$Order_GoodsModel = new Order_GoodsModel();
		$order_goods = $Order_GoodsModel->getByWhere($order_goods_cond_row);

		foreach($order_goods as $key => $val)
		{
			//兑换码即将到期提醒
			//[end_time]
			$message = new MessageModel();
			$message->sendMessage('Redemption code is about to expire reminder', $val['buyer_user_id'], _('亲爱的会员'), $order_id = NULL, $shop_name = NULL, 0, 1, $end_time = $common_base[$val['common_id']]['common_virtual_date']);
		}

	}

	public function getTramsport()
	{
		$area_id = request_int('area_id');
		$common_id = request_int('common_id');

        $this->data->addBody(-140, [], 'success', 200);die;


        $goodsBaseModel = new Goods_BaseModel();
		$result = $goodsBaseModel->getTransportInfo($area_id, $common_id);
		$data = $result['data'];
		$msg = $result['msg'];
		$status = $result['status'];

		$this->data->addBody(-140, $data, $msg, $status);
	}

	/**
	 * 查询分类品牌和分类关联属性
	 * @return array
	 */
	public function getBrandAndProperty ()
	{
		$cat_id = request_int('cat_id');
		$brand_id = request_int('brand_id');
		$property_id = request_int('property_id');
		$property_value_id =request_int('property_value_id');
		$search_property = request_row('search_property');

		if ( !empty($cat_id) )
		{
			//存储查询条件
			$search_string = '';
			$property_value_ids = array();

			if ( !empty($property_id) )
			{
				$search_property[$property_id] = $property_value_id;
			}

			$goodsCatModel = new Goods_CatModel();
			$goodsTypeModel = new Goods_TypeModel();
			$goodsBrandModel = new Goods_BrandModel();

			$cata_data = $goodsCatModel->getCat($cat_id);

			$cata_data = pos($cata_data);
			$type_id = $cata_data['type_id'];

			if ($type_id)
			{
				$data = $goodsTypeModel->getTypeInfo($type_id);
			}

			if ( !empty($data['property']) )
			{
				//过滤类型为 text property
				foreach ($data['property'] as $key => $property_data)
				{
					if($property_data['property_is_display'] != Goods_PropertyModel::property_display)
					{
						unset($data['property'][$key]);
					}
					else if ( $property_data['property_format'] == 'text' || empty($property_data['property_format']) || empty($property_data['property_values']) )
					{
						unset($data['property'][$key]);
					}
					else
					{
						//拼接搜索条件
						if ( !empty($search_property[$property_data['property_id']]) )
						{
							$property_value_id = $search_property[$property_data['property_id']];

							$property_array = array();
							$property_array['property_name'] = $property_data['property_name'];
							$property_array['property_value_id'] = $property_value_id;
							$property_array['property_value_name'] = $property_data['property_values'][$property_value_id]['property_value_name'];
							$search_property[$property_data['property_id']] = $property_array;

							unset($data['property'][$key]);
						}
					}
				}

				$data['search_property'] = $search_property;

				if ( !empty($data['search_property']) )
				{
					foreach ($data['search_property'] as $property_id => $property_data)
					{
						$property_value_id = $property_data['property_value_id'];
						$string = "search_property[$property_id]=$property_value_id&";
						$search_string .= $string;

						$property_value_ids[] = $property_value_id;
					}
				}

				$data['search_string'] = $search_string;
			}

			if ( !empty($brand_id) )
			{
				unset($data['brand']);

				$data['search_string'] .= "brand_id=$brand_id&";

				$search_brand =  $goodsBrandModel->getBrand($brand_id);
				if ( !empty($search_brand) )
				{
					$data['search_brand'] = pos($search_brand);
				}

			}
			else if ( !empty($data['brand']) )
			{
				$brand_list = $goodsBrandModel->getBrand($data['brand']);

				$data['brand_list'] = $brand_list;
			}


			//过滤出所有符合筛选条件的common_id
			if ( !empty($property_value_ids) )
			{
				$this->filterBySpec($property_value_ids, $data);
				/*$condi_pro_index['property_value_id:IN'] = $property_value_ids;
				$goodsPropertyIndexModel = new Goods_PropertyIndexModel();
				$property_index_list = $goodsPropertyIndexModel->getByWhere( $condi_pro_index );
				$common_ids = array_column($property_index_list, 'common_id');

				$data['common_ids'] = $common_ids;*/
			}


			//如果有下级分类，则取出展示
			$child_cat = $goodsCatModel->getChildCat($cat_id);
			if ( !empty($cat_id) )
			{
				$data['child_cat'] = $child_cat;
			}

			return $data;
		}
	}

	//交易快照
	public function snapshot()
	{
	    if(Perm::checkUserPerm())
        {
            $order_id = request_string('order_id');
            $goods_id = request_int('goods_id');

            $Order_GoodsSnapshotModel = new Order_GoodsSnapshotModel();
            $snapshot = $Order_GoodsSnapshotModel->getByWhere(array('order_id'=>$order_id,'goods_id'=>$goods_id));

            $snapshot = current($snapshot);

            if($snapshot['user_id'] == Perm::$userId || $snapshot['shop_id'] == Perm::$shopId)
            {
                //商品详情
                $Goods_BaseModel = new Goods_BaseModel();
                $goods_base = $Goods_BaseModel->getOne($snapshot['goods_id']);

                //查找店铺信息
                $Shop_BaseModel = new Shop_BaseModel();
                $shop_detail    = $Shop_BaseModel->getShopDetail($snapshot['shop_id']);

                $Shop_CompanyModel = new Shop_CompanyModel();
                $shop_company = $Shop_CompanyModel->getOne($shop_detail['shop_id']);

                //订单信息
                $Order_BaseModel = new Order_BaseModel();
                $order_base = $Order_BaseModel->getOne($snapshot['order_id']);

                if($order_base && $order_base['shop_contract'])
                {
                    $ShopContractTypeModel = new Shop_ContractTypeModel();
                    $filed = 'contract_type_id,contract_type_name,contract_type_logo';
                    $shop_contract = $ShopContractTypeModel->select($filed,array('contract_type_id:IN'=>$order_base['shop_contract']));
                }
                include $this->view->getView();
            }
            else
            {
                location_to(YLB_Registry::get('url'));
            }

        }
	}

	/**
	 * ly
	 * wap 获取商品详情信息
	 */
	public function getCommonDetail()
	{
		$goods_id = request_int('goods_id');

		$goodsBaseModel  		= new Goods_BaseModel();
		$goodsCommonDetailModel = new Goods_CommonDetailModel();

		$goods_base = $goodsBaseModel->getBase($goods_id);
		$goods_base = pos($goods_base);

		$common_id = $goods_base['common_id'];
		$common_detail_base = $goodsCommonDetailModel->getCommonDetail($common_id);
		$common_detail_base = pos($common_detail_base);

		$data = array();
		$data['common_body'] = str_replace('type=webp', 'type=jpg', $common_detail_base['common_body']);

		$this->data->addBody(-140, $data);
	}

	/**
	 * 取得门店信息
	 *
	 * @access public
	 */
	public function getChain()
	{
		$chain_id = request_int("chain_id");
		$Chain_BaseModel=new Chain_BaseModel();
		$chan_base=current($Chain_BaseModel->getBase($chain_id));
		include $this->view->getView();
	}

	/**
	 * 取得门店
	 *
	 * @access public
	 */
	public function chain()
	{
		$district_parent_id = request_int('pid', 0);
		$Base_DistrictModel = new Base_DistrictModel();
		$district = $Base_DistrictModel->getDistrictTree($district_parent_id);

		$shop_id  = request_int("shop_id");
		$goods_id = request_int("goods_id");

		$Chain_GoodsModel = new Chain_GoodsModel();
		$chain_row['shop_id']     = $shop_id;
		$chain_row['goods_id']    = $goods_id;
		$chain_row['goods_stock:>'] = 0;

		$chain_goods = $Chain_GoodsModel->getByWhere($chain_row);

		$Chain_BaseModel = new Chain_BaseModel();
		$Chain_BaseModel->sql->setLimit(0,999999999);
		$Chain_Base = $Chain_BaseModel->getBase('*');

		$chain = array();
		foreach($chain_goods as $value)
		{
			$chain[$Chain_Base[$value['chain_id']]['chain_county_id']][]=$Chain_Base[$value['chain_id']];
		}

		$chain = json_encode($chain);

		include $this->view->getView();
	}

	private function filterBySpec($property_value_ids, &$data)
	{
		$common_ids = array();
		$condition_search = array();
		$goodsPropertyIndexModel = new Goods_PropertyIndexModel();

		foreach ($property_value_ids as $key => $property_value_id)
		{
			$condition_search['property_value_id'] = $property_value_id;

			$property_index_list = $goodsPropertyIndexModel->getByWhere( $condition_search );

			if (empty($property_index_list))
			{
				return $data['common_ids'][] = false;
			}
			else
			{
				$property_index_list = array_column($property_index_list, 'common_id');

				if ( $key == 0 )
				{
					$common_ids = $property_index_list;
				}
				else
				{
					$common_ids = array_intersect($common_ids, $property_index_list);

					if (empty($common_ids))
					{
						return $data['common_ids'][] = false;
					}
				}
			}
		}
		return $data['common_ids'] = array_values($common_ids);
	}

	//当用户点击查看商品详情时，向统计中心发送数据
	public function analytic_goods()
	{
		$goods_id = request_int('goods_id');
		$skip_url = request_string('url');
		$from = request_string('from');
		$uv = request_int('uv_num');
		$date = date("Y-m-d", strtotime(request_string('date')));
//		echo '<pre>';print_r($uv);exit;
		if($goods_id)
		{
			$Goods_Base = new Goods_BaseModel;
			$goodsbase = current($Goods_Base->getBase($goods_id));
			$analytics_data = array(
					'product_id'=>$goods_id,
					'date'=>$date,
					'url'=>$skip_url,
					'from'=>$from,
					'uv_num'=>$uv,
			);
			YLB_Plugin_Manager::getInstance()->trigger('analyticsUvCount',$analytics_data);
			/******************************************************/
		}
		else
		{
			$analytics_data = array(
					'date'=>$date,
					'url'=>$skip_url,
					'from'=>$from,
					'uv_num'=>$uv,
			);
			YLB_Plugin_Manager::getInstance()->trigger('analyticsUvCount',$analytics_data);
			/******************************************************/
		}
	}

	public function checkTask()
	{
		//需要设计规则,随机触发.

		//db需要为master
		$Base_CronModel = new Base_CronModel();
		$rows           = $Base_CronModel->checkTask();

		fb($rows);
	}

	/**
	 * 添加分享优惠Zhenzh
	 */
	public function addShare()
	{
		$data = array();
        $msg  = '';
        $status = 250;

		$cid = request_int('cid');
		$gid = request_int('gid');
		$uid = Perm::$userId;
        $bid = request_int('bid');

		if($cid)
		{
			$goodsCommonModel = new Goods_CommonModel();
			$goods_common = $goodsCommonModel->getOne($cid);
			$shop_id = $goods_common['shop_id'];

            $price_cond_row['goods_name']  = $goods_common['common_name'];
            $price_cond_row['goods_price'] = $goods_common['common_price'];
            $price_cond_row['goods_image'] = $goods_common['common_image'];
		}
		else if($gid)
		{
			$goods_model = new Goods_BaseModel();
			$goods = $goods_model -> getOne(array('goods_id'=>$gid));
			$cid = $goods['common_id'];
			$shop_id = $goods['shop_id'];

            $price_cond_row['goods_name']  = $goods['goods_name'];
            $price_cond_row['goods_price'] = $goods['goods_price'];
            $price_cond_row['goods_image'] = $goods['goods_image'];
		}
		else if($bid)
        {
            $bundlingModel = new Bundling_BaseModel();
            $bundling = $bundlingModel->getOne($bid);
            $shop_id = $bundling['shop_id'];

            $price_cond_row['goods_name'] = $bundling['bundling_name'];
            $price_cond_row['goods_price'] = $bundling['bundling_discount_price'];

            $bundlingGoodsModel = new Bundling_GoodsModel();
            $bundling_goods = $bundlingGoodsModel->getOneByWhere(array('bundling_id'=>$bid));
            $price_cond_row['goods_image'] = $bundling_goods['goods_image'];
        }

		if(($cid || $bid) && $uid)
		{
			$sharePriceModel    = new Share_PriceModel();

			if($cid)
            {
                $price_cond_row['common_id'] = $cid;
                $price_cond_row['type_id'] = Share_PriceModel::GOODS;
            }else if($bid)
            {
                $price_cond_row['b_id'] = $bid;
                $price_cond_row['type_id'] = Share_PriceModel::BUNDLING;
            }

			$price_cond_row['share_uid'] = $uid;
			$price_cond_row['shop_id'] = $shop_id;

			$order_row['id'] = 'DESC';
			$share_price_list = $sharePriceModel -> getSharePriceList($price_cond_row,$order_row,1,1);
			if($share_price_list['items'])
			{
				//已经分享过
				$share_order_id = $share_price_list['items'][0]['share_order_id'];//最近的一单订单号
				$orderBaseModel = new Order_BaseModel();
				if($share_order_id)
				{
					$order = $orderBaseModel ->getOneByWhere(array('order_id'=>$share_order_id));//最近的一单订单

					if($order['order_status'] == 1)
                    {
                        $flag = false;
                    }
					else if($order['order_status'] > 1 && $order['order_status'] < 7)
					{
						$payment_time = strtotime($order['payment_time']);
						if($payment_time > 0)//支付了
						{
							//如果超过24小时冷却时间
							if(time() > strtotime('+1 day',$payment_time))
							{
								$flag = true;
							}
						}
					}
					else
					{
						$flag = true;
					}

					if($flag)
					{
						$price_cond_row['share_date'] = time();

						$Number_SeqModel = new Number_SeqModel();
						$prefix       = sprintf('%s-', date('YmdHis'));
						$order_number = $Number_SeqModel->createSeq($prefix);

						$share_num = sprintf('%s-%s-%s', 'FX', $price_cond_row['shop_id'], $order_number);
						$price_cond_row['share_num'] = $share_num;

						$sharePriceModel->addSharePrice($price_cond_row);
						$status = 200;
						$msg= '成功';
					}
					else
					{
						$status = 250;
						$msg= '失败';
					}
				}
			}
			else
			{
				$price_cond_row['share_date'] = time();
				$Number_SeqModel = new Number_SeqModel();
				$prefix       = sprintf('%s-', date('YmdHis'));
				$order_number = $Number_SeqModel->createSeq($prefix);

				$share_num = sprintf('%s-%s-%s', 'FX', $price_cond_row['shop_id'], $order_number);
				$price_cond_row['share_num'] = $share_num;

				$sharePriceModel->addSharePrice($price_cond_row);

				$status = 200;
				$msg= '成功';
			}
		}

		$this->data->addBody(-140, $data,$msg,$status);
	}

	/**
	 * 激活分享优惠Zhenzh
	 */
	public function actShare()
	{
		$shareBaseModel = new Share_BaseModel();
		$sharePriceModel    = new Share_PriceModel();

		$gid = request_int('gid');
		$cid = request_int('cid');
		$suid = request_int('suid');
        $bid = request_int('bid');

		$type = request_string('type');
		if($type == 'app')
		{
			$stype = request_string('from');
			if($stype == 'singlemessage' || $stype == 'groupmessage')
            {
                $stype = 'weixin';
            }
            else if($stype == 'timeline')
            {
                $stype = 'weixin_timeline';
            }
		}
		else
		{
			$from = request_string('from');
			$hash = request_string('hash');

			$stype = explode('-',$hash)[1];
			if($from && $from == 'timeline')
			{
				$stype = $stype.'_timeline';
			}
		}


        if($cid)
        {
            $goodsCommonModel = new Goods_CommonModel();
            $goods_common = $goodsCommonModel->getOne($cid);
            $shop_id = $goods_common['shop_id'];

            $price_cond_row['goods_name'] = $goods_common['common_name'];
            $price_cond_row['goods_price'] = $goods_common['common_price'];
            $price_cond_row['goods_image'] = $goods_common['common_image'];
        }
        else if($gid)
        {
            $goods_model = new Goods_BaseModel();
            $goods = $goods_model -> getOne(array('goods_id'=>$gid));
            $cid = $goods['common_id'];
            $shop_id = $goods['shop_id'];

            $price_cond_row['goods_name'] = $goods['goods_name'];
            $price_cond_row['goods_price'] = $goods['goods_price'];
            $price_cond_row['goods_image'] = $goods['goods_image'];
        }
        else if($bid)
        {
            $bundlingModel = new Bundling_BaseModel();
            $bundling = $bundlingModel->getOne($bid);
            $shop_id = $bundling['shop_id'];

            $price_cond_row['goods_name'] = $bundling['bundling_name'];
            $price_cond_row['goods_price'] = $bundling['bundling_discount_price'];

            $bundlingGoodsModel = new Bundling_GoodsModel();
            $bundling_goods = $bundlingGoodsModel->getOneByWhere(array('bundling_id'=>$bid));
            $price_cond_row['goods_image'] = $bundling_goods['goods_image'];
        }

		//存在链接来源标识 sqq qzone weixin tsina
		if($stype)
		{
		    if($cid)
            {
                $share_cond_row['common_id'] = $cid;
            }
            else if($bid)
            {
                $share_cond_row['b_id'] = $bid;
            }
			$shareBase = $shareBaseModel ->getOneByWhere($share_cond_row);
			if($shareBase)
			{
				$stype_price = $shareBase[$stype];

				//标识属于sqq qzone weixin tsina
				if($stype_price)
				{
                    if($cid)
                    {
                        $price_cond_row['common_id'] = $cid;
                    }
                    else if($bid)
                    {
                        $price_cond_row['b_id'] = $bid;
                    }
					$price_cond_row['share_uid'] = $suid;
					$price_order['id'] = 'DESC';
					$share_price = $sharePriceModel -> getOneByWhere($price_cond_row,$price_order);
					//用户$suid是否已经分享过商品$gid
					if($share_price)
					{
					    $share_price_id = $share_price['id'];
						$share_order_id = $share_price['share_order_id'];//最近的一单订单号
						if($share_order_id && $share_order_id != '0' && $type = 'app')
						{
							$orderBaseModel = new Order_BaseModel();
							$order = $orderBaseModel ->getOneByWhere(array('order_id'=>$share_order_id));
							$flag = false;
                            if($order['order_status'] == 1)
                            {
                                $msg = '有待支付的订单';
                            }
                            else if($order['order_status'] > 1 && $order['order_status'] < 7 )
							{
                                $payment_time = 0;
								if($order['payment_id'] == 1)
								{
									$payment_time = strtotime($order['payment_time']);
								}
								else if($order['payment_id'] == 2)
								{
									$payment_time = strtotime($order['order_date']);
								}

								if($payment_time > 0)//支付了
								{
									//如果超过24小时冷却时间
									if(time() > strtotime('+1 day',$payment_time))
									{
										$flag = true;
									}
									else
                                    {
                                        $msg = '倒计时进行中';
                                    }
								}
							}
							else
							{
								$flag = true;
							}

							if($flag)
							{
								$price_cond_row['shop_id'] = $shop_id;
								$price_cond_row['share_date'] = time();
								$Number_SeqModel = new Number_SeqModel();
								$prefix       = sprintf('%s-', date('YmdHis'));
								$order_number = $Number_SeqModel->createSeq($prefix);
								$share_num = sprintf('%s-%s-%s', 'FX', $shop_id, $order_number);
								$price_cond_row['share_num'] = $share_num;
								$share_base[$stype] = $stype_price;
								$price_cond_row['share_base'] = $share_base;
								$price_cond_row['status'] = '1';
								$price_cond_row['price'] = array_sum($share_base);
								$price_cond_row['promotion_unit_price'] = $shareBase['promotion_unit_price'];

								$share_price_id = $sharePriceModel->addSharePrice($price_cond_row,true);
								$status = 200;
								$msg = 'app成功';
							}
							else
                            {
                                $status = 250;
                            }
						}
						else
						{
							if(empty($share_price['share_num']))
							{
								$Number_SeqModel = new Number_SeqModel();
								$prefix       = sprintf('%s-', date('YmdHis'));
								$order_number = $Number_SeqModel->createSeq($prefix);

								$share_num = sprintf('%s-%s-%s', 'FX', $share_price['shop_id'], $order_number);
								$editPrice_cond_row['share_num'] = $share_num;
							}
							//获取已经分享过的优惠信息 例{"qzone":"5","weixin":"5"}
							$share_base = $share_price['share_base'];

							if(!in_array($stype,array_keys($share_base)))
							{
								$share_base[$stype] = $stype_price;
							}
							$editPrice_cond_row['share_base'] = $share_base;
							$editPrice_cond_row['status'] = '1';
							$editPrice_cond_row['price'] = array_sum($share_base);
							$editPrice_cond_row['promotion_unit_price'] = $shareBase['promotion_unit_price'];
                            $editPrice_cond_row['promotion_total_price'] = $shareBase['promotion_total_price'];

							$sharePriceModel -> editSharePrice($share_price['id'],$editPrice_cond_row);

							$status = 200;
							$msg = '成功';
						}

						if($share_price['status'] < Share_PriceModel::FORZEN)
						{
							//添加每点击一次+0.1
							if($shareBase['is_promotion'])
							{
								$ar_price = $shareBase['promotion_unit_price'] * $share_price['promotion_click_count'];
								if($shareBase['promotion_total_price'] > $ar_price)
								{
									$share_click_model = new Share_ClickModel();
									if($cid)
                                    {
                                        $click_cond['common_id'] = $cid;
                                    }
                                    else if($bid)
                                    {
                                        $click_cond['b_id'] = $bid;
                                    }
                                    $click_cond['share_price_id'] = $share_price['id'];
									$click_cond['action_ip'] = get_ip();
									$click_cond['action_time:>'] = strtotime('-1 day',time());
									$share_click = $share_click_model ->getKeyByWhere($click_cond);

									if(!$share_click)
									{
										unset($click_cond['action_time:>']);
										$click_cond['type'] = $stype;
										$click_cond['action_time'] = time();
										$click_cond['price'] = $shareBase['promotion_unit_price']*1;
										$click_cond['share_price_id'] = $share_price_id;
										$share_click_id = $share_click_model -> addShareClick($click_cond,true);

										if($share_click_id)
										{
											$share_price_cond['promotion_click_count'] = 1;
											$sharePriceModel->editSharePrice($share_price['id'],$share_price_cond,true);
										}
									}
								}
							}
						}
					}
					else
					{
						//没分享过 是否来自app分享
						if($type == 'app')
						{
							if($cid)
                            {
                                $price_cond_row['common_id'] = $cid;
                            }
                            else if($bid)
                            {
                                $price_cond_row['b_id'] = $bid;
                            }
							$price_cond_row['share_uid'] = $suid;
							$price_cond_row['shop_id'] = $shop_id;
							$price_cond_row['share_date'] = time();
							$Number_SeqModel = new Number_SeqModel();
							$prefix       = sprintf('%s-', date('YmdHis'));
							$order_number = $Number_SeqModel->createSeq($prefix);
							$share_num = sprintf('%s-%s-%s', 'FX', $price_cond_row['shop_id'], $order_number);
							$price_cond_row['share_num'] = $share_num;

							$price_cond_row['status'] = '1';
							$share_base[$stype] = $stype_price;
							$price_cond_row['share_base'] = $share_base;
							$price_cond_row['price'] = array_sum($share_base);
							$price_cond_row['promotion_unit_price'] = $shareBase['promotion_unit_price'];
                            $price_cond_row['promotion_total_price'] = $shareBase['promotion_total_price'];

							$flag = $sharePriceModel->addSharePrice($price_cond_row);
							$status = 200;
							$msg= '成功';
						}
					}

				}
				else
				{
					$status = 250;
					$msg = '没有匹配分享项';
				}
			}
			else
			{
				$status = 250;
				$msg = '卖家未设置立减';
			}
		}
		else
		{
			$status = 250;
			$msg = '参数错误';
		}


		$this->data->addBody(-140, array(),$msg,$status);

	}

    /**
     * 操作
     * 新增送福免单记录
     * Zhenzh 20180704
     */

    public function addFu()
    {
        $gid = request_int('gid',request_int('goods_id'));
        $uid = Perm::$userId;
        $type = request_string('type');

        $flag = false;
        $msg  = 'fail';
        if($uid)
        {
            $Cache = YLB_Cache::create('base');
            $cache_key = 'add_fu|' . $uid;
            if ($data = $Cache->get($cache_key))
            {
                $last_time = current($data);
                if ($last_time + 1 <= time())
                {
                    YLB_Log::log("a=gid=$gid,uid=$uid,last_time=$last_time,time=".time(),YLB_Log::INFO,'addFuRecord');
                    $data = [$cache_key=>time()];
                    $Cache->save($data, $cache_key);
                }
                else
                {
                    YLB_Log::log("b=gid=$gid,uid=$uid,last_time=$last_time,time=".time(),YLB_Log::INFO,'addFuRecord');
                    $this->data->addBody(-140,[],'不能频繁访问哦',250);
                    return false;
                }
            }
            else
            {
                $data = [$cache_key=>time()];
                $Cache->save($data, $cache_key);
            }

            $FuBaseModel = new Fu_BaseModel();
            $fu_base = $FuBaseModel->checkFu($gid,$uid);

            if($fu_base && $fu_base['status'] == 0)
            {
                //自己的商品就不要添加福了
                if(!Perm::$shopId || (Perm::$shopId && Perm::$shopId != $fu_base['shop_id']))
                {
                    $FuRecordModel = new Fu_RecordModel();
                    $FuRecordModel->sql->startTransactionDb();

                    $sql = 'SELECT COUNT(*) FROM `ylb_fu_record` a LEFT JOIN `ylb_order_base` b ';
                    $sql .= 'ON a.order_id = b.order_id ';
                    $sql .= 'WHERE a.goods_id = ' . $gid . ' AND a.user_id = ' . $uid .' AND a.order_id <> "" ';
                    $sql .= 'AND b.`order_status` >= '. Order_StateModel::ORDER_WAIT_PAY .' AND b.`order_status` <= '. Order_StateModel::ORDER_WAIT_CONFIRM_GOODS;

                    $row_count = $FuRecordModel->selectSql($sql);
                    if ($row_count)
                    {
                        $row_count = current($row_count);
                        $row_count = array_shift($row_count);
                    }

                    $cond_row['goods_id']      = $gid;
                    $cond_row['user_id']       = $uid;
                    $cond_row['fu_id']         = $fu_base['fu_id'];
                    $cond_row['shop_id']       = $fu_base['shop_id'];
                    $cond_row['fu_end_time:>'] = get_date_time();
                    $cond_row['status:<']      = Fu_RecordModel::USED;
                    $fu_record_id = $FuRecordModel->getKeyByWhere($cond_row);

                    $type_row = ['weixin','weixin_timeline','sqq','qzone','tsina'];

                    if(in_array($type,$type_row))
                    {
                        $fu_share_base = ['weixin'=>0,'weixin_timeline'=>0,'sqq'=>0,'qzone'=>0,'tsina'=>0];
                        if($fu_record_id)
                        {
                            $msg = '送福正在进行中';

                            $fu_record = $FuRecordModel->getOne($fu_record_id);
                            if (isset($fu_record['fu_share_base']) && $fu_record['fu_share_base'][$type] == '0')
                            {
                                $fu_record['fu_share_base'][$type] = 1;
                                $flag = $FuRecordModel->editFuRecord($fu_record['fu_record_id'],['fu_share_base'=>$fu_record['fu_share_base']]);
                            }
                        }
                        else
                        {
                            if ($row_count)
                            {
                                $msg = '有包含此商品的订单未完成';
                            }
                            else
                            {
                                unset($cond_row['fu_end_time:>']);
                                unset($cond_row['status:<']);
                                $cond_row['user_name']      = Perm::$row['user_account'];
                                $cond_row['unit_price']     = $fu_base['fu_t_price'];
                                $cond_row['fu_record_time'] = get_date_time();
                                $cond_row['fu_end_time']    = date('Y-m-d H:i:s',strtotime($cond_row['fu_record_time'] . '+1 day'));
                                $cond_row['fu_base']        = $fu_share_base;
                                $fu_share_base[$type]       = 1;
                                $cond_row['fu_share_base']  = $fu_share_base;

                                $flag = $FuRecordModel->addFuRecord($cond_row);
                            }
                        }

                        if ($flag && $FuRecordModel->sql->commitDb())
                        {

                        }
                        else
                        {
                            $FuRecordModel->sql->rollBackDb();
                            $flag = false;
                        }
                    }
                    else
                    {
                        $msg = '分享渠道不正确';
                    }
                }
                else
                {
                    $msg = '自己的商品就不要添加福了';
                }
            }
            else
            {
                $msg = $fu_base['status'] ? $fu_base['msg'] : '该商品没有参加送福免单';
            }
        }
        else
        {
            $msg = '用户不存在';
        }

        if($flag)
        {
            $status = 200;
            $msg = 'success';
        }
        else
        {
            $status = 250;
            $msg = $msg ? $msg : 'fail';
        }

        if('json' == $this->typ)
        {
            $this->data->addBody(-140,[],$msg,$status);
        }
    }

    /**
     * 操作
     * 激活送福免单记录
     * Zhenzh 20180704
     */
	public function activeFu()
    {
        $data = [];
        $flag = false;
        $gid  = request_int('gid');
        $uid  = request_int('suid');
        $type = request_string('type');

        if($type == 'app')
        {
            $stype = request_string('from');
            if($stype == 'singlemessage' || $stype == 'groupmessage')
            {
                $stype = 'weixin';
            }
            else if($stype == 'timeline')
            {
                $stype = 'weixin_timeline';
            }
        }
        else
        {
            $from = request_string('from');
            $hash = request_string('hash');

            $stype = explode('-',$hash)[1];
            if($from && $from == 'timeline')
            {
                $stype = $stype.'_timeline';
            }
        }

        if($gid && $uid && $stype)
        {
            //获取正常状态的fu_base
            $FuBaseModel = new Fu_BaseModel();
            $fu_base = $FuBaseModel->checkFu($gid,$uid);

            if($fu_base && $fu_base['status'] == 0 && $fu_base['fu_base'] && $fu_base['fu_base'][$stype])
            {
                $FuRecordModel = new Fu_RecordModel();
                $cond_row['goods_id'] = $gid;
                $cond_row['user_id'] = $uid;
                $cond_row['fu_id'] = $fu_base['fu_id'];
                $cond_row['status'] = Fu_RecordModel::NORMAL;
                $cond_row['fu_end_time:>'] = get_date_time();

                $fu_record = $FuRecordModel->getOneByWhere($cond_row);

                if($fu_record)
                {
                    $fu_record_count = 0;
                    if(isset($fu_record['fu_base']) && isset($fu_record['fu_base'][$stype]))
                    {
                        $fu_record_count = $fu_record['fu_base'][$stype];
                    }

                    if($fu_record_count < $fu_base['fu_base'][$stype])
                    {
                        if($fu_base['is_register'])
                        {
                            if(!Perm::$userId)
                            {
                                $fuserialize = $fu_record['fu_record_id'] . '/' . $stype;
                                setcookie('fuserialize',$fuserialize,time() + 60 * 60 * 24 * 3,'/');

                                switch ($stype)
                                {
                                    case 'tsina':
                                        $s_type = 1;
                                        break;
                                    case 'sqq':
                                    case 'qzone':
                                        $s_type = 2;
                                        break;
                                    case 'weixin':
                                    case 'weixin_timeline':
                                        $s_type = 3;
                                        break;
                                    default:
                                        $s_type = 0;
                                }

                                $flag = true;
                                $data['reg_type'] = $s_type;
                                $data['gid']      = $gid;
                            }
                        }
                        else
                        {
                            $flag = $FuRecordModel->editFuRecordCount($fu_record,$stype,$fu_record_count,$fu_base['fu_total_times'],$fu_base['fu_stock']);
                        }
                    }
                }
            }
        }

        if($flag)
        {
            $status = 200;
            $msg = 'success';
        }
        else
        {
            $status = 250;
            $msg = 'fail';
        }

        $this->data->addBody(-140,$data,$msg,$status);
    }

    /**
     * 根据goods_id获取其参加的所有优惠套装 Zhenzh 20171116
     */
    public function getGoodsBundling()
    {
        $goods_id  = request_int('gid', request_int('goods_id'));
        $Promotion = new Promotion();
        $data      = $Promotion->getBundlingInfoByGoodsId($goods_id);

        if ('json' == $this->typ)
        {
            $this->data->addBody(-140, $data);
        }
        else
        {
            include $this->view->getView();
        }
    }

    /**
     * 套餐详情页 Zhenzh 20171218修改
     */
    public function bundling()
    {
        $data      = array();
        $bid = request_int('bid');
        if($bid)
        {
            $bundlingBaseModel = new Bundling_BaseModel();
            $cond_row['bundling_id'] = $bid;
            $cond_row['bundling_state'] = Bundling_BaseModel::NORMAL;
            $data = $bundlingBaseModel->getBundlingDetailInfo($cond_row);

            if($data)
            {
                $shop_id = $data['shop_id'];

                if(Perm::$shopId && Perm::$shopId == $shop_id )
                {
                    $data['shop_owner'] = true;
                }
                else
                {
                    $data['shop_owner'] = false;
                }
            }
            else
            {
                if($this->typ == 'json')
                {
                    $this->data->addBody(-1,array(),'抱歉，该套餐已下架或者该店铺已关闭',250);return;
                }
                else
                {
                    $msg = '抱歉，该套餐已下架或者该店铺已关闭';
                    $this->view->setMet('404');
                }
            }
        }

        if ('json' == $this->typ)
        {
            $this->data->addBody(-140, $data);
        }
        else
        {
            $Shop_BaseModel = new Shop_BaseModel();
            $shop_detail    = $Shop_BaseModel->getShopDetail($shop_id);

            //看了又看
            $Goods_CommonModel   = new Goods_CommonModel();
            $data_recommon       = $Goods_CommonModel->listByWhere(array('shop_id' => $shop_id), array('common_is_recommend' => 'desc','common_sell_time' => 'desc'), 0, 4);
            $data_recommon_goods = $Goods_CommonModel->getRecommonRow($data_recommon);

            //热门销售
            $data_hot_salle = $Goods_CommonModel->getHotSalle($shop_id);
            $data_salle     = $Goods_CommonModel->getRecommonRow($data_hot_salle);

            //热门收藏
            $data_hot_collect = $Goods_CommonModel->getHotCollect($shop_id);
            $data_collect     = $Goods_CommonModel->getRecommonRow($data_hot_collect);

            $this->shopCustomServiceModel = new Shop_CustomServiceModel;
            $cond_row['shop_id'] = $shop_id;
            $service = $this->shopCustomServiceModel->getServiceList($cond_row);

            if($service['items'])
            {
                foreach($service['items'] as $key => $val)
                {
                    //QQ
                    if($val['tool'] == 1)
                    {
                        $service[$key]["tool"] = "<a target='_blank' href='http://wpa.qq.com/msgrd?v=3&uin=".$val['number']."&site=qq&menu=yes'><img border='0' src='http://wpa.qq.com/pa?p=2:".$val['number'].":41 &amp;r=0.22914223582483828' alt='点击这里'></a>";
                    }
                    //旺旺
                    if($val['tool'] == 2)
                    {
                        $service[$key]["tool"] = "<a target='_blank' href='http://www.taobao.com/webww/ww.php?ver=3&amp;touid=".$val['number']."&amp;siteid=cntaobao&amp;status=1&amp;charset=utf-8' ><img border='0' src='http://amos.alicdn.com/online.aw?v=2&amp;uid=".$val['number']."&amp;site=cntaobao&s=1&amp;charset=utf-8' alt='点击这里' /></a>";
                    }
                    //IM
                    if($val['tool'] ==3)
                    {
                        $service[$key]["tool"] = '<a href="javascript:;" class="chat-enter" rel="'.$val['number'].'" ><img src="'.$this->view->img.'/icon-im.gif" alt=""></a>';
                    }
                    $service[$key]["number"] = $val['number'];
                    $service[$key]["name"] = $val['name'];
                    $service[$key]["id"] = $val['id'];

                    if($val['type']==1)
                    {
                        $de['after'][] = $service[$key];
                    }
                    else
                    {
                        $de['pre'][] = $service[$key];
                    }
                }
                $service = $de;
            }

            include $this->view->getView();
        }
    }

    /**
     * 获取优惠套餐套餐Zhenzh
     */
    public  function getBundlingById()
    {
        $data = array();
        $b_id     = request_int('bid');

        $bundlingBaseModel = new Bundling_BaseModel();
        $bundling = $bundlingBaseModel->getOne($b_id);

        if($bundling)
        {
            if($bundling['bundling_state'] == Bundling_BaseModel::NORMAL)
            {
                $data['bundling_name'] = $bundling['bundling_name'];
                $data['bundling_discount_price'] = $bundling['bundling_discount_price'];
                $data['bundling_freight_choose'] = $bundling['bundling_freight_choose'];
                $data['bundling_freight'] = $bundling['bundling_freight'];
                if(Perm::$shopId && Perm::$shopId == $bundling['shop_id'] )
                {
                    $data['shop_owner'] = true;
                }
                else
                {
                    $data['shop_owner'] = false;
                }

                $bundlingGoodsModel = new Bundling_GoodsModel();
                $bundling_goods_data = $bundlingGoodsModel->getBundlingGoodsByWhere(array('bundling_id'=>$b_id));

                $price = array_sum(array_column($bundling_goods_data,'bundling_goods_price'));
                $old_price = array_sum(array_column($bundling_goods_data,'goods_price'));

                if(number_format($data['bundling_discount_price'],2) == number_format($price,2))
                {
                    $data['old_price'] = $old_price;
                    $data['save_price'] = number_format($old_price - $price,2,',','');
                    $data['goods_list'] = $bundling_goods_data;

                    $shareBaseModel = new Share_BaseModel();
                    $share_info = $shareBaseModel->getShareByBId($b_id);
                    if($share_info)
                    {
                        $data['share_info'] = $share_info;
                    }
                }
                else
                {
                    unset($data);
                    $data['msg'] = '数据有误';
                }
            }
        }

        if ('json' == $this->typ)
        {
            $this->data->addBody(-140, $data);
        }
        else
        {
            include $this->view->getView();
        }

    }

    /**
     * 获取热卖商品Zhenzh
     */
    public function getHotGoods()
    {
        $YLB_Page           = new YLB_Page();
        $YLB_Page->listRows = request_int('listRows')?request_int('listRows'):20;
        $rows              = $YLB_Page->listRows;
        $offset            = request_int('firstRow', 0);
        $page              = ceil_r($offset / $rows);

        $goodsCommonModel = new Goods_CommonModel();
        $cond_row['common_state'] = Goods_CommonModel::GOODS_STATE_NORMAL;
        $cond_row['shop_status']   = Shop_BaseModel::SHOP_STATUS_OPEN;
        $order_row['common_salenum'] = 'desc';

        $data = $goodsCommonModel->getCommonList($cond_row,$order_row,$page,$rows);

        foreach ($data['items'] as $key=>$value)
        {
            $goods_id = $goodsCommonModel->getNormalStateGoodsId($value['common_id']);
            $data['items'][$key]['goods_id'] = $goods_id;
        }

        $YLB_Page->totalRows      = $data['totalsize'];
        $page_nav                 = $YLB_Page->prompt();

        $this->data->addBody(-140, $data);
    }

	/**
	 * 获取热销商品，web端使用
	 * @param string $dataType ： 要获取的数据类型common_salenum => 热销 ,common_collect => 收藏
	 * @param int $catId ： 分类id，默认为全部商品
	 * @param int $nums :  要获取的商品数量，热销默认为3条，收藏排行默认为9条
	 * @return array
	 * @liuguilong 20170718
	 */
	public function getGoodsHotList(){
		$catId = request_int('catId');

		//根据catID 获取该分类下全部的子分类id
		if($catId && $catId != 0){
			$Goods_CatModel = new Goods_CatModel();
			$catIds = $Goods_CatModel->getCatChildId($catId);
		}else{
			$catIds = array();
		}
		$page = request_int('page');
		$nums = request_int('nums');
		$dataType = request_string('dataType');  //取得要获取的数据类型common_salenum => 热销 ,common_collect => 收藏
		$Goods_CommonModel = new Goods_CommonModel();
		$data = $Goods_CommonModel->getGoodsHotList($dataType,$catIds,$page,$nums);
		$data = $data['items'];

		//一条goods_common数据 可能包含多条goods_id数据，从此common_id中的goods_id中选择一个有效的goods_id
		foreach($data as $k=>$v){
			$cond_row['common_id'] = $v['common_id'];
			$res = $Goods_CommonModel->getGoodsList($cond_row);
			$data[$k]['common_goods_id'] = $res['items'][0]['goods_id'];
		}

		//根据用户id，获取该用户收藏的商品id
		$User_FavoritesGoodsModel = new User_FavoritesGoodsModel();
		$user_likes = array();		//用户收藏商品id数组 goods_id
		if(Perm::checkUserPerm()){
			$user_favorite_row = $User_FavoritesGoodsModel->getByWhere(array('user_id'=>Perm::$userId));

			//闭包函数，获取 $user_favorite_row 中的所有goods_id
			$column_key = 'goods_id';
			$user_likes = array_map(function($arr) use ($column_key){
				if(!isset($arr[$column_key])){
					return null;
				}
				return $arr[$column_key];
			},$user_favorite_row);
		}

		//遍历数据，判断该商品是否被收藏过
		foreach($data as $key=>$val){
			if(in_array($val['common_goods_id'],$user_likes)){
				$data[$key]['is_liked'] = "1";
			}else{
				$data[$key]['is_liked'] = "0";
			}
		}

		//判断商品所在的店铺是否参加了满减送活动
		$manModel = new ManSong_BaseModel();
		foreach($data as $key0=>$val0){
			$manArr = $manModel->getManSongByWhere(array('shop_id'=>$val0['shop_id']));
			if(count($manArr) > 0){
				$data[$key0]['is_man'] = 1;        //1 为参加了满减送活动
			}else{
				$data[$key0]['is_man'] = 0;        //0 为未参加满减活动
			}
		}

		$this->data->addBody(140,$data);
	}

    //yang   家有儿女接口
    public function  sonanddaughter(){
        if('json' == $this->typ) {
            $goodsCatModel = new Goods_CatModel();
            $Adv_ConModel = new Operation_AdvertisementModel();
            $adv_con = $Adv_ConModel->getAdvList(array('group_id' => Operation_AdvertisementModel::$adv_id['jyev']));

            //导航栏
            $fl_sql = "select gc.goods_cat_nav_name as name,gc.goods_cat_id as cat_id,cat.cat_pic as pic from ylb_goods_cat as cat LEFT JOIN ylb_goods_cat_nav gc ON cat.cat_id = gc.goods_cat_id where cat.cat_parent_id = 0";
            $sift['nav']['items'] = $goodsCatModel->sql($fl_sql);
            $sift['adv'] = $adv_con;
            $this->data->addBody(-140, $sift);
        } else {
            $this->data->addBody('出错了哦，亲');
        }
    }
    //yang   家有儿女接口
    public function sonanddaughter_row(){
        if('json' == $this->typ) {
            $nav = request_int('nav');
            $goodsCatModel = new Goods_CatModel();
            $goodsCommonModel = new Goods_CommonModel();
            $User_FavoritesGoodsModel = new User_FavoritesGoodsModel();
//                //大分类
//            if($nav && $nav != 0){
//                $Goods_CatModel = new Goods_CatModel();
//                $catIds = $Goods_CatModel->getCatChildId($nav);
//            }else{
//                $catIds = array();
//            }
            //分类查询
            if ($nav) {
                $cat = $goodsCatModel->getCatChildId($nav);
            }

            $user_id = Perm::$userId;
            if($cat){
                $cond_row['cat_id:IN'] = $cat;
            }else{
                $cond_row = array();
            }
            $rows['user_id'] = $user_id;
//            common_salenum
            //销量排序
            $cond_row['common_state'] = 1;
            $xl_order_row['common_salenum'] = 'desc';
            $data['xl_res'] = $goodsCommonModel->listByWhere($cond_row,$xl_order_row,'1',$row=10);
            foreach($data['xl_res']['items'] as $k =>$v){
                $rows['xl_res']['items'][$k]['common_salenum'] = $v['common_salenum'];
                $rows['xl_res']['items'][$k]['common_name'] = $v['common_name'];
                $rows['xl_res']['items'][$k]['common_image'] = $v['common_image'];
                $rows['xl_res']['items'][$k]['common_id'] = $v['common_id'];
            }

//            //一条goods_common数据 可能包含多条goods_id数据，从此common_id中的goods_id中选择一个有效的goods_id
//            foreach($data as $k=>$v){
//                $cond_row['common_id'] = $v['common_id'];
//                $res = $Goods_CommonModel->getGoodsList($cond_row);
//                $data[$k]['common_goods_id'] = $res['items'][0]['goods_id'];
//            }

            //收藏排序
            $sc_order_row['common_collect'] = 'desc';
            $data['sc_res'] = $goodsCommonModel->listByWhere($cond_row,$sc_order_row,'',$row=10);
            foreach($data['sc_res']['items'] as $k =>$v){
                //一条goods_common数据 可能包含多条goods_id数据，从此common_id中的goods_id中选择一个有效的goods_id
                $cond_rows['common_id'] = $v['common_id'];
                $res = $goodsCommonModel->getGoodsList($cond_rows);
                $rows['sc_res']['items'][$k]['goods_id'] = $res['items'][0]['goods_id'];
                $fg['goods_id'] = $res['items'][0]['goods_id'];
                $fg['user_id'] = $user_id;
                $order_row = array();
                //查询收藏
                $sc_res = $User_FavoritesGoodsModel->getKeyByWhere($fg, $order_row);
                if ($sc_res) {
                    $rows['sc_res']['items'][$k]['sc_status'] = 1;
                } else {
                    //收藏状态0
                    $rows['sc_res']['items'][$k]['sc_status'] = 0;
                }
                $rows['sc_res']['items'][$k]['cat_id'] = $v['cat_id'];
                $rows['sc_res']['items'][$k]['common_name'] = $v['common_name'];
                $rows['sc_res']['items'][$k]['common_image'] = $v['common_image'];
                $rows['sc_res']['items'][$k]['common_shared_price'] = $v['common_shared_price'];
                $rows['sc_res']['items'][$k]['common_collect'] = $v ['common_collect'];
                $rows['sc_res']['items'][$k]['common_promotion_type'] = $v['common_promotion_type'];
//                $rows['sc_res']['items'][$k]['goods_id'] = $v['goods_id'];
                $rows['sc_res']['items'][$k]['common_id'] = $v['common_id'];
                $rows['sc_res']['items'][$k]['common_share_price'] = $v['common_share_price'];
                $rows['sc_res']['items'][$k]['common_promotion_price'] = $v['common_promotion_price'];
                $rows['sc_res']['items'][$k]['common_promotion_type'] = $v['common_promotion_price'];
                $rows['sc_res']['items'][$k]['common_is_tuan'] = $v['common_is_tuan'];
                $rows['sc_res']['items'][$k]['common_is_xian'] = $v['common_is_xian'];
                $rows['sc_res']['items'][$k]['common_is_jia'] = $v['common_is_jia'];
            }
            //分割分类id
            if($cat){
                $cat_ids_str = implode(',',$cat);

                $sql = "SELECT a.common_id,a.goods_id,a.goods_name,a.goods_image,count(a.scores) scores,b.common_shared_price,b.common_collect,b.common_promotion_type,b.common_share_price,b.common_promotion_price,b.common_promotion_price,b.common_is_jia FROM ylb_goods_evaluation a RIGHT JOIN ylb_goods_common b ON a.common_id=b.common_id WHERE b.cat_id IN (".$cat_ids_str.") AND a.result='good'GROUP BY a.common_id ORDER BY scores DESC";

            }else{
                $sql = "SELECT a.common_id,a.goods_id,a.goods_name,a.goods_image,count(a.scores) scores,b.common_shared_price,b.common_collect,b.common_promotion_type,b.common_share_price,b.common_promotion_price,b.common_promotion_price,b.common_is_jia FROM ylb_goods_evaluation a RIGHT JOIN ylb_goods_common b ON a.common_id=b.common_id WHERE  a.result='good' GROUP BY a.common_id ORDER BY scores DESC";
            }
            $data_c = $goodsCommonModel->sql($sql);
//            select a.common_id,count(a.scores) scores,b.common_id from ylb_goods_evaluation as a RIGHT JOIN ylb_goods_common as b ON a.common_id=b.common_id  WHERE result='good' GROUP BY a.common_id ORDER BY scores DESC

            if($data_c)
            {
                $rows['pl_res']['items'] = $data_c;
                //执行sql
                foreach ($rows['pl_res']['items'] as $k =>$v) {
                    $fg['goods_id'] = $v['goods_id'];
                    $fg['user_id'] = $user_id;
                    $order_row = array();
                    //查询user_id    goods_id收藏
                    $sc_res = $User_FavoritesGoodsModel->getKeyByWhere($fg, $order_row);
                    if ($sc_res) {
                        $rows['pl_res']['items'][$k]['pl_status'] = 1;
                    } else {
                        //收藏状态0
                        $rows['pl_res']['items'][$k]['pl_status'] = 0;
                    }
                }
            }

            if($rows){
                $msg = _('success');
                $status = 200;
            } else {
                $msg = _('failure');
                $status = 250;
            }
        }
        $this->data->addBody(-140, $rows,$msg,$status);
    }

	/**
	 * 获取猜你喜欢商品 2
	 */
	public function getLikeGoods()
	{
		$YLB_Page = new YLB_Page();
		$YLB_Page->listRows = request_int('listRows')?request_int('listRows'):20;
		$rows = $YLB_Page->listRows;
		$offset = request_int('firstRow', 0);
		$page = ceil_r($offset / $rows);

		$goodsCommonModel = new Goods_CommonModel();
		$cond_row['common_state'] = Goods_CommonModel::GOODS_STATE_NORMAL;
		$cond_row['shop_status']   = Shop_BaseModel::SHOP_STATUS_OPEN;
		$order_row['common_salenum'] = 'desc';

		$data = $goodsCommonModel->getCommonList($cond_row,$order_row,$page,$rows);

		foreach ($data['items'] as $key=>$value)
		{
			$goods_id = $goodsCommonModel->getNormalStateGoodsId($value['common_id']);
			$data['items'][$key]['goods_id'] = $goods_id;
		}

		$YLB_Page->totalRows      = $data['totalsize'];
		$page_nav                 = $YLB_Page->prompt();

		$this->data->addBody(-140, $data);
	}

	public function getGoodsTitle()
    {
        $data = array();
        $Goods_CommonModel = new Goods_CommonModel();
        $goodsBaseModel    = new Goods_BaseModel();

        $common_id = request_int('cid',request_int('common_id'));
        $goods_id = request_int('gid', request_int('goods_id'));
        //如果传递过来的是common_id，则从此common_id中的goods_id中选择一个有效的goods_id
        if($common_id && !$goods_id)
        {
            $goods_common = $Goods_CommonModel->getOne($common_id);
            $goods_id     = $Goods_CommonModel->getNormalStateGoodsId($common_id);
        }

        if($goods_id)
        {
            $goods_base = $goodsBaseModel->getOne($goods_id);
            if(!$goods_common)
            {
                $goods_common = $Goods_CommonModel->getOne($goods_base['common_id']);
            }
        }

        $goods_base = $Goods_CommonModel->getGoodsSpec($goods_base,$goods_common);

        if($goods_base)
        {
            $data['goods_id']           = $goods_id;
            $data['goods_name']         = $goods_base['goods_name'];
            $data['goods_price']        = $goods_base['goods_price'];
            $data['goods_shared_price'] = $goods_base['goods_shared_price'];
            $data['goods_image']        = $goods_base['goods_image'];
            $data['spec_str']           = $goods_base['spec_str'];

            if($goods_common['common_promotion_type'] > 0)
            {
                $Promotion = new Promotion();
                $promotion = $Promotion->getGoodsPromotion($goods_id,$goods_base['common_id'],$goods_common['common_promotion_type']);

                if($promotion && $promotion['promotion']['promotion_price'])
                {
                    $data['goods_price'] = $promotion['promotion']['promotion_price'];
                }
            }

            $status = 200;
            $msg = 'success';
        }
        else
        {
            $status = 250;
            $msg = '错误';
        }

        if($this->typ == 'json')
        {
            $this->data->addBody(-140,$data,$msg,$status);
        }


    }

    /**
     * 获取包邮商品 查找商品绑定的运费模版里有首重为0的
     * Zhenzh 20180614
     */
    public function getGoodsFree()
    {
        $page   = request_string('page',1);
        $rows   = request_string('rows',10);
        $offset = $rows * ($page - 1);

        $order_by = request_string('order_by');
        $order_sort = request_string('order_sort','DESC');
        $price_from = request_string('price_from');
        $price_to = request_string('price_to');
        $own_shop = request_string('own_shop');
        $promotion = request_string('promotion');

        $GoodsCommonModel = new Goods_CommonModel();
        $sql = 'SELECT common_id,goods_id, common_name,common_image, common_price, common_salenum, common_evaluate ,common_is_jia,common_promotion_type,common_share_price, common_is_promotion, common_promotion_price, common_shared_price FROM '.TABEL_PREFIX.'goods_common a INNER JOIN '.TABEL_PREFIX.'transport_items b ON a.transport_type_id = b.transport_type_id WHERE a.shop_status = 3 AND a.common_state = 1 AND `shop_self_support` = 1 AND b.transport_item_default_price = 0 ';

        $sql2 = 'SELECT COUNT(*) row_count FROM '.TABEL_PREFIX.'goods_common a INNER JOIN '.TABEL_PREFIX.'transport_items b ON a.transport_type_id = b.transport_type_id WHERE a.shop_status = 3 AND a.common_state = 1 AND `shop_self_support` = 1 AND b.transport_item_default_price = 0 ';

        if($price_from)
        {
            $sql .= " AND a.common_price >= $price_from ";
            $sql2 .= " AND a.common_price >= $price_from ";
        }
        if($price_to)
        {
            $sql .= " AND a.common_price <= $price_to ";
            $sql2 .= " AND a.common_price <= $price_to ";
        }
        if($promotion)
        {
            $sql .= " AND a.common_promotion_type > 0 ";
            $sql2 .= " AND a.common_promotion_type > 0 ";
        }
        if($order_by)
        {
            if($order_by == 'sale')
            {
                $order_by = 'common_salenum';
            }
            else if($order_by == 'share')
            {
                $order_by = 'common_share_price';
            }
            else if($order_by == 'price')
            {
                $order_by = 'common_price';
            }
            else if($order_by == 'evaluate')
            {
                $order_by = 'common_evaluate';
            }
            else if($order_by == 'time')
            {
                $order_by = 'common_add_time';
            }
        }
        else
        {
            $order_by = 'common_add_time';
        }
        $sql .= " ORDER By $order_by $order_sort";

        $sql .= " LIMIT $offset,$rows";

        $row = $GoodsCommonModel->selectSql($sql);

        foreach ($row as $key => $value)
        {
            $goods_id = decode_json($value['goods_id']);

            if(is_array($goods_id))
            {
                if(isset($goods_id['goods_id']))
                {
                    $row[$key]['goods_id'] = $goods_id['goods_id'];
                }
                else
                {
                    $row[$key]['goods_id'] = $goods_id[0]['goods_id'];
                }
            }
        }

        $total = 0;
        $row_count = $GoodsCommonModel->selectSql($sql2);
        if($row_count)
        {
            $row_count = current($row_count);
            $total = ceil($row_count['row_count']/$rows);
        }

        $data['page']  = $page;
        $data['total'] = $total;
        $data['items'] = $row;

        $Adv_ConModel = new Operation_AdvertisementModel();
        $adv = $Adv_ConModel->getAdvList(array('group_id' => Operation_AdvertisementModel::$adv_id['hwby']));
        $data['adv'] = $adv['items'];
        if('json' == $this->typ)
        {
            $this->data->addBody(-140,$data);
        }
        else
        {
            include $this->view->getView();
        }
    }

    /*
 * 他人淘金商店
 */
    public function others()
    {
        $YLB_Page           = new YLB_Page();
        $YLB_Page->listRows = 20;
        $rows              = request_int('rows',8);
        $page              = request_int('page',1);


        $uid = request_int('uid');
        $sort    = request_string('sort');

        $cond_row['directseller_id'] = $uid;
        $cond_row['directseller_enable'] = 1;
        $Distribution_ShopDirectsellerModel = new Distribution_ShopDirectsellerModel();
        $shops = $Distribution_ShopDirectsellerModel->getByWhere($cond_row);
        $shop_ids = array_column($shops,'shop_id');

        $cond_good_row['shop_id:in'] = $shop_ids;
        $cond_good_row['common_is_directseller'] = 1;
        if(request_string('keywords'))
        {
            $cond_good_row['common_name:LIKE'] = '%'.request_string('keywords').'%'; //商品名称搜索
        }



        $act       = request_string('act');
        $actorder    = request_string('actorder','DESC');

        if ($act!=='')
        {
            //销量
            if ($act == 'sales')
            {
                $order_row['common_salenum'] = $actorder;
            }

            //佣金排序
            if ($act == 'price')
            {
                if(request_string('actorder'))
                {
                    $order_row['common_promotion_price'] = $actorder;
                }
                else
                {
                    $order_row['common_promotion_price'] = 'DESC';
                }
            }

            //时间排序
            if ($act == 'uptime')
            {
                $order_row['common_add_time'] = $actorder;
            }

        }
        else
        {
            $order_row['common_id'] = 'DESC';
        }

        //获取推广商品
        $data = array();
        $Goods_CommonModel = new Goods_CommonModel();
        $data = $Goods_CommonModel->getCommonList($cond_good_row,$order_row, $page, $rows);
        $User_InfoMoerl = new User_InfoModel();
        $data['user_id'] = $uid;
        $cond['user_id'] = $uid;
        $user_info = $User_InfoMoerl->getOne($cond);
        $data['shop']['user_name'] = $user_info['user_name'];


        //获取店铺名称
        $data['shop'] = $Distribution_ShopDirectsellerModel->getOneByWhere(array('directseller_id'=>$uid));
        if(!$data['shop']['directseller_shop_name']){
            $data['shop']['directseller_shop_name'] = $user_info['user_directseller_shop'];
        }
        $data['shop_qrcode'] = YLB_Registry::get('base_url')."/shop/api/qrcode.php?data=".urlencode(YLB_Registry::get('shop_wap_url')."/tmpl/member/directseller_store.html?uid=".$uid);
        $YLB_Page->totalRows = $data['totalsize'];
        $page_nav           = $YLB_Page->prompt();

        if ($this->typ == "json")
        {
            $this->data->addBody(-140, $data);
        }
        else
        {
            include $this->view->getView();
        }


    }

    /**
     * @param $str
     * @param bool $do_fork  岐义处理
     * @param bool $do_unit  新词识别
     * @param bool $do_multi 多元切分
     * @param bool $do_prop  词性标注
     * @param bool $pri_dict 是否预载全部词条
     * @return string
     */
    private function split_search_words($str,$do_fork = true,$do_unit = true,$do_multi = true,$do_prop = false,$pri_dict = false)
    {
        require_once LIB_PATH . '/phpanalysis/phpanalysis.class.php';

        if($str != '')
        {
            //初始化类
            PhpAnalysis::$loadInit = false;
            $pa = new PhpAnalysis('utf-8', 'utf-8', $pri_dict);

            //载入词典
            $pa->LoadDict();

            //执行分词
            $pa->SetSource($str);
            $pa->differMax = $do_multi;
            $pa->unitWord = $do_unit;
            $pa->StartAnalysis( $do_fork );

            $result = $str . $pa->GetFinallyResult(',', $do_prop);

            $result = array_unique(explode(',',$result));

            return $result;
        }
    }

    public function fuGoods()
    {
        $uid                        = Perm::$userId;
        $Fu_BaseModel               = new Fu_BaseModel();
        $Fu_RecordModel             = new Fu_RecordModel();
        $fu_cond_row['fu_state:<']  = $Fu_BaseModel::CANCEL;
        $fu_order_row['fu_sort']    = 'DESC' ;
        $data                    = $Fu_BaseModel->getFuList($fu_cond_row,$fu_order_row);

        if($uid)
        {
            foreach ($data['items'] as $key=>$val)
            {
                if( $val['fu_stock'] >0 && $val['fu_state'] ==2 )
                {
                    unset($data['items'][$key]);
                }
                else
                {
                    $cond_row['user_id']            = $uid;
                    $cond_row['goods_id']           = $val['goods_id'];
                    $order_row['fu_record_time']    = 'DESC';
                    $status                         = $Fu_RecordModel->getFuRecordList($cond_row,$order_row)['items'][0];

                    if($status)
                    {
                        if ($status['status'] == $Fu_RecordModel::NORMAL && $status['fu_end_time'] < get_date_time() )
                        {
                            $flag = $Fu_RecordModel->editFuRecord($status['fu_record_id'],['status'=>$Fu_RecordModel::OVER]);
                            if($flag)
                            {
                                $data['items'][$key]['fu_status'] = $Fu_RecordModel::OVER;
                            }
                        }
                        else
                        {
                            $data['items'][$key]['fu_status'] = $status['status'];
                        }

                    }
                    else
                    {
                        $data['items'][$key]['fu_status'] = 0;
                    }
                }
            }
        }
        else
        {
            foreach ($data['items'] as $key=>$val)
            {
                if( $val['fu_stock'] >0 && $val['fu_state'] ==2 )
                {
                    unset($data['items'][$key]);
                }
                else
                {
                    $data['items'][$key]['fu_status'] = 0;
                }
            }
        }
        foreach ($data['items'] as $key=>$val)
        {
            $num_cond_row['goods_id']              = $val['goods_id'];
            $data['items'][$key]['sale_countFu']   = $Fu_RecordModel->getRowCount($num_cond_row);
        }
        $data['items'] = array_values( $data['items'] );
        include $this->view->getView();
    }
}

?>