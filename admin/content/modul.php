<?php
	if(!defined("INDEX")) header('location: index.php');

	if($_SESSION['leveluser'] != "admin") header('location: index.php');

	$show = isset($_GET['show']) ? $_GET['show'] : "";
	$link = "?content=modul";

	switch($show){

		default:
			//Skrip menampilkan data
			echo '<h3 class="page-header"><b>Daftar Modul</b>
						<a href="'.$link.'&show=form" class="btn btn-primary btn-sm pull-right top-button">
							<i class="glyphicon glyphicon-plus-sign"></i> Tambah
						</a>
					</h3>';

			buka_tabel(array("Judul", "Aktif"));
				$no = 1;
				$query = $mysqli->query("SELECT * FROM modul ORDER BY aktif");

				while($data = $query->fetch_array()){
					if($data['aktif'] == 'Y')
					{
						$aktif = '<a href="'.$link.'&show=deactivate&id='.$data['id_modul'].'" style="color: green">
										<i class="glyphicon glyphicon-ok-circle"></i>
									</a>';
					}else{
						$aktif = '<a href="'.$link.'&show=activate&id='.$data['id_modul'].'" style="color: red">
										<i class="glyphicon glyphicon-remove-circle"></i>
									</a>';
					}
					isi_tabel($no, array($data['judul'], $aktif), $link, $data['id_modul']);

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

		case "delete":
			//Skrip menghapus data di database
		break;

		case "activate":
			//Skrip mengaktifkan modul
		break;

		case "deactivate":
			//Skrip menonaktifkan modul
		break;
	}