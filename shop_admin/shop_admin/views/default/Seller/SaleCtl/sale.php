<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/'  . 'header.php';
// 当前管理员权限
$admin_rights = $this->getAdminRights();
// 当前页父级菜单 同级菜单 当前菜单
$menus = $this->getThisMenus();
?>
    <link href="<?= $this->view->css ?>/cs/index.css" rel="stylesheet" type="text/css">
    <link href="<?= $this->view->css ?>/iconfont/iconfont.css" rel="stylesheet" type="text/css">

<link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
<link href="<?= $this->view->css_com ?>/jquery/plugins/datepicker/dateTimePicker.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.datetimepicker.js" charset="utf-8"></script>
</head>
<body>
<div class="wrapper page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>销量分析</h3>
                <h5>平台针对销售量的各项数据统计</h5>
            </div>
            <ul class="tab-base nc-row">
                <li><a class="current"><span>销售收入统计</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Sale&met=Pre-deposit"><span>预存款统计</span></a></li>
            </ul>
        </div>
    </div>

        <div class="mod-toolbar-top cf" style="margin-top:10px">
            <div class="left">
                <div id="assisting-category-select" class="ui-tab-select">
                    <ul class="ul-inline">
                        <li>
                            <input type="text" id="settleId" class="ui-input ui-input-ph con" placeholder="请输入结算单编号...">
                        </li>
                        <li>
                            <input type="text" id="shopName" class="ui-input ui-input-ph con" placeholder="请输入商铺名称...">
                        </li>
                        <li>
                            <input id="start_time" class="ui-input ui-datepicker-input" type="text" readonly placeholder="开始时间"/>
                            至
                            <input id="end_time" class="ui-input ui-datepicker-input" type="text"  readonly placeholder="结束时间"/>
                        </li>
                        <li><a class="ui-btn" id="search">查询<i class="iconfont icon-btn02"></i></a></li>
                        <a class="ui-btn" id="btn-excel">导出<i class="iconfont icon-btn04"></i></a>
                        <li><a class="ui-btn ui-btn-sp" id="btn-refresh">刷新<i class="iconfont icon-btn01"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    <div class="ncap-form-all ncap-stat-general-single">
        <div class="title">
            <h3>销售收入情况一览</h3>
        </div>
        <dl class="row">
            <dd class="opt">
                <ul class="nc-row">
                    <li>
                        <h4>收款金额</h4>
                        <h2 id="count-number" class="skje" data-speed="1500"></h2>
                        <h6>元</h6>
                    </li>
                    <li>
                        <h4>退款金额</h4>
                        <h2 id="count-number" class="tkje" data-speed="1500"></h2>
                        <h6>元</h6>
                    </li>
                    <li>
                        <h4>实收金额</h4>
                        <h2 id="count-number" class="ssje" data-speed="1500"></h2>
                        <h6>元</h6>
                    </li>
                    <li>
                        <h4>佣金总额</h4>
                        <h2 id="count-number" class="yjze" data-speed="1500"></h2>
                        <h6>元</h6>
                    </li>
                    <li>
                        <h4>店铺费用</h4>
                        <h2 id="count-number" class="dpfy" data-speed="1500"></h2>
                        <h6>元</h6>
                    </li>
                    <li>
                        <h4>总收入</h4>
                        <h2 id="count-number" class="zsr" data-speed="1500"></h2>
                        <h6>元</h6>
                    </li>
                </ul>
            </dd>
        </dl>
    </div>
        <div class="grid-wrap">
            <table id="grid">
            </table>
            <div id="page"></div>
        </div>
</div>
<script>

    urlParam = Public.urlParam();
    var queryConditions = {
            "otyp":urlParam.otyp
        },
        hiddenAmount = false,
        SYSTEM = system = parent.SYSTEM;
    var THISPAGE = {
        init: function(data){
            if (SYSTEM.isAdmin === false && !SYSTEM.rights.AMOUNT_COSTAMOUNT) {
                hiddenAmount = true;
            };
            this.mod_PageConfig = Public.mod_PageConfig.init('settlement-list');//页面配置初始化
            //this.initDom();
            this.loadGrid();
            this.addEvent();
        },
        initDom: function(){
            //this.$_settleId = $('#settleId');
            //this.$_settleId.placeholder();
            //this.$_shopName = $('#shopName');
            //this.$_shopName.placeholder();
        },
        loadGrid: function(){
            var gridWH = Public.setGrid(), _self = this;
            var colModel = [
                {
                    name: "operating",
                    label:'操作',
                    width: 40,
                    fixed: !0,
                    align: "center",
                    formatter: operFmatter
                },
                {name: "shop_name", label: "店铺名称", align: "center",width: 200,sortable:false},
                {name: "os_id", label: "账单编号", align: "center",width:200,sortable:true},
                {name: "os_order_amount", label: "订单金额(含运费)", align: "center",width:100,sortable:true},
                {name: "os_commis_amount", label: "收取佣金", align: "center",width:100,sortable:true},
                {name: "os_order_return_amount", label: "退单金额", align: "center",width:100,sortable:true},
                {name: "os_commis_return_amount", label: "退还佣金", align: "center",width:100,sortable:true},
                {name: "os_shop_cost_amount", label: "店铺费用", align: "center",width:100,sortable:true},
                {name: "os_amount", label: "结算金额", align: "center",width:100,sortable:true},
            ];
            this.mod_PageConfig.gridReg('grid', colModel);
            colModel = this.mod_PageConfig.conf.grids['grid'].colModel;
            $("#grid").jqGrid({
                url:SITE_URL + "?ctl=Seller_Sale&met=getSettleList&typ=json",
                postData: queryConditions,
                datatype: "json",
                autowidth: true,//如果为ture时，则当表格在首次被创建时会根据父元素比例重新调整表格宽度。如果父元素宽度改变，为了使表格宽度能够自动调整则需要实现函数：setGridWidth
                height:Public.setGrid().h,
                altRows: true, //设置隔行显示
                gridview: true,
                multiselect: false,
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
                    id: "os_id"
                },
                loadError : function(xhr,st,err) {

                },
                ondblClickRow : function(rowid, iRow, iCol, e){
                    $('#' + rowid).find('.ui-icon-pencil').trigger('click');
                },
                resizeStop: function(newwidth, index){
                    THISPAGE.mod_PageConfig.setGridWidthByIndex(newwidth, index, 'grid');
                }
            }).navGrid('#page',{edit:false,add:false,del:false,search:false,refresh:false}).navButtonAdd('#page',{
                caption:"",
                buttonicon:"ui-icon-config",
                onClickButton: function(){
                    THISPAGE.mod_PageConfig.config();
                },
                position:"last"
            });

            function operFmatter (val, opt, row) {
                if(row.os_state_etext='wait_operate' || row.os_state_etext=='finish'){
                    var state = '<span class="ui-icon ui-icon-search" title="查看详情"></span>';
                }else if(row.os_state_etext=='seller_comfirmed'){
                    var state = '<span class="ui-icon ui-icon-search" title="审核"></span>';
                }else if(row.os_state_etext=='platform_comfirmed'){
                    var state = '<span class="ui-icon ui-icon-search" title="付款完成"></span>';
                }
                var html_con = "<div class='operating' data-id='" + row.id + "'><a data-right='BU_QUERY' parentOpen='true' href='"+SITE_URL+"?ctl=Operation_Settlement&met=detail&id="+row.os_id+"' rel='pageTab' tabid='settlement-look' tabtxt='查看结算单'>"+state+"</a></div>";
                return html_con;
            };

            function online_imgFmt(val, opt, row){
                if(val)
                {
                    val = '<img src="'+val+'" height=100>';
                }
                else
                {
                    val='';
                }
                return val;
            }

        },
        reloadData: function(data){
            $("#grid").jqGrid('setGridParam',{postData: data}).trigger("reloadGrid");
        },
        addEvent: function(){
            var _self = this;

            $('#search').click(function(){
                queryConditions.settleId = $('#settleId').val();
                queryConditions.shopName = $('#shopName').val();
//                queryConditions.state = $source.getValue();
                queryConditions.start_time = $('#start_time').val();
                queryConditions.end_time = $('#end_time').val();
                THISPAGE.reloadData(queryConditions);
            });

            //刷新
            $("#btn-refresh").click(function ()
            {
                queryConditions.settleId = '';
                queryConditions.shopName = '';
                queryConditions.start_time = '';
                queryConditions.end_time = '';
                THISPAGE.reloadData(queryConditions);
            });
            $("#btn-excel").click(function ()
            {
                var query = "";
                for (x in queryConditions)
                {
                    query = query + "&" + x + "=" + queryConditions[x];
                }
                window.open(SHOP_URL + "?ctl=Api_Seller_Sale&met=getSettleExcel&debug=1"+query);
            });

            $("#btn-refresh").click(function ()
            {
                queryConditions.settleId = '';
                queryConditions.shopName = '';
                queryConditions.state = '';
                queryConditions.start_time = '';
                queryConditions.end_time = '';
                THISPAGE.reloadData(queryConditions);
            });

            $(window).resize(function(){

                Public.resizeGrid();
            });
        }
    };

    $(function(){
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
        $source = $("#source").combo({
            data: [{
                id: "",
                name: "选择状态"
            },{
                id: "1",
                name: "已出账"
            },{
                id: "2",
                name: "商家已确认"
            },{
                id: "3",
                name: "平台已审核"
            },{
                id: "4",
                name: "结算完成"
            }],
            value: "id",
            text: "name",
            width: 110
        }).getCombo();

        Public.pageTab();

        THISPAGE.init();

    });
    $.ajax({
        url: SITE_URL + "?ctl=Seller_Sale&met=sale_settle&typ=json",
        data: '',
        type: 'POST',
        success: function(e) {
            $(e[0]).each(function(index,item){
                //index指下标
                //item指代对应元素内容
                //this指代每一个元素对象
                //console.log(obj.bkdata[index]);
//                alert(item);
                //console.log($(this));
            });
//            alert(e.os_amount);
//            $('.xdje').html(e.data.order_num);
//            $('.xdhys').html(e.data.order_user);
//            $('.xdl').html(e.data.order_place);
//            $('.pjkdj').html(e.data.order_shop);
//            $('.pjjj').html(e.data.order_mean);
//            $('.hysl').html(e.data.user_num);
//            $('.spsl').html(e.data.goods_num);
//            $('.dpsl').html(e.data.shop_num);
//            $('.xzhy').html(e.data.new_user);
//            $('.xzsp').html(e.data.new_goods);
//            $('.xzdp').html(e.data.create_shop);
//            $('.xdsps').html(e.data.order_goods);
        }
    });

</script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>