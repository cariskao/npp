<div class="content-wrapper">
	<!-- <section class="content"> -->
	<section>
		<div class="functoin-on-top" style="margin-top:51.45px;width:100%">
			<div class="row">
				<div class="col-xs-12">
					<div class="box" style="border-top:none;border-radius:0">
						<div class="box-header" style="border-bottom:2px solid #d2d6de;">
							<div class="row">
								<div class="col-xs-12">
									<div class="form-group">
										<a class="btn btn-warning" href="<?php echo base_url('website/carouselLists'); ?>">返回</a>
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
						<form role="form" action="<?php echo base_url('website/carouselAddSend'); ?>" method="post" id="" role="form" enctype="multipart/form-data">
							<div class="box-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="img">選擇圖片</label>
											<input class="form-control" id="img" type="file" name="file" size="20" />
											<?php echo form_error('file'); ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="title">標題</label>
											<input type="text" class="form-control" id="title" name="title" value="">
											<?php echo form_error('title'); ?>
										</div>
									</div>
								</div>
								<div class="row">
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
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="introduction">簡介</label>
											<textarea class="form-control" name="introduction" id="introduction" cols="30" rows="5"></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="link">連結</label>
											<input type="text" class="form-control" id="link" name="link" value="">
											<?php echo form_error('link'); ?>
										</div>
									</div>
								</div>
							</div><!-- /.box-body -->
							<input type="submit" class="btn btn-success submit-pos" value="儲存" />
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
				// echo $success; //存儲成功!
				if ($success && $check == '驗證成功') {
				?>
					<div id="alert-success" class="alert-absoulte success-width alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<?php echo $this->session->flashdata('success'); ?>
					</div>
				<?php } ?>

				<style>
					.box-body>div {
						margin-bottom: 15px;
					}

					#radioBtn .notActive {
						color: #3276b1;
						background-color: #fff;
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
						top: 50px;
						z-index: 3;
					}

					@media screen and (max-width: 768px) {
						.alert-absoulte {
							left: 0;
						}
					}

					.add-fixed-top-css {
						margin-top: 107.45px;
					}

					@media (max-width: 767px) {
						.add-fixed-top-css {
							margin-top: 57.45px;
						}
					}
				</style>
				<!-- <?php echo validation_errors('<div id="alert-error" class="alert-absoulte alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?> -->
			</div>
			<!-- row -->
		</div>
		<!-- add-fixed-top-css -->
	</section>
</div>
<!-- content-wrapper -->