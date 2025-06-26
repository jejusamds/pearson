$(function(){
	// 법인 주소지
	$("[data-hidden-el-toggle]").bind("change", function(){
		var $this = $(this), $target = $this.data("hiddenElToggle");

		if($this.val() == "self"){
			$("[data-hidden-el-toggle-target='" + $target +  "']").removeClass("hide");
		} else {
			$("[data-hidden-el-toggle-target='" + $target + "']").addClass("hide");
		}
	});

	// Clone 복사 및 추가 이벤트
	$("[data-el-add]").bind("click", function(e){
		e.preventDefault();

		var $this = $(this), $key = $this.data("elAdd");

		var $clone = $("[data-el-clone='" + $key + "']").clone();
		$clone.removeAttr("data-el-clone");

		$clone.find("[data-country-phone-passed]").removeAttr("data-country-phone-passed");
		$clone.find("[data-sum-all-passed]").removeAttr("data-sum-all-passed");
		$clone.find("[data-shareholder-multiname-passed]").removeAttr("data-shareholder-multiname-passed");
		
		// Korea Entitiy Type
		if($("[data-branch-hidden]").length > 0){
			var $isHidden = $("[data-branch-hidden]:checked").data("branchHidden");

			if($isHidden){
				$clone.find("[data-branch-hidden]").addClass("hide").find("input").val("");
			} else {
				$clone.find("[data-branch-hidden]").removeClass("hide");
			}
		}

		$("[data-el-container='" + $key + "']").append($clone);
//		$("[data-el-container='" + $key + "']").append($("<p>&nbsp;</p>"));

		if($clone.data("elSeqUse") === true){
			var $siblings = $("[data-el-parent='" + $key + "']").not($("[data-el-clone='" + $key + "']"));

			setSeq($siblings, $key);
		}

		setEvents();
		setShareholderNames();
	});

	/* Event */
	function setSeq($siblings, $key){
		$.each($siblings, function(i, o){
			var $seq = (i + 1);

			$.each($(o).find("[data-el-tailadd-seq-value='" + $key + "']"), function(i, o){
				if($(o).data("elTailaddSeqAttr") == "value"){
					$(o).val($seq);
				} else if($(o).data("elTailaddSeqAttr") == "label"){
					$(o).text($(o).data("elTailaddSeqLabel") + " #" + $seq);
				} else if($(o).data("elTailaddSeqAttr") == "name_array"){
					$(o).attr("name", $(o).data("elTailaddSeqKey") + "[" + ($seq -1) + "][]");
				} else {
					$(o).attr("name", $(o).data("elTailaddSeqKey") + "" + $seq);
				}
			});
		});
	}
	function setEvents(){
		/* Remove */
		$("[data-el-remove]").unbind("click.remove").bind("click.remove", function(e){
			e.preventDefault();

			var $this = $(this), $key = $this.data("elRemove");

			var $parent = $this.closest("[data-el-parent='" + $key + "']");

//			$parent.next("p").remove();
			$parent.remove();

			if($parent.data("elSeqUse") === true){
				var $siblings = $("[data-el-parent='" + $key + "']").not($("[data-el-clone='" + $key + "']"));

				setSeq($siblings, $key);
			}
		});

		$(".ui-sortable-table").sortable("refresh");

		// 전화번호 국가양식
		$.each($("[data-country-phone]"), function(i, o){
			if($(o).data("countryPhonePassed")){
				return;
			}

			var preCountries = ["kr", "sg", "hk", "us", "gb", "ae", "bq" ];
			if($(o).data("countryPreferredCountries")){
				preCountries = $(o).data("countryPreferredCountries");
			}

			$(o).intlTelInput({
				preferredCountries: preCountries
			});

		});
		
		// 주주 개인/법인 스위칭
		$("[data-shareholder-toggle-switch]").unbind("change").bind("change", function(){
			var $this = $(this), $val = $this.data("shareholderToggleSwitch"), $container = $this.closest("[data-shareholder-toggle-container]");
			
			// placeholder 교체 및 초기화
			$.each($container.find("[data-shareholder-toggle-target='placeholder']"), function(i, o){
				$(o).attr("placeholder", $(o).data("shareholderToggleTargetValue" + ($val.charAt(0).toUpperCase() + $val.slice(1)))).val("");
			});

			// 첨부파일셋 교체
			$.each($container.find("[data-shareholder-toggle-target='showhide']"), function(i, o){
				var $o = $(o), $fileContainer = $o.find("[data-provides='fileupload']");
				if($o.data("shareholderToggleTargetValue") == $val){
					$o.removeClass("hide");
				} else {
					$o.addClass("hide");
				}

				// 첨부파일 엘리먼트일 경우
				if($fileContainer.length > 0){
					var $hiddenName = $fileContainer.find("input[type='file']").attr("name") || $fileContainer.children("input[type='hidden']:not([name='fileseq[]'])").attr("name");
					
					$fileContainer.addClass("fileupload-new").removeClass("fileupload-exists");
					$fileContainer.find(".fileupload-preview").text("");
					$fileContainer.children("input[type='hidden']:not([name='fileseq[]'])").remove();
					$fileContainer.find("input[type='file']").attr("name", $hiddenName).val("");
				}
			});
		});
	}
	function setShareholderNames(){
		var $multi = $("#form").find("[data-shareholder-multiname]");
		if($multi.length > 0){
			// checked 유지를 위한 임시 교체
			$.each($multi, function(i, o){
				var $o = $(o), $name = "temp_" + $o.data("shareholderMultiname") + "[" + i + "]";

				$o.attr("name", $name);
				$o.closest("[data-shareholder-toggle-container]").find("[data-shareholder-multiname-siblings]").attr("name", $name);
			});

			// 정상 교체
			$.each($multi, function(i, o){
				var $o = $(o), $name = $o.data("shareholderMultiname") + "[" + i + "]";

				$o.attr("name", $name);
				$o.closest("[data-shareholder-toggle-container]").find("[data-shareholder-multiname-siblings]").attr("name", $name);
			});
		}
	}
	
	$(".ui-sortable-table").sortable({
		handle: '.sortable_handdle',
		items : '.sortable_items',
		cancel: '',
		update: function(event, ui){
			setSeq($(event.target).find("[data-el-seq-use]"), $(event.target).find("[data-el-seq-use]").data("elParent"));
			setShareholderNames();
		}
	}).disableSelection();
	//  $("form").parsley().refresh()

	$(".multiple-select2").select2({
		placeholder: (($(this).data("placeholder")) ? $(this).data("placeholder") : "영업활동을 검색 및 선택해주세요."),
		language: {
			inputTooShort: function (args) {

				return "Type at least 4 characters.";
			},
			noResults: function () {
				return "Not Found.";
			},
			searching: function () {
				return "Searching...";
			}
		},
		minimumInputLength: 4,
	});

	// 숫자만 입력
	$("[data-only-number]").bind("keyup", function(e){
		var only_number = function(n){
			return n.replace(/[^\d,]+/g, '');
		}

		var regx = /[^\d,]+/g;

//		if(!regx.test($(this).val())){
//			e.preventDefault();
//		}
		
		$(this).val(only_number($(this).val()));
	});

	// 숫자 형식 포멧
	$("[data-number-format]").bind("change", function(){
		var number_format = function(num, decimals, dec_point, thousands_sep){
			num = parseFloat(num);
			if(isNaN(num)) return '0';

			if(typeof(decimals) == 'undefined') decimals = 0;
			if(typeof(dec_point) == 'undefined') dec_point = '.';
			if(typeof(thousands_sep) == 'undefined') thousands_sep = ',';
			decimals = Math.pow(10, decimals);

			num = num * decimals;
			num = Math.round(num);
			num = num / decimals;

			num = String(num);
			var reg = /(^[+-]?\d+)(\d{3})/;
			var tmp = num.split('.');
			var n = tmp[0];
			var d = tmp[1] ? dec_point + tmp[1] : '';

			while(reg.test(n)) n = n.replace(reg, "$1"+thousands_sep+"$2");

			return n + d;
		};

		$(this).val(number_format($(this).val()));
	});

	setEvents();

	// Korea Entity Type Branch
	$("[data-branch-hidden]").bind("change", function(){
		var $this = $(this), $isHidden = $this.data("branchHidden");

		if($isHidden){
			$("#branchOtherRadio").prop("checked", "checked").trigger("change");
			$("#branchDefaultRadio").prop("checked", "checked").trigger("change");
			$("[data-branch-change-text]").text("Parent Company");
			$("[data-el-container='addstock']").empty();
			$("[data-branch-hidden-target]").addClass("hide").find("input").val("");
		} else {
			$("#branchDefaultRadio").prop("checked", "checked").trigger("change");
			$("#branchOtherRadio").prop("checked", "checked").trigger("change");
			$("[data-branch-change-text]").text("Shareholder");
			$("[data-branch-hidden-target]").removeClass("hide");
		}
	});

	// 언어 이동
	$("[data-select-country]").bind("change", function(){
		location.href = "/application/" + $(this).find("option:selected").val() + "/";
	});

	$("#form").bind("submit", function(){
		var $cancel = false, $focusEl, $lang = (($(this).data("formLang")) ? $(this).data("formLang") : 'kr');

		var $msg = {
			kr : {
				self_input : '직접 입력란을 입력해주세요.',
				total_sum : '주주 지분의 합이 100이여야 합니다.',
				confirm : '입력하신 내용으로 신청하시겠습니까?'
			},
			en : {
				self_input : '직접 입력란을 입력해주세요.',
				total_sum : 'The sum of all the shareholding percentages must equal to 100.',
				confirm : 'Would you like to submit the application form?'
			},
		};

		if($("[data-min-check]").length > 0 && $("[data-min-check]").val() < $("[data-min-check]").data("minCheck")){
			alert($("[data-min-check]").data("min-err-msg"));
			$("[data-min-check]").focus();
			return false;
		}

		$.each($("[data-hidden-el-toggle-target]:visible"), function(i, o){
			if($(o).val() == ""){
				alert($msg[$lang].self_input);
				$cancel = true;
				$focusEl = $(o);
				return false;
			}
		});
		if($cancel){
			$focusEl.focus();
			return false;
		}

		var $sum = 0;
		$.each($("[data-sum-all]"), function(i, o){
			if($(o).data("sumAllPassed")){
				return;
			}

			$sum += parseInt((($(o).val()) ? $(o).val() : 0));
		});

		// Korea Entitiy Type
		if($("[data-branch-hidden]").length > 0){
			var $isHidden = $("[data-branch-hidden]:checked").data("branchHidden");

			if($isHidden){
				$sum = 100;
			}
		}

		if($sum != 100){
			alert($msg[$lang].total_sum);
			return false;
		}

		if(!confirm($msg[$lang].confirm)){
			return false;
		} else {
			$.each($("[data-country-phone]"), function(i, o){
				var $o = $(o), 
				$iti = $o.data("plugin_intlTelInput");

				if($o.data("countryPhonePassed")){
					return;
				}

				$el = $("<input type='hidden' name='" + $o.data("countryPhone") + "' value='" + $iti.s.dialCode + "' />");

				$("#form").append($el);
			});

			return;
		}
	});

	// 현지대리이사 툴팁
	$("[data-tooltip-acting-local]").tooltip({
		placement : 'bottom',
		title: '모든 싱가포르 법인에는 싱가포르에 거주하는 최소 1명의 현지이사가 필요합니다.',
		trigger: 'manual'
	});
	$("[data-tooltip-acting-local]").tooltip('show');

	// Korea Paid-up Capital 툴팁
	$("[data-tooltip-capital-amount]").tooltip({
		placement : 'bottom',
		title: 'If you are investing 100m won or above, the company will be eligible for a Foreign Direct Invested Enterprise.',
		trigger: 'manual'
	});
	$("[data-tooltip-capital-amount]").tooltip('show');
	$(".capital-amount-tooltip").addClass("hide");
/*
	$("[data-tooltip-acting-local-change]").bind("change", function(){
		console.log($(this).val());
		if($(this).val() == "N"){
			$("[data-tooltip-acting-local]").tooltip('show');
		} else {
			$("[data-tooltip-acting-local]").tooltip('hide');
		}
	});
	*/
/*
	var iti;
	$("#phone").bind("countrychange", function(){
		console.log("Z");
		var $data = $(this).intlTelInput("getCountryData");

		console.log(iti.s.dialCode);
	});
//	iti = $("#phone").data("plugin_intlTelInput");
	// option: initialCountry
*/

	$.each($("#form input, #form select"), function(i ,o){
		$(o).removeAttr("required");
	});
});