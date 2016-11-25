<?php
	if(!defined("INDEX")) header('location: index.php');

	$show = isset($_GET['show']) ? $_GET['show'] : "";
	$link = "?content=user";

	switch($show){
		default:
			//Skrip menampilkan data
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