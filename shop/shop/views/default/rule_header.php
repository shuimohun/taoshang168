<?php if (!defined('ROOT_PATH')){exit('No Permission');}
include $this->view->getTplPath() . '/' . 'site_nav.php';
?>

<div class="wrap">
	<div class="head_cont">
		<div style="clear:both;"></div>
		<div class="nav_left">
            <a href="<?=YLB_Registry::get('url')?>" class="logo"><img src="<?php if(Web_ConfigModel::value('subsite_is_open') && isset($_COOKIE['sub_site_logo']) && $_COOKIE['sub_site_logo']!='' && isset($_COOKIE['sub_site_id']) && $_COOKIE['sub_site_id'] > 0){echo $_COOKIE['sub_site_logo'];}else{echo @$this->web['web_logo'];} ?>"/></a>
			<a href="#" class="download iconfont"></a>
		</div>
		<div class="nav_right clearfix" >

		</div>
		<div style="clear:both;"></div>
	</div>

</div>

<input id="shop_id" type="hidden" value="<?=$this->shop_id?>">
<div class="J-global-toolbar"></div>
