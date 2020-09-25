<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
// var_dump($this->view->js_com);die;
include $this->view->getTplPath() . '/'  . 'header.php';
?>
<!--<link href="--><?//= $this->view->css ?><!--/cs/index.css" rel="stylesheet" type="text/css">-->
<link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/cs/highcharts.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/cs/flexigrid.js" charset="utf-8"></script>
<link href="<?= $this->view->css_com ?>/jquery/plugins/datepicker/dateTimePicker.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.datetimepicker.js" charset="utf-8"></script>
</head>
<style>
    .currentli {
        color: #186ecc;
        background-color: #55a3fa;
    }

    .currentli a {
        color: #fff;
        background-color: #F53A59;
        border-top-left-radius:1em;
        border-top-right-radius:1em;
    }
    .tab-base a{
        height:27px;
    }
    .tab-base li{
        border-top-left-radius:1em;
        border-top-right-radius:1em;
    }

</style>
<body>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
        <div class="subject">
            <h3>店铺统计</h3>
            <h5>平台针对店铺的各项数据统计</h5>
        </div>
        <ul class="tab-base nc-row">
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Shop&met=shop"><span>新增店铺</span></a></li>
            <li><a class="current"><span>热卖排行</span></a></li>
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Shop&met=sales_statistics"><span>销售统计</span></a></li>
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Shop&met=Store_level"><span>店铺等级</span></a></li>
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Shop&met=regional_distribution"><span>地区分布</span></a></li>
        </ul>
        </div>
      <p class="warn_xiaoma"><span></span><em></em></p><div class="explanation" id="explanation">
          <div class="title" id="checkZoom"><i class="iconfont icon-lamp"></i>
              <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
              <span id="explanationZoom" title="收起提示"></span><em class="close_warn">X</em>
          </div>
          <ul>
              <li>符合以下任何一种条件的订单即为有效订单：1、采用在线支付方式支付并且已付款；2、采用货到付款方式支付并且交易已完成</li>
              <li>“店铺热卖TOP榜”展示了时间段内店铺有效订单的订单数量和订单总金额高的前15名店铺</li>
              <li>“店铺热卖飙升榜”展示了时间段内店铺有效订单的订单数量和订单总金额增长率高的前15名店铺</li>
      </div>
      <div id="stat_tabs" class="  ui-tabs" style="min-height:500px">

          <ul class="tab-base nc-row" style="margin-left:20px">
              <li style="background: #D4D4D4"><a href="javascript:" href="#goodsnum_div" nc_type="showdata" data-param='{"type":"goodsnum"}'>下单量</a></li>
              <li style="background: #D4D4D4"><a href="javascript:" href="#orderamount_div" nc_type="showdata" data-param='{"type":"orderamount"}'>下单金额</a></li>
          </ul>
          <!-- 下单金额 -->
          <div id="orderamount_div" class="" style="text-align:center;"></div>
          <!-- 下单量 -->
          <div id="goodsnum_div" class="" style="text-align:center;"></div>
          <div class="mod-search cf" style="margin-top:20px;margin-left: 20px">
              <div class="fl" >
                  <ul class="ul-inline">
                      <li>
                          <input id="start_time" class="ui-input ui-datepicker-input" type="text" readonly placeholder="时间查询"/>
                      </li>
                      <li>
                          至   &nbsp;<input id="end_time" class="ui-input ui-datepicker-input" type="text" readonly placeholder="时间查询"/>
                      </li>
                      <li>
                          <span id="shop_class"></span>
                      </li>
                      <li> <a class="ui-btn" id="search">查询<i class="iconfont icon-btn02"></i></a></li>
                      <li><a class="ui-btn ui-btn-sp" id="btn-refresh">刷新<i class="iconfont icon-btn01"></i></a></li>
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
</div>

</body>
<script>

//    //加载统计数据
//    function getStatdata(type,time,shop_class){
//        $.ajax({
//            url: SITE_URL + '?ctl=Seller_Shop&met=shop_analysis1&typ=json&type='+type+'&start_time='+time+'&shop_class_id='+shop_class,
//            data: '',
//            success: function(e) {
//                $('#container').highcharts(e.data);
//            }
//        });
//    }
    $(document).ready(
        function () {
            $(".tab-base li").click(function () {
                $(this).addClass("currentli").siblings().removeClass("currentli");
            })
        });
    //highcharts统计
    function getStatdatas(type) {
        if(type=='orderamount'){
            var a = '下单金额';
            var b = 'orderamount';
            var c = b;
        }else if(type=='goodsnum'){
            a = '下单量';
            b = 'goodsnum';
            var c = b;
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
                    {label:'操作',name:'operating', width : 120, sortable : false,formatter:operFmatter,align: 'center', className: 'handle-s'},
                    {label: '店铺名称', name : 'shop_name', width : 200, sortable : false, align: 'center'},
                    {label: a, name : b, width : 250, sortable : false, align: 'center'}
                ];

                this.mod_PageConfig.gridReg('grid', colModel);
                colModel = this.mod_PageConfig.conf.grids['grid'].colModel;

                $("#grid").jqGrid({
                    url: SITE_URL + '?ctl=Seller_Shop&met=shop_analysis_demo&typ=json&type='+type+'&_'+ (new Date()).getTime(),
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
                $(window).resize(function(){
                    Public.resizeGrid();
                });
            }
        };
        $(function(){
            THISPAGE.init();
        });
    }

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
        var combo_end_time = '2030-06-11 00:00:00';
        var maxdate =  new Date(Date.parse(combo_end_time.replace(/-/g, "/")));
        $('#start_time').datetimepicker({
            controlType: 'select',
//            minDate:new Date(),
            onShow:function( ct ){
                this.setOptions({
                    maxDate:($('#end_time').val() && (new Date(Date.parse($('#end_time').val().replace(/-/g, "/"))) < maxdate))?(new Date(Date.parse($('#end_time').val().replace(/-/g, "/")))):maxdate
                })
            }
        });

        $('#end_time').datetimepicker({
            controlType: 'select',
            maxDate:maxdate,
            onShow:function( ct ){
                this.setOptions({
                    minDate:($('#start_time').val() && (new Date(Date.parse($('#start_time').val().replace(/-/g, "/")))) > (new Date()))?(new Date(Date.parse($('#start_time').val().replace(/-/g, "/")))):(new Date())
                })
            }
        });
        $('#searchBarOpen').click();

        $('#ncsubmit').click(function(){
            $('#formSearch').submit();
        });
        //商品分类
//        init_gcselect(<?php //echo $output['gc_choose_json'];?>//,<?php //echo $output['gc_json']?>//);
//        getStatdata('orderamount');
        getStatdatas('orderamount');
//        var str = '';
        $("[nc_type='showdata']").click(function(){
            var data_str = $(this).attr('data-param');
            var start_time = $('#start_time').val();
            eval('data_str = '+data_str);
            $("#grid").GridUnload();
            getStatdatas(data_str.type,start_time);
//            getStatdata(data_str.type,start_time);
//            str = data_str.type;
        });
//        $('#search').click(function()
//        {
//            var shop_class = $shop_class.getValue();
//            var start_time = $('#start_time').val();
////            getStatdata(str,start_time,shop_class);
//        });

    });
</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>
