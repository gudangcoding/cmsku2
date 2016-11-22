<?php
	if(!defined("INDEX")) header('location: index.php');
	if($_SESSION['leveluser'] != "admin") header('location: index.php');

	$show = isset($_GET['show']) ? $_GET['show'] : "";
	$link = "?content=kategori";

	switch($show){
		default:
			//Menampilkan data
			echo '<h3 class="page-header"><b>Daftar Kategori</b>
						<a href="'.$link.'$show=form" class="btn btn-primary btn-sm pull-right top-button">
							<i class="glyphicon glyphicon-plus-sign"></i> Tambah
						</a>
					</h3>';

			buka_tabel(array("Kategori"));
			$no = 1;
			$query = $mysqli->query("SELECT * FROM kategori ORDER BY id_kategori");
			while($data = $query->fetch_array()){
				isi_tabel($no, array($data['kategori']), $link, $no++);
			}
			tutup_tabel();
		break;

		case "form":
		//Menampilkan form input dan edit data
		break;

		case "action":
		//Menyisipkan atau mengedit data di database
		break;

		case "delete":
		//Menghapus data di database
		break;
	}