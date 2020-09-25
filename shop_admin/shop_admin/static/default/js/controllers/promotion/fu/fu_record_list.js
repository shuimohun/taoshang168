/**
 * Created by Zhenzh.
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
        this.mod_PageConfig = Public.mod_PageConfig.init('fu-list');//页面配置初始化
        this.initDom();
        this.loadGrid();
        this.addEvent();
    },
    initDom: function(){
        this.$_fu_name = $('#fu_name');
        this.$_shop_name = $('#shop_name');
        this.$_fu_name.placeholder();
        this.$_shop_name.placeholder();
    },
    loadGrid: function(){
        var gridWH = Public.setGrid(), _self = this;
        var colModel = [
            {name:'user_name', label:'用户名称',  width:100, align:"center"},
            {name:'shop_name', label:'店铺名称', width:150, align:"center","formatter": handle.linkShopFormatter},
            {name:'goods_name', label:'商品名称', width:200, align:"center","formatter": handle.linkGoodsFormatter},
            {name:'goods_image', label: "图片", formatter:online_imgFmt,align: "center", width: 150},
            {name:'goods_price', label:'商品价格',  width:100, align:"center",formatter:num_format},

            /*{name:'fu_price', label:'价格',  width:100, align:"center",formatter:num_format2},*/

            {name:'weixin', label:'微信好友',  width:100, align:"center"},
            {name:'weixin_timeline', label:'微信朋友圈',  width:100, align:"center"},
            {name:'sqq', label:'QQ好友',  width:100, align:"center"},
            {name:'qzone', label:'QQ空间',  width:100, align:"center"},
            {name:'tsina', label:'新浪微博',  width:100, align:"center"},

            {name:'status_con', label:'状态',  width:100, align:"center"},
        ];
        this.mod_PageConfig.gridReg('grid', colModel);
        colModel = this.mod_PageConfig.conf.grids['grid'].colModel;

        $("#grid").jqGrid({
            url: SITE_URL + '?ctl=Promotion_Fu&met=getFuRecordList&typ=json',
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
            sortname: 'fu_id',
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
                id: "fu_id"
            },
            loadComplete:function (e) {
                //console.log(e.data)
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

        function num_format (val, opt, row) {
            return val.toFixed(2);
        };
        function online_imgFmt(val, opt, row){
            var val = '<a href="'+SHOP_URL+'?ctl=Goods_Goods&met=goods&gid='+row.goods_id+'&typ=e" target="_blank"><img src="'+val+'" style="width:40px;height:40px;"></a>';
            return val;
        };
    },
    reloadData: function(data){
        $("#grid").jqGrid('setGridParam',{postData: data}).trigger("reloadGrid");
    },
    addEvent: function(){
        var _self = this;
        //编辑
        $('.grid-wrap').on('click', '.ui-icon-pencil', function(e){
            e.preventDefault();
            var e = $(this).parent().data("id");
            handle.operate("edit", e)
        });

        //搜索
        $('#search').click(function(){
            queryConditions.status = $source.getValue();
            THISPAGE.reloadData(queryConditions);
        });

        //刷新
        $("#btn-refresh").click(function (){
            THISPAGE.reloadData('');
            _self.$_fu_name.val('');
            _self.$_shop_name.val('');
        });

        //删除
        $("#grid").on("click", ".operating .ui-icon-trash", function (t){
            t.preventDefault();
            var e = $(this).parent().data("id");
            handle.del(e)
        });

        //取消
        $("#grid").on("click", ".operating .ui-icon-close", function (t) {
            if($(this).parent().attr('data-dis'))
            {
                return false;
            }
            else
            {
                t.preventDefault();
                var e = $(this).parent().data("id");
                handle.operate("cancel", e)
            }

        });

        //跳转到店铺认证信息页面
        $('#grid').on('click', '.to-shop', function(e) {
            e.stopPropagation();
            e.preventDefault();
            var shop_id = $(this).attr('data-id');
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
    linkGoodsFormatter:function(val, opt, row){
        return '<a href="'+SHOP_URL+'?ctl=Goods_Goods&met=goods&gid='+row.goods_id+'&typ=e" target="_blank">' + val + '</a>';
    },
    linkShopFormatter: function(val, opt, row) {
        return '<a href="javascript:void(0)"><span class="to-shop" data-id="' + row.shop_id + '">' + val + '</span></a>';
    },
    operate: function (t, e){
        if ("edit" == t){
            /*var i = "修改推荐类型", a = {oper: t, rowData: $("#grid").jqGrid('getRowData',e), callback: this.callback};
            $.dialog({
                title: i,
                content: "url:"+SITE_URL + '?ctl=Promotion_Fu&met=getFuTempInfo&id='+ e,
                data: a,
                width: 500,
                height: 300,
                max: !1,
                min: !1,
                cache: !1,
                lock: !0
            })*/
        }
        else if("cancel" == t){
            $.dialog.confirm("活动取消后将不能恢复，请确认是否取消？", function ()
            {
                Public.ajaxPost(SITE_URL + '?ctl=Promotion_Fu&met=cancelFu&typ=json', {fu_id: e}, function (d)
                {
                    if (d && 200 == d.status)
                    {
                        parent.Public.tips({content: "操作成功！"});

                        d.data['operating'] = '';
                        $("#grid").jqGrid("setRowData", e , d.data);

                    }
                    else
                    {
                        parent.Public.tips({type: 1, content: "操作失败！" + d.msg})
                    }
                })
            })
        }
    },
    del: function (t){
        $.dialog.confirm("删除的活动将不能恢复，请确认是否删除？", function (){
            Public.ajaxPost(SITE_URL + '?ctl=Promotion_Fu&met=removeFu&typ=json', {fu_id: t}, function (e)
            {
                if (e && 200 == e.status)
                {
                    parent.Public.tips({content: "活动删除成功！"});
                    $("#grid").jqGrid("delRowData", t)
                }
                else
                {
                    parent.Public.tips({type: 1, content: "活动删除失败！" + e.msg})
                }
            })
        })
    },
    callback: function (t, e, i){
        var a = $("#grid").data("gridData");
        if (!a)
        {
            a = {};
            $("#grid").data("gridData", a)
        }
        a[t.fu_id] = t;
        if ("edit" == e)
        {
            $("#grid").jqGrid("setRowData", t.fu_id, t);
            i && i.api.close()
        }
        else
        {
            $("#grid").jqGrid("addRowData", t.fu_id, t, "last");
            i && i.api.close()
        }
    }
};

$(function(){
    $source = $("#source").combo({
     data: [{
     id: "0",
     name: "活动状态"
     },{
     id: "1",
     name: "进行中"
     },{
     id: "2",
     name: "成功未提交"
     },{
     id: "3",
     name: "送福购买"
     },{
         id: "4",
         name: "免单成功"
     },{
         id: "5",
         name: "失败"
     }],
     value: "id",
     text: "name",
     width: 110
     }).getCombo();

    THISPAGE.init();

});

