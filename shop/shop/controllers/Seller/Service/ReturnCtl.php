<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Seller_Service_ReturnCtl extends Seller_Controller
{
	public $orderReturnModel = null;
	public $orderBaseModel   = null;
	public $orderGoodsModel  = null;
    public $userResourceModel = null;

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
		$this->orderReturnModel = new Order_ReturnModel();
		$this->orderBaseModel   = new Order_BaseModel();
		$this->orderGoodsModel  = new Order_GoodsModel();
        $this->userResourceModel = new User_ResourceModel();
	}

    /**
     * 退款记录
     */
	public function orderReturn()
	{
		$act = request_string('act');

		if ($act == "detail")
		{
			$data = $this->detail();
			$this->view->setMet('detail');
		}
		else
		{
			$data = $this->listReturn(Order_ReturnModel::RETURN_TYPE_ORDER);
		}

		if ($this->typ == "json")
		{
			$this->data->addBody(-140, $data);
		}
		else
		{
		    if($data)
            {
                include $this->view->getView();
            }
            else
            {
                location_to(YLB_Registry::get('url').'?ctl=Seller_Service_Return&met=orderReturn');
            }
		}
	}

    /**
     * 退货记录
     */
	public function goodsReturn()
	{
		$act = request_string('act');

		if ($act == "detail")
		{
			$data = $this->detail();
			$this->view->setMet('detail');
		}
		else
		{
			$data = $this->listReturn(Order_ReturnModel::RETURN_TYPE_GOODS);

			//分销商淘金的商品
			$GoodsCommonModel        = new Goods_CommonModel();
			$Order_GoodsModel = new Order_GoodsModel();
			$dist_commons = $GoodsCommonModel->getByWhere(array('shop_id' => Perm::$shopId,"common_parent_id:>" => 0,'product_is_behalf_delivery' => 1));
			
			if(!empty($dist_commons))
			{
				$dist_common_ids  = array_column($dist_commons,'common_id');
			}
			foreach ($data['items'] as $key => $value)
			{
				if($value['order_goods_id'])
				{
					$order_goods_base = $Order_GoodsModel->getOne($value['order_goods_id']);
					$data['items'][$key]['common_id']  =  $order_goods_base['common_id'];
				}
			}
		}
		if ($this->typ == "json")
		{
			$this->data->addBody(-140, $data);
		}
		else
		{
            if($data)
            {
                include $this->view->getView();
            }
            else
            {
                location_to(YLB_Registry::get('url').'?ctl=Seller_Service_Return&met=goodsReturn');
            }
		}
	}

    /**
     * 获取退款/退货列表
     * @param $type
     * @return array
     */
    public function listReturn($type = Order_ReturnModel::RETURN_TYPE_ORDER)
    {
        $YLB_Page = new YLB_Page();
        $page     = request_int('page',1);
        $rows     = request_int('rows',$YLB_Page->listRows);

        $cond_row['seller_user_id'] = Perm::$shopId;         //店铺ID
        $keyword                    = request_string("keys");
        $start_time                 = request_string("start_date");
        $end_time                   = request_string("end_date");
        $state                      = request_int("status");
        $order_id                   = request_string("order_id");
        if($order_id)
        {
            $cond_row['order_number'] = $order_id;
        }

        if ($keyword)
        {
            if ($type == Order_ReturnModel::RETURN_TYPE_GOODS)
            {
                $cond_row['order_goods_name:LIKE'] = "%" . $keyword . "%";
            }
            else
            {
                $cond_row['order_number'] = $keyword;
            }
        }

        if ($type == Order_ReturnModel::RETURN_TYPE_GOODS)
        {
            $cond_row['return_type'] = Order_ReturnModel::RETURN_TYPE_GOODS;
        }
        else
        {
            $cond_row['return_type:!='] = Order_ReturnModel::RETURN_TYPE_GOODS;
        }
        if ($start_time)
        {
            $cond_row['return_add_time:>='] = $start_time;
        }
        if ($end_time)
        {
            $cond_row['return_add_time:<='] = $end_time;
        }

        $data = $this->orderReturnModel->getReturnList($cond_row, array('return_add_time' => 'DESC'), $page, $rows);

        $goods_ids = array_column($data['items'],"order_goods_id");

        if($goods_ids)
        {
            $goods = $this->orderGoodsModel->getByWhere(array("order_goods_id:IN" => $goods_ids));
            foreach ($data['items'] as $k => $v)
            {
                if($v['order_goods_id'])
                {
                    $data['items'][$k]['good'] = $goods[$v['order_goods_id']];
                }
            }
        }

        $YLB_Page->nowPage    = $page;
        $YLB_Page->listRows   = $rows;
        $YLB_Page->totalPages = $data['total'];
        $data['page']         = $YLB_Page->promptII();

        $data['keys']       = $keyword;
        $data['state']      = $state;
        $data['start_date'] = $start_time;
        $data['end_date']   = $end_time;
        return $data;
    }

    /**
     * 退款退货详情
     *
     * @return array
     */
	public function detail()
	{
		$return_id                   = request_int("id");
		$cond_row['order_return_id'] = $return_id;
		$cond_row['seller_user_id']  = Perm::$shopId;

		$data = $this->orderReturnModel->getReturn($cond_row);

		if($data['seller_user_id'] == Perm::$shopId )
        {
            $return_wait_pass = 0; //待处理标识
            $return_express   = 0;

            if($data['return_shop_state'] == Order_ReturnModel::RETURN_WAIT_PASS && $data['seller_status'])
            {
                $return_wait_pass = 1;
            }

            if($data['return_shop_state'] == Order_ReturnModel::RETURN_SELLER_PASS || $data['return_platform_state'] == Order_ReturnModel::PLAT_PASS)
            {
                $return_express = 1;
            }

            if($data['return_collect_state'])
            {
                $return_express = 0;

                if($data['return_shipping_express_id'])
                {
                    $ExpressModel = new ExpressModel();
                    $express = $ExpressModel->getOne($data['return_shipping_express_id']);
                    if($express)
                    {
                        $data['express_name'] = $express['express_name'];
                    }
                }
            }

            $data['return_wait_pass'] = $return_wait_pass;
            $data['return_express']   = $return_express;

            if ($data['order_goods_id'])
            {
                $data['goods'] = $this->orderGoodsModel->getOne($data['order_goods_id']);
                $data['text']  = _("退货");
            }
            else
            {
                $data['text'] = _("退款");
            }

            if ($this->typ != "json")
            {
                $data['order'] = $this->orderBaseModel->getOne($data['order_number']);
            }
        }

		return $data;
	}


    /**
     * 商家不同意退款
     * 和商家不同意退货 第一步退货
     *
     * @return bool
     */
    public function disagreeReturn()
    {
        $order_return_id     = request_int("order_return_id");
        $return_shop_message = request_string("return_shop_message");

        //有违禁词
        if (Text_Filter::checkBanned($return_shop_message))
        {
            $this->data->addBody(-140, array(), 'failure', 250);
            return false;
        }

        //获取退款/退货申请
        $return = $this->orderReturnModel->getOne($order_return_id);

        //判断是否是当前店铺所有者
        if($return['seller_user_id'] == Perm::$shopId && $return['seller_status'])
        {
            $data['return_shop_state']   = Order_ReturnModel::RETURN_SELLER_UNPASS;
            $data['return_shop_time']    = get_date_time();
            $data['return_shop_message'] = $return_shop_message;

            //开启事物
            $this->orderReturnModel->sql->startTransactionDb();
            $edit_flag = $this->orderReturnModel->editReturn($order_return_id, $data);

            if($return['seller_status'] == Order_ReturnModel::SELLER_STATUS_2 && $return['return_source_id'])
            {
                $edit_flag = $this->orderReturnModel->editReturn($return['return_source_id'], $data);
            }

            if($edit_flag && $this->orderReturnModel->sql->commitDb())
            {
                $status = 200;
                $msg    = _('success');
            }
            else
            {
                $this->orderReturnModel->sql->rollBackDb();
                $status = 250;
                $msg    = _('failure');
            }
        }
        else
        {
            $status = 250;
            $msg    = _('failure');
        }

        $this->data->addBody(-140, array(), $msg, $status);
    }

    /**
     * 商家同意退款
     * 和商家同意退货 第一步退货
     */
    public function agreeReturn()
    {
        $order_return_id = request_int("order_return_id");
        $return          = $this->orderReturnModel->getOne($order_return_id);

        //开启事物
        $this->orderReturnModel->sql->startTransactionDb();

        if($return['seller_user_id'] == Perm::$shopId && $return['seller_status'])
        {
            $return_shop_message = request_string("return_shop_message");
            //是否有违禁词
            $matche_row = array();
            if (Text_Filter::checkBanned($return_shop_message, $matche_row))
            {
                $msg    = _('含有违禁词');
                $status = 250;
                $this->data->addBody(-140, array(), $msg, $status);
                return false;
            }

            //判断是否是退货
            if ($return['return_goods_return'] == Order_ReturnModel::RETURN_GOODS_RETURN)
            {
                $data['return_shop_state']   = Order_ReturnModel::RETURN_SELLER_PASS;
                $data['return_shop_time']    = get_date_time();
                $data['return_shop_message'] = $return_shop_message;
                $flag = $this->orderReturnModel->editReturn($order_return_id, $data);

                if($return['seller_status'] == Order_ReturnModel::SELLER_STATUS_2 && $return['return_source_id'])
                {
                    $flag = $this->orderReturnModel->editReturn($return['return_source_id'], $data);
                }
            }
            else
            {
                $flag = $this->orderReturnModel->refund($return,1,$return_shop_message);

                if($return['seller_status'] == Order_ReturnModel::SELLER_STATUS_2 && $return['return_source_id'])
                {
                    $dist_return = $this->orderReturnModel -> getOne($return['return_source_id']);
                    $flag = $this->orderReturnModel->refund($dist_return,1,$return_shop_message,false);
                }
            }
        }
        else
        {
            $flag = false;
            $msg  = _('failure');
        }

        if($flag && $this->orderReturnModel->sql->commitDb())
        {
            $status = 200;
            $msg    = _('success');
        }
        else
        {
            $this->orderReturnModel->sql->rollBackDb();
            $status = 250;
            $msg    = $msg ? $msg : _('failure');
        }

        $this->data->addBody(-140, array(), $msg, $status);
    }

    /**
     * 商家同意退货
     * 和商家不同意退货
     */
    public function agreeGoods()
    {
        $order_return_id = request_int("order_return_id");
        $return          = $this->orderReturnModel->getOne($order_return_id);

        if($return['seller_user_id'] == Perm::$shopId && $return['seller_status'])
        {
            $is_agree_return = request_string("is_agree_return");
            //是否同意退货
            if($is_agree_return)
            {
                $flag = $this->orderReturnModel->refund($return,3);
                if($return['seller_status'] == Order_ReturnModel::SELLER_STATUS_2 && $return['return_source_id'])
                {
                    $dist_return = $this->orderReturnModel -> getOne($return['return_source_id']);
                    $flag = $this->orderReturnModel->refund($dist_return,3,'',false);
                }

                if ($flag)
                {
                    //退款退货提醒
                    $message = new MessageModel();
                    $message->sendMessage('Refund return reminder', $return['buyer_user_id'], $return['buyer_user_account'], $order_id = NULL, $shop_name = NULL, 0, 1);
                    $status = 200;
                    $msg    = _('success');
                }
                else
                {
                    $status = 250;
                    $msg    = _('failure');
                }
            }
            else
            {
                $collect_disagree_reason = request_string("collect_disagree_reason");
                //有违禁词
                if (Text_Filter::checkBanned($collect_disagree_reason))
                {
                    $this->data->addBody(-140, array(), 'failure', 250);
                    return false;
                }

                $data['return_collect_state'] = Order_ReturnModel::RETURN_SELLER_UNPASS;
                $data['collect_disagree_reason'] = $collect_disagree_reason;
                $edit_flag = $this->orderReturnModel->editReturn($order_return_id, $data);

                if( $return['seller_status'] == Order_ReturnModel::SELLER_STATUS_2 && $return['return_source_id'])
                {
                    $edit_flag = $this->orderReturnModel->editReturn($return['return_source_id'], $data);
                }

                if ($edit_flag)
                {
                    $status = 200;
                    $msg    = _('success');
                }
                else
                {
                    $status = 250;
                    $msg    = _('failure');
                }
            }
        }
        else
        {
            $status = 250;
            $msg    = _('failure');
        }

        $this->data->addBody(-140, array(), $msg, $status);

    }


}

?>