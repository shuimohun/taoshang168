<script type="text/javascript" src="<?=$this->view->js?>/gold.js"></script>
<script type="text/javascript" src="<?=$this->view->js?>/order.js"></script>


<div id='im_ajax_load1'></div>



<script type="text/javascript" src="<?=$this->view->js ?>/base.js"></script>
<script type="text/javascript" src="<?=$this->view->js ?>/buyer.js"></script>
<script type="text/javascript" src="<?=$this->view->js ?>/order.js"></script>
<script type="text/javascript" src="<?=$this->view->js ?>/alert.js"></script>
<script type="text/javascript" src="<?= $this->view->js_com ?>/template.js"></script>
<link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">


<script type="text/javascript" src="<?=$this->view->js_com ?>/plugins/jquery.datetimepicker.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com ?>/plugins/jquery.toastr.min.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com ?>/plugins/jquery.cookie.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com ?>/plugins/jquery.slideBox.min.js" ></script>
<script type="text/javascript" src="<?=$this->view->js_com ?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com ?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com ?>/plugins/jquery.ui.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com ?>/plugins/jquery.dialog.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.timeCountDown.js" ></script>
<script>
    $(function(){
        ucenterLogin(UCENTER_URL, SITE_URL, true);

        var _TimeCountDown = $(".fnTimeCountDown");
        _TimeCountDown.fnTimeCountDown();
    });
</script>

<div class="foot">
    <p class="about">
        <?php if($this->bnav){ foreach ($this->bnav['items'] as $key => $nav) { if($key<10){ ?>
            <a href="<?=$nav['nav_url']?>" <?php if($nav['nav_new_open']==1){?>target="_blank"<?php } ?>><?=$nav['nav_title']?></a>
        <?php }else{ return; }}} ?>
    </p>
    <p class="copyright">
        <?php if(!empty($_COOKIE['sub_site_id']) && Web_ConfigModel::value("subsite_is_open") == Sub_SiteModel::SUB_SITE_IS_OPEN  && isset($_COOKIE['sub_site_copyright'])){ echo $_COOKIE['sub_site_copyright'];}else{ echo  Web_ConfigModel::value('copyright');} ?>
    </p>
    <p class="statistics_code"><?php echo Web_ConfigModel::value('statistics_code') ?></p>
</div>

</body>
</html>