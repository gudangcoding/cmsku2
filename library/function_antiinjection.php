<?php
	function antiinjeksi($text)
	{
		global $mysqli;
		$safetext = $mysqli->real_escape_string(stripslashes(strip_tags(htmlspecialchars($text, ENT_QUOTES))));
		//$mysqli->real_escape_string() -> menambahkan backslash(\) sebelum karakter tertentu ->escape_character
		//stripslashes() -> menghilangkan tanda backslash ketika data ditampilkan pada halaman web
		//strip_tags() -> membersihkan suatu string (kata) dari tag HTML
		//htmlspecialchars() -> mengubah karakter khusus menjadi kode HTML
		//ENT_QUOTES -> optional -> menjadikan tanda petik (') ikut diubah menjadi kode HTML

		return $safetext;
	}