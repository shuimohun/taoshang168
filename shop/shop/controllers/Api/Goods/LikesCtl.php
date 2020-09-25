<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}


class Api_Goods_LikesCtl extends Api_Controller
{
	public function like()
	{
	    $common_id = request_int('common_id');
	    $model = new Goods_CommonModel();
        $rs['res'] = $model->like($common_id);
        if($rs){
            $msg = 'success';
            $status = 200;
        }else{
            $msg = 'false';
            $status = 250;
        }
        $this->data->addBody(-140, $rs,$msg,$status);
	}

    public function unlike()
    {
        $common_id = request_int('common_id');
        if(empty($common_id) || !isset($common_id)){
            return false;
        }
        $model = new Goods_CommonModel();
        $rs['res'] = $model->unlike($common_id);
        if($rs){
            $msg = 'success';
            $status = 200;
        }else{
            $msg = 'false';
            $status = 250;
        }
        $this->data->addBody(-140, $rs,$msg,$status);
    }

    /**
     * 猜你喜欢商品 列表
     */
    public function likesList()
    {
        $page = request_int('page', 1);
        $rows = request_int('rows', 100);

        $cond_row = array();
        $order_row = array();

        $Goods_CommonModel = new Goods_CommonModel();
        $data = $Goods_CommonModel->getLikesList($cond_row = array('is_like'=>1,'common_state'=>1), $order_row = array(), $page, $rows);

        if ($data) {
            $status = 200;
            $msg    = _('success');
        } else {
            $status = 250;
            $msg    = _('没有满足条件的结果哦');
        }
        $this->data->addBody(-140, $data, $msg, $status);
    }

    /**
     * 猜你喜欢商品（随机10条）
     */
    public function likesListBuyer(){
        //猜你喜欢商品
        $likes_list = $this->goodsCommonModel->likes_list();
        $this->data->addBody(-140, $likes_list);
    }

    public function cat()
    {
        $pid = request_int('pid');
        $Goods_CommonModel = new Goods_CommonModel();
        $data = $Goods_CommonModel->getCats($pid);
        if ($data) {
            $status = 200;
            $msg    = _('success');
        } else {
            $status = 250;
            $msg    = _('没有满足条件的结果哦');
        }
        $this->data->addBody(-140, $data, $msg, $status);
    }


}

?>