function init()
{
    //修改操作
    typeof cRowId != "undefined" ? Public.ajaxPost(SITE_URL +"?ctl=Operation_Opening&met=getTier&typ=json", {
        opening_id: cRowId.opening_id
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
            var a = "add" == oper ? "新增" : "修改", b = getData();

            Public.ajaxPost(SITE_URL +"?ctl=Operation_Opening&typ=json&met=" + ("add" == oper ? "addTier" : "editTier"), b, function (e)
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
        opening_name    : $.trim($("#opening_name").val()),
        wap_tit_image   : $.trim($("#opening_tit_logo").val())
    };
    cRowId ?data['opening_id'] = cRowId['opening_id']: '';
    return data;
}
//弹窗页面显示的效果,返回后的数据
function initField()
{
    if (rowData.opening_id)
    {
        $("#opening_name").val(rowData.opening_name);
        if(rowData.wap_tit_image == 'isnull'){
            $(".ncap-form-default dl").eq(1).hide();
        }else{
            if(rowData.wap_tit_image){
                $("#opening_tit_logo").val(rowData.wap_tit_image);
                $("#opening_tit_image").attr('src',rowData.wap_tit_image);
            }
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


var curRow, curCol, curArrears, api = frameElement.api, oper = api.data.oper, cRowId = api.data.rowData, rowData = {}, linksIds = [], callback = api.data.callback, defaultPage = Public.getDefaultPage(), $grid = $("#grid"), $_form = $("#manage-form");
initPopBtns(), init();