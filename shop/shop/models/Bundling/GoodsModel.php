<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * User: zzh
 * Date: 2017/02/16
 * Time: 17:25
 */
class Bundling_GoodsModel extends Bundling_Goods
{
	const NORMAL = 1;       //活动正常
	const END    = 2;       //活动结束
	const CANCEL = 3;       //活动取消

	public $goodsBaseModel = null;

	public function __construct()
	{
		parent::__construct();
		$this->goodsBaseModel = new Goods_BaseModel();
	}

	
	/**
	 * 增加
	 */
	public function addBundlingGoods($field_row, $return_insert_id)
	{
	    return $this->add($field_row, $return_insert_id);
	}
	
	/**
	 * 删除
	 */
	public function removeBundlingGoods($bundling_goods_id)
	{
		$del_flag = $this->remove($bundling_goods_id);
		return $del_flag;
	}

	public function getBundlingGoodsList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
	    $rows = $this->listByWhere($cond_row, $order_row, $page, $rows);
	    return $rows;
	}

    public function getBundlingGoodsDetailList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        $rows = $this->listByWhere($cond_row, $order_row, $page, $rows);
        if($rows)
        {
            //套餐中商品goods_ids
            $goods_ids = array_column($rows['items'],'goods_id');
            //根据goods_ids获取正常状态的商品的goods_base
            $goods_base_data = $this->goodsBaseModel -> getByWhere(array('goods_id:IN'=>$goods_ids));
            //正常状态的商品goods_ids
            $goods_normal_ids = array_keys($goods_base_data);
            foreach ($rows['items'] as $key => $value)
            {
                if(in_array($value['goods_id'],$goods_normal_ids))
                {
                    $rows['items'][$key]['status']                = 1;
                    $rows['items'][$key]['common_id']             = $goods_base_data[$value['goods_id']]['common_id'];
                    $rows['items'][$key]['goods_name']            = $goods_base_data[$value['goods_id']]['goods_name'];
                    $rows['items'][$key]['goods_price']           = $goods_base_data[$value['goods_id']]['goods_price'];
                    $rows['items'][$key]['goods_stock']           = $goods_base_data[$value['goods_id']]['goods_stock'];
                    $rows['items'][$key]['goods_image']           = $goods_base_data[$value['goods_id']]['goods_image'];
                    $rows['items'][$key]['goods_share_price']     = $goods_base_data[$value['goods_id']]['goods_share_price'];
                    $rows['items'][$key]['goods_is_promotion']    = $goods_base_data[$value['goods_id']]['goods_is_promotion'];
                    $rows['items'][$key]['goods_promotion_price'] = $goods_base_data[$value['goods_id']]['goods_promotion_price'];
                    $rows['items'][$key]['goods_is_shelves']      = $goods_base_data[$value['goods_id']]['goods_is_shelves'];
                    $rows['items'][$key]['goods_stock']           = $goods_base_data[$value['goods_id']]['goods_stock'];
                }
                else
                {
                    $rows['items'][$key]['status']                = 0;
                }
            }
        }
        return $rows;
    }
	
	public function getBundlingGoods($cond_row = array(), $order_row = array())
	{
	    $rows = $this->getByWhere($cond_row, $order_row);
	    return $rows;
	}

    /**
     * 获取套餐商品信息 Zhenzh
     * @param $cond_row
     * @return array
     */
	public function getBundlingGoodsByWhere($cond_row)
	{
	    $rows = $this->getByWhere($cond_row);

	    if($rows)
        {
            //套餐中商品goods_ids
            $goods_ids = array_column($rows,'goods_id');
            //根据goods_ids获取正常状态的商品的goods_base
            $goods_base_data = $this->goodsBaseModel -> getByWhere(array('goods_id:IN'=>$goods_ids,'goods_is_shelves'=>Goods_BaseModel::GOODS_UP,'goods_stock:>'=>0));
            //正常状态的商品goods_ids
            $goods_normal_ids = array_keys($goods_base_data);
            foreach ($rows as $key => $value)
            {
                if(in_array($value['goods_id'],$goods_normal_ids))
                {
                    $rows[$key]['status']                = 1;
                    $rows[$key]['common_id']             = $goods_base_data[$value['goods_id']]['common_id'];
                    $rows[$key]['goods_name']            = $goods_base_data[$value['goods_id']]['goods_name'];
                    $rows[$key]['goods_price']           = $goods_base_data[$value['goods_id']]['goods_price'];
                    $rows[$key]['goods_stock']           = $goods_base_data[$value['goods_id']]['goods_stock'];
                    $rows[$key]['goods_image']           = $goods_base_data[$value['goods_id']]['goods_image'];
                    $rows[$key]['goods_share_price']     = $goods_base_data[$value['goods_id']]['goods_share_price'];
                    $rows[$key]['goods_is_promotion']    = $goods_base_data[$value['goods_id']]['goods_is_promotion'];
                    $rows[$key]['goods_promotion_price'] = $goods_base_data[$value['goods_id']]['goods_promotion_price'];
                    $rows[$key]['share_sum_price']       = $goods_base_data[$value['goods_id']]['goods_share_price'];
                    if($rows[$key]['goods_is_promotion'])
                    {
                        $rows[$key]['share_sum_price']  += $rows[$key]['goods_promotion_price'];
                    }
                }
                else
                {
                    $rows[$key]['status'] = 0;
                }
            }
        }
	    
	    return $rows;
	}
	
	/**
	 * 根据套餐id 获取套餐下商品个数
	 * @param unknown $bundling_id
	 * @return number
	 */
	public function getCount($bundling_id)
	{
	    $cond_row['bundling_id'] = $bundling_id;
	    return $this->getNum($cond_row);
	}
	


}