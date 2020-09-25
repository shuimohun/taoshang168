<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/'  . 'header.php';
?>
<style>
    .selected_list li{float:left;width:12%; height: 115px;margin:2px 10px; border:2px solid #999;text-align:center;padding:10px;position: relative;}
    .show-list li{float:left;width:12%;height: 115px; margin:2px 10px; border:2px solid #999;text-align:center;padding:10px;position: relative;}
    li.selected{border-color:#f53a59;}
    .cer_type{position: absolute;left:5px;bottom:0px;color:#f53a59;}
</style>
<form id="cat_certificate_form" method="post">
    <div class="ncap-form-default">
        <dl class="row">
            <dt class="tit">
                <label for="article_title"><em>*</em>商品分类</label>
            </dt>
            <dd class="opt">
               <span nctype="gc1">
                    <select class="select_cat" nctype="gc" data-deep="1">
                    </select>
                </span>
                <span nctype="gc2"></span>
                <span nctype="gc3"></span>
                <span nctype="gc4"></span>
                <input type="hidden" id="cat_id" name="cat_id" value="" >
                <input type="hidden" id="cat_name" name="cat_name" value="" >
            </dd>
        </dl>
        <dl class="row" id="selected_list">
            <dt class="tit">已关联证件</dt>
            <dd class="opt">
                <!--<input type="hidden" name="valid" id="valid" value="">-->
                <span class="err"></span>
                <ul class="selected_list">
                </ul>
            </dd>
        </dl>

        <dl class="row">
            <dt class="tit">
                <label for="article_title"><em>*</em>关联证件</label>
            </dt>
            <dd class="opt">
                <input type="text" value="" name="search_name" id="search_name" class="ui-input">
                <a class="ui-btn" id="search">查询<i class="iconfont icon-btn02"></i></a>
                <span class="err"></span>
                <p class="notic"></p>
            </dd>
        </dl>
        <dl class="row">
            <dt class="tit">选择要关联的证件</dt>
            <dd class="opt">
                <div id="show-list" class="show-list scrollbar-box"></div>
                <p class="notic"></p>
            </dd>
        </dl>
    </div>
</form>
<script type="text/javascript" src="<?=$this->view->js?>/controllers/shop/certificate/shop_cat_certificate_manage.js" charset="utf-8"></script>

<script>

    /*分步获取商品分类 S*/
    if(oper == 'add'){
        getCatList(0, $("span[nctype=gc1]>select"), false);
    }
    $("span[nctype=gc1], span[nctype=gc2], span[nctype=gc3], span[nctype=gc4]").on('change', 'select', function (){
        var $select = $(this),
            cat_id = $(this).val(),
            cat_name = $(this).children("option:checked").text();
        $("#cat_id").val(cat_id);

        var cat_name = '';
        $('.select_cat').each(function (i,v) {
            if($(v).val() > 0){
                cat_name += $(v).children("option:checked").text() + '->';
            }
        });
        $("#cat_name").val(cat_name);

        getCatList(cat_id, $select, true);
    });
    function getCatList(cat_id, $select, change) {

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
        $.get(SITE_URL + '?ctl=Goods_Cat&met=getCatNew&typ=json', {cat_id: cat_id}, function(data){
            if (data.status == 200) {
                var option_rows = [], cat_data = data.data;
                if(cat_data.length > 0){
                    option_rows.push("<option value=>" + '请选择...' + "</option>");
                }
                for (var i = 0; i < cat_data.length; i++) {
                    option_rows.push("<option value=" + cat_data[i].cat_id + ">" + cat_data[i].cat_name + "</option>");
                }
                if (change){
                    if (option_rows.length > 0) {
                        var next_deep = deep + 1;
                        $("span[nctype=gc" + next_deep + "]").append("<select class=\"select_cat\" data-deep=" + next_deep + ">" + option_rows.join("") + "</select>");
                    }
                } else {
                    $select.append(option_rows.join(""));
                }

            } else {
                Public.tips.error(data.msg);
            }
        })
    }
    /*分步获取商品分类 E*/

    function getShopCertificate() {
        $.get(SITE_URL + '?ctl=Shop_Certificate&met=getAllShopCertificate&typ=json&search_name='+$('#search_name').val(), function(a) {
            if (a.status == 200) {
                var str = '<ul>';
                $.each(a.data, function(key, val) {
                    var selected = '';
                    if($("#selected_list").find("li[data-id='"+val['id']+"']").size()>0) {
                        selected = 'selected';
                    }
                    str += "<li data-id='"+val['id']+"' data-type='"+val['type']+"'  data-name='"+val['name']+"' class='"+selected+"' onclick='select(this);'><div><span>" + val['name'] + "</span></div>";
                    if(val['type'] == '1'){
                        str += "<div class='cer_type'>进口</div>";
                    }
                    str += "</li>";
                });
                str += "</ul>";
                $('#show-list').html(str);
            }else {
                $('#show-list').html();
            }
        });
    }
    getShopCertificate();
    $('#search').on('click', function() {
        getShopCertificate();
    });


    function select(t) {
        var id = $(t).data('id');
        var type = $(t).data('type');
        var name = $(t).data('name');

        var obj = $("#selected_list");
        if(obj.find("li[data-id='"+id+"']").size()>0) {
            alert('已选此证件');
            return false;
        }

        var text_append = '';
        text_append += '<li data-id='+id+' onclick="del(this);"><div><span>' + name + '</span></div>';
        if(type == '1'){
            text_append += "<div class='cer_type'>进口</div>";
        }
        text_append += '<input name="certificate_id[]" value="'+id+'" type="hidden"></li>';
        obj.find("ul").append(text_append);

        $(t).addClass('selected');
    }

    function del(obj) {
        $(obj).remove();
        var id = $(obj).data('id');
        $("#show-list").find("li[data-id='"+id+"']").removeClass('selected');
    }

</script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>