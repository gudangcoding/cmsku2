<script type="text/javascript" src="../plugin/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/tinymce_config.js"></script>

<?php
	if(!defined("INDEX")) header('location: index.php');

	$show = isset($_GET['show']) ? $_GET['show'] : "";
	$link = "?content=komentar";

	switch($show){

		default:
			//Skrip Menampilkan data
			echo '<h3 class="page-header"><b>Daftar Komentar</b></h3>';

			buka_tabel(array("Author","Komentar","Artikel"));
				$no = 1;
				$query = $mysqli->query("SELECT * FROM komentar ORDER BY id_komentar desc");

				while($data = $query->fetch_array()){
					$artikel = $mysqli->query("SELECT * FROM artikel where id_artikel='$data[id_artikel]'");
					$atk = $artikel->fetch_array();

					$tanggal = tgl_indonesia($data['tanggal']);
					if($data['dibaca'] == 'N'){
						$author = '<a href="mailto:'.$data['email'].'">
										<b>'.$data['nama'].'</b>
									</a>';
						$komentar = '<small class="text-muted">'.$tanggal.'</small>
									<br><p><b>'.$data['komentar'].'</b></p>';
					} else{
						$author = '<a href="mailto:'.$data['email'].'">
										'.$data['nama'].'
									</a>';
						$komentar = '<small class="text-muted">'.$tanggal.'</small>
									<br><p>'.$data['komentar'].'</p>';
					}
					$artikel = '<a href="../artikel/'.$atk['id_artikel'].'/'.$atk['judul_seo'].'" target="blank">'.$atk['judul'].'</a>';

					isi_tabel($no, array($author, $komentar, $artikel), $link, $data['id_komentar']);
					$no++;
				}
			tutup_tabel();
		break;

		case "form":
			//Skrip menampilkan form edit data
		break;

		case "action":
			//Skrip aksi form edit
		break;

		case "delete":
			//Skrip menghapus data
		break;
	}