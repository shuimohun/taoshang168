$(function(){


    function getNav(){
        $.getJSON(SITE_URL + "?ctl=Goods_Cat&met=getOneCat&typ=json", function (e) {
            if(e.status ==200){
                var  firstCat = template.render("firstCat",e);
                $(".firstCat ul").html(firstCat);
            }

        })
    }

     getNav()

    var cat_sid;
    /*价格区间点击*/
    $(".price-nav").children("ul").eq(0).on("click",'li',function () {

        $(this).addClass("curr").siblings().removeClass("curr");
        getData();

    })

    /*一级分类点击*/
    $(".firstCat ul").on('click','li',function(){
        $(this).addClass("curr").siblings().removeClass("curr");
        var cat_id = $(this).attr('data-id');
        /*获取二级分类函数*/

        getChild(cat_id);
        getData();
        /*执行数据查询函数*/


    })

    /*二级分类点击*/
    $(".secondCat").on("click","li",function () {
        $(this).addClass("curr").siblings().removeClass("curr");
        getData();
    })



function getChild(cat_id){
    $(".secondCat ul li").each(function () {
        if($(this).hasClass("curr")){
            $(this).removeClass("curr");
        }

    })
    $.getJSON(SITE_URL+'?ctl=Goods_Top&met=getChildCat&typ=json&cat_parent_id='+cat_id,function(e){
        var secondCat = template.render("secondCat",e);
        $(".secondCat").html(secondCat);


    })
}
function getData() {
    var Fmoney = $(".Fprice").val();
    var Smoney = $(".Sprice").val();
    var Cmoney='';
    if(Fmoney>Smoney){
        Cmoney=Fmoney;
        Fmoney=Smoney;
        Smoney=Cmoney;
        $(".Fprice").val(Fmoney);
        $(".Sprice").val(Smoney);
    }

    var state_id;
    var cat_id;
    /*价格区间firstPrice   secondPrice*/
    /*state 价格区间*/
    $(".price-nav ul li").each(function () {
        if($(this).hasClass("curr")){
             state_id = $(this).attr("data-state");
        }
    })
    /*cat_id 一级分类id*/
    $(".firstCat ul li").each(function () {
        if($(this).hasClass("curr")){
            cat_id = $(this).attr("data-id");

        }
    })

    $(".secondCat ul li").each(function () {
        if($(this).hasClass("curr")){
            cat_sid = $(this).attr("data-id");
        }
    })
    $.ajax({
        type: 'POST',
        url: SITE_URL+'?ctl=Goods_SaveMoney&met=index&typ=json',
        data:{cat_id:cat_id,state_id:state_id,cat_sid:cat_sid,Fmoney:Fmoney,Smoney:Smoney},
        dataType:'json',
        success:function(result){
            /*惠省*/
            var HS=template.render("HS",result.data);
            $(".HS").html(HS);
            /*惠赚*/
            var HZ=template.render("HZ",result.data);
            $(".HZ").html(HZ);
            /*省到家*/
            /*钱不尽**/

            if(result){
                var nu='';
                $(".Fprice").val(nu);
                $(".Sprice").val(nu);
                cat_sid='';
            }

        },

    })

}

function checkPrice(){
    var Fmoney = $(".Fprice").val();
    var Smoney = $(".Sprice").val();
    var regA = /^[0-9]+\.[0-9]{0,2}$/;
    var regB = /^\d+$/;

    if (!(regA.test(Fmoney) || regB.test(Fmoney))) {
        var nMoney=Fmoney.substring(0,Fmoney.Length-1);
       $(".Fprice").val(nMoney);
    }
    if (!(regA.test(Smoney) || regB.test(Smoney))) {
        var nSMoney=Smoney.substring(0,Smoney.Length-1);
        $(".Sprice").val(nSMoney);
    }


}


$(".price-screen ul li").eq(3).click(function(){
    getData();
})

$(".price-screen ul li").eq(0).keyup(function(){
    checkPrice();
})
$(".price-screen ul li").eq(2).keyup(function(){
    checkPrice();
})





})














