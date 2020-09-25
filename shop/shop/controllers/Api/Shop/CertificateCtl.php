<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author
 */

class Api_Shop_CertificateCtl extends YLB_AppController
{
	public $ShopCertificateModel    = null;
    public $ShopCatCertificateModel = null;

    /**
     * 初始化方法，构造函数
     *
     */
	public function init()
	{
		$this->ShopCertificateModel    = new Shop_CertificateModel();
		$this->ShopCatCertificateModel = new Shop_CatCertificateModel();
	}

    /**
     * 列表页
     */
	public function certificateIndex()
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

    /**
     * 获取全部证件
     */
    public function getAllShopCertificate()
    {
        $search_name = request_string('search_name');

        if ($search_name)
        {
            $cond_row['name:like'] = '%' . $search_name . '%';
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

    /**
     * 修改页面
     */
    public function editCertificate()
    {
        $id   = request_int('id');
        $data = $this->ShopCertificateModel->getOne($id);

        $this->data->addBody(-140, $data);
    }

    /**
     * 增
     */
    public function addCertificateRow()
    {
        $data["name"]          = request_string('name');
        $data["display_order"] = request_int('display_order',255);
        $data["type"]          = request_int('type',0);
        $data['id']            = $this->ShopCertificateModel->addCertificate($data, true);
        if ($data['id'])
        {
            $status = 200;
            $msg    = _('success');
        }
        else
        {
            $status = 250;
            $msg    = _('failure');
        }

        $this->data->addBody(-140, $data, $msg, $status);
    }

    /**
     * 删
     */
    public function delCertificate()
    {
        $id  = request_int('id');
        $del = $this->ShopCertificateModel->removeCertificate($id);
        $data['id'] = $id;
        $this->data->addBody(-140, $data);
    }

    /**
     * 改
     */
    public function editCertificateRow()
    {
        //获取接收过来的数据
        $id                    = request_int('id');
        $data['name']          = request_row("name");
        $data['display_order'] = request_row("display_order");
        $data["type"]          = request_int('type',1);
        $flag                   = $this->ShopCertificateModel->editCertificate($id, $data);
        $data['id'] = $id;
        $this->data->addBody(-140, $data);
    }

    /**
     * 店铺证件 关联列表页
     */
    public function catCertificateIndex()
    {
        $page = request_int('page');
        $rows = request_int('rows');
        $search_name = request_string('search_name');

        if ($search_name)
        {
            $cond_row['name'] = '%' . $search_name . '%';
        }

        $data = $this->ShopCatCertificateModel->getCatCertificateList($cond_row,array(),$page,$rows);

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

    public function getCatCertificateById()
    {
        $data = array();
        $cat_id = request_int('id');
        if($cat_id)
        {
            $data = $this->ShopCatCertificateModel->getCatCertificateInfo($cat_id);
        }

        if ($data)
        {
            $msg    = _('success');
            $status = 200;
        }
        else
        {
            $msg    = _('failure');
            $status = 250;
        }

        $this->data->addBody(-140, $data, $msg, $status);
    }

    /**
     * 增 关联
     */
    public function addCatCertificate()
    {
        $data = array();
        $cat_id = request_int('cat_id');
        $cat_name = request_string('cat_name');
        $certificate_ids = request_row('certificate_id');

        if($cat_id)
        {
            $data_old = $this->ShopCatCertificateModel->getKeyByWhere(array('cat_id'=>$cat_id));

            if(empty($data_old))
            {
                if($cat_name)
                {
                    $cat_name = rtrim($cat_name,'->');
                }

                $data['cat_id'] = $cat_id;
                $data['cat_name'] = $cat_name;
                $data['certificate_id'] = $certificate_ids;

                $flag = $this->ShopCatCertificateModel->addCatCertificate($data);
                if ($flag)
                {
                    $data['id'] = $cat_id;
                    $msg    = _('success');
                    $status = 200;
                }
                else
                {
                    $msg    = _('failure');
                    $status = 250;
                    $data = array();
                }
            }
            else
            {
                $status = 250;
                $msg = '该分类已经添加';
            }
        }
        else
        {
            $msg    = _('failure');
            $status = 250;
        }


        $this->data->addBody(-140, $data, $msg, $status);

    }

    /**
     * 删 关联
     */
    public function removeCatCertificate()
    {
        $id  = request_int('id');
        $del = $this->ShopCatCertificateModel->removeCatCertificate($id);
        $data['cat_id'] = $id;
        $this->data->addBody(-140, $data);
    }

    /**
     * 改 关联
     */
    public function editCatCertificate()
    {
        $cat_id          = request_int('cat_id');
        $certificate_ids = request_row('certificate_id');

        $edit_data['certificate_id'] = $certificate_ids;
        $flag = $this->ShopCatCertificateModel->editCatCertificate($cat_id, $edit_data);

        if ($flag !== false)
        {
            $msg    = _('success');
            $status = 200;
        }
        else
        {
            $msg    = _('failure');
            $status = 250;
        }

        $this->data->addBody(-140, array(), $msg, $status);
    }


}

?>