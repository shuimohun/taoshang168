<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Api_Information_BaseCtl extends Api_Controller
{
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);
	}


	/*
	 * 删除文章
	 *
	 * @param int information_id 文章id
	 *
	 * @return data 操作记录id
	 */
	public function removeBase()
	{
		$Information_BaseModel = new Information_BaseModel();

		$id = request_int('information_id');
		if ($id)
		{
			$flag = $Information_BaseModel->removeBase($id);
		}
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

	/*
	 * 新增文章
	 *
	 * @param   information_title   文章标题
	 * @param   information_url     文章链接地址
	 * @param   information_status  文章状态
	 * @param   information_type    文章类型
	 * @param   information_sort    文章排序
	 * @param   information_recommend    文章推荐
	 * @param   information_desc    文章描述
	 * @param   information_logo    文章图片
	 * @param   information_group_id文章分类
	 *
	 * @return  data            新增的文章内容
	 */
	public function addInformationBase()
	{


	    $user_id = request_string("user_id");
        $Information_BaseModel = new Information_BaseModel();

		$data = array();

		$data['information_title']  = request_string('information_title');
		$data['information_url']    = request_string('information_url');
		$data['information_status'] = request_int('information_status');
		$data['information_type']   = request_int('information_type');
        $data['information_sort']   = request_int('information_sort');
        $data['information_recommend']   = request_int('information_recommend');
		$data['information_desc']    = request_string('content');

        $video_row = get_html_attr_by_tag($data['information_desc'],'src','video,embed');
        if ($video_row){
            $data['information_video'] = $video_row;
        }
		$data['information_pic']    = request_string('information_pic');
		$information_pic_row          = request_row('setting');
		//$data['information_pic']      = $information_pic_row['information_logo'];
		$data['information_group_id'] = request_int('information_group_id');
		$data['information_add_time'] = date('Y-m-d H:i:s', time());
        $data['information_fake_read_count'] = request_int('information_fake_read_count');
        //都是user_id   之前涉及太多.  就  懒   的  改   了.
        $data['information_writer'] = $user_id;//资讯所取的id
        $data['user_id'] = $user_id;//粉丝群所取的id
        $goods_id = request_string('information_goods_recommend');
        $goods_type = request_string('information_goods_recommend_type');
            $goods_id = $pieces = explode(",", $goods_id);
            $goods_type = $pieces = explode(",", $goods_type);
        $goods_length = sizeof($goods_id);
        for ($x=0;$x<$goods_length;$x++){
            $recommend_goods[$x] = [$goods_id[$x],$goods_type[$x]];
        }
        $data['information_goods_recommend'] = $recommend_goods;
        $data['information_state'] = Information_BaseModel::NO_NEED_AUDIT;

		$information_id = $Information_BaseModel->addBase($data, true);

		if ($information_id)
		{
			$msg    = _('success');
			$status = 200;
		}
		else
		{
			$msg    = _('failure');
			$status = 250;
		}

		$data['id']         = $information_id;
		$data['information_id'] = $information_id;


		$Information_GroupModel = new Information_GroupModel();
		$data['information_group_name'] = $Information_GroupModel->getGroupName($data['information_group_id']);

		if ($data['information_status'] == $Information_BaseModel::ARTICLE_STATUS_TRUE)
		{
			$data['information_status_name'] = _('开启');
		}
		elseif ($data['information_status'] == $Information_BaseModel::ARTICLE_STATUS_FALSE)
		{
			$data['information_status_name'] = _('关闭');
		}

		$this->data->addBody(-140, $data, $msg, $status);
	}

    /*
     * 编辑文章
     *
     * @param   information_id      文章id
     * @param   information_title   文章标题
     * @param   information_url     文章链接地址
     * @param   information_status  文章状态
     * @param   information_type    文章类型
     * @param   information_sort    文章排序
     * @param   information_recommend    文章推荐

     * @param   information_desc    文章描述
     * @param   information_pic     文章图片
     * @param   information_group_id文章分类
     *
     * @return   data           编辑的内容
     */
	public function editInformationBase()
	{

		$Information_BaseModel = new Information_BaseModel();

		$information_id = request_int('information_id');

		$data['information_title']  = request_string('information_title');
		$data['information_url']    = request_string('information_url');
		$data['information_status'] = request_int('information_status');
		$data['information_type']   = request_int('information_type');
		$data['information_sort']   = request_int('information_sort');
        $data['information_recommend']   = request_int('information_recommend');
        $data['information_desc']   = request_string('content');
		$data['information_pic']    = request_string('information_pic');
		$information_pic_row          = request_row('setting');
		$data['information_group_id'] = request_int('information_group_id');
        $data['information_fake_read_count'] = request_int('information_fake_read_count');
        //都是user_id   之前涉及太多.  就  懒   的  改   了.
        $data['information_writer'] = Perm::$userId;//资讯所取的id
        $data['user_id'] = Perm::$userId;//粉丝群所取的id
        $data['information_goods_recommend'] = request_string('information_goods_recommend');

        $goods_id = request_string('information_goods_recommend');
        $goods_type = request_string('information_goods_recommend_type');
        $goods_id = $pieces = explode(",", $goods_id);
        $goods_type = $pieces = explode(",", $goods_type);
        $goods_length = sizeof($goods_id);
        for ($x=0;$x<$goods_length;$x++){
            $recommend_goods[$x] = [$goods_id[$x],$goods_type[$x]];
        }
        $data['information_goods_recommend'] = $recommend_goods;
        $flag                     = $Information_BaseModel->editBase($information_id, $data);

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

		$data['id']         = $information_id;
		$data['information_id'] = $information_id;

		$this->data->addBody(-140, $data, $msg, $status);
	}

	public function informationGroup()
	{
		$Information_GroupModel = new Information_GroupModel();
		$order = array('information_group_sort' => 'asc');
        $pid = request_int('pid',0);
        $data  = $Information_GroupModel->getByWhere(array('information_group_parent_id'=>$pid),$order);
		$data = array_values($data);
		$result = array();
		$result[0]['id'] = 0;
		$result[0]['name'] = "资讯分类";
		foreach($data as $key=>$value)
		{
			$result[$key+1]['id'] = $value['information_group_id'];
			$result[$key+1]['name'] = $value['information_group_title'];
		}

		$this->data->addBody(-140, $result);
	}

	//是否点赞
    public function isLike($user_id,$information_id){
	    $InformationLikeModel = new Information_LikeModel();

        $isLike = $InformationLikeModel->isLikeInfo($user_id,$information_id);

        if ($isLike !== false)
        {
            $msg    = _('success');
            $status = 200;
        } else {
            $msg    = _('failure');
            $status = 250;
        }
        $data['isLike']         = $isLike;
        $this->data->addBody(-140, $data, $msg, $status);
    }

    public function informationIsLike()
    {
        $data['like'] = 0;

        if(Perm::checkUserPerm())
        {
            $user_id = Perm::$userId;
            $information_id = request_int('information_id');
            $InformationLikeModel = new Information_LikeModel();
            $cond['user_id'] = $user_id;
            $cond['information_id'] = $information_id;
            $id = $InformationLikeModel->getKeyByWhere($cond);

            if($id)
            {
                $data['like'] = 1;
            }
        }
        $this->data->addBody(-140, $data);
    }


    //后台分类
    public function getGroupByClass(){
        $Information_GroupModel = new Information_GroupModel();
        $cond['information_group_parent_id'] = request_int('p_id',0);
        $data1 = $Information_GroupModel->listByWhere($cond);
        $data = $data1['items'];
        $this->data->addBody(-140, $data);

    }
    /**
     *
     * 后台商品推荐
     *
     */
    public function goods_recommend(){
        $condition = request_int('goods_group',5);
        $goods_name = request_string('goods_name');
        $goods_name = "%$goods_name%";
        if ($goods_name){
            $cond['goods_name:LIKE'] = $goods_name;
        }
        /**
         *  0新人
         *  1惠抢购
         *  2劲爆折扣
         *  3送福免单
         *  4优惠套餐
         *  5商品
         */
        $GoodsBaseModel = new Goods_BaseModel();
        $rows = request_int('rows',50);
        $page = request_int('page',1);
        $order = null;
        //产品经理需求,可能产生奇怪的现象.ps:立赚价格 高于商品价格  立减价格 高于 商品价格
        if ($condition == 0){
            $NewBuyerModel = new NewBuyer_BaseModel();
            $cond['newbuyer_state'] = 1;
            $data = $NewBuyerModel->listByWhere($cond,$order,$page,$rows);
            foreach ($data['items'] as $key => $value){
                $goods = $GoodsBaseModel->getNormalGoodsBase($value['goods_id']);
                if ($goods){
                    $data['items'][$key]['newbuyer_price'] -= $goods['goods_share_price'];
                    $data['items'][$key]['goods_promotion_price'] =  $goods['goods_promotion_price'];
                    $data['items'][$key]['goods_share_price'] =  $goods['goods_share_price'];
                    $data['items'][$key]['goods_salenum'] =  $goods['goods_salenum'];
                } else {
                    unset($data['items'][$key]);
                }
            }
        }elseif ($condition == 1){
            $ScarebuyModel = new ScareBuy_BaseModel();
            $cond['scarebuy_state'] = 2;
            $data = $ScarebuyModel->listByWhere($cond,$order,$page,$rows);
            foreach ($data['items'] as $key => $value){
                $goods = $GoodsBaseModel->getNormalGoodsBase($value['goods_id']);
                if ($goods){
                    $data['items'][$key]['goods_promotion_price'] =  $goods['goods_promotion_price'];
                    $data['items'][$key]['goods_share_price'] =  $goods['goods_share_price'];
                    $data['items'][$key]['goods_salenum'] =  $goods['goods_salenum'];
                } else {
                    unset($data['items'][$key]);
                }
            }
        }elseif ($condition == 2){
            $DiscountModel = new Discount_GoodsModel();
            $cond['discount_goods_state'] = 1;
            $data = $DiscountModel->listByWhere($cond,$order,$page,$rows);
            foreach ($data['items'] as $key => $value){
                $goods = $GoodsBaseModel->getNormalGoodsBase($value['goods_id']);
                if ($goods){
                    $data['items'][$key]['goods_promotion_price'] =  $goods['goods_promotion_price'];
                    $data['items'][$key]['goods_share_price'] =  $goods['goods_share_price'];
                    $data['items'][$key]['goods_salenum'] =  $goods['goods_salenum'];
                } else {
                    unset($data['items'][$key]);
                }
            }
        }elseif ($condition == 3){
            $FuBaseModel = new Fu_BaseModel();
            $cond['fu_state'] = 1;
            $data = $FuBaseModel->listByWhere($cond,$order,$page,$rows);
            foreach ($data['items'] as $key => $value){
                $goods = $GoodsBaseModel->getNormalGoodsBase($value['goods_id']);
                if ($goods){
                    $data['items'][$key]['goods_promotion_price'] =  $goods['goods_promotion_price'];
                    $data['items'][$key]['goods_share_price'] =  $goods['goods_share_price'];
                    $data['items'][$key]['goods_salenum'] =  $goods['goods_salenum'];
                } else {
                    unset($data['items'][$key]);
                }
            }
        }elseif ($condition == 4){
            $BundlingGoods = new Bundling_GoodsModel();
            $cond['bundling_appoint'] = 1;
            $data = $BundlingGoods->listByWhere($cond,$order,$page,$rows);
            foreach ($data['items'] as $key => $value){
                $goods = $GoodsBaseModel->getNormalGoodsBase($value['goods_id']);
                if ($goods){
                    $data['items'][$key]['goods_promotion_price'] =  $goods['goods_promotion_price'];
                    $data['items'][$key]['goods_share_price'] =  $goods['goods_share_price'];
                    $data['items'][$key]['goods_salenum'] =  $goods['goods_salenum'];
                } else {
                    unset($data['items'][$key]);
                }
            }
        }elseif ($condition == 6){
            $directseller_model = new Distribution_ShopDirectsellerModel();
            //获取推广店铺的ID
            $cond_row['directseller_id'] = Perm::$userId;
            $cond_row['directseller_enable'] = 1;
            $shops = $directseller_model->getByWhere($cond_row);
            $shop_ids = array_column($shops,'shop_id');
            $cond_good_row['shop_id:in'] = $shop_ids;
            $cond_good_row['common_is_directseller'] = 1;
            if(request_string('keywords'))
            {
                $cond_good_row['common_name:LIKE'] = '%'.request_string('keywords').'%'; //商品名称搜索
            }
            $cond_good_row['common_state'] = Goods_CommonModel::GOODS_STATE_NORMAL;

            $YLB_Page = new YLB_Page();
            $page     = request_int('page',1);
            $rows     = request_int('rows',8);

            $order_row['common_salenum'] = 'desc';

            //获取推广商品
            $Goods_CommonModel = new Goods_CommonModel();
            $data = $Goods_CommonModel->getCommonList($cond_good_row,$order_row, $page, $rows);
            $data['items'] = $Goods_CommonModel->getRecommonRow($data);
            $data['user_id'] = Perm::$userId;

            $YLB_Page->totalRows = $data['totalsize'];
            $page_nav            = $YLB_Page->prompt();

            $row = array();
            foreach ($data['items'] as $key=>$value)
            {
                $row[$key]['goods_id'] = $value['goods_id'];
                $row[$key]['common_id'] = $value['common_id'];
                $row[$key]['common_name'] = $value['common_name'];
                $row[$key]['common_price'] = $value['common_price'];
                $row[$key]['goods_image'] = $value['common_image'];
                $row[$key]['shop_id'] = $value['shop_id'];
                $row[$key]['shop_name'] = $value['shop_name'];
                $row[$key]['common_salenum'] = $value['common_salenum'];
                $row[$key]['common_collect'] = $value['common_collect'];
                $row[$key]['common_cps_rate'] = $value['common_cps_rate'];
                $row[$key]['common_second_cps_rate'] = $value['common_second_cps_rate'];
                $row[$key]['common_third_cps_rate'] = $value['common_third_cps_rate'];
                $row[$key]['common_share_price'] = $value['common_share_price'];
                $row[$key]['goods_price'] = $value['common_shared_price'];
                $row[$key]['common_is_promotion'] = $value['common_is_promotion'];
                $row[$key]['common_promotion_price'] = $value['common_promotion_price'];

                $row[$key]['common_cps_rate_con'] = format_money($value['common_cps_rate']*$value['common_shared_price']/100) .'~'.format_money($value['common_cps_rate']*$value['common_price']/100);
                $row[$key]['common_second_cps_rate_con'] = format_money($value['common_second_cps_rate']*$value['common_shared_price']/100) .'~'.format_money($value['common_second_cps_rate']*$value['common_price']/100);
                $row[$key]['common_third_cps_rate_con'] = format_money($value['common_third_cps_rate']*$value['common_shared_price']/100) .'~'.format_money($value['common_third_cps_rate']*$value['common_price']/100);

            }
            $data['items'] = $row;
            foreach ($data['items'] as $key => $value){
                $goods = $GoodsBaseModel->getOne($value['goods_id']);
                $data['items'][$key]['goods_promotion_price'] =  $goods['goods_promotion_price'];
                $data['items'][$key]['goods_share_price'] =  $goods['goods_share_price'];
                $data['items'][$key]['goods_salenum'] =  $goods['goods_salenum'];
            }
        }elseif ($condition == 7){
            $cond['shop_id'] = Perm::$shopId;
            $cond['goods_is_shelves'] = 1;
            $data = $GoodsBaseModel->listByWhere($cond,$order,$page,$rows);
        }else{
            $cond['goods_is_shelves'] = 1;
            $data = $GoodsBaseModel->listByWhere($cond,$order,$page,$rows);
        }
        //分页
        $YLB_Page = new YLB_Page();
        $YLB_Page->nowPage    = $page;
        $YLB_Page->listRows   = $rows;
        $YLB_Page->totalPages = $data['total'];
        $page_nav             = $YLB_Page->ajaxPromptII();
        $data['page_nav'] = $page_nav;
        $this->data->addBody(-140, $data);
    }

    /**
     * 获取待审核资讯列表
     */
    public function getAuditList()
    {
        $page = request_int('page', 1);
        $rows = request_int('rows', 25);
        $cond_row['information_state'] = Information_BaseModel::WAITING_AUDIT;
        $order_row['information_id'] = 'desc';
        $InformationBaseModel = new Information_BaseModel();
        $data = $InformationBaseModel->listByWhere($cond_row,$order_row,$page,$rows);

        foreach ($data['items'] as $key => $val)
        {
            $data['items'][$key]['information_state_con'] = Information_BaseModel::$audit_map[$val['information_state']];
        }

        $this->data->addBody(-140, $data);
    }

    /**
     * 审核资讯
     */
    public function auditManage()
    {
        $information_id = request_int('information_id');
        $InformationBaseModel = new Information_BaseModel();
        $data = $InformationBaseModel->getOne($information_id);
        $this->data->addBody(-140, $data);
    }

    /**
     * 审核资讯
     */
    public function auditInformation()
    {
        $information_id = request_int('information_id');
        $information_state = request_int('information_state');

        if ($information_id && ($information_state == Information_BaseModel::NO_PASS || $information_state == Information_BaseModel::AUDITED))
        {
            $InformationBaseModel = new Information_BaseModel();
            $information = $InformationBaseModel->getOne($information_id);

            if ($information['information_state'] == Information_BaseModel::WAITING_AUDIT)
            {
                $flag = $InformationBaseModel->editBase($information['information_id'],['information_state'=>$information_state]);

                if ($flag)
                {
                    $PointsLogModel = new Points_LogModel();
                    $user_id = $information['user_id'];
                    $user_name = $information['information_writer'];
                    if($information_state == Information_BaseModel::NO_PASS)
                    {
                        $PointsLogModel->addPointsLog($user_id,$user_name,Points_LogModel::NO_PASS);
                    }
                    else if($information_state == Information_BaseModel::AUDITED)
                    {
                        $PointsLogModel->addPointsLog($user_id,$user_name,Points_LogModel::POST);
                    }
                }
            }
        }

        if ($flag)
        {
            $status = 200;
            $msg    = '成功';

            $data['id'] = $information_id;
            $data['information_id'] = $information_id;
            $data['information_state_con'] = Information_BaseModel::$audit_map[$information_state];
        }
        else
        {
            $status = 250;
            $msg    = '失败';

            $data = [];
        }

        $this->data->addBody(-140, $data,$msg,$status);

    }

    /*
   * 获取文章列表
   *
   * @param int $page 页数
   * @param int $rows 每页显示行数
   *
   * @return data 文章显示数据
   */
    public function informationBaseList()
    {
        $Information_BaseModel  = new Information_BaseModel();
        $Information_GroupModel = new Information_GroupModel();

        $page      = request_int('page');
        $rows      = request_int('rows');
        $cond_row  = array('information_status'=>1);
        $order_row = array('information_add_time'=>'desc');

        $information_group = request_int('information_group');
        if($information_group)
        {
            $cond_row['information_group_id'] = $information_group;
        }
//        $cond_row['information_status'] = 1;
        $data = $Information_BaseModel->listByWhere($cond_row, $order_row, $page, $rows);
        foreach ($data['items'] as $k => $value) {
            $information_goods_recommend = $value['information_goods_recommend'];
            $data['items'][$k]['information_goods_recommend_type'] = [1,2,3,4,5,6];
            $data['items'][$k]['information_goods_recommend_type'] = null;
            $data['items'][$k]['information_goods_recommend'] = null;
            $goods_length = sizeof($information_goods_recommend);
            for ($y = 0; $y < $goods_length; $y++) {
                $data['items'][$k]['information_goods_recommend'] .= $information_goods_recommend[$y][0];
                $data['items'][$k]['information_goods_recommend_type'] .= $information_goods_recommend[$y][1];
                if ($y < $goods_length-1){
                    $data['items'][$k]['information_goods_recommend'] .= ',';
                    $data['items'][$k]['information_goods_recommend_type'] .= ',';
                }
            }
        }
        foreach ($data['items'] as $k=>$v){
            $data['items'][$k]['information_add_time'] = date("Y-m-d",strtotime($v['information_add_time'])) ;
            $sql = "select count(information_id)as infou_count from ylb_information_like where information_id=".$v['information_id']." GROUP  by information_id desc";
            if($v['information_read_count']!=0 || $v['information_read_count']!=null ){
                $data['items'][$k]['read_count'] = $v['information_read_count']+$v['information_fake_read_count'];
            }
            $data['items'][$k]['infou_count'] = $Information_BaseModel->sql($sql);
        }

        $items = $data['items'];
        unset($data['items']);

        if (!empty($items))
        {
            foreach ($items as $key => $value)
            {
                if ($value['information_status'] == $Information_BaseModel::ARTICLE_STATUS_TRUE)
                {
                    $items[$key]['information_status_name'] = '开启';
                }
                elseif ($value['information_status'] == $Information_BaseModel::ARTICLE_STATUS_FALSE)
                {
                    $items[$key]['information_status_name'] = '关闭';
                }

                $items[$key]['information_group_name'] = $Information_GroupModel->getGroupName($value['information_group_id']);
            }
        }
        if ($items)
        {
            $msg    = _('success');
            $status = 200;
        }
        else
        {
            $msg    = _('failure');
            $status = 250;
        }
        $data['items'] = $items;

        $this->data->addBody(-140, $data, $msg, $status);
    }
}

?>