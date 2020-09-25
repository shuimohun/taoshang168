<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * @author     Zhenzh 排行榜
 */
class Goods_TopCtl extends Controller
{

    public $goodsCatModel = null;
    public $goodsCommonModel = null;

    public function __construct(&$ctl, $met, $typ)
    {
        parent::__construct($ctl, $met, $typ);
        $this->initData();

        $this->goodsCatModel = new Goods_CatModel();
        $this->goodsCommonModel = new Goods_CommonModel();
    }

    //排行榜首页
    public function index()
    {
        $data = array();

        $cat_count = 0;
        $cat_data = array();
        if ($_COOKIE['user_id']) {
            //根据足迹取分类id
            $user_id = $_COOKIE['user_id'];
            $UserFootprintModel = new User_FootprintModel();

            $sql = "SELECT b.cat_id,b.cat_name,b.cat_pic FROM " . TABEL_PREFIX . "user_footprint a LEFT JOIN " . TABEL_PREFIX . "goods_cat b ON a.cat_id = b.cat_id WHERE a.cat_id > 0 and a.user_id = $user_id GROUP BY a.cat_id ORDER BY a.footprint_time DESC LIMIT 0,10";
            $cat_data = $UserFootprintModel->selectSql($sql);

            if ($cat_data) {
                $cat_count = count($cat_data);
            }
        }

        if ($cat_count < 10) {
            //足迹数不够10个 取推荐的分类id 凑够10个
            $GoodsTopCatModel = new Goods_TopCatModel();
            $cond_row = array();
            if ($cat_data) {
                $cond_row['cat_id:NOT IN'] = array_column($cat_data, 'cat_id');
            }
            $goods_top_cat = $GoodsTopCatModel->getGoodsTopCatList($cond_row, array('display_order' => 'ASC'), 1, 10 - $cat_count);

            if ($goods_top_cat['items']) {
                $cat_data = array_merge($cat_data, $goods_top_cat['items']);
            }

            /*//还不够10个 取销量高的分类id 凑够10个
            $sql = 'SELECT gc.cat_id,gc.cat_name,gc.cat_pic,SUM(c.common_salenum) AS salenum FROM '.TABEL_PREFIX.'goods_common c LEFT JOIN '.TABEL_PREFIX.'goods_cat cat ON c.cat_id = cat.cat_id   LEFT JOIN '.TABEL_PREFIX.'goods_cat gc ON cat.cat_parent_id = gc.cat_id GROUP BY cat.cat_parent_id ORDER BY `salenum` DESC';
            $sql .= ' LIMIT 0,' . (10 - $cat_count);
            $cat_top_data = $this->goodsCommonModel->selectSql($sql,1,10);*/
        }

        $data['cat_data'] = $cat_data;

        if ('json' == $this->typ) {
            $Adv_ConModel = new Operation_AdvertisementModel();
            $adv_list = $Adv_ConModel->getAdvList(array('group_id'=>Operation_AdvertisementModel::$adv_id['top']));
            $adv_list['items'] = array_values($adv_list['items']);
            $data['adv_list'] = $adv_list;

            $this->data->addBody(-140, $data);
        } else {
            if ($cat_data) {
                $current_cat = current($cat_data);
                $current_cat_id = $current_cat['cat_id'];
                $current_cat_name = $current_cat['cat_name'];
            }

            $title = Web_ConfigModel::value("paihang_title");//首页名;
            $this->keyword = Web_ConfigModel::value("paihang_keyword");//关键字;
            $this->description = Web_ConfigModel::value("paihang_description");//描述;
            $this->title = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $title);
            $this->keyword = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->keyword);
            $this->description = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->description);

            include $this->view->getView();
        }
    }

    //店铺排行
    public function shop()
    {
        $data = array();
        if ('json' == $this->typ) {
            $this->data->addBody(-140, $data);
        } else {
            include $this->view->getView();
        }
    }

    //热卖排行
    public function sale()
    {
        $data = array();
        if ('json' == $this->typ) {
            $this->data->addBody(-140, $data);
        } else {
            include $this->view->getView();
        }
    }

    //热搜排行
    public function search()
    {
        $data = array();
        if ('json' == $this->typ) {
            $this->data->addBody(-140, $data);
        } else {
            include $this->view->getView();
        }
    }

    /**
     * 根据分类id 获取该分类下的子分类
     * subCatIds : 子分类id字符串
     */
    public function getChildCat()
    {
        $Goods_CatModel = new Goods_CatModel();
        $cat_parent_id = request_int('cat_parent_id', 0);
        $data['items'] = $Goods_CatModel->getChildCat($cat_parent_id);
        $data['subCatIds'] = implode(array_column($data['items'], 'cat_id'), ',');
        $this->data->addBody(-140, $data);
    }

    /**
     * 获取分类下的热销商品
     * cat_ids 可能是多个cat_id
     */
    public function goodsSale()
    {
        $pageSize = request_int('pageSize');
        $page = request_int('page');
        $offset = ($page - 1) * $pageSize;
        $cat_id = request_int("cat_id");

        if($cat_id){
            $Goods_CatModel = new Goods_CatModel();
            $goods_cat_row = $Goods_CatModel->getByWhere(array('cat_parent_id' => $cat_id,'cat_is_display'=>1));

            $cat_ids = '('. implode(array_column($goods_cat_row, 'cat_id'), ',') . ')';

        }else{
            $cat_ids = request_row('cat_ids');
        }

        $sql = "select common_id,shop_id,common_name,common_is_jia,common_promotion_type,common_image,common_salenum,common_share_price,common_is_promotion,common_promotion_price,common_price,common_collect,common_evaluate,cat_id,cat_name from ylb_goods_common where cat_id in $cat_ids and shop_status=3 and common_state=1 and common_verify=1 order by common_salenum DESC limit $offset,$pageSize";
        $res = $this->goodsCatModel->sql->getAll($sql);
        /*商品是否参与满送活动*/
        $promotion = new Promotion();
        for ($i = 0; $i < count($res); $i++) {
            $mansong_info = $promotion->getShopGiftInfo($res[$i]['shop_id']);
            $res[$i]['mansong_info']['mansong_id'] = $mansong_info['mansong_id'];
        }
        if ($res) {
            $msg = 'success';
            $status = 200;
        } else {
            $msg = 'error';
            $status = 250;
        }

        $this->data->addBody(140, $res, $msg, $status);
    }

    /**
     * 获取热搜词
     */
    public function getSearchWord()
    {
        //获取热搜关键词
        $model = new Search_Word();
        $wap = request_string('wap');
        $sql = "select search_id,search_keyword,search_nums from ylb_search_word order by search_nums DESC limit 0,10";
        $res = $model->sql->getAll($sql);

        //根据热搜关键词获取热销商品
        foreach ($res as $key => $val) {
            $sql1 = "SELECT common_id,common_name,common_image,common_share_price,common_is_promotion,common_promotion_price FROM ylb_goods_common where common_name LIKE '%" . $val['search_keyword'] . "%' AND shop_status = 3 AND common_state = 1 AND common_verify = 1 ORDER BY common_salenum DESC LIMIT 0,3";
            $res[$key]['goods_list'] = $model->sql->getAll($sql1);
        }

        if ($res) {
            $msg = 'success';
            $status = 200;
        } else {
            $msg = 'error';
            $status = 250;
        }
        if ($wap == 'json') {
            $data['items'] = $res;
        } else {
            //拆分成两个数组
            foreach ($res as $k => $v) {
                if ($k <= 4) {
                    $data['list_a'][$k] = $v;
                } else {
                    $data['list_b'][$k] = $v;
                }
            }
        }


        $this->data->addBody(140, $data, $msg, $status);
    }

    public function getSearchWordAll()
    {
        //获取热搜关键词
        $model = new Search_Word();
        $sql = "select search_id,search_keyword,search_nums from ylb_search_word order by search_nums DESC limit 0,30";
        $res = $model->sql->getAll($sql);

        //根据热搜关键词获取热销商品
        foreach ($res as $key => $val) {
            $sql1 = "SELECT common_id,common_name,common_image,common_share_price,common_is_promotion,common_promotion_price,common_price FROM ylb_goods_common where common_name LIKE '%" . $val['search_keyword'] . "%' AND shop_status = 3 AND common_state = 1 AND common_verify = 1 ORDER BY common_salenum DESC LIMIT 0,4";
            $res[$key]['goods_list'] = $model->sql->getAll($sql1) ? $model->sql->getAll($sql1) : array()  ;
            if( !$res[$key]['goods_list'] )
            {
                unset( $res[$key]);
            }
        }
        $res = array_values( $res );
        if ($res) {
            $msg = 'success';
            $status = 200;
        } else {
            $msg = 'error';
            $status = 250;
        }

        $this->data->addBody(140, $res, $msg, $status);
    }

    /**
     * 获取店铺商品销量排行数据
     */
    public function getShopSaleGoods()
    {

        $pageSize = request_int('pageSize');
        $page = request_int('page');
        $offset = ($page - 1) * $pageSize;


        $cat_id = request_row('cat_id');
        if($cat_id){
            $Goods_CatModel = new Goods_CatModel();
            $goods_cat_row = $Goods_CatModel->getByWhere(array('cat_parent_id' => $cat_id,'cat_is_display'=>1));

            $cat_ids = '('. implode(array_column($goods_cat_row, 'cat_id'), ',') . ')';

        }else{
            $cat_ids = request_row('cat_ids');
        }
        $model = new Goods_CommonModel();

        $sql = "SELECT a.shop_id, a.shop_name, b.shop_logo,b.shop_self_support,SUM(a.common_salenum) AS salenums FROM ylb_goods_common a LEFT JOIN ylb_shop_base b ON a.shop_id = b.shop_id WHERE a.cat_id in $cat_ids AND a.shop_status = 3 AND a.common_state = 1 AND a.common_verify = 1 GROUP BY a.shop_name ORDER BY salenums DESC LIMIT $offset, $pageSize";

        $res = $model->sql->getAll($sql);

        foreach ($res as $key => $val) {
            $sql1 = "SELECT common_id,common_name,common_image,common_salenum,common_price,common_is_promotion,common_share_price,common_promotion_price,shop_id,shop_name FROM ylb_goods_common where shop_id=" . $val['shop_id'] . " AND shop_status = 3 AND common_state = 1 AND common_verify = 1 ORDER BY common_salenum DESC LIMIT 0,2";
            $res1 = $model->sql->getAll($sql1);
            //$res[$key]['salenums'] = number_format_hanzi($val['salenums']);
            $res[$key]['goods_list'] = $res1;
        }

        $data['list_all'] = $res;

        //拆分成三个数组
        foreach ($res as $k => $v) {
            if ($k <= 3) {
                $data['list_a'][$k] = $v;
            } else if ($k > 3 && $k <= 7) {
                $data['list_b'][$k] = $v;
            } else {
                $data['list_c'][$k] = $v;
            }
        }

        if ($res) {
            $msg = 'success';
            $status = 200;
        } else {
            $msg = 'error';
            $status = 250;
        }

        $this->data->addBody(140, $data, $msg, $status);
    }

    /**
     * 获取折扣商品 热销数据
     */
    public function getDiscountGoods()
    {
        $model = new Discount_GoodsModel();
        $sql = "SELECT a.discount_goods_id,a.goods_id, a.goods_price, a.discount_price,  a.discount_rate,b.common_promotion_type,b.shop_id,b.common_is_jia,b.common_id,b.common_name,b.common_image, b.common_share_price, b.common_promotion_price,b.common_shared_price,b.common_salenum,b.common_stock,b.common_is_promotion,b.common_salenum FROM " . TABEL_PREFIX . "discount_goods a LEFT JOIN " . TABEL_PREFIX . "goods_common b ON a.common_id = b.common_id WHERE a.discount_goods_state = 1 AND b.shop_status = 3 AND b.common_state = 1 AND b.common_verify = 1 ORDER BY b.common_salenum LIMIT 0,6";

        $res = $model->sql->getAll($sql);
        /*折扣商品满送信息*/
        $promotion = new Promotion();
        for ($i = 0; $i < count($res); $i++) {
            $mansong_info = $promotion->getShopGiftInfo($res[$i]['shop_id']);
            $res[$i]['mansong_info']['mansong_id'] = $mansong_info['mansong_id'];
        }
        if ($res) {
            $msg = 'success';
            $status = 200;
        } else {
            $msg = 'error';
            $status = 250;
        }
        $this->data->addBody(140, $res, $msg, $status);
    }


}


























