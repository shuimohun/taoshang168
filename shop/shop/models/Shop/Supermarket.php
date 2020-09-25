<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}
/**
 *@author weidp
 */

class Shop_Supermarket extends YLB_Model
{
    public $_cacheKeyPrefix  = 'c|shop_base|';
    public $_cacheName       = 'shop';
    public $_tableName       = 'shop_base';
    public $_tablePrimaryKey = 'shop_id';

    public function __construct(&$db_id = 'shop', &$user = null)
    {
        $this->_tableName = TABEL_PREFIX . $this->_tableName;
        $this->_cacheFlag = CHE;
        parent::__construct($db_id, $user);
    }

}