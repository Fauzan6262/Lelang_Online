<?php
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$dbname = 'lelang_online';
	
	$conn = mysqli_connect($host, $user, $pass, $dbname) or die (mysqli_error());

	if(!$conn)
	{
		die("Koneksi Gagal !:" .mysqli_connect_error());
	}
	//mysqli_close($conn);
?>