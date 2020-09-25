<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>

<div class="form-style">
	<div class="alert">
        <ul>
            <li><?=_('1、您只能发布50个优惠套装活动；每个活动最多可以添加5个商品。')?></li>
            <li>2、凡选择指定优惠的商品，在这个商品的详细页将出现发布的优惠套装。</li>
      		<li>3、特殊商品不能参加该活动。</li>
        </ul>
	</div>
    <form method="post" id="form" action="<?=YLB_Registry::get('url')?>?ctl=Seller_Promotion_Bundling&met=editBundling&typ=e">
    
	  <?php if (!empty($data)){?>
      <input type="hidden" name="bundling_id" value="<?php echo $data['bundling_id'];?>" />
      <?php }?>
        <dl>
            <dt><i>*</i><?=_('活动名称')?>：</dt>
            <dd>
                <input type="text" name="bundling_name" class="text w450" value="<?=@$data['bundling_name']?>"/>
                <p class="hint"><?=_('活动标题名称长度最多可输入30个字符')?></p>
            </dd>
        </dl>
        <dl>
            <dt><i>*</i><?=_('优惠套装价格')?>：</dt>
            <dd>
              <input id="bundling_price" name="bundling_price" type="text" readonly style="background:#E7E7E7 none;" class="text w60 mr5" value="<?=$data['bundling_discount_price']?>"/>
              <p class="hint"><?=_('原价')?><span nctype="cost_price" class="price mr5 ml5"><?=$data['old_total_price'] ?></span><?=_('&nbsp;元 (已添加搭配商品的默认价格总计)')?></p>
            </dd>
        </dl>
        <dl>
            <dt><i>*</i><?=_('套装商品')?>：</dt>
            <dd>
              <p>
                <input id="bundling_goods" type="hidden" value="" name="bundling_goods">
                <span></span></p>
              <table class="ncsc-default-table mb15">
                <thead>
                  <tr>
                    <th class="w70">指定优惠</th>
                    <th class="tl" colspan="2">商品名称</th>
                    <th class="w70">原价</th>
                      <th class="w70">分享优惠</th>
                      <th class="w70">分享后</th>
                    <th class="w70">优惠价格</th>

                    <th class="w70">操作</th>
                  </tr>
                </thead>
                <tbody nctype="bundling_data"  class="bd-line tip" title="<?=_('上下拖移商品列可自定义显示排序；')?>">
                  <tr style="display:none;">
                    <td colspan="20" class="norecord"><div class="no-promotion"><i class="zh"></i><span>优惠套装还未选择添加商品。</span></div></td>
                  </tr>
                  <?php if(!empty($data['goods_list'])){?>
                  	<?php foreach($data['goods_list'] as $val){?>
                  		<?php if (isset($val['goods_id'])) {?>
                  			<tr id="bundling_tr_<?php echo $val['goods_id']?>" class="off-shelf">
                                <input type="hidden" value="<?php echo $val['bundling_goods_id'];?>" name="goods[<?php echo $val['goods_id'];?>][bundling_goods_id]" />
                                <input type="hidden" value="<?php echo $val['goods_id'];?>" name="goods[<?php echo $val['goods_id'];?>][gid]" nctype="goods_id">
                                
                                <td class="w70">
                                	<input type="checkbox" name="goods[<?php echo $val['goods_id'];?>][appoint]" value="1" <?php if ($val['bundling_appoint'] == 1) {?>checked="checked"<?php }?>>
                            	</td>
                                <td class="w50">
                                	<div class="shelf-state">
                                		<div class="pic-thumb">
                                            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$val['goods_id']?>" target="_blank"><img src="<?php echo $val['goods_image'];?>" ncname="<?php echo $data['goods_list'][$val['goods_id']]['goods_image'];?>" nctype="bundling_data_img"></a>
                                    	</div>
                                	</div>
                                </td>
                                <td class="tl">
                                	<dl class="goods-name">
                                    	<dt style="width: 300px;">
                                            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$val['goods_id']?>" target="_blank"><?php echo $val['goods_name'];?></a>
                                            <span><?=$val['goods_spec']?></span>
                                        </dt>
                                  	</dl>
                              	</td>
                                <td class="goods-price w70" nctype="bundling_data_price"><?php echo $val['goods_price']?></td>
                                <td class="share_sum_price w70" nctype="share_sum_price"><?php echo $val['share_sum_price']?></td>
                                <td class="shared_price w70" nctype="shared_price"><?=number_format($val['goods_price']-$val['share_sum_price'],2)?></td>
                                <td class="w90">
                                  <input nctype="price" type="text" value="<?php echo $val['bundling_goods_price']?>" name="goods[<?php echo $val['goods_id'];?>][price]" class="text w70">
                                </td>
                                <td class="nscs-table-handle w90">
                                	<span>
                                		<a onclick="bundling_operate_delete($('#bundling_tr_<?php echo $val['goods_id']?>'), <?php echo $val['goods_id']?>)" href="JavaScript:void(0);" class="btn-bittersweet">
                                    		<i class="iconfont icon-quxiaodingdan"></i>
                                      		<p><?=_('移除')?></p>
                                  		</a>
                              		</span>
                          		</td>
                            </tr>
                  		<?php }?>
                  	<?php }?>
                  <?php }?>
                </tbody>
              </table>
                <div class="mb10 clearfix">
                    <a id="bundling_add_goods" class="button bbc_seller_btns" href="javascript:void(0);">
                        <i class="iconfont icon-jia"></i><?=_('添加商品')?>
                    </a>
                </div>
                <div class="search-goods-list fn-clear">
                    <div class="search-goods-list-hd">
                        <label><?=_('第一步：搜索店内商品')?></label>
                        <input type="text w150" class="text" id="search_goods_name" value="<?php echo $_GET['keyword'];?>"/>
                        <a class="button btn_search_goods" href="javascript:void(0);">
                            <i class="iconfont icon-btnsearch"></i><?=_('搜索')?>
                        </a>
                    </div>
                    <div class="search-goods-list-bd fn-clear"></div>
                    <a id="btn_hide_goods_select" class="close btn_hide_search_goods" href="javascript:void(0);">X</a>
                </div>
        </dl>
        
        <dl>
        <dt><i>*</i><?=_('运费承担')?>：</dt>
        <dd>
            <ul class="ncsc-form-radio-list">
            	<li>
                  	<label for="whops_seller">
                  		<input id="whops_seller" type="radio" name="bundling_freight_choose" <?php if(@$data['bundling_freight_choose'] == '1'){?>checked="checked"<?php }?>  value="1" /><?=_('卖家承担运费')?>
              		</label>
      			</li>
                <li>
                	<label for="whops_buyer">
                	<input id="whops_buyer" type="radio" name="bundling_freight_choose" <?php if(@$data['bundling_freight_choose'] == '0'){?>checked="checked"<?php }?> value="0" /><?=_('买家承担运费')?></label>
                	<div id="whops_buyer_box" class="transport_tpl" <?php if(@$data['bundling_freight_choose'] == '1'){?>style="display:none;"<?php }?> >
                		<input class="w50 text" type="text" name="bundling_freight" value="<?=@$data['bundling_freight']?>" />
                		<em class="add-on">
                		<i class="icon-renminbi">元</i>
                		</em>
                	</div>
                </li>
            </ul>
        </dd>
        </dl>
        <dl>
            <dt>每人限购：</dt>
            <dd>
                <ul class="ncsc-form-radio-list">
                    <li>
                        <label>
                            <input type="radio" name="is_limit" <?php if(!$data['bunlding_limit']){?>checked="checked"<?php }?>  value="0" /><?=_('否')?>
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="radio" name="is_limit" <?php if($data['bunlding_limit']){?>checked="checked"<?php }?> value="1" /><?=_('是')?>
                        </label>
                        <div  id="buy_limit" <?php if(!$data['bunlding_limit']){?>style="display:none;"<?php }?> >
                            <input class="w50 text" type="text" name="limit" value="<?=@$data['bunlding_limit']?>" />
                            <em class="add-on">
                                <i class="icon-renminbi">件</i>
                            </em>
                        </div>
                    </li>
                </ul>
            </dd>
        </dl>
        <dl>
        <dt><i>*</i><?=_('活动状态')?>：</dt>
        <dd>
            <ul class="ncsc-form-radio-list">
                <li>
                	<label for="bundling_status_1">
                		<input type="radio" name="bundling_state" <?php if(@$data['bundling_state'] == '1'){?>checked="checked"<?php }?> value="1" id="bundling_status_1"  /><?=_('开启')?>
            		</label>
        		</li>
                <li>
                	<label for="bundling_status_0">
                		<input type="radio" name="bundling_state" <?php if(@$data['bundling_state'] == '2'){?>checked="checked"<?php }?> value="2" id="bundling_status_0" /><?=_('关闭')?>
            		</label>
        		</li>
            </ul>
        </dd>
        </dl>
		
        <dl>
            <dt></dt>
            <dd>
                <input type="submit" class="button button_blue bbc_seller_submit_btns" value="提交"  />
            </dd>
        </dl>
    </form>
</div>

<link  href="<?=$this->view->css?>/bundling.css" rel="stylesheet"></link>
<script type="text/javascript" src="<?=$this->view->js?>/jquery.ajaxContent.pack.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js?>/bundling.js" charset="utf-8"></script>
<script>
    $(function () {
        if(<?=@$data['bunlding_limit']?>){
            //是否限购
            $('input[name="is_limit"][value="1"]').prop("checked", "checked");
            $('input[name="limit"]').val(<?=@$data['bunlding_limit']?>).parent().show();
            $('input[name="is_limit"]').click(function(){
                if($(this).val() == '1'){
                    $('input[name="limit"]').val(1).parent().show();
                }else{
                    $('input[name="limit"]').val(1).parent().hide();
                }
            });
        }else{
            $('input[name="is_limit"][value="0"]').prop("checked", "checked");
            $('input[name="is_limit"]').click(function(){
                if($(this).val() == '1'){
                    $('input[name="limit"]').val(1).parent().show();
                }else{
                    $('input[name="limit"]').val(1).parent().hide();
                }
            });
        }

        //页面输入内容验证
        $('#form').validator({
            debug: true,
            ignore: ':hidden',
            theme: 'yellow_right',
            timely: 1,
            stopOnError: false,
            fields: {
                'bundling_name': 'required;length[~30]',
                'bundling_price': 'required;float[+]'
            },
            valid: function(form) {
                var me = this;
                me.holdSubmit(function() {
                    Public.tips.error('正在处理中...');
                });
                $.ajax({
                    url: "index.php?ctl=Seller_Promotion_Bundling&met=editBundling&typ=json",
                    data: $(form).serialize(),
                    type: "POST",
                    success: function(e) {
                        if (e.status == 200) {
                            Public.tips.success('操作成功!');
                            location.href = "index.php?ctl=Seller_Promotion_Bundling&met=index&typ=e"; //成功后跳转
                        } else {
                            Public.tips.error('操作失败,' + e.msg);
                        }
                        me.holdSubmit(false);
                    }
                });
            }
        });
    })

</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>

