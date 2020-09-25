<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * User: zzh
 * Date: 2017/02/16
 * Time: 17:25
 */
class Bundling_BaseModel extends Bundling_Base
{
	const NORMAL = 1;//开启
	const END    = 2;//关闭
	const CANCEL = 3;//管理员关闭
	public static $state_array_map = array(
		self::NORMAL => '开启',
		self::END => '关闭',
		self::CANCEL => '管理员关闭'
	);

	public $Bundling_GoodsModel = null;

	public function __construct()
	{
		parent::__construct();

		$this->Bundling_GoodsModel = new Bundling_GoodsModel();
	}
	
	//增
	public function addBundlingActivity($field_row, $return_insert_id)
	{
	    return $this->add($field_row, $return_insert_id);
	}
	
	//删
	public function removeBundlingActItem($bundling_id)
	{
	    $rs_row = array();
	    
	    //删除活动下的商品
	    $bundling_goods_id_row = $this->Bundling_GoodsModel->getKeyByWhere(array('bundling_id' => $bundling_id));
	
	    if($bundling_goods_id_row)
	    {
	        $flag = $this->Bundling_GoodsModel->removeBundlingGoods($bundling_goods_id_row);
	        check_rs($flag, $rs_row);
	    }
	
	    //删除活动
	    $del_flag = $this->remove($bundling_id);
	    check_rs($del_flag, $rs_row);
	
	    return is_ok($rs_row);
	}
	
	//改
	public function editBundlingActInfo($bundling_id, $field_row)
	{
	    $update_flag = $this->edit($bundling_id, $field_row);
	
	    return $update_flag;
	}
	
	public function getBundlingActList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
		$data_rows = $this->listByWhere($cond_row, $order_row, $page, $rows);
		foreach ($data_rows['items'] as $key => $value)
		{
		    $data_rows['items'][$key]['bundling_state_label'] = _(self::$state_array_map[$value['bundling_state']]);
		    $data_rows['items'][$key]['count'] = $this->Bundling_GoodsModel->getCount($value['bundling_id']);
		}
		return $data_rows;
	}

	//获取商品的组合套餐以及商品详情(至多50个套餐)   weidp
	public function getBundlingValidGoods($cond_row = array(),$order_row = array(),$page=1,$rows=50)
    {

        $Shop_BaseModel = new Shop_BaseModel();
        $Goods_BaseModle = new Goods_BaseModel();

        //取没有过期的套餐
        $cond_row['bundling_state'] = self::NORMAL;
        $data_rows = $this->listByWhere($cond_row,$order_row,$page,$rows);
        foreach($data_rows['items'] as $key=>$value)
        {
            $spare = 0;
            $data_rows['items'][$key]['bundling_state_label'] = _(self::$state_array_map[$value['bundling_state']]);
            $data_rows['items'][$key]['count'] = $this->Bundling_GoodsModel->getCount($value['bundling_id']);
            $shop = $Shop_BaseModel->getOne($value['shop_id']);
            $value['shop_name'] = $shop['shop_name'];
            $Bundling_Goods = array_merge($this->Bundling_GoodsModel->getBundlingGoods(array('bundling_id'=>$value['bundling_id'])));

            foreach($Bundling_Goods as $k=>$v)
            {

                $arr = $Goods_BaseModle->checkGoods($v['goods_id']);
                $data_rows['items'][$key]['goods_share_price'] += $arr['goods_base']['goods_share_price'];
                $data_rows['items'][$key]['goods_promotion_price'] += $arr['goods_base']['goods_promotion_price'];
                $Bundling_Goods[$k]['goods_base'] = $arr['goods_base'];
                $spare += ($arr['goods_base']['goods_price'] - $v['bundling_goods_price']);

            }

            $data_rows['items'][$key]['goods_id'] = $v['goods_id'];
            $data_rows['items'][$key]['spare'] = $spare;
			$data_rows['items'][$key]['totalPrice'] = $spare+$data_rows['items'][$key]['bundling_discount_price'];
            $data_rows['items'][$key]['bundling_good'] = $Bundling_Goods;
            unset($spare);
        }

        $data = $data_rows['items'];

        return $data;
    }

	public function getBundlingByWhere($cond_row)
	{
	    $data_rows = $this->getByWhere($cond_row);
	    foreach ($data_rows['items'] as $key => $value)
	    {
	        $data_rows['items'][$key]['bundling_state_label'] = _(self::$state_array_map[$value['bundling_state']]);
	    }
	    return $data_rows;
	}

	public function getBundlingActItemById($bundling_id)
	{
		$row = $this->getOne($bundling_id);
		$row['bundling_state_label'] = _(self::$state_array_map[$row['bundling_state']]);
		return $row;
	}

	public function getBundlingActInfo($cond_row)
	{
		$row = $this->getOneByWhere($cond_row);
		if ($row)
		{
			$row['bundling_state_label'] = _(self::$state_array_map[$row['bundling_state']]);
		}
		return $row;
	}

    /**
     * 获取套餐及其下商品详细信息和分享信息 Zhenzh
     * @param $cond_row
     * @return array
     */
    public function getBundlingDetailInfo($cond_row)
    {
        $row = $this->getOneByWhere($cond_row);
        if($row)
        {
            $bundlingGoodsModel = new Bundling_GoodsModel();
            $bundling_goods_data = $bundlingGoodsModel->getBundlingGoodsByWhere(array('bundling_id'=>$row['bundling_id']));

            if($bundling_goods_data)
            {
                foreach ($bundling_goods_data as $key=>$value)
                {
                    if(!$value['status'])
                    {
                        $this->editBundlingActInfo($value['bundling_id'],array('bundling_state'=>Bundling_BaseModel::END));
                        return null;
                    }
                }
                $row['goods_list'] = array_values($bundling_goods_data);
                $row['old_total_price'] = array_sum(array_column($bundling_goods_data,'goods_price'));
                $row['old_total_price'] = number_format($row['old_total_price'],2,'.','');
                $goods_stock_data = array_column($bundling_goods_data,'goods_stock');
                $row['goods_stock'] = $goods_stock_data[array_search(min($goods_stock_data),$goods_stock_data)];

                $shareBaseModel = new Share_BaseModel();
                $share_info = $shareBaseModel->getShareByBId($row['bundling_id']);
                if($share_info)
                {
                    $row['share_info'] = $share_info;
                }
            }
            else
            {
                //套装下没有商品或商品不正常
                $this->edit($row['bundling_id'],array('bundling_state'=>Bundling_BaseModel::END));
                return null;
            }
        }

        return $row;
    }



	//除计划任务和管理员取消活动外，其它地方请勿调用
	//更改活动状态为不可用，针对活动到期或管理员关闭
	public function changeBundlingStateUnnormal($bundling_id, $field_row)
	{
		$rs_row = array();

		if(is_array($bundling_id))
		{
			$cond_row['bundling_id'] = $bundling_id;
		}
		else
		{
			$cond_row['bundling_id'] = $bundling_id;
		}

		//活动下的商品
		$bundling_goods_id_row = $this->Bundling_GoodsModel->getKeyByWhere($cond_row);

		$flag = $this->Bundling_GoodsModel->changeBundlingGoodsUnnormal($bundling_goods_id_row);
		check_rs($flag, $rs_row);

		//更改活动状态
		$update_flag = $this->edit($bundling_id, $field_row);
		check_rs($update_flag, $rs_row);

		return is_ok($rs_row);

	}
}