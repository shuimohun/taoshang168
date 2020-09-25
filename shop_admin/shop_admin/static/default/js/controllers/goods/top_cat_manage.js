function initField() {
    if (rowData.id) {
        $("#cat_id").val(rowData.cat_id);
        $("#cat_name").val(rowData.cat_name);
        $("#cat_name_edit").html(rowData.cat_name);
        $("#display_order").val(rowData.display_order);
    }
}

function initPopBtns() {
    var t = "add" == oper ? ["保存", "关闭"] : ["确定", "取消"];
    api.button({
        id: "confirm",
        name: t[0],
        focus: !0,
        callback: function() {
            postData(oper, rowData.id);
            return cancleGridEdit(), $("#manage-form").trigger("validate"), !1;
        }
    }, {
        id: "cancel",
        name: t[1]
    })
}

function postData(t, e) {
    var cat_id = $.trim($("#cat_id").val()),
        cat_name = $.trim($("#cat_name").val()),
        display_order = $.trim($("#display_order").val()),
        n = "add" == t ? "新增" : "修改";

    params = rowData.id ? {
        id: e,
        cat_id: cat_id,
        cat_name: cat_name,
        display_order: display_order
    } : {
        cat_id: cat_id,
        cat_name: cat_name,
        display_order: display_order
    };
    Public.ajaxPost(SITE_URL + "?ctl=Goods_TopCat&typ=json&met=" + ("add" == t ? "add" : "edit"), params, function(e) {
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
}

function cancleGridEdit() {
    null !== curRow && null !== curCol && ($grid.jqGrid("saveCell", curRow, curCol), curRow = null, curCol = null)
}

function resetForm(t) {
    $("#manage-form").validate().resetForm();
    $("#cat_name").val("");
    $("#display_order").val("");
}
var curRow, curCol, curArrears, $grid = $("#grid"),
    $_form = $("#manage-form"),
    api = frameElement.api,
    oper = api.data.oper,
    rowData = api.data.rowData || {},
    callback = api.data.callback;
initPopBtns();
initField();