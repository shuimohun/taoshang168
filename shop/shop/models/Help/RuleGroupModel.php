<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Help_RuleGroupModel extends Help_Group
{

	/**
	 * 读取分页列表
	 *
	 * @param  int $help_group_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getGroupList($help_group_id = null, $page = 1, $rows = 100, $sort = 'asc')
	{
		//需要分页如何高效，易扩展
		$offset = $rows * ($page - 1);

		$this->sql->setLimit($offset, $rows);

		$help_group_id_row = array();
		$help_group_id_row = $this->selectKeyLimit();

		//读取主键信息
		$total = $this->getFoundRows();

		$data_rows = array();

		if ($help_group_id_row)
		{
			$data_rows = $this->getGroup($help_group_id_row);
		}

		$data              = array();
		$data['page']      = $page;
		$data['total']     = ceil_r($total / $rows);  //total page
		$data['totalsize'] = $data['total'];
		$data['records']   = count($data_rows);
		$data['items']     = array_values($data_rows);

		return $data;
	}

    /*
     * 获取指定文章分类下面的文章
     * @param int $group_id 文章分类id
     * @return array  $re 查询数据
     */
	public function getGroupHelpList($group_id = null)
	{
		$Help_BaseModel  = new Help_BaseModel();
		$Artilce_GroupModel = new Help_GroupModel();

		$child_id_rows = $Artilce_GroupModel->getChildIds($group_id);
		array_push($child_id_rows, $group_id);
		$re = $Help_BaseModel->listByWhere(array(
												 'help_group_id:in' => $child_id_rows,
												 'help_type' => $Help_BaseModel::ARTICLE_TYPE_ARTICLE,
												 'help_status' => $Help_BaseModel::ARTICLE_STATUS_TRUE,
                                                 'help_or_rule' => $Help_BaseModel::ARTICLE_TYPE_HELP
											 ),array(),1,6);

        $data = array();
		if($re['items'])
        {
            $data = $re['items'];
        }
		return $data;
	}

    /*
     * 根据父类id,获取子类id
     * @param int $group_parent_id 文章分类父类id
     * @return array group_id_row
     */
	public function getChildIds($group_parent_id = null, $recursive = true)
	{
		$Artilce_GroupModel = new Help_GroupModel();

		$group_data = array();

		if (is_array($group_parent_id))
		{
			$cond_row = array('help_group_parent_id:in' => $group_parent_id);
		}
		else
		{
			$cond_row = array('help_group_parent_id' => $group_parent_id);
		}

		$group_id_row = $this->getKeyByMultiCond($cond_row);

		if ($recursive && $group_id_row)
		{
			$rs = call_user_func_array(array(
										   $this,
										   'getChildIds'
									   ), array(
										   $group_id_row,
										   $recursive
									   ));

			$group_id_row = array_merge($group_id_row, $rs);
		}

		return $group_id_row;
	}
    
	
	
	public function getCatTree($help_group_parent_id = 0, $recursive = true, $level = 0)
    {
        $this->treeAllKey = $this->_cacheKeyPrefix . 'tree|all_data';
    
        //设置cache
        $Cache = YLB_Cache::create('base');
    
        if ($data_rows = $Cache->get($this->treeAllKey))
        {
        }
        else
        {
            $data_rows = $this->getCatTreeData($help_group_parent_id, $recursive, $level);
    
            $Cache->save($data_rows, $this->treeAllKey);
        }
    
        $data['items'] = array_values($data_rows);
    
        return $data;
    }
    
    public function getCatTreeData($help_group_parent_id = 0, $recursive = true, $level = 0)
    {
        $cat_data = array();
    
        $level++;
    
        if (is_array($help_group_parent_id))
        {
            $cond_row = array('help_group_parent_id:in' => $help_group_parent_id);
            $cond_row['help_or_rule'] = '规则';

            $cache_key = $this->_cacheKeyPrefix . 'help_group_parent_id|' . implode(':', $help_group_parent_id);
        }
        else
        {
            $cond_row = array('help_group_parent_id' => $help_group_parent_id);
            $cond_row['help_or_rule'] = '规则';

            $cache_key = $this->_cacheKeyPrefix . 'help_group_parent_id|' . $help_group_parent_id;
        }
    
        //设置cache
        $Cache = YLB_Cache::create('base');
    
        if ($cat_rows = $Cache->get($cache_key))
        {
        }
        else
        {
            $cat_rows = $this->getByWhere($cond_row, array('help_group_sort' => 'ASC'));
            $Cache->save($cat_rows, $cache_key);
        }
    
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