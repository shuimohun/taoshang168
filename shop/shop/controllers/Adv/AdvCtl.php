<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     Zhenzh 广告位
 */
class Adv_AdvCtl extends YLB_AppController
{
    public $Adv_ConModel = null;

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

        $this->Adv_ConModel = new Operation_AdvertisementModel();
	}

	/**
	 * 首页
	 *
	 * @access public
	 */
	public function index()
	{
        $type = request_string('type');//根据广告type获取广告 type在Model里有设定
        $id = request_int('id');//根据广告位id获取广告
        if($type || $id)
        {
            if($type)
            {
                $cond_row['group_id'] = Operation_AdvertisementModel::$adv_id[$type];
                if($type == 'app_start')
                {
                    $ga = date("w");
                    $cond_row['sub_id'] = $ga;
                }
            }
            else if($id)
            {
                $cond_row['group_id'] =  $id;
            }
            $order_row['sort_num'] = 'asc';

            $data = $this->Adv_ConModel->getByWhere($cond_row,$order_row);

            if($data)
            {
                /*foreach ($data as $key=>$value)
                {
                    //Type =1 keyword=手机
                    //wap_url =
                    //pc_url =
                }*/

                $status = 200;
                $msg = 'success';
            }
            else
            {
                $status = 250;
                $msg = '无数据';
            }
        }
        else
        {
            $status = 250;
            $msg = '无效参数';
        }

        if($this->typ == 'json')
        {
            $this->data->addBody(-140,$data,$msg,$status);
        }
        else
        {
            include $this->view->getView();
        }
	}


}

?>