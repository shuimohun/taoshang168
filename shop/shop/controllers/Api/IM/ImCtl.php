<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}



/**
 *  im是否显示，
 *  解决
 * @todo
 */
class Api_IM_ImCtl extends YLB_AppController
{
	public function index()
	{
        if(Web_ConfigModel::value('im_statu')==1 && isset($_COOKIE['id']) && $_COOKIE['id']  )
        {
            $str = "<iframe id='imbuiler' scrolling=\"no\" frameborder=\"0\" style='z-index: 9999;display:none;position: fixed;right: 36px;bottom: 0;border: 0;height:500px;width:1000px;' src='".YLB_Registry::get('im_url')."'></iframe>";
            echo trim($str);
        }
	}

    public function getShopName()
    {
        $data = array();
        $user_id_rows = request_row('id');
        $ShopBaseModel = new Shop_BaseModel();
        $rows = $ShopBaseModel->getByWhere(array('user_id:IN'=>$user_id_rows));

        if($rows)
        {
            foreach ($rows as $key=>$value)
            {
                $data[$value['user_id']] = $value['shop_name'];
            }
        }
        $this->data->addBody(-1,$data);
    }
 
}

 