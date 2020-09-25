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
    #recommend_form {
        display: none;
        /*border: solid;*/
        /*top: 50%;*/
        /*left: 30%;*/
        /*width: 700px;*/
        /*height: 300px;*/
        position: absolute;
        z-index: 1990;
        top:0px;
        left:0px;
        width: 100%;
        height: 100%;
    }
</style>
</head>
<body>
<form id="information_form" enctype="multipart/form-data" method="post">
    <input type="hidden" name="user_id" value="<?=Perm::$userId?>">
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
            <div class="ctn-wrap">

                <span nctype="gc1">
                    <select nctype="gc" data-deep="1">
                        <!--<option>请选择...</option>-->
                    </select>
                </span>
                <span nctype="gc2"></span>
                <span nctype="gc3"></span>
                <span nctype="gc4"></span>
                <p>请选择帮助分类（必须选到最后一级）</p>
                <input type="hidden" id="information_group_id" name="information_group_id" value="" class="mls_id">
            </div>
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
<!-- 选择商品 start -->
    <dl class="row">
        <dt class="tit">
            <label>推荐商品</label>
        </dt>
        <dd class="opt">
            <div class="image-line upload-image" id="information_goods_upload">推荐商品<i class="iconfont icon-tupianshangchuan"></i></div>

            <input id="information_goods_recommend" name="information_goods_recommend" value="" class="ui-input w400" type="hidden"/>
            <input id="information_goods_recommend_type" name="information_goods_recommend_type" value="" class="ui-input w400" type="hidden"/>
        </dd>
    </dl>

<!-- 选择商品 end -->

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
<!--<div id="recommend_form">-->
<form id="recommend_form" method="post">
    <div class="ncap-form-default">
        <dl class="row">
            <dt class="tit">
                <label for="article_title"><em>*</em>商品频道</label>
            </dt>
            <dd class="opt">
                    <select id="recommend_goods">
                        <option>请选择...</option>
                        <option data-id="0">新人</option>
                        <option data-id="1">惠抢购</option>
                        <option data-id="2">劲爆折扣</option>
                        <option data-id="3">送福免单</option>
                        <option data-id="4">优惠套餐</option>
                        <option data-id="5">商品</option>
                    </select>
                <input type="hidden" id="gc_id" name="gc_id" value="" class="mls_id">
                <input type="hidden" id="cat_name" name="cat_name" value="" class="mls_names">
            </dd>

        </dl>
        <dl class="row">
            <dt class="tit">
                <label for="article_title"><em>*</em>商品推荐</label>
            </dt>
            <dd class="opt">
                <input type="text" value="" name="goods_name" id="goods_name" class="ui-input">
                <a class="ui-btn" id="search">查询<i class="iconfont icon-btn02"></i></a>
                <span class="err"></span>
                <p class="notic"></p>
            </dd>
        </dl>

        <dl class="row" id="selected_goods_list">
            <dt class="tit">已推荐商品</dt>
            <dd class="opt">
                <input type="hidden" name="valid_recommend" id="valid_recommend" value="">
                <span class="err"></span>
                <ul class="dialog-goodslist-s1 goods-list scrollbar-box">
                </ul>
            </dd>
        </dl>
        <dl class="row">
            <dt class="tit">选择要推荐的商品</dt>
            <dd class="opt">
                <div id="show_recommend_goods_list" class="show-recommend-goods-list scrollbar-box"></div>
                <p class="notic">最多可推荐4个商品</p>
            </dd>
        </dl>
    </div>
<!--</div>-->
</form>
<!--    <div style="position: absolute;top: 730px;left: 700px;height: 27px;width: 136px;font-size: 19px;background-color: red;">保存推荐商品</div>-->
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
<script type="text/javascript" src="<?=$this->view->js?>/controllers/information/base_manage.js" charset="utf-8"></script>

<script>
   $(function () {
        var agent = navigator.userAgent.toLowerCase();
        if ( agent.indexOf("msie") > -1 && (version = agent.match(/msie [\d]/), ( version == "msie 8" || version == "msie 9" )) ) {
            information_pic_upload = new UploadImage({
                thumbnailWidth: 300,
                thumbnailHeight: 300,
                imageContainer: '#information_pic_image',
                uploadButton: '#information_pic_upload',
                inputHidden: '#information_pic'
            });
        } else {
            $('#information_pic_upload').on('click', function () {
                $.dialog({
                    title: '图片裁剪',
                    content: "url: <?= YLB_Registry::get('url') ?>?ctl=Index&met=cropperImage&typ=e",
                    data: {SHOP_URL: SHOP_URL, width: 300, height: 300, callback: callback},    // 需要截取图片的宽高比例
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
</script>
<!--    分步获取资讯分类  start-->
<script>
//    if(oper == 'add'){
        getCatList(0, $("span[nctype=gc1]>select"), false);
//    }
    $("span[nctype=gc1], span[nctype=gc2]").on('change', 'select', function (){
        var $select = $(this),
            p_id = $(this).val(),
            cat_name = $(this).children("option:checked").text();
        $("#information_group_id").val(p_id), $("#cat_name").val(cat_name);
        getCatList(p_id, $select, true);
    });
    function getCatList(p_id, $select, change) {

        var deep = $select.data('deep');
        switch (deep) {
            case 1 :
                $("span[nctype=gc2], span[nctype=gc3], span[nctype=gc4]").empty();
                break;
            case 2 :
                $("span[nctype=gc3], span[nctype=gc4]").empty();
                break;
            case 3 :
                $("span[nctype=gc4]").empty();
                break;
        }
        $.get(SITE_URL + '?ctl=Information_Base&met=getGroupByClass&typ=json', {p_id: p_id}, function(data){
            if (data.status == 200) {
                var option_rows = [], cat_data = data.data;
                if(cat_data.length > 0){
                    option_rows.push("<option value=>" + '请选择...' + "</option>");
                }
                for (var i = 0; i < cat_data.length; i++) {
                    option_rows.push("<option value=" + cat_data[i].information_group_id + ">" + cat_data[i].information_group_title + "</option>");
                }
                if (change){
                    if (option_rows.length > 0) {
                        //default first goods_cat
                        //$("#gc_id").val(cat_data[0].p_id), $("#cat_name").val(cat_data[0].cat_name);
                        var next_deep = deep + 1;
                        $("span[nctype=gc" + next_deep + "]").append("<select data-deep=" + next_deep + ">" + option_rows.join("") + "</select>");
                        //$("span[nctype=gc" + next_deep + "]").children("option").eq(0).trigger("click");
                    }
                } else {
                    $select.append(option_rows.join(""));
                }

            } else {
                Public.tips.error(data.msg);
            }
        })

    }
</script>
<!--    分步获取资讯分类  start-->
<!--推荐商品 Start-->
    <script>

        $('#information_goods_upload').click(function () {
            $('#recommend_form').css('display','block');
            $('#information_form').css('display','none');
        });
        $('#recommend_goods').change(function () {
            var options=$("#recommend_goods option:selected");
            goods_group = options.attr('data-id');
            $.get(SITE_URL + '?ctl=Information_Base&met=goods_recommend&typ=json', {goods_group: goods_group}, function(data){
                if (data.status == 200) {
//                    console.log(data.data);

                } else {
                    Public.tips.error(data.msg);
                }
            })
        })

        $('#search').on('click',function(){
            var gc_id =$("#gc_id").val();
            if(goods_group){
                $.get(SITE_URL + '?ctl=Information_Base&met=goods_recommend&typ=json&goods_group='+goods_group+'&goods_name='+$('#goods_name').val(),function(a){
                    if(a.status==200)
                    {
                        var str='';
                        str+= "<ul class='dialog-goodslist-s2'>";
                        $.each(a.data['items'],function(key,val){
                            goods_price = val['discount_price']?val['discount_price']:(val['scarebuy_price']?val['scarebuy_price']:(val['newbuyer_price']?val['newbuyer_price']:(val['goods_price']?val['goods_price']:val['bundling_goods_price'])));
                            str+= "<li style='float:left;width:12%; height: 115px;margin:2px 10px; border:2px solid #999;text-align:center;padding:10px; '>";
                            str+="<div class='goods-pic' onclick='select_recommend_goods("+val['goods_id']+','+goods_price+");'>";
                            str+="<span class='ac-ico'></span>";
                            str+="<span class='thumb size-72x72'>";
                            str+="<i></i>";
                            str+="<img width='72' height='72'  src="+val['goods_image']+" goods_name="+val['goods_name']+" goods_id="+val['goods_id']+" title="+val['goods_name']+">";
                            str+="</span>";
                            str+="</div>";
                            str+="<div class='goods-name' style=''>";
                            str+="<a target='_blank' href=''>"+val['goods_name']+"</a>";
                            str+="</div>";
                            str+="</li>";
                        });
                        str+="</ul>";
                        $('#show_recommend_goods_list').html(str);
                    }
                });
            }else{
                alert('请选择商品类别');
                return false;
            }
        });
        function select_recommend_goods(goods_id,goods_price) {
            //避免重复
            var obj = $("#selected_goods_list");
            if(obj.find("img[goods_id='"+goods_id+"']").size()>0) {
                alert('已选此商品');
                return false;
            }
            if(obj.find("ul>li").size()>=4){
                alert('最多可推荐4个商品');
                return false;
            }
            if (typeof goods_id == 'object') {
                var goods_name = goods_id['goods_name'];
                var goods_pic = goods_id['goods_image'];
                var goods_id = goods_id['goods_id'];
            } else {
                var goods = $("#show_recommend_goods_list img[goods_id='"+goods_id+"']");
                var goods_pic = goods.attr("src");
                var goods_name = goods.attr("goods_name");
            }

            var text_append = '';
            text_append += '<div onclick="del_recommend_goods(this,'+goods_id+');" class="goods-pic">';
            text_append += '<span class="ac-ico"></span>';
            text_append += '<span class="thumb size-72x72">';
            text_append += '<i></i>';
            text_append += '<img width="72" class="goods_recommend_id" goods_id="'+goods_id+'" title="'+goods_name+'" goods_name="'+goods_name+'" src="'+goods_pic+'" />';
            text_append += '</span></div>';
            text_append += '<div class="goods-name">';
            text_append += goods_name+'</a>';
            text_append += '</div>';
            text_append += '<input name="goods_id_list[]" value="'+goods_id+'" type="hidden">';
            text_append += '<input name="goods_group_list[]" value="'+goods_price+'" type="hidden">';
            obj.find("ul").append('<li style="float:left;width:12%;height: 115px; margin:2px 10px; border:2px solid #999;text-align:center;padding:10px; ">'+text_append+'</li>');
        }
        function del_recommend_goods(obj,goods_id) {
            //出栈
//            recommend_goods_id.splice($.inArray(goods_id,recommend_goods_id),1);
            $(obj).parent().remove();
        }

        var goods_list_json = $.parseJSON('[]');
        $.each(goods_list_json,function(k,v){
            select_recommend_goods(v);
        });
        $('#recommend_form').dblclick(function () {
            $('#recommend_form').css('display','none');
            $('#information_form').css('display','block');
            goods_recommend_id_list = new Array();
            goods_recommend_group_list = new Array();
            $(" input[ name='goods_id_list[]' ] ").each(function(){
                goods_recommend_id_list.push($(this).val());
            });
            $(" input[ name='goods_group_list[]' ] ").each(function(){
                goods_recommend_group_list.push($(this).val());
            });
            $('#information_goods_recommend').val(goods_recommend_id_list);
            $('#information_goods_recommend_type').val(goods_recommend_group_list);
        });
    </script>
<!--推荐商品 End-->
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>