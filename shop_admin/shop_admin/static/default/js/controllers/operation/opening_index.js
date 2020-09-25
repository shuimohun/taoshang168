function initEvent(){
        $_matchCon = $("#matchCon"),
        $_matchCon.placeholder(),
        $("#btn-refresh").click(function (t)
        {
            t.preventDefault();
            $("#grid").trigger("reloadGrid")
        });

        //编辑楼层
        $("#grid").on("click", ".operating .ui-icon-pencil", function (t)
        {
            t.preventDefault();
            var opening_id = $(this).parent().data("id");
            handle.operate("edit",opening_id)

        });
        //编辑商品
    $('.grid-wrap').on('click', '.ui-icon-search', function(e){
        e.preventDefault();
        var opening_id = $(this).parent().data("id");
        $.dialog({
            title: '编辑商品',
            content: "url:"+SITE_URL + '?ctl=Operation_Opening&met=uploadGoods&opening_id=' + opening_id,
            data:{callback:function(){ window.location.reload();}},
            width:$(window).width()*0.7,
            height:$(window).height()*0.7,
            max: !1,
            min: !1,
            cache: !1,
            lock: !0,
            zIndex:100
        })
    });


    $(window).resize(function ()
    {
        Public.resizeGrid()
    })
}

function initGrid(){
    var gridWH = Public.setGrid(), _self = this;
    var t = ["操作","编号","板块名称","更新时间"], e = [{
        name: "operate",
        width: 100,
        fixed: !0,
        align: "center",
        formatter: operFmattershop,
    },
        {name: "opening_id", index: "opening_id", align: "center",width: 100},
        {name: "opening_name", index: "opening_name",  align: "center",width: 200},
        {name: "update_time", index: "update_time", align: "center", width: 150},
    ];
    $("#grid").jqGrid({
        url: SITE_URL + "?ctl=Operation_Opening&met=showIndex&typ=json",
        datatype: "json",
        height: Public.setGrid().h,
        colNames: t,
        colModel: e,
        autowidth: !0,
        pager: "#page",
        viewrecords: !0,
        cmTemplate: {sortable: !1, title: !1},
        page: 1,
        rowNum: 100,
        rowList: [100, 200, 500],
        shrinkToFit: !1,
        jsonReader: {root: "data.items", records: "data.records", total: "data.total", repeatitems: !1, id: "opening_id"},
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
                0 == t.items.length && parent.Public.tips({type: 2, content: "没有数据！"})
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
            var i = "新增首页楼层", a = {oper: t, callback:testF};
        }
        else
        {
            var i = "修改首页楼层", a = {oper: t, rowData: $("#grid").data("gridData")[e], callback:testF};

        }
        $.dialog({
            title: i,
            content:"url:"+SITE_URL+'?ctl=Operation_Opening&met=settingTier&opening_id='+e,
            data: a,
            width: $(window).width()*0.5,
            height:$(window).height()*0.5,
            max: !1,
            min: !1,
            cache: !1,
            lock: !0,
            zIndex:100
        })

    },

};
function testF(){
    window.location.reload();
}
function operFmattershop(val, opt, row) {
    var html_con = '<div class="operating" data-id="' + row.opening_id + '"><span class="ui-icon ui-icon-pencil" title="修改"></span><span class="ui-icon ui-icon-search" title="查看数据"></span></div>';
    return html_con;
};
initEvent();
initGrid();
