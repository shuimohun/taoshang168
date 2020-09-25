<?php if (!defined('ROOT_PATH')) {exit('No Permission');} ?>

<?= ($data['goods_detail']) ?>

<script type="text/javascript" charset="utf-8">
    $(function() {
        $("img").lazyload({skip_invisible : false,placeholder : "<?= $this->view->img ?>/grey.gif",threshold: 200,effect: "show",failurelimit : 10});
    });
</script>
