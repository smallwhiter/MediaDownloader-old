<?php
	namespace MediaDownloader;
	require_once 'init.php';
	
	if(isset($_GET['kill']) && !empty($_GET['kill']) && $_GET['kill'] === "all")
	{
		Downloader::kill_them_all();
	}

	Utils\Document::getInstance()->src_js[] = 'js/index.js';
	Utils\Document::getInstance()->need_jquery = true;
	
	Views\Header::PrintView();
?>
		<div class="container">
			<h1>开始下载</h1>
			
<?php
	Utils\Error::getInstance()->PrintErrors();
	Utils\Error::getInstance()->PrintWarnings();
?>
			<form id="download-form" class="form-horizontal" action="download.php" method="post">					
				<div class="form-group">
					<div class="col-md-10">
						<textarea class="form-control" id="url" name="urls" placeholder="输入Youtube链接" rows="6"><?php echo empty($_POST['urls']) ? '' : $_POST['urls']; ?></textarea>
					</div>
					<div class="col-md-2">
						<div class="list-group-item">
							<label for="stream" class="h4 list-group-item-heading">Stream:</label>
							<select name="stream" class="list-group-item-text">
								<option value="<?php echo StreamEnum::Both; ?>" selected>音频和视频</option>
								<option value="<?php echo StreamEnum::Audio_only; ?>">仅音频</option>
								<option value="<?php echo StreamEnum::Video_only; ?>">仅视频</option>
							</select>
						</div>
						<div class="list-group-item">
							<label for="quality" class="h4 list-group-item-heading">Quality:</label>
							<select name="quality" class="list-group-item-text">
							<option value="<?php echo QualityEnum::Best_ever; ?>" selected>1080P</option>
							<option value="<?php echo QualityEnum::Best; ?>">720P</option>
							<option value="<?php echo QualityEnum::Worst; ?>">144P</option>
							<option value="<?php echo QualityEnum::Manual; ?>">自行选择</option>
							</select>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-primary" name="download" value="indirect">直接下载</button>
				<button type="submit" class="btn btn-default" name="download" value="direct">视频直链</button>
			</form>
			<br>
			<div class="row">
				<div class="col-lg-6">
					<div class="panel panel-info">
						<div class="panel-heading"><h3 class="panel-title">信息</h3></div>
						<div class="panel-body">
							<p>剩余空间 : <b><?php echo FileHandler::free_space(); ?></b></p>
						</div>
					</div>
				</div>
				
			</div>
		</div>

<?php
	Views\Footer::PrintView();
?>
