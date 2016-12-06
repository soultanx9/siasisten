<?php 
	//setname dan post_id
	session_start(); // Starting Session
	$uname = $_SESSION['userlogin'];
	$status = $_SESSION['status'];
	 ?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/lihat-lowongan.css">
	<script src="javascript/jquery.min.js"></script>
	<script src="javascript/bootstrap.js"></script>
	<script>
		function validateForm() {
				var term = document.forms["myForm"]["term"].value;
				var mata_kuliah = document.forms["myForm"]["mata_kuliah"].value;
				var dosen = document.forms["myForm"]["dosen"].value;
				var status = document.forms["myForm"]["status"].value;
				if (kode == "") {
					alert("kode harus diisi");
					return false;
				}if (mata_kuliah == "") {
					alert("mata_kuliah harus diisi");
					return false;
				}if (dosen == "") {
					alert("dosen harus diisi");
					return false;
				}if (status == "") {
					alert("status harus dipilih");
					return false;
				}	
			}
			</script>
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
		echo "<li><a href=\"#\">Membuka Lowongan</a></li>
			<li><a href=\"lowongan_admin.php\">Melihat Lowongan</a></li>
			<li><a href=\"#\">Melihat Daftar Pelamar</a></li>
			<li><a href=\"#\">Melihat Detail Pelamar</a></li>
			<li><a href=\"log_dosen.php\">Menyetujui Log</a></li>
			<li><a href=\"logout.php\">Logout</a></li>
			
			";  
	  }
	  elseif($status=="admin"){
		echo "<li><a href=\"#\">Membuka Lowongan</a></li>
			<li><a href=\"lowongan_admin.php\">Melihat Lowongan</a></li>
			<li><a href=\"#\">Melihat Daftar Pelamar</a></li>
			<li><a href=\"#\">Melihat Detail Pelamar</a></li>
			<li><a href=\"log_dosen.php\">Menyetujui Log</a></li>
			<li><a href=\"logout.php\">Logout</a></li>
			
			";    
	  }
							?>
	  
    </ul>
  </div>
</nav>

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
<?php echo $tmperror;?>
		
  <div class="row">
  <div class="col-md-12">
	<button type="button" class="btn btn-success" data-toggle= "modal" data-target="#myModal">Tambah</button>
    <div class="table-responsive" style="padding-top:10px">
      <table class="table table-bordered">
    <thead>
      <tr class="success">
        <th>Kode</th>
        <th>Mata Kuliah</th>
        <th>Dosen Pengajar</th>
		<th>Status</th>
		<th>Jumlah Lowongan</th>
		<th>Jumlah Pelamar</th>
		<th>Jumlah Pelamar Diterima</th>
		<th>Action</th>
	</tr>
    </thead>
	
    <tbody>
	
	<?php
	$dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=basdat") or die('connection failed');
	$result = pg_query($dbconn, "select b.kode_mk, c.nama namamk, d.nama namadosen, case a.status when true then 'Buka' else 'Tutup' end status, 
						count(b.kode_mk) jumlahlowongan, SUM(a.jml_pelamar) jml_pelamar, SUM(a.jml_pelamar_diterima) jml_pelamar_diterima  from lowongan a
						inner join kelas_mk b on a.idkelasmk = b.idkelasmk
						inner join mata_kuliah c on c.kode = b.kode_mk
						inner join dosen d on a.nipdosenpembuka = d.nip
						group by a.status, b.kode_mk, c.nama, d.nama
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
										"<td class=\"text-center\">
											<button class=\"btn btn-primary btn-xs\" data-title=\"Edit\" data-toggle=\"modal\" data-target=\"#edit\" >
												<span class=\"glyphicon glyphicon-pencil\"></span>
											</button>
											<button class=\"btn btn-danger btn-xs\" data-title=\"Delete\" data-toggle=\"modal\" data-target=\"#delete\" >
												<span class=\"glyphicon glyphicon-remove\"></span>
											</button>
										</td>
										</tr>";
					
									   
									}
								}
?>
    </tbody>
  </table>
    </div>
	
	
	
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
				<form name="myForm" action="log_detil_mhs.php" onsubmit="return validateForm()" method="get">
					
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                    </button>
                     <h4 class="modal-title" id="myModalLabel">Tambah Lowongan</h4>

                </div>
                <div class="modal-body">

					  <div class="table-responsive">
					  <table class="table table-bordered">
					 <tr>
						<th class="col-md-3">Term</th>
						<td><select name="termOption" class="form-control" onchange=<?php $nama = str_replace(' ', '_', $nama); echo "fetch_select(this.value,'$id','$nama','$npm')";?>>
						<option>Pilih Term</option>
						<?php
						$dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=basdat") or die('connection failed');
						$result = pg_query($dbconn, "select * FROM TERM;");
						while($term = pg_fetch_array($result)){
									if($term[1]==1)
									echo "<option>Ganjil, ".$term[0]."</option>";
						}
						?>
						</select></td>
					  </tr>
						<th>Mata Kuliah</th>
						<td><textarea class="form-control" rows="1" id ="mata_kuliah" name="mata_kuliah"></textarea></td>
					  </tr>
					  <tr class="success">
						  <th scope="row">Status</th>
						  <td><fieldset class="form-group">
								<input type="checkbox" id="checkbox1">
								<label for="checkbox1"></label></fieldset>Buka/Tutup
						</td>
						</tr>
						<th>Jumlah Asisten dibutuhkan</th>
						<td><textarea class="form-control" rows="1" id ="jumlah_asisten" name="jumlah_asisten"></textarea></td>
					  </tr>
					  <tr>
						<th>Syarat tambahan</th>
						<td><textarea class="form-control" rows="1" id ="syarat_tambahan" name="syarat_tambahan"></textarea></td>
					  </tr>
					   <tr>
						<th>Daftar Pengajar</th>
						<td><textarea class="form-control" rows="1" id ="dosen" name="dosen"></textarea></td>
					  </tr>
					   
					  </table>
					</div>
				
				
				
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <input type="submit" value="Simpan" class="btn btn-primary" id="Submit">
                </div>
			</form>	
            </div>
        </div>
    </div>
	</div>
	</div>
	
	</div>
  </div>
</div>



</body>
</html>
