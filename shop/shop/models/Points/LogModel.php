<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/15
 * Time: 17:57
 */
class Points_LogModel extends Points_Log
{
	const ONREG        = 1;    //会员注册
	const ONLOGIN      = 2;    //会员登录
	const ONEVALUATION = 3;    //评价
	const ONBUY        = 4;    //购买商品
	const ONOFF        = 5;    //退款退货减金蛋
	const ONADMIN      = 6;    //管理员操作
	const ONCHANGE     = 7;    //换购商品
	const ONVOUCHER    = 8;    //兑换代金券

    /*
    +
    作者:发帖 推荐商品 被点赞 被关注 被转发
    读者:阅读 点赞 关注 转发 举报
    -
    作者:审核不通过 被举报
    读者:违规举报*/

    const POST           = 9; //发帖
    const RECOMMEND      = 10;//推荐商品
    const BE_LIKED       = 11;//被点赞
    const BE_FOLLOWED    = 12;//被关注
    const BE_FORWARDED   = 13;//被转发
    const READ           = 14;//阅读
    const LIKES          = 15;//点赞
    const FOLLOW         = 16;//关注
    const FORWARD        = 17;//转发
    const REPORT         = 18;//举报

    const NO_PASS        = 19;//审核不通过
    const BE_REPORTED    = 20;//被举报
    const ILLEGAL_REPORT = 21;//违规举报

	//金蛋获取途径
	public static $classId = array(
		1 => '会员注册',
		2 => '会员登录',
		3 => '评价',
		4 => '购买商品',
		5 => '退款退货减金蛋',
		6 => '管理员操作',
		7 => '换购商品',
		8 => '兑换代金券',

        9  => '发帖',
        10 => '推荐商品',
        11 => '被点赞',
        12 => '被关注',
        13 => '被转发',
        14 => '阅读',
        15 => '点赞',
        16 => '关注',
        17 => '转发',
        18 => '举报',
        19 => '审核不通过',
        20 => '被举报',
        21 => '违规举报',
	);

	/**
	 * 读取分页列表
	 *
	 * @param  array $cond_row 查询条件
	 * @param  array $order_row 排序信息
	 * @param  int $page 当前页码
	 * @param  int $rows 每页记录数
	 * @return array $data 返回的查询内容
	 */
	public function getPointsLogList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
	{
		$data = $this->listByWhere($cond_row, $order_row, $page, $rows);

		foreach ($data['items'] as $key => $value)
		{
			$data['items'][$key]['classid']  = $data['items'][$key]['class_id'];
			$data['items'][$key]['class_id'] = _(Points_LogModel::$classId[$value['class_id']]);
			/*if ($value['points_log_type'] == '2')
			{
				$data['items'][$key]['points_log_points'] = -$value['points_log_points'];
			}*/
		}
		return $data;
	}
	
	/**
	 * 获取增加减少金蛋
	 * @param  array $cond_row 查询条件
	 * @return array $data 返回的查询内容
	 */
	public function getPointsLog($cond_row)
	{
		$data = $this->getByWhere($cond_row);
		return $data;
	}

    public function sql($sql){
        return $this->sql->getAll($sql);
    }

    /**
     * 资讯 添加金蛋
     *
     * @author Zhenzh 20180801
     * @param int $user_id         用户id
     * @param string $user_name    用户名
     * @param int $type            类型
     * @param int $recommend_count 发帖时推荐商品个数
     * @return array               ['flag'=>true,'msg'=>'成功']
     */
    public function addPointsLog($user_id = 0,$user_name = '',$type = 0,$recommend_count = 0)
    {
        if($user_id && $type)
        {
            //金蛋log类型 1增加(默认) 2扣除
            $points_log_type = 1;

            $post_row   = [self::POST => 'post'];
            $recommend  = [self::RECOMMEND => 'recommend'];
            $author_row = [self::BE_LIKED => 'be_liked',self::BE_FOLLOWED => 'be_followed',self::BE_FORWARDED => 'be_forwarded'];
            $reader_row = [self::READ => 'read',self::LIKES => 'likes',self::FOLLOW => 'follow',self::FORWARD => 'forward'];
            $report_row = [self::REPORT => 'report'];
            $points_no_allow = [self::NO_PASS => 'no_pass',self::BE_REPORTED => 'be_reported',self::ILLEGAL_REPORT => 'illegal_report'];

            //是否需要金蛋开关 开启 $points_no_allow 处罚的不需要开启
            if(isset($points_no_allow[$type]))
            {
                $points_log_type = 2;
                $points_log_flag = $points_no_allow[$type];

                if (self::BE_REPORTED == $type)
                {
                    $UserInfoModel = new User_InfoModel();
                    $user_info = $UserInfoModel->getOne($user_id);
                    if($user_info)
                    {
                        $user_punish_times = $user_info['user_punish_times'] + 1;
                        $user_punish_end_time = $user_info['user_punish_end_time'] < time() ? time() : $user_info['user_punish_end_time'];

                        $punish = Web_ConfigModel::value('report' . $user_punish_times);
                        //处罚类型1-禁言2-封号 处罚天数 扣除金蛋数
                        list($punish_type,$punish_day,$points) = explode('-',$punish);
                        if($user_punish_times <= 4 && ($punish_type == 1 || $punish_type == 2))
                        {
                            $user_editor_row['user_punish_type'] = $punish_type;
                            $user_editor_row['user_punish_times'] = $user_punish_times;
                            if($user_punish_times == 4)
                            {
                                $user_editor_row['user_punish_end_time'] = 0;
                            }
                            else
                            {
                                $user_editor_row['user_punish_end_time'] = $user_punish_end_time + $punish_day * 86400;
                            }
                            $UserInfoModel->editInfo($user_info['user_id'],$user_editor_row);
                        }
                    }
                }
                else
                {
                    $points = Web_ConfigModel::value($points_log_flag);
                }
            }
            else
            {
                //金蛋开关 是否开启
                if (Web_ConfigModel::value('points_allow'))
                {
                    if (isset($post_row[$type]))
                    {
                        $points_log_flag = $post_row[$type];
                        $points          = Web_ConfigModel::value($points_log_flag);
                        $points_top      = Web_ConfigModel::value('author_post_top');
                        $class_id        = ' = ' . $type;
                    }
                    else if (isset($recommend[$type]))
                    {
                        $points_log_flag = $recommend[$type];
                        $points = 0;
                        if ($recommend_count > 0)
                        {
                            $points = Web_ConfigModel::value($points_log_flag . $recommend_count);
                        }
                        else
                        {
                            $msg = '推荐商品数为0';
                        }
                    }
                    else if (isset($author_row[$type]))
                    {
                        $points_log_flag = $author_row[$type];
                        $points          = Web_ConfigModel::value($points_log_flag);
                        $points_top      = Web_ConfigModel::value('author_top');
                        $class_id        = ' IN (' . implode(',',array_keys($author_row)) . ') ';
                    }
                    else if (isset($reader_row[$type]))
                    {
                        $points_log_flag = $reader_row[$type];
                        $points          = Web_ConfigModel::value($points_log_flag);
                        $points_top      = Web_ConfigModel::value('reader_top');
                        $class_id        = ' IN (' . implode(',',array_keys($reader_row)) . ') ';
                    }
                    else if (isset($report_row[$type]))
                    {
                        $points_log_flag = $report_row[$type];
                        $points          = Web_ConfigModel::value($points_log_flag);
                    }
                    else
                    {
                        $points = 0;
                        $msg    = '类型不正确';
                    }

                    if (isset($points_top) && $points)
                    {
                        //统计当天合计获得金蛋数
                        $today_total = 0;
                        $sql = 'SELECT SUM(points_log_points) total FROM `' . TABEL_PREFIX . 'points_log` WHERE user_id = ' . $user_id . ' AND class_id ' . $class_id . ' AND points_log_time >= "' . date('Y-m-d 00:00:00',time()) . '" AND points_log_time <= "' . date('Y-m-d 23:59:59',time()) . '"';
                        $total_row = $this->selectSql($sql);
                        if($total_row)
                        {
                            $total_row = current($total_row);
                            $today_total = $total_row['total'];
                        }
                        $points = $points_top - $today_total > $points ? $points : $points_top - $today_total;

                        if ($points <= 0)
                        {
                            $msg = '已达上限';
                        }
                    }
                }
                else
                {
                    $points = 0;
                    $msg    = '金蛋开关未开启';
                }
            }

            if (isset($points) && $points > 0)
            {
                $points_row['user_id']           = $user_id;
                $points_row['user_name']         = $user_name;
                $points_row['class_id']          = $type;
                $points_row['points_log_type']   = $points_log_type;
                $points_row['points_log_points'] = $points;
                $points_row['points_log_time']   = get_date_time();
                $points_row['points_log_desc']   = self::$classId[$type];
                $points_row['points_log_flag']   = $points_log_flag;

                //开启事物
                $this->sql->startTransactionDb();
                $add_flag = $this->addLog($points_row);
                if ($add_flag)
                {
                    $User_ResourceModel = new User_ResourceModel();
                    if ($points_log_type == 1)
                    {
                        $resource_row['user_points'] = $points * 1;
                    }
                    else if ($points_log_type == 2)
                    {
                        $resource_row['user_points'] = $points * (-1);
                    }

                    $add_flag = $User_ResourceModel->editResource($user_id, $resource_row,true);
                }
                if ($add_flag && $this->sql->commitDb())
                {
                    $msg = '成功';
                }
                else
                {
                    $this->sql->rollBackDb();
                    $msg = isset($msg) ? $msg : '失败';
                }
            }
            else
            {
                $add_flag = 0;
                $msg = isset($msg) ? $msg : '失败';
            }
        }
        else
        {
            $add_flag = 0;
            $msg = '参数错误';
        }

        return ['flag'=>$add_flag,'msg'=>$msg];
    }

}
