<?php
/**
 * 今日头条下载app激活
 */
require_once '../configs/config.ini.php';

$status = 250;
if(request_string('muid'))
{
    $Toutiao = new Toutiao();
    $toutiao_base = $Toutiao->getOneByWhere(array('muid'=>request_string('muid')));

    if($toutiao_base && $toutiao_base['event_type'] == -1 && $toutiao_base['callback_url'])
    {
        $url = $toutiao_base['callback_url'] . '&event_type=0';
        $res = get_url($url);

        YLB_Log::log("rr=" . json_encode($res), YLB_Log::INFO, 'toutiao');

        if($res && $res['ret'] == 0 && $res['msg'] == 'success')
        {
            $Toutiao->editToutiao($toutiao_base['id'],array('event_type'=>1));

            $status = 200;
        }
    }
}

echo $status;

?>