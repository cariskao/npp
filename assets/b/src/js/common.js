$(function () {
   setTimeout(function () {
      $("#alert-success").hide();
   }, 3000);
   setTimeout(function () {
      $("#alert-error").hide();
   }, 3000);
})

// 各個Lists分頁
function pagination(url) {
   jQuery('ul.pagination li a').click(function (e) {
      // 當點擊下方頁面時,就獲取以下資料並跳轉
      e.preventDefault();
      var link = jQuery(this).get(0).href; // http://localhost/npp_ci/news/index/10
      // var test = link.lastIndexOf('/'); //最後一個「/」的位置
      // alert('test: ' + test);
      var value = link.substring(link.lastIndexOf('/') + 1);
      // alert('link: ' + link);
      // alert('value: ' + value);
      jQuery("#searchList").attr("action", baseURL + url + value); //注意這裡要加上index
      // jQuery("#searchList").attr("action", baseURL + "news/" + 10);
      jQuery("#searchList").submit();
   });
}

// 顯示狀態
$('#radioBtn a').on('click', function () {
   var sel = $(this).data('title');
   var tog = $(this).data('toggle');
   // console.log('sel', sel);
   // console.log('tog', tog);
   $('#' + tog).prop('value', sel); //將該被點擊的data-title值寫入到id="happy"的value中。

   // 當點擊爲Y,就把不爲Y的元素移除active並加上notActive
   $('a[data-toggle="' + tog + '"]').not('[data-title="' + sel + '"]').removeClass('active').addClass(
      'notActive');
   // 當點擊爲Y,就把爲Y的元素移除notActive並加上active
   $('a[data-toggle="' + tog + '"][data-title="' + sel + '"]').removeClass('notActive').addClass('active');
})