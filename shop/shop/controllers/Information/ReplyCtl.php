<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Information_ReplyCtl extends Controller
{
	public $informationReplyModel = null;

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
		$this->informationReplyModel = new Information_ReplyModel();
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
			$data = $this->informationReplyModel->getReplyList($cond_row, $order_row, $page, $rows);
		}
		else
		{
			$data = $this->informationReplyModel->getReplyList($cond_row, $order_row, $page, $rows);
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
        $User_base = new User_BaseModel();
        $informationReplyModel = new Information_ReplyModel();

        $article_id =  request_string('article_id');

		$sql = 'select * from ylb_information_reply WHERE  article_id = '.$article_id .' order by article_reply_time desc';

        $data['items'] = $informationReplyModel->sql($sql);

        foreach ($data['items'] as $k =>$v){
            $sql = "select user_logo from ylb_user_info where user_id=".$v['user_id'];
            $users = $User_base ->sql($sql);
            $data['items'][$k]['user_logo'] = $users[0]['user_logo'];
        }
        if ($data)
        {
            $msg    = _('success');
            $status = 200;
        }
        else
        {
            $msg    = _('failure');
            $status = 250;
        }

		$this->data->addBody(-140, $data,$msg,$status);
	}


    //评论
    /**
     * 添加
     *
     * @access public
     */
    public function add()
    {
        $User_base = new User_BaseModel();
//		$data['information_reply_id']        = request_string('information_reply_id'); // 评论回复id
//		$data['information_reply_parent_id'] = request_string('information_reply_parent_id'); // 回复父id
        $data['article_id']              = request_string('information_id'); // 所属文章id
        $data['user_id']                 =  Perm::$userId; // 评论回复id
        $sql = "select user_name,user_logo from ylb_user_info where user_id=".Perm::$userId;
        $users = $User_base ->sql($sql);
        $data['user_name'] = $users[0]['user_name'];
//		$data['user_id_to']              = request_string('user_id_to'); // 评论回复用户id
//		$data['user_name_to']            = request_string('user_name_to'); // 评论回复用户名称
        $matche_row = array();

        if (Text_Filter::checkBanned(request_string('information_reply_content'), $matche_row))
        {
            $data   = array();
            $msg    = _('含有违禁词');
            $status = 250;
            $this->data->addBody(-140, array(), $msg, $status);
            return false;
        }

        $data['article_reply_content']   =  Text_Filter::filterWords(request_string('information_reply_content')); // 评论回复内容
        $data['article_reply_time']      = date("Y-m-d H:i:s",time()); // 评论回复时间
        $data['article_reply_show_flag'] = 1; // 问答是否显示
        $information_reply_id = $this->informationReplyModel->addReply($data, true);

        if ($information_reply_id)
        {
            $msg    = _('success');
            $status = 200;
        }
        else
        {
            $msg    = _('failure');
            $status = 250;
        }
        $data['user_logo'] = $users[0]['user_logo'];

        $data['information_reply_id'] = $information_reply_id;

        $this->data->addBody(-140, $data, $msg, $status);
    }



    /**
	 * 删除操作
	 *
	 * @access public
	 */
	public function remove()
	{
		$information_reply_id = request_int('information_reply_id');

		$flag = $this->informationReplyModel->removeReply($information_reply_id);

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

		$data['information_reply_id'] = array($information_reply_id);

		$this->data->addBody(-140, $data, $msg, $status);
	}

	/**
	 * 修改
	 *
	 * @access public
	 */
	public function edit()
	{
		$data['information_reply_id']        = request_string('information_reply_id'); // 评论回复id
		$data['information_reply_parent_id'] = request_string('information_reply_parent_id'); // 回复父id
		$data['information_id']              = request_string('information_id'); // 所属文章id
		$data['user_id']                 = request_string('user_id'); // 评论回复id
		$data['user_name']               = request_string('user_name'); // 评论回复姓名
		$data['user_id_to']              = request_string('user_id_to'); // 评论回复用户id
		$data['user_name_to']            = request_string('user_name_to'); // 评论回复用户名称
		$data['information_reply_content']   = request_string('information_reply_content'); // 评论回复内容
		$data['information_reply_time']      = request_string('information_reply_time'); // 评论回复时间
		$data['information_reply_show_flag'] = request_string('information_reply_show_flag'); // 问答是否显示


		$information_reply_id = request_int('information_reply_id');
		$data_rs          = $data;

		unset($data['information_reply_id']);

		$flag = $this->informationReplyModel->editReply($information_reply_id, $data);
		$this->data->addBody(-140, $data_rs);
	}
}

?>