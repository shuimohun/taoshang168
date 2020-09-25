<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class User_BaseModel extends User_Base
{

	/**
	 * 读取分页列表
	 *
	 * @param  int $user_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getBaseList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
		return $this->getByWhere($cond_row, $order_row, $page, $rows);
	}

	public function getBaseIdByAccount($user_account = null)
	{
		$data = $this->getByWhere(array('user_account' => $user_account));

		return $data['items'];
	}
	
	/**
	 * 读取会员信息
	 *
	 * @param  int $user_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
    public function getUserInfo($order_row = array())
    {
        return $this->getOneByWhere($order_row);
    }

    public function getUserIdByAccount($user_account)
    {
        $user_id_row = array();

        $this->_multiCond['user_account'] = $user_account;

        $user_id_row = $this->getKeyByMultiCond($this->_multiCond);

        return $user_id_row;
    }

    //返回count数
    public function getoneByMember(){
        return $this->_num();
    }

    public function sql($sql){
        return $this->sql->getAll($sql);
    }

}

?>