<?php
if(!defined("INDEX")) header('location: index.php');
?>
<div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">ADMINISTRATOR</a>
</div>

<div id="navbar" class="navbar-collapse collapse">
	<ul class="nav navbar-nav visible-xs">
		<?php
			buat_menu("dashboard", "home", "Dashboard", array("admin", "author"));
			buka_dropdown("list-alt", "Artikel");
				buat_submenu("artikel", "Artikel");
				buat_submenu("kategori", "Kategori");
				buat_submenu("tag", "Tag");
			tutup_dropdown();
			buat_menu("artikel", "list-alt", "Artikel", array("author"));
			buat_menu("halaman", "file", "Halaman", array("admin", "author"));
			buat_menu("komentar", "comment", "Komentar", array("admin", "author"));
			buat_menu("media", "picture", "Media", array("admin"));
			buat_menu("user", "user", "User", array("admin", "author"));

			buat_menu("modul", "tasks", "Modul");
			buka_dropdown("th-list", "Tampilan");
				buat_submenu("template", "Template");
				buat_submenu("menu", "Menu");
				buat_submenu("widget", "Widget");
			tutup_dropdown();
			buat_menu("setting", "wrench", "Setting");
			buat_menu("backuprestore", "floppy-save", "Backup dan Restore");
			
			$query = $mysqli->query("SELECT * FROM modul WHERE menu='Y' AND aktif='Y'");
			while($data = $query->fetch_array()){
				if(file_exists("../module/$data[folder]/menu.php")){
					include "../module/$data[folder]/menu.php";
				}
			}
			
		?>		
	</ul>
	<ul class="nav navbar-nav navbar-right">
		<li><a target='_blank' href="../"><i class="glyphicon glyphicon-eye-open"></i> Lihat Web</a></li>
		<li><a href="logout.php"><i class="glyphicon glyphicon-log-out"></i> Keluar</a></li>
	</ul>
</div>