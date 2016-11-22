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
			if(isset($_GET['id'])){
				$query = $mysqli->query("SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
				$data = $query->fetch_array();
				$aksi = "Edit";
			} else{
				$data = array("id_kategori"=>"", "kategori"=>"");
				$aksi = "Tambah";
			}
			echo '<h3 class="page-header"><b>'.$aksi.' Kategori</b></h3>';

			buka_form($link, $data['id_kategori'],strtolower($aksi));
				buat_textbox("Nama Kategori", "kategori", $data['kategori']);
			tutup_form($link);
		break;

		case "action":
			//Menyisipkan atau mengedit data di database
			$kategori_seo = convert_seo($_POST['kategori']);
			if($_POST['aksi'] == "tambah"){
				$mysqli->query("INSERT INTO kategori SET
					kategori = '$_POST[kategori]',
					kategori_seo = '$kategori_seo'");
			}elseif($_POST['aksi'] == "edit"){
				$mysqli->query("UPDATE kategori SET
					kategori = '$_POST[kategori]',
					kategori_seo = '$kategori_seo'
				WHERE id_kategori='$_POST[id]'");
			}
			header('location:'.$link);
		break;

		case "delete":
		//Menghapus data di database
		break;
	}