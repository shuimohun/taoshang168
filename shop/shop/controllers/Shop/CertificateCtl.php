<?php /*if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}


class Shop_CertificateCtl extends YLB_AppController
{
	public $ShopCertificateModel    = null;
    public $ShopCatCertificateModel = null;

	public function init()
	{
		$this->ShopCertificateModel    = new Shop_CertificateModel();
		$this->ShopCatCertificateModel = new Shop_CatCertificateModel();
	}

	public function getShopCertificateList()
	{
        $page = request_int('page');
        $rows = request_int('rows');
        $search_name = request_string('search_name');

		if ($search_name)
		{
			$cond_row['name'] = '%' . $search_name . '%';
		}

        $order_row['display_order'] = 'asc';

        $data = $this->ShopCertificateModel->getCertificateList($cond_row,$order_row,$page,$rows);

        if($data)
        {
            $status = 200;
            $msg    = _('success');
        }
        else
        {
            $status = 250;
            $msg    = _('没有数据');
        }
        $this->data->addBody(-140, $data, $msg, $status);
	}

    public function getShopCertificateByWhere()
    {
        $search_name = request_string('search_name');

        if ($search_name)
        {
            $cond_row['name'] = '%' . $search_name . '%';
        }

        $order_row['display_order'] = 'asc';

        $data = $this->ShopCertificateModel->getCertificateWhere($cond_row,$order_row);

        if($data)
        {
            $status = 200;
            $msg    = _('success');
        }
        else
        {
            $status = 250;
            $msg    = _('没有数据');
        }
        $this->data->addBody(-140, $data, $msg, $status);
    }



}

*/?>