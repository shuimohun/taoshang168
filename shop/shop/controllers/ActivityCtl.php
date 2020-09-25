<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     Zhenzh
 */
class ActivityCtl extends Controller
{
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);
        $this->initData();
		$this->web = $this->webConfig();
		$this->nav = $this->navIndex();
		$this->cat = $this->catIndex();
	}

    //遇见好货
	public function goodGoods()
	{
		$data      = array();

        $title             = Web_ConfigModel::value("yujianhaohuo_title");//首页名;
        $this->keyword     = Web_ConfigModel::value("yujianhaohuo_keyword");//关键字;
        $this->description = Web_ConfigModel::value("yujianhaohuo_description");//描述;
        $this->title       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $title);
        $this->keyword       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->keyword);
        $this->description       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->description);

        if ('json' == $this->typ)
        {
            $this->data->addBody(-140, $data);
        }
        else
        {
            $Goods_CatModel = new Goods_CatModel();
            $Goods_CatNavModel = new Goods_CatNavModel();
            $Goods_BaseModel = new Goods_BaseModel();
            $Goods_EvaluationModel = new Goods_EvaluationModel();
            $Adv_ConModel = new Operation_AdvertisementModel();
            $adv_con = $Adv_ConModel->getAdvList(array('group_id' => 16));

            $page = request_int('page');
            $cat_id = request_int('cat_id');
            $cat_sid = request_int('cat_sid');
            $cat_cond['cat_parent_id'] = 0;
            $cat_cond['cat_is_display'] = 1;
            $cat_order['cat_displayorder'] = 'asc';
            $goods_cats = $Goods_CatModel->getByWhere($cat_cond, $cat_order);
            $goods_cat_ids = array_keys($goods_cats);
            $goodsCatNavModel = new Goods_CatNavModel();
            $cat_nav_cond['goods_cat_id:IN'] = $goods_cat_ids;
            $goods_cat_nav = $goodsCatNavModel->getByWhere($cat_nav_cond);

            foreach ($goods_cat_nav as $key => $value) {
                if ($goods_cats[$value['goods_cat_id']]) {
                    $goods_cats[$value['goods_cat_id']]['nav_name'] = $value['goods_cat_nav_name'];
                }
            }

            if ($cat_id) {
                $c_id = $cat_id;
                if ($goods_cats[$cat_id]) {
                    $goods_cats[$cat_id]['curr'] = 1;
                }
                $cat_sub_cond['cat_parent_id'] = $cat_id;
                $cat_sub_cond['cat_is_display'] = 1;
                $cat_sub_order['cat_displayorder'] = 'ASC';
                $goods_sub_cats = $Goods_CatModel->getByWhere($cat_sub_cond, $cat_sub_order);

                if ($cat_sid) {
                    $c_id = $cat_sid;
                    if ($goods_sub_cats[$cat_sid]) {
                        $goods_sub_cats[$cat_sid]['curr'] = 1;
                    }
                }

                $data['goods_sub_cat'] = $goods_sub_cats;
            }

            $data['goods_cat'] = $goods_cats;
            if ($c_id) {
                //查找该分类下所有的子分类
                $cat_list = $Goods_CatModel->getCatChildId($c_id);
                $cond_row['cat_id:IN'] = $cat_list;
            }
            if(!$page)
            {
                $page = 1;
            }

            if($cat_list)
            {
                $BaseGoods = $Goods_BaseModel->getBaseList(array('cat_id:IN'=>$cat_list,'goods_is_shelves'=>1),array('goods_evaluation_good_star'=>'DESC','goods_evaluation_count'=>'DESC'),$page);
            }
            else
            {
                $BaseGoods = $Goods_BaseModel->getBaseList(array('goods_is_shelves'=>1),array('goods_evaluation_good_star'=>'DESC','goods_evaluation_count'=>'DESC'),$page);
            }

            foreach($BaseGoods['items'] as $key=>$value)
            {
                $common_id[]= $value['common_id'];
            }

            $common_id = array_unique($common_id);
            $Eva = $Goods_EvaluationModel->getEvaluationList(array('common_id:IN'=>$common_id,'status:IN'=>array(1,2),'scores:IN'=>array(5,4)),array('evaluation_goods_id'=>'ASC','scores'=>'DESC'));

            //按照正确的顺序排序
            foreach($common_id as $key=>$value)
            {
                foreach($Eva['items'] as $k=>$v)
                {
                    foreach($v as $kk=>$vv)
                    {
                        if($value == $vv['common_id'])
                        {
                            $arr[$key][] = $vv;
                        }
                    }
                }
            }

            //根据商品评价是否有图片来判断出现一条还是两条评价
            foreach($arr as $key=>$value)
            {

                if(count($value[0]['image_row']) > 0)
                {
                    $data['items'][] = array_slice($value,0,1);
                }
                else
                {
                    $data['items'][] = array_slice($value,0,2);
                }
            }

            include $this->view->getView();
        }
	}

    //生鲜特产
    public function fresh()
    {

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
     * 每日必buy
     *
     * @lgl 20170809
     */
    public function dailyBuy()
    {
        $title             = Web_ConfigModel::value("meiri_title");//首页名;
        $this->keyword     = Web_ConfigModel::value("meiri_keyword");//关键字;
        $this->description = Web_ConfigModel::value("meiri_description");//描述;
        $this->title       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $title);
        $this->keyword       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->keyword);
        $this->description       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->description);

        include $this->view->getView();
    }

    /**
     * 每日必buy - 今日爆款页面
     * @lgl 20170809
     */
    public function hotSale()
    {
        include $this->view->getView();
    }

    /**
     * 每日必buy - 人气王收藏页面
     * @lgl 20170809
     */
    public function topCollection()
    {
        include $this->view->getView();
    }

    //劲爆折扣
    public  function discount()
    {
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

    //加一购
    public  function plus()
    {
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

    //发现好店
    public  function shop()
    {
        $title             = Web_ConfigModel::value("findshop_title");//首页名;
        $this->keyword     = Web_ConfigModel::value("findshop_keyword");//关键字;
        $this->description = Web_ConfigModel::value("findshop_description");//描述;
        $this->title       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $title);
        $this->keyword       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->keyword);
        $this->description       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->description);

        $data = array();
        $user_id = perm::$userId;
        $sci = request_int('sci');
        $adv_id = 29;
        $key = YLB_Registry::get('shop_api_key');
        $url = YLB_Registry::get('shop_api_url');
        $shop_app_id = YLB_Registry::get('shop_app_id');
        $formvars_get_nav = array();
        $formvars_nice_shop = array();
        $formvars_sure_shop  = array();

        $formvars_get_nav['app_id'] = $shop_app_id;
        $formvars_get_nav['from_app_id'] =  YLB_Registry::get('shop_app_id');
        $formvars_get_nav['adv_id']    = $adv_id;

        $nav_cont = get_url_with_encrypt($key,sprintf('%s?ctl=Api_App_FindShop&met=getNav&typ=json',$url),$formvars_get_nav);
        $slider = $nav_cont['data']['nav']['items'];
        $cat    = $nav_cont['data']['cat'];

        $formvars_nice_shop['app_id'] = $shop_app_id;
        $formvars_nice_shop['from_app_id'] = YLB_Registry::get('shop_app_id');
        $formvars_nice_shop['sci'] = $sci;

        $nice_shop_cont = get_url_with_encrypt($key,sprintf('%s?ctl=Api_App_FindShop&met=niceShop&typ=json',$url),$formvars_nice_shop);
        $nice_shop = $nice_shop_cont['data']['items'];

        $formvars_sure_shop['app_id'] = $shop_app_id;
        $formvars_sure_shop['from_app_id'] = YLB_Registry::get('shop_app_id');
        $formvars_sure_shop['sci'] = $sci;
        $formvars_sure_shop['user_id'] = $user_id;
        $sure_shop_cont = get_url_with_encrypt($key,sprintf('%s?ctl=Api_App_FindShop&met=sureShop&typ=json',$url),$formvars_sure_shop);
        $sure_shop  = $sure_shop_cont['data']['items'];

        if ('json' == $this->typ)
        {
            $this->data->addBody(-140, $data);
        }
        else
        {
            include $this->view->getView();
        }
    }

    //家有儿女
    public  function home()
    {
        $title             = Web_ConfigModel::value("ernv_title");//首页名;
        $this->keyword     = Web_ConfigModel::value("ernv_keyword");//关键字;
        $this->description = Web_ConfigModel::value("ernv_description");//描述;
        $this->title       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $title);
        $this->keyword       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->keyword);
        $this->description       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->description);

        $data = array();

        $goodsCatModel = new Goods_CatModel();
        $Adv_ConModel = new Operation_AdvertisementModel();
        $adv_con = $Adv_ConModel->getAdvList(array('group_id' => 22));
        //导航栏
        $sift['adv'] = $adv_con;
        $goodsCommonModel = new Goods_CommonModel();
        $User_FavoritesGoodsModel = new User_FavoritesGoodsModel();

        $cat_id = request_int('cat_id');
        $cat_sid = request_int('cat_sid');
        $cat_cond['cat_parent_id'] = 0;
        $cat_cond['cat_is_display'] = 1;
//        $cat_order['cat_displayorder'] = 'DESC';
        $goods_cats = $goodsCatModel->getByWhere($cat_cond, array());
        $goods_cat_ids = array_keys($goods_cats);
        $goodsCatNavModel = new Goods_CatNavModel();
        $cat_nav_cond['goods_cat_id:IN'] = $goods_cat_ids;
        $goods_cat_nav = $goodsCatNavModel->getByWhere($cat_nav_cond);

        foreach ($goods_cat_nav as $key => $value) {
            if ($goods_cats[$value['goods_cat_id']]) {
                $goods_cats[$value['goods_cat_id']]['nav_name'] = $value['goods_cat_nav_name'];
            }
        }

        if ($cat_id) {
            $c_id = $cat_id;
            if ($goods_cats[$cat_id]) {
                $goods_cats[$cat_id]['curr'] = 1;
            }
            $cat_sub_cond['cat_parent_id'] = $cat_id;
            $cat_sub_cond['cat_is_display'] = 1;
            $cat_sub_order['cat_displayorder'] = 'ASC';
            $goods_sub_cats = $goodsCatModel->getByWhere($cat_sub_cond, $cat_sub_order);

            if ($cat_sid) {
                $c_id = $cat_sid;
                if ($goods_sub_cats[$cat_sid]) {
                    $goods_sub_cats[$cat_sid]['curr'] = 1;
                }
            }

            $data['goods_sub_cat'] = $goods_sub_cats;
        }

        $data['goods_cat'] = $goods_cats;

        if ($c_id) {
            //查找该分类下所有的子分类
            $cat_list = $goodsCatModel->getCatChildId($c_id);
            $cond_row['cat_id:IN'] = $cat_list;
        }

        $user_id = Perm::$userId;

        $rows['user_id'] = $user_id;
//            common_salenum
        //销量排序
        $cond_row['common_state'] = 1;
        $xl_order_row['common_salenum'] = 'desc';
        $data['xl_res'] = $goodsCommonModel->listByWhere($cond_row, $xl_order_row, '1', $row = 10);
        foreach ($data['xl_res']['items'] as $k => $v) {
            $rows['xl_res']['items'][$k]['common_salenum'] = $v['common_salenum'];
            $rows['xl_res']['items'][$k]['common_name'] = $v['common_name'];
            $rows['xl_res']['items'][$k]['common_image'] = $v['common_image'];
            $rows['xl_res']['items'][$k]['common_id'] = $v['common_id'];
            $rows['xl_res']['items'][$k]['common_price'] = $v['common_price'];
            $rows['xl_res']['items'][$k]['common_shared_price'] = $v['common_shared_price'];
        }

//            //一条goods_common数据 可能包含多条goods_id数据，从此common_id中的goods_id中选择一个有效的goods_id
//            foreach($data as $k=>$v){
//                $cond_row['common_id'] = $v['common_id'];
//                $res = $Goods_CommonModel->getGoodsList($cond_row);
//                $data[$k]['common_goods_id'] = $res['items'][0]['goods_id'];
//            }
        //收藏排序
        $sc_order_row['common_collect'] = 'desc';
        $data['sc_res'] = $goodsCommonModel->listByWhere($cond_row, $sc_order_row, '', $row = 12);
        foreach ($data['sc_res']['items'] as $k => $v) {
            //一条goods_common数据 可能包含多条goods_id数据，从此common_id中的goods_id中选择一个有效的goods_id
            $cond_rows['common_id'] = $v['common_id'];
            $res = $goodsCommonModel->getGoodsList($cond_rows);
            $rows['sc_res']['items'][$k]['goods_id'] = $res['items'][0]['goods_id'];
            $fg['goods_id'] = $res['items'][0]['goods_id'];
            $fg['user_id'] = $user_id;
            $order_row = array();
            //查询收藏
            $scres = $User_FavoritesGoodsModel->getKeyByWhere($fg, $order_row);
            if ($scres) {
                $rows['sc_res']['items'][$k]['sc_status'] = 1;

            } else {
                $rows['sc_res']['items'][$k]['sc_status'] = 0;
            }
            $fls = 'count(scores) as scores ';
            $group = 'common_id ';
            $goods_Evaluation = new Goods_EvaluationModel();
            $com_row = $goods_Evaluation->selectReturns($fls, $cond_rows, $group);
            $rows['sc_res']['items'][$k]['common_row'] = $com_row[0]['scores'] ? $com_row[0]['scores'] : 0;
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
            $rows['sc_res']['items'][$k]['common_price'] = $v['common_price'];
            $rows['sc_res']['items'][$k]['common_salenum'] = $v['common_salenum'];
        }
//            //分割分类id
        if ($cat_list) {
            $cat_ids_str = implode(',', $cat_list);
            $sql = "SELECT a.common_id,a.goods_id,a.goods_name,a.goods_image,count(a.scores) scores,b.common_salenum,b.common_salenum,b.common_price,b.common_shared_price,b.common_collect,b.common_promotion_type,b.common_share_price,b.common_promotion_price,b.common_promotion_price,b.common_is_tuan,b.common_is_xian,b.common_is_jia FROM ylb_goods_evaluation a RIGHT JOIN ylb_goods_common b ON a.common_id=b.common_id WHERE b.cat_id IN (" . $cat_ids_str . ") AND a.result='good' AND b.common_state = 1 GROUP BY a.common_id ORDER BY scores DESC";
        } else {
            $sql = "SELECT a.common_id,a.goods_id,a.goods_name,a.goods_image,count(a.scores) scores,b.common_salenum,b.common_price,b.common_shared_price,b.common_collect,b.common_promotion_type,b.common_share_price,b.common_promotion_price,b.common_promotion_price,b.common_is_tuan,b.common_is_xian,b.common_is_jia FROM ylb_goods_evaluation a RIGHT JOIN ylb_goods_common b ON a.common_id=b.common_id WHERE  a.result='good' AND b.common_state = 1 GROUP BY a.common_id ORDER BY scores DESC";
        }
        //执行sql
        $rows['pl_res']['items'] = $goodsCommonModel->sql($sql);
        foreach ($rows['pl_res']['items'] as $k => $v) {
            $fg['goods_id'] = $v['goods_id'];
            $fg['user_id'] = $user_id;
            $order_row = array();
            //查询user_id    goods_id收藏
            $res = $User_FavoritesGoodsModel->listByWhere($fg, $order_row);
            if ($res) {
                $rows['pl_res']['items'][$k]['pl_status'] = 1;
            } else {
                //收藏状态0
                $rows['pl_res']['items'][$k]['pl_status'] = 0;
            }
        }
        if ('json' == $this->typ) {
            $Adv_ConModel = new Operation_AdvertisementModel();
            $adv_list = $Adv_ConModel->getAdvList(array('group_id' => 22));

            $data['adv'] = array_values($adv_list);

            $this->data->addBody(-140, $data);
        } else {
            include $this->view->getView();
        }

    }

    //开业
    public function opening(){

        $opening_title = Web_ConfigModel::value('opening_title');
        if($opening_title){
            $this->title = $opening_title;
        }else{
            $opening_title = $this->title;
        }

        $OpeningTierModel   = new Operation_OpeningModel();
        $GoodsCommonModel   = new Goods_CommonModel();
        $VoucherModel       = new Voucher_TempModel();
        $ScarebuyModel      = new ScareBuy_BaseModel();
        $DiscountModel      = new Discount_GoodsModel();
        $MansongBaseModel   = new ManSong_BaseModel();
        $MansongRuleModel   = new ManSong_RuleModel();
        $NewBuyerModel      = new NewBuyer_BaseModel();
        $tempModel          = new Activity_TempModel();
        $tempBaseModel      = new Activity_TempBaseModel();
        //优惠券
        $voucher = $VoucherModel->getVoucherTempList(array('voucher_t_state'=>$VoucherModel::VALID),array('voucher_t_price'=>'DESC'),1,3);
        //分类导航
        $cat = $this->catIndex();
        $now = date('Y-m-d',time());
        $tomo = date('Y-m-d',strtotime("+1 day"));
        $opening_parent_cat = array_merge($OpeningTierModel->getByWhere(array('parent_id'=>0)));
        foreach($opening_parent_cat as $key=>$value){
            if($value['base_id']){
                $opening_parent_cat[$key]['tempbase'] = $tempBaseModel->getOne($value['base_id']);
                $opening_parent_cat[$key]['temp'] = $tempModel->getOne($opening_parent_cat[$key]['tempbase']['temp_id']);
            }
        }
        $data = array();
        foreach($opening_cat = $OpeningTierModel->getByWhere(array('max_num:>'=>0)) as $key=>$value){
            $opening_data = explode(',',$value['opening_data']);
            $common_base = array();
            foreach($opening_data as $ks=>$vs){
                if($onegoods = $GoodsCommonModel->getOneMyId(array('common_id'=>$vs))){
                    $common_base[] = $onegoods;
                }
            }
            if($common_base){
                $data[$value['key_name']] = $common_base;
            }

            if($value['key_name'] == 'xianshi1' || $value['key_name'] == 'xianshi2' || $value['key_name'] == 'xianshi3' || $value['key_name'] == 'manjian' || $value['key_name'] == 'xinren' || $value['key_name'] == 'banjia'){
                foreach($common_base as $k=>$v){
                   if($value['key_name'] == 'xianshi1' || $value['key_name'] == 'xianshi2' || $value['key_name'] == 'xianshi3'){
                       $price = $ScarebuyModel->getOneByWhere(array('common_id'=>$v['common_id'],'scarebuy_state'=>2));
                       if($price){
                           $data[$value['key_name']][$k]['id_goods'] = $price['goods_id'];
                           $data[$value['key_name']][$k]['scarebuy_price'] = ($price['scarebuy_price']-$v['common_share_price']);
                       }else{
                           $data[$value['key_name']][$k]['scarebuy_price'] = null;
                           unset($data[$value['key_name']][$k]);
                       }
                   }else if($value['key_name'] == 'manjian'){
                       $mansong = $MansongBaseModel->getOneByWhere(array('shop_id'=>$v['shop_id'],'mansong_state'=>$MansongBaseModel::NORMAL));
                       $rule = $MansongRuleModel->getOneByWhere(array('mansong_id'=>$mansong['mansong_id']));
                       $data[$value['key_name']][$k]['rule_price'] = $rule['rule_price'];
                       $data[$value['key_name']][$k]['rule_discount'] = $rule['rule_discount'];
                   }else if($value['key_name'] == 'xinren'){
                        $newBuyer = $NewBuyerModel->getOneByWhere(array('common_id'=>$v['common_id'],'newbuyer_state'=>1));
                        if($newBuyer['newbuyer_price']){
                            $data[$value['key_name']][$k]['newbuyer_price'] = ($newBuyer['newbuyer_price']-$v['common_share_price']);
                        }else{
                            $data[$value['key_name']][$k]['newbuyer_price'] = null;
                            unset($data[$value['key_name']][$k]);
                        }
                   }else if($value['key_name'] == 'banjia'){
                       $discountGoods = $DiscountModel->getOneByWhere(array('common_id'=>$v['common_id'],'discount_goods_state'=>1));
                       if($discountGoods){
                           $data[$value['key_name']][$k]['id_goods'] = $discountGoods['goods_id'];
                           $data[$value['key_name']][$k]['scarebuy_price'] = ($discountGoods['discount_price']-$v['common_share_price']);
                       }else{
                           $data[$value['key_name']][$k]['scarebuy_price'] = null;
                           unset($data[$value['key_name']][$k]);
                       }
                   }

                }
            }else if($value['key_name'] == 'shiyong'){

            }
        }


      if($this->typ=='json'){
          $allCat = $OpeningTierModel->getByWhere();
          $cat = $OpeningTierModel->getByWhere(array('parent_id:>'=>0));
          foreach($allCat as $key=>$value){
              if($data[$value['key_name']]){
                  $allCat[$key]['goods'] = $data[$value['key_name']];
              }
          }
          foreach ($cat as $key=>$value){
              $allCat[$value['parent_id']][$value['key_name']] = $allCat[$key];
              unset($allCat[$key]);
          }

          $arr = array();
          foreach($allCat as $key=>$value){
              $arr['opening'][$value['key_name']] = $value;
              if($value['base_id']){
                  $arr['opening'][$value['key_name']]['tempbase'] = $tempBaseModel->getOne($value['base_id']);
                  $arr['opening'][$value['key_name']]['temp'] = $tempModel->getOne($arr['opening'][$value['key_name']]['tempbase']['temp_id']);
                  $arr['opening'][$value['key_name']]['temp']['app_keyname'] = $arr['opening'][$value['key_name']]['temp']['temp_reduce_img'];
                  $arr['opening'][$value['key_name']]['temp']['wap_url'] = $arr['opening'][$value['key_name']]['temp']['temp_reduce_img'].'.html';
              }

          }

          if(time()>strtotime(date($now.' '.'9:00:00')) && time()<strtotime(date($now.' '.'12:00:00'))){
              $arr['start_xianshi'] = 'xianshi1';
          }else if(time()>strtotime(date($now.' '.'14:00:00')) && time()<strtotime(date($now.' '.'17:00:00'))){
              $arr['start_xianshi'] = 'xianshi2';
          }else if(time()>strtotime(date($now.' '.'19:00:00')) && time()<strtotime(date($now.' '.'22:00:00'))){
              $arr['start_xianshi'] = 'xianshi3';
          }else{
              $arr['start_xianshi'] = null;
          }
          $arr['voucher'] = $voucher['items'];

          $arr['opening_title'] = $opening_title;
          $arr['opening_img_wap'] = Web_ConfigModel::value('opening_img_wap');
          $this->data->addBody(-140,$arr);
      }else{
          $opening_img = Web_ConfigModel::value('opening_img');
          include $this->view->getView();
      }
    }

    //开业楼层'模板1'固定id 1 固定广告位pc 33  wap36
    public function oneFloor(){
        $base_id = request_int('base_id');
        $adv_key = request_string('adv_key');
        $GoodsCommonModel   = new Goods_CommonModel();
        $tempModel          = new Activity_TempModel();
        $tempBaseModel      = new Activity_TempBaseModel();
        $advContModel =  new Operation_AdvertisementModel();
        $group_id = Operation_AdvertisementModel::$adv_id[$adv_key];
        $pc_head_image = $advContModel->getAdvList(array('group_id'=>$group_id),array(),1,100,'Floor');
        $temp = $tempModel->getOne(1);
        if($base_id){
            $tempBase = $tempBaseModel->getOneByWhere(array('temp_id'=>$temp['temp_id'],'base_id'=>$base_id));
        }else{
            $tempBase = $tempBaseModel->getOneByWhere(array('temp_id'=>$temp['temp_id']));
        }
        $flag = false;
        $data = array();
        if($tempBase['base_main_title']){
            //已知该模板固定格式主副标题都相等
            $main_title = explode(',',$tempBase['base_main_title']);
            $assis_titile = explode(',',$tempBase['base_assis_title']);
            if($temp['temp_main_title'] > count($main_title) || $temp['temp_assis_title']>count($assis_titile)){
                $msg = '标题不全';
                $status = 250;
            }
        }else{
            $msg = '标题不全';
            $status = 250;
        }
        $goodsids = explode(',',$tempBase['base_goods_cont']);
        if($goodsids){
            if(!$temp['temp_max']){
                if(count($goodsids)<$temp['temp_min']){
                    $msg = '商品数量有误';
                    $status = 250;
                }else{
                    $flag = true;
                    foreach($goodsids as $ks=>$vs){
                        if($onegoods = $GoodsCommonModel->getOneMyId(array('common_id'=>$vs))){
                            $data['goodslist'][] =  $onegoods;
                        }
                    }
                }
            }else{
                if(count($goodsids)>=$temp['temp_min'] && count($goodsids)<=$temp['temp_max']){
                    $flag = true;
                    foreach($goodsids as $ks=>$vs){
                        if($onegoods = $GoodsCommonModel->getOneMyId(array('common_id'=>$vs))){
                            $data['goodslist'][] =  $onegoods;
                        }
                    }
                }else{
                    $msg = '商品数量有误';
                    $status = 250;
                }
            }
        }else{
            $msg = '未添加商品';
            $status = 250;
        }

        $data['main_title'] = $main_title;
        $data['assis_title'] = $assis_titile;
        $data['background'] = $tempBase['base_rgb'];
        $data['temp_title'] = $tempBase['base_name'];
        if($flag){
            if($this->typ == 'json'){
                $data['wap_head_image'] = $advContModel->getAdvList(array('group_id'=>$group_id),array(),1,100,'Floor');
                $this->data->addBody(-140,$data);
            }else{
                include $this->view->getView();
            }
        }else{

            $this->data->setError($msg,array(),$status);
        }
    }
    //开业楼层'模板2'固定id 2 固定广告位 pc35  wap37
    public function twoFloor(){
        $base_id = request_int('base_id');
        $adv_key = request_string('adv_key');
        $GoodsCommonModel   = new Goods_CommonModel();
        $GoodsBaseModel     = new Goods_BaseModel();
        $tempModel          = new Activity_TempModel();
        $tempBaseModel      = new Activity_TempBaseModel();
        $advContModel       = new Operation_AdvertisementModel();
        $group_id = Operation_AdvertisementModel::$adv_id["$adv_key"];
        $pc_head_image = $advContModel->getAdvList(array('group_id'=>$group_id),array(),1,100,'Floor');
        $temp = $tempModel->getOne(2);
        if($base_id){
            $tempBase = $tempBaseModel->getOneByWhere(array('temp_id'=>$temp['temp_id'],'base_id'=>$base_id));
        }else{
            $tempBase = $tempBaseModel->getOneByWhere(array('temp_id'=>$temp['temp_id']));
        }
        $flag = false;
        $data = array();
        if($tempBase['base_main_title']){
            //已知该模板固定格式主副标题都相等
            $main_title = explode(',',$tempBase['base_main_title']);
            if($temp['temp_main_title'] > count($main_title)){
                $msg = '标题不全';
                $status = 250;
            }
        }else{
            $msg = '标题不全';
            $status = 250;
        }
        $goodsids = explode(',',$tempBase['base_goods_cont']);
        if($goodsids){
            if(!$temp['temp_max']){
                if(count($goodsids)<$temp['temp_min']){
                    $msg = '商品数量有误';
                    $status = 250;
                }else{
                    $flag = true;
                    foreach($goodsids as $ks=>$vs){
                        if($onegoods = $GoodsCommonModel->getOneMyId(array('common_id'=>$vs))){
                            $data['goodslist'][] =  $onegoods;
                        }
                    }
                    foreach($data['goodslist'] as $key=>$value){
                        $goodsbase = $GoodsBaseModel->getOne($value['id_goods']);
                        foreach($goodsbase['goods_spec'] as $k=>$v){
                            $data['goodslist'][$key]['base_spec_name'] = trim(implode(',',$v),',');
                        }
                    }
                }
            }else{
                if(count($goodsids)>=$temp['temp_min'] && count($goodsids)<=$temp['temp_max']){
                    $flag = true;
                    foreach($goodsids as $ks=>$vs){
                        if($onegoods = $GoodsCommonModel->getOneMyId(array('common_id'=>$vs))){
                            $data['goodslist'][] =  $onegoods;
                        }
                    }
                    foreach($data['goodslist'] as $key=>$value){
                        $goodsbase = $GoodsBaseModel->getOne($value['id_goods']);
                        foreach($goodsbase['goods_spec'] as $k=>$v){
                            $data['goodslist'][$key]['base_spec_name'] = trim(implode(',',$v),',');
                        }
                    }
                }else{
                    $msg = '商品数量有误';
                    $status = 250;
                }
            }
        }else{
            $msg = '未添加商品';
            $status = 250;
        }
        $data['main_title'] = $main_title;
        $data['background'] = $tempBase['base_rgb'];
        $data['temp_title'] = $tempBase['base_name'];
        if($flag){
            if($this->typ == 'json'){
                $data['wap_head_image'] = $advContModel->getAdvList(array('group_id'=>$group_id),array(),1,100,'Floor');
                $this->data->addBody(-140,$data);
            }else{
                include $this->view->getView();
            }
        }else{
            $this->data->setError($msg,array(),$status);
        }
    }
    //开业楼层'模板3'固定id 3 固定广告位 pc34  wap38
    public function threeFloor(){
        $base_id = request_int('base_id');
        $adv_key = request_string('adv_key');
        $GoodsCommonModel   = new Goods_CommonModel();
        $GoodsBaseModel     = new Goods_BaseModel();
        $tempModel          = new Activity_TempModel();
        $tempBaseModel      = new Activity_TempBaseModel();
        $advContModel       = new Operation_AdvertisementModel();
        $group_id = Operation_AdvertisementModel::$adv_id["$adv_key"];
        $pc_head_image = $advContModel->getAdvList(array('group_id'=>$group_id),array(),1,100,'Floor');
        $temp = $tempModel->getOne(3);
        if($base_id){
            $tempBase = $tempBaseModel->getOneByWhere(array('temp_id'=>$temp['temp_id'],'base_id'=>$base_id));
        }else{
            $tempBase = $tempBaseModel->getOneByWhere(array('temp_id'=>$temp['temp_id']));
        }
        $flag = false;
        $data = array();
        if($tempBase['base_main_title']){
            //已知该模板固定格式主副标题都相等
            $main_title = explode(',',$tempBase['base_main_title']);
            $assis_titile = explode(',',$tempBase['base_assis_title']);
            if($temp['temp_main_title'] > count($main_title) || $temp['temp_assis_title']>count($assis_titile)){
                $msg = '标题不全';
                $status = 250;
            }
        }else{
            $msg = '标题不全';
            $status = 250;
        }
        $goodsids = explode(',',$tempBase['base_goods_cont']);
        if($goodsids){
            if(!$temp['temp_max']){
                if(count($goodsids)<$temp['temp_min']){
                    $msg = '商品数量有误';
                    $status = 250;
                }else{
                    $flag = true;
                    foreach($goodsids as $ks=>$vs){
                        if($onegoods = $GoodsCommonModel->getOneMyId(array('common_id'=>$vs))){
                            $data['goodslist'][] =  $onegoods;
                        }
                    }
                    foreach($data['goodslist'] as $key=>$value){
                        $goodsbase = $GoodsBaseModel->getOne($value['id_goods']);
                        foreach($goodsbase['goods_spec'] as $k=>$v){
                            $data['goodslist'][$key]['base_spec_name'] = trim(implode(',',$v),',');
                        }
                    }
                }
            }else{
                if(count($goodsids)>=$temp['temp_min'] && count($goodsids)<=$temp['temp_max']){
                    $flag = true;
                    foreach($goodsids as $ks=>$vs){
                        if($onegoods = $GoodsCommonModel->getOneMyId(array('common_id'=>$vs))){
                            $data['goodslist'][] =  $onegoods;
                        }
                    }
                    foreach($data['goodslist'] as $key=>$value){
                        $goodsbase = $GoodsBaseModel->getOne($value['id_goods']);
                        foreach($goodsbase['goods_spec'] as $k=>$v){
                            $data['goodslist'][$key]['base_spec_name'] = trim(implode(',',$v),',');
                        }
                    }
                }else{
                    $msg = '商品数量有误';
                    $status = 250;
                }
            }
        }else{
            $msg = '未添加商品';
            $status = 250;
        }
        $data['main_title'] = $main_title;
        $data['assis_title'] = $assis_titile;
        $data['background'] = $tempBase['base_rgb'];
        $data['temp_title'] = $tempBase['base_name'];
        if($flag){
            if($this->typ == 'json'){
                $data['wap_head_image'] = $advContModel->getAdvList(array('group_id'=>$group_id),array(),1,100,'Floor');
                $this->data->addBody(-140,$data);
            }else{
                include $this->view->getView();
            }
        }else{
            $this->data->setError($msg,array(),$status);
        }
    }

    public function manFloor(){
        $data = array();
        $Adv_ConModel = new Operation_AdvertisementModel();
        $goodsCatModel = new Goods_CatModel();
        $goodsCommonModel = new Goods_CommonModel();
        $mansongBaseModel = new ManSong_BaseModel();
        $mansongRuleModel = new Mansong_RuleModel();
        $adv_list = $Adv_ConModel->getAdvList(array('group_id'=>$Adv_ConModel::$adv_id['manfloor_pc']));

        $type = request_string('type');
        $cat_id = request_int('cat_id');
        $cat_sid = request_int('cat_sid');

        $cat_cond['cat_parent_id'] = 0;
        $cat_cond['cat_is_display'] = 1;
        $cat_order['cat_displayorder']= 'ASC';
        $goods_cats = $goodsCatModel->getByWhere($cat_cond,$cat_order);
        $goods_cat_ids = array_keys($goods_cats);
        $goodsCatNavModel = new Goods_CatNavModel();
        $cat_nav_cond['goods_cat_id:IN'] = $goods_cat_ids;
        $goods_cat_nav = $goodsCatNavModel->getByWhere($cat_nav_cond);

        foreach ($goods_cat_nav as $key=>$value)
        {
            if($goods_cats[$value['goods_cat_id']])
            {
                $goods_cats[$value['goods_cat_id']]['nav_name'] = $value['goods_cat_nav_name'];
            }
        }

        if($cat_id)
        {
            $c_id = $cat_id;
            if($goods_cats[$cat_id])
            {
                $goods_cats[$cat_id]['curr']  = 1;
            }

            $cat_sub_cond['cat_parent_id'] = $cat_id;
            $cat_sub_cond['cat_is_display'] = 1;
            $cat_sub_order['cat_displayorder']= 'ASC';
            $goods_sub_cats = $goodsCatModel->getByWhere($cat_sub_cond,$cat_sub_order);
            if($cat_sid)
            {
                $c_id = $cat_sid;
                if($goods_sub_cats[$cat_sid])
                {
                    $goods_sub_cats[$cat_sid]['curr']  = 1;
                }
            }

            $data['goods_sub_cat'] = $goods_sub_cats;
        }

        //$data['goods_cat'] = $goods_cats;

        $YLB_Page = new YLB_Page();
        $YLB_Page->listRows = request_int('rows',24);
        $rows = $YLB_Page->listRows;
        $offset = request_int('firstRow', 0);
        $page = ceil_r($offset / $rows);
        //开始满减规则
        //  获取全部规则
        $sql = "SELECT DISTINCT rule_price,rule_discount FROM ylb_mansong_rule ORDER BY rule_discount DESC";
        $ruleCont = $mansongRuleModel->selectSql($sql);
        $ruleCat = array();
        if(count($ruleCont)>0){
            foreach($ruleCont as $key=>$value){
                $shop_id =  array();
                $ruleBase = $mansongRuleModel->getByWhere(array('rule_price'=>$value['rule_price'],'rule_discount'=>$value['rule_discount']));
                if(count($ruleBase) >= 1){
                    $mansong_id = array_unique(array_column($ruleBase,'mansong_id'));
                    foreach($mansong_id as $k => $v){
                        $mansong_base = $mansongBaseModel->getOneByWhere(array('mansong_id'=>$v,'mansong_state'=>$mansongBaseModel::NORMAL));
                        if($mansong_base){
                            $shop_id[] = $mansong_base['shop_id'];
                        }
                    }
                    if($shop_id){
                        $ruleCat[$key]['rule_price'] = $value['rule_price'];
                        $ruleCat[$key]['rule_discount'] = $value['rule_discount'];
                        $ruleCat[$key]['shop_id']= trim(implode(',',array_unique($shop_id)),',');
                    }

                    if(count($ruleCat) == 10){
                        break;
                    }
                }
            }
        }
        $data['rule_cat'] = array_merge($ruleCat);
        //结束满减规则
        $mansong_base = $mansongBaseModel->getByWhere(array('mansong_state'=>$mansongBaseModel::NORMAL));
        //添加方法（此方法会非常缓慢）

        if($type){
            $shop_id = explode(',',$data['rule_cat'][$type-1]['shop_id']);
            $cond_row['shop_id:IN'] = $shop_id;
            if($goods_cats){
                foreach($goods_cats as $key=>$value){
                    $catlist = $goodsCatModel->getCatChildId($value['cat_id']);
                    $goods_base_list = $goodsCommonModel->getCommonNormalList(array('cat_id:IN'=>$catlist,'shop_id:IN'=>$shop_id));
                    if(!$goods_base_list['items']){
                        unset($goods_cats[$key]);
                    }
                }
            }
        }else{
            $shop_id = array_merge(array_unique(array_column($mansong_base,'shop_id')));
            $cond_row['shop_id:IN'] = $shop_id;
            if($goods_cats){

                foreach($goods_cats as $key=>$value){
                    $catlist = $goodsCatModel->getCatChildId($value['cat_id']);
                    $goods_base_list = $goodsCommonModel->getCommonNormalList(array('cat_id:IN'=>$catlist,'shop_id:IN'=>$shop_id));

                    if(!$goods_base_list['items']){
                        unset($goods_cats[$key]);
                    }
                }
            }
        }

        $data['goods_cat'] = $goods_cats;
        //缓慢的方法结束
        if ($c_id)
        {
            //查找该分类下所有的子分类
            $cat_list = $goodsCatModel->getCatChildId($c_id);
            $cond_row['cat_id:IN'] = $cat_list;
        }

        $cond_row['common_stock:>'] = 0;
        $cond_row['common_state'] = Goods_CommonModel::GOODS_STATE_NORMAL;
        $cond_row['common_verify'] = Goods_CommonModel::GOODS_VERIFY_ALLOW;

        $order_row['common_salenum'] = 'DESC';

        $data_goods = $goodsCommonModel->getGoodsList($cond_row, $order_row, $page, $rows);
        $YLB_Page->totalRows = $data_goods['totalsize'];
        $page_nav = $YLB_Page->prompt();
        $data['data_goods'] = $data_goods;

        if('json' == $this->typ){
            $adv_list = $Adv_ConModel->getAdvList(array('group_id'=>$Adv_ConModel::$adv_id['manfloor_wap']));
            $data['adv_list'] = array_values($adv_list['items']);
            $data['goods_cat'] = array_merge($data['goods_cat']);
            $this->data->addBody(-140, $data);
        }else{
            include $this->view->getView();
        }

    }

}

?>

