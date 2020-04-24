<?php
$e = $getPetition->editor;
?>

<div class="breadcrumb-bg">
   <div class="container">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li style="" class="breadcrumb-item"><a href="<?php echo base_url('fend/home'); ?>">首頁</a></li>
            <li style="" class="breadcrumb-item"><a href="<?php echo base_url('fend/bill_issues_f'); ?>">法案議題</a></li>
            <li style="" class="breadcrumb-item"><a
                  href="<?php echo base_url('fend/issues_f/issues_class_f'); ?>">關注議題</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $breadcrumbTag; ?></li>
         </ol>
      </nav>
   </div>
</div>
<div id="gotop">^</div>
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <div class="form-title">陳情須知</div>
      </div>
      <div class="col-md-12"><?php echo $e; ?></div>
      <div class="col-md-12">
         <div class="form-title">陳情表單<span class="must">*為必填</span></div>
      </div>
      <div class="col-md-12">
         <form action="<?php echo base_url('issues/issuesAllAddSend/'); ?>" method="post" enctype="multipart/form-data"
            class="petition-f">
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="title" class="must">姓名</label>
                     <input type="text" class="form-control" id="title" name="title" value="" placeholder="請輸入姓名">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="title" class="must">性別 (請讓我們知道後續聯絡時該如何稱呼您)</label><br>
                     <!-- Default inline 1-->
                     <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="male" name="sex" checked>
                        <label class="custom-control-label" for="male">先生</label>
                     </div>

                     <!-- Default inline 2-->
                     <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="female" name="sex">
                        <label class="custom-control-label" for="female">女士</label>
                     </div>

                     <!-- Default inline 3-->
                     <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="other" name="sex">
                        <label class="custom-control-label" for="other">其它</label>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="mail" class="must">聯絡信箱</label>
                     <input type="text" class="form-control" id="mail" name="mail" value=""
                        placeholder="例如 npp.ly@npptw.org">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="phone" class="must">聯絡電話</label>
                     <input type="text" class="form-control" id="phone" name="phone" value="" placeholder="請輸入聯絡電話">
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <label for="textarea" class="must">陳情內容</label>
                     <textarea class="form-control" name="textarea" id="textarea" rows="5" placeholder="請簡單描述您想要陳情的內容，例如，提供某個修法或政策的建議、告訴我們某件您在意並希望改善或處理的事情，若有相關連結也歡迎您附上。
最後請簡單描述您希望我們可以怎麼協助您，以讓我們更快進入狀況，非常感謝！"></textarea>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <div style="margin-bottom:15px">相關附件</div>
                     <a href="javascript:;" class="file">上傳檔案
                        <input type="file" name="file" id="file" />
                     </a>
                  </div>
                  <p>*若您陳情的事項有相關文件或照片、圖片等，也歡迎您一併上傳提供。</p>
                  <p>*上傳檔案大小限制5MB。</p>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<script>
</script>