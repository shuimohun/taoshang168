<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     Zhenzh 新人优惠
 */
class NewBuyerCtl extends Controller
{
	public $newBuyerBaseModel       = null;
	public $newBuyerQuotaModel      = null;


	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);
        $this->initData();

		if (!Web_ConfigModel::value('promotion_allow'))
		{
            $this->showMsg("优惠活动功能已经关闭!");
		}

		$this->newBuyerBaseModel       = new NewBuyer_BaseModel();
		$this->newBuyerQuotaModel      = new NewBuyer_QuotaModel();
	}

	/**
	 * 新人优惠首页
	 *
	 * @access public
	 */
    public function index()
    {
        $type_id = request_int('type_id');
        $data         = array();

        $cond_row['newbuyer_state'] = NewBuyer_BaseModel::NORMAL;
        $cond_row['newbuyer_starttime:<'] = get_date_time();
        $cond_row['newbuyer_type'] = NewBuyer_BaseModel::GUANGAO;
        $order_cond['newbuyer_sort'] = 'ASC';
        $data['guanggao'] = $this->newBuyerBaseModel->getNewBuyerDetailByWhere($cond_row);
        if(!$data['guanggao'])
        {
            unset($data['guanggao']);
        }

        if($type_id && $type_id > 0 &&$type_id < 4)
        {
            $YLB_Page           = new YLB_Page();
            $YLB_Page->listRows = request_int('listRows')?request_int('listRows'):12;
            $rows              = $YLB_Page->listRows;
            $offset            = request_int('firstRow', 0);
            $page              = ceil_r($offset / $rows);

            $cond_row['newbuyer_type'] = $type_id;
            $data['list'] = $this->newBuyerBaseModel->getNewBuyerList($cond_row,$order_cond,$page,$rows);

            $YLB_Page->totalRows      = $data['list']['totalsize'];
            $page_nav                 = $YLB_Page->prompt();
        }
        else
        {
            $cond_row['newbuyer_type'] = NewBuyer_BaseModel::YIFEN;
            $data['yifen'] = $this->newBuyerBaseModel->getNewBuyerList($cond_row,$order_cond,1,15);

            $cond_row['newbuyer_type'] = NewBuyer_BaseModel::YIMAO;
            $data['yimao'] = $this->newBuyerBaseModel->getNewBuyerList($cond_row,$order_cond,1,15);

            $cond_row['newbuyer_type'] = NewBuyer_BaseModel::YIYUAN;
            $data['yiyuan'] = $this->newBuyerBaseModel->getNewBuyerList($cond_row,$order_cond,1,15);

        }

        if ('e' == $this->typ)
        {
            $title             = Web_ConfigModel::value("newbuyer_title");//首页名;
            $this->keyword     = Web_ConfigModel::value("newbuyer_keyword");//关键字;
            $this->description = Web_ConfigModel::value("newbuyer_description");//描述;
            $this->title       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $title);
            $this->keyword       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->keyword);
            $this->description       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->description);

            include $this->view->getView();
        }
        else
        {
            $this->data->addBody(-140, $data);
        }

    }

    //获取某个店铺的新人优惠商品  18/1/5  weidp
    public function getShopNewBuyerGoods(){
        $data = array();
        $shop_id = request_int('sid');
        $cond_row['newbuyer_state'] = NewBuyer_BaseModel::NORMAL;
        $cond_row['newbuyer_starttime:<'] = get_date_time();
        $cond_row['newbuyer_endtime:>='] = get_date_time();
        $order_cond['newbuyer_sort'] = 'ASC';
        if($shop_id){
             $cond_row['shop_id'] = $shop_id;
        }

        $YLB_Page           = new YLB_Page();
        $YLB_Page->listRows = request_int('listRows')?request_int('listRows'):12;
        $rows              = $YLB_Page->listRows;
        $offset            = request_int('firstRow', 0);
        $page              = ceil_r($offset / $rows);

        $data = $this->newBuyerBaseModel->getNewBuyerList($cond_row,$order_cond,$page,$rows);

        $YLB_Page->totalRows      = $data['list']['totalsize'];
        $page_nav                 = $YLB_Page->prompt();

        if($this->typ == 'json'){
            $this->data->addBody(-140,$data);
        }else{
            include $this->view->getView();
        }
    }

    public function getNewBuyerGoods()
    {
        $data = array();
        $goods_id = request_int('gid', request_int('goods_id'));
        $cond_row['goods_id'] = $goods_id;
        $cond_row['newbuyer_state'] = NewBuyer_BaseModel::NORMAL;
        $newbuyer_data = $this->newBuyerBaseModel->getOneByWhere($cond_row);

        if($newbuyer_data)
        {
            $goodsBaseModel = new Goods_BaseModel();
            $goods_base = $goodsBaseModel->getOne($goods_id);
            $newbuyer_data['goods_name']  = $goods_base['goods_name'];
            $newbuyer_data['goods_price'] = $goods_base['goods_price'];
            $newbuyer_data['goods_image'] = $goods_base['goods_image'];
            $newbuyer_data['shared_price'] = number_format($newbuyer_data['newbuyer_price'] - $goods_base['goods_share_price'],2,'.','');
            $data['items'][] = $newbuyer_data;
            $status = 200;
        }
        else
        {
            $status = 250;
        }

        if ('e' == $this->typ)
        {
            include $this->view->getView();
        }
        else
        {
            $this->data->addBody(-140, $data,'',$status);
        }
    }

    /**
     * 获取参与新人优惠的店铺 按店铺分类分组
     */
    public function getNewBuyerShop()
    {
        $data = array();
        $row = $this -> getNewBuyerShopRow();

        if($row)
        {
            $shop_id_row = implode(',', $row);
            $sql = 'SELECT a.shop_id,a.shop_name,a.shop_class_id,b.shop_class_name,a.shop_logo_wap FROM '.TABEL_PREFIX.'shop_base a,'.TABEL_PREFIX.'shop_class b WHERE a.shop_class_id = b.shop_class_id AND a.shop_id IN ('.$shop_id_row.') ';
            $GoodsCommonModel = new Goods_CommonModel();
            $shop_row = $GoodsCommonModel -> selectSql($sql);

            if($shop_row)
            {
                foreach ($shop_row as $key => $value)
                {
                    $shop['shop_id']   = $value['shop_id'];
                    $shop['shop_name'] = $value['shop_name'];
                    if(!isset($data[$value['shop_class_id']]))
                    {
                        $data[$value['shop_class_id']]['shop_class_name'] = $value['shop_class_name'];
                    }
                    $shop['shop_logo'] = $value['shop_logo_wap'];
                    $shop['d_of_s'] = '100';
                    $data[$value['shop_class_id']]['shop_list'][] = $shop;
                }
            }
        }
        $data = array_values($data);

        $this->data->addBody(-140,$data);
    }

    /**
     * 新人店铺列表页
     */
    public function shop()
    {
        $data     = array();
        $row = $this -> getNewBuyerShopRow();

        if($row)
        {
            $ShopBaseModel    = new Shop_BaseModel();
            $GoodsCommonModel = new Goods_CommonModel();
            $NewBuyerBaseModel = new NewBuyer_BaseModel();

            $data = $ShopBaseModel->getBase($row);

            if($data)
            {
                foreach ($data as $key => $value)
                {
                    $data[$key]['shop_detail'] = $ShopBaseModel->getShopDetailData($value);
                    $cond['shop_id'] = $value['shop_id'];
                    $cond['newbuyer_state'] = NewBuyer_BaseModel::NORMAL;
                    $cond['newbuyer_starttime:<'] = get_date_time();
                    $cond['newbuyer_endtime:>'] = get_date_time();
                    $goods_recommended = $NewBuyerBaseModel->getNewBuyerList($cond,array(),1,5);

                    if($goods_recommended['items'])
                    {
                        $data[$key]['goods_recommended'] = array_values($goods_recommended['items']);
                    }

                    //店铺商品数量
                    $cond_rec_goods['shop_id']      = $value['shop_id'];
                    $cond_rec_goods['common_state'] = Goods_CommonModel::GOODS_STATE_NORMAL;
                    $goods_common_count = $GoodsCommonModel->getRowCount($cond_rec_goods);
                    $data[$key]['goods_num'] = $goods_common_count;
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
     * 获取正常状态下的新人店铺id
     * @return array
     */
    public function getNewBuyerShopRow()
    {
        $data = array();

        $NewBuyerBaseModel = new NewBuyer_BaseModel();
        $cond_row['newbuyer_state']       = NewBuyer_BaseModel::NORMAL;
        $cond_row['newbuyer_starttime:<'] = get_date_time();
        $cond_row['newbuyer_endtime:>']   = get_date_time();
        $row = $NewBuyerBaseModel ->select('shop_id',$cond_row,'shop_id');
        if($row)
        {
            $data = array_unique(array_column($row,'shop_id'));
        }

        return $data;
    }
}

?>
