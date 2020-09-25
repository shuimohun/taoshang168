
<ul>
    <?php if(!empty($data['items'])){ foreach($data['items'] as $k=>$v){?>
        <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Article_Base&article_id=<?= $v['article_id'] ?>" target="_blank">&bull;&nbsp;<?=$v['article_title']?></a></li>
    <?php }}else{?>
        <div class="item_cons_no">
            <?=_('公告为空')?>
        </div>
    <?php }?>
</ul>

<!--<ul>
    <?php /*if(!empty($data['items'])){ foreach($data['items'] as $k=>$v){*/?>
        <li><a href="<?/*= YLB_Registry::get('url') */?>?ctl=Buyer_Message&met=message" target="_blank">&bull;&nbsp;<?/*=$v['message_content']*/?></a></li>
    <?php /*}}else{*/?>
        <div class="item_cons_no">
            <?/*=_('公告为空')*/?>
        </div>
    <?php /*}*/?>
</ul>-->