<?php 
	//setname dan post_id
	session_start(); // Starting Session
	$uname = $_SESSION['userlogin'];
	$status = $_SESSION['status'];
	$npm_mhs = $_SESSION['id'];
	$idkelasmk =$_GET['idkelasmk'];
	
	 ?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/lihat-log.css">
	<script src="javascript/jquery.min.js"></script>
	<script src="javascript/bootstrap.js"></script>
	<script>
		function validateForm() {
			var kategori = document.forms["myForm"]["kategori"].value;
			var tanggal = document.forms["myForm"]["tanggal"].value;
			var jam_mulai = document.forms["myForm"]["jam_mulai"].value;
			var jam_selesai = document.forms["myForm"]["jam_selesai"].value;
			var deskripsi_kerja = document.forms["myForm"]["deskripsi_kerja"].value;
			if (kategori == "") {
				alert("kategori harus dipilih");
				return false;
			}if (tanggal == "") {
				alert("tanggal harus diisi");
				return false;
			}if (jam_mulai == "") {
				alert("jam mulai harus diisi");
				return false;
			}if (jam_selesai == "") {
				alert("jam selesai harus diisi");
				return false;
			}if (deskripsi_kerja == "") {
				alert("deskripsi kerja harus diisi");
				return false;
			}
			if(jam_mulai >= jam_selesai){
				alert("jam salah, jam mulai harus lebih dahulu");
				return false;
			}		
		}
		</script>
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

	<?php
	$tmperror="";
	if(isset($_POST["kategori"])){
			$kategori = substr($_POST["kategori"],0,1);
			$tanggal = $_POST["tanggal"];
			$jam_mulai = $tanggal." ".$_POST["jam_mulai"];
			$jam_selesai = $tanggal." ".$_POST["jam_selesai"];
			$deskripsi_kerja = $_POST["deskripsi_kerja"];
			$npm =$npm_mhs.'';		
			$default = 1;
			$conn = pg_connect("host=dbpg.cs.ui.ac.id port=5432 dbname=b02 user=b02 password=Xq9K3P") or die('connection failed');

			$result = pg_query($conn, "select max(id) from log");
			$id;		
			while($tmp = pg_fetch_array($result)){
				$id = $tmp[0]+1;
			}
			
			$resulttmp = pg_query($conn, "select idlamaran from lamaran la, lowongan lo
			where la.npm='$npm' and la.id_st_lamaran=3 and la.idlowongan=lo.idlowongan and lo.idkelasmk='$idkelasmk';");
			$idlamaran;		
			while($tmp3 = pg_fetch_array($resulttmp)){
				$idlamaran = $tmp3[0];
			}
						
			$sql = "INSERT into log (id, idlamaran, npm, id_kat_log, id_st_log, tanggal, jam_mulai, jam_selesai, deskripsi_kerja) 
			VALUES('$id','$idlamaran','$npm','$kategori','$default',to_timestamp('$tanggal','YYYY/MM/DD'),to_timestamp('$jam_mulai','YYYY/MM/DD hh24:mi'),to_timestamp('$jam_selesai','YYYY/MM/DD hh24:mi'), '$deskripsi_kerja')";
			
						
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
  <h1><b>Daftar Log</b></h1>
  <h1>Basis Data Lanjut</h1>

</div>
<div class="container">
	<?php echo $tmperror;?>
		
  <div class="row">
  <div class="col-md-12">
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Tambah</button>
    <div class="table-responsive" style="margin-top:10px">
      <table class="table table-bordered">
    <thead>
      <tr>
        <th>Kategori</th>
        <th>Tanggal</th>
        <th>Jam Mulai</th>
		<th>Jam Selesai</th>
		<th>Deskripsi Kerja</th>
		<th>Status</th>
		<th></th>
      </tr>
    </thead>
    <tbody>
	<?php
	$dbconn = pg_connect("host=dbpg.cs.ui.ac.id port=5432 dbname=b02 user=b02 password=Xq9K3P") or die('connection failed');

	$resulttmp = pg_query($dbconn, "select idlamaran from lamaran la, lowongan lo
			where la.npm='$npm_mhs' and la.id_st_lamaran=3 and la.idlowongan=lo.idlowongan and lo.idkelasmk='$idkelasmk';
			");
			$idlamaran;		
			while($tmp3 = pg_fetch_array($resulttmp)){
				$idlamaran = $tmp3[0];
			}
	$result = pg_query($dbconn, "select k.kategori, to_char(l.tanggal,'dd-mm-yyyy') as tanggal, to_char(l.jam_mulai, 'HH24:MI') as jam_mulai,to_char(l.jam_selesai, 'HH24:MI') as jam_selesai, l.deskripsi_kerja, s.status
								 from log l, kategori_log k, status_log s
								 where l.idlamaran='$idlamaran' and l.id_kat_log = k.id and l.id_st_log = s.id and l.npm = '$npm_mhs';");
	
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
										(($log[5] == "dilaporkan")?"<td>-</td>":"<td>".$log[5]."</td>").
										(($log[5]!="dilaporkan")?"<td></td>":"<td class=\"text-center\"><button class=\"btn btn-primary btn-xs\" data-title=\"Edit\" data-toggle=\"modal\" data-target=\"#edit\" >
										<span class=\"glyphicon glyphicon-pencil\"></span></button>
								
										<button class=\"btn btn-danger btn-xs\" data-title=\"Delete\" data-toggle=\"modal\" data-target=\"#delete\" >
										<span class=\"glyphicon glyphicon-remove\"></span></button>	</td>")."</tr>";
										
										
									   
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
				<form name="myForm" action="log_detil_mhs.php?idkelasmk=<?php echo htmlspecialchars($_GET['idkelasmk']);?>" onsubmit="return validateForm()" method="post">
				<input type="hidden" name="idkelasmk" value="<?php echo htmlspecialchars($_GET['idkelasmk']);?>">	
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                    </button>
                     <h4 class="modal-title" id="myModalLabel"> Buat Log</h4>

                </div>
                <div class="modal-body">

					  <div class="table-responsive">
					  <table class="table table-bordered">
					  <tr>
						<th class="col-md-4">Kategori</th>
						<td><select class="form-control" id = "kategori" name = "kategori">
						<option></option>
						<?php
						$dbconn = pg_connect("host=dbpg.cs.ui.ac.id port=5432 dbname=b02 user=b02 password=Xq9K3P") or die('connection failed');

						$result = pg_query($dbconn, "select * from kategori_log;");
						while($kategori = pg_fetch_array($result)){
									echo "<option>".$kategori[0]." - ".$kategori[1]."</option>";
						}
						?>
						</select></td>
					  </tr>
					  <tr>
						<th>Tanggal</th>
						<td><input type="date" class="form-control" id="tanggal" name="tanggal"></td>
					  </tr>
					  <tr>
						<th>Jam Mulai</th>
						<td><input type="time" class="form-control" id="jam_mulai" name="jam_mulai" ></td>
					  </tr>
					   <tr>
						<th>Jam Selesai</th>
						<td><input type="time" class="form-control" id="jam_selesai" name="jam_selesai"></td>
					  </tr>
					   <tr>
						<th>Deskripsi Kerja</th>
						<td><textarea class="form-control" rows="3" id ="deskripsi_kerja" name="deskripsi_kerja"></textarea></td>
					  </tr>
					  </table>
					</div>
				
				
				
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <input type="submit" value="submit" class="btn btn-primary" id="submit">
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