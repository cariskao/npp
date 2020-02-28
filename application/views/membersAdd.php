<script src="<?php echo base_url('assets/plugins/clockpicker/js/bootstrap-clockpicker.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/selectizejs/dist/js/standalone/selectize.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/selectizejs/js/index.js'); ?>"></script>
<div class="content-wrapper">
	<section>
		<div class="functoin-on-top">
			<div class="row">
				<div class="col-xs-12">
					<div class="box" style="border-top:none;border-radius:0">
						<div class="box-header">
							<div class="row">
								<div class="col-xs-12">
									<div class="form-group">
										<a class="btn btn-warning" href="<?php echo base_url('members/membersList/'); ?>">返回</a>
									</div>
								</div>
							</div>
						</div><!-- /.box-header -->
					</div>
				</div>
			</div>
		</div>
		<div class="div-h"></div>
		<div style="border-top:none">
			<div class="row">
				<!-- left column -->
				<div class="col-md-12">
					<!-- general form elements -->

					<div class="box box-primary" style="border:none;">
						<!-- form start -->
						<!--  enctype="multipart/form-data"記得加 -->
						<form role="form" action="<?php echo base_url('members/membersAddSend/'); ?>" method="post" id=""
							role="form" enctype="multipart/form-data">
							<div class="box-body">
								<div class="row">
									<div class="col-md-6">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th colspan="2" scope="col">基本資料</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th scope="row">
														<span class="must">*</span>新增照片
													</th>
													<!-- <td colspan="2"></td> -->
													<td>
														<div class="form-group">
															<input type="file" name="file" />
															<?php echo form_error('file'); ?>
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">
														<span class="must">*</span>姓名
													</th>
													<td>
														<div class="form-group">
															<input type="text" class="form-control" id="name" name="name" value="">
															<?php echo form_error('name'); ?>
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">
														<span class="must">*</span>英文姓名
													</th>
													<td>
														<div class="form-group">
															<input type="text" class="form-control" id="name_en" name="name_en"
																value="">
															<?php echo form_error('name_en'); ?>
														</div>

													</td>
												</tr>
												<tr>
													<th scope="row">
														<span class="must">*</span>屆期
													</th>
													<td>
														<div class="form-group">
															<!-- name記得加上[],才能以陣列形式回傳 -->
															<select id="select-years" name="years[]" placeholder="請選擇屆期">
																<option value="">請選擇屆期</option>
																<?php
if (!empty($getYearsList)) {
    foreach ($getYearsList as $items) {
        ?>
																<option value="<?php echo $items->yid; ?>">
																	<?php echo $items->title; ?>
																</option>
																<?php
}
}
?>
															</select>
															<?php echo form_error('years'); ?>
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">
														關注議題
													</th>
													<td class="">
														<div class="form-group">
															<!-- name記得加上[],才能以陣列形式回傳 -->
															<select id="select-issues" name="issues[]" placeholder="請選擇議題">
																<option value="">請選擇議題</option>
																<?php
if (!empty($getIssuesList)) {
    foreach ($getIssuesList as $items) {
        ?>
																<option value="<?php echo $items->issue_id; ?>">
																	<?php echo $items->name; ?>
																</option>
																<?php
}
}
?>
															</select>
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">
														狀態
													</th>
													<td>
														<div class="input-group">
															<div id="radioBtn" class="btn-group">
																<a class="btn btn-primary btn-sm active" data-toggle="happy"
																	data-title="Y">顯示</a>
																<a class="btn btn-primary btn-sm notActive" data-toggle="happy"
																	data-title="N">隱藏</a>
															</div>
															<input type="hidden" name="happy" id="happy">
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="col-md-6">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th colspan="4" scope="col">學經歷</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<!-- <th>才會自帶粗體 -->
													<th class="text-center" scope="row">學歷</th>
													<th class="text-center" scope="row">經歷</th>
													<th class="text-center" scope="row">分區/不分區</th>
													<th class="text-center" scope="row">各會期委員會</th>
												</tr>
												<tr>
													<td><textarea class="form-control" name="education" id="education"
															style="width:100%" rows="10"></textarea></td>
													<td><textarea class="form-control" name="experience" id="experience"
															style="width:100%" rows="10"></textarea></td>
													<td><textarea class="form-control" name="districts" id="districts"
															style="width:100%" rows="10"></textarea></td>
													<td><textarea class="form-control" name="committee" id="committee"
															style="width:100%" rows="10"></textarea></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<table class="table table-bordered" id="contact-table">
											<thead>
												<tr>
													<th colspan="3" scope="col">聯絡方式</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<!-- <th>才會自帶粗體 -->
													<th class="text-center" style="width:170px;" scope="row">項目<input type="button"
															class="btn btn-sm btn-info btnAdd" style="margin-left:10px" value="新增" />
													</th>
													<th class="text-center" colspan="2" scope="row">內容</th>
												</tr>
												<tr class="contact-item">
													<th scope="row">
														<div class="form-group">
															<select style="padding:0 0 0 10px" class="form-control"
																name="contactList[]">
																<?php
if (!empty($getContactList)) {
    foreach ($getContactList as $items) {
        ?>
																<option value="<?php echo $items->con_id; ?>"
																	<?php if ($items->con_id == 1) {echo 'selected';}?>>
																	<?php echo $items->list; ?>
																</option>
																<?php
}
}
?>
															</select>
														</div>
													</th>
													<td>
														<div class="form-group">
															<input type="text" class="form-control" name="contact[]" value="">
														</div>
													</td>
													<td style="width:50px">
														<div class="form-group">
															<input type="button" class="btn btn-danger btnRemove" value="移除" />
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="col-md-6">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th colspan="2" scope="col">社群連結</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th scope="row">
														Facebook
													</th>
													<td>
														<div class="form-group">
															<input type="text" class="form-control" id="fb" name="fb" value="">
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">
														Instagram
													</th>
													<td>
														<div class="form-group">
															<input type="text" class="form-control" id="ig" name="ig" value="">
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">
														Line
													</th>
													<td>
														<div class="form-group">
															<input type="text" class="form-control" id="line" name="line" value="">
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">
														Youtube
													</th>
													<td>
														<div class="form-group">
															<input type="text" class="form-control" id="yt" name="yt" value="">
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
					</div><!-- /.box-body -->
				</div>
				<input type="submit" class="btn btn-success submit-pos" value="儲存" />
				</form>
				<template class="temp">
					<tr class="contact-item">
						<th scope="row">
							<div class="form-group">
								<select style="padding:0 0 0 10px" class="form-control" name="contactList[]">
									<?php
if (!empty($getContactList)) {
    foreach ($getContactList as $items) {
        ?>
									<option value="<?php echo $items->con_id; ?>"
										<?php if ($items->con_id == 1) {echo 'selected';}?>>
										<?php echo $items->list; ?>
									</option>
									<?php
}
}
?>
								</select>
							</div>
						</th>
						<td>
							<div class="form-group">
								<input type="text" class="form-control" name="contact[]" value="">
							</div>
						</td>
						<td style="width:50px">
							<div class="form-group">
								<input type="button" class="btn btn-danger btnRemove" value="移除" />
							</div>
						</td>
					</tr>
				</template>
			</div>
			<!-- <div class="col-md-12"> -->
		</div>

		<script language='javascript' type='text/javascript'>
			$('#select-issues').selectize({
				maxItems: 5,
				plugins: ['remove_button'],
				sortField: { //排序
					field: 'id', // text:依據文本排序，id：依據value排序
					direction: 'asc' // 升序降序
				}
			});

			$('#select-years').selectize({
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
if ($check) {
    ?>
		<div id="alert-error" class="alert-absoulte error-width alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<?php echo $check . '!<br>請修正以下提示錯誤!'; ?>
		</div>
		<?php
unset($_SESSION['check']);
}
?>
		<?php
$success = $this->session->flashdata('success');
if ($success) {
    ?>
		<div id="alert-success" class="alert-absoulte success-width alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<?php echo $success; ?>
		</div>
		<?php
unset($_SESSION['success']);
}
?>
		<style>
		</style>
		<!-- <?php echo validation_errors('<div id="alert-error" class="alert-absoulte alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?> -->
</div>
</section>
</div>