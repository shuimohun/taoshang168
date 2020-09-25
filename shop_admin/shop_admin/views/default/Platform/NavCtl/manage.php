<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/'  . 'header.php';
?>
<link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
<link href="<?= $this->view->css_com ?>/webuploader.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
<style>
</style>
</head>
<body>
<form id="article_form" method="post">
    <div class="ncap-form-default">
        <dl class="row">
        <dt class="tit">
          <label for="nav_type"><em>*</em>导航类型</label>
        </dt>
        <dd class="opt">
          <input type="radio" name="nav_type" id="nav_type_0" checked="checked" value="0" >自定义导航
          <input type="radio" name="nav_type" id="nav_type_1" value="1" >商品分类
          <input type="radio" name="nav_type" id="nav_type_2" value="2" >文章导航
          <input type="radio" name="nav_type" id="nav_type_3" value="3" >活动导航
          <p class="notic"></p>
        </dd>
        </dl>
        <dl class="row">
            <dt class="tit">
                <label for="nav_s_type"><em>*</em>网站类型</label>
            </dt>
            <dd class="opt">
                <input type="radio" name="site_type" id="site_type_0" checked="checked" value="0" >主站
                <input type="radio" name="site_type" id="site_type_1" value="-1" >供应商
                <input type="radio" name="site_type" id="site_type_2" value="-2" >自营超市
                <input type="radio" name="site_type" id="site_type_3" value="-3" >生鲜特产
                <p class="notic"></p>
            </dd>
        </dl>
        <dl class="row">
        <dt class="tit">
            <label><em>*</em>标题:</label>
        </dt>
        <dd class="opt">
                <input type="text" value="" name="nav_title" id="nav_title" class="ui-input">
              <span class="err"></span>
              <p class="notic"></p>
        </dd>
        </dl>
        <dl class="row">
        <dt class="tit">
          <label for="nav_url">链接</label>
        </dt>
        <dd class="opt">
          <input type="text" value="http://" name="nav_url" id="nav_url" class="ui-input">
          <span class="err"></span>
        </dd>
        </dl>
        <dl class="row">
        <dt class="tit">
          <label for="nav_location">显示位置</label>
        </dt>
        <dd class="opt">
          <input type="radio" name="nav_location" id="nav_location_0" checked="checked" value="0" >头部
            <!--<input type="radio" name="nav_location" id="nav_location_1" value="1" >中部-->
          <input type="radio" name="nav_location" id="nav_location_2" value="2" >底部
          <p class="notic"></p>
        </dd>
        </dl>
        <dl class="row">
        <dt class="tit">
          <label for="if_show">是否新窗口打开:</label>
        </dt>
        <dd class="opt">
          <div class="onoff">
            <label for="nav_new_open1" class="cb-enable  ">是</label>
            <label for="nav_new_open0" class="cb-disable  selected">否</label>
            <input id="nav_new_open1"  name ="nav_new_open"  value="1" type="radio">
            <input id="nav_new_open0"  name ="nav_new_open"  checked="checked"  value="0" type="radio">
          </div>
          <p class="notic"></p>
        </dd>
        </dl>
        <dl class="row">
        <dt class="tit">
          <label for="if_show">是否启用:</label>
        </dt>
        <dd class="opt">
          <div class="onoff">
            <label for="nav_active1" class="cb-enable  selected">是</label>
            <label for="nav_active0" class="cb-disable">否</label>
            <input id="nav_active1"  name ="nav_active"  checked="checked" value="1" type="radio">
            <input id="nav_active0"  name ="nav_active"  value="0" type="radio">
          </div>
          <p class="notic"></p>
        </dd>
        </dl>
        <dl class="row">
        <dt class="tit">排序</dt>
        <dd class="opt">
          <input type="text" value="" name="nav_displayorder" id="nav_displayorder" class="ui-input">
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
        </dl>
    </div>
  </form>
<script type="text/javascript" src="<?=$this->view->js?>/controllers/platform/nav_manage.js" charset="utf-8"></script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>