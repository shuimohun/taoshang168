<?php
if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}
/**
 * @author  weidp
 */

class User_UserCtl extends Controller
{
    public function __construct(&$ctl,$met,$typ)
    {
        parent::__construct($ctl,$met,$typ);

    }
    //设置页主页
    public function getUserInfo()
    {

        $data = new YLB_Data();
        $user_id = request_int('u');
        $key  = request_string('k');

        if($user_id != perm::$userId)
        {
            $data->setError('用户不符合',array('code' => -10));die;
        }
        if(!$user_id)
        {
           $data->setError('参数错误',array('code'=>-10));die;
        }
        if(!$key)
        {
            $data->setError('请从新登陆',array('code'=>-10));die;
        }
        $user = new User_UserModel();
        $arr = $user->getList($user_id);
        if($this->typ='json')
        {
            $this->data->addBody(-140,$arr);
        }
    }
    //性别选项接口
    public function changeSex()
    {
        $user = new User_UserModel();
        $typ = request_string('typ');
        $sex = request_int('sex');
        $uid = perm::$userId;

        if($typ != 'json')
        {
            $this->data->setError('非法请求',array('code'=>-10));die;
        }
        if($sex != '0' && $sex != '1' && $sex != '2')
        {
            $this->data->setError('参数错误',array('code' => -10));die;
        }
        if(!$uid)
        {
            $this->data->setError('需要登陆',array('code' => -20));die;
        }

        $code = $user->sexChange($uid,$sex);

        if($code)
        {
            $status = 200;
            $msg = 'success';
            $data = array();
            $this->data->addBody(-140,$data,$msg,$status);
        }
        else
            {
                $status = 250;
                $msg = 'error';
                $data = array('msg' => '数据添加失败');
                $this->data->addBody(-140,$data,$msg,$status);
            }
        }
    //验证手机
    public function checkPhone()
    {
        $user = new User_UserModel();
        $typ = request_string('typ');
        $phone = request_string('phone');
        $uid = perm::$userId;
        if($typ != 'json')
        {
            $this->data->setError('非法请求',array('code'=>-10));die;
        }
        if(is_numeric($phone) && $phone != '')
        {
            $pat = '/^1[3|5|6|7|8]{1}[0-9]{9}$/';
            if(preg_match($pat,$phone))
            {
                $code = $user->phoneCheck($uid,$phone);
                if($code == false)
                {
                    $status = 250;
                    $msg = 'error';
                    $data = array('msg' => '原手机号错误');
                    $this->data->addBody(-140,$data,$msg,$status);
                }
                else if($code == true)
                {
                    $status = 200;
                    $msg = 'success';
                    $data = array('msg' => '原手机号正确');
                    $this->data->addBody(-140,$data,$msg,$status);
                }
                else
                {
                    $status = 250;
                    $msg = 'error';
                    $data = array('msg' => '你是外星人？');
                    $this->data->addBody(-140,$data,$msg,$status);
                }
            }
            else
            {
                $status = 250;
                $msg = 'error';
                $data = array('msg' => '手机格式错误');
                $this->data->addBody(-140,$data,$msg,$status);
            }
        }
        else
        {
            if($phone == 0)
            {
                $code = $user->phoneCheck($uid);
                if($code == false)
                {
                    $status = 250;
                    $msg = 'error';
                    $data = array('msg' => '该用户没有绑定手机');
                    $this->data->addBody(-140,$data,$msg,$status);
                }
                else
                {
                    $status = 200;
                    $msg = 'success';
                    $data = array('phone' => $code);
                    $this->data->addBody(-140,$data,$msg,$status);
                }
            }
            else
            {
                $this->data->setError('请填写数字',array('code' =>-10));die;
            }

        }
    }
    //发送验证码
    public function setYzm($mobile = null)
    {
            if($mobile == null)
            {
                $mobile                  = request_string('mobile');
                $code_key = $mobile;
                $code     = VerifyCode::getCode($code_key);
                $me       = '【淘尚168商城】您的验证码是'.$code;
                $str = Sms::send($mobile, $me);
                if($str)
                {
                    $status = 200;
                    $msg = "success";
                }
                else
                {
                    $status = 250;
                    $msg = "error";
                }

                $data   = array('sms_time'=>60,'code' => $code);
                $this->data->addBody(-140, $data, $msg, $status);
            }
            else
            {
                $code_key = $mobile;
                $code     = VerifyCode::getCode($code_key);
                $me       = '【淘尚168商城】您的验证码是'.$code;
                $str = Sms::send($mobile, $me);
                if($str)
                {
                   return $code;die;
                }
                else
                {
                    return false;
                }
            }
    }

    //检测验证码
    public function checkYzm()
    {

        $yzm  = request_string('yzm');
        $type = request_string('type');
        $val  = request_string('val');

        fb($val);
        fb($yzm);
        fb(VerifyCode::checkCode($val, $yzm));
        if (VerifyCode::checkCode($val, $yzm))
        {

            $status = 200;
            $msg    = _('success');
        }
        else
        {
            $msg    = _('failure');
            $status = 250;

        }
        $data = array();

        $this->data->addBody(-140, $data, $msg, $status);

    }

    //修改手机号接口
    public function editPhone()
    {
        $uid = perm::$userId;
        $typ = request_string('typ');
        $phone  = request_string('mobile');
        $user = new User_UserModel();
        if($typ != 'json')
        {
            $this->data->setError('非法请求',array('code'=>-10));die;
        }
        if(is_numeric($phone) && $phone != '')
        {

            $pat ='/^1[3|5|7|8]{1}[0-9]{9}$/';
            if(preg_match($pat,$phone))
            {

                $code = $user->editPhone($uid,$phone);

                if($code == true || $code == false)
                {
                    $status= 200;
                    $msg = 'success';
                    $data = array();
                    $this->data->addBody(-140,$data,$msg,$status);
                }
            }
            else
            {

                $status = 250;
                $msg = 'error';
                $data = array('msg' => '手机格式错误');
                $this->data->addBody(-140,$data,$msg,$status);
            }
        }
    }
    //验证密码接口
    public function checkLoginPassword()
    {
        $uid = perm::$userId;
        $typ = request_string('typ');
        $passwd  = request_string('password');
        $user = new User_UserModel();
        if($typ != 'json')
        {
            $this->data->setError('非法请求',array('code'=>-10));die;
        }
        $passwd = md5($passwd);
        $code = $user->checkPasswd($uid,$passwd);

        if($code == true)
        {
            $status = 200;
            $msg = 'success';
            $data = array();
            $this->data->addBody(-140,$data,$msg,$status);
        }
        else
        {
            $status = 250;
            $msg = 'error';
            $data = array('msg' => '密码错误');
            $this->data->addBody(-140,$data,$msg,$status);
        }

    }
    //验证新密码接口
    public function editLoginPassword()
    {
        $uid = perm::$userId;
        $typ = request_string('typ');
        $passwd = request_string('newPassword');
        $user = new User_UserModel();
        if($typ != 'json')
        {
            $this->data->setError('非法请求',array('code'=>-10));die;
        }
        $pat ='/^(?!\D+$)(?![^a-zA-Z]+$)\S{6,20}$/';
        if(preg_match($pat,$passwd))
        {
            $passwd = md5($passwd);
            $code = $user->editPasswd($uid,$passwd);
            if($code == true)
            {
                $status = 200;
                $msg = 'success';
                $data = array();
                $this->data->addBody(-140,$data,$msg,$status);
            }
        }
        else
        {
            $status = 250;
            $msg = 'error';
            $data = array('msg' => '密码格式错误');
            $this->data->addBody(-140,$data,$msg,$status);
        }

    }
    //验证用户是否有支付密码
    public function checkPayPassword()
    {
        $uid = perm::$userId;
        $typ = request_string('typ');
        $user = new User_UserModel();
        if($typ != 'json')
        {
            $this->data->setError('非法请求',array('code'=>-10));die;
        }
        $code = $user->checkPayPasswd($uid);
        if($code)
        {
            $status = 200;
            $msg = 'success';
            $data = array();
            $this->data->addBody(-140,$data,$msg,$status);
        }
        else
        {
            $status = 250;
            $msg = 'error';
            $data = array('msg' => '该用户没有支付密码');
            $this->data->addBody(-140,$data,$msg,$status);
        }
    }
    //支付密码验证码
    public function payCheckYzm()
    {
        $uid = perm::$userId;
        $typ = request_string('typ');
        $user = new User_UserModel();
        if($typ != 'json')
        {
            $this->data->setError('非法请求',array('code'=>-10));die;
        }
        $phone = $user->phoneCheck($uid);
        if($phone == false)
        {
            $status = 220;
            $msg = 'error';
            $data = array('msg' => '该用户没有绑定手机号');
            $this->data->addBody(-140,$data,$msg,$status);
        }
        else
        {
            $code = $this->setYzm($phone);
            if($code)
            {
                $status = 200;
                $msg = 'success';
                $data = array('msg' => '发送成功','code' => $code);
                $this->data->addBody(-140,$data,$msg,$status);
            }
            else
            {
                $status = 250;
                $msg = 'error';
                $data = array('msg' => '发送失败');
                $this->data->addBody(-140,$data,$msg,$status);
            }
        }
    }
    //验证原支付密码
    public function verifyPayPassword()
    {
        $uid = perm::$userId;
        $typ = request_string('typ');
        $passwd = request_string('payPasswd');
        $user = new User_UserModel();
        if($typ != 'json')
        {
            $this->data->setError('非法请求',array('code'=>-10));die;
        }
        $passwd = md5($passwd);
        $code = $user->verifyPayPasswd($uid,$passwd);
        if($code)
        {
            $status = 200;
            $msg = 'success';
            $data = array();
            $this->data->addBody(-140,$data,$msg,$status);
        }
        else
        {
            $status = 250;
            $msg = 'error';
            $data = array('msg' => '密码不正确');
            $this->data->addBody(-140,$data,$msg,$status);
        }
    }
    //修改支付密码
    public function editPayPassword()
    {
        $uid = perm::$userId;
        $typ = request_string('typ');
        $passwd = request_string('password');
        $user = new User_UserModel();
        if($typ != 'json')
        {
            $this->data->setError('非法请求',array('code'=>-10));die;
        }
        $pat = '/^[0-9]{6}$/';
        if(preg_match($pat,$passwd))
        {
            $passwd = md5($passwd);
            $code = $user->editPayPasswd($uid,$passwd);
            if($code)
            {
                $status = 200;
                $msg = 'success';
                $data = array();
                $this->data->addBody(-140,$data,$msg,$status);
            }
        }
        else
        {
            $status = 250;
            $msg = 'error';
            $data = array('msg'=>'密码格式不正确');
            $this->data->addBody(-140,$data,$msg,$status);
        }
    }

    public function upImg()
    {
        $base = request_string('image');
        $img = base64_decode($base);
        $status = 200;
        $msg = 'success';
        $data = array('img' => $img);
        $this->data->addBody(-140,$data,$msg,$status);
    }
}