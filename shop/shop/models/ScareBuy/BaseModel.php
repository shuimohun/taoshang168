<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * Created by PhpStorm.
 * User: Zhenzh
 * Date: 2016/5/20
 * Time: 15:44
 */
class ScareBuy_BaseModel extends ScareBuy_Base
{
	const WILLSTART    = 0; //审核通过，但未到开始时间，即将开始
	const UNDERREVIEW  = 1;  //审核中
	const NORMAL       = 2;  //正常
	const FINISHED     = 3;  //结束
	const AUDITFAILUER = 4; //审核失败
	const CLOSED       = 5; //管理员关闭

    const HOT = 90;//90%热销 即将售罄
    const LOOTALL = 100;//90%热销 即将售罄

	const ONLINEGBY = 1;  //线上团
	const VIRGBY    = 2;  //虚拟团

	const UNRECOMMEND        = 0;   //不推荐
	const RECOMMEND          = 1;   //首页推荐
	const HIGHLYRECOMMEND   = 2;   //大图推荐

	public $Goods_CommonModel = null;
    public $goodsBaseModel = null;

	//惠抢购状态  1.审核中 2.正常 3.结束 4.审核失败 5.管理员关闭
	public static $scarebuy_state_map = array(
        self::WILLSTART => '即将开始',
        self::UNDERREVIEW => '审核中',
        self::NORMAL => '正常',
        self::FINISHED => '结束',
		self::AUDITFAILUER => '审核失败',
		self::CLOSED => '管理员关闭'
	);

	//惠抢购商品推荐状态 0.否 1.是'
	public static $recommend_map = array(
		self::UNRECOMMEND => '否',
		self::RECOMMEND => '首页推荐',
		self::HIGHLYRECOMMEND => '首页大图推荐'
	);

	//惠抢购商品类型 1-实物，2-虚拟商品
	public static $goods_type_map = array(
		self::ONLINEGBY => '实物',//线上团
		self::VIRGBY => '虚拟商品'//虚拟团
	);

	public $htmlKey = array(
		'scarebuy_intro'
	);

	public function __construct()
	{
		parent::__construct();
		$this->Goods_CommonModel = new Goods_CommonModel();
        $this->goodsBaseModel = new Goods_BaseModel();
	}

    /**
     * 获取正常状态的惠抢购 Zhenzh
     *
     * @param $cond_row
     * @return array
     */
    public function getNormalScareBuyByWhere($cond_row)
    {
        $cond_row['scarebuy_state'] = self::NORMAL;
        $cond_row['scarebuy_percent:<'] = ScareBuy_BaseModel::LOOTALL;
        $cond_row['scarebuy_starttime:<'] 	  = get_date_time();
        $cond_row['scarebuy_endtime:>'] 	  = get_date_time();
        $row = $this->getOneByWhere($cond_row);
        return $row;
    }

    /**
     * 获取惠抢购 筛选 Zhenzh
     *
     * @param $cond_row
     * @return array
     */
    public function getScareBuyByWhere($cond_row)
    {
        $cond_row['scarebuy_state'] = self::NORMAL;
        $cond_row['scarebuy_percent:<'] = ScareBuy_BaseModel::LOOTALL;
        //$cond_row['scarebuy_starttime:<'] 	  = get_date_time();
        $row = $this->getOneByWhere($cond_row);
        if($row)
        {
            if ($row['scarebuy_endtime'] < get_date_time())
            {
                $field_row['scarebuy_state'] = self::FINISHED;
                $this->editScareBuy($row['scarebuy_id'], $field_row);
                unset($row);
            }
        }
        return $row;
    }


    /**
     * 获取惠抢购商品
     *
     * @param array $cond_row
     * @param array $order_row
     * @param int $page
     * @param int $rows
     * @return array|int
     */
	public function getScareBuyGoodsList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
		$rows = $this->listByWhere($cond_row, $order_row, $page, $rows);
		if ($rows['items'])
		{
			$expire_scarebuy = array(); //过期的活动
			$delete_scarebuy = array(); //活动下的商品已经被删除

			foreach ($rows['items'] as $key => $value)
			{
				$rows['items'][$key]['scarebuy_recommend_label'] = _(self::$recommend_map[$value['scarebuy_recommend']]);
				$rows['items'][$key]['scarebuy_state_label']     = _(self::$scarebuy_state_map[$value['scarebuy_state']]);
				if (strtotime($value['scarebuy_endtime']) < time() && $value['scarebuy_state'] == self::NORMAL)
				{
					$rows['items'][$key]['scarebuy_state']       = self::FINISHED;
					$rows['items'][$key]['scarebuy_state_label'] = _(self::$scarebuy_state_map[self::FINISHED]);
					$expire_scarebuy[] = $value['scarebuy_id'];
				}
				$scarebuy_goods_ids[] = $value['goods_id'];
			}

			//根据goods_id获取商品信息 标记Zhenzh 是否只取正常状态的商品???
            $goods_base_rows = $this->goodsBaseModel->getGoodsListByGoodId($scarebuy_goods_ids);

            foreach ($rows['items'] as $key => $value)
            {
                if (in_array($value['goods_id'], array_keys($goods_base_rows)))
                {

                    $rows['items'][$key]['goods_name']  = $goods_base_rows[$value['goods_id']]['goods_name'];
                    $rows['items'][$key]['goods_price'] = $goods_base_rows[$value['goods_id']]['goods_price'];
                    $rows['items'][$key]['goods_image'] = $goods_base_rows[$value['goods_id']]['goods_image'];
                    $rows['items'][$key]['reduce']      = $goods_base_rows[$value['goods_id']]['goods_price'] - $value['scarebuy_price'];
                    $rows['items'][$key]['rate']        = sprintf("%.2f", $value['scarebuy_price'] / $goods_base_rows[$value['goods_id']]['goods_price'] * 10);
                    $rows['items'][$key]['sale_rate']   = $value['scarebuy_percent'].'%';
                    $rows['items'][$key]['scare_buy']   = $value['scarebuy_price'] - $goods_base_rows[$value['goods_id']]['goods_share_price'];
                    if($value['scarebuy_percent'] >= self::HOT)
                    {
                        $rows['items'][$key]['hot'] = self::HOT;
                    }
                    if($value['scarebuy_percent'] == self::LOOTALL)
                    {
                        $rows['items'][$key]['hot'] = self::LOOTALL;
                    }
                    $rows['items'][$key]['goods_share_price'] = $goods_base_rows[$value['goods_id']]['goods_share_price'];
                    $rows['items'][$key]['goods_is_promotion'] = $goods_base_rows[$value['goods_id']]['goods_is_promotion'];
                    $rows['items'][$key]['goods_promotion_price'] = $goods_base_rows[$value['goods_id']]['goods_promotion_price'];
                    $rows['items'][$key]['share_sum_price'] = $goods_base_rows[$value['goods_id']]['goods_share_price'];
                    if($rows['items'][$key]['goods_is_promotion'])
                    {
                        $rows['items'][$key]['share_sum_price'] += $goods_base_rows[$value['goods_id']]['goods_promotion_price'];
                    }

                    //活动价大于商品价
                    if($rows['items'][$key]['scarebuy_price'] > $rows['items'][$key]['goods_price'])
                    {
                        $expire_scarebuy[] = $value['scarebuy_id'];
                        $rows['items'][$key]['scarebuy_state'] = self::FINISHED;
                    }

                    if($rows['items'][$key]['scarebuy_price'] > $rows['items'][$key]['goods_share_price'])
                    {
                        $rows['items'][$key]['scarebuy_price'] -= $rows['items'][$key]['goods_share_price'];
                    }
                }
                else
                {
                    $delete_scarebuy[] = $value['scarebuy_id'];
                    unset($rows['items'][$key]);
                }
            }

            //活动到期，更改活动状态
            if($expire_scarebuy)
            {
                $this->editScareBuy($expire_scarebuy, array('scarebuy_state'=>self::FINISHED));
            }

            //删除商品不存在的活动
            if($delete_scarebuy)
            {
                $this->removeScareBuy($delete_scarebuy);
            }
		}

		return $rows;
	}

    public function getTodayScareBuyGoodsList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        $today = date("Y-m-d",time());
        $tomorrow = date("Y-m-d",strtotime("+1 day"));
        $cond_row['scarebuy_state']       = ScareBuy_BaseModel::NORMAL;
        $cond_row['scarebuy_starttime:>=']  = $today;
        $cond_row['scarebuy_starttime:<'] 	  = get_date_time();
        $cond_row['scarebuy_endtime:>'] 	  = get_date_time();
        $cond_row['scarebuy_endtime:<='] 	  = $tomorrow;
        return $this->getScareBuyGoodsList($cond_row,$order_row,$page,$rows);
    }

	//多条件 获取商品惠抢购详情一条
	public function getScareBuyDetailByWhere($cond_row)
	{
		$row = $this->getOneByWhere($cond_row);

		if ($row)
		{
			$row['recommend_label']      = _(self::$recommend_map[$row['scarebuy_recommend']]);
			$row['scarebuy_state_label'] = _(self::$scarebuy_state_map[$row['scarebuy_state']]);

            $goods_base_row = $this->goodsBaseModel->getOneByWhere(array('goods_id' => $row['goods_id']));
            if($goods_base_row)
            {
                $row['goods_name']  = $goods_base_row['goods_name'];
                $row['goods_price'] = $goods_base_row['goods_price'];
                $row['goods_image'] = $goods_base_row['goods_image'];
                $row['reduce']      = $goods_base_row['goods_price'] - $row['scarebuy_price'];
                $row['rate']        = sprintf("%.2f", $row['scarebuy_price'] / $goods_base_row['goods_price'] * 10);
                if ($row['scarebuy_endtime'] < get_date_time() && $row['scarebuy_state'] == self::NORMAL)
                {
                    $row['scarebuy_state']       = self::FINISHED;
                    $row['scarebuy_state_label'] = _(self::$scarebuy_state_map[self::FINISHED]);

                    $field_row['scarebuy_state'] = self::FINISHED;
                    $this->editScareBuy($row['scarebuy_id'], $field_row);
                }

                $row['share_sum_price'] = $goods_base_row['share_total_price'];
                if($goods_base_row['goods_is_promotion'])
                {
                    $row['share_sum_price'] += $goods_base_row['goods_promotion_price'];
                }
            }
            else
            {
                $this->removeScareBuy($row['scarebuy_id']);
                unset($row);
            }
		}
		return $row;
	}

	//根据主键搜索惠抢购详情
	public function getScareBuyDetailByID($scarebuy_id)
	{
		$row = $this->getOne($scarebuy_id);
		if ($row)
		{
			$row['recommend_label']      = _(self::$recommend_map[$row['scarebuy_recommend']]);
			$row['scarebuy_state_label'] = _(self::$scarebuy_state_map[$row['scarebuy_state']]);

            $goods_base_row = $this->goodsBaseModel->getOneByWhere(array('goods_id' => $row['goods_id']));
            if($goods_base_row)
            {
                $row['goods_name']  = $goods_base_row['goods_name'];
                $row['goods_price'] = $goods_base_row['goods_price'];
                $row['goods_image'] = $goods_base_row['goods_image'];
                $row['reduce']      = $goods_base_row['goods_price'] - $row['scarebuy_price'];
                $row['rate']        = sprintf("%.2f", $row['scarebuy_price'] / $goods_base_row['goods_price'] * 10);
                if ($row['scarebuy_endtime'] < get_date_time() && $row['scarebuy_state'] == self::NORMAL)
                {
                    $row['scarebuy_state']       = self::FINISHED;
                    $row['scarebuy_state_label'] = _(self::$scarebuy_state_map[self::FINISHED]);

                    $field_row['scarebuy_state'] = self::FINISHED;
                    $this->editScareBuy($row['scarebuy_id'], $field_row);
                }

                $row['share_sum_price'] = $goods_base_row['share_total_price'];
                if($goods_base_row['goods_is_promotion'])
                {
                    $row['share_sum_price'] += $goods_base_row['goods_promotion_price'];
                }
            }
            else
            {
                $this->removeScareBuy($row['scarebuy_id']);
                unset($row);
            }
		}

		return $row;
	}

	//发布活动
	public function addScareBuy($field_row, $return_insert_flag)
	{
		return $this->add($field_row, $return_insert_flag);
	}

	/**
     * 删除惠抢购商品
     *
	 * @param $scarebuy_id
	 * @return bool
	 */
	public function removeScareBuy($scarebuy_id)
	{
		$del_flag = $this->remove($scarebuy_id);
		return $del_flag;
	}

	/*修改惠抢购信息*/
	public function editScareBuy($scarebuy_id, $field_row, $flag = null)
	{
		$update_flag = $this->edit($scarebuy_id, $field_row, $flag);
		return $update_flag;
	}

    public function test($sql, $page=1, $rows=100, $flag=true)
    {


        $offset = $rows * ($page - 1);
        $this->sql->setLimit($offset, $rows);
        $sql .=$this->sql->getLimit();

        $res = $this->sql->getAll($sql);


        $total = $this->getFoundRows();
        var_dump($total);die;

        $data = array();
        $data['page'] = $page;
        $data['total'] = ceil_r($total / $rows);  //total page
        $data['totalsize'] = $total;
        $data['records'] = $total;

        if ($flag)
        {
            $data['items'] = array_values($res);
        }
        else
        {
            $data['items'] = $res;
        }
        return $data;
    }

    public function getBySql($field, $where = NULL, $group = NULL, $order = NULL, $limit = NULL)
    {
        $fieldtxt = implode(",", $field);
        $wheretxt = "";
        if (!empty($where))
        {
            $wheretxt .= " where 1";
            foreach ($where as $k => $v)
            {
                $arr        = explode(":", $k);
                $fieldwhere = $arr[0];
                $flagwhere  = isset($arr[1]) ? $arr[1] : "=";
                $wheretxt .= " and {$fieldwhere}{$flagwhere}'{$v}'";
            }
        }
        if ($group)
        {
            $wheretxt .= " group by {$group}";
        }
        if (!empty($order))
        {
            $wheretxt .= " order by ";
            $ordertxt = "";
            foreach ($order as $k => $v)
            {
                $ordertxt .= "{$k} {$v},";
            }
            $ordertxt = trim($ordertxt, ",");
            $wheretxt .= $ordertxt;
        }
        if (!empty($limit))
        {
            $limittxt = implode(",", $limit);
            $wheretxt .= " limit {$limittxt}";
        }
        $sql = "select {$fieldtxt} from {$this->_tableName} {$wheretxt}";
        $data = $this->sql->getAll($sql);

        $total = $this->getFoundRows();

        var_dump($total);die;
        return $data;
    }

    //提交订单后 修改惠抢购里的购买数量和进度
    public function editScareBuyCount($goods_id,$num)
    {
        $scarebuy_data = $this->getOneByWhere(array('goods_id'=>$goods_id));
        if($scarebuy_data)
        {
            $field_row['scarebuy_buy_quantity'] = $scarebuy_data['scarebuy_buy_quantity'] + $num;
            $field_row['scarebuy_percent'] = number_format($field_row['scarebuy_buy_quantity']/($scarebuy_data['scarebuy_virtual_quantity']+$scarebuy_data['scarebuy_count']) * 100,'2','.','');
            $this->editScareBuy($scarebuy_data['scarebuy_id'],$field_row,false);
        }
    }

}