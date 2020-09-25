<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}
error_reporting(E_ALL & ~(E_STRICT | E_NOTICE));

/**
 * @author     WenQingTeng
 */
class Api_ChatlogCtl  extends YLB_AppController
{
    public $model;
    public function __construct(&$ctl, $met, $typ)
    {
        parent::__construct($ctl, $met, $typ);
        $this->model = new Chatlog;
    }

    /**
     * 获取聊天记录
     */
    public function get()
    {
        $r = $this->model->getChatlog();

        $html = $this->model->getChatlogHtml($r);
        echo $html;
    }

    /**
     * 添加聊天记录
     */
    public function add()
    {
        $data['sender']   = trim($_POST['u']);
        $data['receiver'] = trim($_POST['to']);
        $data['msgid']    = trim($_POST['msgid']);
        $data['content']  = trim($_POST['content']);
        $data['type']     = trim($_POST['type']);
        $data['created']  = time();
        if(!$data['sender'] || !$data['receiver'] || !$data['msgid'] || !$data['content'])
        {
            $this->data->setError('异常错误');
        }
        else
        {
            $id =  $this->model->addChatlog($data);
            $out= array('id' => $id);
        }

        $this->data->addBody(100, $out);
    }


}
 