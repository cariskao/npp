<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<i class="fa fa-users"></i> 新增黨員列表
			<small>新增, 編輯, 移除</small>
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-xs-12 text-right">
				<div class="form-group">
					<a class="btn btn-warning" href="<?php echo base_url(); ?>partymember">返回</a>
				</div>
			</div>
		</div>
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">新增黨員資料</h3>
					</div><!-- /.box-header -->

					<!-- form start -->
					<form role="form" action="<?php echo base_url() ?>partymember/addPartyMemberSend" method="post" id="addPartyMemberSend" role="form" enctype="multipart/form-data">
						<div class="box-body">
							<div class="row">
								<div class="col-md-2">
									<div class="form-group">
										<label for="img">新增大頭照</label>
										<input id="img" type="file" name="file" size="20" />
										<?php echo form_error('file'); ?>
									</div>
									<div class="form-group">
										<label for="name">姓名</label>
										<input type="text" class="form-control" id="name" name="name" value="">
										<?php echo form_error('name'); ?>
									</div>
								</div>
								<div class="col-md-3 contact">
									<div class="bg-color">
										<p>聯絡方式</p>
										<div class="form-group">
											<label for="cell_phone">手機</label>
											<input type="text" class="form-control" id="cell_phone" name="cell_phone" value="">
											<label for="office_phone">辦公室電話</label>
											<input type="text" class="form-control" id="office_phone" name="office_phone" value="">
											<label for="address">辦公室地址</label>
											<input type="text" class="form-control" id="address" name="address" value="">
											<label for="fax">傳真</label>
											<input type="text" class="form-control" id="fax" name="fax" value="">
											<label for="mail">Email</label>
											<input type="text" class="form-control" id="mail" name="mail" value="">
										</div>
									</div>
								</div>
								<div class="col-md-7 contact">
									<div class="bg-color">
										<p>社群媒體</p>
										<div class="form-group">
											<label for="fb">臉書</label>
											<input type="text" class="form-control" id="fb" name="fb" value="">
											<label for="line">Line</label>
											<input type="text" class="form-control" id="line" name="line" value="">
											<label for="youtube">Youtube</label>
											<input type="text" class="form-control" id="youtube" name="youtube" value="">
											<label for="ig">IG</label>
											<input type="text" class="form-control" id="ig" name="ig" value="">
											<label for="web">個人網站</label>
											<input type="text" class="form-control" id="web" name="web" value="">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 contact">
									<div class="bg-color">
										<p>基本資料</p>
										<div class="col-md-4">
											<div class="form-group">
												<label for="education">學歷</label>
												<textarea style="resize: none;width:100%;height:200px" name="education" id="education"></textarea>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="experience">經驗</label>
												<textarea style="resize: none;width:100%;height:200px" name="experience" id="experience"></textarea>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="committee">各會期委員會</label>
												<textarea style="resize: none;width:100%;height:200px" name="committee" id="committee"></textarea>
											</div>
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
		<?php } ?>
		<?php
		$success = $this->session->flashdata('success');
		$check = $this->session->flashdata('check');
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

			.alert-absoulte {
				width: 250px;
				text-align: center;
				position: absolute;
				margin: auto;
				/* left: 230px; */
				left: 0px;
				right: 0;
				top: 75px;
			}

			/* @media screen and (max-width: 768px) {
						.alert-absoulte {
								left: 0;
						}
					} */
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

			.box-body .row>div {
				margin-bottom: 40px;
			}

			.contact div input {
				margin-bottom: 15px;
			}
		</style>
		<!-- <?php echo validation_errors('<div id="alert-error" class="alert-absoulte alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?> -->
</div>
</section>
</div>
<!-- <script src="<?php echo base_url(); ?>assets/js/addLegislatorPage.js" type="text/javascript"></script> -->