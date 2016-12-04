<?php 
	//setname dan post_id
	session_start(); // Starting Session
	 $no_id = "197007202000031007";	
	
	if(isset($_SESSION['userlogin'])){
	 $status = $_SESSION['userlogin'];
	 $no_id = "197107201998031001";
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
	$npm =	"1127242324";
	$dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=basdat") or die('connection failed');
	$result = pg_query($dbconn, "select mk.idkelasmk, mk.kode_mk, m.nama, mk.semester, mk.tahun
from kelas_mk mk, mata_kuliah m, dosen_kelas_mk dkm
where mk.kode_mk = m.kode and mk.idkelasmk=dkm.idkelasmk and dkm.nip ='".$no_id."'order by mk.idkelasmk asc;");
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
	  $matkul = $row[1]." - ".$row[2];
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
	  echo "</td>"."<td><a href=\"log_detil_dosen.php?id_kelas_mk=".$row[0]."&matkul=".$matkul."\">lihat</a></td></tr>";
	}
	}
	?>
	  
   
    </tbody>
  </table>
    
  </div>
</div>



</body>
</html>
