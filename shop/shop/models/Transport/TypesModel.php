<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Transport_TypesModel extends Transport_Types
{
    /**
     * 读取店铺列表
     *
     * @param  int $config_key 主键值
     * @return array $rows 返回的查询内容
     * @access public
     */
    public function getTransportList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        $Transport_ItemModel = new Transport_ItemssModel();
//        $num                 = $this->getByWhere($cond_row, $order_row);
////        如果该店铺没有物流工具模板则生成一个默认的全国物流模板
//        if (!$num)
//        {
//            $add_row['transport_type_name']           = _('全国');
//            $add_row['shop_id']                       = Perm::$shopId;
//            $add_row['transport_type_pricing_method'] = 1;
//            $add_row['transport_type_time']           = get_date_time();
//            $add_row['transport_type_price']          = 10;
//
//            $fl = $this->addType($add_row, true);
//
//            if ($fl)
//            {
//                $add_item_row['transport_type_id']            = $fl;
//                $add_item_row['transport_item_default_num']   = 1;
//                $add_item_row['transport_item_default_price'] = 10;
//                $add_item_row['transport_item_city']          = 'default';
//
//                $Transport_ItemModel->addItem($add_item_row);
//            }
//        }

        $data = $this->listByWhere($cond_row, $order_row, $page, $rows);

        $Base_DistrictModel = new Base_DistrictModel();

        if ($data['items'])
        {
            foreach ($data['items'] as $key => $val)
            {
                $transport_item = array_merge($Transport_ItemModel->getByWhere(array('transport_type_id' => $val['transport_type_id'])));

                if ($transport_item)
                {
//                    if ($transport_item['transport_item_city'] != 'default')
//                    {
//                        $district_row  = explode(',', $transport_item['transport_item_city']);
//                        $district_name = $Base_DistrictModel->getName($district_row);
//                        if (is_array($district_name))
//                        {
//                            $district_name                   = implode(',', $district_name);
//                            $transport_item['district_name'] = $district_name;
//                        }
//
//                    }
//                    else
//                    {
//                        $transport_item['district_name'] = _('全国');
//                    }
                    $data['items'][$key]['transport_item'] = $transport_item;
                }
                else
                {
                    unset($data['items'][$key]);
                }



            }

        }
        fb($data);

        return $data;
    }

    public function getTransportCont($cond_row = array(),$order_row = array(),$page = 1,$rows = 100)
    {
        $data = $this->listByWhere($cond_row, $order_row, $page, $rows);
        return $data;
    }

    public function getTransportInfo($transport_type_id)
    {
        $data = $this->getOne($transport_type_id);

        $Transport_ItemModel = new Transport_ItemModel();

        if ($data)
        {
            $data['transport_item'] = $Transport_ItemModel->getOneByWhere(array('transport_type_id' => $data['transport_type_id']));
        }
        fb($data);
        return $data;
    }

    /**
     * 根据收货地址与cart_id获取物流运费
     * 此方法重新get购物车商品信息 如果调用之前已经获取到购物车的信息改用countCartCost() Zhenzh
     *
     * @param null $city
     * @param array $cart_id
     * @return array
     */
    public function countTransportCost($city = null, $cart_id = array())
    {
        //根据cart_id获取商品的信息
        $cond_row = array('cart_id:IN' => $cart_id);
        //购物车中的商品信息
        $CartModel = new CartModel();
        $cart      = $CartModel->getCardList($cond_row, array());

        $data           = array();

        if(!$city)
        {
            foreach ($cart as $key => $val)
            {

                $data[$key]['cost'] = 0;
                $data[$key]['con']  = '';
            }

            return $data;
        }

        foreach ($cart as $key => $val)
        {
            //获取店铺的免运费设置

            if ($val['shop_free_shipping'] > 0 && $val['sprice'] >= $val['shop_free_shipping'])
            {
                $data[$key]['cost'] = number_format(0, 2);
                $data[$key]['con']  = sprintf("满%s免运费", ceil($val['shop_free_shipping']));
            }
            else
            {
                //获取店铺的物流
                $transport           = $this->getByWhere(array('shop_id' => $key));
                $Transport_ItemModel = new Transport_ItemssModel();

                if ($transport)
                {
                    $chose_transport   = array();
                    $default_transport = array();
                    //最高运费模板价格
                    $max_type_price = '';
                  //动态计算商品每个不同的物流模板，获取价格最高
                  foreach($val['goods'] as $k=>$v)
                  {
                    $jc = $Transport_ItemModel->getByWhere(array('transport_type_id'=>$v['transport_type_id']));
                    foreach($jc as $kk=>$vv)
                    {
                        $rows = explode(',', trim($vv['transport_item_city'],','));
                        if(in_array($city,$rows))
                        {
                            if($vv['transport_item_default_price'] > $max_type_price)
                            {
                                $max_type_price = $jc['transport_item_default_price'];
                                $transport[$v['transport_type_id']]['item'] = $vv;
                                $chose_transport        = $transport[$v['transport_type_id']];
                            }
                        }
                    }
                  }

                  //原代码
//                    foreach ($transport as $tk => $tv)
//                    {
//                        $transport_item = $Transport_ItemModel->getOneByWhere(array('transport_type_id' => $tv['transport_type_id']));
//
//                        $city_row = explode(',', $transport_item['transport_item_city']);
//
//                        if (in_array($city, $city_row))
//                        {
//                            $transport[$tk]['item'] = $transport_item;
//                            $chose_transport        = $transport[$tk];
//                        }
//                        if ($transport_item['transport_item_city'] == 'default')
//                        {
//                            $transport[$tk]['item'] = $transport_item;
//                            $default_transport      = $transport[$tk];
//                        }
//                    }

                    //如果没有对应区域的物流就选择全国的物流

                    if (empty($chose_transport))
                    {
                        $chose_transport = $default_transport;
                    }

                    fb($chose_transport);
                    fb("物流信息");

                    //计算店铺中商品的重量
                    $cubage = 0;
                    foreach ($val['goods'] as $gk => $gv)
                    {
                        $cubage += $gv['cubage'] * $gv['goods_num'];
                    }

                    //计算首重
                    $diff_num = $cubage - $chose_transport['item']['transport_item_default_num'];
                    $cost     = $chose_transport['item']['transport_item_default_price'];

                    if ($diff_num > 0 && $chose_transport['item']['transport_item_add_num'] > 0)
                    {
                        $cost += ceil(($diff_num / $chose_transport['item']['transport_item_add_num'])) * $chose_transport['item']['transport_item_add_price'];
                    }

                    $data[$key]['cost'] = $cost;
                    $data[$key]['con']  = '';
                }
                else
                {
                    $data[$key]['cost'] = 0;
                    $data[$key]['con']  = '';
                }

            }

        }

        return $data;
    }

    /**
     * 根据已有购物车数据获取运费信息 Zhenzh
     * @param null $city
     * @param array $cart_data
     * @return array
     */
    public function countCartCost($city = null, $cart_data)
    {
        $data  = array();
        if(!$city)
        {
            foreach ($cart_data as $key => $val)
            {

                $data[$key]['cost'] = 0;
                $data[$key]['con']  = '';
            }
            return $data;
        }

        foreach ($cart_data as $key => $val)
        {
            //获取店铺的免运费设置
            //if ($val['shop_free_shipping'] > 0 && $val['sprice'] >= $val['shop_free_shipping'])
            if ($val['shop_free_shipping'] > 0 && $val['mian_sprice'] >= $val['shop_free_shipping'])
            {
                $data[$key]['cost'] = number_format(0, 2);
                $data[$key]['con']  = sprintf("满%s免运费", ceil($val['shop_free_shipping']));
            }
            else
            {
                //获取店铺的物流
                $transport           = $this->getByWhere(array('shop_id' => $key));
                $Transport_ItemModel = new Transport_ItemssModel();

                if ($transport)
                {
                    $chose_transport   = array();
                    $default_transport = array();
                    //最高运费模板价格
                    $max_type_price = '';
                    //动态计算商品每个不同的物流模板，获取价格最高
                    foreach($val['goods'] as $k=>$v)
                    {
                        if(!$v['free_freight'])//参加新人活动可设单个商品包邮 此处就不查找此商品的物流模版
                        {
                            $jc = $Transport_ItemModel->getByWhere(array('transport_type_id'=>$v['transport_type_id']));
                            foreach($jc as $kk=>$vv)
                            {
                                $rows = explode(',', trim($vv['transport_item_city'],','));
                                if(in_array($city,$rows))
                                {
                                    if($vv['transport_item_default_price'] > $max_type_price)
                                    {
                                        $max_type_price = $jc['transport_item_default_price'];
                                        $transport[$v['transport_type_id']]['item'] = $vv;
                                        $chose_transport        = $transport[$v['transport_type_id']];
                                    }
                                }
                            }
                        }
                    }

                    //如果没有对应区域的物流就选择全国的物流

                    if (empty($chose_transport))
                    {
                        $chose_transport = $default_transport;
                    }

                    //计算店铺中商品的重量
                    $cubage = 0;
                    foreach ($val['goods'] as $gk => $gv)
                    {
                        if(!$v['free_freight'])//参加新人活动可设单个商品包邮 此处就不计算商品重量
                        {
                            $cubage += $gv['cubage'] * $gv['goods_num'];
                        }
                    }

                    //计算首重
                    $diff_num = $cubage - $chose_transport['item']['transport_item_default_num'];
                    $cost     = $chose_transport['item']['transport_item_default_price'];

                    if ($diff_num > 0 && $chose_transport['item']['transport_item_add_num'] > 0)
                    {
                        $cost += ceil(($diff_num / $chose_transport['item']['transport_item_add_num'])) * $chose_transport['item']['transport_item_add_price'];
                    }

                    $data[$key]['cost'] = $cost;
                    $data[$key]['con']  = '';
                }
                else
                {
                    $data[$key]['cost'] = 0;
                    $data[$key]['con']  = '';
                }
            }
        }

        return $data;
    }

    /**
     * 根据已有购物车数据获取运费信息 Zhenzh 20180521
     * @param null $city
     * @param array $cart_data
     * @return array
     */
    public function countCost($city = null, $cart_data)
    {
        if(!$city)
        {
            return array();
        }

        $transport_type_id_rows = array();
        foreach ($cart_data['glist'] as $key => $val)
        {
            //获取店铺的免运费设置
            if ($val['shop_free_shipping'] > 0 && $val['mian_sprice'] >= $val['shop_free_shipping'])
            {
                $cart_data['glist'][$key]['cost'] = number_format(0, 2);
                $cart_data['glist'][$key]['con']  = sprintf("满%s免运费", ceil($val['shop_free_shipping']));
            }
            else
            {
                foreach($val['goods'] as $k=>$v)
                {
                    if(!$v['bundling_id'] && !$v['free_freight'] && !isset($transport_type_id_rows[$v['goods_id']]))
                    {
                        $transport_type_id_rows[$v['goods_id']] = $v['transport_type_id'];
                    }
                }
            }
        }

        $transport_new_rows = array();
        if($transport_type_id_rows)
        {
            $TransportItemssModel = new Transport_ItemssModel();
            $cond_tran['transport_type_id:IN'] = $transport_type_id_rows;
            $cond_tran['transport_item_city:LIKE'] = '%,'.$city.',%';
            $transport_item_rows = $TransportItemssModel->getByWhere($cond_tran);

            foreach ($transport_item_rows as $key=>$value)
            {
                $transport_new_rows[$value['transport_type_id']] = $value;
            }
        }

        $cart_data['buy_able'] = 1;
        foreach ($cart_data['glist'] as $key => $val)
        {
            if(!isset($cart_data['glist'][$key]['cost']))
            {
                $cart_data['glist'][$key]['cost'] = 0;

                foreach ($val['goods'] as $k=>$v)
                {
                    if(!$v['bl_id'])
                    {
                        if (isset($transport_new_rows[$v['transport_type_id']]))
                        {
                            $chose_transport = $transport_new_rows[$v['transport_type_id']];
                            //计算店铺中商品的重量
                            $cubage = $v['cubage'] * $v['goods_num'];

                            //计算首重
                            $diff_num = $cubage - $chose_transport['transport_item_default_num'];
                            $cost     = $chose_transport['transport_item_default_price'];

                            if ($diff_num > 0 && $chose_transport['transport_item_add_num'] > 0)
                            {
                                $cost += ceil(($diff_num / $chose_transport['transport_item_add_num'])) * $chose_transport['transport_item_add_price'];
                            }

                            $cart_data['glist'][$key]['cost'] += $cost;
                            $cart_data['glist'][$key]['goods'][$k]['goods_cost'] = $cost * 1;
                        }
                        else
                        {
                            $cart_data['glist'][$key]['goods'][$k]['buy_able'] = 0;
                            $cart_data['buy_able'] = 0;
                        }
                    }
                }
            }
        }

        return $cart_data;
    }

    public function delTypes($transport_type_id = null){
        $data = $this->removeType($transport_type_id);
        return $data;
    }

    //删除
    public function delType($transport_type_id = null)
    {
        $Transport_ItemModel = new Transport_ItemModel();

        $flag = $Transport_ItemModel->delItem($transport_type_id);

        if ($flag)
        {
            $data = $this->removeType($transport_type_id);
        }
        else
        {
            $data = false;
        }

        return $data;

    }

    //获取店铺的所有售卖区域
    public function getShopDistrict($shop_id = null)
    {
        $Transport_ItemModel = new Transport_ItemModel();
        $transport_type      = $this->getByWhere(array('shop_id' => $shop_id));

        $city = '';
        foreach ($transport_type as $key => $val)
        {
            $transport_item = $Transport_ItemModel->getOneByWhere(array('transport_type_id' => $val['transport_type_id']));
            if ($transport_item)
            {
                if ($transport_item['transport_item_city'] != 'default')
                {
                    $city .= $transport_item['transport_item_city'] . ',';
                }

            }
            else
            {
                unset($transport_type[$key]);
            }
        }

        $city_row = explode(',', $city);

        return $city_row;
    }
    //修改店铺类型
    public function editTransportType($prmary_key,$field = null,$flag = null)
    {
        $data = $this->edit($prmary_key,$field,$flag);
        return $data;
    }

    /**
     * 计算运费
     *
     * @param null $city         收货地址城市id
     * @param $data              数据源
     * @param int $is_add_order  0--订单结算页 1--生成订单
     * @return array             返回包含运费/是否有货的数据源
     */
    public function cost($city = null, $data,$is_add_order = 0)
    {
        $row = array();

        if(!$city)
        {
            return array();
        }

        //如果有分销商品 分割订单
        $sup_shop_id = array();//定义一个新数组 盛放所有供应商店铺id
        foreach ($data as $key => $val)
        {
            $temp_goods = array();
            foreach($val['goods'] as $k=>$v)
            {
                //如果是分销商品 拆单 以店铺id做key 分成多个数组把商品分开
                if($v['product_is_behalf_delivery'] && $v['supply_shop_id'] && $v['goods_base']['goods_parent_id'])
                {
                    $v['goods_parent_id'] = $v['goods_base']['goods_parent_id'];
                    $temp_goods[$v['supply_shop_id']]['goods'][] = $v;
                    $sup_shop_id[] = $v['supply_shop_id'];
                }
                else
                {
                    $temp_goods[$key]['goods'][] = $v;
                }
            }

            $data[$key]['split_order'] = $temp_goods;
        }

        //获取供应商店铺信息
        if($sup_shop_id)
        {
            //取供应商店铺信息
            $ShopBaseModel = new Shop_BaseModel();
            $shop_info_row = $ShopBaseModel->get($sup_shop_id);
        }

        //定义一个新的数组 盛放所有商品物流模版 格式:$transport_type_id_rows[goods_id] = transport_type_id;
        $transport_type_id_rows = array();

        //1.收集所有模版 装进$transport_type_id_rows
        //2.统计商品重量
        //3.计算分单订单金额
        foreach ($data as $key => $val)
        {
            $temp_total_price = 0;
            foreach($val['split_order'] as $k => $v)
            {
                foreach($v['goods'] as $kk => $vv)
                {
                    if(!$vv['bl_id'])
                    {
                        $transport_type_id_rows[$vv['goods_id']] = $vv['transport_type_id'];
                        //参加新人活动 可设单个商品包邮
                        //送福免单商品
                        //此处就不计算商品重量
                        if(!$vv['free_freight'] && !$vv['fu_done_flag'])
                        {
                            $data[$key]['split_order'][$k]['cubage'] += $vv['cubage'] * $vv['goods_num'];
                        }
                    }

                    if($is_add_order)
                    {
                        $data[$key]['split_order'][$k]['shop_pay_amount'] += $vv['goods_pay_amount'];
                        $data[$key]['split_order'][$k]['shop_sumprice']   += $vv['goods_sumprice'];
                        $data[$key]['split_order'][$k]['commission']      += $vv['goods_commission_amount'];
                    }

                    $temp_total_price += $vv['goods_pay_amount'];
                }
            }

            //如果分配后所有分单合计 != 订单合计 手动调整 误差0.01
            if($temp_total_price != $val['shop_pay_amount'])
            {
                $data[$key]['split_order'][$k]['shop_pay_amount'] += $val['shop_pay_amount'] - $temp_total_price;
            }
        }

        //获取物流模版信息
        $transport_new_rows = array();
        if($transport_type_id_rows)
        {
            $TransportItemssModel = new Transport_ItemssModel();
            $cond_tran['transport_type_id:IN'] = $transport_type_id_rows;
            $cond_tran['transport_item_city:LIKE'] = '%,'.$city.',%';
            $transport_item_rows = $TransportItemssModel->getByWhere($cond_tran);

            foreach ($transport_item_rows as $key=>$value)
            {
                $transport_new_rows[$value['transport_type_id']] = $value;
            }
        }

        //1.选择物流模版
        //2.商品没有物流模版的 设置为无货
        $buy_able = 1;
        foreach ($data as $key => $val)
        {
            foreach($val['split_order'] as $k=>$v)
            {
                foreach ($v['goods'] as $kk => $vv)
                {
                    if(!$vv['bl_id'])
                    {
                        if (isset($transport_new_rows[$vv['transport_type_id']]))
                        {
                            $transport = $transport_new_rows[$vv['transport_type_id']];
                            if($data[$key]['split_order'][$k]['chose_transport'])
                            {
                                if($transport['transport_item_default_price'] > $data[$key]['split_order'][$k]['chose_transport']['transport_item_default_price'])
                                {
                                    $data[$key]['split_order'][$k]['chose_transport'] = $transport;
                                }
                            }
                            else
                            {
                                $data[$key]['split_order'][$k]['chose_transport'] = $transport;
                            }
                        }
                        else
                        {
                            $data[$key]['goods'][$kk]['buy_able'] = 0;
                            $buy_able = 0;
                        }
                    }
                }
            }
        }

        //根据所选物流模版 计算运费
        foreach ($data as $key => $val)
        {
            if($val['bundling_total_cost'])
            {
                $data[$key]['split_order'][$key]['cost'] = $val['bundling_total_cost'];
                $data[$key]['cost'] = $val['bundling_total_cost'];
            }

            $shop_free_shipping = $val['shop_free_shipping'];

            foreach ($val['split_order'] as $k => $v)
            {
                if ($shop_free_shipping > 0 && $val['mian_sprice'] >= $shop_free_shipping)
                {
                    $cost = 0;
                }
                else if($v['cubage'])
                {
                    $chose_transport = $v['chose_transport'];
                    //计算店铺中商品的重量
                    $cubage = $v['cubage'];

                    //计算首重
                    $diff_num = $cubage - $chose_transport['transport_item_default_num'];
                    $cost     = $chose_transport['transport_item_default_price'];

                    if ($diff_num > 0 && $chose_transport['transport_item_add_num'] > 0)
                    {
                        $cost += ceil(($diff_num / $chose_transport['transport_item_add_num'])) * $chose_transport['transport_item_add_price'];
                    }
                }
                else
                {
                    $cost = 0;
                }

                $sp_cost = 0;
                if($key != $k && isset($shop_info_row[$k]))
                {
                    $sp_shop_free_shipping = $shop_info_row[$k]['shop_free_shipping'];
                    if ($sp_shop_free_shipping > 0 && $v['shop_pay_amount'] >= $sp_shop_free_shipping)
                    {
                        $sp_cost = 0;
                    }
                    else
                    {
                        if($v['cubage'])
                        {
                            $chose_transport = $v['chose_transport'];
                            //计算店铺中商品的重量
                            $cubage = $v['cubage'];

                            //计算首重
                            $diff_num = $cubage - $chose_transport['transport_item_default_num'];
                            $sp_cost     = $chose_transport['transport_item_default_price'];

                            if ($diff_num > 0 && $chose_transport['transport_item_add_num'] > 0)
                            {
                                $sp_cost += ceil(($diff_num / $chose_transport['transport_item_add_num'])) * $chose_transport['transport_item_add_price'];
                            }
                        }
                    }
                }

                $data[$key]['split_order'][$k]['cost'] += $cost;
                $data[$key]['split_order'][$k]['sp_cost'] += $sp_cost;

                $data[$key]['cost'] += $cost;

                unset($data[$key]['split_order'][$k]['chose_transport']);
            }

            if($is_add_order)
            {
                unset($data[$key]['goods']);
            }
            else
            {
                unset($data[$key]['split_order']);
            }
        }

        $row['glist']    = $data;
        $row['buy_able'] = $buy_able;

        return $row;
    }

    /**
     * 根据城市id 商品goods_common 计算运费
     *
     * @param $city         城市
     * @param $goods_common 商品
     * @return float|int
     */
    public function costII($city,$goods_common)
    {
        $TransportItemssModel = new Transport_ItemssModel();
        $cond_tran['transport_type_id'] = $goods_common['transport_type_id'];
        $cond_tran['transport_item_city:LIKE'] = '%,'.$city.',%';
        $transport_item_rows = $TransportItemssModel->getByWhere($cond_tran);

        $choose_cost = 0;
        foreach ($transport_item_rows as $key=>$value)
        {
            $diff_num = $goods_common['cubage'] - $value['transport_item_default_num'];
            $cost     = $value['transport_item_default_price'];

            if ($diff_num > 0 && $value['transport_item_add_num'] > 0)
            {
                $cost += ceil(($diff_num / $value['transport_item_add_num'])) * $value['transport_item_add_price'];
            }

            if($cost > $choose_cost)
            {
                $choose_cost = $cost;
            }
        }

        return $choose_cost;
    }

}

?>