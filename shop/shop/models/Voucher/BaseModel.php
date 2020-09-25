<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Voucher_BaseModel extends Voucher_Base
{
	const UNUSED  = 1;   //未使用
	const USED    = 2;     //已使用
	const EXPIRED = 3;  //过期
	const RECOVER = 4;  //收回

	public static $voucherState = array(
		self::UNUSED => "未用",
		self::USED => "已用",
		self::EXPIRED => "过期",
		self::RECOVER => "收回"
	);

	/**
	 * 读取分页列表
	 *
	 * @param  int $config_key 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getVoucherList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
		$data = $this->listByWhere($cond_row, $order_row, $page, $rows);
        $expire_row = array();
		foreach ($data["items"] as $key => $value)
		{
			$data["items"][$key]["voucher_state_label"] = _(self::$voucherState[$value["voucher_state"]]);

            if (strtotime($value['voucher_end_date']) < time())
            {
                $data['items'][$key]['voucher_state']        = self::EXPIRED;
                $data['items'][$key]['voucher_state_label'] = _(self::$voucherState[self::EXPIRED]);
                $expire_row[]                                   = $value['voucher_id'];
            }
		}

        $this->editVoucher($expire_row, array('voucher_state'=>self::EXPIRED));

		return $data;
	}

	//获取用户所有的代金券数量
	public function getAllVoucherCountByUserId($user_id)
	{
		$cond_row['voucher_owner_id'] = $user_id;
		return count($this->getByWhere($cond_row));
	}

	//获取用户可用的代金券数量
	public function getAvaVoucherCountByUserId($user_id)
	{
		$cond_row['voucher_owner_id']      = $user_id;
		$cond_row['voucher_start_date:<='] = get_date_time();
		$cond_row['voucher_end_date:>=']   = get_date_time();
		$cond_row['voucher_state']         = self::UNUSED;
		return $this->getNum($cond_row);
	}

	public function getVoucherNumByWhere($cond_row)
	{
		return count($this->getByWhere($cond_row));
	}

    /**
     * 读取列表
     *
     * @param array $cond_row
     * @param array $order_row
     * @param int $page
     * @param int $rows
     * @return array
     */
	public function getConfigList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
		return $this->getByWhere($cond_row, $order_row, $page, $rows);
	}

    /**
     * 获取用户可使用的店铺代金券
     *
     * @param $user_id
     * @param $shop_id
     * @param $order_price
     * @return array
     */
	public function getUserOrderVoucherByWhere($user_id, $shop_id, $order_price)
	{
		$cond_row                       = array();
		$cond_row['voucher_owner_id']   = $user_id;
		$cond_row['voucher_shop_id']    = $shop_id;
		$cond_row['voucher_state']      = self::UNUSED;
		$cond_row['voucher_limit:<=']   = $order_price;
        $cond_row['voucher_end_date:>'] = get_date_time();
		$order_row['voucher_price']     = 'ASC';
		$rows                           = $this->getByWhere($cond_row, $order_row);
		//原方法-取所有状态正常的代金券 再判断日期 如果过期修改状态
        //为了速度 改成直接取日期正确的  过期的在计划任务.用户查看代金券时修改 Zhenzh 20171122
		/*if ($rows)
		{
			$expire_voucher = array();
			foreach ($rows as $key => $value)
			{
				if (strtotime($value['voucher_end_date']) < time())
				{
                    //过期的代金券
					$expire_voucher[] = $value['voucher_id'];
					unset($rows[$key]);
				}
			}
			if($expire_voucher)
            {
                $this->editVoucher($expire_voucher, array('voucher_state' => self::EXPIRED));
            }
		}*/
		return $rows;
	}

	//代金券使用后，更改状态
	public function changeVoucherState($voucher_id, $order_id)
	{
		$rs_row = array();

		$field_row['voucher_order_id'] = $order_id;
		$field_row['voucher_state']    = Voucher_BaseModel::USED;
		$update_flag                   = $this->editVoucher($voucher_id, $field_row);
		check_rs($update_flag, $rs_row);

		$voucher_row = $this->getOne($voucher_id);

		if ($voucher_row) //更新代金券模板中代金券已使用数量
		{
			$Voucher_TempModel = new Voucher_TempModel();
			$edit_flag         = $Voucher_TempModel->editVoucherTemplate($voucher_row['voucher_t_id'], array('voucher_t_used' => 1), true);
			check_rs($edit_flag, $rs_row);
		}

		return is_ok($rs_row);
	}

	/**
	 * 读数量
	 *
	 * @param  int $config_key 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getCount($cond_row = array())
	{
		return $this->getNum($cond_row);
	}

}

?>