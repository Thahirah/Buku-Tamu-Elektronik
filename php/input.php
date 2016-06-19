<?php
	if (isset($_POST["submit"])) {
		include("koneksi.php");
		require_once 'signature-to-image.php';

		$nama = $_POST["nama"];
		$email = $_POST["email"];
		if ("" == trim($email)) {
			$email = "";
		}
		$telepon = $_POST["telepon"];
		if ("" == trim($telepon)) {
			$telepon = "";
		}
		$tujuan = $_POST["tujuan"];
		$getfoto = $_POST["outputfoto"];
		if ($getfoto === "") {
			$getfoto = $_POST["outputfoto2"];
		}
		$json = $_POST['output'];
		
		if ($nama != "" and $tujuan != "" and $getfoto != "" and $json != "") {
			
			$input = mysqli_query($koneksi, "INSERT into tb_tamu values(NULL,'$nama','$email','$telepon','$tujuan','$getfoto','$json')");
			
			if ($input) {
		?>
			<script language="JavaScript">
				alert('Data berhasil diinput!');
				document.location='../index.html';
			</script>

		<?php
				imagedestroy($ttdjson);
				unlink($ttdloc);
			}else{
		?>
				<script language="JavaScript">
					alert('Harap ulangi, data belum diisi dengan lengkap!');
					document.location='../index2.html';
				</script>
		<?php
			}
		}else{
			?>
				<script language="JavaScript">
					alert('Harap ulangi, data belum diisi dengan lengkap!');
					document.location='../index2.html';
				</script>
		<?php
			}
		}