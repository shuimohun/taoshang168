<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/20
 * Time: 15:44
 */
class Increase_BaseModel extends Increase_Base
{

	const NORMAL   = 1;
	const FINISHED = 2;
	const CLOSED   = 3;

	public static $increases_state_map = array(
		self::NORMAL => '正常',
		self::FINISHED => '已结束',
		self::CLOSED => '管理员关闭',
	);

	public $Increase_GoodsModel       = null;
	public $Increase_RedempGoodsModel = null;
	public $Increase_RuleModel        = null;
	public $Goods_BaseModel           = null;
    public $goodsCommonModel           = null;
    public $Share_PriceModel          = null;
	public function __construct()
	{
		parent::__construct();
		$this->Increase_GoodsModel       = new Increase_GoodsModel();
		$this->Increase_RedempGoodsModel = new Increase_RedempGoodsModel();
		$this->Increase_RuleModel        = new Increase_RuleModel();
		$this->Goods_BaseModel           = new Goods_BaseModel();
		$this->goodsCommonModel          = new Goods_CommonModel();
		$this->Share_PriceModel          = new Share_PriceModel();
	}

    /**
     * 加价购活动列表
     *
     * @param array $cond_row
     * @param array $order_row
     * @param int $page
     * @param int $rows
     * @return array
     */
	public function getIncreaseActList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
		$rs_rows = $this->listByWhere($cond_row, $order_row, $page, $rows);

		$expire_increase = array();
		foreach ($rs_rows['items'] as $key => $value)
		{
            $rs_rows['items'][$key]['increase_state_label'] = _(self::$increases_state_map[$value['increase_state']]);

			if (strtotime($value['increase_end_time']) < time()) //过期活动，更改状态
			{
                $rs_rows['items'][$key]['increase_state']       = self::FINISHED;
                $rs_rows['items'][$key]['increase_state_label'] = _(self::$increases_state_map[self::FINISHED]);
				$expire_increase[]                           = $value['increase_id'];
			}
		}

		if($expire_increase)
        {
            $this->editIncrease($expire_increase, array('increase_state' => self::FINISHED));
        }

		return $rs_rows;
	}

    /**
     * 活动详情信息,活动下的商品、规则、换购商品
     * @author Zhenzh
     * @param $increase_id
     * @return array
     */
    public function getIncreaseDetail($increase_id)
    {
        $row = $this->getOne($increase_id);
        $cond_row['increase_id'] = $increase_id;

        //参加加价购的商品
        $row['goods'] = $this->Increase_GoodsModel->getIncreaseGoodsByWhere($cond_row, array('increase_goods_id' => 'ASC'));
        if ($row['goods'])
        {
            //参加活动的所有商品goods_id
            $increase_goods_rows = array_column($row['goods'],'goods_id');
            //根据参加活动的商品goods_id 查询goods_base表
            $goods_base_rows = $this->Goods_BaseModel->get($increase_goods_rows);
            foreach ($row['goods'] as $key => $value)
            {
                //参加活动的goods_id 是否包含在取出的goods_base表中
                if (in_array($value['goods_id'], array_keys($goods_base_rows)))
                {
                    $row['goods'][$key] = $goods_base_rows[$value['goods_id']];
                    $row['goods'][$key]['share_sum_price'] = $goods_base_rows[$value['goods_id']]['goods_share_price'];
                    if($goods_base_rows[$value['goods_id']]['goods_is_promotion'])
                    {
                        $row['goods'][$key]['share_sum_price'] += $goods_base_rows[$value['goods_id']]['goods_promotion_price'];
                    }
                }
                else
                {
                    //不在 商品已不存在 准备删除该活动下的此商品
                    unset($row['goods'][$key]);
                    $delete_increase_goods[] = $value['increase_goods_id'];
                }
            }

            if ($delete_increase_goods)
            {
                $row['goods'] = array_values($row['goods']);
                $this->Increase_GoodsModel->removeIncreaseGoods($delete_increase_goods);
            }
        }

        //加价购的规则
        $row['rule'] = $this->Increase_RuleModel->getIncreaseRuleByWhere($cond_row, array('rule_price' => 'ASC'));
        if($row['rule'])
        {
            //活动下的换购商品
            $redemption_goods = $this->Increase_RedempGoodsModel->getIncreaseRedempGoodsByWhere($cond_row, array('redemp_price' => 'ASC'));
            if ($redemption_goods)
            {
                $refer_red_goods_id = array_column($redemption_goods,'goods_id');
                $refer_red_goods_rows = $this->Goods_BaseModel->get($refer_red_goods_id);//活动下所有换购商品信息
                $redemption_goods_row = array();
                foreach ($redemption_goods as $key => $value)
                {
                    if (in_array($value['goods_id'], array_keys($refer_red_goods_rows)))
                    {
                        $redemption_goods_row[$value['rule_id']][$key]                    = $value;
                        $redemption_goods_row[$value['rule_id']][$key]['goods_name']      = $refer_red_goods_rows[$value['goods_id']]['goods_name'];
                        $redemption_goods_row[$value['rule_id']][$key]['goods_price']     = $refer_red_goods_rows[$value['goods_id']]['goods_price'];
                        $redemption_goods_row[$value['rule_id']][$key]['goods_image']     = $refer_red_goods_rows[$value['goods_id']]['goods_image'];
                        $redemption_goods_row[$value['rule_id']][$key]['goods_stock']     = $refer_red_goods_rows[$value['goods_id']]['goods_stock'];
                        $redemption_goods_row[$value['rule_id']][$key]['share_sum_price'] = $refer_red_goods_rows[$value['goods_id']]['goods_share_price'];

                        if($refer_red_goods_rows[$value['goods_id']]['goods_is_promotion'])
                        {
                            $redemption_goods_row[$value['rule_id']][$key]['share_sum_price'] += $refer_red_goods_rows[$value['goods_id']]['goods_promotion_price'];
                        }
                    }
                    else
                    {
                        //换购商品 不存在
                        $delete_increase__redemp_goods[] = $value['redemp_goods_id'];
                    }
                }

                //换购商品 不存在 删除
                if($delete_increase__redemp_goods)
                {
                    $this->Increase_RedempGoodsModel->removeIncreaseRedempGoods($delete_increase__redemp_goods);
                }
            }

            foreach ($row['rule'] as $key => $value)
            {
                if (in_array($value['rule_id'], array_keys($redemption_goods_row)))
                {
                    $row['rule'][$key]['redemption_goods'] = $redemption_goods_row[$value['rule_id']];
                }
                else
                {
                    unset($row['rule'][$key]);
                }
            }
        }

        return $row;
    }

	//方法更改  weidp
	/*活动详情信息,活动下的商品、规则、换购商品*/
	public function getIncreaseActDetail($increase_id,$type)
	{
		$cond_row['increase_id'] = $increase_id;
		$row          = $this->getOne($increase_id);

		if($type=='five'){
            $row['goods'] = array_merge($this->Increase_GoodsModel->getIncreaseGoodsLists($cond_row, array('increase_goods_id' => 'ASC'),1,5));
        }else{
            $row['goods'] = array_merge($this->Increase_GoodsModel->getIncreaseGoodsByWhere($cond_row, array('increase_goods_id' => 'ASC')));
        }

		if ($row['goods'])
		{
			$increase_goods_rows   = array(); //参加活动的所有商品goods_id
			$delete_increase_goods = array();
            //添加字段是否收藏
            $favorites = new User_FavoritesGoodsModel();
            $User_FavoritesGoodsModel = new User_FavoritesGoodsModel();
            $increase_goods_rows = array_column($row['goods'],'goods_id');
            $common_ids = array_column($row['goods'],'common_id');

			$goods_rows = $this->Goods_BaseModel->get($increase_goods_rows);
            $goods_common_rows = $this->goodsCommonModel->getNormalStateGoodsCommon($common_ids);

            if(perm::checkUserPerm())
            {
                $user_id = perm::$userId;
                $favorites_base = $favorites->listByWhere(array('user_id'=>$user_id));
                $favorites_goods_id = array_column($favorites_base['items'],'goods_id');
            }

			foreach ($row['goods'] as $key => $value)
			{

                if (in_array($value['goods_id'], array_keys($goods_rows)))
				{
					$row['goods'][$key] = $goods_rows[$value['goods_id']];
				}
				else
				{
					unset($row['goods'][$key]);
					$delete_increase_goods[] = $value['increase_goods_id'];
				}

                if (in_array($value['common_id'], array_keys($goods_common_rows)))
                {
                    $row['goods'][$key]['is_jia']       = $goods_common_rows[$value['common_id']]['common_is_jia'];
                    $row['goods'][$key]['promotion_type']       = $goods_common_rows[$value['common_id']]['common_promotion_type'];
                }

                if(in_array($value['goods_id'],$favorites_goods_id))
                {
                    $row['goods'][$key]['is_favorite'] = 1;
                }
                else
                {
                    $row['goods'][$key]['is_favorite'] = 0;
                }

                $share = $this->Share_PriceModel->isShare($value['common_id'],$user_id);

				if($share)
				{
				    $row['goods'][$key]['is_share'] = 1;
                }
                else
                {
                    $row['goods'][$key]['is_share'] = 0;
                }

                $fg['goods_id'] = $value['goods_id'];
                $fg['user_id'] = Perm::$userId;;
                $order_row = array();
                //查询user_id    goods_id收藏
                $res = $User_FavoritesGoodsModel->listByWhere($fg, $order_row);

                if (!empty($res['items'])) {
                    foreach ($res['items'] as $ks => $va) {
                        //sc_xx收藏数据
                        $arr = $va;
                        if ($arr) {
                            //收藏状态1
                            $row['goods'][$key]['pl_status'] = 1;
                        }
                    }
                } else {
                    //收藏状态0
                    $row['goods'][$key]['pl_status'] = 0;
                }

            }

			if ($delete_increase_goods)
			{
				$row['goods'] = array_values($row['goods']);
				$this->Increase_GoodsModel->removeIncreaseGoods($delete_increase_goods);
			}

			$row['rule'] = array_merge($this->Increase_RuleModel->getIncreaseRuleByWhere($cond_row, array('rule_price' => 'ASC')));

			if ($row['rule'])
			{
				//活动下的换购商品
				$redemption_goods = $this->Increase_RedempGoodsModel->getIncreaseRedempGoodsByWhere($cond_row, array('redemp_price' => 'ASC'));

				if ($redemption_goods)
				{
					$refer_red_goods_id = array_column($redemption_goods,'goods_id');
					$refer_red_goods_rows = $this->Goods_BaseModel->get($refer_red_goods_id);//活动下所有换购商品信息
					$redemption_goods_row = array();
					foreach ($redemption_goods as $key => $value)
					{
						if (in_array($value['goods_id'], array_keys($refer_red_goods_rows)))
						{
							$redemption_goods_row[$value['rule_id']][$key]                = $value;
							$redemption_goods_row[$value['rule_id']][$key]['goods_name']  = $refer_red_goods_rows[$value['goods_id']]['goods_name'];
							$redemption_goods_row[$value['rule_id']][$key]['goods_price'] = $refer_red_goods_rows[$value['goods_id']]['goods_price'];
							$redemption_goods_row[$value['rule_id']][$key]['goods_image'] = $refer_red_goods_rows[$value['goods_id']]['goods_image'];
							$redemption_goods_row[$value['rule_id']][$key]['goods_id']    = $refer_red_goods_rows[$value['goods_id']]['goods_id'];
						}
					}
				}

                foreach($redemption_goods_row as $key=>$value)
                {
                    $redemption_goods_row[$key] = array_merge($value);
                }

				foreach ($row['rule'] as $key => $value)
				{
					if (in_array($value['rule_id'], array_keys($redemption_goods_row)))
					{
						foreach ($redemption_goods_row[$value['rule_id']] as $k => $vv)
						{
							$row['rule'][$key]['redemption_goods'][$k]['redemp_goods_id'] = $vv['redemp_goods_id'];
							$row['rule'][$key]['redemption_goods'][$k]['redemp_price']    = $vv['redemp_price'];
							$row['rule'][$key]['redemption_goods'][$k]['goods_name']      = $vv['goods_name'];
							$row['rule'][$key]['redemption_goods'][$k]['goods_price']     = $vv['goods_price'];
							$row['rule'][$key]['redemption_goods'][$k]['goods_image']     = $vv['goods_image'];
							$row['rule'][$key]['redemption_goods'][$k]['goods_id']        = $vv['goods_id'];
						}
					}
					else
					{
						unset($row['rule'][$key]);
					}
				}

			}
			$row['rule'] = array_values($row['rule']);
		}
		return $row;
	}

    //此方法专门针对加一购
    public function getPlusOneDetail($increase_id,$plus = null,$cond = array())
    {
        $row                     = array();
        $cond_row['increase_id'] = $increase_id;

        $row          = $this->getByWhere($cond_row);

      foreach($row as $key=>$value)
      {
          $row[$key]['goods'] = array_merge($this->Increase_GoodsModel->getIncreaseGoodsByWhere(array('increase_id'=>$key), array('increase_goods_id' =>'ASC')));

          if ($row[$key]['goods'])
          {
              $increase_goods_rows   = array(); //参加活动的所有商品goods_id
              $delete_increase_goods = array();
              /*foreach ($row['goods'] as $key => $value)
              {
                  $increase_goods_rows[] = $value['goods_id'];
              }*/
              $increase_goods_rows = array_merge(array_column($row[$key]['goods'],'goods_id'));
              $common_ids = array_merge(array_column($row[$key]['goods'],'common_id'));
              if($cond)
              {
                  $goods_rows = $this->Goods_BaseModel->getByWhere(array('goods_id'=>$increase_goods_rows,'cat_id'=>$cond),array('goods_salenum'=>'DESC'));
                  $goods_common_rows = $this->goodsCommonModel->getNormalStateGoodsCommon($common_ids,array('common_salenum'=>'DESC'),array('cat_id'=>$cond));
              }
              else
              {
                  $goods_rows = $this->Goods_BaseModel->getByWhere(array('goods_id'=>$increase_goods_rows),array('goods_salenum'=>'DESC'));
                  $goods_common_rows = $this->goodsCommonModel->getNormalStateGoodsCommon($common_ids,array('common_salenum'=>'DESC'));
              }

              if(count($goods_rows) == count($row[$key]['goods']))
              {
                   foreach ($row[$key]['goods'] as $k => $v)
                   {
                       if (in_array($v['goods_id'], array_keys($goods_rows)))
                       {
                           $row[$key]['goods'][$k] = $goods_rows[$v['goods_id']];
                       }
                       else
                       {
                           unset($row[$key]['goods'][$k]);
                           $delete_increase_goods[] = $v['increase_goods_id'];
                       }

                       if (in_array($v['common_id'], array_keys($goods_common_rows)))
                       {
                           $row[$key]['goods'][$k]['shared_price'] = $goods_common_rows[$v['common_id']]['shared_price'];
                       }
                   }


                   if ($delete_increase_goods)
                   {
                       $row[$key]['goods'] = array_values($row[$key]['goods']);
                       $this->Increase_GoodsModel->removeIncreaseGoods($delete_increase_goods);
                   }
           }
           else
           {
               $row[$key]['goods'] = null;
           }

              //默认取一条规则
              $row[$key]['rule'] = array_slice($this->Increase_RuleModel->getIncreaseRuleByWhere(array('increase_id'=>$key), array('rule_price' => 'ASC')),0,1);

              if ($row[$key]['rule'])
              {
                  //活动下的换购商品
                  if($plus)
                  {
                      $redemption_goods = $this->Increase_RedempGoodsModel->getIncreaseRedempGoodsByWhere(array('increase_id'=>$key,'redemp_price'=>$plus));

                  }
                  else
                  {
                      $redemption_goods = $this->Increase_RedempGoodsModel->getIncreaseRedempGoodsByWhere(array('increase_id'=>$key), array('redemp_price' => 'DESC'));

                  }

                  if ($redemption_goods)
                  {
                      $refer_red_goods_id = array();
                      foreach ($redemption_goods as $k => $v)
                      {
                          $refer_red_goods_id[] = $v['goods_id'];
                      }
                      $refer_red_goods_rows = $this->Goods_BaseModel->get($refer_red_goods_id);//活动下所有换购商品信息

                      $refer_common_ids = array_column($refer_red_goods_rows,'common_id');
                      $refer_common_rows = $this->goodsCommonModel->getNormalStateGoodsCommon($refer_common_ids);

                      $redemption_goods_row = array();
                      foreach ($redemption_goods as $k => $v)
                      {
                          if (in_array($v['goods_id'], array_keys($refer_red_goods_rows)))
                          {
                              $redemption_goods_row[$v['rule_id']][$k]                = $v;
                              $redemption_goods_row[$v['rule_id']][$k]['goods_name']  = $refer_red_goods_rows[$v['goods_id']]['goods_name'];
                              $redemption_goods_row[$v['rule_id']][$k]['goods_price'] = $refer_red_goods_rows[$v['goods_id']]['goods_price'];
                              $redemption_goods_row[$v['rule_id']][$k]['goods_image'] = $refer_red_goods_rows[$v['goods_id']]['goods_image'];
                              $redemption_goods_row[$v['rule_id']][$k]['goods_id']    = $refer_red_goods_rows[$v['goods_id']]['goods_id'];

                              if (in_array($refer_red_goods_rows[$v['goods_id']]['common_id'], array_keys($refer_common_rows)))
                              {
                                  $redemption_goods_row[$v['rule_id']][$k]['shared_price'] = $refer_common_rows[$refer_red_goods_rows[$v['goods_id']]['common_id']]['shared_price'];
                              }
                          }
                      }

                  }

                  foreach ($row[$key]['rule'] as $k => $v)
                  {
                      if (in_array($v['rule_id'], array_keys($redemption_goods_row)))
                      {
                          foreach ($redemption_goods_row[$v['rule_id']] as $kk => $vv)
                          {
                              $row[$key]['rule'][$k]['redemption_goods'][$kk]['redemp_goods_id'] = $vv['redemp_goods_id'];
                              $row[$key]['rule'][$k]['redemption_goods'][$kk]['redemp_price']    = $vv['redemp_price'];
                              $row[$key]['rule'][$k]['redemption_goods'][$kk]['goods_name']      = $vv['goods_name'];
                              $row[$key]['rule'][$k]['redemption_goods'][$kk]['goods_price']     = $vv['goods_price'];
                              $row[$key]['rule'][$k]['redemption_goods'][$kk]['goods_image']     = $vv['goods_image'];
                              $row[$key]['rule'][$k]['redemption_goods'][$kk]['goods_id']        = $vv['goods_id'];
                              $row[$key]['rule'][$k]['redemption_goods'][$kk]['shared_price']        = $vv['shared_price'];
                          }
                      }
                      else
                      {
                          unset($row[$key]['rule'][$k]);
                      }
                  }
              }

              $row[$key]['rule'] = array_values($row[$key]['rule']);
          }
      }

        return $row;
    }

	public function getIncreaseByWhere($cond_row, $order_row = array())
	{
		$rows = $this->getByWhere($cond_row, $order_row);
		return $rows;
	}

	public function getValidIncreaseByWhere($cond_row,$order_row = array())
    {
        $cond_row['increase_state'] = self::NORMAL;

        $rows = $this->getByWhere($cond_row, $order_row);

        foreach($rows as $key=>$value)
        {
            if(time()>strtotime($value['increase_start_time']) && time()<strtotime($value['increase_end_time']))
            {
                $data[] = $value;
            }
        }

        if(!$data)
        {
            $data = array();
        }
        return $data;
    }

	public function getIncreaseActItem($increase_id)
	{
		return $this->getOne($increase_id);
	}

	public function addIncreaseActItem($field_row, $return_flag = true)
	{
		return $this->add($field_row, $return_flag);
	}

    /**
     * 删除加价购活动
     * 关联删除，活动，活动下的规则，规则下的换购商品
     *
     * @param $increase_id
     * @return array
     */
	public function removeIncreaseActItem($increase_id)
	{
		$rs_row                   = array();
		$Increase_goods_id        = $this->Increase_GoodsModel->getKeyByWhere(array('increase_id' => $increase_id));
		$Increase_rules_id        = $this->Increase_RuleModel->getKeyByWhere(array('increase_id' => $increase_id));
		$Increase_redemp_goods_id = $this->Increase_RedempGoodsModel->getKeyByWhere(array('increase_id' => $increase_id));

		//1、删除活动下的商品
		if ($Increase_goods_id)
		{
			$flag1 = $this->Increase_GoodsModel->removeIncreaseGoods($Increase_goods_id);
			check_rs($flag1, $rs_row);
		}

		//2、删除活动下的规则
		if ($Increase_rules_id)
		{
			$flag2 = $this->Increase_RuleModel->removeIncreaseRuleItem($Increase_rules_id);
			check_rs($flag2, $rs_row);
		}

		//3、删除活动下的换购商品
		if ($Increase_redemp_goods_id)
		{
			$flag3 = $this->Increase_RedempGoodsModel->removeIncreaseRedempGoods($Increase_redemp_goods_id);
			check_rs($flag3, $rs_row);
		}

		//4、删除活动 删除活动本身
		$del_flag = $this->remove($increase_id);
		check_rs($del_flag, $rs_row);

		return is_ok($rs_row);
	}

	/* 编辑活动*/
	public function editIncrease($increase_id, $field_row)
	{
		return $this->edit($increase_id, $field_row);
	}

	//编辑活动和活动下的商品状态，更改为不可用状态，针对活动到期，管理员关闭活动操作
	//需要根据条件对goods_common 表中common_id 是否参加加价购活动字段进行更改
    //其它地方更新加价购状态时请勿调用该方法
	public function editIncreaseUnnormal($increase_id, $field_row)
	{
		$rs_row = array();

		if(is_array($increase_id))
		{
			$cond_row['increase_id:IN'] = $increase_id;
		}
		else
		{
			$cond_row['increase_id'] = $increase_id;
		}

		$increase_goods_id_row = $this->Increase_GoodsModel->getKeyByWhere($cond_row);

		$update_flag1 = $this->Increase_GoodsModel->changeIncreaseGoodsUnnormal($increase_goods_id_row);
		check_rs($update_flag1, $rs_row);

		//更改活动状态
        $update_flag2 =  $this->edit($increase_id, $field_row);
		check_rs($update_flag2, $rs_row);

		return is_ok($rs_row);
	}

}