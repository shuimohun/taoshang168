<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
// var_dump($this->view->js_com);die;
include $this->view->getTplPath() . '/'  . 'header.php';
?>
<link href="<?= $this->view->css ?>/cs/index.css" rel="stylesheet" type="text/css">
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
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Shop&met=sales_statistics"><span>销售统计</span></a></li>
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Shop&met=Store_level"><span>店铺等级</span></a></li>
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Shop&met=regional_distribution"><span>地区分布</span></a></li>
            <li><a class="current">店铺详细</a></li>
        </ul>
        </div>
      <p class="warn_xiaoma"><span></span><em></em></p>

      </div>
      <div id="stat_tabs" class="  ui-tabs" style="min-height:500px">
          <div class="fl" style="float:right">
              <div class="fr">
                  <a class="ui-btn" id="btn-excel">导出<i class="iconfont icon-btn04"></i></a>
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
    $(function () {

        var url = location.search; //获取url中"?"符后的字串
        function getvl(url) {
            var reg = new RegExp("(^|\\?|&)"+ url +"=([^&]*)(\\s|&|$)", "i");
            if (reg.test(location.href)) return unescape(RegExp.$2.replace(/\+/g, " "));
            return "";
        };
        var seartime = getvl("seartime");
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
                    {label: '店主账号', name : 'shop_name', width : 120, sortable : false, align: 'center'},
                    {label: '店铺账号', name : 'user_name', width : 120, sortable : false, align: 'center'},
                    {label: '所属等级', name : 'shop_grade', width : 150, sortable : false, align: 'center'},
                    {label: '开店时间', name : 'shop_create_time', width : 150, sortable : false, align: 'center'},
                    {label: '有效期至', name : 'shop_end_time', width : 150, sortable : false, align: 'center'},
                    {label: '所属分类', name : 'shop_class', width:150, sortable : false, align:'center'},
                    {label: '当前状态', name : 'shop_status_cha', width:150, sortable : false, align:'center'},
                ];
                this.mod_PageConfig.gridReg('grid', colModel);
                colModel = this.mod_PageConfig.conf.grids['grid'].colModel;

                $("#grid").jqGrid({
                    url: SHOP_URL + '?ctl=Api_Seller_Shop&met=shop_detail&typ=json&seartime='+seartime,
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
                        id: "user_id"
                    },
                    /*loadComplete:function (response) {

                    },
                    loadComplete: function(response) {
                        if (response && response.status == 200) {
                            var gridData = $("#grid").data('gridData');
                            if (!gridData)
                            {
                                gridData = {};
                                $("#grid").data('gridData', gridData);
                            }

                            data = response.data;
                            for (var i = 0; i < data.items.length; i++) {
                                var item = data.items[i];
                                item['id'] = item.district_id;
                                gridData[item.district_id] = item;
                            }

                            $("#grid").data('gridData', gridData);
                        } else {
                            var msg = response.status === 250 ? (searchFlag ? '没有满足条件的结果哦！' : '没有数据哦！') : response.msg;
                            parent.Public.tips({
                                type: 2,
                                content: msg
                            });
                        }
                    },*/

                    ondblClickRow : function(rowid, iRow, iCol, e){
                        $('#' + rowid).find('.ui-icon-pencil').trigger('click');
                    },
                    resizeStop: function(newwidth, index){
                        THISPAGE.mod_PageConfig.setGridWidthByIndex(newwidth, index, 'grid');
                    }
                }).trigger('reloadGrid');
//                $("#grid").jqGrid({
//                 url: SHOP_URL + '?ctl=Api_Seller_Vip&met=vip_showmember&typ=json&seartime='+seartime,
//                    datatype: "json",
//                    height: Public.setGrid().h,
//                    altRows: !0,
//                    multiselect: !0,
//                    gridview: !0,
//                    rowNum: 200,
//                    colNames: a,
//                    colModel: b,
//                    shrinkToFit: false,
//                    forceFit: true,
//                    autowidth: !0,
//                    viewrecords: !0,
//                    cmTemplate: {
//                        sortable: !1,
//                        title: !1
//                    },
//                    page: 1,
//                    pager: "#page",
//                    shrinkToFit: !1,
//                    scroll: !0,
//                    jsonReader: {
//                        root: "data.items",
//                        records: "data.records",
//                        total:"data.total",
//                        repeatitems: !1,
//                        id: "Name"
//                    },
//                    loadComplete: function(a) {
//                        if (a && 200 == a.status) {
//                            var b = {};
//                            a = a.data;
//                            for (var c = 0; c < a.items.length; c++) {
//                                var d = a.items[c];
//                                b[d.Name] = d
//                            }
//                            $("#grid").data("gridData", b)
//                        } else {
//                            var e = 250 == a.status ? "没有数据！" : "获取数据失败！" + a.msg;
//                            parent.Public.tips({
//                                type: 2,
//                                content: e
//                            })
//                        }
//                    },
//                    loadError: function(a, b, c) {
//                        parent.Public.tips({
//                            type: 1,
//                            content: "操作失败了哦，请检查您的网络链接！"
//                        })
//                    }
//                })

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
                //EXCEl
                //
                $("#btn-excel").click(function ()
                {
                    var query = "";
                    for (x in queryConditions)
                    {
                        query = query + "&" + x + "=" + queryConditions[x];
                    }
                    window.open(SHOP_URL + "?ctl=Api_Seller_Shop&met=getReturnAllExcel&debug=1"+query+"&seartime="+seartime);
                });

                $(window).resize(function(){
                    Public.resizeGrid();
                });
            }
        };
        $(function(){
            THISPAGE.init();
        });

    });
</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>
