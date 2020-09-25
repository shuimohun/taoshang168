
$(function(){

    var url = window.location.search;
    var infor =  url.substr(1);
    var infor_row= infor.split('&');
    var infor_i = infor_row[0].split('=');
    var infor_id = infor_i[1];
    if(infor_row[1]!=undefined){
        var infor_t = infor_row[1].split('=');
        var infor_type= infor_t[1];
    }
    var name = '';
    var img = '';
       if(infor_id==''&&infor_type==''){
            alert('没有咨询id，请仔细查看');
            history.go(-1);
       }else{
           $.getJSON(ApiUrl + "?ctl=Information_Reply&met=get&typ=json",{article_id:infor_id},function (e) {
               var data = e.data;
               var html = template.render('comm_s', data);
               $('.comm').html(html);
           });
           $.getJSON(ApiUrl + "?ctl=Information_Base&met=get&typ=json",{information_id:infor_id,information_group_id:infor_type},function (e) {
               var data = e.data;
               var infou_count;
               if(data.infou_count==null){
                   infou_count =  0;
               }else{
                   infou_count =  data.infou_count;
               }

               name = data.information_title;
               img = data.information_pic;
               var html = '' +
                   '<div class="title">'+data.information_title+'</div>'
                   +' <div class="title_date">'+data.information_add_time+'</div>'
                   +' <div class="contain_img"><img src="'+data.information_pic+'" alt=""></div>'
                   +' <div class="contain_artical">'+data.information_desc+'</div>'
               $('.contain').html(html);

           });
           //调用
           $("body").delegate(".greeWith","click", function(){
               greeWithClick($(this));
           })
       }
    $('.but').on('click',function(){
        if($('#review').val()!=''){
            var content = $('#review').val();
            $.getJSON(ApiUrl + "?ctl=Information_Reply&met=add&typ=json",{information_id:infor_id,information_reply_content:content},function (e) {
                if(e.status == 200){
                var html = '' +
                '<div class="comment">'
                    +'<div class="comment_img"><img src="'+e.data.user_logo+'" alt=""></div>'
                    +'<span>'+e.data.user_name+'</span>'
                    +'<i>'+e.data.article_reply_content+'</i>'
                    +'<em>'+e.data.article_reply_time+'</em>'
                    +'</div>';
                    $('.comm').before(html);
                    //评论成功后，清除评论框里的内容
                    $('#review').val('');
                }else{
                   alert(e.msg);
                   return false;
                }
            });
        }else{
            alert(e.msg);
            return false;
        }
    })

    // //点赞
    // function greeWithClick(icon){
    //
    //     if(icon.attr('src') == "./img/zan.png"){
    //
    //         var infor_id = icon.attr('infor_id');
    //         $.getJSON(ApiUrl + "?ctl=Information_Like&met=like&typ=json",{information_id:infor_id},function (e) {
    //             if(e.status == 200){
    //                 icon.attr('src','./img/zan_on.png');
    //             }
    //         });
    //         android.like(infor_id);
    //     }
    //     else if(icon.attr('src') == "./img/zan_on.png"){
    //
    //         var infor_id = icon.attr('infor_id');
    //         $.getJSON(ApiUrl + "?ctl=Information_Like&met=unLike&typ=json",{information_id:infor_id},function (e) {
    //             if(e.status == 200){
    //                 icon.attr('src','./img/zan.png');
    //             }
    //         });
    //         android.unlike(infor_id);
    //     }
    // }

})

// function  biaoti(id) {
//     $.getJSON(ApiUrl + "?ctl=Api_Information_Base&met=informationBaseList&typ=json",{'information_group':id},function (e) {
//         var data = e.data;
//         var scHtml = template.render('item_m', data);
//         $('.item_i').html(scHtml);
//     });
//
// }