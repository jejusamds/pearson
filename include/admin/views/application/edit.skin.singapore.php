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
					<h4 class="panel-title"><? echo ($_GET['mode'] == 'update') ? '보기' : '등록'; ?></h4>
				</div>
				<div class="alert alert-danger">
					페이지 하단의 <span class="btn btn-xs btn-danger">신청서 다운로드 (.zip)</span> 버튼을 클릭하여 현재 신청서 내용을 다운로드할 수 있습니다.<br />(구성: 신청서 내용 PDF 파일 + 첨부파일)
				</div>
				<form class="form-horizontal" action="process.php" method="POST" enctype="multipart/form-data" id="form">
					<div class="panel-body" id="saveInnerHTML">
						<input type="hidden" name="kind" value="kind" />
						<input type="hidden" name="qstr" value="<?=$qstr?>" />
						<input type="hidden" id="mode" name="mode" value="<?=$_GET['mode']?>" />
						<input type="hidden" name="no" value="<?=$rs['no']?>">

						<? if(isset($cfg['application']['skin'][$lang][$country]['corporate_form'])){ ?>
						<div class="form-group">
							<label class="control-label col-sm-3">법인 형태<br />(Type of entity)</label>
							<div class="col-sm-9">
								<? foreach($cfg['application']['skin'][$lang][$country]['corporate_form'] as $key => $arr){ ?>
								<? if($arr['value'] == $rs['corporate_form']){ ?>
									<p class="form-control-static"><?=$arr['text']?></p>
								<? } ?>
								<? } ?>
							</div>
						</div>
						<? } ?>

						<div class="form-group">
							<label class="control-label col-sm-3">법인명<br />(company name)</label>
							<div class="col-sm-9">
								<p class="form-control-static"><?=$rs['company_name']?></p>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3">영업활동<br />(business activity)</label>
							<div class="col-sm-9">
								<p class="form-control-static"><?=nl2br($rs['activities'])?></p>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3">법인 주소지<br />(business address)</label>
							<div class="col-sm-9">
								<p class="form-control-static"><?=(($rs['acting_address'] == "self") ? '직접입력' : '피어슨 주소지 대행<br />(Provided by pearson)')?></p>
								<? if($rs['acting_address_text'] != ""){ ?>
								<p class="form-control-static"><?=$rs['acting_address_text']?></p>
								<? } ?>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3">자본금<br />(paid in capital)</label>
							<div class="col-sm-9">
								<p class="form-control-static"><?=$rs['capital_amount']?></p>
							</div>
						</div>

						<legend>주요 연락망<br />(main contactor)</legend>
						<div class="form-group">
							<label class="control-label col-sm-3">이름<br />(main contactor)</label>
							<div class="col-sm-9">
								<p class="form-control-static"><?=$rs['major_phone'][0]?></p>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">전화번호<br />(main contactor phone number)</label>
							<div class="col-sm-9">
								<p class="form-control-static"><?=$rs['major_phone'][1]?></p>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">이메일<br />(main contactor email)</label>
							<div class="col-sm-9">
								<p class="form-control-static"><?=$rs['major_phone'][2]?></p>
							</div>
						</div>

						<? if($cfg['application']['skin'][$lang][$country]['acting_local_agent']){ ?>
						<hr />

						<div class="form-group acting-local-tooltip">
							<label class="control-label col-sm-3">현지대리이사가 필요하신가요?<br />(do you need a nominee director?)</label>
							<div class="col-sm-9">
								<p class="form-control-static"><?=(($rs['acting_local_agent'] == 'Y') ? '예, 피어슨파트너스 대리이사 서비스를 이용합니다.<br />(Yes, need a nominee director)' : '아니오<br />(No)')?></p>
							</div>
						</div>
						<? } ?>

						<? for($i = 0; $i < count($rs['ceo_name']); $i++){ ?>
						<legend>이사 <?=($i + 1)?><br />(director<?=($i + 1)?> - name(eng))</legend>
						<div class="form-group">
							<label class="control-label col-sm-3">이름 (영문)<br />(name)</label>
							<div class="col-sm-9">
								<p class="form-control-static"><?=$rs['ceo_name'][$i]?></p>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">전화번호<br />(phone number)</label>
							<div class="col-sm-9">
								<p class="form-control-static"><?=$rs['ceo_phone'][$i]?></p>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">이메일<br />(email)</label>
							<div class="col-sm-9">
								<p class="form-control-static"><?=$rs['ceo_email'][$i]?></p>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">여권사본<br />(copy of passport)</label>
							<div class="col-sm-9">
								<p class="form-control-static"><? if($rs['ceo_passport_files'][$i]['save_name'] != ""){ ?><a href="<?=$fileDirectory?>/<?=$rs['ceo_passport_files'][$i]['save_name']?>" target="_blank"><i class="fa fa-download"></i> <?=$rs['ceo_passport_files'][$i]['real_name']?></a><? } ?></p>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">영문주민등록등본<br />(household register)</label>
							<div class="col-sm-9">
								<p class="form-control-static"><? if($rs['ceo_residentcard_files'][$i]['save_name'] != ""){ ?><a href="<?=$fileDirectory?>/<?=$rs['ceo_residentcard_files'][$i]['save_name']?>" target="_blank"><i class="fa fa-download"></i> <?=$rs['ceo_residentcard_files'][$i]['real_name']?></a><? } ?></p>
							</div>
						</div>
						<? } ?>

						<? for($i = 0; $i < count($rs['shareholder_name']); $i++){ ?>
						<legend>주주 <?=($i + 1)?><br />(shareholder <?=($i + 1)?> type)</legend>
						<div class="form-group">
							<label class="control-label col-sm-3">개인/법인<br />(individual/entity)</label>
							<div class="col-sm-9">
								<p class="form-control-static"><?=(($rs['shareholder_pb'][$i] == "privacy") ? '개인<br />(individual)' : '법인<br />(entity)')?></p>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">이름 (영문)<br />(name)</label>
							<div class="col-sm-9">
								<p class="form-control-static"><?=$rs['shareholder_name'][$i]?></p>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">전화번호<br />(phone number)</label>
							<div class="col-sm-9">
								<p class="form-control-static"><?=$rs['shareholder_phone'][$i]?></p>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">이메일<br />(email)</label>
							<div class="col-sm-9">
								<p class="form-control-static"><?=$rs['shareholder_email'][$i]?></p>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">지분<br />(percentage of shares)</label>
							<div class="col-sm-9">
								<p class="form-control-static"><?=$rs['shareholder_equity'][$i]?></p>
							</div>
						</div>

						<? if($rs['shareholder_pb'][$i] == "privacy"){ ?>
						<div class="form-group">
							<label class="control-label col-sm-3">여권사본<br />(copy of passport)</label>
							<div class="col-sm-9">
								<p class="form-control-static"><? if($rs['shareholder_passport_files'][$i]['save_name'] != ""){ ?><a href="<?=$fileDirectory?>/<?=$rs['shareholder_passport_files'][$i]['save_name']?>" target="_blank"><i class="fa fa-download"></i> <?=$rs['shareholder_passport_files'][$i]['real_name']?></a><? } ?></p>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">영문주민등록등본<br />(household register)</label>
							<div class="col-sm-9">
								<p class="form-control-static"><? if($rs['shareholder_residentcard_files'][$i]['save_name'] != ""){ ?><a href="<?=$fileDirectory?>/<?=$rs['shareholder_residentcard_files'][$i]['save_name']?>" target="_blank"><i class="fa fa-download"></i> <?=$rs['shareholder_residentcard_files'][$i]['real_name']?></a><? } ?></p>
							</div>
						</div>
						<? } else { ?>
						<div class="form-group">
							<label class="control-label col-sm-3">영문사업자등록증<br />(Provided by pearson)</label>
							<div class="col-sm-9">
								<p class="form-control-static"><? if($rs['shareholder_businesslicense_files'][$i]['save_name'] != ""){ ?><a href="<?=$fileDirectory?>/<?=$rs['shareholder_businesslicense_files'][$i]['save_name']?>" target="_blank"><i class="fa fa-download"></i> <?=$rs['shareholder_businesslicense_files'][$i]['real_name']?></a><? } ?></p>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">영문주주명부<br />(Registrar of shareholders)</label>
							<div class="col-sm-9">
								<p class="form-control-static"><? if($rs['shareholder_list_files'][$i]['save_name'] != ""){ ?><a href="<?=$fileDirectory?>/<?=$rs['shareholder_list_files'][$i]['save_name']?>" target="_blank"><i class="fa fa-download"></i> <?=$rs['shareholder_list_files'][$i]['real_name']?></a><? } ?></p>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">법인대표자 여권사본<br />(Passport copy of representative)</label>
							<div class="col-sm-9">
								<p class="form-control-static"><? if($rs['shareholder_representative_passport_files'][$i]['save_name'] != ""){ ?><a href="<?=$fileDirectory?>/<?=$rs['shareholder_representative_passport_files'][$i]['save_name']?>" target="_blank"><i class="fa fa-download"></i> <?=$rs['shareholder_representative_passport_files'][$i]['real_name']?></a><? } ?></p>
							</div>
						</div>
						<? } ?>
						<? } ?>

					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-md-12 text-right">
								<a href="edit.download.zip.php?no=<?=$_GET['no']?>&country=<?=$_GET['country']?>" class="btn btn-danger">신청서 다운로드 (.zip)</a>
								<a href="list.php?<?=$qstr?>" class="btn btn-primary">목록</a>	
								<!--<button class="btn btn-primary"><? echo ($_GET['mode'] == 'update') ? '저장' : '등록'; ?></button>-->
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- end panel -->
		</div>
	</div>
	<!-- end row -->
</div>