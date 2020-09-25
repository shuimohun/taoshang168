/*********************顶部轮播图************************************/
$(function(){

});
/**********轮播图部分***************/

/****************弹窗部分*************************************/
        $(function(){
            $('.info').click(function(){
                $('.win-top').fadeIn();
                $('.win-bottom').fadeTo(300,0.3);
            });
            $('.bottom').click(function(){
                $('.win-top,.win-bottom').fadeOut();
            })
        });
/****************弹窗部分*************************************/

/************滚动导航栏展开*************/
        $(function(){
            $('.an').click(function(){
                $('body').css('height','100%');
                if ($('.head-top').css('display') == 'none'){
                    $('.head-top').slideDown();
                    $('body').css('overflow','hidden');
                }
                else{
                    $('.head-top').slideUp();
                    $('body').css('overflow','visible');
                }
            });
        });
/************滚动导航栏展开*************/

/*********阻止移动端页面滑动***********/
/*window.ontouchmove=function(e){
       e.preventDefault && e.preventDefault();
       e.returnValue=false;
       e.stopPropagation && e.stopPropagation();
       return false;
}*/
/*********阻止移动端页面滑动***********/


/***********************************************/