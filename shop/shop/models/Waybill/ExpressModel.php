<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Waybill_ExpressModel extends Waybill_Express
{
    public static $temp = array
    (
        '110' => '宽100mm,高110mm，切点60/50',
        '120' => '宽100mm,高116mm，切点98/18',
        '137' => '宽100mm,高137mm，切点101/36',
        '150' => '宽100mm,高150mm 切点90/60',
        '177' => '宽100mm,高177mm，切点107/70',
        '180' => '宽100mm,高180mm，切点110/70',
        '183' => '宽100mm,高183mm，切点87/5/91',
        '203' => '宽100mm,高203mm 切点152/51',
        '210' => '宽100mm,高210mm 切点90/60/60',
    );
    public $number = array('SF','EMS','FAST','ZJS','YZPY','YZBK','ZTKY');
    public $moreTemp = array('SF','YD','STO');
    public $postcode = array('YZPY','YZBK','EMS');
    /**
     * 读取单条数据
     *
     * @param  array $cond_row 主键值
     * @return array $data 返回的查询内容
     * @access public
     */
    public function getExpressDetail($cond_row)
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
    public function getExpressList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
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
    public function getExpressByWhere($cond_row = array(), $order_row = array())
    {
        $data                = $this->getByWhere($cond_row, $order_row);
        return $data;
    }

    /**
     * 多条件查询列模板格式
     *
     * @param array $cond_row 查询条件
     * @param array $order_row 排序信息
     * @return array $data 返回的查询内容
     * @access public
     */
    public function getExpressTempLayout($cond_row = array(), $order_row = array())
    {

        $data = $this->getByWhere($cond_row,$order_row);

        if ($data)
        {
            foreach($data as $key=>$value)
            {
                if ($value['wex_temp'])
                {
                    $template = array();

                    $str = explode(',',$value['wex_temp']);

                    for ($i=0;$i < count($str);$i++)
                    {
                        $template[$str[$i]] = self::$temp[$str[$i]];
                    }

                    $data[$key]['temp'] = $str;
                    $data[$key]['template'] = $template;
                }
            }
        }

        return $data;
    }
}