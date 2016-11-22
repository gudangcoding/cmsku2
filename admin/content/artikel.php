<script type="text/javascript" src="../plugin/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/tinymce_config.js"></script>

<?php
	if(!defined("INDEX")) header('location: index.php');
	
	$show = isset($_GET['show']) ? $_GET['show'] : "";
	$link = "?content=artikel";

	switch($show){
		default:
			//Skrip menampilkan data
			echo '<h3 class="page-header"><b>Daftar Artikel</b>
						<a href="'.$link.'&show=form" class="btn btn-primary btn-sm pull-right top-button">
							<i class="glyphicon glyphicon-plus-sign"></i> Tambah
						</a>
					</h3>';
		
			buka_tabel(array("Judul Artikel", "Kategori", "User", "Tanggal Posting"));
			$no = 1;
			$id_user = $_SESSION['iduser'];
			
			if($_SESSION['leveluser']=="admin") $query = $mysqli->query("SELECT * FROM artikel ORDER BY id_artikel DESC");
			else $query = $mysqli->query("SELECT * FROM artikel WHERE id_user='$id_user' ORDER BY id_artikel");
			while($data = $query->fetch_array()){
				$user = $mysqli->query("SELECT nama_lengkap FROM user where id_user='$data[id_user]'");
				$us = $user->fetch_array();
				
				$kategori = $mysqli->query("SELECT * FROM kategori where id_kategori='$data[kategori]'");
				$kat = $kategori->fetch_array();
				
				$tanggal = tgl_indonesia($data['tanggal']);
				
				isi_tabel($no, array($data['judul'], $kat['kategori'], $us['nama_lengkap'], $tanggal), $link, $data['id_artikel']);
				$no++;
			} 
			tutup_tabel();
		break;

		case "form":
			//Skrip menampilkan form tambah dan edit data
		break;

		case "action";
			//Skrip aksi form tambah dan edit
		break;

		case "delete";
			//Skrip menghapus data
		break;
	}