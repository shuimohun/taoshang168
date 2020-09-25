<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<?php
    include $this->view->getTplPath() . '/'  . 'header.php';
?>
<link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
<!--<link rel="stylesheet" href="--><?//=$this->view->css_com?><!--/base.css">-->
    <link href="<?= $this->view->css_com ?>/webuploader.css" rel="stylesheet" type="text/cs
<link href="<?=$this->view->css_com?>/iconfont/iconfont.css?ver=1.02" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>

<!-- 配置文件 -->
<script type="text/javascript" src="<?= $this->view->js_com ?>/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="<?= $this->view->js_com ?>/ueditor/ueditor.all.js"></script>

<script type="text/javascript" src="<?= $this->view->js_com ?>/upload/addCustomizeButton.js"></script>
    <link rel="stylesheet" href="<?=$this->view->css_com?>/buyer.css">
</head>
<body>
<form id="information_form" enctype="multipart/form-data" method="post">
    <div class="ncap-form-default">
      <dl class="row">
        <dt class="tit">
          <label for="information_title"><em>*</em>审核不通过原因</label>
        </dt>
        <dd class="opt">
          <input type="text" value="" name="shop_npass_content" id="information_title" class="ui-input" style="width: 200px;">
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
      </dl>

<!--    上传图片 start-->
<!--    <dl class="row">-->
<!--        <dt class="tit">-->
<!--            <label><em>*</em>模板图片</label>-->
<!--        </dt>-->
<!--        <dd class="opt">-->
<!--            <img id="information_pic_image" name="shop_npass_image" alt="图片" src="" width="100px" height="80px" />-->
<!---->
<!--            <div class="image-line upload-image" id="information_pic_upload">上传图片<i class="iconfont icon-tupianshangchuan"></i></div>-->
<!---->
<!--            <input id="information_pic" name="shop_npass_image" value="" class="ui-input w400" type="hidden"/>-->
<!--            <div class="notic">图片大小不能超过2Mb</div>-->
<!--        </dd>-->
<!--    </dl>-->
        <!-- 上传图片 end -->

        <dl class="row">
            <dt class="tit">
                <label><em>*</em>资讯内容</label>
            </dt>
            <dd class="opt">
                <!-- 加载编辑器的容器 -->
                <textarea id="information_desc" style="width:700px;height:300px;" name="content" type="text/plain">
            </textarea>
            </dd>
        </dl>
    </div>
<!-- 实例化编辑器 -->

</div>
    <input type="hidden" name="user_id" value="<?=$data['user_id']?>">
    <input type="hidden" name="user_name" value="<?=$data['user_name']?>">
    <input type="hidden" name="shop_id" value="<?=$data['shop_id']?>">
    <input type="hidden" name="shop_name" value="<?=$data['shop_name']?>">
    <input type="hidden" name="shop_npass_status" value="1">
  </form>

<script type="text/javascript">
    var shop_id = <?=$data['shop_id'] ?>;
    var ue = UE.getEditor('information_desc', {
        toolbars: [
            [
                'fullscreen', 'source', '|', 'undo', 'redo', '|',
                'bold', 'italic', 'underline', 'forecolor', 'backcolor', 'justifyleft', 'justifycenter', 'justifyright'
            ]
        ],
        autoClearinitialContent: true,
        //关闭字数统计
        wordCount: false,
        //关闭elementPath
        elementPathEnabled: false
    });

</script>
<script type="text/javascript" src="<?= $this->view->js_com ?>/webuploader.js" charset="utf-8"></script>
<script type="text/javascript" src="<?= $this->view->js ?>/models/upload_image.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js?>/controllers/shop/join/base_manage.js" charset="utf-8"></script>
<script src="--><?=$this->view->js?><!--/models/upload.js"></script>

<script>
    /* 图片上传 */
    $(function () {
        var agent = navigator.userAgent.toLowerCase();
        if ( agent.indexOf("msie") > -1 && (version = agent.match(/msie [\d]/), ( version == "msie 8" || version == "msie 9" )) ) {
            information_pic_upload = new UploadImage({
                thumbnailWidth: 800,
                thumbnailHeight: 500,
                imageContainer: '#information_pic_image',
                uploadButton: '#information_pic_upload',
                inputHidden: '#information_pic'
            });
        } else {
            $('#information_pic_upload').on('click', function () {
                $.dialog({
                    title: '图片裁剪',
                    content: "url: <?/*= YLB_Registry::get('url') */?>?ctl=Index&met=cropperImage&typ=e",
                    data: {SHOP_URL: SHOP_URL, width: 800, height: 500, callback: callback},    // 需要截取图片的宽高比例
                    width: '800px',
                    lock: true
                })
            });
            function callback(respone, api) {
                $('#information_pic_image').attr('src', respone.url);
                $('#information_pic').attr('value', respone.url);
                api.close();
            }
        }
    })
    /* 图片上传 */

</script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>