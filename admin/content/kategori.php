<?php
	if(!defined("INDEX")) header('location: index.php');
	if($_SESSION['leveluser'] != "admin") header('location: index.php');

	$show = isset($_GET['show']) ? $_GET['show'] : "";
	$link = "?content=kategori";

	switch($show){
		default:
		//Menampilkan data
		break;

		case "form":
		//Menampilkan form input dan edit data
		break;

		case "action":
		//Menyisipkan atau mengedit data di database
		break;

		case "delete":
		//Menghapus data di database
		break;
	}