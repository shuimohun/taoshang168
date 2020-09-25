
<?php
include $this->view->getTplPath() . '/' . 'join_header.php';
?>

<style>
    .select_category .ui-tree-wrap{
        margin: 0px;
    }
    .joinin-step input[name='agree_input']{
      width:400px;
      height: 40px;
      margin:20px 0 0 20px;
      outline: none;
    }
    .joinin-concrete .apply_agreement_img{
      width: 740px;
      height: 340px;
    }
    .wrapper{
        position:static;
    }
</style>

<div class="header_line"><span></span></div>
<div class="breadcrumb"><span class="icon-home iconfont icon-tabhome"></span><span><a href="">首页</a></span> <span class="arrow iconfont icon-btnrightarrow"></span> <span>商家入驻申请</span> </div>
<div class="main">
  <div class="sidebar">
    <div class="title">
      <h3>商家入驻申请</h3>
    </div>
    <div class="content">
      <dl show_id="99">
        <dt onclick="show_list('99');" style="cursor: pointer;"> <i class="hide"></i>入驻流程</dt>
        <dd style="display:none;">
          <ul>
            <li> <i></i> <a href="" target="_blank">签署入驻协议</a> </li>
            <li> <i></i> <a href="" target="_blank">商家信息提交</a> </li>
            <li> <i></i> <a href="" target="_blank">平台审核资质</a> </li>
            <li> <i></i> <a href="" target="_blank">商家缴纳费用</a> </li>
            <li> <i></i> <a href="" target="_blank">店铺开通</a> </li>
          </ul>
        </dd>
      </dl>
      <dl>
        <dt class=""> <i class="hide"></i>签订入驻协议</dt>
      </dl>
      <dl show_id="0">
        <dt> <i class="hide"></i>提交申请</dt>
      </dl>
      <dl>
        <dt class=""> <i class="hide"></i>合同签订及缴费</dt>
      </dl>
      <dl>
        <dt> <i class="hide"></i>店铺开通</dt>
      </dl>
        <dl>
            <dt> <i class="show"></i>店铺审核不通过</dt>
        </dl>
    </div>

  </div>
    <div class="right-layout">
    <?php if ($data_napss){ ?>
    <div class="joinin-step">
        <input type="text"  name="agree_input" disabled="disabled" value="<?=$data_napss['shop_npass_content']?>">
    </div>
    <div class="joinin-concrete">
<!--      <img src="--><?//=$data_napss['shop_npass_image']?><!--" alt="" class="apply_agreement_img">-->
<!-- 协议 -->

        <div class="default"><?=htmlspecialchars_decode($data_napss['shop_npass_image'])?></div>

        <div id="apply_agreement" class="apply-agreement">
        <div class="bottom"><a id="btn_apply_agreement_next" href="javascript:;" class="btn bbc_btns"><?=_('修改填写信息')?></a></div>
        </div>
        <script type="text/javascript">
        $(document).ready(function(){
            $('#btn_apply_agreement_next').on('click', function() {
                window.location.href = "index.php?ctl=Seller_Shop_Settled&met=index&type=npass";
            });
        });
        </script>
    </div>
  </div>
    <?php } ?>
    <link href="<?= $this->view->css_com ?>/ztree.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.toastr.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.combo.js"></script>
    <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.ztree.all.js"></script>
    <script type="text/javascript" src="<?=$this->view->js?>/common.js" charset="utf-8"></script>

    <link href="<?= $this->view->css_com ?>/jquery/plugins/validator/jquery.validator.css?ver=<?= VER ?>" rel="stylesheet"
          type="text/css">
    <script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/validator/jquery.validator.js"
            charset="utf-8"></script>
    <script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/validator/local/zh_CN.js"
            charset="utf-8"></script>

<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>