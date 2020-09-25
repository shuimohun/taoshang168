
<?php
include $this->view->getTplPath() . '/' . 'supplier_join_header.php';
?>


<div class="header_line"><span></span></div>
<div class="breadcrumb"><span class="icon-home iconfont icon-tabhome"></span><span><a href="index.php">首页</a></span> <span class="arrow iconfont icon-btnrightarrow"></span> <span>商家入驻申请</span> </div>
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
        <dt onclick="show_list('0');" style="cursor: pointer;"> <i class="show"></i>提交申请</dt>
        <dd>
          <ul style="display:none">
            <li class=""><i></i>公司资质信息</li>
            <li class=""><i></i>财务资质信息</li>
            <li class=""><i></i>店铺经营信息</li>
          </ul>
        </dd>
      </dl>
      <dl>
        <dt class="bbc_bg_col"> <i class="hide"></i>合同签订及缴费</dt>
      </dl>
      <dl>
        <dt> <i class="hide"></i>店铺开通</dt>
      </dl>
    </div>
  </div>
  <div class="right-layout">
    <div class="w fn-clear">
      <div class="joinin-step">
        <ul>
          <li class="step1 current"><span>签订入驻协议</span></li>
          <li class="current"><span>公司资质信息</span></li>
          <li class="current"><span>财务资质信息</span></li>
          <li class="current"><span>店铺经营信息</span></li>
          <li class="current"><span>合同签订及缴费</span></li>
          <li class="step6"><span>店铺开通</span></li>
        </ul>
      </div>
     <?php if($shop_company['shop_status']==1 || ($shop_company['shop_status']==2 && $shop_company['shop_payment']==1 ) ){?>
        <div class="content" style="text-align: center;">
           <div class="tips"><i></i><p>已经提交，请等待管理员核对后为您开通店铺</p></div>

    </div>
     <?php }else{ ?>
        <div class="joinin-concrete content-step5"style="padding:19px">
      <div style=" margin-left:110px;">
        <h5>付款清单列表</h5>
    <table cellpadding="0" cellspacing="1" width="100%">
        <tbody>
          <?php if(!empty($shop_company['shop_grade'])){ foreach ($shop_company['shop_grade'] as $keys=>$val){ ?>   
         <tr>
            <td width="70">收费标准：</td>
            <td><?=$val['shop_grade_fee']?>元/年</td>
            <td width="80">开店时长：</td>
            <td><?= $shop_company['joinin_year']?>年</td>
        </tr>
            <?php foreach ($shop_company['shop_class'] as $keyss=>$vals){ ?>
        <tr>
            <td>店铺分类：</td>
            <td><?=$vals['shop_class_name']?></td>
            <td>开店保证金：</td>
            <td><?=$vals['shop_class_deposit']?>元</td>
        </tr>
        <tr>
            <td>应付金额：</td>
            <td colspan="3"><?=$val['shop_grade_fee']*$shop_company['joinin_year']+$vals['shop_class_deposit'] ?>元</td>
        </tr>
            <?php }}}?>
    </tbody></table>
<!--    <h5>经营类目列表</h5>
    <table class="cat" cellpadding="0" cellspacing="1" width="100%">
        <tbody><tr>
            <td>一级类目</td>
            <td>二级类目</td>
            <td>三级类目</td>
            <td>分佣比例</td>
        </tr>
                <tr>
            <td>服饰内衣、鞋靴、童装</td><td>女裙/裤子/套装</td><td>职业套装</td>                        <td>0 %</td>
        </tr>
            </tbody></table>  -->
    <h5>付款凭证</h5> 
    <form id="form" method="post">
    <input name="shop_id" value="<?=$shop_company['shop_id']?>" type="hidden">
    <table cellpadding="0" cellspacing="1" width="100%">
        <tbody><tr>
            <td width="70">上传凭证：</td>
            <td>
                <input class="text w250" style="float: left;"  id="payment_voucher" readonly="readonly"name="payment_voucher" type="text"> <p style="float:left; width:70px"  id="payment_upload" ><i class="iconfont icon-upload-alt"></i>图片上传</p>
            </td>
        </tr>
        <tr>
            <td>备注：</td>
            <td>
            	<textarea class="text" name="payment_voucher_explain" style="width:96%"></textarea>
            </td>
        </tr>
    </tbody></table>
    <div class="next"><a id="btn_apply_company_next" class="button button_black" href="javascript:void(0);">提交</a></div>
    </form>
</div>
</div>
     <?php } ?>
</div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
         var ajax_url = './index.php?ctl=Seller_Supplier_Settled&met=shopPaystatus&typ=json';
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
                           location.href="./index.php?ctl=Seller_Supplier_Settled&met=index&op=step5";
                        }
                        else
                        {
                            alert('操作失败！');
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
 <script type="text/javascript" src="<?=$this->view->js_com?>/webuploader.js" charset="utf-8"></script>
 <script type="text/javascript" src="<?=$this->view->js_com?>/upload/upload_image.js" charset="utf-8"></script>
 <link href="<?= $this->view->css_com ?>/webuploader.css" rel="stylesheet" type="text/css">
<script>
    //图片上传
    $(function(){
        background_upload = new UploadImage({
            uploadButton: '#payment_upload',
            inputHidden: '#payment_voucher'
        });
    })
</script>
    <link href="<?= $this->view->css_com ?>/jquery/plugins/validator/jquery.validator.css?ver=<?= VER ?>" rel="stylesheet"
          type="text/css">
    <script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/validator/jquery.validator.js"
            charset="utf-8"></script>
    <script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/validator/local/zh_CN.js"
            charset="utf-8"></script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>