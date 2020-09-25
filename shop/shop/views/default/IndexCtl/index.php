
<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
if (!isset($_COOKIE['sub_site_id']))
{
    $_COOKIE['sub_site_id'] = 0;
}
?>

<div style="height:500px;" class="slideBox">
    <div class="hd">
        <ul>
            <li></li><li></li> <li></li> <li></li> <li></li>
        </ul>
    </div>
    <div class="banner  bd">
        <ul class="banimg">
            <li>
                <a href="<?php if (isset($_COOKIE['sub_site_id']) && $_COOKIE['sub_site_id'] > 0){ echo Web_ConfigModel::value($_COOKIE['sub_site_id'].'index_live_link1');}else{echo Web_ConfigModel::value('index_live_link1');}?>" style="background-image: url(<?php if (isset($_COOKIE['sub_site_id'])  && $_COOKIE['sub_site_id'] > 0){echo Web_ConfigModel::value($_COOKIE['sub_site_id'].'index_slider_image1');}else{echo Web_ConfigModel::value('index_slider_image1', Web_ConfigModel::value('index_slider1_image'));}?>);"></a>
            </li>
            <li>
                <a href="<?php if (isset($_COOKIE['sub_site_id']) && $_COOKIE['sub_site_id'] > 0){ echo Web_ConfigModel::value($_COOKIE['sub_site_id'].'index_live_link2');}else{echo Web_ConfigModel::value('index_live_link2');}?>" style="background-image: url(<?php if (isset($_COOKIE['sub_site_id'])  && $_COOKIE['sub_site_id'] > 0){echo Web_ConfigModel::value($_COOKIE['sub_site_id'].'index_slider_image2');}else{echo Web_ConfigModel::value('index_slider_image2', Web_ConfigModel::value('index_slider2_image'));}?>)"></a>
            </li>
            <li>
                <a href="<?php if (isset($_COOKIE['sub_site_id']) && $_COOKIE['sub_site_id'] > 0){ echo Web_ConfigModel::value($_COOKIE['sub_site_id'].'index_live_link3');}else{echo Web_ConfigModel::value('index_live_link3');}?>" style="background-image: url(<?php if (isset($_COOKIE['sub_site_id'])  && $_COOKIE['sub_site_id'] > 0){echo Web_ConfigModel::value($_COOKIE['sub_site_id'].'index_slider_image3');}else{echo Web_ConfigModel::value('index_slider_image3', Web_ConfigModel::value('index_slider3_image'));}?>)"></a>
            </li>
            <li>
                <a href="<?php if (isset($_COOKIE['sub_site_id']) && $_COOKIE['sub_site_id'] > 0){ echo Web_ConfigModel::value($_COOKIE['sub_site_id'].'index_live_link4');}else{echo Web_ConfigModel::value('index_live_link4');}?>" style="background-image: url(<?php if (isset($_COOKIE['sub_site_id'])  && $_COOKIE['sub_site_id'] > 0){echo Web_ConfigModel::value($_COOKIE['sub_site_id'].'index_slider_image4');}else{echo Web_ConfigModel::value('index_slider_image4', Web_ConfigModel::value('index_slider4_image'));}?>)"></a>
            </li>
            <li>
                <a href="<?php if (isset($_COOKIE['sub_site_id']) && $_COOKIE['sub_site_id'] > 0){ echo Web_ConfigModel::value($_COOKIE['sub_site_id'].'index_live_link5');}else{echo Web_ConfigModel::value('index_live_link5');}?>" style="background-image: url(<?php if (isset($_COOKIE['sub_site_id'])  && $_COOKIE['sub_site_id'] > 0){echo Web_ConfigModel::value($_COOKIE['sub_site_id'].'index_slider_image5');}else{echo Web_ConfigModel::value('index_slider_image5', Web_ConfigModel::value('index_slider5_image'));}?>)"></a>
            </li>
        </ul>
        <script type="text/javascript">
            jQuery(".slideBox").slide({mainCell:".bd ul",autoPlay:true,delayTime:3000});
        </script>
    </div>
</div>
<div class="wrap">
    <?php if(Web_ConfigModel::value('scarebuy_allow')){ ?>
        <div class="scare"></div>
    <?php } ?>

    <div class="section-module">
        <div class="uint-module">
            <div class="line">
                <?php foreach ($adv_index_1 as $key=>$value){ ?>
                    <a href="<?=$value['url']?>" target="_blank">
                        <img src="<?=$value['pic_url']?>" alt="">
                    </a>
                <?php }?>
            </div>
            <div class="line line-middle">
                <?php foreach ($adv_index_2 as $key=>$value){ ?>
                    <a href="<?=$value['url']?>" target="_blank">
                        <img src="<?=$value['pic_url']?>" alt="">
                    </a>
                <?php }?>
            </div>
            <div class="line">
                <?php foreach ($adv_index_3 as $key=>$value){ ?>
                    <a href="<?=$value['url']?>" target="_blank">
                        <img src="<?=$value['pic_url']?>" alt="">
                    </a>
                <?php }?>
            </div>
        </div>
        <div class="ranking-module">
            <nav class="ranking-nav">
                <div class="lf ranking">
                    <span>排行榜</span>
                </div>
                <ul class="ranking-list lf">
                    <?php foreach($search as $key => $val){ ?>
                        <li class="ranking-list-item lf">
                            <a href="javascript:;" data-id="<?=$key?>" data-key="<?=$val['search_keyword']?>"><?=$val['search_keyword']?></a>
                        </li>
                    <?php } ?>
                </ul>
                <div class="rt enter_w">
                    <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Top&met=index" target="_blank">进入你的世界>></a>
                </div>
            </nav>
            <div class="part-tab-content">
                <?php foreach($search as $key => $val){ ?>
                    <ul class="part-tab-list orflow">加载中...</ul>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="wrap floor fn-clear">
        <?php if(!empty($adv_list['items'])){foreach ($adv_list['items'] as $key => $value) { ?>
            <?=str_replace('src=',' class="lazy" data-original=',$value['page_html'])?>
        <?php } }?>
    </div>
</div>
<div class="J_f J_lift lift" id="lift">
    <ul class="lift_list  aad">
        <li class="J_lift_item_top lift_item lift_item_top">
            <a href="javascript:;" class="lift_btn">
                <span class="lift_btn_txt">顶部<i class="lift_btn_arrow"></i></span>
            </a>
        </li>
    </ul>
</div>
<script>
    $(function () {
        <?php if(Web_ConfigModel::value('scarebuy_allow')){ ?>
            $('.scare').load('<?=YLB_Registry::get('url')?>?ctl=ScareBuy&met=getIndexScareBuy');
        <?php } ?>

        //首次加载
        $(".part-tab-content .part-tab-list").eq(0).addClass("block");
        var key = $(".ranking-list .ranking-list-item a").eq(0).data('key');
        $(".part-tab-content .part-tab-list").eq(0).load('<?=YLB_Registry::get('url')?>?ctl=Index&met=getRankingList',{'key':key});

        //点击切换
        $(".ranking-list .ranking-list-item a").click(function(){
            var index = $(this).parent(".ranking-list-item").index();
            var key = $(this).data('key');

            if($(".part-tab-content .part-tab-list").eq(index).hasClass('loaded')){
                $(".part-tab-content .part-tab-list.block").removeClass("block");
                $(".part-tab-content .part-tab-list").eq(index).addClass("block");
            }else{
                $(".part-tab-content .part-tab-list").eq(index).load('index.php?ctl=Index&met=getRankingList',{'key':key},function () {
                    $(".part-tab-content .part-tab-list.block").removeClass("block");
                    $(".part-tab-content .part-tab-list").eq(index).addClass("block");
                    $(".part-tab-content .part-tab-list").eq(index).addClass("loaded");
                });
            }
        });

        //遍历导航楼层
        var atrf = [];
        var len = $(".floor .m").length;
        for (var mm = 0; mm < len; mm++) {
            var str = $(".floor .m .title").eq(mm).text();
            atrf.push(str);
        }
        var lis = "";
        $(atrf).each(function (i, n) {
            lis += '<li class="J_lift_item lift_item lift_item_first"><a class="lift_btn"><span class="lift_btn_txt">' + n + '</span></a></li>';
        });
        $(".lift_list").prepend(lis);

        //.publicss  块
        //.J_lift_item 左导航
        var b;
        $(".lift_list .J_lift_item").click(function () {
            b = $(this).index();
            $(".J_lift_item").removeClass("reds");
            $(this).addClass("reds");
            //离顶部距离
            var offsettop = $(".floor .m").eq(b).offset().top;
            //滚动轴距离
            var scrolltop = document.body.scrollTop | document.documentElement.scrollTop;
            scrolltop(
                $("html,body").stop().animate({
                    scrollTop: offsettop
                }, 1000));
        });
        //返回顶部
        $(".lift_item_top").click(function () {
            $('html,body').animate({
                scrollTop: '0px'
            }, 800);
        });
        //滚动楼层对应切换左侧楼层导航
        var le = $(".floor .m").length;
        var arr = [];
        for (var s = 0; s < le; s++) {
            var nums = $(".floor .m").eq(s).offset().top;
            arr.push(nums);
        }
        $(window).scroll(function () {
            //滚动轴
            var CTop = document.documentElement.scrollTop || document.body.scrollTop;
            var floorone=$(".floor .m").eq(0).offset().top;
            //当滚动轴到达楼层一时，左菜单栏显示
            if (CTop >= floorone) {
                $("#lift").show(500);
            } else {
                $("#lift").hide(500);
            }

            var scrTop = $(window).scrollTop();
            for (var w = 0; w < arr.length; w++) {
                var cc = arr[w + 1] || 1111111111;
                if (scrTop >= arr[w] && scrTop <= cc) {
                    if (arr[w + 1] < 0) {
                        w = w + 1;
                    }
                    $(".J_lift_item").removeClass("reds");
                    $(".J_lift_item").eq(w).addClass("reds");
                }
            }
        });

        $("img.lazy").lazyload({skip_invisible : false,placeholder : "<?= $this->view->img ?>/grey.gif",threshold: 200,effect: "show",failurelimit : 2});
    })
</script>
<?php include $this->view->getTplPath() . '/' . 'footer.php'; ?>