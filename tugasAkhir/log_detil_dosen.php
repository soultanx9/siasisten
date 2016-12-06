<?php 
session_start(); // Starting Session
if(isset($_SESSION['userlogin'])){
	 $status = $_SESSION['status'];
	 $no_id = $_SESSION['id'];
	}
$id_kelas_mk = $_GET['id_kelas_mk'];
$matkul = $_GET['matkul'];
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/lihat-log.css">
	<script src="javascript/jquery.min.js"></script>
	<script src="javascript/bootstrap.js"></script>
	
	<meta charset="UTF-8">
	<meta name="description" content="LOG">

<title>LOG</title>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
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
		echo "<li><a href=\"#\">Membuka Lowongan</a></li>
			<li><a href=\"#\">Melihat Lowongan</a></li>
			<li><a href=\"#\">Melihat Daftar Pelamar</a></li>
			<li><a href=\"#\">Melihat Detail Pelamar</a></li>
			<li class=\"active\"><a href=\"log_dosen.php\">Menyetujui Log</a></li>
			<li><a href=\"#\">Logout</a></li>
			
			";  
	  }
	  elseif($status=="admin"){
		echo "<li><a href=\"#\">Membuka Lowongan</a></li>
			<li><a href=\"#\">Melihat Lowongan</a></li>
			<li><a href=\"#\">Melihat Daftar Pelamar</a></li>
			<li><a href=\"#\">Melihat Detail Pelamar</a></li>
			<li class=\"active\"><a href=\"log_dosen.php\">Menyetujui Log</a></li>
			<li><a href=\"#\">Logout</a></li>
			
			";    
	  }
							?>
	  
    </ul>
  </div>
</nav>
<div class="jumbotron text-center">
  <h1><b>CS1234 – Basis Data Lanjut</b></h1>
 

</div>
<div class="container">

		
  <div class="row">
  <div class="col-md-12">
	
    <div class="table-responsive">
      <table class="table table-bordered">
    <thead>
      <tr class="success">
        <th class="col-xs-1">No</th>
        <th>Nama Asisten</th>
        <th>Log Asisten</th>
		
      </tr>
    </thead>
    <tbody>
	
	
        <?php
	$id = 1;
	$dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=basdat") or die('connection failed');
	$result = pg_query($dbconn, "select m.nama, l.idlamaran, m.npm
from mahasiswa m, lamaran l, lowongan lo
where lo.idkelasmk=".$id_kelas_mk." and lo.idlowongan=l.idlowongan and l.id_st_lamaran=3 and l.npm = m.npm;");
	if (!$result) {
	  echo "An error occurred.\n";
	  exit;
	}
	$rows = pg_numrows($result);
	if ($rows >= 1) {
	  while ($row = pg_fetch_row($result)) {
	  echo "<tr><td>".$id."</td><td>".$row[0]."</td>"; 
	  $id = $id+1;
	  
	  echo "</td>"."<td><a href=\"log_daftar.php?id=".$row[1]."&nama=".$row[0]."&npm=".$row[2]."&matkul=".$matkul."\">lihat</a></td></tr>";
	}
	}
	?>
    </tbody>
  </table>
    </div>
	
	
	
	</div>
	
	</div>
  </div>
</div>



</body>
</html>