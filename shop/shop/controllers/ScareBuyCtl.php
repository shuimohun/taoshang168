<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     Zhenzh
 */
class ScareBuyCtl extends Controller
{
	public $scareBuyBaseModel       = null;
	public $scareBuyQuotaModel      = null;
	public $scareBuyPriceRangeModel = null;
	public $scareBuyCatModel        = null;


	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);
        $this->initData();
		$this->web = $this->webConfig();
		$this->nav = $this->navIndex();
		$this->cat = $this->catIndex();

		if (!Web_ConfigModel::value('scarebuy_allow'))
		{
            $this->showMsg("惠抢购功能已经关闭!");
		}

		$this->scareBuyBaseModel       = new ScareBuy_BaseModel();
		$this->scareBuyQuotaModel      = new ScareBuy_QuotaModel();
		$this->scareBuyPriceRangeModel = new ScareBuy_PriceRangeModel();
		$this->scareBuyCatModel        = new ScareBuy_CatModel();
	}

	/**
	 * 惠抢购首页
	 *
	 * @access public
	 */
	public function index()
	{
        $YLB_Page           = new YLB_Page();
        $YLB_Page->listRows = request_int('listRows')?request_int('listRows'):20;
        $rows              = $YLB_Page->listRows;
        $offset            = request_int('firstRow', 0);
        $page              = ceil_r($offset / $rows);

        $data         = array();
        $cond_row     = array();
        if (request_string('state') == 'underway')
        {
            $cond_row['scarebuy_percent:>'] = ScareBuy_BaseModel::HOT;//即将售罄
            $cond_row['scarebuy_percent:<'] = ScareBuy_BaseModel::LOOTALL;//已抢光
        }
        elseif (request_string('state') == 'history')
        {
            $cond_row['scarebuy_percent'] = ScareBuy_BaseModel::LOOTALL;//已抢光
        }

        $cond_row['scarebuy_state']       = ScareBuy_BaseModel::NORMAL;
		$cond_row['scarebuy_starttime:>']  = date('Y-m-d H:i:s',time()-86400);
		$cond_row['scarebuy_starttime:<'] 	  = get_date_time();
        $cond_row['scarebuy_endtime:>'] 	  = get_date_time();
		$order_row['scarebuy_buy_quantity'] = 'DESC';

        $order_row['scarebuy_buy_quantity'] = 'DESC';
        $cond_row['scarebuy_recommend'] 	  = ScareBuy_BaseModel::RECOMMEND;
        $recommend = $this->scareBuyBaseModel->getScareBuyGoodsList($cond_row, $order_row, $page, $rows);
        if($recommend['items'])
		{
            $data['recommend'] = $recommend;
            $data['recommend']['time_over'] = date("Y-m-d 23:59:59",time());
		}

        $cond_row['scarebuy_recommend'] 	  = ScareBuy_BaseModel::UNRECOMMEND;

        if (request_int('cat_id'))
        {
            $cat_id                      = request_int('cat_id');
            $cond_row['scarebuy_cat_id'] = $cat_id;

            $cond_row_cat['scarebuy_cat_id'] = $cat_id;
            $cond_row_cat['scarebuy_cat_type'] = ScareBuy_CatModel::PHYSICALCAT;
            $data['current_cat'] = $this->scareBuyCatModel->getOneByWhere(array('scarebuy_cat_id'=>$cat_id));
        }

        if (request_int('scat_id'))
        {
            $scat_id                      = request_int('scat_id');
            $cond_row['scarebuy_scat_id'] = $scat_id;
        }

        $data['goods'] = $this->scareBuyBaseModel->getScareBuyGoodsList($cond_row, $order_row, $page, $rows);

        /*$shareBaseModel = new Share_BaseModel();
        if($data['goods'] && $data['goods']['items'])
		{
			foreach ($data['goods']['items'] as $key=>$value)
			{
                $share_base_data = $shareBaseModel->getShareByCommonId($value['common_id']);
                $data['goods']['items'][$key]['share_info'] = $share_base_data;
			}
		}*/
        $YLB_Page->totalRows      = $data['goods']['totalsize'];
        $page_nav                 = $YLB_Page->prompt();


        //惠抢购左侧分类
        $data['cat']['physical'] = $this->scareBuyCatModel->getScareBuyCatByWhere(array(
            "scarebuy_cat_type" => ScareBuy_CatModel::PHYSICALCAT,
            "scarebuy_cat_parent_id" => 0
        ));

        $title             = Web_ConfigModel::value("sc_title");//首页名;
        $this->keyword     = Web_ConfigModel::value("sc_keyword");//关键字;
        $this->description = Web_ConfigModel::value("sc_description");//描述;
        $this->title       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $title);
        $this->keyword       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->keyword);
        $this->description       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->description);

		if ('e' == $this->typ)
		{
			include $this->view->getView();
		}
		else
		{
            if(request_string('ua') === 'wap'){
                $sub_site_id = request_int('sub_site_id');
            }
            if(Web_ConfigModel::value('subsite_is_open') && isset($sub_site_id) && $sub_site_id > 0){
                $sub_suffix = '_'.$sub_site_id;
            }else{
                $sub_suffix = '';
            }
            $data['cat']['physical'] = array_values($data['cat']['physical']);

            $Adv_ConModel = new Operation_AdvertisementModel();
            $data['banner'] = $Adv_ConModel->getAdvList(array('group_id'=>Operation_AdvertisementModel::$adv_id['scarebuy_wap']));

			$this->data->addBody(-140, $data);
		}

	}

	//线上惠抢购列表
	public function scareBuyList()
	{
		$data      = array();
		$cond_row  = array();
		$order_row = array();

		$data['price_range'] = $this->scareBuyPriceRangeModel->getPriceRangeByWhere();
		//分页
		$YLB_Page           = new YLB_Page();
		$YLB_Page->listRows = request_int('listRows')?request_int('listRows'):20;
		$rows              = $YLB_Page->listRows;
		$offset            = request_int('firstRow', 0);
		$page              = ceil_r($offset / $rows);

		$cond_row['scarebuy_type'] = ScareBuy_BaseModel::ONLINEGBY;

		if (request_string('state') == 'underway') //即将售罄
		{
            $cond_row['scarebuy_percent:>'] = ScareBuy_BaseModel::HOT;
			$cond_row['scarebuy_starttime:>'] = get_date_time();
			$cond_row['scarebuy_state']       = ScareBuy_BaseModel::NORMAL;
		}
		elseif (request_string('state') == 'history') //已经结束
		{
			$cond_row['scarebuy_state'] = ScareBuy_BaseModel::FINISHED;
		}
		else
		{
			$cond_row['scarebuy_state']        = ScareBuy_BaseModel::NORMAL;
			$cond_row['scarebuy_starttime:<='] = get_date_time();
			$cond_row['scarebuy_endtime:>=']   = get_date_time();
		}

		if (request_int('price'))
		{
			$range_id        = request_int('price');
			$price_range_row = $this->scareBuyPriceRangeModel->getPriceRangeById($range_id);
			if ($price_range_row)
			{
				$cond_row['scarebuy_price:>='] = $price_range_row['range_start'];
				$cond_row['scarebuy_price:<='] = $price_range_row['range_end'];
			}
		}
		//排序
		$orderby = request_string('orderby');
		switch ($orderby)
		{
			case 'priceasc':
				$order_row['scarebuy_price'] = 'ASC';
				break;
			case 'pricedesc':
				$order_row['scarebuy_price'] = 'DESC';
				break;
			case 'ratedesc':
				$order_row['scarebuy_rebate'] = 'DESC';
				break;
			case 'rateasc':
				$order_row['scarebuy_rebate'] = 'ASC';
				break;
			case 'saledesc':
				$order_row['scarebuy_virtual_quantity'] = 'DESC';
				break;
			case 'saleasc':
				$order_row['scarebuy_virtual_quantity'] = 'ASC';
				break;
			default:
			{
				$order_row['scarebuy_price'] = 'ASC';
				break;
			}
		}

        $scarebuy_cat_row = $this->scareBuyCatModel->getScareBuyCatByWhere(array('scarebuy_cat_type' => ScareBuy_CatModel::PHYSICALCAT));
        if ($scarebuy_cat_row)
        {
            foreach ($scarebuy_cat_row as $key => $value)
            {
                if ($value['scarebuy_cat_parent_id'] == 0)
                {
                    $scarebuy_cat[$value['scarebuy_cat_id']] = $value;
                }
                else
                {
                    $scarebuy_cat[$value['scarebuy_cat_parent_id']]['scat'][$value['scarebuy_cat_id']] = $value;
                }
            }
            $data['scarebuy_cat'] = $scarebuy_cat;
        }

        $data['current_cat'] = array();
		if (request_int('cat_id'))
		{
			$cat_id                      = request_int('cat_id');
			$cond_row['scarebuy_cat_id'] = $cat_id;

            $cond_row_cat['scarebuy_cat_id'] = $cat_id;
            $cond_row_cat['scarebuy_cat_type'] = ScareBuy_CatModel::PHYSICALCAT;
            $data['current_cat'] = $this->scareBuyCatModel->getOneByWhere(array('scarebuy_cat_id'=>$cat_id));
		}

		if (request_int('scat_id'))
		{
			$scat_id                      = request_int('scat_id');
			$cond_row['scarebuy_scat_id'] = $scat_id;
		}

		$data['scarebuy_goods'] = $this->scareBuyBaseModel->getScareBuyGoodsList($cond_row, $order_row, $page, $rows);
		$YLB_Page->totalRows      = $data['scarebuy_goods']['totalsize'];
		$page_nav                 = $YLB_Page->prompt();

        $data['cat']['physical'] = $this->scareBuyCatModel->getScareBuyCatByWhere(array(
            "scarebuy_cat_type" => ScareBuy_CatModel::PHYSICALCAT,
            "scarebuy_cat_parent_id" => 0
        ));
        $data['cat']['virtual']  = $this->scareBuyCatModel->getScareBuyCatByWhere(array(
            "scarebuy_cat_type" => ScareBuy_CatModel::VIRTUAL,
            "scarebuy_cat_parent_id" => 0
        ));

		if ('e' == $this->typ)
		{
			$this->view->setMet('list');
			include $this->view->getView();
		}
		else
		{
            $data['cat']['physical'] = array_values($data['cat']['physical']);
            $data['cat']['virtual'] = array_values($data['cat']['virtual']);
			$this->data->addBody(-140, $data);
		}
	}

	//虚拟惠抢购列表
	public function vrScareBuyList()
	{
		$data      = array();
		$cond_row  = array();
		$order_row = array();
		//分页
		$YLB_Page           = new YLB_Page();
		$YLB_Page->listRows = request_int('listRows')?request_int('listRows'):12;
		$rows              = $YLB_Page->listRows;
		$offset            = request_int('firstRow', 0);
		$page              = ceil_r($offset / $rows);

		$cond_row['scarebuy_type'] = ScareBuy_BaseModel::VIRGBY;

		if (request_string('state') == 'underway')   //即将开始
		{
			$cond_row['scarebuy_starttime:>'] = get_date_time();
			$cond_row['scarebuy_state']       = ScareBuy_BaseModel::NORMAL;
		}
		elseif (request_string('state') == 'history') //已经结束
		{
			$cond_row['scarebuy_state'] = ScareBuy_BaseModel::FINISHED;
		}
		else
		{
			$cond_row['scarebuy_state']        = ScareBuy_BaseModel::NORMAL;
			$cond_row['scarebuy_starttime:<='] = get_date_time();
			$cond_row['scarebuy_endtime:>=']   = get_date_time();
		}



		if (request_int('price'))
		{
			$range_id        = request_int('price');
			$price_range_row = $this->scareBuyPriceRangeModel->getPriceRangeById($range_id);
			if ($price_range_row)
			{
				$cond_row['scarebuy_price:>='] = $price_range_row['range_start'];
				$cond_row['scarebuy_price:<='] = $price_range_row['range_end'];
			}
		}

		$scarebuy_cat_row = $this->scareBuyCatModel->getScareBuyCatByWhere(array('scarebuy_cat_type' => ScareBuy_CatModel::VIRTUAL));
		if ($scarebuy_cat_row)
		{
			foreach ($scarebuy_cat_row as $key => $value)
			{
				if ($value['scarebuy_cat_parent_id'] == 0)
				{
					$scarebuy_cat[$value['scarebuy_cat_id']] = $value;
				}
				else
				{
					$scarebuy_cat[$value['scarebuy_cat_parent_id']]['scat'][$value['scarebuy_cat_id']] = $value;
				}
			}
			$data['scarebuy_cat'] = $scarebuy_cat;
		}

        $data['current_cat'] = array();
		if (request_int('cat_id'))
		{
			$cat_id                      = request_int('cat_id');
			$cond_row['scarebuy_cat_id'] = $cat_id;

            $cond_row_cat['scarebuy_cat_id'] = $cat_id;
            $cond_row_cat['scarebuy_cat_type'] = ScareBuy_CatModel::VIRTUAL;
            $data['current_cat'] = $this->scareBuyCatModel->getOneByWhere(array('scarebuy_cat_id'=>$cat_id));
		}


		if (request_int('scat_id'))
		{
			$scat_id                      = request_int('scat_id');
			$cond_row['scarebuy_scat_id'] = $scat_id;
		}

		$orderby = request_string('orderby');
		switch ($orderby)
		{
			case 'priceasc':
				$order_row['scarebuy_price'] = 'ASC';
				break;
			case 'pricedesc':
				$order_row['scarebuy_price'] = 'DESC';
				break;
			case 'ratedesc':
				$order_row['scarebuy_rebate'] = 'DESC';
				break;
			case 'rateasc':
				$order_row['scarebuy_rebate'] = 'ASC';
				break;
			case 'saledesc':
				$order_row['scarebuy_virtual_quantity'] = 'DESC';
				break;
			case 'saleasc':
				$order_row['scarebuy_virtual_quantity'] = 'ASC';
				break;
			default:
			{
				$order_row['scarebuy_price'] = 'ASC';
				break;
			}
		}

		//$data['area']           = $this->scareBuyAreaModel->getScareBuyAreaByWhere(array('scarebuy_area_parent_id' => 0), array());
		$data['price_range']    = $this->scareBuyPriceRangeModel->getPriceRangeByWhere();
		$data['scarebuy_goods'] = $this->scareBuyBaseModel->getScareBuyGoodsList($cond_row, $order_row, $page, $rows);
		$YLB_Page->totalRows     = $data['scarebuy_goods']['totalsize'];
		$page_nav               = $YLB_Page->prompt();

        $data['cat']['physical'] = $this->scareBuyCatModel->getScareBuyCatByWhere(array(
            "scarebuy_cat_type" => ScareBuy_CatModel::PHYSICALCAT,
            "scarebuy_cat_parent_id" => 0
        ));
        $data['cat']['virtual']  = $this->scareBuyCatModel->getScareBuyCatByWhere(array(
            "scarebuy_cat_type" => ScareBuy_CatModel::VIRTUAL,
            "scarebuy_cat_parent_id" => 0
        ));

		if ('e' == $this->typ)
		{
			$this->view->setMet('vrList');
			include $this->view->getView();
		}
		else
		{
            $data['cat']['physical'] = array_values($data['cat']['physical']);
            $data['cat']['virtual'] = array_values($data['cat']['virtual']);
			$this->data->addBody(-140, $data);
		}
	}

	//惠抢购详情
	public function detail()
	{
		$data                    = array();
		$scarebuy_id             = request_int('id');
		$data['scarebuy_detail'] = $this->scareBuyBaseModel->getScareBuyDetailByID($scarebuy_id);

		$shop_id = $data['scarebuy_detail']['shop_id'];

		$Goods_CommonModel = new Goods_CommonModel();
		$goods_id          = $Goods_CommonModel->getNormalStateGoodsId($data['scarebuy_detail']['common_id']);
		$data['scarebuy_detail']['goods_id'] = $goods_id;

		//1.商品信息（商品活动信息，评论数，销售数，咨询数）
		$Goods_BaseModel = new Goods_BaseModel();
		$goods_detail    = $Goods_BaseModel->getGoodsDetailInfoByGoodId($goods_id);

		if ($data['scarebuy_detail'] && $goods_detail)
		{
			//更新浏览次数
			$this->scareBuyBaseModel->editScareBuy($scarebuy_id, array('scarebuy_views' => 1), true);

			//惠抢购分类
			$data['cat'] = $this->scareBuyCatModel->getCatName($data['scarebuy_detail']['scarebuy_cat_id'], $data['scarebuy_detail']['scarebuy_scat_id']);

			//热门惠抢购
			$cond_row_hot['scarebuy_state']         = ScareBuy_BaseModel::NORMAL;
			$cond_row_hot['scarebuy_starttime:<=']  = get_date_time();
			$cond_row_hot['scarebuy_endtime:>=']    = get_date_time();
			$data['hot_scarebuy'] = $this->scareBuyBaseModel->getScareBuyGoodsList($cond_row_hot, array('scarebuy_buy_quantity'=>'DESC'), 0, 5);;

			//惠抢购区域
			//$data['area'] = $this->scareBuyAreaModel->getScareBuyAreaList(array('scarebuy_area_parent_id' => 0), array(), 0, 12);

			if ($shop_id)
			{
				$Goods_CommonModel   = new Goods_CommonModel();
				$data_recommon       = $Goods_CommonModel->listByWhere(array(
																		   'common_is_recommend' => 1,
																		   'shop_id' => $shop_id
																	   ), array('common_sell_time' => 'desc'), 0, 4);
				$data_recommon_goods = $Goods_CommonModel->getRecommonRow($data_recommon);

				//推荐商品
				$data_foot_recommon       = $Goods_CommonModel->listByWhere(array(
																				'shop_id' => $shop_id
																			), array('common_is_recommend'=>'DESC'), 0, 5);
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
			}


			//1.商品信息（商品活动信息，评论数，销售数，咨询数）
			$Goods_BaseModel = new Goods_BaseModel();
			$goods_detail    = $Goods_BaseModel->getGoodsDetailInfoByGoodId($goods_id);

			//计算商品的销售数量1.直接显示本件商品的销售数量，2.显示本类common商品的销售数量

			$common_goods = $Goods_BaseModel->getByWhere(array('common_id' => $goods_detail['goods_base']['common_id']));
			$count_sale   = 0;
			foreach ($common_goods as $comkey => $comval)
			{
				$count_sale += $comval['goods_salenum'];
			}
			$goods_detail['goods_base']['count_sale'] = $count_sale;
			fb($goods_detail);
			fb("商品信息");

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


			//2.店铺信息
			$Shop_BaseModel = new Shop_BaseModel();
			$shop_detail    = $Shop_BaseModel->getShopDetail($shop_id);
			fb($shop_detail);
			fb("店铺详情");
			//获取店铺的消费者保障服务

			$Shop_ContractModel                  = new Shop_ContractModel();
			$shop_cond_row                       = array();
			$shop_cond_row['shop_id']            = $shop_id;
			$shop_cond_row['contract_state']     = Shop_ContractModel::CONTRACT_INUSE;
			$shop_cond_row['contract_use_state'] = Shop_ContractModel::CONTRACT_JOIN;
			$constract                           = $Shop_ContractModel->getByWhere($shop_cond_row);
			$data['shop']['constract']           = $constract;


			$title             = Web_ConfigModel::value("tg_title_content");//首页名;
			$this->keyword     = Web_ConfigModel::value("tg_keyword_content");//关键字;
			$this->description = Web_ConfigModel::value("tg_description_content");//描述;
			$this->title       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $title);
			$this->title       = str_replace("{name}", $data['scarebuy_detail']['scarebuy_name'], $this->title);
			$this->keyword       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->keyword);
			$this->keyword       = str_replace("{name}", $data['scarebuy_detail']['scarebuy_name'], $this->keyword);
			$this->description       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->description);
			$this->description       = str_replace("{name}", $data['scarebuy_detail']['scarebuy_name'], $this->description);

		}
		else
		{
			$this->view->setMet('404');
		}

		if ('e' == $this->typ)
		{
			include $this->view->getView();
		}
		else
		{
            $data['data_foot_recommon_goods'] = $data_foot_recommon_goods;
            $data['shop_base'] = $shop_detail;
			$this->data->addBody(-140, $data);
		}

	}

    //每日抢购
	public function dailySnapUp()
	{
		$data = array();

		//轮播图
        if(request_string('ua') === 'wap'){
            $sub_site_id = request_int('sub_site_id');
        }
        if(Web_ConfigModel::value('subsite_is_open') && isset($sub_site_id) && $sub_site_id > 0){
            $sub_suffix = '_'.$sub_site_id;
        }else{
            $sub_suffix = '';
        }
        $data['banner']['slider1']['slider_image'] = image_thumb(Web_ConfigModel::value('slider1_image'.$sub_suffix),1043,396);
        $data['banner']['slider1']['live_link'] = Web_ConfigModel::value('live_link1'.$sub_suffix);
        $data['banner']['slider2']['slider_image'] = image_thumb(Web_ConfigModel::value('slider2_image'.$sub_suffix),1043,396);
        $data['banner']['slider2']['live_link'] = Web_ConfigModel::value('live_link2'.$sub_suffix);
        $data['banner']['slider3']['slider_image'] = image_thumb(Web_ConfigModel::value('slider3_image'.$sub_suffix),1043,396);
        $data['banner']['slider3']['live_link'] = Web_ConfigModel::value('live_link3'.$sub_suffix);
        $data['banner']['slider4']['slider_image'] = image_thumb(Web_ConfigModel::value('slider4_image'.$sub_suffix),1043,396);
        $data['banner']['slider4']['live_link'] = Web_ConfigModel::value('live_link4'.$sub_suffix);


        $today = date("Y-m-d 00:00:00",time());
        $tomorrow = date("Y-m-d 00:00:00",strtotime("+1 day"));
        $after_tomorrow = date("Y-m-d 00:00:00",strtotime("+2 day"));

        //今日
        $cond_row['scarebuy_state']      = ScareBuy_BaseModel::NORMAL;
        $cond_row['scarebuy_starttime']  = $today;
        $cond_row['scarebuy_endtime'] 	 = $tomorrow;
        $cond_row['scarebuy_recommend'] = ScareBuy_BaseModel::RECOMMEND;
        $order_row['scarebuy_buy_quantity'] = 'DESC';
        $data['goods_today'] = $this->scareBuyBaseModel->getScareBuyGoodsList($cond_row, $order_row, 0, 20);
        $data['time_over'] = $tomorrow;

        //明日
        $a_cond_row['scarebuy_starttime'] = $tomorrow;
        $a_cond_row['scarebuy_endtime']   = $after_tomorrow;
        $a_cond_row['scarebuy_recommend'] = ScareBuy_BaseModel::RECOMMEND;
        $data['goods_tomorrow'] = $this->scareBuyBaseModel->getScareBuyGoodsList($a_cond_row, $order_row, 0, 20);

        $this->data->addBody(-140,$data);
	}

    public function todayScareBuy()
	{
        $data = $this->scareBuyBaseModel->getTodayScareBuyGoodsList();
        $this->data->addBody(-140,$data);
	}

	//首页的惠抢购
	public function getIndexScareBuy()
	{
		$type = request_int('type',0);//是否是超市

        //惠抢购Zhenzh
        $ScareBuy_BaseModel = new ScareBuy_BaseModel();
        $today = date("Y-m-d 00:00:00",time());
        $tomorrow = date("Y-m-d 00:00:00",strtotime("+1 day"));
        $after_tomorrow = date("Y-m-d 00:00:00",strtotime("+2 day"));
        //今日
        $cond_row['scarebuy_state']         = ScareBuy_BaseModel::NORMAL;
        $cond_row['scarebuy_starttime']     = $today;
        $cond_row['scarebuy_endtime']       = $tomorrow;
        $cond_row['scarebuy_recommend']     = ScareBuy_BaseModel::RECOMMEND;
        if($type)
		{
            $cond_row['shop_self_support'] = 1;
		}
        $order_row['scarebuy_buy_quantity'] = 'DESC';
        $goods_today = $ScareBuy_BaseModel->getScareBuyGoodsList($cond_row, $order_row, 0, 6);
        if($goods_today['records'] && $goods_today['records'] < 6)
        {
            for($i=0;$i<6-$goods_today['records'];$i++)
            {
                $goods_today['items'][] = array();
            }
        }
        //明日
        $cond_row['scarebuy_starttime'] = $tomorrow;
        $cond_row['scarebuy_endtime']   = $after_tomorrow;
        $goods_tomorrow = $ScareBuy_BaseModel->getScareBuyGoodsList($cond_row, $order_row, 0, 6);

        if($this->typ == 'json')
		{
            $data['today'] = $goods_today;
            $data['tomorrow'] = $goods_tomorrow;

            $this->data->addBody(-140,$data);
		}
		else
		{
			include $this->view->getView();
		}
	}


	//以下测试方法 Zhenzh
    var $return_array = array(); // 返回带有MAC地址的字串数组
    var $mac_addr;
	public function GetMacAddr($os_type){
        switch ( strtolower($os_type) ){
            case "linux":
                $this->forLinux();
                break;
            case "solaris":
                break;
            case "unix":
                break;
            case "aix":
                break;
            default:
                $this->forWindows();
                break;
        }
        $temp_array = array();
        foreach ( $this->return_array as $value ){
            if (
            preg_match("/[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f]/i",$value,
                $temp_array ) ){
                $this->mac_addr = $temp_array[0];
                break;
            }
        }
        unset($temp_array);
        return $this->mac_addr;
    }
    function forWindows(){
        @exec("ipconfig /all", $this->return_array);
        if ( $this->return_array )
            return $this->return_array;
        else{
            $ipconfig = $_SERVER["WINDIR"]."\system32\ipconfig.exe";
            if ( is_file($ipconfig) )
                @exec($ipconfig." /all", $this->return_array);
            else
                @exec($_SERVER["WINDIR"]."\system\ipconfig.exe /all", $this->return_array);
            return $this->return_array;
        }
    }
    function forLinux(){
        @exec("ifconfig -a", $this->return_array);
        return $this->return_array;
    }

    public function test()
    {



        /*$mac = $this->GetMacAddr(PHP_OS);
		echo $this->mac_addr;die;*/

        /*$url = 'http://ip.chinaz.com/getip.aspx';
        $post_data = [];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $result = curl_exec($ch);		//返回提交结果，格式与指定的格式一致（result=true代表成功）

        print_r($result);die;*/


        /*echo '<pre>';
        print_r($_SERVER);die;*/

    	//获取物理ip
         /*$mac = new GetMacAddr(PHP_OS);
         echo $mac->mac_addr;*/

        //跨项目通讯
        /*$key = YLB_Registry::get('shop_api_key');;
        $url       = YLB_Registry::get('shop_api_url');
        $app_id    = YLB_Registry::get('shop_app_id');
        $server_id = YLB_Registry::get('server_id');
        $formvars              = array();
        $formvars['app_id']    = $app_id;
        $formvars['server_id'] = $server_id;
        $formvars['ctl'] = 'Api_App_FindShop';
        $formvars['met'] = 'sureShop';
        $formvars['typ'] = 'json';
        $formvars['user_id']    = Perm::$userId;
        $rs = get_url_with_encrypt($key, $url, $formvars);
        if($rs['status'] == 200)
        {

        }*/


        //违禁词替换
        /*$msg = Text_Filter::filterWords(request_string('name'));
		echo $msg;*/

        //检测违禁词
        //$flag = Text_Filter::filterWords(request_string('name'));


		/*$time = get_time();
        $str = 'jsapi_ticket=kgt8ON7yVITDhtdwci0qeScCDVlYQ21u_SrL9OKm4XKceJD455dU53Z9pRfCje5hZvCETTU4fOB4Brtc-JeuNw&noncestr=Wm3WZYTPz0wzccnW&timestamp='.$time.'&url=http://www.taoshang168.com/wxshare.html';
		echo $time;echo '|';echo sha1($str);die;*/

        /*set_time_limit(180);
        $goodsCommonModel = new Goods_CommonModel();
        $goodsCatModel    = new Goods_CatModel();

        $page = request_int('page',1);

        $goods_common_data = $goodsCommonModel->select_sql('SELECT common_id,cat_id FROM ylb_goods_common WHERE cat_id > 0 AND cat_pid = 0 ORDER BY common_id',$page,1000);
        if($goods_common_data)
        {
            foreach ($goods_common_data['items'] as $key=>$value)
            {
                $cat_pid = $goodsCatModel->getTopParentCat($value['cat_id']);

                if($cat_pid)
                {
                    $goodsCommonModel->editCommon($value['common_id'],array('cat_pid'=>$cat_pid['cat_id']));
                }
            }
        }*/


        $data = array();
		if($this->typ == 'json')
		{
            /*set_time_limit(180);
            $page = request_int('page',1);
            $Information = new Information_BaseModel();
            $row = $Information->listByWhere([],['information_id'=>'asc'],$page);
            foreach ($row['items'] as $key => $value)
            {
                $video_row = get_html_attr_by_tag($value['information_desc'],'src','video,embed');
                if ($video_row)
                {
                    $filed['information_video'] = $video_row;
                    $Information->editBase($value['information_id'],$filed);
                }
            }*/

            /*set_time_limit(180);
            $page = request_int('page',1);
            $SherPriceModel    = new Share_PriceModel();
            $sql = 'SELECT a.id,b.common_name,b.common_price,b.common_image FROM ylb_share_price a LEFT JOIN ylb_goods_common b ON a.`common_id` = b.common_id WHERE a.common_id > 0';
            $data = $SherPriceModel->select_sql($sql,$page,1000);
            if($data)
            {
                foreach ($data['items'] as $key => $value)
                {
					$filed['goods_name'] = $value['common_name'];
                    $filed['goods_price'] = $value['common_price'];
                    $filed['goods_image'] = $value['common_image'];
                    $SherPriceModel->editSharePrice($value['id'],$filed);
                }
            }

            $this->data->addBody(-140,$data);*/
		}
		else
		{
            include $this->view->getView();
		}

    }

    public function kuaidi()
	{

		/*param=
		{
			"partnerId":"",     //电子面单客户账户，需向快递公司在贵司当地的网点申请；若已和快递100超市业务合作，则可不填。
			"partnerKey":"",    //电子面单密码，需向快递公司在贵司当地的网点申请；若已和快递100超市业务合作，则可不填。
			"net":"",           //收件网点名称,由快递公司当地网点分配，若已和快递100超市业务合作，则可不填。

			"kuaidicom":"ems",    //快递公司的编码，一律用小写字母，见《快递公司编码》,必填
			"kuaidinum":"",    //快递单号，单号的最大长度是32个字符,非必填
			"orderId":"",      //贵司内部自定义的订单编号,需要保证唯一性，非必填
			"recMan":
			{
				"name":"",        //收件人姓名，必填
				"mobile":"",      //收件人的手机号，手机号和电话号二者其一必填
				"tel":"",         //收件人的电话号，手机号和电话号二者其一必填
				"zipCode":"",     //收件人所在地的编箱号，非必填
				"province":"",     // 收件人所在省份，如广东省，province,city,distinct,addr 和 printAddr 任选一个必填
				"city":"",         // 收件人所在市，如深圳市, province,city,distinct,addr 和 printAddr 任选一个必填
				"district":"",     // 收件人所在区，如南山区, province,city,distinct,addr 和 printAddr 任选一个必填
				"addr":"",     //收件人所在地址，如科技南十二路2号金蝶软件园, province,city,distinct,addr 和 printAddr 任选一个必填
				"printAddr":"",     // 收件人所在完整地址，如广东深圳市深圳市南山区科技南十二路2号金蝶软件园, province,city,distinct,addr 和 printAddr 任选一个必填。如果有填写province，city，distinct，addr 则系统优先读取province，city，distinct，addr；如果只填写printAddr，系统将自动识别对应的省、市与区
				"company":""       //收件人所在公司名称，非必填
			},
			"sendMan":
			{
				"name":"",      //寄件人姓名，必填
				"mobile":"",    //寄件人的手机号，手机号和电话号二者其一必填
				"tel":"",       //寄件人的电话号，手机号和电话号二者其一必填
				"zipCode":"",   //寄件人所在地的邮编号，非必填
				"province":"",  // 寄件人所在省份，如广东省，必填, province,city,distinct,addr 和 printAddr 任选一个必填

				"city":"",       // 寄件人所在市，如深圳市, province,city,distinct,addr 和 printAddr 任选一个必填
				"district":"",   // 寄件人所在区，如南山区, province,city,distinct,addr 和 printAddr 任选一个必填
				"addr":"",    //寄件人所在地址，如高新南十八道20号xxx, province,city,distinct,addr 和 printAddr 任选一个必填
				"printAddr":"",  // 寄件人所在的完整地址，如广东深圳市深圳市南山区科技南十二路2号金蝶软件园B10, province,city,distinct,addr 和 printAddr 任选一个必填。如果有填写province，city，distinct，addr 则系统优先读取province，city，distinct，addr；如果只填写printAddr，系统将自动识别对应的省、市与区
				"company":""   //寄件人所在公司名称，非必填
			},
			"cargo":"",        // 物品名称，非必填
			"count":"",       //物品总数量，int类型，非必填
			"weight":"",      //物品总重量KG，double类型，非必填
			"volumn":"",      //物品总体积，CM*CM*CM，double类型，非必填
			"payType":"",     // 支付方式：SHIPPER:寄方付（默认）、CONSIGNEE:到付、MONTHLY:月结、THIRDPARTY:第三方支付，非必填
			"expType":"",     // 快递类型:标准快递（默认）、顺丰特惠、EMS经济，非必填
			"remark":"",      //备注,String类型，非必填
			"valinsPay":" ",  //保价额度,double类型，非必填
			"collection":"",  //代收货款额度，double类型，非必填
			"needChild":"0", //是否需要子单：1:需要、0:不需要(默认) ，String类型，非必填
			"needBack":"0", //是否需要回单：1:需要、 0:不需要(默认) ，String类型，非必填
			"needTemplate":"是否需要打印模板", //是否需要打印模板：1:需要、 0 不需要(默认) ，如果需要，则返回要打印的模版的HTML代码，贵司可以直接将之显示到IE等浏览器，然后通过浏览器进行打印，详见4.2。String类型，非必填

		}*/


       /* $ch = curl_init();
        $key = "WgdfXNas6087";
        $secret = "cc248f40e8c5414fad57b8cdce5f16ec";
		$t = get_time();

        $param=array('text'=>$text,'apikey'=>$apikey,'mobile'=>$mobile);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt ($ch, CURLOPT_URL, 'https://sms.yunpian.com/v2/sms/single_send.json');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        $json_data = curl_exec($ch);
        curl_close($ch);
        return $json_data;*/
	}

    //批量导入店铺 Zhenzh
    public function importShop()
    {
    	/*$sellerBaseModel = new Seller_BaseModel();
        $shopBaseModel = new Shop_BaseModel();
        $sql = 'SELECT userid,USER,catid,company,tel,addr,provinceid,cityid,areaid,streetid,AREA,logo,stime,etime,view_times,create_time,shop_type,shop_collect,earnest,grade,shop_auth,shopkeeper_auth,shop_auth_pic,shopkeeper_auth_pic,shopkeeper_auth_pic_back,lng,lat FROM taoshang168_new.mallbuilder_shop';
        $data = $shopBaseModel->select_sql($sql,1,100);

        set_time_limit(180);
        if($data)
        {
            foreach ($data['items'] as $key=>$value)
            {
                $userid = $value['userid'];//用户id
                $USER= $value['USER'];//用户名
                $catid= $value['catid'];//
                $company= $value['company'];//店铺名
                $tel= $value['tel'];//电话
                $addr= $value['addr'];//地址--
                $provinceid= $value['provinceid'];//省
                $cityid= $value['cityid'];//市
                $areaid= $value['areaid'];//区
                $streetid= $value['streetid'];//
                $AREA= $value['AREA'];//地址
                $logo= $value['logo'];//
                $stime= $value['stime'];//有效期开始
                $etime= $value['etime'];//有效期结束
                $view_times= $value['view_times'];//点击率
                $create_time= $value['create_time'];//开店时间
                //$shop_type= $value['shop_type'];//
                $shop_collect= $value['shop_collect'];//收藏数
                $earnest= $value['earnest'];//保证金
                $grade= $value['grade'];//店铺等级
                $shop_auth= $value['shop_auth'];//店铺认证
                $shopkeeper_auth= $value['shopkeeper_auth'];//店主认证
                $shop_auth_pic= $value['shop_auth_pic'];//店铺认证图片
                $shopkeeper_auth_pic= $value['shopkeeper_auth_pic'];//店主认证图片
                $shopkeeper_auth_pic_back= $value['shopkeeper_auth_pic_back'];//身份证反面照
                $lng= $value['lng'];//经度
                $lat= $value['lat'];//纬度

                $sql = 'SELECT user_id FROM `ucenter_user_info` WHERE userid = '.$userid;
                $u_data = $shopBaseModel->select_sql($sql,1,1);

                if($u_data)
				{
					$user_id = $u_data['items'][0]['user_id'];
					if($user_id > 0)
					{
                        $cond_row['user_id'] = $user_id;
                        $cond_row['user_name'] = $USER;
                        $cond_row['shop_name'] = $company;
                        //shop_grade_id,shop_class_id
                        $cond_row['shop_create_time'] = date('Y-m-d H:i:s',$create_time);
                        if($etime)
                        {
                            $cond_row['shop_end_time'] = date('Y-m-d H:i:s',$etime);
                        }
                        $cond_row['shop_longitude'] = $lng;
                        $cond_row['shop_latitude'] = $lat;
                        $cond_row['shop_logo'] = $logo;
                        $cond_row['shop_logo_wap'] = $logo;
                        $cond_row['shop_status'] = 3;
                        $cond_row['shop_collect'] = $shop_collect;
                        $cond_row['shop_address'] = $addr;
                        $cond_row['shop_tel'] = $tel;
                        $cond_row['shop_payment'] = 1;
                        $cond_row['joinin_year'] = 1;
                        $cond_row['district_id'] = $areaid;
                        $cond_row['shop_grade_id'] = 0;
                        if($grade == 5)
                        {
                            $cond_row['shop_grade_id'] = 2;
                        }

                        $shop = $shopBaseModel->getOneByWhere(array('shop_name'=> $company));
                        if(!$shop)
                        {
                            $shop_id = $shopBaseModel->addBase($cond_row,true);

                            $sql = 'SELECT shop_id,shop_logo,shop_banner,shop_slide,shop_slideurl FROM taoshang168_new.mallbuilder_shop_setting WHERE shop_id = '.$userid;
                            $d_data = $shopBaseModel->select_sql($sql);
                            if($d_data)
                            {
                                $detail = $d_data['items'][0];
                            }
                            if($detail)
                            {

								$cond_row_detail['shop_logo'] = $detail['shop_logo'];
								$cond_row_detail['shop_logo_wap'] = $detail['shop_logo'];

                                $cond_row_detail['shop_banner'] = $detail['shop_banner'];//banner
                                $cond_row_detail['shop_slide'] = $detail['shop_slide'];//slide 逗号隔开
                                $cond_row_detail['shop_slideurl'] = $detail['shop_slideurl'];//slide链接 逗号隔开

                                $shopBaseModel->editBase($shop_id,$cond_row_detail);
                            }

                            $cond_row_seller['seller_name'] = $USER;
                            $cond_row_seller['shop_id'] = $shop_id;
                            $cond_row_seller['user_id'] = $user_id;
                            $cond_row_seller['rights_group_id'] = 0;
                            $cond_row_seller['seller_is_admin'] = 1;
                            $cond_row_seller['seller_login_time'] = get_date_time();
                            $cond_row_seller['seller_group_id'] = 0;
                            $sellerBaseModel->addBase($cond_row_seller);
                        }
					}
				}
            }
        }*/
    }

    //导入商家店铺内的分类 Zhenzh
    public function importShopCat()
	{
		/*$shopGoodsCatBaseModel = new Shop_GoodCatModel();
        $shopBaseModel = new Shop_BaseModel();
        $sql = 'SELECT id,userid,`name` FROM taoshang168_new.mallbuilder_custom_cat WHERE pid = 0 ORDER BY id';
        $data = $shopGoodsCatBaseModel->select_sql($sql,1,100);
        set_time_limit(0);
        if($data)
		{
            foreach ($data['items'] as $key=>$value)
			{
				$id = $value['id'];
				$userid = $value['userid'];
                $name = $value['name'];
                $sql = 'SELECT user_id FROM `ucenter_user_info` WHERE userid = '.$userid;
                $u_data = $shopBaseModel->select_sql($sql,1,1);
				if($u_data)
				{
                    $user_id = $u_data['items'][0]['user_id'];
                    $shop_data = $shopBaseModel->getOneByWhere(array('user_id'=>$user_id));
                    if($shop_data)
					{
                        $shop_id = $shop_data['shop_id'];

                        $cond_row['shop_goods_cat_name'] = $name;
                        $cond_row['shop_id'] = $shop_id;
                        $cond_row['parent_id'] = 0;
                        $cond_row['shop_goods_cat_displayorder'] = 0;
                        $cond_row['shop_goods_cat_status'] = 1;
                        $cond_row['old_id'] = $id;
                        $goods_cat_id = $shopGoodsCatBaseModel->addGoodCat($cond_row,true);

                        $sql = 'SELECT id,`name` FROM taoshang168_new.mallbuilder_custom_cat WHERE pid = '.$id.' ORDER BY id';
                        $sub_data = $shopGoodsCatBaseModel->select_sql($sql,1,100);
                        if($sub_data)
                        {
                            foreach ($sub_data['items'] as $k=>$v)
                            {
                                $cond_row_sub['shop_goods_cat_name'] = $v['name'];
                                $cond_row_sub['shop_id'] = $shop_id;
                                $cond_row_sub['parent_id'] = $goods_cat_id;
                                $cond_row_sub['shop_goods_cat_displayorder'] = 0;
                                $cond_row_sub['shop_goods_cat_status'] = 1;
                                $cond_row_sub['old_id'] = $v['id'];
                                $shopGoodsCatBaseModel->addGoodCat($cond_row_sub,true);
                            }
                        }
					}
				}
			}
		}*/
	}

	//导入商品 Zhenzh
    public function importGoods()
	{
		/*$goodsCommonModel = new Goods_CommonModel();
        $shopBaseModel = new Shop_BaseModel();
        $goodsCatModel = new Goods_CatModel();
        $shopGoodsCatModel = new Shop_GoodCatModel();
        $share_model = new Share_BaseModel();
        $goodsCommonDetailModel = new Goods_CommonDetailModel();
        $goodsImagesModel = new Goods_ImagesModel();
        $goodsBaseModel = new Goods_BaseModel();
        $sql = 'SELECT id,member_id,catid,`type`,`name`,subhead,keywords,market_price,price,stock,sales,`code`,pic,pic_more,cubage,province_id,city_id,area_id,street_id,`area`,clicks,`status`,is_shelves,custom_cat_id,goodbad,shop_rec,uptime FROM taoshang168_new.mallbuilder_product';
        $data = $goodsCommonModel->select_sql($sql,3,500);

        set_time_limit(0);
        if($data)
        {
        	foreach ($data['items'] as $key=>$value)
			{
				$id =  $value['id'];
                $member_id = $value['member_id'];//用户id
                $catid = $value['catid'];//分类id
                $type = $value['type'];//类型
				$name = $value['name'];//商品名称
				$subhead = $value['subhead'];//标题
				$keywords = $value['keywords'];//关键字
				$market_price = $value['market_price'];//市场价
				$price = $value['price'];//价格
				$stock = $value['stock'];//库存
				$sales = $value['sales'];//销量
				$code = $value['code'];//货号
				$pic = $value['pic'];//图片
				$pic_more = $value['pic_more'];//多图
				$cubage = $value['cubage'];//重量
				$province_id = $value['province_id'];//省
				$city_id = $value['city_id'];//市
				$area_id = $value['area_id'];//区
				$street_id = $value['street_id'];//街道
				$area = $value['area'];//地区
				$clicks = $value['clicks'];//点击量
				$status = $value['status'];//点击率
				$is_shelves = $value['is_shelves'];//是否上架
				$custom_cat_id = $value['custom_cat_id'];//店铺内分类
				$goodbad = $value['goodbad'];//评分
				$shop_rec = $value['shop_rec'];//推荐
                $uptime = $value['uptime'];//更新时间 时间戳

                $sql = 'SELECT user_id FROM `ucenter_user_info` WHERE userid = '.$member_id;
                $u_data = $goodsCommonModel->select_sql($sql,1,1);

                if($u_data)
                {
                    $user_id = $u_data['items'][0]['user_id'];
                    $shop_data = $shopBaseModel->getOneByWhere(array('user_id'=>$user_id));
                    if($shop_data)
                    {
                        $shop_id = $shop_data['shop_id'];
                        $shop_name = $shop_data['shop_name'];

                        $common_data['common_name'] = $name;//商品名称
						if($subhead)
						{
                            $common_data['common_promotion_tips'] = $subhead;//副标题
						}
						else
						{
							$common_data['common_promotion_tips'] = '';//副标题
						}

                        $goodsCat = $goodsCatModel->getOneByWhere(array('catid'=>$catid));
                        if($goodsCat)
						{
                            $common_data['cat_id'] = $goodsCat['cat_id'];//商品分类id
                            $common_data['cat_name'] = $goodsCat['cat_name'];//商品分类名称
						}
						else
						{
							$common_data['cat_id'] = 0;//商品分类id
                            $common_data['cat_name'] = '';//商品分类名称
						}
                        $common_data['shop_id']    	= $shop_id;                        //店铺id
                        $common_data['shop_name']   = $shop_name;                       //店铺名称

                        $shopGoodsCat = $shopGoodsCatModel->getOneByWhere(array('old_id'=>$custom_cat_id));
                        if($shopGoodsCat)
						{
                            $shop_goods_cat_id = $shopGoodsCat['shop_goods_cat_id'];
                            $common_data['shop_cat_id'] = ','.$shop_goods_cat_id.',';   //店铺分类id
                            $common_data['shop_goods_cat_id'] = array($shop_goods_cat_id);   //店铺分类id
						}
						else
						{

						}
                        $common_data['shop_self_support'] = 0;   //是否自营
                        $common_data['shop_status'] = 3;		//店铺状态
                        $common_data['common_image'] = $pic;//主图
                        $common_data['common_state'] = $is_shelves;
                        $common_data['common_verify'] = 1;
                        $common_data['common_add_time'] = date('Y-m-d H:i:s',$uptime);
                        $common_data['common_sell_time'] = $common_data['common_add_time'];
                        $common_data['common_price'] = $price;   //商品价格
                        $common_data['common_market_price'] = $market_price; //市场价
                        $common_data['common_cost_price']   = $price;  //成本价
                        $common_data['common_stock'] = $stock;  //商品库存
						if($code)
						{
                            $common_data['common_code']  = $code;  //商家编号
						}
                        $common_data['common_cubage']    = $cubage;   //商品重量
                        $common_data['common_salenum']    = $sales;   //商品销量
                        $common_data['common_is_recommend'] = $shop_rec;                //商品推荐
                        $common_data['transport_type_id']   = 213;
                        $common_data['transport_type_name'] = '全国';

                        $common_location[] = $province_id;
                        $common_location[] = $city_id;
                        $common_data['common_location'] = $common_location; //商品所在地
                        $common_data['district_id']     = $shop_data['district_id'];
                        $common_data['common_share_price'] = 0.5;
                        $common_data['common_shared_price'] = $common_data['common_price'] - 0.5;
                        $common_data['common_is_promotion'] = 1;
                        $common_data['common_promotion_price'] = 0.1;
                        $common_data['common_limit']        = 0;   //不限购
                        $common_data['dis_id']        = $province_id;
                        $common_data['common_formatid_top']   = 0;
                        $common_data['common_formatid_bottom'] 	 = 0;


                        $common_id = $goodsCommonModel->addCommon($common_data, true);

                        if($common_id)
						{
							$flag = true;
						}
						else
						{
							$flag = false;
						}

                        //分享 Zhenzh
                        $share_cond['weixin'] = 0.1;
                        $share_cond['weixin_timeline'] = 0.1;
                        $share_cond['sqq'] = 0.1;
                        $share_cond['qzone'] = 0.1;
                        $share_cond['tsina'] = 0.1;
                        $share_cond['share_total_price'] = 0.5;
                        $share_cond['share_limit'] = 1;
                        $share_cond['is_promotion'] = 1;
                        $share_cond['promotion_total_price'] = 0.1;
                        $share_cond['promotion_unit_price'] = 0.1;
                        $share_cond['common_id'] = $common_id;
                        $share_model -> addShare($share_cond);


                        $goods_data['cat_id']               = $common_data['cat_id'];                    //商品分类id
                        $goods_data['common_id']            = $common_id;                                //商品公共表id
                        $goods_data['shop_id']              = $common_data['shop_id'];                    //shop_id
                        $goods_data['shop_name']            = $common_data['shop_name'];                //shop_name
                        $goods_data['goods_name']           = $common_data['common_name'];                //商品名称
                        $goods_data['goods_promotion_tips'] = $common_data['common_promotion_tips'];    //促销提示
                        $goods_data['goods_is_recommend']   = $common_data['common_is_recommend'];        //商品推荐
                        $goods_data['goods_image']          = $common_data['common_image'];                //商品主图
                        $goods_data['goods_share_price'] = $common_data['common_share_price'];
                        $goods_data['goods_shared_price'] = $common_data['common_shared_price'];
                        $goods_data['goods_is_promotion'] = $common_data['common_is_promotion'];
                        $goods_data['goods_promotion_price'] = $common_data['common_promotion_price'];
                        if($is_shelves)
						{
                            $goods_data['goods_is_shelves'] = $is_shelves;
						}
						else
						{
                            $goods_data['goods_is_shelves'] = 2;
						}

                        $goods_data['goods_price']        = $common_data['common_price'];                //商品价格
                        $goods_data['goods_market_price'] = $common_data['common_market_price'];        //市场价
                        $goods_data['goods_stock']        = $common_data['common_stock'];                //商品库存
                        $goods_data['goods_code']         = $common_data['common_code'];                //商家编号货号
                        $goods_data['goods_click']         = $clicks;

                        $goods_id = $goodsBaseModel->addBase($goods_data, true);

                        $goods_ids = array('goods_id' => $goods_id,'color' => 0);
                        $edit_common_data['goods_id'] = $goods_ids;
                        $goodsCommonModel->editCommon($common_id, $edit_common_data);

                        $sql = 'SELECT detail FROM taoshang168_new.mallbuilder_product_detail WHERE proid = '.$id;
                        $goods_detail_data = $goodsCommonDetailModel->select_sql($sql,1,1);
                        if($goods_detail_data)
						{
                            $goods_detail = $goods_detail_data['items'][0]['detail'];

                            $common_detail_data['common_id']   = $common_id;
                            $common_detail_data['common_body'] = $goods_detail;

                            $goodsCommonDetailModel->addCommonDetail($common_detail_data);
						}

						if($pic_more)
						{
                            $pic_data = explode(',',$pic_more);
                            $i = 0;
                            foreach ($pic_data as $k_pic=>$v_pic)
							{
								$cond_row_pic['common_id'] = $common_id;
                                $cond_row_pic['shop_id'] = $shop_id;
                                $cond_row_pic['images_image'] = $v_pic;
                                if($i == 0)
								{
                                    $cond_row_pic['images_is_default'] = 1;
								}
								else
								{
                                    $cond_row_pic['images_is_default'] = 0;
								}

                                $goodsImagesModel->addImages($cond_row_pic);
                                $i++;
							}
						}
                    }
                    else
					{
						echo $user_id.'无店铺';
					}
                }
                else
				{
					echo $member_id.'无此用户';
				}

                echo '<pre>';
                if(!$flag)
				{
                    echo $name.'--失败';
				}

			}

        }*/
	}

	//导入公司 导入后需修改YLB_number_seq 里的id 或者在导入店铺前先导入公司 Zhenzh
	public function importShopCompany()
	{
		/*$shopBaseModel = new Shop_BaseModel();
		$shopCompanyModel = new Shop_CompanyModel();
		$cond_row['shop_id:>'] = 160;
		$shop_data = $shopBaseModel->getByWhere($cond_row);

		if($shop_data)
		{
			foreach ($shop_data as $key=>$value)
			{
				$cond_row_c['shop_id'] = $value['shop_id'];
                $cond_row_c['shop_company_name'] = $value['shop_name'];
                $shopCompanyModel->addBase($cond_row_c);
			}
		}*/
	}

	//修改导入的商品 Zhenzh
	public function editGoods()
	{
        /*$goodsCommonModel = new Goods_CommonModel();
        $goodsBaseModel = new Goods_BaseModel();
        $sql = 'SELECT `name` FROM taoshang168_new.mallbuilder_product WHERE subhead = "" OR subhead IS NULL';
        $data = $goodsCommonModel->select_sql($sql,1,500);

        set_time_limit(0);
		if($data)
		{
            foreach ($data['items'] as $key=>$value)
			{
				$goods_common = $goodsCommonModel->getOneByWhere(array('common_name'=>$value['name']));
				if($goods_common)
				{
                    $goodsCommonModel->editCommon($goods_common['common_id'],array('common_promotion_tips'=>''));
				}
			}
		}*/
	}

	//修改导入的商品分类 Zhenzh
    public function editGoodsCat()
    {
        /*$goodsCommonModel = new Goods_CommonModel();
        $goodsCatModel = new Goods_CatModel();
        $sql = 'SELECT a.name,a.catid,b.cat FROM taoshang168_new.mallbuilder_product a LEFT JOIN taoshang168_new.`mallbuilder_product_cat` b ON a.`catid` = b.catid ORDER BY a.id';
        $data = $goodsCommonModel->select_sql($sql,2,500);


        set_time_limit(0);
        if($data)
        {
            foreach ($data['items'] as $key=>$value)
            {
                $goodsCat = $goodsCatModel->getOneByWhere(array('catid'=>$value['catid']));
                if(!$goodsCat)
				{
                    $goods_common = $goodsCommonModel->getByWhere(array('common_name'=>$value['name']));
                    if($goods_common)
					{
						foreach ($goods_common as $k=>$v)
						{
                            $common_data['cat_id'] = 0;//商品分类id
                            $common_data['cat_name'] = '';//商品分类名称

                            $goods_cat = $goodsCatModel->getOneByWhere(array('cat_name'=>trim($value['cat'])));
                            if($goods_cat)
                            {
                                $common_data['cat_id'] = $goods_cat['cat_id'];//商品分类id
                                $common_data['cat_name'] = $goods_cat['cat_name'];//商品分类名称
                            }

                            $goodsCommonModel->editCommon($v['common_id'],$common_data);
						}
                    }
				}

            }
        }*/
    }

    //修改商品店铺分类
    public function editGoodsShopCat()
    {
        /*$goodsCommonModel = new Goods_CommonModel();
        $shopGoodsCatModel = new Shop_GoodCatModel();
        $sql = 'SELECT `name` FROM taoshang168_new.`mallbuilder_product`  WHERE custom_cat_id = 0';
        $data = $goodsCommonModel->select_sql($sql, 1, 500);

        set_time_limit(0);
        if ($data)
        {
        	$count = 0;
            foreach ($data['items'] as $key => $value)
			{
				$sql = 'SELECT shop_id,`shop_goods_cat_id` FROM ylb_goods_common WHERE common_name = "'.$value['name'].'"';
                $goods_comon_data = $goodsCommonModel->select_sql($sql, 1, 100);

                if($goods_comon_data)
				{
					foreach ($goods_comon_data['items'] as $k=>$v)
					{
                        $shop_cat_ids = json_decode($v['shop_goods_cat_id']);

                        $shop_cat_id = '';
                        $shop_goods_cat_id = array();
                        foreach ($shop_cat_ids as $id)
                        {
                            if($id != 0)
                            {
                                $shop_goods_cat = $shopGoodsCatModel->getOne($id);
                                if($shop_goods_cat && $shop_goods_cat['shop_id'] == $v['shop_id'])
                                {
                                    $shop_cat_id .=','.$shop_goods_cat['shop_goods_cat_id'];
                                    $shop_goods_cat_id[] = $shop_goods_cat['shop_goods_cat_id'];
                                    $count++;
                                }
                            }

                        }
                        if($shop_cat_id)
						{
                            $shop_cat_id .=',';
						}

                        $common_data['shop_cat_id'] = $shop_cat_id;   //店铺分类id
                        $common_data['shop_goods_cat_id'] = $shop_goods_cat_id;   //店铺分类id



                        $goodsCommonModel->editCommon($v['common_id'],$common_data);
					}

				}

			}

			echo $count;die;
		}*/
	}





}

?>

