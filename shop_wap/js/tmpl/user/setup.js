/***************清除缓存弹窗***************/
        $(function(){
            $('#cache_clear').click(function(){
                $('.win-top').fadeIn();
                $('.win-bottom').fadeTo(300,0.5);
            });
            $('#cache_cancel,#cache_confirm').click(function(){
                $('.win-top,.win-bottom').fadeOut();
            })
        })
/***************清除缓存弹窗***************/

/***************注销登陆弹窗部分*********************/
		$(function(){
            $('#login').click(function(){
                $('.login-top').fadeIn();
                $('.login-bottom').fadeTo(300,0.5);
            });
            $('#login_cancel,#login_confirm').click(function(){
                $('.login-top,.login-bottom').fadeOut();
            })
        })
/***************注销登陆弹窗部分*********************/

/********************更改头像弹窗部分**********************/
		$(function(){
            $('.head').click(function(){
                window.location.href = UCenterApiUrl+"?ctl=User&met=getUserImg";
            });
            // $('.photo_cancel').click(function(){
            //     $('.head-top').slideUp();
            //     $('.head-bottom').fadeOut();
            // })
        });
/********************更改头像弹窗部分**********************/

