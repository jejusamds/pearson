<?if($dataCount > 0 && $pageTotal > 1){?>
	<div class="col-md-12 text-center">
		<ul class="pagination m-t-0 m-b-10">
			<?=getPageBtns($dataCount, $_GET['page'], $pagingItemMax, $pagingBlockMax, "$_SERVER[PHP_SELF]?$qstr"); ?>
		</ul>
	</div>
<? } ?>