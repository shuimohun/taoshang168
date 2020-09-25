$(function(){

    /**
     * 显示图片列 Dom
     * @param val
     * @param opt
     * @param row
     * @returns {*}
     */
    function imageFmatter(val, opt, row)
    {
        if (row.common_image) {
            val = '<img src="' + row.common_image + '" width="'+50+'" height="'+50+'">';
        } else {
            val = '&#160;';
        }
        return val;
    }

    /**
     * 显示操作列 Dom
     * @param val
     * @param opt
     * @param row
     * @returns {string}
     */
    function operFmatter(val,opt,row)
    {
        var html = "<span class='ui-icon ui-icon-trash unlike' data-id='"+row.id+"' ></span>";
        return html;
    }

    /**
     * 把商品从猜我喜欢移除 Action(ajax)
     * @param common_id
     * $author liuguilong 20170615
     */
    function unlike(common_id){
        $.dialog.confirm('确认把该商品从猜我喜欢删除吗？',function(){
            Public.ajaxPost(SITE_URL + '?ctl=Goods_Likes&met=unlike&met=unlike&typ=json',{common_id:common_id},function(data){
                if(data && data.status == 200){
                    parent.Public.tips({
                        content:'取消猜你喜欢成功！'
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

    /**
     * 把商品从猜我喜欢移除 Dom
     * $author liuguiong 20170615
     */
    $('#grid').on('click','.unlike',function(e){
        e.preventDefault();
        var common_id = $(this).data('id');
        unlike(common_id);
    });

    /**
     * 添加猜你喜欢
     */
    $('#btn-add').click(function(t){
        t.preventDefault();
        var defaultPage = Public.getDefaultPage();
        defaultPage.tab.addTabItem({
            tabid: "id",
            text: '添加商品',
            url: SITE_URL+'?ctl=Goods_Likes&met=addLike',
            showClose: true,
            data:data
        });
    });


    /**
     * 初始化grid，加载数据
     * @author liuguilong 20170615
     */
    function initGrid(){
        var grid_row = Public.setGrid();
        var colModel = [
            {
                "name": "operate",
                "label": "操作",
                "width": 120,
                "sortable": false,
                "search": false,
                "fixed": true,
                "align": "center",
                "title": false,
                "formatter": operFmatter
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
            'formatter':imageFmatter,

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
        ];

        $('#grid').jqGrid({
            url: SITE_URL + '?ctl=Goods_Likes&met=likesList&typ=json',
            postData: {},
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
            rowNum: 15,
            rowList: [30,50,80],
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
    initGrid();

});