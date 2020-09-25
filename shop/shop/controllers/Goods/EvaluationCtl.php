<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Goods_EvaluationCtl extends YLB_AppController
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

		//include $this->view->getView();
		$this->goodsImagesModel              = new Goods_ImagesModel();
		$this->goodsEvaluationModel          = new Goods_EvaluationModel();
        $this->goodsEvaluationTickleModel    = new Goods_EvaluationTickleModel();
        $this->tradeOrderModel               = new Order_BaseModel();
        $this->userFriendModel               = new User_FriendModel();
        $this->Goods_CommonModel             = new Goods_CommonModel();
        $this->Goods_BaseModel               =new Goods_BaseModel();
	}

	/**
	 * 添加商品评论
	 *
	 * @access public
	 */
	public function addGoodsEvaluation()
	{
		//开启事物
		$this->goodsEvaluationModel->sql->startTransactionDb();
		
		if (Perm::checkUserPerm())
		{
			$user_id      = Perm::$row['user_id'];
			$user_account = Perm::$row['user_account'];
		}

		$evaluation = request_row('evaluation');

		foreach($evaluation as $key => $val)
		{
			//订单商品信息
			$Order_GoodsModel = new Order_GoodsModel();
			$order_goods      = $Order_GoodsModel->getOne($val[0]);

			//商品信息
			$Goods_BaseModel = new Goods_BaseModel();
			$goods_base      = $Goods_BaseModel->getOne($order_goods['goods_id']);

			//订单信息
			$Order_BaseModel = new Order_BaseModel();
			$order_base      = $Order_BaseModel->getOne($order_goods['order_id']);

			$Goods_CommonModel = new Goods_CommonModel();

			$matche_row = array();
			//有违禁词
			if (Text_Filter::checkBanned($val[3], $matche_row))
			{
				$data   = array();
				$msg    = _('含有违禁词');
				$status = 250;
				$this->data->addBody(-140, array(), $msg, $status);
				return false;
			}

			//修改商品的评价
			$evaluation_num = $this->goodsEvaluationModel->countGoodsEvaluation($order_goods['goods_id']);

			//星级好评数
			$goods_evaluation_good_star = ceil(($evaluation_num * $goods_base['goods_evaluation_good_star'] + $val[1]) / ($evaluation_num * 1 + 1));
			$goods_evaluation_count     = $evaluation_num * 1 + 1;

			$edit_row                               = array();
			$edit_row['goods_evaluation_good_star'] = $goods_evaluation_good_star;
			$edit_row['goods_evaluation_count']     = $goods_evaluation_count;


			$Goods_BaseModel->editBaseFalse($order_goods['goods_id'], $edit_row);

			//修改商品common表中的评论数量
			$edit_common_row['common_evaluate'] = 1;
			$Goods_CommonModel->editCommonTrue($order_goods['common_id'],$edit_common_row);

			//插入商品评价表
			$add_row                = array();
			$add_row['user_id']     = $user_id;
			$add_row['member_name'] = $user_account;
			$add_row['order_id']    = $order_base['order_id'];    //订单id
			$add_row['shop_id']     = $order_base['shop_id'];        //商家id
			$add_row['shop_name']   = $order_base['shop_name'];    //店铺名称
			$add_row['common_id']   = $order_goods['common_id'];
			$add_row['goods_id']    = $order_goods['goods_id'];    //商品id
			$add_row['goods_name']  = $order_goods['goods_name'];//商品名称
			$add_row['goods_price'] = $order_goods['goods_price'];    //商品价格
			$add_row['goods_image'] = $order_goods['goods_image'];    //商品图片
			$add_row['scores']      = $val[1];
			$add_row['result']      = $val[2];
			$add_row['content']     = $val[3];
			$add_row['image']       = $val[4];
			$add_row['isanonymous'] = request_int('isanonymous');    //是否匿名
			$add_row['create_time'] = get_date_time();        //创建时间
			$add_row['status']      = Goods_EvaluationModel::SHOW;

			$flag = $this->goodsEvaluationModel->addEvalution($add_row);

			//修改订单商品表
			$edit_order_goods['order_goods_evaluation_status'] = Order_GoodsModel::EVALUATION_YES;
			$Order_GoodsModel->editGoods($val[0], $edit_order_goods);

		}

		$package_scores = request_int('package_scores'); //描述相符
		$send_scores    = request_int('send_scores');        //发货速度
		$service_scores = request_int('service_scores');  //服务态度

		$Shop_EvaluationModel      = new Shop_EvaluationModel();

		$add_shop_row                              = array();
		$add_shop_row['shop_id']                   = $order_base['shop_id'];
		$add_shop_row['user_id']                   = $user_id;
		$add_shop_row['order_id']                  = $order_base['order_id'];
		$add_shop_row['evaluation_desccredit']     = $package_scores;
		$add_shop_row['evaluation_servicecredit']  = $service_scores;
		$add_shop_row['evaluation_deliverycredit'] = $send_scores;
		$add_shop_row['evaluation_create_time']    = get_date_time();

		$Shop_EvaluationModel->addEvaluation($add_shop_row);

		//修改订单中的评价信息
		$edit_order['order_buyer_evaluation_status'] = Order_BaseModel::BUYER_EVALUATE_YES;
		$edit_order['order_buyer_evaluation_time']   = get_date_time();
		$Order_BaseModel->editBase($order_base['order_id'], $edit_order);

		if ($flag && $this->goodsEvaluationModel->sql->commitDb())
		{
			$status = 200;
			$msg    = _('success');
			
			//评价成功添加数据到统计中心
			$analytics_data = array(
				'product_id'=>$goods_base['goods_id'],
				'score'=>$evaluation[0][1],
			);
			YLB_Plugin_Manager::getInstance()->trigger('analyticsScore',$analytics_data);
			
			/*
			*  经验与成长值
			*/
			$user_points = Web_ConfigModel::value("points_evaluate");
			$user_grade  = Web_ConfigModel::value("grade_evaluate");

			$User_ResourceModel = new User_ResourceModel();
			//获取金蛋经验值
			$ce = $User_ResourceModel->getResource(Perm::$userId);

			$resource_row['user_points'] = $ce[Perm::$userId]['user_points'] * 1 + $user_points * 1;
			$resource_row['user_growth'] = $ce[Perm::$userId]['user_growth'] * 1 + $user_grade * 1;

			$res_flag = $User_ResourceModel->editResource(Perm::$userId, $resource_row);

			$User_GradeModel = new User_GradeModel;
			//升级判断
			$res_flag = $User_GradeModel->upGrade(Perm::$userId, $resource_row['user_growth']);
			//金蛋
			$points_row['user_id']           = Perm::$userId;
			$points_row['user_name']         = Perm::$row['user_account'];
			$points_row['class_id']          = Points_LogModel::ONEVALUATION;
			$points_row['points_log_points'] = $user_points;
			$points_row['points_log_time']   = get_date_time();
			$points_row['points_log_desc']   = '评价订单';
			$points_row['points_log_flag']   = 'evaluation';

			$Points_LogModel = new Points_LogModel();

			$Points_LogModel->addLog($points_row);

			//成长值
			$grade_row['user_id']         = Perm::$userId;
			$grade_row['user_name']       = Perm::$row['user_account'];
			$grade_row['class_id']        = Grade_LogModel::ONEVALUATION;
			$grade_row['grade_log_grade'] = $user_grade;
			$grade_row['grade_log_time']  = get_date_time();
			$grade_row['grade_log_desc']  = '评价订单';
			$grade_row['grade_log_flag']  = 'evaluation';

			$Grade_LogModel = new Grade_LogModel;
			$Grade_LogModel->addLog($grade_row);
		}
		else
		{
			$this->goodsEvaluationModel->sql->rollBackDb();
			$m      = $this->goodsEvaluationModel->msg->getMessages();
			$msg    = $m ? $m[0] : _('failure');
			$status = 250;
		}

		$this->data->addBody(-140, array(), $msg, $status);
		

	}

	/**
	 * 追加商品评论
	 *
	 * @access public
	 */
	public function againGoodsEvaluation()
	{
		//开启事物
		$this->goodsEvaluationModel->sql->startTransactionDb();


		if (Perm::checkUserPerm())
		{
			$user_id      = Perm::$row['user_id'];
			$user_account = Perm::$row['user_account'];
		}

		$evaluation_goods_id = request_int('evaluation_goods_id');

		$evaluation_base = $this->goodsEvaluationModel->getOne($evaluation_goods_id);

		$order_id    = $evaluation_base['order_id'];    //订单id
		$shop_id     = $evaluation_base['shop_id'];        //商家id
		$shop_name   = $evaluation_base['shop_name'];    //店铺名称
		$common_id   = $evaluation_base['common_id'];
		$goods_id    = $evaluation_base['goods_id'];    //商品id
		$goods_name  = $evaluation_base['goods_name'];//商品名称
		$goods_price = $evaluation_base['goods_price'];    //商品价格
		$goods_image = $evaluation_base['goods_image'];    //商品图片
		$scores      = request_int('goods_scores');        //商品评分
		$result      = request_string('result');        //good,neutral,bad
		$content     = request_string('content');
		$img         = request_string('evaluate_img');        //晒单图
		$isanonymous = request_int('isanonymous');    //是否匿名（追加评论，默认为匿名）
		$create_time = get_date_time();        //创建时间


		$matche_row = array();
		//有违禁词
		if (Text_Filter::checkBanned($content, $matche_row))
		{
			$data   = array();
			$msg    = _('含有违禁词');
			$status = 250;
			$this->data->addBody(-140, array(), $msg, $status);
			return false;
		}

		//修改商品的评价
		$evaluation_num = $this->goodsEvaluationModel->countEvaluation($goods_id);
		$goods_evaluation_count     = $evaluation_num * 1 + 1;


		$edit_row                               = array();
		$edit_row['goods_evaluation_count']     = $goods_evaluation_count;

		$Goods_BaseModel = new Goods_BaseModel();
		$Goods_BaseModel->editBase($goods_id, $edit_row);

		//修改商品common表中的评论数量
		/*$Goods_CommonModel = new Goods_CommonModel();
		$edit_common_row['common_evaluate'] = 1;
		$Goods_CommonModel->editCommonTrue($common_id,$edit_common_row);*/

		//插入商品评价表
		$add_row                = array();
		$add_row['user_id']     = $user_id;
		$add_row['member_name'] = $user_account;
		$add_row['order_id']    = $order_id;
		$add_row['shop_id']     = $shop_id;
		$add_row['shop_name']   = $shop_name;
		$add_row['common_id']   = $common_id;
		$add_row['goods_id']    = $goods_id;
		$add_row['goods_name']  = $goods_name;
		$add_row['goods_price'] = $goods_price;
		$add_row['goods_image'] = $goods_image;
		$add_row['scores']      = $scores;
		$add_row['result']      = $result;
		$add_row['content']     = $content;
		$add_row['image']       = $img;
		$add_row['isanonymous'] = $isanonymous;
		$add_row['create_time'] = $create_time;
		$add_row['status']      = Goods_EvaluationModel::SHOW;

		$flag = $this->goodsEvaluationModel->addEvalution($add_row);


		if ($flag && $this->goodsEvaluationModel->sql->commitDb())
		{
			$status = 200;
			$msg    = _('success');

			/*
			*  经验与成长值
			*/
			$user_points = Web_ConfigModel::value("points_evaluate");
			$user_grade  = Web_ConfigModel::value("grade_evaluate");

			$User_ResourceModel = new User_ResourceModel();
			//获取金蛋经验值
			$ce = $User_ResourceModel->getResource(Perm::$userId);

			$resource_row['user_points'] = $ce[Perm::$userId]['user_points'] * 1 + $user_points * 1;
			$resource_row['user_growth'] = $ce[Perm::$userId]['user_growth'] * 1 + $user_grade * 1;

			$res_flag = $User_ResourceModel->editResource(Perm::$userId, $resource_row);

			$User_GradeModel = new User_GradeModel;
			//升级判断
			$res_flag = $User_GradeModel->upGrade(Perm::$userId, $resource_row['user_growth']);
			//金蛋
			$points_row['user_id']           = Perm::$userId;
			$points_row['user_name']         = Perm::$row['user_account'];
			$points_row['class_id']          = Points_LogModel::ONEVALUATION;
			$points_row['points_log_points'] = $user_points;
			$points_row['points_log_time']   = get_date_time();
			$points_row['points_log_desc']   = '评价订单';
			$points_row['points_log_flag']   = 'evaluation';

			$Points_LogModel = new Points_LogModel();

			$Points_LogModel->addLog($points_row);

			//成长值
			$grade_row['user_id']         = Perm::$userId;
			$grade_row['user_name']       = Perm::$row['user_account'];
			$grade_row['class_id']        = Grade_LogModel::ONEVALUATION;
			$grade_row['grade_log_grade'] = $user_grade;
			$grade_row['grade_log_time']  = get_date_time();
			$grade_row['grade_log_desc']  = '评价订单';
			$grade_row['grade_log_flag']  = 'evaluation';

			$Grade_LogModel = new Grade_LogModel;
			$Grade_LogModel->addLog($grade_row);
		}
		else
		{
			$this->goodsEvaluationModel->sql->rollBackDb();
			$m      = $this->goodsEvaluationModel->msg->getMessages();
			$msg    = $m ? $m[0] : _('failure');
			$status = 250;
		}

		$this->data->addBody(-140, array(), $msg, $status);
	}
/*
* wap追加商品评论
*
* @access public
*/
    public function againWapGoodsEvaluation()
    {
        //开启事物
        $this->goodsEvaluationModel->sql->startTransactionDb();


        if (Perm::checkUserPerm())
        {
            $user_id      = Perm::$row['user_id'];
            $user_account = Perm::$row['user_account'];
        }

        $evaluation = request_row('evaluation');


        foreach($evaluation as $key => $val)
        {
            //订单商品信息
            $Order_GoodsModel = new Order_GoodsModel();
            $order_goods      = $Order_GoodsModel->getOne($val[0]);

            //商品信息
            $Goods_BaseModel = new Goods_BaseModel();
            $goods_base      = $Goods_BaseModel->getOne($order_goods['goods_id']);

            //订单信息
            $Order_BaseModel = new Order_BaseModel();
            $order_base      = $Order_BaseModel->getOne($order_goods['order_id']);

            $Goods_CommonModel = new Goods_CommonModel();

            $matche_row = array();
            //有违禁词
            if (Text_Filter::checkBanned($val[3], $matche_row))
            {
                $data   = array();
                $msg    = _('含有违禁词');
                $status = 250;
                $this->data->addBody(-140, array(), $msg, $status);
                return false;
            }

            //修改商品的评价
            $evaluation_num = $this->goodsEvaluationModel->countEvaluation($order_goods['goods_id']);
            $goods_evaluation_count     = $evaluation_num * 1 + 1;

            $edit_row                               = array();
            $edit_row['goods_evaluation_count']     = $goods_evaluation_count;

            $Goods_BaseModel = new Goods_BaseModel();
            $Goods_BaseModel->editBase($order_goods['goods_id'], $edit_row);

            //修改商品common表中的评论数量
//            $edit_common_row['common_evaluate'] = 1;
//            $Goods_CommonModel->editCommonTrue($order_goods['common_id'],$edit_common_row);


            //插入商品评价表
            $add_row                = array();
            $add_row['user_id']     = $user_id;
            $add_row['member_name'] = $user_account;
            $add_row['order_id']    = $order_base['order_id'];    //订单id
            $add_row['shop_id']     = $order_base['shop_id'];        //商家id
            $add_row['shop_name']   = $order_base['shop_name'];    //店铺名称
            $add_row['common_id']   = $order_goods['common_id'];
            $add_row['goods_id']    = $order_goods['goods_id'];    //商品id
            $add_row['goods_name']  = $order_goods['goods_name'];//商品名称
            $add_row['goods_price'] = $order_goods['goods_price'];    //商品价格
            $add_row['goods_image'] = $order_goods['goods_image'];    //商品图片
            $add_row['scores']      = $val[1];
            $add_row['result']      = $val[2];
            $add_row['content']     = $val[3];
            $add_row['image']       = $val[4];
            $add_row['isanonymous'] = request_int('isanonymous');    //是否匿名
            $add_row['create_time'] = get_date_time();        //创建时间
            $add_row['status']      = Goods_EvaluationModel::SHOW;

            $flag = $this->goodsEvaluationModel->addEvalution($add_row);

        }


        if ($flag && $this->goodsEvaluationModel->sql->commitDb())
        {
            $status = 200;
            $msg    = _('success');

            /*
            *  经验与成长值
            */
            $user_points = Web_ConfigModel::value("points_evaluate");
            $user_grade  = Web_ConfigModel::value("grade_evaluate");

            $User_ResourceModel = new User_ResourceModel();
            //获取金蛋经验值
            $ce = $User_ResourceModel->getResource(Perm::$userId);

            $resource_row['user_points'] = $ce[Perm::$userId]['user_points'] * 1 + $user_points * 1;
            $resource_row['user_growth'] = $ce[Perm::$userId]['user_growth'] * 1 + $user_grade * 1;

            $res_flag = $User_ResourceModel->editResource(Perm::$userId, $resource_row);

            $User_GradeModel = new User_GradeModel;
            //升级判断
            $res_flag = $User_GradeModel->upGrade(Perm::$userId, $resource_row['user_growth']);
            //金蛋
            $points_row['user_id']           = Perm::$userId;
            $points_row['user_name']         = Perm::$row['user_account'];
            $points_row['class_id']          = Points_LogModel::ONEVALUATION;
            $points_row['points_log_points'] = $user_points;
            $points_row['points_log_time']   = get_date_time();
            $points_row['points_log_desc']   = '评价订单';
            $points_row['points_log_flag']   = 'evaluation';

            $Points_LogModel = new Points_LogModel();

            $Points_LogModel->addLog($points_row);

            //成长值
            $grade_row['user_id']         = Perm::$userId;
            $grade_row['user_name']       = Perm::$row['user_account'];
            $grade_row['class_id']        = Grade_LogModel::ONEVALUATION;
            $grade_row['grade_log_grade'] = $user_grade;
            $grade_row['grade_log_time']  = get_date_time();
            $grade_row['grade_log_desc']  = '评价订单';
            $grade_row['grade_log_flag']  = 'evaluation';

            $Grade_LogModel = new Grade_LogModel;
            $Grade_LogModel->addLog($grade_row);
        }
        else
        {
            $this->goodsEvaluationModel->sql->rollBackDb();
            $m      = $this->goodsEvaluationModel->msg->getMessages();
            $msg    = $m ? $m[0] : _('failure');
            $status = 250;
        }

        $this->data->addBody(-140, array(), $msg, $status);


    }

    /*
     * Jiaxl
     * wap端我的晒图*/
    public function wapGetEvalustion(){

        $data=array();
        if(Perm::checkUserPerm()) {
            $userId = Perm::$row['user_id'];
            $userName = Perm::$row['user_account'];
        }
            $img = request_string("img");
            if($img){
                $cond_row['image:!=']='';
            }
            $Goods_BaseModel   = new Goods_BaseModel();
            $cond_row['user_id']=$userId;
            $cond_row['member_name']=$userName;
            $cond_row['content:!=']='';
            $cond_row['isanonymous']=0;
            $cond_row['status']=1;

            $order_row=array(
                'create_time'=>'ASC'
            );

            //所有评论
            $evaluationAll= $this->goodsEvaluationModel->getEvaluationList($cond_row,$order_row);


            //商品好评率
            for($i=0; $i<count($evaluationAll['items']); $i++){
                /*商品点赞用户*/
                $tickleUser = $this->goodsEvaluationTickleModel->evaluationTickle(array("evaluation_goods_id"=>$evaluationAll['items'][$i][0]['evaluation_goods_id'],'status'=>1));
                $userIdArr= array_column($tickleUser,"user_id");
                if(in_array($userId ,$userIdArr) ){
                    $evaluationAll['items'][$i][0]['on']=1;
                }
                /*商品浏览量*/
                $sql = "SELECT goods_click from ylb_goods_base where goods_id=".$evaluationAll['items'][$i][0]['goods_id'];
                $evaluationAll['items'][$i][0]['goods_click'] = $Goods_BaseModel->select_sql($sql)['items'][0]['goods_click'];
                $evaluationAll['items'][$i][0]['countEvaluationTickle'] = $this->goodsEvaluationTickleModel->countEvaluationTickle(array('evaluation_goods_id'=>$evaluationAll['items'][$i][0]['evaluation_goods_id'],'status'=>1));
                $evaluationAll['items'][$i][0]['countGoodEvaluation'] = $this->goodsEvaluationModel->countGoodEvaluation($evaluationAll['items'][$i][0]['common_id']);
                //其他用户评论
                $evaluationAll['items'][$i][0]['otherEvaluation'] = $this->goodsEvaluationModel->getEvaluationList(array('user_id:!='=>$userId,'status'=>1,'common_id'=>$evaluationAll['items'][$i][0]['common_id'],'result'=>'good','isanonymous'=>0,'content:!='=>''),array('scores'=>'DESC'))['items'];
                //商品星级评价
                $evaluationAll['items'][$i][0]['goods_evaluation_good_star']  = $Goods_BaseModel->getGoodsDetailInfoByGoodId($evaluationAll['items'][$i][0]['goods_id'])['goods_base']['goods_evaluation_good_star'];
            }
            $data['all'] = $evaluationAll;

            //没评价的商品
            $evl_cond_row['buyer_user_id']=$userId;
            $evl_cond_row['order_status'] = Order_StateModel::ORDER_FINISH;  //已完成
            $evl_cond_row['order_buyer_hidden:!='] = Order_BaseModel::IS_BUYER_HIDDEN;
            $evl_cond_row['order_buyer_hidden:<'] = Order_BaseModel::IS_BUYER_REMOVE;
            $evl_cond_row['order_is_virtual']     = Order_BaseModel::ORDER_IS_REAL; //实物订单
            $evl_cond_row['chain_id']             = 0; //不是门店自提订单
            $evl_cond_row['order_buyer_evaluation_status']             = 0; //未评价

            $noEvaluation=$this->tradeOrderModel->getBaseList($evl_cond_row,array('order_create_time' => 'DESC'),0,5);
            foreach ($noEvaluation['items'] as $k=>$v){
                foreach ($v['goods_list'] as $key=>$val){
                    $goods_List[] = $val;
                    if(count($goods_List)>5){
                        return ;
                    }
                }

            }
            $data['noContent']['items'] =$goods_List;

            $msg = 'success';
            $status = 200;
            if($this->typ=='json'){
                $this->data->addBody(-140, $data, $msg, $status);
            }




    }



    /*
     * Jiaxl
     * wap点赞*/
    public function addEvaluationTickle(){
        if(Perm::checkUserPerm()){
            $uId = Perm::$row['user_id'];
        }
        $evaluation_goods_id = request_string("eId");
        $cond_row['evaluation_goods_id']= $evaluation_goods_id;
        $cond_row['user_id']= $uId;
        $res = $this->goodsEvaluationTickleModel->evaluationTickle($cond_row);

        $c_cound_row['evaluation_goods_id']= $evaluation_goods_id;
        $c_cound_row['status']= 1;
        /*已经点过赞 点赞状态为取消*/
       if($res)
        {
            foreach ($res as $k=>$v)
            {
              if($v['status']==0){
                    /*修改点赞状态*/
                    //开启事物
                    $this->goodsEvaluationTickleModel->sql->startTransactionDb();
                    $field_row['status']=1;
                    $field_row['tickle_time']=get_date_time();
                    $tickle_id =$v['tickle_id'];
                    $flag = $this->goodsEvaluationTickleModel->editEvaluation($tickle_id,$field_row);
                    if($flag &&  $this->goodsEvaluationTickleModel->sql->commitDb()){


                        $count = $this->goodsEvaluationTickleModel->countEvaluationTickle($c_cound_row);
                        $data['countTickle'] = $count;
                        $msg = _("点赞成功");
                        $status=200;
                    }else{
                        $this->goodsEvaluationTickleModel->sql->rollBackDb();
                        $m      = $this->goodsEvaluationTickleModel->sql->msg->getMessages();
                        $msg    = $m ? $m[0] : _('failure');
                        $status = 250;
                    }
                }

            }
        }else{
            /*没有点赞添加点赞*/
           $this->goodsEvaluationTickleModel->sql->startTransactionDb();
            $i_cond_row['user_id'] =$uId;
            $i_cond_row['evaluation_goods_id'] =$evaluation_goods_id;
            $i_cond_row['tickle_time'] =get_date_time();
            $i_cond_row['status'] =1;
            $add_flag = $this->goodsEvaluationTickleModel->addEvaluationTickle($i_cond_row);
            if($add_flag && $this->goodsEvaluationTickleModel->sql->commitDb()){

                $count = $this->goodsEvaluationTickleModel->countEvaluationTickle($c_cound_row);
                $data['countTickle'] = $count;
                $msg = _("点赞成功");
                $status=200;
            }else{
                $this->goodsEvaluationTickleModel->sql->rollBackDb();
                $m      = $this->goodsEvaluationTickleModel->sql->msg->getMessages();
                $msg    = $m ? $m[0] : _('failure');
                $status = 250;
            }
        }
        if($this->typ=='json'){
            $this->data->addBody(-140, $data, $msg, $status);
        }
    }



    /*Jiaxl
     * wap取消点赞*/
    public function cancleEvaluationTickle(){
        if(Perm::checkUserPerm()){
            $uId = Perm::$row['user_id'];
        }
        $evaluation_goods_id = request_string("eId");
        $cond_row['evaluation_goods_id']= $evaluation_goods_id;
        $cond_row['user_id']= $uId;
        $res = $this->goodsEvaluationTickleModel->evaluationTickle($cond_row);
        $c_cound_row['evaluation_goods_id']= $evaluation_goods_id;
        $c_cound_row['status']= 1;

        foreach ($res as $k=>$v){
            if($v['status'] ==1)
            {

                /*取消点赞*/
                $this->goodsEvaluationTickleModel->sql->startTransactionDb();
                $cancel_field_row['evaluation_goods_id']=$evaluation_goods_id;
                $cancel_field_row['user_id']=$uId;
                $cancel_field_row['tickle_time']=get_date_time();
                $cancel_field_row['status']=0;
                $editFlag = $this->goodsEvaluationTickleModel->editEvaluation($v['tickle_id'],$cancel_field_row);
                if($editFlag &&  $this->goodsEvaluationTickleModel->sql->commitDb()){

                    $count = $this->goodsEvaluationTickleModel->countEvaluationTickle($c_cound_row);

                    $data['countTickle'] = $count;
                    $msg = _("取消点赞成功");
                    $status=200;
                }else{
                    $this->goodsEvaluationTickleModel->sql->rollBackDb();
                    $m      = $this->goodsEvaluationTickleModel->sql->msg->getMessages();
                    $msg    = $m ? $m[0] : _('failure');
                    $status = 250;
                }

            }
        }
        $this->data->addBody(-140,$data,$msg);
    }


    /*
     * 粉丝圈
     * Jiaxl
     */
    public function  wapGetEvalCircle(){

        if(Perm::checkUserPerm()) {
            $userId = Perm::$row['user_id'];
            $userName = Perm::$row['user_account'];
        }


        $page = request_int("page");
        $rows = request_int("rows",5);
        $sort = request_string("sort");
        /*关注好友id*/
        $friend_cond_row['user_id']= $userId;
        $friend     = $this->userFriendModel->getByWhere($friend_cond_row);
        $friend_id  = array_column($friend,"friend_id");
        $friend     = array_combine( $friend_id,$friend);

        /*----*/
        $Goods_BaseModel   = new Goods_BaseModel();

         //按照销量排序,默认按照评论时间排序
        if($sort =='salenum')
        {
            $date = date("Y-m-d H:i:s",strtotime('-6 months'));
            $sql                ='SELECT *,u.user_logo FROM ylb_goods_evaluation e INNER JOIN ylb_goods_base b ON e.goods_id = b.goods_id LEFT JOIN ylb_user_info u on e.user_id = u.user_id  WHERE e.content != "" AND e.status = 1 AND e.result = "good" AND e.parent_id = 0 AND e.isanonymous=0 AND e.create_time > "'.$date.'" ORDER BY b.goods_salenum DESC';
            $sqlCount           ='SELECT count(*) FROM ylb_goods_evaluation e INNER JOIN ylb_goods_base b ON e.goods_id = b.goods_id WHERE e.content != "" AND e.status = 1 AND e.result = "good" AND e.parent_id = 0 AND e.isanonymous=0 AND e.create_time >"'.$date.'"';
            $arr                = $this->goodsEvaluationModel->select_sql($sql,$page,$rows);
            $count              = $this->goodsEvaluationModel->selectSql($sqlCount);
            $arr['totalsize']   =$count[0]['count(*)'];
            $evaluationAll      =$arr;
            for ($i=0; $i<count($evaluationAll['items']); $i++)
            {
                $evaluationAll['items'][$i]['user_name'] =$evaluationAll['items'][$i]['member_name'];
            }

        }
        else
        {
            $cond_row['content:!=']     = '';
            $cond_row['status']         = 1;
            $cond_row['result']         = 'good';
            $cond_row['parent_id']      = 0;
            $cond_row['isanonymous']    = 0;
            $order_row['create_time']   = 'ASC';

            //所有评论
            $evaluationAll= $this->goodsEvaluationModel->getEvaluationList($cond_row,$order_row,$page,$rows);
            foreach ($evaluationAll['items'] as $k=>$v)
            {
                $evaluationAll['items'][$k] = $v[0];
            }
            //*去除同一个商品的追评,只要第一次评价*/
            $unique = array();
            foreach ($evaluationAll['items'] as $k=>$v)
            {
                if($v['diff_time'] !=0 )
                {
                    $unique[$v['user_id']]= $v;
                }
            }

            /*去除下架的商品*/
            $goods_id       = array_column($evaluationAll['items'],"goods_id");
            $strGoods_id    = implode(",",$goods_id);
            $sql_g          = 'select goods_id from ylb_goods_base where goods_id in ('.$strGoods_id.') and goods_is_shelves = '.Goods_BaseModel::GOODS_UP;
            $g_arr          = array_column($this->Goods_BaseModel->selectSql($sql_g),"goods_id");

            foreach ( $evaluationAll['items'] as $k=>$v )
            {
                if(key_exists($v['user_id'],$unique) && $unique[$v['user_id']]['user_id'] == $v['user_id'] && $v['diff_time'] ==0)
                {
                    unset($evaluationAll['items'][$k]);
                }
                if(!in_array($v['goods_id'],$g_arr))
                {
                    unset($evaluationAll['items'][$k]);
                }
            }
            $evaluationAll['items'] = array_values( $evaluationAll['items'] );
        }
//        echo "<pre>";
////        print_r( $evaluationAll );
//        print_r( $evaluationAll['items'] );
//        die;
        for( $i=0; $i<count($evaluationAll['items']); $i++ )
        {
            /*获取评论回复*/
            $childrenEval                           = $this->goodsEvaluationModel->getChildrenEvaluation($evaluationAll['items'][$i]['evaluation_goods_id']);
            if( $childrenEval )
            {
                $evaluationAll['items'][$i]['children'] = $childrenEval;
            }else
            {
                $evaluationAll['items'][$i]['children'] = array('countChildren'=>0,'items'=>array());
            }


            /*判断用户是否点赞此评论*/
            $tickleUser = $this->goodsEvaluationTickleModel->evaluationTickle(array("evaluation_goods_id"=>$evaluationAll['items'][$i]['evaluation_goods_id'],'status'=>1));
            $userIdArr = array_column($tickleUser,"user_id");
            if(in_array($userId ,$userIdArr) )
            {
                $evaluationAll['items'][$i]['on']=1;
            }else{
                $evaluationAll['items'][$i]['on']=0;
            }

            /*获取商品销量*/
            $sql_saleNum = 'SELECT common_salenum from ylb_goods_common WHERE common_id='.$evaluationAll['items'][$i]['common_id'];
            $evaluationAll['items'][$i]['common_salenum'] = $Goods_BaseModel->select_sql($sql_saleNum)['items'][0]['common_salenum'];
            /*商品浏览量*/
            $sql = "SELECT goods_click from ylb_goods_base where goods_id=".$evaluationAll['items'][$i]['goods_id'];
            $evaluationAll['items'][$i]['goods_click']                  = $Goods_BaseModel->select_sql($sql)['items'][0]['goods_click'];
           /*评论点赞总数*/
            $evaluationAll['items'][$i]['countEvaluationTickle']        = $this->goodsEvaluationTickleModel->countEvaluationTickle(array('evaluation_goods_id'=>$evaluationAll['items'][$i]['evaluation_goods_id'],'status'=>1));
            /*好评率*/
            $evaluationAll['items'][$i]['countGoodEvaluation']          = $this->goodsEvaluationModel->countGoodEvaluation($evaluationAll['items'][$i]['common_id']);
            //商品星级评价
            //$evaluationAll['items'][$i]['goods_evaluation_good_star']   = $Goods_BaseModel->getGoodsDetailInfoByGoodId($evaluationAll['items'][$i]['goods_id'])['goods_base']['goods_evaluation_good_star'];
        }

        foreach ( $evaluationAll['items'] as $key=>$val)
        {
            /*判断用户是否关注该评论用户*/
            if( array_key_exists( $val['user_id'],$friend ) )
            {
                $evaluationAll['items'][$key]['friend_on']=1;
                $evaluationAll['items'][$key]['user_friend_id']=$friend[$val['user_id']]['user_friend_id'];
            }
            else
            {
                $evaluationAll['items'][$key]['friend_on']=0;
            }
        }
        $data['evaluationAll'] = $evaluationAll;
        if($this->typ=="json")
        {
            $this->data->addBody(-140,$data);
        }
    }

    /*
     * Jiaxl
     * 粉丝圈评论回复*/
    public function evaluationReply()
    {
        $uid        = request_string("uid");
        $uname      = request_string("uname");
        $content    = request_string("content");
        $parent_id  = request_string("parent_id");
        $matche_row = array();
        //有违禁词
        include_once(INI_PATH . '/filter.ini.php');
        $words =& $_CACHE['word_filter'];
         foreach ($words['filter']['find'] as $k=>$v)
         {
             if(preg_match($v,$content,$matche_row))
             {
                 $data   = array();
                 $msg    = _($matche_row[0]);
                 $status = 250;
                 $this->data->addBody(-140, array(), $msg, $status);
                 return false;
             }
         }
        $field_row['user_id']       = $uid;
        $field_row['member_name']   = $uname;
        $field_row['content']       = $content;
        $field_row['isanonymous']   = 0;
        $field_row['create_time']   = get_date_time();
        $field_row['status']        = 1;
        $field_row['parent_id']     = $parent_id;
        /*开启事务*/
        $this->goodsEvaluationModel->sql->startTransactionDb();
        $addFlag = $this->goodsEvaluationModel->addEvalution($field_row);
        if($addFlag && $this->goodsEvaluationModel->sql->commitDb())
        {
            $msg = _("回复成功");
            $status=200;
        }
        else
        {
            $this->goodsEvaluationModel->sql->rollBackDb();
            $m      = $this->goodsEvaluationModel->sql->msg->getMessages();
            $msg    = $m ? $m[0] : _('failure');
            $status = 250;
        }
        if($this->typ=="json")
        {
            $this->data->addBody(-140,array(),$msg,$status);
        }
    }
}

?>




















