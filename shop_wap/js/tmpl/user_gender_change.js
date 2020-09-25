$(function(){
    var e = getCookie("key");
    //防止跳墙
    if(!e)
    {
        window.location.href = WapSiteUrl+"/tmpl/member/login.html";
        return;
    }
    $.ajax({
        typ:'get',
        url:ApiUrl+'/index.php?ctl=User_User&met=getUserInfo&typ=json',
        data:{k:e,u:getCookie('id')},
        dataType:"json",
        success:function(e)
        {
            var data = e.data.item;
            if(data.sex == '0')
            {
               $('#secret').parent().attr('class','cur');
               $('#secret').show();
               $('#woman').hide();
               $('#man').hide();
            }else if(data.sex == '1')
            {
                $('#woman').parent().attr('class','cur');
                $('#secret').hide();
                $('#woman').show();
                $('#man').hide();
            }else if(data.sex == '2'){
                $('#man').parent().attr('class','cur');
                $('#secret').hide();
                $('#woman').hide();
                $('#man').show();
            }
        }
    });

    $('#save').click(function(){
      var data = $('.cur').find('img').attr('id');
      if(data == 'man')
      {
          var sex = '2';
      }else if(data == 'woman')
      {
          var sex = '1';
      }else if(data == 'secret')
      {
          var sex = '0';
      }
     $.get(ApiUrl+'/index.php?ctl=User_User&met=ChangeSex&typ=json',{sex:sex},function(e){
         console.log(e);
         if(e.status == '200')
         {
             window.location.href = WapSiteUrl+'/tmpl/member/user_setup.html';
         }
         else if(e.status == '250')
             {
                 window.location.href = WapSiteUrl+'/tmpl/member/user_setup.html';
             }
     });
    });
});