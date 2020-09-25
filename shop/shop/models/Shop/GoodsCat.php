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
class Shop_GoodsCat extends YLB_Model
{
	public $_cacheKeyPrefix  = 'c|shop_goods_cat|';
	public $_cacheName       = 'shop';
	public $_tableName       = 'shop_goods_cat';
	public $_tablePrimaryKey = 'shop_goods_cat_id';

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

	/**
	 * 根据主键值，从数据库读取数据
	 *
	 * @param  int $shop_goods_cat_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getGoodsCat($shop_goods_cat_id = null, $sort_key_row = null)
	{
		$rows = array();
		$rows = $this->get($shop_goods_cat_id, $sort_key_row);

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
	public function addGoodsCat($field_row, $return_insert_id = false)
	{
		$add_flag = $this->add($field_row, $return_insert_id);

		//$this->removeKey($shop_goods_cat_id);
		return $add_flag;
	}

	/**
	 * 根据主键更新表内容
	 * @param mix $shop_goods_cat_id 主键
	 * @param array $field_row key=>value数组
	 * @return bool $update_flag 是否成功
	 * @access public
	 */
	public function editGoodsCat($shop_goods_cat_id = null, $field_row)
	{
		$update_flag = $this->edit($shop_goods_cat_id, $field_row);

		return $update_flag;
	}

	/**
	 * 更新单个字段
	 * @param mix $shop_goods_cat_id
	 * @param array $field_name
	 * @param array $field_value_new
	 * @param array $field_value_old
	 * @return bool $update_flag 是否成功
	 * @access public
	 */
	public function editGoodsCatSingleField($shop_goods_cat_id, $field_name, $field_value_new, $field_value_old)
	{
		$update_flag = $this->editSingleField($shop_goods_cat_id, $field_name, $field_value_new, $field_value_old);

		return $update_flag;
	}

	/**
	 * 删除操作
	 * @param int $shop_goods_cat_id
	 * @return bool $del_flag 是否成功
	 * @access public
	 */
	public function removeGoodsCat($shop_goods_cat_id)
	{
		$del_flag = $this->remove($shop_goods_cat_id);

		//$this->removeKey($shop_goods_cat_id);
		return $del_flag;
	}

    /**
     * 读取子类id
     *
     * @param  int $parent_id 主键值
     * @param  bools $recursive 是否递归查询
     * @return array $rows 返回的查询内容
     * @access public
     */
    public function getCatChildId($parent_id = 0, $recursive = true)
    {
        $cat_data = array();

        if (is_array($parent_id))
        {
            $cond_row = array('parent_id:in' => $parent_id,'shop_goods_cat_status'=>1);
        }
        else
        {
            $cond_row = array('parent_id' => $parent_id,'shop_goods_cat_status'=>1);
        }

        $cat_id_row = $this->getKeyByMultiCond($cond_row);

        if ($recursive && $cat_id_row)
        {
            $rs = call_user_func_array(array($this,'getCatChildId'), array($cat_id_row, $recursive));

            $cat_id_row = array_merge($cat_id_row, $rs);
        }

        return $cat_id_row;
    }
}

?>