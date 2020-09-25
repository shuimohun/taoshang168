<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
// var_dump($this->view->js_com);die;
include $this->view->getTplPath() . '/'  . 'header.php';
?>
<!-- <script src="./shop_admin/static/default/js/controllers/sta/highcharts.js"></script> -->
 
    <link href="<?= $this->view->css ?>/cs/index.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">

    <style>
        #container {
    min-width: 310px;
    max-width: 100%;
    height: 400px;
    margin: 0 auto
}
    </style>
<div class="page">
 <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>统计概述</h3>
            </div>
            <ul class="tab-base nc-row">
                <li><a class="current"><span>统计概述</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Gr&met=manage"><span>商品价格区间</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Gr&met=goods_money"><span>商品金额区间</span></a></li>
            </ul>
        </div>
    </div>

  <div class="ncap-form-all ncap-stat-general">
    <div class="title">
      <h3><?php echo @date('Y-m-d',strtotime("-1 day"));?>最新情报</h3>
    </div>
    <dl class="row">
      <dd class="opt">
        <ul class="nc-row">
          <li>
            <h4>下单金额</h4>
            <h6>有效订单的总金额(元)</h6>
            <h2 class="xdje" id="count-number"   data-speed="1500"></h2>
          <li>
            <h4>下单会员数</h4>
            <h6>有效订单的下单会员总数</h6>
            <h2 class="xdhys" id="count-number"  data-speed="1500"></h2>
          </li>
          <li>
            <h4>下单量</h4>
            <h6>有效订单的总数量</h6>
            <h2 class="xdl" id="count-number" data-speed="1500"></h2>
          </li>
          <li>
            <h4>下单商品数</h4>
            <h6>有效订单包含的商品总数量</h6>
            <h2  class="xdsps" id="count-number" data-speed="1500"></h2>
          </li>
          <li>
            <h4>平均价格</h4>
            <h6>有效订单包含商品的平均单价（元）</h6>
            <h2 class="pjjj" id="count-number"  data-speed="1500"></h2>
          </li>
          <li>
            <h4>平均客单价</h4>
            <h6>有效订单的平均每单的金额（元）</h6>
            <h2 class="pjkdj" id="count-number" data-speed="1500"></h2>
          </li>
          <li>
            <h4>新增会员</h4>
            <h6>期间内新注册会员总数</h6>
            <h2 class="xzhy" id="count-number" data-speed="1500"></h2>
          </li>
         <!--  <li title="会员数量：<?php echo $output['statnew_arr']['membernum'];?>0"> -->
          <li>
            <h4>会员数量</h4>
            <h6>平台所有会员的数量</h6>
            <h2 class="hysl" id="count-number" data-speed="1500"></h2>
          </li>
          <li>
            <h4>新增店铺</h4>
            <h6>期间内新注册店铺总数</h6>
            <h2 class="xzdp" id="count-number" data-speed="1500"></h2>
          </li>
          <li>
            <h4>店铺数量</h4>
            <h6>平台所有店铺的数量</h6>
            <h2 class="dpsl" id="count-number" data-speed="1500"></h2>
          </li>
          <li>
            <h4>新增商品</h4> 
            <h6>期间内新增商品总数</h6>
            <h2 class="xzsp" id="count-number" data-speed="1500"></h2>
          </li>
          <li>
            <h4>商品数量</h4>
            <h6>平台所有商品的数量</h6>
            <h2 class="spsl" id="count-number"  data-speed="1500" ></h2>
          </li>
        </ul>
    </dl>
  </div>
  <div class="ncap-stat-chart">
    <div class="title">
      <h3><?php echo @date('Y-m-d',strtotime("-1 day"));?>销售走势</h3>
    </div>
    <div id="container" class=" " style="height:400px"></div>
  </div>
  <div style="width:49%; margin-right:1%; float: left;">
    <table class="flex-table">
      <thead>
        <tr>
          <th width="24" align="center" class="sign"><i class="ico-check"></i></th>
          <th width="60" align="center" class="handle-s">操作</th>
          <th width="60" align="center">序号</th>
          <th width="120" align="left">店铺名称</th>
          <th width="60" align="center">下单金额</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
   
        <tr>
          <td class="sign"><i class="ico-check"></i></td>
          <td class="handle-s"><span>--</span></td>
          <td>1</td>
          <td>user</td>
          <td>50</td>
          <td class="a"></td>
        </tr>
        <tr>
          <td class="no-data" colspan="100"><i class="fa fa-exclamation-triangle"></i>1</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div style="width:50%; float: left;">
    <table class="flex-table2">
      <thead>
        <th width="24" align="center" class="sign"><i class="ico-check"></i></th>
        <th width="60" align="center" class="handle-s">操作</th>
        <th width="60" align="center">序号</th>
        <th width="250" align="left">商品名称</th>
        <th width="60" align="center">销量</th>
        <th></th>
          </thead>
      <tbody>
        <tr>
          <td class="sign"><i class="ico-check"></i></td>
          <td class="handle-s"><span>--</span></td>
          <td>1</td>
          <td><a href= target="_blank">user</a></td>
          <td>50</td>
          <td></td>
        </tr>
        <tr>
          <td class="no-data" colspan="100"><i class="fa fa-exclamation-triangle"></i>1</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
      <script src="<?= $this->view->js_com ?>/plugins/cs/jquery.js"></script> 
  <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
  <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
  <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/cs/highcharts.js" charset="utf-8"></script>
  <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/cs/flexigrid.js" charset="utf-8"></script> 
<script>
$(function () {

   var SITE_URLs = SITE_URL.replace('_admin','');
  // alert(SITE_URLs + '?ctl=Api_User_Sta&met=info&typ=json');
       $.ajax({
            url: SITE_URLs + '?ctl=Api_Seller_Gr&met=info&typ=json',
            data: '',
            type: 'POST',  
            success: function(e) {
            $('#container').highcharts(e.data);
            }
        });
       // alert(SITE_URLs + '?ctl=Api_Seller_Gr&met=count&typ=json')
         $.ajax({
            url: SITE_URLs + '?ctl=Api_Seller_Gr&met=count&typ=json',
            data: '',
            type: 'POST',  
            success: function(e) {
             $('.xdje').html(e.data.order_num);
             $('.xdhys').html(e.data.order_user);
             $('.xdl').html(e.data.order_place);
             $('.pjkdj').html(e.data.order_shop);
             $('.pjjj').html(e.data.order_mean);
             $('.hysl').html(e.data.user_num);
             $('.spsl').html(e.data.goods_num);
             $('.dpsl').html(e.data.shop_num);
             $('.xzhy').html(e.data.new_user);
             $('.xzsp').html(e.data.new_goods);
             $('.xzdp').html(e.data.create_shop);
             $('.xdsps').html(e.data.order_goods);
             var mount = e.data.orderamount;
             var str='';
            $.each(mount, function (k, v) {
            str+= '<td class="sign"><i class="ico-check"></i></td>';
            str+='<td class="handle-s"><span>--</span></td>';
            str+='<td class="handle-s">1</td>';
            str+='<td class="handle-s">1</td>';
            str+='<td class="handle-s">1</td>';
            })
           }
        });
    //同步加载flexigrid表格
    $('.flex-table').flexigrid({
        height:'auto',// 高度自动
        usepager: false,// 不翻页
        striped:false,// 不使用斑马线
        resizable: false,// 不调节大小
        reload: false,// 不使用刷新
        columnControl: false,// 不使用列控制
        title:'7日内店铺销售TOP30'
        });
    $('.flex-table2').flexigrid({
        height:'auto',// 高度自动
        usepager: false,// 不翻页
        striped:false,// 不使用斑马线
        resizable: false,// 不调节大小
        reload: false,// 不使用刷新
        columnControl: false,// 不使用列控制
        title:'7日内商品销售TOP30'
        });

 
});
</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>



