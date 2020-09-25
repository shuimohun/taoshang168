<?php
/**
 * 今日头条点击回调
 */

require_once '../configs/config.ini.php';

//android
//http://xxxx.xxx.com?adid=__AID__&cid=__CID__&imei=__IMEI__&mac=__MAC__&androidid=__ANDROIDID1__&os=__OS__&timestamp=__TS__&callback_url=__CALLBACK_URL__

//ios
//http://xxxx.xxx.com?adid=__AID__&cid=__CID__&idfa=__IDFA__&mac=__MAC__&os=__OS__&timestamp=__TS__&callback_url=__CALLBACK_URL__

$status = 'fail';
if($_REQUEST)
{
    $toutiao_cond['os'] = request_int('os');//0–Android； 1–iOS 2– WP； 3-Others
    if($toutiao_cond['os'] == 0)
    {
        $toutiao_cond['muid'] = request_string('imei');
    }
    else if($toutiao_cond['os'] == 1)
    {
        $toutiao_cond['muid'] = request_string('idfa');
    }

    if($toutiao_cond['muid'] && !empty($toutiao_cond['muid']))
    {
        $Toutiao = new Toutiao();

        $toutiao_row = $Toutiao->getByWhere($toutiao_cond);
        if(!$toutiao_row)
        {
            $toutiao_cond['callback_url'] = request_string('callback_url');
            $flag = $Toutiao->addToutiao($toutiao_cond);
            if($flag)
            {
                $status = 'success';
            }
        }
    }
}

echo $status;
?>