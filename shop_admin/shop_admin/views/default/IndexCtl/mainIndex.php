<?php if (!defined('ROOT_PATH')) {exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/'  . 'header.php';
?>

<link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
<link href="<?=$this->view->css?>/skin_0.css" rel="stylesheet" type="text/css">
<script src="<?=$this->view->js_com?>/template.js"></script>
</head>
<body>
	<div class="bbccontent">
        <div class="wrapper page">

            <div class="info-panel mainIndex_url clearfix">
                <dl class="member">
                    <dt>
						<div class="ico"><i></i><sub title="会员总数"><span><em id="statistics_member">0</em></span></sub></div>
						<h3>会员</h3>
						<h5>新增会员</h5>
					</dt>
                    <dd>
                        <ul>
                            <li class="w33pre normal"><a href="index.php?ctl=User_Info&met=info&type=day"><span>今日新增</span><sub><em id="statistics_day_add_member">0</em></sub></a></li>
                            <li class="w33pre normal"><a href="index.php?ctl=User_Info&met=info&type=zhou"><span>本周新增</span><sub><em id="statistics_week_add_member">0</em></sub></a></li>
                             <li class="w33pre normal"><a href="index.php?ctl=User_Info&met=info&type=yue"><span>本月新增</span><sub><em id="statistics_month_add_member">0</em></sub></a></li>
                        </ul>
                    </dd>
                </dl>

				<dl class="shop">
                    <dt>
						<div class="ico"><i></i><sub title="新增店铺数"><span><em id="statistics_store">0</em></span></sub></div>
						<h3>店铺</h3>
						<h5>新开店铺审核</h5>
					</dt>
                    <dd>
                        <ul>
                            <li class="w17pre normal"><a href="index.php?ctl=Shop_Manage&met=join"><span>开店审核</span><sub><em id="statistics_store_joinin">0</em></sub></a></li>
                            <li class="w17pre normal"><a href="index.php?ctl=Shop_Manage&met=indexs&type=zhou"><span>本周新增店铺</span><sub><em id="statistics_store_joinin_shop">0</em></sub></a></li>
                            <li class="w17pre normal"><a href="index.php?ctl=Shop_Manage&met=category"><span>类目申请</span><sub><em id="statistics_store_bind_class_applay">0</em></sub></a></li>
                            <li class="w17pre normal"><a href="index.php?ctl=Shop_Manage&met=reopen"><span>续签申请</span><sub><em id="statistics_store_reopen_applay">0</em></sub></a></li>
                            <li class="w15pre normal"><a href="index.php?ctl=Shop_Manage&met=indexs&type=dq"><span>已到期</span><sub><em id="statistics_store_expired">0</em></sub></a></li>
                            <li class="w17pre normal"><a href="index.php?ctl=Shop_Manage&met=indexs&type=jdq"><span>即将到期</span><sub><em id="statistics_store_expire">0</em></sub></a></li>
                        </ul>
                    </dd>
                </dl>

				<dl class="goods">
                    <dt>
						<div class="ico"><sub class="sub_goods" style="left:-30px;" title="商品总数"><span><em id="statistics_goods">0</em></span></sub><i></i><sub title="商品上架总数"><span><em id="statistics_goods_sta">0</em></span></sub></div>
						<h3>商品</h3>
						<h5>新增商品/品牌申请审核</h5>
					</dt>
                    <dd>
                        <ul>
                            <li class="w20pre normal"><a href="index.php?ctl=Goods_Goods&met=common&type=sj"><span>本周新增上架</span><sub title=""><em id="statistics_week_add_product">0</em></sub></a></li>
                            <li class="w20pre normal"><a href="index.php?ctl=Goods_Goods&met=common&type=wsj"><span>新增未上架</span><sub title=""><em id="statistics_week_add_products">0</em></sub></a></li>
                            <li class="w20pre normal"><a href="index.php?ctl=Goods_Goods&met=common&common_verify=10"><span>商品审核</span><sub><em id="statistics_product_verify">0</em></sub></a></li>
                            <li class="w15pre normal"><a href="index.php?ctl=Trade_Report&met=baseDo"><span>举报</span><sub><em id="statistics_inform_list">0</em></sub></a></li>
                            <li class="w20pre normal"><a href="index.php?ctl=Goods_Brand&met=brand"><span>品牌管理</span><sub><em id="statistics_brand_apply">0</em></sub></a></li>
                        </ul>
                    </dd>
                </dl>
                <dl class="trade">
                    <dt>
                    <div class="ico"><sub id="sub_goods" style="left:-15px;" title="当日支付订单"><span><em id="statistics_vr_order">0</em></span></sub><i></i><sub title="订单总数"><span><em id="statistics_order">0</em></span></sub></div>
                    <h3>交易</h3>
                    <h5>交易订单及投诉/举报</h5>
                    </dt>
                    <dd>
                        <ul>
                            <li class="w15pre normal"><a href="index.php?ctl=Trade_Return&met=refundWait&otyp=1"><span>退款</span><sub><em id="statistics_refund">0</em></sub></a></li>
                            <li class="w17pre normal"><a href="index.php?ctl=Trade_Return&met=refundWait&otyp=2"><span>退货</span><sub><em id="statistics_return">0</em></sub></a></li>
                            <li class="w17pre normal"><a href="index.php?ctl=Trade_Return&met=refundWait&otyp=1&recheck=1"><span>退款复审</span><sub><em id="statistics_refund_recheck">0</em></sub></a></li>
                            <li class="w17pre normal"><a href="index.php?ctl=Trade_Return&met=refundWait&otyp=2&recheck=1"><span>退货复审</span><sub><em id="statistics_return_recheck">0</em></sub></a></li>
                            <li class="w17pre normal"><a href="index.php?ctl=Trade_Complain&met=complain&state=1"><span>投诉</span><sub><em id="statistics_complain_new_list">0</em></sub></a></li>
                            <li class="w17pre normal"><a href="index.php?ctl=Trade_Complain&met=complain&state=4"><span>待仲裁</span><sub><em id="statistics_complain_handle_list">0</em></sub></a></li>
                        </ul>
                    </dd>
                </dl>

                <dl class="operation">
                    <dt>
						<div class="ico"><i></i></div>
						<h3>运营</h3>
						<h5>系统运营类设置及审核</h5>
					</dt>
                    <dd>
                        <ul>
                            <li class="w15pre none"><a href="?ctl=Config&met=operation&config_type%5B%5D=operation"><span>设置</span><sub><em id="statistics_groupbuy_verify_list">0</em></sub></a></li>
                            <li class="w17pre normal"><a href="?ctl=Operation_Settlement&met=settlement"><span>结算管理</span><sub><em id="statistics_points_order">0</em></sub></a></li>
                            <li class="w17pre none"><a href="?ctl=Operation_Settlement&met=settlement&otyp=1"><span>虚拟订单</span><sub><em id="statistics_check_billno">0</em></sub></a></li>
                            <li class="w17pre normal"><a href="?ctl=Operation_Custom&met=custom&type=wwf"><span>平台客服</span><sub><em id="statistics_pay_billno">0</em></sub></a></li>
                            <li class="w17pre none"><a href="?ctl=Operation_Delivery&met=delivery"><span>物流自提</span><sub><em id="statistics_mall_consult">0</em></sub></a></li>
                            <li class="w17pre normal"><a href="?ctl=Operation_Contract&met=log&type=shz"><span>服务站</span><sub><em id="statistics_delivery_point">0</em></sub></a></li>
                        </ul>
                    </dd>
                </dl>
                <div class="clear"></div>
                <div class="system-info"></div>
            </div>
        </div>
    </div>
<script>
	$('.mainIndex_url a').click(function(){
		var aurl = $(this).attr('href');
		var text = $(this).find('span').html();


        var target = $(this).attr('target');

        if (target == '_blank')
        {
            return true;
        }
        else
        {
            parent.tab.addTabItem({
                text:text,
                url: SITE_URL + '/' +aurl
            });
        }

		return false;
	});

	$('#statistics_goods').click(function () {
        parent.tab.addTabItem({
            text:'商品总数',
            url: SITE_URL + '/' +'index.php?ctl=Goods_Goods&met=common'
        });
    })

    $('#statistics_member').click(function () {
        parent.tab.addTabItem({
            text:'会员总数',
            url: SITE_URL + '/' +'index.php?ctl=User_Info&met=info'
        });
    })
    $('#statistics_store').click(function () {
        parent.tab.addTabItem({
            text:'新增店铺数',
            url: SITE_URL + '/' +'index.php?ctl=Shop_Manage&met=indexs'
        });
    })
    $('#statistics_order').click(function(){
        parent.tab.addTabItem({
            text:'订单总数',
            url: SITE_URL + '/' +'index.php?ctl=Trade_Order&met=order'
        });
    })
    $('#statistics_vr_order').click(function(){
        parent.tab.addTabItem({
            text:'订单总数',
            url: SITE_URL + '/' +'index.php?ctl=Trade_Order&met=order&otyp=1'
        });
    })
    $('#statistics_goods_sta').click(function(){
        parent.tab.addTabItem({
            text:'商品上架总数',
            url: SITE_URL + '/' +'index.php?ctl=Goods_Goods&met=common&type=goods_sj'
        });
    })


</script>
<script type="text/javascript" src="<?=$this->view->js?>/controllers/mainIndex.js" charset="utf-8"></script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>