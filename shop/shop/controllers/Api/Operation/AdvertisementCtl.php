<?php
    if(!defined('ROOT_PATH'))
    {
        exit('No Permission');
    }

    /*
     *@author weidp
     */
    class Api_Operation_AdvertisementCtl extends YLB_AppController
    {
        public function __construct(&$ctl,$met,$typ)
        {

            parent::__construct($ctl,$met,$typ);

        }

        public function advIndex()
        {
            $id = request_int('advs_id');
            $Goods_TypeBrandModel = new Operation_AdvsTypeModel();
            $Goods_ConGroupModel = new Operation_AdvertisementModel();
            $data  =  $Goods_TypeBrandModel->getTypeList();
            if($id)
            {
                $con = $Goods_ConGroupModel->getOneByWhere(array('id'=>$id));
                $id = $con['group_id'];
            }
            $result = array();
            $result[0]['id'] = 0;
            $result[0]['name'] = "广告位类型";
            foreach($data as $key=>$value)
            {
                $result[$key+1]['id'] = $value['id'];
                $result[$key+1]['name'] = $value['name'];
            }
            $data['group'] = $result;
            foreach ($result as $key=>$value)
            {
                if($value['id'] == $id){
                    $data['default'] = $key;
                }
            }
            $this->data->addBody(-140,$data);
        }

        public function shopAll(){
            $adv_con_id = request_int('advs_id');
            $Goods_AdvConModel = new Operation_AdvertisementModel();
            $Shop_BaseModel = new Shop_BaseModel();
            $shop_base = array_merge($Shop_BaseModel->getByWhere(array('shop_status'=>$Shop_BaseModel::SHOP_STATUS_OPEN)));
            $result = array();
            $data = array();
            $result[0]['shop_id'] = 0;
            $result[0]['shop_name'] = '选择店铺';
            foreach($shop_base as $key=>$value)
            {
                $result[$key+1]['shop_id']= $value['shop_id'];
                $result[$key+1]['shop_name'] = $value['shop_name'];
            }
            if($adv_con_id){
                $adv_con = $Goods_AdvConModel->getOne($adv_con_id);

                $shop_id = array_column($result,'shop_id');
              if($adv_con['shop_id']){
                  $data['default'] = array_search($adv_con['shop_id'],$shop_id,true);
                  if(!$data['default']){$data['default'] = 0;}
              }else{
                  $data['default'] = 0;
              }

            }else{
                $data['default'] = 0;
            }
           $data['shop'] = $result;

            $this->data->addBody(-140,$data);
        }

        public function AdvManage()
        {
            $id             = request_int('id');

            $advs           = new Operation_AdvsTypeModel();

            $adv_con        = new Operation_AdvertisementModel();

            $advs_type           = new Operation_AdvTypeNameModel();

            $data             = $adv_con->getOne($id);
            if($id){
                $data['adv']      = $advs->getOne($data['group_id']);
            }
            $data['group']    = $advs->getTypeList();

            $data['adv_type'] = array_merge($advs_type->getByWhere());
            $this->data->addBody(-140, $data);
        }

        /*
        * @prompt 广告位列表
        *
        */
        public function typeList($return = false)
        {
            if(request_int('page'))
            {
                $page = request_int('page');
            }
            else
            {
                $page = 0;
            }

            if(request_int('rows'))
            {
                $rows = request_int('rows');
            }
            else
            {
                $rows = 99999;
            }

            $Goods_TypeBrandModel   = new Operation_AdvsTypeModel();
            $data = $Goods_TypeBrandModel->getTypeBrandList(array(), array('id'=>'DESC'), $page, $rows);

            foreach($data as $key => $value)
            {
                if($value['unit'] == 'month')
                {
                    $arr[$key]['unit'] = '月';
                }
                elseif($value['unit']  == 'week')
                {
                    $arr[$key]['unit'] = '周';
                }
                elseif($value['unit'] == 'day')
                {
                    $arr[$key]['unit'] = '天';
                }
            }

            $this->data->addBody(-140, $data);
        }
        /*
        * @prompt 广告列表
        *
        */
        public function listBrand()
        {
            //分页操作
            if (request_int('page'))
            {
                $page = request_int('page');
            }
            else
            {
                $page = 0;
            }
            if (request_int('rows'))
            {
                $rows = request_int('rows');
            }
            else
            {
                $rows = 99999;
            }
            $skey                 = request_string('skey');
            $group_id		      = request_int('group_id');
            $Goods_BrandModel     = new Operation_AdvertisementModel();
            $Goods_TypeBrandModel = new Operation_AdvsTypeModel();
            $Shop_BaseModel       = new Shop_BaseModel();
            $cond_row             = array();

            //按广告名称查询操作
            if($skey)
            {
                $cond_row['name:like'] = '%'.$skey.'%';

            }

            if($group_id)
            {
                $cond_row['group_id'] = $group_id;

            }
            //调用getBrandList方法返回二位数组带参数

            $data_brand = $Goods_BrandModel->getBrandList($cond_row, array(), $page, $rows);

            //'item'是数据
            $rows       = $data_brand['items'];

            //销毁‘item’
            unset($data_brand['items']);

            foreach($rows as $key=>$value)
            {
                $group_name = $Goods_TypeBrandModel->getOne($value['group_id']);
                $rows[$key]['group_name'] = $group_name['name'];
                $shop_name = $Shop_BaseModel->getOne($value['shop_id']);
                $rows[$key]['shop_name'] = $shop_name['shop_name'];
            }

            $arr = array();

            //判断值是否为空
            if (!empty($rows))
            {
                //循环遍历$row,变更返回的值
                foreach ($rows as $key => $value)
                {
                    $id                           = $value['id'];
                    $arr[$key]['id']              = $id;
                    $arr[$key]['name']            = $value['name'];
                    $arr[$key]['pic_url']         = $value['pic_url'];
                    $arr[$key]['con_type']        = $value['con_type'];
                    $arr[$key]['group_id']        = $value['group_name'];
                    $arr[$key]['stime']           = $value['stime'];
                    $arr[$key]['etime']           = $value['etime'];
                    $arr[$key]['shop_id']         = $value['shop_name'];
                }

                $msg    = _('success');
                $status = 200;
            }
            else
            {
                $msg    = _('没有数据');
                $status = 250;
            }



            if($this->typ == 'json')
            {
                $data_brand['rows']  = $arr;

                $this->data->addBody(-140, $data_brand);
            }

        }


        /*
         * 删除广告
         */
        public function remove()
        {
            $Goods_BrandModel     = new Operation_AdvertisementModel();
            $id = request_int('id');
            if ($id)
            {
                $flag = $Goods_BrandModel->removeBrand($id);
                if ($flag)
                {
                    $msg    = _('success');
                    $status = 200;

                }
                else
                {
                    $msg    = _('failure');
                    $status = 250;
                }
            }
            $data['id'] = $id;
            $this->data->addBody(-140, $data, $msg, $status);
        }

        /*
         * 新增广告
         */
        public function add()
        {

            $Goods_BrandModel           = new Operation_AdvertisementModel();
            $goodsTypeBrandModel        = new Operation_AdvsTypeModel();

            $data                       = array();

            $data['id']                 = request_int('id');
            $data['group_id']           = request_int('group_id');
            $data['open_state']         = request_int('open_state');
            $data['advs_type']          = request_int('advs_type');
            $data['pic_url']            = request_string('pic_url');
            $data['stime']              = request_string('stime');
            $data['etime']              = request_string('etime');
            $data['name']               = request_string('name');
            $data['con']                = request_string('con');
            if($data['advs_type'] == 5){
                $data['url']                = request_string('keyword');
            }else{
                $data['keyword']                = request_string('keyword');
            }

            $flag                       = $Goods_BrandModel->addBrand($data, true);

            if ($flag)
            {
                $msg    = 'success';
                $status = 200;
            }
            else
            {
                $msg    = 'failure';
                $status = 250;
            }
            if($arr=$goodsTypeBrandModel->selectGid($data['shop_id']))
            {
                foreach($arr as $key => $value)
                {
                    $data['shop_id'] = $value['shop_name'];
                }
            }
            if($brr=$goodsTypeBrandModel->selectSid($data['group_id']))
            {
                foreach($brr as $key => $value)
                {
                    $data['group_id'] = $value['name'];
                }
            }


            $data['id']       = $flag;
            $data['brand_id'] = $flag;

            $this->data->addBody(-140, $data, $msg, $status);
        }
        /*
         * 新增广告位
       */
        public function addType()
        {
            $data = array();

            $OperationAdvsTypeModel = new Operation_AdvsTypeModel();

            $data['id']                 = request_int('id');
            $data['adv_type']           = request_int('adv_type');
            $data['price']              = request_int('price');
            $data['total']              = request_int('total');
            $data['name']               = request_string('name');
            $data['unit']               = request_string('unit');
            $data['width']              = request_int('width');
            $data['height']             = request_int('height');
            $data['date']               = date('Y-m-d',time());
            if($data['unit'] == '月')
            {
                $data['unit'] = 'month';

            }elseif($data['unit'] == '周')
            {
                $data['unit'] = 'week';
            }elseif($data['unit'] == '日')
            {
                $data['unit'] = 'day';
            }
            else
            {
                $msg = '增加数据失败，请输入月/周/日';
                $status = 250;
                $this->data->addBody('单位请按月/周/日输入', $msg, $status);
                die;
            }
            $flag = $OperationAdvsTypeModel->addTypeBrand($data, true);

            if ($flag)
            {
                $msg    = 'success';
                $status = 200;
            }
            else
            {
                $msg    = 'failure';
                $status = 250;
            }
            $data['id']       = $flag;
            if($data['unit'] == 'month')
            {
                $data['unit'] = '月';

            }elseif($data['unit'] == 'week')
            {
                $data['unit'] = '周';
            }elseif($data['unit'] == 'day')
            {
                $data['unit'] = '日';
            }

            $this->data->addBody(-140, $data, $msg, $status);
        }

        /*
           * 获取修改内容
           */
        public function getBrand()
        {
            $Goods_BrandModel = new Operation_AdvertisementModel();
            $Goods_typeModel  = new Operation_AdvsTypeModel();
            $id               = request_int('id');
            $data_brand       = $Goods_BrandModel->getByWhere(array('id' => $id));
            $data             = $data_brand[$id];
            if ($data)
            {
                $msg    = 'success';
                $status = 200;
            }
            else
            {
                $msg    = 'failure';
                $status = 250;
            }
            $this->data->addBody(-140, $data, $msg, $status);
        }
        /*
           * 获取广告位修改内容
           */
        public function getType()
        {
            $Goods_BrandModel = new Operation_AdvsTypeModel();
            $id               = request_int('id');
            $data_type        = $Goods_BrandModel->getByWhere(array('id' => $id));
            $data             = $data_type[$id];

            if($data['unit'] == 'month')
            {
                $data['unit']= '月';
            }
            elseif($data['unit'] == 'week')
            {
                $data['unit'] = '周';
            }
            else
            {
                $data['unit'] = '天';
            }
            if ($data)
            {
                $msg    = 'success';
                $status = 200;
            }
            else
            {
                $msg    = 'failure';
                $status = 250;
            }
            $this->data->addBody(-140, $data, $msg, $status);
        }
        /*
         * 修改广告
         */
        public function edit()
        {
            $Goods_BrandModel           = new Operation_AdvertisementModel();
            $goodsTypeBrandModel        = new Operation_AdvsTypeModel();
            $id                         = request_int('id');

            $data                       = array();
            $data['advs_type']          = request_int('advs_type');

            if($data['advs_type'] == 5){
                $data['url']            = request_string('keyword');
            }else{
                $data['keyword']            = request_string('keyword');
            }
            $data['open_state']         = request_int('open_state');
            $data['group_id']           = request_int('group_id');
            $data['stime']              = request_string('stime');
            $data['etime']              = request_string('etime');
            $data['name']               = request_string('name');
            $data['con']                = request_string('con');
            $base = $Goods_BrandModel->getOne($id);

            if(request_string('pic_url')){
                //检查是否有该图片在删除
                if($base['pic_url']){
                    unlink($base['pic_url']);
                }
                $data['pic_url']        = request_string('pic_url');
            }else{

                $data['pic_url']        = $base['pic_url'];
            }

            $flag = $Goods_BrandModel->editBrand($id, $data, false);

            if ($flag === false)
            {
                $msg    = _('failure');
                $status = 250;
            }
            else
            {
                $msg    = _('success');
                $status = 200;
            }

            if($arr=$goodsTypeBrandModel->selectGid($data['shop_id']))
            {
                foreach($arr as $key => $value)
                {
                    $data['shop_id'] = $value['shop_name'];
                }
            }
            if($brr=$goodsTypeBrandModel->selectSid($data['group_id']))
            {
                foreach($brr as $key => $value)
                {
                    $data['group_id'] = $value['name'];
                }
            }
            $data['id']              = $id;
            $data['brand_id']        = $id;
            $data['open_state'] = Operation_AdvertisementModel::$recommend_content[request_int('open_state')];
            $this->data->addBody(-140, $data, $msg, $status);
        }
        /*
         * 修改广告位
         */
        public function editType()
        {
            $Goods_BrandModel = new Operation_AdvsTypeModel();
            $id               = request_int('id');

            $data                    = array();
            $data['id']                 = request_int('id');
            $data['adv_type']           = request_int('adv_type');
            $data['price']              = request_int('price');
            $data['total']              = request_int('total');
            $data['name']               = request_string('name');
            $data['unit']               = request_string('unit');
            $data['width']              = request_int('width');
            $data['height']             = request_int('height');
            if($data['unit'] == '月')
            {
                $data['unit'] = 'month';

            }elseif($data['unit'] == '周')
            {
                $data['unit'] = 'week';
            }elseif($data['unit'] == '日')
            {
                $data['unit'] = 'day';
            }
            else
            {
                $msg = '修改数据失败，请输入月/周/日';
                $status = 250;
                $this->data->addBody('单位请按月/周/日输入', $msg, $status);
                die;
            }
            $flag = $Goods_BrandModel->editTypeBrand($id, $data, false);

            if ($flag === false)
            {
                $msg    = _('failure');
                $status = 250;
            }
            else
            {
                $msg    = _('success');
                $status = 200;
            }



            if($data['unit'] == 'month')
            {
                $data['unit'] = '月';

            }elseif($data['unit'] == 'week')
            {
                $data['unit'] = '周';
            }elseif($data['unit'] == 'day')
            {
                $data['unit'] = '日';
            }

            $data['id']              = $id;


            $this->data->addBody(-140, $data, $msg, $status);
        }



        //广告导出
        public function getBrandListExcel()
        {
            $con = $this->listBrand(true);
            $tit = array(
                '广告id',
                '广告名称',
                '广告图片',
                '所属广告位',
                '购买时间',
                '结束时间',
                '所属店铺'

            );
            $key = array(
                'id',
                'name',
                'pic_url',
                'group_id',
                'stime',
                'etime',
                'shop_id'
            );
            $this->excel("广告列表", $tit, $con, $key);
        }
        //广告位导出
        public function getAdvTypeListExcel()
        {
            $con = $this->typeList(true);
            $tit = array(
                '编号',
                '广告位名称',
                '广告类型',
                '创建时间',
                '价格',
                '单位',
                '数量'
            );
            $key = array(
                'id',
                'name',
                'adv_type',
                'date',
                'price',
                'unit',
                'total'
            );
            $this->excel("广告位列表",$tit,$con,$key);
        }

        function excel($title, $tit, $con, $key)
        {
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->getProperties()->setCreator("mall_new");
            $objPHPExcel->getProperties()->setLastModifiedBy("mall_new");
            $objPHPExcel->getProperties()->setTitle($title);
            $objPHPExcel->getProperties()->setSubject($title);
            $objPHPExcel->getProperties()->setDescription($title);
            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()->setTitle($title);

            $letter = array(
                'A',
                'B',
                'C',
                'D',
                'E',
                'F',
                'G'
            );
            foreach ($tit as $k1 => $v1)
            {
                $objPHPExcel->getActiveSheet()->setCellValue($letter[$k1] . "1", $v1);
            }
            foreach ($con as $k => $v)
            {
                foreach ($key as $k2 => $v2)
                {
                    $objPHPExcel->getActiveSheet()->setCellValue($letter[$k2] . ($k + 2), $v[$v2]);
                }
            }
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header("Content-Disposition: attachment; filename=\"$title.xls\"");
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            die();
        }

        function check(){

            $Goods_BrandModel = new Goods_BrandModel();

            $ids = request_string('id');
            $id_rows = explode(',',$ids);
            if(!empty($id_rows))
            {
                foreach($id_rows as $key => $value)
                {
                    $brand_id = $value;
                    $edit_row = array();
                    $edit_row['brand_enable'] = $Goods_BrandModel::ENABLE_TRUE;
                    $flag = $Goods_BrandModel->editBrand($brand_id, $edit_row);
                }
            }
            $this->data->addBody(-140, $id_rows);
        }

        //获取类型表字段
        public function getAdvsTypeList(){
            $id = request_int('advs_id');
            $Adv_TypeNameModel = new Operation_AdvTypeNameModel();
            $Goods_ConGroupModel = new Operation_AdvertisementModel();
            $data = array_merge($Adv_TypeNameModel->getByWhere());
            if($id)
            {
                $con = $Goods_ConGroupModel->getOneByWhere(array('id'=>$id));
                $id = $con['advs_type'];
            }
            $result = array();
            $result[0]['advs_type_id'] = 0;
            $result[0]['type_name'] = "请选择类型";
            foreach($data as $key=>$value)
            {
                $result[$key+1]['advs_type_id'] = $value['advs_type_id'];
                $result[$key+1]['type_name'] = $value['type_name'];
            }
            $data['advs_type_name'] = $result;

            foreach ($result as $key=>$value)
            {
                if($value['advs_type_id'] == $id){
                    $data['default'] = $key;
                }
            }

            $this->data->addBody(-140,$data);
        }

    }