<?php
session_start();

if (!isset($_SESSION['username']))
{
  echo "<script>window.location.assign('index.php')</script>";
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
	<body class="landing" style="display:none;">
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

		<!-- Banner -->
			<section id="banner">
				<h2>Selamat Datang, <?php echo $_SESSION['username'] ?></h2>
				<h2>Divisi <?php echo $_SESSION['divisi'] ?></h2>
				<p>Semoga harimu menyenangkan</p>
			</section>
	</body>
</html>