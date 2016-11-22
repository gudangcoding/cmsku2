<script type="text/javascript" src="../plugin/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/tinymce_config.js"></script>

<?php
	if(!defined("INDEX")) header('location: index.php');

	$show = isset($_GET['show']) ? $_GET['show'] : "";
	$link = "?content=halaman";

	switch($show){
		default:
			//Skrip menampilkan data
			echo '<h3 class="page-header"><b>Daftar Halaman</b>';

			if($_SESSION['leveluser'] == "admin"){
				echo '<a href="'.$link.'&show=form" class="btn btn-primary btn-sm pull-right top-bottom">
							<i class="glyphicon glyphicon-plus-sign"></i> Tambah
						</a>';
			}
			echo '</h3>';

			buka_tabel(array("Judul Halaman","User"));
				$no = 1;
				$query = $mysqli->query("SELECT * FROM halaman ORDER BY id_halaman");
				while($data = $query->fetch_array()){
					$user = $mysqli->query("SELECT nama_lengkap FROM user WHERE id_user='$data[id_user]'");
					$us = $user->fetch_array();

					if($_SESSION['leveluser'] == 'admin'){
						isi_tabel($no, array($data['judul'], $us['nama_lengkap']), $link, $data['id_halaman']);
					}else{
						isi_tabel($no, array($data['judul'], $us['nama_lengkap']), $link, $data['id_halaman'], true, false);
					}
					$no++;
				}
			tutup_tabel();
		break;

		case "form":
			//Skrip menampilkan form tambah dan edit data
		break;

		case "action":
			//Skrip aksi form tambah dan edit
		break;

		case "delete":
			//Skrip menghapus data
		break;
	}