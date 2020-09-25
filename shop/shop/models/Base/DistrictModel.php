<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Base_DistrictModel extends Base_District
{

	public $treeAllKey = null;
	public $tree_name = array('all'=>null,'huabei'=>'华北','dongbei'=>'东北','huadong'=>'华东','huanan'=>'华南','huazhong'=>'华中','xinan'=>'西南','xibei'=>'西北');

	/**
	 * 读取分页列表
	 *
	 * @param  int $district_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getDistrictList($cond_row = array(), $order_row = array('district_displayorder' => 'ASC'), $page = 1, $rows = 100)
	{
		return $this->listByWhere($cond_row, $order_row, $page, $rows);
	}

	/**
	 * 根据分类父类id赌气子类信息,
	 *
	 * @param  int $district_parent_id 父id
	 * @param  bool $recursive 是否子类信息
	 * @param  int $level 当前层级
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getDistrictTree($district_parent_id = 0, $recursive = true, $level = 0)
	{
		$data_rows = $this->getDistrictTreeData($district_parent_id, $recursive, $level);


		$data['items'] = array_values($data_rows);

		return $data;
	}

	//缓存分类
    public function getCache()
    {
        $key = 'self_index';
        $Cache = YLB_Cache::create($key);

        if($data = $Cache->get($key))
        {
            return $data;
        }
        else
        {
            $data = $this->getAllDis();
            $Cache->save($data,$key);
            return $data;
        }

    }

    //获取地区
    public function getAllDis()
    {
        $data = array();
        $dis_all_array = $this->sql->getAll($this->sql->select('*',$this->_tableName));
        foreach ((array) $dis_all_array as $a) {
            $data['name'][$a['district_id']] = $a['district_name'];
            $data['parent'][$a['district_id']] = $a['district_parent_id'];
            $data['children'][$a['district_parent_id']][] = $a['district_id'];
            if ($a['district_is_level'] == 1 && $a['district_region'])
                $data['region'][$a['district_region']][] = $a['district_id'];
        }
        return $data;
    }

	//获取所有的地区
	public function  getAllDistrict()
	{
		$province = $this->getDistrictTreeData('0', false);

		$p_id = array_column($province, 'district_id');

		$city = $this->getDistrictTreeData($p_id, false);

		foreach ($city as $key => $val)
		{
			$province[$val['parent_id']]['city'][] = $val;
		}

		return $province;

	}

	//获取所有的地区
	public function  getDistrictAll()
	{
		$province = $this->getDistrictTreeData('0', false);
		$province = array_values($province);
		$p_id = array_column($province, 'district_id');

		$city = $this->getDistrictTreeData($p_id, false);
		fb($city);
		$c_id = array_column($city, 'district_id');

		$area = $this->getDistrictTree($c_id, false);
		fb($area);

		$data[] = $province;
		foreach ($city as $key => $val)
		{
			$data[$val['parent_id']][] = $val;
		}

		foreach ($area['items'] as $key => $val)
		{
			$data[$val['parent_id']][] = $val;
		}

		return $data;

	}
    public function  getDistrictJson()
    {
        $province = $this->getDistrictTreeData('0', false);
        $p_id = array_keys($province);

        $city = $this->getDistrictTreeData($p_id, false);
        $c_id = array_keys($city);

        $area = $this->getDistrictTreeData($c_id, false);

        foreach ($area as $key => $value)
        {
            if (isset($city[$value['district_parent_id']]))
            {
                $row = [];
                $row['id'] = $value['district_id'];
                $row['name'] = $value['district_name'];
                $row['pid'] = $value['district_parent_id'];
                $city[$value['district_parent_id']]['children'][] = $row;
            }
        }

        foreach ($city as $key => $value)
        {
            if (isset($province[$value['district_parent_id']]))
            {
                $row = [];
                $row['id'] = $value['district_id'];
                $row['name'] = $value['district_name'];
                $row['pid'] = $value['district_parent_id'];
                if ($value['children'])
                {
                    $row['children'] = $value['children'];
                }
                $province[$value['district_parent_id']]['children'][] = $row;
            }
        }

        $data = [];
        foreach ($province as $key => $value)
        {
            $row['id'] = $value['district_id'];
            $row['name'] = $value['district_name'];
            $row['pid'] = $value['district_parent_id'];
            if ($value['children'])
            {
                $row['children'] = $value['children'];
            }

            $data[] = $row;
        }

        return $data;


    }



	public function getName($district_row = null)
	{
		if (is_array($district_row))
		{
			$district = $this->getByWhere(array('district_id:IN' => $district_row));
		}
		else
		{
			$district = $this->getByWhere(array('district_id:IN' => $district_row));
		}

		if ($district)
		{
			foreach ($district as $key => $val)
			{
				$district_name[] = $val['district_name'];
			}
		}
		else
		{
			return null;
		}


		return $district_name;
	}


	public function getCookieDistrict($district_id = null)
	{
		$res['provice'] = $this->getOne($district_id);

		$data['area'] = $res['provice']['district_name'];

		$data['provice']['id'] = $district_id;
		$data['provice']['name'] = $res['provice']['district_name'];

		if($res['provice'])
		{
			$res['city'] = $this->getOneByWhere(array('district_parent_id'=>$district_id));

			if($res['city'])
			{
				$data['area'] .= $res['city']['district_name'];

				$data['city']['id'] = $res['city']['district_id'];
				$data['city']['name'] = $res['city']['district_name'];

				$res['area'] = $this->getOneByWhere(array('district_parent_id'=>$res['city']['district_id']));
				if($res['area'])
				{
					$data['area'] .= $res['area']['district_name'];

					$data['address']['id'] = $res['area']['district_id'];
					$data['address']['name'] = $res['area']['district_name'];
				}
			}
		}

		return $data;
	}

	public function getCookieDistrictName($district_name = null)
	{
		$res['provice'] = current($this->getByWhere(array('district_name'=>$district_name)));

		if($res['provice'])
		{
			$data['area'] = $res['provice']['district_name'];

			$district_id = $res['provice']['district_id'];
			$data['provice']['id'] = $res['provice']['district_id'];
			$data['provice']['name'] = $res['provice']['district_name'];

			$res['city'] = $this->getOneByWhere(array('district_parent_id'=>$district_id));

			if($res['city'])
			{
				$data['area'] .= $res['city']['district_name'];

				$data['city']['id'] = $res['city']['district_id'];
				$data['city']['name'] = $res['city']['district_name'];

				$res['area'] = $this->getOneByWhere(array('district_parent_id'=>$res['city']['district_id']));
				if($res['area'])
				{
					$data['area'] .= $res['area']['district_name'];

					$data['address']['id'] = $res['area']['district_id'];
					$data['address']['name'] = $res['area']['district_name'];
				}
			}
		}

		return $data;
	}

	//获取华北等大区分类一级子类(除港澳台和海外)
	public function getRegionTreeOne($name = null)
    {
        $cond_row['district_parent_id'] = 0;

        $region = array_column($this->select('district_region',$cond_row,'district_region'),'district_region');

        foreach ($region as $key=>$value)
        {
            if($value == '港澳台')
            {
                unset($region[$key]);
            }
            if($value == '海外')
            {
                unset($region[$key]);
            }
        }

        foreach ($region as $key=>$value)
        {
            $c_r['district_region'] = $value;
            $addr[$value] = array_merge($this->getByWhere($c_r));
        }

        if($name)
        {
            if($this->tree_name[$name])
            {
                 $data[$this->tree_name[$name]] = $addr[$this->tree_name[$name]];
                 return $data;
            }
            else
            {
                return $addr;
            }
        }
        else
        {
            return $addr;
        }
    }

    /*
   * 根据名称获取地区信息
   * name格式：'陕西 西安市 临潼区 相桥镇'
   */
    public function getDistrictDetailByName($name){
        if(!trim($name)){
            return array();
        }
        $name_array = explode(' ', $name);
        $district_info = array();
        $count = count($name_array);
        for($i = 0; $i < $count; $i ++){
            $district_result = $this->getOneByWhere(array('district_name' => trim($name_array[$i])));
            $district_info[] = $district_result;
        }
        return $district_info;
    }

}

?>