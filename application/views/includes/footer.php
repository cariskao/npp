<footer class="main-footer" style="text-align:center;padding-top:0;padding-bottom:0">
	數位玩家資訊科技有限公司 高雄市楠梓區高雄大學路700號 07-5911329 服務時間：週一至週五 9：00 - 18：00 聯絡信箱：service@geekers.tw
</footer>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.js" type="text/javascript"></script>
<!-- <script src="<?php echo base_url(); ?>assets/dist/js/pages/dashboard.js" type="text/javascript"></script> -->
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>
<script type="text/javascript">
	// 上方導航標題置中
	var $titleTop = $('.nav.navbar-nav li.title-on-top');
	var $halfWidth = $titleTop.width() / 2;
	// console.log('$halfWidth', $halfWidth);

	$titleTop.css({
		right: 'calc(50% - ' + $halfWidth + 'px)', //記得「-」號右邊要空一格
		position: 'absolute'
	});

	//這裏要取得跟我們設定position的相反值才能獲取,這裏設爲right,所以要log出的值爲left
	// console.log($titleTop.position().left);//但是這一行得不到我們要的值,只是說明一下

	// 獲取當前頁面url後,就在符合該url的<a></a>上加上.active
	var windowURL = window.location.href;
	pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));

	var x = $('a[href="' + pageURL + '"]');
	x.addClass('active');
	x.parent().addClass('active');
	x.parents('.treeview').addClass('active');

	var y = $('a[href="' + windowURL + '"]');
	y.addClass('active');
	y.parent().addClass('active');
	y.parents('.treeview').addClass('active');
	// console.log('windowURL', windowURL);
	// console.log('pageURL', pageURL);
	// console.log('x', x);
	// console.log('y', y);

	$(document).ready(function () {
		$('.sidebar-toggle').click(function () {
			setTimeout(function () {
				var w = $('.sidebar-menu').width();
				// alert(w);
				if (w <= 50) {
					$('.skin-blue .sidebar-menu .treeview-menu>li').css('padding-left', '0');
					$('.treeview>a').css('cursor', 'pointer');
				} else {
					$('.skin-blue .sidebar-menu .treeview-menu>li').css('padding-left', '30px');
					$('.treeview>a').css('cursor', 'text');
				}
			}, 500);
		});
	});
</script>
</body>

</html>