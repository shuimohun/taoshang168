<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Goods_RecommendModel extends Goods_Recommend
{

	/**
	 * 读取分页列表
	 *
	 * @param  int $goods_recommend_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getRecommendList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
		return $this->listByWhere($cond_row, $order_row, $page, $rows);
	}
	
	public function getRccommonGoodsInfo($cond_row = array(), $order_row = array())
	{
		$recommon_row = $this->getOneByWhere($cond_row, $order_row);
		if (!$recommon_row)
		{
			return array();
		}
		$common_ids = $recommon_row['common_id'];

		//获取商品common的信息
		$Goods_CommonModel               = new Goods_CommonModel();
		$common_cond_row['common_id:IN'] = $common_ids;
		$common_rows                     = $Goods_CommonModel->getByWhere($common_cond_row);

		$Goods_BaseModel = new Goods_BaseModel();

		$goods_cond_row['common_id:IN']     = $common_ids;
		$goods_cond_row['goods_is_shelves'] = Goods_BaseModel::GOODS_UP;

		$goods_rows = $Goods_BaseModel->getByWhere($goods_cond_row);

		foreach ($goods_rows as $key => $goods_row)
		{
			if ($goods_row && isset($common_rows[$goods_row['common_id']]))
			{
				$common_rows[$goods_row['common_id']]["goods_id"] = $goods_row['goods_id'];
				$common_rows[$goods_row['common_id']]["good"][]   = $goods_row;
				//判断该商品是否是自己的商品
				if ($goods_row['shop_id'] == Perm::$shopId)
				{
					$common_rows[$goods_row['common_id']]["shop_owner"] = 1;
				}
				else
				{
					$common_rows[$goods_row['common_id']]["shop_owner"] = 0;
				}
			}
			else
			{
				//错误数据,干掉吧
				//$common_rows[$goods_row['common_id']]["goods_id"] = 0;
			}
		}

		return $common_rows;
	}

	//获取推荐商品及商品信息 Zhenzh 20180421
	public function getRecommendGoods($cond_row = array(), $order_row = array(),$com_cond_row = array())
    {
        $data = array();
        $row  = $this->getOneByWhere($cond_row, $order_row);

        if($row)
        {
            //获取商品common的信息
            $Goods_CommonModel = new Goods_CommonModel();
            $com_cond_row['common_id:IN'] = $row['common_id'];
            $data = $Goods_CommonModel->getByWhere($com_cond_row);
            $data = $Goods_CommonModel->getRecommendRow($data);
        }

        return $data;
    }
}

?>