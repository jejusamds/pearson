<?php
    $cfg['page_code'] = "results/testimonials";
    include_once __DIR__."/../../lib/common.php";

    $boardName = "testimonials_en";
    $tableName = $cfg['db']['prefix']."board_".$boardName;
    $fileTableName = $cfg['db']['prefix']."boardFile";
    $pageDir = "/results/testimonials/";

    $boardCoreOnly = true;
    include_once __DIR__."/../board/board.core.php";

    $introTableName = $cfg['db']['prefix']."board_intro";
    $introRow = Queryi("SELECT content FROM $introTableName WHERE board = ?", array($boardName), true);
    $introText = $introRow['content'];

    include_once __DIR__."/../../header.php";
?>
	<div class="sub_content_wrap">
		<div class="sub_content_box">
			<div class="sub_box">
				<div class="sub_loc">
					<div class="location">
						<span>HOME</span>
						<i></i>
						<span>RESULTS</span>
						<i></i>
						<span>TESTIMONIALS</span>
					</div>
				</div>

				<p class="sub_title ty02">Testimonials</p>

				<div class="sub_text results_sub02">
					<div class="contents_con">					
						<div class="txt_con">
							<div class="text01_con">
                                                                <span><?=$introText?></span>
							</div>
						</div>

						<div class="list_con">
                                                        <ul>
<?php foreach($rs as $row){ ?>
                                                                <li>
                                                                        <div class="list_div">
                                                                               <div class="logo_con">
                                                                               <div class="img_con">
                                                                               <img src="<?=$row['files'][1]['originalSrc']?>" alt="logo" >
                                                                               </div>
                                                                               </div>

                                                                               <div class="txt_con">
                                                                               <div class="text01_con">
                                                                               <span><?=nl2br($row['content'])?></span>
                                                                               </div>

                                                                               <div class="text02_con">
                                                                               <span><?=$row['subject']?></span>
                                                                               </div>

                                                                               <div class="text03_con">
                                                                               <span><?=date('Y.m.d', strtotime($row['regDate']))?></span>
                                                                               </div>
                                                                               </div>
                                                                        </div>
                                                                </li>
<?php } ?>
                                                        </ul>
						</div>
					</div>
				</div>	<!--   sub_text end   -->
				
			</div> <!--    sub_box end   -->
		</div><!--   sub_content_box end   -->
	</div><!--  sub_content_wrap end   -->

<? include_once __DIR__."/../../footer.php"; ?>
