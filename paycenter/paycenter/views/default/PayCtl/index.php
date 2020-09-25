<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>
<!--微信支付样式-->
<link href="<?=$this->view->css?>/weixin_pay.css" rel="stylesheet" />


<div class="wrap">
    <div id="payrowB" class="area">
        <div class="left">
            <div class="myerwmpic"><img src="<?=$this->view->img?>/wtenpay-newhdtwo.cb2d2222.png"></div>
            <div class="price">应付金额：<strong><i>￥</i><?=$data['total_fee']?></strong></div>
            <div class="order"><p>订单号：<?=$data['out_trade_no']?></p></div>
            <div class="order"><p>创建时间：<?=$data['time']?></p></div>
            <div class="kefu"><i></i><h3>淘尚168客服热线：</h3><p>010-57798668</p></div>
        </div>
        <div class="right">
            <div class="wtenpay l">
                <div class="pic">
                    <img alt="模式二扫码支付" src="<?=YLB_Registry::get('base_url')?>/paycenter/api/qrcode.php?data=<?=$data['url_data']?>" />
                </div>
                <div class="fb"><i></i>请使用微信扫描二维码<br>以完成支付</div>
            </div>
            <div class="animation" style="left: -20px; opacity: 0;"></div>
        </div>
    </div>
</div>

<script>
    $(function(){
        /*$("#payrowB .right .pic").hover(function () {
            $("#payrowB .animation").animate({ left: "270px", opacity: "1" }, 600);
        }, function () {
            $("#payrowB .animation").animate({ left: "-20px", opacity: "0" }, 600);
        });*/
        setInterval(function(){$("#payrowB .animation").animate({ left: "270px", opacity: "1" }, 600);}, 500);
        setInterval(function(){check()}, 2000);
    })
    function check(){
        var url = "<?=$data['check_url']?>";
        var out_trade_no = '<?=$data['out_trade_no']?>';
        var param = {'code':out_trade_no};
        $.post(url, param, function(data){
            if(data.status == 200){
                alert("订单支付成功,即将跳转...");
                window.location.href = "<?=$data['return_url']?>";
            }else{
                console.log(data);
            }
        },'json');
    }
</script>

<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
