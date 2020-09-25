<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
// var_dump($this->view->js_com);die;
include $this->view->getTplPath() . '/'  . 'header.php';
?>
<link href="<?= $this->view->css ?>/cs/index.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/cs/highcharts.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/cs/statistics.js" charset="utf-8"></script>
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
                <h3>商品分析</h3>
                <h5>平台针对商品的各项数据统计</h5>
            </div>
            <ul class="tab-base nc-row">
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Goods&met=goods"><span>价格销量</span></a></li>
                <li><a class="current" ><span>热卖商品</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Goods&met=goods_sale"><span>商品销售明细</span></a></li>
            </ul>
        </div>
<!--      <p class="warn_xiaoma"><span></span><em></em></p><div class="explanation" id="explanation" style="height: 140px;width: 400px;position:absolute;background: #fff">-->
<!--          <div class="title" id="checkZoom"><i class="iconfont icon-lamp"></i>-->
<!--              <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>-->
<!--              <span id="explanationZoom" title="收起提示"></span><em class="close_warn">X</em>-->
<!--          </div>-->
<!--          <ul>-->
<!--              <li>符合以下任何一种条件的订单即为有效订单：1、采用在线支付方式支付并且已付款；2、采用货到付款方式支付并且交易已完成</li>-->
<!--              <li>图表展示了符合搜索条件的有效订单中的下单总金额和下单量排名前50位的商品</li>-->
<!--      </div>-->
      <div id="stat_tabs" class="  ui-tabs" style="min-height:500px">

          <ul class="tab-base nc-row" style="margin-left:20px">
              <li style="background: #D4D4D4"><a href="javascript:" href="#orderamount_div" nc_type="showdata" data-param='{"type":"orderamount"}'>下单金额</a></li>
              <li style="background: #D4D4D4"><a href="javascript:" href="#goodsnum_div" nc_type="showdata" data-param='{"type":"goodsnum"}'>下单量</a></li>
          </ul>
          <div class="mod-search cf" style="margin-top:20px;margin-left: 20px">
              <div class="fl" >
                  <ul class="ul-inline">
                      <li>
                          <input id="start_time" class="ui-input ui-datepicker-input" type="text" readonly placeholder="时间开始"/>
                          至
                          <input id="end_time" class="ui-input ui-datepicker-input" type="text"  readonly placeholder="时间结束"/>
                      </li>
                      <li> <a class="ui-btn" id="search">查询<i class="iconfont icon-btn02"></i></a></li>
                  </ul>
              </div>
          </div>
          <!-- 下单金额 -->
          <div id="orderamount_div" class="" style="text-align:center;"></div>
          <!-- 下单量 -->
          <div id="goodsnum_div" class="" style="text-align:center;"></div>
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
    $(document).ready(
        function () {
            $(".tab-base li").click(function () {
                $(this).addClass("currentli").siblings().removeClass("currentli");
            })
        });
    //加载统计数据
    function getStatdata(type,start_time,end_time){
        $.ajax({
            url: SITE_URL + '?ctl=Seller_Goods&met=info&typ=json&type='+type+'&start_time='+start_time+'&end_time='+end_time,
            data: '',
            success: function(e) {
                $('#container').highcharts(e.data);
            }

        });
    }
    function initEvent()
    {

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
    function getStatdatas(type,start_time,end_time) {
        if(type=='orderamount'){
            var a = '下单金额';
            var b = 'orderamount';
        }else if(type=='goodsnum'){
            a = '下单量';
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
                    {label:'操作',name:'operating', width : 120, sortable : false,formatter:operFmatter,align: 'center', className: 'handle-s'},
                    {label: '序号', name : 'order_id', width : 150, sortable : false, align: 'center'},
                    {label: '商品名称', name : 'goods_name', width : 200, sortable : false, align: 'center'},
                    {label: a, name : b, width : 250, sortable : false, align: 'center'},
                    {label: '时间', name : 'order_goods_time', width : 250, sortable : false, align: 'center'}
                ];

                this.mod_PageConfig.gridReg('grid', colModel);
                colModel = this.mod_PageConfig.conf.grids['grid'].colModel;

                $("#grid").jqGrid({
                    url: SITE_URL + '?ctl=Seller_Goods&met=demo&typ=json&type='+type+'&start_time='+start_time+'&end_time='+end_time,
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
                        root:"data.items",
                        records: "data.records",
                        repeatitems : false,
                        total : "data.total",
                        id: "order_id"
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
    }

    $(function () {
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
        var end_time = '';
        var start_time = '';
//        init_gcselect(<?php //echo $output['gc_choose_json'];?>//,<?php //echo $output['gc_json']?>//);
        getStatdata('orderamount',start_time,end_time);
        getStatdatas('orderamount',start_time,end_time);
        var str = '';
        $("[nc_type='showdata']").click(function(){
            var data_str = $(this).attr('data-param');
            start_time = $('#start_time').val();
            end_time = $('#end_time').val();
            eval('data_str = '+data_str);
            $("#grid").GridUnload();
            getStatdatas(data_str.type,start_time,end_time);
            getStatdata(data_str.type,start_time,end_time);
             str = data_str.type;
        });
        $('#search').click(function(){
            start_time = $('#start_time').val();
            end_time   = $('#end_time').val();
            if(str==''){
                str = 'orderamount';
            }
            getStatdatas(str,start_time,end_time);
            getStatdata(str,start_time,end_time);
        });

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

        initEvent();
        initFilter();
    });
</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>
