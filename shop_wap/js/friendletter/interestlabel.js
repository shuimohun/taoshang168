$(function () {

/*--获取标签数据--*/
function getUserTag(){

  $.getJSON(ApiUrl+'?ctl=Buyer_User&met=wapinterest&typ=json',function(e){
        if(200==e.status){

            var interest =template.render("interest",e);
            $(".interest").html(interest);

            addinterest();
        }
  })
}

getUserTag();

function  addinterest() {
    $(".ad_btn").click(function () {

        var param=Array();
        var tag_id;
        if($(this).hasClass("on")){
            tag_id = $(this).data("id");
            /*跳转添加好友页面*/
            var backUrl = location.href;
            addCookie('url',backUrl);
            window.location.href = "./addfriend.html?tag_id="+tag_id;
        }else{

            tag_id = $(this).data("id");
            param.push(tag_id);
            $(".fl_item_con").each(function(){

                if($(this).children("div").eq(2).hasClass("on"))
                {
                    tag_id = $(this).children("div").eq(2).data("id");
                    param.push(tag_id);
                }
            })

            var  _this = $(this);
            $.ajax({
                url: ApiUrl+'?ctl=Buyer_User&met=editTagRec&typ=json',
                data:{mid:param},
                success:function(e){
                    if(e.status == 200){
                        _this.addClass("on");
                        _this.text("去看看");

                    }
                }
            });


        }

    })
}



})
