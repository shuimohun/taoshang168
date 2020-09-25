<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}


class MonLater_Base extends YLB_Model
{
    public $_cacheKeyPrefix  = 'c|monlater_base|';
    public $_cacheName       = 'monlater';
    public $_tableName       = 'monlater_base';
    public $_tablePrimaryKey = 'monlater_id';

    public function __construct(&$db_id = 'shop', &$user = null)
    {
        $this->_tableName = TABEL_PREFIX . $this->_tableName;
        $this->_cacheFlag = CHE;
        parent::__construct($db_id, $user);
    }


}