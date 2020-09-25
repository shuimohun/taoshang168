<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Api_Information_LikeCtl extends Api_Controller
{
    public $informationLikeModel = null;
    public function __construct(&$ctl, $met, $typ)
    {
        parent::__construct($ctl, $met, $typ);
        $this->informationLikeModel = new Information_LikeModel();
    }

    public function like(){
        $data = array();
        $data['information_id'] = request_int('information_id');
        $data['user_id'] = request_int('user_id');

        $information_like_id = $this->informationLikeModel->likeInfo($data,true);

        if($information_like_id){
            $msg = _('success');
            $status = 200;
        }else{
            $msg = _('failure');
            $status = 250;
        }
        $data['information_like_id'] = $information_like_id;

        $this->data->addBody(-140,$data,$msg,$status);
    }

    public function unLike(){
        $data = array();
        $data['information_id'] = request_int('information_id');
        $data['user_id'] = request_int('user_id');

        $res = $this->informationLikeModel->unLikeInfo($data,true);

        if($res){
            $msg = _('success');
            $status = 200;
        }else{
            $msg = _('failure');
            $status = 250;
        }
        $data['res'] = $res;

        $this->data->addBody(-140,$data,$msg,$status);
    }
    //app接口
    public function  isLike_row(){
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

?>