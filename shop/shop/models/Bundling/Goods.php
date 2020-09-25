<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * User: zzh
 * Date: 2017/02/16
 * Time: 17:25
 */
class Bundling_Goods extends YLB_Model
{

	public $_cacheKeyPrefix  = 'c|bundling_goods|';
	public $_cacheName       = 'bundling';
	public $_tableName       = 'bundling_goods';
	public $_tablePrimaryKey = 'bundling_goods_id';

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