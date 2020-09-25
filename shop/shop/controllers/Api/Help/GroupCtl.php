<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Api_Help_GroupCtl extends Api_Controller
{
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);

	}


	/*
	 * 文章分类列表
	 *
	 * @param   page    页码
	 * @param   rows    每天显示条数
	 *
	 * @return  data    文章分类数据
	 *
	 */
	public function helpGroupList()
	{
		$Help_GroupModel = new Help_GroupModel();
		$page               = request_int('page');
		$rows               = request_int('rows');
		$cond_rows['help_or_rule'] = '帮助';
		$order_rows         = array();
		$data               = $Help_GroupModel->listByWhere($cond_rows, $order_rows, $page, $rows);
		$this->data->addBody(-140, $data);
	}

	/*
	 * 获取父类id，name
	 *
	 * @param   id  文章id
	 *
	 * @return  re  文章分id,名字
	 */
	public function getGroupName()
	{
		$Help_GroupModel = new Help_GroupModel();
		$re                 = array();
		$id                 = request_int('id');
		if ($id)
		{
			$data              = $Help_GroupModel->getOne($id);
			$re['parent_name'] = $data['help_group_title'];
			$re['parent_id']   = $id;
		}
		if ($re)
		{
			$msg    = _('success');
			$status = 200;
		}
		else
		{
			$msg    = _('failure');
			$status = 250;
		}
		$this->data->addBody(-140, $re, $msg, $status);
	}

	/*
	 * 编辑文章分类
	 *
	 * @param   help_group_id    文章分类id
	 * @param   help_group_sort  文章排序
	 * @param   help_group_title 文章标题
	 * @param   help_group_parent_id 文章父类id
	 *
	 * @return  data    编辑的文章内容
	 */
	public function editGroup()
	{
		$Help_GroupModel = new Help_GroupModel();
		$data               = array();

		$help_group_id = request_int('help_group_id');

		$data['help_group_sort']      = request_int('help_group_sort');
		$data['help_group_title']     = request_string('help_group_title');
		$data['help_group_parent_id'] = request_int('help_group_parent_id');
		$flag                            = $Help_GroupModel->editGroup($help_group_id, $data);

		if ($flag !== false)
		{
			$msg    = _('success');
			$status = 200;
		}
		else
		{
			$msg    = _('failure');
			$status = 250;
		}
		$data['id']               = $help_group_id;
		$data['help_group_id'] = $help_group_id;
		$this->data->addBody(-140, $data, $msg, $status);
	}

	/*
	 * 新增文章分类
	 *
	 * @param   help_group_sort  文章分类排序
	 * @param   help_group_title 文章分类标题
	 * @param   help_group_parent_id 文章分类父类id
	 *
	 * @return  data    新增成功的文章内容
	 */
	public function addGroup()
	{
		$Help_GroupModel = new Help_GroupModel();

		$data['help_group_sort']      = request_int('help_group_sort');
		$data['help_group_title']     = request_string('help_group_title');
		$data['help_group_parent_id'] = request_int('help_group_parent_id');
		if(request_string('type') == 'rule')
        {
            $data['help_or_rule'] = '规则';
        }
        else
        {
            $data['help_or_rule'] = '帮助';
        }

		$help_group_id = $Help_GroupModel->addGroup($data, true);

		if ($help_group_id)
		{
			$msg    = _('success');
			$status = 200;
		}
		else
		{
			$msg    = _('failure');
			$status = 250;
		}
		$data['id']               = $help_group_id;
		$data['help_group_id'] = $help_group_id;
		$this->data->addBody(-140, $data, $msg, $status);
	}

	/*
	 * 删除数据
	 *
	 * @param   help_group_id    文章id
	 *
	 * @return  data    删除操作的id
	 *
	 */
	public function removeGroup()
	{
		$Help_GroupModel = new Help_GroupModel();

		$id = request_int('id');

		$flag = $Help_GroupModel->removeGroup($id);

		if ($flag)
		{
			$msg    = _('success');
			$status = 200;
		}
		else
		{
			$msg    = _('failure');
			$status = 250;
		}

		$data['id'] = $id;

		$this->data->addBody(-140, $data, $msg, $status);
	}

	/*
	 * 获取所有分类
	 *
	 * @return  re  查询出来的分类数据
	 */

	public function queryAllGroup()
	{
		$Help_GroupModel = new Help_GroupModel();
        $cond['help_or_rule'] = '帮助';
		$data       = $Help_GroupModel->getByWhere($cond);
		$data       = array_values($data);
		$re['rows'] = $data;
		$this->data->addBody(-140, $re);
	}

    public function helpGroupCat()
    {
        $Help_GroupModel = new Help_GroupModel();
        $data           = $Help_GroupModel->getCatTree();

        $this->data->addBody(-140, $data);
    }


}

?>