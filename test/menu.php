<link type="text/css" rel="stylesheet" href="../plugin/bootstrap/css/bootstrap.min.css">
<script type="text/javascript" src="../plugin/jquery/jquery-2.0.2.min.js"></script>
<script type="text/javascript" src="../plugin/bootstrap/js/bootstrap.min.js"></script>

<div class="navbar">
	<ul class="nav navbar-nav">
<?php
	include "../library/function_menu.php";
	session_start();
	$_SESSION['leveluser'] = "author";

	buat_menu("dashboard", "home", "Dashboard", array("admin", "author"));

	buka_dropdown("list-alt", "Artikel", array("admin", "author"));
		buat_submenu("artikel", "Artikel", array("admin", "author"));
		buat_submenu("kategori", "Kategori", array("admin", "author"));
		buat_submenu("tag", "Tag", array("admin", "author"));
	tutup_dropdown(array("admin", "author"));
	
	buat_menu("halaman", "file", "Halaman", array("admin", "author"));
?>		
	</ul>
</div>