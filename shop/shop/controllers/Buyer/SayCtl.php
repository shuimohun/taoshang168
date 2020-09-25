<?php
header('Access-Control-Allow-Origin:*');
if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Buyer_SayCtl extends Buyer_Controller
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
	}

	//说说
	public function index()
    {
        $InformationModel       = new Information_BaseModel();
        $Information_GroupModel = new Information_GroupModel();
        $GoodsBaseModel         = new Goods_BaseModel();
        $Information_LikeModel  = new Information_LikeModel();
        $Information_ReplyModel = new Information_ReplyModel();

        if( Perm::$userId )
        {
            //文章列表
            $cond['information_writer']     = Perm::$userId ;
            $cond['information_status']     = Information_BaseModel::ARTICLE_STATUS_TRUE;
//            $cond['information_state']      = Information_BaseModel::AUDITED;  //现在审核还没打开 以后打开需要用到
            $order['information_add_time']  = 'desc';
            $page                           = request_int( 'page',1 );
            $rows                           = request_int( 'rows',10 );
            //一开始我是取五条的,直到产品经理说五条太少了,看一下就没了  取十条!
            $data                           = $InformationModel->getBaseAllList( $cond, $order, $page, $rows );
            foreach ( $data['items'] as $key => $value )
            {
                $information_group                              = $Information_GroupModel->getOne( $value['information_group_id'] );
                $data['items'][$key]['information_group_title'] = $information_group['information_group_title'];
                if( !empty( $data['items'][$key]['information_goods_recommend'] ) )
                {
                    $data['items'][$key]['goods']       = array();
                    $data['items'][$key]['howlike']     = $Information_LikeModel->howLike( $value['information_id'] );
                    foreach ( $data['items'][$key]['information_goods_recommend'] as $k => $v )
                    {
                        $goods  = $GoodsBaseModel->getOne( $v[0] );
                        array_push( $data['items'][$key]['goods'],$goods );
                        $data['items'][$key]['goods'][$k]['information_goods_price'] = $v[1];
                    }
                }
                $preg = "/(href|src|url)(=|\()([\"|']?)([^\"'>|\)]+.(jpg|JPG|jpeg|JPEG|gif|GIF|png|PNG))/i";
                preg_match_all( $preg,$data['items'][$key]['information_desc'],$match );
                $data['items'][$key]['information_desc_img'] = $match[4];
                $article_id                 = $value['information_id'];
                $replaySql                  = "select COUNT(*) from ylb_information_reply WHERE  article_id = ".$article_id;
                $information_reply_count    = $Information_ReplyModel->sql( $replaySql );
                $data['items'][$key]['information_reply_count'] = $information_reply_count[0]['COUNT(*)'];
            }

            $YLB_Page             = new YLB_Page();
            $YLB_Page->nowPage    = $page;
            $YLB_Page->listRows   = $rows;
            $YLB_Page->totalPages = $data['total'];
            $page_nav             = $YLB_Page->promptII();
            $data['page_nav']     = $page_nav;
            //头部
            $User_FriendModel           = new User_FriendModel();
            $UserInfoModel              = new User_InfoModel();
            $User_Info                  = $UserInfoModel->getOne( Perm::$userId );
            $data['user_name']          = $User_Info['user_name'];
            $data['user_image']         = $User_Info['user_logo'];

            $cond_friend['user_id']     = Perm::$userId;
            $data['friend']             = $User_FriendModel->getCount( $cond_friend );
            $msg    = _("success");
            $status = 200;

        }
        else
        {
            $msg    = _("未登录");
            $status = 250;
        }
        if($this->typ == 'json')
        {
            $this->data->addBody( -140, $data, $msg, $status );
        }
        else
        {
            include $this->view->getView();
        }
     }

    //发帖
    public function post()
    {
        $InformationGroupModel = new Information_GroupModel();
        $DirectsellerShopModel = new Distribution_ShopDirectsellerModel();
        $group                 = $InformationGroupModel->getGroupList();
        $userId = Perm::$userId;
        if( $userId )
        {
            $cond['directseller_id'] = $userId;
            $cond['directseller_enable'] = 1;
            $ifdirectseller = $DirectsellerShopModel->getOneByWhere($cond);
            //头部
            $User_FriendModel       = new User_FriendModel();
            $UserInfoModel          = new User_InfoModel();
            $Information_BaseModel  = new Information_BaseModel();
            $GoodsBaseModel         = new Goods_BaseModel();
            new Goods_BaseModel();
            $information_id = request_int("information_id");
            if( $information_id )
            {
                $information_info = $Information_BaseModel->getOneByWhere( array( 'information_id'=>$information_id ) );
                $information_info['information_goods_recommend'] = array_filter( $information_info['information_goods_recommend'] );

                foreach ( $information_info['information_goods_recommend'] as $k => $v )
                {
                    $goods  = $GoodsBaseModel->getOne( $v[0] );
                    $information_info['information_goods_recommend'][$k]['goods_info'] = $goods;
                }
                $data['information_info'] = $information_info;
            }
            $cond_count['information_writer']   = $userId;
            $data['information_count']          = $Information_BaseModel->getCount($cond_count);

            $User_Info              = $UserInfoModel->getOne($userId);
            $data['user_name']      = $User_Info['user_name'];
            $data['user_image']     = $User_Info['user_logo'];
            $data['user_info']      = $User_Info;
            $cond_friend['user_id'] = $userId;
            $data['friend']         = $User_FriendModel->getCount($cond_friend);
            $data['user_info']['punish_end_time'] = date('Y-m-d h:i:s',$User_Info['user_punish_end_time']);
            $msg    = _("success");
            $status = 200;
//            echo "<pre>";
//            print_r( $data );
//            die;
        }
        else
        {
            $msg    = _("未登录");
            $status = 250;
        }

        if($this->typ == 'json')
        {
            $this->data->addBody( -140, $data, $msg ,$status );
        }
        else
        {
            include $this->view->getView();
        }
    }

    public function postJson()
    {
        $data = [];
        if (Perm::$userId)
        {
            $UserInfoModel = new User_InfoModel();
            $user_info = $UserInfoModel->getOne(Perm::$userId);

            if ($user_info['user_punish_type'] == 0)
            {
                $data['user_punish'] = '0';
                $nav = [];
                if (Perm::$shopId)
                {
                    $nav[] = ['id'=>'7','title'=>'店铺'];
                }

                $directShopModel = new Distribution_ShopDirectsellerModel();
                $cond['directseller_id'] = Perm::$userId;
                $cond['directseller_enable'] = 1;
                $direct_shop_count = $directShopModel->getRowCount($cond);
                if ($direct_shop_count)
                {
                    $nav[] = ['id'=>'6','title'=>'淘金'];
                }

                $data['nav'] = array_merge($nav,[
                    ['id'=>'0','title'=>'新人'],
                    ['id'=>'1','title'=>'惠抢购'],
                    ['id'=>'2','title'=>'劲爆折扣'],
                    ['id'=>'3','title'=>'送福'],
                    ['id'=>'4','title'=>'优惠套餐'],
                    ['id'=>'5','title'=>'商品']
                ]);

                $InformationGroupModel = new Information_GroupModel();
                $group = $InformationGroupModel->getGroupList();
                $data['group'] = $group['items'];
            }
            else
            {
                $data['user_punish'] = '1';

                if ($user_info['user_punish_type'] == 1)
                {
                    $data['user_punish_con'] = '您已被禁言至<br>' . date('Y-m-d H:i:s',$user_info['user_punish_end_time']);
                }
                else if ($user_info['user_punish_type'] == 2)
                {
                    $data['user_punish_con'] = '您已被封号至<br>';
                    if ($user_info['user_punish_times'] == 4 || $user_info['user_punish_end_time'] == 0)
                    {
                        $data['user_punish_con'] .= '永久';
                    }
                    else
                    {
                        $data['user_punish_con'] .= date('Y-m-d H:i:s',$user_info['user_punish_end_time']);
                    }
                }
            }
        }

        $this->data->addBody(-140,$data);
    }

    //我的关注
    public function follow()
    {
        //头部
        $User_FriendModel       = new User_FriendModel();
        $UserInfoModel          = new User_InfoModel();
        $GoodsBaseModel         = new Goods_BaseModel();
        $Information_GroupModel = new Information_GroupModel();
        $Information_LikeModel  = new Information_LikeModel();
        $Information_ReplyModel = new Information_ReplyModel();
        $Information_BaseModel  = new Information_BaseModel();
        $page = request_int('page',1);
        //一开始我是取五条的,直到产品经理说五条太少了,看一下就没了  取十条!
        $rows       = request_int('rows',10);
        $rows_l     = ($page-1)*$rows;
        $rows_r     = $page*$rows;
        $sql_row    = "$rows_l,$rows_r";
        $User_Info  = $UserInfoModel->getOne( Perm::$userId );

        $data['user_name']                  = $User_Info['user_name'];
        $data['user_image']                 = $User_Info['user_logo'];
        $cond_count['information_writer']   = Perm::$userId;
        $data['information_count']          = $Information_BaseModel->getCount($cond_count);
        $cond_friend['user_id']             = Perm::$userId;
        $friend = $User_FriendModel->getByWhere($cond_friend);

        $data['friend'] = count($friend);
        //获取关注的人列表后进行查询
        $friend_id = array_unique( array_column( $friend,"friend_id" ) );
        $base_cond_row['user_id:IN']            = $friend_id;
        $base_cond_row['information_status']    = Information_BaseModel::ARTICLE_STATUS_TRUE;
        $base_cond_row['information_type']      = Information_BaseModel::ARTICLE_TYPE_ARTICLE;
        $base_order_row['information_add_time'] = "DESC";

        $infoBase= $Information_BaseModel->getBaseAllList( $base_cond_row,$base_order_row,$page,$rows);
        $data['items']      = $infoBase['items'];
        $data['totalsize']  = $infoBase['totalsize'];
        $data['page']       = $infoBase['page'];
        $data['total']      = $infoBase['total'];

        //当前用户点赞文章
        $like_cond_row['user_id'] = Perm::$userId;
        $user_like      = $Information_LikeModel->getByWhere( $like_cond_row );
        $info_id_arr    = array_column( $user_like,"information_id" );
        $user_like_new  = array_combine( $info_id_arr, $user_like );

        //添加用户头像名称商品和价格
        foreach ($data['items'] as $key => $value)
        {

            if( array_key_exists( $value['information_id'],$user_like_new  ) )
            {
                $data['items'][$key]['is_like'] = 1;
            }
            else
            {
                $data['items'][$key]['is_like'] = 0;
            }
            $User_Info = $UserInfoModel->getOne($value['information_writer']);
            $data['items'][$key]['user_name']   = $User_Info['user_name'];
            $data['items'][$key]['user_image']  = $User_Info['user_logo'];
            $cond_write_friend['friend_id']           = $value['information_writer'];
            $friend = $User_FriendModel->getFriendAll( $cond_write_friend);
            $data['items'][$key]['friend']                      = count($friend);
            $data['items'][$key]['information_goods_recommend'] = $value['information_goods_recommend'];

            $information_group = $Information_GroupModel->getOne($value['information_group_id']);
            $data['items'][$key]['information_group_title']     = $information_group['information_group_title'];
            $data['items'][$key]['goods'] = array();
            $data['items'][$key]['howlike'] = $Information_LikeModel->howLike($value['information_id']);
            if(!empty($data['items'][$key]['information_goods_recommend']))
            {

                foreach ($data['items'][$key]['information_goods_recommend'] as $k => $v){
                    $goods = $GoodsBaseModel->getOne($v[0]);
                    array_push($data['items'][$key]['goods'],$goods);
                    $data['items'][$key]['goods'][$k]['information_goods_price'] = $v[1];
                }
            }

            //提取desc内img
            $preg = "/(href|src|url)(=|\()([\"|']?)([^\"'>|\)]+.(jpg|JPG|jpeg|JPEG|gif|GIF|png|PNG))/i";
            preg_match_all($preg,$data['items'][$key]['information_desc'],$match);
            $data['items'][$key]['information_desc_img'] = $match;

            //回复数量
            $article_id                 = $value['information_id'];
            $replaySql                  = "select COUNT(*) from ylb_information_reply WHERE  article_id = ".$article_id;
            $information_reply_count    = $Information_ReplyModel->sql($replaySql);
            $data['items'][$key]['information_reply_count'] = $information_reply_count[0]['COUNT(*)'];
        }

        $YLB_Page             = new YLB_Page();
        $YLB_Page->nowPage    = $page;
        $YLB_Page->listRows   = $rows;
        $YLB_Page->totalPages = $data['total'];
        $page_nav             = $YLB_Page->promptII();
        $data['page_nav']     = $page_nav;

        if($this->typ == 'json')
        {
            $this->data->addBody(-140,$data);
        }
        else
        {
            include $this->view->getView();
        }
    }

    //交易评价
    public function evaluation()
    {
        include $this->view->getView();
    }

}

?>