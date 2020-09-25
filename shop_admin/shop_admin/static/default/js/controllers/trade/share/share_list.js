var queryConditions = {},
    hiddenAmount = false,
    SYSTEM = system = parent.SYSTEM;

var THISPAGE = {
    init: function(data) {
        if (SYSTEM.isAdmin === false && !SYSTEM.rights.AMOUNT_COSTAMOUNT) {
            hiddenAmount = true;
        };
        this.mod_PageConfig = Public.mod_PageConfig.init('other-income-list'); //页面配置初始化
        this.initDom();
        this.loadGrid();
        this.addEvent();
    },

    initDom: function() {
        this.$_searchName = $('#searchName');

        $('#filter-fromDate').datetimepicker({
            lang: 'ch'
        }).prop('readonly', 'readnoly');
        $('#filter-toDate').datetimepicker({
            lang: 'ch'
        }).prop('readonly', 'readnoly');
    },

    loadGrid: function() {
        var gridWH = Public.setGrid(),
            _self = this;

        var colModel = [
            {
                name: 'share_num',
                label: '分享编号',
                width: 200,
                align: "center"
            }, {
                name: 'user_account',
                label: '分享账号',
                width: 120,
                align: "center"
            }, {
                name: 'share_date_str',
                label: '分享时间',
                width: 130,
                align: 'center'
            }, {
                name: 'goods_name',
                label: '分享商品',
                width: 150,
                align: 'center',
                formatter:goodsFmatter

            }, {
                name: 'common_id',
                label: '商品SPU',
                width: 80,
                align: 'center'
            }, {
                name: 'weixin',
                label: '微信好友立减(元)',
                width: 100,
                align: 'center'
            }, {
                name: 'weixin_timeline',
                label: '朋友圈立减(元)',
                width: 100,
                align: 'center'
            }, {
                name: 'sqq',
                label: 'QQ好友立减(元)',
                width: 100,
                align: 'center'
            }, {
                name: 'qzone',
                label: 'QQ空间立减(元)',
                width: 100,
                align: 'center'
            }, {
                name: 'tsina',
                label: '新浪微博立减(元)',
                width: 100,
                align: 'center'
            }, {
                name: 'promotion_unit_price',
                label: '点击分享金(元)',
                width: 100,
                align: 'center'
            }, {
                name: 'promotion_click_count',
                label: '点击统计(次)',
                width: 100,
                align: 'center'
            }, {
                name: 'share_click_price',
                label: '点击分享金小计(元)',
                width: 120,
                align: 'center'
            }, {
                name: 'promotion_total_price',
                label: '点击分享金上限(元)',
                width: 120,
                align: 'center'
            }, {
                name: 'shop_name',
                label: '店铺名称',
                width: 120,
                align: 'center'
            }, {
                name: 'shop_id',
                label: '店铺id',
                width: 80,
                align: 'center'
            }, {
                name: 'share_order_id',
                label: '订单编号',
                width: 200,
                align: "center"
            }, {
                name: 'payment_time',
                label: '支付时间',
                width: 130,
                align: "center"
            }, {
                name: 'order_status_str',
                label: '订单状态',
                width: 120,
                align: "center"
            }, {
                name: 'order_payment_amount',
                label: '订单金额(元)',
                width: 100,
                align: "center"
            }, {
                name: 'order_finished_time',
                label: '订单完结时间',
                width: 130,
                align: "center"
            },
        ];

        function goodsFmatter (val, opt, row) {
            return '<a href="'+SHOP_URL+'?ctl=Goods_Goods&met=goods&cid='+row.common_id+'" target="_blank"><span>' + val + '</span></a>';
        }

        this.mod_PageConfig.gridReg('grid', colModel);
        colModel = this.mod_PageConfig.conf.grids['grid'].colModel;

        $("#grid").jqGrid({
            url: SITE_URL + '?ctl=Trade_Share&met=getShareList&typ=json',
            postData: queryConditions,
            datatype: "json",
            autowidth: true,
            //如果为ture时，则当表格在首次被创建时会根据父元素比例重新调整表格宽度。如果父元素宽度改变，为了使表格宽度能够自动调整则需要实现函数：setGridWidth
            height: gridWH.h,
            altRows: true,
            //设置隔行显示
            gridview: true,
            multiselect: true,
            multiboxonly: true,
            colModel: colModel,
            cmTemplate: {
                sortable: false,
                title: false
            },
            page: 1,
            sortname: 'id',
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
                repeatitems: false,
                total: "data.total",
                id: "id"
            },
            loadError: function(xhr, st, err) {

            },
            ondblClickRow: function(rowid, iRow, iCol, e) {
                $('#' + rowid).find('.ui-icon-pencil').trigger('click');
            },
            resizeStop: function(newwidth, index) {
                THISPAGE.mod_PageConfig.setGridWidthByIndex(newwidth, index, 'grid');
            }
        }).navGrid('#page', {
            edit: false,
            add: false,
            del: false,
            search: false,
            refresh: false
        }).navButtonAdd('#page', {
            caption: "",
            buttonicon: "ui-icon-config",
            onClickButton: function() {
                THISPAGE.mod_PageConfig.config();
            },
            position: "last"
        });
    },

    //重新加载数据
    reloadData: function(data) {
        $("#grid").jqGrid('setGridParam', {
            postData: data
        }).trigger("reloadGrid");
    },

    //增加事件
    addEvent: function() {
        var _self = this;

        //搜索
        $('#search').click(function() {
            queryConditions.order_status = $source.getValue();
            queryConditions.share_num = $('#share_num').val();
            queryConditions.order_id = $('#order_id').val();
            queryConditions.buyer_name = $('#buyer_name').val();
            queryConditions.shop_name = $('#shop_name').val();
            queryConditions.payment_number = $('#payment_number').val();
            if ($('#filter-fromDate').val()) {
                queryConditions.payment_date_f = $('#filter-fromDate').val();
            }
            if ($('#filter-toDate').val()) {
                queryConditions.payment_date_t = $('#filter-toDate').val();
            }

            THISPAGE.reloadData(queryConditions);
        });

        //刷新
        $("#btn-refresh").click(function() {
            THISPAGE.reloadData('');
            _self.$_searchName.placeholder('请输入相关数据...');
            _self.$_searchName.val('');
        });

        $(window).resize(function() {
            Public.resizeGrid();
        });
    }
};

$(function() {

    $source = $("#source").combo({
        data: [{
            id: "2",
            name: "已付款"
        }, {
            id: "-1",
            name: "全部"
        }, {
            id: "1",
            name: "待付款"
        }, {
            id: "3",
            name: "待发货"
        }, {
            id: "4",
            name: "已发货"
        }, {
            id: "5",
            name: "已签收"
        }, {
            id: "6",
            name: "已完成"
        }, {
            id: "7",
            name: "已取消"
        }],
        value: "id",
        text: "name",
        width: 110
    }).getCombo();

    THISPAGE.init();
});