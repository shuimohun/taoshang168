<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

class MonLater_GoodsModel extends MonLater_Goods
{
    public function __construct()
    {
        parent::__construct();
    }

    public function editMonLaterGoods($table_primary_key_value, $field_row, $flag)
    {
         return $this->edit($table_primary_key_value, $field_row, $flag);
    }

    public function addMonLaterGoods($field_row, $return_insert_id)
    {
        return $this->add($field_row, $return_insert_id);
    }
}