<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Subsite_BaseModel extends Subsite_Base
{
	public $treeAllKey = null;

	/**
	 * 读取分页列表
	 *
	 * @param  int $district_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getSubsiteList($cond_row = array(), $order_row = array('subsite_id' => 'ASC'), $page = 1, $rows = 100)
	{
		return $this->listByWhere($cond_row, $order_row, $page, $rows);
	}




	/**
	 * 根据分类父类id读取子类信息,
	 *
	 * @param  int $sub_site_parent_id 父id
	 * @param  bool $recursive 是否子类信息
	 * @param  int $level 当前层级
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	
	public function getSubsiteTree($sub_site_parent_id = 0, $recursive = true, $level = 0)
	{
		$data_rows = $this->getSubsiteTreeData($sub_site_parent_id, $recursive, $level);


		$data['items'] = array_values($data_rows);

		return $data;
	}

	//获取所有分站
	public function  getAllSubsite()
	{
		$subsite = $this->getSubsiteTreeData('0', false);

		$s_sub_id = array_column($subsite, 'subsite_id');

		$ss_sub = $this->getSubsiteTreeData($s_sub_id, false);

		foreach ($ss_sub as $key => $val)
		{
			$subsite[$val['subsite_id']]['ss_sub'][] = $val;
		}

		return $subsite;

	}

	//获取所有分站
	public function  getSubsiteAll()
	{
		$subsite = $this->getSubsiteTreeData('0', false);
		$subsite = array_values($province);
		$s_id = array_column($subsite, 'subsite_id');

		$s_subsite = $this->getSubsiteTreeData($p_id, false);
		fb($s_subsite);
		$ss_id = array_column($s_subsite, 'subsite_id');

		$sss_subsite = $this->getSubsiteTree($ss_id, false);
		fb($sss_subsite);

		$data[] = $subsite;
		foreach ($s_subsite as $key => $val)
		{
			$data[$val['sub_site_parent_id']][] = $val;
		}

		foreach ($sss_subsite['items'] as $key => $val)
		{
			$data[$val['sub_site_parent_id']][] = $val;
		}

		return $data;

	}


}

?>