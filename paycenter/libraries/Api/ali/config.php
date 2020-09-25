<?php
$config = array (
    //应用ID,您的APPID。
    'app_id' => "2016112903565292",

    //商户私钥
    'merchant_private_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAwCmv+ojc5wRDx3g4CUKt/9GzzyD9h8WKC6XWbY1C5l+Z8Tn7Ffcq7Rs0V3I0hrOq6dP1J9aphmRM6ksMECFksTvglTb3JEfhaAB2OzdIWVrNiHcMvIUY7C9CgRjS0uIBNL9RKYkEHo4pcaVGwCGEVVdr9vOnQQa2RlwwkmoaDZMTwpIy+KOzTWf7us1Wa14A5BgoznIqRdS68S8AzREE13JVl6xO2S2pDHjIbmQ1S9ZOBOwEOg7NClzLgJ8F7mZ6KK9ZusUP6vBKu5XGAhTuCMfBWICOay474dlGiVJwU3CqKIqvPBMjDnhj/6yKbEgJPjjMBnx4kXN9sFdO+JgIxwIDAQAB",

    //异步通知地址
    //'notify_url' => YLB_Registry::get('base_url') . "/paycenter/api/payment/ali/notify_url.php",

    //同步跳转
    //'return_url' => YLB_Registry::get('base_url') . "/paycenter/api/payment/ali/return_url.php",

    //编码格式
    'charset' => "UTF-8",

    //签名方式
    'sign_type'=>"RSA2",

    //支付宝网关
    'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

    //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAnN1ijU8jNnHQHBR/GaZ7gZv1b1Jd87/+Fpl2vCSc+sQGn/OcDd37VWKfNzHSb8FtcXKS9CxwkWfxJfF1WFihLVgvmuIdGsXXcCF1cujuHKsTeKSeT5JJO1Js+xmuX8ebT0IXhxQKrVXdU76BGcnGKTVumvKuZGw1R1lTr0jfjfG0U8/994IrYiV3vLbfVQzxhyOhBaJg7XaY00wJtQ8ZWnDctyJ/wWSVS3nzaQAJL+kedLHoiHnl+fkWXhZ66dE2QwIhtgJ0e78I1gykNwJ4135Oxjw10RQhJIZOrwvjX0vH2q8DZN6ifGquxGyFhIjBGUZFbn3U2HxfmQKL9zQ0gQIDAQAB",
);