<html>
    <head>
        <title>新建地址</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?= $this->view->css ?>/resetAddr.css">
        <script type="text/javascript" src="<?=$this->view->js_com?>/jquery.js" charset="utf-8"></script>
        <script>
            var SITE_URL = "<?php YLB_Registry::get('url')?>";
        </script>
        <link href="<?= $this->view->css_com ?>/jquery/plugins/validator/jquery.validator.css?ver=<?=VER?>" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
        <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
        <script  type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.dialog.js"></script>
        <script type="text/javascript" src="<?=$this->view->js?>/district.js"></script>
        <link type="text/css" rel="stylesheet" href="<?= $this->view->css_com ?>/jquery/plugins/dialog/green.css">
        <link href="<?= $this->view->css ?>/tips.css" rel="stylesheet">
        <script type="text/javascript" src="<?=$this->view->js?>/common.js"></script>
        <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.toastr.min.js" charset="utf-8"></script>
    </head>
    <style>
        .resAdd-inp div.hidden{display: none;}
    </style>
    <body>
        <div class="reset-address" >
            <form id="form" action="#" method="post" >
                <div class="res-cont">
                     <input type="hidden" name="user_address_id" id="id" value="<?php if(isset($data) && !empty($data)){ echo $data['user_address_id']; }?>">
                    <div class="resAdd-inp">
                        <div><span><strong></strong><?=('收件人：')?></span></div>
                        <input type="text"  name="user_address_contact" value="<?php if(isset($data) && !empty($data)){echo $data['user_address_contact'];}?>">
                    </div>
                    <div class="resAdd-inp">
                        <div><span><strong></strong><?=('手机：')?></span></div>
                        <input type="text"  name="user_address_phone" value="<?php if(isset($data) && !empty($data)){echo $data['user_address_phone'];}?>">
                    </div>
                    <div class="resAdd-inp">
                        <div><span><strong></strong><?=('所在地区：')?></span></div>
                        <input type="hidden" name="address_area" id="t" value="<?php if(isset($data) && !empty($data)){ echo $data['user_address_area']; }?>" />
                        <input type="hidden" name="province_id" id="id_1" value="<?php if(isset($data) && !empty($data)){ echo $data['user_address_province_id']; }?>" />
                        <input type="hidden" name="city_id" id="id_2" value="<?php if(isset($data) && !empty($data)){ echo $data['user_address_city_id']; }?>" />
                        <input type="hidden" name="area_id" id="id_3" value="<?php if(isset($data) && !empty($data)){ echo $data['user_address_area_id']; }?>" />
                        <?php if(@$data['user_address_area']){ ?>
                            <div id="d_1"><span class="dress_box"><?=@$data['user_address_area'] ?></span>&nbsp;&nbsp;<a href="javascript:sd();"><?=('编辑')?></a></div>
                        <?php } ?>
                        <div id="d_2"  class="<?php if(@$data['user_address_area']) echo 'hidden';?>">
                            <select id="select_1" name="select_1" onChange="district(this);">
                                <option value=""><?=('--请选择--')?></option>
                                <?php foreach($district['items'] as $key=>$val){ ?>
                                <option value="<?=$val['district_id']?>|1"><?=$val['district_name']?></option>
                                <?php } ?>
                            </select>
                            <select id="select_2" name="select_2" onChange="district(this);" class="hidden"><option value=""><?=('--请选择--')?></option></select>
                            <select id="select_3" name="select_3" onChange="district(this);" class="hidden"><option value=""><?=('--请选择--')?></option></select>
                        </div>
                    </div>
                    <div class="resAdd-inp">
                        <div><span><strong></strong><?=('详细地址：')?></span></div>
                        <textarea name="user_address_address" style="width:360px;height:80px;"><?php if(isset($data) && !empty($data)){echo $data['user_address_address'];}?></textarea>
                    </div>
                    <div class="moren">
                        <?php if(request_int('defalut') == 1){?>
                            <input type="hidden" name="user_address_default" value="1" >
                        <?php }else{?>
                            <input type="checkbox" name="user_address_default" value="1" <?php if(isset($data) && !empty($data) && $data['user_address_default'] == 1){echo 'checked';}?>><span><?=('设为默认收货地址')?></span>
                        <?php }?>
                    </div>
                    <input type="submit" class="save" value="<?=('提交')?>" />
                </div>
            </form>
        </div>
    </body>
</html>
<script>
	api = frameElement.api;
	var SITE_URL = "<?php YLB_Registry::get('url')?>";
	var id = $("#id").val();

	if(id) {
		var url = SITE_URL+"?ctl=Buyer_User&met=editAddressInfo&typ=json";
	} else {
		var url = SITE_URL+"?ctl=Buyer_User&met=addAddressInfo&typ=json";
	}

	//表单提交
	$('#form').validator({
		ignore: ':hidden',
		theme: 'yellow_right',
		timely: 1,
		stopOnError: false,
		rules: {
        	phone: [/^[1][0-9]{10}$/, '<?=('请输入正确的手机号')?>'],
            name:[/^[\u4e00-\u9fa5_a-zA-Z]+$/,'只支持中英文']
    	},
		fields: {
			'user_address_contact': 'required;name',
			'user_address_phone': 'required;phone',
			'user_address_area': 'required;',
			'user_address_address': 'required;',
			'select_1':'required',
			'select_2':'required'
		},
		valid:function(form){
			var me = this;
            // 提交表单之前，hold住表单，防止重复提交
            me.holdSubmit();
			//表单验证通过，提交表单
			$.ajax({
                url: url,
                data:$("#form").serialize(),
                success:function(a){
                    if(a.status == 200) {
                        if(id) {
                            parent.editAddress(a.data);
                        } else {
                            parent.addAddress(a.data);
                        }
                        api.close();
                    } else {
                        api.close();
                        Public.tips.error('<?=('操作失败！')?>');
                    }
                    // 提交表单成功后，释放hold，如果不释放hold，就变成了只能提交一次的表单
                    me.holdSubmit(false);
                }, error:function () {
                    me.holdSubmit(false);
                }
            });
		}
	});
</script>