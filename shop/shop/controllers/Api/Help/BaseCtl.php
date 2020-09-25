<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Api_Help_BaseCtl extends Api_Controller
{
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);

	}

	/*
	 * 获取文章列表
	 *
	 * @param int $page 页数
	 * @param int $rows 每页显示行数
	 *
	 * @return data 文章显示数据
	 */
	public function helpBaseList()
	{
		$Help_BaseModel  = new Help_BaseModel();
		$Help_GroupModel = new Help_GroupModel();

		$page      = request_int('page');
		$rows      = request_int('rows');
		$order_row = array();

		$help_group = request_int('help_group');
		$cond_row['help_or_rule']  = '帮助';
		if($help_group)
		{
			$cond_row['help_group_id'] = $help_group;
		}
		$data = $Help_BaseModel->listByWhere($cond_row, $order_row, $page, $rows);

		$items = $data['items'];
		unset($data['items']);
             
		if (!empty($items))
		{
			foreach ($items as $key => $value)
			{
				if ($value['help_status'] == $Help_BaseModel::ARTICLE_STATUS_TRUE)
				{
					$items[$key]['help_status_name'] = '开启';
				}
				elseif ($value['help_status'] == $Help_BaseModel::ARTICLE_STATUS_FALSE)
				{
					$items[$key]['help_status_name'] = '关闭';
				}

				$group_id = $value['help_group_id'];
				$group_items = $Help_GroupModel->getOne($group_id);
				if ($group_items['help_group_parent_id'] != 0){
				    $cond= $group_items['help_group_parent_id'];
				    $group_items_parent = $Help_GroupModel->getOne($cond);
                }
                $items[$key]['help_group_name_c'] = $group_items_parent['help_group_title'];
				$items[$key]['help_group_name'] = $Help_GroupModel->getGroupName($value['help_group_id']);
			}
		}
		if ($items)
		{
			$msg    = _('success');
			$status = 200;
		}
		else
		{
			$msg    = _('failure');
			$status = 250;
		}
		$data['items'] = $items;
		$this->data->addBody(-140, $data, $msg, $status);
	}

	/*
	 * 删除文章
	 *
	 * @param int help_id 文章id
	 *
	 * @return data 操作记录id
	 */
	public function removeBase()
	{
		$Help_BaseModel = new Help_BaseModel();

		$id = request_int('help_id');
		if ($id)
		{
			$flag = $Help_BaseModel->removeBase($id);
		}
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
	 * 新增文章
	 *
	 * @param   help_title   文章标题
	 * @param   help_url     文章链接地址
	 * @param   help_status  文章状态
	 * @param   help_type    文章类型
	 * @param   help_sort    文章排序
	 * @param   help_desc    文章描述
	 * @param   help_logo    文章图片
	 * @param   help_group_id文章分类
	 *
	 * @return  data            新增的文章内容
	 */
	public function addHelpBase()
	{
		$Help_BaseModel = new Help_BaseModel();

		$data = array();

		$data['help_title']  = request_string('help_title');
		$data['help_url']    = request_string('help_url');
		$data['help_status'] = request_int('help_status');
		$data['help_type']   = request_int('help_type');
		$data['help_sort']   = request_int('help_sort');
		$data['help_desc']   = request_string('content');
		$data['help_or_rule']   = '帮助';
		//$data['help_pic']    = request_string('help_pic');
		$help_pic_row          = request_row('setting');
		$data['help_pic']      = $help_pic_row['help_logo'];
		$data['help_group_id'] = request_int('help_group_id');
		$data['help_add_time'] = date('Y-m-d H:i:s', time());

		$help_id = $Help_BaseModel->addBase($data, true);

		if ($help_id)
		{
			$msg    = _('success');
			$status = 200;
		}
		else
		{
			$msg    = _('failure');
			$status = 250;
		}

		$data['id']         = $help_id;
		$data['help_id'] = $help_id;
		

		$Help_GroupModel = new Help_GroupModel();
		$data['help_group_name'] = $Help_GroupModel->getGroupName($data['help_group_id']);
		
		if ($data['help_status'] == $Help_BaseModel::ARTICLE_STATUS_TRUE)
		{
			$data['help_status_name'] = _('开启');
		}
		elseif ($data['help_status'] == $Help_BaseModel::ARTICLE_STATUS_FALSE)
		{
			$data['help_status_name'] = _('关闭');
		}
		
		$this->data->addBody(-140, $data, $msg, $status);
	}

    /*
     * 编辑文章
     *
     * @param   help_id      文章id
     * @param   help_title   文章标题
     * @param   help_url     文章链接地址
     * @param   help_status  文章状态
     * @param   help_type    文章类型
     * @param   help_sort    文章排序
     * @param   help_desc    文章描述
     * @param   help_pic     文章图片
     * @param   help_group_id文章分类
     *
     * @return   data           编辑的内容
     */
	public function editHelpBase()
	{

		$Help_BaseModel = new Help_BaseModel();

		$help_id = request_int('help_id');

		$data['help_title']  = request_string('help_title');
		$data['help_url']    = request_string('help_url');
		$data['help_status'] = request_int('help_status');
		$data['help_type']   = request_int('help_type');
		$data['help_sort']   = request_int('help_sort');
		$data['help_desc']   = request_string('content');
        $data['help_or_rule']   = '帮助';
        //$data['help_pic']    = request_string('help_pic');
		$help_pic_row          = request_row('setting');
		$data['help_pic']      = $help_pic_row['help_logo'];
		$data['help_group_id'] = request_int('help_group_id');
		$flag                     = $Help_BaseModel->editBase($help_id, $data);

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

		$data['id']         = $help_id;
		$data['help_id'] = $help_id;

		$this->data->addBody(-140, $data, $msg, $status);
	}

	public function helpGroup()
	{
		$Help_GroupModel = new Help_GroupModel();
		$order = array('help_group_sort' => 'asc');
        $cond['help_or_rule'] = '帮助';
        $cond['help_group_parent_id'] = 0;
		$data  = $Help_GroupModel->getByWhere($cond,$order);
		$data = array_values($data);
		$result = array();
		$result[0]['id'] = 0;
		$result[0]['name'] = "帮助分类";
		foreach($data as $key=>$value)
		{
			$result[$key+1]['id'] = $value['help_group_id'];
			$result[$key+1]['name'] = $value['help_group_title'];
		}

		$this->data->addBody(-140, $result);
	}
	public function helpGroupSon(){
	    $Pid = request_int('pid',0);
        $Help_GroupModel = new Help_GroupModel();
        $order = array('help_group_sort' => 'asc');
        $cond['help_or_rule'] = '帮助';
        $cond['help_group_parent_id'] = $Pid;
        $data  = $Help_GroupModel->getByWhere($cond,$order);
        $data = array_values($data);
        $result = array();
        $result[0]['id'] = 0;
        $result[0]['name'] = "帮助分类";
        foreach($data as $key=>$value)
        {
            $result[$key+1]['id'] = $value['help_group_id'];
            $result[$key+1]['name'] = $value['help_group_title'];
        }

        $this->data->addBody(-140, $result);
    }

	public function getGroupByClass(){
	    $Help_GroupModel = new Help_GroupModel();
	    $cond['help_or_rule'] = '帮助';
	    $cond['help_group_parent_id'] = request_int('p_id',0);
	    $data1 = $Help_GroupModel->listByWhere($cond);
	    $data = $data1['items'];
        $this->data->addBody(-140, $data);

    }
}

?>