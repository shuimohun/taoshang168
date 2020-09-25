<?php include $this->view->getTplPath() . '/' . 'header.php'; ?>
    <style>
        html,body{height:100%;margin:0;overflow:hidden}#world-map,#country-map{position:absolute;left:0;right:0;top:0;bottom:0}#world-map{z-index: 2;}#country-map{z-index: 1;}#back{position:absolute;left:20px;top:20px;border:0;background:#fff;box-shadow:0 0 1px rgba(0,0,0,0.4);border-radius:10px 2px 2px 10px;cursor:pointer;font-size:16px;outline:0;display:none;z-index:111;padding:2px 8px 4px 12px}#back:hover{background:#ccc}
        .layui-form-pane .layui-form-label{width:60px;}
        .layui-form-pane .layui-input-block{margin-left: 60px;}
    </style>
    <script type="text/javascript" src="<?=$this->view->js ?>/starbucks/echarts.js"></script>
    <script type="text/javascript" src="<?=$this->view->js ?>/starbucks/world.js"></script>

    <div class="layui-container" style="width: 100%; height:90%;">
        <div class="layui-col-xs2" style="background-color: #fff; height:100%; padding: 5px;">
            <form class="layui-form">
                <div class="layui-form layui-form-pane">
                    <div class="layui-form-item">
                        <label class="layui-form-label">亚科</label>
                        <div class="layui-input-block">
                            <select name="ke" lay-filter="map" class="select-1" data-lv="1">
                                <option value=""></option>
                                <?php if(isset($this->cat)){foreach ($this->cat as $key => $value){?>
                                    <option value="<?=$value['cat_id']?>"><?=$value['cat_name']?></option>
                                <?php }}?>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">属</label>
                        <div class="layui-input-block">
                            <select name="shu" lay-filter="map" class="select-2" data-lv="2" lay-search></select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">种</label>
                        <div class="layui-input-block">
                            <select name="zhong" lay-filter="map" class="select-3" data-lv="3" lay-search></select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="layui-col-xs10" style="height:100%;overflow: hidden;">
            <div id="world-map" data-source='<?=$source?>'></div>
            <div id="country-map"></div>
            <button id="back">返回</button>
        </div>
    </div>


<?php include $this->view->getTplPath() . '/' . 'footer.php'; ?>