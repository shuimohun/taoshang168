<?php

if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/*
 * @author weidp
 * */

class Operation_ShopNameModel extends YLB_Model
{
    public $_cacheKeyPrefix  = 'c|shop_base|';
    public $_cacheName       = 'base';
    public $_tableName       = 'shop_base';
    public $_tablePrimaryKey = 'shop_id';

    public function __construct(&$db_id = 'shop', &$user = null)
    {
        $this->_tableName = TABEL_PREFIX . $this->_tableName;
        $this->_cacheFlag = CHE;
        parent::__construct($db_id, $user);
    }
    //获取店铺列表数据
    public function getList()
    {
        $sql = 'select * from YLB_shop_base';

        $rs = $this->sql->getAll($sql);

        return $rs;
    }
}