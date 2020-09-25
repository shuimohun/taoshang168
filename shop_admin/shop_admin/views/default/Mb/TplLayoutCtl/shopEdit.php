<?php if (!defined('ROOT_PATH')) {
    exit('No Permission');
} ?>

<?php
include TPL_PATH . '/' . 'header.php';
?>
<link href="<?= $this->view->css ?>/mb.css" rel="stylesheet" type="text/css">
<div class="mb-item-edit-content">
    <div class="index_block shop-list">
        <!--<h3>商品版块</h3>-->
        <div class="title">
            <h5>标题：</h5>
            <input id="home1_title" type="text" class="txt w200" name="item_data[title]" value="">
        </div>
        <div nctype="item_content" class="content">
            <h5>内容：</h5>
        </div>
    </div>

    <div class="search-shop">
        <h5>店铺名称：</h5>
        <input id="txt_shop_name" type="text" class="txt w200" name="" style="line-height:22px;">
        <a id="btn_mb_special_shop_search" class="ncap-btn" href="javascript:;" style="vertical-align: top; margin-left: 5px;">搜索</a>
        <div id="mb_special_shop_list">
            <div class="grid-wrap">
                <table id="grid">
                </table>
                <div id="page"></div>
            </div>
        </div>
    </div>
</div>
<?php
include TPL_PATH . '/' . 'footer.php';
?>
<script type="text/javascript" src="<?= $this->view->js_com ?>/template.js" charset="utf-8"></script>
<script id="item_shop_template" type="text/html">
    <div nctype="item_image" class="item">
        <div class="shop-pic"><img width="220px" height="220px" nctype="image" src="<%=shop_logo%>" alt=""></div>
        <div class="shop-name" nctype="shop_name"><%=shop_name%></div>
        <input nctype="shop_id" name="item_data[item][]" type="hidden" value="<%=shop_id%>">
        <a nctype="btn_del_item_image" href="javascript:;">删除</a>
    </div>
</script>


<script type="text/javascript">

    Array.prototype.remove = function ( val ) {
        var index = this.indexOf(val);
        if (index > -1) {
            this.splice(index, 1);
        }
    };

    $(document).ready(function(){

        var api = frameElement.api,
            item_data = api.data.item_data,
            item_id = item_data.mb_tpl_layout_id,
            layout_data = item_data.mb_tpl_layout_data,
            callback = api.data.callback;

        var shop_ids = new Array();

        if ( layout_data ) {
            $('#home1_title').val(item_data.mb_tpl_layout_title);
            var shop_html = new String();
            for (var i=0; i<layout_data.length; i++) {
                shop_html = template.render('item_shop_template', layout_data[i]);
                $('[nctype="item_content"]').append(shop_html);
                shop_ids.push(layout_data[i].shop_id);
            }
        }

        $('#btn_mb_special_shop_search').on('click', function() {
            var keyword = $('#txt_shop_name').val();
            if(keyword) {
                $("#grid").jqGrid('setGridParam', {
                    page: 1,
                    postData: {
                        shop_name: keyword
                    }
                }).trigger("reloadGrid");
            }
        });

        $('#mb_special_shop_list').on('click', '[nctype="btn_add_shop"]', function() {
            var item = {},
                rowId = $(this).data('id'),
                rowData = $('#grid').jqGrid('getRowData', rowId);
                shop_logo = $("#grid").data('gridData')[rowId].shop_logo;
            shop_ids.push(rowData.shop_id);
            alert(rowData.shop_id);

            item.shop_id = rowData.shop_id;
            item.shop_name = rowData.shop_name;
            item.shop_logo = shop_logo;
            var html = template.render('item_shop_template', item);
            $('[nctype="item_content"]').append(html);
        });

        $('.shop-list').on('click', '[nctype="btn_del_item_image"]', function() {
            var shop_id = $(this).prev().val();
            shop_ids.remove(parseInt(shop_id));
            $(this).parents('div:eq(0)').remove();
        });


        var handle = {
            imageFmatter: function (val, opt, row)
            {
                if (row.shop_logo)
                {
                    val = '<img width="100px" height="30px" src="' + row.shop_logo + '">';
                }
                else
                {
                    val = '&#160;';
                }
                return val;
            },
            addFmatter: function (val, opt, row)
            {
                return '<span class="set-status ui-label ui-label-success" nctype="btn_add_shop" data-enable="1" data-id="' + row.id + '">' + _('添加') + '</span>';
            }
        };

        function initGrid() {
            var grid_row = Public.setGrid();

            var colModel = [{
                "name": "shop_id",
                "index": "shop_id",
                "label": "店铺id",
                "classes": "ui-ellipsis",
                "align": "center",
                "title": false,
                "fixed": true,
                "width": 120
            },{
                "name": "user_name",
                "index": "user_name",
                "label": "店主帐号",
                "classes": "ui-ellipsis",
                "align": "center",
                "title": false,
                "width": 100
            },{
                "name": "shop_name",
                "index": "shop_name",
                "label": "店铺名称",
                "classes": "ui-ellipsis",
                "align": "center",
                "title": false,
                "width": 200
            },{
                "name": "shop_logo",
                "index": "shop_logo",
                "label": "店铺logo",
                "classes": "ui-ellipsis",
                "align": "center",
                "title": false,
                "width": 100,
                "formatter": handle.imageFmatter ,
                "classes":'img_flied'
            },{
                "name": "",
                "index": "",
                "label": "操作",
                "classes": "ui-ellipsis",
                "align": "center",
                "title": false,
                "fixed": true,
                "width": 70,
                "formatter": handle.addFmatter
            }];

            $('#grid').jqGrid({
                url: SITE_URL + '?ctl=Shop_Manage&met=getShopByMb&typ=json',
                postData: '',
                datatype: 'json',
                forceFit: false,
                altRows: true,
                gridview: true,
                onselectrow: false,
                colModel: colModel,
                pager: '#page',
                viewrecords: true,
                cmTemplate: {
                    sortable: true
                },
                rowNum: 25,
                rowList: [20, 30, 50],
                //scroll: 1,
                jsonReader: {
                    root: "data.items",
                    records: "data.records",
                    total: "data.total",
                    repeatitems: false,
                    id: "shop_id"
                },
                loadComplete: function(response) {
                    if (response && response.status == 200) {
                        var gridData = {};
                        data = response.data;
                        for (var i = 0; i < data.items.length; i++) {
                            var item = data.items[i];
                            item['id'] = item.shop_id;
                            gridData[item.shop_id] = item;

                            $("#grid").data('gridData', gridData);
                        }
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
            }).navGrid('#page', {
                edit: false,
                add: false,
                del: false,
                search: false,
                refresh: false
            });
        }

        initGrid();

        api.button({
            id: "confirm", name: '确定', focus: !0, callback: function () {
                postData();
                return false;
            }
        }, {id: "cancel", name: '取消'});

        function postData() {
            var layout_title = $('#home1_title').val();
            Public.ajaxPost(SITE_URL + '?ctl=Mb_TplLayout&met=editTplLayout&typ=json', {
                item_id: item_id,
                layout_data: shop_ids,
                layout_title: layout_title
            }, function (data) {
                if (data.status == 200) {
                    typeof callback == 'function' && callback();
                    return true;
                } else {
                    Public.tips({type: 1, content: data.msg});
                }
            })
        }
    });
</script>

