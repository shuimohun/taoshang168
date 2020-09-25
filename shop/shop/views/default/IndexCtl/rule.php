<?php include $this->view->getTplPath() . '/' . 'rule_header.php'; ?>
    <link type="text/css" rel="stylesheet" href="<?= $this->view->css ?>/rule_base.css"/>
    <link type="text/css" rel="stylesheet" href="<?= $this->view->css ?>/pop_rulers.css" source="widget"/>
    <script type="text/javascript" src="<?= $this->view->js ?>/rule_base.js"></script>

    <style>
        #shengtaiquan-top:hover,#shengtaiquan-bottom:hover{
            position: absolute;
            height: 130px;
            width: 130px;
            margin-left: -130px;
        }
        #id-newrule {
            font-size: 40px;
            text-align: center;
            vertical-align: middle;
        }
        #id-newrule a {
            display: inline-block;
            height: 100%;
            vertical-align: middle;
            padding-top: 130px;
            color: white;
        }
    </style>

    <div class="root61">
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
            <div class="l-part">
                <div class="w">
                    <div class="b-search-wrap">
                        <form action="/rule/list.action" id="search-form">
                            <div class="b-search-box">
                                <input type="text" style="outline: none;" class="text-search" name="title" placeholder="请输入规则关键词，如“违规”">
                                <button class="btn-search" type="submit" clstag="pageclick|keycount|rule_home|6">搜索</button>
                            </div>
                            <div class="b-hotwords">
                                热门搜索：<a href="/rule/list.action?title=%ce%a5%b9%e6"  class="link-ib" clstag="pageclick|keycount|rule_home|7">违规</a>
                                <a href="/rule/list.action?title=%cb%d1%cb%f7" class="link-ib" clstag="pageclick|keycount|rule_home|8">搜索</a>
                                <a href="/rule/list.action?title=%d0%f8%c7%a9" class="link-ib" clstag="pageclick|keycount|rule_home|9">续签</a>
                                <a href="/rule/list.action?title=%d0%d0%d2%b5%b1%ea%d7%bc" class="link-ib" clstag="pageclick|keycount|rule_home|10">行业标准</a>
                            </div>
                        </form>
                    </div>
                    <!-- search -->
                    <div class="mod-s01" id="id-gongao">
                        <div class="mod-hd">
                            <h3 class="h-title" >最新公告</h3>
                            <div class="h-more"></div>
                        </div>
                        <div class="mod-bd">
                            <ul class="normal-list" style="font-size: 14px">
                                <li class="li-item"><a target="_blank" href="index.php?ctl=Index&met=rule&op=noticeDetail" clstag="pageclick|keycount|rule_home|289">&middot;2018年招商相关规则调整通知</a>
                                </li>
                                <li class="li-item"><a target="_blank" href="index.php?ctl=Index&met=rule&op=noticeDetail" clstag="pageclick|keycount|rule_home|292">&middot;2018年京东商家续签公告</a>
                                </li>
                                <li class="li-item"><a target="_blank" href="index.php?ctl=Index&met=rule&op=noticeDetail" clstag="pageclick|keycount|rule_home|296">&middot;《过敏退货无忧服务规则》上线公告</a>
                                </li>
                                <li class="li-item"><a target="_blank" href="index.php?ctl=Index&met=rule&op=noticeDetail" clstag="pageclick|keycount|rule_home|297">&middot;破损包赔服务规则上线公告</a>
                                </li>
                                <li class="li-item"><a target="_blank" href="index.php?ctl=Index&met=rule&op=noticeDetail" clstag="pageclick|keycount|rule_home|298">&middot;【规则评审】成人情趣用品类抽检规范</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- gongao -->
                </div>
            </div>
            <!-- l-part -->
            <div class="l-main">
                <div class="mod-s01 fl mod-wide" id="id-hotrule">
                    <div class="mod-hd">
                        <h3 class="h-title"><i class="icon-hot"></i>热门规则</h3>
                        <div class="h-extra">
                            <ul class="normal-list-x">
                                <li class="li-item"><a
                                            href="ruleDetail.html" clstag="pageclick|keycount|rule_home|2754">京东开放平台商家积分管理规则</a>
                                </li>
                                <li class="li-item"><a
                                            href="ruleDetail.html" clstag="pageclick|keycount|rule_home|3429">京东开放平台商家奖励规则</a>
                                </li>
                                <li class="li-item"><a
                                            href="ruleDetail.html" clstag="pageclick|keycount|rule_home|3818">京东开放平台优创店管理规则</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="mod-bd">
                        <dl class="dl-list" style="margin-bottom: 15px">
                            <dt class="dl-hd"><a href="index.php?ctl=Index&met=rule&op=ruleOverview">招商管理</a></dt>
                            <dd class="dl-bd">
                                <ul class="normal-list">
                                    <li class="li-item"><a href="index.php?ctl=Index&met=rule&op=ruleOverview" clstag="pageclick|keycount|rule_home|392">总则协议</a></li>
                                    <li class="li-item"><a href="index.php?ctl=Index&met=rule&op=ruleOverview" clstag="pageclick|keycount|rule_home|391">入驻合作</a></li>
                                    <li class="li-item"><a href="index.php?ctl=Index&met=rule&op=ruleOverview" clstag="pageclick|keycount|rule_home|393">资质要求</a></li>
                                    <li class="li-item"><a href="index.php?ctl=Index&met=rule&op=ruleOverview" clstag="pageclick|keycount|rule_home|390">资费相关</a></li>
                                </ul>
                            </dd>
                        </dl>
                        <dl class="dl-list" style="margin-bottom: 15px">
                            <dt class="dl-hd"><a href="index.php?ctl=Index&met=rule&op=ruleOverview">经营管理</a></dt>
                            <dd class="dl-bd">
                                <ul class="normal-list">
                                    <li class="li-item"><a href="index.php?ctl=Index&met=rule&op=ruleOverview" clstag="pageclick|keycount|rule_home|389">商家奖励</a></li>
                                    <li class="li-item"><a href="index.php?ctl=Index&met=rule&op=ruleOverview" clstag="pageclick|keycount|rule_home|388">违规考核</a></li>
                                    <li class="li-item"><a href="index.php?ctl=Index&met=rule&op=ruleOverview" clstag="pageclick|keycount|rule_home|541">激励政策</a></li>
                                    <li class="li-item"><a href="index.php?ctl=Index&met=rule&op=ruleOverview" clstag="pageclick|keycount|rule_home|542">专项市场</a></li>
                                </ul>
                            </dd>
                        </dl>
                        <dl class="dl-list" style="margin-bottom: 15px">
                            <dt class="dl-hd"><a href="index.php?ctl=Index&met=rule&op=ruleOverview">商品管理</a></dt>
                            <dd class="dl-bd">
                                <ul class="normal-list">
                                    <li class="li-item"><a href="index.php?ctl=Index&met=rule&op=ruleOverview" clstag="pageclick|keycount|rule_home|394">商品发布</a></li>
                                    <li class="li-item"><a href="index.php?ctl=Index&met=rule&op=ruleOverview" clstag="pageclick|keycount|rule_home|395">商品管控</a></li>
                                    <li class="li-item"><a href="index.php?ctl=Index&met=rule&op=ruleOverview" clstag="pageclick|keycount|rule_home|396">质量标准</a></li>
                                    <li class="li-item"><a href="index.php?ctl=Index&met=rule&op=ruleOverview" clstag="pageclick|keycount|rule_home|397">抽检规范</a></li>
                                </ul>
                            </dd>
                        </dl>
                        <dl class="dl-list" style="margin-bottom: 15px">
                            <dt class="dl-hd"><a href="index.php?ctl=Index&met=rule&op=ruleOverview">营销活动</a></dt>
                            <dd class="dl-bd">
                                <ul class="normal-list">
                                    <li class="li-item"><a href="index.php?ctl=Index&met=rule&op=ruleOverview" clstag="pageclick|keycount|rule_home|398">营销工具</a></li>
                                    <li class="li-item"><a href="index.php?ctl=Index&met=rule&op=ruleOverview" clstag="pageclick|keycount|rule_home|399">活动营销</a></li>
                                    <li class="li-item"><a href="index.php?ctl=Index&met=rule&op=ruleOverview" clstag="pageclick|keycount|rule_home|545">内容营销</a></li>
                                    <li class="li-item"><a href="/rule/list.action?id=546" clstag="pageclick|keycount|rule_home|546">用户营销</a></li>
                                </ul>
                            </dd>
                        </dl>
                        <dl class="dl-list" style="margin-bottom: 15px">
                            <dt class="dl-hd"><a href="/rule/list.action?id=404 ">交易管理</a></dt>
                            <dd class="dl-bd">
                                <ul class="normal-list">
                                    <li class="li-item"><a href="/rule/list.action?id=404" clstag="pageclick|keycount|rule_home|404">交易流程</a></li>
                                    <li class="li-item"><a href="/rule/list.action?id=544" clstag="pageclick|keycount|rule_home|544">评价评分</a></li>
                                    <li class="li-item"><a href="/rule/list.action?id=543" clstag="pageclick|keycount|rule_home|543">纠纷争议</a></li>
                                    <li class="li-item"><a href="/rule/list.action?id=547" clstag="pageclick|keycount|rule_home|547">品类纠纷</a></li>
                                </ul>
                            </dd>
                        </dl>
                        <dl class="dl-list" style="margin-bottom: 15px">
                            <dt class="dl-hd"><a href="/rule/list.action?id=402 ">服务管理</a></dt>
                            <dd class="dl-bd">
                                <ul class="normal-list">
                                    <li class="li-item"><a href="/rule/list.action?id=402" clstag="pageclick|keycount|rule_home|402">售后管理</a></li>
                                    <li class="li-item"><a href="/rule/list.action?id=401" clstag="pageclick|keycount|rule_home|401">物流管理</a></li>
                                    <li class="li-item"><a href="/rule/list.action?id=403" clstag="pageclick|keycount|rule_home|403">服务工具</a></li>
                                    <li class="li-item"><a href="/rule/list.action?id=400" clstag="pageclick|keycount|rule_home|400">京东放心购</a></li>
                                </ul>
                            </dd>
                        </dl>
                        <dl class="dl-list" style="margin-bottom: 15px">
                            <dt class="dl-hd"><a href="/rule/list.action?id=408 ">广告搜索</a></dt>
                            <dd class="dl-bd">
                                <ul class="normal-list">
                                    <li class="li-item"><a href="/rule/list.action?id=408" clstag="pageclick|keycount|rule_home|408">广告</a></li>
                                    <li class="li-item"><a href="/rule/list.action?id=409" clstag="pageclick|keycount|rule_home|409">搜索</a></li>
                                    <li class="li-item"><a href="/rule/list.action?id=410" clstag="pageclick|keycount|rule_home|410">推荐</a></li>
                                    <li class="li-item"><a href="/rule/list.action?id=411" clstag="pageclick|keycount|rule_home|411">工具</a></li>
                                </ul>
                            </dd>
                        </dl>
                        <dl class="dl-list" style="margin-bottom: 15px">
                            <dt class="dl-hd"><a href="/rule/list.action?id=405 ">解读说明</a></dt>
                            <dd class="dl-bd">
                                <ul class="normal-list">
                                    <li class="li-item"><a href="/rule/list.action?id=405" clstag="pageclick|keycount|rule_home|405">规则解读</a></li>
                                    <li class="li-item"><a href="/rule/list.action?id=406" clstag="pageclick|keycount|rule_home|406">介绍说明</a></li>
                                    <li class="li-item"><a href="/rule/list.action?id=420" clstag="pageclick|keycount|rule_home|420">模板下载</a></li>
                                    <li class="li-item"><a href="/rule/list.action?id=407" clstag="pageclick|keycount|rule_home|407">规则动态</a></li>
                                </ul>
                            </dd>
                        </dl>
                    </div>
                </div>
                <!-- id-hotrule -->
                <div class="mod-small" id="id-newrule" style="display: inline-block;height: 278px;width: 278px;background-image: url('<?= $this->view->img ?>/month-newly.jpg')">
                    <a href="index.php?ctl=Index&met=rule&op=newRule" clstag="pageclick|keycount|rule_home|44"></a>
                </div>
                <!-- id-newrule -->
                <div class="clr mb20"></div>
                <!-- clr -->
                <div class="mod-s01 fl mod-wide" id="id-rulesub">
                    <div class="mod-hd">
                        <h3 class="h-title">规则专题</h3>
                    </div>
                    <div class="mod-bd">
                        <dl class="dl-box">
                            <dt class="dl-hd"><a href="index.php?ctl=Index&met=rule&op=ruleDetail" class="link-dlk"><img src="//img11.360buyimg.com/uba/jfs/t3583/31/1057896116/4450/7c09d25e/581aeefaN11dde42d.jpg" clstag="pageclick|keycount|rule_home|45"     alt=""></a>
                            </dt>
                            <dd class="dl-bd">
                                <h3 class="title">
                                    <a href="index.php?ctl=Index&met=rule&op=ruleDetail" clstag="pageclick|keycount|rule_home|46">【规则解读】 看后秒懂，售前退款纠纷不该赔的咱不赔~</a>
                                </h3>
                                <div class="h-words" style="max-height: 80px;height:80px;text-overflow:ellipsis;overflow: hidden;display: inline-block">
                                    <a href="index.php?ctl=Index&met=rule&op=ruleDetail" clstag="pageclick|keycount|rule_home|47"> 前些时间商家应该都通过各个渠道了解到商家后台“取消订单管理”模块在9月上线了一些新功能，比如商品出库后取消订单的审核时效由7个自然日缩短为3个自然日(春节国庆长假期间不计时):</a>
                                </div>
                            </dd>
                        </dl>
                        <dl class="dl-box">
                            <dt class="dl-hd"><a href="index.php?ctl=Index&met=rule&op=ruleDetail" class="link-dlk"><img src="picture/581aefdeNb4ce1234.jpg" clstag="pageclick|keycount|rule_home|47"
                                                                               alt=""></a>
                            </dt>
                            <dd class="dl-bd">
                                <h3 class="title">
                                    <a href="index.php?ctl=Index&met=rule&op=ruleDetail" clstag="pageclick|keycount|rule_home|49">【规则解读】  为什么他家的漏发商品纠纷判商责量为零？</a>
                                </h3>
                                <div class="h-words" style="max-height: 80px; height:80px;text-overflow:ellipsis;overflow: hidden;display: inline-block">
                                    <a href="index.php?ctl=Index&met=rule&op=ruleDetail" clstag="pageclick|keycount|rule_home|50">     今天想跟大家分享的，商家经常会遇到，商品的漏发纠纷，很多商家会选择补发，然而有时候客户没法提供令人信服的证据，商家也是无计可施。
                                    </a>
                                </div>
                            </dd>
                        </dl>
                        <dl class="dl-box">
                            <dt class="dl-hd">
                                <a href="index.php?ctl=Index&met=rule&op=ruleDetail" class="link-dlk"><img src="picture/581aefdfNecd87099.jpg" clstag="pageclick|keycount|rule_home|51"
                                                                 alt="">
                                </a>
                            </dt>
                            <dd class="dl-bd">
                                <h3 class="title">
                                    <a href="index.php?ctl=Index&met=rule&op=ruleDetail" clstag="pageclick|keycount|rule_home|52">【规则解读】  发错货一直被赔钱，不知道原因可不行</a>
                                </h3>
                                <div class="h-words" style="max-height: 80px;height:80px;text-overflow:ellipsis;overflow: hidden">
                                    <a href="index.php?ctl=Index&met=rule&op=ruleDetail" clstag="pageclick|keycount|rule_home|53">双十二刚刚过去，商家们此时已经在准备元旦的促销活动了，按照惯例，每年大促过后能够会有一批搞笑的买家秀与卖家秀上演，确定不是卖家发错货了吗？
                                    </a>
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>

                <!-- id-rulesub -->
                <div class="mod-s01 mod-small mb10" id="id-s1">
                    <a href="//helpcenter.jd.com/rule/ruleDetail.action?ruleId=2651" class="link-dlk"><img
                                src="picture/581af305n6f24bba9.jpg"" clstag="pageclick|keycount|rule_home|54" alt=""></a>
                    <p class="h-words p20">京东商家入驻、违规考试的练兵场，同时提供参考资料、错题解析等学习资源</p>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.querySelector("#id-newrule>a").innerHTML = new Date().getMonth() + 1 + "月新规";
    </script>
    <script src="<?= $this->view->js ?>/helpcenter.js"></script>

<?php include $this->view->getTplPath() . '/' . 'footer.php'; ?>