<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Order_GoodsModel extends Order_Goods
{
	const EVALUATION_YES = 1;        //已评价
	const EVALUATION_NO  = 0;        //未评价

	const REFUND_NO      = 0;//订单无退货
	const REFUND_IN      = 1;//退货申请中
	const REFUND_COM     = 2;//退货完成
    const REFUND_BACK    = 3;//卖家不同意

    const REFUND_PLAT    = 4;//申诉中
    const REFUND_PLAT_UNPASS  = 5;//平台申诉不通过
    const REFUND_PLAT_PASS    = 6;//平台申诉通过

	/**
	 * 读取分页列表
	 *
	 * @param  int $goods_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getBaseList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{

		$data            = $this->listByWhere($cond_row, $order_row, $page, $rows);
		$Order_BaseModel = new Order_BaseModel();
		if ($data['items'])
		{
			foreach ($data['items'] as $key => $val)
			{
				$order_base                                 = $Order_BaseModel->getOne($val['order_id']);
				$data['items'][$key]['buyer_user_name']     = $order_base['buyer_user_name'];
				$data['items'][$key]['order_finished_time'] = $order_base['order_finished_time'];
			}
		}
		return $data;
	}

	/**
	 * 商品销售列表
	 *
	 * @author WenQingTeng
	 */
	public function getGoodSaleList($cond_row = array(), $order_row = array(), $page, $rows)
	{
		$data = $this->listByWhere($cond_row, $order_row, $page, $rows);

		$Order_BaseModel = new Order_BaseModel();
		if ($data['items'])
		{
			foreach ($data['items'] as $key => $val)
			{
				$order = $Order_BaseModel->getOne($val['order_id']);

				$data['items'][$key]['order'] = $order;
			}
		}

		fb($data);
		return $data;
	}

	/**
	 * 商品销售数量
	 *
	 * @author WenQingTeng
	 */
	public function getGoodsSaleNum($goods_id = null)
	{
		$data = $this->listByWhere(array('goods_id' => $goods_id,'order_goods_status:IN'=>'2,3,4,5,6'));

		$count = count($data['items']);

		return $count;
	}

	/**
	 * 获取订单产品列表
	 *
	 * @param  int $goods_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getGoodsListByOrderId($order_id, $order_row = array(), $page = 1, $rows = 100)
	{
		if (is_array($order_id))
		{
			$cond_row = array('order_id:IN' => $order_id);
		}
		else
		{
			$cond_row = array('order_id' => $order_id);
		}

		return $this->listByWhere($cond_row);
	}

	/**
	 * 获取订单产品详情
	 *
	 * @param  int $order_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getGoodsDetail($cond_row)
	{

		return $this->getOneByWhere($cond_row);
	}

    /**
     * 用户购买过商品的数量
     *
     * @param $common_id
     * @param null $user_id
     * @return int
     */
	public function getUserBuyCountByCId($common_id,$user_id = null)
    {
        $count = 0;
        $order_goods_cond['common_id']             = $common_id;
        $order_goods_cond['buyer_user_id']         = $user_id ? $user_id : Perm::$userId;
        $order_goods_cond['order_goods_status:!='] = Order_StateModel::ORDER_REFUND_FINISH;
        $order_list                                = $this->getFiled('SUM(order_goods_num) as count',$order_goods_cond);

        if($order_list['count'])
        {
            $count = $order_list['count'];
        }
        return $count;
    }

    /**
     * 用户购买过套装的数量
     *
     * @param $bundling_id
     * @return mixed
     */
    public function getUserBuyCountByBId($bundling_id)
    {
        $count = 0;
        $order_goods_cond['bundling_id']           = $bundling_id;
        $order_goods_cond['buyer_user_id']         = Perm::$userId;
        $order_goods_cond['order_goods_status:!='] = Order_StateModel::ORDER_REFUND_FINISH;
        $order_list                                = $this->getFiled('SUM(order_goods_num) as count',$order_goods_cond);

        if($order_list['count'])
        {
            $count = $order_list['count'];
        }
        return $count;
    }

    /**
     * 自定义查询
     *
     * @param $field
     * @param $cond_row
     * @param $group
     * @return mixed
     */
    public function getFiled($field,$cond_row,$group)
    {
        $rows =  $this->select($field,$cond_row,$group);
        if($rows)
        {
            $rows = current($rows);
        }
        return $rows;
    }


    //商品
    public function order_goods(){
        $date = date('Y-m-d');
        //$sql = "select count(*) from YLB_order_base,".$this->_tableName." where YLB_order_base.order_id = YLB_order_goods.order_id AND ((payment_id='2' AND order_status='6') OR (payment_id='1' AND order_status IN ('6'))) AND date_format(payment_time,'%Y-%m-%d')<'".$date."'";
        $sql = 'SELECT SUM(a.order_goods_num) order_goods_count FROM ylb_order_goods a LEFT JOIN ylb_order_base b ON a.order_id = b.order_id WHERE b.order_status > 1 AND b.order_refund_status = 0 AND a.goods_refund_status = 0';
        $res = $this->sql->getAll($sql);
        return $res[0]["order_goods_count"];
    }
    //表名
    public function tabase(){
        return $this->_tableName;
    }
    //执行sql
    public function sql($sql){
        return $this->sql->getAll($sql);
    }
    //执行sql
    public function _select_sql($sql,$page,$rows){
        return $this->select_sql($sql,$page,$rows);
    }

    //查询 返回$field,$cond_row,$group,$order, （$page, $rows不执行）
    public function selectReturn($field,$cond_row,$group,$order, $page, $rows)
    {
        $del_flag = $this->selects($field,$cond_row,$group,$order, $page, $rows);
        return $del_flag;
    }
    public function selectGoods($field,$cond_row,$group,$order,$flag)
    {
        $del_flag = $this->select($field,$cond_row,$group,$order,$flag);
        return $del_flag;
    }

}

?>