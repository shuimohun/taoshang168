<?php
/**
 * Created by PhpStorm.
 * User: Liuguilong
 * Date: 2017/6/7 0007
 * Time: 17:43
 */

if(!defined('ROOT_PATH'))
{
    exit('No Permission');
}

class Information_LikeCtl extends Controller{

    public $informationLikeModel = null;

    public function __construct(&$ctl,$met,$typ){

        parent::__construct($ctl, $met, $typ);
        $this->informationLikeModel = new Information_LikeModel();
    }

    public function like(){

        $data['user_id'] = Perm::$userId;
        $data['information_id'] = request_int('information_id');

        $information_like_id = $this->informationLikeModel->likeInfo($data,true);

        if($information_like_id){
            $msg = _('success');
            $status = 200;
        }else{
            $msg = _('failure');
            $status = 250;
        }
        $data['information_like_id'] = $information_like_id;
        $this->data->addBody(-140, $data, $msg, $status);
    }

    public function unLike(){
        $data['user_id'] = Perm::$userId;
        $data['information_id'] = request_int('information_id');

        $del_flag = $this->informationLikeModel->unLikeInfo($data,true);

        if($del_flag){
            $msg = _('success');
            $status = 200;
        }else{
            $msg = _('failure');
            $status = 250;
        }

        $data['del_flag'] = $del_flag;

        $this->data->addBody(-140, $data, $msg, $status);
    }
    public function isLike_row(){
        $user_id = request_int('user_id');
        $information_id= request_int('information_id');
        $User_base = new User_BaseModel();
        $informationReplyModel = new Information_ReplyModel();
        $del_flag = $this->informationLikeModel->isLikeInfo($user_id,$information_id);
        $data['del_flag'] = $del_flag;
        $sql = 'select * from ylb_information_reply WHERE  article_id = '.$information_id .' order by article_reply_time desc';

        $data['items'] = $informationReplyModel->sql($sql);

        foreach ($data['items'] as $k =>$v){
            $sql = "select user_logo from ylb_user_info where user_id=".$v['user_id'];
            $users = $User_base ->sql($sql);
            $data['items'][$k]['user_logo'] = $users[0]['user_logo'];
        }

        $this->data->addBody(-140, $data);
    }

    //app接口
    public function  app_isLike_row(){
        $user_id = request_int('user_id');
        $information_id= request_int('information_id');
        $Information_BaseModel = new Information_BaseModel();
        $del_flag = $this->informationLikeModel->isLikeInfo($user_id,$information_id);
        $data['del_flag'] = $del_flag;
        $data['like_row']       = $Information_BaseModel->getOneByWhere(array('information_id'=>$information_id));
        $data['like_count'] = $this->informationLikeModel->getRowCount(array('information_id'=>$information_id));

        $this->data->addBody(-140, $data);
    }


}