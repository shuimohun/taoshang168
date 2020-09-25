<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class RedPacket_BaseModel extends RedPacket_Base
{
	const UNUSED  = 1;   	//未使用
	const USED    = 2;      //已使用
	const EXPIRED = 3;  	//过期
	

	public static $redpacketState = array(
		self::UNUSED => "未用",
		self::USED => "已用",
		self::EXPIRED => "过期"
	);

	/**
	 * 读取分页列表
	 *
	 * @param  int $config_key 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getRedPacketList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
		$data = $this->listByWhere($cond_row, $order_row, $page, $rows);
        $expire_row = array();
		foreach ($data["items"] as $key => $value)
		{
			$data["items"][$key]["redpacket_state_label"] = _(self::$redpacketState[$value["redpacket_state"]]);

            if (strtotime($value['redpacket_end_date']) < time())
            {
                $data['items'][$key]['redpacket_state']        = self::EXPIRED;
                $data['items'][$key]['redpacket_state_label'] = _(self::$redpacketState[self::EXPIRED]);
                $expire_row[]                                     = $value['redpacket_id'];
            }
		}

        $this->editRedPacket($expire_row, array('redpacket_state'=>self::EXPIRED));

		return $data;
	}

	//获取用户所有的平台优惠券数量
	public function getAllRedPacketCountByUserId($user_id)
	{
		$cond_row['redpacket_owner_id'] = $user_id;
		return $this->getNum($cond_row);
	}

	//获取用户可用的平台优惠券数量
	public function getAvaRedPacketCountByUserId($user_id)
	{
		$cond_row['redpacket_owner_id']      = $user_id;
		$cond_row['redpacket_start_date:<='] = get_date_time();
		$cond_row['redpacket_end_date:>=']   = get_date_time();
		$cond_row['redpacket_state']         = self::UNUSED;
		return $this->getNum($cond_row);
	}

	public function getRedPacketNumByWhere($cond_row)
	{
        return $this->getNum($cond_row);
	}

	/**
	 * 读取列表
	 *
	 * @param  int $config_key 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getConfigList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
		return $this->getByWhere($cond_row, $order_row, $page, $rows);
	}

	//获取用户可使用的店铺平台优惠券
	public function getUserOrderRedPacketByWhere($user_id)
	{
		$cond_row                     	= array();
		$cond_row['redpacket_owner_id'] = $user_id;
		$cond_row['redpacket_state']    = self::UNUSED;
		$order_row['redpacket_id'] 		= 'DESC';
		$rows                      = $this->getByWhere($cond_row, $order_row);
		if ($rows)
		{
			$expire_redpacket = array();
			foreach ($rows as $key => $value)
			{
				if (strtotime($value['redpacket_end_date']) < time())
				{
					$expire_redpacket[] = $value['redpacket_id'];
					unset($rows[$key]); //过期的平台优惠券
				}
			}

			$this->editRedPacket($expire_redpacket, array('redpacket_state' => self::EXPIRED));
		}
		return $rows;
	}

	//平台优惠券使用后，更改状态
	public function changeRedPacketState($redpacket_id, $order_id)
	{
		$rs_row = array();

		$field_row['redpacket_order_id'] = $order_id;
		$field_row['redpacket_state']    = RedPacket_BaseModel::USED;
		$update_flag                   = $this->editRedPacket($redpacket_id, $field_row);
		check_rs($update_flag, $rs_row);

		$redpacket_row = $this->getOne($redpacket_id);

		if ($redpacket_row) //更新平台优惠券模板中平台优惠券已使用数量
		{
			$RedPacket_TempModel = new RedPacket_TempModel();
			$edit_flag         = $RedPacket_TempModel->editRedPacketTemplate($redpacket_row['redpacket_t_id'], array('redpacket_t_used' => 1), true);
			check_rs($edit_flag, $rs_row);
		}

		return is_ok($rs_row);
	}

	/**
	 * 读数量
	 *
	 * @param  int $config_key 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getCount($cond_row = array())
	{
		return $this->getNum($cond_row);
	}



    //红包分类
   public function redClassify($cut = 'unclaimed',$option = 'default')
   {
       $uid = perm::$userId;
       $grade = "select * from YLB_user_info where user_id = $uid";
       $cont = $this->sql->getRow($grade);
       $ti = time();

      if($cut == 'unclaimed')
      {
        switch ($option)
        {
            case 'default':
                $sql  = "select * from ylb_redpacket_template where UNIX_TIMESTAMP(redpacket_t_end_date) > $ti and redpacket_t_state = 1";
                break;
            case 'count':
                $sql = "select * from ylb_redpacket_template where UNIX_TIMESTAMP(redpacket_t_end_date) > $ti and redpacket_t_state = 1 order by redpacket_t_giveout desc";
                $jud = 'redpacket_t_give_out';
                break;
            case 'much':
                $sql = "select * from ylb_redpacket_template where UNIX_TIMESTAMP(redpacket_t_end_date) > $ti and redpacket_t_state = 1 order by redpacket_t_price desc";
                $jud = 'redpacket_t_price';
                break;
            case 'can':
                $sql = "select * from ylb_redpacket_template where redpacket_t_user_grade_limit <= $cont[user_grade] and UNIX_TIMESTAMP(redpacket_t_end_date) > $ti and redpacket_t_state = 1";
                break;

        }
        $rtid = $this->sql->getAll($sql);

        $sql  = "select count(redpacket_t_id) as num,redpacket_t_id,redpacket_state from YLB_redpacket_base where redpacket_owner_id = $uid group by redpacket_t_id";
        $cond = $this->sql->getAll($sql);

        if(!empty($cond))
        {
            foreach($rtid as $key => $value)
            {
                $rtid[$key]['redpacket_start_day'] = substr($value['redpacket_t_start_date'],0,11);
                $rtid[$key]['redpacket_end_day'] = substr($value['redpacket_t_end_date'],0,11);
                $rtid[$key]['state'] = '0';
            }
            return $rtid;
        }
        else
        {

            $arr = array();
            foreach($cond as $key => $value)
            {
                $sql = "select * from ylb_redpacket_template where redpacket_t_id = $value[redpacket_t_id] and redpacket_t_eachlimit > $value[num]";
                $arr[$key] = $this->sql->getRow($sql);

            }

            if(count($rtid)>count($cond))
            {
              $rarr = array();
              foreach($cond as $key => $value)
              {
                  $sql = "select * from ylb_redpacket_template where redpacket_t_id = $value[redpacket_t_id]";
                  $rarr[] = $this->sql->getRow($sql);
              }
              $arrs = array_merge($rarr,$rtid);

                $arr_out =array();
                foreach($arrs as $k => $v)
                {
                    $key_out = $v['redpacket_t_id'];

                    if(array_key_exists($key_out,$arr_out)){
                        unset($arr_out[$key_out]);
                    }
                    else{
                        $arr_out[$key_out] = $arrs[$k];

                    }
                }
                foreach($arr_out as $key=>$value)
                {
                    array_push($arr,$value);
                }
            }

            if($option == 'count' || $option == 'much')
            {
                $len = count($arr);
                //冒泡排序
                for($k = 0;$k<$len;$k++)
                {
                    for($j = $len-1;$j>$k;$j--)
                    {
                        if($arr[$j][$jud]>$arr[$j-1][$jud])
                        {
                            $temp = $arr[$j];
                            $arr[$j] = $arr[$j-1];
                            $arr[$j-1] = $temp;
                        }
                    }
                }
            }

            foreach($arr as $key => $value)
            {

                if($arr[$key] == '')
                {
                    unset($arr[$key]);
                }
            }
            $data = array_merge($arr);

            if($data[0] != '')
            {

                foreach($data as $key => $value)
                {
                    $data[$key]['state'] = '0';
                    $data[$key]['redpacket_t_start_day'] = substr($value['redpacket_t_start_date'],0,11);
                    $data[$key]['redpacket_t_end_day'] = substr($value['redpacket_t_end_date'],0,11);
                }
            }

            return $data;
        }
      }
      else if($cut == 'unused')
      {
          $sql = "select * from ylb_redpacket_base where redpacket_owner_id = $uid and redpacket_state = 1";
          $arr = $this->sql->getAll($sql);
          $data = array();
          foreach($arr as $key => $value)
          {
              $sql = "select * from ylb_redpacket_template where redpacket_t_id = $value[redpacket_t_id]";
              $ran = $this->sql->getRow($sql);
              $ran['state'] = $value['redpacket_state'];
              $data[] = $ran;
          }
         foreach($data as $key => $value)
         {
             $data[$key]['redpacket_t_start_day'] = substr($value['redpacket_t_start_date'],0,11);
             $data[$key]['redpacket_t_end_day'] = substr($value['redpacket_t_end_date'],0,11);
         }
          return $data;
      }
      else if($cut == 'record')
      {
          $sql = "select * from ylb_redpacket_base where redpacket_owner_id = $uid and redpacket_state >= 2";
          $arr = $this->sql->getAll($sql);
          $data = array();
          foreach($arr as $key => $value)
          {
              $sql = "select * from ylb_redpacket_template where redpacket_t_id = $value[redpacket_t_id]";
              $ran = $this->sql->getRow($sql);
              $ran['state'] = $value['redpacket_state'];
              $data[] = $ran;
          }
          foreach($data as $key => $value)
          {
              $data[$key]['redpacket_t_start_day'] = substr($value['redpacket_t_start_date'],0,11);
              $data[$key]['redpacket_t_end_day'] = substr($value['redpacket_t_end_date'],0,11);
          }
          return $data;
      }
      else if($cut == 'overdue')
      {
          $sql = "select * from ylb_redpacket_base where redpacket_owner_id = $uid and redpacket_state = 3";
          $arr = $this->sql->getAll($sql);
          $data = array();
          foreach($arr as $key => $value)
          {
              $sql = "select * from ylb_redpacket_template where redpacket_t_id = $value[redpacket_t_id]";
              $ran = $this->sql->getRow($sql);
              $ran['state'] = $value['redpacket_state'];
              $data[] = $ran;
          }
          foreach($data as $key => $value)
          {
              $data[$key]['redpacket_t_start_day'] = substr($value['redpacket_t_start_date'],0,11);
              $data[$key]['redpacket_t_end_day'] = substr($value['redpacket_t_end_date'],0,11);
          }
          return $data;
      }
   }

}

?>