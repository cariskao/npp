<script src="<?php echo base_url('assets/plugins/selectizejs/dist/js/standalone/selectize.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/selectizejs/js/index.js'); ?>"></script>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<?php if ($type_id == 1) : ?>
			<h1>新聞訊息 - 法案及議事說明 - 新增</h1>
		<?php elseif ($type_id == 2) : ?>
			<h1>新聞訊息 - 懶人包及議題追追追 - 新增</h1>
		<?php elseif ($type_id == 3) : ?>
			<h1>新聞訊息 - 行動紀實 - 新增</h1>
		<?php endif; ?>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-xs-12 text-right">
				<div class="form-group">
					<a class="btn btn-warning" href="<?php echo base_url('news/lists/' . $type_id); ?>">返回</a>
				</div>
			</div>
		</div>
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->

				<div class="box box-primary">
					<!-- form start -->
					<!--  enctype="multipart/form-data"記得加 -->
					<form role="form" action="<?php echo base_url('news/addsSend/' . $type_id); ?>" method="post" id="" role="form" enctype="multipart/form-data">
						<div class="box-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="img">新增圖片</label>
										<input type="file" name="file" />
										<?php echo form_error('file'); ?>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="m_title">大標</label>
										<input type="text" class="form-control" id="m_title" name="m_title" value="">
										<?php echo form_error('m_title'); ?>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="s_title">次標</label>
										<input type="text" class="form-control" id="s_title" name="s_title" value="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="select-tools">標籤:</label>
										<!-- name記得加上[],才能以陣列形式回傳 -->
										<select id="select-tools" name="tags[]" placeholder="請選取標籤">
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
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="date_start">建立日期</label>
										<input type="date" class="form-control" id="date_start" name="date_start" value="">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="time_start">建立時間</label>
										<input type="time" class="form-control" id="time_start" name="time_start" value="">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="">顯示狀態</label>
										<div class="input-group">
											<div id="radioBtn" class="btn-group">
												<a class="btn btn-primary btn-sm active" data-toggle="happy" data-title="Y">顯示</a>
												<a class="btn btn-primary btn-sm notActive" data-toggle="happy" data-title="N">隱藏</a>
											</div>
											<input type="hidden" name="happy" id="happy">
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<textarea name="editor1" id="editor1"></textarea>
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

						<div class="box-footer seat" style="text-align:center">
							<input type="submit" class="btn btn-primary" value="儲存" />
							<input type="reset" class="btn btn-default" value="重置" />
						</div>
					</form>
				</div>
			</div>
			<!-- <div class="col-md-12"> -->

			<script language='javascript' type='text/javascript'>
				// 上方訊息視窗
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

				// 插件產生的link,在ci無法使用下列語法獲取到最後一個<link>來做改寫,所以先在error的路徑直接放入該檔案解決
				// console.log($('link:last-of-type').attr('href'));
				// console.log($('link:last-child').attr('href'));
				// console.log($('link:last').attr('href'));
				// console.log($('link').last().attr('href'));
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
			<?php } ?>
			<?php
			$success = $this->session->flashdata('success');
			if ($success) {
			?>
				<div id="alert-success" class="alert-absoulte success-width alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<?php echo $this->session->flashdata('success'); ?>
				</div>
			<?php } ?>

			<style>
				#radioBtn .notActive {
					color: #3276b1;
					background-color: #fff;
				}

				.seat input {
					width: 100px;
					margin: 0 40px;
				}

				.success-width {
					width: 150px;
				}

				.error-width {
					width: 250px;
				}

				.alert-absoulte {
					text-align: center;
					position: absolute;
					margin: auto;
					left: 230px;
					right: 0;
					top: 80px;
				}

				@media screen and (max-width: 768px) {
					.alert-absoulte {
						left: 0;
					}
				}
			</style>
			<!-- <?php echo validation_errors('<div id="alert-error" class="alert-absoulte alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?> -->
		</div>
	</section>
</div>