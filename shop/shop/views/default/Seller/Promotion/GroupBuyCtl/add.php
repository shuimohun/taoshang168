<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
<div class="form-style">
    <form method="post" id="form" action="<?=YLB_Registry::get('url')?>?ctl=Seller_Promotion_GroupBuy&met=add&typ=e">
        <dl>
            <dt><i>*</i><?=_('团购名称')?>：</dt>
            <dd>
                <input type="text" name="groupbuy_name" class="text w450"/>
                <p class="hint"><?=_('团购标题名称长度最多可输入30个字符')?></p>
            </dd>
        </dl>
        <dl>
            <dt><?=_('团购副标题')?>：</dt>
            <dd>
                <input type="text" name="groupbuy_remark" class="text w450"/>
                <p class="hint"><?=_('团购活动副标题最多可输入60个字符')?></p>
            </dd>
        </dl>

        <dl>
            <dt><i>*</i><?=_('开始时间')?>：</dt>
            <dd>
                <input type="text" readonly="readonly" autocomplete="off" name="groupbuy_starttime" id="start_time" class="text w100"/><em><i class="iconfont icon-rili"></i></em>
                <p class="hint"><?=_('团购开始时间不能小于')?><?=$data['combo']['combo_starttime']?></p>
            </dd>
        </dl>
        <dl>
            <dt><i>*</i><?=_('结束时间')?>：</dt>
            <dd>
                <input type="text" readonly="readonly" autocomplete="off" name="groupbuy_endtime" id="end_time" class="text w100 hasDatepicker"/><em><i class="iconfont icon-rili"></i></em>
                <?php if($shop_type){ ?>
                <?php }else{ ?>
                    <p class="hint"><?=_('团购结束时间不能大于')?><?=$data['combo']['combo_endtime']?></p>
                <?php } ?>
            </dd>
        </dl>

        <dl>
            <dt><i>*</i><?=_('团购商品')?>：</dt>
            <dd>
                <div class="selected-goods fn-hide" hidden="true">
                    <div class="goods-image"><img src="" /></div>
                    <div class="goods-name"></div>
                    <div class="goods-price"><?=_('销售价')?>：<span></span></div>
                </div>
                <a class="bbc_seller_btns button button_blue btn_show_search_goods" href="javascript:void(0);"><?=_('选择商品')?></a>
                <input type="hidden" name="goods_id" id="goods_id" value="" />
                <input type="hidden" name="common_id" id="common_id" value="" />
                <div class="search-goods-list fn-clear">
                    <div class="search-goods-list-hd">
                        <label><?=_('搜索店内商品')?></label>
                        <input type="text" name="goods_name" class="text w200" id="key" value="" placeholder="请输入商品名称"/>
                        <a class="button btn_search_goods" href="javascript:void(0);"><i class="iconfont icon-btnsearch"></i><?=_('搜索')?></a>
                    </div>
                    <div class="search-goods-list-bd fn-clear"></div>
                    <a href="javascript:void(0);" class="close btn_hide_search_goods">X</a>
                </div>
                <p class="hint"><?=_('点击上方输入框从已发布商品中选择要参加团购的商品')?></p>
                <p class="hint"><?=_('团购生效后该商品的所有规格SKU都将执行统一的团购价格')?>。</p>
            </dd>
        </dl>
        <dl class="goods_price" style="display:none;">
            <dt><?=_('店铺价格')?>：</dt>
            <dd><span></span><input type="hidden" id="goods_price" value></dd>
        </dl>
        <dl>
            <dt><i>*</i><?=_('团购价格')?>：</dt>
            <dd>
                <input type="text" name="groupbuy_price" class="text" style="width:78px;"/><em><?=Web_ConfigModel::value('monetary_unit')?></em>
                <p class="hint"><?=_('团购价格为该商品参加活动时的促销价格')?></p>
                <p class="hint"><?=_('必须是0.01~1000000之间的数字')?>(<?=_('单位：')?><?=Web_ConfigModel::value('monetary_unit')?>)</p>
            </dd>
        </dl>
        <dl>
            <dt><i>*</i><?=_('团购活动图片')?>：</dt>
            <dd>
                <p class="pic groupbuy_image_review" style="width:400px;height:400px;display:none;">
                    <img id="groupbuy_image_review" src="" width="400" height="400"/>
                </p>
                <p class="upload-button">
                    <input type="hidden" id="group_buy_image" name="groupbuy_image" value="" />
                    <div  id='groupbuy_upload' class="lblock bbc_img_btns" ><i class="iconfont icon-tupianshangchuan" ></i><?=_('图片上传')?></div>
                </p>
                <p class="hint"><?=_('此处为团购活动图片')?>；</p>
                <p class="hint"><?=_('建议使用宽400像素-高400像素内的透明图片,点击下方"提交"按钮后生效')?>。</p>
            </dd>
        </dl>
        <dl>
            <dt><?=_('团购推荐位图片')?>：</dt>
            <dd>
                <p class="pic groupbuy_image1_review" style="width:200px;height:100px;display:none;">
                    <img id="groupbuy_image1_review" src=""  width="200"  height="100"/>
                </p>
                <p class="upload-button">
                    <input type="hidden" id="groupbuy_image_rec" name="groupbuy_image_rec" value="" />
                    <div  id='groupbuy_upload_rec' class="lblock bbc_img_btns" ><i class="iconfont icon-tupianshangchuan" ></i><?=_('图片上传')?></div>
                </p>
                <p class="hint"><?=_('此处为团购推荐位图片')?>；</p>
                <p class="hint"><?=_('建议使用宽612像素-高318像素内的透明图片；点击下方"提交"按钮后生效')?>。</p>
            </dd>
        </dl>
        <dl>
            <dt><?=_('团购类别')?>：</dt>
            <dd>
                <select id="class_id" name="groupbuy_cat_id" class="w80">
                    <option value="0"><?=_('不限')?></option>
                </select>
                <select id="s_class_id" name="groupbuy_scat_id" class="w80">
                    <option value="0"><?=_('不限')?></option>
                </select>
                <span></span>
                <p class="hint"><?=_('请选择团购商品的所属类别')?></p>
            </dd>
        </dl>

        <dl>
            <dt><?=_('虚拟数量')?>：</dt>
            <dd>
                <input type="text" name="groupbuy_virtual_quantity" value="0" class="text w70"/>
                <p class="hint"><?=_('虚拟购买数量，只用于前台显示，不影响成交记录')?></p>
            </dd>
        </dl>
        <dl>
            <dt><?=_('限购数量')?>：</dt>
            <dd>
                <input type="text" name="groupbuy_upper_limit" value="0" class="text w70"/>
                <p class="hint"><?=_('每个买家ID可团购的最大数量，不限数量请填 "0"')?></p>
            </dd>
        </dl>


        <dl>
            <dt><?=_('本团介绍')?>：</dt>
            <dd>
                <script id="container" style="width:750px;height:300px;" name="groupbuy_intro" type="text/plain"></script>
                <!-- 配置文件 -->
                <script type="text/javascript" src="<?= $this->view->js_com ?>/ueditor/ueditor.config.js"></script>
                <!-- 编辑器源码文件 -->
                <script type="text/javascript" src="<?= $this->view->js_com ?>/ueditor/ueditor.all.js"></script>
                <script type="text/javascript" src="<?= $this->view->js_com ?>/upload/addCustomizeButton.js"></script>
                <!-- 实例化编辑器 -->
                <script type="text/javascript">
                    var ue = UE.getEditor('container', {
                        toolbars: [
                            [
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
                <link href="./shop/static/common/css/jquery/plugins/dialog/green.css" rel="stylesheet">
                <script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/jquery.dialog.js"></script>
                <p class="hint"></p>
            </dd>
        </dl>

        <dl>
            <dt></dt>
            <dd>
                <input type="submit" class="button button_blue bbc_seller_submit_btns" value="提交"  />
                <input type="hidden" name="act" value="save" />
            </dd>
        </dl>
    </form>
</div>

<script type="text/javascript" src="<?=$this->view->js_com?>/webuploader.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/upload/upload_image.js" charset="utf-8"></script>
<link href="<?= $this->view->css_com ?>/webuploader.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
   $(document).ready(function(){
       /* 开始时间限制*/
        var s_date = $.trim("<?=$data['combo']['combo_starttime']?>");
        var mindate =  new Date(Date.parse(s_date.replace(/-/g, "/")));

      /* 结束时间限制*/
        var combo_end_time = $.trim("<?=$data['combo']['combo_endtime']?>");
        var maxdate = new Date(Date.parse(combo_end_time.replace(/-/g, "/")));

         $('#start_time').datetimepicker({
            controlType: 'select',
            minDate:mindate,
			onShow:function( ct ){
			this.setOptions({
				maxDate:($('#end_time').val() && (new Date(Date.parse($('#end_time').val().replace(/-/g, "/"))) < maxdate))?(new Date(Date.parse($('#end_time').val().replace(/-/g, "/")))):maxdate
				})
			}
		});

        $('#end_time').datetimepicker({
            controlType: 'select',
            maxDate:maxdate,
			onShow:function( ct ){
			this.setOptions({
				minDate:($('#start_time').val() && (new Date(Date.parse($('#start_time').val().replace(/-/g, "/")))) > (new Date()))?(new Date(Date.parse($('#start_time').val().replace(/-/g, "/")))):(new Date())
				})
			}
        });

       $('#groupbuy_upload').on('click', function () {
           $.dialog({
               title: '图片裁剪',
               content: "url: <?= YLB_Registry::get('url') ?>?ctl=Upload&met=cropperImage&typ=e",
               data: {width:400,height:400 , callback: callback1 },    // 需要截取图片的宽高比例
               width: '800px',
               lock: true
           })
       });

       function callback1( respone , api ) {
           $('#groupbuy_image_review').attr('src', respone.url);
           $('.groupbuy_image_review').show();
           $('#group_buy_image').attr('value', respone.url);
           api.close();
       }

       if ( window.isIE8 ) {
           $('#groupbuy_upload').off("click");

           new UploadImage({
               thumbnailWidth: 200,
               thumbnailHeight: 60,
               imageContainer: '#groupbuy_image_review',
               uploadButton: '#groupbuy_upload',
               inputHidden: '#group_buy_image'
           });
       }

       //推荐位图片上传
        $('#groupbuy_upload_rec').on('click', function () {
           $.dialog({
               title: '图片裁剪',
               content: "url: <?= YLB_Registry::get('url') ?>?ctl=Upload&met=cropperImage&typ=e",
               data: {width:612,height:318 , callback: callback2 },    // 需要截取图片的宽高比例
               width: '800px',
               /*height: '310px',*/
               lock: true
           })
        });

        function callback2( respone , api ) {
            $('#groupbuy_image1_review').attr('src', respone.url);
            $('.groupbuy_image1_review').show();
            $('#groupbuy_image_rec').attr('value', respone.url);
            api.close();
        }

       if ( window.isIE8 ) {
           $('#groupbuy_upload_rec').off("click");

           new UploadImage({
               thumbnailWidth: 200,
               thumbnailHeight: 60,
               imageContainer: '#groupbuy_image1_review',
               uploadButton: '#groupbuy_upload_rec',
               inputHidden: '#groupbuy_image_rec'
           });
       }

        $(".btn_show_search_goods").on('click', function() {
            $('.search-goods-list').show();
            $('.btn_search_goods').click();
        });
        $(".btn_hide_search_goods").on('click', function() {
            $('.search-goods-list').hide();
        });
        //搜索店铺商品
        $('.btn_search_goods').on('click', function() {
            var url = "index.php?ctl=Seller_Promotion_GroupBuy&met=getShopGoods&typ=e";
            var key = $("#key").val();
            url = key ? url + "&goods_name=" + key : url;
            $('.search-goods-list-bd').load(url);
        });
        //分页
        $('.search-goods-list-bd').on('click', '.page a', function() {
            $('.search-goods-list-bd').load($(this).attr('href'));
            return false;
        });
        $('.search-goods-list-bd').on('click', '[data-type="btn_add_goods"]', function(){
            var goods_id = $(this).attr('data-id');
            var common_id = $(this).attr('common-id');
            var goods_name = $(this).parents("li").find(".goods-name").html();
            var goods_price = $(this).parents("li").find(".goods-price span").html();
            var goods_image = $(this).parents("li").find("img").attr("src");
            $("input[name='goods_id']").val(goods_id);
            $("input[name='common_id']").val(common_id);
            $(".selected-goods").find("img").attr("src",goods_image);
            $(".selected-goods").find(".goods-name").html(goods_name);
            $(".selected-goods").find(".goods-price").find("span").html(goods_price);
            $(".goods_price").find("span").html(goods_price);
            $("#goods_price").val(goods_price);
            $(".selected-goods").show();
            $(".goods_price").show();
            $('.search-goods-list').hide();
        });

       (function(data) {
           var s = '<option value="0">不限</option>';
           if (typeof data.children != 'undefined') {
               if (data.children[0]) {
                   $.each(data.children[0], function(k, v) {
                       s += '<option value="'+v+'">'+data['name'][v]+'</option>';
                   });
               }
           }
           $('#class_id').html(s).change(function() {
               var ss = '<option value="0">不限</option>';
               var v = this.value;
               if (parseInt(v) && data.children[v]) {
                   $.each(data.children[v], function(kk, vv) {
                       ss += '<option value="'+vv+'">'+data['name'][vv]+'</option>';
                   });
               }
               $('#s_class_id').html(ss);
           });
       })($.parseJSON('<?=$data['groupbuy_cat']?>'));



    $('#form').validator({
            debug:true,
            //ignore: ':hidden',
            theme: 'yellow_right',
            timely: true,
            stopOnError: true,
            rules:{
                noGreaterThanGoodsPrice:function(element) {
                    var goods_price = $("#goods_price").val();
                    return Number(element.value) < Number(goods_price) || '团购价格必须小于商品价格！';
                },
				
				 //自定义规则,大于当前时间，如果通过返回true，否则返回错误消息
                greaterThanStartDate : function(element, param, field)
                {
                    var date1 = new Date(Date.parse((element.value).replace(/-/g, "/")));//开始时间
                    param = JSON.parse(param);
                    var date2 = new Date(Date.parse(param.replace(/-/g, "/")));	//套餐开始时间

                    return date1 > date2 || "活动开始时间不能小于"+ param;
                },
                //自定义规则，小于套餐活动结束时间
                lessThanEndDate  : function(element, param, field)
                {
                    var date1 = new Date(Date.parse((element.value).replace(/-/g, "/")));//选择的结束时间
                    param = JSON.parse(param);
                    var date2 = new Date(Date.parse(param.replace(/-/g, "/")));  //套餐结束时间
                    return date1 < date2 || "活动结束时间不能大于"+ param;
                },
                //自定义规则，结束时间大于开始时间
                startGrateThansEndDate  : function(element, param, field)
                {
                    var s_time = $("#start_time").val();
                    var date1 = new Date(Date.parse(element.value.replace(/-/g, "/")));
                    var date2 = new Date(Date.parse(s_time.replace(/-/g, "/")));

                    return date1 > date2 || "结束时间必须大于开始时间";
                },
                myRemote: function(element){
                    var start_time = $("#start_time").val();
                    var end_time = $("#end_time").val();
                    var flag = false;
                    $.ajax({
                        url: SITE_URL + '?ctl=Seller_Promotion_GroupBuy&met=checkGroupBuyGoods&typ=json',
                        type: 'POST',
                        data:{start_time: start_time,end_time:end_time,common_id: element.value},
                        dataType: 'json',
                        async: false,
                        success: function(d){
                            //window.console && console.log(d);
                            if(d.status ==200)
                            {
                                flag = true;
                            }
                            else
                                flag = false;
                        }
                    });
                    return flag;
                }
            },
            messages: {
                myRemote: "该商品已经参加了同时段的活动"
            },
            fields: {
                'groupbuy_name': 'required;length[~30]',
                'groupbuy_remark': 'length[~60]',
                'groupbuy_starttime':'required;greaterThanStartDate["<?=$data['combo']['combo_starttime']?>"];lessThanEndDate["<?=$data['combo']['combo_endtime']?>"];',
                'groupbuy_endtime': 'required;lessThanEndDate["<?=$data['combo']['combo_endtime']?>"];startGrateThansEndDate;',
                'goods_id': 'required;integer[+];',
                'common_id': 'required;integer[+];myRemote;',
                'groupbuy_price': 'required;range[0.01~1000000];noGreaterThanGoodsPrice',
                'groupbuy_image': 'required;',
                'groupbuy_image_rec': 'required;',
                'groupbuy_virtual_quantity': 'integer[+0];',
                'groupbuy_upper_limit': 'integer[+0];'
            },
            valid: function(form){
                var me = this;
                // 提交表单之前，hold住表单，并且在以后每次hold住时执行回调
                me.holdSubmit(function(){
                    Public.tips.error('正在处理中...');
                });
                $.ajax({
                    url: "index.php?ctl=Seller_Promotion_GroupBuy&met=addGroupBuy&typ=json",
                    data: $(form).serialize(),
                    type: "POST",
                    success:function(e){
                        if(e.status == 200)
                        {
                            var data = e.data;
                            Public.tips.success('操作成功!');
                            setTimeout(window.location.href='index.php?ctl=Seller_Promotion_GroupBuy&met=index&typ=e',5000);
                            //成功后跳转
                        }
                        else
                        {
                            Public.tips.error('操作失败！');
                        }
                        me.holdSubmit(false);
                    }
                });
            }
        });
    });
</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>

