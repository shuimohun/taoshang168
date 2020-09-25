<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Goods_CommonModel extends Goods_Common
{
    const GOODS_STATE_NORMAL  = 1;  //正常
    const GOODS_STATE_OFFLINE = 0;  //下架下架
    const GOODS_STATE_ILLEGAL = 10; //违规下架-禁售
    const GOODS_STATE_TIMING  = 2;  //定时发布

    const GOODS_VIRTUAL = 1;   //虚拟商品
    const GOODS_NORMAL = 0;   //实物商品

    const GOODS_VIRTUAL_REFUND = 1;   //支持过期退款

    const GOODS_NO_ALARM = 0;  //不需要预警

    const RECOMMEND_TRUE = 2;
    const RECOMMEND_FALSE = 1;

    public static $stateMap = array(
        '0' => '下架',
        '1' => '正常',
        '10' => '违规（禁售）'
    );

    const GOODS_VERIFY_ALLOW   = 1;  //通过
    const GOODS_VERIFY_DENY    = 0;  //未通过
    const GOODS_VERIFY_WAITING = 10; //审核 中

    const CONTRACT_USE = 1;
    public static $verifyMap = array(
        '0' => '未通过',
        '1' => '通过',
        '10' => '待审核'
    );

    const NOPROMOTION = 0;//未参加活动
    const HUIQIANGGOU = 1;//惠抢购
    const XIANSHI = 2;//限时折扣
    const SHOUJI = 3;//手机专享
    const XINREN = 4;//新人优惠
    const ZAOWANSHI = 5;//早市/晚市
    const FU = 6;//送福免单
    public static $promotionTypeMap = array(
        '0' => '未参加活动',
        '1' => '惠抢购',
        '2' => '限时折扣',
        '3' => '手机专享',
        '4' => '新人优惠',
        '6' => '送福免单'
    );

    public static $promotionMap = array(
        '1' => '惠',
        '2' => '限时',
        '3' => '手机',
        '4' => '新',
    );


    /**
     * 读取分页列表
     */
    public function getCommonList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        return $this->listByWhere($cond_row, $order_row, $page, $rows);
    }

    public function getCommonNormalList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        $cond_row['common_state'] = Goods_CommonModel::GOODS_STATE_NORMAL;
        $cond_row['common_verify'] = Goods_CommonModel::GOODS_VERIFY_ALLOW;
        return $this->listByWhere($cond_row, $order_row, $page, $rows);
    }
    //新建方法获取可用common并且获取goods_id并且是否收藏  weidp
    public function getCommonListByCond($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        $share_price = new Share_PriceModel();
        $cond_row['common_state']  = Goods_CommonModel::GOODS_STATE_NORMAL;
        $cond_row['common_verify'] = Goods_CommonModel::GOODS_VERIFY_ALLOW;
        $cond_row['shop_status']   = Shop_BaseModel::SHOP_STATUS_OPEN;

        $row = $this->listByWhere($cond_row, $order_row, $page, $rows);

        if(perm::checkUserPerm())
        {
            $user_id = perm::$userId;

            $favorite = new User_FavoritesGoodsModel();

            $favorite_base =  array_merge($favorite->getFavoritesGoodsAll(array('user_id'=>$user_id)));

            $favorite_goods_id = array_column($favorite_base,'goods_id');

        }

        foreach($row['items'] as $key=>$value)
        {
            $goods_id = $this->getNormalStateGoodsId($value['common_id']);

            $share = $share_price->isShare($value['common_id'],$user_id);

            $data[$key] = $value;

            if($share)
            {
                $data[$key]['is_share'] = 1;
            }
            else
            {
                $data[$key]['is_share'] = 0;
            }

            $data[$key]['id_goods'] = $goods_id;

            if(in_array($data[$key]['id_goods'],$favorite_goods_id))
            {
                $data[$key]['is_favorite'] = 1;
            }
            else
            {
                $data[$key]['is_favorite'] = 0;
            }
        }

        return $data;
    }

    //取单条数据并获得goods_id
    public function getOneMyId($cond_row = array(),$order_row = array()){
        $share_price = new Share_PriceModel();
        $cond_row['common_state']  = Goods_CommonModel::GOODS_STATE_NORMAL;
        $cond_row['common_verify'] = Goods_CommonModel::GOODS_VERIFY_ALLOW;
        $cond_row['shop_status']   = Shop_BaseModel::SHOP_STATUS_OPEN;
        $row = $this->getOneByWhere($cond_row,$order_row);
        if(perm::checkUserPerm())
        {
            $user_id = perm::$userId;

            $favorite = new User_FavoritesGoodsModel();

            $favorite_base =  array_merge($favorite->getFavoritesGoodsAll(array('user_id'=>$user_id)));

            $favorite_goods_id = array_column($favorite_base,'goods_id');

        }
        if($row){
            $goods_id = $this->getNormalStateGoodsId($row['common_id']);

            $share = $share_price->isShare($row['common_id'],$user_id);

            $data = $row;

            if($share)
            {
                $data['is_share'] = 1;
            }
            else
            {
                $data['is_share'] = 0;
            }

            $data['id_goods'] = $goods_id;

            if(in_array($data['id_goods'],$favorite_goods_id))
            {
                $data['is_favorite'] = 1;
            }
            else
            {
                $data['is_favorite'] = 0;
            }
            return $data;
        }else{
            return false;
        }

    }

    //新建方法同上getCommonListByCond
    public function getNormalCommonList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100,$user_id = null)
    {
        $share_price = new Share_PriceModel();
        $cond_row['common_state']  = Goods_CommonModel::GOODS_STATE_NORMAL;
        $cond_row['common_verify'] = Goods_CommonModel::GOODS_VERIFY_ALLOW;
        $cond_row['shop_status']   = Shop_BaseModel::SHOP_STATUS_OPEN;

        $row = $this->listByWhere($cond_row, $order_row, $page, $rows);

        if($user_id)
        {
            $favorite = new User_FavoritesGoodsModel();

            $favorite_base =  array_merge($favorite->getFavoritesGoodsAll(array('user_id'=>$user_id)));

            $favorite_goods_id = array_column($favorite_base,'goods_id');
        }
        else
        {
            if(Perm::checkUserPerm())
            {
                $user_id = perm::$userId;

                $favorite = new User_FavoritesGoodsModel();

                $favorite_base =  array_merge($favorite->getFavoritesGoodsAll(array('user_id'=>$user_id)));

                $favorite_goods_id = array_column($favorite_base,'goods_id');
            }

        }

        foreach($row['items'] as $key=>$value)
        {
            $goods_id = $this->getNormalStateGoodsId($value['common_id']);

            $share = $share_price->isShare($value['common_id'],$user_id);


            if($share)
            {
                $row['items'][$key]['is_share'] = 1;
            }
            else
            {
                $row['items'][$key]['is_share'] = 0;
            }

            $row['items'][$key]['id_goods'] = $goods_id;

            if(in_array($row['items'][$key]['id_goods'],$favorite_goods_id))
            {
                $row['items'][$key]['is_favorite'] = 1;
            }
            else
            {
                $row['items'][$key]['is_favorite'] = 0;
            }
        }

        return $row;

    }


    public function getCommonByIds($field = null,$value = array(),$order_row = array())
    {
        return $this->otherGet($field,$value,$order_row);
    }

    public function getCommonCont($cond_row = array())
    {
        return $this->getNum($cond_row);
    }

    /**
     * 读取分页列表
     *
     * @param  int $common_id 主键值
     * @return array $rows 返回的查询内容
     * @access public
     */
    public function getCommonNormal($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        $cond_row['shop_id'] = Perm::$shopId;
        $cond_row['common_state'] = Goods_CommonModel::GOODS_STATE_NORMAL;
        $data = $this->listByWhere($cond_row, $order_row, $page, $rows);
        return $data;
    }

    //获取没有参加活动的商品 Zhenzh
    public function getCommonNoPromotion($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        $cond_row['shop_id'] = Perm::$shopId;
        $cond_row['common_state'] = Goods_CommonModel::GOODS_STATE_NORMAL;
        $cond_row['common_promotion_type'] = Goods_CommonModel::NOPROMOTION;
        $data = $this->listByWhere($cond_row, $order_row, $page, $rows);
        if($data['items'])
        {
            foreach ($data['items'] as $key=>$value )
            {
                $data['items'][$key]['share_sum_price'] = $value['common_share_price'];
                if($value['common_is_promotion'])
                {
                    $data['items'][$key]['share_sum_price']+=$value['common_promotion_price'];
                }
            }
        }
        return $data;
    }

    public function getCommonOffline($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        $cond_row['shop_id'] = Perm::$shopId;
        $cond_row['common_state:in'] = array(
            Goods_CommonModel::GOODS_STATE_OFFLINE,
            Goods_CommonModel::GOODS_STATE_TIMING
        );
        return $this->listByWhere($cond_row, $order_row, $page, $rows);
    }

    public function getCommonIllegal($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        $cond_row['shop_id'] = Perm::$shopId;
        $cond_row['common_state'] = Goods_CommonModel::GOODS_STATE_ILLEGAL;
        return $this->listByWhere($cond_row, $order_row, $page, $rows);
    }

    public function getCommonVerifyWaiting($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        $cond_row['shop_id'] = Perm::$shopId;
        $cond_row['common_verify'] = Goods_CommonModel::GOODS_VERIFY_WAITING;
        return $this->listByWhere($cond_row, $order_row, $page, $rows);
    }


    /**
     * 取得各种下拉框
     *
     * @access public
     */
    public function getStateCombo()
    {
        $data = array();

        foreach (Goods_CommonModel::$stateMap as $id => $name)
        {
            $row                   = array();
            $row['id']             = $id;
            $row['name']           = $name;
            $data['goods_state'][] = $row;
        }


        foreach (Goods_CommonModel::$verifyMap as $id => $name)
        {
            $row         = array();
            $row['id']   = $id;
            $row['name'] = $name;

            $data['goods_verify'][] = $row;
        }

        //goods type
        $Goods_TypeModel = new Goods_TypeModel();
        $goods_type_rows = $Goods_TypeModel->getByWhere();

        if ($goods_type_rows)
        {
            $row = array();
            foreach ($goods_type_rows as $goods_type_row)
            {
                $row         = array();
                $row['id']   = $goods_type_row['type_id'];
                $row['name'] = $goods_type_row['type_name'];

                $data['goods_type'][] = $row;
            }
        }

        return $data;
    }

    /**
     * 读取分页列表+goods_id
     *
     * @param  int $common_id 主键值
     * @return array $rows 返回的查询内容
     * @access public
     */
    public function getGoodsIdList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        $common_list = $this->getByWhere($cond_row, $order_row, $page, $rows);

        $Goods_BaseModel = new Goods_BaseModel();
        foreach ($common_list as $key => $value)
        {
            //这里随便取一个goods_id 因为多个good_id 对应的都是那个产品
            $goods_cond_row['common_id']        = $value['common_id'];
            $goods_cond_row['shop_id']          = $value['shop_id'];
            $goods_cond_row['goods_is_shelves'] = Goods_BaseModel::GOODS_UP;
            $goods_list                         = $Goods_BaseModel->getOneByWhere($goods_cond_row);

            if ($goods_list)
            {
                $common_list[$key]["goods_id"] = $goods_list['goods_id'];
            }
            else
            {
                // $common_list['items'][$key]["goods_id"] = 0;
                //若此common_id没有商品则删除此数组
                unset($common_list[$key]);
            }
        }

        $total = ceil_r(count($common_list) / $rows);

        $start = ($page - 1) * $rows;

        $data_rows = array_slice($common_list, $start, $rows, true);

        $arr              = array();
        $arr['page']      = $page;
        $arr['total']     = $total;  //total page
        $arr['totalsize'] = count($common_list);
        $arr['records']   = count($data_rows);
        $arr['items']     = array_values($data_rows);

        return $arr;

    }

    /**
     * 获取正常状态的商品goods_base 列表
     *
     * @param $cond_common_row 查询goods_common表用
     * @param $order_row goods_base排序
     * @param $page goods_base分页
     * @param $rows
     * @return array goods_base
     */
    public function getNormalSateGoodsBase($cond_common_row, $order_row, $page, $rows)
    {
        //获取所有spu
        $cond_common_row['common_state']  = Goods_CommonModel::GOODS_STATE_NORMAL;
        $cond_common_row['common_verify'] = Goods_CommonModel::GOODS_VERIFY_ALLOW;
        $cond_common_row['shop_status']   = Shop_BaseModel::SHOP_STATUS_OPEN;
        $common_id_rows                   = $this->getKeyByWhere($cond_common_row);

        //根据spu分页获取sku
        $Goods_BaseModel                   = new Goods_BaseModel();
        $cond_base_row['common_id:IN']     = $common_id_rows;
        $cond_base_row['goods_is_shelves'] = Goods_BaseModel::GOODS_UP;
        $cond_base_row['goods_stock:>']    = 0;
        $goods_base_rows                   = $Goods_BaseModel->getBaseList($cond_base_row, $order_row, $page, $rows);
        if($goods_base_rows)
        {
            foreach ($goods_base_rows['items'] as $key=>$value)
            {
                $goods_base_rows['items'][$key]['share_sum_price'] = $value['goods_share_price'];
                if($value['goods_is_promotion'])
                {
                    $goods_base_rows['items'][$key]['share_sum_price'] += $value['goods_promotion_price'];
                }
            }
        }
        return $goods_base_rows;
    }

    //状态正常的商品 列表
    public function getNormalStateGoodsCommon($common_id,$order_row = array(),$cond_row=array())
    {
        if (is_array($common_id))
        {
            $cond_row['common_id:IN'] = $common_id;
        }
        else
        {
            $cond_row['common_id'] = $common_id;
        }

        $cond_row['common_state']  = Goods_CommonModel::GOODS_STATE_NORMAL;
        $cond_row['common_verify'] = Goods_CommonModel::GOODS_VERIFY_ALLOW;
        $cond_row['shop_status']   = Shop_BaseModel::SHOP_STATUS_OPEN;
        $common_rows               = $this->getByWhere($cond_row,$order_row);

        return $common_rows;
    }

    /**
     * 根据common_id读取其中一个状态正常的 goods_id
     *
     * @param  int $common_id 主键值
     * @return array $rows 返回的查询内容
     * @access public
     */
    public function getNormalStateGoodsId($common_id)
    {
        /*$cond_row['common_id']     = $common_id;
        $cond_row['common_state']  = Goods_CommonModel::GOODS_STATE_NORMAL;
        $cond_row['common_verify'] = Goods_CommonModel::GOODS_VERIFY_ALLOW;
        $cond_row['shop_status']   = Shop_BaseModel::SHOP_STATUS_OPEN;
        $common_row                = $this->getOneByWhere($cond_row);
        $goods_id = null;
        if ($common_row)
        {
            if($common_row['common_promotion_type'] > 0)
            {
                $goods_id = $this->getGoodsIdByType($common_id,$common_row['common_promotion_type']);
            }
            else if($common_row['common_is_jia'])
            {
                $goods_id = $this->getGoodsIdByType($common_id,'jia');
            }
            if(!$goods_id && is_array($common_row['goods_id']))
            {
                $goods_id = $common_row['goods_id']['goods_id']?$common_row['goods_id']['goods_id']:$common_row['goods_id'][0]['goods_id'];
            }

            if($goods_id == 1)
            {
                $goods_id = $this->getGoodsId($common_id);
            }
        }*/
        $goods_id = $this->getGoodsId($common_id);
        return $goods_id;
    }


    /**
     * 读取商品,
     *
     * @param  int $common_id 主键值
     * @param  string $type SKU  SPU
     * @return array $rows 返回的查询内容
     * @access public
     */
    public function getGoodsList($cond_row = array(), $order_row = array(), $page = 1, $rows = 10, $property_value_row = array())
    {

        $type = 'SKU';

        //判断辅助属性, left join
        if ($property_value_row)
        {
            $sql = "SELECT SQL_CALC_FOUND_ROWS c.*, gp.goods_id FROM " . TABEL_PREFIX . "goods_common c LEFT OUTER JOIN " . TABEL_PREFIX . "goods_property_index gp ON c.common_id = gp.common_id AND c.common_verify=1 AND c.common_state=1 AND c.shop_status=3 ";
            //需要分页如何高效，易扩展
            $offset = $rows * ($page - 1);
            $this->sql->setLimit($offset, $rows);

            if ($cond_row)
            {
                foreach ($cond_row as $k => $v)
                {
                    $k_row = explode(':', $k);

                    if (count($k_row) > 1)
                    {
                        $this->sql->setWhere('c.' . $k_row[0], $v, $k_row[1]);
                    }
                    else
                    {
                        $this->sql->setWhere('c.' . $k, $v);
                    }

                }
            }
            else
            {

            }
            if ($order_row)
            {
                foreach ($order_row as $k => $v)
                {
                    $this->sql->setOrder('c.' . $k, $v);
                }
            }

            $limit = $this->sql->getLimit();
            $where = $this->sql->getWhere();
            $where = $where . " AND gp.goods_id IS NOT NULL AND gp.goods_is_shelves AND  gp.property_value_id IN (" . implode(', ', $property_value_row) . ")";
            $order = $this->sql->getOrder();
            $sql   = $sql . $where . $order . $limit;
            $common_rows = $this->sql->getAll($sql);

            //读取影响的函数, 和记录封装到一起.
            $total = $this->getFoundRows();
            $common_data              = array();
            $common_data['page']      = $page;
            $common_data['total']     = ceil_r($total / $rows);  //total page
            $common_data['totalsize'] = $total;
            $common_data['records']   = count($common_rows);
            $common_data['items'] = $common_rows;
        }
        else
        {
            $common_data = $this->listByWhere($cond_row, $order_row, $page, $rows, false);
            $common_rows = $common_data['items'];
        }

        if ('SKU' == $type)
        {
            $common_ids = array_column($common_rows, 'common_id');

            if ($common_ids)
            {
                $Goods_BaseModel = new Goods_BaseModel();

                $goods_cond_row['common_id:IN']     = $common_ids;
                $goods_cond_row['goods_is_shelves'] = Goods_BaseModel::GOODS_UP;

                $goods_rows = $Goods_BaseModel->getByWhere($goods_cond_row);

                //获取当前用户收藏的商品id
                $User_FavoritesGoodsModel = new User_FavoritesGoodsModel();

                if (Perm::checkUserPerm()) {
                    $user_favoritr_row = $User_FavoritesGoodsModel->getByWhere(array("user_id" => Perm::$userId));
                    $user_favoritr = array_column($user_favoritr_row,'goods_id');
                } else {
                    $user_favoritr = array();
                }

                foreach ($goods_rows as $key => $goods_row)
                {
                    if ($goods_row && isset($common_rows[$goods_row['common_id']]))
                    {
                        $common_rows[$goods_row['common_id']]["goods_id"] = $goods_row['goods_id'];
                        $common_rows[$goods_row['common_id']]["good"][]   = $goods_row;
                        //判断该商品是否是自己的商品
                        if ($goods_row['shop_id'] == Perm::$shopId) {
                            $common_rows[$goods_row['common_id']]["shop_owner"] = 1;
                        } else {
                            $common_rows[$goods_row['common_id']]["shop_owner"] = 0;
                        }

                        //判断该商品是否已经收藏过
                        if(in_array($goods_row['goods_id'],$user_favoritr)) {
                            $common_rows[$goods_row['common_id']]["is_favorite"] = 1;
                        } else {
                            $common_rows[$goods_row['common_id']]["is_favorite"] = 0;
                        }
                        $cond_row1 = array();
                        $cond_row1['goods_id'] = $goods_row['goods_id'];
                        $priceBaseModel = new Price_BaseModel();
                        $sole_array = $priceBaseModel->getPriceActInfo($cond_row1);
                        if(!empty($sole_array)){
                            $common_rows[$goods_row['common_id']]["zx_price"] = $sole_array['zx_price'];
                        }
                        $voucherModel = new Voucher_TempModel();
                        $voucher = $voucherModel->getOneByWhere(array('shop_id'=>$goods_row['shop_id'],'voucher_t_state'=>$voucherModel::VALID));
                        if($voucher){
                            $common_rows[$goods_row['common_id']]["is_voucher"] = '1';
                        }
                        $bundingModel = new Bundling_GoodsModel();
                        $bunding = $bundingModel->getOneByWhere(array('goods_id'=>$goods_row['goods_id']));
                        if($bunding){
                            $common_rows[$goods_row['common_id']]['is_bunding'] = '1';
                        }
                        $mansongModel = new ManSong_BaseModel();
                        $mansong = $mansongModel->getOneByWhere(array('shop_id'=>$goods_row['shop_id'],'mansong_state'=>$mansongModel::NORMAL));
                        if($mansong){
                            $common_rows[$goods_row['common_id']]['is_man'] = '1';
                        }
                    }

                }
            }
        }

        $common_data['items'] = array_values($common_rows);

        return $common_data;

    }

    /**
     * 读取商品列表
     * 1.只取goods_common表
     * 2.商品分享数据
     * 3.商品评价
     * 4.商品收藏
     *
     * @author Zhenzh
     * @param array $cond_row  搜索条件
     * @param array $order_row 排序
     * @param int $page  页数
     * @param int $rows  条数
     * @param array $property_value_row 属性值
     * @param $sku 是否读取sku goods_base
     * @return array
     */
    public function getGoodsListII($cond_row = array(), $order_row = array(), $page = 1, $rows = 10, $property_value_row = array(),$sku)
    {
        $data = array();

        //判断辅助属性, left join
        if ($property_value_row)
        {
            $sql = "SELECT SQL_CALC_FOUND_ROWS c.* ".", gp.common_id FROM " . TABEL_PREFIX . "goods_common c LEFT OUTER JOIN " . TABEL_PREFIX . "goods_property_index gp ON c.common_id = gp.common_id AND c.common_verify=1 AND c.common_state=1 AND c.shop_status=3 ";
            //需要分页如何高效，易扩展
            $offset = $rows * ($page - 1);
            $this->sql->setLimit($offset, $rows);

            if ($cond_row)
            {
                foreach ($cond_row as $k => $v)
                {
                    $k_row = explode(':', $k);

                    if (count($k_row) > 1)
                    {
                        $this->sql->setWhere('c.' . $k_row[0], $v, $k_row[1]);
                    }
                    else
                    {
                        $this->sql->setWhere('c.' . $k, $v);
                    }
                }
            }
            if ($order_row)
            {
                foreach ($order_row as $k => $v)
                {
                    $this->sql->setOrder('c.' . $k, $v);
                }
            }

            $limit = $this->sql->getLimit();
            $where = $this->sql->getWhere();
            $where = $where . " AND  gp.property_value_id IN (" . implode(', ', $property_value_row) . ")";
            $order = $this->sql->getOrder();
            $sql   = $sql . $where . $order . $limit;

            $data['items'] = $this->sql->getAll($sql);
            $total = $this->getFoundRows();
            $data['page']      = $page;
            $data['total']     = ceil_r($total / $rows);
            $data['totalsize'] = $total;
            $data['records']   = count($data['items']);
        }
        else
        {
            $data = $this->listByWhere($cond_row, $order_row, $page, $rows, false);
        }

        $data['items'] = $this->getRecommonRow($data);

        if ($sku)
        {
            $common_ids = array_column($data['items'], 'common_id');
            if ($common_ids)
            {
                $Goods_BaseModel = new Goods_BaseModel();
                $goods_cond_row['common_id:IN']     = $common_ids;
                $goods_cond_row['goods_is_shelves'] = Goods_BaseModel::GOODS_UP;
                $goods_base_rows = $Goods_BaseModel->getByWhere($goods_cond_row);

                foreach ($goods_base_rows as $key => $value)
                {
                    if (isset($data['items'][$value['common_id']]))
                    {
                        $data['items'][$value['common_id']]["goods_list"][] = $value;
                    }
                }
            }
        }

        if($data['items'])
        {
            //获取分享数据
            $share_data = array();
            $shareModel = new Share_BaseModel();
            $share_row['common_id:IN'] = array_column($data['items'],'common_id');
            $share_rows =  $shareModel->getByWhere($share_row);
            foreach($share_rows as $k=>$v)
            {
                $share_data[$v['common_id']] = $v;
            }

            //获取评价数据
            $goods_star_data = array();
            $Goods_BaseModel   = new Goods_BaseModel();
            $goods_ids = array_column($data['items'],'goods_id');
            $goods_star_rows = $Goods_BaseModel->select('goods_id,goods_evaluation_good_star',array('goods_id:IN'=>$goods_ids));
            foreach($goods_star_rows as $k=>$v)
            {
                $goods_star_data[$v['goods_id']] = $v['goods_evaluation_good_star'];
            }

            //获取收藏数据
            $fav_data = array();
            if (Perm::checkUserPerm())
            {
                $User_FavoritesGoodsModel = new User_FavoritesGoodsModel();
                $fav_rows = $User_FavoritesGoodsModel->select('goods_id',array('goods_id:IN'=>$goods_ids,'user_id'=>Perm::$userId));
                $fav_data = array_column($fav_rows,'goods_id');
            }

            //整合数据 分享/评价/收藏
            foreach($data['items'] as $key=>$val)
            {
                if($share_data && isset($share_data[$val['common_id']]))
                {
                    $data['items'][$key]['share_info'] = $share_data[$val['common_id']];
                }
                if($goods_star_data && isset($goods_star_data[$val['goods_id']]))
                {
                    $data['items'][$key]['goods_evaluation_good_star'] = $goods_star_data[$val['goods_id']];
                }
                if($fav_data && in_array($val['goods_id'],$fav_data))
                {
                    $data['items'][$key]['is_favorite'] = 1;
                }
            }
        }

        return $data;
    }

    public function getGoodsByCommonId($cond_row = array(), $order_row = array())
    {
        $type = 'SKU';

        $common_rows = $this->getByWhere($cond_row, $order_row);

        if ('SKU' == $type)
        {
            $common_ids = array_column($common_rows, 'common_id');

            if ($common_ids)
            {

                $Goods_BaseModel = new Goods_BaseModel();

                $goods_cond_row['common_id:IN']     = $common_ids;
                $goods_cond_row['goods_is_shelves'] = Goods_BaseModel::GOODS_UP;

                $goods_rows = $Goods_BaseModel->getByWhere($goods_cond_row);

                //获取当前用户收藏的商品id
                $User_FavoritesGoodsModel = new User_FavoritesGoodsModel();
                if (Perm::checkUserPerm())
                {
                    $user_favoritr_row = $User_FavoritesGoodsModel->getByWhere(array("user_id" => Perm::$userId));
                    $user_favoritr = array_column($user_favoritr_row,'goods_id');
                }
                else
                {
                    $user_favoritr = array();
                }

                foreach ($goods_rows as $key => $goods_row)
                {
                    if ($goods_row && isset($common_rows[$goods_row['common_id']]))
                    {
                        $common_rows[$goods_row['common_id']]["goods_id"] = $goods_row['goods_id'];
                        $common_rows[$goods_row['common_id']]["good"][]   = $goods_row;
                        //判断该商品是否是自己的商品
                        if ($goods_row['shop_id'] == Perm::$shopId)
                        {
                            $common_rows[$goods_row['common_id']]["shop_owner"] = 1;
                        }
                        else
                        {
                            $common_rows[$goods_row['common_id']]["shop_owner"] = 0;
                        }

                        //判断该商品是否已经收藏过
                        if(in_array($goods_row['goods_id'],$user_favoritr))
                        {
                            $common_rows[$goods_row['common_id']]["is_favorite"] = 1;
                        }
                        else
                        {
                            $common_rows[$goods_row['common_id']]["is_favorite"] = 0;
                        }
                    }
                    else
                    {
                        //错误数据,干掉吧
                        //$common_rows[$goods_row['common_id']]["goods_id"] = 0;
                    }
                }
            }
        }

        $common_data['items'] = array_values($common_rows);

        return $common_data;

    }

    /**
     * 获取热销
     *
     * @param int $shop_id
     * @param int $common_num 默认8个
     * @return array
     */
    public function getHotSalle($shop_id = 0,$common_num = 8)
    {
        $cond_row['shop_id']         = $shop_id;
        $cond_row['common_state']    = $this::GOODS_STATE_NORMAL;
        $order_row['common_salenum'] = 'desc';
        $data                        = $this->listByWhere($cond_row, $order_row, 0, $common_num);

        return $data;
    }

    /**
     * 热门收藏
     *
     * @param int $shop_id
     * @param int $common_num 默认8个
     * @return array
     */
    public function getHotCollect($shop_id = 0,$common_num = 8)
    {
        $cond_row['shop_id']         = $shop_id;
        $cond_row['common_state']    = $this::GOODS_STATE_NORMAL;
        $order_row['common_collect'] = 'desc';
        $data                        = $this->listByWhere($cond_row, $order_row, 0, $common_num);

        return $data;
    }


    /*
     * 向映射添加数据
     * */
    public function createMapRelation($common_id = 0, $common_data = array())
    {}

    /*
     * 根据common_id 获取所有goods_id下面的详细信息
     * @param array $common_id_rows 商品id
     * @return array $re 查询数据
     */
    public function getGoodsDetailRows($common_id_rows)
    {
        $Goods_BaseModel   = new Goods_BaseModel();
        $data = array();
        if(!empty($common_id_rows))
        {
            foreach($common_id_rows as $key=>$value)
            {
                $common_id  = $value;
                $goods_rows = $Goods_BaseModel->getByWhere(array('common_id'=>$common_id));

                if(!empty($goods_rows))
                {
                    $goods_ids = array_column($goods_rows, 'goods_id');
                    foreach($goods_ids as $k=>$v)
                    {
                        //$data[$common_id][$v] =  $Goods_BaseModel->getGoodsSpecByGoodId($v);
                        $data[$common_id][$v] =  $Goods_BaseModel->getGoodsSpecByGoodBase($goods_rows[$v]);
                    }
                }
            }
        }

        return $data;
    }

    //根据$common_rows 获取$goods_base 及规格 Zhenzh
    //商家后台 商品列表调用
    public function getGoodsDetailRowsII($goods_common_rows)
    {
        if(!$goods_common_rows)
        {
            return null;
        }

        $data = array();

        $common_id_rows   = array();
        $data_jia_cids = array();
        $data_jia = array();
        $data_common_rows = array();
        $Promotion = new Promotion();
        $Goods_BaseModel   = new Goods_BaseModel();

        foreach($goods_common_rows as $key=>$value)
        {
            $common_id_rows[] = $value['common_id'];
            $data_common_rows[$value['common_id']] = $value;

            if($value['common_promotion_type'])
            {
                $promotion_rows = $Promotion->getGoodsPromotionByBid($value['common_id'],$value['common_promotion_type']);
                $data_common_rows[$value['common_id']]['promotion'] = $promotion_rows;
            }

            if($value['common_is_jia'])
            {
                $data_jia_cids[] = $value['common_id'];
            }
        }
        $goods_base_rows = $Goods_BaseModel->getByWhere(array('common_id:IN'=>$common_id_rows));

        if($data_jia_cids)
        {
            $Increase_GoodsModel = new Increase_GoodsModel();
            $increase_goods_rows = $Increase_GoodsModel->getByWhere(array('common_id:IN'=>$data_jia_cids));
            if($increase_goods_rows)
            {
                foreach ($increase_goods_rows as $key=>$value)
                {
                    if($value['goods_start_time'] > get_date_time())
                    {
                        $value['state'] = 1;
                    }
                    else if($value['goods_end_time'] < get_date_time())
                    {
                        $value['state'] = 3;
                    }
                    else
                    {
                        $value['state'] = 2;
                    }

                    $data_jia[$value['goods_id']] = $value;
                }
            }
        }

        foreach($goods_base_rows as $k=>$v)
        {
            $goods_common = $data_common_rows[$v['common_id']];
            $goods_base = $this->getGoodsSpec($v,$goods_common);

            if($goods_common['promotion'] && isset($goods_common['promotion'][$k]))
            {
                $goods_base['promotion'] = $goods_common['promotion'][$k];
            }

            if($data_jia && isset($data_jia[$k]))
            {
                $goods_base['goods_jia'] = $data_jia[$k];
            }

            $data[$v['common_id']][$k] = $goods_base;
        }

        return $data;
    }

    //获取商品规格
    public function getGoodsSpec($goods_base,$goods_common)
    {
        /*商品规格信息 start*/
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
        $goods_base['spec_str'] = '';
        if($goods_base['spec'])
        {
            $goods_base['spec_str'] = implode(' ',$goods_base['spec']);
        }
        /*商品规格信息 end*/

        return $goods_base;
    }

    //获取商品规格 Zhenzh 20180727
    public function getGoodsSpecII($goods_spec,$spec_name,$spec_value)
    {
        $spec_str = '';
        $spec     = [];

        if ($goods_spec && $spec_name && $spec_value)
        {
            $goods_spec = decode_json($goods_spec);
            $spec_name  = decode_json($spec_name);
            $spec_value = decode_json($spec_value);

            $goods_spec = current($goods_spec);
            foreach ($goods_spec as $gpk => $gbv)
            {
                foreach ($spec_value as $svk => $svv)
                {
                    if(isset($svv[$gpk]))
                    {
                        $spec[] = $spec_name[$svk] . ":" . $gbv;
                    }
                }
            }
        }

        if($spec)
        {
            $spec_str = implode(' ',$spec);
        }

        return $spec_str;
    }

    /**
     *  根据店铺修改商品属性
     */
    public function editCommonByShopId($shop_id,$set=array()){
        if(!$set || !$shop_id){
            return false;
        }
        $result = $this->updateCommonByShopId($shop_id,$set);
        return $result;
    }

    /**
     * 同步商品common表信息
     *
     * @param $old_common_id  供应商商品common_id
     * @param $shop_info      分销商店铺信息
     * @param string $op      同步类型 add=新增 edit=修改
     * @return array|bool     新增返回新增的common_id 修改返回$common_row
     */
    public function SynchronousCommon($old_common_id,$shop_info,$op = 'add')
    {
        //商品信息
        $Goods_CommonModel = new Goods_CommonModel();

        $common_info = $Goods_CommonModel ->getOne($old_common_id);

        $common_row = array();
        $common_row['common_name']                 = $common_info['common_name'];
        $common_row['cat_pid']                     = $common_info['cat_pid'];
        $common_row['cat_id']                      = $common_info['cat_id'];
        $common_row['cat_name'] 			       = str_replace('&gt;','>',$common_info['cat_name']);
        $common_row['shop_id']                     = $shop_info['shop_id'];
        $common_row['shop_name']                   = $shop_info['shop_name'];
        $common_row['brand_id']                    = $common_info['brand_id'];
        $common_row['brand_name']                  = $common_info['brand_name'];
        $common_row['common_property']             = $common_info['common_property'];
        $common_row['common_spec_name']            = $common_info['common_spec_name'];
        $common_row['common_spec_value']           = $common_info['common_spec_value'];
        $common_row['common_image']                = $common_info['common_image'];
        $common_row['common_price']                = $common_info['goods_recommended_max_price'];
        $common_row['common_cubage']               = $common_info['common_cubage'];
        $common_row['common_market_price']         = $common_info['common_market_price'];
        $common_row['common_cost_price']           = $common_info['common_price'];
        $common_row['common_verify']               = $common_info['common_verify'];
        $common_row['common_stock']                = $common_info['common_stock'];
        $common_row['common_is_virtual']           = $common_info['common_is_virtual'];
        $common_row['common_add_time']             = get_date_time();
        $common_row['common_state']                = Goods_CommonModel::GOODS_STATE_NORMAL;
        $common_row['product_is_allow_update']     = $common_info['product_is_allow_update'];
        $common_row['product_is_allow_price']      = $common_info['product_is_allow_price'];
        $common_row['product_is_behalf_delivery']  = $common_info['product_is_behalf_delivery'];
        $common_row['goods_recommended_min_price'] = $common_info['goods_recommended_min_price'];
        $common_row['goods_recommended_max_price'] = $common_info['goods_recommended_max_price'];
        $common_row['common_parent_id']            = $common_info['common_id'];
        $common_row['supply_shop_id']              = $common_info['shop_id'];
        $common_row['cat_pid']                     = $common_info['cat_pid'];
        $common_row['common_location']             = $common_info['common_location'];
        $common_row['dis_id']                      = $common_info['dis_id'];
        $common_row['common_alarm']                = $common_info['common_alarm'];
        $common_row['common_code']                 = $common_info['common_code'];
        $common_row['transport_type_id']           = $common_info['transport_type_id'];
        $common_row['transport_type_name']         = $common_info['transport_type_name'];
        $common_row['common_share_price']          = $common_info['common_share_price'];
        $common_row['common_shared_price']         = $common_info['common_shared_price'];
        $common_row['common_is_promotion']         = $common_info['common_is_promotion'];
        $common_row['common_promotion_price']      = $common_info['common_promotion_price'];
        if($op == 'add')
        {
            //添加新商品
            $new_common_id = $Goods_CommonModel->addCommon($common_row, true);

            //商品详情信息
            $goodsCommonDetailModel  = new Goods_CommonDetailModel();
            $common_detail = $goodsCommonDetailModel->getOne($old_common_id);
            $common_detail_data['common_id']   = $new_common_id;
            $common_detail_data['common_body'] = $common_detail['common_body'];
            $goodsCommonDetailModel->addCommonDetail($common_detail_data);

            //分享数据
            $ShareBaseModel    = new Share_BaseModel();
            $share_info = $ShareBaseModel->getOneByWhere(array('common_id'=>$old_common_id));
            if($share_info)
            {
                $share_row['weixin']                = $share_info['weixin'];
                $share_row['weixin_timeline']       = $share_info['weixin_timeline'];
                $share_row['sqq']                   = $share_info['sqq'];
                $share_row['qzone']                 = $share_info['qzone'];
                $share_row['tsina']                 = $share_info['tsina'];
                $share_row['share_total_price']     = $share_info['share_total_price'];
                $share_row['share_limit']           = $share_info['share_limit'];
                $share_row['is_promotion']          = $share_info['is_promotion'];
                $share_row['promotion_total_price'] = $share_info['promotion_total_price'];
                $share_row['promotion_unit_price']  = $share_info['promotion_unit_price'];

                $share_id = $ShareBaseModel->getKeyByWhere(array('common_id'=>$new_common_id));
                if($share_id)
                {
                    $ShareBaseModel->editShare($share_id,$share_row);
                }
                else
                {
                    $share_row['common_id'] = $new_common_id;
                    $ShareBaseModel->addShare($share_row);
                }
            }

            //图片
            $GoodsImageModel = new Goods_ImagesModel();
            $goods_image_data = $GoodsImageModel->getByWhere(array('common_id'=>$old_common_id));
            foreach ($goods_image_data as $img_k=>$img_v)
            {
                $img_d['common_id']           = $new_common_id;
                $img_d['shop_id']             = Perm::$shopId;
                $img_d['images_color_id']     = $img_v['images_color_id'];
                $img_d['images_image']        = $img_v['images_image'];
                $img_d['images_displayorder'] = $img_v['images_displayorder'];
                $img_d['images_is_default']   = $img_v['images_is_default'];
                $GoodsImageModel->addImages($img_d);
            }

            //返回商品common_id
            return $new_common_id;

        }
        else
        {
            return $common_row;
        }
    }

    /**
     * 同步商品goods_base表
     *
     * @param $old_common_id 供应商商品common_id
     * @param $new_common_id 分销商商品common_id
     * @param $shop_info     分销商店铺信息
     * @return array         返回新增的goods_id_row
     */
    public function SynchronousGoods($old_common_id,$new_common_id,$shop_info)
    {
        $Goods_BaseModel   = new Goods_BaseModel();

        //根据common_id查询base表，同步base数据
        $base_list = $Goods_BaseModel->getByWhere(array('common_id'=>$old_common_id));

        if(!empty($base_list))
        {
            foreach ($base_list as $k => $v)
            {
                $base_row = array();
                $base_row['common_id']                   = $new_common_id;
                $base_row['shop_id']                     = $shop_info['shop_id'];
                $base_row['shop_name']                   = $shop_info['shop_name'];
                $base_row['goods_name']                  = $v['goods_name'];
                $base_row['cat_id']                      = $v['cat_id'];
                $base_row['brand_id']                    = $v['brand_id'];
                $base_row['goods_spec']                  = $v['goods_spec'];
                $base_row['color_id']                    = $v['color_id'];
                $base_row['goods_price']                 = $v['goods_recommended_max_price'];
                $base_row['goods_market_price']          = $v['goods_market_price'];
                $base_row['goods_stock']                 = $v['goods_stock'];
                $base_row['goods_image']                 = $v['goods_image'];
                $base_row['goods_parent_id']             = $v['goods_id'];
                $base_row['goods_is_shelves']            = Goods_BaseModel::GOODS_UP;
                $base_row['goods_recommended_min_price'] = $v['goods_recommended_min_price'];
                $base_row['goods_recommended_max_price'] = $v['goods_recommended_max_price'];
                $base_row['goods_share_price']           = $v['goods_share_price'];
                $base_row['goods_shared_price']          = $base_row['goods_price'] - $v['goods_share_price'];
                $base_row['goods_is_promotion']          = $v['goods_is_promotion'];
                $base_row['goods_promotion_price']       = $v['goods_promotion_price'];
                $base_row['goods_alarm']                 = $v['goods_alarm'];
                $base_row['goods_code']                  = $v['goods_code'];

                $goods_id = $Goods_BaseModel ->addBase($base_row, true);
                $new_goods_ids[]= array('goods_id' => $goods_id,'color' => $v['color_id']);
            }
        }

        return $new_goods_ids;
    }

    public function getSubQuantity($cond_row)
    {
        return $this->getNum($cond_row);
    }

    //新增商品数
    public function new_goods(){
        $cond['common_add_time:>='] = date('Y-m-d', strtotime('this week'));
        return $this->getRowCount($cond);
    }

    public function sql($sql){
        return $this->sql->getAll($sql);
    }

    public function tabase(){
        return $this->_tableName;
    }

    /**
     * 把商品标记为猜你喜欢
     * @param $common_id
     * @return mixed
     * @author liuguilong
     */
    public function like($common_id){
        $sql = 'UPDATE ylb_goods_common set is_like=1 where common_id='.$common_id;
        return $res = $this->sql->exec($sql);
    }

    /**
     * 取消商品的猜你喜欢
     * @param $common_id
     * @return mixed
     * @author liuguilong
     */
    public function unlike($common_id){
        $sql = 'UPDATE ylb_goods_common set is_like=0 where common_id='.$common_id;
        return $res = $this->sql->exec($sql);
    }

    /**
     * 获取随机展示的猜你喜欢商品（客户端观看）
     * @return mixed
     * @author liuguilong
     */
    public function likes_list(){
        $sql = "SELECT * FROM ylb_goods_common WHERE is_like=1 AND common_state=1 ORDER BY RAND() LIMIT 10";
        return $res = $this->sql->getAll($sql);
    }

    /**
     * 获取所有猜你喜欢商品（分页数据）
     * @param array $cond_row
     * @param array $order_row
     * @param int $page
     * @param int $rows
     * @return array
     * @author liuguilong
     */
    public function getLikesList($cond_row = array('is_like'=>1), $order_row = array(), $page = 1, $rows = 100)
    {
        return $this->listByWhere($cond_row, $order_row, $page, $rows);
    }

    /**
     * 获取商品分类数据
     * @author liuguilong
     */
    public function getCats(){
        $pid = request_int('pid');
        $sql = "SELECT cat_id,cat_name,cat_parent_id FROM YLB_goods_cat WHERE cat_parent_id={$pid}";
        return $res = $this->sql->getAll($sql);
    }

    public function getCommonListMy(){
        $sql = "SELECT * FROM ylb_goods_common limit 10";
        return $res = $this->sql->getAll($sql);
    }

    /**
     * 获取热销商品，web端使用
     * @param string $dataType ： 要获取的数据类型common_salenum => 热销 ,common_collect => 收藏
     * @param int $catIds ： 分类id数组
     * @param int $nums :  要获取的商品数量，热销默认为3条，收藏排行默认为9条
     * @return array
     * @liuguilong 20170718
     */
    public function getGoodsHotList($dataType,$catIds, $page,$nums)
    {
        $cond_row = array();
        $order_row = array();

        if(!empty($catIds)){
            $cond_row['cat_id:IN'] = $catIds;
        }

        $cond_row['common_state'] = $this::GOODS_STATE_NORMAL;  //正常上架
        $order_row[$dataType] = 'desc';
        $data = $this->listByWhere($cond_row, $order_row, $page, $nums);
//		public function listByWhere($cond_row, $order_row = array(), $page=1, $rows=100, $flag=true)
        return $data;
    }

    public  function  select_s($field = '*',$cond_row,$group,$order_row,$flag){
        return $this->select($field,$cond_row,$group,$order_row,$flag);
    }

    //为你推荐随机十条数据  yly
    public function recommend_list(){
        $sql = "SELECT * FROM ylb_goods_common WHERE common_is_recommend=1 AND common_state=1 ORDER BY RAND() LIMIT 10";
        return $res = $this->sql->getAll($sql);
    }

    /**
     * 自定义查询 Zhenzh
     *
     * @param $field
     * @param $cond_row
     * @param $group
     * @return mixed
     */
    public function getFiled($field,$cond_row,$group)
    {
        $rows =  $this->select($field,$cond_row,$group);
        if($rows)
        {
            $rows = current($rows);
        }
        return $rows;
    }

    /**
     * 根据common_id获取goods_common 参加的活动类型
     * @param $common_id
     * @return mixed
     */
    public function getCommonPromotionType($common_id)
    {
        $goods_common = $this->getFiled('common_promotion_type',array('common_id'=>$common_id));
        $common_promotion_type = $goods_common['common_promotion_type'];
        return $common_promotion_type;
    }
    /*
     * 商家首页  根据商品分类 返回销量
     * */
    public function  cat_num_row($cond_row){
        $cat_row = 0;
        $result = $this->getByWhere($cond_row);
        foreach ($result as $key => $value){
            //销量追加
            $cat_row += $value['common_salenum'];
        }
        return $cat_row;
    }


}

?>