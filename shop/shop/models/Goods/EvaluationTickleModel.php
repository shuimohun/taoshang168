<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Goods_EvaluationTickleModel extends Goods_EvaluationTickle
{

    /**
     * 读取分页列表
     *
     * @param  int $goods_recommend_id 主键值
     * @return array $rows 返回的查询内容
     * @access public
     */
    public function getEvaluationTickleList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        return $this->listByWhere($cond_row, $order_row, $page, $rows);
    }
    /**
     * //计算评论总点赞数
     *  // jiaxiaolei
     * @param $tickle_id
     * @return array $rows
     * @access public
     *
     */
    public function countEvaluationTickle($cond_row){
        $data = $this->getByWhere($cond_row);
        if($data){
            $res = count($data);
        };
        return $res;
    }

    /**
     * //评论信息
     *  // jiaxiaolei
     * @param $tickle_id
     * @return array $rows
     * @access public
     *
     */
    public function evaluationTickle($cond_row){
        $data = $this->getByWhere($cond_row);
        return $data;
    }

}

?>