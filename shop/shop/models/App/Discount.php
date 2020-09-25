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

class App_Discount extends YLB_Model
{
    public $_cacheKeyPrefix  = 'c|increase_base|';
    public $_cacheName       = 'increase';
    public $_tableName       = 'increase_base';
    public $_tablePrimaryKey = 'increase_id';

    public function __construct(&$db_id = 'shop', &$user = null)
    {
        $this->_tableName = TABEL_PREFIX . $this->_tableName;
        $this->_cacheFlag = CHE;

        parent::__construct($db_id, $user);
    }
}