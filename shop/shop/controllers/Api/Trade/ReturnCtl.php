<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * Api接口, 让App等调用
 *
 *
 * @category   Game
 * @package    User
 * @author     WenQingTeng
 * @copyright  Copyright (c) 2017, 温庆腾
 * @version    1.0
 * @todo
 */
class Api_Trade_ReturnCtl extends Api_Controller
{
	public $Order_BaseModel         = null;
	public $Order_ReturnModel       = null;
	public $Order_ReturnReasonModel = null;
	public $Order_GoodsModel        = null;
    public $userResourceModel       = null;

	/**
	 * Constructor
	 *
	 * @param  string $ctl 控制器目录
	 * @param  string $met 控制器方法
	 * @param  string $typ 返回数据类型
	 * @access public
	 */
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);
		$this->Order_BaseModel         = new Order_BaseModel();
		$this->Order_ReturnModel       = new Order_ReturnModel();
		$this->Order_ReturnReasonModel = new Order_ReturnReasonModel();
		$this->Order_GoodsModel        = new Order_GoodsModel();
        $this->userResourceModel       = new User_ResourceModel();

	}

	public function getReasonList()
	{
		$page                             = request_int('page', 1);
		$rows                             = request_int('rows', 10);
		$oname                            = request_string('sidx');
		$osort                            = request_string('sord');
		$cond_row                         = array();
		$sort                             = array();
		$sort['order_return_reason_sort'] = "ASC";
		if ($oname != "number")
		{
			$sort[$oname] = $osort;
		}
		$data = array();
		$data = $this->Order_ReturnReasonModel->getReturnReasonList($cond_row, $sort, $page, $rows);
		$this->data->addBody(-140, $data);
	}

	public function addReasonBase()
	{
		$field['order_return_reason_content'] = request_string("order_return_reason_content");
		$field['order_return_reason_sort']    = request_int("order_return_reason_sort");
		$flag                                 = $this->Order_ReturnReasonModel->addReturn($field, true);
		if ($flag)
		{
			$msg    = _('success');
			$status = 200;
		}
		else
		{
			$msg    = _('failure');
			$status = 250;
		}

		$data = array();

		$this->data->addBody(-140, $data, $msg, $status);
	}

	public function editReason()
	{
		$id   = request_int("id");
		$data = $this->Order_ReturnReasonModel->getOne($id);
		$this->data->addBody(-140, $data);
	}

	public function editReasonBase()
	{
		$id                                   = request_int("order_return_reason_id");
		$field['order_return_reason_content'] = request_string("order_return_reason_content");
		$field['order_return_reason_sort']    = request_int("order_return_reason_sort");
		$flag                                 = $this->Order_ReturnReasonModel->editReturn($id, $field);
		if ($flag)
		{
			$msg    = _('success');
			$status = 200;
		}
		else
		{
			$msg    = _('failure');
			$status = 250;
		}

		$data = array();

		$this->data->addBody(-140, $data, $msg, $status);
	}

	public function delReason()
	{
		$id   = request_int("id");
		$flag = $this->Order_ReturnReasonModel->removeReturn($id);
		if ($flag)
		{
			$msg    = _('success');
			$status = 200;
		}
		else
		{
			$msg    = _('failure');
			$status = 250;
		}

		$data = array();

		$this->data->addBody(-140, $data, $msg, $status);
	}

	public function getReturnWaitList()
	{
		$type                = request_int("otyp", Order_ReturnModel::RETURN_TYPE_ORDER);
		$return_code         = request_string("return_code");
		$seller_user_account = request_string("seller_user_account");
		$buyer_user_account  = request_string("buyer_user_account");
		$order_goods_name    = request_string("order_goods_name");
		$order_number        = request_string("order_number");
		$start_time          = request_string("start_time");
		$end_time            = request_string("end_time");
		$min_cash            = request_float("min_cash");
		$max_cash            = request_float("max_caQsh");

		$page     = request_int('page', 1);
		$rows     = request_int('rows', 10);
		$oname    = request_string('sidx');
		$osort    = request_string('sord');
		$cond_row = array();
		$sort     = array();
		if ($oname != "number")
		{
			$sort[$oname] = $osort;
		}

		if ($return_code)
		{
			$cond_row['return_code'] = $return_code;
		}
		if($order_number)
        {
            $cond_row['order_number'] = $order_number;
        }
		if ($seller_user_account)
		{
			$cond_row['seller_user_account'] = $seller_user_account;
		}
		if ($buyer_user_account)
		{
			$cond_row['buyer_user_account'] = $buyer_user_account;
		}
		if ($order_goods_name)
		{
			$cond_row['order_goods_name:LIKE'] = '%' . $order_goods_name . '%';
		}
		if ($start_time)
		{
			$cond_row['return_add_time:>='] = $start_time;
		}
		if ($end_time)
		{
			$cond_row['return_add_time:<='] = $end_time;
		}
		if ($min_cash)
		{
			$cond_row['return_cash:>='] = $min_cash;
		}
		if ($max_cash)
		{
			$cond_row['return_cash:<='] = $max_cash;
		}


		if (request_string('recheck') == '1')
            $cond_row['return_recheck_state'] = Order_ReturnModel::PLAT_WAIT_PASS;
        else
            $cond_row['return_platform_state'] = Order_ReturnModel::PLAT_WAIT_PASS;

        $cond_row['return_type']  = $type;
        $cond_row['seller_status:>'] = Order_ReturnModel::SELLER_STATUS_0;

		$data = $this->Order_ReturnModel->getReturnList($cond_row, $sort, $page, $rows);
		$this->data->addBody(-140, $data);
	}

	public function getReturnWaitExcel()
	{
		$type                = request_int("otyp", Order_ReturnModel::RETURN_TYPE_ORDER);
		$return_code         = request_string("return_code");
		$seller_user_account = request_string("seller_user_account");
		$buyer_user_account  = request_string("buyer_user_account");
		$order_goods_name    = request_string("order_goods_name");
		$order_number        = request_string("order_number");
		$start_time          = request_string("start_time");
		$end_time            = request_string("end_time");
		$min_cash            = request_float("min_cash");
		$max_cash            = request_float("max_cash");

		$oname    = request_string('sidx');
		$osort    = request_string('sord');
		$cond_row = array();
		$sort     = array();

		if ($return_code)
		{
			$cond_row['return_code'] = $return_code;
		}
		if ($seller_user_account)
		{
			$cond_row['seller_user_account'] = $seller_user_account;
		}
		if ($buyer_user_account)
		{
			$cond_row['buyer_user_account'] = $buyer_user_account;
		}
		if ($order_goods_name)
		{
			$cond_row['order_goods_name:LIKE'] = '%' . $order_goods_name . '%';
		}
		if ($start_time)
		{
			$cond_row['return_add_time:>='] = $start_time;
		}
		if ($end_time)
		{
			$cond_row['return_add_time:<='] = $end_time;
		}
		if ($min_cash)
		{
			$cond_row['return_cash:>='] = $min_cash;
		}
		if ($max_cash)
		{
			$cond_row['return_cash:<='] = $max_cash;
		}
		$cond_row['return_platform_state'] = Order_ReturnModel::PLAT_WAIT_PASS;
		$cond_row['return_type']  = $type;
		$con                      = array();
		$con                      = $this->Order_ReturnModel->getReturnExcel($cond_row, $sort);
		$tit                      = array(
			"序号",
			"退单编号",
			"退单金额",
			"佣金金额",
			"申请原因",
			"申请时间",
			"涉及商品",
			"商家处理备注",
			"商家处理时间",
			"订单编号",
			"买家",
			"商家"
		);
		$key                      = array(
			"return_code",
			"return_cash",
			"return_commision_fee",
			"return_reason",
			"return_add_time",
			"order_goods_name",
			"return_shop_message",
			"return_shop_time",
			"order_number",
			"buyer_user_account",
			"seller_user_account"
		);
		$this->excel("退款退货单", $tit, $con, $key);
	}

	public function getReturnAllList()
	{

		$type                = request_int("otyp", Order_ReturnModel::RETURN_TYPE_ORDER);
		$return_code         = request_string("return_code");
		$seller_user_account = request_string("seller_user_account");
		$buyer_user_account  = request_string("buyer_user_account");
		$order_goods_name    = request_string("order_goods_name");
		$order_number        = request_string("order_number");
		$start_time          = request_string("start_time");
		$end_time            = request_string("end_time");
		$min_cash            = request_float("min_cash");
		$max_cash            = request_float("max_cash");

		$page     = request_int('page', 1);
		$rows     = request_int('rows', 10);
		$oname    = request_string('sidx');
		$osort    = request_string('sord');
		$cond_row = array();
		$sort     = array();
		if ($oname != "number")
		{
			$sort[$oname] = $osort;
		}

		if ($return_code)
		{
			$cond_row['return_code'] = $return_code;
		}
		if ($seller_user_account)
		{
			$cond_row['seller_user_account'] = $seller_user_account;
		}
		if ($buyer_user_account)
		{
			$cond_row['buyer_user_account'] = $buyer_user_account;
		}
		if ($order_goods_name)
		{
			$cond_row['order_goods_name:LIKE'] = '%' . $order_goods_name . '%';
		}
		if ($start_time)
		{
			$cond_row['return_add_time:>='] = $start_time;
		}
		if ($end_time)
		{
			$cond_row['return_add_time:<='] = $end_time;
		}
		if ($min_cash)
		{
			$cond_row['return_cash:>='] = $min_cash;
		}
		if ($max_cash)
		{
			$cond_row['return_cash:<='] = $max_cash;
		}
		$cond_row['return_type'] = $type;
		$data                    = array();
		$data                    = $this->Order_ReturnModel->getReturnList($cond_row, $sort, $page, $rows);
		$this->data->addBody(-140, $data);
	}

	public function getReturnAllExcel()
	{
		$type                = request_int("otyp", Order_ReturnModel::RETURN_TYPE_ORDER);
		$return_code         = request_string("return_code");
		$seller_user_account = request_string("seller_user_account");
		$buyer_user_account  = request_string("buyer_user_account");
		$order_goods_name    = request_string("order_goods_name");
		$order_number        = request_string("order_number");
		$start_time          = request_string("start_time");
		$end_time            = request_string("end_time");
		$min_cash            = request_float("min_cash");
		$max_cash            = request_float("max_cash");

		$oname    = request_string('sidx');
		$osort    = request_string('sord');
		$cond_row = array();
		$sort     = array();
//        if($oname != "number") {
//            $sort[$oname] = $osort;
//        }

		if ($return_code)
		{
			$cond_row['return_code'] = $return_code;
		}
		if ($seller_user_account)
		{
			$cond_row['seller_user_account'] = $seller_user_account;
		}
		if ($buyer_user_account)
		{
			$cond_row['buyer_user_account'] = $buyer_user_account;
		}
		if ($order_goods_name)
		{
			$cond_row['order_goods_name:LIKE'] = '%' . $order_goods_name . '%';
		}
		if ($start_time)
		{
			$cond_row['return_add_time:>='] = $start_time;
		}
		if ($end_time)
		{
			$cond_row['return_add_time:<='] = $end_time;
		}
		if ($min_cash)
		{
			$cond_row['return_cash:>='] = $min_cash;
		}
		if ($max_cash)
		{
			$cond_row['return_cash:<='] = $max_cash;
		}
		$cond_row['return_type'] = $type;
		$con                     = array();
		$con                     = $this->Order_ReturnModel->getReturnExcel($cond_row, $sort);
		$this->data->addBody(-140, $con);
		$tit = array(
			"序号",
			"退单编号",
			"退单金额",
			"佣金金额",
			"申请原因",
			"申请时间",
			"涉及商品",
			"商家处理备注",
			"商家处理时间",
			"订单编号",
			"买家",
			"商家"
		);
		$key = array(
			"return_code",
			"return_cash",
			"return_commision_fee",
			"return_reason",
			"return_add_time",
			"order_goods_name",
			"return_shop_message",
			"return_shop_time",
			"order_number",
			"buyer_user_account",
			"seller_user_account"
		);
		$this->excel("退款退货单", $tit, $con, $key);
	}

	public function detail()
	{
		$data['id']    = request_int('id');
		$id            = request_int('id');
		$data          = $this->Order_ReturnModel->getReturnBase($id);
		$data['order'] = $this->Order_BaseModel->getOne($data['order_number']);
		$this->data->addBody(-140, $data);
	}


    /**
     * 平台审核不通过  包含第一次审核 第二次审核
     */
    public function disagree()
    {
        $order_return_id         = request_int("order_return_id");
        $return_platform_message = request_string("return_platform_message");

        $return = $this->Order_ReturnModel->getOne($order_return_id);

        $this->Order_ReturnModel->sql->startTransactionDb();
        $edit_flag = $this->disAgreeCommand($return,$return_platform_message);

        if( $return['seller_status'] == Order_ReturnModel::SELLER_STATUS_2 && $return['return_source_id'])
        {
            $dis_order_return = $this->Order_ReturnModel->getOne($return['return_source_id']);
            if($dis_order_return)
            {
                $edit_flag = $this->disAgreeCommand($dis_order_return,$return_platform_message);
            }
        }

        if ($edit_flag && $this->Order_ReturnModel->sql->commitDb())
        {
            $status = 200;
            $msg    = _('success');
        }
        else
        {
            $this->Order_ReturnModel->sql->rollBackDb();
            $status = 250;
            $msg    = _('failure');
        }
        $this->data->addBody(-140, array(), $msg, $status);
    }

    /**
     * 平台审核不通过  包含第一次审核 第二次审核 执行代码 提取重复代码
     *
     * @param $return
     * @param $return_platform_message
     * @return array
     */
    public function disAgreeCommand($return,$return_platform_message)
    {
        $rs_row = array();

        if($return['return_platform_state'] == Order_ReturnModel::PLAT_WAIT_PASS)
        {
            //驳回买家第一次申诉
            $data['return_platform_state']   = Order_ReturnModel::PLAT_UNPASS;
            $data['return_platform_time']    = get_date_time();
            $data['return_platform_message'] = $return_platform_message;
        }
        else if($return['return_recheck_state'] == Order_ReturnModel::PLAT_WAIT_PASS)
        {
            //驳回买家第二次申诉
            $data['return_recheck_state']   = Order_ReturnModel::PLAT_UNPASS;
            $data['return_recheck_time']    = get_date_time();
            $data['return_recheck_message'] = $return_platform_message;
            $data['return_state']           = Order_ReturnModel::RETURN_FINISH;
            $data['return_finish_time']     = get_date_time();
        }

        $edit_flag = $this->Order_ReturnModel->editReturn($return['order_return_id'], $data);
        check_rs($edit_flag, $rs_row);

        //二审为 终审
        if($return['return_recheck_state'] == Order_ReturnModel::PLAT_WAIT_PASS)
        {
            if ($return['order_goods_id'])
            {
                $goods_data['goods_refund_status'] = Order_GoodsModel::REFUND_COM;
                $edit_flag                         = $this->Order_GoodsModel->editGoods($return['order_goods_id'], $goods_data);
                check_rs($edit_flag, $rs_row);
            }
            else
            {
                $order_data['order_refund_status'] = Order_BaseModel::REFUND_COM;
                $edit_flag                         = $this->Order_BaseModel->editBase($return['order_number'], $order_data);
                check_rs($edit_flag, $rs_row);
            }
        }

        return is_ok($rs_row);
    }

    /**
     * 审核通过 同意退款/退货
     */
    public function agree()
    {
        $order_return_id         = request_int("order_return_id");
        $return_platform_message = request_string("return_platform_message");
        $return                  = $this->Order_ReturnModel->getOne($order_return_id);
        $this->Order_ReturnModel->sql->startTransactionDb();

        //判断退单状态是否为申诉中
        if($return['return_platform_state'] == Order_ReturnModel::PLAT_WAIT_PASS)
        {
            //判断是退款还是退货
            if ($return['return_goods_return'] == Order_ReturnModel::RETURN_GOODS_RETURN)
            {
                $data['return_platform_state']   = Order_ReturnModel::PLAT_PASS;
                $data['return_platform_time']    = get_date_time();
                $data['return_platform_message'] = $return_platform_message;
                $edit_flag = $this->Order_ReturnModel->editReturn($order_return_id, $data);

                //如果是分销商的进货单
                if( $return['seller_status'] == Order_ReturnModel::SELLER_STATUS_2 && $return['return_source_id'])
                {
                    $edit_flag = $this->Order_ReturnModel->editReturn($return['return_source_id'], $data);
                }
            }
            else
            {
                $edit_flag = $this->Order_ReturnModel->refund($return,2,$return_platform_message);

                if($return['seller_status'] == Order_ReturnModel::SELLER_STATUS_2 && $return['return_source_id'])
                {
                    $dist_return = $this->Order_ReturnModel -> getOne($return['return_source_id']);
                    $edit_flag = $this->Order_ReturnModel->refund($dist_return,2,$return_platform_message,false);
                }
            }
        }
        else if($return['return_recheck_state'] == Order_ReturnModel::PLAT_WAIT_PASS)
        {
            $refund_flag = false;
            //判断是不是退货
            if ($return['return_goods_return'] == Order_ReturnModel::RETURN_GOODS_RETURN)
            {
                //判断是哪一步商家不同意 1不同意退货申请 2买家发回商品时的不同意
                if($return['return_collect_state'] == Order_ReturnModel::RETURN_SELLER_UNPASS)
                {
                    $refund_flag = true;
                }
            }
            else
            {
                $refund_flag = true;
            }

            if($refund_flag)
            {
                $edit_flag = $this->Order_ReturnModel->refund($return,4,$return_platform_message);
                if($return['seller_status'] == Order_ReturnModel::SELLER_STATUS_2 && $return['return_source_id'])
                {
                    $dist_return = $this->Order_ReturnModel -> getOne($return['return_source_id']);
                    $edit_flag = $this->Order_ReturnModel->refund($dist_return,4,$return_platform_message,false);
                }
            }
        }

        if ($edit_flag && $this->Order_ReturnModel->sql->commitDb())
        {
            $status = 200;
            $msg    = _('success');
        }
        else
        {
            $this->Order_ReturnModel->sql->rollBackDb();
            $status = 250;
            $msg    = _('failure');
        }

        $this->data->addBody(-140, array(), $msg, $status);

    }

	function excel($title, $tit, $con, $key)
	{
		ob_end_clean();   //***这里再加一个
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("mall_new");
		$objPHPExcel->getProperties()->setLastModifiedBy("mall_new");
		$objPHPExcel->getProperties()->setTitle($title);
		$objPHPExcel->getProperties()->setSubject($title);
		$objPHPExcel->getProperties()->setDescription($title);
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setTitle($title);
		$letter = array(
			'A',
			'B',
			'C',
			'D',
			'E',
			'F',
			'G',
			'H',
			'I',
			'J',
			'K',
			'L',
			'M',
			'N',
			'O',
			'P',
			'Q',
			'R',
			'S',
			'T'
		);
		foreach ($tit as $k => $v)
		{
			$objPHPExcel->getActiveSheet()->setCellValue($letter[$k] . "1", $v);
		}
		foreach ($con as $k => $v)
		{
			$objPHPExcel->getActiveSheet()->setCellValue($letter[0] . ($k + 2), $k + 1);
			foreach ($key as $k2 => $v2)
			{

				$objPHPExcel->getActiveSheet()->setCellValue($letter[$k2 + 1] . ($k + 2), $v[$v2]);
			}
		}
		ob_end_clean();   //***这里再加一个
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment; filename=\"$title.xls\"");
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
		die();
	}

	public function CountAmount()
	{
		$order_id = request_string('id');
		$Order_ReturnModel = new Order_ReturnModel();
		$order_ids  = explode(',',$order_id);
		$data = $Order_ReturnModel->getByWhere(array('order_return_id:in'=>$order_ids));
		$data = array_values($data);
		$money = 0;
		if(!empty($data))
		{
			foreach($data as $key=>$value)
			{
				$money+=$value['return_cash'];
			}
		}
		$result = array();
		$result['money'] = $money;
		$this->data->addBody(-140, $result);
	}

}

?>