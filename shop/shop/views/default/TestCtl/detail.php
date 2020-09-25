<?php include $this->view->getTplPath() . '/' . 'header.php'; ?>
    <div class="layui-container" style="min-height: 600px;">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md8">
                <div class="fly-panel">
                    <div class="fly-panel-title">
                        <?php if ($parent_cat_row){ foreach ($parent_cat_row as $key => $value){?>
                            <a href="<?=YLB_Registry::get('url')?>?ctl=Index&met=catList&id=<?=$value['cat_id']?>"><?=$value['cat_name']?></a>
                            <?php if($value['cat_id'] != $cat['cat_id']){?>
                                <i class="fly-mid"></i>
                            <?php }?>
                        <?php }}?>
                    </div>
                    <div class="fly-panel-main" style="text-indent: 2em">
                        <?=isset($cat['cat_introduction']) ? $cat['cat_introduction'] : ''?>
                    </div>
                </div>
            </div>
            <div class="layui-col-md4">
                <dl class="fly-panel fly-list-one">
                    <dt class="fly-panel-title" style="margin: 0;padding: 10px 10px 0 10px;">
                        <form class="layui-form">
                            <div class="layui-form-item">
                                <select lay-filter="cat">
                                    <?php if($this->cat){foreach ($this->cat as $key => $value){?>
                                        <option value="<?=$value['cat_id']?>" <?php if(isset($g_cat) && $g_cat['cat_id'] == $value['cat_id']){echo 'selected';}?> ><?=$value['cat_name']?></option>
                                    <?php }}?>
                                </select>
                            </div>
                        </form>
                    </dt>

                    <?php if (isset($sub_row) && $sub_row) {foreach ($sub_row as $key => $value){?>
                        <dd>
                            <a <?php if(isset($p_cat) && $p_cat['cat_id'] == $value['cat_id']){echo 'class="layui-this"';}?> href="<?=YLB_Registry::get('url')?>?ctl=Index&met=catList&id=<?=$value['cat_id']?>"><?=$value['cat_name']?></a>
                        </dd>
                    <?php }}?>

                </dl>
            </div>
        </div>
    </div>
<?php include $this->view->getTplPath() . '/' . 'footer.php'; ?>