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
						<input type="hidden" id="mode" name="mode" value="<?=$_GET['mode']?>" />
						<input type="hidden" name="no" value="<?=$rs[0]['no']?>">
						<div class="form-group">
							<label class="col-md-3 control-label">Name</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="name" placeholder="Name" value="<?=$rs[0]['name']?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Phone</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="tmp1" placeholder="Phone" value="<?=decodeData($rs[0]['tmp1'])?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">E-mail</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="email" placeholder="E-mail" value="<?=decodeData($rs[0]['email'])?>" />
							</div>
						</div>
						<hr />
						<div class="form-group">
							<label class="col-md-3 control-label">TYPE</label>
							<div class="col-md-9">
								<select class="form-control" name="category">
									<? foreach($cfg['board']['category'][$_GET['board']] as $key => $value){ ?>
										<option value="<?=$key?>"<?=(($rs[0]['category'] == $key) ? ' selected' : '')?>><?=$value?></option>
									<? } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Title</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="subject" placeholder="Title" value="<?=$rs[0]['subject']?>" />
							</div>
						</div>
						<div class="form-group m-b-0">
							<label class="col-md-3 control-label">Content</label>
							<div class="col-md-9">
								<textarea class="form-control" name="content" rows="15"><?=$rs[0]['content']?></textarea>
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