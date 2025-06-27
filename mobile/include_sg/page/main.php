<? $isMain = true; ?>
<? include_once __DIR__."/../header.php"; ?>

<!--개발 붙어야합니다.-->
<div class="popup_con download">
	<div class="contents_con">
		<div class="top_con">
			<div class="txt_con">
				<div class="title_con">
					<span>
						A Guide to Doing Business in Korea
					</span>
				</div>

				<div class="text_con">
					<span>
						From starting business in Korean <br>
						and settling down, this guide provides you <br>
						free information to ease your way <br>
						to a successful business.
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
										First Name
									</span>
								</div>

								<div class="input_con">
									<input type="text" name="download_frm_first_name" placeholder="ex. Hong">
								</div>
							</div>

							<div class="input_con">
								<div class="title_con">
									<span>
										Last Name
									</span>
								</div>

								<div class="input_con">
									<input type="text" name="download_frm_last_name" placeholder="ex. Gil Dong">
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="list_div">
							<div class="input_con">
								<div class="title_con">
									<span>
										Company
									</span>
								</div>

								<div class="input_con">
									<input type="text" name="download_frm_company_name" placeholder="ex. Pearson & Partners">
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="list_div">
							<div class="input_con">
								<div class="title_con">
									<span>
										E-Mail
									</span>
								</div>

								<div class="input_con">
									<input type="text" name="download_frm_email" placeholder="ex. pearson@gmail.com">
								</div>
							</div>
						</div>
					</li>
				</ul>
			</form>
		</div>

		<div class="btn_con">
			<!--a href="<?=$cfg['baseUrl']?>/images/common/guide_to_korea.pdf" target="_blank"-->
			<a href="javascript:void(0);" onclick="go_download();">
				Download
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
			<span data-imgs="true" data-img-id="ii3">the&nbsp;</span>
			<span data-imgs="true" data-img-id="ii4">world&nbsp;</span><br>
			<span data-imgs="true" data-img-id="ii4">to&nbsp;</span>
			<span data-imgs="true" data-img-id="ii5">Korea&nbsp;</span>
			<span data-imgs="true" data-img-id="ii6">and&nbsp;</span>
			<span data-imgs="true" data-img-id="ii7">take&nbsp;</span>
			<span data-imgs="true" data-img-id="ii8">Korea&nbsp;</span><br>
			<span data-imgs="true" data-img-id="ii9">to&nbsp;</span>
			<span data-imgs="true" data-img-id="ii9">the&nbsp;</span>
			<span data-imgs="true"  data-img-id="ii10" >world</span>
			<span data-imgs="true" data-img-last="true"><img src="<?=$cfg['baseUrl']?>/images/main/13.png" alt=""></span>
		</div>
		<!--p class="text">Making a complex world simple.</p-->
	</div>
</div>
<div class="main_container">
	<div class="main_video">
		<video id="myVideo" src="<?=$cfg['baseUrl']?>/images/main/main_bg_0803.mp4" playsinline loop muted></video>
	</div>
	<a class="boxwrap" href="<?=$cfg['href']?>/aboutus/whatwedo/">
		<div class="box">
			<img src="<?=$cfg['baseUrl']?>/images/main/main_img_01.png" alt="">
		</div>
		<div class="box ty01">
			<p class="title">What We Do</p>
			<p class="txt">	We make it easier for foreign entrepreneurs to build their businesses in Korea.</p>
		</div>
	</a>
	<a class="boxwrap ty02" href="<?=$cfg['href']?>/aboutus/ourmission/">
		<p class="title">Our Mission</p>
		<img src="<?=$cfg['baseUrl']?>/images/main/main_img_02_0312.png" alt="">
		<p class="txt">
			 We admire the Pioneer Spirit. The United States was able to become what it is now because of the pioneers. Immigrants who left the Old World in late 18th century for the New World, and then...
		</p>
	</a>
	<a class="boxwrap" href="<?=$cfg['href']?>/ourservice/overview/">
		<div class="box ty02">
			<p class="title">Our Services</p>
			<p class="txt">	We provide a wide range of professional corporate services including incorporation...</p>
		</div>
		<div class="box">
			<img src="<?=$cfg['baseUrl']?>/images/main/main_img_03.png" alt="">
		</div>
	</a>
	<?
		$boardName = "insights_sg";
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
