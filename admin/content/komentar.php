<script type="text/javascript" src="../plugin/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/tinymce_config.js"></script>

<?php
	if(!defined("INDEX")) header('location: index.php');

	$show = isset($_GET['show']) ? $_GET['show'] : "";
	$link = "?content=komentar";

	switch($show){

		default:
			//Skrip Menampilkan data
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