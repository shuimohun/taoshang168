<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * Created by PhpStorm.
 * User: Zhenzh
 * Date: 2017/5/20
 * Time: 15:44
 */
class ScareBuy_QuotaModel extends ScareBuy_Quota
{
	/*获取惠抢购套餐列表*/
	public function getScareBuyQuotaList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
		return $this->listByWhere($cond_row, $order_row, $page, $rows);
	}

	/**
	 *根据店铺ID获取店铺惠抢购活动套餐
	 * @param $shop_id 店铺id
	 * @return array
	 */
	public function getScareBuyQuotaByShopID($shop_id)
	{
		return $this->getOneByWhere(array('shop_id' => $shop_id));
	}

	/*检查套餐状态*/
	public function checkQuotaStateByShopId($shop_id)
	{
		$row                          = array();
		$cond_row['shop_id']          = $shop_id;
		$cond_row['combo_endtime:>='] = get_date_time();
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
	/*删除惠抢购套餐*/
	/**
	 * @param $combo_id
	 * @return bool
	 */
	public function removeScareBuyQuota($combo_id)
	{
		$del_flag = $this->remove($combo_id);

		return $del_flag;
	}
	
	/*
	* 购买套餐
	* */
	public function addScareBuyCombo($field_row, $return_insert_id)
	{
		return $this->add($field_row, $return_insert_id);
	}

	/*
	 * 套餐续费
	 * */
	public function renewScareBuyCombo($combo_id, $field_row)
	{
		return $this->edit($combo_id, $field_row);
	}
}