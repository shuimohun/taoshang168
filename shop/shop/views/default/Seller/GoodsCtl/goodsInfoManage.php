<?php if (!defined('ROOT_PATH')){exit('No Permission');}
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>

    <link href="<?=$this->view->css_com?>/webuploader.css" rel="stylesheet">
    <link href="<?= $this->view->css_com ?>/jquery/plugins/dialog/green.css" rel="stylesheet">
    <script src="<?=$this->view->js_com?>/webuploader.js"></script>
    <script src="<?=$this->view->js_com?>/upload/upload_image.js"></script>
    <script type="text/javascript" src="<?= $this->view->js_com ?>/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="<?= $this->view->js_com ?>/ueditor/ueditor.all.js"></script>
    <script type="text/javascript" src="<?= $this->view->js_com ?>/upload/addCustomizeButton.js"></script>
    <script type="text/javascript" src="<?=$this->view->js?>/common.js"></script>
    <script type="text/javascript" src="<?=$this->view->js?>/store_goods_add.step2.js"></script>
    <script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/jquery.dialog.js"></script>
    <style>
        div.tip-yellowsimple{visibility:hidden;position:absolute;top:0;left:0}
        div.tip-yellowsimple table,div.tip-yellowsimple td{margin:0;font-family:inherit;font-size:inherit;font-weight:inherit;font-style:inherit;font-variant:inherit}
        div.tip-yellowsimple td.tip-bg-image span{display:block;font:1px/1px sans-serif;height:10px;width:10px;overflow:hidden}
        div.tip-yellowsimple td.tip-right{background-position:100% 0}
        div.tip-yellowsimple td.tip-bottom{background-position:100% 100%}
        div.tip-yellowsimple td.tip-left{background-position:0 100%}
        div.tip-yellowsimple div.tip-inner{background-position:-10px -10px}
        div.tip-yellowsimple div.tip-arrow{visibility:hidden;position:absolute;overflow:hidden;font:1px/1px sans-serif}
        div.tip-yellowsimple{visibility:hidden;position:absolute;top:0;left:0}
        div.tip-yellowsimple table,div.tip-yellowsimple td{margin:0;font-family:inherit;font-size:inherit;font-weight:inherit;font-style:inherit;font-variant:inherit}
        div.tip-yellowsimple td.tip-bg-image span{display:block;font:1px/1px sans-serif;height:10px;width:10px;overflow:hidden}
        div.tip-yellowsimple td.tip-right{background-position:100% 0}
        div.tip-yellowsimple td.tip-bottom{background-position:100% 100%}
        div.tip-yellowsimple td.tip-left{background-position:0 100%}
        div.tip-yellowsimple div.tip-inner{background-position:-10px -10px}
        div.tip-yellowsimple div.tip-arrow{visibility:hidden;position:absolute;overflow:hidden;font:1px/1px sans-serif}

        .ncsc-form-checkbox-list li,.ncsc-form-radio-list li{font-size:12px;vertical-align:top;letter-spacing:normal;word-spacing:normal;display:inline-block;margin-right:30px}
        .spec select{width:100%}
        .ncsc-form-checkbox-list li .checkbox,.ncsc-form-checkbox-list li input[type=checkbox],.ncsc-form-radio-list li .radio,.ncsc-form-radio-list li input[type=radio]{vertical-align:middle;margin-right:4px}
        .ncsc-form-radio-list li .transport-name{line-height:20px;color:#555;background-color:#F5F5F5;display:none;height:20px;padding:4px;margin-right:4px;border:dotted 1px #DCDCDC}
        #uploadButton .webuploader-pick{margin-top:10px}
        .spec_right .text{width:92%}
        #addTransport{background:#e02222;color:#fff!important;border-radius:2px;border:none;cursor:pointer;margin-left:10px}
    </style>
    <div class="goods">
        <ol class="step fn-clear clearfix add-goods-step">
            <li>
                <i class="icon iconfont icon-icoordermsg"></i>
                <h6>STEP 1</h6>

                <h2>选择分类</h2>
                <i class="arrow iconfont icon-btnrightarrow"></i>
            </li>
            <li class="cur">
                <i class="icon iconfont icon-shangjiaruzhushenqing bbc_seller_color"></i>
                <h6 class="bbc_seller_color">STEP 2</h6>

                <h2 class="bbc_seller_color">填写信息</h2>
                <i class="arrow iconfont icon-btnrightarrow"></i>
            </li>
            <li>
                <i class="icon iconfont icon-zhaoxiangji "></i>
                <h6>STEP 3</h6>

                <h2>上传图片</h2>
                <i class="arrow iconfont icon-btnrightarrow"></i>
            </li>
            <li>
                <i class="icon iconfont icon-icoduigou"></i>
                <h6>STEP 4</h6>

                <h2>发布成功</h2>
            </li>
            <li>
                <i class="icon iconfont icon-pingtaishenhe"></i>
                <h6>STEP 5</h6>

                <h2>平台审核</h2>
            </li>
        </ol>
        <div class="form-style">
            <form method="post" id="form">
                <h3><b><em>*</em>表示该项必填</b><i class="iconfont icon-edit"></i>商品基本信息</h3>
                <dl>
                    <dt>商品分类：</dt>
                    <dd>
                        <?php echo $data['cat_directory']; ?>
                        <input type="hidden" name="common_id" value="<?php if ( !empty($common_data) ) { echo $common_data['common_id']; } ?>"/>
                        <input type="hidden" name="action" value="<?php if ( !empty($common_data) ) { echo 'edit'; } ?>"/>
                        <input type="hidden" name="cat_pid" value="<?php echo $cat_pid ?>"/>
                        <input type="hidden" name="cat_id" value="<?php echo $cat_id ?>"/>
                        <input type="hidden" name="cat_name" value="<?php echo $data['cat_directory']; ?>"/>
                        <?php if(!$common_data['common_parent_id']){ ?>
                            <a class="bbc_seller_btns js-edit-goods button button_blue" href="<?php echo YLB_Registry::get('url') . '?ctl=Seller_Goods&met=add&typ=e&'; ?>">编辑</a>
                        <?php }?>
                    </dd>
                </dl>
                <?php if ( !empty($data['brand']) || !empty($data['property']) ) {  ?>
                    <dl>
                        <dt>商品属性：</dt>
                        <dd>
                            <div class="goods_property">
                                <p>填错商品属性，可能会引起商品下架，影响您的正常销售。请认真准确填写</p>

                                <div class="spec">
                                    <ul>
                                        <?php if ( !empty($data['brand']) ) { ?>
                                            <li>
                                                <div class="spec_left">品牌：</div>
                                                <div class="spec_right">
                                                    <input name="brand_name" value="" type="hidden" />
                                                    <select name="brand_id" class="w250" onchange="brandName(this)" >
                                                        <option value="">请选择</option>
                                                        <?php foreach ( $data['brand'] as $key => $val ) { ?>
                                                            <option <?php if(!empty($common_data) && $common_data['brand_id']==$val['brand_id']) echo 'selected'; ?> value="<?php echo $val['brand_id']; ?>"><?php echo $val['brand_name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <script>
                                                    function brandName(e) {
                                                        var brandName = $(e).find(':selected').html();
                                                        $('input[name="brand_name"]').val(brandName);
                                                    }
                                                </script>
                                            </li>
                                        <?php } ?>

                                        <?php if( !empty($data['property']) ) { ?>
                                            <?php foreach ( $data['property'] as $key => $val ) { ?>
                                                <?php if ( $val['property_format'] == 'select' ) { ?>
                                                    <li>
                                                        <div class="spec_left"><?php echo $val['property_name'] ?>：</div>
                                                        <div class="spec_right">
                                                            <input type='hidden' name='property[property_<?php echo $val['property_id']; ?>][0]' value='<?php echo $val['property_name']; ?>'/>
                                                            <input type='hidden' name='property[property_<?php echo $val['property_id']; ?>][2]' value='select'/>

                                                            <select name='property[property_<?php echo $val['property_id']; ?>][1]'>
                                                                <?php if ( !empty($val['property_values']) ) { ?>
                                                                    <?php foreach ($val['property_values'] as $k => $v){ ?>
                                                                        <option <?php if ( !empty($common_data) && $common_data['common_property']['property_' . $val['property_id']][1] == $v['property_value_id'] ) { echo 'selected'; } ?> value='<?php echo $v['property_value_id'] ?>'><?php echo $v['property_value_name']; ?></option>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </li>
                                                <?php }else if ( $val['property_format'] == 'checkbox' ) {  ?>
                                                    <li>
                                                        <div class="spec_left"><?php echo $val['property_name'] ?>：</div>
                                                        <div class="spec_right">
                                                            <ul>
                                                                <?php if ( !empty($val['property_values']) ) { ?>
                                                                    <input type='hidden' name='property[property_<?php echo $val['property_id']; ?>][0]' value='<?php echo $val['property_name']; ?>'/>
                                                                    <input type='hidden' name='property[property_<?php echo $val['property_id']; ?>][2]' value='checkbox'/>
                                                                    <?php foreach ($val['property_values'] as $k => $v){ ?>
                                                                        <li>
																<span data-type="input_checkbox">
																	<input type="checkbox" value="<?php echo $v['property_value_id'] ?>" data-type="<?php echo $v['property_value_id'] ?>" name="property[property_<?php echo $val['property_id']; ?>][1][<?php echo $v['property_value_id']; ?>]">
																</span>
                                                                            <span data-type="pv_name"><?php echo $v['property_value_name']; ?></span>
                                                                        </li>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                <?php } else { ?>
                                                    <li>
                                                        <div class="spec_left"><?php echo $val['property_name'] ?>：</div>
                                                        <div class="spec_right">
                                                            <input type='hidden' name='property[property_<?php echo $val['property_id']; ?>][0]' value='<?php echo $val['property_name']; ?>'/>
                                                            <input type='hidden' name='property[property_<?php echo $val['property_id']; ?>][2]' value='text'/>
                                                            <input class='text' type='text' name='property[property_<?php echo $val['property_id']; ?>][1]' value='<?php if ( !empty($common_data) ) { echo $common_data['common_property']['property_' . $val['property_id']][1]; } ?>'>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                    <div style="clear:both;"></div>
                                </div>
                            </div>
                        </dd>
                    </dl>
                <?php } ?>
                <dl>
                    <dt><i>*</i>商品名称：</dt>
                    <dd>
                        <input type="text" maxlength="70" name="name" class="text w600" value="<?php if( !empty($common_data) ) { echo $common_data['common_name']; } ?>" />

                        <p class="hint">商品标题名称长度至少10个字符，最长70个汉字</p>
                    </dd>
                </dl>
                <dl>
                    <dt>促销提示：</dt>
                    <dd>
                        <textarea class="text textarea w450" maxlength="140" name="promotion_tips"><?php if( !empty($common_data) ) { echo $common_data['common_promotion_tips']; } ?></textarea>

                        <p class="hint">促销提示不能超过140个汉字</dd>
                    </dd>
                </dl>
                <?php if($this->shop_base['shop_type'] == 2){?>
                    <dl>
                        <dt><i>*</i>支持代发货：</dt>
                        <dd>
                            <label class="radio"><input type="radio" <?php if(isset($common_data) && $common_data['product_is_behalf_delivery']==1 || !isset($common_data)) echo 'checked'; ?> name="product_is_behalf_delivery" value="1">是</label>
                            <label class="radio"><input type="radio" <?php if(isset($common_data) && $common_data['product_is_behalf_delivery']==0) echo 'checked'; ?> name="product_is_behalf_delivery" value="0">否</label>

                            <p class="hint">支持代发货，则可以直接将产品上架或者放入仓库<br/>不支持代发货，则只是将商品复制到分销商仓库中。</p>
                        </dd>
                    </dl>
                <?php }?>
                <dl>
                    <dt><i>*</i><?php if(@$this->shop_base['shop_type'] == 2){ ?>供货价：<?php }else{ ?>商品价格：<?php } ?></dt>
                    <dd>
                        <input type="text" class="text w60" id="price" name="price" value="<?php if( !empty($common_data) ) { echo $common_data['common_price']; } ?>" <?php if(!empty($common_data) && @$common_data['common_parent_id']>0 && @$common_data['product_is_allow_price'] !=1){?> readonly="readonly" <?php }?>/><em><?=Web_ConfigModel::value('monetary_unit')?></em>
                        <input type="hidden" name="common_parent_id" id="common_parent_id" value="<?=@$common_data['common_parent_id']?>">
                        <input type="hidden" name="min_price" id="min_price" value="<?=@$common_data['goods_recommended_min_price']?>">
                        <input type="hidden" name="max_price" id="max_price" value="<?=@$common_data['goods_recommended_max_price']?>">
                        <p class="hint">价格必须是0.01~9999999之间的数字，此价格为商品的实际销售价格，如果商品受属性限制，则该商品以低价格呈现（不包括分享后成交价）。
                            <?php if(!empty($common_data) && @$common_data['common_parent_id'] > 0){?>
                                <br/>修改价格范围为：<?=$common_data['goods_recommended_min_price'] ?> - <?=$common_data['goods_recommended_max_price']?>
                            <?php }?>
                        </p>
                    </dd>
                </dl>
                <dl class="fx_cj" style="display: <?php if($this->shop_base['shop_type'] == 2){echo 'none';}else{echo 'block';}?>;">
                    <dt><i>*</i>分享后成交价：</dt>
                    <dd>
                        <input type="text" class="text w60" name="market_share_price" value=""/><em><?=Web_ConfigModel::value('monetary_unit')?></em>
                        <p>消费者完成分享后的商品实际成交价格。</p>
                    </dd>
                </dl>

                <?php if(@$this->shop_base['shop_type'] == 2){ ?>
                    <dl class="fx_rl">
                        <dt><i>*</i>分享让利：</dt>
                        <dd>
                            <input type="text" class="text w60" name="share_sum_price" value=""/><em><?=Web_ConfigModel::value('monetary_unit')?></em>
                            <p>消费者完成分享后的商品实际成交价格。</p>
                        </dd>
                    </dl>
                <?php } ?>
                <dl>
                    <dt><i>*</i>市场价：</dt>
                    <dd>
                        <input type="text" class="text w60" name="market_price" value="<?php if( !empty($common_data) ) { echo $common_data['common_market_price']; } ?>"/><em><?=Web_ConfigModel::value('monetary_unit')?></em>
                        <p class="hint">价格必须是0.01~9999999之间的数字，此价格仅为市场同类商品的参考售价，请根据市场实际情况填写，不能虚构。</p>
                    </dd>
                </dl>
                <dl>
                    <dt>成本价：</dt>
                    <dd>
                        <input type="text" class="text w60" name="cost_price" value="<?php if( !empty($common_data) ) { echo $common_data['common_cost_price']; } ?>"/><em><?=Web_ConfigModel::value('monetary_unit')?></em>
                        <p class="hint">价格必须是0.01~9999999之间的数字，此价格为商户对所销售商品的实际成本价格进行备注，非必填项。</p>
                    </dd>
                </dl>
                <?php if(@$this->shop_base['shop_type'] == 2){ ?>
                <dl>
                    <dt>最低零售价：</dt>
                    <dd>
                        <input type="text" class="text" name="goods_recommended_min_price" id="goods_recommended_min_price"  value="<?php if( !empty($common_data) ) { echo $common_data['goods_recommended_min_price']; } ?>"/>

                        <p class="hint">最低零售价。分销商设置的销售价格不能低于最低零售价格。</p>
                    </dd>
                </dl>

                <dl>
                    <dt>最高零售价：</dt>
                    <dd>
                        <input type="text" class="text" name="goods_recommended_max_price" id="goods_recommended_max_price" value="<?php if( !empty($common_data) ) { echo $common_data['goods_recommended_max_price']; } ?>"/>

                        <p class="hint">最高零售价。分销商设置的销售价格不能低于最高零售价格。</p>
                    </dd>
                </dl>
                <?php } ?>
                <dl>
                    <dt>淘金链接：</dt>
                    <dd>
                        <input type="text" class="text w600" name="tj_link" value="<?php if( !empty($common_data) ) { echo $common_data['tj_link']; } ?>"/>
                        <p class="hint">淘金链接。</p>
                    </dd>
                </dl>

                <!--↓↓↓↓↓↓↓↓↓分享立减Zhenzh↓↓↓↓↓↓↓↓↓-->
                <h3><b><em>*</em>表示该项必填</b><i class="iconfont icon-edit"></i>分享立减推广</h3>
                <dl>
                    <dt><i>*</i>分享限购件数</dt>
                    <dd>
                        <input type="text" class="text" name="share_limit" maxlength="6" value="<?php if( !empty($goods_share_data) ) { echo $goods_share_data['share_limit']; }else{echo '1';} ?>"/>
                        <p class="hint">限制消费者购买的件数，件数必须是1~999999之间的整数。</p>
                    </dd>
                </dl>
                <dl>
                    <dt><i>*</i>社交类型</dt>
                    <dd>
                        <div class="share">
                            <div  class="share_d">
                                <span class="share_s wx_single"></span>
                                <input type="text" class="text w60 share_price" name="share_weixin" value="<?php if( !empty($goods_share_data) ) { echo $goods_share_data['weixin']; }else{ echo '0.1';} ?>"/><em><?=Web_ConfigModel::value('monetary_unit')?></em>
                            </div>
                            <div  class="share_d">
                                <span class="share_s wx_timeline"></span>
                                <input type="text" class="text w60 share_price" name="share_weixin_timeline" value="<?php if( !empty($goods_share_data) ) { echo $goods_share_data['weixin_timeline']; }else{ echo '0.1';} ?>"/><em><?=Web_ConfigModel::value('monetary_unit')?></em>
                            </div>
                            <div  class="share_d">
                                <span class="share_s sqq"></span>
                                <input type="text" class="text w60 share_price" name="share_sqq" value="<?php if( !empty($goods_share_data) ) { echo $goods_share_data['sqq']; }else{ echo '0.1';} ?>"/><em><?=Web_ConfigModel::value('monetary_unit')?></em>
                            </div>
                            <div  class="share_d">
                                <span class="share_s qzone"></span>
                                <input type="text" class="text w60 share_price" name="share_qzone" value="<?php if( !empty($goods_share_data) ) { echo $goods_share_data['qzone']; }else{ echo '0.1';} ?>"/><em><?=Web_ConfigModel::value('monetary_unit')?></em>
                            </div>
                            <div  class="share_d">
                                <span class="share_s weibo"></span>
                                <input type="text" class="text w60 share_price" name="share_tsina" value="<?php if( !empty($goods_share_data) ) { echo $goods_share_data['tsina']; }else{ echo '0.1';} ?>"/><em><?=Web_ConfigModel::value('monetary_unit')?></em>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <p class="hint">消费者将商品分享到各社交平台可获得相应的减免额度，最终减免额度以消费者所分享平台数量叠加决定（五个社交平台）</p>
                    </dd>
                </dl>
                <h3><b><em>*</em>表示该项必填</b><i class="iconfont icon-edit"></i>分享推广</h3>
                <dl>
                    <dt>是否使用</dt>
                    <dd>
                        <label for="whops_seller">
                            <input id="whops_seller" type="radio" name="is_promotion" <?php if(@$goods_share_data['is_promotion'] == '1' || empty($goods_share_data)){?>checked="checked"<?php }?>  value="1" /><?=_('使用')?>
                        </label>
                        <label for="whops_buyer">
                            <input id="whops_buyer" type="radio" name="is_promotion" <?php if(@$goods_share_data['is_promotion'] == '0'){?>checked="checked"<?php }?> value="0" /><?=_('不使用')?>
                        </label>
                    </dd>
                </dl>
                <dl>
                    <dt><i>*</i>推广金</dt>
                    <dd>
                        <div  class="extension">
                            <div   class="extension_j">
                                <span>总推广金：</span>
                                <input type="text" class="text w60" name="promotion_total_price" value="<?php if( !empty($goods_share_data) ) { echo $goods_share_data['promotion_total_price']; }else{ echo '0.1';} ?>"/><em><?=Web_ConfigModel::value('monetary_unit')?></em>
                            </div>
                            <div   class="extension_j">
                                <span>单次点击推广金：</span>
                                <input type="text" class="text w60" name="promotion_unit_price" value="<?php if( !empty($goods_share_data) ) { echo $goods_share_data['promotion_unit_price']; }else{ echo '0.1';} ?>"/><em><?=Web_ConfigModel::value('monetary_unit')?></em>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <p class="hint">消费者分享后点击链接后所获取的金额为推广金，购买成交后获取，支付上限为推广金额设置金额。</p>
                    </dd>
                </dl>
                <!--↑↑↑↑↑↑↑↑↑↑↑分享立减Zhenzh↑↑↑↑↑↑↑↑↑↑↑-->

                <dl>
                    <dt><i>*</i>商品库存：</dt>
                    <dd>
                        <input type="text" class="text" name="stock" maxlength="8" <?php if( !empty($common_data) && $common_data['common_parent_id'] > 0 ){?> readonly="readonly" <?php }?> value="<?php if( !empty($common_data) ) { echo $common_data['common_stock']; } ?>"/>

                        <p class="hint">商铺库存数量必须为0~99999999之间的整数<br/>若启用了库存配置，则系统自动计算商品的总数，此处无需卖家填写</p>
                    </dd>
                </dl>
                <dl>
                    <dt>库存预警值：</dt>
                    <dd>
                        <input type="text" class="text" name="alarm" id="alarm" maxlength="3" value="<?php if( !empty($common_data) ) { echo $common_data['common_alarm']; } ?>"/>

                        <p class="hint">设置最低库存预警值。当库存低于预警值时商家中心商品列表页库存列红字提醒。<br/>请填写0~999的数字，0为不预警。</p>
                    </dd>
                </dl>
                <?php
                //供应商店铺
                if(@$this->shop_base['shop_type'] == 2)
                {
                    ?>


                    <dl>
                        <dt><i>*</i>允许修改价格：</dt>
                        <dd>
                            <label class="radio"><input type="radio" <?php if(isset($common_data) && $common_data['product_is_allow_price']==1 || !isset($common_data)) echo 'checked'; ?> name="product_is_allow_price" value="1">是</label>
                            <label class="radio"><input type="radio" <?php if(isset($common_data) && $common_data['product_is_allow_price']==0) echo 'checked'; ?> name="product_is_allow_price" value="0">否</label>

                            <p class="hint">是否允许分销商修改商品的销售价格。</p>
                        </dd>
                    </dl>

                    <dl>
                        <dt><i>*</i>允许编辑内容：</dt>
                        <dd>
                            <label class="radio"><input type="radio" <?php if(isset($common_data) && $common_data['product_is_allow_update']==1) echo 'checked'; ?> name="product_is_allow_update" value="1">是</label>
                            <label class="radio"><input type="radio" <?php if((isset($common_data) && $common_data['product_is_allow_update']==0) || !isset($common_data)) echo 'checked'; ?> name="product_is_allow_update" value="0">否</label>

                            <p class="hint">是否允许分销商修改商品的内容。</p>
                        </dd>
                    </dl>


                    <dl>
                        <dt>淘金说明：</dt>
                        <dd>
                            <textarea class="text textarea n-valid" style="width:70%" name="common_distributor_description"><?php if( !empty($common_data) ) { echo $common_data['common_distributor_description']; } ?></textarea>
                        </dd>
                    </dl>

                <?php } ?>
                <dl>
                    <dt>商家货号：</dt>
                    <dd>
                        <input type="text" class="text" name="code" id="code" maxlength="40" value="<?php if( !empty($common_data) ) { echo $common_data['common_code']; } ?>"/>

                        <p class="hint">商家货号是指商家管理商品的编号<Br/>最多可输入20个字符，支持输入字母、数字</p>
                    </dd>
                </dl>

                <?php if ( !empty($data['spec'])) {  ?>
                    <?php foreach ( $data['spec'] as $key => $val ) { ?>

                        <dl nctype="spec_group_dl" spec_img="<?= $val['spec_img']; ?>" nc_type="spec_group_dl_<?php echo $key; ?>" data-type="spec_dl_<?php echo $key; ?>" <?php if(@$common_data['common_parent_id']) echo 'style="display:none;"';?>>
                            <dt>
                                <input maxlength="4" class="text w60" type="text" name="spec_name[<?php echo $val['spec_id']; ?>]" value="<?php echo $val['spec_name']; ?>" nctype="spec_name" data-type="spec_name" data-param="{id:<?php echo $val['spec_id'] ?>,name:'<?php echo $val['spec_name']; ?>'}">：
                            </dt>
                            <dd class="spec spec_pd">
                                <ul>
                                    <?php if ( !empty($val['spec_values']) && is_array($val['spec_values']) ) { ?>
                                        <?php foreach ( $val['spec_values'] as $k => $v ) { ?>
                                            <li>
                                            <span nctype="input_checkbox" data-type="input_checkbox">
                                                <input type="checkbox"  value="<?php echo $v['spec_value_name']; ?>" nc_type="<?php echo $v['spec_value_id']; ?>" data-type="<?php echo $v['spec_value_id']; ?>" name="spec_val[<?php echo $val['spec_id']; ?>][<?php echo $v['spec_value_id']; ?>]">
                                            </span>
                                                <span nctype="pv_name" data-type="pv_name"><?php echo $v['spec_value_name']; ?></span>
                                            </li>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if(!isset($common_data) || (isset($common_data) && $common_data['common_parent_id'] == '0')){?>
                                        <li data-param="{class_id:<?php echo $data['cat_id']; ?>,spec_id:<?php echo $val['spec_id']; ?>}">
                                            <div data-type="add-spec1"><a data-type="add-spec" class="bbc_seller_btns button addspec" href="javascript:void(0);"><i class="iconfont icon-jia"></i>添加规格值</a></div>

                                            <div style="display:none;" data-type="add-spec2">
                                                <input type="text" maxlength="40" placeholder="规格值名称" class="text w60">
                                                <a class="button button_blue" data-type="add-spec-submit" href="javascript:void(0);">确认</a>
                                                <a class="button button_red" data-type="add-spec-cancel"href="javascript:void(0);">取消</a>
                                            </div>

                                        </li>
                                    <?php }?>
                                </ul>
                            </dd>
                        </dl>

                    <?php } ?>
                <?php } ?>
                <dl nc_type="spec_dl" data-type="spec_dl" style="display:none">
                    <dt>库存配置：<br> <a class="batch_modify bbc_seller_btns button" href="javascript:;">批量修改</a></dt>
                    <dd class="spec-dd">
                        <table border="0" cellpadding="0" cellspacing="0" class="spec_table">
                            <thead>
                            <?php if ( !empty($data['spec']) ) { ?>
                                <?php foreach ($data['spec'] as $key => $val){ ?>
                                    <th class="tl" nctype="spec_name_<?php echo $key; ?>" data-type="spec_name_<?php echo $key; ?>"><?php echo $val['spec_name']; ?></th>
                                <?php } ?>
                            <?php } ?>
                            <th width="90">市场价</th>
                            <th width="90"><?php if(@$this->shop_base['shop_type'] == 2){ ?>供货<?php } ?>价格</th>
                            <?php if(@$this->shop_base['shop_type'] == 2||@$common_data['common_parent_id']){ ?>
                                <th width="90">最低零售价</th>
                                <th width="90">最高零售价</th>
                            <?php } ?>
                            <th width="60">库存</th>
                            <th width="60">预警值</th>
                            <th width="100">商家货号</th>
                            </thead>
                            <tbody data-type="spec_table" nc_type="spec_table">
                            </tbody>
                        </table>

                        <p class="hint">商品规格的价格，必须在供应商设置的最低零售价和最高零售价之间。<br/>若分销商填写的价格高于最高零售价，系统会自动调整为最高零售价</p>
                    </dd>
                </dl>

                <dl>
                    <dt><i>*</i>商品图片：</dt>
                    <dd style="position:relative">
                        <div style="float: left;margin-left: -2px;"><span class="msg-box" for="imagePath"></span></div>
                        <div class="image">
                            <img id="goodsImage" height="160px" width="160px" src="<?php if( !empty($common_data) ) { echo $common_data['common_image']; } ?>" />
                            <input id="imagePath" name="imagePath" type="hidden" value="<?php if( !empty($common_data) ) { echo $common_data['common_image']; } ?>"  />
                        </div>
                        <p class="hint">上传商品默认主图，如多规格值时将默认使用该图或分规格上传各规格主图；支持jpg、gif、png格式上传，建议使用<span class="red">尺寸800x800像素以上、大小不超过1M的正方形图片</span></p>
                        <?php if(!$common_data['common_parent_id'] || $common_data['product_is_allow_update']){ ?>
                            <div id="uploadButton" style="width: 81px;height: 28px;float: left;">
                                <i class="iconfont icon-tupianshangchuan"></i>图片上传</div>
                            <a class="bbc_seller_btns ncbtn mt5 selected mt10" id="image_space" style="display: inline-block;float: left;margin-left: 20px;padding-top: 2px;padding-bottom: 2px;"><i class="icon-picture"></i>从图片空间选择</a>
                        <?php }?>
                    </dd>
                </dl>
                <h3><b><em>*</em>表示该项必填</b><i class="iconfont icon-edit"></i>商品详情描述</h3>
                <dl>
                    <dt>商品描述：</dt>
                    <dd>
                        <ul class="tab fn-clear">
                            <li class="cur"><i class="iconfont">&#xe628;</i>电脑端</li>
                        </ul>

                        <?php if ( !empty($common_detail_data) ) { ?>
                            <!--<script id="val_content" name="content" type="text/plain"><?/*=($common_detail_data['common_body'])*/?></script>-->
                            <textarea id="val_content" style="display: none;"><?=($common_detail_data['common_body'])?></textarea>
                        <?php }?>

                        <textarea name="body" id="body" style="width:100%;height:500px;">

					    </textarea>
                    </dd>
                </dl>
                <dl>
                    <dt>关联顶部版式：</dt>
                    <dd>
                        <select name="formatid_top">
                            <option value="">请选择</option>
                            <?php if( !empty($data['format_top']) ) { ?>
                                <?php foreach( $data['format_top'] as $key => $val ) { ?>
                                    <option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                        <a class="bbc_seller_btns ncbtn" target="_blank" href="<?= YLB_Registry::get('url')."?ctl=Seller_Goods&met=addFormat&typ=e&act=add" ?>">添加新版式</a>
                    </dd>
                </dl>
                <dl>
                    <dt>关联底部版式：</dt>
                    <dd>
                        <select name="formatid_bottom">
                            <option value="">请选择</option>
                            <?php if( !empty($data['format_bottom']) ) { ?>
                                <?php foreach( $data['format_bottom'] as $key => $val ) { ?>
                                    <option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                        <a class="bbc_seller_btns ncbtn" target="_blank" href="<?= YLB_Registry::get('url')."?ctl=Seller_Goods&met=addFormat&typ=e&act=add" ?>">添加新版式</a>
                    </dd>
                </dl>

                <?php if ( !empty($data['cat_is_virtual']) && $data['cat_is_virtual'] == 1 ) { ?>
                    <!-- 只有可发布虚拟商品才会显示 S -->
                    <h3 id="demo3">特殊商品</h3>
                    <dl class="special-01">
                        <dt>虚拟商品：</dt>
                        <dd>
                            <ul class="ncsc-form-radio-list">
                                <li>
                                    <input type="radio" name="is_gv" value="1" id="is_gv_1">
                                    <label for="is_gv_1">是</label>
                                </li>
                                <li>
                                    <input type="radio" name="is_gv" value="0" id="is_gv_0" checked="">
                                    <label for="is_gv_0">否</label>
                                </li>
                            </ul>
                            <p class="hint vital">*虚拟商品不能参加限时折扣和组合销售两种促销活动。也不能赠送赠品和推荐搭配。</p>
                        </dd>
                    </dl>
                    <dl class="special-01" nctype="virtual_valid" style="">
                        <dt><i class="required">*</i>商品有效期至：</dt>
                        <dd>
                            <input type="text" name="g_vindate" id="g_vindate" class="w80 text hasDatepicker" value="<?php echo date('Y-m-d'); ?>" readonly="readonly"><em class="add-on"><i class="iconfont icon-rili"></i></em>
                            <span></span>
                            <p class="hint">虚拟商品可兑换的有效期，过期后商品不能购买，电子兑换码不能使用。</p>
                        </dd>
                    </dl>
                    <dl class="special-01" nctype="virtual_valid" style="">
                        <dt>支持过期退款：</dt>
                        <dd>
                            <ul class="ncsc-form-radio-list">
                                <li>
                                    <input type="radio" name="g_vinvalidrefund" id="g_vinvalidrefund_1" value="1">
                                    <label for="g_vinvalidrefund_1">是</label>
                                </li>
                                <li>
                                    <input type="radio" name="g_vinvalidrefund" id="g_vinvalidrefund_0" value="0" checked="">
                                    <label for="g_vinvalidrefund_0">否</label>
                                </li>
                            </ul>
                            <p class="hint">兑换码过期后是否可以申请退款。</p>
                        </dd>
                    </dl>
                    <!-- 只有可发布虚拟商品才会显示 E -->
                <?php } ?>

                <h3><b><em>*</em>表示该项必填</b><i class="iconfont icon-edit"></i>商品物流信息</h3>
                <dl>
                    <dt>所在地：</dt>
                    <dd>
                        <select class="valid" id="area_1">
                            <option value="">-请选择-</option>
                            <?php if ( !empty($data['district']) ) { ?>
                                <?php foreach ( $data['district'] as $key => $val ) { ?>
                                    <option value="<?= $val['district_id'] ?>"><?= $val['district_name'] ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                        <!--<input type="hidden" value="" name="region" id="region">-->
                        <input type="hidden" value="" name="province_id" id="_area_1">
                        <input type="hidden" value="" name="city_id" id="_area_2">
                        <p></p>
                    </dd>
                </dl>
                <dl nctype="virtual_null">
                    <dt>运费：</dt>
                    <dd>
                        <div nctype="div_freight">
                            <input id="transport_type_id" type="hidden" value="" name="transport_type_id">
                            <input id="transport_type_name" type="hidden" value="" name="transport_type_name">
                            <span id="postageName" class="transport-name"></span>
                            <?php if(!$common_data['common_parent_id']){ ?>
                                <a href="JavaScript:void(0);" class="bbc_seller_btns ncbtn" id="postageButton">
                                    <i class="icon iconfont">&#xe6b7;</i>选择售卖区域
                                </a>
                                <a href="<?=YLB_Registry::get('url')?>?ctl=Seller_Transport&met=transport" target="_blank" class="bbc_seller_btns ncbtn" id="addTransport">
                                    <i class="iconfont icon-jia"></i>添加运费模板
                                </a>
                            <?php }?>
                        </div>
                        <p class="hint">运费设置为 0，前台商品将显示为免运费。</p>
                    </dd>
                </dl>
                <dl>
                    <dt><i>*</i>商品重量：</dt>
                    <dd>
                        <input type="text" class="text w60" name="cubage" value="<?php if( !empty($common_data) ) { echo $common_data['common_cubage']; } ?>"  <?php if(!empty($common_data)&&$common_data['common_parent_id']){ ?>readonly style="background:#E7E7E7;"<?php } ?> /><em>kg</em>
                    </dd>
                </dl>
                <h3><b><em>*</em>表示该项必填</b><i class="iconfont icon-edit"></i>售后保障信息</h3>
                <dl>
                    <dt><i>*</i>是否提供发票：</dt>
                    <dd>
                        <label class="radio"><input type="radio" checked="" name="is_invoice" <?php if( !empty($common_data) ) { if ( $common_data['common_invoices'] == 0 ) { echo "checked"; } } ?> value="0"/>否</label>
                        <label class="radio"><input type="radio" name="is_invoice" <?php if( !empty($common_data) ) { if ( $common_data['common_invoices'] == 1 ) { echo "checked"; } } ?> value="1"/>是</label>
                    </dd>
                </dl>
                <dl>
                    <dt>售后服务：</dt>
                    <dd>
                        <textarea class="text textarea" style="width:70%" name="service"><?php if( !empty($common_data) ) { echo $common_data['common_service']; } ?></textarea>

                        <p class="hint">售后服务如不填写，将调用 "商家管理中心 -> 商品 -> 售后服务" 中自定义的<Br/>售后服务不能超过200个汉字</p>
                    </dd>
                </dl>
                <h3><b><em>*</em>表示该项必填</b><i class="iconfont icon-edit"></i>其他信息</h3>

                <dl>
                    <dt>每人限购：</dt>
                    <dd>
                        <!--<input type="text" class="text w60 n-valid" name="limit" value="<?php /*if ( !empty($common_data) ) { echo $common_data['common_limit']; }  */?>" aria-required="true">-->
                        <label class="radio"><input checked="checked" type="radio" name="is_limit" value="0">否</label>
                        <label class="radio"><input type="radio" name="is_limit" value="1">是</label>
                        <span style="display: none">每人限购<input class="text w60 n-valid" name="limit" value="0" />件</span><span class="msg-box" for="limit"></span>
                    </dd>
                </dl>
                <dl>
                    <dt>包装清单：</dt>
                    <dd>
                        <textarea class="text textarea" maxlength="200" style="width:70%" name="packing_list"><?php if( !empty($common_data) ) { echo $common_data['common_packing_list']; } ?></textarea>

                        <p class="hint">包装清单不能超过200个汉字</p>
                    </dd>
                </dl>
                <dl>
                    <dt>本店分类：</dt>
                    <dd>
                        <a href="javascript:void(0)" id="add_sgcategory" class="ncbtn bbc_seller_btns">发布多个分类</a>
                        <select name="sgcate_id[]" class="sgcategory valid">
                            <option value="0">请选择...</option>
                            <?php if ( !empty($data['goods_cat_list']) ) { ?>
                                <?php foreach ($data['goods_cat_list'] as $key => $val) { ?>
                                    <option data-parent_id = "<?= $val['parent_id']; ?>" value="<?= $val['shop_goods_cat_id']; ?>"><?= $val['shop_goods_cat_name']; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                        <p class="hint">商品可以从属于店铺的多个分类之下，<br/>店铺分类可以由 "商家管理中心 -> 店铺 -> <a target="_blank" style="color:#e02222;" href="<?= YLB_Registry::get('url') ?>?ctl=Seller_Shop_Cat&met=cat">新增店铺分类</a>" 中自定义</p>
                    </dd>
                </dl>
                <dl>
                    <dt>商品发布：</dt>
                    <dd class="time">
                        <p><label class="radio"><input type="radio" name="state" <?php if( !empty($common_data) && $common_data['common_state'] == 1 ) { echo "checked"; } ?> checked="" value="1"/>立即发布</label></p>

                        <p class="fn-clear">
                            <label nctype="auto" class="radio"><input type="radio" name="state" <?php if( !empty($common_data) && $common_data['common_state'] == 2 ) { echo "checked"; }  ?> value="2"/>发布时间</label>
                            <input type="text" readonly="readonly" <?php if (!empty($common_data) && $common_data['common_state'] == 2) {
                                echo '';
                            } else {
                                echo 'disabled';
                            } ?> class="text fn-left w70 <?php if (!empty($common_data) && $common_data['common_state'] == 2) {
                                echo '';
                            } else {
                                echo 'disabled';
                            } ?>" id="starttime" name="starttime" value="" />
                            <select class="fn-left <?php if ( !empty($common_data) && $common_data['common_state'] == 2 ) { echo ''; } else { echo 'disabled'; } ?>" <?php if ( !empty($common_data) && $common_data['common_state'] == 2 ) { echo ''; } else { echo 'disabled'; } ?>  id="hour" name="hour" value="<?php if ( empty($common_data) ) { echo date('Y-m-d'); } elseif ($common_data['common_state'] == 2)  { echo $common_data['common_sell_time'][1]; }  ?>">
                                <option value="00">00</option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                            </select>
                            <label class="fn-left">时</label>
                            <select class="fn-left <?php if ( !empty($common_data) && $common_data['common_state'] == 2 ) { echo ''; } else { echo 'disabled'; } ?>" <?php if ( !empty($common_data) && $common_data['common_state'] == 2 ) { echo ''; } else { echo 'disabled'; } ?> id="minute" name="minute" value="<?php if ( empty($common_data) ) { echo date('Y-m-d'); } elseif ($common_data['common_state'] == 2)  { echo $common_data['common_sell_time'][2]; }  ?>" >
                                <option value="00">00</option>
                                <option value="05">05</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="30">30</option>
                                <option value="35">35</option>
                                <option value="40">40</option>
                                <option value="45">45</option>
                                <option value="50">50</option>
                                <option value="55">55</option>
                            </select>
                            <label class="fn-left">分</label>
                        </p>
                        <p><label class="radio"><input type="radio" name="state" <?php if( !empty($common_data) && $common_data['common_state'] == 0 ) { echo "checked"; } ?> value="0"/>放入仓库</label></p>
                    </dd>
                </dl>
                <dl>
                    <dt>商品推荐：</dt>
                    <dd>
                        <label class="radio"><input type="radio" checked="" name="is_recommend" value="1" <?php if( !empty($common_data) && $common_data['common_is_recommend'] == 1 ) { echo "checked"; } ?>/>否</label>
                        <label class="radio"><input type="radio" name="is_recommend" value="2"<?php if( !empty($common_data) && $common_data['common_is_recommend'] == 2 ) { echo "checked"; }  ?>/>是</label>

                        <p class="hint">被推荐的商品会显示在店铺首页</p>
                    </dd>
                </dl>

                <div class="finshed-basic">
                    <div class="finshed fixed">
                        <div class="finshed-1200">
                            <div class="finshed-980">
                                <input type="submit" class="button button_black bbc_seller_submit_btns" value="提交"/>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <script>
        $(function () {
            $('input[name="market_share_price"]').attr('readonly','readonly').css('background','#E7E7E7 none');
            $('input[name="share_sum_price"]').attr('readonly','readonly').css('background','#E7E7E7 none');
            function setSharePrice(type) {
                var price = $('input[name="price"]').val();

                <?php if(@$this->shop_base['shop_type'] == 2){ ?>
                price = $('input[name="goods_recommended_max_price"]').val();
                <?php }?>

                var share_weixin = $('input[name="share_weixin"]').val();
                var share_weixin_timeline = $('input[name="share_weixin_timeline"]').val();
                var share_sqq = $('input[name="share_sqq"]').val();
                var share_qzone = $('input[name="share_qzone"]').val();
                var share_tsina = $('input[name="share_tsina"]').val();
                var is_promotion = $("input[name='is_promotion']:checked").val();
                var promotion_total_price = 0;
                if ( is_promotion == 1 ) {
                    promotion_total_price = $('input[name="promotion_total_price"]').val();
                }

                var share_sum_price = share_weixin*1 + share_weixin_timeline*1 + share_sqq*1 + share_qzone*1 + share_tsina*1 + promotion_total_price*1;
                var share_price = price - share_sum_price;
                if(share_price.toFixed(2) > 0){
                    $('input[name="share_sum_price"]').val(share_sum_price.toFixed(2));
                    $('input[name="market_share_price"]').val(share_price.toFixed(2));
                    return true;
                }else{
                    if(type == 1){
                        $.dialog.alert('分享总价不能大于商品价格！',function(){
                            $('input[name="promotion_total_price"]').focus();
                        });
                    }
                    return false;
                }

            }
            setSharePrice(0);

            $('input[name="is_promotion"]').click(function () {
                setSharePrice(1);
            });
        });

        <?php if ( !empty($data['cat_is_virtual']) && $data['cat_is_virtual'] == 1 ) {  ?>
        $(function () {

            $('.special-01:gt(0)').hide();

            $($('.special-01:eq(0)').find('input[type="radio"]')[0]).on('click', function () {

                $('.special-01:gt(0)').show();
            });

            $($('.special-01:eq(0)').find('input[type="radio"]')[1]).on('click', function () {

                $('.special-01:gt(0)').hide();
            });

            /* 只有可发布虚拟商品才会显示 S */
            $('#form').validator("setField", "g_vindate", "虚拟商品有效期:required;");
            $('#g_vindate').datepicker({
                format:'Y-m-d',
                timepicker:false,
                minDate:0
            });

            $('[name="is_return"]').parents('dl').remove();
            /* 只有可发布虚拟商品才会显示 E */
        });
        <?php } ?>

        // 按规格存储规格值数据
        var spec_group_checked = ['',''];
        var str = '';
        var V = new Array();

        <?php if ( !empty($data['spec']) ) { ?>
            <?php foreach ( $data['spec'] as $key => $val ) { ?>
                var spec_group_checked_<?php echo $key ?> = new Array();
            <?php } ?>
        <?php } ?>

        // 将选中的规格放入数组
        function into_array(){
            <?php if ( !empty($data['spec']) ) { ?>
                <?php foreach ( $data['spec'] as $key => $val ) { ?>
                    spec_group_checked_<?php echo $key ?> = new Array();
                    $('dl[nc_type="spec_group_dl_<?php echo $key ?>"]').find('input[type="checkbox"]:checked').each(function(){
                        i = $(this).attr('nc_type');
                        v = $(this).val();
                        c = null;
                        if ($(this).parents('dl:first').attr('spec_img') == 't') {
                            c = 1;
                        }
                        spec_group_checked_<?php echo $key ?>[spec_group_checked_<?php echo $key ?>.length] = [v,i,c];
                    });
                    spec_group_checked[<?php echo $key ?>] = spec_group_checked_<?php echo $key ?>;
                <?php } ?>
            <?php } ?>
        }

        /* 库存配置 */

        // 生成库存配置
        function goods_stock_set(){
            //  店铺价格 商品库存改为只读
            $('input[name="price"]').attr('readonly','readonly').css('background','#E7E7E7 none');
            $('input[name="stock"]').attr('readonly','readonly').css('background','#E7E7E7 none');
            $('dl[nc_type="spec_dl"]').show();
            str = '<tr>';
            <?php if ( !empty($data['spec']) ) { ?>
                <?php foreach ( $data['spec'] as $key => $val ) { ?>
                    for (var i_<?php echo $key ?> = 0; i_<?php echo $key; ?> < spec_group_checked[<?php echo $key ?>].length; i_<?php echo $key; ?>++) { td_<?php echo $key; ?> = spec_group_checked[<?php echo $key; ?>][i_<?php echo $key; ?>];
                <?php } ?>
            <?php } ?>

                var tmp_spec_td = new Array();
                <?php if ( !empty($data['spec']) ) { ?>
                    <?php foreach ( $data['spec'] as $key => $val ) { ?>
                        tmp_spec_td[<?php echo $key ?>] = td_<?php echo $key; ?>[1];
                    <?php } ?>
                <?php } ?>
                tmp_spec_td.sort(function(a,b){return a-b});
                var spec_bunch = 'i_';
                <?php if ( !empty($data['spec']) ) { ?>
                    <?php foreach ( $data['spec'] as $key => $val ) { ?>
                        spec_bunch += tmp_spec_td[<?php echo $key ?>];
                    <?php } ?>
                <?php } ?>
                str += '<input type="hidden" name="spec['+spec_bunch+'][goods_id]" data-value="'+spec_bunch+'|id" nc_type="'+spec_bunch+'|id" value="" />';
                <?php if ( !empty($data['spec']) ) { ?>
                    <?php foreach ( $data['spec'] as $key => $val ) { ?>
                        if (td_<?php echo $key ?>[2] != null){
                            str += '<input type="hidden" name="spec[' + spec_bunch + '][color]" value="' + td_<?php echo $key ?>[1] + '" />';
                        }
                        str += '<td class="tl"><input type="hidden" name="spec[' + spec_bunch + '][sp_value][' + td_<?php echo $key ?>[1] + ']" value="' + td_<?php echo $key ?>[0] + '" />' + td_<?php echo $key ?>[0] + '</td>';
                    <?php } ?>
                <?php } ?>
                str += '<td><input class="text price" type="text" name="spec[' + spec_bunch + '][market_price]" <?php if(isset($common_data) && @$common_data['common_parent_id']){?>readonly="readonly"<?php }?> data-type="market_price" data-value="' + spec_bunch + '|market_price" value="" /><em><?=Web_ConfigModel::value('monetary_unit')?></em></td>' +
                    '<td><input class="text price" type="text" name="spec[' + spec_bunch + '][price]" data-type="price" data-value="' + spec_bunch + '|price" value="" /><em><?=Web_ConfigModel::value('monetary_unit')?></em></td>'
                    <?php if(@$this->shop_base['shop_type'] == 2||@$common_data['common_parent_id']){ ?> +'<td><input class="text price" type="text" <?php if(@$common_data['common_parent_id']){ echo 'readonly'.' style="background:#e6e6e6;border-right:1px solid #ccc;"';} ?> name="spec[' + spec_bunch + '][goods_recommended_min_price]" data-type="goods_recommended_min_price" data-value="' + spec_bunch + '|goods_recommended_min_price" value="" /><em><?=Web_ConfigModel::value('monetary_unit')?></em></td>'+'<td><input class="text price" type="text" <?php if(@$common_data['common_parent_id']){ echo 'readonly'.' style="background:#e6e6e6;border-right:1px solid #ccc;"';} ?> name="spec[' + spec_bunch + '][goods_recommended_max_price]" data-type="goods_recommended_max_price" data-value="' + spec_bunch + '|goods_recommended_max_price" value="" /><em><?=Web_ConfigModel::value('monetary_unit')?></em></td>'
                    <?php } ?>
                    +
                    '<td><input class="text stock" type="text" name="spec[' + spec_bunch + '][stock]" data-type="stock" data-value="' + spec_bunch + '|stock" <?php if(isset($common_data) && @$common_data['common_parent_id']){?>readonly="readonly"<?php }?>  value="" /></td>' +
                    '<td><input class="text alarm" type="text" name="spec[' + spec_bunch + '][alarm]" data-type="alarm" data-value="' + spec_bunch + '|alarm" value="" /></td>' +
                    '<td><input class="text sku" type="text" name="spec[' + spec_bunch + '][sku]" data-value="' + spec_bunch + '|sku" data-type="sku" value="" /></td></tr>';
            <?php if ( !empty($data['spec']) ) { ?>
                <?php foreach ( $data['spec'] as $key => $val ) { ?>
                    }
                <?php } ?>
            <?php } ?>

            if(str == '<tr>'){
                //  店铺价格 商品库存取消只读
                $('input[name="price"]').removeAttr('readonly').css('background','');
                $('input[name="storage"]').removeAttr('readonly').css('background','');
                $('dl[nc_type="spec_dl"]').hide();
            }else{
                $('tbody[nc_type="spec_table"]').empty().html(str)
                    .find('input[data-value]').each(function(){
                    s = $(this).attr('data-value');
                    try{$(this).val(V[s]);}catch(ex){$(this).val('');};
                    if ($(this).attr('data-type') == 'market_price' && $(this).val() == '') {
                        $(this).val($('input[name="market_price"]').val());
                    }
                    if ($(this).attr('data-type') == 'price' && $(this).val() == ''){
                        $(this).val($('input[name="price"]').val());
                    }
                    if ($(this).attr('data-type') == 'alarm' && $(this).val() == ''){
                        $(this).val($('input[name="alarm"]').val());
                    }
                    if ($(this).attr('data-type') == 'sku' && $(this).val() == ''){
                        $(this).val($('input[name="code"]').val());
                    }
                    <?php if(@$this->shop_base['shop_type'] == 2||@$common_data['common_parent_id']){ ?>
                    if ($(this).attr('data-type') == 'goods_recommended_min_price' && $(this).val() == ''){
                        $(this).val($('input[name="goods_recommended_min_price"]').val());
                    }
                    if ($(this).attr('data-type') == 'goods_recommended_max_price' && $(this).val() == ''){
                        $(this).val($('input[name="goods_recommended_max_price"]').val());
                    }
                    <?php } ?>
                    if ($(this).attr('data-type') == 'stock' && $(this).val() == ''){
                        $(this).val('0');
                    }
                    if ($(this).attr('data-type') == 'alarm' && $(this).val() == ''){
                        $(this).val('0');
                    }
                }).end()
                    .find('input[data-type="stock"]').change(function(){
                    computeStock();    // 库存计算
                }).end()
                    .find('input[data-type="price"]').change(function(){
                    computePrice();     // 价格计算
                    <?php if(@$common_data['common_parent_id']){ ?>computeMPrice();<?php } ?>
                }).end()
                    .find('input[data-type="goods_recommended_min_price"]').change(function(){
                    computeMinPrice();     // 价格计算
                }).end()
                    .find('input[data-type="goods_recommended_max_price"]').change(function(){
                    computeMaxPrice();     // 价格计算
                }).end()
                    .find('input[type="text"]').change(function(){
                    s = $(this).attr('data-value');
                    V[s] = $(this).val();
                });
            }
            /*$('div[nctype="spec_div"]').perfectScrollbar('update');*/
        }
        function computeStock(){
            var _stock = 0;
            $('input[data-type="stock"]').each(function(){
                if($(this).val() != ''){
                    _stock += parseInt($(this).val());
                }
            });
            $('input[name="stock"]').val(_stock);
        }
        function computePrice(){
            var _price = 0;var _price_sign = false;
            $('input[data-type="price"]').each(function(){
                if($(this).val() != '' && $(this)){
                    if(!_price_sign){
                        _price = parseFloat($(this).val());
                        _price_sign = true;
                    }else{
                        _price = (parseFloat($(this).val())  > _price) ? _price : parseFloat($(this).val());
                    }
                }
            });
            $('input[name="price"]').val(_price);
        }
        function computeMPrice(){
            var _price = 0;var _price_sign = false;
            $('input[data-type="price"]').each(function(){
                if($(this).val() != '' && $(this)){
                    if(!_price_sign){
                        _price = parseFloat($(this).val());
                        _price_sign = true;
                    }else{
                        _price = (parseFloat($(this).val())  < _price) ? _price : parseFloat($(this).val());
                    }
                }
            });
//			$('input[name="goods_max_price"]').val(_price);
        }
        function computeMinPrice(){
            var _price = 0;var _price_sign = false;
            $('input[data-type="goods_recommended_min_price"]').each(function(){
                if($(this).val() != '' && $(this)){
                    if(!_price_sign){
                        _price = parseFloat($(this).val());
                        _price_sign = true;
                    }else{
                        _price = (parseFloat($(this).val())  > _price) ? _price : parseFloat($(this).val());
                    }
                }
            });
            $('input[name="goods_recommended_min_price"]').val(_price);
        }
        function computeMaxPrice(){
            var _price = 0;var _price_sign = false;
            $('input[data-type="goods_recommended_max_price"]').each(function(){
                if($(this).val() != '' && $(this)){
                    if(!_price_sign){
                        _price = parseFloat($(this).val());
                        _price_sign = true;
                    }else{
                        _price = (parseFloat($(this).val())  > _price) ? _price : parseFloat($(this).val());
                    }
                }
            });
            $('input[name="goods_recommended_max_price"]').val(_price);
        }
        $('#starttime').val("<?= date('Y-m-d') ?>");
        /*----------------------------------------------------------编辑商品-------------------------------------------------------------*/

        <?php if ( !empty($common_data) ) { ?>

            //对商品发布时间处理
            <?php if ( !empty($common_data['common_sell_time']) ) { ?>
                $('#starttime').val("<?= $common_data['common_sell_time'][0] ?>");
                $('select[name="hour"]').find('[value="<?php echo $common_data['common_sell_time'][1] ?>"]').attr('selected','selected');
                $('select[name="minute"]').find('[value="<?php echo $common_data['common_sell_time'][2] ?>"]').attr('selected','selected');
            <?php } ?>

            //  编辑商品时处理JS
            $(function () {

                //是否限购
                <?php if ( !empty($common_data['common_limit']) ) { ?>
                $('input[name="is_limit"][value="1"]').prop("checked", "checked");
                $('input[name="limit"]').val(<?= $common_data['common_limit'] ?>).parent().show();
                <?php } ?>

                //规格名称初始化
                <?php if ( !empty($common_data['common_spec_name']) ) { ?>
                <?php foreach ( $common_data['common_spec_name'] as $spec_id => $spec_name ) { ?>
                $('input[name="spec_name[<?= $spec_id ?>]"]').val("<?= $spec_name ?>");

                $('th[nctype="spec_name_<?= $spec_id ?>"]').html("<?= $spec_name ?>");
                <?php } ?>
                <?php } ?>

                //商品所在地
                <?php if ( !empty($common_data['common_location']) ) { ?>
                $('#area_1').children('[value="<?= $common_data['common_location'][0] ?>"]').prop("selected", "selected").trigger('change');
                <?php if ( !empty($common_data['common_location'][1]) ) { ?>
                var intVal = setInterval( function () {
                    if ( $('#area_2').length > 0 ) {
                        window.clearInterval(intVal);
                        $('#area_2').children('[value="<?= $common_data['common_location'][1] ?>"]').prop("selected", "selected").trigger('change');
                    }
                }, 1000 );
                <?php } ?>
                <?php } ?>

                //编辑商品的url
                var edit_goods_url = $('.js-edit-goods').prop('href');
                $('.js-edit-goods').prop('href', edit_goods_url + 'common_id=<?= $common_data['common_id']; ?>');

                //初始化关联版式
                <?php if ( !empty($common_data['common_formatid_top']) ) {?>
                $('select[name="formatid_top"]').children('option[value="<?= $common_data['common_formatid_top'] ?>"]').prop('selected', 'selected');
                <?php } ?>

                <?php if ( !empty($common_data['common_formatid_bottom']) ) {?>
                $('select[name="formatid_bottom"]').children('option[value="<?= $common_data['common_formatid_bottom'] ?>"]').prop('selected', 'selected');
                <?php } ?>

                //初始化运费
                <?php if ( $common_data['transport_type_id']  == 0) { ?>
                $('#freight_0').prop('checked', 'checked');
                $('#g_freight').val(<?= $common_data['common_freight'] ?>);
                <?php } else { ?>
                $('#freight_1').trigger('click');
                $('#transport_type_id').val(<?= $common_data['transport_type_id']; ?>);
                $('#transport_type_name').val('<?= $common_data['transport_type_name']; ?>');
                $('#postageName').before('<span id="postageName" class="transport-name" style="display: inline-block;"><?= $common_data['transport_type_name']; ?></span>');
                <?php } ?>

                //初始化本店分类
                <?php if ( !empty($common_data['shop_goods_cat_id']) ) { ?>
                <?php foreach ($common_data['shop_goods_cat_id'] as $key => $val) { ?>
                <?php if ( $key != 0 ) { ?>
                $('#add_sgcategory').trigger('click');
                <?php } ?>
                $($('[name="sgcate_id[]"]')[<?= $key; ?>]).children('[value="<?= $val; ?>"]').prop('selected','selected');
                <?php } ?>
                <?php } ?>

                //编辑商品  编辑图片
                <?php if(!$common_data['common_parent_id']){ ?>
                var common_id = <?= $common_data['common_id']; ?>;
                $li_img = $('.tabmenu').find('.active').children('a').prop('href', window.location.href).html('编辑商品').parent('li').clone();
                $li_img.removeClass('active bbc_seller_bg').children('a').html('编辑图片').prop('href', window.location.href.replace('edit_goods', 'edit_image'));
                $('.tabmenu').find('ul').append($li_img);
                <?php }?>

                $('ol.step.clearfix').remove();

                //虚拟商品初始化
                <?php if ( $common_data['common_is_virtual'] == 1 ) { ?>
                $('#is_gv_1').trigger('click');
                $('#g_vindate').val("<?= date('Y-m-d', strtotime($common_data['common_virtual_date']) ) ?>");
                <?php if ( $common_data['common_virtual_refund'] == 1 ) { ?>
                $('#g_vinvalidrefund_1').trigger('click');
                <?php } ?>
                <?php } ?>

                <?php if ( !empty($common_detail_data) ) { ?>
                    ue.ready(function() {
                        //var content =$('#val_content').html();
                        var content =$('#val_content').val();

                        console.info(content)
                        ue.setContent(content);
                    });
                <?php } ?>

                var E_SP = new Array();
                var E_SPV = new Array();

                <?php if ( !empty($common_data['common_spec_value']) ) { ?>
                <?php foreach ($common_data['common_spec_value'] as $key => $val) { ?>
                <?php foreach ($val as $k => $v) { ?>
                E_SP[<?php echo $k; ?>] = "<?php echo $v; ?>";
                <?php } ?>
                <?php } ?>

                <?php foreach ($goods_base_data as $key => $val) { ?>
                E_SPV['<?php echo key($val['goods_spec']); ?>|market_price'] = <?php echo $val['goods_market_price']; ?>;
                E_SPV['<?php echo key($val['goods_spec']); ?>|price'] = <?php echo $val['goods_price']; ?>;
                <?php if(@$this->shop_base['shop_type'] == 2||@$common_data['common_parent_id']){ ?>
                E_SPV['<?php echo key($val['goods_spec']); ?>|goods_recommended_min_price'] = <?php echo $val['goods_recommended_min_price']; ?>;
                E_SPV['<?php echo key($val['goods_spec']); ?>|goods_recommended_max_price'] = <?php echo $val['goods_recommended_max_price']; ?>;
                <?php } ?>
                E_SPV['<?php echo key($val['goods_spec']); ?>|id'] = <?php echo $val['goods_id']; ?>;
                E_SPV['<?php echo key($val['goods_spec']); ?>|stock'] = <?php echo $val['goods_stock']; ?>;
                E_SPV['<?php echo key($val['goods_spec']); ?>|alarm'] = <?php echo $val['goods_alarm']; ?>;
                E_SPV['<?php echo key($val['goods_spec']); ?>|sku'] = <?php if ( empty($val['goods_code']) ) { echo "''"; } else { echo "'".$val['goods_code']."'"; } ?>;
                <?php } ?>


                V = E_SPV;
                $('dl[nc_type="spec_dl"]').show();
                $('dl[nctype="spec_group_dl"]').find('input[type="checkbox"]').each(function(){
                    //  店铺价格 商品库存改为只读
                    $('input[name="price"]').attr('readonly','readonly').css('background','#E7E7E7 none');
                    $('input[name="stock"]').attr('readonly','readonly').css('background','#E7E7E7 none');
                    s = $(this).attr('nc_type');
                    if (!(typeof(E_SP[s]) == 'undefined')){
                        $(this).attr('checked',true);
                        v = $(this).parents('li').find('span[nctype="pv_name"]');
                        if(E_SP[s] != ''){
                            $(this).val(E_SP[s]);
                            v.html('<input type="text" class="text" maxlength="40"<?php if(isset($common_data) && @$common_data['common_parent_id']){?>readonly="readonly"<?php }?> value="'+E_SP[s]+'" />');
                        }else{
                            v.html('<input type="text" class="text" maxlength="40" value="'+v.html()+'" />');
                        }
                        //				change_img_name($(this));			// 修改相关的颜色名称
                    }
                });


                into_array();	// 将选中的规格放入数组
                str = '<tr>';

                <?php if ( !empty($data['spec']) ) { ?>
                <?php foreach ( $data['spec'] as $key => $val ) { ?>

                for (var i_<?php echo $key ?> = 0; i_<?php echo $key; ?> < spec_group_checked[<?php echo $key ?>].length; i_<?php echo $key; ?>++) { td_<?php echo $key; ?> = spec_group_checked[<?php echo $key; ?>][i_<?php echo $key; ?>];

                    <?php } ?>
                    <?php } ?>

                    var tmp_spec_td = new Array();

                    <?php if ( !empty($data['spec']) ) { ?>
                    <?php foreach ( $data['spec'] as $key => $val ) { ?>

                    tmp_spec_td[<?php echo $key ?>] = td_<?php echo $key; ?>[1];

                    <?php } ?>
                    <?php } ?>

                    tmp_spec_td.sort(function(a,b){return a-b});
                    var spec_bunch = 'i_';

                    <?php if ( !empty($data['spec']) ) { ?>
                    <?php foreach ( $data['spec'] as $key => $val ) { ?>

                    spec_bunch += tmp_spec_td[<?php echo $key ?>];

                    <?php } ?>
                    <?php } ?>


                    str += '<input type="hidden" name="spec['+spec_bunch+'][goods_id]" data-value="'+spec_bunch+'|id" nc_type="'+spec_bunch+'|id" value="" />';


                    <?php if ( !empty($data['spec']) ) { ?>
                    <?php foreach ( $data['spec'] as $key => $val ) { ?>

                    if (td_<?php echo $key ?>[2] != null) {
                        str += '<input type="hidden" name="spec[' + spec_bunch + '][color]" value="' + td_<?php echo $key ?>[1] + '" />';
                    }
                    str += '<td class="tl"><input type="hidden" name="spec[' + spec_bunch + '][sp_value][' + td_<?php echo $key ?>[1] + ']" value="' + td_<?php echo $key ?>[0] + '" />' + td_<?php echo $key ?>[0] + '</td>';

                    <?php } ?>
                    <?php } ?>


                    str += '<td><input class="text price" type="text" name="spec[' + spec_bunch + '][market_price]" nc_type="' + spec_bunch + '|market_price" data-type="market_price" <?php if(isset($common_data) && @$common_data['common_parent_id']){?>readonly="readonly"<?php }?> data-value="' + spec_bunch + '|market_price" value="" /><em><?=Web_ConfigModel::value('monetary_unit')?></em></td>' +
                        '<td><input class="text price" type="text" name="spec[' + spec_bunch + '][price]" nc_type="' + spec_bunch + '|price" data-type="price"  data-value="' + spec_bunch + '|price" value="" /><em><?=Web_ConfigModel::value('monetary_unit')?></em></td>'
                        <?php if(@$this->shop_base['shop_type'] == 2||@$common_data['common_parent_id']){ ?>
                        +'<td><input class="text price" type="text" <?php if(@$common_data['common_parent_id']){ echo 'readonly'.' style="background:#e6e6e6;border-right:1px solid #ccc;"';} ?> name="spec[' + spec_bunch + '][goods_recommended_min_price]" nc_type="' + spec_bunch + '|goods_recommended_min_price" data-type="goods_recommended_min_price" data-value="' + spec_bunch + '|goods_recommended_min_price" value="" /><em><?=Web_ConfigModel::value('monetary_unit')?></em></td>'+'<td><input class="text price" type="text" <?php if(@$common_data['common_parent_id']){ echo 'readonly'.' style="background:#e6e6e6;border-right:1px solid #ccc;"';} ?> name="spec[' + spec_bunch + '][goods_recommended_max_price]" nc_type="' + spec_bunch + '|goods_recommended_max_price" data-type="goods_recommended_max_price" data-value="' + spec_bunch + '|goods_recommended_max_price" value="" /><em><?=Web_ConfigModel::value('monetary_unit')?></em></td>'
                        <?php } ?>
                        +
                        '<td><input class="text stock" type="text" name="spec[' + spec_bunch + '][stock]" nc_type="' + spec_bunch + '|stock" data-type="stock" <?php if(isset($common_data) && $common_data['common_parent_id']){?>readonly="readonly" style="background:#e6e6e6;border-right:1px solid #ccc;" <?php }?> data-value="' + spec_bunch + '|stock" value="" /></td>' +
                        '<td><input class="text alarm" type="text" name="spec[' + spec_bunch + '][alarm]" nc_type="' + spec_bunch + '|alarm" data-type="alarm" data-value="' + spec_bunch + '|alarm" value="" /></td>' +
                        '<td><input class="text sku" type="text" name="spec[' + spec_bunch + '][sku]" nc_type="' + spec_bunch + '|sku" data-value="' + spec_bunch + '|sku" data-type="sku" value="" /></td></tr>';


                    <?php if ( !empty($data['spec']) ) { ?>
                    <?php foreach ( $data['spec'] as $key => $val ) { ?>
                }
                <?php } ?>
                <?php } ?>

                if(str == '<tr>'){
                    $('dl[nc_type="spec_dl"]').hide();
                    $('input[name="g_price"]').removeAttr('readonly').css('background','');
                    $('input[name="g_storage"]').removeAttr('readonly').css('background','');
                }else{
                    $('tbody[nc_type="spec_table"]').empty().html(str)
                        .find('input[nc_type]').each(function(){
                        s = $(this).attr('nc_type');
                        try{$(this).val(E_SPV[s]);}catch(ex){$(this).val('');};
                    }).end()
                        .find('input[data-type="stock"]').change(function(){
                        computeStock();    // 库存计算
                    }).end()
                        .find('input[data-type="price"]').change(function(){
                        computePrice();     // 价格计算
                        <?php if($common_data['common_parent_id']){ ?>computeMPrice();<?php } ?>
                    }).end()
                        .find('input[data-type="goods_recommended_min_price"]').change(function(){
                        computeMinPrice();     // 价格计算
                    }).end()
                        .find('input[data-type="goods_recommended_max_price"]').change(function(){
                        computeMaxPrice();     // 价格计算
                    }).end()
                        .find('input[type="text"]').change(function(){
                        s = $(this).attr('nc_type');
                        V[s] = $(this).val();
                    });
                }
                /*$('div[nctype="spec_div"]').perfectScrollbar('update');*/

                <?php } ?>

            });

        <?php } ?>

        function check_price(){
            alert($(this).val())
        }

        <?php if(!empty($common_data)){ ?>
            $(function(){
                //不允许内容修改
                <?php if(!$common_data['product_is_allow_update']&&$common_data['common_parent_id']){ ?>
                    $(".text").each(function(){
                        $(this).attr('readonly','readonly').css('background','#E7E7E7 none');
                    });
                    $("input[type=radio]").each(function(){
                        $(this).attr('disabled','disabled').css('background','#E7E7E7 none');
                    });
                    $("select").each(function(){
                        $(this).attr('disabled','disabled').css('background','#E7E7E7 none');
                    });
                <?php } ?>

                $('.sgcategory').removeAttr('disabled').css('background','none');
                $('input[name=is_recommend]').removeAttr('disabled').css('background','none');
                $('input[name=is_invoice]').attr('disabled','disabled').css('background','#E7E7E7 none');

                //不允许价格修改
                <?php if(!$common_data['product_is_allow_price']&&$common_data['common_parent_id']){ ?>
                    $("body .spec_table").find("input").each(function(){
                        $(this).attr('readonly','readonly').css('background','#E7E7E7 none');
                    });
                <?php } if($common_data['product_is_allow_price']&&$common_data['common_parent_id']){ ?>
                    $("body .spec_table").find("input").each(function(){
                        $('input[data-type="market_price"]').removeAttr('readonly').css('background','none');
                        $('input[data-type="price"]').removeAttr('readonly').css('background','none');
                    });
                <?php }?>
            });
        <?php }?>

        //编辑器
        window.ue = UE.getEditor('body', {
            minFrameWidth : 800,
            minFrameHeight : 500,
            toolbars: [
                [
                    'fullscreen', 'source', '|', 'undo', 'redo', '|',
                    'bold', 'italic', 'underline', 'forecolor', 'backcolor', 'justifyleft', 'justifycenter', 'justifyright', 'insertunorderedlist', 'insertorderedlist', 'blockquote',
                    'emotion', 'link', 'removeformat', 'rowspacingtop', 'rowspacingbottom', 'lineheight', 'paragraph', 'fontsize', 'inserttable', 'deletetable', 'insertparagraphbeforetable',
                    'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols'
                ]
            ],
            autoClearinitialContent: true,
            //关闭字数统计
            wordCount: false,
            //关闭elementPath
            elementPathEnabled: false,
            autoHeightEnabled:false,
            <?php if(!$common_data['product_is_allow_update']&&$common_data['common_parent_id']){ ?>
                readonly:true
            <?php }?>
        });

        /*$('.spec_table').delegate('.stock_setting','click',function () {
            var stock = $(this).prev().val();
            $('tbody[nc_type="spec_table"]').find('input[data-type="stock"]').each(function(){
                $(this).val(stock);
            })
        })*/

        $('.batch_modify').click(function () {
            var bm_price = $('input[name="price"]').val();
            var bm_market_price = $('input[name="market_price"]').val();
            var bm_stock = $('input[name="stock"]').val();
            var bm_alarm = $('input[name="alarm"]').val();
            var bm_code = $('input[name="code"]').val();

            url = SITE_URL + '?ctl=Seller_Goods&met=batchModify&typ=e';
            $.dialog({
                title: '批量修改',
                content:'url:' + url,
                data: { bm_price: bm_price,bm_market_price: bm_market_price,bm_stock: bm_stock,bm_alarm: bm_alarm,bm_code: bm_code},
                height: 300,
                width: 400,
                lock: true,
                drag: false,
                ok: function () {
                    var form_ser = $(this.content.batch_modify_form).serializeArray();
                    $.each(form_ser, function(i, field){
                        if(field.name == 'bm_price'){
                            bm_price = field.value;
                        }
                        if(field.name == 'bm_market_price'){
                            bm_market_price = field.value;
                        }
                        if(field.name == 'bm_stock'){
                            bm_stock = field.value;
                        }
                        if(field.name == 'bm_alarm'){
                            bm_alarm = field.value;
                        }
                        if(field.name == 'bm_code'){
                            bm_code = field.value;
                        }
                    });

                    $('input[name="price"]').val(bm_price);
                    $('input[name="market_price"]').val(bm_market_price);
                    $('input[name="alarm"]').val(bm_alarm);
                    $('input[name="code"]').val(bm_code);

                    $('tbody[nc_type="spec_table"]')
                        .find('input[data-value]').each(function(){
                        if ($(this).attr('data-type') == 'market_price') {
                            $(this).val(bm_market_price);
                        }
                        if ($(this).attr('data-type') == 'price'){
                            $(this).val(bm_price);
                        }
                        if ($(this).attr('data-type') == 'alarm'){
                            $(this).val(bm_alarm);
                        }
                        if ($(this).attr('data-type') == 'sku'){
                            $(this).val(bm_code);
                        }
                        if ($(this).attr('data-type') == 'stock'){
                            $(this).val(bm_stock);
                            computeStock();    // 库存计算
                        }
                    })
                }
            })
        });

        $(window).scroll(function(){
            var footerH = $(".footer").outerHeight(true);
            var totalHeight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());
            var allHeight = parseFloat($(document).height() );
            if(allHeight - totalHeight <= footerH){
                $(".finshed").removeClass("fixed");
            }else{
                $(".finshed").addClass("fixed");
            }
        });

        <?php if(@$this->shop_base['shop_type'] == 2){ ?>
            //代发货
            $('input[name="product_is_behalf_delivery"]').on('click', function () {
                if (this.value == 1) {
                    $('.fx_cj').hide();
                    $('.fx_rl').show();
                }else {
                    $('.fx_cj').show();
                    $('.fx_rl').hide();
                }
            });
        <?php }?>

    </script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>