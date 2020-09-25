<?php
if(!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * @author  weidp
 *
 */

class Api_App_FindShopCtl extends YLB_AppController
{
    public $adv_id = 19;
    public $Shop_Evaluation;
    public $Shop_Base;
    public $Adv_ConModel;
    public $Shop_ClassModel;
    public $Goods_CommonModel;

    public function __construct(&$ctl,$met,$typ)
    {
        parent::__construct($ctl,$met,$typ);

        $this->Shop_Evaluation = new Shop_EvaluationModel();
        $this->Shop_Base       = new Shop_BaseModel();
        $this->Adv_ConModel     = new Operation_AdvertisementModel();
        $this->Shop_ClassModel = new Shop_ClassModel();
        $this->Goods_CommonModel = new Goods_CommonModel();
    }

    public function getNav()
    {
        if(request_int('adv_id'))
        {
            $adv_con = $this->Adv_ConModel->getAdvList(array('group_id' => request_int('adv_id')));
        }
        else
        {
            $adv_con = $this->Adv_ConModel->getAdvList(array('group_id' => $this->adv_id));
        }


        $shop_class = $this->Shop_ClassModel->listClassWhere();

        if ($this->typ == 'json') {
            $data = array('nav' => $adv_con, 'cat' => $shop_class['items']);
            $this->data->addBody(-140, $data);
        }
    }

    public function shopGood()
    {
        $shop_id = request_int('shop_id');

        if(!$shop_id)
        {
            $data['items'] = false;
            if($this->typ == 'json')
            {
                $this->data->addBody(-140,$data);
                return;
            }
        }

        $shop_goods = $this->Goods_CommonModel->getHotSalle($shop_id,3);
        $shop_goods = $this->Goods_CommonModel->getRecommonRow($shop_goods);

        $shop_base = $this->Shop_Base->getOne($shop_id);

        $shop_base['goods'] = $shop_goods;

        if($this->typ == 'json')
        {
            $data['items'] = $shop_base;
            $this->data->addBody(-140,$data);
        }
    }



    public function niceShop()
    {
        $nav = request_int('sci');

        $shop_Evaluation = $this->Shop_Evaluation->selectEvalution('*',array(),'shop_id');

        foreach($shop_Evaluation['items'] as $key=>$value)
        {
            if($value['shop_id'])
            {
                $shop_id[] = $value['shop_id'];
            }
        }

        if($nav)
        {
            $arr = $this->Shop_Base->getBaseList(array('shop_id'=>$shop_id,'shop_class_id'=>$nav));
            foreach($arr['items'] as $key=>$value)
            {
                $id[] = $value['id'];
            }

            foreach($id as $key => $value)
            {
                $shop_base[$value] = $this->Shop_Base->getShopDetail($value);
            }
        }
        else
        {
            foreach($shop_id as $key => $value)
            {
                $shop_base[$value] = $this->Shop_Base->getShopDetail($value);
            }
        }

        foreach($shop_base as $key=>$value)
        {
            if($value['shop_status'] == 3)
            {
                $shop[] = $value;
            }
        }

        foreach($shop as $key=>$value)
        {
            $shop[$key]['ove_me'] = round((($value['shop_desc_scores']+$value['shop_service_scores']+$value['shop_send_scores'])/3)/5,2)*100;
        }

        $len = count($shop);
        for($k=1;$k<$len;$k++)
        {
            for($j=0;$j<$len-$k;$j++)
            {
                if($shop[$j]['ove_me'] > $shop[$j+1]['ove_me'])
                {
                    $temp = $shop[$j+1];
                    $shop[$j+1] = $shop[$j];
                    $shop[$j] = $temp;
                }
            }
        }

        if($this->typ == 'json')
        {
            $data['items'] = array_slice(array_reverse($shop),0,4);
            $this->data->addBody(-140,$data);
        }

    }

    //定是好店
    public function sureShop()
    {
        $nav = request_int('sci');
        $user_id = request_string('user_id');
        //page分页，一页默认10
        $YLB_Page           = new YLB_Page();
        $YLB_Page->listRows = 8;
        $rows              = $YLB_Page->listRows;
        $offset            = request_int('firstRow', 0);
        $page = ceil_r($offset / $rows);

        if($nav)
        {
           $shop_base = $this->Shop_Base->getBaseList(array('shop_class_id'=>$nav,'shop_status'=>3),array('shop_collect'=>'DESC'),$page,$rows);
        }
        else
        {
            $shop_base = $this->Shop_Base->getBaseList(array('shop_status'=>3),array('shop_collect'=>'DESC'),$page,$rows);
        }

        foreach($shop_base['items'] as $key=>$value)
        {
            $arr = $this->Goods_CommonModel->getNormalCommonList(array('shop_id'=>$value['shop_id']),array('common_collect'=>'DESC'),1,4,$user_id);

            $shop_base['items'][$key]['goods_total'] = $arr['totalsize'];

            foreach($arr['items'] as $k => $v)
            {
                $goods_id = $this->Goods_CommonModel->getNormalStateGoodsId($v['common_id']);
                $arr['items'][$k]['id_goods'] = $goods_id;
            }

            $shop_base['items'][$key]['common_goods'] = $arr['items'];
        }
        $YLB_Page->totalRows = $shop_base['totalsize'];
        $shop_base['pagesize'] = $YLB_Page->listRows;
        $shop_base['page_nav'] = $YLB_Page->prompt();

        if($this->typ == 'json')
        {
            $this->data->addBody(-140,$shop_base);
        }
    }

}