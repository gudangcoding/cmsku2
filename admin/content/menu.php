<script type="text/javascript" src="js/menu.js"></script>
<?php
	if(!defined("INDEX")) header('location: index.php');
	if($_SESSION['leveluser'] != "admin") header('location: index.php');

	$show = isset($_GET['show']) ? $_GET['show'] : "";
	$link = "?content=menu";

	switch($show){
		default:
			//Skrip menampilkan data
			$kategori = isset($_REQUEST['kategori']) ? $_REQUEST['kategori'] : "main";
			echo '<h3 class="page-header"><b>Daftar Menu</b>
					<a href="'.$link.'&show=form&kategori='.$kategori.'" class="btn btn-primary btn-sm pull-right top-button">
						<i class="glyphicon glyphicon-plus-sign"></i> Tambah 
					</a>
				</h3>';
			
			//Membuat tab kategori menu
			echo'<nav class="nav nav-tabs" style="margin-bottom: 20px">';
					$list = array();
					$list[] = array("val"=>"main", "cap"=>"Main Menu");
					$list[] = array("val"=>"secondary", "cap"=>"Secondary Menu");
					
					$menu = $mysqli->query("SELECT * FROM widget WHERE tipe='menu'");
					while($mn = $menu->fetch_array()){
						$list[] = array("val"=>$mn['id_widget'], "cap"=>$mn['judul']);
					}
									
					foreach($list as $ls){
						$class = $ls['val']==$kategori ? 'class="active"' : '';
						echo'<li '.$class.'><a href="'.$link.'&kategori='.$ls['val'].'">'.$ls['cap'].'</a></li>';
					}	
			echo'</nav>';	
			
			//Membuat fungsi tampil link
			function tampil_link($data){
				global $mysqli;
				if($data['jenis_link']=="kategori"){
					$kategori = $mysqli->query("select * from kategori where id_kategori='$data[link]'");
					$kat = $kategori->fetch_array();
					$tampil_link = "Kategori: $kat[kategori]";
				}elseif($data['jenis_link']=="halaman"){
					$halaman = $mysqli->query("select * from halaman where id_halaman='$data[link]'");
					$hal = $halaman->fetch_array();
					$tampil_link = "Halaman: $hal[judul]";
				}else{
					$tampil_link = "URL: $data[link]";
				}
				return $tampil_link;
			}
			
			buka_tabel(array("Judul", "Link", "Urutan"));
			$no = 1;
			if(isset($_REQUEST['kategori'])) $query = $mysqli->query("SELECT * FROM menu WHERE induk='0' and kategori_menu='$_REQUEST[kategori]' ORDER BY urut");
			else $query = $mysqli->query("SELECT * FROM menu WHERE induk='0' and kategori_menu='main' ORDER BY urut");
			
			while($data = $query->fetch_array()){
				isi_tabel($no, array($data['judul'], tampil_link($data), $data['urut']), $link, $data['id_menu']);
							
				$sub = $mysqli->query("SELECT * FROM menu WHERE induk='$data[id_menu]' ORDER BY urut");
				while($datasub = $sub->fetch_array()){
					isi_tabel($no, array("--- ".$datasub['judul'], tampil_link($datasub), $datasub['urut']), $link, $datasub['id_menu']);
					$no++;
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

		case "delete":
			//Skrip menghapus data di database
		break;
	}