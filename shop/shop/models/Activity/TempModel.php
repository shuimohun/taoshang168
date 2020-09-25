<?php
if(!defined('ROOT_PATH'))
{
    exit('No Permission ');
}

class Activity_TempModel extends Activity_Temp
{

    public function getTempList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        return $this->listByWhere($cond_row, $order_row, $page, $rows);
    }


}