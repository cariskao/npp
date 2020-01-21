<div class="container-fluid">
   <div id="carousel" class="carousel slide" data-ride="carousel">

      <!-- 指示符 -->
      <ul class="carousel-indicators">
         <?php
         $i = 0;
         if (!empty($getCarouselInfo)) {
            foreach ($getCarouselInfo as $record) {
         ?>
               <li data-target="#carousel" data-slide-to="<?php echo $i++; ?>">
               </li>
         <?php
            }
         }
         ?>
      </ul>

      <!-- 輪播圖片 -->
      <div class="carousel-inner">
         <?php
         if (!empty($getCarouselInfo)) {
            foreach ($getCarouselInfo as $record) {
         ?>
               <div class="carousel-item">
                  <a href="<?php echo $record->link; ?>"><img src="<?php echo base_url('assets/uploads/carousel_upload/' . $record->img); ?>"></a>
                  <div class="carousel-caption">
                     <h3><?php echo $record->title; ?></h3>
                     <p><?php echo $record->introduction; ?></p>
                  </div>
               </div>
         <?php
            }
         }
         ?>
      </div>

      <!-- 左右切換按鈕 -->
      <a class="carousel-control-prev" href="#carousel" data-slide="prev">
         <span class="carousel-control-prev-icon"></span>
      </a>
      <a class="carousel-control-next" href="#carousel" data-slide="next">
         <span class="carousel-control-next-icon"></span>
      </a>
   </div>
</div>
<script>
   $(function() {
      $('.carousel').carousel({
         interval: 7000, // false
         pause: "hover", // false
      });
   });

   $(".carousel-indicators li:first").addClass("active");
   $(".carousel-inner div:first").addClass("active");
</script>