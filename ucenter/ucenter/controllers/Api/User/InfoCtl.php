<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Api_User_InfoCtl extends YLB_AppController
{
	public $userInfoModel     = null;

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

		$this->userInfoModel     = new User_InfoModel();
	}
    //yang
    public function getUserinsert($cond_row= array())
    {
        $userDetailModel = new User_InfoModel();
        $field = request_string('field');
        $cond['action_time:>='] =  request_string('action_time:>=') ;
        $cond['action_time:<']  =  request_string('action_time:<');
        $group = request_string('group');
        $data['items'] = $userDetailModel->select($field,$cond,$group);
        $this->data->addBody(-140,$data);
    }


}

?>