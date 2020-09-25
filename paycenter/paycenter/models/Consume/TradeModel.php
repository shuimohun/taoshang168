<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     WenQingTeng
 */
class Consume_TradeModel extends Consume_Trade
{
	/**
	 * 读取分页列表
	 *
	 * @param  int $consume_trade_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getTradeList($consume_trade_id = null, $page=1, $rows=100, $sort='asc')
	{
		//需要分页如何高效，易扩展
		$offset = $rows * ($page - 1);

		$this->sql->setLimit($offset, $rows);

		$consume_trade_id_row = array();
		$consume_trade_id_row = $this->selectKeyLimit();

		//读取主键信息
		$total = $this->getFoundRows();

		$data_rows = array();

		if ($consume_trade_id_row)
		{
			$data_rows = $this->getTrade($consume_trade_id_row);
		}

		$data = array();
		$data['page'] = $page;
		$data['total'] = ceil_r($total / $rows);  //total page
		$data['totalsize'] = $data['total'];
		$data['records'] = count($data_rows);
		$data['items'] = array_values($data_rows);

		return $data;
	}

	/**
	 * 根据订单号读取信息
	 *
	 * @param  int $order_id 订单id
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getTradeByOrderId($order_id)
	{
		$cond_row = array('order_id'=>$order_id);

		$row = array();
		$rows = $this->getMultiCond($cond_row);
		if ($rows)
		{
			$row = reset($rows);
		}

		return $row;
	}

	public function getTradeByState($user_id = null,$status = null,$type = null)
	{
		if($status)
		{
			$this->sql->setWhere('order_state_id',$status);
		}
		if($type == 1)//1-卖家
		{
			$this->sql->setWhere('seller_id',$user_id);
		}
		if($type == 2)//2-买家
		{
			$this->sql->setWhere('buy_id',$user_id);
		}

		$data = $this->getTrade("*");
		return $data;
	}

	public function getConsumeTradeByOid($order_id = null)
	{
		$this->sql->setWhere('order_id',$order_id);
		$data = $this->getTrade("*");

		$data = current($data);

		return $data;
	}

	public function editConsumeTrade($order_id = null,$paychannel_id = null)
	{
		$Union_OrderModel = new Union_OrderModel();
		$union_order = $Union_OrderModel->getOne($order_id);
		$inorder = $union_order['inorder'];

		$order_id = explode(",",$inorder);
        $order_id = array_filter($order_id);
		//修改单个合并订单
		/*$uorder_row = $Union_OrderModel->getByWhere(array('inorder:IN' => $order_id));
		$uorder_id_row = array_column($uorder_row,'union_order_id');*/
        $uorder_id_row = $Union_OrderModel->getKeyByWhere(array('inorder:IN' => $order_id));
		$edit_uorder_row = array();
		$edit_uorder_row['payment_channel_id'] = $paychannel_id;

		$Union_OrderModel->editUnionOrder($uorder_id_row,$edit_uorder_row);
	}
}
?>