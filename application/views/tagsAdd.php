<div class="content-wrapper">
	<section>
		<div class="functoin-on-top" style="margin-top:51.45px;">
			<div class="row">
				<div class="col-xs-12">
					<div class="box" style="border-top:none;border-radius:0">
						<div class="box-header" style="border-bottom:2px solid #d2d6de;">
							<div class="row">
								<div class="col-xs-12">
									<div class="form-group">
										<a class="btn btn-warning" href="<?php echo base_url('news/tagLists'); ?>">返回</a>
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
					<div class="box box-primary" style="border-top:3px solid #d2d6de">
						<!-- form start -->
						<form role="form" action="<?php echo base_url() ?>news/tagsAddSend" method="post" id="addYearSend"
							role="form">
							<div class="box-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="title">標籤名稱</label>
											<input type="text" class="form-control" id="title" name="title" value="">
											<?php echo form_error('title'); ?>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">顯示狀態</label>
											<div class="input-group">
												<div id="radioBtn" class="btn-group">
													<a class="btn btn-primary btn-sm active" data-toggle="happy"
														data-title="Y">顯示</a>
													<a class="btn btn-primary btn-sm notActive" data-toggle="happy"
														data-title="N">隱藏</a>
												</div>
												<input type="hidden" name="happy" id="happy">
											</div>
										</div>
									</div>
								</div>
							</div><!-- /.box-body -->
							<input type="submit" class="btn btn-success submit-pos" value="儲存" />
						</form>
					</div>
				</div>
				<!-- <div class="col-md-12"> -->
			</div>

			<script language='javascript' type='text/javascript'>
				$(function () {
					setTimeout(function () {
						$("#alert-success").hide();
					}, 3000);
				})

				// 顯示狀態
				$('#radioBtn a').on('click', function () {
					var sel = $(this).data('title');
					var tog = $(this).data('toggle');
					console.log('sel', sel);
					console.log('tog', tog);
					$('#' + tog).prop('value', sel); //將該被點擊的data-title值寫入到id="happy"的value中。

					// 當點擊爲Y,就把不爲Y的元素移除active並加上notActive
					$('a[data-toggle="' + tog + '"]').not('[data-title="' + sel + '"]').removeClass('active')
						.addClass('notActive');
					// 當點擊爲Y,就把爲Y的元素移除notActive並加上active
					$('a[data-toggle="' + tog + '"][data-title="' + sel + '"]').removeClass('notActive')
						.addClass('active');
				})
			</script>
			<?php
$this->load->helper('form');
$error = $this->session->flashdata('error');
if ($error) {
    ?>
			<div id="alert-error" class="alert-absoulte alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<?php echo $this->session->flashdata('error'); ?>
			</div>
			<?php }?>
			<?php
$success = $this->session->flashdata('success');
if ($success) {
    ?>
			<div id="alert-success" class="alert-absoulte alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<?php echo $this->session->flashdata('success'); ?>
			</div>
			<?php }?>

			<style>
				#radioBtn .notActive {
					color: #3276b1;
					background-color: #fff;
				}

				.alert-absoulte {
					width: 150px;
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

				.add-fixed-top-css {
					margin-top: 104px;
				}
			</style>
			<!-- <?php echo validation_errors('<div id="alert-error" class="alert-absoulte alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?> -->
		</div>
	</section>
</div>