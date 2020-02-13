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
						<button id="save" class="btn btn-success submit-pos">儲存</button>
						<div class="box-body">
							<div class="row">
								<div class="col-md-12">
									<div id="sortlist">
										<?php
if (!empty($getCarouselList)) {
    foreach ($getCarouselList as $record) {
        ?>
										<div class="ui-state-default" dbid="<?php echo $record->id; ?>">
											<?php echo $record->title; ?>
										</div>
										<?php
}
} else {
    ?>
										<div style="text-align:center;color:red;font-size:30px;font-weight:bolder">
											無相關資料!
										</div>
										<?php }?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- box -->
				</div>
				<!-- <div class="col-md-12"> -->

				<script language='javascript' type='text/javascript'>
					$(function () {
						// error message style
						setTimeout(function () {
							$("#alert-success").hide();
						}, 3000);
						setTimeout(function () {
							$("#alert-error").hide();
						}, 3000);

						// jquery UI sortable
						$("#save").click(function () {
							var _sort = new Array();
							var hitURL = baseURL + 'website/carouselSortSend';

							// 從上到下遍歷排序後的所有元素,並把dbid放入_sort中,之後就可將dbid當作 WHERE 條件更改sort順序
							$(".ui-state-default").each(function () {
								_sort.push($(this).attr('dbid'));
							});
							// console.log(_sort);

							$.ajax({
								type: "POST",
								url: hitURL,
								dataType: "text",
								data: {
									newSort: _sort
								},
								success: function (data) {
									// console.log('ok');
									// 這裏在controller用$this->carouselSorts()會吃不到成功訊息。
									window.location.href = baseURL + 'website/carouselSorts';
								},
								error: function (jqXHR) {
									console.log('發生錯誤: ', jqXHR.status);
								}
							})
						})

						$('.ui-state-default').mouseover(function () {
							$(this).css({
								'cursor': 'move',
								'opacity': .7,
							});
						});

						$('.ui-state-default').mouseout(function () {
							$(this).css({
								'opacity': 1,
							});
						});

						var $list = $('#sortlist');

						$list.sortable({
							opacity: 0.7,
							revert: true,
							cursor: 'move',

							start: function (event, ui) {},

							update: function (event, ui) {
								$('.ui-state-default').css({
									'opacity': 1,
								});
							},
						})
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

				<style>
					#sortlist {
						list-style: none;
						margin-top: 30px;
						padding: 0 30px;
					}

					.ui-state-default {
						background-color: #3c8dbc;
						color: white;
						font-weight: bolder;
						font-size: 18px;
						padding: 10px 20px;
					}

					.ui-state-default:hover {
						cursor: move;
						opacity: .7;
					}

					.box-body>div {
						margin-bottom: 15px;
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