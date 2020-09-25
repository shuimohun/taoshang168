<?php if (!defined('ROOT_PATH')) exit('No Permission');?>

<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
<link href="<?=$this->view->css?>/font/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="<?=$this->view->css ?>/seller_center.css" rel="stylesheet" type="text/css">
<style>
    .dialog-areas, .dialog-batch{
        background-color: #fff;
    }
    [class^="icon-"], [class*=" icon-"] {
        display: inline-block;
        width: auto;
        height: auto;
        line-height: normal;
        vertical-align: baseline;
        background-image: none;
        background-position: 0% 0%;
        background-repeat: repeat;
        margin-top: 10px;
    }
    .right-layout {
        float: right;
        width: 1000px;
        background-color: #FFF;
        min-height: 765px;
        margin-top: -72px;
    }

    .ncsc-form-default dl dt {
        font-size: 12px;
        line-height: 32px;
        vertical-align: top;
        letter-spacing: normal;
        word-spacing: normal;
        text-align: right;
        display: inline-block;
        width: 7%;
        padding: 10px 1% 10px 0;
        margin: 0;
    }
    .bd-line td.cell-area{
        width: 250px;
        text-align: center;
    }
    .ncsc-form-default dl dd {
        font-size: 12px;
        line-height: 32px;
        vertical-align: top;
        letter-spacing: normal;
        word-spacing: normal;
        display: inline-block;
        width: 92%;
        padding: 10px 0 10px 0;
    }
    a.ncbtn, a.ncbtn-mini:hover{
        background-color: #999;
        color: #fff;
    }
    #fwin_dialog{
        position: fixed; z-index: 1701; left: 625px; top: 350.5px;
    }
    .showCityPop .ncsc-citys-sub{
        font-size: 0;
        display: block;
        background-color:#F7E4A5;
    }
    .dialog-areas li.even{
        background-color: #f7f7f7;
    }
    .ks-contentbox .title {
        font-size: 14px;
        line-height: 20px;
        font-weight: 700;
        padding: 10px;
        position: relative;
        z-index: 1;
    }
    .J_Message,.icon-exclamation-sign{
        color:red;
    }
</style>
    <div id="append_parent"></div>
<div class="ncsc-form-default">
    <form method="post" id="tpl_form" name="tpl_form">
        <input type="hidden" name="transport_type_id" value="<?=$transport['transport_type_id']?>" />
        <input type="hidden" name="form_submit" value="ok" />
        <dl>
            <dt>
                <label for="J_TemplateTitle" class="label-like">模板名称:</label>
            </dt>
            <dd>
                <input type="text"  class="text"  id="title" autocomplete="off"  value="<?=$transport['transport_type_name'];?>" name="title">
                <p class="J_Message" style="display:none" error_type="title"><i class="icon-exclamation-sign"></i>必须填写模板名称</p>
            </dd>
        </dl>

        <!-----------------------POST begin--------------------------------------->
        <dl>
            <dt>详细设置：</dt>
            <dd class="trans-line">
            </dd>
        </dl>
        <div class="bottom">
            <label class="submit-border"><input type="submit" id="submit_tpl" class="submit" value="保存" /></label>
        </div>
    </form>
    <div class="ks-ext-mask" style="position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; z-index: 999; display:none"></div>
    <div id="dialog_areas" class="dialog-areas" style="display:none">
        <div class="ks-contentbox">
            <div class="title"><?php echo $lang['transport_tpl_select_area'];?><a class="ks-ext-close" href="javascript:void(0)">X</a></div>
            <form method="post">
                <ul id="J_CityList">
                    <?php $i = 1; foreach ($areas['region'] as $region => $provinceIds) { ?>
                        <li<?php if ($i % 2 == 0){ ?> class="even"<?php } ?>>
                            <dl class="ncsc-region">
                                <dt class="ncsc-region-title">
                                  <span>
                                  <input type="checkbox" id="J_Group_<?=$i; ?>" class="J_Group" value=""/>
                                  <label for="J_Group_<?=$i; ?>"><?=$region ?></label>
                                  </span>
                                </dt>
                                <dd class="ncsc-province-list">
                                    <?php foreach ($provinceIds as $provinceId) { ?>
                                        <div class="ncsc-province"><span class="ncsc-province-tab">
                                            <input type="checkbox" class="J_Province" id="J_Province_<?=$provinceId ?>" value="<?=$provinceId ?>"/>
                                            <label for="J_Province_<?=$provinceId ?>"><?=$areas['name'][$provinceId]; ?></label>
                                            <span class="check_num"/> </span><i class="icon-angle-down trigger"></i>
                                            <div class="ncsc-citys-sub">
                                                <?php foreach ($areas['children'][$provinceId] as $cityId) { ?>
                                                    <span class="areas">
                                                          <input type="checkbox" class="J_City" id="J_City_<?=$cityId ?>" value="<?=$cityId ?>"/>
                                                          <label for="J_City_<?=$cityId; ?>"><?=$areas['name'][$cityId] ?></label>
                                                    </span>
                                                <?php } ?>
                                                <p class="tr hr8"><a href="javascript:void(0);" class="ncbtn-mini ncbtn-bittersweet close_button">关闭</a></p>
                                            </div>
                                            </span>
                                        </div>
                                    <?php } ?>
                                </dd>
                            </dl>
                        </li>
                        <?php $i++; } ?>
                </ul>
                <div class="bottom"> <a href="javascript:void(0);" class="J_Submit ncbtn ncbtn-mint">确定</a> <a href="javascript:void(0);" class="J_Cancel ncbtn">取消</a> </div>
            </form>
        </div>
    </div>
    <div id="dialog_batch" class="dialog-batch" style="z-index: 9999; display:none">
        <div class="ks-contentbox">
            <div class="title"><?php echo $lang['transport_tpl_pl_op'];?><a class="ks-ext-close" href="javascript:void(0)">X</a></div>
            <form method="post">
                <div class="batch">运费<?php echo $lang['nc_colon'];?>
                    <input class="w60 text" type="text" maxlength="6" autocomplete="off" value="0.00" name="express_postage" data-field="postage"><em class="add-on"> <i class="icon-renminbi"></i> </em>
                </div>
                <div class="J_DefaultMessage"></div>
                <div class="bottom"> <a href="javascript:void(0);" class="J_SubmitPL ncbtn ncbtn-mint"><?php echo $lang['transport_tpl_ok'];?></a> <a href="javascript:void(0);" class="J_Cancel ncbtn"><?php echo $lang['transport_tpl_cancel'];?></a> </div>
            </form>
        </div>
    </div>
</div>
    <script type="text/javascript" src="<?=$this->view->js_com?>/plugins/dialog/dialog.js" id="dialog_js" charset="utf-8"></script>
    <script type="text/javascript" src="<?=$this->view->js?>/transport.js"></script>
<script>
   $(function(){
       $('.trans-line').append(TransTpl.replace(/TRANSTYPE/g,'kd'));
       $('.tbl-except').append(RuleHead);

       <?php if (is_array($extend)){?>
       <?php foreach ($extend as $value){?>
       StartNum +=1;
       cell = RuleCell.replace(/CurNum/g,StartNum);
       cell = cell.replace(/TRANSTYPE/g,'kd');
       $('.tbl-except').find('table').append(cell);
       $('.tbl-attach').find('.J_ToggleBatch').css('display','').html('<?=$lang['transport_tpl_pl_op'];?>');

       var cur_tr = $('.tbl-except').find('table').find('tr:last');
       $(cur_tr).find('.area-group>p').html('<?=$value['transport_item_city_name'];?>');
       $(cur_tr).find('input[type="hidden"]').val('<?=trim($value['transport_item_city'],',');?>|||<?=$value['transport_item_city_name'];?>');
       $(cur_tr).find('input[data-field="start"]').val('<?=$value['snum'];?>');
       $(cur_tr).find('input[data-field="defalut_num"]').val('<?=$value['transport_item_default_num'];?>');
       $(cur_tr).find('input[data-field="postage"]').val('<?=$value['transport_item_default_price'];?>');
       $(cur_tr).find('input[data-field="add_num"]').val('<?=$value['transport_item_add_num'];?>');
       $(cur_tr).find('input[data-field="add_price"]').val('<?=$value['transport_item_add_price'];?>');
       $(cur_tr).find('input[data-field="plus"]').val('<?=$value['xnum'];?>');
       $(cur_tr).find('input[data-field="postageplus"]').val('<?=$value['xprice'];?>');

       <?php }?>
       <?php }?>

       var ajax_url = '<?= YLB_Registry::get('url') ?>?ctl=Seller_Transport&met=addEditTransport&typ=json';

       $('#tpl_form').validator({
           ignore: ':hidden',
           theme: 'yellow_right',
           timely: 1,
           stopOnError: false,
           valid:function(form){
               //表单验证通过，提交表单
               $.ajax({
                   url: ajax_url,
                   data:$("#tpl_form").serialize(),
                   type:'post',
                   success:function(a){
                       if(a.status == 200)
                       {
                           location.href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Transport&met=transport&typ=e";
                       }
                       else
                       {
                           //alert('操作失败！');
                           Public.tips({type: 1, content: "<?=_('操作失败！')?>"});
                       }
                   }
               });
           }

       });
   });
</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>