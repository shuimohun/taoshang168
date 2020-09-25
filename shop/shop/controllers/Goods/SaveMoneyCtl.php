<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}
/**
 * @author     jiaxiaolei 惠省惠赚活动页
 */

class Goods_SaveMoneyCtl extends Controller
{

    public $goodsCatModel = null;
    public $goodsCommonModel = null;
    public $AdvModel = null;
    public $voucherQuotaModel =null;


    public function __construct(&$ctl, $met, $typ)
    {
        parent::__construct($ctl, $met, $typ);

        $this->goodsCatModel = new Goods_CatModel();
        $this->goodsCommonModel = new Goods_CommonModel();
        $this->AdvModel = new Operation_AdvertisementModel();
        $this->voucherQuotaModel = new Voucher_quotaModel();
        $this->Shop_BaseModel = new Shop_BaseModel();
        $this->Shop_ClassModel = new Shop_ClassModel();
        $this->Increase_GoodsModel = new Increase_GoodsModel();
        $this->Increase_BaseModel = new Increase_BaseModel();


    }

    public function index()
    {
        $data = array();
        $cat_id = request_string("cat_id", 0);
        $state_id = request_string("state_id");//类型id
        $cat_sid = request_string("cat_sid");//二级分类id
        $Fmoney = request_string("Fmoney");//二级分类id
        $Smoney = request_string("Smoney");//二级分类id
        $GoodsCatModel = new Goods_CatModel();
        if($cat_id){
            $cond_row['cat_pid'] = $cat_id;
            if($cat_sid){
                $childCatIdArr = array_column($GoodsCatModel->getChildCat($cat_sid),'cat_id');
                $cond_row['cat_id:in'] = $childCatIdArr;
            }

        }

        if($Fmoney && $Smoney){
            $cond_row['common_share_price:>']=$Fmoney;
            $cond_row['common_share_price:<']=$Smoney;
            $state_id='';
        }
        if($Smoney){
            $cond_row['common_share_price:<']=$Smoney;
            $state_id='';
        }
        if($Fmoney){
            $cond_row['common_share_price:>']=$Fmoney;
            $state_id='';
        }
        if(1==$state_id)
        {
            $cond_row['common_share_price:<']=50;
        }
        else if(2==$state_id)
        {
            $cond_row['common_share_price:>=']=50;
            $cond_row['common_share_price:<']=100;
        }
        else if (3==$state_id)
        {
            $cond_row['common_share_price:>=']=100;
            $cond_row['common_share_price:<']=300;
        }
        else if(4 ==$state_id)
        {
            $cond_row['common_share_price:>=']=300;
        }

        $cond_row['common_stock:>'] = 0;
        $cond_row['common_state'] = Goods_CommonModel::GOODS_STATE_NORMAL;
        $cond_row['common_verify'] = Goods_CommonModel::GOODS_VERIFY_ALLOW;
        $cond_row['common_is_jia'] = 0;

        /*惠省*/
        $share_row = $this->goodsCommonModel->listByWhere($cond_row,array('common_share_price'=> 'DESC'),1,18);

        $data['share_list']['page'] = $share_row['page'];
        $data['share_list']['total'] = $share_row['total'];
        $data['share_list']['totalsize'] = $share_row['totalsize'];
        $data['share_list']['records'] = $share_row['records'];
        $data['share_list']['items'] = $this->goodsCommonModel->getRecommonRow($share_row);

        /*惠赚*/
        if($Fmoney || $Smoney){
            unset($cond_row['common_share_price:>']);
            unset($cond_row['common_share_price:>']);
            $cond_row['common_promotion_price:<']=$Smoney;
            $cond_row['common_promotion_price:<']=$Smoney;
        }

        unset($cond_row['common_share_price:<']);//删除省
        unset($cond_row['common_share_price:>=']);
        if(1==$state_id)
        {
            $cond_row['common_promotion_price:<']=50;//赚
        }
        else if(2==$state_id)
        {

            $cond_row['common_promotion_price:>=']=50;
            $cond_row['common_promotion_price:<']=100;
        }
        else if (3==$state_id)
        {

            $cond_row['common_promotion_price:>=']=100;
            $cond_row['common_promotion_price:<']=300;
        }
        else if(4 ==$state_id)
        {

            $cond_row['common_promotion_price:>=']=300;
        }
        $cond_row['common_is_promotion'] = 1;
        $promotion_row = $this->goodsCommonModel->listByWhere($cond_row,array('common_promotion_price'=> 'DESC'),1,18);

        $promotion_list = $this->goodsCommonModel->getRecommonRow($promotion_row);
        $data['promotion_list']['page'] = $promotion_row['page'];
        $data['promotion_list']['total'] = $promotion_row['total'];
        $data['promotion_list']['totalsize'] = $promotion_row['totalsize'];
        $data['promotion_list']['records'] = $promotion_row['records'];
        $data['promotion_list']['items'] = $promotion_list;

        /*省到家*/

        $inc_cond_row['increase_state']=Increase_BaseModel::NORMAL;
        $inc_cond_row['increase_end_time:>']=get_date_time();
        $inc_cond_row['increase_start_time:<']=get_date_time();
        $incData = $this->Increase_BaseModel->getByWhere($inc_cond_row);
        $inc_id = array_column($incData,"increase_id");

        $inc_goods_cond['increase_id:IN']=$inc_id;
        $inc_goods_cond['goods_end_time:>']=get_date_time();
        $inc_goods_cond['goods_start_time:<']=get_date_time();
        $incGoods = $this->Increase_GoodsModel->getByWhere($inc_goods_cond);

        $common_id = array_column($incGoods,"common_id");
        $conds_row['common_id:IN'] = $common_id;
        unset($cond_row['common_is_promotion']);
        unset($cond_row['common_is_jia']);
        $jia_row= $this->goodsCommonModel->listByWhere($conds_row,array('common_share_price'=> 'DESC'),1,18);
        $jia_list = $promotion_list = $this->goodsCommonModel->getRecommonRow($jia_row);
        $data['jia_list']['page'] = $jia_row['page'];
        $data['jia_list']['total'] = $jia_row['total'];
        $data['jia_list']['totalsize'] = $jia_row['totalsize'];
        $data['jia_list']['records'] = $jia_row['records'];
        $data['jia_list']['items'] = $jia_list;

        /*钱不尽*/


        $bundlingBaseModel = new Bundling_BaseModel();
        $bundling_cond_row['bundling_state']=$bundlingBaseModel::NORMAL;
        $bundlingArr = $bundlingBaseModel->getBundlingActList($bundling_cond_row,array("bundling_discount_price"=> 'ASC'),1,18);
/*----------------套餐商铺含有优惠券的----*/
        $shopId = array_unique(array_column($bundlingArr['items'],'shop_id'));
        $voucher_cond_row['combo_end_time:>']=get_date_time();
        $voucher_order_row['combo_end_time']='DESC';
        $voucher_cond_row['shop_id:IN']=$shopId;
        $voucherShop = $this->voucherQuotaModel->getVoucherQuotaList($voucher_cond_row,$voucher_order_row);
        $voucherShopId = array_unique(array_column($voucherShop['items'],'shop_id'));
/*-------------------------------end---------*/

        if($bundlingArr['items']){
            foreach ($bundlingArr['items'] as $k=> $v){

                $data['bundling_list'][$k]  = $bundlingBaseModel->getBundlingDetailInfo(array('bundling_id'=> $v['bundling_id']));
                if(in_array($v['shop_id'],$voucherShopId)){
                    $data['bundling_list'][$k]['voucher']=1;
                }
            }

        }

        if('json' ==$this->typ){

            $data['adv_list'] = $this->AdvModel->getAdvList(array('group_id' => Operation_AdvertisementModel::$adv_id['waphshz']));
            $this->data->addBody(-140, $data);
        }else{
            $this->initData();
            $adv_list = $this->AdvModel->getAdvList(array('group_id' => Operation_AdvertisementModel::$adv_id['pchshz']));

            include $this->view->getView();
        }

    }

    //惠省更多页
    function moreGoodList(){


        $Fmoney = request_string("Fmoney");
        $Smoney = request_string("Smoney");
        $state_id = request_string('state_id');
        $cat_id = request_int('cat_id');
        $cat_sid = request_int('cat_sid');



        //获取一级分类
        $cat_cond['cat_parent_id'] = 0;
        $cat_cond['cat_is_display'] = 1;
        $cat_order['cat_displayorder']= 'ASC';
        $oneCat = $this->goodsCatModel->getByWhere($cat_cond,$cat_order);

        $goods_cat_ids = array_keys($oneCat);
        $goodsCatNavModel = new Goods_CatNavModel();
        $cat_nav_cond['goods_cat_id:IN'] = $goods_cat_ids;
        $goods_cat_nav = $goodsCatNavModel->getByWhere($cat_nav_cond);
        foreach ($goods_cat_nav as $key=>$value)
        {
            if($oneCat[$value['goods_cat_id']])
            {
                $oneCat[$value['goods_cat_id']]['nav_name'] = $value['goods_cat_nav_name'];
            }
        }
        if($cat_id){
            $c_id = $cat_id;
            if($oneCat[$cat_id]){

                $oneCat[$cat_id]['curr']=1;
            }
            $cat_sub_cond['cat_parent_id'] = $cat_id;
            $cat_sub_cond['cat_is_display'] = 1;
            $cat_sub_order['cat_displayorder']= 'ASC';
            $goods_sub_cats = $this->goodsCatModel->getByWhere($cat_sub_cond,$cat_sub_order);
            if($cat_sid)
            {
                $c_id = $cat_sid;
                if($goods_sub_cats[$cat_sid])
                {
                    $goods_sub_cats[$cat_sid]['curr']  = 1;
                }
            }
            $data['sub_cat'] = $goods_sub_cats;
        }

        $data['oneCat'] = array_values($oneCat);
        /*惠省数据*/
        $YLB_Page = new YLB_Page();
        $page     = request_int('page',1);
        $YLB_Page->listRows = request_int('rows',60);
        $rows = $YLB_Page->listRows;
        if ($c_id)
        {
            //查找该分类下所有的子分类
            $cat_list = $this->goodsCatModel->getCatChildId($c_id);
            $share_cond_row['cat_id:IN'] = $cat_list;
            $promotion_cond_row['cat_id:IN'] = $cat_list;
        }

        if($Fmoney && $Smoney)
        {
            $share_cond_row['common_share_price:<']=$Smoney;
            $share_cond_row['common_share_price:>=']=$Fmoney;
        }else if($Fmoney)
        {
            $share_cond_row['common_share_price:>=']=$Fmoney;
        }else if($Smoney)
        {
            $share_cond_row['common_share_price:<']=$Smoney;
        }else{
            switch ($state_id){
                case 1:
                    $share_cond_row['common_share_price:<']=50;
                    break;
                case 2:
                    $share_cond_row['common_share_price:>=']=50;
                    $share_cond_row['common_share_price:<']=100;
                    break;
                case 3:
                    $share_cond_row['common_share_price:>=']=100;
                    $share_cond_row['common_share_price:<']=300;
                    break;
                case 4:
                    $share_cond_row['common_share_price:>=']=300;
                    break;
                default:'';
                    break;
            }
        }

        $share_cond_row['common_stock:>'] = 0;
        $share_cond_row['common_state'] = Goods_CommonModel::GOODS_STATE_NORMAL;
        $share_cond_row['common_verify'] = Goods_CommonModel::GOODS_VERIFY_ALLOW;
        $share_cond_row['common_is_jia'] = 0;

        $share_cond_row['common_state'] = Goods_CommonModel::GOODS_STATE_NORMAL;
        $share_List_row = $this->goodsCommonModel->listByWhere($share_cond_row,array('common_share_price'=> 'DESC'),$page, $rows);

        $share_List = $this->goodsCommonModel->getRecommonRow($share_List_row);

        $YLB_Page->nowPage    = $page;
        $YLB_Page->listRows   = $rows;
        $YLB_Page->totalPages = ceil_r($share_List_row['totalsize']/$rows);
        $page_nav = $YLB_Page->promptII();

        $data['share_list']['page'] = $share_List_row['page'];
        $data['share_list']['total'] = $share_List_row['total'];
        $data['share_list']['totalsize'] = $share_List_row['totalsize'];
        $data['share_list']['records'] = $share_List_row['records'];
        $data['share_list']['items'] = $share_List;
        if('json' ==$this->typ){
            foreach ($data['sub_cat'] as $k=>$v){
                $sub_cat[]=$v;
            }
            $data['sub_cat'] = $sub_cat;
            $this->data->addBody(-140, $data);
        }else{
            $this->initData();
            $adv_list = $this->AdvModel->getAdvList(array('group_id' => Operation_AdvertisementModel::$adv_id['pchshz']));
            include $this->view->getView();
        }

    }



    //惠赚更多页
    function moreHZGoodList(){

        $Fmoney = request_string("Fmoney");
        $Smoney = request_string("Smoney");
        $state_id = request_string('state_id');
        $cat_id = request_int('cat_id');
        $cat_sid = request_int('cat_sid');


        //获取一级分类
        $cat_cond['cat_parent_id'] = 0;
        $cat_cond['cat_is_display'] = 1;
        $cat_order['cat_displayorder']= 'ASC';
        $oneCat = $this->goodsCatModel->getByWhere($cat_cond,$cat_order);

        $goods_cat_ids = array_keys($oneCat);
        $goodsCatNavModel = new Goods_CatNavModel();
        $cat_nav_cond['goods_cat_id:IN'] = $goods_cat_ids;
        $goods_cat_nav = $goodsCatNavModel->getByWhere($cat_nav_cond);
        foreach ($goods_cat_nav as $key=>$value)
        {
            if($oneCat[$value['goods_cat_id']])
            {
                $oneCat[$value['goods_cat_id']]['nav_name'] = $value['goods_cat_nav_name'];
            }
        }
        if($cat_id){
            $c_id = $cat_id;
            if($oneCat[$cat_id]){

                $oneCat[$cat_id]['curr']=1;
            }
            $cat_sub_cond['cat_parent_id'] = $cat_id;
            $cat_sub_cond['cat_is_display'] = 1;
            $cat_sub_order['cat_displayorder']= 'ASC';
            $goods_sub_cats = $this->goodsCatModel->getByWhere($cat_sub_cond,$cat_sub_order);
            if($cat_sid)
            {
                $c_id = $cat_sid;
                if($goods_sub_cats[$cat_sid])
                {
                    $goods_sub_cats[$cat_sid]['curr']  = 1;
                }
            }

                $data['sub_cat'] = $goods_sub_cats;


        }

        $data['oneCat'] = array_values($oneCat);
        /*惠赚数据*/
        $YLB_Page = new YLB_Page();
        $page     = request_int('page',1);
        $YLB_Page->listRows = request_int('rows',60);
        $rows = $YLB_Page->listRows;
        if ($c_id)
        {
            //查找该分类下所有的子分类
            $cat_list = $this->goodsCatModel->getCatChildId($c_id);
            $promotion_cond_row['cat_id:IN'] = $cat_list;
        }

        if($Fmoney && $Smoney)
        {
            $promotion_cond_row['common_promotion_price:<']=$Smoney;
            $promotion_cond_row['common_promotion_price:>=']=$Fmoney;
        }else if($Fmoney)
        {
            $promotion_cond_row['common_promotion_price:>=']=$Fmoney;
        }else if($Smoney)
        {
            $promotion_cond_row['common_promotion_price:<']=$Smoney;
        }else{
            switch ($state_id){
                case 1:
                    $promotion_cond_row['common_promotion_price:<']=50;
                    break;
                case 2:
                    $promotion_cond_row['common_promotion_price:>=']=50;
                    $promotion_cond_row['common_promotion_price:<']=100;
                    break;
                case 3:
                    $promotion_cond_row['common_promotion_price:>=']=100;
                    $promotion_cond_row['common_promotion_price:<']=300;
                    break;
                case 4:
                    $promotion_cond_row['common_promotion_price:>=']=300;
                    break;
                default:'';
                    break;
            }
        }

        $promotion_cond_row['common_stock:>'] = 0;
        $promotion_cond_row['common_state'] = Goods_CommonModel::GOODS_STATE_NORMAL;
        $promotion_cond_row['common_verify'] = Goods_CommonModel::GOODS_VERIFY_ALLOW;
        $promotion_cond_row['common_is_jia'] = 0;
        $promotion_row = $this->goodsCommonModel->listByWhere($promotion_cond_row,array('common_promotion_price'=> 'DESC'),$page, $rows);

        $promotion_List = $this->goodsCommonModel->getRecommonRow($promotion_row);


        $YLB_Page->nowPage    = $page;
        $YLB_Page->listRows   = $rows;
        $YLB_Page->totalPages = ceil_r($promotion_row['totalsize']/$rows);
        $page_nav = $YLB_Page->promptII();

        $data['promotion_list']['page'] = $promotion_row['page'];
        $data['promotion_list']['total'] = $promotion_row['total'];
        $data['promotion_list']['totalsize'] = $promotion_row['totalsize'];
        $data['promotion_list']['records'] = $promotion_row['records'];
        $data['promotion_list']['items'] = $promotion_List;
        if($this->typ=='json'){
            foreach ($data['sub_cat'] as $k=>$v){
                $sub_cat[]=$v;
            }
           $data['sub_cat'] = $sub_cat;
            $this->data->addBody(-140, $data);
        }else{
            $this->initData();
            $adv_list = $this->AdvModel->getAdvList(array('group_id' => Operation_AdvertisementModel::$adv_id['pchshz']));
            include $this->view->getView();
        }


    }



    //省到家更多页
    function saveList(){

        $Fmoney = request_string("Fmoney");
        $Smoney = request_string("Smoney");
        $cat_id = request_string("cat_id",0);
        $state_id = request_string("state_id");
        $page =request_string("page",1);
        $rows = request_string("rows",27);
        if($cat_id){
            $cond_row['cat_pid']=$cat_id;
        }
        if($Fmoney && $Smoney)
        {
            $cond_row['common_promotion_price:<']=$Smoney;
            $cond_row['common_promotion_price:>=']=$Fmoney;
        }else if($Fmoney)
        {
            $cond_row['common_promotion_price:>=']=$Fmoney;
        }else if($Smoney)
        {
            $cond_row['common_promotion_price:<']=$Smoney;
        }else{
            switch ($state_id){
                case 1:
                    $cond_row['common_promotion_price:<']=50;
                    break;
                case 2:
                    $cond_row['common_promotion_price:>=']=50;
                    $cond_row['common_promotion_price:<']=100;
                    break;
                case 3:
                    $cond_row['common_promotion_price:>=']=100;
                    $cond_row['common_promotion_price:<']=300;
                    break;
                case 4:
                    $cond_row['common_promotion_price:>=']=300;
                    break;
                default:'';
                    break;
            }
        }

        $YLB_Page = new YLB_Page();
        $rows = $YLB_Page->listRows;

        $cond_row['common_stock:>'] = 0;
        $cond_row['common_state'] = Goods_CommonModel::GOODS_STATE_NORMAL;
        $cond_row['common_verify'] = Goods_CommonModel::GOODS_VERIFY_ALLOW;
        $cond_row['common_state'] = Goods_CommonModel::GOODS_STATE_NORMAL;

        $inc_cond_row['increase_state']=Increase_BaseModel::NORMAL;
        $inc_cond_row['increase_end_time:>']=get_date_time();
        $incData = $this->Increase_BaseModel->getByWhere($inc_cond_row);
        $inc_id = array_column($incData,"increase_id");

        $inc_goods_cond['increase_id:IN']=$inc_id;
        $inc_goods_cond['goods_end_time:>']=get_date_time();
        $inc_goods_cond['goods_start_time:<']=get_date_time();
        $incGoods = $this->Increase_GoodsModel->getByWhere($inc_goods_cond);

        $goods_id = array_column($incGoods,"common_id");
        $cond_row['common_id:IN'] = $goods_id;

        $goods_row = $this->goodsCommonModel->listByWhere($cond_row,array("common_share_price"=>"DESC"),$page,$rows);

        $goods_list = $this->goodsCommonModel->getRecommonRow($goods_row);

        $YLB_Page->nowPage    = $page;
        $YLB_Page->listRows   = $rows;
        $YLB_Page->totalPages = ceil_r($goods_row['totalsize']/$rows);
        $page_nav = $YLB_Page->promptII();


        $cat_pid = array_column($goods_list,"cat_pid");
        /*********获取一级分类s****************/
        $cond_rows['common_stock:>'] = 0;
        $cond_rows['common_state'] = Goods_CommonModel::GOODS_STATE_NORMAL;
        $cond_rows['common_verify'] = Goods_CommonModel::GOODS_VERIFY_ALLOW;
        $cond_rows['common_state'] = Goods_CommonModel::GOODS_STATE_NORMAL;

        $inc_cond_rows['increase_state']=Increase_BaseModel::NORMAL;
        $inc_cond_rows['increase_end_time:>']=get_date_time();
        $incData = $this->Increase_BaseModel->getByWhere($inc_cond_rows);
        $inc_ids = array_column($incData,"increase_id");

        $inc_goods_conds['increase_id:IN']=$inc_ids;
        $inc_goods_conds['goods_end_time:>']=get_date_time();
        $inc_goods_conds['goods_start_time:<']=get_date_time();
        $incGoodss = $this->Increase_GoodsModel->getByWhere($inc_goods_conds);

        $goods_ids = array_column($incGoodss,"common_id");
        $cond_rows['common_id:IN'] = $goods_ids;

        $goods_rows = $this->goodsCommonModel->listByWhere($cond_rows,array("common_share_price"=>"DESC"),$page,$rows);

        $goods_lists = $this->goodsCommonModel->getRecommonRow($goods_rows);
         $cat_pids = array_column($goods_lists,"cat_pid");
        $goodsCatNavModel = new Goods_CatNavModel();
        $cat_nav_conds['goods_cat_id:IN'] = $cat_pids;
        $navs = $goodsCatNavModel->getByWhere($cat_nav_conds);
        foreach ($navs as $k=>$v){
            unset($v['goods_cat_nav_recommend_display']);
            $nav_cats[]=$v;
        }
        /*给一级分类添加样式*/
        if($cat_id){
            foreach($nav_cats as $k =>$v){
                if($v['goods_cat_id']==$cat_id){
                    $nav_cats[$k]['curr'] =1;
                }
            }
        }
        /*******end***********************************************************/

        $data['nav_cat'] = $nav_cats;
        $data['goods_list']['page'] = $goods_row['page'];
        $data['goods_list']['total'] = $goods_row['total'];
        $data['goods_list']['totalsize'] = $goods_row['totalsize'];
        $data['goods_list']['records'] = $goods_row['records'];
        $data['goods_list']['items'] = $goods_list;


        if($this->typ=="json"){
            $this->data->addBody(-140,$data);
        }

        $this->initData();
        $adv_list = $this->AdvModel->getAdvList(array('group_id' => Operation_AdvertisementModel::$adv_id['pchshz']));
        include $this->view->getView();
    }


    /*钱不尽更多页*/
    function endlessList(){


        $Fmoney = request_string("Fmoney");
        $Smoney = request_string("Smoney");
        $page= request_string("page",1);
        $rows= request_string("rows",27);
        $class_id = request_string("cat_id");
        $state_id = request_string("state_id");
        /*钱不尽*/



        if($Fmoney && $Smoney)
        {
            $bundling_cond_row['bundling_discount_price:<']=$Smoney;
            $bundling_cond_row['bundling_discount_price:>=']=$Fmoney;
        }else if($Fmoney)
        {
            $bundling_cond_row['bundling_discount_price:>=']=$Fmoney;
        }else if($Smoney)
        {
            $bundling_cond_row['bundling_discount_price:<']=$Smoney;
        }else{
            switch ($state_id){
                case 1:
                    $bundling_cond_row['bundling_discount_price:<']=50;
                    break;
                case 2:
                    $bundling_cond_row['bundling_discount_price:>=']=50;
                    $bundling_cond_row['bundling_discount_price:<']=100;
                    break;
                case 3:
                    $bundling_cond_row['bundling_discount_price:>=']=100;
                    $bundling_cond_row['bundling_discount_price:<']=300;
                    break;
                case 4:
                    $bundling_cond_row['bundling_discount_price:>=']=300;
                    break;
                default:'';
                    break;
            }
        }

        if($class_id){

            $cond_rows['shop_class_id']=$class_id;
            $cond_rows['shop_status']=Shop_BaseModel::SHOP_STATUS_OPEN;
            $shopBase = $this->Shop_BaseModel->getByWhere($cond_rows);
            $shop_id = array_unique(array_column($shopBase,"shop_id"));
            $bundling_cond_row['shop_id:IN']=$shop_id;
        }

        $bundlingBaseModel = new Bundling_BaseModel();
        $bundling_cond_row['bundling_state']=$bundlingBaseModel::NORMAL;
        $bundlingArr = $bundlingBaseModel->getBundlingActList($bundling_cond_row,array("bundling_discount_price"=> 'ASC'),$page,$rows);
        $shop_Id = array_unique(array_column($bundlingArr['items'],"shop_id"));

        $voucher_cond_row['combo_end_time:>']=get_date_time();
        $voucher_cond_row['shop_id:IN']=$shop_Id;
        $voucher_order_row['combo_end_time']='DESC';
        $voucher = $this->voucherQuotaModel->getVoucherQuotaList($voucher_cond_row,$voucher_order_row);
        $voucherShopId = array_unique(array_column($voucher['items'],"shop_id"));

        /*根据shop_class_id 查所属分类*/
        $cond_row['shop_id:IN']=$shop_Id;
        $cond_row['shop_status']=Shop_BaseModel::SHOP_STATUS_OPEN;
        $shopBase = $this->Shop_BaseModel->getByWhere($cond_row);
        $shop_class_id = array_unique(array_column($shopBase,"shop_class_id"));


        /*------------根据套餐查询所有分类s-----------*/
        $bundling_cond_rows['bundling_state']=$bundlingBaseModel::NORMAL;
        $bundlingArrs = $bundlingBaseModel->getBundlingActList($bundling_cond_rows,array("bundling_discount_price"=> 'ASC'),$page,$rows);
        $shop_Ids = array_unique(array_column($bundlingArrs['items'],"shop_id"));

        /*根据shop_class_id 查所属分类*/
        $cond_row_total['shop_id:IN']=$shop_Ids;
        $cond_row_total['shop_status']=Shop_BaseModel::SHOP_STATUS_OPEN;
        $shopBases = $this->Shop_BaseModel->getByWhere($cond_row_total);
        $shop_class_ids = array_unique(array_column($shopBases,"shop_class_id"));


        $cat_cond_rows['shop_class_id:IN']=$shop_class_ids;
        $cat = $this->Shop_ClassModel->getByWhere($cat_cond_rows);
        foreach ($cat as $k=>$v){
            $nav_cat[]=$v;
        }

        if($class_id){
            foreach($nav_cat as $k =>$v){
                if($v['shop_class_id']==$class_id){
                    $nav_cat[$k]['curr'] =1;
                }
            }
        }

        $data['nav_cat']=$nav_cat;


        /*------------根据套餐查询所有分类e-----------*/




        $YLB_Page = new YLB_Page();
        $YLB_Page->nowPage    = $page;
        $YLB_Page->listRows   = $rows;
        $YLB_Page->totalPages = ceil_r($bundlingArr['totalsize']/$rows);
        $page_nav = $YLB_Page->promptII();

        $data['bundling_list']=$bundlingArr;

        if($bundlingArr['items']){
            foreach ($bundlingArr['items'] as $k=> $v){
                if($bundlingBaseModel->getBundlingDetailInfo(array('bundling_id'=> $v['bundling_id']))){
                    $data['bundling_list']['items'][$k]  = $bundlingBaseModel->getBundlingDetailInfo(array('bundling_id'=> $v['bundling_id']));
                    if(in_array($v['shop_id'],$voucherShopId)){
                        $data['bundling_list']['items'][$k]['voucher']=1;
                    }
                }
            }

        }
        if($this->typ=="json"){
            $this->data->addBody(-140,$data);
        }

        $this->initData();
        $adv_list = $this->AdvModel->getAdvList(array('group_id' => Operation_AdvertisementModel::$adv_id['pchshz']));
        include $this->view->getView();
    }




}
