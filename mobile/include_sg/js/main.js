$(function () {
    var vid = document.getElementById("myVideo");
    setTimeout(function () {
        $(window).scrollTop(0);
    }, 1000);
    var intro = $('.intro_container > div').hasClass('intro_skip');
    // 딜레이 = random(5) * 0.3
    if (intro) {
        var introTimer = null;
        var $imgs = $("[data-img-id]");
        var timings = [0, 750, 125, 250, 375, 1125, 500, 625, 1375, 875, 1000, 1250, 1500, 1750];
        $.each($imgs, function (e, o) {
            $(o).delay(timings[e]).queue(function () {
                $(this).addClass("show");
            });
        });
        introTimer = setTimeout(function () {
            vid.currentTime = 5;
            $("[data-img-last]").addClass("show");
            $("[data-img-first]").addClass("show");
            introTimer = setTimeout(function () {
                $('.main_container').addClass("show");
                vid.play();
                $(".bg").fadeOut(2500, function () {
                    // .popup_con 표시
                    $(".popup_con").css("display", "block");

                    $('*').unbind('touchmove');
                    setScrollBtn();
                    $("body").css("overflow", "");
                });
                $("#introSkip").fadeOut(400);
                $(".intro_txt_wrap").animate({ "top": "220px", "margin-top": "0" }, 2500, "easeOutExpo");
                $('.intro_wrap p.text').css('opacity', '1');
            }, 2200);

        }, 2800);

        $('*').bind('touchmove', false);
    } else {
        setScrollBtn();
        $(".bg").css({ 'display': 'none' });
        $('.main_container').addClass("show");
        vid.currentTime = 5;
        vid.play();
        $("[data-img-id]").addClass("show");
        $("[data-img-last]").addClass("show");
        $(".intro_txt_wrap").css({ "top": "220px", "margin-top": "0" });
        $('.intro_wrap p.text').css('opacity', '1');

        // .popup_con 표시
        $(".popup_con").css("display", "block");
    }

    $("#introSkip").bind("click", function (e) {
        vid.currentTime = 5;
        e.preventDefault();
        $("[data-img-last]").clearQueue().stop().addClass("show");
        $("[data-img-first]").clearQueue().stop().addClass("show");
        $('.main_container').addClass("show");
        $imgs.clearQueue().stop().addClass("show");

        clearInterval(introTimer);
        $(this).fadeOut();
        $(".bg").fadeOut(400, function () {
            // .popup_con 표시
            $(".popup_con").css("display", "block");
        });

        $('*').unbind('touchmove');
        $("body").css("overflow", "");
        setScrollBtn();
        vid.play();
        $(".bg").animate({ "top": "220px", "margin-top": "0" }, 400, "easeOutExpo");
        $(".intro_txt_wrap").animate({ "top": "220px", "margin-top": "0" }, 2500, "easeOutExpo");
        $('.intro_wrap p.text').css('opacity', '1');
    });

    $('.slide').slick({
        dots: true,
        infinite: true,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 3000,
        slidesToScroll: 1
    });
});