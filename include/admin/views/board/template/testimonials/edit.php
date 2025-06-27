<script>
	$(function(){
		$("#form").bind("submit", function(){
			if($(this).find("[name='subject']").val() == ""){
				alert("제목을 입력해주세요.");
				$(this).find("[name='subject']").focus();
				return false;
			}
		});
	});
</script>
<link rel="stylesheet" href="<?=$cfg['baseUrl']?>/admin/assets/plugins/jodit/build/jodit.min.css">
<script src="<?=$cfg['baseUrl']?>/admin/assets/plugins/jodit/build/jodit.min.js"></script>
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
					<div class="panel-heading-btn"></div>
					<h4 class="panel-title"><? echo ($_GET['mode'] == 'update') ? '수정' : '등록'; ?></h4>
				</div>
				<form class="form-horizontal" action="board_process.php" method="POST" enctype="multipart/form-data" id="form">
					<div class="panel-body">
						<input type="hidden" name="board" value="<?=$_GET['board']?>" />
						<input type="hidden" name="qstr" value="<?=$qstr?>" />
						<input type="hidden" name="userid" value="<?=$rs[0]['id']?>" />
						<input type="hidden" name="name" value="<?=$rs[0]['name']?>" />
						<input type="hidden" id="mode" name="mode" value="<?=$_GET['mode']?>" />
						<input type="hidden" name="no" value="<?=$rs[0]['no']?>">
						<? if($_GET['mode'] == "update"){ ?>
						<input type="hidden" name="tmp10" value="<?=$rs[0]['tmp10']?>">
						<? } ?>
						<? if($_GET['mode'] == "update"){ ?>
						<div class="form-group">
							<label class="col-md-3 control-label">등록 날짜</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="regDate" placeholder="제목" value="<?=$rs[0]['regDate']?>" />
							</div>
						</div>
						<? } ?>
						<div class="form-group">
							<label class="col-md-3 control-label">비공개</label>
							<div class="col-md-9">
								<div class="checkbox"><label><input type="checkbox" name="isSecret" value="Y" <?=(($rs[0]['isSecret'] == 'Y') ? 'checked' : '')?>>설정</label></div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">TOPIC</label>
							<div class="col-md-9">
								<? foreach($cfg['board']['category'][$_GET['board']] as $key => $value){ ?>
									<label class="checkbox-inline"><input type="checkbox" name="category[]" value="<?=$key?>" <?=((strpos($rs[0]['category'], $key) !== false) ? 'checked' : '')?>><?=$value?></label>
								<? } ?>
							</div>
						</div>							
                                                <div class="form-group">
                                                        <label class="col-md-3 control-label">제목</label>
                                                        <div class="col-md-9">
                                                                <input type="text" class="form-control" name="subject" placeholder="제목" value="<?=$rs[0]['subject']?>" />
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                        <label class="col-md-3 control-label">Name</label>
                                                        <div class="col-md-9">
                                                                <input type="text" class="form-control" name="tmp1" placeholder="Name" value="<?=$rs[0]['tmp1']?>" />
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                        <label class="col-md-3 control-label">Position</label>
                                                        <div class="col-md-9">
                                                                <input type="text" class="form-control" name="tmp2" placeholder="Position" value="<?=$rs[0]['tmp2']?>" />
                                                        </div>
                                                </div>
						<? for($i = 0; $i < 1; $i++){ ?>
							<div class="form-group isMultiFileGroup">
								<label class="col-md-3 control-label">
									<span class="multifile-label">메인 섬네일 (589 * 420)</span>
								</label>
								<div class="col-md-9">
									<div class="fileupload <?=(($rs[0]['uploads'][$i]['realName'] != "") ? 'fileupload-exists' : 'fileupload-new')?>" data-provides="fileupload">
										<input type="hidden" name="fileseq[]" value="<?=$rs[0]['uploads'][$i]['no']?>">
										<div class="input-append">
											<div class="uneditable-input">
												<i class="fa fa-file fileupload-exists"></i>
												<span class="fileupload-preview"><?=(($rs[0]['uploads'][$i]['realName'] != "") ? $rs[0]['uploads'][$i]['realName'] : '')?></span>
											</div>
											<span class="btn btn-default btn-file">
												<span class="fileupload-exists">변경</span>
												<span class="fileupload-new">파일추가</span>
												<input type="file" name="uploadfile<?=($i + 1)?>">
											</span>
											<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">삭제</a>
											<? if($rs[0]['uploads'][$i]['realName'] != ""){ ?>
												<span class="clone-remove-item">&nbsp;(<a href="board_download.php?t=<?=$_GET['board']?>&n=<?=$rs[0]['uploads'][$i]['no']?>&thumb=false"><?=$rs[0]['uploads'][$i]['realName']?></a>)</span>
											<? } ?>
										</div>
									</div>
								</div>
							</div>
						<? } ?>
						<? for($i = 1; $i < 2; $i++){ ?>
							<div class="form-group isMultiFileGroup">
								<label class="col-md-3 control-label">
									<span class="multifile-label">목록 섬네일 (542 * 305)</span>
								</label>
								<div class="col-md-9">
									<div class="fileupload <?=(($rs[0]['uploads'][$i]['realName'] != "") ? 'fileupload-exists' : 'fileupload-new')?>" data-provides="fileupload">
										<input type="hidden" name="fileseq[]" value="<?=$rs[0]['uploads'][$i]['no']?>">
										<div class="input-append">
											<div class="uneditable-input">
												<i class="fa fa-file fileupload-exists"></i>
												<span class="fileupload-preview"><?=(($rs[0]['uploads'][$i]['realName'] != "") ? $rs[0]['uploads'][$i]['realName'] : '')?></span>
											</div>
											<span class="btn btn-default btn-file">
												<span class="fileupload-exists">변경</span>
												<span class="fileupload-new">파일추가</span>
												<input type="file" name="uploadfile<?=($i + 1)?>">
											</span>
											<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">삭제</a>
											<? if($rs[0]['uploads'][$i]['realName'] != ""){ ?>
												<span class="clone-remove-item">&nbsp;(<a href="board_download.php?t=<?=$_GET['board']?>&n=<?=$rs[0]['uploads'][$i]['no']?>&thumb=false"><?=$rs[0]['uploads'][$i]['realName']?></a>)</span>
											<? } ?>
										</div>
									</div>
								</div>
							</div>
						<? } ?>
						<hr />
						<? for($i = 2; $i < 3; $i++){ ?>
							<div class="form-group isMultiFileGroup">
								<label class="col-md-3 control-label">
									<span class="multifile-label">동영상 파일 (최대 20M)</span>
								</label>
								<div class="col-md-9">
									<div class="fileupload <?=(($rs[0]['uploads'][$i]['realName'] != "") ? 'fileupload-exists' : 'fileupload-new')?>" data-provides="fileupload">
										<input type="hidden" name="fileseq[]" value="<?=$rs[0]['uploads'][$i]['no']?>">
										<div class="input-append">
											<div class="uneditable-input">
												<i class="fa fa-file fileupload-exists"></i>
												<span class="fileupload-preview"><?=(($rs[0]['uploads'][$i]['realName'] != "") ? $rs[0]['uploads'][$i]['realName'] : '')?></span>
											</div>
											<span class="btn btn-default btn-file">
												<span class="fileupload-exists">변경</span>
												<span class="fileupload-new">파일추가</span>
												<input type="file" name="uploadfile<?=($i + 1)?>">
											</span>
											<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">삭제</a>
											<? if($rs[0]['uploads'][$i]['realName'] != ""){ ?>
												<span class="clone-remove-item">&nbsp;(<a href="board_download.php?t=<?=$_GET['board']?>&n=<?=$rs[0]['uploads'][$i]['no']?>&thumb=false"><?=$rs[0]['uploads'][$i]['realName']?></a>)</span>
											<? } ?>
										</div>
									</div>
								</div>
							</div>
						<? } ?>
						<div class="form-group m-b-0">
							<label class="col-md-3 control-label">내용</label>
							<div class="col-md-9">
								<textarea id="editor" name="content" rows="20"><?=$rs[0]['content']?></textarea>
							</div>
						</div>
						<hr />
						<? for($i = 3; $i < 4; $i++){ ?>
							<div class="form-group isMultiFileGroup">
								<label class="col-md-3 control-label">
									<span class="multifile-label">첨부파일</span>
								</label>
								<div class="col-md-9">
									<div class="fileupload <?=(($rs[0]['uploads'][$i]['realName'] != "") ? 'fileupload-exists' : 'fileupload-new')?>" data-provides="fileupload">
										<input type="hidden" name="fileseq[]" value="<?=$rs[0]['uploads'][$i]['no']?>">
										<div class="input-append">
											<div class="uneditable-input">
												<i class="fa fa-file fileupload-exists"></i>
												<span class="fileupload-preview"><?=(($rs[0]['uploads'][$i]['realName'] != "") ? $rs[0]['uploads'][$i]['realName'] : '')?></span>
											</div>
											<span class="btn btn-default btn-file">
												<span class="fileupload-exists">변경</span>
												<span class="fileupload-new">파일추가</span>
												<input type="file" name="uploadfile<?=($i + 1)?>">
											</span>
											<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">삭제</a>
											<? if($rs[0]['uploads'][$i]['realName'] != ""){ ?>
												<span class="clone-remove-item">&nbsp;(<a href="board_download.php?t=<?=$_GET['board']?>&n=<?=$rs[0]['uploads'][$i]['no']?>&thumb=false"><?=$rs[0]['uploads'][$i]['realName']?></a>)</span>
											<? } ?>
										</div>
									</div>
								</div>
							</div>
						<? } ?>
						<? if($_GET['mode'] == "create"){ ?>
						<hr />
						<div class="form-group">
							<label class="col-md-3 control-label">구독 메일 발송</label>
							<div class="col-md-9">
								<div class="checkbox"><label><input type="checkbox" name="tmp10" value="Y" checked>구독<b>(<?=$subscribe['cnt']?>명)</b> 메일을 발송합니다.</label></div>
							</div>
						</div>
						<? } ?>
					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-md-12 text-right">
								<a href="board_list.php?<?=$qstr?>" class="btn btn-primary">목록</a>	
								<button class="btn btn-primary"><? echo ($_GET['mode'] == 'update') ? '수정' : '등록'; ?></button>
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
<script>
	var editor = new Jodit("#editor", {
		"uploader": {
			"insertImageAsBase64URI": true
		}
	});
</script>
