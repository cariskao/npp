<footer class="main-footer text-center">
	數位玩家資訊科技有限公司 高雄市楠梓區高雄大學路700號 07-5911329 服務時間：週一至週五 9：00 - 18：00 聯絡信箱：service@geekers.tw
</footer>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.js" type="text/javascript"></script>
<!-- <script src="<?php echo base_url(); ?>assets/dist/js/pages/dashboard.js" type="text/javascript"></script> -->
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/b/build/js/all.js" type="text/javascript"></script>

<script type="text/javascript">
	// 上方導航標題置中
	var $titleTop = $('.nav.navbar-nav li.title-on-top');
	var $halfWidth = $titleTop.width() / 2;
	// console.log('$halfWidth', $halfWidth);

	//這裏要取得跟我們設定position的相反值才能獲取,這裏設爲right,所以要log出的值爲left
	// console.log($titleTop.position().left);//但是這一行得不到我們要的值,只是說明一下
	$titleTop.css({
		right: 'calc(50% - ' + $halfWidth + 'px)', //記得「-」號右邊要空一格
		position: 'absolute'
	});

	// 進入其它頁面也會在相關的導航有 current active
	var windowURL = window.location.href;
	var index = '';
	var bool = windowURL.indexOf('tw') != -1 ? true : false;

	if (bool) {
		index = windowURL.indexOf('/', 10) + 1;
	} else {
		index = windowURL.indexOf('npp') + 4;
	}

	var str = windowURL.substring(index, windowURL.indexOf('/',index));

	// var _1stPos = windowURL.indexOf('tw') != -1 ? : windowURL.indexOf('geekers') + 3;
	// var index = windowURL.indexOf('geekers') != -1 ? windowURL.indexOf('/') : windowURL.indexOf('/', windowURL.indexOf('/') + 1);

	// var index1 = windowURL.indexOf('npp') + 4;
	// var url1 = windowURL.substring(index1);
	// var str1 = url1.substring(0, url1.indexOf('/'));
	// var str2 = url1.substring(url1.indexOf('') + 1);
	// var index2 = url1.indexOf('/') + 1;
	// var index3 = url1.lastIndexOf('/');
	// var _str = index3 == -1 ? url1.substring(index2) : url1.substring(index2, index3);

	// console.log('windowURL', windowURL);
	// console.log(index);
	// console.log(bool);
	// console.log(str);
	// console.log('獲取npp後的第一個字串index值', index1);
	// console.log('url1', url1);
	// console.log('str1', str1);
	// console.log('index2', index2);
	// console.log('index3', index3);
	// console.log(str2);
	// console.log(_str);

	// str=windowURL.replace('adds','lists');
	// console.log(str);

	// 獲取當前頁面url後,就在符合該url的<a></a>上加上.active(對照header)
	var _activeLeftnav = $('a[href="' + windowURL + '"]');
	_activeLeftnav.addClass('active');
	_activeLeftnav.parent().addClass('active');
	_activeLeftnav.parents('.treeview').addClass('active');
	// console.log(_activeLeftnav);

	// 進入內頁左方導航也會顯示curent active
	// if (str1 == 'news') {
	// 	$('.news-active').addClass('active');

	// 	if (windowURL.indexOf('lists/1') != -1) {
	// 		$('.news-active .treeview-menu>li:first-child').addClass('active');
	// 		$('.news-active .treeview-menu>li:first-child a').addClass('active');
	// 	}else if (windowURL.indexOf('lists/2') != -1) {
	// 		$('.news-active .treeview-menu>li:nth-child(2)').addClass('active');
	// 		$('.news-active .treeview-menu>li:nth-child(2) a').addClass('active');
	// 	}else if (windowURL.indexOf('lists/3') != -1) {
	// 		$('.news-active .treeview-menu>li:nth-child(3)').addClass('active');
	// 		$('.news-active .treeview-menu>li:nth-child(3) a').addClass('active');
	// 	}
	// } else if (str1 == 'members') {
	// 	$('.member-active').addClass('active');
	// } else if (str1 == 'website') {
	// 	$('.website-active').addClass('active');
	// }

	$(document).ready(function () {
		// 偵測瀏覽器
		var explorer = navigator.userAgent;
		var _brower = false;

		if (explorer.indexOf("Firefox") >= 0) {
			// console.log("Firefox");
			_brower = true;
		} else if (explorer.indexOf("Chrome") >= 0) {
			// console.log("Chrome & Opera");
		} else if (explorer.indexOf("Safari") >= 0) {
			// console.log("Safari");
			_brower = true;
		}


		var _isPhone = false;

		$('.sidebar-toggle').click(function () {
			if (_brower) {
				if (!_isPhone) {
					$('.functoin-on-top').css('left', '50px');
					_isPhone = true;
				} else {
					$('.functoin-on-top').css('left', '230px');
					_isPhone = false;
				}
			}
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