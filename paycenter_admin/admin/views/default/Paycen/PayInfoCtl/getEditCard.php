<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/'  . 'header.php';
?>
<link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$this->view->css?>/jquery/plugins/validator/jquery.validator.css">
<script type="text/javascript" src="<?=$this->view->js?>/libs/jquery/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js?>/libs/jquery/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
<style>
    .ncap-form-default dt.tit{
        display: inline-block;
    }
    .ncap-form-default dd{
        display: inline-block;
        width:auto !important;
    }
    .ncap-form-default dd input{
        display: inline-block;
        border: 0 none;
        background-color: #fff;
    }
    .ncap-form-default dd input.bank_value{
        width:200px;
    }
</style>
</head>

<body>
<form method="post" enctype="multipart/form-data" id="shop_edit_class" name="form1">
    <div class="ncap-form-default">
        <dl class="row">
            <dt class="tit">
                <label for="user_nickname">绑卡姓名</label>
            </dt>
            <dd>
                <input type="text" name="bank_account_name" value="<?=$data['bank_account_name'] ?>" readonly="readonly" />
            </dd>
        </dl>
        <dl class="row">
            <dt class="tit">
                <label for="user_nickname">用户昵称</label>
            </dt>
            <dd>
                <input type="text" name="user_nickname" value="<?=$data['user_info']['user_nickname'] ?>" readonly="readonly" />
            </dd>
        </dl>
        <dl class="row">
            <dt class="tit">
                <label for="user_nickname">所属银行</label>
            </dt>
            <dd>
                <input type="text" name="bank_name" value="<?=$data['deposit']['bank_name'] ?>" readonly="readonly"/>
            </dd>
        </dl>
        <dl class="row">
            <dt class="tit">
                <label for="user_nickname">银行卡账号</label>
            </dt>
            <dd>
                <input type="text" name="bank_account_number" value="<?=$data['bank_account_number'] ?>"  class="bank_value"/>
            </dd>
        </dl>
        <dl class="row">
            <dt class="tit">
                <label for="user_nickname">银行卡正面照</label>
            </dt>
            <dd>
                <img width="500" height="300" src="<?=$data['card_img'] ?>">
            </dd>
        </dl>
        <dl class="row">
            <dt class="tit">
                <label for="user_nickname">审核状态</label>
            </dt>
            <dd class="opt">
                <input type="radio" name="card_statu" value="0" <?php if($data['card_statu'] == '0'){?>checked="checked"<?php }?>>已上传
            </dd>
        </dl>
        <input id="card_id"  name="card_id" value="<?=$data['card_id']?>"  type="hidden"/>
        <dl class="row">
            <dt class="tit">
                <label for="user_nickname">用户手机号</label>
            </dt>
            <dd>
                <input type="text" name="user_mobile" value="<?=$data['user_info']['user_mobile'] ?>" readonly="readonly" />
            </dd>
        </dl>
        <dl class="row">
            <dt class="tit">
                <label for="user_nickname">用户邮箱</label>
            </dt>0
            <dd>
                <input type="text" name="user_email" value="<?=$data['user_info']['user_email'] ?>" readonly="readonly"  />
            </dd>
        </dl>



    </div>
</form>

<script>

    function initPopBtns()
    {
        var t = "add" == oper ? ["保存", "关闭"] : ["确定", "取消"];
        api.button({
            id: "confirm", name: t[0], focus: !0, callback: function ()
            {

                postData(oper, rowData.shop_class_id);
                return cancleGridEdit(),$("#shop_edit_class").trigger("validate"), !1
            }
        }, {id: "cancel", name: t[1]})
    }
    function postData(t, e)
    {

        $_form.validator({

            valid: function (form)
            {
                var card_id = $.trim($("#card_id").val()),
                    card_statu= $.trim($("input[name='card_statu']:checked").val()),

                    params ={
                        card_id:card_id,
                        card_statu: card_statu,
                    };
                Public.ajaxPost(SITE_URL +"?ctl=Paycen_PayInfo&met=editCardRow&typ=json", params, function (e)
                {
                    if (200 == e.status)
                    {
                        parent.parent.Public.tips( {content:"修改成功！"});
                        var callback = frameElement.api.data.callback;
                        callback();
                    }
                    else
                    {
                        parent.parent.Public.tips({type: 1, content:  "修改失败！" + e.msg})
                    }
                })
            },
            ignore: ":hidden",
            theme: "yellow_bottom",
            timely: 1,
            stopOnError: !0
        });
    }
    function cancleGridEdit()
    {
        null !== curRow && null !== curCol && ($grid.jqGrid("saveCell", curRow, curCol), curRow = null, curCol = null)
    }
    function resetForm(t)
    {
        $_form.validate().resetForm();
        $("#shop_class_name").val("");
        $("#shop_class_deposit").val("");
        $("#shop_class_displayorder").val("");
    }
    var curRow, curCol, curArrears, $grid = $("#grid"),  $_form = $("#shop_edit_class"), api = frameElement.api, oper = api.data.oper, rowData = api.data.rowData || {}, callback = api.data.callback;
    initPopBtns();

</script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
