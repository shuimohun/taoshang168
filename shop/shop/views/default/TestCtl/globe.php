<?php include $this->view->getTplPath() . '/' . 'header.php'; ?>

    <script type="text/javascript" src="<?=$this->view->js?>/echarts/echarts.js"></script>
    <script type="text/javascript" src="<?=$this->view->js?>/echarts/echarts-gl.min.js"></script>
    <script type="text/javascript" src="<?=$this->view->js?>/echarts/world.min.js"></script>

    <div id="globe" class="layui-container" data-name-map='<?=$name_map?>' style="height: 600px;">
    </div>

<?php include $this->view->getTplPath() . '/' . 'footer.php'; ?>