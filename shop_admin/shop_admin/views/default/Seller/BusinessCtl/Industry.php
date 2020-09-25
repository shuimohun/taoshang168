<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/'  . 'header.php';
?>
<link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
  <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
  <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
  <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/cs/highcharts.js" charset="utf-8"></script>
  <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/cs/flexigrid.js" charset="utf-8"></script>
<link href="<?= $this->view->css_com ?>/jquery/plugins/datepicker/dateTimePicker.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.datetimepicker.js" charset="utf-8"></script>
</head>
<body>
<div class="wrapper page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>行业分析</h3>
                <h5>平台针对商品的各项数据统计</h5>
            </div>
            <ul class="tab-base nc-row">
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Business&met=business"><span>行业规模</span></a></li>
                <li><a class="current"><span>行业排行</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Business&met=price"><span>价格分析</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Business&met=survey"><span>概况总览</span></a></li>
            </ul>
        </div>
    </div>
    <!-- 操作说明 -->
    <p class="warn_xiaoma"><span></span><em></em></p>
    <div class="explanation" id="explanation">
        <div class="title" id="checkZoom"><i class="iconfont icon-lamp"></i>
            <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
            <span id="explanationZoom" title="收起提示"></span><em class="close_warn">X</em>
        </div>
        <ul>
            <li>在页面右侧可以选择不同的商品分类和时间查询数据</li>
            <li>统计某行业在不同时间段下单量前50名商品和前30名店铺</li>
    </div>
    <div class="mod-toolbar-top cf" style="margin-top:10px">
        <div class="left">
            <div id="assisting-category-select" class="ui-tab-select">
                <ul class="ul-inline">
                    <li>
                        <input id="start_time" class="ui-input ui-datepicker-input" type="text" readonly placeholder="时间查询"/>
                        至
                        <input id="end_time" class="ui-input ui-datepicker-input" type="text"  readonly placeholder="结束时间"/>
                    <li>
                        <span id="goods_cat"></span>
                    </li>
                    <li><a class="ui-btn" id="search">查询<i class="iconfont icon-btn02"></i></a></li>
                    <li><a class="ui-btn ui-btn-sp" id="btn-refresh">刷新<i class="iconfont icon-btn01"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="wrapper">
         <div class="mod-search cf">
               <div id="container" style="max-height:400px;margin-bottom:20px;"></div>
                    <div class="grid-wrap">
                        <table id="grid"></table>
                    </div>
                    <div id="container1" style="max-height:400px;margin-bottom:20px;"></div>
                    <div class="grid-wrap1">
                        <table id="grid1"></table>
                    </div>
         </div>
    </div>
</div>
</body>

<script>

    function getStatdata(type,start_time,end_time,cat_id){
        //店铺分类
//        var choose_gcid = $("# choose_gcid").val();
        $.ajax({
            url: SITE_URL + '?ctl=Seller_Business&met=info&typ=json&type='+type+"&start_time="+start_time+"&end_time="+end_time+"&cat_id="+cat_id,
            data: '',
            success: function(e) {
                $('#container').highcharts(e.data);
            }
        });
    }
    function getStatdats(type,start_time,end_time,cat_id){
        //店铺分类
//        var choose_gcid = $("#choose_gcid").val();
        $.ajax({
            url: SITE_URL + '?ctl=Seller_Business&met=infos&typ=json&type='+type+"&start_time="+start_time+"&end_time="+end_time+"&cat_id="+cat_id,
            data: '',
            success: function(e) {
                $('#container1').highcharts(e.data);
            }
        });
    }
    function getStatdatas(type) {
         if(type=='goodsnum'){
            sps = '下单商品数';
            b = 'goodsnum';
        }

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
                    {label:'操作',name:'--', width : 120, sortable : false,formatter:operFmatter,align: 'center', className: 'handle-s'},
                    {label: '序号', name : 'order_id', width : 150, sortable : false, align: 'center'},
                    {label: '商品名称', name : 'goods_name', width : 200, sortable : false, align: 'center'},
                    {label: sps, name : b, width : 250, sortable : false, align: 'center'}
                ];

                this.mod_PageConfig.gridReg('grid', colModel);
                colModel = this.mod_PageConfig.conf.grids['grid'].colModel;

                $("#grid").jqGrid({
                    url: SITE_URL + '?ctl=Seller_Business&met=demo&typ=json&type='+type+'&_'+ (new Date()).getTime(),
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
                        id: "goods_id"
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
                    html_con = '<div class="operating" data-id="' + row.order_return_id + '"><span  title="--">--</span></div>';
                    return html_con;
                };
            },

            reloadData: function(data){
                $("#grid").jqGrid('setGridParam',{postData: data}).trigger("reloadGrid");
            },
            addEvent: function(){
                var _self = this;
                //搜索
                $('#search').click(function()
                {
                    queryConditions.start_time = $('#start_time').val();
                    queryConditions.end_time = $('#end_time').val();
                    queryConditions.cat_id = categoryTree.getValue();
                    THISPAGE.reloadData(queryConditions);
                });
                //刷新
                $("#btn-refresh").click(function ()
                {
                    queryConditions.start_time = '';
                    queryConditions.end_time = '';
                    THISPAGE.reloadData(queryConditions);
                });
                $(window).resize(function(){
                    Public.resizeGrid();
                });
            }
        };
        $(function(){
            THISPAGE.init();
        });
    }
    function getStatdat(type) {

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
                    {label: '序号', name : 'order_id', width : 150, sortable : false, align: 'center'},
                    {label: '店铺名称', name : 'shop_name', width : 200, sortable : false, align: 'center'},
                    {label: '下单量', name : 'goodsnum', width : 250, sortable : false, align: 'center'}
                ];

                this.mod_PageConfig.gridReg('grid', colModel);
                colModel = this.mod_PageConfig.conf.grids['grid'].colModel;

                $("#grid1").jqGrid({
                    url: SITE_URL + '?ctl=Seller_Business&met=demo1&typ=json&type='+type+'&_'+ (new Date()).getTime(),
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
                    pager: "#page1",
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
                $("#grid1").jqGrid('setGridParam',{postData: data}).trigger("reloadGrid");
            },
            addEvent: function(){
                var _self = this;
                //搜索
                $('#search').click(function()
                {
                    queryConditions.start_time = $('#start_time').val();
                    queryConditions.end_time = $('#end_time').val();
                    queryConditions.cat_id = categoryTree.getValue();
                    THISPAGE.reloadData(queryConditions);
                });
                //刷新
                $("#btn-refresh").click(function ()
                {
                    queryConditions.start_time = '';
                    queryConditions.end_time = '';
                    THISPAGE.reloadData(queryConditions);
                });
            }
        };
        $(function(){
            THISPAGE.init();
        });
    }

    $(function () {
        var combo_end_time = '2030-06-11 00:00:00';
        var maxdate =  new Date(Date.parse(combo_end_time.replace(/-/g, "/")));
        $('#start_time').datetimepicker({
            controlType: 'select',
//            minDate:new Date(),
        });

        $('#end_time').datetimepicker({
            controlType: 'select',
        });

        function initEvent()
        {
            $_matchCon = $("#matchCon"),
                $_matchCon.placeholder(),
                $("#search").on("click", function (a)
                {
                    a.preventDefault();
                    var cat_id = categoryTree.getValue();
                    $("#grid").jqGrid("setGridParam", {page: 1, postData: { cat_id:cat_id}}).trigger("reloadGrid")
                });

            $("#grid").on("click", ".operating .ui-icon-pencil", function (t)
            {
                t.preventDefault();
                if (Business.verifyRight("INVLOCTION_UPDATE"))
                {
                    var e = $(this).parent().data("id");
                    handle.operate("edit", e)
                }
            });

            $("#grid").on("click", ".operating .ui-icon-trash", function (t)
            {
                t.preventDefault();
                if (Business.verifyRight("INVLOCTION_DELETE"))
                {
                    var e = $(this).parent().data("id");
                    handle.del(e)
                }
            });

            $(window).resize(function ()
            {
                Public.resizeGrid()
            })
        }
        function initFilter()
        {
            //查询条件
            Business.filterBrand();

            //商品类别
            var opts = {
                width : 200,
                //inputWidth : (SYSTEM.enableStorage ? 145 : 208),
                inputWidth : 145,
                defaultSelectValue : '-1',
                //defaultSelectValue : rowData.categoryId || '',
                showRoot : true
            }

            categoryTree = Public.categoryTree($('#goods_cat'), opts);

        }
        initFilter();
        initEvent();
        getStatdata('goodsnum');
        getStatdatas('goodsnum');
        getStatdats('goodsnum');
        getStatdat('goodsnum');
        $('#search').click(function()
        {
            var start_time = $('#start_time').val();
            var end_time = $('#end_time').val();
            var cat_id = categoryTree.getValue();
            getStatdata('goodsnum',start_time,end_time,cat_id);
            getStatdats('goodsnum',start_time,end_time,cat_id);
        });
    });
</script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
<style>
    .tdd{
        border: 1px #E2E2E2 solid;
        text-align: center;
        width: 33px
    }
    .tddd{
        text-align: center;
        border: 1px #E2E2E2 solid;
        width: 33px
    }
</style>




