<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Seller_IndexCtl extends Seller_Controller
{
	public $shopBaseModel = null;
	public $userBaseModel = null;
    public $goodsCommonModel = null;
    public $shopCompanyModel = null;
    public $goodsBaseModel  = null;
    public $shopGoodsLikeModel = null;
    public $ClassBindModel = null;
    public $goodsCatModel  = null;
    public $Order_GoodsModel = null;
    public $Order_BaseModel  = null;
    public $User_FootprintModel = null;
    public $informationBaseModel = null;
    public $Order_StateModel = null;

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
		parent::__construct($ctl, $met, $typ);

		$this->shopBaseModel = new Shop_BaseModel();
		$this->userBaseModel = new User_BaseModel();
        $this->goodsCommonModel = new Goods_CommonModel();
        $this->shopCompanyModel = new Shop_CompanyModel();
        $this->goodsBaseModel  = new Goods_BaseModel();
        $this->shopGoodsLikeModel = new Shop_GoodsLikeModel();
        $this->ClassBindModel   = new Shop_ClassBindModel();
        $this->goodsCatModel    = new Goods_CatModel();
        $this->Order_GoodsModel = new Order_GoodsModel();
        $this->Order_BaseModel  = new Order_BaseModel();
        $this->User_FootprintModel = new User_FootprintModel();
        $this->informationBaseModel = new Information_BaseModel();
    }

	/**
	 * 首页
	 *
	 * @access public
	 */
	public function index()
	{
	    $user_id  = Perm::$userId;
	    $shop_id  = Perm::$shopId;
        $chain_id = Perm::$chainId;

        //判断商家是否有paycenter账户 如果没有跳转到paycenter生成帐号 然后再跳转回来

        $key              = YLB_Registry::get('paycenter_api_key');
        $url              = YLB_Registry::get('paycenter_api_url');
        $paycenter_app_id = YLB_Registry::get('paycenter_app_id');

        $formvars            = array();
        $formvars['app_id']  = $paycenter_app_id;
        $formvars['user_id'] = $user_id;
        $rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_User_Info&met=checkUser&typ=json', $url), $formvars);
        if($rs['status'] == 250)
        {
            header('Location:'.$url.'?ctl=Info&met=index&forward='.YLB_Registry::get('url').'?ctl=Seller_Index&met=index');
        }

        if($user_id)
        {
            if(isset($_COOKIE['last_login_time']))
            {
                $last_login_time = $_COOKIE['last_login_time'];
            }

            if(isset($_COOKIE['last_login_ip']))
            {
                $last_login_ip = $_COOKIE['last_login_ip'];
            }

            if(!isset($_COOKIE['last_login_time']) || !isset($_COOKIE['last_login_ip']))
            {
                $User_InfoModel = new User_InfoModel();
                $user_info = $User_InfoModel->getOne($user_id);

                $last_login_time = $user_info['lastlogintime'];
                $last_login_ip   = $user_info['user_lastip'];

                setcookie('last_login_time',$last_login_time);
                setcookie('last_login_ip',$last_login_ip);
            }
        }


        //以下未做整理 Zhenzh
        if($shop_id && $this->shop_base)
        {
            //店铺运营推广
            if($this->shop_base['shop_self_support'] == 'true')
            {
                //管理员后台惠抢购功能开启
                if(Web_ConfigModel::value('scarebuy_allow'))
                {
                    $data['promotion_items']['scarebuy_allow_flag'] = true;
                    $data['promotion_items']['scarebuy_combo_flag'] = true;
                }
                else
                {
                    $data['promotion_items']['scarebuy_allow_flag'] = false;
                }

                //管理员后台促销功能开启
                if(Web_ConfigModel::value('promotion_allow'))
                {
                    $data['promotion_items']['promotion_allow_flag'] = true;
                    $data['promotion_items']['promotion_increase_combo_flag'] = true;
                    $data['promotion_items']['promotion_discount_combo_flag'] = true;
                    $data['promotion_items']['promotion_mansong_combo_flag'] = true;
                }
                else
                {
                    $data['promotion_items']['promotion_allow_flag'] = false;
                }

                //金蛋商城、金蛋兑换、代金券 同时开启，代金券功能才可用
                if(Web_ConfigModel::value('pointshop_isuse') && Web_ConfigModel::value('pointprod_isuse') && Web_ConfigModel::value('voucher_allow'))
                {
                    $data['promotion_items']['voucher_allow_flag'] = true;
                    $data['promotion_items']['voucher_combo_flag'] = true;
                }
                else
                {
                    $data['promotion_items']['voucher_allow_flag'] = false;
                }

            }
            else
            {
                if(Web_ConfigModel::value('scarebuy_allow'))
                {
                    $data['promotion_items']['scarebuy_allow_flag'] = true;

                    //套餐状态是否可用
                    $scarebuyComboModel = new ScareBuy_QuotaModel();
                    $data['promotion_items']['scarebuy_combo_flag'] = $scarebuyComboModel->checkQuotaStateByShopId($shop_id);
                }
                else
                {
                    $data['promotion_items']['scarebuy_combo_flag'] = false;
                }

                //管理员后台促销功能开启
                if(Web_ConfigModel::value('promotion_allow'))
                {
                    $data['promotion_items']['promotion_allow_flag'] = true;

                    //加价购套餐状态
                    $increaseComboModel = new Increase_ComboModel();
                    $data['promotion_items']['promotion_increase_combo_flag'] = $increaseComboModel->checkQuotaStateByShopId($shop_id);

                    //限时折扣套餐状态
                    $discountQuotaModel = new Discount_QuotaModel();
                    $data['promotion_items']['promotion_discount_combo_flag'] = $discountQuotaModel->checkQuotaStateByShopId($shop_id);

                    //满送套餐状态
                    $manSongQuotaModel = new ManSong_QuotaModel();
                    $data['promotion_items']['promotion_mansong_combo_flag'] = $manSongQuotaModel->checkQuotaStateByShopId($shop_id);
                }
                else
                {
                    $data['promotion_items']['promotion_allow_flag'] = false;
                }

                //金蛋商城、金蛋兑换、代金券 同时开启，代金券功能才可用
                if(Web_ConfigModel::value('pointshop_isuse') && Web_ConfigModel::value('pointprod_isuse') && Web_ConfigModel::value('voucher_allow'))
                {
                    $data['promotion_items']['voucher_allow_flag'] = true;

                    //代金券套餐状态
                    $voucherQuotaModel = new Voucher_quotaModel();
                    $data['promotion_items']['voucher_combo_flag'] = $voucherQuotaModel->checkQuotaStateByShopId($shop_id);
                }
                else
                {
                    $data['promotion_items']['voucher_allow_flag'] = false;
                }
            }

            //平台联系方式
            $phone = Web_ConfigModel::value("setting_phone");
            if ($phone)
            {
                $phone = explode(',', $phone);
            }
            $email = Web_ConfigModel::value("setting_email");

            //当前商品数量统计
            $Goods_CommonModel = new Goods_CommonModel();
            $goods_state_normal_num   = $Goods_CommonModel->getCommonStateNum($shop_id, Goods_CommonModel::GOODS_STATE_NORMAL,Goods_CommonModel::GOODS_VERIFY_ALLOW);
            $goods_state_offline_num  = $Goods_CommonModel->getCommonStateNum($shop_id, Goods_CommonModel::GOODS_STATE_OFFLINE);
            $goods_state_illegal_num  = $Goods_CommonModel->getCommonStateNum($shop_id, Goods_CommonModel::GOODS_STATE_ILLEGAL);
            $goods_verify_waiting_num = $Goods_CommonModel->getCommonVerifyNum($shop_id);
            if (!empty($shop_base['shop_grade_row']))
            {
                $shop_grade_goods_limit = $shop_base['shop_grade_row']['shop_grade_goods_limit'];
                $shop_grade_album_limit = $shop_base['shop_grade_row']['shop_grade_album_limit'];
            }
            else
            {
                $shop_grade_goods_limit = 0;
                $shop_grade_album_limit = 0;
            }

            $Upload_BaseModel = new Upload_BaseModel();
            $shop_album_num   = $Upload_BaseModel->getUploadNum($shop_id);


            //销量统计
            $start_date       = date("Y-m-d", strtotime("-30 days"));
            $start_today_date = date("Y-m-d");
            $start_yes_date   = date("Y-m-d", strtotime("-1 days"));
            $start_week_date  = date("Y-m-d", strtotime("-7 days"));

            $today = $this->shopBaseModel->getShopSales($shop_id,$start_today_date);
            $week = $this->shopBaseModel->getShopSales($shop_id,$start_week_date);
            $month = $this->shopBaseModel->getShopSales($shop_id,$start_date);

            $Analysis_ShopGeneralModel = new Analysis_ShopGeneralModel();
            $analysis_today_row        = $Analysis_ShopGeneralModel->getShop($shop_id, $start_today_date);
            $analysis_yes_row          = $Analysis_ShopGeneralModel->getShop($shop_id, $start_yes_date);
            $analysis_data_row         = $Analysis_ShopGeneralModel->getShop($shop_id, $start_date);

            //单品销量
            $shop_top_rows = $Analysis_ShopGeneralModel->getShopGoodsTop($shop_id, $start_date);

            //2.店铺信息
            $shop_detail = $this->shopBaseModel->getShopDetailData($this->shop_base);

            //公告信息
            $information = $this->informationBaseModel->getBaseAllList(array('information_type'=>1),array('information_add_time'=>'DESC'),1,12);

            if ('json' == $this->typ)
            {
                $this->data->addBody(-140, $data);
            }
            else
            {
                include $this->view->getView();
            }
        }
        else if($chain_id)
        {
            header("Location:" . YLB_Registry::get('url') . "?ctl=Chain_Goods&met=goods&typ=e");
        }
        else
        {
            header("Location:" . YLB_Registry::get('url') . "?ctl=Seller_Shop_Settled&met=index");
        }

	}

	public function cropperImageExample()
	{
		include $this->view->getView();
	}
    /*
     *
     * 重要提醒
     *
     * */
	public function  get_goods_row(){
        $data_time = date("Y-m-d",time());

        $cond_row['shop_id'] = Perm::$shopId;
        $cond_row['goods_is_recommend'] = 1;
        $cond_row['goods_is_shelves']   = 1;
        //获取推荐数
        $recommend_res = $this->goodsBaseModel->getRowCount($cond_row);
        $data['recommend'] = $recommend_res;

        //猜你喜欢
        $like_row['shop_id'] = Perm::$shopId;
        $like_row['like_state'] = 1;
        $like_res = $this->shopGoodsLikeModel->getRowCount($like_row);
        $data['like'] = $like_res;

        /*
         *
         * 即将续费
         *
         * */

        //手机专享
        $Price_QuotaModel = new Price_QuotaModel();
        $Price_row = $Price_QuotaModel->getPriceQuotaByShopID(Perm::$shopId);
        $price_end_time = 0;
        if($Price_row){
            $price_end_time = date("Y-m-d",strtotime($Price_row['combo_end_time']."-30 day")) <=$data_time ? true : false;
        }
        //惠抢购
        $ScareBuy_QuotaModel = new ScareBuy_QuotaModel();
        $ScareBuy_row = $ScareBuy_QuotaModel->getScareBuyQuotaByShopID(Perm::$shopId);
        $scarebuy_end_time = 0;
        if($ScareBuy_row){
            $scarebuy_end_time = date("Y-m-d",strtotime($ScareBuy_row['combo_endtime']."-30 day")) <=$data_time ? true : false;
        }
        //加价购
        $Increase_ComboModel = new Increase_ComboModel();
        $Increase_row = $Increase_ComboModel->getIncreaseComboByShopID(Perm::$shopId);
        $increase_end_time = 0;
        if ($Increase_row){
            $increase_end_time = date("Y-m-d",strtotime($Increase_row['combo_end_time']."-30 day")) <=$data_time ? true : false;
        }
        //限时折扣
        $Discount_QuotaModel = new Discount_QuotaModel();
        $Discount_row = $Discount_QuotaModel->getDiscountQuotaByShopID(Perm::$shopId);
        $discount_end_time = 0;
        if($Discount_row){
            $discount_end_time = date("Y-m-d",strtotime($Discount_row['combo_end_time']."-30 day")) <=$data_time ? true : false;
        }
        //满及送
        $ManSong_QuotaModel = new ManSong_QuotaModel();
        $ManSong_row = $ManSong_QuotaModel->getManSongQuotaByShopID(Perm::$shopId);
        $mansong_end_time = 0;
        if($ManSong_row){
            $mansong_end_time = date("Y-m-d",strtotime($ManSong_row['combo_end_time']."-30 day")) <= $data_time ? true : false;
        }
        //代金券
        $Voucher_quotaModel = new Voucher_quotaModel();
        $Voucher_row = $Voucher_quotaModel->getVoucherQuotaByShopID(Perm::$shopId);
        $voucher_end_time = 0;
        if($Voucher_row){
            $voucher_end_time = date("Y-m-d",strtotime($Voucher_row['combo_end_time']."-30 day")) <= $data_time ? true : false;
        }
        //优惠套餐
        $Bundling_QuotaModel = new Bundling_QuotaModel();
        $Bundling_row = $Bundling_QuotaModel->getBundlingQuotaByShopID(Perm::$shopId);
        $bundling_end_time = 0;
        if($Bundling_row){
            $bundling_end_time = date("Y-m-d",strtotime($Bundling_row['bundling_quota_endtime']."-30 day"))<=$data_time ? true : false;
        }
        //新人优惠
        $NewBuyer_QuotaModel = new NewBuyer_QuotaModel();
        $NewBuyer_row = $NewBuyer_QuotaModel->getNewBuyerQuotaByShopID(Perm::$shopId);
        $newbuyer_end_time = 0;
        if($NewBuyer_row){
            $newbuyer_end_time = date("Y-m-d",strtotime($NewBuyer_row['quota_endtime']."-30 day")) <= $data_time ? true : false;
        }
        $data['row_count'] = $price_end_time+$scarebuy_end_time+$increase_end_time+$discount_end_time+$mansong_end_time+$voucher_end_time+$bundling_end_time+$newbuyer_end_time;


        $this->data->addBody(-140,$data);
    }

    /*
     * 市场与竞争
     *
     * */
    public function  get_marketplace(){

        //昨天开始 昨天结束
        $order_yesterday_start=mktime(0,0,0,date('m'),date('d')-1,date('Y'));
        $order_yesterday_end=mktime(0,0,0,date('m'),date('d'),date('Y'))-1;
        //今天开始-结束日期
        $data_time_left = date('Y-m-d 00:00:00', time());
        $data_time_right = date('Y-m-d 23:59:59', time());

        //层级
        $shop_tier['payment_time:<='] = $data_time_left;
        $shop_tier['payment_time:>='] = date('Y-m-d H:i:s',strtotime('-30 day'));
        $shop_tier['shop_id'] = Perm::$shopId;

        //查询支付金额排名30天前
        $shop_tier_time = $this->Order_BaseModel->getStatistics('sum(order_payment_amount)as order_payment_amount',$shop_tier);
        $data['shop_tier'] = $shop_tier_time[0]['order_payment_amount'];

        $cond_row['shop_id'] = Perm::$shopId;
        $cond_row['shop_class_bind_enable'] = 2;
        //查询本店经营分类
	    $Class_Bind_row = $this->ClassBindModel->getClassBindWhere($cond_row);

        foreach ($Class_Bind_row as $key => $value){
            //分类查询
            $class_id[] = $value['product_class_id'];
            if ($value['product_class_id']) {
                $cat = $this->goodsCatModel->getCatChildId($value['product_class_id']);
            }
            $cat_row['cat_id:IN'] = $cat;
            $cat_row['common_state'] = 1;
            //查询销量最高
            $salenum_max[] = $this->goodsCommonModel->cat_num_row($cat_row);
        }

        $cat_salenum['shop_id'] = Perm::$shopId;
        $cat_salenum['common_state'] = 1 ;

        $salenum_cat_row = $this->goodsCommonModel->select_s('cat_pid,sum(common_salenum)as common_salenum',$cat_salenum,'cat_pid','common_salenum','DESC');
        //        //查询分类信息
        $cat_list =$this->goodsCatModel->getCat($salenum_cat_row[0]['cat_pid']);
        //返回最大销量分类名
        $data['cat_max_name'] = $cat_list[$salenum_cat_row[0]['cat_pid']]['cat_name'];

        //查询该分类下的子分类
        $shop_cat = $this->goodsCatModel->getCatChildId($salenum_cat_row[0]['cat_pid']);
        $shop_cat_row['goods_class_id:IN'] = $shop_cat;
        //按店铺区分
        $group = 'shop_id';
        $order_row = 'salenum';

        //当日与七天前
        $shop_cat_row['order_goods_time:<='] = $data_time_left;
        $shop_cat_row['order_goods_time:>='] = date('Y-m-d H:i:s',strtotime('-7 day'));
        //订单状态完成
        $shop_cat_row['order_goods_status'] = 6;
        //按店铺分组 查每个店铺分类销量
        $shop_salenum_max = $this->Order_GoodsModel->selectGoods('shop_id,sum(order_goods_num) as salenum',$shop_cat_row,$group,$order_row);

        //取前3个
        $shop_salenum_max_row = array_slice($shop_salenum_max,0,3);
        //查询店铺名字
        foreach ($shop_salenum_max_row as $key => $value){
            $shop_row = $this->shopBaseModel->getShopDetail($value['shop_id']);
           $shop_salenum_max_row[$key]['shop_name'] = $shop_row['shop_name'];
        }
        //返回店铺名字
        $data['shop_salenum_max'] = $shop_salenum_max_row;
        /*
         *
         * 30天支付金额排名
         *
         * */
        //当前日期-》30天前 此时此刻
        $shop_account['payment_time:<='] = $data_time_left;
        $shop_account['payment_time:>='] = date('Y-m-d H:i:s',strtotime('-30 day'));

        //查询支付金额排名30天前
        $shop_account_time = $this->Order_BaseModel->getStatistics('shop_id,sum(order_payment_amount)as order_payment_amount',$shop_account,'shop_id','order_payment_amount');

        $data['shop_account_month_row'] = $this->eachrow($shop_account_time);


        $shop_account_date['payment_time:>='] = $data_time_left;
        $shop_account_date['payment_time:<='] = $data_time_right;
        //查询今天金额排名
        $shop_account_date_time = $this->Order_BaseModel->getStatistics('shop_id,sum(order_payment_amount)as order_payment_amount',$shop_account_date,'shop_id','order_payment_amount');
        $shop_account_date_row = $this->eachrow($shop_account_date_time);


        $shop_account_yesterday_time['payment_time:>='] = date('Y-m-d 00:00:00',$order_yesterday_start);
        $shop_account_yesterday_time['payment_time:<='] =date('Y-m-d 23:59:59',$order_yesterday_end);
        //查询昨天金额排名
        $shop_account_yesterday_time = $this->Order_BaseModel->getStatistics('shop_id,sum(order_payment_amount)as order_payment_amount',$shop_account_yesterday_time,'shop_id','order_payment_amount');
        $shop_account_yesterday_row = $this->eachrow($shop_account_yesterday_time);

        //1->10  今天小于昨天-》上升(下标越小排名越大)
        if($shop_account_date_row<$shop_account_yesterday_row){
            //昨天-今天=上升名次
            $data['order_account_list'] = $shop_account_yesterday_row - $shop_account_date_row;
            $data['order_account_list_status'] = 1;
            //10->1 今天大于昨天-> 下降(下标越大排名越小)
        }elseif ($shop_account_date_row>$shop_account_yesterday_row){
            //今天-昨天=下降
            $data['order_account_list'] = $shop_account_date_row - $shop_account_yesterday_row;
            $data['order_account_list_status'] = 2;
            //10->10 今天等于昨天-> 原来位置
        }elseif($shop_account_date_row==$shop_account_yesterday_row){
            $data['order_account_list'] = 0;
            $data['order_account_list_status'] = 1;
        }
        /* 流失金额
         * */

        $shop_cand_row['order_create_time:>='] = $data_time_left;//当天开始时间
        $shop_cand_row['order_create_time:<='] = $data_time_right;//当天结束时间
        $shop_cand_row['order_status'] = 1;
        $shop_cand_row['shop_id'] = Perm::$shopId;
        //查询当天未支付订单
        $order_status_row = $this->Order_BaseModel->getByWhere($shop_cand_row);
        if($order_status_row){
            foreach ($order_status_row as $key => $value){
                $data['shop_order_money'] += $value['order_payment_amount'];
            }
        }else{
            $data['shop_order_money'] = 0;
        }
        /*
         *
         * 查询平台当天全部未支付订单 进行排序 按店铺排序
         *
         * */
        $order_time_row = $this->Order_BaseModel->getStatistics('shop_id,sum(order_payment_amount)as order_payment_amount',array('order_status'=>1,'order_create_time:>='=>$data_time_left,'order_create_time:<='=>$data_time_right),'shop_id','order_payment_amount');

        $shop_id_row = $this->eachrow($order_time_row);

        /*
         * 昨天未支付  流失金额
         *查询平台昨天全部未支付订单 进行排序 按店铺排序
         * */

        $shop_yesterday_cond_row['order_create_time:>='] = date('Y-m-d 00:00:00',$order_yesterday_start);
        $shop_yesterday_cond_row['order_create_time:<='] =date('Y-m-d 23:59:59',$order_yesterday_end);
        $shop_yesterday_cond_row['order_status'] = 1;

        $order_yesterday_row = $this->Order_BaseModel->getStatistics('shop_id,sum(order_payment_amount)as order_payment_amount',$shop_yesterday_cond_row,'shop_id','order_payment_amount');

        $shop_id_rows = $this->eachrow($order_yesterday_row);

       //1->10  今天小于昨天-》上升(下标越小排名越大)
        if($shop_id_row<$shop_id_rows){
            //昨天-今天=上升名次
            $data['order_payment_amount_list'] = $shop_id_rows - $shop_id_row;
            $data['order_payment_amount_list_status'] = 1;
       //10->1 今天大于昨天-> 下降(下标越大排名越小)
        }elseif ($shop_id_row>$shop_id_rows){
            //今天-昨天=下降
            $data['order_payment_amount_list'] = $shop_id_row - $shop_id_rows;
            $data['order_payment_amount_list_status'] = 2;
            //10->10 今天等于昨天-> 原来位置
        }elseif($shop_id_row==$shop_id_rows){
            $data['order_payment_amount_list'] = 0;
            $data['order_payment_amount_list_status'] = 1;
        }

        $this->data->addBody(-140,$data);
    }
    /*
     *
     * 取下标
     *
     * */
    public  function  eachrow($row){
        $newarr = array();
        //下标按1开始
        foreach($row as $key=>$val){
            $newarr[$key+1]=$val;
        }
        //取出本店排名下标 排名
        foreach ($newarr as $key =>$value){
            if ($value['shop_id']== Perm::$shopId){
                $shop_id_rows = $key;
            }
        }
        return $shop_id_rows;
    }

    /*
     * 实时数据
     *
     * */
    public function  get_real_time(){
        //今天开始-结束日期
        $data_time_left = date('Y-m-d 00:00:00', time());
        $data_time_right = date('Y-m-d 23:59:59', time());
        /*   昨天    */
        /*  order_payment  支付金额
         *  order_count   支付买家数
         * order_list   支付订单数
         *
        */
        $order_yesterday_start = mktime(0,0,0,date('m'),date('d')-1,date('Y'));
        $order_yesterday_end = mktime(0,0,0,date('m'),date('d'),date('Y'))-1;
        $data_foot_yesterday = date("Y-m-d",strtotime("-1 day"));
        $data_foot_today = date("Y-m-d",time());

        $shop_yesterday_cond_row['payment_time:>='] = date('Y-m-d 00:00:00',$order_yesterday_start);
        $shop_yesterday_cond_row['payment_time:<='] = date('Y-m-d 23:59:59',$order_yesterday_end);
//        $shop_yesterday_cond_row['order_status'] = 2;
        $shop_yesterday_cond_row['shop_id'] = Perm::$shopId;
        //查询当天支付订单
        $order_status_row_yesterday = $this->Order_BaseModel->getStatistics('sum(order_payment_amount)as order_payment_amount,count(distinct(buyer_user_id)) as order_user_count,count(order_id) as order_list',$shop_yesterday_cond_row);
        $data['order_status_row_yesterday'] = $order_status_row_yesterday[0];
        if(!$data['order_status_row_yesterday']['order_payment_amount']){
            $data['order_status_row_yesterday']['order_payment_amount'] = 0;
        }
        /*
         * 昨天--------------end
         * */
        //支付金额
        $shop_cand_row['payment_time:>='] = $data_time_left;//当天开始时间
        $shop_cand_row['payment_time:<='] = $data_time_right;//当天结束时间
//        $shop_cand_row['order_status'] = 2;
        $shop_cand_row['shop_id'] = Perm::$shopId;

        //查询当天支付订单
        $order_status_row = $this->Order_BaseModel->getStatistics('sum(order_payment_amount)as order_payment_amount,count(distinct(buyer_user_id)) as order_user_count,count(order_id) as order_list',$shop_cand_row);
        $data['order_status_row'] = $order_status_row[0];
        if(!$data['order_status_row']['order_payment_amount']){
            $data['order_status_row']['order_payment_amount'] = 0;
        }
        //用户浏览量
        $user_foot_date['shop_id'] = Perm::$shopId;
        $user_foot_date['footprint_time:>='] = $data_time_left;
        $user_foot_date['footprint_time:<='] = $data_time_right;
        $data['user_foot_date'] = $this->User_FootprintModel->getRowCount($user_foot_date);

        //昨天用户浏览量
        $user_foot_yesterday['shop_id'] = Perm::$shopId;
        $user_foot_yesterday['footprint_time:>='] = date('Y-m-d 00:00:00',$order_yesterday_start);
        $user_foot_yesterday['footprint_time:<='] = date('Y-m-d 23:59:59',$order_yesterday_end);
        $data['user_foot_yesterday'] = $this->User_FootprintModel->getRowCount($user_foot_yesterday);
        //用户访客数
        $user_flow_today = "select COUNT(DISTINCT user_id) from ylb_user_footprint where shop_id= ".Perm::$shopId." and footprint_time = '".$data_foot_today."'";
        $user_flow_tocount = $this->Order_BaseModel->selectSql($user_flow_today);
        $data['user_visitor_today'] = $user_flow_tocount[0]['COUNT(DISTINCT user_id)'];
        //昨日访客
        $user_flow_sql = "select COUNT(DISTINCT user_id) from ylb_user_footprint where shop_id= ".Perm::$shopId." and footprint_time = '".$data_foot_yesterday."'";
        $user_flow_count = $this->Order_BaseModel->selectSql($user_flow_sql);
        $data['user_visitor_yesterday'] = $user_flow_count[0]['COUNT(DISTINCT user_id)'];
//        访客上升/下降百分比
        if ($data['user_visitor_today'] >= $data['user_visitor_yesterday']){
        $scale = (($data['user_visitor_today']-$data['user_visitor_yesterday'])/$data['user_visitor_yesterday'])*100;
            $data['scale_absol'] = 1;
        }else{
            $scale = (($data['user_visitor_yesterday']-$data['user_visitor_today'])/$data['user_visitor_yesterday'])*100;
            $data['scale_absol'] = -1;
        }
        $data['scale'] = number_format($scale);
        $this->data->addBody(-140,$data);
    }

    /*
     *
     * 交易状况
     *
     * */
    public function  get_condition(){
        //今天开始-结束日期
        $data_time_left = date('Y-m-d 00:00:00', strtotime("-1 day"));
        $data_time_right = date('Y-m-d 23:59:59', strtotime("-1 day"));
        $data_foot_yesterday = date("Y-m-d",strtotime("-1 day"));
        $shop_row['order_create_time:>='] = $data_time_left;
        $shop_row['order_create_time:<='] = $data_time_right;
        $shop_row['shop_id'] = Perm::$shopId;

        //下单买家数 下单金额
        $shop_order_row = $this->Order_BaseModel->getStatistics('sum(order_payment_amount)as order_payment_amount,count(distinct(buyer_user_id)) as order_user_count',$shop_row);
        $shop_order_row = $shop_order_row[0];
        if(!$shop_order_row['order_payment_amount']){
            $shop_order_row['order_payment_amount'] = 0;
        }
        //赋值data
        //下单买家数
        $data['order_payment_amount'] = $shop_order_row['order_payment_amount'];
        //下单金额
        $data['order_user_count'] = $shop_order_row['order_user_count'];

        $shop_account['payment_time:>='] = $data_time_left;
        $shop_account['payment_time:<='] = $data_time_right;
        $shop_account['shop_id'] = Perm::$shopId;

        //支付买家数  支付金额
        $shop_account_row = $this->Order_BaseModel->getStatistics('sum(order_payment_amount)as account_payment_amount,count(distinct(buyer_user_id)) as account_user_count',$shop_account);
        $shop_account_row = $shop_account_row[0];
        if(!$shop_account_row['account_payment_amount']){
            $shop_account_row['account_payment_amount'] = 0;
        }
        //客单价
        $shop_account_row['per_account'] = round($shop_account_row['account_payment_amount']/$shop_account_row['account_user_count'],2);

        //赋值data
        //支付买家数
        $data['account_payment_amount'] = $shop_account_row['account_payment_amount'];
        //支付金额
        $data['account_user_count'] = $shop_account_row['account_user_count'];
        //客单价
        $data['per_account'] = $shop_account_row['per_account'];
        //下单转化率
        $user_flow_sql = "select COUNT(DISTINCT user_id) from ylb_user_footprint where shop_id= ".Perm::$shopId." and footprint_time = '".$data_foot_yesterday."'";
        $user_flow_count = $this->Order_BaseModel->selectSql($user_flow_sql);
        $user_yesterday = $user_flow_count[0]['COUNT(DISTINCT user_id)'];
        $order_total = $this->Order_BaseModel->getRowCount($shop_row);
        $data['order_conversion'] = number_format($order_total/$user_yesterday*100);
        //下单-支付转化率
        $order_pay = $this->Order_BaseModel->getRowCount($shop_account);
        $data['order_pay_conversion'] = number_format($order_pay/$order_total*100);
        //支付转化率
        $data['pay_conversion'] = number_format($order_pay/$user_yesterday*100);
        $this->data->addBody(-140,$data);
    }

    /**
     * 商家中心首页 纠纷数据
     * Zhenzh 20180823
     *
     * 以下数据时间点 取近30天内
     *
     * 1.1.1 本店退款纠纷率 = 本店退款纠纷数（申诉的）/本店总支付成交数(付了款的)
     * 1.1.2 主营类目均值   = 主营类目退款纠纷数（申诉的）/平台总退款纠纷数（申诉的）
     * 退款纠纷笔数：本店退款纠纷（申诉的）
     * 2.1.1 退货纠纷率   = 本店退货纠纷数（申诉的）/本店总支付成交数
     * 2.1.2 主营类目均值 = 主营类目退货纠纷数（申诉的）/平台总退货纠纷数（申诉的）
     * 退货纠纷单数：0
     *
     * 1.3.1 本店退款率   = 本店成功退款数/本店总支付成交数
     * 1.3.2 主营类目均值 = 主营类目退款数/平台总退款数
     * 纠纷笔数：
     * 2.3.1 本店退货率   = 本店成功退货数/本店总支付成交数
     * 2.3.2 主营类目均值 = 主营类目退货数/平台总退货数
     * 退货纠纷单数：3
     *
     * 1.4.1 本店品质退款率 = 本店品质退款数/本店总支付成交数
     * 1.4.2 主营类目均值   = 主营类目品质退款数/平台总品质退款数
     * 纠纷笔数：0
     * 2.4.1 本店品质退货率 = 本店品质退货数/本店总支付成交数
     * 2.4.2 主营类目均值   = 主营类目品质退货数/平台总品质退货数
     * 纠纷笔数：0
     *
     * 1.2.1 本店退款速度 = (本店退款申请--卖家同意时间差)/2天(172800s)/退款单数
     * 1.2.2 主营类目均值 = (主营类目退款申请--卖家同意时间差)/2天(172800s)/退款单数
     * 2.2.1 本店退货速度 = (本店退货申请--卖家同意时间差)/7天/退货单数
     * 2.2.2 主营类目均值 = (主营类目退货申请--卖家同意时间差)/7天/退货单数
     */
    public function getDispute()
    {
        if ($this->shop_base) {
            $shop_id       = $this->shop_base['shop_id'];//店铺id
            $shop_class_id = $this->shop_base['shop_class_id'];//主营类目id
            $time          = date('Y-m-d H:i:s', strtotime("-30 days"));//30天内的时间起点
            $order_base    = TABEL_PREFIX . 'order_base';//订单表名
            $order_return  = TABEL_PREFIX . 'order_return';//退款/退货表名
            $complain_base = TABEL_PREFIX . 'complain_base';//投诉表名

            $OrderReturnModel = new Order_ReturnModel();

            $shop_platform_refund_count  = 0;//本店退款纠纷数
            $shop_platform_return_count  = 0;//本店退货纠纷数
            $shop_success_refund_count   = 0;//本店成功退款数
            $shop_success_return_count   = 0;//本店成功退货数
            $shop_quality_refund_count   = 0;//本店品质退款数
            $shop_quality_return_count   = 0;//本店品质退货数
            $class_platform_refund_count = 0;//主营类目退款纠纷数
            $class_platform_return_count = 0;//主营类目退货纠纷数
            $class_refund_count          = 0;//主营类目退款数
            $class_return_count          = 0;//主营类目退货数
            $class_quality_refund_count  = 0;//主营类目品质退款数
            $class_quality_return_count  = 0;//主营类目品质退货数
            $all_platform_refund_count   = 0;//平台总退款纠纷
            $all_platform_return_count   = 0;//平台总退货纠纷
            $all_refund_count            = 0;//平台总退款数
            $all_return_count            = 0;//平台总退货数
            $all_quality_refund_count    = 0;//平台总品质退款数
            $all_quality_return_count    = 0;//平台总品质退货数
            $shop_refund_speed           = 0;//本店退款速度
            $shop_return_speed           = 0;//主营类目退款均值
            $class_refund_speed          = 0;//本店退货速度
            $class_return_speed          = 0;//主营类目退货均值

            //获取 本店总支付成交数
            $sql = "SELECT COUNT(*) c FROM $order_base WHERE shop_id = $shop_id AND order_type <> 1 AND order_status > 1 AND payment_time >= '$time'";
            $shop_order_count = $OrderReturnModel->selectCountSql($sql);

            //获取 本店 退款/退货纠纷数 成功退款/退货数 品质退款/退货数
            $sql = "SELECT return_type,return_shop_state,return_platform_state,return_recheck_state,return_collect_state,return_reason_id,COUNT(*) c "
                . "FROM $order_return WHERE shop_id = $shop_id AND payment_time >= '$time' "
                . "GROUP BY return_type,return_shop_state,return_platform_state,return_recheck_state,return_collect_state,return_reason_id";
            $data = $OrderReturnModel->selectSql($sql);
            foreach ($data as $key => $value) {
                if ($value['return_type'] == 1) {
                    //退款纠纷 申诉的
                    if ($value['return_platform_state'] > 0 || $value['return_recheck_state'] > 0)
                        $shop_platform_refund_count += $value['c'];
                    //退款成功的
                    if ($value['return_shop_state'] == 4 || $value['return_platform_state'] == 2 OR $value['return_recheck_state'] == 2)
                        $shop_success_refund_count += $value['c'];
                    //品质退款的
                    if ($value['return_reason_id'] == 3)
                        $shop_quality_refund_count += $value['c'];
                } else if ($value['return_type'] == 2) {
                    //退货纠纷 申诉的
                    if ($value['return_platform_state'] > 0 || $value['return_recheck_state'] > 0)
                        $shop_platform_return_count += $value['c'];
                    //退货成功
                    if ($value['return_recheck_state'] == 2 OR $value['return_collect_state'] == 2)
                        $shop_success_return_count += $value['c'];
                    //品质退货
                    if ($value['return_reason_id'] == 3)
                        $shop_quality_return_count += $value['c'];
                }
            }

            //获取 主营类目 退款/退货纠纷数 退款/退货数 品质退款/退货数
            $sql = "SELECT return_type,return_platform_state,return_recheck_state,return_reason_id,COUNT(*) c "
                . "FROM $order_return WHERE shop_class_id = $shop_class_id AND payment_time >= '$time' "
                . "GROUP BY return_type,return_platform_state,return_recheck_state,return_reason_id";
            $data = $OrderReturnModel->selectSql($sql);
            foreach ($data as $key => $value) {
                if ($value['return_type'] == 1) {
                    $class_refund_count += $value['c'];
                    //退款纠纷 申诉的
                    if ($value['return_platform_state'] > 0 || $value['return_recheck_state'] > 0)
                        $class_platform_refund_count += $value['c'];
                    //品质退款的
                    if ($value['return_reason_id'] == 3)
                        $class_quality_refund_count += $value['c'];
                } else if ($value['return_type'] == 2) {
                    $class_return_count += $value['c'];
                    //退货纠纷 申诉的
                    if ($value['return_platform_state'] > 0 || $value['return_recheck_state'] > 0)
                        $class_platform_return_count += $value['c'];
                    //品质退货
                    if ($value['return_reason_id'] == 3)
                        $class_quality_return_count += $value['c'];
                }
            }

            //获取 总平台 退款/退货纠纷数 退款/退货数 品质退款/退货数
            $sql = "SELECT return_type,return_platform_state,return_recheck_state,return_reason_id,COUNT(*) c "
                . "FROM $order_return WHERE payment_time >= '$time' "
                . "GROUP BY return_type,return_platform_state,return_recheck_state,return_reason_id";
            $data = $OrderReturnModel->selectSql($sql);
            foreach ($data as $key => $value) {
                if ($value['return_type'] == 1) {
                    $all_refund_count += $value['c'];
                    //退款纠纷 申诉的
                    if ($value['return_platform_state'] > 0 || $value['return_recheck_state'] > 0)
                        $all_platform_refund_count += $value['c'];
                    //品质退款的
                    if ($value['return_reason_id'] == 3)
                        $all_quality_refund_count += $value['c'];
                } else if ($value['return_type'] == 2) {
                    $all_return_count += $value['c'];
                    //退货纠纷 申诉的
                    if ($value['return_platform_state'] > 0 || $value['return_recheck_state'] > 0)
                        $all_platform_return_count += $value['c'];
                    //品质退货
                    if ($value['return_reason_id'] == 3)
                        $all_quality_return_count += $value['c'];
                }
            }

            //获取 本店退款速度 本店退货速度
            //$sql = "SELECT return_type,CASE WHEN return_type = 1 THEN SUM(TIMESTAMPDIFF(SECOND,return_add_time,return_shop_time))/COUNT(*)/172800 WHEN return_type = 2 THEN SUM(TIMESTAMPDIFF(SECOND,return_add_time,return_shop_time))/COUNT(*)/604800 END t FROM $order_return WHERE (return_shop_state = 4 OR return_shop_state = 2) AND shop_class_id = $shop_class_id AND payment_time >= '$time' GROUP BY return_type"
            $sql = "SELECT return_type,SUM(TIMESTAMPDIFF(SECOND,return_add_time,return_shop_time))/COUNT(*) s FROM $order_return WHERE (return_shop_state = 4 OR return_shop_state = 2) AND shop_id = $shop_id AND payment_time >= '$time' GROUP BY return_type";
            $data = $OrderReturnModel->selectSql($sql);
            foreach ($data as $key => $value) {
                if ($value['return_type'] == 1) {
                    $shop_refund_speed = $value['s'] / 172800;
                } else if ($value['return_type'] == 2) {
                    $shop_return_speed = $value['s'] / 604800;
                }
            }
            //获取 主营类目退款均值 主营类目退货均值
            $sql = "SELECT return_type,SUM(TIMESTAMPDIFF(SECOND,return_add_time,return_shop_time))/COUNT(*) s FROM $order_return WHERE (return_shop_state = 4 OR return_shop_state = 2) AND shop_class_id = $shop_class_id AND payment_time >= '$time' GROUP BY return_type";
            $data = $OrderReturnModel->selectSql($sql);
            foreach ($data as $key => $value) {
                if ($value['return_type'] == 1) {
                    $class_refund_speed = $value['s'] / 172800;
                } else if ($value['return_type'] == 2) {
                    $class_return_speed = $value['s'] / 604800;
                }
            }

            /**
             * 投诉率 = 本店投诉笔数/平台总投诉笔数
             */
            $sql = "SELECT COUNT(*) c FROM $complain_base WHERE user_id_accused = $shop_id AND payment_time >= '$time'";
            $shop_complain_count = $OrderReturnModel->selectCountSql($sql);
            $sql = "SELECT COUNT(*) c FROM $complain_base WHERE payment_time >= '$time'";
            $all_complain_count = $OrderReturnModel->selectCountSql($sql);

            $shop_platform_refund_rate  = number_format($shop_platform_refund_count * 100 / $shop_order_count, 4, '.', '') . '%';
            $shop_platform_return_rate  = number_format($shop_platform_return_count * 100 / $shop_order_count, 4, '.', '') . '%';
            $class_platform_refund_rate = number_format($class_platform_refund_count * 100 / $all_platform_refund_count, 4, '.', '') . '%';
            $class_platform_return_rate = number_format($class_platform_return_count * 100 / $all_platform_return_count, 4, '.', '') . '%';
            $shop_success_refund_rate   = number_format($shop_success_refund_count * 100 / $shop_order_count, 4, '.', '') . '%';
            $shop_success_return_rate   = number_format($shop_success_return_count * 100 / $shop_order_count, 4, '.', '') . '%';
            $class_refund_rate          = number_format($class_refund_count * 100 / $all_refund_count, 4, '.', '') . '%';
            $class_return_rate          = number_format($class_return_count * 100 / $all_return_count, 4, '.', '') . '%';
            $shop_quality_refund_rate   = number_format($shop_quality_refund_count * 100 / $shop_order_count, 4, '.', '') . '%';
            $shop_quality_return_rate   = number_format($shop_quality_return_count * 100 / $shop_order_count, 4, '.', '') . '%';
            $class_quality_refund_rate  = number_format($class_quality_refund_count * 100 / $all_quality_refund_count, 4, '.', '') . '%';
            $class_quality_return_rate  = number_format($class_quality_return_count * 100 / $all_quality_return_count, 4, '.', '') . '%';
            $shop_refund_speed          = number_format($shop_refund_speed,1,'.','');
            $class_refund_speed         = number_format($class_refund_speed,1,'.','');
            $shop_return_speed          = number_format($shop_return_speed,1,'.','');
            $class_return_speed         = number_format($class_return_speed,1,'.','');
            $shop_complain_rate         = number_format($shop_complain_count * 100/$all_complain_count,4,'.','') . '%';

            $data                               = [];
            $data['shop_platform_refund_rate']  = $shop_platform_refund_rate;
            $data['class_platform_refund_rate'] = $class_platform_refund_rate;
            $data['shop_platform_refund_count'] = $shop_platform_refund_count;
            $data['shop_refund_speed']          = $shop_refund_speed;
            $data['class_refund_speed']         = $class_refund_speed;
            $data['shop_success_refund_rate']   = $shop_success_refund_rate;
            $data['class_refund_rate']          = $class_refund_rate;
            $data['shop_quality_refund_rate']   = $shop_quality_refund_rate;
            $data['class_quality_refund_rate']  = $class_quality_refund_rate;
            $data['shop_complain_rate']         = $shop_complain_rate;
            $data['shop_platform_return_rate']  = $shop_platform_return_rate;
            $data['class_platform_return_rate'] = $class_platform_return_rate;
            $data['shop_platform_return_count'] = $shop_platform_return_count;
            $data['shop_return_speed']          = $shop_return_speed;
            $data['class_return_speed']         = $class_return_speed;
            $data['shop_success_return_rate']   = $shop_success_return_rate;
            $data['class_return_rate']          = $class_return_rate;
            $data['shop_quality_return_rate']   = $shop_quality_return_rate;
            $data['class_quality_return_rate']  = $class_quality_return_rate;
        } else {
            $data = [];
        }

        $this->data->addBody(-140,$data);
    }


    /**
     *20180910  JiaXL
     *商家中心页 重点诊断
     */
    function get_diagnosis()
    {

        $data =array();
        if( Perm::$shopId )
        {
            //流量波动 最近七天 and 上个七天
            $date_sevenDays = date("Y-m-d",strtotime("-7 day"));
            $pre_sevenDays  = date("Y-m-d",strtotime("-14 day"));

            $seven_cond_row['footprint_time:>']     = $date_sevenDays;
            $sevenCount                             =  $this->User_FootprintModel->getByWhere( $seven_cond_row );
            $sevenCount = count( array_unique( array_column( $sevenCount, 'user_id' ) ) );

            $pre_seven_cond_row['footprint_time:<'] = $date_sevenDays;
            $pre_seven_cond_row['footprint_time:>'] = $pre_sevenDays;
            $pre_sevenCount                         = $this->User_FootprintModel->getRowCount( $pre_seven_cond_row );
            $pre_sevenCount = count( array_unique( array_column( $pre_sevenCount, 'user_id' ) ) );
            $data['l_Liang']['sevenCount'] = $sevenCount;

            if( $sevenCount >= $pre_sevenCount )
            {
                $data['l_Liang']['tip'] = _('上涨');
                if( $pre_sevenCount == 0 )
                {
                    $data['l_Liang']['num'] = 100;
                }
                else
                {
                    $num                    = ($sevenCount-$pre_sevenCount)/$pre_sevenCount ;
                    $data['l_Liang']['num'] = sprintf('%.2F',$num)*100;
                }
            }
            else
            {
                $data['l_Liang']['tip'] = _('下跌');
                $num                    =  ($pre_sevenCount-$sevenCount)/$pre_sevenCount ;
                $data['l_Liang']['num'] =  sprintf("%.2f", $num)*100;
            }

            //访客特征  暂时做不了

            //交易转化
            $s_cond_row['shop_id']          = Perm::$shopId;
            $s_cond_row['goods_is_shelves'] = Goods_BaseModel::GOODS_UP;
            $goods_num                      = $this->goodsBaseModel->getRowCount( $s_cond_row );
            if( $goods_num > 0 )
            {
                $main_goods_num                 =  ceil( $goods_num * 0.3 );
                $s_order_row['goods_salenum']   = 'DESC';
                $main_goods                     = $this->goodsBaseModel->getBaseList( $s_cond_row, $s_order_row, 1, $main_goods_num )['items'];
                $main_goods_cid                 = array_column( $main_goods, 'common_id' );
                $f_cond_row['shop_id']          = Perm::$shopId;
                $f_cond_row['common_id:IN']     = $main_goods_cid;
                $f_main_num                     = $this->User_FootprintModel->getByWhere( $f_cond_row );
                $f_main_num                     = count( array_unique( array_column( $f_main_num, 'user_id' ) ) );

                //看了主力宝贝,下订单并完成交易的数量
                $o_cond_row['shop_id']                  = Perm::$shopId;
                $o_cond_row['common_id:IN']             = $main_goods_cid;
                $o_cond_row['order_goods_status']       = Order_StateModel::ORDER_FINISH;
                $o_data                                 = $this->Order_GoodsModel->getByWhere( $o_cond_row );
                $order_count                            = count( array_unique( array_column( $o_data ,'buyer_user_id' ) ) );
                $z_num                                  = ( $f_main_num - $order_count )/$f_main_num;
                $data['z_hua']['num']                   = sprintf('%.2f',$z_num )*100;
            }
            //异常商品26315
            $goods_data                     = $this->goodsBaseModel->getByWhere( $s_cond_row );
            $cond_row['shop_id']            = Perm::$shopId;
            foreach( $goods_data as $key => $val )
            {
                //七天浏览量
                $cond_row['common_id']          = $val['common_id'];
                $cond_row['footprint_time:>']   = $date_sevenDays;
                $goods_sevenCount               =  $this->User_FootprintModel->getByWhere( $cond_row );
                $goods_sevenCount               =  count( array_unique( array_column( $goods_sevenCount, 'user_id' ) ) );
                $arr[] = $goods_sevenCount;
                //上个七天浏览量
                $cond_row_pre['common_id']         = $val['common_id'];
                $cond_row_pre['footprint_time:<='] = $date_sevenDays;
                $cond_row_pre['footprint_time:>']  = $pre_sevenDays;
                $pre_goods_sevenCount              = $this->User_FootprintModel->getRowCount( $cond_row_pre );
                $pre_goods_sevenCount              = count( array_unique( array_column( $pre_goods_sevenCount, 'user_id' ) ) );
                if( $goods_sevenCount < $pre_goods_sevenCount )
                {
                    $lv_num     = ( $pre_goods_sevenCount - $goods_sevenCount )/$pre_goods_sevenCount;
                    $down_num   = sprintf('%.2f',$lv_num )*100;
                    if( $down_num >= 50 )
                    {
                        $down_goods[] = $down_num;
                    }
                }
            }
            $data['y_goods']['num'] = count( $down_goods );
            $msg                    = _('success');
            $status                 = 200;
        }
        else
        {
            $msg                    = _('无商店信息');
            $status                 = 250;
        }
        if($this->typ=='json')
        {
            $this->data->addBody( -140, $data, $msg, $status );
        }
    }

}

?>