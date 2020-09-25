<?php if($data['items']){ ?>
    <ul class="fn-clear" nctype="bundling_goods_add_tbody">
        <?php foreach($data['items'] as $key=>$value) { ?>
            <li nctype="<?=$value['goods_id']?>">
                <div class="goods-image"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$value['goods_id']?>&typ=e" target="_blank"><img src="<?=image_thumb($value['goods_image'],140,140)?>" /></a></div>
                <div class="goods-name"><?=$value['goods_name']?></div>
                <div class="goods-price"><?=_('商品价格')?>：<span><?=format_money($value['goods_price'])?></span></div>
                <div class="share-sum-price"><?=_('分享优惠')?>：<span><?=format_money($value['share_sum_price'])?></span></div>
                <div class="share-sum-price"><?=_('分享后')?>：<span><?=format_money($value['goods_price'] - $value['share_sum_price'])?></span></div>
                <div class="goods-stock"><?=_('库存')?>：<span><?=$value['goods_stock']?></span></div>
                <div class="goods-btn" data-param="{gid:<?=$value['goods_id']?>,image:'<?=$value['goods_image']?>',src:'<?=image_thumb($value['goods_image'],140,140)?>',gname:'<?=$value['goods_name']?>',gprice:'<?=$value['goods_price']?>',gstorang:'<?=$value['goods_stock']?>',sharesum:'<?=$value['share_sum_price']?>',shared:'<?=number_format($value['goods_price']-$value['share_sum_price'],2)?>'}">
                    <?php if($value['goods_stock']){ ?>
                    <div class="button button_green" onclick="bundling_goods_add($(this))" >
                        <i class="iconfont icon-jia"></i><?=_('选择商品')?>
                    </div>
                    <?php }else{	?>
                        <div class="button button_orange">无库存</div>
                    <?php }?>
                </div>
            </li>
        <?php }	?>
    </ul>
<?php }else{ ?>
    <div class="no_account">
        <img src="<?=$this->view->img?>/ico_none.png">
        <p>暂无符合条件的数据记录</p>
    </div>
<?php } ?>

<?php if($page_nav){ ?>
    <div class="goods-page fn-clear">
        <div class="mm">
            <div class="page"><?=$page_nav?></div>
        </div>
    </div>
<?php } ?>

<script>
    $(function(){

        // 验证商品是否已经被选择。
        O = $('input[nctype="goods_id"]');
        A = new Array();
        if(typeof(O) != 'undefined'){
            O.each(function(){
                A[$(this).val()] = $(this).val();
            });
        }
        T = $('ul[nctype="bundling_goods_add_tbody"] li');
        if(typeof(T) != 'undefined'){
            T.each(function(){
                if(typeof(A[$(this).attr('nctype')]) != 'undefined'){
                    $(this).children(':last').html('<div class="button button_orange" onclick="bundling_operate_delete($(\'#bundling_tr_'+$(this).attr('nctype')+'\'), '+$(this).attr('nctype')+')"><i class="iconfont icon-jian"></i>移除商品</div>');
                }
            });
        }
    });

    /* 添加商品 */
    function bundling_goods_add(o){
        // 验证商品是否已经添加。
        var _bundlingtr = $('tbody[nctype="bundling_data"] tr:not(:first)');
        if(typeof(_bundlingtr) != 'undefined'){
            if(_bundlingtr.length == 5){
                alert('<?=_('您已经添加了5个，不能再继续添加商品')?>');
                return false;
            }
        }

        eval('var _data = ' + o.parent().attr('data-param'));
        if (_data.gstrong == 0) {
            alert('<?=_('库存不足，不能添加商品')?>');
            return false;
        }
        // 隐藏第一个tr
        $('tbody[nctype="bundling_data"]').children(':first').hide();
        // 插入数据
        $('<tr id="bundling_tr_' + _data.gid + '"></tr>')
            .append('<input type="hidden" nctype="goods_id" name="goods[g_' + _data.gid + '][gid]" value="' + _data.gid + '">')
            .append('<td class="w70"><input type="checkbox" name="goods[g_' + _data.gid + '][appoint]" value="1" checked="checked"></td>')
            .append('<td class="w50 "><div class="pic-thumb"><img nctype="bundling_data_img" ncname="' + _data.image + '" src="' + _data.src + '" ></span></div></td>')
            .append('<td class="tl"><dl class="goods-name"><dt style="width: 300px;">' + _data.gname + '</dt></dl></td>')
            .append('<td class="w70 goods-price" nctype="bundling_data_price">' + _data.gprice + '</td>')
            .append('<td class="w70 share_sum_price" nctype="share_sum_price">' + _data.sharesum + '</td>')
            .append('<td class="w70 shared_price" nctype="shared_price">' + _data.shared + '</td>')
            .append('<td class="w70"><input type="text" nctype="price" name="goods[g_' + _data.gid + '][price]" value="' + _data.gprice + '" class="text w70"></td>')
            .append('<td class="nscs-table-handle w90"><span><a href="javascript:void(0);" onclick="bundling_operate_delete($(\'#bundling_tr_' + _data.gid + '\'), ' + _data.gid + ')" class="btn-bittersweet"><i class="iconfont icon-quxiaodingdan"></i><p><?=_('移除')?></p></a></span></td>')
            .fadeIn().appendTo('tbody[nctype="bundling_data"]');

        o.parent().html('<div class="button button_orange" onclick="bundling_operate_delete($(\'#bundling_tr_' + _data.gid + '\'), ' + _data.gid + ')"><i class="iconfont icon-jian"></i>移除商品</div>')
        count_cost_price_sum();
        count_price_sum();
    }

</script>
