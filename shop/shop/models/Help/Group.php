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
class Help_Group extends YLB_Model
{
	public $_cacheKeyPrefix     = 'c|help_group|';
	public $_cacheName          = 'help';
	public $_tableName          = 'help_group';
	public $_tablePrimaryKey    = 'help_group_id';
	public $helpGroupListKey = null;


	/**
	 * @param string $user User Object
	 * @var   string $db_id 指定需要连接的数据库Id
	 * @return void
	 */
	public function __construct(&$db_id = 'shop', &$user = null)
	{
		$this->_tableName = TABEL_PREFIX . $this->_tableName;

		parent::__construct($db_id, $user);
		$this->helpGroupListKey = $this->_cacheKeyPrefix . 'help_list|all_data';

	}

	/**
	 * 根据主键值，从数据库读取数据
	 *
	 * @param  int $help_group_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getGroup($help_group_id = null, $sort_key_row = null)
	{
		$rows = array();
		$rows = $this->get($help_group_id, $sort_key_row);

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

        return $add_flag;
	}

	/**
	 * 根据主键更新表内容
	 * @param mix $help_group_id 主键
	 * @param array $field_row key=>value数组
	 * @return bool $update_flag 是否成功
	 * @access public
	 */
	public function editGroup($help_group_id = null, $field_row)
	{
		$update_flag = $this->edit($help_group_id, $field_row);

		return $update_flag;
	}

	/**
	 * 更新单个字段
	 * @param mix $help_group_id
	 * @param array $field_name
	 * @param array $field_value_new
	 * @param array $field_value_old
	 * @return bool $update_flag 是否成功
	 * @access public
	 */
	public function editGroupSingleField($help_group_id, $field_name, $field_value_new, $field_value_old)
	{
		$update_flag = $this->editSingleField($help_group_id, $field_name, $field_value_new, $field_value_old);

		return $update_flag;
	}

	/**
	 * 删除操作
	 * @param int $help_group_id
	 * @return bool $del_flag 是否成功
	 * @access public
	 */
	public function removeGroup($help_group_id)
	{
        //判断是否有子类, 如果有,不允许删除
        $data_rows = $this->getCatTreeData($help_group_id, false);

        if ($data_rows)
        {
            $this->msg->setMessages(_('有子分类,不允许删除'));
            return false;
        }

        $del_flag = $this->remove($help_group_id);

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
				$re = $data['help_group_title'];
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
	public function getHelpGroupList($parent_id = 0)
	{
		//设置cache
		$Cache = YLB_Cache::create('base');

		if ($re = $Cache->get($this->helpGroupListKey))
		{

		}
		else
		{
            $re                 = array();
            $Help_GroupModel = new Help_GroupModel();
            $datas              = $Help_GroupModel->getByWhere(array('help_group_parent_id' => $parent_id));
            if (!empty($datas) && $parent_id == 0)
            {
                $re = array();
                foreach ($datas as $key => $value)
                {
                    $group_id = $key;
                    $data     = array();
                    $data     = $Help_GroupModel->getGroupHelpList($group_id);
                    if (!empty($data))
                    {
                        $re[$key]['group_name'] = $value['help_group_title'];
                        $re[$key]['help']    = $data;
                    }
                }
            }
            $Cache->save($re, $this->helpGroupListKey);
	    }

		return $re;
	}

    /*
     * 获取所有文章分类
     * @param int $parent_id
     * @return array $re
     */
	public function getHelpGroupLists($parent_id)
	{
		$Help_GroupModel = new Help_GroupModel();
		$re                 = array();
		if ($parent_id != 0)
		{
			$datas            = $Help_GroupModel->getOne($parent_id);
			$re['group_name'] = $datas['help_group_title'];

			$data = $Help_GroupModel->getGroupHelpList($parent_id);
			if (!empty($data))
			{
				$re['help'] = $data;
			}
		}
		return $re;
	}

    public function getCatTreeData($help_group_parent_id = 0, $recursive = true, $level = 0)
    {
        $type = request_string('type');
        if($type == 'rule')
        {
            $help_or_rule = '规则';
        }
        else
        {
            $help_or_rule = '帮助';
        }

        $cat_data = array();

        $level++;

        if (is_array($help_group_parent_id))
        {
            $cond_row = array('help_group_parent_id:in' => $help_group_parent_id);

            $cond_row['help_or_rule'] = $help_or_rule;
        }
        else
        {
            $cond_row = array('help_group_parent_id' => $help_group_parent_id);
            $cond_row['help_or_rule'] = $help_or_rule;
        }

        $cat_rows = $this->getByWhere($cond_row, array('help_group_sort' => 'ASC'));

        //类似数据可以放到前端整理
        foreach ($cat_rows as $key => $cat_row)
        {
            $cat_row['help_group_parent_id'] = $cat_row['help_group_parent_id'];
            $cat_row['type_number'] = 'trade';
            $cat_row['name'] = $cat_row['help_group_title'];

            $cat_row['level']     = $level;
            $cat_row['cat_level'] = $level;

            $cat_row['cat_icon'] = 'ui-icon-star';

            $cat_row['expanded'] = true;
            $cat_row['loaded']   = true;

            if ($recursive)
            {
                $rs = call_user_func_array(array(
                    $this,
                    'getCatTreeData'
                ), array(
                    $cat_row['help_group_id'],
                    $recursive,
                    $level
                ));

                if ($rs)
                {
                    $cat_row['is_leaf'] = false;
                }
                else
                {
                    $cat_row['is_leaf'] = true;
                }

                $cat_data[] = $cat_row;

                $cat_data = array_merge($cat_data, $rs);
            }
            else
            {
                $cat_row['is_leaf'] = true;
                $cat_data[]         = $cat_row;
            }

        }

        return $cat_data;
    }


}

?>