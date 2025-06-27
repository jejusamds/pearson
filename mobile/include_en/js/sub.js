$(function () {
	$(".qna_item").click(function(){
		if(!$(this).hasClass("active")){
			$(this).addClass("active").siblings().removeClass("active").find(".qna_item_view").stop().slideUp();
			$(".qna_item_view",this).stop().slideDown();
		} else {
			$(this).removeClass("active");
			$(".qna_item_view", this).stop().slideUp();
		};
	});

	var scrollobj = "span.i, a.i";
	var active_once = true;

	function scrollContainer() {
		var scrollPos = $(document).scrollTop();
		var activePoint = parseInt($(window).height() - $(window).height() / 4);
		var removePoint = parseInt(0);
		$(scrollobj).each(function (e) {
			console.log($(this));
			var currLink = $(this)
			if (currLink.offset().top - activePoint <= scrollPos && currLink.offset().top + currLink.height() > scrollPos + removePoint) {
				currLink.addClass("active");
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
					currLink.removeClass("active");
				}
			}
		});
	}
	scrollContainer();
	$(window).bind("scroll", function () {
		scrollContainer();
	});
});
