<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * User: zzh
 * Date: 2017/02/16
 * Time: 17:25
 */
class Price_BaseModel extends Price_Base
{
    const NORMAL = 1;//开启
    const END    = 2;//关闭
    const CANCEL = 3;//管理员关闭
    public static $state_array_map = array(
        self::NORMAL => '开启',
        self::END => '关闭',
        self::CANCEL => '管理员关闭'
    );

    public $Price_BaseModel = null;
    public $Goods_CommonModel = null;
    public $goodsBaseModel = null;

    public function __construct()
    {
        parent::__construct();

        $this->Price_GoodsModel = new Price_GoodsModel();
        $this->Goods_CommonModel = new Goods_CommonModel();
        $this->goodsBaseModel    = new Goods_BaseModel();
    }

    public function getNormalPriceByWhere($cond_row)
    {
        $cond_row['price_state'] = Price_BaseModel::NORMAL;
        $row = $this->getOneByWhere($cond_row);
        return $row;
    }

    //增
    public function addPriceActivity($field_row, $return_insert_id)
    {
        return $this->add($field_row, $return_insert_id);
    }

    //删
    public function removePriceActItem($price_id)
    {
        $rs_row = array();

        //删除商品
        $del_flag = $this->remove($price_id);
        check_rs($del_flag, $rs_row);

        return is_ok($rs_row);
    }

    //改
    public function editPriceActInfo($price_id, $field_row)
    {
        $update_flag = $this->edit($price_id, $field_row);

        return $update_flag;
    }

    /**
     * 查询分页列表 Zhenzh
     *
     * @param array $cond_row
     * @param array $order_row
     * @param int $page
     * @param int $rows
     * @return array|int
     */
    public function getPriceList($cond_row=array() , $order_row = array(), $page = 1, $rows = 100)
    {
        $rows = $this->listByWhere($cond_row, $order_row, $page, $rows);
        if ($rows['items'])
        {
            $goods_ids = array_column($rows['items'], 'goods_id');
            $goods_base_rows = $this->goodsBaseModel->getGoodsListByGoodId($goods_ids);
            foreach ($rows['items'] as $key => $value)
            {
                if (in_array($value['goods_id'], array_keys($goods_base_rows)))
                {
                    $rows['items'][$key]['goods_name'] = $goods_base_rows[$value['goods_id']]['goods_name'];
                    $rows['items'][$key]['goods_image'] = $goods_base_rows[$value['goods_id']]['goods_image'];
                    $rows['items'][$key]['goods_price'] = $goods_base_rows[$value['goods_id']]['goods_price'];
                    $rows['items'][$key]['goods_stock'] = $goods_base_rows[$value['goods_id']]['goods_stock'];
                    $rows['items'][$key]['goods_share_price'] = $goods_base_rows[$value['goods_id']]['goods_share_price'];
                    $rows['items'][$key]['share_sum_price'] = $goods_base_rows[$value['goods_id']]['goods_share_price'];
                    if($goods_base_rows[$value['goods_id']]['goods_is_promotion'])
                    {
                        $rows['items'][$key]['share_sum_price'] += $goods_base_rows[$value['goods_id']]['goods_promotion_price'];
                    }

                    //活动价大于商品价
                    if($rows['items'][$key]['zx_price'] > $rows['items'][$key]['goods_price'])
                    {
                        $rows['items'][$key]['price_state'] = self::CANCEL;
                        $expire_cond[] = $value['price_id'];
                    }
                }
                else
                {
                    //参加活动的商品已被删除
                    unset($rows['items'][$key]);
                    $delete_price[] = $value['price_id'];
                }
            }

            //活动状态异常
            if($expire_cond)
            {
                $this->editPriceActInfo($expire_cond,array('price_state'=>self::CANCEL));
            }

            //参加活动的商品已被删除 删除活动
            if($delete_price)
            {
                $this->removePriceActItem($delete_price);
            }
        }
        return $rows;
    }


    public function getPriceActList($cond_row=array() , $order_row = array(), $page = 1, $rows = 100)
    {
        $data_rows = $this->listByWhere($cond_row, $order_row, $page, $rows);

        foreach ($data_rows['items'] as $key => $value)
        {
            $data_row['items'][$key]['count'] = $this->Price_GoodsModel->getCount($value['Price_id']);
            $Goods_BaseModel = new Goods_BaseModel();
            $data_row['items'][$key] = $Goods_BaseModel -> getOne(array('goods_id'=>$value['goods_id']));
            $Price_goods[] = $data_row['items'][$key]['common_id'];

        }

        //查询分享价
        $goods_common_rows = $this->Goods_CommonModel->getNormalStateGoodsCommon($Price_goods);

        foreach ($data_rows['items'] as $key => $value) {
            $data_row['items'][$key]['price_id']   = $value['price_id'];
            $data_row['items'][$key]['zx_price']   = $value['zx_price'];
            $data_row['items'][$key]['share_total_price'] = $goods_common_rows[$value['common_id']]['share_total_price'];
            $data_row['items'][$key]['share_sum_price'] = $goods_common_rows[$value['common_id']]['share_sum_price'];
            $data_row['items'][$key]['shared_price'] = $goods_common_rows[$value['common_id']]['shared_price'];
        }

        return $data_row;
    }

    public function sql($sql){
        return $this->sql->getAll($sql);
    }

    public function getPriceByWhere($cond_row)
    {

        $data_rows = $this->getByWhere($cond_row);

        foreach ($data_rows as $key => $value)
        {
            $data_rows['items'][$key] = _(self::$state_array_map[$value['price_state']]);
        }
        return $data_rows;
    }

    public function getPriceByWheres($cond_row)
    {
        $data_rows = $this->getOneByWhere($cond_row);
        return $data_rows;
    }

    public function getPriceActItemById($Price_id)
    {
        $row = $this->getOne($Price_id);
        $row['Price_state_label'] = _(self::$state_array_map[$row['Price_state']]);
        return $row;
    }

    public function getPriceActInfo($cond_row)
    {
        $row = $this->getOneByWhere($cond_row);
        if ($row)
        {
            $row['Price_state_label'] = _(self::$state_array_map[$row['price_state']]);
        }
        return $row;
    }

    public function getCount($cond_row)
    {
        return $this->getNum($cond_row);
    }

    //除计划任务和管理员取消活动外，其它地方请勿调用
    //更改活动状态为不可用，针对活动到期或管理员关闭
    public function changePriceStateUnnormal($Price_id, $field_row)
    {
        /*$rs_row = array();

        if(is_array($Price_id))
        {
            $cond_row['$Price_id'] = $Price_id;
        }
        else
        {
            $cond_row['$Price_id'] = $Price_id;
        }

        //活动下的商品
        $Price_goods_id_row = $this->Price_GoodsModel->getKeyByWhere($cond_row);

        $flag = $this->Price_GoodsModel->changePriceGoodsUnnormal($Price_goods_id_row);
        check_rs($flag, $rs_row);

        //更改活动状态
        $update_flag = $this->edit($Price_id, $field_row);
        check_rs($update_flag, $rs_row);

        return is_ok($rs_row);*/

    }
}