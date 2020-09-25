<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
} ?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>
	<!-- 环状统计图 -->
	<!--<link rel="stylesheet" type="text/css" href="<?/*=$this->view->css*/?>/circliful.css">

	<script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>-->
	<!--<script src="<?/*=$this->view->js*/?>/jquery.circliful.min.js"></script>-->
    <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/echarts/echarts.js"></script>

<div class="pc_user_about wrap">
	<h4><?=_('财富概况')?></h4>
	<div class="pc_user_mes clearfix">
		<div class="pc_user_mes_lf fl clearfix">
			<p class="pc_user_mes_lf_img fl"><img src="<?=_($user_info['user_avatar'])?>"></p>
			<div class="pc_user_mes_lf_text fr">
				<dl class="clearfix">
					<dt><i class="iconfont icon-yonghuming"></i><?=_('用户名称')?></dt>
					<dd><?=$user_info['user_nickname']?></dd>
				</dl>
				<?php if(!empty($user_info['user_mobile'])){?>
				<dl class="clearfix">
					<dt><i class="iconfont icon-shoujihao"></i><?=_('手机号码')?></dt>
					<dd><?=$user_info['user_mobile']?></dd>
				</dl>
				<?php }?>
				<?php if(!empty($user_info['user_email'])){?>
				<dl class="clearfix">
					<dt><i class="iconfont icon-youxiang"></i><?=_('绑定邮箱')?></dt>
					<dd><?=$user_info['user_email']?></dd>
				</dl>
				<?php }?>
				<dl class="clearfix">
					<dt><i class="iconfont icon-shangcidenglushijian"></i><?=_('上次登录时间')?></dt>
					<dd><?=$user_base['user_login_time']?></dd>
				</dl>

			</div>
		</div>
        <div class="pc_user_mes_lf fl clearfix" style="  margin-top: 40px;">
            <div class="pc_user_mes_lf_text fr">
                <dl class="clearfix" style="border:none;">
                    <dt><?=(format_money($price))?></dt>
                </dl>
                <dl class="clearfix">
                    <dt><i class="iconfont icon-share_shengqian"></i><?=_('惠省钱')?></dt>

                </dl>
            </div>
        </div>
		<div class="pc_user_mes_rt fr clearfix">
			<div class="pc_user_mes_rt_percent fl">
				<div id="myStat2" data-dimension="100%" data-text="" data-info="" data-width="15" data-fontsize="38" data-percent="<?=$data_percent?>" data-fgcolor="#FFC24D" data-bgcolor="#4DCEFF" data-part="10" data-total="100"></div>
                <div id="main-container">
                    <div id="main" style="height:140px;"></div>
                    <script type="text/javascript">
                        // 路径配置
                        require.config({
                            paths: {
                                echarts: 'http://echarts.baidu.com/build/dist'
                            }
                        });

                        // 使用
                        require(
                            [
                                'echarts',
                                'echarts/chart/pie' // 使用柱状图就加载bar模块，按需加载
                            ],
                            function (ec) {
                                // 基于准备好的dom，初始化echarts图表
                                var myChart = ec.init(document.getElementById('main'));

                                option = {
                                    tooltip : {
                                        show:false,
                                        trigger: 'item',
                                        formatter: "{a} <br/>{b} : {c} ({d}%)"
                                    },
                                    series : [
                                        {
                                            name:'账户财产',
                                            type:'pie',
                                            radius : ['50%', '70%'],
                                            itemStyle : {
                                                normal : {
                                                    label : {
                                                        show : false
                                                    },
                                                    labelLine : {
                                                        show : false
                                                    },
                                                    color: function(params) {
                                                        var colorList = [
                                                            '#4dceff','#ffc24d','#e45050','#E87C25'
                                                        ];
                                                        return colorList[params.dataIndex]
                                                    },
                                                }
                                            },
                                            data: <?=($user_resource_data)?>
                                        }
                                    ]
                                };

                                // 为echarts对象加载数据
                                myChart.setOption(option);
                            }
                        );
                    </script>
                </div>
                <p class="pc_account"><?=_('账户总财产：')?><span><?=(format_money($user_money_total))?></span></p>
			</div>
			<div class="pc_user_mes_rt_text fl">
				<dl class="clearfix dl-public">
					<dt><span class="pc_col_reprens bgb"></span><?=_('账户余额：')?></dt>
					<dd><?=(format_money($user_resource['user_money']))?></dd>
				</dl>
				<dl class="clearfix dl-public">
					<dt class="dt_pad"><span class="pc_col_reprens bgy"></span><?=_('卡余额')?><i>：</i></dt>
					<dd><?=(format_money($user_resource['user_recharge_card']))?></dd>
				</dl>
				<dl class="clearfix dl-public">
					<dt><span class="pc_col_reprens bgr"></span><?=_('冻结资金：')?></dt>
					<dd><?=(format_money($user_resource['user_money_frozen']))?></dd>
				</dl>
                <dl class="clearfix dl-public">
                    <dt><span class="pc_col_reprens fxj"></span><?=_('冻结分享金：')?></dt>
                    <dd><?=(format_money($user_resource['user_share_money_frozen']))?></dd>
                </dl>
				<dl class="clearfix pc_a_btn dl-public">
					<dd><a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Info&met=deposit&typ=e" class="pc_btn"><?=_('充值')?></a></dd>
					<dd><a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Info&met=withdraw&typ=e" class="pc_btn btn_active"><?=_('提现')?></a></dd>
					<dd><a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Info&met=transfer&typ=e" class="pc_btn"><?=_('转账')?></a></dd>
				</dl>
			</div>
		</div>
	</div>
</div>

<div class="pc_transaction wrap">
	<h4><?=_('最近交易')?><span class="trade_types"><a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Info&met=recordlist&type=3&typ=e" ><?=_('充值记录')?></a>&nbsp;|&nbsp;<a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Info&met=recordlist&type=2&typ=e" ><?=_('转账记录')?></a>&nbsp;|&nbsp;<a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Info&met=recordlist&type=4&typ=e" ><?=_('提现记录')?></a></span></h4>
	
	<div class="pc_table_head clearfix">
		<p class="pc_trans_time"><span><?=_('创建时间')?></span></p>
		<p class="pc_trans_other">
			<span class="pc_table_num"><?=_('名称')?>&nbsp;|&nbsp;<?=_('对方')?>&nbsp;|&nbsp;<?=_('交易号')?></span><span class="wp20"><?=_('金额')?></span><span class="wp20"><?=_('状态')?></span><span class="wp20"><?=_('操作')?></span>
		</p>
	</div>
	<?php foreach($consume_record_list['items'] as $conkey => $conval){?>
	<div class="pc_trans_lists clearfix">
		<div class="pc_trans_time pc_trans_det_time"><?=($conval['record_time'])?></div>
		<div class="pc_trans_det pc_trans_other">
			<p class="pc_table_num"><span><?=($conval['record_title'])?></span><span class="jyh"><?=_('交易号:')?><?=($conval['order_id'])?></span></p>
			<p class="wp20">
				<span class="textcolor">
						<?=(format_money($conval['record_money']))?>
				</span>
			</p>
			<p class="wp20"><span><?=($conval['record_status_con'])?></span></p>
			<p class="wp20">
				<?php if($conval['act'] == 'pay'){ ?>
					<a href="<?=YLB_Registry::get('url')?>?ctl=Info&met=pay&uorder=<?=$conval['uorder']?>" class="cb"><?=_('付款')?></a><a></a>
				<?php }else{ ?>
					<a href="<?=YLB_Registry::get('url')?>?ctl=Info&met=recorddetail&id=<?=$conval['consume_record_id']?>" class="cb"><?=_('详情')?></a><a></a>
			<?php } ?>
			</p>
		</div>
	</div>
	<?php }?>
	<div class="pc_trans_btn"><a href="<?=YLB_Registry::get('url')?>?ctl=Info&met=recordlist" class="btn_big btn_active"><?=_('查看更多账单')?></a></div>
</div>

<!--	<script>
		$( document ).ready(function() {
			$('#myStat2').circliful();
		});
	</script>-->

<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>