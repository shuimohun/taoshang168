<?php
if(!defined('ROOT_PATH')){exit('No Permission');}

include $this->view->getTplPath() . '/' . 'header.php';

$admin_rights = $this->getAdminRights();
$menus = $this->getThisMenus();

?>

<link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
<link href="<?= $this->view->css_com ?>/webuploader.css" rel="stylesheet" type="text/css">
</head>
<style>
    .image-line {
        margin-bottom:5px;
    }
</style>

<body>

<div class="wrapper page">

    <!--头部 start-->
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
                        <li>
                            <a <?php if(!array_diff($menus['this_menu'], $val)){?> class="current"<?php }?> href="<?= YLB_Registry::get('url') ?>?ctl=<?=$val['menu_url_ctl']?>&met=<?=$val['menu_url_met']?><?php if($val['menu_url_parem']){?>&<?=$val['menu_url_parem']?><?php }?>">
                                <span><?=$val['menu_name']?></span>
                            </a>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
    </div>
    <!--头部 end-->

    <form method="post" enctype="multipart/form-data" id="discount-slider-form" name="mainForm">
        <input type="hidden" name="config_type[]" value="discountSlider">
        <div class="ncap-form-default">

            <dl class="row">
                <dt class="tit">
                    <label for="">轮播图片1</label>
                </dt>
                <dd class="opt">
                    <img id="slider1_review" src="<?=$data['discountSlider1_image']['config_value']?>" width="400">
                    <input type="hidden" id="slider1_image" name="discountSlider[discountSlider1_image]" value="<?=$data['discountSlider1_image']['config_value']?>" />
                    <div id="discountSlider1_upload" class="image-line upload-image">图片上传</div>

                    <label title="请输入图片要跳转的链接地址" class="mt10"><i class="fa fa-link"></i>
                        <input class="ui-input w400" type="text" name="discountSlider[dis_live_link1]" value="<?=$data['dis_live_link1']['config_value']?>" placeholder="请输入图片要跳转的地址">
                    </label>

                    <span class="err"><label for="dis_live_link1"></label></span>
                    <p class="notic">请使用宽度1920像素，高度400像素的jpg/gif/png格式图片作为幻灯片banner上传，<br>
                        如需跳转请在后方添加以http://开头的链接地址。</p>
                </dd>
            </dl>

            <dl class="row">
                <dt class="tit">
                    <label>轮播图片2</label>
                </dt>
                <dd class="opt">
                    <img id="slider2_review" src="<?=$data['discountSlider2_image']['config_value']?>" width="400"/>
                    <input type="hidden" id="slider2_image" name="discountSlider[discountSlider2_image]" value="<?=$data['discountSlider2_image']['config_value']?>" />
                    <div  id='discountSlider2_upload' class="image-line upload-image" >图片上传</div>

                    <label title="请输入图片要跳转的链接地址" class="mt10"><i class="fa fa-link"></i>
                        <input class="ui-input w400" type="text" name="discountSlider[dis_live_link2]" value="<?=$data['dis_live_link2']['config_value']?>" placeholder="请输入图片要跳转的链接地址">
                    </label>
                    <span class="err"><label for="dis_live_link2" class="error valid"></label></span>
                    <p class="notic">请使用宽度1920像素，高度400像素的jpg/gif/png格式图片作为幻灯片banner上传，<br>
                        如需跳转请在后方添加以http://开头的链接地址。</p>
                </dd>
            </dl>


            <dl class="row">
                <dt class="tit">
                    <label>轮播图片3</label>
                </dt>
                <dd class="opt">
                    <img id="slider3_review" src="<?=$data['discountSlider3_image']['config_value']?>" width="400"/>
                    <input type="hidden" id="slider3_image" name="discountSlider[discountSlider3_image]" value="<?=$data['discountSlider3_image']['config_value']?>" />
                    <div  id='discountSlider3_upload' class="image-line upload-image" >图片上传</div>

                    <label title="请输入图片要跳转的链接地址" class="mt10"><i class="fa fa-link"></i>
                        <input class="ui-input w400" type="text" name="discountSlider[dis_live_link3]" value="<?=$data['dis_live_link3']['config_value']?>" placeholder="请输入图片要跳转的链接地址">
                    </label>
                    <span class="err"><label for="dis_live_link3" class="error valid"></label></span>
                    <p class="notic">请使用宽度1920像素，高度400像素的jpg/gif/png格式图片作为幻灯片banner上传，<br>
                        如需跳转请在后方添加以http://开头的链接地址。</p>
                </dd>
            </dl>


            <dl class="row">
                <dt class="tit">
                    <label>轮播图片4</label>
                </dt>
                <dd class="opt">
                    <img id="slider4_review" src="<?=$data['discountSlider4_image']['config_value']?>" width="400"/>
                    <input type="hidden" id="slider4_image" name="discountSlider[discountSlider4_image]" value="<?=$data['discountSlider4_image']['config_value']?>" />
                    <div  id='discountSlider4_upload' class="image-line upload-image" >图片上传</div>

                    <label title="请输入图片要跳转的链接地址" class="mt10"><i class="fa fa-link"></i>
                        <input class="ui-input w400" type="text" name="discountSlider[dis_live_link4]" value="<?=$data['dis_live_link4']['config_value']?>" placeholder="请输入图片要跳转的链接地址">
                    </label>
                    <span class="err"><label for="dis_live_link4" class="error valid"></label></span>
                    <p class="notic">请使用宽度1920像素，高度400像素的jpg/gif/png格式图片作为幻灯片banner上传，<br>
                        如需跳转请在后方添加以http://开头的链接地址。</p>
                </dd>
            </dl>

            <div class="bot">
                <a href="javascript:void(0);" class="ui-btn ui-btn-sp submit-btn">确认提交</a>
            </div>

        </div>
    </form>

    <script type="text/javascript" src="<?=$this->view->js?>/controllers/config.js" charset="utf-8"></script>

    <script type="text/javascript" src="<?= $this->view->js_com ?>/webuploader.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?= $this->view->js ?>/models/upload_image.js" charset="utf-8"></script>


    <script>
        $(function(){
            $('#discountSlider1_upload').on('click',function(){
                $.dialog({
                    title:'图片裁剪',
                    content:"url:<?=YLB_Registry::get('url')?>?ctl=Index&met=cropperImage&typ=e",
                    data:{SHOP_URL:SHOP_URL,width:1920,height:400,callback:callback1},
                    width:'800px',
                    lock:true
                })
            });

            function callback1(response,api){
                $('#slider1_review').attr('src',response.url);
                $('#slider1_image').attr('value',response.url);
                api.close();
            }

            $('#discountSlider2_upload').on('click',function(){
                $.dialog({
                    title:'图片裁剪',
                    content:"url:<?=YLB_Registry::get('url')?>?ctl=Index&met=cropperImage&typ=e",
                    data:{SHOP_URL:SHOP_URL,width:1920,height:400,callback:callback2},
                    width:'800px',
                    lock:true
                })
            });

            function callback2(response,api){
                $('#slider2_review').attr('src',response.url);
                $('#slider2_image').attr('value',response.url);
                api.close();
            }

            $('#discountSlider3_upload').on('click',function(){
                $.dialog({
                    title:'图片裁剪',
                    content:"url:<?=YLB_Registry::get('url')?>?ctl=Index&met=cropperImage&typ=e",
                    data:{SHOP_URL:SHOP_URL,width:1920,height:400,callback:callback3},
                    width:'800px',
                    lock:true
                })
            });

            function callback3(response,api){
                $('#slider3_review').attr('src',response.url);
                $('#slider3_image').attr('value',response.url);
                api.close();
            }

            $('#discountSlider4_upload').on('click',function(){
                $.dialog({
                    title:'图片裁剪',
                    content:"url:<?=YLB_Registry::get('url')?>?ctl=Index&met=cropperImage&typ=e",
                    data:{SHOP_URL:SHOP_URL,width:1920,height:400,callback:callback4},
                    width:'800px',
                    lock:true
                })
            });

            function callback4(response,api){
                $('#slider4_review').attr('src',response.url);
                $('#slider4_image').attr('value',response.url);
                api.close();
            }



        })
    </script>



<?php
    include $this->view->getTplPath() . '/' . 'footer.php';
?>



















































