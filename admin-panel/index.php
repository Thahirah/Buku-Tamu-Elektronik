<?php
session_start();
 
if (isset($_SESSION['username']))
{
  echo "<script>window.location.assign('cpanel.php')</script>";
}
?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link href='css/font.css' rel='stylesheet' type='text/css'>
   
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/stylelogin.css">
	
    <script src='js/2.1.3.jQuery.min.js'></script>

    <script src="js/index.js"></script>
	
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

  
<div class="outer">
<div class="middle">
<div class="inner">
    <div class="form">
      
      <div class="tab-content">
        <div id="login">   
          <h1>Welcome!</h1>
          
          <form action="" method="post">
          
            <div class="field-wrap">
            <label>
              Username<span class="req">*</span>
            </label>
            <input type="text" name="username" required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password" name="password" required autocomplete="off"/>
          </div>
          
          <input type="submit" class="button button-block"/ name="login" value="Log In">
          
          </form>
        </div>
        
      </div><!-- tab-content -->
      
	</div> <!-- /form -->
</div>
</div>
</div>

  </body>
</html>

<?php
if (isset($_POST["login"])) {
	$username=$_POST['username'];
	$password=md5($_POST['password']);
	$login=$_POST['login'];
	if(isset($login)){
	  $mysqli = new mysqli("localhost", "root", "", "bukutamu");
	  if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: " . $mysqli->connect_error;
	  }
	  $sql = $mysqli->query("SELECT * FROM tb_login where username='$username' and password='$password'");
	  $row = $sql->fetch_assoc();
	  $user = $row['username'];
	  $pass = $row['password'];
	  $divisi = $row['divisi'];
	  if($user==$username && $pass=$password){
		session_start();
		$_SESSION['username']=$user;
		$_SESSION['divisi']=$divisi;
		echo "<script>window.location.assign('cpanel.php')</script>";
	  } else{
		echo "<script> alert('Username atau Password salah!'); window.location.assign('index.php')</script>";
	  }
	}
}
?>
   
