$(function(){

    var handle = {

        //操作项格式化
        operFmatter:function(val,opt,row)
        {
            var htmlDom = "<span class='ui-icon ui-icon-plus like' style='margin:0 auto;' data-id='"+row.id+"' title='添加到猜你喜欢'></span>";
            return htmlDom;
        },

        //图片项格式化
        imageFmatter:function(val, opt, row)
        {
            if (row.common_image) {
                val = '<img src="' + row.common_image + '" width="'+50+'" height="'+50+'">';
            } else {
                val = '&#160;';
            }
            return val;
        },

        /**
         * 把商品添加到猜你喜欢 Action(ajax)
         * @param common_id
         * $author liuguilong 20170616
         */
        like:function(common_id){
            $.dialog.confirm('确认把该商品添加到猜你喜欢吗？',function(){
                Public.ajaxPost(SITE_URL + '?ctl=Goods_Likes&met=unlike&met=like&typ=json',{common_id:common_id},function(data){
                    if(data && data.status == 200){
                        parent.Public.tips({
                            content:'添加到猜你喜欢成功！'
                        });
                        $('#grid').jqGrid('setSelection', common_id);
                        $('#grid').jqGrid('delRowData', common_id);
                    }else{
                        parent.Public.tips({
                            type:1,
                            content:'取消猜你喜欢失败！' + data.msg
                        });
                    }
                })
            })
        }

    }
    
    /**
     * 把商品添加到猜你喜欢 Dom
     * $author liuguiong 20170616
     */
    $('#grid').on('click','.like',function(e){
        e.preventDefault();
        var common_id = $(this).data('id');
        handle.like(common_id);
    });
    
    $('#search').on('click',function(e){
        e.preventDefault();
        $('#grid').jqGrid('setGridParam',{
            page:1,
            postData:{
                common_name:$('#common_name').val(),
                cat_id: $('#cat_id').val(),
            }
        }).trigger('reloadGrid');
    });

    function initGrid(){
        var grid_row = Public.setGrid();
        var colModel = [
            {
                "name": "operate",
                "label": "添加",
                "width": 120,
                "sortable": false,
                "search": false,
                "fixed": true,
                "align": "center",
                "title": false,
                "formatter": handle.operFmatter
            },
            {
                'name':'common_id',
                'index':'common_id',
                'label':'商品id',
                'classes':'ui-ellipsis',
                'align':'center',
                'title':false,
                'fixed':true,
                'width':100,
            },
            {
                'name':'common_image',
                'index':'common_image',
                'label':'商品图片',
                'classes':'ui-ellipsis',
                'align':'center',
                'title':false,
                'fixed':true,
                'width':100,
                'formatter':handle.imageFmatter,

            },
            {
                'name':'common_name',
                'index':'common_name',
                'label':'商品名称',
                'classes':'ui-ellipsis',
                'align':'center',
                'title':false,
                'fixed':true,
                'width':500
            },
            {
                'name':'common_price',
                'index':'common_price',
                'label':'商品价格',
                'classes':'ui-ellipsis',
                'align':'center',
                'title':false,
                'fixed':true,
                'width':200
            },
            {
                'name':'common_stock',
                'index':'common_stock',
                'label':'商品库存',
                'classes':'ui-ellipsis',
                'align':'center',
                'title':false,
                'fixed':true,
                'width':200
            }
        ]

        $('#grid').jqGrid({
            url: SITE_URL + '?ctl=Goods_Goods&met=listCommon&typ=json',
            postData: {unlike:1},
            datatype: 'json',
            autowidth: true,
            shrinkToFit: false,
            forceFit: true,
            width: grid_row.w,
            height: grid_row.h,
            altRows: true,
            gridview: true,
            colModel: colModel,
            pager: '#page',
            viewrecords: true,
            cmTemplate: {
                sortable: true
            },
            rowNum: 30,
            rowList: [50, 100, 200],
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
            resizeStop: function(newwidth, index) {}
        }).navGrid('#page', {
            edit: false,
            add: false,
            del: false,
            search: false,
            refresh: false
        });

    }
    initGrid();



})