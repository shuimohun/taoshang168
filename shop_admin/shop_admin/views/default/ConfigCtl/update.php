<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
} ?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';


// 当前管理员权限
$admin_rights = $this->adminRights;
// 当前页父级菜单 同级菜单 当前菜单
$menus = $this->adminMenus;

?>
<link href="<?= $this->view->css ?>/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?= $this->view->css_com ?>/jquery/plugins/validator/jquery.validator.css">
<script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?= $this->view->js_com ?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
<style>

    .dx-warning {
        background: #FFF;
        border: 5px solid #ffba00;
        padding: 20px;
        margin-bottom: 30px
    }

    .dx-warning h2 {
        margin: 0;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f0f0f0
    }

    .dx-warning ol {
        margin-top: 20px
    }

    .dx-warning li {
        margin: 5px 0
    }

</style>
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
            </ul>
        </div>
    </div>

    <!-- 操作说明 -->
    <p class="warn_xiaoma"><span></span><em></em></p>
    <div class="explanation" id="explanation">
        <div class="title" id="checkZoom"><i class="iconfont icon-lamp"></i>
            <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
            <span id="explanationZoom" title="收起提示"></span><em class="close_warn iconfont icon-guanbifuzhi"></em></div>
        <ul>
            <!-- <?=$menus['this_menu']['menu_url_note']?> -->
            重要：在升级前，请备份您的数据库和文件。
        </ul>
    </div>

   <!--  <div class="dx-warning hidden">
        <div>
            <p></p>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function($)
        {
            if( ! $.isFunction($.fn.dxChart))
                $(".dx-warning").removeClass('hidden');
        });
    </script>
 -->
    <div class="mod-toolbar-top cf">
        <div class="left">
            <div id="assisting-category-select" class="ui-tab-select ui-btn-update">
                <ul class="ul-inline">
                    <li><a class="ui-btn" id="force-check">当前版本<?=$client_version?>, 再次检查版本状态<i class="iconfont icon-btn01"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="fr">
            <!--<a class="ui-btn" id="btn-add">新增<i class="iconfont icon-btn03"></i></a>-->
        </div>
    </div>
	
	
	<?php if ($client_version !== $version_row['current'] && version_compare( $version_row['current'], $client_version, 'gt')):?>
        <h1 class="tc mt20">有新的BBC版本(<?=$version_row['current']?>)可供升级。</h1><br />
		
		<?php if ($partial): ?>
            <p class="tc">您可以自动升级到<?=$version_row['current']?>或下载软件包并手动安装：</p>
            <p class="tc"><a class="ui-btn" id="upgrade">现在更新<i class="iconfont"></i></a></p>
            <p class="tc">当您升级您的站点时，站点将自动进入维护模式。升级完成后会自动退出。</p>
		<?php else: ?>
            <p></p>
            <p class="tc">服务器程序有变动, 不建议强制覆盖升级！</p>
			<?php
			foreach ($change_file_row as $item)
			{
				update_feedback($item);
			}
			?>
            <br />
            <p><a class="ui-btn" id="force-upgrade">忽略变化，强制覆盖更新<i class="iconfont"></i></a></p>
		
		<?php endif;?>
	
	<?php else: ?>
        <h1 class="tc mt20">您使用的BBC是最新版本。 将来的安全更新将被自动安装。</h1><br />
        <p class="tc">如果您需要重新安装<?=$version_row['current']?>版本，您可以在这里进行，或下载并手动安装：</p>
        <p class="tc mt30"><a class="ui-btn" id="reinstall">重新安装<i class="iconfont"></i></a> <!--<a class="ui-btn" id="download">下载<?=$version_row['current']?><i class="iconfont"></i></a>--></p>
	<?php endif;?>

</div>

<script>


    $('#reinstall').on("click", function (e)
    {
        $.dialog.confirm('确认重新安装,是否继续？', function () {
            window.location.href = "<?= YLB_Registry::get('url') ?>?ctl=Config&met=update&upgrade=1&force-upgrade=1";
        });
    });

    $('#force-check').on("click", function (e)
    {
        window.location.href = "<?= YLB_Registry::get('url') ?>?ctl=Config&met=update&force-check=1";
    });

    $('#upgrade').on("click", function (e)
    {
        $.dialog.confirm('确认更新,是否继续？', function () {
            window.location.href = "<?= YLB_Registry::get('url') ?>?ctl=Config&met=update&upgrade=1";
        });
    });

    $('#force-upgrade').on("click", function (e)
    {
        $.dialog.confirm('确认强制重新安装,是否继续？', function () {
            window.location.href = "<?= YLB_Registry::get('url') ?>?ctl=Config&met=update&force-upgrade=1";
        });
    });


</script>

<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>

