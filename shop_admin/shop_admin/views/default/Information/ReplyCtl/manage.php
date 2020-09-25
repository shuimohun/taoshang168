<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<?php
    include $this->view->getTplPath() . '/'  . 'header.php';
?>
<link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
<link href="<?= $this->view->css_com ?>/webuploader.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
<!-- 配置文件 -->
<script type="text/javascript" src="<?= $this->view->js_com ?>/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="<?= $this->view->js_com ?>/ueditor/ueditor.all.js"></script>

<script type="text/javascript" src="<?= $this->view->js_com ?>/upload/addCustomizeButton.js"></script>
<style>
</style>
</head>
<body>
<form id="information_form" enctype="multipart/form-data" method="post">
    <div class="ncap-form-default">
      <dl class="row">
        <dt class="tit">
          <label for="information_title"><em>*</em>标题</label>
        </dt>
        <dd class="opt">
          <input type="text" value="" name="information_title" id="information_title" class="ui-input">
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
            <label><em>*</em>资讯分类:</label>
        </dt>
        <dd class="opt">
            <div class="ctn-wrap"><span id="type"></span></div>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label for="information_url">链接</label>
        </dt>
        <dd class="opt">
          <input type="text" value="" name="information_url" id="information_url" class="ui-input">
          <span class="err"></span>
          <p class="notic">当填写&quot;链接&quot;后点击文章标题将直接跳转至链接地址，不显示文章内容。链接格式请以http://开头</p>
        </dd>
      </dl>
        <dl class="row">
            <dt class="tit">
                <label for="information_fake_read_count">阅读量</label>
            </dt>
            <dd class="opt">
                <input type="text" value="" name="information_fake_read_count" id="information_fake_read_count" class="ui-input">
                <span class="err"></span>
                <p class="notic">文章的虚拟阅读量</p>
            </dd>
        </dl>

      <dl class="row">
        <dt class="tit">
          <label for="if_show">是否启用:</label>
        </dt>
        <dd class="opt">
          <div class="onoff">
            <label for="information_status1" class="cb-enable  ">启用</label>
            <label for="information_status2" class="cb-disable  selected">关闭</label>
            <input id="information_status1"  name ="information_status"  value="1" type="radio">
            <input id="information_status2"  name ="information_status"  checked="checked"  value="2" type="radio">
          </div>
          <p class="notic">启用:商家和买家都可见,关闭:仅卖家可见</p>
        </dd>
      </dl>
	  <dl class="row">
        <dt class="tit">
          <label for="if_show">是否公告:</label>
        </dt>
        <dd class="opt">
          <div class="onoff">
            <label for="information_type1" class="cb-enable  ">是</label>
            <label for="information_type2" class="cb-disable  selected">否</label>
            <input id="information_type1"  name ="information_type"  value="1" type="radio">
            <input id="information_type2"  name ="information_type"  checked="checked"  value="0" type="radio">
          </div>
          <p class="notic"></p>
        </dd>
      </dl>
        <dl class="row">
            <dt class="tit">
                <label for="if_show">是否推荐:</label>
            </dt>
            <dd class="opt">
                <div class="onoff">
                    <label for="information_recommend1" class="cb-enable  ">是</label>
                    <label for="information_recommend2" class="cb-disable  selected">否</label>
                    <input id="information_recommend1"  name ="information_recommend"  value="1" type="radio">
                    <input id="information_recommend2"  name ="information_recommend"  checked="checked"  value="0" type="radio">
                </div>
                <p class="notic"></p>
            </dd>
        </dl>
      <dl class="row">
        <dt class="tit">排序</dt>
        <dd class="opt">
          <input type="text" value="" name="information_sort" id="information_sort" class="ui-input">
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
      </dl>

<!-- 上传图片 start -->
    <dl class="row">
        <dt class="tit">
            <label><em>*</em>模板图片</label>
        </dt>
        <dd class="opt">
            <img id="information_pic_image" name="information_pic_image" alt="图片" src="" width="100px" height="80px" />

            <div class="image-line upload-image" id="information_pic_upload">上传图片<i class="iconfont icon-tupianshangchuan"></i></div>

            <input id="information_pic" name="information_pic" value="" class="ui-input w400" type="hidden"/>
            <div class="notic">图片大小不能超过2Mb</div>
        </dd>
    </dl>

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
  </form>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('information_desc', {
        toolbars: [
            [
                'fullscreen', 'source', '|', 'undo', 'redo', '|',
             'bold', 'italic', 'underline', 'forecolor', 'backcolor', 'justifyleft', 'justifycenter', 'justifyright', 'insertunorderedlist', 'insertorderedlist', 'blockquote',
             'emotion', 'insertvideo', 'link', 'removeformat', 'rowspacingtop', 'rowspacingbottom', 'lineheight', 'paragraph', 'fontsize', 'inserttable', 'deletetable', 'insertparagraphbeforetable',
             'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols'
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
<script type="text/javascript" src="<?=$this->view->js?>/controllers/information/reply_list.js" charset="utf-8"></script>

<script>
    /* 图片上传 start @刘贵龙 20170607*/
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
                    content: "url: <?= YLB_Registry::get('url') ?>?ctl=Index&met=cropperImage&typ=e",
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
    /* 图片上传 end @刘贵龙 20170607*/
</script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>