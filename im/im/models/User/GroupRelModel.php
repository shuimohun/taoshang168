<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     WenQingTeng
 */
class User_GroupRelModel extends User_GroupRel
{

	/**
	 * 读取分页列表
	 *
	 * @param  int $group_rel_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getGroupRelList($group_rel_id = null, $page=1, $rows=100, $sort='asc')
	{
		//需要分页如何高效，易扩展
		$offset = $rows * ($page - 1);

		$this->sql->setLimit($offset, $rows);

		$group_rel_id_row = array();
		$group_rel_id_row = $this->selectKeyLimit();

		//读取主键信息
		$total = $this->getFoundRows();

		$data_rows = array();

		if ($group_rel_id_row)
		{
			$data_rows = $this->getGroupRel($group_rel_id_row);
		}

		$data = array();
		$data['page'] = $page;
		$data['total'] = ceil_r($total / $rows);  //total page
		$data['totalsize'] = $data['total'];
		$data['records'] = count($data_rows);
		$data['items'] = array_values($data_rows);

		return $data;
	}


	public function getIdByGroupId($group_id)
	{
		$data = array();

		$data_rows = $this->getKey($group_id, 'group_id');

		$flag = 0;
		if ($data_rows)
		{
			$flag = $this->remove($data_rows);
		}

		return $flag;
	}
}
?>