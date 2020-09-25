<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Order_ReturnModel extends Order_Return
{

	const RETURN_WAIT_PASS      = 1;//新提交申请
	const RETURN_SELLER_PASS    = 2;//卖家同意退货
	const RETURN_SELLER_UNPASS  = 3;//卖家不同意
	const RETURN_SELLER_GOODS   = 4;//卖家同意

    const PLAT_NO             = 0;//无申诉
    const PLAT_WAIT_PASS      = 1;//申诉中
    const PLAT_PASS           = 2;//申诉通过
    const PLAT_UNPASS         = 3;//申诉被驳回

    const RETURN_FINISH_NO    = 1;
    const RETURN_FINISH       = 2;


	const RETURN_TYPE_ORDER     = 1;
	const RETURN_TYPE_GOODS     = 2;
	const RETURN_TYPE_VIRTUAL   = 3;

	const RETURN_GOODS_ISRETURN = 0;
	const RETURN_GOODS_RETURN   = 1;

	//商家是否可以处理0不可以 1可以 2供应商的退款单
    const SELLER_STATUS_0   = 0;
    const SELLER_STATUS_1   = 1;
    const SELLER_STATUS_2   = 2;

	public static $state = array(
		'1' => 'wait_pass',    //等待卖家审核
		'2' => 'seller_pass',  //卖家审核通过
		'3' => 'seller_unpass',//卖家审核不通过
		'4' => 'seller_goods', //卖家收到货
		'5' => 'plat_pass',    //平台审核通过

        '6' => 'plat',          //平台申诉中
        '7' => 'plat_unpass'    //平台申诉审核不通过
	);

	public $return_state;
	public $return_type;

    public static $return_shop_state = array(
        '1' => '等待商家处理',
        '2' => '商家同意',//退货
        '3' => '商家不同意',//退货
        '4' => '完成',
        '5' => '商家不同意'
    );

    public static $platform_state = array(
        '1' => '买家申诉中',
        '2' => '买家申诉成功',
        '3' => '买家申诉被驳回'
    );

    public static $recheck_state = array(
        '1' => '买家申诉中',
        '2' => '买家申诉成功',
        '3' => '买家申诉被驳回'
    );

    public static $collect_goods_state = array(
        '1' => '',
        '2' => '退货完成',
        '3' => '商家不同意退货'
    );



	public function __construct()
	{
		parent::__construct();
		$this->return_state = array(
			'1' => _("等待商家审核"),
			'2' => _("商家审核通过"),
			'3' => _("商家审核未通过"),
			'4' => _("完成"),
			'5' => _("申诉成功"),

            '6' => _("平台申诉中"),
            '7' => _("申诉被驳回"),
		);
		$this->return_type  = array(
			'1' => _("退款"),
			'2' => _("退货"),
			'3' => _("虚拟订单退款")
		);
	}

    /**
     * 读取分页列表
     *
     * @param array $cond_row
     * @param array $order_row
     * @param int $page
     * @param int $rows
     * @return array
     */
	public function getReturnList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
		$data = $this->listByWhere($cond_row, $order_row, $page, $rows);
		foreach ($data['items'] as $k => $v)
		{
            $data['items'][$k]['return_shop_state_con']     = @self::$return_shop_state[$v['return_shop_state']];
            $data['items'][$k]['return_platform_state_con'] = @self::$platform_state[$v['return_platform_state']];
            $data['items'][$k]['return_collect_state_con']  = @self::$collect_goods_state[$v['return_collect_state']];
            $data['items'][$k]['return_recheck_state_con']  = @self::$recheck_state[$v['return_recheck_state']];

            if($v['return_shop_state'])
            {
                $data['items'][$k]['return_state_con'] = $data['items'][$k]['return_shop_state_con'];
            }

            if($v['return_platform_state'])
            {
                $data['items'][$k]['return_state_con'] = $data['items'][$k]['return_platform_state_con'];
            }

            if($v['return_collect_state'])
            {
                $data['items'][$k]['return_state_con'] = $data['items'][$k]['return_collect_state_con'];
            }

            if($v['return_recheck_state'])
            {
                $data['items'][$k]['return_state_con'] = $data['items'][$k]['return_recheck_state_con'];
            }

        }
		return $data;
	}

	public function getReturnExcel($cond_row = array(), $order_row = array())
	{
		$data = $this->getByWhere($cond_row, $order_row);

		foreach ($data as $k => $v)
		{
			$data[$k]['order_number'] = " " . $v['order_number'] . " ";
			$data[$k]['return_code']  = " " . $v['return_code'] . " ";
		}

		return array_values($data);
	}

	public function getReturn($cond_row = array(), $order_row = array())
	{
		$data = $this->getOneByWhere($cond_row, $order_row);
		if($data)
        {
            $data['return_shop_state_con']  = self::$return_shop_state[$data['return_shop_state']];
            $data['return_platform_state_con']  = self::$platform_state[$data['return_platform_state']];
            $data['return_recheck_state_con']  = self::$recheck_state[$data['return_recheck_state']];
            $data['return_collect_state_con']  = self::$collect_goods_state[$data['return_collect_state']];
        }

		return $data;
	}

	public function getReturnBase($id)
	{
		$data = $this->getOne($id);
        $data['return_shop_state_con']  = self::$return_shop_state[$data['return_shop_state']];
        $data['return_platform_state_con']  = self::$platform_state[$data['return_platform_state']];
        $data['return_recheck_state_con']  = self::$recheck_state[$data['return_recheck_state']];

		return $data;
	}

	public function settleReturn($cond_row = array())
	{
		//退款金额
		$return_amount = 0;
		//退款佣金
		$commission_return_amount = 0;

		$data = $this->getByWhere($cond_row);
		
		$res = array(
			'return_amount' => array_sum(array_column($data,'return_cash')),
			'commission_return_amount' => array_sum(array_column($data,'return_commision_fee')),
			'redpacket_return_amount' => array_sum(array_column($data,'return_rpt_cash'))
		);
		return $res;
	}

	public function getSubQuantity($cond_row)
	{
		return $this->getNum($cond_row);
	}
	//查询某字段
    public function getStatistics($field = '*',$cond_row,$group)
    {
        return $this->select($field,$cond_row,$group);
    }
    //获取表名
    public function tabase(){
        return $this->_tableName;
    }
    //执行sql
    public function sql($sql){
        return $this->sql->getAll($sql);
    }


    /**
     * 退款操作
     *
     * @param $return
     * @param $type
     * @param $message
     * @param bool $points_flag 是否退经验/金蛋
     * @return array
     */
    public function refund($return,$type,$message='',$points_flag = true)
    {
        $OrderBaseModel    = new Order_BaseModel();
        $OrderGoodsModel   = new Order_GoodsModel();
        $UserResourceModel = new User_ResourceModel();

        $shop_api_key      = YLB_Registry::get('shop_api_key');
        $paycenter_api_url = YLB_Registry::get('paycenter_api_url');
        $shop_app_id       = YLB_Registry::get('shop_app_id');

        $rs_row = array();

        $user_id            = Perm::$userId;
        $order_id           = $return['order_number'];
        $order_finish       = false;
        $shop_return_amount = 0;
        $money              = 0;

        //判断该笔退款金额的订单是否已经结算
        $order_base = $OrderBaseModel->getOne($order_id);

        //判断该笔订单是否已经收货，如果没有收货的话，不扣除卖家资金。已确认收货则扣除卖家资金
        if($order_base['order_status'] == Order_StateModel::ORDER_FINISH )
        {
            //获取用户的账户资金资源
            $formvars            = array();
            $formvars['user_id'] = $user_id;
            $formvars['app_id']  = $shop_app_id;

            $money_row = get_url_with_encrypt($shop_api_key, sprintf('%s?ctl=Api_User_Info&met=getUserResourceInfo&typ=json', $paycenter_api_url), $formvars);
            $user_money = 0;
            $user_money_frozen = 0;
            if ($money_row['status'] == '200')
            {
                $money = $money_row['data'];
                $user_money        = $money['user_money'];
                $user_money_frozen = $money['user_money_frozen'];
            }

            $shop_return_amount = $return['return_cash'] - $return['return_commision_fee'];

            //获取该店铺最新的结算结束日期
            $Order_SettlementModel = new Order_SettlementModel();
            $settlement_last_info = $Order_SettlementModel->getLastSettlementByShopid(Perm::$shopId, $return['order_is_virtual']);

            if($settlement_last_info)
            {
                $settlement_unixtime = $settlement_last_info['os_end_date'] ;
            }
            else
            {
                $settlement_unixtime = '';
            }

            $settlement_unixtime = strtotime($settlement_unixtime);
            $order_finish_time = $order_base['order_finished_time'];
            $order_finish_unixtime = strtotime($order_finish_time);

            if($settlement_unixtime >= $order_finish_unixtime )
            {
                //结算时间大于订单完成时间。需要扣除卖家的现金账户
                $money = $user_money;
                $pay_type = 'cash';
            }
            else
            {
                //结算时间小于订单完成时间。需要扣除卖家的冻结资金,如果冻结资金不足就扣除账户余额
                $money = $user_money_frozen + $user_money;
                $pay_type = 'frozen_cash';
            }
        }
        else
        {
            $order_finish = true;
        }

        if(($shop_return_amount <= $money) || $order_finish)
        {
            $order_edit = array();

            if($type == 1)
            {
                $edit_return_data['return_shop_state']   = Order_ReturnModel::RETURN_SELLER_GOODS;
                $edit_return_data['return_shop_time']    = get_date_time();
                $edit_return_data['return_shop_message'] = $message;

                $order_edit['order_status'] = Order_StateModel::ORDER_CANCEL;
                $order_edit['order_cancel_identity'] = 2;
                $order_edit['order_cancel_date'] = get_date_time();
                $order_edit['order_cancel_reason'] = '同意退款';
            }
            else if($type == 2)
            {
                $edit_return_data['return_platform_state']   = Order_ReturnModel::PLAT_PASS;
                $edit_return_data['return_platform_time']    = get_date_time();
                $edit_return_data['return_platform_message'] = $message;

                $order_edit['order_status'] = Order_StateModel::ORDER_CANCEL;
                $order_edit['order_cancel_identity'] = 2;
                $order_edit['order_cancel_date'] = get_date_time();
                $order_edit['order_cancel_reason'] = '同意退款';
            }
            else if($type == 3)
            {
                $edit_return_data['return_collect_state'] = Order_ReturnModel::RETURN_SELLER_PASS;
            }
            else if($type == 4)
            {
                $edit_return_data['return_recheck_state']   = Order_ReturnModel::PLAT_PASS;
                $edit_return_data['return_recheck_time']    = get_date_time();
                $edit_return_data['return_recheck_message'] = $message;
            }

            $edit_return_data['return_state']       = Order_ReturnModel::RETURN_FINISH;
            $edit_return_data['return_finish_time'] = get_date_time();
            $edit_flag = $this->editReturn($return['order_return_id'], $edit_return_data);
            check_rs($edit_flag, $rs_row);

            if ($return['order_goods_id'])
            {
                //商品退换情况为完成2
                $goods_data['goods_refund_status'] = Order_GoodsModel::REFUND_COM;
                $edit_flag                         = $OrderGoodsModel->editGoods($return['order_goods_id'], $goods_data);
                check_rs($edit_flag, $rs_row);

                $row_count = $OrderGoodsModel->getRowCount(array('order_id'=>$order_id,'goods_refund_status'=>Order_GoodsModel::REFUND_IN));
                if(!$row_count)
                {
                    $order_edit['order_return_status'] = Order_GoodsModel::REFUND_COM;
                }
            }
            else
            {
                $order_edit['order_refund_status'] = Order_BaseModel::REFUND_COM;
            }

            //退款金额，退货数量，交易佣金退款更新到订单表中
            $order_edit['order_refund_amount']         = $order_base['return_cash'] + $return['return_cash'];
            $order_edit['order_return_num']            = $order_base['order_goods_num'] + $return['order_goods_num'];
            $order_edit['order_commission_return_fee'] = $order_base['return_commision_fee'] + $return['return_commision_fee'];

            $edit_flag  = $OrderBaseModel->editBase($order_id, $order_edit);
            check_rs($edit_flag, $rs_row);

            if(is_ok($rs_row))
            {
                $formvars                   = array();
                $formvars['app_id']         = $shop_app_id;
                $formvars['user_id']        = $return['buyer_user_id'];
                $formvars['user_account']   = $return['buyer_user_account'];
                $formvars['seller_id']      = $return['seller_user_id'];
                $formvars['seller_account'] = $return['seller_user_account'];
                $formvars['amount']         = $return['return_cash'];
                $formvars['order_id']       = $return['order_number'];
                $formvars['return_code']    = $return['return_code'];
                $formvars['goods_id']       = $return['order_goods_id'];
                $formvars['uorder_id']      = $order_base['payment_other_number'];
                $formvars['payment_id']     = $order_base['payment_id'];

                $rs = get_url_with_encrypt($shop_api_key, sprintf('%s?ctl=Api_Pay_Pay&met=refundBuyerTransfer&typ=json', $paycenter_api_url), $formvars);
                if ($rs['status'] == 200)
                {
                    check_rs(true, $rs_row);
                }
                else
                {
                    check_rs(false, $rs_row);
                }

                if(is_ok($rs_row) && !$order_finish)
                {
                    //扣除卖家的金额
                    $formvars              = array();
                    $formvars['user_id']   = $user_id;
                    $formvars['user_name'] = Perm::$row['user_name'];
                    $formvars['app_id']    = $shop_app_id;
                    $formvars['money']     = $shop_return_amount * (-1);
                    $formvars['pay_type']  = $pay_type;
                    $formvars['reason']    = '退款';
                    $formvars['order_id']  = $order_base['order_id'];
                    $formvars['goods_id']  = $return['order_goods_id'];

                    $rs = get_url_with_encrypt($shop_api_key, sprintf('%s?ctl=Api_User_Info&met=editReturnUserResourceInfo&typ=json', $paycenter_api_url), $formvars);

                    if($rs['status'] == 200)
                    {
                        check_rs(true, $rs_row);

                        if($points_flag)
                        {
                            //退款退货减金蛋
                            //获取金蛋经验值
                            $field_row_points['user_points'] = '-' . $order_base['order_points_add'];
                            $field_row_points['user_growth'] = '-' . $order_base['order_grade_add'];
                            $edit_user_point_flag            = $UserResourceModel->editResource($order_base['buyer_user_id'], $field_row_points, true);
                            if($edit_user_point_flag)
                            {
                                $points_row['user_id']           = $order_base['buyer_user_id'];
                                $points_row['user_name']         = $order_base['buyer_user_name'];
                                $points_row['class_id']          = Points_LogModel::ONOFF;
                                $points_row['points_log_type']   = 2;
                                $points_row['points_log_points'] = $order_base['order_points_add'];
                                $points_row['points_log_time']   = get_date_time();
                                $points_row['points_log_desc']   = '退款/退货减金蛋';
                                $points_row['points_log_flag']   = 'refund';
                                $Points_LogModel = new Points_LogModel();
                                $Points_LogModel->addLog($points_row);

                                $grade_row['user_id']         = $order_base['buyer_user_id'];
                                $grade_row['user_name']       = $order_base['buyer_user_name'];
                                $grade_row['class_id']        = Grade_LogModel::ONOFF;
                                $grade_row['grade_log_grade'] = $field_row_points['user_growth'];
                                $grade_row['grade_log_time']  = get_date_time();
                                $grade_row['grade_log_desc']  = '退款/退货减经验';
                                $grade_row['grade_log_flag']  = 'refund';
                                $Grade_LogModel = new Grade_LogModel;
                                $Grade_LogModel->addLog($grade_row);
                            }
                        }
                    }
                    else
                    {
                        check_rs(false, $rs_row);
                    }
                }
            }
        }
        else
        {
            check_rs(false, $rs_row);
            $msg = _('账户余额不足');
        }

        return is_ok($rs_row);
    }

}

?>