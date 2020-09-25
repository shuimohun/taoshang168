<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/'  . 'header.php';
?>
<link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>

<style>
    .ncap-form-default dl.row{border-bottom: 1px solid #F0F0F0;}
    .no_border{border:none !important;}
    .input-txt{width:50px;}
</style>
</head>
<body>
<div class="wrapper page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>资讯发帖设置</h3>
                <h5>资讯发帖奖励和处罚的设置</h5>
            </div>
            <ul class="tab-base nc-row">
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Information_Group&met=index"><span>资讯分类</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Information_Base&met=index"><span>资讯管理</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Information_Reply&met=index"><span>资讯评论</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Information_Pic&met=index"><span>资讯图片</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Information_Base&met=audit"><span>资讯审核</span></a></li>
                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Information_Report&met=index"><span>举报管理</span></a></li>
                <li><a class="current"><span>资讯发帖设置</span></a></li>
            </ul>
        </div>
    </div>
    <!-- 操作说明 -->
    <p class="warn_xiaoma"><span></span><em></em></p><div class="explanation" id="explanation">
        <div class="title" id="checkZoom"><i class="iconfont icon-lamp"></i>
            <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
            <span id="explanationZoom" title="收起提示"></span><em class="close_warn">X</em>
        </div>
        <ul>
            <li>资讯发帖奖励和处罚的设置</li>
        </ul>
    </div>
    <form method="post" enctype="multipart/form-data" id="information-form" name="form1">
        <input type="hidden" name="config_type[]" value="information"/>
        <div class="ncap-form-default">
            <div class="title">
                <h3>金蛋开关</h3>
            </div>
            <dl class="row">
                <dt class="tit">金蛋开关</dt>
                <dd class="opt">
                    <div class="onoff">
                        <label for="points_allow_1" class="cb-enable  <?=($data['points_allow']['config_value'] == '1' ? 'selected' : '')?>" title="开启">开启</label>
                        <label for="points_allow_0" class="cb-disable <?=($data['points_allow']['config_value'] == '0' ? 'selected' : '')?>" title="关闭">关闭</label>
                        <input id="points_allow_1" name="information[points_allow]" <?=($data['points_allow']['config_value'] == '1' ? 'checked' : '')?> value="1" type="radio">
                        <input id="points_allow_0" name="information[points_allow]" <?=($data['points_allow']['config_value'] == '0' ? 'checked' : '')?> value="0" type="radio">
                    </div>
                    <p class="notic">金蛋开关</p>
                </dd>
            </dl>
            <div class="title">
                <h3>发帖审核开关</h3>
            </div>
            <dl class="row">
                <dt class="tit">发帖审核开关</dt>
                <dd class="opt">
                    <div class="onoff">
                        <label for="verify_allow_1" class="cb-enable  <?=($data['verify_allow']['config_value'] == '1' ? 'selected' : '')?>" title="开启">开启</label>
                        <label for="verify_allow_0" class="cb-disable <?=($data['verify_allow']['config_value'] == '0' ? 'selected' : '')?>" title="关闭">关闭</label>
                        <input id="verify_allow_1" name="information[verify_allow]" <?=($data['verify_allow']['config_value'] == '1' ? 'checked' : '')?> value="1" type="radio">
                        <input id="verify_allow_0" name="information[verify_allow]" <?=($data['verify_allow']['config_value'] == '0' ? 'checked' : '')?> value="0" type="radio">
                    </div>
                    <p class="notic">发帖审核开关</p>
                </dd>
            </dl>

            <div class="title">
                <h3>作者奖励/处罚</h3>
            </div>
            <dl class="row">
                <dt class="tit">发帖文章及视频</dt>
                <dd class="opt">
                    <span>赠送</span>
                    <input name="information[post]" value="<?=($data['post']['config_value'])?>" class="input-txt ui-input" type="text">
                    <span>个金蛋</span>
                    <span>&nbsp;&nbsp;一天最多赠送</span>
                    <input name="information[author_post_top]" value="<?=($data['author_post_top']['config_value'])?>" class="input-txt ui-input" type="text">
                    <span>个金蛋</span>
                    <p class="notic">发帖文章及视频 一天最多赠送xx个金蛋</p>
                </dd>
            </dl>

            <dl class="row">
                <dt class="tit">推荐喜欢商品</dt>
                <dd class="opt">
                    <span>1个赠送</span>
                    <input name="information[recommend1]" value="<?=($data['recommend1']['config_value'])?>" class="input-txt ui-input" type="text">
                    <span>个金蛋</span>
                    <span>&nbsp;&nbsp;2个赠送</span>
                    <input name="information[recommend2]" value="<?=($data['recommend2']['config_value'])?>" class="input-txt ui-input" type="text">
                    <span>个金蛋</span>
                    <span>&nbsp;&nbsp;3个赠送</span>
                    <input name="information[recommend3]" value="<?=($data['recommend3']['config_value'])?>" class="input-txt ui-input" type="text">
                    <span>个金蛋</span>
                    <span>&nbsp;&nbsp;4个赠送</span>
                    <input name="information[recommend4]" value="<?=($data['recommend4']['config_value'])?>" class="input-txt ui-input" type="text">
                    <span>个金蛋</span>
                </dd>
            </dl>
            <dl class="row no_border">
                <dt class="tit">被点赞</dt>
                <dd class="opt">
                    <span>赠送</span>
                    <input name="information[be_liked]" value="<?=($data['be_liked']['config_value'])?>" class="input-txt ui-input" type="text">
                    <span>个金蛋</span>
                </dd>
            </dl>
            <dl class="row no_border">
                <dt class="tit">被关注</dt>
                <dd class="opt">
                    <span>赠送</span>
                    <input name="information[be_followed]" value="<?=($data['be_followed']['config_value'])?>" class="input-txt ui-input" type="text">
                    <span>个金蛋</span>
                </dd>
            </dl>
            <dl class="row no_border">
                <dt class="tit">被转发</dt>
                <dd class="opt">
                    <span>赠送</span>
                    <input name="information[be_forwarded]" value="<?=($data['be_forwarded']['config_value'])?>" class="input-txt ui-input" type="text">
                    <span>个金蛋</span>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">一天最多</dt>
                <dd class="opt">
                    <span>赠送</span>
                    <input name="information[author_top]" value="<?=($data['author_top']['config_value'])?>" class="input-txt ui-input" type="text">
                    <span>个金蛋</span>
                    <p class="notic">被点赞,被关注,被转发 一天的上限</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">审核不通过的处罚</dt>
                <dd class="opt">
                    <span>扣除</span>
                    <input name="information[no_pass]" value="<?=($data['no_pass']['config_value'])?>" class="input-txt ui-input" type="text">
                    <span>个金蛋</span>
                    <p class="notic">审核不通过的扣除xx个金蛋(审核开关开启时才可用)</p>
                </dd>
            </dl>

            <dl class="row">
                <dt class="tit">被举报1次</dt>
                <dd class="opt">
                    <?php if($data['report1']['config_value']){ list($type1,$day1,$points1) = explode('-',$data['report1']['config_value']);}?>
                    <span>禁言</span>
                    <input name="report1_day" value="<?=($day1)?>" class="input-txt ui-input" type="text">
                    <span>天&nbsp;&nbsp;并扣除</span>
                    <input name="report1_points" value="<?=($points1)?>" class="input-txt ui-input" type="text">
                    <span>个金蛋</span>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">被举报2次</dt>
                <dd class="opt">
                    <?php if($data['report2']['config_value']){ list($type1,$day1,$points1) = explode('-',$data['report2']['config_value']);}?>
                    <span>禁言</span>
                    <input name="report2_day" value="<?=($day1)?>" class="input-txt ui-input" type="text">
                    <span>天&nbsp;&nbsp;并扣除</span>
                    <input name="report2_points" value="<?=($points1)?>" class="input-txt ui-input" type="text">
                    <span>个金蛋</span>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">被举报3次</dt>
                <dd class="opt">
                    <?php if($data['report3']['config_value']){ list($type1,$day1,$points1) = explode('-',$data['report3']['config_value']);}?>
                    <span>封号</span>
                    <input name="report3_day" value="<?=($day1)?>" class="input-txt ui-input" type="text">
                    <span>天&nbsp;&nbsp;并扣除</span>
                    <input name="report3_points" value="<?=($points1)?>" class="input-txt ui-input" type="text">
                    <span>个金蛋</span>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">被举报4次</dt>
                <dd class="opt">
                    <?php if($data['report4']['config_value']){ list($type1,$day1,$points1) = explode('-',$data['report4']['config_value']);}?>
                    <span>永久封号&nbsp;&nbsp;并扣除</span>
                    <input name="report4_points" value="<?=($points1)?>" class="input-txt ui-input" type="text">
                    <span>个金蛋</span>
                </dd>
            </dl>

            <div class="title">
                <h3>读者奖励/处罚</h3>
            </div>
            <dl class="row no_border">
                <dt class="tit">阅读</dt>
                <dd class="opt">
                    <span>赠送</span>
                    <input name="information[read]" value="<?=($data['read']['config_value'])?>" class="input-txt ui-input" type="text">
                    <span>个金蛋</span>
                </dd>
            </dl>
            <dl class="row no_border">
                <dt class="tit">点赞</dt>
                <dd class="opt">
                    <span>赠送</span>
                    <input name="information[likes]" value="<?=($data['likes']['config_value'])?>" class="input-txt ui-input" type="text">
                    <span>个金蛋</span>
                </dd>
            </dl>
            <dl class="row no_border">
                <dt class="tit">关注</dt>
                <dd class="opt">
                    <span>赠送</span>
                    <input name="information[follow]" value="<?=($data['follow']['config_value'])?>" class="input-txt ui-input" type="text">
                    <span>个金蛋</span>
                </dd>
            </dl>
            <dl class="row no_border">
                <dt class="tit">转发</dt>
                <dd class="opt">
                    <span>赠送</span>
                    <input name="information[forward]" value="<?=($data['forward']['config_value'])?>" class="input-txt ui-input" type="text">
                    <span>个金蛋</span>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">一天最多</dt>
                <dd class="opt">
                    <span>赠送</span>
                    <input name="information[reader_top]" value="<?=($data['reader_top']['config_value'])?>" class="input-txt ui-input" type="text">
                    <span>个金蛋</span>
                    <p class="notic">点赞,关注,转发 一天的上限</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">举报奖励</dt>
                <dd class="opt">
                    <span>赠送</span>
                    <input name="information[report]" value="<?=($data['report']['config_value'])?>" class="input-txt ui-input" type="text">
                    <span>个金蛋</span>
                    <p class="notic">举报审核通过后奖励xx个金蛋</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">违规举报处罚</dt>
                <dd class="opt">
                    <span>扣除</span>
                    <input name="information[illegal_report]" value="<?=($data['illegal_report']['config_value'])?>" class="input-txt ui-input" type="text">
                    <span>个金蛋</span>
                    <p class="notic">违规举报 将扣除xx个金蛋</p>
                </dd>
            </dl>

            <div class="bot"><a href="javascript:void(0);" class="ui-btn ui-btn-sp submit-btn">确认提交</a></div>
        </div>
    </form>
    <script type="text/javascript" src="<?=$this->view->js?>/controllers/config.js" charset="utf-8"></script>
    <?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>