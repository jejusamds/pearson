<?
	function getTopic($txt){
		global $cfg, $boardName;
		$exp = explode(",", $txt);

		$topic = "";
		if(count($exp) > 0){
			foreach($exp as $key => $value){
				$topic .= " <a href='".$cfg['href']."/testimonials/?c=".$value."'><span>".$cfg['board']['category'][$boardName][$value]."</span></a>";
			}
		}

		return $topic;
	}
?>
<div class="sub_content_wrap">
	<div class="sub_content_box">
		<div class="sub_box">
			<div class="sub_loc">
				<div class="location">
					<span>HOME</span>
					<i></i>
					<span>TESTIMONIALS</span>
					<i></i>
					<span><?=(($cfg['board']['category'][$boardName][$_GET['c']] != "") ? $cfg['board']['category'][$boardName][$_GET['c']] : 'All')?></span>
				</div>
			</div>
			<p class="sub_title ty02">Testimonials</p>
			<p class="sub_text ty02">Perspectives on business in Singapore and more.</p>
		</div> <!--    sub_box end   -->
	</div><!--   sub_content_box end   -->
	<div class="full_sub_content_box ty02">
		<div class="sub_content_box ty02">
			<div class="contentwrap insightswrap">
				<div class="insights_content">
					<? for($i = 0; $i < count($rs); $i++){ ?>
					<? $row = $rs[$i]; ?>
					<div class="box">
						<div class="img_wrap">
							<a href="<?=$cfg['href']?>/testimonials/?v=<?=$row['no']?>&c=<?=$_GET['c']?>" style="background-image: url(<?=$row['files'][1]['originalSrc']?>);"></a>
						</div>
						<div class="text_wrap">
							<a href="<?=$cfg['href']?>/testimonials/?v=<?=$row['no']?>&c=<?=$_GET['c']?>">
								<span class="date"><?=date("Y.m.d", strtotime($row['regDate']))?></span>
								<p class="insights_title"><?=$row['subject']?></p>
								<p class="insights_text"><?=cut_str(strip_tags($row['content']), 145, "...")?></p>
							</a>
							<div class="topicwrap">
								<? $topic = getTopic($row['category']); ?>
								<? if($topic != ""){ ?>
									<i class="topic">TOPIC : </i><?=$topic?>
								<? } ?>
							</div>
						</div>
					</div>
					<? } ?>
				</div>
				<? if($dataCount > $pagingItemMax * $_GET['page']){ ?>
				<a href="#" class="more" data-testimonials-more="true">More view</a>
				<? } ?>
			</div>
		</div>
	</div>
</div>
<script>
$(function(){
	var page = <?=$_GET['page']?>;
	var maxDataCount = <?=$dataCount?>;

	var $innerBox = $(".insights_content");

	function setMoreBtnEvent(){
		$("[data-testimonials-more]").bind("click", function(e){
			e.preventDefault();
			var $this = $(this);
			$this.unbind("click");
			page++;
			$.get("<?=$cfg['href']?>/testimonials.more/", { "page" : page, "c" : "<?=$_GET['c']?>" }, function(res){
				$innerBox.append(res);

				if($innerBox.find(".box").length == maxDataCount){
					$this.hide();
				} else {
					setMoreBtnEvent();
				}
			});
		});
	}

	if($innerBox.find(".box").length != maxDataCount){
		setMoreBtnEvent();
	}
});
</script>
