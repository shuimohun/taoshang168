/***************弹窗***************/
        $(function(){
            $('#update').click(function(){
                $('.win-top').fadeIn();
                $('.win-bottom').fadeTo(300,0.3);
            });
            $('#confirm').click(function(){
                $('.win-top,.win-bottom').fadeOut();
            })
        })