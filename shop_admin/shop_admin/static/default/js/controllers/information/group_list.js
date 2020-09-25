var handle = {
    //修改、新增
    operate: function(oper, row_id) {
        if (oper == 'add' && !row_id) {
            var title = _('新增分类');
            var data = {
                oper: oper,
                callback: this.callback
            };
            var met = 'manage';
        } else if (oper == 'add' && row_id) {
            var title = _('新增分类');
            var data = {
                oper: oper,
                parent_id: row_id,
                callback: this.callback
            };
            var met = 'manage';
        } else if (oper == 'editNav') {
            var title = sprintf(_('编辑分类导航 [%s]'), row_id);
            var data = {
                oper: oper,
                rowId: row_id,
                rowData: $("#grid").data('gridData')[row_id],
                callback: this.callback
            };
            var met = 'listCatNav&id=' + row_id;
        } else {
            var title = sprintf(_('修改分类 [%s]'), $("#grid").data('gridData')[row_id]['information_group_title']);
            var data = {
                oper: oper,
                rowId: row_id,
                rowData: $("#grid").data('gridData')[row_id],
                callback: this.callback
            };

            var met = 'manage';
        }

        $.dialog({
            title: title,
            content: 'url:'+SITE_URL + "?ctl=Information_Group&met=manage",
            data: data,
            width: $(window).width() * 0.4,
            height: $(window).height() * 0.3,
            max: !1,
            min: !1,
            cache: !1,
            lock: !0
        });
    },

    //删除
    del: function(row_ids) {
        $.dialog.confirm('删除的将不能恢复，请确认是否删除？', function() {
            Public.ajaxPost(SITE_URL + '?ctl=Information_Group&met=removeGroup&typ=json', {
                id: row_ids
            }, function(data) {
                if (data && 200 == data.status) {
                    parent.Public.tips({content: "删除成功！"});
                    $("#grid").jqGrid("delRowData", row_ids)
                } else {
                    parent.Public.tips({type: 1, content: "删除成功！" + e.msg})
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

        gridData[data.id] = data;

        if (oper == "edit" || oper == "close" || oper == "verify") {
            $.each(data, function(name, value) {
                $("#grid").jqGrid('setRowData', value['id'], value);
                gridData[value['id']] = value;
            });
            dialogWin && dialogWin.api.close();
        } else {
            /*$.each(data, function(name, value)
             {
             $("#grid").jqGrid('addRowData', value.id, value,'first');
             gridData[value['id']] = value;
             });*/
            dialogWin && dialogWin.api.close();
            $("#grid").trigger("reloadGrid");
        }
    },

    //操作项格式化，适用于有“修改、删除”操作的表格
    operFmatter: function(val, opt, row) {
        var nav_str = '';
        var add_str = '';

        if (2 == row.cat_level) {
            add_str = '<span class="ui-icon ui-icon-plus ui-icon-disabled" title="添加"></span>';
        } else {
            add_str = '<span class="ui-icon ui-icon-plus" title="添加"></span>';
        }

        var html_con = '<div class="operating" data-id="' + row.id + '"><span class="ui-icon ui-icon-pencil" title="修改"></span>' + nav_str + '<span class="ui-icon ui-icon-trash" title="删除"></span>' + add_str + '</div>';

        return html_con;
    },

    imageFmatter: function(val, opt, row) {
        if (row.cat_pic) {
            val = '<img src="' + row.cat_pic + '" style="width:100px;height:40px;">';
        } else {
            val = '&#160;';
        }

        return val;
    }
};

var grid_row = Public.setGrid();

var colModel = [{
    "name": "operate",
    "label": "操作",
    "width": 130,
    "sortable": false,
    "search": false,
    "resizable": false,
    "fixed": true,
    "align": "center",
    "title": false,
    "formatter": handle.operFmatter
}, {
    "name": "information_group_sort",
    "index": "information_group_sort",
    "label": "排序",
    "classes": "ui-ellipsis",
    "align": "center",
    "title": false,
    "fixed": true,
    "width": 100,
    "sortable": false
}, {
    "name": "information_group_title",
    "index": "information_group_title",
    "label": " 分类名称",
    "classes": "ui-ellipsis",
    "align": "left",
    "title": false,
    "width": 200,
    "sortable": false
}, {
    "name": "information_group_id",
    "index": "information_group_id",
    "label": "分类id",
    "classes": "ui-ellipsis",
    "align": "center",
    "title": false,
    "fixed": true,
    "hidden": true,
    "width": 100,
    "sortable": false
}, {
    "name": "information_group_parent_id",
    "index": "information_group_parent_id",
    "label": "父类id",
    "classes": "ui-ellipsis",
    "align": "center",
    "title": false,
    "fixed": true,
    "hidden": true,
    "width": 100
}, {
    "name": "cat_pic",
    "index": "cat_pic",
    "label": "分类图片",
    "classes": "ui-ellipsis",
    "align": "center",
    "title": false,
    "width": 100,
    "formatter": handle.imageFmatter,
    "sortable": false
}];

jQuery(document).ready(function($) {

    function initEvent() {

        //新增
        $('#btn-add').on('click', function(e) {
            e.preventDefault();
            handle.operate('add');
        });

        $('#grid').on('click', '.operating .ui-icon-plus', function(e) {
            if (!$(e.target).hasClass('ui-icon-disabled')) {
                e.preventDefault();
                var id = $(this).parent().data('id');
                handle.operate('add', id);
            }
        });

        $('#grid').on('click', '.operating .ui-icon-pencil', function(e) {
            e.preventDefault();
            var id = $(this).parent().data('id');
            handle.operate('edit', id);
        });

        $('#grid').on('click', '.operating .ui-icon-trash', function(e) {
            e.preventDefault();
            var id = $(this).parent().data('id');
            handle.del(id + '');
        });
    }

    function initGrid() {
        $("#grid").jqGrid({
            url: SITE_URL + '?ctl=Information_Group&met=informationGroupCat&typ=json',
            datatype: "json",
            autowidth: true,
            shrinkToFit: false,
            forceFit: true,
            width: grid_row.w,
            height: grid_row.h,
            colModel: colModel,
            hoverrows: false,
            viewrecords: false,
            gridview: true,
            scrollrows: true,
            treeGrid: true,
            ExpandColumn: "information_group_title",
            treedatatype: "json",
            treeGridModel: "adjacency",
            loadonce: true,
            pager: "#page",
            rowNum: 25,
            rowList: [
                25, 50, 100],
            "jsonReader": {
                root: "data.items",
                records: "data.records",
                total: "data.total",
                repeatitems: !1,
                id: "information_group_id"
            },
            loadComplete: function(response) {
                if (response && response.status == 200) {
                    var gridData = {};
                    data = response.data;
                    for (var i = 0; i < data.items.length; i++) {
                        var item = data.items[i];
                        item['id'] = item.information_group_id;
                        gridData[item.information_group_id] = item;
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
            "treeReader": {
                "parent_id_field": "information_group_parent_id",
                "level_field": "cat_level",
                "leaf_field": "is_leaf",
                "expanded_field": "expanded",
                "loaded": "loaded",
                "icon_field": "cat_icon"
            },
            imageFmatter: function(val, opt, row) {
                if (row.cat_pic) {
                    val = '<img src="' + row.cat_pic + '" style="width:100px;height:40px;">';
                } else {
                    val = '&#160;';
                }
                return val;
            }
        })
    }

    initGrid();
    initEvent();
});