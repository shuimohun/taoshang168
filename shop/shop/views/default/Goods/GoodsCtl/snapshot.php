<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
include $this->view->getTplPath() . '/' . 'site_nav.php';
?>
    <script type="text/javascript" src="<?=$this->view->js?>/common.js"></script>
    <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.toastr.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="<?= $this->view->css ?>/base.css">
    <link rel="stylesheet" href="<?= $this->view->css ?>/snapshot.css">
    <link href="<?= $this->view->css ?>/tips.css" rel="stylesheet">
    <link href="<?= $this->view->css ?>/login.css" rel="stylesheet">

    <div class="wrapper">
        <div class="snapshot-goods-name"><em><?=_('商品SKU：')?><?=($snapshot['common_id'])?></em>
            <h1><?=($snapshot['goods_name'])?><span><?=_('交易快照')?></span></h1>
        </div>
        <div class="bbch-detail">
            <div id="bbch-goods-picture" class="bbch-goods-picture">
                <div class="jqthumb" title="" style="width: 300px; height: 300px; opacity: 1;">
                    <div style="width: 100%; height: 100%; background-image: url(<?=($snapshot['goods_image'])?>); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;"></div>
                </div><img alt="" src="<?=($snapshot['goods_image'])?>" style="display: none;"></div>
            <div class="bbch-goods-summary">

                <div class="snap">
                    <p><?=_('您正在查看订单编号：')?><strong><?=($snapshot['order_id'])?></strong> <?=_('的交易快照')?></p>
                    <p><?=_('该交易快照生成时间：')?><?=($snapshot['snapshot_create_time'])?></p>
                    <p><a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($snapshot['goods_id'])?>" target="_blank"><?=_('点此查看最新商品详情')?></a></p>
                    <p class="pimg"> <img src="<?=$this->view->img?>/poftl.png"></p>
                </div>
                <dl class="bbch-price">
                    <dt><?=_('成交价：')?></dt>
                    <dd><em><?=format_money($snapshot['goods_price'])?></em></dd>
                </dl>
                <dl>
                    <dt><?=_('规 格：')?></dt>
                    <dd><?=implode(' ',$snapshot['goods_spec'])?></dd>
                </dl>
                <dl>
                    <dt><?=_('运 费：')?></dt>
                    <dd><?=format_money($snapshot['freight'])?></dd>
                </dl>
                <?php if($shop_contract){?>
                    <div class="shop_contract">
                        <ul>
                            <?php foreach ($shop_contract as $key=>$value){?>
                                <li>
                                    <img src="<?=image_thumb($value['contract_type_logo'],22,22)?>"/>
                                    <?=($value['contract_type_name'])?>
                                </li>
                            <?php }?>
                        </ul>
                    </div>
                <?php }?>
            </div>
            <div class="bbch-info">
                <div class="title">
                    <h4><?=($shop_detail['shop_name'])?></h4>
                </div>
                <div class="content">
                    <div class="bbch-detail-rate">
                        <ul>
                            <li>
                                <h5><?=_('描述')?></h5>
                                <div class="equal" ><?=($shop_detail['shop_desc_scores'])?><i></i></div>
                            </li>
                            <li>
                                <h5><?=_('服务')?></h5>
                                <div class="equal" ><?=($shop_detail['shop_service_scores'])?><i></i></div>
                            </li>
                            <li>
                                <h5><?=_('物流')?></h5>
                                <div class="equal"><?=($shop_detail['shop_send_scores'])?><i></i></div>
                            </li>
                        </ul>
                    </div>
                    <div class="btns">
                        <a href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=index&typ=e&id=<?=($shop_detail['shop_id'])?>" class="goto"><?=_('进店逛逛')?></a>
                        <a onclick="collectShop(<?=($shop_detail['shop_id'])?>)" ><?=_('收藏店铺')?><span>(<em nctype="store_collect"><?=($shop_detail['shop_collect'])?></em>)</span></a></div>
                    <dl class="no-border">
                        <dt><?=_('公司名称：')?></dt>
                        <dd><?=($shop_company['shop_company_name'])?></dd>
                    </dl>
                    <dl>
                        <dt><?=('所&nbsp;在&nbsp;地：')?></dt>
                        <dd><?=($shop_company['shop_company_address'])?></dd>
                    </dl>
                </div>
            </div>
        </div>
        <div id="content" class="bbch-goods-layout">
            <div class="title"><span>订单详情</span></div>
            <div class="bbch-intro" id="ncGoodsIntro">
                <ul class="nc-goods-sort">
                    <li><?=_('订单编号：')?><?=($order_base['order_id'])?></li>
                    <li><?=_('下单时间：')?><?=($order_base['order_create_time'])?></li>
                    <li><?=_('店铺名称：')?><?=($order_base['shop_name'])?></li>
                    <li><?=_('买家：')?><?=($order_base['buyer_user_name'])?></li>
                    <li><?=_('卖家：')?><?=($order_base['seller_user_name'])?></li>
                </ul>
                <div class="bbch-goods-info-content">
                </div>
            </div>
        </div>
    </div>

    <!-- 登录遮罩层 -->
    <div id="login_content" style="display:none;">
        <div>
            <div class="login-form">
                <div class="login-tab login-tab-r">
                    <a href="javascript:void(0)" class="checked">
                        账户登录
                    </a>
                </div>
                <div class="login-box" style="visibility: visible;">
                    <div class="mt tab-h">
                    </div>
                    <div class="msg-wrap" style="display:none;">
                        <div class="msg-error"></div>
                    </div>
                    <div class="mc">
                        <div class="form">
                            <form id="formlogin" method="post" onsubmit="return false;">

                                <div class="item item-fore1">
                                    <label for="loginname" class="login-label name-label"></label>
                                    <input id="loginname" class="lo_user_account" type="text" class="itxt" name="loginname" tabindex="1" autocomplete="off" placeholder="邮箱/用户名/已验证手机">
                                    <span class="clear-btn"></span>
                                </div>
                                <div id="entry" class="item item-fore2" style="visibility: visible;">
                                    <label class="login-label pwd-label" for="nloginpwd"></label>
                                    <input type="password" class="lo_user_password" id="nloginpwd" name="nloginpwd" class="itxt itxt-error" tabindex="2" autocomplete="off" placeholder="密码">
                                    <span class="clear-btn"></span>
                                    <span class="capslock" style="display: none;"><b></b>大小写锁定已打开</span>
                                </div>
                                <div class="item item-fore5">
                                    <div class="login-btn">
                                        <a href="javascript:;" onclick="loginSubmit()" class="btn-img btn-entry" id="loginSubmit" tabindex="6">登&nbsp;&nbsp;&nbsp;&nbsp;录</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="coagent" style="display: block; visibility: visible;">

                    <ul>
                        <li><a href="<?=YLB_Registry::get('ucenter_api_url')?>?ctl=Login&act=reset">忘记密码</a></li>
                        <li class="extra-r">
                            <div>
                                <div class="regist-link pa"><a href="<?=YLB_Registry::get('url')?>?ctl=Login&met=reg" target="_blank"><b></b>立即注册</a></div>
                            </div>
                        </li>
                    </ul>
                </div>
                <a class="btn-close">×</a>
            </div>
        </div>
        <span class="mask"></span>
    </div>
    <script>
        $(".btn-close").click(function ()
        {
            $("#login_content").hide();

            $(".msg-wrap").hide();
            $('.lo_user_account').val("");
            $('.lo_user_password').val("");
        });

        $("#formlogin").keydown(function(e){
            var e = e || event,
                keycode = e.which || e.keyCode;

            if(keycode == 13)
            {
                loginSubmit();
            }
        });

        //检验验证码是否正确

        //登录按钮
        function loginSubmit()
        {
            var user_account = $('.lo_user_account').val();
            var user_password = $('.lo_user_password').val();

            $("#loginsubmit").html('正在登录...');

            login_url = UCENTER_URL+'?ctl=Api&met=login&user_account='+user_account+'&user_password='+user_password;

            login_url = login_url + '&from=shop&callback=' + encodeURIComponent(window.location.href);

            window.location.href = login_url;

        }
    </script>

<script>
    //收藏店铺
    window.collectShop = function(e){
        if ($.cookie("key"))
        {
            $.post(SITE_URL  + '?ctl=Shop&met=addCollectShop&typ=json',{shop_id:e},function(data)
            {
                if(data.status == 200)
                {
                    Public.tips.success(data.data.msg);
                    //$.dialog.alert(data.data.msg);
                }
                else
                {
                    Public.tips.error(data.data.msg);
                    //$.dialog.alert(data.data.msg);
                }
            });
        }
        else
        {
            $("#login_content").show();
        }
    }
</script>


<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>