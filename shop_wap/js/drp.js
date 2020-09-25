$(function(){
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
        status = 'second';
    function get() {
        $.post(ApiUrl + "?ctl=Distribution_Buyer_Index&met=distribution&typ=json",{status:status},function (e) {
            if(e.status == 200){
                var r = template.render("one", e);
                $('#details').html(r);
            }
        })
    }
    get();
})
