<?php include $this->view->getTplPath() . '/' . 'header.php'; ?>

    <link rel="stylesheet" type="text/css" href="<?= $this->view->layui ?>/css/modules/formSelects-v4.css"/>

<style>
    .layui-form-item .layui-input-inline{width: 600px;}
</style>
    <div class="layui-container" style="height: 600px;">
        <form method="post" action="">
            <div class="layui-form-item">
                <label for="L_username" class="layui-form-label">名称</label>
                <div class="layui-input-inline">
                    <input type="text" id="L_username" name="username" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_username" class="layui-form-label">全球分布</label>
                <div class="layui-input-inline">
                    <div class="layui-form">
                        <select name="country" xm-select="example1_1" xm-select-search="" xm-select-search-type="dl">
                            <option value="1">北京</option>
                            <option value="2">上海</option>
                            <option value="3">广州</option>
                            <option value="4">深圳</option>
                            <option value="5">天津</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_username" class="layui-form-label">国内分布</label>
                <div class="layui-input-inline">
                    <div class="layui-form">
                        <select name="china" xm-select="example2_1" xm-select-search="" xm-select-search-type="dl">
                            <option value="1">北京</option>
                            <option value="2">上海</option>
                            <option value="3">广州</option>
                            <option value="4">深圳</option>
                            <option value="5">天津</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>






    </div>

<?php include $this->view->getTplPath() . '/' . 'footer.php'; ?>