<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Seller_Goods_TBImportCtl extends Seller_Controller
{
    public $goodsSpecValueModel = null;

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

    }

    public function importFile()
    {



        /*
        $parrent = "/(href|src)=([\"|']?)([^\"'>]+.(jpg|JPG|jpeg|JPEG|gif|GIF|png|PNG))/i";
        preg_match_all($parrent,$str,$match);
        $img_data = $match[3];
        var_dump($img_data);
        if(request_string('typ') == 'json')
        {
            include $this->data->addbody(-140,$img_data);
        }

        $preg = "/(href|src)=([\"|']?)([^\"'>]+.(jpg|JPG|jpeg|JPEG|gif|GIF|png|PNG))/i";
        preg_match_all($preg,$str,$match);
        $img_data = $match[3];
        foreach ($img_data as $img_key=>$img_val)
        {
            $img_array = explode('/', $img_val);
            $img = array_pop($img_array);
            $str = str_replace($img_val,$img,$str);
        }
        var_dump($str);die;
        */

        /*
        $shopGoodsCatModel = new Shop_GoodsCatModel();
        $shop_goods_cat_rows = $shopGoodsCatModel->getByWhere( array('shop_id'=> Perm::$shopId) );
        */

        //获取本店分类信息 @liuguilong 20170713
        $goodsTypeModel  = new Goods_TypeModel();
        $shop_id = Perm::$shopId;
        $cat_id = 0;
        $res  = $goodsTypeModel->getTypeInfoByPublishGoods($cat_id,$shop_id);
        $shop_goods_cat_rows = $res['goods_cat_list'];

        include $this->view->getView();
    }


    public function import()
    {

        $html = '';

        //$html = 'src=ddd.jpg >fsdfd src=22.jpg />';
        //$parrent = "/(href|src)=([\"|']?)([^\"'>]+.(jpg|JPG|jpeg|JPEG|gif|GIF|png|PNG))/i";

        $parrent = "/(href|src|url)(=|\()([\"|']?)([^\"'>|\)]+.(jpg|JPG|jpeg|JPEG|gif|GIF|png|PNG))/i";
        preg_match_all($parrent,$html,$match);
        $img_data = $match;

        /*foreach ($img_data as $img_key=>$img_val)
        {
            $img_array = explode('/', $img_val);
            $img = array_pop($img_array);
            $html = str_replace($img_val,$img,$html);
        }*/

        //$data = $this->get_html_attr_by_tag($html,'url','');

        echo '<pre>';
        print_r($img_data);
    }

    public function importImage()
    {
        include $this->view->getView();
    }

    public function importImageDetail()
    {
        include $this->view->getView();
    }

    //宝贝名称	宝贝类目	店铺类目	新旧程度	省	城市	出售方式	宝贝价格	加价幅度	宝贝数量	有效期	运费承担	平邮	EMS	快递	发票	保修	放入仓库，
    //	橱窗推荐	开始时间	宝贝描述	宝贝属性	邮费模版ID	会员打折	修改时间	上传状态	图片状态	返点比例	新图片，
    //	视频	销售属性组合	用户输入ID串	用户输入名-值对	商家编码	销售属性别名	代充类型	数字ID	本地ID	，
    //宝贝分类	用户名称	宝贝状态	闪电发货	新品	食品专项	尺码库	采购地	库存类型	国家地区	库存计数	物流体积	物流重量	退换货承诺	，
    //定制工具	无线详情	商品条形码	sku 条形码	7天退货	宝贝卖点	属性值备注	自定义属性值	商品资质	增加商品资质	关联线下服务

    /**
     * 有用的信息：宝贝名称、宝贝价格、宝贝数量、运费承担、平邮、EMS、快递、橱窗推荐、宝贝描述、新图片
     */

    public function addGoods()
    {
        $file_path = request_string("file_path");
        $file_path = "./shop/data/upload$file_path";

        $csv_string = $this->unicodeToUtf8(file_get_contents($file_path));

        $handle = fopen($file_path, "w");
        fwrite($handle, $csv_string);
        fclose($handle);

        $reader_csv = new PHPExcel_Reader_CSV();
        $reader_csv->setDelimiter("\t")->setEnclosure("");
        $php_excel = $reader_csv->load($file_path);

        $sheet_data = $php_excel->getActiveSheet()->toArray(null,true,true,true);

        if ( !empty($sheet_data) )
        {
            $KName_VLetter = array();

            $important_data = array("宝贝名称", "宝贝价格", "宝贝数量", "橱窗推荐", "宝贝描述", "新图片");
            $unimportant_data = array("运费承担", "平邮", "EMS", "快递");

            foreach ( $sheet_data as $column => $row_data )
            {
                //获取真实数据在哪
                $success = 0;
                foreach ( $important_data as $column_name )
                {
                    if (in_array( $column_name, $row_data ))
                    {
                        $success++;
                    }
                    else
                    {
                        array_shift($sheet_data);
                        continue 2;
                    }
                }

                if ( $success == 6 )
                {
                    foreach ( $row_data as $col_letter => $col_name)
                    {
                        foreach ( $important_data as $column_name )
                        {
                            if ( $col_name == $column_name )
                            {
                                $KName_VLetter[$col_name] = $col_letter;
                            }
                            if ( count($KName_VLetter) == 6 )
                            {
                                array_shift($sheet_data);
                                break 3;
                            }
                        }
                    }
                }
            }
        }
        else
        {
            return $this->data->addBody(-140, array(), "没有数据导入", 250);
        }

        if ( !empty($sheet_data) )
        {
            $shopBaseModel          = new Shop_BaseModel();
            $goodsCommonModel       = new Goods_CommonModel();
            $GoodsBaseModel         = new Goods_BaseModel();
            $goodsImagesModel       = new Goods_ImagesModel();
            $goodsCommonDetailModel = new Goods_CommonDetailModel();
            $GoodsCatModel = new Goods_CatModel();
            $GoodsTypeModel = new Goods_TypeModel();


            $shop_data = $shopBaseModel->getBase(Perm::$shopId);
            $shop_data = current($shop_data);

            $result_error = array();
            $result_success = array();

            //读取公共数据
            $cat_id             = request_string("goods_category_id");      //商品分类
            $province_id        = request_string("province_id");            //商品所在地
            $city_id            = request_string("city_id");                //商品所在地
            $shop_goods_cat_id  = request_row("store_goods_category");      //店铺商品分类
            $is_detail          = request_int("is_detail",0);

            if($cat_id)
            {
                $common_location = array();
                $common_location[] = $province_id;
                if ( $city_id != 0 )
                {
                    $common_location[] = $city_id;
                }

                $common_data = array();
                $common_data['cat_id']              = $cat_id;
                $common_data['common_location']     = $common_location;
                $common_data['shop_goods_cat_id']   = $shop_goods_cat_id;
                $common_data['shop_id']             = Perm::$shopId;
                $common_data['shop_name']           = $shop_data['shop_name'];
                $common_data['common_state']        = Goods_CommonModel::GOODS_STATE_OFFLINE;
                $common_data['shop_self_support']   = $shop_data['shop_self_support'] == 'true' ? 1 : 0;

                //判断发布的的商品是否需要审核
                if (Web_ConfigModel::value('goods_verify_flag') == 0)    //商品是否需要审核 0 不需要
                {
                    $common_data['common_verify'] = Goods_CommonModel::GOODS_VERIFY_ALLOW;
                }
                else
                {
                    $common_data['common_verify'] = Goods_CommonModel::GOODS_VERIFY_WAITING;
                }

                set_time_limit(180);

                $property = array();
                $goods_cat = $GoodsCatModel->getOne($cat_id);

                $parent_cat = $GoodsCatModel->getCatParent($cat_id);
                $parent_cat = array_column($parent_cat,'cat_name');
                $parent_cat = implode(' > ',$parent_cat);
                $cat_pid = $GoodsCatModel->getTopParentCat($cat_id);
                $common_data['cat_id'] = $cat_id;
                $common_data['cat_pid'] = $cat_pid['cat_id'];
                $common_data['cat_name'] = $parent_cat.' > '.$goods_cat['cat_name'];
                $common_data['type_id'] = $goods_cat['type_id'];

                $property_data = $GoodsTypeModel->getPropertyByTypeId($goods_cat['type_id']);
                if($property_data)
                {
                    foreach ($property_data as $key=>$value)
                    {
                        if($value['property_format'] == 'select' && $value['property_values'] && is_array($value['property_values']))
                        {
                            $property['property_'.$value['property_id']][0] = $value['property_name'];
                            $property['property_'.$value['property_id']][2] = 'select';
                            $value['property_values'] = current($value['property_values']);
                            $property['property_'.$value['property_id']][1] = $value['property_values']['property_value_id'];
                        }
                    }
                }

                foreach ( $sheet_data as $row_data)
                {
                    $goods_image = $row_data[$KName_VLetter["新图片"]];
                    $goods_image = str_replace('"', "", $goods_image);
                    $goods_image = explode(';', $goods_image);
                    array_walk($goods_image, function (&$val){
                        $val = explode("|", $val)[1];
                    });
                    $common_data['common_image']            = $goods_image[0];

                    if(strlen($common_data['common_image']) > 0 )
                    {

                    }
                    else
                    {
                        //甩手第一步导入 需再进行第二步导入图片
                        $goods_image = $row_data[$KName_VLetter["新图片"]];
                        $goods_image = substr($goods_image,0,strlen($goods_image)-1);
                        $goods_image = str_replace('"', "", $goods_image);
                        $goods_image = explode(';', $goods_image);

                        array_walk($goods_image, function (&$val){
                            $val = array_shift( explode(":", $val) );
                        });
                        $common_data['common_image']            = $goods_image[0];
                    }

                    $common_name = str_replace('"', "", $row_data[$KName_VLetter["宝贝名称"]]);
                    $common_data['common_name']             = $common_name;
                    $common_data['common_price']            = $row_data[$KName_VLetter["宝贝价格"]];
                    $common_data['common_cost_price']       = $row_data[$KName_VLetter["宝贝价格"]];
                    $common_data['common_market_price']     = $row_data[$KName_VLetter["宝贝价格"]];
                    $common_data['common_stock']            = $row_data[$KName_VLetter["宝贝数量"]];
                    $common_data['common_is_recommend']     = $row_data[$KName_VLetter["橱窗推荐"]] == 1 ? Goods_CommonModel::RECOMMEND_TRUE : Goods_CommonModel::RECOMMEND_FALSE;
                    $common_data['common_add_time'] = date('Y-m-d H:i:s');
                    $common_data['common_share_price'] = Share_BaseModel::TOTAL_PRICE;
                    $common_data['common_shared_price'] = $common_data['common_price'] - $common_data['common_share_price'];
                    $common_data['common_is_promotion'] = 0;
                    $common_data['common_promotion_price'] = Share_BaseModel::PROMOTION_TOTAL_PEICE;
                    if($property)
                    {
                        $common_data['common_property'] = $property;
                    }

                    $common_id = $goodsCommonModel->addCommon($common_data, true);

                    if ($common_id)
                    {
                        $result_success[] = $common_data['common_name'];

                        //goods_base
                        $goods_data = array();
                        $goods_data['common_id']             = $common_id;
                        $goods_data['shop_id']               = $common_data['shop_id'];
                        $goods_data['shop_name']             = $common_data['shop_name'];
                        $goods_data['goods_name']            = $common_data['common_name'];
                        $goods_data['cat_id']                = $common_data['cat_id'];
                        $goods_data['goods_price']           = $common_data['common_price'];
                        $goods_data['goods_market_price']    = $common_data['common_market_price'];
                        $goods_data['goods_stock']           = $common_data['common_stock'];
                        $goods_data['goods_is_recommend']    = $common_data['common_is_recommend'];
                        $goods_data['goods_image']           = $common_data['common_image'];
                        $goods_data['goods_is_shelves']      = Goods_BaseModel::GOODS_DOWN;
                        $goods_data['goods_share_price']     = $common_data['common_share_price'];
                        $goods_data['goods_shared_price']    = $common_data['common_shared_price'];
                        $goods_data['goods_is_promotion']    = 0;
                        $goods_data['goods_promotion_price'] = $common_data['common_promotion_price'];

                        $goods_id = $GoodsBaseModel->addBase($goods_data, true);

                        if ( $goods_id )
                        {
                            $common_update_data['goods_id'] = array( array('goods_id' => $goods_id, 'color_id' => Goods_ImagesModel::IMAGE_NOT_COLOR) );
                            $goods_common_flag = $goodsCommonModel->editCommon($common_id, $common_update_data);
                        }

                        //goods_image
                        $image_data = array();

                        foreach ( $goods_image as $key => $image )
                        {
                            if ( $key > 4 ) break;
                            $image_data['common_id']            = $common_id;
                            $image_data['shop_id']              = Perm::$shopId;
                            $image_data['images_color_id']      = Goods_ImagesModel::IMAGE_NOT_COLOR;
                            $image_data['images_image']         = $image;
                            $image_data['images_is_default']  = $key == 0 ? Goods_ImagesModel::IMAGE_DEFAULT : Goods_ImagesModel::IMAGE_NOT_DEFAULT;

                            $goods_image_id = $goodsImagesModel->addImages($image_data, true);
                        }


                        //goods_detail
                        $common_detail_data = array();
                        $common_detail_data['common_id']   = $common_id;

                        $common_body = $row_data[$KName_VLetter["宝贝描述"]];

                        //Zhenzh
                        //去掉alt标签
                        //$common_body = str_replace(array('alt=""','alt="','ID=""','ID="','id=""','id="'),'',$common_body);
                        if($is_detail)
                        {
                            $preg = "/(href|src|url)(=|\()([\"|']?)([^\"'>|\)]+.(jpg|JPG|jpeg|JPEG|gif|GIF|png|PNG))/i";
                            preg_match_all($preg,$common_body,$match);
                            $img_data = $match[4];
                            foreach ($img_data as $img_key=>$img_val)
                            {
                                $img_array = explode('/', $img_val);
                                $img = array_pop($img_array);
                                $common_body = str_replace($img_val,$img,$common_body);
                            }
                        }

                        $common_detail_data['common_body'] = $common_body;

                        $common_detail_id = $goodsCommonDetailModel->addCommonDetail($common_detail_data, true);


                        //添加默认分享立减Zhenzh
                        $share_model = new Share_BaseModel();
                        $share_cond['weixin'] = Share_BaseModel::WEIXIN;
                        $share_cond['weixin_timeline'] = Share_BaseModel::WEIXIN_TIMELINE;
                        $share_cond['sqq'] =Share_BaseModel::SQQ;
                        $share_cond['qzone'] = Share_BaseModel::QZONE;
                        $share_cond['tsina'] = Share_BaseModel::TSINA;
                        $share_cond['share_total_price'] = Share_BaseModel::TOTAL_PRICE;
                        $share_cond['share_limit'] = $common_data['common_stock'];
                        $share_cond['is_promotion'] = Share_BaseModel::IS_PROMOTION;
                        $share_cond['promotion_total_price'] = Share_BaseModel::PROMOTION_TOTAL_PEICE;
                        $share_cond['promotion_unit_price'] = Share_BaseModel::PROMOTION_UNIT_PEICE;

                        $share_id = $share_model->getKeyByWhere(array('common_id'=>$common_id));
                        if($share_id)
                        {
                            $share_model->editShare($share_id,$share_cond);
                        }
                        else
                        {
                            $share_cond['common_id'] = $common_id;
                            $share_model->addShare($share_cond);
                        }

                    }
                    else
                    {
                        $result_error[] = $common_data['common_name'];
                    }
                }


                $result_success = implode("<br>", $result_success);
                $result_error = implode("<br>", $result_error);

                $msg = sprintf("导入成功: %s, 导入失败: %s", $result_success, $result_error);


                unlink($file_path);
                $this->data->addBody(-140, array(), $msg, 200);
            }
            else
            {
                return $this->data->addBody(-140, array(), " 请选择商品分类", 250);
            }


        }
        else
        {
            return $this->data->addBody(-140, array(), "无效数据", 250);
        }
    }




    function unicodeToUtf8($str, $order = "little")
    {
        $utf8string ="";
        $n=strlen($str);
        for ($i=0;$i<$n ;$i++ )
        {
            if ($order=="little")
            {
                $val = str_pad(dechex(ord($str[$i+1])), 2, 0, 0) .
                    str_pad(dechex(ord($str[$i])),      2, 0, 0);
            }
            else
            {
                $val = str_pad(dechex(ord($str[$i])),      2, 0, 0) .
                    str_pad(dechex(ord($str[$i+1])), 2, 0, 0);
            }
            $val = intval($val,16); // 由于上次的.连接，导致$val变为字符串，这里得转回来。
            $i++; // 两个字节表示一个unicode字符。
            $c = "";
            if($val < 0x7F)
            { // 0000-007F
                $c .= chr($val);
            }
            elseif($val < 0x800)
            { // 0080-07F0
                $c .= chr(0xC0 | ($val / 64));
                $c .= chr(0x80 | ($val % 64));
            }
            else
            { // 0800-FFFF
                $c .= chr(0xE0 | (($val / 64) / 64));
                $c .= chr(0x80 | (($val / 64) % 64));
                $c .= chr(0x80 | ($val % 64));
            }
            $utf8string .= $c;
        }
        /* 去除bom标记 才能使内置的iconv函数正确转换 */
        if (ord(substr($utf8string,0,1)) == 0xEF && ord(substr($utf8string,1,2)) == 0xBB && ord(substr($utf8string,2,1)) == 0xBF)
        {
            $utf8string = substr($utf8string,3);
        }
        return $utf8string;
    }
}

?>