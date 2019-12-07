<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<i class="fa fa-users"></i> 黨員列表
			<small>新增, 編輯, 移除</small>
		</h1>
	</section>
	<section class="content">
		<div class="row">
			<!-- general form elements -->
			<div class="col-xs-12 text-right">
				<div class="form-group">
					<a class="btn btn-primary" href="<?php echo base_url(); ?>partymember/addPartyMember"><i class="fa fa-plus"></i> 新增黨員</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title"></h3>
						<div class="box-tools">
							<form action="<?php echo base_url() ?>partymember" method="POST" id="searchList">
								<div class="input-group">
									<input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 250px;height:30px" placeholder="可搜尋黨員姓名" />
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
								<th>大頭照</th>
								<th>姓名</th>
								<th>學歷</th>
								<th>經歷</th>
								<th>各會期委員會</th>
								<th>聯絡方式</th>
								<th>社群連結</th>
								<th class="text-center" style="width:100px">可執行動作</th>
							</tr>
							<?php
							if (!empty($partyMemberRecords)) {
								foreach ($partyMemberRecords as $record) {
									?>
									<tr>
										<td><img style="width:100px;height:100px" src="<?php echo base_url('assets/uploads/partymember_upload/' . $record->img); ?>"></td>
										<td>
											<pre style="background:transparent;border:transparent"><?php echo $record->name ?></pre>
										</td>
										<td>
											<pre style="background:transparent;border:transparent"><?php echo $record->education ?></pre>
										</td>
										<td>
											<pre style="background:transparent;border:transparent"><?php echo $record->experience ?></pre>
										</td>
										<td>
											<pre style="background:transparent;border:transparent"><?php echo $record->committee ?></pre>
										</td>
										<td>
											<?php
													if ($record->address !== '') {
														echo '<b>辦公室地址：</b>';
														echo $record->address . '<br>';
													}
													if ($record->mail !== '') {
														echo '<b>辦公室信箱：</b>';
														echo $record->mail . '<br>';
													}
													if ($record->office_phone !== '') {
														echo '<b>辦公室電話：</b>';
														echo $record->office_phone . '<br>';
													}
													if ($record->cell_phone !== '') {
														echo '<b>手機號碼：</b>';
														echo $record->cell_phone . '<br>';
													}
													if ($record->fax !== '') {
														echo '<b>辦公室傳真：</b>';
														echo $record->fax . '<br>';
													}
													?>
										</td>
										<td>
											<?php
													if ($record->fb !== '') {
														echo '<b>臉書：</b>';
														echo $record->fb . '<br>';
													}
													if ($record->ig !== '') {
														echo '<b>IG：</b>';
														echo $record->ig . '<br>';
													}
													if ($record->youtube !== '') {
														echo '<b>Youtube：</b>';
														echo $record->youtube . '<br>';
													}
													if ($record->web !== '') {
														echo '<b>個人網站：</b>';
														echo $record->web . '<br>';
													}
													?>
										</td>
										<td class=" text-center">
											<a class="btn btn-sm btn-info" href="<?php echo base_url() . 'partymember/editPartyMemberPage/'  . $record->memid; ?>" title="編輯"><i class="fa fa-pencil"></i></a>
											<a class="btn btn-sm btn-danger deletePartyMember" href="#" data-memid="<?php echo $record->memid; ?>" title="移除"><i class="fa fa-trash"></i></a>
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
	.seat input {
		width: 100px;
		margin: 0 40px;
	}

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
		top: 80px;
	}

	@media screen and (max-width: 768px) {
		.alert-absoulte {
			left: 0;
		}
	}
</style>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
	$(function() {
		setTimeout(function() {
			$("#alert-success").hide();
		}, 3000);
	})

	jQuery(document).ready(function() {
		jQuery('ul.pagination li a').click(function(e) {
			// 當點擊下方頁面時,就獲取以下資料並跳轉
			e.preventDefault();
			var link = jQuery(this).get(0).href;
			// alert('link: ' + link); //http://localhost/npp_ci/legislator/legislatorListPage/19/10

			// substring(start,end)表示從start到end之間的字串，包括start位置的字元但是不包括end位置的字元。
			var value = link.substring(link.lastIndexOf('/') + 1); //獲取最後一個「/」後面的值
			// alert('value: ' + value); // 10

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
			var url = link.substr(link.lastIndexOf('/', link.lastIndexOf('/') - 1) + 1);
			//如果不写上面这一行 将会取最后一个/前所有值
			// alert('url: ' + url); // 19/10
			var site = url.lastIndexOf("\/"); //获取最后一个/的位置
			var yearId = url.substring(0, site); //截取最后一个/前的值
			// alert('yearid: ' + yearId);

			// attr,更改form中的action連結
			jQuery("#searchList").attr("action", baseURL + "partymember/index/" + value);
			jQuery("#searchList").submit();
		});
	});
</script>