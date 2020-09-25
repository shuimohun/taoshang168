<?php if (!defined('ROOT_PATH')){exit('No Permission');}?><!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=1280, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta name="renderer" content="webkit">
	<title>商城系统管理中心</title>

    <meta name="renderer" content="webkit|ie-stand|ie-comp">
    <meta name="renderer" content="webkit">

	<link href="<?= $this->view->css ?>/iconfont/iconfont.css" rel="stylesheet" type="text/css">
	<link href="<?= $this->view->css ?>/ui.min.css?ver=20140430" rel="stylesheet">
	<link href="<?= $this->view->css ?>/common.css?ver=20140430" rel="stylesheet" type="text/css">
	<script src="<?= $this->view->js_com ?>/jquery-1.11.3.min.js"></script>
	<script src="<?= $this->view->js_com ?>/json2.js"></script>
	<script src="<?= $this->view->js_com ?>/plugins.js?ver=20140430"></script>
	<script src="<?= $this->view->js_com ?>/plugins/jquery.dialog.js?ver=20140430"></script>
	<script src="<?= $this->view->js_com ?>/plugins/grid.js?ver=20140430"></script>
	<script src="<?= $this->view->js ?>/models/common.js?ver=20140430"></script>
	<script src="<?= $this->view->js ?>/models/config.js?ver=20140430"></script>
    <script src="<?= $this->view->js_com ?>/iealert.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?= $this->view->css_com ?>/iealert/style.css" />
    
	<script type="text/javascript">
		var BASE_URL = "<?=YLB_Registry::get('base_url')?>";
		var SITE_URL = "<?=YLB_Registry::get('url')?>";
		var INDEX_PAGE = "<?=YLB_Registry::get('index_page')?>";
		var STATIC_URL = "<?=YLB_Registry::get('static_url')?>";
		var SHOP_URL =  "<?=YLB_Registry::get('shop_api_url')?>";
		var DOMAIN = document.domain;
		var WDURL = "";
		var SCHEME = "default";
		var SYSTEM = SYSTEM || {};
		SYSTEM.skin = 'green';
		SYSTEM.isAdmin = true;
		SYSTEM.siExpired = false;
	</script>