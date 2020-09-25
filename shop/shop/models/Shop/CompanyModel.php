<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Shop_CompanyModel extends Shop_Company
{

    public  static  $shop_license_type = array(
        "0"=>"普通执照",
        "1"=>"普通执照",
        "2"=>"多证合一营业执照（统一社会信用代码）",
        "3"=>"多证合一营业执照（非统一社会信用代码）"
    );

    public  static  $taxpayer_type = array(
        "1"=>"一般纳税人",
        "2"=>"小规模纳税人",
        "3"=>"非增值税纳税人"
    );

    public  static  $tax_code = array(
        "1"=>"0%",
        "2"=>"11%",
        "3"=>"图书11%免税",
        "4"=>"17%",
        "5"=>"3%",
        "6"=>"6%",
        "7"=>"7%"
    );
    public  static  $band_type = array(
        "1"=>"自营品牌",
        "2"=>"代理品牌"
    );

    public static $shop_manage_title_map = array(
        'company'=>'公司负责人',
        'shop'=>'店铺负责人',
        'operate'=>'运营联系人',
        'service'=>'售后联系人',
    );

    public static $shop_manage_title_mapII = array(
        'shop'=>'店铺负责人',
        'operate'=>'运营联系人',
        'service'=>'售后联系人',
    );

    public static $shop_manage_content_map = array(
        'name'=>'姓名',
        'phone'=>'手机',
        'email'=>'邮箱',
        'qq'=>'QQ',
        'tel'=>'电话',
    );

    public static $band_pro_type = array(
        '0'=>'否',
        '1'=>'是'
    );

	/**
	 * 读取店铺经营类目
	 *
	 * @param  int $config_key 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getCompanyrow($table_primary_key_value = null, $key_row = null, $order_row = array())
	{
		$data =  $this->get($table_primary_key_value, $key_row, $order_row);
        $data[$table_primary_key_value]['shop_license_type_name'] = self::$shop_license_type[$data[$table_primary_key_value]['shop_license_type']];
        $data[$table_primary_key_value]['taxpayer_type_name'] = self::$taxpayer_type[$data[$table_primary_key_value]['taxpayer_type']];
        $data[$table_primary_key_value]['tax_code_name'] = self::$tax_code[$data[$table_primary_key_value]['tax_code']];
        $data[$table_primary_key_value]['band_type_name'] = self::$band_type[$data[$table_primary_key_value]['band_type']];

        $data[$table_primary_key_value]['shop_manage_title_map'] = self::$shop_manage_title_map;
        $data[$table_primary_key_value]['shop_manage_content_map'] = self::$shop_manage_content_map;
        $data[$table_primary_key_value]['band_pro_type_name'] = self::$band_pro_type[$data[$table_primary_key_value]['band_pro_type']];

        return $data;
	}


	/**
	 * 根据多个条件取得
	 *
	 * @param  array $cond_row
	 * @return array $rows 信息
	 * @access public
	 */
	public function getCompanyWhere($cond_row = array(), $order_row = array())
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
	public function listCompanyWhere($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{

		return $this->listByWhere($cond_row, $order_row, $page, $rows);

	}

}

?>