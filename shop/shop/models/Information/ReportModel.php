<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Information_ReportModel extends Information_Report
{
    const WAITING_PASS   = 1; //待审核
    const PASS           = 2; //审核通过 举报成功
    const ILLEGAL_REPORT = 3; //违规举报

    public static $report_map = [
        self::WAITING_PASS   => '待审核',
        self::PASS           => '审核通过',
        self::ILLEGAL_REPORT => '违规举报'
    ];

    /**
     * 读取分页列表
     *
     * @param array $cond_row
     * @param array $order_row
     * @param int $page
     * @param int $rows
     * @return array
     */
    public function getReportList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        $data = $this->listByWhere($cond_row, $order_row, $page, $rows);
        if($data['items'])
        {
            foreach ($data['items'] as $key => $value)
            {
                $data['items'][$key]['status_con'] = self::$report_map[$value['status']];
            }
        }
        return $data;
    }

    /**
     * 审核 举报
     * @author Zhenzh 20180801
     * @param $report_id  举报id
     * @param $status     审核结果 通过--self::PASS 违规举报--self::ILLEGAL_REPORT
     * @return bool       是否成功
     */
    public function auditReport($report_id,$status)
    {
        $flag = false;
        $report = $this->getOne($report_id);
        if($report && $report['status'] == self::WAITING_PASS)
        {
            $information_id = $report['information_id']; //举报文章id
            $user_id = $report['user_id'];//举报人id
            $user_name = $report['user_name'];//举报人用户名
            $author_id = $report['author_id'];//作者id
            $author_name = $report['author_name'];//作者用户名

            $PointsLogModel = new Points_LogModel();

            if($status == self::PASS)
            {
                //审核通过 合法举报
                //检测此资讯有没有被举报过(状态是审核通过的)
                $report = $this->getKeyByWhere(['information_id'=>$information_id,'status'=>self::PASS]);
                if (!$report)
                {
                    //读者 增加金蛋
                    $PointsLogModel->addPointsLog($user_id,$user_name,Points_LogModel::REPORT);
                    //作者 禁言 封号 扣金蛋
                    $PointsLogModel->addPointsLog($author_id,$author_name,Points_LogModel::BE_REPORTED);
                }
            }
            else if ($status == self::ILLEGAL_REPORT)
            {
                //违规举报
                $PointsLogModel->addPointsLog($user_id,$user_name,Points_LogModel::ILLEGAL_REPORT);
            }
            else
            {
                return $flag;
            }

            $flag = $this->editBase($report_id,['status'=>$status]);
        }

        return $flag;
    }
}

?>