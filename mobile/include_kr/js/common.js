var clickType="click";
if ("ontouchstart" in document.documentElement){
	clickType="touchstart";
}

$(function(){
	var click_once=true;
	$(".gnb_btn").bind(clickType,function(e){
		e.preventDefault();
		menuActive();
	});

	$("header").find(".active.slide-down").data("activeOrigin", "y");

	function menuActive(){
		if(click_once==true){
			click_once=false;
			$("header").addClass("active");
			$('header').stop().animate({"height" : "100%"}, 500, "easeOutQuad", function(){
				$('header').css("overflow", "auto");
			});
			$('header .logo').addClass('active');
			$("ul.util").fadeIn(500);
			$(".all_container").fadeOut(500);
			$(".btn_canvas_wrap").fadeOut(500);
		}else if(click_once==false){
			click_once=true;
			$("header").removeClass("active");
			$('header').stop().animate({"height" : "115px"}, 500, "easeOutQuad", function(){
				$('header').css("overflow", "");
			});
			$('header .logo').removeClass('active');
			$("ul.util").fadeOut(500);
			$(".btn_canvas_wrap").fadeIn(500);
			$(".all_container").fadeIn(500);
			$.each($('header nav ul.gnb > li'), function(i, o){
				var $o = $(o);
				if($o.data("activeOrigin") == "y"){
					$o.addClass("slide-down");
				} else {
					$o.removeClass("slide-down");
				}
			});
		}
	}

	$('header nav ul.gnb > li > a').bind("click",function(e){
		e.preventDefault();

		if($('header .icon').is(':visible')){
			e.preventDefault();
			if($(this).parent().index()>=3){
				location.href=$(this).attr('href');
			}
			$(this).parent().toggleClass('slide-down').siblings().removeClass('slide-down');
		}
	})

	$('[data-inquiry-open-btn]').click(function(){
		$('.inquiry_container').addClass('active');
	});
	$('.btn.close, .btn_cancel').click(function(){
		$('.inquiry_container').removeClass('active');
	})

	$(".selectbox.method_type.ty84").bind("click",function(){
		$(this).toggleClass("active");
		var len = $("span", this).length+1;
		if(!$(this).hasClass("active")){
			$(this).stop().animate({"height" : "84px", "opacity" : 1}, 500, "easeOutExpo");
		} else {
			$(this).stop().animate({"height": len * 84 + "px", "opacity" : 1}, 500,"easeOutExpo");
		}
	});

	$(".selectbox.container_type.ty84").bind("click",function(){
		$(this).toggleClass("active");
		var len = $("span", this).length+1;

		if(!$(this).hasClass("active")){
			$(this).stop().animate({"height" : "84px", "opacity" : 1}, 500, "easeOutExpo");
		} else {
			$(this).stop().animate({"height": len * 84 + "px", "opacity" : 1}, 500,"easeOutExpo");
		}
	});
	$(".selectbox.method_type.ty64").bind("click",function(){
		$(this).toggleClass("active");
		var len = $("span", this).length+1;
		if(!$(this).hasClass("active")){
			$(this).stop().animate({"height" : "64px", "opacity" : 1}, 500, "easeOutExpo");
		} else {
			$(this).stop().animate({"height": len * 64 + "px", "opacity" : 1}, 500,"easeOutExpo");
		}
	});

	$(".selectbox.container_type.ty64").bind("click",function(){
		$(this).toggleClass("active");
		var len = $("span", this).length+1;

		if(!$(this).hasClass("active")){
			$(this).stop().animate({"height" : "64px", "opacity" : 1}, 500, "easeOutExpo");
		} else {
			$(this).stop().animate({"height": len * 64 + "px", "opacity" : 1}, 500,"easeOutExpo");
		}
	});

	$("#subscribeEmail").bind("keyup", function(e){
		e = (e) ? e : window.event;
		var myString = $(this).val();
		$(this).val(myString.replace(/[^A-Za-z0-9@\-\._]/g,''));

		return true;
	});

	$("#subscribeForm").bind("submit", function(){
		var regExp = /^[0-9a-zA-Z\-_\.]*@[0-9a-zA-Z\-_\.]*\.[a-zA-Z]{2,3}$/i;

		if(!regExp.test($("#subscribeEmail").val())){
		      alert("Email format is invalid.");
		      $("#subscribeEmail").focus();
		      return false;
		}
	});

	var $form;

	$("#contactForm, #publicContactForm").bind("submit", function(){
		$form = $(this)[0];
		if($form.cp_name.value == ""){
			alert("Input your name, please.");
			$form.cp_name.focus();
			return false;
		}
		if($form.cp_phone.value == ""){
			alert("Input your phone, please.");
			$form.cp_phone.focus();
			return false;
		}
		if($form.cp_email.value == ""){
			alert("Input your e-mail, please.");
			$form.cp_email.focus();
			return false;
		}
		if($form.cp_type.value == ""){
			alert("Please choose the type.");
			$form.cp_type.focus();
			return false;
		}
		if($form.cp_title.value == ""){
			alert("Please enter the title.");
			$form.cp_title.focus();
			return false;
		}
		if($form.cp_content.value == ""){
			alert("Please enter your content.");
			$form.cp_content.focus();
			return false;
		}
	});

	$("[data-cp-cate]").bind("click", function(){
		var $this = $(this);

		$form = $(this).closest("form").get(0);

		$(".selectbox_label", $($form)).text($.trim($this.text()));
		$form.cp_type.value = $.trim($this.data("cpCate"));
	});
});
