<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

class MonLater_BaseModel extends MonLater_Base
{
    const MONLATER_BASE_OPEN = 1;
    const MONLATER_BASE_CLOSE = 2;
    public $MonLaterGoods = null;
    public $GoodsCommonModel = null;
    public $type = null;
    public $status = null;
    public function __construct()
    {
        parent::__construct();
        $this->MonLaterGoods = new MonLater_GoodsModel();
        $this->GoodsCommonModel = new Goods_CommonModel();
        $this->type = array('1'=>'早市','2'=>'晚市');
        $this->status = array('1'=>'正常','2'=>'过期');
    }

    //获取活动列表（按结束时间排序）
    public function getMonLaterList()
    {
        $shop_id = perm::$shopId;
        $first = array_merge($this->getByWhere(array('shop_id'=>$shop_id,'monlater_state'=>self::MONLATER_BASE_OPEN)));

    }
    public function addMonLater($field_row, $return_insert_id)
    {
        return $this->add($field_row, $return_insert_id);
    }

    public function editMonLater($table_primary_key_value, $field_row)
    {
        return $this->edit($table_primary_key_value, $field_row);
    }
    //获取早晚市活动以及活动商品详情
    public function getMonLaterDetail($monlater_id)
    {
        $row = array();
        $cond_row['monlater_id'] = $monlater_id;
        $cond_row['monlater_goods_state'] =self::MONLATER_BASE_OPEN;
        $row = $this->getOne($cond_row);
        $row['type_name'] = $this->type[$row['monlater_type']];
        $row['status_name'] = $this->status[$row['monlater_state']];
        $row['goods'] = array_merge($this->MonLaterGoods->getByWhere($cond_row));

        return $row;
    }

    //获取活动下下有效商品数量
    public function MonLaterNomalGoods($monlater_id)
    {
        $cond_row['monlater_id'] = $monlater_id;
        $cond_row['monlater_goods_state'] = self::MONLATER_BASE_OPEN;
        $data = $this->MonLaterGoods->listByWhere($cond_row);
        return $data['totalsize'];
    }

}