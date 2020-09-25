$(function(){
    $('.tit span').click(function(){
        $(this).addClass('cur').siblings().removeClass('cur');
    });
    giveGoods();
});

function giveGoods(){
    $.ajax({
        url:ApiUrl+'?ctl=Self_Goods&met=act&typ=json',
        type:'post',
        dataType:'json',
        success:function(r){
            if(r.status == 200){
                var goods = template.render('getGoods',r.data);
                $('.getGoods').html(goods);
            }
        }
    });
}

function clle(th)
{
    var path = $(th).attr('src');
    var goods_id = $(th).attr('goods-id');
    if(path == '../images/activity/like@2x.png')
    {
        favoriteGoods(goods_id);
        $(th).attr('src','../images/activity/liked@2x.png');
    }
    else if(path == '../images/activity/liked@2x.png')
    {
        dropFavoriteGoods(goods_id);
        $(th).attr('src','../images/activity/like@2x.png');
    }

}