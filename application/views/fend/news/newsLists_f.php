<div class="breadcrumb-bg">
	<div class="container">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li style="" class="breadcrumb-item"><a href="<?php echo base_url('fend/home'); ?>">首頁</a></li>
				<li style="" class="breadcrumb-item"><a href="<?php echo base_url('fend/news_f'); ?>">新聞訊息</a></li>
				<li class="breadcrumb-item active" aria-current="page"><?php echo $breadcrumbTag; ?></li>
			</ol>
		</nav>
	</div>
</div>
<div class="container custom-gutters" style="margin-bottom:20px">
	<div class="row">
		<div class="col-md-12">
			<div class="home-title_style" style="margin-top:30px"><?php echo $breadcrumbTag; ?></div>
			<form action="<?php echo base_url('news/lists/' . $type_id) ?>" method="POST" id="searchList">
				<div class="input-group">
					<input type="text" name="searchText" value="<?php echo $searchText; ?>"
						class="form-control input-sm pull-right" style="width: 250px;height:30px" placeholder="可搜尋大標、次標" />
					<div class="input-group-btn">
						<button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
					</div>
				</div>
			</form>
			<div class="row" style="border-bottom:solid 1px gray;margin-bottom:50px;padding-bottom:50px">
				<?php
if (!empty($listItems)) {
    foreach ($listItems as $record) {
        $type_id = $record->pr_type_id;
        $img     = $record->img;
        $m_title = $record->main_title;
        $date    = $record->date_start;
        $e       = $record->editor;
        ?>
				<div class="col-lg-4 col-md-6">
					<a href="#" class="newsBlock_style">
						<div class="card mb-4 box-shadow">
							<img class="card-img-top"
								src="<?php echo base_url('assets/uploads/news_upload/' . $type_id . '/' . $img); ?>"
								alt="Card image cap">
							<div class="card-body">
								<h5><?php echo mb_strimwidth(strip_tags($m_title), 0, 40, '...'); ?></h5>
								<span class="data-start_fontsize">發布日期：<?php echo $date; ?></span>
								<p><?php echo mb_strimwidth(strip_tags($e), 0, 100, '...'); ?></p>
							</div>
						</div>
					</a>
				</div>
				<?php
}
}
?>
			</div>
			<div class="box-footer clearfix">
				<?php echo $this->pagination->create_links(); ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function () {
		jQuery('ul.pagination li a').click(function (e) {
			// 當點擊下方頁面時,就獲取以下資料並跳轉
			e.preventDefault();
			var link = jQuery(this).get(0).href;
			var value = link.substring(link.lastIndexOf('/') + 1);
			var url = link.substr(link.lastIndexOf('/', link.lastIndexOf('/') - 1) + 1);
			var site = url.lastIndexOf("\/");
			var type_id = url.substring(0, site);

			console.log('link: ' + link);
			console.log('value: ' + value);
			console.log('url: ' + url);
			console.log('site: ' + site);
			console.log('type_id: ' + type_id);

			jQuery("#searchList").attr("action", baseURL + "fend/news_f/newsFlists/" + type_id + '/' + value);
			jQuery("#searchList").submit();
		});
	});
</script>