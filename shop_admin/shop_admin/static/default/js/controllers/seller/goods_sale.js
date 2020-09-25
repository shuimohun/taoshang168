/**
 * Created by Administrator on 2016/5/18.
 */
var queryConditions = {

    },
    hiddenAmount = false,
    SYSTEM = system = parent.SYSTEM;
var THISPAGE = {
    init: function(data){
        if (SYSTEM.isAdmin === false && !SYSTEM.rights.AMOUNT_COSTAMOUNT) {
            hiddenAmount = true;
        };
        this.mod_PageConfig = Public.mod_PageConfig.init('man-song-list');//页面配置初始化
        this.initDom();
        this.loadGrid();
        this.addEvent();
    },
    initDom: function()
    {
        this.$_goods_name = $('#goods_name');
        this.$_goods_name.placeholder();
    },
    loadGrid: function(){
        var gridWH = Public.setGrid(), _self = this;
        var colModel = [
            {label:'操作',name:'operating', width : 120, sortable : false,formatter:operFmatter,align: 'center', className: 'handle-s'},
            {label: '商品名称', name : 'goods_name', width : 130, sortable : false, align: 'center'},
            {label: '店铺名称', name : 'shop_name', width : 150, sortable : false, align: 'center'},
            {label: 'SPU', name : 'order_id',  width : 120, sortable : false, align: 'center'},
            {label: '下单商品件数', name : 'order_goods_num', width : 150, sortable : false, align: 'center'},
            {label: '下单单量', name : 'order_goods_count', width : 150, sortable : false, align: 'center'},
            {label: '下单金额', name : 'order_goods_amount', width : 150, sortable : false, align: 'center'},
            {label: '时间', name : 'order_goods_time', width : 150, sortable : false, align: 'center'}
        ];

        this.mod_PageConfig.gridReg('grid', colModel);
        colModel = this.mod_PageConfig.conf.grids['grid'].colModel;
        // alert(SITE_URL + '?ctl=Seller_Goods&met=goods_sale&typ=json')
        $("#grid").jqGrid({
            url: SITE_URL + '?ctl=Seller_Goods&met=goods_sale1&typ=json',
            postData: queryConditions,
            datatype: "json",
            autowidth: true,//如果为ture时，则当表格在首次被创建时会根据父元素比例重新调整表格宽度。如果父元素宽度改变，为了使表格宽度能够自动调整则需要实现函数：setGridWidth
            height: gridWH.h,
            altRows: true, //设置隔行显示
            gridview: true,
            multiboxonly: true,
            colModel:colModel,
            cmTemplate: {sortable: false, title: false},
            page: 1,
            sortname: 'number',
            sortorder: "desc",
            pager: "#page",
            rowNum: 25,
            rowList: [25, 50, 100],
            viewrecords: true,
            shrinkToFit: false,
            forceFit: true,
            jsonReader: {
                root: "data.items",
                records: "data.records",
                repeatitems : false,
                total : "data.total",
                id: "order_id"
            },
            loadError : function(xhr,st,err) {

            },
            ondblClickRow : function(rowid, iRow, iCol, e){
                $('#' + rowid).find('.ui-icon-pencil').trigger('click');
            },
            resizeStop: function(newwidth, index){
                THISPAGE.mod_PageConfig.setGridWidthByIndex(newwidth, index, 'grid');
            }
        }).navGrid('#page',{edit:false,add:false,del:false,search:false,refresh:false}).navButtonAdd('#page',{
            caption:"",
            buttonicon:"ui-icon-config",
            onClickButton: function(){
                THISPAGE.mod_PageConfig.config();
            },
            position:"last"
        });

        function operFmatter (val, opt, row) {
            var html_con = '';
                html_con = '<div class="operating" data-id="' + row.order_return_id + '"><span class="ui-icon ui-icon-trash" title="--"></span></div>';
            return html_con;
        };
    },

    reloadData: function(data){
        $("#grid").jqGrid('setGridParam',{postData: data}).trigger("reloadGrid");
    },
    addEvent: function(){
        var _self = this;
        //编辑
        $('.grid-wrap').on('click', '.ui-icon-search', function(e){
            e.preventDefault();
            var e = $(this).parent().data("id");
            handle.operate("edit", e)
        });
        
        //搜索
        $('#search').click(function()
        {
            queryConditions.start_time = $('#start_time').val();
            queryConditions.end_time = $('#end_time').val();
            queryConditions.goods_name = $('#goods_name').val();
            THISPAGE.reloadData(queryConditions);
        });

        //刷新
        $("#btn-refresh").click(function ()
        {
                queryConditions.goods_name = '';
                queryConditions.start_time = '';
                queryConditions.end_time = '';
                THISPAGE.reloadData(queryConditions);
        });
        //EXCEl
        //
        $("#btn-excel").click(function ()
            {
                var start_time = $('#start_time').val();
                var end_time = $('#end_time').val();
                var goods_name = $('#goods_name').val();
                var query = "";
                for (x in queryConditions)
                {
                    query = query + "&" + x + "=" + queryConditions[x];
                }
                window.open(SHOP_URL + "?ctl=Api_Seller_Goods&met=getReturnAllExcels&debug=1&start_time="+start_time+"&end_time="+end_time+"goods_name="+goods_name);
            });

        $(window).resize(function(){
            Public.resizeGrid();
        });
    }
};
    
