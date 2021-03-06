$(document).ready(function() {
    $('.tbar-cart-item').hover(function() {
        $(this).find('.p-del').show();
    }, function() {
        $(this).find('.p-del').hide();
    });

    $('.jth-item').hover(function() {
        $(this).find('.add-cart-button').show();
    }, function() {
        $(this).find('.add-cart-button').hide();
    });

    $('.toolbar-tab').hover(function() {
        $(this).find('.tab-text').addClass("tbar-tab-hover");
        $(this).find('.footer-tab-text').addClass("tbar-tab-footer-hover");
        $(this).addClass("tbar-tab-selected");
    }, function() {
        $(this).find('.tab-text').removeClass("tbar-tab-hover");
        $(this).find('.footer-tab-text').removeClass("tbar-tab-footer-hover");
        $(this).removeClass("tbar-tab-selected");
    });

    $('.tbar-tab-online-contact').hover(function() {
        $(this).find('.tab-text').addClass("tbar-tab-hover");
        $(this).find('.footer-tab-text').addClass("tbar-tab-footer-hover");
        $(this).addClass("tbar-tab-selected");
    }, function() {
        $(this).find('.tab-text').removeClass("tbar-tab-hover");
        $(this).find('.footer-tab-text').removeClass("tbar-tab-footer-hover");
        $(this).removeClass("tbar-tab-selected");
    });

    $(".close_p").click(function() {
        $(".toolbar-wrap").removeClass("toolbar-open");
        $(".toolbar-panel").css("visibility", "hidden");
        $(".toolbar-tab").removeClass("tbar-tab-click-selected");
        $(".tbar-tab-news").removeClass("tbar-tab-click-selected");
    });

    $('.toolbar-tab').click(function() {
        $('.toolbar-tab').removeClass('tbar-tab-click-selected');
        $(this).addClass('tbar-tab-click-selected');


        var type = $(this).data('type');
        $('.toolbar-panels .toolbar-panel').css('visibility', 'hidden');
        $('.toolbar-panels .tbar-panel-' + type).css({
            'visibility': "visible",
            "z-index": "1"
        });

        if (!$('.toolbar-wrap').hasClass('toolbar-open')) {
            $(this).find('.tab-text').remove();
            $('.toolbar-wrap').addClass('toolbar-open');
        }
    })

});