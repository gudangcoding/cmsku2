<script type="text/javascript" src="js/menu.js"></script>
<?php
	if(!defined("INDEX")) header('location: index.php');
	if($_SESSION['leveluser'] != "admin") header('location: index.php');

	$show = isset($_GET['show']) ? $_GET['show'] : "";
	$link = "?content=menu";

	switch($show){
		default:
			//Skrip menampilkan data
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