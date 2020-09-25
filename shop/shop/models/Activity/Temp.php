<?php
if(!defined('ROOT_PATH'))
{
    exit('No Permission');
}

class Activity_Temp extends YLB_Model
{
    public $_cacheKeyPrefix  = 'c|ac_temp|';
    public $_cacheName       = 'activity_temp';
    public $_tableName       = 'activity_temp';
    public $_tablePrimaryKey = 'temp_id';

    public function __construct(&$db_id = 'shop', &$user = null)
    {
        $this->_tableName = TABEL_PREFIX . $this->_tableName;
        $this->_cacheFlag = CHE;
        parent::__construct($db_id, $user);
    }


    public function getTemp($goods_id = null, $sort_key_row = null)
    {
        $rows = array();
        $rows = $this->get($goods_id, $sort_key_row);
        return $rows;
    }


    public function addTemp($field_row, $return_insert_id = false)
    {

        $add_flag = $this->add($field_row, $return_insert_id);

        return $add_flag;
    }

    public function editTemp($goods_id = null, $field_row, $flag = true)
    {
        $update_flag = $this->edit($goods_id, $field_row, $flag);
        return $update_flag;
    }

    public function editTempFalse($goods_id = null, $field_row, $flag = false)
    {
        $update_flag = $this->edit($goods_id, $field_row, $flag);
        return $update_flag;
    }

    public function editTempSingleField($goods_id, $field_name, $field_value_new, $field_value_old)
    {
        $update_flag = $this->editSingleField($goods_id, $field_name, $field_value_new, $field_value_old);
        return $update_flag;
    }

    public function removeTemp($goods_id)
    {
        $del_flag = $this->remove($goods_id);
        return $del_flag;
    }

}