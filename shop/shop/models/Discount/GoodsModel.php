<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/15
 * Time: 17:57
 */
class Discount_GoodsModel extends Discount_Goods
{
	const NORMAL = 1;       //活动正常
	const END    = 2;       //活动结束
	const CANCEL = 3;       //活动取消

	const UNRECOMMEND = 0;  //未推荐
	const RECOMMEND   = 1;  //推荐

	public $Goods_BaseModel = null;

	public function __construct()
	{
		parent::__construct();
		$this->Goods_BaseModel = new Goods_BaseModel();
		$this->Goods_CommonModel = new Goods_CommonModel();
	}

    /**
     * 获取正常状态的活动商品 Zhenzh
     *
     * @param $cond_row
     * @return array
     */
    public function getNormalDiscountGoodsByWhere($cond_row)
    {
        $cond_row['discount_goods_state'] = Discount_GoodsModel::NORMAL;
        $cond_row['goods_start_time:<'] = get_date_time();
        $cond_row['goods_end_time:>'] = get_date_time();
        $row = $this->getOneByWhere($cond_row);
        return $row;
    }

    /**
     * 获取活动商品 并判断活动是否正常 过期状态没修改的更新状态 Zhenzh
     *
     * @param $cond_row
     * @return array
     */
    public function getDiscountGoodsByWhere($cond_row)
    {
        $cond_row['discount_goods_state'] = Discount_GoodsModel::NORMAL;
        $cond_row['goods_start_time:<'] = get_date_time();
        $row = $this->getOneByWhere($cond_row);
        if ($row)
        {
            if (strtotime($row['goods_end_time']) < time())
            {
                $row['discount_goods_state'] = self::END;
                $this->editDiscountGoods($row['discount_goods_id'], array('discount_goods_state'=>self::END));
                unset($row);
            }
        }
        return $row;
    }

    //新增方法排序商品表  值针对wap端限时折扣(若用内置order_by排序有问题)
    public function getOrderGoodsList($cond_row = array(),$order_row = array()){
        $cond_row['discount_goods_state'] = Discount_GoodsModel::NORMAL;
        $cond_row['goods_start_time:<'] = get_date_time();
        $cond_row['goods_end_time:>'] = get_date_time();

        $rows = $this->getByWhere($cond_row,$order_row);
        $goods_id_row = array_column($rows,'goods_id');
       if($goods_id_row){
           $ids = trim(implode(',',$goods_id_row),',');
       }

        $sql = "SELECT * FROM ylb_goods_base WHERE goods_id IN ($ids) ORDER BY goods_salenum DESC";
        $goods_rows = $this->selectSql($sql);

        return $goods_rows;

    }

	//限时折扣商品列表，分页
	public function getDiscountGoodsList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100,$goods_order = array())
	{
        $cond_row['discount_goods_state'] = Discount_GoodsModel::NORMAL;
        $cond_row['goods_start_time:<'] = get_date_time();
        $cond_row['goods_end_time:>'] = get_date_time();
		$rows = $this->listByWhere($cond_row, $order_row, $page, $rows);

		if($rows['items'])
        {
            $goods_id_row = array_column($rows['items'],'goods_id');
            $goods_rows = $this->Goods_BaseModel->getGoodsListByGoodId($goods_id_row,array('goods_is_shelves'=>Goods_BaseModel::GOODS_UP),$goods_order);
            foreach ($rows['items'] as $key => $value)
            {
                if($goods_rows[$value['goods_id']])
                {

                    $rows['items'][$key]['goods_name'] = $goods_rows[$value['goods_id']]['goods_name'];
                    $rows['items'][$key]['goods_image'] = $goods_rows[$value['goods_id']]['goods_image'];
                    $rows['items'][$key]['cat_id'] = $goods_rows[$value['goods_id']]['cat_id'];
                    $rows['items'][$key]['goods_stock'] = $goods_rows[$value['goods_id']]['goods_stock'];
                    $rows['items'][$key]['goods_salenum'] = $goods_rows[$value['goods_id']]['goods_salenum'];
                    $rows['items'][$key]['goods_share_price'] = $goods_rows[$value['goods_id']]['goods_share_price'];
                    $rows['items'][$key]['share_sum_price'] = $goods_rows[$value['goods_id']]['goods_share_price'];
                    $rows['items'][$key]['goods_is_promotion'] = $goods_rows[$value['goods_id']]['goods_is_promotion'];
                    $rows['items'][$key]['goods_promotion_price'] = $goods_rows[$value['goods_id']]['goods_promotion_price'];
                    if($goods_rows[$value['goods_id']]['goods_is_promotion'])
                    {
                        $rows['items'][$key]['share_sum_price'] += $goods_rows[$value['goods_id']]['goods_promotion_price'];
                    }
                    $rows['items'][$key]['discount_rate'] = $rows['items'][$key]['discount_rate']*1;
                    $rows['items'][$key]['dis_price'] = $value['discount_price'] - $goods_rows[$value['goods_id']]['goods_share_price'];
                    //活动价大于商品价
                    if($rows['items'][$key]['discount_price'] > $goods_rows[$value['goods_id']]['goods_price'])
                    {
                        $expire_id[] = $value['discount_goods_id'];
                        $rows['items'][$key]['discount_goods_state'] = self::CANCEL;
                    }
                }
                else
                {
                    //商品不存在
                    $expire_id[] = $value['discount_goods_id'];
                    $rows['items'][$key]['discount_goods_state'] = self::CANCEL;
                }
            }
            if($expire_id)
            {
                $this->editDiscountGoods($expire_id, array('discount_goods_state'=>self::CANCEL));
            }
        }

		return $rows;
	}

	//显示折扣商品列表，不分页
	public function getDiscountGoods($cond_row = array(), $order_row = array(),$other = array(),$goods_order = array())
	{
		$goods_id_row = array();
		//判断是否为多字段查询

		$rows = $this->getByWhere($cond_row, $order_row);

		if ($rows)
		{
			foreach ($rows as $key => $value)
			{
				if (strtotime($value['goods_end_time']) < time())
				{
					$rows[$key]['discount_goods_state'] = self::END;

					$field_row['discount_goods_state'] = self::END;
					$this->editDiscountGoods($value['discount_goods_id'], $field_row);
				}
				$goods_id_row[] = $value['goods_id'];
			}
		}

		$goods_rows = $this->Goods_BaseModel->getGoodsListByGoodId($goods_id_row,$other,$goods_order); //活动商品信息

        foreach ($goods_rows as $key=>$value)
        {
            $goods_rows[$key]['share_sum_price'] = $value['goods_share_price'];
            if($value['goods_is_promotion'])
            {
                $goods_rows[$key]['share_sum_price'] += $value['goods_promotion_price'];
            }
        }

		$exception_goods = array();//商品异常信息，即在活动中存在的商品，但是已被卖家删除

        //判断是否有商品查询条件
        if($goods_order)
        {
            foreach($goods_rows as $key=>$value)
            {
                foreach ($rows as $k => $v)
                {
                    if ($key == $rows[$k]['goods_id'])
                    {
                        $goods_rows[$key]['discount_goods_id'] = $rows[$k]['discount_goods_id'];
                        $goods_rows[$key]['discount_id'] = $rows[$k]['discount_id'];
                        $goods_rows[$key]['discount_name'] = $rows[$k]['discount_name'];
                        $goods_rows[$key]['discount_title'] = $rows[$k]['discount_title'];
                        $goods_rows[$key]['discount_explain'] = $rows[$k]['discount_explain'];
                        $goods_rows[$key]['discount_price'] = $rows[$k]['discount_price'];
                        $goods_rows[$key]['goods_start_time'] = $rows[$k]['goods_start_time'];
                        $goods_rows[$key]['goods_end_time'] = $rows[$k]['goods_end_time'];
                        $goods_rows[$key]['goods_lower_limit'] = $rows[$k]['goods_lower_limit'];
                        $goods_rows[$key]['discount_goods_state'] = $rows[$k]['discount_goods_state'];
                        $goods_rows[$key]['discount_goods_recommend'] = $rows[$k]['discount_goods_recommend'];
                        $goods_rows[$key]['discount_rate'] = $rows[$k]['discount_rate'];
                        $goods_rows[$key]['discount_percent'] = sprintf("%.1f", $rows[$k]['discount_price'] / $goods_rows[$key]['goods_price'] * 10);

                        $goods_rows[$key]['share_total_price'] = $goods_rows[$key]['goods_share_price'];

                        $rows[$key]['share_total_price'] = $goods_rows[$value['goods_id']]['share_total_price'];
                        $rows[$key]['shared_price'] = $goods_rows[$value['goods_id']]['shared_price'];
                        $rows[$key]['share_sum_price'] = $goods_rows[$value['goods_id']]['share_sum_price'];
                    }
                }
            }
            $rows = $goods_rows;
        }
        else
        {
            foreach ($rows as $key => $value)
            {
                if ($goods_rows[$value['goods_id']])
                {
                    $rows[$key]['goods_name'] = $goods_rows[$value['goods_id']]['goods_name'];
                    $rows[$key]['goods_price'] = $goods_rows[$value['goods_id']]['goods_price'];
                    $rows[$key]['goods_image'] = $goods_rows[$value['goods_id']]['goods_image'];
                    $rows[$key]['goods_stock'] = $goods_rows[$value['goods_id']]['goods_stock'];
                    $rows[$key]['goods_salenum'] = $goods_rows[$value['goods_id']]['goods_salenum'];
                    $rows[$key]['discount_percent'] = sprintf("%.1f", $rows[$key]['discount_price'] / $goods_rows[$value['goods_id']]['goods_price'] * 10);

                    $rows[$key]['share_total_price'] = $goods_rows[$value['goods_id']]['goods_share_price'];
                    $rows[$key]['shared_price'] = $goods_rows[$value['goods_id']]['goods_shared_price'];
                    $rows[$key]['goods_is_promotion'] = $goods_rows[$value['goods_id']]['goods_is_promotion'];
                    $rows[$key]['goods_promotion_price'] = $goods_rows[$value['goods_id']]['goods_promotion_price'];
                    $rows[$key]['goods_is_promotion'] = $goods_rows[$value['goods_id']]['goods_is_promotion'];
                    $rows[$key]['share_sum_price'] = $rows[$key]['share_total_price'];
                    if ($rows[$key]['goods_is_promotion'])
                    {
                        $rows[$key]['share_sum_price'] += $rows[$key]['goods_promotion_price'];
                    }
                }
                else
                {
                    //商品不存在
                    //$exception_goods[] = $value['discount_goods_id'];
                    unset($rows[$key]);
                    //rows['items'][$key]['discount_goods_state'] = self::CANCEL;
                }
            }
        }

		if ($exception_goods)
		{
			$this->removeDiscountGoods($exception_goods);
		}

		return $rows;
	}

    //多条件获取活动商品详情
	public function getDiscountGoodsDetailByWhere($cond_row)
	{
		$row = $this->getOneByWhere($cond_row);
		if ($row)
		{
			if (strtotime($row['goods_end_time']) < time())
			{
				$row['discount_goods_state'] = self::END;
				$this->editDiscountGoods($row['discount_goods_id'], array('discount_goods_state'=>self::END));
			}
            $goods_base_row = $this->Goods_BaseModel->getOne($row['goods_id']);
            if ($goods_base_row)
            {
                $row['goods_name']       = $goods_base_row['goods_name'];
                $row['goods_price']      = $goods_base_row['goods_price'];
                $row['goods_image']      = $goods_base_row['goods_image'];
                $row['discount_percent'] = sprintf("%.1f", $row['discount_price'] / $goods_base_row['goods_price'] * 10);
            }
            else
            {
                unset($row);
            }
		}
		return $row;
	}

	public function removeDiscountGoods($discount_goods_id)
	{
		$rs_row = array();

        $discount_goods_row = $this->get($discount_goods_id);

		//删除活动商品，先操作
		$del_flag = $this->remove($discount_goods_id);
		check_rs($del_flag, $rs_row);

        $common_id_row = array_column($discount_goods_row, 'common_id');
        if ($common_id_row)
		{
			$need_edit_row = $this->getCommonNormalPromotion($common_id_row);

			if ($need_edit_row)
			{
				$Goods_CommonModel = new Goods_CommonModel();
				$update_flag       = $Goods_CommonModel->editCommon($need_edit_row, array('common_promotion_type'=>Goods_CommonModel::NOPROMOTION));
				check_rs($update_flag, $rs_row);
			}
		}

		return is_ok($rs_row);
	}

	public function getCommonNormalPromotion($common_id)
	{
		if (is_array($common_id))
		{
			$common_id                      = array_unique($common_id);
			$cond_row_goods['common_id:IN'] = $common_id;
		}
		else
		{
			$common_id                   = (array)$common_id;
			$cond_row_goods['common_id'] = $common_id;
		}
		//根据 common_id 获取对应的限时折扣商品
		$discount_goods_rows  = $this->getByWhere($cond_row_goods);
		$no_modify_common_row = array();

		if ($discount_goods_rows)
		{
			$discount_common_id_rows = array();
			foreach ($discount_goods_rows as $key => $value)
			{
				$discount_common_id_rows[$value['common_id']][] = $value['discount_id'];
			}

			$discount_id_row = array_unique(array_column($discount_goods_rows, 'discount_id')); //活动ID

			if ($discount_id_row)
			{
				$Discount_BaseModel               = new Discount_BaseModel();
				$cond_row['discount_id:IN']       = $discount_id_row;
				//$cond_row['discount_state']       = Discount_BaseModel::NORMAL;
				//$cond_row['discount_end_time:>='] = get_date_time();
				$increase_keys_row                = $Discount_BaseModel->getKeyByWhere($cond_row);

				foreach ($discount_common_id_rows as $key => $value)
				{
					if (array_intersect($value, $increase_keys_row))
					{
						$no_modify_common_row[] = $key;
					}
				}
			}
		}

		return array_diff($common_id, $no_modify_common_row);
	}

	public function addDiscountGoods($field_row, $return_insert_id)
	{
		return $this->add($field_row, $return_insert_id);
	}

	/*修改折扣商品部信息*/
	public function editDiscountGoods($discount_goods_id, $field_row)
	{
		$flag = $this->edit($discount_goods_id, $field_row);
		return $flag;
	}


	//除计划任务和管理员取消订单外，其它地方请勿调用
	/*修改折扣商品部信息,common表中活动状态，针对活动到期和和管理员取消*/
	public function changeDiscountGoodsUnnormal($discount_goods_id,$field_row)
	{
		$rs_row = array();
		$discount_goods_row = $this->get($discount_goods_id);
		$common_id_row      = array_column($discount_goods_row, 'common_id');

		if ($common_id_row)
		{
			$need_edit_row = $this->getCommonNormalPromotion($common_id_row);

			if ($need_edit_row)
			{
				$Goods_CommonModel = new Goods_CommonModel();
				$update_flag       = $Goods_CommonModel->editCommon($need_edit_row, array('common_is_xian' => 0));
				check_rs($update_flag, $rs_row);
			}
		}

		return $rs_row;
	}

}