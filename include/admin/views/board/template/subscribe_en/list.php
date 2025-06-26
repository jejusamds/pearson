<script>
	$(function(){
		$("input[name='search']").focus();
		$("input[name='search']").val($("input[name='search']").val());

		$(".delete-confirm").bind("submit", function(){
			if(!confirm("정말 삭제하시겠습니까?")){
				return false;
			}
		});
	});
</script>
<!-- begin #content -->
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
		<li><a href="<?=$cfg['dir']['admin']?>/views/dashboard.php">Home</a></li>
		<li>게시판 관리</li>
		<li class="active"><?=$cfg['board']['type_sg_en'][$_GET['board']]?></li>
	</ol>
	<h1 class="page-header"><?=$cfg['board']['type_sg_en'][$_GET['board']]?></h1>
	<!-- end page-header -->
	<!-- begin row -->
	<div class="row">
		<div class="col-md-12">
			<!-- begin panel -->
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="row">
						<div class="col-sm-6"><h4 class="panel-title">Showing <?=$fromLimit?> to <?=$pagingItemMax?> of <?=$dataCount?> entries</h4></div>
						<div class="col-sm-6 text-right"><a href="board_edit.php?board=<?=$_GET['board']?>&mode=create" class="btn btn-sm btn-primary">등록</a></div>
					</div>
				</div>
				<div class="panel-body">
					<div class="col-md-12 m-b-10 text-right p-l-0 p-r-0">
						<form class="form-group" action="" method="GET">
							<input type="hidden" name="board" value="<?=$_GET['board']?>">
							<input type="text" class="form-control" name="search" placeholder="검색어" value="<?=$_GET['search']?>" />
							<button type="submit" class="hidden-xs hidden-lg hidden-sm hidden-md btn btn-sm btn-primary m-r-5">검색</button>
						</form>
					</div>
					<table class="table">
						<thead>
							<tr>
								<th width="10%">#</th>
								<th width="30%">이메일</th>
								<th width="30%">구독 신청 날짜</th>
								<th width="30%">&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$rowNo = $dataCount - $pagingItemMax * ($_GET['page'] - 1);
								foreach ($rs as $row){
							?>
								<tr>
									<td><?=$rowNo?></td>
									<td><span class="ellipsis"><?=decodeData($row['email'])?></span></td>
									<td><?=$row['regDate']?></td>
									<td>
										<? if($_SESSION['userLevel'] > 100){ ?>
										<form action="board_process.php" method="post" style="display: inline;" class="delete-confirm">
											<input type="hidden" name="board" value="<?=$_GET['board']?>" />
											<input type="hidden" name="qstr" value="<?=$qstr?><?=$_GET['page']?>" />
											<input type="hidden" id="mode" name="mode" value="delete" />
											<input type="hidden" name="no" value="<?=$row['no']?>">
											<button type="submit" class="btn btn-xs btn-warning m-r-5">삭제</button>
										</form>
										<? } ?>
									</td>
								</tr>
								<? $rowNo--;?>
							<? } ?>
							<? if(count($rs) < 1){ echo "<tr><td colspan='4' class='text-center'>No Data</td></tr>"; } ?>
						</tbody>
					</table>
				</div>
				<?if($dataCount > 0 && $pageTotal > 1){?>
					<div class="panel-footer">
						<div class="row">
							<? include_once $cfg['root'].$cfg['dir']['admin']."/views/pagination.php"; ?>
						</div>
					</div>
				<? } ?>
			</div>
			<!-- end panel -->
		</div>
	</div>
	<!-- end row -->
</div>
