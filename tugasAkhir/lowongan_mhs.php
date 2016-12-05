<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/lihat-lowongan.css">
	<script src="javascript/jquery.min.js"></script>
	<script src="javascript/bootstrap.js"></script>
	
	<script>
	
	</script>
	
	<meta charset="UTF-8">
	<meta name="description" content="LOWONGAN">

<title>Lowongan Asisten</title>
</head>
<body>

<?php
	$tmperror="";
	if(isset($_GET["kode"])){
			$kode = $_GET["kode"];
			$mata_kuliah = $_GET["mata_kuliah"];
			$dosen = $_GET["dosen"];
			$status = substr($_GET["status"],0,1);
			$nip =	"197107201998031001";		
			$default = 'DDP';
			$conn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=basdat") or die('connection failed');
			$result = pg_query($conn, "select max(idlowongan) from lowongan");
			$idlowongan;		
			while($tmp = pg_fetch_array($result)){
				$idlowongan = $tmp[0]+1;
			}
			$sql = "INSERT into lowongan (idlowongan, idkelasmk, status, jumlah_asisten, syarat_tambahan, nipdosenpembuka) 
			VALUES('$idlowongan',21000,'$status',3,$default,'$nip')";
			
						
			if(pg_query($conn, $sql)){
			$tmperror = "<div class=\"alert alert-success fade in\">
								<a href=\"#\" class=\"close\" data-dismiss\=\"alert\">&times;</a>Penyimpanan berhasil
										
							</div>";
			}else{
				$tmperror = "something wrong";
			}
		}
	
	
	?>

<div class="jumbotron text-center">
  <h1><b>Daftar Lowongan</b></h1>
  <h1>Asisten</h1>

</div>
<div class="container">

		
  <div class="row">
  <div class="col-md-12">
    <div class="table-responsive">
      <table class="table">
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
      <tr>
		<td>CS1232</td>
        <td>Basis Data</td>
        <td>Daniel</td>
		<td>Tutup</td>
		<td>1</td>
		<td>1</td>
		<td>1</td>
      </tr>
      <tr class="success">
      <td>CS1234</td>
        <td>Basis Data Lanjut</td>
        <td>Anto, Bimo</td>
		<td>Buka</td>
		<td>3</td>
		<td>3</td>
		<td>2</td>
		<td>Melamar</td>
		<td><button type="button" class="btn btn-success">Batal</button></td>
      </tr>
	  <tr>
        <td>CS1233</td>
        <td>Dasar-dasar Pemrograman</td>
        <td>Charlie</td>
		<td>Buka</td>
		<td>2</td>
		<td>1</td>
		<td>0</td>
		<td></td>
		<td><button type="button" class="btn btn-success">Daftar</button></td>
		
      </tr>
	  
	  
	  
   
    </tbody>
  </table>
    </div>
	</div>
  </div>
</div>



</body>
</html>