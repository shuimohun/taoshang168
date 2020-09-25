<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Help_BaseCtl extends Controller
{
	public $helpBaseModel = null;

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
		$this->initData();
		$this->web = $this->webConfig();
		$this->nav = $this->navIndex();
		$this->cat = $this->catIndex();
		//include $this->view->getView();
		$this->helpBaseModel = new Help_BaseModel();
	}

	/**
	 * 首页
	 * @param int help_id    文章id
     * @param help_group_id  文章分组id
	 * @access public
     *
	 */
	public function index()
	{
		$help_id       = request_int('help_id');
		$help_group_id = request_int('help_group_id');

		$Help_BaseModel  = new Help_BaseModel();
		$Help_GroupModel = new Help_GroupModel();

		/*//头部
		$Goods_CatModel = new Goods_CatModel();
		$data           = $Goods_CatModel->getCatListAll();

		//底部
		$data_help_foot = $Help_GroupModel->getHelpGroupList();*/

		//所有分类
		$data_all_group = $Help_GroupModel->getByWhere(array('help_group_parent_id' => 0));
        $data = $data_all_group;
		//最近文章
		$Help_BaseModel->sql->setLimit(0, 5);
		$data_recent_help = $Help_BaseModel->getByWhere(array(), array('help_add_time' => 'DESC'));

		if ($help_id)
		{
			$data_help      = $Help_BaseModel->getOne($help_id);
			$data_near_help = $Help_BaseModel->getNearHelp($help_id);
		}
		elseif ($help_group_id)
		{
			$data_help_list = $Help_GroupModel->getHelpGroupLists($help_group_id);
            $data = $data_help_list;
		}

		$title             = Web_ConfigModel::value("help_title");//首页名;
		$this->keyword     = Web_ConfigModel::value("help_keyword");//关键字;
		$this->description = Web_ConfigModel::value("help_description");//描述;
		$this->title       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $title);
		$this->title       = str_replace("{name}", "成长之路", $this->title);
		$this->keyword       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->keyword);
		$this->keyword      = str_replace("{name}", "成长之路", $this->keyword);
		$this->description       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->description);
		$this->description       = str_replace("{name}", "成长之路", $this->description);
		
		if($this->typ == 'json')
        {
            $this->data->addBody(-140,$data);
        }
        else
        {
            include $this->view->getView();
        }
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
	 * @param int $page 页码
     * @param int $rows 每页显示条数
     * @param string $sort 排序方式
     * @return array $data 查询数据
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
			$data = $this->helpBaseModel->getBaseList($cond_row, $order_row, $page, $rows);
		}
		else
		{
			$data = $this->helpBaseModel->getBaseList($cond_row, $order_row, $page, $rows);
		}


		$this->data->addBody(-140, $data);
	}

	/**
	 * 读取
     * @param int $help_id 文章id
     * @return array $data 查询结果
	 *
	 * @access public
	 */
	public function get()
	{
		$user_id = Perm::$userId;

		$help_id = request_int('help_id');
		$rows       = $this->helpBaseModel->getBase($help_id);

		$data = array();

		if ($rows)
		{
			$data = array_pop($rows);
		}

		$this->data->addBody(-140, $data);
	}

	/**
	 * 添加
	 * @param int       $help_id     文章id
     * @param string    $help_desc   描述
     * @param string    $help_title  标题
     * @param string    $help_url    调用url
     * @param int       $help_group_id   分组id
     * @param string    $help_template   模版
     * @aram  string    $help_seo_title  seo标题
     * @aram  string    $help_seo_keywords  SEO关键字
     * @aram  string    $help_seo_description  SEO描述
     * @aram  string    $help_seo_description  SEO描述
     *
	 * @access public
	 */
	public function add()
	{
		$data['help_id']              = request_string('help_id'); // ID
		$data['help_desc']            = request_string('help_desc'); // 描述
		$data['help_title']           = request_string('help_title'); // 标题
		$data['help_url']             = request_string('help_url'); // 调用网址-url，默认为本页面构造的网址，可填写其它页面
		$data['help_group_id']        = request_string('help_group_id'); // 组
		$data['help_template']        = request_string('help_template'); // 模板
		$data['help_seo_title']       = request_string('help_seo_title'); // SEO标题
		$data['help_seo_keywords']    = request_string('help_seo_keywords'); // SEO关键字
		$data['help_seo_description'] = request_string('help_seo_description'); // SEO描述
		$data['help_reply_flag']      = request_string('help_reply_flag'); // 是否启用问答留言
		$data['help_lang']            = request_string('help_lang'); // 语言
		$data['help_type']            = request_string('help_type'); // 类型-暂时忽略
		$data['help_sort']            = request_string('help_sort'); // 排序
		$data['help_status']          = request_string('help_status'); // 状态 1:启用  2:关闭
		$data['help_add_time']        = request_string('help_add_time'); // 添加世间
		$data['help_pic']             = request_string('help_pic'); // 文章图片


		$help_id = $this->helpBaseModel->addBase($data, true);

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

		$data['help_id'] = $help_id;

		$this->data->addBody(-140, $data, $msg, $status);
	}

	/**
	 * 删除操作
	 * @param  int help_id 文章id
	 * @access public
	 */
	public function remove()
	{
		$help_id = request_int('help_id');

		$flag = $this->helpBaseModel->removeBase($help_id);

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

		$data['help_id'] = array($help_id);

		$this->data->addBody(-140, $data, $msg, $status);
	}

	/**
	 * 修改
	 *
	 * @access public
	 */
	public function edit()
	{
		$data['help_id']              = request_string('help_id'); // ID
		$data['help_desc']            = request_string('help_desc'); // 描述
		$data['help_title']           = request_string('help_title'); // 标题
		$data['help_url']             = request_string('help_url'); // 调用网址-url，默认为本页面构造的网址，可填写其它页面
		$data['help_group_id']        = request_string('help_group_id'); // 组
		$data['help_template']        = request_string('help_template'); // 模板
		$data['help_seo_title']       = request_string('help_seo_title'); // SEO标题
		$data['help_seo_keywords']    = request_string('help_seo_keywords'); // SEO关键字
		$data['help_seo_description'] = request_string('help_seo_description'); // SEO描述
		$data['help_reply_flag']      = request_string('help_reply_flag'); // 是否启用问答留言
		$data['help_lang']            = request_string('help_lang'); // 语言
		$data['help_type']            = request_string('help_type'); // 类型-暂时忽略
		$data['help_sort']            = request_string('help_sort'); // 排序
		$data['help_status']          = request_string('help_status'); // 状态 1:启用  2:关闭
		$data['help_add_time']        = request_string('help_add_time'); // 添加世间
		$data['help_pic']             = request_string('help_pic'); // 文章图片


		$help_id = request_int('help_id');
		$data_rs    = $data;

		unset($data['help_id']);

		$flag = $this->helpBaseModel->editBase($help_id, $data);
		$this->data->addBody(-140, $data_rs);
	}
}

?>