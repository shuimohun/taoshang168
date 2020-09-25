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
<script src="<?= YLB_Registry::get('base_url') ?>/shop_admin/static/default/js/controllers/seller/statistics.js"></script>
<link href="<?= $this->view->css_com ?>/jquery/plugins/datepicker/dateTimePicker.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.datetimepicker.js" charset="utf-8"></script>
</head>
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
                <li><a  class="current"><span>区域分析</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Vip&met=vip_buy"><span>购买分析</span></a></li>
            </ul>
    </div>
      <div id="stat_tabs" class="  ui-tabs" style="min-height:500px">
          <ul class="tab-base nc-row">
              <li><a href="#membernum_div" nc_type="showmap" data-param='{"type":"membernum"}'>下单会员数</a></li>
              <li><a href="#ordernum_div" nc_type="showmap" data-param='{"type":"ordernum"}'>下单量</a></li>
              <li><a href="#orderamount_div" nc_type="showmap" data-param='{"type":"orderamount"}'>下单金额</a></li>
          </ul>

          <!-- 下单会员数 -->
          <div id="membernum_div" class="" style="text-align:center;"></div>
          <!-- 下单量 -->
          <div id="ordernum_div" class="" style="text-align:center;"></div>
          <!-- 下单金额 -->
          <div id="orderamount_div" class="" style="text-align:center;"></div>
      </div>
  </div>
</div>
<!-- 地图容器 -->
<div id="container_<?php echo $output['stat_field'];?>" style="height:600px; width:90%; margin: 0 auto;">
    <div class="stat-map-color">高&nbsp;&nbsp;<span style="background-color: #fd0b07;">&nbsp;</span><span style="background-color: #ff9191;">&nbsp;</span><span style="background-color: #f7ba17;">&nbsp;</span><span style="background-color: #fef406;">&nbsp;</span><span style="background-color: #25aae2;">&nbsp;</span>&nbsp;&nbsp;低
        <p>
            备注：按照排名由高到低显示：排名第1、2、3名为第一阶梯；排名第4、5、6名为第二阶梯；排名第7、8、9为第三阶梯；排名第10、11、12为第四阶梯；其余为第五阶梯。
        </p></div>
</div>

<link rel="stylesheet" type="text/css" href="<?= YLB_Registry::get('base_url') ?>/shop_admin/static/default/js/controllers/seller/jquery.vector-map.css"/>
<script type="text/javascript" src="<?= YLB_Registry::get('base_url') ?>/shop_admin/static/default/js/controllers/seller/jquery.vector-map.js"></script>
<script type="text/javascript" src="<?= YLB_Registry::get('base_url') ?>/shop_admin/static/default/js/controllers/seller/china-zh.js"></script>
<script>
    $(function () {
//        getMap(<?php //echo $output['stat_json']; ?>//,'container_<?php //echo $output['stat_field'];?>//');
    });
</script>
<script type="text/javascript">
    $(function () {
        //加载统计地图
        getStatMap('membernum');
        $("[nc_type='showmap']").click(function(){
            var data_str = $(this).attr('data-param');
            eval('data_str = '+data_str);
            getStatMap(data_str.type);
        });
        //加载统计列表
//        $("#statlist").flexigrid({
//            url: SITE_URL + '?ctl=Seller_Vip&met=area_map&typ=json&type&_'+ (new Date()).getTime(),
//            colModel : [
//                {display: '操作', name : 'operation', width : 60, sortable : false, align: 'center', className: 'handle-s'},
//                {display: '省份', name : 'provincename', width : 100, sortable : false, align: 'center'},
//                {display: '下单会员数', name : 'membernum',  width : 150, sortable : true, align: 'center'},
//                {display: '下单金额', name : 'orderamount',  width : 150, sortable : true, align: 'center'},
//                {display: '下单量', name : 'ordernum',  width : 150, sortable : true, align: 'center'}
//            ],
//            buttons : [
//                {display: '<i class="fa fa-file-excel-o"></i>导出数据', name : 'excel', bclass : 'csv', title : '导出EXCEL文件', onpress : fg_operation }
//            ],
//            sortname: "membernum",
//            sortorder: "desc",
//            usepager: true,
//            rp: 15,
//            title: '区域分析'
//        });
    });
    function fg_operation(name, bDiv){
        var stat_url = 'index.php?act=stat_member&op=area_list&exporttype=excel&t=<?php echo $output['searchtime'];?>';
        get_excel(stat_url,bDiv);
    }

    function getStatMap(type){
        $.ajax({
            url: SITE_URL + '?ctl=Seller_Vip&met=area_map&typ=json&type='+type,
            data: '',
            success: function(e) {
                        getMap(e.data,'container_'+type);
            }
        });
//       $('#'+type+'_div').load('index.php?ctl=Seller_Vip&met=area_map&typ=json&type='+type);
    }

</script>

<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>
