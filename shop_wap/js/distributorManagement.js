$(function(){
	status = 'second';
	function ToggleBorder(name){
		name.addClass('cur').siblings().removeClass('cur');
	}
	$('.fenxiaoshang_item').click(function(){
		ToggleBorder($(this));
        if($(this).index() == 0){
            status = 'second';
        }else{
            status = 'third';
        }
        get();
	})
    function get() {
        $.post(ApiUrl + "?ctl=Distribution_Buyer_Index&met=distributor&typ=json",function (e) {
            if(e.status == 200){
                var r = template.render("top", e.data);
                $('.item-top').html(r);
                var s = template.render("detail", e.data);
                $('#detail_list').html(s);
            }
        })
    }
    get()
})
