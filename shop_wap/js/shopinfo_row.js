$(function() {
    var hasmore = true;
    var pagesize = 12;
    var curpage = 0;
    var firstRow = 0;

    function  get_hot_goods(more) {
        param = {};
        param.firstRow = firstRow;
        $.getJSON(ApiUrl + "?ctl=Buyer_Message&met=message&typ=json",param,function (e) {
            var data = e.data;
            var scHtml = template.render('tz_res', data);
            if(more){
                $('.contain1').append(scHtml);
            }else{
                $('.contain1').html(scHtml);
            }
            curpage++;
            if(e.data.page < e.data.total){
                firstRow = curpage * pagesize;
                hasmore = true;
            }else{
                hasmore = false;
            }
        });
    }

    get_hot_goods();
    $(window).scroll(function (){
        if(hasmore) {
            if ($(window).scrollTop() + $(window).height() > $(document).height() - 1) {
                get_hot_goods(true);
            }
        }
    });
})

//查看消息
function look(id) {
    var type =  $('.cur').data('type');
    $.getJSON(ApiUrl+'?ctl=Buyer_Message&met=changeMessage&typ=json',{'id':id},function(result){
        if(result.status == 200)
        {
            rule('',type);
        }
    });
}
$('.ensure').click(function () {
    var zz =  $('.cur').data('type');
    text = $("input:checkbox[name='message']:checked").map(function(index,elem) {
        return $(elem).val();
    }).get().join(',');
    if(text==''){
        alert('请选择需要删除信息');
    }else{
        var type =  $('.cur').data('type');
        $.post(ApiUrl+'?ctl=Buyer_Message&met=delAllMessage&typ=json&type='+type,{'id':text},function(result){
            if(result && 200 == result.status) {
                alert('删除成功');
                $("#check1").attr("checked",false);
                rule('',result.data.type);
            } else {
                alert('删除失败');
            }
        });
    }

})


//类型选择
function rule(th,zhi)
{
    if(th==''&&zhi!=''){
        $.post(ApiUrl+'?ctl=Buyer_Message&met=messages&typ=json',{'type':zhi},function(result){
            if(result.status == 200)
            {
                var data = result.data;
                var scHtml = template.render('tz_res',data);
                $('.contain1').html(scHtml);
            }
        });
    }else{
        var  z_type = $(th).data('type');
        $.post(ApiUrl+'?ctl=Buyer_Message&met=messages&typ=json',{'type':z_type},function(result){
            if(result.status == 200)
            {
                var data = result.data;
                var scHtml = template.render('tz_res',data);
                $('.contain1').html(scHtml);
            }
        });
    }


}
$('.contain_top').each(function(){
    if($(this).find('input[name="message_id"]').prop('checked')){
        alert(($(this).find('input').val()));
    }
});
