$(function(){
    ucenterLogin();
});

$(function(){
    if (getQueryString('key') != '') {
        var key = getQueryString('key');
        var username = getQueryString('username');
        addCookie('key', key);
        addCookie('username', username);
        updateCookieCart(key);
    } else {
        var key = getCookie('key');
    }
if(key)
{
  $.ajax({
      type:'post',
      url:ApiUrl+"/index.php?ctl=Buyer_User&met=getUserInfo&typ=json",
      data:{k:key,u:getCookie('id')},
      dataType:'json',
      success:function(result)
      {
          // $(".buy_list").css({'height':'1.8rem'});
          console.log(result.data);
          if(!result.data.user_logo)
          {
              //若没头像则为默认头像
              var user_log = '../../images/head.jpg';
          }
          else
          {
              var user_log = result.data.user_logo;
          }
          checkLogin(result.login);
          //若当前用户没有店铺id的时候
          if(!result.data.shop_id){
              var headerHtml = '<div class="title"><a href="user_setup.html"><img src="../../images/user_img/setting@3x.png" alt=""></a><span>个人中心</span><a href="javascript:void(0)"><img src="../../images/user_img/msg@3x.png" alt="" class="dialogbox" onclick="common_alert(this)"></a></div>'
                  + '<div class="info"><a href="user_setup.html"><img src="' +user_log+ '" ></a></div>'
                  + '<span class="word">'+result.data.user_name+'</span>'
                  + '<div class="v">V' + result.data.user_grade + '</div>';
          }else{
          var headerHtml = '<div class="title"><a href="user_setup.html"><img src="../../images/user_img/setting@3x.png" alt=""></a><span>个人中心</span><a href="javascript:void(0)"><img src="../../images/user_img/msg@3x.png" alt="" class="dialogbox" onclick="common_alert(this)"></a><a href="./sellerCenter.html"><img src="../../images/user_img/seller@3x.png" alt="" class="seller"></a></div>'
                         + '<div class="info"><a href="user_setup.html"><img src="' +user_log+ '" ></a></div>'
                         + '<span class="word">'+result.data.user_name+'</span>'
                         + '<div class="v">V' + result.data.user_grade + '</div>';
          }
          $('.person').html(headerHtml);

          var infoHtml = '<a href="favorites.html"><li class="five_"> <img src="../../images/user_img/favoriteg@3x.png" alt=""><span> 收藏的商品</span> </li></a>'
                        +'<a href="favorites_store.html"><li class="five_"> <img src="../../images/user_img/favorites@3x.png" alt=""> <span>收藏的店铺</span> </li></a>'
                        +'<a href="../sendbless_detail.html"><li class="five_"> <img src="../img/fu.png" alt=""> <span>送福免单</span> </li></a>'
                        +'<a href="views_list.html"><li class="five_"> <img src="../../images/user_img/2recently@3x.png" alt=""> <span>看过的商品</span> </li></a>'
                        +'<a href="../detail_gold.html"><li class="five_"> <img src="../../images/user_img/3reward@3x.png" alt=""><span class="aftersales"> 签到得金蛋</span> </li></a>';
          $('.info_list>ul').html(infoHtml);

          var buyHtml = '';
          if(result.data.order_wait_pay)
          {
              buyHtml+='<li><a href="order_list.html?data-state=wait_pay"><img src="../../images/user_img/shopping1@3x.png" alt=""><br> <span>待付款</span></a><span class="number">'+result.data.order_wait_pay+'</span></li>';
          }
          else
          {
              buyHtml+='<li><a href="order_list.html?data-state=wait_pay"><img src="../../images/user_img/shopping1@3x.png" alt=""><br> <span>待付款</span> </a></li>';
          }

          if(result.data.order_payed)
          {
              buyHtml+='<li><a href="order_list.html?data-state=order_payed"> <img src="../../images/user_img/shopping3@3x.png" alt=""><br> <span>待发货</span></a><span class="number">'+result.data.order_payed+'</span></li>'
          }
          else
          {
              buyHtml+='<li><a href="order_list.html?data-state=order_payed"> <img src="../../images/user_img/shopping3@3x.png" alt=""><br> <span>待发货</span></a></li>';
          }

          if(result.data.order_wait_confirm_goods)
          {
              buyHtml+='<li><a href="order_list.html?data-state=wait_confirm_goods"> <img src="../../images/user_img/shopping2@3x.png" alt=""><br> <span>待收货</span></a><span class="number">'+result.data.order_wait_confirm_goods+'</span></li>';
          }
          else
          {
              buyHtml+='<li><a href="order_list.html?data-state=wait_confirm_goods"> <img src="../../images/user_img/shopping2@3x.png" alt=""><br> <span>待收货</span></a></li>';
          }

          if(result.data.order_finish)
          {
              buyHtml+='<li><a href="order_list.html?data-state=finish"> <img src="../../images/user_img/shopping4@3x.png" alt=""><br> <span>待评价</span></a><span class="number">'+result.data.order_finish+'</span></li>';
          }
          else
          {
              buyHtml+='<li><a href="order_list.html?data-state=finish"> <img src="../../images/user_img/shopping4@3x.png" alt=""><br> <span>待评价</span></a></li>';
          }

          if(result.data.return_num)
          {
              buyHtml+='<li><a href="member_refund.html"> <img src="../../images/user_img/shopping5@3x.png" alt=""><br> <span>售后中</span></a><span class="number">'+result.data.return_num+'</span></li>';
          }
          else
          {
              buyHtml+='<li><a href="member_refund.html"> <img src="../../images/user_img/shopping5@3x.png" alt=""><br> <span>售后中</span></a></li>';
          }

          $('.buy_list.n>ul').html(buyHtml);

          $.post(PayCenterWapUrl+'/index.php?ctl=Info&met=share&typ=json&p=1',function(re){
              if(re.status == 200)
              {
                var html = '<div class="buy_list_title"> <img src="../../images/user_img/rectangle@3x.png" alt=""> <span>财付宝</span><u onclick="paycenter(this)">进入财付宝 ></u></div>'
                          +'<div class="money_number">'
                          +'<div class="money_info"> <a href="share.html"><b>'+re.data.user_share_price_total+'</b><br><span>分享立赚</span></a></div>'
                          +'<div class="money_info2"><a href="pay_savemoney.html"><b>'+re.data.save_total_money+'</b><br><span>汇省钱</span></a></div>'
                          +'<img src="../../images/user_img/line@2x.png" class="line">'
                          +'<div class="money_operate"> <a href="transfer.html"><img src="../../images/user_img/transfer@3x.png" alt=""><br> <span>转账</span></a> </div>'
                          +'<div class="money_operate"> <a href="alipay.html"><img src="../../images/user_img/Withdrawals@3x.png" alt=""><br> <span>提现</span></a> </div>'
                          +'</div>';
              }
              else
              {
                  var html = '<div class="buy_list_title"> <img src="../../images/user_img/rectangle@3x.png" alt=""> <span>财付宝</span><u onclick="paycenter(this)">进入财付宝 ></u> </div>';
              }

              $('.buy_list.m').html(html);
          });

          $.post(ApiUrl + "?ctl=Points&met=pList&typ=json",function(res){
              if(res.status == 200)
              {
                  var html = '<div class="buy_list_title"> <img src="../../images/user_img/rectangle@3x.png" alt=""> <span>红包卡券</span> <a href="../goldeggsbuy.html"><u>金蛋购 ></u></a> </div>'
                  +'<ul class="contain">'
                  +'<a href="../redbag.html"><li class="contain_li"> <b>'+res.data.redPacket+'</b><br> <span>平台红包</span></li></a>'
                  +'<a href="../voucher.html"><li class="contain_li"> <b>'+res.data.ava_voucher_num+'</b><br> <span>优惠券</span> </li></a>'
                  +'<a href="../detail_gold.html"><li class="contain_li"> <b>'+res.data.user_resource.user_points+'</b><br> <span>金蛋</span></li></a>'
                  +'<a href=""><li class="contain_li"> <b>'+res.data.points_order_num+'</b><br> <span>已兑换礼品</span></li></a>'
                  +'</ul>';
              }

              $('.buy_list.c').html(html);
          });
          $.post(ApiUrl + "?ctl=Buyer_Message&met=getnewmessage&typ=json",function(res) {
              if (res.status == 200){
                  var html_av = '<a href="../shopinfo.html"><li class="contain_li"> <b>' + res.data.count + '</b><br> <span>商城信息</span> </li></a>'
                      + '<li class="contain_li"> <b>' + 0 + '</b><br> <span>客服</span> </li>'
                      + '<a href="../refer.html"><li class="contain_li"> <b>' + res.data.consult_count + '</b><br> <span>咨询</span> </li></a>'
                      + '<a href="../fans-circle.html"><li class="contain_li"> <b>' + res.data.infor_count + '</b><br> <span>资讯</span> </li></a>';

              $('.contain.kefu').html(html_av);
            }
          });
          $.post(ApiUrl + "?ctl=Distribution_Buyer_Directseller&met=centerDirectseller&typ=json",function (res) {
             if(res.status == 200){
                 sifangqian = res.data.income_total?res.data.income_total:0;
                 taojinshangping = res.data.directseller_goods?res.data.directseller_goods:0;
                 jinrichengjiao = res.data.jinri?res.data.jinri:0;
                 mingxiataojinren = res.data.user_count?res.data.user_count:0;
                 var html_taojin = '<li class="contain_li"><b>'+ res.data.income_total+'</b><br><span>私房钱</span></li>'
                     +'<li class="contain_li"><b>'+ taojinshangping +'</b><br><span>淘金商品</span></li>'
                     +'<li class="contain_li"><b>'+ jinrichengjiao +'</b><br><span>今日成交</span></li>'
                     +'<li class="contain_li"><b>'+ mingxiataojinren +'</b><br><span>名下淘金人</span></li>';
             }
             $('#contain').html(html_taojin);
          });

      }
  });
}
else
{
    var headerHtml = '<div class="title"><a href="user_setup.html"><img src="../../images/user_img/setting@3x.png" alt=""></a><span>个人中心</span><a href="javascript:void(0)"><img src="../../images/user_img/msg@3x.png" alt="" class="dialogbox"  onclick="common_alert(this)"></a></div>'
                   + '<div class="info logbtn"><img src="../../images/head.jpg" ></div>'
                   + '<span class="word logbtn">未登录</span>';
    $('.person').html(headerHtml);

    var infoHtml = '<a href="favorites.html"><li> <img src="../../images/user_img/favoriteg@3x.png" alt=""><span> 收藏的商品</span> </li></a>'
                    +'<a href="favorites_store.html"><li> <img src="../../images/user_img/favorites@3x.png" alt=""> <span>收藏的店铺</span> </li></a>'
                    +'<a href="../sendbless_detail.html"><li class="five_"> <img src="../img/fu.png" alt=""> <span>送福免单</span> </li></a>'
                    +'<a href="views_list.html"><li> <img src="../../images/user_img/2recently@3x.png" alt=""> <span>看过的商品</span> </li></a>'
                    +'<a href="../detail_gold.html"><li> <img src="../../images/user_img/3reward@3x.png" alt=""><span class="aftersales"> 签到</span> </li></a>';
    $('.info_list>ul').html(infoHtml);

    var buyHtml = '<li><a href="javascript:void(0)" class="logbtn"><img src="../../images/user_img/shopping1@3x.png" alt=""><br> <span>待付款</span> </a></li>'
        +'<li><a href="javascript:void(0)" class="logbtn"> <img src="../../images/user_img/shopping3@3x.png" alt=""><br> <span>已付款</span></a></li>'
        +'<li><a href="javascript:void(0)" class="logbtn"> <img src="../../images/user_img/shopping2@3x.png" alt=""><br> <span>待收货</span></a></li>'
        +'<li><a href="javascript:void(0)" class="logbtn"> <img src="../../images/user_img/shopping4@3x.png" alt=""><br> <span>待评价</span></a></li>'
        +'<li><a href="javascript:void(0)" class="logbtn"> <img src="../../images/user_img/shopping5@3x.png" alt=""><br> <span>售后中</span></a></li>';

    $('.buy_list.n>ul').html(buyHtml);

    var html = '<div class="buy_list_title"> <img src="../../images/user_img/rectangle@3x.png" alt=""> <span>财付宝</span><a href="javascript:void(0)" class="logbtn"><u>进入财付宝 ></u></a> </div>';
    $('.buy_list.m').html(html);

    var html = '<div class="buy_list_title"> <img src="../../images/user_img/rectangle@3x.png" alt=""> <span>红包卡券</span> <a href="javascript:void(0)" class="logbtn"><u>金蛋购 ></u></a> </div>';
    $('.buy_list.c').html(html);


}


    $(".logbtn").click(function(){

        callback = WapSiteUrl + '/tmpl/member/member.html';

        login_url   = UCenterApiUrl + '?ctl=Login&met=index&typ=e';


        callback = ApiUrl + '?ctl=Login&met=check&typ=e&redirect=' + encodeURIComponent(callback);


        login_url = login_url + '&from=wap&callback=' + encodeURIComponent(callback);

        window.location.href = login_url;
    });

    $("#logout").click(function(){
        $("#logoutbtn").click()
    });

    $('#logoutbtn').click(function ()
    {
        var username = getCookie('username');
        var key = getCookie('key');
        var client = 'wap';

        login_url   = UCenterApiUrl + '?ctl=Login&met=logout&typ=e';


        callback = WapSiteUrl + '?redirect=' + encodeURIComponent(WapSiteUrl);


        login_url = login_url + '&from=wap&callback=' + encodeURIComponent(callback);

        window.location.href = login_url;

        delCookie('username');
        delCookie('user_account');
        delCookie('id');
        delCookie('key');

    });
});

function paycenter()
{
    $.post(PayCenterApiUrl+'?ctl=Info&met=App_index&typ=json',function(result){
        if(result.status == 250)
        {
            $.post(UCenterApiUrl+'?ctl=login&met=mobilePaycenterLogin&typ=json',function(data){
                if(data.status == 200)
                {
                    var cb = encodeURIComponent(WapSiteUrl+'/tmpl/member/money_index.html');
                    window.location.href = data.data.url + cb;
                    return;
                }
            });
        }
        else if(result.status == 200)
        {
            window.location.href = WapSiteUrl+'/tmpl/member/money_index.html';
            return;
        }
    });
}



