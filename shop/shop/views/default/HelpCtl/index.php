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
                        <a href="index.php?ctl=Help&met=index" clstag="pageclick|keycount|rule_home|2" class="link-dlk">首页</a>
                    </li>
                    <li class="li-item">
                        <a href="index.php?ctl=Help&met=ruleOverview" clstag="pageclick|keycount|rule_home|3" class="link-dlk">帮助总览</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="l-wrap">
            <div class="l-part">
                <div class="w">
                    <div class="b-search-wrap">
                        <form action="" id="search-form">
                            <div class="b-search-box">
                                <input type="text" style="outline: none;" class="text-search" name="title" placeholder="请输入帮助关键词，如“违规”">
                                <a class="btn-search" id="submit_btn" clstag="pageclick|keycount|rule_home|6">搜索</a>
                            </div>
                            <div class="b-hotwords">

                                热门搜索：<a href="<?= YLB_Registry::get('url') . '?ctl=Help&met=ruleOverview&title=违规' ?>"  class="link-ib" clstag="pageclick|keycount|rule_home|7">违规</a>
                                <a href="<?= YLB_Registry::get('url') . '?ctl=Help&met=ruleOverview&title=续签' ?>" class="link-ib" clstag="pageclick|keycount|rule_home|9">续签</a>
                                <a href="<?= YLB_Registry::get('url') . '?ctl=Help&met=ruleOverview&title=支付' ?>" class="link-ib" clstag="pageclick|keycount|rule_home|10">支付</a>
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
                                <?php
                                foreach ($Type['items'] as $key => $data):
                                ?>
                                <li class="li-item"><a target="_blank" href="<?= YLB_Registry::get('url') . '?ctl=Help&met=ruleDetail&id=' ?><?= ($data['help_id']) ?>" clstag="pageclick|keycount|rule_home|289">&middot;<?= ($data['help_title'])?></a>
                                </li>
                                <?php
                                endforeach;
                                ?>
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
                        <h3 class="h-title"><i class="icon-hot"></i>热门帮助</h3>
                        <div class="h-extra">
                            <ul class="normal-list-x">
                                <?php
                                foreach ($Top['items'] as $k => $data):
                                ?>
                                <li class="li-item"><a
                                            href="<?= YLB_Registry::get('url') . '?ctl=Help&met=ruleDetail&id=' ?><?= ($data['help_id']) ?>" clstag="pageclick|keycount|rule_home|2754"><?= ($data['help_title'])?></a>
                                </li>
                                <?php
                                endforeach;
                                ?>

                            </ul>
                        </div>
                    </div>
                    <div class="mod-bd">
                        <?php
                            foreach ($Parent['items'] as $kay => $data):
                        ?>
                        <dl class="dl-list" style="margin-bottom: 15px">
                            <dt class="dl-hd"><a href="<?= YLB_Registry::get('url') . '?ctl=Help&met=ruleOverview&id=' ?><?= ($data['help_group_id']) ?>"><?= ($data['help_group_title'])?></a></dt>
                            <dd class="dl-bd">
                                <ul class="normal-list">
                                    <?php
                                        foreach ($Son['items'] as $k => $S):
                                            ?>
                                            <?php
                                            if ($S['help_group_parent_id'] == $data['help_group_id']):
                                    ?>
                                    <li class="li-item"><a href="<?= YLB_Registry::get('url') . '?ctl=Help&met=ruleOverview&id=' ?><?= ($S['help_group_id']) ?>" clstag="pageclick|keycount|rule_home|392"><?= ($S['help_group_title'])?></a></li>
                                                <?php
                                                endif;
                                                ?>
                                    <?php
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
                <!-- id-hotrule -->
          <!--      <div class="mod-small" id="id-newrule" style="display: inline-block;height: 278px;width: 278px;background-image: url('<?= $this->view->img ?>/month-newly.jpg')">
                    <a href="index.php?ctl=Help&met=noticeList" clstag="pageclick|keycount|rule_home|44"></a>
                </div>
                !-->
                <div class="mod-small"  style="text-align: center;	display: inline-block;height: 170px;width: 278px;background-image: url('<?= $this->view->img ?>/guizegonggao.jpg')">
                    <a href="index.php?ctl=Help&met=noticeDetail" style="	display: inline-block;font-size: 40px;padding-top: 80px;	color: #6693ff;" clstag="pageclick|keycount|rule_home|44">最新公告</a>
                </div>
                <!-- id-newrule -->
                <div class="clr mb20"></div>
                <!-- clr -->
                <!--
                <div class="mod-s01 fl mod-wide" id="id-rulesub">
                    <div class="mod-hd">
                        <h3 class="h-title">帮助专题</h3>
                    </div>
                    <div class="mod-bd">
                        <dl class="dl-box">
                            <dt class="dl-hd"><a href="index.php?ctl=Index&met=rule&op=ruleDetail" class="link-dlk"><img src="//img11.360buyimg.com/uba/jfs/t3583/31/1057896116/4450/7c09d25e/581aeefaN11dde42d.jpg" clstag="pageclick|keycount|rule_home|45"     alt=""></a>
                            </dt>
                            <dd class="dl-bd">
                                <h3 class="title">
                                    <a href="index.php?ctl=Index&met=rule&op=ruleDetail" clstag="pageclick|keycount|rule_home|46">【帮助解读】 看后秒懂，售前退款纠纷不该赔的咱不赔~</a>
                                </h3>
                                <div class="h-words" style="max-height: 80px;height:80px;text-overflow:ellipsis;overflow: hidden;display: inline-block">
                                    <a href="index.php?ctl=Index&met=rule&op=ruleDetail" clstag="pageclick|keycount|rule_home|47"> 前些时间商家应该都通过各个渠道了解到商家后台“取消订单管理”模块在9月上线了一些新功能，比如商品出库后取消订单的审核时效由7个自然日缩短为3个自然日(春节国庆长假期间不计时):</a>
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
                !-->
                <!-- id-rulesub -->

            </div>

        </div>
    </div>

<!--    <script>-->
<!--        document.querySelector("#id-newrule>a").innerHTML = new Date().getMonth() + 1 + "月新规";-->
<!--    </script>-->
    <script src="<?= $this->view->js ?>/helpcenter.js"></script>
<script>
    //搜索
    $('#submit_btn').click(function () {
       var text = $(" input[ name='title' ] ").val();
        window.location.replace('<?= YLB_Registry::get('url') . '?ctl=Help&met=ruleOverview&title=' ?>'+text);
    })
</script>
<?php include $this->view->getTplPath() . '/' . 'footer.php'; ?>