<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "bukutamu";

$koneksi = mysqli_connect ($host, $user, $pass, $db);
if(mysqli_connect_errno()){
	echo "Gagal melakukan koneksi ke database ".$db.mysqli_connect_errno();
}
?>