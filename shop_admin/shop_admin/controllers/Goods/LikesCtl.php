<?php
if(!defined('ROOT_PATH')){
    exit('No Permission!');
}


class Goods_LikesCtl extends AdminController{

    public function __construct(&$ctl,$met,$typ){
        parent::__construct($ctl,$met,$typ);
    }

    public function index(){
        include $this->view->getView();
    }

    public function addLike(){
        include $this->view->getView();
    }
}
