<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/20
 * Time: 15:42
 */
class ScareBuy_PriceRange extends YLB_Model
{
	public $_cacheKeyPrefix  = 'c|scarebuy_price_range|';
	public $_cacheName       = 'scarebuy';
	public $_tableName       = 'scarebuy_price_range';
	public $_tablePrimaryKey = 'range_id';

	/**
	 * @param string $user User Object
	 * @var   string $db_id 指定需要连接的数据库Id
	 * @return void
	 */
	public function __construct(&$db_id = 'shop', &$user = null)
	{
		$this->_tableName = TABEL_PREFIX . $this->_tableName;
		$this->_cacheFlag = CHE;
		parent::__construct($db_id, $user);
	}


}