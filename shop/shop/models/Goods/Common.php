<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 *
 *
 * @category   Framework
 * @package    __init__
 * @author     WenQingTeng
 * @copyright  Copyright (c) 2017, 温庆腾
 * @version    1.0
 * @todo
 */
class Goods_Common extends YLB_Model
{
	public $_cacheKeyPrefix  = 'c|goods_common|';
	public $_cacheName       = 'goods';
	public $_tableName       = 'goods_common';
	public $_tablePrimaryKey = 'common_id';

	public $jsonKey = array(
		'common_spec_value',
		'common_spec_name',
		'common_property',
		'shop_goods_cat_id',
		'goods_id',
		'common_location'
	);

	public $goodsPropertyIndexModel;

	/**
	 * @param string $user User Object
	 * @var   string $db_id 指定需要连接的数据库Id
	 * @return void
	 */
	public function __construct(&$db_id = 'shop', &$user = null)
	{
		$this->_tableName = TABEL_PREFIX . $this->_tableName;
		$this->_cacheFlag = CHE;
		parent::__construct($db_id, $user);

		$this->goodsPropertyIndexModel = new Goods_PropertyIndexModel();
	}

	/**
	 * 根据主键值，从数据库读取数据
	 *
	 * @param  int $common_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getCommon($common_id = null, $sort_key_row = null)
	{
		$rows = array();
		$rows = $this->get($common_id, $sort_key_row);

		return $rows;
	}

	/**
	 * 插入
	 * @param array $field_row 插入数据信息
	 * @param bool $return_insert_id 是否返回inset id
	 * @param array $field_row 信息
	 * @return bool  是否成功
	 * @access public
	 */
	public function addCommon($field_row, $return_insert_id = true)
	{

		$add_flag = $this->add($field_row, $return_insert_id);

		if ($add_flag && !empty($field_row['common_property']))
		{
			foreach ($field_row['common_property'] as $key => $val)
			{
				$property_value = $val[1];

				if (!empty($property_value))
				{
					$property_id = str_replace('property_', '', $key);

					$update_pro_index['common_id']         = $add_flag;
					$update_pro_index['property_id']       = $property_id;
					$update_pro_index['property_value_id'] = $property_value;

					$flag = $this->goodsPropertyIndexModel->addPropertyIndex($update_pro_index, true);
				}
			}
		}

		return $add_flag;
	}

	/**
	 * 根据主键更新表内容
	 * @param mix $common_id 主键
	 * @param array $field_row key=>value数组
	 * @return bool $update_flag 是否成功
	 * @access public
	 */
	public function editCommon($common_id = null, $field_row, $flag = false)
	{
		$update_flag = $this->edit($common_id, $field_row, $flag);

		return $update_flag;
	}

	public function editCommonTrue($common_id = null, $field_row)
	{
		$update_flag = $this->edit($common_id, $field_row, true);

		return $update_flag;
	}

	/**
	 * 更新单个字段
	 * @param mix $common_id
	 * @param array $field_name
	 * @param array $field_value_new
	 * @param array $field_value_old
	 * @return bool $update_flag 是否成功
	 * @access public
	 */
	public function editCommonSingleField($common_id, $field_name, $field_value_new, $field_value_old)
	{
		$update_flag = $this->editSingleField($common_id, $field_name, $field_value_new, $field_value_old);

		return $update_flag;
	}

	/**
	 * 删除操作 - //处理业务逻辑, 必须将自选删除
	 * @param int $common_id
	 * @return bool $del_flag 是否成功
	 * @access public
	 */
	public function removeCommon($common_id)
	{
		$rs_row = array();

		//删除SKU商品
		$Goods_BaseModel = new Goods_BaseModel();

		$goods_id_row = $Goods_BaseModel->getGoodsIdByCommonId($common_id);

		if ($goods_id_row)
		{
		    //删除相关商品图片
            $goodsImagesModel = new Goods_ImagesModel();    //YLB_goods_images  images_id
            $res = $goodsImagesModel->removeImages($common_id);

            //删除goods_base
			$num = $Goods_BaseModel->removeBase($goods_id_row);
			check_rs($num, $rs_row);
		}

		$goodsCommonDetailModel = new Goods_CommonDetailModel();
        $goods_common_detail = $goodsCommonDetailModel->getOne($common_id);
        if($goods_common_detail)
        {
            $goodsCommonDetailModel->removeCommonDetail($common_id);
        }

		//删除商品本身
		$del_flag = $this->remove($common_id);
		check_rs(true, $rs_row);


		//$this->removeKey($common_id);
		return is_ok($rs_row);
	}

	//推荐商品
	public function getRecommonRow($data_recommon)
	{
        foreach ($data_recommon['items'] as $key => $value)
        {
            $goods_id = null;
            $promotion_price = 0;
            if($value['common_promotion_type'] > 0)
            {
                $goods_data = $this->getGoodsIdByType($value['common_id'],$value['common_promotion_type']);
                if($goods_data)
                {
                    $goods_id = $goods_data['goods_id'];
                    $promotion_price = $goods_data['promotion_price'];
                }
            }
            else if($value['common_is_jia'])
            {
                $goods_data = $this->getGoodsIdByType($value['common_id'],'jia');
                if($goods_data)
                {
                    $goods_id = $goods_data['goods_id'];
                }
            }

            if(!$goods_id && is_array($value['goods_id']))
            {
                $goods_id = $value['goods_id']['goods_id']?$value['goods_id']['goods_id']:$value['goods_id'][0]['goods_id'];
            }

            if($goods_id == 1)
            {
                $goods_id = $this->getGoodsId($value['common_id']);
            }

            $data_recommon['items'][$key]['goods_id'] = $goods_id;
            if($promotion_price)
            {
                $data_recommon['items'][$key]['promotion_price'] = $promotion_price - $data_recommon['items'][$key]['common_share_price'];
            }
        }

        return $data_recommon['items'];
	}

    //推荐商品 Zhenzh 20180421
    public function getRecommendRow($data)
    {
        foreach ($data as $key => $value)
        {
            $goods_id = null;
            $promotion_price = 0;
            if($value['common_promotion_type'] > 0)
            {
                $goods_data = $this->getGoodsIdByType($value['common_id'],$value['common_promotion_type']);
                if($goods_data)
                {
                    $goods_id = $goods_data['goods_id'];
                    $promotion_price = $goods_data['promotion_price'];
                }
            }
            else if($value['common_is_jia'])
            {
                $goods_data = $this->getGoodsIdByType($value['common_id'],'jia');
                if($goods_data)
                {
                    $goods_id = $goods_data['goods_id'];
                }
            }

            if(!$goods_id && is_array($value['goods_id']))
            {
                $goods_id = $value['goods_id']['goods_id']?$value['goods_id']['goods_id']:$value['goods_id'][0]['goods_id'];
            }

            if($goods_id == 1)
            {
                $goods_id = $this->getGoodsId($value['common_id']);
            }

            $data[$key]['goods_id'] = $goods_id;
            if($promotion_price)
            {
                $data[$key]['promotion_price'] = $promotion_price - $data['items'][$key]['common_share_price'];
            }
        }

        return $data;
    }

    /**
     * 根据goods_common 查询到goods_id 并返回原集合(goods_id优先取参加了活动的)
     * @auther Zhenzh 20171225
     * @param $goods_common
     * @return $goods_common
     */
    public function getGoodsIdByCommon($goods_common)
    {
        $goods_id = null;
        if($goods_common['common_promotion_type'] > 0)
        {
            $goods_data = $this->getGoodsIdByType($goods_common['common_id'],$goods_common['common_promotion_type']);
            if($goods_data)
            {
                $goods_id = $goods_data['goods_id'];
            }
        }
        else if($goods_common['common_is_jia'])
        {
            $goods_data = $this->getGoodsIdByType($goods_common['common_id'],'jia');
            if($goods_data)
            {
                $goods_id = $goods_data['goods_id'];
            }
        }

        if(!$goods_id && is_array($goods_common['goods_id']))
        {
            $goods_id = $goods_common['goods_id']['goods_id']?$goods_common['goods_id']['goods_id']:$goods_common['goods_id'][0]['goods_id'];
        }

        if($goods_id == 1)
        {
            $goods_id = $this->getGoodsId($goods_common['common_id']);
        }

        $goods_common['goods_id'] = $goods_id;

        return $goods_common;
    }

    /**
     * 根据common_id 取任意对应goods_id
     *
     * @param $common_id
     * @return mixed
     */
	public function getGoodsId($common_id)
	{
		$Goods_BaseModel = new Goods_BaseModel();
		$data            = $Goods_BaseModel->getOneByWhere(array('common_id' => $common_id,'goods_is_shelves' => $Goods_BaseModel::GOODS_UP));
		$id              = $data['goods_id'];
		return $id;
	}

	public function getGoodsIdByType($common_id,$type)
    {
        $data = null;
        $model = null;
        $sql = '';
        $order = '';
        switch ($type)
        {
            case Goods_CommonModel::HUIQIANGGOU :
                $model = new ScareBuy_BaseModel();
                $field = 'goods_id,scarebuy_price promotion_price ';
                $sql = ' AND `scarebuy_state` = '.ScareBuy_BaseModel::NORMAL.' AND `scarebuy_starttime`< "'.get_date_time().'" AND `scarebuy_endtime`> "'.get_date_time().'"';
                $order = ' order by scarebuy_price asc ';
                break;
            case Goods_CommonModel::XIANSHI :
                $model = new Discount_GoodsModel();
                $field = 'goods_id,discount_price promotion_price ';
                $sql = ' AND `discount_goods_state`='.Discount_GoodsModel::NORMAL.' AND `goods_start_time`< "'.get_date_time().'" AND `goods_end_time`> "'.get_date_time().'"';
                $order = ' order by discount_price asc ';
                break;
            case Goods_CommonModel::SHOUJI :
                $model = new Price_GoodsModel();
                $field = 'goods_id,zx_price promotion_price ';
                $sql = ' AND 1=1';
                $order = ' order by zx_price asc ';
                break;
            case Goods_CommonModel::XINREN :
                $model = new NewBuyer_BaseModel();
                $field = 'goods_id,newbuyer_price promotion_price ';
                $sql = ' AND `newbuyer_state`='.NewBuyer_BaseModel::NORMAL.' AND `newbuyer_starttime`< "'.get_date_time().'" AND `newbuyer_endtime`> "'.get_date_time().'"';
                $order = ' order by newbuyer_price asc ';
                break;
            case 'jia' :
                $model = new Increase_GoodsModel();
                $field = 'goods_id';
                $sql = ' AND `goods_start_time`< "'.get_date_time().'" AND `goods_end_time`> "'.get_date_time().'"';
                break;
            default :
                $model = null;
                break;
        }

        if($model)
        {
            $sql = 'SELECT '.$field.' FROM `'.$model->_tableName.'` WHERE common_id = '.$common_id .$sql.$order.' LIMIT 0,1';

            $data = $model->selectSql($sql);
            if($data)
            {
                $data = current($data);
            }
        }

        return $data;
    }

    /**
     * 获取商品spu的主要信息 Zhenzh
     *
     * @param $common_data
     * @return array
     */
    public function getGoodsCommonMain($common_data)
    {
        $Goods_CommonModel = new Goods_CommonModel();
        $data             = array();
        if (!empty($common_data['items']))
        {
            foreach ($common_data['items'] as $key => $value)
            {
                $goods_id = $Goods_CommonModel->getGoodsId($value['common_id']);
                if ($goods_id)
                {
                    $data[$key]['goods_id'] = $goods_id;
                }
                $data[$key]['common_id'] = $value['common_id'];
                $data[$key]['common_name'] = $value['common_name'];
                $data[$key]['common_price'] = $value['common_price'];
                $data[$key]['common_image'] = $value['common_image'];
                $data[$key]['common_collect'] = $value['common_collect'];//收藏
                $data[$key]['common_evaluate'] = $value['common_evaluate'];//评论
                $data[$key]['common_salenum'] = $value['common_salenum'];//销量
                $data[$key]['common_promotion_type'] = $value['common_promotion_type'];//活动类型
                $data[$key]['common_share_price'] = $value['common_share_price'];//分享立减
                $data[$key]['common_shared_price'] = $value['common_shared_price'];//分享立减
                $data[$key]['common_is_promotion'] = $value['common_is_promotion'];//是否立赚
                $data[$key]['common_promotion_price'] = $value['common_promotion_price'];//分享立赚
                $data[$key]['common_is_jia'] = $value['common_is_jia'];//加价购
            }
        }
        return $data;
    }

	/**
	 * 获取商品数目
	 *
	 * @param  int $common_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getCommonStateNum($shop_id, $state = Goods_CommonModel::GOODS_STATE_NORMAL,$verfiy = Goods_CommonModel::GOODS_VERIFY_ALLOW)
	{
		/*
		Goods_CommonModel::GOODS_STATE_NORMAL;
		Goods_CommonModel::GOODS_STATE_OFFLINE;
		Goods_CommonModel::GOODS_STATE_ILLEGAL;

		Goods_CommonModel::GOODS_VERIFY_WAITING;//待审核
		*/
		$row                 = array();
		$row['shop_id']      = $shop_id;

		if (-1 != $state)
		{
			$row['common_state'] = $state;
		}
		
		if(-1 != $verfiy)
		{
			$row['common_verify'] = $verfiy;
		}

		$num = $this->getNum($row);

		return $num;
	}

	/**
	 * 获取商品数目
	 *
	 * @param  int $common_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getCommonVerifyNum($shop_id, $state = Goods_CommonModel::GOODS_VERIFY_WAITING)
	{
		/*
		Goods_CommonModel::GOODS_STATE_NORMAL;
		Goods_CommonModel::GOODS_STATE_OFFLINE;
		Goods_CommonModel::GOODS_STATE_ILLEGAL;

		Goods_CommonModel::GOODS_VERIFY_WAITING;//待审核
		*/
		$row                  = array();
		$row['shop_id']       = $shop_id;
		$row['common_verify'] = $state;

		$num = $this->getNum($row);

		return $num;
	}
    
    /**
     *  根据店铺修改商品属性
     */
    public function updateCommonByShopId($shop_id,$set=array()){
        if(!$set || !$shop_id){
            return false;
        }
        $this->sql->setWhere('shop_id', $shop_id);
        $result = $this->_update($set);
        return $result;
    }



}

?>