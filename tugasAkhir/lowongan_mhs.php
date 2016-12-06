<?php 
	//setname dan post_id
	session_start(); // Starting Session
	$uname = $_SESSION['userlogin'];
	$status = $_SESSION['status'];
	$npm_mhs = $_SESSION['id'];
	 ?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/lihat-lowongan.css">
	<script src="javascript/jquery.min.js"></script>
	<script src="javascript/bootstrap.js"></script>
	
	<meta charset="UTF-8">
	<meta name="description" content="LOWONGAN">

<title>Lowongan Asisten</title>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">SIASISTEN</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
      <?php
	  if($status == "mahasiswa") {
      echo "<li><a href=\"lowongan_mhs.php\">Melihat Lowongan</a></li>
			<li><a href=\"#\">Membuat Lamaran</a></li>
			<li><a href=\"#\">Mengubah Profil</a></li>
			<li  class=\"active\"><a href=\"log_mhs.php\">Mengisi Log</a></li>
			<li><a href=\"logout.php\">Logout</a></li>
			";
							
		}
	  elseif($status=="dosen"){
		echo "<li><a href=\"#\">Membuka Lowongan</a></li>
			<li><a href=\"#\">Melihat Lowongan</a></li>
			<li><a href=\"#\">Melihat Daftar Pelamar</a></li>
			<li><a href=\"#\">Melihat Detail Pelamar</a></li>
			<li><a href=\"log_dosen.php\">Menyetujui Log</a></li>
			<li><a href=\"logout.php\">Logout</a></li>
			
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
  <h1><b>Daftar Lowongan</b></h1>
  <h1>Asisten</h1>

</div>
<div class="container">
		
  <div class="row">
  <div class="col-md-12">
	
    <div class="table-responsive" style="padding-top:10px">
      <table class="table table-bordered">
    <thead>
      <tr class="success">
        <th>Kode</th>
        <th>Mata Kuliah</th>
        <th>Pengajar</th>
		<th>Status Lowongan</th>
		<th>Jumlah Asisten dibutuhkan</th>
		<th>Jumlah Pelamar</th>
		<th>Jumlah Pelamar Diterima</th>
		<th>Status Lamaran</th>
		<th>Action</th>
		
      </tr>
    </thead>
    <tbody>
     
	<?php
	$dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=basdat") or die('connection failed');
	$result = pg_query($dbconn, "select b.kode_mk, c.nama namamk, d.nama namadosen, case a.status when true then 'Buka' else 'Tutup' end status, 
					SUM(a.jumlah_asisten) jumlahlowongan, SUM(a.jml_pelamar) jml_pelamar, SUM(a.jml_pelamar_diterima) jml_pelamar_diterima,
					case e.id_st_lamaran when 1 then 'Melamar' else 'Direkomendasikan' end id_st_lamaran from lowongan a
					inner join kelas_mk b on a.idkelasmk = b.idkelasmk
					inner join mata_kuliah c on c.kode = b.kode_mk
					inner join dosen d on a.nipdosenpembuka = d.nip
					inner join lamaran e on a.idlowongan = e.idlamaran
					group by a.status, b.kode_mk, c.nama, d.nama, e.id_st_lamaran
					order by c.nama");
	
	if (!$result) {
	  echo "An error occurred.\n";
	  exit;
	}
	
	$rows = pg_numrows($result);
	
	if($rows >= 1){
									
									while($log = pg_fetch_array($result)){
									echo "<tr>".
										"<td>".$log[0]."</td>".
										"<td>".$log[1]."</td>".
										"<td>".$log[2]."</td>".
										"<td>".$log[3]."</td>".
										"<td>".$log[4]."</td>".
										"<td>".$log[5]."</td>".
										"<td>".$log[6]."</td>".
										"<td>".$log[7]."</td>".
										"<td class=\"text-center\">
										<button type=\"button\" class=\"btn btn-success\" data-toggle= \"modal\" data-target=\"#myModal\">
																							Daftar		
											</button>
											
										</td>
										
										</tr>";
					
									   
									}
								}
	
	?>
	  
   
    </tbody>
  </table>
    </div>
	</div>
  </div>
</div>



</body>
</html>