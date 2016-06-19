<?php 
	if(isset($_POST['delete'])){
		$mysqli = new mysqli("localhost", "root", "", "bukutamu");
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: " . $mysqli->connect_error;
		}
		 
		$checkbox = $_POST['checkbox'];
		if ($checkbox) {
			foreach ($checkbox as $value) {
				$mysqli->query("DELETE FROM tb_login WHERE uid = '$value'");
			}
			echo '<script>alert("Data berhasil terhapus!"); window.location.assign("../dblogin.php")</script>';
		}  else {
			echo '<script>alert("Data belum terpilih!"); window.location.assign("../dblogin.php")</script>';
		}
	} else {
		echo '<script>window.history.back()</script>';
	}
?>