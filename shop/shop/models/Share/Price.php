<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * Class 分享
 */
class Share_Price extends YLB_Model
{
	public $_cacheKeyPrefix  = 'c|share_price|';
	public $_cacheName       = 'share';
	public $_tableName       = 'share_price';
	public $_tablePrimaryKey = 'id';

    public $jsonKey = array(
        'share_base'
    );

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

?>