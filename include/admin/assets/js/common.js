$(function(){
	var sertFileSeq = function(){
		var startIndex = $(".form-group:not(.isMultiFileGroup)").find("[name^='uploadfile']").length;

		$.each($(".multifile-label"), function(i, object){
			var innerText = $.trim($(object).text());
			$(object).text(innerText.replace(/[0-9]/g, "") + (i + 1));
		});

		$.each($(".form-group.isMultiFileGroup"), function(i, object){
			var $target = $(object).find("[name^='uploadfile']");
			$target.attr("name", "uploadfile" + (startIndex + i + 1));
		});	
	};

	var fnMultiFileBtn = function(type, $self){
		var formGroup = $self.closest(".form-group");

		if(type == "minus"){
			var plusBtn = $self.siblings(".multifile-plus").clone();

			plusBtn.insertBefore(formGroup.prev().find(".multifile-minus"));

			if($self.data("dn") !== undefined){
				$("#form").append($("<input type='hidden' name='multifiledel[]' value='" + $self.data("dn") + "'>"));
			}
			$self.closest(".form-group").remove();
		} else if(type == "plus"){
			var formGroupClone = formGroup.clone();

			formGroupClone.find(".fileupload-preview").text("");
			formGroupClone.find(".clone-remove-item").remove();
			formGroupClone.find(".btn-multifile.multifile-minus").removeAttr("data-dn");
			formGroupClone.find("input[name='fileseq[]']").val("");

			var $hiddenName = formGroupClone.find("input[type='file']").attr("name") || formGroupClone.find("[data-provides='fileupload']").children("input[type='hidden']:not([name='fileseq[]'])").attr("name");

			formGroupClone.find("[data-provides='fileupload']").children("input[type='hidden']:not([name='fileseq[]'])").remove();
			formGroupClone.find("input[type='file']").attr("name", $hiddenName);
			formGroupClone.find("input[type='file']").val("");

			formGroupClone.find(".fileupload.fileupload-exists").removeClass("fileupload-exists").addClass("fileupload-new");

			$self.remove();

			formGroupClone.insertAfter(formGroup);
		}

		sertFileSeq();
	}

	var initMultiFileBtns = function(){
		$(".btn-multifile.multifile-minus").unbind("click").bind("click", function(e){
			e.preventDefault();
			var $sf = $(this);
			if($(".btn-multifile.multifile-minus").length <= 1){
				var $formGroup = $sf.closest(".form-group");

				$formGroup.find(".clone-remove-item").remove();
				$formGroup.find(".btn-multifile.multifile-minus").removeAttr("data-dn");
				$formGroup.find("input[name='fileseq[]']").val("");
				$formGroup.find("[data-provides='fileupload']").removeClass("fileupload-exists").addClass("fileupload-new");
				$formGroup.find(".fileupload-preview").text("");
			} else {
				fnMultiFileBtn("minus", $sf);
				initMultiFileBtns();
				sertFileSeq();
			}
		});

		$(".btn-multifile.multifile-plus").unbind("click").bind("click", function(e){
			e.preventDefault();

			fnMultiFileBtn("plus", $(this));
			initMultiFileBtns();
			sertFileSeq();
		});

		$(".btn-multifile.multifile-move-up, .btn-multifile.multifile-move-down").unbind("click").bind("click", function(e){
			e.preventDefault();

			var $self = $(this);
			var formGroup = $self.closest(".form-group");
			if($self.is(".btn-multifile.multifile-move-up")){
				formGroup.insertBefore(formGroup.prev(".isMultiFileGroup"));
			} else {
				formGroup.insertAfter(formGroup.next(".isMultiFileGroup"));
			}
			sertFileSeq();
		});
	}

	initMultiFileBtns();
});
