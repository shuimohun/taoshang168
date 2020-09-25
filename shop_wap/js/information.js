$(function(){
    $('.list a').click(function(){
        $(this).addClass('cur').siblings().removeClass('cur');
    })
})

$(function(){
    $('#review').focusin(function(){
        if ($('#review').val() == '评论') {
            $('#review').val('');
        }
    });
    $('#review').focusout(function(){
        var review_val = $.trim($('#review').val());
        if (review_val == '') {
            $('#review').val('评论');
        }
    });
})
