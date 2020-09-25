<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class GoodsCtl extends YLB_AppController
{
	public $userInfoModel     = null;
	public $userBaseModel     = null;
	private $rest = null;

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
		
//		$this->userInfoModel     = new User_InfoModel();
		$this->userBaseModel     = new User_BaseModel();
		$this->userGoodsModel     = new User_GoodsModel();

	}

	/**
	 *获取用户信息
	 */
	public function getUserGoods()
	{
		$user_id = request_int('user_id');
		$page = request_int('page') ? intval(request_int('page')) : 1;
		$rows = request_int('rows') ? intval(request_int('rows')) : 20;
		$sort = request_int('sort') ? intval(request_int('sort')) : 'asc';
		$User_GoodsModel = new User_GoodsModel();
		$data = $User_GoodsModel->getUserGoodsList($user_id,$page,$rows,$sort);

		fb($data);

		$this->data->addBody(-140,$data);
	}


	
}

?>