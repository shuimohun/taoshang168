<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Help_GroupCtl extends Controller
{
	public $helpGroupModel = null;
	public $helpBaseModel  = null;

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
		$this->helpGroupModel = new Help_GroupModel();
		$this->helpBaseModel = new Help_BaseModel();
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
		$page = request_int('page');
		$rows = request_int('rows');
		$sort = request_int('sord');

		$cond_row  = array();
		$order_row = array();

		$data = array();

		if ($skey = request_string('skey'))
		{
			$data = $this->helpGroupModel->getGroupList($cond_row, $order_row, $page, $rows);
		}
		else
		{
			$data = $this->helpGroupModel->getGroupList($cond_row, $order_row, $page, $rows);
		}


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

		$help_group_id = request_int('help_group_id');
		$rows             = $this->helpGroupModel->getGroup($help_group_id);

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
		$data['help_group_id']        = request_string('help_group_id'); // ID
		$data['help_group_title']     = request_string('help_group_title'); // 标题
		$data['help_group_lang']      = request_string('help_group_lang'); // 语言
		$data['help_group_sort']      = request_string('help_group_sort'); // 排序
		$data['help_group_logo']      = request_string('help_group_logo'); // logo
		$data['help_group_parent_id'] = request_string('help_group_parent_id'); // 上级分类id


		$help_group_id = $this->helpGroupModel->addGroup($data, true);

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

		$data['help_group_id'] = $help_group_id;

		$this->data->addBody(-140, $data, $msg, $status);
	}

	/**
	 * 删除操作
	 *
	 * @access public
	 */
	public function remove()
	{
		$help_group_id = request_int('help_group_id');

		$flag = $this->helpGroupModel->removeGroup($help_group_id);

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

		$data['help_group_id'] = array($help_group_id);

		$this->data->addBody(-140, $data, $msg, $status);
	}

	/**
	 * 修改
	 *
	 * @access public
	 */
	public function edit()
	{
		$data['help_group_id']        = request_string('help_group_id'); // ID
		$data['help_group_title']     = request_string('help_group_title'); // 标题
		$data['help_group_lang']      = request_string('help_group_lang'); // 语言
		$data['help_group_sort']      = request_string('help_group_sort'); // 排序
		$data['help_group_logo']      = request_string('help_group_logo'); // logo
		$data['help_group_parent_id'] = request_string('help_group_parent_id'); // 上级分类id


		$help_group_id = request_int('help_group_id');
		$data_rs          = $data;

		unset($data['help_group_id']);

		$flag = $this->helpGroupModel->editGroup($help_group_id, $data);
		$this->data->addBody(-140, $data_rs);
	}


}

?>