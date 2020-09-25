<?php if (!defined('ROOT_PATH')) {
    exit('No Permission');
} ?>

<?php
include $this->view->getTplPath() . '/'  . 'header.php';
?>
<link href="<?= $this->view->css ?>/mb.css" rel="stylesheet" type="text/css">
<div class="mb-item-edit-content">

    <div class="title">
        <?php if($data['temp_main_title'] == $data['temp_assis_title']){for($i=0;$i<$data['temp_main_title'];$i++){?>
            <h5>主副标题<?=$i+1?>：</h5>
            <input id="main_title_<?=$i+1?>" type="text" class="txt w200" name="main_title[]" value="<?=$data['base_main_title'][$i]?>">
            <input id="assis_title_<?=$i+1?>" type="text" class="txt w200" name="assis_title[]" value="<?=$data['base_assis_title'][$i]?>">
        <?php }}else{for($i=0;$i<$data['temp_main_title'];$i++){ ?>
            <h5>标题<?=$i+1?>：</h5>
            <input id="main_title_<?=$i+1?>" type="text" class="txt w200" name="main_title[]" value="<?=$data['base_main_title'][$i]?>">
        <?php }} ?>
    </div>

    <div class="index_block goods-list">
        <div nctype="item_content" class="content">
            <h5>内容：</h5>
        </div>
    </div>
    <div class="search-goods">
        <!--  <h3>选择商品添加</h3> -->
        <h5>商品id：</h5>
        <input id="txt_goods_id" type="text" class="txt w200" name="" style="line-height:22px;">
        <a id="btn_mb_special_goods_search" class="ncap-btn" href="javascript:;" style="vertical-align: top; margin-left: 5px;">搜索</a>
        <div id="mb_special_goods_list">
            <div class="grid-wrap">
                <table id="grid">
                </table>
                <div id="page"></div>
            </div>
        </div>
    </div>
</div>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
<script type="text/javascript" src="<?= $this->view->js_com ?>/template.js" charset="utf-8"></script>
<script id="item_goods_template" type="text/html">
    <div nctype="item_image" class="item">
        <div class="goods-pic"><img width="220px" height="220px" nctype="image" src="<%=goods_image%>" alt=""></div>
        <div class="goods-name" nctype="goods_name"><%=goods_name%></div>
        <div class="goods-price" nctype="goods_price"><%=goods_price%></div>
        <input nctype="goods_id" name="item_data[item][]" type="hidden" value="<%=goods_id%>">
        <a nctype="btn_del_item_image" href="javascript:;">删除</a>
    </div>
</script>


<script type="text/javascript">
    var max_num = <?=$data['temp_max'] ?>;
    var min_num = <?=$data['temp_min'] ?>;
    var now_num = <?=$data['now_num'] ?>;

    Array.prototype.remove = function ( val ) {
        var index = this.indexOf(val);
        if (index > -1) {
            this.splice(index, 1);
        }
    };

    $(document).ready(function(){

        var api = frameElement.api,
            item_data =<?=$data?>,
            base_id = <?=$data['base_id'] ?>,
            base_data = <?=json_encode($data['goods_list'])?>,
            callback = api.data.callback;

        var goods_ids = new Array();
        if (base_data) {
            var goods_html = new String();
            for (var i=0; i<base_data.length; i++) {
                goods_html = template.render('item_goods_template', base_data[i]);
                $('[nctype="item_content"]').append(goods_html);
                goods_ids.push(base_data[i].goods_id);
            }
        } else {
            /*var base_data = new Array();*/
        }

        $('#btn_mb_special_goods_search').on('click', function() {
            var goods_id = $('#txt_goods_id').val();
            if(goods_id) {
                $("#grid").jqGrid('setGridParam',{
                    page: 1,
                    postData: {
                        common_state: 1,    //正常状态
                        common_verify: 1,   //通过审核
                        goods_id: goods_id
                    }
                }).trigger("reloadGrid");
            }
        });

        $('#mb_special_goods_list').on('click', '[nctype="btn_add_goods"]', function() {
            var item = {},
                rowId = $(this).data('id'),
                rowData = $('#grid').jqGrid('getRowData', rowId);
            common_image = $("#grid").data('gridData')[rowId].common_image;

            item.goods_id = rowData.common_id;
            item.goods_name = rowData.common_name;
            item.goods_price = rowData.common_shared_price;
            item.goods_image = common_image;
            if(!max_num){
                goods_ids.push(rowData.common_id);
                var html = template.render('item_goods_template', item);
                $('[nctype="item_content"]').append(html);
                now_num++;
            }else{
                if(now_num>=max_num){
                    parent.parent.Public.tips({type: 1, content:"已是该楼层最大上限"});
                }else{
                    goods_ids.push(rowData.common_id);
                    var html = template.render('item_goods_template', item);
                    $('[nctype="item_content"]').append(html);
                    now_num++;
                }
            }
        });

        $('.goods-list').on('click', '[nctype="btn_del_item_image"]', function() {
            var goods_id = $(this).prev().val();
            if($.inArray(goods_id,goods_ids) == -1){
                goods_ids.splice($.inArray(null,goods_ids),1);
            }else{
                goods_ids.splice($.inArray(goods_id,goods_ids),1);
            }
            $(this).parents('div:eq(0)').remove();
            now_num--;
        });


        var handle = {
            imageFmatter: function (val, opt, row)
            {
                if (row.common_image)
                {
                    val = '<img width="60px" height="60px" src="' + row.common_image + '">';
                }
                else
                {
                    val = '&#160;';
                }
                return val;
            },
            addFmatter: function (val, opt, row)
            {
                return '<span class="set-status ui-label ui-label-success" nctype="btn_add_goods" data-enable="1" data-id="' + row.id + '">' + _('添加') + '</span>';
            }
        };

        function initGrid() {
            var grid_row = Public.setGrid();

            var colModel = [{
                "name": "common_id",
                "index": "common_id",
                "label": "商品SPU",
                "classes": "ui-ellipsis",
                "align": "center",
                "title": false,
                "fixed": true,
                "width": 60
            },{
                "name": "common_name",
                "index": "common_name",
                "label": "商品名称",
                "classes": "ui-ellipsis",
                "align": "center",
                "title": false,
                "width": 100
            },{
                "name": "common_shared_price",
                "index": "common_shared_price",
                "label": "商品价格",
                "classes": "ui-ellipsis",
                "align": "center",
                "title": false,
                "width": 100
            },{
                "name": "common_image",
                "index": "common_image",
                "label": "商品主图",
                "classes": "ui-ellipsis",
                "align": "center",
                "title": false,
                "width": 100,
                "formatter": handle.imageFmatter ,
                "classes":'img_flied'
            },{
                "name": "shop_id",
                "index": "shop_id",
                "label": "操作",
                "classes": "ui-ellipsis",
                "align": "center",
                "title": false,
                "fixed": true,
                "width": 70,
                "formatter": handle.addFmatter
            }];

            $('#grid').jqGrid({
                url: SITE_URL + '?ctl=Goods_Goods&met=listCommon&typ=json',
                postData: {
                    common_state: 1,    //正常状态
                    common_verify: 1    //通过审核
                },
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
                rowNum: 100,
                rowList: [100, 200, 500],
                //scroll: 1,
                jsonReader: {
                    root: "data.items",
                    records: "data.records",
                    total: "data.total",
                    repeatitems: false,
                    id: "common_id"
                },
                loadComplete: function(response) {
                    if (response && response.status == 200) {
                        var gridData = {};
                        data = response.data;
                        for (var i = 0; i < data.items.length; i++) {
                            var item = data.items[i];
                            item['id'] = item.common_id;
                            gridData[item.common_id] = item;

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
            var main = [];
            var assis = [];
            var main_title=document.getElementsByName('main_title[]');
            var assis_title = document.getElementsByName('assis_title[]');
            if(main_title.length>0){
                for(var i =0;i<main_title.length;i++){
                    main[i] = main_title[i].value;
                }
                if(assis_title.length>0){
                    for(var j=0;j<assis_title.length;j++){
                        assis[j]=assis_title[j].value;
                    }
                }
                if(!max_num){
                    if(now_num>=min_num){
                        $.post(SITE_URL + '?ctl=Operation_Opening&met=editFloorGoods&typ=json',{base_id:base_id,base_goods:goods_ids,base_main:main,base_assis:assis},function(data){
                            if (data.status == 200){
                                typeof callback == 'function' && callback();
                                return true;
                            }else{
                                Public.tips({type: 1, content: data.msg});
                            }
                        });
                    }else{
                        parent.parent.Public.tips({type: 1, content:"添加商品至少"+min_num+"件"});
                    }
                }else{
                    if(now_num>=min_num && now_num<=max_num){
                        $.post(SITE_URL + '?ctl=Operation_Opening&met=editFloorGoods&typ=json',{base_id:base_id,base_goods:goods_ids,base_main:main,base_assis:assis},function(data){
                            if (data.status == 200){
                                typeof callback == 'function' && callback();
                                return true;
                            }else{
                                Public.tips({type: 1, content: data.msg});
                            }
                        });
                    }else{
                        if(now_num>=max_num){
                            parent.parent.Public.tips({type: 1, content:"添加商品至多"+max_num+"件"});
                        }else{
                            parent.parent.Public.tips({type: 1, content:"添加商品至少"+min_num+"件"});
                        }
                    }
                }

            }else{
                parent.parent.Public.tips({type: 1, content:"请填写标题"});
            }



        }
    });
</script>

