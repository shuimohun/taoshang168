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
class Fu_Record extends YLB_Model
{
	public $_cacheKeyPrefix  = 'c|fu_record|';
	public $_cacheName       = 'fu';
	public $_tableName       = 'fu_record';
	public $_tablePrimaryKey = 'fu_record_id';

    public $jsonKey          = ['fu_base','fu_share_base'];

	public function __construct(&$db_id = 'shop', &$user = null)
	{
		$this->_tableName = TABEL_PREFIX . $this->_tableName;
		$this->_cacheFlag = CHE;
		parent::__construct($db_id, $user);
	}

    public function getBase($id = null, $sort_key_row = null)
    {
        $rows = $this->get($id, $sort_key_row);
        return $rows;
    }

}