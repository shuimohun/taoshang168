<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/'  . 'header.php';
?>
<link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
</head>

<body>

<form method="post" enctype="multipart/form-data" id="shop_certificate" name="form1">
    <input  name="id" value=""  type="hidden"/>
    <div class="ncap-form-default">
        <dl class="row">
            <dt class="tit">
                <label for="type">* 类型</label>
            </dt>
            <dd class="opt">
                <select id="type" name="type">
                    <option value="0">国内</option>
                    <option value="1">进口</option>
                </select>
            </dd>
        </dl>
        <dl class="row">
            <dt class="tit">
                <label for="name">* 分类名称</label>
            </dt>
            <dd class="opt">
                <input id="name" name="name" value="" class="ui-input w200" type="text"/>
            </dd>
        </dl>
        <dl class="row">
            <dt class="tit">
                <label for="display_order">*排序</label>
            </dt>
            <dd class="opt">
                <input id="display_order" name="display_order"  value="1" class="ui-input w200" type="text"/>
            </dd>
        </dl>
    </div>
</form>

<script>
    function initPopBtns() {
        var t = "add" == oper ? ["保存", "关闭"] : ["确定", "取消"];
        api.button({
            id: "confirm",
            name: t[0],
            focus: !0,
            callback: function() {
                postData(oper, rowData.id);
                return cancleGridEdit(), $("#shop_certificate").trigger("validate"), !1
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
                'type': 'required;',
                'name': 'required;',
                'display_order': 'required;integer[+0];'
            },

            valid: function(form) {
                var type = $.trim($("#type").val()),
                    name = $.trim($("#name").val()),
                    display_order = $.trim($("#display_order").val()),
                    n = "add" == t ? "新增分类" : "修改分类";

                params = rowData.id ? {
                    id: e,
                    type: type,
                    name: name,
                    display_order: display_order,

                } : {
                    type: type,
                    name: name,
                    display_order: display_order,
                };
                Public.ajaxPost(SITE_URL + "?ctl=Shop_Certificate&met=" + ("add" == t ? "add" : "edit") + "CertificateRow&typ=json", params, function(e) {
                    if (200 == e.status) {
                        parent.parent.Public.tips({
                            content: n + "成功！"
                        });
                        callback && "function" == typeof callback && callback(e.data, t, window)
                    } else {
                        parent.parent.Public.tips({
                            type: 1,
                            content: n + "失败！" + e.msg
                        })
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
        $("#name").val("");
        $("#display_order").val("");
    }
    var curRow, curCol, curArrears, $grid = $("#grid"),
        $_form = $("#shop_certificate"),
        api = frameElement.api,
        oper = api.data.oper,
        rowData = api.data.rowData || {},
        callback = api.data.callback;
    initPopBtns();
</script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
