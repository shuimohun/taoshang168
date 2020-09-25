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
<body>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
        <div class="subject">
            <h3>会员统计</h3>
            <h5>平台针对会员的各项数据统计</h5>
        </div>
        <ul class="tab-base nc-row">
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Shop&met=shop"><span>新增店铺</span></a></li>
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Shop&met=best_seller"><span>热卖排行</span></a></li>
            <li><a class="current"><span>销售统计</span></a></li>
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
              <li>列表展示了店铺在搜索时间段内的有效订单总金额、订单量和下单会员数，并可以点击列表上方的“导出数据”将列表数据导出为Excel文件</li>
              <li>默认按照“下单会员数”降序排列</li>
      </div>
      <div id="stat_tabs" class="  ui-tabs" style="min-height:500px;">
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
                      <li><a class="ui-btn" id="btn-excel">导出<i class="iconfont icon-btn04"></i></a></li>
                      <li><a class="ui-btn ui-btn-sp" id="btn-refresh">刷新<i class="iconfont icon-btn01"></i></a></li>
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

    //highcharts统计
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
                    {label:'操作',name:'operating', width : 120, sortable : false,formatter:operFmatter,align: 'center', className: 'handle-s'},
                    {label: '店铺名称', name : 'shop_name', width : 200, sortable : false, align: 'center'},
                    {label: '下单会员数', name : 'membernum', width : 250, sortable : false, align: 'center'},
                    {label: '下单量', name : 'ordernum', width : 250, sortable : false, align: 'center'},
                    {label: '下单金额', name : 'orderamount', width : 250, sortable : false, align: 'center'}
                ];

                this.mod_PageConfig.gridReg('grid', colModel);
                colModel = this.mod_PageConfig.conf.grids['grid'].colModel;

                $("#grid").jqGrid({
                    url: SHOP_URL + '?ctl=Api_Seller_Shop&met=sales_statistics&typ=json&_'+ (new Date()).getTime(),
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
                    html_con = '<div class="operating" data-id="' + row.order_return_id + '"><span title="--">--</span></div>';
                    return html_con;
                };
            },

            reloadData: function(data){
                // alert(data);
                $("#grid").jqGrid('setGridParam',{postData: data}).trigger("reloadGrid");
            },
            addEvent: function(){
                $("#btn-excel").click(function ()
                {
                    var query = "";
                    for (x in queryConditions)
                    {
                        query = query + "&" + x + "=" + queryConditions[x];
                    }
                    window.open(SITE_URL + "?ctl=Seller_Shop&met=getReturnAllExcels&debug=1"+query);
                });
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
        //时间
        $('#start_time').datetimepicker({
            controlType: 'select',
            format:"Y-m-d",
            timepicker:false
        });

        $('#end_time').datetimepicker({
            controlType: 'select',
            format:"Y-m-d",
            timepicker:false
        });
        $('#searchBarOpen').click();

        //店铺分类
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
        //商品分类
        getStatdatas();

        $("#btn-excel").click(function ()
        {
            var start_time = $('#start_time').val();
            var end_time = $('#end_time').val();
            var shop_class = $shop_class.getValue();
            window.open(SHOP_URL + "?ctl=Api_Seller_Shop&met=getReturnAllExcels&start_time="+start_time+"&end_time="+end_time+"&shop_class="+shop_class);
        });

    });
</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>
