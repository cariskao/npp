<!-- <link href="<?php echo base_url(); ?>assets/plugins/bootstrap3-editable-1.5.1/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" type="text/css" /> -->
<!-- <script src="<?php echo base_url(); ?>assets/plugins/bootstrap3-editable-1.5.1/bootstrap3-editable/js/bootstrap-editable.js"></script> -->

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<i class="fa fa-user"></i> 屆期管理
			<small>新增, 編輯, 移除</small>
		</h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12 text-right">
				<div class="form-group">
					<a class="btn btn-primary" href="<?php echo base_url(); ?>legislator/addYearPage"><i class="fa fa-plus"></i> 新增屆期</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title"></h3>
						<div class="box-tools">
							<form action="<?php echo base_url() ?>legislator" method="POST" id="searchList">
								<div class="input-group">
									<input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 250px;height:30px" placeholder="可搜尋屆期名稱" />
									<div class="input-group-btn">
										<button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
									</div>
								</div>
							</form>
						</div>
					</div><!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
						<table class="table table-hover title-center">
							<tr class="title-center">
								<th>屆期名稱 </th>
								<!-- <th>屆期名稱 <i data-toggle="tooltip" data-placement="top" class="fa fa-info-circle" style="cursor:pointer" title="點擊下方名稱可編輯"></th> -->

								<!-- <th>建立日期</th> -->
								<th class="text-center">可執行動作</th>
							</tr>
							<?php
							if (!empty($legislatorYears)) {
								foreach ($legislatorYears as $record) {
									?>
							<tr>
								<td><?php echo $record->title; ?></td>
								<!-- <td><a data-pk="<?php echo $record->yearid; ?>" style="text-decoration: none;" class="title-name" href="" title="點我編輯名稱"><?php echo $record->title ?></a></td> -->
								<!-- <td><?php echo $record->date ?></td> -->
								<td class=" text-center" style="width:30%">
									<a style="width:32px" class="btn btn-sm btn-warning" href="<?php echo base_url() . 'legislator/legislatorListPage/' . $record->yearid; ?>" title="前往立委列表"><i class="fa fa-arrow-right fa-lg"></i></a>
									<a class="btn btn-sm btn-danger deleteLegislatorYear" href="#" data-yearid="<?php echo $record->yearid; ?>" data-title="<?php echo $record->title; ?>" title="移除該屆期全部立委相關資料 含大頭照"><i class="fa fa-trash fa-lg"></i></a>
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
<style>
	.fa.fa-info-circle:hover {
		color: red;
	}

	.title-center,
	.title-center th {
		text-align: center;
	}

	.editable-click,
	a.editable-click,
	a.editable-click:hover {
		text-decoration: none;
		color: black;
		border-bottom: none;
	}
</style>
<script>
	$(function() {
		$('[data-toggle="tooltip"]').tooltip()
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
			jQuery("#searchList").attr("action", baseURL + "legislator/index/" + value); //注意這裡要加上index
			// jQuery("#searchList").attr("action", baseURL + "news/" + 10);
			jQuery("#searchList").submit();
		});
	});
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<!-- 行內編輯跟分頁 -->
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/editable-inline.js" charset="utf-8"></script> -->