<?php if(!empty($goods_list['items'])){?>
    <?php
    foreach($goods_list['items'] as $k=>$v){ ?>
        <?php if(!empty($v['detail'])){?>
            <li>
                <a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$v['goods_id']?>">
                    <img src="<?php if(!empty($v['detail']['goods_image'])){?><?=image_thumb($v['detail']['goods_image'],116,116)?><?php }else{?><?= image_thumb($this->web['goods_image'],116,116)?><?php }?>"/>
                    <h5><?=$v['detail']['goods_name']?></h5>
                    <h6 class="bbc_color">
                        <?=format_money($v['detail']['goods_price'])?>
                    </h6>
                </a>
            </li>
        <?php }?>
    <?php }?>
<?php }else{?>
    <div class="item_cons_no">
        <?=_('你没有收藏商品为空')?>
    </div>
<?php }?>