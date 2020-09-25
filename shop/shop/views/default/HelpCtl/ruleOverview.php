<?php include $this->view->getTplPath() . '/' . 'rule_header.php'; ?>
	<link type="text/css" rel="stylesheet" href="<?= $this->view->css ?>/rule_base.css"/>
    <link type="text/css" rel="stylesheet" href="<?= $this->view->css ?>/pop_rulers.css" source="widget"/>
    <script type="text/javascript" src="<?= $this->view->js ?>/rule_base.js"></script>
    


    <style>
        .b-list-wrap .li-item{
            padding-top: 5px;
            padding-bottom: 5px;
            border-bottom: 0;
        }
        #shengtaiquan-top:hover,#shengtaiquan-bottom:hover{
            position: absolute;
            height: 130px;
            width: 130px;
            margin-left: -130px;
        }
    </style>
    <div class="l-nav">
        <div class="w">
            <ul class="b-nav-list">
                <li class="li-item">
                    <a href="<?= YLB_Registry::get('url') . '?ctl=Help&met=index'?>" clstag="pageclick|keycount|rule_home|2" class="link-dlk">首页</a>
                </li>
                <li class="li-item">
                    <a href="<?= YLB_Registry::get('url') . '?ctl=Help&met=ruleOverview'?>" clstag="pageclick|keycount|rule_home|3" class="link-dlk">帮助总览</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="l-wrap">
        <div class="l-main">
            <div class="breadcrumb">
                <a href="/rule/index.html">首页</a>
                &nbsp;&gt;&nbsp;
                <span class="i-txt">帮助总览</span>
            </div>

            <div class="l-menu-wrap">
                <div class="l-menu-box">
                    <?php
                    foreach ($Parent['items'] as $key => $data):
                        ?>
                    <dl class="b-menu-box   ">
                        <dt clstag="pageclick|keycount|rule_list_detail|373" class="menu-hd"><i class="menu-icon-sh"></i>
                        <?= ($data['help_group_title'])?>
                        </dt>
                        <dd class="menu-bd">
                            <ul class="menu-lev01">
                                <?php
                                foreach ($Son['items'] as $k => $S):
                                    if ($S['help_group_parent_id'] == $data['help_group_id']):
                                ?>

                                <li class="menu-item" data-id="<?= ($S['help_group_id'])?>">
                                    <a href="" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|392">
                                    <?= ($S['help_group_title'])?> <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                                    <?php
                                    endif;
                                    endforeach;
                                    ?>

                            </ul>
                        </dd>
                    </dl>
                    <?php
                    endforeach;
                    ?>
                </div>
            </div>

            <script>
                $(function () {
                    $(".b-menu-box .menu-hd").click(function () {
                        var o_parent = $(this).parent();
                        if (o_parent.hasClass("h-menu-current")) {
                            o_parent.removeClass("h-menu-current")
                        } else {
                            o_parent.addClass("h-menu-current").siblings("").removeClass("h-menu-current")
                        }
                    })
                    $('.menu-item').click(function () {
                        var o_parent = $(this);
                            o_parent.addClass("menu-item-current").siblings("").removeClass("menu-item-current")
                            return false;


                    })
                })
            </script>

            <div class="l-content">
                <div class="b-subsearch-wrap">
                    <p class="h-words">在<span class="txt-black">所有帮助</span>中精细搜索：
                    </p>
                    <div class="b-subsearch-box">
                        <form action="" method="get" id="search-form">
                        <input type="text" class="text-search" name="title" placeholder="<?=(request_string(title))?>">
                        <a class="btn-search" id="submit_btn" clstag="pageclick|keycount|rule_home|6">搜索</a>
                        </form>
                    </div>
                </div>
                        <?php
                        if ($search):
                        ?>
                        <div class="re-count-box">
                            共搜索到<span class="txt-red"><?= count($search['items'])?></span>条帮助：
                        </div>

                        <div class="b-list-wrap">
                            <ul class="normal-list">
                                <?php
                                if (count($search['items']) == 0):
                                ?>
                                <li style="margin-left: 255px">
                                    <div class="info pr">
                                        <img src="<?= $this->view->img ?>/notfond.png" style="" alt="">

                                    </div>
                                </li>
                                <li class="J-has-share result-item-s1 clearfix">
                                    <div class="info pr">
                                        <h3>&nbsp</h3>
                                        <h3 align="center">没有搜索到你想要的，看看大家都在看什么</h3>
                                    </div>
                                </li>
                                <?php
                                endif;
                                ?>
                                <?php
                                    foreach ($search['items'] as $key => $data):
                                ?>
                                <li class="li-item">
                                    <h3 class="h-title"><a href="index.php?ctl=Index&met=rule&op=ruleDetail" class="link-dlk" clstag="pageclick|keycount|rule_detail|2368"><?= ($data['help_title'])?></a></h3>
                                </li>
                                <?php
                                endforeach;

                                ?>
                            </ul>
                        </div>
                        <?php
                        else:
                        ?>
                            <div class="b-list-wrap">
                                <ul class="search_list">

                                    <?php
                                    foreach ($search['items'] as $key => $data):
                                        ?>
                                        <li class="li-item">
                                            <h3 class="h-title"><a href="index.php?ctl=Index&met=rule&op=ruleDetail" class="link-dlk" clstag="pageclick|keycount|rule_detail|2368"><?= ($data['help_title'])?></a></h3>
                                        </li>
                                        <?php
                                    endforeach;

                                    ?>
                                </ul>
                            </div>
                <?php
                endif;
                ?>
            </div>
        </div>
    </div>
<script>
    var url = window.location.toString();
    var num = url.indexOf('id');
    var index = url.substring(num+3);
    var title = url.indexOf('title');
    if (title == -1) {
        if (index && num != -1) {
            group_id = index;
            $('.menu-item[data-id=' + index + ']').addClass("menu-item-current");
            $('.menu-item[data-id=' + index + ']').parent().parent().parent().addClass("h-menu-current");
            getList();
        } else {
//            alert('123');
            $('.menu-item').eq(0).addClass("menu-item-current");
            $('.b-menu-box').eq(0).addClass("h-menu-current");
            group_id = $('.menu-item').eq(0).attr('data-id');
            getList();
        }
    }
    function getList() {
        $.post("?ctl=Help&met=getList&typ=json",{group_id:group_id}, function (r) {
            for(var i in r.data.items){
           $('.search_list').append("<li class='li-item'><h3 class='h-title'><a href='index.php?ctl=Help&met=ruleDetail&id="+r.data.items[i]['help_id']+"'class='link-dlk'>"+r.data.items[i]['help_title']+"</a></h3></li>");
            }
        });
    }
    $('.menu-item').click(function () {
        group_id = $(this).attr('data-id');
        $('.search_list').html("");
        getList();
    })
    //搜索
    $('#submit_btn').click(function () {
        var text = $(" input[ name='title' ] ").val();
        window.location.replace('<?= YLB_Registry::get('url') . '?ctl=Help&met=ruleOverview&title=' ?>'+text);
    })
</script>

<?php include $this->view->getTplPath() . '/' . 'footer.php'; ?>