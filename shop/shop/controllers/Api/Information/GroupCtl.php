<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Api_Information_GroupCtl extends Api_Controller
{
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);

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
		$Information_GroupModel = new Information_GroupModel();
		$re                 = array();
		$id                 = request_int('id');
		if ($id)
		{
			$data              = $Information_GroupModel->getOne($id);
			$re['parent_name'] = $data['information_group_title'];
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
	 * @param   information_group_id    文章分类id
	 * @param   information_group_sort  文章排序
	 * @param   information_group_title 文章标题
	 * @param   information_group_parent_id 文章父类id
	 *
	 * @return  data    编辑的文章内容
	 */
	public function editGroup()
	{
		$Information_GroupModel = new Information_GroupModel();
		$data               = array();

		$information_group_id = request_int('information_group_id');

		$data['information_group_sort']      = request_int('information_group_sort');
		$data['information_group_title']     = request_string('information_group_title');
		$data['information_group_parent_id'] = request_int('information_group_parent_id');
		$flag                            = $Information_GroupModel->editGroup($information_group_id, $data);

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
		$data['id']               = $information_group_id;
		$data['information_group_id'] = $information_group_id;
		$this->data->addBody(-140, $data, $msg, $status);
	}

	/*
	 * 新增文章分类
	 *
	 * @param   information_group_sort  文章分类排序
	 * @param   information_group_title 文章分类标题
	 * @param   information_group_parent_id 文章分类父类id
	 *
	 * @return  data    新增成功的文章内容
	 */
	public function addGroup()
	{
		$Information_GroupModel = new Information_GroupModel();

		$data['information_group_sort']      = request_int('information_group_sort');
		$data['information_group_title']     = request_string('information_group_title');
		$data['information_group_parent_id'] = request_int('information_group_parent_id');

		$information_group_id = $Information_GroupModel->addGroup($data, true);

		if ($information_group_id)
		{
			$msg    = _('success');
			$status = 200;
		}
		else
		{
			$msg    = _('failure');
			$status = 250;
		}
		$data['id']               = $information_group_id;
		$data['information_group_id'] = $information_group_id;
		$this->data->addBody(-140, $data, $msg, $status);
	}

	/*
	 * 删除数据
	 *
	 * @param   information_group_id    文章id
	 *
	 * @return  data    删除操作的id
	 *
	 */
	public function removeGroup()
	{
		$Information_GroupModel = new Information_GroupModel();

		$id = request_int('id');

		$flag = $Information_GroupModel->removeGroup($id);

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

		$data['id']               = $id;

		$this->data->addBody(-140, $data, $msg, $status);
	}

	/*
	 * 获取所有分类
	 *
	 * @return  re  查询出来的分类数据
	 */

	public function queryAllGroup()
	{
		$Information_GroupModel = new Information_GroupModel();

		$data       = $Information_GroupModel->getByWhere();
		$data       = array_values($data);
		$re['rows'] = $data;
		$this->data->addBody(-140, $re);
	}


    public function informationGroupCat()
    {
        $Information_GroupModel = new Information_GroupModel();
        $data           = $Information_GroupModel->getCatTree();

        $this->data->addBody(-140, $data);
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
    public function informationGroupList()
    {
        $Information_GroupModel = new Information_GroupModel();
        $page               = request_int('page');
        $rows               = request_int('rows');
        $cond_rows          = array();
        $cond_rows['information_group_parent_id'] = 0;
        $order_rows         = array();
        $data               = $Information_GroupModel->listByWhere($cond_rows, $order_rows, $page, $rows);

        if($data['items'])
        {
            foreach ($data['items'] as $key=>$value)
            {
                $data['items'][$key]['cat_level'] = 1;
                $data['items'][$key]['cat_icon'] = 'ui-icon-star';
            }
            /*$pid_rows = array_column($data['items'],'information_group_id');

            $data_sub_rows = $Information_GroupModel->getByWhere(array('information_group_parent_id:IN'=>$pid_rows));

            if($data_sub_rows)
            {
                foreach ($data_sub_rows as $key=>$value)
                {
                    $data['items'][$value['information_group_parent_id']]['sub'][$key] = $value;
                }
            }*/
        }
        $this->data->addBody(-140, $data);
    }


}

?>