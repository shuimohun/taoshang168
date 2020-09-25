<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/'  . 'header.php';
?>
	<link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
	<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
	<link href="<?= $this->view->css_com ?>/webuploader.css" rel="stylesheet" type="text/css">
	<style>
		.image-line {height: 23px;width: 50px;}
    </style>
</head>
<body>

	<div class="wrapper page">
		<div class="fixed-bar">
			<div class="item-title">
				<div class="subject">
					<h3>自营店铺</h3>
					<h5>自营店铺将在首页展示</h5>
				</div>
				<ul class="tab-base nc-row">
					<li><a class="current"><span>幻灯片管理</span></a></li>
					<li><a href="<?= YLB_Registry::get('url') ?>?ctl=Self_Help&met=help"><span>自营店铺</span></a></li>
				</ul>
			</div>
		</div>
		<p class="warn_xiaoma"><span></span><em></em></p>
		<div class="explanation" id="explanation">
			<div class="title" id="checkZoom"><i class="iconfont icon-lamp"></i>
				<h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
				<span id="explanationZoom" title="收起提示"></span><em class="close_warn iconfont icon-guanbifuzhi"></em>
			</div>
			<ul>
				<li>该组幻灯片滚动图片应用于自营店铺使用，最多可上传2张图片。</li>
				<li>图片要求使用宽度为1920像素，高度为600像素jpg/gif/png格式的图片。</li>
				<li>上传图片后请添加格式为“http://网址...”链接地址，设定后将在显示页面中点击幻灯片将以另打开窗口的形式跳转到指定网址。</li>
			</ul>
		</div>

		<form method="post" enctype="multipart/form-data" id="self_slider-setting-form" name="form1">
			<input type="hidden" name="config_type[]" value="self_slider"/>
			<div class="ncap-form-default">
				<dl class="row">
					<dt class="tit">
						<label>滚动图片1</label>
					</dt>
					<dd class="opt">
						<img id="self_slider1_review" src="<?=@($data['self_slider_image1']['config_value'])?>" width="760" height="140"/><br>
						<input type="hidden" id="self_slider_image1" name="self_slider[self_slider_image1]" value="<?=@($data['self_slider_image1']['config_value'])?>" />
						<div  id='self_slider1_upload' class="image-line upload-image" >图片上传</div>
						<label title="请输入图片要跳转的链接地址" >
							<i class="fa fa-link"></i>
							<input class="ui-input w400" style="margin:8px 0" type="text" name="self_slider[self_slider_link1]" value="<?=@($data['self_slider_link1']['config_value'])?>" placeholder="请输入图片要跳转的链接地址">
						</label>
					    <span class="err"><label for="self_slider_link1" class="error valid"></label></span>
						<p class="notic">请使用宽度1920像素，高度600像素的jpg/gif/png格式图片作为幻灯片banner上传，<br>
						如需跳转请在后方添加以http://开头的链接地址。</p>
					</dd>
				</dl>

				<dl class="row">
					<dt class="tit">
						<label>滚动图片2</label>
					</dt>
					<dd class="opt">
						<img id="self_slider2_review" src="<?=@($data['self_slider_image2']['config_value'])?>" width="760" height="140"/><br>
						<input type="hidden" id="self_slider_image2" name="self_slider[self_slider_image2]" value="<?=@($data['self_slider_image2']['config_value'])?>" />
						<div  id='self_slider2_upload' class="image-line upload-image" >图片上传</div>
						<label title="请输入图片要跳转的链接地址" class="">
							<i class="fa fa-link"></i>
							<input class="ui-input  w400" type="text" name="self_slider[self_slider_link2]" value="<?=@($data['self_slider_link2']['config_value'])?>" placeholder="请输入图片要跳转的链接地址">
						</label>
					    <span class="err"><label for="self_slider_link2" class="error valid"></label></span>
					    <p class="notic">请使用宽度1920像素，高度600像素的jpg/gif/png格式图片作为幻灯片banner上传，<br>
						如需跳转请在后方添加以http://开头的链接地址。</p>
					</dd>
				</dl>

				<dl class="row">
					<dt class="tit">
						<label>贴心提示</label>
					</dt>
					<dd class="opt">
					<textarea style="width: 500px;height: 200px;" name="self_slider[self_slider_tip]"><?=@($data['self_slider_tip']['config_value'])?></textarea>
				</dl>
				<div class="bot"><a href="javascript:void(0);" class="ui-btn ui-btn-sp submit-btn">确认提交</a></div>
			</div>
		</form>
	</div>
	<script type="text/javascript" src="<?=$this->view->js?>/controllers/config.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?= $this->view->js_com ?>/webuploader.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?= $this->view->js ?>/models/upload_image.js" charset="utf-8"></script>
	<script>
        $(function(){
            var agent = navigator.userAgent.toLowerCase();

            if ( agent.indexOf("msie") > -1 && (version = agent.match(/msie [\d]/), ( version == "msie 8" || version == "msie 9" )) ) {
                self_slider1_image_upload= new UploadImage({
                     thumbnailWidth: 1920,
                     thumbnailHeight: 600,
                     imageContainer: '#self_slider1_review',
                     uploadButton: '#self_slider1_upload',
                     inputHidden: '#self_slider_image1'
                 });

                //图片上传
                self_slider2_image_upload= new UploadImage({
                     thumbnailWidth: 1920,
                     thumbnailHeight: 600,
                     imageContainer: '#self_slider2_review',
                     uploadButton: '#self_slider2_upload',
                     inputHidden: '#self_slider_image2'
                 });
            } else {
                var $imagePreview, $imageInput, imageWidth, imageHeight,shopWidth;

                $('#self_slider1_upload, #self_slider2_upload').on('click', function () {

                    if ( this.id == 'self_slider1_upload' ) {
                        $imagePreview = $('#self_slider1_review');
                        $imageInput = $('#self_slider_image1');
                        imageWidth = 1920, imageHeight = 600,shopWidth = 1920;
                    } else if ( this.id == 'self_slider2_upload' ) {
                        $imagePreview = $('#self_slider2_review');
                        $imageInput = $('#self_slider_image2');
                        imageWidth = 1920, imageHeight = 600,shopWidth = 1920;
                    }
                    $.dialog({
                        title: '图片裁剪',
                        content: "url: <?= YLB_Registry::get('url') ?>?ctl=Index&met=cropperImage&typ=e",
                        data: {SHOP_URL:SHOP_URL, width: imageWidth, height: imageHeight, callback: callback },    // 需要截取图片的宽高比例
                        width: shopWidth,
                        lock: true
                    })
                });

                function callback ( respone , api ) {
                    $imagePreview.attr('src', respone.url);
                    $imageInput.attr('value', respone.url);
                    api.close();
                }
            }


		})
	</script>
<?php
	include $this->view->getTplPath() . '/' . 'footer.php';
?>