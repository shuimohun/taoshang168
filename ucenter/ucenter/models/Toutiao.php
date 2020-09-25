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
class Toutiao extends YLB_Model
{
	public $_cacheKeyPrefix  = 'c|Toutiao|';
	public $_cacheName       = 'toutiao_base';
	public $_tableName       = 'toutiao_base';
	public $_tablePrimaryKey = 'id';

    /**
     * Toutiao constructor.
     * @param string $db_id
     * @param null $user
     */
	public function __construct(&$db_id = 'ucenter', &$user = null)
	{
		$this->_tableName = TABEL_PREFIX . $this->_tableName;
		parent::__construct($db_id, $user);
	}

	/**
	 * 插入
	 * @param array $field_row 插入数据信息
	 * @param bool $return_insert_id 是否返回inset id
	 * @param array $field_row 信息
	 * @return bool  是否成功
	 * @access public
	 */
	public function addToutiao($field_row, $return_insert_id = false)
	{
		$add_flag = $this->add($field_row, $return_insert_id);
		return $add_flag;
	}

    /**
     * 根据主键更新表内容
     *
     * @param null $id
     * @param array $field_row
     * @param bool $flag
     * @return bool
     */
	public function editToutiao($id = null, $field_row = array(), $flag = true)
	{
		$update_flag = $this->edit($id, $field_row, $flag);
		return $update_flag;
	}


	/**
     * 删除操作
     *
     * cess public
	 */
	public function removeToutiao($id)
	{
		$del_flag = $this->remove($id);
		return $del_flag;
	}
}

?>