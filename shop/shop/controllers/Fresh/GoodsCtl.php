<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     Zhenzh
 */
class Fresh_GoodsCtl extends Controller
{
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);
        $this->site_id = -3;
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
        $cat_id = request_int('cat_id',2355);

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
        $sear_row=array();
        if($searchkey)
        {
            $sear_row[] = '%'.$searchkey.'%';
        }

        if ($search)
        {
            $sear_row[] = '%' . $search . '%';
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
        if($sear_row){
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
        $YLB_Page->totalRows = $data['totalsize'];
        $page_nav = $YLB_Page->prompt();

        if ('json' == $this->typ)
        {
            $data['items'] = array_values($data['items']);
            $this->data->addBody(-140, $data);
        }
        else
        {
            //热卖推荐，查找商城中销量最多的商品
            $hot_order_row['common_salenum'] = 'DESC';
            $hot_sale = $Goods_CommonModel->getGoodsListII($cond_row, $hot_order_row, 1, 3);

            $hot_sale = $hot_sale['items'];
            if (!$hot_sale) {
                $hot_cond_row['common_state'] = Goods_CommonModel::GOODS_STATE_NORMAL;
                $hot_cond_row['common_verify'] = Goods_CommonModel::GOODS_VERIFY_ALLOW;

                $hot_order_row['common_salenum'] = 'DESC';
                $hot_sale = $Goods_CommonModel->getGoodsListII($hot_cond_row, $hot_order_row, 1, 3);
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

	public function goodslist_bak()
	{
		$cond_row = array();

		$Goods_CommonModel = new Goods_CommonModel();

		//查询分类品牌和分类关联属性
		$brand_property = $this->getBrandAndProperty();
		if ( !empty($brand_property['common_ids']) )
		{
			if ( count($brand_property['common_ids']) == 1 && $brand_property['common_ids'][0] === false )
			{
				$cond_row['common_id'] = -1;
			}
			else
			{
				$cond_row['common_id:IN'] = $brand_property['common_ids'];
			}
		}

		$YLB_Page           = new YLB_Page();
		$YLB_Page->listRows = request_int('rows',12);
		$rows              = $YLB_Page->listRows;
		$offset            = request_int('firstRow', 0);
		$page              = ceil_r($offset / $rows);

        $wap_pagesize = request_int('pagesize');
		$wap_curpage = request_int('curpage');

		if ( !empty($wap_pagesize) )
		{
			$rows = $wap_pagesize;
		}

		if ( !empty($wap_curpage) )
		{
			$page = $wap_curpage;
		}

		//分类id
		$cat_id = request_int('cat_id',2355);

		$Goods_CatModel = new Goods_CatModel();
		if ($cat_id)
		{
			//查找该分类下所有的子分类
			$cat_list   = $Goods_CatModel->getCatChildId($cat_id);
			$cat_list[] = $cat_id;
			fb($cat_list);
			fb("分类列表");

			//查找该分类的父级分类
			$parent_cat_id = $Goods_CatModel->getCatParentTree($cat_id);

			$cond_row['cat_id:IN'] = $cat_list;
		}

		//不显示供货商商品
		$shopBaseModel = new Shop_BaseModel();
		$shop_list  = $shopBaseModel -> getByWhere(array('shop_type' => 1));
		$shop_ids   = array_column($shop_list,'shop_id');
		$cond_row['shop_id:IN'] =  $shop_ids;

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
		$addr = request_string('addr');
		if(!$addr)
		{
		    $addr = 'all';
        }
        $Big_Addr = $Base_DistrictModel->getRegionTreeOne($addr);

		$addr_son = request_int('addr_son');

		if($addr_son)
		{
		    $dis_one_cont = $Base_DistrictModel->getOne($addr_son);
        }

		$transport_id = request_string('transport_id', isset($cookid_area['city']['id']) ? $cookid_area['city']['id'] : '');
		$transport_area = request_string('transport_area', isset($cookid_area['area']) ? $cookid_area['area'] : '请选择地区');

		if($transport_id)
		{
			if($transport_id != 'undefined')
			{
				//获取该配送区域的所有模板
				$Transport_ItemModel = new Transport_ItemModel();
				$transport_type_id = $Transport_ItemModel->getItemByTransportId($transport_id);
				$transport_type_id[] = 0;
				fb($transport_type_id);
				fb("售卖区域");
				$cond_row['transport_type_id:IN'] = $transport_type_id;
			}
			else
			{
				$cond_row['transport_type_id:IN'] = array('0');
			}

		}


		//pc分站
        if(isset($_COOKIE['sub_site_id']) && $_COOKIE['sub_site_id'] > 0){
            $sub_site_id = $_COOKIE['sub_site_id'];
        }

        //wap分站
        if(request_string('ua') === 'wap'){
            $sub_site_id = request_int('sub_site_id');
        }
        $op4 = request_string('op4');

		if ($op4 === 'localgoods' || request_string('ua') === 'wap'){
			//获取分站信息
			if(Web_ConfigModel::value('subsite_is_open') && isset($sub_site_id) && $sub_site_id > 0){
				//获取站点信息
				$Sub_SiteModel = new Sub_SiteModel();
				$sub_site_district_ids = $Sub_SiteModel->getDistrictChildId($sub_site_id);
				if($sub_site_district_ids){
					$cond_row['district_id:IN'] = $sub_site_district_ids;
				}
			}
		}




		//商品搜索（总）
		$search = request_string('keywords');

		$searchkey = request_string('searkeywords');

        $sear_row=array();
		if($searchkey)
		{
			$sear_row[] = '%'.$searchkey.'%';
		}

		if ($search)
        {
            /**
             * 统计中心
             */
            $analytics_ip = get_ip();
            $analytics_data = array(
                'keywords'=>$search,
                'ip'=>$analytics_ip,
                'date'=>date('Y-m-d')
            );
            YLB_Plugin_Manager::getInstance()->trigger('analyticsKeywords',$analytics_data);
            /**********************************************************************/

            $sear_row[] = '%' . $search . '%';
            //记录搜索关键词
            $Search_WordModel                  = new Search_WordModel();
            $search_cond_row['search_keyword'] = $search;

            $search_row = $Search_WordModel->getSearchWordInfo($search_cond_row);

            if ($search_row)
            {
                $search_data                = array();
                $search_data['search_nums'] = $search_row['search_nums'] + 1;

                $flag = $Search_WordModel->editSearchWord($search_row['search_id'], $search_data);
            }
            else
            {
                $search_data                      = array();
                $search_data['search_keyword']    = $search;
                $search_data['search_char_index'] = Text_Pinyin::pinyin($search, '');
                $search_data['search_nums']       = 1;
                $flag                             = $Search_WordModel->addSearchWord($search_data);
            }
        }
        if($sear_row){
            $cond_row['common_name:LIKE'] = $sear_row;
        }

		$cond_row['shop_status'] = Shop_BaseModel::SHOP_STATUS_OPEN;

		//上架时间，销量，价格，评论数
		$order_row = array();
		$act       = request_string('act');
		$actorder    = strtolower(request_string('actorder','desc'));
        if($actorder === 'desc'){
            $next_order = 'asc';
        }else{
            $next_order = 'desc';
        }

        //上架时间,这里用商品入库时间
        if ($act === 'all')
        {
            $order_row['common_id'] = $actorder;
        }
        //销量
        if ($act === '')
        {
            $order_row['common_salenum'] = $actorder;
        }

        //销量
        if ($act === 'sale')
        {
            $order_row['common_salenum'] = $actorder;
        }

        //价格
        if ($act === 'price')
        {
            $order_row['common_price'] = $actorder;
        }

        //评论数
        if ($act === 'evaluate')
        {
            $order_row['common_evaluate'] = $actorder;
        }



		$op1 = request_string('op1');
		$op2 = request_string('op2');
		$op3 = request_string('op3');

		if ($op1)
		{
			//仅显示有货
			if ($op1 === 'havestock')
			{
				$cond_row['common_stock:>'] = 0;
			}
		}

		if ($op2)
		{
			//仅显示促销商品
			if ($op2 === 'active')
			{
				$cond_row['common_is_xian:!='] = 0;
				$cond_row['common_is_jia:!=']  = 0;
			}

		}

        //$cond_row['shop_self_support'] = 1;
		if ($op3)
		{
			//显示自营
			if ($op3 === 'ziying')
			{
				$cond_row['shop_self_support'] = 1;
			}

		}


		$price_from = request_float('price_from');
		if($price_from)
		{
			$cond_row['common_price:>='] = $price_from;
		}

		$price_to = request_float('price_to');
		if($price_to)
		{
			$cond_row['common_price:<='] = $price_to;
		}

		$virtual = request_float('isvirtual');
		if($virtual)
		{
			$cond_row['common_is_virtual'] = Goods_CommonModel::GOODS_VIRTUAL;
		}

        if(count($Big_Addr) == 1)
        {
            if($addr_son)
            {
                $cond_row['dis_id'] = $addr_son;
            }
            else
            {
                foreach ($Big_Addr as $key=>$value)
                {
                    $cond_row['dis_id:IN'] = array_column($value,'district_id');
                }
            }

        }

		//判断是否有属性
		$property_value_row       = array();
		$cond_row['common_state'] = Goods_CommonModel::GOODS_STATE_NORMAL;
		$cond_row['common_verify'] = Goods_CommonModel::GOODS_VERIFY_ALLOW;
		$data                     = $Goods_CommonModel->getGoodsList($cond_row, $order_row, $page, $rows, $property_value_row);

        /**-------------判断商品所在的店铺是否参加了满减送活动  @liuguilong 20170706 */
        $manModel = new ManSong_BaseModel();
        foreach($data['items'] as $key0=>$val0){
            $manArr = $manModel->getManSongByWhere(array('shop_id'=>$val0['shop_id']));
            if(count($manArr) > 0){
                $data['items'][$key0]['is_man'] = 1;        //1 为参加了满减送活动
            }else{
                $data['items'][$key0]['is_man'] = 0;        //0 为未参加满减活动
            }
        }

        /**-------------end-----------------*/

		$data['transport_area'] = $transport_area;

		$YLB_Page->totalRows = $data['totalsize'];
		$page_nav           = $YLB_Page->prompt();
		//推广产品
		$recommend_cond_row['common_state'] = Goods_CommonModel::GOODS_STATE_NORMAL;
		$recommend_cond_row['common_verify'] = Goods_CommonModel::GOODS_VERIFY_ALLOW;

		$recommend_order_row['common_is_recommend'] = 'DESC';

		//$recommend_list_row = $Goods_CommonModel->getGoodsIdList($cond_row,$recommend_order_row);
		//$recommend_row = array_slice($recommend_list_row['items'],0,4);

		//卖家精选
		$chose_row = array();

		//热卖推荐
		$hot_sale      = array();
		$brand_row     = array();
		$cat_row       = array();
		$recommend_row = array();


		//热卖推荐，查找商城中销量最多的商品
		$hot_order_row['common_salenum'] = 'DESC';
		$hot_sale                        = $Goods_CommonModel->getGoodsList($cond_row, $hot_order_row, 1, 3);
		$hot_sale                        = $hot_sale['items'];
		if (!$hot_sale)
		{
			$hot_cond_row['common_state'] = Goods_CommonModel::GOODS_STATE_NORMAL;
			$hot_cond_row['common_verify'] = Goods_CommonModel::GOODS_VERIFY_ALLOW;

			$hot_order_row['common_salenum'] = 'DESC';
			$hot_sale                        = $Goods_CommonModel->getGoodsList($hot_cond_row, $hot_order_row, 1, 3);
			$hot_sale                        = $hot_sale['items'];
		}


		//获取推广商品
		$Goods_RecommendModel = new Goods_RecommendModel();
		$recommond_cond_row   = array();
		$recommond_order_row  = array();
		//如果有查找的分类就显示该分类下的推广商品，如果没有传递分类就显示最新设置的分类推广
		if ($cat_id)
		{
			$recommond_cond_row['goods_cat_id'] = $cat_id;
		}
		else
		{
			$recommond_order_row['goods_recommend_id'] = 'DESC';
		}
		$recommend_row = $Goods_RecommendModel->getRccommonGoodsInfo($recommond_cond_row, $recommond_order_row);
		//如果没有查找的分类就将最新添加的分类推荐商品作为推广商品
		if (!$recommend_row)
		{
			$recommond_order_row['goods_recommend_id'] = 'DESC';
			$recommend_row                             = $Goods_RecommendModel->getRccommonGoodsInfo($recommond_cond_row, $recommond_order_row);
		}
		//如果商城没有设定推广商品，则将最新发布的四件商品作为推广商品显示
		if (!$recommend_row)
		{
			$recommend_order_row['common_is_recommend'] = 'DESC';
			$recommend_order_row['common_id']           = 'DESC';

			$recommend_row                              = $Goods_CommonModel->getGoodsList($recommend_cond_row, $recommend_order_row, 1, 4);
			$recommend_row                              = $recommend_row['items'];
		}
		fb($recommend_row);
		fb("推广商品");


		//获取品牌信息
		$Goods_TypeModel = new Goods_TypeModel();
		$type_cond_row   = array();
		$type_order_row  = array();
		//如果有查找的分类就显示该分类的相关品牌，如果没有传递分类就不显示品牌
		if ($cat_id)
		{
			$type_cond_row['cat_id'] = $cat_id;
			$brand_row               = $Goods_TypeModel->getTypeBrand($type_cond_row);
		}

		//获取分类信息
		$Goods_TypeBrandModel = new Goods_TypeBrandModel();
		$tbrand_cond_row      = array();
		$tbrand_order_row     = array();
		//如果有品牌就显示该品牌下的分类，如果没有就不显示分类
		if ($brand_id)
		{
			$tbrand_cond_row['brand_id'] = $brand_id;
			$cat_row                     = $Goods_TypeBrandModel->getBrandType($tbrand_cond_row);
		}

		$title             = Web_ConfigModel::value("category_title");//首页名;
		$this->keyword     = Web_ConfigModel::value("category_keyword");//关键字;
		$this->description = Web_ConfigModel::value("category_description");//描述;
		$this->title       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $title);
		$this->keyword       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->keyword);
		$this->description       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->description);

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
		if (isset($goods_base['goods_base']['promotion_price']) && !empty($goods_base['goods_base']['promotion_price']) && $goods_base['goods_base']['promotion_price'] < $goods_base['goods_base']['goods_price'])
		{
			$goods_base['goods_base']['old_price']  = $goods_base['goods_base']['goods_price'];
			$goods_base['goods_base']['now_price']  = $goods_base['goods_base']['promotion_price'];
			$goods_base['goods_base']['down_price'] = $goods_base['goods_base']['down_price'];
		}
		else
		{
			$goods_base['goods_base']['old_price']  = 0;
			$goods_base['goods_base']['now_price']  = $goods_base['goods_base']['goods_price'];
			$goods_base['goods_base']['down_price'] = 0;
		}

		$this->data->addBody(-140, $goods_base);

	}

	public function getGoodsidByCid()
	{
		$cid = request_int('cid');


		$Goods_CommonModel = new Goods_CommonModel();
		$property_value_row       = array();
		$cond_row['common_id'] = $cid;
		$data                     = $Goods_CommonModel->getGoodsList($cond_row);

		$goods_id = $data['items'][0]['goods_id'];

		$this->data->addBody(-140, array('goods_id' => $goods_id));

	}

	/**
	 * 商品详情页  goodsdetailinfo
	 *
	 * @access public
	 */
	public function goods()
	{

		$cid = request_int('cid');
		$goods_id        = request_int('gid', request_int('goods_id'));
		//如果传递过来的是common_id，则从此common_id中的goods_id中选择一个有效的goods_id
		if($cid && !$goods_id)
		{
			$Goods_CommonModel = new Goods_CommonModel();
			$property_value_row       = array();
			$cond_row['common_id'] = $cid;
			$data                     = $Goods_CommonModel->getGoodsList($cond_row);

			$goods_id = $data['items'][0]['goods_id'];
		}

        //添加商品点击数
        $Goods_BaseModel = new Goods_BaseModel();
        $good_click_row  = array('goods_click' => '1');
        $Goods_BaseModel->editBase($goods_id, $good_click_row, true);

        //1.商品信息（商品活动信息，评论数，销售数，咨询数）
        $Goods_BaseModel = new Goods_BaseModel();

        $goods_detail    = $Goods_BaseModel->getGoodsDetailInfoByGoodId($goods_id);

        $goods_data = array();

		$goods_check     = $Goods_BaseModel->checkGoodsII($goods_id);

		if (!$goods_detail || !$goods_check)
		{
			$this->view->setMet('404');
		}
		else
		{
			$user_id = Perm::$userId;
			//添加用户足迹
			if (Perm::checkUserPerm())
			{
				$user_id = Perm::$userId;

				$User_FootprintModel = new User_FootprintModel();

				//先判断该用户是否浏览过该商品
				$foot_cond_row['user_id']   = $user_id;
				$foot_cond_row['common_id'] = $goods_detail['goods_base']['common_id'];
				$foot_id                    = $User_FootprintModel->getKeyByWhere($foot_cond_row);

				//如果用户曾经浏览过该商品则修改浏览时间
				if ($foot_id)
				{
					$edit_foot_row                   = array();
					$edit_foot_row['footprint_time'] = get_date_time();
					$User_FootprintModel->editFootprint($foot_id, $edit_foot_row);
				}
				else
				{
					//如果没有浏览过改商品则插入数据
					$read_add_row                   = array();
					$read_add_row['user_id']        = $user_id;
					$read_add_row['common_id']      = $goods_detail['goods_base']['common_id'];
					$read_add_row['footprint_time'] = get_date_time();
					$User_FootprintModel->addFootprint($read_add_row);
				}
			}

			$Goods_CatModel = new Goods_CatModel();
			//查找该分类的父级分类
			$parent_cat = $Goods_CatModel->getCatParent($goods_detail['goods_base']['cat_id']);
			$cat_info = $Goods_CatModel->getOne($goods_detail['goods_base']['cat_id']);
			if($cat_info)
			{
				$cat_info['ext'] = 1;
				$parent_cat[] = $cat_info;
			}


			fb($parent_cat);
			fb("父级分类");

			//判断此商品是否被关注过
			$User_FavoritesGoodsModel = new User_FavoritesGoodsModel();
			$user_favorites_goods_row['user_id'] = $user_id;
			$user_favorites_goods_row['goods_id'] = $goods_detail['goods_base']['goods_id'];
			$user_favorites_goods = $User_FavoritesGoodsModel->getKeyByWhere($user_favorites_goods_row);
			if($user_favorites_goods)
			{
				$isFavoritesGoods = true;
			}
			else
			{
				$isFavoritesGoods = false;
			}

			//计算商品的销售数量1.直接显示本件商品的销售数量，2.显示本类common商品的销售数量

			$common_goods = $Goods_BaseModel->getByWhere(array('common_id' => $goods_detail['goods_base']['common_id']));
			$count_sale   = 0;
			foreach ($common_goods as $comkey => $comval)
			{
				$count_sale += $comval['goods_salenum'];
			}
			$goods_detail['goods_base']['count_sale'] = $count_sale;

			//获取商品所在地
			$Base_DistrictModel = new Base_DistrictModel();
			$goods_location_row = $Base_DistrictModel->getByWhere(array('district_id:IN' => $goods_detail['common_base']['common_location']));
			$goods_location = '';
			if($goods_location_row)
			{
				$goods_location_row = array_values($goods_location_row);
				foreach($goods_location_row as $localkey => $localval)
				{
					$goods_location .= $localval['district_name'].'  ';
				}
			}

			fb($goods_detail);
			fb("商品信息");

			if(Web_ConfigModel::value('Plugin_Directseller'))
			{
				$goods_detail['recImages'] = '';
				//推荐者上传的图片
				$PluginManager = YLB_Plugin_Manager::getInstance();
				$data = $PluginManager->trigger('rec_goods');
				$goods_detail['recImages'] = isset($data['Plugin_Directseller_recGoods']) ? $data['Plugin_Directseller_recGoods'] : '';
				//--END
			}

			//2.店铺信息
			$Shop_BaseModel = new Shop_BaseModel();
			$shop_detail    = $Shop_BaseModel->getShopDetail($goods_detail['goods_base']['shop_id']);
            if(!$shop_detail){
                $this->view->setMet('404');
            }
			//查找该店铺下的实体店铺
			$Shop_EntityModel = new Shop_EntityModel();
			$entity_shop = $Shop_EntityModel->getByWhere(array("shop_id" => $goods_detail['goods_base']['shop_id']));

			fb($shop_detail);
			fb("店铺详情");

			//检测商品是否已经下架
			$goods_status = 1;
			if ($goods_detail['goods_base']['goods_is_shelves'] != Goods_BaseModel::GOODS_UP || $goods_detail['common_base']['common_state'] != Goods_CommonModel::GOODS_STATE_NORMAL)
			{
				$goods_status = 0;
			}
			//检查是否为店主本人
			$shop_owner = 0;

			if ($shop_detail['shop_id'] == Perm::$shopId  || $shop_detail['user_id'] == Perm::$userId)
			{
				$shop_owner = 1;
			}

            //判断是否可以门店自提
            $Chain_GoodsModel=new Chain_GoodsModel();
            $chain_row['shop_id:=']=$goods_detail['goods_base']['shop_id'];
            $chain_row['goods_id:=']=$goods_id;
            $chain_row['goods_stock:>']=0;

            $chain_goods=$Chain_GoodsModel->getByWhere($chain_row);

            $goods_detail['chain_stock']=0;

            if($chain_goods){
                $goods_detail['chain_stock']=1;
            }

			//如果使用售卖区域（现在商品表中暂时没有字段表面售卖区域）


			$IsHaveBuy = 0;
			if ($user_id)
			{
				//团购商品是否已经开始
				//查询该用户是否已购买过该商品
				$Order_GoodsModel                          = new Order_GoodsModel();
				$order_goods_cond['common_id']             = $goods_detail['goods_base']['common_id'];
				$order_goods_cond['buyer_user_id']         = $user_id;
				$order_goods_cond['order_goods_status:!='] = Order_StateModel::ORDER_REFUND_FINISH;
				$order_list                                = $Order_GoodsModel->getByWhere($order_goods_cond);

				$order_goods_count = count($order_list);

				if (isset($goods_detail['goods_base']['promotion_type']))
				{
					$promotion_type = $goods_detail['goods_base']['promotion_type'];

					if ($promotion_type == 'groupbuy')
					{
						//检测是否限购数量
						$upper_limit = $goods_detail['goods_base']['upper_limit'];
						if ($upper_limit > 0 && $order_goods_count >= $upper_limit)
						{
							$IsHaveBuy = 1;
						}
					}

                    if ($promotion_type == 'scarebuy')
                    {
                        //检测是否限购数量
                        $upper_limit = $goods_detail['goods_base']['upper_limit'];
                        if ($upper_limit > 0 && $order_goods_count >= $upper_limit)
                        {
                            $IsHaveBuy = 1;
                        }
                    }
				}


				//商品限购数量判断
				if ($goods_detail['common_base']['common_limit'] > 0 && $order_goods_count >= $goods_detail['common_base']['common_limit'])
				{
					$IsHaveBuy = 1;
				}

			}


			//计算限购数量
			if (isset($goods_detail['goods_base']['upper_limit']))
			{
				if ($goods_detail['goods_base']['upper_limit'] && $goods_detail['common_base']['common_limit'])
				{
					if ($goods_detail['goods_base']['upper_limit'] >= $goods_detail['common_base']['common_limit'])
					{
						$goods_detail['buy_limit'] = $goods_detail['common_base']['common_limit'];
					}
					else
					{
						$goods_detail['buy_limit'] = $goods_detail['goods_base']['upper_limit'];
					}
				}
				elseif ($goods_detail['goods_base']['upper_limit'] && !$goods_detail['common_base']['common_limit'])
				{
					$goods_detail['buy_limit'] = $goods_detail['goods_base']['upper_limit'];
				}
				elseif (!$goods_detail['goods_base']['upper_limit'] && $goods_detail['common_base']['common_limit'])
				{
					$goods_detail['buy_limit'] = $goods_detail['common_base']['common_limit'];
				}
				else
				{
					$goods_detail['buy_limit'] = 0;
				}
			}
			else
			{
				$goods_detail['buy_limit'] = $goods_detail['common_base']['common_limit'];
			}


			$shop_id = $shop_detail['shop_id'];
			$Goods_CommonModel   = new Goods_CommonModel();
			if ($shop_id)
			{
				$data_recommon       = $Goods_CommonModel->listByWhere(array(
																		   'shop_id' => $shop_id
																	   ), array('common_is_recommend' => 'desc','common_sell_time' => 'desc'), 0, 4);
				$data_recommon_goods = $Goods_CommonModel->getRecommonRow($data_recommon);

				//推荐商品
				$data_foot_recommon       = $Goods_CommonModel->listByWhere(array(
																				'shop_id' => $shop_id
																			), array('common_is_recommend' => 'DESC'), 0, 5);
				$data_foot_recommon_goods = $Goods_CommonModel->getRecommonRow($data_foot_recommon);

				//热门销售
				$data_hot_salle = $Goods_CommonModel->getHotSalle($shop_id);
				$data_salle     = $Goods_CommonModel->getRecommonRow($data_hot_salle);
				//热门收藏
				$data_hot_collect = $Goods_CommonModel->getHotCollect($shop_id);
				$data_collect     = $Goods_CommonModel->getRecommonRow($data_hot_collect);

				//商品咨询数量
				$Consult_BaseModel = new Consult_BaseModel();
				$data_consult      = $Consult_BaseModel->getByWhere(array(
																		'goods_id' => $goods_id,
																		'shop_id' => $shop_id
																	));
				$consult_num       = count($data_consult);
				/*if(!empty($data_consult_base['items']))
                {
                    $consult_base_data = $data_consult_base['items'];
                }*/
			}

			//关联样式
			$Goods_FormatModel = new Goods_FormatModel();
			$goods_data        = $Goods_BaseModel->getOne($goods_id);
			$common_id         = $goods_data['common_id'];
			$common_data       = $Goods_CommonModel->getOne($common_id);


			if ($common_data)
			{
				$common_formatid_top = $common_data['common_formatid_top'];

				if ($common_formatid_top)
				{
					$goods_format_top = $Goods_FormatModel->getOne($common_formatid_top);
				}

				$common_formatid_bottom = $common_data['common_formatid_bottom'];

				if ($common_formatid_bottom)
				{
					$goods_format_bottom = $Goods_FormatModel->getOne($common_formatid_bottom);
				}
			}
		}
		$title             = Web_ConfigModel::value("product_title");//首页名;
		$this->keyword     = Web_ConfigModel::value("product_keyword");//关键字;
		$this->description = Web_ConfigModel::value("product_description");//描述;

		$this->title       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $title);
		$this->title       = str_replace("{name}", $goods_detail['goods_base']['goods_name'], $this->title);
		$this->keyword       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->keyword);
		$this->keyword       = str_replace("{name}", $goods_detail['goods_base']['goods_name'], $this->keyword);
		$this->description       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->description);
		$this->description        = str_replace("{name}", $goods_detail['goods_base']['goods_name'], $this->description );

		if($goods_data){
			$this->shopCustomServiceModel = new Shop_CustomServiceModel;

			$cond_row['shop_id'] = $goods_data['shop_id'];

			$service = $this->shopCustomServiceModel->getServiceList($cond_row);
			if($service['items']){
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
						$service[$key]["tool"] = '<a href="javascript:;" class="chat-enter" onclick="return chat(\''.$val['number'].'\');"><img src="'.$this->view->img.'/icon-im.gif" alt=""></a>';
					}
					//$service[$key]["tool"] = $val['tool'];
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
				$service = array();
				$service = $de;
			}
//            var_dump($goods_detail['common_base']);
		}
		if ('json' == $this->typ)
		{
			/**
			 * ly wap 端返回数据
			 *
			 */
			$data 					= array();
			$gift_array				= array();
			$goods_eval_list 		= array();
			$goods_evaluate_info 	= array();
			$goods_hair_info 		= array();
			$goods_image  			= '';
			$goods_info 			= array();
			$spec_list 				= array();
			$spec_image				= array();
			$store_info 			= array();
			$mansong_info			= array();

			//商品详情
			$goods_info = array_merge($goods_detail['common_base'], $goods_detail['goods_base']);

			//好评率
			$Goods_EvaluationModel =  new Goods_EvaluationModel();
			$all_count    = $Goods_EvaluationModel->countEvaluation($common_id, 'all');
			$good_count   = $Goods_EvaluationModel->countEvaluation($goods_detail['common_base']['common_id'], 'good');
			if($all_count != 0)
			{
				$good_pre   = round($good_count / $all_count * 100);
			}
			else
			{
				$good_pre   = 100;
			}



			//配送信息
			$goods_hair_info['content'] 	= $goods_detail['shop_base']['shipping'];
			$goods_hair_info['if_store_cn'] = empty($goods_detail['goods_base']['goods_stock']) ? '无货' : '有货';
			$goods_hair_info['if_store'] 	= empty($goods_detail['goods_base']['goods_stock']) ? false : true;
			$goods_hair_info['area_name']	= '全国';

			//图片信息
			if ( isset($goods_detail['goods_base']['image_row']) && !empty($goods_detail['goods_base']['image_row']) )
			{
				$images_list = array_column($goods_detail['goods_base']['image_row'], 'images_image');
				$images_list = array_map(function ($img) {
					return image_thumb($img, 360, 360);
				}, $images_list);
				$goods_image = implode(',', $images_list);
			}
			else
			{
				$goods_image = $goods_detail['goods_base']['goods_image'];
			}

			//满送
			$mansong_info = $goods_detail['mansong_info'];

			if ( !empty($goods_detail['common_base']['common_spec_name']) )
			{
				//商品规格
				$spec_list = $Goods_BaseModel->createSGIdByWap($goods_detail['common_base']['common_id']);

				//商品规格颜色图
				if ( !empty($goods_detail['common_base']['common_spec_value_color']) )
				{
					$spec_image = $goods_detail['common_base']['common_spec_value_color'];
				}
			}

			//店铺信息
			$store_info['is_own_shop'] 	=	$shop_detail['shop_self_support'];
			$store_info['member_id'] 	=	$shop_detail['user_id'];
			$store_info['member_name'] 	=	$shop_detail['user_name'];
			$store_info['store_id'] 	=	$shop_detail['shop_id'];
			$store_info['store_name'] 	=	$shop_detail['shop_name'];
			$store_info['store_logo'] 	=	$shop_detail['shop_logo'];

			$store_credit = array();

			$store_credit['store_deliverycredit'] 	=	array();
			$store_credit['store_deliverycredit']['credit']	= $shop_detail['shop_send_scores'];
			$store_credit['store_deliverycredit']['text']	= "物流";

			$store_credit['store_desccredit'] 		=	array();
			$store_credit['store_desccredit']['credit']		= $shop_detail['shop_desc_scores'];
			$store_credit['store_desccredit']['text']		= "描述";

			$store_credit['store_servicecredit'] 	=	array();
			$store_credit['store_servicecredit']['credit']	= $shop_detail['shop_service_scores'];
			$store_credit['store_servicecredit']['text']	= "服务";

			$store_info['store_credit'] = $store_credit;



			$data['goods_id']				= $goods_id;
			$data['goods_info'] 			= $goods_info; 				//商品详情


			$data['goods_commend_list'] 	= $data_salle; 				//推荐商品（销量）
			$data['goods_eval_list'] 		= $goods_eval_list; 		//商品评论
			$data['goods_evaluate_info'] 	= $goods_evaluate_info; 	//商品评论

			$data['goods_hair_info'] 		= $goods_hair_info; 		//售卖区域
			$data['goods_image'] 			= $goods_image; 			//商品图片
			$data['mansong_info'] 			= $mansong_info; 			//商品满送
			$data['spec_list'] 			= $spec_list; 				//商品规格
			$data['spec_image'] 			= $spec_image; 				//商品颜色
			$data['store_info'] 			= $store_info; 				//店铺信息
			$data['buyer_limit']           = $goods_detail['buy_limit'];  //限购数量
			$data['is_favorate']			= $isFavoritesGoods;		//是否收藏过商品
			$data['shop_owner']			= $shop_owner;				//是否为店主
			$data['isBuyHave']				= $IsHaveBuy;				//是否已达限购数量
			$data['good_pre']             = $good_pre;   				//好评率

			if(Web_ConfigModel::value('Plugin_Directseller'))
			{
				$data['rec_images']             = $goods_detail['recImages'];//推荐者上传图片
			}

			$this->data->addBody(-140,$data);
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
	public function getGoodsDetailInfo()
	{
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
		$shop_cat           = $shopGoodCatModel->getGoodCatList($cat_row);

		if ('json' == $this->typ)
		{
			$shopBaseModel = new Shop_BaseModel();
			$shop_base = $shopBaseModel->getBase($shop_id);
			$shop_base = pos($shop_base);

			$shop_cat = array_values($shop_cat);
			$data['store_goods_class'] = $shop_cat;
			$data['shop_id'] 		   = $shop_id;
			$data['shop_name'] 		   = $shop_base['shop_name'];
			$this->data->addBody(-140, $data);
		}
		else
		{
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

		fb($data);
		fb('销售记录');
		$YLB_Page->totalRows = $data['totalsize'];
		$page_nav           = $YLB_Page->ajaxprompt();

		include $this->view->getView();
	}

	/*
	 * 获取商品咨询
	 */
	public function getConsultListRows()
	{
		$goods_id = request_int('goods_id');

		$YLB_Page = new YLB_Page();
		//$YLB_Page->listRows = 1;
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
		
		if ($all_count != 0)
		{
			$good_pre   = round($good_count / $all_count * 100);
			$middle_pre = round($middle_count / $all_count * 100);
			$bad_pre    = round($bad_count / $all_count * 100);
		}
		else
		{
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

		if ( $this->typ == 'json' )
		{
			$page = request_int('curpage');
			$rows	 = request_int('page');

			switch($type)
			{
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
		$page_nav           = $YLB_Page->ajaxprompt();


		if ( $source == 'wap' )
		{
			$this->data->addBody(-140, $data);
		}
		else
		{
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
			$add_row             = array();
			$add_row['user_id']  = $user_id;
			$add_row['goods_id'] = $goods_id;

			$User_FavoritesGoodsModel = new User_FavoritesGoodsModel();
			//开启事物
			$User_FavoritesGoodsModel->sql->startTransactionDb();

			$res = $User_FavoritesGoodsModel->getFavoritesGoods($add_row);

			if ($res)
			{
				$flag        = false;
				$data['msg'] = _("您已收藏过该商品！");

			}
			else
			{
				$add_row['favorites_goods_time'] = get_date_time();


				$User_FavoritesGoodsModel->addGoods($add_row);

				//商品详情中收藏数量增加
				$Goods_BaseModel           = new Goods_BaseModel();
				$goods_base = $Goods_BaseModel->getOne($goods_id);
				$edit_row                  = array();
				$edit_row['goods_collect'] = '1';
				$flag                      = $Goods_BaseModel->editBase($goods_id, $edit_row, true);

				//商品common中
				$Goods_CommonModel = new Goods_CommonModel();
				$edit_common_row = array();
				$edit_common_row['common_collect'] = '1';
				$Goods_CommonModel = $Goods_CommonModel->editCommonTrue($goods_base['common_id'],$edit_common_row);

			}


		}
		else
		{
			$flag = false;
		}

		if ($flag && $User_FavoritesGoodsModel->sql->commitDb())
		{
			$status      = 200;
			$msg         = _('success');
			$data['msg'] = $data['msg'] ? $data['msg'] : _("收藏成功！");

			//删除收藏商品成功添加数据到统计中心
			$analytics_data = array(
				'product_id'=>$goods_id,
			);
			YLB_Plugin_Manager::getInstance()->trigger('analyticsProductCollect',$analytics_data);
			/******************************************************/
		}
		else
		{
			$User_FavoritesGoodsModel->sql->rollBackDb();
			$m           = $User_FavoritesGoodsModel->msg->getMessages();
			$msg         = $m ? $m[0] : _('failure');
			$status      = 250;
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
			$fav_row             = array();
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
			$Goods_BaseModel           = new Goods_BaseModel();
			$goods_base				   = $Goods_BaseModel->getOne($goods_id);
			$edit_row                  = array();
			$edit_row['goods_collect'] = '-1';
			$flag                      = $Goods_BaseModel->editBase($goods_id, $edit_row, true);

			//商品common中收藏数量减少
			$Goods_CommonModel = new Goods_CommonModel();
			$edit_common_row = array();
			$edit_common_row['common_collect'] = '1';
			$Goods_CommonModel = $Goods_CommonModel->editCommonTrue($goods_base['common_id'],$edit_common_row);
		}
		else
		{
			$flag = false;
		}

		if ($flag && $User_FavoritesGoodsModel->sql->commitDb())
		{
			$status = 200;
			$msg    = _('success');
		}
		else
		{
			$User_FavoritesGoodsModel->sql->rollBackDb();
			$m      = $User_FavoritesGoodsModel->msg->getMessages();
			$msg    = $m ? $m[0] : _('failure');
			$status = 250;
		}
		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);
	}


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
//				$condi_pro_index['property_value_id:IN'] = $property_value_ids;
//				$goodsPropertyIndexModel = new Goods_PropertyIndexModel();
//				$property_index_list = $goodsPropertyIndexModel->getByWhere( $condi_pro_index );
//				$common_ids = array_column($property_index_list, 'common_id');
//
//				$data['common_ids'] = $common_ids;
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
		$order_id = request_string('order_id');
		$goods_id = request_int('goods_id');

		$Order_GoodsSnapshotModel = new Order_GoodsSnapshotModel();
		$snapshot = $Order_GoodsSnapshotModel->getByWhere(array('order_id'=>$order_id,'goods_id'=>$goods_id));

		$snapshot = current($snapshot);

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
		fb($order_base);

		include $this->view->getView();
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
     * zcg
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
     * zcg
     * 取得门店
     *
     * @access public
     */
    public function chain()
    {
        $district_parent_id = request_int('pid', 0);
        $Base_DistrictModel = new Base_DistrictModel();
        $district = $Base_DistrictModel->getDistrictTree($district_parent_id);
        $shop_id = request_int("shop_id");
        $goods_id = request_int("goods_id");

        $Chain_GoodsModel=new Chain_GoodsModel();
        $chain_row['shop_id:=']=$shop_id;
        $chain_row['goods_id:=']=$goods_id;
        $chain_row['goods_stock:>']=0;

        $chain_goods=$Chain_GoodsModel->getByWhere($chain_row);

        $Chain_BaseModel=new Chain_BaseModel();
        $Chain_BaseModel->sql->setLimit(0,999999999);
        $Chain_Base=$Chain_BaseModel->getBase('*');

        $chain=array();
        foreach($chain_goods as $value){
            $chain[$Chain_Base[$value['chain_id']]['chain_county_id']][]=$Chain_Base[$value['chain_id']];
        }
        $chain=json_encode($chain);
//var_dump($chain);
//        exit;
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
        $cid = request_int('cid');
        $gid = request_int('gid');
        $uid = Perm::$userId;

        if($cid)
        {
            $goodsCommonModel = new Goods_CommonModel();
            $goods_common = $goodsCommonModel->getOne($cid);
            $shop_id = $goods_common['shop_id'];
        }
        if($gid)
        {
            $goods_model = new Goods_BaseModel();

            $goods = $goods_model -> getOne(array('goods_id'=>$gid));
            $cid = $goods['common_id'];
            $shop_id = $goods['shop_id'];
        }

        if($cid&&$uid)
        {
            $sharePriceModel    = new Share_PriceModel();


            $price_cond_row['common_id'] = $cid;
            $price_cond_row['share_uid'] = $uid;
            $price_cond_row['shop_id'] = $shop_id;

            $order_row['share_date'] = 'DESC';
            $share_price_list = $sharePriceModel -> getSharePriceList($price_cond_row,$order_row,1,1);

            if($share_price_list['items'])
            {
                //已经分享过
                $share_order_id = $share_price_list['items'][0]['share_order_id'];//最近的一单订单号
                $orderBaseModel = new Order_BaseModel();
                if($share_order_id)
                {
                    $order = $orderBaseModel ->getOneByWhere(array('order_id'=>$share_order_id));//最近的一单订单

                    $flag = false;
                    if($order['order_status'] > 1 && $order['order_status'] < 7)
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

                        $share_num = sprintf('%s-%s-%s-%s', 'FX', $price_cond_row['shop_id'], $order_number);
                        $price_cond_row['share_num'] = $share_num;

                        $sharePriceModel->addSharePrice($price_cond_row);
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
            }


        }



        $this->data->addBody(-140, $data);
    }
    /**
     * 激活分享优惠Zhenzh
     */
    public function actShare()
    {
        $shareBaseModel = new Share_BaseModel();
        $sharePriceModel    = new Share_PriceModel();

        $gid = request_int('gid');
        $suid = request_int('suid');
        $from = request_string('from');
        $hash = request_string('hash');

        $stype = explode('-',$hash)[1];
        if($from && $from == 'timeline')
        {
            $stype = $stype.'_timeline';
        }

        $goods_model = new Goods_BaseModel();
        $goods = $goods_model -> getOne(array('goods_id'=>$gid));
        $cid = $goods['common_id'];

        //存在链接来源标识 sqq qzone weixin tsina
        if($stype)
        {

            $share_cond_row['common_id'] = $cid;
            //$share_cond_row['shop_id'] = Perm::$shopId;

            $shareBase = $shareBaseModel ->getOneShareByWhere($share_cond_row);

            if($shareBase)
            {
                $stype_price = $shareBase[$stype];

                //标识属于sqq qzone weixin tsina
                if($stype_price)
                {

                    $price_cond_row['common_id'] = $cid;
                    $price_cond_row['share_uid'] = $suid;
                    $price_order['share_date'] = 'DESC';
                    $share_price_list = $sharePriceModel -> getSharePriceList($price_cond_row,$price_order,1,1);

                    if($share_price_list['items'])
                    {
                        $share_price = $share_price_list['items'][0];

                        //用户$suid是否已经分享过商品$gid
                        if($share_price)
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

                            //当前链接进来的方式 是否已经存在 例$stype=qzone 这里只对没有分享过的做记录 另:分享并且立减过 商家又修改了分享金额的未做处理
                            if(!in_array($stype,array_keys($share_base)))
                            {
                                $share_base[$stype] = $stype_price;
                            }
                            $editPrice_cond_row['share_base'] = $share_base;
                            $editPrice_cond_row['status'] = '1';
                            $editPrice_cond_row['price'] = array_sum($share_base);
                            $editPrice_cond_row['promotion_unit_price'] = $shareBase['promotion_unit_price'];
                            $sharePriceModel -> editSharePrice($share_price['id'],$editPrice_cond_row);


                            //添加每点击一次+0.1
                            if($shareBase['is_promotion'])
                            {

                                $ar_price = $shareBase['promotion_unit_price'] * $share_price['promotion_click_count'];
                                if($shareBase['promotion_total_price'] > $ar_price)
                                {

                                    $share_click_model = new Share_ClickModel();
                                    $click_cond['common_id'] = $cid;
                                    $click_cond['action_ip'] = get_ip();
                                    $click_cond['action_time:>'] = strtotime('-1 day',time());
                                    $share_click = $share_click_model ->getOneShareClickByWhere($click_cond);

                                    if($share_click)
                                    {

                                    }
                                    else
                                    {
                                        unset($click_cond['action_time:>']);
                                        $click_cond['type'] = $stype;
                                        $click_cond['action_time'] = time();
                                        $click_cond['pirce'] = $shareBase['promotion_unit_price']*1;
                                        $click_cond['share_price_id'] = $share_price['id'];
                                        $share_click_id = $share_click_model -> addShareClick($click_cond,true);

                                        if($share_click_id)
                                        {
                                            $share_price_cond['promotion_click_count'] = $share_price['promotion_click_count'] + 1;
                                            $sharePriceModel->editSharePrice($share_price['id'],$share_price_cond);
                                        }

                                    }
                                }

                            }

                        }


                    }
                }
            }
        }
        $data = array();
        $this->data->addBody(-140, $data);

    }

    public function dinner()
    {
        include $this->view->getView();
    }

}

?>