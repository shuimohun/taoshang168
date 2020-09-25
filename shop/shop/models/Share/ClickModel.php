<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author      Zhenzh
 */
class Share_ClickModel extends Share_Click
{
	public function __construct()
	{
		parent::__construct();
	}

    /**
     * 增加
     * @param $field_row
     * @param bool $return_insert_id
     * @return bool
     */
    public function addShareClick($field_row, $return_insert_id=false)
    {
        $add_flag = $this->add($field_row, $return_insert_id);
        return $add_flag;
    }

    /**
     * 删除
     * @param $config_key
     * @return bool
     */
    public function removeShareClick($config_key)
    {
        $del_flag = $this->remove($config_key);
        return $del_flag;
    }

    /**
     * 修改
     * @param null $config_key
     * @param $field_row
     * @return bool
     */
    public function editShareClick($config_key = null, $field_row)
    {
        $update_flag = $this->edit($config_key, $field_row);

        return $update_flag;
    }

    /**
     * 读取分页列表
     * @param array $cond_row
     * @param array $order_row
     * @param int $page
     * @param int $rows
     * @return array|int
     */
	public function getShareClickList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
		$rows = $this->listByWhere($cond_row, $order_row, $page, $rows);

		return $rows;
	}

    /**
     * 多条件获取所有分享点击
     * @param array $cond_row
     * @param array $order_row
     * @return array
     */
    public function getAllShareClickByWhere($cond_row=array(), $order_row = array())
    {
        return $this->getByWhere($cond_row,$order_row);
    }


    /**
     * 多条件获取单个分享点击信息
     * @param $cond_row
     * @return array 
     */
	public function getOneShareClickByWhere($cond_row)
	{
		return $this->getOneByWhere($cond_row);
	}


    /**
     * 获取次数
     * @param array $cond_row
     * @return array
     */
    public function getCount($cond_row=array())
    {
        return $this->getNum($cond_row);
    }
}

?>