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
                    <li><a class="current"  href="<?= YLB_Registry::get('url') ?>?ctl=Operation_Opening&met=headImage"><span>头部图片</span></a></li>
                    <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Operation_Opening&met=floorData"><span>楼层数据</span></a></li>
                    <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Config&met=opening"><span>开业设置</span></a></li>
                </ul>
            </div>
        </div>


        <form method="post" enctype="multipart/form-data" id="opening_goods-setting-form" name="form1">
            <div class="ncap-form-default">
                <dl class="row">
                    <dt class="tit">
                        <label>大图</label>
                    </dt>
                    <dd class="opt">
                        <img id="fresh_index1_review" src="<?php echo $data['opening1']['pic_url'];?>" width="1200" height="220"/>
                        <input type="hidden" id="fresh_index1_image" name="opening[opening_image_1]" value="<?php echo $data['opening1']['pic_url'];?>" />
                        <div  id='fresh_index1_upload' class="image-line upload-image">图片上传</div>
                        <span class="err"><label for="index_live_link1" class="error valid"></label></span>
                        <p class="notic">请使用宽度1920像素，高度220像素的jpg/gif/png格式图片，<br>
                            如需跳转请在后方添加以http://开头的链接地址。</p>
                    </dd>
                </dl>

                <dl class="row">
                    <dt class="tit">
                        <label>小图</label>
                    </dt>
                    <dd class="opt">
                        <img id="fresh_index2_review" src="<?php echo $data['opening2']['pic_url'];?>" width="1200" height="110"/>
                        <input type="hidden" id="fresh_index2_image" name="opening[opening_image_2]" value="<?php echo $data['opening2']['pic_url'];?>" />
                        <div  id='fresh_index2_upload' class="image-line upload-image">图片上传</div>

                        <span class="err"><label for="index_live_link2" class="error valid"></label></span>
                        <p class="notic">请使用宽度1920像素，高度110像素的jpg/gif/png格式图片，<br>
                            如需跳转请在后方添加以http://开头的链接地址。</p>
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
                var agent = navigator.userAgent.toLowerCase();

                    fresh_index1_image_upload= new UploadImage({
                        thumbnailWidth: 1920,
                        thumbnailHeight: 220,
                        imageContainer: '#fresh_index1_review',
                        uploadButton: '#fresh_index1_upload',
                        inputHidden: '#fresh_index1_image'
                    });


                    fresh_index2_image_upload= new UploadImage({
                        thumbnailWidth: 1920,
                        thumbnailHeight: 110,
                        imageContainer: '#fresh_index2_review',
                        uploadButton: '#fresh_index2_upload',
                        inputHidden: '#fresh_index2_image'
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