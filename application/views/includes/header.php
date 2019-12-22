<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $pageTitle; ?></title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<!-- Bootstrap 3.3.4 -->
	<link href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!-- FontAwesome 4.3.0 -->
	<link href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<!-- Ionicons 2.0.0 -->
	<link href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />
	<!-- Theme style -->
	<link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	<!-- AdminLTE Skins. Choose a skin from the css/skins
		folder instead of downloading all of them to reduce the load. -->
	<link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
	<style>
		.error {
			color: red;
			font-weight: normal;
		}
	</style>
	<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/ckeditor4/ckeditor/ckeditor.js"></script>
	<script type="text/javascript">
		var baseURL = "<?php echo base_url(); ?>";
	</script>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

		<header class="main-header">
			<!-- Logo -->
			<a href="<?php echo base_url(); ?>" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini">後台</span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg">後台管理</span>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top" role="navigation">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li class="dropdown tasks-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
								<i class="fa fa-history"></i>
							</a>
							<ul class="dropdown-menu">
								<li class="header"> 最後登入時間 : <i class="fa fa-clock-o"></i> <?= empty($last_login) ? "First Time Login" : $last_login; ?></li>
							</ul>
						</li>
						<!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="<?php echo base_url(); ?>assets/dist/img/npp-logo.png" class="user-image" alt="User Image" />
								<span class="hidden-xs"><?php echo $name; ?></span>
							</a>
							<ul class="dropdown-menu">
								<!-- User image -->
								<li class="user-header">

									<img src="<?php echo base_url(); ?>assets/dist/img/npp-logo.png" class="img-circle" alt="User Image" />
									<p>
										<span style="display:block;font-size:30px;margin-top:-15px;margin-bottom:5px"><?php echo $name; ?></span>
										<small><?php echo $role_text; ?></small>
									</p>

								</li>
								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-left">
										<a href="<?php echo base_url(); ?>profile" class="btn btn-warning btn-flat"><i class="fa fa-user-circle"></i> 個人檔案</a>
									</div>
									<div class="pull-right">
										<a href="<?php echo base_url(); ?>logout" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> 登出</a>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">主選單</li>
					<li>
						<a href="<?php echo base_url(); ?>dashboard">
							<i class="fa fa-dashboard"></i> <span>控制面板</span></i>
						</a>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-globe"></i> <span>新聞訊息</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li>
								<a href="<?php echo base_url(); ?>news/index">
									<i class="fa fa-circle-o"></i> 最新新聞
								</a>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>news/message"><i class="fa fa-circle-o"></i> 訊息公告</a>
							</li>
							<li><a href="<?php echo base_url(); ?>news/records"><i class="fa fa-circle-o"></i> 活動記錄</a></li>
							<li><a href="<?php echo base_url(); ?>news/tagLists"><i class="fa fa-circle-o"></i> 標籤管理</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-briefcase"></i> <span>法案議題</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li>
								<a href="#">
									<i class="fa fa-circle-o"></i> 重點法案
								</a>
							</li>
							<li>
								<a href="#"><i class="fa fa-circle-o"></i> 關注議題</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="<?php echo base_url(); ?>legislator">
							<i class="fa fa-user"></i> <span>本黨立委</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url(); ?>partymember">
							<i class="fa fa-users"></i> <span>黨員管理</span>
						</a>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-envelope"></i> <span>聯絡陳情</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
							<li class="treeview">
								<a href="#"><i class="fa fa-circle-o"></i> Level One
									<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
									<li class="treeview">
										<a href="#"><i class="fa fa-circle-o"></i> Level Two
											<span class="pull-right-container">
												<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
											<li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
										</ul>
									</li>
								</ul>
							</li>
							<li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
						</ul>
					</li>
					<li>
						<a href="<?php echo base_url(); ?>headerfooter">
							<i class="fa fa-header" aria-hidden="true"></i> <span>Header & Footer</span>
						</a>
					</li>
					<?php
					if ($role == ROLE_ADMIN) {
					?>
						<li>
							<a href="<?php echo base_url(); ?>userListing">
								<i class="fa fa-user-plus"></i>
								<span>人員管理(系統管理員)</span>
							</a>
						</li>
					<?php } ?>
					<?php
					if ($role == ROLE_MANAGER) {
					?>
						<li>
							<a href="<?php echo base_url(); ?>user/managerListing">
								<i class="fa fa-user-plus"></i>
								<span>人員管理(管理員)</span>
							</a>
						</li>
					<?php } ?>
				</ul>
			</section>
			<!-- /.sidebar -->
		</aside>