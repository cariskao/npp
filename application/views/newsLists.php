<div class="content-wrapper">
	<section class="content-header">
		<?php if ($type_id == 1) : ?>
			<h1>新聞訊息 - 法案及議事說明列表</h1>
		<?php elseif ($type_id == 2) : ?>
			<h1>新聞訊息 - 懶人包及議題追追追列表</h1>
		<?php elseif ($type_id == 3) : ?>
			<h1>新聞訊息 - 行動紀實列表</h1>
		<?php endif; ?>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12 text-right">
				<div class="form-group">
					<a class="btn btn-primary" href="<?php echo base_url('news/adds/' . $type_id); ?>"><i class="fa fa-plus"></i> 新增</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title"></h3>
						<div class="box-tools">
							<form action="<?php echo base_url('news/lists/' . $type_id); ?>" method="POST" id="searchList">
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
								<th style="width:50px" class="text-center">大圖</th>
								<th>大標 & 次標</th>
								<th style=" width:120px" class="text-center">建立日期時間</th>
								<th>內文</th>
								<th style="width:150px">標籤</th>
								<th style="width:50px" class="text-center">狀態</th>
								<th style="width:100px" class="text-center">可執行動作</th>
							</tr>
							<?php
							if (!empty($listItems)) {
								foreach ($listItems as $record) {
							?>
									<tr>
										<td><img style="width:50px;height:50px;" src="<?php echo base_url('assets/uploads/news_upload/' . $record->pr_type_id . '/' . $record->img); ?>"></td>
										<td><?php echo '<b>' . $record->main_title . '</b>' . '<br>' . $record->sub_title; ?></td>
										<td class="text-center"><?php echo $record->date_start . '<br>' . $record->time_start ?></td>
										<td><?php echo mb_strimwidth(htmlspecialchars($record->editor), 0, 100, '...') ?></td>
										<td>
											<?php if (!empty($getTagsChoice)) : ?>
												<?php foreach ($getTagsChoice as $choice) : ?>
													<?php if ($record->pr_id == $choice->pr_id) : ?>
														<p><?= $choice->name; ?></p>
													<?php endif; ?>
												<?php endforeach; ?>
											<?php endif; ?>
										</td>
										<td class="text-center">
											<?php if ($record->showup == 1) { ?>
												<img style="background-color:green" src="<?php echo base_url('assets/images/show.png'); ?>" alt="">
											<?php } else { ?>
												<img style="background-color:red" src="<?php echo base_url('assets/images/hide.png'); ?>" alt="">
											<?php } ?>
										</td>
										<td class="text-center">
											<a class="btn btn-sm btn-info" href="<?php echo base_url('news/newsEdit/' . $record->pr_id); ?>" title="編輯"><i class="fa fa-pencil"></i></a>
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
<script type="text/javascript" src="<?php echo base_url('assets/js/common.js'); ?>" charset="utf-8"></script>
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('ul.pagination li a').click(function(e) {
			// 當點擊下方頁面時,就獲取以下資料並跳轉
			e.preventDefault();
			var link = jQuery(this).get(0).href; // http://localhost/npp/news/lists/1/10
			// substring(start,end)表示從start到end之間的字串，包括start位置的字元但是不包括end位置的字元。
			var value = link.substring(link.lastIndexOf('/') + 1); // 10
			//如果不写下面url这一行 将会取最后一个/前所有值
			var url = link.substr(link.lastIndexOf('/', link.lastIndexOf('/') - 1) + 1); // 1/10
			// var test = link.lastIndexOf('/'); //最後一個「/」的位置,33
			var site = url.lastIndexOf("\/"); //获取最后一个/的位置,1
			var type_id = url.substring(0, site); //截取最后一个/前的值,1

			/**
			 * 獲取最後一個「/」前面的值
			 * http://www.w3school.com.cn/jsref/jsref_lastIndexOf.asp
			 * lastIndexOf第二個參數:它的合法取值是 0 到 stringObject.length - 1。如省略该参数，则将从字符串的最后一个字符处开始检索。
			 * substr(start,length)表示從start位置開始，擷取length長度的字串。
			 * substring(start,end)表示從start到end之間的字串，包括start位置的字元但是不包括end位置的字元。
			 *
			 * 這行說明:
			 * 第二個lastIndexOf因爲沒有第二個參數(看上方說明),所以直接從最後面開始找「/」,找到後再將位置-1就變成那段字串的length,也就是最後一個字。
			 * 第一個lastIndexOf的第二個參數就是第二個lastIndexOf的結果-1,也代表第一個lastIndexOf會從倒數第二段字串的最後一個字元開始往回查詢,這樣就會避開了最後一個「/」,而搜索到倒數第二個「/」再+1獲取倒數第二個「/」後的全部字串。
			 */
			// alert('link: ' + link);
			// alert('value: ' + value);
			// alert('url: ' + url);
			// alert('test: ' + test);
			// alert('site: ' + site);
			// alert('type_id: ' + type_id);

			// attr,更改form中的action連結
			jQuery("#searchList").attr("action", baseURL + "news/lists/" + type_id + '/' + value); //注意如果controller使用index的話,這裡就要加上index
			// jQuery("#searchList").attr("action", baseURL + "news/" + 10);
			jQuery("#searchList").submit();
		});
	});
</script>