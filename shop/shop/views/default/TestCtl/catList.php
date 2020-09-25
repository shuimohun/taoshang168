<?php include $this->view->getTplPath() . '/' . 'header.php'; ?>
    <div class="layui-container" style="min-height: 600px;">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md8">
                <div class="fly-panel">
                    <div class="fly-panel-title">
                        <?php if ($cat['parent']){?>
                            <a href="<?=YLB_Registry::get('url')?>?ctl=Index&met=catList&id=<?=$cat['parent']['cat_id']?>"><?=$cat['parent']['cat_name']?></a>
                            <i class="fly-mid"></i>
                        <?php }?>
                        <a href="<?=YLB_Registry::get('url')?>?ctl=Index&met=catList&id=<?=$cat['cat_id']?>"><?=$cat['cat_name']?></a>
                        <?php if ($cat['sub']){?>
                            <?=$cat['sub']?>
                        <?php }?>
                    </div>
                    <div class="fly-panel-main" style="text-indent: 2em">
                        <?=isset($cat['cat_introduction']) ? $cat['cat_introduction'] : ''?>
                    </div>
                    <div class="fly-panel fly-rank fly-rank-reply">
                        <dl style="margin-left: 45px;text-align: left;">
                            <?php if($data['items']){foreach ($data['items'] as $key => $value){?>
                                <dd style="width: 150px;height:175px;">
                                    <a href="<?=YLB_Registry::get('url')?>?ctl=Index&met=detail&id=<?=$value['cat_id']?>">
                                        <img src="<?=$value['cat_pic']?>" style="width: 150px;height:150px;">
                                        <i><?=$value['cat_name']?></i>
                                    </a>
                                </dd>
                            <?php }}?>
                        </dl>
                    </div>
                    <?php if ($data['page_nav']){?>
                        <div style="text-align: center">
                            <div class="laypage-main">
                                <?=$data['page_nav']?>
                            </div>
                        </div>
                    <?php }?>
                </div>
            </div>
            <div class="layui-col-md4">
                <dl class="fly-panel fly-list-one">
                    <dt class="fly-panel-title" style="margin: 0;padding: 10px 10px 0 10px;">
                    <form class="layui-form">
                        <div class="layui-form-item">
                            <select lay-filter="cat" data-url="<?=YLB_Registry::get('url')?>?ctl=Index&met=catList&id=">
                                <?php if($this->cat){foreach ($this->cat as $key => $value){?>
                                    <option value="<?=$value['cat_id']?>" <?php if($cat['parent'] && $value['cat_id'] == $cat['parent']['cat_id']){echo 'selected';}else if($value['cat_id'] == $cat['cat_id']){echo 'selected';}?>><?=$value['cat_name']?></option>
                                <?php }}?>
                            </select>
                        </div>
                    </form>
                    </dt>
                    <?php if (isset($sub_row) && $sub_row) {foreach ($sub_row as $key => $value){?>
                        <dd>
                            <a <?php if($value['cat_id'] == request_int('id')){echo 'class="layui-this"';}?> href="<?=YLB_Registry::get('url')?>?ctl=Index&met=catList&id=<?=$value['cat_id']?>"><?=$value['cat_name']?></a>
                        </dd>
                    <?php }}?>
                </dl>
            </div>
        </div>
    </div>
<?php include $this->view->getTplPath() . '/' . 'footer.php'; ?>