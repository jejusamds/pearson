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
<? for($i = 0; $i < count($rs); $i++){ ?>
<? $row = $rs[$i]; ?>
<div class="box">
	<div class="img_wrap">
		<a href="<?=$cfg['href']?>/testimonials/<?=$row['permalink']?>/" style="background-image: url(<?=$row['files'][1]['originalSrc']?>);"></a>
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
