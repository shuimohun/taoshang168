<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
} ?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>

<link rel="stylesheet" type="text/css" href="<?=$this->view->css?>/mydialog.css" />
<div class="main_cont wrap clearfix">
	<div class="account_left fl">

        <?php if($data['shop_company']){ ?>
            <div class="account_mes">
                <h4><?=_('我的账户')?></h4>
                <table class="account_table">
                    <tbody>
                    <!--<tr>
                        <td class="w150"><?/*=_('公司名称：')*/?></td>
                        <td>
                            <?/*=$data['shop_company']['shop_company_name']*/?>
                        </td>
                    </tr>-->
                    <tr>
                        <td class="w150"><?=_('银行开户名：')?></td>
                        <td>
                            <?=$data['shop_company']['bank_account_name']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="w150"><?=_('公司银行账号：')?></td>
                        <td>
                            <?=$data['shop_company']['bank_account_number']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="w150"><?=_('开户银行名称：')?></td>
                        <td>
                            <?=$data['shop_company']['bank_name']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="w150"><?=_('开户银行支行联行号：')?></td>
                        <td>
                            <?=$data['shop_company']['bank_code']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="w150"><?=_('开户银行支行所在地：')?></td>
                        <td>
                            <?=$data['shop_company']['bank_address']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="w150"><?=_('开户银行许可证电子版：')?></td>
                        <td>
                           <img src="<?=$data['shop_company']['bank_licence_electronic']?>" width="300px"/>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        <?php }else{?>
            <div class="account_mes">
                <h4><?=_('支付宝')?></h4>
                <table class="account_table">
                    <tbody>
                    <tr>
                        <td><?=_('账号')?></td>
                        <td>
                            <?php if($user_info['user_alipay']){?>
                                <?=$user_info['user_alipay']?>
                            <?php }else{?>
                                <?=('未绑定')?>
                            <?php }?>
                        </td>
                        <td class="account_ahref">
                            <?php if($user_info['user_alipay']){?>
                                <a class="share" data-param="alipay_edit" data-id="<?=$user_info['user_alipay']?>" data-title="修改支付宝账号"><?=_('修改')?></a>
                            <?php }else{?>
                                <a class="share" data-param="alipay_add" data-title="绑定支付宝账号"><?=_('绑定')?></a>
                            <?php }?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="account_mes">
                <h4><?=_('微信')?></h4>
                <table class="account_table">
                    <tbody>
                    <tr>
                        <td><?=_('账号')?></td>
                        <td>
                            <?php if($user_info['user_wechat']){?>
                                <?=$user_info['user_wechat']?>
                            <?php }else{?>
                                <?=('未绑定')?>
                            <?php }?>
                        </td>
                        <td class="account_ahref">
                            <?php if($user_info['user_wechat']){?>
                                <a class="share" data-param="wechat_edit"  data-id="<?=$user_info['user_wechat']?>" data-title="修改微信账号"><?=_('修改')?></a>
                            <?php }else{?>
                                <a class="share" data-param="wechat_add" data-title="绑定微信账号"><?=_('绑定')?></a>
                            <?php }?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="account_mes">
                <h4><?=_('我的银行卡')?></h4>
                <table class="account_table">
                    <thead>
                    <tr>
                        <td>银行</td>
                        <td>卡号</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($user_card){?>
                        <?php foreach ($user_card as $key=>$val){ ?>
                            <tr>
                                <td><?=$val['bank']['bank_name']?></td>
                                <td><?=$val['bank_account_number']?></td>
                                <td class="account_ahref">
                                    <a class="share" data-param="card_edit" data-id="{card_id:'<?=$val['card_id']?>',bank_id:'<?=$val['bank_id']?>',bank_account_number:'<?=$val['bank_account_number']?>'}" data-title="修改银行卡"><?=_('修改')?></a>
                                </td>
                            </tr>
                        <?php }?>
                    <?php }?>
                    <tr>
                        <td colspan="3" class="add_card"><a class="share" data-param="card_add" data-title="添加银行卡">+新的银行卡</a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        <?php }?>

	</div>
	<div class="account_right fr">
		<div class="account_right_con">
			<ul class="cert_instructions">
				<li>
					<h5><?=_('什么是实名认证？')?></h5>
					<p><?=_('财付宝实名认证是淘尚168商城提供的一项身份识别服务。通过财付宝实名认证后相当于拥有了一张互联网身份证，可以在淘尚168商城电子商务网站购物、开店、出售商品；增加财付宝账户拥有者的信用度。')?></p>
				</li>
				<li>
					<h5><?=_('为什么要实名认证')?></h5>
					<p><?=_('只有通过身份通实名身份认证的用户，才能使用淘尚168商城各项服务。为保护用户隐私，用户之间只有在得到对方授权的情况下才可以交换实名认证信息。为保护用户信息，用户提供的身份证信息，将直接传输到“全国公民身份信息系统”系统数据库中，并即时返回认证结果，淘尚168商城并不保留用户的身份证号码。')?></p>
				</li>
				<li>
					<h5><?=_('温馨提示')?></h5>
					<p><?=_('通过实名认证表示该用户提交了真实存在的身份证，但我们无法完全确认该证件是否为其本人持有，您还需要通过和对方交换实名信息来获取对方全名及身份证照片，并与对方照片或本人进行比对，核实对方是否该身份证的持有人。实名认证也不能代表除身份证信息外的其他信息是否真实。因此，淘尚168商城提醒广大用户在使用过程中，须保持谨慎理性，增强防范意识。')?></p>
				</li>
			</ul>
		</div>
	</div>
</div>

    <div id="sharecover" style="display:none;">
        <span class="mask"></span>
    </div>
    <div id="code">
        <div class="close">
            <span class="dialog_title">修改</span>
            <a href="javascript:void(0)" id="closebt"><img src="<?= $this->view->img ?>/close.png"></a>
        </div>
        <div class="sharetxt">
            <table class="account_table">
                <tbody>
                    <input type="hidden" class="type" id="type" value="">
                    <input type="hidden" class="card_id" id="card_id" value="">
                    <tr class="alipay_wechat">
                       <td>账号</td><td><input type="text" name="user_account" id="user_account" class="text w82" value=""></td>
                    </tr>
                    <tr class="card">
                        <td>银行</td>
                        <td>
                            <select name="bank_id" id="bank_id">
                                <?php foreach ($bank_list as $key => $val){?>
                                    <option value="<?=$val['bank_id']?>"><?=$val['bank_name']?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr class="card">
                        <td>卡号</td><td><input type="text" name="bank_account_number" id="bank_account_number" class="text w200" value="" placeholder="<?=_('输入银行卡号')?>" ></td>
                    </tr>
                    <tr>
                        <td>手机</td><td><?=$user_info['user_mobile_hide']?></td>
                    </tr>
                    <tr>
                        <td>验证码</td>
                        <td>
                            <input type="text" name="yzm" id="yzm" class="text w82" value="" >
                            <input type="button" class="send" data-type="mobile" value="获取验证码" style="cursor: pointer;"  />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="add_card dialog_add_card">
                            <input type="submit" value="提交" class="submit" style="cursor: pointer;"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script>

        var icon = '<i class="iconfont icon-exclamation-sign"></i>';
        flag = false;
        $(function() {
            $('.share').click(function() {
                $('#code').center();
                $('#sharecover').show();

                //eval('var _data = ' + $(this).data('param'));
                $('.dialog_title').html($(this).data('title'));
                var type = $(this).data('param');

                $('#type').val(type);
                if(type == 'card_add' ){
                    $('#bank_account_number').val('');
                    $('.card').show();
                    $('.alipay_wechat').hide();
                }else if(type == 'card_edit'){
                    eval('var _data = ' + $(this).data('id'));

                    var card_id = _data.card_id;
                    var bank_id = _data.bank_id;
                    var bank_account_number = _data.bank_account_number;

                    $('#card_id').val(card_id);
                    $('#bank_id').val(bank_id);
                    $('#bank_account_number').val(bank_account_number);


                    $('.card').show();
                    $('.alipay_wechat').hide();
                }else{

                    var account = $(this).data('id');
                    $('#user_account').val(account);
                    $('.alipay_wechat').show();
                    $('.card').hide();
                }


                var top = document.body.scrollTop;
                $("#code").css({top:top+300});
                $('#code').fadeIn();
            });
            $('#closebt').click(function() {
                $('#code').hide();
                $('#sharecover').hide();
            });
            $('#sharecover').click(function() {
                $('#code').hide();
                $('#sharecover').hide();
            });

            jQuery.fn.center = function(loaded) {
                var obj = this;
                body_width = parseInt($(window).width());
                body_height = parseInt($(window).height());
                block_width = parseInt(obj.width());
                block_height = parseInt(obj.height());

                left_position = parseInt((body_width / 2) - (block_width / 2) + $(window).scrollLeft());
                if (body_width < block_width) {
                    left_position = 0 + $(window).scrollLeft();
                };

                top_position = parseInt((body_height / 2) - (block_height / 2) + $(window).scrollTop());
                if (body_height < block_height) {
                    top_position = 0 + $(window).scrollTop();
                };

                if (!loaded) {

                    obj.css({
                        'position': 'absolute'
                    });
                    obj.css({
                        'top': ($(window).height() - $('#code').height()) * 0.5,
                        'left': left_position
                    });
                    $(window).bind('resize', function() {
                        obj.center(!loaded);
                    });
                    $(window).bind('scroll', function() {
                        obj.center(!loaded);
                    });

                } else {
                    obj.stop();
                    obj.css({
                        'position': 'absolute'
                    });
                    obj.animate({
                        'top': top_position
                    }, 200, 'linear');
                }
            };

            $(".send").click(function(){
                msg = "获取验证码";
                $(".send").attr("disabled", "disabled");
                $(".send").attr("readonly", "readonly");
                $(".send").css('color','#666');
                t = setTimeout(countDown,1000);
                var url = SITE_URL +'?ctl=Info&met=sendCardYzm&typ=json';
                $.post(url, '', function (data){console.info(data);})
            });
            var delayTime = 120;
            function countDown(){
                delayTime--;
                $(".send").val(delayTime + '秒后重新获取');
                if (delayTime == 0) {
                    delayTime = 120;
                    $(".send").val(msg);
                    $(".send").removeAttr("disabled");
                    $(".send").removeAttr("readonly");
                    $(".send").css('color','#666');
                    clearTimeout(t);
                }
                else
                {
                    t=setTimeout(countDown,1000);
                }
            }

            function checkyzm(){
                $("label.error").remove();
                var yzm = $.trim($("#yzm").val());
                var obj = $(".send");
                if(yzm == ''){
                    //obj.addClass('red');
                    //$("<label class='error'>"+icon+"<?=_('请填写验证码')?></label>").insertAfter(obj);
                    $.dialog({
                        title: '提示',
                        content: '请填写验证码',
                        height: 100,
                        width: 410,
                        lock: true,
                        drag: false,
                        ok: function () {

                        }
                    });
                    return false;
                }else {
                    var url = SITE_URL +'?ctl=Info&met=checkCardYzm&typ=json';
                    var pars = 'yzm=' + yzm;
                    $.post(url, pars, function(a){
                        flag = false;
                        if (a.status == 200)
                        {
                            flag = true;
                        }
                        else
                        {
                            //obj.addClass('red');
                            //$("<label class='error'>"+icon+"<?=_('验证码错误')?></label>").insertAfter(obj);
                            $.dialog({
                                title: '提示',
                                content: '验证码错误',
                                height: 100,
                                width: 410,
                                lock: true,
                                drag: false,
                                ok: function () {

                                }
                            });
                            return flag;
                        }
                    });
                }


                return flag;
            }

            $('#yzm').on('onchange',function () {
                checkyzm();
            });

            $(".submit").click(function(){
                if(!checkyzm()){
                    return;
                }

                var yzm = $.trim($("#yzm").val());
                var type = $('.type').val();
                var bank_id,bank_account_number,user_account,pars ;
                console.info(type);
                if(type == 'card_add' || type == 'card_edit'){

                    bank_id = $('#bank_id').val();
                    bank_account_number = $('#bank_account_number').val();

                    if($.trim(bank_id) == ''){
                        $.dialog({
                            title: '提示',
                            content: '请选择银行',
                            height: 100,
                            width: 410,
                            lock: true,
                            drag: false,
                            ok: function () {
                            }
                        });
                    }else if($.trim(bank_account_number) == ''){
                        $.dialog({
                            title: '提示',
                            content: '银行卡号不能为空',
                            height: 100,
                            width: 410,
                            lock: true,
                            drag: false,
                            ok: function () {
                            }
                        });
                    }else{
                        var car_verify = bankno.verify(bank_account_number);
                        if(car_verify.code == 1){
                            $.dialog({
                                title: '提示',
                                content: car_verify.msg,
                                height: 100,
                                width: 410,
                                lock: true,
                                drag: false,
                                ok: function () {
                                }
                            });
                            return false;
                        }

                        if(type == 'card_edit'){
                            var card_id = $('#card_id').val();
                            pars = 'yzm=' + yzm + '&type='+type  + '&bank_id=' + bank_id+ '&bank_account_number=' + bank_account_number+'&card_id='+card_id;
                        }else{
                            pars = 'yzm=' + yzm + '&type='+type  + '&bank_id=' + bank_id+ '&bank_account_number=' + bank_account_number;
                        }

                    }
                }else if(type == 'alipay_add' || type == 'alipay_edit'|| type == 'wechat_add'|| type == 'wechat_edit'){
                    user_account = $('#user_account').val();
                    if($.trim(user_account) == ''){
                        $.dialog({
                            title: '提示',
                            content: '账号不能为空',
                            height: 100,
                            width: 410,
                            lock: true,
                            drag: false,
                            ok: function () {
                            }
                        })
                    }else{
                        pars = 'yzm=' + yzm + '&type='+type  + '&user_account=' + user_account;
                    }

                }





                var ajax_url = SITE_URL +'?ctl=Info&met=addUserCard&typ=json';
                $.ajax({
                    type: "GET",
                    url: ajax_url,
                    data:pars,
                    dataType: "json",
                    success:function(a){
                        if(a.status == 200)
                        {
                            $.dialog({
                                title: '提示',
                                content: '提交成功',
                                height: 100,
                                width: 410,
                                lock: true,
                                drag: false,
                                ok: function () {
                                    location.reload();
                                }
                            })
                        }else if(a.status == 240){
                            $.dialog({
                                title: '提示',
                                content: '验证码错误',
                                height: 100,
                                width: 410,
                                lock: true,
                                drag: false,
                                ok: function () {

                                }
                            })
                        }
                        else
                        {
                            $.dialog({
                                title: '提示',
                                content: '提交失败',
                                height: 100,
                                width: 410,
                                lock: true,
                                drag: false,
                                ok: function () {

                                }
                            })
                        }
                    }
                });

            });



            // 1.将未带校验位的 15（或18）位卡号从右依次编号 1 到 15（18），位于奇数位号上的数字乘以 2。
            // 2.将奇位乘积的个十位全部相加，再加上所有偶数位上的数字。
            // 3.将加法和加上校验位能被 10 整除。
            ;!function(){
                var _bankno,_code,_msg,_verify_code,_base_code;
                var _msg_code = ['\u65e0\u6548\u7684\u5361\u53f7','\u5408\u6cd5'];
                function _verify_length(){
                    if(_bankno.length !=16 && _bankno.length != 19){
                        return false;
                    }
                    return true;
                }
                function _get_verify_code(){
                    try{
                        _verify_code = _bankno.substring(_bankno.length-1);
                        _base_code = _bankno.substring(0,_bankno.length-1);
                        _base_code = _base_code.split("").reverse().join("");
                        _sum = 0;
                        for(var i=0;i<_base_code.length;i++){
                            var _k = +_base_code[i];
                            if(i%2==0){
                                _k = _k*2;
                                _sum += _k%10+parseInt(_k/10);
                            }else{
                                _sum += _k;
                            }
                        }
                        _sum += +_verify_code;
                        if(_sum%10==0){
                            return true;
                        }
                        return false;
                    }catch(e){
                        return false;
                    }
                }
                function _return(){
                    return {
                        code:_code,
                        msg:_msg,
                        bankno:_bankno
                    }
                }
                function _verify(){
                    _msg = _msg_code[0];
                    _code = 1;
                    if(!_verify_length()) return _return();
                    if(!_get_verify_code()) return _return();
                    _msg = _msg_code[1];
                    _code = 0;
                    return _return();
                }
                function bankno(){};
                bankno.prototype = {
                    verify:function(bankno){
                        _bankno = bankno;
                        return _verify();
                    }
                }
                window.bankno = new bankno();
            }(window);

        });
    </script>


<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>