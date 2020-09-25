$(function(){
    var e = getCookie("key");

    if(!e)
    {
        window.location.href = WapSiteUrl+'/tmpl/member/login.html';
        return;
    }

    $.ajax({
        url:PayCenterApiUrl+'?ctl=Info&met=getUserInfo&typ=json',
        type:'post',
        dataType:'json',
        success:function(result)
        {
            var data = result.data;

            if(data.user_info.user_identity_statu =='2'){

                window.location.href = WapSiteUrl+'/tmpl/member/money_index.html';
                return;
            }

            if(data.user_info.user_realname){

                $('#realname').val(data.user_info.user_realname);
            }
            if(data.user_info.user_account){

                $('#user_name').val(data.user_info.user_account);
            }
        }
    });

    var face_upload = new UploadImage({
        thumbnailWidth: 375,
        thumbnailHeight: 250,
        imageContainer: '#image_face',
        uploadButton: '#face_upload',
        inputHidden:'#user_identity_face_logo'
    });

    var font_upload = new UploadImage({
        thumbnailWidth: 375,
        thumbnailHeight: 250,
        imageContainer: '#image_font',
        uploadButton: '#font_upload',
        inputHidden:'#user_identity_font_logo'
    });
});

$('.next').click(function(){
    var realname = $('#realname').val();
    //判断中文姓名的正则表达式
    var rgu = /^[\u4e00-\u9fa5]+(·[\u4e00-\u9fa5]+)*$/;
    var re = new RegExp(rgu);
    if(!re.test(realname)) {
        alert('姓名输入错误');
        return;
    }

    if(!checkCard())
    {
        return false;
    }
    var user_identity_card      = $('#card_no').val();
    var user_identity_face_logo = $('#user_identity_face_logo').val();
    var user_identity_font_logo = $('#user_identity_font_logo').val();

    $.ajax({
        url:PayCenterApiUrl+'?ctl=Info&met=editCertification&typ=json',
        data:{user_realname:realname,user_identity_card:user_identity_card,user_identity_face_logo:user_identity_face_logo,user_identity_font_logo:user_identity_font_logo,user_identity_type:1},
        type:'post',
        dataType:'json',
        success:function(result)
        {
            if(result.status == 200)
            {
                alert('提交成功请等待审核');
                window.location.href = WapSiteUrl+'/tmpl/member/safety.html';
                return;
            }
            else
            {
                alert('提交失败');
                return false;
            }
        }
    });

    
});
