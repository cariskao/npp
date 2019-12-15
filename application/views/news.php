<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<i class="fa fa-globe"></i> 最新新聞管理
			<small>新增, 編輯, 移除</small>
		</h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12 text-right">
				<div class="form-group">
					<a class="btn btn-primary" href="<?php echo base_url(); ?>news/addNew"><i class="fa fa-plus"></i> 新增</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title"></h3>
						<div class="box-tools">
							<form action="<?php echo base_url() ?>news" method="POST" id="searchList">
								<div class="input-group">
									<input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 250px;height:30px" placeholder="可搜尋大標、次標" />
									<div class="input-group-btn">
										<button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
									</div>
								</div>
							</form>
						</div>
					</div><!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
						<table class="table table-hover">
							<tr>
								<th>大圖</th>
								<th>大標</th>
								<th>次標</th>
								<th style="width:100px">建立日期</th>
								<th style="width:100px">更新日期</th>
								<th style="width:300px">內文</th>
								<th>標籤</th>
								<th class="text-center" style="width:100px">可執行動作</th>
							</tr>
							<?php
							if (!empty($newsRecords)) {
								foreach ($newsRecords as $record) {
									?>
									<tr>
										<td><img style="width:50px;height:50px;" src="<?php echo base_url('assets/uploads/news_upload/news/' . $record->img); ?>"></td>
										<td><?php echo $record->main_title ?></td>
										<td><?php echo $record->sub_title ?></td>
										<td><?php echo $record->date_start ?></td>
										<td><?php echo $record->date_update ?></td>
										<td><?php echo mb_strimwidth(htmlspecialchars($record->editor), 0, 100, '...') ?></td>
										<td></td>
										<td class="text-center">
											<a class="btn btn-sm btn-info" href="<?php echo base_url() . 'news/newsOld/' . $record->pr_id; ?>" title="編輯"><i class="fa fa-pencil"></i></a>
											<a class="btn btn-sm btn-danger newsListDel" href="#" data-delid="<?php echo $record->pr_id; ?>" data-typeid="1" data-img="<?php echo $record->img; ?>" title="移除"><i class="fa fa-trash"></i></a>
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
			jQuery("#searchList").attr("action", baseURL + "news/index/" + value); //注意這裡要加上index
			// jQuery("#searchList").attr("action", baseURL + "news/" + 10);
			jQuery("#searchList").submit();
		});
	});
</script>