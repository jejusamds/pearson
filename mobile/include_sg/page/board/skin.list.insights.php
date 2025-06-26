<?
	function getTopic($txt){
		global $cfg, $boardName;
		$exp = explode(",", $txt);

		$topic = "";
		if(count($exp) > 0){
			foreach($exp as $key => $value){
				$category = preg_replace('/[^가-힣a-zA-Z0-9 ]/', '', $cfg['board']['category'][$boardName][$value]);
				$category = preg_replace('/\s{2,}/', ' ', $category);
				$category = preg_replace('/ /', '-', $category);
				$topic .= " <a href='".$cfg['href']."/insights/category/".$category."/'><span>".$cfg['board']['category'][$boardName][$value]."</span></a>";
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
					<span>INSIGHTS</span>
					<i></i>
					<span><?=(($cfg['board']['category'][$boardName][$_GET['c']] != "") ? $cfg['board']['category'][$boardName][$_GET['c']] : 'All')?></span>
				</div>
			</div>
			<p class="sub_title ty02">Insigthts</p>
			<p class="sub_text ty02">Perspectives on business in Korea and more.</p>
		</div> <!--    sub_box end   -->
	</div><!--   sub_content_box end   -->
	<div class="full_sub_content_box ty02">
		<div class="sub_content_box ty02">
			<div class="contentwrap insightswrap">
				<ul class="insights_tab">
					<li class="<?=(($_GET['c'] == "") ? 'active' : '')?>"><a href="<?=$cfg['href']?><?=$pageDir?>">All</a></li>
					<? foreach($cfg['board']['category'][$boardName] as $key => $value){ ?>
						<?
							$category_tmp = preg_replace('/[^가-힣a-zA-Z0-9 ]/', '', $value);
							$category_tmp = preg_replace('/\s{2,}/', ' ', $category_tmp);
							$category_tmp = preg_replace('/ /', '-', $category_tmp);
						?>
						<li class="<?=isActiveCustom("insights", "c", $key)?>"><a href="<?=$cfg['href']?><?=$pageDir?>category/<?=$category_tmp?>/"><?=$value?></a></li>
					<? } ?>
				</ul>
				<div class="insights_content">
					<? for($i = 0; $i < count($rs); $i++){ ?>
					<? $row = $rs[$i]; ?>
					<div class="box">
						<div class="img_wrap">
							<a href="<?=$cfg['href']?>/insights/<?=$row['permalink']?>/" style="background-image: url(<?=$row['files'][1]['originalSrc']?>);"></a>
						</div>
						<div class="text_wrap">
							<a href="<?=$cfg['href']?>/insights/<?=$row['permalink']?>/">
								<span class="date"><?=date("Y.m.d", strtotime($row['regDate']))?></span>
								<p class="insights_title"><?=cut_str($row['subject'], 25, "...")?></p>
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
				<a href="#" class="more" data-insights-more="true">More view</a>
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
		$("[data-insights-more]").bind("click", function(e){
			e.preventDefault();
			var $this = $(this);
			$this.unbind("click");
			page++;
			$.get("<?=$cfg['href']?>/insights.more/", { "page" : page, "c" : "<?=$_GET['c']?>" }, function(res){
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
