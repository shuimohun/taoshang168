<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     windfnn
 */
class Distribution_Buyer_GoodsCtl extends Buyer_Controller
{
	public $directseller_model = null;
	public $directseller_goodsModel = null;
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
		$this->directseller_model = new Distribution_ShopDirectsellerModel();
		$this->directseller_goodsModel = new Distribution_ShopDirectsellerGoodsCommonModel();
	}

	/**
	 * 首页
	 *
	 * @access public
	 */
    public function index()
    {
        //获取推广店铺的ID
        $cond_row['directseller_id'] = Perm::$userId;
        $cond_row['directseller_enable'] = 1;
        $shops = $this->directseller_model->getByWhere($cond_row);
        $shop_ids = array_column($shops,'shop_id');

        $cond_good_row['shop_id:in'] = $shop_ids;
        $cond_good_row['common_is_directseller'] = 1;
        if(request_string('keywords'))
        {
            $cond_good_row['common_name:LIKE'] = '%'.request_string('keywords').'%'; //商品名称搜索
        }

        $YLB_Page = new YLB_Page();
        $page     = request_int('page',1);
        $rows     = request_int('rows',$YLB_Page->listRows);

        $act       = request_string('act');
        $actorder  = request_string('actorder','DESC');

        if ($act!=='')
        {
            //销量
            if ($act == 'sales')
            {
                $order_row['common_salenum'] = $actorder;
            }

            //佣金排序
            if ($act == 'commission')
            {
                if($actorder)
                {
                    $order_row['common_promotion_price'] = $actorder;
                }
                else
                {
                    $order_row['common_promotion_price'] = 'ASC';
                }
            }

            //时间排序
            if ($act == 'uptime')
            {
                $order_row['common_add_time'] = $actorder;
            }

            //收藏排序
            if ($act == 'collect')
            {
                $order_row['common_collect'] = $actorder;
            }

        }
        else
        {
            $order_row['common_id'] = 'DESC';
        }

        //获取推广商品
        $Goods_CommonModel = new Goods_CommonModel();
        $data = $Goods_CommonModel->getCommonList($cond_good_row,$order_row, $page, $rows);
        $data['items'] = $Goods_CommonModel->getRecommonRow($data);
        $data['user_id'] = Perm::$userId;

        $YLB_Page->totalRows = $data['totalsize'];
        $page_nav            = $YLB_Page->prompt();

        $row = array();
        foreach ($data['items'] as $key=>$value)
        {
            $row[$key]['goods_id'] = $value['goods_id'];
            $row[$key]['common_id'] = $value['common_id'];
            $row[$key]['common_name'] = $value['common_name'];
            $row[$key]['common_price'] = $value['common_price'];
            $row[$key]['common_image'] = $value['common_image'];
            $row[$key]['shop_id'] = $value['shop_id'];
            $row[$key]['shop_name'] = $value['shop_name'];
            $row[$key]['common_salenum'] = $value['common_salenum'];
            $row[$key]['common_collect'] = $value['common_collect'];
            $row[$key]['common_cps_rate'] = $value['common_cps_rate'];
            $row[$key]['common_second_cps_rate'] = $value['common_second_cps_rate'];
            $row[$key]['common_third_cps_rate'] = $value['common_third_cps_rate'];
            $row[$key]['common_share_price'] = $value['common_share_price'];
            $row[$key]['common_shared_price'] = $value['common_shared_price'];
            $row[$key]['common_is_promotion'] = $value['common_is_promotion'];
            $row[$key]['common_promotion_price'] = $value['common_promotion_price'];

            $row[$key]['common_cps_rate_con'] = format_money($value['common_cps_rate']*$value['common_shared_price']/100) .'~'.format_money($value['common_cps_rate']*$value['common_price']/100);
            $row[$key]['common_second_cps_rate_con'] = format_money($value['common_second_cps_rate']*$value['common_shared_price']/100) .'~'.format_money($value['common_second_cps_rate']*$value['common_price']/100);
            $row[$key]['common_third_cps_rate_con'] = format_money($value['common_third_cps_rate']*$value['common_shared_price']/100) .'~'.format_money($value['common_third_cps_rate']*$value['common_price']/100);

        }
        $data['items'] = $row;
        $data['shop_qrcode'] = YLB_Registry::get('base_url')."/shop/api/qrcode.php?data=".urlencode(YLB_Registry::get('shop_wap_url')."/tmpl/member/directseller_store.html?uid=".Perm::$userId);
        if ($this->typ == "json")
        {
            $UserInfoModel = new User_InfoModel();
            $user_info = $UserInfoModel->getOne($data['user_id']);
            $data['shop_name'] = $user_info['user_directseller_shop']?$user_info['user_directseller_shop']:'我的小店';

            $this->data->addBody(-140, $data);
        }
        else
        {
            $YLB_Page->nowPage    = $page;
            $YLB_Page->listRows   = $rows;
            $YLB_Page->totalPages = $data['total'];
            $page_nav             = $YLB_Page->promptII();
            include $this->view->getView();
        }
    }

	/*
	 * 编辑推广产品
	 */
	public function editGoods()
	{
		$common_id  = request_int('common_id');
		$shop_id = request_int('shop_id');
		$data['directseller_id'] = Perm::$userId;
		$data['common_id'] = $common_id;
		$data['shop_id'] = $shop_id;

		$goodsImages = $this->directseller_goodsModel->getGoodsImages($data);
		$data['goods_images'] = @explode(',',$goodsImages['directseller_images_image']);

		$op = request_string('op');		
		if($op == 'save')
		{
			//保存图片
			$image_list = request_row('image');
			$images = implode(',',array_filter($image_list));
			$field_row['shop_directseller_goods_common_code'] = 'u'.Perm::$userId.'s'.$shop_id.'c'.$common_id;
			$field_row['shop_id'] = $shop_id;
			$field_row['common_id'] = $common_id;
			$field_row['directseller_id'] = Perm::$userId;
			$field_row['directseller_images_image'] = $images;
			
			if(!empty($goodsImages))
			{
				$flag = $this->directseller_goodsModel->editGoodsImages($goodsImages['shop_directseller_goods_common_code'],$field_row);
			}
			else
            {
                $flag = $this->directseller_goodsModel->addGoodsImages($field_row);
			}

			if($flag)
            {
                $status = 200;
                $msg    = 'success';
            }
            else
            {
                $status = 250;
                $msg    = 'fail';
            }

            if ($this->typ == "json")
            {
                $this->data->addBody(-140, $data,$msg,$status);
            }
            else
            {
                header("location: " . YLB_Registry::get('url') . '?ctl=Distribution_Buyer_Goods&met=index');
            }
		}

		if ($this->typ == "json")
		{
			$this->data->addBody(-140, $data);
		}
		else
		{
			include $this->view->getView();
		}
	}
    /*
     * 淘金分类
     */
    public function directsellerclass()
    {
        $cat_cond['cat_parent_id'] = 0;
        $cat_cond['cat_is_display'] = 1;
        $cat_order['cat_displayorder']= 'ASC';
        $goodsCatModel = new Goods_CatModel();
        $data = $goodsCatModel->getByWhere($cat_cond,$cat_order);

        $goods_cat_ids = array_keys($data);
        $goodsCatNavModel = new Goods_CatNavModel();
        $cat_nav_cond['goods_cat_id:IN'] = $goods_cat_ids;
        $goods_cat_nav = $goodsCatNavModel->getByWhere($cat_nav_cond);
        foreach ($goods_cat_nav as $key=>$value)
        {
            if($data[$value['goods_cat_id']])
            {
                $data[$value['goods_cat_id']]['nav_name'] = $value['goods_cat_nav_name'];
            }
        }

        $data = array_values($data);

        $this->data->addBody(-140, $data);
    }
	/*
	 * 淘金商品
	 */
    public function newdirectsellerGoods()
    {
        $YLB_Page           = new YLB_Page();
        $page              = request_int('page', 1);
        $rows              = request_int('rows', 10);
        $act       = request_string('act');
        $actorder    = request_string('actorder','DESC');
        $user_id = Perm::$userId;

        if ($act!=='')
        {
            //销量
            if ($act == 'sales')
            {
                $order_row['common_salenum'] = $actorder;
            }

            //佣金排序
            if ($act == 'commission')
            {
                    $order_row['common_promotion_price'] = $actorder;
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
        $Goods_CommonModel = new Goods_CommonModel();
        $cond_row['common_is_directseller'] = 1;
        if (request_int('cat_pid')) {
            $cond_row['cat_pid'] = request_int('cat_pid');
        }
        $common_name = request_string('common_name');
        if ($common_name)
        {
            $cond_row['common_name:LIKE'] = "%".$common_name . "%";
        }

        $data = $Goods_CommonModel->getGoodsList($cond_row,$order_row, $page, $rows);
        $YLB_Page->totalRows = $data['totalsize'];
        $page_nav           = $YLB_Page->prompt();
        $cond_shop['directseller_id'] = $user_id;
        $cond_shop['directseller_enable'] = 1;
        $Distribution_ShopModel = new Distribution_ShopDirectsellerModel();
        $Distribution_Shop_Directseller = new Distribution_ShopDirectsellerConfigModel();
        $shopList = $Distribution_ShopModel->getBaseList($cond_shop);
        $shop = array();
        foreach ($shopList as $v){
            array_push($shop,$v['shop_id']);
        }
        for ($i = 0;$i<count($data['items']);$i++){
            $data['items'][$i]['exist'] = null;
            if (array_search($data['items'][$i]['shop_id'],$shop) !== false) {
                $data['items'][$i]['exist'] = 1;
            }
                $cond_expend['shop_id'] = $data['items'][$i]['shop_id'];
                $shop_expend = $Distribution_Shop_Directseller->getOneByWhere($cond_expend);
                $data['items'][$i]['exist_m'] = $shop_expend['expenditure'];
        }
        if ($this->typ == "json")
        {
            $this->data->addBody(-140, $data);
        }
        else
        {
            include $this->view->getView();
        }
    }
    public function suanfa(){
        $b = [2,4,3,5,9,8,7,6,1];
        $len=count($b);
        for($k=0;$k<=$len;$k++)
        {
            for($j=$len-1;$j>$k;$j--){
                if($b[$j]<$b[$j-1]){
                    $temp = $b[$j];
                    $b[$j] = $b[$j-1];
                    $b[$j-1] = $temp;
                }
            }
        }
//        for($k=1;$k<$len;$k++)
//        {
//            for($j=0;$j<$len-$k;$j++){
//                if($b[$j]>$b[$j+1]){
//                    $temp =$b[$j+1];
//                    $b[$j+1] =$b[$j] ;
//                    $b[$j] = $temp;
//                }
//            }
//        }
        $this->data->addBody(-140,$b);
    }
}
?>