<?php

//---------------------------------------------------------
//�Ƹ�ͨ��ʱ����֧��ҳ��ص�ʾ�����̻����մ��ĵ����п�������
//---------------------------------------------------------
require_once '../../../configs/config.ini.php';

include_once LIB_PATH . '/Api/tenpay/lib/classes/ResponseHandler.class.php';
include_once LIB_PATH . '/Api/tenpay/lib/classes/function.php';
include_once LIB_PATH . '/Api/tenpay/lib/tenpay_config.php';

log_result("����ǰ̨�ص�ҳ��");

$Payment_TenpayModel = PaymentModel::create('tenpay');
$verify_result          = $Payment_TenpayModel->verifyReturn();

YLB_Log::log('$verify_result=' . $verify_result, YLB_Log::INFO, 'pay_tenpay_return');

//����ó�֪ͨ��֤���
if ($verify_result)
{
	//�������������ҵ���߼�����д�������´�������ο�������
		//�����ֵ��¼
		$Consume_DepositModel = new Consume_DepositModel();
		$rs = $Consume_DepositModel->processDeposit($verify_result);

		if ($rs)
		{
			//����һ���ص�-֪ͨ�̳Ǹ��¶���״̬
			$Consume_DepositModel->notifyShop($verify_result['order_id']);

			echo "SUCCESS";        //�벻Ҫ�޸Ļ�ɾ��
			YLB_Log::log('Process-SUCCESS', YLB_Log::INFO, 'pay_tenpay_return');
		}
		else
		{
			echo "FAIL";
			YLB_Log::log('Process-FAIL', YLB_Log::ERROR, 'pay_tenpay_return_error');
			YLB_Log::log('Process-FAIL', YLB_Log::ERROR, 'pay_tenpay_return');
		}

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else
{
	//��֤ʧ��
	echo "FAIL";
	YLB_Log::log($error_msg, YLB_Log::ERROR, 'pay_tenpay_return_error');
	YLB_Log::log($error_msg, YLB_Log::ERROR, 'pay_tenpay_return');

}

?>