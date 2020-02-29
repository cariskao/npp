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
	var _host = window.location.hostname;
	// var _path = window.location.pathname;
	// var _activeURL = _host;//下方分頁會有問題
	// var _protocol = window.location.protocol;

	if (_host.indexOf('localhost') != -1) {
		index = windowURL.indexOf('npp') + 4;
		// _activeURL += '/npp';//下方分頁會有問題
	} else {
		index = windowURL.indexOf('/', 10) + 1;
	}

	var str = windowURL.substring(index, windowURL.indexOf('/', index));

	// console.log('windowURL', windowURL);
	// console.log('str', str);

	// 進入內頁左方導航也會顯示curent active
	if (str == 'news') {
		$('.news-active').addClass('active');

		// 點擊下方分頁時,左方導航也會出現active
		var _find = 'lists/';
		if (windowURL.indexOf(_find) != -1) {
			_index = windowURL.indexOf(_find) + _find.length;
			var _type_id = windowURL.substring(_index, _index + 1);
			$('.news-active .treeview-menu>li:nth-child(' + _type_id + ')').addClass('active');
			$('.news-active .treeview-menu>li:nth-child(' + _type_id + ') a').addClass('active');
			// var _2ndActive = _activeURL + '/news/' + _find + _type_id + '/';//下方分頁會有問題
		}

		// 點擊「新增」時左方導航也會出現active(編輯的部分因爲需要獲取type_id,所以做在編輯頁面裡)
		if (windowURL.indexOf('adds') != -1) {
			var _type_id = windowURL.substring(windowURL.lastIndexOf('/') + 1);
			$('.news-active .treeview-menu>li:nth-child(' + _type_id + ')').addClass('active');
			$('.news-active .treeview-menu>li:nth-child(' + _type_id + ') a').addClass('active');
		}

		if (windowURL.indexOf('tag') != -1) {
			$('.news-active .treeview-menu>li:last-child').addClass('active');
			$('.news-active .treeview-menu>li:last-child a').addClass('active');
		}

	} else if (str == 'members') {
		$('.member-active').addClass('active');
	} else if (str == 'website') {
		$('.website-active').addClass('active');

				if (windowURL.indexOf('carousel') != -1) {
			$('.website-active .treeview-menu>li:first-child').addClass('active');
			$('.website-active .treeview-menu>li:first-child a').addClass('active');
		}
	}

	// 獲取當前頁面url後,就在符合該url的<a></a>上加上.active(對照header)
	// var _activeLeftnav = $('a[href="' + _protocol + '//' + _2ndActive + '"]');// 下方分頁會error
	var _activeLeftnav = $('a[href="' + windowURL + '"]');
	_activeLeftnav.addClass('active');
	_activeLeftnav.parent().addClass('active');
	_activeLeftnav.parents('.treeview').addClass('active');
	// console.log(_activeLeftnav);

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