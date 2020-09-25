<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * @author     Zhenzh 9.9活动页
 */
class Goods_CheapCtl extends Controller
{

    public $goodsCatModel = null;
    public $goodsCommonModel = null;
    public function __construct(&$ctl, $met, $typ)
    {
        parent::__construct($ctl, $met, $typ);
        $this->initData();
        $this->web = $this->webConfig();
        $this->nav = $this->navIndex();
        $this->cat = $this->catIndex();

        $this->goodsCatModel = new Goods_CatModel();
        $this->goodsCommonModel = new Goods_CommonModel();
    }

    public function index()
    {
        $data = array();

        $Adv_ConModel = new Operation_AdvertisementModel();
        $adv_list = $Adv_ConModel->getAdvList(array('group_id'=>20));


        $type = request_string('type','1');
        $cat_id = request_int('cat_id');
        $cat_sid = request_int('cat_sid');



        $cat_cond['cat_parent_id'] = 0;
        $cat_cond['cat_is_display'] = 1;
        $cat_order['cat_displayorder']= 'ASC';
        $goods_cats = $this->goodsCatModel->getByWhere($cat_cond,$cat_order);
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
            $goods_sub_cats = $this->goodsCatModel->getByWhere($cat_sub_cond,$cat_sub_order);
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

        $data['goods_cat'] = $goods_cats;

        $YLB_Page = new YLB_Page();
        $YLB_Page->listRows = request_int('rows',24);
        $rows = $YLB_Page->listRows;
        $offset = request_int('firstRow', 0);
        $page = ceil_r($offset / $rows);

        if($type == 2)
        {
            $cond_row['common_shared_price:>'] = 10;
            $cond_row['common_shared_price:<='] = 20;
        }
        else if($type == 3)
        {
            $cond_row['common_shared_price:>'] = 20;
            $cond_row['common_shared_price:<='] = 50;
        }
        else
        {
            $cond_row['common_shared_price:<'] = 10;
        }

        if ($c_id)
        {
            //查找该分类下所有的子分类
            $cat_list = $this->goodsCatModel->getCatChildId($c_id);
            $cond_row['cat_id:IN'] = $cat_list;
        }
        $cond_row['common_stock:>'] = 0;
        $cond_row['common_state'] = Goods_CommonModel::GOODS_STATE_NORMAL;
        $cond_row['common_verify'] = Goods_CommonModel::GOODS_VERIFY_ALLOW;

        $order_row['common_salenum'] = 'DESC';

        $data_goods = $this->goodsCommonModel->getGoodsList($cond_row, $order_row, $page, $rows);

        $YLB_Page->totalRows = $data_goods['totalsize'];
        $page_nav = $YLB_Page->prompt();
        $data['data_goods'] = $data_goods;

        $title             = Web_ConfigModel::value("jiu_title");//首页名;
        $this->keyword     = Web_ConfigModel::value("jiu_keyword");//关键字;
        $this->description = Web_ConfigModel::value("jiu_description");//描述;
        $this->title       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $title);
        $this->keyword       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->keyword);
        $this->description       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->description);

        if ('json' == $this->typ)
        {
            $Adv_ConModel = new Operation_AdvertisementModel();
            $adv_list = $Adv_ConModel->getAdvList(array('group_id'=>Operation_AdvertisementModel::$adv_id['cheap']));
            $adv_list['items'] = array_values($adv_list['items']);
            $data['adv_list'] = $adv_list;

            $this->data->addBody(-140, $data);
        }
        else
        {
            include $this->view->getView();
        }
    }
}
?>