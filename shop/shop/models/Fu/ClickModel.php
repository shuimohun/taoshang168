<?php
if (! defined('ROOT_PATH')) {
    exit('No Permission');
}

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/20
 * Time: 15:44
 */
class Fu_ClickModel extends Fu_Click
{

    public function __construct()
    {
        parent::__construct();
    }

    public function addFuClick($field_row, $return_insert_flag)
    {
        return $this->add($field_row, $return_insert_flag);
    }



}

