<?php
	if(!defined("INDEX")) header('location: index.php');

	$show = isset($_GET['show']) ? $_GET['show'] : "";
	$link = "?content=user";

	switch($show){
		default:
			//Skrip menampilkan data
			if($_SESSION['leveluser'] == "admin"){
			echo '<h3 class="page-header"><b>Daftar User</b>
						<a href="'.$link.'&show=form" class="btn btn-primary btn-sm pull-right top-button">
							<i class="glyphicon glyphicon-plus-sign"></i> Tambah
						</a>
					</h3>';

			buka_tabel(array("Nama Lengkap", "Email", "Username", "Level"));
				$no = 1;
				$query = $mysqli->query("SELECT * FROM user ORDER BY id_user");
				while($data = $query->fetch_array()){
					if($data['level'] == "admin"){
						isi_tabel($no, array($data['nama_lengkap'], $data['email'],$data['username'],$data['level']), $link, $data['id_user'], true, false);
					}else{
						isi_tabel($no, array($data['nama_lengkap'], $data['email'],$data['username'],$data['level']), $link, $data['id_user']);
					}
					$no++;
				}
			tutup_tabel();
			}else{
				$id_user = $_SESSION['id_user'];
				$query = $mysqli->query("SELECT * FROM user WHERE id_user = '$_GET[id]'");
				$data = $query->fetch_array();
				$aksi = "Edit";

				echo '<h3 class="page-header"><b>'.$aksi.' User</b></h3>';

				buka_form($link,$id_user,strtolower($aksi));
					buat_textbox("Nama Lengkap", "nama_lengkap",$data['nama_lengkap']);
					buat_textbox("Email","email",$data['email']);
					buat_textbox("Username","username",$data['username']);
					buat_textbox("Password","password","",4, "password");
				tutup_form($link);
			}
		break;

		case "form":
			//Skrip menampilkan form input dan edit data

		break;

		case "action":
			//Skrip menyisipkan atau mengedit data di database
		break;

		case "delete";
			//Skrip menghapus data di database
		break;
	}