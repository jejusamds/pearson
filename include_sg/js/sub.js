$(function () {
	$('.sub-wrapper').addClass("active");
	$('header').hover(function () {
		$('.sub-wrapper .normal').addClass("hover")
	}, function () {
		$('.sub-wrapper .normal').removeClass("hover")
	})

	textSplit('h3.sub-title');
	$('h3.sub-title span').each(function (e) {
		$(this).delay(getRandomIntInclusive(0, 1000)).animate({
			'color': '#222'
		}, 1500)
	})

	function textSplit(target) {
		var input = "";
		var txt = "";
		var text = $(target).text();
		for (i = 0; i <= text.length - 1; i++) {
			if (text.substr(i, 1) == " ") {
				input = " "
				txt += "<span>" + input + "</span>";
			} else if (text.substr(i, 1) == "|") {
				input = "<div></div>";
				txt += input;
			} else if (text.substr(i, 1) == "/" && opts.ignored.indexOf("/") == -1) {
				input = "<br>";
				txt += input;
			} else {
				input = text.substr(i, 1);
				txt += "<span>" + input + "</span>";
			}
		}
		$(target).html(txt);
	}
	var scrollobj = ".history_opacity_effect, .history_effect, p.normal, .img, .sub-title2, span.normal, .textmotion, .laboratory .line, .graphmotion";
	var active_once = true;

	function scrollContainer() {
		var scrollPos = $(document).scrollTop();
		var activePoint = parseInt($(window).height() - $(window).height() / 4);
		var removePoint = parseInt(0);
		$(scrollobj).each(function (e) {
			var currLink = $(this)
			if (currLink.offset().top - activePoint <= scrollPos && currLink.offset().top + currLink.height() > scrollPos + removePoint) {
				currLink.addClass("sc-event");
				if(currLink.data("nnCallback") !== undefined){
					var fn = window[currLink.data("nnCallback")];
					if(fn && {}.toString.call(fn) === '[object Function]'){
						fn();
						if(currLink.data("nnLoop") !== undefined && currLink.data("nnLoop") === false){
							window[currLink.data("nnCallback")] = undefined;
						}
					}
				}
			} else {
				if (active_once == false) {
					currLink.removeClass("sc-event");
				}
			}
		});
	}
	scrollContainer();
	$(window).bind("scroll", function () {
		scrollContainer();
	});

	$('video').each(function(){
		var s=$(this).attr('src');
		if($(this).attr('controls')){
			s=s.replace(".mp4", "_poster.jpg");
			$(this).attr({'poster':s})
		}
	})

	function init(){

			 $('.visual .text_wrap h1 i').each(function(e){
					 var rnd=getRandomIntInclusive(0,1500)
					 $(this).delay(rnd).animate({'opacity':'1'},1500);
			 })
	 };
	 init();
	 function getRandomIntInclusive(min, max) {
		 return Math.floor(Math.random() * (max - min + 1)) + min;
	 }

	$(function(){
		$(".qna_item").click(function(){
			if(!$(this).hasClass("active")){
				$(this).addClass("active").siblings().removeClass("active").find(".qna_item_view").stop().slideUp();
				$(".qna_item_view",this).stop().slideDown();
			} else {
				$(this).removeClass("active");
				$(".qna_item_view", this).stop().slideUp();
			};
		});
	});
});
