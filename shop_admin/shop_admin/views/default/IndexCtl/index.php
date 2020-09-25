<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>
<script>
	var CONFIG = {
		DEFAULT_PAGE: true,
	};
	//系统参数控制
	var SYSTEM = {
		version: 1,
		skin: "default",
		curDate: '1423619990432',  //系统当前日期
		DBID: '88887785', //账套ID
		serviceType: '15', //账套类型，13：表示收费服务，12：表示免费服务
		userName: 'Demo', //用户名
		companyName: '商城管理中心',	//公司名称
		companyAddr: '',	//公司地址
		phone: '',	//公司电话
		fax: '',	//公司传真
		postcode: '',	//公司邮编
		startDate: '2015-11-18', //启用日期
		invEntryCount: '',//试用版单据分录数
		rights: {},//权限列表
		taxRequiredCheck: 1,
		taxRequiredInput: 13,
		isAdmin: true, //是否管理员
		siExpired: false,//是否过期
		siType: 2, //服务版本，1表示基础版，2表示标准版
		siVersion: 4, //1表示试用、2表示免费（百度版）、3表示收费，4表示体验版
		shortName: ""//shortName
	};

	SYSTEM.categoryInfo = {};
	//区分服务支持
	SYSTEM.servicePro = SYSTEM.siType === 2 ? 'forbscm3' : 'forscm3';
	var cacheList = {};	//缓存列表查询
	//全局基础数据

	//缓存登陆用户
	function getUser() {
		Public.ajaxGet('', {}, function (data) {
			if (data.status === 200) {
				SYSTEM.realName = (data.data[0].user_account);
			} else if (data.status === 250) {
				SYSTEM.realName = '';
			} else {
				Public.tips({type: 1, content: data.msg});
			}
		});
	}

	//缓存时间
	function initDate() {
		var a = new Date,
			b = a.getFullYear(),
			c = ("0" + (a.getMonth() + 1)).slice(-2),
			d = ("0" + a.getDate()).slice(-2);
		SYSTEM.beginDate = b + "-" + c + "-01", SYSTEM.endDate = b + "-" + c + "-" + d
	}

	//缓存商品分类
	function getGoodsCatTree() {
		Public.ajaxPost(SITE_URL + '?ctl=Category&met=lists&typ=json&type_number=goods_cat&is_delete=2&step=1', {}, function(data) {
			if (data.status === 200 && data.data) {
				SYSTEM.goodsCatInfo = data.data.items;
				SYSTEM.goodsCatInfo.unshift({name:'全部分类',id:-1});
			} else {
			}
		});
	}

	//缓存客户信息
	function getBrand() {
		if(true) {
			Public.ajaxGet('./c.php', { rows: 5000 }, function(data){
				if(data.status === 200) {
					SYSTEM.brandInfo = data.data.rows;
				} else if (data.status === 250){
					SYSTEM.brandInfo = [];
				} else {
					Public.tips({type: 1, content : data.msg});
				}
			});
		} else {
			SYSTEM.brandInfo = [];
		}
	}

	//缓存管理员
	function getUserInfo() {
        Public.ajaxGet(SITE_URL + '?ctl=Category&met=listUser&typ=json&type_number=user', {}, function (data) {
            if (data.status === 200) {
                SYSTEM.categoryInfo['user'] = data.data.items;
            } else if (data.status === 250) {
                SYSTEM.categoryInfo['user'] = {};
            } else {
                Public.tips({type: 1, content: data.msg});
            }
        });
	}

	//state verify
	function getGoodsState() {
		Public.ajaxGet(SITE_URL + '?ctl=Category&met=lists&typ=json&type_number=goods_state', {}, function (data) {
			if (data.status === 200) {
				for(var key in  data.data){
					SYSTEM.categoryInfo[key] = data.data[key];
				}
			} else{

				SYSTEM.categoryInfo['state'] = {};
				SYSTEM.categoryInfo['verify'] = {};
				SYSTEM.categoryInfo['type'] = {};
			}
		})
	}

    //全局基础数据
    $(function() {
        getUserInfo();
        getGoodsState();
        initDate();
        getGoodsCatTree();
    });
</script>
<link href="<?= $this->view->css ?>/base.css" rel="stylesheet" type="text/css">
<link href="<?= $this->view->css ?>/default.css" rel="stylesheet" type="text/css" id="defaultFile">
<script src="<?= $this->view->js_com ?>/tabs.js?ver=20140430"></script>
</head>
<body>

<div id="container" class="cf">

	<div class="col-hd cf">
		<div class="left"><a class="company" id="companyName" href="javascript:;" title=""></a></div>

		<div class="right cf">

            <!--<ul class="nav">
                <li class="cur" id="fast">平台</li>
                <li>商城</li>
            </ul>-->

            <?php
                $ucenter_api_url_row = parse_url(YLB_Registry::get('ucenter_api_url'));
                $ucenter_admin_url = YLB_Registry::get('ucenter_admin_api_url');

                $paycenter_api_url_row = parse_url(YLB_Registry::get('paycenter_api_url'));
                $paycenter_admin_api_url = YLB_Registry::get('paycenter_admin_api_url');

                $analytics_app_id = YLB_Registry::get('analytics_app_id');
                $analytics_jump_url =  YLB_Registry::get('analytics_api_url').'?plat_id='.$analytics_app_id;
			?>
			<ol>
				<li><a href="<?= $ucenter_admin_url ?>" target="_blank"><i class="nav_href">UCenter</i></a></li>
				<li><a href="<?= $paycenter_admin_api_url ?>" target="_blank"><i class="nav_href">PayCenter</i></a></li>
                <?php
                $im_statu = YLB_Registry::get('im_statu');
                if($im_statu == 1){?>
                    <li><a href="<?= YLB_Registry::get('im_admin_api_url') ?>" target="_blank"><i class="nav_href"><?php echo _('ImBuilder')?></i></a></li>
                <?php }?>
				<li><img src="<?= YLB_Registry::get('ucenter_api_url') ?>?ctl=Index&met=img&user_id=<?=Perm::$userId?>"><div><span><?=Perm::$row['user_account']?></span><div></li>
				<li><a href="#"><i class="iconfont icon-top01"></i></a></li>
				<li><a href="<?= YLB_Registry::get('shop_api_url') ?>" target="_blank"><i class="iconfont icon-top02"></i></a></li>
				<li><a href="<?= YLB_Registry::get('url') ?>?ctl=Login&met=loginout"><i class="iconfont icon-top03"></i></a></li>
			</ol>
		</div>
	</div>
	<div class="col-bd">
		<div id="col-side">
			<div class="nav-wrap hidden cf"><!--商品-->
				<ul id="nav" class="cf">
					<?php foreach ($menus as $key=>$val){?>
					<li class="item item-setting" data-id="<?= $key?>">
						<a href="javascript:void(0);" class="setting main-nav"><i class="iconfont <?=($val['menu_icon'])?>"></i>
						<p><?=($val['menu_name'])?></p><s></s></a>
					</li>

					<?php }?>
				</ul>

				<div id="sub-nav"><!--商城设置-->
					<?php foreach($menus as $key=>$val){?>
                        <ul data-id="<?=$key?>">
                            <?php foreach($val['next_menus'] as $k=>$v){?>
                                <li data-id="<?= $key ?>">
                                    <i class="iconfont icon-point"></i>
                                    <a data-right="BU_QUERY" href="<?= YLB_Registry::get('url') ?>?ctl=<?=($v['menu_url_ctl'])?>&met=<?=($v['menu_url_met'])?><?php if($v['menu_url_parem']){?>&<?=($v['menu_url_parem'])?><?php }?>" rel="pageTab" tabid="<?=($v['menu_id'])?>" tabtxt="<?=($v['menu_name'])?>"><?=($v['menu_name'])?></a>
                                </li>
                            <?php }?>
                        </ul>
					<?php }?>
				</div>
			</div>
		</div>

		<div id="col-main">
			<div id="main-bd">
				<div class="page-tab" id="page-tab"></div>
			</div>
		</div>
	</div>
</div>
<div id="selectSkin" class="shadow dn">
	<ul class="cf">
		<li><a id="skin-default"><span></span><small>经典</small></a></li>
		<li><a id="skin-blue"><span></span><small>丰收</small></a></li>
		<li><a id="skin-green"><span></span><small>小清新</small></a></li>
	</ul>
</div>
<!--暂时屏蔽未开发菜单-->
<script>
	// 菜单初始样式
	$('#nav li:first').addClass('cur');
	$('#sub-nav ul:first').attr('class','cur cf');
	$('#sub-nav ul:first').attr('id','setting-base');
    $('#page-tab').click(function () {
        tab_id = $('.l-selected').attr('tabid');
        li = $("#sub-nav ul li a[tabid="+tab_id+"]").parent();
        li.siblings().removeAttr('class');
        li.addClass('cur');
        tab_k = li.attr('data-id');
        tab_ul = $('#sub-nav ul[data-id='+tab_k+']');
        tab_ul.attr('style','display:block');
        tab_ul.siblings().attr('style','display:none');
        big_tab = $('#nav li[data-id='+tab_k+']');
        big_tab.siblings().removeClass('cur');
        big_tab.addClass('cur');
    })
</script>
<script src="<?= $this->view->js ?>/controllers/default.js"></script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>



