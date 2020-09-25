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

    $('.grid-wrap').on('click', '.ui-icon-search', function(e){
        e.preventDefault();
        var information_id = $(this).parent().data("id");
        $.dialog({
            title: "查看举报记录",
            content: "url:"+ SITE_URL + '?ctl=Information_Report&met=manage&information_id=' + information_id,
            width: $(window).width() * 0.6,
            height:$(window).height() * 0.8,
            max: !1,
            min: !1,
            cache: !1,
            lock: !0,
        })
    });

    $(window).resize(function() {
        Public.resizeGrid()
    })
}

function initGrid() {
    var t = ["操作", "标题", "作者", "真实阅读量", "虚拟阅读量", "添加时间"],
        e = [{
            name: "operate",
            width: 60,
            fixed: !0,
            align: "center",
            formatter: operFmatter
        },{
            name: "information_title",
            index: "information_title",
            width: 200,
            align: "center"
        },{
            name: "information_writer",
            index: "information_writer",
            width: 200,
            align: "center"
        }, {
            name: "information_read_count",
            index: "information_read_count",
            width: 100,
            align: "center"
        }, {
            name: "information_fake_read_count",
            index: "information_fake_read_count",
            width: 100,
            align: "center"
        }, {
            name: "information_add_time",
            index: "information_add_time",
            width: 150
        }];
    function operFmatter(val, opt, row) {
        var html_con = '<div class="operating" data-id="' + row.id + '"><span class="ui-icon ui-icon-search" title="查看"></span></div>';
        return html_con;
    };

    $("#grid").jqGrid({
        url: SITE_URL + "?ctl=Information_Report&met=getReportList&typ=json",
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
            id: "information_id"
        },
        loadComplete: function(t) {
            if (t && 200 == t.status) {
                var e = {};
                t = t.data;

                for (var i = 0; i < t.items.length; i++) {
                    var a = t.items[i];
                    e[a.information_id] = a;
                }
                $("#grid").data("gridData", e);
                0 == t.items.length && parent.Public.tips({
                    type: 2,
                    content: "没有分类数据！"
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
            $('#' + rowid).find('.ui-icon-search').trigger('click');
        },
    })
}

var handle = {
    operate: function(t, e) {

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
initEvent();
initGrid();
$(function() {
    $source = $("#source").combo({
        data: "./index.php?ctl=Information_Base&met=informationGroup&typ=json",
        value: "id",
        text: "name",
        width: 110,
        ajaxOptions: {
            formatData: function(e) {
                return e.data;
            }
        },
        callback: {
            onChange: function(e) {
                if (e.id !== 0) {
                    $source = $("#source_Son").combo({
                        data: "",
                        value: "id",
                        text: "name",
                        width: 110,
                        cache: 1,
                        loadOnce: 1,
                        ajaxOptions: {
                            formatData: function(e) {
                                return e.data;
                            }
                        }
                    }).getCombo();
                    $source.loadData("./index.php?ctl=Information_Base&met=informationGroup&typ=json&pid=" + e.id);
                }
            }
        }
    }).getCombo();

    THISPAGE.init();

});