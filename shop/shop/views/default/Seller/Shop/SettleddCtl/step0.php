
<?php
include $this->view->getTplPath() . '/' . 'join_header.php';
?>


<script type="text/javascript" src="<?=$this->view->js?>/Touch.js"></script>
<div class="main">
		<div class="modular-select">
			<h2 class="index-title">选择个人或者企业商家入驻</h2>
			<ul class="settled-object">
				<li>
					<div>
						<i class="iconfont icon-icon_geren"></i>
						<p>个人入驻</p>
					</div>
					<a href="index.php?ctl=Seller_Shop_Settled&met=index&op=step1&apply=1" class="btn btn-apply">立即申请></a>
				</li>
				<li>
					<div>
						<i class="iconfont icon-icon_qiye"></i>
						<p>企业入驻</p>
					</div>
					<a href="index.php?ctl=Seller_Shop_Settled&met=index&op=step1&apply=2" class="btn btn-apply">立即申请</a>
				</li>
			</ul>
		</div>
	</div>
<div class="indextip">
  <div class="container"> <span class="title"> <i class="iconfont icon-laba"></i>
    <h3> 贴心提示</h3>
    </span>
    <span class="content"> <?=Web_ConfigModel::value('join_tip')?></span>
    </div>
</div>
<div class="main mt30">
  <h2 class="index-title"> 入驻流程</h2>
  <div class="joinin-index-step"> <span class="step"> <i class="iconfont icon-shangjiaruzhushenqing"></i>签署入驻协议 </span> <span class="arrow"></span> <span class="step"> <i class="iconfont icon-xinxitijiao"></i>商家信息提交 </span> <span class="arrow"></span> <span class="step"> <i class="iconfont icon-pingtaishenhe"></i>平台审核资质</span> <span class="arrow"></span> <span class="step"> <i class="iconfont icon-jiaonafeiyong"></i>商家缴纳费用</span> <span class="arrow"></span> <span class="step"> <i class="iconfont icon-dianpu2"></i>店铺开通</span> </div>
  <h2 class="index-title">入驻指南</h2>
  <div class="joinin-info">
    <ul class="tabs-nav">
       <?php foreach ($shop_help as $key => $value) {

        ?>
      <li class="<?php if($key==96){echo "tabs-selected";}?>">
        <h3><?=$value['help_title']?></h3>
      </li>

       <?php }?>
    </ul>
    <?php foreach ($shop_help as $key => $value) {

        ?>
    <div class="tabs-panel <?php if($key!=96){?>tabs-hide<?php }?>">
        <?=$value['help_info']?>
    </div>
    <?php }?>
  </div>
</div>

<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>
</body>
</html>