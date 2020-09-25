
<?php
include $this->view->getTplPath() . '/' . 'join_header.php';

?>


<div class="header_line"><span></span></div>
<div class="breadcrumb"><span class="icon-home iconfont icon-tabhome"></span><span><a href="index.php"><?=_('首页')?></a></span> <span class="arrow iconfont icon-btnrightarrow"></span> <span><?=_($apply_tips['0'])?></span> </div>
<div class="main">
  <div class="sidebar">
    <div class="title">
      <h3><?=_($apply_tips['0'])?></h3>
    </div>
    <div class="content">
      <dl show_id="99">
        <dt onclick="show_list('99');" style="cursor: pointer;"> <i class="hide"></i><?=_('入驻流程')?></dt>
        <dd style="display:none;">
          <ul>
            <li> <i></i> <a href="" target="_blank"><?=_('签署入驻协议')?></a> </li>
            <li> <i></i> <a href="" target="_blank"><?=_($apply_tips['1'])?></a> </li>
            <li> <i></i> <a href="" target="_blank"><?=_('平台审核资质')?></a> </li>
            <li> <i></i> <a href="" target="_blank"><?=_($apply_tips['2'])?></a> </li>
            <li> <i></i> <a href="" target="_blank"><?=_('店铺开通')?></a> </li>
          </ul>
        </dd>
      </dl>
      <dl>
        <dt class=""> <i class="hide"></i>签订入驻协议</dt>
      </dl>
      <dl show_id="0">
        <dt onclick="show_list('0');" style="cursor: pointer;"> <i class="show"></i><?=_('提交申请')?></dt>
        <dd>
          <ul style="display:none">
            <li class=""><i></i><?=_($apply_tips['3'])?></li>
            <li class=""><i></i><?=_('财务资质信息')?></li>
            <li class=""><i></i><?=_('店铺经营信息')?></li>
          </ul>
        </dd>
      </dl>
      <dl>
        <dt class="bbc_bg_col"> <i class="hide"></i><?=_('合同签订及缴费')?></dt>
      </dl>
      <dl>
        <dt> <i class="hide"></i><?=_('店铺开通')?></dt>
      </dl>
    </div>
  </div>
  <div class="right-layout">
    <div class="w fn-clear">
      <div class="joinin-step">
        <ul>
          <li class="step1 current"><span><?=_('签订入驻协议')?></span></li>
          <li class="current"><span><?=_($apply_tips['3'])?></span></li>
          <li class="current"><span><?=_('财务资质信息')?></span></li>
          <li class="current"><span><?=_('店铺经营信息')?></span></li>
          <li class="current"><span><?=_('合同签订及缴费')?></span></li>
          <li class="step6"><span><?=_('店铺开通')?></span></li>
        </ul>
      </div>
     <?php if($shop_company['shop_status'] == 1 || ($shop_company['shop_status'] == 2 && $shop_company['shop_payment'] == 1) ){?>
        <div class="content" style="text-align: center;">
           <div class="tips"><i></i><p><?=_('已经提交，请等待管理员核对后为您开通店铺')?></p></div>
    </div>
     <?php }else{ ?>
        <div class="joinin-concrete content-step5"style="padding:19px">
            <div class="alert">
            <h4><?=_('注意事项')?>：</h4>
            <?=_('以下所需要上传的电子版资质文件仅支持JPG\GIF\PNG格式图片，大小请控制在1M之内。')?>
           <br/>
            <span style="color:red;"><?php echo isset($shop_company['shop_verify_reason']) && $shop_company['shop_status'] == 7 ? $shop_company['shop_verify_reason'] : '';?></span>
          </div>
      <div style=" margin-left:110px;">
        <h5><?=_('付款清单列表')?></h5>
    <table cellpadding="0" cellspacing="1" width="100%">
        <tbody>
          <?php if(!empty($shop_company['shop_grade'])){ foreach ($shop_company['shop_grade'] as $keys=>$val){ ?>   
         <tr>
            <td width="70"><?=_('收费标准')?>：</td>
            <td><?=$val['shop_grade_fee']?><?=_('元/年')?></td>
            <td width="80"><?=_('开店时长')?>：</td>
            <td><?= $shop_company['joinin_year']?><?=_('年')?></td>
        </tr>
            <?php foreach ($shop_company['shop_class'] as $keyss=>$vals){ ?>
        <tr>
            <td><?=_('店铺分类')?>：</td>
            <td><?=$vals['shop_class_name']?></td>
            <td><?=_('开店保证金')?>：</td>
            <td><?=$vals['shop_class_deposit']?><?=_('元')?></td>
        </tr>
        <tr>
            <td><?=_('应付金额')?>：</td>
            <td colspan="3"><?=$val['shop_grade_fee']*$shop_company['joinin_year']+$vals['shop_class_deposit'] ?><?=_('元')?></td>
        </tr>
                  <tr>
                      <td>收款方:</td>
                      <td>北京淘尚壹陆捌网络科技有限公司</td>
                  </tr>
                  <tr>
                      <td>开户行:</td>
                      <td>中国建设银行北京洋桥支行
                      </td>
                  </tr>
                  <tr>
                      <td>收款账户:</td>
                      <td>11050162510000000394</td>
                  </tr>
            <?php }}}?>
    </tbody></table>

    <h5><?=_('付款凭证')?></h5>
    <form id="form" method="post">
    <input name="shop_id" value="<?=$shop_company['shop_id']?>" type="hidden">
    <table cellpadding="0" cellspacing="1" width="100%">
        <tbody><tr>
            <td width="70"><?=_('上传凭证')?>：</td>
            <td>
                <input class="text w250" style="float: left;"  id="payment_voucher" readonly="readonly"name="payment_voucher" type="text" value="<?php echo isset($shop_company['payment_voucher']) ? $shop_company['payment_voucher'] : '';?>"> <p style="float:left; width:70px;margin-left:10px;"  id="payment_upload" ><i class="iconfont icon-upload-alt"></i><?=_('图片上传')?></p>
            </td>
        </tr>
        <tr>
            <td><?=_('备注')?>：</td>
            <td>
            	<textarea class="text" name="payment_voucher_explain" style="width:96%"><?php echo isset($shop_company['payment_voucher_explain']) ? $shop_company['payment_voucher_explain'] : '';?></textarea>
            </td>
        </tr>
    </tbody></table>
    <div class="next"><a href="<?= YLB_Registry::get('base_url')?>/index.php?ctl=Seller_Shop_Settled&met=index&op=step4&rp=step4&apply=<?=$apply?>" class="btn bbc_btns"><?=_('上一步')?></a>&nbsp;&nbsp;&nbsp;<a id="btn_apply_company_next" class="btn bbc_btns" href="javascript:void(0);"><?=_('提交')?></a></div>
    </form>
</div>
</div>
     <?php } ?>
</div>
    </div>
  </div>
</div>

<link href="<?= $this->view->css_com ?>/jquery/plugins/validator/jquery.validator.css?ver=<?= VER ?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
<script>
    //图片上传
    $(function(){
        background_upload = new UploadImage({
            uploadButton: '#payment_upload',
            inputHidden: '#payment_voucher'
        });
    })
</script>
<script type="text/javascript">
    $(document).ready(function(){
        var ajax_url = "./index.php?ctl=Seller_Shop_Settled&met=shopPaystatus&typ=json&apply=<?=$apply?>";
        $('#form').validator({
            ignore: ':hidden',
            theme: 'yellow_right',
            timely: 1,
            stopOnError: false,
            rules: {

            },

            fields: {
                'payment_voucher': 'required;',
                'payment_voucher_explain':'required;',
            },
            valid:function(form){
                //表单验证通过，提交表单
                $.ajax({
                    url: ajax_url,
                    data:$("#form").serialize(),
                    success:function(a){
                        if(a.status == 200)
                        {
                            location.href="./index.php?ctl=Seller_Shop_Settled&met=index&op=step5&apply=<?=$apply?>";
                        }
                        else
                        {
                            alert("<?=_('操作失败')?>");
                        }
                    }
                });
            }

        });
    })
    $('#btn_apply_company_next').click(function() {
        $("#form").submit();
    });
</script>

<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>