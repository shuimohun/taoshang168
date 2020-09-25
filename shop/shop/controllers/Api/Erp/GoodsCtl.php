<?php
/**
 * Created by PhpStorm.
 * User: tech05
 * Date: 2016-11-2
 * Time: 10:08
 */
class Api_Erp_GoodsCtl extends Api_Controller{
    //erp同步商品
    public function listGoods()
    {
        $Goods_CommonModel = new Goods_CommonModel();
        $Goods_CommonModel->sql->setWhere('common_verify',1);

        if (request_string('endDate'))
        {
            $Goods_CommonModel->sql->setWhere('common_add_time',request_string('endDate'),'<=');
        }
        if (request_string('beginDate'))
        {
            $Goods_CommonModel->sql->setWhere('common_add_time',request_string('beginDate'),'>=');
        }
        if (request_string('goodsId'))
        {
            $Goods_CommonModel->sql->setWhere('common_id',explode(',',request_string('goodsId')),'IN');
        }
        if (request_string('goodsName'))
        {
            $Goods_CommonModel->sql->setWhere('common_name',explode(',',request_string('goodsName')),'IN');
        }
        if (request_string('goodsNumber'))
        {
            $Goods_CommonModel->sql->setWhere('common_code',explode(',',request_string('goodsNumber')),'IN');
        }
        if (request_string('goodsStatus')==1)
        {
            $Goods_CommonModel->sql->setWhere('common_state',1);
        }else if(request_string('goodsStatus')==2){
            $Goods_CommonModel->sql->setWhere('common_state',0);
        }
        if (request_row('store_account'))
        {
            $shop_account=request_row('store_account');
        }

        $User_BaseModel = new User_BaseModel();
        $User_BaseModel->sql->setWhere('user_account',$shop_account,'IN');
        $User_BaseModel->sql->setLimit(0,999999999);
        $User_Base = $User_BaseModel->getBase('*');
        $user_id  = array_column($User_Base,'user_id');

        $Shop_BaseModel = new Shop_BaseModel();
        $Shop_BaseModel->sql->setWhere('user_id',$user_id,'IN');
        $Shop_BaseModel->sql->setLimit(0,999999999);
        $Shop_Base = $Shop_BaseModel->getBase('*');
        $shop_id  = array_column($Shop_Base,'shop_id');

        $Goods_CommonModel->sql->setWhere('shop_id',$shop_id,'IN');
        $Goods_CommonModel->sql->setLimit(0,999999999);
        $goodscommon  = $Goods_CommonModel->getCommon('*');

        $Goods_BaseModel = new Goods_BaseModel();
        $Goods_BaseModel->sql->setLimit(0,999999999);
        $Goods_Base  = $Goods_BaseModel->getBase('*');

        $Base_DistrictModel = new Base_DistrictModel();
        $Base_DistrictModel->sql->setLimit(0,999999999);
        $Base_District  = $Base_DistrictModel->getDistrict('*');

        $data=array('count');
        if ($goodscommon)
        {
            foreach($goodscommon as $key=>$value){
                $User_id = $Shop_Base[$value['shop_id']]['user_id'];
                $data['count']+=1;
                $data['data'][$key]['productId']=$value['common_id'];
                $data['data'][$key]['cate']=$value['cat_name'];
                $data['data'][$key]['imageUrl']=$value['common_image'];
                $data['data'][$key]['productName']=$value['common_name'];
                $data['data'][$key]['price']=$value['common_price'];
                $data['data'][$key]['isShelves']=$value['common_state'];
                $data['data'][$key]['postPrice']=$value['common_freight'];
                $data['data'][$key]['area']='';
                if($value['common_location']){
                    foreach($value['common_location'] as $areaid){
                        $data['data'][$key]['area'].=$Base_District[$areaid]['district_name'];
                    }
                }
                $data['data'][$key]['shopId']=$value['shop_id'];
                $data['data'][$key]['shopName']=$value['shop_name'];
                $data['data'][$key]['member_name']=$User_Base[$User_id]['user_account'];
                $data['data'][$key]['stock']=$value['common_stock'];
                $data['data'][$key]['code']=$value['common_code'];
                $sku=array();

                foreach($Goods_Base as $k=>$v){
                    if($v['common_id']==$value['common_id']){
                        $sku[$k]['id']=$v['goods_id'];
                        $sku[$k]['pid']=$v['common_id'];
                        $sku[$k]['property_value_id']='';
                        $sku[$k]['setmeal']=$value['common_name'];
                        if($v['goods_spec']){
                            foreach($v['goods_spec'] as $goods_spec){
                                $sku[$k]['property_value_id']=implode(',',array_keys($goods_spec));
                                $sku[$k]['setmeal']=implode(',',array_values($goods_spec));
                            }
                        }
                        $sku[$k]['spec_id']= '';
                        $sku[$k]['spec_name']= '商品名称';
                        if($value['common_spec_name']){
                            $sku[$k]['spec_id']= implode(',',array_keys($value['common_spec_name']));
                            $sku[$k]['spec_name']= implode(',',array_values($value['common_spec_name']));

                        }

                        $sku[$k]['price']=$v['goods_price'];
                        $sku[$k]['market_price']=$v['goods_market_price'];
                        $sku[$k]['cost_price']=$value['common_cost_price'];
                        $sku[$k]['stock']=$v['goods_stock'];
                        $sku[$k]['sku']=$v['goods_code'];
                    }
                }
                $data['data'][$key]['sku']=$sku;
            }
            $status = 200;
            $msg    = _('success');
        }
        else
        {
            $status = 250;
            $msg    = _('没有满足条件的结果哦');
        }
//fb($data);
        $this->data->addBody(-140, $data, $msg, $status);
    }
}