<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Information_GroupModel extends Information_Group
{

    public $treeRows   = array();
    public $treeAllKey = null;
    public $catListAll = null;

	/**
	 * 读取分页列表
	 *
	 * @param  int $information_group_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getGroupList($information_group_id = null, $page = 1, $rows = 100, $sort = 'asc')
	{
		//需要分页如何高效，易扩展
		$offset = $rows * ($page - 1);

		$this->sql->setLimit($offset, $rows);

		$information_group_id_row = array();
		$information_group_id_row = $this->selectKeyLimit();

		//读取主键信息
		$total = $this->getFoundRows();

		$data_rows = array();

		if ($information_group_id_row)
		{
			$data_rows = $this->getGroup($information_group_id_row);
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
	public function getGroupInformationList($group_id = null)
	{
		$Information_BaseModel  = new Information_BaseModel();
		$Information_GroupModel = new Information_GroupModel();

		$child_id_rows = $Information_GroupModel->getChildIds($group_id);
		array_push($child_id_rows, $group_id);
		$re = $Information_BaseModel->getByWhere(array(
												 'information_group_id:in' => $child_id_rows,
												 'information_type' => $Information_BaseModel::ARTICLE_TYPE_ARTICLE,
												 'information_status' => $Information_BaseModel::ARTICLE_STATUS_TRUE
											 ));
		return $re;
	}

    /*
     * 根据父类id,获取子类id
     * @param int $group_parent_id 文章分类父类id
     * @return array group_id_row
     */
	public function getChildIds($group_parent_id = null, $recursive = true)
	{
        $Information_GroupModel = new Information_GroupModel();

		$group_data = array();

		if (is_array($group_parent_id))
		{
			$cond_row = array('information_group_parent_id:in' => $group_parent_id);
		}
		else
		{
			$cond_row = array('information_group_parent_id' => $group_parent_id);
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

    public function getCatTree($information_group_parent_id = 0, $recursive = true, $level = 0)
    {
        $data_rows = $this->getCatTreeData($information_group_parent_id, $recursive, $level);
        $data['items'] = array_values($data_rows);

        return $data;
    }

    public function getCatTreeData($information_group_parent_id = 0, $recursive = true, $level = 0)
    {
        $cat_data = array();

        $level++;

        if (is_array($information_group_parent_id))
        {
            $cond_row = array('information_group_parent_id:in' => $information_group_parent_id);
        }
        else
        {
            $cond_row = array('information_group_parent_id' => $information_group_parent_id);
        }

        $cat_rows = $this->getByWhere($cond_row, array('information_group_sort' => 'ASC'));

        //类似数据可以放到前端整理
        foreach ($cat_rows as $key => $cat_row)
        {
            $cat_row['information_group_parent_id'] = $cat_row['information_group_parent_id'];
            $cat_row['type_number'] = 'trade';
            $cat_row['name'] = $cat_row['information_group_title'];

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
                    $cat_row['information_group_id'],
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