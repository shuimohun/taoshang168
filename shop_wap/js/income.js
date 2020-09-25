$(function(){
    function get() {
        $.post(ApiUrl + "?ctl=Distribution_Buyer_Index&met=income&typ=json",{status:status},function (e) {
            if(e.status == 200) {
                var r = template.render("detail", e.data);
                $(".survey").html(r);
            }
        })
    }
    get();
    $('.income_title li').click(function(){

        $(this).addClass('cur').siblings().removeClass('cur');
        $wa = $(this).index();
        $(".survey").html("");
       if($wa == 1){
           status = 'first';
       }
       if($wa == 2){
           status = 'second';
       }
       if($wa == 3){
           status = 'third';
       }
       if($wa == 0)
       {
           status ='';
       }
       get();
    });
    $('.other button').click(function(){
        $(this).addClass('cur').siblings().removeClass('cur');
    })
})