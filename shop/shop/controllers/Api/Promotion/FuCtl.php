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
class Api_Promotion_FuCtl extends Api_Controller
{
	public $Fu_BaseModel   = null;
    public $Fu_RecordModel = null;
	public $Fu_QuotaModel  = null;

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

		$this->Fu_BaseModel  = new Fu_BaseModel();
        $this->Fu_RecordModel  = new Fu_RecordModel();
		$this->Fu_QuotaModel = new Fu_QuotaModel();
	}

	public function getFuList()
	{
		$page      = request_int('page', 1);
		$rows      = request_int('rows', 100);
		$name 	   = trim(request_string('fu_name'));   //活动名称
		$shop_name = trim(request_string('shop_name'));       //店铺名称
		$fu_state  = request_int('fu_state');		   //活动状态

		$cond_row = array();

		$cond_row['fu_state:<'] = Fu_BaseModel::DELETE;
		if ($fu_state)
		{
			$cond_row['fu_state'] = $fu_state;
		}
		if ($name)
		{
			$cond_row['fu_name:LIKE'] = '%'.$name . '%';
		}
		if ($shop_name)
		{
			$cond_row['shop_name:LIKE'] = '%'.$shop_name . '%';
		}
        $order_row['fu_id'] = 'DESC';

		$data = $this->Fu_BaseModel->getFuList($cond_row, $order_row, $page, $rows);
		if($data['items'])
        {
            foreach ($data['items'] as $key => $value)
            {
                $data['items'][$key] = array_merge((array)$value,(array)$value['fu_base']);
            }
        }
		$this->data->addBody(-140, $data);
	}

    public function getFuTempInfo()
    {
        $id             = request_int('id');
        $data = $this->Fu_BaseModel->getOne($id);

        $this->data->addBody(-140, $data);
    }

	public function cancelFu()
	{
		$fu_id = request_int('fu_id');

        $fu_base = $this->Fu_BaseModel->getOne($fu_id);
        if($fu_base)
        {
            $this->Fu_BaseModel->sql->startTransactionDb();
            $update_flag = $this->Fu_BaseModel->editFu($fu_id, ['fu_state'=>Fu_BaseModel::CANCEL]);

            if($update_flag)
            {
                $promotion = new Promotion();
                $update_flag = $promotion->cancelCommonPromotion($fu_base['common_id'],Goods_CommonModel::FU);

                if ($update_flag && $this->Fu_BaseModel->sql->commitDb())
                {
                    $msg    = 'success';
                    $status = 200;

                    $FuRecordModel = new Fu_RecordModel();
                    $fu_record_id_row = $FuRecordModel->getKeyByWhere(['fu_id'=>$fu_id]);
                    $FuRecordModel->editFuRecord($fu_record_id_row,['status'=>Fu_RecordModel::OVER]);
                }
                else
                {
                    $this->Fu_BaseModel->sql->rollBackDb();
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

        $this->data->addBody(-140, [], $msg, $status);
	}

	public function removeFu()
	{
		$data  = array();
		$fu_id = request_int('fu_id');

        $fu_base = $this->Fu_BaseModel->getOne($fu_id);
        if($fu_base)
        {
            $this->Fu_BaseModel->sql->startTransactionDb();

            $flag = $this->Fu_BaseModel->removeFu($fu_id);

            if($flag)
            {
                $promotion = new Promotion();
                $update_flag = $promotion->cancelCommonPromotion($fu_base['common_id'],Goods_CommonModel::FU);

                if ($update_flag && $this->Fu_BaseModel->sql->commitDb())
                {
                    $msg    = 'success';
                    $status = 200;

                    $FuRecordModel = new Fu_RecordModel();
                    $fu_record_id_row = $FuRecordModel->getKeyByWhere(['fu_id'=>$fu_id]);
                    $FuRecordModel->editFuRecord($fu_record_id_row,['status'=>Fu_RecordModel::OVER]);
                }
                else
                {
                    $this->Fu_BaseModel->sql->rollBackDb();
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

		$data = $this->Fu_QuotaModel->getFuQuotaList($cond_row, array('quota_id' => 'DESC'), $page, $rows);

		$this->data->addBody(-140, $data);
	}

    public function getFuRecordList()
    {
        $page     = request_int('page', 1);
        $rows     = request_int('rows', 100);
        $cond_row = array();

        $status	= request_int('status'); //活动状态
        if ($status)
        {
            $cond_row['status'] = $status;
        }

        $order_row['fu_record_id'] = 'DESC';
        $data = $this->Fu_RecordModel->getFuRecordList($cond_row, $order_row, $page, $rows);
        if($data['items'])
        {
            $fu_id_row = array_column($data['items'],'fu_id');

            $fu_base_row = [];
            if($fu_id_row)
            {
                $fu_id_row = array_unique($fu_id_row);
                $FuBaseModel = new Fu_BaseModel();
                $fu_base_row = $FuBaseModel->getBase($fu_id_row);
            }

            foreach ($data['items'] as $key => $value)
            {
                if(isset($fu_base_row[$value['fu_id']]))
                {
                    $fu_base = $fu_base_row[$value['fu_id']];
                    $data['items'][$key]['fu_name'] = $fu_base['fu_name'];
                    $data['items'][$key]['goods_name'] = $fu_base['goods_name'];
                    $data['items'][$key]['goods_price'] = $fu_base['goods_price'];
                    $data['items'][$key]['goods_image'] = $fu_base['goods_image'];
                    $data['items'][$key]['shop_name'] = $fu_base['shop_name'];

                    foreach ($fu_base['fu_base'] as $k => $v)
                    {
                        $stype = $value['fu_base'][$k] ? $value['fu_base'][$k] : '0';
                        $data['items'][$key][$k] = $stype . '/' . $v;
                    }
                }
            }
        }
        $this->data->addBody(-140, $data);
    }

    public function editFuSort()
    {
        $fu_id = request_int('fu_id');
        $data['fu_sort'] = request_int('fu_sort');

        $fu_base['sqq'] = request_int('sqq');
        $fu_base['qzone'] = request_int('qzone');
        $fu_base['weixin'] = request_int('weixin');
        $fu_base['weixin_timeline'] = request_int('weixin_timeline');
        $fu_base['tsina'] = request_int('tsina');

        if ($fu_base['sqq'] && $fu_base['qzone'] && $fu_base['weixin'] && $fu_base['weixin_timeline'] && $fu_base['tsina'])
        {
            $data['fu_base'] = $fu_base;
            $data['fu_total_times'] = array_sum($fu_base);

            $flag = $this->Fu_BaseModel->editfu($fu_id, $data);

            $data = array_merge($data,$fu_base);
        }

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
        $data['fu_id'] = $fu_id;
        $data['id']    = $fu_id;

        $this->data->addBody(-140, $data,$msg,$status);
    }

}
