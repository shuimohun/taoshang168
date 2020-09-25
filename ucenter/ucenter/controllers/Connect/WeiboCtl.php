<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * Api接口
 *
 *
 * @category   Game
 * @package    User
 * @author     WenQingTeng
 * @copyright  Copyright (c) 2017, 温庆腾
 * @version    1.0
 * @todo
 */
class Connect_WeiboCtl extends YLB_AppController implements Connect_Interface
{
	public $appid     = null;
	public $appsecret = null;
	public $redirect_url = null;

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

		$connect_config = YLB_Registry::get('connect_rows');;

		$this->appid     = $connect_config['weibo']['app_id'];
		$this->appsecret = $connect_config['weibo']['app_key'];

		$this->redirect_url = sprintf('%s?ctl=Connect_Weibo&met=callback&from=%s&callback=%s', YLB_Registry::get('url'),request_string('from'), urlencode(request_string('callback')));
	}

	public function select()
	{
		include $this->view->getView();
	}

	public function login()
	{
	    ////如果是送福免单注册 可直接跳转到注册页 第一步
        /*if (request_string('fu',0) == 1)
            setcookie('fu',1);*/

        $url = "https://api.weibo.com/oauth2/authorize?client_id=".$this->appid."&redirect_uri=".urlencode($this->redirect_url);
        location_to($url);
	}

	/**
	 * callback 回调函数
	 *
	 * @access public
	 */
	public function callback()
	{
		$code = request_string('code', null);
		$redirect_url = $this->redirect_url;

		if ($code)
		{
			//登录
			$token_url = 'https://api.weibo.com/oauth2/access_token?grant_type=authorization_code&client_id=' . $this->appid . '&client_secret=' . $this->appsecret . '&code=' . $code . '&redirect_uri='.urlencode($redirect_url);
			
			$curl = curl_init($token_url);
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_FAILONERROR, false);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			$response = curl_exec($curl);
			curl_close($curl);
			
			$error = strpos($response, 'error');


			if($error)
			{
				$error_info = json_decode($response);
						
				$error_code = $error_info->error_code;
						
				$error_description = $error_info->error_description;

				$this->data->addBody($error_description);
				die();
			}
			else
			{
				$token = json_decode($response);
				$access_token = $token->access_token;
				$expires_in = $token->expires_in;
				$remind_in = $token->remind_in;
				$uid = $token->uid;
	
				$this->bind($access_token,$uid);
			}
		}
		else
		{
			$this->data->setError('code 获取失败');

		}
	}

    //app调用 第三方登录 Zhenzh
    public function appBindConnect()
    {
        $access_token = request_string('access_token');
        $uid = request_string('uid');

        if(!$access_token || !$uid)
        {
            echo 'access_token获取失败';die;
        }
        else
        {
            $this->bind($access_token,$uid);
        }
    }

    public function bind($access_token,$uid)
	{
        $type = User_BindConnectModel::SINA_WEIBO;
        $login_flag = false;
        //判断当前登录账户
        if (Perm::checkUserPerm())
        {
            $user_id = Perm::$userId;
        }
        else
        {
            $user_id = 0;
        }

		//获取用户信息
        $user_openid_url = 'https://api.weibo.com/2/users/show.json?access_token='.$access_token.'&uid='.$uid;
        $curl = curl_init($user_openid_url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $user_info = curl_exec($curl);

        curl_close($curl);

        $connect_rows = array();
        $User_BindConnectModel = new User_BindConnectModel();
        $bind_id     = sprintf('%s_%s', 'wb', $uid);
        $connect_rows = $User_BindConnectModel->getBindConnect($bind_id);

        if ($connect_rows)
        {
            $connect_row = array_pop($connect_rows);
        }
        //已经绑定,并且用户正确
        if (isset($connect_row['user_id']) && $connect_row['user_id'])
        {
            //验证通过, 登录成功.
            if ($user_id && $user_id == $connect_row['user_id'])
            {
                echo '非法请求,已经登录用户不应该访问到此页面';
                die();
            }

            $login_flag = true;
        }
        else
        {
            // 下面可以需要封装
            $bind_rows     = $User_BindConnectModel->getBindConnect($bind_id);

            if ($bind_rows  && $bind_row = array_pop($bind_rows))
            {
                if ($bind_row['user_id'])
                {
                    //该账号已经绑定
                    echo '非法请求,该账号已经绑定';
                    die();
                }
                if($user_id != 0)
                {
                    $bind_id_row = $User_BindConnectModel->getBindConnectByuserid($user_id,$type);
                    if($bind_id_row)
                    {
                        echo '非法请求,该账号已经绑定';
                        die();
                    }
                }

                $data_row                      = array();
                $data_row['user_id']           = $user_id;
                $data_row['bind_token'] = $access_token;

                $connect_flag = true;
                $User_BindConnectModel->editBindConnect($bind_id, $data_row);
            }
            else
            {
                if($user_id != 0)
                {
                    $bind_id_row = $User_BindConnectModel->getBindConnectByuserid($user_id,$type);
                    if($bind_id_row)
                    {
                        echo '非法请求,该账号已经绑定';
                        die();
                    }
                }

                $user_info = json_decode($user_info);
                //插入绑定表
                if($user_info->gender == 'f')
                {
                    $user_gender = 2;
                }else
                {
                    $user_gender = 1;
                }

                $bind_array = array();

                $bind_array = array(
                    'bind_id'=>$bind_id,
                    'bind_type'=>$User_BindConnectModel::SINA_WEIBO,
                    'user_id'=>$user_id,
                    'bind_nickname'=>$user_info->screen_name,
                    'bind_avator'=>$user_info->avatar_large,
                    'bind_gender'=>$user_gender,
                    'bind_openid'=>$uid,
                    'bind_token'=>$access_token,
                );

                $connect_flag = $User_BindConnectModel->addBindConnect($bind_array);
            }

            //取得open id, 需要封装
            if ($connect_flag)
            {
                //选择,登录绑定还是新创建账号 $user_id == 0
                if (!Perm::checkUserPerm())
                {
                    if($this->typ == 'json')
                    {
                        $data['type'] = $type;
                        $data['access_token'] = $access_token;
                        $data['result'] = 0;
                        $this->data->addBody(-140,$data,'success',200);
                    }
                    else
                    {
                        ////如果是送福免单注册 可直接跳转到注册页 第二步
                        /*if ($_COOKIE['fu'] == 1)
                        {
                            $url = sprintf('%s?ctl=Login&act=reg&t=%s&type=%s&from=%s&callback=%s', YLB_Registry::get('url'), $access_token,$type, request_string('from'), urlencode(request_string('callback')));
                            setcookie("fu", null, time() - 3600 * 24 * 365);
                            setcookie("fu", null, time() - 3600 * 24 * 365,'/');
                        }
                        else
                        {
                            $url = sprintf('%s?ctl=Login&met=select&t=%s&type=%s&from=%s&callback=%s', YLB_Registry::get('url'), $access_token,$type, request_string('from'), urlencode(request_string('callback')));
                        }*/

                        $url = sprintf('%s?ctl=Login&met=select&t=%s&type=%s&from=%s&callback=%s', YLB_Registry::get('url'), $access_token,$type, request_string('from'), urlencode(request_string('callback')));
                        location_to($url);
                    }
                }
                else
                {
                    $login_flag = true;
                }
            }
            else
            {
                //
            }
        }

        if ($login_flag)
        {
            //验证通过, 登录成功.
            if ($user_id && $user_id == $connect_row['user_id'])
            {
                echo '非法请求,已经登录用户不应该访问到此页面';
                die();
            }
            else
            {
                $User_InfoModel  = new User_InfoModel();
                $result = $User_InfoModel->userlogin($connect_row['user_id']);

                if($result)
                {
                    $msg    = 'success';
                    $status = 200;

                    $this->data->addBody(-140, $result, $msg, $status);
                }
                else
                {
                    $this->data->addBody('登录失败');
                }
            }

            if($this->typ != 'json')
            {
                if(request_string('callback'))
                {
                    $us = $result['user_id'];
                    $ks = $result['k'];
                    $url = sprintf('%s&us=%s&ks=%s', request_string('callback'), $us, $ks);
                    location_to($url);

                }
                else
                {
                    $url = sprintf('%s?ctl=Login', YLB_Registry::get('url'));
                    location_to($url);
                }
                echo '登录系统';
                die();
            }

        }
        else
        {
            //失败
        }
	}

}

?>
