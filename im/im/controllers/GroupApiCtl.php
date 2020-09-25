<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * Api接口
 *
 *
 * @category   Game
 * @package    User
 * @author     WenQingTeng
 * @copyright  Copyright (c) 2017, 温庆腾
 * @version    1.0
 * @todo
 */
class GroupApiCtl extends YLB_AppController
{
	public $userGroupRelModel = null;
	public $userGroupModel = null;

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
		$this->userGroupModel = new User_GroupModel();
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
	 * 获得用户分组
	 *
	 * @access public
	 */
	public function getUserGroup(){
		$user_id = $_REQUEST["user_id"];
		$GroupModel = new User_GroupModel();
		$FriendModel = new User_FriendModel();
		$data = $GroupModel->getUserGroup($user_id);
		//获取好友数量
		$User_FriendModel = new User_FriendModel();
		$user_friend_rows = $User_FriendModel->getUserFriendId($user_id);
		$count = count($user_friend_rows);
		fb($data);
		$sum = 0;
		foreach($data as $k =>$v){
			$list = $FriendModel->getGroupFriend($v["group_id"]);
			$num = 0;
			foreach($list as $key => $val){
				$num = $num +1;
			}
			$data[$k]["friend_num"] = $num;
		}
		$data["count"] = $count;
		$this->data->addBody(-140, $data);
	}
	/**
	 * 列表数据
	 *
	 * @access public
	 */
	public function groupList()
	{
		$user_id = Perm::$userId;

		$page = $_REQUEST['page'];
		$rows = $_REQUEST['rows'];
		$sort = $_REQUEST['sort'];


		$data = array();

		if (isset($_REQUEST['skey']))
		{
			$skey = $_REQUEST['skey'];

			$data = $this->userGroupModel->getGroupList('*', $page, $rows, $sort);
		}
		else
		{
			$data = $this->userGroupModel->getGroupList('*', $page, $rows, $sort);
		}

//		echo '<pre>';print_r(array($page, $rows, $sort ,$data));exit;
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

		$group_id = $_REQUEST['group_id'];
		$rows = $this->userGroupModel->getGroup($group_id);

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
	public function add_shanghai()
	{
		$user_name = Perm::$row['user_name'];
		$user_id = Perm::$row['user_id'];
		$group_name = request_string('group_name');
		$group_type = request_int('group_type');
		$group_permission = request_int('group_permission');
		$group_declared = request_string('group_declared');
		$data = array();

		if (!$group_name)
		{
			$msg = '请输入群组名称';
			$status = 250;
		}
		else
		{
			//判断群组是否存在
			$data['group_name']             = $group_name         ; // 组名称
			$data['group_type']             = $group_type         ; // 组分类（商品等）
			$data['group_permission']       = $group_permission     ; //
			$data['group_declared']         = $group_declared     ; //
			$data['user_id']                = $user_id            ;

			$User_GroupModel = new User_GroupModel();
			$group_id = $this->userGroupModel->addGroup($data, true);

			if ($group_id)
			{
				$data['group_id'] = $group_id;
				$msg = 'success';
				$status = 200;
			}
			else
			{
				$msg = 'failure:群组名称已经存在';
				$status = 250;
			}
		}


		$this->data->addBody(-140, $data, $msg, $status);
	}


	/**
	 * 添加
	 *
	 * @access public
	 */
	public function add()
	{
		$user_name = Perm::$row['user_account'];
		$user_id = Perm::$userId;
		$user_row=request_string('user_row');
		$group_type = request_int('group_type','0');
		$group_permission = request_int('group_permission','0');
		$group_declared = request_string('group_declared');
		$group_bind_id=request_string('group_bind_id');
		$user_rows=explode(',',$user_row);
		$user_Base=new User_BaseModel();
		$userInfo=new User_InfoModel();
		$datas=array();
		foreach($user_rows as $k=>$v){
			$dataUser=$user_Base->getUser($v);
			$dataInfo=$userInfo->getInfo($dataUser[$v]['user_account']);
			if($dataInfo[$dataUser[$v]['user_account']]['nickname']){
				$dataInfo[$dataUser[$v]['user_account']]['user_name']=$dataInfo[$dataUser[$v]['user_account']]['nickname'];

			}
			array_push($datas,$dataInfo[$dataUser[$v]['user_account']]['user_name']);
		}
		$data['group_name']=implode(',',$datas);
		$group_name=$data['group_name'];
		$data = array();

		if (!$group_name)
		{
			$msg = '请输入群组名称';
			$status = 250;
		}
		else
		{
			//判断群组是否存在
			$data['group_name']             = $group_name         ; // 组名称
			$data['group_type']             = $group_type         ; // 组分类（商品等）
			$data['group_permission']       = $group_permission     ; //
			$data['group_declared']         = $group_declared     ; //
			$data['user_id']                = $user_id            ;
			$data['group_user']=$user_row;
			$data['group_bind_id']=$group_bind_id;
			$User_GroupModel = new User_GroupModel();
			$group_id = $this->userGroupModel->addGroup($data, true);

			if ($group_id)
			{
				$data['group_id'] = $group_id;
				$msg = 'success';
				$status = 200;
			}
			else
			{
				$msg = 'failure:群组名称已经存在';
				$status = 250;
			}
		}


		$this->data->addBody(-140, $data, $msg, $status);
	}

	//添加分组
	public function addGroup()
	{
		$user_name = $_REQUEST['user_name'];
		$user_id = request_int('user_id');
		$group_name = request_string('group_name');
		$group_type = request_int('group_type');
		$group_permission = request_int('group_permission');
		$group_declared = request_string('group_declared');
		$group_describe = request_string('group_describe');
		$data = array();
		if($user_id){
		if (!$group_name)
		{
			$msg = '请输入群组名称';
			$status = 250;
		}
		else
		{

			$data['group_name']             = $group_name         ; // 组名称
			$data['group_type']             = $group_type         ; // 组分类（商品等）
			$data['group_permission']       = $group_permission     ; //
			$data['group_declared']         = $group_declared     ; //
			$data['user_id']                = $user_id            ;
			$data['group_describe']		=$group_describe;

			$User_GroupModel = new User_GroupModel();
			$group_id = $this->userGroupModel->addGroup($data, true);

			if ($group_id)
			{
				$data['group_id'] = $group_id;
				$msg = 'success';
				$status = 200;
			}
		}

		}else{
			$msg = '请登录';
			$status = 250;
		}
		$this->data->addBody(-140, $data, $msg, $status);
	}



	/**
	 * 绑定sdk group id
	 *
	 * @access public
	 */
	public function bind()
	{
		$user_name = Perm::$row['user_name'];
		$user_id = Perm::$row['user_id'];

		$group_id = request_int('group_id');
		$group_bind_id = request_string('group_bind_id');

		$rows = $this->userGroupModel->getGroup($group_id);

		$data = array();
		$data['group_bind_id'] = $group_bind_id;

		if ($rows && $rows[$group_id]['user_id'] == $user_id)
		{
			$flag = $this->userGroupModel->editGroup($group_id, $data);

			if ($flag)
			{
				$msg = 'sucess';
				$status = 200;
			}
			else
			{
				$msg = 'failure';
				$status = 250;
			}
		}
		else
		{
			$msg = 'failure';
			$status = 250;
		}

		$this->data->addBody(-140, $data);
	}

	//删除群组
	public function delect()
	{
		$user_name = $_REQUEST['user_account'];
		$user_id = $_REQUEST['user_id'];

		$group_id = request_string('group_id');

			if ($group_id) {
				$rows = $this->userGroupModel->getGroup($group_id);
			}

		if ($rows && $rows[$group_id]['user_id'] == $user_id) {
			$flag = $this->userGroupModel->removeGroup($group_id);
		} else {
			$msg = 'failure';
			$status = 250;
		}
	}
	/**
	 * 删除操作
	 *
	 * @access public
	 */


	public function remove()
	{
		$user_name = Perm::$row['user_name'];
		$user_id = Perm::$row['user_id'];

		$group_bind_id = request_string('group_bind_id');

		if ($group_bind_id)
		{
			$group_id = $this->userGroupModel->getIdByGroupBindId($group_bind_id);

			if ($group_id)
			{
				$rows = $this->userGroupModel->getGroup($group_id);
			}
		}


		if ($rows && $rows[$group_id]['user_id'] == $user_id)
		{
			$flag = $this->userGroupModel->removeGroup($group_id);

			if ($flag)
			{
				//删除成员
				$User_GroupRelModel = new User_GroupRelModel();
				$rel_id_rows = $User_GroupRelModel->getIdByGroupId($group_id);

				$msg = 'success';
				$status = 200;
			}
			else
			{
				$msg = 'failure';
				$status = 250;
			}
		}
		else
		{
			$msg = 'failure';
			$status = 250;
		}


		$data['group_id'] = $group_id;

		$this->data->addBody(-140, $data, $msg, $status);
	}

	/**
	 * 修改
	 *
	 * @access public
	 */
	public function edit_shanghai()
	{
		$user_name = Perm::$row['user_name'];
		$user_id = Perm::$row['user_id'];

		$group_bind_id = request_string('group_bind_id');
		$group_name = request_string('group_name');
		//$group_type = request_int('group_type');
		$group_permission = request_int('group_permission');
		$group_declared = request_string('group_declared');


		//判断群组是否存在
		$data = array();
		$data['group_name']             = $group_name         ; // 组名称
		$data['group_permission']       = $group_permission     ; //

		if ($group_declared)
		{
			$data['group_declared']         = $group_declared     ; //
		}

		$data_rs = $data;

		unset($data['group_id']);


		if ($group_bind_id)
		{
			$group_id = $this->userGroupModel->getIdByGroupBindId($group_bind_id);

			$rows = $this->userGroupModel->getGroup($group_id);
		}

		if ($rows && $rows[$group_id]['user_id'] == $user_id)
		{
			$flag = $this->userGroupModel->editGroup($group_id, $data);
		}
		else
		{
			$msg = 'failure';
			$status = 250;
		}

		$this->data->addBody(-140, $data_rs);
	}


	/**
	 * 修改
	 *
	 * @access public
	 */
	public function edit()
	{
		$user_name = Perm::$row['user_account'];
		$user_id = Perm::$row['user_id'];

		$group_bind_id = request_string('group_bind_id');
		$group_name = request_string('group_name');
		//$group_type = request_int('group_type');
		$group_declared = request_string('group_declared');

		$datas=array();
		//判断群组是否存在
		$res = $this->userGroupModel->checkUserGroup($user_id,$group_bind_id);

		if($res)
		{
			$data = array();

			if ($group_declared)
			{
				$data['group_declared']         = $group_declared     ; //
			}
			if($group_name)
			{
				$data['group_name']=$group_name;
			}

			$rows = array();

			$rows = $this->userGroupModel->getGIdByGroupBindId($group_bind_id);

			if ($rows)
			{
				$flag = $this->userGroupModel->editGroup($rows, $data);
				if($flag){
					$msg='success';
					$status=200;
					$datas['msg']='修改群主信息成功';
				}else
				{
					$msg = 'failure';
					$status = 250;
					$datas['message']='修改群组信息失败';
				}

			}
			else
			{
				$msg = 'failure';
				$status = 250;
				$datas['message']='修改群组信息失败';
			}
		}
		else
		{
			$msg = 'failure';
			$status = 250;
			$datas['message']='修改群组信息失败';
		}

		$this->data->addBody(-140, $datas);
	}

	/**
	 * 修改群组
	 *
	 * @access public
	 */
	public function editGroup()
	{
		$user_name = $_REQUEST['user_name'];
		$user_id = $_REQUEST['user_id'];
		$group_name = request_string('group_name');
		$group_type = request_int('group_type');
		$group_permission = request_int('group_permission');
		$group_declared = request_string('group_declared');
		$group_describe = request_string('group_describe');
		$group_id = request_int('group_id');
		$data = array();

		//判断群组是否存在
		$data['group_name'] = $group_name; // 组名称
		$data['group_type'] = $group_type; // 组分类（商品等）
		$data['group_permission'] = $group_permission; //
		$data['group_declared'] = $group_declared; //
		$data['user_id'] = $user_id;
		$data['group_describe'] = $group_describe;

//		$group_id =127;
//		$user_id = 10036;
//		$data['group_name'] = "名称111"; // 组名称
//		$data['group_type'] = 1; // 组分类（商品等）
//		$data['group_permission'] = 2; //
//		$data['group_declared'] = 3; //
//		$data['user_id'] = 10036;
//		$data['group_describe'] = 4;

		//查询分组是否存在
		$GroupModel = new User_GroupModel();
		$list = $GroupModel->getUserGroup($user_id,$group_id);

		if (!empty($list)) {
			$group = $this->userGroupModel->editGroup($group_id, $data);
		}

		if (!empty($group))
		{
			$data['group_id'] = $group;
			$msg = 'success';
			$status = 200;
			}else{
				$msg = 'failure';
				$status = 250;
		}


		$this->data->addBody(-140, $data);
	}

	//

	/**
	 * 读取
	 *
	 * @access public
	 */
	public function getGroupMember()
	{
		$user_id = Perm::$userId;

		$group_rel_id = $_REQUEST['group_rel_id'];

		$this->userGroupRelModel = new User_GroupRelModel();
		$rows = $this->userGroupRelModel->getGroupRel($group_rel_id);

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
	public function addGroupMember()
	{
		$user_name = Perm::$row['user_name'];
		$user_id = Perm::$row['user_id'];

		$data['group_id']               = $_REQUEST['group_id']           ; // 好友组ID
		$data['user_id']                = $_REQUEST['user_id']            ; // 成员id
		$data['user_label']             = $_REQUEST['user_label']         ; //


		$this->userGroupRelModel = new User_GroupRelModel();
		$group_rel_id = $this->userGroupRelModel->addGroupRel($data, true);

		if ($group_rel_id)
		{
			$msg = 'success';
			$status = 200;
		}
		else
		{
			$msg = 'failure';
			$status = 250;
		}

		$data['group_rel_id'] = $group_rel_id;

		$this->data->addBody(-140, $data, $msg, $status);
	}

	/**
	 * 删除操作
	 *
	 * @access public
	 */
	public function removeGroupMember()
	{
		$user_name = Perm::$row['user_name'];
		$user_id = Perm::$row['user_id'];

		$group_rel_id = $_REQUEST['group_rel_id'];

		$this->userGroupRelModel = new User_GroupRelModel();
		$flag = $this->userGroupRelModel->removeGroupRel($group_rel_id);

		if ($flag)
		{
			$msg = 'success';
			$status = 200;
		}
		else
		{
			$msg = 'failure';
			$status = 250;
		}

		$data['group_rel_id'] = $group_rel_id;

		$this->data->addBody(-140, $data, $msg, $status);
	}

	/**
	 * 修改
	 *
	 * @access public
	 */
	public function editGroupMember()
	{
		$user_name = Perm::$row['user_name'];
		$user_id = Perm::$row['user_id'];

		$data['group_rel_id']           = $_REQUEST['group_rel_id']       ; //
		$data['group_id']               = $_REQUEST['group_id']           ; // 好友组ID
		$data['user_id']                = $_REQUEST['user_id']            ; // 成员id
		$data['user_label']             = $_REQUEST['user_label']         ; //


		$group_rel_id = $_REQUEST['group_rel_id'];
		$data_rs = $data;

		unset($data['group_rel_id']);

		$this->userGroupRelModel = new User_GroupRelModel();
		$flag = $this->userGroupRelModel->editGroupRel($group_rel_id, $data);
		$this->data->addBody(-140, $data_rs);
	}



	//获取用户组成员的信息
	//参数 用户组的id号
	public function getGroupInfo(){
		$group_bind_id=request_string('group_bind_id');//gg80153831740
		$group=new User_GroupModel();
		$group_id=$group->getIdByGroupBindId($group_bind_id);
		$dataGroup=$group->getGroup($group_id);
		$user_row=$dataGroup[$group_id]['group_user'];
		$user_row=explode(',',$user_row);
		$user_Base=new User_BaseModel();
		$user_Info=new User_InfoModel();
		$dataUserInfo=array();
		foreach($user_row as $key=>$values){
			$dataUser=$user_Base->getUser($values);
			$user_account=$dataUser[$values]['user_account'];
			$dataUserInfos=$user_Info->getInfo($dataUser[$values]['user_account']);
			$dataUserInfos=array_values($dataUserInfos);
			array_push($dataUserInfo,$dataUserInfos);
		}

		$data['user_info']=$dataUserInfo;
		$data['group_name']=$dataGroup[$group_id]['group_name'];
		$data['group_describe']=$dataGroup[$group_id]['group_describe'];
		$data['group_declared']=$dataGroup[$group_id]['group_declared'];
		$data['boss']=$dataGroup[$group_id]['user_id'];

		$this->data->addBody(-140, $data);
	}
}
?>