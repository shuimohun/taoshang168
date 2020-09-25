<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * Author: yesai
 * Date: 2016/5/19
 * Time: 9:26
 */
class Api_Promotion_ScareBuyCtl extends Api_Controller
{
	public $ScareBuy_BaseModel       = null;
	public $ScareBuy_QuotaModel      = null;
	public $ScareBuy_PriceRangeModel = null;
	public $ScareBuy_CatModel        = null;
	//public $ScareBuy_AreaModel       = null;

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
		$this->ScareBuy_BaseModel       = new ScareBuy_BaseModel();
		$this->ScareBuy_QuotaModel      = new ScareBuy_QuotaModel();
		$this->ScareBuy_PriceRangeModel = new ScareBuy_PriceRangeModel();
		$this->ScareBuy_CatModel        = new ScareBuy_CatModel();
		//$this->ScareBuy_AreaModel       = new ScareBuy_AreaModel();
	}

	//惠抢购商品列表
	public function getScareBuyGoodsList()
	{
		$page     = request_int('page', 1);
		$rows     = request_int('rows', 100);
		$cond_row = array();

		$scarebuy_state	= request_int('scarebuy_state');
		$scarebuy_name 	= trim(request_string('scarebuy_name'));   //惠抢购活动名称
		$goods_name    	= trim(request_string('goods_name'));        //惠抢购商品名称
		$shop_name     	= trim(request_string('shop_name'));         //店铺名称
		$scare_class_id = request_int('scare_class');

		if ($scarebuy_state)
		{
			$cond_row['scarebuy_state'] = $scarebuy_state;
		}

		if($scare_class_id)
		{
			$cond_row['scarebuy_cat_id'] = $scare_class_id;
		}

		if ($scarebuy_name)
		{
			$cond_row['scarebuy_name:LIKE'] = $scarebuy_name . '%';
		}
		if ($goods_name)
		{
			$cond_row['goods_name:LIKE'] = $goods_name . '%';
		}
		if ($shop_name)
		{
			$cond_row['shop_name:LIKE'] = $shop_name . '%';
		}


		$data = $this->ScareBuy_BaseModel->getScareBuyGoodsList($cond_row, array('scarebuy_id' => 'DESC'), $page, $rows);

		$this->data->addBody(-140, $data);
	}

	public function scarebuyManage()
	{
		$scarebuy_id = request_int('scarebuy_id');
		$data        = $this->ScareBuy_BaseModel->getScareBuyDetailByID($scarebuy_id);
		$this->data->addBody(-140, $data);
	}

	public function editScareBuy()
	{
		$scarebuy_id                     = request_int('scarebuy_id');
		$field_row['scarebuy_id']        = $scarebuy_id;
		$field_row['scarebuy_state']     = request_int('scarebuy_state');
		$field_row['scarebuy_recommend'] = request_int('scarebuy_recommend');

		$flag = $this->ScareBuy_BaseModel->editScareBuy($scarebuy_id, $field_row);

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

		$data                             = array();
		$data                             = $field_row;
		$data['scarebuy_state_label']     = ScareBuy_BaseModel::$scarebuy_state_map[request_int('scarebuy_state')];
		$data['scarebuy_recommend_label'] = ScareBuy_BaseModel::$recommend_map[request_int('scarebuy_recommend')];
		$data['scarebuy_id']              = $scarebuy_id;
		$this->data->addBody(-140, $data, $msg, $status);
	}

	//删除惠抢购
	public function removeScareBuy()
	{
		$scarebuy_id = request_int('scarebuy_id');

		$flag = $this->ScareBuy_BaseModel->removeScareBuy($scarebuy_id);

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

	//惠抢购分类
	public function getCat()
	{
		$cond_row = array();
		if (request_int('cat_type'))
		{
			$cond_row['scarebuy_cat_type'] = request_int('cat_type');
		}

		$scarebuy_cat_parent_id = request_int('nodeid', 0);
		$scarebuy_cat_deep      = request_int('n_level', 0);

		$data = $this->ScareBuy_CatModel->getCatTree($scarebuy_cat_parent_id, false, $scarebuy_cat_deep);
		$this->data->addBody(-140, $data);

	}

	//分类管理
	public function getScareBuyCatName()
	{
		$data_re         = array();
		$scarebuy_cat_id = request_int('id');

		$data = $this->ScareBuy_CatModel->getOne($scarebuy_cat_id);
		if ($data)
		{
			$data_re['id']                      = $scarebuy_cat_id;
			$data_re['scarebuy_cat_name']       = $data['scarebuy_cat_name'];
			$data_re['scarebuy_cat_type']       = $data['scarebuy_cat_type'];
			$data_re['scarebuy_cat_type_label'] = ScareBuy_CatModel::$cat_type_map[$data['scarebuy_cat_type']];
		}

		if ($data_re)
		{
			$msg    = _('success');
			$status = 200;
		}
		else
		{
			$msg    = _('failure');
			$status = 250;
		}

		$this->data->addBody(-140, $data_re, $msg, $status);
	}

	//增加分类
	public function addScareBuyCat()
	{
		$data['scarebuy_cat_name']       = $field_row['scarebuy_cat_name'] = request_string('scarebuy_cat_name');
		$data['scarebuy_cat_parent_id']  = $field_row['scarebuy_cat_parent_id'] = request_int('parent_cat');
		$data['scarebuy_cat_sort']       = $field_row['scarebuy_cat_sort'] = request_int('scarebuy_cat_sort');
		$data['scarebuy_cat_type']       = $field_row['scarebuy_cat_type'] = request_int('scarebuy_cat_type');
		$data['scarebuy_cat_type_label'] = ScareBuy_CatModel::$cat_type_map[request_int('scarebuy_cat_type')];

		$scarebuy_cat_id = $this->ScareBuy_CatModel->addScareBuyCat($field_row, true);

		if ($scarebuy_cat_id)
		{
			$msg    = _('success');
			$status = 200;
		}
		else
		{
			$msg    = _('failure');
			$status = 250;
		}

		$data['id']       = $scarebuy_cat_id;
		$data_re['items'] = $data;
		$this->data->addBody(-140, $data_re, $msg, $status);

	}

	//编辑分类
	public function editScareBuyCat()
	{
		$scarebuy_cat_id                = request_string('scarebuy_cat_id');
		$field_row['scarebuy_cat_name'] = request_string('scarebuy_cat_name');
		$field_row['scarebuy_cat_sort'] = request_int('scarebuy_cat_sort');
		$flag                           = $this->ScareBuy_CatModel->editScareBuyCat($scarebuy_cat_id, $field_row);

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
		$data                    = $field_row;
		$data['id']              = $scarebuy_cat_id;
		$data['scarebuy_cat_id'] = $scarebuy_cat_id;
		$data_re['items']        = $data;
		$this->data->addBody(-140, $data_re, $msg, $status);
	}

	/**
	 * 删除操作
	 *
	 * @access public
	 */
	public function removeScareBuyCat()
	{
		$scarebuy_cat_id = request_int('scarebuy_cat_id');

		$flag = $this->ScareBuy_CatModel->removeScareBuyCat($scarebuy_cat_id);

		if ($flag)
		{
			$msg    = _('success');
			$status = 200;
		}
		else
		{

			$m      = $this->ScareBuy_CatModel->msg->getMessages();
			$msg    = $m ? $m[0] : _('failure');
			$status = 250;
		}

		$data['id'] = array($scarebuy_cat_id);

		$this->data->addBody(-140, $data, $msg, $status);
	}

	/**
	 * 删除操作
	 *
	 * @access public
	 */
	public function removeArea()
	{
		$scarebuy_area_id = request_int('scarebuy_area_id');

		$flag = $this->ScareBuy_AreaModel->removeScareArea($scarebuy_area_id);

		if ($flag)
		{
			$msg    = _('success');
			$status = 200;
		}
		else
		{
			$m      = $this->ScareBuy_AreaModel->msg->getMessages();
			$msg    = $m ? $m[0] : _('failure');
			$status = 250;
		}

		$data['id'] = array($scarebuy_area_id);

		$this->data->addBody(-140, $data, $msg, $status);
	}

	//惠抢购活动套餐类表
	public function getScareBuyQuotaList()
	{
		$cond_row  = array();
		$page      = request_int('page', 1);
		$rows      = request_int('rows', 100);
		$shop_name = request_string('shop_name');

		if ($shop_name)
		{
			$cond_row['shop_name:LIKE'] = $shop_name . '%';
		}

		$data = $this->ScareBuy_QuotaModel->getScareBuyQuotaList($cond_row, array('combo_id' => 'DESC'), $page, $rows);

		$this->data->addBody(-140, $data);
	}

	//惠抢购价格区间列表
	public function getPriceRangeList()
	{
		$data = $this->ScareBuy_PriceRangeModel->getPriceRangeList();
		$this->data->addBody(-140, $data);
	}

	//添加惠抢购价格区间
	public function addPriceRange()
	{
		$data["range_name"]  = request_string("range_name");
		$data["range_start"] = request_int("range_start");
		$data["range_end"]   = request_int("range_end");

		if ($data)
		{
			$range_id = $this->ScareBuy_PriceRangeModel->addPriceRange($data);
		}
		if ($range_id)
		{
			$msg    = _('success');
			$status = 200;
		}
		else
		{
			$msg    = _('failure');
			$status = 250;
		}
		$data['range_id'] = $range_id;
		$data['id']       = $range_id;

		$this->data->addBody(-140, $data, $msg, $status);
	}

	//修改惠抢购价格区间
	public function editPriceRange()
	{
		$range_id       		= request_int("range_id");
		$data["range_name"] 	= request_string("range_name");
		$data["range_start"] 	= request_int("range_start");
		$data["range_end"]  	= request_int("range_end");

		$data_rs          		= $data;
		$data_rs['range_id']    = $range_id;

		$this->ScareBuy_PriceRangeModel->editPriceRange($range_id, $data);

		$this->data->addBody(-140, $data_rs);
	}

	//删除惠抢购价格区间
	public function removePriceRange()
	{
		$range_id = request_int('range_id');

		$flag = $this->ScareBuy_PriceRangeModel->removePriceRange($range_id);

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

	//获取惠抢购分类
	public function getScareBuyCatList()
	{
		$data = $this->ScareBuy_CatModel->getScareBuyCatList();
		$this->data->addBody(-140, $data);
	}

	public function scarebuyClass()
	{
		$data  = $this->ScareBuy_CatModel->getByWhere(array(),array());
		$data = array_values($data);
		$result = array();
		$result[0]['id'] = 0;
		$result[0]['name'] = "惠抢购分类";
		foreach($data as $key=>$value)
		{
			$result[$key+1]['id'] = $value['scarebuy_cat_id'];
			$result[$key+1]['name'] = $value['scarebuy_cat_name'];
		}

		$this->data->addBody(-140, $result);
	}




}