<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/'  . 'header.php';
// 当前管理员权限
$admin_rights = $this->getAdminRights();
// 当前页父级菜单 同级菜单 当前菜单
$menus = $this->getThisMenus();
?>
    <link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
    <link href="<?= $this->view->css_com ?>/webuploader.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>

    <style>
        .webuploader-pick{ padding:1px; }
        /* */
    </style>
    </head>
    <body>

    <div class="wrapper page">
        <div class="fixed-bar">
            <div class="item-title">
                <div class="subject">
                    <h3><?=$menus['father_menu']['menu_name']?></h3>
                    <h5><?=$menus['father_menu']['menu_url_note']?></h5>
                </div>
                <ul class="tab-base nc-row">

                    <?php
                    foreach($menus['brother_menu'] as $key=>$val){
                        if(in_array($val['rights_id'],$admin_rights)||$val['rights_id']==0){
                            ?>
                            <li><a <?php if(!array_diff($menus['this_menu'], $val)){?> class="current"<?php }?> href="<?= YLB_Registry::get('url') ?>?ctl=<?=$val['menu_url_ctl']?>&met=<?=$val['menu_url_met']?><?php if($val['menu_url_parem']){?>&<?=$val['menu_url_parem']?><?php }?>"><span><?=$val['menu_name']?></span></a></li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
        <!-- 操作说明 -->
        <p class="warn_xiaoma"><span></span><em></em></p><div class="explanation" id="explanation">
            <div class="title" id="checkZoom"><i class="iconfont icon-lamp"></i>
                <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
                <span id="explanationZoom" title="收起提示"></span><em class="close_warn iconfont icon-guanbifuzhi"></em></div>
            <ul>
                <?=$menus['this_menu']['menu_url_note']?>
            </ul>
        </div>
        <form method="post" enctype="multipart/form-data" id="acquiesce-setting-form" name="form_acquiesce">
            <input type="hidden" name="config_type[]" value="photo"/>
            <div class="ncap-form-default">
                <dl class="row">
                    <dt class="tit">
                        <label>新闻首页左侧图片</label>
                    </dt>
                    <dd class="opt">
                        <img id="photo_left_image" name="photo[photo_left_logo]" alt="选择图片" src="<?=($left['config_value'])?>" width="335px" height="600px"/>

                        <div class="image-line upload-image" id="photo_left_upload">上传图片<i class="iconfont icon-tupianshangchuan"></i></div>

                        <input id="photo_left_logo"  name="photo[photo_left_logo]" value="<?=($right['config_value'])?>" class="ui-input w400" type="hidden"/>
                        <p class="notic">新闻首页左侧图片,最佳显示尺寸为335*600像素</p>
                    </dd>
                </dl>

                <dl class="row">
                    <dt class="tit">
                        <label>左侧图片链接</label>
                    </dt>
                    <dd class="opt">
                        <input id="photo_left_src"  value="" class="ui-input w400" type="text"/>
                        <p class="notic">新闻首页左侧图片点击链接</p>
                    </dd>
                </dl>



                <dl class="row">
                    <dt class="tit">
                        <label>新闻首页右侧图片</label>

                    </dt>
                    <dd class="opt" style="width: 30%;">

                        <img id="photo_right_image" name="photo[photo_right_logo]" alt="选择图片" src="<?=($data['photo_right_logo']['config_value'])?>" width="335px" height="600px"/>

                        <div class="image-line upload-image"  id="photo_right_upload">上传图片<i class="iconfont icon-tupianshangchuan"></i></div>

                        <input id="photo_right_logo" name="photo[photo_right_logo]" value="<?=($data['photo_right_logo']['config_value'])?>" class="ui-input w400" type="hidden"/>
                        <p class="notic">新闻首页右侧图片,最佳显示尺寸为335*600像素</p>
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="tit">
                        <label>右侧图片链接</label>
                    </dt>
                    <dd class="opt">
                        <input id="photo_right_src"   value="" class="ui-input w400" type="text"/>
                        <p class="notic">新闻首页右侧图片点击链接</p>
                    </dd>
                </dl>
                <div class="bot"> <a href="javascript:void(0);" class="ui-btn ui-btn-sp submit-btn">确认提交</a></div>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="<?=$this->view->js_com?>/webuploader.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?=$this->view->js?>/models/upload_image.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?=$this->view->js?>/controllers/config.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?= $this->view->js ?>/controllers/information/pic_list.js" charset="utf-8"></script>

    <script>
        $(function(){
            $('.tab-base').find('a').bind('click',function(){

                $('.tab-base').find('a').removeClass('current');
                $(this).addClass('current');
                $('form').css('display','none');
                $('form[name="form_'+$(this).attr('nctype')+'"]').css('display','');
            });
            $('form').css('display','none');
            $('form[name="form_acquiesce"]').css('display','');

            //图片上传
            function uploadImage() {
                var photo_index_left = new UploadImage({
                    thumbnailWidth: 335,
                    thumbnailHeight: 600,
                    imageContainer: '#photo_left_image',
                    uploadButton: '#photo_left_upload',
                    inputHidden: '#photo_left_logo'
                });



                var photo_index_right = new UploadImage({
                    thumbnailWidth: 335,
                    thumbnailHeight: 600,
                    imageContainer: '#photo_right_image',
                    uploadButton: '#photo_right_upload',
                    inputHidden: '#photo_right_logo'
                });

            }

            var agent = navigator.userAgent.toLowerCase();

            if ( agent.indexOf("msie") > -1 && (version = agent.match(/msie [\d]/), ( version == "msie 8" || version == "msie 9" )) ) {
                uploadImage();
            } else {
                cropperImage();
            }

            //图片裁剪

            function cropperImage() {
                var $imagePreview, $imageInput, imageWidth, imageHeight;

                $('#photo_left_upload, #photo_right_upload').on('click', function () {

                    if ( this.id == 'photo_left_upload' ) {
                        $imagePreview = $('#photo_left_image');
                        $imageInput = $('#photo_left_logo');
                        imageWidth = 335, imageHeight = 600;
                    } else {
                        $imagePreview = $('#photo_right_image');
                        $imageInput = $('#photo_right_logo');
                        imageWidth = 335, imageHeight = 600;
                    }
//            console.info($imagePreview);
                    $.dialog({
                        title: '图片裁剪',
                        content: "url: <?= YLB_Registry::get('url') ?>?ctl=Index&met=cropperImage&typ=e",
                        data: { SHOP_URL: SHOP_URL, width: imageWidth, height: imageHeight, callback: callback },    // 需要截取图片的宽高比例
                        width: '800px',
                        lock: true
                    })
                });

                function callback ( respone , api ) {
//            console.info($imagePreview);
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