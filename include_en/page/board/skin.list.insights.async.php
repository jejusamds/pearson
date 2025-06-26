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
<? for($i = 0; $i < count($rs); $i++){ ?>
<? $row = $rs[$i]; ?>
<div class="box">
	<div class="img_wrap">
		<a href="<?=$cfg['href']?>/insights/<?=$row['permalink']?>/" style="background-image: url(<?=$row['files'][1]['originalSrc']?>);"></a>
	</div>
	<div class="text_wrap">
		<a href="<?=$cfg['href']?>/insights/<?=$row['permalink']?>/">
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