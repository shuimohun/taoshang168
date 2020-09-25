<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/'  . 'header.php';
?>
<link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
<link rel="stylesheet" href="<?=$this->view->css?>/page.css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
</head>
<body>
<style>
    #hover1{
        width: 150px;
        height: 300px;
        background-color: pink;
        position: fixed;
        right: 200px;
        bottom: 100px;
        background: url(<?=$this->view->img?>/oneFloor.png);
        -webkit-background-size: 100% 100%;
        -moz-background-size: 100% 100%;
        -ms-background-size: 100% 100%;
        -o-background-size: 100% 100%;
        -khtml-background-size: 100% 100%;
        background-size: 100% 100%;
        display: none;
    }
    #hover2{
        width: 150px;
        height: 300px;
        background-color: pink;
        position: fixed;
        right: 200px;
        bottom: 100px;
        background: url(<?=$this->view->img?>/twoFloor.png);
        -webkit-background-size: 100% 100%;
        -moz-background-size: 100% 100%;
        -ms-background-size: 100% 100%;
        -o-background-size: 100% 100%;
        -khtml-background-size: 100% 100%;
        background-size: 100% 100%;
        display: none;
    }
    #hover3{
        width: 150px;
        height: 300px;
        background-color: pink;
        position: fixed;
        right: 200px;
        bottom: 100px;
        background: url(<?=$this->view->img?>/threeFloor.png);
        -webkit-background-size: 100% 100%;
        -moz-background-size: 100% 100%;
        -ms-background-size: 100% 100%;
        -o-background-size: 100% 100%;
        -khtml-background-size: 100% 100%;
        background-size: 100% 100%;
        display: none;
    }
</style>
<div style="overflow: hidden;padding: 10px 3% 0;text-align: left;">
    <form name="form"  id="manage-form" action="#" method="post">
        <input type="hidden" name="act" value="add" />
        <input type="hidden" name="page_id"  id="page_id" value="" />
        <table class="form-table-style" style="margin-top:-8px;">
            <tr>
                <th colspan="2"><em>*</em>板块名称：</th>
            </tr>
                <tr>
                    <td><span id="opening_name"></span></td>
                    <td><input type="hidden" class="text w250" name="opening_id" id="opening_id" value="" /></td>
                </tr>
            <tr>
                <th colspan="2">色彩风格：</th>
            </tr>
            <tr>
                <td>
                    <input type="hidden" name="page_color" id="page_color" value="" />
                    <ul class="color_list fn-clear">
                        <?php
                        if(!empty($data['color'])){if($data['base']){foreach($data['color'] as $key => $value){
                        ?>
                        <li date-id="<?=$key?>" class="<?=$key?> <?php if($key == $data['base']['base_background']){?>selected<?php }?>">
                            <span></span>
                            <i class="iconfont">&#xe61d;</i>
                            <?php }}else{foreach($data['color'] as $key => $value){?>
                        <li date-id="<?=$key?>" class="<?=$key?>">
                            <span></span>
                            <i class="iconfont">&#xe61d;</i>
                        <?php }}}?>
                    </ul>
                </td>
                <td><p class="hits">选择板块色彩风格将影响商城首页模板该区域的边框、背景色、字体色彩，但不会影响板块的内容布局。</p></td>
            </tr>

            <tr>
                <th colspan="2">模版：</th>
            </tr>
            <tr>
                <td>
                    <?php if($data['base']){foreach($data['layout'] as $key => $value){?>
                        <input type="hidden" class="text w250" name="layout_id" id="layout_id" value="<?=$value['temp_id']?>" />
                    <?php }}else{?>
                        <input type="hidden" class="text w250" name="layout_id" id="layout_id" value="1" />
                    <?php } ?>

                    <ul class="frame_list fn-clear">
                        <?php
                        if(!empty($data)){
                            if($data['base']){
                            foreach($data['layout'] as $key => $value){?>
                                <li date-id="<?=$key?>" class="<?=$key?> <?php if($key == $data['base']['temp_id']){?>selected<?php }?>">
                                    <span style="background-image:url(<?=$this->view->img?>/<?=$value['temp_reduce_img']?>.png)"></span>
                                    <i class="iconfont">&#xe61d;</i>
                                </li>
                            <?php }}else{ ?>
                                <?php foreach($data['layout'] as $key => $value){?>
                                <li date-id="<?=$key?>" class="<?=$key?> <?php if($key == 1){?>selected<?php }?>">
                                    <span style="background-image:url(<?=$this->view->img?>/<?=$value['temp_reduce_img']?>.png)"></span>
                                    <i class="iconfont">&#xe61d;</i>
                                </li>
                            <?php }}}?>
                    </ul>
                     <div id="hover1"></div>
                     <div id="hover2"></div>
                     <div id="hover3"></div>
                </td>
                <td></td>
            </tr>
        </table>
    </form>
</div>
<script>
    $(function(){
        $.get("./index.php?ctl=Operation_Opening&met=getTitleSe&typ=json&base_id=<?=$data['base']['base_id']?>",function(result){
            if(result.status==200)
            {
                var r = result.data;
                $opening = $("#opening_name").combo({
                    data:r,
                    value: "opening_id",
                    text: "opening_name",
                    width: 300,
                    defaultSelected:result.data.default
                }).getCombo();
            }
        });
    });
    $(".color_list li").click(function(){
        $(this).addClass('selected').siblings().removeClass('selected');
        $("input[name='page_color']").val($(this).attr("date-id"));
    });
    $(".frame_list li").click(function(){
        $(this).addClass('selected').siblings().removeClass('selected');
        $("input[name='layout_id']").val($(this).attr("date-id"));
    });

    function initPopBtns()
    {
        var t = "add" == oper ? ["保存", "关闭"] : ["确定", "取消"];
        api.button({
            id: "confirm", name: t[0], focus: !0, callback: function ()
            {

                postData(oper, rowData.base_id);
                return cancleGridEdit(),$("#manage-form").trigger("validate"), !1
            }
        }, {id: "cancel", name: t[1]})
    }
    function postData(t, e)
    {

        $_form.validator({

            messages: {
                required: "请填写该字段",
            },
            fields: {
                'page_name':'required;' ,
            },

            valid: function (form)
            {
                var opening_id = $.trim($opening.getValue()),
                    page_color = $.trim($("#page_color").val()),
                    layout_id = $.trim($("#layout_id").val()),
                    n = "add" == t ? "新增模版" : "修改模版";
                params = rowData.base_id ? {
                    base_id: e,
                    opening_id: opening_id,
                    page_color:page_color,
                    layout_id:layout_id,
                } : {
                    opening_id: opening_id,
                    page_color:page_color,
                    layout_id:layout_id,
                };

                Public.ajaxPost(SITE_URL +"?ctl=Operation_Opening&met=editFloor&typ=json", params, function (e)
                {
                    if (200 == e.status)
                    {
                        parent.parent.Public.tips({content: n + "成功！"});
                        var callback = frameElement.api.data.callback;
                        callback();
                    }
                    else
                    {
                        parent.parent.Public.tips({type: 1, content: n + "失败！" + e.msg});
                        var callback = frameElement.api.data.callback;
                        callback();
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
        $("#page_order").val("");
        $("#page_name").val("");
        $("#page_color").val("");
        $("#layout_id").val("");
        $("#page_status").val("");

    }
    var curRow, curCol, curArrears, $grid = $("#grid"),  $_form = $("#manage-form"), api = frameElement.api, oper = api.data.oper, rowData = api.data.rowData || {}, callback = api.data.callback;
    initPopBtns();
    function hover_img(){
        $('.1').on('mouseover',function(){
            $('#hover1').show();
        });
        $('.1').on('mouseout',function(){
            $('#hover1').hide();
        });
        $('.2').on('mouseover',function(){
            $('#hover2').show();
        });
        $('.2').on('mouseout',function(){
            $('#hover2').hide();
        });
        $('.3').on('mouseover',function(){
            $('#hover3').show();
        });
        $('.3').on('mouseout',function(){
            $('#hover3').hide();
        });
    }
    hover_img();

</script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
