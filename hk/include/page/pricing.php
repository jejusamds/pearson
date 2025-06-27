<?
	$cfg['page_code'] = "pricing";
	include_once __DIR__."/../lib/common.php";
	include_once __DIR__."/../header.php";
?>
<div class="sub_content_wrap">
	<div class="sub_content_box">
		<div class="sub_box">
			<div class="sub_loc">
				<div class="location">
					<span>HOME</span>
					<i></i>
					<span>pricing</span>
				</div>
			</div>
			<p class="sub_title ty02 ">서비스 비용</p>
			<p class="sub_text ">싱가포르 법인설립 및 운영관리에 소요되는 합리적인 비용을 투명하게 공개합니다.</p>
			<div class="pricing_wrap event">
				<div class="title">
					<ul class="contact_tab">
						<li class="active"><a href="#" data-tab-id=".pricing_tab_impo">법인설립</a></li>
						<li class=""><a href="#" data-tab-id=".pricing_tab_tax">세무회계</a></li>
						<li class=""><a href="#" data-tab-id=".pricing_tab_mange">운영관리</a></li>
						<li class=""><a href="#" data-tab-id=".pricing_tab_visa">비자</a></li>
					</ul>
				</div>

				<!-- 법인설립 -->
				<div class="pricing_item pricing_tab_impo">
					<table class="pricing_table">
						<colgroup>
							<col width="32.3%">
							<col width="42.7%">
							<col width="25%">
						</colgroup>
						<tbody>
							<tr>
								<th colspan="2">서비스</th>
								<th>비용 (만원)</th>
							</tr>
							<tr>
								<td class="th text-left" rowspan="6">1. 현지대리이사를 통한 법인설립<br />- 싱가포르에 실제 거주하지 않을 경우</td>
								<td>법인설립</td>
								<td class="text-center">140</td>
							</tr>
							<tr>
								<td>현지대리이사 (12개월)</td>
								<td class="text-center">300</td>
							</tr>
							<tr>
								<td>서기 (12개월)</td>
								<td class="text-center">100</td>
							</tr>
							<tr>
								<td>법인주소지 (12개월)</td>
								<td class="text-center">50</td>
							</tr>
							<tr>
								<td><strong>합계</strong></td>
								<td class="text-center"><strong>590</strong><br />(은행계좌개설 시 + 50만원)</td>
							</tr>
							<tr>
								<td>+ 보증금</td>
								<td class="text-center">150</td>
							</tr>
						</tbody>
					</table>

					<table class="pricing_table">
						<colgroup>
							<col width="32.3%">
							<col width="42.7%">
							<col width="25%">
						</colgroup>
						<tbody>
							<tr>
								<th colspan="2">서비스</th>
								<th>비용 (만원)</th>
							</tr>
							<tr>
								<td class="th text-left" rowspan="6">2. 법인설립 및 비자신청<br />- 싱가포르에 실제 거주 목적인 경우</td>
								<td>법인설립</td>
								<td class="text-center">140</td>
							</tr>
							<tr>
								<td>현지대리이사 (3개월)</td>
								<td class="text-center">90</td>
							</tr>
							<tr>
								<td>서기 (12개월)</td>
								<td class="text-center">100</td>
							</tr>
							<tr>
								<td>법인주소지 (12개월)</td>
								<td class="text-center">50</td>
							</tr>
							<tr>
								<td>EP 비자</td>
								<td class="text-center">190</td>
							</tr>
							<tr>
								<td><strong>합계</strong></td>
								<td class="text-center"><strong>570</strong><br />(은행계좌개설 시 + 50만원)</td>
							</tr>

						</tbody>
					</table>
				</div>

				<!-- 세무회계 -->
				<div class="pricing_item pricing_tab_tax" style="display: none;">
					<table class="pricing_table">
						<colgroup>
							<col width="75%">
							<col width="25%">
						</colgroup>
						<tbody>
							<tr>
								<th>서비스</th>
								<th>비용 (만원)</th>
							</tr>
							<tr>
								<td class="text-center">회계기장</td>
								<td class="text-center">월 30~</td>
							</tr>
							<tr>
								<td class="text-center">비감사보고서</td>
								<td class="text-center">70</td>
							</tr>
							<tr>
								<td class="text-center">법인세신고</td>
								<td class="text-center">70</td>
							</tr>
							<tr>
								<td class="text-center">추정손익보고</td>
								<td class="text-center">30</td>
							</tr>
							<tr>
								<td class="text-center">연례보고/주주총회</td>
								<td class="text-center">20</td>
							</tr>
							<tr>
								<td class="text-center">GST 등록</td>
								<td class="text-center">50</td>
							</tr>
							<tr>
								<td class="text-center">GST 신고 (분기 별)</td>
								<td class="text-center">70</td>
							</tr>
							<tr>
								<td class="text-center">원천세 신고</td>
								<td class="text-center">15</td>
							</tr>
							<tr>
								<td class="text-center">페이롤</td>
								<td class="text-center">월 15~</td>
							</tr>
						</tbody>
					</table>
				</div>

				<!-- 운영관리 -->
				<div class="pricing_item pricing_tab_mange" style="display: none;">
					<table class="pricing_table">
						<colgroup>
							<col width="75%">
							<col width="25%">
						</colgroup>
						<tbody>
							<tr>
								<th>서비스</th>
								<th>비용 (만원)</th>
							</tr>
							<tr>
								<td class="text-center">은행계좌개설</td>
								<td class="text-center">50</td>
							</tr>
							<tr>
								<td class="text-center">해외투자신고</td>
								<td class="text-center">50</td>
							</tr>
							<tr>
								<td class="text-center">우편 스캔 서비스 (12개월)</td>
								<td class="text-center">50</td>
							</tr>
							<tr>
								<td class="text-center">현지 전화번호 서비스 (12개월)</td>
								<td class="text-center">30</td>
							</tr>
							<tr>
								<td class="text-center">이사 변경</td>
								<td class="text-center">30</td>
							</tr>
							<tr>
								<td class="text-center">지분 양도</td>
								<td class="text-center">30</td>
							</tr>
							<tr>
								<td class="text-center">자본금 증자</td>
								<td class="text-center">30</td>
							</tr>
							<tr>
								<td class="text-center">법인명 변경</td>
								<td class="text-center">20</td>
							</tr>
							<tr>
								<td class="text-center">영업활동 변경</td>
								<td class="text-center">20</td>
							</tr>
							<tr>
								<td class="text-center">법인주소 변경</td>
								<td class="text-center">20</td>
							</tr>
							<tr>
								<td class="text-center">법인 해산</td>
								<td class="text-center">70</td>
							</tr>
						</tbody>
					</table>
				</div>

				<!-- 비자 -->
				<div class="pricing_item pricing_tab_visa" style="display: none;">
					<table class="pricing_table">
						<colgroup>
							<col width="75%">
							<col width="25%">
						</colgroup>
						<tbody>
							<tr>
								<th>서비스</th>
								<th>비용 (만원)</th>
							</tr>
							<tr>
								<td class="text-center">EP 비자</td>
								<td class="text-center">190</td>
							</tr>
							<tr>
								<td class="text-center">DP 비자 (동반가족)</td>
								<td class="text-center">70</td>
							</tr>
						</tbody>
					</table>
				</div>

			</div>
		</div> <!--    sub_box end   -->
	</div><!--   sub_content_box end   -->
</div><!--  sub_content_wrap end   -->
<script>
$(function(){
	$(".contact_tab a").bind("click", function(e){
		e.preventDefault();
		
		var $this = $(this), $target = $this.data("tabId");

		$this.closest(".contact_tab").find("a").not($this).parent().removeClass("active");
		$this.parent().addClass("active");

		$(".pricing_item").not($target).hide();
		$(".pricing_item" + $target).show();
	});
});
</script>
<? include_once __DIR__."/../footer.php"; ?>
