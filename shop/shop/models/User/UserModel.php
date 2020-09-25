<?php
if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}
/**
 * @author  weidp
 */

class User_UserModel extends User_User
{
    public function getList($id)
    {
        $arr = array();
        $sql = "select yf.user_id,yf.user_name,ucenter.user_avatar as avatar,yf.user_sex as sex from YLB_user_info as 
        yf LEFT JOIN ucenter_user_info_detail as ucenter on yf.user_name = ucenter.user_name where yf.user_id = $id";
        $data = $this->sql->getRow($sql);
        $arr['item'] = $data;
        return $arr;
    }

    public function sexChange($id,$sex)
    {

        if(is_null($id) || is_null($sex))
        {
           return false;die;
        }

        if(!is_numeric($id) || !is_numeric($sex))
        {
            return false;die;
        }

        $sql = "update YLB_user_info set user_sex = $sex where user_id = $id";

        $data = $this->sql->exec($sql);

        return $data;

    }

    public function phoneCheck($id,$phone = null)
    {
        if($phone == null)
        {
            if(is_numeric($id))
            {
                $sql = "select user_mobile from YLB_user_info where user_id = $id";
                $data = $this->sql->getRow($sql);
                if($data['user_mobile'] == '')
                {
                    return false;die;
                }
                else
                {
                    return $data['user_mobile'];die;
                }
            }
        }
        else
        {
            if(is_null($id) || is_null($phone))
            {
                return false;die;
            }

            if(!is_numeric($id) || !is_numeric($phone))
            {
                return false;die;
            }

            $sql = "select user_name from YLB_user_info where user_id = $id and user_monile = $phone";
            $data = $this->sql->getRow($sql);
            if($data['user_name'] == '')
            {
                return false;die;
            }
            else
            {
                return true;die;
            }
        }
    }

    public function editPhone($id,$phone)
    {
        if(is_null($id) || is_null($phone))
        {
            return false;die;
        }

        if(!is_numeric($id) || !is_numeric($phone))
        {
            return false;die;
        }
        $sql = "update YLB_user_info set user_mobile = $phone where user_id = $id";
        $code = $this->sql->exec($sql);
        if($code)
        {
            return true;die;
        }
        else
        {
            return false;die;
        }
    }

    public function checkPasswd($id,$passwd)
    {
        $sql = "select password from ucenter_user_info where user_id = $id";
        $data = $this->sql->getRow($sql);
        if($passwd == $data['password'])
        {
            return true;die;
        }
        else
        {
            return false;die;
        }
    }

    public function editPasswd($id,$passwd)
    {
        $sql = "update ucenter_user_info set password ='$passwd' where user_id=$id";
        $code = $this->sql->exec($sql);
        if($code || $code  == 0)
        {
            return true;die;
        }
    }

    public function checkPayPasswd($id)
    {
      $sql = "select user_pay_passwd from pay_user_base where user_id = $id";
      $data = $this->sql->getRow($sql);
      if($data['user_pay_passwd'] == '')
      {
          return false;die;
      }
      else
      {
          return true;
      }
    }

    public function verifyPayPasswd($id,$passwd)
    {
        $sql = "select user_pay_passwd from pay_user_base where user_id = $id";
        $data = $this->sql->getRow($sql);
        if($data['user_pay_passwd'] == $passwd)
        {
            return true;die;
        }
        else
        {
            return false;
        }
    }

    public function editPayPasswd($id,$passwd)
    {
        $sql = "update pay_user_base set user_pay_passwd = '$passwd' where user_id = $id";
        $code = $this->sql->exec($sql);
        if($code || $code  == 0)
        {
            return true;die;
        }
        else
        {
            return false;
        }
    }
}