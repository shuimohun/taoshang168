$(function(){

})

function checkPrice(){

    var Fmoney = $(".Fmoney").val();
    var Smoney = $(".Smoney").val();
    var regA = /^[0-9]+\.[0-9]{0,2}$/;
    var regB = /^\d+$/;

    if (!(regA.test(Fmoney) || regB.test(Fmoney))) {
        var nMoney=Fmoney.substring(0,Fmoney.Length-1);
        $(".Fmoney").val(nMoney);
    }
    if (!(regA.test(Smoney) || regB.test(Smoney))) {
        var nSMoney=Smoney.substring(0,Smoney.Length-1);
        $(".Smoney").val(nSMoney);
    }


}
