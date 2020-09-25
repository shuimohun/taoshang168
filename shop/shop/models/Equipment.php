<?php
if(!defined('ROOT_PATH'))
{
    exit('No Permission');
}
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/7
 * Time: 10:37
 */

class Equipment extends YLB_Model
{
    public $_cacheKeyPrefix  = 'c|equipment|';
    public $_cacheName       = 'equipment';
    public $_tableName       = 'equipment';
    public $_tablePrimaryKey = 'id';

    public function __construct(&$db_id = 'shop', &$user = null)
    {
        $this->_tableName = TABEL_PREFIX . $this->_tableName;
        $this->_cacheFlag = CHE;

        parent::__construct($db_id, $user);
    }

    public function addBase($field_row, $return_insert_id = false)
    {
        $add_flag = $this->add($field_row, $return_insert_id);
        return $add_flag;
    }
}