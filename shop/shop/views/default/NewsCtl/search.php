<!DOCTYPE html>
<html lang="zh-cn"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>头条搜索_淘尚168头条</title>
    <meta name="keywords" content="淘尚168头条,头条新闻,头条,今日新闻头条,头条网,头条新闻,今日头条新闻">
    <meta name="description" content="淘尚168头条网 淘尚168网 旗下《淘尚168头条》是一款会自动学习的资讯软件,它会分析你的兴趣爱好,为你推荐喜欢的内容,并且越用越懂你.就要你好看,淘尚168头条新闻网!">
    <link rel="stylesheet" href="<?= $this->view->css ?>/reset_v4.css">
    <link rel="stylesheet" href="<?= $this->view->css ?>/page_search_km.css">
    <style>
        .app-download:hover .download-QRcode{
            width: 162px;
            height: 162px;
            background:url('<?= $this->view->img ?>/down_app.png');
        }
    </style>
    <script type="text/javascript">
        var newstype = 'search';
    </script>
    <!--头部-->
    <div class="header_cnt_detail clear-fix">
        <div class="header-left">
<!--            <div class="logo"><a href="/" target="_blank" pdata="comment|nav|0|0"></a></div>-->
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

            <div class="app-download">
                <span><i></i>客户端下载</span>
                <div class="download-QRcode"></div>
            </div>
            <div class="dfh-entry">
                <a href="<?= YLB_Registry::get('url') ?>" target="_blank" ><span style="width: 85px;"><i></i>淘尚168商城</span></a>
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

    <!--头部 end-->
    

    <!-- body start -->
    <div class="body">
        <div class="body-wrap container">
            <div class="clearfix">
                <!-- body right -->
                <div class="body-left fl">
                    <div class="header-wrap">
                    </div>
                    <div class="header-wrap">
                        <form class="clearfix" action="" onsubmit="return false;">
                            <div class="form-wrap fl">
                                <input id="J_search_text_input" value="" placeholder="<?= request_string(text)?>" type="text">
                            </div>
                            <button class="btn fr" id="search_btn" type="submit">搜索</button>
                        </form>
                    </div>

                    <div class="left-container">
                        <div class="hd pr" id="search_type">
                             <p>搜索结果：</p>
                             <span id="J_search_total_num" class="tips">您共搜索出<em><?= count($search_data['items'])?></em>条信息</span>
                        </div>
                        <div class="bd">
                            <div id="J_result_wrap" class="result">
                                <!-- 有结果 -->
                                    <?php   if (count($search_data['items']) == 0):          ?>
                                <ul id="result_list" class="result-list">
                                    <li style="margin-left: 255px">
                                        <div class="info pr">
                                            <img src="<?= $this->view->img ?>/notfond.png" style="" alt="">

                                        </div>
                                    </li>
                                    <li class="J-has-share result-item-s1 clearfix">
                                        <div class="info pr">
                                            <h3> &nbsp</h3>
                                        <h3> 没有搜索到你想要的，看看大家都在看什么</h3>
                                        </div>
                                    </li>
                                    <?php
                                       foreach ($fake_read['items'] as $key => $data):

                                    ?>
                                            <li class="J-has-share result-item-s1 clearfix">
                                                <div class="img fl">
                                                        <a href="<?= YLB_Registry::get('url') . '?ctl=News&met=detail&id=' ?><?= ($data['information_id']) ?>"
                                                           target="_blank">
                                                            <img class="animation" src="<?= ($data['information_pic']) ?>"
                                                                 width="145" height="105">
                                                        </a>
                                                    </div>
                                                    <div class="info pr">
                                                        <h3>
                                                            <a class="J-share-a" href="<?= YLB_Registry::get('url') . '?ctl=News&met=detail&id=' ?><?= ($data['information_id']) ?>"
                                                               updata="search|comprehensive|3|0" target="_blank">
                                                                <?= ($data['information_title']) ?>
                                                            </a>
                                                        </h3>
                                                        <p class="from">   来源：<?= ($data['information_writer'])?>
                                                            <span class="ml15">       <?= ($data['information_add_time']) ?>
                                                            </span>
                                                        </p>
                                                </div>
                                            </li>
                                    <?php endforeach; ?>
                                    <?php else:?>
                                    <ul id="result_list" class="result-list">
                                    <?php
                                    foreach ($search_data['items'] as $key => $data):

                                        ?>
                                        <li class="J-has-share result-item-s1 clearfix">
                                            <div class="img fl">
                                                <a href="<?= YLB_Registry::get('url') . '?ctl=News&met=detail&id=' ?><?= ($data['information_id']) ?>"
                                                   target="_blank">
                                                    <img class="animation" src="<?= ($data['information_pic']) ?>"
                                                         width="145" height="105">
                                                </a>
                                            </div>
                                            <div class="info pr">
                                                <h3>
                                                    <a class="J-share-a" href="<?= YLB_Registry::get('url') . '?ctl=News&met=detail&id=' ?><?= ($data['information_id']) ?>"
                                                       updata="search|comprehensive|3|0" target="_blank">
                                                        <?= ($data['information_title']) ?>
                                                    </a>
                                                </h3>
                                                <p class="from">   来源：<?= ($data['information_writer'])?>
                                                    <span class="ml15">       <?= ($data['information_add_time']) ?>
                                                            </span>
                                                </p>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                    <?php endif;?>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /body right -->

                <!-- body left -->
                <div id="bodyRight" class="body-right fr">



                    <!-- 今日TOP10 -->
                    <div class="section top10 mt20">
                        <div class="title pr">
                            <h3>TOP10</h3>
                        </div>
                        <div class="top10-list-wrap">
                            <ul id="J_top10_list" class="top10-list">
                                <?php   foreach ($fake_read['items'] as $key => $data):     ?>
                                <li class="top10-item"><span class="hot"><?= $key +1?></span><a
                                            href="<?= YLB_Registry::get('url') . '?ctl=News&met=detail&id=' ?><?= ($data['information_id']) ?>"
                                            title="大连特大刑事案件"><?= ($data['information_title']) ?></a></li>
                                <?php endforeach;?>

                            </ul>
                        </div>
                    </div>
                    <!-- /今日TOP10 -->


                    <!-- 今日热点 -->
                    <div class="section mt20">
                        <div class="title pr">
                            <h3>小编推荐</h3>
                        </div>
                        <div class="today-hot mt5">
                                    <div id="J_today_hot_news" class="today-hot-wrap clearfix">
                            <?php foreach ($data_command['items'] as $informaionkey => $informationval): ?>

                                        <div class="block fl"><a href="<?= YLB_Registry::get('url') . '?ctl=News&met=detail&id=' ?><?= ($informationval['information_id']) ?>"
                                                                 target="_blank" class="img"
                                                                 title="<?= ($informationval['information_title']) ?>"><img class="animation"     src="<?= ($informationval['information_pic']) ?>"></a>
                                            <a  href="<?= YLB_Registry::get('url') . '?ctl=News&met=detail&id=' ?><?= ($informationval['information_id']) ?>"   pdata="search|todayhot|1|0" target="_blank" class="txt"
                                                title="<?= ($informationval['information_title']) ?>"> <?= ($informationval['information_title']) ?></a></div>


                            <?php endforeach; ?>
                                    </div>
                        </div>
                    </div>
                    <!-- /今日热点 -->
                </div>
                <!-- /body left -->
            </div>
        </div>
    </div>
    <!-- body end -->

    <!-- footer start -->
    <div id="footer" class="footer_cnt">

    </div>
    <!-- footer end -->

<script type="text/javascript" src="<?= $this->view->js ?>/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
    //搜索
    $('#search_btn').click(function () {
        var text = $(":text").eq(0).val();
        window.location.replace('<?= YLB_Registry::get('url') . '?ctl=News&met=search&text=' ?>'+text);
    })
    //分页
    var page = 1;
    var rows = 2;
    var hasmore = true;
    var clear  = false;
    var url = window.location.href;
    var text = url.split("text=")['1'].split("&")['0'];

//    console.log(url);
    $(document).ready(function(){
        function fanye(){
            if(hasmore){
                if($(document.body).height()-$(document).scrollTop() < 1000)
                {
                    clear = false;
                    page++;
                    getData();
                }
            }
        }
        setInterval(fanye,1000);
    });

    function getData() {
        $.post("?ctl=News&met=getSearch&typ=json", {text:text,page:page}, function (r) {

            if (r.status == 200) {

                console.log(r);
                $('#result_list').append();
//                console.log(page);
//                console.log(r.data.total);

                if(page < r.data.total){
                    page++;
                    hasmore = true;
                }else{
                    hasmore = false;
                }

            }


        });
    }
</script>


    <div style="display:none;">

    </div>



</body></html>