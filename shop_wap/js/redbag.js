$(function(){
    var e = getCookie("key");
    if(!e)
    {
        window.location.href = WapSiteUrl+"/tmpl/member/login.html";
        return;
    }
    $.ajax({
        url:ApiUrl+'/index.php?ctl=Points&met=pList&typ=json',
        type:'post',
        dataType:'json',
        success:function(result)
        {
            if(result.status == 200)
            {
                var data = result.data;
                $('.redbag_info_inner_left>span').html(data.user_info.user_name);
                $('.redbag_info_inner_left_img>img').attr('src',data.user_info.user_logo);
                $('.div_v').html('V'+data.user_info.user_grade);
                $('.div_v.u').html('V'+parseInt(parseInt(data.user_info.user_grade)+parseInt(1)));
                $('.progress>img').attr('width',parseInt((data.user_resource.user_growth/data.growth.grade_growth_end)*100)+'%');
                $('.redbag_info_inner>del').html(data.redPacket);
                $('.div_right>i').html(data.growth.next_grade_growth);
                $('.div_right>span').html(data.user_info.user_grade+1);

            }
            $.post(ApiUrl+'/index.php?ctl=RedPacket&met=redIndex&typ=json',{base:'unclaimed'},function(result){
                var data = result.data;

                if(result.status == 200)
                {
                    var redHtml = template.render('redPack',data);
                    $('.redbag_contain').append(redHtml);
                }
            });
        }
    });

});

//title点击页面显示
$('.title1').on('click',"li[class='cur']",function(){
    var type = $(this).attr('nctype');
    if(type == 'unclaimed')
    {
        $('.redbag_top').show();
    }
    else
    {
        $('.redbag_top').hide();
    }

});

//大标题点击事件
$('.title1').on('click',"[class='cur']",function(){
    var base = $(this).attr('nctype');
    if(base == 'unclaimed')
    {
        var tab = $('.redbag_top>.cur').attr('nctype');
    }

    $.ajax({
        url:ApiUrl+'/index.php?ctl=RedPacket&met=redIndex&typ=json',
        type:'post',
        data:{base:base,tab:tab},
        success:function(result)
        {
            var data = result.data;
            console.log(data);
            var redHtml = template.render('redPack',data);
            $('.redbag_contain').html(redHtml);
        }
    });
});

//小分类点击事件
$('.redbag_top').on('click',"[class='cur']",function(){
    var tab =　$(this).attr('nctype');
    var base = $('.title1>.cur').attr('nctype');
    $.ajax({
        url:ApiUrl+'/index.php?ctl=RedPacket&met=redIndex&typ=json',
        type:'post',
        data:{base:base,tab:tab},
        success:function(result)
        {
            var data = result.data;

            var redHtml = template.render('redPack',data);
            $('.redbag_contain').html(redHtml);
        }
    });
});

//立即税换点击
$('.redbag_contain').on('click',"a[nctype='shuihuan']",function(){
    var id = $(this).data('rtid');
    $('.tanchuang_top').html('确定要立即兑换？');
    $('.tanchuang').css('display','block');
    $('.bg_tanchuang').show();
    //点击确定按钮
    $('.ensure').click(function(){
        $.ajax({
            url:ApiUrl+'/index.php?ctl=RedPacket&met=getRedPacketById&typ=json',
            data:{id:id},
            type:'post',
            dataType:'json',
            success:function(result)
            {
                if(result.status == 200)
                {
                    var data = result.data, redpacket_t_eachlimit = data.redpacket_t_eachlimit;
                    var params = {
                        red_packet_t_id:id,
                        k:getCookie('key'),
                        u:getCookie('id')
                    };

                    $.ajax({
                        url:ApiUrl+"/index.php?ctl=RedPacket&met=receiveRedPacket&typ=json",
                        data: params,
                        type:'post',
                        dataType:'json',
                        success:function(data)
                        {
                            location.reload();
                        }
                    });

                }
            }
        });
    });
    //点击取消按钮
    $('.delete').click(function(){
        $('.bg_tanchuang').hide();
        $('.tanchuang').hide();
    });
});






