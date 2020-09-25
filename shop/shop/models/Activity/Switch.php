<?php
if(!defined('ROOT_PATH'))
{
    exit('No Permission');
}

class Activity_Switch extends YLB_Model
{
        public $_cacheKeyPrefix  = 'c|ac_base|';
        public $_cacheName       = 'activity_switch';
        public $_tableName       = 'activity_switch';
        public $_tablePrimaryKey = 'ac_id';

        public function __construct(&$db_id = 'shop', &$user = null)
        {
            $this->_tableName = TABEL_PREFIX . $this->_tableName;
            $this->_cacheFlag = CHE;

            parent::__construct($db_id, $user);
        }


        public function getSwitch($goods_id = null, $sort_key_row = null)
        {
            $rows = array();
            $rows = $this->get($goods_id, $sort_key_row);

            return $rows;
        }


        public function addSwitch($field_row, $return_insert_id = false)
        {

            $add_flag = $this->add($field_row, $return_insert_id);

            return $add_flag;
        }

        public function editSwitch($goods_id = null, $field_row, $flag = true)
        {
            $update_flag = $this->edit($goods_id, $field_row, $flag);
            return $update_flag;
        }

        public function editSwitchFalse($goods_id = null, $field_row, $flag = false)
        {
            $update_flag = $this->edit($goods_id, $field_row, $flag);
            return $update_flag;
        }

        public function editSwitchSingleField($goods_id, $field_name, $field_value_new, $field_value_old)
        {
            $update_flag = $this->editSingleField($goods_id, $field_name, $field_value_new, $field_value_old);
            return $update_flag;
        }

        public function removeSwitch($goods_id)
        {
            $del_flag = $this->remove($goods_id);
            return $del_flag;
        }

}