<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Buyer_VoucherCtl extends Buyer_Controller
{

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

		$this->voucherBaseModel = new Voucher_BaseModel();

	}

	/**
	 * 代金券领取列表
	 * @access public
	 * 
	 */
	public function voucher()
	{
		$YLB_Page           = new YLB_Page();
		$YLB_Page->listRows = request_int('listRows')?request_int('listRows'):10;
		$rows              = $YLB_Page->listRows;
		$offset            = request_int('firstRow', 0);
		$page              = ceil_r($offset / $rows);
		
		$state = request_int('state');
		
		$cond_row['voucher_owner_id'] = Perm::$userId;
		if($state){
			$cond_row['voucher_state']    = $state;
		}
		$order_row                    = array();


		if (request_int('curpage'))
		{
			$page = request_int('curpage');
		}

		if (request_int('page'))
		{
			$rows = request_int('page');
		}

		$data = $this->voucherBaseModel->getVoucherList($cond_row, $order_row, $page, $rows);

		$YLB_Page->totalRows = $data['totalsize'];
		$page_nav           = $YLB_Page->prompt();

		if ('json' == $this->typ)
		{

			//所属店铺
			$shop_id_row = array_column($data['items'], 'voucher_shop_id');
			$Shop_BaseModel = new Shop_BaseModel();

			if ($shop_id_row)
			{
				$shop_rows = $Shop_BaseModel->getBase($shop_id_row);
				$data['shop'] = $shop_rows;
			}

			if ($data['page'] < $data['total'])
			{
				$data['hasmore'] = true;
			}
			else
			{
				$data['hasmore'] = false;
			}

			$data['page_total'] = $data['total'];

            echo '<pre>';
            print_r($data);die;
			$this->data->addBody(-140, $data);
		}
		else
		{
			include $this->view->getView();
		}
	}


	public function delVoucher()
	{
		$voucher_id = request_int('id');
		$flag       = $this->voucherBaseModel->removeVoucher($voucher_id);

		if ($flag !== false)
		{
			$status = 200;
			$msg    = _('success');

		}
		else
		{
			$status = 250;
			$msg    = _('failure');

		}
		$data = array();

		$this->data->addBody(-140, $data, $msg, $status);
	}


}

?>