$(".cat_type").click(function(){
    var value = $('#manage-form input[name="cat_type"]:checked ').val();
    $("#scarebuy_cat_type").val(value);
});


function initField()
{
    if(api.data.parent_id) //添加子分类
    {
        $.get(SITE_URL + '?ctl=Promotion_ScareBuy&met=getScareBuyCatName&typ=json&id=' + api.data.parent_id, function(a){
            if(a.status==200)
            {
                $("#parent_cat").val(a.data.scarebuy_cat_name);
                $("#parent_id").val(a.data.id);
                $("#scarebuy_cat_type").val(a.data.scarebuy_cat_type);
                $("input[name='cat_type'][value='"+a.data.scarebuy_cat_type+"']").attr("checked",true);
                $("input:radio").attr("disabled","disabled");

            }
        });
    }
    if (rowData.scarebuy_cat_id)//编辑分类
    {
        $("#scarebuy_cat_name").val(rowData.scarebuy_cat_name);
        $("#scarebuy_cat_type").val(rowData.scarebuy_cat_type);
        $("#scarebuy_cat_sort").val(rowData.scarebuy_cat_sort);
        $("input[name='cat_type'][value='"+rowData.scarebuy_cat_type+"']").attr("checked",true);
        $("input:radio").attr("disabled","disabled");

        if(rowData.scarebuy_cat_parent_id) //如果有上级
        {
            $.get(SITE_URL + '?ctl=Promotion_ScareBuy&met=getScareBuyCatName&typ=json&id=' + rowData.scarebuy_cat_parent_id, function(a){
                if(a.status==200)
                {
                    $("#parent_cat").val(a.data.scarebuy_cat_name);
                    $("#parent_id").val(a.data.id);
                    $("#scarebuy_cat_type").val(a.data.scarebuy_cat_type);
                    $("input[name='cat_type'][value='"+a.data.scarebuy_cat_type+"']").attr("checked",true);
                    $("input:radio").attr("disabled","disabled");
                }
            });
        }
    }
}
function initPopBtns()
{
    var t = "add" == oper ? ["保存", "关闭"] : ["确定", "取消"];
    api.button({
        id: "confirm", name: t[0], focus: !0, callback: function ()
        {
            postData(oper, rowData.scarebuy_cat_id);
            return cancleGridEdit(), $("#manage-form").trigger("validate"), !1;
        }
    }, {id: "cancel", name: t[1]})
}
function postData(t, e)
{
    var scarebuy_cat_name = $.trim($("#scarebuy_cat_name").val()),

        parent_cat = $.trim($("#parent_id").val()),

        scarebuy_cat_type = $.trim($("#scarebuy_cat_type").val());

        scarebuy_cat_sort = $.trim($("#scarebuy_cat_sort").val());

        n = "add" == t ? "新增分类" : "修改分类";

    var params = {scarebuy_cat_name: scarebuy_cat_name,parent_cat:parent_cat,scarebuy_cat_type:scarebuy_cat_type,scarebuy_cat_sort:scarebuy_cat_sort};
    e ? params.scarebuy_cat_id= e : '';
    Public.ajaxPost(SITE_URL +"?ctl=Promotion_ScareBuy&typ=json&met=" + ("add" == t ? "addScareBuyCat" : "editScareBuyCat"), params, function (e)
    {
        if (200 == e.status)
        {
            parent.parent.Public.tips({content: n + "成功！"});
            callback && "function" == typeof callback && callback(e.data, t, window)
        }
        else
        {
            parent.parent.Public.tips({type: 1, content: n + "失败！" + e.msg})
        }
    })
}
function cancleGridEdit()
{
    null !== curRow && null !== curCol && ($grid.jqGrid("saveCell", curRow, curCol), curRow = null, curCol = null)
}

var curRow, curCol, curArrears, $grid = $("#grid"), $_form = $("#manage-form"), api = frameElement.api, oper = api.data.oper, rowData = api.data.rowData || {}, callback = api.data.callback;
console.info(rowData);
initPopBtns();
initField();