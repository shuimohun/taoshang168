<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>

<style type="text/css">
    #form table tr td.tl dt, #form table tr td.tl dd{float: left;}
    #form table tr td.tl dd{width:50px;}
</style>

<script type='text/jade' id='thrid_opt'>
    <a class="bbc_seller_btns button add button_blue" href="<?= YLB_Registry::get('index_page') ?>?ctl=Seller_Goods&met=add&typ=e"><i class="iconfont icon-jia"></i>发布新商品</a>
</script>

<div class="search fn-clear">
    <form id="search_form" class="search_form_reset" method="get" action="<?= YLB_Registry::get('url') ?>">
        <input class="text w150" type="text" name="goods_key" value="<?=($goods_key?$goods_key:'');?>" placeholder="请输入商品名称"/>
        <input type="hidden" name="ctl" value="Seller_Goods">
        <input type="hidden" name="met" value="<?= $met ? $met : 'online'; ?>">
        <a class="button refresh" href="<?=YLB_Registry::get('url')?>?ctl=Seller_Goods&met=<?= $met ? $met : 'online'; ?>&typ=e"><i
                class="iconfont icon-huanyipi"></i></a>
        <a class="button btn_search_goods" href="javascript:void(0);"><i
                class="iconfont icon-btnsearch"></i><?= _('搜索') ?></a>
    </form>
</div>
<script type="text/javascript">
    $(".search").on("click", "a.button", function (){
        $("#search_form").submit();
    });
</script>
<?php if (!empty($goods)){ if($this->shop_base['shop_type'] == 2){$ctl = 'Supplier_Goods';}else{$ctl = 'Goods_Goods';} ?>
    <form id="form" method="post" action="<?=YLB_Registry::get('url')?>?ctl=Seller_Goods&met=editGoodsCommon&typ=json">
        <table class="table-list-style" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <th class="tl">
                    <label class="checkbox"><input class="checkall" type="checkbox"/></label>商品名称
                </th>
                <th width="30">推荐</th>
                <th width="50"><?php if($this->shop_base['shop_type'] == 2){ echo '供货价';}else{echo '价格';}?></th>
                <th width="50">立减价</th>
                <th width="50">库存</th>
                <th width="70">发布时间</th>
                <th width="115">操作</th>
            </tr>
            <?php foreach ($goods as $item){  ?>
                <tr id="tr_common_id_<?= $item['common_id']; ?>">
                    <td class="tl th" colspan="99">
                        <label class="checkbox">
                            <input <?php if($item['common_promotion_type'] == Goods_CommonModel::HUIQIANGGOU) echo 'disabled'; ?> class="checkitem" type="checkbox" name="chk[]" value="<?= $item['common_id'] ?>">
                        </label>
                        平台货号：<?= $item['common_id']; ?>
                        <?php if($item['common_promotion_type'] > 0 || $item['common_is_jia']) {?>
                            <span class="bbc_color">
                                <?php if($item['common_promotion_type'] > 0){echo Goods_CommonModel::$promotionTypeMap[$item['common_promotion_type']];}?>
                                <?php if($item['common_is_jia']){echo ' 加价购';}?>
                            </span>
                        <?php }?>
                     </td>
                </tr>
                <tr>
                    <td class="tl">
                        <dl class="fn-clear fn_dl">
                            <dt>
                                <i date-type="ajax_goods_list" data-id="<?= $item['common_id']?>" class="iconfont icon-jia disb"></i>
                                <a href="<?=YLB_Registry::get('url')?>?ctl=<?=$ctl?>&met=goods&gid=<?= $item['goods_id'] ?>"
                                   target="_blank"><img width="60" src="<?= $item['common_image'] ?>"></a>
                            </dt>
                            <dd>
                                <h3>
                                    <?php if($item['common_parent_id']){ ?>
                                        <span class="dis_flag">分销</span>
                                    <?php } ?>
                                    <a href="<?=YLB_Registry::get('url')?>?ctl=<?=$ctl?>&met=goods&gid=<?= $item['goods_id'] ?>"
                                       target="_blank"><?= $item['common_name'] ?></a>
                                </h3>

                                <p><?= $item['cat_name'] ?></p>

                                <p><?= ($item['common_code'] ? sprintf('商家货号：%s', $item['common_code']) : '') ?></p>
                            </dd>
                        </dl>
                    </td>
                    <td><input class="check_recommend" data-cid="<?=$item['common_id']?>" type="checkbox" <?php if($item['common_is_recommend'] == 2){ echo 'checked';}?>/></td>
                    <td><p><?= format_money($item['common_price']); ?></p></td>
                    <td><p><?= format_money($item['common_shared_price']); ?></p></td>
                    <td  <?php if($item['common_stock'] < $item['common_alarm']){?> class="colred" <?php }?>><?= $item['common_stock'] ?> 件</td>
                    <td><?php $item['common_sell_time']!=='0000-00-00 00:00:00' ?  print($item['common_sell_time']) : print($item['common_add_time']); ?></td>
                    <td>
                        <?php if($item['common_promotion_type'] == Goods_CommonModel::HUIQIANGGOU){?>
                            <span class="clock">
                                <a title="已参加惠抢购活动，不能修改商品"><i class="iconfont icon-icopwd"></i>锁定</a>
                            </span>
                        <?php }else{?>
                            <span class="edit">
                                <a href="<?php echo YLB_Registry::get('url'); ?>?ctl=Seller_Goods&met=online&typ=e&common_id=<?= $item['common_id'] ?>&action=edit_goods"><i class="iconfont icon-zhifutijiao"></i>编辑</a>
                            </span>
                            <span class="del"><a data-param="{'id':'<?= $item['common_id'] ?>','ctl':'Seller_Goods','met':'deleteGoodsCommon'}" href="javascript:void(0)"><i class="iconfont icon-lajitong"></i>删除</a></span>
                        <?php }?>
                    </td>
                </tr>
                <tr id="tr_goods_list_<?= $item['common_id'];?>" class="tr-goods-list" style="display: none;">
                    <td colspan="7" class="tl goods_base">
                        <table class="table-list-style" width="100%" cellpadding="0" cellspacing="0">
                            <?php if (!empty($goods_detail_rows[$item['common_id']])): foreach ($goods_detail_rows[$item['common_id']] as $g_k => $g_v):?>
                                <tr>
                                    <td class="tl">
                                        <dl class="fn-clear fn_dl">
                                            <dt>
                                                <a href="<?=YLB_Registry::get('url')?>?ctl=<?=$ctl?>&met=goods&gid=<?=$g_v['goods_id']?>" target="_blank"><img width="60" src="<?=$g_v['goods_image']?>"></a>
                                            </dt>
                                            <dd>
                                                <h3>
                                                    <a href="<?=YLB_Registry::get('url')?>?ctl=<?=$ctl?>&met=goods&gid=<?= $g_v['goods_id'] ?>" target="_blank"><?= $g_v['goods_name'] ?></a>
                                                </h3>
                                                <p>
                                                    <?=$g_v['spec_str']?>
                                                </p>
                                                <p class="bbc_color">
                                                    <?php if($g_v['promotion']){ echo $g_v['promotion']['promotion_type_con'];if($g_v['promotion']['promotion_state']){echo '('.Promotion::$state_map[$g_v['promotion']['promotion_state']].')';}}?>
                                                    <?php if($g_v['goods_jia']){ echo '加价购('.Promotion::$state_map[$g_v['goods_jia']['state']].')'; }?>
                                                </p>
                                            </dd>
                                        </dl>
                                    </td>
                                    <td width="30"></td>

                                    <?php if($g_v['promotion'] && $g_v['promotion']['promotion_state'] != Promotion::OVER){?>
                                        <td width="50">
                                            <p><del><?= format_money($g_v['goods_price']); ?></del></p>
                                            <p><?= format_money($g_v['promotion']['promotion_price']); ?></p>
                                        </td>
                                        <td width="50">
                                            <p><del><?= format_money($g_v['goods_shared_price']); ?></del></p>
                                            <p><?= format_money($g_v['promotion']['promotion_price'] - $g_v['goods_share_price']); ?></p>
                                        </td>
                                    <?php }else{?>
                                        <td width="50"><p><?= format_money($g_v['goods_price']); ?></p></td>
                                        <td width="50"><p><?= format_money($g_v['goods_shared_price']); ?></p></td>
                                    <?php }?>

                                    <td width="50" <?php if($g_v['goods_stock'] < $g_v['goods_alarm']){?> class="colred" <?php }?>><?= $g_v['goods_stock'] ?> 件</td>
                                    <td width="70"></td>
                                    <td width="115">
                                        <!--<span class="edit"><a href="<?/*=YLB_Registry::get('url'); */?>?ctl=Goods_Goods&met=goods&gid=<?/*= $g_v['goods_id']*/?>" target="_blank"><i class="iconfont icon-zhifutijiao"></i>查看</a></span>-->
                                    </td>
                                </tr>
                            <?php  endforeach; endif; ?>
                        </table>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td class="toolBar" colspan="1">
                    <input type="hidden" name="act" value="del"/>
                    <label class="checkbox"><input class="checkall" type="checkbox"/></label>全选
                    <span>|</span>
                    <label class="del" data-param="{'ctl':'Seller_Goods','met':'deleteGoodsCommonRows'}"><i class="iconfont icon-lajitong"></i>删除</label>
                    <?php if ($met == 'online'){ ?>
						<span>|</span>
                        <label class="down"><i class="iconfont icon-xiajia"></i><?= _('下架') ?></label>
                    <?php }elseif($met != 'verify'){ ?>
						<span>|</span>
                        <label class="up"><i class="iconfont icon-shangjia1"></i><?= _('上架') ?></label>
                    <?php } ?>
                </td>
                <td colspan="99">
                    <div class="page">
                        <?= $page_nav ?>
                    </div>
                </td>
            </tr>
        </table>
    </form>
<?php }else{ ?>
<form id="form" method="post" action="<?=YLB_Registry::get('url')?>?ctl=Seller_Goods&met=editGoodsCommon&typ=json">
    <table class="table-list-style" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <th class="tl">
                <label class="checkbox"><input class="checkall" type="checkbox"/></label>商品名称
            </th>
            <th width="80">价格</th>
            <th width="80">库存</th>
            <th width="80">发布时间</th>
            <th width="120">操作</th>
        </tr>
    </table>
</form>
    <div class="no_account">
        <img src="<?=$this->view->img?>/ico_none.png">
        <p><?= _('暂无符合条件的数据记录'); ?></p>
    </div>
<?php } ?>

<script src="<?=$this->view->js_com?>/plugins/jquery.timeCountDown.js" ></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('label.down').click(function() {
            var length = $('.checkitem:checked').length;
            if (length > 0) {
                var chk_value = []; //定义一个数组
                $("input[name='chk[]']:checked").each(function() {
                    chk_value.push($(this).val()); //将选中的值添加到数组chk_value中
                });
                $.dialog.confirm('您确定要下架吗?', function() {
                    $.post(SITE_URL + '?ctl=Seller_Goods&met=editGoodsCommon&typ=json&act=down', {
                        chk: chk_value
                    }, function(data) {
                        if (data && 200 == data.status) {
                            Public.tips({
                                content: "下架成功！"
                            });
                            location.reload();
                        } else {
                            Public.tips({
                                type: 1,
                                content: "下架失败！"
                            });
                        }
                    });
                });
            } else {
                $.dialog.alert('请选择需要操作的记录');
            }
        });
        $('label.up').click(function() {
            var me = '<?php echo $met?>';
            var length = $('.checkitem:checked').length;
            if (length > 0) {
                var chk_value = []; //定义一个数组
                $("input[name='chk[]']:checked").each(function() {
                    chk_value.push($(this).val()); //将选中的值添加到数组chk_value中
                });

                $.dialog.confirm('您确定要上架吗?', function() {
                    $.post(SITE_URL + '?ctl=Seller_Goods&met=editGoodsCommon&typ=json&act=up&me=' + me, {
                        chk: chk_value
                    }, function(data) {
                        if (data && 200 == data.status) {
                            Public.tips({
                                content: "上架成功！"
                            });
                            location.reload();
                        } else {
                            Public.tips({
                                type: 1,
                                content: "上架失败！"
                            });
                        }
                    });
                });
            } else {
                $.dialog.alert('请选择需要操作的记录');
            }
        });

        $('.tabmenu').append($('#thrid_opt').html());

        //倒计时
        /*var _TimeCountDown = $(".fnTimeCountDown");
        _TimeCountDown.fnTimeCountDown();*/

        //查看商品goods_base
        $(".table-list-style .disb").click(function() {
            var cid = $(this).data('id');
            if ($(this).hasClass('icon-jia')) {
                $('#tr_goods_list_'+cid).css("display", "table-row");
                $(this).removeClass("icon-jia");
                $(this).addClass("icon-jian");
            } else if ($(this).hasClass('icon-jian')) {
                $('#tr_goods_list_'+cid).css("display", "none");
                $(this).removeClass("icon-jian");
                $(this).addClass("icon-jia");
            }
        });

        //商品导入
        $('#import_goods').on('click', function() {
            $.dialog({
                width: 560,
                height: 300,
                title: "批量导入",
                content: "url:" + SITE_URL + '?ctl=Seller_Goods&met=importGoods&typ=e',
                lock: !0
            })
        });

        $('.check_recommend').change(function () {
            var common_id = $(this).data('cid');
            var isChecked = $(this).prop("checked");
            var recommend = isChecked?2:1;

            $.ajax({
                url: SITE_URL+'?ctl=Seller_Goods&met=editGoodsRecommend&typ=json',
                data:{'common_id':common_id,'recommend':recommend},
                type:'post',
                success:function(a){
                }
            });
        });

        $('.dropdown').hover(function() {
            $(this).addClass("hover");
        }, function() {
            $(this).removeClass("hover");
        });
    });



</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>



