<?php
	// Fungsi untuk mendapatkan data pada tabel setting
	function web_info($parameter)
	{
		global $mysqli;
		$query = $mysqli->query("SELECT * FROM setting WHERE parameter='$parameter'");
		$setting = $query->fetch_array();

		return $setting['nilai'];
	}
	// Fungsi untuk mendapatkan nama folder template yang aktif
	function folder_template()
	{
		global $mysqli;
		$query = $mysqli->query("SELECT * FROM template WHERE aktif='Y'");
		$tpl = $query->fetch_array();

		return 'template/'.$tpl['folder'];
	}
	// Fungsi untuk memembuat meta header, judul website, memanggil bootstrap dan jquery
	function meta_header()
	{
		global $mysqli;

		$content = (isset($_GET['content'])) ? $_GET['content'] : "home";
		if($content = "artikel"){
			$qartikel = $mysqli->query("SELECT * FROM artikel WHERE id_artikel='$_GET[id]'");
			$artikel = $qartikel->fetch_array();

			$judul = $artikel['judul'].' - '.web_info('judul');
			$deskripsi = $artikel['judul'];
			$keyword = $artikel['tag'];
		}else{
			$judul = web_info('judul');
			$deskripsi = web_info('deskripsi');
			$keyword = web_info('keyword');
		}

		$icon = web_info('url')."/media/source/".web_info('ikon');
		echo '<title>'.$judul.'</title>
				
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<meta name="robots" content="index, follow">
				<meta name="description" content="'.$deskripsi.'">
				<meta name="keywords" content="'.$keyword.'">
				<meta http-equiv="Copyright" content="'.web_info('url').'">
				<meta name="author" content="Rohi">
				<meta name="language" content="Indonesia">
				<meta name="revisit-after" content="7">
				<meta name="webcrawlers" content="all">
				<meta name="rating" content="general">
				<meta name="spiders" content="all">
				<meta name="viewport" content="width=device-width, initial-scale=1.0" />
				
				<link rel="shortcut icon" href="'.$icon.'" />		
				<link rel="stylesheet" type="text/css" href="'.web_info('url').'/plugin/bootstrap/css/bootstrap.min.css">
				<link rel="stylesheet" type="text/css" href="'.web_info('url').'/'.folder_template().'/css/style.css">
				
				<script type="text/javascript" src="'.web_info('url').'/plugin/jquery/jquery-2.0.2.min.js"></script>
				<script src="https://www.google.com/recaptcha/api.js"></script>';
	}
	// Fungsi untuk menampilkan template header pada folder template
	function template_header()
	{
		include folder_template()."/header.php";
	}
	function form_pencarian($tombol="Search",$placeholder = "Search here...")
	{
		echo '<form method="post" action="'.web_info('url').'/pencarian" class="form form-inline form-search">
					<input type="text" name="kata" class="form-control" placeholder="'.$placeholder.'">
					<button type="submit" class="btn btn-default">'.$tombol.'</button>
				</form>
		';
	}