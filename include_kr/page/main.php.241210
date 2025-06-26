<? $isMain = true; ?>
<? include_once __DIR__."/../header.php"; ?>
<div class="intro_container">
	<video muted loop id="myVideo">
		<source src="<?=$cfg['baseUrl']?>/images/main/Singapore_SD_video_0730.mp4" type="video/mp4">
	</video>
	<div class="intro_wrap">
		<? $intro_imgs = array("0.png", "1.png", "2.png", "3.png", "4.png", "5.png", "6.png", "7.png", "8.png", "9.png", "10.png", "11.png", "12.png", "13.png");
			if($_GET['intro'] != "skip"){
		?>

		<div class="bg"></div>
		<div class="intro_txt_wrap">
			<span data-imgs="true" data-img-id="ii1">We&nbsp;</span>
			<span data-imgs="true" data-img-id="ii2">bring&nbsp;</span>
			<span data-imgs="true" data-img-id="ii3">Singapore&nbsp;</span>
			<span data-imgs="true" data-img-id="ii4">to&nbsp;</span>
			<span data-imgs="true" data-img-id="ii5">Korea,&nbsp;</span><br>
			<span data-imgs="true" data-img-id="ii6">and&nbsp;</span>
			<span data-imgs="true" data-img-id="ii7">take&nbsp;</span>
			<span data-imgs="true" data-img-id="ii8">Korea&nbsp;</span>
			<span data-imgs="true" data-img-id="ii9">to&nbsp;</span>
			<span data-imgs="true"  data-img-id="ii10" >Singapore</span>
			<span data-imgs="true" data-img-last="true"><img src="<?=$cfg['baseUrl']?>/images/main/13.png" alt=""></span>
		</div>
		<!--p class="text">싱가포르 비즈니스에 집중하세요. 나머지는 저희가 해결해드립니다.</p-->
		<div class="btn_canvas_wrap">
			<div class="btn_title" data-inquiry-open-btn="true"></div>
			<canvas id="btnCanvas"></canvas>
		</div>
		<a id="introSkip" href="#">Skip</a>
	<? } ?>
	</div>
</div>
<div class="temp"></div>
<div class="bottom_content">
	<div class="content_box">
		<div class="box_wrap">
			<div class="box box_1">
				<a href="<?=$cfg['href']?>/aboutus/whatwedo/">
					<span class="img"></span>
					<div class="inner_box">
						<span class="title">What We Do</span>
						<span class="txt">
							Pearson & Partners는 고객의 주요 <br/>
							관심사를 이해하고 성공적인 싱가포르 <br/>
							진출에 필요한 모든 서비스를 제공합니다.
						</span>
						<span class="more">discover more</span>
					</div>
				</a>
			</div>

			<div class="box box_2">
				<a href="<?=$cfg['href']?>/aboutus/ourmission/">
					<div class="inner_top">
						<span class="img"></span>
					</div>
					<div class="inner_box">
						<span class="title">Our Misson</span>
						<span class="txt">
							 국내 최초 한국기반 싱가포르 전문 컨설팅그룹인 Pearson & Partners는 개척자 정신 <br/>
							(Pioneer Spirit)을 동경합니다.  인류 역사상 가장 강한 국가인 미국은 건국 이전인 18세기<br/> 당시
							구세계였던 유럽에서 신대륙을 찾아 모험을 떠난 초기 이민자들, 그리고 그 이후에는...
						</span>
						<span class="more">discover more</span>
					</div>
				</a>
			</div>

			<div class="box box_3">
				<a href="<?=$cfg['href']?>/ourservice/whysingapore/">
					<span class="img"></span>
					<div class="inner_box">
						<span class="title">Our Services</span>
						<span class="txt">
							싱가포르 정부는 매년 다양하고 혁신적인 <br/>
							친기업적인 정책을 통해 수많은 해외 <br/>
							기업가들을 불러들입니다.
						</span>
						<span class="more">discover more</span>
					</div>
				</a>
			</div>

			<?
				$boardName = "insights";
				$tableName = $cfg['db']['prefix']."board_".$boardName;
				$fileTableName = $cfg['db']['prefix']."boardFile";
				$fileDirectory = $cfg['boardDirectory']."/".$boardName;

				$latestInsights = Queryi("SELECT * FROM $tableName WHERE isDelete = 'N' AND isSecret = 'N' ORDER BY regDate DESC LIMIT 0, 3", $params);

				for($i = 0; $i < count($latestInsights); $i++){
					$temp = Queryi("SELECT * FROM $fileTableName WHERE board = ? and tno = ? ORDER BY seq ASC", array($boardName, $latestInsights[$i]['no']));
					for($j = 0; $j < count($temp); $j++){
						$latestInsights[$i]['files'][$temp[$j]['seq'] - 1] = $temp[$j];
						$latestInsights[$i]['files'][$temp[$j]['seq'] - 1]['originalSrc'] = $fileDirectory."/".$temp[$j]['saveName'];
						$latestInsights[$i]['files'][$temp[$j]['seq'] - 1]['thumbnailSrc'] = $fileDirectory."/thumbnail/thumbnail_".$temp[$j]['saveName'];
					}

					if($latestInsights[$i]['files'][0]['originalSrc'] == "" && in_array($boardName, $cfg['board']['no_image'])){
						$latestInsights[$i]['files'][0]['originalSrc'] = $cfg['baseUrl']."/images/no_image.png";
					}
				}
			?>
			<? if(count($latestInsights) > 0){ ?>
			<div class="box box_4">
				<div class="img_box">
					<span class="box_title">Insights</span>
					<ul class="img_slide">
						<? for($i = 0; $i < count($latestInsights); $i++){ ?>
						<li style="background-image: url(<?=$latestInsights[$i]['files'][0]['originalSrc']?>);"><a href="<?=$cfg['href']?>/insights/<?=$latestInsights[$i]['permalink']?>/" style="display: block; width: 100%; height: 100%;"></a></li>
						<? } ?>
					</ul>
					<ol class="img_num">
						<? for($i = 0; $i < count($latestInsights); $i++){ ?>
						<li class="<?=(($i === 0) ? 'active' : '')?>">
							<a href="#"></a>
						</li>
						<? } ?>
					</ol>
				</div><!--   img_box end  -->

				<div class="insights_box">
					<? for($i = 0; $i < count($latestInsights); $i++){ ?>
					<? $row = $latestInsights[$i]; ?>
					<div class="insights">
						<a href="<?=$cfg['href']?>/insights/<?=$row['permalink']?>/">
							<span class="date"><?=strtoupper(date("M d, Y", strtotime($row['regDate'])))?></span>
							<div class="right_box">
								<span class="insight_title"><?=$row['subject']?></span>
								<span class="insight_txt"><?=cut_str(strip_tags($row['content']), 160, "...")?></span>
							</div>
						</a>
					</div>
					<? } ?>
				</div>
			</div><!--  box_4 end  -->
			<? } ?>
		</div><!--   insights_box   -->
	</div><!--  content_box end-->
</div><!--  bottom_content   -->
<script type="text/javascript" src="<?=$cfg['baseUrl']?>/js/canvasmask.js"></script>
<? include_once __DIR__."/../footer.php"; ?>
