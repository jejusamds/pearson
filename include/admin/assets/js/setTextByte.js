$(function(){
	var $setTextByteElement = $("[data-text-byte-target]");

	var setTextByte = function(){
		var $this = $setTextByteElement, min = (($this.data("textByteMin")) ? $this.data("textByteMin") : 160), max = (($this.data("textByteMax")) ? $this.data("textByteMax") : 300);
/*
		var stringByteLength = (function(s,b,i,c){
				for(b=i=0;c=s.charCodeAt(i++);b+=c>>11?3:c>>7?2:1);
				return b;
		})($this.val());
*/
	
		var stringByteLength = $this.val().length;

		$this.siblings("[data-text-byte-info]").text("( " + stringByteLength + " Chars )");

		if(stringByteLength < min || stringByteLength > max){
				$this.siblings("[data-text-byte-info]").addClass("red");
		} else {
				$this.siblings("[data-text-byte-info]").removeClass("red");
		}
	};

	$.each($setTextByteElement, function(i, o){
		$(o).bind("keyup", function(){
			setTextByte();
		});

		setTextByte();
	});
});