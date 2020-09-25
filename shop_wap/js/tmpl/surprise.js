var base_id=getQueryString('base_id');
var adv_key=getQueryString('adv_key');
$(function(){
    $.ajax({
        url:ApiUrl+'?ctl=Activity&met=oneFloor&typ=json',
        data:{base_id:base_id,adv_key:adv_key},
        type:'post',
        dataType:'json',
        success:function(r){
            if(r.status == 200){
                var data = r.data;
                document.title = data.temp_title;
                var contHtml = template.render('cont',data);
                $('body').html(contHtml);
            }else{
                window.location.href =  WapSiteUrl + "index.html";
                return;
            }
        }
    });
});