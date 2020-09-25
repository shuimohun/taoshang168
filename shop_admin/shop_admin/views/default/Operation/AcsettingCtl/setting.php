<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/'  . 'header.php';
// 当前管理员权限
$admin_rights = $this->getAdminRights();
// 当前页父级菜单 同级菜单 当前菜单
$menus = $this->getThisMenus();

?>
    <link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
    </head>
    <body>
<div class="wrapper page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3><?=$menus['father_menu']['menu_name']?></h3>
                <h5><?=$menus['father_menu']['menu_url_note']?></h5>
            </div>
            <ul class="tab-base nc-row">
                <?php
                foreach($menus['brother_menu'] as $key=>$val){
                    if(in_array($val['rights_id'],$admin_rights)||$val['rights_id']==0){
                        ?>
                        <li><a <?php if(!array_diff($menus['this_menu'], $val)){?> class="current"<?php }?> href="<?= YLB_Registry::get('url') ?>?ctl=<?=$val['menu_url_ctl']?>&met=<?=$val['menu_url_met']?><?php if($val['menu_url_parem']){?>&<?=$val['menu_url_parem']?><?php }?>"><span><?=$val['menu_name']?></span></a></li>
                        <?php
                    }
                }
                ?>
                <!-- <li><a class="current"><span>运营设置</span></a></li> -->
            </ul>
        </div>
    </div>
    <!-- 操作说明 -->
    <p class="warn_xiaoma"><span></span><em></em></p><div class="explanation" id="explanation">
        <div class="title" id="checkZoom"><i class="iconfont icon-lamp"></i>
            <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
            <span id="explanationZoom" title="收起提示"></span><em class="close_warn iconfont icon-guanbifuzhi"></em></div>
        <ul>
            <?=$menus['this_menu']['menu_url_note']?>
        </ul>
    </div>

    <form method="post" id="activity-setting-form" name="settingForm">
        <?php if($data['items']){foreach($data['items'] as $key=>$value){ ?>
        <div class="ncap-form-default">
            <dl class="row">
                <dt class="tit"><?=$value['ac_remark']?></dt>
                <dd class="opt">
                    <ul class="nofloat">
                        <li>
                            <div class="onoff">
                                <label title="开启" class="cb-enable <?=($value['ac_enable']==1 ? 'selected' : '')?> " for="<?=$value['ac_name']?>_enable">开启</label>
                                <label title="关闭" class="cb-disable <?=($value['ac_enable']==0 ? 'selected' : '')?>" for="<?=$value['ac_name']?>_disabled">关闭</label>
                                <input type="radio" value="1" name="activity[<?=$value['ac_name']?>]" id="<?=$value['ac_name']?>_enable" <?=($value['ac_enable']==1 ? 'checked' : '')?> />
                                <input type="radio" value="0" name="activity[<?=$value['ac_name']?>]" id="<?=$value['ac_name']?>_disabled" <?=($value['ac_enable']==0 ? 'checked' : '')?> />
                            </div>
                        </li>
                    </ul>
                </dd>
            </dl>
            <?php } }?>
            <div class="bot"><a href="JavaScript:void(0);" class="ui-btn ui-btn-sp submit-btn">确认提交</a></a></div>
        </div>
    </form>
</div>
<script type="text/javascript" src="<?=$this->view->js?>/controllers/config.js" charset="utf-8"></script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>