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
});