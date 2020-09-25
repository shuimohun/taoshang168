<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>


<div class="tabmenu">
    <ul>
        <li class="active bbc_seller_bg"><a href="javascript:;">店铺概况</a></li>
       
    </ul>
</div>
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/seller_center.css"/>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/echarts/echarts.min.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/echarts/highcharts.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/echarts/flexigrid.js" charset="utf-8"></script>
<script <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/dateRange/dateRange.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?=$this->view->js_com?>/plugins/dateRange/dateRange.css" />

<div id="mainContent">
    <div class="alert1 alert mt10" style="clear:both;">
        <ul class="mt5">
            <li>1、符合以下任何一种条件的订单即为有效订单：1）采用在线支付方式支付并且已付款；2）采用货到付款方式支付并且交易已完成</li>
            <li>2、以下关于订单和订单商品统计数据的依据为：从所选时间段内的有效订单，最大可查31天</li>
        </ul>
    </div>
    <div class="right_content_title">
        <div class="ta_date" id="div_date1" style="float: right;margin-right: 20px;">
            <span class="date_title" id="date1"></span>

            <a class="opt_sel" id="input_trigger1" href="#"><i class="i_orderd" style='margin-top: 10px;'></i></a>
        </div>
        <script type="text/javascript">
            //            alert("<?//=$this->view->js_com?>//");
            var dateRange1 = new pickerDateRange('date1', {
                isTodayValid : true,
                startDate : '<?php echo $start_date;?>',
                endDate : '<?php echo $end_date;?>',
                needCompare : false,
                defaultText : ' 至 ',
                autoSubmit : true,
                inputTrigger : 'input_trigger1',
                theme : 'ta',
                success : function(obj) {
                    $('.right_content').html('<div class="loading"></div>');
                    var start_time = new Date(obj.startDate+' 00:00:00');
                    var end_time = new Date(obj.endDate+' 00:00:00');
                    var time_diff = start_time.getTime()-end_time.getTime();
                    if(time_diff > 0){
                        var startDate = obj.startDate;
                        var endDate = obj.startDate;
                    }else{
                        time_diff = time_diff*(-1);
                        var startDate = obj.startDate;
                        var endDate = obj.endDate;
                    }
                    var days = Math.floor(time_diff/(24*3600*1000));
                    if(days > 30){
                        alert('时间范围不能超过31天');
                        window.location.reload();
                    }else{
                        var url = "<?=YLB_Registry::get('base_url').'/index.php?ctl=Seller_Analysis_General&met=index&typ=e&sdate='?>"+startDate+"&edate="+endDate;
                        window.location.href = url;
                    }

                }
            });
        </script>
    </div>
    <div class="alert alert-info mt10" style="clear:both;">

        <ul class="mt5">
            <li>
    	<span class="w210 fl h30" style="display:block;">
            <i title="店铺<?=$start_date;?>至<?=$end_date;?>有效订单的总金额" class="tip icon-question-sign"></i>
    		下单金额：<strong><?= format_money($total['order_goods_amount']) ?></strong>
    	</span>
		<span class="w210 fl h30" style="display:block;">
			<i title="店铺<?=$start_date;?>至<?=$end_date;?>有效订单的会员总数" class="tip icon-question-sign"></i>
			下单会员数：<strong><?= $total['order_user_num'] ? $total['order_user_num'] : 0  ?></strong>
		</span>
		<span class="w210 fl h30" style="display:block;">
			<i title="店铺<?=$start_date;?>至<?=$end_date;?>有效订单的总订单数" class="tip icon-question-sign"></i>
			下单量：<strong><?= $total['order_goods_count'] ? $total['order_goods_count'] : 0 ?></strong>
		</span>
		<span class="w210 fl h30" style="display:block;">
			<i title="店铺<?=$start_date;?>至<?=$end_date;?>有效订单的总商品数量" class="tip icon-question-sign"></i>
			下单商品数：<strong><?= $total['order_goods_num'] ? $total['order_goods_num'] : 0 ?></strong>
		</span>
            </li>
            <li>
    	<span class="w210 fl h30" style="display:block;">
    		<i title="店铺从昨天开始最近30天有效订单的平均每个订单的交易金额" class="tip icon-question-sign"></i>
    		平均客单价：<strong><?= format_money(@$total['general_user_cash']) ?></strong>
    	</span>
    	<span class="w210 fl h30" style="display:block;">
    		<i title="店铺从昨天开始最近30天有效订单商品的平均每个商品的成交价格" class="tip icon-question-sign"></i>
    		平均价格：<strong><?= format_money(@$total['general_cash']) ?></strong>
    	</span>
    	<span class="w210 fl h30" style="display:block;">
    		<i title="店铺所有商品的总收藏次数" class="tip icon-question-sign"></i>
    		商品总收藏量：<strong><?= $total['sql_goods_like'] ?></strong>
    	</span>
    	<span class="w210 fl h30" style="display:block;">
    		<i title="店铺总收藏次数" class="tip icon-question-sign"></i>
    		店铺总收藏量：<strong><?= $total['sql_shop_like'] ?></strong>
    	</span>
    	<span class="w210 fl h30" style="display:block;">
    		<i title="店铺拥有商品的总数（仅计算商品种类，不统计库存）" class="tip icon-question-sign"></i>
    		商品总数：<strong><?= $total['goods_count'] ?></strong>
    	</span>
                <span class="w210 fl h30" style="display:block;">
    		<i title="店铺拥有商品的总数（仅计算商品种类，不统计库存）" class="tip icon-question-sign"></i>
    		仓库未上架：<strong><?=  $total['goods_count_n'] ?></strong>
    	</span>
            </li>

            </li>
        </ul>
        <div style="clear:both;"></div>
    </div>

<div class="right_content">

	
	<div style="position: relative;float: left;padding-top: 40px;padding-left: 20px;">
        <ul class="tab-base nc-row" style="margin-left:20px">
            <li style="background: #D4D4D4;float:left;margin-left:5px;height:30px;width: 90px;"><a style="text-align:center;line-height:30px;margin-left: 10px;" href="#goodsnum_div" nc_type="showdata" data-param='{"type":"goodsnum"}'>每日订单数据</a></li>
            <li style="background: #D4D4D4;float:left;margin-left:20px;height:30px;width: 90px;"><a style="text-align:center;line-height:30px;margin-left: 10px;" href="#orderamount_div" nc_type="showdata" data-param='{"type":"orderamount"}'>每日订单金额</a></li>
        </ul>
        
	</div>
	 <div id="container" style="height: 300px;width: 100%;padding-top: 90px;"></div>
    <script>
              function  getStatdata(type){
                    $.ajax({
                        url: "<?=YLB_Registry::get('base_url') .'/index.php?ctl=Api_Seller_Goods&met=order_detil&typ=json&type='?>"+type,
                        data: '',
                        success: function (e) {
                            $('#container').highcharts(e.data);
                        }
                    })
                }
                $(function () {
                    getStatdata('orderamount');
                    var str = '';
                    $("[nc_type='showdata']").click(function(){
                        var data_str = $(this).attr('data-param');
                        eval('data_str = '+data_str);
//                        alert(data_str.type)
                        getStatdata(data_str.type);
                    });
                });
    </script>
<!--<script type="text/javascript">
data1 = true;
data2 = false;
function createChart(name){
	if($('#'+name).is(':checked')) {
		if(name == 'data1'){
            data1 = true;
        }
		if(name == 'data2'){
            data2 = true;
        }
	}else{
		if(name == 'data1'){
            data1 = false;
        }
		if(name == 'data2'){
            data2 = false;
        }
	}
	echartsall();
}

function echartsall(){
	/*   图表样式  */
	var myChart = echarts.init(document.getElementById('container'));
	option = {
		tooltip: {
			trigger: 'axis'
		},
		toolbox: {
			feature: {
				dataView: {readOnly: false},
				magicType: {type: ['line', 'bar']},
				restore: {},
				saveAsImage: {}
			}
		},
		legend: {
			selected: {
					'每日订单金额': data1,
					'每日订单数据': data2
				},
			bottom: 20
		},
		grid: {
			top: 50,
			right: 20,
			bottom: 80
		},
		xAxis: {
			axisLabel:{
				rotate: 45,
				interval: 0
			},
			axisLine:{
				show: false
			},
			axisTick:{
				interval: 0
			},
			splitLine: {
				show: false
			},
			data: <?php echo $data['x_data'];?>
		},
		yAxis: {
			axisLine:{
				show: false
			},
			axisTick:{
				show: false
			}
		},
		series: [
			{
				name: '每日订单金额',
				type: 'line',
				data: <?php echo $data['y_data_cost'];?>
			},
			{
				name: '每日订单数据',
				type: 'line',
				data: <?php echo $data['y_data_num'];?>
			}
		]
	};
	myChart.setOption(option);
}
echartsall();
	
</script>-->
</div>

    <div class="fl mr50" style="width: 100%;">
        <div class="alert alert-info" style="margin-bottom:0px;    padding: 12px 35px 12px 15px;"><strong>建议推广商品</strong>
            &nbsp;<i title="统计店铺从昨天开始7日内热销商品前30名，建议推广以下商品，提升推广回报率" class="tip icon-question-sign"></i>
        </div>
        <table class="table-list-style table-promotion-list">
            <thead>
            <tr class="sortbar-array">
                <th class="align-center w100">序号</th>
                <th class="align-center">商品名称</th>
                <th class="align-center w200">销量</th>
            </tr>
            </thead>
            <tbody id="datatable">
            <?php if (empty($goods_list))
            { ?>
                <tr>
                    <td colspan="20" class="norecord">
                       <div class="no_account"> <img src="<?=$this->view->img?>/ico_none.png"><p>暂无符合条件的数据记录</p></div>
                    </td>
                </tr>
            <?php }
            else
            {
                foreach ($goods_list as $k => $v)
                {
                    ?>
                    <tr>
                        <td class="align-center"><?= ($k + 1) ?></td>
                        <td class="align-center"><?= $v['goods_name'] ?></td>
                        <td class="align-center"><?= $v['order_goods_num'] ?></td>
                    </tr>
                <?php }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>



