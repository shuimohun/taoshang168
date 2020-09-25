<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class PostCode_CityModel extends PostCode_City
{
    /**
     * 读取单条数据
     *
     * @param  array $cond_row 主键值
     * @return array $data 返回的查询内容
     * @access public
     */
    public function getPostCodeDetail($cond_row)
    {
        $data = $this->getOneByWhere($cond_row);

        return $data;
    }

    /**
     * 读取分页多条数据
     *
     * @param  array $cond_row 查询条件
     * @param  array $order_row 排序信息
     * @param  int   $page 当前页码
     * @param  int   $rows 每页记录数
     * @return array $data 返回的查询内容
     * @access public
     */
    public function getPostCodeList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        $data                = $this->listByWhere($cond_row, $order_row, $page, $rows);
        return $data;
    }

    /**
     * 读取多条数据
     *
     * @param  array $cond_row 查询条件
     * @param  array $order_row 排序信息
     * @return array $data 返回的查询内容
     * @access public
     */
    public function getPostCodeByWhere($cond_row = array(), $order_row = array())
    {
        $data                = $this->getByWhere($cond_row, $order_row);
        return $data;
    }
}