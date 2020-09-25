$(function(){
    $.ajax({
        url:ApiUrl+'?ctl=Api_App_HelpWap&met=wapHelpList&typ=json',
        type:'post',
        dataType:'json',
        success:function(r){
            if(r.status == 200){
                var d = r.data;
                var contHtml = template.render('cont',d);
                $('.appendCont').html(contHtml);
            }
        }
    });
});