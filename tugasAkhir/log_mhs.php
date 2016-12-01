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
	$dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=basdat") or die('connection failed');
	$result = pg_query($dbconn, "select mk.idkelasmk, mk.kode_mk, m.nama, mk.semester, mk.tahun, d.nama
from kelas_mk mk, mata_kuliah m, dosen_kelas_mk dkm, dosen d
where mk.kode_mk = m.kode and dkm.idkelasmk = mk.idkelasmk and dkm.nip = d.nip order by mk.idkelasmk asc;");
	$result2 = pg_query($dbconn, "select mk.idkelasmk, mk.kode_mk, m.nama, mk.semester, mk.tahun, d.nama
	from kelas_mk mk, mata_kuliah m, dosen_kelas_mk dkm, dosen d
	where mk.kode_mk = m.kode and dkm.idkelasmk = mk.idkelasmk and dkm.nip = d.nip;");
	if (!$result) {
	  echo "An error occurred.\n";
	  exit;
	}
	while ($row = pg_fetch_row($result)) {
	  echo "<tr><td>".$row[0]."</td>"."<td>".$row[1]."-".$row[2]."</td>"."<td>".$row[3]."</td>"."<td>".$row[4]."</td>"."<td>".$row[5];
	  while ($rows = pg_fetch_row($result)){
		  if($rows[0] == $row[0] )
		  echo ", </br>".$rows[5];
	  }
	  echo "</td>"."<td><a href=\"log_detil_mhs.html\">lihat</a></td></tr>";
	}
	?>
      <tr>
		<td>1</td>
        <td>CS1234 - Basis Data Lanjut</td>
        <td>Ganjil</td>
		<td>2016/2017</td>
		<td>anto, bimo</td>
		<td><a href="log_detil_mhs.html">Lihat</a></td>
      </tr>
      <tr class="success">
        <td>2</td>
        <td>CS1234 - Basis Data Lanjut</td>
        <td>Genap</td>
		<td>2015/2016</td>
		<td>tono, sandi</td>
		<td><a href="log_detil_mhs.html">Lihat</a></td>
      </tr>
	  <tr>
        <td>3</td>
        <td>CS1234 - Basis Data Lanjut</td>
        <td>Ganjil</td>
		<td>2015/2016</td>
		<td>tono, jalu.wijaya</td>
		<td><a href="log_detil_mhs.html">Lihat</a></td>
      </tr>
	  
   
    </tbody>
  </table>
    
  </div>
</div>



</body>
</html>