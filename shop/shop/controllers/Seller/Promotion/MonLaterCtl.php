<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

class Seller_Promotion_MonLaterCtl extends Seller_Controller
{
    const OPEN = 1;
    const CLOSE = 2;
    public $MonLaterBaseModel  = null;
    public $MonLaterGoodsModel = null;
    public $ShopBaseModel      = null;
    public $GoodsCommonModel   = null;
    public $GoodsCatModel      = null;
    public $shop_info          = null;
    public $mansong            = null;

    public function __construct(&$ctl, $met, $typ)
    {
        parent::__construct($ctl, $met, $typ);

        $this->MonLaterBaseModel =  new MonLater_BaseModel();
        $this->MonLaterGoodsModel = new MonLater_GoodsModel();
        $this->ShopBaseModel      = new Shop_BaseModel();
        $this->GoodsCommonModel   = new Goods_CommonModel();
        $this->GoodsCatModel     = new Goods_CatModel();
        $this->shop_info          = $this->ShopBaseModel->getOne(perm::$shopId);
        $this->mansong            = new ManSong_BaseModel();

    }

    public function index()
    {
        $cond_row['shop_id'] = perm::$shopId;

        if(request_string('op') == 'edit' && request_int('id'))
        {
            $cond_row['monlater_id'] = request_int('id');
            $cond_row['shop_id']     = perm::$shopId;
            $data = $this->MonLaterBaseModel->getOneByWhere($cond_row);
            $this->view->setMet('edit');
        }

        if(request_string('op') == 'manage' && request_int('id'))
        {
            $monlater_id = request_int('id');

            $check_row = $this->MonLaterBaseModel->getOne($monlater_id);

            if($check_row['shop_id'] == Perm::$shopId)
            {
                $data = $this->MonLaterBaseModel->getMonLaterDetail($monlater_id);
            }
            else
            {
                location_to('index.php?ctl=Seller_Promotion_MonLater&met=index&typ=e');
            }

            $this->view->setMet('manage');
        }
        else
        {
            $cond_row['monlater_state'] = self::OPEN;
            $data = $this->MonLaterBaseModel->getOneByWhere($cond_row);

            if($data['monlater_type'] == 1)
            {
                $data['type_name'] = '早市';
            }
            elseif($data['monlater_type'] == 2)
            {
                $data['type_name'] = '晚市';
            }

            if($data['monlater_state'] == 1)
            {
                $data['state_name'] = '显示';
            }
            elseif($data['monlater_state'] == 2)
            {
                $data['state_name'] = '未激活';
            }

        }

        if($this->typ == 'json')
        {
            $this->data->addBody(-140,$data);
        }
        else
        {
            include $this->view->getView();
        }

    }

    public function add()
    {
        include $this->view->getView();
    }

    public function addMonLater()
    {
        $data = array();

        $field_row['monlater_name'] = request_string('monlater_name');
        $field_row['monlater_type'] = request_int('monlater_type');
        $field_row['shop_id']       = perm::$shopId;
        $field_row['shop_name']     = $this->shop_info['shop_name'];
        $field_row['monlater_add_time'] = date('Y-m-d H:i:s',time());
        $field_row['monlater_state']    = self::OPEN;

        $monlater_id = $this->MonLaterBaseModel->addMonLater($field_row,true);

        if($monlater_id)
        {
            $flag = true;
            $data['monlater_id'] = $monlater_id;
        }

        if ($flag)
        {
            $msg    = _('添加成功！');
            $status = 200;
        }
        else
        {
            $msg    = _('添加失败！');
            $status = 250;
        }

        $this->data->addBody(-140, $data, $msg, $status);
    }

    public function getShopGoods()
    {
        $cat_id = 2355;
        $cond_row = array();
        $monlater_id = request_int('monlater_id');

        if(!$monlater_id)
        {
            //有且只有唯一一个活动
            if(perm::$shopId)
            {
                $cond_base['monlater_state'] = self::OPEN;
                $cond_base['shop_id'] = perm::$shopId;
                $base = $this->MonLaterBaseModel->getOneByWhere($cond_base);
                $monlater_id = $base['monlater_id'];
            }
        }

        //分页
        $YLB_Page           = new YLB_Page();
        $YLB_Page->listRows = request_int('listRows')?request_int('listRows'):12;
        $rows              = $YLB_Page->listRows;
        $offset            = request_int('firstRow', 0);
        $page              = ceil_r($offset / $rows);


        $cond_row['shop_id'] = Perm::$shopId;
        $cond_row['cat_pid'] = $cat_id;

        $common_name = request_string('common_name');

        if ($common_name)
        {
            $cond_row['common_name:LIKE'] = "%".$common_name . "%";
        }

        $Goods_CommonModel = new Goods_CommonModel();
        $data              = $Goods_CommonModel->getNormalCommonList($cond_row, array('common_id' => 'DESC'), $page, $rows);


        $cond_row_goods['monlater_goods_state'] = self::OPEN;
        $cond_row_goods['shop_id'] = perm::$shopId;
        $cond_row_goods['monlater_id'] = $monlater_id;

        $monlater_goods = $this->MonLaterGoodsModel->getByWhere($cond_row_goods);

        $monlater_goods_id = array_column($monlater_goods,'common_id');

        if($monlater_goods_id)
        {
            foreach($data['items'] as $key=>$value)
            {
                if(in_array($value['common_id'],$monlater_goods_id))
                {
                    $data['items'][$key]['is_monlater_state'] = 'true';
                }

            }
        }

        $YLB_Page->totalRows = $data['totalsize'];
        $page_nav           = $YLB_Page->prompt();


        if('json' == $this->typ)
        {
            $this->data->addBody(-140, $data);
        }
        else
        {
            include $this->view->getView();
        }

    }

    public function addMonLaterGoods()
    {
        $monlater_id = request_int('monlater_id');
        $shop_id = perm::$shopId;
        $man = $this->mansong->getOneByWhere(array('shop_id'=>$shop_id,'mansong_state'=>self::OPEN));
        $is_man = $man?1:0;
        //先查询该活动下的商品数量
        $num = $this->MonLaterBaseModel->MonLaterNomalGoods($monlater_id);
        $monlater_base = $this->MonLaterBaseModel->getOne($monlater_id);
        $shop_base = $this->ShopBaseModel->getOne($shop_id);
        if($num < 5)
        {
            $common_id = request_int('common_id');
            $common_name = request_string('common_name');
            $common_image = request_string('common_image');
            $common_salenum = request_string('common_salenum');
            $common_data = $this->GoodsCommonModel->getOne($common_id);
            //查询活动中以前是够添加过类似商品
            $monlater_goods = $this->MonLaterGoodsModel->getOneByWhere(array('common_id'=>$common_id,'monlater_id'=>$monlater_id));

            if($monlater_goods)
            {
                $table_primary_key_value  = $monlater_goods['monlater_goods_id'];
                $field_row['common_name'] = $common_data['common_name'];
                $field_row['common_image'] = $common_data['common_image'];
                $field_row['common_salenum'] = $common_data['common_salenum'];
                $field_row['common_share_price'] = $common_data['common_share_price'];
                $field_row['common_shared_price'] =  $common_data['common_shared_price'];
                $field_row['common_promotion_price'] = $common_data['common_promotion_price'];
                $field_row['common_price']        = $common_data['common_price'];
                $field_row['shop_name']          = $shop_base['shop_name'];
                $field_row['monlater_type'] = $monlater_base['monlater_type'];
                $field_row['monlater_goods_state'] = self::OPEN;
                $field_row['monlater_goods_state_date'] = date('Y-m-d H:i:s',time());
                $field_row['is_man'] = $is_man;
                $flag = $this->MonLaterGoodsModel->editMonLaterGoods($table_primary_key_value,$field_row);

                if($flag)
                {
                    $data['monlater_goods_id'] = $monlater_goods['monlater_goods_id'];
                    $msg = 'success';
                    $status = 200;
                }
                else
                {
                    $data =  array();
                    $msg = '操作失败';
                    $status = 250;
                }
            }
            else
            {
                $field_row['common_name'] = $common_name;
                $field_row['common_image'] = $common_image;
                $field_row['common_salenum'] = $common_salenum;
                $field_row['common_share_price'] = $common_data['common_share_price'];
                $field_row['common_shared_price'] =  $common_data['common_shared_price'];
                $field_row['common_promotion_price'] = $common_data['common_promotion_price'];
                $field_row['common_price']        = $common_data['common_price'];
                $field_row['monlater_goods_state'] = self::OPEN;
                $field_row['shop_id']  = $shop_base['shop_id'];
                $field_row['shop_name'] = $shop_base['shop_name'];
                $field_row['common_id'] = $common_data['common_id'];
                $field_row['monlater_id'] = $monlater_id;
                $field_row['monlater_type'] = $monlater_base['monlater_type'];
                $field_row['monlater_add_goods_time'] = date('Y-m-d H:i:s',time());
                $field_row['is_man'] = $is_man;
                $flag = $this->MonLaterGoodsModel->addMonLaterGoods($field_row,true);
                if($flag)
                {
                    $data['monlater_goods_id'] = $flag;
                    $msg = 'success';
                    $status = 200;
                }
                else
                {
                    $data =  array();
                    $msg = '操作失败';
                    $status = 250;
                }
            }

        }
        else
        {
            $data  = array();
            $msg   = '操作失败，已有五件商品';
            $status = 250;
        }

        $this->data->addBody(-140,$data,$msg,$status);
    }

    public function removeMonLaterGoods()
    {
        $monlater_goods_id = request_int('id');
        $check_right       = $this->MonLaterGoodsModel->getOne($monlater_goods_id);

        if ($check_right['shop_id'] == Perm::$shopId)
        {

            $field_row['monlater_goods_state'] = self::CLOSE;
            $field_row['monlater_goods_state_date'] = date('Y-m-d H:i:s',time());

            $flag =  $this->MonLaterGoodsModel->editMonLaterGoods($monlater_goods_id,$field_row);

            if ($flag)
            {
                $msg    = _('删除成功');
                $status = 200;

            }
            else
            {
                $msg    = _('删除失败');
                $status = 250;
            }
        }
        else
        {
            $msg    = _('删除失败');
            $status = 250;
        }

        $data['monlater_goods_id'] = $monlater_goods_id;

        $this->data->addBody(-140, $data, $msg, $status);
    }

    public function editMonLater()
    {

        if(request_int('monlater_id'))
        {
            $id = request_int('monlater_id');
            $field_row['monlater_name'] = request_string('monlater_name');
            $field_row['monlater_type'] = request_int('monlater_type');
            $monlater_goods = $this->MonLaterGoodsModel->getByWhere(array('monlater_id'=>$id,'shop_id'=>perm::$shopId,'monlater_goods_state'=>self::OPEN));

            $this->MonLaterGoodsModel->sql->startTransactionDb();//事务开启

            if($monlater_goods)
            {
                foreach($monlater_goods as $key=>$value)
                {

                    $this->MonLaterGoodsModel->editMonLaterGoods($value['monlater_goods_id'],array('monlater_type'=>request_string('monlater_type'),'monlater_goods_state_date'=>date('Y-m-d H:i:s',time())));
                }
            }


            $flag = $this->MonLaterBaseModel->editMonLater($id,$field_row);

            if($flag && $this->MonLaterGoodsModel->sql->commitDb())
            {

                $data['monlater_id'] = $flag;
                $msg = 'success';
                $status = 200;
            }
            else
            {

                $data = array();
                $msg = '操作失败,请修改后提交';
                $status = 250;
            }
        }
        else
        {
            $data = array();
            $msg = '操作失败';
            $status = 250;
        }

        $this->data->addBody(-140,$data,$msg,$status);
    }

    public function removeMonLater()
    {
        $monlater_id = request_int('id');

        $shop_id     = perm::$shopId;

        if($monlater_id && $shop_id)
        {
            $cond_row['monlater_id'] = $monlater_id;

            $cond_row['shop_id']    = $shop_id;

            $cond_row['monlater_goods_state'] = self::OPEN;

            $monlater_goods = $this->MonLaterGoodsModel->getByWhere($cond_row);

            $this->MonLaterGoodsModel->sql->startTransactionDb();//开启事务

            if($monlater_goods)
            {
                foreach($monlater_goods as $key=>$value)
                {

                    $this->MonLaterGoodsModel->editMonLaterGoods($value['monlater_goods_id'],array('monlater_goods_state'=>self::CLOSE,'monlater_goods_state_date'=>date('Y-m-d H:i:s',time())));
                }
            }

            $flag = $this->MonLaterBaseModel->editMonLater($monlater_id,array('monlater_state'=>self::CLOSE,'monlater_end_time'=>date('Y-m-d H:i:s',time())));

            if ($flag && $this->MonLaterGoodsModel->sql->commitDb())
            {
                $msg    = _('删除成功！');
                $status = 200;
            }
            else
            {

                $msg    = _('删除失败！');
                $status = 250;
            }

            $data['monlater_id'] = $monlater_id;

            $this->data->addBody(-140, $data, $msg, $status);
        }
    }

}