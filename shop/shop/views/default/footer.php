<div class="footer">
	<div class="wrapper">
        <?php if(!$this->ctl =="Seller_Shop_Settled"){ ?>
            <div class="promise">
                <div><span class="iconfont icon-qitiantuihuan bbc_color"></span><strong class="bbc_color">七天退货</strong></div>
                <div><span class="iconfont icon-iconzhengping bbc_color"></span><strong class="bbc_color">正品保障</strong></div>
                <div><span class="iconfont icon-iconshandian bbc_color"></span><strong class="bbc_color">闪电发货</strong></div>
                <div><span class="iconfont icon-iconbaoyou bbc_color"></span><strong class="bbc_color">满额免邮</strong></div>
            </div>
        <?php } ?>
		<ul class="services clearfix">
			<?php if (!empty($this->foot)):$i = 1;foreach ($this->foot as $key => $value):?>
                <li>
                    <h5><i class="iconfont icon-weibu<?=$i?>"></i><span><?= $value['group_name'] ?></span></h5>
                    <?php if (!empty($value['help'])): foreach ($value['help'] as $k => $v):?>
                        <?php if(!empty($v['help_url'])){ ?>
                            <p><a href="<?= $v['help_url'] ?>">&bull;&nbsp;<?= $v['help_title'] ?></a></p>
                        <?php }else{ ?>
                            <p><a href="<?=YLB_Registry::get('url')?>?ctl=Help&met=ruleDetail&id=<?= $v['help_id'] ?>">&bull;&nbsp;<?= $v['help_title'] ?></a></p>
                        <?php } ?>
                    <?php endforeach; endif;?>
                </li>
            <?php $i++;endforeach;endif; ?>
		</ul>
		<p class="about">
            <?php if(isset($this->bnav) && $this->bnav){foreach ($this->bnav['items'] as $key => $nav) {if($key<10){?>
                <a href="<?=$nav['nav_url']?>" <?php if($nav['nav_new_open']==1){?>target="_blank"<?php } ?>><?=$nav['nav_title']?></a>
            <?php }else{return;}}} ?>
		</p>
        <p class="copyright"><?php if(!empty($_COOKIE['sub_site_id']) && Web_ConfigModel::value("subsite_is_open") == Sub_SiteModel::SUB_SITE_IS_OPEN  && isset($_COOKIE['sub_site_copyright'])){ echo $_COOKIE['sub_site_copyright'];}else{ echo  Web_ConfigModel::value('copyright');} ?></p>
		<p class="statistics_code"><?php echo Web_ConfigModel::value('icp_number') ?></p>
	</div>
</div>

<div id='im_ajax_load1'></div>

<link rel="stylesheet" href="<?= $this->view->css_com ?>/jquery/plugins/dialog/green.css" >
<script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/jquery.ui.js"></script>
<script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/jquery.dialog.js"></script>
<script type="text/javascript" src="<?= $this->view->js_com ?>/respond.js"></script>

<p style="text-align: center">
    <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspanid='cnzz_stat_icon_1271292925'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s13.cnzz.com/z_stat.php%3Fid%3D1271292925%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script>
</p>

<p class="statistics_code">
    <script src="https://s95.cnzz.com/z_stat.php?id=1260564845&web_id=1260564845" language="JavaScript"></script>
</p>

<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?e648437aa7f93c55b0816791681a76bf";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
</body>
</html>