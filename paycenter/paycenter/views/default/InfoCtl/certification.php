<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
} ?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>
<style>
    .check_name{width: 102px;}
</style>
<div class="main_cont wrap clearfix">
	<form id="form" name="form" action="" method="post" >
	<div class="account_left fl">
		<div class="account_mes">
			<h4><?=_('实名认证')?></h4>
			<table class="account_table">
				<tbody>
				<tr>
					<td class="check_name"><?=_('用户名称')?></td>
					<td><?=$data['user_nickname']?></td>
				</tr>
				<tr>
					<td class="check_name"><?=_('真实姓名')?></td>
					<td><input type="text" value="<?=$data['user_realname']?>" name="user_realname" id="real_name" <?php if($data['user_identity_statu']==2){?> readonly <?php }?>><div class="form-error"></div></td>
				</tr>
				<tr>
					<td class="check_name"><?=_('证件类型')?></td>
					<td>
					<select name="user_identity_type">
					<option value="1"><?=_('身份证')?></option>
					<option value="2"><?=_('护照')?></option>
					<option value="3"><?=_('军官证')?></option>
					</select>
					<div class="form-error"></div></td>
				</tr>
				<tr>
					<td class="check_name"><?=_('证件号码')?></td>
					<td><input type="text" class="w200" maxlength="18" value="<?=$data['user_identity_card']?>" name="user_identity_card" id="identity_card" <?php if($data['user_identity_statu']==2){?> readonly <?php }?>  ><div class="form-error"></div></td>
				</tr>
				  <tr>
                  <td class="check_name"><?=_('正面照预览：')?></td>
                  <td>
                    <div class="user-avatar"><span><img  id="image_img"  src="<?=image_thumb($data['user_identity_face_logo'],170,108) ?>" width="170" height="108" nc_type="avatar"></span></div>
                    <p class="hint mt5"><span style="color:orange;"><?=_('正面照尺寸为340x216像素，请根据系统操作提示进行裁剪并生效。')?></span></p>
                  </td>
                </tr>
				<tr>
					<td class="check_name"><?=_('证件正面照')?></td>
					<td>
                    <div > <a href="javascript:void(0);"><span>
                     <input name="user_identity_face_logo" id="user_identity_face_logo" type="hidden" value="<?=$data['user_identity_face_logo']?>" />
                      </span>
                      <p id='user_upload' style="float:left;" class="bbc_btns"><i class="iconfont icon-upload-alt"></i><?=_('图片上传')?></p>
                      
                      </a> </div>
                  </td>
				</tr>
				<tr>
                  <td class="check_name"><?=_('背面照预览：')?></td>
                  <td>
                    <div class="user-avatar"><span><img  id="image_font_img"  src="<?=image_thumb($data['user_identity_font_logo'],170,108) ?>" width="170" height="108" nc_type="avatar"></span></div>
                    <p class="hint mt5"><span style="color:orange;"><?=_('背面照尺寸为340x216像素，请根据系统操作提示进行裁剪并生效。')?></span></p>
                  </td>
                </tr>
				<tr>
					<td class="check_name"><?=_('证件背面照')?></td>
					<td>
                    <div > <a href="javascript:void(0);"><span>
                     <input name="user_identity_font_logo" id="user_identity_font_logo" type="hidden" value="<?=$data['user_identity_font_logo']?>" />
                      </span>
                      <p id='user_font_upload' style="float:left;" class="bbc_btns"><i class="iconfont icon-upload-alt"></i><?=_('图片上传')?></p>
                      
                      </a> </div>
                  </td>
				</tr>
                <tr>
                    <td class="check_name"><?=_('手持证件照预览：')?></td>
                    <td>
                        <div class="user-avatar"><span><img  id="image_hand_img"  src="<?=image_thumb($data['user_identity_hand_logo'],170,108) ?>" width="170" height="108" nc_type="avatar"></span></div>
                        <p class="hint mt5"><span style="color:orange;"><?=_('背面照尺寸为340x216像素，请根据系统操作提示进行裁剪并生效。')?></span></p>
                    </td>
                </tr>
                <tr>
                    <td class="check_name"><?=_('手持证件照')?></td>
                    <td>
                        <div >
                            <a href="javascript:void(0);">
                                <span>
                                    <input name="user_identity_hand_logo" id="user_identity_hand_logo" type="hidden" value="<?=$data['user_identity_hand_logo']?>" />
                                </span>
                                <p id='user_hand_upload' style="float:left;" class="bbc_btns"><i class="iconfont icon-upload-alt"></i><?=_('图片上传')?></p>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php if($data['user_identity_statu']!=2){?>
				<tr>
					<td></td>
					<td><input type="submit" value="<?=_('提交')?>" class="submit"></td>
				</tr>
				<?php }?> 
				</tbody>
			</table>
		</div>
	</div>
	<div class="account_right fr">
		<div class="account_right_con">
			<ul class="cert_instructions">
				<li>
					<h5><?=_('什么是实名认证？')?></h5>
					<p><?=_('实名认证，是利用其国家级身份认证平台“身份通实名认证平台”推出的实名身份认证服务。在Pay Center平台进行实名认证无需繁琐步骤，只需如实填写您的姓名和身份证号，并支付5元实名认证费用（国家发改委定价，线上线下均可支付），就能完成实名认证。')?></p>
				</li>
				<li>
					<h5><?=_('为什么要实名认证')?></h5>
					<p><?=_('只有通过身份通实名身份认证的用户，才能使用Pay Center服务，从而实现真正的、全面的实名制平台。为保护用户隐私，用户之间只有在得到对方授权的情况下才可以交换实名认证信息。为保护用户信息，用户提供的身份证信息，将直接传输到“全国公民身份信息系统”系统数据库中，并即时返回认证结果，Pay Center并不保留用户的身份证号码。')?></p>
				</li>
				<li>
					<h5><?=_('温馨提示')?></h5>
					<p><?=_('通过实名认证表示该用户提交了真实存在的身份证，但我们无法完全确认该证件是否为其本人持有，您还需要通过和对方交换实名信息来获取对方全名及身份证照片，并与对方照片或本人进行比对，核实对方是否该身份证的持有人。实名认证也不能代表除身份证信息外的其他信息是否真实。因此，Pay Center提醒广大家庭用户在使用过程中，须保持谨慎理性，增强防范意识，避免产生经济等其他往来。')?></p>
				</li>
			</ul>
		</div>
	</div>
   </form>
</div>
<script type="text/javascript" src="<?=$this->view->js?>/webuploader.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js?>/upload/upload_image.js" charset="utf-8"></script>
<link href="<?= $this->view->css ?>/webuploader.css" rel="stylesheet" type="text/css">
<script>
    function getQueryString(name){
        var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r!=null) return r[2]; return '';
    }
    $(function(){
       var type = getQueryString('type');
       if(type == 'withdraw'){
           Public.tips.error("您还未实名认证或已提交实名未通过，请耐心等待结果");
       }

       var statu = <?=$data['user_identity_statu'] ?>;
       if(statu == 3){
           Public.tips.error("您实名认证未通过，请上传清晰的身份证件照");
       }
    });
    $(function(){
		$('#user_upload').on('click', function () {
			$.dialog({
				title: '图片裁剪',
				content: "url: <?= YLB_Registry::get('url') ?>?ctl=Upload&met=cropperImage&typ=e",
				data: { width: 340, height: 216, callback: callback },    // 需要截取图片的宽高比例
				width: '800px',
				lock: true
			})
		});
		function callback ( respone , api ) {
			$('#image_img').attr('src', respone.url);
			$('#user_identity_face_logo').attr('value', respone.url);
			api.close();
		}

        $('#user_font_upload').on('click', function () {
            $.dialog({
                title: '图片裁剪',
                content: "url: <?= YLB_Registry::get('url') ?>?ctl=Upload&met=cropperImage&typ=e",
                data: { width: 340, height: 216, callback: font_callback },    // 需要截取图片的宽高比例
                width: '800px',
                lock: true
            })
        });
        function font_callback ( respone , api ) {
            $('#image_font_img').attr('src', respone.url);
            $('#user_identity_font_logo').attr('value', respone.url);
            api.close();
        }

        $('#user_hand_upload').on('click', function () {
            $.dialog({
                title: '图片裁剪',
                content: "url: <?= YLB_Registry::get('url') ?>?ctl=Upload&met=cropperImage&typ=e",
                data: { width: 340, height: 216, callback: hand_callback },    // 需要截取图片的宽高比例
                width: '800px',
                lock: true
            })
        });
        function hand_callback ( respone , api ) {
            $('#image_hand_img').attr('src', respone.url);
            $('#user_identity_hand_logo').attr('value', respone.url);
            api.close();
        }

        var ajax_url = '<?= YLB_Registry::get('url');?>?ctl=Info&met=editCertification&typ=json';
        $('#form').validator({
            ignore: ':hidden',
            theme: 'yellow_right',
            timely: 1,
            stopOnError: false,
            fields : {
                'user_realname':'required;',
                'user_identity_card':'required;IDcard',
            },
            valid:function(form){
                //表单验证通过，提交表单
                $.ajax({
                    url: ajax_url,
                    data:$("#form").serialize(),
                    success:function(a){
                        if(a.status == 200)
                        {
                            Public.tips.success("<?=_('操作成功')?>");
                            location.href= "<?= YLB_Registry::get('url');?>?ctl=Info&met=account";
                        }
                        else
                        {
                            Public.tips.error("<?=_('操作失败')?>");
                        }
                    }
                });
            }
        });

    });
</script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>