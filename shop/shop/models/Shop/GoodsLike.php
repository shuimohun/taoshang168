<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * @author weidp
 */

class Shop_GoodsLike extends YLB_Model
{
    public $_cacheKeyPrefix  = 'c|shop_goodslike|';
    public $_cacheName       = 'like';
    public $_tableName       = 'shop_goodslike';
    public $_tablePrimaryKey = 'like_id';

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
    public function getGoodsLike($config_key = null, $sort_key_row = null)
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
    public function addGoodsLike($field_row, $return_insert_id = false)
    {
        $add_flag = $this->add($field_row, $return_insert_id);

        //$this->removeKey($config_key);
        return $add_flag;
    }

    /**
     * 根据主键更新表内容
     * @param mix $config_key 主键
     * @param array $field_row key=>value数组
     * @return bool $update_flag 是否成功
     * @access public
     */
    public function editGoodsLike($config_key = null, $field_row)
    {
        $update_flag = $this->edit($config_key, $field_row);

        return $update_flag;
    }

    /**
     * 更新单个字段
     * @param mix $config_key
     * @param array $field_name
     * @param array $field_value_new
     * @param array $field_value_old
     * @return bool $update_flag 是否成功
     * @access public
     */
    public function editGoodsLikeSingleField($config_key, $field_name, $field_value_new, $field_value_old)
    {
        $update_flag = $this->editSingleField($config_key, $field_name, $field_value_new, $field_value_old);

        return $update_flag;
    }

    /**
     * 删除操作
     * @param int $config_key
     * @return bool $del_flag 是否成功
     * @access public
     */
    public function removeGoodsLike($config_key)
    {
        $del_flag = $this->remove($config_key);

        //$this->removeKey($config_key);
        return $del_flag;
    }
}