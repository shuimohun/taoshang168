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
                    <a href="index.php?ctl=Index&met=rule&op=rule" clstag="pageclick|keycount|rule_home|2" class="link-dlk">首页</a>
                </li>
                <li class="li-item">
                    <a href="index.php?ctl=Index&met=rule&op=ruleOverview" clstag="pageclick|keycount|rule_home|3" class="link-dlk">规则总览</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="l-wrap">
        <div class="l-main">
            <div class="breadcrumb">
                <a href="/rule/index.html">首页</a>
                &nbsp;&gt;&nbsp;
                <span class="i-txt">规则总览</span>
            </div>

            <div class="l-menu-wrap">
                <div class="l-menu-box">
                    <dl class="b-menu-box  h-menu-current ">
                        <dt clstag="pageclick|keycount|rule_list_detail|373" class="menu-hd"><i class="menu-icon-sh"></i>
                        招商管理
                        </dt>
                        <dd class="menu-bd">
                            <ul class="menu-lev01">
                                <li class="menu-item   menu-item-current  ">
                                    <a href="/rule/list.action?id=392" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|392">
                                    总则协议 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=391" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|391">
                                    入驻合作 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=393" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|393">
                                    资质要求 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=390" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|390">
                                    资费相关 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                            </ul>
                        </dd>
                    </dl>
                    <dl class="b-menu-box ">
                        <dt clstag="pageclick|keycount|rule_list_detail|372" class="menu-hd"><i class="menu-icon-sh"></i>
                            经营管理
                        </dt>
                        <dd class="menu-bd">
                            <ul class="menu-lev01">
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=389" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|389">
                                        商家奖励 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=388" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|388">
                                        违规考核 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                        <a href="/rule/list.action?id=541" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|541">
                                            激励政策 <i class="menu-icon-tria"></i>
                                            </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=542" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|542">
                                        专项市场 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                            </ul>
                        </dd>
                    </dl>
                    <dl class="b-menu-box ">
                        <dt clstag="pageclick|keycount|rule_list_detail|374" class="menu-hd"><i class="menu-icon-sh"></i>
                        商品管理
                        </dt>
                        <dd class="menu-bd">
                            <ul class="menu-lev01">
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=394" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|394">
                                        商品发布 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=395" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|395">
                                        商品管控 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=396" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|396">
                                        质量标准 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=397" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|397">
                                        抽检规范 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                            </ul>
                        </dd>
                    </dl>
                    <dl class="b-menu-box ">
                        <dt clstag="pageclick|keycount|rule_list_detail|375" class="menu-hd"><i class="menu-icon-sh"></i>
                            营销活动
                        </dt>
                        <dd class="menu-bd">
                            <ul class="menu-lev01">
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=398" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|398">
                                        营销工具 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=399" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|399">
                                        活动营销 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=545" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|545">
                                        内容营销 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=546" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|546">
                                        用户营销 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                            </ul>
                        </dd>
                    </dl>
                    <dl class="b-menu-box ">
                        <dt clstag="pageclick|keycount|rule_list_detail|385" class="menu-hd"><i class="menu-icon-sh"></i>
                            交易管理
                        </dt>
                        <dd class="menu-bd">
                            <ul class="menu-lev01">
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=404" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|404">
                                        交易流程 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=544" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|544">
                                        评价评分 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=543" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|543">
                                        纠纷争议 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=547" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|547">
                                        品类纠纷 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                            </ul>
                        </dd>
                    </dl>
                    <dl class="b-menu-box ">
                        <dt clstag="pageclick|keycount|rule_list_detail|384" class="menu-hd"><i class="menu-icon-sh"></i>
                            服务管理
                        </dt>
                        <dd class="menu-bd">
                            <ul class="menu-lev01">
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=402" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|402">
                                        售后管理 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=401" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|401">
                                        物流管理 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=403" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|403">
                                        服务工具 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=400" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|400">
                                        京东放心购 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                            </ul>
                        </dd>
                    </dl>
                    <dl class="b-menu-box ">
                        <dt clstag="pageclick|keycount|rule_list_detail|387" class="menu-hd"><i class="menu-icon-sh"></i>
                            广告搜索
                        </dt>
                        <dd class="menu-bd">
                            <ul class="menu-lev01">
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=408" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|408">
                                        广告 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=409" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|409">
                                        搜索 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=410" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|410">
                                        推荐 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=411" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|411">
                                        工具 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                            </ul>
                        </dd>
                    </dl>
                    <dl class="b-menu-box ">
                        <dt clstag="pageclick|keycount|rule_list_detail|386" class="menu-hd"><i class="menu-icon-sh"></i>
                            解读说明
                        </dt>
                        <dd class="menu-bd">
                            <ul class="menu-lev01">
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=405" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|405">
                                        规则解读 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=406" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|406">
                                        介绍说明 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=420" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|420">
                                        模板下载 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="/rule/list.action?id=407" class="link-dlk" clstag="pageclick|keycount|rule_list_detail|407">
                                    规则动态 <i class="menu-icon-tria"></i>
                                    </a>
                                </li>
                            </ul>
                        </dd>
                    </dl>
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
                })
            </script>

            <div class="l-content">
                <div class="b-subsearch-wrap">
                    <p class="h-words">在<span class="txt-black">总则协议</span>中精细搜索：
                    </p>
                    <div class="b-subsearch-box">
                        <form action="/rule/list.action" method="get">
                        <input type="text" class="text-search" name="title" value="">
                        <button class="btn-search" type="submit" clstag="pageclick|keycount|rule_home|6">搜索</button>
                        </form>
                    </div>
                </div>

                <div class="re-count-box">
                    共搜索到<span class="txt-red">3</span>条规则：
                </div>
               
                <div class="b-list-wrap">
                    <ul class="normal-list">
                        <li class="li-item">
                            <h3 class="h-title"><a href="index.php?ctl=Index&met=rule&op=ruleDetail" class="link-dlk" clstag="pageclick|keycount|rule_detail|2368">京东开放平台总则</a></h3>
                        </li>
                        <li class="li-item">
                            <h3 class="h-title"><a href="index.php?ctl=Index&met=rule&op=ruleDetail" class="link-dlk" clstag="pageclick|keycount|rule_detail|2521">京东开放平台术语名词释义</a></h3>
                        </li>
                        <li class="li-item">
                            <h3 class="h-title"><a href="index.php?ctl=Index&met=rule&op=ruleDetail" class="link-dlk" clstag="pageclick|keycount|rule_detail|2450">京东开放平台信息发布规范</a></h3>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


<?php include $this->view->getTplPath() . '/' . 'footer.php'; ?>