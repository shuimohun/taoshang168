<?php
if(!defined('ROOT_PATH'))
{
    exit('No Permission');
}
/**
 * @author weidp
 */

class App_AndOne extends YLB_Model
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