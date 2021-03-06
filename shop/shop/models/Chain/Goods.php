<?php if (!defined('ROOT_PATH')) exit('No Permission');
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
class Chain_Goods extends YLB_Model
{
    public $_cacheKeyPrefix  = 'c|chain_goods|';
    public $_cacheName       = 'chain';
    public $_tableName       = 'chain_goods';
    public $_tablePrimaryKey = 'chain_goods_id';

    /**
     * @param string $user  User Object
     * @var   string $db_id 指定需要连接的数据库Id
     * @return void
     */
    public function __construct(&$db_id='shop', &$user=null)
    {
        $this->_tableName = TABEL_PREFIX . $this->_tableName;
 		$this->_cacheFlag        = CHE;
        parent::__construct($db_id, $user);
    }

    /**
     * 根据主键值，从数据库读取数据
     *
     * @param  int   $chain_goods_id  主键值
     * @return array $rows 返回的查询内容
     * @access public
     */
    public function getGoods($chain_goods_id=null, $sort_key_row=null)
    {
        $rows = array();
        $rows = $this->get($chain_goods_id, $sort_key_row);

        return $rows;
    }

    /**
     * 插入
     * @param array $field_row 插入数据信息
     * @param bool  $return_insert_id 是否返回inset id
     * @param array $field_row 信息
     * @return bool  是否成功
     * @access public
     */
    public function addGoods($field_row, $return_insert_id=false)
    {
        $add_flag = $this->add($field_row, $return_insert_id);

        //$this->removeKey($chain_goods_id);
        return $add_flag;
    }

    /**
     * 根据主键更新表内容
     * @param mix   $chain_goods_id  主键
     * @param array $field_row   key=>value数组
     * @return bool $update_flag 是否成功
     * @access public
     */
    public function editGoods($chain_goods_id=null, $field_row,$flag = false)
    {
        $update_flag = $this->edit($chain_goods_id, $field_row,$flag);

        return $update_flag;
    }

    /**
     * 更新单个字段
     * @param mix   $chain_goods_id
     * @param array $field_name
     * @param array $field_value_new
     * @param array $field_value_old
     * @return bool $update_flag 是否成功
     * @access public
     */
    public function editGoodsSingleField($chain_goods_id, $field_name, $field_value_new, $field_value_old)
    {
        $update_flag = $this->editSingleField($chain_goods_id, $field_name, $field_value_new, $field_value_old);

        return $update_flag;
    }    
    
    /**
     * 删除操作
     * @param int $chain_goods_id
     * @return bool $del_flag 是否成功
     * @access public
     */
    public function removeGoods($chain_goods_id)
    {
        $del_flag = $this->remove($chain_goods_id);

        //$this->removeKey($chain_goods_id);
        return $del_flag;
    }
}
?>