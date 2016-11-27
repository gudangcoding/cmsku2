<?php
	// Fungsi untuk mendapatkan data pada tabel setting
	function web_info($parameter)
	{
		global $mysqli;
		$query = $mysqli->query("SELECT * FROM setting WHERE parameter='$parameter'");
		$setting = $query->fetch_array();

		return $setting['nilai'];
	}
	// Fungsi untuk mendapatkan nama folder template yang aktif
	function folder_template()
	{
		global $mysqli;
		$query = $mysqli->query("SELECT * FROM template WHERE aktif='Y'");
		$tpl = $query->fetch_array();

		return 'template/'.$tpl['folder'];
	}
