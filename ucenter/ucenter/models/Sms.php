<?php

class Sms
{
	public static function send($mob, $content, $tple_id=null)
	{
        if (is_array($content))
        {
            $content = encode_json($content);
        }
        $ch = curl_init();
        $apikey = "29e9af959c0b29fb3697bc2f913a5f48";
        $mobile = $mob;
        $text=$content;
        $data=array('text'=>$text,'apikey'=>$apikey,'mobile'=>$mobile);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt ($ch, CURLOPT_URL, 'https://sms.yunpian.com/v2/sms/single_send.json');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        $json_data = curl_exec($ch);
        curl_close($ch);
        return $json_data;
	}
}

?>