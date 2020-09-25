<!DOCTYPE html>
<html lang="zh-cmn-Hans-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <meta name="applicable-device" content="pc,mobile">
    <meta name="MobileOptimized" content="width">
    <meta name="HandheldFriendly" content="true">
    <meta name="filetype" content="1">
    <meta name="publishedtype" content="1">
    <meta name="pagetype" content="2">
    <meta name="catalogs" content="toutiao_PC">

    <title><?= ($detail['information_title']) ?>_淘尚168头条</title>
    <link rel="stylesheet" href="<?= $this->view->css ?>/reset_v4.css">
    <link rel="stylesheet" href="<?= $this->view->css ?>/dsp_ad.css">
    <link rel="stylesheet" href="<?= $this->view->css ?>/detail_v3.css">

<style>
.goods_list{ width: 860px; margin: 10px 0; overflow: hidden;}
.goods_title{ font-size: 20px; font-weight: lighter; color:#ec4b4b; margin-bottom: 15px;}
.goods_list ul li{ width: 199px; box-sizing: border-box;border:1px solid #eee; float: left; font-size: 20px; font-weight: lighter;color:#ec4b4b; padding: 8px; overflow: hidden; margin: 0 8px;}
.goods_list ul li:hover{ transition: 1s all ease; border-box;border:1px solid #ec4b4b; box-shadow:0px 0px 10px rgba(0,0,0,0.5);}
.goods_list ul li:hover .goods_img img{
         transition: 1s all ease;
        transform:scale(1.2);
        -ms-transform:scale(1.2);
        -webkit-transform:scale(1.2);
        -o-transform:scale(1.2);
        -moz-transform:scale(1.2);}
.goods_list ul li .goods_img{width: 180px; height: 180px; overflow: hidden;}
.goods_list ul li .goods_img img{width: 180px; height: 180px;}
.goods_list ul li .goods_text{}
.goods_list ul li .goods_text .goods_des{ height: 40px; line-height: 20px; overflow: hidden; font-size: 12px; color: #333;}
.goods_list ul li .goods_text .goods_price{ text-align: right;}

</style>





</head>
<body>
<div id="BAIDU_DUP_fp_wrapper"
     style="position: absolute; left: -1px; bottom: -1px; z-index: 0; width: 0px; height: 0px; overflow: hidden; visibility: hidden; display: none;"></div>
<div class="channel_ybq_x gg_right7" id="gg_right7">
    <!-- 广告位：嵩恒_头条_新闻页面_右7 -->
    <ins id="ac_js86_mm_118281833_16154146_67774730" style="display: none;"></ins>
    <script></script>
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
        .ave_20170908 .ave_items .ave_item img {
            width:20px;
            height:20px;
            margin-left:16px;
            margin-top:-8px;
            vertical-align:middle;

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

        }

    </style>

</div>
<div class="DSP_IFRAME" style="display:none;"></div>

<!--头部-->
<div class="header_cnt_detail clear-fix">
    <div class="header-left header-left-news">
<!--        <div class="logo"><a href="javascript:;" target="_blank" pdata="detail|nav|0|0"></a></div>-->
        <ul class="nav" style="margin-left:270px;">
            <?php  foreach ($Navbar1 as $key => $data):   ?>
            <li><a href="<?= YLB_Registry::get('url') . '?ctl=News&met=index&id=' ?><?= $data['information_group_id'] ?>" updata="detail|nav|1|0" target="_blank"><?= $data['information_group_title'] ?></a></li>
            <?php  endforeach;   ?>
        </ul>
        <div class="nav-more-btn">
            <div class="more-icon"><img src="<?= $this->view->img ?>/tem222.png" style="position: absolute;top: 12px;" alt=""></div>
            <ul class="more-nav">
                <?php foreach ($Navbar2 as $key => $data): ?>
                <li><a href="<?= YLB_Registry::get('url') . '?ctl=News&met=index&id=' ?><?= $data['information_group_id'] ?>" target="_blank" pdata="detail|nav|8|0"><?= $data['information_group_title'] ?></a></li>
                <?php endforeach;               ?>
            </ul>
        </div>
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
    <div class="header-right">
<!--        搜索框-->
        <div class="search-box">
            <form action="" target="_blank">
                <input id="bdcsMain" class="txt" type="text" value="" name="kw">
                <a id="search_btn" class="submit png-fixIe6" target="_blank"
                   ></a>
            </form>


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
</div>


<!--头部 end-->



<div id="J_detail_modal_box" class="J_modal_box"></div>
<div id="J_comment_mobal_box"></div>

<div class="gg_cnt gg_cnt_detail">
    <div class="gg_cnt_contain">
        <div class="bigscreen_log">
            <a href="" pdata="detail|wz|0|0" target="_blank">
                <span class="gg_cut_logo">头条看世界</span>
            </a>
        </div>
        <div class="gg_cnt_lrs">
            <div class="gg_cnt_left">
                <div class="detail_position">
                    <a href="<?= YLB_Registry::get('url') . '?ctl=News&met=index' ?>" pdata="detail|wz|0|0" target="_blank">淘尚168头条</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<?= ($detail['information_title']) ?>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="section">
    <div class="detail_cnt clear-fix">
        <div class="recommend">
            <div class="detail_recommend" id="recommend">
            </div>
        </div>
        <div class="main_content">
            <div class="article">
                <div class="detail_left  clear-fix">
                    <div class="detail_left_cnt">
                        <div class="J-title_detail title_detail">     <?= ($islike)?>
                            <h1><span><?= ($detail['information_title']) ?></span></h1>
                            <div class="share_cnt_p clearfix">
                                <div class="fl">
                                    <i><?= ($detail['information_add_time']) ?></i>
                                    <a href=""
                                       pdata="detail|from|0|0" target="_blank">                            <?= ($detail['information_writer']) ?>
                                    </a>
                                </div>
                                <div class="user_error_op fr"><i></i><span id="j_user_op">我要报错</span></div>


                            </div>
                        </div>
                        <div class="gg_detail_cnt clearfix" id="dsp_btxf"></div>
                        <div class="ave_20170908">
                            <ul class="ave_items">
                              <li class="ave_item" style="width:600px;height:45px;" >  </li>
                                <li class="ave_item"  id="like" style="width:auto;height:55px; margin-right:10px;">
                                    <?php if ($iflike): ?>
                                    <img src="<?= $this->view->img?>/like.png" alt=""><i style="margin-left: 2px;"><?= $howLike?></i>
                                    <?php else: ?>
                                    <img src="<?= $this->view->img?>/unlike.png" alt=""><i style="margin-left: 2px;"><?= $howLike?></i>
                                    <?php endif; ?>

                <li>
            阅读量：<span style="color:red;font-weight:bold"><?= ($detail['information_fake_read_count']+$detail['information_read_count']) ?></span>
                                <a class="share" style="margin-left:15px">分享 </a>

            </li>
            </ul>
                        </div>
                        <div class="J-contain_detail_cnt contain_detail_cnt" id="J-contain_detail_cnt">
                            <?= ($detail['information_desc']) ?>
                        </div>
                    </div>

                    <div class="UPDATE `taoshangbbc`.`ylb_information_group` SET `information_group_parent_id`='0' WHERE (`information_group_id`='3');" id="dsp_left2">
                        <!-- 广告位：嵩恒_头条_新闻页面_正文下方 该位置的dsp已经下掉-->

                        <div id="_nkc4csh3awd" style="width: 100%;">
                            <div class="erfxtqazwry" style="width:0px;height:0px;cursor:auto;"></div>
                            <em style="display:none;"></em></div>

                    </div>
                    <!-- <div class="dark-line"></div> -->

                </div>
            </div>
            <div class="aside">
                <div class="detail_right_cnt clear-fix">
                    <!-- xcp room -->
                    <div class="detail_room">

                    </div>
                    <div class="channel_ybq_x gg_channel_r_b_t gg_right1" id="right1" style="display: block;">
                    </div>
                    <div class="xfcnt_lft clear-fix">
                        <?php if(count($today_top['items'])>0):?>
                        <div class="main_r_title">
                            <h4><span><em></em>今日热点</span></h4>
                        </div>
                        <div class="main_item_cnt">
                            <ul id="hot_daily" class="sift_item">
                                <?php
                                 foreach ($today_top['items'] as $key => $data):
                                ?>
                                <li>
                                    <a title="<?= ($data['information_title'])  ?>" href="<?= YLB_Registry::get('url') . '?ctl=News&met=detail&id=' ?><?= ($data['information_id'])  ?>" pdata="detail|hotdaily|0|0"
                                       target="_blank" class="news_pic">
                                        <span><img class="animation scrollLoading"
                                                   src="<?= ($data['information_pic'])  ?>"
                                                   alt="<?= ($data['information_title'])  ?>"></span>
                                        <p><?= ($data['information_title'])  ?></p>
                                    </a>
                                </li>
                                <?php
                                endforeach;
                                ?>
                            </ul>
                        </div>
                        <?php                        endif; ?>
                        <div class="channel_ybq_x gg_detail_baidu clear-fix gg_right2" id="right2"
                             style="display: block;">
                        </div>
                        <div class="main_r_title" id="xbjx_title">
                            <h4><span><em></em>小编精选</span></h4>
                        </div>
                        <div class="main_item_cnt" id="unartificial">
<ul class="icp_items">
    <?php foreach ($data_command['items'] as $informaionkey => $informationval): ?>
    <li class="icp_item clearfix "><span
                class="icp_dot">|</span><a class="icp_dil" href="<?= YLB_Registry::get('url') . '?ctl=News&met=detail&id=' ?><?= ($informationval['information_id']) ?>"   updata="detail|xbjx|0|0" target="_blank" title="<?= ($informationval['information_title']) ?>"><?= ($informationval['information_title']) ?></a>
    </li>
    <?php endforeach; ?>

</ul>
                        </div>


<div class="channel_ybq_x gg_right6" id="avetest_right6" style="display: block;">
</div>

                 <div class="channel_ybq_x gg_right8" id="gg_right8">
                            <!-- 广告位：嵩恒-头条-新闻页面-右8 -->
                            <!-- 搜狗无阻iframe -->
                            <ins id="ac_js86_mm_118281833_16154146_142342348" style="display: none;"></ins>

                        </div>
                        <div class="channel_ybq_x gg_right9" id="avetest_right9" style="display: block;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom_over_cnt">
                <div class="gg_item_bomttom_cnt" id="gg_item_bomttom_cnt-bk">
                    <!-- 广告位：嵩恒_头条_新闻页面_分页下方 -->
                </div>
                <div class="ggPic_item_bomttom_cnt" id="ny_xypxf"></div>
                <!--评论-->
                <div id="discuss_box" class="detail-comment">
                    <div id="pinglun"></div>
                    <h4 class="comment-title">
                        <p class="comment-logo"></p>
                        <a target="_blank" pdata="detail|morecomment|0|0"
                           href="<?= YLB_Registry::get('url') . '?ctl=News&met=comment&id=' ?><?= ($detail['information_id']) ?>"><span
                                    id="comment_num"><?= $data5?></span>条评论</a>
                    </h4>
                    <div class="comment-input clearfix">
                        <input type="text" class="open_login" id="detail_comment"placeholder="请输入评论">
                        <button class="send-comment dis"  id="button">发送评论</button>
<!--                        <div class="go-login">请<a id="comment-login" class="open_login" href="javascript:void (0)">&nbsp;登录&nbsp;</a>后发表评论-->
<!--                        </div>-->
                    </div>
                    <a class="more-comment" target="_blank" pdata="detail|morecomment|1|0"
                       href="<?= YLB_Registry::get('url') . '?ctl=News&met=comment&id=' ?><?= ($detail['information_id']) ?>">点击进入
                        <span id="J_mc">更多跟帖</span></a>
                </div>
                <!--评论 end-->
                <!--商品推荐 2018-07-14  start-->
                <?php if($detail['goods'][0]['goods_id']):?>
                <div class="goods_list">
                    <h3 class="goods_title">为您优选</h3>
                    <ul class="clearfix">
                        <?php foreach ($detail['goods'] as $goods):?>
                        <li>
                            <div class="goods_img"><a href="<?= YLB_Registry::get('url') . '?ctl=Goods_Goods&met=goods&gid=' ?><?= ($goods['goods_id']) ?>"><img src="<?= $goods['goods_image'] ?>" alt=""></a></div>
                            <div class="goods_text">
                                <a href="<?= YLB_Registry::get('url') . '?ctl=Goods_Goods&met=goods&gid=' ?><?= ($goods['goods_id']) ?>"><p class="goods_des"><?=$goods['goods_name']?></p></a>
                                <p class="goods_price">￥<?=$goods['information_goods_price']?></p>
                            </div>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <?php endif;?>
                <!--商品推荐  2018-07-14 end-->
                <div class="guess_like  clear-fix bottom_cns">
                    <!-- xcp_v2 热门推荐宽窄 -->

                    <div class="hotrec_cns" id="hotrec_cns">
                        <div id="rmtj_title" class="guess_title hot-recommend"><span>热门推荐<i></i></span></div>
                        <div id="hot_recommend_cnt" class="hot_recommend_cnt clear-fix">
                            <!-- 当前栏目下推荐 -->
                            <!--xcp_v2 新闻15条 360广告3条 位置3条+1条广告+5条新闻+1条广告+7条新闻+1条广告-->
                            <ul class="tjnewsrcontent">
                                <?php   foreach ($fake_read['items'] as $key => $data):     ?>
                                <li class="recommend_news">
                                    <a class="red_news"
                                       href="<?= YLB_Registry::get('url') . '?ctl=News&met=detail&id=' ?><?= ($data['information_id']) ?>"
                                       pdata="detail|hottj_tuijian|5|0" target="_blank"
                                       title="<?= ($data['information_title']) ?>">
                                        <div class="pic">
                                            <img class="scrollLoading"
                                                 src="<?= ($data['information_pic']) ?>" alt="<?= ($data['information_title']) ?>">
                                        </div>
                                        <div class="text">
                                            <h3><?= ($data['information_title']) ?></h3>
                                            <p class="">
                                                <span>&nbsp;<?= ($data['information_writer'])?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= ($data['information_add_time'])?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 阅读量：<?= ($data['information_read_count'])+($data['information_fake_read_count'])?></span>
                                            </p>

                                        </div>
                                    </a>
                                </li>
                                <?php endforeach; ?>

                            </ul>
                        </div>
                        <div class="see_more"><a class="see_hf" href="<?= YLB_Registry::get('url') . '?ctl=News&met=index' ?>"
                                                 target="_blank"><span class="see_txt">查看更多精彩</span></a></div>


                        <!-- 新增的推广提示 -->
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

        <button class="back_to_top">返回顶部</button>
<!--分享立减 S-->
<div id="sharecover" style="display:none;">
    <span class="mask"></span>
</div>
<div id="code" style="height: 230px;">
    <div class="close">
        <span>分享</span>
        <a href="javascript:void(0)" id="closebt">
            <img src="<?= $this->view->img ?>/close.png">
        </a>
    </div>
    <div class="sharetxt">
        <p>我要分享到：</p>
        <div class="share_c">
            <div class="bdsharebuttonbox" data-tag="share_1">
                <div class="share_d">
                    <a class="bds_share bds_sqq " data-cmd="sqq"></a>
                    <p>QQ好友</p>
                    <p id="sqq"></p>
                </div>
                <div class="share_d"><a class="bds_share bds_qzone" data-cmd="qzone" ></a>
                    <p>QQ空间</p>
                    <p id="qzone"></p>
                </div>
                <div class="share_d"><a class="bds_share bds_weixin" data-cmd="weixin"></a>
                    <p>微信好友</p>
                    <p id="weixin"></p>
                </div>
                <div class="share_d"><a class="bds_share bds_weixin_timeline" data-cmd="weixin"></a>
                    <p>微信朋友圈</p>
                    <p id="weixin_timeline"></p>
                </div>
                <div class="share_d"><a class="bds_share bds_tsina" data-cmd="tsina"></a>
                    <p>新浪微博</p>
                    <p id="tsina"></p>
                </div>
                <div class="share_d more">
                    <a class="bds_more" ></a><p>更多</p>
                </div>
                <div class="share_more">
                    <div class="triangle-css3 transform ie-transform-filter"></div>
                    <div class="more_s">
                        <div class="mss"><a class="bds_douban" data-cmd="douban"></a><p>豆瓣</p></div>
                        <div class="mss"><a class="bds_kaixin001" data-cmd="kaixin001"></a><p>开心网</p></div>
                        <div class="mss"><a class="bds_ty" data-cmd="ty"></a><p>天涯</p></div>
                        <div class="mss"><a class="bds_huaban" data-cmd="huaban"></a><p>花瓣网</p></div>
                        <div class="mss"> <a class="bds_copy" data-cmd="copy"></a><p>复制链接</p></div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="share_xx"></div>
    </div>
</div>
<!--分享立减 E-->
            </body>

        <script type="text/javascript" src="<?= $this->view->js ?>/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/share.js" charset="utf-8"></script>

            <script>
//                添加cookie,避免重复阅读量
                abc = getCookie('read_id');
                information_url = window.location.href;
                information_url_index = information_url.indexOf('&id=');
                id = information_url.substr(information_url_index+4);
                if(!isNaN(id)) {
                    if (abc.indexOf(id)=='-1'){
                        abc += ',';
                        abc += id;
                        document.cookie = "read_id=" + abc;
                    }
                }
                    function getCookie(name){
                        var strcookie = document.cookie;//获取cookie字符串
                        var arrcookie = strcookie.split("; ");//分割
                        for ( var i = 0; i < arrcookie.length; i++) {
                            var arr = arrcookie[i].split("=");
                            if (arr[0] == name){
                                return arr[1];
                            }
                        }
                        return "";
                    }
//                添加cookie,避免重复阅读量
                //搜索
                $('#search_btn').click(function () {
                    var text = $(":text").eq(0).val();
                    window.location.replace('<?= YLB_Registry::get('url') . '?ctl=News&met=search&text=' ?>'+text);
                });
                $('#button').click(function () {
                    var text = $('.open_login').val();
                    if(text.length<5){
                        alert('请输入至少5个字符！已输入'+text.length+'个字符');
                        return false;
                    }
                    getData();
                });
                function getData() {
                    var text = $(":text").eq(1).val();
                    var id =<?= ($detail['information_id']) ?>;
                    $.post("index.php?ctl=News&met=addComment&typ=json",{id:id,text:text}, function (r) {
                    if(r.status == 240){
                        alert(r.msg);
                    }
                     if(r.status == 200){
                         alert('评论成功！');

                         window.location.replace('<?= YLB_Registry::get('url') . '?ctl=News&met=comment&id=' ?><?= ($detail['information_id']) ?>');
                     }else if(r.status == 235){
                         var con = confirm('请登录账户后进行评论');
                         if (con == true){
                             window.location.replace('<?= YLB_Registry::get('url') . '?ctl=login&met=index' ?>');
                         }else{
//                             alert('停止');
//                    return false;
                         }
//                                alert('请登录账户后进行评论');
//                         window.location.replace('<?//= YLB_Registry::get('url') . '?ctl=News&met=comment&id=' ?>//<!----><?//= ($detail['information_id']) ?>//');

                     } else {
                         alert('评论失败，请重试！');
                         window.location.reload;
                     }


                    })
                }
                function getLike() {
                    var id =<?= ($detail['information_id']) ?>;
                    $.post("index.php?ctl=News&met=getLike&typ=json",{id:id,from:'point'}, function (r) {

                     if(r.status == 250){
                         alert('请登录后再进行操作');
                     }
                    })
                }
                $('#like').click(function () {
                        $html = $(this).html();
                        if($html.indexOf('unlike') != -1) {
                            $(this).html(' <img src="<?= $this->view->img?>/like.png" alt=""><i style="margin-left: 2px;"><?= $howLike?></i>');
                            getLike();
                        }
                });
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
<!--分享-->
        <script>
            var url = '';
            var txt = '';
            var pic = '';
            var title = $('.title_detail h1 span').text();

            function SetShareUrl(cmd, config) {
                config.bdUrl = url;
                config.bdText = txt;
                config.bdPic = pic;
                return config;
            }
            window._bd_share_config = {
                common : {
                    onBeforeClick: SetShareUrl,
                    bdDesc : '淘尚168资讯"'+title+'"',
                },
                share : [{
                    "bdSize" : 24,
                    "bdCustomStyle":'<?= $this->view->css ?>/bdshare.css'
                }],
            }
            var share_type = 0;
            var share_id = 0;
            function share(t) {
                if(t.data('status')){
                    $('.share-layer').show();
                }
                var suid = <?php echo Perm::$userId;?>;
                if(t.data('type') == 0){
                    share_type = 0;
                    url = SITE_URL + "?ctl=Goods_Goods&met=goods&gid=" + t.data('id')+'&suid='+suid;
                }else if(t.data('type') == 1){
                    share_type = 1;
                    share_id = t.data('id');
                    url = SITE_URL + "?ctl=Goods_Goods&met=bundling&bid=" + t.data('id')+'&suid='+suid;
                }
                txt = "<?=$detail['information_title']?>";
                pic = t.data('pic');
                var share_all = new Array('sqq','qzone','weixin','weixin_timeline','tsina');
                var shared = '';
                $('#code').center();
                $('#sharecover').show();
                var top = document.body.scrollTop;
                $("#code").css({top:top+300})
                $('#code').fadeIn();
            }
            $(function () {
                $('.share').click(function() {
                    share($(this));
                });
                $('#closebt').click(function() {
                    $('#code').hide();
                    $('#sharecover').hide();
                });
                $('#sharecover').click(function() {
                    $('#code').hide();
                    $('#sharecover').hide();
                });
                var t;
                $('.more').hover(function () {
                    clearTimeout(t);
                    $('.share_more').fadeIn();
                });
                $('.share_more').hover(function () {
                    clearTimeout(t);
                });
                $('.more').mouseleave(function () {
                    t = setTimeout(function() {
                        $('.share_more').hide();
                    },100);
                });
                $('.share_more').mouseleave(function () {
                    t = setTimeout(function() {
                        $('.share_more').hide();
                    },100);
                });
                $('#code').hover(function () {
                    $('.share_more').hide();
                });
                jQuery.fn.center = function(loaded) {
                    var obj = this;
                    body_width = parseInt($(window).width());
                    body_height = parseInt($(window).height());
                    block_width = parseInt(obj.width());
                    block_height = parseInt(obj.height());

                    left_position = parseInt((body_width / 2) - (block_width / 2) + $(window).scrollLeft());
                    if (body_width < block_width) {
                        left_position = 0 + $(window).scrollLeft();
                    };

                    top_position = parseInt((body_height / 2) - (block_height / 2) + $(window).scrollTop());
                    if (body_height < block_height) {
                        top_position = 0 + $(window).scrollTop();
                    };

                    if (!loaded) {

                        obj.css({
                            'position': 'absolute'
                        });
                        obj.css({
                            'top': ($(window).height() - $('#code').height()) * 0.5,
                            'left': left_position
                        });
                        $(window).bind('resize', function() {
                            obj.center(!loaded);
                        });
                        $(window).bind('scroll', function() {
                            obj.center(!loaded);
                        });

                    } else {
                        obj.stop();
                        obj.css({
                            'position': 'absolute'
                        });
                        obj.animate({
                            'top': top_position
                        }, 200, 'linear');
                    }
                }
                $('.lj_xq').hover(function () {
                    $('.lj').fadeIn();
                    $('.ljl').css("display","block");
                }).mouseleave(function () {
                    $('.lj').fadeOut();
                    $('.ljl').fadeOut();
                });
                $('.lz_xq').hover(function () {
                    $('.lz').fadeIn();
                    $('.lzl').css("display","block");
                }).mouseleave(function () {
                    $('.lz').fadeOut();
                    $('.lzl').fadeOut();
                });
                var goods_id = Public.getQueryString("goods_id");
                var gid = Public.getQueryString("gid")?Public.getQueryString("gid"):goods_id;
                var cid = Public.getQueryString("cid");
                var suid = Public.getQueryString("suid");
                var from = Public.getQueryString("from");
                var type = Public.getQueryString("type");
                var hash = location.hash;
                if(suid > 0 && (gid > 0 || cid > 0) && (type=='app'||hash != "")){
                    $.ajax({
                        url: SITE_URL + "/index.php?ctl=Goods_Goods&met=actShare",
                        type: 'get',
                        dataType: 'json',
                        data:{'gid':gid,'cid':cid,'suid':suid,'hash':hash,'from':from,'type':type},
                        success: function(result) {

                        }
                    });
                }
                $('.bds_share').click(function(){
                    var parm = '';
                    if(share_type == 0){
                        parm = {'gid':gid,'cid':cid};
                    }else if(share_type == 1){
                        parm = {'bid':share_id};
                    }
                    $.ajax({
                        url:SITE_URL + "/index.php?ctl=Goods_Goods&met=addShare",
                        type:'get',
                        dataType:'json',
                        data:parm,
                        success:function (data) {
                        }
                    });
                });

            });

            /***
             继续分享
             */

            $(".share-layer .share-btns span.continue-share").click(function() {
                $(".share-layer").hide();
            })


            $(".goods_ranking ul li").on("mouseover", function() {
                var _this = $(this);
                _this.find(".selling_goods_img>span").show();
            })
            $(".goods_ranking ul li").on("mouseleave", function() {
                var _this = $(this);
                _this.find(".selling_goods_img>span").hide();
            })

        </script>
</html>
