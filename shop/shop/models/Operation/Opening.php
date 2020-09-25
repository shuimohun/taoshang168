<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

class Operation_Opening extends YLB_Model
{
    public $_cacheKeyPrefix  = 'c|opening_tier|';
    public $_cacheName       = 'opening_tier';
    public $_tableName       = 'opening_tier';
    public $_tablePrimaryKey = 'opening_id';

    public function __construct(&$db_id = 'shop', &$user = null)
    {
        $this->_tableName = TABEL_PREFIX . $this->_tableName;
        $this->_cacheFlag = CHE;
        parent::__construct($db_id, $user);
    }

    /**
     * 根据主键值，从数据库读取数据
     *
     * @param  int $brand_id 主键值
     * @return array $rows 返回的查询内容
     * @access public
     */
    public function getOpening($brand_id = null, $sort_key_row = null)
    {
        $rows = array();
        $rows = $this->get($brand_id, $sort_key_row);

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
    public function addOpening($field_row, $return_insert_id = false)
    {
        $add_flag = $this->add($field_row, $return_insert_id);
        return $add_flag;
    }
    /**
     * 根据主键更新表内容
     * @param mix $brand_id 主键
     * @param array $field_row key=>value数组
     * @return bool $update_flag 是否成功
     * @access public
     */
    public function editOpening($brand_id = null, $field_row, $flag = false)
    {
        $update_flag = $this->edit($brand_id, $field_row, $flag);

        return $update_flag;
    }
    /**
     * 更新单个字段
     * @param mix $brand_id
     * @param array $field_name
     * @param array $field_value_new
     * @param array $field_value_old
     * @return bool $update_flag 是否成功
     * @access public
     */
    public function editOpeningSingleField($brand_id, $field_name, $field_value_new, $field_value_old)
    {
        $update_flag = $this->editSingleField($brand_id, $field_name, $field_value_new, $field_value_old);

        return $update_flag;
    }
    /**
     * 删除操作
     * @param int $brand_id
     * @return bool $del_flag 是否成功
     * @access public
     */
    public function removeOpening($brand_id)
    {
        $del_flag = $this->remove($brand_id);

        //$this->removeKey($brand_id);
        return $del_flag;
    }

}