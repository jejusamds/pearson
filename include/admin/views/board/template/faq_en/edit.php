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
						<div class="form-group">
							<label class="col-md-3 control-label">카테고리</label>
							<div class="col-md-9">
								<select class="form-control" name="category">
									<? foreach($cfg['board']['category'][$_GET['board']] as $key => $value){ ?>
										<option value="<?=$key?>"<?=(($rs[0]['category'] == $key) ? ' selected' : '')?>><?=$value?></option>
									<? } ?>
								</select>
							</div>
						</div>							
						<div class="form-group">
							<label class="col-md-3 control-label">제목</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="subject" placeholder="제목" value="<?=$rs[0]['subject']?>" />
							</div>
						</div>
						<div class="form-group m-b-0">
							<label class="col-md-3 control-label">내용</label>
							<div class="col-md-9">
								<textarea id="editor" name="content" rows="20"><?=$rs[0]['content']?></textarea>
							</div>
						</div>
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