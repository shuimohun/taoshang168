<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * @author
 */

//Api_Controller
class Api_Shop_GetDataCtl extends Api_Controller
{

    public $orderBaseModel = null;
    public $shopBaseModel = null;

    /**
     * 初始化方法，构造函数
     *
     * @access public
     */
    public function init()
    {
        $this->orderBaseModel = new Order_BaseModel();
        $this->shopBaseModel    = new Shop_BaseModel();
    }

    public function getAreaData()
    {
        //获取所有省份自治区
        $baseDistrictModel = new Base_DistrictModel();
        $district_base     = $baseDistrictModel->getDistrictTree(0, false);
        //$data['district']  = $district_base;

        $shop_id = request_string('shop_id');

        $sql ='SELECT user_provinceid,COUNT(user_provinceid) COUNT FROM `YLB_user_info` WHERE user_id IN (SELECT buyer_user_id FROM `YLB_order_base` WHERE shop_id = '.$shop_id.'  GROUP BY buyer_user_id DESC) GROUP BY `user_provinceid`';
        $items =  $this->shopBaseModel->sql($sql);

        foreach ($district_base['items'] as $key=>$val)
        {
            $data[$key]['name'] = $val['district_name'];
            foreach ($items as $k=>$v)
            {

            }
            $data[$key]['value'] = $items[$val['user_provinceid']];
        }

        $this->data->addBody(-140, $data);
    }
}

?>