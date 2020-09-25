<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Operation_AdvTypeNameModel extends Operation_AdvTypeName
{
    public static $name = array(
        '1'=>'关键字',
        '2'=>'商品id',
        '3'=>'商店id',
        '4'=>'专题编号',
        '5'=>'链接',
        '6'=>'分类id'
    );
    /**
     * 读取分页列表
     *
     * @param  int $type_id 主键值
     * @return array $rows 返回的查询内容
     * @access public
     */
    public function getTypeList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        return $this->listByWhere($cond_row, $order_row, $page, $rows);
    }

    public function getType($cond_row = array(), $order_row = array())
    {
        $brand = $this->getByWhere($cond_row);

        if (!$brand) {
            return array();
        }

        $type_id = array_column($brand, 'type_id');

        /*$Goods_TypeModel = new Goods_TypeModel();
        $type_cond_row['type_id:IN'] = $type_id;
        $type_row = $Goods_TypeModel->getByWhere($type_cond_row);

        if(!$type_row)
        {
            return array();
        }*/

        $Goods_CatModel = new Goods_CatModel();
        $cat_cond_row['type_id:IN'] = $type_id;
        $cat_row = $Goods_CatModel->getByWhere($cat_cond_row);
        if (!$cat_row) {
            return array();
        }

        return $cat_row;
    }

    public function getUrl($id,$con=null,$u=null){
        $url =  explode(APP_DIR_NAME,YLB_Registry::get('base_url'));
        $arr = array();
        if($data = $this->getOne($id)){
            switch ($id){
                case 1:
                    $arr['wap_url'] = $url[0].'shop_wap/tmpl/product_list.html?keyword='.$con;
                    $arr['web_url'] = $url[0].'shop/index.php?ctl=Goods_Goods&met=goodslist&typ=e&keywords='.$con;
                    $arr['app_keys'] = $data['type_name'];
                    $arr['app_keyword'] = $con;
                    break;
                case 2:
                    $arr['wap_url'] = $url[0].'shop_wap/tmpl/product_detail.html?goods_id='.$con;
                    $arr['web_url'] = $url[0].'shop/index.php?ctl=Goods_Goods&met=goods&type=goods&gid='.$con;
                    $arr['app_keys'] = $data['type_name'];
                    $arr['app_keyword'] = $con;
                    break;
                case 3:
                    $arr['wap_url'] = $url[0].'shop_wap/tmpl/store.html?shop_id='.$con.'&tab=.goods';
                    $arr['web_url'] = $url[0].'shop/index.php?ctl=Shop&met=goodsList&id='.$con;
                    $arr['app_keys'] = $data['type_name'];
                    $arr['app_keyword'] = $con;
                    break;
                case 4:
                    $arr['wap_url'] = $url[0].'shop_wap/tmpl/special.html';
                    $arr['web_url'] = $url[0].'shop/index.php';
                    $arr['app_keys'] = $data['type_name'];
                    $arr['app_keyword'] = 'special';
                    break;
                case 5:
                    $arr['url'] = htmlspecialchars_decode($u);
                    $arr['app_keys'] = $data['type_name'];
                    break;
                case 6:
                    $arr['wap_url'] = $url[0].'shop_wap/tmpl/product_list.html?cat_id='.$con;
                    $arr['web_url'] = $url[0].'shop/index.php?ctl=Goods_Goods&met=goodslist&typ=e&cat_id='.$con;
                    $arr['app_keys'] = $data['type_name'];
                    $arr['app_keyword'] = $con;
                    break;
            }

            return $arr;
        }else{
            return false;
        }

    }

}
