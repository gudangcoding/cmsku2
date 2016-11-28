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
		if($content=="artikel"){
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
	function template_footer()
	{
		include folder_template()."/footer.php";
		echo '<script type="text/javascript" src="'.web_info('url').'/plugin/bootstrap/js/bootstrap.min.js"></script>';
	}
	// Fungsi untuk menentukan link menu sesuai dengan jenis link (halaman, kategori atau URL)
	function cari_link($rmenu){	
		global $mysqli;
		
		if($rmenu['jenis_link'] == "halaman"){
			$qhalaman = $mysqli->query("SELECT * FROM halaman WHERE id_halaman='$rmenu[link]'");
			$rhal = $qhalaman->fetch_array();
			$link = web_info('url')."/hal/$rmenu[link]/$rhal[judul_seo]";
		}elseif($rmenu['jenis_link'] == "kategori"){
			$qkategori = $mysqli->query("SELECT * FROM kategori WHERE id_kategori='$rmenu[link]'");
			$rkat = $qkategori->fetch_array();
			$link = web_info('url')."/kat/$rmenu[link]/$rkat[kategori_seo]";
		}else{
			$link = $rmenu['link'];
		}
		
		return $link;
	}

	// Fungsi untuk menampilkan menu
	function template_menu($kategori='main'){
		global $mysqli;					
		$qmenu = $mysqli->query("SELECT * FROM menu WHERE kategori_menu='$kategori' AND induk='0' ORDER BY urut");
		while($menu = $qmenu->fetch_array()){
			$qsubmenu = $mysqli->query("SELECT * FROM menu WHERE induk='$menu[id_menu]' ORDER BY urut");
			if($qsubmenu->num_rows > 0){
				echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
						'.$menu['judul'].' <b class="caret"></b></a>
						<ul class="dropdown-menu">';
						while($sub = $qsubmenu->fetch_array()){
							echo'<li><a href="'.cari_link($sub).'">'.$sub['judul'].'</a></li>';			
						}
				echo'	</ul></li>';
			}else{
				echo'<li><a href="'.cari_link($menu).'">'.$menu['judul'].'</a></li>';
			}
		}
	}
	// Fungsi untuk membuat paginasi halaman
	function buat_paging($link1, $link2, $batas, $jmldata, $halaktif){
		$link1 = web_info('url').'/'.$link1;
		$jmlhalaman = ceil($jmldata/$batas);
		$class = 'btn btn-sm btn-default';
		$link_halaman = '';	
		$link_halaman .= '<div style="text-align: center">';
		
		// Link ke halaman pertama (first) dan sebelumnya (prev)
		if($halaktif > 1){
			$prev = $halaktif-1;
			$link_halaman .= '<a href="'.$link1.'/1'.$link2.'" class="'.$class.'"><< First </a>  
							  <a href="'.$link1.'/'.$prev.$link2.'" class="'.$class.'">< Prev </a>';
		}
		else{ 
			$link_halaman .= '<a href="#" class="'.$class.' disabled"><< First </a>  
							  <a href="#" class="'.$class.' disabled">< Prev </a>';
		}

		// Link halaman 1,2,3, ...
		$angka = ($halaktif > 3 ? "...  " : " "); 
		for ($i=$halaktif-2; $i<$halaktif; $i++){
			if ($i < 1) continue;
			$angka .= '<a href="'.$link1.'/'.$i.$link2.'" class="'.$class.'">'.$i.'</a> ';
		}
		
		$angka .= '<a href="" class="btn btn-sm btn-primary disabled">'.$halaktif.'</a> ';
		  
	    for($i=$halaktif+1; $i<($halaktif+3); $i++){
			if($i > $jmlhalaman) break;
			$angka .= '<a href="'.$link1.'/'.$i.$link2.'" class="'.$class.'">'.$i.'</a> ';
		}
		
		$angka .= ($halaktif+2<$jmlhalaman ? '... <a href="'.$link1.'/'.$jmlhalaman.$link2.'" class="'.$class.'">'.$jmlhalaman.'</a> ' : ' ');

		$link_halaman .= $angka;

		// Link ke halaman berikutnya (Next) dan terakhir (Last) 
		if($halaktif < $jmlhalaman){
			$next = $halaktif+1;
			$link_halaman .= '<a href="'.$link1.'/'.$next.$link2.'" class="'.$class.'"> Next > </a>  
							  <a href="'.$link1.'/'.$jmlhalaman.$link2.'" class="'.$class.'"> Last >> </a>';
		}
		else{
			$link_halaman .= '<a href="#" class="'.$class.' disabled"> Next > </a>  
							  <a href="#" class="'.$class.' disabled"> Last >> </a>';
		}
		
		$link_halaman .= '</div>';
		echo $link_halaman;
	}