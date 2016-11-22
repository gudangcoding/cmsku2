<script type="text/javascript" src="../plugin/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/tinymce_config.js"></script>

<?php
	if(!defined("INDEX")) header('location: index.php');
	
	$show = isset($_GET['show']) ? $_GET['show'] : "";
	$link = "?content=artikel";

	switch($show){
		default:
			//Skrip menampilkan data
		break;

		case "form":
			//Skrip menampilkan form tambah dan edit data
		break;

		case "action";
			//Skrip aksi form tambah dan edit
		break;

		case "delete";
			//Skrip menghapus data
		break;
	}