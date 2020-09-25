function common_alert(){

    if ($('.info_alert').css('display') == 'none'){
        $('.info_alert').css({'display': 'block'});


        var $el = '<img src="../../images/user_img/choose_gray@3x.png" alt=""> <a href="../../index.html"><span><img src="../../images/user_img/more_home@2x.png" alt=""><u>商城首页</u></span></a><a href="../cart_list.html"><span><img src="../../images/user_img/more_cart@2x.png" alt=""><u>购物车</u></span></a><a href="../member/order_list.html"><span><img src="../../images/user_img/more_form@2x.png" alt=""><u>我的订单</u></span></a><a href="../member/chat_list.html"><span><img src="../../images/bbc-bg36.png" alt=""><u>消息</u></span></a>'

        $('.info_alert').html($el);
    }
    else{
        $('.info_alert').css({'display': 'none'});
    }
}
//针对首页活动
function common_index_alert(){

    if ($('.info_alert').css('display') == 'none'){
        $('.info_alert').css({'display': 'block'});


        var $el = '<img src="../images/user_img/choose_gray@3x.png" alt=""> <a href="../index.html"><span><img src="../images/user_img/more_home@2x.png" alt=""><u>商城首页</u></span></a><a href="../tmpl/cart_list.html"><span><img src="../images/user_img/more_cart@2x.png" alt=""><u>购物车</u></span></a><a href="../tmpl/member/order_list.html"><span><img src="../images/user_img/more_form@2x.png" alt=""><u>我的订单</u></span></a><a href="../tmpl/member/chat_list.html"><span><img src="../images/bbc-bg36.png" alt=""><u>消息</u></span></a>'

        $('.info_alert').html($el);
    }
    else{
        $('.info_alert').css({'display': 'none'});
    }
}