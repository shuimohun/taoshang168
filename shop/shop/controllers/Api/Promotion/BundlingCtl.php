<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/19
 * Time: 14:38
 */
class Api_Promotion_BundlingCtl extends Api_Controller
{
	public $Bundling_BaseModel  = null;
	public $Bundling_GoodsModel = null;
	public $Bundling_QuotaModel = null;

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

		$this->Bundling_BaseModel  = new Bundling_BaseModel();
		$this->Bundling_GoodsModel = new Bundling_GoodsModel();
		$this->Bundling_QuotaModel = new Bundling_QuotaModel();
	}

	/* 优惠套装活动*/
	//满送活动列表
	public function getBundlingList()
	{
		$page          	= request_int('page', 1);
		$rows          	= request_int('rows', 100);
		$xian_shi_name 	= trim(request_string('bundling_name'));   //活动名称
		$shop_name     	= trim(request_string('shop_name'));       //店铺名称
		$bundling_state	= request_int('bundling_state');		   //活动状态

		$cond_row = array();

		if ($bundling_state)
		{
			$cond_row['bundling_state'] = $bundling_state;
		}
		if ($xian_shi_name)
		{
			$cond_row['bundling_name:LIKE'] = $xian_shi_name . '%';
		}
		if ($shop_name)
		{
			$cond_row['shop_name:LIKE'] = $shop_name . '%';
		}

		$data = $this->Bundling_BaseModel->getBundlingActList($cond_row, array('bundling_id' => 'DESC'), $page, $rows);

		$this->data->addBody(-140, $data);
	}

	/* 活动下的商品列表*/
	public function getBundlingGoodsListById()
	{
		$cond_row                = array();
		$page                    = request_int('page', 1);
		$rows                    = request_int('rows', 100);
		$cond_row['bundling_id'] = request_int('id');
		$data                    = $this->Bundling_GoodsModel->getBundlingGoodsDetailList($cond_row, array(), $page, $rows);
		$this->data->addBody(-140, $data);
	}

	//取消活动
	public function cancelBundling()
	{
		$data        = array();
		$bundling_id = request_int('bundling_id');
		if ($bundling_id)
		{
			$rs_row = array();

			//获取活动下的商品
			$cond_bundling_goods_row['bundling_id'] = $bundling_id;
			$bundling_goods_id_row                  = $this->Bundling_GoodsModel->getKeyByWhere($cond_bundling_goods_row);

			$this->Bundling_BaseModel->sql->startTransactionDb();

			//修改活动状态
			$field_row['bundling_state'] = Bundling_BaseModel::CANCEL;
			$update_flag1                = $this->Bundling_BaseModel->editBundlingActInfo($bundling_id, $field_row);
			check_rs($update_flag1, $rs_row);

			if (is_ok($rs_row) && $this->Bundling_BaseModel->sql->commitDb())
			{
				$data      = $this->Bundling_BaseModel->getBundlingActItemById($bundling_id);
				$data['a'] = $bundling_id;
				$msg       = _('操作成功');
				$status    = 200;
			}
			else
			{
				$this->Bundling_BaseModel->sql->rollBackDb();
				$msg    = _('操作失败');
				$status = 250;
			}

			$this->data->addBody(-140, $data, $msg, $status);
		}
	}

	/*
	 * 删除活动
	 * 删除活动下的商品
	*/
	public function removeBundlingActivity()
	{
		$data        = array();
		$bundling_id = request_int('bundling_id');

		$this->Bundling_BaseModel->sql->startTransactionDb();

		$flag = $this->Bundling_BaseModel->removeBundlingActItem($bundling_id);

		if ($flag == $this->Bundling_BaseModel->sql->commitDb())
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$this->Bundling_BaseModel->sql->rollBackDb();
			$msg    = 'failure';
			$status = 250;
		}

		$this->data->addBody(-140, $data, $msg, $status);
	}

	//套餐列表
	public function getPackageList()
	{
		$cond_row  = array();
		$page      = request_int('page', 1);
		$rows      = request_int('rows', 100);
		$shop_name = request_string('shop_name');

		if ($shop_name)
		{
			$cond_row['shop_name:LIKE'] = $shop_name . '%';
		}

		$data = $this->Bundling_QuotaModel->getBundlingQuotabyWhere($cond_row, array('bundling_quota_id' => 'DESC'), $page, $rows);

		$this->data->addBody(-140, $data);
	}

}
