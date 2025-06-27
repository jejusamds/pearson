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
<div class="sub_content_wrap">
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
			<p class="sub_text ty02">Here are the most asked questions about doing business in Korea.</p>
			<div class="contentwrap faqwrap">
				<div class="tab_btn_box">
					<ul>
						<li class="all" data-faq-show-btn="all">All</li>
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
		</div>
	</div>
</div>
