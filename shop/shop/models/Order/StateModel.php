<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Order_StateModel extends Order_State
{
    const ORDER_SPLIT              = 0;
	const ORDER_WAIT_PAY           = 1; //待付款  等待买家付款	 下单
	const ORDER_PAYED              = 2; //已付款  待配货          等待卖家配货	     付款
	const ORDER_WAIT_PREPARE_GOODS = 3; //待发货  等待卖家发货	 配货
	const ORDER_WAIT_CONFIRM_GOODS = 4; //已发货  等待买家确认收货	 出库
	const ORDER_RECEIVED           = 5; //已签收  买家已签收
	const ORDER_FINISH             = 6; //已完成  交易成功
	const ORDER_CANCEL             = 7; //已取消  交易关闭
	const ORDER_REFUND             = 8; //退款中
	const ORDER_REFUND_FINISH      = 9; //退款完成
	const ORDER_SELF_PICKUP        = 11;//代自提  交易关闭

	const ORDER_GOODS_RETURN_NO  = 0;   //无退货
	const ORDER_GOODS_RETURN_IN  = 1;   //退货中
	const ORDER_GOODS_RETURN_END = 2;   //退货完成

	const ORDER_REFUND_NO  = 0;  //无退款
	const ORDER_REFUND_IN  = 1;  //退款中
	const ORDER_REFUND_END = 2;  //退款完成
    const ORDER_REFUND_BACK    = 3;//卖家不同意
    const ORDER_REFUND_PLAT    = 4;//申诉中
    const ORDER_REFUND_PLAT_UNPASS  = 5;//申诉不通过
    const ORDER_REFUND_PLAT_PASS    = 6;//申诉通过

	const FROM_PC      = 1;	 //PC端
	const FROM_WAP     = 2;	 //wap端
    const FROM_APP     = 3;  //app端
    const FROM_ANDROID = 4; //androd端
    const FROM_IOS     = 5; //ios端
    const FROM_FU      = 6; //送福免单

	public $orderFrom;
	public $evaluationStatus;

	public function __construct()
	{
		parent::__construct();

		$this->orderState = array(
			'1' => _("待付款"),//待付款
			'2' => _("已付款"),//待配货
			'3' => _("待发货"),//待发货
			'4' => _("已发货"),//已发货
			'5' => _("已签收"), //已签收
			'6' => _("已完成"),//已完成
			'7' => _("已取消"),//已取消
			'8' => _("退款中"),//已取消
			'9' => _("已退款"),//已取消
			'11' => _("待自提"),//已取消
		);

        $this->orderRefundState = array(
            '0' => _("无退款"),//无退款
            '1' => _("退款中"),//退款中
            '2' => _("退款完成"),//退款完成
        );

		$this->orderReturnState = array(
			'0' => _("无退货"),
			//无退货
			'1' => _("退货中"),
			//退货中
			'2' => _("退货完成"),
			//退货完成
		);

		$this->orderFrom = array(
			'1' => _("pc"),
			'2' => _("Wap"),
            '3'=>_("app"),
            '4'=>_("android"),
            '5'=>_("ios"),
		);
		
		$this->evaluationStatus = array(
			'0' => _("未评价"),
			//未评价
			'1' => _("已评价"),
			//已评价
		);
	}
}

?>