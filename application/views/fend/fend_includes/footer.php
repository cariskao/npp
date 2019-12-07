<?php
$mail = $headerfooterInfo->mail;
$phoneSend = $headerfooterInfo->phonesend;
$phoneShow = $headerfooterInfo->phoneshow;
$fax = $headerfooterInfo->fax;
$servicetime = $headerfooterInfo->servicetime;
?>
<footer class="container-fluid container-footer_style">
	<div class="row">
		<div class="col-lg">
			<a class="logo logo-footer_center" href="#"><img src="<?php echo base_url(); ?>assets/f_imgs/header/LY-logo.svg" alt="圖片不存在"></a>
			<address>
				<div><span>地址</span><a target="blank" href="https://www.google.com.tw/maps/place/%E7%AB%8B%E6%B3%95%E9%99%A2%E9%9D%92%E5%B3%B6%E4%B8%89%E9%A4%A8/@25.0442613,121.5205838,19z/data=!3m1!4b1!4m5!3m4!1s0x3442a971746339c3:0x841664d7ac9478bc!8m2!3d25.0442613!4d121.521131">100台北市中正區青島東路1-3號2樓</a></div>
				<div><span>信箱</span><a target="blank" href="mailto:<?php echo $mail; ?>"><?php echo $mail; ?></a></div>
				<div><span>電話</span><a target="blank" href="tel:<?php echo $phoneSend; ?>"><?php echo $phoneShow; ?></a></div>
				<div><span>傳真</span><?php echo $fax; ?></div>
				<div><span>服務時間</span><?php echo $servicetime; ?></div>
			</address>
		</div>
		<div class="col-lg-3"></div>
		<div class="col-lg-3"></div>
	</div>
</footer>
<script src="<?php echo base_url(); ?>assets/node_modules/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap4/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/popper.js/dist/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/public/js/all.js" type="text/javascript"></script>
<script type="text/javascript">
	var windowURL = window.location.href;
	pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
	var x = $('a[href="' + pageURL + '"]');
	x.addClass('active');
	x.parent().addClass('active');
	var y = $('a[href="' + windowURL + '"]');
	y.addClass('active');
	y.parent().addClass('active');
</script>
</body>

</html>