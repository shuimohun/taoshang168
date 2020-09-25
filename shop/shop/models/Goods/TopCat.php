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
class Goods_TopCat extends YLB_Model
{
	public $_cacheKeyPrefix  = 'c|goods_top_cat|';
	public $_cacheName       = 'base';
	public $_tableName       = 'goods_top_cat';
	public $_tablePrimaryKey = 'id';

    /**
     * Goods_Top constructor.
     * @param string $db_id 指定需要连接的数据库Id
     * @param null $user
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
     * @param null $id
     * @param null $sort_key_row
     * @return array
     */
	public function getTopCat($id = null, $sort_key_row = null)
	{
		$rows = $this->get($id, $sort_key_row);
		return $rows;
	}

	/**
	 * 插入, 创建对应的表
	 * @param array $field_row 插入数据信息
	 * @param bool $return_insert_id 是否返回inset id
	 * @param array $field_row 信息
	 * @return bool  是否成功
	 * @access public
	 */
	public function addTopCat($field_row, $return_insert_id = false)
	{
		$add_flag = $this->add($field_row, $return_insert_id);
        return $add_flag;
	}

    /**
     * 修改
     *
     * @param null $id
     * @param $field_row
     * @return bool
     */
	public function editTopCat($id = null, $field_row)
	{
		$update_flag = $this->edit($id, $field_row);
		return $update_flag;
	}

	/**
	 * 更新单个字段
	 * @param mix $id
	 * @param array $field_name
	 * @param array $field_value_new
	 * @param array $field_value_old
	 * @return bool $update_flag 是否成功
	 * @access public
	 */
	public function editTopCatSingleField($id, $field_name, $field_value_new, $field_value_old)
	{
		$update_flag = $this->editSingleField($id, $field_name, $field_value_new, $field_value_old);
		return $update_flag;
	}

	/**
	 * 删除操作
	 * @param int $id
	 * @return bool $del_flag 是否成功
	 * @access public
	 */
	public function removeTopCat($id)
	{
		$del_flag = $this->remove($id);
		return $del_flag;
	}
}

?>