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
class Seller_TransportCtl extends Seller_Controller
{
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);

		$this->transportTypeModel = new Transport_TypeModel();

		$this->transportItemModel = new Transport_ItemModel();

		$this->transportTypesModel = new Transport_TypesModel();

		$this->transportItemsModel = new Transport_ItemssModel();

		$this->CommonGoodsModel    = new Goods_CommonModel();
	}


	//显示物流工具列表页
	public function transport()
	{
		$act     = request_string('act');
		$shop_id = Perm::$shopId;
		//获取该店铺已经设置的售卖区域
		$shop_transport = $this->transportTypeModel->getShopDistrict($shop_id);
		//获取地区数组
		$Base_DistrictModel = new Base_DistrictModel();


        $areas = $Base_DistrictModel->getCache();
		$type_city = array();
        //获取list页面数据
        $list = $this->transportTypesModel->getTransportCont(array('shop_id'=>$shop_id));

        if (!empty($list['items']) && is_array($list['items'])) {
            $transport = array();
            foreach ($list['items'] as $v) {
                if (!array_key_exists($v['id'], $transport)) {
                    $transport[$v['id']] = $v['transport_type_id'];
                }
            }

            $item = $this->transportItemsModel->getItemList(array('transport_type_id:IN'=>$transport));

            if (!empty($item['items'])) {
                $tmp_item = array();
                foreach ($item['items'] as $val) {
                    $tmp_item[$val['transport_type_id']]['data'][] = $val;

                    if ($val['is_default'] == 1) {
                        $tmp_item[$val['transport_id']]['price'] = $val['sprice'];
                    }
                }
                $extends = $tmp_item;
            }
        }

		if ($act == 'edit')
		{
			$this->view->setMet('message');

			$transport_type_id = request_int('transport_type_id');

			$cond_row['transport_type_id'] = $transport_type_id;

			$data = $this->transportTypeModel->getTransportInfo($transport_type_id);

			//获取该模板的售卖区域
			$type_city = explode(',', $data['transport_item']['transport_item_city']);

			//在店铺的已售区域中去除该模板的售卖区域
			$shop_transport = array_diff($shop_transport, $type_city);


			fb($shop_transport);
			fb("该模板的售卖区域");
		}
		elseif($act == 'edits')
		{
            $this->view->setMet('addTransport');
            $data = array();
            $transport_type_id =  request_int('id');

            $transport = $this->transportTypesModel->getOne($transport_type_id);

            $extend = array_merge($this->transportItemsModel->getByWhere(array('transport_type_id'=>$transport_type_id)));

        }
		elseif ($act == 'add')
		{
			$this->view->setMet('message');
			$data = array();
		}
		else if($act == 'adds')
		{
            $this->view->setMet('addTransport');
            $data = array();
        }
        else if($act == 'list')
        {
            $this->view->setMet('transport_list');
            $data = array();
        }
		else
		{
			$data = $this->getTransportList();
        }

        if($this->typ == 'json'){
            $this->data->addBody(-140,$data);
        }else{
            include $this->view->getView();
        }


	}

	//新增方法默认物流
    public function defaultLogistics(){
        include $this->view->getView();
    }
    //新增方法服务商设置
    public function serveConfig(){
        include $this->view->getView();
    }
    //新增方法
    public function logisticsMessage(){
        include $this->view->getView();
    }
	/**
	 * 获取评价列表
	 *
	 * @access public
	 */
	public function getTransportList()
	{
		$page = request_int('page', 1);
		$rows = request_int('rows', 100);

		$shop_id = Perm::$shopId;

		$cond_row  = array();
		$order_row = array();


		$cond_row['shop_id'] = $shop_id;


		$data = $this->transportTypesModel->getTransportList($cond_row, $order_row, $page, $rows);


		if ($data)
		{
			$status = 200;
			$msg    = _('success');
		}
		else
		{
			$status = 250;
			$msg    = _('failure');
		}


		$this->data->addBody(-140, $data, $msg, $status);

		return $data;
	}

	//新方法添加和修改
    public function addEditTransport(){
        //开启事物
        $this->transportTypesModel->sql->startTransactionDb();

        $flag = false;
        $trans_info = array();
        $trans_info['transport_type_name']        = $_POST['title'];
        $trans_info['shop_id']     = Perm::$shopId;
        $trans_info['transport_type_time']  = date('Y-m-d H:i:s');

        if(is_numeric($_POST['transport_type_id']))
        {
            $add_id = intval($_POST['transport_type_id']);
            $this->transportTypesModel->editTransportType($add_id,$trans_info);
            $this->transportItemsModel->delItemNum($add_id);
        }
        else
        {
            $add_id = $this->transportTypesModel->addType($trans_info, true);
        }

        $areas = $_POST['areas']['kd'];
        $special = $_POST['special']['kd'];


        if (is_array($special)){
            foreach ($special as $key=>$value) {
                $tmp = array();
                if (empty($areas[$key])) continue;
                $areas[$key] = explode('|||',$areas[$key]);
                $tmp['transport_type_id'] = $add_id;
                $tmp['transport_item_city'] = ','.$areas[$key][0].',';
                $tmp['transport_item_city_name'] = $areas[$key][1];
                $tmp['transport_item_default_num'] = $value['default_num'];
                $tmp['transport_item_default_price'] = $value['postage'];
                $tmp['transport_item_add_num'] = $value['add_num'];
                $tmp['transport_item_add_price'] = $value['add_price'];
                $tmp['transport_type_name'] = $_POST['title'];
                $flag = $this->transportItemsModel->addItem($tmp, true);
            }
        }


        if ($flag && $this->transportTypesModel->sql->commitDb())
        {
            $status = 200;
            $msg    = _('success');
        }
        else
        {
            $this->transportTypesModel->sql->rollBackDb();
            $m      = $this->transportTypesModel->msg->getMessages();
            $msg    = $m ? $m[0] : _('failure');
            $status = 250;
        }
        $data = array();
        $this->data->addBody(-140, $data, $msg, $status);
    }

	public function addTransport()
	{
		//开启事物
		$this->transportTypeModel->sql->startTransactionDb();

		$flag         = false;
		$add_type_row = array(
			'transport_type_name' => request_string('type_name'),
			'shop_id' => Perm::$shopId,
			'transport_type_time' => date('Y-m-d H:i:s'),
		);

		$add_id = $this->transportTypeModel->addType($add_type_row, true);

		$city_row = request_row('city');
		$city     = implode(',', $city_row);
		fb($city);
		if ($add_id)
		{
			$add_item_row = array(
				'transport_type_id' => $add_id,
				'transport_item_default_num' => request_float('default_num'),
				'transport_item_default_price' => request_float('default_price'),
				'transport_item_add_num' => request_int('add_num'),
				'transport_item_add_price' => request_float('add_price'),
				'transport_item_city' => $city,
			);

			$this->transportItemModel->addItem($add_item_row, true);
			$flag = true;
		}

		if ($flag && $this->transportTypeModel->sql->commitDb())
		{
			$status = 200;
			$msg    = _('success');
		}
		else
		{
			$this->transportTypeModel->sql->rollBackDb();
			$m      = $this->transportTypeModel->msg->getMessages();
			$msg    = $m ? $m[0] : _('failure');
			$status = 250;
		}
		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);

	}

	public function editTransport()
	{
		$transport_type_id = request_int('transport_type_id');
		$transport_item_id = request_int('transport_item_id');
		$default = request_string('default');
		$city_row          = request_row('city');
		$city              = implode(',', $city_row);

		$edit_type_row = array('transport_type_name' => request_string('type_name'),);

		//开启事物
		$this->transportTypeModel->sql->startTransactionDb();
		$this->transportTypeModel->editType($transport_type_id, $edit_type_row);

		if($default == 'default')
		{
			$city = 'default';
		}

		$edit_item_row = array(
			'transport_item_default_num' => request_float('default_num'),
			'transport_item_default_price' => request_int('default_price'),
			'transport_item_add_num' => request_float('add_num'),
			'transport_item_add_price' => request_int('add_price'),
			'transport_item_city' => $city,
		);
		fb($default);
		fb($transport_item_id);
		fb($edit_item_row);
		$flag          = $this->transportItemModel->editItem($transport_item_id, $edit_item_row);
		fb($flag);
		fb("修改");
		if ($flag && $this->transportTypeModel->sql->commitDb())
		{
			$status = 200;
			$msg    = _('success');
		}
		else
		{
			$this->transportTypeModel->sql->rollBackDb();
			$m      = $this->transportTypeModel->msg->getMessages();
			$msg    = $m ? $m[0] : _('failure');
			$status = 250;
		}
		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);

	}

	//新方法删除
	public function delTransports()
    {
        $transport_type_id = request_int('id');
        fb($transport_type_id);
        $cond_row['shop_id'] = perm::$shopId;
        $cond_row['transport_type_id'] = $transport_type_id;
        $comm =  $this->CommonGoodsModel->getCommonNormalList($cond_row);
        if(count($comm['items']) >= 1)
        {
            $status = 300;
            $msg    = _('有商品使用该运费模板不能删除');
        }
        else
        {
            //开启事务
            $this->transportTypesModel->sql->startTransactionDb();

            $flag = $this->transportTypesModel->delTypes($transport_type_id);

            $item = $this->transportItemsModel->getItemList(array('transport_type_id'=>$transport_type_id));

            if($item['totalsize'] >= 1)
            {
                foreach($item['items'] as $key=>$value)
                {
                    $flag = $this->transportItemsModel->delItems($value['transport_item_id']);
                }
            }

            if ($flag && $this->transportTypesModel->sql->commitDb())
            {
                $status = 200;
                $msg    = _('success');
            }
            else
            {
                $this->transportTypesModel->sql->rollBackDb();
                $m      = $this->transportTypesModel->msg->getMessages();
                $msg    = $m ? $m[0] : _('failure');
                $status = 250;

            }
        }

        $data = array();
        $this->data->addBody(-140, $data, $msg, $status);
    }

	public function  delTransportRow()
	{
		$transport_type_id = request_row('id');

		fb($transport_type_id);
		//开启事物
		$this->transportTypeModel->sql->startTransactionDb();

		foreach ($transport_type_id as $key => $val)
		{
			$flag = $this->transportTypeModel->delType($val);
		}

		if ($flag && $this->transportTypeModel->sql->commitDb())
		{
			$status = 200;
			$msg    = _('success');
		}
		else
		{
			$this->transportTypeModel->sql->rollBackDb();
			$m      = $this->transportTypeModel->msg->getMessages();
			$msg    = $m ? $m[0] : _('failure');
			$status = 250;

		}
		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);
	}

	public function delTransport()
	{
		$transport_type_id = request_int('id');

		//开启事物
		$this->transportTypeModel->sql->startTransactionDb();

		$flag = $this->transportTypeModel->delType($transport_type_id);

		if ($flag && $this->transportTypeModel->sql->commitDb())
		{
			$status = 200;
			$msg    = _('success');
		}
		else
		{
			$this->transportTypeModel->sql->rollBackDb();
			$m      = $this->transportTypeModel->msg->getMessages();
			$msg    = $m ? $m[0] : _('failure');
			$status = 250;

		}
		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);
	}

	//根据收货地址与商品id计算出物流运费
	public function getTransportCost()
	{
		$city = request_string('city');

		$cart_id = request_string('cart_id');

		$data = $this->transportTypeModel->countTransportCost($city, $cart_id);

		$this->data->addBody(-140, $data);
	}

	//发布商品选择售卖地区
	public function chooseTranDialog()
	{
		$transport_list = $this->getTransportList();

		$transport_list = $transport_list['items'];
		include $this->view->getView();
	}
}

?>