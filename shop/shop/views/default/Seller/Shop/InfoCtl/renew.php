<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
    <link href="<?= $this->view->css ?>/seller_center.css?ver=<?=VER?>" rel="stylesheet">

    <div class="tabmenu">
        <ul>
            <li ><a href="./index.php?ctl=Seller_Shop_Info&met=info&typ=e&act=category"><?=_('经营类目')?></a></li>
            <?php if($shop['shop_self_support']=="false"){ ?>
                <li ><a href="./index.php?ctl=Seller_Shop_Info&met=info&typ=e&act=info"><?=_('店铺信息')?></a></li>
                <li ><a href="./index.php?ctl=Seller_Shop_Info&met=info&typ=e&act=record"><?=_('续签记录')?></a></li>
                <li class="active bbc_seller_bg"><a href="./index.php?ctl=Seller_Shop_Info&met=info&typ=e&act=renew"><?=_('申请续签')?></a></li>
            <?php } ?>
        </ul>
    </div>

    <div class="alert">
        <ul>
            <li><?=_('1、店铺到期前 30 天可以申请店铺续签。')?></li>
            <li><?=_('1、店铺到期')?> <?=$shop["shop_end_time"]?> <?=_('可以在')?> <?=$frontmonth?> <?=_('开始申请店铺续签')?>。</li>
        </ul>
    </div>
    <div>
        <form id="form" method="post" >
            <div class="form-style">
                <?php if($shop["shop_end_time"] && get_date_time() > $frontmonth){?>
                    <dl>
                        <dt><i>*</i><?=_('店铺等级：')?></dt>
                        <dd>
                            <select name="shop_grade">
                                <?php if($grade){ foreach ($grade as $key => $value) { ?>
                                    <option  value="<?=$value['shop_grade_id']?>"><?=$value['shop_grade_name']?>（<?=_('费用：')?><?=$value['shop_grade_fee']?>）</option>
                                <?php }}?>
                            </select>
                        </dd>
                    </dl>
                    <dl>
                        <dt><i>*</i><?=_('开店时长：')?></dt>
                        <dd>
                            <select name="renew_time">
                                <option value="1"><?=_('1年')?></option>
                                <option value="2"><?=_('2年')?></option>
                                <option value="5"><?=_('5年')?></option>
                                <option value="10"><?=_('10年')?></option>
                            </select>
                        </dd>
                    </dl>
                    <dl>
                        <dt><i>*</i><?=_('收款方：')?></dt>
                        <dd>
                            北京淘尚壹陆捌网络科技有限公司
                        </dd>
                    </dl>
                    <dl>
                        <dt><i>*</i><?=_('开户行：')?></dt>
                        <dd>
                            中国建设银行北京洋桥支行
                        </dd>
                    </dl>
                    <dl>
                        <dt><i>*</i><?=_('收款账户：')?></dt>
                        <dd>
                            11050162510000000394
                        </dd>
                    </dl>
                    <dl>
                        <dt><i>*</i><?=_('上传凭证：')?></dt>
                        <dd>
                            <input class="text w250" style="float: left;"  id="payment_voucher" readonly="readonly"name="payment_voucher" type="text">
                            <p style="float:left; width:70px"  id="payment_upload" ><i class="iconfont icon-upload-alt"></i>图片上传</p>
                        </dd>
                    </dl>
                    <dl>
                        <dt><i>*</i><?=_('备注：')?></dt>
                        <dd>
                            <textarea class="text" name="payment_voucher_explain" style="width:400px;height: 100px"></textarea>
                        </dd>
                    </dl>
                    <dl>
                        <dt></dt>
                        <dd>
                            <input type="submit" class="button bbc_seller_submit_btns" value="<?=_('确认提交')?>">
                        </dd>
                    </dl>
                <?php } ?>
            </div>
        </form>
    </div>

    <script>
        function submitBtn(){
            $("#form").ajaxSubmit(function(message){
                if(message.status == 200) {
                    Public.tips.success('操作成功！');
                    window.setTimeout(location.reload(),3000);
                } else {
                    Public.tips.error('操作失败！');
                }
            });
            return false;
        }

        $(document).ready(function(){
            var ajax_url = './index.php?ctl=Seller_Shop_Info&met=addRenew&typ=json';
            $('#form').validator({
                ignore: ':hidden',
                theme: 'yellow_right',
                timely: 1,
                stopOnError: false,
                rules: {

                },
                fields: {

                },
                valid:function(form){
                    var me = this;
                    // 提交表单之前，hold住表单，防止重复提交
                    me.holdSubmit();
                    //表单验证通过，提交表单
                    $.ajax({
                        url: ajax_url,
                        data:$("#form").serialize(),
                        success:function(a){
                            if(a.status == 200) {
                                Public.tips.success('操作成功！');
                                window.setTimeout(location.reload(),3000);
                            } else {
                                Public.tips.error('操作失败！');
                            }
                        }
                    });
                }
            });

            new UploadImage({
                uploadButton: '#payment_upload',
                inputHidden: '#payment_voucher'
            });
        });
    </script>
    <script type="text/javascript" src="<?=$this->view->js_com?>/webuploader.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?=$this->view->js_com?>/upload/upload_image.js" charset="utf-8"></script>
    <link href="<?= $this->view->css_com ?>/webuploader.css" rel="stylesheet" type="text/css">

<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>

