<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<?php
    include $this->view->getTplPath() . '/'  . 'header.php';
?>
<link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>

</head>
<body>

<div class="ncap-form-default" style="padding-top:50px;">
    <form id="form1" action="" method="post">
        <input type="hidden" name="report_id" id="report_id" value="<?=($data['report_id'])?>">
        <dl class="row">
            <dt class="tit">审核状态：</dt>
            <dd class="opt">
                <label><input type="radio" name="status" value="2" <?=($data['status'] == 2 ? 'checked' : '')?>>审核通过</label>
                <label><input type="radio" name="status" value="3" <?=($data['status'] == 3 ? 'checked' : '')?>>违规举报</label>
            </dd>
        </dl>
        <div class="bot"><a href="javascript:void(0);" class="ui-btn ui-btn-sp submit-btn" id="submitBtn">确认提交</a></div>
    </form>
</div>

<script>
    $(function () {
        var t = "edit";
        if ($('#form1').length > 0) {
            $('#form1').validator({
                ignore: ':hidden',
                theme: 'yellow_right',
                timely: 1,
                stopOnError: true,
                fields: {
                    'status':'required;',
                },
                valid: function (form) {
                    Public.ajaxPost(SITE_URL + '?ctl=Information_Report&met=auditReport&typ=json', {report_id:$("#report_id").val(),status:$("input[name='status']:checked").val()}, function (data) {
                        if (data.status == 200) {
                            parent.Public.tips({content: '修改成功!'});
                            callback && "function" == typeof callback && callback(data.data, t, window)
                        } else {
                            parent.Public.tips({type: 1, content: data.msg || '操作无法成功，请稍后重试！'});
                        }
                    });
                }
            }).on("click", "a#submitBtn", function (e) {
                $(e.delegateTarget).trigger("validate");
            });
        }
    });

    var curRow, curCol, curArrears, $grid = $("#grid"),  $_form = $("#form1"), api = frameElement.api, oper = api.data.oper, rowData = api.data.rowData || {}, callback = api.data.callback;

</script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>