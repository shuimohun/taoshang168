<?php
if(!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * @author  weidp
 *
 */

class Api_App_AndOneCtl extends YLB_AppController
{
    public $adv_id = 9;
    public $next_adv_id =10;
    public $there_adv_id =15;
    public $Increase_BaseModel  = null;
    public $Increase_ComboModel = null;
    public $Increase_RedempGoodsModel = null;
    public $Increase_RuleModel   = null;
    public $Goods_CatModel    = null;
    public $Goods_CatNavModel = null;
    public $Adv_ConModel     = null;
    public $Goods_BaseModel = null;

    public function __construct(&$ctl, $met, $typ)
    {
        parent::__construct($ctl, $met, $typ);

        $this->Increase_BaseModel = new Increase_BaseModel();
        $this->Increase_ComboModel = new Increase_ComboModel();
        $this->Increase_RedempGoodsModel = new Increase_RedempGoodsModel();
        $this->Increase_RuleModel = new Increase_RuleModel();
        $this->Goods_CatModel    = new Goods_CatModel();
        $this->Goods_CatNavModel = new Goods_CatNavModel();
        $this->Goods_BaseModel = new Goods_BaseModel();
        $this->Adv_ConModel     = new Operation_AdvertisementModel();
    }

    //获取导航和轮播
    public function getNav()
    {
        $adv_con = $this->Adv_ConModel->getAdvList(array('group_id' => $this->adv_id));

        $next_adv_con = $this->Adv_ConModel->getAdvList(array('group_id' => $this->next_adv_id));

        $there_adv_con = $this->Adv_ConModel->getAdvList(array('group_id' => $this->there_adv_id));

        $cat_con = $this->Goods_CatModel->getCatList(array('cat_parent_id' => '0'));

        foreach ($cat_con['items'] as $key => $value) {

            $cat_id[] = $value['cat_id'];
        }

        $cat_nav = $this->Goods_CatNavModel->getCatByIds('goods_cat_id', $cat_id);

        if ($this->typ == 'json') {

            $data['items'] = array('nav' => $adv_con, 'cat' => array_merge($cat_nav),'next_nav'=>$next_adv_con,'there_nav'=>$there_adv_con);
            $this->data->addBody(-140, $data);
        }
    }

    //获取加一购商品
    public function getPlusGoods()
    {
        $plus = request_int('plus');
        $nav  = request_int('nav');

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

        $increase_base = $this->Increase_BaseModel->getIncreaseActList(array('increase_state'=>'1'));

        foreach($increase_base['items'] as $key=>$value)
        {
            if(strtotime($value['increase_start_time']) > time())
            {
                unset($increase_base[$key]);
            }
            else
            {
                $increase_id[]= $value['increase_id'];
            }

        }

        $increase_goods = $this->Increase_BaseModel->getPlusOneDetail($increase_id,$plus,$cat_id);

        $count_salenum = 0;

        //获取商品后排序
        foreach($increase_goods as $key=>$value)
        {
            if($value['goods'])
            {
                if(count($value['goods']) >= 4 && count($value['rule'][0]['redemption_goods']) >= 2)
                {
                    $increase_goods[$key]['goods'] = array_slice(array_merge($value['goods']),0,4);
                    $increase_goods[$key]['rule'][0]['redemption_goods']  = array_slice(array_merge($value['rule'][0]['redemption_goods']),0,2);
                    $increase_goods[$key]['temp'] = 6;
                }
                else if(count($value['goods']) >= 4 && count($value['rule'][0]['redemption_goods']) == 1)
                {
                    $increase_goods[$key]['goods'] = array_slice(array_merge($value['goods']),0,4);
                    $increase_goods[$key]['rule'][0]['redemption_goods']  = array_slice(array_merge($value['rule'][0]['redemption_goods']),0,1);
                    $increase_goods[$key]['temp'] = 5;
                }
                else if(count($value['goods']) < 4 && count($value['goods']) > 1 && count($value['rule'][0]['redemption_goods']) >= 1)
                {
                    $increase_goods[$key]['goods'] = array_slice(array_merge($value['goods']),0,2);
                    $increase_goods[$key]['rule'][0]['redemption_goods']  = array_slice(array_merge($value['rule'][0]['redemption_goods']),0,1);
                    $increase_goods[$key]['temp'] = 3;
                }
                else if(count($value['goods']) == 1 && count($value['rule'][0]['redemption_goods']) >= 1)
                {
                    $increase_goods[$key]['goods'] = array_slice(array_merge($value['goods']),0,1);
                    $increase_goods[$key]['rule'][0]['redemption_goods']  = array_slice(array_merge($value['rule'][0]['redemption_goods']),0,1);
                    $increase_goods[$key]['temp'] = 2;
                }

                foreach($increase_goods[$key]['goods'] as $k=>$v)
                {
                    $count_salenum += $v['goods_salenum'];
                }

                $increase_goods[$key]['count_salenum'] = $count_salenum;
            }
            else
            {
                unset($increase_goods[$key]);
            }
        }

        //冒泡排序
        $increase_goods = array_merge($increase_goods);

        $len = count($increase_goods);
        for($k=0;$k<=$len;$k++)
        {
            for($j=$len-1;$j>$k;$j--){
                if($increase_goods[$j]['count_salenum'] <$increase_goods[$j-1]['count_salenum']){
                    $temp = $increase_goods[$j];
                    $increase_goods[$j] = $increase_goods[$j-1];
                    $increase_goods[$j-1] = $temp;
                }
            }
        }

      if($this->typ == 'json')
      {
          //反转数据
          $data['items'] = array_reverse($increase_goods);
          $this->data->addBody(-140,$data);
      }
    }

    //更多换购商品
    public function getRedempGoods()
    {
        $rule_id = request_int('rule');

        $redemp_price = request_int('price');

        $cond_row['rule_id'] = $rule_id;

        if($redemp_price)
        {
            $cond_row['redemp_price'] = $redemp_price;
        }

        $Redemp_base = $this->Increase_RedempGoodsModel->getIncreaseRedempGoodsByWhere($cond_row);

        foreach($Redemp_base as $key=>$value)
        {
            $goods_id[] = $value['goods_id'];
        }

        $goods_base = $this->Goods_BaseModel->getGoodsListByGoodId($goods_id);

        if(count($goods_base) == count($Redemp_base))
        {
            foreach($Redemp_base as $key=>$value)
            {
                $Redemp_base[$key]['goods_image'] = $goods_base[$value['goods_id']]['goods_image'];
                $Redemp_base[$key]['goods_name'] = $goods_base[$value['goods_id']]['goods_name'];
                $Redemp_base[$key]['goods_price'] = $goods_base[$value['goods_id']]['goods_price'];
                $Redemp_base[$key]['goods_promotion_price'] = $goods_base[$value['goods_id']]['goods_promotion_price'];
                $Redemp_base[$key]['goods_share_price'] = $goods_base[$value['goods_id']]['goods_share_price'];
            }
        }

       if($this->typ == 'json')
       {
           $data['items'] = array_merge($Redemp_base);
           $this->data->addBody(-140,$data);
       }

    }





}