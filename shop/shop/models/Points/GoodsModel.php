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
class Points_GoodsModel extends Points_Goods
{
	const ONSHELVES  = 1;    //上架
	const OFFSHELVES = 0;    //下架(手动下架，库存为0，活动到期导致)
	
	const RECOMMEND   = 1;    //推荐
	const UNRECOMMEND = 0;  //未推荐

	const ISNUMLIMIT = 1; //有兑换数量限制
	const NONUMLIMIT = 0; //没有兑换数量限制

	const ISTLIMIT = 1;        //有兑换时间限制
	const NOTLIMIT = 0;        //没有兑换时间限制

	const WILLSTART   = -1;   //即将开始
	const ONEXCHANGE  = 1;       //兑换中
	const ENDEXCHANGE = 2;      //兑换结束
	
	//金蛋礼品上架状态，是否上架
	public static $shelves_state_map = array(
		self::ONSHELVES => '是',
		self::OFFSHELVES => '否'
	);
	//金蛋礼品状态
	public static $points_goods_state_map = array(
		0 => '禁售',
		1 => '可售'
	);
	//金蛋礼品是否推荐
	public static $points_goods_recommend_map = array(
		self::UNRECOMMEND => '否',
		self::RECOMMEND => '是'
	);


	public $htmlKey = array(
		'points_goods_body'
	);

	//金蛋礼品列表
	public function getPointsGoodsList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
		$rows = $this->listByWhere($cond_row, $order_row, $page, $rows);

		foreach ($rows['items'] as $key => $value)
		{
			$rows['items'][$key]['points_goods_shelves_label'] = _(self::$shelves_state_map[$value['points_goods_shelves']]);
			//$rows['items'][$key]['points_goods_state_label']         =  _(self::$points_goods_state_map[$value['points_goods_state']]);
			$rows['items'][$key]['points_goods_recommend_label'] = _(self::$points_goods_recommend_map[$value['points_goods_recommend']]);

			if ($value['points_goods_islimittime'] == self::ISTLIMIT)
			{
				
				if (time() < strtotime($value['points_goods_starttime']))
				{
					$rows['items'][$key]['sell_state'] = self::WILLSTART;
				}
				elseif ((strtotime($value['points_goods_endtime']) > time()) && (time() > strtotime($value['points_goods_starttime'])))
				{
					$rows['items'][$key]['sell_state'] = self::ONEXCHANGE;
				}
				elseif (time() >= strtotime($value['points_goods_endtime']))
				{
					$rows['items'][$key]['sell_state']           = self::ENDEXCHANGE;
					$rows['items'][$key]['points_goods_shelves'] = self::OFFSHELVES;
				}
			}
			elseif ($value['points_goods_islimittime'] == self::NOTLIMIT)
			{
				$rows['items'][$key]['sell_state'] = self::ONEXCHANGE;
			}
		}
		foreach($rows['items'] as $key=>$value)
		{
            $sql = "select shop_class_name from ylb_shop_class where shop_class_id = $value[points_goods_type]";
            $arr = $this->sql->getRow($sql);
            $rows['items'][$key]['class_name'] = $arr['shop_class_name'];
        }
		return $rows;
	}

	public function getPointsGoods($points_goods_id)
	{
		$rows = $this->get($points_goods_id);
		foreach ($rows as $key => $value)
		{
			$rows[$key]['points_goods_shelves_label'] = _(self::$shelves_state_map[$value['points_goods_shelves']]);
			//$rows['items'][$key]['points_goods_state_label']         =  _(self::$points_goods_state_map[$value['points_goods_state']]);
			$rows[$key]['points_goods_recommend_label'] = _(self::$points_goods_recommend_map[$value['points_goods_recommend']]);


			if ($value['points_goods_islimittime'] == self::ISTLIMIT)
			{

				if (time() < strtotime($value['points_goods_starttime']))
				{
					$rows[$key]['sell_state'] = self::WILLSTART;
				}
				elseif ((strtotime($value['points_goods_endtime']) > time()) && (time() > strtotime($value['points_goods_starttime'])))
				{
					$rows[$key]['sell_state'] = self::ONEXCHANGE;
				}
				elseif (time() >= strtotime($value['points_goods_endtime']))
				{
					$rows[$key]['sell_state']           = self::ENDEXCHANGE;
					$rows[$key]['points_goods_shelves'] = self::OFFSHELVES;
				}
			}
			elseif ($value['points_goods_islimittime'] == self::NOTLIMIT)
			{
				$rows[$key]['sell_state'] = self::ONEXCHANGE;
			}
		}

		return $rows;
	}

	/**
	 * 金蛋礼品详情
	 * @param $points_goods_id
	 * @return array
	 */
	public function getPointsGoodsByID($points_goods_id)
	{
		$row = $this->getOne($points_goods_id);

		if ($row)
		{
			if ($row['points_goods_islimittime'] == self::ISTLIMIT)
			{
				if (time() < strtotime($row['points_goods_starttime']))
				{
					$row['sell_state'] = self::WILLSTART;
				}
				elseif ((strtotime($row['points_goods_endtime']) > time()) && (time() > strtotime($row['points_goods_starttime'])))
				{
					$row['sell_state'] = self::ONEXCHANGE;
				}
				elseif (time() >= strtotime($row['points_goods_endtime']))
				{
					$row['sell_state']           = self::ENDEXCHANGE;
					$row['points_goods_shelves'] = self::OFFSHELVES;

					$field_row['points_goods_shelves'] = self::OFFSHELVES;
					$this->editPointsGoods($row['points_goods_id'], $field_row, false);
				}
			}
			elseif ($row['points_goods_islimittime'] == self::NOTLIMIT)
			{
				$row['sell_state'] = self::ONEXCHANGE;
			}
		}

		return $row;
	}


	public function getPointsGoodsDetailByWhere($cond_row)
	{
		$row = $this->getOneByWhere($cond_row);
		if ($row)
		{
			if ($row['points_goods_islimittime'] == self::ISTLIMIT)
			{
				if (time() < strtotime($row['points_goods_starttime']))
				{
					$row['sell_state'] = self::WILLSTART;
				}
				elseif ((strtotime($row['points_goods_endtime']) > time()) && (time() > strtotime($row['points_goods_starttime'])))
				{
					$row['sell_state'] = self::ONEXCHANGE;
				}
				elseif (time() >= strtotime($row['points_goods_endtime']))
				{
					$row['sell_state']           = self::ENDEXCHANGE;
					$row['points_goods_shelves'] = self::OFFSHELVES;

					$field_row['points_goods_shelves'] = self::OFFSHELVES;
					$this->editPointsGoods($row['points_goods_id'], $field_row, false);
				}
			}
			elseif ($row['points_goods_islimittime'] == self::NOTLIMIT)
			{
				$row['sell_state'] = self::ONEXCHANGE;
			}
		}

		return $row;
	}

	public function editPointsGoods($points_goods_id, $field_row, $flag = null)
	{
		return $this->edit($points_goods_id, $field_row, $flag);
	}


	public function addPointsGoods($field_row, $flag)
	{
		return $this->add($field_row, $flag);
	}

	/**
	 * 删除金蛋礼品
	 * @param $points_goods_id
	 * @return bool
	 */
	public function removePointsGoods($points_goods_id)
	{
		$del_flag = $this->remove($points_goods_id);

		return $del_flag;
	}

//	/**
//     *综合排序
//     *@param 根据等级金蛋以及搜索
//	 */
	public function seekSort($fid,$uid,$points = null,$grade = null,$low = null,$tall = null,$cond = null)
    {
        $sql = "select user_grade from YLB_user_info where user_id = $uid";
        $arr = $this->sql->getRow($sql);
        $grades = $arr['user_grade'];
        if($points == null && $grade == null)
        {
            if($fid == 0)
            {
                $sql = "select * from YLB_points_goods";
                $data = $this->sql->getAll($sql);
            }
            else
            {
                $sql = "select * from YLB_points_goods where points_goods_type = $fid";
                $data = $this->sql->getAll($sql);
            }
            return $data;
        }

        if($low == null && $tall == null && $cond == null)
        {
            if($points == 'defPoin')
            {

                if($fid == 0)
                {

                    if($grade == 'one')
                    {

                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 1";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'two')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 2";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'three')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 3";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'four')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 4";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'five')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 5";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                }
                else
                {
                    if($grade == 'one')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 1 and points_goods_type = $fid";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'two')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 2 and points_goods_type = $fid";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'three')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 3 and points_goods_type = $fid";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'four')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 4 and points_goods_type = $fid";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'five')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 5 and points_goods_type = $fid";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                }


            }
            else if($points == 'tallPoin')
            {
                if($fid == 0)
                {
                    if($grade == 'one')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 1 order by points_goods_price desc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'two')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 2 order by points_goods_price desc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'three')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 3 order by points_goods_price desc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'four')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 4 order by points_goods_price desc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'five')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 5 order by points_goods_price desc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                }
                else
                {
                    if($grade == 'one')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 1 and points_goods_type = $fid order by points_goods_price desc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'two')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 2 and points_goods_type = $fid order by points_goods_price desc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'three')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 3 and points_goods_type = $fid order by points_goods_price desc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'four')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 4 and points_goods_type = $fid order by points_goods_price desc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'five')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 5 and points_goods_type = $fid order by points_goods_price desc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                }
            }
            else if($points == 'lowPoin')
            {
                if($fid == 0)
                {
                    if($grade == 'one')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 1 order by points_goods_price asc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'two')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 2 order by points_goods_price asc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'three')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 3 order by points_goods_price asc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'four')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 4 order by points_goods_price asc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'five')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 5 order by points_goods_price asc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                }
                else
                {
                    if($grade == 'one')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 1 and points_goods_type = $fid order by points_goods_price asc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'two')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 2 and points_goods_type = $fid order by points_goods_price asc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'three')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 3 and points_goods_type = $fid order by points_goods_price asc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'four')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 4 and points_goods_type = $fid order by points_goods_price asc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'five')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 5 and points_goods_type = $fid order by points_goods_price asc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                }
            }
            else if($points == 'newPoin')
            {
                if($fid == 0)
                {
                    if($grade == 'one')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 1 order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'two')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 2 order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'three')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 3 order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'four')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 4 order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'five')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 5 order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                }
                else
                {
                    if($grade == 'one')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 1 and points_goods_type = $fid order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'two')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 2 and points_goods_type = $fid order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'three')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 3 and points_goods_type = $fid order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'four')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 4 and points_goods_type = $fid order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                    else if($grade == 'five')
                    {
                        $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 5 and points_goods_type = $fid order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                        $data = $this->sql->getAll($sql);
                        return $data;
                    }
                }
            }
        }
        else
        {
            if($cond == '1')
            {
                if($points == 'defPoin')
                {
                    if($fid == 0)
                    {
                        if($grade == 'one')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 1 and points_goods_points >= $low and points_goods_points <= $tall";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'two')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 2 and points_goods_points >= $low and points_goods_points <= $tall";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'three')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 3 and points_goods_points >= $low and points_goods_points <= $tall";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'four')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 4 and points_goods_points >= $low and points_goods_points <= $tall";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'five')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 5 and points_goods_points >= $low and points_goods_points <= $tall";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                    }
                    else
                    {
                        if($grade == 'one')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 1 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'two')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 2 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'three')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 3 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'four')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 4 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'five')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 5 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                    }


                }
                else if($points == 'tallPoin')
                {
                    if($fid == 0)
                    {
                        if($grade == 'one')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 1 and points_goods_points >= $low and points_goods_points <= $tall order by points_goods_price desc ";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'two')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 2 and points_goods_points >= $low and points_goods_points <= $tall order by points_goods_price desc ";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'three')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 3 and points_goods_points >= $low and points_goods_points <= $tall order by points_goods_price desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'four')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 4 and points_goods_points >= $low and points_goods_points <= $tall order by points_goods_price desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'five')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 5 and points_goods_points >= $low and points_goods_points <= $tall order by points_goods_price desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                    }
                    else
                    {
                        if($grade == 'one')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 1 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall order by points_goods_price desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'two')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 2 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall order by points_goods_price desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'three')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 3 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall order by points_goods_price desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'four')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 4 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall order by points_goods_price desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'five')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 5 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall order by points_goods_price desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                    }
                }
                else if($points == 'lowPoin')
                {
                    if($fid == 0)
                    {
                        if($grade == 'one')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 1 and points_goods_points >= $low and points_goods_points <= $tall order by points_goods_price asc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'two')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 2 and points_goods_points >= $low and points_goods_points <= $tall order by points_goods_price asc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'three')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 3 and points_goods_points >= $low and points_goods_points <= $tall order by points_goods_price asc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'four')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 4 and points_goods_points >= $low and points_goods_points <= $tall order by points_goods_price asc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'five')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 5 and points_goods_points >= $low and points_goods_points <= $tall order by points_goods_price asc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                    }
                    else
                    {
                        if($grade == 'one')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 1 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall order by points_goods_price asc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'two')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 2 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall order by points_goods_price asc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'three')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 3 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall order by points_goods_price asc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'four')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 4 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall order by points_goods_price asc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'five')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 5 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall order by points_goods_price asc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                    }
                }
                else if($points == 'newPoin')
                {
                    if($fid == 0)
                    {
                        if($grade == 'one')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 1 and points_goods_points >= $low and points_goods_points <= $tall order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'two')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 2 and points_goods_points >= $low and points_goods_points <= $tall order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'three')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 3 and points_goods_points >= $low and points_goods_points <= $tall order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'four')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 4 and points_goods_points >= $low and points_goods_points <= $tall order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'five')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 5 and points_goods_points >= $low and points_goods_points <= $tall order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                    }
                    else
                    {
                        if($grade == 'one')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 1 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'two')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 2 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'three')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 3 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'four')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 4 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'five')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 5 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                    }
                }
            }
            else if($cond == '2')
            {
                if($points == 'defPoin')
                {
                    if($fid == 0)
                    {
                        if($grade == 'one')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 1 and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'two')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 2 and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'three')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 3 and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'four')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 4 and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'five')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 5 and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                    }
                    else
                    {
                        if($grade == 'one')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 1 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'two')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 2 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'three')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 3 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'four')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 4 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'five')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 5 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                    }


                }
                else if($points == 'tallPoin')
                {
                    if($fid == 0)
                    {
                        if($grade == 'one')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 1 and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by points_goods_price desc ";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'two')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 2 and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by points_goods_price desc ";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'three')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 3 and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by points_goods_price desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'four')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 4 and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by points_goods_price desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'five')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 5 and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by points_goods_price desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                    }
                    else
                    {
                        if($grade == 'one')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 1 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by points_goods_price desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'two')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 2 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by points_goods_price desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'three')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 3 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by points_goods_price desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'four')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 4 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by points_goods_price desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'five')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 5 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by points_goods_price desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                    }
                }
                else if($points == 'lowPoin')
                {
                    if($fid == 0)
                    {
                        if($grade == 'one')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 1 and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by points_goods_price asc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'two')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 2 and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by points_goods_price asc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'three')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 3 and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by points_goods_price asc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'four')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 4 and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by points_goods_price asc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'five')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 5 and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by points_goods_price asc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                    }
                    else
                    {
                        if($grade == 'one')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 1 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by points_goods_price asc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'two')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 2 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by points_goods_price asc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'three')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 3 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by points_goods_price asc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'four')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 4 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by points_goods_price asc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'five')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 5 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by points_goods_price asc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                    }
                }
                else if($points == 'newPoin')
                {
                    if($fid == 0)
                    {
                        if($grade == 'one')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 1 and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'two')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 2 and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'three')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 3 and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'four')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 4 and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'five')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 5 and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                    }
                    else
                    {
                        if($grade == 'one')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 1 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'two')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 2 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'three')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 3 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'four')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 4 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                        else if($grade == 'five')
                        {
                            $sql = "select * from YLB_points_goods where points_goods_limitgrade >= 5 and points_goods_type = $fid and points_goods_points >= $low and points_goods_points <= $tall and points_goods_limitgrade <=$grades order by UNIX_TIMESTAMP(points_goods_add_time) desc";
                            $data = $this->sql->getAll($sql);
                            return $data;
                        }
                    }
                }
            }
        }

    }
}