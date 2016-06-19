<?php
session_start();
 
if (!isset($_SESSION['username']))
{
  echo "<script>window.location.assign('index.php')</script>";
}

if ('superuser' !== ($_SESSION['divisi']))
{
  echo "<script>window.location.assign('cpanel.php')</script>";
}
?>

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
						<h2>Data Log In</h2>
						<p></p>
					</header>

						<div class="table-wrapper">
						<form action ="php/hapuslogin.php" method="POST"><input type="submit" name="delete" value="Hapus">
						  <br><br>
							<table>
								<thead>
									<tr>
										<th>CEK</th>
										<th>ID</th>
										<th>Username</th>
										<th>Password (md5)</th>
										<th>Divisi</th>
									</tr>
								</thead>
								<tbody>
								  
									<?php
										$mysqli = new mysqli("localhost", "root", "", "bukutamu");
										if ($mysqli->connect_errno) {
											echo "Failed to connect to MySQL: " . $mysqli->connect_error;
										}
										$sql = $mysqli->query("SELECT * FROM tb_login");
										$no = 1;
										while ($row = $sql->fetch_assoc()){
									?>
									<tr>
										<td><input type="checkbox" id="checkbox[<?php echo $row['id']?>]" name="checkbox[<?php echo $row['id']?>]" value="<?php echo $row['id'] ?>"><label for="checkbox[<?php echo $row['id']?>]">HAPUS</label></td>
										<td><?php echo $row['id']; ?></td>
										<td><?php echo $row['username']; ?></td>
										<td><?php echo $row['password']; ?></td>
										<td><?php echo $row['divisi']; ?></td>
									</tr>
									<?php
											$no++;
										}
									?>
									<tr>
						</form>
									<form action="" method="POST">
										<td></td>
										<td><?php echo $no;?></td>
										<td><input type="text" name="username" placeholder="Username bebas"></td>
										<td><input type="text" name="password" placeholder="Password bebas"></td>
										<td>
										<select name="divisi"><option value="">Pilih divisi</option>
										<option value="resepsionis">Resepsionis</option>
										<option value="administrasi">Administrasi</option>
										<option value="superuser">Superuser</option>
										</select>
										</td>
									</tr>
								</tbody>
							</table>
						  <input type="submit" name="input" value="Input Data">
						  </form>
						<form action ="php/truncatelogin.php" method="POST" style="display:inline"><input type="submit" name="truncate" value="Reset Database"></form>
						</div>
				</div>
			</section>
	</body>
</html>
<!--INPUT PHP-->
<?php
	if(isset($_POST['input'])){
		if ($_POST['username'] != "" and $_POST['password'] != "" and $_POST['divisi'] != "") {
			$username = $_POST['username'];
			$password = md5($_POST['password']);
			$divisi = $_POST['divisi'];
			$insert = $mysqli->query("INSERT INTO tb_login VALUES(NULL,'$username','$password','$divisi')");
			if ($insert) {
				echo "<script> alert('Data berhasil terinput!'); window.location.assign('dblogin.php')</script>";
			} else {
				echo "<script> alert('Data gagal terinput!'); window.location.assign('dblogin.php')</script>";
			}
		} else {
			echo "<script> alert('Terdapat data yang kosong!'); window.location.assign('dblogin.php')</script>";
		}
	}
?>