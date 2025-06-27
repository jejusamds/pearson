var cache = document.getElementById('btnCanvas');
var ctx = cache.getContext('2d');

img = new Image();
var canvasWidth = 388;
var canvasHeight = 54;
var lineWidth = 1;
var percent = 0, interrupt = false;
var start = null, btnState = "before", transformState = false;
var beforeOrigin = {
	"width" : 388,
	"height" : 54,
	"lineWidth" : 1
};
var before = {
	"width" : 388,
	"height" : 54,
	"lineWidth" : 1
};
var nextOrigin = {
	"width" : 120,
	"height" : 120,
	"lineWidth" : 120
};
var next = {
	"width" : 120,
	"height" : 120,
	"lineWidth" : 120
};

var duration = 700;
var topOffset = 10;
img.src = "include_sg/images/main/btn_overlay_2.png";

img.onload = function(){
	var bg = { "w" : 408, "h" : 408 };
	var d = 0;

	setInterval(function(){
		cache.width  = canvasWidth;
		cache.height = canvasHeight;
		ctx.save();
		ctx.clearRect(0, 0, cache.width, cache.height);
		ctx.strokeStyle = "#FFFFFF";
		ctx.lineWidth = lineWidth;
		ctx.strokeRect(0, 0, cache.width, cache.height);
		ctx.globalCompositeOperation = 'source-in';
		ctx.translate(cache.width / 2, cache.height / 2);
		ctx.rotate(Math.PI / 180 * d);
		ctx.drawImage(img, -bg.w / 2, -bg.h / 2, bg.w, bg.h);
		ctx.restore();
		d++;

		if(d >= 360){
			d = 0;
		}
	}, 20);
}
function setScrollBtn(){
	var getEaseOutExpo = function (t, b, c, d) {
		return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
	};

	function btnTransformSwapAndClear(){
		percent = 0;
		transformState = false;
		if(btnState == "next"){
			var tmp = JSON.parse(JSON.stringify(beforeOrigin));
			before = JSON.parse(JSON.stringify(nextOrigin));
			next = JSON.parse(JSON.stringify(tmp));
		} else {
			var tmp = JSON.parse(JSON.stringify(nextOrigin));
			before = JSON.parse(JSON.stringify(beforeOrigin));
			next = JSON.parse(JSON.stringify(tmp));
		}
	}

	function btnTransform(){
		function step(timestamp) {
			if(!interrupt){
				if (!start) start = timestamp;
				var progress = timestamp - start;

				canvasWidth = getEaseOutExpo(duration * percent, before.width, next.width - before.width, duration);
				canvasHeight = getEaseOutExpo(duration * percent, before.height, next.height - before.height, duration)
				lineWidth = getEaseOutExpo(duration * percent, before.lineWidth, next.lineWidth - before.lineWidth, duration/3);

				if (percent < 1) {
					percent += 0.01;
					window.requestAnimationFrame(step);
				} else {
					btnTransformSwapAndClear();
				}
			} else {
				before.width = canvasWidth;
				before.height = canvasHeight;
				before.lineWidth = lineWidth;

				if(btnState == "before"){
					next = JSON.parse(JSON.stringify(beforeOrigin));
				} else {
					next = JSON.parse(JSON.stringify(nextOrigin));
				}

				percent = 0;
				interrupt = false;
				window.requestAnimationFrame(step);
			}
		}
		window.requestAnimationFrame(step);
	}
	$(".btn_canvas_wrap").hover(function(){
		if(btnState=="before"){
			$(this).stop().animate({  now: '388' },{
        duration:300,
        step: function(now,fx) {
        	lineWidth=now
        }
    	});
		}
	},function(){
		if(btnState=="before"){
			$(this).stop().animate({  now: '1' },{
	        duration:300,
	        step: function(now,fx) {
	        	lineWidth=now
	        }
	    });
	  }
	})
	$(window).bind("scroll", function(){
		var $this = $(this);
		if($this.scrollTop() < topOffset && btnState == "next" && !transformState){
			btnState = ((btnState == "before") ? "next" : "before");
			transformState = true;
			btnTransform();
			$(".btn_canvas_wrap").removeClass('scroll');
		} else if($this.scrollTop() >= topOffset && btnState == "before" && !transformState){
			btnState = ((btnState == "before") ? "next" : "before");
			transformState = true;
			btnTransform();
			$(".btn_canvas_wrap").addClass('scroll');
		} else if($this.scrollTop() < topOffset && btnState == "next" && transformState && !interrupt){
			btnState = ((btnState == "before") ? "next" : "before");
			interrupt = true;
			$(".btn_canvas_wrap").removeClass('scroll');
		} else if($this.scrollTop() >= topOffset && btnState == "before" && transformState && !interrupt){
			btnState = ((btnState == "before") ? "next" : "before");
			interrupt = true;
			$(".btn_canvas_wrap").addClass('scroll');
		}
	});
}
$(function(){

})
