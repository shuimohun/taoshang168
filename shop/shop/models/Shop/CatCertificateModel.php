<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Shop_CatCertificateModel extends Shop_CatCertificate
{

	/**
	 * 读取分页列表
	 *
	 * @param  int $cat_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getCatCertificateList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
		return $this->listByWhere($cond_row, $order_row, $page, $rows);
	}
	
	public function getCatCertificateInfo($cat_id)
	{
		$row = $this->getOne($cat_id);
		if (!$row)
		{
			return array();
		}

		$certificate_ids = $row['certificate_id'];

        $ShopCertificateModel = new Shop_CertificateModel();
        $shop_certificate_rows = $ShopCertificateModel->getByWhere(array('id:IN'=>$certificate_ids));

        if($shop_certificate_rows)
        {
            $row['shop_certificate'] = $shop_certificate_rows;
        }

		return $row;
	}

    public function getShopCatCertificate($cat_ids)
    {
        $data = array();
        if($cat_ids)
        {
            $GoodsCatModel = new Goods_CatModel();

            //集合 存放所有分类id
            $all_cat_ids = array();
            if($cat_ids)
            {
                foreach ($cat_ids as $val)
                {
                    $cat_parent = $GoodsCatModel->getCatParent($val);
                    $data['cat'][$val]     = $cat_parent;
                    $cat_list = $GoodsCatModel->getOne($val);
                    $data['cat'][$val][]   = $cat_list;

                    $all_cat_ids[] = $val;
                    $all_cat_ids = array_merge($all_cat_ids,array_column($cat_parent,'cat_id'));
                }
            }

            if($all_cat_ids)
            {
                //分类id去重
                $all_cat_ids = array_unique($all_cat_ids);
                $data['cer'] = $this->getShopCatCertificateII($all_cat_ids);
            }
        }

        return $data;
    }


    public function getShopCatCertificateII($all_cat_ids)
    {
        $data = array();

        if($all_cat_ids)
        {
            $ShopCertificateModel = new Shop_CertificateModel();

            //根据分类id获取 类目所需证件
            $shop_cat_cer = $this->getCatCertificate($all_cat_ids);

            //集合 存放所有证件id
            $cer_ids = array();
            if($shop_cat_cer)
            {
                foreach ($shop_cat_cer as $key=>$val)
                {
                    $cer_ids = array_merge($cer_ids,$val['certificate_id']);
                }
            }

            //证件id去重
            $cer_ids = array_unique($cer_ids);

            $data = $ShopCertificateModel->getCertificate($cer_ids,array('display_order'=>'asc'));
        }

        return $data;
    }
}

?>