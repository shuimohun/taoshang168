<?php

class LoginCtl extends YLB_AppController
{
    public function index()
    {
        include $this->view->getView();
    }

    /*
     * 检测登录数据是否正确
     *
     *
     */
    public function login()
    {
        if (!Perm::checkUserPerm()) {
            $login_url = YLB_Registry::get('ucenter_api_url') . '?ctl=Login&met=index&typ=e';
            $callback = YLB_Registry::get('url') . '?ctl=Login&met=check&typ=e&redirect=' . urlencode(request_string('forward'));
            $login_url = $login_url . '&from=shop&callback=' . urlencode($callback);
            setcookie('comeUrl', getenv("HTTP_REFERER"));
            header('location:' . $login_url);
            exit();
        } else {
            header('location:' . YLB_Registry::get('url'));
        }
    }

    /*
     * 检测登录数据是否正确
     *
     *
     */
    public function reg()
    {
        if (!Perm::checkUserPerm()) {
            $reg_url = YLB_Registry::get('ucenter_api_url') . '?ctl=Login&met=regist&typ=e';
            $callback = YLB_Registry::get('url') . '?ctl=Login&met=check&typ=e&redirect=' . urlencode(request_string('forward'));
            $reg_url = $reg_url . '&from=shop&callback=' . urlencode($callback);
            setcookie('comeUrl', getenv("HTTP_REFERER"));
            header('location:' . $reg_url);
            exit();
        } else {
            header('location:' . YLB_Registry::get('url'));
        }
    }

    /*
     * 检测登录数据是否正确
     *
     *
     */
    public function check()
    {
        //本地读取远程信息
        $key = YLB_Registry::get('ucenter_api_key');;
        $url = YLB_Registry::get('ucenter_api_url');
        $app_id = YLB_Registry::get('ucenter_app_id');

        $redirect = request_string('redirect');

        $formvars = array();
        $formvars['user_id'] = request_int('us');
        $formvars['u'] = request_int('us');
        $formvars['k'] = request_string('ks');
        $formvars['type'] = request_string('type');
        $formvars['app_id'] = $app_id;

        $url = sprintf('%s?ctl=%s&met=%s&typ=%s', $url, 'Login', 'checkLogin', 'json');
        $init_rs = get_url_with_encrypt($key, $url, $formvars);

        if (200 == $init_rs['status']) {
            //读取服务列表
            $user_row = $init_rs['data'];
            $user_id = $user_row['user_id'];
            $user_name = $user_row['user_name'];

            $User_BaseModel = new User_BaseModel();
            $User_InfoModel = new User_InfoModel();
            $Points_LogModel = new Points_LogModel();

            //本地数据校验登录
            $user_row = $User_BaseModel->getOne($user_id);

            if ($user_row) {
                //判断状态是否开启
                if ($user_row['user_delete'] == 1) {
                    $msg = _('该账户未启用，请启用后登录！');
                    if ('e' == $this->typ) {
                        location_go_back(_('初始化用户出错!'));
                    } else {
                        return $this->data->setError($msg, array());
                    }
                }
            } else {
                //添加用户
                $data['user_id'] = $init_rs['data']['user_id']; // 用户id
                $data['user_account'] = $init_rs['data']['user_name']; // 用户帐号
                $data['user_delete'] = 0; // 用户状态

                $user_id = $User_BaseModel->addBase($data, true);

                //判断状态是否开启
                if (!$user_id) {
                    $msg = _('初始化用户出错!');
                    if ('e' == $this->typ) {
                        location_go_back(_('初始化用户出错!'));
                    } else {
                        return $this->data->setError($msg, array());
                    }
                } else {
                    //初始化用户信息
                    $user_info_row = array();
                    $user_info_row['user_id'] = $user_id;
                    $user_info_row['user_realname'] = @$init_rs['data']['user_truename'];
                    $user_info_row['user_name'] = isset($init_rs['data']['nickname']) && $init_rs['data']['nickname'] != '' ? $init_rs['data']['nickname'] : $data['user_account'];
                    $user_info_row['user_mobile'] = @$init_rs['data']['user_mobile'];
                    $user_info_row['user_mobile_verify'] = @$init_rs['data']['user_mobile_verify'];
                    $user_info_row['user_email'] = @$init_rs['data']['user_email'];
                    $user_info_row['user_email_verify'] = @$init_rs['data']['user_email_verify'];
                    $user_info_row['user_logo'] = @$init_rs['data']['user_avatar'];
                    $user_info_row['user_regtime'] = get_date_time();

                    $User_InfoModel = new User_InfoModel();
                    $User_InfoModel->addInfo($user_info_row);

                    $user_resource_row = array();
                    $user_resource_row['user_id'] = $user_id;
                    $user_resource_row['user_points'] = Web_ConfigModel::value("points_reg");//注册获取金蛋;

                    $User_ResourceModel = new User_ResourceModel();
                    $User_ResourceModel->addResource($user_resource_row);

                    $User_PrivacyModel = new User_PrivacyModel();
                    $user_privacy_row['user_id'] = $user_id;
                    $User_PrivacyModel->addPrivacy($user_privacy_row);

                    //金蛋
                    $user_points_row['user_id'] = $user_id;
                    $user_points_row['user_name'] = $data['user_account'];
                    $user_points_row['class_id'] = Points_LogModel::ONREG;
                    $user_points_row['points_log_points'] = $user_resource_row['user_points'];
                    $user_points_row['points_log_time'] = get_date_time();
                    $user_points_row['points_log_desc'] = _('会员注册');
                    $user_points_row['points_log_flag'] = 'reg';
                    $Points_LogModel->addLog($user_points_row);

                    //发送站内信
                    $message = new MessageModel();
                    $message->sendMessage('welcome', $user_id, $data['user_account'], '', '', 0, 5);

                    /*$analytics_ip = isset($init_rs['data']['user_reg_ip']) ? $init_rs['data']['user_reg_ip'] : get_ip();
                    $analytics_data = array(
                        'user_name'=>$data['user_account'],  //用户账号
                        'user_id'=>$user_id,
                        'ip'=>$analytics_ip,
                        'date'=>date('Y-m-d H:i:s')
                    );

		            YLB_Plugin_Manager::getInstance()->trigger('analyticsMemberAdd',$analytics_data);*/

                    if (Web_ConfigModel::value('Plugin_Directseller')) {
                        $PluginManager = YLB_Plugin_Manager::getInstance();
                        $PluginManager->trigger('regDone', $user_id);
                    }

                    $fuserialize = $_COOKIE['fuserialize'];

                    //YLB_Log::log('fuserialize='.$fuserialize.'data='.$init_rs['data']['bind_type'].$init_rs['data']['bind_id'],YLB_Log::INFO,'test');
                    if ($fuserialize && $init_rs['data']['bind_id'] && $init_rs['data']['bind_type']) {
                        list($fu_record_id, $stype) = explode('/', $fuserialize);
                        if ($fu_record_id && $stype) {
                            switch ($stype) {
                                case 'tsina':
                                    $s_type = 1;
                                    break;
                                case 'sqq':
                                case 'qzone':
                                    $s_type = 2;
                                    break;
                                case 'weixin':
                                case 'weixin_timeline':
                                    $s_type = 3;
                                    break;
                                default:
                                    $s_type = 0;
                            }

                            if ($init_rs['data']['bind_type'] == $s_type) {
                                $FuRecordModel = new Fu_RecordModel();
                                $flag = $FuRecordModel->regFuRecord($fu_record_id, $stype, $init_rs['data']['bind_id']);
                                if ($flag) {
                                    setcookie("fuserialize", null, time() - 3600 * 24 * 365);
                                    setcookie("fuserialize", null, time() - 3600 * 24 * 365, '/');
                                }
                            }
                        }
                    }
                }

                $user_row = $data;
            }

            if ($user_row) {
                $data = array();
                $data['user_id'] = $user_row['user_id'];
                srand((double)microtime() * 1000000);
                //$user_key = md5(rand(0, 32000));
                $user_key = 'ttt';
                $time = get_date_time();

                //获取上次登录的时间
                $info = $User_BaseModel->getBase($user_row['user_id']);

                $lotime = strtotime($info[$user_row['user_id']]['user_login_time']);
                $last_day = date("d ", $lotime);
                $now_day = date("d ");
                $now = time();

                $login_info_row = array();
                $login_info_row['user_key'] = $user_key;
                $login_info_row['user_login_time'] = $time;
                $login_info_row['user_login_times'] = $info[$user_row['user_id']]['user_login_times'] + 1;
                $login_info_row['user_login_ip'] = get_ip();

                $User_BaseModel->editBase($user_row['user_id'], $login_info_row, false);

                $login_row['user_logintime'] = $time;
                $login_row['lastlogintime'] = $info[$user_row['user_id']]['user_login_time'];
                $login_row['user_ip'] = get_ip();
                $login_row['user_lastip'] = $info[$user_row['user_id']]['user_login_ip'];
                $User_InfoModel->editInfo($user_row['user_id'], $login_row, false);

                //当天没有登录过执行
                if ($last_day != $now_day && $now > $lotime) {
                    $user_points = Web_ConfigModel::value("points_login");
                    $user_grade = Web_ConfigModel::value("grade_login");

                    $User_ResourceModel = new User_ResourceModel();
                    //获取当前登录的金蛋经验值
                    $ce = $User_ResourceModel->getResource($user_row['user_id']);

                    $resource_row['user_points'] = $ce[$user_row['user_id']]['user_points'] * 1 + $user_points * 1;
                    $resource_row['user_growth'] = $ce[$user_row['user_id']]['user_growth'] * 1 + $user_grade * 1;

                    $res_flag = $User_ResourceModel->editResource($user_row['user_id'], $resource_row);

                    $User_GradeModel = new User_GradeModel;
                    //升级判断
                    $res_flag = $User_GradeModel->upGrade($user_row['user_id'], $resource_row['user_growth']);
                    //金蛋
                    $points_row['user_id'] = $user_id;
                    $points_row['user_name'] = $user_row['user_account'];
                    $points_row['class_id'] = Points_LogModel::ONLOGIN;
                    $points_row['points_log_points'] = $user_points;
                    $points_row['points_log_time'] = $time;
                    $points_row['points_log_desc'] = _('会员登录');
                    $points_row['points_log_flag'] = 'login';

                    $Points_LogModel = new Points_LogModel();

                    $Points_LogModel->addLog($points_row);

                    //成长值
                    $grade_row['user_id'] = $user_id;
                    $grade_row['user_name'] = $user_row['user_account'];
                    $grade_row['class_id'] = Grade_LogModel::ONLOGIN;
                    $grade_row['grade_log_grade'] = $user_grade;
                    $grade_row['grade_log_time'] = $time;
                    $grade_row['grade_log_desc'] = _('会员登录');
                    $grade_row['grade_log_flag'] = 'login';

                    $Grade_LogModel = new Grade_LogModel;
                    $Grade_LogModel->addLog($grade_row);
                }

                //$flag     = $User_BaseModel->editBaseSingleField($user_row['user_id'], 'user_key', $user_key, $user_row['user_key']);
                YLB_Hash::setKey($user_key);

                $Seller_BaseModel = new Seller_BaseModel();
                $seller_rows = $Seller_BaseModel->getByWhere(array('user_id' => $data['user_id']));
                $Chain_UserModel = new Chain_UserModel();
                $chain_rows = $Chain_UserModel->getByWhere(array('user_id' => $data['user_id']));
                if ($chain_rows) {
                    $data['chain_id_row'] = array_column($chain_rows, 'chain_id');
                    $data['chain_id'] = current($data['chain_id_row']);
                } else {
                    $data['chain_id'] = 0;
                }
                if ($seller_rows) {
                    $data['shop_id_row'] = array_column($seller_rows, 'shop_id');
                    $data['shop_id'] = current($data['shop_id_row']);
                } else {
                    $data['shop_id'] = 0;
                }

                $encrypt_str = Perm::encryptUserInfo($data);

                //user_account 这个COOKIE IM是需要的。Zhenzh
                setcookie('user_id', $user_row['user_id']);
                setcookie('user_account', $user_row['user_account']);
                setcookie('last_login_time', $lotime);
                setcookie('last_login_ip', $login_row['user_lastip']);

                //更新购物车
                if (isset($_COOKIE['goods_cart'])) {
                    $CartModel = new CartModel();
                    $CartModel->updateCookieCart($data['user_id']);

                    setcookie("goods_cart", null, time() - 1, '/');
                }

                if ('e' == $this->typ) {
                    if ($redirect) {
                        location_to(urldecode($redirect));
                    } else {
                        if ($_COOKIE['comeUrl']) {
                            location_to($_COOKIE['comeUrl']);
                        } else if ($chain_rows) {
                            location_to(YLB_Registry::get('url') . '?ctl=Chain_Goods&met=goods&typ=e');
                        } else {
                            location_to(YLB_Registry::get('base_url'));
                        }
                    }

                } else {
                    $data = array();
                    $data['user_id'] = $user_row['user_id'];
                    $data['user_account'] = $user_row['user_account'];
                    $data['key'] = $encrypt_str;

                    $this->data->addBody(100, $data);
                }
            } else {
                $msg = _('登录出错！');
                if ('e' == $this->typ) {
                    location_go_back($msg);
                } else {
                    return $this->data->setError($msg, array());
                }
            }
        } else {
            $msg = _('登录信息有误！');
            if ('e' == $this->typ) {
                location_go_back($msg);
            } else {
                return $this->data->setError($msg, array());
            }
        }

        if ($jsonp_callback = request_string('jsonp_callback')) {
            exit($jsonp_callback . '(' . json_encode($this->data->getDataRows()) . ')');
        }
    }


    /**
     * 用户登录,通过本站输入用户名密码登录
     *
     * @access public
     */
    public function doLogin()
    {
        $Points_LogModel = new Points_LogModel();
        $User_BaseModel = new User_BaseModel();
        $User_InfoModel = new User_InfoModel();

        //本地读取远程信息
        $key = YLB_Registry::get('ucenter_api_key');
        $url = YLB_Registry::get('ucenter_api_url');
        $ucenter_app_id = YLB_Registry::get('ucenter_app_id');
        $formvars = array();
        $formvars['user_account'] = $_REQUEST['user_account'];
        $formvars['user_password'] = $_REQUEST['user_password'];
        $formvars['app_id'] = $ucenter_app_id;
        $formvars['ctl'] = 'Login';
        $formvars['met'] = 'login';
        $formvars['typ'] = 'json';
        $init_rs = get_url_with_encrypt($key, $url, $formvars);

        if (200 == $init_rs['status']) {
            $user_id = $init_rs['data']['user_id'];
            $uk = $init_rs['data']['k'];
        } else {
            $msg = $init_rs['msg'] ? $init_rs['msg'] : _('登录信息有误');
            if ('e' == $this->typ) {
                location_go_back($msg);
            } else {
                return $this->data->setError($msg, array());
            }
        }

        //本地数据校验登录
        $user_row = $User_BaseModel->getOne($user_id);
        if ($user_row) {
            //判断状态是否开启
            if ($user_row['user_delete'] == 1) {
                $msg = _('该账户未启用，请启用后登录！');
                if ('e' == $this->typ) {
                    location_go_back($msg);
                } else {
                    return $this->data->setError($msg, array());
                }
            }
        } else {
            $user_row = $init_rs['data'];

            //添加用户
            $data['user_id'] = $user_row['user_id']; // 用户id
            $data['user_account'] = $user_row['user_name']; // 用户帐号
            $data['user_passwd'] = $user_row['password']; // 密码：使用用户中心-此处废弃

            $data['user_delete'] = 0; // 用户状态
            $user_id = $User_BaseModel->addBase($data, true);

            //初始化用户信息
            $user_info_row = array();
            $user_info_row['user_id'] = $user_id;
            $user_info_row['user_realname'] = $user_row['user_truename'];
            $user_info_row['user_name'] = isset($user_row['nickname']) ? $user_row['nickname'] : $data['user_account'];
            $user_info_row['user_mobile'] = $user_row['user_mobile'];
            $user_info_row['user_mobile_verify'] = $user_row['user_mobile_verify'];
            $user_info_row['user_logo'] = $user_row['user_avatar'];
            $user_info_row['user_regtime'] = get_date_time();
            $info_flag = $User_InfoModel->addInfo($user_info_row);

            $user_resource_row = array();
            $user_resource_row['user_id'] = $user_id;
            $user_resource_row['user_points'] = Web_ConfigModel::value("points_reg");//注册获取金蛋;

            $User_ResourceModel = new User_ResourceModel();
            $res_flag = $User_ResourceModel->addResource($user_resource_row);

            $User_PrivacyModel = new User_PrivacyModel();
            $user_privacy_row['user_id'] = $user_id;
            $privacy_flag = $User_PrivacyModel->addPrivacy($user_privacy_row);
            //金蛋
            $user_points_row['user_id'] = $user_id;
            $user_points_row['user_name'] = $data['user_account'];
            $user_points_row['class_id'] = Points_LogModel::ONREG;
            $user_points_row['points_log_points'] = $user_resource_row['user_points'];
            $user_points_row['points_log_time'] = get_date_time();
            $user_points_row['points_log_desc'] = _('会员注册');
            $user_points_row['points_log_flag'] = 'reg';
            $Points_LogModel->addLog($user_points_row);
            //发送站内信
            $message = new MessageModel();
            $message->sendMessage('welcome', $user_id, $data['user_account'], '', '', 0, 5);


            //判断状态是否开启
            if (!$user_id) {
                $msg = _('初始化用户出错！');
                if ('e' == $this->typ) {
                    location_go_back($msg);
                } else {
                    return $this->data->setError($msg, array());
                }
            }

            /**
             *  统计中心
             * shop的注册人数
             */
            $analytics_ip = isset($init_rs['data']['user_reg_ip']) ? $init_rs['data']['user_reg_ip'] : get_ip();
            $analytics_data = array(
                'user_name' => $data['user_account'],  //用户账号
                'user_id' => $user_id,
                'ip' => $analytics_ip,
                'date' => date('Y-m-d H:i:s')
            );

            YLB_Plugin_Manager::getInstance()->trigger('analyticsMemberAdd', $analytics_data);
        }

        if ($user_row) {
            $data = array();
            $data['user_id'] = $user_row['user_id'];
            srand((double)microtime() * 1000000);
            $user_key = 'ttt';

            $time = get_date_time();
            //获取上次登录的时间
            //$info = $User_BaseModel->getBase($user_row['user_id']);

            $lotime = strtotime($user_row['user_login_time']);
            $last_day = date("d ", $lotime);
            $now_day = date("d ");
            $now = time();

            $login_info_row = array();
            $login_info_row['user_key'] = $user_key;
            $login_info_row['user_login_time'] = $time;
            $login_info_row['user_login_times'] = $user_row['user_login_times'] + 1;
            $login_info_row['user_login_ip'] = get_ip();

            $flag = $User_BaseModel->editBase($user_row['user_id'], $login_info_row, false);

            $login_row['user_logintime'] = $time;
            $login_row['lastlogintime'] = $user_row['user_login_time'];
            $login_row['user_ip'] = get_ip();
            $login_row['user_lastip'] = $user_row['user_login_ip'];
            $flag = $User_InfoModel->editInfo($user_row['user_id'], $login_row, false);
            //当天没有登录过执行

            if ($last_day != $now_day && $now > $lotime) {
                $user_points = Web_ConfigModel::value("points_login");
                $user_grade = Web_ConfigModel::value("grade_login");

                $User_ResourceModel = new User_ResourceModel();
                //获取当前登录的金蛋经验值
                $ce = $User_ResourceModel->getResource($user_row['user_id']);

                $resource_row['user_points'] = $ce[$user_row['user_id']]['user_points'] * 1 + $user_points * 1;
                $resource_row['user_growth'] = $ce[$user_row['user_id']]['user_growth'] * 1 + $user_grade * 1;

                $res_flag = $User_ResourceModel->editResource($user_row['user_id'], $resource_row);

                $User_GradeModel = new User_GradeModel;
                //升级判断
                $res_flag = $User_GradeModel->upGrade($user_row['user_id'], $resource_row['user_growth']);
                //金蛋
                $points_row['user_id'] = $user_id;
                $points_row['user_name'] = $user_row['user_account'];
                $points_row['class_id'] = Points_LogModel::ONLOGIN;
                $points_row['points_log_points'] = $user_points;
                $points_row['points_log_time'] = $time;
                $points_row['points_log_desc'] = _('会员登录');
                $points_row['points_log_flag'] = 'login';

                $Points_LogModel = new Points_LogModel();

                $Points_LogModel->addLog($points_row);

                //成长值
                $grade_row['user_id'] = $user_id;
                $grade_row['user_name'] = $user_row['user_account'];
                $grade_row['class_id'] = Grade_LogModel::ONLOGIN;
                $grade_row['grade_log_grade'] = $user_grade;
                $grade_row['grade_log_time'] = $time;
                $grade_row['grade_log_desc'] = _('会员登录');
                $grade_row['grade_log_flag'] = 'login';

                $Grade_LogModel = new Grade_LogModel;
                $Grade_LogModel->addLog($grade_row);
            }

            $Seller_BaseModel = new Seller_BaseModel();
            $seller_rows = $Seller_BaseModel->getByWhere(array('user_id' => $data['user_id']));
            $Chain_UserModel = new Chain_UserModel();
            $chain_rows = $Chain_UserModel->getByWhere(array('user_id' => $data['user_id']));
            if ($chain_rows) {
                $data['chain_id_row'] = array_column($chain_rows, 'chain_id');
                $data['chain_id'] = current($data['chain_id_row']);
            } else {
                $data['chain_id'] = 0;
            }
            if ($seller_rows) {
                $data['shop_id_row'] = array_column($seller_rows, 'shop_id');
                $data['shop_id'] = current($data['shop_id_row']);
            } else {
                $data['shop_id'] = 0;
            }

            YLB_Hash::setKey($user_key);
            $encrypt_str = Perm::encryptUserInfo($data);

            if ('e' == $this->typ) {
                location_to(YLB_Registry::get('base_url'));
            } else {
                $data['user_account'] = $formvars['user_account'];
                $data['key'] = $encrypt_str;
                $data['uk'] = $uk;
                $this->data->addBody(100, $data);
            }

        } else {
            $msg = _('输入密码有误！');
            if ('e' == $this->typ) {
                location_go_back($msg);
            } else {
                return $this->data->setError($msg, array());
            }
        }
    }


    /**
     * 用户登录,通过本站输入用户名密码登录
     *
     * @access public
     */
    public function doRegister()
    {
        $Points_LogModel = new Points_LogModel();
        $User_BaseModel = new User_BaseModel();
        $User_InfoModel = new User_InfoModel();
        $user_account = $_REQUEST['user_account'];

        //本地读取远程信息
        $key = YLB_Registry::get('ucenter_api_key');

        $url = YLB_Registry::get('ucenter_api_url');
        $ucenter_app_id = YLB_Registry::get('ucenter_app_id');
        $formvars = array();
        $formvars['user_account'] = $_REQUEST['user_account'];
        $formvars['user_password'] = $_REQUEST['user_password'];
        $formvars['app_id'] = $ucenter_app_id;

        $formvars['ctl'] = 'Api';
        $formvars['met'] = 'login';
        $formvars['typ'] = 'json';
        $init_rs = get_url_with_encrypt($key, $url, $formvars);


        if (200 == $init_rs['status']) {
            //读取服务列表
        } else {
            $msg = _('登录信息有误');
            if ('e' == $this->typ) {
                location_go_back($msg);
            } else {
                return $this->data->setError($msg, array());
            }
        }


        $userBaseModel = new User_BaseModel();

        //本地数据校验登录
        $user_id_row = $userBaseModel->getUserIdByAccount($user_account);

        if ($user_id_row) {
            $user_rows = $userBaseModel->getBase($user_id_row);
            $user_row = array_pop($user_rows);
            //判断状态是否开启
            if ($user_row['user_delete'] == 1) {

                $msg = _('该账户未启用，请启用后登录！');
                if ('e' == $this->typ) {
                    location_go_back($msg);
                } else {
                    return $this->data->setError($msg, array());
                }
            }
            //fb($user_row);
        } else {
            $user_row = $init_rs['data'];

            //添加用户
            $data['user_id'] = $user_row['user_id']; // 用户id
            $data['user_account'] = $user_row['user_name']; // 用户帐号
            $data['user_password'] = $user_row['password']; // 密码：使用用户中心-此处废弃

            $data['user_delete'] = 0; // 用户状态
            $user_id = $userBaseModel->addBase($data, true);

            //初始化用户信息
            $user_info_row = array();
            $user_info_row['user_id'] = $user_id;
            $user_info_row['user_realname'] = @$init_rs['data']['user_truename'];
            $user_info_row['user_name'] = isset($init_rs['data']['nickname']) ? $init_rs['data']['nickname'] : $data['user_account'];
            $user_info_row['user_mobile'] = @$init_rs['data']['user_mobile'];
            $user_info_row['user_logo'] = @$init_rs['data']['user_avatar'];
            $user_info_row['user_regtime'] = get_date_time();
            $info_flag = $User_InfoModel->addInfo($user_info_row);

            $user_resource_row = array();
            $user_resource_row['user_id'] = $user_id;
            $user_resource_row['user_points'] = Web_ConfigModel::value("points_reg");//注册获取金蛋;

            $User_ResourceModel = new User_ResourceModel();
            $res_flag = $User_ResourceModel->addResource($user_resource_row);

            $User_PrivacyModel = new User_PrivacyModel();
            $user_privacy_row['user_id'] = $user_id;
            $privacy_flag = $User_PrivacyModel->addPrivacy($user_privacy_row);
            //金蛋
            $user_points_row['user_id'] = $user_id;
            $user_points_row['user_name'] = $data['user_account'];
            $user_points_row['class_id'] = Points_LogModel::ONREG;
            $user_points_row['points_log_points'] = $user_resource_row['user_points'];
            $user_points_row['points_log_time'] = get_date_time();
            $user_points_row['points_log_desc'] = _('会员注册');
            $user_points_row['points_log_flag'] = 'reg';
            $Points_LogModel->addLog($user_points_row);
            //发送站内信
            $message = new MessageModel();
            $message->sendMessage('welcome', $user_id, $data['user_account'], '', '', 0, 5);


            //判断状态是否开启
            if (!$user_id) {

                $msg = _('初始化用户出错！');
                if ('e' == $this->typ) {
                    location_go_back($msg);
                } else {
                    return $this->data->setError($msg, array());
                }

            }
        }

        //if ($user_id_row && ($user_row['user_password'] == md5($_REQUEST['user_password'])))
        if ($user_row) {
            $data = array();
            $data['user_id'] = $user_row['user_id'];
            srand((double)microtime() * 1000000);
            //$user_key = md5(rand(0, 32000));
            $user_key = 'ttt';

            $time = get_date_time();
            //获取上次登录的时间
            $info = $User_BaseModel->getBase($user_row['user_id']);

            $lotime = strtotime($info[$user_row['user_id']]['user_login_time']);
            $last_day = date("d ", $lotime);
            $now_day = date("d ");
            $now = time();

            $login_info_row = array();
            $login_info_row['user_key'] = $user_key;
            $login_info_row['user_login_time'] = $time;
            $login_info_row['user_login_times'] = $info[$user_row['user_id']]['user_login_times'] + 1;
            $login_info_row['user_login_ip'] = get_ip();

            $flag = $User_BaseModel->editBase($user_row['user_id'], $login_info_row, false);

            $login_row['user_logintime'] = $time;
            $login_row['lastlogintime'] = $info[$user_row['user_id']]['user_login_time'];
            $login_row['user_ip'] = get_ip();
            $login_row['user_lastip'] = $info[$user_row['user_id']]['user_login_ip'];
            $flag = $User_InfoModel->editInfo($user_row['user_id'], $login_row, false);
            //当天没有登录过执行

            if ($last_day != $now_day && $now > $lotime) {

                $user_points = Web_ConfigModel::value("points_login");
                $user_grade = Web_ConfigModel::value("grade_login");

                $User_ResourceModel = new User_ResourceModel();
                //获取当前登录的金蛋经验值
                $ce = $User_ResourceModel->getResource($user_row['user_id']);

                $resource_row['user_points'] = $ce[$user_row['user_id']]['user_points'] * 1 + $user_points * 1;
                $resource_row['user_growth'] = $ce[$user_row['user_id']]['user_growth'] * 1 + $user_grade * 1;

                $res_flag = $User_ResourceModel->editResource($user_row['user_id'], $resource_row);

                $User_GradeModel = new User_GradeModel;
                //升级判断
                $res_flag = $User_GradeModel->upGrade($user_row['user_id'], $resource_row['user_growth']);
                //金蛋
                $points_row['user_id'] = $user_id;
                $points_row['user_name'] = $user_row['user_account'];
                $points_row['class_id'] = Points_LogModel::ONLOGIN;
                $points_row['points_log_points'] = $user_points;
                $points_row['points_log_time'] = $time;
                $points_row['points_log_desc'] = _('会员登录');
                $points_row['points_log_flag'] = 'login';

                $Points_LogModel = new Points_LogModel();

                $Points_LogModel->addLog($points_row);

                //成长值
                $grade_row['user_id'] = $user_id;
                $grade_row['user_name'] = $user_row['user_account'];
                $grade_row['class_id'] = Grade_LogModel::ONLOGIN;
                $grade_row['grade_log_grade'] = $user_grade;
                $grade_row['grade_log_time'] = $time;
                $grade_row['grade_log_desc'] = _('会员登录');
                $grade_row['grade_log_flag'] = 'login';

                $Grade_LogModel = new Grade_LogModel;
                $Grade_LogModel->addLog($grade_row);
            }

            //$flag     = $userBaseModel->editBaseSingleField($user_row['user_id'], 'user_key', $user_key, $user_row['user_key']);
            YLB_Hash::setKey($user_key);
            $encrypt_str = Perm::encryptUserInfo($data);

            if ('e' == $this->typ) {
                location_to(YLB_Registry::get('base_url'));
            } else {
                $data['user_account'] = $formvars['user_account'];
                $data['key'] = $encrypt_str;
                $this->data->addBody(100, $data);
            }

        } else {
            $msg = _('输入密码有误！');
            if ('e' == $this->typ) {
                location_go_back($msg);
            } else {
                return $this->data->setError($msg, array());
            }
        }

        //权限设置

    }


    //获取注册密码
    public function regCode1()
    {
        //本地读取远程信息
        $key = YLB_Registry::get('ucenter_api_key');

        $url = YLB_Registry::get('ucenter_api_url');
        $ucenter_app_id = YLB_Registry::get('ucenter_app_id');
        $formvars = array();
        $formvars['user_account'] = $_REQUEST['user_account'];
        $formvars['user_password'] = $_REQUEST['user_password'];
        $formvars['app_id'] = $ucenter_app_id;

        $formvars['ctl'] = 'Api';
        $formvars['met'] = 'login';
        $formvars['typ'] = 'json';
        $init_rs = get_url_with_encrypt($key, $url, $formvars);
    }


    /**
     * 退出
     */
    public function loginout()
    {
        if ($_REQUEST['met'] == 'loginout') {
            if (isset($_COOKIE['key']) || isset($_COOKIE['id'])) {
                setcookie("key", null, time() - 3600 * 24 * 365);
                setcookie("id", null, time() - 3600 * 24 * 365);

                setcookie("key", null, time() - 3600 * 24 * 365, '/');
                setcookie("id", null, time() - 3600 * 24 * 365, '/');
            }

            $login_url = YLB_Registry::get('ucenter_api_url') . '?ctl=Login&met=logout&typ=e';
            $callback = YLB_Registry::get('url');
            $login_url = $login_url . '&from=shop&callback=' . urlencode($callback);

            header('location:' . $login_url);
            exit();
        }
    }


    public function doLoginOut()
    {
        if (isset($_COOKIE['key']) || isset($_COOKIE['id'])) {
            echo "<script>parent.location.href='index.php';</script>";
            setcookie("key", null, time() - 3600 * 24 * 365);
            setcookie("id", null, time() - 3600 * 24 * 365);
        }

        $redirect = request_string('redirect');
        if ($redirect) {
            header('location:' . $redirect);
            exit();
        }


        /*//本地读取远程信息
        $key = YLB_Registry::get('ucenter_api_key');

        $url                       = YLB_Registry::get('ucenter_api_url');
        $ucenter_app_id            = YLB_Registry::get('ucenter_app_id');
        $formvars                  = array();
        $formvars['user_account']  = $_REQUEST['user_account'];
        $formvars['user_password'] = $_REQUEST['user_password'];
        $formvars['app_id']        = $ucenter_app_id;

        $formvars['ctl'] = 'Api';
        $formvars['met'] = 'loginout';
        $formvars['typ'] = 'json';
        $init_rs         = get_url_with_encrypt($key, $url, $formvars);

        $this->data->addBody(100, $init_rs);*/

    }

    function getYzm()
    {
        $mobile = request_string('mobile');
        $email = request_string('email');

        if ($mobile && YLB_Utils_String::isMobile($mobile)) {
            //判断手机号是否店铺已经注册过
            $Shop_CompanyModel = new Shop_CompanyModel();
            $check_mobile = $Shop_CompanyModel->getKeyByWhere(array('contacts_phone' => $mobile));

            if ($check_mobile) {
                $msg = '该手机号已使用';
                $status = 250;
            } else {
                $code = VerifyCode::getCode($mobile);

                if ($code) {
                    $contents = '【淘尚168商城】您的验证码是：' . $code . '。';
                    $result = Sms::send($mobile, $contents);

                    $status = 200;
                    $msg = "发送成功";
                } else {
                    $status = 250;
                    $msg = '发送失败';
                }
            }
        } else if ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //判断邮箱是否已经注册过
            $Shop_CompanyModel = new Shop_CompanyModel();
            $check_email = $Shop_CompanyModel->getKeyByWhere(array('contacts_email' => $email));
            if ($check_email) {
                $msg = '该邮箱已被使用';
                $status = 250;
            } else {
                $code = VerifyCode::getCode($email);

                if ($code) {
                    $title = '邮箱验证';
                    $contents = '【淘尚168商城】您的验证码是' . $code;
                    $result = Email::sendMail($email, '', $title, $contents);
                    if ($result) {
                        $msg = '发送成功';
                        $status = 200;
                    } else {
                        $msg = '发送失败';
                        $status = 250;
                    }
                } else {
                    $status = 250;
                    $msg = '验证码获取失败';
                }
            }
        } else {
            $msg = '发送失败';
            $status = 250;
        }

        $data = array();

        $this->data->addBody(-140, $data, $msg, $status);
    }
}

?>