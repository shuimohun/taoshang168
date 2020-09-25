function initEvent()
{
    $_matchCon = $("#matchCon"),
        $_matchCon.placeholder(),
        $("#search").on("click", function (a)
        {
            a.preventDefault();
            var cat_id = categoryTree.getValue();
            var b = "输入店铺名称查询" === $_matchCon.val() ? "" : $.trim($_matchCon.val());
            $("#grid").jqGrid("setGridParam", {page: 1, postData: {skey: b, cat_id:cat_id}}).trigger("reloadGrid")
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
        var b = "按广告位编号，广告位名称" === $_matchCon.val() ? "" : $.trim($_matchCon.val()),
            d=b?'&skey=' + b:'';
        //var f = SITE_URL + '?ctl=Goods_Brand&met=getBrandListExcel&enable=1&debug=1' + d;
        //$(this).attr('href', f)
        window.open(SHOP_URL + "?ctl=Api_Operation_Advertisement&met=getAdvTypeListExcel&debug=1" + d);
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
    //修改图标增加点击事件
    $("#grid").on("click", ".operating .ui-icon-pencil", function (t)
    {
        t.preventDefault();
        if (Business.verifyRight("INVLOCTION_UPDATE"))
        {
            var e = $(this).parent().data("id");
            handle.operate("edit", e)
        }
    });
    //删除图标增加点击事件
    //$("#grid").on("click", ".operating .ui-icon-trash", function (t)
    //{
    //    t.preventDefault();
    //    if (Business.verifyRight("INVLOCTION_DELETE"))
    //    {
    //        var e = $(this).parent().data("id");
    //        handle.del(e)
    //    }
    //});
    //
    //$(window).resize(function ()
    //{
    //    Public.resizeGrid()
    //})
}
function initGrid()
{
    var t = ['操作', '编号', '广告位名称', '创建时间', '价格', '单位', '数量','图片宽度','图片高度' ], e = [{
        name: "operate",
        width: 60,
        fixed: !0,
        align: "center",
        formatter: Public.operFmatter_edit
    },
        {name: "id", index: "id", width: 100, align:"center"},
        {name: "name", index: "name", width: 200, align:"center"},
        {name: "date", index: "date", align: "center", width: 150},
        {name: "price", index: "price", align: "center", width: 100},
        {name: "unit", index: "unit", align: "center", width: 100},
        {name: "total", index: "total", align: "center", width: 100},
        {name: "width", index: "width", align: "center", width: 100},
        {name: "height", index: "height", align: "center", width: 100},
    ];

    $("#grid").jqGrid({
        url: SITE_URL + "?ctl=Operation_Advertisement&met=typeList&typ=json",
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
        jsonReader: {root: "data.items", records: "data.records", total: "data.total", repeatitems: !1, id: "id"},
        loadComplete: function (t)
        {
            if (t && 200 == t.status)
            {
                var e = {};
                t = t.data;
                for (var i = 0; i < t.items.length; i++)
                {
                    var a = t.items[i];
                    e[a.id] = a;
                }
                $("#grid").data("gridData", e);
                0 == t.items.length && parent.Public.tips({type: 2, content: "没有广告位数据！"})
            }
            else
            {
                parent.Public.tips({type: 2, content: "获取广告位数据失败！" + t.msg})
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
            var i = "新增广告位", a = {oper: t, callback: this.callback};
        }
        else
        {
            var i = "修改广告位", a = {oper: t, rowData: $("#grid").data("gridData")[e], callback: this.callback};
        }
        $.dialog({
            title: i,
            content: "url:./index.php?ctl=Operation_Advertisement&met=AdvTypeManage",
            data: a,
            width: 650,
            height: 280,
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
    },
    //del: function (t)
    //{
    //    $.dialog.confirm("删除的品牌将不能恢复，请确认是否删除？", function ()
    //    {
    //        Public.ajaxPost("./index.php?ctl=Goods_Brand&met=remove&typ=json", {brand_id: t}, function (e)
    //        {
    //            if (e && 200 == e.status)
    //            {
    //                parent.Public.tips({content: "品牌删除成功！"});
    //                $("#grid").jqGrid("delRowData", t)
    //            }
    //            else
    //            {
    //                parent.Public.tips({type: 1, content: "品牌删除失败！" + e.msg})
    //            }
    //        })
    //    })
    //}
};
function online_imgFmt(val){
    var val = '<img src="'+val+'" style="width:100px;height:40px;">';
    return val;
}
function initFilter()
{
    // //查询条件
    // Business.filterBrand();
    //
    // //商品类别
    // var opts = {
    //     width : 200,
    //     //inputWidth : (SYSTEM.enableStorage ? 145 : 208),
    //     inputWidth : 145,
    //     defaultSelectValue : '-1',
    //     //defaultSelectValue : rowData.categoryId || '',
    //     showRoot : true
    // };
    //
    // categoryTree = Public.categoryTree($('#goods_cat'), opts);

}
initFilter();
initEvent();
initGrid();