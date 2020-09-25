<?php
if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * @author weidp
 */
class User_User extends YLB_Model
{
    public $_cacheKeyPrefix  = 'c|user_info|';
    public $_cacheName       = 'info';
    public $_tableName       = 'user_info';
    public $_tablePrimaryKey = 'user_id';

    public function __construct(&$db_id = 'shop', &$user = null)
    {
        $this->_tableName = TABEL_PREFIX . $this->_tableName;
        $this->_cacheFlag = CHE;
        parent::__construct($db_id, $user);
    }
}
