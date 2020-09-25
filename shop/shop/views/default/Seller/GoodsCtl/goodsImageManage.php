<?php if (!defined('ROOT_PATH')){exit('No Permission');}
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
<link href="./shop/static/common/css/jquery/plugins/dialog/green.css" rel="stylesheet">
<script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/jquery.dialog.js"></script>
<script src="<?=$this->view->js_com?>/webuploader.js"></script>
<script src="<?=$this->view->js_com?>/upload/upload_image.js"></script>

<style>
    input[type=file] {
        opacity: 0;
    }
</style>
<div class="">
    <div class="goods">
        <ol class="step fn-clear clearfix add-goods-step">
            <li>
                <i class="icon iconfont icon-icoordermsg"></i>
                <h6>STEP 1</h6>

                <h2>选择分类</h2>
                <i class="arrow iconfont icon-btnrightarrow"></i>
            </li>
            <li class="cur">
                <i class="icon iconfont icon-shangjiaruzhushenqing"></i>
                <h6>STEP 2</h6>

                <h2>填写信息</h2>
                <i class="arrow iconfont icon-btnrightarrow"></i>
            </li>
            <li>
                <i class="icon iconfont icon-zhaoxiangji bbc_seller_color"></i>
                <h6 class="bbc_seller_color">STEP 3</h6>

                <h2 class="bbc_seller_color">上传图片</h2>
                <i class="arrow iconfont icon-btnrightarrow"></i>
            </li>
            <li>
                <i class="icon iconfont icon-icoduigou"></i>
                <h6>STEP 4</h6>

                <h2>发布成功</h2>
            </li>
            <li>
                <i class="icon iconfont icon-pingtaishenhe"></i>
                <h6>STEP 5</h6>

                <h2>平台审核</h2>
            </li>
        </ol>
        <div class="form-style">
            <div class="form-style-left">
                <form method="post" id="form" action="<?php echo YLB_Registry::get('url') . '?ctl=Seller_Goods&met=saveGoodsImage&typ=json&common_id=' . $common_id; ?>">
                    <?php if( empty($color) ) { ?>
                        <table class="image-list-table" cellpadding="5" cellspacing="1">
                            <tbody>
                            <tr>
                                <th colspan="5">颜色:&nbsp;&nbsp;无颜色</th>
                            </tr>
                            <tr>
                                <td>
                                    <div class="fore1">
                                        <img id="image_0_0_img"
                                             src="<?php echo $data['common_data']['common_image']; ?>">
                                        <input id="image_0_0" type="hidden" name="image[0][0][name]"
                                               value="<?php echo $data['common_data']['common_image']; ?>">
                                    </div>
                                    <div class="fore2">
                                        <p><i class="icon-ok-circle"></i><span>设为主图</span><input type="hidden" name="image[0][0][default]" value="1"></p>
                                        <a href="javascript:void(0)" nctype="del" class="del" title="移除">X</a>
                                    </div>
                                    <div class="fore3 up-label" id="image_0_0_button"><a href="javascript:void(0)">上传</a>
                                    </div>
                                    <div class="fore4">排序: <input class="text" maxlength="1" value="0" type="text"
                                                                  name="image[0][0][displayorder]"></div>
                                </td>
                                <td>
                                    <div class="fore1">
                                        <img width="100" id="image_0_1_img" src="">
                                        <input id="image_0_1" type="hidden" name="image[0][1][name]" value="">
                                    </div>
                                    <div class="fore2">
                                        <p><i class="icon-ok-circle"></i><span>设为主图</span><input type="hidden" name="image[0][1][default]" value="0"></p>
                                        <a href="javascript:void(0)" nctype="del" class="del" title="移除">X</a>
                                    </div>
                                    <div class="fore3 up-label" id="image_0_1_button"><a href="javascript:void(0)">上传</a>
                                    </div>
                                    <div class="fore4">排序: <input class="text" maxlength="1" value="0" type="text"
                                                                  name="image[0][1][displayorder]"></div>
                                </td>
                                <td>
                                    <div class="fore1">
                                        <img width="100" id="image_0_2_img" src="">
                                        <input id="image_0_2" type="hidden" name="image[0][2][name]" value="">
                                    </div>
                                    <div class="fore2">
                                        <p><i class="icon-ok-circle"></i><span>设为主图</span><input type="hidden" name="image[0][2][default]" value="0"></p>
                                        <a href="javascript:void(0)" nctype="del" class="del" title="移除">X</a>
                                    </div>
                                    <div class="fore3 up-label" id="image_0_2_button"><a href="javascript:void(0)">上传</a>
                                    </div>
                                    <div class="fore4">排序: <input class="text" maxlength="1" value="0" type="text"
                                                                  name="image[0][2][displayorder]"></div>
                                </td>
                                <td>
                                    <div class="fore1">
                                        <img width="100" id="image_0_3_img" src="">
                                        <input id="image_0_3" type="hidden" name="image[0][3][name]" value="">
                                    </div>
                                    <div class="fore2">
                                        <p><i class="icon-ok-circle"></i><span>设为主图</span><input type="hidden" name="image[0][3][default]" value="0"></p>
                                        <a href="javascript:void(0)" nctype="del" class="del" title="移除">X</a>
                                    </div>
                                    <div class="fore3 up-label" id="image_0_3_button"><a href="javascript:void(0)">上传</a>
                                    </div>
                                    <div class="fore4">排序: <input class="text" maxlength="1" value="0" type="text"
                                                                  name="image[0][3][displayorder]"></div>
                                </td>
                                <td>
                                    <div class="fore1">
                                        <img width="100" id="image_0_4_img" src="">
                                        <input id="image_0_4" type="hidden" name="image[0][4][name]" value="">
                                    </div>
                                    <div class="fore2">
                                        <p><i class="icon-ok-circle"></i><span>设为主图</span><input type="hidden" name="image[0][4][default]" value="0"></p>
                                        <a href="javascript:void(0)" nctype="del" class="del" title="移除">X</a>
                                    </div>
                                    <div class="fore3 up-label" id="image_0_4_button"><a href="javascript:void(0)">上传</a>
                                    </div>
                                    <div class="fore4">排序: <input class="text" maxlength="1" value="0" type="text"
                                                                  name="image[0][4][displayorder]"></div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <a class="button quota bbc_seller_btns " nctype="select-image" href="javascript:void(0)"><i class="iconfont icon-jia"></i>从图片空间中选择</a>
                    <?php } else { ?>
                        <?php foreach ($color as $key => $val) { ?>
                            <input type="hidden" name="is_color" value="1" />
                            <table class="image-list-table" cellpadding="5" cellspacing="1">
                                <tbody>
                                <tr>
                                    <th colspan="5">颜色:&nbsp;&nbsp;<?php echo $val; ?></th>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="fore1">
                                            <img width="100" width="102px" height="102px" id="image_<?php echo $key; ?>_0_img"src="<?php echo $common_image; ?>">
                                            <input id="image_<?= $key; ?>_0" type="hidden" name="image[<?php echo $key; ?>][0][name]"value="<?php echo $common_image; ?>">
                                        </div>
                                        <div class="fore2">
                                            <p><i class="icon-ok-circle"></i>
                                                <span>设为主图</span>
                                                <input type="hidden" name="image[<?= $key ?>][0][default]" value="1"></p>
                                            <a href="javascript:void(0)" nctype="del" class="del" title="移除">X</a>
                                        </div>
                                        <div class="fore3 up-label" id="image_<?php echo $key; ?>_0_button"><a href="javascript:void(0)">上传</a>
                                        </div>
                                        <div class="fore4">排序: <input class="text" maxlength="1" value="0" type="text"name="image[<?php echo $key; ?>][0][displayorder]"></div>
                                    </td>
                                    <td>
                                        <div class="fore1">
                                            <img width="100" id="image_<?php echo $key; ?>_1_img" src="">
                                            <input id="image_<?= $key; ?>_1" type="hidden" name="image[<?php echo $key; ?>][1][name]" value="">
                                        </div>
                                        <div class="fore2">
                                            <p><i class="icon-ok-circle"></i><span>设为主图</span><input type="hidden" name="image[<?= $key ?>][1][default]" value="0"></p>
                                            <a href="javascript:void(0)" nctype="del" class="del" title="移除">X</a>
                                        </div>
                                        <div class="fore3 up-label" id="image_<?php echo $key; ?>_1_button"><a href="javascript:void(0)">上传</a>
                                        </div>
                                        <div class="fore4">排序: <input class="text" maxlength="1" value="0" type="text"
                                                                      name="image[<?php echo $key; ?>][1][displayorder]"></div>
                                    </td>
                                    <td>
                                        <div class="fore1">
                                            <img width="100" id="image_<?php echo $key; ?>_2_img" src="">
                                            <input id="image_<?php echo $key; ?>_2" type="hidden" name="image[<?php echo $key; ?>][2][name]" value="">
                                        </div>
                                        <div class="fore2">
                                            <p><i class="icon-ok-circle"></i><span>设为主图</span><input type="hidden" name="image[<?= $key ?>][2][default]" value="0"></p>
                                            <a href="javascript:void(0)" nctype="del" class="del" title="移除">X</a>
                                        </div>
                                        <div class="fore3 up-label" id="image_<?php echo $key; ?>_2_button"><a href="javascript:void(0)">上传</a>
                                        </div>
                                        <div class="fore4">排序: <input class="text" maxlength="1" value="0" type="text"
                                                                      name="image[<?php echo $key; ?>][2][displayorder]"></div>
                                    </td>
                                    <td>
                                        <div class="fore1">
                                            <img width="100" id="image_<?php echo $key; ?>_3_img" src="">
                                            <input id="image_<?php echo $key; ?>_3" type="hidden" name="image[<?php echo $key; ?>][3][name]" value="">
                                        </div>
                                        <div class="fore2">
                                            <p><i class="icon-ok-circle"></i><span>设为主图</span><input type="hidden" name="image[<?= $key ?>][3][default]" value="0"></p>
                                            <a href="javascript:void(0)" nctype="del" class="del" title="移除">X</a>
                                        </div>
                                        <div class="fore3 up-label" id="image_<?php echo $key; ?>_3_button"><a href="javascript:void(0)">上传</a>
                                        </div>
                                        <div class="fore4">排序: <input class="text" maxlength="1" value="0" type="text"
                                                                      name="image[<?php echo $key; ?>][3][displayorder]"></div>
                                    </td>
                                    <td>
                                        <div class="fore1">
                                            <img width="100" id="image_<?php echo $key; ?>_4_img" src="">
                                            <input id="image_<?php echo $key; ?>_4" type="hidden" name="image[<?php echo $key; ?>][4][name]" value="">
                                        </div>
                                        <div class="fore2">
                                            <p><i class="icon-ok-circle"></i><span>设为主图</span><input type="hidden" name="image[<?= $key ?>][4][default]" value="0"></p>
                                            <a href="javascript:void(0)" nctype="del" class="del" title="移除">X</a>
                                        </div>
                                        <div class="fore3 up-label" id="image_<?php echo $key; ?>_4_button"><a href="javascript:void(0)">上传</a></a>
                                        </div>
                                        <div class="fore4">排序: <input class="text" maxlength="1" value="0" type="text"
                                                                      name="image[<?php echo $key; ?>][4][displayorder]"></div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <a class="button quota bbc_seller_btns " nctype="select-image" href="javascript:void(0)"><i class="iconfont icon-jia"></i>从图片空间中选择</a>
                        <?php } ?>
                    <?php } ?>
                    <div class="image-button">
                        <input type="submit" class="button button_black bbc_seller_submit_btns" value="提交">
                    </div>
                </form>
            </div>
            <div class="form-style-right">
                <h4>上传要求：</h4>
                <ul>
                    <li>1. 请使用jpg\jpeg\png等格式、单张大小不超过1M的正方形图片。</li>
                    <li>2. 上传图片最大尺寸将被保留为1280像素。</li>
                    <li>3. 每种颜色最多可上传5张图片。</li>
                    <li>4. 通过更改排序数字修改商品图片的排列显示顺序。</li>
                    <li>5. 图片质量要清晰，不能虚化，要保证亮度充足。</li>
                    <li>6. 操作完成后请点下一步，否则无法在网站生效。</li>
                </ul>
                <h4>建议:</h4>
                <ul>
                    <li>1. 主图为白色背景正面图。</li>
                    <li>2. 排序依次为正面图-&gt;背面图-&gt;侧面图-&gt;细节图。</li>
                </ul>
            </div>
        </div>
    </div>
</div>


<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>

<script>

    $(function () {
        //打开相册空间
        $('a[nctype="select-image"]').on('click', function () {
            var _this = $(this);
            aloneImage = $.dialog({
                content: 'url: ' + SITE_URL + '?ctl=Upload&met=image&typ=e',
                data: { callback: getImageList },
                height: 600,
                width: 900
            })

            function getImageList(imagelist) {
                //取出前五个
                var images = new Array(), count = 0;
                for (var i = 0; i < imagelist.length; i++) {
                    images.push( imagelist[i].src );
                }
                _this.prev('table').find('[name$="[name]"]').each( function (index, element) {
                    if ( element.value == '' && images.length >= count) {
                        if ( images[count] != undefined ) {
                            $(element).prev().attr('src', images[count]);
                            element.value = images[count];
                            count++;
                        }
                    }
                })
            }
        });

        //图片上传
        <?php if ( empty($color) ) { ?>
            for ( var i = 0; i < 5; i++ ) {
                new UploadImage({
                    thumbnailWidth: 102,
                    thumbnailHeight: 102,
                    imageContainer: '#image_0_' + i + '_img',
                    uploadButton: '#image_0_' + i + '_button',
                    inputHidden: '#image_0_' + i
                });
            }
        <?php } else { ?>
            <?php foreach ($color as $key => $val) { ?>
                    for ( var i = 0; i < 5; i++ ) {
                        new UploadImage({
                            thumbnailWidth: 102,
                            thumbnailHeight: 102,
                            imageContainer: '#image_<?php echo $key; ?>_' + i + '_img',
                            uploadButton: '#image_<?php echo $key; ?>_' + i + '_button',
                            inputHidden: '#image_<?php echo $key; ?>_' + i
                        });
                    }
            <?php } ?>
        <?php } ?>
    });

    if ( window.location.href.indexOf('action') > -1 ) {

        //编辑商品  编辑图片
        var common_id = <?= $common_data['common_id']; ?>;
        $li_img = $('.tabmenu').find('.active').removeClass('active bbc_seller_bg').children('a').prop('href', window.location.href.replace('edit_image', 'edit_goods')).html('编辑商品').parent('li').clone();
        $li_img.addClass('active bbc_seller_bg').children('a').html('编辑图片').prop('href', window.location.href);
        $('.tabmenu').find('ul').append($li_img);

        $('ol.step.fn-clear').remove();
    }

    $('#form').find('img').attr('width', '100px').attr('height', '85.22px');
    
    <?php if ( !empty($data['color_images']) ){ ?>
        <?php foreach ($data['color_images'] as $key => $val){ ?>
            <?php foreach ($val as $k => $v){ ?>
                $('#image_<?= $key; ?>_<?= $k; ?>_img').attr('src', '<?= $v['images_image']; ?>');
                $('#image_<?= $key; ?>_<?= $k; ?>').attr('value', '<?= $v['images_image']; ?>');
                $('[name="image[<?= $key; ?>][<?= $k; ?>][displayorder]"]').attr('value', '<?= $v['images_displayorder']; ?>');
                <?php if($v['images_is_default'] == 1) {?>
                    $('#image_<?= $key; ?>_<?= $k; ?>_img').parents('div').siblings('.fore2').addClass('bbc_seller_border');
                <?php }?>
            <?php } ?>
        <?php } ?>
    <?php } elseif ( !empty($data['goods_images']) ) { ?>
        <?php foreach ($data['goods_images'] as $k => $v){ ?>
            $('#image_0_<?= $k; ?>_img').attr('src', '<?= $v['images_image']; ?>');
            $('#image_0_<?= $k; ?>').attr('value', '<?= $v['images_image']; ?>');
            $('[name="image[0][<?= $k; ?>][displayorder]"]').attr('value', '<?= $v['images_displayorder']; ?>');
            <?php if($v['images_is_default'] == 1) {?>
                $('#image_0_<?= $k; ?>_img').parents('div').siblings('.fore2').addClass('bbc_seller_border');
            <?php }?>
        <?php } ?>
    <?php } ?>

    var def_img = BASE_URL + '/shop/static/common/images/image.png';

    $('a[nctype="del"]').on('click', function() {
        var $div = $($(this).parents('div').prev()[0]),
            $img = $div.find('img'),
            $input = $div.find('input');

        if ( $img.attr('src') != def_img ) {
            $img.attr('src', def_img);
            $input.attr('value', '');
        }
    });

    //设置主图
    $('.fore2').on('click', 'p', function () {

        var $div = $($(this).parents('div').prev()[0]),
            $img = $div.find('img'),
            $input = $(this).find('input');

        if ( $img.attr('src') != def_img && $input.attr('value') == 0 ) {
            var $tr = $(this).parents('tr');
            $tr.find('input[name$="[default]"]').attr('value', 0);
            $(this).find('input').attr('value', 1);
        }

        $(this).parents('tbody').removeClass('bbc_seller_border').find('p').css('display', '').find('span').html('设为主图');
        $(this).parent().addClass('bbc_seller_border').find('p').css('display', 'block').find('span').html('默认主图');
    });

    $('.fore2.bbc_seller_border > p').trigger('click');

</script>