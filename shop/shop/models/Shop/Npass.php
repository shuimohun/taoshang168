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
class Shop_Npass extends YLB_Model
{
	public $_cacheKeyPrefix  = 'c|shop_npass|';
	public $_cacheName       = 'npass';
	public $_tableName       = 'shop_npass';
	public $_tablePrimaryKey = 'npass_id';

	/** @author yang
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

	/**
	 * 根据主键值，从数据库读取数据
	 *
	 * @param  int $config_key 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getNpass($config_key = null, $sort_key_row = null)
	{
		$rows = array();
		$rows = $this->get($config_key, $sort_key_row);

		return $rows;
	}

	/**
	 * 插入
	 * @param array $field_row 插入数据信息
	 * @param bool $return_insert_id 是否返回inset id
	 * @param array $field_row 信息
	 * @return bool  是否成功
	 * @access public
	 */
	public function addNpass($field_row, $return_insert_id = false)
	{
		$add_flag = $this->add($field_row, $return_insert_id);

		//$this->removeKey($config_key);
		return $add_flag;
	}

	/**
	 * 修改
	 * @param int $npass_id 修改信息id
     * @param array $field_row 修改内容
     * @return  bool 是否成功
     **/
	public  function editNpass($npass_id,$field_row){

	    $edit_flag = $this->edit($npass_id,$field_row);

	    return $edit_flag;
    }
    /**
     * 删除
     *@param int $npass_id 删除信息id
     *@return  bool 是否成功
     * */
    public function  removeNpass($npass_id){

        $remove_flag = $this->remove($npass_id);

        return $remove_flag;
    }
}

?>