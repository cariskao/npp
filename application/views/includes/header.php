<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $pageTitle; ?></title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<!-- Bootstrap 3.3.4 -->
	<link href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"
		type="text/css" />
	<!-- FontAwesome 4.3.0 -->
	<link href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet"
		type="text/css" />
	<!-- Ionicons 2.0.0 -->
	<link href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css" rel="stylesheet"
		type="text/css" />
	<!-- Juqery Css -->
	<link href="<?php echo base_url(); ?>assets/bower_components/jquery-ui/themes/base/jquery-ui.min.css"
		rel="stylesheet" type="text/css" />
	<!-- Theme style -->
	<link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
	<!-- AdminLTE Skins. Choose a skin from the css/skins
		folder instead of downloading all of them to reduce the load. -->
	<link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
	<style>
		/* 讓左邊導航固定 */
		.main-header,
		.main-sidebar {
			position: fixed;
		}

		/* 左方導航子選單ul樣式 */
		.skin-blue .sidebar-menu>li>.treeview-menu {
			background: #222d32;
		}

		/* 左方導航子選單項目li樣式 */
		.skin-blue .sidebar-menu .treeview-menu>li.active>a,
		.skin-blue .sidebar-menu .treeview-menu>li>a:hover {
			color: #fff;
		}

		.skin-blue .sidebar-menu .treeview-menu>li.active,
		.skin-blue .sidebar-menu .treeview-menu>li:hover {
			background-color: #2f4f4f;
		}

		.skin-blue .sidebar-menu .treeview-menu>li {
			transition: padding-left, .5s;
		}

		/* 若有子項目則標題的遊標變成這樣 */
		.treeview>a {
			cursor: text;
		}

		.main-sidebar {
			font-size: 18px;
			font-weight: bolder;
		}

		.main-sidebar .treeview-menu a {
			font-weight: normal;
			font-size: 16px;
		}

		.main-sidebar .treeview-menu {
			/* 讓左邊導航的下拉選單固定打開 */
			/* adminlte.js的lte.tree取消點擊事件 */
			display: block;
		}

		.submit-pos {
			position: fixed;
			right: 0px;
			top: 51.45px;
			z-index: 2;
			margin: 10px
		}

		/* 上方導航 */
		.hover-bg:hover {
			color: white !important;
			background-color: #3C8DBC !important;
			cursor: default;
		}

		.form-group {
			margin-bottom: 0;
		}

		.treeview-menu li {
			padding-left: 30px;
		}

		.error {
			color: red;
			font-weight: normal;
		}

		.functoin-on-top {
			position: fixed;
			z-index: 2;
			top: 0;
		}
	</style>
	<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.js"></script>
	<script src="<?php echo base_url(); ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
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
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<header class="main-header">
			<!-- Logo -->
			<a href="<?php echo base_url(); ?>" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini"><img style="width:25px"
						src="<?php echo base_url('assets/dist/img/npp-logo.png'); ?>" class="user-image"
						alt="img not found" /></span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg">時代力量後台管理</span>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-fixed-top" role="navigation">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li class="title-on-top"><a class="hover-bg"><?php if (!empty($navTitle)) {
    echo $navTitle;
}?></a></li>
						<li class="dropdown tasks-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
								<i class="fa fa-history"></i>
							</a>
							<ul class="dropdown-menu">
								<li class="header"> 最後登入時間 : <i class="fa fa-clock-o"></i>
									<?=empty($last_login) ? "First Time Login" : $last_login;?></li>
							</ul>
						</li>
						<!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img style="width:20px" src="<?php echo base_url(); ?>assets/dist/img/npp-logo.png"
									class="img-circle" alt="User Image" />
								<span class="hidden-xs"><?php echo $name; ?></span>
							</a>
							<ul class="dropdown-menu">
								<!-- User image -->
								<li class="user-header">
									<img src="<?php echo base_url(); ?>assets/dist/img/npp-logo.png" class="img-circle"
										alt="User Image" />
									<p>
										<span
											style="display:block;font-size:30px;margin-top:-15px;margin-bottom:5px"><?php echo $name; ?></span>
										<small><?php echo $role_text; ?></small>
									</p>

								</li>
								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-left">
										<a href="<?php echo base_url(); ?>profile" class="btn btn-warning btn-flat"><i
												class="fa fa-user-circle"></i> 個人檔案</a>
									</div>
									<div class="pull-right">
										<a href="<?php echo base_url(); ?>logout" class="btn btn-default btn-flat"><i
												class="fa fa-sign-out"></i> 登出</a>
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
					<li>
						<a href="<?php echo base_url(); ?>dashboard">
							<i class="fa fa-dashboard"></i> <span>控制面板</span></i>
						</a>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-globe"></i> <span>新聞訊息</span>
							<!-- <span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span> -->
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url(); ?>news/lists/1">法案及議事說明</a></li>
							<li><a href="<?php echo base_url(); ?>news/lists/2">懶人包及議題追追追</a></li>
							<li><a href="<?php echo base_url(); ?>news/lists/3">行動紀實</a></li>
							<li><a href="<?php echo base_url(); ?>news/tagLists">標籤管理</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-briefcase"></i> <span>法案管理</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="#">法案狀態</a></li>
							<li><a href="#">分類管理</a></li>
							<li><a href="#">草案管理</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-user"></i> <span>本黨立委</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url('members'); ?>">立委管理</a></li>
							<li><a href="<?php echo base_url('members/years'); ?>">屆期管理</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-cog"></i> <span>網站管理</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url('website/carouselLists'); ?>">輪播管理</a></li>
							<li><a href="#">陳情須知內容編輯</a></li>
							<li><a href="<?php echo base_url('website/setup/' . true); ?>">其它設定</a></li>
						</ul>
					</li>

					<?php
if ($role == ROLE_ADMIN) {
    ?>
					<li>
						<a href="<?php echo base_url(); ?>userListing">
							<i class="fa fa-user-plus"></i>
							<span>人員管理1</span>
						</a>
					</li>
					<?php }?>
					<?php
if ($role == ROLE_MANAGER) {
    ?>
					<li>
						<a href="<?php echo base_url(); ?>user/managerListing">
							<i class="fa fa-user-plus"></i>
							<span>人員管理2</span>
						</a>
					</li>
					<?php }?>
				</ul>
			</section>
			<!-- /.sidebar -->
		</aside>