
function pl(i) {
    var _this = $(i);
    var key = getCookie("key");
    if( !key )
    {
        $.sDialog({
            'content':'关注说说，发文章、发视频、阅读、转发、点赞，赚金蛋换大奖下载app',
            'okBtnText':'去下载',
            okFn:function () {
                window.location.href = 'http://imtt.dd.qq.com/16891/9763DF5EEF112628260DD9BC55C193DE.apk?fsname=com.taoshang168.apk';
            }
        });
    }
    else
    {
        var infoId = _this.attr("data-inforId");
        $.ajax({
            type: 'post',
            url: ApiUrl + '?ctl=Information_Base&met=getVideoReply&typ=json',
            data:{id:infoId},
            dataType: 'json',
            async: false,
            success: function(e) {
                if( e.status == 200 )
                {
                    var pl = template.render("pl",e);
                    $(".pl").html(pl);

                    var text = '';
                    $('.pl').delegate('#pl_btn','change',function () {
                        text = $(this).val();
                    })
                    $(".pl_btn_a").on('click',function () {
                        var artId   = $(this).attr("data-ArtId");
                        InformationReply(artId,'',text);
                    })
                    next();
                }
            }
        })
        $(".discuss").css({"top":"0"});
    }
}
function  next() {
    //关闭评论弹框
    $(".discuss_close").click(function(){
        $(".discuss").css({"top":"100%"});
    });
    //点赞按钮
    /* $(".d_zan img").click(function(){
         if($(this).attr("src") == "../img/zan_white.png"){
             $(this).attr("src","../img/zan_blue.png");
         }else{
             $(this).attr("src","../img/zan_white.png");
         }
     });*/
    //回复按钮弹框
    $(".reply_btn").click(function(){
        var article_reply_id = $(this).attr("data-replyId");
        $.ajax({
            type: 'post',
            url: ApiUrl + '?ctl=Information_Base&met=getReply&typ=json',
            data:{reply_id:article_reply_id},
            dataType: 'json',
            async: false,
            success: function(e) {
                if( e.status ==200 )
                {
                    var hf = template.render("hf",e);
                    $(".hf").html(hf);
                    //获取评论回复
                    $(".relay_box").css({"top":"0","display":"block"});
                    $(".discuss").css({"top":"100%"});

                    $(".hf_btn_b").click(function () {
                        var artId   = $(this).attr("data-ArtId");
                        var replyId = $(this).attr("data-replyId");
                        var text    = $(".hf_btn").attr("value");
                        InformationReply(artId,replyId,text)
                    })

                    //关闭回复弹框
                    $(".relay_box .discuss_close").click(function(){
                        $(".relay_box").css({"top":"100%","display":"none"});
                        $(".discuss").css({"top":"0"});
                    })
                }
            }
        })

    });


}

function InformationReply( article_id,article_reply_id,text ) {
    var article_id          = article_id;
    var article_reply_id    = article_reply_id;
    var texts               = text;
    if( text.length <5){
        alert("评论不能少于5个字");
        return false;
    }
    if( article_id && !article_reply_id)
    {
        //评论资讯
        $.ajax({
            type: 'post',
            url: ApiUrl + '?ctl=News&met=addComment&typ=json',
            data:{id:article_id,text:text},
            dataType: 'json',
            async: false,
            success: function(e) {
                var reply =
                    ' <div class="discuss_item">' +
                    '<div class="left_tx">' +
                    '<img src="'+e.data.user_logo+'" onerror="this.src=\'../img/robot-ss.png\'" alt="">' +
                    ' </div>' +
                    '<div class="right_main">' +
                    '<div class="right_main_top clearfix">' +
                    '<p class="user_name fleft">'+e.data.user_name+'</p>' +
                    ' <!--<p class="d_zan fright"><img src="../img/zan_white.png" alt="">130</p>-->' +
                    ' </div>' +
                    '<div class="right_main_text">' +
                    '<p class="pl_text">'+e.data.article_reply_content+'</p>' +
                    '</div>' +
                    '<div class="bottom_time clearfix">' +
                    ' <span class="pl_time fleft">'+e.data.article_reply_time+'</span>' +
                    '<a class="reply_btn fleft" data-replyId="'+e.data.information_reply_id+'" href="javascript:;">0回复</a>' +
                    '<a href="javascript:;" onclick="remove(this,'+e.data.information_reply_id+')" data-replyId="'+e.data.information_reply_id+'" class="delete_btn fright">删除</a>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                $(".discuss_list_pl").prepend(reply);
                next()
            }

        })

    }
    else if( article_id && article_reply_id)
    {
        //资讯评论回复
        $.ajax({
            type: 'post',
            url: ApiUrl + '?ctl=News&met=replyComment&typ=json',
            data:{article_id:article_id,article_reply_id:article_reply_id,text:text},
            dataType: 'json',
            async: false,
            success: function(e) {

                var replyHf = '<div class="discuss_item">' +
                    '<div class="left_tx">' +
                    '<img src="'+e.data.user_logo+'" onerror="this.src=\'../img/robot-ss.png\'"  alt="">' +
                    '</div>' +
                    '<div class="right_main">' +
                    '<div class="right_main_top clearfix">' +
                    '<p class="user_name fleft">'+e.data.user_name+'</p>' +
                    '<!--<p class="d_zan fright"><img src="../img/zan_white.png" alt="">130</p>-->' +
                    '</div>' +
                    '<div class="right_main_text">' +
                    '<p class="pl_text">'+e.data.article_reply_content+'</p>' +
                    '</div>' +
                    '<div class="bottom_time clearfix">' +
                    '<span class="pl_time fleft">'+e.data.article_reply_time+'</span>' +
                    '<!--<a class="reply_btn fleft" href="javascript:;">回复</a>-->' +
                    '<a href="javascript:;"  onclick="remove(this,'+e.data.information_reply_id+')" data-replyId="<%=data.childrenRely[i].article_reply_id%>" class="delete_btn fright">' +
                    ' 删除' +
                    '</a>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                $(".discuss_list_hf").prepend(replyHf)
            }

        })

    }
}
function remove(i,article_reply_id) {
    var _this = $(i);
    var article_reply_id = article_reply_id;
    $.ajax({
        type: 'post',
        url: ApiUrl + '?ctl=Information_Base&met=removeReply&typ=json',
        data:{article_reply_id:article_reply_id},
        dataType: 'json',
        async: false,
        success: function(e) {

            if( e.status ==200 )
            {
                _this.parents(".discuss_item").remove();

            }
        }
    })

}
























