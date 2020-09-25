var help_group_id = getQueryString('help_group_id');
$(function(){
    if(help_group_id){
        $.ajax({
            url:ApiUrl+'?ctl=Api_App_HelpWap&met=wapHelpList&typ=json',
            data:{help_group_id:help_group_id},
            type:'post',
            dataType:'json',
            success:function(r){
                if(r.status == 200){
                    var d = r.data;
                    document.title = d.parentTitle;
                    var contHtml = template.render('cont',d);
                    $('body').html(contHtml);
                }
            }
        });
    }else{
        window.location.href = WapSiteUrl + "/index.html";
        return false;
    }
});