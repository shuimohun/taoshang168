<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
// var_dump($this->view->js_com);die;
include $this->view->getTplPath() . '/'  . 'header.php';
?>
<link href="<?= $this->view->css ?>/cs/index.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>商品分析</h3>
                <h5>平台针对商品的各项数据统计</h5>
            </div>
            <ul class="tab-base nc-row">
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Vip&met=vip"><span>新增会员</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Vip&met=vip_analysis"><span>会员分析</span></a></li>
                <li><a class="current" ><span>会员规模分析</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Vip&met=vip_area"><span>区域分析</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Vip&met=vip_buy"><span>购买分析</span></a></li>
            </ul>
        </div>
        <div id="stat_tabs" class="  ui-tabs" style="min-height:500px">
            <div class="mod-search cf" style="margin-top:20px;margin-left: 20px">
                <div class="fl" >
                    <ul class="ul-inline">
                        <li>
                            <input type="text" id="matchCon" class="ui-input ui-input-ph matchCon" placeholder="按品牌名称" value="">
                        </li>
                        <li>
                            <span id="goods_cat"></span>
                        </li>
                        <li> <a class="ui-btn" id="search">查询<i class="iconfont icon-btn02"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="wrapper">
                <div class="mod-search cf">
                    <div class="grid-wrap">
                        <table id="grid"></table>
                        <div id="page"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

<script>
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
                    {label: '会员名称', name : 'order_id', width : 150, sortable : false, align: 'center'},
                    {label: '下单金额', name : 'goods_name', width : 200, sortable : false, align: 'center'},
                    {label: '增预存款', name : 'money', width : 250, sortable : false, align: 'center'},
                    {label: '减预存款', name : 'money', width : 250, sortable : false, align: 'center'},
                    {label: '增金蛋', name : 'money', width : 250, sortable : false, align: 'center'},
                    {label: '减金蛋', name : 'money', width : 250, sortable : false, align: 'center'}
                ];

                this.mod_PageConfig.gridReg('grid', colModel);
                colModel = this.mod_PageConfig.conf.grids['grid'].colModel;

                $("#grid").jqGrid({
                    url: SITE_URL + '?ctl=Seller_Goods&met=demo&typ=json&'&_+ (new Date()).getTime(),
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
                        root: "data",
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
                }).trigger('reloadGrid');

                function operFmatter (val, opt, row) {
                    var html_con = '';
                    html_con = '<div class="operating" data-id="' + row.order_return_id + '"><span title="--">--</span></div>';
                    return html_con;
                };
            },

            reloadData: function(data){
                // alert(data);
                $("#grid").jqGrid('setGridParam',{postData: data}).trigger("reloadGrid");
            },
            addEvent: function(){
                var _self = this;
                //搜索
                $('#search').click(function()
                {
                    queryConditions.start_time = $('#start_time').val();
                    queryConditions.end_time = $('#end_time').val();
                    THISPAGE.reloadData(queryConditions);
                });

                $(window).resize(function(){
                    Public.resizeGrid();
                });
            }
        };
</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>
