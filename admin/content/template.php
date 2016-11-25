<?php
	if(!defined("INDEX")) header('location: index.php');
	if($_SESSION['leveluser'] != "admin") header('location: index.php');

	$show = isset($_GET['show']) ? $_GET['show'] : "";
	$link = "?content=template";

	switch($show){
		default:
			//Skrip menampilkan data
			echo '<h3 class="page-header"><b>Daftar Template</b>
						<a href="'.$link.'&show=form" class="btn btn-primary btn-sm pull-right top-button">
							<i class="glyphicon glyphicon-plus-sign"></i> Tambah
						</a>
					</h3>';

			buka_tabel(array("Preview", "Judul", "Aktif"));
				$no= 1;
				$query = $mysqli->query("SELECT * FROM template ORDER BY aktif");

				while($data = $query->fetch_array()){
					if($data['aktif'] == 'Y'){
						$aktif = '<span style="color:green">
										<i class="glyphicon glyphicon-ok-circle"></i>
									</span>';
					}else{
						$aktif = '<span style="color:red">
										<i class="glyphicon glyphicon-remove-circle"></i>
									</span>';
					}

					if(file_exists("../template/$data[folder]/preview.png")){
						$gambar = "<img src='../template/$data[folder]/preview.png' width='200'";
					} else{
						$gambar = "<img src='images/blank.png' width='200'";
					}

					if($data['aktif'] == 'Y'){
						isi_tabel($no, array($gambar, $data['judul'], $aktif), $link, $data['id_template'], true, false);
					}else{
						isi_tabel($no, array($gambar, $data['judul'], $aktif), $link, $data['id_template']);
					}
				}
			tutup_tabel();
		break;

		case "form":
			//Skrip menampilkan form input dan edit data
			if(isset($_GET['id'])){
				$query = $mysqli->query("SELECT * FROM template WHERE id_template='$_GET[id]'");
				$data = $query->fetch_array();
				$aksi = "Edit";
			}else{
				$data = array("id_template"=>"","judul"=>"");
				$aksi = "Tambah";
			}

			echo '<h3 class="page-header"><b>'.$aksi.' Template</b></h3>';

			buka_form($link, $data['id_template'], strtolower($aksi));
				buat_textbox("Judul", "judul", $data['judul']);
				if($aksi == "Tambah") buat_textbox("File","file","",4,"file");
			tutup_form($link);
		break;

		case "action":
			//Skrip menyisipkan atau mengedit data di database
		break;

		case "delete":
			//Skrip menghapus data di database
		break;
	}