<?php
/*
*
*极光推送
*
*/  
       class JpushCtl extends YLB_AppController
        {
        public function Push(){
        require_once "Jpush/JPush.php";
        $user_id = Perm::$row['user_id'];
        $user_account=Perm::$row['user_account'];
        $userInfo=new User_InfoModel();
        $data=$userInfo->getInfo($user_account);
        if($data[$user_account]['nickname']){
            $nickname=$data[$user_account]['nickname'];
        }else{
            $nickname=$user_account;
        }
        // var_dump($user_account);die;
        $fname=request_string('user_account');
        $user_Base=new User_BaseModel();
        $friend_id=$user_Base->getUserIdByAccount($fname);
        $friend_id=$friend_id[0];
        $app_key = 'c045b2a99d4d6a6e6b1535e4';
        $master_secret = 'f6ecda2b55a50532faacdea2';
        // 初始化
        $alert="用户".$nickname."请求加你为好友";
        $client = new JPush($app_key, $master_secret);
                //插入操作之前判断用户是否在你的添加好友的列表里面 如果在的话 就不往数据库插入了不在的话插入数据库
            $user_Push=new User_PushModel();
            $flag=$user_Push->checkUser($user_id,$friend_id);
            if($flag){
                $field=array('user_id'=>$user_id,
                                'fuid'=>$friend_id,
                           'user_name'=>$user_account,
                              'funame'=>$fname,
                             'addtime'=>time());
                 $user_Push->addPush($field);
                 $type=array();
                 $type=array('type'=>'1');
                $result=$client->push()
                ->setPlatform(array('ios', 'android'))
                ->addAlias($friend_id)
                ->addIosNotification($alert,'', null, null, null, $type)
                ->addAndroidNotification($alert,null,null,$type)
                ->setOptions(100000, 3600, null, false)
                ->send();
                // var_dump($result);die;
                 $status=200;
                 $data['flag']='1';//1加好友 2新闻
                $msg='添加好友成功';
            }else{
                $status=250;
                $msg='已发送过好友请求';
            }
        $this->data->addBody(-140, $data, $msg, $status);
        }
        //根据用户id获取用户所以收到的好友申请
        public function getFriendList(){
            $user_id=Perm::$row['user_id'];

            $user_push=new User_PushModel();
            $data=$user_push->getFriendList($user_id);

            if($data){
            foreach($data as $key=>$val){
                $user_account=$val['user_name'];
                $data[$key]['user_account']=$data[$key]['user_name'];
                $data[$key]['push_id']=$data[$key]['id'];
                $userInfo=new User_InfoModel();
                $dataInfo=$userInfo->getInfo($user_account);
                 if(!$dataInfo[$user_account]['user_avatar']){
                        $data[$key]['img']='';
                    }else{
                         $data[$key]['img']=$dataInfo[$user_account]['user_avatar'];
                    }      
                if($dataInfo[$user_account]['nickname']){
                    $data[$key]['user_name']=$dataInfo[$user_account]['nickname']; 
                    }
                }
            }
            $data=array_values($data);
            // var_dump($data);die;  
            if($data){
                $status=200;
                $msg='success';
            }else{
                $data=array();
                $status=250;
                $msg='暂无好友添加信息';
            }
            $this->data->addBody(-140, $data, $msg, $status);

        }

       public function countAddFriend()
       {
           $user_id=Perm::$row['user_id'];
           $status = 0;
           $user_push=new User_PushModel();
           $data=$user_push->countFriend($user_id,$status);

           $count = count($data);

           $array['count'] = $count;
           $this->data->addBody(-140, $array);
       }
    }

?>