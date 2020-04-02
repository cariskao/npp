<div class="breadcrumb-bg">
   <div class="container">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li style="" class="breadcrumb-item"><a href="<?php echo base_url('fend/home'); ?>">首頁</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">本黨立委</li>
         </ol>
      </nav>
   </div>
</div>
<div id="gotop">^</div>
<div id="loader">
   <div class="loader"></div>
</div>
<div class="container">
   <select name="" id="year-select" class="form-control mb-3 pretty-select">
      <?php
if (!empty($getYearsList)) {
    foreach ($getYearsList as $item) {
        ?>
      <option value="<?php echo $item->yid; ?>">
         <?php echo $item->title . '(' . $item->date_start . '~' . $item->date_end . ')'; ?></option>
      <?php
}
}
?>
   </select>
   <!-- members-info -->
   <div class="row mt-5" id="member-info"></div>
</div>
<style>
</style>
<script>
   // select
   $(function () {
      let $this = $(this),
         text = $this.find('option:selected').text(),
         _l = text.length,
         _w = _l * 4 + 300,
         hitURL = baseURL + 'fend/members_f/yearChange',
         yid = $('#year-select :selected').val()

      $('#year-select').css('width', _w + 'px');

      $.ajax({
         url: hitURL,
         method: "POST",
         data: {
            yid: yid
         },
         success: function (res) {
            $('#member-info').html(res);
         }
      })
   });

   $(document).on('change', '#year-select', function () {
      let $this = $(this),
         hitURL = baseURL + 'fend/members_f/yearChange',
         text = $this.find('option:selected').text(),
         _l = text.length,
         _w = _l * 4 + 300,
         yid = $('#year-select :selected').val(); //注意:selected前面有個空格！

      $('#year-select').css('width', _w + 'px');

      $.ajax({
         url: hitURL,
         method: "POST",
         data: {
            yid: yid
         },
         success: function (res) {
            $('#member-info').html(res);
         }
      })
   });
</script>