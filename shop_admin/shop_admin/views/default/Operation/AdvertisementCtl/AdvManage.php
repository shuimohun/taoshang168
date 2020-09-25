<?php if (!defined('ROOT_PATH')) {
    exit('No Permission');
} ?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>
    <link href="<?= $this->view->css ?>/index.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?= $this->view->css_com ?>/jquery/plugins/validator/jquery.validator.css">
    <link href="<?= $this->view->css_com ?>/webuploader.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?= $this->view->js ?>/controllers/adv/laydate/laydate.js" charset="utf-8"></script>

    <style>
        body {background: #fff;}
        .mod-form-rows .label-wrap {font-size: 12px;}
        .mod-form-rows .row-item {padding-bottom: 15px;margin-bottom: 0;}
        /*兼容IE7 ，重写common的演示*/
        .manage-wrapper {margin: 20px auto 10px;width: 600px;}
        .manage-wrap .ui-input {width: 198px;}
        .base-form {*zoom: 1;}
        .base-form:after {content: '.';display: block;clear: both;height: 0;overflow: hidden;}
        .base-form li {float: left;width: 290px;}
        .base-form li.odd {padding-right: 20px;}
        .base-form li.last {width: 350px}
        .manage-wrap textarea.ui-input {width: 588px;height: 32px;overflow: hidden;}
        .contacters {margin-bottom: 10px;}
        .contacters h3 {margin-bottom: 10px;font-weight: normal;}
        .remark .row-item {padding-bottom: 0;}
        .mod-form-rows .ctn-wrap {overflow: visible;}
        .grid-wrap .ui-jqgrid {border-width: 1px 0 0 1px;}
        .labels {margin-left: 10px;}
        .laydate-icon {padding: 5px;width: 198px;height: 18px;line-height: 18px;border: 1px solid #e2e2e2;color: #555;outline: 0;}
        .webuploader-container div {width: 30%;}
    </style>
    </head>
    <body>

    <form method="post" enctype="multipart/form-data" id="shop_form" name="form1">

        <input id="shop_id" name="shop_id" value="<?=$data['shop_id'] ?>" type="hidden"/>
        <div class="ncap-form-default">

            <dl class="row">
                <dt class="tit">
                    <label for="retain_domain">广告名称</label>
                </dt>
                <dd class="opt">
                    <input id="adv_name" name="adv_name" class="ui-input w200" type="text"/>
                </dd>
            </dl>

<!--            <dl class="row">-->
<!--                <dt class="tit">-->
<!--                    <label for="retain_domain">图片宽度</label>-->
<!--                </dt>-->
<!--                <dd class="opt">-->
<!--                    <input  name="width" class="ui-input w200" type="text" value=""/>-->
<!--                </dd>-->
<!--            </dl>-->
<!--            -->
<!--            <dl class="row">-->
<!--                <dt class="tit">-->
<!--                    <label for="retain_domain">图片高度</label>-->
<!--                </dt>-->
<!--                <dd class="opt">-->
<!--                    <input  name="height" class="ui-input w200" type="text" value=""/>-->
<!--                </dd>-->
<!--            </dl>-->
            <dl class="row">
                <dt class="tit">
                    <label for="domain_length">所属广告位</label>
                    <input id="group_id" name="group_id" value="<?=$data['group_id'] ?>" class="ui-input w200"
                           type="hidden"/>
                </dt>
                <dd class="opt">
                    <span id="group"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
<!---->
<!--            <dl class="row">-->
<!--                <dt class="tit">-->
<!--                    <label for="domain_length">所属店铺</label>-->
<!--                    <input id="shop_id" name="shop_id" value="--><?//= $data['shop_id'] ?><!--" class="ui-input w200"-->
<!--                           type="hidden"/>-->
<!--                </dt>-->
<!--                <dd class="opt">-->
<!--                    <span id="shop"></span>-->
<!--                    <p class="notic"></p>-->
<!--                </dd>-->
<!--            </dl>-->

            <dl class="row">
                <dt class="tit">
                    <span id="advs_type"></span>
                    <input id="advs_type_id" name="advs_type_id" value="<?=$data['advs_type_id'] ?>" class="ui-input w200" type="hidden"/>
                </dt>
                <dd class="opt">
                    <input  type="text" value="" class="ui-input w200" id="keyword"/>
                </dd>
            </dl>

            <dl class="row">
                <dt class="tit">
                    <label for="stime">开始时间</label>
                </dt>
                <dd class="opt">
                    <input placeholder="请输入日期" class="laydate-icon" onclick="laydate()" id="stime" name="stime"
                           type="text"/>
                </dd>
            </dl>

            <dl class="row">
                <dt class="tit">
                    <label for="etime">结束时间</label>
                </dt>
                <dd class="opt">
                    <input placeholder="请输入日期" class="laydate-icon" onclick="laydate()" id="etime" name="etime"
                           type="text"/>
                </dd>
            </dl>

            <dl class="row">
                <dt class="tit">
                    <label>是否审核</label>
                </dt>
                <dd class="opt">
                    <div class="onoff">
                        <label for="open_state1" class="cb-enable  ">是</label>
                        <label for="open_state0" class="cb-disable  selected">否</label>
                        <input id="open_state1" name="open_state" value="1" type="radio">
                        <input id="open_state0" name="open_state" checked="checked" value="0" type="radio">
                    </div>
                </dd>
            </dl>

<!--            <dl class="row">-->
<!--                <dt class="tit">-->
<!--                    <label>活动地址</label>-->
<!--                </dt>-->
<!--                <dd class="opt">-->
<!--                    <input id="url" name="url" placeholder="可输入 店铺\商品\活动\专题 地址" class="ui-input w200" type="text"/>-->
<!--                </dd>-->
<!--            </dl>-->

            <dl class="row">
                <dt class="tit">
                    <label>描述</label>
                </dt>
                <dd class="opt">
                    <input id="con" name="con" class="ui-input w200" type="text"/>
                </dd>
            </dl>


            <dl class="row">
                <dt class="tit">
                    <label for="brnad_image">图片上传</label>
                </dt>
                <dd class="opt">
                    <img id="brand_image" name="setting[brand_logo]" alt="选择图片" src="./shop_admin/static/common/images/image.png" class="image-line"/>
                    <div class="image-line" style="margin-left: 80px;" id="brand_upload">上传图片<i class="iconfont icon-tupianshangchuan"></i></div>
                    <input id="brand_logo" name="setting[brand_logo]" class="ui-input w400" type="hidden"/>
                </dd>
            </dl>

        </div>
    </form>
    <script>
        //图片上传
        $(function () {
            buyer_logo_upload = new UploadImage({
                thumbnailWidth: <?php echo $data['adv']['width'] ? $data['adv']['width']:800; ?>,
                thumbnailHeight:<?php echo $data['adv']['height'] ? $data['adv']['height']:500; ?>,
                imageContainer: '#brand_image',
                uploadButton: '#brand_upload',
                inputHidden: '#brand_logo'
            });
        })
    </script>
    <script type="text/javascript" src="<?= $this->view->js_com ?>/webuploader.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?= $this->view->js ?>/models/upload_image.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?= $this->view->js ?>/controllers/adv/ListAdvNav.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?= $this->view->js ?>/controllers/adv/Advms.js" charset="utf-8"></script>

    <script>
        var shop_id = <?=$data['shop_id'] ?>;
        var shop_row = <?= encode_json(array_values($data['shop'])) ?>;
        var group_id = <?=$data['group_id']?>;
        var group_row = <?= encode_json(array_values($data['group'])) ?>;
        var advs_type_id = <?=$data['advs_type_id']?>;
        var advs_type_row = <?= encode_json(array_values($data['adv_type'])) ?>;
    </script>

<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>