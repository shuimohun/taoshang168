<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class NewsCtl extends Controller
{
    public $informationBaseModel = null;
    public $informationReplyModel = null;
    public function __construct(&$ctl, $met, $typ)
    {
        parent::__construct($ctl, $met, $typ);
        $this->informationReplyModel = new Information_ReplyModel();
    }

    //新闻首页
    public function index(){

        //分类
        $information_GroupModel = new Information_GroupModel();
        $UserInfoModel = new User_InfoModel();
        $cond['information_group_parent_id'] = 0;
        $cond2['information_state:>'] = 1;
        $cond3['information_state:>'] = 1;
        $data = $information_GroupModel->getByWhere($cond);
        if (count($data)>5){
            $data1 = array_slice($data,0,5);
            $data2 = array_slice($data,5);
        }
        //推荐
        $Information_BaseModel = new Information_BaseModel();
        $cond2['information_recommend'] = 1;
        $order2['information_sort'] = 'asc';
        $page2 = request_int('page',1);
        $rows2 = request_int('rows',10);
        $data_command = $Information_BaseModel->getGroupBaseList($cond2,$order2,$page2,$rows2);
        foreach ($data_command['items'] as $key => $value){
            $UserInfo = $UserInfoModel->getOne($value['information_writer']);
            $data_command['items'][$key]['user_name'] = $UserInfo['user_name'];
        }
        if($data_command && $data_command['items'])
        {
            $index_video = $data_command['items'][0];
            unset($data_command['items'][0]);
        }

        //二十四小时热文
        $order['information_add_time'] = 'desc';
        $page = request_int('page',1);
        $rows = request_int('rows',5);
        $cond3['information_add_time:>'] = date("Y-m-d,H-i-s",strtotime('-1 days'));
        $ershisi = $Information_BaseModel->getGroupBaseList($cond3,$order,$page,$rows);
        //左右壁纸
        $web_config = new Web_ConfigModel();
        $left = $web_config->getOne('photo_left_logo');
        $right = $web_config->getOne('photo_right_logo');
        //左右壁纸的链接
        $left_url = $web_config->getOne('photo_left_url');
        $right_url = $web_config->getOne('photo_right_url');
        if ('json' == $this->typ)
        {
            $this->data->addBody(-140, $data_command);
        }
        else
        {
            include $this->view->getView();
        }
    }

    //分类
    public function test(){

        $page = request_int('page',1);
        $rows2 = request_int('rows',8);
        $UserInfoModel = new User_InfoModel();
        $information_group_id = request_int('id');
        $Information_BaseModel = new Information_BaseModel();
        $cond['information_group_id'] = $information_group_id;
        $order['information_add_time'] = 'desc';
        $data3 = $Information_BaseModel->getGroupBaseList($cond,$order,$page,$rows2);
        foreach ($data3['items'] as $key => $value){
            $UserInfo = $UserInfoModel->getOne($value['information_writer']);
            $data3['items'][$key]['user_name'] = $UserInfo['user_name'];
        }
        if($this->typ = 'json')
        {
            $this->data->addBody(-140,$data3);
        }
        else
        {
            include $this->view->getView();
        }
    }

    //添加点赞
    public function getLike(){
        $Information_LikeModel = new Information_LikeModel();
        $Information_BaseModel = new Information_BaseModel();
        $UserInfoModel = new User_InfoModel();
        $PointsLogModel = new Points_LogModel();
        $data['user_id'] = Perm::$userId;
        $data['information_id'] = request_int('id');
        $from                   = request_string('from');
        $information = $Information_BaseModel->getOne($data['information_id']);
        $writer_id = $information['information_writer'];
        $UserInfo = $UserInfoModel->getOne($data['user_id']);          //当前用户信息
        $writerInfo = $UserInfoModel->getOne($writer_id);  //作者信息
        $information_like_id = $Information_LikeModel->likeInfo($data,true);

        if($information_like_id && $data['user_id'] != 0)
        {
            if( $from == 'point' )
            {
                $writer_point   = $PointsLogModel->addPointsLog($writer_id,$writerInfo['user_name'],Points_LogModel::BE_LIKED);//作者
                $user_point     = $PointsLogModel->addPointsLog( $data['user_id'],$UserInfo['user_name'],Points_LogModel::LIKES); //点赞人
                $data['writer_point'] = $writer_point;
                $data['user_point'] = $user_point;
            }
            $msg = _('success');
            $status = 200;
        }
        else
        {
            $msg = _('failure');
            $status = 250;
        }
        $data['information_like_id'] = $information_like_id;
        $this->data->addBody(-140, $data, $msg, $status);

    }
    //新闻详情页
    public function detail(){
//        cookie避免同一人多次阅读
        $information_id = request_int('id');
        $read_id =  $_COOKIE["read_id"];
        $read_id_Now = (string)$information_id;
//        cookie避免同一人多次阅读
        $Information_BaseModel = new Information_BaseModel();
        $information_GroupModel = new Information_GroupModel();
        $informationReplyModel = new Information_ReplyModel();
        $Information_LikeModel = new Information_LikeModel();
        $GoodsBaseModel = new Goods_BaseModel();

        $detail = $Information_BaseModel->getOne($information_id);
        if(!empty($detail['information_goods_recommend'])){
            $detail['goods'] = array();
            foreach ($detail['information_goods_recommend'] as $k => $value){
                $goods = $GoodsBaseModel->getOne($value[0]);
                array_push($detail['goods'],$goods);
                $detail['goods'][$k]['information_goods_price'] = $value[1];
            }
        }
        $user_id = Perm::$userId;
        //被点赞数目
        $howLike = $Information_LikeModel->howLike($information_id);

        if($user_id)
        {
            //是否被点赞
            $iflike = $Information_LikeModel->getKeyByWhere(array('user_id'=>$user_id,'information_id'=>$information_id));

            //添加文章浏览足迹
            $User_InformationFootprintModel = new User_InformationFootprintModel();
            //获取是否已经有足迹,如果有更新阅读时间,没有添加阅读足迹
            $infor_cond_row['user_id']          = $user_id;
            $infor_cond_row['information_id']   = $information_id;
            $inforBase = $User_InformationFootprintModel->getInformationFootprintDetail( $infor_cond_row );
            if( $inforBase )
            {
                $infor_edit_row['infor_footprint_time'] = get_date_time();
                $infor_edit_row['user_id']              = $user_id;
                $infor_edit_row['writer_id']            = $detail['user_id'];
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
                    'writer_id'             => $detail['user_id'],
                    'infor_footprint_time'  => get_date_time(),
                    'information_id'        => $information_id,
                    'group_id'              => $detail['information_group_id'],

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


        //更新文章的阅读次数
        if (!strpos($read_id,$read_id_Now)){
        $updateCount = $Information_BaseModel->updateReadCount($information_id,('information_read_count'));
        }
        $cond2['information_recommend'] = 1;
        $cond2['information_state:>'] = 1;
        $order2['information_add_time'] = 'desc';
        $page2 = request_int('page',1);
        $rows2 = request_int('rows',10);

        $data_command = $Information_BaseModel->getGroupBaseList($cond2,$order2,$page2,$rows2);
        $order['information_add_time'] = 'desc';

        $page = request_int('page',1);
        $rows = request_int('rows',4);
        $cond3['information_add_time:>'] = date("Y-m-d",strtotime(date("Y-m-d"),time()));
        $cond3['information_state:>'] = 1;
        $today_top = $Information_BaseModel->getGroupBaseList($cond3,$order,$page,$rows);
        //虚拟阅读量排行information_fake_read_count
        $order4['information_fake_read_count'] = 'desc';
        $cond4['information_state:>'] = 1;
        $page4 = request_int('page',1);
        $rows4 = request_int('rows',10);
        $cond4['information_status'] = 1;
        $fake_read = $Information_BaseModel->getGroupBaseList($cond4,$order4,$page4,$rows4);

        $cond5['information_group_parent_id'] = 0;
        $Navbar1 = $Navbar = $information_GroupModel->getByWhere($cond5);
        if (count($Navbar)>5){
            $Navbar1 = array_slice($Navbar,0,5);
            $Navbar2 = array_slice($Navbar,5);
        }
        $data5 = $informationReplyModel->getRowCount(array('article_id'=>$information_id));

        if($this->typ == 'json'){
            $this->data->addBody(-140,$detail,$msg,$status );
        }else{
            include $this->view->getView();
        }

    }
    //加入我们
    public function addus(){
        include $this->view->getView();
    }

    //读取评论
    public function comment(){

        //分类
        $information_GroupModel = new Information_GroupModel();
        $cond5['information_group_parent_id'] = 0;

        $Navbar1 = $Navbar = $information_GroupModel->getByWhere($cond5);
        if (count($Navbar)>5){
            $Navbar1 = array_slice($Navbar,0,5);
            $Navbar2 = array_slice($Navbar,5);
        }

        //资讯详情
        $id = request_int('id');
        $Information_BaseModel = new Information_BaseModel();
        $detail = $Information_BaseModel->getOne($id);

        //热门推荐
        $order4['information_fake_read_count'] = 'desc';
        $page4 = request_int('page',1);
        $rows4 = request_int('rows',10);
        $cond4['information_state:>'] = 1;
        $cond4['information_status'] = 1;
        $fake_read = $Information_BaseModel->getGroupBaseList($cond4,$order4,$page4,$rows4);



        //评论
        $article_id =  request_string('id');
        $rep_cond_row['article_id'] = $article_id;
        $rep_cond_row['article_reply_parent_id'] = 0;
        $rep_order_row['article_reply_time'] = 'desc';
        $rely_row = $this->informationReplyModel->listByWhere($rep_cond_row,$rep_order_row,1,20);

        $rely_count = $this->informationReplyModel->getRowCount(array('article_id'=>$article_id));

        if($rely_row && $rely_row['items'])
        {
            $user_id_row = array_column($rely_row['items'],'user_id');
            $user_id_row = array_unique($user_id_row);
            $UserInfoModel = new User_InfoModel();
            $user_info_row = $UserInfoModel->select('user_id,user_name,user_logo',array('user_id:IN'=>$user_id_row));
            $user_info = array();
            foreach ($user_info_row as $key=>$value)
            {
                $user_info[$value['user_id']] = $value;
            }

            //查回复
            $reply_id_row = array_column($rely_row['items'],'article_reply_id');
            $reply_row2 = $this->informationReplyModel->getByWhere(array('article_reply_parent_id:IN'=>$reply_id_row));

            $rely_row_new = array();
            foreach ($reply_row2 as $key=>$value)
            {
                if(array_key_exists($value['user_id'],$user_info))
                {
                    $value['user_name'] = $user_info[$value['user_id']]['user_name'];
                    $value['user_logo'] = $user_info[$value['user_id']]['user_logo'];
                }
                $rely_row_new[$value['article_reply_parent_id']][] = $value;
            }

            foreach ($rely_row['items'] as $key=>$value)
            {
                if(array_key_exists($value['user_id'],$user_info))
                {
                    $rely_row['items'][$key]['user_name'] = $user_info[$value['user_id']]['user_name'];
                    $rely_row['items'][$key]['user_logo'] = $user_info[$value['user_id']]['user_logo'];
                }

                if(array_key_exists($value['article_reply_id'],$rely_row_new))
                {
                    $rely_row['items'][$key]['reply'] = $rely_row_new[$value['article_reply_id']];
                }
            }
        }

        if($this->typ == 'json')
        {
            $this->data->addBody(-140, $rely_row);
        }
        else
        {
            include $this->view->getView();
        }

    }
    //添加评论
    public function addComment(){
//        $User_base = new User_BaseModel();
        $User_base = new User_InfoModel();
//		$data['information_reply_id']        = request_string('information_reply_id'); // 评论回复id
//		$data['information_reply_parent_id'] = request_string('information_reply_parent_id'); // 回复父id
        $data['article_id']              = request_int('id'); // 所属文章id
        $data['user_id']                 =  Perm::$userId; // 评论回复id


//        $sql = "select user_name,user_logo from ylb_user_info where user_id=".Perm::$userId;
        $cond_row['user_id'] = Perm::$userId;
        $users = $User_base->getOneByWhere($cond_row);
//        $users = $User_base ->sql($sql);
//        var_dump($users['user_name']);die;
        $data['user_name'] = $users['user_name'];
//		$data['user_id_to']              = request_string('user_id_to'); // 评论回复用户id
//		$data['user_name_to']            = request_string('user_name_to'); // 评论回复用户名称
        $matche_row = array();

        //是否有违禁词
        if (Text_Filter::checkBanned(request_string('text'), $matche_row))
        {
            $data   = array();
            $msg    = _('含有违禁词');
            $status = 240;
            $this->data->addBody(-140, array(), $msg, $status);
            return false;
        }

        $data['article_reply_content']   = request_string('text'); // 评论回复内容
        $data['article_reply_time']      = date("Y-m-d H:i:s",time()); // 评论回复时间
        $data['article_reply_show_flag'] = 1; // 问答是否显示
        $information_reply_id = $this->informationReplyModel->addReply($data, true);

        if ($information_reply_id)
        {
            $msg    = _('success');
            $status = 200;
        }
        else
        {
            $msg    = _('failure');
            $status = 250;
        }
        if ($data['user_id'] == 0){
            $status = 235;
        }
        $data['user_logo'] = $users['user_logo'];

        $data['information_reply_id'] = $information_reply_id;

        $this->data->addBody(-140, $data, $msg, $status);

    }
    //删除评论
    public function remove()
    {
        $information_reply_id = request_int('information_reply_id');

        $flag = $this->informationReplyModel->removeReply($information_reply_id);

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

        $data['information_reply_id'] = array($information_reply_id);

        $this->data->addBody(-140, $data, $msg, $status);
    }
    //回复评论
    public function replyComment(){
        $User_base = new User_BaseModel();
//		$data['information_reply_id']        = request_string('information_reply_id'); // 评论回复id
		$data['article_reply_parent_id'] = request_int('article_reply_id'); // 回复父id
        $data['article_id']              = request_int('article_id'); // 所属文章id
        $data['user_id']                 =  Perm::$userId; // 评论回复id


        $sql = "select user_name,user_logo from ylb_user_info where user_id=".Perm::$userId;
        $users = $User_base ->sql($sql);
        $data['user_name'] = $users[0]['user_name'];
//		$data['user_id_to']              = request_string('user_id_to'); // 评论回复用户id
//		$data['user_name_to']            = request_string('user_name_to'); // 评论回复用户名称
        $matche_row = array();

        if (Text_Filter::checkBanned(request_string('information_reply_content'), $matche_row))
        {
            $data   = array();
            $msg    = _('含有违禁词');
            $status = 250;
            $this->data->addBody(-140, array(), $msg, $status);
            return false;
        }

        $data['article_reply_content']   =  Text_Filter::filterWords(request_string('text')); // 评论回复内容
        $data['article_reply_time']      = date("Y-m-d H:i:s",time()); // 评论回复时间
        $data['article_reply_show_flag'] = 1; // 问答是否显示
        $information_reply_id = $this->informationReplyModel->addReply($data, true);

        if ($information_reply_id)
        {
            $msg    = _('success');
            $status = 200;
        }
        else
        {
            $msg    = _('failure');
            $status = 250;
        }
        if ($data['user_id'] == 0){
            $status = 235;
        }
        $data['user_logo'] = $users[0]['user_logo'];

        $data['information_reply_id'] = $information_reply_id;

        $this->data->addBody(-10, $data, $msg, $status);

    }
    //查看回复
    public function lookComment(){
        $User_base = new User_BaseModel();
        $informationReplyModel = new Information_ReplyModel();
        $article_reply_parent_id = request_int('article_reply_id');
        $article_id =  request_int('article_id');
//        $sql = 'select * from ylb_information_reply WHERE  article_id = '.$article_id .'  order by article_reply_time desc';
        $sql = 'select * from ylb_information_reply WHERE  article_id = '.$article_id .' AND article_reply_parent_id = '. $article_reply_parent_id .' order by article_reply_time desc';
        $data6 = $informationReplyModel->sql($sql);
        foreach ($data6 as $k =>$v){
            $sql = "select user_logo from ylb_user_info where user_id=".$v['user_id'];
            $users = $User_base ->sql($sql);
            $data6[$k]['user_logo'] = $users[0]['user_logo'];
        }
        if ($data6)
        {
            $msg    = _('success');
            $status = 200;
        }
        else
        {
            $msg    = _('failure');
            $status = 250;
        }
        $this->data->addBody(-140, $data6,$msg,$status);

        include $this->view->getView();

    }

    public function getCommentByPage()
    {
        //评论
        $article_id =  request_string('id');
        $rep_cond_row['article_id'] = $article_id;
        $rep_cond_row['article_reply_parent_id'] = 0;
        $rep_order_row['article_reply_time'] = 'desc';
        $reply_row = $this->informationReplyModel->listByWhere($rep_cond_row,$rep_order_row,1,20);

        if($reply_row && $reply_row['items'])
        {
            $user_id_row = array_column($reply_row['items'],'user_id');
            $user_id_row = array_unique($user_id_row);
            $UserInfoModel = new User_InfoModel();
            $user_info_row = $UserInfoModel->select('user_id,user_name,user_logo',array('user_id:IN'=>$user_id_row));
            $user_info = array();
            foreach ($user_info_row as $key=>$value)
            {
                $user_info[$value['user_id']] = $value;
            }

            //查回复
            $reply_id_row = array_column($reply_row['items'],'article_reply_id');
            $reply_row2 = $this->informationReplyModel->getByWhere(array('article_reply_parent_id:IN'=>$reply_id_row));
            $rely_row_new = array();
            foreach ($reply_row2 as $key=>$value)
            {
                if(array_key_exists($value['user_id'],$user_info))
                {
                    $value['user_name'] = $user_info[$value['user_id']]['user_name'];
                    $value['user_logo'] = $user_info[$value['user_id']]['user_logo'];
                }
                $rely_row_new[$value['article_reply_parent_id']][] = $value;
            }

            foreach ($reply_row['items'] as $key=>$value)
            {
                if(array_key_exists($value['user_id'],$user_info))
                {
                    $reply_row['items'][$key]['user_name'] = $user_info[$value['user_id']]['user_name'];
                    $reply_row['items'][$key]['user_logo'] = $user_info[$value['user_id']]['user_logo'];
                }

                if(array_key_exists($value['article_reply_id'],$rely_row_new))
                {
                    $reply_row['items'][$key]['reply'] = $rely_row_new[$value['article_reply_id']];
                }
            }
        }
    }
//    新闻搜索页
    public function search(){
        //分类
        $Information_GroupModel = new Information_GroupModel();
        $Information_BaseModel = new Information_BaseModel();
        $cond5['information_group_parent_id'] = 0;
        $Navbar1 = $Navbar = $Information_GroupModel->getByWhere($cond5);
        if (count($Navbar)>5){
            $Navbar1 = array_slice($Navbar,0,5);
            $Navbar2 = array_slice($Navbar,5);
        }

        //热门推荐
        $order4['information_fake_read_count'] = 'desc';
        $cond4['information_state:>'] = 1;

        $page4 = 1;
        $rows4 = 10;
        $cond4['information_status'] = 1;
        $fake_read = $Information_BaseModel->getGroupBaseList($cond4,$order4,$page4,$rows4);
        //小编推荐
        $cond2['information_recommend'] = 1;
        $order2['information_sort'] = 'asc';
        $cond2['information_state:>'] = 1;

        $page2 = 1;
        $rows2 = 6;
        $data_command = $Information_BaseModel->getGroupBaseList($cond2,$order2,$page2,$rows2);
        //搜索
        $search_text = request_string('text');
        $search_text = "%$search_text%";
        $page = request_int('page',1);
        $rows = request_int('rows',10);
        $cond['information_state:>'] = 1;

        $cond['information_title:LIKE'] = $search_text;
        $order['information_add_time'] = 'desc';
        $search_data = $Information_BaseModel->getGroupBaseList($cond,$order,$page,$rows);


            include $this->view->getView();

    }
    public function getSearch(){
        $Information_BaseModel = new Information_BaseModel();
        $search_text = request_string('text');
        $search_text = "%$search_text%";
        $page = request_int('page',2);
        $rows = request_int('rows',8);

        $cond['information_title:LIKE'] = $search_text;
        $cond['information_state:>'] = 1;

        $order['information_add_time'] = 'desc';
        $getsearch = $Information_BaseModel->getGroupBaseList($cond,$order,$page,$rows);
        if ($getsearch)
        {
            $msg    = _('success');
            $status = 200;
        }
        else
        {
            $msg    = _('failure');
            $status = 250;
        }
        $this->data->addBody(-140, $getsearch,$msg,$status);

    }

    /**
     *2018-07-31
     *JiaXL
     *@ return array
     * wap说说导航
     */

    public function infoGroup() {

        $user_id = Perm::$userId;
        if(  $user_id  )
        {
            $data['is_login'] = 1;
        }
        else
        {
            $data['is_login'] = 0;
        }
        $Information_GroupModel         = new Information_GroupModel();
        $group_cond_row ['information_group_parent_id'] = 0;
        $data['info_cat'] = array_values( $Information_GroupModel->getByWhere( $group_cond_row ) );
        if( $this->typ == 'json')
        {
            $this->data->addBody(-140,$data);
        }
    }
    /*
     * wap粉丝圈说说
     * Jiaxl
     * @2018.07.03
     * */
    public function getArticle(){

        $Information_BaseModel          = new Information_BaseModel();
        $Information_LikeModel          = new Information_LikeModel();
        $Information_GroupModel         = new Information_GroupModel();
        $User_FriendModel               = new User_FriendModel();
        $User_InformationFootprintModel = new User_InformationFootprintModel();
        $User_FootprintModel            = new User_FootprintModel();
        $Goods_CommonModel              = new Goods_CommonModel();
        $Goods_BaseModel                = new Goods_BaseModel();
        $page                           = request_string("page",1);
        $rows                           = request_string("rows",5);
        $group                          = request_string("group",'rem');
        $cond_row=array();
        $user_id                    = Perm::$userId;
        //推荐
        if( $group == 'rem' )
        {
            // 1.文章推荐
            $rem_cond_row['information_type']       = $Information_BaseModel::ARTICLE_TYPE_ARTICLE;
            $rem_cond_row['information_status']     = $Information_BaseModel::ARTICLE_STATUS_TRUE;
            $rem_cond_row['information_recommend']  = 1;
            $rem_cond_row['information_add_time:>'] = date("Y-m-d H:i:s",strtotime("-30 days"));//三天之内的文章
            $order_row['information_add_time']      ='DESC';
            $rem_first = $Information_BaseModel->getByWhere( $rem_cond_row,$order_row );

            if( $user_id )
            {
                // 2.文章浏览足迹推荐
                $rem_group_cond_row['user_id']                  = $user_id;
                $rem_group_cond_row['infor_footprint_time:>']   = date("Y-m-d H:i:s",strtotime("-7 days"));//7天之内的浏览足迹
                $rem_group                                      = $User_InformationFootprintModel->getInformationFootprintAll( $rem_group_cond_row );
                $infor_group_id                                 = array_values( array_unique( array_column( $rem_group,"group_id" ) ) );
                //浏览足迹分来下当天发布的所有文章
                $rem_second_cond_row['information_add_time:>']  = date("Y-m-d H:i:s",strtotime("-7 days"));
                $rem_second_cond_row['information_group_id:IN'] = $infor_group_id;
                $rem_second                                     = $Information_BaseModel->getByWhere( $rem_second_cond_row );

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
            }
            else
            {
                $rem_second = array();
                $rem_third = array();
            }
            $rem_second  = $rem_second ? $rem_second : array();
            $rem_third   = $rem_third? $rem_third :array();
            $newArr = $rem_first+$rem_second+$rem_third;
            $data['items']      = array_values( $newArr );
            $data['page']       = 1;
            $data['totalsize']  = 0;

            /*查找用户好友*/

            $friend_cond_row['user_id'] = $user_id;
            $friend_data                = $User_FriendModel->getFriendAll($friend_cond_row);
            $karr                       = array_column($friend_data,"friend_id");
            $friend_data                = array_combine($karr,$friend_data);
            $User_InfoModel             =new User_InfoModel();


            foreach ( $data['items'] as $key=>$val )
            {
                /*过滤标签start*/
                //提取图片src
                $tags_img  = '/<img((?!src).)*src[\s]*=[\s]*[\'"](?<src>[^\'"]*)[\'"]/i';
                preg_match_all( $tags_img, $val['information_desc'] , $out_img );
                $data['items'][$key]['src_img'] = $out_img[2];

                //视频过滤
                $video = strip_tags( $val['information_desc'] ,"<video>");
                $tags_video = '/(src)=([\"|\'])?(.*?)(?(2)\2|\s)/is';
                preg_match_all( $tags_video, $video , $out_video );
                $data['items'][$key]['src_video'] = $out_video[3];

                //文字过滤
                $desc_string                        = strip_tags($val['information_desc']);
                $data['items'][$key]['desc_string'] = $desc_string;
                /*过滤标签end*/


                //是否点赞该文章
                $like_cond_row['user_id'] = $user_id;
                $like_cond_row['information_id'] = $val['information_id'];
                $infor_like = $Information_LikeModel->getOneByWhere( $like_cond_row );
                if( $infor_like )
                {
                    $data['items'][$key]['is_like']   = 1;
                }
                else
                {
                    $data['items'][$key]['is_like']   = 0;
                }
                /*总阅读量*/
                $data['items'][$key]['countRead']   = $val['information_read_count'] + $val['information_fake_read_count'];
                /*获取作者信息,取头像*/
                settype($val['user_id'],"integer");
                $userInfo                           = $User_InfoModel->getOneByWhere(array('user_id'=>$val['user_id']));
                if( !empty( $userInfo ) )
                {
                    $data['items'][$key]['user_info']   = $userInfo;
                }
                /*判断是否关注该作者*/
                if( array_key_exists( $val['user_id'],$friend_data ) )
                {
                    $data['items'][$key]['user_friend_id'] =$friend_data[$val['user_id']]['user_friend_id'];
                    $data['items'][$key]['friend_on']      =1;
                }
                else
                {
                    $data['items'][$key]['friend_on']      =0;
                }
                /*查找共有多少关注*/
                $cond_row_friend['friend_id']              = $val['user_id'];
                $friend_user                               = $User_FriendModel->getCount($cond_row_friend);
                if( $friend_user>10000 )
                {
                    $data['items'][$key]['friend_user']    = '10000+';
                }
                else
                {
                    $data['items'][$key]['friend_user']    = $friend_user;
                }
                /*查作者总文章数*/
                $count_cond_row['information_writer']      = $val['information_writer'];
                $num                                       = $Information_BaseModel->getCount($count_cond_row);
                $data['items'][$key]['countArticle']       = $num;
                /*查文章评论量*/
                $rep_cond_row['article_id']                = $val['information_id'];
                $rep_cond_row['article_reply_parent_id']   = 0;
                $rely_count                                = $this->informationReplyModel->getRowCount($rep_cond_row);
                $data['items'][$key]['conutReply']         = $rely_count;
                /*查文章点赞量*/
                $countLike                                 = $Information_LikeModel->howLike($val['information_id']);
                $data['items'][$key]['countLike']          = $countLike;
                /*查文章来自哪里*/
                $Information_from                          = $Information_GroupModel->getGroup($val['information_group_id']);
                $data['items'][$key]['information_from']   = $Information_from[$val['information_group_id']]['information_group_title'];
            }


        }
        else
        {
            //关注
            if( $group == 'Gz' )
            {
                if( $user_id )
                {
                    $friend_cond_row['user_id'] = $user_id;
                    $user_friend                = $User_FriendModel->getFriendAll( $friend_cond_row );
                    $friend_id                  = array_values( array_column( $user_friend,"friend_id" ) );
                    $cond_row['user_id:IN']     = $friend_id;
                }
            }
            else
            {
                //资讯分类
                $cond_row['information_group_id']   = $group;
            }
            $cond_row['information_type']           = $Information_BaseModel::ARTICLE_TYPE_ARTICLE;
            $cond_row['information_status']         = $Information_BaseModel::ARTICLE_STATUS_TRUE;
            $order_row['information_add_time']      ='DESC';
            $data                                   = $Information_BaseModel->getGroupBaseList($cond_row,$order_row,$page,$rows);

            /*查找用户好友*/

            $friend_cond_row['user_id'] = $user_id;
            $friend_data                = $User_FriendModel->getFriendAll($friend_cond_row);
            $karr                       = array_column($friend_data,"friend_id");
            $friend_data                = array_combine($karr,$friend_data);
            $User_InfoModel             =new User_InfoModel();
            foreach ( $data['items'] as $key=>$val )
            {

                /*过滤标签start*/
                //提取图片src
                $tags_img = '/<img((?!src).)*src[\s]*=[\s]*[\'"](?<src>[^\'"]*)[\'"]/i';
                preg_match_all( $tags_img, $val['information_desc'] , $out_img );
                $data['items'][$key]['src_img'] = $out_img[2];

                //视频过滤
                $video = strip_tags( $val['information_desc'] ,"<video>");
                $tags_video = '/(src)=([\"|\'])?(.*?)(?(2)\2|\s)/is';
                preg_match_all( $tags_video, $video, $out_video );
                $data['items'][$key]['src_video'] = $out_video[3];

                //文字过滤
                $desc_string                        = strip_tags($val['information_desc']);
                $data['items'][$key]['desc_string'] = $desc_string;
                /*过滤标签end*/


                //是否点赞该文章
                $like_cond_row['user_id'] = $user_id;
                $like_cond_row['information_id'] = $val['information_id'];
                $infor_like = $Information_LikeModel->getOneByWhere( $like_cond_row );
                if( $infor_like )
                {
                    $data['items'][$key]['is_like']   = 1;
                }
                else
                {
                    $data['items'][$key]['is_like']   = 0;
                }


                /*总阅读量*/
                $data['items'][$key]['countRead'] = $val['information_read_count'] + $val['information_fake_read_count'];
                /*获取作者信息,取头像*/
                settype($val['user_id'],"integer");
                $userInfo = $User_InfoModel->getOneByWhere(array('user_id'=>$val['user_id']));
                if( !empty( $userInfo) )
                {
                    $data['items'][$key]['user_info'] = $userInfo;
                }
                /*判断是否关注该作者*/
                if(array_key_exists($val['user_id'],$friend_data))
                {
                    $data['items'][$key]['user_friend_id'] =$friend_data[$val['user_id']]['user_friend_id'];
                    $data['items'][$key]['friend_on']      =1;
                }else{
                    $data['items'][$key]['friend_on']      =0;
                }
                /*查找共有多少关注*/
                $cond_row_friend['friend_id']              = $val['user_id'];
                $friend_user                               = $User_FriendModel->getCount($cond_row_friend);
                if($friend_user>10000)
                {
                    $data['items'][$key]['friend_user']    = '10000+';
                }else{
                    $data['items'][$key]['friend_user']    = $friend_user;
                }
                /*查作者总文章数*/
                $count_cond_row['information_writer']      = $val['information_writer'];
                $num                                       = $Information_BaseModel->getCount($count_cond_row);
                $data['items'][$key]['countArticle']       = $num;
                /*查文章评论量*/
                $rep_cond_row['article_id']                = $val['information_id'];
                $rep_cond_row['article_reply_parent_id']   = 0;
                $rely_count                                = $this->informationReplyModel->getRowCount($rep_cond_row);
                $data['items'][$key]['conutReply']         = $rely_count;
                /*查文章点赞量*/
                $countLike                                 = $Information_LikeModel->howLike($val['information_id']);
                $data['items'][$key]['countLike']          = $countLike;
                /*查文章来自哪里*/
                $Information_from                          = $Information_GroupModel->getGroup($val['information_group_id']);
                $data['items'][$key]['information_from']   = $Information_from[$val['information_group_id']]['information_group_title'];
            }


        }

        if($this->typ =='json')
        {
            $this->data->addBody(-140,$data);
        }
    }

    /*
     * wap 说说搜索
     * @Jiaxl
     * 20180704
     * */
    public function wapSearch(){
        //搜索
        $Information_BaseModel          = new Information_BaseModel();
        $Information_LikeModel          = new Information_LikeModel();
        $Information_GroupModel         = new Information_GroupModel();
        $User_InfoModel                 =new User_InfoModel();
        $search_text = request_string('text');
        $search_text = "%$search_text%";
        $page = request_int('page',1);
        $rows = request_int('rows',5);

        $cond['information_title:LIKE'] = $search_text;
        $order['information_add_time'] = 'desc';
        $search_data = $Information_BaseModel->getGroupBaseList($cond,$order,$page,$rows);

        foreach ($search_data['items'] as $key=>$val)
        {


            /*过滤标签start*/
            //提取图片src
            $tags_img='/<img((?!src).)*src[\s]*=[\s]*[\'"](?<src>[^\'"]*)[\'"]/i';
            preg_match_all($tags_img, $val['information_desc'] , $out_img);
            $search_data['items'][$key]['src_img'] = $out_img[2];

            //视频过滤
            $video = strip_tags( $val['information_desc'] ,"<video>");
            $tags_video = '/(src)=([\"|\'])?(.*?)(?(2)\2|\s)/is';
            preg_match_all($tags_video, $video , $out_video);
            $search_data['items'][$key]['src_video'] = $out_video[3];

            //文字过滤

            $desc_string = strip_tags($val['information_desc']);
            $search_data['items'][$key]['desc_string'] = $desc_string;
            /*过滤标签end*/


            //获取作者用户信息
            $user_info                               = $User_InfoModel->getOneByWhere( array('user_id'=>$val['user_id']) );
            if( !empty( $user_info ) )
            {
                $search_data['items'][$key]['user_info'] = $user_info;
            }

            /*总阅读量*/
            $search_data['items'][$key]['countRead'] = $val['information_read_count'] + $val['information_fake_read_count'];
            /*查作者总文章数*/
            $count_cond_row['information_writer']    = $val['information_writer'];
            $num                                     = $Information_BaseModel->getCount($count_cond_row);
            $search_data['items'][$key]['countArticle']     = $num;
            /*查文章评论量*/
            $rep_cond_row['article_id']              = $val['information_id'];
            $rep_cond_row['article_reply_parent_id'] = 0;
            $rely_count                              = $this->informationReplyModel->getRowCount($rep_cond_row);
            $search_data['items'][$key]['conutReply']       = $rely_count;
            /*查文章点赞量*/
            $countLike                               = $Information_LikeModel->howLike($val['information_id']);
            $search_data['items'][$key]['countLike']        = $countLike;
            /*查文章来自哪里*/
            $Information_from                         = $Information_GroupModel->getGroup($val['information_group_id']);
            $search_data['items'][$key]['information_from']  = $Information_from[$val['information_group_id']]['information_group_title'];
        }
        if($this->typ == 'json')
        {
            $this->data->addBody(-140,$search_data);
        }
    }


    /*
     * wap 粉丝用户页面
     * @Jxl
     * 2018.07.19
     * */
    public function fansUserFace() {

        $User_TagRecModel           = new User_TagRecModel();
        $User_TagModel              = new User_TagModel();
        $User_FriendModel           = new User_FriendModel();
        $User_InfoModel             = new User_InfoModel();
        $Information_BaseModel      = new Information_BaseModel() ;
        $Information_GroupModel     = new Information_GroupModel();
        $Information_ReplyModel     = new Information_ReplyModel();
        $Information_LikeModel      = new Information_LikeModel();
        $Goods_BaseModel            = new Goods_BaseModel();
        $Shop_BaseModel             = new Shop_BaseModel();
        $F_uid                      = request_string( "uid" ) ;
        $page                       = request_string( "page" ,1);
        $rows                       = request_string( "rows" ,5);
        $user_id                    = Perm::$userId;
        if( !is_numeric( $F_uid ) )
        {
            $msg    = "无用户信息";
            $state  = 250;
            $this->data->addBody(-140,array(),$msg,$state);
            return false;
        }
        //获取用户兴趣标签
        $tag                            = $User_TagRecModel->getRecList( array( 'user_id'=>$F_uid ) );
        $tagIdArr                       = array_values( array_column( $tag,'user_tag_id' ) );
        $tag_cond_row['user_tag_id:IN'] = $tagIdArr;
        $tagArr                         = $User_TagModel->getByWhere( $tag_cond_row );
        $data['tag']                    = array_values( $tagArr );
        //获取用户店铺信息
        $shop_cond_row['user_id']       = $F_uid;
        $shop_cond_row['shop_status']   = Shop_BaseModel::SHOP_STATUS_OPEN;
        $shopId = $Shop_BaseModel->getShopId( $shop_cond_row );
        if( !empty( $shopId ) )
        {
            $data['is_shop'] = 1;
            $data['shop_id'] = $shopId[0];
        }
        else
        {
            $data['is_shop'] = 0;
        }
        //登录用户是否关注此用户
        $Friend_cond_row['user_id']     = $user_id;
        $friendArr                      = $User_FriendModel->getFriendAll( $Friend_cond_row );
        foreach ( $friendArr as $key=>$val )
        {
            $Arr[$val['friend_id']] = $val;
        }
        if( array_key_exists( $F_uid,$Arr ) )
        {
            $data['is_friend']      = 1;
            $data['user_friend_id'] = $Arr[$F_uid]['user_friend_id'];
        }
        else
        {
            $data['is_friend']      = 0;
            $data['user_friend_id'] = '';
        }
        //查找用户关注量
        $F_cond_row['user_id']      = $F_uid;
        $F_focus                    = $User_FriendModel->getRowCount( $F_cond_row );
        //查找用户粉丝量
        $Fs_cond_row['friend_id']   = $F_uid;
        $Fs_arr                     = $User_FriendModel->getRowCount( $Fs_cond_row );
        $data['focus_cont']         = $F_focus;
        $data['Fs_count']           = $Fs_arr;
        $U_cond_row['user_id']      = $F_uid;
        $User_Info                  = $User_InfoModel->getUserInfo( $U_cond_row );
        $data['user_info']          =$User_Info;
        //用户文章信息
        $I_cond_row['user_id']                  = $F_uid;
        $I_cond_row['information_type']         = $Information_BaseModel::ARTICLE_TYPE_ARTICLE;
        $I_cond_row['information_status']       = $Information_BaseModel::ARTICLE_STATUS_TRUE;
        $I_order_row['information_add_time']    = 'DESC';
        $infoMationData                         = $Information_BaseModel->getGroupBaseList( $I_cond_row,$I_order_row,$page,$rows );
        $data['information_totalsize'] = $infoMationData['totalsize'];
        foreach ( $infoMationData['items'] as $key => $val )
        {
            //去除不带图片的新闻
            if( empty( $val['information_pic'] ) )
            {
                unset( $infoMationData['items'][$key] );
            }
            else
            {
                //获取推荐商品图片
                foreach ( $val['information_goods_recommend'] as $k=>$v)
                {
                    $goods_cond_row['goods_id'] = $v[0];
                    $goodsInfo = $Goods_BaseModel->getByWhere($goods_cond_row);
                    $val['information_goods_recommend'][$k][] = $goodsInfo[$v[0]]['goods_image'];
                    $infoMationData['items'][$key]['information_goods_recommend'][$k] =  $val['information_goods_recommend'][$k];
                }
                //是否已经点赞
                $is_like = $Information_LikeModel->isLikeInfo($user_id,$val['information_id']);
                $infoMationData['items'][$key]['is_like'] = $is_like;
                $G_cond_row['information_group_id']                 = $val['information_group_id'];
                $informationFrom                                    = $Information_GroupModel->getByWhere( $G_cond_row );
                $infoMationData['items'][$key]['information_from']  = $informationFrom[$val['information_group_id']]['information_group_title'];
                //获取文章评论量
                $R_cond_row['article_id']                           = $val['information_id'];
                $R_cond_row['article_reply_parent_id']              = 0;
                $countReply                                         = $Information_ReplyModel->getRowCount( $R_cond_row );
                //文章点赞量
                $L_cond_row['information_id']                       = $val['information_id'];
                $countLike                                          = $Information_LikeModel->getRowCount( $L_cond_row );
                $infoMationData['items'][$key]['countReply']        = $countReply;
                $infoMationData['items'][$key]['countLike']         = $countLike;

                /*过滤标签start*/
                //提取图片src
                $tags_img  = '/<img((?!src).)*src[\s]*=[\s]*[\'"](?<src>[^\'"]*)[\'"]/i';
                preg_match_all( $tags_img, $val['information_desc'] , $out_img );
                $infoMationData['items'][$key]['src_img'] = $out_img[2];

                //视频过滤
                $video = strip_tags( $val['information_desc'] ,"<video>");
                $tags_video = '/(src)=([\"|\'])?(.*?)(?(2)\2|\s)/is';
                preg_match_all( $tags_video, $video , $out_video );
                $infoMationData['items'][$key]['src_video'] = $out_video[3];
                if( count($out_video[3]) >0 )
                {
                    $infoMationData['items'][$key]['has_video'] = 1;
                }
                else
                {
                    $infoMationData['items'][$key]['has_video'] = 0;
                }
                //文字过滤
                $desc_string                        = strip_tags($val['information_desc']);
                $infoMationData['items'][$key]['desc_string'] = $desc_string;
                /*过滤标签end*/


                $infoMationData['items'][$key]['information_read_count'] = $infoMationData['items'][$key]['information_read_count']+$infoMationData['items'][$key]['information_fake_read_count'];
            }
        }
        $data['information']                    = array_values( $infoMationData['items'] );
        //发表文章总数
        $countArticle                           = $Information_BaseModel->getRowCount( $I_cond_row );
        $data['countArticle']                   = $countArticle;
        $data['page']                           = $page;
        if( $this->typ == 'json' )
        {
            $this->data->addBody(-140,$data);
        }

    }

    /**
     *2018/08/20 JiaXL
     *@param $user_id  用户id
     *@param $information_id  分享文章id
     *@return array()返回分享加金蛋结果
     * @access public
     */
    public function share_point()
    {
        $user_id                = Perm::$userId;
        $information_id         = request_int("information_id");
        $PointsLogModel         = new Points_LogModel();
        $UserInfoModel          = new User_InfoModel();
        $Information_BaseModel  = new Information_BaseModel();
        if( $user_id && $information_id )
        {
            $user_cond_row['user_id'] = $user_id;
            $user_info = $UserInfoModel->getUserInfo( $user_cond_row );
            if( $user_info )
            {
                //转发者加金蛋
                $forward_point = $PointsLogModel->addPointsLog($user_id,$user_info['user_name'],Points_LogModel::FORWARD);
                $data['forward_point'] = $forward_point;
            }
            $info_cond_row['information_id'] = $information_id;
            $infoBase    = $Information_BaseModel->getOneByWhere( $info_cond_row );
            $writer_info = $UserInfoModel->getUserInfo( array( 'user_id'=>$infoBase['user_id'] ) );
            if( $writer_info )
            {
                //被转发者加金蛋
                $writer_point = $PointsLogModel->addPointsLog( $infoBase['information_writer'],$writer_info['user_name'],Points_LogModel::BE_FORWARDED);//作者
                $data['writer_point'] = $writer_point;
            }
            $msg    = _("success");
            $status = 200;

        }
        else
        {
            $msg    = _("fail");
            $status = 250;
        }
        if( $this->typ == 'json' )
        {
            $this->data->addBody( -140, $data, $msg, $status );
        }
    }







}

?>
