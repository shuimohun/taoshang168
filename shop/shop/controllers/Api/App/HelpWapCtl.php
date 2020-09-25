<?php
if(!defined('ROOT_PATH'))
{
    exit('No Permission');
}

class Api_App_HelpWapCtl extends YLB_AppController
{
    public $helpGroupModel = null;
    public $helpBaseModel  = null;

    public function __construct(&$ctl, $met, $typ)
    {
        parent::__construct($ctl, $met, $typ);

        //include $this->view->getView();
        $this->helpGroupModel = new Help_GroupModel();
        $this->helpBaseModel = new Help_BaseModel();
    }

    //2017 12/07 wdp
    public function wapHelpList()
    {
        $help_group_id = request_int('help_group_id');
        $help_id = request_int('help_id');
        if($help_group_id){
            $help_base = $this->helpGroupModel->getOne($help_group_id);
            $data = $this->helpBaseModel->getBaseAllList(array('help_group_id'=>$help_group_id));
            $data['parentTitle'] = $help_base['help_group_title'];
            $msg = 'success';
            $status = 200;
        }else{
            if($help_id){
                $data = $this->helpBaseModel->getOne($help_id);
//                $data['help_desc'] =htmlspecialchars($data['help_desc']);
                $msg = 'success';
                $status = 200;
//                if($data['help_url']){
//                    $user_id = Perm::$userId;
//                    if(!$user_id){
//                        $msg = '需要登录';
//                        $status = 30;
//                        $data = array();
//                    }
//                }
            }else{
                $data = $this->helpGroupModel->getGroupList();
                $msg = 'success';
                $status = 200;
            }
        }
        if($this->typ == 'json'){
            $this->data->addBody(-140,$data,$msg,$status);
        }
    }
}