var queryConditions = {
        cardName: ''
    },  
    hiddenAmount = false, 
    SYSTEM = system = parent.SYSTEM;
var THISPAGE = {
    init: function(data){
        if (SYSTEM.isAdmin === false && !SYSTEM.rights.AMOUNT_COSTAMOUNT) {
            hiddenAmount = true;
        };
        this.mod_PageConfig = Public.mod_PageConfig.init('complain-new-list');//页面配置初始化
        this.initDom();
        this.addEvent();
    },
    initDom: function(){
        this.$_searchName = $('#searchName');
        this.$_searchName.placeholder();
    },
    
    reloadData: function(data){
        $("#grid").jqGrid('setGridParam',{postData: data}).trigger("reloadGrid");
    },
    addEvent: function(){
        var _self = this;
        $('#search').click(function(){
            queryConditions.help_group = $source.getValue();
            THISPAGE.reloadData(queryConditions);
        });
    }
}


function initEvent()
{
    var _self = this;
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
    var t = ["操作", "排序", "标题", "分类", "状态", "添加时间"], e = [{
        name: "operate",
        width: 60,
        fixed: !0,
        align: "center",
        formatter: Public.operFmatter
    },
        {name: "help_sort", index: "help_sort", align: "center",width: 100},
        {name: "help_title", index: "help_title", width: 200, align:"center"},
        {name: "help_group_name", index: "help_group_name", width:150, align:"center"},
        {name: "help_status_name", index: "help_status_name", width:100, align:"center"},
        {name: "help_add_time", index: "help_add_time", width:150}
    ];

    $("#grid").jqGrid({
        url: SITE_URL + "?ctl=Help_RuleBase&met=helpBaseList&typ=json&isDelete=2",
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
        jsonReader: {root: "data.items", records: "data.records", total: "data.total", repeatitems: !1, id: "help_id"},
        loadComplete: function (t)
        {
            if (t && 200 == t.status)
            {
                var e = {};
                t = t.data;
                for (var i = 0; i < t.items.length; i++)
                {
                    var a = t.items[i];
                    e[a.help_id] = a;
                }
                $("#grid").data("gridData", e);
                0 == t.items.length && parent.Public.tips({type: 2, content: "没有分类数据！"})
            }
            else
            {
                parent.Public.tips({type: 2, content: "获取分类数据失败！" + t.msg})
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
            var i = "新增规则", a = {oper: t, callback: this.callback};
        }
        else
        {
            var i = "修改规则", a = {oper: t, rowData: $("#grid").data("gridData")[e], callback: this.callback};
        }
        $.dialog({
            title: i,
            content: 'url:'+SITE_URL + "?ctl=Help_RuleBase&met=manage",
            width: $(window).width() * 0.8,
            height: $(window).height()* 0.8,
            data: a,
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
        $.dialog.confirm("删除的规则将不能恢复，请确认是否删除？", function ()
        {
            Public.ajaxPost(SITE_URL + "?ctl=Help_RuleBase&met=removeBase&typ=json", {help_id: t}, function (e)
            {
                if (e && 200 == e.status)
                {
                    parent.Public.tips({content: "分类删除成功！"});
                    $("#grid").jqGrid("delRowData", t)
                }
                else
                {
                    parent.Public.tips({type: 1, content: "分类删除失败！" + e.msg})
                }
            })
        })
    }
};
initEvent();
initGrid();
$(function(){

    $source = $("#source").combo({
        data: "./index.php?ctl=Help_RuleBase&met=helpGroupSon&typ=json",
        value: "id",
        text: "name",
        width: 110,
        ajaxOptions: {
            formatData: function (e) {
                return e.data;
            }
        },
        callback:{onChange:function (e) {
            if(e.id !== 0){
                $source = $("#source_son").combo({
                    data: "",
                    value: "id",
                    text: "name",
                    width: 110,
                    cache:1,
                    loadOnce:1,
                    ajaxOptions: {
                        formatData: function (e) {
                            return e.data;
                        }
                    }
                }).getCombo();
                $source.loadData("./index.php?ctl=Help_RuleBase&met=helpGroupSon&typ=json&pid=" + e.id);
            }
        }}
    }).getCombo();

    THISPAGE.init();

});
