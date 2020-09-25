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
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Business&met=Industry"><span>行业排行</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Business&met=price"><span>价格分析</span></a></li>
                <li><a class="current"><span>概况总览</span></a></li>
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
            <li>符合以下任何一种条件的订单即为有效订单：1、采用在线支付方式支付并且已付款；2、采用货到付款方式支付并且交易已完成</li>

            <li>列表展示了搜索类目下子分类的商品数和从昨天开始最近30天该子分类有效订单的销售数据，并可以点击列表上方的“导出数据”将列表数据导出为Excel文件</li>

            <li>默认按照“销售额”降序排列</li>
    </div>
        <div class="mod-search cf" style="margin-top:20px;margin-left: 20px">
            <div class="fl" >
                <ul class="ul-inline">
                    <li>
                        <span id="goods_cat"></span>
                    </li>
                    <li> <a class="ui-btn" id="search">查询<i class="iconfont icon-btn02"></i></a></li>
                    <div class="fl">
                        <div class="fr">
                            <a class="ui-btn" id="btn-excel">导出<i class="iconfont icon-btn04"></i></a>
                            <a class="ui-btn" id="btn-refresh">刷新<i class="iconfont icon-btn01"></i></a>
                        </div>
                    </div>
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
                    {label:'操作',name:'--', width : 120, sortable : false,formatter:operFmatter,align: 'center', className: 'handle-s'},
                    {label: '类目名称', name : 'cat_name', width : 150, sortable : false, align: 'center'},
                    {label: '平均价格（元）', name : 'average_price', width : 200, sortable : false, align: 'center'},
//                    {label: '有销量商品数', name : 'There_are_sales', width : 250, sortable : false, align: 'center'},
                    {label: '销量', name : 'sales_volume', width : 250, sortable : false, align: 'center'},
                    {label: '销售额（元）', name : 'saleroom', width : 250, sortable : false, align: 'center'},
                    {label: '商品总数', name : 'goods_count', width : 250, sortable : false, align: 'center'},
//                    {label: '无销量商品数', name : 'But_no_sales', width : 250, sortable : false, align: 'center'}
                ];
                this.mod_PageConfig.gridReg('grid', colModel);
                colModel = this.mod_PageConfig.conf.grids['grid'].colModel;

                $("#grid").jqGrid({
                    url: SITE_URL + '?ctl=Seller_Business&met=survey1&typ=json',
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
                        records: "records",
                        repeatitems : false,
                        total : "total",
                        id: "cat_id"
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

                $(window).resize(function(){
                    Public.resizeGrid();
                });
            }
        };
        $(function(){
            THISPAGE.init();
        });



    $(function () {
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
            //搜索
            $('#search').click(function()
            {
                a.preventDefault();
                var cat_id = categoryTree.getValue();
                $("#grid").jqGrid("setGridParam", {page: 1, postData: { cat_id:cat_id}}).trigger("reloadGrid")
            });
            $("#btn-excel").click(function ()
            {
                var query = "";
                for (x in queryConditions)
                {
                    query = query + "&" + x + "=" + queryConditions[x];
                }
                window.open(SHOP_URL + "?ctl=Api_Seller_Business&met=getReturnAllExcels&debug=1"+query);
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
    });
</script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>





