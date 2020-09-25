<?php
if(!defined('ROOT_PATH'))
{
    exit('No Permission');
}

class Api_App_FreshCtl extends YLB_AppController
{
    public $top_id = 2355;
    public $slider_id = 17;
    public $gift_id  = 18;
    public $Goods_CatModel;
    public $Goods_CatNavModel;
    public $Adv_ConModel;
    public $Base_district;
    public $Goods_CommonModel;
    public $Goods_BaseModel;


    public function __construct(&$ctl,$met,$typ)
    {
        parent::__construct($ctl,$met,$typ);
        $this->Goods_CatModel = new Goods_CatModel();
        $this->Goods_CatNavModel = new Goods_CatNavModel();
        $this->Adv_ConModel  = new Operation_AdvertisementModel();
        $this->Base_district = new Base_DistrictModel();
        $this->Goods_CommonModel = new Goods_CommonModel();
        $this->Goods_BaseModel = new Goods_BaseModel();

    }

    //轮播礼盒分类图标
    public function getSliderGoods()
    {

        $adv_slider = $this->Adv_ConModel->getAdvList(array('group_id'=>$this->slider_id));

        $adv_gift   = $this->Adv_ConModel->getAdvList(array('group_id'=>$this->gift_id));

        $cat = $this->Goods_CatModel->getCatList(array('cat_parent_id'=>$this->top_id));

        foreach($cat['items'] as $key=>$value)
        {
            $cat_id[] = $value['cat_id'];
        }

        $cat_nav = $this->Goods_CatNavModel->getCatNavList(array('goods_cat_id:IN'=>$cat_id));

        foreach($cat_nav['items'] as $key=>$value)
        {
            foreach($cat['items'] as $k=>$v)
            {
                if($value['goods_cat_id'] == $cat['items'][$k]['cat_id'])
                {
                    $cat_nav['items'][$key]['cat_pic'] = $cat['items'][$k]['cat_pic'];
                }
            }

        }

        if($this->typ == 'json')
        {
            $data['slider'] = $adv_slider['items'];
            $data['gift'] = $adv_gift['items'];
            $data['cat']  = $cat_nav['items'];
            $this->data->addBody(-140,$data);
        }
    }

    //楼层数据
    public function floorGoods()
    {   //获取地址
        $addr = request_string('addr');

        switch ($addr)
        {
            case 1:
                $addr = '华北';
                break;
            case 2:
                $addr = '东北';
                break;
            case 3:
                $addr = '华东';
                break;
            case 4:
                $addr = '华南';
                break;
            case 5:
                $addr = '华中';
                break;
            case 6:
                $addr = '西南';
                break;
            case 7:
                $addr = '西北';
                break;
        }

        if($addr)
        {
            $district = $this->Base_district->getDistrictList(array('district_region'=>$addr));
            foreach ($district['items'] as $key=>$value)
            {
                $district_id[]= $value['district_id'];
            }
        }

        $cat = $this->Goods_CatModel->getChildCat($this->top_id);

        foreach($cat as $key=>$value)
        {
            $cat_id[] = $value['cat_id'];
            if($value['child'])
            {
                foreach($value['child'] as $k=>$v)
                {
                    $cat_id[] = $v['cat_id'];
                }
            }

        }

        $catNav = $this->Goods_CatNavModel->getCatNavList(array('goods_cat_id:IN'=>$cat_id));

        $CommonGoods = $this->Goods_CommonModel->getCommonCont(array('cat_id:IN'=>$cat_id,'common_state'=>1,'common_verify'=>1));

        if($district_id)
        {
            foreach($district_id as $key=>$value)
            {
                foreach($CommonGoods as $k=>$v)
                {
                if($value == $v['common_location'][0])
                {
                    $CommonGood[] = $v;
                }

                }
            }

            foreach($CommonGood as $key=>$value)
            {
                if($value)
                {
                    $common[$key]=$value;
                }

            }

        }
        else
        {

            $common = $CommonGoods;
        }

        //循环数组分配商品数据
       for($i=0;$i<count($catNav['items']);$i++)
       {
           $child_cat = $this->Goods_CatModel->getChildCat($catNav['items'][$i]['goods_cat_id']);

           foreach($child_cat as $k=>$v)
           {
               $child_id[]= $v['cat_id'];
           }

           foreach($common as $kk=>$vv)
           {
               if(in_array($vv['cat_id'],$child_id))
               {
                   $catNav['items'][$i]['goods_cont'][] = $vv;
               }
           }

            unset($child_id);
       }

        $arr = $catNav['items'];

        //合并蛋类和熟肉(此处有bug非动态，根据数据表中的id来计算的key，若要写动态则情况太多)
        foreach($arr as $key=>$value)
        {
            if(!$value['goods_cat_nav_pic'])
            {
                if($arr[$key+1]['goods_cont'])
                {
                    $arr[$key+1]['goods_cont'] = array_merge($arr[$key+1]['goods_cont'],$value['goods_cont']);
                }
                else
                {
                    $arr[$key+1]['goods_cont'] = array();
                    $arr[$key+1]['goods_cont'] = array_merge($arr[$key+1]['goods_cont'],$value['goods_cont']);
                }

                unset($arr[$key]);
            }
        }

        $arr = array_merge($arr);

        foreach($arr as $key=>$value)
        {
            if($value['goods_cont'])
            {
                $len = count($arr[$key]['goods_cont']);
                for($k=0;$k<=$len;$k++)
                {
                    for($j=$len-1;$j>$k;$j--){
                        if($arr[$key]['goods_cont'][$j]['common_salenum'] < $arr[$key]['goods_cont'][$j-1]['common_salenum']){
                            $temp = $arr[$key]['goods_cont'][$j];
                            $arr[$key]['goods_cont'][$j] = $arr[$key]['goods_cont'][$j-1];
                            $arr[$key]['goods_cont'][$j-1] = $temp;
                        }
                    }
                }
                $arr[$key]['goods_cont'] = array_slice(array_reverse($arr[$key]['goods_cont']),0,6);
            }
        }

      if($this->typ == 'json')
      {
        $data['items'] = $arr;
        $this->data->addBody(-140,$data);
      }

    }

    //大家都在买(按星级和评价数排序)
    public function saleNumGood()
    {
        //获取地址
        $addr = request_string('addr');
        $page = request_string('page');
        if(!$page)
        {
            $page = 1;
        }
        switch ($addr)
        {
            case 1:
                $addr = '华北';
                break;
            case 2:
                $addr = '东北';
                break;
            case 3:
                $addr = '华东';
                break;
            case 4:
                $addr = '华南';
                break;
            case 5:
                $addr = '华中';
                break;
            case 6:
                $addr = '西南';
                break;
            case 7:
                $addr = '西北';
                break;
        }

        if($addr)
        {
            $district = $this->Base_district->getDistrictList(array('district_region'=>$addr));
            foreach ($district['items'] as $key=>$value)
            {
                $district_id[]= $value['district_id'];
            }
        }

        $cat = $this->Goods_CatModel->getChildCat($this->top_id);

        foreach($cat as $key=>$value)
        {
            $cat_id[] = $value['cat_id'];
            if($value['child'])
            {
                foreach($value['child'] as $k=>$v)
                {
                    $cat_id[] = $v['cat_id'];
                }
            }

        }

        $base = $this->Goods_BaseModel->getBaseList(array('cat_id:IN'=>$cat_id,'goods_is_shelves'=>1),array('goods_evaluation_good_star'=>'DESC','goods_evaluation_count'=>'DESC'),$page);

        foreach($base['items'] as $key=>$value)
        {
            $common_id[]= $value['common_id'];
        }

        $common_id = array_unique($common_id);

        if($district_id)
        {

            foreach ($district_id as $key=>$value)
            {
                $CommonGood[] = $this->Goods_CommonModel->getCommonCont(array('common_location:LIKE'=>'%'.$value.'%','common_id'=>$common_id,'common_state'=>1,'common_verify'=>1));
            }

            foreach($CommonGood as $key=>$value)
            {
                if($value)
                {
                    foreach($value as $k=>$v)
                    {
                        $common[] = $v;
                    }
                }
            }
        }
        else
        {

            $CommonGood = $this->Goods_CommonModel->getCommonList(array('common_id:IN'=>$common_id,'common_state'=>1,'common_verify'=>1));
            $common = $CommonGood['items'];
        }

        foreach($common_id as $key=>$value)
        {
            foreach($common as $k=>$v)
            {
                if($value == $v['common_id'])
                {
                    $data['items'][] = $v;
                }
            }
        }

       if($this->typ == 'json')
       {
           $this->data->addBody(-140,$data);
       }
    }
}