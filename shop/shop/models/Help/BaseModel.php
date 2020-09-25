<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Help_BaseModel extends Help_Base
{
	const   ARTICLE_STATUS_TRUE  = 1; //开启
	const   ARTICLE_STATUS_FALSE = 2; //关闭

	const   ARTICLE_TYPE_ARTICLE = 0; //文章
	const   ARTICLE_TYPE_SYSTEM  = 1; //文章

    //首页帮助
    const   ARTICLE_TYPE_RULE = '规则';
    const   ARTICLE_TYPE_HELP = '帮助';
	/**
	 * 读取分页列表
	 *
	 * @param  int $help_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getBaseList($help_id = null, $page = 1, $rows = 100, $sort = 'asc')
	{
		//需要分页如何高效，易扩展
		$offset = $rows * ($page - 1);

		$this->sql->setLimit($offset, $rows);

		$help_id_row = array();
		$help_id_row = $this->selectKeyLimit();

		//读取主键信息
		$total = $this->getFoundRows();

		$data_rows = array();

		if ($help_id_row)
		{
			$data_rows = $this->getBase($help_id_row);
		}

		$data              = array();
		$data['page']      = $page;
		$data['total']     = ceil_r($total / $rows);  //total page
		$data['totalsize'] = $data['total'];
		$data['records']   = count($data_rows);
		$data['items']     = array_values($data_rows);

		return $data;
	}

	/**
	 * 读取分页列表
	 *
	 * @param  int $help_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getBaseAllList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
		$data = $this->listByWhere($cond_row, $order_row, $page, $rows);

		return $data;
	}
	
	/*
	 * 根据一个id获取附近两条数据
	 *
	 * @param   int $help_id  主键值
	 *
	 * @return  array $data 返回查询的内容
	 */
	public function getNearHelp($help_id)
	{
		$Help_BaseModel = new Help_BaseModel();
		$Help_BaseModel->sql->setLimit(0, 1);
		$data['front'] = pos($Help_BaseModel->getByWhere(array('help_id:<' => $help_id), array('help_id' => 'desc')));
		$Help_BaseModel->sql->setLimit(0, 1);
		$data['behind'] = pos($Help_BaseModel->getByWhere(array('help_id:>' => $help_id), array('help_id' => 'asc')));
		return $data;
	}

	/**
	 * 读数量
	 *
	 * @param  int $config_key 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getCount($cond_row = array())
	{
		return $this->getNum($cond_row);
	}
}

?>