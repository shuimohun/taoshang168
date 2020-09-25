<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author
 */
class Api_Shop_NpassCtl extends YLB_AppController
{
	public $shopNpassModel = null;
	public $shopBaseModel  = null;

	/**
	 * 初始化方法，构造函数
	 *
	 * @access public
	 */
	public function init()
	{
		$this->shopNpassModel = new Shop_NpassModel();
		$this->shopBaseModel  = new Shop_BaseModel();
	}

	public function  shop_npass(){

        $shop_account = request_string('search_name');

        //按照店主账号查询
        if ($shop_account)
        {

            $type = 'shop_name:LIKE';

            $cond_row[$type] = '%' . $shop_account . '%';
        }

        $data = $this->shopNpassModel->getBaseList($cond_row);
        foreach ($data['items'] as $key => $value){
            $data['items'][$key]['shop_npass_image'] = htmlspecialchars_decode($value['shop_npass_image']);
        }


        $this->data->addBody(-140, $data);
    }


    /**
     *  插入店铺审核不通过店铺
     *  @author yang
     *  @return bool 成功
     * */
    public function AddShopNpass(){

        $cond_row['user_id']            = request_int('user_id');
        $cond_row['user_name']          = request_string('user_name');
        $cond_row['shop_id']            = request_int('shop_id');
        $cond_row['shop_name']          = request_string('shop_name');
        $cond_row['shop_npass_status']  = request_int('shop_npass_status');
        $cond_row['shop_npass_content'] = request_string('shop_npass_content');
        $cond_row['shop_npass_image']   = request_string('content');
        $cond_row['shop_npass_ctime']   = get_date_time();

        //查询店铺信息 寻找店铺状态
        $shop_base_data = $this->shopBaseModel->getOneByWhere(array('shop_id'=>$cond_row['shop_id']));
//        d($cond_row);
        if($shop_base_data){

            if($shop_base_data['shop_status']==1 || $shop_base_data['shop_status']==2){
                //修改店铺状态为审核不通过
                $edit_row['shop_status'] = 8;
                if($shop_base_data['shop_payment']!=0){
                    $edit_row['shop_payment'] = 0;
                }
                $shop_base_edit = $this->shopBaseModel->editBase($cond_row['shop_id'],$edit_row);

            }
        }
//
//        //查询店铺是不是已经审核不通过
        $npass_row = $this->shopNpassModel->getOneByWhere(array('shop_id'=>$cond_row['shop_id']));

        //如果有记录 就修改 如果没记录就添加
        if ($npass_row){

            $shop_npass_list = $this->shopNpassModel->editNpass($npass_row['npass_id'],$cond_row);
        }else{

            $shop_npass_list = $this->shopNpassModel->addNpass($cond_row,true);
        }

//        代金券使用提醒
        $message = new MessageModel();
        $shop_message=$message->sendMessage('Npass shop list', $shop_base_data['user_id'], $shop_base_data['user_name'], $order_id = NULL, $shop_base_data['shop_name'], 0, 4);

        if($shop_npass_list&&$shop_message&&$shop_base_edit){
            $status = 200;
            $msg    = _('success');
        }else{
            $status = 250;
            $msg    = _('没有数据');
        }
        $data = array();
        $this->data->addBody(-140, $data,$msg,$status);
    }
}

?>