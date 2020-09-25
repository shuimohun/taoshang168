<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class IndexCtl extends Controller
{
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);
    }

    public function index()
    {
        $Cache = YLB_Cache::create('default');
        $site_index_key = sprintf('%s|%s|%s', YLB_Registry::get('server_id'), 'site_index',  isset($_COOKIE['sub_site_id']) ? $_COOKIE['sub_site_id'] : 0);

        if (!$Cache->start($site_index_key))
        {
            $this->is_index = 1;
            $this->initData();

            //首页广告Zhenzh
            $Adv_ConModel = new Operation_AdvertisementModel();
            $adv_order['sort_num'] = 'asc';
            $adv_index_1 = $Adv_ConModel->getByWhere(array('group_id'=>Operation_AdvertisementModel::$adv_id['index_1']),$adv_order);
            $adv_index_2 = $Adv_ConModel->getByWhere(array('group_id'=>Operation_AdvertisementModel::$adv_id['index_2']),$adv_order);
            $adv_index_3 = $Adv_ConModel->getByWhere(array('group_id'=>Operation_AdvertisementModel::$adv_id['index_3']),$adv_order);

            //首页活动广告位  wdp
            $opening_img = array_merge($Adv_ConModel->getByWhere(array('name:IN'=>array('opening1','opening2'))));

            //排行榜Zhenzh
            $search = $this->searchWord;
            if(count($search) >= 5)
            {
                $search = array_slice($search, 0, 5);
            }

            //楼层设置
            $Adv_PageSettingsModel       = new Adv_PageSettingsModel();
            $cond_adv_row['page_status'] = 1;
            $cond_adv_row['sub_site_id'] = Adv_PageSettingsModel::Index;
            $order_adv_row         = array("page_order" => "asc");
            $adv_list              = $Adv_PageSettingsModel->listByWhere($cond_adv_row, $order_adv_row);

            $subsite_is_open = Web_ConfigModel::value("subsite_is_open");
            if(!empty($_COOKIE['sub_site_id']) && $subsite_is_open == Sub_SiteModel::SUB_SITE_IS_OPEN)
            {
                $cond_adv_row['sub_site_id']  = $_COOKIE['sub_site_id'] ;
                //首页标题关键字
                $Sub_Site = new Sub_Site();
                $sub_site_info = $Sub_Site->getSubSite($_COOKIE['sub_site_id']);
                $title             = $sub_site_info[$_COOKIE['sub_site_id']]['sub_site_web_title'];//首页名;
                $this->keyword     = $sub_site_info[$_COOKIE['sub_site_id']]['sub_site_web_keyword'];//关键字;
                $this->description = $sub_site_info[$_COOKIE['sub_site_id']]['sub_site_web_des'];//描述;
                $this->title       = str_replace("{sitename}", $this->web['web_name'], $title);
                $this->keyword       = str_replace("{sitename}", $this->web['web_name'], $this->keyword);
                $this->description       = str_replace("{sitename}", $this->web['web_name'], $this->description);
            }
            else
            {
                $cond_adv_row['sub_site_id']  = 0 ;
                //首页标题关键字
                $title             = Web_ConfigModel::value("title");//首页名;
                $this->keyword     = Web_ConfigModel::value("keyword");//关键字;
                $this->description = Web_ConfigModel::value("description");//描述;
                $this->title       = str_replace("{sitename}", $this->web['web_name'], $title);
                $this->keyword       = str_replace("{sitename}", $this->web['web_name'], $this->keyword);
                $this->description       = str_replace("{sitename}", $this->web['web_name'], $this->description);
            }
            include $this->view->getView();
            $Cache->_id = $site_index_key;
            $Cache->end($site_index_key);
        }
    }

	public function getUserLoginInfo()
	{
		$data = array();
		if (Perm::checkUserPerm())
		{
			$user_id        = Perm::$userId;
			$userInfoModel  = new User_InfoModel();
			$this->userInfo = $userInfoModel->getOne($user_id);
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

	public function newGetSearchKeyList()
    {
        $search_words     = explode(',', Web_ConfigModel::value('search_words'));
        $key_base = $this->searchWord();
        foreach($key_base as $key=>$value)
        {
            $data['list'][] = $value['search_keyword'];
        }
        $data['his_list'] = array($search_words[1]);
        $this->data->addBody(-140,$data);
    }

	//获取侧边栏的信息
	public function toolbar()
	{
        //咨询公告
        $InformationBaseModel = new Information_BaseModel();
        $cond_row['information_type']   = 1;
        $cond_row['information_status'] = 1;
        $information = $InformationBaseModel->getBaseAllList($cond_row, array('information_add_time' => 'DESC'), 1, 20);

        if (Perm::checkUserPerm())
        {
            $user_id = Perm::$userId;

            //购物车信息
            $CartModel = new CartModel();
            $cart['cart_list'] = $CartModel->toolbarCart();

            foreach ($cart['cart_list'] as $key=>$value)
            {
                $cart['count']+=count($value['goods']);
                $cart['sum'] += $value['sprice'];
            }

            //收藏店铺信息
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

            //足迹信息
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

            //收藏商品信息
            $userFavoritesGoodsModel = new User_FavoritesGoodsModel();
            $favorites_row['user_id'] = $user_id;
            $goods_list = $userFavoritesGoodsModel->getFavoritesGoodsDetail($favorites_row, array('favorites_goods_time' => 'DESC'), 1, 20);

            //代金券信息
            $voucher_TempModel = new Voucher_TempModel();
            $cond_rows['voucher_owner_id'] = $user_id;
            $cond_rows['voucher_state'] = 1;
            $cond_rows['voucher_end_date:>='] = date("Y-m-d H:i:s");
            $voucherBaseModel  = new Voucher_BaseModel();
            $v_row = $voucherBaseModel->getByWhere($cond_rows);
            if($v_row)
            {
                foreach ($v_row as $k =>$v)
                {
                    $cond_v['voucher_t_id'] = $v['voucher_t_id'];
                    $cond_v['voucher_t_state']   = Voucher_BaseModel::UNUSED;
                    $field = 'voucher_t_points';
                    $v_row[$k]['voucher_t_points'] = $voucher_TempModel->get_select($field,$cond_v);
                }
            }
            $shop_id = request_int('shop_id');
            if($shop_id > 0)
            {
                $cond['shop_id'] = $shop_id;
                $cond['voucher_t_state'] = 1;
                $cond['voucher_t_end_date:>='] = date("Y-m-d H:i:s");
                $v_t_row = $voucher_TempModel->getByWhere($cond);

                if($v_t_row)
                {
                    $voucher_vt_ids = array_column($v_t_row,'voucher_t_id');
                    $cond_v_row['voucher_t_id:IN'] = $voucher_vt_ids;
                    $cond_v_row['voucher_owner_id'] = Perm::$userId;
                    $cond_v_row['voucher_state']       = Voucher_BaseModel::UNUSED;
                    $voucher_v_list = $voucherBaseModel->getByWhere($cond_v_row);
                    if($voucher_v_list)
                    {
                        $v_vt_ids = array_column($voucher_v_list,'voucher_t_id');
                        foreach ($v_t_row as $key=>$value)
                        {
                            if(in_array($value['voucher_t_id'],$v_vt_ids))
                            {
                                $v_t_row[$key]['is_taken'] = true;
                            }
                        }
                    }
                }
            }


            //用户信息 金蛋/成长值
            $cond_row = array('user_id' => $user_id);
            $userResourceModel = new User_ResourceModel();
            $user_list = $userResourceModel->getUserResource($cond_row);
        }

		include $this->view->getView();
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

    /**
     * 获取wap首页 app接口 Zhenzh
     */
    public function getWapIndexByKey()
    {
        $data = array();

        $key = request_int('key');

        $goods_CommonModel = new Goods_CommonModel();
        $mbTplLayoutModel = new Mb_TplLayoutModel();

        if($key)
        {
            $layout_list = $mbTplLayoutModel->getByWhere(array('mb_tpl_layout_enable'=>Mb_TplLayoutModel::USABLE,'mb_tpl_key'=>$key), array('mb_tpl_layout_order'=>'ASC'));
        }
        else
        {
            $informationBaseModel = new Information_BaseModel();
            $informationGroupModel = new Information_GroupModel();
            $order_row_info['information_add_time'] = 'desc';
            $info_data = $informationBaseModel->getBaseAllList(null,$order_row_info,1,20);

            if($info_data)
            {
                foreach ($info_data['items'] as $key=>$value)
                {
                    $information_data[$key]['id'] = $value['information_id'];
                    $information_data[$key]['title'] = $value['information_title'];
                    //$information_data[$key]['content'] = $value['information_desc'];
                    $information_data[$key]['add_time'] = $value['information_add_time'];

                    if(strstr($value['information_url'], 'http'))
                    {
                        $information_data[$key]['url'] = $value['information_url'];
                    }

                    $information_group_data = $informationGroupModel->select('information_group_title',array('information_group_id'=>$value['information_group_id']));

                    $information_data[$key]['group_title'] = current($information_group_data)['information_group_title'];
                }
            }
            $data[]['info_data']['item'] = $information_data;

            $layout_list = $mbTplLayoutModel->getByWhere(array('mb_tpl_layout_enable'=>Mb_TplLayoutModel::USABLE,'mb_tpl_key:>'=>'1'), array('mb_tpl_layout_order'=>'ASC'));
        }

        if ( !empty($layout_list) )
        {
            foreach($layout_list as $mb_tpl_layout_id => $layout_data_val)
            {
                $data[$layout_data_val['mb_tpl_key']]['key'] = $layout_data_val['mb_tpl_key'];
                if ($layout_data_val['mb_tpl_layout_type'] == 'adv_list')
                {
                    $adv_list = array();
                    $item = array();
                    $mb_tpl_layout_data = $layout_data_val['mb_tpl_layout_data'];

                    foreach ($mb_tpl_layout_data as $key => $layout_data)
                    {
                        $item[$key]['image'] = $layout_data['image'];
                        $item[$key]['type']  = $layout_data['image_type'];
                        $item[$key]['data']  = $layout_data['image_data'];
                    }

                    $adv_list['item'] = $item;
                    $adv_list['title'] = $layout_data_val['mb_tpl_layout_title'];
                    $data[$layout_data_val['mb_tpl_key']]['slider_list'] = $adv_list;

                }
                if ( $layout_data_val['mb_tpl_layout_type'] == 'adv_list2')
                {
                    $adv_list = array();
                    $item = array();
                    $mb_tpl_layout_data = $layout_data_val['mb_tpl_layout_data'];

                    foreach ($mb_tpl_layout_data as $key => $layout_data)
                    {
                        $item[$key]['image'] = $layout_data['image'];
                        $item[$key]['type']  = $layout_data['image_type'];
                        $item[$key]['data']  = $layout_data['image_data'];
                    }

                    $adv_list['item'] = $item;
                    $adv_list['title'] = $layout_data_val['mb_tpl_layout_title'];
                    $data[$layout_data_val['mb_tpl_key']]['slider_list2'] = $adv_list;
                }

                if ($layout_data_val['mb_tpl_layout_type'] == 'home1')
                {
                    $hom1 = array();
                    $mb_tpl_layout_data = $layout_data_val['mb_tpl_layout_data'];

                    $hom1['title'] = $layout_data_val['mb_tpl_layout_title'];
                    $hom1['image'] = $mb_tpl_layout_data['image'];
                    $hom1['type']  = $mb_tpl_layout_data['image_type'];
                    $hom1['data']  = $mb_tpl_layout_data['image_data'];
                    $data[$layout_data_val['mb_tpl_key']]['home1'] = $hom1;
                }

                if ($layout_data_val['mb_tpl_layout_type'] == 'home2' || $layout_data_val['mb_tpl_layout_type'] == 'home4')
                {
                    $home2_4 = array();
                    $mb_tpl_layout_data = $layout_data_val['mb_tpl_layout_data'];

                    $home2_4['title'] = $layout_data_val['mb_tpl_layout_title'];

                    $home2_4['rectangle1_image'] = $mb_tpl_layout_data['rectangle1']['image'];
                    $home2_4['rectangle1_type']  = $mb_tpl_layout_data['rectangle1']['image_type'];
                    $home2_4['rectangle1_data']  = $mb_tpl_layout_data['rectangle1']['image_data'];

                    $home2_4['rectangle2_image'] = $mb_tpl_layout_data['rectangle2']['image'];
                    $home2_4['rectangle2_type']  = $mb_tpl_layout_data['rectangle2']['image_type'];
                    $home2_4['rectangle2_data']  = $mb_tpl_layout_data['rectangle2']['image_data'];

                    $home2_4['square_image'] = $mb_tpl_layout_data['square']['image'];
                    $home2_4['square_type']  = $mb_tpl_layout_data['square']['image_type'];
                    $home2_4['square_data']  = $mb_tpl_layout_data['square']['image_data'];

                    $data[$layout_data_val['mb_tpl_key']][$layout_data_val['mb_tpl_layout_type']] = $home2_4;
                }

                if ($layout_data_val['mb_tpl_layout_type'] == 'home3' )
                {
                    $home3 = array();
                    $item = array();
                    $mb_tpl_layout_data = $layout_data_val['mb_tpl_layout_data'];

                    foreach ($mb_tpl_layout_data as $key => $layout_data)
                    {
                        $item[$key]['image'] = $layout_data['image'];
                        $item[$key]['type']  = $layout_data['image_type'];
                        $item[$key]['data']  = $layout_data['image_data'];
                    }

                    $home3['item'] = $item;
                    $home3['title'] = $layout_data_val['mb_tpl_layout_title'];
                    $data[$layout_data_val['mb_tpl_key']][$layout_data_val['mb_tpl_layout_type']] = $home3;
                }
                if ( $layout_data_val['mb_tpl_layout_type'] == 'home5')
                {
                    $home3 = array();
                    $item = array();
                    $mb_tpl_layout_data = $layout_data_val['mb_tpl_layout_data'];

                    foreach ($mb_tpl_layout_data as $key => $layout_data)
                    {
                        $item[$key]['image'] = $layout_data['image'];
                        $item[$key]['type']  = $layout_data['image_type'];
                        //$item[$key]['data']  = $layout_data['image_data'];
                        $item[$key]['data'] = str_replace('product_detail.html','newbuyer.html',$layout_data['image_data']);
                    }

                    $home3['item'] = $item;
                    $home3['title'] = $layout_data_val['mb_tpl_layout_title'];
                    $data[$layout_data_val['mb_tpl_key']][$layout_data_val['mb_tpl_layout_type']] = $home3;
                }


                if ($layout_data_val['mb_tpl_layout_type'] == 'goods')
                {
                    $goods = array();
                    $item = array();
                    $mb_tpl_layout_data = $layout_data_val['mb_tpl_layout_data'];

                    $common_list = $goods_CommonModel->getByWhere( array('common_id:IN'=>$mb_tpl_layout_data,'common_state'=>Goods_CommonModel::GOODS_STATE_NORMAL) );
                    if ( $common_list )
                    {
                        foreach($common_list as $common_id => $common_data)
                        {

                            $goods_id = $goods_CommonModel->getNormalStateGoodsId($common_data['common_id']);
                            //$goods_id = pos($common_data['goods_id']);

                            $item[$common_id]['goods_id'] 			   = $goods_id;
                            $item[$common_id]['common_price'] = $common_data['common_price'];
                            //$item[$common_id]['goods_image'] 		   = sprintf('%s!360x360', $common_data['common_image']);
                            $item[$common_id]['goods_image'] 		   = $common_data['common_image'];
                            $item[$common_id]['common_share_price'] 		   = $common_data['common_share_price'];
                            $item[$common_id]['common_shared_price'] 		   = $common_data['common_shared_price'];
                            $item[$common_id]['common_is_promotion'] 		   = $common_data['common_is_promotion'];
                            $item[$common_id]['common_promotion_price'] 		   = $common_data['common_promotion_price'];
                            if(mb_strwidth($common_data['common_name'], 'utf8')>40)
                            {
                                $item[$common_id]['goods_name'] = mb_strimwidth($common_data['common_name'], 0, 40, '...', 'utf8');
                            }
                            else
                            {
                                $item[$common_id]['goods_name'] = $common_data['common_name'];
                            }
                        }
                        $goods['item'] = array_values($item);
                        $goods['title'] = $layout_data_val['mb_tpl_layout_title'];
                        $data[$layout_data_val['mb_tpl_key']]['goods'] = $goods;
                    }
                }

                if ($layout_data_val['mb_tpl_layout_type'] == 'shop')
                {

                    $mb_tpl_layout_data = $layout_data_val['mb_tpl_layout_data'];
                    $ShopBaseModel = new Shop_BaseModel();
                    $shop_list = $ShopBaseModel->getByWhere(array('shop_id:IN'=>$mb_tpl_layout_data));

                    if($shop_list)
                    {
                        foreach ($shop_list as $k => $v)
                        {
                            $item = array();
                            $goods_top3 = $goods_CommonModel->getHotSalle($v['shop_id'],3);
                            $goods_top3     = $goods_CommonModel->getGoodsCommonMain($goods_top3);

                            foreach ($goods_top3 as $goods_k => $goods_v)
                            {
                                $item[$goods_k]['goods_id'] 			   = $goods_v['goods_id'];
                                $item[$goods_k]['goods_name'] 		   = $goods_v['common_name'];
                                $item[$goods_k]['goods_promotion_price'] = $goods_v['common_price'];
                                //$item[$goods_k]['goods_image'] 		   = sprintf('%s!360x360', $goods_v['common_image']);
                                $item[$goods_k]['goods_image'] 		   = $goods_v['common_image'];

                            }
                            $shop[$k]['goods'] = array_values($item);
                            $shop[$k]['shop_name'] = $v['shop_name'];
                            $shop[$k]['shop_id'] = $v['shop_id'];
                        }
                        $shop_li['item'] = array_values($shop);
                        $shop_li['title'] = $layout_data_val['mb_tpl_layout_title'];
                        $data[$layout_data_val['mb_tpl_key']]['shop'] = $shop_li;
                    }
                }


            }
        }

        if ('json' == $this->typ)
        {
            $data = array_values($data);
            $this->data->addBody(-140, $data);
        }

    }

    /**
     * 首页排行榜 Zhenzh
     */
    public function getRankingList()
    {
        $Goods_CommonModel = new Goods_CommonModel();
        $goodsEvaluationModel = new Goods_EvaluationModel();

        $key = request_string('key');
        $cond_row['common_name:LIKE'] = '%'.$key.'%';
        $cond_row['common_state'] = Goods_CommonModel::GOODS_STATE_NORMAL;
        $cond_row['product_distributor_flag'] = 0;
        $order_row['common_salenum'] = 'desc';

        $data = $Goods_CommonModel->listByWhere($cond_row,$order_row,1,5);
        if($data['items'])
        {
            $data['items'] = $Goods_CommonModel->getRecommonRow($data);

            $common_id_row = array_column($data['items'],'common_id');
            if($common_id_row)
            {
                $cond_ev_row['common_id:IN']  = $common_id_row;
                $cond_ev_row['status:!='] = Goods_EvaluationModel::DISPLAY;
                $cond_ev_row['scores:!='] = 0;
                $ev_row = $goodsEvaluationModel->select('common_id,COUNT(*) count',$cond_ev_row,'common_id','');
                $cond_ev_row['scores:>='] = 4;
                $good_ev_row = $goodsEvaluationModel->select('common_id,COUNT(*) count',$cond_ev_row,'common_id','');

                $ev_new_row = array();
                foreach ($ev_row as $key=>$value)
                {
                    $ev_new_row[$value['common_id']] = $value['count'];
                }

                $good_ev_new_row = array();
                foreach ($good_ev_row as $key=>$value)
                {
                    $good_ev_new_row[$value['common_id']] = $value['count'];
                }

                foreach ($data['items'] as $key=>$value)
                {
                    $ev_count = 0;
                    $good_ev_count = 0;
                    if(array_key_exists($value['common_id'],$ev_new_row))
                    {
                        $ev_count = $ev_new_row[$value['common_id']];
                    }
                    if(array_key_exists($value['common_id'],$good_ev_new_row))
                    {
                        $good_ev_count = $good_ev_new_row[$value['common_id']];
                    }

                    $good_rate = $ev_count?round($good_ev_count/$ev_count *100,2):0;
                    $data['items'][$key]['good_rate'] = $good_rate;
                    $data['items'][$key]['good_count'] = number_format_hanzi($good_ev_count);
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

    public function rule()
    {
        $this->web['web_logo'] = Web_ConfigModel::value("setting_logo");//首页logo

        $op = request_string('op');
        if($op)
        {
            $this->view->setMet($op);
        }

        include $this->view->getView();
    }

    public function test()
    {
        include $this->view->getView();
    }

}

?>