<script>
$(function(){
	$('[data-faq-show-btn]').click(function(e){
		e.preventDefault();
		var $this = $(this), $cate = $this.data("faqShowBtn");

		if(!$this.hasClass("active")){
			$this.addClass("active").siblings().removeClass("active");
			$("[data-faq-category]").removeClass("active");
			$(".qna_item_view").slideUp();

			if($cate == "all"){
				$("[data-faq-category]").css('display','block');
			} else {
				$("[data-faq-category]").not($("[data-faq-category='" + $cate + "']")).css("display", "none");
				$("[data-faq-category='" + $cate + "']").css('display','block');
			}
		}
	});
});
</script>
<div class="sub_content_wrap faqsWrap">
	<div class="sub_content_box">
		<div class="sub_box">
			<div class="sub_loc">
				<div class="location">
					<span>HOME</span>
					<i></i>
					<span>OUR SERVICES</span>
					<i></i>
					<span>FAQs</span>
				</div>
			</div>
			<p class="sub_title ty02">FAQs</p>
			<p class="sub_text ty02">자주 묻는 질문</p>
			<div class="contentwrap faqwrap">
				<div class="tab_btn_box">
					<ul>
						<li class="all" data-faq-show-btn="all">전체</li>
						<? $i = 0;?>
						<? foreach($cfg['board']['category'][$boardName] as $key => $value){ ?>
							<li class="<? if($i === 0 ){ echo 'active'; $first_cate = $key; }?>" data-faq-show-btn="<?=$key?>"><?=$value?></li>
							<? $i++; ?>
						<? } ?>
					</ul>
				</div>
				<ul class="accordion">
					<? 	for($i = 0; $i < count($rs); $i++){ ?>
					<? $row = $rs[$i]; ?>
					<li class="qna_item<?=(($row['category'] == $first_cate && $row['category'] != $rs[$i - 1]['category']) ? ' active' : '')?>" data-faq-category="<?=$row['category']?>" style="<?=(($row['category'] == $first_cate) ? 'display: block' : 'display: none')?>">
						<div class="qna_item_wrap">
							<div class="qna_item_list">
								<div class="qna_item_title">
									<span><?=$cfg['board']['category'][$boardName][$row['category']]?></span>
									<h2><?=$row['subject']?></h2>
								</div>
							</div>
							<div class="qna_item_view" <?=(($row['category'] == $first_cate && $row['category'] != $rs[$i - 1]['category']) ? 'style="display: block;"' : '')?>>
								<div class="bc"><?=$row['content']?></div>
							</div>
						</div>
					</li>
					<? } ?>
				</ul>
			</div>
			<div class="sub_content_box ty02">
				<div class="contentwrap servicewrap pb60">
				<p class="txt2">아래 <a href="<?=$cfg['href']?>/download/">Download</a>를 통해 싱가포르 가이드를 받아보실 수 있습니다. <br>
					<a href="<?=$cfg['href']?>/insights/">Insights</a> 에서 싱가포르 최신 소식을 받아보세요.
					</p>
				</div>
			</div>

		</div>
	</div>
</div>
