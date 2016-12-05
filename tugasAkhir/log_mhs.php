<?php 
	//setname dan post_id
	session_start(); // Starting Session
	if(isset($_SESSION['userlogin'])){
	$uname = $_SESSION['userlogin'];
	$status = $_SESSION['status'];
	$id = $_SESSION['id'];
	}
	 ?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
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
			<li  class=\"active\"><a href=\"log_mhs.php\">Mengisi Log</a></li>
			<li><a href=\"#\">Logout</a></li>
			";
							
		}
	  elseif($status=="dosen"){
		echo "<li><a href=\"#\">Membuka Lowongan</a></li>
			<li><a href=\"#\">Melihat Lowongan</a></li>
			<li><a href=\"#\">Melihat Daftar Pelamar</a></li>
			<li><a href=\"#\">Melihat Detail Pelamar</a></li>
			<li><a href=\"log_dosen.php\">Menyetujui Log</a></li>
			<li><a href=\"#\">Logout</a></li>
			
			";  
	  }
	  elseif($status=="admin"){
		echo "<li><a href=\"#\">Membuka Lowongan</a></li>
			<li><a href=\"#\">Melihat Lowongan</a></li>
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
  <h1><b>Log Asistensi Per Mata Kuliah</b></h1>

</div>
<div class="container">
  <div class="row">
    
      <table class="table table-bordered">
    <thead>
	<tr class="success">
        <th>No</th>
        <th>Mata Kuliah</th>
        <th>Semester</th>
		<th>Tahun Ajaran</th>
		<th>Dosen</th>
		<th>Log Asisten</th>
      </tr>
    </thead>
	
      
    <tbody>
	<?php
	$npm =	$id;
	$dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=basdat") or die('connection failed');
	$result = pg_query($dbconn, "select mk.idkelasmk, mk.kode_mk, m.nama, mk.semester, mk.tahun
from kelas_mk mk, mata_kuliah m, lowongan lo, lamaran l
where mk.kode_mk = m.kode and lo.idkelasmk = mk.idkelasmk and l.idlowongan = lo.idlowongan and l.id_st_lamaran=3 and l.npm='$npm' order by mk.idkelasmk asc;");

	if (!$result) {
	  echo "An error occurred.\n";
	  exit;
	}
	$rows = pg_numrows($result);
	if ($rows >= 1) {
	while ($row = pg_fetch_row($result)) {
	  $semester = $row[3];
	 
	  if($row[3]== 1){
		 $semester = "ganjil" ;
	  }elseif($row[3]== 2){
	     $semester = "genap";
	  } else{
         $semester = "pendek";
	  }
	  $matkul =$row[1]." - ".$row[2];
	  echo "<tr><td>".$row[0]."</td>"."<td>".$matkul."</td>"."<td>".$semester."</td>"."<td>".$row[4]."<td>";
	  $result3 = pg_query($dbconn, "select mk.idkelasmk, d.nama
	from kelas_mk mk, mata_kuliah m, dosen_kelas_mk dkm, dosen d
	where mk.kode_mk = m.kode and dkm.idkelasmk = mk.idkelasmk and dkm.nip = d.nip and mk.idkelasmk =".$row[0]." order by mk.idkelasmk;");
		$tmp = "";
	  while ($rows = pg_fetch_row($result3)){
		  if($rows[0] == $row[0]){
		 
		  $tmp = $tmp.$rows[1].", </br>";
	  
	  }
	  
		  else{
		 // ;
		  break 2;
		  }
		  
		  
	  }
	  echo substr($tmp, 0, -7);
	  echo "</td>"."<td><a href=\"log_detil_mhs.php?idkelasmk=".$row[0]."\">lihat</a></td></tr>";
	}
	}
	?>
     
	  
   
    </tbody>
  </table>
    
  </div>
</div>



</body>
</html>