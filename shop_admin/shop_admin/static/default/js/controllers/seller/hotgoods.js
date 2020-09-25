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
            {label: '序号', name : 'order_number', width : 130, sortable : false, align: 'center'},
            {label: '商品名称', name : 'order_goods_name', width : 150, sortable : false, align: 'center'},
            {label: '下单金额', name : 'buyer_user_account', width : 80, sortable : false, align: 'center'}
            // {label: '商家审核', name : 'seller_state',  width : 120, sortable : false, align: 'center'},
            // {label: '平台确认', name : 'refund_state',  width : 120, sortable : false, align: 'center'}
        ];

        this.mod_PageConfig.gridReg('grid', colModel);
        colModel = this.mod_PageConfig.conf.grids['grid'].colModel;
        $("#grid").jqGrid({
            url: SITE_URL + '?ctl=Seller_Service&met=demo&typ=json',
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
                id: "order_return_id"
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
            queryConditions.start_time = $('#start_time').val();
            queryConditions.end_time = $('#end_time').val();
            THISPAGE.reloadData(queryConditions);
        });

        //刷新
        $("#btn-refresh").click(function ()
        {
                queryConditions.start_time ='';
                queryConditions.end_time ='';

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
                window.open(SHOP_URL + "?ctl=Api_Seller_Service&met=getReturnAllExcel&debug=1"+query);
            });

        //删除
        $("#grid").on("click", ".operating .ui-icon-trash", function (t)
        {
            t.preventDefault();
            var e = $(this).parent().data("id");
            handle.del(e);
            
        });

   
        //跳转到店铺认证信息页面
        $('#grid').on('click', '.to-shop', function(e) {
            e.stopPropagation();
            e.preventDefault();

            var shop_id = $(this).attr('data-id');
            alert(shop_id);
            $.dialog({
                title: '查看店铺信息',
                content: "url:"+SITE_URL + '?ctl=Shop_Manage&met=getShoplist&shop_id=' + shop_id,
                width: 950,
                height: $(window).height() * 0.9,
                max: !1,
                min: !1,
                cache: !1,
                lock: !0
            })
        });

        $(window).resize(function(){
            Public.resizeGrid();
        });
    }
};
    

var handle = {
   callback: function (t, e, i)
    {
        var a = $("#grid").data("gridData");
        if (!a)
        {
            a = {};
            $("#grid").data("gridData", a)
        }
        a[t.price_id] = t;
        if ("edit" == e)
        {
            $("#grid").jqGrid("setRowData", t.price_id, t);
            i && i.api.close()

        }
        else
        {
            $("#grid").jqGrid("addRowData", t.price_id, t, "last");
            i && i.api.close()
        }
    }, del: function (t)
    {
        $.dialog.confirm("删除的活动将不能恢复，请确认是否删除？", function ()
        {
            Public.ajaxPost(SITE_URL + '?ctl=Promotion_Price&met=removePriceAct&typ=json', {price_id: t}, function (e)
            {
                //alert(JSON.stringify(e));
                if (e && 200 == e.status)
                {
                    parent.Public.tips({content: "活动商品删除成功！"});
                    $("#grid").jqGrid("delRowData", t)
                }
                else
                {
                    parent.Public.tips({type: 1, content: "活动商品删除失败！" + e.msg})
                }
            })
        })
    }
};

$(function(){
    $source = $("#source").combo({
			data: [{
				id: "0",
				name: "活动状态"
			},{
				id: "1",
				name: "正常"
			},{
				id: "2",
				name: "已结束"
			}
			,{
				id: "3",
				name: "管理员关闭"
			}],
			value: "id",
			text: "name",
			width: 110
		}).getCombo();

    THISPAGE.init();

});