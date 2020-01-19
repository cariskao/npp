<div class="content-wrapper">
	<!-- <section class="content"> -->
	<section>
		<div class="functoin-on-top" style="margin-top:51.45px">
			<div class="row">
				<div class="col-xs-12">
					<div class="box" style="border-top:none;border-radius:0">
						<div class="box-header" style="border-bottom:2px solid #d2d6de;">
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group">
										<a class="btn btn-primary" href="<?php echo base_url('website/carouselAdds'); ?>"><i class="fa fa-plus"></i> 新增</a>
									</div>
								</div>
								<div class="col-xs-6">
									<div class="box-tools">
										<form action="<?php echo base_url('website/carouselLists') ?>" method="POST" id="searchList">
											<div class="input-group">
												<input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 250px;height:30px" placeholder="可搜尋標題" />
												<div class="input-group-btn">
													<button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
												</div>
											</div>
										</form>
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
				<div class="col-xs-12">
					<div class="box" style="border-top:none;">
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover title-center">
								<tr class="title-center">
									<th>圖片</th>
									<th>標題</th>
									<th>簡介</th>
									<th>連結</th>
									<th style="width:50px">狀態</th>
									<th class="text-center">可執行動作</th>
								</tr>
								<?php
								if (!empty($getCarouselList)) {
									foreach ($getCarouselList as $record) {
								?>
										<tr>
											<td><img style="width:200px;height:50px;" src="<?php echo base_url('assets/uploads/carousel_upload/' . $record->img); ?>"></td>
											<td><?php echo $record->title; ?></td>
											<td><?php echo mb_strimwidth(htmlspecialchars($record->introduction), 0, 100, '...') ?></td>
											<td><?php echo $record->link; ?></td>
											<td>
												<?php if ($record->showup == 1) { ?>
													<img style="background-color:green" src="<?php echo base_url('assets/images/show.png'); ?>" alt="">
												<?php } else { ?>
													<img style="background-color:red" src="<?php echo base_url('assets/images/hide.png'); ?>" alt="">
												<?php } ?>
											</td>
											<td class=" text-center" style="width:30%">
												<a class="btn btn-sm btn-info" href="<?php echo base_url('website/carouselEdit/' . $record->id); ?>" title="編輯"><i class="fa fa-pencil"></i></a>
												<a class="btn btn-sm btn-danger deleteCarousel" href="javascript:;" data-carouselid="<?php echo $record->id; ?>" data-img="<?php echo $record->img; ?>" title="刪除"><i class="fa fa-trash fa-lg"></i></a>
											</td>
										</tr>
									<?php
									}
								} else {
									?>
									<div style="text-align:center;color:red;font-size:30px;font-weight:bolder">
										無相關資料!
									</div>
								<?php } ?>
							</table>
						</div><!-- /.box-body -->
						<div class="box-footer clearfix">
							<?php echo $this->pagination->create_links(); ?>
						</div>
					</div><!-- /.box -->
				</div>
			</div>
		</div>
	</section>
</div>
<style>
	.title-center,
	.title-center th {
		text-align: center;
	}

	.alert-absoulte {
		width: 150px;
		text-align: center;
		position: absolute;
		margin: auto;
		left: 230px;
		right: 0;
		top: 51.45px;
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
<script>
	$(function() {
		setTimeout(function() {
			$("#alert-success").hide();
		}, 3000);
	})

	// 分頁
	jQuery(document).ready(function() {
		jQuery('ul.pagination li a').click(function(e) {
			// 當點擊下方頁面時,就獲取以下資料並跳轉
			e.preventDefault();
			var link = jQuery(this).get(0).href; // http://localhost/npp_ci/news/index/10
			// var test = link.lastIndexOf('/'); //最後一個「/」的位置
			// alert('test: ' + test);
			var value = link.substring(link.lastIndexOf('/') + 1);
			// alert('link: ' + link);
			// alert('value: ' + value);
			jQuery("#searchList").attr("action", baseURL + "website/carouselLists/" + value); //注意這裡要加上index
			// jQuery("#searchList").attr("action", baseURL + "news/" + 10);
			jQuery("#searchList").submit();
		});
	});
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
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