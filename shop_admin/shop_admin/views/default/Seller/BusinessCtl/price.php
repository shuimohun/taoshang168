<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
// var_dump($this->view->js_com);die;
include $this->view->getTplPath() . '/'  . 'header.php';
?>
<link href="<?= $this->view->css ?>/cs/index.css" rel="stylesheet" type="text/css">
</head>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
            <div class="subject">
                <h3>行业分析</h3>
                <h5>平台针对商品的各项数据统计</h5>
            </div>
        <ul class="tab-base nc-row">
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Business&met=business"><span>行业规模</span></a></li>
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Business&met=Industry"><span>行业排行</span></a></li>
            <li><a class="current"><span>价格分析</span></a></li>
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Business&met=survey"><span>概况总览</span></a></li>
        </ul>
        <div class="ncap-stat-chart">
            <div class="title">
                <h3>行业价格分布图</h3>
                <h5><a href="index.php?ctl=Seller_Gr&met=manage" class="ncap-btn">设置价格区间</a></h5>
            </div>
            <?php if ($output['pricerange_statjson']){ ?>
                <div id="container_pricerange" style="height:400px"></div>
            <?php } else { ?>
                <div class="no-date"><i class="fa fa-exclamation-triangle"></i>查看行业价格分布情况前，请先设置价格区间。<a href="index.php?ctl=Seller_Gr&met=manage" class="ncap-btn ncap-btn-orange">马上设置</a></div>
            <?php }?>
        </div>
     </div>
    </div>

</div>
<script type="text/javascript">
function delrow(i){
	$("#row_"+i).remove();
}
$(function(){
	var i = <?php echo count($output['list_setting']['stat_pricerange']); ?>;
	i += 1;
	var html = '';
	/*新增一行*/
	$('#addrow').click(function(){
		html = '<li id="row_'+i+'">';
		html += '<label>起始额：<input type="text" class="txt w100 mr5" name="pricerange['+i+'][s]" value="0"/>元</label>';
		html += '<label class="ml20 mr10">结束额：<input type="text" class="txt w100 mr5" name="pricerange['+i+'][e]" value="0"/>元</label>';
		html += '<label><a href="JavaScript:void(0);" onclick="delrow('+i+');" class="ncap-btn ncap-btn-red">删除</a></label></li>';
		$('#pricerang_table').find('ul').append(html);
		i += 1;
	});
	
	$('#ncsubmit').click(function(){
		var result = true;
		$("#pricerang_table").find("[name^='pricerange']").each(function(){
			if(!$(this).val()){
				result = false;
			}
		});
		if(result){
			$('#pricerangeform').submit();
		} else {
			showDialog('请将价格区间填写完整');
		}
    });
})
</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>
