<?php

	if(isset($_POST['truncate'])){
		$mysqli = new mysqli("localhost", "root", "", "bukutamu");
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: " . $mysqli->connect_error;
		}
		$truncate = $mysqli->query("TRUNCATE tb_login");
		if($truncate){
			echo "<script>alert('Data berhasil direset!'); window.location.assign('../dblogin.php')</script>";
		}
	}
?>