function init()
{
    //修改操作
    typeof cRowId != "undefined" ? Public.ajaxPost(SITE_URL +"?ctl=Operation_Advertisement&met=getBrand&typ=json", {
        id: cRowId.id
    }, function (rs)
    {
        200 == rs.status ? (rowData = rs.data, initField(), initEvent()) : parent.$.dialog({
            title: "系统提示",
            content: "获取广告数据失败，暂不能修改广告，请稍候重试",
            icon: "alert.gif",
            max: !1,
            min: !1,
            cache: !1,
            lock: !0,
            ok: "确定",
            ok: function ()
            {
                return !0
            },
            close: function ()
            {
                api.close()
            }
        })
    }) : (initField(), initEvent())
}
//弹框选项保存或关闭或确定或取消
function initPopBtns()
{
    var a = "add" == oper ? ["保存", "关闭"] : ["确定", "取消"];
    api.button({
        id: "confirm", name: a[0], focus: !0, callback: function ()
        {
            return cancleGridEdit(), $_form.trigger("validate"), !1
        }
    }, {id: "cancel", name: a[1]})
}

$(function ()
{
    var type_id = cRowId == undefined ? 0 : cRowId.id;

    if ($('#shop_form').length > 0)
    {

        $.get("./index.php?ctl=Operation_Advertisement&met=advIndex&typ=json",{advs_id:type_id},function(result){
            if(result.status==200)
            {
                var r = result.data.group;
                $group = $("#group").combo({
                    data:r,
                    value: "id",
                    text: "name",
                    width: 210,
                    defaultSelected:result.data.default
                }).getCombo();
            }
        });

        $.get("./index.php?ctl=Operation_Advertisement&met=getAdvsTypeList&typ=json",{advs_id:type_id},function(result){
            if(result.status==200)
            {
                var r = result.data.advs_type_name;
                $advs_type = $("#advs_type").combo({
                    data:r,
                    value: "advs_type_id",
                    text: "type_name",
                    width: 80,
                    defaultSelected:result.data.default
                }).getCombo();
            }
        });
    }
});

//增加和修改的方法
function initValidator()
{
    $_form.validator({
        messages: {
            required: "请填写{0}"
        },
        fields: {
            brand_name: "required;"
        },
        display: function (a)
        {
            return $(a).closest(".row-item").find("label").text()
        },
        valid: function (form)
        {
            var a = "add" == oper ? "新增广告" : "修改广告", b = getData();

            Public.ajaxPost(SITE_URL +"?ctl=Operation_Advertisement&typ=json&met=" + ("add" == oper ? "add" : "edit"), b, function (e)
            {
                if (200 == e.status)
                {
                    parent.parent.Public.tips({content: a + "成功！"});
                    callback && "function" == typeof callback && callback(e.data, oper, window)
                }
                else
                {
                    parent.parent.Public.tips({type: 1, content: a + "失败！" + e.msg})
                }
            })
        },
        ignore: ":hidden",
        theme: "yellow_bottom",
        timely: 1,
        stopOnError: !0
    })
}
//获取页面数据
function getData()
{
    var data = {
        con         : $.trim($("#con").val()),
        name        : $.trim($("#adv_name").val()),
        stime       : $.trim($("#stime").val()),
        etime       : $.trim($("#etime").val()),
        pic_url     : $.trim($("#brand_image").attr('src')),
        pic_url     : $.trim($("#brand_logo").val()),
        group_id    : $.trim($group.getValue()),
        open_state  : $.trim($('[name = open_state]:checked').val()),
        advs_type   : $.trim($advs_type.getValue()),
        keyword     : $.trim($('#keyword').val())
    };
    cRowId ?data['id'] = cRowId['id']: '';
    return data
}

function initField()
{

    //弹窗页面显示的效果
    if (rowData.id)
    {
        $("#adv_name").val(rowData.name);
        $("#brand_image").attr('src',rowData.pic_url);
        $("#con_type").val(rowData.con_typ);
        $("#stime").val(rowData.stime);
        $("#etime").val(rowData.etime);
        $("#con").val(rowData.con);
        if(rowData.advs_type == 5){
            $("#keyword").val(rowData.url);
        }else{
            $("#keyword").val(rowData.keyword);
        }

        if(rowData.open_state)
        {
            $("#open_state1").attr('checked', true);
            $("#open_state0").attr('checked', false);
            $('[for="open_state1"]').addClass('selected');
            $('[for="open_state0"]').removeClass('selected');
        }
        else
        {
            $("#open_state1").attr('checked', false);
            $("#open_state0").attr('checked', true);
            $('[for="open_state1"]').removeClass('selected');
            $('[for="open_State0"]').addClass('selected');
        }

    }
}

function initEvent()
{
    $("#type").data("defItem",["vendor_type_id",rowData.vendor_type_id]);
    type = $("#type").combo({
        data: "./erp.php?ctl=Vendor_Type&met=queryAllType&typ=json",
        value: "brand_type_id",
        text: "brand_type_name",
        width: 210,
        ajaxOptions: {
            formatData: function (e)
            {
                return e.data.rows;
            }
        },
        defaultSelected: rowData.brand_type_id ? $("#type").data("defItem") : void 0
    }).getCombo();

    $(document).on("click.cancle", function (a)
    {
        var b = a.target || a.srcElement;
        !$(b).closest("#grid").length > 0 && cancleGridEdit()
    }), bindEventForEnterKey(), initValidator()
}

function bindEventForEnterKey()
{
    Public.bindEnterSkip($("#base-form"), function ()
    {
        $("#grid tr.jqgrow:eq(0) td:eq(0)").trigger("click")
    })
}

function addressElem()
{
    var a = $(".address")[0];
    return a
}
function addressValue(a, b, c)
{
    if ("get" === b)
    {
        var d = $.trim($(".address").val());
        return "" !== d ? d : ""
    }
    "set" === b && $("input", a).val(c)
}
function addressHandle()
{
    $(".hideFile").append($(".address").val("").unbind("focus.once"))
}
function cancleGridEdit()
{
    null !== curRow && null !== curCol && ($grid.jqGrid("saveCell", curRow, curCol), curRow = null, curCol = null)
}

function initFilter()
{
    //查询条件
    Business.filterBrand();

    //商品类别
    var opts = {
        width : 200,
        //inputWidth : (SYSTEM.enableStorage ? 145 : 208),
        inputWidth : 210,
        defaultSelectValue : '-1',
        //defaultSelectValue : rowData.categoryId || '',
        showRoot : true
    };

    categoryTree = Public.categoryTree($('#cat_name'), opts);

}



var curRow, curCol, curArrears, api = frameElement.api, oper = api.data.oper, cRowId = api.data.rowData, rowData = {}, linksIds = [], callback = api.data.callback, defaultPage = Public.getDefaultPage(), $grid = $("#grid"), $_form = $("#shop_form");
initPopBtns();
initFilter();
init();