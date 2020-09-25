<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Information_BaseCtl extends Controller
{
	public $informationBaseModel = null;
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
		$this->initData();
		$this->web = $this->webConfig();
		$this->nav = $this->navIndex();
		$this->cat = $this->catIndex();
		//include $this->view->getView();
		$this->informationBaseModel  = new Information_BaseModel();
		$this->InformationReplyModel = new Information_ReplyModel();
		$this->Information_LikeModel = new Information_LikeModel();
		$this->User_InfoModel        = new User_InfoModel();
		$this->Uer_FriendModel       = new User_FriendModel();
	}

	/**
	 * 首页
	 * @param int information_id    文章id
     * @param information_group_id  文章分组id
	 * @access public
     *
	 */
	public function index()
	{
	    $user_id = Perm::$userId;
		$information_id       = request_int('information_id');
		$information_group_id = request_int('information_group_id');

		$Information_BaseModel  = new Information_BaseModel();
		$Information_GroupModel = new Information_GroupModel();
        $Information_LikeModel = new Information_LikeModel();

        //是否点赞该资讯
        $isLike = $Information_LikeModel->isLikeInfo($user_id,$information_id);

        //获得文章的阅读次数
        $readCount = $this->informationBaseModel->getReadCount($information_id);

        //更新文章的阅读次数
        $readCount = $readCount + 1;
        $updateFlag = $this->informationBaseModel->updateReadCount($information_id, $readCount);

		//头部
		//$Goods_CatModel = new Goods_CatModel();
		//$data           = $Goods_CatModel->getCatListAll();

		//底部
		//$data_information_foot = $Information_GroupModel->getInformationGroupList();
		//所有分类
		$data_all_group = $Information_GroupModel->getByWhere(array('information_group_parent_id' => 0));

		//最近文章
		$Information_BaseModel->sql->setLimit(0, 5);
		$data_recent_information = $Information_BaseModel->getByWhere(array(), array('information_add_time' => 'DESC'));

		if ($information_id)
		{
			$data_information      = $Information_BaseModel->getOne($information_id);
			$data_near_information = $Information_BaseModel->getNearInformation($information_id);
		}
		elseif ($information_group_id)
		{
			$data_information_list = $Information_GroupModel->getInformationGroupLists($information_group_id);
		}

		$title             = Web_ConfigModel::value("information_title");//首页名;
		$this->keyword     = Web_ConfigModel::value("information_keyword");//关键字;
		$this->description = Web_ConfigModel::value("information_description");//描述;
		$this->title       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $title);
		$this->title       = str_replace("{name}", "成长之路", $this->title);
		$this->keyword       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->keyword);
		$this->keyword      = str_replace("{name}", "成长之路", $this->keyword);
		$this->description       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->description);
		$this->description       = str_replace("{name}", "成长之路", $this->description);

		include $this->view->getView();
	}

    /*
     * 列表页
     * */
    public function  list_row(){
        $user_id = Perm::$userId;
        $information_group_id = request_int('information_group_id');

        $Information_BaseModel  = new Information_BaseModel();
        $Information_GroupModel = new Information_GroupModel();
        //头部
        $Goods_CatModel = new Goods_CatModel();
        $data           = $Goods_CatModel->getCatListAll();

        //底部
        $data_information_foot = $Information_GroupModel->getInformationGroupList();
        //所有分类
        $data_all_group = $Information_GroupModel->getByWhere(array('information_group_parent_id' => 0));

        //最近文章
        $Information_BaseModel->sql->setLimit(0, 5);
        $data_recent_information = $Information_BaseModel->getByWhere(array(), array('information_add_time' => 'DESC'));

        if ($information_group_id)
        {
            $data_information_list = $Information_GroupModel->getInformationGroupLists($information_group_id);
        }
        $title             = Web_ConfigModel::value("information_title");//首页名;
        $this->keyword     = Web_ConfigModel::value("information_keyword");//关键字;
        $this->description = Web_ConfigModel::value("information_description");//描述;
        $this->title       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $title);
        $this->title       = str_replace("{name}", "成长之路", $this->title);
        $this->keyword       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->keyword);
        $this->keyword      = str_replace("{name}", "成长之路", $this->keyword);
        $this->description       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->description);
        $this->description       = str_replace("{name}", "成长之路", $this->description);
        include $this->view->getView();
    }



	/**
	 * 管理界面
	 *
	 * @access public
	 */
	public function manage()
	{
		include $this->view->getView();
	}

	/**
	 * 列表数据
     *
	 * @param int $page 页码
     * @param int $rows 每页显示条数
     * @param string $sort 排序方式
     * @return array $data 查询数据
     *
	 * @access public
	 */
	public function lists()
	{
		$user_id = Perm::$userId;

		$page = request_int('page');
		$rows = request_int('rows');
		$sort = request_int('sord');

		$cond_row  = array();
		$order_row = array();

		$data = array();

		if ($skey = request_string('skey'))
		{
			$data = $this->informationBaseModel->getBaseList($cond_row, $order_row, $page, $rows);
		}
		else
		{
			$data = $this->informationBaseModel->getBaseList($cond_row, $order_row, $page, $rows);
		}


		$this->data->addBody(-140, $data);
	}

	/**
	 * 读取
     * @param int $information_id 文章id
     * @return array $data 查询结果
	 *
	 * @access public
	 */
	public function get()
	{
		$user_id                        = Perm::$userId;
		$Information_LikeModel          = new Information_LikeModel();
        $GoodsBaseModel                 = new Goods_BaseModel();
		$information_id                 = request_int('information_id');
		$type                           = request_int('type');
		$rows                           = $this->informationBaseModel->getOneByWhere(array('information_id'=>$information_id));
        $rows['information_add_time']   = date("Y-m-d",strtotime($rows['information_add_time'])) ;
        if($rows['information_read_count']!=0 || $rows['information_read_count']!=null ){
            $rows['read_count'] = $rows['information_read_count']+$rows['information_fake_read_count'];
        }else{
            $rows['read_count'] = $rows['information_fake_read_count'];
        }
            $sql                        = "select count(information_id)as infou_count from ylb_information_like where information_id=".$information_id." GROUP  by information_id desc";
            $rows['infou_count']        =  $this->informationBaseModel->sql($sql);
            if($rows['infou_count']==null){
                $rows['infou_count']    = 0;
            }
        //是否点赞
        $rows['is_like']     = $Information_LikeModel->isLikeInfo($user_id,$information_id);
		$data = array();
		if ($rows)
		{
			$data            = $rows;
		}

        if(!empty($data['information_goods_recommend'])){
            $data['goods']   = array();
            foreach ($data['information_goods_recommend'] as $k => $value){
                $goods      = $GoodsBaseModel->getOne($value[0]);

                if( !empty( $goods ) )
                {
                    array_push($data['goods'],$goods);
                    $data['goods'][$k]['information_goods_price'] = $value[1];
                }

            }
        }
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false )
        {
            //微信内分享实例化
            $url_base            = explode('shop',YLB_Registry::get('base_url'));

            $url                =$url_base[0].'shop_wap/tmpl/information.html?information_id='.$information_id.'&type='.$type;
            $jssdk              = new Api_JSSDK("wx7c9bd0e5a3b798c3", "420fe679653100b366150f70a5afdb3c",$url);
            $signPackage        = $jssdk->GetSignPackage();
            $data['wxConfig']   = array(
                'appId'=>$signPackage['appId'],
                'timestamp'=>$signPackage['timestamp'],
                'nonceStr'=>$signPackage['nonceStr'],
                'signature'=>$signPackage['signature']
            );
        }


        /*----------------添加阅读足迹start-----------------------*/
        if( $user_id )
        {
            $User_InformationFootprintModel = new User_InformationFootprintModel();
            //获取是否已经有足迹,如果有更新阅读时间,没有添加阅读足迹
            $infor_cond_row['user_id'] = $user_id;
            $infor_cond_row['information_id'] = $information_id;
            $inforBase = $User_InformationFootprintModel->getInformationFootprintDetail( $infor_cond_row );
            if( $inforBase )
            {
                $infor_edit_row['infor_footprint_time'] = get_date_time();
                $infor_edit_row['user_id']              = $user_id;
                $infor_edit_row['writer_id']            = $data['user_id'];
                $infor_edit_row['information_id']       = $information_id;
                $edit_flag = $User_InformationFootprintModel->editInformationFootprint( $inforBase['information_footprint_id'],$infor_edit_row);
                if( !$edit_flag )
                {
                    $msg    = _('修改足迹失败');
                    $status = 250;
                }
                else
                {
                    $msg    = _('success');
                    $status = 200;
                }
            }
            else
            {
                $infor_add_row =array(

                    'user_id'               => $user_id,
                    'writer_id'             => $data['user_id'],
                    'infor_footprint_time'  => get_date_time(),
                    'information_id'        => $information_id,
                    'group_id'              => $data['information_group_id'],
                    'is_read_point'         =>0,
                );
                $add_flag = $User_InformationFootprintModel->addInformationFootprint( $infor_add_row );
                if( !$add_flag )
                {
                    $msg = _('添加足迹失败');
                    $status = 250;
                }
                else
                {
                    $msg = _('success');
                    $status = 200;
                }
            }
        }

        /*----------------添加阅读足迹end-----------------------*/
        $this->data->addBody(-140, $data,$msg,$status );
	}

	/**
	 * 添加
	 * @param int       $information_id     文章id
     * @param string    $information_desc   描述
     * @param string    $information_title  标题
     * @param string    $information_url    调用url
     * @param int       $information_group_id   分组id
     * @param string    $information_template   模版
     * @aram  string    $information_seo_title  seo标题
     * @aram  string    $information_seo_keywords  SEO关键字
     * @aram  string    $information_seo_description  SEO描述
     * @aram  string    $information_seo_description  SEO描述
     *
	 * @access public
	 */
	public function add()
	{
		$data['information_id']              = request_string('information_id'); // ID
		$data['information_desc']            = request_string('information_desc'); // 描述
		$data['information_title']           = request_string('information_title'); // 标题
		$data['information_url']             = request_string('information_url'); // 调用网址-url，默认为本页面构造的网址，可填写其它页面
		$data['information_group_id']        = request_string('information_group_id'); // 组
		$data['information_template']        = request_string('information_template'); // 模板
		$data['information_seo_title']       = request_string('information_seo_title'); // SEO标题
		$data['information_seo_keywords']    = request_string('information_seo_keywords'); // SEO关键字
		$data['information_seo_description'] = request_string('information_seo_description'); // SEO描述
		$data['information_reply_flag']      = request_string('information_reply_flag'); // 是否启用问答留言
		$data['information_lang']            = request_string('information_lang'); // 语言
		$data['information_type']            = request_string('information_type'); // 类型-暂时忽略
		$data['information_sort']            = request_string('information_sort'); // 排序
		$data['information_status']          = request_string('information_status'); // 状态 1:启用  2:关闭
		$data['information_add_time']        = request_string('information_add_time'); // 添加世间
		$data['information_pic']             = request_string('information_pic'); // 文章图片
        $data['information_fake_read_count']             = request_string('information_fake_read_count'); // 虚拟阅读量
        $data['information_read_count']             = request_string('information_read_count'); // 真实阅读量

		$information_id = $this->informationBaseModel->addBase($data, true);

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

		$data['information_id'] = $information_id;

		$this->data->addBody(-140, $data, $msg, $status);
	}

	/**
	 * 删除操作
	 * @param  int information_id 文章id
	 * @access public
	 */
	public function remove()
	{
		$information_id = request_int('information_id');

		$flag = $this->informationBaseModel->removeBase($information_id);

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

		$data['information_id'] = array($information_id);

		$this->data->addBody(-140, $data, $msg, $status);
	}

	/**
	 * 修改
	 *
	 * @access public
	 */
	public function edit()
	{
		$data['information_id']              = request_string('information_id'); // ID
		$data['information_desc']            = request_string('information_desc'); // 描述
		$data['information_title']           = request_string('information_title'); // 标题
		$data['information_url']             = request_string('information_url'); // 调用网址-url，默认为本页面构造的网址，可填写其它页面
		$data['information_group_id']        = request_string('information_group_id'); // 组
		$data['information_template']        = request_string('information_template'); // 模板
		$data['information_seo_title']       = request_string('information_seo_title'); // SEO标题
		$data['information_seo_keywords']    = request_string('information_seo_keywords'); // SEO关键字
		$data['information_seo_description'] = request_string('information_seo_description'); // SEO描述
		$data['information_reply_flag']      = request_string('information_reply_flag'); // 是否启用问答留言
		$data['information_lang']            = request_string('information_lang'); // 语言
		$data['information_type']            = request_string('information_type'); // 类型-暂时忽略
		$data['information_sort']            = request_string('information_sort'); // 排序
		$data['information_status']          = request_string('information_status'); // 状态 1:启用  2:关闭
		$data['information_add_time']        = request_string('information_add_time'); // 添加世间
		$data['information_pic']             = request_string('information_pic'); // 文章图片
        $data['information_fake_read_count']  = request_string('information_fake_read_count'); // 虚拟阅读量
        $data['information_read_count']  = request_string('information_read_count'); // 真实阅读量

		$information_id = request_int('information_id');
		$data_rs    = $data;

            unset($data['information_id']);

		$flag = $this->informationBaseModel->editBase($information_id, $data);
		$this->data->addBody(-140, $data_rs);
	}

    /**
     *
     * 商品推荐
     *
     */
    public function goods_recommend(){
        $condition = request_int('goods_group_id');
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
         *  6淘金
         *  7店铺
         *      分享立减    goods_share_price
         *      分享立赚    goods_promotion_price
         *      销量        goods_salenum
         */
        $GoodsBaseModel = new Goods_BaseModel();
        $rows = request_int('rows',8);
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
                    $data['items'][$key]['goods_price'] = $value['newbuyer_price'];
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
                    $data['items'][$key]['goods_price'] = $value['scarebuy_price'];
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
                    $data['items'][$key]['goods_price'] = $value['discount_price'];
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
                    $data['items'][$key]['goods_price'] = $value['bundling_goods_price'];
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

            $order_row['common_salenum'] = 'DESC';

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
                if ($goods){
                    $data['items'][$key]['goods_promotion_price'] =  $goods['goods_promotion_price'];
                    $data['items'][$key]['goods_share_price'] =  $goods['goods_share_price'];
                    $data['items'][$key]['goods_salenum'] =  $goods['goods_salenum'];
                } else {
                    unset($data['items'][$key]);
                }

            }
        }elseif ($condition == 7){
            $cond['shop_id'] = Perm::$shopId;
            $cond['goods_is_shelves'] = 1;
            $data = $GoodsBaseModel->listByWhere($cond,$order,$page,$rows);
        }else{
            $cond['goods_is_shelves'] = 1;
            $data = $GoodsBaseModel->listByWhere($cond,$order,$page,$rows);
        }

        $data['items'] = array_values($data['items']);

        //分页
        $YLB_Page = new YLB_Page();
        $YLB_Page->nowPage    = $page;
        $YLB_Page->listRows   = $rows;
        $YLB_Page->totalPages = $data['total'];
        $page_nav             = $YLB_Page->ajaxPromptII();
        $data['page_nav'] = $page_nav;
        $this->data->addBody(-140, $data);
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
        $data = array();
        if (Web_ConfigModel::value('verify_allow'))
        {
            $data['information_state'] = Information_BaseModel::WAITING_AUDIT;
        }
        else
        {
            $data['information_state'] = Information_BaseModel::NO_NEED_AUDIT;
        }
        $Information_BaseModel  = new Information_BaseModel();
        $User_InfoModel         = new User_InfoModel();

        $userId = Perm::$userId;
        $data['information_title']      = request_string('information_title');
        $content                        = request_string('content');
        $data['information_group_id']   = request_int('information_group_id');
        $data['information_keyword']    = request_string('keyword');
        $data['information_pic']        = request_string('information_pic');
        //$goods_id                       = request_string('information_goods_recommend');
        //$goods_type                     = request_string('information_goods_recommend_type');
        $act                            = request_string('act');
        $information_id                 = request_string('information_id');

        /*$goods_length = sizeof($goods_id);
        $goods_length = $goods_length > 4 ? 4 : $goods_length;
        for ($x=0;$x<$goods_length;$x++){
            $recommend_goods[$x] = [$goods_id[$x],$goods_type[$x]];
        }*/

        $goods_id = request_row('information_goods_recommend');
        $goods_type = request_row('information_goods_recommend_type');

        $recommend_goods = [];
        $goods_length = count($goods_id) > 4 ? 4 : count($goods_id);

        for ($x = 0; $x < $goods_length; $x++){
            if (!isset($recommend_goods[$goods_id[$x]])){
                $recommend_goods[$goods_id[$x]] = [$goods_id[$x],$goods_type[$x]];
            }
        }
        $recommend_goods = array_values($recommend_goods);

        if( $act && $act == 'edit')
        {
            if( $userId )
            {
                //修改文章
                $field_row = array(
                    'user_id'=>$userId,
                    'information_desc'=>$content,
                    'information_title'=>$data['information_title'],
                    'information_writer'=>$userId,
                    'information_group_id'=>$data['information_group_id'],
                    'information_pic'=>$data['information_pic'],
                    'information_keyword'=> $data['information_keyword'],
                    'information_goods_recommend'=> $recommend_goods,
                );
                $editFlag = $Information_BaseModel->editBase( $information_id,$field_row );
                if( $editFlag ){
                    $msg = _('success');
                    $status = 200;
                }
                else
                {
                    $msg = _('修改失败');
                    $status = 250;
                }
            }
            $data['information_id'] = $information_id;
        }
        else
        {
            //新增文章

            $UserInfo = $User_InfoModel->getOne($userId);
            $data['information_status'] = 1;
            $data['information_type']   = 0;
            $data['information_desc']   = $content;
            $video_row = get_html_attr_by_tag($content,'src','video,embed');
            if ($video_row){
                $data['information_video'] = $video_row;
            }

            $data['information_add_time'] = date('Y-m-d H:i:s', time());
            //都是user_id   之前涉及太多.  就  懒   的  改   了.
            $data['information_writer'] = Perm::$userId;//资讯所取的id
            $data['user_id'] = Perm::$userId;//粉丝群所取的id
            $data['information_goods_recommend'] = $recommend_goods;
            $information_id = $Information_BaseModel->addBase($data, true);
            if ($information_id)
            {
                $PointsLogModel = new Points_LogModel();
                $PointsLogModel->addPointsLog($userId,$UserInfo['user_name'],Points_LogModel::POST);
                if (!empty($goods_id)){
                    $recommend_count = sizeof($goods_id);
                    $PointsLogModel->addPointsLog($userId,$UserInfo['user_name'],Points_LogModel::RECOMMEND,$recommend_count);
                }
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
        }


        if ($this->typ == "json")
        {
            $this->data->addBody(-140, $data, $msg, $status);
        }
        else
        {
            include $this->view->getView();
        }
    }

   /**
    * 2018.08.02
    * @JiaXL
    * @param
    * @return array()
    * wap文章阅读增加金蛋接口
    */
   public function readPoint(){

       $information_id = request_string("information_id");
       //阅读增加金蛋接口
       $user_info = Perm::$row;
       if( $user_info )
       {
           //获取文章浏览足迹信息
           $User_InformationFootprintModel = new User_InformationFootprintModel();
           $info_cond_row['user_id']            = $user_info['user_id'];
           $info_cond_row['information_id']     = $information_id;
           $user_infomation = $User_InformationFootprintModel->getInformationFootprintDetail( $info_cond_row );
         if( $user_infomation )
           {
               if( $user_infomation['is_read_point'] != 1 )
               {
                   $PointsLogModel = new Points_LogModel();
                   $data = $PointsLogModel->addPointsLog($user_info['user_id'],$user_info['user_account'],Points_LogModel::READ);

                   if( $data['flag'] == 1)
                   {
                       //金蛋增加成功,修改is_read_point

                       $infor_edit_row['is_read_point']         = 1;
                       $edit_flag = $User_InformationFootprintModel->editInformationFootprint( $user_infomation['information_footprint_id'],$infor_edit_row);
                       if( $edit_flag )
                       {
                           $msg = _("增加金蛋成功");
                           $status = 200;
                       }
                   }
                   else
                   {
                       $msg = _("增加金蛋失败,到达上线");
                       $status = 250;
                   }
               }
               else if( $user_infomation['is_read_point'] == 1 )
               {
                   $data = array();
                   $msg = _("已经增加金蛋,不可重复");
                   $status= 250;
               }

           }

       }
       else
       {
           $data = array();
           $msg = _("请登录");
           $status = 250;
       }

       if( $this->typ =='json')
       {
           $this->data->addBody(-140,$data,$msg,$status);
       }
   }

   /**
    * 2018.08.04
    * @JiaXL
    * @return array()
    * */
    //推荐文章
    public function recommendList(){

        if( $this->typ == 'json' )
        {
            $this->data->addBody(-140,array('ddf'));

        }
        $user_id                = Perm::$userId;
        $User_FootprintModel    = new User_FootprintModel();
        $Goods_CommonModel      = new Goods_CommonModel();
        $Information_BaseModel  = new Information_BaseModel();
        $Goods_BaseModel        = new Goods_BaseModel();
        if( $user_id )
        {
            // 3.根据浏览商品足迹与文章推荐商品匹配推荐文章
            $foot_cond_row['user_id']           = $user_id;
            $foot_cond_row['footprint_time:>']  = date("Y-m-d H:i:s",strtotime("-15 days"));
            $foot_order_row['footprint_time']   = 'DESC';
            $footPrint                          = $User_FootprintModel->getByWhere( $foot_cond_row,$foot_order_row );
            $footPrint_cid                      = array_unique( array_column( $footPrint,"common_id" ) );
            //获取common 表中cid的gid
            $common_cond_row['common_id:IN']    = $footPrint_cid;
            $common_cond_row['shop_status']     = 3;
            $common_cond_row['common_state']    = $Goods_CommonModel::GOODS_STATE_NORMAL;
            $common_cond_row['common_verify']   = $Goods_CommonModel::GOODS_VERIFY_ALLOW;
            $common_data                        = $Goods_CommonModel->getByWhere( $common_cond_row );
            $common_ids                         = array_values( array_unique( array_column( $common_data,"common_id" ) ) );
            //获取文章推荐商品
            $rem_goods_cond_row['information_type']         = $Information_BaseModel::ARTICLE_TYPE_ARTICLE;
            $rem_goods_cond_row['information_status']       = $Information_BaseModel::ARTICLE_STATUS_TRUE;
            $rem_goods_cond_row['information_add_time:>']   = date("Y-m-d H:i:s",strtotime("-7 days") );
            $info_rem_goods                                 = $Information_BaseModel->getByWhere( $rem_goods_cond_row );
            foreach ( $info_rem_goods as $key => $val )
            {
                foreach ( $val['information_goods_recommend'] as $k => $v )
                {
                    if( $v[0] )
                    {
                        $sql = 'SELECT common_id from ylb_goods_base WHERE  goods_id = '.$v[0].' AND goods_is_shelves='.$Goods_BaseModel::GOODS_UP;
                        $common_id                              = $Goods_BaseModel->selectSql( $sql );
                        $info_rem_goods[$key]['common_ids'][]   = $common_id[0]['common_id'] ;
                    }
                    else
                    {
                        unset( $info_rem_goods[$key] );
                    }
                }

                foreach ( $info_rem_goods[$key]['common_ids'] as $k=>$v )
                {
                    if( in_array( $v,$common_ids) )
                    {
                        if( !isset( $rem_third[$info_rem_goods[$key]['information_id']] ) )
                        {
                            $rem_third[$info_rem_goods[$key]['information_id']] = $info_rem_goods[$key];
                        }
                    }
                }

            }
            $data['items']      = array_values( $rem_third );
            $data['totalsize']  = count($rem_third);
            $msg                = _('success');
            $status             = 200;
        }
        else
        {
            $data['items']  = array();
            $msg            = _('没有登录无推荐文章');
            $status         = 200;
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

    /**
     * 热视商品推荐页
     *2018.08.09
     *JiaXL
     *@param $user_id;
     *@return $data
     *@access public
     **/
    public function videoGoods()
    {

        $information_base   = new Information_BaseModel();
        $goods_common       = new Goods_CommonModel();
        $goods_base         = new Goods_BaseModel();
        $User_InfoModel     = new User_InfoModel();
        $ManSong_BaseModel  = new ManSong_BaseModel();
        $Fu_BaseModel       = new Fu_BaseModel();
        $data               = array();
        $user_id            = request_int( "user_id" );
        $page               = request_int( "page",1 );
        $rows               = request_int( "rows",10 );
        if ( !empty( $user_id ) )
        {
            //获取用户信息
            $u_cond_row['user_id']  = $user_id;
            $user_info              = $User_InfoModel->getUserInfo($u_cond_row);
            if ( !empty( $user_info ) )
            {
                $data['user_info']  = $user_info;
            }
            $cond_row['user_id']                = $user_id;
            $cond_row['information_type']       = Information_BaseModel::ARTICLE_TYPE_ARTICLE;
            $cond_row['information_status']     = Information_BaseModel::ARTICLE_STATUS_TRUE;
            //$cond_row['information_state']      = Information_BaseModel::AUDITED;  //审核通过暂时屏蔽,后期要打开
            $order_row['information_add_time']  = 'DESC';
            $infoData                           = $information_base->getBaseAllList( $cond_row, $order_row, $page, $rows );
            $remGoods                           = array_column( $infoData['items'], "information_goods_recommend" );
            $goods_id                           = [];
            $data['totalsize']                  = $infoData['totalsize'];
            $data['toatal']                     = $infoData['total'];
            $data['page']                       = $infoData['page'];
            foreach ( $remGoods as $key => $val )
            {
                if ( is_array( $val ) )
                {
                    foreach ( $val as $k => $v )
                    {
                        if ( !empty( $v[0] ) )
                        {
                            $goods_id[] = $v[0];
                        }
                    }
                }
            }
            $goods_id                           = array_unique( $goods_id );
            $base_cond_row['goods_id:IN']       = $goods_id;
            $base_cond_row['goods_is_shelves']  = Goods_BaseModel::GOODS_UP;
            $goodsBaseData                      = $goods_base->getByWhere( $base_cond_row );

            //获取送福活动商品信息
            $fu_cond_row['fu_state'] = Fu_BaseModel::NORMAL;
            $fu_base    = $Fu_BaseModel->getByWhere( $fu_cond_row );
            $gid        = array_column( $fu_base,"goods_id" );
            $fuData     = array_combine( $gid, $fu_base );
            //获取参加满送的商店信息
            $man_cond_row['mansong_state']=ManSong_BaseModel::NORMAL;
            $manData        = $ManSong_BaseModel->getManSongByWhere( $man_cond_row );
            $man_shop_id    = array_column( $manData , "shop_id" );
            $manSong        = array_combine( $man_shop_id, $manData );
            foreach ( $goodsBaseData as $key=> $val )
            {
                $common_cond_row['common_id']       = $val['common_id'];
                $common_cond_row['shop_status']     = 3;
                $common_cond_row['common_verify']   = Goods_CommonModel::GOODS_VERIFY_ALLOW;
                $common_cond_row['common_state']    = Goods_CommonModel::GOODS_STATE_NORMAL;
                $commonData                         = $goods_common->getByWhere( $common_cond_row );
                if( $commonData )
                {
                    $goodsBaseData[$key]['common_promotion_type']   = $commonData[$val['common_id']]['common_promotion_type'];
                    $goodsBaseData[$key]['common_is_jia']           = $commonData[$val['common_id']]['common_is_jia'];
                }
                else
                {
                    unset( $goodsBaseData[$key] );
                }

                // 判断是否送福和满送
                if( array_key_exists( $val['shop_id'],$manSong ) )
                {
                    $goodsBaseData[$key]['mansong_id'] = $manSong[$val['shop_id']]['mansong_id'];
                }

                if( array_key_exists( $val['goods_id'],$fuData ) )
                {
                    $goodsBaseData[$key]['fu_flag'] = 1;
                }
                else
                {
                    $goodsBaseData[$key]['fu_flag'] = 0;
                }

            }
            if ( !empty( $goodsBaseData ) )
            {
                $data['goods_info'] = array_values( $goodsBaseData );
            }
            else
            {
                $data['goods_info'] = array();
            }
            $msg    = _("success");
            $status = 200;
        }
        else
        {
            $msg    = _("fail");
            $status = 250;
        }
        if ( $this->typ == 'json' )
        {
            $this->data->addBody( -140, $data, $msg, $status );
        }
    }


    /**
     *
     *
     * 视频播放页 videoPlay.html
     * @creatTime 2018.08.11
     * @By JiaXL
     * @param $info_id;
     * @return $data
     * @access public
     */

    function getVideo() {

        $information_id                     = request_int("information_id");
        $info_id                            = request_int("info_id");
        $type                               = request_string("type");
        $from                               = request_string("from");
        $src                                = request_string("src");

        if( !empty( $information_id ) )
        {
            $cond_row['information_id']     = $information_id;
        }
        $cond_row['information_type']       = Information_BaseModel::ARTICLE_TYPE_ARTICLE;
        $cond_row['information_status']     = Information_BaseModel::ARTICLE_STATUS_TRUE;
        $cond_row['information_video:<>']    = ' ';
        $order_row['information_add_time'] = "DESC";
        //$cond_row['information_state']    = Information_BaseModel::AUDITED;  后续审核用
        $page = request_string("page",1);
        $rows = request_string("rows",5);
        $infoData= $this->informationBaseModel->getBaseAllList( $cond_row, $order_row, $page, $rows );
        //是否给资讯点赞
        $user_id = Perm::$userId;
        if( $user_id )
        {
            $ulike_cond_row['user_id'] = $user_id;
            $user_like = $this->Information_LikeModel->getByWhere( $ulike_cond_row );
            $user_like_ids  = array_column( $user_like,"information_id");
            $user_like_new  =array_combine( $user_like_ids,$user_like );
            //查找登录账号好友列表
            $user_friend_cond_row['user_id'] = $user_id;
            $friendItems    = $this->Uer_FriendModel->getFriendAll( $user_friend_cond_row );
            $friend_id      = array_column( $friendItems, 'friend_id' );
            $friend_Arr     = array_combine( $friend_id,$friendItems );
        }

        foreach ( $infoData['items'] as $key=> $val )
        {

            //获取文章总回复数
            $reply_cond_row['article_id']               = $val['information_id'];
            $reply_cond_row['article_reply_parent_id']  = 0;
            $count_reply = $this->InformationReplyModel->getRowCount( $reply_cond_row );
            $infoData['items'][$key]['countReply'] = $count_reply;
            //获取总点赞数
            $like_cond_row['information_id'] = $val['information_id'];
            $countLike = $this->Information_LikeModel->getRowCount( $like_cond_row );
            $infoData['items'][$key]['countLike'] = $countLike;
            //是否已经点赞
            if( array_key_exists( $val['information_id'],$user_like_new ) )
            {
                $infoData['items'][$key]['is_Like'] = 1;
                $infoData['items'][$key]['like_id'] = $user_like_new[$val['information_id']]['id'];
            }
            else
            {
                $infoData['items'][$key]['is_Like'] = 0;
            }
            //是否是已关注好友
            if( array_key_exists( $val['user_id'],$friend_Arr ) )
            {
                $infoData['items'][$key]['is_friend'] = 1;
                $infoData['items'][$key]['friend_id'] = $friend_Arr[$val['user_id']]['user_friend_id'];
            }
            else
            {
                $infoData['items'][$key]['is_friend'] = 0;
            }
            //获取作者信息
            $user_cond_row['user_id'] = $val['user_id'] ? $val['user_id'] : $val['information_writer'] ;
            $user_info = $this->User_InfoModel->getUserInfo( $user_cond_row );
            if( !empty( $user_info ) )
            {
                $infoData['items'][$key]['user_logo'] = $user_info['user_logo'];
                $infoData['items'][$key]['user_name'] = $user_info['user_name'];
            }
        }
        if( !empty( $infoData ) )
        {
            $msg = _('success');
            $status = 200;
        }
        else
        {
            $msg    = _("暂无数据");
            $status = 250;
        }

        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false)
        {
            //微信内分享实例化
            if( $info_id && $from && $src && $type )
            {
                $url            =YLB_Registry::get('shop_wap_url') . '/tmpl/friendletter/videoplay.html';
                $url           .='?info_id='.$info_id;
                $url           .='&type='.$type;
                $url           .='&from='.$from;
                $url           .='&src='.$src;

            }else{
                $url            = YLB_Registry::get('shop_wap_url') . '/tmpl/friendletter/videoplay.html';
            }
            $jssdk              = new Api_JSSDK("wx7c9bd0e5a3b798c3", "420fe679653100b366150f70a5afdb3c", $url);
            $signPackage        = $jssdk->GetSignPackage();
            $infoData['wxConfig']   = array(
                'appId'         => $signPackage['appId'],
                'timestamp'     => $signPackage['timestamp'],
                'nonceStr'      => $signPackage['nonceStr'],
                'signature'     => $signPackage['signature']
            );
        }
        if( $this->typ =='json' )
        {
            $this->data->addBody( -140,$infoData, $msg, $status );
        }
    }


    /**
     *@param $id;
     *@return array();
     *@access public
     * 2018.08.14  JiaXL
     */
    public function getVideoReply() {

        $infoId = request_string("id");
        $user_id= Perm::$userId;
        $user_infoModel = new User_InfoModel();
        $cond_row['article_id'] = $infoId;
        $cond_row['article_reply_parent_id'] = 0;
        $cond_row['article_reply_show_flag'] = 1;
        $order_row['article_reply_time']     = 'DESC';
        $replyData = $this->InformationReplyModel->getByWhere( $cond_row,$order_row );
        $data = array();
        if( !empty( $replyData ) )
        {
            foreach( $replyData as $key=> $val )
            {
                if( $user_id )
                {
                    if( $user_id == $val['user_id'] )
                    {
                        $replyData[$key]['is_userReply'] = 1;
                    }
                    else
                    {
                        $replyData[$key]['is_userReply'] = 0;
                    }
                }
                else
                {
                    $replyData[$key]['is_userReply'] = 0;
                }
                $user_cond_row['user_id'] = $val['user_id'];
                $user_info = $user_infoModel->getOneByWhere( $user_cond_row );
                if( !empty( $user_info ) )
                {
                    $replyData[$key]['user_logo'] = $user_info['user_logo'];
                }
                //获取评论回复数
                $reply_cond_row['article_reply_parent_id'] = $val['article_reply_id'];
                $reply_cond_row['article_reply_show_flag'] = 1;
                $reply = $this->InformationReplyModel->getRowCount( $reply_cond_row );
                if( !empty( $reply ) )
                {
                    $replyData[$key]['countReply'] = $reply;
                }
                else
                {
                    $replyData[$key]['countReply'] = 0;
                }
            }
            $data['reply']      = array_values( $replyData );
            $data['replyNum']   = count( $replyData );
            $data['article_id'] = $infoId;
        }
        else
        {
            $data['reply']      = array();
            $data['replyNum']   = 0;
            $data['article_id'] = $infoId;
        }

        if( $this->typ =='json' )
        {
            $this->data->addBody( -140,$data);
        }

    }


    /**
     * wap端 热视获取评论回复
     * @2018.08.15  JiaXL
     * @param $article_reply_id;
     * @return array()
     * @access public
     */
    public function getReply() {

        $reply_id = request_int("reply_id");
        $user_id  = Perm::$userId;
        if( $reply_id )
        {
            $data                           = array();
            $cond_row['article_reply_id']   = $reply_id ;
            $reply = $this->InformationReplyModel->getByWhere( $cond_row );

            $user_cond_row['user_id'] = $reply[$reply_id]['user_id'];
            $user_info = $this->User_InfoModel->getOneByWhere( $user_cond_row );
            if( $user_info )
            {
                $reply[$reply_id]['user_logo'] = $user_info['user_logo'];
            }
            if( !empty( $reply ) )
            {
                $data['parent_reply']       = $reply[$reply_id];
            }
            $reply_cond_row['article_reply_parent_id']  = $reply_id ;
            $reply_cond_row['article_reply_show_flag']  = 1 ;
            $order_row['article_reply_time']     = 'DESC';
            $childrenRely = $this->InformationReplyModel->getByWhere( $reply_cond_row,$order_row );
            if( !empty( $childrenRely ) )
            {

                foreach ( $childrenRely as $key => $val )
                {
                    $cUser_cond_row['user_id'] = $val['user_id'];
                    $childUser = $this->User_InfoModel->getOneByWhere( $cUser_cond_row );
                    if( $childUser )
                    {
                        $childrenRely[$key]['user_logo'] = $childUser['user_logo'];
                    }
                    if( $val['user_id'] == $user_id  && !empty( $user_id ) )
                    {
                        $childrenRely[$key]['is_userReply'] = 1;
                    }
                    else
                    {
                        $childrenRely[$key]['is_userReply'] = 0;
                    }
                }
                $data['childrenRely'] = array_values( $childrenRely );
            }
        }

        if( $this->typ=='json' )
        {
            $this->data->addBody(-140,$data);
        }



    }

    /**
     *wap端 热视评论删除操作
     *@2018.08.15 JiaXL
     * @param $article_reply_id;
     * @return $data
     * @access public
     */
    public function removeReply() {
        $article_reply_id = request_string("article_reply_id");
        if( $article_reply_id )
        {
            $data = array();
            $flag = $this->InformationReplyModel->removeReply( $article_reply_id );
            $reply_cond_row['article_reply_parent_id'] = $article_reply_id;
            $reply_cond_row['article_reply_show_flag'] = 1;
            $childReply = $this->InformationReplyModel->getByWhere( $reply_cond_row );
            if( !empty( $childReply ) )
            {
                foreach ( $childReply as $key=>$val )
                {
                    $childFlag = $this->InformationReplyModel->removeReply( $val['article_reply_id'] );
                    if( $childFlag && $flag )
                    {
                        $data['flag']   = 1;
                        $msg            = _("success");
                        $status         = 200;
                    }
                    else
                    {
                        $data['flag']   = 0;
                        $msg            = _("fail,删除子评论出错");
                        $status         = 250;
                    }
                }
            }
            else
            {
                if( $flag )
                {
                    $data['flag']   = 1;
                    $msg            = _("success");
                    $status         = 200;
                }
                else
                {
                    $data['flag']   = 0;
                    $msg            = _("fail");
                    $status         = 250;
                }
            }
        }
        if( $this->typ == "json" )
        {
            $this->data->addBody( -140, $data, $msg, $status );
        }
    }












}

?>