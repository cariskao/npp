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
			<div class="home-title_style" style="margin-top:30px;margin-bottom:0"><?php echo $breadcrumbTag; ?></div>
			<form action="<?php echo base_url('news_f/newsFlists/' . $type_id) ?>" method="POST" id="searchList"
				class="searchList-f_form">
				<!-- autocomplete自動完成 -->
				<input autocomplete="off" style="height:50px" type="text" name="searchFrom" value="<?php echo $searchFrom; ?>"
					class="searchList-f_from" style="width: 250px;height:30px"
					placeholder="開始時間" />
				<input autocomplete="off" style="height:50px" type="text" name="searchEnd" value="<?php echo $searchEnd; ?>"
					class="searchList-f_end" style="width: 250px;height:30px"
					placeholder="結束時間" />
				<input autocomplete="off" style="height:50px" type="text" name="searchText" value="<?php echo $searchText; ?>"
					class="searchList-f_keyword" style="width: 250px;height:30px"
					placeholder="關鍵字" />
				<button class="btn btn-default searchList searchList-f_submit">搜尋</button>
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
			<?php echo $this->pagination->create_links(); ?>
		</div>
	</div>
</div>
<div id="gotop">^</div>
<script type="text/javascript">
	jQuery(document).ready(function () {
		// RWD來更改分頁文本
		var w = $(window).width();
		// console.log(w); //獲取刷新後的值
		if (w < 992) {
			$('.first-page a').text('<<');
			$('.last-page a').text('>>');
			$('.prev-page a').text('<');
			$('.next-page a').text('>');
		}
		$(window).resize(function () {
			var rw = $(window).width();
			// console.log(rw); //獲取解析度變動後的值
			if (rw < 992) {
				$('.first-page a').text('<<');
				$('.last-page a').text('>>');
				$('.prev-page a').text('<');
				$('.next-page a').text('>');
			} else {
				$('.first-page a').text('最新文章');
				$('.last-page a').text('最舊文章');
				$('.prev-page a').text('前一頁');
				$('.next-page a').text('下一頁');
			}
		});

		// pagination
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