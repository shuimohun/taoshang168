<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     windfnn
 */
class Seller_Trade_DeliverCtl extends Seller_Controller
{
	public $shopShippingAddressModel = null;

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
		$this->shopShippingAddressModel = new Shop_ShippingAddressModel();
		$this->shopExpressModel         = new Shop_ExpressModel();
	}

	/**
	 * 待发货(index)
	 *
	 * @access public
	 *
	 * 筛选出已付款和货到付款的订单
	 */
	public function deliver()
	{
		$Order_BaseModel              = new Order_BaseModel();
		$condition['order_status:IN'] = array( Order_StateModel::ORDER_PAYED, Order_StateModel::ORDER_WAIT_PREPARE_GOODS );
        $condition['order_refund_status'] = Order_BaseModel::REFUND_NO;
        $condition['order_type:NOT IN'] = array(Order_BaseModel::ORDER_DIS,Order_BaseModel::ORDER_CHILD_DIS);
		$data                         = $Order_BaseModel->getPhysicalList($condition);

        //Zhenzh 20180102
        //获取商品淘金链接 去数据库里取值 但是如果商品被删除了 就没有淘金链接了 所以最好把此链接加到订单里去
		if($data['items'])
        {
            $common_ids = array();
            foreach ($data['items'] as $key=>$value)
            {
                $common_ids = array_merge($common_ids,array_column($value['goods_list'],'common_id')) ;
            }
            if($common_ids)
            {
                $Goods_CommonModel = new Goods_CommonModel();
                $goods_common_data = $Goods_CommonModel->select('common_id,tj_link',array('common_id:IN'=>$common_ids));
                $goods_common_new_data = array();
                if($goods_common_data)
                {
                    foreach ($goods_common_data as $key=>$value)
                    {
                        $goods_common_new_data[$value['common_id']] = $value['tj_link'];
                    }
                }

                foreach ($data['items'] as $key=>$value)
                {
                    foreach ($value['goods_list'] as $k=>$v)
                    {
                        if( isset($goods_common_new_data[$v['common_id']]) )
                        {
                            $data['items'][$key]['goods_list'][$k]['tj_link'] = $goods_common_new_data[$v['common_id']];
                        }
                    }
                }
            }
        }


        if (request_string('op') == 'WaybillShipments'){
            $way_key = md5('setting_waybill_shipments');
            $way_key == request_string('way_key') ? $flag = 1 : $flag = 0;
            if ($flag)
            {
                $Waybill_UserBaseModel = new Waybill_UserBaseModel();
                $user_id = Perm::$userId;
                $cond_row = array();
                $cond_row['user_id'] = $user_id;
                $data['waybill_select'] = json_encode($Waybill_UserBaseModel->getByWhere($cond_row));
                $this->view->setMet('WaybillShipments');
            } else {
                $this->data->addBody(-140,$data = array(),$msg ='非法请求',$status = 250);
            }
        }
            if($this->typ == 'json'){
		        $this->data->addBody(-140,$data);
            }else{
                include $this->view->getView();
            }

    }


	/**
	 * 发货中
	 *
	 * @access public
	 */
	public function delivering()
	{
		$Order_BaseModel           = new Order_BaseModel();
		$condition['order_status'] = Order_StateModel::ORDER_WAIT_CONFIRM_GOODS;
		$data                      = $Order_BaseModel->getPhysicalList($condition);

		foreach ($data['items'] as $key => $val)
		{
			if (strtotime($val['order_receiver_date']))
			{
				$data['items'][$key]['order_receiver_date'] = $val['order_receiver_date'];
			}
		}

		$this->view->setMet('deliver');
		include $this->view->getView();
	}

	/**
	 * 已收货
	 *
	 * @access public
	 */
	public function delivered()
	{
		$Order_BaseModel           = new Order_BaseModel();
		$condition['order_status'] = Order_StateModel::ORDER_FINISH;
		$data                      = $Order_BaseModel->getPhysicalList($condition);

		$this->view->setMet('deliver');
		include $this->view->getView();
	}
	
	/**
	 * 延迟发货
	 *
	 * @access public
	 */
	public function delayReceive()
	{
		$typ = request_string('typ');

		if ($typ == 'e')
		{
			include $this->view->getView();
		}
		else
		{
			$order_id            = request_string('order_id');
			$delayDays           = request_int('delay_days');
			$order_receiver_date = request_string('order_receiver_date');

			$order_receiver_date           = strtotime($order_receiver_date);
			$order_receiver_date           = strtotime("+$delayDays days", $order_receiver_date);
			$update['order_receiver_date'] = date('Y-m-d H:i:s', $order_receiver_date);

			$Order_BaseModel = new Order_BaseModel();
			$flag            = $Order_BaseModel->editBase($order_id, $update);

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

			$this->data->addBody(-140, $update, $msg, $status);

		}

	}

	/**
	 * 发货设置
	 * 店铺发货地址列表
	 * @access public
	 */
	public function deliverSetting()
	{
		$YLB_Page           = new YLB_Page();
		$YLB_Page->listRows = 10;
		$rows              = $YLB_Page->listRows;
		$offset            = request_int('firstRow', 0);
		$page              = ceil_r($offset / $rows);

		$cond_row['shop_id'] = Perm::$shopId;
		$data                = $this->shopShippingAddressModel->getBaseList($cond_row, array('shipping_address_time' => 'desc'), $page, $rows);

		$YLB_Page->totalRows = $data['totalsize'];
		$page_nav           = $YLB_Page->prompt();

		if ('json' == $this->typ)
		{
			$this->data->addBody(-140, $data);
		}
		else
		{
			include $this->view->getView();
		}
		
	}

	/**
	 * 默认物流公司
	 *
	 * @access public
	 */
	public function express()
	{
		$shop_id             = Perm::$shopId;
		$cond_row['shop_id'] = $shop_id;
		$data                = $this->shopExpressModel->getShopExpressList($cond_row);
		
		//保存操作
		if (request_string('op') == 'save')
		{
			$express_id = request_row('id');                       //选中的快递ID
			$flag       = $this->shopExpressModel->editShopExpress($shop_id);   //更改
		}
		
		if ('json' == $this->typ)
		{
			$this->data->addBody(-140, $data);
		}
		else
		{
			include $this->view->getView();
		}

	}
	
	/**
	 * 免运费额度
	 *
	 * @access public
	 */
	public function freightAmount()
	{
		$shop_id        = Perm::$shopId;
		$Shop_BaseModel = new Shop_BaseModel();

		//保存操作
		if (request_string('op') == 'save')
		{
			$flag = $Shop_BaseModel->editFreightAmount($shop_id);
			if ($flag !== false)
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
			
			//location_to('index.php?ctl=Seller_Trade_Deliver&met=freightAmount');
		}

		$data = $Shop_BaseModel->getShopBaseInfo($shop_id);
		
		if ('json' == $this->typ)
		{
			$this->data->addBody(-140, $data);
		}
		else
		{
			include $this->view->getView();
		}
	}
	
	/**
	 * 默认配送地区
	 *
	 * @access public
	 */
	public function deliverArea()
	{
		//获取一级地址
		$district_parent_id = request_int('pid', 0);
		$baseDistrictModel  = new Base_DistrictModel();
		$district           = $baseDistrictModel->getDistrictTree($district_parent_id);
		
		$shop_id        = Perm::$shopId;
		$Shop_BaseModel = new Shop_BaseModel();
		$data           = $Shop_BaseModel->getShopBaseInfo($shop_id);

		//保存地址
		if (request_string('op') == 'save')
		{
			$field_row['shop_region'] = request_string('shop_region');
			$flag                     = $Shop_BaseModel->setPrint($shop_id, $field_row);
			
			if ($flag !== false)
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
			//location_to('index.php?ctl=Seller_Trade_Deliver&met=deliverArea');
		}
		
		if ('json' == $this->typ)
		{
			$data['district'] = $district;
			$this->data->addBody(-140, $data);
		}
		else
		{
			include $this->view->getView();
		}
	}
	
	/**
	 * 发货单打印设置
	 *
	 * @access public
	 */
	public function printSetting()
	{
		$shop_id        = Perm::$shopId;
		$Shop_BaseModel = new Shop_BaseModel();
		
		//保存修改
		if (request_string('op') == 'save')
		{
			$field_row['shop_print_desc'] = request_string('shop_print_desc');  //打印描述
			$field_row['shop_stamp']      = request_string('shop_stamp');            //店铺印章

			$flag = $Shop_BaseModel->setPrint($shop_id, $field_row);
			if ($flag !== false)
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
			//location_to('index.php?ctl=Seller_Trade_Deliver&met=printSetting');
		}
		
		$data = $Shop_BaseModel->getShopBaseInfo($shop_id);
		
		if ('json' == $this->typ)
		{
			$this->data->addBody(-140, $data);
		}
		else
		{
			include $this->view->getView();
		}
	}
	
	/**
	 * 新增发货地址
	 * 修改发货地址
	 * @access public
	 */
	public function addAddress()
	{
		$field_row                                 = array();
		$field_row['shop_id']                      = Perm::$shopId;
		$field_row['shipping_address_contact']     = request_string('shipping_address_contact');    //联系人
		$field_row['shipping_address_phone']       = request_string('shipping_address_phone');        //联系方式
		$field_row['shipping_address_address']     = request_string('shipping_address_address');    //详细地址
		$field_row['shipping_address_province_id'] = request_int('province_id');                //省份ID
		$field_row['shipping_address_city_id']     = request_int('city_id');                        //城市ID
		$field_row['shipping_address_area_id']     = request_int('area_id');                        //地区ID
		$field_row['shipping_address_area']        = request_string('address_area');                    //地址信息
		$field_row['shipping_address_company']     = request_string('shipping_address_company');    //公司
		$field_row['shipping_address_time']        = get_date_time();                                  //添加时间
		
		//获取一级地址
		$district_parent_id = request_int('pid', 0);
		$baseDistrictModel  = new Base_DistrictModel();
		$district           = $baseDistrictModel->getDistrictTree($district_parent_id);
		
		//新增地址
		if (request_string('op') == 'save')
		{
			$flag = $this->shopShippingAddressModel->addAddress($field_row, true);

			if ($flag !== false)
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
		
		//修改地址
		if (request_string('op') == 'edit')
		{
			$shipping_address_id = request_int('shipping_address_id');
			if ($shipping_address_id)
			{
				//获取发货地址信息
				$data = $this->shopShippingAddressModel->getAddress($shipping_address_id);
			}
			else
			{

				$id   = request_int('id');
				$flag = $this->shopShippingAddressModel->updateAddress($id, $field_row);
				if ($flag !== false)
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
		}

		if ('json' == $this->typ)
		{
			$this->data->addBody(-140, $district);
		}
		else
		{
			include $this->view->getView();
		}

	}

	/**
	 * 设置默认发货地址
	 *
	 * @access public
	 */
	public function setDefaultAddress()
	{
		$shop_id                               = Perm::$shopId;
		$shipping_address_id                   = request_int('shipping_address_id');
		$field_row                             = array();
		$field_row['shop_id']                  = $shop_id;
		$field_row['shipping_address_default'] = 1;

		$this->shopShippingAddressModel->setDefaultAddress($shop_id, $shipping_address_id, $field_row);
	}

	/**
	 * 删除发货地址
	 *
	 * @access public
	 */
	public function delAddress()
	{
		$shop_id             = Perm::$shopId;
		$shipping_address_id = request_int('id');
		$flag                = $this->shopShippingAddressModel->removeAddress($shipping_address_id);

		if ($flag !== false)
		{
			$status = 200;
			$msg    = _('success');
		}
		else
		{
			$status = 250;
			$msg    = _('failure');
		}
		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);
	}

	public function getDeliverListExcel()
    {
        $Order_BaseModel = new Order_BaseModel();

        $order_id_rows = request_row('order_id');
        if($order_id_rows && is_array($order_id_rows))
        {
            $cond_row['order_id:IN'] = $order_id_rows;
        }

        $query_start_date = request_string('query_start_date');
        $query_end_date = request_string('query_end_date');
        $buyer_name = request_string('buyer_name');
        $order_sn = request_string('order_sn');

        if (!empty($query_start_date))
        {
            $cond_row['order_create_time:>='] = $query_start_date;
        }

        if (!empty($query_end_date))
        {
            $cond_row['order_create_time:<='] = $query_end_date;
        }

        if (!empty($buyer_name))
        {
            $cond_row['buyer_user_name:LIKE'] = "%$buyer_name%";
        }

        if (!empty($order_sn))
        {
            $cond_row['order_id'] = $order_sn;
        }

        $cond_row['shop_id'] = Perm::$shopId;
        $cond_row['order_status:IN'] = array( Order_StateModel::ORDER_PAYED, Order_StateModel::ORDER_WAIT_PREPARE_GOODS );
        $order_row['payment_time'] = 'DESC';
        $con = $Order_BaseModel->getExportOrderList($cond_row,$order_row,1,1000);

        $tit = array(
            '订单号',
            '分销商订单号',
            '收件人姓名',
            '收件人电话',
            '收货人地址',
            '备注',
            '商品名称',
            '简称',
            '销售属性',
            '订单金额',
            '商品数量',
            '运单号',
            '收件人邮编',
            '发货人',
            '发货人电话',
            '发货人公司',
            '发货人地址',
            '发货人邮编',
            '修改时间'
        );
        $key = array(
            'order_id',
            'order_source_id',
            'order_receiver_name',
            'order_receiver_contact',
            'order_receiver_address',
            'order_message',
            'goods_name',
            'goods_name',
            'order_spec_info',
            'order_goods_payment_amount',
            'order_goods_num',
            'order_number',
            'order_receiver_contact',
            'order_seller_name',
            'order_seller_contact',
            'shop_name',
            'order_seller_address',
            'order_seller_number',
            'payment_time',
        );
        $this->excel("发货列表", $tit, $con['items'], $key);
    }

    function excel($title, $tit, $con, $key)
    {
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
            'S'
        );
        foreach ($tit as $k => $v)
        {
            $objPHPExcel->getActiveSheet()->setCellValue($letter[$k] . "1", $v);
        }

        $goods_row = 2;
        foreach ($con as $k => $v)
        {
            foreach ($v['goods_list'] as $gk=>$gv)
            {
                unset($gv['order_id']);
                foreach ($key as $k2 => $v2)
                {
                    if(isset($gv[$v2]))
                    {
                        $value = $gv[$v2];
                    }
                    else if(isset($v[$v2]) && $gk == 0)
                    {
                        $value = $v[$v2];
                    }
                    else
                    {
                        $value = '';
                    }

                    $objPHPExcel->getActiveSheet()->setCellValue($letter[$k2] . $goods_row, $value);
                }
                $goods_row++;
            }
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$title.xls\"");
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        die();
    }
}

?>