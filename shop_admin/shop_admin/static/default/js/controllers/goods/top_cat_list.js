$(function() {
    var searchFlag = false;

    var defaultPage = Public.getDefaultPage();

    var handle = {
        //修改、新增
        operate: function(oper, e) {
            if (oper == 'add') {
                var title = '新增';
                var data = {
                    oper: oper,
                    callback: this.callback
                };
            } else {
                var title = '修改';
                var data = {
                    oper: oper,
                    rowData: $("#grid").data("gridData")[e],
                    callback: this.callback
                };
            }

            $.dialog({
                title: title,
                content: 'url:' + SITE_URL + '?ctl=Goods_TopCat&met=manage&typ=e',
                data: data,
                width: $(window).width() * 0.5,
                height: $(window).height() * 0.5,
                max: false,
                min: false,
                cache: false,
                lock: true
            });
        },
        //删除
        del: function(row_ids) {
            $.dialog.confirm('删除的将不能恢复，请确认是否删除？', function() {
                Public.ajaxPost(SITE_URL + '?ctl=Goods_TopCat&met=remove&typ=json', {
                    id: row_ids
                }, function(data) {
                    if (data && data.status == 200) {
                        var id_arr = data.data.id || [];
                        if (row_ids.split(',').length === id_arr.length) {
                            parent.Public.tips({
                                content: '成功删除' + id_arr.length + '个！'

                            });
                        } else {
                            parent.Public.tips({
                                type: 2,
                                content: data.data.msg
                            });
                        }
                        for (var i = 0, len = id_arr.length; i < len; i++) {
                            $('#grid').jqGrid('setSelection', id_arr[i]);
                            $('#grid').jqGrid('delRowData', id_arr[i]);
                        };
                    } else {
                        parent.Public.tips({
                            type: 1,
                            content: '删除失败！' + data.msg
                        });
                    }
                });
            });
        },
        callback: function(data, oper, dialogWin) {
            var gridData = $("#grid").data('gridData');
            if (!gridData) {
                gridData = {};
                $("#grid").data('gridData', gridData);
            }
            //计算期初余额字段difMoney
            data.difMoney = data.amount - data.periodMoney;

            gridData[data.id] = data;

            if (oper == "edit") {
                $("#grid").jqGrid('setRowData', data.id, data);
                dialogWin && dialogWin.api.close();
            } else {
                $("#grid").jqGrid('addRowData', data.id, data, 'first');
                dialogWin && dialogWin.api.close();
            }
        },
        //操作项格式化，适用于有“修改、删除”操作的表格
        operFmatter: function(val, opt, row) {
            var html_con = '<div class="operating" data-id="' + row.id + '"><span class="ui-icon ui-icon-pencil" title="修改"></span><span class="ui-icon ui-icon-trash" title="删除"></span></div>';
            return html_con;
        },
        statusFmatter: function(val, opt, row) {
            var text = val == true ? '已禁用' : '已启用';
            var cls = val == true ? 'ui-label-default' : 'ui-label-success';
            return '<span class="set-status ui-label ' + cls + '" data-enable="' + val + '" data-id="' + row.id + '">' + text + '</span>';
        },
        catNameFormatter:function(val, opt, row) {
            for (i in defaultPage.SYSTEM.goodsCatInfo)
            {
                if (val == defaultPage.SYSTEM.goodsCatInfo[i].id)
                {
                    return defaultPage.SYSTEM.goodsCatInfo[i].cat_name;
                }

            }
            return '';
        }
    };

    function initGrid() {
        var grid_row = Public.setGrid();
        var colModel = [{
            "name": "operate",
            "label": "操作",
            "width": 80,
            "sortable": false,
            "search": false,
            "resizable": false,
            "fixed": true,
            "align": "center",
            "title": false,
            "formatter": handle.operFmatter
        }, {
            "name": "cat_id",
            "index": "cat_id",
            "label": "分类id",
            "classes": "ui-ellipsis",
            "align": "center",
            "title": false,
            "fixed": true,
            "width": 100
        }, {
            "name": "cat_name",
            "index": "cat_name",
            "label": "分类名称",
            "classes": "ui-ellipsis",
            "align": "center",
            "title": false,
            "width": 200
        }, {
            "name": "display_order",
            "index": "display_order",
            "label": "排序",
            "classes": "ui-ellipsis",
            "align": "center",
            "title": false,
            "fixed": true,
            "width": 100
        }, {
            "name": "add_time",
            "index": "add_time",
            "label": "添加时间",
            "classes": "ui-ellipsis",
            "align": "center",
            "title": false,
            "fixed": true,
            "width": 200
        }];
        $('#grid').jqGrid({
            url: SITE_URL + '?ctl=Goods_TopCat&met=lists&typ=json',
            datatype: 'json',
            autowidth: true,
            shrinkToFit: false,
            forceFit: true,
            width: grid_row.w,
            height: grid_row.h,
            altRows: true,
            gridview: true,
            onselectrow: false,
            multiselect: false, //多选
            colModel: colModel,
			pager: "#page",
            viewrecords: true,
            cmTemplate: {
                sortable: true
            },
            rowNum: 25,
            rowList: [25, 50, 100],
            //scroll: 1,
            jsonReader: {
                root: "data.items",
                records: "data.records",
                total: "data.total",
                repeatitems: false,
                id: "id"
            },
            loadComplete: function(response) {
                if (response && response.status == 200) {
                    var gridData = {};
                    data = response.data;
                    for (var i = 0; i < data.items.length; i++) {
                        var item = data.items[i];
                        item['id'] = item.id;
                        gridData[item.id] = item;
                    }
                    $("#grid").data('gridData', gridData);
                } else {
                    var msg = response.status === 250 ? (searchFlag ? '没有满足条件的结果哦！' : '没有数据哦！') : response.msg;
                    parent.Public.tips({
                        type: 2,
                        content: msg
                    });
                }
            },
            loadError: function(xhr, status, error) {
                parent.Public.tips({
                    type: 1,
                    content: '操作失败了哦，请检查您的网络链接！'
                });
            },
            resizeStop: function(newwidth, index) {
                //mod_PageConfig.setGridWidthByIndex(newwidth, index, 'grid');
            }
        }).navGrid('#page', {
            edit: false,
            add: false,
            del: false,
            search: false,
            refresh: false
        });
    }

    function initEvent() {
        //新增
        $('#btn-add').on('click', function(e) {
            e.preventDefault();
            handle.operate('add');
        });
        //修改
        $('#grid').on('click', '.operating .ui-icon-pencil', function(e) {
            e.preventDefault();
            var id = $(this).parent().data('id');
            handle.operate('edit', id);
        });
        //删除
        $('#grid').on('click', '.operating .ui-icon-trash', function(e) {
            e.preventDefault();
            var id = $(this).parent().data('id');
            handle.del(id + '');
        });
    }

    initGrid();
    initEvent();
});