<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     WenQingTeng
 */
class Base_AppLicenceDomainModel extends Base_AppLicenceDomain
{

	/**
	 * 读取分页列表
	 *
	 * @param  int $licence_domain 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getAppLicenceDomainList($cond_row = array(), $order_row = array(), $page=1, $rows=100)
	{
		return $this->listByWhere($cond_row, $order_row, $page, $rows);
	}
}
?>