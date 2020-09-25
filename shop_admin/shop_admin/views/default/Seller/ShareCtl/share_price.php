<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
include $this->view->getTplPath() . '/'  . 'header.php';
?>
<!--    <link href="--><?//= $this->view->css ?><!--/cs/index.css" rel="stylesheet" type="text/css">-->
<!--    <link href="--><?//=$this->view->css?><!--/index.css" rel="stylesheet" type="text/css">-->
    <link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
    <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
    <style>
        .fixed-bar{
            background: none;
            width: auto;
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
                <h3>分享统计</h3>
                <h5>平台针对会员的分享立省赚各项数据统计</h5>
            </div>
            <ul class="tab-base nc-row">
                <li><a  href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Share&met=share"><span>分享立赚</span></a></li>
                <li><a  class="current"><span>分享立省</span></a></li>
            </ul>
        </div>
        <div id="stat_tabs" class="  ui-tabs" style="min-height:500px">
            <ul class="ul-inline" style="margin-left: 20px;margin-top: 10px">
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
</div>
<!--<div id="container" style="width:1000px;height: 500px;margin: 0 auto;margin-top: 100px;"></div>-->
<div id="mapCountry" style="width: 96%; height: 400px; padding-top: 110px;margin: auto;"></div>
<div class="wrapper">
    <div class="mod-search cf">
        <div id="container" style="max-height:400px;margin-bottom:20px;"></div>
        <div class="grid-wrap">
            <table id="grid"></table>
            <div id="page"></div>
        </div>
    </div>
</div>
</body>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/echarts/echarts-all.js"></script>
<link href="<?= $this->view->css_com ?>/jquery/plugins/datepicker/dateTimePicker.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.datetimepicker.js" charset="utf-8"></script>
<script>
    var queryConditions = {},
        hiddenAmount = false,
        SYSTEM = system = parent.SYSTEM;
    var THISPAGE = {
        init: function (data) {
            if (SYSTEM.isAdmin === false && !SYSTEM.rights.AMOUNT_COSTAMOUNT) {
                hiddenAmount = true;
            }
            ;
            this.mod_PageConfig = Public.mod_PageConfig.init('man-song-list');//页面配置初始化
            this.initDom();
            this.loadGrid();
            this.addEvent();
        },
        initDom: function () {
            this.$_goods_name = $('#goods_name');
            this.$_goods_name.placeholder();
        },
        loadGrid: function () {
            var gridWH = Public.setGrid(), _self = this;
            var colModel = [
                {
                    label: '操作',
                    name: 'operating',
                    width: 120,
                    sortable: false,
                    formatter: operFmatter,
                    align: 'center',
                    className: 'handle-s'
                },
                {label: '省份', name: 'name', width: 150, sortable: false, align: 'center'},
                {label: '该地区立省金额', name: 'value', width: 200, sortable: false, align: 'center'},
            ];

            this.mod_PageConfig.gridReg('grid', colModel);
            colModel = this.mod_PageConfig.conf.grids['grid'].colModel;

            $("#grid").jqGrid({
                url: SHOP_URL + '?ctl=Api_Seller_Share&met=share_price_demo&typ=json',
                postData: queryConditions,
                datatype: "json",
                autowidth: true,//如果为ture时，则当表格在首次被创建时会根据父元素比例重新调整表格宽度。如果父元素宽度改变，为了使表格宽度能够自动调整则需要实现函数：setGridWidth
                height: gridWH.h,
                altRows: true, //设置隔行显示
                gridview: true,
                multiboxonly: true,
                colModel: colModel,
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
                    repeatitems: false,
                    total: "data.total",
                    id: "order_return_id"
                },
                loadError: function (xhr, st, err) {

                },
                ondblClickRow: function (rowid, iRow, iCol, e) {
                    $('#' + rowid).find('.ui-icon-pencil').trigger('click');
                },
                resizeStop: function (newwidth, index) {
                    THISPAGE.mod_PageConfig.setGridWidthByIndex(newwidth, index, 'grid');
                }
            }).trigger('reloadGrid');

            function operFmatter(val, opt, row) {
                var html_con = '';
                html_con = '<div class="operating" data-id="' + row.order_return_id + '"><span title="--">--</span></div>';
                return html_con;
            };
        },

        reloadData: function (data) {
            // alert(data);
            $("#grid").jqGrid('setGridParam', {postData: data}).trigger("reloadGrid");
        },
        addEvent: function () {
            var _self = this;
            //搜索
            $('#search').click(function () {
                queryConditions.start_time = $('#start_time').val();
                queryConditions.end_time = $('#end_time').val();
                THISPAGE.reloadData(queryConditions);
            });
            $("#btn-refresh").click(function ()
            {
                queryConditions.start_time = '';
                queryConditions.end_time = '';
                THISPAGE.reloadData(queryConditions);
            });
            $(window).resize(function () {
                Public.resizeGrid();
            });
        }
    };
    $(function(){
        THISPAGE.init();
    });
</script>
<script>
    $(function () {
        $(document).ready(
            function () {
                $(".tab-base li").click(function () {
                    $(this).addClass("currentli").siblings().removeClass("currentli");
                })
            });
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
        getStatMap('','');
        $('#search').click(function() {
            var start_time = $('#start_time').val();
            var end_time = $('#end_time').val();
            getStatMap(start_time,end_time);
        });
        $('#btn-refresh').click(function () {
            history.go(0);
        })
        function getStatMap(start_time,end_time) {
            var data;
            $.ajax({
//                url: SITE_URL + '?ctl=Seller_Shop&met=area_map&typ=json&start_time='+start_time+'&end_time='+end_time+'&shop_class='+shop_class,
                url: SHOP_URL + '?ctl=Api_Seller_Share&met=share_price&typ=json&start_time='+start_time+'&end_time='+end_time,
                data: '',
                success: function (e) {
                    data = e.data;
                    var myChart = echarts.init(document.getElementById('mapCountry'));
                    var curIndx = 0;
                    var mapType = [
                        'china',
                        // 23个省
                        '广东', '青海', '四川', '海南', '陕西',
                        '甘肃', '云南', '湖南', '湖北', '黑龙江',
                        '贵州', '山东', '江西', '河南', '河北',
                        '山西', '安徽', '福建', '浙江', '江苏',
                        '吉林', '辽宁', '台湾',
                        // 5个自治区
                        '新疆', '广西', '宁夏', '内蒙古', '西藏',
                        // 4个直辖市
                        '北京', '天津', '上海', '重庆',
                        // 2个特别行政区
                        '香港', '澳门'
                    ];
                    myChart.on(echarts.config.EVENT.MAP_SELECTED, function (param){
                        var len = mapType.length;
                        var mt = mapType[curIndx % len];

                        if (mt == 'china') {
                            // 全国选择时指定到选中的省份
                            var selected = param.selected;
                            for (var i in selected) {
                                if (selected[i]) {
                                    mt = i;
                                    while (len--) {
                                        if (mapType[len] == mt) {
                                            curIndx = len;
                                        }
                                    }
                                    break;
                                }
                            }
                        } else {
                            curIndx = 0;
                            mt = 'china';
                            option.tooltip.formatter = '{b}';
                        }
                        option.series[0].mapType = mt;
//        option.title.subtext = mt + ' （滚轮或点击切换）';
                        myChart.setOption(option, true);

                    });

                    option = {
                        title: {
                            text : '分享地区立省金额',
//            subtext : 'china （滚轮或点击切换）'
                        },
                        tooltip : {
                            trigger: 'item'
                        },
                        dataRange: {
                            min: 0,
                            max: 200,
                            color:['red','yellow'],
                            text:['高','低'],           // 文本，默认为数值文本
                            calculable : true
                        },
                        series : [
                            {
                                name: '分享地区立省金额',
                                type: 'map',
                                mapType: 'china',
                                selectedMode : 'single',
                                itemStyle:{
                                    normal:{label:{show:true}},
                                    emphasis:{label:{show:true}}
                                },
                                data:data
                            }
                        ]
                    };
                    myChart.setOption(option);
                }
            });
        }
    })
</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>



