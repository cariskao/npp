<?php
$userId = $userInfo->userId;
$name = $userInfo->name;
$email = $userInfo->email;
$mobile = $userInfo->mobile;
$roleId = $userInfo->roleId;
?>

<div class="content-wrapper">
	<section>
		<div class="row">
			<!-- left column -->
			<div class="col-md-8">
				<!-- general form elements -->
				<div class="box box-primary" style="border:none">
					<div class="box-header">
						<h3 class="box-title">編輯人員資料</h3>
					</div><!-- /.box-header -->
					<!-- form start -->
					<form role="form" action="<?php echo base_url() ?>editUser" method="post" id="editUser" role="form">
						<div class="box-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="fname">名稱</label>
										<input type="text" class="form-control" id="fname" name="fname" value="<?php echo $name; ?>" maxlength="128">
										<input type="hidden" value="<?php echo $userId; ?>" name="userId" id="userId" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="email">Email</label>
										<input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" maxlength="128">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="password">密碼</label>
										<input type="password" class="form-control" id="password" name="password" maxlength="20">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="cpassword">密碼確認</label>
										<input type="password" class="form-control" id="cpassword" name="cpassword" maxlength="20">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="mobile">手機號碼</label>
										<input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $mobile; ?>" maxlength="10">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="role">層級</label>
										<select class="form-control" id="role" name="role">
											<option value="0">未選擇</option>
											<?php
											if (!empty($roles)) {
												foreach ($roles as $rl) {
											?>
													<option value="<?php echo $rl->roleId; ?>" <?php if ($rl->roleId == $roleId) {
																													echo "selected=selected";
																												} ?>><?php echo $rl->role ?>
													</option>
											<?php
												}
											}
											?>
										</select>
									</div>
								</div>
							</div>
						</div><!-- /.box-body -->
						<div class="box-footer">
							<input type="submit" class="btn btn-primary" value="送出" />
							<input type="reset" class="btn btn-default" value="重置" />
							<a class="btn btn-warning" href="<?php echo base_url(); ?>user/userListing">返回</a>
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-4">
				<?php
				$this->load->helper('form');
				$error = $this->session->flashdata('error');
				if ($error) {
				?>
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<?php echo $this->session->flashdata('error'); ?>
					</div>
				<?php } ?>
				<?php
				$success = $this->session->flashdata('success');
				if ($success) {
				?>
					<div id="alert-success" class="alert-absoulte alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<?php echo $this->session->flashdata('success'); ?>
					</div>
				<?php } ?>

				<div class="row">
					<div class="col-md-12">
						<?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<style>
	.alert-absoulte {
		text-align: center;
		position: absolute;
		margin: auto;
		left: 0;
		top: 0;
		z-index: 3;
	}

	@media screen and (max-width: 768px) {
		.alert-absoulte {
			left: 0;
		}
	}
</style>
<script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>
<script>
	setTimeout(function() {
		$("#alert-success").hide();
	}, 3000);

	$(".navbar").removeClass("navbar-fixed-top");
	$(".navbar").addClass("navbar-static-top");
</script>