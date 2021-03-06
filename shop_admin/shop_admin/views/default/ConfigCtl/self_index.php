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
    .webuploader-pick{ padding:1px; }
    
</style>
</head>
<body>
<div class="wrapper page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>模板风格</h3>
                <h5>自营店铺首页幻灯将在自营店铺首页展示</h5>
            </div>
            <ul class="tab-base nc-row">
                <?php
                $data_theme = $this->getUrl('Config', 'siteTheme', 'json', null, array('config_type'=>array('site')));

                $theme_id = $data_theme['theme_id']['config_value'];
    
                foreach ($data_theme['theme_row'] as $k => $theme_row)
                {
                    if ($theme_id == $theme_row['name'])
                    {
                        $config = $theme_row['config'];
                        break;
                    }
                }
                ?>
                <li><a class="current" href="<?= YLB_Registry::get('url') ?>?ctl=Config&met=self_index&config_type%5B%5D=self_index"><span>自营店铺首页幻灯片</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Self_Adpage&met=adpage"><span>自营店铺首页模板</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Config&met=self_index_img&config_type%5B%5D=self_index_img"><span>自营店铺首页小图</span></a></li>
            </ul>
        </div>
    </div>
    <p class="warn_xiaoma"><span></span><em></em></p><div class="explanation" id="explanation">
        <div class="title" id="checkZoom"><i class="iconfont icon-lamp"></i>
          <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
          <span id="explanationZoom" title="收起提示"></span><em class="close_warn iconfont icon-guanbifuzhi"></em>
        </div>
        <ul>
              <li>该组幻灯片滚动图片应用于自营店铺首页使用，最多可上传5张图片。</li>
              <li>图片要求使用宽度为1920像素，高度为500像素jpg/gif/png格式的图片。</li>
              <li>上传图片后请添加格式为“http://网址...”链接地址，设定后将在显示页面中点击幻灯片将以另打开窗口的形式跳转到指定网址。</li>
        </ul>
    </div>

   <form method="post" enctype="multipart/form-data" id="self_index-setting-form" name="form1">
    <input type="hidden" name="config_type[]" value="self_index"/>
    <div class="ncap-form-default">
      <dl class="row">
        <dt class="tit">
          <label>滚动图片1</label>
        </dt>
        <dd class="opt">
             <img id="self_index1_review" src="<?php echo $data['self_index_image1']['config_value'];?>" width="760" height="200"/>
                <input type="hidden" id="self_index1_image" name="self_index[self_index_image1]" value="<?php echo $data['self_index_image1']['config_value'];?>" />
                <div  id='self_index1_upload' class="image-line upload-image" >图片上传</div>

           <label title="请输入图片要跳转的链接地址" ><i class="fa fa-link"></i>
                  <input class="ui-input w400" style="margin:5px 0" type="text" name="self_index[self_index_link1]" value="<?php echo $data['self_index_link1']['config_value'];?>" placeholder="请输入图片要跳转的链接地址">
           </label>
           <span class="err"><label for="index_live_link1" class="error valid"></label></span>
           <p class="notic">请使用宽度1920像素，高度500像素的jpg/gif/png格式图片作为幻灯片banner上传，<br>
            如需跳转请在后方添加以http://开头的链接地址。</p>
        </dd>
      </dl>

     <dl class="row">
        <dt class="tit">
          <label>滚动图片2</label>
        </dt>
        <dd class="opt">
                <img id="self_index2_review" src="<?php echo $data['self_index_image2']['config_value'];?>" width="760" height="200"/>
                <input type="hidden" id="self_index2_image" name="self_index[self_index_image2]" value="<?php echo $data['self_index_image2']['config_value'];?>" />
                <div  id='self_index2_upload' class="image-line upload-image" >图片上传</div>

           <label title="请输入图片要跳转的链接地址" ><i class="fa fa-link"></i>
                  <input class="ui-input w400" style="margin:5px 0" type="text" name="self_index[self_index_link2]" value="<?php  echo $data['self_index_link2']['config_value'];?>" placeholder="请输入图片要跳转的链接地址">
           </label>
           <span class="err"><label for="index_live_link2" class="error valid"></label></span>
           <p class="notic">请使用宽度1920像素，高度500像素的jpg/gif/png格式图片作为幻灯片banner上传，<br>
            如需跳转请在后方添加以http://开头的链接地址。</p>
        </dd>
      </dl>


    <dl class="row">
        <dt class="tit">
          <label>滚动图片3</label>
        </dt>
        <dd class="opt">
                <img id="self_index3_review" src="<?php echo $data['self_index_image3']['config_value'];?>" width="760" height="200"/>
                <input type="hidden" id="self_index3_image" name="self_index[self_index_image3]" value="<?php echo $data['self_index_image3']['config_value'];?>" />
                <div  id='self_index3_upload' class="image-line upload-image" >图片上传</div>

           <label title="请输入图片要跳转的链接地址" ><i class="fa fa-link"></i>
                  <input class="ui-input w400" style="margin:5px 0" type="text" name="self_index[self_index_link3]" value="<?php echo $data['self_index_link3']['config_value'];?>" placeholder="请输入图片要跳转的链接地址">
           </label>
           <span class="err"><label for="index_live_link3" class="error valid"></label></span>
           <p class="notic">请使用宽度1920像素，高度500像素的jpg/gif/png格式图片作为幻灯片banner上传，<br>
            如需跳转请在后方添加以http://开头的链接地址。</p>
        </dd>
      </dl>

    <dl class="row">
        <dt class="tit">
          <label>滚动图片4</label>
        </dt>
        <dd class="opt">
              <img id="self_index4_review" src="<?php echo $data['self_index_image4']['config_value'];?>" width="760" height="200"/>
                <input type="hidden" id="self_index4_image" name="self_index[self_index_image4]" value="<?php echo $data['self_index_image4']['config_value'];?>" />
                <div  id='self_index4_upload' class="image-line upload-image" >图片上传</div>

           <label title="请输入图片要跳转的链接地址" ><i class="fa fa-link"></i>
                  <input class="ui-input w400" style="margin:5px 0" type="text" name="self_index[self_index_link4]" value="<?php echo $data['self_index_link4']['config_value'];?>" placeholder="请输入图片要跳转的链接地址">
           </label>
           <span class="err"><label for="index_live_link4" class="error valid"></label></span>
           <p class="notic">请使用宽度1920像素，高度500像素的jpg/gif/png格式图片作为幻灯片banner上传，<br>
            如需跳转请在后方添加以http://开头的链接地址。</p>
        </dd>
      </dl>
       <dl class="row">
        <dt class="tit">
          <label>滚动图片5</label>
        </dt>
        <dd class="opt">
                <img id="self_index5_review" src="<?=$data['self_index_image5']['config_value']?>" width="760" height="200"/>
                <input type="hidden" id="self_index5_image" name="self_index[self_index_image5]" value="<?php echo $data['self_index_image5']['config_value'];?>" />
                <div  id='self_index5_upload' class="image-line upload-image" >图片上传</div>

           <label title="请输入图片要跳转的链接地址" ><i class="fa fa-link"></i>
                  <input class="ui-input w400" style="margin:5px 0" type="text" name="self_index[self_index_link5]" value="<?php if(isset(Perm::$row['sub_site_id']) && Perm::$row['sub_site_id']){echo $data['self_index_link5']['config_value'];}else{ echo $data['self_index_link5']['config_value'];}?>" placeholder="请输入图片要跳转的链接地址">
           </label>
           <span class="err"><label for="index_live_link5" class="error valid"></label></span>
           <p class="notic">请使用宽度1920像素，高度500像素的jpg/gif/png格式图片作为幻灯片banner上传，<br>
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
		
                //图片裁剪
                
                 var agent = navigator.userAgent.toLowerCase();

                 if ( agent.indexOf("msie") > -1 && (version = agent.match(/msie [\d]/), ( version == "msie 8" || version == "msie 9" )) ) {
                     self_index1_image_upload= new UploadImage({
                         thumbnailWidth: 1920,
                         thumbnailHeight: 500,
                         imageContainer: '#self_index1_review',
                         uploadButton: '#self_index1_upload',
                         inputHidden: '#self_index1_image'
                     });


                     self_index2_image_upload= new UploadImage({
                         thumbnailWidth: 1920,
                         thumbnailHeight: 500,
                         imageContainer: '#self_index2_review',
                         uploadButton: '#self_index2_upload',
                         inputHidden: '#self_index2_image'
                     });


                     self_index3_image_upload= new UploadImage({
                         thumbnailWidth: 1920,
                         thumbnailHeight: 500,
                         imageContainer: '#self_index3_review',
                         uploadButton: '#self_index3_upload',
                         inputHidden: '#self_index3_image'
                     });


                     self_index4_image_upload= new UploadImage({
                         thumbnailWidth: 1920,
                         thumbnailHeight: 500,
                         imageContainer: '#self_index4_review',
                         uploadButton: '#self_index4_upload',
                         inputHidden: '#self_index4_image'
                     });


                     self_index5_image_upload= new UploadImage({
                         thumbnailWidth: 1920,
                         thumbnailHeight: 500,
                         imageContainer: '#self_index5_review',
                         uploadButton: '#self_index5_upload',
                         inputHidden: '#self_index5_image'
                     });
                 } else {
                     var $imagePreview, $imageInput, imageWidth, imageHeight;

                     $('#self_index1_upload, #self_index2_upload, #self_index3_upload,#self_index4_upload,#self_index5_upload').on('click', function () {

                         if ( this.id == 'self_index1_upload' ) {
                             $imagePreview = $('#self_index1_review');
                             $imageInput = $('#self_index1_image');
                             imageWidth = 1920, imageHeight = 500;
                         } else if ( this.id == 'self_index2_upload' ) {
                             $imagePreview = $('#self_index2_review');
                             $imageInput = $('#self_index2_image');
                             imageWidth = 1920, imageHeight = 500;
                         }  else if ( this.id == 'self_index3_upload' ) {
                             $imagePreview = $('#self_index3_review');
                             $imageInput = $('#self_index3_image');
                             imageWidth = 1920, imageHeight = 500;
                         }else if ( this.id == 'self_index4_upload' ) {
                             $imagePreview = $('#self_index4_review');
                             $imageInput = $('#self_index4_image');
                             imageWidth = 1920, imageHeight = 500;
                         }else {
                             $imagePreview = $('#self_index5_review');
                             $imageInput = $('#self_index5_image');
                             imageWidth = 1920, imageHeight = 500;
                         }
                         console.info($imagePreview);
                         $.dialog({
                             title: '图片裁剪',
                             content: "url: <?= YLB_Registry::get('url') ?>?ctl=Index&met=cropperImage&typ=e",
                             data: { SHOP_URL: SHOP_URL, width: imageWidth, height: imageHeight, callback: callback },    // 需要截取图片的宽高比例
                             width: '800px',
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