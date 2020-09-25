
<?php
include $this->view->getTplPath() . '/' . 'join_header.php';
?>
<style>
.wrap, .wrapper {
    position: static;
}
</style>
<div class="header_line"><span></span></div>
<div class="breadcrumb"><span class="icon-home iconfont icon-tabhome"></span><span><a href="index.php">首页</a></span> <span class="arrow iconfont icon-btnrightarrow"></span> <span><?=$apply_tips['0']?></span> </div>
<div class="main">
  <div class="sidebar">
    <div class="title">
      <h3><?=$apply_tips['0']?></h3>
    </div>
    <div class="content">
                  <dl show_id="99">
        <dt onclick="show_list('99');" style="cursor: pointer;"> <i class="hide"></i>入驻流程</dt>
        <dd style="display: none;">
          <ul>
                                    <li> <i></i>
                            <a href="" target="_blank">签署入驻协议</a>
                          </li>
                        <li> <i></i>
                            <a href="" target="_blank"><?=$apply_tips['1']?></a>
                          </li>
                        <li> <i></i>
                            <a href="" target="_blank">平台审核资质</a>
                          </li>
                        <li> <i></i>
                            <a href="" target="_blank"><?=$apply_tips['2']?></a>
                          </li>
                        <li> <i></i>
                            <a href="" target="_blank">店铺开通</a>
                          </li>
                                  </ul>
        </dd>
      </dl>
                  <dl>
        <dt class="bbc_bg_col"> <i class="hide"></i>签订入驻协议</dt>
      </dl>
      <dl show_id="0">
        <dt onclick="show_list('0');" style="cursor: pointer;"> <i class="show"></i>提交申请</dt>
        <dd style="display: block;">
          <ul>
            <li class=""><i></i><?=$apply_tips['3']?></li>
            <li class=""><i></i>财务资质信息</li>
            <li class=""><i></i>店铺经营信息</li>
          </ul>
        </dd>
      </dl>
      <dl>
        <dt class=""> <i class="hide"></i>合同签订及缴费</dt>
      </dl>
      <dl>
        <dt> <i class="hide"></i>店铺开通</dt>
      </dl>
    </div>
      <div class="title">
          <h3>平台联系方式></h3>
      </div>
      <div class="content">
          <ul>
              <?php
              $phone = Web_ConfigModel::value("setting_phone");
              if ($phone)
              {
                  $phone = explode(',', $phone);//电话
              }
              ?>
              <?php foreach($phone as $k=>$v){?>
                  <li>电话：<?=$v;?></li>
              <?php }?>

              <li>邮箱：<?=Web_ConfigModel::value('setting_email')?></li>
          </ul>
      </div>
  </div>
  <div class="right-layout">
    <div class="joinin-step">
      <ul>
        <li class="step1 current"><span>签订入驻协议</span></li>
        
        <li class=""><span><?=$apply_tips['3']?></span></li>
        <li class=""><span>财务资质信息</span></li>
        <li class=""><span>店铺经营信息</span></li>
        <li class=""><span>合同签订及缴费</span></li>
        <li class="step6"><span>店铺开通</span></li>
      </ul>
    </div>
    <div class="joinin-concrete">
      
<!-- 协议 -->

<div id="apply_agreement" class="apply-agreement">
  <div class="title"><h3>入驻协议</h3></div>
  <div class="apply-agreement-content">
         <?php foreach ($shop_xieyi as $key => $value) {
        ?>
            <?=$value['help_info']?>
         <?php }?>
  </div>
  <div class="apple-agreement">
    <input id="input_apply_agreement" name="input_apply_agreement" checked="checked" type="checkbox">
    <label for="input_apply_agreement">'我已阅读并同意以上协议</label>
  </div>
  <div class="bottom">
    <?php if(Web_ConfigModel::value('join_type') == 3){?>
    <a href="<?= YLB_Registry::get('base_url')?>/index.php?ctl=Seller_Shop_Settled&met=index&op=step0&rp=step0" class="btn bbc_btns">上一步</a>&nbsp;&nbsp;&nbsp;
    <?php } ?>
 <a id="btn_apply_agreement_next" href="javascript:;" class="btn bbc_btns"><?=$apply_tips['4']?></a></div>
  
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#btn_apply_agreement_next').on('click', function() {
        if($('#input_apply_agreement').prop('checked')) {
            window.location.href = "index.php?ctl=Seller_Shop_Settled&met=index&op=step2&apply=<?=$apply?>";
        } else {
            alert("请阅读并同意协议");
        }
    });
});
</script>    </div>
  </div>
</div>






 


<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>