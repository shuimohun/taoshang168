<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * Created by PhpStorm.
 * User: Zhenzh
 * Date: 2016/5/20
 * Time: 15:44
 */
class ScareBuy_CatModel extends ScareBuy_Cat
{
	const PHYSICALCAT = 1;//实物惠抢购分类
	const VIRTUAL     = 2;  //虚拟惠抢购分类
	//惠抢购类型 1-实物，2-虚拟商品 scarebuy_cat_type

	public static $cat_type_map = array(
		self::PHYSICALCAT => '实物',
		self::VIRTUAL => '虚拟商品'
	);

	/*获取惠抢购分类*/
	public function getScareBuyCatList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
		$rows = $this->listByWhere($cond_row, $order_row, $page, $rows);

		foreach ($rows['items'] as $key => $value)
		{
			$rows['items'][$key]['scarebuy_cat_type_label'] = _(self::$cat_type_map[$value['scarebuy_cat_type']]);
			if ($value['scarebuy_cat_parent_id'])
			{
				$rows[$key]['is_leaf'] = false;
			}
			else
			{
				$rows[$key]['is_leaf'] = true;
			}
		}

		return $rows;
	}


	/*获取惠抢购分类列表*/
	public function getCatTree($scarebuy_cat_parent_id = 0, $recursive = true, $level = 0)
	{
		$data_rows = $this->getCatTreeData($scarebuy_cat_parent_id, $recursive, $level);

		$data['items'] = array_values($data_rows);

		return $data;
	}

	public function getScareBuyCatByWhere($cond_row = array(), $order_row = array())
	{
		$rows = $this->getByWhere($cond_row, $order_row);

		foreach ($rows as $key => $value)
		{
            if($value['scarebuy_percent']>=90)
            {
                $rows[$key]['is_hot'] = '1';
            }
			$rows[$key]['scarebuy_cat_type_label'] = _(self::$cat_type_map[$value['scarebuy_cat_type']]);
			if ($value['scarebuy_cat_parent_id'])
			{
				$rows[$key]['is_leaf'] = false;
			}
			else
			{
				$rows[$key]['is_leaf'] = true;
			}
		}
		return $rows;
	}

	public function getScareBuyCatJson($cat_type)
	{
		$cond_row['scarebuy_cat_type'] = $cat_type;
		$order_row['scarebuy_cat_id']  = 'ASC';
		$rows                          = array();
		$cat                           = $this->getScareBuyCatByWhere($cond_row, $order_row);
		if ($cat)
		{
			foreach ($cat as $key => $value)
			{
				$rows['name'][$value['scarebuy_cat_id']]              = $value['scarebuy_cat_name'];
				$rows['children'][$value['scarebuy_cat_parent_id']][] = $value['scarebuy_cat_id'];
				if ($value['scarebuy_cat_parent_id'])
				{
					$rows['parent'][$value['scarebuy_cat_id']] = $value['scarebuy_cat_parent_id'];
				}
				else
				{
					$rows['parent'][$value['scarebuy_cat_id']] = 0;
				}
			}
		}
		return $rows;
	}

	public function getCatName($cat_id = 0, $scat_id = 0)
	{
		$cat_row = array();
		if ($cat_id == 0)
		{
			$cat_row[1]['id']   = 0;
			$cat_row[1]['name'] = "所有惠抢购";
		}
		else
		{
			$row = $this->getOne($cat_id);
			if ($row)
			{
				$cat_row[1]['id']   = $row['scarebuy_cat_id'];
				$cat_row[1]['name'] = $row['scarebuy_cat_name'];
			}
		}
		if ($scat_id != 0)
		{
			$row = $this->getOne($scat_id);
			if ($row)
			{
				$cat_row[2]['id']   = $row['scarebuy_cat_id'];
				$cat_row[2]['name'] = $row['scarebuy_cat_name'];
			}
		}

		return $cat_row;
	}


}