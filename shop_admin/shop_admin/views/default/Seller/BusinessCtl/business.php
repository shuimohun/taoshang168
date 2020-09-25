<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
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
<style>
    #container {
        min-width: 310px;
        max-width: 100%;
        height: 400px;
        margin: 0 auto
    }
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
</head>
<body>
    <div class="page">
        <div class="fixed-bar">
            <div class="item-title">
                <div class="subject">
                    <h3>行业分析</h3>
                    <h5>平台针对商品的各项数据统计</h5>
                </div>
                <ul class="tab-base nc-row">
                    <li><a class="current"><span>行业规模</span></a></li>
                    <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Business&met=Industry"><span>行业排行</span></a></li>
                    <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Business&met=price"><span>价格分析</span></a></li>
                    <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Business&met=survey"><span>概况总览</span></a></li>
                </ul>
            </div>
        </div>
        <!-- 操作说明 -->
        <p class="warn_xiaoma"><span></span><em></em></p><div class="explanation" id="explanation">
            <div class="title" id="checkZoom"><i class="iconfont icon-lamp"></i>
                <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
                <span id="explanationZoom" title="收起提示"></span><em class="close_warn">X</em>
            </div>
            <ul>
                <li>在页面右侧可以选择不同的商品分类和时间查询数据</li>
                <li>统计某行业子分类在不同时间段的下单金额、下单商品数、下单量，为分析行业销量提供依据</li>
            </ul>
        </div>
        <div id="stat_tabs" class=" ui-tabs" style="min-height:400px">
            <ul class="tab-base nc-row">
                <li style="background: #DEDEDE"><a href="javascript:" href="#orderamount_div" nc_type="showdata" data-param='{"type":"orderamount"}'>下单金额</a></li>
                <li style="background: #DEDEDE"><a href="javascript:" href="#goodsnum_div" nc_type="showdata" data-param='{"type":"goodsnum"}'>下单商品数</a></li>
                <li style="background: #DEDEDE"><a href="javascript:" href="#ordernum_div" nc_type="showdata" data-param='{"type":"ordernum"}'>下单量</a></li>
            </ul>

            <!-- 下单金额 -->
            <div id="orderamount_div" class="" style="text-align:center;"></div>
            <!-- 下单商品数 -->
            <div id="goodsnum_div" class="" style="text-align:center;"></div>
            <!-- 下单量 -->
            <div id="ordernum_div" class="" style="text-align:center;"></div>
            <div class="wrapper" style="margin-top: 5px">
                <div class="mod-search cf">
                    <div class="fl" >
                        <ul class="ul-inline">
                            <li>
                                <input id="start_time" class="ui-input ui-datepicker-input" type="text" readonly placeholder="时间查询"/>
                            </li>
                            <li>
                                至   &nbsp;
                                <input id="end_time" class="ui-input ui-datepicker-input" type="text" readonly placeholder="时间查询"/>
                            </li>
                            <li>
                                <span id="goods_cat"></span>
                            </li>
                            <li> <a class="ui-btn" id="search">查询<i class="iconfont icon-btn02"></i></a></li>
                        </ul>
                    </div>
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
$(function () {
    $(document).ready(
        function () {
            $(".tab-base li").click(function () {
                $(this).addClass("currentli").siblings().removeClass("currentli");
            })
        });
    var combo_end_time = '2030-06-11 00:00:00';
    var maxdate =  new Date(Date.parse(combo_end_time.replace(/-/g, "/")));
    $('#start_time').datetimepicker({
        controlType: 'select',
//        minDate:new Date(),
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

    //加载统计数据
    var str = '';
    getStatdata('orderamount');
    $("[nc_type='showdata']").click(function(){
      var data_str = $(this).attr('data-param');
    eval('data_str = '+data_str);
    getStatdata(data_str.type);
    str = data_str.type;
    });
    $('#search').click(function(){
        var start_time = $('#start_time').val();
        var end_time = $('#end_time').val();
        var cat_id = categoryTree.getValue();
        getStatdata(str,start_time,end_time,cat_id)
    });
    //加载统计数据
    function getStatdata(type,start_time,end_time,cat_id) {
        $.ajax({
            url: SITE_URL + '?ctl=Seller_Business&met=scale&typ=json&type=' + type + '&start_time=' + start_time + '&end_time=' + end_time + '&cat_id=' + cat_id,
            data: '',
            success: function (e) {
                $('#container').highcharts(e.data);
            }
        });
    }
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
});

</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>



