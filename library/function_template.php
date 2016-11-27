<?php
	// Fungsi untuk mendapatkan data pada tabel setting
	function web_info($parameter)
	{
		global $mysqli;
		$query = $mysqli->query("SELECT * FROM setting WHERE parameter='$parameter'");
		$setting = $query->fetch_array();

		return $setting['nilai'];
	}