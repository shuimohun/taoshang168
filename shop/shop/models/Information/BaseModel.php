<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Information_BaseModel extends Information_Base
{
	const   ARTICLE_STATUS_TRUE  = 1; //开启
	const   ARTICLE_STATUS_FALSE = 2; //关闭

	const   ARTICLE_TYPE_ARTICLE = 0; //文章
	const   ARTICLE_TYPE_SYSTEM  = 1; //文章

    const NO_PASS       = 0;//审核不通过
    const WAITING_AUDIT = 1;//待审核
    const AUDITED       = 2;//审核通过
    const NO_NEED_AUDIT = 3;//不需要审核

    public static $audit_map = [
        self::NO_PASS => '审核不通过',
        self::WAITING_AUDIT => '待审核',
        self::AUDITED => '审核通过',
        self::NO_NEED_AUDIT => '不需要审核'
    ];

    public function getGroupBaseList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        $data_rows = $this->listByWhere($cond_row, $order_row, $page, $rows);
        return $data_rows;
    }































	/**
	 * 读取分页列表
	 *
	 * @param  int $information_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getBaseList($information_id = null, $page = 1, $rows = 100, $sort = 'asc')
	{
		//需要分页如何高效，易扩展
		$offset = $rows * ($page - 1);

		$this->sql->setLimit($offset, $rows);

		$information_id_row = array();
		$information_id_row = $this->selectKeyLimit();

		//读取主键信息
		$total = $this->getFoundRows();

		$data_rows = array();

		if ($information_id_row)
		{
			$data_rows = $this->getBase($information_id_row);
		}

		$data              = array();
		$data['page']      = $page;
		$data['total']     = ceil_r($total / $rows);  //total page
		$data['totalsize'] = $data['total'];
		$data['records']   = count($data_rows);
		$data['items']     = array_values($data_rows);

		return $data;
	}

	/**
	 * 读取分页列表
	 *
	 * @param  int $information_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getBaseAllList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
		$data = $this->listByWhere($cond_row, $order_row, $page, $rows);

		return $data;
	}
	
	/*
	 * 根据一个id获取附近两条数据
	 *
	 * @param   int $information_id  主键值
	 *
	 * @return  array $data 返回查询的内容
	 */
	public function getNearInformation($information_id)
	{
		$Information_BaseModel = new Information_BaseModel();
		$Information_BaseModel->sql->setLimit(0, 1);
		$data['front'] = pos($Information_BaseModel->getByWhere(array('information_id:<' => $information_id), array('information_id' => 'desc')));
		$Information_BaseModel->sql->setLimit(0, 1);
		$data['behind'] = pos($Information_BaseModel->getByWhere(array('information_id:>' => $information_id), array('information_id' => 'asc')));
		return $data;
	}

    protected function _delete()
    {
        $sql = 'DELETE FROM ' . $this->_tableName;
        $sql .= $this->sql->getWhere();

        $del_flag = $this->sql->exec($sql);

        return $del_flag;
    }

    public function  sql($sql){
        $res = $this->sql->getAll($sql);
        return $res[0]['infou_count'];
    }
    /*
     * 获取最新发布的一篇资讯 information 的id
     * @return   int $information_id  主键值
     * @author  刘贵龙
     * @date    2017.06.06
     */
	public function getNewestInformation(){
	    $sql = 'select information_id from ylb_information_base where information_status=1 order by information_id desc limit 1';
        $res = $this->sql->getAll($sql);
        return $res[0]['information_id'];
    }

    public function getReadCount($information_id){
        $sql = 'select information_read_count from ylb_information_base where information_id='.$information_id;
        $res = $this->sql->getAll($sql);
        return $res[0]['information_read_count'];
    }
    public function getFakeRead($information_id){
        $sql = 'select information_fake_read_count from ylb_information_base where information_id='.$information_id;
        $res = $this->sql->getAll($sql);
        return $res[0]['information_fake_read_count'];
    }

    public function updateReadCount($information_id,$readCount){
        $sql = 'update ylb_information_base set information_read_count='.$readCount.'+1 where information_id='.$information_id;
        $res = $this->sql->exec($sql);
        return $res;
    }

	/**
	 * 读数量
	 *
	 * @param  int $config_key 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getCount($cond_row = array())
	{
		return $this->getNum($cond_row);
	}


}

?>