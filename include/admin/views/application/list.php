<?php
	include_once "../../../core/common.php";
	adminCheck();

	$tableName = $cfg['db']['prefix']."online_application";
	$where = "is_delete = 'N' AND select_country = ? ";
	$orderBy = " regdate DESC ";

	$pagingItemMax = 20;
	$pagingBlockMax = 5;

	$params = array(
		$_GET['country']
	);

	if($_GET['search'] != ""){
		$where .= " AND title like ? ";
		$params[] = "%".$_GET['search']."%";
	}

	$cntRs = Queryi("SELECT COUNT(*) as cnt FROM $tableName WHERE $where", $params);
	$dataCount = $cntRs[0]['cnt'];

	$pageTotal  = ceil($dataCount / $pagingItemMax);
	if ($_GET['page'] == ""){ $_GET['page'] = 1; }
	$fromLimit = ($_GET['page'] - 1) * $pagingItemMax;

	if($dataCount == 0){
		$rs = array();
	} else {
		$rs = Queryi("SELECT * FROM $tableName WHERE $where ORDER BY $orderBy LIMIT $fromLimit, $pagingItemMax", $params);	

		for($i = 0; $i < count($rs); $i++){
			$rs[$i]['files'] = explode("|", $rs[$i]['upload']);
			for($k = 0; $k < count($rs[$i]['files']); $k++){
				$tmp = explode("^^", $rs[$i]['files'][$k]);

				$rs[$i]['files'][$k] = array();
				$rs[$i]['files'][$k]['seq'] = $k + 1;
				$rs[$i]['files'][$k]['save_name'] = $tmp[0];
				$rs[$i]['files'][$k]['real_name'] = $tmp[1];
			}
		}
	}

	$qstr = getQstrCustom(array("country"), $_GET)."&page=";
	include_once $cfg['root'].$cfg['dir']['admin']."/views/common_header.php";
	include_once $cfg['root'].$cfg['dir']['admin']."/views/common_navi.php";
?>
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
		<li>온라인 법인신청</li>
		<li class="active"><?=$cfg['application']['country']['kr'][$_GET['country']]?></li>
	</ol>
	<h1 class="page-header"><?=$cfg['application']['country']['kr'][$_GET['country']]?></h1>
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
					<table class="table">
						<thead>
							<tr>
								<th width="10%">No.</th>
								<th width="50%">법인명</th>
								<th width="20%">신청날짜</th>
								<th width="20%">&nbsp;</th>
							</tr>
						</thead>
						<tbody class="ui-sortable-category">
							<?php
								$rowNo = $dataCount - $pagingItemMax * ($_GET['page'] - 1);
								foreach ($rs as $row){
									if(str_replace("|", "", $row['ceo_passport_upload']) != "" || str_replace("|", "", $row['ceo_residentcard_upload']) != "" || str_replace("|", "", $row['shareholder_passport_upload']) != "" || str_replace("|", "", $row['shareholder_residentcard_upload']) != "" || str_replace("|", "", $row['shareholder_businesslicense_upload']) != "" || str_replace("|", "", $row['shareholder_list_upload']) != "" || str_replace("|", "", $row['shareholder_representative_passport_upload']) != ""){ 
										$row['isSetFile'] = '<i class="fa fa-file"></i>';
									} else {
										$row['isSetFile'] = "";
									}
							?>
								<tr class="<?=(($row['is_main'] == 'Y') ? 'info' : '')?> <?=(($row['is_hide'] == 'Y') ? 'danger' : '')?>">
									<td><input type="hidden" name="seq[]" value="<?=$row['no']?>" /><span><?=$rowNo?></span></td>
									<td><?=$row['company_name']?> <?=$row['isSetFile']?></td>
									<td><?=$row['regdate']?></td>
									<td>
										<a href="edit.php?mode=update&no=<?=$row['no']?><?=$qstr?><?=$_GET['page']?>" class="btn btn-xs btn-info m-r-5">보기</a>
										<form action="process.php" method="post" style="display: inline;" class="delete-confirm">
											<input type="hidden" name="qstr" value="<?=$qstr?><?=$_GET['page']?>" />
											<input type="hidden" id="mode" name="mode" value="delete" />
											<input type="hidden" name="no" value="<?=$row['no']?>">
											<button type="submit" class="btn btn-xs btn-warning m-r-5">삭제</button>
										</form>
									</td>
								</tr>
								<? $rowNo--;?>
							<? } ?>
							<? if(count($rs) < 1){ echo "<tr><td colspan='4' class='text-center'>No Data</td></tr>"; } ?>
						</tbody>
					</table>
				</div>
				<!--
				<div class="panel-footer">
					<div class="row">
						<div class="col-md-12 text-right">
							<a class="btn btn-primary" href='edit.php?mode=create'>등록</a>
						</div>
					</div>
				</div>
				-->
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
<?
	include_once $cfg['root'].$cfg['dir']['admin']."/views/common_footer.php";	
?>