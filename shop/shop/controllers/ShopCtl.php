<?php

/**
 * @author     charles
 */
class ShopCtl extends Controller
{

	public $shopBaseModel       = null;
	public $shopGoodCatModel    = null;
	public $shopNavModel        = null;
	public $goodsCommonModel    = null;
	public $shopDecorationModel = null;
	public $shopGoodsLikeModel  = null;
    public $Goods_BaseModel     = null;
    public $shopGoodsCatModel  = null;

	// public $shopDecorationBlockModel = null;

	public function __construct(&$ctl, $met, $typ)
	{

		parent::__construct($ctl, $met, $typ);

		$this->shopBaseModel = new Shop_BaseModel();
		$this->shopGoodCatModel = new Shop_GoodCatModel();
		$this->shopNavModel = new Shop_NavModel();
		$this->goodsCommonModel = new Goods_CommonModel();
		$this->shopDecorationModel = new Shop_DecorationModel();
		$this->shopGoodsLikeModel  = new Shop_GoodsLikeModel();
        $this->Goods_BaseModel     = new Goods_BaseModel();
        $this->shopGoodsCatModel    = new Shop_GoodsCatModel();
		// $this->shopDecorationBlockModel = new Shop_DecorationBlockModel();
		//调用这个方法查询出当下店铺是否开启自定义店铺，如果开启自定义店铺只能用店铺默认的模板，如果不是自定义店铺则需要分配那个模板
		$this->setTemp();
        $this->is_nav = false;
        $this->shop_id = request_int('id');
		$this->initData();
	}

	public function setTemp()
	{
		$shop_id = request_int('id');

		if ($shop_id)
		{
			//根据店铺id查询出是否开启自定义店铺
			$renovation_list = $this->shopBaseModel->getOne($shop_id);
			if (!empty($renovation_list['is_renovation']))
			{
				//店铺装修
				$this->view->setMet(null, "default");
			}
			else
			{
				if ($renovation_list)
				{
					//分配模板
					$shop_template = $renovation_list['shop_template'];
					$this->view->setMet(null, $shop_template);
				}
				else
				{
					$this->view->setMet('404');
				}
			}
		}
		else
		{
			$this->view->setMet('404');

		}
	}

	public function index()
	{
        $shop_id = request_int('id');

        if($shop_id){
			$this->shopCustomServiceModel = new Shop_CustomServiceModel;

			$cond_row['shop_id'] = $shop_id;

			$service = $this->shopCustomServiceModel->getServiceList($cond_row);
			if($service['items']){
				foreach($service['items'] as $key => $val)
				{
					//IM
					if($val['tool'] ==3)
					{
						//$service[$key]["tool"] = '<a href="javascript:;" class="chat-enter" onclick="return chat(\''.$val['number'].'\');"><img src="'.$this->view->img.'/icon-im.gif" alt=""></a>';
                        $service[$key]["tool"] = '<a href="javascript:;" class="chat-enter" rel="'.$val['number'].'" ><img src="'.$this->view->img.'/icon-im.gif" alt=""></a>';
                    }

					//$service[$key]["tool"] = $val['tool'];
					$service[$key]["number"] = $val['number'];
					$service[$key]["name"] = $val['name'];
					$service[$key]["id"] = $val['id'];

					if($val['type']==1) {
						$de['after'][] = $service[$key];
					} else {
						$de['pre'][] = $service[$key];
					}
				}
				$service = array();
				$service = $de;
			}

            $scareBuyBaseModel = new ScareBuy_BaseModel();
            $data_hot_scarebuy = $scareBuyBaseModel->getScareBuyGoodsList(array('shop_id'=>$shop_id,'scarebuy_state'=>ScareBuy_BaseModel::NORMAL), array('scarebuy_buy_quantity' => 'desc'), 0, 5);
            if (!empty($data_hot_scarebuy['items']))
            {
                $data_hot = $data_hot_scarebuy['items'];
            }

		}


		//店铺信息
		$shop_base = $this->shopBaseModel->getOne($shop_id);
                //2.评分信息
		$shop_detail = $this->shopBaseModel->getShopDetail($shop_id);
//		d($shop_detail);
                $shop_scores_num = ($shop_detail['shop_desc_scores']+$shop_detail['shop_service_scores']+$shop_detail['shop_send_scores'])/3;
                $shop_scores_count = sprintf("%.2f", $shop_scores_num);
                $shop_scores_percentage = $shop_scores_count * 20;

                if($shop_base['shop_self_support']=='false'){
                    $shop_all_base = $this->shopBaseModel->getbaseCompanyList($shop_id);
                }
		if (!empty($shop_base) && $shop_base['shop_status'] == 3)
		{
			//店铺幻灯和幻灯对应的连接
			$shop_slide     = explode(",", $shop_base['shop_slide']);
			$shop_slide_url = explode(",", $shop_base['shop_slideurl']);

			//用来判断是不是开启了店铺装潢
//			 $renovation_list = $this->shopRenovationModel->getOne($shop_id);
			//查询数据的条件
			$nav_cond_row  = array(
				"shop_id" => $shop_id,
				"status" => 1
			);
			$arr = array('1'=>'goods_name','2'=>'goods_id');
			$nav_order_row = array("displayorder" => "asc");
			//店铺导航
			$shop_nav = $this->shopNavModel->listByWhere($nav_cond_row, $nav_order_row);
			if (($shop_base['is_renovation'] && $shop_base['is_only_renovation'] == "0") || !$shop_base['is_renovation']) {
				//店铺分类
				$cat_row['shop_id'] = $shop_id;
				$shop_cat = $this->shopGoodCatModel->getGoodCatList($cat_row);

/*新品 start*/

				//店铺下面的产品 新品 推荐 热销排行 收藏排行
				$goods_new_list = $this->goodsCommonModel->getGoodsList(array("shop_id"=>$shop_id,"common_state"=>1,'common_verify'=>1), array("common_add_time"=>"desc"), 1,12);
//                d($goods_new_list);
                /**-------------判断商品所在的店铺是否参加了满减送活动  @liuguilong 20170704 */
                $manModel = new ManSong_BaseModel();
                foreach($goods_new_list['items'] as $key0=>$val0){
                    $manArr = $manModel->getManSongByWhere(array('shop_id'=>$val0['shop_id']));
                    if(count($manArr) > 0){
                        $goods_new_list['items'][$key0]['is_man'] = 1;        //1 为参加了满减送活动
                    }else{
                        $goods_new_list['items'][$key0]['is_man'] = 0;        //0 为未参加满减活动
                    }
                }
                /**-------------end-----------------*/


                //取得 商品列表中所有商品的common_id
                $common_ids = array();
                foreach($goods_new_list['items'] as $key=>$val){
                    $common_ids[] = $val['common_id'];
                }

                //获取分享减的价格 qq、微信等
                $shareModel = new Share_BaseModel();
                $share_row['common_id:IN'] = array_column($goods_new_list['items'],'common_id');
                $sharesData =  $shareModel->getByWhere($share_row);

                foreach($goods_new_list['items'] as $key=>$val){
                    foreach($sharesData as $k=>$v){
                        if($v['common_id'] == $val['common_id']){
                            $goods_new_list['items'][$key]['share_total_price'] = $v['share_total_price'];
                            $goods_new_list['items'][$key]['promotion_total_price'] = $v['promotion_total_price'];
                            $goods_new_list['items'][$key]['share_price']['sqq'] = $v['sqq'];        //qq好友
                            $goods_new_list['items'][$key]['share_price']['qzone'] = $v['qzone'];    //qq空间
                            $goods_new_list['items'][$key]['share_price']['tsina'] = $v['tsina'];    //新浪
                            $goods_new_list['items'][$key]['share_price']['weixin'] = $v['weixin'];  //微信
                            $goods_new_list['items'][$key]['share_price']['weixin_timeline'] = $v['weixin_timeline'];    //微信朋友圈
                        }
                    }
                }

/*新品 end*/

/*推荐 start*/
				$goods_recom_list = $this->goodsCommonModel->getGoodsList(array("shop_id"=>$shop_id,"common_is_recommend"=>2,"common_state"=>1,'common_verify'=>1), array(), 1,12);

                //判断商品所在的店铺是否参加了满减送活动  @liuguilong 20170704
                foreach($goods_recom_list['items'] as $key1=>$val1){
                    $manArr = $manModel->getManSongByWhere(array('shop_id'=>$val1['shop_id']));
                    if(count($manArr) > 0){
                        $goods_recom_list['items'][$key1]['is_man'] = 1;        //1 为参加了满减送活动
                    }else{
                        $goods_recom_list['items'][$key1]['is_man'] = 0;        //0 为未参加满减活动
                    }
                }

                //取得 商品列表中所有商品的common_id
                $common_ids = array();
                foreach($goods_recom_list['items'] as $key=>$val){
                    $common_ids[] = $val['common_id'];
                }

                //获取分享减的价格 qq、微信等
                $shareModel = new Share_BaseModel();
                $share_row['common_id:IN'] = array_column($goods_recom_list['items'],'common_id');
                $sharesData =  $shareModel->getByWhere($share_row);

                foreach($goods_recom_list['items'] as $key=>$val){
                    foreach($sharesData as $k=>$v){
                        if($v['common_id'] == $val['common_id']){
                            $goods_recom_list['items'][$key]['share_total_price'] = $v['share_total_price'];
                            $goods_recom_list['items'][$key]['promotion_total_price'] = $v['promotion_total_price'];
                            $goods_recom_list['items'][$key]['share_price']['sqq'] = $v['sqq'];        //qq好友
                            $goods_recom_list['items'][$key]['share_price']['qzone'] = $v['qzone'];    //qq空间
                            $goods_recom_list['items'][$key]['share_price']['tsina'] = $v['tsina'];    //新浪
                            $goods_recom_list['items'][$key]['share_price']['weixin'] = $v['weixin'];  //微信
                            $goods_recom_list['items'][$key]['share_price']['weixin_timeline'] = $v['weixin_timeline'];    //微信朋友圈
                        }
                    }
                }
/*推荐 end*/

/*猜你喜欢 start*/
                $GoodsBaseModel = new Goods_BaseModel();
                $ShopGoodsLike = new Shop_GoodsLikeModel();
                $like_cond['like_state'] = $ShopGoodsLike::GOODS_LIKE_OPEN;
                $like_cond['shop_id'] = $shop_id;
                $shop_goods_like = array_merge($ShopGoodsLike->getByWhere($like_cond));

                foreach($shop_goods_like as $key=>$value)
                {
                    $common_good = $this->goodsCommonModel->getCommonListByCond(array('common_id'=>$value['common_id']));
                    if($common_good && $common_good[0])
                    {
                        $shop_goods_like[$key]['common_salenum'] = $common_good[0]['common_salenum'];
                        $shop_common_like[$key] = $common_good[0];
                    }else{
                        $ShopGoodsLike->editGoodsLike($value['like_id'],array('like_state'=>2,'state_date'=>date('Y-m-d H:i:s',time())));
                    }
                }


                foreach($shop_common_like as $key=>$value)
                {
                    $base = $GoodsBaseModel->getOne($value['id_goods']);

                    $manArr = $manModel->getManSongByWhere(array('shop_id'=>$value['shop_id']));
                    if(count($manArr) > 0){
                        $shop_common_like[$key]['is_man'] = 1;        //1 为参加了满减送活动
                    }else{
                        $shop_common_like[$key]['is_man'] = 0;        //0 为未参加满减活动
                    }

                    $shop_common_like[$key]['goods_evaluation_good_star'] = $base['goods_evaluation_good_star'];
                }

/*猜你喜欢 end*/

				//ajax 读取
				$goods_selling_list = $this->goodsCommonModel->getGoodsList(array("shop_id"=>$shop_id,"common_state"=>1,'common_verify'=>1), array("common_salenum"=> "desc"),1,5);
                /**-------------判断商品所在的店铺是否参加了满减送活动  @liuguilong 20170704 */
                foreach($goods_selling_list['items'] as $key2=>$val2){
                    $manArr = $manModel->getManSongByWhere(array('shop_id'=>$val2['shop_id']));
                    if(count($manArr) > 0){
                        $goods_selling_list['items'][$key2]['is_man'] = 1;        //1 为参加了满减送活动
                    }else{
                        $goods_selling_list['items'][$key2]['is_man'] = 0;        //0 为未参加满减活动
                    }
                }
                /**-------------end-----------------*/


				$goods_collec_list = $this->goodsCommonModel->getGoodsList(array("shop_id"=>$shop_id,"common_state"=>1,'common_verify'=>1), array("common_collect"=> "desc"),1,5);
                /**-------------判断商品所在的店铺是否参加了满减送活动  @liuguilong 20170704 */
                foreach($goods_collec_list['items'] as $key3=>$val3){
                    $manArr = $manModel->getManSongByWhere(array('shop_id'=>$val3['shop_id']));
                    if(count($manArr) > 0){
                        $goods_collec_list['items'][$key3]['is_man'] = 1;        //1 为参加了满减送活动
                    }else{
                        $goods_collec_list['items'][$key3]['is_man'] = 0;        //0 为未参加满减活动
                    }
                }
                /**-------------end-----------------*/
			}
			if ($shop_base['is_renovation']) {
				//根据店铺id，查询出装修编号
				$cat_row['shop_id'] = $shop_id;
				$decoration_row     = $this->shopDecorationModel->getOneByWhere($cat_row);
				//店铺装潢
				$decoration_detail = $this->shopDecorationModel->outputStoreDecoration($decoration_row['decoration_id'], $shop_id);
			}
//			var_dump($decoration_row);
			$title = Web_ConfigModel::value("shop_title");//首页名;
			$this->keyword = Web_ConfigModel::value("shop_keyword");//关键字;
			$this->description = Web_ConfigModel::value("shop_description");//描述;
			$this->title = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $title);
			$this->title = str_replace("{shopname}", $shop_base['shop_name'], $this->title);
			$this->keyword = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->keyword);
			$this->keyword = str_replace("{shopname}", $shop_base['shop_name'], $this->keyword);
			$this->description = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->description);
			$this->description = str_replace("{shopname}", $shop_base['shop_name'], $this->description);
		} else {
			$this->view->setMet('404');
		}


		//传递数据
		if ('json' == $this->typ) {
			$data['shop_base']          = empty($shop_base) ? array() : $shop_base;
			$data['shop_nav']           = empty($shop_nav) ? array() : $shop_nav;
			$data['shop_cat']           = empty($shop_cat) ? array() : $shop_cat;
			$data['goods_new_list']     = empty($goods_new_list) ? array() : $goods_new_list;
			$data['goods_recom_list']   = empty($goods_recom_list) ? array() : $goods_recom_list;
			$data['goods_selling_list'] = empty($goods_selling_list) ? array() : $goods_selling_list;
			$data['goods_collec_list']  = empty($goods_collec_list) ? array() : $goods_collec_list;
			/*echo '<pre>';
			print_r($data['shop_nav']);die;*/
			$this->data->addBody(-140, $data);

		} else {
			include $this->view->getView();
		}


	}

	/**
	 * 收藏店铺
	 *
	 * @author WenQingTeng
	 */
	public function addCollectShop()
	{
		$shop_id = request_int('shop_id');
		$data = array();
		$User_FavoritesShopModel = new User_FavoritesShopModel();
		//开启事物
		$User_FavoritesShopModel->sql->startTransactionDb();
		$data = array();
		$data['msg'] = '';

		if (Perm::checkUserPerm())
		{
			$user_id = Perm::$userId;
			//用户登录情况下,插入用户收藏商品表
			$add_row            = array();
			$add_row['user_id'] = $user_id;
			$add_row['shop_id'] = $shop_id;

			$res = $User_FavoritesShopModel->getByWhere($add_row);

			if ($res)
			{
				$flag        = false;
				$data['msg'] = _("您已收藏过该店铺！");

			}
			else
			{
				$Shop_BaseModel = new Shop_BaseModel();
				$shop_base      = $Shop_BaseModel->getOne($shop_id);

				$add_row['shop_name']           = $shop_base['shop_name'];
				$add_row['shop_logo']           = $shop_base['shop_logo'];
				$add_row['favorites_shop_time'] = get_date_time();


				$User_FavoritesShopModel->addShop($add_row);

				//店铺详情中收藏数量增加
				$edit_row                 = array();
				$edit_row['shop_collect'] = '1';
				$flag                     = $Shop_BaseModel->editBaseCollectNum($shop_id, $edit_row, true);
				fb($flag);
				fb($shop_id);
			}

		}
		else
		{
			$flag = false;
			$data['msg'] = '请先登录';
		}

		if ($flag && $User_FavoritesShopModel->sql->commitDb())
		{
			$status      = 200;
			$msg         = _('success');
			$data['msg'] = $data['msg'] ? $data['msg'] : _("收藏成功！");

			//店铺收藏成功添加数据到统计中心
			$analytics_data = array(
				'shop_id'=>$shop_id,
				'date'=>date('Y-m-d'),
			);
			YLB_Plugin_Manager::getInstance()->trigger('analyticsShopCollect',$analytics_data);
			/******************************************************/
		}
		else
		{
			$User_FavoritesShopModel->sql->rollBackDb();
			$m           = $User_FavoritesShopModel->msg->getMessages();
			$msg         = $m ? $m[0] : _('failure');
			$status      = 250;
			$data['msg'] = $data['msg'] ? $data['msg'] : _("收藏失败！");
		}

		$this->data->addBody(-140, $data, $msg, $status);
	}

	public function goodsList()
	{
        $YLB_Page           = new YLB_Page();
        $YLB_Page->listRows = 20;
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

        $shop_id = request_int('id');
        $sort    = request_string('sort');
        if ($sort == 'desc')
        {
            $new_sort = 'asc';
        }
        else
        {
            $new_sort = 'desc';
        }

        if($shop_id)
        {
            $this->shopCustomServiceModel = new Shop_CustomServiceModel;
            $cond_row['shop_id'] = $shop_id;
            $service = $this->shopCustomServiceModel->getServiceList($cond_row);
            if($service['items'])
            {
                foreach($service['items'] as $key => $val)
                {
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
        }

        //店铺信息
        $shop_base = $this->shopBaseModel->getOne($shop_id);
        //2.评分信息
        $shop_detail = $this->shopBaseModel->getShopDetail($shop_id);
        $shop_scores_num = ($shop_detail['shop_desc_scores']+$shop_detail['shop_service_scores']+$shop_detail['shop_send_scores'])/3;
        $shop_scores_count = sprintf("%.2f", $shop_scores_num);
        $shop_scores_percentage = $shop_scores_count * 20;
        //3.公司信息
        if($shop_base['shop_self_support']=='false')
        {
            $shop_all_base = $this->shopBaseModel->getbaseCompanyList($shop_id);
        }

        $data = array();

		if (!empty($shop_base) && $shop_base['shop_status'] == 3)
		{
            $Goods_CommonModel   = new Goods_CommonModel();
            $shopGoodCatModel = new Shop_GoodCatModel();
            $cond_row            = array();
            $order_row           = array();

			//店铺幻灯和幻灯对应的连接
			//$shop_slide     = explode(",", $shop_base['shop_slide']);
			//$shop_slide_url = explode(",", $shop_base['shop_slideurl']);

			//店铺导航
			$shop_nav = $this->shopNavModel->listByWhere(array("shop_id" => $shop_id,"status" => 1), array("displayorder" => "asc"));

            $search     = request_string('search');
            $order      = request_string('order');
            $price_from = request_int('price_from');
            $price_to   = request_int('price_to');
            $cat_id     = request_int('shop_cat_id');

            $cond_row['shop_id'] = $shop_id;

            $shop_cat_cond['parent_id'] = 0;
            $shop_cat_cond['shop_goods_cat_status'] = 1;
            $shop_cat_cond['shop_id'] = $shop_id;
            $shop_goods_cats = $shopGoodCatModel->getByWhere($shop_cat_cond, array('shop_goods_cat_displayorder'=>'ASC'));

            if($shop_goods_cats)
            {
                $shop_cat_row['goods_cat'] = $shop_goods_cats;
            }
            if($cat_id)
            {
                $shop_goods_cat = $shopGoodCatModel->getOne($cat_id);
                if($shop_goods_cat['parent_id'])
                {
                    //二级类目
                    $shop_cat_row['goods_cat'][$shop_goods_cat['parent_id']]['curr'] = 1;
                    $pid = $shop_goods_cat['parent_id'];
                }
                else
                {
                    //一级类目
                    $pid = $shop_goods_cat['shop_goods_cat_id'];
                    if(array_key_exists($cat_id,$shop_goods_cats))
                    {
                        $shop_cat_row['goods_cat'][$cat_id]['curr'] = 1;
                    }
                }

                $cat_sub_cond['parent_id'] = $pid;
                $cat_sub_cond['shop_goods_cat_status'] = 1;
                $cat_sub_order['shop_goods_cat_displayorder'] = 'ASC';
                $goods_sub_cats = $shopGoodCatModel->getByWhere($cat_sub_cond,$cat_sub_order);

                if($goods_sub_cats)
                {
                    if(array_key_exists($cat_id,$goods_sub_cats))
                    {
                        $goods_sub_cats[$cat_id]['curr'] = 1;
                        $cond_row['shop_cat_id:LIKE'] = "%$cat_id%";
                    }
                    else
                    {
                        $shop_cat_sids = array_keys($goods_sub_cats);
                        $cond_row['shop_cat_id:LIKEOR'] = $shop_cat_sids;
                    }
                    $shop_cat_row['goods_sub_cat'] = $goods_sub_cats;
                }
            }

            if ($search)
			{
				$cond_row['common_name:like'] = '%' . $search . '%';
			}

            if($price_from)
            {
                $cond_row['common_shared_price:>='] = $price_from;
            }
            if($price_to)
            {
                $cond_row['common_shared_price:<='] = $price_to;
            }

            if ($order)
            {
                $order_row = array($order => $sort);
            }

            $cond_row['common_state'] = Goods_CommonModel::GOODS_STATE_NORMAL;
            $cond_row['common_verify'] = 1;

            $data = $Goods_CommonModel->getGoodsListII($cond_row, $order_row, $page, $rows);

            //判断商品所在的店铺是否参加了满减送活动  @liuguilong 20170704
            /*$manModel = new ManSong_BaseModel();
            foreach($datas['items'] as $key0=>$val0){
                $manArr = $manModel->getManSongByWhere(array('shop_id'=>$val0['shop_id']));
                if(count($manArr) > 0){
                    $datas['items'][$key0]['is_man'] = 1;        //1 为参加了满减送活动
                }else{
                    $datas['items'][$key0]['is_man'] = 0;        //0 为未参加满减活动
                }
            }*/

            //取得 商品列表中所有商品的common_id
            /*$common_ids = array();
            foreach($datas['items'] as $key=>$val){
                $common_ids[] = $val['common_id'];
            }*/

            //获取分享减的价格 qq、微信等
            /*$shareModel = new Share_BaseModel();
            $share_row['common_id:IN'] = array_column($datas['items'],'common_id');
            $sharesData =  $shareModel->getByWhere($share_row);

            foreach($datas['items'] as $key=>$val){
                foreach($sharesData as $k=>$v){
                    if($v['common_id'] == $val['common_id']){
                        $datas['items'][$key]['share_total_price'] = $v['share_total_price'];
                        $datas['items'][$key]['promotion_total_price'] = $v['promotion_total_price'];
                        $datas['items'][$key]['share_price']['sqq'] = $v['sqq'];        //qq好友
                        $datas['items'][$key]['share_price']['qzone'] = $v['qzone'];    //qq空间
                        $datas['items'][$key]['share_price']['tsina'] = $v['tsina'];    //新浪
                        $datas['items'][$key]['share_price']['weixin'] = $v['weixin'];  //微信
                        $datas['items'][$key]['share_price']['weixin_timeline'] = $v['weixin_timeline'];    //微信朋友圈
                    }
                }
            }*/

			$YLB_Page->totalRows = $data['totalsize'];
			$page_nav = $YLB_Page->prompt();
        }
		else
		{
			$this->view->setMet('404');
		}

		if ('json' == $this->typ)
		{
		    $data['items'] = array_values($data['items']);
			$this->data->addBody(-140, $data);
		}
		else
		{
			include $this->view->getView();
		}

	}

	/**
	 *
	 * 获取店铺信息和推荐商品 wap
	 */
	public function getStoreInfo()
	{
		$data 			= array();
		$store_info 	= array();
		$rec_goods_list = array();
		$shop_id = request_int('shop_id');


		$condi_rec_goods['shop_id'] 			= $shop_id;
		$condi_rec_goods['common_state'] 		= Goods_CommonModel::GOODS_STATE_NORMAL;

		$goods_common_list = $this->goodsCommonModel->getbywhere( $condi_rec_goods );

		//读取推荐商品
		$order_order_id['order_id']				= 'DESC';
		$condi_rec_goods['common_is_recommend'] = Goods_CommonModel::RECOMMEND_TRUE;
		$rec_goods_list = $this->goodsCommonModel->getGoodsList($condi_rec_goods);
		$rec_goods_list = $rec_goods_list['items'];

		//读取店铺详情
		$shop_base = $this->shopBaseModel->getShopDetail($shop_id);
        
		//判断当前店铺是否为20用户所收藏
		$condi_u_f = array();
		$condi_u_f['user_id'] = Perm::$userId;
		$condi_u_f['shop_id'] = $shop_id;
		$userFavoritesShopModel = new User_FavoritesShopModel();
		$user_f_base = $userFavoritesShopModel->getByWhere($condi_u_f);
		if ( empty($user_f_base) )
		{
			$u_f_shop = false;
		}
		else
		{
			$u_f_shop = true;
		}

		//店铺幻灯片
		$shop_slide     = explode(",", $shop_base['shop_slide_wap']);
		$shop_slide_url = explode(",", $shop_base['shop_slideurl_wap']);

		$mb_sliders = array();

		if ( !empty($shop_slide) )
		{
			foreach ($shop_slide as $key => $silde_img)
			{
				$sliders['link'] = $shop_slide_url[$key];
				$sliders['imgUrl'] = $silde_img;

				array_push($mb_sliders, $sliders);
			}
		}
        foreach($mb_sliders as $key=>$value)
        {
          if(!$value['imgUrl'])
          {
            unset($mb_sliders[$key]);
          }
        }
        $mb_sliders = array_merge($mb_sliders);

		$store_info['goods_count'] 			= count($goods_common_list);
		$store_info['is_favorate'] 			= $u_f_shop;
		$store_info['is_own_shop']			= $shop_base['shop_self_support'];
		$store_info['mb_sliders'] 			= $mb_sliders;
		$store_info['mb_title_img'] 		= $shop_base['shop_banner'];
		$store_info['member_id'] 			= Perm::$userId;
		$store_info['store_avatar'] 		= $shop_base['shop_logo'];
		$store_info['store_wap_avatar']     = $shop_base['shop_logo_wap'];
		$store_info['user_name'] 		    = $shop_base['user_name'];
		$store_info['store_collect'] 		= $shop_base['shop_collect'];
		$store_info['store_credit_text'] 	= sprintf('描述: %.2f, 服务: %.2f, 物流: %.2f', $shop_base['shop_desc_scores'], $shop_base['shop_service_scores'], $shop_base['shop_send_scores'])  ;		//描述: 5.0, 服务: 5.0, 物流: 5.0
		$store_info['shop_id'] 				= $shop_base['shop_id'];
		$store_info['store_name'] 			= $shop_base['shop_name'];
		$store_info['user_id'] 				= $shop_base['user_id'];


		$data['rec_goods_list'] 		= $rec_goods_list;
		$data['rec_goods_list_count'] 	= count($rec_goods_list);
		$data['store_info'] 			= $store_info;

		$this->data->addBody(-140, $data);

	}

	/**
	 *获取店铺猜你喜欢人气王
     */
    public function getLikeAndHot()
    {
        $shop_id = request_int('shop_id');

        //获取人气王数据
        $hot_page = 1;
        $hot_row  = 20;

        $hot_cond['shop_id'] = $shop_id;
        $hot_order['common_salenum'] = 'DESC';
        $data['hot_goods'] = $this->goodsCommonModel->getCommonListByCond($hot_cond,$hot_order,$hot_page,$hot_row);

        //获取猜你喜欢数据
        $like_cond['like_state'] = 1;
        $like_cond['shop_id']  = $shop_id;
        $arr = array_merge($this->shopGoodsLikeModel->getByWhere($like_cond));
        foreach($arr as $key=>$value){
            $common_base = $this->goodsCommonModel->getOneByWhere($value['common_id']);
            if($common_base && $common_base['common_state'] == 1){
                $data['like_goods'][] = $value;
            }else{
                $this->shopGoodsLikeModel->editGoodsLike($value['like_id'],array('like_state'=>2,'state_date'=>date('Y-m-d H:i:s',time())));
            }
        }

		   if('json' == $this->typ)
		   {
			   $this->data->addBody(-140,$data);
		   }
    }

	/**
	 *
	 * wap 获取店铺满送 限时(店铺活动页面)
	 */
	public function getShopPromotion()
	{
		$mansong 	= array();

		$discountBaseModel = new Discount_BaseModel();
		$manSongBaseModel  = new ManSong_BaseModel();
        $voucherModel      = new Voucher_TempModel();
        $scareBuyBaseModel = new ScareBuy_BaseModel();
        $bundlingBaseModel = new Bundling_BaseModel();
        $increaseBaseModel = new Increase_BaseModel();
        $increaseGoodsModel = new Increase_GoodsModel();
		$discountGoodsModel = new Discount_GoodsModel();
		$newBuyerBaseModel = new NewBuyer_BaseModel();
        $Goods_BaseModel = new Goods_BaseModel();
        $User_FavoritesGoodsModel = new User_FavoritesGoodsModel();

		$shop_id = request_int('shop_id');
        $typp = request_string('type');

        //代金券
        $voucher = array();
        $voucher_base = $voucherModel->getVoucherTempList(array('shop_id'=>$shop_id,'voucher_t_state'=>1));
        foreach ($voucher_base['items'] as $key=>$value)
        {
            if(time() > strtotime($value['voucher_t_start_date']) && time() < strtotime($value['voucher_t_end_date']))
            {
                $voucher[] = $value;
            }
        }

        if($voucher)
        {
            $data['voucher'] = $voucher;
        }

		//劲爆折扣
        if($typp == 'two'){
            $discount = $discountGoodsModel->getDiscountGoodsList(array('shop_id'=>$shop_id,'discount_goods_state'=>1), array('discount_rate'=>'ASC'), 1, 4);
        }else{
            $discount = $discountGoodsModel->getDiscountGoodsList(array('shop_id'=>$shop_id,'discount_goods_state'=>1), array('discount_rate'=>'ASC'));
        }
        foreach($discount['items'] as $key =>$value){
            $fg['goods_id'] = $value['goods_id'];
            $fg['user_id'] = Perm::$userId;;
            $order_row = array();
            //查询user_id    goods_id收藏
            $res = $User_FavoritesGoodsModel->getKeyByWhere($fg, $order_row);
            if ($res) {
                $discount['items'][$key]['pl_status'] = 1;
            } else {
                //收藏状态0
                $discount['items'][$key]['pl_status'] = 0;
            }
            $discount['items'][$key]['sales_persent'] = (($value['goods_salenum']/($value['goods_stock']+$value['goods_salenum']))*100)."%";
        }

        if($discount['items'])
        {
            $data['discount'] = $discount['items'];
        }

		//获取店铺新人优惠信息
        if($typp == 'two') {
            $newBuyerList = $newBuyerBaseModel->getNewBuyerList(array('shop_id' => $shop_id,'newbuyer_state' => 1), array(), 1, 10);
        }else{
            $newBuyerList = $newBuyerBaseModel->getNewBuyerList(array('shop_id' => $shop_id,'newbuyer_state' => 1),array());
        }
        foreach ($newBuyerList['items'] as $key =>$value){
            $fg['goods_id'] =  $value['goods_id'];
            $fg['user_id'] = Perm::$userId;
            $order_row = array();
            //查询user_id    goods_id收藏
            $res = $User_FavoritesGoodsModel->getKeyByWhere($fg, $order_row);

            if ($res) {
                $newBuyerList['items'][$key]['pl_status'] = 1;
            } else {
                //收藏状态0
                $newBuyerList['items'][$key]['pl_status'] = 0;
            }
        }
        if($newBuyerList['items'])
        {
            $data['newbuyer'] = array_values($newBuyerList['items']);
        }

		//限时
		//$discount_list = $discountBaseModel->getDiscountActList( array('discount_state' => Discount_BaseModel::NORMAL, 'shop_id' => $shop_id) );
		//$xianshi = pos($discount_list['items']);



        //惠抢购
        if($typp == 'two'){
            $scare_base = $scareBuyBaseModel->getScareBuyGoodsList(array('shop_id'=>$shop_id,'scarebuy_state'=>2),array(),1,4);
        }else{
            $scare_base = $scareBuyBaseModel->getScareBuyGoodsList(array('shop_id'=>$shop_id,'scarebuy_state'=>2));
        }

		//$data['scareList'] = $scare_base['items'];
		$scare = array();
        foreach($scare_base['items'] as $key=>$value)
        {

            if(time()>strtotime($value['scarebuy_starttime']) && strtotime($value['scarebuy_endtime']) > time())
            {
                $scare[]=$value;
            }

        }
        if($scare)
        {
            $data['scare'] = $scare;
        }

        //加价购
        $increase = array();
        $increase_Base = $increaseBaseModel->getIncreaseActList(array('shop_id'=>$shop_id,'increase_state'=>1));
        foreach($increase_Base['items'] as $key=>$value)
        {
            $increase_goods_ids = $increaseGoodsModel->getKeyByWhere(array('increase_id'=>$value['increase_id']));
            if($increase_goods_ids)
            {
                if(time() > strtotime($value['increase_start_time']) && time() < strtotime($value['increase_end_time']))
                {
                    $increase[] = $value;
                }
            }
        }

        if($increase)
        {
            $data['increase'] = $increase;
        }


        //组合套装
        //$bundling_Base = $bundlingBaseModel->getBundlingActList(array('shop_id'=>$shop_id,'bundling_state'=>1));
        if($typp == 'two'){
            $bundling_Base = $bundlingBaseModel->getBundlingValidGoods(array('shop_id'=>$shop_id,'bundling_state'=>1),array(),1,2);
        }else{
            $bundling_Base = $bundlingBaseModel->getBundlingValidGoods(array('shop_id'=>$shop_id,'bundling_state'=>1));
        }

        foreach ($bundling_Base as $key => $value){
            foreach ($value['bundling_good'] as $k =>$v){
                $fg['goods_id'] = $v['goods_id'];
                $fg['user_id'] = Perm::$userId;;
                $order_row = array();
                //查询user_id    goods_id收藏
                $res = $User_FavoritesGoodsModel->getKeyByWhere($fg, $order_row);
                if ($res) {
                 $bundling_Base[$key]['bundling_good'][$k]['pl_status'] = 1;
                } else {
                 $bundling_Base[$key]['bundling_good'][$k]['pl_status'] = 0;
                }
            }

        }

        if($bundling_Base)
        {
            $data['bundling'] = $bundling_Base;
        }

		//满送
		$mansong_list = $manSongBaseModel->getManSongActList( array('mansong_state' => ManSong_BaseModel::NORMAL, 'shop_id' => $shop_id ) );

		$mansong_list_f = pos($mansong_list['items'] );

		if($mansong_list_f)
		{
			$mansong = $manSongBaseModel->getManSongActItem( array('shop_id' => $shop_id, 'mansong_id' => $mansong_list_f['mansong_id']) );
		}

		//去掉 rule 下 goods_id 为 0 的规则
//		foreach($mansong['rule'] as $key=>$val)
//		{
//			if($val['goods_id']==0 || $val['goods_name']=='')
//			{
//				unset($mansong['rule'][$key]);
//			}
//		}

        if($mansong){
            $data['mansong']= $mansong;
        }
        if(request_string(act)=='pc'){
            //为你推荐
            $shop_base_row = $this->shopBaseModel->getByWhere(array('shop_id'=>$shop_id));
            $sql = "SELECT * FROM ylb_goods_base WHERE goods_is_shelves=1  AND shop_id =".$shop_id." ORDER BY RAND() LIMIT 20";
            $data['wntj'] = $Goods_BaseModel->sql($sql);
            $data['shop_logo'] = $shop_base_row[$shop_id]['shop_logo_wap'];

        }
		$this->data->addBody(-140, $data);
	}

    /**
     * wap 店铺活动之代金券显示
     */
    public function getShopPromotionVoucher()
    {
        $shop_id = request_int('shop_id');
        $user_id = perm::$userId;

        $VoucherBaseModel = new Voucher_BaseModel();
        $VoucherTempModel = new Voucher_TempModel();

        $voucher_temp = $VoucherTempModel->getVoucherTempList(array('shop_id'=>$shop_id,'voucher_t_state'=>1));
        foreach ($voucher_temp['items'] as $key=>$value)
        {
            if(time() > strtotime($value['voucher_t_start_date']) && time() < strtotime($value['voucher_t_end_date']))
            {
                $voucher[] = $value;
            }
        }

        if(perm::checkUserPerm())
        {

            foreach($voucher as $key=>$value)
            {
                $arr = $VoucherBaseModel->getVoucherList(array('voucher_owner_id'=>$user_id,'voucher_shop_id'=>$shop_id,'voucher_t_id'=>$value['voucher_t_id']));

                if($arr['items'])
                {

                    if (count($arr['items']) >= $value['voucher_t_eachlimit'])
                    {

                        foreach ($arr['items'] as $k=>$v)
                        {
                            if ($v['voucher_state'] == 1)
                            {
                                $voucher[$key]['is_get'] = '1';

                            }
                            else
                            {
                                $voucher[$key]['is_over'] = '1';
                            }
                        }

                    }
                    else
                    {
                        //是否已领取
                        $voucher[$key]['is_get'] = '1';
                    }

                }


            }
        }

        foreach ($voucher as $key=>$value)
        {
            $shui = $VoucherBaseModel->getVoucherList(array('voucher_t_id'=>$value['voucher_t_id']));

            if($shui['items'])
            {
                $voucher[$key]['shui'] = count($shui['items']);
            }
        }

        $data['voucher'] = $voucher;

        $this->data->addBody(-140,$data);

    }

    /**
     *wap 店铺活动之今日疯抢
     */
    public function getShopPromotionRush()
    {
        $type = request_string('type');

        $shop_id = request_int('shop_id');

        $ScareBuyBaseModel =  new ScareBuy_BaseModel();

        $Scare_Base = $ScareBuyBaseModel->getScareBuyGoodsList(array('shop_id'=>$shop_id,'scarebuy_state'=>ScareBuy_BaseModel::NORMAL));

        foreach($Scare_Base['items'] as $key=>$value)
        {
            if(time() > strtotime($value['scarebuy_starttime']) && time() < strtotime($value['scarebuy_endtime']))
            {
                $Scare[] = $value;
            }

        }

        if($type == 'rush')
        {
            foreach($Scare as $key=>$value)
            {
                if($value['scarebuy_percent'] < 90)
                {
                    $data['items'][] = $value;
                }
            }
        }
        else if($type == 'will')
        {
            foreach($Scare as $key=>$value)
            {
                if($value['scarebuy_percent'] >= 90 && $value['scarebuy_percent'] < 100)
                {
                    $data['items'][] = $value;
                }
            }
        }
        else if($type == 'sell_out')
        {
            foreach ($Scare as $key=>$value)
            {
                if($value['scarebuy_percent'] == 100)
                {
                    $data['items'][] = $value;
                }
            }
        }
        else
        {
            $data['items'] = $Scare;
        }

        if(!$data['items'])
        {
            $data['items'] = array();
        }
        $this->data->addBody(-140,$data);
    }

    /**
     * wap 店铺活动之加一购
     */
    public function getShopPromotionAddGood()
    {

        $shop_id              = request_int('shop_id');
        $increase_id          = request_int('increase_id');
        $rule_id              = request_int('rule_id');
        $type                 = request_string('type');
        $Increase_BaseModel   = new Increase_BaseModel();
        $Mansong_BaseModel    = new ManSong_BaseModel();

        if($type == 'nav')
        {
            //获取加价购活动
            if($shop_id)
            {
                $increase_Base = $Increase_BaseModel->getValidIncreaseByWhere(array('shop_id'=>$shop_id));
                $data = $increase_Base;
            }
        }
        else
        {
            $typp  = request_string('type');
            $man = $Mansong_BaseModel->getManSongActList(array('shop_id'=>$shop_id));
            if($man['items'])
            {
                $data['is_man'] = 1;
            }
            else
            {
                $data['is_man'] = 0;
            }

            if($increase_id && $rule_id){

                $Increase_RuleModel        = new Increase_RuleModel();
                $Increase_RedempGoodsModel = new Increase_RedempGoodsModel();
                $goodsCommonModel          = new Goods_CommonModel();
                $User_FavoritesGoodsModel = new User_FavoritesGoodsModel();
                $cond_row['increase_id'] = $increase_id;

                $cond_row['rule_id']     = $rule_id;

                $row['rule'] = array_merge($Increase_RuleModel->getIncreaseRuleByWhere($cond_row, array('rule_price' => 'ASC')));
                if ($row['rule'])
                {
                    //活动下的换购商品
                    $redemption_goods = $Increase_RedempGoodsModel->getIncreaseRedempGoodsByWhere($cond_row, array('redemp_price' => 'ASC'));

                    if ($redemption_goods)
                    {
                        $refer_red_goods_id = array();
                        foreach ($redemption_goods as $key => $value)
                        {
                            $refer_red_goods_id[] = $value['goods_id'];
                        }
                        $refer_red_goods_rows = $this->Goods_BaseModel->gets($refer_red_goods_id);//活动下所有换购商品信息

                        $refer_common_ids = array_column($refer_red_goods_rows,'common_id');
                        $refer_common_rows = $goodsCommonModel->getNormalStateGoodsCommon($refer_common_ids);

                        $redemption_goods_row = array();

                        foreach ($redemption_goods as $key => $value)
                        {
                            if (in_array($value['goods_id'], array_keys($refer_red_goods_rows)))
                            {
                                $redemption_goods_row[$value['rule_id']][$key]                = $value;
                                $redemption_goods_row[$value['rule_id']][$key]['goods_name']  = $refer_red_goods_rows[$value['goods_id']]['goods_name'];
                                $redemption_goods_row[$value['rule_id']][$key]['goods_price'] = $refer_red_goods_rows[$value['goods_id']]['goods_price'];
                                $redemption_goods_row[$value['rule_id']][$key]['goods_image'] = $refer_red_goods_rows[$value['goods_id']]['goods_image'];
                                $redemption_goods_row[$value['rule_id']][$key]['goods_id']    = $refer_red_goods_rows[$value['goods_id']]['goods_id'];

                                if (in_array($refer_red_goods_rows[$value['goods_id']]['common_id'], array_keys($refer_common_rows)))
                                {
                                    $redemption_goods_row[$value['rule_id']][$key]['shared_price'] = $refer_common_rows[$refer_red_goods_rows[$value['goods_id']]['common_id']]['shared_price'];
                                }
                            }
                        }

                    }

                    foreach($redemption_goods_row as $key=>$value)
                    {
                        $redemption_goods_row[$key] = array_merge($value);
                    }

                    foreach ($row['rule'] as $key => $value)
                    {
                        if (in_array($value['rule_id'], array_keys($redemption_goods_row)))
                        {
                            foreach ($redemption_goods_row[$value['rule_id']] as $k => $vv)
                            {
                                $row['rule'][$key]['redemption_goods'][$k]['redemp_goods_id'] = $vv['redemp_goods_id'];
                                $row['rule'][$key]['redemption_goods'][$k]['redemp_price']    = $vv['redemp_price'];
                                $row['rule'][$key]['redemption_goods'][$k]['goods_name']      = $vv['goods_name'];
                                $row['rule'][$key]['redemption_goods'][$k]['goods_price']     = $vv['goods_price'];
                                $row['rule'][$key]['redemption_goods'][$k]['goods_image']     = $vv['goods_image'];
                                $row['rule'][$key]['redemption_goods'][$k]['goods_id']        = $vv['goods_id'];
                                $row['rule'][$key]['redemption_goods'][$k]['shared_price']        = $vv['shared_price'];
                            }
                        }
                        else
                        {
                            unset($row['rule'][$key]);
                        }
                    }
                }

                $data['rule'] = array_values($row['rule']);
            }else if($increase_id) {
                if($typp=='five'){
                    $data['items'] = $Increase_BaseModel->getIncreaseActDetail($increase_id,$typp);
                }else{
                    $data['items'] = $Increase_BaseModel->getIncreaseActDetail($increase_id);
                }

                    $Increase_RuleModel        = new Increase_RuleModel();
                    $Increase_RedempGoodsModel = new Increase_RedempGoodsModel();
                    $goodsCommonModel          = new Goods_CommonModel();

                    $cond_row['increase_id'] = $increase_id;

                    $row['rule'] = array_merge($Increase_RuleModel->getIncreaseRuleByWhere($cond_row, array('rule_price' => 'ASC')));

                    if ($row['rule'])
                    {
                        //活动下的换购商品
                        $redemption_goods = $Increase_RedempGoodsModel->getIncreaseRedempGoodsByWhere($cond_row, array('redemp_price' => 'ASC'));

                        if ($redemption_goods)
                        {
                            $refer_red_goods_id = array();
                            foreach ($redemption_goods as $key => $value)
                            {
                                $refer_red_goods_id[] = $value['goods_id'];
                            }
                            $refer_red_goods_rows = $this->Goods_BaseModel->gets($refer_red_goods_id);//活动下所有换购商品信息

                            $refer_common_ids = array_column($refer_red_goods_rows,'common_id');
                            $refer_common_rows = $goodsCommonModel->getNormalStateGoodsCommon($refer_common_ids);

                            $redemption_goods_row = array();

                            foreach ($redemption_goods as $key => $value)
                            {
                                if (in_array($value['goods_id'], array_keys($refer_red_goods_rows)))
                                {
                                    $redemption_goods_row[$value['rule_id']][$key]                = $value;
                                    $redemption_goods_row[$value['rule_id']][$key]['goods_name']  = $refer_red_goods_rows[$value['goods_id']]['goods_name'];
                                    $redemption_goods_row[$value['rule_id']][$key]['goods_price'] = $refer_red_goods_rows[$value['goods_id']]['goods_price'];
                                    $redemption_goods_row[$value['rule_id']][$key]['goods_image'] = $refer_red_goods_rows[$value['goods_id']]['goods_image'];
                                    $redemption_goods_row[$value['rule_id']][$key]['goods_id']    = $refer_red_goods_rows[$value['goods_id']]['goods_id'];

                                    if (in_array($refer_red_goods_rows[$value['goods_id']]['common_id'], array_keys($refer_common_rows)))
                                    {
                                        $redemption_goods_row[$value['rule_id']][$key]['shared_price'] = $refer_common_rows[$refer_red_goods_rows[$value['goods_id']]['common_id']]['shared_price'];
                                    }
                                }
                            }

                        }

                        foreach($redemption_goods_row as $key=>$value)
                        {
                            $redemption_goods_row[$key] = array_merge($value);
                        }

                        foreach ($row['rule'] as $key => $value)
                        {
                            if (in_array($value['rule_id'], array_keys($redemption_goods_row)))
                            {
                                foreach ($redemption_goods_row[$value['rule_id']] as $k => $vv)
                                {
                                    $row['rule'][$key]['redemption_goods'][$k]['redemp_goods_id'] = $vv['redemp_goods_id'];
                                    $row['rule'][$key]['redemption_goods'][$k]['redemp_price']    = $vv['redemp_price'];
                                    $row['rule'][$key]['redemption_goods'][$k]['goods_name']      = $vv['goods_name'];
                                    $row['rule'][$key]['redemption_goods'][$k]['goods_price']     = $vv['goods_price'];
                                    $row['rule'][$key]['redemption_goods'][$k]['goods_image']     = $vv['goods_image'];
                                    $row['rule'][$key]['redemption_goods'][$k]['goods_id']        = $vv['goods_id'];
                                    $row['rule'][$key]['redemption_goods'][$k]['shared_price']        = $vv['shared_price'];
                                }
                            }
                            else
                            {
                                unset($row['rule'][$key]);
                            }
                        }
                    }

                    $data['rule'] = array_values($row['rule']);
                } else {

                    $increase_list = $Increase_BaseModel->getIncreaseActList(array('shop_id'=>$shop_id));


                    //取其中一个展示

                    $increase_list_one = array_slice($increase_list['items'],0,1);

                    foreach($increase_list_one as $key=>$value)
                    {
                        if($typp=='five'){
                            $data['items'] = $Increase_BaseModel->getIncreaseActDetail($value['increase_id'],$typp);
                        }else{
                            $data['items'] = $Increase_BaseModel->getIncreaseActDetail($value['increase_id']);
                        }
                        $Increase_RuleModel        = new Increase_RuleModel();
                        $Increase_RedempGoodsModel = new Increase_RedempGoodsModel();
                        $goodsCommonModel          = new Goods_CommonModel();

                        $cond_row['increase_id'] = $value['increase_id'];

                        $row['rule'] = array_merge($Increase_RuleModel->getIncreaseRuleByWhere($cond_row, array('rule_price' => 'ASC')));

                        if ($row['rule'])
                        {
                            //活动下的换购商品
                            $redemption_goods = $Increase_RedempGoodsModel->getIncreaseRedempGoodsByWhere($cond_row, array('redemp_price' => 'ASC'));

                            if ($redemption_goods)
                            {
                                $refer_red_goods_id = array();
                                foreach ($redemption_goods as $key => $value)
                                {
                                    $refer_red_goods_id[] = $value['goods_id'];
                                }
                                $refer_red_goods_rows = $this->Goods_BaseModel->gets($refer_red_goods_id);//活动下所有换购商品信息

                                $refer_common_ids = array_column($refer_red_goods_rows,'common_id');
                                $refer_common_rows = $goodsCommonModel->getNormalStateGoodsCommon($refer_common_ids);

                                $redemption_goods_row = array();

                                foreach ($redemption_goods as $key => $value)
                                {
                                    if (in_array($value['goods_id'], array_keys($refer_red_goods_rows)))
                                    {
                                        $redemption_goods_row[$value['rule_id']][$key]                = $value;
                                        $redemption_goods_row[$value['rule_id']][$key]['goods_name']  = $refer_red_goods_rows[$value['goods_id']]['goods_name'];
                                        $redemption_goods_row[$value['rule_id']][$key]['goods_price'] = $refer_red_goods_rows[$value['goods_id']]['goods_price'];
                                        $redemption_goods_row[$value['rule_id']][$key]['goods_image'] = $refer_red_goods_rows[$value['goods_id']]['goods_image'];
                                        $redemption_goods_row[$value['rule_id']][$key]['goods_id']    = $refer_red_goods_rows[$value['goods_id']]['goods_id'];

                                        if (in_array($refer_red_goods_rows[$value['goods_id']]['common_id'], array_keys($refer_common_rows)))
                                        {
                                            $redemption_goods_row[$value['rule_id']][$key]['shared_price'] = $refer_common_rows[$refer_red_goods_rows[$value['goods_id']]['common_id']]['shared_price'];
                                        }
                                    }
                                }

                            }

                            foreach($redemption_goods_row as $key=>$value)
                            {
                                $redemption_goods_row[$key] = array_merge($value);
                            }

                            foreach ($row['rule'] as $key => $value)
                            {
                                if (in_array($value['rule_id'], array_keys($redemption_goods_row)))
                                {
                                    foreach ($redemption_goods_row[$value['rule_id']] as $k => $vv)
                                    {
                                        $row['rule'][$key]['redemption_goods'][$k]['redemp_goods_id'] = $vv['redemp_goods_id'];
                                        $row['rule'][$key]['redemption_goods'][$k]['redemp_price']    = $vv['redemp_price'];
                                        $row['rule'][$key]['redemption_goods'][$k]['goods_name']      = $vv['goods_name'];
                                        $row['rule'][$key]['redemption_goods'][$k]['goods_price']     = $vv['goods_price'];
                                        $row['rule'][$key]['redemption_goods'][$k]['goods_image']     = $vv['goods_image'];
                                        $row['rule'][$key]['redemption_goods'][$k]['goods_id']        = $vv['goods_id'];
                                        $row['rule'][$key]['redemption_goods'][$k]['shared_price']        = $vv['shared_price'];
                                    }
                                }
                                else
                                {
                                    unset($row['rule'][$key]);
                                }
                            }
                        }

                        $data['rule'] = array_values($row['rule']);
                    }

                }


        }

        $this->data->addBody(-140,$data);

    }

    /**
     * wap 店铺活动之满减送
     */
    public function getShopPromotionMan()
    {
        $shop_id = request_int('shop_id');

        $ManSong_BaseModel = new ManSong_BaseModel();

        $Goods_CommonModel = new Goods_CommonModel();

        if($shop_id)
        {
            $data['items']['man'] = $ManSong_BaseModel->getManSongActItem(array('shop_id'=>$shop_id));
        }

        $data['items']['recommend'] = $Goods_CommonModel->getCommonListByCond(array('shop_id'=>$shop_id),array('common_salenum'=>'DESC'),1,20);

        $this->data->addBody(-140,$data);
    }

    /**
     * wap 店铺活动之组合套餐
     */
    public function getShopPromotionBundling()
    {
        $shop_id       = request_int('shop_id');
        $Bundling_Base = new Bundling_BaseModel();
        $Bundling = $Bundling_Base->getBundlingValidGoods(array('shop_id'=>$shop_id));
        $data['items'] = $Bundling;
        $this->data->addBody(-140,$data);
    }

   /*
      wap 店铺活动 劲爆折扣
    */
    public function  getShopPromotionDiscount(){

        $shop_id     = request_int('shop_id');

        $discountGoodsModel = new Discount_GoodsModel();

        $data    = $discountGoodsModel->getDiscountGoodsList(array('shop_id'=>$shop_id));
//        d($data);
        $this->data->addBody(-140,$data);
    }


	/**
	 * 店铺详细信息
	 */
	public function getStoreIntro()
	{
		$data = array();
		$shop_id = request_int('shop_id');
		$shop_base = $this->shopBaseModel->getShopDetail($shop_id);

		$data['store_info'] = $shop_base;
		$this->data->addBody(-140, $data);
	}
	
	
	/**
	* 获取淘金员淘金的商品
	*/
	public function directsellerGoodsList()
	{
		$YLB_Page           = new YLB_Page();
		$YLB_Page->listRows = 20;
		$rows              = $YLB_Page->listRows;
		$offset            = request_int('firstRow', 0);
		$page              = ceil_r($offset / $rows);

		$wap_page = request_int('page');
		$wap_curpage = request_int('curpage');
		if ( !empty($wap_page) )
		{
			$rows = $wap_page;
		}

		if ( !empty($wap_curpage) )
		{
			$page = $wap_curpage;
		}

		$uid = request_int('uid');
		$sort    = request_string('sort');
 
		$cond_row['directseller_id'] = $uid;
		$Distribution_ShopDirectsellerModel = new Distribution_ShopDirectsellerModel();
		$shops = $Distribution_ShopDirectsellerModel->getByWhere($cond_row);
		$shop_ids = array_column($shops,'shop_id');
		
		$cond_good_row['shop_id:in'] = $shop_ids;
		$cond_good_row['common_is_directseller'] = 1;		
		if(request_string('keywords'))
		{
			$cond_good_row['common_name:LIKE'] = '%'.request_string('keywords').'%'; //商品名称搜索
		}
		
		$YLB_Page           = new YLB_Page();
		$YLB_Page->listRows = 10;
		$rows              = $YLB_Page->listRows;
		$offset            = request_int('firstRow', 0);
		$page              = ceil_r($offset / $rows);
		
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
					$order_row['common_price'] = $actorder;
				}
				else
				{
					$order_row['common_price'] = 'ASC';
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
		$data['user_id'] = $uid;
 
		//获取店铺名称
		$data['shop'] = $Distribution_ShopDirectsellerModel->getOneByWhere(array('directseller_id'=>$uid));
		$data['shop_qrcode'] = YLB_Registry::get('base_url')."/shop/api/qrcode.php?data=".urlencode(YLB_Registry::get('shop_wap_url')."/tmpl/directseller_store.html?uid=".$uid);
		$YLB_Page->totalRows = $data['totalsize'];
		$page_nav           = $YLB_Page->prompt();
		
		if ('json' == $this->typ)
		{
			$this->data->addBody(-140, $data);

		}
		else
		{
			include $this->view->getView();
		}

	}
	
	
	public function info()
	{
		$shop_id = request_int('id');
		$shop_base = $this->shopBaseModel->getShopDetail($shop_id);
		//2.评分信息
		$shop_detail = $this->shopBaseModel->getShopDetail($shop_id);
        $shop_scores_num = ($shop_detail['shop_desc_scores']+$shop_detail['shop_service_scores']+$shop_detail['shop_send_scores'])/3;
        $shop_scores_count = sprintf("%.2f", $shop_scores_num); 
        $shop_scores_percentage = $shop_scores_count * 20;
        
		$nav_cond_row  = array(
				"shop_id" => $shop_id,
				"status" => 1
		);
		$nav_order_row = array("displayorder" => "asc");
		//店铺导航
		$shop_nav = $this->shopNavModel->listByWhere($nav_cond_row, $nav_order_row);
	
		$nav_id = request_int('nav_id');
		$data = $this->shopNavModel->getOne($nav_id);
 
        if($shop_base['shop_self_support']=='false')
		{
            $shop_all_base = $this->shopBaseModel->getbaseCompanyList($shop_id);
        }
		if($shop_id)
		{
			$service = $this->getService($shop_id);
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
	
	public function getService($shop_id)
	{
		$this->shopCustomServiceModel = new Shop_CustomServiceModel;			
		$cond_row['shop_id'] = $shop_id;			
		$service = $this->shopCustomServiceModel->getServiceList($cond_row);
		if($service['items'])
		{
			foreach($service['items'] as $key => $val)
			{
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
			$service = array();
			$service = $de;
		}
		
		return $service;
	}

	//pc店铺活动页
	public function activity()
    {
        $data = array();

        //1.店铺信息
        $shop_id = request_int('id');
        $shop_base = $this->shopBaseModel->getShopDetail($shop_id);

        //2.评分信息
        $shop_scores_num = ($shop_base['shop_desc_scores']+$shop_base['shop_service_scores']+$shop_base['shop_send_scores'])/3;
        $shop_scores_count = sprintf("%.2f", $shop_scores_num);
        $shop_scores_percentage = $shop_scores_count * 20;

        //3.店铺导航
        $shop_nav = $this->shopNavModel->listByWhere(array("shop_id" => $shop_id,"status" => Shop_NavModel::OPEN), array("displayorder" => "asc"));

        if ('json' == $this->typ)
        {
            $this->data->addBody(-140, $data);
        }
        else
        {
            include $this->view->getView();
        }
    }

    //pc店铺活动详情
    public function actDetail()
    {
        $shop_id = request_int('id');

        $shop_base = $this->shopBaseModel->getShopDetail($shop_id);
        //2.评分信息
        $shop_detail = $this->shopBaseModel->getShopDetail($shop_id);
        $shop_scores_num = ($shop_detail['shop_desc_scores']+$shop_detail['shop_service_scores']+$shop_detail['shop_send_scores'])/3;
        $shop_scores_count = sprintf("%.2f", $shop_scores_num);
        $shop_scores_percentage = $shop_scores_count * 20;

        $nav_cond_row  = array(
            "shop_id" => $shop_id,
            "status" => 1
        );
        $nav_order_row = array("displayorder" => "asc");
        //店铺导航
        $shop_nav = $this->shopNavModel->listByWhere($nav_cond_row, $nav_order_row);

        $data      = array();

        if ('json' == $this->typ)
        {
            $this->data->addBody(-140, $data);
        }
        else
        {
            include $this->view->getView();
        }
    }

    //pc领店铺代金券
    public function shopVoucher()
    {
        $shop_id = request_int('id');
        $shop_base = $this->shopBaseModel->getShopDetail($shop_id);
        //2.评分信息
        $shop_detail = $this->shopBaseModel->getShopDetail($shop_id);
        $shop_scores_num = ($shop_detail['shop_desc_scores']+$shop_detail['shop_service_scores']+$shop_detail['shop_send_scores'])/3;
        $shop_scores_count = sprintf("%.2f", $shop_scores_num);
        $shop_scores_percentage = $shop_scores_count * 20;

        $nav_cond_row  = array(
            "shop_id" => $shop_id,
            "status" => 1
        );
        $nav_order_row = array("displayorder" => "asc");
        //店铺导航
        $shop_nav = $this->shopNavModel->listByWhere($nav_cond_row, $nav_order_row);

        $data      = array();

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
	 * 获取店铺分类
	 * @param shop_id:店铺id
	 * @param parent_id:父类id
	 * @author 刘贵龙 20170816
	 */
	public function getCatByShopId()
	{
		$shopGoodCatModel = new Shop_GoodCatModel();
		$map['shop_id'] = request_int('shop_id');
		$map['parent_id'] = request_int('parent_id');

		//获取店铺分类
		$data = $shopGoodCatModel->getShopCat($map);
		$this->data->addBody(-140, $data);
	}

}