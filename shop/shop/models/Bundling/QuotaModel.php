<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * User: zzh
 * Date: 2017/02/16
 * Time: 17:25
 */
class Bundling_QuotaModel extends Bundling_Quota
{
    const NORMAL = 1;       //活动正常
    const END    = 2;        //活动结束
    const CANCEL = 3;       //活动取消
    public static $state_array_map = array(
        self::NORMAL => '正常',
        self::END => '已结束',
        self::CANCEL => '管理员关闭'
    );
    
	public function getBundlingQuotaList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
		return $this->listByWhere($cond_row, $order_row, $page, $rows);
	}
	
	public function getBundlingQuotabyWhere($cond_row, $order_row, $page, $rows)
	{
	    $row = $this->listByWhere($cond_row, $order_row, $page, $rows);
	    if ($row['items'])
	    {
	        foreach ($row['items'] as $key => $val)
	        {
	            $row['items'][$key]['bundling_state_label'] = _(self::$state_array_map[$val['bundling_state']]);
	        }
	    }
	    return $row;
	}

	/**
	 *根据店铺ID获取店铺折扣套餐
	 * @param $shop_id 店铺id
	 * @return array
	 */
	public function getBundlingQuotaByShopID($shop_id)
	{
		return $this->getOneByWhere(array('shop_id' => $shop_id));
	}

	/*检查套餐状态*/
	public function checkQuotaStateByShopId($shop_id)
	{
		$row                           = array();
		$cond_row['shop_id']           = $shop_id;
		$cond_row['bundling_quota_endtime:>='] = date('Y-m-d H:i:s');
		$row                           = $this->getOneByWhere($cond_row);

		if (!empty($row))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function removeBundlingQuotaItem($bl_quota_id)
	{
		$del_flag = $this->remove($bl_quota_id);

		return $del_flag;
	}

	/*
	 * 购买套餐
	 * */
	public function addBundlingQuota($field_row, $return_insert_id)
	{
		return $this->add($field_row, $return_insert_id);
	}

	/*
	 * 套餐续费
	 * */
	public function renewBundlingQuota($bl_quota_id, $field_row)
	{
		return $this->edit($bl_quota_id, $field_row);
	}
}