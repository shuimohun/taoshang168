var  realname;
$(function(){
    var e = getCookie("key");

    if(!e)
    {
        window.location.href = WapSiteUrl+'/tmpl/member/login.html';
        return;
    }

    $.ajax({
        url:PayCenterApiUrl+'?ctl=Info&met=bindUserCardForApp&typ=json',
        type:'post',
        dataType:'json',
        success:function(result)
        {
            console.log(result.data);
            if(result.status == 200)
            {
                var data = result.data;
                if(!data.user_info.user_realname)
                {
                    window.location.href = WapSiteUrl+'/tmpl/member/realname.html';
                    return;
                }
                else if(!data.user_info.user_mobile)
                {
                    window.location.href = WapSiteUrl+'/tmpl/member/addphone.html';
                    return;
                }
                else if(data.shop_company)
                {
                    alert('商家账户请直接去转账或提现界面');
                    window.location.href=WapSiteUrl+'/tmpl/member/money_index.html';
                    return;
                }

                var listHtml = template.render('bank_list',data);
                $('#bank_id').html(listHtml);
                $('#re_name').val(data.user_info.user_realname);
                realname = data.user_info.user_realname;

            }
        }
    });

       var card_upload = new UploadImage({
           thumbnailWidth: 375,
           thumbnailHeight: 250,
           imageContainer: '#card_image',
           uploadButton: '#card_upload',
           inputHidden:'#card_logo'
       });
});

$('.next').click(function(){

    var bank_account_number = $('#card_id').val();
    var bank_id = $("#bank_id option:selected").val();
    var bank_name = $("#bank_id option:selected").text();
    var card_img = $('#card_logo').val();
    var regu =/^([1-9]{1})(\d{15}|\d{18})$/;
    var re = new RegExp(regu);
    if(re.test(bank_account_number))
    {
        var bankCardData ={bank_account_number:bank_account_number,bank_id:bank_id,bank_name:bank_name,card_img:card_img,realname:realname};
        //添加cookie生存时间1小时
        addCookie('bankCardData',JSON.stringify(bankCardData),1);
        window.location.href= WapSiteUrl+'/tmpl/member/addcard2.html';
        return;
    }
    else
    {
        alert('卡号输入有误');
        return;
    }
});
