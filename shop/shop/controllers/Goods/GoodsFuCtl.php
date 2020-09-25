<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}
/**
 * @author     jiaxiaolei 送福免单活动
 */

class Goods_GoodsFuCtl extends Controller
{
    public function __construct(&$ctl, $met, $typ)
    {
        parent::__construct($ctl, $met, $typ);


    }

    /*
     * @Jiaxl
     * web送福免单页
     * 18.07.06
     * */
    public function getFuGoods(){

            $page                    = request_string("page",1);
            $rows                    = request_string("rows",15);
            $uid                     = Perm::$userId;
            $Fu_BaseModel               = new Fu_BaseModel();
            $Fu_RecordModel             = new Fu_RecordModel();
            $fu_cond_row['fu_state:<']  = $Fu_BaseModel::CANCEL;
            $fu_order_row['fu_sort']    = 'DESC';
            $data                       = $Fu_BaseModel->getFuList($fu_cond_row,$fu_order_row,$page,$rows);

            if($uid)
            {
                foreach ($data['items'] as $key=>$val)
                {
                    if( $val['fu_stock'] >0 && $val['fu_state'] ==2 )
                    {
                        unset($data['items'][$key]);
                    }
                    else
                    {
                        $cond_row['user_id']            = $uid;
                        $cond_row['goods_id']           = $val['goods_id'];
                        $order_row['fu_record_time']    = 'DESC';
                        $status                         = $Fu_RecordModel->getFuRecordList($cond_row,$order_row)['items'][0];

                        if($status)
                        {
                            if ($status['status'] == $Fu_RecordModel::NORMAL && $status['fu_end_time'] < get_date_time() )
                            {
                                $flag = $Fu_RecordModel->editFuRecord($status['fu_record_id'],['status'=>$Fu_RecordModel::OVER]);
                                if($flag)
                                {
                                    $data['items'][$key]['fu_status'] = $Fu_RecordModel::OVER;
                                }
                            }
                            else
                            {
                                $data['items'][$key]['fu_status'] = $status['status'];
                                $data['items'][$key]['fu_end_time'] = $status['fu_end_time'];
                            }
                        }
                        else
                        {
                            $data['items'][$key]['fu_status'] = 0;
                        }
                    }
                }
            }
            else
            {
                foreach ($data['items'] as $key=>$val)
                {
                    if( $val['fu_stock'] >0 && $val['fu_state'] ==2 )
                    {
                        unset($data['items'][$key]);
                    }
                    else
                    {
                        $data['items'][$key]['fu_status'] = 0;
                    }

                }
            }

            foreach ($data['items'] as $key=>$val )
            {
                $date = strtotime( get_date_time() );
                if( $val['fu_status'] == 5 && $val['fu_end_time'] )
                {
                    $endTime = strtotime( $val['fu_end_time'] );
                    $diffTime = $date - $endTime;
                    if( $diffTime > 60*10 )
                    {
                        $data['items'][$key]['fu_status'] = 0;
                    }
                }
                $num_cond_row['goods_id']              = $val['goods_id'];
                $num_cond_row['fu_id']                 = $val['fu_id'];
                $data['items'][$key]['sale_countFu']   = $Fu_RecordModel->getRowCount( $num_cond_row );
            }
            $data['items'] = array_values($data['items']);
            if($this->typ == 'json')
            {
                $this->data->addBody(-140,$data);
            }
    }

    /*
     * @Jiaxl
     * web送福免单注册页
     * 18.07.06
     * */
    function getRecord(){
        if( Perm::$userId ) {
            $uid                = Perm::$userId;
        }
            $goods_id           = request_string("gid");
            $fu_id              = request_string("fu_id");
            $Fu_BaseModel       = new Fu_BaseModel();
            $Fu_RecordModel     = new Fu_RecordModel();
            $User_InfoModel     = new User_InfoModel();
            $UserAddressModel   = new User_AddressModel();
            $goods_cond_row['goods_id'] = $goods_id;
            $goods_cond_row['fu_id']    = $fu_id;
            $goodsData                  = $Fu_BaseModel->getOneFuByWhere($goods_cond_row);
            $register                   = $goodsData['is_register'];
            $data                       = array();
            //用户是否有默认收货地址
            $user_address = $UserAddressModel->getKeyByWhere([
                'user_id'               => $uid,
                'user_address_default'  => 1
            ]);

            if ($user_address) {
                $data['default_adress'] = 1;
            } else {
                $data['default_adress'] = 0;
            }
            //获取是否有继续参加活动的权利
            $FuRecordModel = new Fu_RecordModel();
            $sql = 'SELECT COUNT(*) FROM `ylb_fu_record` a LEFT JOIN `ylb_order_base` b ';
            $sql .= 'ON a.order_id = b.order_id ';
            $sql .= 'WHERE a.goods_id = ' . $goods_id . ' AND a.user_id = ' . Perm::$userId . ' AND a.order_id <> "" ';
            $sql .= 'AND b.`order_status` >= ' . Order_StateModel::ORDER_WAIT_PAY . ' AND b.`order_status` <= ' . Order_StateModel::ORDER_WAIT_CONFIRM_GOODS;
            $row_count = $FuRecordModel->selectSql($sql);
            if ($row_count) {
                $row_count = current($row_count);
                $row_count = array_shift($row_count);
            }

            if ($row_count > 0) {
                $data['fu_order_flag'] = 1;
            } else {
                $data['fu_order_flag'] = 0;
            }
            /*总免单数*/
            $num_cond_row['goods_id']   = $goods_id;
            $num_cond_row['fu_id']      = $fu_id;
            $r_count                    = $Fu_RecordModel->getRowCount($num_cond_row);

            /*获取该免单用户信息 最多十个*/
            $uData                      = $Fu_RecordModel->listByWhere($num_cond_row, array(), 1, 10);
            $uidData                    = array_column($uData['items'], 'user_id');
            $u_cond_row['user_id:IN']   = $uidData;
            $userInfo                   = $User_InfoModel->getByWhere($u_cond_row);

            /*获取用户参加活动记录*/
            $R_cond_row['goods_id']     = $goods_id;
            $R_cond_row['user_id']      = $uid;
            $R_cond_row['fu_id']        = $fu_id;
            $R_order_row['fu_record_time'] = 'DESC';
            $recordData                 = $Fu_RecordModel->getFuRecordList($R_cond_row, $R_order_row)['items'][0];

            if( !empty( $recordData ) )
            {
                $date = strtotime( get_date_time() );
                if( $recordData['status'] == 5 && $recordData['fu_end_time'] )
                {
                    $endTime = strtotime( $recordData['fu_end_time'] );
                    $diffTime = $date - $endTime;
                    if( $diffTime > 60*10 )
                    {
                        $recordData['status'] = 0;
                        $recordData['fu_base']['weixin'] = 0;
                        $recordData['fu_base']['weixin_timeline'] = 0;
                        $recordData['fu_base']['sqq'] = 0;
                        $recordData['fu_base']['qzone'] = 0;
                        $recordData['fu_base']['tsina'] = 0;
                    }
                };
            }

            $s_totalFu = '';
            foreach ($recordData['fu_base'] as $key => $val) {
                $s_totalFu += $val;
            }
            $data['margin2']['goods_image']             = $goodsData['goods_image'];
            $data['margin2']['goods_id']                = $goodsData['goods_id'];
            $data['margin2']['goods_name']              = $goodsData['goods_name'];
            $data['margin2']['goods_price']             = $goodsData['goods_price'];
            $data['margin2']['goods_spec']              = $goodsData['goods_spec'];
            $data['margin2']['sale_countFu']            = $r_count;
            $data['margin2']['end_time']                = $recordData['fu_end_time'];
            $data['margin2']['fu_state']                = $goodsData['fu_state'];
            $data['margin2']['fu_name']                 = $goodsData['fu_name'];
            $total_share                                = $goodsData['fu_base'];
            $r_share                                    = $recordData['fu_base'];
            $r_share['total_weixin']                    = $total_share['weixin'];
            $r_share['total_weixin_timeline']           = $total_share['weixin_timeline'];
            $r_share['total_sqq']                       = $total_share['sqq'];
            $r_share['total_qzone']                     = $total_share['qzone'];
            $r_share['total_tsina']                     = $total_share['tsina'];
            $data['bless_user']['user_info']            = array_values($userInfo);
            $data['bless_user']['sale_countFu']         = $r_count;
            $data['bless_user']['Share']                = $r_share;
            $data['bless_user']['status']               = $recordData['status'] ? $recordData['status'] : 0;
            if( $recordData['fu_end_time'] )
            {
                $data['bless_user']['fu_end_time']          = $recordData['fu_end_time'];
            }
            $data['bless_user']['register']             = $register;
            $data['bless_user']['fu_record_id']         = $recordData['fu_record_id'] ? $recordData['fu_record_id'] : '';
            if (!empty($recordData['fu_share_base'])) {
                $data['bless_user']['fu_share_base']    = $recordData['fu_share_base'];
            }
            if (!$recordData['status']) {
                $data['bless_user']['total_fu']         = $goodsData['fu_total_times'];
                $data['bless_user']['total_price']      = $goodsData['goods_price'];
            } else {
                if ($recordData['status'] != $Fu_RecordModel::OVER && $recordData['status'] != $Fu_RecordModel::USED) {
                    $data['bless_user']['cha_fu']       = $goodsData['fu_total_times'] - $s_totalFu;
                    $data['bless_user']['buy_price']    = $goodsData['goods_price'] - ($recordData['click_count'] * $recordData['unit_price']);
                } else {
                    $data['bless_user']['total_fu']     = $goodsData['fu_total_times'];
                    $data['bless_user']['total_price']  = $goodsData['goods_price'];
                }
            }

            if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false)
            {
                //微信内分享实例化
                $url                = YLB_Registry::get('shop_wap_url') . '/tmpl/sendbless_register.html?gid=' . $goods_id.'&fu_id='.$fu_id;
                $jssdk              = new Api_JSSDK("wx7c9bd0e5a3b798c3", "420fe679653100b366150f70a5afdb3c", $url);
                $signPackage        = $jssdk->GetSignPackage();
                $data['wxConfig']   = array(
                    'appId'         => $signPackage['appId'],
                    'timestamp'     => $signPackage['timestamp'],
                    'nonceStr'      => $signPackage['nonceStr'],
                    'signature'     => $signPackage['signature']
                );
            }
            $msg    = _('success');
            $status = 200;

        if( $this->typ == 'json' )
        {

            $this->data->addBody( -140,$data,$msg,$status );
        }
    }

    /* *
     * @Jxl
     * web用户送福详情页
     * 18.07.14
     *
     */

    function getSendBlessDetail() {

        $user_id             = Perm::$userId;
        $Fu_BaseModel        = new Fu_BaseModel();
        $Fu_RecordModel      = new Fu_RecordModel();
        $record_cond_row['user_id'] = $user_id;
        $record_order_row['fu_record_time'] = 'DESC';
        $record_data         = $Fu_RecordModel->getByWhere( $record_cond_row,$record_order_row );
        $record_data = array_values( $record_data );
        if($record_data)
        {
            foreach ( $record_data as $k => $v )
            {
                $record_data[$k]['fu']              = $Fu_BaseModel->getFuById( $v['fu_id'] );
                $num_cond_row['goods_id']           = $v['goods_id'];
                $num_cond_row['fu_id']              = $v['fu_id'];
                $record_data[$k]['total_Person']    = $Fu_RecordModel->getRowCount( $num_cond_row );
                if( $v['status'] == 2 || $v['status'] == 4 )
                {
                    $record_data[$k]['now_buy_price'] = 0;
                }
                else if( $v['status'] ==3 || $v['status'] ==1 )
                {

                    $record_data[$k]['now_buy_price'] = $record_data[$k]['fu']['goods_price']-( $v['click_count'] * $v['unit_price'] );
                }
            }
            $msg     = 'success';
            $status  = 200;
        }
        else
        {
            $msg     = '无数据';
            $status  = 200;
        }
        if( $this->typ == 'json' )
        {
            $this->data->addBody(-140,$record_data,$msg,$status);
        }
    }

    /* *
     * @Jaxiaolei 2018.08.09
     * @param $uid用户id
     * @param $fu_id商品活动id
     * @param $gid商品id
     * @return $data 返回查询数据
     */
    function recordResult() {

        $Fu_RecordModel         = new Fu_RecordModel();
        $user_id                = request_string("uid");
        $goods_id               = request_string("gid");
        $fu_id                  = request_string("fu_id");
        $cond_row['user_id']    = $user_id;
        $cond_row['goods_id']   = $goods_id;
        $cond_row['fu_id']      = $fu_id;
        $order_row['fu_record_time']  = 'DESC';
        $recordData             = $Fu_RecordModel->getFuRecordList( $cond_row,$order_row )['items'][0];
        $data                   = array();
        if( !empty( $recordData ) )
        {
            $data['share_result']   = $recordData;
            $msg                    = _("success");
            $status                 = 200;
        }
        else
        {
            $msg                    = _("fail");
            $status                 = 250;
        }
        if( $this->typ == 'json' )
        {
            $this->data->addBody( -140, $data, $msg, $status );
        };
    }

}






