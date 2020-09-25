<?php
/**
 * Created by PhpStorm.
 * User: liuguilong
 * Date: 2017/7/7 0007
 * Time: 15:40
 */

if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

class DiscountBuyCtl extends Controller {

    public function __construct(&$ctl,$met,$typ){
        parent::__construct($ctl,$met,$typ);
        $this->initData();
        $this->web = $this->webConfig();
        $this->nav = $this->navIndex();
        $this->cat = $this->catIndex();

        $this->discountGoodsModel = new Discount_GoodsModel();
    }

    /**
     * 页面
     */
    public function index(){
        
        $title             = Web_ConfigModel::value("zk_title");//首页名;
        $this->keyword     = Web_ConfigModel::value("zk_keyword");//关键字;
        $this->description = Web_ConfigModel::value("zk_description");//描述;
        $this->title       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $title);
        $this->keyword       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->keyword);
        $this->description       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->description);

        if($this->typ == 'e'){
            include $this->view->getView();
        }else{

        }
    }

    /**
     * 获取限时折扣（劲爆折扣）商品列表数据
     * @liuguilong
     */
    public function discountBuyList(){
        $YLB_Page = new YLB_Page();
        $YLB_Page->listRows = request_int('listRows') ? request_int('listRows') : 10;
        $rows = $YLB_Page->listRows;
        $offset = request_int('firstRow', 0);
        $page = ceil_r($offset / $rows);

        //分类搜索条件
        $cat_id = request_int('cat_id');
        if(!empty($cat_id)){
            $cond_row['cat_id'] = $cat_id;
        }

        //商家 还是 自营
        $shop_self_support = request_int('self_support');

        if($shop_self_support != 3){    //0 为商家 1 为自营 3 为全部
            $cond_row['shop_self_support'] = $shop_self_support;
        }

        $discount_l = request_int('discount_l') ? request_int('discount_l') : 0;
        $discount_r = request_int('discount_r') ? request_int('discount_r') : 10;
        $cond_row['discount_rate:>='] = $discount_l;
        $cond_row['discount_rate:<'] = $discount_r;

        $data = $this->discountGoodsModel->getDiscountGoodsList($cond_row, array('discount_rate'=>'ASC'), $page, $rows);

        //获取当前用户收藏的商品id
        if (Perm::checkUserPerm()) {
            $User_FavoritesGoodsModel = new User_FavoritesGoodsModel();
            $goods_id_row = array_column($data['items'],'goods_id');
            $user_favoritr_row = $User_FavoritesGoodsModel->getByWhere(array("user_id" => Perm::$userId,'goods_id:IN'=>$goods_id_row));
            $goods_id_row = array_column($user_favoritr_row,'goods_id');
        }

        $Goods_CatModel = new Goods_CatModel();
        foreach ($data['items'] as $key => $goods_row){
            if($goods_id_row && in_array($goods_row['goods_id'],$goods_id_row)){
                $data['items'][$key]["is_favorite"] = 1;
            }else{
                $data['items'][$key]['is_favorite'] = 0;
            }

            if($goods_row['goods_stock'] == 0){
                $data['items'][$key]['soldOut'] = 1;    //售罄
            }else{
                $data['items'][$key]['soldOut'] = 0;
            }

            $data['items'][$key]['sales_persent'] = (($goods_row['goods_salenum']/($goods_row['goods_stock']+$goods_row['goods_salenum']))*100)."%";

            //获取该商品的最上级分类
            $res = $Goods_CatModel->getTopParentCat($goods_row['cat_id']);
            if($res['cat_parent_id'] == 0){
                $cat_parent_id = $res;
            }
            $data['items'][$key]['cat_parent_id'] = $cat_parent_id['cat_id'];

            $data['items'][$key]['share_total_price'] = $data['items'][$key]['discount_price'] - $data['items'][$key]['goods_share_price'];
        }

        $YLB_Page->totalRows = $data['totalsize'];
        $data['page_nav'] = trim($YLB_Page->prompt());
        $this->data->addBody(-140, $data);
    }

    /**
     * 页面上部的商品展示，按销量获取，在页面展示7条
     * @ liuguilong
     */
    public function discountBuyListSalenum(){
        $nums = request_int('nums');
        $sql = 'SELECT a.goods_id,a.`common_id`,b.goods_name,b.goods_price,b.goods_image,b.cat_id,b.goods_salenum,b.goods_share_price,b.goods_is_promotion,b.goods_promotion_price FROM `'.TABEL_PREFIX.'discount_goods` a';
        $sql .= ' LEFT JOIN '.TABEL_PREFIX.'goods_base b ';
        $sql .= ' ON a.goods_id = b.`goods_id`';
        $sql .= ' WHERE b.`goods_is_shelves`=1 AND b.`goods_stock` > 0 AND a.discount_goods_state = 1';
        $sql .= ' AND a.goods_start_time < "'.get_date_time().'" AND a.goods_end_time > "'.get_date_time().'"';
        $sql .= ' ORDER BY b.`goods_salenum` DESC LIMIT 0,'.$nums;

        $data = $this->discountGoodsModel->selectSql($sql);
        $this->data->addBody(-140, $data);
    }

    /**
     * 获取分类信息
     * @liuguilong 20170712
     */
    public function discountCatList(){
        //左侧分类

        //获取分类表中原本的一级分类
        $Goods_CatModel = new Goods_CatModel();
        $cat = $Goods_CatModel->getCatList(array('cat_parent_id'=>0,'cat_is_display'=>1));

        //获取对应的分类别名
        $Goods_CatNavModel = new Goods_CatNavModel();
        $cat_nav = $Goods_CatNavModel->getCatNavList();

        foreach($cat['items'] as $key=>$val){
            foreach($cat_nav['items'] as $k=>$v){
                if($val['cat_id'] == $v['goods_cat_id']){
                    $cat['items'][$key]['goods_cat_nav_name'] = $v['goods_cat_nav_name'];
                }
            }
        }

        $this->data->addBody(-140,$cat);
    }


}