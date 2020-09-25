<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Shop_CompanyClassModel extends Shop_CompanyClass
{

//    public  static  $shop_license_type = array(
//        "0"=>"无",
//        "1"=>"普通执照",
//        "2"=>"多证合一营业执照（统一社会信用代码）",
//        "3"=>"多证合一营业执照（非统一社会信用代码）"
//    );

	/**
	 * 读取店铺经营类目
	 *
	 * @param  int $config_key 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getCompanyClassrow($table_primary_key_value = null, $key_row = null, $order_row = array())
	{
		$data =  $this->get($table_primary_key_value, $key_row, $order_row);
	}


	/**
	 * 根据多个条件取得
	 *
	 * @param  array $cond_row
	 * @return array $rows 信息
	 * @access public
	 */
	public function getCompanyClassWhere($cond_row = array(), $order_row = array())
	{
		return $this->getByWhere($cond_row, $order_row);
	}

	/**
	 * 获取分页信息
	 *
	 * @param  array $cond_row
	 * @return array $rows 信息
	 * @access public
	 */
	public function listCompanyClassWhere($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{

		return $this->listByWhere($cond_row, $order_row, $page, $rows);

	}

}

?>