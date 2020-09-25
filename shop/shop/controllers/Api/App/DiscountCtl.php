<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/7
 * Time: 10:33
 * @author weidp
 */

class Api_App_DiscountCtl extends YLB_AppController
{
    //定义广告位id
    public static $adv_id = 14;

    public function __construct(&$ctl, $met, $typ)
    {
        parent::__construct($ctl, $met, $typ);

        $this->Discount_BaseModel = new Discount_BaseModel();
        $this->Discount_GoodsModel = new Discount_GoodsModel();
        $this->Discount_QuotaModel = new Discount_QuotaModel();
        $this->Adv_ConModel = new Operation_AdvertisementModel();
        $this->Goods_BaseModel = new Goods_BaseModel();
        $this->Goods_CommonModel = new Goods_CommonModel();
        $this->Shop_BaseModel = new Shop_BaseModel();
        $this->Goods_CatModel = new Goods_CatModel();
        $this->Goods_CatNavModel = new Goods_CatNavModel();
        $this->User_AddressModel = new User_AddressModel();
    }

    //定义获取页面导航以及轮播图
    public function getNav()
    {
        $adv_con = $this->Adv_ConModel->getAdvList(array('group_id' => self::$adv_id));

        $cat_con = $this->Goods_CatModel->getCatList(array('cat_parent_id' => '0'));

        foreach ($cat_con['items'] as $key => $value) {

            $cat_id[] = $value['cat_id'];
        }

        $cat_nav = $this->Goods_CatNavModel->getCatByIds('goods_cat_id', $cat_id);

        if ($this->typ == 'json') {

            $data['items'] = array('nav' => $adv_con, 'cat' => array_merge($cat_nav));
            $this->data->addBody(-140, $data);
        }
    }

    //app自行定位，wap获取收货人地址
    public function UserAddress()
    {
        if (perm::checkUserPerm()) {

            $user_id = perm::$userId;

            $address = $this->User_AddressModel->getAddressList(array('user_id' => $user_id));

            if ($address) {
                $data['items'] = array_merge($address);
                $status = 200;
            } else {
                $data['msg'] = '添加收货地址';
                $status = 220;
            }

        } else {
            $data['msg'] = '点击登录';
            $status = 210;
        }

        if ($this->typ == 'json') {

            $this->data->addBody(-140, $data,$msg='success',$status);
        }

    }



    //多条件查询数据加载
    public function getContentByTab()
    {
        $nav = request_int('nav');
        $discount = request_int('discount');
        $rule = request_string('rule');
        $is_not = request_int('is_not');

        //大分类
        if ($nav) {
            $cat = $this->Goods_CatModel->getChildCat($nav);
            foreach ($cat as $key => $value) {
                $cat_id[] = $value['cat_id'];
                if ($value['child']) {
                    foreach ($value['child'] as $k => $v) {
                        $cat_id[] = $v['cat_id'];
                    }
                }
            }
            array_unshift($cat_id, $nav);
        }

//        //获取数据
        $disBase = $this->Discount_BaseModel->getDiscountActList(array('discount_state' => '1'), array('discount_id' => 'DESC'));

        foreach ($disBase['items'] as $key => $value) {
            $discount_id[] = $value['discount_id'];
        }

        //获取自营店铺id
        if ($is_not == 1) {
            $flag = 'true';
            $shop_id = $this->Shop_BaseModel->getByWhere(array("shop_self_support" => $flag, "shop_type" => "1", "shop_status" => '3'));
        }else if($is_not == 0){
            $flag = 'false';
            $shop_id = $this->Shop_BaseModel->getByWhere(array("shop_self_support" => $flag, "shop_type" => "1", "shop_status" => '3'));
        }else if($is_not == 2){
            $shop_id = $this->Shop_BaseModel->getByWhere(array("shop_type" => "1", "shop_status" => '3'));
        }


        $shop_ids = array();

        if ($shop_id) {
            foreach ($shop_id as $key => $value) {
                $shop_ids[] = $value['shop_id'];
            }
        }

        if ($cat_id) {
            $other = array('cat_id:IN' => $cat_id);
            $cond_row = array('discount_id:IN' => $discount_id, 'shop_id:IN' => $shop_ids,'discount_goods_state'=>1);

        }else{
            $other = array();
            $cond_row = array('discount_id:IN' => $discount_id, 'shop_id:IN' => $shop_ids,'discount_goods_state'=>1);
        }

        if ($rule) {
            switch ($rule) {
                case 'priceT':
                    $order_row = array('discount_price' => 'DESC');
                    $goods_order = array();
                    break;
                case 'priceL':
                    $order_row = array('discount_price' => 'ASC');
                    $goods_order = array();
                    break;
                case 'save':
                    $order_row = array();
                    $goods_order = array('goods_share_price' => 'DESC');
                    break;
                case 'salenum':
                    $order_row = array();
                    $goods_order = array('goods_salenum' => 'DESC');
                    break;
                case 'point':
                    $order_row = array();
                    $goods_order = array('goods_evaluation_good_star' => 'DESC');
                    break;
            }

        } else {

            $order_row = array();
            $goods_order = array();
        }

        $disGoods = array_merge($this->Discount_GoodsModel->getDiscountGoods($cond_row, $order_row,$other,$goods_order));

        //动态计算宽度和库存总数
        foreach($disGoods as $key=> $value)
        {
            $disGoods[$key]['width'] = number_format(($value['goods_salenum']/($value['goods_salenum']+$value['goods_stock']))*100,2,'.','');
            $disGoods[$key]['stock_count'] = ($value['goods_salenum']+$value['goods_stock']);
            $disGoods[$key]['share_discount_price'] = ($value['discount_price']-$value['share_total_price']);
        }

        $data['goods_excellent'] = $this->Discount_GoodsModel->getOrderGoodsList($cond_row,$order_row);

        if($data['goods_excellent']){
            foreach($data['goods_excellent'] as $key=>$value){
                $common_data = $this->Goods_CommonModel->getOneByWhere(array('common_state'=>1,'common_id'=>$value['common_id']));
                if(!$common_data){
                    unset($data['goods_excellent'][$key]);
                }
            }
            $data['goods_excellent'] = array_merge($data['goods_excellent']);
        }

        if ($discount) {
            foreach ($disGoods as $key => $value) {
                if (floor($value['discount_percent']) == $discount) {

                    $arr[] = $disGoods[$key];
                }

            }
            $data['items'] = $arr;
        } else {

            $data['items'] = $disGoods;
        }

        if ($this->typ == 'json') {

            $this->data->addBody(-140, $data);
        }

    }


}