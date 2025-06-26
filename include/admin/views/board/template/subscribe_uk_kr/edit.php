<script>
	$(function(){
		$("#form").bind("submit", function(){
			if($(this).find("[name='email']").val() == ""){
				alert("이메일을 입력해주세요.");
				$(this).find("[name='email']").focus();
				return false;
			}

			$.post("board_ajax.php", {
				"board" : "<?=$_GET['board']?>",
				"unique_check_column" : "email",
				"value" : $(this).find("[name='email']").val(),
			}, function(res){
				if(res){
					res = JSON.parse(res);
					if(!res.is_already){
						$("#form").unbind("submit").submit();
					} else {
						alert("이미 등록된 이메일 주소입니다.");
						$(this).find("[name='email']").select();
						return false;
					}
				}
			});

			return false;
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
							<label class="col-md-3 control-label">이메일 주소</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="email" placeholder="이메일 주소" value="<?=decodeData($rs[0]['email'])?>" />
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