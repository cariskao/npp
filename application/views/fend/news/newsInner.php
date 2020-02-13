<?php
$id      = $getInnerInfo->pr_id;
$type_id = $getInnerInfo->pr_type_id;
$img     = $getInnerInfo->img;
$m_title = $getInnerInfo->main_title;
$s_title = $getInnerInfo->sub_title;
$date    = $getInnerInfo->date_start;
$e       = $getInnerInfo->editor;
?>

<div class="breadcrumb-bg">
	<div class="container">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li style="" class="breadcrumb-item"><a href="<?php echo base_url('fend/home'); ?>">首頁</a></li>
				<li style="" class="breadcrumb-item"><a href="<?php echo base_url('fend/news_f'); ?>">新聞訊息</a></li>
				<li style="" class="breadcrumb-item"><a
						href="<?php echo base_url('fend/news_f/newsFlists/' . $type_id); ?>"><?php echo $breadcrumbTag; ?></a>
				</li>
				<li style="display:none" class="breadcrumb-item active" aria-current="page"></a></li>
			</ol>
		</nav>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="inner-title" style="margin-top:30px;margin-bottom:30px">
				<h3><?php echo $m_title; ?></h3>
				<h5 style="margin-top:20px"><?php echo $s_title; ?></h5>
			</div>
		</div>
		<div class="col-md-12">
			<div class="inner-share">
				<span style="font-size:14px;font-weight:bold">發布時間：<?php echo $date; ?></span>
				<!-- 社群分享 -->
				<ul class="share-buttons pull-right">
					<li><a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fnewpowerparty.geekers.tw%2F&quote="
							title="Share on Facebook" target="_blank"><img alt="Share on Facebook"
								src="<?php echo base_url('assets/f_imgs/'); ?>sharingButtonsGenerator/flat_web_icon_set/color/Facebook.png" /></a>
					</li>
					<li><a href="https://twitter.com/intent/tweet?source=http%3A%2F%2Fnewpowerparty.geekers.tw%2F&text=:%20http%3A%2F%2Fnewpowerparty.geekers.tw%2F"
							target="_blank" title="Tweet"><img alt="Tweet"
								src="<?php echo base_url('assets/f_imgs/'); ?>sharingButtonsGenerator/flat_web_icon_set/color/Twitter.png" /></a>
					</li>
					<div class="line-it-button" data-lang="zh_Hant" data-type="share-c" data-ver="3"
						data-url="http://newpowerparty.geekers.tw/" data-color="default" data-size="small" data-count="false"
						style="display: none;"></div>
					<li>
						<a href="javascript:void(0)" onclick="CopyTextToClipboard('copythis')">
							<img alt="Share"
								src="<?php echo base_url('assets/f_imgs/'); ?>sharingButtonsGenerator/share_icon_grey.svg" />
						</a>
					</li>
				</ul>

				<script src="https://d.line-scdn.net/r/web/social-plugin/js/thirdparty/loader.min.js" async="async"
					defer="defer"></script>

				<!-- 點擊複製連結 -->
				<div id="copythis"></div>
			</div>
		</div>
	</div>
</div>
<div id="gotop">^</div>
<script type="text/javascript">
	function CopyTextToClipboard(id) {
		document.getElementById(id).style.display = "inline-block";
		document.getElementById(id).innerHTML = location.href;

		var TextRange = document.createRange();
		TextRange.selectNode(document.getElementById(id));

		sel = window.getSelection();
		sel.removeAllRanges();
		sel.addRange(TextRange);

		document.execCommand("copy");
		document.getElementById(id).style.display = "none";

		alert("網址複製完成！");
	}
</script>