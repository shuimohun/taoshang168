<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
// var_dump($this->view->js_com);die;
include $this->view->getTplPath() . '/'  . 'header.php';
?>
<!-- <script src="./shop_admin/static/default/js/controllers/sta/highcharts.js"></script> -->
<head>
<link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/cs/highcharts.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/cs/flexigrid.js" charset="utf-8"></script>
<link href="<?= $this->view->css_com ?>/jquery/plugins/datepicker/dateTimePicker.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.datetimepicker.js" charset="utf-8"></script>
<style>
   #container {
        min-width: 310px;
        max-width: 100%;
        height: 400px;
        margin: 0 auto
}
</style>
</head>
<body>
<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>营销分析</h3>
                <h5>平台针对营销促销情况的各项数据统计</h5>
            </div>
            <ul class="tab-base nc-row">
                <li><a class="current"><span>促销统计</span></a></li>
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
            <li>走势图展现了各种促销活动时间段内有效订单的下单量、下单总金额、下单商品数走势对比</li>
            <li>饼图则展现了各种促销活动时间段内有效订单的下单量、下单总金额、下单商品数占总数的比例</li>
            <li>统计列表则清晰的展现了各种促销活动的下单量、下单总金额、下单商品数的总数值</li>
    </div>
    <div id="stat_tabs" class=" ui-tabs" style="min-height:400px">
        <ul class="tab-base nc-row">
            <li style="background: #DEDEDE"><a href="#orderamount_div" nc_type="showdata" data-param='{"type":"orderamount"}'>下单金额</a></li>
            <li style="background: #DEDEDE"><a href="#goodsnum_div" nc_type="showdata" data-param='{"type":"goodsnum"}'>下单商品数</a></li>
            <li style="background: #DEDEDE"><a href="#ordernum_div" nc_type="showdata" data-param='{"type":"ordernum"}'>下单量</a></li>
        </ul>

        <!-- 下单金额 -->
        <div id="orderamount_div" class="" style="text-align:center;"></div>
        <!-- 下单商品数 -->
        <div id="goodsnum_div" class="" style="text-align:center;"></div>
        <!-- 下单量 -->
        <div id="ordernum_div" class="" style="text-align:center;"></div>
        <div class="wrapper">
            <div class="mod-search cf">
                <div id="container" style="max-height:400px;margin-bottom:20px;"></div>
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

    function getStatdata(type){
        //店铺分类
//        var choose_gcid = $("# choose_gcid").val();
        $.ajax({
            url: SITE_URL + '?ctl=Seller_Marketing&met=marketing&typ=json&type='+type,
            data: '',
            success: function(e) {
                $('#container').highcharts(e.data);
            }
        });
    }
    function getStatdatas() {
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
                    {label:'操作',name:'operating', width : 120,"classes": "ui-ellipsis",  width:100, align:"center","formatter": operFmatter},
                    {label: '小时', name : 'timetext', width : 150, sortable : false, align: 'center'},
                    {label: '昨天', name : 'updata', width : 200, sortable : false, align: 'center'},
                    {label: '今天', name : 'currentdata', width : 250, sortable : false, align: 'center'},
                    {label: '同比', name : 'tbrate', width : 250, sortable : false, align: 'center'},
                    {label: '总结同比', name : 'tbrateSum', width : 250, sortable : false, align: 'center'},
                ];

                this.mod_PageConfig.gridReg('grid', colModel);
                colModel = this.mod_PageConfig.conf.grids['grid'].colModel;

                $("#grid").jqGrid({
                    url: SITE_URL + '?ctl=Seller_Marketing&met=demo&typ=json',
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
                        root: "data.data",
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
                    html_con = '<div class="operating" data-dis="1" data-time="' + row.seartime + '"><span class="ui-icon ui-icon-search" title="查看">查看</span></div>';
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
                    THISPAGE.reloadData(queryConditions);
                });
                $("#grid").on("click", ".operating .ui-icon-search", function (t)
                {
                    t.preventDefault();
                    var e = $(this).parent().data("time");
                    handle.del(e);
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
    var handle = {
     del: function (t)
        {
            window.location.href= "<?= YLB_Registry::get('url') ?>?ctl=Seller_Vip&met=vip_showmember&seartime="+ t;
        }
    };


    $(function () {
        //加载统计数据
        getStatdata('orderamount');
        $("[nc_type='showdata']").click(function(){
            var data_str = $(this).attr('data-param');
            eval('data_str = '+data_str);
            getStatdata(data_str.type);
        });
        getStatdatas();
    });
</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>



