<?php
if(!defined('ROOT_PATH'))
{
    exit('No Permission ');
}

class Activity_SwitchModel extends Activity_Switch
{
    public $ac_enable=array(0=>'未开启',1=>'开启');
    public function getSwitchList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        return $this->listByWhere($cond_row, $order_row, $page, $rows);
    }

}