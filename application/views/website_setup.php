<?php
$mail = $getSetupInfo->mail;
$fb = $getSetupInfo->fb;
$address = $getSetupInfo->address;
$num = $getSetupInfo->num;
$fax = $getSetupInfo->fax;
$servicetime = $getSetupInfo->servicetime;
?>
<!-- <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script> -->
<!-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>網站管理 - 其它設定</h1>
	</section>

	<section class="content">
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->

				<div class="box box-primary">
					<div class="box-header">
						<!-- <h3 class="box-title">編輯委員資料</h3> -->
					</div><!-- /.box-header -->
					<!-- form start -->

					<!--  enctype="multipart/form-data"記得加 -->
					<form role="form" action="<?php echo base_url('website/setupSend') ?>" method="post" id="legislatorEditPage" role="form" enctype="multipart/form-data">
						<div class="box-body">
							<div class="row">
								<!-- <?php echo form_error('name'); ?> -->
								<div class="col-md-6 contact">
									<div class="bg-color">
										<p>頁首設定</p>
										<div class="form-group">
											<label for="mail">Email</label>
											<input type="text" class="form-control" id="mail" name="mail" value="<?php echo $mail; ?>">
											<label for="fb">臉書</label>
											<input type="text" class="form-control" id="fb" name="fb" value="<?php echo $fb; ?>">
										</div>
									</div>
								</div>
								<div class="col-md-6 contact">
									<div class="bg-color">
										<p>頁尾設定</p>
										<div class="form-group">
											<label for="address">地址</label>
											<input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>">
											<label for="num">電話</label>
											<input type="text" class="form-control" id="num" name="num" value="<?php echo $num; ?>">
											<label for="fax">傳真</label>
											<input type="text" class="form-control" id="fax" name="fax" value="<?php echo $fax; ?>">
											<label for="cell_phone">服務時間</label>
											<input type="text" class="form-control" id="servicetime" name="servicetime" value="<?php echo $servicetime; ?>">
										</div>
									</div>
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
				})
			</script>
			<?php
			$this->load->helper('form');
			$check = $this->session->flashdata('check');
			$success = $this->session->flashdata('success');
			// echo $success; //存儲成功!
			if ($success && $check == '驗證成功') {
			?>
				<div id="alert-success" class="alert-absoulte alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<?php echo $this->session->flashdata('success'); ?>
				</div>
			<?php } ?>

			<style>
				.seat input {
					width: 100px;
					margin: 0 40px;
				}

				.box-body .row>div {
					margin-bottom: 40px;
				}

				.bg-color {
					border: 1px solid #D2D6DE;
					padding: 20px 10px 10px 10px;
					overflow: hidden;
				}

				.bg-color>p {
					font-weight: bold;
					font-size: 20px;
					color: #3C8DBC;
					background-color: white;
					position: absolute;
					top: -16px;
				}

				.contact div input {
					margin-bottom: 15px;
				}

				.alert-absoulte {
					width: 150px;
					text-align: center;
					position: absolute;
					margin: auto;
					left: 230px;
					/* left: 0px; */
					right: 0;
					top: 51.5px;
				}
			</style>
			<!-- <?php echo validation_errors('<div id="alert-error" class="alert-absoulte alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?> -->
		</div>
	</section>
</div>