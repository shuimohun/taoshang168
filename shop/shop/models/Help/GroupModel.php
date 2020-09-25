<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Help_GroupModel extends Help_Group
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

		$child_id_rows = $this->getChildIds($group_id);
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
        $data_rows = $this->getCatTreeData($help_group_parent_id, $recursive, $level);

        $data['items'] = array_values($data_rows);

        return $data;
    }

    public function getSiteFooterHelp()
    {
        $Cache = YLB_Cache::create('base');
        $site_index_footer_key = 'footer_help';

        if ($data = $Cache->get($site_index_footer_key))
        {
        }
        else
        {
            $data = $this->listByWhere(['help_or_rule'=>'帮助','help_group_parent_id' => 0],['help_group_sort'=>'asc'],1,6);

            if($data['items'])
            {
                $row = [];
                foreach ($data['items'] as $key => $value)
                {
                    $child_row     = $this->getGroupHelpList($value['help_group_id']);
                    $row[$key]['group_name'] = $value['help_group_title'];
                    $row[$key]['help']       = $child_row;
                }
                $data = $row;
            }

            $Cache->save($data, $site_index_footer_key);
        }

        return $data;
    }

}



?>