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
class Api_Promotion_PriceCtl extends Api_Controller
{
	public $Price_BaseModel  = null;
	public $Goods_BaseModel  = null;
	public $shop_info         = array();  //店铺信息
	public $shopBaseModel     = null;
	public $Price_QuotaModel =null;
	
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

		$this->priceBaseModel  = new Price_BaseModel();
		$this->goodsBaseModel  = new Goods_BaseModel();
		$this->shopBaseModel     = new Shop_BaseModel();
		$this->priceQuotaModel     = new Price_QuotaModel();
		$this->shop_info         = $this->shopBaseModel->getOne(Perm::$shopId);//店铺信息
	}


	//专享活动列表
	public function getPriceList()
	{

		$cond_row = array();
		$page          	= request_int('page', 1);
		$rows          	= request_int('rows', 100);
		$goods_id	= trim(request_string('goods_id'));    //活动名称
//		$price_state	= request_int('price_state');		   //活动状态
//		$goods_id 	= request_string('goods_id');
//		$goods_image 	= request_string('goods_image');
//		$goods_price    = request_string('goods_price');
//		$zx_price    = request_string('zx_price');
		if ($goods_id)
		{
			$cond_row['goods_id'] =  $goods_id;
		}
		   $data = $this->priceBaseModel->getPriceActList($cond_row, array('goods_id' => 'DESC'), $page, $rows);

		   // var_dump($data);die;
		$this->data->addBody(-140, $data);
	}

	/* 活动下的商品列表*/
	public function getPriceListById(){
	$cond_row                = array();
		$page                    = request_int('page', 1);
		$rows                    = request_int('rows', 100);

		$cond_row = array();

		if ($goods_name)
		{
			$cond_row['goods_name:LIKE'] = $goods_name . '%';
		}

		$data                    = $this->priceBaseModel->getPriceActLists($cond_row, array(), $page, $rows);
	}

	//取消活动
	public function cancelDiscount()
	{
		$data        = array();
		$discount_id = request_int('discount_id');
		if ($discount_id)
		{
			$rs_row = array();

			//获取活动下的商品
			$cond_discount_goods_row['discount_id'] = $discount_id;
			$discount_goods_id_row                  = $this->Discount_GoodsModel->getKeyByWhere($cond_discount_goods_row);

			$this->Discount_BaseModel->sql->startTransactionDb();

			//修改活动状态
			$field_row['discount_state'] = Discount_BaseModel::CANCEL;
			$update_flag1                = $this->Discount_BaseModel->editDiscountActInfo($discount_id, $field_row);
			check_rs($update_flag1, $rs_row);

			//修改活动下商品状态
			if ($discount_goods_id_row)
			{
				$field_discount_goods_row['discount_goods_state'] = Discount_GoodsModel::CANCEL;
				$update_flag2                                     = $this->Discount_GoodsModel->editDiscountGoods($discount_goods_id_row, $field_discount_goods_row);
				check_rs($update_flag2, $rs_row);

				$update_flag3                                     = $this->Discount_GoodsModel->changeDiscountGoodsUnnormal($discount_goods_id_row);
				check_rs($update_flag3, $rs_row);
			}

			if (is_ok($rs_row) && $this->Discount_BaseModel->sql->commitDb())
			{
				$data      = $this->Discount_BaseModel->getDiscountActItemById($discount_id);
				$data['a'] = $discount_id;
				$msg       = _('操作成功');
				$status    = 200;
			}
			else
			{
				$this->Discount_BaseModel->sql->rollBackDb();
				$msg    = _('操作失败');
				$status = 250;
			}

			$this->data->addBody(-140, $data, $msg, $status);
		}
	}

	/*
	 * 删除限时折扣活动
	 * 删除活动
	 * 删除活动下的商品
	*/
public function removePriceAct(){

		$price_id = request_int('price_id');
		$check_right = $this->priceBaseModel->getOne($price_id);
		// var_dump($check_right);die;
		if (!empty($check_right))
		{
			$flag = $this->priceBaseModel->removePriceActItem($price_id);
			
				$msg    = 'success';
				$status = 200;
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}

		$data['price_id'] = $price_id;

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

		$data = $this->priceQuotaModel->getPriceComboList($cond_row, array('combo_id' => 'DESC'), $page, $rows);
		// var_dump($data);die;
		$this->data->addBody(-140, $data);
	}

}
