<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Api_Information_ReportCtl extends Api_Controller
{
    public $InformationBaseModel   = null;
    public $InformationReportModel = null;

	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);

        $this->InformationBaseModel   = new Information_BaseModel();
        $this->InformationReportModel = new Information_ReportModel();
	}

    /**
     * 获取被举报的资讯列表
     */
    public function getReportList()
    {
        $page = request_int('page', 1);
        $rows = request_int('rows', 25);
        $cond_row['information_report'] = 1;
        $order_row['information_id'] = 'desc';
        $data = $this->InformationBaseModel->listByWhere($cond_row,$order_row,$page,$rows);

        $this->data->addBody(-140, $data);
    }

    /**
     * 获取举报列表
     */
    public function getReportRow()
    {
        $data = [];
        $page = request_int('page', 1);
        $rows = request_int('rows', 25);
        $information_id = request_int('information_id');
        if($information_id)
        {
            $data = $this->InformationReportModel->listByWhere(['information_id'=>$information_id],['report_id'=>'DESC'],$page,$rows);
            foreach ($data['items'] as $key => $value)
            {
                $data['items'][$key]['status_con'] = Information_ReportModel::$report_map[$value['status']];
            }
        }

        $this->data->addBody(-140, $data);
    }

    /**
     * 审核举报
     */
    public function audit()
    {
        $report_id = request_int('report_id');
        $data = $this->InformationReportModel->getOne($report_id);
        $this->data->addBody(-140, $data);
    }

    /**
     * 审核举报 操作
     */
    public function auditReport()
    {
        $report_id     = request_int('report_id');
        $report_status = request_int('status');

        if($report_id && $report_status > 1)
        {
            $flag = $this->InformationReportModel->auditReport($report_id,$report_status);
        }

        if ($flag)
        {
            $msg = '审核成功';
            $status = 200;

            $data['id'] = $report_id;
            $data['report_id'] = $report_id;
            $data['status_con'] = Information_ReportModel::$report_map[$report_status];
        }
        else
        {
            $msg = '审核失败';
            $status = 250;
            $data = [];
        }

        $this->data->addBody(-140, $data,$msg,$status);
    }

}

?>