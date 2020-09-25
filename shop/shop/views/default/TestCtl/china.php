<?php include $this->view->getTplPath() . '/' . 'header.php'; ?>
    <script type="text/javascript" src="<?=$this->view->js ?>/echarts/echarts.js"></script>
    <script type="text/javascript" src="<?=$this->view->js ?>/echarts/china.min.js"></script>
    <div class="layui-container">
        <div id="china" data-source='<?=$source?>'></div>
    </div>
<?php include $this->view->getTplPath() . '/' . 'footer.php'; ?>