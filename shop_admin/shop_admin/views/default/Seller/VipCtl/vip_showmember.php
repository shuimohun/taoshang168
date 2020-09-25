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
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Vip&met=vip"><span>新增会员</span></a></li>
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Vip&met=vip_analysis"><span>会员分析</span></a></li>
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Vip&met=vip_scale"><span>会员规模分析</span></a></li>
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Vip&met=vip_area"><span>区域分析</span></a></li>
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Vip&met=vip_buy"><span>购买分析</span></a></li>
            <li><a class="current">会员详细</a></li>
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
                    {label: '会员名称', name : 'user_name', width : 120, sortable : false, align: 'center'},
                    {label: '昵称', name : 'user_truename', width : 120, sortable : false, align: 'center'},
                    {label: '邮箱', name : 'user_email', width : 150, sortable : false, align: 'center'},
                    {label: '手机号', name : 'user_mobile', width : 150, sortable : false, align: 'center'},
                    {label: '注册时间', name : 'user_reg_time', width : 150, sortable : false, align: 'center'},
                    {label: '登陆次数', name : 'user_count_login', width : 120, sortable : false, align: 'center'},
                    {label: '最后登录时间', name : 'user_lastlogin_time', width : 150, sortable : false, align: 'center'},
                    {label: '最后登录IP', name : 'user_lastlogin_ip', width : 120, sortable : false, align: 'center'},
                    {label: 'MSN', name : 'user_msn', width : 120, sortable : false, align: 'center'},
                    {label: 'Q Q', name : 'user_qq', width : 120, sortable : false, align: 'center'},
                    {label: '金蛋', name : 'user_credit', width : 120, sortable : false, align: 'center'},
                    {label: '用户资金', name : 'user_money', width : 150, sortable : false, align: 'center'}
                ];
                this.mod_PageConfig.gridReg('grid', colModel);
                colModel = this.mod_PageConfig.conf.grids['grid'].colModel;

                $("#grid").jqGrid({
                    url: SHOP_URL + '?ctl=Api_Seller_Vip&met=vip_showmember&typ=json&seartime='+seartime,
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
                    window.open(SHOP_URL + "?ctl=Api_Seller_Vip&met=getReturnAllExcel&debug=1"+query+"&seartime="+seartime);
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
