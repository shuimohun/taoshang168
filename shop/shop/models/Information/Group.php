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
class Information_Group extends YLB_Model
{
	public $_cacheKeyPrefix     = 'c|information_group|';
	public $_cacheName          = 'information';
	public $_tableName          = 'information_group';
	public $_tablePrimaryKey    = 'information_group_id';
	public $informationGroupListKey = null;

	/**
	 * @param string $user User Object
	 * @var   string $db_id 指定需要连接的数据库Id
	 * @return void
	 */
	public function __construct(&$db_id = 'shop', &$user = null)
	{
		$this->_tableName = TABEL_PREFIX . $this->_tableName;

		parent::__construct($db_id, $user);
		$this->informationGroupListKey = $this->_cacheKeyPrefix . 'information_list|all_data';

	}

	/**
	 * 根据主键值，从数据库读取数据
	 *
	 * @param  int $information_group_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getGroup($information_group_id = null, $sort_key_row = null)
	{
		$rows = array();
		$rows = $this->get($information_group_id, $sort_key_row);

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
	public function addGroup($field_row, $return_insert_id = false)
	{
		$add_flag = $this->add($field_row, $return_insert_id);

		//$this->removeKey($information_group_id);
		return $add_flag;
	}

	/**
	 * 根据主键更新表内容
	 * @param mix $information_group_id 主键
	 * @param array $field_row key=>value数组
	 * @return bool $update_flag 是否成功
	 * @access public
	 */
	public function editGroup($information_group_id = null, $field_row)
	{
		$update_flag = $this->edit($information_group_id, $field_row);

		return $update_flag;
	}

	/**
	 * 更新单个字段
	 * @param mix $information_group_id
	 * @param array $field_name
	 * @param array $field_value_new
	 * @param array $field_value_old
	 * @return bool $update_flag 是否成功
	 * @access public
	 */
	public function editGroupSingleField($information_group_id, $field_name, $field_value_new, $field_value_old)
	{
		$update_flag = $this->editSingleField($information_group_id, $field_name, $field_value_new, $field_value_old);

		return $update_flag;
	}

	/**
	 * 删除操作
	 * @param int $information_group_id
	 * @return bool $del_flag 是否成功
	 * @access public
	 */
	public function removeGroup($information_group_id)
	{
		$del_flag = $this->remove($information_group_id);

		//$this->removeKey($information_group_id);
		return $del_flag;
	}

    /*
     * 获取文章分类名称
     *
     * @param   int $id 主键id
     *
     * @return  string 分类名称
     */
	public function getGroupName($id = 0)
	{
		$re = array();
		if ($id)
		{
			$data = $this->getOne($id);
			if ($data)
			{
				$re = $data['information_group_title'];
			}
			else
			{
				$re = '分类不存在';
			}
		}
		else
		{
			$re = '未分类';
		}
		return $re;
	}

	/*
	 * 获取底部文章显示数据
	 * @param   int $parent_id 文章父类id，默认为0，即查询出所有数据
	 * @return  array  $re 查询出来的数据
	 */
	public function getInformationGroupList($parent_id = 0)
	{
		/*//设置cache
		$Cache = YLB_Cache::create('base');

		if ($re = $Cache->get($this->informationGroupListKey))
		{

		}
		else
		{*/
		$re                 = array();
		$Information_GroupModel = new Information_GroupModel();
		$datas              = $Information_GroupModel->getByWhere(array('information_group_parent_id' => $parent_id));
		if (!empty($datas) && $parent_id == 0)
		{
			$re = array();
			foreach ($datas as $key => $value)
			{
				$group_id = $key;
				$data     = array();
				$data     = $Information_GroupModel->getGroupInformationList($group_id);
				if (!empty($data))
				{
					$re[$key]['group_name'] = $value['information_group_title'];
					$re[$key]['information']    = $data;
				}
			}
		}
		/*$Cache->save($re, $this->informationGroupListKey);
	}*/

		return $re;
	}

    /*
     * 获取所有文章分类
     * @param int $parent_id
     * @return array $re
     */
	public function getInformationGroupLists($parent_id)
	{
		$Information_GroupModel = new Information_GroupModel();
		$re                 = array();
		if ($parent_id != 0)
		{
			$datas            = array();
			$datas            = $Information_GroupModel->getOne($parent_id);
			$re['group_name'] = $datas['information_group_title'];

			$data = $Information_GroupModel->getGroupInformationList($parent_id);
			if (!empty($data))
			{
				$re['information'] = $data;
			}
		}
		return $re;
	}
}

?>