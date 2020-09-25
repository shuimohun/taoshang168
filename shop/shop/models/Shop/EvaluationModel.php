<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Shop_EvaluationModel extends Shop_Evaluation
{
    /**
     * 删除操作
     * @param int $goods_id
     * @return bool $del_flag 是否成功
     * @access public
     */
    public function removeEvalution($evaluation_goods_id)
    {
        $del_flag = $this->remove($evaluation_goods_id);

        //$this->removeKey($goods_id);
        return $del_flag;
    }
    public function getReturnExcel($cond_row = array(), $order_row = array())
    {
        $data = $this->getByWhere($cond_row, $order_row);

        foreach ($data as $k => $v)
        {
            $data[$k]['order_number'] = " " . $v['order_number'] . " ";
            $data[$k]['return_code']  = " " . $v['return_code'] . " ";
        }

        return array_values($data);
    }
    public function selectEvalution($field,$cond_row,$group,$order, $page, $rows)
    {
        $del_flag = $this->selects($field,$cond_row,$group,$order, $page, $rows);
        return $del_flag;
    }
}

?>