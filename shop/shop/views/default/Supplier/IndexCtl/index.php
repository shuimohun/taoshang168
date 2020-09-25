
<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'supplier_header.php';
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
                <a href="<?php echo Web_ConfigModel::value('supplier_index_link1');?>"><img src="<?php echo Web_ConfigModel::value('supplier_index_image1');?>"/></a>
            </li>
            <li>
                <a href="<?php echo Web_ConfigModel::value('supplier_index_link2');?>"><img src="<?php echo Web_ConfigModel::value('supplier_index_image2');?>"/></a>
            </li>
            <li>
                <a href="<?php echo Web_ConfigModel::value('supplier_index_link3');?>"><img src="<?php echo Web_ConfigModel::value('supplier_index_image3');?>"/></a>
            </li>
            <li>
                <a href="<?php echo Web_ConfigModel::value('supplier_index_link4');?>"><img src="<?php echo Web_ConfigModel::value('supplier_index_image4');?>"/></a>
            </li>
            <li>
                <a href="<?php echo Web_ConfigModel::value('supplier_index_link5');?>"><img src="<?php echo Web_ConfigModel::value('supplier_index_image5');?>"/></a>
            </li>
        </ul>
        <script type="text/javascript">
            jQuery(".slideBox").slide({mainCell:".bd ul",autoPlay:true,delayTime:3000});
        </script>
    </div>
</div>
<div class="wrap">
    <div class="wrap floor fn-clear">
        <?php if(!empty($adv_list['items'])){ foreach ($adv_list['items'] as $key => $value) { ?>
            <?=$value['page_html']?>
        <?php } }?>
    </div>
</div>
<div class="J_f J_lift lift" id="lift" style="left: 42.5px; top: 134px;">
    <ul class="lift_list  aad">
        <li class="J_lift_item_top lift_item lift_item_top">
            <a href="javascript:;" class="lift_btn">
                    <span class="lift_btn_txt">顶部<i class="lift_btn_arrow">
        </i></span>
            </a>
        </li>
    </ul>
</div>
<script>
    $(function () {

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

        $(window).scroll(function () {
            //滚动轴
            var CTop = document.documentElement.scrollTop || document.body.scrollTop;
            //当滚动轴到达1700，左菜单栏显示
            if (CTop >= 1500) {
                $("#lift").show(500);
            } else {
                $("#lift").hide(500);
            }
        });
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
        })
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
    })
</script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
