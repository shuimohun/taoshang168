<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Api_Goods_TopCatCtl extends YLB_AppController
{
    public $GoodsTopCatModel = null;
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);

        $this->GoodsTopCatModel = new Goods_TopCatModel();
	}


	/**
	 * 获取列表
	 *
	 * @access public
	 */
	public function lists()
	{
        $page  = request_int('page', 1);
        $rows  = request_int('rows', 100);

		$data  = $this->GoodsTopCatModel->getGoodsTopCatList(array(), array('display_order' => 'ASC'), $page, $rows);

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
	 * 添加
	 *
	 * @access public
	 */
	public function add()
	{
		$data['cat_id']        = request_int('cat_id');
		$data['cat_name']      = request_string('cat_name');
        $data['display_order'] = request_int('display_order');
        $data['add_time']      = get_date_time();

        if($data['cat_id'])
        {
            $key = $this->GoodsTopCatModel->getKeyByWhere(array('cat_id'=>$data['cat_id']));

            if(!$key)
            {
                $GoodsCatModel = new Goods_CatModel();
                $goods_cat = $GoodsCatModel->getOne($data['cat_id']);
                if($goods_cat)
                {
                    $data['cat_name'] = $goods_cat['cat_name'];
                    $data['cat_pic']  = $goods_cat['cat_pic'];
                    $flag = $this->GoodsTopCatModel->addTopCat($data,true);
                }
            }
        }

		if ($flag)
		{
            $data['id'] = $flag;
            $msg    = _('success');
			$status = 200;
		}
		else
		{
            $data   = array();
			$msg    = _('failure');
			$status = 250;
		}


		$this->data->addBody(-140, $data, $msg, $status);
	}

	/**
	 * 删除操作
	 *
	 * @access public
	 */
	public function remove()
	{
		$id = request_int('id');

        $goods_top_cat = $this->GoodsTopCatModel->getOne($id);
        if($goods_top_cat)
        {
            $flag = $this->GoodsTopCatModel->removeTopCat($goods_top_cat['id']);
        }

		if ($flag)
		{
            $data['id'] = $id;
            $msg    = _('success');
			$status = 200;
		}
		else
		{
            $data = array();
			$msg    = _('failure');
			$status = 250;
		}


		$this->data->addBody(-140, $data, $msg, $status);
	}

	/**
	 * 修改
	 *
	 * @access public
	 */
	public function edit()
	{
		$id = request_int('id');
		$data['display_order'] = request_string('display_order');

		$flag = $this->GoodsTopCatModel->editTopCat($id, $data);

        if ($flag)
        {
            $msg    = _('success');
            $status = 200;
        }
        else
        {
            $msg    = _('failure');
            $status = 250;
        }

        $data['id'] = $id;
        $this->data->addBody(-140, $data, $msg, $status);
	}

}

?>