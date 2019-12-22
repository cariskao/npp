<script src="<?php echo base_url(); ?>assets/plugins/selectizejs/dist/js/standalone/selectize.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/selectizejs/js/index.js"></script>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<i class="fa fa-globe"></i> 新增活動記錄資料
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-xs-12 text-right">
				<div class="form-group">
					<a class="btn btn-warning" href="<?php echo base_url(); ?>news/records">返回</a>
				</div>
			</div>
		</div>
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">新增活動記錄資料</h3>
					</div><!-- /.box-header -->
					<!-- form start -->

					<!--  enctype="multipart/form-data"記得加 -->
					<form role="form" action="<?php echo base_url() ?>news/addNewRecords" method="post" id="" role="form" enctype="multipart/form-data">
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
										<select id="select-tools" placeholder="請選取標籤"></select>
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
											filebrowserBrowseUrl: '<?php echo base_url(); ?>assets/plugins/ckeditor4/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
											filebrowserUploadUrl: '<?php echo base_url(); ?>assets/plugins/ckeditor4/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
											filebrowserImageBrowseUrl: '<?php echo base_url(); ?>assets/plugins/ckeditor4/filemanager/dialog.php?type=1&editor=ckeditor&fldr=',
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
					console.log('sel', sel);
					console.log('tog', tog);
					$('#' + tog).prop('value', sel); //將該被點擊的data-title值寫入到id="happy"的value中。

					// 當點擊爲Y,就把不爲Y的元素移除active並加上notActive
					$('a[data-toggle="' + tog + '"]').not('[data-title="' + sel + '"]').removeClass('active').addClass('notActive');
					// 當點擊爲Y,就把爲Y的元素移除notActive並加上active
					$('a[data-toggle="' + tog + '"][data-title="' + sel + '"]').removeClass('notActive').addClass('active');
				})

				// 標籤
				$('#select-tools').selectize({
					maxItems: null,
					valueField: 'id',
					labelField: 'title',
					searchField: 'title',
					options: [{
							id: 1,
							title: 'Spectrometer',
							url: 'http://en.wikipedia.org/wiki/Spectrometers'
						},
						{
							id: 2,
							title: 'Star Chart',
							url: 'http://en.wikipedia.org/wiki/Star_chart'
						},
						{
							id: 3,
							title: 'Electrical Tape',
							url: 'http://en.wikipedia.org/wiki/Electrical_tape'
						}
					],
					create: false
				});
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
</div>
</section>
</div>