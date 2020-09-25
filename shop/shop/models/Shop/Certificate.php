<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 *
 *
 * @category   Framework
 * @package    __init__
 * @author     WenQingTeng
 * @copyright  Copyright (c) 2017, 温庆腾
 * @version    1.0
 * @todo
 */
class Shop_Certificate extends YLB_Model
{
	public $_cacheKeyPrefix  = 'c|shop_certificate|';
	public $_cacheName       = 'shop';
	public $_tableName       = 'shop_certificate';
	public $_tablePrimaryKey = 'id';

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

    public function getCertificate($id = null,$order_row = array())
    {
        $rows = $this->get($id,null,$order_row);
        return $rows;
    }

}

?>