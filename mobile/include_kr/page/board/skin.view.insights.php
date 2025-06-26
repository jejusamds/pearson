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
				$topic .= " <span><a href='".$cfg['href']."/insights/category/".$category."/'>".$cfg['board']['category'][$boardName][$value]."</a></span>";
			}
		}

		return $topic;
	}

	if($self['isSecret'] == 'Y'){
		redirectUrl("/insights/"); exit;
	}
?>
<div class="sub_content_wrap">
	<div class="sub_content_box">
		<div class="sub_box pb0">
			<div class="sub_loc">
				<div class="location">
					<span>HOME</span>
					<i></i>
					<span>INSIGHTS</span>
					<i></i>
					<span><?=(($cfg['board']['category'][$boardName][$_GET['c']] != "") ? $cfg['board']['category'][$boardName][$_GET['c']] : '전체')?></span>
				</div>
			</div>
			<div class="contentwrap insights insights_view" id="section-to-print">
				<div class="share-services share-buttons light social-share-bar" >
	      <button class="icon-share "><i class="far icon_share"></i></button>
	      <div class="share-options">
	      	<div class="share-options-inner">
			<? $shareURL = urlencode("http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']); ?>
		       <a href="mailto:?subject=<?=$self['subject']?>&body=<?=$shareURL?>" class=" share-item share-enabled" ><i class="far mail"></i></a>
		       <a href="https://www.facebook.com/sharer/sharer.php?u=<?=$shareURL?>" target="_blank" class="share-item share-enabled"><i class="far facebook"></i></a>
		       <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?=$shareURL?>&title=<?=urlencode($self['subject'])?>&summary=&source=" target="_blank" class="share-item share-enabled" ><i class="far in"></i></a>
		       <a href="http://line.me/R/msg/text/?<?=$self['subject']?>.'\n'.<?=$shareURL?>" target="_blank" class=" share-item share-enabled"><i class="far line"></i></a>
		       <a href="https://twitter.com/home?status=<?=$shareURL?>" target="_blank" class=" share-item share-enabled"><i class="far twitter"></i></a>
		       <a href="whatsapp://send?text=<?=$shareURL?>" class=" share-item share-enabled"><i class="far what"></i></a>
		       <a href="#" class="share-item share-enabled" id="printDetail"><i class="far print"></i></a>
		       <a href="#" class="share-item share-enabled" data-clipboard-target="<?=$_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']?>"><i class="far link"></i></a>
	       </div>
	       <a href="#" class="icon-close_large"><i class="far close"></i></a>
	      </div>
	     </div>
			 <div class="data">
				<span><?=strtoupper(date("d M Y", strtotime($self['regDate'])))?></span>
			 </div>

			 <h1 class="title"><?=$self['subject']?></h1>
			 <div class="topicwrap">
				<? $topic = getTopic($self['category']); ?>
				<? if($topic != ""){ ?>
					<i class="topic">TOPIC : </i><?=$topic?>
				<? } ?>
			 </div>
			 <div class="textwrap">
				 <? if($self['files'][2]['originalSrc'] != ""){ ?>
				<video controls style="display: block; margin: 0 auto;">
					<source src="<?=$self['files'][2]['originalSrc']?>" type="video/mp4">
				</video>
				 <br /><br/>
				 <? } ?>
				 <?=$self['content']?>
			</div>
			 <? if($self['files'][3]['originalSrc'] != ""){ ?>
			 <div class="file">
				<i class="downfile"></i><span class="ic">첨부파일</span><a href="<?=$cfg['href']?>/board/board.download/?b=<?=$boardName?>&n=<?=$self['files'][3]['no']?>" target="_blank"><?=$self['files'][3]['realName']?></a>
			 </div>
			 <? } ?>
			</div>
		</div> <!--    sub_box end   -->
	</div><!--   sub_content_box end   -->
	<div class="full_sub_content_box ty02">
		<div class="sub_content_box ty02">
				<div class="contentwrap insights more">
					<h1 class="title">Explore More Insights</h1>
					<div class="more_content">
						<? for($i = 0; $i < count($latest); $i++){ ?>
							<? $row = $latest[$i]; ?>
							<div class="box">
								<a href="<?=$cfg['href']?>/insights/<?=$row['permalink']?>/">
								<div class="img_wrap" style="background-image:url('<?=$row['files'][1]['originalSrc']?>');background-position:center center; background-size: 100%"></div>
									<div class="text_wrap">
										<h4><?=cut_str($row['subject'], 20, "...")?></h4>
										<p><?=cut_str(strip_tags($row['content']), 180, "...")?></p>
										<span class="read">read more <i class="more"></i></span>
									</div>
								</a>
							</div>
						<? } ?>
					</div>
				<a href="<?=$cfg['href']?>/insights/<?=(($_SESSION[$keep_session_name]['cpl'] != "") ? 'category/'.$_SESSION[$keep_session_name]['cpl']."/" : '')?>" class="all_btn">Explore All Insights</a>
			</div>
		</div>
	</div>
</div>
<script>
$(function(){
	$("[data-clipboard-target]").bind("click", function(e){
		e.preventDefault();

		var $this = $(this), $txt = $this.data("clipboardTarget");

		var hiddenDiv = $('<div/>').css( {
			height: 1,
			width: 1,
			overflow: 'hidden',
			position: 'fixed',
			top: 0,
			left: 0
		} );

		var textarea = $('<textarea readonly/>')
			.val($txt)
			.appendTo( hiddenDiv );

		if ( document.queryCommandSupported('copy') ) {
			hiddenDiv.appendTo( 'body' );
			textarea[0].focus();
			textarea[0].select();

			try {
				document.execCommand( 'copy' );
				hiddenDiv.remove();
				alert("클립보드에 복사되었습니다.");
				return;
			}
			catch (t) {}

		} else {
			// ELSE
		}
	});

	$(document).on('click', '.icon-share, .icon-close_large', function (e) {
		e.preventDefault();
		$('.share-services').toggleClass('expanded');
	});

	$("#printDetail").bind("click", function(e){
		e.preventDefault();

		window.print();
	});
});
</script>
<style>
@media print {
  body * {
    visibility: hidden;
  }
  #section-to-print, #section-to-print * {
    visibility: visible;
  }
  #section-to-print {
    position: absolute;
    left: 0;
    top: -195px;
    z-index: 970;
    padding-bottom: 0;
  }

  #section-to-print .share-services {
    visibility: hidden;
    display: none;
  }
}
</style>