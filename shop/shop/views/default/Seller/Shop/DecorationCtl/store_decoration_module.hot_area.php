
<?php $block_content = empty($block_content) ? $decoration_detail['block_content'] : $block_content; ?>
<div>
    <?php $hot_area_flag = str_replace('.', '',$block_content['image']);?>
    <img id="hot_area_image" data-bili="<?= $block_content['bili'];?>" data-image-name="<?= $block_content['image'];?>" usemap="#<?= $hot_area_flag;?>" src="<?= $block_content['image'];?>" alt="<?= $block_content['image'];?>">
    <map name="<?= $hot_area_flag;?>" id="<?= $hot_area_flag;?>">
        <?php if(!empty($block_content['areas']) && is_array($block_content['areas'])) {?>
            <?php foreach($block_content['areas'] as $value) {?>
                <area target="_blank" shape="rect" coords="<?= $value['x1'];?>,<?= $value['y1'];?>,<?= $value['x2'];?>,<?= $value['y2'];?>" href ="<?= $value['link'];?>" alt="<?= $value['link'];?>" />
            <?php } ?>
        <?php } ?>
    </map>
</div>

