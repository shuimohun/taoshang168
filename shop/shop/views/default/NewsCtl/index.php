<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="renderer" content="webkit">
    <!--<script src=""></script>-->


    <title>头条新闻_淘尚168头条</title>

    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="<?= $this->view->css ?>/base.min.css" rel="stylesheet">
    <link href="<?= $this->view->css ?>/index.min.css" rel="stylesheet">


    <style type="text/css">
        .header-right .dfh-entry span {
            width: auto !important;
        }
        .back_to_top{
            position: fixed;
            bottom:30px;
            right: 30px;
            border:1px solid #888;
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
<body style="overflow-x: hidden; min-height: 926px;">
<div id="BAIDU_DUP_fp_wrapper"
     style="position: absolute; left: -1px; bottom: -1px; z-index: 0; width: 0px; height: 0px; overflow: hidden; visibility: hidden; display: none;"></div>
<div class="header">
    <div class="container">
        <!--header 导航-->
        <ul class="header-left">
            <li data-type="toutiao" class="active "><a href="javascript:void(0);" id="recommand_news">推荐</a></li>
            <?php if (count($data) <= 5): ?>
                <?php foreach ($data as $informaionkey => $informationval): ?>
                    <li data-type="junshi"><a href="javascript:void(0);" class="channel-item data-type"
                                              data-id="<?= $informationval['information_group_id'] ?>"
                                              data-type="junshi"><?= ($informationval['information_group_title']) ?></a>
                    </li>
                <?php endforeach; ?>
            <?php endif ?>

            <?php foreach ($data1 as $informaionkey => $informationval): ?>
                <li data-type="junshi" id="lideli"><a href="javascript:void(0);"
                                                      data-id="<?= $informationval['information_group_id'] ?>"
                                                      class="data-type"><?= ($informationval['information_group_title']) ?></a>
                </li>
            <?php endforeach; ?>
            <li class="nav-more">
                <a href="javascript:void(0); ">更多</a>
                <ol class="more-box">
                    <?php foreach ($data2 as $informaionkey => $informationval): ?>
                        <li data-type="keji"><a href="javascript:void(0);"
                                                data-id="<?= $informationval['information_group_id'] ?>"
                                                class="data-type"><?= ($informationval['information_group_title']) ?></a>
                        </li>
                    <?php endforeach; ?>

                </ol>
            </li>

        </ul>


        <div class="header-right">
            <div class="search-box">
                <form action="www.taos168.com/" target="_blank">
                    <input id="bdcsMain" class="txt" type="text" value="" placeholder="淘尚168头条新闻搜索" name="kw">
                    <a id="search_btn" class="submit png-fixIe6" target="_blank"></a>
                </form>
            </div>
            <div class="app-download">
                <span><i></i>客户端下载</span>
                <div class="download-QRcode" ></div>
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
</div>
<div class="index">
    <div class="bui-box main container">
        <a href="<?= $left_url['config_value']?>"> <div class="bg-wall wall-left"   style="background-image: url(<?= ($left['config_value'])?>);"></div></a>
        <a href="<?= $right_url['config_value']?>"> <div class="bg-wall wall-right"  style="background-image: url(<?= ($right['config_value'])?>);"></div></a>
        <div class="header-right index-app-dfh">
            <div class="app-download">
                <span><i></i>客户端下载</span>
                <div class="download-QRcode"></div>
            </div>
            <div class="dfh-entry">
                <a href="<?= YLB_Registry::get('url') ?>" target="_blank"><span><i></i>淘尚168商城</span></a>
            </div>
        </div>
        <div class="bui-left index-channel">
            <div class="channel" id="index-channel">
                <a href="" class="" id="logo">
                    <img src="<?= $this->view->img ?>/toutiao_logo.png" alt="" style="width: 193px;height: 48px;">
                </a>
                <!--侧栏导航-->
                <ul id="channel">
                    <li>
                        <a href="javascript:void(0);" class="channel-item active data-type" id="command_news" data-type="toutiao">
                            <span><i class="nav-icon toutiao"></i><b>推荐</b></span>
                        </a>
                    </li>
                    <?php foreach ($data as $informaionkey => $informationval): ?>
                        <li>
                            <a href="javascript:void(0);" class="channel-item data-type"
                               data-id="<?= $informationval['information_group_id'] ?>" data-type="junshi">

                                <span><i class="nav-icon junshi"></i><b><?= ($informationval['information_group_title']) ?></b></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="p-links-o" id="p-links-o" style="display: none;">
            <div class="p-links" id="p-links">
                <a href="javascript:void(0);" data-type="vtuijian" class="active">推荐</a>
                <a href="javascript:void(0);" data-type="vyule">娱乐</a>
                <a href="javascript:void(0);" data-type="vpaike">拍客</a>
                <a href="javascript:void(0);" data-type="vshenghuo">生活</a>
                <a href="javascript:void(0);" data-type="vzixun">资讯</a>
                <a href="javascript:void(0);" data-type="vqiche">汽车</a>
            </div>
        </div>
        <div class="bui-left index-content" id="index-content">

            <div class="bui-box slide clearfix" id="slide" style="display: block;">
                <?php
                   if($index_video) {
                       ?>

                       <ul class="slide-list bui-left" style="width: 670px" id="slide-list">

                           <li class="slide-item  slide-item-active">
                               <a pdata="index_hot|lunbo|1|1" target="_blank" href="<?= YLB_Registry::get('url') . '?ctl=News&met=detail&id=' ?><?= ($index_video['information_id']) ?>">
                                   <img alt=""
                                        src="<?= ($index_video["information_pic"]) ?>">
                                   <p class="title"><?= ($index_video["user_name"]) ?></p>
                               </a></li>

                       </ul>
                       <?php
                   }
                ?>

            </div>


<!--            首页视频-->
            <div id="add"></div>
            <div class="feed-infinite-wrapper">
                <div class="loading ball-pulse" id="loading-pulse">
                    <div></div>
                    <div></div>
                    <div></div>
                    <span>推荐中⋅⋅⋅</span>
                </div>
                <div id="msgAlert">
                    <div class="msg-alert msg-alert-hidden"><span>为您推荐了6篇文章</span></div>
                    <div class="msgAlert-place" style="display: none;">
                        <div class="msg-alert msg-alert-hidden"><span>您有未读新闻，点击查看</span> <i
                                    class="bui-icon icon-close_small"
                                    style="font-size: 15px; color: rgb(255, 255, 255);"></i></div>
                    </div>
                </div>
                <div class="Card" id="placeholder" style="display: none;">
                    <div class="PlaceHolder List-item">
                        <div class="PlaceHolder-inner">
                            <div class="PlaceHolder-bg"></div>
                            <svg width="656" height="108" viewBox="0 0 656 108" class="PlaceHolder-mask">
                                <title></title>
                                <g>
                                    <path d="M0 0h656v108H0V0zm0 0h350v12H0V0zm20 32h238v12H20V32zM0 32h12v12H0V32zm0 32h540v12H0V64zm0 32h470v12H0V96z"
                                          fill="#FFF" fill-rule="evenodd"></path>
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>

                <ul id="data-list">

                    <?php foreach ($data_command['items'] as $informaionkey => $informationval): ?>
                        <li class="news-list-item">
                            <div class="bui-box single-mode">
                                <div class="bui-left single-mode-lbox">
                                    <a href="<?= YLB_Registry::get('url') . '?ctl=News&met=detail&id=' ?><?= ($informationval['information_id']) ?>" target="_blank" class="img-wrap">
                                        <img class="lazy-load-img" src="<?= ($informationval['information_pic']) ?>" lazy="loaded">
                                    </a>
                                </div>
                                <div class="single-mode-rbox">
                                    <div class="single-mode-rbox-inner">
                                        <div class="title-box">
                                            <a href="<?= YLB_Registry::get('url') . '?ctl=News&met=detail&id=' ?><?= ($informationval['information_id']) ?>"  target="_blank" class="link"><?= ($informationval['information_title']) ?></a>

                                        </div>
                                        <div class="bui-box footer-bar">
                                            <div class="bui-left footer-bar-left">
                                                <a href="javascript:void(0);" target="_blank"
                                                   class="footer-bar-action media-avatar" style="">
                                                    <img src="<?= $this->view->img ?>/writer.jpg"   alt="淘尚168头条"     lazy="loaded">
                                                </a>
                                                <a href="javascript:void(0);" target="_blank"; class="footer-bar-action source">&nbsp;<?= ($informationval['user_name']) ?>&nbsp;</a>
                                                <span class="footer-bar-action">&nbsp;<?= ($informationval['information_add_time']) ?>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;阅读量：<?= ($informationval['information_fake_read_count']+$informationval['information_read_count'])?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>

                </ul>
                <div class="loading ball-pulse" id="loading-pulse1" style="display: none;">
                    <span>加载中⋅⋅⋅</span>
                </div>
            </div>
        </div>
        <div id="rightModule" class="bui-right index-right-bar">
            <?php
            if (count($ershisi['items']) > 0):
            ?>
<!--            <div class="jrtt-ad1" id="jrtt-ad-right1"></div>-->
            <div class="news-struct1" id="news-struct1">
                <div class="news-struct2" id="news-struct2">
                    <div class="news-struct bui-box">
                        <div id="hotNewsWrap" class="bui-box">
                            <div class="pane-module">
                                <div class="module-head">24小时热闻</div>
                                <ul class="module-content article-list" id="article-list">
                                    <div class="jrtt-ad2" id="jrtt-ad-right6"
                                         style="position: relative;border-bottom: 1px solid #e8e8e8;">
                                    </div>
                                    <?php foreach ($ershisi['items'] as $informaionkey => $informationval): ?>

                                        <li class="article-item clearfix">
                                            <a href="<?= YLB_Registry::get('url') . '?ctl=News&met=detail&id=' ?><?= ($informationval['information_id']) ?>" target="_blank" class="news-link">
                                            <div class="module-pic news-pic"><img src="<?= ($informationval['information_pic']) ?>" lazy="loaded"></div>
                                            <div class="news-inner"><p class="module-title"> <?= ($informationval['information_title']) ?></p></div>
                                            </a>
                                            <?= ($informationval['information_add_time']) ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="jrtt-ad11" id="jrtt-ad-right2">
                    </div>
                </div>
            </div>
            <?php
            endif;
            ?>
            <div class="pane-module">
                <div class="module-head">小编推荐</div>
                <ul class="module-content video-list" id="video-list">
                    <div class="jrtt-ad2" id="jrtt-ad-right3">
                    </div>

                    <?php foreach ($data_command['items'] as $informaionkey => $informationval): ?>

                    <li class="video-item"><a href="<?= YLB_Registry::get('url') . '?ctl=News&met=detail&id=' ?><?= ($informationval['information_id']) ?>"
                                              target="_blank" class="link">
                            <dl>
                                <dt class="module-pic"><img alt="<?= ($informationval['information_title']) ?>"
                                                            src="<?= ($informationval['information_pic']) ?>"
                                                            lazy="loaded"> <i class="module-tag video-tag"><span></span></i>
                                </dt>
                                <dd>
                                    <div class="cell"><h4><?= ($informationval['information_title']) ?></h4>
                                        <p><span><?= ($informationval['information_fake_read_count']+$informationval['information_read_count'])?>次点击&nbsp;</span></p>
                                    </div>
                                </dd>
                            </dl>
                        </a></li>
                    <div class="jrtt-ad2" id="jrtt-ad-right5">
                    </div>

                    <?php endforeach; ?>

                </ul>
            </div>
            <div class="jrtt-ad1" id="jrtt-ad-right4">
            </div>

            <div class="pane-module">
                <div class="module-head">更多</div>
                <ul class="more-items-content">
                    <li class="item"><a href="<?= YLB_Registry::get('url') . '?ctl=News&met=addus' ?>#0" target="_blank">关于头条</a></li>
                    <li class="item"><a href="<?= YLB_Registry::get('url') . '?ctl=News&met=addus' ?>#1">联系我们</a></li>
                    <li class="item"><a href="<?= YLB_Registry::get('url') . '?ctl=News&met=addus' ?>#2">投诉窗口</a></li>
                    <li class="item"><a href="<?= YLB_Registry::get('url') . '?ctl=News&met=addus' ?>#3">隐私政策</a></li>
                    <li class="item"><a href="<?= YLB_Registry::get('url') . '?ctl=News&met=addus' ?>#4">淘尚168商城</a></li>                </ul>
            </div>



            <div class="pane-module">
                <div class="module-head">友情链接</div>
                <ul class="friend-links-content">                    <li class="item"><a target="_blank" href="<?= YLB_Registry::get('url') . '?ctl=Activity&met=goodGoods'?>">遇见好货</a></li>
                    <li class="item"><a target="_blank" href="<?= YLB_Registry::get('url') . '?ctl=Activity&met=home'?>">家有儿女</a></li>
                    <li class="item"><a target="_blank" href="<?= YLB_Registry::get('url') . '?ctl=Activity&met=dailyBuy'?>">每日必BUY</a></li>
                    <li class="item"><a target="_blank" href="<?= YLB_Registry::get('url') . '?ctl=NewBuyer&met=index'?>">新人专享</a></li>
                    <li class="item"><a target="_blank" href="<?= YLB_Registry::get('url') . '?ctl=ScareBuy&met=index'?>">惠抢购</a></li>
                    <li class="item"><a target="_blank" href="<?= YLB_Registry::get('url') . '?ctl=Goods_Cheap&met=index'?>">9.9包邮</a></li>
                    <li class="item"><a target="_blank" href="<?= YLB_Registry::get('url') . '?ctl=DiscountBuy&met=index'?>">劲爆折扣</a></li>
                    <li class="item"><a target="_blank" href="<?= YLB_Registry::get('url') . '?ctl=Fresh_Index&met=index'?>">生鲜特产</a></li>
                    <li class="item"><a target="_blank" href="<?= YLB_Registry::get('url') . '?ctl=Activity&met=shop'?>">发现好店</a></li>
                </ul>
            </div>
        </div>
    </div>
    <button class="back_to_top">返回顶部</button>
</div>

<script type="text/javascript" src="<?= $this->view->js_com ?>/template.js"></script>
<script type="text/javascript" src="<?= $this->view->js ?>/jquery-1.11.3.min.js"></script>
<script type="text/javascript">

    var url_a = window.location.href;
    var url_n = url_a.indexOf('id');
    var url = url_a.substr(url_n+3);
    var id = 0;
    var page = 1;
    var rows = 2;
    var hasmore = false;
    var clear  = false;

//自动刷新
    $('#command_news').click(function () {
        if(url_n != '-1'){
        window.location.href= url_a.slice(0,url_n-1);
        }else{
            window.location.reload();
        }
    })
    $('.data-type').click(function () {
        if($(this).hasClass('active')){
        }else{
            $('.data-type').removeClass('active');
            $(this).addClass('active');
            $("html,body").animate({scrollTop:0}, 500);
        }
        page = 1;
        $('#slide').css('display','none');
        id = $(this).data('id');
        clear = true;
        getData();

    });


    $(document).ready(function(){
    function fanye(){
        if(hasmore){
            if($(document.body).height()-$(document).scrollTop() < 1000)
            {
                clear = false;
                getData();

            }
        }
    }
        setInterval(fanye,1000);
    });

    function getData() {
        $.post("?ctl=News&met=test&typ=json", {id: id,page:page}, function (r) {
            if (r.status == 200) {
                if(clear){
                    $('#data-list').html('');
                    page = 1;
                }
                var shopHtml = template.render('news_append', r.data);
                $('#data-list').append(shopHtml);
                if(page < r.data.total){
                    page++;
                    hasmore = true;
                }else{
                    hasmore = false;
                }

            }


        });
    }
    //回到顶部
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
    //搜索
    $('#search_btn').click(function () {
        var text = $(":text").val();
        window.location.replace('<?= YLB_Registry::get('url') . '?ctl=News&met=search&text=' ?>'+text);
    })
    if (url_n != "-1"){
        $('#command_news').removeClass('active');
        $('.data-type[data-id = '+url+']').addClass('active').siblings().removeClass('active');
        id = url;
        clear = true;
        $('#slide').css('display','none');
        $('#data-list').html('');
        getData();
    }
</script>



<!--摸板分离-->
<script type="text/html" id="news_append">
    <% if(items){ %>
    <% for(var i in items){ %>
    <li class="news-list-item">
        <div class="bui-box single-mode">
            <div class="bui-left single-mode-lbox">
                <a href="<?= YLB_Registry::get('url') . '?ctl=News&met=detail&id=' ?><%=items[i].information_id %>" target="_blank" class="img-wrap">
                    <img class="lazy-load-img" src="<%=items[i].information_pic %>" lazy="loaded">
                </a>
            </div>
            <div class="single-mode-rbox">
                <div class="single-mode-rbox-inner">
                    <div class="title-box">
                        <a href="<?= YLB_Registry::get('url') . '?ctl=News&met=detail&id=' ?><%=items[i].information_id %>"  target="_blank" class="link"><%=items[i].information_title %></a>

                    </div>
                    <div class="bui-box footer-bar">
                        <div class="bui-left footer-bar-left">
                            <a href="javascript:void(0);" target="_blank"
                               class="footer-bar-action media-avatar" style="">
                                <img src="<?= $this->view->img ?>/writer.jpg"
                                     lazy="loaded">
                            </a>
                            <a href="javascript:void(0);" target="_blank"; class="footer-bar-action source">&nbsp;<%=items[i].user_name %>&nbsp;</a>
                            <span class="footer-bar-action">&nbsp;<%=items[i].information_add_time %></span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </li>

    <% } %>

    <% } %>
</script>


</body>
</html>