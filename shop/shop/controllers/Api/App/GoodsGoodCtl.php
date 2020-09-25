<?php
if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

class Api_App_GoodsGoodCtl extends YLB_AppController
{
    //广告位id
    public  $adv_id = 16;
    public $Adv_ConModel;
    public $Goods_CatModel;
    public $Goods_CatNavModel;
    public $Goods_CommonModel;
    public $Goods_BaseModel;
    public $Goods_EvaluationModel;

    public function __construct(&$ctl,$met,$typ)
    {
        parent::__construct($ctl,$met,$typ);
        $this->Adv_ConModel = new Operation_AdvertisementModel();
        $this->Goods_CatModel = new Goods_CatModel();
        $this->Goods_CatNavModel = new Goods_CatNavModel();
        $this->Goods_CommonModel = new Goods_CommonModel();
        $this->Goods_BaseModel = new Goods_BaseModel();
        $this->Goods_EvaluationModel = new Goods_EvaluationModel();
    }

    public function getNav()
    {
        $adv_con = $this->Adv_ConModel->getBrandList(array('group_id' => $this->adv_id));

//        $cat_con = $this->Goods_CatModel->getCatList(array('cat_parent_id' => '0'));
//
//        foreach ($cat_con['items'] as $key => $value) {
//
//            $cat_id[] = $value['cat_id'];
//        }
//
//        $cat_nav = $this->Goods_CatNavModel->getCatByIds('goods_cat_id', $cat_id);
        $fl_sql = "select gc.goods_cat_nav_name as name,gc.goods_cat_id as cat_id,cat.cat_pic as pic from ylb_goods_cat as cat LEFT JOIN
                ylb_goods_cat_nav gc ON cat.cat_id = gc.goods_cat_id where cat.cat_parent_id = 0";
        $cat_nav = $this->Goods_CatModel->sql($fl_sql);

        if ($this->typ == 'json') {

            $data['items'] = array('nav' => $adv_con, 'cat' => $cat_nav);

            $this->data->addBody(-140, $data);
        }
    }

    //只取有评价的
    public function getGoodsGoodCont()
    {
        $nav  = request_int('nav');
        //分页每页100条
        $page = request_int('page');

        $goodsCatModel = new Goods_CatModel();
        if ($nav) {
            $cat = $goodsCatModel->getCatChildId($nav);
        }
        if(!$page)
        {
            $page = 1;
        }

        if($cat)
        {
            $BaseGoods = $this->Goods_BaseModel->getBaseList(array('cat_id'=>$cat,'goods_is_shelves'=>1),array('goods_evaluation_good_star'=>'DESC','goods_evaluation_count'=>'DESC'),$page);
        }
        else
        {
            $BaseGoods = $this->Goods_BaseModel->getBaseList(array('goods_is_shelves'=>1),array('goods_evaluation_good_star'=>'DESC','goods_evaluation_count'=>'DESC'),$page);
        }

        foreach($BaseGoods['items'] as $key=>$value)
        {
            $common_id[]= $value['common_id'];
        }

        $common_id = array_unique($common_id);

       $Eva = $this->Goods_EvaluationModel->getEvaluationList(array('common_id:IN'=>$common_id,'status:IN'=>array(1,2),'scores:IN'=>array(5,4)),array('evaluation_goods_id'=>'ASC','scores'=>'DESC'));

       //按照正确的顺序排序
       foreach($common_id as $key=>$value)
       {
           foreach($Eva['items'] as $k=>$v)
           {
                foreach($v as $kk=> $vv)
                {
                    if($value == $vv['common_id'])
                    {
                        $arr[$key][] = $vv;
                    }
                }
           }
       }

        //根据商品评价是否有图片来判断出现一条还是两条评价
       foreach($arr as $key=>$value)
       {

           if(count($value[0]['image_row']) > 0)
           {

               $data['items'][] = array_slice($value,0,1);
           }
           else
           {
                $data['items'][] = array_slice($value,0,2);
           }
       }

     if(!$data['items'])
     {
         $data=array();
     }
      if($this->typ == 'json')
      {
          $this->data->addBody(-140,$data);
      }

    }




}