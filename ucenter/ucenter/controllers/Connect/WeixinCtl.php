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
class Connect_WeixinCtl extends YLB_AppController implements Connect_Interface
{
	public $appid     = null;
	public $appsecret = null;

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

        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false)
        {
            $this->appid = 'wx7c9bd0e5a3b798c3';
            $this->appsecret = '420fe679653100b366150f70a5afdb3c';
        }
        else
        {
            $connect_config = YLB_Registry::get('connect_rows');;
            $this->appid     = $connect_config['weixin']['app_id'];
            $this->appsecret = $connect_config['weixin']['app_key'];
        }

		$this->redirect_url = sprintf('%s?ctl=Connect_Weixin&met=callback&from=%s&callback=%s',YLB_Registry::get('url') , request_string('from'), urlencode(request_string('callback')));
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

		//判断当前登录账户,绑定

		//子站跳转
		$redirect_url = urlencode($this->redirect_url);

		//网上的备份
        //$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$this->appid&redirect_uri=$redirect_url&response_type=code&scope=snsapi_login&state=#wechat_redirect";
        //官网api备份
		//$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$this->appid&redirect_uri=$redirect_url&response_type=code&scope=SCOPE&state=STATE#wechat_redirect";

        /*if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false)
		{
			//微信内部浏览器
			$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$this->appid&redirect_uri=$redirect_url&response_type=code&scope=snsapi_login&state=123&connect_redirect=1#wechat_redirect";
        }
		else
		{
			$url = "https://open.weixin.qq.com/connect/qrconnect?appid=$this->appid&redirect_uri=$redirect_url&response_type=code&scope=snsapi_login&state=STATE#wechat_redirect";
		}*/


        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false)
        {

            //微信内部浏览器
            //$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$this->appid&redirect_uri=$redirect_url&response_type=code&scope=snsapi_login&state=123&connect_redirect=1#wechat_redirect";

            //公众号登录
            //scope=snsapi_userinfo 需要授权 等待用户确认授权才可获取用户信息。如果要拉取用户详细信息的接口（头像，性别，城市等），必须以此种方式发起页面授权。
            //scope=snsapi_base  静默授权并自动跳转到回调页的。不能获取用户信息，只能获取进入页面的用户的openid
            $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$this->appid&redirect_uri=$redirect_url&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
        }
        else
        {
            $url = "https://open.weixin.qq.com/connect/qrconnect?appid=$this->appid&redirect_uri=$redirect_url&response_type=code&scope=snsapi_login&state=STATE#wechat_redirect";
        }

        //京东的
        //$url = "https://open.weixin.qq.com/sns/explorer_broker?appid=$this->appid&redirect_uri=$redirect_url&response_type=code&scope=snsapi_userinfo&state=mcrrfohd&connect_redirect=1#wechat_redirect";
        //$url = "https://open.weixin.qq.com/sns/explorer_broker?appid=$this->appid&redirect_uri=$redirect_url&response_type=code&scope=snsapi_userinfo&state=gbaca7wz&connect_redirect=1#wechat_redirect";
		location_to($url);
	}

	/**
	 * callback 回调函数
	 *
	 * @access public
	 */
	public function callback()
	{
		$type = User_BindConnectModel::WEIXIN;

		$code = request_string('code', null);

		$redirect_url = $this->redirect_url;

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

		if ($code)
		{
			$token_url        = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $this->appid . '&secret=' . $this->appsecret . '&code=' . $code . '&grant_type=authorization_code';
			$access_token_row = json_decode(file_get_contents($token_url), true);

			if (!$access_token_row || !empty($access_token_row['errcode']))
			{
				throw new YLB_ProtocalException($access_token_row['errmsg']);
				return false;
			}
			else
			{
				$user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $access_token_row['access_token'] . '&openid=' . $access_token_row['openid'] . '&lang=zh_CN';
				$user_info_row = json_decode(@file_get_contents($user_info_url), true);

				$User_BindConnectModel = new User_BindConnectModel();

                //app端和pc用的不是同一个应用 改用unionid
                //$bind_id     = sprintf('%s_%s', 'weixin', $user_info_row['openid']);
                $bind_id     = sprintf('%s_%s', 'weixin', $user_info_row['unionid']);
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
					else
					{
					}

					$login_flag = true;
				}
				else
				{
					$bind_avator = $user_info_row['headimgurl'];

					// 下面可以需要封装
					$access_token = $access_token_row['access_token'];
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

						$connect_flag = $User_BindConnectModel->editBindConnect($bind_id, $data_row);
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
						$data = array();

						$data['bind_id']           = $bind_id;
						$data['bind_type']         = $User_BindConnectModel::WEIXIN;
						$data['user_id']           = $user_id;
						$data['bind_nickname']     = $user_info_row['nickname']; // 名称
						$data['bind_avator']       = $bind_avator; //
						$data['bind_gender']       = $user_info_row['sex']; // 性别 1:男  2:女
						$data['bind_openid']       = $user_info_row['unionid']; // 访问
						$data['bind_token']        = $access_token;

						$connect_flag = $User_BindConnectModel->addBindConnect($data);
					}
					
					//取得open id, 需要封装
					if ($connect_flag)
					{
						//选择,登录绑定还是新创建账号 $user_id == 0
						if (!Perm::checkUserPerm())
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
							$url = sprintf('%s?ctl=Login&met=select&t=%s&type=%s&from=%s&callback=%s', YLB_Registry::get('url'), $access_token, $type, request_string('from'), urlencode(request_string('callback')));
							location_to($url);
						}
						else
						{
							$login_flag = true;
						}
					}
				}
			}

			if ($access_token_row)
			{

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
					$user_info_row   = $User_InfoModel->getOne($connect_row['user_id']);

					if ($user_info_row)
					{
						$data            = array();
						$data['user_id'] = $user_info_row['user_id'];

						$encrypt_str = Perm::encryptUserInfo($data, $user_info_row['session_id']);

						$data['user_name'] = $user_info_row['user_name'];
                        $data['k'] = $encrypt_str;
						$this->data->addBody(100, $data);
					}
					else
					{
						$this->data->setError('登录失败');
					}

				}

				$login_flag = true;


				if(request_string('callback'))
				{
					$us = $data['user_id'];
					$ks = $data['k'];
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
			else
			{
				//失败
			}

		}
		else
		{
			//失败

		}
	}


	//app调用 第三方登录 Zhenzh
	public function appBindConnect()
	{
		$open_id = request_string('open_id');
        $access_token = request_string('access_token');

        if(!$open_id || !$access_token)
		{
			die();
		}

        $type = User_BindConnectModel::WEIXIN;

        if (Perm::checkUserPerm())
        {
            $user_id = Perm::$userId;
        }
        else
        {
            $user_id = 0;
        }


        $user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $access_token . '&openid=' . $open_id . '&lang=zh_CN';
        $user_info_row = json_decode(@file_get_contents($user_info_url), true);

		/*Array
			(
				[openid] => oGTPOwfG-kWBp5_25GVzlURvDJ00
				[nickname] => 子部京涵
				[sex] => 1
				[language] => zh_CN
				[city] => 海淀
				[province] => 北京
				[country] => 中国
				[headimgurl] => http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTK1Z5PP9eclKicdVlusPFicWTBzDF7Nr90RVbCYcz67n9NJWLIroljXDFg22e0r9NzIuEianrMTxUQIA/0
				[privilege] => Array
					(
					)

				[unionid] => oVUrfwgILWac1A7iPmpdspmoibv0
			)*/

		if(!$user_info_row || !isset($user_info_row['openid']))
		{
			echo 'openid错误或access_token过期';die();
		}

        $User_BindConnectModel = new User_BindConnectModel();
		//app端和pc用的不是同一个应用 改用unionid
        //$bind_id     = sprintf('%s_%s', 'weixin', $user_info_row['openid']);
        $bind_id     = sprintf('%s_%s', 'weixin', $user_info_row['unionid']);
        $connect_rows = $User_BindConnectModel->getBindConnect($bind_id);

        if ($connect_rows)
        {
            $connect_row = array_pop($connect_rows);
        }

        //已经绑定,并且用户正确
        if (isset($connect_row['user_id']) && $connect_row['user_id'])
        {
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

                if($bind_row['bind_token'] != $access_token)
				{
                    $data_row                      = array();
                    $data_row['user_id']           = $user_id;
                    $data_row['bind_token'] = $access_token;

                    $connect_flag = $User_BindConnectModel->editBindConnect($bind_id, $data_row);
				}
				else
				{
                    $connect_flag = true;
				}
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
                $data = array();

                $data['bind_id']           = $bind_id;
                $data['bind_type']         = $User_BindConnectModel::WEIXIN;
                $data['user_id']           = $user_id;
                $data['bind_nickname']     = $user_info_row['nickname']; // 名称
                $data['bind_avator']         = $user_info_row['headimgurl']; //头像
                $data['bind_gender']       = $user_info_row['sex']; // 性别 1:男  2:女
                $data['bind_openid']       = $user_info_row['unionid']; // 访问
                $data['bind_token'] = $access_token;

                $connect_flag = $User_BindConnectModel->addBindConnect($data);
            }

            //取得open id, 需要封装
            if ($connect_flag)
            {
                //选择,登录绑定还是新创建账号 $user_id == 0
                if (!Perm::checkUserPerm())
                {
                    $data['type'] = $type;
					$data['access_token'] = $access_token;
                    $data['result'] = 0;
                	$this->data->addBody(-140,$data,'success',200);
                }
                else
                {
                    $login_flag = true;
                }
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
                $user_info_row   = $User_InfoModel->getOne($connect_row['user_id']);

                if ($user_info_row)
                {
                    $data            = array();
                    $data['user_id'] = $user_info_row['user_id'];
                    $encrypt_str = Perm::encryptUserInfo($data, $user_info_row['session_id']);

                    $data['user_name'] = $user_info_row['user_name'];
                    $data['k'] = $encrypt_str;
                    $data['result'] = 1;
                    $this->data->addBody(100, $data);
                }
                else
                {
                    $this->data->setError('登录失败');
                }
            }
        }
	}

}

?>
