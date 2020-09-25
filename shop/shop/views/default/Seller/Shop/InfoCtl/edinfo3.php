<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
    <link href="<?= $this->view->css ?>/edinfo.css" rel="stylesheet" type="text/css">
    <link href="<?= $this->view->css ?>/swiper.css" rel="stylesheet" type="text/css">
    <link href="<?= $this->view->css ?>/iconfont/iconfont.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/base.css" />
    <script type="text/javascript" src="<?= $this->view->js_com ?>/jquery.js"></script>
    <script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/jquery.cookie.js"></script>
    <script type="text/javascript" src="<?=$this->view->js?>/nav.js"></script>
    <script type="text/javascript" src="<?=$this->view->js?>/swiper.min.js"></script>
    <script type="text/javascript" src="<?=$this->view->js?>/base.js"></script>
    <link href="<?= $this->view->css ?>/seller_center.css?ver=<?=VER?>" rel="stylesheet">
    <style>
        /*.search-input-text{*/
        /*background-color:#2B251F;*/
        /*border:0px;*/
        /*}*/
        body{
            font-size:12px;
        }
    </style>
    <div class="tabmenu">
        <ul>
            <li ><a href="./index.php?ctl=Seller_Shop_Info&met=info&typ=e&act=category"><?=_('经营类目')?></a></li>
            <?php if($shop['shop_self_support']=="false"){ ?>
                <li ><a href="./index.php?ctl=Seller_Shop_Info&met=info&typ=e&act=info"><?=_('店铺信息')?></a></li>
                <li ><a href="./index.php?ctl=Seller_Shop_Info&met=info&typ=e&act=renew"><?=_('续签申请')?></a></li>
                <li class="active bbc_seller_bg"><a href="./index.php?ctl=Seller_Shop_Info&met=info&typ=e&act=edinfo"><?=_('修改店铺信息')?></a></li>
            <?php } ?>
        </ul>

    </div>
<div class="main"></div>
  <div class="right-layout">
    <div class="w fn-clear">
      <div class="joinin-step">
        <ul>
          <li class="step1 current"><span>公司资质信息</span></li>
          <li class="current"><span>财务资质信息</span></li>
          <li class="current"><span>店铺经营信息</span></li>
          <li class=""><span>合同签订及缴费</span></li>
          <li class="step6"><span>提交审核</span></li>
        </ul>
      </div>


      <div class="joinin-concrete form-style">
<form id="form_company_info" method="post">
<!--       <input name="shop_id" value="--><?//=$shop_company['shop_id']?><!--" type="hidden">-->
    <fieldset>
        <h4><em><i>*</i>表示该项必填</em>店铺经营信息</h4>
        <dl>
            <dt><i>*</i>店铺等级：</dt>
            <dd>
                <select name="shop_grade_id" id="areaa">
                    <option selected="selected" value="">请选择</option>
                    <?php if(!empty($shop_grade)){  foreach ($shop_grade as $key => $value) { ?>
                        <option value="<?=$value['shop_grade_id']?>" data-type="<?=$value['shop_grade_name']?>"><?=$value['shop_grade_name']?> (收费标准：<?=$value['shop_grade_fee']?> 元)</option>
                    <?php }}?>
                </select>
            </dd>
        </dl>
        <dl>
            <dt><i>*</i>店铺名称：</dt>
            <dd>
                <input class="text w200" name="shop_name" type="text" value="<?=$shop_base['shop_name']?>"><span id="shop_type"></span>
                <p class="hint red">店铺名称注册后不可修改，请认真填写。</p>
            </dd>
        </dl>
        <dl>
            <dt><i>*</i>开店时长：</dt>
            <dd>
            <select name="joinin_year" id="area_1">
                    <option selected="selected" value="1">1年</option>
                    <option value="2">2年</option>
                    <option value="5">5年</option>
                    <option value="10">10年</option>
            </select>
            </dd>
        </dl>
        <dl>
            <dt><i>*</i>店铺分类：</dt>
            <dd>
            <select name="shop_class_id" id="areab">
                <option selected="selected" value="" >请选择</option>
                <?php if(!empty($shop_class)){
                    foreach ($shop_class as $key => $value) {

                ?>
                 <option value="<?=$value['shop_class_id']?>"><?=$value['shop_class_name']?> (保证金：<?=$value['shop_class_deposit']?>元)</option>
                <?php }}?>
            </select>
            <p class="hint red">请根据您所经营的内容认真选择店铺分类，注册后商家不可自行修改。</p>
            </dd>
        </dl>
        <dl>
            <dt>经营类目：</dt>
            <dd>
            <div class="select_category" >
                <select id="selectss" name="shop_class_ids">
                  
                </select>
            </div>
            <table class="table_category" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                    <th>一级类目</th>
                    <th>二级类目</th>
                    <th>三级类目</th>
                    <th>四级类目</th>
                    <th>操作</th>
                 </tr>        
            </tbody></table>
        </dd>
        </dl>
    </fieldset>

    <div class="next" style="width: 600px;"><a class="button bbc_btns" id="btn_apply_company_last" href="javascript:;" >上一步</a><a id="btn_apply_company_next" class="button bbc_btns" href="javascript:void(0);">提交申请</a><a id="btn_apply_company_next1" class="button bbc_btns" href="javascript:void(0);">保存申请</a></div>
</form>    
<link href="<?= $this->view->css_com ?>/ztree.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.toastr.min.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.combo.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.ztree.all.js"></script> 
<script type="text/javascript" src="<?=$this->view->js?>/common.js" charset="utf-8"></script>


<script>
	$(function() {
        $('#area_1').children('[value="<?= $shop_base['joinin_year'] ?>"]').prop("selected", "selected").trigger('change');
        $('#areaa').children('[value="<?= $shop_base['shop_grade_id'] ?>"]').prop("selected", "selected").trigger('change');
        $('#areab').children('[value="<?= $shop_base['shop_class_id'] ?>"]').prop("selected", "selected").trigger('change');
		//商品类别
		var opts = {
			width : 160,
			//inputWidth : (SYSTEM.enableStorage ? 145 : 208),
			inputWidth : 180,
			defaultSelectValue : '-1',
//			defaultSelectValue : rowData.categoryId || '',
			showRoot : true,
                        rootTxt: '<?=_('添加经营类目')?>',
		}

		categoryTree = Public.categoryTree($('#selectss'), opts);
                

		$('#selectss').change(function(){
			var i = $(this).data("id");
                        if(i != -1){
                        var ajax_url = "./index.php?ctl=Seller_Shop_Settled&met=shopCatBind&typ=json";
                           $.ajax({
                                url: ajax_url,
                                data:"cat_id="+i,
                                success:function(a){                                   
                                    if(a.status == 200)
                                    {
										var tr = '<tr class="shop-item">';
										var catid = catname = commission = '';
										var data = a.data;
										var len = data.length;

										$.each(data, function(i, cat_row)
										{
											if(i==len-1)
											{
												tr += '<td>'+cat_row.cat_name+'(分佣比例：'+cat_row.cat_commission+'%)</td>';											
											}else{
												tr += '<td>'+cat_row.cat_name+'</td>';
											}
											
											catid = cat_row.cat_id ;
											commission = cat_row.cat_commission;
										});
										
										//等级不足时
										for(i=0;i<4-len;i++)
										{
											tr +='<td></td>';
										}
 
										tr += '<td><a data-type="delete" href="javascript:void(0);">删除</a>';
										tr += '<input type="hidden" name="product_class_id[]" value="' + catid + '" />';
										tr += '<input type="hidden" name="commission_rate[]" value="' + commission + '" />';
										tr += '</td></tr>';

										$('.table_category').append(tr);									
                                    }
                                    else
                                    {
                                        alert('操作失败！');
                                    }
                                }
                           });
                      }else{
                       alert('请选择类目！');
                      }     
		});
		
		$('.table_category').on('click', '[data-type="delete"]', function() {
			$(this).parent('td').parent('tr').remove();
		});

		$('[name="shop_grade_id"]').change(function () {
            $('#shop_type').html($(this).find("option:selected").data('type'));
        })


	});
</script>
<script type="text/javascript">
$(document).ready(function(){
         var ajax_url = './index.php?ctl=Seller_Shop_Settled&met=editShopBase&typ=json&type=xg&shop_id='+<?=$shop['shop_id']?>;
        $('#form_company_info').validator({
            ignore: ':hidden',
            theme: 'yellow_right',
            timely: 1,
            stopOnError: false,
            rules: {
              shop_name:function (element, params, field) {
                  var type = $('[name="shop_grade_id"]').find("option:selected").data('type')
                  if(type){
                      if(element.value.indexOf(type) >= 0){
                          return '店铺名称不能包含"'+type+'"';
                      }
                  }
              }
            },

            fields: {
                'shop_name': 'required;shop_name',
                'shop_grade_id':'required;',
                'joinin_year':'required;',
                'shop_class_id':'required;',
                'shop_class_bind_id':'required;',
            },
           valid:function(form){
                //表单验证通过，提交表单
                $.ajax({
                    url: ajax_url,
                    data:$("#form_company_info").serialize(),
                    success:function(a){
                        if(a.status == 200)
                        {
                            location.href="./index.php?ctl=Seller_Shop_Info&met=info&typ=e&act=edinfo&op=edinfo";
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
function  demo() {
    $("#form_company_info").submit();
    var ajax_url = './index.php?ctl=Seller_Shop_Settled&met=editShopBase&typ=json&type=bc&shop_id='+<?=$shop['shop_id']?>;
    $('#form_company_info').validator({
        ignore: ':hidden',
        theme: 'yellow_right',
        timely: 1,
        stopOnError: false,
        rules: {
            shop_name:function (element, params, field) {
                var type = $('[name="shop_grade_id"]').find("option:selected").data('type')
                if(type){
                    if(element.value.indexOf(type) >= 0){
                        return '店铺名称不能包含"'+type+'"';
                    }
                }
            }
        },

        fields: {
            'shop_name': 'required;shop_name',
            'shop_grade_id':'required;',
            'joinin_year':'required;',
            'shop_class_id':'required;',
            'shop_class_bind_id':'required;',
        },
        valid:function(form){
            //表单验证通过，提交表单
            $.ajax({
                url: ajax_url,
                data:$("#form_company_info").serialize(),
                success:function(a){
                    if(a.status == 200)
                    {
                        location.href="./index.php?ctl=Seller_Shop_Info&met=info&typ=e&act=edinfo&op=edinfo";
                    }
                    else
                    {
                        alert('操作失败！');
                    }
                }
            });
        }

    });
}
$('#btn_apply_company_next').click(function() {
		$("#form_company_info").submit();
});
$('#btn_apply_company_next1').click(function() {
    demo();
});
$('#btn_apply_company_last').click(function () {
    location.href="./index.php?ctl=Seller_Shop_Info&met=info&typ=e&act=edinfo&op=edinfo2_back";
})
</script> 
    <link href="<?= $this->view->css_com ?>/jquery/plugins/validator/jquery.validator.css?ver=<?= VER ?>" rel="stylesheet"
          type="text/css">
    <script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/validator/jquery.validator.js"
            charset="utf-8"></script>
    <script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/validator/local/zh_CN.js"
            charset="utf-8"></script>
</div>
    </div>
  </div>
</div>



<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>