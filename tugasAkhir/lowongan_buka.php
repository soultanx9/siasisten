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
	
	<meta charset="UTF-8">
	<meta name="description" content="LOWONGAN">

<title>Tambah Lowongan</title>
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
			<li><a href=\"logout.php\">Logout</a></li>
			";
							
		}
	  elseif($status=="dosen"){
		echo "<li><a href=\"lowongan_buka.php\">Membuka Lowongan</a></li>
			<li><a href=\"lowongan_admin.php\">Melihat Lowongan</a></li>
			<li><a href=\"#\">Melihat Daftar Pelamar</a></li>
			<li><a href=\"#\">Melihat Detail Pelamar</a></li>
			<li><a href=\"log_dosen.php\">Menyetujui Log</a></li>
			<li><a href=\"logout.php\">Logout</a></li>
			
			";  
	  }
	  elseif($status=="admin"){
		echo "<li><a href=\"lowongan_buka.php\">Membuka Lowongan</a></li>
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


<div class="jumbotron text-center">
  <h1><b>Tambah</b></h1>
  <h1>Lowongan</h1>
  
</div>
<div class="container">
		
  <div class="row">
  
	
    <div class="table-responsive">
    <table class="table table-bordered">
					  <tr>
						<th class="col-md-3 success">Term</th>
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
						<th class="col-md-3 success">Syarat Tambahan</th>
						<td><textarea class="form-control" rows="1" id ="syarat_tambahan" name="syarat_tambahan"></textarea></td>
					  </tr>
					   <tr>
						<th>Daftar Pengajar</th>
						<td><textarea class="form-control" rows="1" id ="dosen" name="dosen"></textarea></td>
					  </tr>

      </table>
    </div>
	
	</div>
	
  </tbody>
</table>
<button type="button" class="btn btn-success">Simpan</button>
	<button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
    </div>
	</div>
 
</div>



</body>
</html>