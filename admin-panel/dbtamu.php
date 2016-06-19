<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>BUKU TAMU ELEKTRONIK</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		
		<script>
			$(document).ready(function() {
				$(window).load(function() {
					// Animate loader off screen
					$(".se-pre-con").fadeOut("slow");
					$("body").show();
				});
			});
		</script>

	</head>
	<body style="display:none;">
		<!-- Loader -->
			<div class="se-pre-con"></div>
		<!-- Header -->
			<header id="header">
				<h1><a href="cpanel.php">Control Panel</a></h1>
				<nav id="nav">
					<ul>
						<li><a href="cpanel.php">Home</a></li>
						<?php
						session_start();
						if ('superuser' !== ($_SESSION['divisi'])) { }else{?>
						<li><a href="dblogin.php">Data Log In</a></li>
						<?php } ?>
						<li><a href="dbtamu.php">Data Tamu</a></li>
						<li><a href="php/logout.php">Log Out</a></li>
					</ul>
				</nav>
			</header>

		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="container">

					<header class="major">
						<h2>Data Tamu</h2>
						<p></p>
					</header>

						<div class="table-wrapper">
						<form action ="php/hapustamu.php" method="POST"><input type="submit" name="delete" value="Hapus">
						<?php
						if ('administrasi' !== ($_SESSION['divisi'])) { }else{?>
						<a href="php/exportxls.php" class="button">Export Excel</a></li>
						<?php } ?>

						  <br><br>
							<table>
								<thead>
									<tr>
										<th>CEK</th>
										<th>UID</th>
										<th>Nama Lengkap</th>
										<th>E-Mail</th>
										<th>Telepon</th>
										<th>Tujuan</th>
										<th>Foto</th>
										<th>TTD</th>
									</tr>
								</thead>
								<tbody>
								  
									<?php
										$mysqli = new mysqli("localhost", "root", "", "bukutamu");
										if ($mysqli->connect_errno) {
											echo "Failed to connect to MySQL: " . $mysqli->connect_error;
										}
										$sql = $mysqli->query("SELECT * FROM tb_tamu");
										$no = 1;
										while ($row = $sql->fetch_assoc()){
									?>
									<tr>
										<td><input type="checkbox" id="checkbox[<?php echo $row['uid']?>]" name="checkbox[<?php echo $row['uid']?>]" value="<?php echo $row['uid'] ?>"><label for="checkbox[<?php echo $row['uid']?>]">HAPUS</label></td>
										<td><?php echo $row['uid']; ?></td>
										<td><?php echo $row['nama']; ?></td>
										<td><?php echo $row['email']; ?></td>
										<td><?php echo $row['telepon']; ?></td>
										<td><?php echo $row['tujuan']; ?></td>
										<td><img id="imageview" style="height:240px;padding:0;" value="0" src="<?php echo $row['foto']; ?>"/></td>
										<td><?php
										require_once 'php/signature-to-image.php';
										$json = $row['ttd'];
										$ttdjson = sigJsonToImage($json);
										$ttdloc = $row['nama'].'.png';
										imagepng($ttdjson, $ttdloc);
										$ttd = file_get_contents($ttdloc);
										$base64 = 'data:image/png;base64,' . base64_encode($ttd);
										?>
										<img src="<?php echo $base64;
										imagedestroy($ttdjson);
										unlink($ttdloc);?>">
										</td>
									</tr>
									<?php
											$no++;
										}
									?>
						</form>
								</tbody>
							</table>
						<form action ="php/truncatetamu.php" method="POST" style="display:inline"><input type="submit" name="truncate" value="Reset Database"></form>
						</div>
				</div>
			</section>
	</body>
</html>