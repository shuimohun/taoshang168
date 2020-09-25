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
class Fu_QuotaModel extends Fu_Quota
{
    /**
     * 获取套餐列表
     *
     * @param array $cond_row
     * @param array $order_row
     * @param int $page
     * @param int $rows
     * @return array
     */
	public function getFuQuotaList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
		return $this->listByWhere($cond_row, $order_row, $page, $rows);
	}

	/**
	 *根据店铺ID获取店铺新人优惠活动套餐
	 * @param $shop_id 店铺id
	 * @return array
	 */
	public function getFuQuotaByShopID($shop_id)
	{
		return $this->getOneByWhere(array('shop_id' => $shop_id));
	}

	/**
	 * 检查套餐状态
	 * @param 店铺id $shop_id
	 * @return boolean
	 */
	public function checkQuotaStateByShopId($shop_id)
	{
		$cond_row['shop_id']          = $shop_id;
		$cond_row['quota_endtime:>='] = get_date_time();
		$row                          = $this->getOneByWhere($cond_row);
		if (!empty($row))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	/**
	 * 删除套餐
	 * @param $quota_id
	 * @return bool
	 */
	public function removeFuQuota($quota_id)
	{
		$del_flag = $this->remove($quota_id);

		return $del_flag;
	}

    /**
     * 购买套餐
     *
     * @param $field_row
     * @param $return_insert_id
     * @return bool
     */
	public function addFuQuota($field_row, $return_insert_id)
	{
		return $this->add($field_row, $return_insert_id);
	}

	/**
	 * 套餐续费
	 * @param unknown $quota_id
	 * @param unknown $field_row
	 * @return boolean
	 */
	public function renewFuQuota($quota_id, $field_row)
	{
		return $this->edit($quota_id, $field_row);
	}

    public function editFuQuota($quota_id,$field_row)
    {
        return $this->edit($quota_id,$field_row);
	}
}