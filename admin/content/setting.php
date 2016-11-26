<?php
	if(!defined("INDEX")) header('location: ../index.php');
	if($_SESSION['leveluser'] != "admin") header('location: index.php');

	$show = isset($_GET['id']) ? $_GET['id'] : "";
	$link = "?content=setting";

	switch($show){
		default:
			//Menampilkan data
			echo '<h3 class="page-header"><b>Setting Website</b></h3>';

			function dapatkan_nilai($parameter){
				global $mysqli;
				$query = $mysqli->query("SELECT * FROM setting WHERE parameter='$parameter'");
				$data = $query->fetch_array();

				return $data['nilai'];
			}

			buka_form($link, "", "");
				buat_textbox("Judul Website","judul", dapatkan_nilai("judul"));
				buat_textbox("Deskripsi", "deskripsi",dapatkan_nilai("deskripsi"));
				buat_textbox("URL Website", "url", dapatkan_nilai("url"));
				buat_textbox("Folder Website", "folder", dapatkan_nilai("folder"));
				buat_imagepicker("Ikon Website","ikon",dapatkan_nilai("ikon"));
				buat_textarea("Keyword","keyword", dapatkan_nilai("keyword"));

				$list = array();
				$list[] = array("val"=>0,"cap"=>"Artikel Terbaru");
				$query = $mysqli->query("SELECT * FROM halaman");
				while($data = $query->fetch_array()){
					$list[]= array("val"=>$data['id_halaman'],"cap"=>$data['judul']);
				}
				buat_combobox("Homepage","homepage",$list, dapatkan_nilai("homepage"));
			tutup_form($link);
		break;

		case "action":
			//Mengedit data di database
		break;
	}