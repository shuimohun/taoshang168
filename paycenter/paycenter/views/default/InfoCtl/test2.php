<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>


<!--微信支付样式-->
<link href="<?=$this->view->css?>/weixin_pay.css" rel="stylesheet" />
<script>
    $(document).ready(function () {
        $("#payrowB .right .pic").hover(function () {
            $("#payrowB .animation").animate({ left: "270px", opacity: "1" }, 600);
        }, function () {
            $("#payrowB .animation").animate({ left: "-20px", opacity: "0" }, 600);
        });
    });
</script>

<div class="wrap">
    <div id="payrowB" class="area">
        <div class="left">
            <div class="myerwmpic"><img src="<?=$this->view->img?>/wtenpay-newhdtwo.cb2d2222.png"></div>
            <div class="price" info="39.90">应付金额：<strong><i>￥</i>39.90</strong></div>
            <div class="order"><p>订单号：U20170926113428539</p></div>
            <div class="order"><p>创建时间：2016-11-16 10:14:00</p></div>
            <div class="kefu"><i></i><h3>淘尚168客服热线：</h3><p>010-57798668</p></div>
        </div>
        <div class="right">
            <div class="wtenpay l">
                <div class="pic">
                    <img src="ts168_files/qrcode.png">
                </div>
                <div class="fb"><i></i>请使用微信扫描<br>二维码以完成支付</div>
            </div>
            <div class="animation" style="left: -20px; opacity: 0;"></div>
        </div>
        <input type="hidden" id="radePayId" value="bb865883751c39ef83d6dec73fe55db3">
    </div>
</div>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
