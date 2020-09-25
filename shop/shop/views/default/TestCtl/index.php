<?php include $this->view->getTplPath() . '/' . 'header.php'; ?>
    <div class="layui-container">
        <div class="layui-row layui-col-space10">
            <div class="layui-col-md8">
                <?php if($this->cat){foreach ($this->cat as $key => $value){?>
                    <div class="layui-col-xs12 layui-col-lg6" style="padding:0 5px 5px 0;">
                        <div class="layui-card">
                            <div class="layui-card-header"><a href="<?=YLB_Registry::get('url')?>?ctl=Index&met=catList&id=<?=$value['cat_id']?>"><?=$value['cat_name']?></a></div>
                            <div class="layui-card-body" style="height: 290px;">
                                <?php foreach ($value['sub'] as $k => $v){?>
                                    <ul>
                                        <li><a href="<?=YLB_Registry::get('url')?>?ctl=Index&met=catList&id=<?=$v['cat_id']?>"><?=$v['cat_name']?></a></li>
                                    </ul>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                <?php }}?>
            </div>
            <div class="layui-col-md4">
                <div style="width:100%;height: 800px;background-color: #fff;"></div>
            </div>
        </div>
    </div>
<?php include $this->view->getTplPath() . '/' . 'footer.php'; ?>