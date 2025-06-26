$(function () {


	var click_once = true;
	var no_repeat = true;

	$(window).bind("scroll", function () {
		var t = $('header').offset().top;
		var h;
		if (!$("body").hasClass("isMain")) {
			h = $('.sub-wrapper').height() - $('.blank').height();
		} else {
			h = 240;
		}

		if ($('header .icon').is(':visible') && t >= h) {
			$('.sub-wrapper, .blank, header').addClass('isScroll');
			$('.sub-wrapper .text_wrap').css('display', 'none');

		} else {
			$('.sub-wrapper, .blank, header').removeClass('isScroll');
			$('.sub-wrapper .text_wrap').css('display', 'block');
		}
	});

		$('nav > ul > li.active').addClass("isOrigin");

		//gnb
		$('nav > ul > li').mouseenter(function(){
			$(this).addClass('active');
			$('.subwrap').stop().slideDown(500);
			$('.ulwrap > .allwrap:eq('+$(this).index()+')').addClass('active');

			$('.ulwrap > .allwrap').find('.menu_left > ul > li').hide();
			$('.ulwrap > .allwrap:eq('+$(this).index()+') > .menu_left > ul > li:eq(0)').show();

			$('.ulwrap > .allwrap').find('.menu_left > .menu_bg').hide();
			$('.ulwrap > .allwrap:eq('+$(this).index()+') > .menu_left > .menu_bg').show();
		})

		$('nav > ul > li').mouseleave(function(){
			$(this).removeClass('active');
			$('.subwrap').stop().slideUp(500);
			$('.ulwrap > .allwrap:eq('+$(this).index()+')').removeClass('active');
			$('nav > ul > li').not($('nav > ul > li.isOrigin')).removeClass("active");
		})
		$('header').mouseleave(function(){
			$('nav > ul > li.isOrigin').addClass("active");
		})

		$('.subwrap').mouseenter(function(){
			$('.subwrap').stop().slideDown(500);

		})
		$('.subwrap').mouseleave(function(){
			$('.subwrap').stop().slideUp(500);
		})

		$('.ulwrap > .allwrap').mouseenter(function(){
			$('nav > ul > li:eq('+$(this).index()+')').addClass('active');
			$(this).addClass('active');

			$('.menu_left > ul > li').hide();
			$('.ulwrap > .allwrap:eq('+$(this).index()+') > .menu_left > ul > li:eq(0)').show();

			$('.allwrap').find('.menu_left > .menu_bg').hide();
			$(this).find('.menu_left > .menu_bg').show();

		})

		$('.ulwrap > .allwrap').mouseleave(function(){
			$('nav > ul > li:eq('+$(this).index()+')').removeClass('active');
			$(this).removeClass('active');
		})

		//gnb 문장
		$('.allwrap > ul > li').mouseenter(function(){
			var thisnum=$(this).index();
			var curnum=thisnum+1;

			$('.menu_left > ul > li').hide();
			$(this).parents('.allwrap').find('.menu_left > ul > li:eq('+curnum+')').show();

		})

		//inquiry

	$('[data-inquiry-open-btn]').click(function(){
		$('.inquiry_container').addClass('active');
	});
	$('.btn.close, .btn_cancel').click(function(){
		$('.inquiry_container').removeClass('active');
	})


	$(".selectbox.method_type").bind("click",function(){
		$(this).toggleClass("active");
		var len = $("span", this).length+1;
		if(!$(this).hasClass("active")){
			$(this).stop().animate({"height" : "64px", "opacity" : 1}, 500, "easeOutExpo");
		} else {
			$(this).stop().animate({"height": len * 52 + "px", "opacity" : 1}, 500,"easeOutExpo");
		}
	});

	$(".selectbox.container_type").bind("click",function(){
		$(this).toggleClass("active");
		var len = $("span", this).length+1;

		if(!$(this).hasClass("active")){
			$(this).stop().animate({"height" : "52px", "opacity" : 1}, 500, "easeOutExpo");
		} else {
			$(this).stop().animate({"height": len * 52 + "px", "opacity" : 1}, 500,"easeOutExpo");
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


		var scrollobj=".event";
			var active_once=true;
			function scrollContainer() {
				var scrollPos = $(document).scrollTop();
				var activePoint = parseInt($(window).height()-$(window).height()/4);
				var removePoint = parseInt(0);
				$(scrollobj).each(function(e){
					var currLink = $(this)
					if (currLink.offset().top - activePoint <= scrollPos && currLink.offset().top + currLink.height()  > scrollPos + removePoint) {
						currLink.addClass("sc-event");
					} else {
						if(active_once==false){
						currLink.removeClass("sc-event");
						}
					}
				});
			}
			scrollContainer();
			$(window).bind("scroll",function() {
				scrollContainer();
			});


});
