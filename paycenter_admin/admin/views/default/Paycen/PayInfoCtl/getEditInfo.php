<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/'  . 'header.php';
?>
<link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$this->view->css?>/jquery/plugins/validator/jquery.validator.css">
<style>
.user_identity_statu_reason{ padding:2% 4%;}
</style>
<script type="text/javascript" src="<?=$this->view->js?>/libs/jquery/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js?>/libs/jquery/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
<style>
    .ncap-form-default dt.tit {
        display: inline-block;
    }
    .ncap-form-default dd {
        display: inline-block;
        width: auto !important;
    }
</style>
</head>

<body>
    <form method="post" enctype="multipart/form-data" id="shop_edit_class" name="form1">
        <div class="ncap-form-default">
            <dl class="row">
                <dt class="tit">
                    <label>真实姓名</label>
                </dt>
                <dd class="opt">
                    <span><?=$data['user_realname']?></span>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label>用户昵称</label>
                </dt>
                <dd class="opt">
                    <span><?=$data['user_nickname']?></span>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label>备注消息</label>
                </dt>
                <dd class="opt">
                    <span><?=$data['user_remark']?></span>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label>用户手机号</label>
                </dt>
                <dd class="opt">
                    <span><?=$data['user_mobile']?></span>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label>用户邮箱</label>
                </dt>
                <dd class="opt">
                    <span><?=$data['user_email']?></span>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label>激活时间</label>
                </dt>
                <dd class="opt">
                    <span><?=$data['user_active_time']?></span>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label>身份证号码</label>
                </dt>
                <dd class="opt">
                    <span><?=$data['user_identity_card']?></span>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label>地址</label>
                </dt>
                <dd class="opt">
                    <span><?=$data['user_identity_card']?></span>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label>正面照</label>
                </dt>
                <dd>
                    <a title="查看原图" target="_blank" href="<?=explode('!',$data['user_identity_face_logo'])[0] ?>">
                        <img width="500" src="<?=$data['user_identity_face_logo']?>">
                    </a>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label>反面照</label>
                </dt>
                <dd>
                    <a title="查看原图" target="_blank" href="<?=explode('!',$data['user_identity_font_logo'])[0] ?>">
                    <img width="500" src="<?=$data['user_identity_font_logo']?>">
                    </a>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label>手持身份证</label>
                </dt>
                <dd>
                    <a title="查看原图" target="_blank" href="<?=explode('!',$data['user_identity_hand_logo'])[0] ?>">
                        <img width="500" src="<?=$data['user_identity_font_logo']?>">
                    </a>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="user_nickname">* 用户账号</label>
                </dt>
                <dd class="opt">
                    <input type="radio" id="status1" name="user_identity_statu" value="1" <?php if($data['user_identity_statu'] == 1){?>checked="checked"<?php }?>>
                    <label title="待审核" class="cb-enable <?=($data['user_identity_statu'] == 1 ? 'selected' : '')?> " for="status1">待审核</label>
                    <input type="radio" id="status2" name="user_identity_statu" value="2" <?php if($data['user_identity_statu'] == 2){?>checked="checked"<?php }?>>
                    <label title="通过" class="cb-enable <?=($data['user_identity_statu'] == 2 ? 'selected' : '')?> " for="status2">通过</label>
                    <input type="radio" id="status3" name="user_identity_statu" value="3" <?php if($data['user_identity_statu'] == 3){?>checked="checked"<?php }?>>
                    <label title="不通过" class="cb-enable <?=($data['user_identity_statu'] == 3 ? 'selected' : '')?> " for="status3">不通过</label>
                </dd>
            </dl>
            <input id="user_id"  name="user_id" value="<?=$data['user_id']?>"  type="hidden"/>
        </div>
        <div class="user_identity_statu_reason">提供的证件照中证件头像或字体不清晰,请保证字体清晰可见。</div>
    </form>

    <script>
        function initPopBtns() {
            var t = "add" == oper ? ["保存", "关闭"] : ["确定", "取消"];
            api.button({
                id: "confirm",
                name: t[0],
                focus: !0,
                callback: function() {

                    postData(oper, rowData.shop_class_id);
                    return cancleGridEdit(), $("#shop_edit_class").trigger("validate"), !1
                }
            }, {
                id: "cancel",
                name: t[1]
            })
        }

        function postData(t, e) {
            $_form.validator({
                valid: function(form) {
                    var user_id = $.trim($("#user_id").val()),
                        user_identity_statu = $.trim($("input[name='user_identity_statu']:checked").val()),
                        params = {
                            user_id: user_id,
                            user_identity_statu: user_identity_statu,
                        };
                    Public.ajaxPost(SITE_URL + "?ctl=Paycen_PayInfo&met=editInfoRow&typ=json", params, function(e) {
                        if (200 == e.status) {
                            parent.parent.Public.tips({
                                content: "修改成功！"
                            });
                            var callback = frameElement.api.data.callback;
                            callback();
                        } else {
                            parent.parent.Public.tips({
                                type: 1,
                                content: "修改失败！" + e.msg
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
            $("#shop_class_name").val("");
            $("#shop_class_deposit").val("");
            $("#shop_class_displayorder").val("");
        }
        var curRow, curCol, curArrears, $grid = $("#grid"),
            $_form = $("#shop_edit_class"),
            api = frameElement.api,
            oper = api.data.oper,
            rowData = api.data.rowData || {},
            callback = api.data.callback;
        initPopBtns();
    </script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
