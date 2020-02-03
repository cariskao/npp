<?php
$mail = $getSetupInfo->mail;
$fb   = $getSetupInfo->fb;
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $pageTitle; ?></title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<!-- FontAwesome 4.3.0 -->
	<link href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet"
		type="text/css" />
	<!-- Ionicons 2.0.0 -->
	<link href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css" rel="stylesheet"
		type="text/css" />
	<!-- Bootstrap 4.1.3 -->
	<link href="<?php echo base_url(); ?>assets/public/css/all.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo base_url(); ?>assets/node_modules/jquery/dist/jquery.min.js"></script>
	<!-- 如果是 <script type="text/javascript"> 的載入方式，可以直接使用umd目錄下的popper.js -->
	<script src="<?php echo base_url(); ?>assets/bower_components/popper.js/dist/umd/popper.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap4/dist/js/bootstrap.min.js"></script>
	<!-- <link href="<?php echo base_url(); ?>assets/bower_components/animate.css/animate.min.css" rel="stylesheet" type="text/css" /> -->
	<script src="<?php echo base_url(); ?>assets/bower_components/vue/dist/vue.min.js"></script>
	<script type="text/javascript">
		var baseURL = "<?php echo base_url(); ?>";
	</script>
	<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<style>
		@font-face {
			font-family: KozGoPr6N-Light_0;
			src: url("<?php echo base_url('assets/fonts/KozGoPr6N-Light_0.otf'); ?>");
		}

		* {
			font-family: KozGoPr6N-Light_0;
		}

		h1,
		h2,
		h3,
		h4,
		h5,
		h6 {
			font-weight: bolder;
		}
	</style>
</head>

<body class="body-css">
	<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top fixed-top_mobile">
		<a class="navbar-brand logo" href="<?php echo base_url('fend/home'); ?>"><img
				src="<?php echo base_url(); ?>assets/f_imgs/header/LY-logo.svg" alt="圖片不存在"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
			aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto mr-3">
				<li class="nav-item"><a class="nav-link" style="<?php if ($navActive == 1) {
    echo 'color: #ffc107';
}?>" href="<?php echo base_url('fend/news_f'); ?>">新聞訊息</a></li>
				<li class="nav-item"><a class="nav-link" style="<?php if ($navActive == 2) {
    echo 'color: #ffc107';
}?>" href="<?php echo base_url('fend/'); ?>">法案議題</a></li>
				<li class="nav-item"><a class="nav-link" style="<?php if ($navActive == 3) {
    echo 'color: #ffc107';
}?>" href="<?php echo base_url('fend/'); ?>">本黨立委</a></li>
				<li class="nav-item"><a class="nav-link" style="<?php if ($navActive == 4) {
    echo 'color: #ffc107';
}?>" href="<?php echo base_url('fend/'); ?>">聯絡陳情</a></li>
				<li class="nav-item"><a class="nav-link" href="#"><img
							src="<?php echo base_url(); ?>assets/f_imgs/header/header_search.png" style="width:18px"
							alt="圖片不存在"></a></li>
			</ul>
		</div>
		<div class="nav-icons">
			<a target="blank" href="<?php echo $fb; ?>"><img
					src="<?php echo base_url('assets/f_imgs/header/header_fb.png'); ?>" alt="圖片不存在"></a>
			<a target="blank" href="mailto:<?php echo $mail; ?>"><img
					src="<?php echo base_url('assets/f_imgs/header/header_mail.png'); ?>" alt="圖片不存在"></a>
		</div>
	</nav>