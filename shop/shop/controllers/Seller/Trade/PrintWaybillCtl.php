<?php if(!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * 电子面单接口
 *
 * @category   Game
 * @package    User
 * @author     weidp
 * @version    1.0
 * @todo
 */

class Seller_Trade_PrintWaybillCtl extends Seller_Controller
{
    public $logisticsWaybillModel = null;
    public $logisticsExpressModel = null;
    public $shopExpressModel      = null;
    public $Waybill_ExpressModel  = null;
    public $Waybil_UserBaseModel  = null;
    private $EBusinessID;
    private $AppKey;
    private $ApiUrl;
    private $IpServiceUrl;

    /**
     * Constructor
     *
     * @param  string $ctl 控制器目录
     * @param  string $met 控制器方法
     * @param  string $typ 返回数据类型
     * @access public
     */
    public function __construct(&$ctl, $met, $typ)
    {
        parent::__construct($ctl, $met, $typ);

        $this->logisticsWaybillModel = new Waybill_TplModel();
        $this->logisticsExpressModel = new ExpressModel();
        $this->shopExpressModel      = new Shop_ExpressModel();
        $this->Waybill_ExpressModel  = new Waybill_ExpressModel();
        $this->Waybil_UserBaseModel  = new Waybill_UserBaseModel();
        $this->EBusinessID = Web_ConfigModel::value('kuaidiniao_e_business_id');
        $this->AppKey = Web_ConfigModel::value('kuaidiniao_app_key');
        $this->ApiUrl = 'http://www.kdniao.com/External/PrintOrder.aspx';
        $this->IpServiceUrl = 'http://www.kdniao.com/External/GetIp.aspx';
    }

    //电子面单首页
    public function waybillIndex()
    {
        if (request_string('op') == 'edit' && $waybill_id = request_int('waybill_id')) {

            if(filter_var($waybill_id,FILTER_VALIDATE_INT)){
                $data = array();
                $data['express_cat'] = $this->Waybill_ExpressModel->getExpressTempLayout();
                $data['userBase'] = $this->Waybil_UserBaseModel->getOneByWhere(array('waybill_id'=>$waybill_id));
                $first = $data['express_cat'][$data['userBase']['wex_id']];
                unset($data['express_cat'][$data['userBase']['wex_id']]);
                array_unshift($data['express_cat'],$first);

                $data['express_cat'] = json_encode($data['express_cat']);
                $this->view->setMet('editWaybill');
            }

        } else {

            $YLB_Page           = new YLB_Page();
            $YLB_Page->listRows = request_int('listRows')?request_int('listRows'):10;
            $rows              = $YLB_Page->listRows;
            $offset            = request_int('firstRow', 0);
            $page              = ceil_r($offset / $rows);
            $cond_row = array();
            $order_row = array();
            $cond_row['user_id'] = Perm::$userId;
            $order_row['addtime'] = 'DESC';
            $data = $this->Waybil_UserBaseModel->getUserBaseList($cond_row,$order_row,$page,$rows);

            $YLB_Page->totalRows = $data['totalsize'];
            $page_nav           = $YLB_Page->prompt();
        }

        if ($this->typ == 'json') {

            $this->data->addBody(-140,$data);

        } else {

            include $this->view->getView();
        }

    }
    //添加账号显示页面
    public function addWaybill()
    {
        $data = array();
        $data['express_cat'] = $this->Waybill_ExpressModel->getExpressTempLayout();
        if ($this->typ == 'json')
        {
            $this->data->addBody(-140,$data);
        } else {
            $data['express_cat'] = json_encode($data['express_cat']);
            include $this->view->getView();
        }

    }
    //添加数据提交
    public function addWaybillCont()
    {
        $flag = true;
        $error_msg = '';
        $filter_row = array();
        $filter_row['wex_id']   = request_int('waybill_code_id');
        $filter_row['tempsize'] = request_int('waybill_temp_id');
        $filter_row['waybill_number'] = request_string('waybill_number');
        $filter_row['waybill_passwd'] = request_string('waybill_passwd');
        $filter_row['month_code'] = request_string('month_code');
        $filter_row['printer'] = request_string('printer_name');
        $filter_row['customerid'] = request_string('customerid');
        if (filter_var($filter_row['wex_id'],FILTER_VALIDATE_INT) && $filter_row['wex_id'])
        {
            $express_oneBase = $this->Waybill_ExpressModel->getOneByWhere(array('wex_id'=>$filter_row['wex_id']));

        } else {
            $error_msg = '请选择一个快递公司';
            $flag = false;
        }

        if(!$filter_row['printer']){
            $error_msg = '条码打印机名称不能为空';
            $flag = false;
        }

        if (!$filter_row['waybill_number'] || !$filter_row['waybill_passwd']) {

            if (!in_array($express_oneBase['wex_code'],$this->Waybill_ExpressModel->number)) {
                $error_msg = '请输入账号和密码';
                $flag = false;
            }
        }

        if ($flag) {
            $age = array(
                'wex_id' => FILTER_VALIDATE_INT,
                'tempsize' => FILTER_VALIDATE_INT,
                'waybill_number' => FILTER_SANITIZE_STRING,
                'waybill_passwd' => FILTER_SANITIZE_STRING,
                'month_code' => FILTER_SANITIZE_STRING,
                'printer' => FILTER_SANITIZE_STRING,
                'customerid'=> FILTER_SANITIZE_STRING
            );

            $base = filter_var_array($filter_row,$age);
            $insert_row = array();
            $insert_row['wex_id'] = $base['wex_id'];
            $insert_row['tempsize'] = $base['tempsize'];
            $insert_row['waybill_number'] = $base['waybill_number'];
            $insert_row['waybill_passwd'] = $base['waybill_passwd'];
            $insert_row['month_code'] = $base['month_code'];
            $insert_row['printer'] = $base['printer'];
            $insert_row['customerid'] = $base['customerid'];
            $insert_row['addtime'] = date('Y-m-d H:i:s',time());
            $insert_row['user_id'] = Perm::$userId;
            $insert_row['wex_code'] = $express_oneBase['wex_code'];
            $insert_row['wex_name'] = $express_oneBase['wex_name'];


            $flag = $this->Waybil_UserBaseModel->addUserBase($insert_row,true);

        }

        if ($flag) {
            $error_msg = '添加成功';
            $status = 200;

        } else {

            $status = 250;
        }
        $data = array();
        $this->data->addBody(-140, $data, $error_msg, $status);
    }
    //修改数据提交
    public function editWaybillCont()
    {
        $flag = true;
        $error_msg = '';
        $filter_row = array();
        $waybill_id = request_int('waybill_id');
        $filter_row['wex_id']   = request_int('waybill_code_id');
        $filter_row['tempsize'] = request_int('waybill_temp_id');
        $filter_row['waybill_number'] = request_string('waybill_number');
        $filter_row['waybill_passwd'] = request_string('waybill_passwd');
        $filter_row['month_code'] = request_string('month_code');
        $filter_row['printer'] = request_string('printer_name');
        $filter_row['customerid'] = request_string('customerid');
        if (filter_var($waybill_id,FILTER_VALIDATE_INT) && $filter_row['wex_id'] && $waybill_id)
        {
            $express_oneBase = $this->Waybill_ExpressModel->getOneByWhere(array('wex_id'=>$filter_row['wex_id']));

        } else {
            $error_msg = '请选择一个快递公司';
            $flag = false;
        }

        if(!$filter_row['printer']){
            $error_msg = '条码打印机名称不能为空';
            $flag = false;
        }

        if (!$filter_row['waybill_number'] || !$filter_row['waybill_passwd']) {

            if (!in_array($express_oneBase['wex_code'],$this->Waybill_ExpressModel->number)) {
                $error_msg = '请输入账号和密码';
                $flag = false;
            }
        }

        if ($flag) {
            $age = array(
                'wex_id' => FILTER_VALIDATE_INT,
                'tempsize' => FILTER_VALIDATE_INT,
                'waybill_number' => FILTER_SANITIZE_STRING,
                'waybill_passwd' => FILTER_SANITIZE_STRING,
                'month_code' => FILTER_SANITIZE_STRING,
                'printer' => FILTER_SANITIZE_STRING,
                'customerid'=> FILTER_SANITIZE_STRING
            );

            $base = filter_var_array($filter_row,$age);
            $insert_row = array();
            $insert_row['wex_id'] = $base['wex_id'];
            $insert_row['tempsize'] = $base['tempsize'];
            $insert_row['waybill_number'] = $base['waybill_number'];
            $insert_row['waybill_passwd'] = $base['waybill_passwd'];
            $insert_row['month_code'] = $base['month_code'];
            $insert_row['printer'] = $base['printer'];
            $insert_row['customerid'] = $base['customerid'];
            $insert_row['user_id'] = Perm::$userId;
            $insert_row['addtime'] = date('Y-m-d H:i:s',time());
            $insert_row['wex_code'] = $express_oneBase['wex_code'];
            $insert_row['wex_name'] = $express_oneBase['wex_name'];

            $this->Waybil_UserBaseModel->editUserBase($waybill_id,$insert_row);

        }

        if ($flag) {
            $error_msg = '修改成功';
            $status = 200;

        } else {

            $status = 250;
        }
        $data = array();
        $this->data->addBody(-140, $data, $error_msg, $status);
    }
    //删除账号
    public function removeWaybill()
    {
        $waybill_id = request_int('id');
        if(filter_var($waybill_id,FILTER_VALIDATE_INT) && $waybill_id){
           $waybill_userbase = $this->Waybil_UserBaseModel->getOne($waybill_id);
           if ($waybill_userbase['user_id'] == Perm::$userId)
           {
               $this->Waybil_UserBaseModel->sql->startTransactionDb();//事务开启
               $flag = $this->Waybil_UserBaseModel->removeUserBase($waybill_id);
               if ($flag)
               {
                   if ($this->Waybil_UserBaseModel->sql->commitDb())
                   {
                       $msg = '删除成功';
                       $status = 200;
                   } else {
                       $msg = '删除失败';
                       $status = 250;
                   }
               } else {
                   $msg = '删除失败';
                   $status = 250;
               }
           } else {
               $msg = '删除失败';
               $status = 250;
           }
        }
        $data['waybill_id'] = $waybill_id;
        $this->data->addBody(-140, $data, $msg, $status);
    }


    //提交订单账号，判断其状态
    public function verifyWaybill()
    {
        $Order_BaseModel = new Order_BaseModel();
        $Shop_ShippingModel = new Shop_ShippingAddressModel();
        $Waybill_UserBaseModel = new Waybill_UserBaseModel();
        $Base_DistrictModel = new Base_DistrictModel();
        $Order_GoodsModel  = new Order_GoodsModel();
        //设定传递参数为
        $flag = true;
        $order_id_rows = request_row('order_id');
        //需要过滤的特殊字符
        $rule = array("'",'"',"#","&","+","<",">");

        if ($order_id_rows && is_array($order_id_rows))
        {
            $cond_row['order_id:IN'] = $order_id_rows;
        }
        $order_list = $Order_BaseModel->getDetailList($cond_row);

        $shop_id = Perm::$shopId;
        $user_id = Perm::$userId;
        $cache_redis_list = [];

        if ($order_list['items'])
        {
            //开始判断和添加
            foreach ($order_list['items'] as $key=>$value)
            {
                if ($value['order_status'] == Order_StateModel::ORDER_PAYED || $value['order_status'] == Order_StateModel::ORDER_WAIT_PREPARE_GOODS)
                {
                    if ($value['order_refund_status'] == 0 && $value['order_return_status'] == 0)
                    {
                        //判断发货地址
                        if ($value['order_seller_address'] && $value['order_seller_contact'])
                        {
                            //若订单有发货地址则，判断订单中地址，取表中发货地地址
                            $address =  explode(' ',$value['order_seller_address']);
                            $det_address = trim(array_pop($address));
                            $new_address = trim(implode(' ',$address));
                            $address_row['shipping_address_contact'] = $value['order_seller_name'];
                            $address_row['shop_id'] = $shop_id;
                            $address_row['shipping_address_area'] = $new_address;
                            $address_row['shipping_address_address'] = $det_address;
                            $address_row['shipping_address_phone'] = $value['order_seller_contact'];
                            $order_address = $Shop_ShippingModel->getOneByWhere($address_row);
                            //判断发货地址，若没失效则用订单发货地址
                            if ($order_address)
                            {
                                $seller_address = $order_address;
                            }
                            else
                            {
                                if ($default_address = $Shop_ShippingModel->getOneByWhere(array('shop_id'=>$shop_id,'shipping_address_default'=> 1)))
                                {
                                    $seller_address = $default_address;
                                }
                                else
                                {
                                    if ($address_list = $Shop_ShippingModel->getByWhere(array('shop_id'=>$shop_id)))
                                    {
                                        $seller_address = current($address_list);
                                    }
                                    else
                                    {
                                        $msg = '请添加发货地址';
                                        $flag = false;
                                        break;
                                    }
                                }
                            }

                        }
                        else
                        {
                            $address_list = $Shop_ShippingModel->getByWhere(array('shop_id'=>$shop_id));
                            //判断是否有发货地址
                            if ($address_list)
                            {
                                $default_address = $Shop_ShippingModel->getOneByWhere(array('shop_id'=>$shop_id,'shipping_address_default'=> 1));
                                //判断是否有默认发货地
                                if ($default_address)
                                {
                                    //若有默认发货地则用默认发货地
                                    $seller_address = $default_address;
                                }
                                else
                                {
                                    //多个发货地且无默认发货地，取列表第一个发货地
                                    $seller_address = current($address_list);
                                }
                            }
                            else
                            {
                                $msg = '请添加发货地址';
                                $flag = false;
                                break;
                            }
                        }

                        //获取收货人详细地址
                        $re_address = explode(' ',$value['order_receiver_address']);
                        $re_det_address = trim(array_pop($re_address));

                        //判断是否绑定快递公司
                        $Express_userBase = $Waybill_UserBaseModel->getByWhere(array('user_id'=>$user_id));

                        if (!$Express_userBase)
                        {
                            $msg  = '请先绑定电子面单账号';
                            $flag = false;
                            break;
                        }

                        //拼接打印面单需要的数据
                        //订单号
                        $cache_redis_list[$key]['OrderCode'] = $value['order_id'];
                        //快递类型  只有1 统一为1
                        $cache_redis_list[$key]['ExpType'] = 1;
                        //寄件人姓名
                        $cache_redis_list[$key]['Sender']['Name'] = str_replace($rule,'',$seller_address['shipping_address_contact']);
                        //寄件人手机号
                        $cache_redis_list[$key]['Sender']['Mobile'] = $seller_address['shipping_address_phone'];
                        //寄件人省/市
                        $ProvinceName = $Base_DistrictModel->getOneByWhere(array('district_id'=>$seller_address['shipping_address_province_id']));
                        $cache_redis_list[$key]['Sender']['ProvinceName'] = $ProvinceName['district_name'];
                        //寄件人市
                        $CityName = $Base_DistrictModel->getOneByWhere(array('district_id'=>$seller_address['shipping_address_city_id']));
                        $cache_redis_list[$key]['Sender']['CityName'] = $CityName['district_name'];
                        //寄件人区/镇
                        $ExpAreaName = $Base_DistrictModel->getOneByWhere(array('district_id'=>$seller_address['shipping_address_area_id']));
                        $cache_redis_list[$key]['Sender']['ExpAreaName'] = $ExpAreaName['district_name'];
                        //寄件人详细地址
                        $cache_redis_list[$key]['Sender']['Address'] = str_replace($rule,'',$seller_address['shipping_address_address']);
                        $cache_redis_list[$key]['Sender']['PostCode'] = '100076';

                        $cache_redis_list[$key]['Receiver']['Name'] = str_replace($rule,'',$value['order_receiver_name']) ;
                        $cache_redis_list[$key]['Receiver']['Mobile'] = $value['order_receiver_contact'];
                        $cache_redis_list[$key]['Receiver']['ProvinceName'] = $re_address[0];
                        $cache_redis_list[$key]['Receiver']['CityName'] = $re_address[1];
                        $cache_redis_list[$key]['Receiver']['ExpAreaName'] = $re_address[2];
                        $cache_redis_list[$key]['Receiver']['Address'] = str_replace($rule,'',$re_det_address);
                        $order_goods = $Order_GoodsModel->getOneByWhere(array('order_id'=>$value['order_id']));
                        $cache_redis_list[$key]['Commodity'][]['GoodsName'] = str_replace($rule,'',$order_goods['goods_name']);

                        //$cache_redis_list[$key]['TemplateSize'] = '150';
                    }
                    else
                    {
                        $msg = '申请退款的商品不能发货';
                        $flag = false;
                        break;
                    }

                }
                else
                {
                    $msg = '请勾选已付款和待发货订单';
                    $flag = false;
                    break;
                }
            }

           if($flag)
           {
               /*//将数据加入缓存 保证缓存 key 唯一标识
               $redis_key = md5($user_id.'ts168_waybill'.$shop_id);
               $cache_redis_list = json_encode($cache_redis_list);

               try
               {
                   $memcache = new Memcache;
                   $memcache->connect($_SERVER['SERVER_ADDR'],11211);
               }
               catch (Exception $e)
               {
                   echo 'Message'.$e->getMessage();
               }

               //设置有效期3分钟
               if ($memcache->set($redis_key,$cache_redis_list,MEMCACHE_COMPRESSED,180))
               {
                   $msg = '提交成功';

               }
               else
               {
                   $msg = '提交失败';
                   $flag = false;
               }*/

               //zhenzh 20180911 修改
               $cache_key = md5($user_id.'ts168_waybill'.$shop_id);
               $Cache = YLB_Cache::create('default');
               if ($Cache->save($cache_redis_list, $cache_key))
               {
                   $msg = '提交成功';
               }
               else
               {
                   $msg = '提交失败';
                   $flag = false;
               }
           }
        }
        else
        {
            $msg = '参数错误';
        }

        if ($flag)
        {
            $data = array();
            $data['way_key'] = md5('setting_waybill_shipments');
            $status = 200;
        }
        else
        {
            $data = array();
            $status = 250;
        }

        $this->data->addBody(-140,$data,$msg,$status);
    }

    //选择快递后处理接口
    public function disposeWaybill()
    {
        $Waybill_UserBaseModel = new Waybill_UserBaseModel();
        $Waybill_ExpressModel  = new Waybill_ExpressModel();
        $PostCode_CityModel   = new PostCode_CityModel();
        $Waybill_KdBirdModel = new Waybill_KdBirdModel();
        $ExpressModel   = new ExpressModel();
        $OrderBaseModel = new Order_BaseModel();

        $flag = true;
        $msg = '';
        $waybill_id = request_int('waybill_code_id');
        $pay_type = request_int('pay_type');
        $user_id = Perm::$userId;
        $shop_id = Perm::$shopId;

        /*$redis_key = md5($user_id.'ts168_waybill'.$shop_id);
        try
        {
            $memcache = new Memcache;
            $memcache->connect($_SERVER['SERVER_ADDR'],11211);
        }
        catch (Exception $e)
        {
            echo 'Message'.$e->getMessage();
            $flag = false;
            $msg = '缓存服务连接失败';
        }
        $eorder = $memcache->get($redis_key);*/

        //zhenzh 20180911 修改
        $cache_key = md5($user_id.'ts168_waybill'.$shop_id);
        $Cache = YLB_Cache::create('default');
        $order_list = $Cache->get($cache_key);

        $printer_order = [];
        if ($order_list)
        {
           if(filter_var($waybill_id,FILTER_VALIDATE_INT) && filter_var($pay_type,FILTER_VALIDATE_INT) && $waybill_id && $pay_type && $pay_type < 4)
           {
               $Waybill_Base = $Waybill_UserBaseModel->getOneByWhere(array('waybill_id'=>$waybill_id));
               //$order_list = json_decode($eorder,true);

               if($pay_type == 3)
               {
                   if (!$Waybill_Base['month_code'])
                   {
                        $msg = '请先添加月结号';
                        $flag = false;
                   }
               }
               if (in_array($Waybill_Base['wex_code'],$Waybill_ExpressModel->number))
               {
                   if ($Waybill_Base['waybill_number'] && $Waybill_Base['waybill_passwd'])
                   {
                      $waybill_number = $Waybill_Base['waybill_number'];
                      $waybill_passwd = $Waybill_Base['waybill_passwd'];
                   }
               }
               else
               {
                   if ($Waybill_Base['waybill_number'] && $Waybill_Base['waybill_passwd'])
                   {
                       $waybill_number = $Waybill_Base['waybill_number'];
                       $waybill_passwd = $Waybill_Base['waybill_passwd'];
                   }
                   else
                   {
                       $flag = false;
                       $msg ='请添加电子面单商户账号和密码';
                   }
               }

               if ($flag)
               {
                   if (json_last_error() == JSON_ERROR_NONE)
                   {
                       foreach($order_list as $key=>$value)
                       {
                           $order_list[$key]['ShipperCode'] = $Waybill_Base['wex_code'];
                           $order_list[$key]['PayType'] = $pay_type;
                           if ($waybill_number && $waybill_passwd)
                           {
                               $order_list[$key]['CustomerName'] = $waybill_number;
                               $order_list[$key]['CustomerPwd'] = $waybill_passwd;
                           }

                           if (in_array($Waybill_Base['wex_code'],$Waybill_ExpressModel->postcode))
                           {
                               $sender_post_base = $PostCode_CityModel->getOneByWhere(array('city_name'=>$value['Sender']['CityName']));
                               $receiver_post_base = $PostCode_CityModel->getOneByWhere(array('city_name'=>$value['Receiver']['CityName']));

                               if ($sender_post_base)
                               {
                                   $order_list[$key]['Sender']['PostCode'] = $sender_post_base['province_id'];
                               }

                               if ($receiver_post_base)
                               {
                                   $order_list[$key]['Receiver']['PostCode'] = $receiver_post_base['province_id'];
                               }
                           }

                           if($pay_type == 3){$order_list[$key]['MonthCode'] = $Waybill_Base['month_code'];}

                           //此处开始与快递鸟对接
                           $jsonParam = $Waybill_KdBirdModel->JSON($order_list[$key]);

                           $result = $Waybill_KdBirdModel->submitEOrder($jsonParam);

                           if ($result['state'])
                           {
                               //成功下单订单号则记住订单号，更改订单状态
                               $current_time                       = time();
                               $confirm_order_time                 = YLB_Registry::get('confirm_order_time');
                               $update_data['order_shipping_time'] = date('Y-m-d H:i:s', $current_time);
                               $update_data['order_receiver_date'] = date('Y-m-d H:i:s', $current_time + $confirm_order_time);
                               $cond_order['order_status'] = Order_StateModel::ORDER_WAIT_CONFIRM_GOODS;
                               $cond_order['order_shipping_code'] = $result['LogisticCode'];
                               $express_id = $ExpressModel->getOneByWhere(array('express_pinyin'=>$result['ShipperCode']));
                               $cond_order['order_shipping_express_id'] = $express_id['express_id'];

                               //更改订单状态，变成已发货
                               $OrderBaseModel->editBase($result['OrderCode'],$cond_order);
                               //记录成功订单，并且拼接数据
                               $printer_order[] = ['OrderCode'=>$result['OrderCode'],'PortName'=>$Waybill_Base['printer']];

                           }
                           else
                           {
                               //存在错误则停止下单，返回错误信息
                               $flag = false;
                               $msg = $result['Reason'];
                               break;
                           }

                       }

                       //根据拼接的数据设置打印
                       if($flag && $printer_order)
                       {
                           $print_str = $Waybill_KdBirdModel->JSON($printer_order);

                           /*//将数据加入缓存 保证缓存 key 唯一标识
                           $printer_key = md5($user_id.'ts168_waybill_printer'.$shop_id);
                           //不设置有效期等打印删除
                           if ($memcache->set($printer_key,$print_str,MEMCACHE_COMPRESSED))
                           {
                               $msg = '提交成功';

                           } else {
                               $msg = '提交失败';
                               $flag = false;
                           }*/

                           //zhenzh 20180911 修改
                           $cache_key = md5($user_id.'ts168_waybill_printer'.$shop_id);
                           $Cache = YLB_Cache::create('default');
                           if ($Cache->save($print_str,$cache_key))
                           {
                               $msg = '提交成功';
                           }
                           else
                           {
                               $msg = '提交失败';
                               $flag = false;
                           }

                           if ($flag)
                           {
                               $data['printer_key'] = md5('window_printer_this_waybill');
                           }
                       }
                   }
                   else
                   {
                       $flag = false;
                       $msg = '无效数据请重新提交';
                   }
               }
           }
           else
           {
               $flag = false;
               $msg = '参数有误请重新提交';
           }
        }
        else
        {
            $flag = false;
            $msg = '数据失效请重新提交';
        }

        if($flag)
        {
            $status = 200;
        }
        else
        {
            $status = 250;
            $data = array();
        }

        $this->data->addBody(-140,$data,$msg,$status);
    }


   /*
    * 快递鸟内部接口  start
    */
    public function build_form()
    {
        $user_id = Perm::$userId;
        $shop_id = Perm::$shopId;

        $print_key = request_string('printer_key');
        //$ip = $this->get_ip();
        $ip = request_string('ip',$this->get_ip());

        if($print_key == md5('window_printer_this_waybill'))
        {
            /*try
            {
                $memcache = new Memcache();
                $memcache->connect($_SERVER['SERVER_ADDR'],11211);
            }
            catch (Exception $e)
            {
                echo 'Message'.$e->getMessage();
            }
            $printer_key = md5($user_id.'ts168_waybill_printer'.$shop_id);
            $request_data = $memcache->get($printer_key);*/

            //zhenzh 20180911 修改
            $cache_key = md5($user_id.'ts168_waybill_printer'.$shop_id);
            $Cache = YLB_Cache::create('default');
            $request_data = $Cache->get($cache_key);

            if($request_data)
            {
                $request_data_encode = urlencode($request_data);

                $data_sign = $this->encrypt($ip.$request_data, $this->AppKey);

                //是否预览，0-不预览 1-预览
                $is_priview = '1';

                //组装表单，这是个bug 目前是表单提交，若可以后期可改curl 模拟post提交
                $form = '<form id="form1" method="POST" action="'.$this->ApiUrl.'">
                        <input type="text" name="RequestData" value="'.$request_data_encode.'"/>
                        <input type="text" name="EBusinessID" value="'.$this->EBusinessID.'"/>
                        <input type="text" name="DataSign" value="'.$data_sign.'"/>
                        <input type="text" name="IsPriview" value="'.$is_priview.'"/></form><script>form1.submit();</script>';
                //删除key
                //$memcache->delete($printer_key);
                $Cache->remove($cache_key);
                //表单提交
                print_r($form);
            }
            else
            {
                $request_data = '[{"OrderCode":"012657700387","PortName":"Gprinter  GP-1324D"}]';
                $request_data_encode = urlencode($request_data);

                $data_sign = $this->encrypt($ip.$request_data_encode, $this->AppKey);
                //是否预览，0-不预览 1-预览
                $is_priview = '1';

                //组装表单
                $form = '<form id="form1" method="POST" action="'.$this->ApiUrl.'"><input type="text" name="RequestData" value="'.$request_data.'"/><input type="text" name="EBusinessID" value="'.$this->EBusinessID.'"/><input type="text" name="DataSign" value="'.$data_sign.'"/><input type="text" name="IsPriview" value="'.$is_priview.'"/></form><script>form1.submit();</script>';

                print_r($form);
            }
        }
    }

    public function encrypt($data, $appkey)
    {
        return urlencode(base64_encode(md5($data.$appkey)));
    }

    public function is_private_ip($ip) {
        return !filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE);
    }

    public function get_ip() {
        //获取客户端IP
        if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $ip = getenv('REMOTE_ADDR');
        } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        if(!$ip || $this->is_private_ip($ip)) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->IpServiceUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            $str = json_encode($output);
            $arr_one = explode('\r',$str);
            $arr_two = explode('"', current($arr_one));
            $output = end($arr_two);
            return $output;
        }
        else{
            return $ip;
        }
    }
    /*
     * 快递鸟内部接口  end
     */


    
    //电子面单单号查询
    public function waybillSelect()
    {

        $user_id = Perm::$userId;
        $shop_id = Perm::$shopId;
        $redis_key = md5($user_id.'ts168_waybill'.$shop_id);
        $memcache = new Memcache;
        $memcache->connect($_SERVER['SERVER_ADDR'],11211);
        $data = $memcache->get($redis_key);
       echo '<pre>';
       print_r($data);die;
//        if($memcache->delete($redis_key))
//        {
//          die('ok');
//        }else{
//            die('no');
//        }


//        include $this->view->getView();
    }

    //电子面单我的服务商
    public function myWaybillServe()
    {

        $act = request_string('act');
        if($act == 'dredgeServer'){
            $this->view->setMet('dredgeServer');
        }
            include $this->view->getView();


    }

    //账户信息
    public function waybillUserDetail()
    {
        include $this->view->getView();
    }

    //数据加载
    public function waybillLoad()
    {
        include $this->view->getView();
    }

    //异常订单
    public function waybillAbnormal()
    {
        include $this->view->getView();
    }



}
