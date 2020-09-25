
$(function() {
    $.getJSON(ApiUrl + "?ctl=Buyer_Service_Consult&met=index&typ=json",function (e) {
        var data = e.data;
        var scHtml = template.render('tz_res', data);
        $('.contain1').html(scHtml);

    });
})

//类型选择
function rule(th)
{
        var  z_type = $(th).data('type');
        $.post(ApiUrl+'/index.php?ctl=Buyer_Service_Consult&met=index&typ=json',{'state':z_type},function(result){
            if(result.status == 200)
            {
                var data = result.data;
                var scHtml = template.render('tz_res',data);
                $('.contain1').html(scHtml);
            }
        });

}
$('.contain_top').each(function(){
    if($(this).find('input[name="message_id"]').prop('checked')){
        alert(($(this).find('input').val()));
    }
});
