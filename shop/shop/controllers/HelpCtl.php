<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class HelpCtl extends Controller
{
    public function index(){
        $this->web['web_logo'] = Web_ConfigModel::value("setting_logo");//首页logo

        $op = request_string('op');
        if($op)
        {
            $this->view->setMet($op);
        }
        $HelpGroup = new Help_GroupModel();
        $HelpBase = new Help_BaseModel();
        $cond['help_group_parent_id'] = 0;
        $cond['help_or_rule'] = '帮助';
        $order['help_group_id'] = 'asc';
        $page = request_int('page',1);
        $rows = request_int('rows',8);
        $Parent = $HelpGroup->listByWhere($cond,$order,$page,$rows);
        $cond2['help_group_parent_id:!='] = 0;
        $cond2['help_or_rule'] = '帮助';
        $order2['help_grop_sort'] = 'asc';
        $page2 = request_int('page',1);
        $rows2 = request_int('rows',100);
        $Son = $HelpGroup->listByWhere($cond2,$order,$page2,$rows2);
        $cond3['help_type'] = 1;
        $cond3['help_or_rule'] = '帮助';
        $page3 = request_int('page',1);
        $rows3 = request_int('rows',5);
        $Type = $HelpBase->listByWhere($cond3,$order3,$page3,$rows3);
        $cond4['help_type'] = 0;
        $cond4['help_or_rule'] = '帮助';
        $rows4 = 3;
        $page4 = 1;
        $order4['help_sort'] = "asc";
        $Top = $HelpBase->listByWhere($cond4,$order4,$page4,$rows4);
        include $this->view->getView();
    }
//    详情
    public function ruleDetail(){
        $this->web['web_logo'] = Web_ConfigModel::value("setting_logo");//首页logo
        $help_id = request_int('id');
        $HelpBase = new Help_BaseModel();
        $HelpGroup = new Help_GroupModel();
        $detail = $HelpBase->getOne($help_id);
        $group_id = $detail['help_group_id'];
        $group = $HelpGroup->getOne($group_id);
        $group_title = $group['help_group_title'];
        $group_id = $group['help_group_id'];
        include $this->view->getView();

    }
//    公告
    public function noticeDetail(){
        $this->web['web_logo'] = Web_ConfigModel::value("setting_logo");//首页logo
        $HelpBase = new Help_BaseModel();
        $cond['help_type'] = 1;
        $cond['help_or_rule'] = '帮助';
        $order['help_add_time'] = 'desc';
        $page = request_int('page',1);
        $rows = request_int('rows',100);
        $notice = $HelpBase->listByWhere($cond,$order,$page,$rows);
        include $this->view->getView();

    }
//    总览
    public function ruleOverview()
        {
        $this->web['web_logo'] = Web_ConfigModel::value("setting_logo");//首页logo
        $HelpGroup = new Help_GroupModel();
        $HelpBase = new Help_BaseModel();
        $cond['help_group_parent_id'] = 0;
        $cond['help_or_rule'] = '帮助';
        $order['help_group_id'] = 'asc';
        $page = request_int('page',1);
        $rows = request_int('rows',100);
        $Parent = $HelpGroup->listByWhere($cond,$order,$page,$rows);
        $cond2['help_group_parent_id:!='] = 0;
        $cond2['help_or_rule'] = '帮助';
        $page2 = request_int('page',1);
        $rows2 = request_int('rows',100);
        $Son = $HelpGroup->listByWhere($cond2,$order2,$page2,$rows2);
        $title = request_string('title');
        if ($title) {
            $title = "%$title%";
            $cond3['help_title:LIKE'] = $title;
            $cond3['help_or_rule'] = '帮助';
            $order3['help_add_time'] = 'asc';
            $page3 = request_int('page', 1);
            $rows3 = request_int('rows', 8);
            $search = $HelpBase->getBaseAllList($cond3, $order3, $page3, $rows3);
        }
            if ('json' == $this->typ)
            {
                $this->data->addBody(-140, $Parent,$Son);
            }
            else
            {
                include $this->view->getView();
            }
    }
    //三级联动
    public function getList(){
        $group_id = request_string('group_id');
        $HelpBase = new Help_BaseModel();
        $cond['help_group_id'] = $group_id;
        $cond['help_or_rule'] = '帮助';
        $cond['help_type'] = 0;
        $order['help_group_id'] = 'asc';
        $page = request_int('page',1);
        $rows = request_int('rows',100);
        $List = $HelpBase->getBaseAllList($cond,$order,$page,$rows);

        if ($List)
        {
            $msg    = _('success');
            $status = 200;
        }
        else
        {
            $msg    = _('failure');
            $status = 250;
        }
        if($this->typ = 'json')
        {
        $this->data->addBody(-140, $List,$msg,$status);
        }
    }
//    每月新规
    public function noticeList(){
        $this->web['web_logo'] = Web_ConfigModel::value("setting_logo");//首页logo
        $data = Date('Y-m');
        $HelpBase = new Help_BaseModel();
        $cond['help_add_time:>'] = $data;
        $cond['help_type'] = 0;
        $order['help_add_time'] = "desc";
        $page = request_int('page',1);
        $rows = request_int('rows',100);
        $noticeList = $HelpBase->listByWhere($cond,$order,$page,$rows);
//        var_dump($noticeList);
        include $this->view->getView();
    }

}

?>
