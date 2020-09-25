<?php
if(!defined('ROOT_PATH'))
{
    exit('No Permission');
}
/**
 * @author weidp
 */

class Api_Shop_SupermarketCtl extends YLB_AppController
{
    //设置广告位id
    public static $advs_id = 13;

    public $ShopModel = null;
    public $GoodsCommonModel = null;
    public function __construct(&$ctl, $met, $typ)
    {
        parent::__construct($ctl, $met, $typ);

        $this->GoodsCat                 = new Goods_CatModel();
        $this->ShopModel                = new Shop_BaseModel();
        $this->GoodsCatNav              = new Goods_CatNavModel();
        $this->GoodsBaseModel           = new Goods_BaseModel();
        $this->SupermarketModel         = new Shop_SupermarketModel();
        $this->GoodsCommonModel         = new Goods_CommonModel();
        $this->AdvertisementModel       = new Operation_AdvertisementModel();
        $this->AdvPageSettingsModel     = new Adv_PageSettingsModel();
        $this->User_FavoritesGoodsModel = new User_FavoritesGoodsModel();

    }

    //获取轮播图以及导航图标
    public function getNav()
    {
        $adv_con = $this->AdvertisementModel->getAdvList(array('group_id'=>self::$advs_id));

        $adv_parent = $this->GoodsCat->getCatList(array('cat_parent_id'=>'0'));

        $adv_id = array();

        foreach($adv_parent['items'] as $key=>$value)
        {
            $adv_id[] = array('cat_id'=>$value['cat_id'],'items'=>array_merge($this->GoodsCatNav->getCatByIds('goods_cat_id',array($value['cat_id']))));
        }

       if($this->typ == 'json')
       {
           $data['adv'] = $adv_con['items'];
           $data['cla'] = $adv_id;

           $this->data->addBody(-140,$data);
       }

    }

    //获取不可错过系列数据
    public function getEssential()
    {

        /*$data = array();
        //获取自营店铺id
        $shop_id = $this->ShopModel->getBaseList(array("shop_self_support" => "true","shop_type"=>"1","shop_status"=>'3'));

        $ids = array();

        if($shop_id['items'])
        {
            foreach($shop_id['items'] as $key=>$value)
            {
                $ids[] = $value['shop_id'];
            }
        }

        $common['items'][0] = $this->GoodsCommonModel->getOneByWhere(array('shop_id:IN'=>$ids,'common_state'=>'1'),array('common_collect'=>'DESC'));
        $common['items'][1] = $this->GoodsCommonModel->getOneByWhere(array('shop_id:IN'=>$ids,'common_state'=>'1'),array('common_salenum'=>'DESC'));
        $common['items'][2] = $this->GoodsCommonModel->getOneByWhere(array('shop_id:IN'=>$ids,'common_state'=>'1'),array('common_evaluate'=>'DESC'));

        foreach($common['items'] as $key=>$value){
            $common['items'][$key]['goods_id'] = $this->GoodsCommonModel->getNormalStateGoodsId($value['common_id']);
        }

        if($this->typ == 'json')
        {
            $data['collect'] = $common['items'][0]['common_collect'];
            $data['salenum'] = $common['items'][1]['common_salenum'];
            $data['evaluate'] = $common['items'][2]['common_evaluate'];
            $data['items'] = $common['items'];
            $this->data->addBody(-140,$data);
        }*/


        //Zhenzh 2018-08-11 修改
        $sql = 'SELECT "2" sort,"evaluate" type,a.common_id,a.common_name,a.`common_image`,a.common_evaluate,a.common_salenum,a.common_collect,c.goods_id FROM ylb_goods_common a, ';
        $sql .= ' (SELECT MAX(common_evaluate) AS common_evaluate  FROM ylb_goods_common WHERE common_state = 1 AND shop_self_support = 1)b,ylb_goods_base c ';
        $sql .= ' WHERE a.common_evaluate = b.common_evaluate AND a.common_id = c.common_id LIMIT 0,1 ';
        $sql .= ' UNION SELECT "1" sort,"salenum" type,a.common_id,a.common_name,a.`common_image`,a.common_evaluate,a.common_salenum,a.common_collect,c.goods_id FROM ylb_goods_common a, ';
        $sql .= ' (SELECT MAX(common_salenum) AS common_salenum  FROM ylb_goods_common WHERE common_state = 1 AND shop_self_support = 1)b,ylb_goods_base c ';
        $sql .= ' WHERE a.common_salenum = b.common_salenum AND a.common_id = c.common_id LIMIT 0,1 ';
        $sql .= ' UNION SELECT "0" sort,"collect" type,a.common_id,a.common_name,a.`common_image`,a.common_evaluate,a.common_salenum,a.common_collect,c.goods_id FROM ylb_goods_common a, ';
        $sql .= ' (SELECT MAX(common_collect) AS common_collect  FROM ylb_goods_common WHERE common_state = 1 AND shop_self_support = 1)b,ylb_goods_base c ';
        $sql .= ' WHERE a.common_collect = b.common_collect AND a.common_id = c.common_id LIMIT 0,3 ';

        $data = $this->GoodsCommonModel->selectSql($sql);

        $row = [];
        foreach ($data as $key => $value)
        {
            $row[$value['type']] = $value['common_'.$value['type']];
            $row['items'][$value['sort']] = $value;
        }

        if($this->typ == 'json')
        {
            $this->data->addBody(-140,$row);
        }

    }

    //获取淘尚生活家内容
    public function getLife()
    {

        $cond_row['sub_site_id'] = Adv_PageSettingsModel::SELFSUPPORT; //自营店铺单独模板

        //获取模板数据
        $page = $this->AdvPageSettingsModel->listPageSettingsWhere($cond_row,array('page_order' => 'asc'));

        foreach($page['items'] as $key=>$value)
        {
            $goods_ids = $this->SupermarketModel->getLifeContent(0,$value['page_html']);
            $goods_bae_rows = $this->GoodsBaseModel->getBase($goods_ids);
            $common_ids = array_column($goods_bae_rows,'common_id');
            $arr[] = array("page_id"=>$value['page_id'],"page_name"=>$value['page_name'],"goods_base"=> array_merge($this->GoodsCommonModel->getGoodsList(array('common_id:IN'=>$common_ids),array(),1,20)));
        }

        if($this->typ == 'json')
        {
            $data['items'] =  $arr;
            $this->data->addBody(-140,$data);
        }
    }

    //获取选项内容
    public function getClickContent()
    {
        /*$type = request_string('type');
        $page = request_string('page');

        if(!$page)
        {
           $page = 1;
        }
        switch ($type)
        {
            case 'salenum':
                $type = array('common_salenum' => 'desc');
                break;
            case 'evaluation':
                $type = array('common_evaluate' => 'desc');
                break;
            case 'collect':
                $type = array('common_collect' => 'desc');
                break;
        }

        $shop_id = $this->ShopModel->getBaseList(array("shop_self_support" => "true","shop_type"=>"1","shop_status"=>'3'));

        $ids = array();

        if($shop_id['items'])
        {
            foreach($shop_id['items'] as $key=>$value)
            {
                $ids[] = $value['shop_id'];
            }
        }

        $goods = $this->GoodsBaseModel->getBaseByIds('shop_id',$ids);

        foreach($goods as $key=>$value)
        {
            $goods_id[] = $value['goods_id'];
        }

        $common = $this->GoodsCommonModel->getGoodsList(array('common_id:IN'=>$this->GoodsBaseModel->getCommonIdByGoodsId($goods_id)),$type,$page,20);

        $data = $common;*/

        //Zhenzh 2018-08-11 修改
        $type = request_string('type');
        $page = request_int('page',1);
        $rows = request_int('rows',20);
        $offset = $rows * ($page - 1);

        switch ($type)
        {
            case 'salenum':
                $order_by = ' ORDER BY a.common_salenum DESC ';
                break;
            case 'evaluation':
                $order_by = ' ORDER BY a.common_evaluate DESC ';
                break;
            case 'collect':
                $order_by = ' ORDER BY a.common_collect DESC ';
                break;
            default :
                $order_by = ' ORDER BY a.common_id DESC ';
        }

        $where = ' AND a.common_state = 1 AND a.shop_self_support = 1 AND a.shop_status = 3 ';

        $count_sql = 'SELECT COUNT(*) FROM ylb_goods_common a WHERE 1 ' . $where;
        $total = $this->GoodsCommonModel->selectSql($count_sql);

        if ($total)
        {
            $total = current($total);
            $total = array_shift($total);

            if ($total)
            {
                $sql = 'SELECT a.common_id,b.goods_id,a.common_name,a.common_image,a.common_price,a.`common_share_price`,a.`common_shared_price`,a.`common_is_promotion`,a.`common_promotion_price`  FROM ylb_goods_common a,ylb_goods_base b WHERE a.common_id = b.common_id ';
                $sql .= $where;
                $sql .= 'GROUP BY b.common_id' . $order_by . ' LIMIT ' . $offset . ', ' . $rows;

                $res = $this->GoodsCommonModel->selectSql($sql);
            }

            $data['page'] = $page;
            $data['total'] = ceil_r($total / $rows);  //total page
            $data['totalsize'] = $total;
            $data['records'] = $total;
            $data['items'] = $res;
        }

        if($this->typ == 'json')
        {
            $this->data->addBody(-140,$data);
        }
    }

}