<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Goods_TopCatModel extends Goods_TopCat
{

    /**
     * 读取分页列表
     *
     * @param array $cond_row  条件
     * @param array $order_row 排序
     * @param int $page        页码
     * @param int $rows        行数
     * @return array           返回值
     */
	public function getGoodsTopCatList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
		return $this->listByWhere($cond_row, $order_row, $page, $rows);
	}

}

?>