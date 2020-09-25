<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Goods_BaseModel extends Goods_Base
{

    const GOODS_UP   = 1;//上架
    const GOODS_DOWN = 2;//下架

    /**
     * 读取分页列表
     *
     * @param array $cond_row
     * @param array $order_row
     * @param int $page
     * @param int $rows
     * @return array
     */
    public function getBaseList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        return $this->listByWhere($cond_row, $order_row, $page, $rows);
    }

    /**
     * 根据字段读取商品，无分页，要分页自己改
     *
     * @param null $field 字段名称
     * @param array $value 查询值
     * @param array $order 排序规则
     * @return array
     */
    public function getBaseByIds($field = null,$value = array(),$order=array())
    {
        return $this->otherGet($field,$value,$order);
    }

    /**
     * 读取分页列表
     *
     * @param $common_id
     * @param array $order_row
     * @param int $page
     * @param int $rows
     * @return array
     */
    public function getBaseListByCommonId($common_id, $order_row = array(), $page = 1, $rows = 100)
    {
        $cond_row = array('common_id' => $common_id);

        return $this->listByWhere($cond_row, $order_row, $page, $rows);
    }

    /**
     * 根据common_id获取goods_common
     *
     * @param $common_id
     * @param array $order_row
     * @param int $page
     * @param int $rows
     * @return array
     */
    public function getBaseByCommonId($common_id, $order_row = array(), $page = 1, $rows = 100)
    {
        $cond_row = array('common_id' => $common_id);

        return $this->getByWhere($cond_row, $order_row, $page, $rows);
    }

    /**
     * 根据common_id获取goods_base规格信息
     * @param $common_id
     * @return mixed
     */
    public function getBaseSpecByCommonId($common_id)
    {
        $cond_row = array('common_id' => $common_id);
        $res      = $this->getByWhere($cond_row);

        foreach ($res as $key => $val)
        {
            $data[$key] = current($val['goods_spec']);
        }

        return $data;
    }

    /**
     * 根据common_id获取其下所有goods_id
     *
     * @param $common_id
     * @return array
     */
    public function getGoodsIdByCommonId($common_id)
    {
        if (is_array($common_id))
        {
            $cond_row = array('common_id:in' => $common_id);
        }
        else
        {
            $cond_row = array('common_id' => $common_id);
        }

        return $this->getKeyByWhere($cond_row);
    }

    /**
     * 根据goods_id或array() 获取goods_base
     *
     * @param $goods_id
     * @param null $cond_row
     * @param null $order_row
     * @return array
     */
    public function getGoodsListByGoodId($goods_id,$cond_row = null,$order_row = null)
    {
        if (is_array($goods_id))
        {
            $cond_row['goods_id:in'] = $goods_id;
        }
        else
        {
            $cond_row['goods_id'] = $goods_id;
        }
        $data = $this->getByWhere($cond_row,$order_row);
        return $data;
    }

    /**
     * 根据店铺查商品
     *
     * @author WenQingTeng
     */
    public function getGoodsListByShopId($shop_id, $order_row, $page, $rows)
    {
        if (is_array($shop_id))
        {
            $cond_row = array('shop_id:in' => $shop_id);
        }
        else
        {
            $cond_row = array('shop_id' => $shop_id);
        }

        return $this->listByWhere($cond_row, $order_row, $page, $rows);
    }

    /**
     * 删除商品库存
     *
     * @param $goods_id
     * @param $num
     * @return array|bool|string
     */
    public function delStock($goods_id, $num)
    {
        $goods_base    = $this->getOne($goods_id);
        $edit_base_num = $goods_base['goods_stock'] - $num;

        if($edit_base_num < 0)
        {
            return 'no_stock' ;
        }

        $edit_base_row = array('goods_stock' => $edit_base_num);
        $flag          = $this->editBase($goods_id, $edit_base_row, false);

        if ($flag)
        {
            $Goods_CommonModel = new Goods_CommonModel();
            $common_base       = $Goods_CommonModel->getOne($goods_base['common_id']);
            $edit_common_num   = $common_base['common_stock'] - $num;
            $edit_common_row   = array('common_stock' => $edit_common_num);
            $flag              = $Goods_CommonModel->editCommon($goods_base['common_id'], $edit_common_row, false);

            if($edit_base_num <= $goods_base['goods_alarm'])
            {
                //查找店铺信息
                $Shop_BaseModel = new Shop_BaseModel();
                $shop_base = $Shop_BaseModel->getOne($goods_base['shop_id']);
                if($shop_base)
                {
                    $message = new MessageModel();
                    $message->sendMessage('goods are not in stock',$shop_base['user_id'], $shop_base['user_name'], $order_id = NULL, $shop_name = NULL, 1, 1, $end_time = Null,$goods_base['common_id'],$goods_id);
                }
            }
        }
        else
        {
            $flag = false;
        }

        return $flag;

    }

    /**
     * 返回商品库存(取消订单后根据订单商品id返回商品库存)
     *
     * @param $order_goods_id
     */
    public function returnGoodsStock($order_goods_id)
    {
        $Order_GoodsModel  = new Order_GoodsModel();
        $Goods_CommonModel = new Goods_CommonModel();
        $FuBaseModel       = new Fu_BaseModel();

        /*if (is_array($order_goods_id))
        {
            foreach ($order_goods_id as $key => $val)
            {
                $order_goods_base = $Order_GoodsModel->getOne($val);
                $goods_id         = $order_goods_base['goods_id'];
                $num              = $order_goods_base['order_goods_num'];

                $edit_base_row = array('goods_stock' => $num);
                $this->editBase($goods_id, $edit_base_row);

                $edit_common_row = array('common_stock' => $num);
                $Goods_CommonModel->editCommonTrue($order_goods_base['common_id'], $edit_common_row);
            }
        }
        else
        {
            $order_goods_base = $Order_GoodsModel->getOne($order_goods_id);
            $goods_id         = $order_goods_base['goods_id'];
            $num              = $order_goods_base['order_goods_num'];

            $edit_base_row = array('goods_stock' => $num);
            $flag          = $this->editBase($goods_id, $edit_base_row);

            $edit_common_row = array('common_stock' => $num);
            $Goods_CommonModel->editCommonTrue($order_goods_base['common_id'], $edit_common_row);
        }*/

        if (!is_array($order_goods_id)) $order_goods_id[] = $order_goods_id;
        foreach ($order_goods_id as $key => $val)
        {
            $order_goods_base = $Order_GoodsModel->getOne($val);
            $goods_id         = $order_goods_base['goods_id'];
            $num              = $order_goods_base['order_goods_num'];

            $edit_base_row = array('goods_stock' => $num);
            $this->editBase($goods_id, $edit_base_row);

            $edit_common_row = array('common_stock' => $num);
            $Goods_CommonModel->editCommonTrue($order_goods_base['common_id'], $edit_common_row);

            if ($order_goods_base['promotion_type'] == $Goods_CommonModel::FU)
            {
                $fu_id = $FuBaseModel->getKeyByWhere([
                    'goods_id'   => $goods_id,
                    'fu_state:<' => $FuBaseModel::DELETE
                ]);

                if ($fu_id)
                    $FuBaseModel->editFu($fu_id, ['fu_stock'=>$num],true);
            }
        }
    }

    public function getNormalGoodsBase($goods_id)
    {
        $cond_row['goods_id'] = $goods_id;
        $cond_row['goods_is_shelves'] = Goods_BaseModel::GOODS_UP;
        $cond_row['goods_stock:>'] = 0;
        return $this->getOneByWhere($cond_row);

    }

    /**
     * 检测商品状态
     * 1.商品base信息是否存在 商品是否上架，商品是否有库存
     * 2.商品common信息是否存在 common是否正常，common审核是否通过
     *
     * @param $goods_id
     * @return null
     */
    public function checkGoods($goods_id)
    {
        if ($goods_id <= 0)
        {
            return null;
        }

        //获取商品信息及活动信息
        $goods_base = $this->getOne($goods_id);
        if (empty($goods_base))
        {
            return null;
        }
        //商品状态
        if ($goods_base['goods_is_shelves'] != Goods_BaseModel::GOODS_UP || $goods_base['goods_stock'] <= 0 || !$goods_base['shop_id'])
        {
            return null;
        }

        //获取商品Common信息
        $Goods_CommonModel = new Goods_CommonModel();
        $goods_common      = $Goods_CommonModel->getOne($goods_base['common_id']);
        if (empty($goods_common))
        {
            return null;
        }
        //common状态与店铺状态
        if ($goods_common['common_state'] != Goods_CommonModel::GOODS_STATE_NORMAL || $goods_common['shop_status'] != Shop_BaseModel::SHOP_STATUS_OPEN)
        {
            return null;
        }

        /*商品规格信息 start*/
        $goods_base = $Goods_CommonModel->getGoodsSpec($goods_base,$goods_common);
        /*商品规格信息 end*/

        $data['goods_base']   = $goods_base;
        $data['goods_common'] = $goods_common;
        return $data;
    }

    /**
     * 检测商品状态
     * 1.商品base信息是否存在 商品是否上架，商品是否有库存
     * 2.商品common信息是否存在 common是否正常，common审核是否通过，
     * 3.店铺是否正常开启
     * @param $goods_id
     * @return null
     */
    public function checkGoodsII($goods_id)
    {
        if ($goods_id <= 0)
        {
            return null;
        }

        //获取商品信息
        $goods_base = $this->getOne($goods_id);

        if (empty($goods_base))
        {
            return null;
        }

        //根据店铺id查询
        $Shop_BaseModel = new Shop_BaseModel();
        $shop_base = $Shop_BaseModel->getOne($goods_base['shop_id']);

        //商品状态(更改为若是店家自己则可以观看下架商品)
        if($shop_base['user_id'] != Perm::$userId)
        {
            if ($goods_base['goods_is_shelves'] != Goods_BaseModel::GOODS_UP || !$goods_base['shop_id'])
            {
                return null;
            }
        }

        //获取商品Common信息
        $Goods_CommonModel = new Goods_CommonModel();
        $goods_common      = $Goods_CommonModel->getOne($goods_base['common_id']);
        if (empty($goods_common))
        {
            return null;
        }

        //用户状态与店铺状态(判断有且只有下架商品)
        if($goods_common['common_state'] == $Goods_CommonModel::GOODS_STATE_OFFLINE)
        {
            if($shop_base['user_id'] != Perm::$userId)
            {
                if ($goods_common['common_state'] != Goods_CommonModel::GOODS_STATE_NORMAL || $goods_common['shop_status'] != Shop_BaseModel::SHOP_STATUS_OPEN)
                {
                    return null;
                }
            }
            else
            {
                if ($goods_common['shop_status'] != Shop_BaseModel::SHOP_STATUS_OPEN)
                {
                    return null;
                }
            }
        }
        else
        {
            if ($goods_common['common_state'] != Goods_CommonModel::GOODS_STATE_NORMAL || $goods_common['shop_status'] != Shop_BaseModel::SHOP_STATUS_OPEN)
            {
                return null;
            }
        }

        //如果商品需要审核，则审核通过的才上架
        $goods_verify_flag = Web_ConfigModel::value('goods_verify_flag');
        if($goods_common['common_verify'] != Goods_CommonModel::GOODS_VERIFY_ALLOW && $goods_verify_flag == 1)
        {
            return null;
        }

        $data['goods_base'] = $goods_base;
        $data['goods_common'] = $goods_common;
        $data['shop_base'] = $shop_base;
        return $data;
    }

    /**
     * 获取商品信息(购物车中获取商品信息，此处获取的商品信息并不全面)
     * 和活动信息: 1惠抢购 2限时折扣 3手机专享 4新人优惠 6送福免单
     * @param $goods_id
     * @return null
     */
    public function getGoodsInfo($goods_id)
    {
        //检测商品是否属于正常状态
        $data = $this->checkGoods($goods_id);
        if (!$data)
        {
            return null;
        }
        $goods_base = $data['goods_base'];
        $goods_common = $data['goods_common'];

        if($goods_common['product_distributor_flag'])
        {
            $goods_base['goods_price'] = $goods_base['goods_recommended_max_price'];
        }

        /*商品规格信息 start*/
        /*商品规格信息 end*/

        /*活动信息 start*/
        //惠抢购 限时折扣 手机专享 新人优惠
        $promotion = new Promotion();
        $promotion_data = $promotion->getGoodsPromotion($goods_base['goods_id'],$goods_base['common_id'],$goods_common['common_promotion_type']);
        if($promotion_data)
        {
            //惠抢购 限时折扣 手机专享 新人优惠
            if($promotion_data['promotion'])
            {
                if($promotion_data['promotion']['promotion_price'] < $goods_base['goods_price'])
                {
                    $promotion_data['promotion']['down_price'] = $goods_base['goods_price'] - $promotion_data['promotion']['promotion_price'];
                    $goods_base['promotion'] = $promotion_data['promotion'];
                }

                //惠抢购
                if($goods_base['promotion']['promotion_type'] == Goods_CommonModel::HUIQIANGGOU)
                {
                    if($goods_base['promotion']['scarebuy_starttime'] > get_date_time())
                    {
                        $goods_base['goods_stock'] = $goods_base['goods_stock'] - $promotion_data['promotion']['scarebuy_count'];
                        unset($goods_base['promotion']);
                    }
                }

                //手机专享
                if ( request_string('typ') != 'json' && YLB_Utils_Device::isMobile() && $goods_base['promotion']['promotion_type'] == Goods_CommonModel::SHOUJI)
                {
                    $goods_base['mobile_price'] = $promotion_data['promotion']['promotion_price'];
                    unset($goods_base['promotion']);
                }
            }
        }
        /*活动信息 end*/

        $data['goods_base']   = $goods_base;
        $data['goods_common'] = $goods_common;
        return $data;
    }

    /**
     * 获取商品详细信息(商品详情中获取商品信息，此处获取的商品信息全面)
     * 重写getGoodsDetailInfoByGoodId方法 Zhenzh
     *
     * @param $goods_id
     * @return null
     */
    public function getGoodsDetailInfoByGoodId($goods_id)
    {
        //检测商品是否属于正常状态 并获取goods_base goods_common shop_base
        $data = $this->checkGoodsII($goods_id);

        if (!$data)
        {
            return null;
        }

        $goods_base   = $data['goods_base'];
        $goods_common = $data['goods_common'];
        $shop_base    = $data['shop_base'];

        if($goods_common['product_distributor_flag'])
        {
            $goods_base['goods_price'] = $goods_base['goods_recommended_max_price'];
        }

        //商品规格信息
        if (is_array($goods_base['goods_spec']))
        {
            $goods_base['goods_spec'] = current($goods_base['goods_spec']);
            if($goods_base['goods_spec'] === null)
            {
                $goods_base['goods_spec'] = '';
            }
        }

        //属性
        if($goods_common['common_property'])
        {
            $Goods_PropertyValueModel = new Goods_PropertyValueModel();
            foreach($goods_common['common_property'] as $cgpkey => $cgpval)
            {
                if($cgpval['2'] == 'select')
                {
                    $goods_propertyval = $Goods_PropertyValueModel->getOne($cgpval['1']);
                    $common_property_row[$cgpval['0']] = $goods_propertyval['property_value_name'];
                }
                else if($cgpval['2'] == 'text')
                {
                    $common_property_row[$cgpval['0']] = $cgpval['1'];
                }
            }
            $goods_common['common_property_row'] = $common_property_row;
        }
        else
        {
            $goods_common['common_property_row'] = array();
        }

        //商品common图片
        $image_common_cond                      = array();
        $image_common_cond['common_id']         = $goods_common['common_id'];
        $image_common_cond['images_is_default'] = Goods_ImagesModel::IMAGE_DEFAULT;
        $Goods_ImagesModel                      = new Goods_ImagesModel();

        $goods_common['common_spec_value_c'] = $goods_common['common_spec_value'];
        if (is_array($goods_common['common_spec_value']))
        {
            foreach ($goods_common['common_spec_value'] as $comvk => $comvv)
            {
                foreach ($comvv as $cvk => $cvv)
                {
                    $image_common_cond['images_color_id'] = $cvk;
                    $image_common_row                     = current($Goods_ImagesModel->getGoodsImage($image_common_cond));
                    if ($image_common_row)
                    {
                        $goods_common['common_spec_value'][$comvk][$cvk] = sprintf('<img src="%s" title="%s" alt="%s"/>', image_thumb($image_common_row['images_image'],42,42),$cvv,$cvv);
                        $goods_common['common_spec_value_color'][$cvk] = image_thumb($image_common_row['images_image'], 360, 360);
                    }
                }
            }
        }

        //商品详细图片
        $image_cond                         = array();
        $image_cond['common_id']            = $goods_common['common_id'];
        $image_cond['images_color_id']      = $goods_base['color_id'];
        $image_order                        = array();
        $image_order['images_displayorder'] = 'ASC';
        $image_order['images_is_default']   = 'DESC';

        $image_row                          = array_values($Goods_ImagesModel->getGoodsImage($image_cond, $image_order));

        $goods_base['image_row'] = $image_row;

        //加入购物车按钮
        $goods_base['cart'] = true;
        //虚拟、F码、预售不显示加入购物车
        if ($goods_common['common_is_virtual'] == 1)
        {
            $goods_base['cart'] = false;
        }

        //商品运费信息（查找是否是包邮产品，或者满多少包邮）
        /*if ($shop_base['shop_free_shipping'] > 0)
        {
            $shop_base['shipping'] = sprintf("满%s免运费", ceil($shop_base['shop_free_shipping']));
        }
        else
        {
            $shop_base['shipping'] = '';
        }*/
        $shop_base['shipping'] = '';

        /*活动信息 start*/
        $promotion = new Promotion();

        //惠抢购 限时折扣 手机专享 新人优惠 送福免单
        $promotion_data = $promotion->getGoodsPromotion($goods_base['goods_id'],$goods_base['common_id'],$goods_common['common_promotion_type']);
        if($promotion_data)
        {
            //惠抢购 限时折扣 手机专享 新人优惠 送福免单
            if($promotion_data['promotion'])
            {
                if($promotion_data['promotion']['promotion_price'] < $goods_base['goods_price'])
                {
                    $promotion_data['promotion']['down_price'] = $goods_base['goods_price'] - $promotion_data['promotion']['promotion_price'];
                    $goods_base['promotion'] = $promotion_data['promotion'];
                }
                else
                {
                    //活动价大于商品价格 取消活动
                    $promotion->editPromotionStateEnd($promotion_data['promotion']['promotion_id'],$goods_base['goods_id'],$goods_common['common_promotion_type']);
                }

                if(!$goods_base['promotion']['is_mian'])
                {
                    $shop_base['shipping'] = '';
                }

                if($goods_base['promotion']['free_freight'])
                {
                    $shop_base['shipping'] = '包邮';
                }

                //惠抢购
                if($goods_base['promotion']['promotion_type'] == Goods_CommonModel::HUIQIANGGOU)
                {
                    if($goods_base['promotion']['scarebuy_starttime'] > get_date_time())
                    {
                        $goods_base['goods_stock'] = $goods_base['goods_stock'] - $promotion_data['promotion']['scarebuy_count'];
                        unset($goods_base['promotion']);
                    }
                }

                //手机专享
                if ( request_string('typ') != 'json' && YLB_Utils_Device::isMobile() && $goods_base['promotion']['promotion_type'] == Goods_CommonModel::SHOUJI)
                {
                    $goods_base['mobile_price'] = $promotion_data['promotion']['promotion_price'];
                    unset($goods_base['promotion']);
                }
            }
        }

        //加价购
        $increase_info = $promotion ->getIncreaseDetailByGoodsId($goods_base['goods_id']);
        if($increase_info)
        {
            unset($increase_info['goods']);
            $goods_base['increase_info'] = $increase_info;
        }

        //满送活动
        $mansong_info = $promotion->getShopGiftInfo($goods_base['shop_id']);

        /*活动信息 end*/

        /*商品分享信息 start*/
        if($goods_base['promotion']['promotion_type'] == Goods_CommonModel::FU)
        {
            //获取送福免单信息
            $goods_base['promotion']['promotion_price'] = $goods_base['goods_price'];
            $goods_base['promotion']['down_price'] = 0;
            //如果登录 获取送福记录
            if(Perm::$userId)
            {
                //获取状态值正常的记录数据
                $FuRecordModel = new Fu_RecordModel();
                $cond_row['user_id'] = Perm::$userId;
                $cond_row['fu_id'] = $goods_base['promotion']['promotion_id'];
                $cond_row['status:<'] = Fu_RecordModel::USED;
                $cond_row['goods_id'] = $goods_id;
                $fu_info = $FuRecordModel->getFuRecordByWhere($cond_row,['fu_record_id'=>'desc']);
                if($fu_info)
                {
                    $goods_base['fu_info'] = $fu_info;
                }

                $sql = 'SELECT COUNT(*) FROM `ylb_fu_record` a LEFT JOIN `ylb_order_base` b ';
                $sql .= 'ON a.order_id = b.order_id ';
                $sql .= 'WHERE a.goods_id = ' . $goods_id . ' AND a.user_id = ' . Perm::$userId .' AND a.order_id <> "" ';
                $sql .= 'AND b.`order_status` >= '. Order_StateModel::ORDER_WAIT_PAY .' AND b.`order_status` <= '. Order_StateModel::ORDER_WAIT_CONFIRM_GOODS;
                $row_count = $FuRecordModel->selectSql($sql);
                if ($row_count)
                {
                    $row_count = current($row_count);
                    $row_count = array_shift($row_count);
                    if ($row_count)
                    {
                        $goods_base['promotion']['fu_order_flag'] = 1;
                    }
                }
            }
        }
        else
        {
            //获取分享立减/立赚信息
            $shareBaseModel = new Share_BaseModel();
            $share_info = $shareBaseModel -> getShareByCommonId($goods_base['common_id']);
            $goods_base['share_info'] = $share_info;
        }
        /*商品分享信息 end*/

        $data['goods_base']   = $goods_base;
        $data['goods_common'] = $goods_common;
        $data['shop_base']    = $shop_base;
        $data['mansong_info'] = $mansong_info;

        return $data;
    }

    /**
     * 获取商品详细信息 供应商用
     *
     * @param $goods_id
     * @return null
     */
    public function getGoodsDetailByGoodId($goods_id)
    {
        //检测商品是否属于正常状态
        $data = $this->checkGoodsII($goods_id);

        if (!$data)
        {
            return null;
        }

        $goods_base   = $data['goods_base'];
        $goods_common = $data['goods_common'];
        $shop_base    = $data['shop_base'];

        //商品规格信息
        if (is_array($goods_base['goods_spec']))
        {
            $goods_base['goods_spec'] = current($goods_base['goods_spec']);
            if($goods_base['goods_spec'] === null)
            {
                $goods_base['goods_spec'] = '';
            }
        }

        //属性
        if($goods_common['common_property'])
        {
            $Goods_PropertyValueModel = new Goods_PropertyValueModel();
            foreach($goods_common['common_property'] as $cgpkey => $cgpval)
            {
                if($cgpval['2'] == 'select')
                {
                    $goods_propertyval = $Goods_PropertyValueModel->getOne($cgpval['1']);
                    $common_property_row[$cgpval['0']] = $goods_propertyval['property_value_name'];
                }
                else if($cgpval['2'] == 'text')
                {
                    $common_property_row[$cgpval['0']] = $cgpval['1'];
                }
            }
            $goods_common['common_property_row'] = $common_property_row;
        }
        else
        {
            $goods_common['common_property_row'] = array();
        }

        //商品common图片
        $image_common_cond                      = array();
        $image_common_cond['common_id']         = $goods_common['common_id'];
        $image_common_cond['images_is_default'] = Goods_ImagesModel::IMAGE_DEFAULT;
        $Goods_ImagesModel                      = new Goods_ImagesModel();

        $goods_common['common_spec_value_c'] = $goods_common['common_spec_value'];
        if (is_array($goods_common['common_spec_value']))
        {
            foreach ($goods_common['common_spec_value'] as $comvk => $comvv)
            {
                foreach ($comvv as $cvk => $cvv)
                {
                    $image_common_cond['images_color_id'] = $cvk;
                    $image_common_row                     = current($Goods_ImagesModel->getGoodsImage($image_common_cond));
                    if ($image_common_row)
                    {
                        $goods_common['common_spec_value'][$comvk][$cvk] = sprintf('<img src="%s" title="%s" alt="%s"/>', image_thumb($image_common_row['images_image'],42,42),$cvv,$cvv);
                        $goods_common['common_spec_value_color'][$cvk] = image_thumb($image_common_row['images_image'], 360, 360);
                    }
                }
            }
        }

        //商品详细图片
        $image_cond                         = array();
        $image_cond['common_id']            = $goods_common['common_id'];
        $image_cond['images_color_id']      = $goods_base['color_id'];
        $image_order                        = array();
        $image_order['images_displayorder'] = 'ASC';
        $image_order['images_is_default']   = 'DESC';
        $image_row                          = array_values($Goods_ImagesModel->getGoodsImage($image_cond, $image_order));

        $goods_base['image_row'] = $image_row;

        $data['goods_base']   = $goods_base;
        $data['goods_common'] = $goods_common;
        $data['shop_base']    = $shop_base;

        return $data;
    }

    /**
     * 查询商品详细信息及其促销信息 分享信息 Zhenzh 20171106修改
     *
     * @param int $goods_id
     * @param $distributor_flag 是否是分销商商品
     * @return array
     */
    public function getGoodsInfoAndPromotionById($goods_id = null,$distributor_flag)
    {
        $goods_info = $this->getOne($goods_id);
        if (empty($goods_info))
        {
            return array();
        }

        if($distributor_flag)
        {
            $goods_info['goods_price'] = $goods_info['goods_recommended_max_price'];
        }

        $goodsCommonModel = new Goods_CommonModel();
        $promotion = new Promotion();
        $shareBaseModel = new Share_BaseModel();

        $common_promotion_type = $goodsCommonModel->getCommonPromotionType($goods_info['common_id']);
        if($common_promotion_type > 0)
        {
            $promotion_data = $promotion->getGoodsPromotion($goods_id,$goods_info['common_id'],$common_promotion_type);
            if($promotion_data)
            {
                if($promotion_data['promotion']['promotion_price'] < $goods_info['goods_price'])
                {
                    $promotion_data['promotion']['down_price'] = $goods_info['goods_price'] - $promotion_data['promotion']['promotion_price'];
                    $goods_info['promotion'] = $promotion_data['promotion'];
                }

                //惠抢购
                if($goods_info['promotion']['promotion_type'] == Goods_CommonModel::HUIQIANGGOU)
                {

                    if($goods_info['promotion']['scarebuy_starttime'] > get_date_time())
                    {
                        $goods_info['goods_stock'] = $goods_info['goods_stock'] - $promotion_data['promotion']['scarebuy_count'];
                        unset($goods_info['promotion']);
                    }
                }

                //手机专享
                if ( request_string('typ') != 'json' && YLB_Utils_Device::isMobile() && $goods_info['promotion']['promotion_type'] == Goods_CommonModel::SHOUJI)
                {
                    $goods_info['mobile_price'] = $promotion_data['promotion']['promotion_price'];
                    unset($goods_info['promotion']);
                }
                /*if($goods_info['promotion']['promotion_type'] == Goods_CommonModel::SHOUJI && !$mobile_flag)
                {
                    $goods_info['mobile_price'] = $promotion_data['promotion']['promotion_price'];
                    unset($goods_info['promotion']);
                }*/
            }
        }

        $share_info = $shareBaseModel -> getShareByCommonId($goods_info['common_id']);
        if($share_info)
        {
            $goods_info['share_info'] = $share_info;
        }

        return $goods_info;
    }

    /**
     * 根据goods_base goods_common 可直接获取goods的规格 只返回规格str
     * @param $goods_base
     * @param $goods_common
     * @return string
     */
    public function getGoodsSpec($goods_base,$goods_common)
    {
        $spec_str = '';
        $spec_name  = $goods_common['common_spec_name'];
        $spec_value = $goods_common['common_spec_value'];
        if (is_array($spec_name) && $spec_name && $goods_base['goods_spec'])
        {
            $goods_spec = current($goods_base['goods_spec']);

            foreach ($goods_spec as $gpk => $gbv)
            {
                foreach ($spec_value as $svk => $svv)
                {
                    if(isset($svv[$gpk]))
                    {
                        $goods_base['spec'][] = $spec_name[$svk] . ":" . $gbv;
                    }
                }
            }
        }
        else
        {
            $goods_base['spec'] = array();
        }

        if($goods_base['spec'])
        {
            foreach($goods_base['spec'] as $spk=>$spv)
            {
                $spec_str = $goods_base['spec_str'] . $spv .'  ';
            }
        }

        return $spec_str;
    }

    //更改单条变多条  goods_id查询common   @weidp
    public function getCommonInfo($goods_id = 0)
    {
        $Goods_CommonModel = new Goods_CommonModel();

        $goods_base = $this->getBase($goods_id);

        if ( empty($goods_base) )
        {
            return array();
        }
        else
        {
            if(count($goods_base)>1)
            {

                foreach($goods_base as $key=>$value)
                {
                    $common_id[] = $value['common_id'];
                }

                $common_id = array_unique($common_id);
            }
            else
            {
                $goods_base = pos($goods_base);
                $common_id   = $goods_base['common_id'];
            }

            $common_data = $Goods_CommonModel->getCommon($common_id);

            return $common_data;
        }

    }

    //新建方法  @author weidp
    //根据goods_id获取common_id
    public function getCommonIdByGoodsId($goods_id = 0)
    {

        $goods_base = $this->getBase($goods_id);

        if(empty($goods_base))
        {
            return array();
        }
        else
        {
            foreach($goods_base as $key=>$value)
            {
                $common_id[] = $value['common_id'];
            }

            $common_id = array_unique($common_id);

            return $common_id;
        }

    }

    //获取商品规格名称
    public function getGoodsSpecName($goods_id = 0)
    {
        $spec_name            = null;
        $Goods_SpecModel      = new Goods_SpecModel();
        $Goods_SpecValueModel = new Goods_SpecValueModel();

        $goods_base = $this->getBase($goods_id);
        $goods_base = pos($goods_base);

        if (!empty($goods_base['goods_spec']))
        {
            $goods_spec = pos($goods_base['goods_spec']);

            if (!empty($goods_spec))
            {
                foreach ($goods_spec as $key => $val)
                {
                    $spec_value = $Goods_SpecValueModel->getSpecValue($key);
                    $spec_value = pos($spec_value);

                    $spec = $Goods_SpecModel->getSpec($spec_value['spec_id']);
                    $spec = pos($spec);

                    $spec_base_name  = $spec['spec_name'];
                    $spec_value_name = $spec_value['spec_value_name'];
                    $spec_name .= "$spec_base_name:&nbsp$spec_value_name&nbsp&nbsp";

                }
            }
        }

        return $spec_name;
    }

    //修改商品的销量（增加）
    public function editGoodsSale($order_goods_id = null)
    {
        //查找出订单商品的信息
        $Order_GoodsModel = new Order_GoodsModel();
        $order_goods_row  = $Order_GoodsModel->getByWhere(array('order_goods_id:IN' => $order_goods_id));

        $Goods_CommonModel = new Goods_CommonModel();

        foreach ($order_goods_row as $key => $val)
        {
            //修改common的销售数量
            $edit_common_row = array('common_salenum' => $val['order_goods_num']);
            $Goods_CommonModel->editCommonTrue($val['common_id'], $edit_common_row);

            //修改商品的销售数量
            $edit_goods_row = array('goods_salenum' => $val['order_goods_num']);
            $this->editBase($val['goods_id'], $edit_goods_row);

        }
    }

    public function getGoodsSpecByGoodId($goods_id)
    {
        $Goods_BaseModel = new Goods_BaseModel();
        $Goods_SpecModel = new Goods_SpecModel();
        $data = array();
        if($goods_id)
        {
            $data = $Goods_BaseModel->getOne($goods_id);

            if(is_array($data['goods_spec']))
            {
                $spec = pos($data['goods_spec']);
                if(!empty($spec))
                {
                    $spec_data = array();
                    foreach($spec as $key=>$value)
                    {
                        $spec_id = $key;
                        $spec_value = $value;
                        if($spec_id)
                        {
                            $spec_name = $Goods_SpecModel->getSpecNameById($spec_id);
                            if($spec_name)
                            {
                                $spec_data[$spec_name] = $spec_value;
                            }
                        }
                    }
                    $data['spec'] = $spec_data;
                }
            }
        }
        return $data;
    }

    public function getGoodsSpecByGoodBase($goods_base)
    {
        $Goods_SpecModel = new Goods_SpecModel();
        if($goods_base)
        {
            if(is_array($goods_base['goods_spec']))
            {
                $spec = pos($goods_base['goods_spec']);
                if(!empty($spec))
                {
                    $spec_data = array();
                    foreach($spec as $key=>$value)
                    {
                        $spec_id = $key;
                        $spec_value = $value;
                        if($spec_id)
                        {
                            $spec_name = $Goods_SpecModel->getSpecNameById($spec_id);
                            if($spec_name)
                            {
                                $spec_data[$spec_name] = $spec_value;
                            }
                        }
                    }
                    $goods_base['spec'] = $spec_data;
                }
            }
        }
        return $goods_base;
    }

    public function createSGIdByWap( $common_id = 0 )
    {
        $spec_goods_ids = array();

        $goods_base = $this->getBaseByCommonId($common_id);

        if ( !empty($goods_base) )
        {
            foreach ($goods_base as $goods_id => $goods_data)
            {
                if ( !empty($goods_data['goods_spec']) )
                {
                    foreach ($goods_data['goods_spec'] as $k => $spec_data)
                    {
                        $spec_ids = array_keys($spec_data);
                        sort($spec_ids);
                        $spec_ids = implode("|", $spec_ids);
                        $spec_goods_ids[$spec_ids] = $goods_id;
                    }
                }
            }
        }
        return $spec_goods_ids;
    }

    public function getTransportInfo ($area_id,$common_id)
    {
        //获取common的transport
        $Goods_CommonModel = new Goods_CommonModel();
        $common_base = $Goods_CommonModel->getOne($common_id);

        //如果该商品绑定了售卖区域，查找售卖其余的运费。如果没有则查找该店铺默认的
        if($common_base['transport_type_id'])
        {
            $Transport_ItemModel = new Transport_ItemssModel();
            $transport = $Transport_ItemModel->getByWhere(array('transport_type_id'=>$common_base['transport_type_id']));
        }

        fb($transport);
        $flag = false;
        foreach($transport as $key=>$value)
        {
            $transport_row = explode(',',trim($value['transport_item_city'],','));
            if(in_array($area_id,$transport_row))
            {
                if($value['transport_item_default_price'] && $value['transport_item_add_price'])
                {
                    $transport_str = sprintf('首重%sKg,默认运费：%s',$value['transport_item_default_num'],format_money($value['transport_item_default_price']));

                    if($value['transport_item_add_price'] > 0)
                    {
                        $transport_str .= sprintf('，每续重%sKg,增加运费：%s',$value['transport_item_add_num'],format_money($value['transport_item_add_price']));
                    }
                }
                else
                {
                    $transport_str = _('免运费');
                }
                $flag = true;
            }

        }

        if ($flag)
        {
            $status = 200;
            $msg    = _('success');
        }
        else
        {
            $msg    =  _('failure');
            $status = 250;
        }

        $data['transport_row'] = $transport_row;
        $data['transport_str'] = $transport_str;

        $result = array();
        $result['data'] 	= $data;
        $result['status'] 	= $status;
        $result['msg'] 		= $msg;

        return $result;
    }

    /**
     *  根据店铺修改商品属性
     */
    public function editBaseByShopId($shop_id,$set=array()){
        if(!$set || !$shop_id){
            return false;
        }

        $result = $this->updateBaseByShopId($shop_id,$set);
        return $result;
    }
    //后台统计
    public function getGoodsSum($field = '*',$cond_row,$group){
        return $this->select($field,$cond_row,$group);
    }
    public function goods_num(){
        return $this->_num();
    }
    public function sql($sql){
        return $this->sql->getAll($sql);
    }
    public function selectReturn($field,$cond_row,$group,$order, $page, $rows)
    {
        $del_flag = $this->selects($field,$cond_row,$group,$order, $page, $rows);
        return $del_flag;
    }
    public function gets($id){
        return $this->get($id);
    }


    /**
     * 批量获取商品属性
     * @param type $goods_ids
     * @return type
     */
    public function getGoodsSpecByGoodIds($goods_ids)
    {
        $data = array();
        if(is_array($goods_ids) && $goods_ids)
        {
            $Goods_BaseModel = new Goods_BaseModel();
            $Goods_SpecModel = new Goods_SpecModel();
            $goods_list = $Goods_BaseModel->get($goods_ids);
            if($goods_list){
                foreach ($goods_list as $val){
                    if(is_array($val['goods_spec']))
                    {
                        $spec = pos($val['goods_spec']);
                        if(!empty($spec))
                        {
                            $spec_data = array();
                            foreach($spec as $key=>$value)
                            {
                                $spec_id = $key;
                                $spec_value = $value;
                                if($spec_id)
                                {
                                    $spec_name = $Goods_SpecModel->getSpecNameById($spec_id);
                                    if($spec_name)
                                    {
                                        $spec_data[$key]['name'] = $spec_name;
                                        $spec_data[$key]['value'] = $spec_value;
                                    }
                                }
                            }
                            $data[$val['goods_id']] = $spec_data;
                        }
                    }
                }
            }
        }
        return $data;
    }

    /**
     *  根据商品common_id color_id 批量修改主图 Zhenzh
     */
    public function editImagesByColorId($common_id,$color_id,$set=array()){
        if(!$set || !$common_id){
            return false;
        }
        $this->sql->setWhere('common_id', $common_id);
        $this->sql->setWhere('color_id', $color_id);
        $result = $this->_update($set);

        return $result;
    }

    /**
     * 查询goods_base表里的字段 Zhenzh
    */
    public function getGoodsBaseFieldById($field,$cond_row)
    {
        $rows =  $this->select($field,$cond_row);
        if($rows)
        {
            $rows = current($rows);
        }
        return $rows;
    }

}

?>