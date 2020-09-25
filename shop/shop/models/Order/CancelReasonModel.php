<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Order_CancelReasonModel extends Order_CancelReason
{
	const CANCEL_BUYER  = 1;    //���ȡ������
	const CANCEL_SELLER = 2;    //����ȡ������

}

?>