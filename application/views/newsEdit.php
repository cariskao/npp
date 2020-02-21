<?php
$pr_id      = $userInfo->pr_id;
$type_id    = $userInfo->pr_type_id;
$img        = $userInfo->img;
$m_title    = $userInfo->main_title;
$s_title    = $userInfo->sub_title;
$date_start = $userInfo->date_start;
$time_start = $userInfo->time_start;
$editor     = $userInfo->editor;
?>
<script src="<?php echo base_url('assets/plugins/selectizejs/dist/js/standalone/selectize.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/selectizejs/js/index.js'); ?>"></script>
<div class="content-wrapper">
	<section>
		<div class="functoin-on-top" style="margin-top:51.45px;width:100%">
			<div class="row">
				<div class="col-xs-12">
					<div class="box" style="border-top:none;border-radius:0">
						<div class="box-header" style="border-bottom:2px solid #d2d6de;">
							<div class="row">
								<div class="col-xs-12">
									<div class="form-group">
										<a class="btn btn-warning" href="<?php echo base_url('news/lists/' . $type_id); ?>">返回</a>
									</div>
								</div>
							</div>
						</div><!-- /.box-header -->
					</div>
				</div>
			</div>
		</div>
		<div class="add-fixed-top-css" style="border-top:none;">
			<div class="row">
				<!-- left column -->
				<div class="col-md-12">
					<!-- general form elements -->
					<div class="box box-primary" style="border:none;">
						<!-- form start -->
						<!--  enctype="multipart/form-data"記得加 -->
						<form role="form" action="<?php echo base_url('news/editSend/' . $pr_id); ?>" method="post" id="" role="form" enctype="multipart/form-data">
							<div class="box-body">
								<div class="row">
									<div class="col-md-6 col-xs-12">
										<div class="form-group">
											<div class="row">
												<img class="col-md-12 col-xs-12" src="<?php echo base_url('assets/uploads/news_upload/' . $type_id . '/' . $img); ?>">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="img">更換圖片</label>
											<input class="form-control" id="img" type="file" name="file" size="20" />
											<?php echo form_error('file'); ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="m_title">大標</label>
											<input type="text" class="form-control" id="m_title" name="m_title" value="<?php echo $m_title; ?>">
											<?php echo form_error('m_title'); ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="s_title">次標</label>
											<input type="text" class="form-control" id="s_title" name="s_title" value="<?php echo $s_title; ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="select-tools">標籤:</label>
											<!-- name記得加上[],才能以陣列形式回傳。並加上multiple="multiple"才能在一開始就同時顯示selected的全部元素 -->
											<select id="select-tools" name="tags[]" placeholder="請選取標籤" multiple="multiple">
												<option value="">請選取標籤</option>
												<?php
if (!empty($getTagsList)) {
    foreach ($getTagsList as $record) {
        ?>
														<option value="<?php echo $record->tags_id; ?>"><?php echo $record->name; ?></option>
												<?php
}
}
?>
											</select>
											<input type="hidden" name="type_id" id="type_id" value="<?php echo $type_id; ?>">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="date_start">建立日期</label>
											<input type="date" class="form-control" id="date_start" name="date_start" value="<?php echo $date_start; ?>">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="time_start">建立時間</label>
											<input type="time" class="form-control" id="time_start" name="time_start" value="<?php echo $time_start; ?>">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="">顯示狀態</label>
											<div class="input-group">
												<div id="radioBtn" class="btn-group">
													<?php
$active    = $userInfo->showup == 1 ? 'active' : 'notActive';
$notActive = $userInfo->showup == 0 ? 'active' : 'notActive';
?>
													<a class="btn btn-primary btn-sm <?php echo $active; ?>" data-toggle="happy" data-title="Y">顯示</a>
													<a class="btn btn-primary btn-sm <?php echo $notActive; ?>" data-toggle="happy" data-title="N">隱藏</a>
												</div>
												<input type="hidden" name="happy" id="happy">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<textarea name="editor1" id="editor1"><?php echo $editor; ?></textarea>
										<script>
											CKEDITOR.replace("editor1", {
												filebrowserBrowseUrl: "<?php echo base_url('assets/plugins/ckeditor4/filemanager/dialog.php?type=2&editor=ckeditor&fldr='); ?>",
												filebrowserUploadUrl: "<?php echo base_url('assets/plugins/ckeditor4/filemanager/dialog.php?type=2&editor=ckeditor&fldr='); ?>",
												filebrowserImageBrowseUrl: "<?php echo base_url('assets/plugins/ckeditor4/filemanager/dialog.php?type=1&editor=ckeditor&fldr='); ?>",
												// width: 1000,
												height: 800,
												// language: '',
												toolbarCanCollapse: true, // ui可縮起來
											});
										</script>
									</div>
								</div>
							</div><!-- /.box-body -->
							<input type="submit" class="btn btn-success submit-pos" value="儲存" />
					</div>
					</form>
				</div>
				<!-- box -->
			</div>
			<!-- <div class="col-md-12"> -->

			<script language='javascript' type='text/javascript'>
				$(function() {
					setTimeout(function() {
						$("#alert-success").hide();
					}, 3000);
					setTimeout(function() {
						$("#alert-error").hide();
					}, 3000);
				})

				// 顯示狀態
				$('#radioBtn a').on('click', function() {
					var sel = $(this).data('title');
					var tog = $(this).data('toggle');
					// console.log('sel', sel);
					// console.log('tog', tog);
					$('#' + tog).prop('value', sel); //將該被點擊的data-title值寫入到id="happy"的value中。

					// 當點擊爲Y,就把不爲Y的元素移除active並加上notActive
					$('a[data-toggle="' + tog + '"]').not('[data-title="' + sel + '"]').removeClass('active').addClass('notActive');
					// 當點擊爲Y,就把爲Y的元素移除notActive並加上active
					$('a[data-toggle="' + tog + '"][data-title="' + sel + '"]').removeClass('notActive').addClass('active');
				})

				// 標籤
				$('#select-tools').selectize({
					maxItems: 5,
					plugins: ['remove_button'],
					sortField: { //排序
						field: 'id', // text:依據文本排序，id：依據value排序
						direction: 'asc' // 升序降序
					}
				});

				var selectTools = $('#select-tools')[0].selectize;
				var jsArray = ["<?php echo join("\", \"", $getTagsChoice); ?>"];
				// console.log('jsArray',jsArray);

				selectTools.setValue(jsArray, true);
			</script>
			<?php
$this->load->helper('form');
$check = $this->session->flashdata('check');
if ($check == '驗證失敗') {
    ?>
				<div id="alert-error" class="alert-absoulte error-width alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<?php echo $this->session->flashdata('check') . '!<br>請修正以下提示錯誤!'; ?>

				</div>
			<?php }?>
			<?php
$success = $this->session->flashdata('success');
// echo $success; //存儲成功!
if ($success && $check == '驗證成功') {
    ?>
				<div id="alert-success" class="alert-absoulte success-width alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<?php echo $this->session->flashdata('success'); ?>
				</div>
			<?php }?>
			<!-- <?php echo validation_errors('<div id="alert-error" class="alert-absoulte alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?> -->
		</div>
		<!-- row -->
</div>
<!-- add-fixed-top-css -->
</section>
</div>
<!-- content-wrapper -->