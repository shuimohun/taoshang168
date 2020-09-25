<?php if (!defined('ROOT_PATH')){exit('No Permission');}

include $this->view->getTplPath() . '/' . 'header.php';
?>
<link rel="stylesheet" href="<?= $this->view->css ?>/security.css">
</div>
<div class="form-style-layout">
    <div class="form-style">
    	<div class="step">
        	<dl class="step-first current">
            	<dt><?=_('1.验证身份')?></dt>
            </dl>
        	<dl class="current">
            	<dt><?=_('2.绑定手机')?></dt>
                <dd></dd>
            </dl>
        	<dl class="">
            	<dt><?=_('3.绑定完成')?></dt>
                <dd></dd>
            </dl>
        </div>
        <form id="form" name="form"  method="post">
		<input type="hidden" value="mobile_verify" name="act">
            <dl>
                <dt><em>*</em><?=_('手机：')?></dt>
                <dd>
                	<?php if($op = "mobile" && $data['user_mobile_verify'] != 1 && $data['user_mobile']){?>
                		<input type="hidden" name="user_mobile" id="user_mobile" value="<?=$data['user_mobile']?>" />
						<?=$data['user_mobile']?>
                    <?php }else{?>
                		<input type="text" name="user_mobile" id="user_mobile" class="text" value="" />
                    <?php }?>
                </dd>
            </dl>
            <dl>
                <dt><em>*</em><?=_('验证码：')?></dt>
                <dd>
                <input type="text" name="yzm" id="yzm" class="text w60" value="" onchange="javascript:checkyzm();"/>
                <input type="button" class="send" data-type="mobile" value="<?=_('获取手机验证码')?>" />
                </dd>
            </dl>
            <dl class="foot">
                <dt>&nbsp;</dt>
                <dd><input type="submit" value="<?=_('提交')?>" class="submit"></dd>
            </dl>
        </form>
	</div>
</div>

<script type="text/javascript">
var icon = '<i class="iconfont icon-exclamation-sign"></i>';
$(".send").click(function(){
	$("label.error").remove();
	var obj = $("#user_mobile");
	var val = obj.val();
	var patrn = /^1\d{10}$/;

	if(!val){
		obj.addClass('red');
	 	$("<label class='error'>"+icon+"<?=_('请填写手机')?></label>").insertAfter(obj);
	}
	else if(!patrn.test(val)){  
		obj.addClass('red');
		$("<label class='error'>"+icon+"<?=_('请填写正确的手机')?></label>").insertAfter(obj);
	}
	else{
		var url = SITE_URL +'?ctl=User&met=getMobile&typ=json';
		var sj = new Date();
		var pars = 'shuiji=' + sj+'&verify_type=mobile&verify_field='+val; 
		$.post(url, pars, function (data)
		{
			if(data && 200 == data.status){
				obj.removeClass('red');
				msg = "<?=_('获取手机验证码')?>";
				$(".send").attr("disabled", "true");
				$(".send").attr("readonly", "readonly");
				//$("#user_mobile").attr("disabled", "disabled");
				$("#user_mobile").attr("readonly", "readonly");
				t = setTimeout(countDown,1000);
			
				var url = SITE_URL +'?ctl=User&met=getMobileYzm&typ=json&mobile='+val;
//				var sj = new Date();
//				var pars = 'shuiji=' + sj +'&mobile='+val;
				$.post(url, function (data){})
			}
			else{				
				obj.addClass('red');
				$("<label class='error'>"+icon+"<?=_('该手机已绑定绑定了账号')?></label>").insertAfter(obj);
			}
		});
	}
});
var delayTime = 30;
function countDown()
{
	delayTime--;
	$(".send").val(delayTime + "<?=_('秒后重新获取')?>");
	if (delayTime == 0) {
		delayTime = 30;
		$(".send").val(msg);
		$(".send").removeAttr("disabled");
		$(".send").removeAttr("readonly");
		$("#user_mobile").removeAttr("disabled");
		$("#user_mobile").removeAttr("readonly");
		clearTimeout(t);
	}
	else
	{
		t=setTimeout(countDown,1000);
	}
}
flag = false;
function checkyzm(){
	$("label.error").remove();
	var yzm = $.trim($("#yzm").val());
	var mobile = $.trim($("#user_mobile").val());

	var obj = $(".send");
	if(yzm == ''){
		obj.addClass('red');
	 	$("<label class='error'>"+icon+"<?=_('请填写验证码')?></label>").insertAfter(obj);
		return false;
	}
	var url = SITE_URL +'?ctl=User&met=checkMobileYzm&typ=json';

	$.post(url, {'yzm':yzm,'mobile':mobile}, function(a){
			flag = false;
	        if (a.status == 200)
	        {
				flag = true;
				//obj.addClass('red');
				//$("<label class='error'>"+icon+"验证码正确</label>").insertAfter(obj);
	        }
	        else
	        {
				
	        	obj.addClass('red');
				$("<label class='error'>"+icon+"<?=_('验证码错误')?></label>").insertAfter(obj);
				return flag;
	        }
	});
	return flag;
}
$(".submit").click(function(){
		var obj = $(".send");

		/*
		var F = checkyzm();
        if(F == false) 
		{
			return false;	
		}
		*/
			
        var ajax_url = SITE_URL +'?ctl=User&met=editMobileInfo&typ=json';
       
        $('#form').validator({
            ignore: ':hidden',
            theme: 'yellow_right',
            timely: 1,
            stopOnError: false,
			
            fields: {
                'user_mobile': 'required;',
                'yzm':'required;',
            },
            valid:function(form){
                //表单验证通过，提交表单
                $.ajax({
                    url: ajax_url,
                    data:$("#form").serialize(),
                    success:function(a){
                        if(a.status == 200)
                        {
							Public.tips.success("<?=_('操作成功！')?>");
                            location.href= SITE_URL +"?ctl=User&met=security";
                        }else if(a.status == 240){
							obj.addClass('red');
							$("<label class='error'>"+icon+"<?=_('验证码错误')?></label>").insertAfter(obj);
						}
                        else
                        {
                            Public.tips.error("<?=_('操作失败！')?>");
                        }
                    }
                });
            }

        });

    });
</script>
</div>
</div>
</div>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
