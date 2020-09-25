<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Shop_IndexCtl extends Controller
{
	public $shopBaseModel = null;
	public $goodsCommonModel    = null;
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
		$this->goodsCommonModel    = new Goods_CommonModel();

		/*$this->web = $this->webConfig();
		$this->nav = $this->navIndex();
		$this->cat = $this->catIndex();*/
	}

	/**
	 * 首页
	 *
	 * @access public
	 */
	public function index()
	{
		$this->initData();
		$cond_row = array();
		$cond_row['shop_status'] = Shop_BaseModel::SHOP_STATUS_OPEN;

		if(request_string('or')=='collect')
		{
			$order_row['shop_collect'] = 'DESC';
		}else{
			$order_row['shop_create_time'] = 'DESC';
		}

		if(request_string('district'))
		{
			$Shop_CompanyModel = new Shop_CompanyModel();
			$shop_row['shop_company_address:LIKE'] = '%'.request_string('district').'%';
			$shops = $Shop_CompanyModel->getByWhere($shop_row);
			$shop_ids = array_column($shops,'shop_id');

			$cond_row['shop_id:in'] = $shop_ids;
		}

		if(request_string('keywords'))
		{
			$cond_row['shop_name:LIKE'] = '%'.request_string('keywords').'%';
		}

		if(request_int('plat'))
		{
			$cond_row['shop_self_support'] ='true';
		}

        if(request_int('plat2'))
        {
            if(request_int('plat'))
            {
                unset($cond_row['shop_self_support']);
            }
            else
            {
                $cond_row['shop_self_support'] ='false';
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

		$cond_row['shop_type'] = 1;   //卖家店铺

		$YLB_Page           = new YLB_Page();
		$YLB_Page->listRows = 10;
		$rows              = $YLB_Page->listRows;
		$offset            = request_int('firstRow', 0);
		$page              = ceil_r($offset / $rows);

		$data = $this->shopBaseModel->getBaseList($cond_row,$order_row,$page,$rows);

		if(!empty($data['items']))
		{
			foreach($data['items'] as $key=>$val)
			{
				//获取店铺评分信息
                $data['items'][$key]['shop_detail'] = $this->shopBaseModel->getShopDetailData($val);

				//获取店铺推荐商品
				$goods_recommended = $this->goodsCommonModel->getGoodsListII(array("shop_id" => $val['shop_id'],"common_is_recommend" => 2,"common_state" => 1,'common_verify' =>1),array('common_salenum'=>'DESC'), 1,5);
				//如果店铺没有推荐商品则获取商品销量的前5件有效商品
				if(!$goods_recommended['items'])
				{
					$goods_recommended = $this->goodsCommonModel->getGoodsListII(array("shop_id" => $val['shop_id'],"common_state" => 1,'common_verify' =>1),array('common_sell_time'=>'DESC'), 1,5);
				}

				if($goods_recommended['items'])
                {
                    $data['items'][$key]['goods_recommended']['items'] = array_values($goods_recommended['items']);
                }

                //店铺商品数量
                $cond_rec_goods['shop_id'] = $val['shop_id'];
                $cond_rec_goods['common_state'] = Goods_CommonModel::GOODS_STATE_NORMAL;
				$goods_common_count = $this->goodsCommonModel->getRowCount($cond_rec_goods);
				$data['items'][$key]['goods_num'] = $goods_common_count;
			}
		}

		$YLB_Page->totalRows = $data['totalsize'];
		$page_nav           = $YLB_Page->prompt();

		$district = new Base_DistrictModel();
		$district_data = $district->getDistrictTree(0);

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
     * 首页
     *
     * @access public
     */
    public function near()
    {
        $this->initData();

        $YLB_Page           = new YLB_Page();
        $YLB_Page->listRows = 10;
        $rows              = $YLB_Page->listRows;
        $offset            = request_int('firstRow', 0);
        $page              = ceil_r($offset / $rows);

        $coordinate = request_row('coordinate');

        $lat = $coordinate['lat'];
        $lng = $coordinate['lng'];

        $data = $this->shopBaseModel->getNearShop($lat, $lng, 20000, $page, $rows);

        if(!empty($data['items']))
        {
            foreach($data['items'] as $key=>$val)
            {
                //获取店铺评分信息
                $data['items'][$key]['shop_detail']    = $this->shopBaseModel->getShopDetail($val['shop_id']);

                //获取店铺推荐商品
                $data['items'][$key]['goods_recommended'] = $this->goodsCommonModel->getGoodsList(array("shop_id" => $val['shop_id'],"common_is_recommend" => 2,"common_state" => 1,'common_verify' =>1),array('common_salenum'=>'DESC'), 1,4);

                $condi_rec_goods['shop_id'] 			= $val['shop_id'];
                $condi_rec_goods['common_state'] 		= Goods_CommonModel::GOODS_STATE_NORMAL;
                $goods_common_list = $this->goodsCommonModel->getbywhere( $condi_rec_goods );
                //店铺商品数量
                $data['items'][$key]['goods_num'] = count($goods_common_list);
            }
        }

        if ('json' == $this->typ)
        {
            $this->data->addBody(-140, $data);

        }
        else
        {
            $YLB_Page->totalRows = $data['totalsize'];
            $page_nav           = $YLB_Page->prompt();

            $district = new Base_DistrictModel();
            $district_data = $district->getDistrictTree(0);


            include $this->view->getView();
        }
    }
}
?>