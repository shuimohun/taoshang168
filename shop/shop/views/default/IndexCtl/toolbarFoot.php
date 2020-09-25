<?php if(!empty($footprint_list['items'])){?>
    <?php
    foreach($footprint_list['items'] as $k=>$v){ ?>
        <?php if(!empty($v['detail'])){?>
            <li>
                <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$v['detail']['goods_id']?>">
                    <img src="<?php if(!empty($v['detail']['common_image'])){?><?=image_thumb($v['detail']['common_image'],116,116)?><?php }else{?><?= image_thumb($this->web['goods_image'],116,116)?><?php }?>"/>
                    <h5><?=$v['detail']['common_name']?></h5>
                    <h6 class="bbc_color"><?=format_money($v['detail']['common_price'])?></h6>
                </a>
            </li>
        <?php }?>
    <?php }?>
<?php }else{?>
    <div class="item_cons_no">
        <?=_('你没有浏览商品')?>
    </div>
<?php }?>