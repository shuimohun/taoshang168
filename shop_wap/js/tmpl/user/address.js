/***************地址弹窗***************/
        $(function(){
            $('#address').click(function(){
                $('.win-top').fadeIn();
                $('.win-bottom').fadeTo(300,0.3);
            });
            $('#cancel,#confirm').click(function(){
                $('.win-top,.win-bottom').fadeOut();
            })
        })
/***************地址弹窗***************/

/***********街道弹窗***********/
        $(function(){
            $('#street').click(function(){
                $('.street-top').fadeIn();
                $('.street-bottom').fadeTo(300,0.3);
            });
            $('#cancel,#confirm').click(function(){
                $('.street-top,.street-bottom').fadeOut();
            })
        })
/***********街道弹窗***********/

//提交验证
$(function(){
    $('.info').submit(function(){
        //收货人名字不能为空或者有特殊字符
        var name = $('#name').val();
        if( name == ''){ 
            alert("收货人名字不能为空"); 
            return false;
        }
        else if( !(/^[\u4e00-\u9fa50-9a-zA-Z_\-]{1,20}$/.test(name)) ){ 
            alert("收货人名字不能有特殊字符"); 
            return false;
        }
        //手机号是否符合格式
        var phone = $('#phone').val();
        if( !(/^1[3|4|5|8][0-9]\d{4,8}$/.test(phone)) ){ 
            alert("请填写正确的手机号码格式"); 
            return false;
        }
        //邮编是否符合格式
        var postal = $('#postal').val();
        if ( !(/^\d{6}$/.test(postal)) ){
            alert("请输入正确的邮编格式");
            return false;
        }
    })
})
