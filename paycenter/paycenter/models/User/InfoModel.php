<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     WenQingTeng
 */
class User_InfoModel extends User_Info
{
      	public static $user_identity_statu            = array(
		"1" => "待审核",
		"2" => "成功",
		"3" => "失败",
	);
	/**
	 * 读取分页列表
	 *
	 * @param  int $user_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getInfoList($cond_row=array(),$order_row=array(), $page=1, $rows=100, $sort='asc')
	{
                $getInfolist =  $this->listByWhere($cond_row,$order_row,$page,$rows,$sort);
                foreach ($getInfolist['items'] as $key => $value) {
                    $getInfolist['items'][$key]['user_identity_statu_con'] = _(self::$user_identity_statu[$value["user_identity_statu"]]);
                    $getInfolist['items'][$key]['user_identity_card'] = $value['user_identity_card'].'&nbsp;'; //加一个空格转为string,防止数字过大被转义出错
                }
                return $getInfolist;
	}

    public function getInfo($user_id = null)
    {
        $data = $this->getOne($user_id);
        $sql = "select user_name from ucenter_user_info where user_id = $user_id";
        $arr = $this->sql->getRow($sql);
        $sql = "select user_email,user_mobile from ucenter_user_info_detail where user_name = '$arr[user_name]'";
        $us = $this->sql->getRow($sql);
        $sql = "select user_money from pay_user_resource where user_id = $user_id";
        $money = $this->sql->getRow($sql);
        $data['user_money'] = $money['user_money'];
        if($us['user_email'] != '' )
        {
            $data['user_email'] = $us['user_email'];
        }
        if($us['user_mobile'] != '')
        {
            $data['user_mobile'] = $us['user_mobile'];
        }
        return $data;

    }

    public function sql($sql){
        return $this->sql->getAll($sql);
    }

    //此方法需要改变
	public function getUserInfo($user_id = null)
	{
		//先查找paycenter数据库中有没有改用户信息
        $data = $this->getOne($user_id);

		//如果paycenter中没有用户信息就远程
		if(!$data)
		{
			$key      = YLB_Registry::get('ucenter_api_key');
			$url         = YLB_Registry::get('ucenter_api_url');
			$ucenter_app_id = YLB_Registry::get('ucenter_app_id');

			$formvars = array();

			$formvars['app_id']					= $ucenter_app_id;
			$formvars['user_name']     = Perm::$row['user_account'];

			$rs = get_url_with_encrypt($key, sprintf('%s?ctl=Login&met=getUserInfoDetail&typ=json',$url), $formvars);

			if($rs['status'] == 200)
			{
				$rs_user = current($rs['data']);
				fb($rs_user);
				$add_user_info['user_id'] = $user_id;
				$add_user_info['user_nickname'] = $rs_user['user_name'];
				$add_user_info['user_active_time'] = date('Y-m-d H:i:s');
				$add_user_info['user_realname'] = $rs_user['user_truename'];
				$add_user_info['user_email'] = $rs_user['user_email'];
				$add_user_info['user_mobile'] = $rs_user['user_mobile'];
				$add_user_info['user_qq'] = $rs_user['user_qq'];
				$add_user_info['user_avatar'] = $rs_user['user_avatar'];
				$add_user_info['user_identity_card'] = $rs_user['user_idcard'];

				$pay_user_id = $this->addInfo($add_user_info,true);

				$data = $this->getOne($pay_user_id);
			}
		}

		return $data;
	}
}
?>