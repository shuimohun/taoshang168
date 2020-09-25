
var refer = document.referrer;
$(function () {

    $(".back").click(function () {
        if( refer )
        {
            window.location.href=refer;
        }
        else
        {
            window.location.href = WapSiteUrl;
        }
    })
})