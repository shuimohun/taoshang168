<?php if (!defined('ROOT_PATH')){exit('No Permission');}

include $this->view->getTplPath() . '/' . 'buyer_header.php';
?>
<link rel="stylesheet" href="<?= $this->view->css ?>/buyer_say.css">
<!--<link rel="stylesheet" type="text/css" href="<?/*= $this->view->css_com */?>/jquery/plugins/dialog/green.css" />-->
<style>
    p{display:block;-webkit-margin-before:1em;-webkit-margin-after:1em;-webkit-margin-start:0;-webkit-margin-end:0}
    .share{width:98px;height:18px;border:1px solid #c51e1e;font-size:12px;line-height:19px;color:#c51e1e;text-align:center}
    .share_wrap{display:inline-block;float:left;margin-left:20%;margin-top:3px;margin-bottom:4px}
    .share u{text-decoration:none;background-color:#c51e1e;color:#fff;float:right;width:48px;height:100%;text-align:center}
    .sub{float:right;font-size:12px;margin-top:-2px;color:#999}
    .goods_shared_price{color:red;margin-top:-2px;float:left}
    #sharecover{position:fixed;top:0;left:0;z-index:9999;width:100%;height:100%; background: rgba(0,0,0,0.5);}
    #code{position:absolute;left:45%;top:22%;z-index:9999;display:none;width:240px;height:240px;border-radius:10px;background-color:#fff}

</style>
    <div id="sharecover" style="display:none;">
    </div>
    <div id="code" style="height: 230px;">

    </div>
    <div class="member_infor_content">

        <div class="say_main">
            <div class="say_main_list">
                <div class="say_list_title">
                    <span class="user_tx"><img src="<?= $data['user_image'] ?>" alt=""></span>
                    <span class="user_name"><?= $data['user_name']?></span>
                    <span class="user_gz"><?= $data['friend']?$data['friend']:0?>关注</span>
                    <span class="user_wz"><?= $data['information_count']?$data['information_count']:0?>篇文章</span>
                </div>
                <?php if ($data['user_info']['user_punish_type']==0):?>
                <form action="" enctype="multipart/form-data" id="form" name="form" method="post" class="nice-validator n-yellow" novalidate="novalidate">                <div class="post_main">
                    <div class="post_item post_title">
                        <div class="post_l">帖子标题：</div>
                        <div class="post_r">
                            <input type="text" class="post_input"  <?php if( $data['information_info'] ){ ?> value="<?= $data['information_info']['information_title'] ?>" <?php }?> id="information_title">
                        </div>
                    </div>
                        <div class="post_item">
                            <div class="post_l">主图：</div>
                            <div class="post_r">
                                <?php if( $data['information_info'] && $data['information_info']['information_pic'] ){?>
                                    <img id="upload_img" src="<?=$data['information_info']['information_pic']?>">
                                <?php }else{?>
                                    <img id="upload_img">
                                <?php }?>
                                <a id="upload_btn" class="js-file-picker" style="height: 43px;height: 57px;border: none;">
                                    <i class="iconfont icon-jia"></i><?=_('主图')?>
                                </a>
                                <?php if( $data['information_info'] && $data['information_info']['information_pic'] ){?>
                                    <input type="hidden" class="post_file_input " value="<?=$data['information_info']['information_pic']?>" id="information_pic" name="information_pic">
                                <?php }else{?>
                                    <input type="hidden" class="post_file_input " id="information_pic" name="information_pic">
                                <?php }?>
                            </div>
                        </div>

                        <div class="post_item post_uditor">
                        <div class="post_l">帖子内容：</div>
                        <div class="post_r">
                            <!-- 加载编辑器的容器 -->
                            <script id="container" name="content" type="text/plain"> </script>
                            <!-- 配置文件 -->
                            <script type="text/javascript" src="<?= $this->view->js_com ?>/ueditor/ueditor.config.js"></script>
                            <!-- 编辑器源码文件 -->
                            <script type="text/javascript" src="<?= $this->view->js_com ?>/ueditor/ueditor.all.js"></script>
                            <!-- 实例化编辑器 -->
                            <script type="text/javascript">
                                var ue = UE.getEditor('container',{
                                    toolbars: [
                                        [
                                            /*'anchor', //锚点*/
                                            'undo', //撤销
                                           /* 'redo', //重做*/
                                            'bold', //加粗
                                            'indent', //首行缩进
                                           /* 'snapscreen', //截图*/
                                            'italic', //斜体
                                            'underline', //下划线
                                            'strikethrough', //删除线
//                                            'subscript', //下标
                                           /* 'fontborder', //字符边框*/
//                                            'superscript', //上标
                                            'formatmatch', //格式刷
                                            'source', //源代码
                                           /* 'blockquote', //引用
                                            'pasteplain', //纯文本粘贴模式*/
                                            'selectall', //全选
                                            'print', //打印
                                            'preview', //预览
                                            'horizontal', //分隔线
                                           /* 'removeformat', //清除格式
                                            'time', //时间
                                            'date', //日期*/
                                            'unlink', //取消链接
//                                            'insertrow', //前插入行
//                                            'insertcol', //前插入列
//                                            'mergeright', //右合并单元格
//                                            'mergedown', //下合并单元格
//                                            'deleterow', //删除行
//                                            'deletecol', //删除列
//                                            'splittorows', //拆分成行
//                                            'splittocols', //拆分成列
//                                            'splittocells', //完全拆分单元格
//                                            'deletecaption', //删除表格标题
//                                            'inserttitle', //插入标题
//                                            'mergecells', //合并多个单元格
//                                            'deletetable', //删除表格
                                          /*  'cleardoc', //清空文档
                                            'insertparagraphbeforetable', //"表格前插入行"
                                            'insertcode', //代码语言*/
                                            /*'fontfamily', //字体*/
                                            'fontsize', //字号
                                            /*'paragraph', //段落格式*/
                                            'simpleupload', //单图上传
                                            /*'insertimage', //多图上传*/
//                                            'edittable', //表格属性
//                                            'edittd', //单元格属性
//                                            'link', //超链接
//                                            'emotion', //表情
                                           /* 'spechars', //特殊字符
                                            'searchreplace', //查询替换*/
                                           /* 'map', //Baidu地图
                                            'gmap', //Google地图*/
                                            'insertvideo', //视频
                                           /* 'help', //帮助*/
                                            'justifyleft', //居左对齐
                                            'justifyright', //居右对齐
                                            'justifycenter', //居中对齐
                                            'justifyjustify', //两端对齐
                                            'forecolor', //字体颜色
//                                            'backcolor', //背景色
                                            'insertorderedlist', //有序列表
                                            'insertunorderedlist', //无序列表
                                            'fullscreen', //全屏
//                                            'directionalityltr', //从左向右输入
//                                            'directionalityrtl', //从右向左输入
                                            'rowspacingtop', //段前距
                                            'rowspacingbottom', //段后距
                                            'pagebreak', //分页
                                           /* 'insertframe', //插入Iframe
                                            'imagenone', //默认
                                            'imageleft', //左浮动
                                            'imageright', //右浮动
                                            'attachment', //附件*/
                                            'imagecenter', //居中
                                            'wordimage', //图片转存
                                            'lineheight', //行间距
                                          /*  'edittip ', //编辑提示
                                            'customstyle', //自定义标题
                                            'autotypeset', //自动排版
                                            'webapp', //百度应用
                                            'touppercase', //字母大写
                                            'tolowercase', //字母小写*/
//                                            'background', //背景
                                           /* 'template', //模板
                                            'scrawl', //涂鸦
                                            'music', //音乐*/
//                                            'inserttable', //插入表格
//                                            'drafts', // 从草稿箱加载
//                                            'charts', // 图表



                                        ]
                                    ],
                                    autoHeightEnabled: false,
                                    autoFloatEnabled: true
                                });

                                ue.addListener('afterUpVideo',function(t, arg) {
                                });
                            </script>
                        </div>
                    </div>
                    <div class="post_item" id="append_goods_list">
                        <div class="post_l">推荐我喜欢的商品：</div>
                        <?php if( ( $data['information_info'] && count($data['information_info']['information_goods_recommend']) !=4 ) || !$data['information_info']  ){?>
                            <div class="post_r post_file post_file_goods">
                                <input class="post_file_input">
                            </div>
                        <?php }?>
                        <?php if( $data['information_info'] && count($data['information_info']['information_goods_recommend']) ==4 ){
                                foreach ( $data['information_info'][information_goods_recommend] as $k=>$v){ ?>
                                    <div class="post_r post_file_goods" style="margin-left:5px;">
                                        <img src="<?=$v['goods_info']['goods_image']?>" width="150px" alt="">
                                    </div>
                        <?php }}else if( ( $data['information_info'] && count($data['information_info']['information_goods_recommend']) != 4 ) || !$data['information_info']){ ?>
                            <div id="append_goods">
                                <?php foreach ( $data['information_info'][information_goods_recommend] as $k=>$v ){?>
                                    <div class="post_r post_file_goods" style="margin-left:5px;">
                                        <img src="<?=$v['goods_info']['goods_image']?>" width="150px" alt="">
                                    </div>
                                <?php }?>
                            </div>
                        <?php }?>
                    </div>
                            <input type="hidden" id="information_goods_recommend">
                    <div class="post_item">
                        <div class="post_l">添加到板块：</div>
                        <div class="post_r post_block">
                            <ul class="clearfix" style="width: 800px">
                                <?php foreach ($group['items'] as $v):?>
                                <li><?= $v['information_group_title']?> <input type="radio" name="block" data-id="<?= $v['information_group_id']?>"></li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </div>
                </form>
                    <div class="post_item post_item_share">
                        <div class="post_l">&nbsp;</div>
                        <div class="post_r">
                            <ul class="clearfix">
                                <li><a href="javascript:void(0)"><img src="<?= $this->view->img ?>/sqq.jpg" alt="" alt=""></a></li>
                                <li><a href="javascript:void(0)"><img src="<?= $this->view->img ?>/qzone.jpg" alt="" alt=""></a></li>
                                <li><a href="javascript:void(0)"><img src="<?= $this->view->img ?>/wx_single.jpg" alt="" alt=""></a></li>
                                <li><a href="javascript:void(0)"><img src="<?= $this->view->img ?>/wx_timeline.jpg" alt="" alt=""></a></li>
                                <li><a href="javascript:void(0)"><img src="<?= $this->view->img ?>/weibo.jpg" alt="" alt=""></a></li>
                            </ul>
                            <p class="share_must">*发布前请至少分享一个渠道</p>
                        </div>
                    </div>
                    <div class="post_item">
                        <div class="post_l">&nbsp;</div>
                        <div class="post_r">
                            <a id="publish" href="#" class="fb_btn">
                               <?php if( $data['information_info'] ){?>
                                   修改
                               <?php }else{?>
                                   发布
                                <?php }?>
                            </a>
<!--                            <a href="#" class="save_btn">保存草稿</a>-->
                        </div>
                    </div>
                <?php else:?>
                <div style="height: 800px;width: auto;font-size: 24px;text-align: center;line-height: 393px;">
                    您已被封号至<?= $data['user_info']['punish_end_time']?>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>

    <!--添加商品链接弹框 start-->
    <div class="alert_goods">
        <div class="mask"></div>
        <div class="alt_main">
            <div class="alt_tab">
                <ul class="clearfix" id="goods_group">
                    <?php if (Perm::$shopId):?>
                    <li data-id="7" class="on"><a href="#">店铺</a></li>
                    <?php endif;?>
                    <?php if (!empty($ifdirectseller)):?>
                    <li data-id="6"><a href="#">淘金</a></li>
                    <?php endif;?>
                    <li data-id="0"><a href="#">新人</a></li>
                    <li data-id="1"><a href="#">惠抢购</a></li>
                    <li data-id="2"><a href="#">劲爆折扣</a></li>
                    <li data-id="3"><a href="#">送福</a></li>
                    <li data-id="4"><a href="#">优惠套餐</a></li>
                    <li data-id="5"><a href="#">商品</a></li>
                </ul>
            </div>
            <div class="alt_search clearfix">
                <input class="alt_input" type="text"><a href="#" class="alt_search_btn"></a>
                <div class="choose_goods">
                    <ul class="clearfix" id="choose_list">
                        <?php if( $data['information_info'] && count( $data['information_info']['information_goods_recommend'] )>0 ){
                            foreach ( $data['information_info']['information_goods_recommend'] as $k => $v){ ?>
                            <li class="goods_choose_list_id" onclick="del_recommend_goods(this,<?=$v[0]?>);">
                                <img src="<?=$v['goods_info']['goods_image']?>" alt="">
                            </li>
                            <input type="hidden" name="recommend_id[]" value="<?=$v[0]?>" />
                            <input type="hidden" name="recommend_price[]" value="<?=$v['goods_info']['goods_price']?>">
                        <?php }}?>
                    </ul>
                </div>
            </div>
            <div class="alt_goods_list">
                <div class="ul_wrap">
                    <ul class="clearfix" id="goods_list_html">

                    </ul>
                </div>
                <!--分页器start-->
                <div class="page_wrap">
                    <div class="flip page page_front clearfix" style="text-align: center;width: 500px;">
                    </div>
                </div>
                <!--分页器end-->
            </div>

            <div class="alt_btns">
                <a href="#" class="qx_btn">取消</a>
                <a href="#" class="sure_btn">确定</a>
            </div>
        </div>
    </div>

<script type="text/html" id="goods_list">
    <%for(var i in items){%>
    <li data-id="<%= items[i].goods_id%>">
        <a href="javascript:void(0)">
            <div class="pic_wrap"><img class="goods_pic" src="<%= items[i].goods_image%>" alt=""></div>
            <p class="goods_tit"><%= items[i].goods_name %></p>
            <div class="clearfix">
                <span class="share_reduce fl clearfix">减<i>￥<%= items[i].goods_share_price%></i></span>
                <span class="share_reduce fr clearfix">赚<i>￥<%= items[i].goods_promotion_price%></i></span>
            </div>
            <div class="price_wrap clearfix">
                <p class="goods_price fl">￥<%= items[i].discount_price?items[i].discount_price:(items[i].scarebuy_price?items[i].scarebuy_price:(items[i].newbuyer_price?items[i].newbuyer_price:(items[i].goods_price?items[i].goods_price:items[i].bundling_goods_price)))%></p>
                <p class="goods_sale_num fr">销量:<%= items[i].goods_salenum %></p>
            </div>
        </a>
    </li>
    <%}%>
</script>
<script type="text/javascript" src="<?=$this->view->js_com?>/webuploader.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/upload/upload_image.js" charset="utf-8"></script>
<link href="<?= $this->view->css_com ?>/webuploader.css" rel="stylesheet" type="text/css">
    <!--添加商品链接弹框 end-->
    <script>

        $(function () {
            new UploadImage({
                thumbnailWidth:300,
                thumbnailHeight:300,
                imageContainer: '#upload_img',
                uploadButton: '#upload_btn',
                inputHidden: '#information_pic'
            });
        })
        var act_id = getQueryString("information_id");
        ue.ready(function () {
            <?php if( $data['information_info']){?>
            ue.setContent('<?=$data['information_info']['information_desc']?>');
            <?php }?>
        });

        //分享微信，qq等五个分享渠道点击切换图
        share_index = null;
        $(".post_item_share ul li:eq(0) img").click(function(){
            if($(this).attr("src") == "<?= $this->view->img ?>/sqq.jpg"){
                share_index = 0;
                $(this).attr('src', '<?= $this->view->img ?>/sqq.png');
                $(".post_item_share ul li:eq(1) img").attr('src', '<?= $this->view->img ?>/qzone.jpg');
                $(".post_item_share ul li:eq(2) img").attr('src', '<?= $this->view->img ?>/wx_single.jpg');
                $(".post_item_share ul li:eq(3) img").attr('src', '<?= $this->view->img ?>/wx_timeline.jpg');
                $(".post_item_share ul li:eq(4) img").attr('src', '<?= $this->view->img ?>/weibo.jpg');
            }else{
                share_index = null;
                $(this).attr('src', '<?= $this->view->img ?>/sqq.jpg');
            }
        });
        $(".post_item_share ul li:eq(1) img").click(function(){
            if($(this).attr("src") == "<?= $this->view->img ?>/qzone.jpg"){
                share_index = 1;
                $(this).attr('src', '<?= $this->view->img ?>/qzone.png');
                $(".post_item_share ul li:eq(0) img").attr('src', '<?= $this->view->img ?>/sqq.jpg');
                $(".post_item_share ul li:eq(2) img").attr('src', '<?= $this->view->img ?>/wx_single.jpg');
                $(".post_item_share ul li:eq(3) img").attr('src', '<?= $this->view->img ?>/wx_timeline.jpg');
                $(".post_item_share ul li:eq(4) img").attr('src', '<?= $this->view->img ?>/weibo.jpg');
            }else{
                share_index = null;
                $(this).attr('src', '<?= $this->view->img ?>/qzone.jpg');
            }
        });
        $(".post_item_share ul li:eq(2) img").click(function(){
            if($(this).attr("src") == "<?= $this->view->img ?>/wx_single.jpg"){
                share_index = 2;
                $(this).attr('src', '<?= $this->view->img ?>/wx.png');
                $(".post_item_share ul li:eq(0) img").attr('src', '<?= $this->view->img ?>/sqq.jpg');
                $(".post_item_share ul li:eq(1) img").attr('src', '<?= $this->view->img ?>/qzone.jpg');
                $(".post_item_share ul li:eq(3) img").attr('src', '<?= $this->view->img ?>/wx_timeline.jpg');
                $(".post_item_share ul li:eq(4) img").attr('src', '<?= $this->view->img ?>/weibo.jpg');
            }else{
                share_index = null;
                $(this).attr('src', '<?= $this->view->img ?>/wx_single.jpg');
            }
        });
        $(".post_item_share ul li:eq(3) img").click(function(){
            if($(this).attr("src") == "<?= $this->view->img ?>/wx_timeline.jpg"){
                share_index = 3;
                $(this).attr('src', '<?= $this->view->img ?>/wx_timeline.png');
                $(".post_item_share ul li:eq(0) img").attr('src', '<?= $this->view->img ?>/sqq.jpg');
                $(".post_item_share ul li:eq(1) img").attr('src', '<?= $this->view->img ?>/qzone.jpg');
                $(".post_item_share ul li:eq(2) img").attr('src', '<?= $this->view->img ?>/wx_single.jpg');
                $(".post_item_share ul li:eq(4) img").attr('src', '<?= $this->view->img ?>/weibo.jpg');
            }else{
                share_index = null;
                $(this).attr('src', '<?= $this->view->img ?>/wx_timeline.jpg');
            }
        });
        $(".post_item_share ul li:eq(4) img").click(function(){
            if($(this).attr("src") == "<?= $this->view->img ?>/weibo.jpg"){
                share_index = 4;
                $(this).attr('src', '<?= $this->view->img ?>/tsina.png');
                $(".post_item_share ul li:eq(0) img").attr('src', '<?= $this->view->img ?>/sqq.jpg');
                $(".post_item_share ul li:eq(1) img").attr('src', '<?= $this->view->img ?>/qzone.jpg');
                $(".post_item_share ul li:eq(2) img").attr('src', '<?= $this->view->img ?>/wx_single.jpg');
                $(".post_item_share ul li:eq(3) img").attr('src', '<?= $this->view->img ?>/wx_timeline.jpg');
            }else{
                share_index = null;
                $(this).attr('src', '<?= $this->view->img ?>/weibo.jpg');
            }
        });
        //添加商品链接  弹框控制
        $(".post_file_goods").click(function(){
            // if( $('#choose_list li').size() < 4 ){
            $(".alert_goods").css({"display":"block"});
            // }
            goods_group_id = $('#goods_group li').eq(0).attr('data-id');
            page =1 ;
            goods_name = null;
            getGoodsList();
        });
        $(".qx_btn").click(function(){
            $(".alert_goods").css({"display":"none"});
        });
        $(".sure_btn").click(function(){
            $(".alert_goods").css({"display":"none"});
        });

        $('#goods_group li').click(function () {
            if($(this).hasClass("on")){

            }else{
                $(this).addClass("on").siblings().removeClass('on');
            }
            $('#goods_list_html').html('');
            goods_group_id = $(this).attr('data-id');
            page = 1;
            goods_name = null;
            getGoodsList();
        });
        $('.alt_search_btn').click(function () {
            page = 1;
            goods_name = $('.alt_input').val();
            getGoodsList();
        });
        //分页

        function getGoodsList() {
            $.post("?ctl=Information_Base&met=goods_recommend&typ=json", {goods_group_id:goods_group_id,page:page,goods_name:goods_name}, function (r) {
                if (r.status == 200) {
                    //分页
                    $('.page_front').html(r.data.page_nav);
                    //分页结束  2333
                    $('.page_front a').click(function () {
                        page = $(this).attr('data-page');
                        getGoodsList();
                    });
                    var goodsHtml = template.render('goods_list', r.data);
                    $('#goods_list_html').html(goodsHtml);
                    var text_append = '';
                    //弹框图片大小
                    var alt_img_W = $(".alt_goods_list ul li .goods_pic").width();
                    $(".alt_goods_list ul li .goods_pic").css({"height":alt_img_W+"px"})
                    // $(".alt_goods_list ul").css({"min-height":alt_img_W*2+"px"})

                    //添加商品链接 弹框 商品选中状态

                    $('#goods_list_html li').click(function () {
                        var goods_pic = $(this).find('img').attr('src');
                        var goods_price = $(this).find('.goods_price').html();
                        var goods_price = goods_price.substring(1);
                        goods_id = $(this).attr('data-id');
                        if($(this).hasClass("selected")){
                            alert('已选择此商品');
//                                    $(this).removeClass('selected');
                        }else{
                            if($('#choose_list li').size() <4 ){
                                $(this).addClass("selected");
                                text_append = '  <li class="goods_choose_list_id" onclick="del_recommend_goods(this,'+goods_id+');"><img src="'+goods_pic+'" alt=""><input name="recommend_id[]" type="hidden" value="'+goods_id+'"><input name="recommend_price[]" type="hidden" value="'+goods_price+'"></li>';
                                $('#choose_list').append(text_append);
                            }else{
                                alert('最多可推荐四个商品');
                            }
                        }
                    });

                }
            });
        };
        //选取推荐商品
        $('.sure_btn').click(function () {
            var goods_list_html = '';
            $('#append_goods').html('');
            $('.goods_choose_list_id img').each(function () {
                var img_src = $(this).attr('src');
                goods_list_html += '<div class="post_r post_file_goods" style="margin-left:5px;"><img src="'+img_src+'" width="150px" height="150px"> </div>';
            });
            var goods_count = $('.goods_choose_list_id img').size();
            if(goods_count<4){
                $('#append_goods').append(goods_list_html);
            }else{
                $('#append_goods_list').html('<div class="post_l">推荐我喜欢的商品：</div>'+goods_list_html+'<input class="post_file_input">');
                $('#append_goods').html();
            }
        });
        //取消推荐
        function del_recommend_goods(obj,goods_id) {
            $(obj).remove();
        }
        //发表帖子
        //seo 120个字

        $('#publish').click(function () {
            img = '';
            img = $("#information_pic").val();

            $("#information_pic").val(img);
            content = ue.getContent();
            information_title = $('#information_title').val();
            information_group_id = $("input[name='block']:checked").attr('data-id');
            txt_content = ue.getContentTxt();
            keyword = txt_content.substr(0,120);
            // 提交获取推荐商品
            information_goods_recommend = new Array();
            information_goods_recommend_type = new Array();
            $(" input[ name='recommend_id[]' ] ").each(function(){
                information_goods_recommend.push($(this).val());
            });
            $(" input[ name='recommend_price[]' ] ").each(function(){
                information_goods_recommend_type.push($(this).val());
            });
            //推荐商品结束
            // 发表条件
            if(content&&information_title&&information_group_id){
                if(information_goods_recommend.length !== 0 &&information_goods_recommend_type.length !== 0){
                    if(share_index == null){
                        alert('请选择一个分享渠道');
                    }else{
                        if(!$('#upload_img').attr("src")) {
                            alert('请添加一张主图');
                        }else{
                            addInformation();
                        }
                    }
                }else{
                    alert('请选择推荐商品');
                }
            }else{
                alert('请填写完整');
            }

        });
        function addInformation() {
            var postUrl = "?ctl=Information_Base&met=addInformationBase&typ=json";
            if( act_id )
            {
                postUrl = postUrl+'&act=edit&information_id='+act_id;
            }
            $.post(postUrl,
                {
                    information_pic:img,
                    keyword:keyword,
                    information_title:information_title,
                    content:content,
                    information_group_id:information_group_id,
                    information_goods_recommend:information_goods_recommend,
                    information_goods_recommend_type:information_goods_recommend_type
                }, function (r)  {
                    if(r.status == 200){

                        information_id = r.data.information_id;
                        information_title = r.data.information_title;
                        confirm('请分享完成发布');
                        url=SITE_URL+'?ctl=News&met=detail&id='+information_id;
                        wap_url = 'http://www.taos168.com/shop_wap/tmpl/information.html?information_id='+information_id;
                        qrcode = '<img src='+BASE_URL+'/shop/api/qrcode.php?data='+wap_url+' width="240" height="240" />';

                        switch(share_index)
                        {
                            //QQ
                            case 0:
                                window.open('http://connect.qq.com/widget/shareqq/index.html?url=' + encodeURIComponent(url) +'&title='+information_title);
                                break;
                            //QQ空间
                            case 1:
                                window.open('http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url='+ encodeURIComponent(url) +'&title='+information_title);
                                break;
                            //微信
                            case 2:
                                $('#code').attr('style','display:block');
                                $('#sharecover').attr('style','display:block');
                                $('#code').html(qrcode);
                                break;
                            //朋友圈
                            case 3:
                                $('#code').attr('style','display:block');
                                $('#sharecover').attr('style','display:block');
                                $('#code').html(qrcode);
                                break;
                            //微博
                            case 4:
                                window.open('http://service.weibo.com/share/share.php?url='+ encodeURIComponent(url) +'&title'+information_title);
                                break;

                        }
                    }
                })
        }

    </script>


<?php
include $this->view->getTplPath() . '/' . 'buyer_footer.php';
?>



