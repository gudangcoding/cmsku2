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
			if(isset($_GET['id'])){
				$query = $mysqli->query("SELECT * FROM halaman WHERE id_halaman='$_GET[id]'");
				$data = $query->fetch_array();
				$aksi = "Edit";
			}else{
				$data = array("id_halaman"=>"","judul"=>"","isi"=>"","gambar"=>"","id_modul"=>"");
				$aksi = "Tambah";
			}

			echo '<h3 class="page-header"><b>'.$aksi.' Halaman</b></h3>';

			if($aksi == "Tambah" and $_SESSION['leveluser'] != "admin"){
				header('location:'.$link);
			}else{
				buka_form($link, $data['id_halaman'], strtolower($aksi));
					buat_textbox("Judul Halaman", "judul", $data['judul'],10);
					buat_textarea("Isi Halaman", "isi", $data['isi'], "richtext");
					buat_imagepicker("Gambar","gambar", $data['gambar']);

					//Menampilkan pilihan modul untuk ditampilkan pada halaman
					$konten = $mysqli->query("SELECT * FROM modul WHERE konten='Y' AND aktif='Y'");
					$list = array();
					$list[] = array('val'=>'0', 'cap'=>'Tidak ada');

					while($kt = $konten->fetch_array()){
						$list[] = array('val'=>$kt['id_modul'],'cap'=>$kt['judul']);
					}
					buat_combobox("Konten Modul", "konten", $list, $data['id_modul']);
				tutup_form($link);
			}
		break;

		case "action":
			//Skrip aksi form tambah dan edit
		break;

		case "delete":
			//Skrip menghapus data
		break;
	}