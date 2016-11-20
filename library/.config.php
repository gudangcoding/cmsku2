<?php
	//Membuat variable untuk koneksi, ubah sesuai dengan nama host dan database sesuai hosting
	$host = "";
	$user = "";
	$pass = "";
	$db = "";

	//Menggunakan object mysqli untuk membuat koneksi dan menyimpannya dalam variable $mysqli
	$mysqli = new mysqli($host, $user, $pass, $db);

	//Menentukan default timezone
	date_default_timezone_set('Asia/Jakarta');

	//Membuat variabel yang berisi array nama-nama hari dan menggunakannya untuk mengkonversi nilai hari menjadi nama hari bahasa indonesia yang disimpan pada variabel $hari_ini
	$nama_hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
	$hari = date("w");
	$hari_ini = $nama_hari[$hari];

	//Membuat variable yang menyimpan nilai waktu
	$tgl_sekarang = date("d");
	$bln_sekarang = date("m");
	$thn_sekarang = date("Y");

	$tanggal = date('Ymd');
	$jam = date("H:i:s");