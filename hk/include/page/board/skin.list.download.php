<div class="sub_content_wrap">
	<div class="sub_content_box">
		<div class="sub_box">
			<div class="sub_loc">
				<div class="location">
					<span>HOME</span>
					<i></i>
					<span>download</span>
				</div>
			</div>
			<p class="sub_title ty02">download</p>
			<p class="sub_text ">싱가포르 비즈니스에 도움이 되는 다양한 자료들을 제공합니다.</p>
			<div class="whywrap download">
				<div class="downloadwrap">
					<? for($i = 0; $i < count($rs); $i++){ ?>
					<? $row = $rs[$i]; ?>
						<? if(($i + 1) % 2 !== 0){ ?>
							<div class="box-row">
						<? } ?>
						<div class="box">
							<div class="imgbox" style="background-image: url(<?=$row['files']['0']['originalSrc']?>)"></div>
							<div class="txtbox">
								<p><?=$row['subject']?></p>
								<span><?=nl2br($row['content'])?></span>
								<a href="<?=$cfg['href']?>/download/?v=<?=$row['no']?>">download<i class="down"></i></a>
							</div>
						</div>
						<? if(($i + 1) % 2 === 0 || $i + 1 === count($rs)){ ?>
							</div>
						<? } ?>
					<? } ?>
				</div>
				<? include_once __DIR__."/board.paginate.php"; ?>
			</div>
		</div> <!--    sub_box end   -->
	</div><!--   sub_content_box end   -->
	</div>
</div><!--  sub_content_wrap end   -->
