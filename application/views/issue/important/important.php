<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<i class="fa fa-globe"></i> 議題管理
			<small>新增, 編輯, 移除</small>
		</h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12 text-right">
				<div class="form-group">
					<a class="btn btn-primary" href="<?php echo base_url(); ?>issue/addLegislatorPage"><i class="fa fa-plus"></i> 新增議題</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title"></h3>
						<div class="box-tools">
							<form action="<?php echo base_url() ?>issue" method="POST" id="searchList">
								<div class="input-group">
									<input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 200px;height:30px" placeholder="可搜尋姓名" />
									<div class="input-group-btn">
										<button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
									</div>
								</div>
							</form>
						</div>
					</div><!-- /.box-header -->
					<style>
						.title-center,
						.title-center th {
							text-align: center;
						}
					</style>
					<div class="box-body table-responsive no-padding">
						<table class="table table-hover title-center">
							<tr class="title-center">
								<th>議題名稱</th>
								<th>建立日期</th>
								<th class="text-center">可執行動作</th>
							</tr>
							<?php
							if (!empty($issueRecords)) {
								foreach ($issueRecords as $record) {
									?>
									<tr>
										<td><?php echo $record->name ?></td>
										<td><?php echo date("Y-m-d", strtotime($record->date)) ?></td>
										<td class=" text-center">
											<a class="btn btn-sm btn-info" href="<?php echo base_url() . 'legislator/legislatorEditPage/' . $record->issueid; ?>" title="編輯"><i class="fa fa-pencil"></i></a>
											<a class="btn btn-sm btn-danger deleteLegislator" href="#" data-issueid="<?php echo $record->issueid; ?>" title="移除"><i class="fa fa-trash"></i></a>
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
	</section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
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
			jQuery("#searchList").attr("action", baseURL + "legislator/index/" + value); //注意這裡要加上index
			// jQuery("#searchList").attr("action", baseURL + "news/" + 10);
			jQuery("#searchList").submit();
		});
	});
</script>