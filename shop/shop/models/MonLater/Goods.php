<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

class MonLater_Goods extends YLB_Model
{
    public $_cacheKeyPrefix  = 'c|monlater_goods|';
    public $_cacheName       = 'monlater';
    public $_tableName       = 'monlater_goods';
    public $_tablePrimaryKey = 'monlater_goods_id';

    public function __construct(&$db_id = 'shop', &$user = null)
    {
        $this->_tableName = TABEL_PREFIX . $this->_tableName;
        $this->_cacheFlag = CHE;
        parent::__construct($db_id, $user);
    }
}