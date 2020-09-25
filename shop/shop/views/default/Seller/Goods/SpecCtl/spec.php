<?php if (!defined('ROOT_PATH')) {
    exit('No Permission');
} ?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
<style>
    .fn-clear > li {
        float: left;
        margin-right: 3px;
        font: 14px/33px "microsoft yahei";
        color: #FFF;
        background: #AAA;
        display: inline-block;
        height: 33px;
        padding: 0 10px;
    }

    .fn-clear > li a {
        color: #fff;
    }

    .fn-clear > li.selected {
        background: #e02222;
    }

    .spec_list {
        margin-top: 10px;
    }
</style>

<div class="alert">
    <h4>操作提示：</h4>
    <ul>
        <li>1、选择店铺经营的商品分类，以读取平台绑定的商品分类-规格类型，如分类："服装"；规格："颜色"、"尺码"。</li>
        <li>2、添加所属规格下的规格值，已有规格值可以删除，新增未保存的规格值可以移除；<font class="bbc_color">新增的规格值必须填写</font>，否则该行数据不会被更新或者保存。</li>
        <li>3、可通过排序0-255改变规格值显示顺序；在发布商品时勾选已绑定的商品规格，还可对规格值进行"别名"修改操作，但不会影响规格值默认名称的设定。</li>
    </ul>
</div>
<table class="spec_table">
    <tr>
        <td id="category">
						<span id="goods_cat">
        </td>


    </tr>
</table>

<dl>
    <dt>商品分类：</dt>
    <dd id="gcategory">
                        <span nctype="gc1">
                            <select nctype="gc" data-deep="1">
                            </select>
                        </span>
        <span nctype="gc2"></span>
        <span nctype="gc3"></span>
        <span nctype="gc4"></span>
        <p>请选择商品分类（必须选到最后一级）</p>
        <input type="hidden" id="gc_id" name="gc_id" value="" class="mls_id">
    </dd>
</dl>

<div data-type="spec_list" class="spec_list">
    <div data-type="spec_mt" class="spec_mt"></div>
    <div data-type="spec_mc" class="spec_mc">
        <div class="no_account"><img src="<?= $this->view->img ?>/ico_none.png">
            <p>暂无符合条件的数据记录</p></div>
    </div>
</div>


<script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/jquery.combo.js"></script>
<script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/jquery.ztree.all.js"></script>
<script type="text/javascript" src="<?= $this->view->js ?>/common.js"></script>

<script>
    $(function () {

        getCatList(0, $("span[nctype=gc1]>select"), false);
        $("span[nctype=gc1], span[nctype=gc2], span[nctype=gc3], span[nctype=gc4]").on('change', 'select', function () {
            var $select = $(this),
                cat_id = $(this).val(),
                cat_name = $(this).children("option:checked").text();
            getCatList(cat_id, $select, true);
        });

        //商品分类
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
            $.ajax({
                type: "POST",
                url: SITE_URL + '?ctl=Seller_Goods_Cat&met=cat&typ=json',
                data: {cat_id: cat_id},
                success: function (data) {
                    console.log(data)
                    if (data.status == 200) {
                        var option_rows = [], cat_data = data.data;
                        if (cat_data.length > 0) {
                            option_rows.push("<option value=>" + '请选择...' + "</option>");
                            $("#gc_id").val('');
                        } else {
                            $("#gc_id").val(cat_id);
                            getSpec(cat_id);
                        }
                        for (var i = 0; i < cat_data.length; i++) {
                            option_rows.push("<option value=" + cat_data[i].cat_id + ">" + cat_data[i].cat_name + "</option>");
                        }
                        if (change) {
                            if (option_rows.length > 0) {
                                var next_deep = deep + 1;
                                $("span[nctype=gc" + next_deep + "]").append("<select data-deep=" + next_deep + ">" + option_rows.join("") + "</select>");
                                $("span[nctype=gc" + next_deep + "]").children("option").eq(0).trigger("click");
                            }
                        } else {
                            $select.append(option_rows.join(""));
                        }

                    } else {
                        Public.tips.error(data.msg);
                    }
                }
            });
        }

        function getSpec(i) {
            $('.spec_mc').html('');
            $('.spec_mt').html('');



            if (i > 0) {
                var url = SITE_URL + "?ctl=Seller_Goods_Spec&met=getSpec&typ=json&cat_id=" + i;

                $.ajax({
                    type: "POST",
                    url: url,
                    success: function (data) {
                        var spec = data.data;
                        if (typeof (spec) != 'undefined' && spec != '') {
                            var str = $('<ul class="fn-clear"></ul>');
                            $.each(spec, function (i, n) {
                                str.append('<li><a href="javascript:void(0);" data-type="edit" data-param="{spec_id:' + n.spec_id + ',cat_id:' + n.cat_id + '}">编辑' + n.spec_name + '规格</a></li>');
                            });
                            str.find('a').click(function () {
                                str.find('li').removeClass('selected');
                                $(this).parents('li:first').addClass('selected');
                                $('.spec_mc').html('');
                                var data_str = '';
                                eval('data_str =' + $(this).attr('data-param'));


                                var f_url = SITE_URL + '?ctl=Seller_Goods_Spec&met=specManage&typ=e&spec_id=' + data_str.spec_id + '&cat_id=' + data_str.cat_id;
                                $_iframe = $('<iframe id="iframepage" name="iframepage" frameBorder=0 width="100%" height="630px" src="' + f_url + '" ></iframe>');
                                $('.spec_mc').append($_iframe);

                            });
                            str.find('a:first').click();
                            $('.spec_mt').append(str);
                        } else {
                            $('div[data-type="spec_mc"]').html('<div class="no_account"><img src="' + BASE_URL + '/shop/static/default/images/ico_none.png"><p>暂无符合条件的数据记录</p></div>');
                        }
                    },
                });
            }
        };


        /*//商品类别
        var opts = {
            width : 200,
            inputWidth : 145,
            defaultSelectValue : '-1',
            showRoot : true,
            url: SITE_URL + '?ctl=Goods_Cat&met=cat&typ=json&type_number=goods_cat&is_delete=2&filter=true',
        }

        categoryTree = Public.categoryTree($('#goods_cat'), opts);*/

        /*$('#goods_cat').change(function(){
            $('.spec_mc').html('');$('.spec_mt').html('');
            var i = $(this).data('id');

            if(i>0){
                var url =SITE_URL + "?ctl=Seller_Goods_Spec&met=getSpec&typ=json&cat_id="+i;
                $.getJSON(url,function(data){
                    {
                        var spec = data.data;
                        if (typeof(spec) != 'undefined' && spec != '')
                        {
                            var str = $('<ul class="fn-clear"></ul>');
                            $.each(spec, function(i, n){
                                str.append('<li><a href="javascript:void(0);" data-type="edit" data-param="{spec_id:'+ n.spec_id +',cat_id:' + n.cat_id + '}">编辑' + n.spec_name + '规格</a></li>');
                            });
                            str.find('a').click(function(){
                                str.find('li').removeClass('selected');
                                $(this).parents('li:first').addClass('selected');
                                $('.spec_mc').html('');
                                var data_str = '';
                                eval('data_str =' + $(this).attr('data-param'));


                                var f_url = SITE_URL + '?ctl=Seller_Goods_Spec&met=specManage&typ=e&spec_id=' + data_str.spec_id + '&cat_id=' + data_str.cat_id;
                                $_iframe = $('<iframe id="iframepage" name="iframepage" frameBorder=0 width="100%" height="630px" src="' + f_url + '" ></iframe>');
                                $('.spec_mc').append($_iframe);

                            });
                            str.find('a:first').click();
                            $('.spec_mt').append(str);
                        }
                        else
                        {
                            $('div[data-type="spec_mc"]').html('<div class="no_account"><img src="' + BASE_URL + '/shop/static/default/images/ico_none.png"><p>暂无符合条件的数据记录</p></div>');
                        }
                    }
                });
            }
        });*/
    });
</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>



