<div class="footer">
	<div class="wrapper">
		<p class="copyright"><?=Web_ConfigModel::value('copyright')?></p>
		<p class="statistics_code"><?php echo Web_ConfigModel::value('icp_number') ?></p>
		<p class="statistics_code"><?php echo Web_ConfigModel::value('statistics_code') ?></p>
	</div>
</div>

<script>
	$(function(){
		ucenterLogin(UCENTER_URL, SITE_URL, true);
	});
</script>
</body>

</html>