
<?php $block_content = empty($block_content) ? $decoration_detail['block_content'] : $block_content; 
?>
<?php $block_content = $block_content;?>
<ul nctype="store_decoration_slide" style="height:<?php echo $block_content['height'];?>px; overflow:hidden;">
    <?php if(!empty($block_content['images']) && is_array($block_content['images'])) {?>
    <?php foreach($block_content['images'] as $value) {?>

    <li data-image-name="<?php echo $value['image_name'];?>" data-image-url="<?php echo $value['image_name'];?>" data-image-link="<?php echo $value['image_link'];?>" style="height:<?php echo $block_content['height'];?>px; background: url(<?php echo $value['image_name'];?>) no-repeat scroll center top transparent;">
    <a href="<?php echo $value['image_link'];?>" target="_blank" style="display:block;width:100%;height:100%;"></a>
    </li>
    <?php } ?>
    <?php } ?>
</ul>
