<?php
/**
 * @author weidp
 */

require_once '../configs/config.ini.php';

//获取选择的快递
$channel = Web_ConfigModel::value('logistics_channel');

$order_id   = request_string('order_id');  //订单编号
$express_id = request_string('express_id'); //物流公司编码
$nu         = request_string('shipping_code'); //物流单号
$typ        = request_string('typ');//移动端专用物流接口
$ExpressModel = new ExpressModel();
$express_row = $ExpressModel->getOne($express_id);

if('kuaidi100' == $channel)
{


    $api_id = Web_ConfigModel::value('kuaidi100_app_id');
    $api_sceret = Web_ConfigModel::value('kuaidi100_app_key');

    if($express_id && $nu)
    {

        $express_row = $ExpressModel->getOne($express_id);

        if($express_row)
        {

            $express_pinyin = $express_row['express_coding'];

            $str = lookorder($express_pinyin, $nu, $api_id, $api_sceret);

            if(isset($str['status']) && $str['status'] == 200 && $typ == 'json')
            {
                $content = array();
                $content['express_name'] = $express_row['express_name'];
                $content['shipping_code'] = $nu;
                $content['message'] = 'success';
                $content['status']  = $str['status'];
                $content['data'] = $str['data'];

            }
            else if(isset($str['returnCode']) && $str['returnCode'] == 500)
            {
                $content = array();
                $content['status'] = '250';
                $content['message'] = 'error';
                $content['data'] = $str['message'];

            }
            else
            {
                $content = array();
                $content['status'] = '250';
                $content['message'] = 'error';
                $content['data'] = '暂时没有物流信息！';

            }

            echo json_encode($content);
        }
        else
        {
            $content = array();
            $content['status'] = '250';
            $content['message'] = 'error';
            $content['data'] = '暂时没有物流信息！';
            echo json_encode($content);
        }
    }
}
else if('kuaidiniao' == $channel)
{
    Web_ConfigModel::value('kuaidiniao_status');

    $e_business_id = Web_ConfigModel::value('kuaidiniao_e_business_id');
    $app_key = Web_ConfigModel::value('kuaidiniao_app_key');

    $express_code = $express_row['express_pinyin'];

    $api = new Api_KdNiao($e_business_id, $app_key);

    $request_rows =
        array (
            'OrderCode' =>   $order_id,  //订单编号
            'ShipperCode' => $express_code, //物流公司编码
            'LogisticCode' => $nu            //物流单号
        );

    $rs_str =  $api->getOrderTracesByJson($request_rows);

    if($rs_str && isset($rs_str['Success']) && $rs_str['Success'] && $typ='json')
    {
        $content = array();
        $content['status'] = '200';
        $content['message'] = 'success';
        $content['shipping_code'] = $nu;
        $content['express_name'] = $express_row['express_name'];
        $data = array();
        foreach (array_reverse($rs_str['Traces'])  as $key => $val)
        {
            $data[$key]['context'] = $val['AcceptStation'];
            $data[$key]['time'] = $val['AcceptTime'];
        }
        $content['data'] = $data;
    }
    else
    {
        if($rs_str['Reason'])
        {
            $content = array();
            $content['status'] = '250';
            $content['message'] = 'error';
            $content['data'] = $rs_str['Reason'];

        }
        else
        {
            $content = array();
            $content['status'] = '250';
            $content['message'] = 'error';
            $content['data'] = '暂时没有物流信息！';
        }
    }
    echo json_encode($content);

}




function lookorder($com, $nu, $api_id, $api_sceret)
{
    //爱查快递
    $url2="http://api.ickd.cn/?com=".$com."&nu=".$nu."&id=".$api_id."&secret=".$api_sceret."&type=html&encode=utf8";

    //快递100  show=[0|1|2|3]
    /*$url2="http://api.kuaidi100.com/api?id=$api_id&com=$com&nu=$nu&valicode=[]&show=2&muti=1&order=desc";
    $con = file_get_contents($url2);*/

    $post_data = array();
    $post_data["customer"] = "$api_id";
    $key= "$api_sceret" ;
    $post_data["param"] = '{"com":"'.$com.'","num":"'.$nu.'"}';

    $url='http://poll.kuaidi100.com/poll/query.do';
    $post_data["sign"] = md5($post_data["param"].$key.$post_data["customer"]);
    $post_data["sign"] = strtoupper($post_data["sign"]);
    $o="";
    foreach ($post_data as $k=>$v)
    {
        $o.= "$k=".urlencode($v)."&";		//默认UTF-8编码格式
    }
    $post_data=substr($o,0,-1);
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

    $result = curl_exec($ch);
    $data = str_replace("\"",'"',$result );
    $data = json_decode($data,true);
    return $data;
}

