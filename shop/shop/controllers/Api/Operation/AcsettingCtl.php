<?php
if(!defined('ROOT_PATH'))
{
    exit('No Permission');
}

class Api_Operation_AcsettingCtl extends YLB_AppController
{
    public $switchModel;
    public function __construct(&$ctl,$met,$typ)
    {
        parent::__construct($ctl,$met,$typ);
        $this->switchModel = new Activity_SwitchModel();
    }

    public function setting()
    {
        $data = $this->switchModel->getSwitchList();
        foreach($data['items'] as $key=>$value){
            $data['items'][$key]['enable_status'] = $this->switchModel->ac_enable[$value['ac_enable']];
        }
        $this->data->addBody(-140,$data);
    }

    public function editSetting()
    {
       $activity = request_row('activity');
       if(count($activity)){
           $this->switchModel->sql->startTransactionDb();//事务开启
           foreach($activity as $key=>$value){
               $base = $this->switchModel->getOneByWhere(array('ac_name'=>$key));
               $this->switchModel->editSwitchFalse($base['ac_id'],array('ac_enable'=>$value));
           }
       }
       if($this->switchModel->sql->commitDb()){
           $msg = 'success';
           $status = 200;
       }else{
           $msg = 'field';
           $status = 250;
       }
       $data = array();
       $this->data->addBody(-140,$data,$msg,$status);
    }
}