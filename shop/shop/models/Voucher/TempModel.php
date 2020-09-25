<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Voucher_TempModel extends Voucher_Temp
{
	const VALID   = 1;//有效
	const INVALID = 2;//失效

	const GETBYPOINTS = 1;//金蛋兑换
	const GETFBYPWD   = 2;//卡密
	const GETFREE     = 3;//免费领取

	const UNRECOMMEND = 0; //不推荐
	const RECOMMEND   = 1;  //推荐


	//代金券模板状态
	public static $voucher_state_map = array(
		self::VALID => '有效',
		self::INVALID => '失效'
	);
	//代金券获取方式
	public static $voucher_access_method_map = array(
		self::GETBYPOINTS => '金蛋兑换',
		self::GETFREE => '免费领取'
	);//2=>'卡密兑换'保留
	//代金券推荐状态
	public static $voucher_recommend_map = array(
		self::UNRECOMMEND => '否',
		self::RECOMMEND => '是'
	);



	public function getVoucherTempList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
	    $VoucherBaseModel = new Voucher_BaseModel();
	    $GoodsBaseModel  = new Goods_BaseModel();
	    $GoodsCommonModel = new Goods_CommonModel();
		$rows = $this->listByWhere($cond_row, $order_row, $page, $rows);
		$Shop_ClassModel = new Shop_ClassModel();
		$shop_cat_row    = $Shop_ClassModel->getClassWhere();

		$expire_row = array();
		foreach ($rows['items'] as $key => $value)
		{
			$rows['items'][$key]['voucher_t_state_label']         = _(self::$voucher_state_map[$value['voucher_t_state']]);
			$rows['items'][$key]['voucher_t_access_method_label'] = _(self::$voucher_access_method_map[$value['voucher_t_access_method']]);
			$rows['items'][$key]['voucher_t_recommend_label']     = _(self::$voucher_recommend_map[$value['voucher_t_recommend']]);
			$rows['items'][$key]['voucher_t_end_date_day']        = date('Y-m-d', strtotime($value['voucher_t_end_date']));
			//免费兑换显示百分比
			if($value['voucher_t_access_method'] == 3){
                $rows['items'][$key]['voucher_t_percent']         = floor(($value['voucher_t_giveout']/$value['voucher_t_total'])*100);
                $rows['items'][$key]['is_percent'] = 1;
            }else{
                $rows['items'][$key]['is_percent'] = 0;
            }

            if(Perm::checkUserPerm()){
                $V_t_base = $VoucherBaseModel->getOneByWhere(array('voucher_owner_id'=>Perm::$userId,'voucher_t_id'=>$value['voucher_t_id']));
                if($V_t_base){
                    if($V_t_base['voucher_state'] == 1){
                        //字段为1  未使用该代金券
                        $rows['items'][$key]['voucher_t_unused'] = 1;
                        if($value['voucher_t_wap_show_goods']){
                            $v_goodsid = explode(',',$value['voucher_t_wap_show_goods']);
                            foreach($v_goodsid as $kk=>$vv){
                                $v_base = $GoodsBaseModel->checkGoodsII($vv);
                                if($v_base){
                                    $rows['items'][$key]['goodslist'][] = $v_base['goods_base'];
                                }
                            }
                        }else{
                            $common_base = $GoodsCommonModel->getCommonNormalList(array('shop_id'=>$value['shop_id']),array('common_salenum'=>'DESC'),1,3);
                            if($common_base['items']){
                                foreach($common_base['items'] as $ks=>$vs){
                                   $id= $GoodsCommonModel->getNormalStateGoodsId($vs['common_id']);
                                   $rows['items'][$key]['goodslist'][] = $GoodsBaseModel->getOne($id);
                                }
                            }else{
                                $rows['items'][$key]['goodslist'] = null;
                            }
                        }
                    }else{
                        $rows['items'][$key]['voucher_t_unused'] = 0;
                    }
                    $rows['items'][$key]['is_vouver'] = 1;
                }
            }

			if (in_array($value['shop_class_id'], array_keys($shop_cat_row)))
			{
				$rows['items'][$key]['voucher_t_cat_name'] = $shop_cat_row[$value['shop_class_id']]['shop_class_name'];
			}
			else
			{
				$rows['items'][$key]['voucher_t_cat_name'] = '';
			}
			if (strtotime($value['voucher_t_end_date']) < time())
			{
				$rows['items'][$key]['voucher_t_state']       = self::INVALID;
				$rows['items'][$key]['voucher_t_state_label'] = _(self::$voucher_state_map[self::INVALID]);
				$expire_row[]                                 = $value['voucher_t_id'];
			}

		}

		$field_row['voucher_t_state'] = self::INVALID;
		$this->editVoucherTemp($expire_row, $field_row);

		return $rows;
	}

    //根据主键获取代金券模板详细信息
    public function getVoucherTempInfoById($voucher_t_id)
    {
        $row = $this->getOne($voucher_t_id);
        if ($row)
        {
            $row['voucher_t_access_method_label'] = _(self::$voucher_access_method_map[$row['voucher_t_access_method']]);
            $row['voucher_t_state_label']         = _(self::$voucher_state_map[$row['voucher_t_state']]);
            $row['voucher_t_recommend_label']     = _(self::$voucher_recommend_map[$row['voucher_t_recommend']]);

            if($row['shop_class_id'])
            {
                $Shop_ClassModel = new Shop_ClassModel();
                $shop_cat_row    = $Shop_ClassModel->getOne($row['shop_class_id']);
                $row['voucher_t_cat_name'] = $shop_cat_row['shop_class_name'];
            }
            else
            {
                $row['voucher_t_cat_name'] = '';
            }
        }
        return $row;
    }

    //多条件获取代金券模板的详细信息
	public function getVoucherTempInfoByWhere($cond_row)
	{
		$row = $this->getOneByWhere($cond_row);
		if ($row)
		{
			$row['voucher_t_access_method_label'] = _(self::$voucher_access_method_map[$row['voucher_t_access_method']]);
			$row['voucher_t_state_label']         = _(self::$voucher_state_map[$row['voucher_t_state']]);
			$row['voucher_t_recommend_label']     = _(self::$voucher_recommend_map[$row['voucher_t_recommend']]);
		}
		return $row;
	}

	/**
	 * 插入
	 * @param array $field_row_row 插入数据信息
	 * @param bool $return_insert_id 是否返回inset id
	 * @param array $field_row_row 信息
	 * @return bool  是否成功
	 * @access public
	 */
	public function addVoucherTemp($field_row, $return_insert_id)
	{
		$add_flag = $this->add($field_row, $return_insert_id);

		return $add_flag;
	}

	public function removeVoucherTemp($voucher_t_id)
	{
		return $this->remove($voucher_t_id);
	}

	public function editVoucherTemp($voucher_t_id, $field_row)
	{
		$update_flag = $this->edit($voucher_t_id, $field_row);

		return $update_flag;
	}

	public function editVoucherTemplate($voucher_t_id, $field_row, $flag)
	{
		$update_flag = $this->edit($voucher_t_id, $field_row, $flag);
		return $update_flag;
	}
	
	public function getVoucherTempNumByWhere($cond_row)
	{
		return $this->getNum($cond_row);
	}

	public function  get_select($field,$cond_row){
        $res =  $this->select($field,$cond_row);
        return $res[0]['voucher_t_points'];
    }

}

?>