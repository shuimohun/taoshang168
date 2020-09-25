$(function(){
	$('.all li').click(function(){
		$(this).addClass('cur').siblings().removeClass('cur');
	})
})

var isCheckAll = false;  
        function swapCheck() {  
            if (isCheckAll) {  
                $("input[type='checkbox']").each(function() {  
                    this.checked = false;  
                });  
                isCheckAll = false;  
            } else {  
                $("input[type='checkbox']").each(function() {  
                    this.checked = true;  
                });  
                isCheckAll = true;  
            }  
        }  


$(function(){
    $('.shanchu').click(function(){
        $('.tanchuang').css('display','block');
        $('.bg_tanchuang').show();
    })
    $('.ensure,.delete').click(function(){
         $('.bg_tanchuang').hide();
         $('.tanchuang').hide();
    })
})
