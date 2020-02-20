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

	var _activeLeftnav = $('a[href="' + windowURL + '"]');
	_activeLeftnav.addClass('active');
	_activeLeftnav.parent().addClass('active');
	_activeLeftnav.parents('.treeview').addClass('active');
	// console.log('windowURL', windowURL);
	// console.log('_activeLeftnav', _activeLeftnav);

	$(document).ready(function () {
		// 偵測瀏覽器
		var explorer = navigator.userAgent;
		var _brower = 0;

		if (explorer.indexOf("Firefox") >= 0) {
			// alert("Firefox");
			_brower = 1;
		}
		if (explorer.indexOf("Safari") >= 0) {
			_brower = 2;
		}

		$('.sidebar-toggle').click(function () {
			setTimeout(function () {
				var w = $('.sidebar-menu').width();
				// alert(w);
				if (w <= 50) {
					$('.skin-blue .sidebar-menu .treeview-menu>li').css('padding-left', '0');
					$('.treeview>a').css('cursor', 'pointer');

					if (_brower == 1 || _brower == 2) {
						$('.functoin-on-top').css('left', '50px');
					}
				} else {
					$('.skin-blue .sidebar-menu .treeview-menu>li').css('padding-left', '30px');
					$('.treeview>a').css('cursor', 'text');

					if (_brower == 1 || _brower == 2) {
						$('.functoin-on-top').css('left', '230px');
					}
				}
			}, 500);
		});
	});
</script>
</body>

</html>