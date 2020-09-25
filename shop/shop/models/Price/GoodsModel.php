<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * User: zzh
 * Date: 2017/02/16
 * Time: 17:25
 */
class Price_GoodsModel extends Price_Goods
{
	const NORMAL = 1;       //活动正常
	const END    = 2;        //活动结束
	const CANCEL = 3;       //活动取消

	const UNRECOMMEND = 0;  //未推荐
	const RECOMMEND   = 1;    //推荐

	public $Goods_BaseModel = null;

	public function __construct()
	{
		parent::__construct();
		$this->Goods_BaseModel = new Goods_BaseModel();
	}

	
	/**
	 * 增加
	 * @param unknown $field_row
	 * @param unknown $return_insert_id
	 */
	public function addPriceGoods($field_row, $return_insert_id)
	{
	    return $this->add($field_row, $return_insert_id);
	}
	
	/**
	 * 删除
	 * @param unknown $field_row
	 */
	public function removePriceGoods($Price_goods_id)
	{
	    $rs_row = array();
		$del_flag = $this->remove($Price_goods_id);
		check_rs($del_flag, $rs_row);

		return is_ok($rs_row);
	}
	
	
	public function getPriceGoodsList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
	    $goods_rows   = array();
	    $goods_id_row = array();
	    $rows = $this->listByWhere($cond_row, $order_row, $page, $rows);
	    
	    
	    return $rows;
	}
	
	public function getPriceGoods($cond_row = array(), $order_row = array())
	{
	    $rows         = $this->getByWhere($cond_row, $order_row);
	    return $rows;
	}
	
	public function getPriceGoodsByWhere($cond_row)
	{
	    $goods_model = new Goods_CommonModel();
	    
	    $rows = $this->getByWhere($cond_row);
	    //获取商品原价
	    foreach ($rows as $key => $val){
	        $goods = $goods_model -> getOneByWhere(array('common_id'=>$val['goods_id']));
	        $rows[$key]['old_price'] = $goods['common_price'];
	    }
	    
	    return $rows;
	}
	
	/**
	 * 根据套餐id 获取套餐下商品个数
	 * @param unknown $Price_id
	 * @return number
	 */
	public function getCount($Price_id)
	{
	    $cond_row['Price_id'] = $Price_id;
	    return $this->getNum($cond_row);
	}
	


}