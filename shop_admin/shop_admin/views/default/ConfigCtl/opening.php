<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/'  . 'header.php';
?>
    <link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
    <link href="<?= $this->view->css_com ?>/webuploader.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
    </head>
    <body>
    <div class="wrapper page">
        <div class="fixed-bar">
            <div class="item-title">
                <div class="subject">
                    <h3>商城开业数据</h3>
                    <h5>商城开业数据变更修改</h5>
                </div>
                <ul class="tab-base nc-row">
                    <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Operation_Opening&met=showIndex"><span>开业数据</span></a></li>
                    <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Operation_Opening&met=headImage"><span>头部图片</span></a></li>
                    <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Operation_Opening&met=floorData"><span>楼层数据</span></a></li>
                    <li><a class="current" href="<?= YLB_Registry::get('url') ?>?ctl=Config&met=opening"><span>开业设置</span></a></li>
                </ul>
            </div>
        </div>
        <form method="post" enctype="multipart/form-data" id="opening_setting-setting-form" name="form1">
            <input type="hidden" name="config_type[]" value="opening" />
            <div class="ncap-form-default">
                <dl class="row">
                    <dt class="tit">
                        <label>标题</label>
                    </dt>
                    <dd class="opt">
                        <input id="setting_phone" name="opening[opening_title]" value="<?=($data['opening_title']['config_value'])?>" class="ui-input w400" type="text"/>
                        <p class="notic"></p>
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="tit">
                        <label>PC图片</label>
                    </dt>
                    <dd class="opt">
                        <img id="img1" src="<?php echo $data['opening_img']['config_value'];?>" width="960" height="306"/>
                        <input type="hidden" id="input_image1" name="opening[opening_img]" value="<?php echo $data['opening_img']['config_value'];?>" />
                        <div  id='img_upload1' class="image-line upload-image">图片上传</div>
                        <span class="err"><label for="index_live_link1" class="error valid"></label></span>
                        <p class="notic">请使用宽度1920像素，高度613像素的jpg/gif/png格式图片</p>
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="tit">
                        <label>Wap图片</label>
                    </dt>
                    <dd class="opt">
                        <img id="img2" src="<?php echo $data['opening_img_wap']['config_value'];?>" width="375" height="195"/>
                        <input type="hidden" id="input_image2" name="opening[opening_img_wap]" value="<?php echo $data['opening_img_wap']['config_value'];?>" />
                        <div  id='img_upload2' class="image-line upload-image">图片上传</div>
                        <span class="err"><label for="index_live_link2" class="error valid"></label></span>
                        <p class="notic">请使用宽度750像素，高度390像素的jpg/gif/png格式图片</p>
                    </dd>
                </dl>
                <div class="bot"><a href="javascript:void(0);" class="ui-btn ui-btn-sp submit-btn">确认提交</a></div>
        </form>

        <script type="text/javascript" src="<?=$this->view->js?>/controllers/config.js" charset="utf-8"></script>
        <script type="text/javascript" src="<?= $this->view->js_com ?>/webuploader.js" charset="utf-8"></script>
        <script type="text/javascript" src="<?= $this->view->js ?>/models/upload_image.js" charset="utf-8"></script>
        <script>
            $(function(){
                //图片上传
                new UploadImage({
                    thumbnailWidth: 1920,
                    thumbnailHeight: 613,
                    imageContainer: '#img1',
                    uploadButton: '#img_upload1',
                    inputHidden: '#input_image1'
                });

                //图片上传
                new UploadImage({
                    thumbnailWidth: 750,
                    thumbnailHeight: 390,
                    imageContainer: '#img2',
                    uploadButton: '#img_upload2',
                    inputHidden: '#input_image2'
                });

                function callback ( respone , api ) {
                    $imagePreview.attr('src', respone.url);
                    $imageInput.attr('value', respone.url);
                    api.close();
                }
            })
        </script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>