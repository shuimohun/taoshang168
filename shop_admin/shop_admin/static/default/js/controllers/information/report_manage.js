var queryConditions = {
        cardName: ''
    },
    hiddenAmount = false,
    SYSTEM = system = parent.SYSTEM;
var THISPAGE = {
    init: function(data) {
        if (SYSTEM.isAdmin === false && !SYSTEM.rights.AMOUNT_COSTAMOUNT) {
            hiddenAmount = true;
        };
        this.mod_PageConfig = Public.mod_PageConfig.init('complain-new-list'); //页面配置初始化
        this.initDom();
        this.addEvent();
    },
    initDom: function() {
        this.$_searchName = $('#searchName');
        this.$_searchName.placeholder();
    },

    reloadData: function(data) {
        $("#grid").jqGrid('setGridParam', {
            postData: data
        }).trigger("reloadGrid");
    },
    addEvent: function() {
        var _self = this;
        $('#search').click(function() {
            queryConditions.information_group = $source.getValue();
            THISPAGE.reloadData(queryConditions);
        });
    }
}

function initEvent() {
    var _self = this;
    $("#btn-add").click(function(t) {
        t.preventDefault();
        Business.verifyRight("INVLOCTION_ADD") && handle.operate("add")
    });
    $("#btn-refresh").click(function(t) {
        t.preventDefault();
        $("#grid").trigger("reloadGrid")
    });

    $("#grid").on("click", ".operating .ui-icon-pencil:not(.ui-icon-disabled)", function(t) {
        t.preventDefault();
        if (Business.verifyRight("INVLOCTION_UPDATE")) {
            var e = $(this).parent().data("id");
            handle.operate("edit", e)
        }
    });

    $(window).resize(function() {
        Public.resizeGrid()
    })
}

function initGrid() {
    var t = ["操作", "举报人", "状态"],
        e = [{
            name: "operate",
            width: 60,
            fixed: !0,
            align: "center",
            formatter: operFmatter
        }, {
            name: "user_name",
            index: "user_name",
            align: "center",
            width: 100
        }, {
            name: "status_con",
            index: "status_con",
            align: "center",
            width: 100
        }];
    function operFmatter(val, opt, row) {
        if (row.status == 1){
            var html_con = '<div class="operating" data-id="' + row.id + '"><span class="ui-icon ui-icon-pencil" title="审核"></span></div>';
        }else{
            var html_con = '<div class="operating"><span class="ui-icon ui-icon-pencil ui-icon-disabled" title="审核"></span></div>';
        }
        return html_con;
    };

    var information_id = $('#information_id').val();

    $("#grid").jqGrid({
        url: SITE_URL + "?ctl=Information_Report&met=getReportRow&typ=json&information_id=" + information_id,
        datatype: "json",
        height: Public.setGrid().h,
        colNames: t,
        colModel: e,
        autowidth: !0,
        pager: "#page",
        viewrecords: !0,
        cmTemplate: {
            sortable: !1,
            title: !1
        },
        page: 1,
        rowNum: 25,
        rowList: [25, 50, 100],
        shrinkToFit: !1,
        jsonReader: {
            root: "data.items",
            records: "data.records",
            total: "data.total",
            repeatitems: !1,
            id: "report_id"
        },
        loadComplete: function(t) {
            if (t && 200 == t.status) {
                var e = {};
                t = t.data;
                for (var i = 0; i < t.items.length; i++) {
                    var a = t.items[i];
                    e[a.report_id] = a;
                }
                $("#grid").data("gridData", e);
                0 == t.items.length && parent.Public.tips({
                    type: 2,
                    content: "没有数据！"
                })
            } else {
                parent.Public.tips({
                    type: 2,
                    content: "获取分类数据失败！" + t.msg
                })
            }
        },
        loadError: function() {
            parent.Public.tips({
                type: 1,
                content: "操作失败了哦，请检查您的网络链接！"
            })
        },
        ondblClickRow : function(rowid, iRow, iCol, e){
            $('#' + rowid).find('.ui-icon-pencil:not(.ui-icon-disabled)').trigger('click');
        },
    })
}

var handle = {
    operate: function(t, e) {
        if ("edit" == t) {
            var i = "查看举报记录", a = {oper: t, rowData: $("#grid").data("gridData")[e], callback: this.callback};
        }
        $.dialog({
            title: i,
            content: 'url:'+SITE_URL + "?ctl=Information_Report&met=audit&report_id="+e,
            width: 500,
            height: 300,
            data: a,
            max: !1,
            min: !1,
            cache: !1,
            lock: !0,
            zIndex:9999
        })
    },
    callback: function(t, e, i) {
        var a = $("#grid").data("gridData");
        if (!a) {
            a = {};
            $("#grid").data("gridData", a)
        }
        a[t.id] = t;
        if ("edit" == e) {
            $("#grid").jqGrid("setRowData", t.id, t);
            i && i.api.close()
        } else {
            $("#grid").jqGrid("addRowData", t.id, t, "last");
            i && i.api.close()
        }
    }
};

$(function() {
    initEvent();
    initGrid();
    THISPAGE.init();
});