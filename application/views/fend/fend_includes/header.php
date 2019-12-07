<?php
$fb = $headerfooterInfo->fb;
$mail = $headerfooterInfo->mail;
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $pageTitle; ?></title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<!-- FontAwesome 4.3.0 -->
	<link href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<!-- Ionicons 2.0.0 -->
	<link href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />
	<!-- Bootstrap 4.1.3 -->
	<link href="<?php echo base_url(); ?>assets/public/css/all.css" rel="stylesheet" type="text/css" />
	<!-- <link href="<?php echo base_url(); ?>assets/bower_components/animate.css/animate.min.css" rel="stylesheet" type="text/css" /> -->
	<script src="<?php echo base_url(); ?>assets/bower_components/vue/dist/vue.min.js"></script>
	<script type="text/javascript">
		var baseURL = "<?php echo base_url(); ?>";
	</script>
	<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-warning fixed-top fixed-top_mobile">
		<a class="navbar-brand logo" href="<?php echo base_url(); ?>fend/home"><img src="<?php echo base_url(); ?>assets/f_imgs/header/LY-logo.svg" alt="圖片不存在"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto mr-3">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">新聞訊息</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<div class="container dropdownMenu-news_center">
							<div class="row">
								<div class="col-md-4">
									<ul class="nav flex-column">
										<li class="nav-item">
											<a class="nav-link" href="#">最新新聞</a>
										</li>
									</ul>
								</div>
								<!-- /.col-md-4  -->
								<div class="col-md-4">
									<ul class="nav flex-column">
										<li class="nav-item">
											<a class="nav-link" href="#">訊息公告</a>
										</li>
									</ul>
								</div>
								<!-- /.col-md-4  -->
								<div class="col-md-4">
									<ul class="nav flex-column">
										<li class="nav-item">
											<a class="nav-link" href="#">活動記錄</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<!--  /.container  -->
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">法案議題</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<div class="container dropdownMenu-news_center">
							<div class="row">
								<!-- 重點法案 -->
								<div class="col-md-6 itemHover1">
									<!-- pc -->
									<div class="mobile-hide" style="font-weight:bolder;font-size:16px">重點法案</div>
									<ul class="flex-gallery">
										<li class="flex-item">
											<a class="" href="#">勞動權益</a>
										</li>
										<li class="flex-item">
											<a class="" href="#">中國議題</a>
										</li>
										<li class="flex-item">
											<a class="" href="#">年金改革</a>
										</li>
										<li class="flex-item">
											<a class="" href="#">性別平權</a>
										</li>
										<li class="flex-item">
											<a class="" href="#">酒駕防治</a>
										</li>
										<li class="flex-item">
											<a class="" href="#">性別平權</a>
										</li>
										<li class="flex-item">
											<a class="" href="#">酒駕防治</a>
										</li>
									</ul>
									<!-- mobile -->
									<ul class="nav flex-column desktop-hide">
										<li class="flex-item flex-item_title">
											<a class="nav-link" href="#">重點法案</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#">勞動權益</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#">中國議題</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#">年金改革</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#">性別平權</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#">酒駕防治</a>
										</li>
									</ul>
								</div>
								<!-- 關注議題 -->
								<div class="col-md-6 itemHover2">
									<!-- pc -->
									<div class="mobile-hide" style="font-weight:bolder;font-size:16px">關注議題</div>
									<ul class="flex-gallery">
										<li class="flex-item">
											<a class="" href="#">跨國同婚</a>
										</li>
										<li class="flex-item">
											<a class="" href="#">托育講座</a>
										</li>
										<li class="flex-item">
											<a class="" href="#">教保條例</a>
										</li>
										<li class="flex-item">
											<a class="" href="#">社工師</a>
										</li>
										<li class="flex-item">
											<a class="" href="#">人事同意權</a>
										</li>
									</ul>
									<!-- mobile -->
									<ul class="nav flex-column desktop-hide">
										<li class="flex-item flex-item_title">
											<a class="nav-link" href="#">關注議題</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#">跨國同婚</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#">托育講座</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#">教保條例</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#">社工師</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#">人事同意權</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<!--  /.container  -->
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">本黨立委</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">聯絡陳情</a>
				</li>
			</ul>
			<form class="form-inline">
				<input class="form-control mr-sm-2" type="search" placeholder="搜尋" aria-label="Search">
				<button class="btn btn-outline-light my-2 my-sm-0 header-search" type="submit"><img src="<?php echo base_url(); ?>assets/f_imgs/header/header-search.svg" alt="圖片不存在" srcset=""></button>
			</form>
		</div>
		<div class=" nav-icons">
			<a target="blank" href="<?php echo $fb; ?>"><img src="<?php echo base_url(); ?>assets/f_imgs/header/header-facebook.svg" alt="圖片不存在" srcset=""></a>
			<a target="blank" href="mailto:<?php echo $mail; ?>"><img src="<?php echo base_url(); ?>assets/f_imgs/header/header-email.svg" alt="圖片不存在" srcset=""></a>
		</div>
	</nav>