<?php 
	//setname dan post_id
	session_start(); // Starting Session
	$uname = $_SESSION['userlogin'];
	$status = $_SESSION['status'];
	$id = $_SESSION['id'];
	 ?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="javascript/jquery.min.js"></script>
	<script src="javascript/bootstrap.js"></script>
	
	<meta charset="UTF-8">
	<meta name="description" content="HOME">

<title>SIASISTEN</title>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Home</a></li>
      <?php
	  if($status == "mahasiswa") {
      echo "<li><a href=\"#\">Melihat Lowongan</a></li>
			<li><a href=\"#\">Membuat Lamaran</a></li>
			<li><a href=\"#\">Mengubah Profil</a></li>
			<li><a href=\"log_mhs.php\">Mengisi Log</a></li>
			<li><a href=\"#\">Logout</a></li>
			";
							
		}
	  elseif($status=="dosen"){
		echo "<li><a href=\"lowongan_buka.php\">Membuka Lowongan</a></li>
			<li><a href=\"lowongan_admin.php\">Melihat Lowongan</a></li>
			<li><a href=\"#\">Melihat Daftar Pelamar</a></li>
			<li><a href=\"#\">Melihat Detail Pelamar</a></li>
			<li><a href=\"log_dosen.php\">Menyetujui Log</a></li>
			<li><a href=\"#\">Logout</a></li>
			
			";  
	  }
	  elseif($status=="admin"){
		echo "<li><a href=\"lowongan_buka.php\">Membuka Lowongan</a></li>
			<li><a href=\"lowongan_admin.php\">Melihat Lowongan</a></li>
			<li><a href=\"#\">Melihat Daftar Pelamar</a></li>
			<li><a href=\"#\">Melihat Detail Pelamar</a></li>
			<li><a href=\"log_dosen.php\">Menyetujui Log</a></li>
			<li><a href=\"#\">Logout</a></li>
			
			";    
	  }
							?>
	  
    </ul>
  </div>
</nav>
<div class="jumbotron text-center">
  <h1><b>Daftar Log</b></h1>

</div>
<div class="container">
	
		
    <div class="row">
	
	</div>
	
</div>
</div>



</body>
</html>