<!-- begin #header -->
<div id="header" class="header navbar navbar-default navbar-fixed-top">
	<!-- begin container-fluid -->
	<div class="container-fluid">
		<!-- begin mobile sidebar expand / collapse button -->
		<div class="navbar-header">
			<a href="<?=$locator['info'][0]['link']?>" class="navbar-brand"><?=$cfg['siteName']?></a>
			<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<!-- end mobile sidebar expand / collapse button -->
		
		<!-- begin header navigation right -->
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown navbar-user">
				<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
					<span><?=$_SESSION['userName']?><?=(($_SESSION['userName'] != "") ? " (".$_SESSION['userid'].")" : '')?></span> <b class="caret"></b>
				</a>
				<ul class="dropdown-menu animated fadeInLeft">
					<li class="arrow"></li>
					<li><a href="<?=$cfg['dir']['admin']?>/views/logout.php">Log Out</a></li>
				</ul>
			</li>
		</ul>
		<!-- end header navigation right -->
	</div>
	<!-- end container-fluid -->
</div>
<!-- end #header -->

<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
	<!-- begin sidebar scrollbar -->
	<div data-scrollbar="true" data-height="100%">
		<!-- begin sidebar user -->
		<ul class="nav">
			<li class="nav-profile">
				<div class="info">
					<?=$_SESSION['userName']?>
					<?=(($_SESSION['userName'] != "") ? "<small>".$_SESSION['userid']."</small>" : '')?>
				</div>
			</li>
		</ul>
		<!-- end sidebar user -->
		<!-- begin sidebar nav -->
		<ul class="nav">
			<li class="nav-header">Navigation</li>

			<li class="has-sub">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="fa fa-cogs"></i>
					<span>게시판 관리 (영문)</span>
				</a>
				<ul class="sub-menu" style="display: block">
					<li class="has-sub <?=((in_array($_GET['board'], array_keys($cfg['board']['type_kr_en']))) ? 'active' : '')?>">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<span>코리아 (/kr/)</span>
						</a>
						<ul class="sub-menu" <?=((in_array($_GET['board'], array_keys($cfg['board']['type_kr_en']))) ? 'style="display: block;"' : '')?>>
							<? foreach($cfg['board']['type_kr_en'] as $key => $value){ ?>					
								<li <?=(($_GET['board'] == $key) ? 'class="active"' : '')?>>
									<a href="<?=$cfg['dir']['admin']?>/views/board/board_list.php?board=<?=$key?>"><?=$value?></a>
								</li>
							<? } ?>
						</ul>
					</li>
					<li class="has-sub <?=((in_array($_GET['board'], array_keys($cfg['board']['type_sg_en']))) ? 'active' : '')?>">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<span>싱가포르 (/sg/)</span>
						</a>
						<ul class="sub-menu" <?=((in_array($_GET['board'], array_keys($cfg['board']['type_sg_en']))) ? 'style="display: block;"' : '')?>>
							<? foreach($cfg['board']['type_sg_en'] as $key => $value){ ?>					
								<li <?=(($_GET['board'] == $key) ? 'class="active"' : '')?>>
									<a href="<?=$cfg['dir']['admin']?>/views/board/board_list.php?board=<?=$key?>"><?=$value?></a>
								</li>
							<? } ?>
						</ul>
					</li>
				</ul>
			</li>
			
			<li class="has-sub">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="fa fa-cogs"></i>
					<span>게시판 관리 (국문)</span>
				</a>
				<ul class="sub-menu" style="display: block;">
					<li class="has-sub <?=((in_array($_GET['board'], array_keys($cfg['board']['type_sg_kr']))) ? 'active' : '')?>">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<span>싱가포르 (/sg/)</span>
						</a>
						<ul class="sub-menu" <?=((in_array($_GET['board'], array_keys($cfg['board']['type_sg_kr']))) ? 'style="display: block;"' : '')?>>
							<? foreach($cfg['board']['type_sg_kr'] as $key => $value){ ?>					
								<li <?=(($_GET['board'] == $key) ? 'class="active"' : '')?>>
									<a href="<?=$cfg['dir']['admin']?>/views/board/board_list.php?board=<?=$key?>"><?=$value?></a>
								</li>
							<? } ?>
						</ul>
					</li>
					<li class="has-sub <?=((in_array($_GET['board'], array_keys($cfg['board']['type_uk_kr']))) ? 'active' : '')?>">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<span>영국 (/uk/)</span>
						</a>
						<ul class="sub-menu" <?=((in_array($_GET['board'], array_keys($cfg['board']['type_uk_kr']))) ? 'style="display: block;"' : '')?>>
							<? foreach($cfg['board']['type_uk_kr'] as $key => $value){ ?>					
								<li <?=(($_GET['board'] == $key) ? 'class="active"' : '')?>>
									<a href="<?=$cfg['dir']['admin']?>/views/board/board_list.php?board=<?=$key?>"><?=$value?></a>
								</li>
							<? } ?>
						</ul>
					</li>
				</ul>
			</li>

			<li class="has-sub">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="fa fa-cogs"></i>
					<span>온라인 법인신청</span>
				</a>
				<ul class="sub-menu" style="display: block;">
					<? foreach($cfg['application']['country']['kr'] as $key => $value){ ?>
					<li <?=(($_GET['country'] == $key) ? 'class="active"' : '')?>>
						<a href="<?=$cfg['dir']['admin']?>/views/application/list.php?country=<?=$key?>"><?=$value?></a>
					</li>
					<? } ?>
				</ul>
			</li>
		<!-- begin sidebar minify button -->
			<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
		<!-- end sidebar minify button -->
		</ul>
		<!-- end sidebar nav -->
	</div>
	<!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->