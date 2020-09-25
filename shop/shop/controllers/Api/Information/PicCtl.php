<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Api_Information_PicCtl extends Api_Controller
{
    public $informationLikeModel = null;
    public function __construct(&$ctl, $met, $typ)
    {
        parent::__construct($ctl, $met, $typ);
        $this->informationLikeModel = new Information_LikeModel();
    }

    public function getPic()
    {
        $web_config = new Web_ConfigModel();
        $left = $web_config->getOne('photo_left_logo');
        $right = $web_config->getOne('photo_right_logo');
        $left_src = $web_config->getOne('photo_left_url');
        $right_src = $web_config->getOne('photo_right_url');
        $data = array();
       array_push($data,$left,$right,$left_src,$right_src);
        if ($data)
        {
            $msg    = _('success');
            $status = 200;
        }
        else
        {
            $msg    = _('failure');
            $status = 250;
        }
        $this->data->addBody(-140, $data, $msg, $status);
    }

    public function addUrl(){
        $photo_left_url = request_string('left');
        $photo_right_url = request_string('right');
        $WebConfigModel = new Web_ConfigModel();
        $add_left = array();
        $add_left['config_key'] = 'photo_left_url';
        $add_left['config_value'] = $photo_left_url;
        $add_left['config_type'] = 'photo';
        $add_left['config_comment'] = '资讯图片链接';
        $add_right = array();
        $add_right['config_key'] = 'photo_right_url';
        $add_right['config_value'] = $photo_right_url;
        $add_right['config_type'] = 'photo';
        $add_right['config_comment'] = '资讯图片链接';
//                如果不存在就添加,如果存在就更改
        if ($WebConfigModel->getOne('photo_left_url')){
            $config_left = 'photo_left_url';
            $left = $WebConfigModel->editConfig($config_left,$add_left);
        }else{
            $left = $WebConfigModel->addConfig($add_left,true);
                }
//                如果不存在就添加,如果存在就更改
        if ($WebConfigModel->getOne('photo_right_url')){
            $config_right = 'photo_right_url';
            $right = $WebConfigModel->editConfig($config_right,$add_right);
        }else{
            $right = $WebConfigModel->addConfig($add_right,true);
        }
        $data = [$left,$right];
        $this->data->addBody(-140, $data);
    }

}

?>