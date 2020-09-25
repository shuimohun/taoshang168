<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/'  . 'header.php';
?>
<style>
    /*#add,#edit{display: none;}*/
</style>
    </head>
    <body>
    <div id="manage-wrap" class="manage-wrap">
        <form id="manage-form" action="#">
            <div class="ncap-form-default">
                <dl id="add" class="row">
                    <dt class="tit">
                        <label for="article_title"><em>*</em>商品分类</label>
                    </dt>
                    <dd class="opt">
                        <span nctype="gc1">
                            <select nctype="gc" data-deep="1">
                            </select>
                        </span>
                        <span nctype="gc2"></span>
                        <span nctype="gc3"></span>
                        <span nctype="gc4"></span>
                        <input type="hidden" id="cat_id" name="cat_id" value="" class="mls_id">
                        <input type="hidden" id="cat_name" name="cat_name" value="" class="mls_names">
                    </dd>
                </dl>
                <dl id="edit" class="row">
                    <dt class="tit">
                        <label for="article_title"><em>*</em>商品分类</label>
                    </dt>
                    <dd class="opt">
                        <span id="cat_name_edit"></span>
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="tit">
                        <label for="article_title"><em>*</em>排序</label>
                    </dt>
                    <dd class="opt">
                        <input type="text" value="0" class="ui-input" name="display_order" id="display_order">
                    </dd>
                </dl>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="<?=$this->view->js?>/controllers/goods/top_cat_manage.js" charset="utf-8"></script>
    <script>
        //分步获取商品分类
        if(oper == 'add'){
            $('#edit').hide();
            $('#add').show();
        }else{
            $('#add').hide();
            $('#edit').show();
        }
        getCatList(0, $("span[nctype=gc1]>select"), false);
        $("span[nctype=gc1], span[nctype=gc2], span[nctype=gc3], span[nctype=gc4]").on('change', 'select', function (){
            var $select = $(this),
                cat_id = $(this).val(),
                cat_name = $(this).children("option:checked").text();
            $("#cat_id").val(cat_id), $("#cat_name").val(cat_name);
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
                            $("span[nctype=gc" + next_deep + "]").append("<select data-deep=" + next_deep + ">" + option_rows.join("") + "</select>");
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
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>