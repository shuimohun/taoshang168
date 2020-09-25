<!doctype html>
<html lang="zh-cmn-Hans-CN">
<head>
    <meta charset="utf-8"/>
    <meta name="renderer" content="webkit"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <meta name="applicable-device" content="pc,mobile">
    <meta name="MobileOptimized" content="width"/>
    <meta name="HandheldFriendly" content="true"/>
    <META name="filetype" content="1">
    <META name="publishedtype" content="1">
    <META name="pagetype" content="2">
    <META name="catalogs" content="toutiao_PC">
    <link href="/assets/images/favicon.ico" type="image/x-icon" rel="icon"/>
    <title>评论_淘尚168头条</title>
    <meta name="keywords" content=""/>
    <link rel="stylesheet" href="<?= $this->view->css ?>/reset_v4.css">
    <link rel="stylesheet" href="<?= $this->view->css ?>/dsp_ad.css">
    <link rel="stylesheet" href="<?= $this->view->css ?>/detail_v3.css">


    <style>
        .ave_20170908 {
            border-bottom: 1px solid #ececec;
        }
        .back_to_top{
            position: fixed;
            bottom:30px;
            right: 30px;
            border:1px solid #888;
        }
        .ave_20170908 .ave_items {
            width: 100%;
            height: auto;
            overflow: hidden;
            *zoom: 1;
            line-height: 45px;
            font-size: 14px;
            padding-left: 10px;
        }

        .ave_20170908 .ave_items .ave_item {
            float: left;
            width: 290px;
            height: 45px;
            position: relative;
        }

        .ave_20170908 .ave_items .ave_item span {
            position: absolute;
            left: 45px;
            top: 22px;
            width: 3px;
            height: 3px;
            border-radius: 50%;
            background-color: #ec4b4b;
        }

        .ave_20170908 .ave_items .ave_item a {
            display: block;
            width: 245px;
            padding-left: 55px;
            height: 100%;
            color: #333;
        }

        .ave_20170908 .ave_items .ave_item a:hover {
            color: #ec4b4b;
        }

        .header-right .dfh-entry span {
            width: auto !important;
        }

        @media screen and (min-width: 1440px) {
            .ave_20170908 .ave_items .ave_item {
                width: 260px;
            }
        }
        .app-download:hover .download-QRcode{
             width: 162px;
             height: 162px;
             background:url('<?= $this->view->img ?>/down_app.png')
         }
        .submit{
            background:url('<?= $this->view->img ?>/search_news.png') no-repeat center center !important;
        }

    </style>
</head>
<body>
<?php
//var_dump($data6);
//var_dump($data5['article_reply_parent_id']);
?>
<div class="header_cnt_detail clear-fix">
    <div class="header-left">
<!--        <div class="logo"><a href="/" target="_blank" pdata="comment|nav|0|0"></a></div>-->
        <ul class="nav"  style="margin-left:270px;">
            <?php  foreach ($Navbar1 as $key => $data):   ?>
            <li><a href="<?= YLB_Registry::get('url') . '?ctl=News&met=index&id=' ?><?= $data['information_group_id'] ?>" updata=""
                   target="_blank"><?= $data['information_group_title'] ?></a></li>
            <?php  endforeach;   ?>

        </ul>
        <div class="nav-more-btn">
            <div class="more-icon"><img src="<?= $this->view->img ?>/tem222.png" style="position: absolute;top: 12px;" alt=""></div>

            <ul class="more-nav">

                <?php  foreach ($Navbar2 as $key => $data):   ?>
                <li class="narrow-show" style="display: block"><a href="<?= YLB_Registry::get('url') . '?ctl=News&met=index&id=' ?><?= $data['information_group_id'] ?>" target="_blank" pdata=""><?= $data['information_group_title'] ?></a></li>
                <?php  endforeach;   ?>
            </ul>
        </div>
    </div>
    <div class="header-right" >
        <div class="search-box">
<!--            <form action="?ctl=News&met=search" target="_blank">-->
                <input id="bdcsMain" class="txt" type="text" value="" name="kw">
                <a id="search_btn" class="submit png-fixIe6" target="_blank"
                   ></a>
<!--            </form>-->
        </div>
        <div class="app-download">
            <span><i></i>客户端下载</span>
            <div class="download-QRcode"></div>
        </div>
        <div class="dfh-entry">
            <a href="<?= YLB_Registry::get('url') ?>" target="_blank"><span><i></i>淘尚168商城</span></a>
        </div>
        <?php  if (Perm::$userId == 0) :      ?>
            <div class="login-box">
                <a href="<?= YLB_Registry::get('url') . '?ctl=login&met=index' ?>"><span class="login-btn">  登录</span></a>
            </div>
        <?php endif;?>
    </div>
    <script type="text/javascript" src="<?= $this->view->js ?>/jquery-1.11.3.min.js"></script>
    <script>
        $('.nav-more-btn').mousemove(function () {
            $('.nav-more-btn img').attr("src","<?= $this->view->img ?>/tem111.png");
        })
        $('.nav-more-btn').mouseout(function () {
            $('.nav-more-btn img').attr("src","<?= $this->view->img ?>/tem222.png");
        })
    </script>

</div>




<div class='section' style="padding-top:68px;min-height: 1000px;">
    <div class="detail_cnt clear-fix">
        <div class='main_content'>
            <div class='aside'>
                <div class="detail_right_cnt clear-fix">
                    <div class="xfcnt_lft clear-fix">
                        <div class="channel_ybq_x gg_detail_baidu clear-fix gg_right2" id="right2"  style="padding: 10px 10px 20px;width: 300px;">
                            <!-- 广告位：测试_嵩恒_头条_新闻页面_右2 -->

                        </div>
                        <div class="main_r_title"  style="margin-top: 0 ">
                            <h4><span><em></em>热门推荐</span></h4>
                        </div>
                        <div class="main_item_cnt">
                            <ul id='hot_daily' class="sift_item">
                                    <?php   foreach ($fake_read['items'] as $key => $data):     ?>
                                <li>
                                    <a title="<?= ($data['information_title']) ?>"
                                       href="<?= YLB_Registry::get('url') . '?ctl=News&met=detail&id=' ?><?= ($data['information_id']) ?>"
                                       pdata="comment|hotdaily|0|0" target="_blank" class="news_pic">
                                            <span><img class="animation scrollLoading" src="<?= ($data['information_pic']) ?>" alt="<?= ($data['information_title']) ?>"
                                                       alt="<?= ($data['information_title']) ?>"></span>
                                        <p><?= ($data['information_title']) ?></p>
                                    </a>
                                </li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom_over_cnt" data-id="<?= ($detail['information_id']) ?>">
                <h1 class="comment_specialized">
                    <a href="<?= YLB_Registry::get('url') . '?ctl=News&met=detail&id=' ?><?= ($detail['information_id']) ?>"> <?= ($detail['information_title']) ?></a>
                </h1>
                <div id="discuss_box" class="sofa-show"><!-- 弹框 -->
                    <h4 class="comment-title">
                        <p class="comment-logo"></p>
                        <a href="<?= YLB_Registry::get('url') . '?ctl=News&met=comment&id=' ?><?= ($detail['information_id']) ?>" class="no_hover_num" ><span id="comment_num"><?=$rely_count ?></span>条评论</a>
                    </h4>
                    <div class="comment-input clearfix">
                        <input  class="open_login"  type="text"  placeholder="请输入评论"/>
                        <button  class="send-comment dis" id="button" data-id="<?= ($detail['information_id']) ?>">发送评论</button>
<!--                        <div class="go-login open_login" style="">请<a id="comment-login" href="javascript:void (0)">&nbsp;登录&nbsp;</a>后发表评论-->
<!--                        </div>-->
                    </div>
<!--                    <div class="hot-user-comment">-->
<!--                        <h5><span>热门评论</span></h5>-->
<!--                    </div>-->
<!--                    <div class="hotcomment-no-more">-->
<!--                        <div class="bg"></div>-->
<!--                        <p>期待您的热评</p></div>-->
                    <div class="user-comment">
                        <h5><span>最新评论</span></h5>

                        <div class="comment-box">

                            <?php   foreach ($rely_row['items'] as $key => $value): ?>
                                <div class="J_boundary" >
                                    <div class="box-top"><img src="<?= ($value['user_logo'])?>" class="comment-head" alt="">
                                        <div class="name-and-time"><span class="comment-name"><?= ($value['user_name']) ?> </span>
                                            <span class="comment-time"><?= ($value['article_reply_time'])?></span></div>
                                        <div class="comment-operation" data-id="<?= ($value['article_reply_id'])?>"  >
                                            <?php if($value['reply']):?>
                                                <a  href="javascript:void(0)"  data-id="<?= ($value['article_reply_id'])?>" data-id2 = "<?= ($value['information_id']) ?>" class="look-reply">查看回复</a>
                                            <?php endif;?>
                                            <a  href="javascript:void(0)" class="comment-reply">回复</a>
                                        </div>

                                    </div>
                                    <p class="box-bottom"><?= ($value['article_reply_content']) ?></p>
                                    <div class="comment-input clearfix reply" style="display: none;">
                                        <input  class="open_login" style="width: 668px;height: 50px" autocomplete="off" data-id="<?= ($value['article_reply_id'])?>" type="text"  placeholder="请输入回复"/>
                                        <button  class="send-comment send-reply dis" style="height: 52px" data-id="<?= ($value['information_id']) ?>" >发送回复</button>
                                    </div>
                                    <div class="abcdefg_ri" style="display: none;" >
                                        <?php foreach ($value['reply'] as $k => $v): ?>
                                            <div class="box-top"><img src="<?= ($v['user_logo'])?>" class="comment-head" alt="">
                                                <div class="name-and-time"><span class="comment-name"><?= ($v['user_name']) ?> </span>
                                                    <span class="comment-time"><?= ($v['article_reply_time'])?></span>
                                                </div>
                                                <div class="comment-operation" data-id="<?= ($v['user_id'])?>"  >
                                                </div>
                                            </div>
                                            <p class="box-bottom"><?= ($v['article_reply_content']) ?></p>
                                        <?php endforeach;?>
                                    </div>
                                </div>
                            <?php endforeach;  ?>

                            <div class="second-comment">
                                <button type="button" style="display: none;" class="more-reply">查看更多回复</button>
                            </div>
                        </div>
                    </div>
                    <div class="comment-no-more">
                        <p id="J_more_status">没有更多评论</p>
                    </div>
                    <div class="comment-more" data-type="comment">更多评论</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="J_comment_mobal_box"></div>

<!--<div id="J_report_mask">-->
<!--    <div id="J_report" class="report-box ie_fixed">-->
<!--        <p>举报</p>-->
<!--        <span>举报原因:</span>-->
<!--        <div class="report-close"></div>-->
<!--        <ul>-->
<!--            <li class="action"><i></i><span>广告营销</span></li>-->
<!--            <li><i></i><span>地域攻击</span></li>-->
<!--            <li><i></i><span>色情低俗</span></li>-->
<!--            <li><i></i><span>人身攻击</span></li>-->
<!--            <li><i></i><span>诈骗骚扰</span></li>-->
<!--            <li><i></i><span>谣言</span></li>-->
<!--            <li><i></i><span>反动</span></li>-->
<!--            <li><i></i><span>其他</span></li>-->
<!--        </ul>-->
<!--        <div class="btn-group">-->
<!--            <button type="button" id="cancel_report">取消</button>-->
<!--            <button type="button" id="confirm_report">提交</button>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<div class="goto_top" style="display: none;">
    <a class="show_go_index" href="/?ycdh" target="_blank"></a>
    <a id='gotop_btn' class='show_go_0' href="javascript:;"></a>
    <!--	<a class='show_go_1' href="javascript:;"></a>-->
    <!--    <div class="erwei_cnt"></div>-->
    <a href="/?ycdh" target="_blank" class="red_point"></a>
</div>
<button class="back_to_top">返回顶部</button>

<div class='footerDetail'>
    <div class="wrapper">



        <p class="copyright">淘尚168商城版权及使用权归北京淘尚壹陆捌网络科技有限公司<br>
            京ICP备16049473号-1  经营许可证编号：京B2-20170597
        </p><div style="width:300px;margin:0 auto; padding-bottom:10px;text-align:center;">
            <a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=11010602100246" style="display:inline-block;text-decoration:none;height:20px;line-height:20px;"><img src="" style="float:left;"><p style="float:left;height:20px;line-height:20px;margin: 0px 0px 0px 5px; color:#939393;"><img style="margin-right:5px;" src="http://www.beian.gov.cn/img/ghs.png">京公网安备 11010602100246 号</p></a><p></p>
            <p class="statistics_code"></p>
        </div>
    </div>
</div>

<!--<script>-->
<!--$(".scrollLoading").scrollLoading();-->
<!--//鼠标放上去之后替换照片-->
<!--$('.special-item').hover(function () {-->
<!--var srcimg = $(this).find('.scrollLoading').attr('data-url');-->
<!--$(this).find('.scrollLoading').attr('src', srcimg);-->
<!--});-->
<!--</script>-->

<script type="text/javascript">

    var backButton=$('.back_to_top');
    function backToTop() {
        $('html,body').animate({
            scrollTop: 0
        }, 800);
    }
    backButton.on('click', backToTop);

    $(window).on('scroll', function () {/*当滚动条的垂直位置大于浏览器所能看到的页面的那部分的高度时，回到顶部按钮就显示 */
        if ($(window).scrollTop() > $(window).height())
            backButton.fadeIn();
        else
            backButton.fadeOut();
    });
    $(window).trigger('scroll');
</script>
<script type="text/javascript" src="<?= $this->view->js ?>/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="<?= $this->view->js ?>/layer/layer.js"></script>
<script>
// 回复
    $('.comment-reply').click(function () {
        $reply = $(this).parent().parent().parent().find('div').eq(3);
        $('.reply').attr('style','display:none');
        $reply.removeAttr('style');
//        console.log($reply.children("input").val());

    })
        $('.send-reply').click(function () {

            article_reply_id = $(this).prev().attr('data-id');
             article_id = ($('.bottom_over_cnt').attr('data-id'));
            text = $(this).parent().children("input").val();
            getReply();

        })
        function getReply() {

            $.post("index.php?ctl=News&met=replyComment&typ=json",{article_id:article_id,article_reply_id:article_reply_id,text:text}, function (r) {
                if(r.status == 200){
                    alert('回复成功！');
                    window.location.reload();
                }else if(r.status == 235){
                    var con = confirm('请登录账户后进行回复');
                    if (con == true){
//                    alert('登录');
                        window.location.replace('<?= YLB_Registry::get('url') . '?ctl=login&met=index' ?>');
                    }else{
//                        alert('停止');
//                    return false;
                    }
//                                 window.location.replace('<?//= YLB_Registry::get('url') . '?ctl=News&met=comment&id=' ?><!----><?//= ($detail['information_id']) ?>//');

                }else{
                    alert('回复失败，请重试！');
                    window.location.reload;
                }


            })
        }
//查看回复
    $('.look-reply').click(function () {
        $reply = $(this).parent().parent().parent().find('div').eq(4);
        article_reply_id = $(this).attr('data-id');
        article_id = $(this).attr('data-id2');
//        console.log($reply.html());
//        console.log(article_reply_id);
        if ($reply.attr('style')){
            $reply.removeAttr('style')
//            alert('有');
//            lookReply();
        }else{
          $reply.attr('style','display:none');
//            alert('un有');
        }
    })
function lookReply() {
//            var article_reply_id =<?//= ($data['article_reply_id'])?>//;
//    var article_id = <?//= ($detail['information_id']) ?>//;
    $.post("index.php?ctl=News&met=lookComment&typ=json",{article_id:article_id,article_reply_id:article_reply_id}, function (r) {
        if(r.status == 200){
            alert('回复成功！');
                    window.location.replace('<?= YLB_Registry::get('url') . '?ctl=News&met=comment&id=' ?><!----><?= ($detail['information_id']) ?>');
        }else if(r.status == 235){
            alert('请登录账户后进行回复');
                                 window.location.replace('<?= YLB_Registry::get('url') . '?ctl=News&met=comment&id=' ?><!----><?= ($detail['information_id']) ?>');

        }else{
            alert('回复失败，请重试！');
            window.location.reload;
        }


    })
}

//评论
    $('#button').click(function () {

        id = $(this).attr('data-id');

        var text = $(":text").eq(1).val();
        if(text.length<5){
           alert('请输入至少5个字符！已输入'+text.length+'个字符');
            return false;
        }

        getData();
    });

    //
    function getData() {
        var text = $(":text").eq(1).val();
        $.post("index.php?ctl=News&met=addComment&typ=json",{id:id,text:text}, function (r) {
            if(r.status == 240){
                alert(r.msg);
            }
            if(r.status == 200){
                alert('评论成功！');
                window.location.replace('<?= YLB_Registry::get('url') . '?ctl=News&met=comment&id=' ?>'+id);
            }else if(r.status == 235){
               var con = confirm('请登录账户后进行评论');
                if (con == true){
                         window.location.replace('<?= YLB_Registry::get('url') . '?ctl=login&met=index' ?>');
                }else{
                    alert('停止');
                }

            }else{
                alert('评论失败，请重试！');
                window.location.reload;
            }


        })
    }
//搜索
    $('#search_btn').click(function () {
        var text = $(":text").eq(0).val();
        window.location.replace('<?= YLB_Registry::get('url') . '?ctl=News&met=search&text=' ?>'+text);
    })
</script>
<!--<div style="display: none;">-->
<!--    <script>-->
<!--        top_left();-->
<!--    </script>-->
<!--</div>-->
<!--[if lte IE 7]>
<script>
    $('#gotop_btn').find('.erwei_cnt').append("<img src='/assets/images/2codes.png'>");
    $('a.show_go_1').on('mouseenter', function () {
        $(this).siblings('.erwei_cnt').css({'display': 'block', 'filter': 'alpha(opacity=100)'});
    });
    $('a.show_go_1').on('mouseleave', function () {
        $(this).siblings('.erwei_cnt').css({'display': 'none', 'filter': 'alpha(opacity=0)'});
    });
</script>
<![endif]-->
<div style="display:none;">

</div>
<!-- 右下悬浮广告 -->
<div id="dsp_yxxf" class="gg_dsp_dl dsp_yxxf">
    <!--<script type="text/javascript">dsp_you_xia_xuan_fu();</script>-->
</div>
</body>
</html>