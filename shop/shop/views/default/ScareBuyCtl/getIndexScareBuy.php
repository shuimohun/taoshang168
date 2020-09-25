<?php if(!empty($goods_today['items'])){?>
<div class="section">
    <div class="hqg_title">
        <div class="hqg_title_l hqg_title_d">
            <div class="hqg_title_flash">
                <span>限时限量 疯狂抢购</span>
            </div>
        </div>
        <div class="hqg_title_c hqg_title_d">
            <span>今日抢购</span>
        </div>
        <div class="hqg_title_r hqg_title_d">
            <div class="hqg_title_qg">
                <a href="<?=YLB_Registry::get('url')?>?ctl=ScareBuy&met=index" target="_blank"><span>惠抢购进行中</span></a>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="wrap2 h_goods_cont">
        <a class="lrwh btn1 iconfont" style="display: none;" data-numb="0">今日抢购</a>

        <ul class="goodsUl clearfix">
            <?php foreach ($goods_today['items'] as $key => $value) {?>
                <li>
                    <?php if($value){?>
                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$value['goods_id']?>" target="_blank" style="line-height:180px;">
                            <img style="max-width: 180px;max-height: 180px;" class="lazy" data-original="<?= $value['goods_image'] ?>"/>
                        </a>
                        <h5><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$value['goods_id']?>" target="_blank"><?= $value['goods_name'] ?></a></h5>
                        <p class="goods_pri">
                            <?=format_money($value['scarebuy_price']) ?> <del><?=format_money($value['goods_price']) ?></del>
                        </p>
                        <i><b class="zj"><img src="<?=$this->view->img?>/label_reduce_price_btn.png" alt=""></b><em>直降￥<?=$value['reduce']?></em></i>
                        <br>
                        <a class="share"><i><b><img src="<?=$this->view->img?>/label_share_save_btn.png" alt=""></b><em>分享立省￥<?=$value['goods_share_price']?></em></i></a>
                        <br>
                        <?php if($value['goods_is_promotion']){?>
                            <a class="share"><i><b><img src="<?=$this->view->img?>/label_share_save_btn.png" alt=""></b><em>分享立赚￥<?=$value['goods_promotion_price']?></em></i></a>
                        <?php }?>
                        <div class="qiang">
                            <div class="qiang_left">
                                <u><?=$value['sale_rate']?></u>
                                <u class="yq">已抢<?=$value['scarebuy_buy_quantity']?>件</u>
                                <div class="progress">
                                    <img src="<?=$this->view->img?>/rectangle@3x.png" alt="" width="<?=$value['sale_rate']?>">
                                </div>
                            </div>
                            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$value['goods_id']?>" target="_blank"><div class="qiang_right">立即抢</div></a>
                        </div>
                    <?php }?>
                </li>
            <?php }?>

            <?php foreach ($goods_tomorrow['items'] as $key => $value) {?>
                <li>
                    <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$value['goods_id']?>" target="_blank" style="line-height:180px;">
                        <img style="max-width: 180px;max-height: 180px;" src="<?= $value['goods_image'] ?>"/>
                    </a>
                    <h5>
                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$value['goods_id']?>" target="_blank">
                            <?= $value['goods_name'] ?>
                        </a>
                    </h5>
                    <p class="goods_pri">
                        <?=format_money($value['scarebuy_price']) ?> <del><?=format_money($value['goods_price']) ?></del>
                    </p>
                    <i><b class="zj"><img src="<?=$this->view->img?>/label_reduce_price_btn.png" alt=""></b><em>直降￥<?=$value['reduce']?></em></i>
                    <br>
                    <a class="share"><i><b><img src="<?=$this->view->img?>/label_share_save_btn.png" alt=""></b><em>分享立省￥<?=$value['goods_share_price']?></em></i></a>
                    <br>
                    <?php if($value['goods_is_promotion']){?>
                        <a class="share"><i><b><img src="<?=$this->view->img?>/label_share_save_btn.png" alt=""></b><em>分享立省￥<?=$value['goods_promotion_price']?></em></i></a>
                    <?php }?>
                    <div class="qiang">
                        <div class="qiang_left">
                            <u><?=$value['sale_rate']?></u>
                            <u class="yq">已抢<?=$value['scarebuy_buy_quantity']?>件</u>
                            <div class="progress">
                                <img src="<?=$this->view->img?>/rectangle@3x.png" alt="" width="<?=$value['sale_rate']?>">
                            </div>
                        </div>
                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$value['goods_id']?>" target="_blank"><div class="qiang_right">去看看</div></a>
                    </div>
                </li>
            <?php }?>
        </ul>
        <a class="lrwh btn2 iconfont  " data-num="0" style="<?php if(empty($goods_tomorrow['items'])){?>display: none;<?php }?>">明日预告</a>
    </div>
</div>
<script type="text/javascript" charset="utf-8">
    $(function() {
        //遍历商品背景色
        var arr=["#fff0f0","#fdf5f2","#f1f6ef","#f9f9f9","#f2fbff"];
        $.each($(".goodsUl li"),function(i,obj){
            if(i>=5){
                var thisindex=$(this).index();
                i=thisindex-Math.floor(thisindex/5)*5;
            }
            $(this).css("backgroundColor",arr[i])

        });
        //商品滚动
        function doMove(obj,attr,speed,target,callBack){
            if(obj.timer) return;
            var ww=obj.css(attr);
            var num = parseFloat(ww);
            speed = num > target ? -Math.abs(speed) : Math.abs(speed);
            obj.timer = setInterval(function (){
                num += speed;
                if( speed > 0 && num >= target || speed < 0 && num <= target  ){
                    num = target;
                    clearInterval(obj.timer);
                    obj.timer = null;
                    var mm=num+"px";
                    // obj.style[attr] = num + "px";
                    obj.css(attr,mm);
                    (typeof callBack === "function") && callBack();

                }else{
                    var mm=num+"px";
                    // obj.css(attr) = num + "px";
                    obj.css(attr,mm)
                }
            },30)
        }
        var m=0;

        $(".btn1").bind("click",function(){
            var W=$(this).parent().width();
            var goodsUl=$(this).parent().find(".goodsUl");
            var ali=goodsUl.find("li");
            var rightA=$(this).parent().find(".btn2");
            m=$(this).attr("data-numb");
            if(m<=0){
                m=0;
                return;
            }
            m--;
            $(this).attr("data-numb",m);
            rightA.attr("data-num",m);
            doMove(goodsUl,"left",30, -m*W);
            $(".btn1").hide();
            $(".btn2").show();
        });
        $(".btn2").bind("click",function(){
            var W=$(this).parent().width();
            var goodsUl=$(this).parent().find(".goodsUl");
            var ali=goodsUl.find("li");
            goodsUl.css("width",240*ali.length);
            var ulW=goodsUl.width();
            var nums=Math.ceil(ulW/W);
            var leftA=$(this).parent().find(".btn1");
            m=$(this).attr("data-num");
            if(m>=(nums-1)){
                return;
            }
            m++;
            $(this).attr("data-num",m);
            leftA.attr("data-numb",m);
            doMove(goodsUl,"left",30,-m*W);
            $(".btn1").show();
            $(".btn2").hide();
        });
        $("img.lazy",'.section').lazyload({skip_invisible : false,placeholder : "<?= $this->view->img ?>/grey.gif",threshold: 200,effect: "show",failurelimit : 10});
    });
</script>
<?php }?>