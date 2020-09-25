<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * Api接口, 让App等调用
 *
 *
 * @category   Game
 * @package    User
 * @author     banchangle <1427825015@qq.com>
 * @copyright  Copyright (c) 2017, 温庆腾
 * @version    1.0
 * @todo
 */
class Api_Paycen_PayInfoCtl extends Api_Controller
{
    /**
     *交易流水
     *
     * @access public
     */
    //获取卡片列表
    public function getCardBaseList()
    {
        $cardname  = request_string('cardName');   //卡片名称
        $beginDate = request_string('beginDate');
        $endDate   = request_string('endDate');
        $appid     = request_int('appid');

        $page = request_string('page', 1);
        $rows = request_string('rows', 20);

        $Card_BaseModel = new Card_BaseModel();
        $data           = $Card_BaseModel->getBaseList($cardname, $appid, $beginDate, $endDate, $page, $rows);


        $Card_InfoModel = new Card_InfoModel();
        foreach ($data['items'] as $key => $val)
        {
            $card_used_num                        = $Card_InfoModel->getCardusednumBy($val['card_id']);
            $data['items'][$key]['card_used_num'] = $card_used_num;

            $card_new_num                        = $Card_InfoModel->getCardnewnumBy($val['card_id']);
            $data['items'][$key]['card_new_num'] = $card_new_num;
        }

        if ($data)
        {
            $msg    = 'success';
            $status = 200;
        }
        else
        {
            $msg    = 'failure';
            $status = 250;
        }
        fb($data);
        $this->data->addBody(-140, $data, $msg, $status);
    }
    //实名验证中的数据
    function getInfoListIdentity() {
        $username  = request_string('userName');   //用户名称
          $cond_row = array();
          if($username){
                $cond_row['user_nickname:LIKE'] = '%' . $username . '%';
          }
		   $cond_row['user_identity_statu:not in'] = '0';
          $User_InfoModel = new User_InfoModel();
          $data           = $User_InfoModel->getInfoList($cond_row);
            if ($data)
            {
                $msg    = 'success';
                $status = 200;
            }
            else
            {
                $msg    = 'failure';
                $status = 250;
            }

        $this->data->addBody(-140, $data, $msg, $status);
    }

    //银行卡认证数据 17/10/20  senyzy
    function getBankCard(){
        $user_name = request_string('userName');//获取用户名称
        $User_InfoModel = new User_InfoModel();
        $Bank_BaseModel = new Bank_BaseModel();
        $User_CardModel = new User_CardModel();

        $cond_row = array();
        if($user_name){
            $cond_row['user_nickname:LIKE'] = '%' . $user_name . '%';
        }
        if($cond_row){
            $user_info = $User_InfoModel->getByWhere($cond_row);
        }
        $bank_base = $Bank_BaseModel->getByWhere();

        $flag = $user_info ? true:false;

        if($flag){
            $user_id = array();
            foreach($user_info as $key=>$value){
                $user_id[] = $key;
            }
            $user_bankCard = $User_CardModel->getUserCardList(array('user_id:IN'=>$user_id));
        }else{
            $user_bankCard = $User_CardModel->getUserCardList();
        }

        foreach($user_bankCard['items'] as $key=>$value){
            if($flag){
                $user_bankCard['items'][$key]['user_nickname'] = $user_info[$value['user_id']]['user_nickname'];
                $user_bankCard['items'][$key]['user_mobile'] = $user_info[$value['user_id']]['user_mobile'];
                $user_bankCard['items'][$key]['user_email'] = $user_info[$value['user_id']]['user_email'];
            }else{
                $user_base = $User_InfoModel->getOne($value['user_id']);
                $user_bankCard['items'][$key]['user_nickname'] = $user_base['user_nickname'];
                $user_bankCard['items'][$key]['user_mobile'] = $user_base['user_mobile'];
                $user_bankCard['items'][$key]['user_email'] = $user_base['user_email'];
            }
            $user_bankCard['items'][$key]['bank_name'] = $bank_base[$value['bank_id']]['bank_name'];
        }

        $this->data->addBody(-140,$user_bankCard);

    }

    // 展示info表中的数据
    function getInfoList() {
        $page = request_string('page', 1);
        $rows = request_string('rows', 20);
        $card_id  = request_string('cardName');   //卡片名称
        $beginDate = request_string('beginDate'); //卡片生成时间
        $User_InfoModel = new  Card_InfoModel();
        $data      = $User_InfoModel->getInfoList($card_id,$beginDate,$page,$rows);
        //从paycard分配数据到info表中************
        $Card_BaseModel = new Card_BaseModel();
        $datas          = $Card_BaseModel->getBaseList();

        foreach($datas['items'] as $key=>$val){
            $paydata[]=$val['card_id'];
        }
        $pdata=json_encode($paydata);
        $data['card_id']=$pdata;

        //        echo "<pre>";
        //        print_r($data['card_id']);
        //        echo "</pre>";
        //        exit();
        //*************************************
        if ($data)
        {
            $msg    = 'success';
            $status = 200;
        }
        else
        {
            $msg    = 'failure';
            $status = 250;
        }
        $this->data->addBody(-140, $data, $msg, $status);
    }

    //添加info表中的数据生成卡片
    public function add()
    {
        $card_id = request_int('card_id');

        $Buyer_TestModel           = new Card_InfoModel();
        $Card_BaseModel            = new Card_BaseModel();

        $card_base = $Card_BaseModel->getOne($card_id);
        $card_prize_row = json_decode($card_base['card_prize'],true);
         $money = $card_prize_row['m'];      //卡片价格
         $num = $card_base['card_num'];  //卡片最高数量

         $all_card = $Buyer_TestModel->getCardnumBy($card_id);

         $data                      = array();
         $data['card_id']           = $card_id;                  //卡id
         $length                  = request_string('card_sum');                //生成卡的数量

         if(($length+$all_card)>$num)
         {
             $msg    = '只能生成'.$num .'张卡片';
             $status = 250;
         }
         else
         {
             for ($i=1; $i<=$length;$i++){
                 $data['card_code']=$data['card_id'].Text_Password::create(4,unpronounceable,1234567890);
                 $data['card_password'] = Text_Password::create(6,unpronounceable,1234567890);
                 $data['card_money'] = $money;
                 $flag = $Buyer_TestModel->addInfo($data, true);
             }

             if ($flag)
             {
                 $msg    = 'failure';
                 $status = 250;
             }
             else
             {
                 $msg    = 'success';
                 $status = 200;
             }
         }

         $data = array();

         $this->data->addBody(-140, $data, $msg, $status);


    }
    /*
     * 删除购物卡
     */
    public function remove()
    {
        $Card_InfoModel     = new Card_InfoModel();

        $card_code = request_int('card_code');
        if ($card_code)
        {
            $flag = $Card_InfoModel->delCardByCid($card_code);


        }
        if ($flag)
        {
            $msg    = 'success';
            $status = 200;
        }
        else
        {

            $msg    = 'failure';
            $status = 250;

        }

        $data['card_code'] = $card_code;
        $this->data->addBody(-140, $data, $msg, $status);
    }

    //实名认证 获取用户信息
    function getEditInfo(){
        $user_id = request_int("user_id");
        $User_InfoModel = new User_InfoModel();
        $data           = $User_InfoModel->getOne($user_id);

        if ($data)
        {
            $msg    = 'success';
            $status = 200;
        }
        else
        {
            $msg    = 'failure';
            $status = 250;
        }
        $this->data->addBody(-140, $data, $msg, $status);
    }

    //获取修改银行卡数据  17/10/20 senyzy
    function getEditCard(){
        $card_id = request_int('card_id');
        $User_InfoModel = new User_InfoModel();
        $Bank_BaseModel = new Bank_BaseModel();
        $User_CardModel = new User_CardModel();

        $data = $User_CardModel->getOne($card_id);
        $data['deposit'] = $Bank_BaseModel->getOne($data['bank_id']);
        $data['user_info'] = $User_InfoModel->getOne($data['user_id']);
        if ($data)
        {
            $msg    = 'success';
            $status = 200;
        }
        else
        {
            $msg    = 'failure';
            $status = 250;
        }
        $this->data->addBody(-140, $data, $msg, $status);
    }

    function editInfoRow(){
        $user_id = request_int("user_id");
        $user_identity_statu = request_int("user_identity_statu");
        $User_InfoModel = new User_InfoModel();
        $flag           = $User_InfoModel->editInfo($user_id,array("user_identity_statu"=>$user_identity_statu));
        if ($flag)
        {
            $msg    = 'success';
            $status = 200;
        }
        else
        {
            $msg    = 'failure';
            $status = 250;
        }
        $data =array();
        $this->data->addBody(-140, $data, $msg, $status);
    }

    //修改银行卡状态提交  17/10/20 senyzy
    function editCardRow(){
        $card_id = request_int('card_id');
        $card_statu = request_int('card_statu');
        $User_CardModel = new User_CardModel();
        $flag = $User_CardModel->editUserCard($card_id,array('card_statu'=>$card_statu));
        if($flag){
            $msg    = 'success';
            $status = 200;
        }else{
            $msg    = 'failure';
            $status = 250;
        }
        $data = array();
        $this->data->addBody(-140,$data,$msg,$status);
    }

    //修改充值卡
    public function editBases()
    {
        $Card_InfoModel     = new Card_InfoModel();
        $card_code                 = request_int('card_code');
        $data                      = array();
        $data['card_id']           = request_int('card_id');                  //卡id
        $data['user_id']           = request_string('user_id');
        $data['card_code']         = request_string('card_code');
        $data['card_password']     = request_string('card_password');
        $data['card_fetch_time']   = request_string('card_fetch_time');
        $data['card_media_id']     = request_string('card_media_id');
        $data['server_id']         = request_string('server_id');
        $data['user_account']      = request_string('user_account');
        $data['card_time']         = request_string('card_time');
        $data['card_money']        = request_string('card_money');
        $data['card_froze_money']  = request_string('card_froze_money');
        $flag = $Card_InfoModel->editInfo($card_code, $data, false);

        if ($flag)
        {
            $msg    = 'success';
            $status = 200;
        }
        else
        {

            $msg    = 'failure';
            $status = 250;

        }
        $this->data->addBody(-140, $data, $msg, $status);

    }

}

?>