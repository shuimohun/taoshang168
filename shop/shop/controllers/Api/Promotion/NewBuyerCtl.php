<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/19
 * Time: 14:38
 */
class Api_Promotion_NewBuyerCtl extends Api_Controller
{
	public $NewBuyer_BaseModel  = null;
	public $NewBuyer_QuotaModel = null;

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

		$this->NewBuyer_BaseModel  = new NewBuyer_BaseModel();
		$this->NewBuyer_QuotaModel = new NewBuyer_QuotaModel();
		
		
		
	}

	/* 优惠套装活动*/
	//满送活动列表
	public function getNewBuyerList()
	{
	    
		$page          	= request_int('page', 1);
		$rows          	= request_int('rows', 100);
		$name 	= trim(request_string('newbuyer_name'));   //活动名称
		$shop_name     	= trim(request_string('shop_name'));       //店铺名称
		$newbuyer_state	= request_int('newbuyer_state');		   //活动状态

		$cond_row = array();

		if ($newbuyer_state)
		{
			$cond_row['newbuyer_state'] = $newbuyer_state;
		}
		if ($name)
		{
			$cond_row['newbuyer_name:LIKE'] = '%'.$name . '%';
		}
		if ($shop_name)
		{
			$cond_row['shop_name:LIKE'] = '%'.$shop_name . '%';
		}
        $order_row['newbuyer_sort'] = 'ASC';

		$data = $this->NewBuyer_BaseModel->getNewBuyerList($cond_row, $order_row, $page, $rows);
		$this->data->addBody(-140, $data);
	}

	//修改推荐类型页面
    public function getNewBuyerTempInfo()
    {
        $id             = request_int('id');
        $data = $this->NewBuyer_BaseModel->getOne($id);

        $this->data->addBody(-140, $data);
    }

	//取消活动
	public function cancelNewBuyer()
	{
		$data        = array();
		$newbuyer_id = request_int('newbuyer_id');
        $check_right = $this->NewBuyer_BaseModel->getOne($newbuyer_id);
        if ($check_right)
		{
			$rs_row = array();

			$this->NewBuyer_BaseModel->sql->startTransactionDb();

			//修改活动状态
			$field_row['newbuyer_state'] = NewBuyer_BaseModel::CANCEL;
			$update_flag                = $this->NewBuyer_BaseModel->editNewBuyer($newbuyer_id, $field_row);
			check_rs($update_flag, $rs_row);
            $promotion = new Promotion();
            $update_flag = $promotion->cancelCommonPromotion($check_right['common_id'],Goods_CommonModel::XINREN);
            check_rs($update_flag, $rs_row);

			if (is_ok($rs_row) && $this->NewBuyer_BaseModel->sql->commitDb())
			{
				$data      = $this->NewBuyer_BaseModel->getNewBuyerById($newbuyer_id);
				$data['a'] = $newbuyer_id;
				$msg       = _('操作成功');
				$status    = 200;
			}
			else
			{
				$this->NewBuyer_BaseModel->sql->rollBackDb();
				$msg    = _('操作失败');
				$status = 250;
			}

			$this->data->addBody(-140, $data, $msg, $status);
		}
	}

	/*
	 * 删除活动
	 * 删除活动下的商品
	*/
	public function removeNewBuyer()
	{
        $data        = array();
        $newbuyer_id = request_int('newbuyer_id');

        $check_right = $this->NewBuyerBaseModel->getOne($newbuyer_id);
        if($check_right)
        {
            $this->NewBuyer_BaseModel->sql->startTransactionDb();

            $flag = $this->NewBuyer_BaseModel->removeNewBuyer($newbuyer_id);

            if($flag)
            {
                $promotion = new Promotion();
                $update_flag = $promotion->cancelCommonPromotion($check_right['common_id'],Goods_CommonModel::FU);

                if ($update_flag == $this->NewBuyer_BaseModel->sql->commitDb())
                {
                    $msg    = 'success';
                    $status = 200;
                }
                else
                {
                    $this->NewBuyer_BaseModel->sql->rollBackDb();
                    $msg    = 'failure';
                    $status = 250;
                }
            }
        }
        else
        {
            $msg    = 'failure';
            $status = 250;
        }

        $this->data->addBody(-140, $data, $msg, $status);
	}

    /**
     * 修改推荐类型
     */
    public function editNewBuyerType()
    {
        $newbuyer_id = request_int('newbuyer_id');
        $data['newbuyer_sort'] = request_int('newbuyer_sort');
        $data['newbuyer_type'] = request_string('newbuyer_type'); // 推荐类型 新人优惠专题页 0-无推荐 1->1分 2->1毛 3->1元

        if ($data['newbuyer_type'] == NewBuyer_BaseModel::GUANGAO)
        {
            $top_ids = $this->NewBuyer_BaseModel->getKeyByWhere(['newbuyer_type'=>NewBuyer_BaseModel::GUANGAO]);
            $this->NewBuyer_BaseModel->editNewBuyer($top_ids,['newbuyer_type'=>0]);
        }
        $flag = $this->NewBuyer_BaseModel->editNewBuyer($newbuyer_id, $data);
        if($flag)
        {
            $msg = '修改成功';
            $status = 200;
        }
        else
        {
            $msg = '修改失败';
            $status = 250;
        }
        $data_rs = $data;
        $data_rs['newbuyer_id'] = $newbuyer_id;
        $data_rs['id']  		= $newbuyer_id;

        $this->data->addBody(-140, $data_rs,$msg,$status);
    }

	//套餐列表
	public function getQuotaList()
	{
		$cond_row  = array();
		$page      = request_int('page', 1);
		$rows      = request_int('rows', 100);
		$shop_name = request_string('shop_name');

		if ($shop_name)
		{
			$cond_row['shop_name:LIKE'] = $shop_name . '%';
		}

		$data = $this->NewBuyer_QuotaModel->getNewBuyerQuotaList($cond_row, array('quota_id' => 'DESC'), $page, $rows);

		$this->data->addBody(-140, $data);
	}

}
