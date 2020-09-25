$(function() {
    Public.operFmatterArtileGroup = function (val, opt, row) {
        var html_con = '<div class="operating" data-id="' + row.id + '"><span class="ui-icon ui-icon-trash" title="删除"></span></div>';
        return html_con;
    };
    function initEvent()
    {
        $("#btn-add").click(function (t)
        {
            t.preventDefault();
            Business.verifyRight("INVLOCTION_ADD") && handle.operate("add")
        });
        $('#grid').on('click', '.operating .ui-icon-plus', function (e)
        {
            e.preventDefault();
            var id = $(this).parent().data('id');
            handle.operate('add', id);
        });
        $("#btn-refresh").click(function (t)
        {
            t.preventDefault();
            $("#grid").trigger("reloadGrid")
        });

        //设置状态
        $('#grid').on('click', '.set-status', function(e) {
            e.stopPropagation();
            e.preventDefault();

            var id = $(this).data('id');
            is_rec = !$(this).data('enable');
            handle.setStatus(id, is_rec);
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

    function initGrid() {
        var t = ["操作", "所属文章", "评论用户ID", "评论姓名", "评论内容", "评论时间", "评论是否显示"], e = [{
            name: "operate",
            width: 70,
            fixed: !0,
            align: "center",
            formatter:Public.operFmatterArtileGroup
        },
            {name: "information_title", index: "information_title", width: 200, align: "center"},
            {name: "user_id", index: "user_id", width: 200, align: "center"},
            {name: "user_name", index: "user_name", width: 200, align: "center"},
            {name: "article_reply_content", index: "article_reply_content", width: 200, align: "center"},
            {name: "article_reply_time", index: "article_reply_time", width: 200, align: "center"},
            {name:'article_reply_show_flag',"classes": "ui-ellipsis",  width:100, align:"center","formatter": handle.statusFormatter}];
        $("#grid").jqGrid({
            url: SITE_URL + "?ctl=Information_Reply&met=informationReplyList&typ=json",
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
            jsonReader: {
                root: "data.items",
                records: "data.records",
                total: "data.total",
                repeatitems: !1,
                id: "article_reply_id"
            },
            loadComplete: function (t) {
                if (t && 200 == t.status) {
                    var e = {};
                    t = t.data;
                    for (var i = 0; i < t.items.length; i++) {
                        var a = t.items[i];
                        e[a.information_group_id] = a;
                    }
                    $("#grid").data("gridData", e);
                    0 == t.items.length && parent.Public.tips({type: 2, content: "没有评论数据！"})
                }
                else {
                    parent.Public.tips({type: 2, content: "获取评论数据失败！" + t.msg})
                }
            },
            loadError: function () {
                parent.Public.tips({type: 1, content: "操作失败了哦，请检查您的网络链接！"})
            }
        })
    }

    var handle = {
        statusFormatter: function (val, opt, row) {
            var text = val == 0 ? _('否') : _('是');
            var cls = val == 0 ? 'ui-label-default' : 'ui-label-success';
            return '<span class="set-status ui-label ' + cls + '" data-enable="' + val + '" data-id="' + row.id + '">' + text + '</span>';
        }, del: function (t) {
            $.dialog.confirm("删除的评论将不能恢复，请确认是否删除？", function () {
                Public.ajaxPost(SITE_URL + "?ctl=Information_Reply&met=removeReply&typ=json", {article_reply_id: t}, function (e) {
                    if (e && 200 == e.status) {
                        parent.Public.tips({content: "评论删除成功！"});
                        $("#grid").jqGrid("delRowData", t)
                    }
                    else {
                        parent.Public.tips({type: 1, content: "评论删除失败！" + e.msg})
                    }
                })
            })
        },
        //修改状态
        setStatus: function(id, is_rec) {
            if (!id) {
                return;
            }
            Public.ajaxPost(SITE_URL + '?ctl=Information_Reply&met=editReply&typ=json', {
                article_reply_id: id,
                article_reply_show_flag: Number(is_rec)
            }, function(data) {
                if (data && data.status == 200) {
                    parent.Public.tips({
                        content: _('状态修改成功！')
                    });
                    $('#grid').jqGrid('setCell', id, 'article_reply_show_flag', is_rec);
                } else {
                    parent.Public.tips({
                        type: 1,
                        content: _('状态修改失败！') + data.msg
                    });
                }
            });
        }
    };
    initEvent();
    initGrid();
})