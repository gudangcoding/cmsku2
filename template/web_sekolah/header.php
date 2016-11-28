<!DOCTYPE html>
<html>
<head>
	<?php
		$folder_template = web_info('url').'/'.folder_template();

		meta_header();
	?>
</head>
<body>
	<header id="header">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-xs-1">
					<img src="<?= $folder_template; ?>/images/logo.png" width="100%">
				</div>
				<div class="col-md-4 col-xs-1"></div>
				<div class="col-md-4 hidden-xs">
					<?php form_pencarian('Go'); ?>
				</div>
			</div>
		</div>
	</header>
