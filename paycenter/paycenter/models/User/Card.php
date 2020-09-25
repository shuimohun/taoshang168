<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 
 * 
 * @category   Framework
 * @package    __init__
 * @author     Zhenzh
 * @copyright  Copyright (c) 2017, Zhenzh
 * @version    1.0
 * @todo       
 */
class User_Card extends YLB_Model
{
    public $_cacheKeyPrefix  = 'c|user_card|';
    public $_cacheName       = 'user_card';
    public $_tableName       = 'user_card';
    public $_tablePrimaryKey = 'card_id';

    /**
     * @param string $user  User Object
     * @var   string $db_id 指定需要连接的数据库Id
     */
    public function __construct(&$db_id='paycenter', &$user=null)
    {
        $this->_tableName = TABEL_PREFIX . $this->_tableName;
		$this->_cacheFlag = CHE;
        parent::__construct($db_id, $user);
        
    }
}
?>