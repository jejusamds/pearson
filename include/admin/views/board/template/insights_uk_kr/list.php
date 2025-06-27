<script>
	$(function(){
		$("input[name='search']").focus();
		$("input[name='search']").val($("input[name='search']").val());

		$(".delete-confirm").bind("submit", function(){
			if(!confirm("정말 삭제하시겠습니까?")){
				return false;
			} else {
				var inputPasswd = prompt('[비밀번호 확인]\n비밀번호를 입력해주세요.', '');

				if(!inputPasswd){
					if(inputPasswd == ""){
						alert("비밀번호를 정확히 입력해주세요.");
					}
					return false;
				}

				$(this).find("[name='features_password']").val(inputPasswd);

				return true;
			}
		});
	});
</script>
<!-- begin #content -->
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
		<li><a href="<?=$cfg['dir']['admin']?>/views/dashboard.php">Home</a></li>
		<li>게시판 관리</li>
		<li class="active"><?=$cfg['board']['type_uk_kr'][$_GET['board']]?></li>
	</ol>
	<h1 class="page-header"><?=$cfg['board']['type_uk_kr'][$_GET['board']]?></h1>
	<!-- end page-header -->
	<!-- begin row -->
	<div class="row">
		<div class="col-md-12">
			<!-- begin panel -->
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn"></div>
					<h4 class="panel-title">Showing <?=$fromLimit?> to <?=$pagingItemMax?> of <?=$dataCount?> entries</h4>
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
								<th width="15%">카테고리</th>
								<th width="25%">제목</th>
								<th width="10%">Hit</th>
								<th width="20%">등록날짜</th>
								<th width="20%">&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$rowNo = $dataCount - $pagingItemMax * ($_GET['page'] - 1);
								foreach ($rs as $row){

								$tmp = explode(",", $row['category']);

								$row['category'] = "";
								$hr = "";
								for($i = 0; $i < count($tmp); $i++){
									$row['category'] .= $hr.$cfg['board']['category'][$_GET['board']][$tmp[$i]];
									$hr = " / ";
								}
							?>
								<tr>
									<td><?=$rowNo?></td>
									<td><span class="ellipsis"><?=$row['category']?></span></td>
									<td><a class="ellipsis" href="<?=$cfg['href_uk_kr']?>/insights/<?=urlencode($row['permalink'])?>/" target="_blank"><?=$row['subject']?> <i class="fa fa-external-link"></i></a></td>
									<td><?=$row['hit']?></td>
									<td><?=$row['regDate']?></td>
									<td>
										<a href="board_edit.php?mode=update&no=<?=$row['no']?><?=$qstr?><?=$_GET['page']?>" class="btn btn-xs btn-info m-r-5">수정</a>
										<? if($_SESSION['userLevel'] > 100){ ?>
										<form action="board_process.php" method="post" style="display: inline;" class="delete-confirm">
											<input type="hidden" name="board" value="<?=$_GET['board']?>" />
											<input type="hidden" name="qstr" value="<?=$qstr?><?=$_GET['page']?>" />
											<input type="hidden" id="mode" name="mode" value="delete" />
											<input type="hidden" name="no" value="<?=$row['no']?>">
											<input type="hidden" name="features_password" value="">
											<button type="submit" class="btn btn-xs btn-warning m-r-5">삭제</button>
										</form>
										<? } ?>
									</td>
								</tr>
								<? $rowNo--;?>
							<? } ?>
							<? if(count($rs) < 1){ echo "<tr><td colspan='6' class='text-center'>No Data</td></tr>"; } ?>
						</tbody>
					</table>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-md-12 text-right">
							<a class="btn btn-primary" href='board_edit.php?board=<?=$_GET['board']?>&mode=create'>등록</a>
						</div>
					</div>
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
