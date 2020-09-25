<?php
if(!defined('ROOT_PATH'))
{
    exit('No Permission');
}
class Api_Operation_OpeningCtl extends YLB_AppController{
    public $OpeningModel;

    public function __construct(&$ctl,$met,$typ)
    {
        parent::__construct($ctl,$met,$typ);
        $this->OpeningModel = new Operation_OpeningModel();
    }
    public function showIndex(){
        $cond_row['level'] = 1;
        $data = $this->OpeningModel->listByWhere($cond_row);
        $this->data->addBody(-140,$data);
    }
    public function floorData(){
        $tempBaseModel = new Activity_TempBaseModel();
        $data = $tempBaseModel->getTempBaseList();
        foreach($data['items']  as $key=>$value){
            $data['items'][$key]['base_background_name'] = $tempBaseModel->temp_color[$value['base_background']][0];
        }
        if($data){
            $msg = 'success';
            $status = 200;
        }else{
            $msg = '没有数据';
            $status = 250;
        }
        $this->data->addBody(-140,$data,$msg,$status);
    }
    public function addFloor(){
        $base_id = request_int('base_id');
        $TempBaseModel = new Activity_TempBaseModel();
        if($base_id){
            $base = $TempBaseModel->getOneByWhere(array('base_id'=>$base_id));
            $data = $TempBaseModel->TempColor($base['temp_id']);
            $data['base'] = $base;
        }else{
            $data = $TempBaseModel->TempColor();
        }
        $this->data->addBody(-140,$data);
    }
    public function editFloor(){
        $base_id = request_int('base_id');
        $opening_id = request_int('opening_id');
        $background = request_string('page_color');
        $temp_id = request_int('layout_id');
        $tempBaseModel = new Activity_TempBaseModel();
        $base = $this->OpeningModel->getOne($opening_id);
        if($base_id){
            $field_row['temp_id'] = $temp_id;
            $field_row['base_name'] = $base['opening_name'];
            $field_row['base_background'] = $background;
            $field_row['base_rgb'] = $tempBaseModel->temp_color[$background]['1'];
            $tempBaseModel->editTempBase($base_id,$field_row,false);
        }else{
            $field_row['temp_id'] = $temp_id;
            $field_row['base_name'] = $base['opening_name'];
            $field_row['base_background'] = $background;
            $field_row['base_rgb'] = $tempBaseModel->temp_color[$background]['1'];
            $base_id = $tempBaseModel->addTempBase($field_row,true);
            if($base_id){
                $this->OpeningModel->editOpening($opening_id,array('base_id'=>$base_id));
            }
        }
        $data = array();
        $this->data->addBody(-140,$data);
    }
    public function getTier(){
        $opening_id = request_int('opening_id');
        $data = $this->OpeningModel->getOne($opening_id);
        $this->data->addBody(-140,$data);
    }
    public function editTier(){
        $opening_id = request_int('opening_id');
        $cond_row['opening_name'] = request_string('opening_name');
        $cond_row['wap_tit_image'] = request_string('wap_tit_image');
        $cond_row['update_time'] = date('Y-m-d H:i:s',time());
        $flag = $this->OpeningModel->editOpening($opening_id,$cond_row,false);
        if($flag){
            $status = 200;
            $msg = '修改成功';
        }else{
            $status = 250;
            $msg = '修改失败';
        }
        $data = array();
        $this->data->addBody(-140,$data,$msg,$status);
    }
    public function uploadFloor(){
        $base_id = request_int('base_id');
        $tempBaseModel = new Activity_TempBaseModel();
        $tempModel = new Activity_TempModel();
        $GoodsCommonModel = new Goods_CommonModel();
        if($base_id){
            $base_data = $tempBaseModel->getOne($base_id);
            $data = $tempModel->getOne($base_data['temp_id']);
            if($data['temp_main_title'] == $data['temp_assis_title']){
                $data['base_assis_title'] = explode(',',$base_data['base_assis_title']);
                $data['base_main_title'] = explode(',',$base_data['base_main_title']);
            }else{
                if($data['temp_main_title']){
                    $data['base_main_title'] = explode(',',$base_data['base_main_title']);
                }
            }
            if($base_data['base_goods_cont']){
                $goods = explode(',',$base_data['base_goods_cont']);
                $common_list = array();
                foreach($goods as $ks=>$vs){
                    if($vs){
                        $common_list[]= $GoodsCommonModel->getOneMyId(array('common_id'=>$vs));
                    }
                }
                if(!empty($common_list)){
                    $common_base = array();
                    foreach($common_list as $key=>$value){
                        $common_base[$key]['goods_id'] = $value['common_id'];
                        $common_base[$key]['goods_name'] = $value['common_name'];
                        $common_base[$key]['goods_price'] = $value['common_shared_price'];
                        $common_base[$key]['goods_image'] = $value['common_image'];
                    }
                    $data['base_id'] = $base_id;
                    $data['goods_list'] = array_values($common_base);
                    $data['now_num'] = count($data['goods_list']);
                    $status = 200;
                    $msg = '请求成功';
                }
            }else{
                $data['base_id'] = $base_id;
                $data['now_num'] = 0;
                $status = 200;
                $msg = '请求成功';
            }
        }else{
            $status = 250;
            $msg = '参数有误';
            $data = array();
        }

        $this->data->addBody(-140,$data,$msg,$status);
    }
    public function uploadGoods(){
        $opening_id = request_int('opening_id');
        if($opening_id){
            $data = $this->OpeningModel->getOne($opening_id);

            $GoodsCommonModel =  new Goods_CommonModel();
            if(!empty($data)){
                $common_ids = explode(',',$data['opening_data']);
                $common_list = array();
                foreach($common_ids as $ks=>$vs){
                    if($vs){
                        $common_list[] = $GoodsCommonModel->getOneMyId(array('common_id'=>$vs));
                    }
                }

                if(!empty($common_list)){
                    $common_base = array();
                    foreach($common_list as $key=>$value){
                        $common_base[$key]['goods_id'] = $value['common_id'];
                        $common_base[$key]['goods_name'] = $value['common_name'];
                        $common_base[$key]['goods_price'] = $value['common_shared_price'];
                        $common_base[$key]['goods_image'] = $value['common_image'];
                    }
                    $data['goods_list'] = array_values($common_base);
                }
                $status = 200;
                $msg = '请求成功';
            }else{
                $status = 250;
                $msg = '参数有误';
                $data = array();
            }

        }else{
            $status = 250;
            $msg = '参数有误';
            $data = array();
        }
        $this->data->addBody(-140,$data,$msg,$status);
    }
    public function editGoods(){
      $opening_id = request_int('opening_id');
      if(request_row('opening_data')) {
          $update_data['opening_data'] = trim(implode(',', request_row('opening_data')), ',');
      }else{
          $update_data['opening_data'] = null;
      }
      $flag = $this->OpeningModel->editOpening($opening_id,$update_data);
        if ($flag !== false)
        {
            $msg    = _('success');
            $status = 200;
        }
        else
        {
            $msg    = _('failure');
            $status = 250;
        }

        $this->data->addBody(-140, array(), $msg, $status);
    }
    public function editFloorGoods(){
        $base_id = request_int('base_id');
        $tempBaseModel = new Activity_TempBaseModel();
        $tempModel = new Activity_TempModel();
        $base = $tempBaseModel->getOne($base_id);
        $temp = $tempModel->getOne($base['temp_id']);
        if($temp['temp_main_title'] == $temp['temp_assis_title']){
            $update_data['base_main_title']= trim(implode(request_row('base_main'),','),',');
            $update_data['base_assis_title'] = trim(implode(request_row('base_assis'),','),',');
        }else{
            if($temp['temp_main_title']){
                $update_data['base_main_title']= trim(implode(request_row('base_main'),','),',');
            }
        }

        $update_data['base_goods_cont'] = trim(implode(',',request_row('base_goods')),',');
        $tempBaseModel->editTempBaseFalse($base_id,$update_data);
        $base_data = $tempBaseModel->getOne($base_id);

        if($base_data['base_goods_cont'] == $update_data['base_goods_cont']){
            $msg    = _('success');
            $status = 200;
        }else{
            $msg    = _('failure');
            $status = 250;
        }
        $data = array();
        $this->data->addBody(-140,$data,$msg,$status);
    }
    public function delFloor(){
        $base_id = request_int('base_id');
        $tempBaseModel = new Activity_TempBaseModel();
        if($base_id){
            $opening = $this->OpeningModel->getOneByWhere(array('base_id'=>$base_id));
            $this->OpeningModel->editOpening($opening['opening_id'],array('base_id'=>0));
            $tempBaseModel->sql->startTransactionDb();//事务开启
            $flag = $tempBaseModel->removeTempBase($base_id);
            if($flag && $tempBaseModel->sql->commitDb()){
                $msg    = _('删除成功！');
                $status = 200;
            }else{
                $msg    = _('删除失败！');
                $status = 250;
            }
            $data = array();
        }
        $this->data->addBody(-140,$data,$msg,$status);
    }
    public function upHeadImage(){
        $flag = false;
        $AdvertisementModel = new Operation_AdvertisementModel();
        $name = array('opening1','opening2');
        $opening_base = request_row('opening');

        if(count($opening_base)){
            if($adv_con = array_merge($AdvertisementModel->getByWhere(array('name:IN'=>$name)))){
                //判断只有一个添加的情况下
                if(count($adv_con)==2){
                    for($i=0;$i< count($opening_base);$i++){
                        $cond_row['name'] = 'opening'.($i+1);
                        $cond_row['pic_url'] = $opening_base['opening_image_'.($i+1)];
                        if($adv_con[$i]['pic_url'] != $cond_row['pic_url']){
                            $flag = $AdvertisementModel->editBrand($adv_con[$i]['id'],$cond_row,false);
                        }else{
                            $flag = true;
                        }
                    }
                }else{
                    foreach ($adv_con as $key=>$value){
                        $arr = $value;
                    }
                    if($arr['name'] == 'opening1'){
                        if($opening_base['opening_image_1'] != $arr['pic_url']){
                            $cond_row['name'] = 'opening1';
                            $cond_row['pic_url'] = $opening_base['opening_image_1'];
                            $flag = $AdvertisementModel->editBrand($arr['id'],$cond_row,false);
                        }else{
                            $flag = true;
                        }
                        $add_row['name'] = 'opening2';
                        $add_row['pic_url'] = $opening_base['opening_image_2'];
                        $flag = $AdvertisementModel->addBrand($add_row,true);
                    }else{
                        if($opening_base['opening_image_2'] != $arr['pic_url']){
                            $cond_row['name'] = 'opening2';
                            $cond_row['pic_url'] = $opening_base['opening_image_2'];
                            $flag = $AdvertisementModel->editBrand($arr['id'],$cond_row,false);
                        }else{
                            $flag = true;
                        }
                        $add_row['name'] = 'opening1';
                        $add_row['pic_url'] = $opening_base['opening_image_1'];
                        $flag = $AdvertisementModel->addBrand($add_row,true);
                    }
                }
            }else{
                for($i=0;$i<count($opening_base);$i++){
                    $cond_row['name'] = 'opening'.($i+1);
                    $cond_row['pic_url'] = $opening_base['opening_image_'.($i+1)];
                    $flag = $AdvertisementModel->addBrand($cond_row,true);
                }
            }
        }

        if($flag){
            $status = 200;
            $msg ='success';
        }else{
            $status = 250;
            $msg ='failed';
        }
        $data = array();
        $this->data->addBody(-140,$data,$msg,$status);
    }
    public function headImage(){
        $AdvertisementModel = new Operation_AdvertisementModel();
        $name = array('opening1','opening2');
        $arr = $AdvertisementModel->getByWhere(array('name:IN'=>$name));
        $data = array();
        if(count($arr)){
            foreach($arr as $key=>$value){
                $data[$value['name']] = $value;
            }
        }
        $this->data->addBody(-140,$data);
    }
    //下拉框数据
    public function getTitleSe(){
        $base_id = request_int('base_id');
        if($base_id){
            $data = array_merge($this->OpeningModel->getByWhere(array('base_id'=>$base_id)));
            foreach($data as $key=>$value){
                if($value['base_id'] == $base_id){
                    $data[$key]['default'] = $key;
                }
            }
        }else{
            $data = array_merge($this->OpeningModel->getByWhere(array('parent_id'=>0,'base_id'=>0)));
        }

        $this->data->addBody(-140,$data);
    }

}