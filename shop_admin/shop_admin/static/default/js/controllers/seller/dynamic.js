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
            {label: '店铺名称', name : 'shop_name', width : 130, sortable : false, align: 'center'},
            {label: '描述相符度', name : 'evaluation_desccredit', width : 150, sortable : false, align: 'center'},
            {label: '服务态度', name : 'evaluation_servicecredit',  width : 120, sortable : false, align: 'center'},
            {label: '物流速度', name : 'evaluation_deliverycredit', width : 150, sortable : false, align: 'center'},
            {label: '综合评分', name : 'evaluation_count', width : 150, sortable : false, align: 'center'}
        ];

        this.mod_PageConfig.gridReg('grid', colModel);
        colModel = this.mod_PageConfig.conf.grids['grid'].colModel;
        $("#grid").jqGrid({
            url: SITE_URL + '?ctl=Seller_Service&met=dynamic1&typ=json',
            postData: queryConditions,
            datatype: "json",
            autowidth: true,//如果为ture时，则当表格在首次被创建时会根据父元素比例重新调整表格宽度。如果父元素宽度改变，为了使表格宽度能够自动调整则需要实现函数：setGridWidth
            height: gridWH.h,
            altRows: true, //设置隔行显示
            gridview: true,
            multiselect: true,
            multiboxonly: true,
            colModel:colModel,
            cmTemplate: {sortable: false, title: false},
            page: 1,
            sortname: 'number',
            sortorder: "desc",
            pager: "#page",
            rowNum: 25,
            rowList:[10,50,100],
            viewrecords: true,
            shrinkToFit: false,
            forceFit: true,
            jsonReader: {
                root: "data",
                records: "data.records",
                repeatitems : false,
                total : "data.total",
                id: "shop_id"
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
        // alert(data);
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
            queryConditions.evaluation_desccredit = $('#evaluation_desccredit').val();
            queryConditions.evaluation_servicecredit = $('#evaluation_servicecredit').val();
            queryConditions.evaluation_deliverycredit = $('#evaluation_deliverycredit').val();
            THISPAGE.reloadData(queryConditions);
        });

        //刷新
        $("#btn-refresh").click(function ()
        {
               queryConditions.evaluation_desccredit = '';
            queryConditions.evaluation_servicecredit = '';
            queryConditions.evaluation_deliverycredit = '';

                THISPAGE.reloadData(queryConditions);
        });
        //EXCEl
        //
        $("#btn-excel").click(function ()
            {
                var query = "";
                for (x in queryConditions)
                {
                    query = query + "&" + x + "=" + queryConditions[x];
                }
                window.open(SHOP_URL + "?ctl=Api_Seller_Service&met=getReturnAllExcels&debug=1"+query);
            });

        $(window).resize(function(){
            Public.resizeGrid();
        });
    }
};
    
