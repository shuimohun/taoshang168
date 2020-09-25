<?php
if(!defined('ROOT_PATH'))
{
    exit('No Permission');
}

class Activity_TempBase extends YLB_Model
{
    public $_cacheKeyPrefix  = 'c|ac_tempbase|';
    public $_cacheName       = 'activity_tempbase';
    public $_tableName       = 'activity_tempbase';
    public $_tablePrimaryKey = 'base_id';

    public function __construct(&$db_id = 'shop', &$user = null)
    {
        $this->_tableName = TABEL_PREFIX . $this->_tableName;
        $this->_cacheFlag = CHE;
        parent::__construct($db_id, $user);
    }


    public function getTempBase($goods_id = null, $sort_key_row = null)
    {
        $rows = array();
        $rows = $this->get($goods_id, $sort_key_row);
        return $rows;
    }


    public function addTempBase($field_row, $return_insert_id = false)
    {

        $add_flag = $this->add($field_row, $return_insert_id);

        return $add_flag;
    }

    public function editTempBase($goods_id = null, $field_row, $flag = true)
    {
        $update_flag = $this->edit($goods_id, $field_row, $flag);
        return $update_flag;
    }

    public function editTempBaseFalse($goods_id = null, $field_row, $flag = false)
    {
        $update_flag = $this->edit($goods_id, $field_row, $flag);
        return $update_flag;
    }

    public function editTempBaseSingleField($goods_id, $field_name, $field_value_new, $field_value_old)
    {
        $update_flag = $this->editSingleField($goods_id, $field_name, $field_value_new, $field_value_old);
        return $update_flag;
    }

    public function removeTempBase($goods_id)
    {
        $del_flag = $this->remove($goods_id);
        return $del_flag;
    }

}