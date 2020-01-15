<footer class="main-footer" style="text-align:center;padding-top:0;padding-bottom:0">
  數位玩家資訊科技有限公司 高雄市楠梓區高雄大學路700號 07-5911329 服務時間：週一至週五 9：00 - 18：00 聯絡信箱：service@geekers.tw
</footer>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js" type="text/javascript"></script>
<!-- <script src="<?php echo base_url(); ?>assets/dist/js/pages/dashboard.js" type="text/javascript"></script> -->
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>
<script type="text/javascript">
  var $titleTop = $('.nav.navbar-nav li.title-on-top');
  var $halfWidth = $titleTop.width() / 2;
  // console.log('$halfWidth', $halfWidth);

  $titleTop.css({
    right: 'calc(50% - ' + $halfWidth + 'px)', //記得「-」號右邊要空一格
    position: 'absolute'
  });

  //這裏要取得跟我們設定position的相反值才能獲取,這裏設爲right,所以要log出的值爲left
  // console.log($titleTop.position().left);//但是這一行得不到我們要的值,只是說明一下

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