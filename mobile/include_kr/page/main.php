<? $isMain = true; ?>
<? include_once __DIR__."/../header.php"; ?>

<!--개발 붙어야합니다.-->
<div class="popup_con download">
	<div class="contents_con">
		<div class="top_con">
			<div class="txt_con">
				<div class="title_con">
					<span>
						싱가포르 가이드
					</span>
				</div>

				<div class="text_con">
					<span>
						아래의 정보를 입력하시면, <br>
						싱가포르 법인 설립 & 운영에 관한 가이드 <br>
						및 정보를 받아 보실 수 있습니다.
					</span>
				</div>
			</div>

			<div class="btn_con">
				<a href="javascript:download_popup();">
					<img src="<?=$cfg['baseUrl']?>/images/main/popup_closed_btn.png" alt="닫기" >
				</a>
			</div>
		</div>

		<div class="list_con">
			<form action="" method="post" id="download_frm" autocomplete="off">
				<ul>
					<li class="depth_2">
						<div class="list_div">
							<div class="input_con">
								<div class="title_con">
									<span>
										성
									</span>
								</div>

								<div class="input_con">
									<input type="text" name="download_frm_first_name" placeholder="성 입력">
								</div>
							</div>

							<div class="input_con">
								<div class="title_con">
									<span>
										이름
									</span>
								</div>

								<div class="input_con">
									<input type="text" name="download_frm_last_name" placeholder="이름 입력">
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="list_div">
							<div class="input_con">
								<div class="title_con">
									<span>
										회사명
									</span>
								</div>

								<div class="input_con">
									<input type="text" name="download_frm_company_name" placeholder="회사명 입력">
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="list_div">
							<div class="input_con">
								<div class="title_con">
									<span>
										이메일
									</span>
								</div>

								<div class="input_con">
									<input type="text" name="download_frm_email" placeholder="이메일 입력">
								</div>
							</div>
						</div>
					</li>
				</ul>
			</form>
		</div>

		<div class="btn_con">
			<!--a href="<?=$cfg['baseUrl']?>/images/common/guide_to_singapore.pdf" target="_blank"-->
			<a href="javascript:void(0);" onclick="go_download();">
				다운로드
			</a>
		</div>
	</div>
</div>
<!--개발 붙어야합니다.-->

<div class="intro_container">
	<div class="<? if($_GET['intro'] != "skip"){echo "intro_skip";}?>"></div>
	<div class="intro_wrap">
	<? $intro_imgs = array("0.png", "1.png", "2.png", "3.png", "4.png", "5.png", "6.png", "7.png", "8.png", "9.png", "10.png", "11.png", "12.png", "13.png");
	?>
		<div class="btn_canvas_wrap">
			<div class="btn_title" data-inquiry-open-btn="true"></div>
			<canvas id="btnCanvas"></canvas>
		</div>
		<? if($_GET['intro'] != "skip"){?>
		<a id="introSkip" href="#">Skip</a>
		<? } ?>
		<div class="bg"></div>
		<div class="intro_txt_wrap">
			<span data-imgs="true" data-img-id="ii1">We&nbsp;</span>
			<span data-imgs="true" data-img-id="ii2">bring&nbsp;</span>
			<span data-imgs="true" data-img-id="ii3">Singapore&nbsp;</span><br>
			<span data-imgs="true" data-img-id="ii4">to&nbsp;</span>
			<span data-imgs="true" data-img-id="ii5">Korea,&nbsp;</span>
			<span data-imgs="true" data-img-id="ii6">and&nbsp;</span>
			<span data-imgs="true" data-img-id="ii7">take&nbsp;</span><br>
			<span data-imgs="true" data-img-id="ii8">Korea&nbsp;</span>
			<span data-imgs="true" data-img-id="ii9">to&nbsp;</span>
			<span data-imgs="true"  data-img-id="ii10" >Singapore</span>
			<span data-imgs="true" data-img-last="true"><img src="<?=$cfg['baseUrl']?>/images/main/13.png" alt=""></span>
		</div>
		<!--p class="text">싱가포르 비즈니스에 집중하세요. <br />나머지는 저희가 해결해드립니다.</p-->
	</div>
</div>
<div class="main_container">
	<div class="main_video">
		<video id="myVideo" src="<?=$cfg['baseUrl']?>/images/main/main_bg_0805.mp4" playsinline loop muted></video>
	</div>
	<a class="boxwrap" href="<?=$cfg['href']?>/aboutus/whatwedo/">
		<div class="box">
			<img src="<?=$cfg['baseUrl']?>/images/main/main_img1.png" alt="">
		</div>
		<div class="box ty01">
			<p class="title">What We Do</p>
			<p class="txt">Pearson & Partners는 고객의 주요
			관심사를 이해하고 성공적인 싱가포르
			진출에 필요한 모든 서비스를 제공합니다.</p>
		</div>
	</a>
	<a class="boxwrap ty02" href="<?=$cfg['href']?>/aboutus/ourmission/">
		<p class="title">Our Mission</p>
		<img src="<?=$cfg['baseUrl']?>/images/main/main_img_02_0312.png" alt="">
		<p class="txt">국내 최초 한국기반 싱가포르 전문 컨설팅그룹인 Pearson & Partners는 개척자 정신 (Pioneer Spirit)을 동경합니다. 인류 역사상 가장 강한 국가인 미국은 건국 이전인 18세기 당시
	 구세계였던 유럽에서 신대륙을 찾아 모험을 떠난 초기 이민자들, 그리고 그 이후에는...</p>
	</a>
	<a class="boxwrap" href="<?=$cfg['href']?>/ourservice/whysingapore/">
		<div class="box ty02">
			<p class="title">Our Services</p>
			<p class="txt">싱가포르 정부는 매년 다양하고 혁신적인 친기업적인 정책을 통해 수많은 해외 기업가들을 불러들입니다.</p>
		</div>
		<div class="box  ty03">
			<img src="<?=$cfg['baseUrl']?>/images/main/main_img_03.png" alt="">
		</div>
	</a>
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
	<div class="slide">
		<? for($i = 0; $i < count($latestInsights); $i++){ ?>
		<? $row = $latestInsights[$i]; ?>
		<div>
			<a href="<?=$cfg['href']?>/insights/<?=$row['permalink']?>/">
				<p class="img_wrap" style="background-image: url(<?=$row['files']['0']['originalSrc']?>);"></p>
				<p class="text_wrap">
					<span class="date"><?=strtolower(date("M d, Y", strtotime($row['regDate'])))?></span>
					<span class="content">
						<i class="title"><?=$row['subject']?></i>
						<i class="text"><?=cut_str(strip_tags($row['content']), 100, "...")?></i>
					</span>
				</p>
			</a>
		</div>
		<? } ?>
	</div>
	<script type="text/javascript" src="<?=$cfg['baseUrl']?>/js/canvasmask.js"></script>
 <? include_once __DIR__."/../footer.php"; ?>
