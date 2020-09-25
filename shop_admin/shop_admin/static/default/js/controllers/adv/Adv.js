function initEvent()
{
    $_matchCon = $("#matchCon"),
        $_matchCon.placeholder(),
        $("#search").on("click", function (a)
        {
            a.preventDefault();
            var group_id = $.trim($("#group_id").val());
            var b = "输入广告名称查询" === $_matchCon.val() ? "" : $.trim($_matchCon.val());
            $("#grid").jqGrid("setGridParam", {page: 1, postData: {skey: b, group_id:$group.getValue()}}).trigger("reloadGrid")
        });
    $('.wrapper').on('click', '#import', function (a) {
        a.preventDefault(),
        Business.verifyRight('SO_导入') && parent.$.dialog({
            width: 560,
            height: 300,
            title: '批量导入',
            content: 'url:./erp.php?ctl=Vendor_Base&met=import',
            lock: !0,
            data:function(){
                $("#search").trigger('click');
            }
        })
    });
    $("#export").click(function (t)
    {
        var b = "按广告编号，广告名称" === $_matchCon.val() ? "" : $.trim($_matchCon.val()),
            d=b?'&skey=' + b:'';
        //var f = SITE_URL + '?ctl=Goods_Brand&met=getBrandListExcel&enable=1&debug=1' + d;
        //$(this).attr('href', f)
        window.open(SHOP_URL + "?ctl=Api_Operation_Advertisement&met=getBrandListExcel&debug=1" + d);
    });
    $("#import").click(function (t)
    {
        var b = "按品牌编号，品牌名称" === $_matchCon.val() ? "" : $.trim($_matchCon.val()),
            d=b?'&matchCon=' + b:'';
        var f = './erp.php?ctl=Vendor_Base&typ=e&met=export' + d;
        $(this).attr('href', f)
    });
    $("#btn-add").click(function (t)
    {
        t.preventDefault();
        Business.verifyRight("INVLOCTION_ADD") && handle.operate("add")
    });

    $("#btn-refresh").click(function (t)
    {
        t.preventDefault();
        $("#grid").trigger("reloadGrid")
    });

    $("#grid").on("click", ".operating .ui-icon-pencil", function (t)
    {
        t.preventDefault();
        if (Business.verifyRight("INVLOCTION_UPDATE"))
        {
            var e = $(this).parent().data("id");
            handle.operate("edit", e)
        }
    });

    $("#grid").on("click", ".operating .ui-icon-trash", function (t)
    {
        t.preventDefault();
        if (Business.verifyRight("INVLOCTION_DELETE"))
        {
            var e = $(this).parent().data("id");
            handle.del(e)
        }
    });

    $(window).resize(function ()
    {
        Public.resizeGrid()
    })
}
function initGrid()
{
    var t = ['操作', '广告ID', '广告名称',  '广告图片', '所属广告位', '购买时间', '结束时间'], e = [{
        name: "operate",
        width: 60,
        fixed: !0,
        align: "center",
        formatter: Public.operFmatter
    },
        {name: "id", index: "id", width: 100, align:"center"},
        {name: "name", index: "name", width: 200, align:"center"},
        {name: "pic_url", index: "pic_url", formatter:online_imgFmt,align: "center", width: 150},
        {name: "group_id", index: "group_id", align: "center", width: 100},
        {name: "stime", index: "stime", align: "center", width: 100},
        {name: "etime", index: "etime", align: "center", width: 100},];

    $("#grid").jqGrid({
        url: SITE_URL + "?ctl=Operation_Advertisement&met=listBrand&typ=json",
        datatype: "json",
        height: Public.setGrid().h,
        colNames: t,
        colModel: e,
        autowidth: !0,
        pager: "#page",
        viewrecords: !0,
        cmTemplate: {sortable: !1, title: !1},
        page: 1,
        rowNum: 25,
        rowList: [25, 50, 100],
        shrinkToFit: !1,
        jsonReader: {root: "data.rows", records: "data.records", total: "data.total", repeatitems: !1, id: "id"},
        loadComplete: function (t)
        {
            if (t && 200 == t.status)
            {
                var e = {};
                t = t.data;
                for (var i = 0; i < t.rows.length; i++)
                {
                    var a = t.rows[i];
                    e[a.id] = a;
                }
                $("#grid").data("gridData", e);
                0 == t.rows.length && parent.Public.tips({type: 2, content: "没有广告数据！"})
            }
            else
            {
                parent.Public.tips({type: 2, content: "获取数据失败！" + t.msg})
            }
        },
        loadError: function ()
        {
            parent.Public.tips({type: 1, content: "操作失败了哦，请检查您的网络链接！"})
        }
    })
}

var handle = {
    operate: function (t, e)
    {
        if ("add" == t)
        {
            var i = "新增广告", a = {oper: t, callback: this.callback};
        }
        else
        {
            var i = "修改广告", a = {oper: t, rowData: $("#grid").data("gridData")[e], callback: this.callback};
        }
        $.dialog({
            title: i,
            content: "url:"+SITE_URL+"?ctl=Operation_Advertisement&met=AdvManage&id="+e,
            data: a,
            width: 500,
            height: 650,
            max: !1,
            min: !1,
            cache: !1,
            lock: !0
        })
    }, callback: function (t, e, i)
    {
        var a = $("#grid").data("gridData");
        if (!a)
        {
            a = {};
            $("#grid").data("gridData", a)
        }
        a[t.id] = t;
        if ("edit" == e)
        {
            $("#grid").jqGrid("setRowData", t.id, t);
            i && i.api.close()
        }
        else
        {
            $("#grid").jqGrid("addRowData", t.id, t, "last");
            i && i.api.close()
        }
    }, del: function (t)
    {
        $.dialog.confirm("删除的广告将不能恢复，请确认是否删除？", function ()
        {
            Public.ajaxPost("./index.php?ctl=Operation_Advertisement&met=remove&typ=json", {id: t}, function (e)
            {
                if (e && 200 == e.status)
                {
                    parent.Public.tips({content: "广告删除成功！"});
                    $("#grid").jqGrid("delRowData", t)
                }
                else
                {
                    parent.Public.tips({type: 1, content: "广告删除失败！" + e.msg})
                }
            })
        })
    }
};

function online_imgFmt(val){
    var val = '<img src="'+val+'" style="width:100px;height:40px;">';
    return val;
}
//广告位下拉框
$(function(){
    $.get(SHOP_URL+"?ctl=Api_Operation_Advertisement&met=advIndex&typ=json", function(result){
        if(result.status==200)
        {
            var r = result.data.group;
            $group = $("#group").combo({
                data:r,
                value: "id",
                text: "name",
                width: 110
            }).getCombo();
        }
    });
});

//分类查询下拉框
function initFilter()
{
    //查询条件
    Business.filterBrand();

    //商品类别
    var opts = {
        width : 200,
        //inputWidth : (SYSTEM.enableStorage ? 145 : 208),
        inputWidth : 145,
        defaultSelectValue : '-1',
        //defaultSelectValue : rowData.categoryId || '',
        showRoot : true
    };

    categoryTree = Public.categoryTree($('#goods_cat'), opts);

}
initFilter();
initEvent();
initGrid();