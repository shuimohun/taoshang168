<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Information_GroupCtl extends YLB_AppController
{
	public $informationGroupModel = null;

	/**
	 * Constructor
	 *
	 * @param  string $ctl 控制器目录
	 * @param  string $met 控制器方法
	 * @param  string $typ 返回数据类型
	 * @access public
	 */
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);

		//include $this->view->getView();
		$this->informationGroupModel = new Information_GroupModel();
	}

	/**
	 * 首页
	 *
	 * @access public
	 */
	public function index()
	{
		include $this->view->getView();
	}

	/**
	 * 管理界面
	 *
	 * @access public
	 */
	public function manage()
	{
		include $this->view->getView();
	}

	/**
	 * 列表数据
	 *
	 * @access public
	 */
	public function lists()
	{
		$user_id = Perm::$userId;

		$page = request_int('page',1);
		$rows = request_int('rows',20);
		$cond_row  = array();
		$order_row = array();
		$data = $this->informationGroupModel->getGroupList();
		$this->data->addBody(-140, $data);
	}

	/**
	 * 读取
	 *
	 * @access public
	 */
	public function get()
	{
		$user_id = Perm::$userId;

		$information_group_id = request_int('information_group_id');
		$rows             = $this->informationGroupModel->getGroup($information_group_id);

		$data = array();

		if ($rows)
		{
			$data = array_pop($rows);
		}

		$this->data->addBody(-140, $data);
	}

	/**
	 * 添加
	 *
	 * @access public
	 */
	public function add()
	{
		$data['information_group_id']        = request_string('information_group_id'); // ID
		$data['information_group_title']     = request_string('information_group_title'); // 标题
		$data['information_group_lang']      = request_string('information_group_lang'); // 语言
		$data['information_group_sort']      = request_string('information_group_sort'); // 排序
		$data['information_group_logo']      = request_string('information_group_logo'); // logo
		$data['information_group_parent_id'] = request_string('information_group_parent_id'); // 上级分类id


		$information_group_id = $this->informationGroupModel->addGroup($data, true);

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

		$data['information_group_id'] = $information_group_id;

		$this->data->addBody(-140, $data, $msg, $status);
	}

	/**
	 * 删除操作
	 *
	 * @access public
	 */
	public function remove()
	{
		$information_group_id = request_int('information_group_id');

		$flag = $this->informationGroupModel->removeGroup($information_group_id);

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

		$data['information_group_id'] = array($information_group_id);

		$this->data->addBody(-140, $data, $msg, $status);
	}

	/**
	 * 修改
	 *
	 * @access public
	 */
	public function edit()
	{
		$data['information_group_id']        = request_string('information_group_id'); // ID
		$data['information_group_title']     = request_string('information_group_title'); // 标题
		$data['information_group_lang']      = request_string('information_group_lang'); // 语言
		$data['information_group_sort']      = request_string('information_group_sort'); // 排序
		$data['information_group_logo']      = request_string('information_group_logo'); // logo
		$data['information_group_parent_id'] = request_string('information_group_parent_id'); // 上级分类id


		$information_group_id = request_int('information_group_id');
		$data_rs          = $data;

		unset($data['information_group_id']);

		$flag = $this->informationGroupModel->editGroup($information_group_id, $data);
		$this->data->addBody(-140, $data_rs);
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