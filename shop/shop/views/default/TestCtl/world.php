<?php include $this->view->getTplPath() . '/' . 'header.php'; ?>
    <script type="text/javascript" src="<?=$this->view->js ?>/echarts/echarts.js"></script>
    <script type="text/javascript" src="<?=$this->view->js ?>/echarts/world.js"></script>
    <script type="text/javascript" src="<?=$this->view->js ?>/echarts/china.min.js"></script>
    <div class="layui-container" style="height: 600px;">
        <div id="world" data-source='<?=$source?>'></div>
    </div>
<?php include $this->view->getTplPath() . '/' . 'footer.php'; ?>