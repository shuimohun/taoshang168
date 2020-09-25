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
                <h3>店铺统计</h3>
                <h5>平台针对店铺的各项数据统计</h5>
            </div>
            <ul class="tab-base nc-row">
                <li><a class="current"><span>新增店铺</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Shop&met=best_seller"><span>热卖排行</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Shop&met=sales_statistics"><span>销售统计</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Shop&met=Store_level"><span>店铺等级</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Shop&met=regional_distribution"><span>地区分布</span></a></li>
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
            <li>统计图展示了时间段内新增店铺数的走势和与前一时间段的对比</li>
            <li>统计表展示了时间段内新增店铺数值和与前一时间段的同比数值，点击每条记录后的“查看”，了解新增店铺的详细信息</li>
            <li>点击列表上方的“导出数据”，将列表数据导出为Excel文件</li>
    </div>
    <div class="mod-search cf" style="margin-top:20px;margin-left: 20px">
        <div class="fl" >
            <ul class="ul-inline">
                <li>
                    <input id="start_time" class="ui-input ui-datepicker-input" type="text" readonly placeholder="时间查询"/>
                </li>
                <li>
                    <span id="shop_class"></span>
                </li>
                <li> <a class="ui-btn" id="search">查询<i class="iconfont icon-btn02"></i></a></li>
            </ul>
        </div>
    </div>
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
</body>
<script>

    function getStatdata(start_time,class_id){
        //店铺分类
        $.ajax({
            url: SITE_URL + '?ctl=Seller_Shop&met=shop_cartogram&typ=json&start_time='+start_time+'&shop_class_id='+class_id,
            data: '',
            success: function(e) {
                $('#container').highcharts(e.data);
            }
        });
    }
    function getStatdatas(start_time) {
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
                    url: SITE_URL + '?ctl=Seller_Shop&met=demo&typ=json',
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
                    queryConditions.shop_class = $shop_class.getValue();
                    THISPAGE.reloadData(queryConditions);
                });
                //刷新
                $("#btn-refresh").click(function ()
                {
                    queryConditions.start_time ='';
                    queryConditions.end_time ='';
                    queryConditions.shop_class = '';
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
            },
        };
        $(function(){
            THISPAGE.init();
        });
    }
    var handle = {
     del: function (t)
        {
            window.location.href= "<?= YLB_Registry::get('url') ?>?ctl=Seller_shop&met=shop_detail&seartime="+ t;
        }
    };

    $(function () {
        $.get("./index.php?ctl=Shop_Class&met=shopClass&typ=json", function(result){
            if(result.status==200)
            {
                var r = result.data;

                $shop_class = $("#shop_class").combo({
                    data:r,
                    value: "id",
                    text: "name",
                    width: 110
                }).getCombo();
            }
        });

//        var combo_end_time = '2030-06-11 00:00:00';
//        var maxdate =  new Date(Date.parse(combo_end_time.replace(/-/g, "/")));
        $('#start_time').datetimepicker({
            controlType: 'select',
//            minDate:new Date(),
//            onShow:function( ct ){
//                this.setOptions({
//                    maxDate:($('#end_time').val() && (new Date(Date.parse($('#end_time').val().replace(/-/g, "/"))) < maxdate))?(new Date(Date.parse($('#end_time').val().replace(/-/g, "/")))):maxdate
//                })
//            }
        });

        $('#end_time').datetimepicker({
            controlType: 'select',
//            maxDate:maxdate,
//            onShow:function( ct ){
//                this.setOptions({
//                    minDate:($('#start_time').val() && (new Date(Date.parse($('#start_time').val().replace(/-/g, "/")))) > (new Date()))?(new Date(Date.parse($('#start_time').val().replace(/-/g, "/")))):(new Date())
//                })
//            }
        });
        $('#search').click(function()
        {
            var start_time = $('#start_time').val();
            var shop_class = $shop_class.getValue();
            getStatdata(start_time,shop_class);
        });
        getStatdata(start_time);
        getStatdatas(start_time);
    });
</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>



