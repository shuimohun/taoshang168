<?php include $this->view->getTplPath() . '/' . 'header.php'; ?>

    <style>
        body {
            background-color: #000000;
            margin: 0;
            cursor: move;
            overflow: hidden;
        }
        .surface { width: 1026px; height: 1026px; background-size: cover; position: absolute; }
        .surface .bg { position: absolute; width: 1026px; height: 1026px; }
    </style>

    <div>
        <div id="surface_0" class="surface">
            <img class="bg" src="<?=$this->view->img ?>/posx.jpg" alt="">
        </div>
        <div id="surface_1" class="surface">
            <img class="bg" src="<?=$this->view->img ?>/negx.jpg" alt="">
        </div>
        <div id="surface_2" class="surface">
            <img class="bg" src="<?=$this->view->img ?>/posy.jpg" alt="">
        </div>
        <div id="surface_3" class="surface">
            <img class="bg" src="<?=$this->view->img ?>/negy.jpg" alt="">
        </div>
        <div id="surface_4" class="surface">
            <img class="bg" src="<?=$this->view->img ?>/posz.jpg" alt="">
        </div>
        <div id="surface_5" class="surface">
            <img class="bg" src="<?=$this->view->img ?>/negz.jpg" alt="">
        </div>
    </div>
    <script src="<?=$this->view->js ?>/three.min.js"></script>
    <script src="<?=$this->view->js ?>/CSS3DRenderer.min.js"></script>
    <script src="<?=$this->view->js ?>/index.js"></script>

<?php include $this->view->getTplPath() . '/' . 'footer.php'; ?>