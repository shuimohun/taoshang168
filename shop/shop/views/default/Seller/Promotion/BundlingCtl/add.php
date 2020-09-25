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

    <form method="post" id="form" action="<?=YLB_Registry::get('url')?>?ctl=Seller_Promotion_Bundling&met=addBundling&typ=e">
        <dl>
            <dt><i>*</i><?=_('活动名称')?>：</dt>
            <dd>
                <input type="text" name="bundling_name" class="text w450"/>
                <p class="hint"><?=_('活动标题名称长度最多可输入30个字符')?></p>
            </dd>
        </dl>
        <dl>
            <dt><i>*</i><?=_('优惠套装价格')?>：</dt>
            <dd>
              <input id="bundling_price" name="bundling_price" type="text" readonly style="background:#E7E7E7 none;" class="text w60 mr5" value=""/>
              <p class="hint"><?=_('原价')?><span nctype="cost_price" class="price mr5 ml5"></span><?=_('&nbsp;元 (已添加搭配商品的默认价格总计)')?></p>
            </dd>
        </dl>
        <dl>
            <dt><i>*</i><?=_('套装商品')?>：</dt>
            <dd>
                <p>
                    <input id="bundling_goods" type="hidden" value="" name="bundling_goods">
                    <span></span>
                </p>
                <table class="ncsc-default-table mb15">
                    <thead>
                        <tr>
                            <th class="w70">指定优惠</th>
                            <th class="tl" colspan="2">商品名称</th>
                            <th class="w70">原价</th>
                            <th class="w70">分享优惠</th>
                            <th class="w70">分享后</th>
                            <th class="w70">优惠价格</th>
                            <th class="w90">操作</th>
                        </tr>
                    </thead>
                    <tbody nctype="bundling_data"  class="bd-line tip" title="<?=_('上下拖移商品列可自定义显示排序；')?>">
                        <tr style="display:none;">
                            <td colspan="20" class="norecord"><div class="no-promotion"><i class="zh"></i><span>优惠套装还未选择添加商品。</span></div></td>
                        </tr>
                    </tbody>
                </table>
                <div class="mb10 clearfix">
                    <a class="button bbc_seller_btns"  id="bundling_add_goods" href="javascript:void(0);">
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
                    <a href="javascript:void(0);" id="btn_hide_goods_select" class="close btn_hide_search_goods">X</a>
                </div>
            </dd>
        </dl>

        <dl>
        <dt><i>*</i><?=_('运费承担')?>：</dt>
        <dd>
            <ul class="ncsc-form-radio-list">
            	<li>
                  	<label>
                  		<input type="radio" name="bundling_freight_choose" checked="checked" value="1" /><?=_('卖家承担运费')?>
              		</label>
      			</li>
                <li>
                	<label>
                	    <input type="radio" name="bundling_freight_choose"  value="0" /><?=_('买家承担运费')?>
                    </label>
                	<div id="whops_buyer_box" style="display:none;">
                		<input class="w50 text" type="text" name="bundling_freight" value="" />
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
                        <label class="radio"><input type="radio" name="is_limit" value="0" checked="checked">否</label>
                    </li>
                    <li>
                        <label class="radio"><input type="radio" name="is_limit" value="1">是</label>
                        <div id="buy_limit" style="display:none;">
                            <input class="text w50 n-valid" name="limit" value="0" />
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
                		<input type="radio" name="bundling_state" value="1" id="bundling_status_1" checked="checked"/><?=_('开启')?>
            		</label>
        		</li>
                <li>
                	<label for="bundling_status_0">
                		<input type="radio" name="bundling_state" value="2" id="bundling_status_0" /><?=_('关闭')?>
            		</label>
        		</li>
            </ul>
        </dd>
        </dl>

        <dl>
            <dt></dt>
            <dd>
                <input type="submit" class="button button_blue bbc_seller_submit_btns" value="提交"  />
                <input type="hidden" name="act" value="save" />
            </dd>
        </dl>
    </form>
</div>

<style>

</style>

<link  href="<?=$this->view->css?>/bundling.css" rel="stylesheet"></link>
<script type="text/javascript" src="<?=$this->view->js?>/bundling.js" charset="utf-8"></script>

<script type="text/javascript">
    $(document).ready(function(){

		//页面输入内容验证
    	$('#form').validator({
            debug:true,
            ignore: ':hidden',
            theme: 'yellow_right',
            timely: 1,
            stopOnError: false,
            fields: {
                'bundling_name': 'required;length[~30]',
                'bundling_price':'required;float[+]'
            },
            valid: function(form){
                var me = this;
                me.holdSubmit(function(){
                    Public.tips.error('正在处理中...');
                });
                $.ajax({
                    url: "index.php?ctl=Seller_Promotion_Bundling&met=addBundling&typ=json",
                    data: $(form).serialize(),
                    type: "POST",
                    success:function(e){
                        if(e.status == 200)
                        {
                            Public.tips.success('操作成功!');
                            location.href="index.php?ctl=Seller_Promotion_Bundling&met=index&typ=e"; //成功后跳转
                        }
                        else
                        {
                            Public.tips.error('操作失败,'+ e.msg);
                        }
                        me.holdSubmit(false);
                    }
                });
            }
        });
    });
</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>

