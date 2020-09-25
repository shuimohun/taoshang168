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
class Bank_Base extends YLB_Model
{
    public $_cacheKeyPrefix  = 'c|bank_base|';
    public $_cacheName       = 'bank';
    public $_tableName       = 'bank_base';
    public $_tablePrimaryKey = 'bank_id';

    public function __construct(&$db_id='paycenter', &$user=null)
    {
        $this->_tableName = TABEL_PREFIX . $this->_tableName;
		$this->_cacheFlag = CHE;
        parent::__construct($db_id, $user);
    }

    /**
     * 根据主键值，从数据库读取数据
     *
     * @param  int   $user_id  主键值
     * @return array $rows 返回的查询内容
     * @access public
     */
    public function getBase($user_id=null, $sort_key_row=null)
    {
        $rows = array();
        $rows = $this->get($user_id, $sort_key_row);

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
    public function addBase($field_row, $return_insert_id=false)
    {
        $add_flag = $this->add($field_row, $return_insert_id);

        return $add_flag;
    }

    /**
     * 根据主键更新表内容
     * @param mix   $bank_id  主键
     * @param array $field_row   key=>value数组
     * @return bool $update_flag 是否成功
     * @access public
     */
    public function editBase($bank_id=null, $field_row)
    {
        $update_flag = $this->edit($bank_id, $field_row);

        return $update_flag;
    }

    /**
     * 更新单个字段
     * @param mix   $bank_id
     * @param array $field_name
     * @param array $field_value_new
     * @param array $field_value_old
     * @return bool $update_flag 是否成功
     * @access public
     */
    public function editBaseSingleField($bank_id, $field_name, $field_value_new, $field_value_old)
    {
        $update_flag = $this->editSingleField($bank_id, $field_name, $field_value_new, $field_value_old);

        return $update_flag;
    }    
    
    /**
     * 删除操作
     * @param int $bank_id
     * @return bool $del_flag 是否成功
     * @access public
     */
    public function removeBase($bank_id)
    {
        $del_flag = $this->remove($bank_id);

        return $del_flag;
    }
}
?>