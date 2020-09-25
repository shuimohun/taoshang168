<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Shop_ClassBindModel extends Shop_ClassBind
{
	public static $shop_class_bind_enable = array(
		"1" => "未审核",
		"2" => "已审核"
	);

	const PASS_VERIFY = 2;

	/**
	 * 读取店铺经营类目
	 *
	 * @param  int $config_key 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getClassBindrow($table_primary_key_value = null, $key_row = null, $order_row = array())
	{
		return $this->get($table_primary_key_value, $key_row, $order_row);
	}


	/**
	 * 根据多个条件取得
	 *
	 * @param  array $cond_row
	 * @return array $rows 信息
	 * @access public
	 */
	public function getClassBindWhere($cond_row = array(), $order_row = array())
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
	public function listClassBindWhere($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{

		return $this->listByWhere($cond_row, $order_row, $page, $rows);

	}

	//多条件获取主键
	public function getClassBindId($cond_row = array(), $order_row = array())
	{

		return $this->getKeyByMultiCond($cond_row, $order_row);

	}

	/**
	 * 根据店铺id 获取所有的经营类目名称以及分佣比例
     * 这里是根据分页获取数据 默认100条 不是全部的 全部的方法改为getClassBind Zhenzh 20170112
	 *
	 * @param  array $cond_row
	 * @return array $rows 信息
	 * @access public
	 */
	public function getClassBindlist($shop_id = array(), $order_row = array(), $page = 1, $rows = 100)
	{
        $CatModel = new Goods_CatModel();

        $data             = $this->listClassBindWhere($shop_id, $order_row, $page, $rows);
		$product_class    = array();
		//循环得到商品分类id
		foreach ($data['items'] as $key => $value)
		{
			//根据商品分类ID查询出分类名
			$product_class["shop_class_bind_id"][]        = $value["shop_class_bind_id"];
			$product_class["shop_class_bind_enablecha"][] = _(self::$shop_class_bind_enable[$value['shop_class_bind_enable']]);
			$product_class["commission_rate"][]           = $value["commission_rate"];
			$product_class["shop_class_bind_enable"][]    = $value["shop_class_bind_enable"];
			$product_class["product_parent_name"][]       = $CatModel->getCatParent($value['product_class_id']);
			$product_name[]                               = $CatModel->getOne($value['product_class_id']);
		}

		//循环父类经营类目把子类插进去
		if (!empty($product_class["product_parent_name"]))
		{
			foreach ($product_class["product_parent_name"] as $key => $value)
			{

				$product_class["product_parent_name"][$key][] = $product_name[$key];
			}
		}
		$data['items'] = $product_class;

		return $data;

	}

    /**
     * 根据店铺id 获取所有的经营类目名称以及分佣比例
     * 重写getClassBindlist 获取全部类目 Zhenzh 20170112
     *
     * @param array $cond_row
     * @param array $order_row
     * @return array
     */
    public function getClassBind($cond_row = array(), $order_row = array())
    {
        $data = array();

        $CatModel = new Goods_CatModel();
        $row      = $this->getByWhere($cond_row, $order_row);

        //循环得到商品分类id
        foreach ($row as $key => $value)
        {
            //根据商品分类ID查询出分类名
            $data["shop_class_bind_id"][]        = $value["shop_class_bind_id"];
            $data["shop_class_bind_enablecha"][] = _(self::$shop_class_bind_enable[$value['shop_class_bind_enable']]);
            $data["commission_rate"][]           = $value["commission_rate"];
            $data["shop_class_bind_enable"][]    = $value["shop_class_bind_enable"];
            $data["product_parent_name"][]       = $CatModel->getCatParent($value['product_class_id']);
            $product_name[]                      = $CatModel->getOne($value['product_class_id']);
        }

        //循环父类经营类目把子类插进去
        if (!empty($data["product_parent_name"]))
        {
            foreach ($data["product_parent_name"] as $key => $value)
            {
                $data["product_parent_name"][$key][] = $product_name[$key];
            }
        }

        return $data;

    }

	public function getSubQuantity($cond_row)
	{
		return $this->getNum($cond_row);
	}


}

?>