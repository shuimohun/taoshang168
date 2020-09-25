<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Goods_CatNavModel extends Goods_CatNav
{

	/**
	 * 读取分页列表
	 *
	 * @param  int $goods_cat_nav_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getCatNavList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
		return $this->listByWhere($cond_row, $order_row, $page, $rows);
	}

    public function getCatByIds($field = null,$value = array(),$order=array())
    {
        return $this->otherGet($field,$value,$order);
    }
}

?>