<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/'  . 'header.php';
?>
<link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
<style>
    select{width: 100px;}
</style>
</head>
<body>
    <form method="post" enctype="multipart/form-data" id="shop_edit_level" name="form1">
        <input  name="shop_id" id="shop_id" value="<?=$data['shop_id']?>"  type="hidden"/>
        <div class="ncap-form-default">
            <dl class="row">
                <dt class="tit">
                    <label for="product_class"> 经营类目</label>
                </dt>
                <dd class="opt">
                    <span nctype="gc1">
                        <select nctype="gc" data-deep="1">
                        </select>
                    </span>
                    <span nctype="gc2"></span>
                    <span nctype="gc3"></span>
                    <span nctype="gc4"></span>
                    <p>请选择商品分类（必须选到最后一级）</p>
                    <p class="bbc_color hidden">您已经申请过此类目,请选择其他类目！</p>
                    <input type="hidden" id="cat_id" name="cat_id" value="" class="mls_id">
                    <input type="hidden" id="cat_name" name="cat_name" value="" class="mls_names">
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="commission_rate">分佣比例(%)</label>
                </dt>
                <dd class="opt">
                    <input id="commission_rate" name="commission_rate" value="" class="ui-input w200" type="text"/>
                </dd>
            </dl>
        </div>
    </form>

    <script>
        //分步获取商品分类
        $("span[nctype=gc1], span[nctype=gc2], span[nctype=gc3], span[nctype=gc4]").on('change', 'select', function (){
            var $select = $(this),
                cat_id = $(this).val(),
                cat_name = $(this).find("option:checked").text();
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
                    $('.hidden').hide();
                    var option_rows = [], cat_data = data.data;
                    if(cat_data.length > 0){
                        option_rows.push("<option value=>" + '请选择...' + "</option>");
                        $("#cat_id").val('');
                        $('#commission_rate').val('');
                    }else{
                        $("#cat_id").val(cat_id);
                        var cat_commission = $select.find("option:checked").attr('data-cat-commission');
                        $('#commission_rate').val(cat_commission);
                    }
                    for (var i = 0; i < cat_data.length; i++) {
                        option_rows.push("<option data-cat-commission="+cat_data[i].cat_commission+" value=" + cat_data[i].cat_id + ">" + cat_data[i].cat_name + "</option>");
                    }
                    if (change){
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
            })
        }

        //分布获取商品分类
        getCatList(0, $("span[nctype=gc1]>select"), false);

        function initPopBtns() {
            var t = "add" == oper ? ["保存", "关闭"] : ["确定", "取消"];
            api.button({
                id: "confirm",
                name: t[0],
                focus: !0,
                callback: function() {
                    postData(oper, rowData.shop_class_bind_id);
                    return cancleGridEdit(), $("#shop_edit_level").trigger("validate"), !1
                }
            }, {
                id: "cancel",
                name: t[1]
            })
        }

        function postData(t, e) {
            $_form.validator({
                messages: {
                    required: "请填写该字段",
                },
                fields: {
                    'cat_name': 'required',
                    'product_class_id': 'required;',
                    'commission_rate': 'required;',
                },

                valid: function(form) {
                    var product_class_id = $.trim($("#cat_id").val()),
                        commission_rate = $.trim($("#commission_rate").val()),
                        shop_id = $.trim($("#shop_id").val()),
                        n = "add" == t ? "新增经营类目" : "修改经营类目";

                    params = rowData.shop_class_bind_id ? {
                        shop_class_bind_id: e,
                        product_class_id: product_class_id,
                        commission_rate: commission_rate,
                        shop_id: shop_id,

                    } : {
                        shop_id: shop_id,
                        product_class_id: product_class_id,
                        commission_rate: commission_rate,
                    };
                    Public.ajaxPost(SITE_URL + "?ctl=Shop_Manage&met=" + ("add" == t ? "add" : "edit") + "ShopCategoryRow&typ=json", params, function(e) {
                        if (200 == e.status) {
                            parent.parent.Public.tips({
                                content: n + "成功！"
                            });
                            var callback = frameElement.api.data.callback;
                            callback();
                        } else {
                            parent.parent.Public.tips({
                                type: 1,
                                content: n + "失败！" + e.msg
                            });
                            /*var callback = frameElement.api.data.callback;
                            callback();*/
                        }
                    })
                },
                ignore: ":hidden",
                theme: "yellow_bottom",
                timely: 1,
                stopOnError: !0
            });
        }

        function cancleGridEdit() {
            null !== curRow && null !== curCol && ($grid.jqGrid("saveCell", curRow, curCol), curRow = null, curCol = null)
        }

        function resetForm(t) {
            $_form.validate().resetForm();
            $("#product_class_id").val("");
            $("#commission_rate").val("");
        }
        var curRow, curCol, curArrears, $grid = $("#grid"),
            $_form = $("#shop_edit_level"),
            api = frameElement.api,
            oper = api.data.oper,
            rowData = api.data.rowData || {},
            callback = api.data.callback;
        initPopBtns();
    </script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
