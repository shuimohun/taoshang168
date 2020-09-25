var help_id = getQueryString('help_id');
$(function(){
   if(help_id){
        $.ajax({
            url:ApiUrl+'?ctl=Api_App_HelpWap&met=wapHelpList&typ=json',
            data:{help_id:help_id},
            type:'post',
            dataType:'json',
            success:function(r){
                if(r.status == 200){
                    var d = r.data;
                    document.title = d.help_title;
                    var contHtml = template.render('cont',d);
                    $('body').html(contHtml);
                    $('.contain').html(d.help_desc);
                    /*$('.title a').on('click',function(){
                      android.finish();
                    })*/
                }
            }
        });
   }else{
       window.location.href = WapSiteUrl + "/index.html";
       return false;
   }
   function hideheader(){
    $('header').hide();
    $('html,body').css({
      "margin-top" : "0"
    })
   }
});