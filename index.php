<?php
	error_reporting();
	ob_start();

	include "library/config.php";
	include "library/function_date.php";
	include "library/function_antiinjection.php";
	include "library/function_template.php";

	$content 	= (isset($_GET['content'])) ? $_GET['content'] : "home";
	$kosong 	= true;
	$page 		= array('home', 'artikel', 'halaman', 'kategori', 'pencarian');
	foreach($page as $pg){
		if($content == $pg and $kosong){
			if(file_exists(folder_template().'/'.$pg.'.php')){
				include folder_template().'/'.$pg.'.php';
				$kosong = false;
			}
		}
	}

	if($kosong){
		include folder_template().'/404.php';
	}	