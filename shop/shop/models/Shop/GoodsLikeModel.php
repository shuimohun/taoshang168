<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * @author weidp
 */

class Shop_GoodsLikeModel extends Shop_GoodsLike
{
    const  GOODS_LIKE_OPEN = 1;
    const  GOODS_LIKE_OFF  = 2;

    public static $like_status = array(
      '1' => '显示',
      '2' => '不显示'
    );

    //返回推送有效的总条数
    public function getCount()
    {
        $shop_id = perm::$shopId;

        $cond_row['shop_id'] = $shop_id;

        $cond_row['like_state'] = self::GOODS_LIKE_OPEN;

        $data = $this->listByWhere($cond_row);

        return $data['totalsize'];
    }


}