<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Api_Information_ReplyCtl extends Api_Controller
{
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);

	}

	/*
	 * 文章评论列表
	 *
	 * @param   page    页码
	 * @param   rows    每天显示条数
	 *
	 * @return  data    文章分类数据
	 *
	 */
	public function informationReplyList()
	{

		$Information_ReplyModel = new Information_ReplyModel();
		$page               = request_int('page');
		$rows               = request_int('rows');
		$cond_rows          = array();
		$order_rows         = array();
		$order_rows['article_reply_time'] = 'desc';
//        $order['information_add_time'] = 'desc';

        $data               = $Information_ReplyModel->listByWhere($cond_rows, $order_rows, $page, $rows);
//		var_dump($data);die;
		foreach ($data['items'] as $k => $v){
		    $con['information_id'] = $v['article_id'];
		    $Information_BaseModel = new Information_BaseModel();
            $infor_row = $Information_BaseModel->getByWhere($con);
            $data['items'][$k]['information_title'] = $infor_row[$v['article_id']]['information_title'];

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
        $cond['article_id'] = $article_id;
        $order['article_reply_time'] = 'desc';
        $data['items'] = $informationReplyModel->getByWhere($cond,$order);
        foreach ($data['items'] as $k =>$v){
//            $sql = "select user_logo from ylb_user_info where user_id=".$v['user_id'];
            $cond_row['user_id'] = $v['user_id'];
            $users = $User_base ->getByWhere($cond_row,$order_row);
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


    /*
     * 编辑文章是否显示
     *
     * @return  data
     */
	public function editReply()
	{
        $Information_ReplyModel = new Information_ReplyModel();
		$data               = array();

		$article_reply_id = request_int('article_reply_id');

		$data['article_reply_show_flag']      = request_string('article_reply_show_flag');

		$flag                            = $Information_ReplyModel->editReply($article_reply_id, $data);

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
		$data['id']               = $article_reply_id;
		$this->data->addBody(-140, $data, $msg, $status);
	}

	/*
	 * 删除数据
	 *
	 * @param   information_group_id    评论id
	 *
	 * @return  data    删除操作的id
	 *
	 */
	public function removeReply()
	{
		$Information_ReplyModel = new Information_ReplyModel();

		$id = request_int('article_reply_id');

		$flag = $Information_ReplyModel->removeReply($id);

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
		$data['information_group_id'] = $id;

		$this->data->addBody(-140, $data, $msg, $status);
	}


}

?>