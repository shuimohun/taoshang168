<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     WenQingTeng
 */
class Union_OrderModel extends Union_Order
{
	const DISABLE = -1;  //失效
	const WAIT_PAY = 1;  //待付款
	const PAYED    = 2;  //已付款
	const WAIT_PREPARE_GOODS  = 3;      //待发货     等待卖家发货	     配货
	const WAIT_CONFIRM_GOODS  = 4;      //已发货     等待买家确认收货	 出库
	const RECEIVED            = 5;      //已签收     买家已签收	     已签收
	const FINISH              = 6;      //已完成     交易成功	         交易成功
	const CANCEL              = 7;      //已取消     交易关闭	         交易关闭
	const RETURN_ORDER        = 8;		//买家申请退货
	const FINISH_RETURN_ORDER = 9;		//商家确认退货（退货完成）

    public static $order_state_array = array(
        '-1'=>'失效',
        '1'=>'待付款',
        '2'=>'已付款',
        '3'=>'待发货',
        '4'=>'已发货',
        '5'=>'已签收',
        '6'=>'已完成/交易成功',
        '7'=>'已取消/交易关闭',
        '8'=>'买家申请退货',
        '9'=>'商家确认退货（退货完成）'
    );

	/**
	 * 读取分页列表
	 *
	 * @param  int $user_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getBaseList($card_name = null,$appid = null,$beginDate = null,$endDate = null, $page=1, $rows=100, $sort='asc')
	{
		
	}

}
?>