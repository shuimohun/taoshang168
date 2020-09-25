<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class User_InfoModel extends User_Info
{
	public static $userSex = array(
		"0" => '女',
		"1" => '男',
		"2" => '保密'
	);

	/**
	 * 读取分页列表
	 *
	 * @param  array $cond_row 查询条件
	 * @param  array $order_row 排序信息
	 * @param  array $page 当前页码
	 * @param  array $rows 每页记录数
	 * @return array $data 返回的查询内容
	 * @access public
	 */
	public function getInfoList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
		$data = $this->listByWhere($cond_row, $order_row, $page, $rows);
		foreach ($data["items"] as $key => $value)
		{
			$data["items"][$key]["user_sex"] = _(User_InfoModel::$userSex[$value["user_sex"]]);
		}
		return $data;
	}

	/**
	 * 读取一个会员信息
	 *
	 * @param  array $order 查询条件
	 * @return array $rows 返回的查询内容
	 * @access publics
	 */
	public function getUserInfo($order_row = array())
	{
		return $this->getOneByWhere($order_row);
	}

	/**
	 * 读取头部会员信息
	 *
	 * @param  int $user_id 主键值
	 * @return array $user 返回的查询内容
	 * @access public
	 */
	public function getUserMore($user_id)
	{

		$user = array();

		$user['info'] = $this->getOne($user_id);

		$user_grade_id = $user['info']['user_grade'];

		$this->userGradeModel = new User_GradeModel();
		$user['grade']        = $this->userGradeModel->getOne($user_grade_id);
		if (empty($user['grade']))
		{
			$user['grade']['user_grade_name'] = _('普通会员');
		}
		$this->userResourceModel = new User_ResourceModel();
		$user['points']          = $this->userResourceModel->getOne($user_id);

		$this->voucherBaseModel = new Voucher_BaseModel();

		$cond_row['voucher_owner_id'] = $user_id;
		$vo                           = $this->voucherBaseModel->getCount($cond_row);

		$user['voucher'] = $vo;

		return $user;
	}
	
	//获取用户的直属下级用户数量
	public function getSubQuantity($cond_row)
	{
		return $this->getNum($cond_row);
	}

    public function getStatistics($field = '*',$cond_row,$group)
    {
        return $this->select($field,$cond_row,$group);
    }
    //新增会员
    public function new_user(){
        $cond['user_active_time:>='] = date('Y-m-d', strtotime('this week'));
        return $this->getRowCount($cond);
    }
    //查询
    public function getUserinsert($field = '*',$cond_row,$group)
    {
        return $this->select($field,$cond_row,$group);
    }
    //执行sql
    public function sql($sql){
        return $this->sql->getAll($sql);
    }

}

User_InfoModel::$userSex = array(
	"0" => _('女'),
	"1" => _('男'),
	"2" => _('保密')
);
?>