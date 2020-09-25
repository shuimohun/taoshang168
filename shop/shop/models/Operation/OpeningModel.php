<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

class Operation_OpeningModel extends Operation_Opening
{
    const LEVEL = 1;
    public $key_name = array(
        '1'=>'xianshi',
        '2'=>'xianshi1',
        '3'=>'xianshi2',
        '4'=>'xianshi3',
        '5'=>'dizhi',
        '6'=>'banjia',
        '7'=>'remai',
        '8'=>'manjian',
        '9'=>'jinxi',
        '10'=>'fengkuang',
        '11'=>'shiyong',
        '12'=>'xinren');
    /**
     * 读取分页列表
     *
     * @param  int $brand_id 主键值
     * @return array $rows 返回的查询内容
     * @access public
     */
    public function getOpeningList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        return $this->listByWhere($cond_row, $order_row, $page, $rows);
    }
}